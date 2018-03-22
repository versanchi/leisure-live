<script language="javascript" type="text/javascript">
    function tutuppage()
    {
        window.close();                  
    }
</script> 
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" /> 
<?php 
include "../config/koneksi.php"; 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));  
switch($_GET[act]){
  // Tampil Office
  default:
    $edit=mysql_query("SELECT * FROM tour_mstmritinreq WHERE TmrID = '$_GET[id]'");
                          
    
    echo "<h2>ITINERARY REQUEST TMR $_GET[id]</h2>                                                                         
          <input type='hidden' name=id value='$_GET[id]'>   
          <center><table>
          <tr><th colspan=2></th><th>service</th><th colspan=3>meals</th><th></th></tr>
          <tr><th>day</th><th>route</th><th>(transfer, tour, meeting, optional)</th><th>b</th><th>l</th><th>d</th><th>remarks</th></tr>";
          while($r=mysql_fetch_array($edit)){echo"
          <tr><td><center>$r[Day]</td>
          
          <td width='150'>$r[Route]</td>
          <td>$r[Service]</td>
          <td><center>";if($r[B]=='BREAKFAST'){echo"<img src='../images/done.png'>";}else{echo"<img src='../images/cancel.gif'>";}echo"</td>
          <td><center>";if($r[L]=='LUNCH'){echo"<img src='../images/done.png'>";}else{echo"<img src='../images/cancel.gif'>";}echo"</td>
          <td><center>";if($r[D]=='DINNER'){echo"<img src='../images/done.png'>";}else{echo"<img src='../images/cancel.gif'>";}echo"</td>
          <td width='200'>$r[Remarks]</td></tr>";    
          }echo"                                    
          </table>     
          <center><input type='submit' name='submit' value='CLOSE' onclick='tutuppage()' > 
          ";
     break;  
  
}
?>
