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
        $blnini = date("m");
        $thnini = date("Y");
        $mont = $_GET['bulan'];
        $yer = $_GET['year'];
        $Dest = $_GET['Destination'];
        $GroupType = $_GET['grouptype'];
        if ($mont == '') {
            $mont = $blnini;
        }
        if ($yer == '') {
            $yer = $thnini;
        }
        if ($Dest == '') {
            $Dest = 'ALL';
        }
        if ($GroupType == '') {
            $GroupType = 'ALL';
        }
        echo "<h2>Daily Status</h2>
          <form method='get' action='media.php?'><input type=hidden name=module value='dailysummary'> ";
        echo "Month &nbsp &nbsp &nbsp &nbsp:&nbsp<select name='bulan' >
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
        $tampil = mysql_query("SELECT Year FROM tour_msproduct where year <>'' group BY Year asc");
        while ($s = mysql_fetch_array($tampil)) {  // <input type='button' value='Cek Seat' onclick=ceking() >
            if ($yer == $s[Year]) {
                echo "<option value='$s[Year]' selected>$s[Year]</option>";
            } else {
                echo "<option value='$s[Year]' >$s[Year]</option>";
            }
        }
        echo "</select> <br>";
        echo "<br>Destination :  <select name='Destination' id='Destination'>";

        $tampilDest = mysql_query("SELECT distinct Destination FROM  tour_msproduct where destination<>'' and destination<>'0' order by Destination ASC");
        echo "<option value='ALL'>ALL</option>";
        while ($sDest = mysql_fetch_array($tampilDest)) {
            if ($Dest == $sDest[Destination]) {
                echo "<option value='$sDest[Destination]' selected>$sDest[Destination]</option>";
            } else {
                echo "<option value='$sDest[Destination]'>$sDest[Destination]</option>";
            }
        }
        echo "</select>
        Type : <select name='grouptype'><option value='ALL' selected>ALL</option>";
        $gr = mysql_query("SELECT * FROM tour_msgroup where Status = 'ACTIVE' order by GroupName asc ");
        while ($grp = mysql_fetch_array($gr)) {
            if ($GroupType == $grp[GroupName]) {
                echo "<option value='$grp[GroupName]' selected>$grp[GroupName]</option></a></li>";
            } else {
                echo "<option value='$grp[GroupName]'>$grp[GroupName]</option></a></li>";
            }
        }
        echo "</select>
              <input type=submit name='oke' size='20'value='View'>
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
        echo "<h><B>UPDATE STATUS $montText - $yer </B></h><br>
             <font size='1' color='red'>*HARGA DALAM IDR</font><br>";
        //Mulai Table
        //Query tidak memunculkan tourcode yang kosong dan yang tidak terjual
        if ($Dest == 'ALL') {
            if ($GroupType == 'ALL') {
                $QProduct = mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and TourCode<>'' and GroupType<>'TMR' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' order by Destination,GroupType,ProductCode,ProductName,DateTravelFrom asc");
                $QProductTMR = mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and TourCode<>'' and GroupType='TMR' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' order by Destination,ProductCode,ProductName,GroupType,DateTravelFrom asc");
            } else {
                $QProduct = mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and TourCode<>'' and GroupType = '$GroupType' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' order by Destination,GroupType,ProductCode,ProductName,DateTravelFrom asc");
                $QProductTMR = mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and TourCode<>'' and GroupType = '$GroupType' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' order by Destination,ProductCode,ProductName,GroupType,DateTravelFrom asc");
            }
        } else {
            if ($GroupType == 'ALL') {
                $QProduct = mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and Destination='$Dest'  and  TourCode<>'' and GroupType<>'TMR' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' order by Destination,GroupType,ProductCode,ProductName,DateTravelFrom asc");
                $QProductTMR = mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and Destination='$Dest'  and  TourCode<>'' and GroupType='TMR' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' order by Destination,ProductCode,ProductName,GroupType,DateTravelFrom asc");
            } else {
                $QProduct = mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and Destination='$Dest'  and  TourCode<>'' and GroupType = '$GroupType' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' order by Destination,GroupType,ProductCode,ProductName,DateTravelFrom asc");
                $QProductTMR = mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and Destination='$Dest'  and  TourCode<>'' and GroupType = '$GroupType' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' order by Destination,ProductCode,ProductName,GroupType,DateTravelFrom asc");
            }
        }

        $TotalSeat = 0;
        $TotalBooking = 0;
        $TotalDum = 0;

        $desbefore = 'awal';
        $PCbefore = 'awal';
        $PCbeforeTMR = 'awal';

        $Products = mysql_num_rows($QProduct);

        if ($Products > 0) {

            $TPax = 0;
            $TSales = 0;
            // Query bukan TMR
            echo " <table id='dailystatus' class='bordered'>";

            while ($DProduct = mysql_fetch_array($QProduct)) {

                if ($DProduct[ProductFor] == 'ALL') {
                    $Dep = $DProduct[Department];
                } else {
                    $Dep = $DProduct[ProductFor];
                }

                if ($desbefore <> $DProduct[Destination]) {
                    echo "<tr><td colspan=18 style=font-size:15px><b><center>$DProduct[Destination]</center></b></td></tr>
    <tr><th>Tour Name</th><th>Tour Code</th><th>Airlines</th><th>Department</th><th>Departure</th><th>Visa Dateline</th><th> Seat</th><th>Pax</th><th>Hold</th><th>Available</th><th>LA only</th><th>Category</th><th>Price</th><th>disc</th><th>Tax</th><th>Incentive</th><th>Status</th><th>Remarks</th></tr>";
                    $desbefore = $DProduct[Destination];
                    $Typebefore = 'awal';
                }

                if ($Typebefore <> $DProduct[GroupType]) {
                    echo "<tr><td colspan=18; font-size=24px;><strong>$DProduct[GroupType]</strong></td></tr>";
                    $Typebefore = $DProduct[GroupType];
                    $PCbefore = 'awal';
                }

                if ($PCbefore <> $DProduct[ProductCode]) {
                    $QPC = mysql_query("SELECT count(IDProduct) as JumProduct  FROM `tour_msproduct` where tour_msproduct.Status <> 'VOID' and tour_msproduct.ProductCode='$DProduct[ProductCode]' and month(DateTravelFrom)='$mont' and  year(DateTravelFrom)='$yer' and TourCode<>'' and Destination='$DProduct[Destination]' and (StatusProduct <>'CLOSE' or SeatDeposit >0) and GroupType='$DProduct[GroupType]' and status='PUBLISH' ");
                    $TPC = mysql_fetch_array($QPC);
                    echo "<tr><td rowspan='$TPC[JumProduct]'; style=vertical-align:middle><center>$DProduct[ProductName]</td>";
                    $PCbefore = $DProduct[ProductCode];
                }


                $QBookingan = mysql_query("SELECT IDTourCode,sum(if(OfficeCategory<>'PRODUCT' ,(AdultPax+ChildPax),0)) as pax,sum(if(OfficeCategory='PRODUCT' ,(AdultPax+ChildPax),0)) as DumPax FROM tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProduct[IDProduct]'  group by IDTourCode");
                $QBookinganHold = mysql_query("SELECT IDTourCode,sum(if(OfficeCategory<>'PRODUCT' ,(AdultPax+ChildPax),0)) as holdpax FROM tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='HOLD' and IDTourCode='$DProduct[IDProduct]'  group by IDTourCode");

                $Booking = mysql_num_rows($QBookingan);
                $DBooking = mysql_fetch_array($QBookingan);
                $DBookingHold = mysql_fetch_array($QBookinganHold);

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
                $VDL = date('d M Y', strtotime($DProduct[VisaDateline]));
                if ($DProduct[VisaDateline] == '0000-00-00' or $DProduct[VisaDateline] == '1970-01-01') {
                    $VDL = "";
                } else {
                    $VDL = "$VDL";
                }
                $Incentive = number_format($DProduct[Incentive], 0, ',', '.');
                //DISCOUNT
                $ad = mysql_query("SELECT count(tour_msbookingdetail.IDDetail) as uruta FROM tour_msbookingdetail
                                                    WHERE tour_msbookingdetail.IDTourcode = '$DProduct[IDProduct]'
                                                    and tour_msbookingdetail.Gender <> 'INFANT'
                                                    AND tour_msbookingdetail.Status<>'CANCEL'
                                                    ORDER BY Urutan DESC ");
                $isiad = mysql_fetch_array($ad);
                $mulai = $isiad[uruta];
                $totl = $mulai + 1;
                $d = mysql_query("SELECT * FROM tour_msdiscount
                                                    WHERE tour_msdiscount.IDProduct = '$DProduct[IDProduct]'  and tour_msdiscount.Status='ACTIVE'");
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

                // pewarnaan row kalau status close
                if (($DProduct[StatusProduct] == 'CLOSE' OR $DProduct[StatusProduct] == 'FINALIZE')) {
                    $warna = "BGCOLOR='#f5bebe'";
                } else {
                    $warna = "BGCOLOR='#ffffff'";
                }
                $file = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($DProduct['AttachmentFile']))));
                if ($file == '') {
                    $showitin = "?module=msitin&id=$DProduct[IDProduct]&act=showitin";
                } else {
                    //$showitin="$DProduct[Attachment]$file";
                    $showitin = "?module=msitin&id=$DProduct[IDProduct]&act=showitin";
                }
                echo "
                             <td $warna><a href='$showitin' style=text-decoration:none >$DProduct[TourCode]</a></td>
                             <td $warna><center>$DProduct[Flight]</td>
                             <td $warna><center>$Dep</td>
                             <td $warna><center>$new_date $montText</td>
                             <td $warna><center>$VDL</td>
                             <td $warna><center>$DProduct[Seat]</td>
                             <td style='text-align:right' $warna><center>";
                $bookingan = $DBooking[pax] + $DBooking[DumPax];
                if ($bookingan == 0) {
                    echo "";
                } else {
                    echo "<a href=?module=group&act=showdeposit&id=$DProduct[IDProduct]>$bookingan</a>";
                }
                echo "</td>
                             <td style='text-align:right' $warna><center>";
                if ($DBookingHold[holdpax] == 0) {
                    echo "";
                } else {
                    echo "<a href=?module=group&act=showdeposit&id=$DProduct[IDProduct]>$DBookingHold[holdpax]</a>";
                }
                echo "</td>
                             <td $warna><center>";
                if ($DBooking[pax] == 0 and $DBooking[DumPax] == 0 and $DBookingHold[holdpax] == 0) {
                    echo "$DProduct[Seat]";
                } else {
                    $sisa = $DProduct[Seat] - ($DBooking[pax] + $DBookingHold[holdpax] + $DBooking[DumPax]);
                    echo "$sisa";
                }
                echo "</td> <td style='text-align:right' $warna>";
                if ($BookingLA == 0) {
                    echo "";
                } else {
                    echo "$BookingLA";
                }
                if($DProduct[ShockingOffer]=='YES'){
                    $so="<img src='../admin/images/soicon.png'>";}
                else {
                    $so = '';
                }
                echo "</td>
                                     <td $warna><center>$so</td>
                                     <td style='text-align:right' $warna>$Selling</td>
                                     <td $warna><center>$diskon</td>
                                     <td style='text-align:right' $warna>$Tax</td>
                                     <td style='text-align:right' $warna>";
                if ($DProduct[Incentive] <> '') {
                    echo "$DProduct[IncentiveCurr] $Incentive";
                }
                echo "</td>
                                     <td $warna><center>$DProduct[StatusProduct]</td>
                                     <td $warna>$DProduct[Remarks]</td>";
                $TotalSeat = $TotalSeat + $DProduct[Seat];
                $TotalBooking = $TotalBooking + $DBooking[pax] + $DBooking[DumPax];
                $TotalBookingHold = $TotalBookingHold + $DBookingHold[holdpax];
                echo "</tr>";
            };

            $TotalSisa = $TotalSeat - ($TotalBooking + $TotalBookingHold + $TotalDum);
            echo "<tr><td colspan=6><Center><b>Total</td>
                     <td><Center><b>$TotalSeat</td>
                     <td><Center><b>$TotalBooking</td>
                     <td><Center><b>$TotalBookingHold</td>
                     <td><Center><b>$TotalSisa</td>
                     <td colspan='8'></td></tr>";

            echo "</Table><br><center><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('dailystatus')>";

        } else {
            echo "NO PRODUCT AVAILABLE IN $montText - $yer";
        }

        break;
}
?>
