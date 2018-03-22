<?php  /*
if (isset($_COOKIE['mycookie']) && ($_COOKIE['mycookie']== "LBD")) {
                                                                                                  
} else {
    header("location: http://tour.panorama-tours.com/security.php");
    exit;
}                                                                       
?>
<?php 
/*if (isset($_COOKIE['mycookie']) && ($_COOKIE['mycookie']== "LBD")) { ?>  
<html>
<head>
<META NAME="Title" CONTENT="LTM operation">
<META NAME="Author" CONTENT="Ferry Budiono">
<META NAME="Copyright" CONTENT="©2012 - Ferry Budiono">
<META NAME="Designer" CONTENT="versanchi">
<META NAME="Publisher" CONTENT="Panorama Tours Indonesia">
<title>Welcome to LTM site - Administration Page</title>
<link type="text/css" href="../config/style000.css" rel="stylesheet"/>  
<link href="../config/frontstyle.css" rel="stylesheet" type="text/css" />
<link href="../config/loginstyle.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=1.4.2"></script>
<script src="../config/login.js"></script>
<style>
        * { margin: 0; padding: 0; }
        
        html { 
            background: url(../admin/images/backgrounds.jpg) no-repeat center center fixed;  
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        
        
    </style> 
</head>
<body onLoad="document.myform.username.focus();" >

<div id="header">        
  <div id="content_head">
   
    <!--<h2>Login</h2><center>
    <img src="images/login-welcome.gif" width="97" height="105" hspace="10" align="center">
    <img src="images/santaclaus.png" width="97" height="105" hspace="10" align="left"> -->
    <center>                                    
    <div id="bar">
        <div id="container">
            <!-- Login Starts Here -->
            <div id="loginContainer">
                <a href="#" id="loginButton"><span>Login</span><em></em></a>
                <div style="clear:both"></div>
                <div id="loginBox">                
                    <form id="loginForm" method="POST" action="cek_login.php">
                        <fieldset id="body">
                            <fieldset>
                                <label for="email">Employee ID</label>
                                <input type="text" name="username" id="email" />
                            </fieldset>
                            <fieldset>
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" />
                            </fieldset>
                            <input type="submit" id="login" value="Login" />         
                        </fieldset>               
                    </form>
                </div>
            </div>                                                                  
            <!-- Login Ends Here -->
        </div>
    </div>
   <!-- <table>
        <tr style="border: hidden;">
          <td style="border: hidden;">
    <iframe style="height: 326px; width: auto;" title="Weather Forecast" src="http://www.wweather.info/weathergadget01/" frameborder="0" scrolling="no" width="320" height="300"></iframe>
    </td><td style="border: hidden;">
    <script type="text/javascript" src="http://cdn.widgetserver.com/syndication/subscriber/InsertWidget.js"></script><script type="text/javascript">if (WIDGETBOX) WIDGETBOX.renderWidget('50fd5066-8108-4039-a02b-ea18329b08fe');</script>
<noscript>Get the <a href="http://www.widgetbox.com/widget/travel-picture-of-the-day">Travel Picture of the day</a> widget and many other <a href="http://www.widgetbox.com/">great free widgets</a> at <a href="http://www.widgetbox.com">Widgetbox</a>! Not seeing a widget? (<a href="http://support.widgetbox.com/">More info</a>)</noscript>
    </td></table> -->
    <!--
    <br><br>
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
    </form>  </center> -->
    
  </div>
  <!--<div id="footer"> Copyright &copy; 2012 by INS Division, Panorama Tours Indonesia - Best Viewed in Mozilla Firefox (9.0.1) or Greater</div> -->   
</div>
</body>
</html>
<?php /*} else { <a href="//affiliates.mozilla.org/link/banner/26828"><img src="//affiliates.mozilla.org/media/uploads/banners/910443de740d4343fa874c37fc536bd89998c937.png" alt="Download: Fast, Fun, Awesome" /></a>
    */header("location: http://tour.panoramawebsys.com");
    exit;
//}  
?>