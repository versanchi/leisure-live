<?php 
switch($_GET[act]){
  // Tampil Country
  default:
  	$nama=$_GET['nama'];
	$datenow = date("d", time());
    $monthnow = date("m", time());
	$yearnow = date("Y", time());
	$today = $yearnow."-".$monthnow."-".$datenow;
	$fdreq = $_GET['fromdate'];
	$tdreq = $_GET['todate'];
	
	if ($fdreq==0) {
		$fdreq = $today;
		$tdreq = $today;
	}
	
    echo "<h2>View Log</h2>
		  <form name='searchtrans' method=GET action='media.php?module=log'>
		  	  <input type=hidden name=module value='log'>
			  <font size='2' face='Arial, Helvetica, sans-serif'>From : <input type=text name='fromdate' size=15  value='$fdreq'><A HREF='#' onClick="."cal.select(document.forms['searchtrans'].fromdate,'anchor1','yyyy-MM-dd'); return false;"." NAME='anchor1' ID='anchor1'>select</A></font>
			  &nbsp;
		  	  &nbsp;
			  <font size='2' face='Arial, Helvetica, sans-serif'>To : <input type=text name='todate' size=15  value='$tdreq'><A HREF='#' onClick="."cal.select(document.forms['searchtrans'].todate,'anchor2','yyyy-MM-dd'); return false;"." NAME='anchor2' ID='anchor2'>select</A></font>
			  <br>
			  <font size='2' face='Arial, Helvetica, sans-serif'>Search : <input type=text name='nama' value='$nama' size=57></font>
			  <br>
			  <input type=submit name=oke value=Search>
		  </form>";
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
		    $tampil=mysql_query("SELECT * FROM tbl_logtour 
								WHERE employee_name LIKE '%$nama%' AND LEFT(LogTime, 10) >= '$fdreq' AND LEFT(LogTime, 10) <= '$tdreq'
								ORDER BY LogTime DESC, LogID DESC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>log time</th><th>Employee</th><th>description</th></tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
			   echo "<tr><td>$no</td>
			   		 <td>$data[LogTime]</td>
					 <td>$data[employee_name]</td>
					 <td>$data[Description]</td>
					 </tr>";
					  $no++;
					}
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tbl_logtour 
								WHERE employee_name LIKE '%$nama%' AND LEFT(LogTime, 10) >= '$fdreq' AND LEFT(LogTime, 10) <= '$tdreq'
								ORDER BY LogTime DESC, LogID DESC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=log";
					// Link ke halaman sebelumnya (previous)
					echo "<p><div id='paging'>";
					if ($halaman >1) {
						$previous = $halaman-1;
						echo "<a href=$file&halaman=1&fromdate=$fdreq&todate=$tdreq&nama=$nama&oke=$oke> << First</a> |
	    					  <a href=$file&halaman=$previous&fromdate=$fdreq&todate=$tdreq&nama=$nama&oke=$oke> < Previous</a> | ";
					} else {
						echo "<< First | < Previous | ";
					}
					// Tampilkan link halaman 1,2,3 ... modifikasi ala google
					// Angka awal
					$angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
					for ($i=$halaman-2; $i<$halaman; $i++) {
						if ($i < 1 )
							continue;
						$angka .= "<a href=$file&halaman=$i&fromdate=$fdreq&todate=$tdreq&nama=$nama&oke=$oke>$i</a> ";
					}
					// Angka tengah
					$angka .= " <b>$halaman</b> ";
					for ($i=$halaman+1; $i<($halaman+3); $i++) {
						if ($i > $jmlhalaman)
							break;
						$angka .= "<a href=$file&halaman=$i&fromdate=$fdreq&todate=$tdreq&nama=$nama&oke=$oke>$i</a> ";	
					}
					// Angka akhir
					$angka .= ($halaman+2<$jmlhalaman ? " ...
						<a href=$file&halaman=$jmlhalaman&nama=$nama&oke=$oke>$jmlhalaman</a> |" : " ");
					// Cetak angka seluruhnya (awal, tengah, akhir)
					echo "$angka";
					// Link ke halaman berikutnya (Next)
					if ($halaman < $jmlhalaman) {
						$next = $halaman+1;
						echo "<a href=$file&halaman=$next&fromdate=$fdreq&todate=$tdreq&nama=$nama&oke=$oke> Next ></a> |
	    					  <a href=$file&halaman=$jmlhalaman&fromdate=$fdreq&todate=$tdreq&nama=$nama&oke=$oke> Last >></a> ";
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
  
}
?>
