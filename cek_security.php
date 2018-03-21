<?php 
/*
include "../config/koneksi.php";
$pass=md5($_POST[password]);
$login=mysql_query("SELECT * FROM user WHERE id_user='$_POST[username]' AND password='$pass'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);
*/
//Apabila username dan password ditemukan
if (($_POST[username]=='ins') AND ($_POST[password]=='gate')){
  setcookie("vcookie", "code", time()+3600*24*365,'/','panoramawebsys.web.id');
  setcookie("vaccess", "legal", time()+3600*24*365,'/','panoramawebsys.web.id');
  echo "<link href=config/adminstyle.css rel=stylesheet type=text/css>";
  echo "<center><font color=blue size=6><b>Success</b></font><br>now you can try ";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
  echo "<link href=config/adminstyle.css rel=stylesheet type=text/css>";
  echo "<center><font color=red size=6><b>WRONG CODE!!!</b></font><br><br>";
  echo "<a href=security.php><b>TRY AGAIN</b></a><br> or contact your <a href=mailto:ins@panorama-tours.com>INS Division</a></center>";
}
?>
