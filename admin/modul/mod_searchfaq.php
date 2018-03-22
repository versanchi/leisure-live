<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>

<?php 
switch($_GET[act]){
  default:
  	$nama=$_GET['nama'];
    echo "<h2>FAQ</h2>
		  <form method=get action='media.php?'>
		  	<input type=hidden name=module value='searchfaq'>
			<input type=text name=nama value='$nama' size=40>	
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
		    $tampil=mysql_query("SELECT FaqID, FaqGroup, FaqCategory, Answer, Question, FAQ.Status FROM tbl_faq FAQ
								 INNER JOIN tbl_msfaq MSF ON FAQ.MsFaqID=MSF.MsFaqID
									WHERE Question LIKE '%$nama%' OR Answer LIKE '%$nama%' OR
										  FaqCategory LIKE '%$nama%' OR FaqGroup LIKE '%$nama%'
								 ORDER BY FaqID DESC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr>
					  <th>no</th>
					  <th>FAQ Group</th>
					  <th>FAQ Category</th>
					  <th>Question</th>
					  <th>Answer</th>
					  <th>Status</th>
					  <th>Action</th>
				  </tr>"; 
				  $no=$posisi+1;
			while ($r=mysql_fetch_array($tampil)){
				$isi_Answer= htmlentities(strip_tags($r['Answer']));
				$Answer = substr($isi_Answer,0,30); 					//ambil 350 karakter
				$Answer = substr($isi_Answer,0,strrpos($Answer," "));	//per spasi
	
				$isi_Que= htmlentities(strip_tags($r['Question']));
				$Question = substr($isi_Que,0,30); 						//ambil 350 karakter
				$Question = substr($isi_Que,0,strrpos($Question," "));	//per spasi
				if($r[DateCreate]=="0000-00-00"){$DateCreate="";} else{ $DateCreate = date("l, d M Y", strtotime($r[DateCreate]));}
			   echo "<tr><td>$no</td>
			   			 <td>$r[FaqGroup]</td>
						 <td>$r[FaqCategory]</td>
						 <td>$Question...</td>
						 <td>$Answer...</td>
						 <td align='center'><b>$r[Status]</b></td>
						 <td><b><a href='?module=searchfaq&act=viewsearchfaq&id=$r[FaqID]'>VIEW</a></b></td>
					  </tr>";
					  $no++;
					}  //&nbsp;|&nbsp; 
                    // <a href=\"javascript:delfile('$data[IDProductcode]','$data[ProductcodeName]')\">Delete</a> 
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT FaqID, FaqGroup, FaqCategory, Answer, Question, FAQ.Status FROM tbl_faq FAQ
								   INNER JOIN tbl_msfaq MSF ON FAQ.MsFaqID=MSF.MsFaqID
									  WHERE Question LIKE '%$nama%' OR Answer LIKE '%$nama%' OR
											FaqCategory LIKE '%$nama%' OR FaqGroup LIKE '%$nama%'
								   ORDER BY FaqID DESC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=faq";
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

  case "viewsearchfaq":
    $edit = mysql_query("SELECT FaqID, FaqGroup, FaqCategory, Answer, Question, FAQ.Status FROM tbl_faq FAQ
						 INNER JOIN tbl_msfaq MSF ON FAQ.MsFaqID=MSF.MsFaqID
						 WHERE FaqID='$_GET[id]'");
	$r    = mysql_fetch_array($edit);
	echo"<h2>View FAQ</h2>
		<table>
		  <tr><td width='100px'>FAQ Group</td>	<td>$r[FaqGroup]</td></tr>
		  <tr><td>FAQ Category</td>				<td>$r[FaqCategory]</td></tr>
		  <tr><td>Question</td>					<td>$r[Question]</td></tr>
		  <tr><td>Answer</td>						<td>$r[Answer]</td></tr>
		  <tr><td>Status</td>						<td>$r[Status]</td></tr>
		  <tr><td colspan='2' align='center'><input type='button' value='CANCEL' onclick='self.history.back()'></td></tr>
		</table>";
  break;
} 
?>
