<html>
<head>
<META NAME="Title" CONTENT="LTM operation">
<META NAME="Author" CONTENT="Ferry Budiono">
<META NAME="Copyright" CONTENT="�2012 - Ferry Budiono">
<META NAME="Designer" CONTENT="versanchi">                               
<META NAME="Publisher" CONTENT="Panorama Tours Indonesia">
<title>Welcome to LTM site - Administration Page</title>
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" />
</head>
<body onLoad="document.myform.username.focus();">
<div id="header"> 
  <div id="content_head"> 
    <h2>Login</h2>
    <img src="images/login-welcome.gif" width="97" height="105" hspace="10" align="left"> 
             <form method="POST" action="cek_login.php">
      <table>
        <tr style="border: hidden;">
          <td style="border: hidden;">Employee ID</td>
          <td>  
            <input type="text" name="username"></td>
        </tr>
        <tr style="border: hidden;">
          <td>Password</td>
          <td style="border: hidden;">  
            <input type="password" name="password"></td>
        </tr>
        <tr style="border: hidden;">
          <td colspan="2"><center><input type="submit" value="Login"></center></td>
        </tr>
      </table>
    </form>
    <p>&nbsp;</p>
  </div>
  <div id="footer"> Copyright &copy; 2012 by INS Division, Panorama Tours Indonesia </div>    
</div>
</body>
</html>
