<script language="javascript" type="text/javascript">
function updatepage()
{
    window.close();
    window.opener.location.reload();
}
function setCookie(c_name,value,expiredays) {
    var exdate=new Date()
    exdate.setDate(exdate.getDate()+expiredays)
    document.cookie=c_name+ "=" +escape(value)+
        ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
    window.location.reload()
}
function setCookies() {
    var nilai = document.getElementById('div');
    var exdate=new Date();
    var c_name = 'division';
    var expiredays = 365;
    exdate.setDate(exdate.getDate()+expiredays)
    document.cookie=c_name+ "=" +escape(nilai.value)+
        ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
    window.location.reload()
}
</script>
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" />
<?php
include "../config/koneksiemployee.php";
session_start();
// store cookie in session variable
if($_COOKIE["division"]<>''){
    $_SESSION[employee_office]= $_COOKIE["division"];
    echo"<center><img src='../images/loading.gif'><br>LOADING......</center><META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=home'>";
}else {
    $employee_code = $_SESSION['employee_code'];
    echo "<center>
CONTINUE WITH YOUR DIVISION ($_SESSION[employee_office])? <input type='button' onclick=location='media.php?module=home' value='YES'><br>
OR<br>SELECT OTHER DIVISION: ";
    $sqldiv = mssql_query("SELECT DivisiID FROM [HRM].[dbo].[EmployeeMultiDivisi]
                            WHERE EmployeeID = '$employee_code' AND DivisiID <> '$_SESSION[employee_office]' AND Active='1' order by DivisiID");
    $totaldiv=mssql_num_rows($sqldiv);
    if($totaldiv<5) {
        while ($hasildiv = mssql_fetch_array($sqldiv)) {
            //echo "<a href=\"javascript:setCookie('division', '$hasildiv[DivisiID]', 365)\">$hasildiv[DivisiID]</a>";
            //echo "<button type='button' href=\"javascript:setCookie('division', '$hasildiv[DivisiID]', 365)\">Permalink</button>";
            ?><input type="button" value="<?PHP echo " $hasildiv[DivisiID] "; ?>"
                     onClick="Javascript:setCookie('division', <?PHP echo " '$hasildiv[DivisiID]' "; ?>, 365)" /> <?PHP
        }
    }else {
        echo "<select name='div' id='div'>
        <option value=''>select</option>";
        while ($hasildiv = mssql_fetch_array($sqldiv)) {
            echo "<option value='$hasildiv[DivisiID]'>$hasildiv[DivisiID]</option>";
        }
        echo "
        </select>
        <input type='button' value='Change' onclick=setCookies()>";
    }
}
?>
