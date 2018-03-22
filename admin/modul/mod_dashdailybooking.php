<SCRIPT LANGUAGE="Javascript" SRC="FusionChartsXT/Code/FusionCharts/FusionCharts.js">

function ganti() {
document.example.elements['submit'].click(); 
}
</script>

<?php
include("FusionChartsXT/Code/PHP/Includes/FusionCharts.php");  
include("FusionChartsXT/Code/PHP/Includes/DBConn.php");
$CompanyID=$_SESSION['company_id'];
switch($_GET['act']){
   default:
    $tanggal=$_GET['tanggal'];
    if($tanggal==''){$tanggal=date("d-m-Y");}else{$tanggal=$tanggal;}
    $tanggal2=$_GET['tanggal2'];
    if($tanggal2==''){$tanggal2=date("d-m-Y");}else{$tanggal2=$tanggal2;}
    $opnama=$_GET['opnama'];
    if($opnama==''){$opnama='BookingDate';}
	$Department=$_GET['Department'];
    if($Department==''){$Department='ALL';}
	
    $haritahunini=date("Y-m-d");
	$haritahunlalu=date("Y-m-d", strtotime($haritahunini . " -1 year"));
	
    echo"<form name='dashboard' method=get action='media.php?' >
    <input type='hidden' name='module' value='dashdailybooking'>
    <h2><br/>DAILY BOOKING DASHBOARD: <br>
    <select name='opnama'>          
    <option value='DateTravelFrom'";if($opnama=='DateTravelFrom'){echo"selected";}echo">Departure Date</option>
    <option value='BookingDate'";if($opnama=='BookingDate'){echo"selected";}echo">Booking Date</option>
    </select>
	 
    From <input type=text name='tanggal' size='10' value='$tanggal' onClick="."cal.select(document.forms['dashboard'].tanggal,'anchor1','dd-MM-yyyy'); return false;"." NAME='anchor1' ID='anchor1'> - 
    To <input type=text name='tanggal2' size='10' value='$tanggal2' onClick="."cal.select(document.forms['dashboard'].tanggal2,'anchor2','dd-MM-yyyy'); return false;"." NAME='anchor2' ID='anchor2'><br>
	
	Department :  <select name='Department'>";
    $tampilDept=mysql_query("SELECT distinct Department FROM  tour_msproduct where Department <> '' and Department <> '0' and CompanyID=$CompanyID order by Department ASC");
	echo"<option value='ALL'>ALL Department</option>";
    while($sDept=mysql_fetch_array($tampilDept)){
		if($sDept[Department]=='LEISURE'){$ValDepartment='SERIES';}else{$ValDepartment=$sDept[Department];}
        if ($Department==$sDept[Department]){
            echo "<option value='$sDept[Department]' selected>$ValDepartment</option>";
        }
        else {
            echo "<option value='$sDept[Department]'>$ValDepartment</option>";}

    }
    echo "</select>
   <input type='submit' name='submit' id='submit' value=Show >  </h2>
    </form>"; 

	$thn=date("Y",strtotime($tanggal));
	$Lthn=$thn-1;
	
	if($Department=='LEISURE'){$ValDepartment='SERIES';}else{$ValDepartment=$Department;}	
	if($opnama=='DateTravelFrom'){$Base='Departure Date';}else{$Base='Booking Date';}
	echo"<table>
	      <tr><td style='border-color:white; font-size: 20px ;font-weight:bold'; colspan=3><center>$Base Period : ".date("d-M-Y",strtotime($tanggal))." until ".date("d-M-Y",strtotime($tanggal2))."
		  </td></tr>
		  <tr><td style='border-color:white; colspan=3'><center>Department : $ValDepartment</td>
		  </tr>
		  <tr><td style='border-color:white'>";
	
	echo"<table>
		<tr><th rowspan=3>Date</th><th colspan=7><center>Booking</th><th colspan=7><center>Active</th><th colspan=6><center>Cancel</th>";
		if($opnama=='BookingDate'){echo"<th rowspan=3>Event</th>";}
		echo"</tr>
		<tr><th colspan=3>$Lthn</th><th colspan=3>$thn</th><th rowspan=2>Increment<br>(PAX)</th><th colspan=3>$Lthn</th><th colspan=3>$thn</th><th rowspan=2>Increment<br>(PAX)</th><th colspan=3>$Lthn</th><th colspan=3>$thn</th></tr>
		<tr><th>Pax</th><th>USD</th><th>IDR</th><th>Pax</th><th>USD</th><th>IDR</th><th>Pax</th><th>USD</th><th>IDR</th><th>Pax</th><th>USD</th><th>IDR</th><th>Pax</th><th>USD</th><th>IDR</th>
		<th>Pax</th><th>USD</th><th>IDR</th></tr>";

		if($opnama=='DateTravelFrom'){
			$Baseon ="tour_msbooking.BookingDate";
			$Baseon2 ="tour_msproduct.DateTravelFrom";
		}
		else
		{
			$Baseon ="tour_msbooking.BookingDate";
			$Baseon2 ="tour_msbooking.BookingDate";
		}
		if($Department=='ALL')
		{
			$Booking="";	
		}
		else
		{
			$Booking="and tour_msproduct.Department='$Department'";	
		}
	while (strtotime($tanggal) <= strtotime($tanggal2)) {
	
	$Start=date("Y-m-d",strtotime($tanggal));
	$tanggalLalu = date("Y-m-d", strtotime($tanggal . " -1 year"));

	if($opnama=='DateTravelFrom') {

    $This = mysql_query("SELECT sum(if(year($Baseon)='$thn',1,0)) as TotalNow,
	sum(if((SellingCurr='USD' and year(DATE($Baseon))='$thn'),
	(Subtotal+DevAmount+SeaTaxSell+if((Package<>'L.A Only' and Gender<>'INFANT'),TaxInsSell,0)),0)) as USDNow,
	
	sum(if((SellingCurr='IDR' and year(DATE($Baseon))='$thn'),
	(Subtotal+DevAmount+SeaTaxSell+if((Package<>'L.A Only' and Gender<>'INFANT'),TaxInsSell,0)),0)) as IDRNow, 
	
	sum(if(year($Baseon)='$thn' and status<>'CANCEL',1,0)) as ActiveTotalNow,
	sum(if((SellingCurr='USD' and year(DATE($Baseon))='$thn' and status<>'CANCEL'),
	(Subtotal+DevAmount+SeaTaxSell+if((Package<>'L.A Only' and Gender<>'INFANT'),TaxInsSell,0)),0)) as ActiveUSDNow,
	
	sum(if((SellingCurr='IDR' and year(DATE($Baseon))='$thn' and status<>'CANCEL'),
	(Subtotal+DevAmount+SeaTaxSell+if((Package<>'L.A Only' and Gender<>'INFANT'),TaxInsSell,0)),0)) as ActiveIDRNow, 
	
	sum(if(year($Baseon)='$Lthn',1,0)) as TotalLast,

	sum(if((SellingCurr='USD' and year(DATE($Baseon))='$Lthn'),
	(Subtotal+DevAmount+SeaTaxSell+if((Package<>'L.A Only' and Gender<>'INFANT'),TaxInsSell,0)),0)) as USDLast,
	
	sum(if((SellingCurr='IDR' and year(DATE($Baseon))='$Lthn'),
	(Subtotal+DevAmount+SeaTaxSell+if((Package<>'L.A Only' and Gender<>'INFANT'),TaxInsSell,0)),0)) as IDRLast,
	
	sum(if(year(DATE($Baseon))='$Lthn' and status<>'CANCEL',1,0)) as ActiveTotalLast,
	sum(if((SellingCurr='USD' and year(DATE($Baseon))='$Lthn' and status<>'CANCEL'),
	(Subtotal+DevAmount+SeaTaxSell+if((Package<>'L.A Only' and Gender<>'INFANT'),TaxInsSell,0)),0)) as ActiveUSDLast,
	
	sum(if((SellingCurr='IDR' and year(DATE($Baseon))='$Lthn' and status<>'CANCEL'),
	(Subtotal+DevAmount+SeaTaxSell+if((Package<>'L.A Only' and Gender<>'INFANT'),TaxInsSell,0)),0)) as ActiveIDRLast 
	from tour_msbookingdetail 
	inner join (Select BookingID,$Baseon2,SellingCurr,SeaTaxSell,TaxInsSell,DATE(BookingDate) as BookingDate from tour_msbooking 
	inner join tour_msproduct on tour_msbooking.IDTourcode=tour_msproduct.IDProduct 
	where (TCCompanyID=$CompanyID or tour_msproduct.CompanyID=$CompanyID) 
	and DUMMY='NO' 
	and BookingStatus='DEPOSIT' 
	and  ((date($Baseon2)='$Start' and DATE($Baseon) <='$haritahunini') or (date($Baseon2)='$tanggalLalu' and DATE($Baseon) <='$haritahunlalu') )  
	and tour_msproduct.status<>'VOID' $Booking)tour_msbooking on tour_msbooking.BookingID =tour_msbookingdetail.BookingID 
	where Gender<>'INFANT' ");
    } else {

        $This = mysql_query("SELECT sum(if(year(DATE($Baseon))='$thn',1,0)) as TotalNow,
	sum(if((SellingCurr='USD' and year(DATE($Baseon))='$thn'),
	(Subtotal+DevAmount+SeaTaxSell+if((Package<>'L.A Only' and Gender<>'INFANT'),TaxInsSell,0)),0)) as USDNow,
	
	sum(if((SellingCurr='IDR' and year(DATE($Baseon))='$thn'),
	(Subtotal+DevAmount+SeaTaxSell+if((Package<>'L.A Only' and Gender<>'INFANT'),TaxInsSell,0)),0)) as IDRNow, 
	
	sum(if(year(DATE($Baseon))='$thn' and status<>'CANCEL',1,0)) as ActiveTotalNow,
	sum(if((SellingCurr='USD' and year(DATE($Baseon))='$thn' and status<>'CANCEL'),
	(Subtotal+DevAmount+SeaTaxSell+if((Package<>'L.A Only' and Gender<>'INFANT'),TaxInsSell,0)),0)) as ActiveUSDNow,
	
	sum(if((SellingCurr='IDR' and year(DATE($Baseon))='$thn' and status<>'CANCEL'),
	(Subtotal+DevAmount+SeaTaxSell+if((Package<>'L.A Only' and Gender<>'INFANT'),TaxInsSell,0)),0)) as ActiveIDRNow, 
	
	sum(if(year(DATE($Baseon))='$Lthn',1,0)) as TotalLast,

	sum(if((SellingCurr='USD' and year(DATE($Baseon))='$Lthn'),
	(Subtotal+DevAmount+SeaTaxSell+if((Package<>'L.A Only' and Gender<>'INFANT'),TaxInsSell,0)),0)) as USDLast,
	
	sum(if((SellingCurr='IDR' and year(DATE($Baseon))='$Lthn'),
	(Subtotal+DevAmount+SeaTaxSell+if((Package<>'L.A Only' and Gender<>'INFANT'),TaxInsSell,0)),0)) as IDRLast,
	
	sum(if(year(DATE($Baseon))='$Lthn' and status<>'CANCEL',1,0)) as ActiveTotalLast,
	sum(if((SellingCurr='USD' and year(DATE($Baseon))='$Lthn' and status<>'CANCEL'),
	(Subtotal+DevAmount+SeaTaxSell+if((Package<>'L.A Only' and Gender<>'INFANT'),TaxInsSell,0)),0)) as ActiveUSDLast,
	
	sum(if((SellingCurr='IDR' and year(DATE($Baseon))='$Lthn' and status<>'CANCEL'),
	(Subtotal+DevAmount+SeaTaxSell+if((Package<>'L.A Only' and Gender<>'INFANT'),TaxInsSell,0)),0)) as ActiveIDRLast 
	  
	 from tour_msbookingdetail inner join (Select BookingID,$Baseon2,SellingCurr,SeaTaxSell,TaxInsSell from tour_msbooking inner join tour_msproduct on tour_msbooking.IDTourcode=tour_msproduct.IDProduct where (TCCompanyID=$CompanyID or tour_msproduct.CompanyID=$CompanyID) and DUMMY='NO' and BookingStatus='DEPOSIT' and  (date($Baseon2)='$Start' or date($Baseon2)='$tanggalLalu')  and tour_msproduct.status<>'VOID' $Booking)tour_msbooking on tour_msbooking.Bookingid =tour_msbookingdetail.BookingID where Gender<>'INFANT' ");

    }
		
	$DThis=mysql_fetch_array($This);
	
				
		$tgltampil=date("d M",strtotime($tanggal));
		
		$iklan=mysql_query("SELECT media,DateFrom,DateTo FROM tour_iklan WHERE Status='Active' and  DateFrom<='$tanggal' and DateTo >='$tanggal'");		
		$Pameran=mysql_query("Select Event,DateFrom,DateTo from tour_marketing where status='FIX' and  DateFrom<='$tanggal' and DateTo >='$tanggal'");		
		
		$DIklan=mysql_fetch_array($iklan);
		$JIklan=mysql_num_rows($iklan);
		$DPameran=mysql_fetch_array($Pameran);
		$JPameran=mysql_num_rows($Pameran);
		$Event='';
		
		if($JIklan>0)
		{
			$Event='Iklan : '.$DIklan[media];
		}
		
		if($JPameran>0)
		{
			if ($Event=='')
			{
				$Event='Pameran '.$DIklan[Event] ;
			}
			else
			{$Event=$Event.' // Pameran '.$DPameran[Event];}
		
		}
		
		
		if($DThis[TotalNow]<$DThis[TotalLast]){$warna="color:RED;";}else {$warna="COLOR:black;";}
		echo "<tr><td>$tgltampil</td>
			 <td style='text-align:right' >".number_format($DThis[TotalLast], 0, ',', '.')."</td>
			 <td style='text-align:right' >".number_format($DThis[USDLast], 0, ',', '.')."</td>
			 <td style='text-align:right' >".number_format($DThis[IDRLast], 0, ',', '.')."</td>
			 <td style='text-align:right' ><a href='?module=dashdailybooking&act=dtlDate&tgl=$tanggal&Base=$opnama'>".number_format($DThis[TotalNow], 0, ',', '.')."</a></td>
			 <td style='text-align:right' >".number_format($DThis[USDNow], 0, ',', '.')."</td>
			 <td style='text-align:right' >".number_format($DThis[IDRNow], 0, ',', '.')."</td>
		<td style='text-align:right; $warna' >".number_format(($DThis[TotalNow]/$DThis[TotalLast]*100), 2, ',', '.')." %</td>";
		
		if($DThis[ActiveTotalNow]<$DThis[ActiveTotalLast]){$warna="color:RED;";}else {$warna="COLOR:black;";}
		echo"<td style='text-align:right' >".number_format($DThis[ActiveTotalLast], 0, ',', '.')."</td>
		<td style='text-align:right' >".number_format($DThis[ActiveUSDLast], 0, ',', '.')."</td>
		<td style='text-align:right' >".number_format($DThis[ActiveIDRLast], 0, ',', '.')."</td>
		
		<td style='text-align:right' >".number_format($DThis[ActiveTotalNow], 0, ',', '.')."</td>
		<td style='text-align:right' >".number_format($DThis[ActiveUSDNow], 0, ',', '.')."</td>
		<td style='text-align:right' >".number_format($DThis[ActiveIDRNow], 0, ',', '.')."</td>
		
		<td style='text-align:right; $warna' >".number_format(($DThis[ActiveTotalNow]/$DThis[ActiveTotalLast]*100), 2, ',', '.')." %</td>";
		
		
		echo"
			<td style='text-align:right' >".number_format($DThis[TotalLast]-$DThis[ActiveTotalLast], 0, ',', '.')."</td>
			<td style='text-align:right' >".number_format($DThis[USDLast]-$DThis[ActiveUSDLast], 0, ',', '.')."</td>
			<td style='text-align:right' >".number_format($DThis[IDRLast]-$DThis[ActiveIDRLast], 0, ',', '.')."</td>
			
			<td style='text-align:right' >".number_format($DThis[TotalNow]-$DThis[ActiveTotalNow], 0, ',', '.')."</td>
			<td style='text-align:right' >".number_format($DThis[USDNow]-$DThis[ActiveUSDNow], 0, ',', '.')."</td>
			<td style='text-align:right' >".number_format($DThis[IDRNow]-$DThis[ActiveIDRNow], 0, ',', '.')."</td>";
		
				if($opnama=='BookingDate'){echo"<td>$Event</td>";}
				
				echo"</tr>";
				
			
			 $BookingLast=$BookingLast+$DThis[TotalLast];
			 $USDLast=$USDLast+$DThis[USDLast];
			 $IDRLast=$IDRLast+$DThis[IDRLast];
			 $BookingNow=$BookingNow+$DThis[TotalNow];
			 $USDNow=$USDNow+$DThis[USDNow];
			 $IDRNow=$IDRNow+$DThis[IDRNow];
			 $ActiveLast=$ActiveLast+$DThis[ActiveTotalLast];
			 $ActiveUSDLast=$ActiveUSDLast+$DThis[ActiveUSDLast];
			 $ActiveIDRLast=$ActiveIDRLast+$DThis[ActiveIDRLast];
			 $ActiveNow=$ActiveNow+$DThis[ActiveTotalNow];
			 $ActiveUSDNow=$ActiveUSDNow+$DThis[ActiveUSDNow];
			 $ActiveIDRNow=$ActiveIDRNow+$DThis[ActiveIDRNow];
		
		
		$tanggal = date("Y-m-d", strtotime($tanggal . " +1 day"));
		
		}

		
	echo"<tr><th>Total</th>
		<th>".number_format($BookingLast, 0, ',', '.')."</th>
		<th>".number_format($USDLast, 0, ',', '.')."</th>
		<th>".number_format($IDRLast, 0, ',', '.')."</th>
		<th>".number_format($BookingNow, 0, ',', '.')."</th>
		<th>".number_format($USDNow, 0, ',', '.')."</th>
		<th>".number_format($IDRNow, 0, ',', '.')."</th>
		<th>".number_format(($BookingNow/$BookingLast*100), 2, ',', '.')." %</th>
		<th>".number_format($ActiveLast, 0, ',', '.')."</th>
		<th>".number_format($ActiveUSDLast, 0, ',', '.')."</th>		
		<th>".number_format($ActiveIDRLast, 0, ',', '.')."</th>
		<th>".number_format($ActiveNow, 0, ',', '.')."</th>
		<th>".number_format($ActiveUSDNow, 0, ',', '.')."</th>
		<th>".number_format($ActiveIDRNow, 0, ',', '.')."</th>
		<th>".number_format(($ActiveNow/$ActiveLast*100), 2, ',', '.')." % </th>
		<th>".number_format($BookingLast-$ActiveLast, 0, ',', '.')."</th>
		<th>".number_format($USDLast-$ActiveUSDLast, 0, ',', '.')."</th>
		<th>".number_format($IDRLast-$ActiveIDRLast, 0, ',', '.')."</th>
		<th>".number_format($BookingNow-$ActiveNow, 0, ',', '.')."</th>
		<th>".number_format($USDNow-$ActiveUSDNow, 0, ',', '.')."</th>
		<th>".number_format($IDRNow-$ActiveIDRNow, 0, ',', '.')."</th>";
	
	if($opnama=='BookingDate'){echo"<th></th>";}

	echo"</tr></table></td></tr><tr><td>";

?>

<?php

//---------------------------------- chart-------------------------------------------------//
	
	
	$tanggal=$_GET['tanggal'];
    if($tanggal==''){$tanggal=date("d-m-Y");}else{$tanggal=$tanggal;}
    $tanggal2=$_GET['tanggal2'];
    if($tanggal2==''){$tanggal2=date("d-m-Y");}else{$tanggal2=$tanggal2;}
	
	$Department=$_GET['Department'];
	
	
	$thn=date("Y",strtotime($tanggal));
	$Lthn=$thn-1;
	
	$link = connectToDB(); 
	$strXML = "<chart caption='DAILY BOOKING' xAxisName='Date' yAxisName='Pax' showValues='0'  yAxisMinValue ='0' numDivLines='100' yAxisMaxValue='300' >";
	$i=1;
	
	$Awal=date("Y-m-d",strtotime($tanggal));
	
	$QGraphStart="SELECT  * from tour_RptClosingDay where BookingDate='$Awal'";
		
	    $DGraphStart = mysql_query($QGraphStart) or die(mysql_error());
		 $GraphStart = mysql_fetch_array($DGraphStart);
		 
    $haritahunini=date("Y-m-d");
	$haritahunlalu=date("Y-m-d", strtotime($haritahunini . " -1 year"));

	while (strtotime($tanggal) <= strtotime($tanggal2)) {

		
		$tgltampil=date("d M",strtotime($tanggal));
		$mont=date("m",strtotime($tanggal));
		$tgl=date("d",strtotime($tanggal));

		$tglLalu="$Lthn-$mont-$tgl";
	
		$Start=date("Y-m-d",strtotime($tanggal));
		$StartLalu=date("Y-m-d",strtotime($tglLalu));
		if($Department=='ALL')
		{
			$QGraphDep="SELECT BookingDate,sum(TotalBooking) as TotalBooking from tour_RptClosingDay where BookingDate='$Start' group by BookingDate";
			$QGraphDepLast="SELECT BookingDate,sum(TotalBooking) as TotalBooking from tour_RptClosingDay where BookingDate='$StartLalu' group by BookingDate";
		}
		else
		{
			$QGraphDep="SELECT  * from tour_RptClosingDay where BookingDate='$Start' and Department='$Department'";
			$QGraphDepLast="SELECT  * from tour_RptClosingDay where BookingDate='$StartLalu' and Department='$Department'";
		}
		
	    $DGraphDep = mysql_query($QGraphDep) or die(mysql_error());
		$GraphDep = mysql_fetch_array($DGraphDep);
		 
		$DGraphDepLast = mysql_query($QGraphDepLast) or die(mysql_error());
		$GraphDepLast = mysql_fetch_array($DGraphDepLast);
			 
		$cat[$i]="$tgltampil";
		
		
		$ActiveGraph[$i]=$GraphDep['TotalBooking'];
		$ActiveLastGraph[$i]=$GraphDepLast['TotalBooking'];
		
		
		$tanggal = date("Y-m-d", strtotime($tanggal . " +1 day"));
		$i++;
		
	}
		
	
		$strXML .="<categories>";

		for ($j=1; $j < $i ; $j++)
		{
			
			$strXML .="<category label='$cat[$j]'/>";
			
			
		}
		$strXML .="</categories>";
		
		
		
		$strXML .="<dataset seriesname='$thn' >";
		for ($j=1; $j < $i ; $j++)
		{
			$strXML .="<set value='".$ActiveGraph[$j]."'/>";			
		}
		$strXML .="</dataset>";
		
		
		$strXML .="<dataset seriesname='$Lthn' >";
		for ($j=1; $j < $i ; $j++)
		{
			$strXML .="<set value='".$ActiveLastGraph[$j]."'/>";
			
		}
		$strXML .="</dataset>";
		
		//ini buat target
		/*
		 $strXML .="<trendlines>";
      	 $strXML .="<line startValue='0' color='91C728' endvalue='100000'/>";
  		 $strXML .="</trendlines>";
		*/
		
		
		$strXML .="</chart>";
	
	echo renderChart("FusionChartsXT/Code/FusionCharts/MSLine.swf ","", $strXML, "FactorySum", 900, 500, false, true); 		
		
		//---------------------------------- end chart-------------------------------------------------//
		
	echo"</td></tr>";
	echo"</table>";
	break;

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/
	
	case "dtlDate":    

	$tanggal=$_GET[tgl];
	$Option=$_GET[Base];

	
	if($Option=='DateTravelFrom'){
			$Baseon ="tour_msproduct.DateTravelFrom";
		}
		else
		{
			$Baseon = "tour_msbooking.BookingDate";
		}
	
	$Start=date("Y-m-d",strtotime($tanggal));
	
	$tgltampil=date("d M Y",strtotime($tanggal));
		
	echo "<b>DAILY SALES REPORT $tgltampil<br></b>
			<font size=2px>Base on $Option</font>";
	
	$QDtlDate=mysql_query("Select *,tour_msbooking.Tourcode as BookTourCode from tour_msbooking inner join tour_msproduct on tour_msbooking.IDTourcode=tour_msproduct.IDProduct where (TCCompanyID=$CompanyID and tour_msproduct.CompanyID=$CompanyID) and DUMMY='NO' and BookingStatus='DEPOSIT' and  (date($Baseon)='$Start')  and tour_msproduct.status<>'VOID' and tour_msbooking.Status ='ACTIVE' order by BookingID");	
	
	$No=1;
	$Adult=0;
	$Child=0;
	$Infant=0;
		
	echo"<table>
		 <tr><td colspan=11;><strong>ACTIVE BOOKING</strong></td></tr>
		<tr><th>No</th><th>Booking ID</th><th>Tour Code</th><th>TC</th><th>Divisi</th><th>Adult</th><th>Child</th><th>Infant</th><th>Status</th><th>Remarks</th><th>Event</th></tr>";
	
	$jumdata = mysql_num_rows($QDtlDate);
	
	if($jumdata >0)
	{
	while($DDtlThis=mysql_fetch_array($QDtlDate)){
		
		echo"<tr><td>$No</td>
			<td>$DDtlThis[BookingID]</td>
			<td>$DDtlThis[BookTourCode]</td>
			<td>$DDtlThis[TCName]</td>
			<td>$DDtlThis[TCDivision]</td>
			<td><center>$DDtlThis[AdultPax]</td>
			<td><center>$DDtlThis[ChildPax]</td>
			<td><center>$DDtlThis[InfantPax]</td>
			<td>$DDtlThis[BookSts]</td>
			<td>$DDtlThis[ReasonCancel]</td>";
			
			if($DDtlThis[BookingPlace]!=''){echo"<td>Pameran</td>";}
			else{echo"<td></td>";}
			 echo"</tr>";
		$Adult=$Adult+$DDtlThis[AdultPax];
		$Child=$Child+$DDtlThis[ChildPax];
		$Infant=$Infant+$DDtlThis[InfantPax];
		$No++;
	}
	
	$TAdult=$TAdult+$Adult;
	$TChild=$TChild+$Child;
	$TInfant=$TInfant+$Infant;
	
	echo"<tr><th colspan=5;>SubTotal</th><th>$TAdult</th><th>$TChild</th><th>$TInfant</th><th></th><th colspan=2></th></tr>";
	}
		 
	
	$QDtlOTHER=mysql_query("Select *,tour_msbooking.Tourcode as BookTourCode from tour_msbooking inner join tour_msproduct on tour_msbooking.IDTourcode=tour_msproduct.IDProduct where (TCCompanyID<>$CompanyID and tour_msproduct.CompanyID=$CompanyID) and DUMMY='NO' and BookingStatus='DEPOSIT' and  (date($Baseon)='$Start')  and tour_msproduct.status<>'VOID' and tour_msbooking.Status ='ACTIVE' order by BookingID");	
	
	$Adult=0;
	$Child=0;
	$Infant=0;
	
	
	$jumdata = mysql_num_rows($QDtlOTHER);
	
	if($jumdata >0)
	{
		echo"<tr><td colspan=11;><strong>SISTER COMPANY / FRANCHISE</strong></td></tr>";
		
		while($DDtlThisOther=mysql_fetch_array($QDtlOTHER)){
		
			
			echo"<tr><td>$No</td>
				<td>$DDtlThisOther[BookingID]</td>
				<td>$DDtlThisOther[BookTourCode]</td>
				<td>$DDtlThisOther[TCName]</td>
				<td>$DDtlThisOther[TCDivision]</td>
				<td><center>$DDtlThisOther[AdultPax]</td>
				<td><center>$DDtlThisOther[ChildPax]</td>
				<td><center>$DDtlThisOther[InfantPax]</td>
				<td>$DDtlThisOther[BookSts]</td>
				<td>$DDtlThisOther[ReasonCancel]</td>";
				
				if($DDtlThisOther[BookingPlace]!=''){echo"<td>Pameran</td>";}
				else{echo"<td></td>";}
				 echo"</tr>";
			$Adult=$Adult+$DDtlThisOther[AdultPax];
			$Child=$Child+$DDtlThisOther[ChildPax];
			$Infant=$Infant+$DDtlThisOther[InfantPax];
			$No++;
			}
	
		echo"<tr><th colspan=5;>SubTotal</th><th>$Adult</th><th>$Child</th><th>$Infant</th><th></th><th colspan=2></th></tr>";
			$TAdult=$TAdult+$Adult;
			$TChild=$TChild+$Child;
			$TInfant=$TInfant+$Infant;
	}
	
	


	
	
	$QDtlOtherProd=mysql_query("Select *,tour_msbooking.Tourcode as BookTourCode from tour_msbooking inner join tour_msproduct on tour_msbooking.IDTourcode=tour_msproduct.IDProduct where (TCCompanyID=$CompanyID and tour_msproduct.CompanyID<>$CompanyID) and DUMMY='NO' and BookingStatus='DEPOSIT' and  (date($Baseon)='$Start')  and tour_msproduct.status<>'VOID' and tour_msbooking.Status ='ACTIVE' order by BookingID");	
	
	$Adult=0;
	$Child=0;
	$Infant=0;
	
	$jumdata = mysql_num_rows($QDtlOtherProd);
	
	if($jumdata >0)
	{
	echo"<tr><td colspan=11;><strong>OTHERS PRODUCT</strong></td></tr>";
	while($DDtlThisOtherProd=mysql_fetch_array($QDtlOtherProd)){
		
		
		echo"<tr><td>$No</td>
			<td>$DDtlThisOtherProd[BookingID]</td>
			<td>$DDtlThisOtherProd[BookTourCode]</td>
			<td>$DDtlThisOtherProd[TCName]</td>
			<td>$DDtlThisOtherProd[TCDivision]</td>
			<td><center>$DDtlThisOtherProd[AdultPax]</td>
			<td><center>$DDtlThisOtherProd[ChildPax]</td>
			<td><center>$DDtlThisOtherProd[InfantPax]</td>
			<td>$DDtlThisOtherProd[BookSts]</td>
			<td>$DDtlThisOtherProd[ReasonCancel]</td>";
			
			if($DDtlThisOtherProd[BookingPlace]!=''){echo"<td>Pameran</td>";}
			else{echo"<td></td>";}
			 echo"</tr>";
		$Adult=$Adult+$DDtlThisOtherProd[AdultPax];
		$Child=$Child+$DDtlThisOtherProd[ChildPax];
		$Infant=$Infant+$DDtlThisOtherProd[InfantPax];
		$No++;
	}

	echo"<tr><th colspan=5;>SubTotal</th><th>$Adult</th><th>$Child</th><th>$Infant</th><th></th><th colspan=2></th></tr>";
	$TAdult=$TAdult+$Adult;
	$TChild=$TChild+$Child;
	$TInfant=$TInfant+$Infant;
	}

	echo"<tr><th colspan=5;>GrandTotal</th><th>$TAdult</th><th>$TChild</th><th>$TInfant</th><th></th><th colspan=2></th></tr>";
	
	
	
	
	
	echo"</table>";				
					
	
	$QDtlDateCancel=mysql_query("Select *,tour_msbooking.Tourcode as BookTourCode from tour_msbooking inner join tour_msproduct on tour_msbooking.IDTourcode=tour_msproduct.IDProduct where (TCCompanyID=$CompanyID and tour_msproduct.CompanyID=$CompanyID) and DUMMY='NO' and BookingStatus='DEPOSIT' and  (date($Baseon)='$Start')  and tour_msproduct.status<>'VOID' and tour_msbooking.Status ='VOID' order by BookingID");	
	
	$No=1;
	$AdultCancel=0;
	$ChildCancel=0;
	$InfantCancel=0;
		
	echo"<table>
		 <tr><td colspan=11;><strong>CANCEL BOOKING</strong></td></tr>
		<tr><th>No</th><th>Booking ID</th><th>Tour Code</th><th>TC</th><th>Divisi</th><th>Adult</th><th>Child</th><th>Infant</th><th>Status</th><th>Remarks</th><th>Event</th></tr>";
	
	$jumdata = mysql_num_rows($QDtlDateCancel);
	
	if($jumdata >0)
	{
	while($DDtlThisCancel=mysql_fetch_array($QDtlDateCancel)){
		
		echo"<tr><td>$No</td>
			<td>$DDtlThisCancel[BookingID]</td>
			<td>$DDtlThisCancel[BookTourCode]</td>
			<td>$DDtlThisCancel[TCName]</td>
			<td>$DDtlThisCancel[TCDivision]</td>
			<td><center>$DDtlThisCancel[AdultPax]</td>
			<td><center>$DDtlThisCancel[ChildPax]</td>
			<td><center>$DDtlThisCancel[InfantPax]</td>
			<td>$DDtlThisCancel[BookSts]</td>
			<td>$DDtlThisCancel[ReasonCancel]</td>";
			
			if($DDtlThisCancel[BookingPlace]!=''){echo"<td>Pameran</td>";}
			else{echo"<td></td>";}
			 echo"</tr>";
		$AdultCancel=$AdultCancel+$DDtlThisCancel[AdultPax];
		$ChildCancel=$ChildCancel+$DDtlThisCancel[ChildPax];
		$InfantCancel=$InfantCancel+$DDtlThisCancel[InfantPax];
		$No++;
	}
	
	$TAdultCancel=$TAdultCancel+$AdultCancel;
	$TChildCancel=$TChildCancel+$ChildCancel;
	$TInfantCancel=$TInfantCancel+$InfanCancelt;
	
	echo"<tr><th colspan=5;>SubTotal</th><th>$TAdultCancel</th><th>$TChildCancel</th><th>$TInfantCancel</th><th></th><th colspan=2></th></tr>";
	}

	
	$QDtlOTHERCancel=mysql_query("Select *,tour_msbooking.Tourcode as BookTourCode from tour_msbooking inner join tour_msproduct on tour_msbooking.IDTourcode=tour_msproduct.IDProduct where (TCCompanyID<>$CompanyID and tour_msproduct.CompanyID=$CompanyID) and DUMMY='NO' and BookingStatus='DEPOSIT' and  (date($Baseon)='$Start')  and tour_msproduct.status<>'VOID' and tour_msbooking.Status ='VOID' order by BookingID");	
	
	$AdultCancel=0;
	$ChildCancel=0;
	$InfantCancel=0;
	
	$jumdata = mysql_num_rows($QDtlOTHERCancel);
	
	if($jumdata >0)
	{
	echo"<tr><td colspan=11;><strong>SISTER COMPANY / FRANCHISE</strong></td></tr>";
	while($DDtlThisOtherCancel=mysql_fetch_array($QDtlOTHERCancel)){
	
		
		echo"<tr><td>$No</td>
			<td>$DDtlThisOtherCancel[BookingID]</td>
			<td>$DDtlThisOtherCancel[BookTourCode]</td>
			<td>$DDtlThisOtherCancel[TCName]</td>
			<td>$DDtlThisOtherCancel[TCDivision]</td>
			<td><center>$DDtlThisOtherCancel[AdultPax]</td>
			<td><center>$DDtlThisOtherCancel[ChildPax]</td>
			<td><center>$DDtlThisOtherCancel[InfantPax]</td>
			<td>$DDtlThisOtherCancel[BookSts]</td>
			<td>$DDtlThisOtherCancel[ReasonCancel]</td>";
			
			if($DDtlThisOtherCancel[BookingPlace]!=''){echo"<td>Pameran</td>";}
			else{echo"<td></td>";}
			 echo"</tr>";
		$AdultCancel=$AdultCancel+$DDtlThisOtherCancel[AdultPax];
		$ChildCancel=$ChildCancel+$DDtlThisOtherCancel[ChildPax];
		$InfantCancel=$InfantCancel+$DDtlThisOtherCancel[InfantPax];
		$No++;
	}

	echo"<tr><th colspan=5;>SubTotal</th><th>$AdultCancel</th><th>$ChildCancel</th><th>$InfantCancel</th><th></th><th colspan=2></th></tr>";
	$TAdultCancel=$TAdultCancel+$AdultCancel;
	$TChildCancel=$TChildCancel+$ChildCancel;
	$TInfantCancel=$TInfantCancel+$InfantCancel;
	
	}
	

	
	
	
	$QDtlOtherProdCancel=mysql_query("Select *,tour_msbooking.Tourcode as BookTourCode from tour_msbooking inner join tour_msproduct on tour_msbooking.IDTourcode=tour_msproduct.IDProduct where (TCCompanyID=$CompanyID and tour_msproduct.CompanyID<>$CompanyID) and DUMMY='NO' and BookingStatus='DEPOSIT' and  (date($Baseon)='$Start')  and tour_msproduct.status<>'VOID' and tour_msbooking.Status ='VOID' order by BookingID");	
	

	$AdultCancel=0;
	$ChildCancel=0;
	$InfantCancel=0;
	
	$jumdata = mysql_num_rows($QDtlOtherProdCancel);
	
	if($jumdata >0)
	{
	
	echo"<tr><td colspan=11;><strong>OTHERS PRODUCT</strong></td></tr>";
	while($DDtlThisOtherProdCancel=mysql_fetch_array($QDtlOtherProdCancel)){
		
		
		echo"<tr><td>$No</td>
			<td>$DDtlThisOtherProdCancel[BookingID]</td>
			<td>$DDtlThisOtherProdCancel[BookTourCode]</td>
			<td>$DDtlThisOtherProdCancel[TCName]</td>
			<td>$DDtlThisOtherProdCancel[TCDivision]</td>
			<td><center>$DDtlThisOtherProdCancel[AdultPax]</td>
			<td><center>$DDtlThisOtherProdCancel[ChildPax]</td>
			<td><center>$DDtlThisOtherProdCancel[InfantPax]</td>
			<td>$DDtlThisOtherProdCancel[BookSts]</td>
			<td>$DDtlThisOtherProdCancel[ReasonCancel]</td>";
			
			if($DDtlThisOtherProdCancel[BookingPlace]!=''){echo"<td>Pameran</td>";}
			else{echo"<td></td>";}
			 echo"</tr>";
		$AdultCancel=$AdultCancel+$DDtlThisOtherProdCancel[AdultPax];
		$ChildCancel=$ChildCancel+$DDtlThisOtherProdCancel[ChildPax];
		$InfantCancel=$InfantCancel+$DDtlThisOtherProdCancel[InfantPax];
		$No++;
	}

	echo"<tr><th colspan=5;>SubTotal</th><th>$AdultCancel</th><th>$ChildCancel</th><th>$InfantCancel</th><th></th><th colspan=2></th></tr>";
	$TAdultCancel=$TAdultCancel+$AdultCancel;
	$TChildCancel=$TChildCancel+$ChildCancel;
	$TInfantCancel=$TInfantCancel+$InfantCancel;
	}

	echo"<tr><th colspan=5;>GrandTotal</th><th>$TAdultCancel</th><th>$TChildCancel</th><th>$TInfantCancel</th><th></th><th colspan=2></th></tr>";
	
	
	
	
	
	echo"</table><br>
	<center><input type=button value=Close onclick=self.history.back()><br><br>";   
					
	break;
	

	
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/
	
	case "showdeposit":

    if($_Get[Type]=='DateTravelFrom'){
	
    $tampil=mysql_query("SELECT * FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode   
                                WHERE IDTourcode = '$_GET[ID]'  and
                               (TCCompanyID=$CompanyID or tour_msproduct.CompanyID=$CompanyID) and DUMMY='NO'  and BookingStatus='DEPOSIT' and  tour_msproduct.datetravelfrom >= '$_GET[Start]' and datetravelfrom <= '$_GET[End]' ORDER BY BookingID ASC ");  
    }
	else
	{
	    $tampil=mysql_query("SELECT * FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode   
                                WHERE IDTourcode = '$_GET[ID]'  and
                               (TCCompanyID=$CompanyID or tour_msproduct.CompanyID=$CompanyID) and DUMMY='NO'  and BookingStatus='DEPOSIT' and DATE(tour_msbooking.bookingdate) >= '$_GET[Start]' and DATE(bookingdate) <= '$_GET[End]' ORDER BY TCDivision, BookingID ASC ");

	}
	
                 
                  $no=1;
                    while ($data=mysql_fetch_array($tampil)){
					if($no==1){
					 echo "  <h2>Deposit Detail - Product: $date[Tourcode]</h2> 
                    <table>   
                    <tr><th>no</th><th>Booking ID</th><th>TourCode</th><th width=150>Bookers</th><th>tc name</th><th>divisi</th><th>Booking date</th><th>adult</th><th>child</th><th>infant</th><th>cancel</th><th>Total Price</th></tr>"; }
					
                    $qprod=mysql_query("SELECT * FROM tour_msproduct   
                                WHERE IDProduct = '$data[IDTourcode]'");
                    $hqprod=mysql_fetch_array($qprod); 
                    
                    $tampil2=mysql_query("SELECT * ,sum(if((Package<>'L.A Only'),1,0)) as LA ,sum(if((Status = 'CANCEL'),1,0)) as cancel FROM tour_msbookingdetail   
                                WHERE IDTourCode = '$data[IDTourCode]'
                                AND BookingID = '$data[BookingID]' group by BookingID");
	 $details=mysql_fetch_array($tampil2); 
	 $hargapajak=($data[AdultPax]+$data[ChildPax]-$details[LA])*$hqprod[TaxInsSell];           
     $hargakotor=$data[TotalPrice]+$hargapajak;                                                                                                      
               echo "<tr><td>$no</td>
                     <td>$data[BookingID]";    
                     $edit1=mysql_query("SELECT count(IDDetail)as bnyk FROM tour_msbookingdetail WHERE BookingID ='$data[BookingID]' and Gender <> 'INFANT' and Status <> 'CANCEL' ");  
                     $r2=mysql_fetch_array($edit1);
                     if($data[DepositNo]=='' || $data[DepositAmount]=='0.00' || $data[DepositDate]=='0000-00-00'){
                     $totalinq = $data[AdultPax] + $data[ChildPax];
                     }else{$totalinq = $r2[bnyk];}
                     if($data[FBTNo]==''){$bisa="enabled";$lin="?module=opbookingdetail&act=editdetail&code=$data[BookingID]";}else{$bisa="disabled";$lin="?module=opbookingdetail&act=editdetails&code=$data[BookingID]";}
                     if($data[TCDivision]=='LTM'){$diva='THO';$tcalias=$data[TCNameAlias];}else{$diva=$data[TCDivision];$tcalias=$data[TCName];}
                     echo"              
                     </td></td>
                     <td>$data[TourCode]</td>                                   
                     <td>$data[BookersName]</td>
                     <td><center>$tcalias</td>
                     <td><center>$diva</td>
                     <td><center>".date("d-M-Y",strtotime($data[BookingDate]))."</td>     
                     <td><center>$data[AdultPax]</td>
                     <td><center>$data[ChildPax]</td>
                     <td><center>$data[InfantPax]</td>
                     <td><center> $details[Cancel]</td>
                     <td style='text-align:right'>".number_format($hargakotor, 0, '', '.');echo"</td>   
                     </tr>";
                      $no++;
                    }
                    echo "</table><br>
                    <center><input type=button value=Close onclick=self.history.back()><br><br>";    
     break;        

}