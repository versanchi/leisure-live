<html>
<head>
    <title>Cash Receipt</title>
    <link href="../config/adminstyle.css" rel="stylesheet" type="text/css" />

</head>
<?php
session_start();
include "../config/koneksi.php";
include "../config/fungsi_an.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

?>
<body>
<script type="text/javascript">
    var time = new Date().getTime();
    document.onmousemove = function() {
        time = new Date().getTime();
    };
    function refresh() {
        if(new Date().getTime() - time >= 300000)
            window.close(true);
        else
            setTimeout(refresh, 300000);
    }
    setTimeout(refresh, 300000);
</script>
<script language="JavaScript"  type="text/javascript">
    function rubah(ID)
    {
        if (confirm("Are you sure you want to void " + ID +""))
        {
            window.location.href = '../admin/tbf.php?act=voidtbf&TBF=' + ID  ;
        }
    }
    function updatepage()
    {
        window.close();
        window.opener.location.reload();
    }
    function ngecek(ID,CODE)
    {
        if (ID == 0)
        {
            window.location.href = 'tbf.php?act=savetbf&code=' + CODE  ;
        }else {
            alert('PLEASE CHECK AGAIN PAX NAME AND PASSPORT NO!!');
            document.example.elements['submit'].disabled=true;
            return false;

        }
    }
</script>

