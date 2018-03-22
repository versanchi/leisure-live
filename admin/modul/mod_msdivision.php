<script language="JavaScript"  type="text/javascript">
     
function delfile(ID, Division)
{
if (confirm("Are you sure you want to delete "+ Division +" "))
{
 window.location.href = '?module=msdivision&act=deletedivision&id=' + ID +'&div='+ Division ;
 
} 
}
function isNumber(field) {
var re = /^[0-9'.']*$/;
if (!re.test(field.value)) {
alert('PLEASE INPUT NUMBER!');
field.value = field.value.replace(/[^0-9'.']/g,"");
}
}
</script>
<?php 
switch($_GET[act]){
  // Tampil Office
  default:
  	$nama=$_GET['nama'];
    echo "<h2>Master Division</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='msdivision'>
			  <input type=text name=nama value='$nama' size=40>	
			  <input type=submit name=oke value=Search>
		  </form><input type=button value='Add Division' onclick=location.href='?module=msdivision&act=tambahmsdivision'>";
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
			$tampil=mysql_query("SELECT * FROM tbl_msoffice
								WHERE office_name LIKE '%$nama%' 
                                OR office_group LIKE '%$nama%'
								ORDER BY office_code ASC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>ID</th><th>Division</th><th>Group</th><th>Area</th><th>action</th></tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
                    if($data[office_group]=="PANORAMA WORLD"){$pano="<font color=red>$data[office_group]</font>";}
                    else if($data[office_group]=="PANORAMA TOURS"){$pano="<font color=fd6210><b>$data[office_group]</b></font>";}    
			   echo "<tr><td>$no</td>
					 <td>$data[office_code]</td>
                     <td>$data[office_name]</td>	   			 			   
					 <td>$pano</td>
                     <td>$data[office_area]</td>   			 
					 <td><center><a href=?module=msdivision&act=editmsdivision&id=$data[office_id]>Edit</a>
					 
					 </td></tr>";
					  $no++;
					}   //|
                    //  <a href=\"javascript:delfile('$data[office_id]','$data[office_code]')\">Delete</a>
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tbl_msoffice
                                WHERE office_name LIKE '%$nama%' 
                                OR office_group LIKE '%$nama%'
                                ORDER BY office_code ASC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=msdivision";
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
  
  case "tambahmsdivision":
    echo "<h2>Add Division</h2>
          <form method=POST action='./aksi.php?module=msdivision&act=input'>
          <table>
          <tr><td>Division ID</td> <td>  <input type=text name='office_code' size=30></td></tr>
          <tr><td>Division Name</td> <td>  <input type=text name='office_name' size=30></td></tr>  		  
          <tr><td>Division Code</td> <td>  <input type=text name='office_key' size=2 maxlength='2' onkeyup='isNumber(this)' ></td></tr>
          <tr><td>Group</td> <td>  <select name='office_group'>
            <option value='PANORAMA TOURS' selected>Panorama Tours</option>
            <option value='PANORAMA WORLD'>Panorama World</option>
            <option value='SISTER COMPANY'>Sister Company</option>
            </select></td></tr>
          <tr><td>Area</td> <td> <input type=radio name='office_area' value='JAKARTA' checked>&nbsp;Jakarta 
          <input type=radio name='office_area' value='NON JAKARTA'>&nbsp;Non Jakarta</td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;
    
  case "editmsdivision":
    $edit=mysql_query("SELECT * FROM tbl_msoffice WHERE office_id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Division</h2>
          <form method=POST action=./aksi.php?module=msdivision&act=update>
          <input type=hidden name=id value='$r[office_id]'>
          <table>
          <tr><td>Division ID</td> <td>  <input type=text name='office_code' size=30 value='$r[office_code]' readonly></td></tr>
          <tr><td>Division Name</td> <td>  <input type=text name='office_name' size=30 value='$r[office_name]'></td></tr>
          <tr><td>Division Code</td> <td>  <input type=text name='office_key' size=2 value='$r[office_key]' maxsize='2' onkeyup='isNumber(this)'></td></tr>            
          <tr><td>Group</td> <td>  <select name='office_group'>
            <option value='PANORAMA TOURS' ";if($r[office_group]=='PANORAMA TOURS'){echo"selected";}echo">Panorama Tours</option>
            <option value='PANORAMA WORLD' ";if($r[office_group]=='PANORAMA WORLD'){echo"selected";}echo">Panorama World</option>
            <option value='SISTER COMPANY' ";if($r[office_group]=='SISTER COMPANY'){echo"selected";}echo">Sister Company</option>
            </select></td></tr>
          <tr><td>Area</td> <td> <input type=radio name='office_area' value='JAKARTA' ";if($r[office_area]=='JAKARTA'){echo"checked";}echo">&nbsp;Jakarta 
          <input type=radio name='office_area' value='NON JAKARTA' ";if($r[office_area]=='NON JAKARTA'){echo"checked";}echo">&nbsp;Non Jakarta</td></tr>
		  <tr><td colspan=2><center><input type=submit value=Update><input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
	
case "deletedivision":                                                       
$employee_id=$_SESSION[employee_id];
$sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_id='$employee_id'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName = $tampiluser[employee_name];     
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
     $edit=mysql_query("DELETE FROM tbl_msoffice WHERE office_id ='$_GET[id]'"); 
     $Description="Delete Division (".$_GET[div].") "; 
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");             
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msdivision'>";   
     break;
}
?>
