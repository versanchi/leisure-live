<SCRIPT language='Javascript'>
	function showTC(obj)  
	 {           
		var input = document.getElementById('textboxTC');
		input.value = obj.value;
		var aSuppID = input.value;
	 }
	 
	 function editpage()
     {  
	 	//get combobox value 
		var e = document.getElementById('TourLeaderCode');
		var myTC = e.options[e.selectedIndex].value;
		
		if(myTC==''){
			alert("Please Select Tour Code");
			return false;
		}
		
		textboxTC 	= document.getElementById('textboxTC').value;
		window.opener.location.href='../admin/media.php?module=questioner&act=tambahquestioner&id='+textboxTC                                                                    
        window.close();   
     }
</script>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="css/button.css" rel="stylesheet" type="text/css" />
<?php
session_start();
include "../config/koneksi.php";

switch($_GET[act]){
  default:
  	include "../../config/koneksi_dbvisa.php";
  	echo	"<form method=POST action='../admin/media.php?module=questioner&act=tambahquestioner'>
		 <table class='list'>
		  <tbody>
		    <tr>
				<td class='center'>
					<select name='TourLeaderCode' id='TourLeaderCode' onChange='showTC(this)' required>
							<option value='' selected>- SELECT TOUR CODE -</option>";
			$result = mysql_query("SELECT IDProduct, TourCode, Year, TourLeader FROM tour_msproduct
								   WHERE SeatDeposit > 0 AND DateTravelFrom BETWEEN DATE_SUB(CURDATE(), INTERVAL 360 DAY) AND CURDATE()
								   AND ((TourLeaderInc='YES' AND TourLeader<>'') OR (TourLeaderInc='NO'))
                                   ORDER BY TourCode DESC");
					while ($row = mysql_fetch_array($result)) {  
						echo "<option value='$row[IDProduct]'>$row[TourCode]</option>";
					}
					echo "</select>
					<input type='hidden' name='textboxTC' id='textboxTC' />
				</td>
			</tr>
			<tr>
				<td class='center'>
					<!--<input type=submit value='SUBMIT' class='button'>-->
					<input type=button value='SUBMIT' class='button' onclick=editpage()>
					<input type=button value='CLOSE' class='button' onclick='self.close()'>
				</td>
			</tr>
		  </tbody>
		</table>";
  break;
  
  case "addDetail":
	echo "";
  break;
  
  }
?>