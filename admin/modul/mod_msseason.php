<link type="text/css" href="../head/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>
<script language="JavaScript"  type="text/javascript">
     
function delfile(ID, SEASON)         
{
if (confirm("Are you sure you want to delete "+ SEASON +" "))
{
 window.location.href = '?module=msseason&act=deleteseason&id=' + ID +'&season='+ SEASON ;
 
} 
}
</script>
<script type="text/javascript"> 
function validateFormOnSubmit(theForm) {
var reason = "";                           
  reason += validateEmpty(theForm.seasonname); 
  reason += validateDate(theForm.seasonfrom);
  reason += validateDateto(theForm.seasonto); 
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);
    return false;
  }

  return true;
}

function validateEmpty(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        fld.style.background = 'Yellow'; 
        error = "Season name cannot empty.\n"
    } else {
        fld.style.background = 'White';
    }
    return error;  
}
function validateDate(fld) {
    var error = "";
    var dep = fld.value;          
    var date = new Date(dep);
    var d  = date.getDate();
    var day = (d < 10) ? '0' + d : d;
    var m = date.getMonth() + 1;
    var month = (m < 10) ? '0' + m : m;
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    var seasonfrom = year + "/" + month + "/" + day ;
    
    var dates = new Date();
    var ds  = dates.getDate();
    var days = (ds < 10) ? '0' + ds : ds;
    var ms = dates.getMonth() + 1;
    var months = (ms < 10) ? '0' + ms : ms;
    var yys = dates.getYear();
    var years = (yys < 1000) ? yys + 1900 : yys;
    var sekarang = years + "/" + months + "/" + days ;                                   
    if (fld.value.length == 0) {
        fld.style.background = 'Yellow'; 
        error = "Season date from cannot empty.\n"
    } else {   
        fld.style.background = 'White';   
    }
    return error;  
}
function validateDateto(fld) {
    var error = "";
    var arr = fld.value;          
    var date = new Date(arr);
    var d  = date.getDate();
    var day = (d < 10) ? '0' + d : d;
    var m = date.getMonth() + 1;
    var month = (m < 10) ? '0' + m : m;
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    var seasonto = year + "/" + month + "/" + day ;
    
    var dep = example.seasonfrom.value;
    var dates = new Date(dep);
    var ds  = dates.getDate();
    var days = (ds < 10) ? '0' + ds : ds;
    var ms = dates.getMonth() + 1;
    var months = (ms < 10) ? '0' + ms : ms;
    var yys = dates.getYear();
    var years = (yys < 1000) ? yys + 1900 : yys;
    var seasonfrom = years + "/" + months + "/" + days ; 
                                      
    if (fld.value.length == 0) {
        fld.style.background = 'Yellow'; 
        error = "Season date to cannot empty.\n"
    } else if (seasonfrom > seasonto) {
        fld.style.background = 'Yellow'; 
        error = "Please choose date large than from date.\n"
    } else {   
        fld.style.background = 'White';   
    }
    return error;  
}

