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
    window.location.reload();
}
</script>
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" />
<?php
include "../config/koneksiemployee.php";
session_start();
$employee_code=$_SESSION['employee_code'];
echo"<center>Login with <select name='division'><option value='$_SESSION[employee_office]'>$_SESSION[employee_office]</option> ";
$sqldiv=mssql_query("SELECT DivisiID FROM [HRM].[dbo].[EmployeeMultiDivisi]
                            WHERE EmployeeID = '$employee_code' AND DivisiID <> '$_SESSION[employee_office]' AND Active='1' ");
        while($hasildiv=mssql_fetch_array($sqldiv)){
             echo"<option value='$hasildiv[DivisiID]'>$hasildiv[DivisiID]</option>";
         }
  echo"</select> Division";
        ?>
        <script language='javascript' type='text/javascript'>
            updatepage();
        </script> <?php

?>
