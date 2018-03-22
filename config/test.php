<?php
session_start();
$mssqlHost = "10.10.200.8\INS";
$mssqlUser = "sa";
$mssqlPass = "Entertain04";
$mssqlDB = "HRM";

$link = mssql_connect($mssqlHost,$mssqlUser,$mssqlPass) or die ('Upss we loose connection SQL Server on '.$mssqlHost.' '. mssql_get_last_message());
$db = mssql_select_db($mssqlDB, $link) or die("master database is gone");

$server = "localhost";
$username = "admin_dbvisa";
$password = "adminphp";
$database = "admin_hrdadmin";

//Koneksi dan memilih database di server
$dbltm=mysql_connect($server,$username,$password) or die("Opps sorry, Your Connection failed");
mysql_select_db($database) or die("Database can't open");
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

$module=$_GET[module]; 
$act=$_GET[act];

$timezone_offset = 7;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s",$waktu);
//$today = date("Y-m-d",$waktu);
//$masuk = "07:".str_pad(mt_rand(45,59), 2, "0", STR_PAD_LEFT).":".str_pad(mt_rand(0,59), 2, "0", STR_PAD_LEFT);

switch($_GET[act]) {
//Tampil Office
    default:
        echo "<h2>Attendance</h2>
        <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='test.php?act=input' enctype='multipart/form-data'>
        <select name='empid' required><option value=''>-select-</option>
            <option value='PT060870'>FERRY BUDIONO</option>
            <option value='PT081246'>GANI SUSANTO KHOSASIH</option>
        </select>
        <select name='jenis'>
            <option value='1' selected>Masuk</option>
            <option value='0'>Pulang</option>
        </select>
        <input type='text' name='jam' value='$today'>
        <input type='submit' name='submit' value='Save'>
        </form>";
        //mssql_query("INSERT INTO Attendance(EmployeeID,InOutStat,EmpDateTime,AbsentID,Tgl)
        //                    VALUES ('PT060870','1','$today $masuk','8','$today $masuk')");

        break;

    case "input":
        echo "waktu: $_POST[jam]";
        $sqluser=mssql_query("SELECT EmployeeID,DivisiNo,Employee.DivisiID,Category,EmployeeName,CompanyGroup,LTMAuthority,Divisi.City,TourCityBase FROM [HRM].[dbo].[Employee]
                      inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                      WHERE EmployeeID = '$_POST[empid]'"); 
        $tampiluser=mssql_fetch_array($sqluser);
        mysql_query("INSERT INTO Attendance(EmployeeID,InOutStat,EmpDateTime,AbsentID,Tgl,InputByDivisiID,InputByEmployeeID,InputByEmployeeName,EmployeeName,DivisiID)
                            VALUES ('$_POST[empid]','$_POST[jenis]','$_POST[jam]','1','$_POST[jam]','PSS','PT990070','WIJI ASTUTI','$tampiluser[EmployeeName]','ISD')");
        echo "<input type=button value='Back' onclick=self.history.back()>";
        break;
}
?>
