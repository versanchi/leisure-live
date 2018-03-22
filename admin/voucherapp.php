 <script language="javascript" type="text/javascript">
    function updatepage()
    {
        window.close();
        window.opener.location.reload();
    }
 function isNumber(field) {
var re = /^[0-9'.']*$/;
if (!re.test(field.value)) {
alert('PLEASE INPUT NUMBER!');
field.value = field.value.replace(/[^0-9'.']/g,"");
}
}
 function validateFormOnSubmit(theForm) {
var reason = ""; 
  reason += validateDate(theForm.validdate);
  if (reason != "") {
    alert("WARNING!!\n" + reason);
    return false;
  }     
  return true;
 }
  function validateDate(fld) {
    var error = "";
    var datefrom1 = fld.value;
    dep1 = datefrom1.split("-");
    var val = dep1[2]+ "/" +dep1[1]+ "/" +dep1[0];
    var date = new Date(val);
    var d  = date.getDate();
    var day = (d < 10) ? '0' + d : d;
    var m = date.getMonth() + 1;
    var month = (m < 10) ? '0' + m : m;
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    var vdate = year + "/" + month + "/" + day ;

    var dep = info.departure.value;
    var dates = new Date(dep);
    var ds  = dates.getDate();
    var days = (ds < 10) ? '0' + ds : ds;
    var ms = dates.getMonth() + 1;
    var months = (ms < 10) ? '0' + ms : ms;
    var yys = dates.getYear();
    var years = (yys < 1000) ? yys + 1900 : yys;
    var sekarang = years + "/" + months + "/" + days ;

    var hdates = new Date();
    var hds  = hdates.getDate();
    var hdays = (hds < 10) ? '0' + hds : hds;
    var hms = hdates.getMonth() + 1;
    var hmonths = (hms < 10) ? '0' + hms : hms;
    var hyys = hdates.getYear();
    var hyears = (hyys < 1000) ? hyys + 1900 : hyys;
    var hrini = hyears + "/" + hmonths + "/" + hdays ;
      if (vdate < hrini) {
          fld.style.background = 'Yellow';
          error = "Valid date small than today.\n"
      } else if (vdate > sekarang) {
            fld.style.background = 'Yellow'; 
            error = "*Valid date can't bigger from departure date.\n"

        } else {   
            fld.style.background = 'White';
        }
    return error;  
}

</script>     
 <SCRIPT LANGUAGE="JavaScript" SRC="../config/CalendarPopup.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
    var cal = new CalendarPopup();
cal.showYearNavigation();
cal.showYearNavigationInput(); 
</SCRIPT>
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" /> 
<?php 
include "../config/koneksi.php"; 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$username=$_SESSION[employee_code];
$sqluser=mysql_query("SELECT employee_name,employee_code FROM tbl_msemployee WHERE employee_code='$username'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName="$tampiluser[employee_name] ($tampiluser[employee_code])";
$timezone_offset = +5;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");  
switch($_GET[act]){
  // Tampil Office
  default:
    $edit=mysql_query("SELECT * FROM tour_voucherpromo WHERE VoucherNo = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $qvalid = mysql_query("SELECT * FROM tour_msbooking
                            left join tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode
                            where BookingID = '$r[BookingID]' ");
    $qhasil = mysql_fetch_array($qvalid);
    $target = $qhasil[DateTravelFrom];
    $tanggal = substr($target,8,2);
    $bulan = substr($target,5,2);
    $tahun = substr($target,0,4);
    $valit= date('Y-m-d',strtotime('0 second',strtotime('-2 week',strtotime(date($bulan).'/'.date($tanggal).'/'.date($tahun).' 00:00:00'))));
    $VD = date('d-m-Y', strtotime($r[ValidDate]));
    echo "<h2>Voucher No: $r[VoucherNo]</h2>
          <form method=POST name='info' onsubmit='return validateFormOnSubmit(this)' action='?module=voucherapp&act=save'>
          <input type='hidden' name=id value='$_GET[id]'><input type='hidden' name='productid' value='$_GET[prod]'>
           <center>
           <table style='border:0px'><input type='hidden' name='departure' value='$qhasil[DateTravelFrom]'>
           <tr><td style='border:0px'>Valid Date: <input type='text' name='validdate' size='10' value='$VD' onClick="."cal.select(document.forms['info'].validdate,'ActIn2','dd-MM-yyyy'); return false;"." NAME='anchor2' ID='ActIn2'>
           <font color='red'>(dd-mm-yyyy)</font></td></tr>
           <tr><td style='border:0px'>Amount: <select name='bonuscurr' >";
    $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
    while($s=mysql_fetch_array($tampil)){
        if($s[curr]==$qhasil[Curr]){
            echo "<option value='$s[curr]' selected>$s[curr]</option>";
        } else {
            echo "<option value='$s[curr]' >$s[curr]</option>";
        }
    }
    echo "</select> <input type=text name='bonusamount' size='12' onkeyup='isNumber(this)' required></td></tr>
           </table>
          <center><input type='submit' name='submit' value='APPROVE' >
          </form>";
     break;  
  
case "save":
  $Description="Approve Voucher No: $_POST[id]";
  $VD = date('Y-m-d', strtotime($_POST[validdate]));
  mysql_query("UPDATE tour_voucherpromo set VoucherStatus = 'APPROVE',
                                        ValidDate = '$VD',
                                        Curr = '$_POST[bonuscurr]',
                                        Harga = '$_POST[bonusamount]',
                                        ApproveBy = '$EmpName',
                                        ApproveDate = '$today'
                                        WHERE VoucherNo = '$_POST[id]'");

  mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')"); 
  ?>
  <script language='javascript' type='text/javascript'>
    updatepage();
   
</script> <?php 
}
?>
