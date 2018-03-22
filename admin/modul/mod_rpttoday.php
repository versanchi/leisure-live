<script type="text/javascript"> 
function generateexcel(tableid) {
  var table= document.getElementById(tableid);
  var html = table.outerHTML;  
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));    
}  
</script>

<?php 
switch($_GET[act]) {
	// Tampil Office
	default:
		$CompanyID=$_SESSION['company_id'];
		$blnini = date("m");
		$thnini = date("Y");
		$mont = $_GET['bulan'];
		$yer = $_GET['year'];
		$Dest = $_GET['Destination'];
		$Flight = $_GET['Flight'];
		if ($Flight == '') {
			$Flight = 'ALL';
		}
		$Department = $_GET['Department'];
		if ($Department == '') {
			$Department = 'ALL';
		}
		$grptype = $_GET['grptype'];
		if ($mont == '') {
			$mont = $blnini;
		}
		if ($yer == '') {
			$yer = $thnini;
		}
		if ($Dest == '') {
			$Dest = 'ALL';
		}
		echo "<h2>Daily Status</h2>
          <form method='get' action='media.php?'><input type=hidden name=module value='rpttoday'> ";
		echo "Month &nbsp : <select name='bulan' >
					  <option value='01'";
		if ($mont == '01') {
			echo "selected";
		}
		echo ">JAN</option>
                      <option value='02'";
		if ($mont == '02') {
			echo "selected";
		}
		echo ">FEB</option>
					  <option value='03'";
		if ($mont == '03') {
			echo "selected";
		}
		echo ">MAR</option>
					  <option value='04'";
		if ($mont == '04') {
			echo "selected";
		}
		echo ">APR</option>
                      <option value='05'";
		if ($mont == '05') {
			echo "selected";
		}
		echo ">MAY</option>
					  <option value='06'";
		if ($mont == '06') {
			echo "selected";
		}
		echo ">JUN</option>
					  <option value='07'";
		if ($mont == '07') {
			echo "selected";
		}
		echo ">JUL</option>
                      <option value='08'";
		if ($mont == '08') {
			echo "selected";
		}
		echo ">AUG</option>
					  <option value='09'";
		if ($mont == '09') {
			echo "selected";
		}
		echo ">SEP</option>
					  <option value='10'";
		if ($mont == '10') {
			echo "selected";
		}
		echo ">OCT</option>
                      <option value='11'";
		if ($mont == '11') {
			echo "selected";
		}
		echo ">NOV</option>
					  <option value='12'";
		if ($mont == '12') {
			echo "selected";
		}
		echo ">DEC</option>
                      </select>
              &nbsp &nbsp Year    :  <select name='year' ><option value='0' >- Select Year -</option>";
		$tampil = mysql_query("SELECT Year FROM tour_msproduct where year <>'' and CompanyID=$CompanyID group BY Year asc");
		while ($s = mysql_fetch_array($tampil)) {  // <input type='button' value='Cek Seat' onclick=ceking() >
			if ($yer == $s[Year]) {
				echo "<option value='$s[Year]' selected>$s[Year]</option>";
			} else {
				echo "<option value='$s[Year]' >$s[Year]</option>";
			}
		}
		echo "</select> <br>";
		echo "<br>Product :  <select name='Destination' id='Destination'>";

		$tampilDest = mysql_query("SELECT distinct Destination FROM  tour_msproduct where destination<>'' and destination<>'0' and CompanyID=$CompanyID order by Destination ASC");
		echo "<option value='ALL'>ALL DESTINATION</option>";
		while ($sDest = mysql_fetch_array($tampilDest)) {
			if ($Dest == $sDest[Destination]) {
				echo "<option value='$sDest[Destination]' selected>$sDest[Destination]</option>";
			} else {
				echo "<option value='$sDest[Destination]'>$sDest[Destination]</option>";
			}

		}
		echo "</select>
    Flight :  <select name='Flight'>";

		$tampilFlight = mysql_query("SELECT distinct Flight FROM  tour_msproduct where Flight <> '' and Flight <> '0' and CompanyID=$CompanyID order by Flight ASC");
		echo "<option value='ALL'>ALL Flight</option>";
		while ($sFlight = mysql_fetch_array($tampilFlight)) {
			if ($Flight == $sFlight[Flight]) {
				echo "<option value='$sFlight[Flight]' selected>$sFlight[Flight]</option>";
			} else {
				echo "<option value='$sFlight[Flight]'>$sFlight[Flight]</option>";
			}

		}
		echo "</select>
	 Department :  <select name='Department'>";

		$tampilDept = mysql_query("SELECT distinct GroupType FROM  tour_msproduct where GroupType <> '' and GroupType <> '0' and CompanyID=$CompanyID order by GroupType ASC");
		echo "<option value='ALL'>ALL Department</option>";
		while ($sDept = mysql_fetch_array($tampilDept)) {
			if ($Department == $sDept[GroupType]) {
				echo "<option value='$sDept[GroupType]' selected>$sDept[GroupType]</option>";
			} else {
				echo "<option value='$sDept[GroupType]'>$sDept[GroupType]</option>";
			}

		}
		echo "</select>
              <input type=submit name='submit' size='20'value='View'>
          </form>";
		$oke = $_GET['oke'];

		if ($mont == '01') {
			$montText = 'JAN';
		}
		if ($mont == '02') {
			$montText = 'FEB';
		}
		if ($mont == '03') {
			$montText = 'MAR';
		}
		if ($mont == '04') {
			$montText = 'APR';
		}
		if ($mont == '05') {
			$montText = 'MAY';
		}
		if ($mont == '06') {
			$montText = 'JUN';
		}
		if ($mont == '07') {
			$montText = 'JUL';
		}
		if ($mont == '08') {
			$montText = 'AUG';
		}
		if ($mont == '09') {
			$montText = 'SEP';
		}
		if ($mont == '10') {
			$montText = 'OCT';
		}
		if ($mont == '11') {
			$montText = 'NOV';
		}
		if ($mont == '12') {
			$montText = 'DEC';
		}


		//Mulai Table
		//Query tidak memunculkan tourcode yang kosong dan yang tidak terjual
		if ($Flight == 'ALL') {
			$qflight = '';
		} else {
			$qflight = "AND Flight='$Flight'";
		}
		if ($Department == 'ALL') {
			$qDepart = '';
		} else {
			$qDepart = "AND GroupType='$Department'";
		}

		if ($Dest == 'ALL') {
			$QProduct = mysql_query("SELECT * FROM tour_msproduct where (tour_msproduct.Status = 'PUBLISH' or SeatDeposit >0 ) and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and TourCode<>'' and GroupType<>'TMR' and CompanyID=$CompanyID and (StatusProduct <>'CLOSE' or SeatDeposit >0  ) $qflight $qDepart order by Destination,GroupType,ProductCode,DateTravelFrom asc");
		/*	$QProductTMR = mysql_query("SELECT * FROM tour_msproduct  where(tour_msproduct.Status = 'PUBLISH' or SeatDeposit >0 ) and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and TourCode<>'' and GroupType='TMR' and CompanyID=$CompanyID and (StatusProduct <>'CLOSE' or SeatDeposit >0 ) $qflight $qDepart order by Destination,GroupType,ProductCode,DateTravelFrom asc");*/
		} else {
			$QProduct = mysql_query("SELECT * FROM tour_msproduct  where (tour_msproduct.Status = 'PUBLISH' or SeatDeposit >0 ) and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and Destination='$Dest'  and  TourCode<>'' and GroupType<>'TMR' and CompanyID=$CompanyID  and (StatusProduct <>'CLOSE' or SeatDeposit >0 )  $qflight $qDepart order by Destination,GroupType,ProductCode,DateTravelFrom asc");
		
		}

		$TotalSeat = 0;
		$TotalBooking = 0;
		$TotalDum = 0;


		$desbefore = 'awal';
		$PCbefore = 'awal';

		$Products = mysql_num_rows($QProduct);

		if ($Products > 0) {
			echo "<b>UPDATE STATUS $montText - $yer</b><br>";
			$TPax = 0;
			$TSales = 0;
			//Query bukan TMR


			echo " <table class='bordered' id='dailystatus'>";

			while ($DProduct = mysql_fetch_array($QProduct)) {

				if ($DProduct[ProductFor] == 'ALL') {
					$Dep = $DProduct[Department];
				} else {
					$Dep = $DProduct[ProductFor];
				}

				if ($desbefore <> $DProduct[Destination]) {
					echo "<tr><td colspan=20 style=font-size:15px><b><center>$DProduct[Destination]</center></b></td></tr>
	  		
			
			  
				  
	<tr><th>Tour Name</th><th>Tour Code</th><th>Airlines</th><th>Department</th><th>Departure</th><th> Seat</th><th>Pax</th><th>Dummy</th><th>Available</th><th>LA only</th><th>Hold</th><th>Price</th><th>Disc</th><th>Tax</th><th>Incentive</th><th colspan=2>Flight</th><th colspan=2>Status</th><th>Remarks</th></tr>";
					$desbefore = $DProduct[Destination];
					$Typebefore = 'awal';
				}

				if ($Typebefore <> $DProduct[GroupType]) {
					echo "<tr><td colspan=20; font-size=24px;><strong>$DProduct[GroupType]</strong></td></tr>";
					$Typebefore = $DProduct[GroupType];
					if ($PCbefore = $DProduct[ProductCode]) {
						$PCbefore = 'awal';
					}
				}


				if ($PCbefore <> $DProduct[ProductCode]) {


					$QPC = mysql_query("SELECT count(IDProduct) as JumProduct FROM `tour_msproduct` where (tour_msproduct.Status = 'PUBLISH' or SeatDeposit >0 ) and tour_msproduct.ProductCode='$DProduct[ProductCode]' and month(DateTravelFrom)='$mont' and  year(DateTravelFrom)='$yer' and TourCode<>'' and Destination='$DProduct[Destination]' and (StatusProduct <>'CLOSE' or SeatDeposit >0) and CompanyID=$CompanyID  and GroupType='$DProduct[GroupType]' $qflight group by ProductCode");
					$TPC = mysql_fetch_array($QPC);
					echo "<tr><td rowspan='$TPC[JumProduct]'; style=vertical-align:middle><center>$DProduct[ProductCodeName]</td>";
					$PCbefore = $DProduct[ProductCode];
				}

				$QBookingan = mysql_query("SELECT IDTourCode,sum(if(DUMMY = 'NO' ,(AdultPax+ChildPax),0)) as pax,sum(if(DUMMY = 'YES' ,(AdultPax+ChildPax),0)) as DumPax ,sum(if(BookingStatus='HOLD' ,(AdultPax+ChildPax),0)) as HoldPax FROM tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  (tour_msbooking.BookingStatus='DEPOSIT' or  tour_msbooking.BookingStatus='HOLD') and IDTourCode='$DProduct[IDProduct]'  group by IDTourCode");

				$Booking = mysql_num_rows($QBookingan);
				$DBooking = mysql_fetch_array($QBookingan);

				//LA only
				$QLA = mysql_query("SELECT * FROM tour_msbookingdetail where IDTourCode='$DProduct[IDProduct]' and tour_msbookingdetail.status <>'CANCEL' and Package='L.A Only' ");

				$BookingLA = mysql_num_rows($QLA);
				//xxxxxxxxxxxxxxxxxx

				//merubah format tampilan ke currency
				if ($DProduct[GroupType] == 'CRUISE') {
					$Selling = number_format($DProduct[CruiseAdl12], 0, ',', '.');
				} else {
					$Selling = number_format($DProduct[SellingAdlTwn], 0, ',', '.');
				}
				$Tax = number_format($DProduct[TaxInsSell], 0, ',', '.');
				$new_date = substr($DProduct[DateTravelFrom], 8, 2);
				$Incentive = number_format($DProduct[Incentive], 0, ',', '.');

				//vili
				$QFlight = mysql_query("select GrvID from tour_msproductpnr where PnrProd ='$DProduct[IDProduct]'");

				$TampilPNR = '';
				$TampilSeat = 0;
				$DoublePNR = 0;
				while ($DFlight = mysql_fetch_array($QFlight)) {
					$QPNR = mysql_query("SELECT * from tour_msgrv where IDGrv = '$DFlight[GrvID]'");
					$DPNR = mysql_fetch_array($QPNR);
					$TampilPNR = $TampilPNR . $DPNR[GrvPnr];
					if ($TampilSeat < $DPNR[GrvSeat] or $TampilSeat == 0) {
						$TampilSeat = $DPNR[GrvSeat];
					}
					if ($DPNR[ProductUse] > 1) {
						$DoublePNR = $DoublePNR + 1;
					}
				}


				//pewarnaan row kalau status close
				if ($DoublePNR >= 1) {
					$Tulisan = "font color='#FF00D2'";
					$warna = "BGCOLOR='#F0FF00'";
				} else {
					$Tulisan = "font color='#000000'";
					$warna = "BGCOLOR='#ffffff'";
				}

				if ($DProduct[StatusProduct] == 'CLOSE' or $DProduct[StatusProduct] == 'FINALIZE') {
					$warna = "BGCOLOR='#f5bebe'";
				}
				$showitin = "?module=msitin&id=$DProduct[IDProduct]&act=showitin";
				echo "
							 <td $warna><$Tulisan><a href='$showitin' style=text-decoration:none >$DProduct[TourCode]</a></font></td>
							 <td $warna><center>$DProduct[Flight]</td>
							 <td $warna><center>$Dep</td>
							 <td $warna><center>$new_date $montText</td>
							 <td $warna><center>$DProduct[Seat]</td>	 
							 <td style='text-align:right' $warna><center>";

				if ($DBooking[pax] == 0) {
					echo "<a href=?module=group&act=showdeposit&id=$DProduct[IDProduct]>0</a>";
				} else {
					echo "<a href=?module=group&act=showdeposit&id=$DProduct[IDProduct]>$DBooking[pax]</a>";
				}


				echo "</td>
							 <td $warna><center>";
				if ($DBooking[DumPax] == 0) {
					echo "";
				} else {
					echo "$DBooking[DumPax]";
				}
				echo "</td>
							 <td $warna><center>";
				if ($DBooking[pax] == 0 and $DBooking[DumPax] == 0) {
					echo "$DProduct[Seat]";
				} else {
					$sisa = $DProduct[Seat] - ($DBooking[pax] + $DBooking[DumPax]);
					echo "$sisa";
				}
				echo "</td> <td style='text-align:right' $warna>";
				if ($BookingLA == 0) {
					echo "";
				} else {
					echo "$BookingLA";
				}

				//DISCOUNT
				$d = mysql_query("SELECT * FROM tour_msdiscount
                                   WHERE tour_msdiscount.IDProduct = '$DProduct[IDProduct]' and tour_msdiscount.Status='ACTIVE'");
				$dd = mysql_fetch_array($d);
				$julh = mysql_num_rows($d);
				$totl = $DBooking[pax] + $DBooking[DumPax];
				if ($julh > 0) {
					if ($totl <= $dd[Max1]) {
						$diskon = $dd[Disc1];
					} else if ($totl <= $dd[Max2]) {
						$diskon = $dd[Disc2];
					} else if ($totl <= $dd[Max3]) {
						$diskon = $dd[Disc3];
					} else if ($totl <= $dd[Max4]) {
						$diskon = $dd[Disc4];
					} else if ($totl <= $dd[Max5]) {
						$diskon = $dd[Disc5];
					} else if ($totl <= $dd[Max6]) {
						$diskon = $dd[Disc6];
					} else if ($totl <= $dd[Max7]) {
						$diskon = $dd[Disc7];
					} else $diskon = '0';
					if ($diskon == '') {
						$diskon = '0';
					}
				} else {
					$diskon = '0';
				}

				echo "</td><td style='text-align:right' $warna>";
				if ($DBooking[HoldPax] == 0) {
					echo "";
				} else {
					echo "$DBooking[HoldPax]";
				}
				echo "</td><td style='text-align:right' $warna>$Selling</td>
									 <td style='text-align:right' $warna>" . number_format($diskon, 0, ',', '.') . "</td>
									 <td style='text-align:right' $warna>$Tax</td>
									 <td style='text-align:right' $warna>";
				if ($DProduct[Incentive] <> '') {
					echo "$DProduct[IncentiveCurr] $Incentive";
				}
				echo "</td>";

				echo "<td $warna><center>$TampilPNR</td>
									 <td $warna><center>";
				if ($TampilSeat == 0) {
					echo "";
				} else {
					echo "$TampilSeat";
				}
				echo "</td>
									 <td $warna><center>$DProduct[StatusProduct]</td>
									 <td $warna><center>$DProduct[Status]</td>
									 <td $warna>$DProduct[Remarks]</td>";
				$TotalSeat = $TotalSeat + $DProduct[Seat];
				$TotalBooking = $TotalBooking + $DBooking[pax];
				$TotalDum = $TotalDum + $DBooking[DumPax];

				echo "</tr>";
			};

			$TotalSisa = $TotalSeat - ($TotalBooking + $TotalDum);
			echo "<tr><td colspan=5><Center><b>Total</td>
					 <td><Center><b>$TotalSeat</td>
					 <td><Center><b>$TotalBooking</td>
					 <td><Center><b>$TotalDum</td>
					 <td><Center><b>$TotalSisa</td>
					 <td colspan=11></td></tr>";

			echo "</table>
			<table class='bordered'>
			<tr><td colspan='3' style='font-size:10px border: 0px solid #000000; '>Note:</td></tr>
	 		<tr><td style='font-size:10px border: 0px solid #000000; background-color:#F0FF00; color:#FF00D2;'>TEXT</td><td>:</td><td>Double PNR</td></tr>
			<tr><td style='font-size:10px border: 0px solid #000000; background-color:#f5bebe;'>TEXT</td><td> : </td><td>Product Close</td></tr>
			<table>";

			echo "<br><center><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('dailystatus')>";
		} else {
			echo "<center>- NO PRODUCT FOUND -</center>";
		}

		break;
}
?>
