<html>
<head>
<title>Itinerary</title>

</head>
<body>


<?php
include "../config/koneksi.php";
include "../config/fungsi_an.php";

include("../mpdf60/mpdf.php");

$mpdf=new mPDF('c','A4','','',10,10,40,12,5,10);
$mpdf->mirrorMargins = 0;

//$mpdf->SetDisplayMode('fullpage');
// Buffer the following html with PHP so we can store it to a variable later
ob_start();

$IDProduct=$_GET[id];
$qdprt=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$IDProduct'");
$dprt=mysql_fetch_array($qdprt);
$style=$dprt[StyleItin];
$lang='INDONESIA';
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
if($isi[GroupType]=='CRUISE'){$logo='images/PTICruise.png';$Perusahaan="PT. Panorama Tours Indonesia";}
else if($isi[Department]=='TUR EZ'){$logo='images/PTITUREZ.png';$Perusahaan="PT. Turez Indonesia Mandiri";}
else {$logo='images/PTIExperience.png';$Perusahaan="PT. Panorama Tours Indonesia";}
if($isi[ProductBonus]==''){$bns='';$bns1='';}else{$bns="<td style='border:0;font-size:11px;font-weight:boldtext-align:center;' width='350'>$isi[ProductBonus]</td>";$bns1="<td style='border:0;font-size:11px;font-weight:bold;text-align:center;' width='350'>BONUS: $isi[ProductBonus]</td>";}
if($isi[HighlightCountry]==''){$highlight='';}else{$highlight="HIGHLIGHT: $isi[HighlightCountry]";}
//table utama
$header = "  <center><table style='border:0' >
                <tr><td style='border:0' align='right' rowspan='5'><center><img src='$logo'></center></td>
                <td style='border:0;font-size:18px;font-weight:bold' colspan='3'>$isi[DaysTravel]D $isi[Productcode]</td></tr>
                <tr><td style='border:0;background-color: #ffff00;font-size:11px' colspan='3'>$highlight</td></tr>
                <tr><td style='border:0;font-size:11px' width='40'>By<br>Dep<br>Code</td>
                <td style='border:0;font-size:11px' width='250'>: $isi[AirlinesName] ($isi[AirlinesID])<br>: $depdet<br>: $isi[TourCode] </td>
                $bns1
                </tr>

                </table>";
