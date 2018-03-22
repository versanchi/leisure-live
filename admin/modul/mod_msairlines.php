<script language="JavaScript"  type="text/javascript">     
function delfile(ID, Airlines)         
{
if (confirm("Are you sure you want to delete "+ Airlines +" "))
{
 window.location.href = '?module=msairlines&act=deleteairlines&id=' + ID +'&air='+ Airlines ;
 
} 
}
</script>    
<?php 
switch($_GET[act]){
  // Tampil Country
  default:
  	$nama=$_GET['nama'];
    echo "<h2>Master Airlines</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='msairlines'>
			  <input type=text name=nama value='$nama' size=40>	
			  <input type=submit name=oke value=Search>
		  </form><input type=button value='Add Airlines' onclick=location.href='?module=msairlines&act=tambahairlines'>";
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
		    $tampil=mysql_query("SELECT * FROM tour_msairlines 
								WHERE AirlinesID LIKE '%$nama%'
                                OR AirlinesName LIKE '%$nama%' 
								ORDER BY AirlinesID ASC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>Airlines ID</th><th>Airlines Name</th><th>action</th></tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
			   echo "<tr><td>$no</td>
					 <td><center>$data[AirlinesID]</td>
                     <td>$data[AirlinesName]</td>
					 <td><center><a href=?module=msairlines&act=editairlines&id=$data[IDAirlines]>Edit</a>
					 &nbsp;
					 </td></tr>";
					  $no++;
					}  //|&nbsp; 
                    // <a href=\"javascript:delfile('$data[IDAirlines]','$data[AirlinesName]')\">Delete</a> 
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tour_msairlines 
                                WHERE AirlinesID LIKE '%$nama%'
                                OR AirlinesName LIKE '%$nama%' 
                                ORDER BY AirlinesID ASC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=msairlines";
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
  
  case "tambahairlines":
    echo "<h2>New Airlines</h2>
          <form method=POST action='./aksi.php?module=msairlines&act=input'>
          <table>
          <tr><td>Airlines ID</td><td><input type=text name='AirlinesID' maxlength='2' size='4'></td></tr>
          <tr><td>Airlines Name</td><td><input type=text name='AirlinesName'></td></tr> 
          <tr><td>Status</td> <td><select name='AirlinesStatus'>    
            <option value='ACTIVE' selected>Active</option>
            <option value='INACTIVE' >Inactive</option>   
            </select></td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table>
          </form><br><br>";
     break;
    
  case "editairlines":
    $edit=mysql_query("SELECT * FROM tour_msairlines WHERE IDAirlines='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Airlines</h2>
          <form name='example' method=POST action=./aksi.php?module=msairlines&act=update>
          <input type=hidden name=id value='$r[IDAirlines]'>
          <table>
          <tr><td>Airlines ID</td><td><input type=text name='AirlinesID' value='$r[AirlinesID]' maxlength='2' size='4'></td></tr>
          <tr><td>Airlines Name</td><td><input type=text name='AirlinesName' value='$r[AirlinesName]'></td></tr>
          <tr><td>Status</td> <td><select name='AirlinesStatus'>    
            <option value='ACTIVE' ";if($r[AirlinesStatus]=='ACTIVE'){echo"selected";}echo">Active</option>
            <option value='INACTIVE' ";if($r[AirlinesStatus]=='INACTIVE'){echo"selected";}echo">Inactive</option>   
            </select></td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table>
          </form>";
    break;  
	
  case "deleteairlines":
    $employee_code=$_SESSION[employee_code];
$sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_code='$employee_code'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName = $tampiluser[employee_name];     
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
     $edit=mysql_query("DELETE FROM tour_msairlines WHERE IDAirlines ='$_GET[id]'"); 
     $Description="Delete Airlines (".$_GET[air].") "; 
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");             
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msairlines'>";   
     break;
} 
?>
