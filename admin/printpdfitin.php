<html>
<head>
<title>Itinerary</title>

</head>
<body>
<?php
include "../config/koneksi.php";
include "../config/fungsi_an.php";

include("../mpdf60/mpdf.php");
$mpdf=new mPDF('c','A4','','',10,10,50,12,5,10);
$mpdf->mirrorMargins = 0;

//$mpdf->SetDisplayMode('fullpage');
// Buffer the following html with PHP so we can store it to a variable later
ob_start();

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
         if($isi[ProductTippingStatus]=='include'){$tips='INCLUDE';}else{$tips=$isi[ProductTipping];}
            if($isi[GroupType]=='CRUISE'){$logo="<img src='../admin/images/PTICruise.jpg' />";}
            else if ($isi[GroupType]=='CONSORTIUM'){$logo='';}
            else if($isi[Department]=='TUR EZ'){$logo="<img src='../admin/images/PTITUREZ.jpg' />";}
            else {$logo="<img src='../admin/images/PTIExperience.jpg' />";}
        if($isi[ShockingOffer]=='YES'){$shockimg="<img src='images/shockoff.png'>";}
        if($isi[ProductBonus]==''){$bns='';$bns1='';}else{$bns="<font size=1><b>$isi[ProductBonus]</b></font><br>";$bns1="<font size=2><b>$isi[ProductBonus]</b></font>";}
        if(($isi[ProductCode]=='HFS' OR $isi[ProductCode]=='HFL' OR $isi[ProductCode]=='HFR'
                OR $isi[ProductCode]=='HLF' OR $isi[ProductCode]=='HRL' OR $isi[ProductCode]=='HSL')
            AND $isi[DateTravelFrom] >= '2018-01-01' AND $isi[DateTravelFrom] <= '2019-01-01') {
            $promoministry = "<img src='images/160lourdes.png'>";
        }
        //table utama
			$header="<div>
			<table style=\"border:0;\">";
            		
                    if($isi[Department]=='TUR EZ'){
            $header.="<tr><td width='500' style=\"border:0; text_align:left;\"; colspan=2;><font size=5><b>$isi[DaysTravel] DAYS $isi[Productcode]</b></font><br>
                    <font size=3><b>BY $Airlines </b></font><br>
                    <font size=2><b>DEP.: $depdet </b></font><br>
                    <font size=2><b>$isi[TourCode]</b></font><br></td><tr><td>
                    $bns1</td>
                    <td style='border:0' align='right'>$logo</td></tr>";
					$Perusahaan="PT. Turez Indonesia Mandiri";
					$MinPax=25;
                    }else{
            $header.="<tr><td width='800' style=\"border:0; text_align:left;\">$logo $shockimg$promoministry<br>
                    <font size=5><b>$isi[DaysTravel] DAYS $isi[Productcode]</b></font><br>
                    <font size=3><b>BY $Airlines </b></font><br>
                    <font size=2><b>DEP.: $depdet </b></font><br>
                    <font size=2><b>$isi[TourCode]</b></font><br></td><tr><td>
                    $bns<br>";
					$Perusahaan="PT. Panorama JTB Tours Indonesia";
					$MinPax=20;
                    }

		  $header.="</td></tr></table></div>";
          //$header.="</font>---------------------------------------------------------------------------------------------------------------------------------------------------</div>";
          $mpdf->SetHeader($header);
