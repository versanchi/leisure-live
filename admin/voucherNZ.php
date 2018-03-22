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
<?php 	  $edit=mysql_query("SELECT * FROM tour_voucherpromo WHERE VoucherID = '$_GET[code]'");
          while($r=mysql_fetch_array($edit)){
          $valid=date("d M Y", strtotime($r[ValidDate]));
          $qvalid = mysql_query("SELECT * FROM tour_msbooking
                                        left join tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode
                                        where BookingID = '$r[BookingID]' ");
          $qhasil = mysql_fetch_array($qvalid);
    echo "<center>
          <table style='border:0' height='550'><tr><td style='border:0'>
          <table height='417' width='900' >
          <tr><td background='../admin/images/voucherNZ.jpg'>
          <table style='border:0px'>
          <tr style='border:0px'><td style='border:0px' width='40' height='70'></td><td style='border:0px' width='300'></td><td style='border:0px' width='300'></td></tr>
          <tr style='border:0px'><td style='border:0px'></td><td style='border:0px'><font size='4'><b>$r[VoucherNo]</b></font><br>$qhasil[TourCode] ($r[BookingID]-$r[IDDetail])</td><td height='50' style='text-align:right;border:0px'></td></tr>
          </table>
          </td></tr>
          </table>
          </td></tr></table>
          ";
          }
?> <?php 
      
?>
</body>
</html>
<script>
	window.opener.location.reload();
</script>