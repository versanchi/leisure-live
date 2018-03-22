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
    reason += validateEmpty(theForm.birthdate);
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
function validateEmpty(fld) {
    var error = "";

    if (fld.value.length == 0 || fld.value=='0000-00-00') {
        fld.style.background = 'Yellow';
        error = "The required field has not been filled in.\n"
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
function getAge() {
    var datefrom1 = info.birthdate.value;
    var gender = info.gender.value;
    dep1 = datefrom1.split("-");
    var dateString = dep1[1]+ "/" +dep1[2]+ "/" +dep1[0];
    //var dateString = new Date(dep); 09/09/1989

    var now = new Date();
    var today = new Date(now.getYear(),now.getMonth(),now.getDate());

    var yearNow = now.getYear();
    var monthNow = now.getMonth();
    var dateNow = now.getDate();

    var dob = new Date(dateString.substring(6,10),
        dateString.substring(0,2)-1,
        dateString.substring(3,5)
    );

    var yearDob = dob.getYear();
    var monthDob = dob.getMonth();
    var dateDob = dob.getDate();
    var age = {};
    var ageString = "";
    var yearString = "";
    var monthString = "";
    var dayString = "";


    yearAge = yearNow - yearDob;

    if (monthNow >= monthDob)
        var monthAge = monthNow - monthDob;
    else {
        yearAge--;
        var monthAge = 12 + monthNow -monthDob;
    }

    if (dateNow >= dateDob)
        var dateAge = dateNow - dateDob;
    else {
        monthAge--;
        var dateAge = 31 + dateNow - dateDob;

        if (monthAge < 0) {
            monthAge = 11;
            yearAge--;
        }
    }

    age = {
        years: yearAge,
        months: monthAge,
        days: dateAge
    };

    if ( age.years > 1 ) yearString = " Tahun";
    else yearString = " Tahun";
    if ( age.months> 1 ) monthString = " Bulan";
    else monthString = " Bulan";
    if ( age.days > 1 ) dayString = " Hari";
    else dayString = " Hari";


    if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
        ageString = age.days + dayString ;
    else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
        ageString = age.years + yearString + " old. Happy Birthday!!";
    else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
        ageString = age.years + yearString + " and " + age.months + monthString ;
    else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
        ageString = age.months + monthString + " and " + age.days + dayString ;
    else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
        ageString = age.years + yearString + " and " + age.days + dayString ;
    else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
        ageString = age.months + monthString + " old.";
    else ageString = "";
    //infant
    if(gender=='INFANT'){
        if(age.years>0){blnthn=age.years*12}else{blnthn=0}
        umurnya=blnthn + age.months;
        blkg=" Month";
    }else{
        umurnya=age.years;
        blkg=" Year";
    }
    if(dateString=='00/00/0000' || datefrom1==''){umur=''}else{umur=umurnya + blkg}
    info.age.value=umur ;
    if(umur!=''){
        if(gender=='INFANT'){
            if(umurnya>23){alert("MAXIMUM AGE FOR INFANT IS 23 MONTH");
                info.birthdate.value='0000-00-00';
                info.age.value='';
            }
        }else if(gender=='CHILD'){
            if(umurnya>11){alert("MAXIMUM AGE FOR CHILD IS 11 YEAR");
                info.birthdate.value='0000-00-00';
                info.age.value='';
            }
        }
    }
    return ageString;

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
include "../config/koneksimaster.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$username=$_GET[usr];
$sqluser=mssql_query("SELECT * FROM [HRM].[dbo].[Employee]
                      WHERE EmployeeID = '$_SESSION[employee_code]'");
$tampiluser=mssql_fetch_array($sqluser);
$EmpName="$tampiluser[EmployeeName] ($tampiluser[EmployeeID])";
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
        $ceking = mysql_query("SELECT DateTravelFrom,SellingCurr FROM tour_msproduct where TourCode = '$r[TourCode]'");
        $tgl=mysql_fetch_array($ceking);
        $target=$tgl[DateTravelFrom];
        $tanggal = substr($target,8,2);
        $bulan = substr($target,5,2);
        $tahun = substr($target,0,4);
        $batas= date('Y-m-d',strtotime('-1 second',strtotime('+6 month',strtotime(date($bulan).'/'.date($tanggal).'/'.date($tahun).' 00:00:00'))));
        if($r[DevAmount]=='0'){$DevAmount='';}else{$DevAmount=$r[DevAmount];}
        echo "<h2>ADDITIONAL INFORMATION</h2>
          <form method=POST name='info' onsubmit='return validateFormOnSubmit(this)' action='?module=infodetail&act=save'>
          <input type='hidden' name=id value='$_GET[id]'><input type='hidden' name='bookingid' value='$r[BookingID]'>    
            <center><table class='bordered'><input type='hidden' name='batas' value='$batas'><input type='hidden' name='gender' value='$r[Gender]'>
            <tr><th colspan=2>PERSONAL INFO</th></tr>
            <tr><td>Birth Place</td><td>$r[BirthPlace]</td></tr>
            <tr><td>Birth Date</td><td>".date("d M Y", strtotime($r[BirthDate]))."</td></tr>
            <tr><td>Age when Travel</td><td>$r[Age]</td></tr>
            <tr><td>Passport Number</td><td>$r[PassportNo]</td></tr>
            <tr><td>Passport Issued Place</td><td>$r[PassportIssued]</td></tr>
            <tr><td>Passport Issued Date</td><td>".date("d M Y", strtotime($r[PassportIssuedDate]))."</td></tr>
            <tr><td>Passport Exp Date</td><td>".date("d M Y", strtotime($r[PassportValid]))."</td></tr>
           <tr><td colspan='2'>
           <input type=radio name='holdingvisa' value='NO'";if($r[HoldingVisa]=='NO' OR $r[HoldingVisa]==''){echo"checked";}echo">&nbsp;No Visa
           <input type=radio name='holdingvisa' value='FOREIGN VISA'";if($r[HoldingVisa]=='FOREIGN VISA'){echo"checked";}echo">&nbsp;Foreign Visa
           <input type=radio name='holdingvisa' value='HOLDING VISA'";if($r[HoldingVisa]=='HOLDING VISA'){echo"checked";}echo">&nbsp;Holding Visa
           <input type=radio name='holdingvisa' value='OWN ARRANGEMENT'";if($r[HoldingVisa]=='OWN ARRANGEMENT'){echo"checked";}echo">&nbsp;Own Arrangement
           </td></tr>
           <tr><td>Note For Doc</td><td><input type='text' size='45' name='note4doc' value='$r[Note4Doc]'> </td></tr>
            <tr><th colspan=2>DEVIASI INFO</th></tr>
            <tr><td>Invoice No</td><td><input type=text name='invoiceno' id='invoiceno' value='$r[DevInvoice]'></td></tr>
            <tr><td>Invoice Amount</td><td>$tgl[SellingCurr]. <input type=text name='invoiceamount' value='$DevAmount' onkeyup='isNumber(this)'></td></tr>  
            <tr><td>Note For Operation</td><td><textarea name='deviasi' cols='40' rows='3'>$r[Deviasi]</textarea> </td></tr>
            </table>     
          <center><input type='submit' name='submit' value='Save' > 
          </form>
          ";
        break;

    case "save":
        $Description="Add Info Detail ($_POST[id])";
        $birthp=strtoupper($_POST[birthplace]);
        $PassNo1=strtoupper($_POST[passportno]);
        $PassNo2=str_replace(" ","", $PassNo1);
        $passno=trim($PassNo2);
        $dev=strtoupper($_POST[deviasi]);
        $pasis=strtoupper($_POST[passportissued]);
        mysql_query("UPDATE tour_msbookingdetail set HoldingVisa = '$_POST[holdingvisa]',
                                        Note4Doc = '$_POST[note4doc]',
                                        Deviasi = '$dev',
                                        DevInvoice = '$_POST[invoiceno]',
                                        DevAmount = '$_POST[invoiceamount]'
                                        WHERE IDDetail = '$_POST[id]'");
        $edit=mysql_query("SELECT sum(DevAmount)as DevPrice FROM tour_msbookingdetail WHERE BookingID = '$_POST[bookingid]' and Status <> 'CANCEL'");
        $r=mysql_fetch_array($edit);
        mysql_query("UPDATE tour_msbooking set DevPrice = '$r[DevPrice]'
                                        WHERE BookingID = '$_POST[bookingid]'");
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$username',
                                   '$Description', 
                                   '$today')");
        ?>
        <script language='javascript' type='text/javascript'>
            updatepage();

        </script> <?php
}
?>
