<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>         
<script type="text/javascript" src="../head/editable-select.js"></script> 
<script language="JavaScript"  type="text/javascript">   
function openprod(ID)
{
 window.location.href = '?module=rpsalesex&act=openproduct&id=' + ID ;
}
function ganti(){
    document.getElementById("myform").submit();
}
</script>

<?php
session_start();
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
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
switch($_GET[act]){
  // Tampil Office
  default:
    echo "<h2>View Exhibition Report</h2>";
  	$nama=$_GET['nama'];
	$Exh=$_GET['Exhibition'];
	$kmrn = mktime (0,0,0, date("m"), date("d")-1,date("Y"));
    $kemarin = date('Y-m-d', $kmrn); 
	if($Exh==''){$Exh='0';}else{$Exh=$_GET['Exhibition'];}
	$QExhibition=mysql_query("SELECT * FROM tour_marketing WHERE tour_marketing.Status ='FIX'  and  dateto>='$kemarin' and  datefrom<='$today'
                                    order by event DESC");

    echo "<form method=get id='myform' action='media.php?'>
		  	  <input type=hidden name=module value='rptexhibition'>
			  Exhibition  <select name='Exhibition' onchange='ganti()'>
			  <option value=''selected>-- PLEASE SELECT --</option>";
		while ($DExhibition=mysql_fetch_array($QExhibition)){ 
			echo" <option value='$DExhibition[MarketingID]'";if($Exh==$DExhibition[MarketingID]){echo"selected";}echo">$DExhibition[Event]</option>";
		}
			   
		echo"</select>

		  </form>";
	  $oke=$_GET['oke'];
	  
	  	$No=1;

	  	$QSExhibition=mysql_query("SELECT * FROM tour_marketing where MarketingID='$Exh'");
		$QDSExhibition=mysql_fetch_array($QSExhibition);
    //tes mssql
    /*$mssql=mssql_query("SELECT TOP 10 * FROM [PTES].[dbo].[CashReceipt] order by IndexCashReceiptHeader DESC");
    while($hasilmssql=mssql_fetch_array($mssql)){
        echo"tes: $hasilmssql[CashReceiptId]<br>";
    }*/
        if($Exh<>'0'){

            if($compid=='2'){$judul='TUR EZ';}else{$judul='LTM';}


            //TAMPIL DATA yg tidak void
            $ExName=mysql_fetch_array(mysql_query("SELECT Event FROM tour_marketing WHERE MarketingID='$Exh'"));
            $tampil=mysql_query("SELECT *,sum(CRP.Amount)as mount,sum(CRP.BankCharges)as bcharges,sum(CRP.AmountReal)as areal FROM tour_cashreceipt_payment CRP
						        INNER JOIN tour_cashreceipt CR ON CRP.CashReceiptId=CR.CashReceiptId
							    WHERE CR.CompanyID='$compid' and ExhibitionID='$Exh' and
								  CR.Status!='V' and DCRID IS NULL
								  Group By CRP.CashReceiptId
						 ORDER BY CR.IndexCashReceiptHeader DESC");
            $CekAda=mysql_num_rows($tampil);
            if($CekAda > 0 and $Exh!=''){
                echo "<table class='list' id='TblCashReceipt'>
		   <tr><th colspan='10' style='font-size:17px;'>$judul Exhibition cashier report $ExName[Event]</th></tr>
			<tr><th colspan='10'>Currency : IDR <br>Period : ".date("d M Y", strtotime($today))."</th></tr>
			<tr>
				<th>no</td>
				<th>Date Created</td>
				<th>TC / Divisi</td>
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
				<td>$r[TcDiv]</td>
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

            //END TAMPIL DATA yg tidak void

            //TAMPIL DATA VOID
            $tampil2=mysql_query("SELECT *,sum(CRP.Amount)as mount,sum(CRP.BankCharges)as bcharges,sum(CRP.AmountReal)as areal FROM tour_cashreceipt_payment CRP
						        INNER JOIN tour_cashreceipt CR ON CRP.CashReceiptId=CR.CashReceiptId
							    WHERE CR.CompanyID='$compid' AND ExhibitionID='$Exh' AND
								  CR.Status='V' AND DCRID IS NULL
								  Group By CRP.CashReceiptId
						 ORDER BY CR.IndexCashReceiptHeader DESC");
            $CekAda2=mysql_num_rows($tampil2);
            if($CekAda2 > 0 and $Exh!=''){
                echo "<table class='list' id='TblCashReceipt'>
		   <thead>
			<tr>
				<th><center>no</th>
				<th><center>Date Created</th>
				<th><center>TC / Divisi</th>
				<th><center>Created By</th>
				<th><center>BOSO</th>
				<th><center>Deposit No</th>
				<th><center>Amount</th>
				<th><center>Bank Charges</th>
				<th><center>Deposit Amount</th>
				<th><center>Remarks</th>
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
				<td>$r2[TcDiv]</td>
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

            $getType=mysql_query("SELECT *,sum(CRP.Amount)as mount,sum(CRP.BankCharges)as bcharges,sum(CRP.AmountReal)as areal FROM tour_cashreceipt_payment CRP
						        INNER JOIN tour_cashreceipt CR ON CRP.CashReceiptId=CR.CashReceiptId
							    WHERE CR.CompanyID='$compid' AND ExhibitionID='$Exh' AND
								CR.Status!='V' AND DCRID IS NULL
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
            }echo"<center>
		    <input type='button' name='gererate' value='GENERATE REPORT' onclick=location.href='?module=rptexhibition&act=generate&exh=$Exh'>
		    <input type=button value='BACK' onclick=location.href='?module=rptexhibition&act=showcsr'></center>";
            }else{echo"<center><i>DATA REPORT EXHIBITION <font color='red'>$QDSExhibition[Event]</font> IS EMPTY OR NOT FOUND</i>
            <br><br><input type=button value='BACK' onclick=location.href='?module=rptexhibition&act=showcsr'>";}
        }else{echo"<center><br><br><input type=button value='BACK' onclick=location.href='?module=rptexhibition&act=showcsr'>";}
    break;

    case "showcsr":
        $nama=$_GET['nama'];
        echo "<h2>Exhibition Report</h2>";
        $tampil=mysql_query("SELECT * FROM tour_cashreceipt_report ORDER BY CashReceiptReportID DESC");
        $cekRow=mysql_num_rows($tampil);
        if($cekRow>0){
            echo "<table>
			  <tr>
				<th>no</td>
				<th>Report No</td>
				<th>Location</td>
				<th>CSR Total</td>
				<th>Company</td>
				<th>Reported By</td>
				<th>Reported Date</td>
			  </tr>";
            $no = 1;
            while ($r=mysql_fetch_array($tampil)){
                $DateCreate = date("d M Y", strtotime($r['ReportDate']));
                if($r[CompanyID]=='2'){$Company="TUR EZ";}else{$Company="LTM";}
                echo "<tr>
				<td>$no</td>
				<td><a class='tooltip' title='VIEW' href='?module=rptexhibition&act=viewrpt&id=$r[ReportNo]'><b>$r[ReportNo]</b></a></td>
				<td>$r[LocationName]</td>
				<td><center>$r[JumlahCSR]</td>
				<td>$Company</td>
				<td>$r[ReportBy]</td>
				<td><center>$DateCreate</td>
			 </tr>";
                $no++;
            }
            echo "</table>";
        }
        else{
            echo "<br /><br /><div style='color:red;font-weight:bold;'>Data Not Available<br /></div><br />";
        }
    break;

    case "viewrpt":
        $rpt=mysql_fetch_array(mysql_query("SELECT * FROM tour_cashreceipt_report WHERE ReportNo='$_GET[id]'"));
        $Exh=$rpt['LocationID'];
        if($compid=='2'){$judul='TUR EZ';}else{$judul='LTM';}
        echo "<h2>View Exhibition Report</h2>";

        //TAMPIL DATA yg tidak void
        $ExName=mysql_fetch_array(mysql_query("SELECT Event FROM tour_marketing WHERE MarketingID='$Exh'"));
        $tampil=mysql_query("SELECT *,sum(CRP.Amount)as mount,sum(CRP.BankCharges)as bcharges,sum(CRP.AmountReal)as areal FROM tour_cashreceipt_payment CRP
						        INNER JOIN tour_cashreceipt CR ON CRP.CashReceiptId=CR.CashReceiptId
							    WHERE CR.CompanyID='$compid' and ExhibitionID='$Exh' and
								  CR.Status!='V' and DCRID='$_GET[id]'
								  Group By CRP.CashReceiptId
						 ORDER BY CR.IndexCashReceiptHeader DESC");
        $qtgl=mysql_query("SELECT * FROM tour_cashreceipt
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
        $tampil2=mysql_query("SELECT *,sum(CRP.Amount)as mount,sum(CRP.BankCharges)as bcharges,sum(CRP.AmountReal)as areal FROM tour_cashreceipt_payment CRP
						        INNER JOIN tour_cashreceipt CR ON CRP.CashReceiptId=CR.CashReceiptId
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

        $getType=mysql_query("SELECT *,sum(CRP.Amount)as mount,sum(CRP.BankCharges)as bcharges,sum(CRP.AmountReal)as areal FROM tour_cashreceipt_payment CRP
						        INNER JOIN tour_cashreceipt CR ON CRP.CashReceiptId=CR.CashReceiptId
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

        echo"<center>
		  	<input type='button' value='PRINT' class='button' onClick=frames['printexhibition'].print(),location.href='media.php?module=rptexhibition&act=viewrpt&id=$_GET[id]'>
			<input type='button' value='CLOSE' class='button' onclick=location.href='?module=rptexhibition&act=showcsr'>

		<iframe src='printreportcsr.php?id=$_GET[id]' name='printexhibition' style='visibility: hidden' height='0' width='0' frameborder='0'>
		</iframe>";
        break;

    case "generate":
        $Exh=$_GET[exh];
        $hari= date("Y", time());
        //running booking number
        $tampil = mysql_query("SELECT * FROM tour_cashreceipt where StatusReport <> '' and CompanyID='$compid'
                group by StatusReport DESC ORDER BY StatusReport DESC limit 1");
        $hasil = mysql_fetch_array($tampil);
        $jumlah = mysql_num_rows($tampil);
        $tahun = substr($hasil[StatusReport],0,4);

        if($jumlah > 0){
            if($hari==$tahun){
                $tahun1 = $hari;
                $tiket=substr($hasil[StatusReport],5,7)+1;
                switch ($tiket){
                    case ($tiket<10):
                        $tiket1 = "000000".$tiket;
                        break;
                    case ($tiket>9 && $tiket<100):
                        $tiket1 = "00000".$tiket;
                        break;
                    case ($tiket>99 && $tiket<1000):
                        $tiket1 = "0000".$tiket;
                        break;
                    case ($tiket>999 && $tiket<10000):
                        $tiket1 = "000".$tiket;
                        break;
                    case ($tiket>9999 && $tiket<100000):
                        $tiket1 = "00".$tiket;
                        break;
                    case ($tiket>99999 && $tiket<1000000):
                        $tiket1 = "0".$tiket;
                        break;
                }
            } else if ($hari > $tahun) {
                $tahun1 = $hari;
                $tiket1="0000001";
            }
        }else {
            $tahun1 = $hari;
            $tiket1="0000001";
        }

        $QBookExh=mysql_query("SELECT *,CR.IndexCashReceiptHeader as idheader FROM tour_cashreceipt CR
                                INNER JOIN tour_cashreceipt_payment CRP ON CRP.CashReceiptId=CR.CashReceiptId
                                WHERE CR.CompanyID='$compid' and ExhibitionID='$Exh' and DCRID IS NULL
                                Group By CRP.CashReceiptId
                                ORDER BY CR.IndexCashReceiptHeader DESC");
        $jcsr=mysql_num_rows($QBookExh);
        while($isi=mysql_fetch_array($QBookExh)){
            mysql_query("UPDATE tour_cashreceipt SET StatusReport = '$tahun1$tiket1',DCRID = '$tahun1$tiket1',ReportBy='$EmpName',ReportDate='$today'
                               WHERE IndexCashReceiptHeader = '$isi[idheader]' ");
        }
        $QExh=mysql_query("SELECT * FROM `tour_marketing` WHERE MarketingID ='$Exh'");
        $isiExh=mysql_fetch_array($QExh);
        //inpur csr report
        mysql_query("INSERT INTO `tour_cashreceipt_report`(`ReportNo`,
                                                        `ReportBy`,
                                                        `ReportDate`,
                                                        `LocationID`,
                                                        `LocationName`,
                                                        `JumlahCSR`,
                                                        `CompanyID`)
                                                VALUES ('$tahun1$tiket1',
                                                        '$EmpName',
                                                        '$today',
                                                        '$Exh',
                                                        '$isiExh[Event]',
                                                        '$jcsr',
                                                        '$compid')");
        //export to PTES
        $qstart = mysql_query("SELECT * FROM tour_cashreceipt where StatusReport = '$tahun1$tiket1' and CompanyID='$compid'
                ORDER BY IndexCashReceiptHeader ASC");
        while($isi=mysql_fetch_array($qstart)){
            if($isi[StatusVoid]==1){
                mssql_query("INSERT INTO [PTES].[dbo].[CashReceipt](CashReceiptId,
                                                        Date,
                                                        ClientNo,
                                                        ClientName,
                                                        BOSOID,
                                                        Currency,
                                                        TotalAmount,
                                                        StatusVoid,
                                                        VoidReason,
                                                        WhoVoid,
                                                        DateVoid,
                                                        StatusPrinted,
                                                        Duplicate,
                                                        Status,
                                                        CreateBy,
                                                        CreateDate,
                                                        LastBy,
                                                        LastDate,
                                                        DCRID,
                                                        LTMBookingID,
                                                        CompanyID)
                                                VALUES ('$isi[CashReceiptId]',
                                                        '$isi[Date]',
                                                        '$isi[ClientNo]',
                                                        '$isi[ClientName]',
                                                        '$isi[BOSOID]',
                                                        '$isi[Currency]',
                                                        $isi[TotalAmount],
                                                        '$isi[StatusVoid]',
                                                        '$isi[VoidReason]',
                                                        '$isi[WhoVoid]',
                                                        '$isi[DateVoid]',
                                                        '$isi[StatusPrinted]',
                                                        '$isi[Duplicate]',
                                                        '$isi[Status]',
                                                        '$isi[CreateBy]',
                                                        '$isi[CreateDate]',
                                                        '$isi[LastBy]',
                                                        '$isi[LastDate]',
                                                        '$isi[DCRID]',
                                                        '$isi[LTMBookingID]',
                                                        '$isi[CompanyID]')");
            }else{
                mssql_query("INSERT INTO [PTES].[dbo].[CashReceipt](CashReceiptId,
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
                                                        DCRID,
                                                        LTMBookingID,
                                                        CompanyID)
                                                VALUES ('$isi[CashReceiptId]',
                                                        '$isi[Date]',
                                                        '$isi[ClientNo]',
                                                        '$isi[ClientName]',
                                                        '$isi[BOSOID]',
                                                        '$isi[Currency]',
                                                        $isi[TotalAmount],
                                                        '$isi[StatusVoid]',
                                                        '$isi[StatusPrinted]',
                                                        '$isi[Duplicate]',
                                                        '$isi[Status]',
                                                        '$isi[CreateBy]',
                                                        '$isi[CreateDate]',
                                                        '$isi[LastBy]',
                                                        '$isi[LastDate]',
                                                        '$isi[DCRID]',
                                                        '$isi[LTMBookingID]',
                                                        '$isi[CompanyID]')");
            }
            $qstart2 = mysql_query("SELECT * FROM tour_cashreceipt_payment where CashReceiptId = '$isi[CashReceiptId]'
                                     ORDER BY IndexCashReceiptPayment ASC");

            $qcariindex = mssql_query("SELECT * FROM [PTES].[dbo].[CashReceipt] where CashReceiptId = '$isi[CashReceiptId]' AND CompanyID ='$compid'");
            $index=mssql_fetch_array($qcariindex);
            while($isi2=mysql_fetch_array($qstart2)){
            mssql_query("INSERT INTO [PTES].[dbo].[CashReceipt_Payment](CashReceiptId,
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
                                                        VALUES ('$isi2[CashReceiptId]',
                                                                '$index[IndexCashReceiptHeader]',
                                                                '$isi2[Urut]',
                                                                '$isi2[TypePayment]',
                                                                '$isi2[Remarks]',
                                                                '$isi2[Currency]',
                                                                $isi2[Amount],
                                                                $isi2[BankCharges],
                                                                $isi2[AmountReal],
                                                                '$isi2[CreateBy]',
                                                                '$isi2[CreateDate]',
                                                                '$isi2[LastBy]',
                                                                '$isi2[LastDate]')");
            }
        }
        //send email report
        $qemail = mysql_query("SELECT COUNT(`IndexCashReceiptHeader`) as totid, SUM(TotalAmount) as totdep FROM tour_cashreceipt
                                WHERE CompanyID='$compid' and ExhibitionID='$Exh'
                                AND StatusReport = '$tahun1$tiket1' AND StatusVoid = '0' ");
        $datacsr=mysql_fetch_array($qemail);
        $dp=$datacsr[totid];
        $dpamount=$datacsr[totdep];
        $tglemail = date('d M Y');
        $jamkirim = date("d M Y, G:i:s");
        $message = "\n";
        $message .= "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">"."\n";
        $message .= "<html>"."\n";
        $message .= "<head>"."\n";
        $message .= "</head>"."\n";
        $message .= '<body bgcolor="#FFFFFF" text="#333333" style="background-color: #FFFFFF; margin-bottom : 0px; margin-left : 0px; margin-top : 0px; margin-right : 0px;">
                        <table style="border:0"><tr><td style="border:0">
                        <p>Dear All,
                        <br>Herewith, LTM Exhibition report at '.$isiExh[Event].' : '.$tglemail.'</p>
                        <table class="bordered" style="font-size: 13px; font-family: verdana; color: #333333; width: 600px;" border="0" cellspacing="1" cellpadding="4" align="left" bgcolor="#FFFFFF">
                        <tr><th style="background-color: #f58220;">Deposit</th><th style="background-color: #f58220;">'.$dp.'</th></tr>
                        <tr><td style="background-color: #f58220;">TOTAL Deposit Amount</td><td style="background-color: #f58220;text-align:right;">'.number_format($dpamount, 2, ',', '.').'</td></tr>
                        </table>
                  </td></tr>
                  <tr><td style="border:0">
                  <br>
                  <p>Regards,
                  <br>Information System Division
                  <br>-------------------------------------------------------------------------------------------------------------</p>
                  <br>
            <p><small>IMPORTANT INFO :</small></p>
            <p style="font-size: 10px;">* This email is sent automatically via Panorama Integrated system and does not require a reply.
            <br>* This LTM report daily division has been generated on '.$jamkirim.'
            <br>* E-mail transmission cannot be guaranteed to be secured or error-free as information could be corrupted,lost,arrive late or incomplete, or contain viruses.
            <br>* The sender shall not be held responsible for any errors or omissions in the contents of this message, which arise as a result of e-mail transmission.</p>
            </td></tr></table>
            </body>';
        $message .= "</HTML>"."\n";
        $message .= "\n";
        $headers  = "MIME-Version: 1.0 \n";
        $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
        $headers .= "From: Panorama Web System <noreply@panoramawebsys.com> \n";
        $headers .= "Reply-To: noreply@panoramawebsys.com \r\n";
        $headers .= "Return-Path: noreply@panoramawebsys.com\r\n";
        $headers .= "Bcc: ferry_budiono@panorama-tours.com\r\n";
        $headers .= "CC: vili@panorama-tours.com\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        $useremail = "ltm@panorama-tours.com";

        mail($useremail, "LTM Exhibition Report at $isiExh[Event]", $message, $headers);
        //---------------
        header("location:media.php?module=rptexhibition");
	break;
}
?>
