<?php
$server =  "localhost";
$username = "tourlead";
$password = "admin8tourlead";
$database = "zadmin_dbtl";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

?>
