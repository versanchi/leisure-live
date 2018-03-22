 <script language="javascript" type="text/javascript">
    function updatepage()
    {
        window.close();
        window.opener.location.reload();                         
    }
 function validateFormOnSubmit(theForm) {
var reason = ""; 
  reason += validateDateto(theForm.visadateline);   
  if (reason != "") {
    alert("WARNING!!\n" + reason);
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
    ambil = fld.value; 
    hasil = ambil.split("-");
    var arr = hasil[2]+ "-" +hasil[1]+ "-" +hasil[0]; 
    var date = new Date(arr);
    var d  = date.getDate();
    var day = (d < 10) ? '0' + d : d;
    var m = date.getMonth() + 1;
    var month = (m < 10) ? '0' + m : m;
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    var visadate = year + "/" + month + "/" + day ;
    
    var dep = info.departuredate.value;
    var dates = new Date(dep);
    var ds  = dates.getDate();
    var days = (ds < 10) ? '0' + ds : ds;
    var ms = dates.getMonth() + 1;
    var months = (ms < 10) ? '0' + ms : ms;
    var yys = dates.getYear();
    var years = (yys < 1000) ? yys + 1900 : yys;
    var depdate = years + "/" + months + "/" + days ; 
    
    var dates1 = new Date();
    var ds1  = dates1.getDate();
    var days1 = (ds1 < 10) ? '0' + ds1 : ds1;
    var ms1 = dates1.getMonth() + 1;
    var months1 = (ms1 < 10) ? '0' + ms1 : ms1;
    var yys1 = dates1.getYear();
    var years1 = (yys1 < 1000) ? yys1 + 1900 : yys1;
    var sekarang = years1 + "/" + months1 + "/" + days1 ; 
                                      
    if (fld.value != "" & fld.value!='00-00-0000') {    
        if (visadate < sekarang) {
        fld.style.background = 'Yellow'; 
        error = sekarang+visadate+"*Visa Dateline small than today.\n"
        }else if (visadate > depdate) {
            fld.style.background = 'Yellow'; 
            error = "*Visa Dateline large than Departure.\n"
        } else {   
            fld.style.background = 'White';   
        }
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
$username=$_GET[usr];
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
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[code]'");
    $r=mysql_fetch_array($edit);        
    $batas= date('Y-m-d',strtotime('-1 second',strtotime('+6 month',strtotime(date($bulan).'/'.date($tanggal).'/'.date($tahun).' 00:00:00')))); 
    $VD = date('d-m-Y', strtotime($r[VisaDateline]));
    if($r[VisaDateline]=='0000-00-00'){$VD='00-00-0000';}else{$VD=$VD;}
    echo "<h2>VISA DATELINE</h2>    
          <form method=POST name='info' onsubmit='return validateFormOnSubmit(this)' action='?module=visadateline&act=save'>
          <center><table>
          <input type='hidden' name=id value='$_GET[code]'><input type='hidden' name='departuredate' value='$r[DateTravelFrom]'>    
          <tr><td>Visa Dateline</td><td><input type='text' name='visadateline' size='10' value='$VD' onClick="."cal.select(document.forms['info'].visadateline,'ActIn2','dd-MM-yyyy'); return false;"." NAME='anchor2' ID='ActIn2'>
          <font color='red'>(dd-MM-yyyy)</font></td></tr>
          </table>     
          <center><input type='submit' name='submit' value='Save' > 
          </form>";
     break;  
  
case "save":                           
  $Description="Update Visa Dateline ($_POST[id])"; 
  $VisaDateline = date('Y-m-d', strtotime($_POST['visadateline']));  
  mysql_query("UPDATE tour_msproduct SET VisaDateline = '$VisaDateline'
                               WHERE IDProduct = '$_POST[id]'");
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
