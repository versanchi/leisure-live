<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>

<style>
body{
    font-family: verdana;
    text-align: center;         
    background-image: url(../images/chockwood.jpg);  
    color: #fff; 
    font-weight: bold; 
}

h2 {
    font: normal 200% Algerian;
    background-color: transparent;         
    border-width:5px;    
    border-bottom-style:double;
    text-align: center;
}
table {
    font-family: verdana;     
    font-size: 10pt;
    border-width: 0px;
    border-style: solid;
    border-color: #999999;
    border-collapse: collapse;
    margin: 10px 0px;
    font-weight: bold;
}
th{
    font-size: 7pt;
    text-transform: uppercase;
    text-align: center;
    padding: 0.5em;
    border-width: 0px;
    border-style: none;
    border-color: #000000;
    border-collapse: collapse;   
    background-color: #ffffff;  
}
td{
    padding: 0.5em;
    vertical-align: top;
    border-width: 0px;
    border-style: solid;
    border-color: #f48221;
    border-collapse: collapse;
    font-weight: bold;
}
tr{                      
    border-width: none;   
}                                  
P.repeatimage {
background: transparent url(../images/rope.png) repeat-x;     
}

</style>
<?php
include "../config/koneksi.php";           
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));             
switch($_GET[act]){
  // Tampil User
  default:                                           
    echo "<h2><img src='../images/bannernewspop.png'></h2>     
          <center><table style='border:0'>
          "; 
    $tampil=mysql_query("SELECT * FROM tour_information ORDER BY InformationID ASC ");
    
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
        if($no=='6' OR $no=='7'){$cl1="<font color='lime'>";$cl2="</font>";}else{{$cl1="<font color='white'>";$cl2="</font>";}}
       echo "<tr>
             <td>$cl1 $r[InformationDesc] $cl2</td>
             </tr>";
             if($no<7){echo"
             <tr>
             <td><p CLASS='repeatimage'><img src='../images/rope.png'></p></td>                                                              
             </tr>";
             }echo"
             ";
      $no++;
    }
    echo "</table>";
    break;
              
  
}

?>