</script>    
<?php 
switch($_GET[act]){
  // Tampil season
  default:
  	$nama=$_GET['nama'];
    echo "<h2>Master Season</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='msseason'>
			  <input type=text name=nama value='$nama' size=40>	
			  <input type=submit name=oke value=Search>
		  </form><input type=button value='Add season' onclick=location.href='?module=msseason&act=tambahseason'>";
		  $oke=$_GET['oke'];
 
		  // Langkah 1
		  $batas = 10;
		  $halaman= $_GET['halaman'];
		  if(empty($halaman)){
		  	$posisi  = 0;
			$halaman = 1;
		  } else {
		  	$posisi = ($halaman-1) * $batas; }
			
			// Langkah 2
		    $tampil=mysql_query("SELECT * FROM tour_msseason 
								WHERE SeasonName LIKE '%$nama%'  
								ORDER BY SeasonName ASC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>Season</th><th>status</th><th>action</th></tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
			   echo "<tr><td>$no</td>
					 <td>$data[SeasonName]</td>
                     <td>$data[SeasonStatus]</td>                    
					 <td><center><a href=?module=msseason&act=editseason&id=$data[IDSeason]>Edit</a>
					 
					 </td></tr>";
					  $no++;
					}     //&nbsp;|&nbsp; 
                     //<a href=\"javascript:delfile('$data[IDSeason]','$data[SeasonName]')\">Delete</a>        
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tour_msseason 
                                WHERE SeasonName LIKE '%$nama%'  
                                ORDER BY SeasonName ASC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=msseason";
					// Link ke halaman sebelumnya (previous)
					echo "<center><div id='paging'>";
					if ($halaman >1) {
						$previous = $halaman-1;
						echo "<a href=$file&halaman=1&nama=$nama&oke=$oke> << First</a> |
	    					  <a href=$file&halaman=$previous&nama=$nama&oke=$oke> < Previous</a> | ";
					} else {
						echo "<< First | < Previous | ";
					}
					// Tampilkan link halaman 1,2,3 ... modifikasi ala google
					// Angka awal
					$angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
					for ($i=$halaman-2; $i<$halaman; $i++) {
						if ($i < 1 )
							continue;
						$angka .= "<a href=$file&halaman=$i&nama=$nama&oke=$oke>$i</a> ";
					}
					// Angka tengah
					$angka .= " <b>$halaman</b> ";
					for ($i=$halaman+1; $i<($halaman+3); $i++) {
						if ($i > $jmlhalaman)
							break;
						$angka .= "<a href=$file&halaman=$i&nama=$nama&oke=$oke>$i</a> ";	
					}
					// Angka akhir
					$angka .= ($halaman+2<$jmlhalaman ? " ...
						<a href=$file&halaman=$jmlhalaman&nama=$nama&oke=$oke>$jmlhalaman</a> |" : " ");
					// Cetak angka seluruhnya (awal, tengah, akhir)
					echo "$angka";
					// Link ke halaman berikutnya (Next)
					if ($halaman < $jmlhalaman) {
						$next = $halaman+1;
						echo "<a href=$file&halaman=$next&nama=$nama&oke=$oke> Next ></a> |
	    					  <a href=$file&halaman=$jmlhalaman&nama=$nama&oke=$oke> Last >></a> ";
					} else {
						echo " Next > | Last >>";
					}					
					echo "<br><br>Found <b>$jmldata</b> data(s)<p>";
					echo "</div>";
			} else {
				echo "<div id='paging'>";
				echo "<br><br>Data Not Found<p>";
				echo "</div>";
			}  
     break;
  
  case "tambahseason":
    echo "<h2>New Season</h2>
          <form name='example' onsubmit='return validateFormOnSubmit(this)' method='POST' action='./aksi.php?module=msseason&act=input'>
          <table>     
          <tr><td>Season Name</td>     <td>  <input type=text name='seasonname'></td></tr>
          <tr><td>Status</td> <td><select name='seasonstatus'>    
            <option value='ACTIVE' selected>Active</option>
            <option value='INACTIVE' >Inactive</option>   
            </select></td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
          <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table>
          </form><br><br>";
     break;
    
  case "editseason":
    $edit=mysql_query("SELECT * FROM tour_msseason WHERE IDSeason='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Season</h2>
          <form name='example' method=POST action=./aksi.php?module=msseason&act=update>
          <input type=hidden name=id value='$r[IDSeason]'>
          <table>    
          <tr><td>Season Name</td>     <td>  <input type=text name='seasonname' value ='$r[SeasonName]'></td></tr> 
          <tr><td>Status</td> <td><select name='seasonstatus'>    
            <option value='ACTIVE' ";if($r[SeasonStatus]=='ACTIVE'){echo"selected";}echo">Active</option>
            <option value='INACTIVE' ";if($r[SeasonStatus]=='INACTIVE'){echo"selected";}echo">Inactive</option>   
            </select></td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table>
          </form>";
    break;  
	
  case "deleteseason":
    $EmployeeID=$_SESSION[employeeid];
    $sqluser=mysql_query("SELECT EmployeeName FROM tbl_msemployee WHERE EmployeeID='$EmployeeID'");
    $tampiluser=mysql_fetch_array($sqluser);
    $EmpName = $tampiluser[EmployeeName];     
    $timezone_offset = -1;
    $tz_adjust = ($timezone_offset * 60 * 60);
    $jam = time();
    $waktu = ($jam + $tz_adjust);
    $today = date("Y-m-d G:i:s");
     $edit=mysql_query("DELETE FROM tour_msseason WHERE IDSeason ='$_GET[id]'"); 
     $Description="Delete season (".$_GET[season].") "; 
     mysql_query("INSERT INTO tour_log(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");             
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msseason'>";   
     break;
     
case "sameseason":
    $edit=mysql_query("SELECT * FROM tour_msseason WHERE IDSeason='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<font color = 'red' size='4'><b>SORRY WE FIND SAME PERIOD WITH : <a href=?module=cari&divis=$r[Divisi]&nama=$r[InquiryID]&oke=Show>$r[SeasonName]</a> SEASON</b></font>
           <br><br>
          <center><input type=button value='Close' onclick=location.href='?module=msseason'>
         <br><br> ";
    break;  
} 
?>
