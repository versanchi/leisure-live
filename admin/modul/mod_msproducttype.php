<script language="JavaScript"  type="text/javascript">     
function delfile(ID, Producttype)         
{
if (confirm("Are you sure you want to delete "+ Producttype +" "))
{
 window.location.href = '?module=msproducttype&act=deleteproducttype&id=' + ID +'&type='+ Producttype ;
 
} 
}
function delattach(ID, ATTACHFILE)
{
if (confirm("Are you sure remove Logo " + ATTACHFILE +" "))
{
 window.location.href = '?module=msproducttype&act=delattach&id=' + ID;
 
} 
}
</script>    
<?php
$companyid=$_SESSION[company_id];
switch($_GET[act]){
  // Tampil Country
  default:
  	$nama=$_GET['nama'];
    echo "<h2>Master Department</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='msproducttype'>
			  <input type=text name=nama value='$nama' size=40>	
			  <input type=submit name=oke value=Search>
		  </form><input type=button value='Add Product Department' onclick=location.href='?module=msproducttype&act=tambahproducttype'>";
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
		    $tampil=mysql_query("SELECT * FROM tour_msproducttype 
								WHERE ProducttypeName LIKE '%$nama%'
								AND CompanyID = '$companyid'
								ORDER BY Status,ProducttypeName ASC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>Product Department</th><th>Status</th><th>action</th></tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
			   echo "<tr><td>$no</td>         
                     <td>$data[ProducttypeName]</td>
                     <td>$data[Status]</td>
					 <td><center><a href=?module=msproducttype&act=editproducttype&id=$data[IDProducttype]>Edit</a>
					  
					 </td></tr>";
					  $no++;
					}     //&nbsp;|&nbsp; 
                     //<a href=\"javascript:delfile('$data[IDProducttype]','$data[ProducttypeName]')\">Delete</a>
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tour_msproducttype 
                                WHERE ProducttypeName LIKE '%$nama%'
                                AND CompanyID = '$companyid'
                                ORDER BY ProducttypeName ASC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=msproducttype";
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
  
  case "tambahproducttype":
    echo "<h2>New Department</h2>
          <form method=POST action='./aksi.php?module=msproducttype&act=input'>
          <input type='hidden' name='companyid' value='$companyid'>
          <table>
          <tr><td>Product Department</td><td><input type=text name='ProducttypeName'></td></tr> 
          <tr><td>Logo</td><td><input type='file' name='logo'> </td></tr>
          <tr><td>Status</td><td><input type=radio name='Status' value='ACTIVE' checked>&nbsp;Active
            					 <input type=radio name='Status' value='INACTIVE'>&nbspInactive</td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table>
          </form><br><br>";
     break;
    
  case "editproducttype":
    $edit=mysql_query("SELECT * FROM tour_msproducttype WHERE IDProducttype='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $logo= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[Logo]) ) ) );
    echo "<h2>Edit Department</h2>
          <form name='example' method=POST action=./aksi.php?module=msproducttype&act=update>
          <input type=hidden name=id value='$r[IDProducttype]'>
          <table>                                                                                                        
          <tr><td>Product Department</td><td><input type=text name='ProducttypeName' value='$r[ProducttypeName]' readonly></td></tr>
          <tr><td>Logo</td><td>";if($r[Logo]<>''){
        echo"<input type='hidden' name='logo' value='$r[Logo]'>
        <a href='$logo' target='_blank' style=text-decoration:none >$r[Logo]</a> &nbsp<a href=\"javascript:delattach('$r[IDProducttype]','$r[Logo]')\"><font color=red>remove</font></a>";}
                                        else{echo"<input type='file' name='logo' >";
                                        }echo"</td></tr>
          <tr><td>Status</td><td><input type=radio name='Status' value='ACTIVE' ";if($r[Status]=='ACTIVE'){echo"checked";}echo">&nbsp;Active
            <input type=radio name='Status' value='INACTIVE' ";if($r[Status]=='INACTIVE'){echo"checked";}echo">&nbspInactive</td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table>
          </form>";
    break;  
	
  case "deleteproducttype":
    $EmployeeID=$_SESSION[employeeid];
    $sqluser=mysql_query("SELECT EmployeeName FROM tbl_msemployee WHERE EmployeeID='$EmployeeID'");
    $tampiluser=mysql_fetch_array($sqluser);
    $EmpName = $tampiluser[EmployeeName];     
    $timezone_offset = -1;
    $tz_adjust = ($timezone_offset * 60 * 60);
    $jam = time();
    $waktu = ($jam + $tz_adjust);
    $today = date("Y-m-d G:i:s");
     $edit=mysql_query("DELETE FROM tour_msproducttype WHERE IDProducttype ='$_GET[id]'"); 
     $Description="Delete Product Type (".$_GET[type].") "; 
     mysql_query("INSERT INTO tour_log(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");             
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproducttype'>";   
     break;
     
case "delattach":    
    $edit1=mysql_query("SELECT * FROM tour_msproducttype WHERE IDProducttype ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1);
    $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r2[Logo]) ) ) );
    $path = $r2[Attachment];
    $files = ("$path$file");
    unlink($files);
    $edit=mysql_query("UPDATE tour_msproduct set Attachment = '',AttachmentFile='' WHERE IDProduct = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproduct&act=editmsproduct&id=$_GET[id]'>";     
     break;
} 
?>
