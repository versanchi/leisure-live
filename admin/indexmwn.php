<?php 

if (isset($_COOKIE['mycookie']) && ($_COOKIE['mypass']== "LBD")) {
    header("location: indexadmin.php");
    exit;                                                                                               
} else {
    header("location: http://tour.panorama-tours.com/security.php");
    exit;
}  
?>