$mpdf->setFooter('Page {PAGENO} of {nb}');
          //$table1="<table><tr><td style='border:0'>";		  
          $tblitin=mysql_query("SELECT *,CONVERT(Days, UNSIGNED INTEGER) as urut FROM tour_msitin
                                WHERE ProductID ='$isi[IDProduct]' order by urut");

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
                  $itin="<div style='text-align:justify'><font size=1><b>HARI $hari/$oneday: $route $trans</b><br>
                           $detail $meals<br></font></div>";
              }else{
                  $oneday= strtoupper(date('d M',strtotime('0 second',strtotime($day.' day',strtotime(date($bulanday).'/'.date($tanggalday).'/'.date($tahunday).' 00:00:00')))));
                  $itin="<div style='text-align:justify'><font size=1><b>HARI $hari/$oneday: $route $trans</b><br>
                           $detail $meals<br><br></font></div>";
              }
                $detailitin=$detailitin.$itin; 
                $day++;    
                }

				//$table1 .= $detailitin."</td></tr></table>";;
				 //if($isi[ProductColumn]=='one'){$tablea="<div class=\"one-col;\" >$isi[TempatKumpul]<br><br>$detailitin<br>$map";}
                //else if($isi[ProductColumn]=='two'){$tablea="<div class='two-col'>$isi[TempatKumpul]<br><br>$detailitin<br>$map";}
        if($isi[ProductColumn]=='one'){$mpdf->SetColumns(1);}
        else if($isi[ProductColumn]=='two'){$mpdf->SetColumns(2);}

        $tablea="$isi[TempatKumpul]<br><br>$detailitin<br>$map";
        $mpdf->WriteHTML(utf8_encode($tablea));
        $mpdf->SetColumns(1);
        $table1 ='';
        $qpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                        WHERE PnrProd ='$IDProduct'");
         $tpnr=mysql_num_rows($qpnr);
		if($tpnr>0){
            $table1 .="<font size=1><u><b>FLIGHT DETAILS</b></u><br></font><table style=\"border:0 font-size:1;\">";
			
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
                     $table1 .="<tr><td style=\"border:0;\"><font size=1>$flight[AirCode]</font></td><td style=\"border:0;\"><font size=1> $AD &nbsp; $flight[AirRouteDep] - $flight[AirRouteArr] </font></td><td style=\"border:0;\"><font size=1>$ATD - $ATA &nbsp; $flight[Note]</td></tr></font>";
				}
             }$table1 .="</table>";
         }

				
     if($isi[GroupType]=='CRUISE') {

         if ($isi[SellingCurr] == 'IDR') {
             $cruiseadl12 = $isi[CruiseAdl12] / 1000;
             $cruiseadl34 = $isi[CruiseAdl34] / 1000;
             $cruisechd12 = $isi[CruiseChd12] / 1000;
             $cruisechd34 = $isi[CruiseChd34] / 1000;
             $singlesell = $isi[SingleSell] / 1000;
             $seataxsell = $isi[SeaTaxSell] / 1000;
             $taxinssell = $isi[TaxInsSell] / 1000;
             $VisaSell = $isi[VisaSell] / 1000;
             $VisaSell2 = $isi[VisaSell2] / 1000;
             $VisaSell3 = $isi[VisaSell3] / 1000;
             $VisaSell4 = $isi[VisaSell4] / 1000;
             $VisaSell5 = $isi[VisaSell5] / 1000;
             $ribuan = "<font size='1'>(HARGA DALAM RIBUAN)</font><br>";
         } else {
             $cruiseadl12 = $isi[CruiseAdl12];
             $cruiseadl34 = $isi[CruiseAdl34];
             $cruisechd12 = $isi[CruiseChd12];
             $cruisechd34 = $isi[CruiseChd34];
             $singlesell = $isi[SingleSell];
             $seataxsell = $isi[SeaTaxSell];
             $taxinssell = $isi[TaxInsSell];
             $VisaSell = $isi[VisaSell];
             $VisaSell2 = $isi[VisaSell2];
             $VisaSell3 = $isi[VisaSell3];
             $VisaSell4 = $isi[VisaSell4];
             $VisaSell5 = $isi[VisaSell5];
             $ribuan = "";
         }
         if ($isi[StatusProduct] <> 'FINALIZE') {
             $table1 .="</div><br>";
             $table1 .="<font size='1'>HARGA TOUR DALAM IDR (RIBUAN)<br>

          <table style=\"vertical-align:middle; border:1;\"><tr><th width='80' colspan='2' style=\"vertical-align:middle; border:1;\">DEWASA</th><th style=\"vertical-align:middle; border:1;\" colspan='2'>ANAK-ANAK</th>
                <th width=60 rowspan='2' style=\"vertical-align:middle; border:1;\">SGL SUPP</th>
                <th width=60 rowspan='2' style=\"vertical-align:middle; border:1;\">SEAPORT TAX DEPT TAX GRATUITIES</th>
                <th width='80' rowspan='2' style=\"vertical-align:middle; border:1;\">APO TAX INTL*</th>
                <th width='100' rowspan='2' style=\"vertical-align:middle; border:1;\">TIPPING**</th>";
             if ($isi[Embassy01] <> '0') {
                 $table1 .="<th width='90' rowspan='2' style=\"vertical-align:middle; border:1;\">VISA $isi[Embassy01]</th>";
             }
             if ($isi[Embassy02] <> '0') {
                 $table1 .="<th width='90' rowspan='2' style=\"vertical-align:middle; border:1;\">VISA $isi[Embassy02]</th>";
             }
             if ($isi[Embassy03] <> '0') {
                 $table1 .="<th width='90' rowspan='2' style=\"vertical-align:middle; border:1;\">VISA $isi[Embassy03]</th>";
             }
             if ($isi[Embassy04] <> '0') {
                 $table1 .="<th width='90' rowspan='2' style=\"vertical-align:middle; border:1;\">VISA $isi[Embassy04]</th>";
             }
             if ($isi[Embassy05] <> '0') {
                 $table1 .="<th width='90' rowspan='2' style=\"vertical-align:middle; border:1;\">VISA $isi[Embassy05]</th>";
             }
             $table1 .="</tr><tr><th width=70 style=\"vertical-align:middle; border:1;\">1st & 2nd Person</th><th style=\"vertical-align:middle; border:1;\" width=70>3rd & 4th Person</th><th style=\"vertical-align:middle; border:1;\" width=70>1st & 2nd Person</th><th style=\"vertical-align:middle; border:1;\" width=70>3rd & 4th Person</th>
                    <tr><td style=\"vertical-align:middle; border:1;\"><center>$isi[SellingCurr]. " . number_format($cruiseadl12, 0, '', ',');
             $table1 .="</td></td>
                    <td style=\"vertical-align:middle; border:1;\"><center>$isi[SellingCurr]. " . number_format($cruiseadl34, 0, '', ',');
             $table1 .="</td>
                    <td style=\"vertical-align:middle; border:1;\"><center>$isi[SellingCurr]. " . number_format($cruisechd12, 0, '', ',');
             $table1 .="</td>
                    <td style=\"vertical-align:middle; border:1;\"><center>$isi[SellingCurr]. " . number_format($cruisechd34, 0, '', ',');
             $table1 .="</td>
                    <td style=\"vertical-align:middle; border:1;\"><center>$isi[SellingCurr]. " . number_format($singlesell, 0, '', ',');
             $table1 .="</td>
                    <td style=\"vertical-align:middle; border:1;\"><center>$isi[SellingCurr]. " . number_format($seataxsell, 0, '', ',');
             $table1 .="</td>
                    <td style=\"vertical-align:middle; border:1;\"><center>$isi[SellingCurr]. " . number_format($taxinssell, 0, '', ',');
             $table1 .="</td>
                    <td style=\"vertical-align:middle; border:1;\"><center>$tips</td>";
             if ($isi[Embassy01] <> '0') {
                 $table1 .="<td style=\"vertical-align:middle; border:1;\"><center>$isi[VisaCurr]. " . number_format($VisaSell, 0, '', ',');
                 $table1 .="</td>";
             }
             if ($isi[Embassy02] <> '0') {
                 $table1 .="<td style=\"vertical-align:middle; border:1;\"><center>$isi[VisaCurr]. " . number_format($VisaSell2, 0, '', ',');
                 $table1 .="</td>";
             }
             if ($isi[Embassy03] <> '0') {
                 $table1 .="<td style=\"vertical-align:middle; border:1;\"><center>$isi[VisaCurr]. " . number_format($VisaSell3, 0, '', ',');
                 $table1 .="</td>";
             }
             if ($isi[Embassy04] <> '0') {
                 $table1 .="<td style=\"vertical-align:middle; border:1;\"><center>$isi[VisaCurr]. " . number_format($VisaSell4, 0, '', ',');
                 $table1 .="</td>";
             }
             if ($isi[Embassy05] <> '0') {
                 $table1 .="<td style=\"vertical-align:middle; border:1;\"><center>$isi[VisaCurr]. " . number_format($VisaSell5, 0, '', ',');
                 $table1 .="</td>";
             }
             $table1 .="</tr>";
         }
         $table1 .="</tr></table></font>";
         // FORMAT SERIES/TUR EZ
     }else {

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
         $table1 .="
          <font size=2><b>MINIMUM KEBERANGKATAN $MinPax PESERTA DEWASA:</b></font><br>
          $ribuan
		  <font size=1;>
          <table style=\"vertical-align:middle; border:1;\"><tr><th width=\"80\" rowspan=\"2\" style=\"vertical-align:middle; border:1\">DEWASA TWIN SHARE</th><th colspan=\"3\" style=\"vertical-align:middle; border:1\">ANAK-ANAK (2 - 11 TAHUN)</th>                <th width=60 rowspan=\"2\" style=\"vertical-align:middle; border:1\">SGL SUPP</th><th width=\"80\" rowspan=\"2\" style=\"vertical-align:middle; border:1;\">APO TAX INTL*</th>
                <th width=\"100\" rowspan=\"2\" style=\"vertical-align:middle; border:1;\">TIPPING**</th></tr>";
         $table1 .="<tr><th width=70 style=\"vertical-align:middle; border:1;\">TWIN SHARE</th><th width=70 style=\"vertical-align:middle; border:1;\">EXTRA BED</th><th width=70 style=\"vertical-align:middle; border:1;\">NO BED</th>
                <tr><td style=\"vertical-align:middle; border:1;\"><center>$isi[SellingCurr]. ".number_format($SellingAdlTwn, 0, '', ',');$table1 .="</td></td>
                    <td style=\"vertical-align:middle; border:1;\"><center>$isi[SellingCurr]. ".number_format($SellingChdTwn, 0, '', ',');$table1 .="</td>
                    <td style=\"vertical-align:middle; border:1;\"><center>$isi[SellingCurr]. ".number_format($SellingChdXbed, 0, '', ',');$table1 .="</td>
                    <td style=\"vertical-align:middle; border:1;\"><center>$isi[SellingCurr]. ".number_format($SellingChdNbed, 0, '', ',');$table1 .="</td>
                    <td style=\"vertical-align:middle; border:1;\"><center>$isi[SellingCurr]. ".number_format($SingleSell, 0, '', ',');$table1 .="</td>
                    <td style=\"vertical-align:middle; border:1;\"><center>$isi[SellingCurr]. ".number_format($TaxInsSell, 0, '', ',');$table1 .="</td>
                    <td style=\"vertical-align:middle; border:1;\"><center>$tips</td>";
     }

