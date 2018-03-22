<?php 
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if ($_SESSION['employee_code']=='') {
    echo "<link href='../config/adminstyle.css' rel='stylesheet' type='text/css'>
 <center>For access this web, You must login first <br>";
    echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else {
    ?>
    <html>
    <head>
        <META NAME="Title" CONTENT="LTM operation">
        <META NAME="Author" CONTENT="Ferry Budiono">
        <META NAME="Copyright" CONTENT="&copy;2012 - Ferry Budiono">
        <META NAME="Designer" CONTENT="versanchi">
        <META NAME="Publisher" CONTENT="Panorama JTB Tours Indonesia">
        <title>Leisure Booking Site</title>
        <SCRIPT LANGUAGE="JavaScript" SRC="../config/CalendarPopup.js"></SCRIPT>
        <SCRIPT LANGUAGE="JavaScript">
            var cal = new CalendarPopup();
            cal.showYearNavigation();
            cal.showYearNavigationInput();
        </SCRIPT>
        <SCRIPT LANGUAGE="JavaScript" SRC="../config/fungsi_an.js"></SCRIPT>
        <script src="../config/accounting.js"></script>
        <SCRIPT LANGUAGE="JavaScript" SRC="../config/picker.js"></SCRIPT>
        <script type="text/javascript" src="../config/jquery.js"></script>
        <!--<script type="text/javascript" src="./modul/jquery-1.2.6.min.js"></script>-->

        <script type="text/javascript" src="../head/jquery-1.3.2.min.js"></script>

        <script type="text/javascript" src="../config/jquery.autocomplete.js"></script>
        <link href="../config/adminstyle.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="../config/date_time.js"></script>

        <script src="client/lib/jquery-1.8.2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="client/themes/default/jquery.phpfreechat.min.css" />
        <script src="client/jquery.phpfreechat.min.js" type="text/javascript"></script>
        <?php
        include "../config/fungsijs.php";
        include "../config/koneksi.php";
        include "../config/koneksimaster.php";
        ?>
        <?php
        function getBrowser()
        {
            $u_agent = $_SERVER['HTTP_USER_AGENT'];
            $bname = 'Unknown';
            $platform = 'Unknown';
            $version = "";

            //First get the platform?
            if (preg_match('/linux/i', $u_agent)) {
                $platform = 'linux';
            } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                $platform = 'mac';
            } elseif (preg_match('/windows|win32/i', $u_agent)) {
                $platform = 'windows';
            }

            // Next get the name of the useragent yes seperately and for good reason
            if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
                $bname = 'Internet Explorer';
                $ub = "MSIE";
            } elseif (preg_match('/Firefox/i', $u_agent)) {
                $bname = 'Mozilla Firefox';
                $ub = "Firefox";
            } elseif (preg_match('/Chrome/i', $u_agent)) {
                $bname = 'Google Chrome';
                $ub = "Chrome";
            } elseif (preg_match('/Safari/i', $u_agent)) {
                $bname = 'Apple Safari';
                $ub = "Safari";
            } elseif (preg_match('/Opera/i', $u_agent)) {
                $bname = 'Opera';
                $ub = "Opera";
            } elseif (preg_match('/Netscape/i', $u_agent)) {
                $bname = 'Netscape';
                $ub = "Netscape";
            }

            // finally get the correct version number
            $known = array('Version', $ub, 'other');
            $pattern = '#(?<browser>' . join('|', $known) .
                ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
            if (!preg_match_all($pattern, $u_agent, $matches)) {
                // we have no matching number just continue
            }

            // see how many we have
            $i = count($matches['browser']);
            if ($i != 1) {
                //we will have two since we are not using 'other' argument yet
                //see if version is before or after the name
                if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                    $version = $matches['version'][0];
                } else {
                    $version = $matches['version'][1];
                }
            } else {
                $version = $matches['version'][0];
            }

            // check if we have a number
            if ($version == null || $version == "") {
                $version = "?";
            }

            return array(
                'userAgent' => $u_agent,
                'name' => $bname,
                'version' => $version,
                'platform' => $platform,
                'pattern' => $pattern
            );
        }
        $ua = getBrowser();
        //$yourbrowser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];
        $yourbrowser = "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " . $ua['platform'];
        function using_ie()
        {
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $ub = false;
            if (preg_match('/Firefox/i', $user_agent)) {
                $ub = true;
            }
            return $ub;
        }

        if (using_ie() == true) {
            if ($ua['version'] < 20) {
                ?>
                <script language="JavaScript" type="text/javascript">
                    alert("PLEASE UPDATE YOUR MOZILLA FIREFOX OR CONTACT ICT TEAM");
                </script><?PHP
            }
        } else {
            ?>
            <script language="JavaScript" type="text/javascript">
                alert("PLEASE USE MOZILLA FIREFOX FOR BEST PERFORMANCE");
            </script><?PHP
        }
        ?>

    </head>
    <script language=JavaScript>
        <!--
        //Disable right mouse click Script
        var message = "Function Disabled!";
        ///////////////////////////////////
        function clickIE4() {
            if (event.button == 2) {
                alert(message);
                return false;
            }
        }
        function clickNS4(e) {
            if (document.layers || document.getElementById && !document.all) {
                if (e.which == 2 || e.which == 3) {
                    alert(message);
                    window.location.reload();
                    return false;
                }
            }
        }
        if (document.layers) {
            document.captureEvents(Event.MOUSEDOWN);
            document.onmousedown = clickNS4;
        }
        else if (document.all && !document.getElementById) {
            document.onmousedown = clickIE4;
        }
        //document.oncontextmenu=new Function("return false")
        function disableCtrlKeyCombination(e) {
            //list all CTRL + key combinations you want to disable
            var forbiddenKeys = new Array('a', 'c', 'x', 'v');
            var key;
            var isCtrl;
            if (window.event) {
                key = window.event.keyCode;     //IE
                if (window.event.ctrlKey)
                    isCtrl = true;
                else
                    isCtrl = false;
            }
            else {
                key = e.which;     //firefox
                if (e.ctrlKey)
                    isCtrl = true;
                else
                    isCtrl = false;
            }
            //if ctrl is pressed check if other key is in forbidenKeys array
            if (isCtrl) {
                for (i = 0; i < forbiddenKeys.length; i++) {
                    //case-insensitive comparation
                    if (forbiddenKeys[i].toLowerCase() == String.fromCharCode(key).toLowerCase()) {
                        alert('Key combination CTRL + ' + String.fromCharCode(key) + ' has been disabled.');
                        window.location.reload();
                        return false;
                    }
                }
            }
            return true;
        }
        // -->
    </script>
    <!--<body onkeypress="return disableCtrlKeyCombination(event);" onkeydown = "return disableCtrlKeyCombination(event);" >-->
    <body>
    <script language='JavaScript1.2'>mmLoadMenus();</script>

    <div id="header">
        <div>
            <?php include "menu.php"; ?>
        </div>
        <div id="content">
            <?php include "content.php"; ?>
        </div>
        <div id="footer"> Copyright &copy; 2012 by ISD Division, Panorama JTB Tours Indonesia - Best Viewed in Mozilla
            Firefox (20.0) or Greater<br>
            <?php echo "$yourbrowser" ?>
        </div>
    </div>
    </body>
    </html>
    <?php
}
?>
