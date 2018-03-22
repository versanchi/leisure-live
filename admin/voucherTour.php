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
          <table height='430' width='900' >
          <tr><td background='../admin/images/voucherTour.jpg'>
          <table style='border:0px'>
          <tr><td style='border:0px' width='215' height='55'></td><td style='border:0px' width='300'></td></tr>
          <tr><td style='border:0px'></td><td style='border:0px'><font size='4'><b>$r[VoucherNo]</b></font><br>$qhasil[TourCode] ($r[BookingID])</td></tr>
          <tr><td style='border:0px' colspan='2' height='65'><center><font size='5'><b><i>$r[Promo]</i></b></font></td></tr>
          <tr><td style='border:0px' colspan='2'>Ketentuan:</td></tr>
          <tr><td style='border:0px;text-align:justify' colspan='2'>1. Berlaku untuk 1 ( satu ) orang saja<br>
          2. <b>Termasuk:</b> akomodasi 2 malam ( kondisi Twin Sharing ) , makan pagi, penjemputan airport - hotel - airport ( seat in coach ) , 1 kali Full Day Tour & guide lokal<br>
          3. <b>Tidak termasuk:</b> tiket pesawat, airport tax JKT, biaya tambahan menginap sendiri ( Single Supplement ), makan siang, makan malam, tipping dan pengeluaran pribadi lain<br>
          4. Berlaku untuk keberangkatan paling telat <b>31 MARET 2016</b> dan tidak dapat diperpanjang<br>
          5. Tidak berlaku untuk keberangkatan periode <b>Long Weekend dan High Season ( Natal, Tahun Baru dan Chinese New Year )</b><br>
          6. Voucher tidak bisa diuangkan dan diganti dengan tour yang lain<br>
          7. Kehilangan voucher tidak menjadi tanggung jawab Panorama Tours dan tidak bisa diganti dengan alasan apapun<br>
          8.  Voucher baru dapat ditukarkan dengan tour <b>setelah pelunasan pembayaran tour  dengan melampirkan voucher ini dan bukti pelunasan pembayaran tour</b></td></tr>
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