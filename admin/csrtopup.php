<SCRIPT LANGUAGE="JavaScript" SRC="../config/CalendarPopup.js"></SCRIPT>               
<script type="text/javascript" src="../config/jquery.js"></script>            
<script type="text/javascript" src="../head/jquery-1.3.2.min.js"></script>         
<SCRIPT LANGUAGE="JavaScript">
    var cal = new CalendarPopup(); 
</SCRIPT>
<script type="text/javascript">
    setTimeout(window.close, 45000);
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
$sqluser=mssql_query("SELECT ClientNo,DivisiNO,Employee.DivisiID,EmployeeID,Category,EmployeeName,CompanyGroup,LTMAuthority,ClientNo FROM [HRM].[dbo].[Employee]
                  inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                  WHERE EmployeeID = '$username'");
$tampiluser=mssql_fetch_array($sqluser);
$EmpName=$tampiluser[EmployeeName];
$clientnumber = explode("-", $tampiluser[ClientNo]);
$clientno = $clientnumber[0];
$today = date("Y-m-d G:i:s");
mssql_close($link);
include "../config/koneksisql.php";
$divq=mssql_query("SELECT * FROM Clients
                  WHERE ClientID = '$clientno'");
$divclient=mssql_fetch_array($divq);

switch($_GET[act]){
  // Tampil Office
  default:
    $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $paxdeposit=4000000;
    echo "<h2>CREATE DEPOSIT</h2>
          <form method=POST name='example' action='csrtopup.php?act=save'>
          <input type='hidden' name='id' id='id' value='$_GET[id]'>
          <center><table style='border:0px'>
          <input type='hidden' name='paxdeposit' value='$paxdeposit'>
          <tr><td>Your Balance</td>";
          //include "../config/koneksisql.php";
          $carievent=mssql_query("SELECT * FROM TopUpAccountBalance where ClientNo = '$tampiluser[ClientNo]' and StatusLastBalance = '1' ");
          $dptevent=mssql_fetch_array($carievent);
          //mssql_close($linkptes);
          //include "../config/koneksimaster.php";
          $totalpax=$r[AdultPax]+$r[ChildPax];
          $totalpaxdeposit = $totalpax * $paxdeposit;
          $newbalance=$dptevent[EndingBalance]-$totalpaxdeposit;
          if($newbalance < 0){$ok='disabled';}else{$ok='enabled';}
          echo"<input type='hidden' name='endingbalance' id='endingbalance' value='$dptevent[EndingBalance]'>
          <td>$dptevent[Currency] " . number_format($dptevent[EndingBalance], 0, ',', '.');echo" </td></tr>
          <tr><td>Deposit for Booking</td> <td>IDR <input type='text' style='border:0;color:red' name='amounttampil' value='". number_format($totalpaxdeposit, 0, ',', '.')."' readonly>
          <input type='hidden' name='depositcurr' id='depositcurr' value='IDR' size='3'>
          <input type='hidden' name='depositamount' id='depositamount' value='$totalpaxdeposit'>
          </td></tr>
          <tr><td>Your Last Balance</td> <td>IDR <input type='text' style='border:0' name='newbalancetampil' value='". number_format($newbalance, 0, ',', '.')."' readonly>
          <input type='hidden' name='newbalance' id='newbalance' value='$newbalance'></table>
          <input type='submit' name='submits' value='CREATE' $ok>
          </form>";
     break;

  case "save":
      $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_POST[id]'");
      $r=mysql_fetch_array($edit);
      include "../config/koneksimaster.php";
      $sqldiv = mssql_query("SELECT c.ClientNo,c.CompanyName FROM Divisi d
                                   inner join Company c on c.CompanyCode = d.DivisiID
                                   WHERE d.DivisiID = '$r[TCDivision]' ");
      $datadiv = mssql_fetch_array($sqldiv);
      $sqlrar = mssql_query("SELECT * FROM Divisi WHERE DivisiID = 'RAR' ");
      $norar = mssql_fetch_array($sqlrar);
      $csrdepan = "CSR$norar[DivisiNO]-";
      mssql_close($link);
      include "../config/koneksisql.php";
      $tampilin = mssql_query("SELECT TOP 1 CashReceiptId FROM CashReceipt where CashReceiptId like '$csrdepan%'
                            ORDER BY CashReceiptId DESC ");
      $hasilin = mssql_fetch_array($tampilin);
      $jumlahin = mssql_num_rows($tampilin);

      if ($jumlahin > 0) {
          $csrno1 = substr($hasilin[CashReceiptId], -7) + 1;
          switch ($csrno1) {
              case ($csrno1 < 10):
                  $csrno = "000000" . $csrno1;
                  break;
              case ($csrno1 > 9 && $csrno1 < 100):
                  $csrno = "00000" . $csrno1;
                  break;
              case ($csrno1 > 99 && $csrno1 < 1000):
                  $csrno = "0000" . $csrno1;
                  break;
              case ($csrno1 > 999 && $csrno1 < 10000):
                  $csrno = "000" . $csrno1;
                  break;
              case ($csrno1 > 9999 && $csrno1 < 100000):
                  $csrno = "00" . $csrno1;
                  break;
              case ($csrno1 > 99999 && $csrno1 < 1000000):
                  $csrno = "0" . $csrno1;
                  break;
          }
      } else {
          $csrno = "0000001";
      }
      $csrtour = "$csrdepan$csrno";
      $depono = $csrtour;

      //CREATE CSR
      $catat="$r[TCName] ($r[TCDivision]) $r[BookingID]";
      $detailamount=$_POST[depositamount];
      $remak="$r[TourCode] ($r[BookingID])";
      //include "../config/koneksisql.php";
      mssql_query("INSERT INTO CashReceipt(CashReceiptId,
                                                            Date,
                                                            ClientNo,
                                                            ClientName,
                                                            BOSOID,
                                                            Currency,
                                                            TotalAmount,
                                                            StatusVoid,
                                                            StatusPrinted,
                                                            Duplicate,
                                                            Status,
                                                            CreateBy,
                                                            CreateDate,
                                                            LastBy,
                                                            LastDate,
                                                            LTMBookingID,
                                                            CompanyID,
                                                            Remarks,
                                                            BOSOName,
                                                            BOSOAddress,
                                                            BOSOPhone,
                                                            BOSOFax,
                                                            BOSOEmail)
                                                    VALUES ('$csrtour',
                                                            '$today',
                                                            '$datadiv[ClientNo]',
                                                            '$datadiv[CompanyName]',
                                                            'RAR',
                                                            'IDR',
                                                            '$detailamount',
                                                            '0',
                                                            '0',
                                                            '0',
                                                            'A',
                                                            'SYSADMIN',
                                                            '$today',
                                                            'SYSADMIN',
                                                            '$today',
                                                            '$tahun1$tiket1',
                                                            '$norar[CompanyID]',
                                                            '$catat',
                                                            '$norar[DivisiName]',
                                                            '$norar[Address]',
                                                            '$norar[Phone]',
                                                            '$norar[Fax]',
                                                            '$norar[Email]')");
      // pembayaran
      $qcariindex = mssql_query("SELECT * FROM CashReceipt where CashReceiptId = '$csrtour' AND CompanyID ='$norar[CompanyID]'");
      $index=mssql_fetch_array($qcariindex);
      mssql_query("INSERT INTO CashReceipt_Payment(CashReceiptId,
                                                            IndexCashReceiptHeader,
                                                            Urut,
                                                            TypePayment,
                                                            Remarks,
                                                            Currency,
                                                            Amount,
                                                            BankCharges,
                                                            AmountReal,
                                                            CreateBy,
                                                            CreateDate,
                                                            LastBy,
                                                            LastDate)
                                                    VALUES ('$csrtour',
                                                            '$index[IndexCashReceiptHeader]',
                                                            '1',
                                                            'TOP UP',
                                                            '$remak',
                                                            'IDR',
                                                            '$detailamount',
                                                            '0',
                                                            '$detailamount',
                                                            'SYSADMIN',
                                                            '$today',
                                                            'SYSADMIN',
                                                            '$today')");
      $sqllasttopup = mssql_query("SELECT * FROM TopUpAccountBalance where ClientNo = '$datadiv[ClientNo]' and StatusLastBalance = 1 ");
      $lasttopup = mssql_fetch_array($sqllasttopup);
      $endingbalance=$lasttopup[EndingBalance] - $detailamount;
      $desc="DEPOSIT $csrtour";
      mssql_query("INSERT INTO TopUpAccountBalance(ClientNo,
                                                            ClientName,
                                                            CategoryID,
                                                            CostCenter,
                                                            ReferenceID,
                                                            TypicalBalance,
                                                            Currency,
                                                            BeginningBalance,
                                                            Mutation,
                                                            EndingBalance,
                                                            WarningBalance,
                                                            MinimumBalance,
                                                            StatusLastBalance,
                                                            Description,
                                                            DateofCreated,
                                                            CreatedBy,
                                                            CompanyID,
                                                            StatusLastEmail)
                                                    VALUES ('$datadiv[ClientNo]',
                                                            '$datadiv[CompanyName]',
                                                            '$lasttopup[CategoryID]',
                                                            '$r[BookingID]',
                                                            '$csrtour',
                                                            'CREDIT',
                                                            'IDR',
                                                            '$lasttopup[EndingBalance]',
                                                            '$detailamount',
                                                            '$endingbalance',
                                                            '$lasttopup[WarningBalance]',
                                                            '$lasttopup[MinimumBalance]',
                                                            '1',
                                                            '$desc',
                                                            '$today',
                                                            'SYSADMIN',
                                                            '$norar[CompanyID]',
                                                            '$lasttopup[StatusLastEmail]')");
      mssql_query("UPDATE TopUpAccountBalance SET StatusLastBalance = 0 WHERE BalanceID = '$lasttopup[BalanceID]' ");
      //mssql_close($linkptes);
      //include "../config/koneksimaster.php";
      mysql_query("UPDATE tour_msbooking set DepositNo = '$csrtour',
                                              Duplicate = 'NO',
                                              BookingStatus = 'DEPOSIT',
                                              DepositCurr = 'IDR',
                                              DepositAmount = '$detailamount',
                                              DepositDate = '$today'
                                        WHERE BookingID = '$r[BookingID]'");

  $Description="Create Deposit No $csrtour ($r[BookingID])";
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

}
?>
