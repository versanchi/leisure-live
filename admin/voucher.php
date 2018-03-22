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
function kuncifree(me) {
    if(me==true){
    document.example.promo.value='FREE VISA ';
}else{
    document.example.promo.value='';
}
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
<script type="text/javascript">
    setTimeout(window.close, 30000);
</script>
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
  	
    $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[id]'");
    $j=mysql_num_rows($edit);
    $r=mysql_fetch_array($edit);
    $editd=mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_GET[id]' AND VoucherNo = '' AND Gender <> 'INFANT' ");
    $jd=mysql_num_rows($editd);
    $rd=mysql_fetch_array($editd);
    $totreq=$r[ReqPromo];
    $jumreq=$jd;
    $carip=mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_GET[id]' AND VoucherNo <> '' AND RequestBy = 'SYSTEM'");
    $qjd = mysql_fetch_array($carip);
    $promo=$qjd[Promo];
    echo "<h2>REQUEST BONUS</h2>
          <form method=POST name='example' onsubmit='return validateFormOnSubmit(this)' action='voucher.php?act=save'>
          <input type='hidden' name='reqpromo' value='$r[ReqPromo]'><input type='hidden' name='id' value='$r[BookingID]'>
          <input type='hidden' name='user' value='$_GET[user]'>
          ";
            echo "<center><table>
                    
          <tr><td><center>Bonus for: <select name='paks'>";
          for($a=$jumreq;$a>0;$a--){echo"
          <option value='$a'>$a</option>";
          }echo"
          </select> PAX</td></tr>
          <tr><td>
          <input type=checkbox name='free' value='YES' onclick='kuncifree(this.checked)'>&nbsp;Free Visa
          <br>
          <textarea name='promo' cols='30' rows='2' placeholder='Bonus Description'></textarea><br>
          </td></tr>
          </table>
          <input type='submit' name='submits' value='SEND REQUEST' >
          </form>";
     break;  
  
  case "save":
      $username=$_POST[user];
      $sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_code='$username'");
      $tampiluser=mysql_fetch_array($sqluser);
      $EmpName=$tampiluser[employee_name];
      $today = date("Y-m-d G:i:s");
      //running voucher number
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

  mysql_query("UPDATE tour_msbooking set ReqPromo = '$paxpromo'
                                        WHERE BookingID = '$_POST[id]'");
  for($v=1;$v<=$reqpax;$v++){
      mysql_query("UPDATE tour_msbookingdetail set VoucherNo = 'LTM/$tahun1v$tiket1v',Promo='$promo',VisaFree = '$_POST[free]'
                                        WHERE BookingID = '$_POST[id]'
                                        AND VoucherNo = ''
                                        AND Gender <> 'INFANT' limit 1");
  }
  mysql_query("INSERT INTO tour_voucherpromo(VoucherNo,
                                             BookingID,
                                             Promo,
                                             Pax,
                                             ValidDate,
                                             VisaFree,
                                             VoucherStatus,
                                             RequestDate,
                                             RequestBy,
                                             Location)
                            VALUES ('LTM/$tahun1v$tiket1v',
                                    '$_POST[id]',
                                    '$promo',
                                    '$reqpax',
                                    '$valit',
                                    '$_POST[free]',
                                    'REQUEST',
                                    '$today',
                                    '$EmpName',
                                    'LTM')");
  $Description="Request Bonus Voucher No LTM/$tahun1v$tiket1v ";
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
