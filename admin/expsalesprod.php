<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" />
<?php  
include "../config/koneksi.php"; 
$hariini = date("Y-m-d G:i:s ");
      $nama=$_GET['nama'];
      $nama2=$_GET['nama2'];
      $opnama=$_GET['opnama'];
      $opnama2=$_GET['opnama2'];
    
    if($opnama=='' and $opnama2<>''){$tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama2 LIKE '%$nama2%'
                                and Status = 'PUBLISH'
                                and DateTravelFrom >= '$hariini' 
                                ORDER BY tour_msproduct.Year ASC,tour_msproduct.Season ASC,tour_msproduct.ProductType ASC,tour_msproduct.Destination ASC,tour_msproduct.ProductCode ASC,DateTravelFrom ASC ");}
          else if($opnama2=='' and $opnama<>''){$tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama LIKE '%$nama%' 
                                and Status = 'PUBLISH'
                                and DateTravelFrom >= '$hariini'   
                                ORDER BY tour_msproduct.Year ASC,tour_msproduct.Season ASC,tour_msproduct.ProductType ASC,tour_msproduct.Destination ASC,tour_msproduct.ProductCode ASC,DateTravelFrom ASC");}
          else if($opnama2<>'' and $opnama<>''){$tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama LIKE '%$nama%'
                                AND $opnama2 LIKE '%$nama2%'
                                and Status = 'PUBLISH' 
                                and DateTravelFrom >= '$hariini'    
                                ORDER BY tour_msproduct.Year ASC,tour_msproduct.Season ASC,tour_msproduct.ProductType ASC,tour_msproduct.Destination ASC,tour_msproduct.ProductCode ASC,DateTravelFrom ASC");}
          else if($optnama=='' and $optnama2==''){
          $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE Status = 'PUBLISH' 
                                and DateTravelFrom >= '$hariini'   
                                ORDER BY tour_msproduct.Year ASC,tour_msproduct.Season ASC,tour_msproduct.ProductType ASC,tour_msproduct.Destination ASC,tour_msproduct.ProductCode ASC,DateTravelFrom ASC ");}
          
            $jumlah=mysql_num_rows($tampil);
            if ($jumlah > 0) {
            
            echo "<center>view date: $hariini   <table>   
                    <tr><th>no</th><th>product</th><th>tour code</th><th>dest</th><th>product type</th><th>Season</th><th>days</th><th>departure</th><th>flight</th><th>disc</th><th>seat</th><th>deposit</th><th>available</th><th>inquiry</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
                    $mari=mysql_query("SELECT count(IDBookers)as wow FROM tour_msbooking where TourCode = '$data[TourCode]' and Status = 'VOID' ");
                    $tung=mysql_fetch_array($mari);
                    $maritot=mysql_query("SELECT count(tour_msbookingdetail.IDDetail)as tot FROM tour_msbookingdetail 
                                        left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                        where tour_msbookingdetail.TourCode = '$data[TourCode]' and tour_msbookingdetail.Gender <>'INFANT'
                                        AND tour_msbookingdetail.Status<>'CANCEL' 
                                        AND tour_msbooking.Status='ACTIVE' ");
                    $tungtot=mysql_fetch_array($maritot);
                    $totl=$tungtot[tot]+1;
                    $d = mysql_query("SELECT * FROM tour_msdiscount 
                                    left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct      
                                    WHERE tour_msproduct.TourCode = '$data[TourCode]' and tour_msproduct.Status <> 'VOID' and tour_msdiscount.Status='ACTIVE'");
                    $dd = mysql_fetch_array($d);
                    $julh=mysql_num_rows($d);
                    if($julh>0){
                    if($totl<=$dd[Max1]){$diskon=$dd[Disc1];}
                    else if($totl<=$dd[Max2]){$diskon=$dd[Disc2];}
                    else if($totl<=$dd[Max3]){$diskon=$dd[Disc3];}
                    else if($totl<=$dd[Max4]){$diskon=$dd[Disc4];}
                    else if($totl<=$dd[Max5]){$diskon=$dd[Disc5];}
                    else if($totl<=$dd[Max6]){$diskon=$dd[Disc6];}
                    else if($totl<=$dd[Max7]){$diskon=$dd[Disc7];}
                    else $diskon='0'; 
                    if($diskon==''){$diskon='0';}                                                         
                    }else{$diskon='0';}                          
                    if($data[StatusProduct]=='CLOSE'){$status="<font color=red><b>CLOSE</b></font>";$tom='disabled';$warna="BGCOLOR='#f5bebe'";}
                    else if($data[StatusProduct]=='OPEN'){$status="<font color=green><b>OPEN</b></font>";$tom='enabled';$warna="BGCOLOR='#ffffff'";}
               echo "<tr><td $warna>$no</td>
                     <td $warna>$data[ProductCode] - $data[Productcode]</td>                                   
                     <td $warna>$data[TourCode]</td>   
                     <td $warna>$data[Destination]</td>
                     <td $warna>$data[ProductType]</td>
                     <td $warna>$data[Season] $data[Year]</td>
                     <td $warna><center>$data[DaysTravel]</td>
                     <td $warna>$data[DateTravelFrom]</td>
                     <td $warna><center>$data[Flight]</td>
                     <td $warna><center>$diskon</td>
                     <td $warna><center>$data[Seat]</td>
                     <td $warna><center>$data[SeatDeposit]</td>
                     <td $warna><center>$data[SeatSisa]</td>
                     <td $warna><center>$data[SeatInquiry]</td></tr>";
                      $no++;
                    }
                    echo "</table>";
            }       
?> 