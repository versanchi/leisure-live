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
     $qdprt=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$IDProduct'");
     $dprt=mysql_fetch_array($qdprt);
     $style=$dprt[StyleItin];
     $lang='INDONESIA';
     if($style=='LTM'){
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
         if($isi[ProductTippingStatus]=='include'){$tips='INCLUDE';}else{$tips=$isi[ProductTipping];}//{$tips="$tipscurr.$isi[ProductTipping]";}
         if($isi[GroupType]=='CRUISE'){$logo='images/PTICruise.png';}
         else if ($isi[GroupType]=='CONSORTIUM'){$logo='';}
         else if($isi[Department]=='TUR EZ'){$logo='images/PTITUREZ.png';}
         else {$logo='images/PTIExperience.png';}
         if($isi[ShockingOffer]=='YES'){$shockimg="<img src='images/shockoff.png'>";}
         if($isi[ProductBonus]==''){$bns='';$bns1='';}else{$bns="<font size=2><b>$isi[ProductBonus]</b></font><br>";$bns1="<font size=2><b>$isi[ProductBonus]</b></font></td>";}
         if(($isi[ProductCode]=='HFS' OR $isi[ProductCode]=='HFL' OR $isi[ProductCode]=='HFR'
                 OR $isi[ProductCode]=='HLF' OR $isi[ProductCode]=='HRL' OR $isi[ProductCode]=='HSL')
             AND $isi[DateTravelFrom] >= '2018-01-01' AND $isi[DateTravelFrom] <= '2019-01-01') {
             $promoministry = "<img src='images/160lourdes.png'>";
         }
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
                    <img src='$logo'>$shockimg$promoministry<br>
                    <font size=3><b>$isi[DaysTravel] DAYS $isi[Productcode]</b></font><br>
                    <font size=3><b>BY $Airlines </b></font><br>
                    <font size=2><b>DEP.: $depdet </b></font><br>
                    <font size=2><b>$isi[TourCode]</b></font><br>
                    $bns";
         }
         $tblitin=mysql_query("SELECT *,CONVERT(Days, UNSIGNED INTEGER) as urut FROM tour_msitin
                                WHERE ProductID ='$isi[IDProduct]' and Language = '$lang' and Style = '$style' order by urut");
         $day=0;
         $mapfile= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isi[MapFile]) ) ) );
         if($isi[MapFile]<>''){$map="<img src='../admin/map/$mapfile' width='330px' height='330px'>";}else{$map='';}
         while($itin=mysql_fetch_array($tblitin)){
             if($itin[CashbackMeals]<>''){$cbm="$itin[CashbackMeals]";}else{$cbm="";}
             if(strlen($itin[Days])==1){$hari="0$itin[Days]";}else{$hari="$itin[Days]";}
             $route=$itin[Route];
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
         //FORMAT CRUISE
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
                 $VisaSell3=$isi[VisaSell3]/1000;
                 $VisaSell4=$isi[VisaSell4]/1000;
                 $VisaSell5=$isi[VisaSell5]/1000;
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
                 $VisaSell3=$isi[VisaSell3];
                 $VisaSell4=$isi[VisaSell4];
                 $VisaSell5=$isi[VisaSell5];
                 $ribuan="";
             }
             if($isi[StatusProduct]<>'FINALIZE'){
                 echo"$ribuan
          <table>
          <tr><th colspan=3>HARGA TOUR</th></tr>
          <tr><td>DEWASA (1st/2nd Person)</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>".number_format($cruiseadl12, 0, '', ',');echo"</td></td>
          <tr><td>DEWASA (3rd/4th Person)</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>".number_format($cruiseadl34, 0, '', ',');echo"</td>
          <tr><td>ANAK-ANAK (1st/2nd Person)</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>".number_format($cruisechd12, 0, '', ',');echo"</td>
          <tr><td>ANAK-ANAK (3rd/4th Person)</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>".number_format($cruisechd34, 0, '', ',');echo"</td>
          <tr><td>SINGLE SUPPLEMENT</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>".number_format($singlesell, 0, '', ',');echo"</td>
          <tr><td>SEAPORT, DEPT TAX, GRATUITIES</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>".number_format($seataxsell, 0, '', ',');echo"</td>
          <tr><td>AIRPORT TAX INTERNATIONAL*</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>".number_format($taxinssell, 0, '', ',');echo"</td>
          <tr><td>TIPPING**</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>$tips</td></tr>";
                 if($isi[Embassy01]<>'0')
                 {   echo"<tr><td>VISA $isi[Embassy01]</td><td style='text-align:right'>IDR</td><td style='text-align:right'>".number_format($VisaSell, 0, '', ',');echo"</td></tr>";
                 }
                 if($isi[Embassy02]<>'0')
                 {   echo"<tr><td>VISA $isi[Embassy02]</td><td style='text-align:right'>IDR</td><td style='text-align:right'>".number_format($VisaSell2, 0, '', ',');echo"</td></tr>";
                 }
                 if($isi[Embassy03]<>'0')
                 {  echo"<tr><td>VISA $isi[Embassy03]</td><td style='text-align:right'>IDR</td><td style='text-align:right'>".number_format($VisaSell3, 0, '', ',');echo"</td></tr>";
                 }
                 if($isi[Embassy04]<>'0')
                 {   echo"<tr><td>VISA $isi[Embassy04]</td><td style='text-align:right'>IDR</td><td style='text-align:right'>".number_format($VisaSell4, 0, '', ',');echo"</td></tr>";
                 }
                 if($isi[Embassy05]<>'0')
                 {   echo"<tr><td>VISA $isi[Embassy05]</td><td style='text-align:right'>IDR</td><td style='text-align:right'>".number_format($VisaSell5, 0, '', ',');echo"</td></tr>";
                 }
                 echo "</table>
          </div><br>
          <font size=1>* AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** TIPPING DIBAYARKAN DI NEGARA TUJUAN<br>
                        **** HARGA TOUR BELUM TERMASUK PPN 1%<br>
                        <b>***** NILAI DALAM MATA UANG RUPIAH DIHITUNG BERDASARKAN KURS ASUMSI DAN DAPAT BERUBAH SEWAKTU-WAKTU</b>
                                        </font><br>";
             }
             if($isi[Insurance]=='INCLUDE'){echo"<center><img src='images/panoramasure.png'>";}echo"
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
                 $VisaSell3=$isi[VisaSell3]/1000;
                 $VisaSell4=$isi[VisaSell4]/1000;
                 $VisaSell5=$isi[VisaSell5]/1000;
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
                 $VisaSell3=$isi[VisaSell3];
                 $VisaSell4=$isi[VisaSell4];
                 $VisaSell5=$isi[VisaSell5];
                 $ribuan="";
             }
             if($isi[StatusProduct]<>'FINALIZE'){
                 echo"
          <font size=2><b>MINIMUM KEBERANGKATAN 20 PESERTA DEWASA:</b></font><br>
          $ribuan
          <table><tr><th width='80' rowspan='2' style=vertical-align:middle>DEWASA TWIN SHARE</th><th colspan='3'>ANAK-ANAK (2 - 11 TAHUN)</th>
                <th width=60 rowspan='2' style=vertical-align:middle>SGL SUPP</th><th width='80' rowspan='2' style=vertical-align:middle>APO TAX INTL*</th>
                <th width='100' rowspan='2' style=vertical-align:middle>TIPPING**</th>";
                 if($isi[Embassy01]<>'0')
                 {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy01]</th>";
                 }
                 if($isi[Embassy02]<>'0')
                 {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy02]</th>";
                 }
                 if($isi[Embassy03]<>'0')
                 {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy03]</th>";
                 }
                 if($isi[Embassy04]<>'0')
                 {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy04]</th>";
                 }
                 if($isi[Embassy05]<>'0')
                 {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy05]</th>";
                 }
                 echo "</tr><tr><th width=70>TWIN SHARE</th><th width=70>EXTRA BED</th><th width=70>NO BED</th>
                <tr><td><center>$isi[SellingCurr]. ".number_format($SellingAdlTwn, 0, '', ',');echo"</td></td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdTwn, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdXbed, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdNbed, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SingleSell, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($TaxInsSell, 0, '', ',');echo"</td>
                    <td><center>$tips</td>";
                 if($isi[Embassy01]<>'0')
                 {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell, 0, '', ',');echo"</td>";}
                 if($isi[Embassy02]<>'0')
                 {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell2, 0, '', ',');echo"</td>";}
                 if($isi[Embassy03]<>'0')
                 {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell3, 0, '', ',');echo"</td>";}
                 if($isi[Embassy04]<>'0')
                 {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell4, 0, '', ',');echo"</td>";}
                 if($isi[Embassy05]<>'0')
                 {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell5, 0, '', ',');echo"</td>";}
                 echo "</tr>";

                 echo "</table>
          <font size=1>* AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** TIPPING DIBAYARKAN DI NEGARA TUJUAN<br>
                        **** HARGA TOUR BELUM TERMASUK PPN 1%<br>
                        <b>***** NILAI DALAM MATA UANG RUPIAH DIHITUNG BERDASARKAN KURS ASUMSI DAN DAPAT BERUBAH SEWAKTU-WAKTU</b>
                                        </font><br>";
             }
             if($isi[Insurance]=='INCLUDE'){echo"<center><img src='images/panoramasure.png'>";}echo"
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
                 $VisaSell3=$isi[VisaSell3]/1000;
                 $VisaSell4=$isi[VisaSell4]/1000;
                 $VisaSell5=$isi[VisaSell5]/1000;
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
                 $VisaSell3=$isi[VisaSell3];
                 $VisaSell4=$isi[VisaSell4];
                 $VisaSell5=$isi[VisaSell5];
                 $ribuan="";
             }
             if($isi[StatusProduct]<>'FINALIZE'){
                 echo"
          <font size=2><b>MINIMUM KEBERANGKATAN 20 PESERTA DEWASA:</b></font><br>
          $ribuan
          <table><tr><th width='80' rowspan='2' style=vertical-align:middle>DEWASA TWIN SHARE</th><th colspan='3'>ANAK-ANAK (2 - 11 TAHUN)</th>
                <th width=60 rowspan='2' style=vertical-align:middle>SGL SUPP</th><th width='80' rowspan='2' style=vertical-align:middle>APO TAX INTL*</th>
                <th width='100' rowspan='2' style=vertical-align:middle>TIPPING**</th></tr>
                <tr><th width=70>TWIN SHARE</th><th width=70>EXTRA BED</th><th width=70>NO BED</th>
                <tr><td><center>$isi[SellingCurr]. ".number_format($SellingAdlTwn, 0, '', ',');echo"</td></td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdTwn, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdXbed, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdNbed, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SingleSell, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($TaxInsSell, 0, '', ',');echo"</td>
                    <td><center>$tips</td></tr>
                </table>";
            if($isi[Embassy01]<>'0' OR $isi[Embassy02]<>'0' OR $isi[Embassy03]<>'0' OR $isi[Embassy04]<>'0' OR $isi[Embassy05]<>'0' ) {
                echo "<table><tr><th colspan='3'>VISA - $isi[Visa]</th></tr>
                        <tr><th>COUNTRY</th><th>TYPE</th><th>PRICE</th></tr>";
                if ($isi[Embassy01] <> '0') {
                    if ($isi[DoaId01] <> '0') {
                        $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                              WHERE B.Id = '$isi[DoaId01]' ");
                        $dvisadoa = mysql_fetch_array($qvisadoa);
                        $visadoa = $dvisadoa[SellingValueInRupiah] / 1000;
                        echo "<tr><td>$isi[Embassy01]</td>
                              <td>$dvisadoa[Name] - $dvisadoa[Process]</td>
                              <td><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                        echo "</td></tr>";
                    } else {
                        echo "<tr><td>$isi[Embassy01]</td>
                              <td></td>
                              <td><center>$isi[VisaCurr]. " . number_format($VisaSell, 0, '', ',');
                        echo "</td></tr>";
                    }
                }
                if ($isi[Embassy02] <> '0') {
                    if ($isi[DoaId02] <> '0') {
                        $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                              WHERE B.Id = '$isi[DoaId02]' ");
                        $dvisadoa = mysql_fetch_array($qvisadoa);
                        $visadoa = $dvisadoa[SellingValueInRupiah] / 1000;
                        echo "<tr><td>$isi[Embassy02]</td>
                              <td>$dvisadoa[Name] - $dvisadoa[Process]</td>
                              <td><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                        echo "</td></tr>";
                    } else {
                        echo "<tr><td>$isi[Embassy02]</td>
                              <td></td>
                              <td><center>$isi[VisaCurr]. " . number_format($VisaSell2, 0, '', ',');
                        echo "</td></tr>";
                    }
                }
                if ($isi[Embassy03] <> '0') {
                    if ($isi[DoaId03] <> '0') {
                        $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                              WHERE B.Id = '$isi[DoaId03]' ");
                        $dvisadoa = mysql_fetch_array($qvisadoa);
                        $visadoa = $dvisadoa[SellingValueInRupiah] / 1000;
                        echo "<tr><td>$isi[Embassy03]</td>
                              <td>$dvisadoa[Name] - $dvisadoa[Process]</td>
                              <td><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                        echo "</td></tr>";
                    } else {
                        echo "<tr><td>$isi[Embassy03]</td>
                              <td></td>
                              <td><center>$isi[VisaCurr]. " . number_format($VisaSell3, 0, '', ',');
                        echo "</td></tr>";
                    }
                }
                if ($isi[Embassy04] <> '0') {
                    if ($isi[DoaId04] <> '0') {
                        $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                              WHERE B.Id = '$isi[DoaId04]' ");
                        $dvisadoa = mysql_fetch_array($qvisadoa);
                        $visadoa = $dvisadoa[SellingValueInRupiah] / 1000;
                        echo "<tr><td>$isi[Embassy04]</td>
                              <td>$dvisadoa[Name] - $dvisadoa[Process]</td>
                              <td><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                        echo "</td></tr>";
                    } else {
                        echo "<tr><td>$isi[Embassy04]</td>
                              <td></td>
                              <td><center>$isi[VisaCurr]. " . number_format($VisaSell4, 0, '', ',');
                        echo "</td></tr>";
                    }
                }
                if ($isi[Embassy05] <> '0') {
                    if ($isi[DoaId05] <> '0') {
                        $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                              WHERE B.Id = '$isi[DoaId05]' ");
                        $dvisadoa = mysql_fetch_array($qvisadoa);
                        $visadoa = $dvisadoa[SellingValueInRupiah] / 1000;
                        echo "<tr><td>$isi[Embassy05]</td>
                              <td>$dvisadoa[Name] - $dvisadoa[Process]</td>
                              <td><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                        echo "</td></tr>";
                    } else {
                        echo "<tr><td>$isi[Embassy05]</td>
                              <td></td>
                              <td><center>$isi[VisaCurr]. " . number_format($VisaSell5, 0, '', ',');
                        echo "</td></tr>";
                    }
                }
                echo"</table>";
            }
          echo"
          <font size=1>* AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** TIPPING DIBAYARKAN DI NEGARA TUJUAN<br>
                        **** HARGA TOUR BELUM TERMASUK PPN 1%<br>
                        <b>***** NILAI DALAM MATA UANG RUPIAH DIHITUNG BERDASARKAN KURS ASUMSI DAN DAPAT BERUBAH SEWAKTU-WAKTU</b>
                                        </font><br>";
             }
             if($isi[Insurance]=='INCLUDE'){echo"<center><img src='images/panoramasure.png'>";}echo"
          <br><center><font size=1><b>JADWAL PERJALANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font>";
         }
         echo "</td></tr></table>";

     }
     //STYLE TEZ
     else{
         $ambil=mysql_query("SELECT tour_msproduct.*, tour_msairlines.*,
                    tour_msproductcode.* FROM tour_msproduct
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode
                    inner join tour_msairlines on tour_msproduct.Flight = tour_msairlines.AirlinesID
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
         if($isi[ProductTippingStatus]=='include'){$tips='INCLUDE';}else{$tips=$isi[ProductTipping];}//{$tips="$tipscurr.$isi[ProductTipping]";}
         if($isi[GroupType]=='CRUISE'){$logo='images/PTICruise.png';}
         else if ($isi[GroupType]=='CONSORTIUM'){$logo='';}
         else if($isi[Department]=='TUR EZ'){$logo='images/PTITUREZ.png';}
         else {$logo='images/PTIExperience.png';}
         if($isi[ProductBonus]==''){$bns='';$bns1='';}else{$bns="<font size=2><b>$isi[ProductBonus]</b></font><br>";$bns1="<font size=2><b>BONUS: $isi[ProductBonus]</b></font></td>";}
         if($isi[HighlightCountry]==''){$highlight='';}else{$highlight="HIGHLIGHT: $isi[HighlightCountry]";}
         //table utama
         echo "  <center><table style='border:0' >
                <tr><td style='border:0' align='right' width='120px'><center><img src='$logo'></center></td>
                <td style='border:0' width='630'>
                <font size=5><b>$isi[DaysTravel]D $isi[Productcode]</b></font><br>
                <font size=2 style='background-color: #ffff00'>$highlight</font><br>
                <font size=2>By &nbsp&nbsp&nbsp: $isi[AirlinesName] ($isi[AirlinesID]) </font><br>
                <font size=2>Dep &nbsp: $depdet </font><br>
                <font size=2>Code : $isi[TourCode]</font><br>
                $bns1
                </tr>
                <tr><td colspan=2 width='750px' height='842px' align='justify' style='border:0'>";

         $tblitin=mysql_query("SELECT *,CONVERT(Days, UNSIGNED INTEGER) as urut FROM tour_msitin
                                WHERE ProductID ='$isi[IDProduct]' and Language = '$lang' and Style = '$style' order by urut");
         $day=0;
         $mapfile= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isi[MapFile]) ) ) );
         if($isi[MapFile]<>''){$map="<img src='../admin/map/$mapfile' width='330px' height='330px'>";}else{$map='';}
         echo"<table class='bordered'>
                     <tr><th width='60px'>HARI</th><th width='540px'>JADWAL PERJALANAN</th><th width='50px'>MP</th><th width='50px'>MS</th><th width='50px'>MM</th><tr>";
         while($itin=mysql_fetch_array($tblitin)){
             if(strlen($itin[Days])==1){$hari="0$itin[Days]";}else{$hari="$itin[Days]";}

             if($itin[ObjectTrans01]=='PLANE'){$trans01="<img src='../images/plane.png' width='10' height='10'>";}
             else if($itin[ObjectTrans01]=='TRAIN'){$trans01="<img src='../images/train.png' width='20' height='10'>";}
             else if($itin[ObjectTrans01]=='BUS'){$trans01="<img src='../images/bus.png' width='20' height='10'>";}
             else if($itin[ObjectTrans01]=='FERRY'){$trans01="<img src='../images/ferry.png' width='20' height='10'>";}
             else {$trans01="";}
             if($itin[ObjectTrans02]=='PLANE'){$trans02="<img src='../images/plane.png' width='10' height='10'>";}
             else if($itin[ObjectTrans02]=='TRAIN'){$trans02="<img src='../images/train.png' width='20' height='10'>";}
             else if($itin[ObjectTrans02]=='BUS'){$trans02="<img src='../images/bus.png' width='20' height='10'>";}
             else if($itin[ObjectTrans02]=='FERRY'){$trans02="<img src='../images/ferry.png' width='20' height='10'>";}
             else {$trans02="";}
             if($itin[ObjectTrans03]=='PLANE'){$trans03="<img src='../images/plane.png' width='10' height='10'>";}
             else if($itin[ObjectTrans03]=='TRAIN'){$trans03="<img src='../images/train.png' width='20' height='10'>";}
             else if($itin[ObjectTrans03]=='BUS'){$trans03="<img src='../images/bus.png' width='20' height='10'>";}
             else if($itin[ObjectTrans03]=='FERRY'){$trans03="<img src='../images/ferry.png' width='20' height='10'>";}
             else {$trans03="";}
             if($itin[ObjectTrans04]=='PLANE'){$trans04="<img src='../images/plane.png' width='10' height='10'>";}
             else if($itin[ObjectTrans04]=='TRAIN'){$trans04="<img src='../images/train.png' width='20' height='10'>";}
             else if($itin[ObjectTrans04]=='BUS'){$trans04="<img src='../images/bus.png' width='20' height='10'>";}
             else if($itin[ObjectTrans04]=='FERRY'){$trans04="<img src='../images/ferry.png' width='20' height='10'>";}
             else {$trans04="";}
             $dateday = $isi[DateTravelFrom];
             $tanggalday = substr($dateday,8,2);
             $bulanday = substr($dateday,5,2);
             $tahunday = substr($dateday,0,4);
             if($itin[BreakfastType]=='NO MEALS'){$breakfasttype="<img src='../images/nomeals.png'>";}else{$breakfasttype=$itin[BreakfastType];}
             if($itin[LunchType]=='NO MEALS'){$lunchtype="<img src='../images/nomeals.png'>";}else{$lunchtype=$itin[LunchType];}
             if($itin[DinnerType]=='NO MEALS'){$dinnertype="<img src='../images/nomeals.png'>";}else{$dinnertype=$itin[DinnerType];}

             //$detail= $itin[Detail] ;
             if($day==0){
                 echo"<tr><td style='vertical-align:middle;text-align:center'><b>HARI $hari</b></td>
                             <td><b>";
                 if($itin[Object01]<>''){echo"$itin[Object01] ";}
                 if($trans01<>''){echo"$trans01 ";}
                 if($itin[Object02]<>''){echo"$itin[Object02] ";}
                 if($trans02<>''){echo"$trans02 ";}
                 if($itin[Object03]<>''){echo"$itin[Object03] ";}
                 if($trans03<>''){echo"$trans03 ";}
                 if($itin[Object04]<>''){echo"$itin[Object04] ";}
                 if($trans04<>''){echo"$trans04 ";}
                 if($itin[Object05]<>''){echo"$itin[Object05] ";}
                 echo"</b>";
                 if($itin[Mengunjungi]<>''){echo"<br><b>Mengunjungi: </b> $itin[Mengunjungi]";}
                 if($itin[Mengunjungi2]<>''){echo", $itin[Mengunjungi2]";}if($itin[Mengunjungi3]<>''){echo", $itin[Mengunjungi3]";}
                 if($itin[Mengunjungi4]<>''){echo", $itin[Mengunjungi4]";}if($itin[Mengunjungi5]<>''){echo", $itin[Mengunjungi5]";}
                 if($itin[Mengunjungi6]<>''){echo", $itin[Mengunjungi6]";}if($itin[Mengunjungi7]<>''){echo", $itin[Mengunjungi7]";}
                 if($itin[Mengunjungi8]<>''){echo", $itin[Mengunjungi8]";}
                 if($itin[Melewati]<>''){echo"<br><b>Melewati: </b> $itin[Melewati]";}
                 if($itin[Melewati2]<>''){echo", $itin[Melewati2]";}if($itin[Melewati3]<>''){echo", $itin[Melewati3]";}
                 if($itin[Melewati4]<>''){echo", $itin[Melewati4]";}if($itin[Melewati5]<>''){echo", $itin[Melewati5]";}
                 if($itin[Melewati6]<>''){echo", $itin[Melewati6]";}if($itin[Melewati7]<>''){echo", $itin[Melewati7]";}
                 if($itin[Melewati8]<>''){echo", $itin[Melewati8]";}
                 if($itin[Shopping]<>''){echo"<br><b>Shopping: </b> $itin[Shopping]";}
                 if($itin[Shopping2]<>''){echo", $itin[Shopping2]";}if($itin[Shopping3]<>''){echo", $itin[Shopping3]";}
                 if($itin[Shopping4]<>''){echo", $itin[Shopping4]";}if($itin[Shopping5]<>''){echo", $itin[Shopping5]";}
                 if($itin[Shopping6]<>''){echo", $itin[Shopping6]";}if($itin[Shopping7]<>''){echo", $itin[Shopping7]";}
                 if($itin[Shopping8]<>''){echo", $itin[Shopping8]";}
                 if($itin[Photostop]<>''){echo"<br><b>Photostop: </b> $itin[Photostop]";}
                 if($itin[Photostop2]<>''){echo", $itin[Photostop2]";}if($itin[Photostop3]<>''){echo", $itin[Photostop3]";}
                 if($itin[Photostop4]<>''){echo", $itin[Photostop4]";}if($itin[Photostop5]<>''){echo", $itin[Photostop5]";}
                 if($itin[Photostop6]<>''){echo", $itin[Photostop6]";}if($itin[Photostop7]<>''){echo", $itin[Photostop7]";}
                 if($itin[Photostop8]<>''){echo", $itin[Photostop8]";}
                 if($itin[ItinInfo]<>''){echo"<br><font style='background-color: yellow'>$itin[ItinInfo]</font>";}
                 if($itin[HotelID]<>'0'){
                     $Qhot=mysql_query("SELECT * FROM tour_mshotel
                                           WHERE IDHotel='$itin[HotelID]'");
                     $hot=mysql_fetch_array($Qhot);
                     $htlname1=strtolower($hot[HotelName]);
                     $htlname=ucwords($htlname1);
                     echo"<br><b>Hotel: </b>$htlname/Setaraf</b>";}
                 echo"</td>
                        <td style='vertical-align:middle'><center>$breakfasttype</center></td>
                        <td style='vertical-align:middle'><center>$lunchtype</center></td>
                        <td style='vertical-align:middle'><center>$dinnertype</center></td></tr>";
             }else{
                 echo"<tr><td style='vertical-align:middle;text-align:center'><b>HARI $hari</b></td>
                             <td><b>";
                 if($itin[Object01]<>''){echo"$itin[Object01] ";}
                 if($trans01<>''){echo"$trans01 ";}
                 if($itin[Object02]<>''){echo"$itin[Object02] ";}
                 if($trans02<>''){echo"$trans02 ";}
                 if($itin[Object03]<>''){echo"$itin[Object03] ";}
                 if($trans03<>''){echo"$trans03 ";}
                 if($itin[Object04]<>''){echo"$itin[Object04] ";}
                 if($trans04<>''){echo"$trans04 ";}
                 if($itin[Object05]<>''){echo"$itin[Object05] ";}
                 echo"</b>";
                 if($itin[Mengunjungi]<>''){echo"<br><b>Mengunjungi: </b> $itin[Mengunjungi]";}
                 if($itin[Mengunjungi2]<>''){echo", $itin[Mengunjungi2]";}if($itin[Mengunjungi3]<>''){echo", $itin[Mengunjungi3]";}
                 if($itin[Mengunjungi4]<>''){echo", $itin[Mengunjungi4]";}if($itin[Mengunjungi5]<>''){echo", $itin[Mengunjungi5]";}
                 if($itin[Mengunjungi6]<>''){echo", $itin[Mengunjungi6]";}if($itin[Mengunjungi7]<>''){echo", $itin[Mengunjungi7]";}
                 if($itin[Mengunjungi8]<>''){echo", $itin[Mengunjungi8]";}
                 if($itin[Melewati]<>''){echo"<br><b>Melewati: </b> $itin[Melewati]";}
                 if($itin[Melewati2]<>''){echo", $itin[Melewati2]";}if($itin[Melewati3]<>''){echo", $itin[Melewati3]";}
                 if($itin[Melewati4]<>''){echo", $itin[Melewati4]";}if($itin[Melewati5]<>''){echo", $itin[Melewati5]";}
                 if($itin[Melewati6]<>''){echo", $itin[Melewati6]";}if($itin[Melewati7]<>''){echo", $itin[Melewati7]";}
                 if($itin[Melewati8]<>''){echo", $itin[Melewati8]";}
                 if($itin[Shopping]<>''){echo"<br><b>Shopping: </b> $itin[Shopping]";}
                 if($itin[Shopping2]<>''){echo", $itin[Shopping2]";}if($itin[Shopping3]<>''){echo", $itin[Shopping3]";}
                 if($itin[Shopping4]<>''){echo", $itin[Shopping4]";}if($itin[Shopping5]<>''){echo", $itin[Shopping5]";}
                 if($itin[Shopping6]<>''){echo", $itin[Shopping6]";}if($itin[Shopping7]<>''){echo", $itin[Shopping7]";}
                 if($itin[Shopping8]<>''){echo", $itin[Shopping8]";}
                 if($itin[Photostop]<>''){echo"<br><b>Photostop: </b> $itin[Photostop]";}
                 if($itin[Photostop2]<>''){echo", $itin[Photostop2]";}if($itin[Photostop3]<>''){echo", $itin[Photostop3]";}
                 if($itin[Photostop4]<>''){echo", $itin[Photostop4]";}if($itin[Photostop5]<>''){echo", $itin[Photostop5]";}
                 if($itin[Photostop6]<>''){echo", $itin[Photostop6]";}if($itin[Photostop7]<>''){echo", $itin[Photostop7]";}
                 if($itin[Photostop8]<>''){echo", $itin[Photostop8]";}
                 if($itin[ItinInfo]<>''){echo"<br><font style='background-color: yellow'>$itin[ItinInfo]</font>";}
                 if($itin[HotelID]<>'0'){
                     $Qhot=mysql_query("SELECT * FROM tour_mshotel
                                           WHERE IDHotel='$itin[HotelID]'");
                     $hot=mysql_fetch_array($Qhot);
                     $htlname1=strtolower($hot[HotelName]);
                     $htlname=ucwords($htlname1);
                     echo"<br><b>Hotel: </b>$htlname/Setaraf</b>";}
                 echo"</td>
                        <td style='vertical-align:middle'><center>$breakfasttype</center></td>
                        <td style='vertical-align:middle'><center>$lunchtype</center></td>
                        <td style='vertical-align:middle'><center>$dinnertype</center></td></tr>";
             }
             $detailitin=$detailitin.$itin;
             $day++;
         }
         echo"</table>";
         //FORMAT CRUISE
         if($isi[GroupType]=='CRUISE'){
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
                 $VisaSell3=$isi[VisaSell3]/1000;
                 $VisaSell4=$isi[VisaSell4]/1000;
                 $VisaSell5=$isi[VisaSell5]/1000;
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
                 $VisaSell3=$isi[VisaSell3];
                 $VisaSell4=$isi[VisaSell4];
                 $VisaSell5=$isi[VisaSell5];
                 $ribuan="";
             }
             if($isi[StatusProduct]<>'FINALIZE'){
                 echo"$ribuan
          <table>
          <tr><th colspan=3>HARGA TOUR</th></tr>
          <tr><td>DEWASA (1st/2nd Person)</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>".number_format($cruiseadl12, 0, '', ',');echo"</td></td>
          <tr><td>DEWASA (3rd/4th Person)</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>".number_format($cruiseadl34, 0, '', ',');echo"</td>
          <tr><td>ANAK-ANAK (1st/2nd Person)</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>".number_format($cruisechd12, 0, '', ',');echo"</td>
          <tr><td>ANAK-ANAK (3rd/4th Person)</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>".number_format($cruisechd34, 0, '', ',');echo"</td>
          <tr><td>SINGLE SUPPLEMENT</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>".number_format($singlesell, 0, '', ',');echo"</td>
          <tr><td>SEAPORT, DEPT TAX, GRATUITIES</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>".number_format($seataxsell, 0, '', ',');echo"</td>
          <tr><td>AIRPORT TAX INTERNATIONAL*</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>".number_format($taxinssell, 0, '', ',');echo"</td>
          <tr><td>TIPPING**</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>$tips</td></tr>";
                 if($isi[Embassy01]<>'0')
                 {   echo"<tr><td>VISA $isi[Embassy01]</td><td style='text-align:right'>IDR</td><td style='text-align:right'>".number_format($VisaSell, 0, '', ',');echo"</td></tr>";
                 }
                 if($isi[Embassy02]<>'0')
                 {   echo"<tr><td>VISA $isi[Embassy02]</td><td style='text-align:right'>IDR</td><td style='text-align:right'>".number_format($VisaSell2, 0, '', ',');echo"</td></tr>";
                 }
                 if($isi[Embassy03]<>'0')
                 {   echo"<tr><td>VISA $isi[Embassy03]</td><td style='text-align:right'>IDR</td><td style='text-align:right'>".number_format($VisaSell3, 0, '', ',');echo"</td></tr>";
                 }
                 if($isi[Embassy04]<>'0')
                 {   echo"<tr><td>VISA $isi[Embassy04]</td><td style='text-align:right'>IDR</td><td style='text-align:right'>".number_format($VisaSell4, 0, '', ',');echo"</td></tr>";
                 }
                 if($isi[Embassy05]<>'0')
                 {   echo"<tr><td>VISA $isi[Embassy05]</td><td style='text-align:right'>IDR</td><td style='text-align:right'>".number_format($VisaSell5, 0, '', ',');echo"</td></tr>";
                 }
                 echo "</table>
          </div><br>
          <font size=1>* AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** TIPPING DIBAYARKAN DI NEGARA TUJUAN<br>
                        **** HARGA TOUR BELUM TERMASUK PPN 1%<br>
                        <b>***** NILAI DALAM MATA UANG RUPIAH DIHITUNG BERDASARKAN KURS ASUMSI DAN DAPAT BERUBAH SEWAKTU-WAKTU</b>
                                        </font><br>";
             }
             if($isi[Insurance]=='INCLUDE'){echo"<center><img src='images/panoramasure.png'>";}echo"
          <br><center><font size=1><b>JADWAL PERJALANAN/JENIS MAKANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font></center><br>
                                        $map<br>
          <table style='border:0px'>
          <tr><td style='border:0px' colspan='2'><b><u>PERKIRAAN CUACA</b></u></td></tr>
          <tr><td style='border:0px' colspan='2'>$isi[CuacaItin]<br>
          Cuaca diatas adalah Perkiraan, jika ingin update silahkan klik http://www.accuweather.com</td></tr>
          <tr><td style='border:0px' colspan='2'><b><u>HOTEL YANG AKAN DI GUNAKAN</b></u></td></tr>";
             $Qhot=mysql_query("SELECT * FROM tour_msitinhotel
                                           inner join tour_mshotel on tour_mshotel.IDHotel = tour_msitinhotel.HotelID
                                           WHERE ProductID='$isi[IDProduct]'");
             while($hot=mysql_fetch_array($Qhot)){
                 if($hot[Website]<>''){$web="($hot[Website])";}else{$web="";}
                 echo"<tr><td style='border:0px'>$hot[City]</td><td style='border:0px'>: $hot[HotelName] $web atau Setaraf</td></tr>";
             }
             echo"</table><center>";
             // FORMAT SERIES
         }
         else if($isi[GroupType]=='TUR EZ'){

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
                 $VisaSell3=$isi[VisaSell3]/1000;
                 $VisaSell4=$isi[VisaSell4]/1000;
                 $VisaSell5=$isi[VisaSell5]/1000;
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
                 $VisaSell3=$isi[VisaSell3];
                 $VisaSell4=$isi[VisaSell4];
                 $VisaSell5=$isi[VisaSell5];
                 $ribuan="";
             }
             if($isi[StatusProduct]<>'FINALIZE'){
                 echo"
          <font size='1'>HARGA TOUR DALAM IDR (RIBUAN)/MINIMUM</font><font size='2'><b> 25 </b></font><font size='1'>PESERTA DEWASA</font><br>

          <table class='bordered'><tr><th width='80' rowspan='2' style=vertical-align:middle>DEWASA TWIN SHARE</th><th colspan='3'>ANAK-ANAK (02 - 11 TAHUN)</th>
                <th width=60 rowspan='2' style=vertical-align:middle>SGL SUPP</th><th width='80' rowspan='2' style=vertical-align:middle>APO TAX INTL*</th>
                <th width='100' rowspan='2' style=vertical-align:middle>TIPPING**</th>";
                 if($isi[Embassy01]<>'0')
                 {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy01]</th>";
                 }
                 if($isi[Embassy02]<>'0')
                 {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy02]</th>";
                 }
                 if($isi[Embassy03]<>'0')
                 {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy03]</th>";
                 }
                 if($isi[Embassy04]<>'0')
                 {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy04]</th>";
                 }
                 if($isi[Embassy05]<>'0')
                 {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy05]</th>";
                 }
                 echo "</tr><tr><th width=70>TWIN SHARE</th><th width=70>EXTRA BED</th><th width=70>NO BED</th>
                <tr><td><center>$isi[SellingCurr]. ".number_format($SellingAdlTwn, 0, '', ',');echo"</td></td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdTwn, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdXbed, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdNbed, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SingleSell, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($TaxInsSell, 0, '', ',');echo"</td>
                    <td><center>$tips</td>";
                 if($isi[Embassy01]<>'0')
                 {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell, 0, '', ',');echo"</td>";}
                 if($isi[Embassy02]<>'0')
                 {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell2, 0, '', ',');echo"</td>";}
                 if($isi[Embassy03]<>'0')
                 {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell3, 0, '', ',');echo"</td>";}
                 if($isi[Embassy04]<>'0')
                 {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell4, 0, '', ',');echo"</td>";}
                 if($isi[Embassy05]<>'0')
                 {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell5, 0, '', ',');echo"</td>";}
                 echo "</tr>";

                 echo "</table>
          <font size=1>* AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** TIPPING DIBAYARKAN DI NEGARA TUJUAN<br>
                        **** HARGA TOUR BELUM TERMASUK PPN 1%<br>
                        <b>***** NILAI DALAM MATA UANG RUPIAH DIHITUNG BERDASARKAN KURS ASUMSI DAN DAPAT BERUBAH SEWAKTU-WAKTU</b>
                                        </font><br>";
             }
             if($isi[Insurance]=='INCLUDE'){echo"<center><img src='images/panoramasure.png'>";}echo"
          <br><center><font size=1><b>JADWAL PERJALANAN/JENIS MAKANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font></center><br>
                                        $map<br>
          <table style='border:0px'>
          <tr><td style='border:0px' colspan='2'><b><u>PERKIRAAN CUACA</b></u></td></tr>
          <tr><td style='border:0px' colspan='2'>$isi[CuacaItin]<br>
          Cuaca diatas adalah Perkiraan, jika ingin update silahkan klik http://www.accuweather.com</td></tr>";
          /*<tr><td style='border:0px' colspan='2'><b><u>HOTEL YANG AKAN DI GUNAKAN</b></u></td></tr>";
             $Qhot=mysql_query("SELECT * FROM tour_msitinhotel
                                           inner join tour_mshotel on tour_mshotel.IDHotel = tour_msitinhotel.HotelID
                                           WHERE ProductID='$isi[IDProduct]'");
             while($hot=mysql_fetch_array($Qhot)){
                 if($hot[Website]<>''){$web="($hot[Website])";}else{$web="";}
                 echo"<tr><td style='border:0px'>$hot[City]</td><td style='border:0px'>: $hot[HotelName] $web atau Setaraf</td></tr>";
             }*/
             echo"</table><center>";
             // FORMAT SERIES
         }
         else{
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
                 $VisaSell3=$isi[VisaSell3]/1000;
                 $VisaSell4=$isi[VisaSell4]/1000;
                 $VisaSell5=$isi[VisaSell5]/1000;
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
                 $VisaSell3=$isi[VisaSell3];
                 $VisaSell4=$isi[VisaSell4];
                 $VisaSell5=$isi[VisaSell5];
                 $ribuan="";
             }
             if($isi[StatusProduct]<>'FINALIZE'){
                 echo"
          <font size='1'>HARGA TOUR DALAM IDR (RIBUAN)/MINIMUM</font><font size='2'><b> 25 </b></font><font size='1'>PESERTA DEWASA</font><br>

          <table class='bordered'><tr><th width='80' rowspan='2' style=vertical-align:middle>DEWASA TWIN SHARE</th><th colspan='3'>ANAK-ANAK (02 - 11 TAHUN)</th>
                <th width=60 rowspan='2' style=vertical-align:middle>SGL SUPP</th><th width='80' rowspan='2' style=vertical-align:middle>APO TAX INTL*</th>
                <th width='100' rowspan='2' style=vertical-align:middle>TIPPING**</th>";
                 if($isi[Embassy01]<>'0')
                 {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy01]</th>";
                 }
                 if($isi[Embassy02]<>'0')
                 {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy02]</th>";
                 }
                 if($isi[Embassy03]<>'0')
                 {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy03]</th>";
                 }
                 if($isi[Embassy04]<>'0')
                 {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy04]</th>";
                 }
                 if($isi[Embassy05]<>'0')
                 {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy05]</th>";
                 }
                 echo "</tr><tr><th width=70>TWIN SHARE</th><th width=70>EXTRA BED</th><th width=70>NO BED</th>
                <tr><td><center>$isi[SellingCurr]. ".number_format($SellingAdlTwn, 0, '', ',');echo"</td></td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdTwn, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdXbed, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdNbed, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SingleSell, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($TaxInsSell, 0, '', ',');echo"</td>
                    <td><center>$tips</td>";
                 if($isi[Embassy01]<>'0')
                 {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell, 0, '', ',');echo"</td>";}
                 if($isi[Embassy02]<>'0')
                 {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell2, 0, '', ',');echo"</td>";}
                 if($isi[Embassy03]<>'0')
                 {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell3, 0, '', ',');echo"</td>";}
                 if($isi[Embassy04]<>'0')
                 {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell4, 0, '', ',');echo"</td>";}
                 if($isi[Embassy05]<>'0')
                 {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell5, 0, '', ',');echo"</td>";}
                 echo "</tr>";

                 echo "</table>
          <font size=1>* AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** TIPPING DIBAYARKAN DI NEGARA TUJUAN<br>
                        **** HARGA TOUR BELUM TERMASUK PPN 1%<br>
                        <b>***** NILAI DALAM MATA UANG RUPIAH DIHITUNG BERDASARKAN KURS ASUMSI DAN DAPAT BERUBAH SEWAKTU-WAKTU</b>
                                        </font><br>";
             }
             if($isi[Insurance]=='INCLUDE'){echo"<center><img src='images/panoramasure.png'>";}echo"
          <br><center><font size=1><b>JADWAL PERJALANAN/JENIS MAKANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font></center><br>
                                        $map<br>
          <table style='border:0px'>
          <tr><td style='border:0px' colspan='2'><b><u>PERKIRAAN CUACA</b></u></td></tr>
          <tr><td style='border:0px' colspan='2'>$isi[CuacaItin]<br>
          Cuaca diatas adalah Perkiraan, jika ingin update silahkan klik http://www.accuweather.com</td></tr>
          <tr><td style='border:0px' colspan='2'><b><u>HOTEL YANG AKAN DI GUNAKAN</b></u></td></tr>";
             $Qhot=mysql_query("SELECT * FROM tour_msitinhotel
                                           inner join tour_mshotel on tour_mshotel.IDHotel = tour_msitinhotel.HotelID
                                           WHERE ProductID='$isi[IDProduct]'");
             while($hot=mysql_fetch_array($Qhot)){
                 if($hot[Website]<>''){$web="($hot[Website])";}else{$web="";}
                 echo"<tr><td style='border:0px'>$hot[City]</td><td style='border:0px'>: $hot[HotelName] $web atau Setaraf</td></tr>";
             }
             echo"</table><center>";
         }
         echo "</td></tr></table>";
     }
	break;
 
}
?>
</body>
</html>