$mpdf->SetHeader($header);
$mpdf->setFooter('Page {PAGENO} of {nb}');
$tblitin=mysql_query("SELECT *,CONVERT(Days, UNSIGNED INTEGER) as urut FROM tour_msitin
                                WHERE ProductID ='$isi[IDProduct]' and Language = '$lang' and Style = '$style' order by urut");
$day=0;
$mapfile= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isi[MapFile]) ) ) );
if($isi[MapFile]<>''){$map="<img src='../admin/map/$mapfile' width='330px' height='330px'>";}else{$map='';}
$table0 ="<table style='border:1'>
           <tr style='border:1'><th width='60px' style='border:1;font-size:11px'>HARI</th><th style='border:1;font-size:11px' width='540px'>JADWAL PERJALANAN</th><th style='border:1;font-size:11px' width='50px'>MP</th><th style='border:1;font-size:11px' width='50px'>MS</th><th style='border:1;font-size:11px' width='50px'>MM</th><tr>";
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
        $table0 .="<tr style='border:1;font-size:11px'><td style='vertical-align:middle;text-align:center;border:1;font-size:11px'><b>HARI $hari</b></td>
                             <td style='border:1;font-size:11px'><b>";
        if($itin[Object01]<>''){$table0 .="$itin[Object01] ";}
        if($trans01<>''){$table0 .="$trans01 ";}
        if($itin[Object02]<>''){$table0 .="$itin[Object02] ";}
        if($trans02<>''){$table0 .="$trans02 ";}
        if($itin[Object03]<>''){$table0 .="$itin[Object03] ";}
        if($trans03<>''){$table0 .="$trans03 ";}
        if($itin[Object04]<>''){$table0 .="$itin[Object04] ";}
        if($trans04<>''){$table0 .="$trans04 ";}
        if($itin[Object05]<>''){$table0 .="$itin[Object05] ";}
        $table0 .="</b>";
        if($itin[Mengunjungi]<>''){$table0 .="<br><b>Mengunjungi: </b> $itin[Mengunjungi]";}
        if($itin[Mengunjungi2]<>''){$table0 .=", $itin[Mengunjungi2]";}if($itin[Mengunjungi3]<>''){$table0 .=", $itin[Mengunjungi3]";}
        if($itin[Mengunjungi4]<>''){$table0 .=", $itin[Mengunjungi4]";}if($itin[Mengunjungi5]<>''){$table0 .=", $itin[Mengunjungi5]";}
        if($itin[Mengunjungi6]<>''){$table0 .=", $itin[Mengunjungi6]";}if($itin[Mengunjungi7]<>''){$table0 .=", $itin[Mengunjungi7]";}
        if($itin[Mengunjungi8]<>''){$table0 .=", $itin[Mengunjungi8]";}
        if($itin[Melewati]<>''){$table0 .="<br><b>Melewati: </b> $itin[Melewati]";}
        if($itin[Melewati2]<>''){$table0 .=", $itin[Melewati2]";}if($itin[Melewati3]<>''){$table0 .=", $itin[Melewati3]";}
        if($itin[Melewati4]<>''){$table0 .=", $itin[Melewati4]";}if($itin[Melewati5]<>''){$table0 .=", $itin[Melewati5]";}
        if($itin[Melewati6]<>''){$table0 .=", $itin[Melewati6]";}if($itin[Melewati7]<>''){$table0 .=", $itin[Melewati7]";}
        if($itin[Melewati8]<>''){$table0 .=", $itin[Melewati8]";}
        if($itin[Shopping]<>''){$table0 .="<br><b>Shopping: </b> $itin[Shopping]";}
        if($itin[Shopping2]<>''){$table0 .=", $itin[Shopping2]";}if($itin[Shopping3]<>''){$table0 .=", $itin[Shopping3]";}
        if($itin[Shopping4]<>''){$table0 .=", $itin[Shopping4]";}if($itin[Shopping5]<>''){$table0 .=", $itin[Shopping5]";}
        if($itin[Shopping6]<>''){$table0 .=", $itin[Shopping6]";}if($itin[Shopping7]<>''){$table0 .=", $itin[Shopping7]";}
        if($itin[Shopping8]<>''){$table0 .=", $itin[Shopping8]";}
        if($itin[Photostop]<>''){$table0 .="<br><b>Photostop: </b> $itin[Photostop]";}
        if($itin[Photostop2]<>''){$table0 .=", $itin[Photostop2]";}if($itin[Photostop3]<>''){$table0 .=", $itin[Photostop3]";}
        if($itin[Photostop4]<>''){$table0 .=", $itin[Photostop4]";}if($itin[Photostop5]<>''){$table0 .=", $itin[Photostop5]";}
        if($itin[Photostop6]<>''){$table0 .=", $itin[Photostop6]";}if($itin[Photostop7]<>''){$table0 .=", $itin[Photostop7]";}
        if($itin[Photostop8]<>''){$table0 .=", $itin[Photostop8]";}
        if($itin[ItinInfo]<>''){$table0 .="<br><font style='background-color: yellow'>$itin[ItinInfo]</font>";}
        $table0 .="</b></td>
                        <td style='vertical-align:middle;border:1;font-size:11px'><center>$breakfasttype</center></td>
                        <td style='vertical-align:middle;border:1;font-size:11px'><center>$lunchtype</center></td>
                        <td style='vertical-align:middle;border:1;font-size:11px'><center>$dinnertype</center></td></tr>";
    }else{
        $table0 .="<tr style='border:1;font-size:11px'><td style='vertical-align:middle;text-align:center;border:1;font-size:11px'><b>HARI $hari</b></td>
                             <td style='border:1;font-size:11px'><b>";
        if($itin[Object01]<>''){$table0 .="$itin[Object01] ";}
        if($trans01<>''){$table0 .="$trans01 ";}
        if($itin[Object02]<>''){$table0 .="$itin[Object02] ";}
        if($trans02<>''){$table0 .="$trans02 ";}
        if($itin[Object03]<>''){$table0 .="$itin[Object03] ";}
        if($trans03<>''){$table0 .="$trans03 ";}
        if($itin[Object04]<>''){$table0 .="$itin[Object04] ";}
        if($trans04<>''){$table0 .="$trans04 ";}
        if($itin[Object05]<>''){$table0 .="$itin[Object05] ";}
        $table0 .="</b>";
        if($itin[Mengunjungi]<>''){$table0 .="<br><b>Mengunjungi: </b> $itin[Mengunjungi]";}
        if($itin[Mengunjungi2]<>''){$table0 .=", $itin[Mengunjungi2]";}if($itin[Mengunjungi3]<>''){$table0 .=", $itin[Mengunjungi3]";}
        if($itin[Mengunjungi4]<>''){$table0 .=", $itin[Mengunjungi4]";}if($itin[Mengunjungi5]<>''){$table0 .=", $itin[Mengunjungi5]";}
        if($itin[Mengunjungi6]<>''){$table0 .=", $itin[Mengunjungi6]";}if($itin[Mengunjungi7]<>''){$table0 .=", $itin[Mengunjungi7]";}
        if($itin[Mengunjungi8]<>''){$table0 .=", $itin[Mengunjungi8]";}
        if($itin[Melewati]<>''){$table0 .="<br><b>Melewati: </b> $itin[Melewati]";}
        if($itin[Melewati2]<>''){$table0 .=", $itin[Melewati2]";}if($itin[Melewati3]<>''){$table0 .=", $itin[Melewati3]";}
        if($itin[Melewati4]<>''){$table0 .=", $itin[Melewati4]";}if($itin[Melewati5]<>''){$table0 .=", $itin[Melewati5]";}
        if($itin[Melewati6]<>''){$table0 .=", $itin[Melewati6]";}if($itin[Melewati7]<>''){$table0 .=", $itin[Melewati7]";}
        if($itin[Melewati8]<>''){$table0 .=", $itin[Melewati8]";}
        if($itin[Shopping]<>''){$table0 .="<br><b>Shopping: </b> $itin[Shopping]";}
        if($itin[Shopping2]<>''){$table0 .=", $itin[Shopping2]";}if($itin[Shopping3]<>''){$table0 .=", $itin[Shopping3]";}
        if($itin[Shopping4]<>''){$table0 .=", $itin[Shopping4]";}if($itin[Shopping5]<>''){$table0 .=", $itin[Shopping5]";}
        if($itin[Shopping6]<>''){$table0 .=", $itin[Shopping6]";}if($itin[Shopping7]<>''){$table0 .=", $itin[Shopping7]";}
        if($itin[Shopping8]<>''){$table0 .=", $itin[Shopping8]";}
        if($itin[Photostop]<>''){$table0 .="<br><b>Photostop: </b> $itin[Photostop]";}
        if($itin[Photostop2]<>''){$table0 .=", $itin[Photostop2]";}if($itin[Photostop3]<>''){$table0 .=", $itin[Photostop3]";}
        if($itin[Photostop4]<>''){$table0 .=", $itin[Photostop4]";}if($itin[Photostop5]<>''){$table0 .=", $itin[Photostop5]";}
        if($itin[Photostop6]<>''){$table0 .=", $itin[Photostop6]";}if($itin[Photostop7]<>''){$table0 .=", $itin[Photostop7]";}
        if($itin[Photostop8]<>''){$table0 .=", $itin[Photostop8]";}
        if($itin[ItinInfo]<>''){$table0 .="<br><font style='background-color: yellow'>$itin[ItinInfo]</font>";}
        if($itin[HotelID]<>'0'){
            $Qhot=mysql_query("SELECT * FROM tour_mshotel
                                                   WHERE IDHotel='$itin[HotelID]'");
            $hot=mysql_fetch_array($Qhot);
            $htlname1=strtolower($hot[HotelName]);
            $htlname=ucwords($htlname1);
            $table0 .="<br><b>Hotel: </b>$htlname/Setaraf</b>";}
            $table0 .="</td>
                        <td style='vertical-align:middle;border:1;font-size:11px'><center>$breakfasttype</center></td>
                        <td style='vertical-align:middle;border:1;font-size:11px'><center>$lunchtype</center></td>
                        <td style='vertical-align:middle;border:1;font-size:11px'><center>$dinnertype</center></td></tr>";
    }
    $detailitin=$detailitin.$itin;
    $day++;
}
$table0 .="</table>";

    $qpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                        WHERE PnrProd ='$isi[IDProduct]'");
    $tpnr=mysql_num_rows($qpnr);
    if($tpnr>0){
        $table0 .= "<u><b>FLIGHT DETAILS</b></u><br><table style='border:0'>";
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
                $table0 .="<tr><td style=\"border:0;\"><font size=1>$flight[AirCode]</font></td><td style=\"border:0;\"><font size=1> $AD &nbsp; $flight[AirRouteDep] - $flight[AirRouteArr] </font></td><td style=\"border:0;\"><font size=1>$ATD - $ATA &nbsp; $flight[Note]</td></tr></font>";
            }
        }$table0 .="</table>";
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
        $table0 .="
          <br><font size='1'>HARGA TOUR DALAM IDR (RIBUAN)/MINIMUM</font><font size='2'><b> 25 </b></font><font size='1'>PESERTA DEWASA</font><br>
          <table style='border:1'>
          <tr><th width='80' rowspan='2' style='vertical-align:middle;border:1;font-size:11px'>DEWASA TWIN SHARE</th><th style='border:1;font-size:11px' colspan='3'>ANAK-ANAK (02 - 11 TAHUN)</th>
                <th width=60 rowspan='2' style='vertical-align:middle;border:1;font-size:11px'>SGL SUPP</th><th width='80' rowspan='2' style='vertical-align:middle;border:1;font-size:11px'>APO TAX INTL*</th>
                <th width='100' rowspan='2' style='vertical-align:middle;border:1;font-size:11px'>TIPPING**</th>";
        if($isi[Embassy01]<>'0')
        {$table0 .="<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy01]</th>";
        }
        if($isi[Embassy02]<>'0')
        {$table0 .="<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy02]</th>";
        }
        if($isi[Embassy03]<>'0')
        {$table0 .="<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy03]</th>";
        }
        if($isi[Embassy04]<>'0')
        {$table0 .="<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy04]</th>";
        }
        if($isi[Embassy05]<>'0')
        {$table0 .="<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy05]</th>";
        }
        $table0 .= "</tr><tr><th style='border:1;font-size:11px' width='70'>TWIN SHARE</th><th style='border:1;font-size:11px' width='70'>EXTRA BED</th><th style='border:1;font-size:11px' width='70'>NO BED</th>
                <tr><td style='border:1;font-size:11px'><center>$isi[SellingCurr]. ".number_format($SellingAdlTwn, 0, '', ',');$table0 .="</td></td>
                    <td style='border:1;font-size:11px'><center>$isi[SellingCurr]. ".number_format($SellingChdTwn, 0, '', ',');$table0 .="</td>
                    <td style='border:1;font-size:11px'><center>$isi[SellingCurr]. ".number_format($SellingChdXbed, 0, '', ',');$table0 .="</td>
                    <td style='border:1;font-size:11px'><center>$isi[SellingCurr]. ".number_format($SellingChdNbed, 0, '', ',');$table0 .="</td>
                    <td style='border:1;font-size:11px'><center>$isi[SellingCurr]. ".number_format($SingleSell, 0, '', ',');$table0 .="</td>
                    <td style='border:1;font-size:11px'><center>$isi[SellingCurr]. ".number_format($TaxInsSell, 0, '', ',');$table0 .="</td>
                    <td><center>$tips</td>";
                    if($isi[Embassy01]<>'0')
                    {$table0 .="<td><center>$isi[VisaCurr]. ".number_format($VisaSell, 0, '', ',');$table0 .="</td>";}
                    if($isi[Embassy02]<>'0')
                    {$table0 .="<td><center>$isi[VisaCurr]. ".number_format($VisaSell2, 0, '', ',');$table0 .="</td>";}
                    if($isi[Embassy03]<>'0')
                    {$table0 .="<td><center>$isi[VisaCurr]. ".number_format($VisaSell3, 0, '', ',');$table0 .="</td>";}
                    if($isi[Embassy04]<>'0')
                    {$table0 .="<td><center>$isi[VisaCurr]. ".number_format($VisaSell4, 0, '', ',');$table0 .="</td>";}
                    if($isi[Embassy05]<>'0')
                    {$table0 .="<td><center>$isi[VisaCurr]. ".number_format($VisaSell5, 0, '', ',');$table0 .="</td>";}
        $table0 .= "</tr>";

        $table0 .= "</table><br>
          <font size=1>* AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** TIPPING DIBAYARKAN DI NEGARA TUJUAN<br>
                        **** HARGA TOUR BELUM TERMASUK PPN 1%<br>
                        <b>***** NILAI DALAM MATA UANG RUPIAH DIHITUNG BERDASARKAN KURS ASUMSI DAN DAPAT BERUBAH SEWAKTU-WAKTU</b>
                                        </font><br><center>";
    }
    if($isi[Insurance]=='INCLUDE'){$table0 .="<center><img src='images/panoramasure.png'>";}

        $table0 .="
          <br><p style='text-align:center'><font size=1><b>JADWAL PERJALANAN/JENIS MAKANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font></p>";
    // NEW PAGE
    //$mpdf->WriteHTML(utf8_encode($table0));
    //$mpdf->AddPage();
        $table0 .="$map<br>
          <table style='border:0px'>
          <tr><td style='border:0px;font-size:11px' colspan='2'><b><u>PERKIRAAN CUACA</b></u></td></tr>
          <tr><td style='border:0px;font-size:11px' colspan='2'>$isi[CuacaItin]<br>
          Cuaca diatas adalah Perkiraan, jika ingin update silahkan klik http://www.accuweather.com</td></tr>
          <tr><td style='border:0px;' colspan='2' height='20px'></td></tr>";
          /*<tr><td style='border:0px;font-size:11px' colspan='2'><b><u>HOTEL YANG AKAN DI GUNAKAN</b></u></td></tr>";
    $Qhot=mysql_query("SELECT * FROM tour_msitinhotel
                                           inner join tour_mshotel on tour_mshotel.IDHotel = tour_msitinhotel.HotelID
                                           WHERE ProductID='$isi[IDProduct]'");
    while($hot=mysql_fetch_array($Qhot)){
        if($hot[Website]<>''){$web="($hot[Website])";}else{$web="";}
        $table1 .="<tr><td style='border:1px;font-size:11px'>$hot[City]</td>
        <td style='border:0px;font-size:11px'>: $hot[HotelName] $web atau Setaraf</td></tr>";
    }*/
    $table0 .="</table><center>";

