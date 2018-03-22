<html>
<head>
<title>Voucher Promo</title>
<link href="../config/print.css" rel="stylesheet" type="text/css" /> 
</head>
<?php 
include "../config/koneksi.php";
include "../config/fungsi_an.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
   

?>
<body>
<?php 	  $edit=mysql_query("SELECT * FROM tour_voucherexpress WHERE VoucherID = '$_GET[code]'");
          $r=mysql_fetch_array($edit);     
          $valid=date("d M Y", strtotime($r[ValidDate]));
          $qvalid = mysql_query("SELECT * FROM tour_msbooking
                                    left join tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode
                                    where BookingID = '$r[BookingID]' ");
          $qhasil = mysql_fetch_array($qvalid);
    echo "<center>
          <table height='314' width='900' >
          <tr><td background='../admin/images/voucherblue.jpg'>
          <table style='border:0px'>
          <tr style='border:0px'><td style='border:0px' width='430' height='30'></td><td style='border:0px' width='120'></td><td style='border:0px' width='300'></td></tr>
          <tr style='border:0px'><td style='border:0px'></td><td style='border:0px'></td><td height='50' style='text-align:right;border:0px'><font size='4'><b>$r[VoucherNo]</b></font><br>$qhasil[TourCode]</td></tr>
          <tr style='border:0px'><td style='border:0px'></td><td style='border:0px' colspan='2'><font size='2'>You are dedicated for :</font></td></tr>
          <tr style='border:0px'><td style='border:0px'></td><td colspan='2' style='text-align:center;vertical-align:middle;border:0px;' height='50'><font size='5'><b>$r[Promo] <br>($r[Pax] Pax)</b></font></td></tr>
          <tr style='border:0px'><td style='border:0px'></td><td style='border:0px' colspan='2' height='65'><font size='2'>Voucher valid only for Passenger with booking ID: <b>$r[BookingID]</b></font></td></tr>
          <tr style='border:0px'><td style='border:0px'></td><td style='text-align:right;border:0px;' colspan='2'><font size='2' color='red'>valid until $valid </font><br><font size='1'><i>*terms and conditions apply</i></font></td></tr>

          </table>
          </td></tr>
          </table>
          ";
?> <?php 
      
?>
</body>
</html>
<script>
	window.opener.location.reload();
</script>