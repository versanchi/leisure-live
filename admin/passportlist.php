<html>
<head>
<title>PASSPORT LIST</title>
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
                    left join tour_msbooking on tour_msbooking.TourCode = tour_msproduct.TourCode                                                 
                    WHERE tour_msproduct.IDProduct ='$IDProduct'
                    AND tour_msbooking.Year = tour_msproduct.Year  
                    AND tour_msproduct.Status = 'PUBLISH'");
         $isi=mysql_fetch_array($ambil);
         $edit=mysql_query("SELECT tour_msbookingdetail.* ,CONVERT(RoomNo, UNSIGNED INTEGER) as urut  FROM tour_msbookingdetail                                                 
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.TourCode ='$isi[TourCode]'
                    AND tour_msbooking.Year ='$isi[Year]'  
                    AND tour_msbookingdetail.Status <> 'CANCEL'
                    order by urut, BookingID ASC,IDDetail ASC");
         $jumlah=mysql_num_rows($edit);
         $depdet = date("d M Y", strtotime($isi[DateTravelFrom]));
         
         $rum=mysql_query("SELECT sum(AdultPax)as jumlaadult,sum(ChildPax)as jumlachild,sum(InfantPax)as jumlainf FROM tour_msbooking   
                                WHERE TourCode = '$isi[TourCode]'
                                and Year = '$isi[Year]'
                                And Status = 'ACTIVE'
                                And BookingStatus = 'DEPOSIT'  
                                group by TourCode ASC");        
         $room=mysql_fetch_array($rum);
          if($isi[TourLeaderInc]=='YES'){$tl=1;}else{$tl=0;}
         $seluruh=$room[jumlaadult]+$room[jumlachild] + $tl;
          
            if ($jumlah > 0) {
            echo "  <table style='border: 0px solid #000000;'>
                    <tr><td style='border: 0px solid #000000;'><font size=4><u><b>PASSPORT LIST</b></u></font></td></tr>
                    <tr><td style='border: 0px solid #000000;'><img src='images/pano1.jpg'></td></tr>
                    <tr><td style='border: 0px solid #000000;'><font size=3><b>TOUR NAME : $isi[TourCode]</b></font></td></tr>
                    <tr><td style='border: 0px solid #000000;'><font size=3><b>DEPARTURE : $depdet / $isi[Flight]</b></font></td></tr>
                    <tr><td style='border: 0px solid #000000;'><font size=1><b>TOTAL PAX : $room[jumlaadult] ADT + $room[jumlachild] CHD + $tl TL= $seluruh PAXS</b></font></td></tr>
                    </table>
                    <table STYLE='font-size: 12px;' id='passportlist'>
                    <tr><th>NO</th><th>booking id</th><th>passanger's name</th><th>passport no</th><th>date of issue</th><th colspan=2>place & date of birth</th><th colspan=2>place & date of expiry</th></tr>";
                    if($isi[TourLeaderInc]=='YES'){
                        $cariteel=mysql_query("SELECT * FROM tour_msproducttl
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL'
                                order by IDPTL ASC");
                        $hasilteel=mysql_num_rows($cariteel);
                       $no=2;
                       $carisatu=mysql_query("SELECT * FROM tbl_msemployee
                                where employee_id = '$isi[IDTourLeader]'
                                order by employee_name ASC");
                       $hasilsatu=mysql_num_rows($carisatu);
                       $caridua=mysql_query("SELECT * FROM tbl_msemployee 
                                where employee_tl = 'on'
                                AND employee_name = '$isi[TourLeader]'
                                ORDER BY employee_name ASC");        
                       $hasildua=mysql_num_rows($caridua);
                       if($hasilsatu>0){
                            $datatl=mysql_fetch_array($carisatu);
                            if($datatl[BirthDate]=='0000-00-00' OR $datatl[BirthDate]==''){$bdate="";}else{
                            $bdate = date("d M Y", strtotime($datatl[BirthDate]));
                            }
                            if($datatl[PassportValid]=='0000-00-00' OR $datatl[PassportValid]==''){$pvalid="";}else{
                            $pvalid = date("d M Y", strtotime($datatl[PassportValid]));
                            }
                           if($datatl[PassportIssuedDate]=='0000-00-00' OR $datatl[PassportIssuedDate]==''){$pvaliddate="";}else{
                               $pvaliddate = date("d M Y", strtotime($datatl[PassportIssuedDate]));
                           }
                           echo "<tr><td>1</td>
                                <td></td>
                                <td>$datatl[NameAsPassport]</td>
                                <td>$datatl[PassportNo]</td>
                                <td>$pvaliddate</td>
                                <td>$datatl[BirthPlace]</td>
                                <td>$bdate</td>
                                <td>$datatl[PassportIssued]</td>
                                <td>$pvalid</td>             
                                </tr>";    
                       }else{
                            $datatl=mysql_fetch_array($caridua);
                            if($data[BirthDate]=='0000-00-00' OR $data[BirthDate]==''){$bdate='';}else{
                            $bdate = date("d M Y", strtotime($data[BirthDate]));}
                            if($data[PassportValid]=='0000-00-00' OR $data[PassportValid]==''){$pvalid='';}else{
                            $pvalid = date("d M Y", strtotime($data[PassportValid]));}
                           if($data[PassportIssuedDate]=='0000-00-00' OR $data[PassportIssuedDate]==''){$pvaliddate="";}else{
                               $pvaliddate = date("d M Y", strtotime($data[PassportIssuedDate]));
                           }
                            echo "<tr><td>1</td>
                                <td></td>
                                <td>$datatl[employee_name]</td>
                                <td>$datatl[PassportNo]</td>
                                <td>$pvaliddate</td>
                                <td>$datatl[BirthPlace]</td>
                                <td>$bdate</td>
                                <td>$datatl[PassportIssued]</td> 
                                <td>$pvalid</td>             
                                </tr>";    
                       }
                       
                   }else{$no=1;}
				   $lastbooking='awal';
                    while ($data=mysql_fetch_array($edit)){
                        if($data[BirthDate]=='0000-00-00' OR $data[BirthDate]==''){$bdate='';}else{
                        $bdate = date("d M Y", strtotime($data[BirthDate]));}
                        if($data[PassportValid]=='0000-00-00' OR $data[PassportValid]==''){$pvalid='';}else{
                        $pvalid = date("d M Y", strtotime($data[PassportValid]));}
                        if($data[PassportValid]=='0000-00-00' OR $data[PassportValid]==''){$pvalid='';}else{
                            $pvalid = date("d M Y", strtotime($data[PassportValid]));}
                        if($data[PassportIssuedDate]=='0000-00-00' OR $data[PassportIssuedDate]==''){$pvaliddate="";}else{
                            $pvaliddate = date("d M Y", strtotime($data[PassportIssuedDate]));
                        }
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
                         if($lastbooking<>$data[BookingID]){echo"<td rowspan='$jumlahBooking' style=vertical-align:middle>$data[BookingID]</td>";}
                        echo"<td>$data[Title] $pax</td>
                        <td>$data[PassportNo]</td>
                        <td>$pvaliddate</td>
                        <td>$data[BirthPlace]</td>
                        <td>$bdate</td>
                        <td>$data[PassportIssued]</td> 
                        <td>$pvalid</td>             
                     </tr> ";
                      $no++;
					   $lastbooking=$data[BookingID];
                    }echo"
                   
                    </table><br><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('passportlist')>";
            }
?>
</body>
</html>
<script>
	window.opener.location.reload();
</script>