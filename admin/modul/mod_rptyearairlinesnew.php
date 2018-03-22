<SCRIPT LANGUAGE="Javascript" SRC="FusionChartsXT/Code/FusionCharts/FusionCharts.js"></SCRIPT>
<link href="./css/fixedheadertable.css" rel="stylesheet" media="screen" />
<link href="./css/custom.css" rel="stylesheet" media="screen" />
<!--<script src="./js/jquery-1.7.2.min.js"></script>-->
<script src="./js/jquery.fixedheadertable.js"></script>

<script type="text/javascript">

	$(document).ready(function() {
		$('#myDemoTable').fixedHeaderTable({
			altClass : 'odd',
			footer : true,
			fixedColumns : 2
		});
	});
	
	$(document).ready(function() {
		$('#DetailAirlines').fixedHeaderTable({
			altClass : 'odd',
			footer : true,
			fixedColumns : 2
		});
	});

</script>
<?php
$CompanyID=$_SESSION['company_id'];
switch($_GET[act]){
  // Tampilan header
   default:
    $thnini = date("Y");
    $yer=$_GET['year'];
	
	$Rank=$_GET['RankAirlines'];
    if($yer==''){$yer=$thnini;}
    if($Rank==''){$Rank='10';}
    echo "<h2>Report by Airlines by PNR</h2>
			   	
    <form method='get' action='media.php?'><input type=hidden name=module value='rptyearairlinesnew'>   
		      
    Year <select name='year' ><option value='0' >- Select Year -</option>";
    $tampil=mysql_query("SELECT distinct Year(datetravelfrom) as Yer FROM tour_msproduct where Year(datetravelfrom)<>'1970' and CompanyID=$CompanyID order BY yer asc");
            while($s=mysql_fetch_array($tampil)){  // <input type='button' value='Cek Seat' onclick=ceking() >
               if($yer==$s[Yer]){
                    echo "<option value='$s[Yer]' selected>$s[Yer]</option>";     
                }else { 
                echo "<option value='$s[Yer]' >$s[Yer]</option>";
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
	$Booking=mysql_query("SELECT GrvAirlines,  
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=1),1,0)) as JanLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=2),1,0)) as FebLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=3),1,0)) as MarLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=4),1,0)) as AprLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=5),1,0)) as MayLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=6),1,0)) as JunLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=7),1,0)) as JulLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=8),1,0)) as AgtLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=9),1,0)) as SepLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=10),1,0)) as OctLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=11),1,0)) as NovLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=12),1,0)) as DecLast ,
		
		sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,1,0)) as TotalLast 
	FROM tour_msbookingdetail inner join tour_msproductpnr on tour_msproductpnr.pnrProd=tour_msbookingdetail.IDTourCode inner join tour_msproduct on tour_msproduct.IDProduct= tour_msbookingdetail.IDTourCode
