<script>           
                              
    function delete_cookie(name) {
      document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
    }
    var cookie_name = 'pop';
    delete_cookie(cookie_name);
    </script>        
<?php 
  session_start();
  include "../config/koneksi.php";
  include "../config/library.php";
  $employee_code=$_SESSION['employee_code'];
  $sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_code = '$employee_code'");
  $tampiluser=mysql_fetch_array($sqluser);
  $EmpName=$tampiluser['employee_name'];
  $timezone_offset = -1;
  $tz_adjust = ($timezone_offset * 60 * 60);
  $jam = time();
  $waktu = ($jam + $tz_adjust);
  $today = date("Y-m-d G:i:s");
  $Description="Successful Logout";
  mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
								   Description,
								   LogTime) 
							VALUES ('$EmpName', 
								   '$Description', 
								   '$today')");
  session_destroy();
  
 // header('location:index.php');  
?>
<html>
<head>
<title>Leisure Booking Site</title>
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script src="../config/jquery.cookie.js"></script>
<script type="text/javascript" src="../config/jquery.js"></script>    
    
<div id="header"> 
   
    <?php echo"<br><center><font size='5' color='red'><b>Logout successful</b></font></center><br>" ?>
    <form method="POST" action="index.php">
     <center>You have successfully logged out from the site. Thank you.</center><br> 
     <center><input type="submit" value="Go to mainpage"></center>             
    </form>
    <p>&nbsp;</p>
  
  <div id="footer"> Copyright &copy; 2012 by ISD Division, Panorama JTB Tours Indonesia </div>
</div>
</body>
</html>