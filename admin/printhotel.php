<html>
<head>
<title>Hotel List</title>

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

     if($isi[ProductTipping]=='0' or $isi[ProductTipping]==''){$tips='INCLUDE';}else{$tips=$isi[ProductTipping];}
     if($isi[GroupType]=='CRUISE'){$logo='images/PTICruise.png';}
     else if($isi[GroupType]=='TUR EZ'){$logo='images/PTITUREZ.png';}
     else {$logo='images/PTIExperience.png';}
     //NAMA TL FINAL
     $NamaFinalTL='';
     $FinalTL =mysql_query("SELECT *,tour_mstourleader.* FROM tour_msproducttl
                                                    left join tour_mstourleader on tour_mstourleader.TourleaderName = tour_msproducttl.TLName
                                                    WHERE tour_msproducttl.IDProduct='$IDProduct'
                                                    and tour_msproducttl.TLStatus='FINAL'
                                                    and tour_mstourleader.TourleaderStatus='ACTIVE'");
     $AdaFinal=mysql_num_rows($FinalTL);
     if($AdaFinal>0){
         $cb=0;
         while($DFinalTL=mysql_fetch_array($FinalTL)){
             $tourleader1=$DFinalTL[TourleaderName];
             $tlhp=$DFinalTL[TourleaderMobile];
             if($cb==0){
                 $ttl="$tourleader1 ($tlhp)";
             }else{
                 $ttl="<br>$tourleader1 ($tlhp)";
             }
             $NamaFinalTL=$NamaFinalTL.$ttl;
             $cb++;
         }
     }
     if($NamaFinalTL==''){$finaltl='';}else{$finaltl=$NamaFinalTL;}
     //table utama
     echo "  <center><table style='border:0' >
                    <tr><td style='border:0' width='695px' height='842px' align='justify'>
                    <center><img src='$logo'><br>
                    <font size=1>PANORAMA TOURS TMC</font><br>
                    <font size=1>TRAVEL MANAGEMENT COMPANY</font><br><br>
                    <font size=3><b>HOTEL LIST</b></font><br>
                    <font size=3><b>$isi[Productcode]</b></font><br>
                    <font size=3><b>BY $Airlines </b></font><br>
                    <font size=2>$isi[TourCode]</font><br>
                    <table style='border:0'>
                    <tr><td colspan='2' style='text-align: right;border:0'><b>TOUR LEADER :</b></td><td colspan='3' style='border:0'><b>$finaltl</b></td></tr>
                    <tr><th width='75'>Days & Date</th><th>Flight</th><th>Time</th><th>Route</th><th>Hotel</th></tr>";
     for($c=1;$c<=$isi[DaysTravel];$c++){
         $d=$c-1;
         $prod=mysql_query("SELECT * FROM tour_msitin
                                        WHERE ProductID = '$isi[IDProduct]'
                                        AND Days='$c' ");
         $isiprod=mysql_fetch_array($prod);
         $awaltgl=$isi[DateTravelFrom];
         $awaltanggal = substr($awaltgl,8,2);
         $awalbulan = substr($awaltgl,5,2);
         $awaltahun = substr($awaltgl,0,4);
         $hari= date('d M Y',strtotime('-0 second',strtotime("+$d days",strtotime(date($awalbulan).'/'.date($awaltanggal).'/'.date($awaltahun).' 00:00:00'))));
         $tglbiasa= date('Y-m-d',strtotime('-0 second',strtotime("+$d days",strtotime(date($awalbulan).'/'.date($awaltanggal).'/'.date($awaltahun).' 00:00:00'))));
         $fly=mysql_query("SELECT * FROM tour_msprodflight
                                            left join tour_msproductpnr on tour_msproductpnr.GrvID = tour_msprodflight.IDGrv
                                            WHERE PnrProd = '$isi[IDProduct]'
                                            and AirDate='$tglbiasa' order by FID ASC");
         $cb=0;
         $namaaircode='';
         $waktu='';
         while($flight=mysql_fetch_array($fly)){
             $ATD = date('H.i', strtotime($flight[AirTimeDep]));
             $ATA = date('H.i', strtotime($flight[AirTimeArr]));
             $acode=$flight[AirCode];
             if($cb==0){
                 $airc="$acode ($flight[AirRouteDep] - $flight[AirRouteArr])";
                 $atd1="$ATD - $ATA &nbsp$flight[Note]";
             }else{
                 $airc="<br>$acode ($flight[AirRouteDep] - $flight[AirRouteArr])";
                 $atd1="<br>$ATD - $ATA &nbsp$flight[Note]";
             }
             $namaaircode=$namaaircode.$airc;
             $waktu=$waktu.$atd1;
             $cb++;
         }
         //if($namaaircode==''){$aircode='';}else{$aircode=$namaaircode;}
         echo "  <tr><td><center>DAY $c<br>$hari</center></td>
                    <td width='125'><center>$namaaircode</center></td>
                    <td width='100'><center>$waktu</center></td>
                    <td><center>$isiprod[Route]</center></td>
                    <td>$isiprod[Hotel]</td></tr>";
     }
     $tempatkumpul=preg_replace("[<p>]", "", str_replace("</p>", "<br>", $isi[TempatKumpul] ) );
     echo "  <tr><td colspan='5' style='border:0'><b>HARAP BERKUMPUL DI:</b><br> $tempatkumpul</td></tr>
                    </table>
                    <tr><td colspan='5' style='border:0'><b><i>Catatan : Hotel dan Flight dapat berubah sewaktu-waktu dengan/tanpa pemberitahuan terlebih dahulu</i></td></tr>
                    </td></tr></table>";
	break;
 
}
?>
</body>
</html>