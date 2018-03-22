<?php
$mssqlHost = "10.10.200.8\INS";
$mssqlUser = "sa";
$mssqlPass = "Entertain04";
$mssqlDB = "HRM";
//
/*$mssqlHost = "10.10.200.2\INS";
$mssqlUser = "sa";
$mssqlPass = "insadmin";
$mssqlDB = "HeadMaster";*/

$link = mssql_connect($mssqlHost,$mssqlUser,$mssqlPass) or die ('Upss we loose connection SQL Server on '.$mssqlHost.' '. mssql_get_last_message());
$db = mssql_select_db($mssqlDB, $link) or die("master database is gone");
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
//
?>
