<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>
<script type="text/javascript">
function chMd()
{
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
</script>
<?php 
switch($_GET[act]){
  // Tampil msfaq
  default:
  	$nama=$_GET['nama'];
    echo "<h2>Master FAQ Group</h2>
		  <form method=get action='media.php?'>
		  	<input type=hidden name=module value='msfaq'>
			<input type=text name=nama value='$nama' size=40>	
			<input type=submit name=oke value=Search>
		  </form><input type=button value='Add FAQ Group' onclick=location.href='?module=msfaq&act=tambahmsfaq'>";
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
		    $tampil=mysql_query("SELECT * FROM tbl_msfaq WHERE FaqCategory LIKE '%$nama%' OR FaqGroup LIKE '%$nama%'
						 		 ORDER BY MsFaqID DESC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr>
					  <th>no</th>
					  <th>Group</th>
					  <th>Category</th>
					  <th>Status</th>
					  <th>Action</th>
				  </tr>"; 
				  $no=$posisi+1;
					while ($r=mysql_fetch_array($tampil)){
			   echo "<tr><td>$no</td>
			   			 <td>$r[FaqGroup]</td>
						 <td>$r[FaqCategory]</td>
						 <td align='center'><b>$r[Status]</b></td>
						 <td><b><a href='?module=msfaq&act=editmsfaq&id=$r[MsFaqID]'>EDIT</a></b></td>
					  </tr>";
					  $no++;
					}  //&nbsp;|&nbsp; 
                    // <a href=\"javascript:delfile('$data[IDProductcode]','$data[ProductcodeName]')\">Delete</a> 
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tbl_msfaq WHERE FaqCategory LIKE '%$nama%' OR FaqGroup LIKE '%$nama%'
						 		   ORDER BY MsFaqID DESC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=msfaq";
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
  
  case "tambahmsfaq":
    echo "<h2>New Product Code</h2>
          <form name='example' onsubmit='return validateFormOnSubmit(this)' method='POST' action='./aksi.php?module=msfaq&act=input'>
          <table>
		  	<tr><td width='30%'>Group *</td>
		  	  	<td><input type='radio' name='GrpSelect' value='EXISTING' onClick='chMd()' checked>
					<select name='FaqGroup' id='FaqGroup' required>
						<option value=''>Select Existing Group</option>";
					$GroupData = mysql_query("SELECT DISTINCT(FaqGroup) as FaqGroup FROM tbl_msfaq WHERE Status='ACTIVE'");	
					while($gd=mysql_fetch_array($GroupData)){
					echo "<option value='$gd[FaqGroup]'>$gd[FaqGroup]</option>"; 
					}
	echo "			</select>
					<input type='radio' name='GrpSelect' value='NEW' onClick='chMd()'>
					<input type='text' name='FaqGroup2' id='FaqGroup2' placeholder='Enter New Group Name' value='$_POST[FaqGroup2]' size='50' disabled/>
					</td></tr>
			<tr><td>Category *</td>
		  	  	<td><input type='text' name='FaqCategory' value='$_POST[FaqCategory]' size='50' required/></td></tr>
		  </table>
          <center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()>         
          </form><br><br>";
  break;
    
  case "editmsfaq":
    $edit = mysql_query("SELECT * FROM tbl_msfaq WHERE MsFaqID = '$_GET[id]'");
	$r    = mysql_fetch_array($edit);

    echo "<h2>Edit FAQ</h2>
          <form name='example' onsubmit='return validateFormOnSubmit(this)' method=POST action=./aksi.php?module=msfaq&act=update>
          <input type='hidden' name='id' value='$_GET[id]' />
		  <table class='list'>
		  	<tr><td class='left' width='30%'>Group *</td>
		  	  	<td>$r[FaqGroup]
				<!--
				<input type='radio' name='GrpSelect' value='EXISTING' onClick='chMd()' checked>
					<select name='FaqGroup' id='FaqGroup' required>
						<option value=''>Select Existing Group</option>";
					$GroupData = mysql_query("SELECT DISTINCT(FaqGroup) as FaqGroup FROM tbl_msfaq WHERE Status='ACTIVE'");	
					while($gd=mysql_fetch_array($GroupData)){
						if($r[FaqGroup]==$gd[FaqGroup]){
							echo "<option value='$gd[FaqGroup]' selected>$gd[FaqGroup]</option>"; 
						}
						else{
							echo "<option value='$gd[FaqGroup]'>$gd[FaqGroup]</option>"; 
						}
					}
	echo "			</select>
					
					<input type='radio' name='GrpSelect' value='NEW' onClick='chMd()'>
					<input type='text' name='FaqGroup2' id='FaqGroup2' placeholder='Enter New Group Name' value='$_POST[FaqGroup2]' size='50' disabled/>
					-->
					</td></tr>
			<tr><td class='left'>Category *</td>
		  	  	<td><input type='text' name='FaqCategory' value='$r[FaqCategory]' size='50' required/></td></tr>
			<tr><td class='left'>Status</td>
		  	  	<td><select name='Status' required>
						<option value='ACTIVE' "; if($r[Status]=='ACTIVE'){echo"selected";} echo">ACTIVE</option>
						<option value='INACTIVE' "; if($r[Status]=='INACTIVE'){echo"selected";} echo">INACTIVE</option>
					</select></td></tr>
		  </table>
    <center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()>
          </form>";
    break;  
	
} 
?>
