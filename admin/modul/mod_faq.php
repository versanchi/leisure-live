<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>
<script type="text/javascript">
function chMd(){
	for(var i=0;i<document.forms[0].elements.length;i++){
		if(document.forms[0].elements[i].value=="EXISTING"){
		   if(document.forms[0].elements[i].checked==true){
			  document.getElementById('FaqGroup').disabled=false;
			  document.getElementById('FaqGroup').required=true;
			  document.getElementById('FaqGroup2').disabled=true;
			  document.getElementById('FaqGroup2').value="";
		   }
		 }
		else if(document.forms[0].elements[i].value=="NEW"){
		  if(document.forms[0].elements[i].checked==true){
			 document.getElementById('FaqGroup').disabled=true;
			  document.getElementById('FaqGroup').selectedIndex=0;
			  document.getElementById('FaqGroup').required=false;
			 document.getElementById('FaqGroup2').disabled=false;
			 document.getElementById('FaqGroup2').required=true;
		   }
		 }
	}
}

function showUser(str) {
  if (str == "") {
	document.getElementById("combGroup").innerHTML = "";
	return;
  }else { 
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	}
	else{
		// code for IE6, IE5
	  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
	  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		document.getElementById("combGroup").innerHTML = xmlhttp.responseText;
	  }
	}
	xmlhttp.open("GET","modul/showdata.php?grp="+str,true);
	xmlhttp.send();
  }
}
</script>
<?php 
switch($_GET[act]){
  default:
  	$nama=$_GET['nama'];
    echo "<h2>FAQ</h2>
		  <form method=get action='media.php?'>
		  	<input type=hidden name=module value='faq'>
			<input type=text name=nama value='$nama' size=40>	
			<input type=submit name=oke value=Search>
		  </form><input type=button value='Add New FAQ' onclick=location.href='?module=faq&act=tambahfaq'>";
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
						 <td><b><a href='?module=faq&act=editfaq&id=$r[FaqID]'>EDIT</a></b></td>
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

  case "tambahfaq":
    echo "<h2>Add New FAQ</h2>
          <form name='example' method='POST' action='./aksi.php?module=faq&act=input'>
           <table class='list'>
		  	<tr><td class='left' width='20%'>FAQ Group *</td>
		  	  	<td><select name='FaqGroup' onchange='showUser(this.value)' required>
						<option value=''>Select Reason Type</option>";
					$getGroup=mysql_query("SELECT MsFaqID, FaqGroup FROM tbl_msfaq WHERE Status='ACTIVE'
										   GROUP BY FaqGroup ORDER BY FaqGroup ASC");
					while($gg=mysql_fetch_array($getGroup)){
						echo"<option value='$gg[FaqGroup]'>$gg[FaqGroup]</option>";
					}
			  echo "</select></td></tr>
			<tr><td class='left'>FAQ Category *</td>
		  	  	<td><div id='combGroup'><font color='#FF0000'>Please Select FAQ Group</font></div></td></tr>
			<tr><td>Question</td>
		   	   <td><textarea name='Question' style='width:500px;height:100px;'>$_POST[Question]</textarea></td>
			</tr>
			<tr><td>Answer</td>
		   	    <td><textarea name='Answer' style='width:500px;height:100px;'>$_POST[Answer]</textarea></td>
			</tr>
		  </table>
          <center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()>         
          </form><br><br>";
  break;

  case "editfaq":
   $edit = mysql_query("SELECT FaqID, FaqGroup, FaqCategory, Answer, Question, FAQ.Status FROM tbl_faq FAQ
							INNER JOIN tbl_msfaq MSF ON FAQ.MsFaqID=MSF.MsFaqID
   						WHERE FaqID = '$_GET[id]'");
	$r    = mysql_fetch_array($edit);
    echo "<h2>Edit FAQ</h2>
          <form name='example' onsubmit='return validateFormOnSubmit(this)' method=POST action=./aksi.php?module=faq&act=update>
          <input type='hidden' name='id' value='$_GET[id]' />
		  <table class='list'>
		  	<tr><td class='left' width='20%'>FAQ Group</td> <td>$r[FaqGroup]</td></tr>
			<tr><td class='left'>FAQ Category</td> <td>$r[FaqCategory]</td></tr>
			<tr><td>Question</td>
		   	   <td><textarea name='Question' style='width:500px;height:100px;'>$r[Question]</textarea></td>
			</tr>
			<tr><td>Answer</td>
		   	   <td><textarea name='Answer' style='width:500px;height:100px;'>$r[Answer]</textarea></td>
			</tr>
			<tr><td class='left'>Status</td>
		  	  	<td><select name='Status' required>
						<option value='ACTIVE' "; if($r['Status']=='ACTIVE'){echo"selected";} echo">ACTIVE</option>
						<option value='INACTIVE' "; if($r['Status']=='INACTIVE'){echo"selected";} echo">INACTIVE</option>
					</select></td></tr>
		  </table>
    		<center><input type='submit' value='Save'>
            		<input type='button' value='Cancel' onclick=self.history.back()>
          </form>";
  break;
} 
?>
