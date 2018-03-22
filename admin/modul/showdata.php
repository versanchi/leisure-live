<?php
include "../../config/koneksi.php";
$grp = $_GET['grp'];
	if($grp!='' or !empty($grp)){
		echo "<select name='MsFaqID' required>
				<option value=''>Select Reason Type</option>";
				  $getGroup=mysql_query("SELECT MsFaqID, FaqCategory FROM tbl_msfaq
										 WHERE Status='ACTIVE' and FaqGroup='$grp'
										 ORDER BY FaqCategory ASC");
				  while($gg=mysql_fetch_array($getGroup)){
					  echo"<option value='$gg[MsFaqID]'>$gg[FaqCategory]</option>";
				  }
		echo "</select>";		
	}
	else{
		echo "<font color='#FF0000'>Please Select FAQ Group</font>";
	}
?>