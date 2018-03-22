<?php 
// This is a sample code in case you wish to check the username from a mssql db table
//include "./mod/koneksi.php";
if(isSet($_POST['depositno']))
{
$depositno = $_POST['depositno'];
$comp = $_POST['comp'];
$compid = $_POST['compid'];
$cat = $_POST['cat'];
$dbHost = "10.10.200.3\INS";
$dbUsername = "sa";
$dbPassword = "Entertain04";
$dbDatabase = "PTES";
//db mwn
/*$dbHost = 'localhost'; //  usually localhost
$dbUsername = 'root';
$dbPassword = 'admin8*tour';
$dbDatabase = 't53235_tour';*/
$db = mssql_connect($dbHost, $dbUsername, $dbPassword) or die ("Unable to connect to Database PTES.");
mssql_select_db ($dbDatabase, $db) or die ("Could not select database.");

if($cat=='TOPUP' and $compid=='2') {$compcsr = 2;}else{$compcsr = $comp;}
$sql_check = mssql_query("SELECT [CashReceiptId],[Currency],[TotalAmount]
                          FROM [PTES].[dbo].[CashReceipt]
                          where [CashReceiptId] ='".$depositno."' AND ([Status] = 'A' OR [Status] = 'P')  AND [COMPANYID]='".$compcsr."'") or die(mssql_error());

$dbHost1 = 'localhost';
$dbUsername1 = 'dbvisa';
$dbPassword1 = 'adminphp';
$dbDatabase1 = 'zadmin_dbvisa';
$db1 = mysql_connect($dbHost1, $dbUsername1, $dbPassword1) or die ("Unable to connect to Database Server.");
mysql_select_db ($dbDatabase1, $db1) or die ("Could not select database.");
if($comp=='1'){$tccomp='PANORAMA TOURS';}else if($comp=='2'){$tccomp='TUR EZ';}else {$tccomp='PANORAMA WORLD';}
$sql_check1 = mysql_query("select DepositNo from tour_msbooking where BookingStatus = 'DEPOSIT' AND DepositNo ='".$depositno."' AND TCCompany ='".$tccomp."' AND Status='ACTIVE'") or die(mysql_error());
$yes=mssql_num_rows($sql_check);
$yes1=mysql_num_rows($sql_check1);
$isi=mssql_fetch_array($sql_check);
if($yes > 0)
{
    if($yes1 > 0){
    echo "DP-$isi[Currency]-$isi[TotalAmount]";
    }
    else
    {
    echo "OK-$isi[Currency]-$isi[TotalAmount]";
    }                                
}
else
{
echo 'NO';
}

}

?>