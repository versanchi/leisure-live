
<SCRIPT LANGUAGE="Javascript" SRC="FusionChartsXT/Code/FusionCharts/FusionCharts.js"></SCRIPT>
<?php
switch($_GET[act]){
  // Tampilan header
   default:
    $thnini = date("Y");
    $yer=$_GET['year'];
	
	$Rank=$_GET['RankAirlines'];
    if($yer==''){$yer=$thnini;}
    if($Rank==''){$Rank='10';}
    echo "<h2>Report by Airlines</h2>
			   	
    <form method='get' action='media.php?'><input type=hidden name=module value='rptyearairlines'>   
		      
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
	$Lastyear = $yer-1;	  
	echo "<h><u>Report Airlines Period  $Lastyear  VS  $yer </u></h><br>";	

//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
// DATA QUERY

  
		  if ($Rank=='ALL'){ 
	$Booking=mysql_query("SELECT Flight,sum(if(year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as TotalNow  FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision<>'LTM' group by Flight order by TotalNow desc");}else
	{
	$Booking=mysql_query("SELECT Flight, sum(if(year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as TotalNow  FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision<>'LTM' group by Flight order by TotalNow desc limit $Rank");}
	
	$JumBooking = mysql_num_rows($Booking);
	
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
	if ($JumBooking > 0){   
	echo "<table style='border: 0px solid #000000;'>
          <tr style='height:30px'>";

  //munculin table
	 $No=1;
	 $Total=0;
	
	 echo" <table>
			<tr><th rowspan=2 >No</th><th rowspan=2>Airlines</th><th colspan=3>JAN</th><th colspan=3>FEB</th><th colspan=3>MAR</th><th colspan=3>APR</th><th colspan=3>MAY</th><th colspan=3>JUN</th><th colspan=3>JUL</th><th colspan=3>AGT</th><th colspan=3>SEP</th><th colspan=3>OCT</th><th colspan=3>NOV</th><th colspan=3>DEC</th><th colspan=3>TOTAL</th></tr>
			<tr><th>$Lastyear</th><th>$yer</th><th>%</th><th>$Lastyear</th><th>$yer</th><th>%</th><th>$Lastyear</th><th>$yer</th><th>%</th><th>$Lastyear</th><th>$yer</th><th>%</th><th>$Lastyear</th><th>$yer</th><th>%</th><th>$Lastyear</th><th>$yer</th><th>%</th><th>$Lastyear</th><th>$yer</th><th>%</th><th>$Lastyear</th><th>$yer</th><th>%</th><th>$Lastyear</th><th>$yer</th><th>%</th><th>$Lastyear</th><th>$yer</th><th>%</th><th>$Lastyear</th><th>$yer</th><th>%</th><th>$Lastyear</th><th>$yer</th><th>%</th><th>$Lastyear</th><th>$yer</th><th>%</th>"; 
			
$Airline='';
while($DBooking=mysql_fetch_array($Booking)){
    echo "<tr>
			  <td>$No</td>
			 <td><center>$DBooking[Flight]</td>";
			 $TotalAirline=0;
			 $LastTotalAirline=0;
			 
	for ($i=1;$i<=12;$i++)
	{
	

				$strNow =mysql_query("SELECT Flight,sum(AdultPax+ChildPax) as Pax FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision<>'LTM' and Flight='$DBooking[Flight]' and year(DateTravelFrom)=$yer and month(DateTravelFrom)=$i");
				$strLast =mysql_query("SELECT Flight,sum(AdultPax+ChildPax) as Pax FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision<>'LTM' and Flight='$DBooking[Flight]' and year(DateTravelFrom)=$Lastyear and month(DateTravelFrom)=$i");
				
				$FlightTable = mysql_fetch_array($strNow);
				$LastFlightTable = mysql_fetch_array($strLast);
				if ($FlightTable[Pax]=='0'){$increase='0';}else {$increase=($FlightTable[Pax])/$LastFlightTable[Pax]*100;}
				if ($increase<100){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}
						
				echo"<td style='text-align:right'>".number_format($LastFlightTable[Pax], 0, ',', '.');echo"</td>
				<td style='text-align:right'>".number_format($FlightTable[Pax], 0, ',', '.');echo"</td>
				<td style='text-align:right;$warnaminus'>".number_format($increase, 0, ',', '.'); echo"% </td>";
				$TotalAirline=$TotalAirline+$FlightTable[Pax];
				$LastTotalAirline=$LastTotalAirline+$LastFlightTable[Pax];				
          }
		  
		echo"<td style='text-align:right'>".number_format($LastTotalAirline, 0, ',', '.');echo"</td>
				<td style='text-align:right'>".number_format($TotalAirline, 0, ',', '.');echo"</td>";
		if ($TotalAirline<$LastTotalAirline){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}		
		echo"<td style='text-align:right;$warnaminus'>".number_format(($TotalAirline/$LastTotalAirline*100), 0, ',', '.'); echo"% </td>";		
		echo"</tr>";
		if($No==1){$Airline="'".$DBooking[Flight];}else{$Airline=$Airline."','".$DBooking[Flight];}
		$No++;
		
		}
		//hitung total
		$Airline=$Airline."'";
		echo"<tr><td colspan=2;><center>TOTAL</td>";
		for ($i=1;$i<=12;$i++)
	{
	
		$TotalstrNow =mysql_query("SELECT sum(AdultPax+ChildPax) as Pax FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision<>'LTM' and year(DateTravelFrom)=$yer and month(DateTravelFrom)=$i and Flight in ($Airline)");
		$TotalstrLast =mysql_query("SELECT sum(AdultPax+ChildPax) as Pax FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision<>'LTM' and year(DateTravelFrom)=$Lastyear and month(DateTravelFrom)=$i and Flight in ($Airline)");
		
				$FlightTable = mysql_fetch_array($TotalstrNow);
				$LastFlightTable = mysql_fetch_array($TotalstrLast);
				if ($FlightTable[Pax]=='0'){$increase='0';}else {$increase=($FlightTable[Pax])/$LastFlightTable[Pax]*100;}
				if ($increase<100){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}
						
				echo"<td style='text-align:right'>".number_format($LastFlightTable[Pax], 0, ',', '.');echo"</td>
				<td style='text-align:right'>".number_format($FlightTable[Pax], 0, ',', '.');echo"</td>
				<td style='text-align:right;$warnaminus'>".number_format($increase, 0, ',', '.'); echo"% </td>";
				$TotalAirline=$TotalAirline+$FlightTable[Pax];
				$LastTotalAirline=$LastTotalAirline+$LastFlightTable[Pax];
				
          }
		echo"<td style='text-align:right'>".number_format($LastTotalAirline, 0, ',', '.');echo"</td>
				<td style='text-align:right'>".number_format($TotalAirline, 0, ',', '.');echo"</td>";
		if ($TotalAirline<$LastTotalAirline){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}		
		echo"<td style='text-align:right;$warnaminus'>".number_format(($TotalAirline/$LastTotalAirline*100), 0, ',', '.'); echo"% </td>";
		  
		echo"</tr>";
		echo "</table></tr></table>";
		}
		
	else	
	{ echo "NO TRANSACTION AVAILABLE IN $yer";
	} 
  
    break;   
	

 }        
?>
