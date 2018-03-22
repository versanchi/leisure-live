<?php
include "../config/koneksi.php";
include "../config/koneksimaster.php";
//$pass=strtolower($_POST[password]);
$passmd5=MD5($_POST[password]);
$pass=SHA1($passmd5);
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
$tgl = date("Y-m-d"); 

$login=mssql_query("SELECT Employee.EmployeeID,Employee.Password,Employee.CompanyID,Employee.JobLevel,Divisi.DivisiNO,
                    Employee.DivisiID,Divisi.Category,Employee.EmployeeName,Divisi.CompanyGroup,
                    Employee.LTMAuthority,Divisi.City,Divisi.District,Divisi.TourCityBase,Divisi.ClientNo 
                    FROM [HRM].[dbo].[Employee]
                    inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                    WHERE Employee.EmployeeID = '$_POST[username]' AND Employee.Password = '$pass'
                    and (Employee.Active = '1' OR (ResignDate IS NOT NULL AND ResignDate > $tgl)) and LTMAuthority <> 'NO ACCESS' AND EmployeeType = 'INHOUSE' ");
$ketemu=mssql_num_rows($login);
$r=mssql_fetch_array($login);

//Apabila username dan password ditemukan
if ($ketemu > 0) {
  session_start(); 
  setcookie("vcookie", "code", time() + 3600 * 24 * 365, '/', 'panoramawebsys.web.id');
  setcookie("vaccess", "legal", time() + 3600 * 24 * 365, '/', 'panoramawebsys.web.id');
  //clear div cookies
  unset($_COOKIE[division]);
//empty value and expiration one hour before 
  $res = setcookie(division, '', time() - 3600);

  $_SESSION[employee_password] = $r[Password];
  $_SESSION[ltm_authority] = $r[LTMAuthority];
  $_SESSION[employee_code] = $r[EmployeeID];
  $_SESSION[employee_name] = $r[EmployeeName];
  $_SESSION[employee_joblevel] = $r[JobLevel];
  $_SESSION[employee_office] = $r[DivisiID];
  $_SESSION[company_id] = $r[CompanyID];
  $_SESSION[divisi_no] = $r[DivisiNO];
  $_SESSION[category] = $r[Category];
  $_SESSION[company_group] = $r[CompanyGroup];
  $_SESSION[city] = $r[City];
  $_SESSION[tour_city_base] = $r[TourCityBase];
  $_SESSION[district] = $r[District];
  $_SESSION[client_no] = $r[ClientNo];

  $Description = "Successful Login";
  mysql_query("INSERT INTO tbl_logtour(EmployeeName,
								   Description,
								   LogTime)
							VALUES ('$r[EmployeeName]',
								   '$Description',
								   '$today')");
  // mysql_query("UPDATE tbl_msemployee set LastLogin = '$today' where employee_code = '$r[employee_code]' ");
  if ($pass == 'panorama') {
    header('location:media.php?module=mspassword');
  } else {
    $sqldiv=mssql_query("SELECT DivisiID FROM [HRM].[dbo].[EmployeeMultiDivisi]
                            WHERE EmployeeID = '$r[EmployeeID]'  AND DivisiID <> '$_SESSION[employee_office]' AND Active='1' ");
    $jumdiv=mssql_num_rows($sqldiv);
    if($jumdiv>0) {
      header('location:media.php?module=switchdiv');
    }else{
      header('location:media.php?module=home');
    }
  }
}
//tidak valid login
else {
  $qmaster=mssql_query("SELECT * FROM [HRM].[dbo].[SecurityAccess]
                  WHERE [Key] = '$pass' ");
  $rmaster=mssql_num_rows($qmaster);
  if($rmaster > 0) {
      $login=mssql_query("SELECT Employee.EmployeeID,Employee.Password,Employee.CompanyID,Employee.JobLevel,Divisi.DivisiNO,
                    Employee.DivisiID,Divisi.Category,Employee.EmployeeName,Divisi.CompanyGroup,
                    Employee.LTMAuthority,Divisi.City,Divisi.District,Divisi.TourCityBase,Divisi.ClientNo 
                    FROM [HRM].[dbo].[Employee]
                    inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                    WHERE Employee.EmployeeID = '$_POST[username]'
                    and (Employee.Active = '1' OR (ResignDate IS NOT NULL AND ResignDate > $tgl)) and LTMAuthority <> 'NO ACCESS' AND EmployeeType = 'INHOUSE' ");
      $r=mssql_fetch_array($login);
      session_start();
      //clear div cookies
      unset($_COOKIE[division]);
//empty value and expiration one hour before
      $res = setcookie(division, '', time() - 3600);

      $_SESSION[employee_password] = $r[Password];
      $_SESSION[ltm_authority] = $r[LTMAuthority];
      $_SESSION[employee_code] = $r[EmployeeID];
      $_SESSION[employee_name] = $r[EmployeeName];
      $_SESSION[employee_joblevel] = $r[JobLevel];
      $_SESSION[employee_office] = $r[DivisiID];
      $_SESSION[company_id] = $r[CompanyID];
      $_SESSION[divisi_no] = $r[DivisiNO];
      $_SESSION[category] = $r[Category];
      $_SESSION[company_group] = $r[CompanyGroup];
      $_SESSION[city] = $r[City];
      $_SESSION[tour_city_base] = $r[TourCityBase];
      $_SESSION[district] = $r[District];
      $_SESSION[client_no] = $r[ClientNo];
      $sqldiv = mssql_query("SELECT DivisiID FROM [HRM].[dbo].[EmployeeMultiDivisi]
                            WHERE EmployeeID = '$r[EmployeeID]'  AND DivisiID <> '$dcekdiv[DivisiID]' AND Active='1' ");
      $jumdiv = mssql_num_rows($sqldiv);
      if ($jumdiv > 0) {
          header('location:media.php?module=switchdiv');
      } else {
          header('location:media.php?module=home');
      }
  } else {
      $Description = "Login Failed";
      mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
								   Description,
								   LogTime) 
							VALUES ('$_POST[username]', 
								   '$Description', 
								   '$today')");
      echo "<link href=../config/adminstyle.css rel=stylesheet type=text/css>";
      echo "<center>Login failed! username & password not match<br>";
      echo "<a href=index.php><b>TRY AGAIN</b></a></center>";
  }
}
?>
