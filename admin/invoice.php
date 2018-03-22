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
session_start();
include "../config/koneksi.php";
//include "../config/koneksisql.php";
$dbHost = "10.10.200.4\DEV";
$dbUsername = "sa";
$dbPassword = "!d3v3l0p3r@l4y";
$dbDatabase = "PTES";

$db = mssql_connect($dbHost, $dbUsername, $dbPassword) or die ("Unable to connect to Database PTES.");
mssql_select_db ($dbDatabase, $db) or die ("Could not select database.");
$username=$_SESSION[employee_code];
$sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_code='$username'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName=$tampiluser[employee_name];
$today = date("Y-m-d G:i:s");    
switch($_GET[act]){
  // Tampil Office
  default:
  	$invid=$_POST[invid];
    if($invid==''){$invid=$_POST[invno];}
    $invcurr=$_POST[invcurr];
    $invamount=$_POST[invamount];
    $invada=$_POST[invada];
    $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $depdate = substr($r[DateTravelFrom],8,2);
    if($invada=='' OR $invada < 1){$ok='disabled';}else{$ok='enabled';}
    if($invada==''){$gbr='';}
    elseif($invada== 0){$gbr="<font color='red''>NOT FOUND.</font>";}
    elseif($invada > 0){$gbr="<img src='./modul/tick.gif' align='absmiddle'>";}
    echo "<h2>INPUT INVOICE NO</h2>
          <form method=POST name='example' action='invoice.php?act=check'>
          <input type='hidden' name='id' id='id' value='$r[BookingID]'>
          <input type='text' name='invno' id='invno' placeholder='Invoice No'> <input type='submit' name='submits' value='CHECK' >
          </form>
          <form method=POST name='example' action='invoice.php?act=save'>
          <input type='hidden' name='id' id='id' value='$_POST[bookid]'><input type='hidden' name='deposit' value='$r[DepositNo]'>
          <center><table style='border:0px'>
          <tr><td style='border:0px'>Invoice</td> <td style='border:0px'>: <input type='text' name='invoiceno' id='invoiceno' value='$invid' style='border:0px' readonly>
          &nbsp$gbr</td></tr>
          <tr><td style='border:0px'>Amount</td> <td style='border:0px'>: <input type='text' name='invoicecurr' id='invoicecurr' value='$invcurr' readonly size='3' style='border:0px'>
          ".number_format($invamount, 2, ',', '.');echo"
          <input type='hidden' name='invoiceamount' id='invoiceamount' size='14' style='border:0px' value='$invamount' ></td></tr>
          </table>
          <input type='submit' name='submits' value='UPDATE' $ok>
          </form>";
     break;  
  
  case "save":
  $nocsr=substr($_POST[deposit],0,3);
  $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_POST[id]'");
  $r=mysql_fetch_array($edit);
  //if($nocsr=='CSR'){

  //}
  if($r[DepositNo]=='' OR $r[DepositNo]=='0'){
      mysql_query("UPDATE tour_msbooking set InvoiceNo = '$_POST[invoiceno]',
                                             BookingStatus = 'DEPOSIT',
                                             Duplicate = 'NO',
                                             DepositNo = '$_POST[invoiceno]',
                                             DepositCurr = '$_POST[invoicecurr]',
                                             DepositAmount = '$_POST[invoiceamount]'
                                        WHERE BookingID = '$_POST[id]'");
      mssql_query("UPDATE [PTES].[dbo].[Invoice] set [DepositTour] = 'YES'
                                                WHERE [InvoiceID] = '$_POST[invoiceno]'");
  }else{
      mysql_query("UPDATE tour_msbooking set InvoiceNo = '$_POST[invoiceno]',
                                                BookingStatus = 'DEPOSIT',
                                                Duplicate = 'NO'
                                        WHERE BookingID = '$_POST[id]'");
      mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = NULL
                                                WHERE [CashReceiptId] = '$_POST[deposit]'");
      mssql_query("UPDATE [PTES].[dbo].[Invoice] set [DepositTour] = 'YES'
                                                WHERE [InvoiceID] = '$_POST[invoiceno]'");
  } 

  $Description="Input Invoice No $_POST[invoiceno] ($_POST[id])";
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
    break;

    case "check":
        $bookingid=$_POST[id];
        $invoiceno = $_POST['invno'];

        $sqldata = mysql_query("select tour_msbooking.*,tour_msproduct.TourCode as turkod from tour_msbooking
                                inner join tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode
                                where BookingID ='$bookingid' AND tour_msbooking.Status='ACTIVE'");
        $data=mysql_fetch_array($sqldata);
        $turkod=$data[turkod];
        if($data[TCCompany]=='PANORAMA TOURS'){$compid='1';}else{$compid='2';}
        $sql_check = mssql_query("select [PTES].[dbo].[Invoice].InvoiceID,  [PTES].[dbo].[Invoice].Currency,  [PTES].[dbo].[Invoice].SUBTOTAL
                          FROM  [PTES].[dbo].[Invoice_Details] inner join [PTES].[dbo].[Invoice] on [PTES].[dbo].[Invoice].InvoiceID=[PTES].[dbo].[Invoice_Details].InvoiceID
                          where [PTES].[dbo].[Invoice].InvoiceID='$invoiceno' and TOURCODE ='$turkod' and  ConfirmationNo='$bookingid' and
                          Voided =  '0' and CompanyID='$compid' ");

        $yes=mssql_num_rows($sql_check);
        $isi=mssql_fetch_array($sql_check);?>

        <form method='POST' <?PHP echo"action='invoice.php'"?> name='thisForm' id='thisForm'>
        <input name='invcurr' value='<?php echo $isi[Currency]; ?>' type='hidden'>
        <input name='invamount' value='<?php echo $isi[SUBTOTAL]; ?>' type='hidden'>
        <input name='invid' value='<?php echo $isi[InvoiceID]; ?>' type='hidden'>
        <input name='invno' value='<?php echo $invoiceno; ?>' type='hidden'>
        <input name='invada' value='<?php echo $yes; ?>' type='hidden'>
        <input name='bookid' value='<?php echo $bookingid; ?>' type='hidden'>
        <input type='submit' id='submit'>
        </form>
        <script type="text/javascript">
            document.getElementById("submit").click();
        </script><?php
    break;
}
?>
