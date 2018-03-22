<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "../config/koneksi.php";
include "../config/koneksisql.php";

$mssql=mssql_query("SELECT TOP 10 * FROM [PTES].[dbo].[Invoice]");
  while($hasilmssql=mssql_fetch_array($mssql)){
  echo"tes: $hasilmssql[InvoiceID]<br>";      }

$mssql1=mssql_query("SELECT TOP 10 * FROM [HRM].[dbo].[Employee]");
while($hasilmssql1=mssql_fetch_array($mssql1)){
    echo"employee: $hasilmssql1[EmployeeName]<br>";  }
$mssql1=mssql_query("SELECT TOP 10 * FROM [HRM].[dbo].[Employee]");
while($hasilmssql1=mssql_fetch_array($mssql1)){
    echo"employee: $hasilmssql1[EmployeeName]<br>";  }
?>