inner join tour_msgrv on tour_msproductpnr.GrvID=tour_msgrv.IDGrv
where tour_msbookingdetail.status<>'CANCEL' and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.Status<>'VOID' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and package<>'L.A Only' and tour_msproduct.CompanyID=$CompanyID
Group by GrvAirlines order by TotalNow desc");}else
	{
	$Booking=mysql_query("SELECT GrvAirlines,  
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=1),1,0)) as JanLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=2),1,0)) as FebLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=3),1,0)) as MarLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=4),1,0)) as AprLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=5),1,0)) as MayLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=6),1,0)) as JunLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=7),1,0)) as JulLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=8),1,0)) as AgtLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=9),1,0)) as SepLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=10),1,0)) as OctLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=11),1,0)) as NovLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=12),1,0)) as DecLast ,
		
		sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,1,0)) as TotalLast 
	FROM tour_msbookingdetail inner join tour_msproductpnr on tour_msproductpnr.pnrProd=tour_msbookingdetail.IDTourCode inner join tour_msproduct on tour_msproduct.IDProduct= tour_msbookingdetail.IDTourCode
	inner join tour_msgrv on tour_msproductpnr.GrvID=tour_msgrv.IDGrv
	where tour_msbookingdetail.status<>'CANCEL' and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.Status<>'VOID' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and package<>'L.A Only' and tour_msproduct.CompanyID=$CompanyID
	Group by GrvAirlines order by TotalNow desc limit $Rank");}
	
	$JumBooking = mysql_num_rows($Booking);
	
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
	if ($JumBooking > 0) {

		// munculin table
		$No = 1;
		$Total = 0;
//vili
		echo "<div class='outerbox'>
            <div class='innerbox'>
	 			<table class='bluetable' id='myDemoTable' cellpadding='0' cellspacing='0'>
	 				<thead>
	 				<tr>
					<th >No</th><th >Airlines</th>
	 				<th colspan=3>JAN</th><th colspan=3>FEB</th><th colspan=3>MAR</th><th colspan=3>APR</th><th colspan=3>MAY</th><th colspan=3>JUN</th><th colspan=3>JUL</th><th colspan=3>AGT</th><th colspan=3>SEP</th><th colspan=3>OCT</th><th colspan=3>NOV</th><th colspan=3>DEC</th><th colspan=3>TOTAL</th></tr>


					</thead><tbody>
					<tr><td style='background-color: #000000; color:#FFFFFF'></td><td style='background-color: #000000; color:#FFFFFF;'></td><td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td>
					<td style='background-color: #000000; color:#FFFFFF'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td>
					<td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td>
					<td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td>
					<td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td>
					<td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td>
					<td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td></tr>";

		while ($DPax = mysql_fetch_array($Booking)) {
			echo "
						<tr><td>$No</td>
						 <td><center><a href='?module=rptyearairlinesnew&act=Tourcodedetails&thn=$yer&Flight=$DPax[GrvAirlines]'>$DPax[GrvAirlines]<a></td>
					 <td style='text-align:right'>" . number_format($DPax[JanLast], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[JanNow], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[JanNow] / $DPax[JanLast] * 100, 0, ',', '.');
			echo "%</td>
					 					 
					 <td style='text-align:right'>" . number_format($DPax[FebLast], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[FebNow], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[FebNow] / $DPax[FebLast] * 100, 0, ',', '.');
			echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($DPax[MarLast], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[MarNow], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[MarNow] / $DPax[MarLast] * 100, 0, ',', '.');
			echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($DPax[AprLast], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[AprNow], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[AprNow] / $DPax[AprLast] * 100, 0, ',', '.');
			echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($DPax[MayLast], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[MayNow], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[MayNow] / $DPax[MayLast] * 100, 0, ',', '.');
			echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($DPax[JunLast], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[JunNow], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[JunNow] / $DPax[JunLast] * 100, 0, ',', '.');
			echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($DPax[JulLast], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[JulNow], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[JulNow] / $DPax[JulLast] * 100, 0, ',', '.');
			echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($DPax[AgtLast], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[AgtNow], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[AgtNow] / $DPax[AgtLast] * 100, 0, ',', '.');
			echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($DPax[SepLast], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[SepNow], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[SepNow] / $DPax[SepLast] * 100, 0, ',', '.');
			echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($DPax[OctLast], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[OctNow], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[OctNow] / $DPax[OctLast] * 100, 0, ',', '.');
			echo "%</td>

					 <td style='text-align:right'>" . number_format($DPax[NovLast], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[NovNow], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[NovNow] / $DPax[NovLast] * 100, 0, ',', '.');
			echo "%</td>

					 <td style='text-align:right'>" . number_format($DPax[DecLast], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[DecNow], 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($DPax[DecNow] / $DPax[DecLast] * 100, 0, ',', '.');
			echo "%</td>";

			$TotalNow = $DPax[JanNow] + $DPax[FebNow] + $DPax[MarNow] + $DPax[AprNow] + $DPax[MayNow] + $DPax[JunNow] + $DPax[JulNow] + $DPax[AgtNow] + $DPax[SepNow] + $DPax[OctNow] + $DPax[NovNow] + $DPax[DecNow];

			$TotalLast = $DPax[JanLast] + $DPax[FebLast] + $DPax[MarLast] + $DPax[AprLast] + $DPax[MayLast] + $DPax[JunLast] + $DPax[JulLast] + $DPax[AgtLast] + $DPax[SepLast] + $DPax[OctLast] + $DPax[NovLast] + $DPax[DecLast];

			echo "<td style='text-align:right'>" . number_format($TotalLast, 0, ',', '.');
			echo "</td><td style='text-align:right'>" . number_format($TotalNow, 0, ',', '.');
			if ($TotalNow < $TotalLast) {
				$warnaminus = "COLOR:red;";
			} else {
				$warnaminus = "COLOR:black";
			}
			echo "</td><td style='text-align:right;$warnaminus'>" . number_format($TotalNow / $TotalLast * 100, 0, ',', '.');
			echo "%</td></tr>";

		
			$GrandTotalNow = $GrandTotalNow + $TotalNow;
			$GrandTotalLast = $GrandTotalLast + $TotalLast;

			$GrandJanNow = $GrandJanNow + $DPax[JanNow];
			$GrandJanLast = $GrandJanLast + $DPax[JanLast];

			$GrandFebNow = $GrandFebNow + $DPax[FebNow];
			$GrandFebLast = $GrandFebLast + $DPax[FebLast];

			$GrandMarNow = $GrandMarNow + $DPax[MarNow];
			$GrandMarLast = $GrandMarLast + $DPax[MarLast];

			$GrandAprNow = $GrandAprNow + $DPax[AprNow];
			$GrandAprLast = $GrandAprLast + $DPax[AprLast];

			$GrandMayNow = $GrandMayNow + $DPax[MayNow];
			$GrandMayLast = $GrandMayLast + $DPax[MayLast];

			$GrandJunNow = $GrandJunNow + $DPax[JunNow];
			$GrandJunLast = $GrandJunLast + $DPax[JunLast];

			$GrandJulNow = $GrandJulNow + $DPax[JulNow];
			$GrandJulLast = $GrandJulLast + $DPax[JulLast];

			$GrandAgtNow = $GrandAgtNow + $DPax[AgtNow];
			$GrandAgtLast = $GrandAgtLast + $DPax[AgtLast];

			$GrandSepNow = $GrandSepNow + $DPax[SepNow];
			$GrandSepLast = $GrandSepLast + $DPax[SepLast];

			$GrandOctNow = $GrandOctNow + $DPax[OctNow];
			$GrandOctLast = $GrandOctLast + $DPax[OctLast];

			$GrandNovNow = $GrandNovNow + $DPax[NovNow];
			$GrandNovLast = $GrandNovLast + $DPax[NovLast];

			$GrandDecNow = $GrandDecNow + $DPax[DecNow];
			$GrandDecLast = $GrandDecLast + $DPax[DecLast];
			$No++;

		}
		//Total keseluruhan
		echo "<tr><td style='background-color: #000000; color:#FFFFFF;'></td><td style='background-color: #000000; color:#FFFFFF;'><center><b>TOTAL</b></center></td>
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandJanLast, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandJanNow, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000;color:#FFFFFF;'>" . number_format($GrandJanNow / $GrandJanLast * 100, 0, ',', '.');
		echo "%</td>
					 					 
					 <td style='text-align:right;background-color: #000000;color:#FFFFFF;'>" . number_format($GrandFebLast, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000;color:#FFFFFF;'>" . number_format($GrandFebNow, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000;color:#FFFFFF;'>" . number_format($GrandFebNow / $GrandFebLast * 100, 0, ',', '.');
		echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000;color:#FFFFFF;'>" . number_format($GrandMarLast, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandMarNow, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandMarNow / $GrandMarLast * 100, 0, ',', '.');
		echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandAprLast, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandAprNow, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandAprNow / $GrandAprLast * 100, 0, ',', '.');
		echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandMayLast, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandMayNow, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandMayNow / $GrandMayLast * 100, 0, ',', '.');
		echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandJunLast, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandJunNow, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandJunNow / $GrandJunLast * 100, 0, ',', '.');
		echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandJulLast, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandJulNow, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandJulNow / $GrandJulLast * 100, 0, ',', '.');
		echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandAgtLast, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandAgtNow, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandAgtNow / $GrandAgtLast * 100, 0, ',', '.');
		echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandSepLast, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandSepNow, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandSepNow / $GrandSepLast * 100, 0, ',', '.');
		echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandOctLast, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandOctNow, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandOctNow / $GrandOctLast * 100, 0, ',', '.');
		echo "%</td>

					 <td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandNovLast, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandNovNow, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandNovNow / $GrandNovLast * 100, 0, ',', '.');
		echo "%</td>

					 <td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandDecLast, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandDecNow, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandDecNow / $GrandDecLast * 100, 0, ',', '.');
		echo "%</td>";

		$GrandTotalNow = $GrandJanNow + $GrandFebNow + $GrandMarNow + $GrandAprNow + $GrandMayNow + $GrandJunNow + $GrandJulNow + $GrandAgtNow + $GrandSepNow + $GrandOctNow + $GrandNovNow + $GrandDecNow;
		$GrandTotalLast = $GrandJanLast + $GrandFebLast + $GrandMarLast + $GrandAprLast + $GrandMayLast + $GrandJunLast + $GrandJulLast + $GrandAgtLast + $GrandSepLast + $GrandOctLast + $GrandNovLast + $GrandDecLast;

		echo "<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandTotalLast, 0, ',', '.');
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>" . number_format($GrandTotalNow, 0, ',', '.');
		if ($GrandTotalNow < $GrandTotalLast) {
			$warnaminus = "COLOR:red;";
		} else {
			$warnaminus = "COLOR:black";
		}
		echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;';$warnaminus'>" . number_format($GrandTotalNow / $GrandTotalLast * 100, 0, ',', '.');echo "%</td></tr></tbody></table>
					</div>
        			<div class='clear'></div></div>";
	}
		
	else {
		echo "NO TRANSACTION AVAILABLE IN $yer";
	}
  
    break;   
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	//details
	case "Tourcodedetails":
	
	$yer=$_GET['thn'];
	$Flight=$_GET['Flight'];
  
    echo "<h2>Report Airlines  - $Flight</h2><br>";

	$Lastyear = $yer-1;	  
	echo "<h><u>Report Detail $Flight Period  $Lastyear  VS  $yer</u></h><br>";

 //munculin table
	 $No=1;
	 $Total=0;
	 
	
	$strQuerytable =mysql_query("SELECT tour_msproductcode.productcodedestination as Destination,  
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=1),1,0)) as JanLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=2),1,0)) as FebLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=3),1,0)) as MarLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=4),1,0)) as AprLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=5),1,0)) as MayLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=6),1,0)) as JunLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=7),1,0)) as JulLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=8),1,0)) as AgtLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=9),1,0)) as SepLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=10),1,0)) as OctLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=11),1,0)) as NovLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=12),1,0)) as DecLast ,
		
		sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,1,0)) as TotalLast 
	FROM tour_msbookingdetail inner join tour_msproductpnr on tour_msproductpnr.pnrProd=tour_msbookingdetail.IDTourCode inner join tour_msproduct on tour_msproduct.IDProduct= tour_msbookingdetail.IDTourCode inner join tour_msproductcode on tour_msproductcode.productcodename= tour_msproduct.productcode 
