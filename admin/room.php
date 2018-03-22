<SCRIPT LANGUAGE="JavaScript" SRC="../config/CalendarPopup.js"></SCRIPT>               
<script type="text/javascript" src="../config/jquery.js"></script>            
<script type="text/javascript" src="../head/jquery-1.3.2.min.js"></script>         
<SCRIPT LANGUAGE="JavaScript">
    var cal = new CalendarPopup(); 
</SCRIPT>
 <script language="javascript" type="text/javascript">
    function updatepage()
    {
        window.close();
        window.opener.location.reload();
    }
    function validateFormOnSubmit(theForm) {
var reason = "";                            
  reason += validateEmpty(theForm.newtotalroom);      
  if (reason != "") {
    alert("WARNING:\n" + reason);
    return false;
  }

  return true;
}

function validateEmpty(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        fld.style.background = 'Yellow'; 
        error = "PLEASE INPUT TOTAL ROOM"
    } else {
        fld.style.background = 'White';
    }
    return error;  
}
function isNumber(field) {
var re = /^[0-9'.']*$/;
if (!re.test(field.value)) {
alert('PLEASE INPUT NUMBER!');
field.value = field.value.replace(/[^0-9'.']/g,"");
}
}
</script>
                 
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" /> 
<?php 
include "../config/koneksi.php";
$username=$_SESSION[employee_code];
$sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_code='$username'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName=$tampiluser[employee_name];
$today = date("Y-m-d G:i:s");    
switch($_GET[act]){
  // Tampil Office
  default:
  	
    $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $depdate = substr($r[DateTravelFrom],8,2);         
    echo "<h2>CHANGE TOTAL ROOM</h2>    
          <form method=POST name='example' onsubmit='return validateFormOnSubmit(this)' action='?module=room&act=save'>
          <input type='hidden' name='prodid' value='$r[IDTourcode]'><input type='hidden' name='id' value='$r[BookingID]'>
          <input type='hidden' name='tolold' value='$r[TotalRoom]'>";
            echo "<center><table>
                    
          <tr><td>$r[TotalRoom] Room <font color=blue><b>CHANGE TO </b></font><input type='text' name='newtotalroom' size='2' onkeyup='isNumber(this)'> Room</td></tr>
          </table>   
          <input type='submit' name='submits' value='UPDATE' >
          </form>";
     break;  
  
  case "save":
  $TourCode=strtoupper($_POST[newtourcode]);                        
  $Description="Change Total Room '$_POST[id]' from '$_POST[totold]' to '$_POST[newtotalroom]'";
  $roomAkhir = mysql_query("SELECT CONVERT(RoomNo, UNSIGNED INTEGER) as urut FROM tour_msbookingdetail where IDtourcode = '$_POST[prodid]' and RoomNo !='' order by urut desc limit 1 ");
  $droomAkhir=mysql_fetch_array($roomAkhir);
  $kuery = mysql_query("SELECT * FROM tour_msproduct where IDProduct = '$_POST[prodid]'");
  $dapet = mysql_fetch_array($kuery);
  $ada = mysql_num_rows($kuery);
  $startroom=$droomAkhir[urut]+1;
  $endroom=$droomAkhir[urut]+$_POST[newtotalroom];
  //$startroom=$dapet[Room]+1;
  //$endroom=$dapet[Room]+$_POST[newtotalroom];
  mysql_query("UPDATE tour_msproduct set Room = '$endroom'
                                        WHERE IDProduct = '$_POST[prodid]'");
  mysql_query("UPDATE tour_msbooking set StartRoom = '$startroom',
                                        EndRoom = '$endroom',
                                        TotalRoom = '$_POST[newtotalroom]'
                                        WHERE BookingID = '$_POST[id]'");
  mysql_query("UPDATE tour_msbookingdetail set RoomNo = '$startroom'
                                            WHERE BookingID = '$_POST[id]'");
  mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                               Description,
                               LogTime)
                        VALUES ('$EmpName',
                               '$Description',
                               '$today')");
  ?>
  <script language='javascript' type='text/javascript'>
    updatepage();
   
</script>  <?php 
}
?>
