<?php 
$server1 =  "localhost";
$username1 = "admin_dbvisa";
$password1 = "adminphp";
$dbfbd = "admin_dbfbd";

$dbfabs=mysql_connect($server1,$username1,$password1) or die("failure connection");
mysql_select_db($dbfbd) or die("FABS Database can not to open");

?>
