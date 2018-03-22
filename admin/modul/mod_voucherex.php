<SCRIPT LANGUAGE="JavaScript">
    var cal = new CalendarPopup(); 
</SCRIPT>
<script language="javascript" type="text/javascript">
    function kuncifree(me) {
        if(me==true){
            document.example.promo.value='FREE VISA ';
        }else{
            document.example.promo.value='';
        }
    }
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
function diprint(ID)
{alert('Click OK to continue')
    window.location.href = '?module=voucherex&act=printvoucher&no=' + ID  ;
}
</script>
                 
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" />

<?php 
include "../config/koneksi.php";
$username=$_GET[user];
$sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_code='$username'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName=$tampiluser[employee_name];
$today = date("Y-m-d G:i:s");    
switch($_GET[act]){
  // Tampil Office
  default:
  	
    $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[nama]'");
    $j=mysql_num_rows($edit);
    $r=mysql_fetch_array($edit);
    $jumreq=$r[AdultPax]+$r[ChildPax];
    echo "<h2>Generate Voucher</h2>
          <form method=get action='media.php?'>
          Booking ID <input type=text name=nama value='$nama' size=20>
              <input type=hidden name=module value='voucherex'>
              <input type=submit name=oke value=Search>
          </form>";
          if($j>0){
    echo "<center><form method=POST name='example' action='?module=voucherex&act=save'>
          <input type='hidden' name='id' value='$r[BookingID]'>
          <input type='hidden' name='user' value='$r[TCName]'>
          <table>
          <tr><th colspan='2'>Voucher for $r[BookingID]</th></tr>
          <tr><td>Tour Code</td><td> $r[TourCode]</td></tr>
          <tr><td>Bonus for</td><td> <select name='paks'>";
          for($a=$jumreq;$a>0;$a--){echo"
          <option value='$a'>$a</option>";
          }echo"
          </select> PAX</td></tr>
          <tr><td>Bonus</td><td>
          <input type=checkbox name='free' value='YES' onclick='kuncifree(this.checked)'>&nbsp;Free Visa
          <br>
          <textarea name='promo' cols='30' rows='2' placeholder='Bonus Description'></textarea><br></td></tr>
          <tr><td>Amount</td><td> <select name='bonuscurr' >";
              $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
              while($s=mysql_fetch_array($tampil)){
                  if($s[curr]==$r[Curr]){
                      echo "<option value='$s[curr]' selected>$s[curr]</option>";
                  } else {
                      echo "<option value='$s[curr]' >$s[curr]</option>";
                  }
              }
              echo "</select> <input type=text name='bonusamount' size='12' onkeyup='isNumber(this)' required></td></tr>
          </table>
          <input type='submit' name='submits' value='CREATE VOUCHER' >
          </form>";
          }
     break;  
  
  case "save":
      $EmpName=$_POST[user];
      $today = date("Y-m-d G:i:s");
      $username=$_SESSION[employee_code];
      $sqluser=mysql_query("SELECT employee_name,employee_code FROM tbl_msemployee WHERE employee_code='$username'");
      $tampiluser=mysql_fetch_array($sqluser);
      $PrintName="$tampiluser[employee_name] ($tampiluser[employee_code])";
      $hari= date("Y", time());
      $tampilv = mysql_query("SELECT * FROM tour_voucherpromo where Location = 'LTM'
                ORDER BY VoucherID DESC limit 1");
      $hasilv = mysql_fetch_array($tampilv);
      $jumlahv = mysql_num_rows($tampilv);
      $tahunv = substr($hasilv[VoucherNo],4,4);
      $promo=strtoupper($_POST[promo]);

      $qvalid = mysql_query("SELECT * FROM tour_msbooking
                            left join tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode
                            where BookingID = '$_POST[id]' ");
      $qhasil = mysql_fetch_array($qvalid);
      $target = $qhasil[DateTravelFrom];
      $tanggal = substr($target,8,2);
      $bulan = substr($target,5,2);
      $tahun = substr($target,0,4);
      $valit= date('Y-m-d',strtotime('0 second',strtotime('-2 week',strtotime(date($bulan).'/'.date($tanggal).'/'.date($tahun).' 00:00:00'))));
      if($jumlahv > 0){
          if($hari==$tahunv){
              $tahun1v = $hari;
              $tiketv=substr($hasilv[VoucherNo],9,7)+1;
              switch ($tiketv){
                  case ($tiketv<10):
                      $tiket1v = "000000".$tiketv;
                      break;
                  case ($tiketv>9 && $tiketv<100):
                      $tiket1v = "00000".$tiketv;
                      break;
                  case ($tiketv>99 && $tiketv<1000):
                      $tiket1v = "0000".$tiketv;
                      break;
                  case ($tiketv>999 && $tiketv<10000):
                      $tiket1v = "000".$tiketv;
                      break;
                  case ($tiketv>9999 && $tiketv<100000):
                      $tiket1v = "00".$tiketv;
                      break;
                  case ($tiketv>99999 && $tiketv<1000000):
                      $tiket1v = "0".$tiketv;
                      break;
              }
          } else if ($hari > $tahunv) {
              $tahun1v = $hari;
              $tiket1v="0000001";
          }
      }else {
          $tahun1v = $hari;
          $tiket1v="0000001";
      }
      $reqpromo=$_POST[reqpromo];
      $reqpax=$_POST[paks];
      $paxpromo=$reqpromo+$reqpax;


  mysql_query("INSERT INTO tour_voucherpromo(VoucherNo,
                                             BookingID,
                                             Promo,
                                             Pax,
                                             Curr,
                                             Harga,
                                             ValidDate,
                                             VisaFree,
                                             VoucherStatus,
                                             PrintBy,
                                             RequestDate,
                                             RequestBy,
                                             Location)
                            VALUES ('LTM/$tahun1v$tiket1v',
                                    '$_POST[id]',
                                    '$promo',
                                    '$reqpax',
                                    '$_POST[bonuscurr]',
                                    '$_POST[bonusamount]',
                                    '$valit',
                                    '$_POST[free]',
                                    'APPROVE',
                                    '$PrintName',
                                    '$today',
                                    '$PrintName',
                                    'LTM')");
  $Description="GENERATE Voucher No LTM/$tahun1v$tiket1v ";
  mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
      echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msvoucher'>";
      break;

}
?>
