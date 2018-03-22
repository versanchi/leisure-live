<?php 
// This is a sample code in case you wish to check the username from a mysql db table
//include "./mod/koneksi.php";   
if(isSet($_POST['prodcode']))
{
$pcode= $_POST['prodcode'];
$dbHost = 'localhost'; // usually localhost
$dbUsername = 'dbvisa';
$dbPassword = 'adminphp';
$dbDatabase = 'zadmin_dbvisa';
//db mwn
/*$dbHost = 'localhost'; // usually localhost
$dbUsername = 'root';
$dbPassword = 'admin8*tour';
$dbDatabase = 't53235_tour'; */
$db = mysql_connect($dbHost, $dbUsername, $dbPassword) or die ("Unable to connect to Database Server.");
mysql_select_db ($dbDatabase, $db) or die ("Could not select database.");

$sql_check = mysql_query("select ProductcodeName from tour_msproductcode where ProductcodeName ='".$pcode."'") or die(mysql_error());

if(mysql_num_rows($sql_check))
{
echo '<font color="red">Product Code <STRONG>'.$tourcode.'</STRONG> already create.</font>';
}
else
{
echo 'OK';
}

}

?>