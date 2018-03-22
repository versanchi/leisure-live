<script type="text/javascript"> 
function generateexcel(tableid) {
  var table= document.getElementById(tableid);
  var html = table.outerHTML;  
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));    
}  
</script>


<?php 
switch($_GET[act]){
  // Tampil Office
   default:
    $blnini = date("m");
    $thnini = date("Y");
    $mont=$_GET['bulan'];
    $yer=$_GET['year'];
	$Dest=$_GET['Destination'];
    if($mont==''){$mont=$blnini;}
    if($yer==''){$yer=$thnini;}
    if($Dest==''){$Dest='ALL';}
    echo "<h2>Group Schedule</h2>
          <form method='get' action='media.php?'><input type=hidden name=module value='rptgroupschdl'> ";       
              echo "Month &nbsp &nbsp &nbsp &nbsp:&nbsp<select name='bulan' >
					  <option value='01'";if($mont=='01'){echo"selected";}echo">JAN</option>
                      <option value='02'";if($mont=='02'){echo"selected";}echo">FEB</option>
					  <option value='03'";if($mont=='03'){echo"selected";}echo">MAR</option>
					  <option value='04'";if($mont=='04'){echo"selected";}echo">APR</option>
                      <option value='05'";if($mont=='05'){echo"selected";}echo">MAY</option>
					  <option value='06'";if($mont=='06'){echo"selected";}echo">JUN</option>
					  <option value='07'";if($mont=='07'){echo"selected";}echo">JUL</option>
                      <option value='08'";if($mont=='08'){echo"selected";}echo">AUG</option>
					  <option value='09'";if($mont=='09'){echo"selected";}echo">SEP</option>
					  <option value='10'";if($mont=='10'){echo"selected";}echo">OCT</option>
                      <option value='11'";if($mont=='11'){echo"selected";}echo">NOV</option>
					  <option value='12'";if($mont=='12'){echo"selected";}echo">DEC</option>
                      </select>
              &nbsp &nbsp Year    :  <select name='year' ><option value='0' >- Select Year -</option>";
            $tampil=mysql_query("SELECT Year FROM tour_msproduct where year <>'' group BY Year asc");
            while($s=mysql_fetch_array($tampil)){  // <input type='button' value='Cek Seat' onclick=ceking() >
               if($yer==$s[Year]){
                    echo "<option value='$s[Year]' selected>$s[Year]</option>";     
                }else { 
                echo "<option value='$s[Year]' >$s[Year]</option>";
                } 
            }
    echo "</select> <input type=submit name='submit' size='20'value='View'>
          </form>";
          $oke=$_GET['oke'];
		 
		 if($mont=='01'){$montText='JAN';}
         if($mont=='02'){$montText='FEB';}
		 if($mont=='03'){$montText='MAR';}
		 if($mont=='04'){$montText='APR';}
		 if($mont=='05'){$montText='MAY';}
		 if($mont=='06'){$montText='JUN';}
		 if($mont=='07'){$montText='JUL';}
		 if($mont=='08'){$montText='AUG';}
		 if($mont=='09'){$montText='SEP';}
		 if($mont=='10'){$montText='OCT';}
		 if($mont=='11'){$montText='NOV';}
 		 if($mont=='12'){$montText='DEC';}
	
	
                        
    //Mulai Table
	//Query tidak memunculkan tourcode yang kosong dan yang tidak terjual
	
	$QProduct=mysql_query("SELECT *, tour_msproductpnr.GrvID FROM tour_msproduct 
                            inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode 
                            left join tour_msproductpnr on tour_msproductpnr.PnrProd = tour_msproduct.IDProduct
                            where tour_msproduct.Status <> 'VOID' 
                            and month(DateTravelFrom)='$mont' 
                            and year(DateTravelFrom)='$yer' 
                            and TourCode<>'' and SeatDeposit>0 
                            order by TourCode ASC,DateTravelFrom asc");


	$TotalSeat=0;
	$TotalBooking=0;
	$TotalDum=0;
	
	
	$desbefore='awal';
	$PCbefore='awal';
	$PCbeforeTMR='awal';
	
	$Products=mysql_num_rows($QProduct);
	
	  if ($Products > 0){

	 $TPax=0;
	 $TSales=0;
	// Query bukan TMR
	 echo" <table id='GroupDep'>"; 	
echo "<tr><td colspan=15><h><B>Group Departure $montText - $yer </B></h></td></tr>
	<tr><th>No</th><th>Tour Code</th><th>Departure</th><th>By</th><th>ETD</th><th>Arrival</th><th>Flight</th><th>ETA</th><th>Pax</th><th>Pano Kids</th><th>Tour Leader</th></tr>"; 	
	$No=1; 
	
	 while($DProduct=mysql_fetch_array($QProduct)){
		 			
		        $DataDep=mysql_query("SELECT * FROM `tour_msprodflight` WHERE `IDGrv`='$DProduct[GrvID]' ORDER BY FID ASC limit 1");
                $DataArr=mysql_query("SELECT * FROM `tour_msprodflight` WHERE `IDGrv`='$DProduct[GrvID]' ORDER BY FID DESC limit 1");
                $DepData=mysql_fetch_array($DataDep);
                $ArrData=mysql_fetch_array($DataArr);
			        
	            $QBookingan=mysql_query("SELECT IDTourCode,sum(if(TCDivision<>'LTM' ,(AdultPax+ChildPax),0)) as pax,sum(if(TCDivision<>'LTM' ,(ChildPax+InfantPax),0)) as chd,sum(if(TCDivision='LTM' ,(AdultPax+ChildPax),0)) as DumPax 
                            FROM tour_msbooking 
                            WHERE tour_msbooking.Status ='ACTIVE' 
                            and  tour_msbooking.BookingStatus='DEPOSIT' 
                            and IDTourCode='$DProduct[IDProduct]'  
                            group by IDTourCode");     
				$Booking=mysql_num_rows($QBookingan);
				$DBooking=mysql_fetch_array($QBookingan);
				
				//LA only
				$QLA=mysql_query("SELECT * FROM tour_msbookingdetail where Bookingid in( Select Bookingid from tour_msbooking tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProduct[IDProduct]') and tour_msbookingdetail.status <>'CANCEL' and Package='L.A Only' ");
				$BookingLA=mysql_num_rows($QLA);	
			
				  //xxxxxxxxxxxxxxxxxx
						if($DBooking[pax]>0){
						//merubah format tampilan ke currency
						$Selling=number_format($DProduct[SellingAdlTwn], 0, ',', '.');
						$Tax=number_format($DProduct[TaxInsSell], 0, ',', '.');
						$depdate =strtoupper(date('d M', strtotime($DepData[AirDate])));  if($depdate=='01 JAN'){$depdate='';}else{$depdate="&nbsp$depdate&nbsp";}
                        $arrdate =strtoupper(date('d M', strtotime($ArrData[AirDate]))); if($arrdate=='01 JAN'){$arrdate='';}else{$arrdate="&nbsp$arrdate&nbsp";}
                        $D11=substr($DepData[AirTimeDep],0,2);$D12=substr($DepData[AirTimeDep],2,2);
                        $ATD = date('H.i', strtotime($DepData[AirTimeDep])); if($ATD=='07.00'){$ATD='';}else{$ATD="&nbsp$ATD&nbsp";}
                        $ATA = date('H.i', strtotime($ArrData[AirTimeArr])); if($ATA=='07.00'){$ATA='';}else{$ATA="&nbsp$ATA&nbsp";}
						
						//pewarnaan row kalau status close
						if(($DProduct[StatusProduct]=='CLOSE')){$warna="BGCOLOR='#f5bebe'";}else {$warna="BGCOLOR='#ffffff'";}
					 
						echo "
							<td $warna>$No</td>
							 <td $warna>$DProduct[TourCode]</td>   
							 <td $warna><center>$depdate</td>
                             <td $warna><center>$DepData[AirCode]</td>
                             <td $warna><center>$ATD</td>
                             <td $warna><center>$arrdate</td>
                             <td $warna><center>$ArrData[AirCode]</td>
                             <td $warna><center>$ATA</td>    	 
							 <td style='text-align:right' $warna><center>";   
						     if($DBooking[chd]==0){$chd="";}else{$chd=$DBooking[chd];}    
							 if($DBooking[pax]==0){echo"";}else{
							 	$Bookingan=	$DBooking[pax]-$BookingLA;   
								echo"$Bookingan";}
								 echo"</td><td $warna><center>$chd</td> 
                                 <td $warna><center>$DProduct[TourLeader]</td>";
								 $TotalSeat=$TotalSeat+$DProduct[Seat];
								 $TotalBooking=$TotalBooking+$Bookingan;
								  $Totalchd=$Totalchd+$DBooking[chd];  
								$No++;
							 echo"</tr>";};
							 
			
	};

				echo"<tr><td colspan=8><Center><b>Total</td>
					 <td><Center><b>$TotalBooking</td><td><Center><b>$Totalchd</td>";

	echo "</Table><br><center><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('GroupDep')>";
	}
	else
	
	{ echo "NO PRODUCT AVAILABLE IN $montText - $yer";
	} 
	   
    break;               
}
?>
