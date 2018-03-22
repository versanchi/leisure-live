
<SCRIPT LANGUAGE="Javascript" SRC="FusionChartsXT/Code/FusionCharts/FusionCharts.js"></SCRIPT>
<?php
include("FusionChartsXT/Code/PHP/Includes/FusionCharts.php");  
include("FusionChartsXT/Code/PHP/Includes/DBConn.php");
switch($_GET[act]){
  // Tampilan header
   default:
    $thnini = date("Y");
    $yer=$_GET['year'];
    if($yer==''){$yer=$thnini;}
    
    echo "<h2>Report by Destination</h2>
			   	
    <form method='get' action='media.php?'><input type=hidden name=module value='rptyeardest'>   
		      
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
	 echo "<input type=submit name='submit' size='20'value='View'>
          </form>";
          $oke=$_GET['oke'];	
	$Lastyear = $yer-1;	  
	echo "<h><u>Report Destination Period  $Lastyear  VS  $yer </u></h><br>";	

//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
// DATA QUERY

	$Booking=mysql_query("SELECT Destination,sum(if(year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as TotalNow  FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.TourCode<>'' and Seat<>SeatSisa group by Destination order by Destination desc");
	
	$JumBooking = mysql_num_rows($Booking);
	
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
	if ($JumBooking > 0){   
	echo "<table style='border: 0px solid #000000;'>
          <tr style='height:30px'><td style='border: 0px solid #000000; width: 25%'>";
	         
		  
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
 // untuk create grafik pie
		          
	$link = connectToDB();
   //$strXML will be used to store the entire XML document generated
   //Generate the chart element
     $strXML = "<chart caption='Revenue by Destination'  yAxisName='Pax' numbersuffix=' Pax' showValues='0'>";
   //Fetch all factory records

     $strQuery = "SELECT  Destination,sum(AdultPax+ChildPax) as Total  FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa group by Destination";
     $result = mysql_query($strQuery) or die(mysql_error());
	
   //Iterate through each factory
       if ($result) {
          while($ors = mysql_fetch_array($result)) {
          //Now create a second query to get details for this factory
           
          //Generate <set label='..' value='..'/>
           $strXML .= "<set label='" . $ors['Destination'] . "' value='" . $ors['Total'] . "' />";
          //free the resultset
           
          }
		  mysql_free_result($result);
     }

          //mysql_close($link);
           //Finally, close <chart> element
           $strXML .= "</chart>";
           //Create the chart - Pie 3D Chart with data from $strXML
           echo renderChart("FusionChartsXT/Code/FusionCharts/Column3D.swf","", $strXML, "FactorySum", 500, 300, false, true);
    
	  
echo"</td>";
?>
<?php
  //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX	
// Bar graph

echo"<td style='border: 0px solid #000000' >";

$link = connectToDB();

$strXMLLine = "<chart caption='Destination Report - $yer' xAxisName='Month' yAxisName='Pax' showValues='0' >";


	  $strXMLLine .="<categories>";
      $strXMLLine .="<category label='Jan' />";
      $strXMLLine .="<category label='Feb' />";
      $strXMLLine .="<category label='Mar' />";
      $strXMLLine .="<category label='Apr' />";
      $strXMLLine .="<category label='May' />";
      $strXMLLine .="<category label='Jun' />";
      $strXMLLine .="<category label='Jul' />";
      $strXMLLine .="<category label='Aug' />";
      $strXMLLine .="<category label='Sep' />";
      $strXMLLine .="<category label='Oct' />";
      $strXMLLine .="<category label='Nov' />";
      $strXMLLine .="<category label='Dec' />";
      $strXMLLine .="</categories>";

 $strQueryb = "SELECT  distinct Destination,sum(AdultPax+ChildPax) as Total  FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa group by Destination ";
     $resultb = mysql_query($strQueryb) or die(mysql_error());
	 
if ($resultb) {
          while($orsLine = mysql_fetch_array($resultb)) {
          //Now create a second query to get details for this factory
           $strQueryLine = "SELECT Destination,sum(if(month(DateTravelFrom)=1 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NJan, sum(if(month(DateTravelFrom)=2 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NFeb,sum(if(month(DateTravelFrom)=3 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NMar,sum(if(month(DateTravelFrom)=4 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NApr,sum(if(month(DateTravelFrom)=5 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NMay,sum(if(month(DateTravelFrom)=6 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NJun,sum(if(month(DateTravelFrom)=7 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NJul,sum(if(month(DateTravelFrom)=8 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NAgt,sum(if(month(DateTravelFrom)=9 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NSep,sum(if(month(DateTravelFrom)=10 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NOct,sum(if(month(DateTravelFrom)=11 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NNov,sum(if(month(DateTravelFrom)=12 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NDec FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and year(DateTravelFrom)=$yer  and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Destination='". $orsLine['Destination'] ."' group by Destination";
           
		   $result2Line = mysql_query($strQueryLine) or die(mysql_error()); 
           $ors2Line = mysql_fetch_array($result2Line); 
          //Generate <set label='..' value='..'/>
 

           $strXMLLine .="<dataset seriesName='". $ors2Line['Destination']."'>";
	       $strXMLLine .="<set value='" . $ors2Line['NJan'] . "' />";
		   $strXMLLine .="<set value='" . $ors2Line['NFeb'] . "' />";
		   $strXMLLine .="<set value='" . $ors2Line['NMar'] . "' />";
		   $strXMLLine .="<set value='" . $ors2Line['NApr'] . "' />";
		   $strXMLLine .="<set value='" . $ors2Line['NMay'] . "' />";
		   $strXMLLine .="<set value='" . $ors2Line['NJun'] . "' />";
		   $strXMLLine .="<set value='" . $ors2Line['NJul'] . "' />";
		   $strXMLLine .="<set value='" . $ors2Line['NAgt'] . "' />";
		   $strXMLLine .="<set value='" . $ors2Line['NSep'] . "' />";
		   $strXMLLine .="<set value='" . $ors2Line['NOct'] . "' />";
		   $strXMLLine .="<set value='" . $ors2Line['NNov'] . "' />";
		   $strXMLLine .="<set value='" . $ors2Line['NDec'] . "' />";      
		   $strXMLLine .="</dataset>";

          //free the resultset
           mysql_free_result($result2Line);
		   
          }
     }
$strXMLLine .= "</chart>";

echo renderChart("FusionChartsXT/Code/FusionCharts/MSLine.swf", "", $strXMLLine, "FactorySumb", 600, 300, false, true);


echo"</td><tr>";
       


  //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX	 
        
?>	
<?php
	
  //munculin table
	 $No=1;
	 $Total=0;
	
	 echo" <table>
			<tr><th rowspan=2 >No</th><th rowspan=2>Airlines</th><th colspan=12>$Lastyear</th><th colspan=12>$yer</th><th rowspan=2 >$Lastyear</th><th rowspan=2 >$yer</th><th rowspan=2 >Increase</th></tr>
			<tr><th>JAN</th><th>FEB</th><th>MAR</th><th>APR</th><th>MAY</th><th>JUN</th><th>JUL</th><th>AGT</th><th>SEP</th><th>OCT</th><th>NOV</th><th>DEC</th><th>JAN</th><th>FEB</th><th>MAR</th><th>APR</th><th>MAY</th><th>JUN</th><th>JUL</th><th>AGT</th><th>SEP</th><th>OCT</th><th>NOV</th><th>DEC</th></tr>"; 
while($DBooking=mysql_fetch_array($Booking)){


		$strQuerytable =mysql_query("SELECT Destination,sum(if(month(DateTravelFrom)=1 and year(DateTravelFrom)=$Lastyear,AdultPax+ChildPax,0)) as LJan, sum(if(month(DateTravelFrom)=2 and year(DateTravelFrom)=$Lastyear,AdultPax+ChildPax,0)) as LFeb,sum(if(month(DateTravelFrom)=3 and year(DateTravelFrom)=$Lastyear,AdultPax+ChildPax,0)) as LMar,sum(if(month(DateTravelFrom)=4 and year(DateTravelFrom)=$Lastyear,AdultPax+ChildPax,0)) as LApr,sum(if(month(DateTravelFrom)=5 and year(DateTravelFrom)=$Lastyear,AdultPax+ChildPax,0)) as LMay,sum(if(month(DateTravelFrom)=6 and year(DateTravelFrom)=$Lastyear,AdultPax+ChildPax,0)) as LJun,sum(if(month(DateTravelFrom)=7 and year(DateTravelFrom)=$Lastyear,AdultPax+ChildPax,0)) as LJul,sum(if(month(DateTravelFrom)=8 and year(DateTravelFrom)=$Lastyear,AdultPax+ChildPax,0)) as LAgt,sum(if(month(DateTravelFrom)=9 and year(DateTravelFrom)=$Lastyear,AdultPax+ChildPax,0)) as LSep,sum(if(month(DateTravelFrom)=10 and year(DateTravelFrom)=$Lastyear,AdultPax+ChildPax,0)) as LOct,sum(if(month(DateTravelFrom)=11 and year(DateTravelFrom)=$Lastyear,AdultPax+ChildPax,0)) as LNov,sum(if(month(DateTravelFrom)=12 and year(DateTravelFrom)=$Lastyear,AdultPax+ChildPax,0)) as LDec,sum(if(month(DateTravelFrom)=1 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NJan, sum(if(month(DateTravelFrom)=2 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NFeb,sum(if(month(DateTravelFrom)=3 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NMar,sum(if(month(DateTravelFrom)=4 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NApr,sum(if(month(DateTravelFrom)=5 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NMay,sum(if(month(DateTravelFrom)=6 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NJun,sum(if(month(DateTravelFrom)=7 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NJul,sum(if(month(DateTravelFrom)=8 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NAgt,sum(if(month(DateTravelFrom)=9 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NSep,sum(if(month(DateTravelFrom)=10 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NOct,sum(if(month(DateTravelFrom)=11 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NNov,sum(if(month(DateTravelFrom)=12 and year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as NDec, sum(if(year(DateTravelFrom)=$Lastyear,AdultPax+ChildPax,0)) as TotalLast, sum(if(year(DateTravelFrom)=$yer,AdultPax+ChildPax,0)) as TotalNow FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Destination = '$DBooking[Destination]' group by Destination");
		
$DestinationTable = mysql_fetch_array($strQuerytable);

if ($DestinationTable[TotalLast]=='0'){$increase='0';}else {$increase=($DestinationTable[TotalNow]-$DestinationTable[TotalLast])/$DestinationTable[TotalLast]*100;}
if ($increase<'0'){$warnaminus="BGCOLOR='Red'";}else{$warnaminus="BGCOLOR='White'";}
				
	
		echo "<tr>
			  <td>$No</td>
			 <td><center>$DestinationTable[Destination]</td>
             <td style='text-align:right' bgcolor='BLUElight'>".number_format($DestinationTable[LJan], 0, ',', '.');echo"</td>
             <td style='text-align:right' bgcolor='BLUElight'>".number_format($DestinationTable[LFeb], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='BLUElight'>".number_format($DestinationTable[LMar], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='BLUElight'>".number_format($DestinationTable[LApr], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='BLUElight'>".number_format($DestinationTable[LMay], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='BLUElight'>".number_format($DestinationTable[LJun], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='BLUElight'>".number_format($DestinationTable[LJul], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='BLUElight'>".number_format($DestinationTable[LAgt], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='BLUElight'>".number_format($DestinationTable[LSep], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='BLUElight'>".number_format($DestinationTable[LOct], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='BLUElight'>".number_format($DestinationTable[LNov], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='BLUElight'>".number_format($DestinationTable[LDec], 0, ',', '.');echo"</td>
          	 <td style='text-align:right'>".number_format($DestinationTable[NJan], 0, ',', '.');echo"</td>
             <td style='text-align:right'>".number_format($DestinationTable[NFeb], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format($DestinationTable[NMar], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format($DestinationTable[NApr], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format($DestinationTable[NMay], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format($DestinationTable[NJun], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format($DestinationTable[NJul], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format($DestinationTable[NAgt], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format($DestinationTable[NSep], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format($DestinationTable[NOct], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format($DestinationTable[NNov], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format($DestinationTable[NDec], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='BLUElight'>".number_format($DestinationTable[TotalLast], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format($DestinationTable[TotalNow], 0, ',', '.');echo"</td>
			 <td style='text-align:right' $warnaminus>".number_format($increase, 0, ',', '.'); echo" % </td>";


		echo"   </tr>";
		$No++;}
		echo "</table></tr></table>";
		}
	else	
	{ echo "NO TRANSACTION AVAILABLE IN $yer";
	} 
  
    break;   
	

 }        
?>
