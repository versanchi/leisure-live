<html>
<head>
<title>Report GRV</title>
<link href="../config/print.css" rel="stylesheet" type="text/css" />      
</head>
<?php 
include "../config/koneksi.php";
include "../config/fungsi_an.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
   

?>
<body>

<?php  switch($_GET[act]){                 //  <img src='images/pano1.jpg'>
  default:
    $hariini = date("Y-m-d ");
    $nama=$_GET['nama'];
    $nama2=$_GET['nama2'];
    $opnama=$_GET['opnama'];
    $opnama2=$_GET['opnama2'];
    echo "<h2>Report GRV</h2>";
          $oke=$_GET['oke'];
 
          // Langkah 1
          $batas = 10;
          $halaman= $_GET['halaman'];
          if(empty($halaman)){
              $posisi  = 0;
            $halaman = 1;
          } else {
              $posisi = ($halaman-1) * $batas; }
            
            // Langkah 2                                 
            if($opnama=='' and $opnama2<>''){
                    $tampil=mysql_query("SELECT * FROM tour_msgrv                                               
                                WHERE $opnama2 LIKE '%$nama2%' 
                                AND grvDateOfDep >= '$hariini'               
                                ORDER BY GrvDateOfDep ASC ");}
            else if($opnama2=='' and $opnama<>''){
                    $tampil=mysql_query("SELECT * FROM tour_msgrv                                                
                                WHERE $opnama LIKE '%$nama%'
                                AND grvDateOfDep >= '$hariini'                
                                ORDER BY GrvDateOfDep ASC ");}
            else if($opnama2<>'' and $opnama<>''){
                    $tampil=mysql_query("SELECT * FROM tour_msgrv                                                
                                WHERE $opnama LIKE '%$nama%'
                                AND $opnama2 LIKE '%$nama2%' 
                                AND grvDateOfDep >= '$hariini'               
                                ORDER BY GrvDateOfDep ASC ");}
            else if($optnama=='' and $optnama2==''){
                    $tampil=mysql_query("SELECT * FROM tour_msgrv where grvDateOfDep >= '$hariini'                                                
                                ORDER BY GrvDateOfDep ASC ");}
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "<table>
                  <tr><th>no</th><th>Airlines</th><th>Area</th><th>Date Of Dep</th>
                  <th>Seat</th><th>PNR</th><th>Product</th><th>booking pax</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
                    $GDOD = date('d M Y', strtotime($data[GrvDateOfDep]));
                    $GDD = date('d M Y', strtotime($data[GrvDeadlineDeposit])); 
                    $cprod=mysql_query("SELECT * FROM tour_msproductpnr                                               
                                WHERE GrvID = '$data[IDGrv]'              
                                ORDER BY PnrID ASC ");
                    $jprod=mysql_num_rows($cprod);
                    $grandpax=0;
                    while ($dprod=mysql_fetch_array($cprod)){
                        $itung=mysql_query("SELECT sum(AdultPax+ChildPax) as subpax FROM tour_msbooking                                               
                                WHERE IDTourcode = '$dprod[PnrProd]'
                                AND Status <> 'VOID'
                                AND BookingStatus = 'DEPOSIT'              
                                ORDER BY IDBookers ASC ");
                        $itungan=mysql_fetch_array($itung);
                        $grandpax=$grandpax+$itungan[subpax];    
                    }
                    if($data[GrvStatus]=='VOID'){$grvstatus="<font color=red><b>VOID</b></font>";}
                    else if($data[GrvStatus]=='NONE'){$grvstatus="<i>- NONE -</i>";}
                    else {$grvstatus="$data[GrvStatus]";}      
               echo "<tr><td>$no</td>
                     <td><center>$data[GrvAirlines]</td>
                     <td><center>$data[GrvArea]</td>
                     <td><center>$GDOD</td>                   
                     <td><center>$data[GrvSeat]</td> 
                     <td><center>$data[GrvPnr]</td>
                     <td><center>$jprod</td>
                     <td><center>$grandpax</td>
                     ";
                    
                    $edit1=mysql_query("SELECT * FROM tour_msgrv WHERE IDGrv ='$data[IDGrv]' and GrvStatus <>'VOID'");  
                    $r2=mysql_num_rows($edit1);             
               echo" </tr>";
                      $no++;
                    } 
                    echo"        
                    </table>";
            }
                   
     break;
    
}
?> <?php 
      
?>
</body>
</html>   