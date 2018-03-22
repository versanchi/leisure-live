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
    $GroupType=$_GET['grouptype'];
    $startdep=$_GET['startdep'];
    if($mont==''){$mont=$blnini;}
    if($yer==''){$yer=$thnini;}
    if($Dest==''){$Dest='ALL';}
    if($GroupType==''){$GroupType='ALL';}
    if($startdep==''){$startdep='ALL';}
    echo "<h2>Price List</h2> 
          <form method='get' action='media.php?'><input type=hidden name=module value='pricelist'> ";       
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
    echo "</select>
    Type : <select name='grouptype'><option value='ALL' selected>ALL</option>";
    $gr=mysql_query("SELECT * FROM tour_msgroup where Status = 'ACTIVE' order by GroupName asc ");
                while($grp=mysql_fetch_array($gr)){
                     if($GroupType==$grp[GroupName])
                     {
                        echo"<option value='$grp[GroupName]' selected>$grp[GroupName]</option></a></li>";
                     }else{
                         echo"<option value='$grp[GroupName]'>$grp[GroupName]</option></a></li>";
                     }
                }
    echo "</select><br>";
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
        From : <select name='startdep'><option value='ALL' selected>ALL</option>";
    $sd=mysql_query("SELECT * FROM tour_msproduct where StartDeparture <> '' group by StartDeparture order by StartDeparture asc ");
                while($sdep=mysql_fetch_array($sd)){
                     if($startdep==$sdep[StartDeparture])
                     {
                        echo"<option value='$sdep[StartDeparture]' selected>$sdep[StartDeparture]</option></a></li>";
                     }else{
                         echo"<option value='$sdep[StartDeparture]'>$sdep[StartDeparture]</option></a></li>";
                     }
                } 
    echo "</select> <input type=submit name='oke' size='20'value='View'>
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

	echo "<h><B>PRICE LIST $montText - $yer </B></h><br><font size='1'>*HARGA DALAM RIBUAN</font>";
    //Mulai Table
	//Query tidak memunculkan tourcode yang kosong dan yang tidak terjual
    if($startdep=='ALL'){$sdeparture='';}else{$sdeparture="StartDeparture = '$startdep' AND ";}
	if($Dest=='ALL'){
	    if($GroupType=='ALL'){
            $QProduct=mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where $sdeparture tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and TourCode<>'' and GroupType<>'TMR' and GroupType<>'CRUISE' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' and ((StatusProduct ='OPEN' OR StatusProduct ='GUARANTEE') OR StatusProduct ='GUARANTEE') and SellingCurr ='IDR' order by Destination,GroupType,ProductCode,ProductName,DateTravelFrom asc");
	        $QProductTMR=mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where $sdeparture tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and TourCode<>'' and GroupType='TMR' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' and (StatusProduct ='OPEN' OR StatusProduct ='GUARANTEE') and SellingCurr ='IDR' order by Destination,ProductCode,ProductName,GroupType,DateTravelFrom asc");
			$QProductCRUISE=mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where $sdeparture tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and TourCode<>'' and GroupType='CRUISE' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' and (StatusProduct ='OPEN' OR StatusProduct ='GUARANTEE') and SellingCurr ='IDR' order by Destination,ProductCode,ProductName,GroupType,DateTravelFrom asc");
        }else{
            $QProduct=mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where $sdeparture tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and TourCode<>'' and GroupType = '$GroupType'  and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' and (StatusProduct ='OPEN' OR StatusProduct ='GUARANTEE') and SellingCurr ='IDR'  order by Destination,GroupType,ProductCode,ProductName,DateTravelFrom asc");
        }
    }
    else{
        if($GroupType=='ALL'){
	        $QProduct=mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where $sdeparture tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and Destination='$Dest'  and  TourCode<>'' and GroupType<>'TMR' and GroupType<>'CRUISE'  and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' and (StatusProduct ='OPEN' OR StatusProduct ='GUARANTEE') and SellingCurr ='IDR' order by Destination,GroupType,ProductCode,ProductName,DateTravelFrom asc");
	        $QProductTMR=mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where $sdeparture tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and Destination='$Dest'  and  TourCode<>'' and GroupType='TMR' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' and (StatusProduct ='OPEN' OR StatusProduct ='GUARANTEE') and SellingCurr ='IDR' order by Destination,ProductCode,ProductName,GroupType,DateTravelFrom asc");
			$QProductCRUISE=mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where $sdeparture tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and Destination='$Dest'  and  TourCode<>'' and GroupType='CRUISE' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' and (StatusProduct ='OPEN' OR StatusProduct ='GUARANTEE') and SellingCurr ='IDR' order by Destination,ProductCode,ProductName,GroupType,DateTravelFrom asc");
        }else{
            $QProduct=mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where $sdeparture tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and Destination='$Dest'  and  TourCode<>'' and GroupType = '$GroupType' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' and (StatusProduct ='OPEN' OR StatusProduct ='GUARANTEE') and SellingCurr ='IDR'  order by Destination,GroupType,ProductCode,ProductName,DateTravelFrom asc");
        }
    }

	$TotalSeat=0;
	$TotalBooking=0;
	$TotalDum=0;

	$desbefore='awal';
	$PCbefore='awal';
	$PCbeforeTMR='awal';
	
	$Products=mysql_num_rows($QProduct);
	
	if ($Products > 0) {

        $TPax = 0;
        $TSales = 0;
        // Query bukan TMR
        echo " <table id='dailystatus' class='bordered'>";

        if ($GroupType <> 'CRUISE') {
            while ($DProduct = mysql_fetch_array($QProduct)) {

                if ($DProduct[ProductFor] == 'ALL') {
                    $Dep = $DProduct[Department];
                } else {
                    $Dep = $DProduct[ProductFor];
                }

                if ($desbefore <> $DProduct[Destination]) {
                    echo "<tr><td colspan=17 style=font-size:15px><b><center>$DProduct[Destination]</center></b></td></tr>
    <tr><th>Tour Name</th><th>Tour Code</th><th>Airlines</th><th>Departure</th><th> Seat</th><th>Curr</th><th>Adl twn</th><th>Chd twn</th><th>chd x-bed</th><th>chd no bed</th><th>single supp</th><th>Tax</th><th>visa</th><th>visa dateline</th><th>disc</th><th>incentive</th><th>Remarks</th></tr>";
                    $desbefore = $DProduct[Destination];
                    $Typebefore = 'awal';
                }

                if ($DProduct[GroupType] == 'TUR EZ') {
                    $clor = 'GREEN';
                } else {
                    $clor = 'ORANGE';
                }
                if ($Typebefore <> $DProduct[GroupType]) {
                    echo "<tr><td colspan=17; font-size=24px; style='background-color: $clor'><strong>$DProduct[GroupType]</strong></td></tr>";
                    $Typebefore = $DProduct[GroupType];
                    $PCbefore = 'awal';
                }

                if ($PCbefore <> $DProduct[ProductCode]) {
                    $QPC = mysql_query("SELECT * FROM `tour_msproduct` where tour_msproduct.Status <> 'VOID' and tour_msproduct.ProductCode='$DProduct[ProductCode]' and month(DateTravelFrom)='$mont' and  year(DateTravelFrom)='$yer' and TourCode<>'' and Destination='$DProduct[Destination]' and (StatusProduct <>'CLOSE' or SeatDeposit >0) and GroupType='$DProduct[GroupType]' and status='PUBLISH' and (StatusProduct ='OPEN' OR StatusProduct ='GUARANTEE')");
                    $TPC = mysql_num_rows($QPC);
                    echo "<tr><td rowspan='$TPC'; style=vertical-align:middle><center>$DProduct[ProductName]</td>";
                    $PCbefore = $DProduct[ProductCode];
                }

                $QBookingan = mysql_query("SELECT IDTourCode,sum(if(TCDivision <> 'LTM' AND TCDivision <> 'LTM-TEZ' ,(AdultPax+ChildPax),0)) as pax,sum(if(TCDivision like 'LTM%' and TCDivision <> 'LTM-SA' ,(AdultPax+ChildPax),0)) as DumPax FROM tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProduct[IDProduct]'  group by IDTourCode");

                $Booking = mysql_num_rows($QBookingan);
                $DBooking = mysql_fetch_array($QBookingan);

                //LA only
                $QLA = mysql_query("SELECT * FROM tour_msbookingdetail where Bookingid in( Select Bookingid from tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProduct[IDProduct]') and tour_msbookingdetail.status <>'CANCEL' and Package='L.A Only' ");

                $BookingLA = mysql_num_rows($QLA);

                //xxxxxxxxxxxxxxxxxx

                //merubah format tampilan ke currency

                $SellingAdlTwn = number_format($DProduct[SellingAdlTwn] / 1000, 0, '', '.');
                $SellingChdTwn = number_format($DProduct[SellingChdTwn] / 1000, 0, '', '.');
                $SellingChdXbed = number_format($DProduct[SellingChdXbed] / 1000, 0, '', '.');
                $SellingChdNbed = number_format($DProduct[SellingChdNbed] / 1000, 0, '', '.');
                $SellingSingSell = number_format($DProduct[SingleSell] / 1000, 0, '', '.');
                $Tax = number_format($DProduct[TaxInsSell] / 1000, 0, '', '.');
                $Incentive = number_format($DProduct[Incentive] / 1000, 0, '', '.');

                $new_date = substr($DProduct[DateTravelFrom], 8, 2);
                //DISCOUNT
                $d = mysql_query("SELECT * FROM tour_msdiscount 
                                    left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct      
                                    WHERE tour_msproduct.IDProduct = '$DProduct[IDProduct]' and tour_msproduct.Status <> 'VOID' and tour_msdiscount.Status='ACTIVE'");
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
                //pewarnaan row kalau status close
                if (($DProduct[StatusProduct] == 'CLOSE' OR $DProduct[StatusProduct] == 'FINALIZE')) {
                    $warna = "BGCOLOR='#f5bebe'";
                } else {
                    $warna = "BGCOLOR='#ffffff'";
                }
                $file = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($DProduct['AttachmentFile']))));
                $VDL = date('d M Y', strtotime($DProduct[VisaDateline]));
                if ($DProduct[VisaDateline] == '0000-00-00' or $DProduct[VisaDateline] == '1970-01-01') {
                    $VDL = "";
                } else {
                    $VDL = "$VDL";
                }
                if ($file == '') {
                    $showitin = "?module=msitin&id=$DProduct[IDProduct]&act=showitin";
                } else {
                    //$showitin="$DProduct[Attachment]$file";
                    $showitin = "?module=msitin&id=$DProduct[IDProduct]&act=showitin";
                }
                echo "
                             <td $warna><a href='$showitin' style=text-decoration:none >$DProduct[TourCode]</a></td>
							 <td $warna><center>$DProduct[Flight]</td>   
							 <td $warna><center>$new_date $montText <br>From: $DProduct[StartDeparture]</td>
							 <td $warna><center>$DProduct[SeatSisa]</td>
                             <td $warna><center>$DProduct[SellingCurr]</td>
							 </td>
                                     <td style='text-align:right' $warna>$SellingAdlTwn</td>
                                     <td style='text-align:right' $warna>$SellingChdTwn</td>
                                     <td style='text-align:right' $warna>$SellingChdXbed</td>
                                     <td style='text-align:right' $warna>$SellingChdNbed</td>
                                     <td style='text-align:right' $warna>$SellingSingSell</td>
									 <td style='text-align:right' $warna>$Tax</td>
									 <td $warna>$DProduct[Visa] ";
                if ($DProduct[Visa] == 'INCLUDE' || $DProduct[Visa] == 'NOT INCLUDE') {
                    $tampil = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProduct[Embassy01]");
                    $s = mysql_fetch_array($tampil);
                    if ($s[Country] <> '') {
                        echo "<br>- $s[Country] ";
                    } else {
                    }
                    $tampil1 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProduct[Embassy02]");
                    $s1 = mysql_fetch_array($tampil1);
                    if ($s1[Country] <> '') {
                        echo "<br>- $s1[Country]";
                    } else {
                    }
                    $tampil2 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProduct[Embassy03]");
                    $s2 = mysql_fetch_array($tampil2);
                    if ($s2[Country] <> '') {
                        echo "<br>- $s2[Country]";
                    } else {
                    }
                    $tampil3 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProduct[Embassy04]");
                    $s3 = mysql_fetch_array($tampil3);
                    if ($s3[Country] <> '') {
                        echo "<br>- $s3[Country]";
                    } else {
                    }
                    $tampil4 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProduct[Embassy05]");
                    $s4 = mysql_fetch_array($tampil4);
                    if ($s4[Country] <> '') {
                        echo "<br>- $s4[Country]";
                    } else {
                    }
                    if ($DProduct[VisaSell] > 0) {
                        echo "<br><b> $DProduct[VisaCurr]." . number_format($DProduct[VisaSell] / 1000, 0, '', '.') . "</b>";
                    }
                    if ($DProduct[VisaSell2] > 0) {
                        echo "<b><br>$DProduct[VisaCurr2]." . number_format($DProduct[VisaSell2] / 1000, 0, '', '.') . "</b>";
                    }
                }
                echo "</td>
                                      <td $warna><center>$VDL</td>
                                      <td $warna><center>$diskon</td>
                                      <td $warna><center>";
                if ($DProduct[Incentive] <> '') {
                    echo "$DProduct[IncentiveCurr] $Incentive";
                }
                echo "</td>
									 <td $warna>$DProduct[Remarks]</td>";
                $TotalSeat = $TotalSeat + $DProduct[SeatSisa];
                $TotalBooking = $TotalBooking + $DBooking[pax] + $DBooking[DumPax];

                echo "</tr>";
            };

            $TotalSisa = $TotalSeat - ($TotalBooking + $TotalDum);
            echo "<tr><td colspan=4><Center><b>Total</td>
					 <td><Center><b>$TotalSeat</td>
					 <td colspan='12'></td></tr>";

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX			
            //TMR report
            if ($Dest == 'ALL' and $GroupType == 'ALL') {
                //filter destinasi

                $TotalSeatTMR = 0;
                $TotalBookingTMR = 0;
                $TotalDumTMR = 0;

                $ProductsTMR = mysql_num_rows($QProductTMR);

                if ($ProductsTMR > 0) {
                    echo "<tr><td colspan=17></td></tr><tr><td colspan=17; font-size=24px;><h2>TMR</h2></td></tr>
                  <tr><th>Tour Name</th><th>Tour Code</th><th>Airlines</th><th>Departure</th><th>Seat</th><th>Curr</th><th>Adl twn</th><th>Chd twn</th><th>chd x-bed</th><th>chd no bed</th><th>single supp</th><th>Tax</th><th>visa</th><th>visa dateline</th><th>disc</th><th>Incentive</th><th>Remarks</th></tr>";

                    $TPaxTMR = 0;
                    $TSalesTMR = 0;

                    while ($DProductTMR = mysql_fetch_array($QProductTMR)) {

                        if ($DProductTMR[ProductFor] == 'ALL') {
                            $DepTMR = $DProduct[Department];
                        } else {
                            $Dep = $DProductTMR[ProductFor];
                        }

                        $QBookinganTMR = mysql_query("SELECT IDTourCode,sum(if(TCDivision <> 'LTM' AND TCDivision <> 'LTM-TEZ' ,(AdultPax+ChildPax),0)) as pax,sum(if(TCDivision like 'LTM%' and TCDivision <> 'LTM-SA',(AdultPax+ChildPax),0)) as DumPax FROM tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProductTMR[IDProduct]'  group by IDTourCode");

                        $BookingTMR = mysql_num_rows($QBookinganTMR);
                        $DBookingTMR = mysql_fetch_array($QBookinganTMR);

                        //LA only
                        $QLATMR = mysql_query("SELECT * FROM tour_msbookingdetail where Bookingid in( Select Bookingid from tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProductTMR[IDProduct]') and tour_msbookingdetail.status <>'CANCEL' and Package='L.A Only'");

                        $BookingLATMR = mysql_num_rows($QLATMR);

                        //xxxxxxxxxxxxxxxxxx

                        //merubah format tampilan ke currency
                        $SellingAdlTwn = number_format($DProductTMR[SellingAdlTwn] / 1000, 0, '', '.');
                        $SellingChdTwn = number_format($DProductTMR[SellingChdTwn] / 1000, 0, '', '.');
                        $SellingChdXbed = number_format($DProductTMR[SellingChdXbed] / 1000, 0, '', '.');
                        $SellingChdNbed = number_format($DProductTMR[SellingChdNbed] / 1000, 0, '', '.');
                        $SellingSingSell = number_format($DProductTMR[SingleSell] / 1000, 0, '', '.');
                        $Tax = number_format($DProductTMR[TaxInsSell] / 1000, 0, '', '.');
                        $Incentivetmr = number_format($DProductTMR[Incentive] / 1000, 0, '', '.');
                        $new_date = substr($DProductTMR[DateTravelFrom], 8, 2);
                        //DISCOUNT
                        $d = mysql_query("SELECT * FROM tour_msdiscount 
                            left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct      
                            WHERE tour_msproduct.IDProduct = '$DProductTMR[IDProduct]' and tour_msproduct.Status <> 'VOID' and tour_msdiscount.Status='ACTIVE'");
                        $dd = mysql_fetch_array($d);
                        $julh = mysql_num_rows($d);
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
                        //pewarnaan row kalau status close
                        if (($DProductTMR[StatusProduct] == 'CLOSE')) {
                            $warna = "BGCOLOR='#f5bebe'";
                        } else {
                            $warna = "BGCOLOR='#ffffff'";
                        }
                        $VDL = date('d M Y', strtotime($DProductTMR[VisaDateline]));
                        if ($DProductTMR[VisaDateline] == '0000-00-00' or $DProductTMR[VisaDateline] == '1970-01-01') {
                            $VDL = "";
                        } else {
                            $VDL = "$VDL";
                        }
                        echo "
				     <td $warna>$DProductTMR[TourCode]</td>
					 <td $warna>$DProductTMR[TourCode]</td>
					 <td $warna><center>$DProductTMR[Flight]</td>   
					 <td $warna><center>$new_date $montText</td>
					 <td $warna><center>$DProductTMR[SeatSisa]</td>
					 <td $warna><center>$DProductTMR[SellingCurr]</td>
					 <td style='text-align:right' $warna>$SellingAdlTwn</td>
                     <td style='text-align:right' $warna>$SellingChdTwn</td>
                     <td style='text-align:right' $warna>$SellingChdXbed</td>
                     <td style='text-align:right' $warna>$SellingChdNbed</td>
                     <td style='text-align:right' $warna>$SellingSingSell</td>
					 <td style='text-align:right' $warna>$Tax</td>
					 <td $warna>$DProductTMR[Visa] ";
                        if ($DProductTMR[Visa] == 'INCLUDE' || $DProductTMR[Visa] == 'NOT INCLUDE') {
                            $tampil = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProductTMR[Embassy01]");
                            $s = mysql_fetch_array($tampil);
                            if ($s[Country] <> '') {
                                echo "<br>- $s[Country]";
                            } else {
                            }
                            $tampil1 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProductTMR[Embassy02]");
                            $s1 = mysql_fetch_array($tampil1);
                            if ($s1[Country] <> '') {
                                echo "<br>- $s1[Country]";
                            } else {
                            }
                            $tampil2 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProductTMR[Embassy03]");
                            $s2 = mysql_fetch_array($tampil2);
                            if ($s2[Country] <> '') {
                                echo "<br>- $s2[Country]";
                            } else {
                            }
                            $tampil3 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProductTMR[Embassy04]");
                            $s3 = mysql_fetch_array($tampil3);
                            if ($s3[Country] <> '') {
                                echo "<br>- $s3[Country]";
                            } else {
                            }
                            $tampil4 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProductTMR[Embassy05]");
                            $s4 = mysql_fetch_array($tampil4);
                            if ($s4[Country] <> '') {
                                echo "<br>- $s4[Country]";
                            } else {
                            }
                        }
                        echo "</td>
                     <td $warna><center>$VDL</td>
                     <td $warna><center>$diskon</td>
                     <td $warna><center>";
                        if ($DProductTMR[Incentive] <> '') {
                            echo "$DProductTMR[IncentiveCurr] $Incentivetmr";
                        }
                        echo "</td>
					 <td $warna>$DProductTMR[Remarks]</td>";
                        $TotalSeatTMR = $TotalSeatTMR + $DProductTMR[SeatSisa];
                        $TotalBookingTMR = $TotalBookingTMR + $DBookingTMR[pax] + $DBookingTMR[DumPax];

                        echo "</tr>";

                    };
                    $TotalSisaTMR = $TotalSeatTMR - ($TotalBookingTMR);
                    echo "<tr><td colspan=4><Center><b>Total</td>
			 <td><Center><b>$TotalSeatTMR</td>
			 <td colspan='12'></td></tr>";

                };    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
                //CRUISE report

                $TotalSeatCRUISE = 0;
                $TotalBookingCRUISE = 0;
                $TotalDumCRUISE = 0;

                $ProductCRUISE = mysql_num_rows($QProductCRUISE);

                if ($ProductCRUISE > 0) {
                    echo "<tr><td colspan=17></td></tr><tr><td colspan=16; font-size=24px;><h2>CRUISE</h2></td></tr>
                  <tr><th>Tour Name</th><th>Tour Code</th><th>Airlines</th><th>Departure</th><th>Seat</th><th>Curr</th><th>Adl 1-2</th><th>Adl 3-4</th><th>Chd 1-2 </th><th>Chd 3-4</th><th>single supp</th><th>Tax</th><th>Seaport Tax</th><th>visa</th><th>visa dateline</th><th>disc</th><th>Remarks</th></tr>";

                    $TPaxCRUISE = 0;
                    $TSalesCRUISE = 0;

                    while ($DProductCRUISE = mysql_fetch_array($QProductCRUISE)) {

                        if ($DProductCRUISE[ProductFor] == 'ALL') {
                            $DepCRUISE = $DProductCRUISE[Department];
                        } else {
                            $Dep = $DProductCRUISE[ProductFor];
                        }

                        $QBookinganCRUISE = mysql_query("SELECT IDTourCode,sum(if(TCDivision<>'LTM' AND TCDivision <> 'LTM-TEZ',(AdultPax+ChildPax),0)) as pax,sum(if(TCDivision like 'LTM%' and TCDivision <> 'LTM-SA',(AdultPax+ChildPax),0)) as DumPax FROM tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProductCRUISE[IDProduct]'  group by IDTourCode");

                        $BookingCRUISE = mysql_num_rows($QBookinganCRUISE);
                        $DBookingCRUISE = mysql_fetch_array($QBookinganCRUISE);

                        //LA only
                        $QLACRUISE = mysql_query("SELECT * FROM tour_msbookingdetail where Bookingid in( Select Bookingid from tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProductCRUISE[IDProduct]') and tour_msbookingdetail.status <>'CANCEL' and Package='L.A Only'");

                        $BookingLACRUISE = mysql_num_rows($QLACRUISE);

                        //xxxxxxxxxxxxxxxxxx
                        
                        //merubah format tampilan ke currency
                        $SellingAdl12 = number_format($DProductCRUISE[CruiseAdl12] / 1000, 0, '', '.');
                        $SellingAdl34 = number_format($DProductCRUISE[CruiseAdl34] / 1000, 0, '', '.');
                        $SellingChd12 = number_format($DProductCRUISE[CruiseChd12] / 1000, 0, '', '.');
                        $SellingChd34 = number_format($DProductCRUISE[CruiseChd34] / 1000, 0, '', '.');
                        $SellingSingSell = number_format($DProductCRUISE[SingleSell] / 1000, 0, '', '.');
                        $Tax = number_format($DProductCRUISE[TaxInsSell] / 1000, 0, '', '.');
                        $SeaTax = number_format($DProductCRUISE[SeaTaxSell] / 1000, 0, '', '.');
                        $new_date = substr($DProductCRUISE[DateTravelFrom], 8, 2);
                        //DISCOUNT
                        $d = mysql_query("SELECT * FROM tour_msdiscount 
                            left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct      
                            WHERE tour_msproduct.IDProduct = '$DProductCRUISE[IDProduct]' and tour_msproduct.Status <> 'VOID' and tour_msdiscount.Status='ACTIVE'");
                        $dd = mysql_fetch_array($d);
                        $julh = mysql_num_rows($d);
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
                        //pewarnaan row kalau status close
                        if (($DProductCRUISE[StatusProduct] == 'CLOSE')) {
                            $warna = "BGCOLOR='#f5bebe'";
                        } else {
                            $warna = "BGCOLOR='#ffffff'";
                        }
                        $VDL = date('d M Y', strtotime($DProductCRUISE[VisaDateline]));
                        if ($DProductCRUISE[VisaDateline] == '0000-00-00' or $DProductCRUISE[VisaDateline] == '1970-01-01') {
                            $VDL = "";
                        } else {
                            $VDL = "$VDL";
                        }
                        $showitin = "?module=msitin&id=$DProductCRUISE[IDProduct]&act=showitin";
                        echo "
				     <td $warna>$DProductCRUISE[ProductName]</td>
					 <td $warna><a href='$showitin' style=text-decoration:none >$DProductCRUISE[TourCode]</a></td>
					 <td $warna><center>$DProductCRUISE[Flight]</td>   
					 <td $warna><center>$new_date $montText</td>
					 <td $warna><center>$DProductCRUISE[SeatSisa]</td>
					  <td $warna><center>$DProductCRUISE[SellingCurr]</td>
					 <td style='text-align:right' $warna>$SellingAdl12</td>
                     <td style='text-align:right' $warna>$SellingAdl34</td>
                     <td style='text-align:right' $warna>$SellingChd12</td>
                     <td style='text-align:right' $warna>$SellingChd34</td>
                     <td style='text-align:right' $warna>$SellingSingSell</td>
					 <td style='text-align:right' $warna>$Tax</td>
					 <td style='text-align:right' $warna>$SeaTax</td>
					 <td $warna>$DProductCRUISE[Visa] ";
                        if ($DProductCRUISE[Visa] == 'INCLUDE' || $DProductCRUISE[Visa] == 'NOT INCLUDE') {
                            $tampil = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProductCRUISE[Embassy01]");
                            $s = mysql_fetch_array($tampil);
                            if ($s[Country] <> '') {
                                echo "<br>- $s[Country]";
                            } else {
                            }
                            $tampil1 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProductCRUISE[Embassy02]");
                            $s1 = mysql_fetch_array($tampil1);
                            if ($s1[Country] <> '') {
                                echo "<br>- $s1[Country]";
                            } else {
                            }
                            $tampil2 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProductCRUISE[Embassy03]");
                            $s2 = mysql_fetch_array($tampil2);
                            if ($s2[Country] <> '') {
                                echo "<br>- $s2[Country]";
                            } else {
                            }
                            $tampil3 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProductCRUISE[Embassy04]");
                            $s3 = mysql_fetch_array($tampil3);
                            if ($s3[Country] <> '') {
                                echo "<br>- $s3[Country]";
                            } else {
                            }
                            $tampil4 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProductCRUISE[Embassy05]");
                            $s4 = mysql_fetch_array($tampil4);
                            if ($s4[Country] <> '') {
                                echo "<br>- $s4[Country]";
                            } else {
                            }
                        }
                        echo "</td>
                     <td $warna><center>$VDL</td>
                     <td $warna><center>$diskon</td>
					 <td $warna>$DProductCRUISE[Remarks]</td>";
                        $TotalSeatCRUISE = $TotalSeatCRUISE + $DProductCRUISE[SeatSisa];
                        $TotalBookingCRUISE = $TotalBookingCRUISE + $DBookingCRUISE[pax] + $DBookingCRUISE[DumPax];

                        echo "</tr>";

                        $TotalSisaCRUISE = $TotalSeatCRUISE - ($TotalBookingCRUISE);
                        echo "<tr><td colspan=4><Center><b>Total</td>
			 <td><Center><b>$TotalSeatCRUISE</td>
			 <td colspan='12'></td></tr>";

                    };

                };

            } else {
                $TotalSeatCRUISE = 0;
                $TotalBookingCRUISE = 0;
                $TotalDumCRUISE = 0;

                echo "<tr><td colspan=17></td></tr><tr><td colspan=16; font-size=24px;><h2>CRUISE</h2></td></tr>
                  <tr><th>Tour Name</th><th>Tour Code</th><th>Airlines</th><th>Departure</th><th>Seat</th><th>Curr</th><th>Adl 1-2</th><th>Adl 3-4</th><th>Chd 1-2 </th><th>Chd 3-4</th><th>single supp</th><th>Tax</th><th>visa</th><th>visa dateline</th><th>disc</th><th>Remarks</th></tr>";

                $TPaxCRUISE = 0;
                $TSalesCRUISE = 0;

                while ($DProductCRUISE = mysql_fetch_array($QProduct)) {

                    if ($DProductCRUISE[ProductFor] == 'ALL') {
                        $DepCRUISE = $DProductCRUISE[Department];
                    } else {
                        $Dep = $DProductCRUISE[ProductFor];
                    }

                    $QBookinganCRUISE = mysql_query("SELECT IDTourCode,sum(if(TCDivision<>'LTM' AND TCDivision <> 'LTM-TEZ' ,(AdultPax+ChildPax),0)) as pax,sum(if(TCDivision like 'LTM%' and TCDivision <> 'LTM-SA' ,(AdultPax+ChildPax),0)) as DumPax FROM tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProductCRUISE[IDProduct]'  group by IDTourCode");

                    $BookingCRUISE = mysql_num_rows($QBookinganCRUISE);
                    $DBookingCRUISE = mysql_fetch_array($QBookinganCRUISE);

                    //LA only
                    $QLACRUISE = mysql_query("SELECT * FROM tour_msbookingdetail where Bookingid in( Select Bookingid from tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProductCRUISE[IDProduct]') and tour_msbookingdetail.status <>'CANCEL' and Package='L.A Only'");

                    $BookingLACRUISE = mysql_num_rows($QLACRUISE);

                    //xxxxxxxxxxxxxxxxxx

                    //merubah format tampilan ke currency
                    $SellingAdl12 = number_format($DProductCRUISE[CruiseAdl12] / 1000, 0, '', '.');
                    $SellingAdl34 = number_format($DProductCRUISE[CruiseAdl34] / 1000, 0, '', '.');
                    $SellingChd12 = number_format($DProductCRUISE[CruiseChd12] / 1000, 0, '', '.');
                    $SellingChd34 = number_format($DProductCRUISE[CruiseChd34] / 1000, 0, '', '.');
                    $SellingSingSell = number_format($DProductCRUISE[SingleSell] / 1000, 0, '', '.');
                    $Tax = number_format($DProductCRUISE[TaxInsSell] / 1000, 0, '', '.');
                    $new_date = substr($DProductCRUISE[DateTravelFrom], 8, 2);
                    //DISCOUNT
                    $d = mysql_query("SELECT * FROM tour_msdiscount 
                            left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct      
                            WHERE tour_msproduct.IDProduct = '$DProductCRUISE[IDProduct]' and tour_msproduct.Status <> 'VOID' and tour_msdiscount.Status='ACTIVE'");
                    $dd = mysql_fetch_array($d);
                    $julh = mysql_num_rows($d);
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
                    //pewarnaan row kalau status close
                    if (($DProductCRUISE[StatusProduct] == 'CLOSE')) {
                        $warna = "BGCOLOR='#f5bebe'";
                    } else {
                        $warna = "BGCOLOR='#ffffff'";
                    }
                    $VDL = date('d M Y', strtotime($DProductCRUISE[VisaDateline]));
                    if ($DProductCRUISE[VisaDateline] == '0000-00-00' or $DProductCRUISE[VisaDateline] == '1970-01-01') {
                        $VDL = "";
                    } else {
                        $VDL = "$VDL";
                    }
                    $showitin = "?module=msitin&id=$DProductCRUISE[IDProduct]&act=showitin";
                    echo "
				     <td $warna>$DProductCRUISE[ProductName]</td>
				     <td $warna>$DProductCRUISE[TourCode]</td>
					 <td $warna><center>$DProductCRUISE[Flight]</td>   
					 <td $warna><center>$new_date $montText</td>
					 <td $warna><center>$DProductCRUISE[SeatSisa]</td>
					 <td $warna><center>$DProductCRUISE[SellingCurr]</td>
					 <td style='text-align:right' $warna>$SellingAdl12</td>
                     <td style='text-align:right' $warna>$SellingAdl34</td>
                     <td style='text-align:right' $warna>$SellingChd12</td>
                     <td style='text-align:right' $warna>$SellingChd34</td>
                     <td style='text-align:right' $warna>$SellingSingSell</td>
					 <td style='text-align:right' $warna>$Tax</td>
					 <td $warna>$DProductCRUISE[Visa] ";
                    if ($DProductCRUISE[Visa] == 'INCLUDE' || $DProductCRUISE[Visa] == 'NOT INCLUDE') {
                        $tampil = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProductCRUISE[Embassy01]");
                        $s = mysql_fetch_array($tampil);
                        if ($s[Country] <> '') {
                            echo "<br>- $s[Country]";
                        } else {
                        }
                        $tampil1 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProductCRUISE[Embassy02]");
                        $s1 = mysql_fetch_array($tampil1);
                        if ($s1[Country] <> '') {
                            echo "<br>- $s1[Country]";
                        } else {
                        }
                        $tampil2 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProductCRUISE[Embassy03]");
                        $s2 = mysql_fetch_array($tampil2);
                        if ($s2[Country] <> '') {
                            echo "<br>- $s2[Country]";
                        } else {
                        }
                        $tampil3 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProductCRUISE[Embassy04]");
                        $s3 = mysql_fetch_array($tampil3);
                        if ($s3[Country] <> '') {
                            echo "<br>- $s3[Country]";
                        } else {
                        }
                        $tampil4 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = $DProductCRUISE[Embassy05]");
                        $s4 = mysql_fetch_array($tampil4);
                        if ($s4[Country] <> '') {
                            echo "<br>- $s4[Country]";
                        } else {
                        }
                    }
                    echo "</td>
                     <td $warna><center>$VDL</td>
                     <td $warna><center>$diskon</td>
					 <td $warna>$DProductCRUISE[Remarks]</td>";
                    $TotalSeatCRUISE = $TotalSeatCRUISE + $DProductCRUISE[SeatSisa];
                    $TotalBookingCRUISE = $TotalBookingCRUISE + $DBookingCRUISE[pax] + $DBookingCRUISE[DumPax];

                    echo "</tr>";

                };
                $TotalSisaCRUISE = $TotalSeatCRUISE - ($TotalBookingCRUISE);
                echo "<tr><td colspan=4><Center><b>Total</td>
			 <td><Center><b>$TotalSeatCRUISE</td>
			 <td colspan='11'></td></tr>";

            }

            echo "</Table><br><center><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('dailystatus')>";

        } else {
            echo "<br><center>NO PRODUCT AVAILABLE IN $montText - $yer";
        }

        break;
    }
}
?>
