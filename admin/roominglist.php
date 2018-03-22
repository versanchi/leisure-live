<html>
<head>
<title>ROOMING LIST</title>
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
		
         $ambil=mysql_query("SELECT tour_msproduct.IDProduct,tour_msproduct.TourCode,tour_msproduct.Year,tour_msbooking.BookingID,tour_msproduct.DateTravelFrom,tour_msproduct.TourLeaderInc,tour_msproduct.TourLeader,tour_msproduct.Flight FROM tour_msproduct
                    left join tour_msbooking on tour_msbooking.IDTourcode = tour_msproduct.IDProduct                                                 
                    WHERE tour_msproduct.IDProduct ='$IDProduct'
                    AND tour_msproduct.Status = 'PUBLISH'");
         $isi=mysql_fetch_array($ambil);
		
         $edit=mysql_query("SELECT tour_msbookingdetail.* ,CONVERT(RoomNo, UNSIGNED INTEGER) as urut FROM tour_msbookingdetail                                                 
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$IDProduct'
                    AND tour_msbookingdetail.Status <> 'CANCEL'
                    order by urut, BookingID ASC,IDDetail ASC");
         $jumlah=mysql_num_rows($edit);
         $depdet = date("d M Y", strtotime($isi[DateTravelFrom]));
         
         $rum=mysql_query("SELECT sum(AdultPax)as jumlaadult,sum(ChildPax)as jumlachild,sum(InfantPax)as jumlainf FROM tour_msbooking   
                                WHERE IDTourcode ='$IDProduct'
                                And Status = 'ACTIVE'
                                And BookingStatus = 'DEPOSIT'  
                                group by TourCode ASC");        
         $room=mysql_fetch_array($rum);
          if($isi[TourLeaderInc]=='YES'){$tl=1;}else{$tl=0;}
         $seluruh=$room[jumlaadult]+$room[jumlachild] + $tl;
          $totrum=mysql_query("SELECT tour_msbookingdetail.RoomNo FROM tour_msbookingdetail                                                 
                                left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                WHERE tour_msbooking.IDTourcode ='$IDProduct'
                                AND tour_msbookingdetail.Status <> 'CANCEL'
                                group by tour_msbookingdetail.RoomNo ASC");        
         $totroom=mysql_num_rows($totrum);
            if ($jumlah > 0) {
            echo "  <table style='border: 0px solid #000000;'>
                    <tr><td style='border: 0px solid #000000;'><font size=4><u><b>ROOMING LIST</b></u></font></td></tr>
                    <tr><td style='border: 0px solid #000000;'><img src='images/pano1.jpg'></td></tr>
                    <tr><td style='border: 0px solid #000000;'><font size=3><b>TOUR NAME : $isi[TourCode]</b></font></td></tr>
                    <tr><td style='border: 0px solid #000000;'><font size=3><b>DEPARTURE : $depdet / $isi[Flight]</b></font></td></tr>
                    <tr><td style='border: 0px solid #000000;'><font size=1><b>TOTAL PAX : $room[jumlaadult] ADT + $room[jumlachild] CHD + $tl TL= $seluruh PAXS</b></font></td></tr>
                    <tr><td style='border: 0px solid #000000;'><font size=1><b>TOTAL ROOM :  $totroom ROOMS</b></font></td></tr>
                    </table>   
                    <table STYLE='font-size: 12px;' id='namelist'>
                    <tr><th>NO</th><th>booking id</th><th>passanger's name</th><th >room type</th><th>room no</th><th>remarks</th><th>contact no</th></tr>"; 
                   if($isi[TourLeaderInc]=='YES'){
                       $no=2;
                       $carisatu=mysql_query("SELECT * FROM tour_mstourleader   
                                where TourleaderStatus = 'ACTIVE'
                                AND TourleaderName = '$isi[TourLeader]' 
                                order by TourleaderName ASC");        
                       $hasilsatu=mysql_num_rows($carisatu);
                       $caridua=mysql_query("SELECT * FROM tbl_msemployee 
                                where employee_tl = 'on'
                                AND employee_name = '$isi[TourLeader]'
                                ORDER BY employee_name ASC");        
                       $hasildua=mysql_num_rows($caridua);
                       if($hasilsatu>0){
                            $datatl=mysql_fetch_array($carisatu);
                            $bdate = date("d M Y", strtotime($datatl[TourleaderBirthDate]));
                            $pvalid = date("d M Y", strtotime($datatl[TourleaderPassportValid]));
                            if($bdate=='01 Jan 1970'){$bdate="";}else{$bdate=$bdate;}
                            if($pvalid=='01 Jan 1970'){$pvalid="";}else{$pvalid=$pvalid;}
                            echo "<tr><td>1</td>
                                <td></td>
                                <td>$datatl[TourleaderName]</td>
                                <td>SGL</td>
                                <td></td>
                                <td>TOUR LEADER</td>
                                <td>$datatl[TourleaderMobile]</td>
                                            
                                </tr>";    
                       }else{
                            $datatl=mysql_fetch_array($caridua);
                            $bdate = date("d M Y", strtotime($datatl[BirthDate]));
                            $pvalid = date("d M Y", strtotime($datatl[PassportValid]));
                            if($bdate=='01 Jan 1970'){$bdate="";}else{$bdate=$bdate;}
                            if($pvalid=='01 Jan 1970'){$pvalid="";}else{$pvalid=$pvalid;}
                            echo "<tr><td>1</td>
                                <td></td>
                                <td>$datatl[employee_name]</td>
                                <td>SGL</td>
                                <td></td>
                                <td>TOUR LEADER</td>
                                <td></td>
                                            
                                </tr>";    
                       }
                       
                   }else{$no=1;}
                    $lastbooking='awal';
					 $lastroom='awal';
					
                    while ($data=mysql_fetch_array($edit)){
                        $bdate = date("d M Y", strtotime($data[BirthDate]));
                        $pvalid = date("d M Y", strtotime($data[PassportValid]));
                        if($bdate=='01 Jan 1970'){$bdate="";}else{$bdate=$bdate;}
                        if($pvalid=='01 Jan 1970'){$pvalid="";}else{$pvalid=$pvalid;}
                        $dtable=mysql_query("SELECT * FROM tour_msbooking                                                 
                                                WHERE BookingID ='$data[BookingID]'
                                                order by IDBookers ASC");        
                        $itable=mysql_fetch_array($dtable);
						
					
					$Bookinglain=mysql_query("SELECT * FROM tour_msbookingdetail                                                 
                    WHERE IDTourcode ='$IDProduct'
                    AND tour_msbookingdetail.Status <> 'CANCEL' and BookingID<>'$data[BookingID]' and RoomNo ='$data[RoomNo]'");
         			$jumBookinglain=mysql_num_rows($Bookinglain);
					
					
                        if($data[PaxName]==''){$pax='TBA';}else{$pax=$data[PaxName];}
               echo "<tr><td>$no</td>";
                        if($lastbooking<>$data[BookingID]){
					
					if($jumBookinglain>0 and $data[RoomNo]>$lastroom ){
						$BookingID=mysql_query("SELECT * FROM tour_msbookingdetail                                                 
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$IDProduct'
                    AND tour_msbookingdetail.Status <> 'CANCEL' and tour_msbooking.BookingID='$data[BookingID]' and tour_msbookingdetail.RoomNo='$data[RoomNo]'
                    order by tour_msbooking.BookingID ASC,IDDetail ASC");
         			$jumlahBooking=mysql_num_rows($BookingID);
					}
					else
					{
					$BookingID=mysql_query("SELECT * FROM tour_msbookingdetail                                                 
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$IDProduct'
                    AND tour_msbookingdetail.Status <> 'CANCEL' and tour_msbooking.BookingID='$data[BookingID]'
                    order by tour_msbooking.BookingID ASC,IDDetail ASC");
         			$jumlahBooking=mysql_num_rows($BookingID);
					}
						echo"<td rowspan='$jumlahBooking' style=vertical-align:middle>$data[BookingID]</td>";}
                echo"
                        <td>$data[Title] $pax</td>
                        <td>$data[RoomType]</td>
                        <td><center>$data[RoomNo]</td>
                        <td>$data[Deviasi]</td>";
                        if($lastbooking<>$data[BookingID]){echo"<td rowspan='$jumlahBooking' style=vertical-align:middle>$itable[BookersMobile]</td>";}
                        echo" </tr> ";
                      $no++;
					   $lastbooking=$data[BookingID];
					   $lastroom=$data[RoomNo];
                    }echo"
                   
                    </table><table style='border: 0px solid #000000;'>
                    <tr><td style='border: 0px solid #000000;'></td></tr>
                    <tr><td style='border: 0px solid #000000;' colspan=5><u>FLIGHT SCHEDULE :</u></td></tr>";
                    $fly=mysql_query("SELECT * FROM tour_msprodflight                                                 
                                        WHERE IDProduct ='$isi[IDProduct]'");
                    while($flight=mysql_fetch_array($fly)){
                        echo"<tr><td style='border: 0px solid #000000;'><font size=1>$flight[AirCode]</font></td>
                        <td style='border: 0px solid #000000;'><font size=1>$flight[AirDate] $flight[AirMonth]</font></td>
                        <td style='border: 0px solid #000000;'><font size=1>$flight[AirRoute]</font></td>
                        <td style='border: 0px solid #000000;'><font size=1>$flight[AirTimeDep]</font></td>
                        <td style='border: 0px solid #000000;'><font size=1>$flight[AirTimeArr]</font></td></tr>";
                    }
                    echo"</table><br><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('namelist')>";
            }
?> <?php 
      
?>
</body>
</html>
<script>
	window.opener.location.reload();
</script>