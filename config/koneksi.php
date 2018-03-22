<?php 
/*$server = "localhost";
$username = "admin_dbvisa";
$password = "adminphp";
$database = "admin_dbvisa";*/

$server = "localhost";
$username = "admin_dbvisa";
$password = "adminphp";
$database = "admin_dbvisa";

// Koneksi dan memilih database di server
$dbltm=mysql_connect($server,$username,$password) or die("Opps sorry, Your Connection failed");
mysql_select_db($database) or die("Database can't open");
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

/*$link = mysql_connect('localhost:/tmp/mysql.sock', 'root', '');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
mysql_close($link);   */

/*$serverms = '192.168.1.248\INS';

// Connect to MSSQL
$linka = mssql_connect($serverms, 'sa', 'insadmin');

if (!$linka) {
    die('Something went wrong while connecting to MSSQL');
} else {echo 'Connected successfully';}  */
?>
