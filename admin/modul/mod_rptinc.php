
<?php 
switch($_GET[act]){
  // Tampil Visa
  default:
    $datenow = date("d", time());
    $monthnow = date("m", time());
    $yearnow = date("Y", time());
    $today = $yearnow."/".$monthnow."/".$datenow;
    $firstday = $yearnow."/".$monthnow."/01";
    $fdreq = $_GET['date1'];
    $tdreq = $_GET['date2'];
    
    if ($fdreq==0) {
        $fdreq = $firstday;
        $tdreq = $today;
    } 
    $nama=$_GET['nama'];
    
   
    echo "<h2>Incentive Report (Summary) $fdreq - $tdreq</h2>
          <form method=get name='incentive' action='./media.php?module=rptinc'>
                <input type=hidden name=module value='rptinc'>
              From : <input type=text name='date1' value='$fdreq' size=15 onClick="."cal.select(document.forms['incentive'].date1,'anchor1','yyyy/MM/dd'); return false;"." NAME='anchor1' ID='anchor1'> 
              &nbsp;To : <input type=text name='date2' value='$tdreq' size=15 onClick="."cal.select(document.forms['incentive'].date2,'anchor2','yyyy/MM/dd'); return false;"." NAME='anchor2' ID='anchor2'> 
              &nbsp&nbsp&nbsp    
              <input type=submit name=oke value=Show>
          </form>";
   
          $oke=$_GET['oke'];
           $hari = date("Y-m-d", time());
          
            // Langkah 2
            $tampil=mysql_query("SELECT tbl_msemployee.employee_name,sum(msvisa.Incentive)as totincentive,msvisa.ActPIC FROM msvisa                                                
                                left JOIN tbl_msemployee ON tbl_msemployee.employee_id = msvisa.ActPIC
                                WHERE (msvisa.AppDate >= '$fdreq' AND msvisa.AppDate <= '$tdreq')
                                AND msvisa.ActPIC <> '0'  
                                AND msvisa.Status <> '0'
                                AND msvisa.StatCancel = '0' 
                                AND msvisa.WONo <> ''      
                                group BY ActPIC  ");
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "<table>
                    <tr><th>no</th><th>PIC</th><th>Incentive</th><th>detail</th>";  
            echo "</tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){    
               echo "<tr><td>$no</td>
                     <td>$data[employee_name]</td>
                     <td>IDR. ".number_format($data[totincentive], 2, ',', '.');echo" </td>  
                     <td><center><a href=incentive.php?usr=$data[ActPIC]&frd=$fdreq&tod=$tdreq target=_blank><img src='../images/print.gif'></a></td>
                     </tr>";
                      $no++;
                    }
                    echo "</table>";

            } 
     break;
 
}
?>
