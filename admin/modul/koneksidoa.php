<?php
$server = "localhost";
$username = "t53235_dbdoa";
$password = "admin8*doa";
$database = "t53235_dbdoa";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
