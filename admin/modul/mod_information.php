<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>

<?php
session_start();              
switch($_GET[act]){
  // Tampil User
  default:                                           
    echo "<h2>News Update</h2>     
          <center><table>
          <tr><th style='background-color:#f48221;'>no</th><th width='1000' style='background-color:#f48221;'> LTM news</th><th style='background-color:#f48221;'>action</th></tr>";
    $tampil=mysql_query("SELECT * FROM tour_information where InformationID < '6' ORDER BY InformationID ASC ");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[InformationDesc]</td>
             <td><center><a href=?module=information&act=editinformation&id=$r[InformationID]>Edit</a> 
             </td></tr>";
      $no++;
    }
    echo "</table>
    <table>
          <tr><th style='background-color:green;'>no</th><th width='1000' style='background-color:green;'> TUR EZ news</th><th style='background-color:green;'>action</th></tr>";
    $tampil=mysql_query("SELECT * FROM tour_information where InformationID > '5' ORDER BY InformationID ASC ");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
        echo "<tr><td>$no</td>
             <td>$r[InformationDesc]</td>
             <td><center><a href=?module=information&act=editinformation&id=$r[InformationID]>Edit</a>
             </td></tr>";
        $no++;
    }
    echo "</table>";
    break;
              
  case "editinformation":
    $edit=mysql_query("SELECT * FROM tour_information WHERE InformationID ='$_GET[id]'");
    $r=mysql_fetch_array($edit); 
    //<tr><td>Agents</td><td> <textarea name='agent' cols=56 rows=3>$r[Agent]</textarea></td></tr> 
    echo "<h2>Edit News</h2>
          <form name='example' method=POST action=./aksi.php?module=information&act=update>
          <input type=hidden name=id value='$r[InformationID]'>
          <table>    
          <tr><td>News</td> <td>  <textarea rows='3' cols='120' name='informationdesc'>$r[InformationDesc]</textarea></td></tr>
          <tr><td colspan=2><center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
    break;       
}

?>
