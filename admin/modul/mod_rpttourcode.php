<?php 
switch($_GET[act]){
  // Tampil Office
   default:
   	$CompanyID=$_SESSION['company_id'];
    $blnini = date("m");
    $thnini = date("Y");
    $mont=$_GET['bulan'];
    $yer=$_GET['year'];
	$Dest=$_GET['Destination'];
    $grup=$_GET['grup']; 
    if($mont==''){$mont=$blnini;}
    if($yer==''){$yer=$thnini;}
    if($Dest==''){$Dest='ALL';}
    echo "<h2>Report by Tour Code</h2>
          <form method='get' action='media.php?'><input type=hidden name=module value='rpttourcode'> ";       
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
    echo "</select> <br>";
	 echo "<br>Destination :  <select name='Destination' id='Destination'>";  
           
			$tampilDest=mysql_query("SELECT distinct Destination FROM  tour_msproduct where destination<>'' and destination<>'0' order by Destination ASC"); 
							  echo "<option value='ALL'>ALL</option>";  
            while($sDest=mysql_fetch_array($tampilDest)){
				if ($Dest==$sDest[Destination]){
                        echo "<option value='$sDest[Destination]' selected>$sDest[Destination]</option>";
						}
				else {
						echo "<option value='$sDest[Destination]'>$sDest[Destination]</option>";}
				
            }
    echo "</select>
              <input type=submit name='submit' size='20'value='View'>
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
 		 if($mont=='12'){$montText='DES';}
	
	
	echo "<h><B>Group Departure $montText - $yer </B></h><br>";	                          
    
	//Query tidak memunculkan tourcode yang kosong dan yang tidak terjual
	if($Dest=='ALL'){
	$QProduct=mysql_query("SELECT * FROM `tour_msproduct` where Status <> 'VOID' and month(DateTravelFrom)=$mont and Year(DateTravelFrom)=$yer and TourCode<>'' and Seat<>SeatSisa and CompanyID=$CompanyID order by Destination,GroupType,SeatDeposit desc");}else{
	$QProduct=mysql_query("SELECT * FROM `tour_msproduct` where Status <> 'VOID' and month(DateTravelFrom)=$mont and Year(DateTravelFrom)=$yer and TourCode<>'' and Seat<>SeatSisa and Destination='$Dest' and CompanyID=$CompanyID  order by Destination,GroupType,SeatDeposit desc");}
	
	$Products=mysql_num_rows($QProduct);
	
	if ($Products > 0){
	 $No=1;
	 $TPax=0;
	 $TSales=0;
	
	 echo" <table>
	 		<tr><th>No</th><th>Destination</th><th>Tour Code</th><th>Airlines</th><th>Department</th><th>Departure</th><th>Tour Leader</th><th>Pax</th><th>Adult Price</th><th>Tax</th><th>Total Sales</th></tr>";
	
		while($DProduct=mysql_fetch_array($QProduct)){
		    
			if($DProduct[ProductFor]=='ALL'){$Dep=$DProduct[Department];}else{$Dep=$DProduct[ProductFor];}	 
	    
		$QBookingan=mysql_query("SELECT count(IDDetail) as Pax, sum((Subtotal+DevAmount+SeaTaxSell)*exrate+if((Package<>'LA only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exrate),0)) as Total FROM tour_msbookingdetail inner join  tour_msproduct on tour_msproduct.IDProduct=tour_msbookingdetail.IDTourcode  and tour_msbookingdetail.IDTourCode='$DProduct[IDProduct]'  where bookingid in(select BookingID from tour_msbooking  where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and Seat<>SeatSisa and IDTourCode='$DProduct[IDProduct]' and Dummy='NO' and (CompanyID=$CompanyID or TCCompanyID=$CompanyID)  ) and  tour_msbookingdetail.status<>'CANCEL' group by tour_msbookingdetail.TourCode order by Total");
		
	
		$Booking=mysql_num_rows($QBookingan);
		$DBooking=mysql_fetch_array($QBookingan);
	
		$QBookinganD=mysql_query("SELECT sum(if((Package='LA only' and tour_msbookingdetail.status<>'CANCEL'),1,0)) as LA  FROM tour_msbookingdetail WHERE tour_msbookingdetail.status<>'CANCEL' and BookingID in (select BookingID from tour_msbooking where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT' and IDTourcode=$DProduct[IDProduct]) ");
		$DBookingD=mysql_fetch_array($QBookinganD);
		

		if ($Booking > 0 ){
		
		//merubah format tampilan ke currency
		$Selling=number_format($DProduct[SellingAdlTwn], 0, ',', '.');
		$Tax=number_format($DProduct[TaxInsSell], 0, ',', '.');
				
		echo "<tr>
			  <td>$No</td>
             <td>$DProduct[Destination]</td>
             <td>$DProduct[TourCode]</td>
             <td><center>$DProduct[Flight]</td>
             <td><center>$Dep</td>
             <td><center>".date('d M Y',strtotime($DProduct[DateTravelFrom]))."</td>
			 <td><center>$DProduct[TourLeader]</td>
			 <td style='text-align:right'>";
			 if($DBooking[Pax]=='0'){echo"$DBooking[Pax]";}else{echo"
                     <a href=?module=group&act=showdeposit&id=$DProduct[IDProduct]>$DBooking[Pax]</a>";}
			 echo"</td>
			 <td style='text-align:right'>$Selling</td>
 			 <td style='text-align:right'>$Tax</td>
			 <td style='text-align:right'>".number_format($DBooking[Total], 0, ',', '.')."</td>
			 </tr>";
		$No++;
		$TPax=$TPax+$DBooking[Pax];
		$TSales=$TSales+$DBooking[Total];
		
		};
		
	};
	$TotalPax=number_format($TPax, 0, ',', '.');
	$TotalSales=number_format($TSales, 0, ',', '.');
	echo "<tr><th colspan=7><center>Total</th><th>$TotalPax</th><th></th><th></th><th style='text-align:right'>$TotalSales</th></tr>";
	echo "</Table>";	
	
	} 
	
	else
	
	{ echo "NO PRODUCT AVAILABLE IN $montText - $yer";
	} 
	   
    break;               
}
?>
