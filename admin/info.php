 <html>
<head>
<title>Information Tour</title>
<link href="../config/print.css" rel="stylesheet" type="text/css" />      
<script>
<!--

//enter refresh time in "minutes:seconds" Minutes should range from 0 to inifinity. Seconds should range from 0 to 59
 var limit="0:30"

if (document.images) {
    var parselimit = limit.split(":")
    parselimit = parselimit[0] * 60 + parselimit[1] * 1
}
function beginrefresh() {

    if (!document.images)
        return
    if (parselimit == 1) {
        var sit = eval(kirim.statseat.value);
        parent.hello(sit)
        window.location.reload()
    }
    else {
        parselimit -= 1
        curmin = Math.floor(parselimit / 60)
        cursec = parselimit % 60
        if (curmin != 0)
            curtime = curmin + " minutes and " + cursec + " seconds left until page refresh!"
        else
            curtime = "(Refresh in " + cursec + " seconds)"
        window.status = curtime
        setTimeout("beginrefresh()", 1000)
        document.getElementById("countdown").innerHTML = curtime;
    }
}

window.onload=beginrefresh

</script></head>
<?php 
include "../config/koneksi.php";
include "../config/fungsi_an.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<body>
         
<?php  switch($_GET[act]) {                 //  <img src='images/pano1.jpg'>
    default:
        $edit = mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
        $r = mysql_fetch_array($edit);
        $QBookingan = mysql_query("SELECT IDTourCode,sum(AdultPax+ChildPax) as pax FROM tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  IDTourCode='$_GET[id]' ");
        $DBooking = mysql_fetch_array($QBookingan);
        $cuma = mysql_query("SELECT * FROM tour_msdiscount WHERE IDProduct = '$_GET[id]' and Status = 'ACTIVE'  
                                    ORDER BY IDDiscount DESC limit 1");
        $saja = mysql_fetch_array($cuma);
        $maritot = mysql_query("SELECT count(tour_msbookingdetail.IDDetail)as tot FROM tour_msbookingdetail 
                                        left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                        where tour_msbooking.IDTourcode = '$_GET[id]' and tour_msbookingdetail.Gender <>'INFANT'
                                        AND tour_msbookingdetail.Status<>'CANCEL'
                                        AND tour_msbooking.Status='ACTIVE'");
        $tungtot = mysql_fetch_array($maritot);
        $minawal = $tungtot[tot] + 1;
        if ($saja[Max1] == '') {
            $min1 = '';
            $min2 = '';
            $min3 = '';
            $min4 = '';
            $min5 = '';
            $min6 = '';
            $min7 = '';
        } else {
            $min1 = 1;
            if ($saja[Max2] == '') {
                $min2 = '';
            } else {
                $min2 = $saja[Max1] + 1;
            }
            if ($saja[Max3] == '') {
                $min3 = '';
            } else {
                $min3 = $saja[Max2] + 1;
            }
            if ($saja[Max4] == '') {
                $min4 = '';
            } else {
                $min4 = $saja[Max3] + 1;
            }
            if ($saja[Max5] == '') {
                $min5 = '';
            } else {
                $min5 = $saja[Max4] + 1;
            }
            if ($saja[Max6] == '') {
                $min6 = '';
            } else {
                $min6 = $saja[Max5] + 1;
            }
            if ($saja[Max7] == '') {
                $min7 = '';
            } else {
                $min7 = $saja[Max6] + 1;
            }
        }
        $dari = date("d M Y", strtotime($r[DateTravelFrom]));
        $sampai = date("d M Y", strtotime($r[DateTravelTo]));
        $seatsisa = $r[Seat] - $DBooking[pax];
        $VisaSell = $r[VisaSell] / 1000;
        $VisaSell2 = $r[VisaSell2] / 1000;
        $VisaSell3 = $r[VisaSell3] / 1000;
        $VisaSell4 = $r[VisaSell4] / 1000;
        $VisaSell5 = $r[VisaSell5] / 1000;
        echo "
          <table class='bordered'>
          <tr><th colspan=8><center>Selling Price in $r[SellingCurr]<br>(Harga dalam ribuan)</th></tr>
          <tr><td colspan=2>Available Seat</td> <td colspan=6>$seatsisa PAX <span id='countdown' style='font-weight: bold;color:red;'></span></td></tr>
          <tr><td colspan=2>Date of Service</td> <td colspan=6>$dari - $sampai</td></tr>
          <tr><td colspan=2>Number of Days</td><td colspan=6> $r[DaysTravel] days</td></tr>   
          <tr><td colspan=2>Flight</td> <td colspan=6>$r[Flight]</td></tr>
          <tr><td colspan=2>Tour Code</td> <td colspan=6>$r[TourCode]</td></tr>  
          
          <tr><td colspan=2>Visa</td> <td colspan=6>$r[Visa] ";
        if ($r[Visa] == 'INCLUDE' || $r[Visa] == 'NOT INCLUDE') {
            $tampil = mysql_query("SELECT * FROM tbl_msembassy where CountryID = '$r[Embassy01]'");
            $s = mysql_fetch_array($tampil);
            if ($s[Country] <> '') {
                echo "<br>- $s[Country]";
            } else {
                $qdoc = mysql_query("SELECT * FROM doa_product where CountryName = '$r[Embassy01]' ");
                $doc = mysql_fetch_array($qdoc);
                if ($doc[CountryName] <> '') {
                    echo "<br>- $doc[CountryName]";
                } else {
                }
            }
            $tampil1 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = '$r[Embassy02]'");
            $s1 = mysql_fetch_array($tampil1);
            if ($s1[Country] <> '') {
                echo "<br>- $s1[Country]";
            } else {
                $qdoc1 = mysql_query("SELECT * FROM doa_product where CountryName = '$r[Embassy02]' ");
                $doc1 = mysql_fetch_array($qdoc1);
                if ($doc1[CountryName] <> '') {
                    echo "<br>- $doc1[CountryName]";
                } else {
                }
            }
            $tampil2 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = '$r[Embassy03]'");
            $s2 = mysql_fetch_array($tampil2);
            if ($s2[Country] <> '') {
                echo "<br>- $s2[Country]";
            } else {
                $qdoc2 = mysql_query("SELECT * FROM doa_product where CountryName = '$r[Embassy03]' ");
                $doc2 = mysql_fetch_array($qdoc2);
                if ($doc2[CountryName] <> '') {
                    echo "<br>- $doc2[CountryName]";
                } else {
                }
            }
            $tampil3 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = '$r[Embassy04]'");
            $s3 = mysql_fetch_array($tampil3);
            if ($s3[Country] <> '') {
                echo "<br>- $s3[Country]";
            } else {
                $qdoc3 = mysql_query("SELECT * FROM doa_product where CountryName = '$r[Embassy04]' ");
                $doc3 = mysql_fetch_array($qdoc3);
                if ($doc3[CountryName] <> '') {
                    echo "<br>- $doc3[CountryName]";
                } else {
                }
            }
            $tampil4 = mysql_query("SELECT * FROM tbl_msembassy where CountryID = '$r[Embassy05]'");
            $s4 = mysql_fetch_array($tampil4);
            if ($s4[Country] <> '') {
                echo "<br>- $s4[Country]";
            } else {
                $qdoc4 = mysql_query("SELECT * FROM doa_product where CountryName = '$r[Embassy05]' ");
                $doc4 = mysql_fetch_array($qdoc4);
                if ($doc4[CountryName] <> '') {
                    echo "<br>- $doc4[CountryName]";
                } else {
                }
            }
        }
        echo "</td></tr>";
        if ($r[Embassy01] <> '0') {
            $Qvisa = mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$r[Embassy01]'");
            $Dvisa = mysql_fetch_array($Qvisa);
            if ($Dvisa[Country] <> '') {
                $DvisaCountry = $Dvisa[Country];
            } else {
                $qdoc = mysql_query("SELECT * FROM doa_product where CountryName = $r[Embassy01] ");
                $doc = mysql_fetch_array($qdoc);
                $DvisaCountry = $doc[CountryName];
            }
            echo "<tr><td colspan=2>VISA $DvisaCountry</td><td colspan='6'>IDR. " . number_format($Dvisa[VisaSell], 0, '', '.');
            echo "</td></tr>";
        }
        if ($r[Embassy02] <> '0') {
            $Qvisa2 = mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$r[Embassy02]'");
            $Dvisa2 = mysql_fetch_array($Qvisa2);
            if ($Dvisa2[Country] <> '') {
                $DvisaCountry2 = $Dvisa2[Country];
            } else {
                $qdoc2 = mysql_query("SELECT * FROM doa_product where CountryName = $r[Embassy02] ");
                $doc2 = mysql_fetch_array($qdoc2);
                $DvisaCountry2 = $doc2[CountryName];
            }
            echo "<tr><td colspan=2>VISA $Dvisa2Country</td><td colspan='6'>IDR. " . number_format($Dvisa[VisaSell2], 0, '', '.');
            echo "</td></tr>";
        }
        if ($r[Embassy03] <> '0') {
            $Qvisa3 = mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$r[Embassy03]'");
            $Dvisa3 = mysql_fetch_array($Qvisa3);
            if ($Dvisa3[Country] <> '') {
                $DvisaCountry3 = $Dvisa3[Country];
            } else {
                $qdoc3 = mysql_query("SELECT * FROM doa_product where CountryName = $r[Embassy03] ");
                $doc3 = mysql_fetch_array($qdoc3);
                $DvisaCountry3 = $doc3[CountryName];
            }
            echo "<tr><td colspan=2>VISA $DvisaCountry3</td><td colspan='6'>IDR. " . number_format($Dvisa[VisaSell3], 0, '', '.');
            echo "</td></tr>";
        }
        if ($r[Embassy04] <> '0') {
            $Qvisa4 = mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$r[Embassy04]'");
            $Dvisa4 = mysql_fetch_array($Qvisa4);
            if ($Dvisa4[Country] <> '') {
                $DvisaCountry4 = $Dvisa4[Country];
            } else {
                $qdoc4 = mysql_query("SELECT * FROM doa_product where CountryName = $r[Embassy04] ");
                $doc4 = mysql_fetch_array($qdoc4);
                $DvisaCountry4 = $doc4[CountryName];
            }
            echo "<tr><td colspan=2>VISA $DvisaCountry4</td><td colspan='6'>IDR. " . number_format($Dvisa[VisaSell4], 0, '', '.');
            echo "</td></tr>";
        }
        if ($r[Embassy05] <> '0') {
            $Qvisa5 = mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$r[Embassy05]'");
            $Dvisa5 = mysql_fetch_array($Qvisa5);
            if ($Dvisa5[Country] <> '') {
                $DvisaCountry5 = $Dvisa5[Country];
            } else {
                $qdoc5 = mysql_query("SELECT * FROM doa_product where CountryName = $r[Embassy05] ");
                $doc5 = mysql_fetch_array($qdoc5);
                $DvisaCountry5 = $doc5[CountryName];
            }
            echo "<tr><td colspan=2>VISA $DvisaCountry5</td><td colspan='6'>IDR. " . number_format($Dvisa[VisaSell5], 0, '', '.');
            echo "</td></tr>";
        }
        echo "<tr><td colspan=2>Domestic Airport Tax</td><td colspan=6>";
        if ($r[AirTaxSell] == 0) {
            echo "INCLUDE";
        } else {
            echo "$r[AirTaxCurr]. " . number_format($r[AirTaxSell] / 1000, 0, '', '.');
        }
        echo "</td></tr>
            <tr><td colspan=2>Airport Tax & Flight Insurance</td><td colspan=6>$r[SellingCurr]. " . number_format($r[TaxInsSell] / 1000, 0, '', '.');
        echo "</td></tr>
            <tr><td colspan=2>Single Supplement</td><td colspan=6>$r[SellingCurr]. " . number_format($r[SingleSell] / 1000, 0, '', '.');
        echo "</td></tr>";
        $file = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r['AttachmentFile']))));
        echo "<tr><td colspan=2>Attachment</td><td colspan=6>";

        $cariitin = mysql_query("SELECT * FROM tour_msitin
                    WHERE ProductID = '$r[IDProduct]'");
        $adaitin = mysql_num_rows($cariitin);
        if ($adaitin > 0) {
            echo "<input type='button' value='VIEW' onclick=window.open('media.php?module=msitin&act=showitin&id=$r[IDProduct]')>";
        } else {
            echo "NONE";
        }
        echo "   </td></tr>
            <tr><td colspan=2>Remarks</td><td colspan=6>$r[Remarks]</td></tr>";
        if ($r[GroupType] == 'CRUISE') {
            $CruiseAdl12 = number_format($r[CruiseAdl12] / 1000, 0, '', '.');
            $CruiseLoAdl12 = number_format($r[CruiseLoAdl12] / 1000, 0, '', '.');
            $CruiseAdl34 = number_format($r[CruiseAdl34] / 1000, 0, '', '.');
            $CruiseLoAdl34 = number_format($r[CruiseLoAdl34] / 1000, 0, '', '.');
            $CruiseChd12 = number_format($r[CruiseChd12] / 1000, 0, '', '.');
            $CruiseLoChd12 = number_format($r[CruiseLoChd12] / 1000, 0, '', '.');
            $CruiseChd34 = number_format($r[CruiseChd34] / 1000, 0, '', '.');
            $CruiseLoChd34 = number_format($r[CruiseLoChd34] / 1000, 0, '', '.');
            $SellingInfant = number_format($r[SellingInfant] / 1000, 0, '', '.');
            $LAInfant = number_format($r[LAInfant] / 1000, 0, '', '.');
            $SeaTaxSell = number_format($r[SeaTaxSell] / 1000, 0, '', '.');
            $SeaTaxSell = number_format($r[SeaTaxSell] / 1000, 0, '', '.');
            $TaxInsSell = number_format($r[TaxInsSell] / 1000, 0, '', '.');
            echo "<tr><th></th><th width='160' colspan='2'>ADULT </th><th width='160' colspan='2'>Child</th><th></th><th width='160' colspan='2'>Tax</th></tr>
          <tr><th>Cruise</th><th width=80>1-2 PAX</th><th width=80>3-4 PAX</th><th width=80>1-2 PAX</th><th width=80>3-4 PAX</th><th width=80>Infant</th><th width=80>Sea</th><th width=80>Int</th></tr>
                <tr><th>Tour</th>
                    <td><center>$CruiseAdl12</td></td>
                    <td><center>$CruiseAdl34</td>
                    <td><center>$CruiseChd12</td>
                    <td><center>$CruiseChd34</td>
                    <td><center>$SellingInfant</td>
                    <td><center>$SeaTaxSell</td>
                    <td><center>$TaxInsSell</td>
                </tr>
                <tr><th>Land Only</th>
                    <td><center>$CruiseLoAdl12</td></td>
                    <td><center>$CruiseLoAdl34</td>
                    <td><center>$CruiseLoChd12</td>
                    <td><center>$CruiseLoChd34</td>
                    <td><center>$LAInfant</td>
                    <td><center>$SeaTaxSell</td>
                    <td><center></td>
                </tr>";
        } else {
            $SellingAdlTwn = number_format($r[SellingAdlTwn] / 1000, 0, '', '.');
            $LAAdlTwn = number_format($r[LAAdlTwn] / 1000, 0, '', '.');
            $SellingChdTwn = number_format($r[SellingChdTwn] / 1000, 0, '', '.');
            $LAChdTwn = number_format($r[LAChdTwn] / 1000, 0, '', '.');
            $SellingChdXbed = number_format($r[SellingChdXbed] / 1000, 0, '', '.');
            $LAChdXbed = number_format($r[LAChdXbed] / 1000, 0, '', '.');
            $SellingChdNbed = number_format($r[SellingChdNbed] / 1000, 0, '', '.');
            $LAChdNbed = number_format($r[LAChdNbed] / 1000, 0, '', '.');
            $SellingInfant = number_format($r[SellingInfant] / 1000, 0, '', '.');
            $LAInfant = number_format($r[LAInfant] / 1000, 0, '', '.');
            $TaxInsSell = number_format($r[TaxInsSell] / 1000, 0, '', '.');
            echo "<tr><th></th><th width=80>ADULT</th><th width=80>CHILD TWN</th><th width=80>CHILD X BED</th><th width=80>Child No bed</th><th width=80>Infant</th><th width='80'>Tax</th></tr>
                <tr><th>Tour</th>
                    <td><center>$SellingAdlTwn</td></td>
                    <td><center>$SellingChdTwn</td>
                    <td><center>$SellingChdXbed</td>
                    <td><center>$SellingChdNbed</td>
                    <td><center>$SellingInfant</td>
                    <td><center>$TaxInsSell</td>
                </tr>
                <tr><th>LA Only</th>
                    <td><center>$LAAdlTwn</td></td>
                    <td><center>$LAChdTwn</td>
                    <td><center>$LAChdXbed</td>
                    <td><center>$LAChdNbed</td>
                    <td><center>$LAInfant</td>
                    <td></td>
                </tr>";
        }
        echo "</table>
          <input type=hidden name=id value='$r[IDProduct]'>
          <table style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'>
          <table class='bordered' style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'>
         <tr><th width=100>description</th><th width=100>total pax</th></tr>";

        $maritot = mysql_query("SELECT * FROM tour_msproduct where TourCode = '$r[TourCode]' ");
        $tungtot = mysql_fetch_array($maritot);
        echo " <tr><td><center><b>TOTAL DEP</td><td><center><b>$tungtot[SeatDeposit]</td><input type='hidden' name='awalmin' value='$tungtot[SeatDeposit]'></tr>
          </table></td><td style='border: 0px solid #000000;'>
          <table class='bordered' style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'>
         <tr><th colspan=3>current discount composition</th></tr>
         <tr><th>from</th><th>to</th><th>amount</th></tr>";

        $maridis = mysql_query("SELECT * FROM tour_msdiscount where IDProduct = '$r[IDProduct]' and Status='ACTIVE' ");
        $d = mysql_fetch_array($maridis);
        $min2 = $d[Max1] + 1;
        $min3 = $d[Max2] + 1;
        $min4 = $d[Max3] + 1;
        $min5 = $d[Max4] + 1;
        $min6 = $d[Max5] + 1;
        $min7 = $d[Max6] + 1;
        if ($d[Max1] <> '') {
            echo " <tr><td><center>$d[Min] Pax</td><td><center>$d[Max1] Pax</td><td><center>$d[Disc1]</td></tr>";
        } else {
            echo "<tr><td colspan='3'><center>NO DISCOUNT</td></tr>";
        }
        if ($d[Max2] <> '') {
            echo "<tr><td><center>$min2 Pax</td><td><center>$d[Max2] Pax</td><td><center>$d[Disc2]</td></tr>";
        }
        if ($d[Max3] <> '') {
            echo "<tr><td><center>$min3 Pax</td><td><center>$d[Max3] Pax</td><td><center>$d[Disc3]</td></tr>";
        }
        if ($d[Max4] <> '') {
            echo "<tr><td><center>$min4 Pax</td><td><center>$d[Max4] Pax</td><td><center>$d[Disc4]</td></tr>";
        }
        if ($d[Max5] <> '') {
            echo "<tr><td><center>$min5 Pax</td><td><center>$d[Max5] Pax</td><td><center>$d[Disc5]</td></tr>";
        }
        if ($d[Max6] <> '') {
            echo "<tr><td><center>$min6 Pax</td><td><center>$d[Max6] pax</td><td><center>$d[Disc6]</td></tr>";
        }
        if ($d[Max7] <> '') {
            echo "<tr><td><center>$min7 Pax</td><td><center>$d[Max7] Pax</td><td><center>$d[Disc7]</td></tr>";
        }
        echo " </table></td></tr></table>
          
          <form name='kirim'>
          <input type='hidden' name='statseat' id='input' value='$seatsisa'/>
          </form>
          <br><br>";
        break;

}
?>
</body>
</html>  