$table0 .= "</td></tr></table>";
$mpdf->WriteHTML(utf8_encode($table0));
$mpdf->AddPage();
$table2 ="<center>
<table style=\"width:100%;text-align:justify;\">
<tr><th style=\"text-align:left; font-size:12px;\" colspan='2'><u>SYARAT DAN KETENTUAN :</u></th></tr>
<tr><td width='25px'><font size=1>1.</td><td><font size=1> Pendaftaran Group Tour dengan memberikan uang muka sebesar IDR. 4,000,000/Peserta, Uang muka tidak dapat dikembalikan (Non-Refunable) kecuali adanya pembatalan perjalanan dari $Perusahaan.</td></tr>
<tr><td ><font size=1>2.</td><td><font size=1>	Nilai dalam mata uang Rupiah berdasarkan kurs asumsi dan dapat berubah sewaktu waktu.</td></tr>
<tr><td ><font size=1>3.</td><td><font size=1>	$Perusahaan berhak menagih selisih biaya perjalanan dan lain-lain (Jika terjadi kenaikan harga group tour, Airport Tax International, Fuel Surcharge dan Tax lainya, dll).</td></tr>
</table><br>
<table style=\"width:100%;text-align:justify;\">
<tr><th style=\"text-align:left; font-size:12px;\" colspan='2'><u>HARGA TERMASUK :</u></th></tr>
<tr><td style=\"Vertical-align:top;\"width='25px'><font size=1>1.</td><td><font size=1> Tiket pesawat pulang-pergi kelas ekonomi (Non-Endorsable, Non-Refunable & Non-Reroutable). </td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>2.</td><td><font size=1>	Airport Tax International, Fuel Surcharge dan Tax lainya sesuai dengan maskapai penerbangan yang digunakan. </td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>3.</td><td><font size=1>	Akomodasi Penginapan di Hotel setaraf Bintang 3 atau 4 dengan 2 (dua) atau 3(tiga) orang dalam satu kamar. </td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>4.</td><td><font size=1>	Acara Tour, Transportasi dan Makan sesuai yang tercantum dalam acara perjalanan.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>5.</td><td><font size=1>	Bagasi cuma-cuma sesuai dengan ketentuan maskapai penerbangan yang di gunakan.</td></tr>
</table><br>
<table style=\"width:100%;text-align:justify;\">
<tr><th style=\"text-align:left; font-size:12px;\" colspan='2'><u>HARGA TIDAK TERMASUK :</u></th></tr>
<tr><td style=\"Vertical-align:top;\"width='25px'><font size=1>1.</td><td><font size=1>	1(satu) Buah Traveling Bag Hijau.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>2.</td><td><font size=1>	Biaya pembuatan dokumen perjalanan seperti Paspor,Visa, dll.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>3.</td><td><font size=1>	Asuransi Perjalanan sesuai dengan syarat yang dikehendaki oleh kedutaan negara yang dikunjungi.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>4.</td><td><font size=1>	Pengeluaran pribadi seperti mini bar, room service, telephone, laundry, tambahan makanan, minuman serta pengeluaran lainya.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>5.</td><td><font size=1>	Tour tambahan atau Optional tour.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>6.</td><td><font size=1>	Biaya kelebihan bagasi sesuai dengan peraturan maskapai penerbangan yang digunakan.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>7.</td><td><font size=1>	Biaya Single Supplement bagi peserta yang menempati satu kamar sendiri.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>8.</td><td><font size=1>	Biaya bea cukai yang dikenakan oleh custom di Indonesia dan negara yang dikunjungi.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>9.</td><td><font size=1>	Tips untuk Local Guide, Tour Leader, Driver, Waitress, dan Porter (Jika ada).</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>10.</td><td><font size=1>	Pajak pertambahan nilai (PPN) 1%.</td></tr>
</table>";


