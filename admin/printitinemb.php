<html>
<head>
    <title>Itinerary</title>

</head>
<body>
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" />
<?php
include "../config/koneksi.php";
include "../config/fungsi_an.php";

switch($_GET[act]){
    // Tampil Search Tour code
    default:

        $IDProduct=$_GET[id];
        $ambil=mysql_query("SELECT tour_msproduct.*,
                    tour_msproductcode.* FROM tour_msproduct                                         
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode     
                    WHERE tour_msproduct.IDProduct ='$IDProduct'");
        $isi=mysql_fetch_array($ambil);
        $prodpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                left join tour_msgrv on tour_msgrv.IDGrv = tour_msproductpnr.GrvID
                                left join tour_msairlines on tour_msairlines.AirlinesID = tour_msgrv.GrvAirlines
                                WHERE PnrProd = '$isi[IDProduct]'");

        $cb=0;
        while($pnr=mysql_fetch_array($prodpnr)){
            $airlines1=$pnr[AirlinesName];
            if($cb==0){
                $air="$airlines1";
            }else{
                $air=" & $airlines1";
            }
            $Airlines=$Airlines.$air;
            $cb++;
        }

        $depdet = strtoupper(date("d M Y", strtotime($isi[DateTravelFrom])));
        if($isi[ProductTippingCurr]==''){$tipscurr=$isi[SellingCurr];}else{$tipscurr=$isi[ProductTippingCurr];}
        if($isi[ProductTipping]=='0' or $isi[ProductTipping]==''){$tips='INCLUDE';}else{$tips="NOT INCLUDE";}
        if($isi[GroupType]=='CRUISE'){$logo='images/PTICruise.png';}
        else if($isi[Department]=='TUR EZ'){$logo='images/PTITUREZ.png';}
        else {$logo='images/PTIExperience.png';}
        if($isi[ProductBonus]==''){$bns='';$bns1='';}else{$bns="<font size=2><b>$isi[ProductBonus]</b></font><br>";$bns1="<font size=2><b>$isi[ProductBonus]</b></font></td>";}
        //table utama
        echo "  <center><table style='border:0' >";
        if($isi[GroupType]=='TUR EZ'){
            echo "  <tr><td style='border:0'>  
                    <font size=3><b>$isi[DaysTravel] DAYS $isi[Productcode]</b></font><br>
                    <font size=3><b>BY $Airlines </b></font><br>
                    <font size=2><b>DEP.: $depdet </b></font><br>
                    <font size=2><b>$isi[TourCode]</b></font><br>
                    $bns1
                    <td style='border:0' align='right'><img src='$logo'></td></tr>
                    <tr><td colspan=2 width='695px' height='842px' align='justify' style='border:0'>";
        }else{
            echo "  <tr><td style='border:0' width='695px' height='842px' align='justify'>  
                    <img src='$logo'><br>
                    <font size=3><b>$isi[DaysTravel] DAYS $isi[Productcode]</b></font><br>
                    <font size=3><b>BY $Airlines </b></font><br>
                    <font size=2><b>DEP.: $depdet </b></font><br>
                    <font size=2><b>$isi[TourCode]</b></font><br>
                    $bns";
        }
        $tblitin=mysql_query("SELECT *,CONVERT(Days, UNSIGNED INTEGER) as urut FROM tour_msitin
                                WHERE ProductID ='$isi[IDProduct]' order by urut");
        $day=0;
        $mapfile= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isi[MapFile]) ) ) );
        if($isi[MapFile]<>''){$map="<img src='../admin/map/$mapfile' width='330px' height='330px'>";}else{$map='';}
        while($itin=mysql_fetch_array($tblitin)){
            if(strlen($itin[Days])==1){$hari="0$itin[Days]";}else{$hari="$itin[Days]";}
            $route=$itin[Route];
            if($itin[CashbackMeals]<>''){$cbm="$itin[CashbackMeals]";}else{$cbm="";}
            if($itin[Breakfast]=='YES' AND $itin[Lunch]=='YES' AND $itin[Dinner]=='YES'){$meals="<b>(B/L/D$cbm)</b>";}
            else if($itin[Breakfast]=='YES' AND $itin[Lunch]=='YES' AND $itin[Dinner]==''){$meals="<b>(B/L$cbm)</b>";}
            else if($itin[Breakfast]=='YES' AND $itin[Lunch]=='' AND $itin[Dinner]=='YES'){$meals="<b>(B/D$cbm)</b>";}
            else if($itin[Breakfast]=='' AND $itin[Lunch]=='YES' AND $itin[Dinner]=='YES'){$meals="<b>(L/D$cbm)</b>";}
            else if($itin[Breakfast]=='YES' AND $itin[Lunch]=='' AND $itin[Dinner]==''){$meals="<b>(B$cbm)</b>";}
            else if($itin[Breakfast]=='' AND $itin[Lunch]=='YES' AND $itin[Dinner]==''){$meals="<b>(L$cbm)</b>";}
            else if($itin[Breakfast]=='' AND $itin[Lunch]=='' AND $itin[Dinner]=='YES'){$meals="<b>(D$cbm)</b>";}else{$meals='';}
            $detail=preg_replace("[<p>]", "", str_replace("</p>", "", $itin[Detail] ) );
            if($itin[Transport]=='PLANE'){$trans="<img src='../images/plane.png'>";}
            else if($itin[Transport]=='TRAIN'){$trans="<img src='../images/train.png'>";}
            else if($itin[Transport]=='BUS'){$trans="<img src='../images/bus.png'>";}
            else if($itin[Transport]=='FERRY'){$trans="<img src='../images/ferry.png'>";}
            else {$trans="";}
            $dateday = $isi[DateTravelFrom];
            $tanggalday = substr($dateday,8,2);
            $bulanday = substr($dateday,5,2);
            $tahunday = substr($dateday,0,4);

            //$detail= $itin[Detail] ;
            if($day==0){
                $oneday= strtoupper(date('d M',strtotime('0 second',strtotime($day.' day',strtotime(date($bulanday).'/'.date($tanggalday).'/'.date($tahunday).' 00:00:00')))));
                $itin="<b>HARI $hari/$oneday: $route $trans</b><br>
                           $detail $meals<br><br>";
            }else{
                $oneday= strtoupper(date('d M',strtotime('0 second',strtotime($day.' day',strtotime(date($bulanday).'/'.date($tanggalday).'/'.date($tahunday).' 00:00:00')))));
                $itin="<b>HARI $hari/$oneday: $route $trans</b><br>
                           $detail $meals<br><br>";
            }
            $detailitin=$detailitin.$itin;
            $day++;
        }
        if($isi[GroupType]=='CRUISE'){
            if($isi[ProductColumn]=='one'){echo"<div class='one-col'>$isi[TempatKumpul]<br><br>$detailitin<br>$map";}
            else if($isi[ProductColumn]=='two'){echo"<div class='two-col'>$isi[TempatKumpul]<br><br>$detailitin<br>$map";}

            $qpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                        WHERE PnrProd ='$isi[IDProduct]'");
            $tpnr=mysql_num_rows($qpnr);
            if($tpnr>0){
                echo "<u><b>FLIGHT DETAILS</b></u><br><table style='border:0'>";
                while($pnr=mysql_fetch_array($qpnr)){
                    $fly=mysql_query("SELECT * FROM tour_msprodflight
                                            WHERE IDGrv ='$pnr[GrvID]' order by FID ASC");
                    while($flight=mysql_fetch_array($fly)){
                        if($flight[AirDate]=='0000-00-00' or $flight[AirDate]=='1970-01-01'){
                            $AD='';
                        }else{
                            $AD = strtoupper(date('d M', strtotime($flight[AirDate])));
                        }
                        $ATD = date('H.i', strtotime($flight[AirTimeDep]));
                        $ATA = date('H.i', strtotime($flight[AirTimeArr]));
                        echo"
                            <tr><td style='border:0'><font size=1>$flight[AirCode]</td><td style='border:0'>$AD &nbsp$flight[AirRouteDep] - $flight[AirRouteArr] </td><td style='border:0'>$ATD - $ATA &nbsp$flight[Note]</font></td></tr>";
                    }
                }echo"</table>";
            }
            if($isi[SellingCurr]=='IDR'){
                $cruiseadl12=$isi[CruiseAdl12]/1000;
                $cruiseadl34=$isi[CruiseAdl34]/1000;
                $cruisechd12=$isi[CruiseChd12]/1000;
                $cruisechd34=$isi[CruiseChd34]/1000;
                $singlesell=$isi[SingleSell]/1000;
                $seataxsell=$isi[SeaTaxSell]/1000;
                $taxinssell=$isi[TaxInsSell]/1000;
                $VisaSell=$isi[VisaSell]/1000;
                $VisaSell2=$isi[VisaSell2]/1000;
                $ribuan="<font size='1'>(HARGA DALAM RIBUAN)</font><br>";
            }else{
                $cruiseadl12=$isi[CruiseAdl12];
                $cruiseadl34=$isi[CruiseAdl34];
                $cruisechd12=$isi[CruiseChd12];
                $cruisechd34=$isi[CruiseChd34];
                $singlesell=$isi[SingleSell];
                $seataxsell=$isi[SeaTaxSell];
                $taxinssell=$isi[TaxInsSell];
                $VisaSell=$isi[VisaSell];
                $VisaSell2=$isi[VisaSell2];
                $ribuan="";
            }

            echo"
          <br><center><font size=1><b>JADWAL PERJALANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font>";
            // FORMAT SERIES
        }else if($isi[GroupType]=='TUR EZ'){
            if($isi[ProductColumn]=='one'){echo"<div class='one-col'>$isi[TempatKumpul]<br><br>$detailitin<br>$map</div>";}
            else if($isi[ProductColumn]=='two'){echo"<div class='two-col'>$isi[TempatKumpul]<br><br>$detailitin<br>$map</div><br>";}

            $qpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                        WHERE PnrProd ='$isi[IDProduct]'");
            $tpnr=mysql_num_rows($qpnr);
            if($tpnr>0){
                echo "<u><b>FLIGHT DETAILS</b></u><br><table style='border:0'>";
                while($pnr=mysql_fetch_array($qpnr)){
                    $fly=mysql_query("SELECT * FROM tour_msprodflight
                                            WHERE IDGrv ='$pnr[GrvID]' order by FID ASC");
                    while($flight=mysql_fetch_array($fly)){
                        if($flight[AirDate]=='0000-00-00' or $flight[AirDate]=='1970-01-01'){
                            $AD='';
                        }else{
                            $AD = strtoupper(date('d M', strtotime($flight[AirDate])));
                        }
                        $ATD = date('H.i', strtotime($flight[AirTimeDep]));
                        $ATA = date('H.i', strtotime($flight[AirTimeArr]));
                        echo"
                            <tr><td style='border:0'><font size=1>$flight[AirCode]</td><td style='border:0'>$AD &nbsp$flight[AirRouteDep] - $flight[AirRouteArr] </td><td style='border:0'>$ATD - $ATA &nbsp$flight[Note]</font></td></tr>";
                    }
                }echo"</table>";
            }
            if($isi[SellingCurr]=='IDR'){
                $SellingAdlTwn=$isi[SellingAdlTwn]/1000;
                $SellingChdTwn=$isi[SellingChdTwn]/1000;
                $SellingChdXbed=$isi[SellingChdXbed]/1000;
                $SellingChdNbed=$isi[SellingChdNbed]/1000;
                $SingleSell=$isi[SingleSell]/1000;
                $TaxInsSell=$isi[TaxInsSell]/1000;
                $VisaSell=$isi[VisaSell]/1000;
                $VisaSell2=$isi[VisaSell2]/1000;
                $ribuan="<font size='1'>(HARGA DALAM RIBUAN)</font><br>";
            }else{
                $SellingAdlTwn=$isi[SellingAdlTwn];
                $SellingChdTwn=$isi[SellingChdTwn];
                $SellingChdXbed=$isi[SellingChdXbed];
                $SellingChdNbed=$isi[SellingChdNbed];
                $SingleSell=$isi[SingleSell];
                $TaxInsSell=$isi[TaxInsSell];
                $VisaSell=$isi[VisaSell];
                $VisaSell2=$isi[VisaSell2];
                $ribuan="";
            }
            echo"
          <br><center><font size=1><b>JADWAL PERJALANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font>";
            // FORMAT SERIES
        }else{
            if($isi[ProductColumn]=='one'){echo"<div class='one-col'>$isi[TempatKumpul]<br><br>$detailitin<br>$map</div>";}
            else if($isi[ProductColumn]=='two'){echo"<div class='two-col'>$isi[TempatKumpul]<br><br>$detailitin<br>$map</div><br>";}

            $qpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                        WHERE PnrProd ='$isi[IDProduct]'");
            $tpnr=mysql_num_rows($qpnr);
            if($tpnr>0){
                echo "<u><b>FLIGHT DETAILS</b></u><br><table style='border:0'>";
                while($pnr=mysql_fetch_array($qpnr)){
                    $fly=mysql_query("SELECT * FROM tour_msprodflight
                                            WHERE IDGrv ='$pnr[GrvID]' order by FID ASC");
                    while($flight=mysql_fetch_array($fly)){
                        if($flight[AirDate]=='0000-00-00' or $flight[AirDate]=='1970-01-01'){
                            $AD='';
                        }else{
                            $AD = strtoupper(date('d M', strtotime($flight[AirDate])));
                        }
                        $ATD = date('H.i', strtotime($flight[AirTimeDep]));
                        $ATA = date('H.i', strtotime($flight[AirTimeArr]));
                        echo"
                            <tr><td style='border:0'><font size=1>$flight[AirCode]</td><td style='border:0'>$AD &nbsp$flight[AirRouteDep] - $flight[AirRouteArr] </td><td style='border:0'>$ATD - $ATA &nbsp$flight[Note]</font></td></tr>";
                    }
                }echo"</table>";
            }
            if($isi[SellingCurr]=='IDR'){
                $SellingAdlTwn=$isi[SellingAdlTwn]/1000;
                $SellingChdTwn=$isi[SellingChdTwn]/1000;
                $SellingChdXbed=$isi[SellingChdXbed]/1000;
                $SellingChdNbed=$isi[SellingChdNbed]/1000;
                $SingleSell=$isi[SingleSell]/1000;
                $TaxInsSell=$isi[TaxInsSell]/1000;
                $VisaSell=$isi[VisaSell]/1000;
                $VisaSell2=$isi[VisaSell2]/1000;
                $ribuan="<font size='1'>(HARGA DALAM RIBUAN)</font><br>";
            }else{
                $SellingAdlTwn=$isi[SellingAdlTwn];
                $SellingChdTwn=$isi[SellingChdTwn];
                $SellingChdXbed=$isi[SellingChdXbed];
                $SellingChdNbed=$isi[SellingChdNbed];
                $SingleSell=$isi[SingleSell];
                $TaxInsSell=$isi[TaxInsSell];
                $VisaSell=$isi[VisaSell];
                $VisaSell2=$isi[VisaSell2];
                $ribuan="";
            }
            echo"
          <br><center><font size=1><b>JADWAL PERJALANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font>";
        }
        echo "</td></tr></table>";
        break;

}
?>
</body>
</html>