inner join tour_msgrv on tour_msproductpnr.GrvID=tour_msgrv.IDGrv
where tour_msbookingdetail.status<>'CANCEL' and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.Status<>'VOID' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and GrvAirlines='$Flight' and package<>'L.A Only'  and tour_msproduct.CompanyID=$CompanyID group by Destination");

//vili
echo "<div class='outerbox'>
            <div class='innerbox'>
	 			<table class='bluetable' id='DetailAirlines' cellpadding='0' cellspacing='0'>
	 				<thead><tr>
	 					<th style='width:5px;'>No</th><th style='width:25px; white-space: nowrap;'>Tour Code</th><th colspan=3>JAN</th><th colspan=3>FEB</th><th colspan=3>MAR</th><th colspan=3>APR</th><th colspan=3>MAY</th><th colspan=3>JUN</th><th colspan=3>JUL</th><th colspan=3>AGT</th><th colspan=3>SEP</th><th colspan=3>OCT</th><th colspan=3>NOV</th><th colspan=3>DEC</th><th colspan=4>TOTAL</th></tr></thead><tbody>
						
			<tr><th style='background-color: #000000; color:#FFFFFF;width:5px;'><font color='black'>NO</font></th><th style='background-color: #000000;width:25px;white-space: nowrap;'><font color='black'>TOUR CODE</font></th>&nbsp;<td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td></tr>";

	$No = 1;
		while ($DPax = mysql_fetch_array($strQuerytable)) {
					 $TotalNow=0;
					 $TotalLast=0;
		
				echo "<tr><td>$No</td>
						<td><center>$DPax[Destination]</td>
					 <td style='text-align:right'>".number_format($DPax[JanLast], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[JanNow], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[JanNow]/$DPax[JanLast]*100, 0, ',', '.');
					 echo"%</td>
					 					 
					 <td style='text-align:right'>".number_format($DPax[FebLast], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[FebNow], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[FebNow]/$DPax[FebLast]*100, 0, ',', '.');echo"%</td>
					 
					 <td style='text-align:right'>".number_format($DPax[MarLast], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[MarNow], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[MarNow]/$DPax[MarLast]*100, 0, ',', '.');echo"%</td>
					 
					 <td style='text-align:right'>".number_format($DPax[AprLast], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[AprNow], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[AprNow]/$DPax[AprLast]*100, 0, ',', '.');echo"%</td>
					 
					 <td style='text-align:right'>".number_format($DPax[MayLast], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[MayNow], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[MayNow]/$DPax[MayLast]*100, 0, ',', '.');echo"%</td>
					 
					 <td style='text-align:right'>".number_format($DPax[JunLast], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[JunNow], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[JunNow]/$DPax[JunLast]*100, 0, ',', '.');echo"%</td>
					 
					 <td style='text-align:right'>".number_format($DPax[JulLast], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[JulNow], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[JulNow]/$DPax[JulLast]*100, 0, ',', '.');echo"%</td>
					 
					 <td style='text-align:right'>".number_format($DPax[AgtLast], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[AgtNow], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[AgtNow]/$DPax[AgtLast]*100, 0, ',', '.');echo"%</td>
					 
					 <td style='text-align:right'>".number_format($DPax[SepLast], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[SepNow], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[SepNow]/$DPax[SepLast]*100, 0, ',', '.');echo"%</td>
					 
					 <td style='text-align:right'>".number_format($DPax[OctLast], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[OctNow], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[OctNow]/$DPax[OctLast]*100, 0, ',', '.');echo"%</td>

					 <td style='text-align:right'>".number_format($DPax[NovLast], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[NovNow], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[NovNow]/$DPax[NovLast]*100, 0, ',', '.');echo"%</td>

					 <td style='text-align:right'>".number_format($DPax[DecLast], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[DecNow], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[DecNow]/$DPax[DecLast]*100, 0, ',', '.');echo"%</td>";
					
					 $TotalNow=$DPax[JanNow]+$DPax[FebNow]+$DPax[MarNow]+$DPax[AprNow]+$DPax[MayNow]+$DPax[JunNow]+$DPax[JulNow]+$DPax[AgtNow]+$DPax[SepNow]+$DPax[OctNow]+$DPax[NovNow]+$DPax[DecNow];
				 $TotalLast=$DPax[JanLast]+$DPax[FebLast]+$DPax[MarLast]+$DPax[AprLast]+$DPax[MayLast]+$DPax[JunLast]+$DPax[JulLast]+$DPax[AgtLast]+$DPax[SepLast]+$DPax[OctLast]+$DPax[NovLast]+$DPax[DecLast];
		
					 echo"<td style='text-align:right'>".number_format($TotalLast, 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($TotalNow, 0, ',', '.');
					  if ($TotalNow<$TotalLast){$warnaminus="COLOR:#000000;;";}else{$warnaminus="COLOR:black";}	
					 echo"</td><td style='text-align:right;$warnaminus'>".number_format($TotalNow/$TotalLast*100, 0, ',', '.');echo"%</td></tr>";
						
					 $GrandTotalNow=$GrandTotalNow+$TotalNow;
  					 $GrandTotalLast=$GrandTotalLast+$TotalLast;
					  
					 $GrandJanNow=$GrandJanNow+$DPax[JanNow];
					 $GrandJanLast=$GrandJanLast+$DPax[JanLast];
					 
					 $GrandFebNow=$GrandFebNow+$DPax[FebNow];
					 $GrandFebLast=$GrandFebLast+$DPax[FebLast];
					 
					 $GrandMarNow=$GrandMarNow+$DPax[MarNow];
					 $GrandMarLast=$GrandMarLast+$DPax[MarLast];
					 
					 $GrandAprNow=$GrandAprNow+$DPax[AprNow];
					 $GrandAprLast=$GrandAprLast+$DPax[AprLast];
					 
					 $GrandMayNow=$GrandMayNow+$DPax[MayNow];
					 $GrandMayLast=$GrandMayLast+$DPax[MayLast];
					 
					 $GrandJunNow=$GrandJunNow+$DPax[JunNow];
					 $GrandJunLast=$GrandJunLast+$DPax[JunLast];
					 
					 $GrandJulNow=$GrandJulNow+$DPax[JulNow];
					 $GrandJulLast=$GrandJulLast+$DPax[JulLast];
					 
					 $GrandAgtNow=$GrandAgtNow+$DPax[AgtNow];
					 $GrandAgtLast=$GrandAgtLast+$DPax[AgtLast];
					 
					 $GrandSepNow=$GrandSepNow+$DPax[SepNow];
					 $GrandSepLast=$GrandSepLast+$DPax[SepLast];
					 
					 $GrandOctNow=$GrandOctNow+$DPax[OctNow];
					 $GrandOctLast=$GrandOctLast+$DPax[OctLast];
					 
					 $GrandNovNow=$GrandNovNow+$DPax[NovNow];
					 $GrandNovLast=$GrandNovLast+$DPax[NovLast];
					 
					 $GrandDecNow=$GrandDecNow+$DPax[DecNow];
					 $GrandDecLast=$GrandDecLast+$DPax[DecLast];
					  $No++;
					 
	 }
					 	
		//Total keseluruhan
echo "<tr><td colspan=2  style='background-color: #000000; color:#FFFFFF'><center><b>TOTAL</b></center></td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandJanLast, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandJanNow, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandJanNow/$GrandJanLast*100, 0, ',', '.');
					 echo"%</td>
					 					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandFebLast, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandFebNow, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandFebNow/$GrandFebLast*100, 0, ',', '.');echo"%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandMarLast, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandMarNow, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandMarNow/$GrandMarLast*100, 0, ',', '.');echo"%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandAprLast, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandAprNow, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandAprNow/$GrandAprLast*100, 0, ',', '.');echo"%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandMayLast, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandMayNow, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandMayNow/$GrandMayLast*100, 0, ',', '.');echo"%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandJunLast, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandJunNow, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandJunNow/$GrandJunLast*100, 0, ',', '.');echo"%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandJulLast, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandJulNow, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandJulNow/$GrandJulLast*100, 0, ',', '.');echo"%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandAgtLast, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandAgtNow, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandAgtNow/$GrandAgtLast*100, 0, ',', '.');echo"%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandSepLast, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandSepNow, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandSepNow/$GrandSepLast*100, 0, ',', '.');echo"%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandOctLast, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandOctNow, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandOctNow/$GrandOctLast*100, 0, ',', '.');echo"%</td>

					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandNovLast, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandNovNow, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandNovNow/$GrandNovLast*100, 0, ',', '.');echo"%</td>

					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandDecLast, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandDecNow, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandDecNow/$GrandDecLast*100, 0, ',', '.');echo"%</td>";

					
					 $GrandTotalNow=$GrandJanNow+$GrandFebNow+$GrandMarNow+$GrandAprNow+$GrandMayNow+$GrandJunNow+$GrandJulNow+$GrandAgtNow+$GrandSepNow+$GrandOctNow+$GrandNovNow+$GrandDecNow;
				 $GrandTotalLast=$GrandJanLast+$GrandFebLast+$GrandMarLast+$GrandAprLast+$GrandMayLast+$GrandJunLast+$GrandJulLast+$GrandAgtLast+$GrandSepLast+$GrandOctLast+$GrandNovLast+$GrandDecLast;
		
					 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandTotalLast, 0, ',', '.');
					 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>".number_format($GrandTotalNow, 0, ',', '.');
					 if ($GrandTotalNow<$GrandTotalLast){$warnaminus="COLOR:#000000;;";}else{$warnaminus="COLOR:black";}		
					 echo"</td><td style='text-align:right;$warnaminus;background-color: #000000; color:#FFFFFF'>".number_format($GrandTotalNow/$GrandTotalLast*100, 0, ',', '.');echo"%</td></tr></tbody></table></div>
        			<div class='clear'></div></div>
						<br><center><input type=button value=Close onclick=self.history.back()><br>";
	
	break;

 }        
?>