// Now collect the output buffer into a variable


$html = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($table2));

$stylesheet = file_get_contents('../config/printpdfitin.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
// send the captured HTML from the output buffer to the mPDF class for processing
//$mpdf->WriteHTML($html);
//$mpdf->WriteHTML(utf8_encode($html));

$content = $mpdf->Output('', 'S');

$content = chunk_split(base64_encode($content));
$mailto = 'ferry_budiono@panorama-tours.com'; //Mailto here
$from_name = 'Panorama Tours'; //Name of sender mail
$from_mail = 'noreply@panoramawebsys.com'; //Mailfrom here
$subject = 'itinerary';
$message = 'Please see itinerary at attach';
$filename = "itinerary-$isi[TourCode] (".date("d-m-Y_H-i",time()).").pdf"; //Your Filename with local date and time

//Headers of PDF and e-mail
$boundary = "XYZ-" . date("dmYis") . "-ZYX";

$header = "--$boundary\r\n";
$header .= "Content-Transfer-Encoding: 8bits\r\n";
$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n\r\n"; // or utf-8
$header .= "$message\r\n";
$header .= "--$boundary\r\n";
$header .= "Content-Type: application/pdf; name=\"".$filename."\"\r\n";
$header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n";
$header .= "Content-Transfer-Encoding: base64\r\n\r\n";
$header .= "$content\r\n";
$header .= "--$boundary--\r\n";

$header2 = "MIME-Version: 1.0\r\n";
$header2 .= "From: ".$from_name." \r\n";
$header2 .= "Return-Path: $from_mail\r\n";
$header2 .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";
$header2 .= "$boundary\r\n";

//mail($mailto,$subject,$header,$header2, "-r".$from_mail);

$mpdf->Output($filename ,'D');
exit;
?>
</body>
</html>