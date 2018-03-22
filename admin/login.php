<html>
<head>
<title>Welcome to Document Operation - Administration Page</title>
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" />
</head>
<body onLoad="document.myform.username.focus();">
<div id="header"> 
  <div id="content_head"> 
    <!--<h2>Login</h2> --><br>
    <img src="images/login-welcome.gif" width="97" height="105" hspace="10" align="left"> 
    <form name="myform" method="POST" action="cek_login.php">
      <table>
        <tr style="border: hidden;"> 
          <td style="border: hidden;">Username</td>
          <td>  
            <input type="text" name="username"></td>
        </tr>
        <tr style="border: hidden;"> 
          <td style="border: hidden;">Password</td>
          <td>  
            <input type="password" name="password"></td>
        </tr>
        <tr style="border: hidden;"> 
          <td colspan="2"><center><input type="submit" value="Login"></td>
        </tr>
      </table>
    </form>
    <p>&nbsp;</p>
  </div>
   <div id="footer"> Copyright &copy; 2011 by ICT Division, Panorama Tours - Indonesia </div>        
</div>
</body>
</html>
