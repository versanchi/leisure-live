<html>
<head>
<title>Untitled Document</title>                                                 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0                                                                                   
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;                                                  
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>
   <?php $web= $_SERVER['HTTP_HOST'];
   if(strpos($web, 'tour.panoramawebsys') !== false){ ?>
       <body onLoad="MM_goToURL('parent','admin/index.php');return document.MM_returnValue">
   <?php }else{
       header("location: http://panoramawebsys.web.id/404.php");
   }  ?>
<!--<body onLoad="MM_goToURL('parent','admin/index.php');return document.MM_returnValue">-->

</body>
</html>
