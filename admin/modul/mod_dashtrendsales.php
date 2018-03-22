<SCRIPT LANGUAGE="Javascript" SRC="FusionChartsXT/Code/FusionCharts/FusionCharts.js">

function ganti() {
document.example.elements['submit'].click(); 
}

</script>

<?php

include("FusionChartsXT/Code/PHP/Includes/FusionCharts.php");  
include("FusionChartsXT/Code/PHP/Includes/DBConn.php");

switch($_GET['act']){
   default:
   	$Season=$_GET['Season'];	
	if($Season<>''){$Season=$Season;}
	
	$Tahunini=date("Y");
	
	$Tahun=$_GET['Tahun'];
    if($Tahun==''){$Tahun=$Tahunini;}else{$Tahun=$Tahun;}
	
	
    
	
    echo"<form name='dashboard' method=get action='media.php?' >
    <input type='hidden' name='module' value='dashtrendsales'>
    <h2><br/>TREND SALES DASHBOARD <br></h2><br>

	Season : <select name='Season'>";

	$tampilSeason=mysql_query("SELECT distinct SeasonName FROM tour_msseason where SeasonStatus='ACTIVE' order by SeasonName ASC");
	
    while($sSeason=mysql_fetch_array($tampilSeason)){
        if ($sSeason[SeasonName]==$Season){
            echo "<option value='$sSeason[SeasonName]' selected>$sSeason[SeasonName]</option>";
        }
        else {
            echo "<option value='$sSeason[SeasonName]'>$sSeason[SeasonName]</option>";}
	}
					
	echo"</select>
	&nbsp;&nbsp;&nbsp;<select name='Tahun'>";
	
	for ($i=$Tahunini-3;$i<=$Tahunini+1;$i++)
	{
		if ($Tahun==$i){
            echo "<option value='$i' selected>$i</option>";
        }
        else {
            echo "<option value='$i'>$i</option>";}
	}

	echo"</select>  <input type='submit' name='submit' id='submit' value=Show >  </h2></form>";
	
	
	//batas tahun ini
	
	$QAwalBooking=mysql_query("SELECT BookingDate,DateTravelFrom FROM `tour_msbooking` inner join tour_msproduct on tour_msproduct.IDProduct= tour_msbooking.IDTourcode where Season='$Season' and year(datetravelfrom)='$Tahun' and tour_msbooking.Status<>'VOID' and TCdivision<>'LTM' and TCdivision<>'LTM-TEZ'  order by  BookingDate asc limit 1");
		
	$DAwalBooking=mysql_fetch_array($QAwalBooking);
	$JumBook=mysql_num_rows($QAwalBooking);
	
	if($JumBook>0)
	{
	
		$BatasTanggal=date("Y-m-d", strtotime($DAwalBooking[DateTravelFrom] . " +100 day"));
		$BatasTanggalLalu=date("Y-m-d", strtotime($BatasTanggal . " -1 year"));
		
		
		$TglAwal=$DAwalBooking[BookingDate];
		
		
		
		$QAkhirBerangkat=mysql_query("SELECT DateTravelFrom FROM  tour_msproduct  where Season='$Season'  and datetravelfrom < '$BatasTanggal' and seat <> seatsisa and status <>'VOID' order by DateTravelFrom desc limit 1");
		

		$DAkhirBerangkat=mysql_fetch_array($QAkhirBerangkat);
		$TglAkhir=$DAkhirBerangkat[DateTravelFrom];		
		$hariini=date("Y-m-d");
		if($TglAkhir>$hariini)
		{
			$TglAkhir=$hariini;
		}
		
		$QTotalSeat=mysql_query("SELECT sum(seat) as Capacity FROM  tour_msproduct  where Season='$Season'  and datetravelfrom < '$BatasTanggal' and datetravelfrom > '$TglAwal' and status ='Publish' and seat<>seatsisa");
		$DTotalSeat=mysql_fetch_array($QTotalSeat);
		$TotalSeat=$DTotalSeat[Capacity];		

		$BatasAxis=$TotalSeat+200;
		//batas tahun lalu
		
		$TahunLalu=$Tahun-1;
		
		$Tanggal=date("Y-m-d",strtotime($TglAwal));
		
		
		$i=1;
		
		while (strtotime($Tanggal) <= strtotime($TglAkhir)) {
		
			$Start=date("Y-m-d",strtotime($Tanggal));
			$TanggalLalu = date("Y-m-d", strtotime($Start. " -1 year"));
			
			// BookingDate = '$Start'
			$QBooking=mysql_query("SELECT sum(AdultPax+ChildPax+InfantPax) as Total FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct= tour_msbooking.IDTourcode where Season='$Season' and DATE(BookingDate)= '$Start' and tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT' and TCdivision<>'LTM' and TCdivision<>'LTM-TEZ' and datetravelfrom < '$BatasTanggal' ");
			
			$QBookingLalu=mysql_query("SELECT sum(AdultPax+ChildPax+InfantPax) as Total FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct= tour_msbooking.IDTourcode where Season='$Season' and BookingDate= '$TanggalLalu' and tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT' and TCdivision<>'LTM' and TCdivision<>'LTM-TEZ' and datetravelfrom < '$BatasTanggalLalu' ");
		
			$QPameran=mysql_query("select event from tour_marketing where DateFrom <='$Start' and DateTo >='$Start'");
			$JumPameran=mysql_num_rows($QPameran);
			if($JumPameran>0)
			{
				
				$Pameran[$i]=$JumPameran;
			}
			
			
			$QIklan=mysql_query("select media from tour_iklan where DateFrom <='$Start' and DateTo >='$Start'");
			$JumIklan=mysql_num_rows($QIklan);
			if($JumIklan>0)
			{
				
				$Iklan[$i]=$JumIklan;
			}
			
			$DBooking=mysql_fetch_array($QBooking);
			$DBookingLalu=mysql_fetch_array($QBookingLalu);
			
			$Last=$i-1;
			// $tgl[$i]=date("d M",strtotime($Tanggal));
			$tgl[$i]=date("d M Y",strtotime($Tanggal));
			$TglBook[$i] = date("Y-m-d", strtotime($Tanggal));
			$Book[$i]=$Book[$Last]+$DBooking[Total];
			$BookLalu[$i]=$BookLalu[$Last]+$DBookingLalu[Total];
			
			$Tanggal = date("Y-m-d", strtotime($Tanggal . " +1 day"));
			$i++;
		}
		
		echo"<table><tr><td style='border:0;'>";
		echo"<table><tr><td>Tanggal</td><td>$Tahun</td><td>$TahunLalu</td><td>Pameran</td><td>Iklan</td></tr>";
		for($a=1;$a<$i;$a++)
		{
			echo"<tr><td>$tgl[$a]</td>
			<td style='text-align:right';><a href='?module=dashtrendsales&act=Showdetail&tgl=$TglBook[$a]&tgl1=$TglAwal&tgl2=$BatasTanggal&Season=$Season'>".number_format($Book[$a], 0, ',', '.')."</a></td>
			<td style='text-align:right';>$BookLalu[$a]</td>
			<td style='text-align:right';>$Pameran[$a]</td>
			<td style='text-align:right';>$Iklan[$a]</td></tr>";
		}
		
		echo"</table></td><td style='border:0;'>";
		
		?>

<?php

//---------------------------------- chart-------------------------------------------------//

	
	
	
	echo"$batas";
	$link = connectToDB(); 
	$strXML = "<chart caption='TREND SALES BOOKING' xAxisName='Date' yAxisName='Pax' showValues='0'  yAxisMinValue ='0' numDivLines='20' yAxisMaxValue='$BatasAxis'>";
	
	$strXML .="<categories>";
	for($c=1;$c<$i;$c++)
	{
		$strXML .="<category label='$tgl[$c]'/>";
	}
	$strXML .="</categories>";
	
	$strXML .="<dataset seriesname='$Tahun' >";
	for($dsNow=1;$dsNow<$i;$dsNow++)
	{
		$strXML .="<set value='".$Book[$dsNow]."'/>";			
	}	
	$strXML .="</dataset>";		
	
	
	$strXML .="<dataset seriesname='$TahunLalu' >";
	for($dsLalu=1;$dsLalu<$i;$dsLalu++)
	{
		$strXML .="<set value='".$BookLalu[$dsLalu]."'/>";			
	}	
	$strXML .="</dataset>";		
	
	
	

		//ini buat target
		
		 $strXML .="<trendlines>";
      	 $strXML .="<line startValue='$TotalSeat' color='91C728' displayvalue='Available Seat' thickness='2' valueonright='1' showontop='1'/>";
  		 $strXML .="</trendlines>";
		
		
		
		$strXML .="</chart>";
		
	
	echo renderChart("FusionChartsXT/Code/FusionCharts/MSLine.swf ","", $strXML, "FactorySum", 1200, 900, false, true); 		
		
		//---------------------------------- end chart-------------------------------------------------//
		
		echo"</td></tr></table>";
	
	}
	
	break;
	

	
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/
	
	case "Showdetail":  
	
	$Tanggal=$_GET['tgl'];
	$Season=$_GET['Season'];
	$TanggalAwal=$_GET['tgl1'];
	$TanggalAkhir=$_GET['tgl2'];
	
	
	$QBooking=mysql_query("SELECT BookingID,tour_msbooking.TourCode,DateTravelFrom,TCNameAlias,BookersName,(AdultPax+ChildPax+InfantPax) as Total FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct= tour_msbooking.IDTourcode  where Season='$Season' and BookingDate<= '$Tanggal' and tour_msbooking.Status<>'VOID' and TCdivision<>'LTM' and TCdivision<>'LTM-TEZ' and datetravelfrom < '$TanggalAkhir'  and BookingDate >='$TanggalAwal' order by datetravelfrom,tour_msbooking.TourCode desc ");
	
	$No=1;
	echo"<table><tr><th>No</th><th>BookingID</th><th>Tour Code</th><th>Departure</th><th>TC Name</th><th>Bookers</th><th>Pax</th></tr>";
	while ($DBooking=mysql_fetch_array($QBooking)) {
		
	echo"<tr><td>$No</td>
			 <td>$DBooking[BookingID]</td>
			 <td>$DBooking[TourCode]</td>
			 <td>".date("d M Y",strtotime($DBooking[DateTravelFrom]))."</td>
			 <td>$DBooking[TCNameAlias]</td>
			 <td>$DBooking[BookersName]</td>
			 <td>$DBooking[Total]</td></tr>";
			 $TotalPax=$TotalPax+$DBooking[Total];
			 $No++;
	}
	echo"<tr><th colspan=6>Total</th><th>$TotalPax</th></tr></table>";
	
	break;
	
	
}
