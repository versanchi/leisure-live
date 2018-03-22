<SCRIPT LANGUAGE="Javascript" SRC="FusionChartsXT/Code/FusionCharts/FusionCharts.js"></SCRIPT>
<?php
include("FusionChartsXT/Code/PHP/Includes/FusionCharts.php");  
include("FusionChartsXT/Code/PHP/Includes/DBConn.php");
switch($_GET[act]){
  // Tampil Office
   default:
   	$CompanyID=$_SESSION['company_id'];
    $blnini = date("m");
    $thnini = date("Y");
    $mont=$_GET['bulan'];
    $yer=$_GET['year'];
	$Rank=$_GET['RankTC'];
	$Div=$_GET['Division'];
    if($mont==''){$mont=$blnini;}
    if($yer==''){$yer=$thnini;}
    if($Div==''){$Div='ALL';}
	if($Rank==''){$Rank='10';}
	$opnama=$_GET['opnama'];
    if($opnama==''){$opnama='DateTravelFrom';}     
	
   echo "<h2>Report by Travel Consultant </h2>
          <form method='get' action='media.php?'><input type=hidden name=module value='rpttc'>
		  Base ON : <select name='opnama'>          
    <option value='DateTravelFrom'";if($opnama=='DateTravelFrom'){echo"selected";}echo">Departure Date</option>
    <option value='BookingDate'";if($opnama=='BookingDate'){echo"selected";}echo">Booking Date</option>
    </select>
               Month &nbsp: <select name='bulan' >
			   		  <option value='00'";if($mont=='00'){echo"selected";}echo">ALL</option>
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
                     &nbsp;&nbsp;&nbsp;&nbsp;Year : <select name='year' ><option value='0' >- Select -</option>";
            $tampil=mysql_query("SELECT Year FROM tour_msproduct where year <>'' group BY Year asc");
            while($s=mysql_fetch_array($tampil)){  // <input type='button' value='Cek Seat' onclick=ceking() >
               if($yer==$s[Year]){
                    echo "<option value='$s[Year]' selected>$s[Year]</option>";     
                }else { 
                echo "<option value='$s[Year]' >$s[Year]</option>";
                } 
            }
    echo "</select>";
	 echo "<br>TC Level :<select name='RankTC'>
                      <option value='ALL'";if($Rank=='ALL'){echo"selected";}echo">ALL</option>
					  <option value='10'";if($Rank=='10'){echo"selected";}echo">TOP 10</option>
					  <option value='20'";if($Rank=='20'){echo"selected";}echo">TOP 20</option>
            </select>
			Division :<select name='Division'>	
			<option value='ALL'";if($Div=='ALL'){echo"selected";}echo">ALL</option>";
			$tampilDivision=mssql_query("select * from Divisi where Active=1 and CompanyID=$CompanyID order by DivisiID");
				while($sdiv=mssql_fetch_array($tampilDivision)){  // <input type='button' value='Cek Seat' onclick=ceking() >
               if($Div==$sdiv[DivisiID]){
                    echo "<option value='$sdiv[DivisiID]' selected>$sdiv[DivisiID]</option>";     
                }else { 
                echo "<option value='$sdiv[DivisiID]' >$sdiv[DivisiID]</option>";
                } 
            }
           echo"</select>
              <input type=submit name='submit' size='20'value='View'>
          </form>";
          $oke=$_GET['oke'];
	
		 if($mont=='01'){$montText='JAN';}
         elseif($mont=='02'){$montText='FEB';}
		 elseif($mont=='03'){$montText='MAR';}
		 elseif($mont=='04'){$montText='APR';}
		 elseif($mont=='05'){$montText='MAY';}
		 elseif($mont=='06'){$montText='JUN';}
		 elseif($mont=='07'){$montText='JUL';}
		 elseif($mont=='08'){$montText='AUG';}
		 elseif($mont=='09'){$montText='SEP';}
		 elseif($mont=='10'){$montText='OCT';}
		 elseif($mont=='11'){$montText='NOV';}
 		 elseif($mont=='12'){$montText='DES';}	 	
		 elseif($mont=='00'){$montText='ALL';} 	
	
	
		if($opnama=='DateTravelFrom'){

			$Baseon ="tour_msproduct.DateTravelFrom";
		}
		else
		{
			$Baseon ="tour_msbooking.BookingDate";

		}
		
	
	
	echo "<h><u>BEST TC PERFORMANCE -  $montText $yer </u></h><br>";	                          
 
 if($opnama=='DateTravelFrom'){
		 if($montText=='ALL')
		 {
			 $Destination=mysql_query("SELECT distinct Destination FROM tour_msproduct where tour_msproduct.Status <> 'VOID' and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' order by Destination desc");
		 }
		 else
		 {
			$Destination=mysql_query("SELECT distinct Destination FROM tour_msproduct where tour_msproduct.Status <> 'VOID' and  month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' order by Destination desc");
	 }
 }else
 {
	 if($montText=='ALL')
		 {
			 $Destination=mysql_query("SELECT distinct Destination FROM tour_msproduct where IDProduct  in(select IDTourcode from tour_msbooking where 			year(BookingDate)=$yer and TCCompanyID=$CompanyID)  and tour_msproduct.Status <> 'VOID' and tour_msproduct.TourCode<>'' order by Destination desc");
		 }
		 else
		 {
	 $Destination=mysql_query("SELECT distinct Destination FROM tour_msproduct where IDProduct  in(select IDTourcode from tour_msbooking where month(BookingDate)=$mont and year(BookingDate)=$yer and TCCompanyID=$CompanyID)  and tour_msproduct.Status <> 'VOID' and tour_msproduct.TourCode<>'' order by Destination desc");
		 }
 }
 
 $JumDDestination=mysql_num_rows($Destination);
 $loop=1;
 $QueryDest='';
 
 while($DDestination=mysql_fetch_array($Destination)){	
 		
 	 $QueryDest=$QueryDest."sum(if(Destination='$DDestination[Destination]' and tour_msbookingdetail.status<>'CANCEL' ,1,0)) as sum$loop";
	 $TDest[$loop]=$DDestination[Destination];
	 if ($loop<$JumDDestination){ 
	 		$QueryDest=$QueryDest.",";
			$loop++;}
  }
  
   if($montText=='ALL')
   {
	   
	   if ($Rank=='ALL'){
	//Query tidak memunculkan tourcode yang kosong dan yang tidak terjual
				if($Div=='ALL'){
				$Booking=mysql_query("
				SELECT TCName,TCDivision, (IDDetail) as Total,".$QueryDest.", sum((Subtotal+DevAmount+SeaTaxSell)*exrate+if((Package<>'LA only'and Gender<>
				'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exrate),0)) as Harga FROM tour_msbookingdetail inner join (select 																																									  				TCName,TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join 
				tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and 
				TCDivision<>'' and tour_msproduct.Status <> 'VOID' and year($Baseon)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and TCCompanyID=$CompanyID)tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID  where tour_msbookingdetail.status<>'CANCEL' group by 
				TCName,TCDivision order by Harga desc");
				}else{
				
				$Booking=mysql_query("
				SELECT TCName,TCDivision, count(IDDetail) as Total,".$QueryDest.", sum((Subtotal+DevAmount+SeaTaxSell)*exrate+if((Package<>'LA only'and Gender
				<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exrate),0)) as Harga  FROM tour_msbookingdetail inner join (select 																																																	TCName,TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT' and Dummy='NO' and tour_msproduct.Status <> 'VOID' and year($Baseon)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision='$Div')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by TCName,TCDivision order by Harga desc");	
				}
	}else
				{
				if($Div=='ALL'){
				$Booking=mysql_query("
				SELECT TCName,TCDivision, count(IDDetail) as Total,".$QueryDest.", sum((Subtotal+DevAmount+SeaTaxSell)*exrate+if((Package<>'LA only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exrate),0)) as Harga FROM tour_msbookingdetail inner join (select TCDivision,BookingID,TCName,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and year($Baseon)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and TCCompanyID=$CompanyID)tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by TCName,TCDivision order by Harga desc limit $Rank");
				
				}else{
				$Booking=mysql_query("
				SELECT TCName,TCDivision, count(IDDetail) as Total,".$QueryDest.", sum((Subtotal+DevAmount+SeaTaxSell)*exrate+if((Package<>'LA only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exrate),0)) as Harga  FROM tour_msbookingdetail inner join (select TCName,TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and year($Baseon)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and TCDivision='$Div')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL' group by TCName,TCDivision order by Harga desc limit $Rank");
				
				}
				}
				
   }
   else
   {
  
			if ($Rank=='ALL'){
			//Query tidak memunculkan tourcode yang kosong dan yang tidak terjual
					if($Div=='ALL'){
					$Booking=mysql_query("
					SELECT TCName,TCDivision, (IDDetail) as Total,".$QueryDest.", sum((Subtotal+DevAmount+SeaTaxSell)*exrate+if((Package<>'LA only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exrate),0)) as Harga FROM tour_msbookingdetail inner join (select TCName,TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and month($Baseon)=$mont and year($Baseon)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO'  and TCCompanyID=$CompanyID)tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID  where tour_msbookingdetail.status<>'CANCEL' group by TCName,TCDivision order by Harga desc");
					}else{
					
					$Booking=mysql_query("
					SELECT TCName,TCDivision, count(IDDetail) as Total,".$QueryDest.", sum((Subtotal+DevAmount+SeaTaxSell)*exrate+if((Package<>'LA only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exrate),0)) as Harga  FROM tour_msbookingdetail inner join (select TCName,TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and month($Baseon)=$mont and year($Baseon)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and TCDivision='$Div')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by TCName,TCDivision order by Harga desc");	
					}
			}else
			{
					if($Div=='ALL'){
					$Booking=mysql_query("
					SELECT TCName,TCDivision, count(IDDetail) as Total,".$QueryDest.", sum((Subtotal+DevAmount+SeaTaxSell)*exrate+if((Package<>'LA only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exrate),0)) as Harga FROM tour_msbookingdetail inner join (select TCDivision,BookingID,TCName,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and month($Baseon)=$mont and year($Baseon)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO'  and TCCompanyID=$CompanyID)tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by TCName,TCDivision order by Harga desc limit $Rank");
					
					}else{
					$Booking=mysql_query("
					SELECT TCName,TCDivision, count(IDDetail) as Total,".$QueryDest.", sum((Subtotal+DevAmount+SeaTaxSell)*exrate+if((Package<>'LA only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exrate),0)) as Harga  FROM tour_msbookingdetail inner join (select TCName,TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and month($Baseon)=$mont and year($Baseon)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and TCDivision='$Div')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL' group by TCName,TCDivision order by Harga desc limit $Rank");
					
					}
			}
		   
   }

	$JumBooking=mysql_num_rows($Booking);
		
	if ($JumBooking > 0){
	 
     $No=1;  
	 $TotalPax=0;
	
	
	
		 echo" <table>
				<tr><th>No</th><th>TC Name</th><th>Division</th>";
		 for ($i = 1; $i <= $JumDDestination; $i++) {
				echo "<th>$TDest[$i]</th>";
				$JumTotal[$TDest[$i]]=0;
			}
		
	echo"<th>Total</th><th>Amount</th></tr>"; 
	
$TotalALL=0;
$TotalHarga=0;


	
while($DBooking=mysql_fetch_array($Booking)){
	$TotalTC=0;
		//$Harga=0;
		//$Harga=($DBooking[HargaUSD]*$rate[$montText])+$DBooking[HargaIDR];		
	echo "<tr>
			  <td >$No</td>
			 <td >$DBooking[TCName]</td>
             <td >$DBooking[TCDivision]</td>";
			for ($i = 1; $i <= $JumDDestination; $i++) {
					$dest='sum'.$i;
    				echo "<td align='right'>$DBooking[$dest]</td>";
					
					$JumTotal[$dest]=$JumTotal[$dest]+$DBooking[$dest];
					$TotalTC=$TotalTC+$DBooking[$dest];
				}
			 echo"<td align='right'>$TotalTC</td><td align='right'>".number_format($DBooking[Harga],2,',','.')."</td></tr>";
			 
	    $TotalALL = $TotalALL + $TotalTC;
		$TotalHarga=$TotalHarga+$DBooking[Harga];
		
		$No++;
	}
		
		}
			
			echo "<tr><td colspan=3><center><b>Total</td>";
				for ($i = 1; $i <= $JumDDestination; $i++) {
				$dest='sum'.$i;
				echo "<td align='right'><b>$JumTotal[$dest]</td>";}
				echo"<td align='right'><b>$TotalALL</td><td>".number_format($TotalHarga,2,',','.')."</td></tr>
					</table><br>";
	  
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
 // untuk create grafik pie
		          
	$link = connectToDB();
   //$strXML will be used to store the entire XML document generated
   //Generate the chart element
     $strXML = "<chart caption='TC Performance'  yAxisName='Pax' numbersuffix=' Pax' showValues='0'>";
   //Fetch all factory records

     $strQuery = "SELECT  Destination,sum(AdultPax+ChildPax+InfantPax) as Total  FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and (TCCompanyID=$CompanyID or CompanyID=$CompanyID) group by Destination";
     
	 if ($Rank=='ALL'){
	//Query tidak memunculkan tourcode yang kosong dan yang tidak terjual
	if($Div=='ALL'){
	$strQuery="SELECT TCName,TCDivision, count(IDDetail) as Total,".$QueryDest." FROM tour_msbookingdetail inner join (select TCDivision,BookingID,TCName,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and TCCompanyID=$CompanyID)tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by TCName,TCDivision order by Total desc";}else{
	$strQuery="SELECT TCName,TCDivision, count(IDDetail) as Total,".$QueryDest." FROM tour_msbookingdetail inner join (select TCDivision,BookingID,TCName,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>''and TCDivision='$Div' and Seat<>SeatSisa and Dummy='NO')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by TCName,TCDivision order by Total desc";
	}
    }else
	{
	if($Div=='ALL'){
	$strQuery="SELECT TCName,TCDivision, count(IDDetail) as Total,".$QueryDest." FROM tour_msbookingdetail inner join (select TCDivision,BookingID,TCName,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and TCCompanyID=$CompanyID)tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by TCName,TCDivision order by Total desc limit $Rank";}else{
	$strQuery="SELECT TCName,TCDivision, count(IDDetail) as Total,".$QueryDest." FROM tour_msbookingdetail inner join (select TCDivision,BookingID,TCName,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>''and TCDivision='$Div' and Seat<>SeatSisa  and Dummy='NO')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by TCName,TCDivision order by Total desc limit $Rank";
	}
	}
	 
	 $result = mysql_query($strQuery) or die(mysql_error());
	
   //Iterate through each factory
       if ($result) {
          while($ors = mysql_fetch_array($result)) {
          //Now create a second query to get details for this factory
           
          //Generate <set label='..' value='..'/>
           $strXML .= "<set label='" . $ors['TCName'] . "' value='" . $ors['Total'] . "' />";
          //free the resultset
           
          }
		  mysql_free_result($result);
     }

          //mysql_close($link);
           //Finally, close <chart> element
           $strXML .= "</chart>";
           //Create the chart - Pie 3D Chart with data from $strXML
           echo renderChart("FusionChartsXT/Code/FusionCharts/Column3D.swf","", $strXML, "FactorySum", 500, 300, false, true);
    
?>
<?php
echo"<center><input type=button value=Close onclick=self.history.back()><br><br>"; 
     break;    
}
?>
