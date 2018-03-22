<?php 
// This is a sample code in case you wish to check the username from a mssql db table
//include "./mod/koneksi.php";   
if(isSet($_POST['invoiceno']))
{
$invoiceno = $_POST['invoiceno'];
$bookingid = $_POST['book'];

$dbHost1 = 'localhost';
$dbUsername1 = 'dbvisa';
$dbPassword1 = 'adminphp';
$dbDatabase1 = 'zadmin_dbvisa';
$db1 = mysql_connect($dbHost1, $dbUsername1, $dbPassword1) or die ("Unable to connect to Database Server.");
mysql_select_db ($dbDatabase1, $db1) or die ("Could not select database.");

$dbHost = "10.10.200.3\INS";
$dbUsername = "sa";
$dbPassword = "Entertain04";
$dbDatabase = "PTES";

$sqldata = mysql_query("select * from tour_msbooking where BookingID ='".$bookingid."' AND Status='ACTIVE'");
$data=mssql_fetch_array($sqldata);
$turkod=$data[TourCode];
if($data[TCCompany]=='PANORAMA TOURS'){$compid='1';}else{$compid='2';}

$db = mssql_connect($dbHost, $dbUsername, $dbPassword) or die ("Unable to connect to Database PTES.");
mssql_select_db ($dbDatabase, $db) or die ("Could not select database.");
                          
$sql_check = mssql_query("select [PTES].[dbo].[Invoice].InvoiceID,  [PTES].[dbo].[Invoice].Currency,  [PTES].[dbo].[Invoice].SUBTOTAL
                          FROM  [PTES].[dbo].[Invoice_Details] inner join [PTES].[dbo].[Invoice] on [PTES].[dbo].[Invoice].InvoiceID=[PTES].[dbo].[Invoice_Details].InvoiceID
                          where [PTES].[dbo].[Invoice].InvoiceID='".$invoiceno."' and TOURCODE ='".$turkod."' and  ConfirmationNo='".$bookingid."' and
                          Voided =  '0' and CompanyID='".$compid."' ") or die(mssql_error());

$yes=mssql_num_rows($sql_check);
$isi=mssql_fetch_array($sql_check);
if($yes > 0)
{
echo "OK-$isi[Currency]-$isi[SUBTOTAL]";
}
else
{
echo 'NO';
}

}

?>