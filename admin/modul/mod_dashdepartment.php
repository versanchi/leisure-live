<script language="JavaScript"  type="text/javascript">   
function ganti() {
document.example.elements['submit'].click(); 
}
</script>
<?php
$CompanyID=$_SESSION['company_id'];
switch($_GET['act']) {
    default:
        $blnini = date("m");
        $thnini = date("Y");
        $mont = $_GET['bulan'];
        $yer = $_GET['year'];
        if ($mont == '') {
            $mont = $blnini;
        }
        if ($yer == '') {
            $yer = $thnini;
        }


        echo "
    <form name='dashboard' method=get action='media.php?' >
    <input type='hidden' name='module' value='dashdepartment'>
    <h2><br/>DEPARTMENT DASHBOARD: </h2>
    Departure date  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Month &nbsp: <select name='bulan' >
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
                Year : <select name='year' ><option value='0' >- Select -</option>";
        $tampil = mysql_query("SELECT Year FROM tour_msproduct where year <>'' group BY Year asc");
        while ($s = mysql_fetch_array($tampil)) {  // <input type='button' value='Cek Seat' onclick=ceking() >
            if ($yer == $s[Year]) {
                echo "<option value='$s[Year]' selected>$s[Year]</option>";
            } else {
                echo "<option value='$s[Year]' >$s[Year]</option>";
            }
        }
        echo "</select>
   <input type='submit' name='submit' id='submit' value=Show >
    </form>";


        if ($CompanyID == 1) {
            $Department[1] = "PTI PRODUCT";
            $WarnaDep[1] = '#FD7304';
        } else {
            $Department[1] = "TEZ PRODUCT";
            $WarnaDep[1] = '#FD7304';
        }

        $Department[2] = "OTHERS PRODUCT";
        $WarnaDep[2] = '#1694f6';
        //$Department[3]="OTHERS";$WarnaDep[3]='#16C53F';
        //$Department[4]="TMR";$WarnaDep[4]='#0882FF';
        //$Department[4]="DRY TICKET";$WarnaDep[4]='#FAF704';
        $i = 2;


        $Percentage = ((100 / ($i + 1)) - 6) . "%";

        echo "<center><table width='100%'; style='border: 0px solid;'><tr style='border: 0px solid;'>";
        for ($j = 1; $j <= $i; $j++) {
            echo "<td width='$Percentage'; bgcolor='$WarnaDep[$j]' style='border: 0px solid;'><center><font size='5'>
			 <a href='?module=dashdepartment&act=dtlGroup&Dept=$Department[$j]&Bln=$mont&thn=$yer'>$Department[$j]</a></td><td width='5%'; style='border: 0px solid;'></td>";
        }
        echo "</tr><tr style='border: 0px solid;'>";


        $Group = mysql_query("SELECT sum(if( CompanyID=$CompanyID,1,0)) as Group1,sum(if((CompanyID<>$CompanyID ),1,0)) as Group2 from tour_msproduct where Status<>'VOID' and month(tour_msproduct.datetravelfrom)=$mont and year(tour_msproduct.datetravelfrom)=$yer and IDProduct in (select distinct IDTourCode from tour_msbooking where Status='ACTIVE' and DUMMY='NO'  and BookingStatus='DEPOSIT' and  TCCompanyID=$CompanyID)");

        $JumGroup = mysql_fetch_array($Group);


        for ($j = 1; $j <= $i; $j++) {
            $CatGroup = 'Group' . $j;
            echo "<td width='$Percentage'; bgcolor='$WarnaDep[$j]'; style='border: 0px solid ;'><center><font size='5'>$JumGroup[$CatGroup] Group</td><td width='5%'; style='border: 0px solid;'></td>";
        }


        echo "</tr><tr style='border: 0px solid ;'>";

        $Booking = mysql_query("SELECT sum(if(tour_msproduct.CompanyID=$CompanyID,(AdultPax+ChildPax+InfantPax),0)) as Pax1,sum(if((tour_msproduct.CompanyID<>$CompanyID and  TCCompanyID=$CompanyID),(AdultPax+ChildPax+InfantPax),0)) as Pax2 from tour_msbooking inner join tour_msproduct on tour_msbooking.IDTourcode = tour_msproduct.IDProduct where tour_msproduct.Status<>'VOID' and month(tour_msproduct.datetravelfrom)=$mont and year(tour_msproduct.datetravelfrom)=$yer and tour_msbooking.Status='ACTIVE' and DUMMY='NO' and BookingStatus='DEPOSIT'");
        $DBooking = mysql_fetch_array($Booking);

        for ($j = 1; $j <= $i; $j++) {
            $PaxGroup = 'Pax' . $j;
            echo "<td width='$Percentage'; bgcolor='$WarnaDep[$j]'; style='border: 0px solid ;'><center><font size='5'>$DBooking[$PaxGroup] Pax</td><td width='5%'; style='border: 0px solid;'></td>";
        }
        echo "</tr></table>";

        echo "<table width='100%'; style='border: 0px solid;'><tr style='border: 0px solid;'><td style='border: 0px solid; text-align=center'><center>";
        echo "<font size='3'>Report base on Division </font>";
        echo "<table><tr><td bgcolor='#000000';><font color='#FFFFFF'>No</td><td bgcolor='#000000';><font color='#FFFFFF'>Division</td>";
        for ($j = 1; $j <= $i; $j++) {
            echo "<td  bgcolor='$WarnaDep[$j]'><center>$Department[$j]</td>";
        }
        echo "<td bgcolor='#000000';><font color='#FFFFFF'>Total</td></tr>";

        $No = 1;
        $Div = mysql_query("SELECT TCDivision ,sum(AdultPax+ChildPax+InfantPax) as Total  from tour_msbooking  where IDTourcode in(select IDProduct from tour_msproduct where Status<>'VOID' and month(tour_msproduct.datetravelfrom)='$mont' and year(tour_msproduct.datetravelfrom)='$yer') and Status='ACTIVE' and DUMMY='NO'  and BookingStatus='DEPOSIT' and TCCompanyID=$CompanyID group by TCDivision order by Total desc ");
        while ($DDiv = mysql_fetch_array($Div)) {
            echo "<tr><td>$No</td><td><a href='?module=dashdepartment&act=dtlDiv&Div=$DDiv[TCDivision]&Bln=$mont&thn=$yer'>$DDiv[TCDivision]</td>";
            $TotalDiv = 0;

            $DtlBooking = mysql_query("SELECT sum(if(tour_msproduct.CompanyID=$CompanyID,(AdultPax+ChildPax+InfantPax),0)) as Pax1,sum(if(tour_msproduct.CompanyID<> $CompanyID,(AdultPax+ChildPax+InfantPax),0)) as Pax2
		 from 
		  tour_msbooking inner join tour_msproduct on tour_msbooking.IDTourcode = tour_msproduct.IDProduct  where tour_msproduct.Status<>'VOID' and month(tour_msproduct.datetravelfrom)=$mont and year(tour_msproduct.datetravelfrom)=$yer and tour_msbooking.Status='ACTIVE' and DUMMY='NO'  and tour_msbooking.BookingStatus='DEPOSIT' and TCCompanyID=$CompanyID  and tour_msbooking.TCDivision='$DDiv[TCDivision]' ");
            $DDtlBooking = mysql_fetch_array($DtlBooking);

            for ($j = 1; $j <= $i; $j++) {
                $PaxGroup = 'Pax' . $j;
                if ($DDtlBooking[$PaxGroup] == '') {
                    $Pax = 0;
                } else {
                    $Pax = $DDtlBooking[$PaxGroup];
                }
                echo "<td bgcolor='$WarnaDep[$j]' style='text-align:right';>$Pax</td>";
                $TotalDiv = $TotalDiv + $Pax;
                $TotalDivisi[$j] = $TotalDivisi[$j] + $Pax;
            }
            echo "<td style='text-align:right';>$TotalDiv</td></tr>";

            $No++;
        }

        echo "<td colspan=2>Total</td>";
        for ($j = 1; $j <= $i; $j++) {
            echo "<td bgcolor='$WarnaDep[$j]'; style='text-align:right';>$TotalDivisi[$j]</td>";
            $TotalAllDiv = $TotalAllDiv + $TotalDivisi[$j];
        }
        echo "<td style='text-align:right';>$TotalAllDiv</td></tr></table>";

        //OtherCompany

        echo "</td><td style='border: 0px solid; text-align=center'><center>";
        $No = 1;
        $DivOther = mysql_query("SELECT TCDivision ,sum(AdultPax+ChildPax+InfantPax) as Total  from tour_msbooking  where IDTourcode in(select IDProduct from tour_msproduct where Status<>'VOID' and month(tour_msproduct.datetravelfrom)='$mont' and year(tour_msproduct.datetravelfrom)='$yer'  and CompanyID=$CompanyID ) and Status='ACTIVE' and DUMMY='NO'  and BookingStatus='DEPOSIT' and TCCompanyID<>$CompanyID group by TCDivision order by Total desc ");


        $jumdata = mysql_num_rows($DivOther);

        if ($jumdata > 0) {
            echo "<font size='3'>Report Sister Company / Franchise </font>";
            echo "<table><tr><td bgcolor='#000000';><font color='#FFFFFF'>No</td><td bgcolor='#000000';><font color='#FFFFFF'>Division</td>";

            echo "<td bgcolor='#000000';><font color='#FFFFFF'><center>Pax</td>";
            while ($DDivOther = mysql_fetch_array($DivOther)) {
                echo "<tr><td>$No</td><td><a href='?module=dashdepartment&act=dtlDivOther&Div=$DDivOther[TCDivision]&Bln=$mont&thn=$yer'>$DDivOther[TCDivision]</td>";
                echo "<td style='text-align:right';>$DDivOther[Total]</td></tr>";
                $TotalAllOther = $TotalAllOther + $DDivOther[Total];
                $No++;
            }

            echo "<td colspan=2>Total</td>";
            echo "<td style='text-align:right';>$TotalAllOther</td></tr></table>";
        }

        //per destinasi
        echo "</td><td style='border: 0px solid; text-align=center'><center>";
        echo "<font size='3'>Report base on Destination</font>";
        echo "<table>
        <tr><td bgcolor='#000000'; rowspan=2;><font color='#FFFFFF';>No</td><td bgcolor='#000000'; rowspan=2;><font color='#FFFFFF'>Destination</td>";
        for ($j = 1; $j <= $i; $j++) {
            echo "<td  bgcolor='$WarnaDep[$j]'; colspan=2;><center>$Department[$j]</td>";
        }
        echo "<td bgcolor='#000000';  colspan=2;><font color='#FFFFFF'><center>Total</td><td bgcolor='#000000'; rowspan=2;><font color='#FFFFFF'><center>Average</td></tr>
        <tr>";
        for ($j = 1; $j <= $i; $j++) {
            echo "<td  bgcolor='$WarnaDep[$j]'><center>Group</td>";
            echo "<td  bgcolor='$WarnaDep[$j]'><center>Pax</td>";

        }
        echo "<td bgcolor='#000000'; ><font color='#FFFFFF'>Group</td><td bgcolor='#000000'; ><font color='#FFFFFF'>Pax</td></tr>";

        $No = 1;
        $Destination = mysql_query("SELECT distinct Destination from tour_msproduct where Status<>'VOID' and month(tour_msproduct.datetravelfrom)=$mont and year(tour_msproduct.datetravelfrom)=$yer");
        while ($DDestination = mysql_fetch_array($Destination)) {
            echo "<tr><td>$No</td><td>$DDestination[Destination]</td>";
            $TotalDest = 0;
            $TotalGroup = 0;


            $DtlBooking = mysql_query("SELECT sum(if(tour_msproduct.CompanyID=$CompanyID,(AdultPax+ChildPax+InfantPax),0)) as Pax1,sum(if((tour_msproduct.CompanyID<>$CompanyID and TCCompanyID=$CompanyID),(AdultPax+ChildPax+InfantPax),0)) as Pax2  from tour_msbooking inner join tour_msproduct on tour_msbooking.IDTourcode = tour_msproduct.IDProduct where tour_msproduct.Status<>'VOID' and month(tour_msproduct.datetravelfrom)=$mont and year(tour_msproduct.datetravelfrom)=$yer and tour_msproduct.Destination='$DDestination[Destination]' and tour_msbooking.Status='ACTIVE' and DUMMY='NO' and tour_msbooking.BookingStatus='DEPOSIT' ");
            $DDtlBooking = mysql_fetch_array($DtlBooking);

            $DtlGroup = mysql_query("SELECT sum(if(tour_msproduct.CompanyID=$CompanyID,1,0)) as Grp1,sum(if((tour_msproduct.CompanyID<>$CompanyID),1,0)) as Grp2  from  tour_msproduct where tour_msproduct.Status<>'VOID' and month(tour_msproduct.datetravelfrom)=$mont and year(tour_msproduct.datetravelfrom)=$yer and tour_msproduct.Destination='$DDestination[Destination]' and Seat<>SeatSisa  and IDProduct in (select distinct IDTourCode from tour_msbooking where Status='ACTIVE' and DUMMY='NO'  and BookingStatus='DEPOSIT' and TCCompanyID=$CompanyID)");
            $DDtlGroup = mysql_fetch_array($DtlGroup);

            for ($j = 1; $j <= $i; $j++) {
                $PaxDep = 'Pax' . $j;
                $Group = 'Grp' . $j;
                if ($DDtlBooking[$PaxGroup] == '') {
                    $Pax = 0;
                } else {
                    $Pax = $DDtlBooking[$PaxDep];
                }

                
                echo "<td bgcolor='$WarnaDep[$j]'><center>$DDtlGroup[$Group]</td>
			 		<td bgcolor='$WarnaDep[$j]'><center>$Pax</td>";
                $TotalGroup = $TotalGroup + $DDtlGroup[$Group];
                $TotalDest = $TotalDest + $Pax;
                $Total[$j] = $Total[$j] + $Pax;
                $TotalGrp[$j] = $TotalGrp[$j] + $DDtlGroup[$Group];
            }

            $AveragePax=$TotalDest/$TotalGroup;

            echo "<td style='text-align:right';><center>$TotalGroup</td><td style='text-align:right';><center>$TotalDest</td>
            <td style='text-align:right';><center>".number_format($AveragePax, 0, ',', '.')."</td></tr>";

            $No++;
        }

        echo "<td colspan=2>Total</td>";
        for ($j = 1; $j <= $i; $j++) {
            echo "<td bgcolor='$WarnaDep[$j]'><center>$TotalGrp[$j]</td><td bgcolor='$WarnaDep[$j]'><center>$Total[$j]</td>";
            $TotalAll = $TotalAll + $Total[$j];
            $TotalAllGrp = $TotalAllGrp + $TotalGrp[$j];
        }
        $TotalAveragePax=$TotalAll/$TotalAllGrp;
        echo "<td><center>$TotalAllGrp</td><td><center>$TotalAll</td><td><center>".number_format($TotalAveragePax, 0, ',', '.')."</td></tr></table>";
        echo "</td></tr></table>";

        break;

    case "dtlGroup":

        $Dept = $_GET[Dept];
        $mont = $_GET[Bln];
        $yer = $_GET[thn];

        if ($Dept == 'PTI PRODUCT' OR $Dept == 'TEZ PRODUCT') {
            $QProduct = mysql_query("SELECT * from tour_msproduct where Status<>'VOID' and month(tour_msproduct.datetravelfrom)=$mont and year(tour_msproduct.datetravelfrom)=$yer and IDProduct in (select distinct IDTourCode from tour_msbooking where Status='ACTIVE' and Dummy='NO'  and BookingStatus='DEPOSIT') and CompanyID=$CompanyID order by Destination");
        } else {
            $QProduct = mysql_query("SELECT * from tour_msproduct where Status<>'VOID' and month(tour_msproduct.datetravelfrom)=$mont and year(tour_msproduct.datetravelfrom)=$yer and IDProduct in (select distinct IDTourCode from tour_msbooking where Status='ACTIVE'  and Dummy='NO'  and BookingStatus='DEPOSIT' and TCCompanyId=$CompanyID) and CompanyID<>$CompanyID order by Destination");

        }

        if ($mont == '01') {
            $montText = 'JAN';
        } elseif ($mont == '02') {
            $montText = 'FEB';
        } elseif ($mont == '03') {
            $montText = 'MAR';
        } elseif ($mont == '04') {
            $montText = 'APR';
        } elseif ($mont == '05') {
            $montText = 'MAY';
        } elseif ($mont == '06') {
            $montText = 'JUN';
        } elseif ($mont == '07') {
            $montText = 'JUL';
        } elseif ($mont == '08') {
            $montText = 'AUG';
        } elseif ($mont == '09') {
            $montText = 'SEP';
        } elseif ($mont == '10') {
            $montText = 'OCT';
        } elseif ($mont == '11') {
            $montText = 'NOV';
        } elseif ($mont == '12') {
            $montText = 'DES';
        };

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
            echo " <table id='GroupList'>";
            echo "<tr><td colspan=15><h><B>Group List </B></h></td></tr>
	<tr><th>No</th><th>Tour Code</th><th>Region</th><th>Airlines</th><th>Department</th><th>Departure</th><th>Pax</th><th>LA only</th><th>Price</th><th>Tax</th><th>Local Agent</th><th>Tour Leader</th><th>Season</th></tr>";
            $No = 1;

            while ($DProduct = mysql_fetch_array($QProduct)) {

                if ($DProduct[ProductFor] == 'ALL') {
                    $Dep = $DProduct[Department];
                } else {
                    $Dep = $DProduct[ProductFor];
                }

                if ($Dept == 'OWN PRODUCT') {
                    $QBookingan = mysql_query("SELECT IDTourCode,sum(if(Dummy='NO'  ,(AdultPax+ChildPax+InfantPax),0)) as pax,sum(if(Dummy='YES' ,(AdultPax+ChildPax),0)) as DumPax FROM tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProduct[IDProduct]'  group by IDTourCode");
                    $QLA = mysql_query("SELECT * FROM tour_msbookingdetail where Bookingid in( Select Bookingid from tour_msbooking tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProduct[IDProduct]') and tour_msbookingdetail.status <>'CANCEL' and Package='L.A Only' ");
                } else {
                    $QBookingan = mysql_query("SELECT IDTourCode,sum(if(Dummy='NO',(AdultPax+ChildPax+InfantPax),0)) as pax,sum(if(Dummy='YES' ,(AdultPax+ChildPax),0)) as DumPax FROM tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProduct[IDProduct]' and TCCompanyID=$CompanyID  group by IDTourCode");

                    $QLA = mysql_query("SELECT * FROM tour_msbookingdetail where Bookingid in( Select Bookingid from tour_msbooking tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProduct[IDProduct]') and tour_msbookingdetail.status <>'CANCEL' and Package='L.A Only' and TCCompanyID=$CompanyID  ");

                }

                $Booking = mysql_num_rows($QBookingan);
                $DBooking = mysql_fetch_array($QBookingan);

                //LA only


                $BookingLA = mysql_num_rows($QLA);

                //xxxxxxxxxxxxxxxxxx

                //merubah format tampilan ke currency
                $Selling = number_format($DProduct[SellingAdlTwn], 0, ',', '.');
                $Tax = number_format($DProduct[TaxInsSell], 0, ',', '.');
                $new_date = substr($DProduct[DateTravelFrom], 8, 2);

                //pewarnaan row kalau status close
                if (($DProduct[StatusProduct] == 'CLOSE')) {
                    $warna = "BGCOLOR='#f5bebe'";
                } else {
                    $warna = "BGCOLOR='#ffffff'";
                }

                echo "
							<td $warna>$No</td>
							 <td $warna>$DProduct[TourCode]</td>
							 <td $warna><center>$DProduct[Destination]</td>
							 <td $warna><center>$DProduct[Flight]</td>
							 <td $warna><center>$Dep</td>
							 <td $warna><center>$new_date $montText</td>	 
							 <td style='text-align:right' $warna>";
                $QSupplier = mysql_query("SELECT * FROM tour_detail where ProductId=$DProduct[IDProduct] and Category='VARIABLE' and Supplier<>'' limit 1");
                $DSupplier = mysql_fetch_array($QSupplier);

                if ($DBooking[pax] == 0) {
                    echo "";
                } else {
                    $Bookingan = $DBooking[pax] - $BookingLA;
                    if ($Dept == 'OWN PRODUCT') {
                        echo "<a href='media.php?module=rptnamelist&nama=$DProduct[IDProduct]&oke=Show' target=_blank>$Bookingan </a>";
                    } else {
                        echo "$Bookingan";
                    }
                }
                echo "</td> <td style='text-align:right' $warna>";
                if ($BookingLA == 0) {
                    echo "";
                } else {
                    echo "$BookingLA";
                }
                echo "</td><td style='text-align:right' $warna>$Selling</td>
									 <td style='text-align:right' $warna>$Tax</td>
									 <td $warna><center>$DSupplier[Supplier]</td>
									 <td $warna><center>$DProduct[TourLeader]</td>
									 <td $warna><center>$DProduct[Season]</td>";
                $TotalSeat = $TotalSeat + $DProduct[Seat];
                $TotalBooking = $TotalBooking + $Bookingan;
                $TotalLA = $TotalLA + $BookingLA;
                $No++;
                echo "</tr>";


            };

            echo "<tr><td colspan=6><Center><b>Total</td>
					 <td><Center><b>$TotalBooking</td><td><Center><b>$TotalLA</td>";

            echo "</table>";
            echo "<center><input type=button value=Close onclick=self.history.back()><br><br>";
        } else {
            echo "NO PRODUCT AVAILABLE";
        }
        break;

    case "dtlDiv":

        $kriet = mysql_query("SELECT TCDivision,TourCode ,sum(AdultPax+ChildPax+InfantPax) as TotalActive  from tour_msbooking  where IDTourcode in(select IDProduct from tour_msproduct where Status<>'VOID' and month(tour_msproduct.datetravelfrom)='$_GET[Bln]' and year(tour_msproduct.datetravelfrom)='$_GET[thn]') and Status='ACTIVE' and Dummy='NO'  and BookingStatus='DEPOSIT' and TCDivision='$_GET[Div]' group by TourCode order by TotalActive desc ");

        echo "<B>Booking Transaction $_GET[Div] </B>
			<table>
			<tr><th>No</th><th>Tour Code</th><th>Pax</th></tr>";
        $no = 1;
        $TPax = 0;
        $THarga = 0;
        while ($sow = mysql_fetch_array($kriet)) {
            $TPax = $TPax + $sow[TotalActive];
            $THarga = $THarga + $sow[Harga];
            echo "              
                     <tr>                                   
                     <td>$no</td>  
					 <td>$sow[TourCode]</td> 
   					 <td style='text-align:right'>" . number_format($sow[TotalActive], 0, ',', '.');
            echo "</td>";
            echo "</tr>";
            $no++;
        };
        echo "
					<tr><th colspan=2><center>Total</th><th style='text-align:right'>" . number_format($TPax, 0, ',', '.');
        echo "</th></tr></table><br>
                    <center><input type=button value=Close onclick=self.history.back()><br><br>";

        break;


    case "dtlDivOther":

        $kriet = mysql_query("SELECT TCDivision,TourCode ,sum(AdultPax+ChildPax+InfantPax) as TotalActive  from tour_msbooking  where IDTourcode in(select IDProduct from tour_msproduct where Status<>'VOID' and month(tour_msproduct.datetravelfrom)='$_GET[Bln]' and year(tour_msproduct.datetravelfrom)='$_GET[thn]' and CompanyID=$CompanyID) and Status='ACTIVE' and Dummy='NO'  and BookingStatus='DEPOSIT' and TCDivision='$_GET[Div]' group by TourCode order by TotalActive desc ");

        echo "<B>Booking Transaction $_GET[Div] </B>
			<table>
			<tr><th>No</th><th>Tour Code</th><th>Pax</th></tr>";
        $no = 1;
        $TPax = 0;
        $THarga = 0;
        while ($sow = mysql_fetch_array($kriet)) {
            $TPax = $TPax + $sow[TotalActive];
            $THarga = $THarga + $sow[Harga];
            echo "              
                     <tr>                                   
                     <td>$no</td>  
					 <td>$sow[TourCode]</td> 
   					 <td style='text-align:right'>" . number_format($sow[TotalActive], 0, ',', '.');
            echo "</td>";
            echo "</tr>";
            $no++;
        };
        echo "
					<tr><th colspan=2><center>Total</th><th style='text-align:right'>" . number_format($TPax, 0, ',', '.');
        echo "</th></tr></table><br>
                    <center><input type=button value=Close onclick=self.history.back()><br><br>";

        break;
}