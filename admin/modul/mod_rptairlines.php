
<SCRIPT LANGUAGE="Javascript" SRC="FusionChartsXT/Code/FusionCharts/FusionCharts.js"></SCRIPT>
<?php
include("FusionChartsXT/Code/PHP/Includes/FusionCharts.php");  
include("FusionChartsXT/Code/PHP/Includes/DBConn.php");
switch($_GET[act]){
  // Tampilan header
   default:
   	$CompanyID=$_SESSION['company_id'];
    $blnini = date("m");
    $thnini = date("Y");
    $mont=$_GET['bulan'];
    $yer=$_GET['year'];
	$Rank=$_GET['RankAirlines'];
    if($mont==''){$mont=$blnini;}
    if($yer==''){$yer=$thnini;}
    if($Rank==''){$Rank='10';}
    echo "<h2>Report by Airlines</h2>
				
          <form method='get' action='media.php?'><input type=hidden name=module value='rptairlines'>   
		       
               Month &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<select name='bulan' >
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
              Year <select name='year' ><option value='0' >- Select Year -</option>";
            $tampil=mysql_query("SELECT Year FROM tour_msproduct where year <>'' group BY Year asc");
            while($s=mysql_fetch_array($tampil)){  // <input type='button' value='Cek Seat' onclick=ceking() >
               if($yer==$s[Year]){
                    echo "<option value='$s[Year]' selected>$s[Year]</option>";     
                }else { 
                echo "<option value='$s[Year]' >$s[Year]</option>";
                } 
            }
    echo "</select>";
	 echo "<br>Airlines Level :<select name='RankAirlines'>
                      <option value='ALL'";if($Rank=='ALL'){echo"selected";}echo">ALL</option>
					  <option value='10'";if($Rank=='10'){echo"selected";}echo">TOP 10</option>
					  <option value='20'";if($Rank=='20'){echo"selected";}echo">TOP 20</option>
            </select>
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
 		 elseif($mont=='12'){$montText='DEC';}
		  
	echo "<h><u>Sales $Div Period $montText - $yer </u></h><br>";	   
	echo "<table style='border: 0px solid #000000;'>
          <tr><td style='border: 0px solid #000000; width: 50%'>";
	         
		  //xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx   // untuk create grafik
		          

	$link = connectToDB();
   //$strXML will be used to store the entire XML document generated
   //Generate the chart element
     $strXML = "<chart caption='Airlines report' subCaption='By Pax' pieSliceDepth='30' showBorder='1' formatNumberScale='0' numberSuffix=' pax'>";
   //Fetch all factory records

     $strQuery = "SELECT  distinct Flight,sum(AdultPax+ChildPax+InfantPax) as Total FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and  tour_msproduct.CompanyID=$CompanyID group by Flight order by Total desc limit 10";
     $result = mysql_query($strQuery) or die(mysql_error());
	 $totaltop=0;
   //Iterate through each factory
       if ($result) {
          while($ors = mysql_fetch_array($result)) {
          //Now create a second query to get details for this factory
           $strQuery = "SELECT Flight,sum(AdultPax+ChildPax+InfantPax) as Total  FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and  Dummy='NO' and  tour_msproduct.CompanyID=$CompanyID  and Flight='". $ors['Flight'] ."'group by Flight";
           $result2 = mysql_query($strQuery) or die(mysql_error()); 
           $ors2 = mysql_fetch_array($result2); 
          //Generate <set label='..' value='..'/>
           $strXML .= "<set label='" . $ors['Flight'] . "' value='" . $ors2['Total'] . "' />";
          //free the resultset
           mysql_free_result($result2);
		   $totaltop=$totaltop +$ors2['Total'];
          }
     }
?>
<?php
	 $strQuerytotal =mysql_query("SELECT sum(AdultPax+ChildPax+InfantPax) as TotalAll  FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and  Dummy='NO' and  tour_msproduct.CompanyID=$CompanyID ");
$orsAll = mysql_fetch_array($strQuerytotal);
$OtherAir=$orsAll[TotalAll]-$totaltop;
?>
<?php
$strXML .= "<set label='Others' value= '$OtherAir' />";
          //mysql_close($link);
           //Finally, close <chart> element
           $strXML .= "</chart>";
           //Create the chart - Pie 3D Chart with data from $strXML
           echo renderChart("FusionChartsXT/Code/FusionCharts/Pie3D.swf", "", $strXML, "FactorySum", 500, 400, false, true);
		   
      //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
echo"</td> <td style='border: 0px solid #000000'><center>";
         //munculin table

		  if ($Rank=='ALL'){ 
	$Booking=mysql_query("SELECT GrvAirlines as Flight,sum(AdultPax+ChildPax+InfantPax) as Total, sum((AdultPax*(GrvAdlFare+GrvFuelSurcharge+GrvTax))+(ChildPax*(GrvChdFare+GrvFuelSurcharge+GrvTax))+(InfantPax*GrvInfFare)) as Harga FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode)  inner join `tour_msproductpnr` on tour_msproductpnr.pnrprod=tour_msproduct.IDProduct
INNER JOIN tour_msgrv  on tour_msproductpnr.grvid=tour_msgrv.idgrv where tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and  Dummy='NO' and  tour_msproduct.CompanyID=$CompanyID  group by Flight order by Total desc");}else
	{
	$Booking=mysql_query("SELECT GrvAirlines as Flight, sum(AdultPax+ChildPax+InfantPax) as Total , sum((AdultPax*(GrvAdlFare+GrvFuelSurcharge+GrvTax))+(ChildPax*(GrvChdFare+GrvFuelSurcharge+GrvTax))+(InfantPax*GrvInfFare)) as Harga FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode)  inner join `tour_msproductpnr` on tour_msproductpnr.pnrprod=tour_msproduct.IDProduct
INNER JOIN tour_msgrv  on tour_msproductpnr.grvid=tour_msgrv.idgrv where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and  Dummy='NO' and  tour_msproduct.CompanyID=$CompanyID  group by Flight order by Total desc limit $Rank");}
	
	$JumBooking = mysql_num_rows($Booking);
?>	
<?php
	if ($JumBooking > 0){

	 $No=1;
	 $Total=0;
	 $TotalHarga=0;
	
	 echo" <table>
	 		<tr><th>No</th><th>Airlines</th><th>Pax</th><th>Amount</th></tr>"; 

		while($DBooking=mysql_fetch_array($Booking)){		
	
		echo "<tr>
			  <td>$No</td>
			 <td><center>$DBooking[Flight]</td>
			 <td style='text-align:right'>";
			 $TampilTotal=number_format($DBooking[Total], 0, ',', '.');
			 if($DBooking[Total]=='0'){echo"$TampilTotal </tr>";}else{echo"
           <a href=?module=rptairlines&act=dtlAirlines&Flight=$DBooking[Flight]&Bln=$mont&thn=$yer>$TampilTotal</a>
		   <td style='text-align:right'>".number_format($DBooking[Harga], 0, ',', '.')."</td>
		   </tr>";}
		$No++;
		$Total=$Total+$DBooking[Total];
		$TotalHarga=$TotalHarga+$DBooking[Harga];

		};
	$BookingAll=mysql_query("SELECT  sum(AdultPax+ChildPax+InfantPax) as Total  , sum((AdultPax*(GrvAdlFare+GrvFuelSurcharge+GrvTax))+(ChildPax*(GrvChdFare+GrvFuelSurcharge+GrvTax))+(InfantPax*GrvInfFare)) as Harga FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode)  inner join `tour_msproductpnr` on tour_msproductpnr.pnrprod=tour_msproduct.IDProduct
INNER JOIN tour_msgrv  on tour_msproductpnr.grvid=tour_msgrv.idgrv where tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and  Dummy='NO' and  tour_msproduct.CompanyID=$CompanyID ");
	$AllAir=mysql_fetch_array($BookingAll);
	
	if($AllAir[Harga] <$TotalHarga )
	{
		$harga=0;
	}
	else
	{
		$harga=$AllAir[Harga]-$TotalHarga;
	}
	
	echo "<tr>
			  <td>$No</td>
			 <td><center>Others</td>
			 <td style='text-align:right'>".number_format(($AllAir[Total]-$Total), 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format(($harga), 0, ',', '.');echo"</td>
		   </tr>";
	
			
	echo "<tr><th colspan=2>Total</th><th>".number_format($AllAir[Total], 0, ',', '.');echo"</th><th></th></tr>
	</table>";
	} 
	else	
	{ echo "NO TRANSACTION AVAILABLE IN $montText - $yer";
	} 
  
	 echo"<br/></td></tr></table>";

    break;   
	
	
	case "dtlAirlines":   
	$CompanyID=$_SESSION['company_id'];
    $kriet=mysql_query("SELECT TCDivision,tour_msproduct.TourCode as Tourcode,tour_msproduct.Producttype as Producttype,GrvAirlines as Flight,Destination,tour_msproduct.SellingCurr,sum(AdultPax+ChildPax+InfantPax) as Total ,GrvPnr,(GrvAdlFare+GrvFuelSurcharge+GrvTax) as AdultPrice, sum((AdultPax*(GrvAdlFare+GrvFuelSurcharge+GrvTax))+(ChildPax*(GrvChdFare+GrvFuelSurcharge+GrvTax))+(InfantPax*GrvInfFare)) as Harga FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode)  inner join `tour_msproductpnr` on tour_msproductpnr.pnrprod=tour_msproduct.IDProduct
INNER JOIN tour_msgrv  on tour_msproductpnr.grvid=tour_msgrv.idgrv where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and month(DateTravelFrom)='$_GET[Bln]' and year(DateTravelFrom)='$_GET[thn]' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and GrvAirlines='$_GET[Flight]' and  Dummy='NO' and  tour_msproduct.CompanyID=$CompanyID  group by GrvAirlines,Destination,tour_msproduct.TourCode order by Destination,Total desc");


			 $no=1;
			 $Total=0;
						
			if($_GET[Bln]=='01'){$montText='JAN';}
         elseif($_GET[Bln]=='02'){$montText='FEB';}
		 elseif($_GET[Bln]=='03'){$montText='MAR';}
		 elseif($_GET[Bln]=='04'){$montText='APR';}
		 elseif($_GET[Bln]=='05'){$montText='MAY';}
		 elseif($_GET[Bln]=='06'){$montText='JUN';}
		 elseif($_GET[Bln]=='07'){$montText='JUL';}
		 elseif($_GET[Bln]=='08'){$montText='AUG';}
		 elseif($_GET[Bln]=='09'){$montText='SEP';}
		 elseif($_GET[Bln]=='10'){$montText='OCT';}
		 elseif($_GET[Bln]=='11'){$montText='NOV';}
 		 elseif($_GET[Bln]=='12'){$montText='DEC';}
		
		$Destination='awal';
		$TotalDestination=0;
			while($sow=mysql_fetch_array($kriet)){   
	if ($no==1){
	echo"$sow[Flight] - $montText &nbsp; $_GET[thn]
			<table>
			<tr><th>No</th><th>Destination</th><th>Tour Code</th><th>PNR</th><th>Product Type</th><th>Adult Price</th><th>Pax</th><th>Amount</th></tr>"; }
				if($Destination!='awal' && $Destination !=$sow[Destination])
				{
					echo"<tr><th colspan=6>Total $Destination</th><th>".number_format($TotalDestination, 0, ',', '.');echo"</th>
						<th></th>
						</tr><tr><td colspan=6></td></tr>";
						$TotalDestination=0;
				}
				
				     echo"              
                     <tr>                                   
                     <td>$no</td>
					 <td>$sow[Destination]</td>
  					 <td>$sow[Tourcode]</td> 
 					 <td>$sow[GrvPnr]</td> 
					 <td>$sow[Producttype]</td> 
					 <td style='text-align:right'>".number_format($sow[AdultPrice], 0, ',', '.');echo"</td> 
   					 <td style='text-align:right'>".number_format($sow[Total], 0, ',', '.');echo"</td> 
					 <td style='text-align:right'>".number_format($sow[Harga], 0, ',', '.');echo"</td> 
                     </tr>";
                      $no++;
					  	$TotalDestination=$TotalDestination+$sow[Total];
						$Total=$Total+$sow[Total];
						$TotalHarga=$TotalHarga+$sow[TotalHarga];
						$Destination=$sow[Destination];
                    };
			
			echo"<tr><th colspan=6>Total $Destination</th><th>".number_format($TotalDestination, 0, ',', '.');echo"</th>
						<th></th>
						</tr><tr><td colspan=7></td></tr>
						<tr><th colspan=6>GrandTotal</th><th>".number_format($Total, 0, ',', '.');echo"</th>
			<th></th>
			</tr>";
					echo "</table><br>";
		 echo "<center><input type=button value=Close onclick=self.history.back()><br><br>"; 
		  break;

//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

 }        
?>
