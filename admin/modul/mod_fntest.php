<?php
switch($_GET['act']){
  default:
    include "home/index.php";
  break;

  case "detail":
  	include "home/detail.php";
  break;
}
?>