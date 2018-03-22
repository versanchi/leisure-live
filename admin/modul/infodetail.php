 <script language="javascript" type="text/javascript">
    function updatepage()
    {
        window.close();
        //window.opener.location.reload();                         
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
  reason += validateDateto(theForm.passportissueddate);
  reason += validateDate(theForm.passportvalid);
  reason += validateAmount(theForm.invoiceamount);
  if (reason != "") {
    alert("WARNING!!\n" + reason);
    document.info.elements['submit'].disabled=false; 
    return false;
  }     
  return true;
 }
  function validateDate(fld) {
    var error = "";
    var dep = fld.value;          
    var date = new Date(dep);
    var d  = date.getDate();
    var day = (d < 10) ? '0' + d : d;
    var m = date.getMonth() + 1;
    var month = (m < 10) ? '0' + m : m;
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    var depdate = year + "/" + month + "/" + day ;
    
    var dep = info.batas.value;
    var dates = new Date(dep);  
    var ds  = dates.getDate();
    var days = (ds < 10) ? '0' + ds : ds;
    var ms = dates.getMonth() + 1;
    var months = (ms < 10) ? '0' + ms : ms;
    var yys = dates.getYear();
    var years = (yys < 1000) ? yys + 1900 : yys;
    var sekarang = years + "/" + months + "/" + days ;  
    if (fld.value != "" & fld.value!='0000-00-00') { 
        if (depdate < sekarang) {
            fld.style.background = 'Yellow'; 
            error = "*Passport exp date must be at least six months after the date of departure.\n"
        } else {   
            fld.style.background = 'White';   
        }
    }
    return error;  
}
function validateDateto(fld) {
    var error = "";
    var arr = fld.value;          
    var date = new Date(arr);
    var d  = date.getDate();
    var day = (d < 10) ? '0' + d : d;
    var m = date.getMonth() + 1;
    var month = (m < 10) ? '0' + m : m;
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    var arrdate = year + "/" + month + "/" + day ;
    
    var dep = info.passportvalid.value;
    var dates = new Date(dep);
    var ds  = dates.getDate();
    var days = (ds < 10) ? '0' + ds : ds;
    var ms = dates.getMonth() + 1;
    var months = (ms < 10) ? '0' + ms : ms;
    var yys = dates.getYear();
    var years = (yys < 1000) ? yys + 1900 : yys;
    var depdate = years + "/" + months + "/" + days ; 
                                      
    if (fld.value != "" & fld.value!='0000-00-00') {    
        if (depdate <= arrdate) {
            fld.style.background = 'Yellow'; 
            error = "*Please choose date(passport issued) small than date(passport exp).\n"
        } else {   
            fld.style.background = 'White';   
        }
    }
    return error;
      
} 
function validateAmount(fld) {
    var error = "";
    var arr = eval(fld.value);
    if (fld.value.length != 0) {
        if(arr == 0){
            info.invoiceamount.style.background = 'Yellow';       
            error = "Please Input Invoice Amount.\n" 
        }
        else if(info.invoiceno.value.length == 0){
            info.invoiceno.style.background = 'Yellow';       
            error = "Please Input Invoice No.\n"    
        }else if(info.deviasi.value.length == 0){
            info.deviasi.style.background = 'Yellow';        
            error = "The required field has not been filled in.\n"
        } 
        return error;             
    } else {
        fld.style.background = 'White';
    }
    return error;  
}
function apdetexp() {
var a = new Date(info.passportissueddate.value);   
var ys = a.getYear() + 5;
var years = (ys < 1000) ? ys + 1900 : ys;
var ms = a.getMonth() + 1;
var months = (ms < 10) ? '0' + ms : ms;
var ds = a.getDate();
var yb = ys + 5; 
info.passportvalid.value =  years + "-" + months + "-" + ds;               
      
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
session_start();
$username=$_GET[usr];
$sqluser=mysql_query("SELECT employee_name,employee_code FROM tbl_msemployee WHERE employee_code='$username'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName="$_SESSION[employee_name] ($_SESSION[employee_code])";
$timezone_offset = +5;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");  
switch($_GET[act]){
  // Tampil Office
  default:
    $edit=mysql_query("SELECT * FROM tour_msbookingdetail WHERE IDDetail = '$_GET[id]'");
    $r=mysql_fetch_array($edit);                       
    $ceking = mysql_query("SELECT DateTravelFrom FROM tour_msproduct where TourCode = '$r[TourCode]'");
    $tgl=mysql_fetch_array($ceking);
    $target=$tgl[DateTravelFrom];
    $tanggal = substr($target,8,2);
    $bulan = substr($target,5,2);
    $tahun = substr($target,0,4);             
    $batas= date('Y-m-d',strtotime('-1 second',strtotime('+6 month',strtotime(date($bulan).'/'.date($tanggal).'/'.date($tahun).' 00:00:00')))); 
    echo "<h2>ADDITIONAL INFORMATION</h2>    
          <form method=POST name='info' onsubmit='return validateFormOnSubmit(this)' action='?module=infodetail&act=save'>
          <input type='hidden' name=id value='$_GET[id]'>   
            <center><table><input type='hidden' name='batas' value='$batas'>
            <tr><th colspan=2>PERSONAL INFO</th></tr>
            <tr><td>Birth Place</td><td><input type='text' name='birthplace' value='$r[BirthPlace]'> </td></tr>
            <tr><td>Birth Date</td><td><input type='text' name='birthdate' size='10' value='$r[BirthDate]' onClick="."cal.select(document.forms['info'].birthdate,'ActIn1','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(yyyy-mm-dd)</font> </td></tr>
            <tr><td>Passport Number</td><td><input type='text' name='passportno' value='$r[PassportNo]'> </td></tr>
            <tr><td>Passport Issued Place</td><td><input type='text' name='passportissued' value='$r[PassportIssued]'> </td></tr>
            <tr><td>Passport Issued Date</td><td><input type='text' name='passportissueddate' size='10' value='$r[PassportIssuedDate]' onfocus='apdetexp()' onClick="."cal.select(document.forms['info'].passportissueddate,'ActIn3','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn3'>
           <font color='red'>(yyyy-mm-dd)</font></td></tr>
            <tr><td>Passport Exp Date</td><td><input type='text' name='passportvalid' size='10' value='$r[PassportValid]' onClick="."cal.select(document.forms['info'].passportvalid,'ActIn2','yyyy-MM-dd'); return false;"." NAME='anchor2' ID='ActIn2'>
           <font color='red'>(yyyy-mm-dd)</font></td></tr>                     
            <tr><th colspan=2></th></tr>
            <tr><td>Invoice No</td><td><input type=text name='invoiceno' id='invoiceno' value='$r[DevInvoice]'></td></tr>
            <tr><td>Invoice Amount</td><td><input type=text name='invoiceamount' value='$r[DevAmount]' onkeyup='isNumber(this)'></td></tr>  
            <tr><td>Note For Operation</td><td><textarea name='deviasi' cols='40' rows='3'>$r[Deviasi]</textarea> </td></tr>
            <tr><td>Note For Doc</td><td><input type='text' size='45' name='note4doc' value='$r[Note4Doc]'> </td></tr>
            </table>     
          <center><input type='submit' name='submit' value='Save' > 
          </form>";
     break;  
  
case "save":                           
  $Description="Add Info Detail ($_POST[id])"; 
  $birthp=strtoupper($_POST[birthplace]);
  $pasno=strtoupper($_POST[passportno]);
  $dev=strtoupper($_POST[deviasi]);
  $pasis=strtoupper($_POST[passportissued]);
  mysql_query("UPDATE tour_msbookingdetail set BirthPlace = '$birthp',
                                        BirthDate = '$_POST[birthdate]', 
                                        PassportNo = '$pasno',
                                        PassportIssued = '$pasis',
                                        PassportIssuedDate = '$_POST[passportissueddate]',
                                        PassportValid = '$_POST[passportvalid]',
                                        Note4Doc = '$_POST[note4doc]',
                                        Deviasi = '$dev',
                                        DevInvoice = '$_POST[invoiceno]',
                                        DevAmount = '$_POST[invoiceamount]'
                                        WHERE IDDetail = '$_POST[id]'");
  
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
