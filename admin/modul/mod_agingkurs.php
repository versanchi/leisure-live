<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>         
<script type="text/javascript" src="../head/editable-select.js"></script> 
<script language="JavaScript"  type="text/javascript">   
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

//-->
</SCRIPT>
<?php
include "../config/koneksimaster.php";
switch($_GET[act]){
  // Tampil Office
  default:
      $hariini = date("Y-m-d ");
      $head=$_GET['head'];

    echo "<h2>ESTIMATE KURS</h2>
    <center>
          <form method='get' action='media.php?'>
                <input type=hidden name=module value='agingkurs'>
            Period : <select name='head'>
            <option value='0' selected>- Select Period -</option>";
      $cariperiod=mssql_query("SELECT * FROM AgingKurs where StartDate >= '$hariini' and void = 0 order by StartDate ASC");
      while($period=mssql_fetch_array($cariperiod)){
          $startdate = date("d M Y", strtotime($period[StartDate]));
          $enddate = date("d M Y", strtotime($period[EndDate]));
              if($head==$period[IDHeader]){
                  echo "<option value='$period[IDHeader]' selected>$startdate - $enddate</option>";
              }else{
                  echo "<option value='$period[IDHeader]'>$startdate - $enddate</option>";
              }
      }
      echo "</select>
              <input type=submit name='oke' size='20'value='View'>
          </form>";
          $oke=$_GET['oke'];

              $tampil=mssql_query("SELECT * FROM AgingKursDetails
                                        where IDHeader = '$head'");

            $jumlah=mssql_num_rows($tampil);
			 
            if ($jumlah > 0 and $head<>'') {
            echo "  <table>   
                    <tr><th>no</th><th>Currency</th><th>Rate</th></tr>";
				  $no=$posisi+1;
                    while ($data=mssql_fetch_array($tampil)){
                     echo "<tr><td $warna>$no</td>
                     <td $warna>$data[Currency]</td>
                     <td $warna style='text-align:right'>".number_format($data[ExRate], 0, '', ',');echo"</td>
                     </tr>";
                      $no++;
                    }
                    echo "</table>";

            } else {
                echo "<div id='paging'>";
                echo "<br><br>Data Not Found<p>";
                echo "</div>";
            }     

    break;
  
}
?>
