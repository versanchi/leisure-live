<?php
session_start();
error_reporting(0);
include "timeout.php";

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==0){
  header('location:logout.php');
}
else{
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
		<center>Untuk mengakses modul, Anda harus login <br><a href=index.php><b>LOGIN</b></a></center>";
}
else{
?>
<html>
<head>
<title>Welcome To FIT Business Development | Panorama Tours</title>
  <link href="http://www.panorama-tours.com/tpl/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <script src="../tinymcpuk/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
  <script src="../tinymcpuk/jscripts/tiny_mce/tiny_lokomedia.js" type="text/javascript"></script>
  <script src="config/accounting.js"></script>
  <SCRIPT language=Javascript>
     
	  function toggleMe(val){
		var organization = document.getElementById('reason');
		if(val=='0'){
		  reason.style.display = "block";
		}
		else{
		  reason.style.display = "none";
		}
	  }
	function toggleApv(val){
		var apv = document.getElementById('userApprove');
		if(val=='0'){
			userApprove.style.display = "block";
		}
		else{
			userApprove.style.display = "none";
		}
	}
	
	function PopupCenter(pageURL, ID,w,h){
	  var left = (screen.width/2)-(w/2);
	  var top = (screen.height/2)-(h/2);
	  var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    }
   </SCRIPT>
	<style>
        .black_overlay{
            display: none;
            position: absolute;
            top: 0%;
            left: 0%;
            width: 100%;
            height: 100%;
            background-color: black;
            z-index:1001;
            -moz-opacity: 0.8;
            opacity:.80;
            filter: alpha(opacity=80);
        }
        .white_content {
            display: none;
            position: absolute;
            top: 0%;
            left: 25%;
            width: 50%;
            height: 50%;
            padding: 16px;
            border: 4px solid orange;
            background-color: white;
            z-index:1002;
            overflow: auto;
        }
    </style>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="css/button.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="css/droppy.css" type="text/css" />
<!--TES--><script type="text/javascript" src="home/js/jquery-1.11.0.min.js"></script> 
<!--<script type='text/javascript' src='js/jquery-1.2.3.min.js'></script>-->
<script type='text/javascript' src='js/jquery.droppy.js'></script>
<script type='text/javascript'>
  $(function() {
    $('#nav').droppy();
  });
  $(function() {
    $('#navright').droppy();
  });
</script>
</head>
<body>
<div id='fade' class='black_overlay'></div>
<div id="header">
<div id="menu">
		<div class="left">
		 <ul id="nav">
            <li><a href="?module=home">Home</a></li>
            <li><a href="#">Product</a>
              <ul>
                <li><a href="?module=product">Package</a></li>
                <li><a href='?module=TCProduct'>TC Product</a></li>
                <li><a href="?module=transport">Transport</a></li>
              </ul>
            </li>
            <li><a href="#">Booking</a>
              <ul>
              	<li><a href="?module=stcbooking">Auxiliary</a>
                <!--<li><a href="?module=admbooking">Admission Ticket</a>-->
              </ul>
            </li>
            <li><a href='#'>PHV</a>
                <ul>
                    <li><a href='?module=phvoperation'>Operation</a></li>
                    <li><a href='?module=phvsale'>Sales</a></li>
                    <li><a href='?module=phvclaim'>Claim</a></li>
                </ul>
            </li>
            <li><a href='?module=TCProgram'>Program</a></li> 
            <li><a href="#">Report</a>
            	<ul>
                	<li><a href="?module=dailyreport">Transaction</a></li>
                    <li><a href="?module=rptproduct">Product</a></li>
                    <li><a href="?module=rptbso">BSO</a></li>
                    <li><a href="?module=rptoperation">Operation</a></li>
                    <li><a href="?module=rptsupplier">Supplier</a></li>
                    <li><a href="?module=rptprocesstime">Process Time</a></li>
                    <!--<li><a href="#">» Admission</a>
                    	<ul>
                            <li><a href="?module=rptadmsales">Sales BSO</a></li>
                            <li><a href="?module=rptticketstock">Ticket Stock</a></li>
                            <li><a href="?module=rptadmission">Admission Report</a></li>
                        </ul>
                    </li>
                    -->
                </ul>
            </li>
            <li><a href="#">Search</a>
            	<ul>
                	<li><a href="?module=searchbooking">Booking</a></li>
                    <li><a href="?module=searchvoucher">Voucher</a></li>
                    <li><a href='?module=phvsearch'>PHV Data</a></li>
                    <!--<li><a href="?module=searchadmission">Search Admission</a></li>-->
                </ul>
            </li>
            <li><a href="?module=searchfaq">FAQ</a></li>
        </ul>
		</div>
		<div class="right">
		 <ul id="navright">
		 	<li><a href='#'>Setup</a>
            <ul>
            	<li><a href='#'>» FAQ</a>
                  <ul>
                    <li><a href='?module=msfaq'>FAQ Group</a></li>
                    <li><a href='?module=faq'>FAQ</a></li>
                  </ul>
                </li>
                <li><a href='#'>» PHV</a>
                    <ul>
                        <li><a href='?module=phvcorp'>Customization</a></li>
                        <li><a href='?module=phvstock'>Stocks</a></li>
                    </ul>
                </li>
                <li><a href='#'>» Product</a>
                    <ul>
                       <li><a href="?module=mscar">Transportation</a></li>
                       <li><a href="?module=prodcat">Category</a></li>
                       <li><a href="?module=prodtemplate">Template</a></li>
                    </ul>
                </li>
                <li><a href='#'>» Program</a>
                    <ul>
                       <li><a href='?module=programcat'>Category</a></li>
                       <li><a href='?module=program'>Program</a></li>
                       <li><a href='?module=pushselling'>Push Selling</a></li>
                    </ul>
                </li>
                <li><a href="?module=msreason">Reason</a></li>
                <!--
                <li><a href="#">» Admission</a>
                	<ul>
                    	<li><a href="?module=dtadmission">Admission List</a></li>
                        <li><a href="?module=admissionticket">Ticket Stock</a></li>
                    </ul>
                </li>
                -->
			</ul>
            </li>
         	<li><a href='#'><?php echo "$_SESSION[namalengkap] ($_SESSION[leveluser])"; ?></a>
              <ul> 
               	 <li><a href='logout.php'>Logout</a></li>
              </ul>
         	</li>
         </ul>
		</div>
	</div> 
</div>
  
<div id="wrap">
  <div id="content">
	 <?php include "content.php"; ?>
  </div>
</div>
<br><br>
<div id="footer">Copyright &copy; 2014 - 2015 by INS Division, Panorama Tours Indonesia</div>

</body>
</html>
<?php
	}
}
?>
 