$table1 .="</tr></table></font>
          </div><br>";
         if($isi[Embassy01]<>'0' OR $isi[Embassy02]<>'0' OR $isi[Embassy03]<>'0' OR $isi[Embassy04]<>'0' OR $isi[Embassy05]<>'0' ) {
             $table1 .= "<table style=\"vertical-align:middle; border:1;\"><tr><th colspan='3' style=\"vertical-align:middle; border:1;\">VISA - $isi[Visa]</th></tr>
                        <tr><th style=\"vertical-align:middle; border:1;\">COUNTRY</th><th style=\"vertical-align:middle; border:1;\">TYPE</th><th style=\"vertical-align:middle; border:1;\"v>PRICE</th></tr>";
             if ($isi[Embassy01] <> '0') {
                 if ($isi[DoaId01] <> '0') {
                     $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                              WHERE B.Id = '$isi[DoaId01]' ");
                     $dvisadoa = mysql_fetch_array($qvisadoa);
                     $visadoa = $dvisadoa[SellingValueInRupiah] / 1000;
                     $table1 .= "<tr><td style=\"vertical-align:middle; border:1;\">$isi[Embassy01]</td>
                              <td style=\"vertical-align:middle; border:1;\">$dvisadoa[Name] - $dvisadoa[Process]</td>
                              <td style=\"vertical-align:middle; border:1;\"><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                     $table1 .= "</td></tr>";
                 } else {
                     $table1 .= "<tr><td style=\"vertical-align:middle; border:1;\">$isi[Embassy01]</td>
                              <td style=\"vertical-align:middle; border:1;\"></td>
                              <td style=\"vertical-align:middle; border:1;\"><center>$isi[VisaCurr]. " . number_format($VisaSell, 0, '', ',');
                     $table1 .= "</td></tr>";
                 }
             }
             if ($isi[Embassy02] <> '0') {
                 if ($isi[DoaId02] <> '0') {
                     $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                              WHERE B.Id = '$isi[DoaId02]' ");
                     $dvisadoa = mysql_fetch_array($qvisadoa);
                     $visadoa = $dvisadoa[SellingValueInRupiah] / 1000;
                     $table1 .= "<tr><td style=\"vertical-align:middle; border:1;\">$isi[Embassy02]</td>
                              <td style=\"vertical-align:middle; border:1;\">$dvisadoa[Name] - $dvisadoa[Process]</td>
                              <td style=\"vertical-align:middle; border:1;\"><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                     $table1 .= "</td></tr>";
                 } else {
                     $table1 .= "<tr><td style=\"vertical-align:middle; border:1;\">$isi[Embassy02]</td>
                              <td style=\"vertical-align:middle; border:1;\"></td>
                              <td style=\"vertical-align:middle; border:1;\"><center>$isi[VisaCurr]. " . number_format($VisaSell2, 0, '', ',');
                     $table1 .= "</td></tr>";
                 }
             }
             if ($isi[Embassy03] <> '0') {
                 if ($isi[DoaId03] <> '0') {
                     $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                              WHERE B.Id = '$isi[DoaId03]' ");
                     $dvisadoa = mysql_fetch_array($qvisadoa);
                     $visadoa = $dvisadoa[SellingValueInRupiah] / 1000;
                     $table1 .= "<tr><td style=\"vertical-align:middle; border:1;\">$isi[Embassy03]</td>
                              <td style=\"vertical-align:middle; border:1;\">$dvisadoa[Name] - $dvisadoa[Process]</td>
                              <td style=\"vertical-align:middle; border:1;\"><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                     $table1 .= "</td></tr>";
                 } else {
                     $table1 .= "<tr><td style=\"vertical-align:middle; border:1;\">$isi[Embassy03]</td>
                              <td style=\"vertical-align:middle; border:1;\"></td>
                              <td style=\"vertical-align:middle; border:1;\"><center>$isi[VisaCurr]. " . number_format($VisaSell3, 0, '', ',');
                     $table1 .= "</td></tr>";
                 }
             }
             if ($isi[Embassy04] <> '0') {
                 if ($isi[DoaId04] <> '0') {
                     $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                              WHERE B.Id = '$isi[DoaId04]' ");
                     $dvisadoa = mysql_fetch_array($qvisadoa);
                     $visadoa = $dvisadoa[SellingValueInRupiah] / 1000;
                     $table1 .= "<tr><td style=\"vertical-align:middle; border:1;\">$isi[Embassy04]</td>
                              <td style=\"vertical-align:middle; border:1;\">$dvisadoa[Name] - $dvisadoa[Process]</td>
                              <td style=\"vertical-align:middle; border:1;\"><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                     $table1 .= "</td></tr>";
                 } else {
                     $table1 .= "<tr><td style=\"vertical-align:middle; border:1;\">$isi[Embassy04]</td>
                              <td style=\"vertical-align:middle; border:1;\"></td>
                              <td style=\"vertical-align:middle; border:1;\"><center>$isi[VisaCurr]. " . number_format($VisaSell4, 0, '', ',');
                     $table1 .= "</td></tr>";
                 }
             }
             if ($isi[Embassy05] <> '0') {
                 if ($isi[DoaId05] <> '0') {
                     $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                              WHERE B.Id = '$isi[DoaId05]' ");
                     $dvisadoa = mysql_fetch_array($qvisadoa);
                     $visadoa = $dvisadoa[SellingValueInRupiah] / 1000;
                     $table1 .= "<tr><td style=\"vertical-align:middle; border:1;\">$isi[Embassy05]</td>
                              <td style=\"vertical-align:middle; border:1;\">$dvisadoa[Name] - $dvisadoa[Process]</td>
                              <td style=\"vertical-align:middle; border:1;\"><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                     $table1 .= "</td></tr>";
                 } else {
                     $table1 .= "<tr><td style=\"vertical-align:middle; border:1;\">$isi[Embassy05]</td>
                              <td style=\"vertical-align:middle; border:1;\"></td>
                              <td style=\"vertical-align:middle; border:1;\"><center>$isi[VisaCurr]. " . number_format($VisaSell5, 0, '', ',');
                     $table1 .= "</td></tr>";
                 }
             }
             $table1 .="</table><br>";
         }
         $table1 .="
          <font size=1>* AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** TIPPING DIBAYARKAN DI NEGARA TUJUAN<br>
                        **** HARGA TOUR BELUM TERMASUK PPN 1%<br>
                        <b>***** NILAI DALAM MATA UANG RUPIAH DIHITUNG BERDASARKAN KURS ASUMSI DAN DAPAT BERUBAH SEWAKTU-WAKTU</b>
                                        </font><br>";
     }
	 
	 if($isi[Insurance]=='INCLUDE'){$table1 .="<p style='text-align:center'><img src='../admin/images/panoramasure.jpg'></p>";}

