<?php
//koneksi database employee
$mssqlHost1 = "10.10.200.3\INS";
$mssqlUser1 = "sa";
$mssqlPass1 = "Entertain04";
$mssqlDB1 = "PTES";
$linkptes = mssql_connect($mssqlHost1,$mssqlUser1,$mssqlPass1) or die ('Upss we loose PTES connection Server on '.$mssqlHost1.' '. mssql_get_last_message());
$dbptes = mssql_select_db($mssqlDB1, $linkptes) or die("PTES database is gone");

//koneksi database master
/*$mssqlHost2 = "10.10.200.2\INS";
$mssqlUser2 = "sa";
$mssqlPass2 = "insadmin";
$mssqlDB2 = "HeadMaster";
$linkkurs = mssql_connect($mssqlHost2,$mssqlUser2,$mssqlPass2) or die ('Upss we loose connection SQL Server on '.$mssqlHost2.' '. mssql_get_last_message());
$dbkurs = mssql_select_db($mssqlDB2, $linkkurs) or die("master database is gone");

//koneksi database PTES
/*
$mssqlHost = "10.10.200.3\INS";
$mssqlUser = "sa";
$mssqlPass = "Entertain04";                   
$mssqlDB = "PTES";
*/
//---------------
/*$mssqlHost3 = "10.10.200.6\INS";
$mssqlUser3 = "sa";
$mssqlPass3 = "insadmin";
$mssqlDB3 = "DCR_TOPUP";
$linkptes = mssql_connect($mssqlHost3,$mssqlUser3,$mssqlPass3) or die ('Sorry we loose connection to SQL Server on '.$mssqlHost3.' '. mssql_get_last_message());
$dbptes = mssql_select_db($mssqlDB3, $linkptes) or die("Tidak dapat menggunakan database ");*/
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
///
?>
