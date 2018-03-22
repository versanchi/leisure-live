<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Copyright 2010 mallinidesign.com -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
        
        <!-- Type your description -->
        <meta name="description" content="" />
        <meta name="keywords" content="" />

        <!-- Type your title here -->
        <title>Under Construction</title>
        
        <!-- Load styles -->
        <link rel="stylesheet" type="text/css" href="./css/style.css" />
        <!--[if lte IE 8]>
        <link rel="stylesheet" type="text/css" href="http://mallinidesign.com/templates/under_construction/css/style.ie.css" />
        <![endif]-->
        
        <!-- Load scripts -->
        <script type="text/javascript" src="./scripts/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="./scripts/bar.js"></script>
        <script type="text/javascript" src="./scripts/countdown.js"></script>
        <script type="text/javascript" src="./scripts/twitter.js"></script>
        <script type="text/javascript" src="./scripts/jquery.toggleval.js"></script>
        <script type="text/javascript" src="./scripts/jquery.form.js"></script>
        <script type="text/javascript" src="./scripts/jquery.textshadow.js"></script>
        <script type="text/javascript" src="./scripts/custom.js"></script>
        <script type="text/javascript">
        // <![CDATA[
            jQuery(document).ready(function(){
             jQuery("h1, h2, .progress").textShadow();
            })
         // ]]>
        </script>
        <script type="text/javascript">
        
    
    $(document).ready(function(){
        $('a#btn').hover(
            function() {
                $('#but').attr('src', 'images/blue1_act.png');
            },
            function() {
                $('#but').attr('src', 'images/blue1.png');
            }
        );    
    });
    
        $(document).ready(function(){
        $('a#btn2').hover(
            function() {
                $('#but2').attr('src', 'images/green1_act.png');
            },
            function() {
                $('#but2').attr('src', 'images/green1.png');
            }
        );    
    });
    
        $(document).ready(function(){
        $('a#btn3').hover(
            function() {
                $('#but3').attr('src', 'images/brown1_act.png');
            },
            function() {
                $('#but3').attr('src', 'images/brown1.png');
            }
        );    
    });
    
        $(document).ready(function(){
        $('a#btn4').hover(
            function() {
                $('#but4').attr('src', 'images/magenta1_act.png');
            },
            function() {
                $('#but4').attr('src', 'images/magenta1.png');
            }
        );    
    });
    
// Image preloader

        jQuery.preloadImages = function()
    {
      for(var i = 0; i<arguments.length; i++)
      {
        jQuery("<img>").attr("src", arguments[i]);
      }
    }
    $.preloadImages("../images/sub_input.png", "images/sub_button.png", "images/notify_but_2.png", "images/magenta1_act.png", "images/blue1_act.png", "images/green1_act.png", "images/brown1_act.png"); // The list of images to preload
    
    </script>

    <meta charset="UTF-8"></head>
    <body>
    <!--
    <div id="colors">
    <a href="./blue/index.html" id="btn"><img src="./images/blue1.png" width="112" height="38" alt="Blue style" id="but" /></a>
    <a href="./green/index.html" id="btn2"><img src="./images/green1.png" width="112" height="30" alt="Blue style" id="but2" /></a>
    <a href="./brown/index.html" id="btn3"><img src="./images/brown1.png" width="112" height="31" alt="Blue style" id="but3" /></a>
    <a href="./magenta/index.html" id="btn4"><img src="./images/magenta1.png" width="112" height="35" alt="Blue style" id="but4" /></a>  
    </div>-->
    
<div class="layer">        
        <div id="main">
        
            <!--[if lte IE 6]>
                <h1>You use Internet Explorer 6 or older, please update your browser!</h1>
            <![endif]-->
            
            <!-- Name of your company or logo -->
            <div class="company_name"><a href="./index.html" title="UNDER CONSTRUCTION"><img src="./images/panorama_logo.gif" width="375" height="86" alt="UNDER CONSTRUCTION" /></a></div>
            <!-- END /Name of your company -->
             <br><br>
            <!--[if lte IE 8]>
                <div class="light_top"></div>
            <![endif]-->

            <div class="main_box">
            
                <!-- Text message on the top of page -->
                <h1>THIS WEBSITE WAS TAKEN OVER</h1>
                <!-- END /Text message on the top of page -->
                
                <div class="blackbox">
                    <div class="in">
            
                        <!-- Countdown -->
                        <div class="count" id="countdown"></div>
                        <!-- END /Countdown -->
                
                        <!-- Progress bar and percents setup -->
                        <div id="bar">
                            <div class="progress"><span class="progressBar" id="pb1">65%</span></div>
                            
                            <!-- Text under progress bar -->
                            <p>You know, we are currently under construction. Check out our progress. Please patient when we launch new update website.</p>
                            <p>TAKE OVER BY FERRY</p>
                            <!-- END /Text under progress bar -->
                            
                        </div>
                        <!-- END /Progress bar -->
                        
                        <!-- Notify me button and subscribe form -->
                        <!--<div class="notify_but">
                            <a href="#" id="note"><img src="./images/notify_but_1.png" width="146" height="40" alt="notify" id="img" /></a>
                         -->
                            <!-- Subscribe block -->
                            <div id="sendform">
                                <form action="FormToEmail.php" method="post" name="form_newsletter" id="form_newsletter">
                                <input name="email" id="email" type="text" value="Enter your email address..." maxlength="85" class="required email" />
                                <input name="submit" type="submit" id="submit" value="" class="submit" />
                                <input type="hidden" name="ajax" id="ajax" value="0" />                                                                
                                </form>
                                <script type="text/javascript">
                                  $("input[name='email']").toggleVal();
                                </script>
                                <div id="feedback">
                                      <p class="error wrong_email">Incorrect email</p>
                                </div>
                                <p id="success">Your email was sent succesfully!</p>
                            </div>
                            <!-- END /Subscribe block -->
                
                        </div>
                        <!-- END /Notify me button and subscribe form -->
                                       
                    </div>
                </div>

                <!-- Twitter message from your account 
                <div id="twitter"></div>
                <!-- END /Twitter message from your account -->
            
            </div>

            <!-- Social icons 
            <div class="social">
                <a href="#" title="Facebook"><img src="./images/facebook_but.png" width="32" height="32" alt="Facebook" /></a>
                <a href="#" title="Twitter"><img src="./images/twitter_but.png" width="32" height="32" alt="Twitter" /></a>
                <a href="#" title="LinkedIn"><img src="./images/link_but.png" width="32" height="32" alt="LinkedIn" /></a>
                <a href="#" title="Flickr"><img src="./images/flickr_but.png" width="32" height="32" alt="Flickr" /></a>
            </div>
            <!-- END /Social icons -->

        </div>
    </div>
    <script type="text/javascript" src="./scripts/init_form.js"></script>
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-3102126-11']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

    </script>
    </body>
</html>