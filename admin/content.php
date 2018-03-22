<?PHP
include "../config/koneksi.php";
include "../config/koneksimaster.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/class_paging.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// Bagian Home
if ($_GET['module']=='home') {
    ?>
    <script src="../config/jquery.cookie.js"></script>
    <link rel="stylesheet" href="../config/colorbox/example4/colorbox.css"/>
    <script src="../config/jquery.colorbox.js"></script>
    <script>
        function createCookie() {
            $.cookie("pop", "on", {expires: 1, path: '/'});
        }
        function openColorBox() {
            if (!$.cookie("pop")) {
                $.colorbox({iframe: true, width: "70%", height: "85%", href: "pop.php", overlayClose: false});
                createCookie();
            }
        }
        $(window).load(openColorBox())

    </script> <?PHP
    /*$mssql=mssql_query("SELECT TOP 10 * FROM Invoice");
    while($hasilmssql=mssql_fetch_array($mssql)){
    echo"tes: $hasilmssql[InvoiceID]<br>";        } */

    $sql = mssql_query("SELECT DivisiNo,Employee.DivisiID,Category,EmployeeName FROM [HRM].[dbo].[Employee]
                      inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                      WHERE EmployeeID = '$_SESSION[employee_code]'");
    $hasil = mssql_fetch_array($sql);
    $employee = $hasil['EmployeeName'];
    $hour = date("G");
    if ($hour >= 0 && $hour <= 11) {
        $say = "Good morning";
    } else {
        if ($hour >= 12 && $hour <= 17) {
            $say = "Good afternoon";
        } else {
            if ($hour >= 18 && $hour <= 19) {
                $say = "Good evening";
            } else {
                $say = "Good evening";
            }
        }
    }

    echo "<h2>Welcome</h2>
        <p>$say <b>$employee</b>,</p>";
    //$oke=$_GET['oke'];
    $hariini = date("Y-m-d ");
    $thnini = date("Y");
    $blnini = date("m");
    $batas = date("Y-m-d", (mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 14, date("Y"))));
    $batasdoc = date("Y-m-d", (mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"))));
    $montText = strtoupper(date("M"));
    if ($montText == 'DEC') {
        $montText = 'DES';
    } else {
        $montText = $montText;
    }
    $montangka = $montText . A;
    // mencari divisi multi divisi
    $qdivisi = mssql_query("SELECT * FROM [HRM].[dbo].[Divisi]
                      WHERE DivisiID = '$_SESSION[employee_office]'");
    $ddivisi = mssql_fetch_array($qdivisi);
    //pendingan TBF
    if ($ddivisi[Category] == 'SALES OUTLET') {
        $TBFPending = mysql_query("select TCNameAlias,TCEmpID,TCDivision,count(bookingID) as Booking from tour_msbooking
                            where BookingStatus='DEPOSIT' 
                            AND Status='ACTIVE' 
                            and (AdultPax+ChildPax+InfantPax)>0 
                            and TBFNo ='' 
                            and IDTourcode in (select IDProduct from tour_msproduct 
                            where Status<>'VOID' and DateTravelFrom < '$batas' and DateTravelFrom >'$hariini')  
                            and TCDivision='$_SESSION[employee_office]'
                            group by TCNameAlias order by Booking DESC,TCNameAlias ASC");

        $jumrPendingan = mysql_num_rows($TBFPending);

        echo "<center><table class='bordered' style='border: 0px solid #000000;'><tr><td style='border: 0px solid #000000;'>";
        if ($jumrPendingan > 0) {
            echo "
            
            <table class='bordered' style='border: 0px solid #000000;'>
				 <tr><td style='border: 0px solid #000000;' colspan='2' ><center><font size=3; color='red';><b>PLEASE SEND YOUR TBF</td><tr>
				 <tr><th><b>TC Name</th><th><b>Total Booking</th></tr>";

            while ($DTBFPending = mysql_fetch_array($TBFPending)) {
                if ($employee == $DTBFPending[TCNameAlias]) {
                    $c = "BGCOLOR='red'";
                    $b = "<b>";
                } else {
                    $c = "BGCOLOR='#fff'";
                    $b = "";
                }
                $namealias = str_replace(" ", "+", $DTBFPending[TCNameAlias]);
                echo "<tr $c>
						<td $c>$b$DTBFPending[TCNameAlias]</td>
						<td $c>$b<center><a href=?module=msbooking&Div=$DTBFPending[TCDivision]&act=showTBF&TC=$namealias>$DTBFPending[Booking]
						</a></td>
						</tr>";
            }
            echo "</table></td><td style='width:10px; border: 0px solid #000000;'></td><td style='border: 0px solid #000000;'>";
        }

        $DocPending = mysql_query("select TCNameAlias,TCEmpID,TCDivision,IDDetail from tour_msbooking inner join 
                           tour_msbookingdetail on tour_msbookingdetail.bookingID= tour_msbooking.BookingID
                            where tour_msbooking.BookingStatus='DEPOSIT' 
                            AND tour_msbooking.Status='ACTIVE' 
                            AND HoldingVisa='NO'
                            and (tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax)>0 
                            and tour_msbooking.IDTourcode in (select IDProduct from tour_msproduct 
                            where Status<>'VOID' and Visadateline < '$batasdoc' and DateTravelFrom >'$hariini' and visa<>'NO REQUIRED')  
                            and TCDivision='$_SESSION[employee_office]'
                            order by TCNameAlias ASC");

        $namaawal = '';
        $header = 0;
        $pending = 0;

        while ($DDocPending = mysql_fetch_array($DocPending)) {
            if ($namaawal == '' or $namaawal <> $DDocPending[TCNameAlias]) {
                if ($namaawal <> '' and $pending > 0) {
                    if ($employee == $DDocPending[TCNameAlias]) {
                        $c = "BGCOLOR='red'";
                        $b = "<b>";
                    } else {
                        $c = "BGCOLOR='#fff'";
                        $b = "";
                    }

                    $namealias = str_replace(" ", "+", $DDocPending[TCNameAlias]);
                    if ($header == 0) {
                        echo "                                
                                    <table class='bordered' style='border: 0px solid #000000;'>
                                         <tr><td style='border: 0px solid #000000;' colspan='2' ><center><font size=3; color='red';><b>PLEASE APPLY VISA</td><tr>
                                         <tr><th><b>TC Name</th><th><b>Total Booking</th></tr>";
                        $header = 1;

                    }
                    echo "<tr $c>
                                <td $c>$namaawal</td>
                                <td $c>$b<center><a href=?module=msbooking&Div=$DDocPending[TCDivision]&act=showDoc&TC=$namealias>$pending
                                </a></td>
                                </tr>";

                    $namaawal = $DDocPending[TCNameAlias];
                    $pending = 0;
                }
                $DocCreate = mysql_query("select DoNo from msvisa where IDBookingdetail=$DDocPending[IDDetail] and (status='PROCESS TO EMBASSY' or status='DONE')");
                $jumDoc = mysql_num_rows($DocCreate) * 1;
                if ($jumDoc == 0) {
                    $pending = $pending + 1;
                }
            }
        }

        if ($header == 1) {
            echo "</table>";
        }
        echo "</td></tr></table>";

        $satu = mysql_query("SELECT Season,Year FROM tour_msproduct
                                WHERE Status = 'PUBLISH'
                                and DateTravelFrom > '$hariini'
                                and Year >= '$thnini' 
                                ORDER BY DateTravelFrom ASC LIMIT 1");
        $satu1 = mysql_fetch_array($satu);
        $qdivpanel = mssql_query("SELECT DivisiID FROM [HRM].[dbo].[Divisi] WHERE Category = 'PRODUCT' or Category = 'SALES SUPPORT' ");
        while ($divpanel = mssql_fetch_array($qdivpanel)) {
            $divp = "AND TCDivision <>'$divpanel[DivisiID]' ";
            $alldiv = $alldiv . '' . $divp;
            $divp = '';
        }
        //TC OF THE YEAR
        $TopTC = mysql_query("SELECT TCName,TCDivision,sum(AdultPax+ChildPax+InfantPax) as Total
                      FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.IDProduct=tour_msbooking.IDTourcode)
                      where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE'
                      and BookingStatus='DEPOSIT' and TCDivision<>'' and year(DateTravelFrom)=$thnini
                      and tour_msproduct.TourCode<>'' and Seat<>SeatSisa
                      and DUMMY = 'NO'
                      group by TCName,TCDivision order by Total desc limit 3");

        echo "<center>
       <table class='bordered'>
       <tr style='border-bottom: 0px solid #000000;'><th style='border-bottom: 0px solid #ffffff; background-color:red;font-size:14;'><center><b>CONGRATULATIONS FOR BEST SELLER OF THE YEAR</b></th></tr>";
        $v = 1;
        while ($DTopTC = mysql_fetch_array($TopTC)) {
            if ($v == 1) {
                $h = "<font size=3><center><b>$DTopTC[TCName] ($DTopTC[TCDivision])</b><br>
       <center> $DTopTC[Total] Pax";
            } else {
                $h = "<font size=1><center>$DTopTC[TCName] ($DTopTC[TCDivision]) $DTopTC[Total] Pax<center>";
            }
            echo "<tr><td>$h</td></tr>";
            $v++;
        }
        echo "
       </table>";

        //menampilan target jika termasuk divisi bso
        $Booking = mysql_query("SELECT TCDivision,DUMMY,TaxInsSell, (sum(AdultPax) + sum(ChildPax)) as Total,sum(TotalPrice) as Harga,sum((AdultPax+ChildPax)*TaxInsSell) as hargatax FROM tour_msbooking
                        inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                        where tour_msproduct.Status <> 'VOID'
                        and tour_msbooking.status='ACTIVE'
                        and BookingStatus='DEPOSIT'
                        and month(DateTravelFrom)='$blnini'
                        and year(DateTravelFrom)='$thnini'
                        and tour_msproduct.TourCode<>''
                        and Seat<>SeatSisa
                        and TCDivision ='$_SESSION[employee_office]'
                        group by TCDivision order by Total desc");
        $JumBooking = mysql_num_rows($Booking);
        if ($JumBooking > 0) {
            while ($DBooking = mysql_fetch_array($Booking)) {
                if ($DBooking[DUMMY] == 'NO') {
                    $Target = mysql_query("SELECT $montText,$montangka from tour_mstarget where TargetBSO='$_SESSION[employee_office]' and TargetYear='$thnini'");
                    $DTarget = mysql_fetch_array($Target);

                    $Harga = $DBooking[Harga] + $DBooking[hargatax];
                    $TampilTotal = number_format($DBooking[Total], 0, ',', '.');
                    //$TampilTotal=200;
                    if (($DBooking[Total] / $DTarget[$montText] >= 1) or ($DTarget[$montText] == 0) or
                        ($Harga / $DTarget[$montangka] >= 1) or ($DTarget[$montangka] == 0)
                    ) {
                        $warna = "BGCOLOR='grey'";
                    } else {
                        $warna = "BGCOLOR='#ffffff'";
                    }
                    echo "<center><table class='bordered'>
             <tr><td colspan=2><center><font size=1><b>TARGET THIS MONTH (base on Departure Date) </td></tr>
			 <tr><td><b><center>Target</center></b></td><td><b><center>Achievement</center></b></td></tr>
             <tr>
             <td $warna width=500><font size=2><b>";
                    if ($DTarget[$montangka] == '') {
                        $TargetAngka = 0;
                    } else {
                        $TargetAngka = $DTarget[$montangka];
                    };
                    if ($DTarget[$montText] == '') {
                        echo "<center>0";
                    } else {
                        echo "<center>  $DTarget[$montText] Pax <br> IDR  " . number_format($TargetAngka, 0, ',', '.');
                    }

                    echo "</td>
             <td $warna width=500><font size=2><b>";
                    $tgt = $DTarget[$montText] / 2;
                    if ($TampilTotal <= $tgt) {
                        $fcol = "red";
                    } else if ($TampilTotal > $tgt & $TampilTotal < $DTarget[$montText]) {
                        $fcol = "#f600cb";
                    } else if ($TampilTotal > $DTarget[$montText]) {
                        $fcol = "blue";
                    }
                    if ($DBooking[Total] == '0') {
                        echo "<center><font color='$fcol'>REAL: $TampilTotal Pax </font>";
                        $AchievePax = 0;
                    } else {
                        echo "<center><font color='$fcol'>				 $TampilTotal Pax <br> IDR " . number_format($Harga, 0, ',', '.') . "</font>";
                        if ($DTarget[$montText] == 0) {
                            $AchievePax = 100;
                        } else {
                            $AchievePax = round(($TampilTotal / $DTarget[$montText] * 100), 0);
                        };
                    }
                    echo "</td>  ";
                    echo "</tr></table>";
                }
            }

        } else {
            $Target = mysql_query("SELECT $montText,$montangka from tour_mstarget where TargetBSO='$_SESSION[employee_office]' and TargetYear='$thnini'");
            $DTarget = mysql_fetch_array($Target);

            $Harga = $DBooking[Harga] + $DBooking[hargatax];
            $TampilTotal = number_format($DBooking[Total], 0, ',', '.');
            //$TampilTotal=200;
            if (($DBooking[Total] / $DTarget[$montText] >= 1) or ($DTarget[$montText] == 0) or
                ($Harga / $DTarget[$montangka] >= 1) or ($DTarget[$montangka] == 0)
            ) {
                $warna = "BGCOLOR='grey'";
            } else {
                $warna = "BGCOLOR='#ffffff'";
            }
            echo "<center><table class='bordered'>
             <tr><td colspan=2><center><font size=1><b>TARGET THIS MONTH (base on Departure Date) </td></tr>
			 <tr><td><b><center>Target</center></b></td><td><b><center>Achievement</center></b></td></tr>
             <tr>
             <td $warna width=500><font size=2><b>";
            if ($DTarget[$montangka] == '') {
                $TargetAngka = 0;
            } else {
                $TargetAngka = $DTarget[$montangka];
            };
            if ($DTarget[$montText] == '') {
                echo "<center>0";
            } else {
                echo "<center>  $DTarget[$montText] Pax <br> IDR  " . number_format($TargetAngka, 0, ',', '.');
            }

            echo "</td>
             <td $warna width=500><font size=2><b>";
            $tgt = $DTarget[$montText] / 2;
            if ($TampilTotal <= $tgt) {
                $fcol = "red";
            } else if ($TampilTotal > $tgt & $TampilTotal < $DTarget[$montText]) {
                $fcol = "#f600cb";
            } else if ($TampilTotal > $DTarget[$montText]) {
                $fcol = "blue";
            }
            if ($DBooking[Total] == '0') {
                echo "<center><font color='$fcol'>REAL: $TampilTotal Pax </font>";
                $AchievePax = 0;
            } else {
                echo "<center><font color='$fcol'>				 $TampilTotal Pax <br> IDR " . number_format($Harga, 0, ',', '.') . "</font>";
                if ($DTarget[$montText] == 0) {
                    $AchievePax = 100;
                } else {
                    $AchievePax = round(($TampilTotal / $DTarget[$montText] * 100), 0);
                };
            }
            echo "</td>  ";
            echo "</tr></table>";
        }

        $tampil1 = mysql_query("SELECT TCName,TCDivision,count(IDDetail)as totalpax FROM tour_msbookingdetail
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbookingdetail.IDTourcode
                                left join tour_msbooking on tour_msbooking.BookingID=tour_msbookingdetail.BookingID
                                WHERE month(DepositDate) ='$blnini'
                                AND year(DepositDate)='$thnini'
                                AND year(tour_msproduct.DateTravelFrom) >='$satu1[Year]'
                                AND tour_msbooking.Status ='ACTIVE'
                                and tour_msbooking.BookingStatus='DEPOSIT'
                                and tour_msproduct.Status <> 'VOID'
                                AND tour_msbooking.DUMMY = 'NO'
                                GROUP BY TCName order by totalpax DESC,TCName ASC limit 10 ");
        $jumr2 = mysql_num_rows($tampil1);
        if ($jumr2 > 0) {
            echo "<center>
            <table style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'>
            <font size=2><i><b>TOP 10 Best Seller TC of the month </b><font color='blue' size='1'> (based on deposit date)</font></i></font>
            <table class='bordered'><tr><th>no</th><th width='250'>TC Name</th><th>Total PAX</th></tr>";
            $no = 1;
            while ($r2 = mysql_fetch_array($tampil1)) {

                if ($employee == $r2[TCName]) {
                    $c = "BGCOLOR='#ea7c1f'";
                } else {
                    $c = "BGCOLOR='#fff'";
                }
                echo "<tr $c><td>$no</td>
             <td $c><center>$r2[TCName] ($r2[TCDivision])</td>
             <td $c><center>$r2[totalpax]</td>
             </tr>";
                $no++;
            }
            echo "</table></td><td style='border: 0px solid #000000;'>";
            $tampil2 = mysql_query("SELECT TCDivision,sum(AdultPax)as apax,sum(ChildPax)as cpax,(sum(AdultPax) + sum(ChildPax))as totalpax FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                WHERE month(DepositDate) ='$blnini'
                                AND year(DepositDate)='$thnini'
                                AND year(tour_msproduct.DateTravelFrom) >='$satu1[Year]'
                                and BookingStatus='DEPOSIT'
                                AND tour_msbooking.Status ='ACTIVE'       
                                and tour_msproduct.Status <> 'VOID'
                                AND tour_msbooking.DUMMY = 'NO'
                                GROUP BY TCDivision order by totalpax DESC,TCName ASC limit 10 ");
            echo "<font size=2><i><b>TOP 10 Best Seller Division of the month</b><font color='blue' size='1'> (based on deposit date)</font></i></font>
            <table class='bordered'><tr><th>no</th><th width='250'>Division</th><th>TOTAL PAX</th></tr>";
            $n = 1;
            while ($r = mysql_fetch_array($tampil2)) {
                echo "<tr><td>$n</td>
             <td><center>$r[TCDivision]</td>   
             <td><center>$r[totalpax]</td>
             </tr>";
                $n++;
            }
            echo "</table></td></table>";
        }
    }
    include "../config/koneksifabs.php";
    $tampil = mysql_query("SELECT * FROM tbl_exhibition WHERE EndDate >= '$hariini' and StatusExh ='FIX' ORDER BY StartDate ASC ");
    $ada = mysql_num_rows($tampil);
    echo "<font size='2' color='red'><i>Exhibition Information</i></font>";
    if ($ada == 0) {
        echo "<br><font size='2' color='red'>*No New Exhibition Event</font>";
    } else {
        echo "<table class='bordered'>
          <tr><th>no</th><th>date</th><th>exhibition</th><th>location</th><th>type & web</th><th>Deposit</th></tr>";
        $no = 1;
        while ($r = mysql_fetch_array($tampil)) {
            mysql_close($dbfabs);
            include "../config/koneksi.php";
            $d = mysql_query("SELECT count(tour_msbooking.BookingID)as deppameran,sum(tour_msbooking.AdultPax)as totadult,sum(tour_msbooking.ChildPax)as totchild,sum(tour_msbooking.InfantPax)as totinf FROM tour_msbooking
                                    WHERE tour_msbooking.BookingPlace = '$r[ExhibitionID]' and tour_msbooking.Status='ACTIVE'", $dbltm);
            $dd = mysql_fetch_array($d);
            $dari = date("d M Y", strtotime($r['StartDate']));
            $sampai = date("d M Y", strtotime($r['EndDate']));
            echo "<tr><td>$no</td>
            <td>$dari - $sampai</td>";
            if ($dd['deppameran'] == 0) {
                echo "<td>$r[ExhibitionName]</td>";
            } else {
                echo "<td><a href=?module=msbookingdetail&act=showexhibition&id=$r[ExhibitionID]>$r[ExhibitionName]</a></td>";
            }
            if($r[Type]=='INHOUSE'){$webexh="$r[Type] <font color='blue'>@WEB TOUR</font>";}else{$webexh="$r[Type] <font color='red'>@WEB EXHIBITION</font>";}
            echo "
             <td>$r[ExhibitionLocation]</td>
             <td>$webexh</td>
             <td><center>$dd[deppameran]</td>
             </tr>";
            $no++;
        }
        echo "</table>";
    }
    echo "
    </center>";
    //tes visitor counter
    $dataFile = "visitors.txt";

    $sessionTime = 30; //this is the time in **minutes** to consider someone online before removing them from our file

//Please do not edit bellow this line

    error_reporting(E_ERROR | E_PARSE);

    if (!file_exists($dataFile)) {
        $fp = fopen($dataFile, "w+");
        fclose($fp);
    }

    $ip = $_SERVER['REMOTE_ADDR'];
    $users = array();
    $onusers = array();

//getting
    $fp = fopen($dataFile, "r");
    flock($fp, LOCK_SH);
    while (!feof($fp)) {
        $users[] = rtrim(fgets($fp, 32));
    }
    flock($fp, LOCK_UN);
    fclose($fp);


//cleaning
    $x = 0;
    $alreadyIn = FALSE;
    foreach ($users as $key => $data) {
        list(, $lastvisit) = explode("|", $data);
        if (time() - $lastvisit >= $sessionTime * 60) {
            $users[$x] = "";
        } else {
            if (strpos($data, $ip) !== FALSE) {
                $alreadyIn = TRUE;
                $users[$x] = "$ip|" . time(); //updating
            }
        }
        $x++;
    }

    if ($alreadyIn == FALSE) {
        $users[] = "$ip|" . time();
    }

//writing
    $fp = fopen($dataFile, "w+");
    flock($fp, LOCK_EX);
    $i = 0;
    foreach ($users as $single) {
        if ($single != "") {
            fwrite($fp, $single . "\r\n");
            $i++;
        }
    }
    flock($fp, LOCK_UN);
    fclose($fp);

    if ($uo_keepquiet != TRUE) {
        echo '<div style="padding:5px; margin:auto; background-color:#fff"><b>' . $i . ' branch connected</b></div>';
    }
    
    //+++++++++++++++++++++++++++++
    echo "<p align=right>Login Today: ";
    echo tgl_indo(date("Y m d"));
    echo " | ";
    echo date("H:i:s");
    echo "</p>";
}


// Bagian Master Country
elseif ($_GET['module']=='mscountry'){
  include "modul/mod_mscountry.php";
}
// Bagian FN Test
elseif ($_GET['module']=='fntest'){
  include "modul/mod_fntest.php";
}
// Bagian FAQ
elseif ($_GET['module']=='faq'){
    include "modul/mod_faq.php";
}
// Bagian Aging Kurs
elseif ($_GET['module']=='agingkurs'){
    include "modul/mod_agingkurs.php";
}
// Bagian tester
elseif ($_GET['module']=='tester'){
  include "modul/mod_tester.php";
}                                        
// Bagian View Log
elseif ($_GET['module']=='log'){
  include "modul/mod_log.php";
}
// Bagian Product Best TC
elseif ($_GET['module']=='bestsbo'){
  include "modul/mod_bestsbo.php";
}
// Bagian MS Division
elseif ($_GET['module']=='msdivision'){
  include "modul/mod_msdivision.php";
}
// Bagian MS Exibition
elseif ($_GET['module']=='dtpameran'){
  include "modul/mod_dtpameran.php";
}
// Bagian MS Promo Day
elseif ($_GET['module']=='dtpromoday'){
    include "modul/mod_dtpromoday.php";
}
// Bagian MS Iklan
elseif ($_GET['module']=='dtiklan'){
  include "modul/mod_dtiklan.php";
}  
// Bagian News Update
elseif ($_GET['module']=='information'){
  include "modul/mod_information.php";
}  
// Bagian MS Employee
elseif ($_GET['module']=='msemployee'){
  include "modul/mod_msemployee.php";
}
// Bagian MS Employee Doc
elseif ($_GET['module']=='msemployee1'){
  include "modul/mod_msemployee1.php";
} 
// Bagian Change profile
elseif ($_GET['module']=='profile'){
  include "modul/profile.php";
}
// Bagian Change password
elseif ($_GET['module']=='mspassword'){
    include "modul/password.php"; //include "modul/mod_mspassword.php";
}
// Bagian Change division 
elseif ($_GET['module']=='switchdiv'){
    include "modul/changediv.php";
}
// Bagian MS Destination
elseif ($_GET['module']=='msdestination'){
  include "modul/mod_msdestination.php";
}
// Bagian MS Department
elseif ($_GET['module']=='msoffice'){
  include "modul/mod_msoffice.php";
}
// Bagian MS Airlines
elseif ($_GET['module']=='msairlines'){
  include "modul/mod_msairlines.php";
}
// Bagian MS Group
elseif ($_GET['module']=='msgroup'){
  include "modul/mod_msgroup.php";
}
// Bagian MS Group List
elseif ($_GET['module']=='msgrouplist'){
  include "modul/mod_msgrouplist.php";
}
// Bagian MS TL
elseif ($_GET['module']=='mstourleader'){
  include "modul/mod_mstourleader.php";
}
// Bagian MS Supplier
elseif ($_GET['module']=='mssupplier'){
  include "modul/mod_mssupplier.php";
}
// Bagian MS Season
elseif ($_GET['module']=='msseason'){
  include "modul/mod_msseason.php";
}
// Bagian MS Tourcode
elseif ($_GET['module']=='msproductcode'){
  include "modul/mod_msproductcode.php";
}
// Bagian MS Product Type
elseif ($_GET['module']=='msproducttype'){
  include "modul/mod_msproducttype.php";
}
// Bagian MS Product
elseif ($_GET['module']=='msproduct'){    
    include "modul/mod_msproduct.php";
}
// Bagian External Booking
elseif ($_GET['module']=='msextbooking'){
    include "modul/mod_msextbooking.php";
}
// Bagian MS Product T&C
elseif ($_GET['module']=='tandc'){    
    include "modul/mod_tandc.php";
}
// Bagian MS Product Flight
elseif ($_GET['module']=='msprodflight'){
  include "modul/mod_msprodflight.php";
}
// Bagian MS Voucher
elseif ($_GET['module']=='msvoucher'){
    include "modul/mod_msvoucher.php";
}
// Bagian Voucher Generate
elseif ($_GET['module']=='voucherex'){
    include "modul/mod_voucherex.php";
}
// Bagian Manage Group
elseif ($_GET['module']=='group'){
  include "modul/mod_group.php";
}
elseif ($_GET['module']=='groupsiscom'){
  include "modul/mod_groupsiscom.php";
}
// Bagian MS Group Arrival
elseif ($_GET['module']=='grouparr'){
    include "modul/mod_grouparr.php";
}
// Bagian MS Group Duration Stay
elseif ($_GET['module']=='groupstay'){
    include "modul/mod_groupstay.php";
}
// Bagian TL Assignment
elseif ($_GET['module']=='mstlassign'){
  include "modul/mod_mstlassign.php";
}
// Setup target POS
elseif ($_GET['module']=='mstarget'){
  include "modul/mod_mstarget.php";
}
// Setup target PW
elseif ($_GET['module']=='mstargetpw'){
  include "modul/mod_mstargetpw.php";
}
// Setup target PO
elseif ($_GET['module']=='mstargetpo'){
    include "modul/mod_mstargetpo.php";
}
// Setup target PO PMT
elseif ($_GET['module']=='mstargetpopmt'){
    include "modul/mod_mstargetpopmt.php";
}
// Setup target PO TEZ
elseif ($_GET['module']=='mstargetpotez'){
    include "modul/mod_mstargetpotez.php";
}
// Setup target PO TMR
elseif ($_GET['module']=='mstargetpotmr'){
    include "modul/mod_mstargetpotmr.php";
}
// Setup Visa Timeframe
elseif ($_GET['module']=='msvisagroup'){
  include "modul/mod_msvisagroup.php";
}
// Setup Itinerary
elseif ($_GET['module']=='msitin'){
  include "modul/mod_msitin.php";
}
// Setup Hotel
elseif ($_GET['module']=='mshotel'){
  include "modul/mod_mshotel.php";
}
// Setup Meals
elseif ($_GET['module']=='msmeals'){
    include "modul/mod_msmeals.php";
}
// Setup Upload Visa Form
elseif ($_GET['module']=='upvisaform'){
    include "modul/mod_upvisaform.php";
}
// Sales List Upload
elseif ($_GET['module']=='uplist'){
    include "modul/mod_uplist.php";
}
// List Comparison
elseif ($_GET['module']=='listcompare'){
    include "modul/mod_uplistcompare.php";
}
// Setup Upload Comparison
elseif ($_GET['module']=='upcompare'){
    include "modul/mod_upcompare.php";
}
// Setup Upload Final Confirm
elseif ($_GET['module']=='upfinal'){
    include "modul/mod_upfinal.php";
}
// Setup Send Email
elseif ($_GET['module']=='sendemail'){
    include "emailform.php";
}
// Bagian DASHBOARD - Dailybooking
elseif ($_GET['module']=='dashdailybooking'){
  include "modul/mod_dashdailybooking.php";
}
// Bagian DASHBOARD - monthly booking
elseif ($_GET['module']=='dashmonthbooking'){
    include "modul/mod_dashmonthbooking.php";
}
// Bagian DASHBOARD - Department
elseif ($_GET['module']=='dashdepartment'){
  include "modul/mod_dashdepartment.php";
} 
// Bagian DASHBOARD - Destiantion
elseif ($_GET['module']=='dashdestination'){
  include "modul/mod_dashdestination.php";
}
// Bagian DASHBOARD - Destiantion
elseif ($_GET['module']=='dashcustomer'){
  include "modul/mod_dashcustomer.php";
}
// Bagian DASHBOARD - Trend Sales
elseif ($_GET['module']=='dashtrendsales'){
    include "modul/mod_dashtrendsales.php";
}
// Bagian TC
elseif ($_GET['module']=='rpttc'){
  include "modul/mod_rpttc.php";
}
// Bagian TC Per division
elseif ($_GET['module']=='rpttcdiv'){
    include "modul/mod_rpttcdiv.php";
}
// Bagian Tour Code
elseif ($_GET['module']=='rpttourcode'){
  include "modul/mod_rpttourcode.php";
}
// Report Airline
elseif ($_GET['module']=='rptairlines'){
  include "modul/mod_rptairlines.php";
}
// Report Airline pnr
elseif ($_GET['module']=='rptyearairlinesnew'){
    include "modul/mod_rptyearairlinesnew.php";
}
// Report sales division
elseif ($_GET['module']=='rptdivision'){
  include "modul/mod_rptdivision.php";
}
// Report Operation Today
elseif ($_GET['module']=='rpttoday'){
  include "modul/mod_rpttoday.php";
}
// Report Yearly Ailines
elseif ($_GET['module']=='rptyearairlines'){
  include "modul/mod_rptyearairlines.php";
}
// Report Yearly Destination
elseif ($_GET['module']=='rptyeardest'){
  include "modul/mod_rptyeardest.php";
}
// Report Yearly Summary
elseif ($_GET['module']=='rptyearsummary'){
    include "modul/mod_rptyearsummary.php";
}
// Report Yearly Department
elseif ($_GET['module']=='rptyeardept'){
  include "modul/mod_rptyeardept.php";
}
// Report Yearly POS
elseif ($_GET['module']=='rptyearpos'){
  include "modul/mod_rptyearpos.php";
}
// Bagian Name List
elseif ($_GET['module']=='rptnamelist'){
  include "modul/mod_rptnamelist.php";
}
// Bagian Bucherer
elseif ($_GET['module']=='rptbucherer'){
    include "modul/mod_rptbucherer.php";
}
// Bagian Passport List
elseif ($_GET['module']=='rptpassportlist'){
  include "modul/mod_rptpassportlist.php";
}
// Bagian Rooming List
elseif ($_GET['module']=='rptroominglist'){
  include "modul/mod_rptroominglist.php";
}
// Bagian Group Departure
elseif ($_GET['module']=='rptgrpdep'){
  include "modul/mod_rptgrpdep.php";
}
// Bagian Lugagge tag
elseif ($_GET['module']=='rptlugagetag'){
  include "modul/mod_rptlugagetag.php";
}
// Bagian Product
elseif ($_GET['module']=='rptbooking'){
  include "modul/mod_rptbooking.php";
}
// Bagian Report Realisasi
elseif ($_GET['module']=='rptrealisasi'){
  include "modul/mod_rptrealisasi.php";
}
// Bagian Report Questioner
elseif ($_GET['module']=='rptquestioner'){
  include "modul/mod_rptquestioner.php";
}
// Bagian Report Exhibition
elseif ($_GET['module']=='rptexhibition'){
    include "modul/mod_rptexhibition.php";
}
// Bagian Report daily
elseif ($_GET['module']=='dailyreport'){
  include "modul/dailyreport.php";
}
// Bagian Report daily
elseif ($_GET['module']=='dailysummary'){
  include "modul/dailysummary.php";
}
// Bagian Report daily
elseif ($_GET['module']=='pricelist'){
  include "modul/pricelist.php";
}
// Bagian Report GRV
elseif ($_GET['module']=='rptgrv'){
  include "modul/mod_rptgrv.php";
}
// Bagian Report GRV
elseif ($_GET['module']=='rpttl'){
  include "modul/mod_rpttl.php";
}
// Bagian Report Group Schedule
elseif ($_GET['module']=='rptgroupschdl'){
  include "modul/mod_rptgroupschdl.php";
}
// Bagian Report Visa
elseif ($_GET['module']=='rptvisa'){
  include "modul/mod_rptvisa.php";
}
// Bagian Report Embassy
elseif ($_GET['module']=='rptembassydoc'){
    include "modul/mod_rptembassydoc.php";
}
// Bagian Report uncomplete
elseif ($_GET['module']=='rptuncomplete'){
    include "modul/mod_rptuncomplete.php";
}
// Bagian Booking Detail
elseif ($_GET['module']=='opbookingdetail'){
  include "modul/mod_opbookingdetail.php";
}
// Bagian Manage Sales | Booking
elseif ($_GET['module']=='msbooking'){
  include "modul/mod_msbooking.php";
}
// Bagian Operation | DUMMY Booking
elseif ($_GET['module']=='msbookingdummy'){
    include "modul/mod_msbookingdummy.php";
}
// Bagian Manage Sales | Booking Detail
elseif ($_GET['module']=='msbookingdetail'){
  include "modul/mod_msbookingdetail.php";
}
// Bagian Manage Sales | Duplicate Booking
elseif ($_GET['module']=='duplicatebook'){
  include "modul/mod_duplicatebook.php";
}
// Bagian Manage Sales | Claim Incentive
elseif ($_GET['module']=='claimincentive'){
    include "modul/mod_claimincentive.php";
}
// Bagian Manage Sales | Form Booking Tour
elseif ($_GET['module']=='formbookingtour'){
  include "modul/mod_formbookingtour.php";
}
// Bagian Manage Sales | GRV
elseif ($_GET['module']=='msgrv'){
  include "modul/mod_msgrv.php";
}
// Bagian Manage Sales | TMR Request
elseif ($_GET['module']=='mstmr'){
  include "modul/mod_mstmr.php";
}
// Bagian Manage Sales | Questioner
elseif ($_GET['module']=='questioner'){
  include "questioner.php";
}
// Bagian Search | Booking
elseif ($_GET['module']=='searchdata'){
  include "modul/mod_searchdata.php";
}
// Bagian Search | Product
elseif ($_GET['module']=='searchbooking'){
  include "modul/mod_searchbooking.php";
}
// Bagian Search | Pax Name
elseif ($_GET['module']=='searchpaxname'){
    include "modul/mod_searchpaxname.php";
}
// Bagian Search | PNR
elseif ($_GET['module']=='searchpnr'){
    include "modul/mod_searchpnr.php";
}
// Bagian Report Sales | Division Group
elseif ($_GET['module']=='rptdivgroup'){
  include "modul/mod_rptdivgroup.php";
}
// Bagian Report Sales | Product
elseif ($_GET['module']=='rptproduct'){
  include "modul/mod_rptproduct.php";
}
// Bagian Report Sales | TBF
elseif ($_GET['module']=='rpttbf'){
    include "modul/mod_rpttbf.php";
}
// Bagian Report Sales | Customer
elseif ($_GET['module']=='rptcustomer'){
    include "modul/mod_rptcustomer.php";
}
// Bagian Report Sales | Booking Detail
elseif ($_GET['module']=='rpsalesex'){
  include "modul/mod_rpsalesex.php";
}
// Bagian Walk In Guest
elseif ($_GET['module']=='wig'){
    include "modul/wig.php";
}
// Bagian Tourist Object
elseif ($_GET['module']=='mstouristobject'){
    include "modul/mod_mstouristobject.php";
}
// Bagian Visa
elseif ($_GET['module']=='rptvisapos'){
    include "modul/mod_rptvisapos.php";
}
// Terms n Condition
elseif ($_GET['module']=='mstermcondition'){
    include "modul/mod_mstermcondition.php";
}
// LIVE CHAT
elseif ($_GET['module']=='livechat'){
    include "../chat/index.php";
}
// Apabila modul tidak ditemukan
else {
    echo "<p><b>UNDER CONSTRUCTION/MAINTENANCE</b></p>";
}

?>
