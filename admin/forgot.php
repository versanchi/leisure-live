<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>
<SCRIPT LANGUAGE="JavaScript" SRC="../config/CalendarPopup.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
    var cal = new CalendarPopup();
    cal.showYearNavigation();
    cal.showYearNavigationInput();
</SCRIPT>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $("input:password").chromaHash({bars: 3});
        $("#username").focus();
    });
    function validateFormOnSubmit(theForm) {
        var reason = "";
        reason += validateCek(theForm.birthdate);
        reason += validateIsi(theForm.password);
        if (reason != "") {
            alert("Attention:\n" + reason);
            return false;
        }

        return true;
    }
    function validateIsi(fld) {
        var error = "";
        var confpass = example.confirmpassword;
        var oldpass = example.oldpass;
        var pass1 = fld.value;
        var pass = pass1.toLowerCase();

        if(pass == 'panorama' ){
            fld.style.background = 'Yellow';
            error = "Please DONT use PANORAMA.\n"
        }else if(fld.value != confpass.value ){
            confpass.style.background = 'Yellow';
            error = "Re-enter Your Password.\n"
        }else if(fld.value == oldpass.value ){
            fld.style.background = 'Yellow';
            error = "Please enter NEW Password.\n"
        }else{
            confpass.style.background = 'white';
        }

        return error;
    }
    function validateCek(fld) {
        var error = "";
        if(fld.value=='00-00-0000'){
            fld.style.background = 'Yellow';
            error = "Please Input Your Birth Date.\n"
        }else{
            fld.style.background = 'White';
        }
        return error;
    }
</script>
<style type="text/css" media="screen">
    h1,h2{text-align:center;}
    h1{color:#222;text-shadow:1px 1px 1px #ddd;margin-bottom:0.5em;}
    h2{color:#888;width:80%;margin:0.5em auto 30px auto;font-family:"Palantino",Georgia;font-size:80%;font-style:italic;font-weight:normal;}
    p,label, span{text-shadow:1px 1px 1px #f2f2f2;}
    label{color:#444;display:block;font-variant:small-caps;text-transform:lowercase;}
    p{font-size:77%;color:#444;}
    input{width:150px;font-size:1.5em;margin-bottom:0.75em;}
    .explanation{text-align:center;}
    a{color:#444;}
    a:hover{background:#ddd;}
    a:visited{color:#565656;}
    a:active{color:#fff;background:#444;text-shadow:none;}
    form{width:240px;margin:10px auto;border:none;}
    }
</style>
<html>
<head>
    <title>Welcome to LTM site - Administration Page</title>
    <link href="../config/adminstyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script type="text/javascript" src="../config/jquery.js"></script>

<div id="header">
<?php
include "../config/koneksiemployee.php";
echo"<br><center><font size='5' color='red'><b>FORGOT PASSWORD</b></font></center><br>";
$birth = date('d-m-Y');
switch($_GET[act]) {
    //Tampil Visa
    default:
        echo "
            <form name='example' onsubmit='return validateFormOnSubmit(this)' method='POST' action='forgot.php?act=update'>
                <center><table style='border:0px'><tr><td style='border:0px'><center>
                <input type='hidden' name='employeeid' value='$employee_code'>
                <input type='hidden' name='oldpass' value='$r[Password]'>
                <label>Employee ID</label>
                <input type='employeeid' style='text-align: center' name='employeeid' value='' required>
                <label>Birth Date </label>
                <input type='text' style='text-align: center' value='' placeholder='$birth' name='birthdate' size='10' onClick=" . "cal.select(document.forms['example'].birthdate,'ActIn1','dd-MM-yyyy'); return false;" . " NAME='anchor3' ID='ActIn1' required>
                <input type=submit value=Update> <input type=button value=Cancel onclick=location.href='index.php'>
                </center></td></tr></table></center>
            </form>";
        break;

    case "update":
        $employeeid = $_POST['employeeid'];
        $birth = date('Y-m-d', strtotime($_POST['birthdate']));
        $qcek=mssql_query("select * from [HRM].[dbo].[Employee] where EmployeeID = '$employeeid' and BirthDate ='$birth' ");
        $ktm=mssql_num_rows($qcek);
        if($ktm>0) {
            $Description = "Change forget password Employee (" . $employee_code . ")";
            mssql_query("UPDATE [HRM].[dbo].[Employee] SET Password = 'panorama'
                               WHERE EmployeeID = '$employeeid'");
            mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('$EmpName',
                                   '$Description',
                                   '$today')");
            echo "<META HTTP-EQUIV='Refresh' Content='0; URL=forgot.php?act=success'>";
        }else{
            echo "<META HTTP-EQUIV='Refresh' Content='0; URL=forgot.php?act=failed'>";
        }
        break;

    case "success":
        echo "<center>Your Password has been reset to 'panorama'<br>
              <input type='button' value='Login' onclick=location.href='index.php'></center>";
        break;

    case "failed":
        echo "<center><table style='border:0px'>
              <tr><td colspan='2' style='border:0px'><center>Sorry Employee ID not found or Birth Date wrong</center></td></tr><br>
              <tr><td style='border:0px'><center><input type='button' value='Try Again' width='100px' onclick=location.href='forgot.php'></center></td><td style='border:0px'><center><input type='button' value='Login' onclick=location.href='index.php'></center></td></tr>
              </table></center>";
        break;
}
?>
<div id="footer"> Copyright &copy; 2012 by ISD Division, Panorama Tours Indonesia </div>
</div>
</body>
</html>
