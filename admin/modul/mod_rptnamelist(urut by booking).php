<script type="text/javascript"> 
function generateexcel(tableid) {
  var table= document.getElementById(tableid);
  var html = table.outerHTML;   
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));    
}  
</script>
<script type="text/javascript"> 
function validateFormOnSubmit(theForm) {
var reason = "";                            
  reason += validateEmpty(theForm.Divisi);
  reason += validateEmpty(theForm.TcName);
  reason += validateEmpty(theForm.PaxName);  
      
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);
    return false;
  }

  return true;
}

</script>

<?php 
include "../config/koneksi.php";
include "../config/fungsi_an.php";

switch($_GET[act]){
  // Tampil Search Tour code
  default:
      $nama=$_GET['nama'];
      $list=$_GET['list'];
      $hariini = date("Y-m-d ");
	  $username=$_SESSION['employee_code'];
    $tampil2=mysql_query("SELECT employee_name, employee_code, office_code, office_group,job_desc FROM tbl_msemployee 
                        left join tbl_msoffice on tbl_msoffice.office_id = tbl_msemployee.office_id
                        WHERE employee_code='$username'");
            $hasil2=mysql_fetch_object($tampil2);
            $JobDesc=$hasil2->job_desc;
            
    echo "<h2>Name List</h2>
          <form method=get action='media.php?'>
              Tour Code 
              <select name='nama'><option value=''>- Select TourCode -</option>"; 
              $option = mysql_query("SELECT tour_msproduct.IDProduct,tour_msproduct.TourCode FROM tour_msbooking 
                                    left join tour_msproduct on tour_msproduct.TourCode = tour_msbooking.TourCode
                                    WHERE tour_msproduct.DateTravelTo >= '$hariini'
                                    AND tour_msproduct.Year = tour_msbooking.Year 
                                    AND tour_msbooking.TourCode <> '' AND tour_msproduct.Status <> 'VOID' AND tour_msproduct.Status = 'PUBLISH' AND tour_msbooking.Status = 'ACTIVE' and TCDivision <> 'LTM' AND TCDivision <> 'LTM-TEZ'  GROUP BY tour_msbooking.TourCode ASC");  
									
              while($s=mysql_fetch_array($option)){
              if ($s['IDProduct']==$nama){
                echo "<option value='$s[IDProduct]' selected >$s[TourCode]</option>";  
              }else {
              echo "<option value='$s[IDProduct]'>$s[TourCode]</option>";
              }
                   
              }
    echo "</select> <input type=hidden name=module value='rptnamelist'> 
              <input type=submit name=oke value=Show>
          </form>";
		   $oke=$_GET['oke'];
		$IDProduct=$nama;    
		if($IDProduct<>''){
         $ambil=mysql_query("SELECT tour_msproduct.IDProduct,tour_msproduct.TourCode,tour_msproduct.Year,TCDivision,tour_msbooking.BookingID,
                    tour_msproductcode.Productcode,tour_msproduct.DateTravelFrom,tour_msproduct.TourLeaderInc,tour_msproduct.TourLeader,
                    tour_msproduct.Flight,tour_msproduct.StatusProduct,tour_msproduct.GroupType FROM tour_msproduct
                    left join tour_msbooking on tour_msbooking.IDTourcode = tour_msproduct.IDProduct 
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode     
                    WHERE tour_msproduct.IDProduct ='$IDProduct'");
         $isi=mysql_fetch_array($ambil);
		 
		 // ini urutannya name list harus sesuai nomor kamar karena ada sharing sales yang bikin kacau nomor kamar
         $edit=mysql_query("SELECT tour_msbookingdetail.*,tour_msbooking.TBFNo,CONVERT(RoomNo, UNSIGNED INTEGER) as urut FROM tour_msbookingdetail
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                    AND tour_msbooking.Status = 'ACTIVE' 
                    AND tour_msbookingdetail.Status <> 'CANCEL'
                    order by urut,tour_msbooking.BookingID ASC,IDDetail ASC");
					
		 $roomnow='awal';
         $jumlah=mysql_num_rows($edit);
         $depdet = date("d M Y", strtotime($isi[DateTravelFrom]));
         
         $rum=mysql_query("SELECT sum(AdultPax)as jumlaadult,sum(ChildPax)as jumlachild,sum(InfantPax)as jumlainf FROM tour_msbooking   
                                WHERE IDTourcode = '$isi[IDProduct]'
                                And Status = 'ACTIVE'
                                And BookingStatus = 'DEPOSIT'  
                                group by TourCode ASC");        
         $room=mysql_fetch_array($rum);
         $jumteel=mysql_query("SELECT * FROM tour_msproducttl   
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL' 
                                order by IDPTL ASC");        
         $banyakteel=mysql_num_rows($jumteel);
          if($isi[TourLeaderInc]=='YES'){$tl=$banyakteel;}else{$tl=0;}
         $seluruh=$room[jumlaadult]+$room[jumlachild] + $tl;
          $totrum=mysql_query("SELECT tour_msbookingdetail.RoomNo FROM tour_msbookingdetail
                                left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                                AND tour_msbookingdetail.Status <> 'CANCEL'
                                AND tour_msbooking.Status = 'ACTIVE'
                                group by tour_msbookingdetail.BookingID,RoomNo ASC");
         $totroom=mysql_num_rows($totrum);
		 
            if ($jumlah > 0) {if($tl>0){$rmtl="+ $tl TL ROOM";}
            echo "<table STYLE='border: 0px solid #000000' id='namelist'>	
						<tr><td style='border: 0px solid #000000;' colspan='6'><font size=4><u><b>FINAL NAME LIST</b></u></font></td></tr>
						<tr><td style='border: 0px solid #000000;' colspan='6'><img src='images/pano1.jpg'></td></tr>
						<tr><td style='border: 0px solid #000000;' colspan='12'><font size=3><b>TOUR NAME : $isi[Productcode] - $isi[TourCode]</b></font></td></tr><tr><td style='border: 0px solid #000000; ' valign='top'; colspan='6'; >												
							<table STYLE='border: 0px solid #000000' valign='top'>
                                <tr><td style='border: 0px solid #000000;' colspan='6'><font size=3><b>DEPARTURE : $depdet </b></font></td></tr><tr><td style='border: 0px solid #000000;' ><font size=1><b>TOTAL PAX : $room[jumlaadult] ADT + $room[jumlachild] CHD + $tl TL= $seluruh PAXS</b></font></td></tr>
								<tr><td style='border: 0px solid #000000;' ><font size=1><b>TOTAL ROOM :  $totroom ROOMS $rmtl</b></font></td></tr>
							</table></td>
					<td style='border: 0px solid #000000;'><u>FLIGHT SCHEDULE :</u></td>
					<td style='border: 0px solid #000000;' colspan='8'>
					<table STYLE='border: 0px solid #000000'>
							";
							$qpnr=mysql_query("SELECT * FROM tour_msproductpnr                                                 
												WHERE PnrProd ='$isi[IDProduct]'");
							$pnr=mysql_fetch_array($qpnr);
							$fly=mysql_query("SELECT * FROM tour_msprodflight                                                 
												WHERE IDGrv ='$pnr[GrvID]' order by FID ASC");
							while($flight=mysql_fetch_array($fly)){
								$AD = strtoupper(date('d M', strtotime($flight[AirDate]))); 
								$ATD = date('H.i', strtotime($flight[AirTimeDep]));
								$ATA = date('H.i', strtotime($flight[AirTimeArr]));
								echo"
								<tr><td style='border: 0px solid #000000;'><font size=1>$flight[AirCode]</font></td>
								<td style='border: 0px solid #000000;'><font size=1>$AD</font></td>
								<td style='border: 0px solid #000000;'><center><font size=1>$flight[AirRouteDep] - $flight[AirRouteArr]</font></td>
								<td style='border: 0px solid #000000;'><font size=1>$ATD - $ATA</font></td></tr>";                        
							}
                    if($isi[GroupType]=='CRUISE'){$rtype='TYPE';}else{$rtype='ROOM TYPE';}
                    echo"</table>
					</td>
					</tr>
                   
                    <tr><th>NO</th><th>TBF No</th><th>passanger's name</th><th >$rtype</th><th>room no</th><th>Note PO</th><th>remarks</th>
                    <th>contact no</th><th>TC</th><th>passport no</th><th colspan=2>place & date of birth</th>
                    <th colspan=2>place & date of expiry</th></tr>";
					//note PO tidak bisa digabung sama remarks karena remarks untuk yang LA only per pax
					
                   if($isi[TourLeaderInc]=='YES'){
                       $cariteel=mysql_query("SELECT * FROM tour_msproducttl   
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL' 
                                order by IDPTL ASC");        
                       $hasilteel=mysql_num_rows($cariteel);
                       $no=$hasilteel+1;
                       $notl=1;
                       while($tlnya=mysql_fetch_array($cariteel)){
                           $carisatu=mysql_query("SELECT * FROM tbl_msemployee
                                    where employee_id = '$tlnya[IDTourleader]'
                                    order by employee_name ASC");
                           $hasilsatu=mysql_num_rows($carisatu);
                           $caridua=mysql_query("SELECT * FROM tbl_msemployee 
                                    where employee_tl = 'on'
                                    AND employee_name = '$tlnya[TLName]'
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
                                echo "<tr><td>$notl</td>
                                    <td></td>
                                    <td>$datatl[UserCall] $datatl[NameAsPassport]</td>
                                    <td><center>SGL</td>
                                    <td></td>
									<td></td>
                                    <td><center>TOUR LEADER</td>
                                    <td>$datatl[Mobile]</td>
                                    <td></td>
                                    <td>$datatl[PassportNo]</td>
                                    <td>$datatl[BirthPlace]</td>
                                    <td>$bdate</td>
                                    <td>$datatl[PassportIssued]</td>
                                    <td>$pvalid</td>             
                                    </tr>";    
                           }else{
                                $datatl=mysql_fetch_array($caridua);
                               if($datatl[TourleaderBirthDate]=='0000-00-00' OR $datatl[TourleaderBirthDate]==''){$bdate="";}else{
                                $bdate = date("d M Y", strtotime($datatl[TourleaderBirthDate]));
                                }
                                if($datatl[TourleaderPassportValid]=='0000-00-00' OR $datatl[TourleaderPassportValid]==''){$pvalid="";}else{
                                $pvalid = date("d M Y", strtotime($datatl[TourleaderPassportValid]));
                                }          
                                echo "<tr><td>$notl</td>
                                    <td></td>
                                    <td>$datatl[UserCall] $datatl[employee_name]</td>
                                    <td><center>SGL</td>
                                    <td></td>
									<td></td>
                                    <td><center>TOUR LEADER</td>
                                    <td></td>
                                    <td></td>
                                    <td>$datatl[PassportNo]</td>
                                    <td>$datatl[BirthPlace]</td>
                                    <td>$bdate</td>
                                    <td>$datatl[PassportIssued]</td> 
                                    <td>$pvalid</td>             
                                    </tr>";    
                           }
                           $notl++;
                       }
                   }else{$no=1;}
                    $lastbooking='awal';				
                    while ($data=mysql_fetch_array($edit)){
					
                        if($data[BirthDate]=='0000-00-00' OR $data[BirthDate]==''){$bdate='';}else{
                        $bdate = date("d M Y", strtotime($data[BirthDate]));}
						
                        if($data[PassportValid]=='0000-00-00' OR $data[PassportValid]==''){$pvalid='';}else{
                        $pvalid = date("d M Y", strtotime($data[PassportValid]));}         
						
                        $dtable=mysql_query("SELECT * FROM tour_msbooking                                                 
                                                WHERE BookingID ='$data[BookingID]'
                                                AND Status = 'ACTIVE'
                                                order by IDBookers ASC");        
                        $itable=mysql_fetch_array($dtable);
						
						
						$BookingID=mysql_query("SELECT * FROM tour_msbookingdetail                                                 
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                    AND tour_msbooking.Status = 'ACTIVE'
                    AND tour_msbookingdetail.Status <> 'CANCEL' 
                    and tour_msbooking.BookingID='$data[BookingID]'
                    order by tour_msbooking.BookingID ASC,IDDetail ASC");
         			$jumlahBooking=mysql_num_rows($BookingID);
                        if($data[Promo]<>''){$promo="<font color='red'>*</font>";$ket="<font size=1>* $data[Promo]</font>";}else{$promo="";}
		                if($data[Age]<>'' and ($data[Gender]=='CHILD' OR $data[Gender]=='INFANT')){$age="<b>($data[Age] old)</b>";}else{$age="";}
                        if($data[PaxName]==''){$pax="TBA $promo";}else{$pax="$data[PaxName] $promo";}
               echo "<tr><td>$no</td>";
                        if($lastbooking<>$data[BookingID]){echo"<td rowspan='$jumlahBooking' style=vertical-align:middle>$data[TBFNo]</td>";}
                echo"<td>$data[Title] $pax $age</td>";
                 
				  if($roomnow<>$data[RoomNo] or $lastbooking<>$data[BookingID] ){
				  	$jenis='awal';
						$totalroom=mysql_query("SELECT * FROM tour_msbookingdetail                   
                    WHERE BookingID='$data[BookingID]'
                    AND tour_msbookingdetail.Status <> 'CANCEL' and RoomNo='$data[RoomNo]' ");
				
					$jumlahparty=mysql_num_rows($totalroom);
					//gabungan jenis kamar
						$typeroom=mysql_query("SELECT distinct RoomType FROM tour_msbookingdetail                   
              			      WHERE BookingID='$data[BookingID]'
                 			   AND tour_msbookingdetail.Status <> 'CANCEL' and RoomNo='$data[RoomNo]' ");
						 while ($dtyperoom=mysql_fetch_array($typeroom)){
						 	if($dtyperoom[RoomType]=='Double'){$RoomType='DBL';}
							else
							if($dtyperoom[RoomType]=='Triple'){$RoomType='TRP';}
							else
							if($dtyperoom[RoomType]=='Twin'){$RoomType='TWN';}
							else
							{$RoomType=$dtyperoom[RoomType];}
						 	if ($jenis=='awal')
							{
								
								$jenis=$RoomType;
							}
							else
							{
								$jenis=$jenis." + ".$RoomType;
							}
						 
						 }
					    if($jenis=='12 Pax'){$tipe='1-2 PAX';}
                        else if($jenis=='34 Pax'){$tipe='3-4 PAX';}
                        else if($jenis=='1 Pax'){$tipe='SINGLE';}
                        else{$tipe=$jenis;}
						echo"<td rowspan='$jumlahparty' style=vertical-align:middle><center>$tipe</td>
                        <td rowspan='$jumlahparty' style=vertical-align:middle><center></td>";
						$roomnow=$data[RoomNo];}

						if($lastbooking<>$data[BookingID]){echo"<td rowspan='$jumlahBooking' style=vertical-align:middle>$itable[OperationNote]</td>";}
                        if($data[Package]=='L.A Only'){echo"<td><center>$data[Package] $data[Deviasi]</td>";}else{echo"<td><center>$data[Deviasi]</td>";}
                        if($lastbooking<>$data[BookingID]){echo"<td rowspan='$jumlahBooking' style=vertical-align:middle>$itable[BookersName] <br> $itable[BookersTelp] <br>$itable[BookersMobile]</td>";
						echo"<td rowspan='$jumlahBooking' style=vertical-align:middle>$itable[TCName] <br>( $itable[TCDivision] ) </td>";
						$lastbooking=$data[BookingID];}
						
                        echo"<td>$data[PassportNo]</td>
                        <td>$data[BirthPlace]</td>
                        <td>$bdate</td>
                        <td>$data[PassportIssued]</td> 
                        <td>$pvalid</td>             
                     </tr> ";
                      $no++;
                    }
                    if($isi[StatusProduct]=='FINALIZE'){$ganti='enable';}else{$ganti='disabled';}
                    echo"
                    </table>$ket<br><center><input type='button' name='submit' value='Export to Excel' onclick=location.href='namelist.php?IDProduct=$nama'>
                    <input type=button value='Change Room' onclick=location.href='?module=rptnamelist&act=roomchange&code=$nama' $ganti>";
	}
	}        
	break;
	
case "namelistgrv":
      $idgrv=$_GET['no'];
      $list=$_GET['list'];
      $hariini = date("Y-m-d ");
      $tampil2=mysql_query("SELECT job_desc FROM tbl_msemployee WHERE employee_username='$_SESSION[namauser]'");
      $hasil2=mysql_fetch_object($tampil2);
      $JobDesc=$hasil2->job_desc;
      $option = mysql_query("SELECT * FROM tour_msproductpnr 
                                    WHERE GrvID = '$idgrv'
                                    order BY PnrID ASC");  
      //echo "<h2>Name List</h2>";
      $qpnr=mysql_query("SELECT * FROM tour_msgrv                                                 
                                        WHERE IDGrv ='$idgrv'");
      $pnr=mysql_fetch_array($qpnr);
      echo"  <table STYLE='border: 0px solid #000000' id='namelistgrv'>
                    <tr><td style='border: 0px solid #000000;' colspan=6></td></tr>
                    <tr><td style='border: 0px solid #000000;' colspan=6><font size=4><u><b>FINAL NAME LIST </b></u></font></td></tr>
                    <tr><td style='border: 0px solid #000000;' colspan=5><u>FLIGHT SCHEDULE : $pnr[GrvPnr]</u></td></tr>";
                    
                    $fly=mysql_query("SELECT * FROM tour_msprodflight                                                 
                                        WHERE IDGrv ='$idgrv' order by FID ASC");
                    echo"<tr><td style='border: 0px solid #000000;' colspan='4'>
                        <table STYLE='border: 0px solid #000000'>";
                    while($flight=mysql_fetch_array($fly)){
                        $AD = date('d-m-Y', strtotime($flight[AirDate]));
                        echo"
                        <tr><td style='border: 0px solid #000000;'><font size=1>$flight[AirCode]</font></td>
                        <td style='border: 0px solid #000000;'><font size=1>$AD</font></td>
                        <td style='border: 0px solid #000000;'><center><font size=1>$flight[AirRouteDep] - $flight[AirRouteArr]</font></td>
                        <td style='border: 0px solid #000000;'><font size=1>$flight[AirTimeDep]</font></td>
                        <td style='border: 0px solid #000000;'><font size=1>$flight[AirTimeArr]</font></td></tr>";
                       
                    }echo"</table>  
                        </td></tr>
                        <tr><th>NO</th><th>Tourcode/Booking no</th><th>passanger's name</th><th>remarks</th><th>contact no</th><th>TC</th><th>passport no</th><th colspan=2>place & date of birth</th><th colspan=2>place & date of expiry</th></tr>"; 
      while($s=mysql_fetch_array($option)){      
        $IDProduct=$s[PnrProd];    
        if($IDProduct<>''){
         $ambil=mysql_query("SELECT tour_msproduct.IDProduct,tour_msproduct.TourCode,tour_msproduct.Year,TCDivision,tour_msbooking.BookingID,
                    tour_msproductcode.Productcode,tour_msproduct.DateTravelFrom,tour_msproduct.TourLeaderInc,tour_msproduct.TourLeader,
                    tour_msproduct.Flight FROM tour_msproduct
                    left join tour_msbooking on tour_msbooking.IDTourcode = tour_msproduct.IDProduct 
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode     
                    WHERE tour_msproduct.IDProduct ='$IDProduct'");
         $isi=mysql_fetch_array($ambil);
		 
         $edit=mysql_query("SELECT tour_msbookingdetail.*,tour_msbooking.TBFNo FROM tour_msbookingdetail                                                 
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                    AND tour_msbooking.Status = 'ACTIVE' 
                    AND tour_msbookingdetail.Status <> 'CANCEL' 
                    AND tour_msbookingdetail.Package <> 'L.A Only'
                    order by tour_msbookingdetail.BookingID ,RoomNo ASC,IDDetail ASC");
         
		 $roomnow='awal';
         $jumlah=mysql_num_rows($edit);
         $depdet = date("d M Y", strtotime($isi[DateTravelFrom]));
         
         $rum=mysql_query("SELECT sum(AdultPax)as jumlaadult,sum(ChildPax)as jumlachild,sum(InfantPax)as jumlainf FROM tour_msbooking   
                                WHERE IDTourcode = '$isi[IDProduct]'
                                And Status = 'ACTIVE'
                                And BookingStatus = 'DEPOSIT'  
                                group by TourCode ASC");        
         $room=mysql_fetch_array($rum);
         $jumteel=mysql_query("SELECT * FROM tour_msproducttl   
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL' 
                                order by IDPTL ASC");        
         $banyakteel=mysql_num_rows($jumteel);
          if($isi[TourLeaderInc]=='YES'){$tl=$banyakteel;}else{$tl=0;}
         $seluruh=$room[jumlaadult]+$room[jumlachild] + $tl;
          $totrum=mysql_query("SELECT tour_msbookingdetail.RoomNo FROM tour_msbookingdetail                                                 
                                left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                                AND tour_msbookingdetail.Status <> 'CANCEL'
                                AND tour_msbookingdetail.Package <> 'L.A Only'
                                AND tour_msbooking.Status = 'ACTIVE'
                                 group by tour_msbookingdetail.BookingID,RoomNo ASC");
         $totroom=mysql_num_rows($totrum);
                                                
                    
                   $nonya=$nonya;
                   if($nonya>1){$nonya=$nonya;}else{$nonya=$nonya+1;}
                   if ($jumlah > 0) {
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
                                    AND TourleaderName = '$tlnya[TLName]' 
                                    order by TourleaderName ASC");        
                           $hasilsatu=mysql_num_rows($carisatu);
                           $caridua=mysql_query("SELECT * FROM tbl_msemployee 
                                    where employee_tl = 'on'
                                    AND employee_name = '$tlnya[TLName]'
                                    ORDER BY employee_name ASC");        
                           $hasildua=mysql_num_rows($caridua);
                           if($hasilsatu>0){
                                $datatl=mysql_fetch_array($carisatu);
                                if($datatl[TourleaderBirthDate]=='0000-00-00' OR $datatl[TourleaderBirthDate]==''){$bdate="";}else{
                                $bdate = date("d M Y", strtotime($datatl[TourleaderBirthDate]));
                                }
                                if($datatl[TourleaderPassportValid]=='0000-00-00' OR $datatl[TourleaderPassportValid]==''){$pvalid="";}else{
                                $pvalid = date("d M Y", strtotime($datatl[TourleaderPassportValid]));
                                }          
                                echo "<tr><td>$nonya </td>
                                    <td></td>
                                    <td>$datatl[TourleaderName]</td>   
                                    <td><center>TOUR LEADER</td>
                                    <td>$datatl[TourleaderMobile]</td>
                                    <td></td>
                                    <td>$datatl[TourleaderPassportNo]</td>
                                    <td>$datatl[TourleaderBirthPlace]</td>
                                    <td>$bdate</td>
                                    <td>$datatl[TourleaderPassportIssued]</td> 
                                    <td>$pvalid</td>             
                                    </tr>";
                                    $nonya++;      
                           }else{
                                $datatl=mysql_fetch_array($caridua);
                               if($datatl[TourleaderBirthDate]=='0000-00-00' OR $datatl[TourleaderBirthDate]==''){$bdate="";}else{
                                $bdate = date("d M Y", strtotime($datatl[TourleaderBirthDate]));
                                }
                                if($datatl[TourleaderPassportValid]=='0000-00-00' OR $datatl[TourleaderPassportValid]==''){$pvalid="";}else{
                                $pvalid = date("d M Y", strtotime($datatl[TourleaderPassportValid]));
                                }          
                                echo "<tr><td>$nonya</td>
                                    <td></td>
                                    <td>$datatl[employee_name]</td>
                                    <td><center>TOUR LEADER</td>
                                    <td></td>
                                    <td></td>
                                    <td>$datatl[PassportNo]</td>
                                    <td>$datatl[BirthPlace]</td>
                                    <td>$bdate</td>
                                    <td>$datatl[PassportIssued]</td> 
                                    <td>$pvalid</td>             
                                    </tr>";
                                    $nonya++;    
                           }
                           $notl++;
                              
                       }
                   }else{$no=1;}
				   
                    $lastbooking='awal';
                    while ($data=mysql_fetch_array($edit)){
                        if($data[BirthDate]=='0000-00-00' OR $data[BirthDate]==''){$bdate='';}else{
                        $bdate = date("d M Y", strtotime($data[BirthDate]));}
                        if($data[PassportValid]=='0000-00-00' OR $data[PassportValid]==''){$pvalid='';}else{
                        $pvalid = date("d M Y", strtotime($data[PassportValid]));}         
                        $dtable=mysql_query("SELECT * FROM tour_msbooking                                                 
                                                WHERE BookingID ='$data[BookingID]'
                                                AND Status = 'ACTIVE'
                                                order by IDBookers ASC");        
                        $itable=mysql_fetch_array($dtable);    
                        $BookingID=mysql_query("SELECT * FROM tour_msbookingdetail                                                 
                        left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                        WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                        AND tour_msbooking.Status = 'ACTIVE'
                        AND tour_msbookingdetail.Status <> 'CANCEL'
                        AND tour_msbookingdetail.Package <> 'L.A Only' 
                        and tour_msbooking.BookingID='$data[BookingID]'
                        order by tour_msbooking.BookingID ASC,IDDetail ASC");
                        $jumlahBooking=mysql_num_rows($BookingID);
                        if($data[Gender]=='ADULT'){$gender='ADL';}
                        else if($data[Gender]=='CHILD'){$gender='CHD';}
                        else if($data[Gender]=='INFANT'){$gender='INF';}
                        if($data[PaxName]==''){$pax='TBA';}else{$pax=$data[PaxName];}
               echo "<tr><td>$nonya</td>";
                        if($lastbooking<>$data[BookingID]){echo"<td rowspan='$jumlahBooking' style=vertical-align:middle>$isi[Productcode] <br> $isi[TourCode]<br>$data[BookingID]</td>";}
                echo"<td>($gender) $data[Title] $pax</td>    
                        <td><center>$data[Deviasi]</td>";
                        if($lastbooking<>$data[BookingID]){echo"<td rowspan='$jumlahBooking' style=vertical-align:middle>$itable[BookersName] <br> $itable[BookersTelp] <br>$itable[BookersMobile]</td>";
                        echo"<td rowspan='$jumlahBooking' style=vertical-align:middle>$itable[TCName] <br>( $itable[TCDivision] ) </td>";
                        $lastbooking=$data[BookingID];}
                        
                        echo"<td>$data[PassportNo]</td>
                        <td>$data[BirthPlace]</td>
                        <td>$bdate</td>
                        <td>$data[PassportIssued]</td> 
                        <td>$pvalid</td>             
                     </tr> ";
                      $no++;
                      $nonya++;
                    }
            }
                    
    }           
    }  echo"</table><br><center><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('namelistgrv')>";
    break;

    case "roomchange":

        $ambil=mysql_query("SELECT tour_msproduct.IDProduct,tour_msproduct.TourCode,tour_msproduct.Year,TCDivision,tour_msbooking.BookingID,
                    tour_msproductcode.Productcode,tour_msproduct.DateTravelFrom,tour_msproduct.TourLeaderInc,tour_msproduct.TourLeader,
                    tour_msproduct.Flight,tour_msproduct.GroupType FROM tour_msproduct
                    left join tour_msbooking on tour_msbooking.IDTourcode = tour_msproduct.IDProduct
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode
                    WHERE tour_msproduct.IDProduct ='$_GET[code]'");
        $isi=mysql_fetch_array($ambil);

        // ini urutannya name list harus sesuai nomor kamar karena ada sharing sales yang bikin kacau nomor kamar
        $edit=mysql_query("SELECT tour_msbookingdetail.*,tour_msbooking.TotalRoom,CONVERT(RoomNo, UNSIGNED INTEGER) as urut FROM tour_msbookingdetail left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                    AND tour_msbooking.Status = 'ACTIVE'
                    AND tour_msbookingdetail.Status <> 'CANCEL'
                    order by urut,tour_msbooking.BookingID ASC,IDDetail ASC");
        $banyak=mysql_num_rows($edit);
        $roomnow='awal';
        $jumlah=mysql_num_rows($edit);
        $depdet = date("d M Y", strtotime($isi[DateTravelFrom]));

        if ($jumlah > 0) {
            echo "
            <form name='example' method='POST' action='./aksi.php?module=rptnamelist&act=changeroom' >
            <input type='hidden' name='banyak' value='$banyak'><input type='hidden' name='turkod' value='$isi[IDProduct]'>
            <font size=3><b>TOUR NAME : $isi[Productcode] - $isi[TourCode]</b></font></td></tr><tr><td style='border: 0px solid #000000; ' valign='top'; colspan='6'; >
            <table STYLE='border: 0px solid #000000'>
					<tr><th>NO</th><th>Booking ID</th><th>passanger's name</th><th >type</th><th>room no</th><th>new room</th></tr>";
            $no=1;
            $lastbooking='awal';
            while ($data=mysql_fetch_array($edit)){
                $dtable=mysql_query("SELECT * FROM tour_msbooking
                                                WHERE BookingID ='$data[BookingID]'
                                                AND Status = 'ACTIVE'
                                                order by IDBookers ASC");
                $itable=mysql_fetch_array($dtable);

                $BookingID=mysql_query("SELECT * FROM tour_msbookingdetail
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                    AND tour_msbooking.Status = 'ACTIVE'
                    AND tour_msbookingdetail.Status <> 'CANCEL'
                    and tour_msbooking.BookingID='$data[BookingID]'
                    order by tour_msbooking.BookingID ASC,IDDetail ASC");
                $jumlahBooking=mysql_num_rows($BookingID);
                if($data[PaxName]==''){$pax="TBA";}else{$pax="$data[PaxName]";}
                echo "<tr><td>$no<input type='hidden' name='iddetail$no' value='$data[IDDetail]'></td>";
                if($lastbooking<>$data[BookingID]){echo"<td rowspan='$jumlahBooking' style=vertical-align:middle><center>$data[BookingID]<br>($data[TotalRoom] Room)</center></td>";}
                echo"<td>$data[Title] $pax</td>";

                if($roomnow<>$data[RoomNo] or $lastbooking<>$data[BookingID] ){
                    $jenis='awal';
                    $totalroom=mysql_query("SELECT * FROM tour_msbookingdetail
                    WHERE BookingID='$data[BookingID]'
                    AND tour_msbookingdetail.Status <> 'CANCEL' and RoomNo='$data[RoomNo]' ");

                    $jumlahparty=mysql_num_rows($totalroom);
                    //gabungan jenis kamar
                    $typeroom=mysql_query("SELECT distinct RoomType FROM tour_msbookingdetail
              			      WHERE BookingID='$data[BookingID]'
                 			   AND tour_msbookingdetail.Status <> 'CANCEL' and RoomNo='$data[RoomNo]' ");
                    while ($dtyperoom=mysql_fetch_array($typeroom)){
                        if($dtyperoom[RoomType]=='Double'){$RoomType='DBL';}
                        else
                            if($dtyperoom[RoomType]=='Triple'){$RoomType='TRP';}
                            else
                                if($dtyperoom[RoomType]=='Twin'){$RoomType='TWN';}
                                else
                                {$RoomType=$dtyperoom[RoomType];}

                        if ($jenis=='awal')
                        {
                            $jenis=$RoomType;
                        }
                        else
                        {
                            $jenis=$jenis." + ".$RoomType;
                        }

                    }
                    if($jenis=='12 Pax'){$tipe='1-2 PAX';}
                    else if($jenis=='34 Pax'){$tipe='3-4 PAX';}
                    else if($jenis=='1 Pax'){$tipe='SINGLE';}
                    else{$tipe=$jenis;}
                    echo"<td rowspan='$jumlahparty' style=vertical-align:middle><center>$tipe</td>";
                    $roomnow=$data[RoomNo];}


                if($lastbooking<>$data[BookingID]){$lastbooking=$data[BookingID];}

                echo"<td><center>$data[urut]</td>
                     <td><center><input type='text' name='newroom$no' value='$data[urut]' size='2' required></td>
                     </tr> ";
                $no++;

            }echo"

                    </table><br><center><input type='submit' name='submit' value=Save></form>";
        }
    break;
}
?>
