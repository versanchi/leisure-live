<script language="JavaScript"  type="text/javascript">     
function delfile(ID, Producttype)         
{
if (confirm("Are you sure you want to delete "+ Producttype +" "))
{
 window.location.href = '?module=msrate&act=deleteproducttype&id=' + ID +'&type='+ Producttype ;
 
} 
}
</script>    
<?php 
switch($_GET[act]){
  // Tampil Country
  default:
  	$nama=$_GET['nama'];
    echo "<h2>Master Rate</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='msrate'>
			  <input type=text name=nama value='$nama' size=40>	
			  <input type=submit name=oke value=Search>
		  </form><input type=button value='Add Product Type' onclick=location.href='?module=msrate&act=tambahrate'>";
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
		    $tampil=mysql_query("SELECT * FROM tour_msrate 
								WHERE CurrQuotation LIKE '%$nama%' 
								ORDER BY CurrQuotation ASC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>Curr Quotation</th><th>Curr Selling</th><th>Operator</th><th>Amount</th><th>action</th></tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
			   echo "<tr><td>$no</td>         
                     <td>$data[CurrQuotation]</td>
                     <td>$data[CurrSelling]</td>
                     <td>$data[Operator]</td>
                     <td>$data[Amount]</td>
					 <td><center><a href=?module=msrate&act=editrate&id=$data[IDRate]>Edit</a>
					  
					 </td></tr>";
					  $no++;
					}     //&nbsp;|&nbsp; 
                     //<a href=\"javascript:delfile('$data[IDProducttype]','$data[ProducttypeName]')\">Delete</a>
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tour_msrate 
                                WHERE CurrQuotation LIKE '%$nama%' 
                                ORDER BY CurrQuotation ASC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=msrate";
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
  
  case "tambahrate":
    echo "<h2>New Rate</h2>
          <form method=POST action='./aksi.php?module=msrate&act=input'>
          <table>                                                                                    
          <tr><td>Curr Quotation</td><td><input type=text name='currquotation'></td></tr>
          <tr><td>Curr Selling</td><td><input type=text name='currselling'></td></tr> 
          <tr><td>Operator</td><td><input type=text name='operator'></td></tr>
          <tr><td>Amount</td><td><input type=text name='Amount'></td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table>
          </form><br><br>";
     break;
    
  case "editrate":
    $edit=mysql_query("SELECT * FROM tour_msrate WHERE IDRate='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Product Type</h2>
          <form name='example' method=POST action=./aksi.php?module=msrate&act=update>
          <input type=hidden name=id value='$r[IDRate]'>
          <table>                                                                                                        
          <tr><td>Curr Quotation</td><td><input type=text name='currquotation' value='$r[CurrQuotation]'></td></tr>
          <tr><td>Curr Selling</td><td><input type=text name='currquotation' value='$r[CurrSelling]'></td></tr> 
          <tr><td>Operator</td><td><input type=text name='operator' value='$r[Operator]'></td></tr> 
          <tr><td>Amount</td><td><input type=text name='Amount' value='$r[Amount]'></td></tr> 
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table>
          </form>";
    break;  
	
  case "deleterate":
    $EmployeeID=$_SESSION[employeeid];
$sqluser=mysql_query("SELECT EmployeeName FROM tbl_msemployee WHERE EmployeeID='$EmployeeID'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName = $tampiluser[EmployeeName];     
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
     $edit=mysql_query("DELETE FROM tour_msrate WHERE IDRate ='$_GET[id]'"); 
     $Description="Delete Rate (".$_GET[type].") "; 
     mysql_query("INSERT INTO tour_log(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");             
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msrate'>";   
     break;
} 
?>