$table1 .="<br><p style='text-align:center'><font size=1><b>JADWAL PERJALANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font></p><br>";
////////---------------------
/*$table1 .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:center; font-size:20px;\"; colspan=3;><b>SYARAT DAN KETENTUAN GRUP TUR</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$table1 .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>HARAP DIBACA DENGAN SEKSAMA</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;><table>
<tr><td style=\"text-align:left justify; font-size:10px;\"; >Pembelian setiap perjalanan grup yang ditawarkan oleh PT Panorama Tours Indonesia merupakan perjanjian antara peserta dan Panorama Tours. Pastikan bahwa Anda membaca dengan seksama dan memahami Syarat dan Ketentuan sebelum pemesanan.</td></tr>
</table></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";
if($isi[GroupType]=='CRUISE') {$dp="15.000.000";}else{$dp="4.000.000";}
$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>PENDAFTARAN & PEMBAYARAN</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;><table>";
if($isi[GroupType]=='CRUISE' or $isi[GroupType]=='TUR EZ'){
$tabletc .="
<tr><td style=\"Vertical-align:top;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;\"; >Pendaftaran peserta grup tur dengan memberikan uang muka sebesar IDR $dp,-/peserta. Uang muka tidak dapat dikembalikan (non-refundable) kecuali adanya pembatalan perjalanan dari $Perusahaan.</td></tr>";
}else{
$tabletc .="<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr>
<table border='1'>
<tr><th width='170'><font size=1>HARGA TUR PER-PESERTA</th><th width='170'><font size=1>UANG MUKA PER-PESERTA</th></tr>
<tr><td><font size=1>IDR 0,- sampai IDR 29.999.999,-</td><td><font size=1>IDR 5.000.000,-</td></tr>
<tr><td><font size=1>IDR 30.000.000,- sampai IDR 59.999,999,-</td><td><font size=1>IDR 8.000.000,-</td></tr>
<tr><td><font size=1>IDR 60.000.000,- atau lebih</td><td><font size=1> IDR 10.000.000,-</td></tr>
</table>
</td></tr>
<tr><td style=\"Vertical-align:top;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;\"; >Uang muka tidak dapat dikembalikan (non-refundable) kecuali adanya pembatalan perjalanan dari $Perusahaan.</td></tr>";
}
$tabletc .="<tr><td style=\"Vertical-align:top;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;\"; >Peserta harus melunasi seluruh biaya perjalanan paling lambat 21 hari sebelum tanggal keberangkatan.</td></tr>
<tr><td style=\"Vertical-align:top;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;\"; >Pendaftaran peserta grup tur yang dilakukan kurang dari 21 hari sebelum tanggal keberangkatan, harus dibayar lunas.</td></tr>
<tr><td style=\"Vertical-align:top;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;\"; >Pemesanan grup tur yang tidak disertai dengan pemberian uang muka dapat dibatalkan secara sepihak oleh $Perusahaan.</td></tr>
<tr><td style=\"Vertical-align:top;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;\"; >Pembayaran wajib dilakukan melalui transfer bank dan ditujukan ke rekening resmi Perusahaan.</td></tr>
<tr><td style=\"Vertical-align:top;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;\"; >Setiap pembayaran yang sudah dilakukan harap dimintakan bukti penerimaan uang berupa Receipt dan Invoice asli ke kasir yang ada di Kantor Cabang Panorama.</td></tr>
<tr><td style=\"Vertical-align:top;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;\"; >Kami tidak bertanggungjawab atas segala resiko yang timbul atas pembayaran yang tidak ditujukan ke rekening Perusahaan.</td></tr>
<tr><td style=\"Vertical-align:top;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;\"; >Peminjaman paspor hanya dapat dilakukan apabila peserta telah melunasi semua biaya perjalanan.</td></tr>
<tr><td style=\"Vertical-align:top;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;\"; >Dengan melakukan pembayaran uang muka menunjukkan Anda telah membaca dan menerima Syarat dan Ketentuan ini.</td></tr>
</table></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>PERUBAHAN HARGA</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;>
<table>
<tr><td style=\"Vertical-align:top;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;\"; >Nilai dalam mata uang rupiah berdasarkan kurs asumsi, dan harga dapat berubah sewaktu waktu.</td></tr>
<tr><td style=\"Vertical-align:top;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;\"; >$Perusahaan berhak untuk menagih selisih biaya perjalanan dan lain-lain (jika terjadi kenaikan harga grup tur, pajak bandara, dll) kepada calon peserta tur yang belum atau pun yang sudah membayar uang muka.</td></tr>
<tr><td style=\"Vertical-align:top;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;\"; >Jika ada penambahan service dalam perjalanan atas permintaan tamu untuk keperluan pribadi, maka akan dibebankan kepada peserta tur.</td></tr></table>
</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>BIAYA GRUP TUR</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;>
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>Seluruh biaya grup tur sudah termasuk:</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;><table>
<tr><td style=\"Vertical-align:top;\"><font size=1>a.</td><td style=\"text-align:justify; font-size:10px;\"; >Tiket pesawat udara pulang pergi kelas ekonomi (Non-endorsable, non-refundable & non-rerouteable).</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>b.</td><td style=\"text-align:justify; font-size:10px;\"; >Akomodasi di hotel-hotel bertaraf internasional dengan 2 (dua) atau 3 (tiga) orang dalam satu kamar.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>c.</td><td style=\"text-align:justify; font-size:10px;\"; >Acara tur sudah termasuk semua tiket masuk sesuai dengan yang tercantum dalam acara perjalanan.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>d.</td><td style=\"text-align:justify; font-size:10px;\"; >Makanan dan minuman sesuai dengan yang tercantum dalam acara perjalanan.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>e.</td><td style=\"text-align:justify; font-size:10px;\"; >Bagasi maksimum 1 buah dengan berat maksimum 20 (sesuai ketentuan perusahaan penerbangan yang berlaku)  & 1 tas tangan untuk dibawa peserta ke kabin dengan berat maksimum 7 kg.</td></tr>
</table></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>Biaya grup tur tidak termasuk:</b></td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>a.</td><td style=\"text-align:justify; font-size:10px;\"; >Airport tax & fuel surcharge internasional dari maskapai penerbangan yang di pergunakan.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>b.</td><td style=\"text-align:justify; font-size:10px;\"; >Biaya pembuatan dokumen perjalanan seperti passport, visa dan lain-lain.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>c.</td><td style=\"text-align:justify; font-size:10px;\"; >Pengeluaran pribadi seperti mini bar, phone, room service, laundry, tambahan makan di luar acara perjalanan, dan pengeluaran pribadi lainnya.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>d.</td><td style=\"text-align:justify; font-size:10px;\"; >Tur tambahan (optional tour).</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>e.</td><td style=\"text-align:justify; font-size:10px;\"; >Asuransi perjalanan sesuai dengan syarat yang dikehendaki oleh kedutaan negara yang dikunjungi.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>f.</td><td style=\"text-align:justify; font-size:10px;\"; >Biaya kelebihan berat bagasi (excess baggage).</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>g.</td><td style=\"text-align:justify; font-size:10px;\"; >Biaya bea masuk bagi barang yang dikenakan bea masuk oleh custom di Indonesia dan di negara-negara yang dikunjungi.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>h.</td><td style=\"text-align:justify; font-size:10px;\"; >Biaya tambahan (single supplement) bagi peserta yang menempati 1 kamar sendiri.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>i.</td><td style=\"text-align:justify; font-size:10px;\"; >Tips local guide, pengemudi local, tour leader dan porter hotel & airport dengan jumlah umum dan disarankan.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>j.</td><td style=\"text-align:justify; font-size:10px;\"; >Pajak pertambahan nilai (PPN) 1%.</td></tr>
</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>PEMBATALAN & PERUBAHAN</b></td></tr>
<tr><td style=\"text-align:justify; font-size:10px;\"; colspan=3;>Apabila peserta membatalkan keikutsertaan dalam grup tur dengan alasan apapun, maka timbul biaya pembatalan sbb:</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;>
<tr><td style=\"text-align:center; font-size:12px;\"; colspan=3;><b>BIAYA PEMBATALAN PER-PESERTA</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr>
<table border='1'>
<tr><td width='170'><font size=1>0 - 30 hari</td><td width='170'><font size=1>Uang muka hangus</td></tr>
<tr><td><font size=1>30 - 20 hari</td><td><font size=1>50% dari total invoice</td></tr>
<tr><td><font size=1>19 - 10 hari</td><td><font size=1>75 % dari total invoice</td></tr>
<tr><td><font size=1><10 hari (kurang dari 10 hari)</td><td><font size=1>100% dari total invoice</td></tr>
</table>
</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr>
<tr><td style=\"text-align:justify; font-size:10px;\"; colspan=3;>Biaya pembatalan juga berlaku bagi peserta yang mengganti tanggal keberangkatan ataupun pindah ke jenis tur lain dengan alasan apapun. Apabila peserta melakukan perubahan tur ke program tur lain atas kemauan sendiri, maka biaya tur, discount dan ketentuan lain akan mengikuti aturan tur baru tersebut.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>HAK & TANGGUNG JAWAB</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;>$Perusahaan senantiasa berusaha untuk memberikan pelayanan terbaik dan bertanggungjawab selama perjalanan namun sebagai pelaksana pihak <b> $Perusahaan dan seluruh agen-agennya tidak bertanggungjawab dan tidak bisa dituntut atas:</b></td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>a. </td><td><font size=1>Kecelakaan, kerusakan, kehilangan dan keterlambatan bagasi oleh maskapai penerbangan, hotel dan alat angkutan lainnya.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>b. </td><td><font size=1>Kegagalan, gangguan & keterlambatan dari pesawat udara/kereta api/alat angkutan lainnya yang menyebabkan kerugian waktu, tambahan biaya pergantian hotel, transportasi udara ataupun tidak digunakannya visa kunjungan yang telah dimiliki oleh peserta tur.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>c. </td><td><font size=1>Kerusakan dan kerugian (termasuk cedera pribadi, kematian atau kerugian harta benda) dan biaya yang disebabkan oleh tindakan atau kelalaian dari peserta.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>d. </td><td><font size=1>Perubahan acara perjalanan akibat bencana alam, kerusuhan, dan sebagainya yang bersifat \"Force Majeure\" (banjir, kebakaran, perubahan cuaca ekstrim, bencana alam, perang, kerusuhan, revolusi, pemogokan, epidemi dan kebijaksanaan Pemerintah).</td></tr></table></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>Panorama Tours dan seluruh agen berhak untuk:</b></td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>a. </td><td><font size=1>Membatalkan tanggal keberangkatan apabila jumlah peserta kurang dari 20 peserta dewasa.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>b. </td><td><font size=1>Meminta peserta grup tur untuk keluar dari rombongan apabila peserta tersebut membuat kerusuhan, mengacaukan acara, ataupun merusak kenyamanan dan keselamatan peserta lain.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>c. </td><td><font size=1>Menunda atau mengganti tanggal keberangkatan karena masalah \"overbook\" maskapai penerbangan.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>PASPOR DAN DOKUMEN PERJALANAN LAINNYA</b></td></tr>
<tr><td style=\"text-align:justify;\";><font size=1>Peserta bertanggungjawab untuk memastikan bahwa seluruh dokumen termasuk paspor, visa, sertifikat kesehatan dan dokumen lain yang diperlukan untuk memasuki suatu negara adalah benar dan masih berlaku. Panorama Tours tidak bertanggungjawab apabila peserta ditolak masuk ataupun dideportasi ke/dari suatu negara karena kegagalan peserta untuk membawa dokumentasi yang benar. Panorama Tours juga tidak bertanggungjawab atas biaya yang timbul karena kegagalan untuk menyediakan dokumentasi saat diperlukan.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>VISA</b></td></tr>
<tr><td style=\"text-align:justify;\";><font size=1>Setiap kedutaan mempunyai perbedaan dalam ketentuan dan lamanya pembuatan visa, Panorama Tours tidak menangani pembuatan visa bagi peserta WNA kecuali apabila WNA tersebut memilik Kartu Ijin Menetap Sementara. Panorama Tours akan membantu Anda dalam proses permohonan pembuatan visa (kecuali untuk negara-negara tertentu dimana Anda harus mengajukan sendiri). Kedutaan berhak untuk meminta dokumen tambahan dan dokumen yang diserahkan tidak menjamin aplikasi permohonan visa Anda akan dikabulkan. Keputusan mengabulkan atau menolak permohonan visa adalah hak prerogatif kedutaan, Panorama Tours tidak dapat menjamin diterimanya permohonan visa.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>PERUBAHAN/PENAMBAHAN MASA TINGGAL (DEVIASI)</b></td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>&#8226; </td><td style=\"text-align:justify; font-size:10px;\"; >Perubahan masa tinggal/deviasi diperbolehkan di tengah perjalanan (pulang lebih awal dikarenakan kondisi khusus seperti sakit, kemalangan, kematian, dll) atau diakhir perjalanan tur (ingin menikmati perjalanan lebih lama).</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>&#8226; </td><td style=\"text-align:justify; font-size:10px;\"; >Permintaan deviasi tergantung dari ketersediaan tiket penerbangan, masa berlaku dokumen (visa/paspor, dll) dan ketersediaan hotel. </td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>&#8226; </td><td style=\"text-align:justify; font-size:10px;\"; >Jika permohonan deviasi tidak disetujui, maka peserta harus mengikuti jadwal tur semula.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>&#8226; </td><td style=\"text-align:justify; font-size:10px;\"; >eserta yang melakukan pembatalan deviasi yang telah disetujui akan dikenakan biaya pembatalan sesuai dengan ketentuan yang berlaku.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>&#8226; </td><td style=\"text-align:justify; font-size:10px;\"; >Semua biaya tambahan yang diperlukan dalam deviasi seperti surcharge, biaya masa tinggal, issued tiket baru, dll merupakan tanggung jawab peserta.</td></tr>
<tr><td style=\"Vertical-align:top;\"><font size=1>&#8226; </td><td style=\"text-align:justify; font-size:10px;\"; >Besar biaya deviasi sesuai dengan tarif yang sudah ditentukan pihak ke 3 yang bersangkutan (hotel, kedutaan, maskapai, dll).</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>BAGASI</b></td></tr>
<tr><td style=\"text-align:justify;\";><font size=1>Setiap peserta diperbolehkan membawa bagasi seberat 20 atau sesuai dengan ketentuan perusahaan penerbangan yang berlaku. Hanya satu buah tas/koper kecil dengan berat maksimal 7 kg diperkenankan untuk dibawa bersama peserta ke kabin. Penambahan biaya atas kelebihan berat bagasi dibayarkan langsung oleh penumpang. Apabila bagasi di pesawat mengalami kehilangan, kerusakan, dll maka pertanggungjawaban adalah sesuai dengan ketentuan maskapai yang digunakan.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>ASURANSI PERJALANAN</b></td></tr>
<tr><td style=\"text-align:justify;\";><font size=1>Semua perjalanan luar negeri Panorama Tours sudah termasuk asuransi perjalanan (dalam bentuk asuransi grup) kecuali untuk grup tur tertentu yang sudah diinformasikan kepada peserta. Untuk grup tur yang tidak mendapatkan asuransi perjalanan, Anda disarankan untuk membeli asuransi perjalanan Anda, hal ini untuk memberikan perlindungan apabila hal-hal yang tidak diinginkan terjadi seperti pembatalan atau penundaan, biaya medis akibat kecelakaan ataupun sakit, keterlambatan pesawat, kehilangan bagasi, dll. Staf kami akan memberikan penjelasan mengenai asuransi perjalanan ini.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>MAKANAN</b></td></tr>
<tr><td style=\"text-align:justify;\";><font size=1>Kami hanya menyediakan makanan yang sesuai dengan acara perjalanan termasuk makanan dalam pesawat. Apabila makanan tidak dihidangkan dalam pesawat dengan alasan apapun maka tidak ada penggantian ataupun kompensasi dari Panorama Tours.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>HOTEL</b></td></tr>
<tr><td style=\"text-align:justify;\";><font size=1>Kami menyediakan hotel dengan ketentuan sekamar berdua. Sebagian besar hotel tidak mengizinkan untuk check-in sebelum pukul 14.00 waktu setempat. Kami akan berusaha untuk memberikan kamar yang berdekatan bagi peserta yang menghendakinya, namun kami tidak menjamin tersedianya kamar tersebut. Harap untuk memberitahukan keinginan Anda pada saat pendaftaran.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>TIPS</b></td></tr>
<tr><td style=\"text-align:justify;\";><font size=1>Merupakan kebiasaan untuk memberikan tips kepada pengemudi, porter hotel, guide dan tour leader. Saran dan besarnya tips akan diberikan tour leader yang akan menyertai Anda.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>KUNJUNGAN WAJIB</b></td></tr>
<tr><td style=\"text-align:justify;\";><font size=1>Beberapa program acara kami memiliki kunjungan wajib yang harus diikuti semua peserta dengan kondisi barang yang sudah dibeli tidak dapat ditukar/dikembalikan. Ada pinalty yang berlaku jika tidak mengikuti kunjungan wajib ini.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>PERMINTAAN KHUSUS</b></td></tr>
<tr><td style=\"text-align:justify;\";><font size=1>Jika ada permintaan khusus seperti menu makanan (makanan khusus bagi vegetarian, diet, dll) atau kamar bersebelahan/saling berhubungan (connection room), dll, silahkan memberitahukan kepada staf kami pada waktu pendaftaran karena permintaan khusus membutuhkan waktu untuk konfirmasi juga berdasarkan ketersediaan-nya dari pihak hotel/airlines/restaurant.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; colspan=3;><b>SERVICE YANG TIDAK DIGUNAKAN</b></td></tr>
<tr><td style=\"text-align:justify;\";><font size=1>Apabila peserta dengan alasan apapun tidak menggunakan/mengikuti akomodasi/hotel, makanan acara tur, dll yang termasuk dalam biaya tur, maka tidak ada pengembalian uang ataupun kompensasi dari Panorama Tours.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr></table>";

$tabletc .="<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;\"; ><b>CATATAN</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;\"; >$Perusahaan dan agen-nya dapat sewaktu-waktu merubah / menyesuaikan acara tur dan hotel dengan keadaan setempat, baik susunan maupun urutannya.</td></tr></table>";

$tabletc .="<center><table style=\"width:100 %;\">
<tr><td style=\"text-align:left justify; font-size:10px;\"; colspan=3;></td></tr>
<table>
<tr><td width='170'></td><td width='170'><font size=1>Mengetahui dan menyetujui,</td></tr>
<tr><td height='30'></td><td></td></tr>
<tr><td></td><td>____________________</td></tr>
</table>
<tr><td></td></tr></table>";
$table1 .="</td></tr></table>";
// Now collect the output buffer into a variable
*/
$qtc=mysql_query("SELECT * FROM tour_termncondition");
$dtc=mysql_fetch_array($qtc);
$tabletc .="<font size=1>$dtc[termcondition]</font>";

$html = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($table1));
$mpdf->SetColumns(2);
$mpdf->WriteHTML(utf8_encode($tabletc));
$mpdf->SetColumns(1);
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