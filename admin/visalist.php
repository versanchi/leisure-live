<html>
<head>
<title>VISA LIST</title>
<link href="../config/print.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">           
     setTimeout(window.close, 120000);     
</script>
<script type="text/javascript"> 
function generateexcel(tableid) {
  var table= document.getElementById(tableid);
  var html = table.outerHTML;   
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));    
}  
</script>
<?php 
include "../config/koneksi.php";
include "../config/fungsi_an.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));           
?>
<body>
<?php 	$IDProduct=$_GET[nama];         
        $ambil=mysql_query("SELECT * FROM tour_msproduct                                         
                    WHERE tour_msproduct.IDProduct ='$IDProduct'");
         $isi=mysql_fetch_array($ambil);
         $edit=mysql_query("SELECT tour_msbookingdetail.*,TCName,TCDivision FROM tour_msbookingdetail                                                 
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$IDProduct'
                    AND tour_msbookingdetail.Status <> 'CANCEL'
                    order by BookingID ASC,IDDetail ASC");
         $jumlah=mysql_num_rows($edit);
         $depdet = date("d M Y", strtotime($isi[DateTravelFrom]));
         
         $rum=mysql_query("SELECT sum(AdultPax)as jumlaadult,sum(ChildPax)as jumlachild,sum(InfantPax)as jumlainf FROM tour_msbooking   
                                WHERE IDTourcode = '$IDProduct'
                                And Status = 'ACTIVE'
                                And BookingStatus = 'DEPOSIT'  
                                group by TourCode ASC");        
         $room=mysql_fetch_array($rum);
         $jumteel=mysql_query("SELECT * FROM tour_msproducttl   
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL' 
                                order by IDPTL ASC");        
         $banyakteel=mysql_num_rows($jumteel);
          if($isi[TourLeaderInc]=='YES'){$tl=$banyakteel;;}else{$tl=0;}
         $seluruh=$room[jumlaadult]+$room[jumlachild] + $tl;
          
            if ($jumlah > 0) {
            echo "  <table style='border: 0px solid #000000;'>
                    <tr><td style='border: 0px solid #000000;'><font size=4><u><b>VISA PROGRESS</b></u></font></td></tr>
                    <tr><td style='border: 0px solid #000000;'><img src='images/pano1.jpg'></td></tr>
                    <tr><td style='border: 0px solid #000000;'><font size=3><b>TOUR NAME : $isi[TourCode]</b></font></td></tr>
                    <tr><td style='border: 0px solid #000000;'><font size=3><b>DEPARTURE : $depdet / $isi[Flight]</b></font></td></tr>
                    <tr><td style='border: 0px solid #000000;'><font size=1><b>TOTAL PAX : $room[jumlaadult] ADT + $room[jumlachild] CHD + $tl TL= $seluruh PAXS</b></font></td></tr>
                    </table>
                    <table STYLE='font-size: 12px;' id='passportlist'>
                    <tr><th>NO</th><th>booking id</th><th>TC</th><th>passanger's name</th><th>passport no</th><th colspan=2>place & date of expiry</th>";
					
					for ($i=1;$i<6;$i++)
					{
					$Embassy='Embassy0'.$i;
						if($isi[$Embassy]<>'0')
						{$Qvisa=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[$Embassy]'");        
       					  $Dvisa=mysql_fetch_array($Qvisa);
		 				 echo"<th><center>$Dvisa[CountryGroup]</th>";
						}
					
					}
					
					echo"</tr>"; 
					
                    if($isi[TourLeaderInc]=='YES'){
                       $cariteel=mysql_query("SELECT * FROM tour_msproducttl   
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL' 
                                order by IDPTL ASC");        
                       $hasilteel=mysql_num_rows($cariteel);
                       $no=$hasilteel+1;
                       $notl=1;
                       while($tlnya=mysql_fetch_array($cariteel)){
                       $carisatu=mysql_query("SELECT * FROM tour_mstourleader   
                                where TourleaderStatus = 'ACTIVE'
                                AND TourleaderName = '$isi[TourLeader]' 
                                order by TourleaderName ASC");        
                       $hasilsatu=mysql_num_rows($carisatu);  
                       
                            $datatl=mysql_fetch_array($carisatu);
                            if($datatl[TourleaderPassportValid]=='0000-00-00' OR $datatl[TourleaderPassportValid]==''){$pvalid="";}else{
                            $pvalid = date("d M Y", strtotime($datatl[TourleaderPassportValid]));
                            }       
                            echo "<tr><td>1</td>
                                <td></td>
								<td>TOUR LEADER</td>
                                <td>$datatl[TourleaderName]</td>  
                                <td>$datatl[TourleaderPassportNo]</td>
                                <td>$datatl[TourleaderPassportIssued]</td> 
                                <td>$pvalid</td>";
                                for ($i=1;$i<6;$i++)
                                {
                                $Embassy='Embassy0'.$i;
                                    if($isi[$Embassy]<>'0')
                                    {$Qvisa=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[$Embassy]'");        
                                        $Dvisa=mysql_fetch_array($Qvisa);
                                        $cari=mysql_query("SELECT * FROM msvisa WHERE PassNo = '$datatl[TourleaderPassportNo]' AND ProdEmbassy ='$Dvisa[CountryID]' AND StatCancel = '0' ORDER BY Id DESC limit 1");
                                        $cek=mysql_num_rows($cari); 
                                        $r=mysql_fetch_array($cari);  
                                        if ($cek > 0){
                                            if($r[ActOut] =='0000-00-00'){
                                                $rpt="<img src='../images/process.gif'> ON PROCESS";
                                            }else if($r[ActOut] <>'0000-00-00'){
                                                $rpt="<img src='../images/done.png'> ". date('d M Y', strtotime($r[ActOut]));
                                            }     
                                        }else{
                                            $rpt="<img src='../images/delete.png'>";
                                        }
                                      echo"<td><center>";if($datatl[TourleaderPassportNo]<>''){echo"$rpt";}echo"</center></td>";
                                    }                                             
                                }                          
                            echo "</tr>"; $notl++;   
                       }               
                   }else{$no=1;}
				   $lastbooking='awal';
                    while ($data=mysql_fetch_array($edit)){
                        if($data[PassportValid]=='0000-00-00' OR $data[PassportValid]==''){$pvalid='';}else{
                        $pvalid = date("d M Y", strtotime($data[PassportValid]));}    
                        $dtable=mysql_query("SELECT * FROM tour_msbooking                                                 
                                                WHERE BookingID ='$data[BookingID]'
                                                order by IDBookers ASC");        
                        $itable=mysql_fetch_array($dtable);
					
						 $BookingID=mysql_query("SELECT * FROM tour_msbookingdetail                                                 
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.TourCode ='$isi[TourCode]'
                    AND tour_msbooking.Year ='$isi[Year]'  
                    AND tour_msbookingdetail.Status <> 'CANCEL' and tour_msbooking.BookingID='$data[BookingID]'
                    order by tour_msbooking.BookingID ASC,IDDetail ASC");
         			$jumlahBooking=mysql_num_rows($BookingID);
					
                        if($data[PaxName]==''){$pax='TBA';}else{$pax=$data[PaxName];}
               echo "<tr><td>$no</td>";
                         if($lastbooking<>$data[BookingID])
						 {echo"<td rowspan='$jumlahBooking' style=vertical-align:middle>$data[BookingID]</td>";
						  echo"<td rowspan='$jumlahBooking' style=vertical-align:middle>$data[TCName] - $data[TCDivision]</td>";}
                        echo"<td>$data[Title] $pax</td>
                        <td>$data[PassportNo]</td>
                        <td>$data[PassportIssued]</td> 
                        <td>$pvalid</td>";
                                for ($i=1;$i<6;$i++)
                                {
                                $Embassy='Embassy0'.$i;
                                    if($isi[$Embassy]<>'0')
                                    {$Qvisa=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[$Embassy]'");        
                                        $Dvisa=mysql_fetch_array($Qvisa);
                                        $cari=mysql_query("SELECT * FROM msvisa WHERE PassNo = '$data[PassportNo]' AND ProdEmbassy ='$Dvisa[CountryID]' AND StatCancel = '0' ORDER BY Id DESC limit 1");
                                        $cek=mysql_num_rows($cari); 
                                        $r=mysql_fetch_array($cari);  
                                        if ($cek > 0){
                                            if($r[ActOut] =='0000-00-00'){
                                                $rpt="<img src='../images/process.gif'> ON PROCESS";
                                            }else if($r[ActOut] <>'0000-00-00'){
                                                $rpt="<img src='../images/done.png'> ". date('d M Y', strtotime($r[ActOut]));
                                            }        
                                        }else{
                                            $rpt="<img src='../images/delete.png'>";
                                        }
                                      echo"<td><center>";if($data[PassportNo]<>''){echo"$rpt";}echo"</center></td>";
                                    }       
                                }                          
                            echo "</tr>"; 
                      $no++;
					   $lastbooking=$data[BookingID];
                    }echo"
                   
                    </table><br><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('passportlist')>";
            }
?> <?php 
      
?>
</body>
</html>
<script>
	window.opener.location.reload();
</script>