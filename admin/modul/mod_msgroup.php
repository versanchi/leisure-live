<script language="JavaScript"  type="text/javascript">     
function delfile(ID, Group)         
{
if (confirm("Are you sure you want to delete "+ Group +" "))
{
 window.location.href = '?module=msgroup&act=deletegroup&id=' + ID +'&grup='+ Group ;
 
} 
}
</script>    
<?php 
switch($_GET[act]){
  // Tampil Country
  default:
  	$nama=$_GET['nama'];
    echo "<h2>Master Product Type</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='msgroup'>
			  <input type=text name=nama value='$nama' size=40>	
			  <input type=submit name=oke value=Search>
		  </form><input type=button value='Add Type' onclick=location.href='?module=msgroup&act=tambahgroup'>";
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
		    $tampil=mysql_query("SELECT * FROM tour_msgroup 
								WHERE GroupName LIKE '%$nama%' 
								ORDER BY Status, GroupName ASC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>Product Type</th><th>Status</th><th>action</th></tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
			   echo "<tr><td>$no</td>         
                     <td>$data[GroupName]</td>
					 <td>$data[Status]</td>
					 <td><center><a href=?module=msgroup&act=editgroup&id=$data[IDGroup]>Edit</a>
					 
					 </td></tr>";
					  $no++;
					}    //&nbsp;|&nbsp; 
                    // <a href=\"javascript:delfile('$data[IDGroup]','$data[GroupName]')\">Delete</a> 
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tour_msgroup 
                                WHERE GroupName LIKE '%$nama%' 
                                ORDER BY GroupName ASC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=msgroup";
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
  
  case "tambahgroup":
    echo "<h2>New Type</h2>
          <form method=POST action='./aksi.php?module=msgroup&act=input'>
          <table>                                                                                    
          <tr><td>Product Type</td><td><input type=text name='GroupName'></td></tr> 
          <tr><td>Status</td><td><input type=radio name='Status' value='ACTIVE' checked>&nbsp;Active
            <input type=radio name='Status' value='INACTIVE'>&nbspInactive</td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table>
          </form><br><br>";
     break;
    
  case "editgroup":
    $edit=mysql_query("SELECT * FROM tour_msgroup WHERE IDGroup='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Type</h2>
          <form name='example' method=POST action=./aksi.php?module=msgroup&act=update>
          <input type=hidden name=id value='$r[IDGroup]'>
          <table>                                                                                                        
          <tr><td>Product Type</td><td><input type=text name='GroupName' value='$r[GroupName]' readonly></td></tr>
          <tr><td>Status</td><td><input type=radio name='Status' value='ACTIVE' ";if($r[Status]=='ACTIVE'){echo"checked";}echo">&nbsp;Active
            <input type=radio name='Status' value='INACTIVE' ";if($r[Status]=='INACTIVE'){echo"checked";}echo">&nbspInactive</td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table>
          </form>";
    break;  
	
  case "deletegroup":
    $employee_id=$_SESSION[employee_id];
$sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_id='$employee_id'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName = $tampiluser[employee_name];     
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
     $edit=mysql_query("DELETE FROM tour_msgroup WHERE IDGroup ='$_GET[id]'"); 
     $Description="Delete Group (".$_GET[grup].") "; 
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");             
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msgroup'>";   
     break;
} 
?>
