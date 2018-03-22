<SCRIPT LANGUAGE="JavaScript" SRC="../config/CalendarPopup.js"></SCRIPT>               
<script type="text/javascript" src="../config/jquery.js"></script>            
<script type="text/javascript" src="../head/jquery-1.3.2.min.js"></script>         
<SCRIPT LANGUAGE="JavaScript">
    var cal = new CalendarPopup(); 
</SCRIPT>
<script type="text/javascript">
    setTimeout(window.close, 30000);
</script>
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
//include "../config/koneksisql.php";
/*$dbHost = "10.10.200.3\INS";
$dbUsername = "sa";
$dbPassword = "Entertain04";
$dbDatabase = "PTES";

$db = mssql_connect($dbHost, $dbUsername, $dbPassword) or die ("Unable to connect to Database PTES.");
mssql_select_db ($dbDatabase, $db) or die ("Could not select database.");*/
$username=$_GET[emp];
include "../config/koneksimaster.php";
$sqluser=mssql_query("SELECT DivisiNO,Employee.DivisiID,EmployeeID,Category,EmployeeName,CompanyGroup,LTMAuthority,ClientNo FROM [HRM].[dbo].[Employee]
                  inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                  WHERE EmployeeID = '$username'");
$tampiluser=mssql_fetch_array($sqluser);
$EmpName=$tampiluser[EmployeeName];
$clientnumber = explode("-", $tampiluser[ClientNo]);
$clientno = $clientnumber[0];
$today = date("Y-m-d G:i:s");
mssql_close($link);
include "../config/koneksisql.php";
$divq=mssql_query("SELECT * FROM ClientsDetails
                  WHERE ClientID = '$clientno'");
$divclient=mssql_fetch_array($divq);

switch($_GET[act]){
  // Tampil Office
  default:
  	$depid=$_POST[depid];
    if($depid==''){$depid=$_POST[depno];}
    $depcurr=$_POST[depcurr];
    $depamount=$_POST[depamount];
    $depada=$_POST[depada];
    $duplicate=$_POST[duplicate];
    $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $depdate = substr($r[DateTravelFrom],8,2);
    if($depada=='' OR $depada == 'tidak'){$ok='disabled';}else{$ok='enabled';}
    if($depada==''){$gbr='';}
    elseif($depada == 'bisa')
    {
        if($duplicate == 'iya'){$gbr="<font color='red'>IS DUPLICATE.</font>";$duplicatestatus='YES';}
        else
        {$gbr="<img src='./modul/tick.gif' align='absmiddle'>";$duplicatestatus='NO';}
    }
    else
    {$gbr="<font color='red'>NOT FOUND.</font>";}

    echo "<h2>UPDATE DEPOSIT NO</h2>
          <form method=POST name='example' action='deposit.php?act=check'>
          <input type='hidden' name='id' id='id' value='$r[BookingID]'><input type='hidden' name='category' value='$divclient[PaymentType]'>
          <input type='text' name='depno' id='depno' placeholder='CSRxx-xxxxxxx'> <input type='submit' name='submits' value='CHECK' >
          </form>
          <form method=POST name='example' action='deposit.php?act=save'>
          <input type='hidden' name='id' id='id' value='$_POST[bookid]'><input type='hidden' name='dupstatus' value='$duplicatestatus'>";
    echo "<center><table style='border:0px'>
          <tr><td style='border:0px'>Deposit</td> <td style='border:0px'>: <input type='text' name='depositno' id='depositno' value='$depid' style='border:0px' readonly>
          &nbsp$gbr</td></tr>
          <tr><td style='border:0px'>Amount</td> <td style='border:0px'>: <input type='text' name='depositcurr' id='depositcurr' value='$depcurr' readonly size='3' style='border:0px'>
          ".number_format($depamount, 2, ',', '.');echo"
          <input type='hidden' name='depositamount' id='depositamount' size='14' style='border:0px' value='$depamount' ></td></tr>
          </table>
          <input type='submit' name='submits' value='UPDATE' $ok>
          </form>";
     break;  
  
  case "save":
  $nocsr=substr($_POST[deposit],0,3);
  $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_POST[id]'");
  $r=mysql_fetch_array($edit);
  $deplama=$r[DepositNo];
  if($r[DepositNo]==''){
      mysql_query("UPDATE tour_msbooking set BookingStatus = 'DEPOSIT',
                                              Duplicate = '$_POST[dupstatus]',
                                              DepositNo = '$_POST[depositno]',
                                              DepositCurr = '$_POST[depositcurr]',
                                              DepositAmount = '$_POST[depositamount]'
                                        WHERE BookingID = '$_POST[id]'");
      mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = '$_POST[id]'
                                                WHERE [CashReceiptId] = '$_POST[depositno]' AND [COMPANYID]= '$r[TCCompany]' ");
  }else{
      mysql_query("UPDATE tour_msbooking set DepositNo = '$_POST[depositno]',
                                              Duplicate = '$_POST[dupstatus]',
                                              DepositCurr = '$_POST[depositcurr]',
                                              DepositAmount = '$_POST[depositamount]'
                                        WHERE BookingID = '$_POST[id]'");
      $cekduplicate=mysql_query("SELECT * FROM tour_msbooking WHERE DepositNo = '$deplama' and Status = 'ACTIVE' limit 1");
      $jumlahduplicate=mysql_num_rows($cekduplicate);
      $hasilduplicate=mysql_fetch_array($cekduplicate);
      if($jumlahduplicate>0){
          mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = '$hasilduplicate[BookingID]'
                                                WHERE [CashReceiptId] = '$deplama'");
      }else if($jumlahduplicate<1){
          mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = NULL
                                                WHERE [CashReceiptId] = '$deplama'");
      }
      mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = '$_POST[id]'
                                                WHERE [CashReceiptId] = '$_POST[depositno]' AND [COMPANYID]= '$r[TCCompany]' ");
  }

  $Description="Input Deposit No $_POST[depositno] ($_POST[id]:$deplama)";
  mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('$EmpName',
                                   '$Description',
                                   '$today')");
  ?>
  <script language='javascript' type='text/javascript'>
    updatepage();
  </script>
  <?php
    break;

    case "check":
        $bookingid=$_POST['id'];
        $depositno = $_POST['depno'];
        $category = $_POST['category'];
        $sqldata = mysql_query("select * from tour_msbooking
                                inner join tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode
                                where BookingID ='$bookingid' AND tour_msbooking.Status='ACTIVE'");
        $data=mysql_fetch_array($sqldata);
        $turkod=$data[turkod];
        if($data[TCCompany]=='TUR EZ'){$comp='2';}
        else{$comp='1';}
        if($category=='TOPUP' AND $data[CompanyID] =='2') {$compcsr = 2;}else{$compcsr = $comp;}
        $sql_check1 = mysql_query("select DepositNo from tour_msbooking where BookingStatus = 'DEPOSIT' AND DepositNo ='".$depositno."' AND TCCompany ='".$data[TCCompany]."' AND Status='ACTIVE'");
        $yes1=mysql_num_rows($sql_check1);
        if($yes1 > 0){$iya='iya';}else{$iya='tidak';}
        $sql_check = mssql_query("SELECT [CashReceiptId],[Currency],[TotalAmount]
                          FROM [PTES].[dbo].[CashReceipt]
                          where [CashReceiptId] ='".$depositno."' AND ([Status] = 'A' OR [Status] = 'P')  AND [COMPANYID]='".$compcsr."'");

        $yes=mssql_num_rows($sql_check);
        if($yes > 0){$bisa='bisa';}else{$bisa='tidak';}
        $isi=mssql_fetch_array($sql_check);?>

        <form method='POST' <?PHP echo"action='deposit.php'"?> name='thisForm' id='thisForm'>
        <input name='depcurr' value='<?php echo $isi[Currency]; ?>' type='hidden'>
        <input name='depamount' value='<?php echo $isi[TotalAmount]; ?>' type='hidden'>
        <input name='depid' value='<?php echo $isi[CashReceiptId]; ?>' type='hidden'>
        <input name='depno' value='<?php echo $depositno; ?>' type='hidden'>
        <input name='depada' value='<?php echo $bisa; ?>' type='hidden'>
        <input name='bookid' value='<?php echo $bookingid; ?>' type='hidden'>
        <input name='duplicate' value='<?php echo $iya; ?>' type='hidden'>
        <input name='compid' value='<?php echo $category; ?>' type='hidden'>
        <input type='submit' id='submit'>
        </form>
        <script type="text/javascript">
            document.getElementById("submit").click();
        </script><?php
    break;
}
?>