<?php
$username=$_SESSION[employee_code];
$sqluser=mysql_query("SELECT * FROM tbl_msemployee
                    left join tbl_msoffice on tbl_msoffice.office_id=tbl_msemployee.office_id
                    WHERE tbl_msemployee.employee_code ='$username'");
$tampiluser=mysql_fetch_array($sqluser);
if($tampiluser[office_group]=='TUR EZ')
{$compid=2;}
else
{$compid=1;}
$EmpName=$tampiluser[employee_name];
$timezone_offset = +5;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
$edit=mysql_query("SELECT tour_msbooking.*,tour_CashReceipt.*,tour_CashReceipt_Payment.TypePayment,tour_CashReceipt_Payment.Currency as curr
                                    ,tour_CashReceipt_Payment.Amount as harga,tour_CashReceipt_Payment.AmountReal as hargadepo,
                                    tour_CashReceipt_Payment.BankCharges as bankcharges,tour_CashReceipt_Payment.Remarks as note FROM tour_CashReceipt
                                    inner join tour_msbooking on tour_msbooking.DepositNo = tour_CashReceipt.CashReceiptId
                                    inner join tour_CashReceipt_Payment on tour_CashReceipt_Payment.CashReceiptId = tour_CashReceipt.CashReceiptId
                                    WHERE tour_CashReceipt.CashReceiptID = '$_GET[id]'");
$r=mysql_fetch_array($edit);
$awal=mysql_query("SELECT * FROM tour_msproduct left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode WHERE IDProduct = '$r[IDTourcode]'");
$curawal=mysql_fetch_array($awal);
$datacomp=mysql_query("SELECT * FROM tbl_mscompany WHERE CompanyID = '$r[CompanyID]'");
$comp=mysql_fetch_array($datacomp);
$csrsign=mysql_query("SELECT * FROM tbl_msemployee
                    left join tbl_msoffice on tbl_msoffice.office_id=tbl_msemployee.office_id
                    WHERE tbl_msemployee.employee_code ='$r[CreateBy]'");
$sign=mysql_fetch_array($csrsign);
$thisyear = date("Y");
$nextyear = $thisyear+1;
$getcode=$_GET[code];
if($sign[office_group]=='TUR EZ')
{$compid=2;}
else
{$compid=1;}
switch($_GET[act]){
    default:
        $rpt=mysql_fetch_array(mysql_query("SELECT * FROM tour_CashReceipt_Report WHERE ReportNo='$_GET[id]'"));
        $Exh=$rpt['LocationID'];
        if($compid=='2'){$judul='TUR EZ';}else{$judul='Panorama Tours Indonesia';}

        //TAMPIL DATA yg tidak void
        $ExName=mysql_fetch_array(mysql_query("SELECT Event FROM tour_marketing WHERE MarketingID='$Exh'"));
        $tampil=mysql_query("SELECT *,sum(CRP.Amount)as mount,sum(CRP.BankCharges)as bcharges,sum(CRP.AmountReal)as areal FROM tour_CashReceipt_Payment CRP
						        INNER JOIN tour_CashReceipt CR ON CRP.CashReceiptId=CR.CashReceiptId
							    WHERE CR.CompanyID='$compid' and ExhibitionID='$Exh' and
								  CR.Status!='V' and DCRID='$_GET[id]'
								  Group By CRP.CashReceiptId
						 ORDER BY CR.IndexCashReceiptHeader DESC");
        $qtgl=mysql_query("SELECT * FROM tour_CashReceipt
						        WHERE CompanyID='$compid' and ExhibitionID='$Exh' and
								  Status!='V' and DCRID='$_GET[id]'
								  Group By CashReceiptId");
        $CekAda=mysql_num_rows($tampil);
        $tglatas=mysql_fetch_array($qtgl);
        if($CekAda > 0 and $Exh!=''){
            echo "<table class='list' id='TblCashReceipt'>
		   <tr><th colspan='10' style='font-size:17px;'>$judul Exhibition cashier report $ExName[Event]<br>Report ID: $_GET[id]</th></tr>
			<tr><th colspan='10'>Currency : IDR <br>Period : ".date("d M Y", strtotime($tglatas[ReportDate]))."</th></tr>
			<tr>
				<th>no</td>
				<th>Date Created</td>
				<th>Booking ID</td>
				<th>Created By</td>
				<th>BOSO</td>
				<th>Deposit No</td>
				<th>Amount</td>
				<th>Bank Charges</td>
				<th>Deposit Amount</td>
				<th>Remarks</td>
			 </tr>";
            $no = 1;
            while ($r=mysql_fetch_array($tampil)){
                $DateCreate = date("d M Y", strtotime($r['CreateDate']));
                $DepositAmount=number_format($r['areal'], 2, '.', ',');
                $BankCharges=number_format($r['bcharges'], 2, '.', ',');
                $Amount=number_format($r['mount'], 2, '.', ',');

                $TotalDepositAmount=$TotalDepositAmount+$r['areal'];
                $TotalBankCharges=$TotalBankCharges+$r['bcharges'];
                $TotalAmount=$TotalAmount+$r['mount'];

                $getCreat=mysql_fetch_array(mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_code='$r[CreateBy]'"));
                echo "<tr>
				<td>$no</td>
				<td><center>$DateCreate</td>
				<td>$r[LTMBookingID]</td>
				<td>$getCreat[employee_name] ($r[CreateBy])</td>
				<td><center>$r[BOSOID]</td>
				<td><center>$r[CashReceiptId]</td>
				<td style='text-align:right'>$Amount</td>
				<td style='text-align:right'>$BankCharges</td>
				<td style='text-align:right'>$DepositAmount</td>
				<td>$r[Remarks]</td>
			  </tr>";
                $no++;
            }
            echo "
			<tr><td colspan='6'><center><b>GRAND TOTAL</b></td>
				<td style='text-align:right'><b>".number_format($TotalAmount, 2, '.', ',');echo"</b></td>
				<td style='text-align:right'><b>".number_format($TotalBankCharges, 2, '.', ',');echo"</b></td>
				<td style='text-align:right'><b>".number_format($TotalDepositAmount, 2, '.', ',');echo"</b></td>
				<td></td></tr>
	</table>";
        }
        //END TAMPIL DATA yg tidak void

        //TAMPIL DATA VOID
        $tampil2=mysql_query("SELECT *,sum(CRP.Amount)as mount,sum(CRP.BankCharges)as bcharges,sum(CRP.AmountReal)as areal FROM tour_CashReceipt_Payment CRP
						        INNER JOIN tour_CashReceipt CR ON CRP.CashReceiptId=CR.CashReceiptId
							    WHERE CR.CompanyID='$compid' AND ExhibitionID='$Exh' AND
								  CR.Status='V' AND DCRID='$_GET[id]'
								  Group By CRP.CashReceiptId
						 ORDER BY CR.IndexCashReceiptHeader DESC");
        $CekAda2=mysql_num_rows($tampil2);
        if($CekAda2 > 0 and $Exh!=''){
            echo "<table class='list' id='TblCashReceipt'>
		   <thead>
			<tr>
				<th>no</td>
				<th>Date Created</th>
				<th>Booking ID</th>
				<th>Created By</th>
				<th>BOSO</th>
				<th>Deposit No</th>
				<th>Amount</th>
				<th>Bank Charges</th>
				<th>Deposit Amount</th>
				<th>Remarks</th>
			 </tr>
			</thead>";
            $no = 1;
            while ($r2=mysql_fetch_array($tampil2)){
                $DateCreate = date("d M Y", strtotime($r2['CreateDate']));
                $DepositAmountVoid=number_format($r2['areal'], 2, '.', ',');
                $BankChargesVoid=number_format($r2['bcharges'], 2, '.', ',');
                $AmountVoid=number_format($r2['mount'], 2, '.', ',');

                $TotalDepositAmountVoid=$TotalDepositAmountVoid+$r2['areal'];
                $TotalBankChargesVoid=$TotalBankChargesVoid+$r2['bcharges'];
                $TotalAmountVoid=$TotalAmountVoid+$r2['mount'];

                $getCreat=mysql_fetch_array(mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_code='$r2[CreateBy]'"));
                echo "<tr>
				<td>$no</td>
				<td><center>$DateCreate</td>
				<td>$r2[LTMBookingID]</td>
				<td>$getCreat[employee_name] ($r2[CreateBy])</td>
				<td><center>$r2[BOSOID]</td>
				<td><center>$r2[CashReceiptId]</td>
				<td style='text-align:right'>$AmountVoid</td>
				<td style='text-align:right'>$BankChargesVoid</td>
				<td style='text-align:right'>$DepositAmountVoid</td>
				<td>$r2[Remarks]</td>
			  </tr>";
                $no++;
            }
            echo "
			<tr><td colspan='6'><center><b>GRAND TOTAL</b></td>
				<td style='text-align:right'><b>".number_format($TotalAmountVoid, 2, '.', ',');echo"</b></td>
				<td style='text-align:right'><b>".number_format($TotalBankChargesVoid, 2, '.', ',');echo"</b></td>
				<td style='text-align:right'><b>".number_format($TotalDepositAmountVoid, 2, '.', ',');echo"</b></td>
				<td><center></td></tr>
	</table>";
        }
        //END TAMPIL DATA VOID

        $getType=mysql_query("SELECT *,sum(CRP.Amount)as mount,sum(CRP.BankCharges)as bcharges,sum(CRP.AmountReal)as areal FROM tour_CashReceipt_Payment CRP
						        INNER JOIN tour_CashReceipt CR ON CRP.CashReceiptId=CR.CashReceiptId
						  WHERE CR.CompanyID='$compid' AND ExhibitionID='$Exh' AND
								CR.Status!='V' AND DCRID='$_GET[id]'
                              Group By CRP.TypePayment
						  ORDER BY CRP.TypePayment ASC");

        $AdaPayment=mysql_num_rows($getType);
        if($AdaPayment > 0){
            echo"<table class='list'>
			  <tr><th colspan='5'>TOTAL AMOUNT PER PAYMENT TYPE</th></tr>
			  <tr><th>Payment Type</th>
				  <th>Currency</th>
				  <th>Amount</th>
				  <th>Bank Charges</th>
				  <th>Deposit Amount</th></tr>";
            while($pt=mysql_fetch_array($getType)){
                $Amount		  = number_format($pt['mount'], 2, '.', ',');
                $BankCharges  = number_format($pt['bcharges'], 2, '.', ',');
                $DepositAmount= number_format($pt['areal'], 2, '.', ',');
                $TotalPT	  = $TotalPT+$pt['mount'];
                $TotalBank	  = $TotalBank+$pt['bcharges'];
                $TotalDPT	  = $TotalDPT+$pt['areal'];
                echo"<tr><td>$pt[TypePayment]</td>
				<td><center>$pt[Currency]</td>
				<td style='text-align:right'>$Amount</td>
				<td style='text-align:right'>$BankCharges</td>
				<td style='text-align:right'>$DepositAmount</td></tr>";
            }
            echo"
		  <tr><td colspan='2'><b>TOTAL</b></td>
		    <td style='text-align:right'><b>".number_format($TotalPT, 2, '.', ',');echo"</b></td>
			<td style='text-align:right'><b>".number_format($TotalBank, 2, '.', ',');echo"</b></td>
			<td style='text-align:right'><b>".number_format($TotalDPT, 2, '.', ',');echo"</b></td></tr>
	  </table>";
        }

        break;

}
?>
</body>
</html>