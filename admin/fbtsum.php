<html>
<head>
<title>Summary Booking Tour</title>
<link href="../config/print.css" rel="stylesheet" type="text/css" /> 

<style>
@page { size 8.27in 11.69in; margin: 1cm }
div.page { page-break-after: always }
</style>

</head>
<?php
session_start();
include "../config/koneksi.php";
include "../config/koneksimaster.php";
include "../config/fungsi_an.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$username=$_SESSION[employee_code];
$sql1=mssql_query("SELECT IndexDivisi FROM [HRM].[dbo].[Employee]
                  WHERE EmployeeID = '$username'");
$dtuser=mssql_fetch_array($sql1);
$sqluser=mssql_query("SELECT Divisi.Address as divAddress,Divisi.Email as divEmail,
                  Divisi.Phone as divPhone,Divisi.Fax as divFax FROM [HRM].[dbo].[Divisi]
                  WHERE IndexDivisi = '$dtuser[IndexDivisi]'");
$tampiluser=mssql_fetch_array($sqluser);
$compid=$_SESSION[company_id]

?>
<body>
<?php 	  $edit=mysql_query("SELECT * FROM tour_fbtbooking WHERE FBTNo = '$_GET[code]'");
          $r=mysql_fetch_array($edit);  
          $qbuk=mysql_query("SELECT * FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode WHERE BookingID = '$r[BookingID]'");
          $buk=mysql_fetch_array($qbuk);
          $datacomp=mysql_query("SELECT * FROM tbl_mscompany WHERE CompanyID = '$compid'");
          $comp=mysql_fetch_array($datacomp);
          $thisyear = date("Y");
          $nextyear = $thisyear+1;
          if($r[Status]=='VOID'){$status="-$r[Status]-";}else {$status='';}
        //  <tr><td style='border: 0px solid #000000;'></td><td style='border: 0px solid #000000;' colspan=2>------------------------------------------------------------------------------------</td></tr>
          $fbtdate = date("d M Y", strtotime($r[FBTDate]));
          $depdet = date("d M Y", strtotime($r[DateTravelFrom]));
          $Perusahaan=$comp[CompanyName];
		         if($compid==2){
					$MinPax=25;
                    }else{
					$MinPax=20;
                    }
?>
<div class="page"> 
<?php
    echo "<table style='border: 0px solid #000000;'>
          <tr><td width='50%' style='border: 0px solid #000000;'><img src='$comp[Logo]' height='30'></td><td style='border: 0px solid #000000;' colspan=2><font size=3><b>TOUR RESERVATION FORM</b></font></td></tr>
          <tr><td width='300' rowspan=4 style='border: 0px solid #000000;'><font size=1>$comp[CompanyName]<br>$tampiluser[divAddress]<br>
          Ph : $tampiluser[divPhone] (H) Fax : $tampiluser[divFax]<br>
          E-mail: $tampiluser[divEmail]<br>
          $comp[Website]</font></td><td style='border: 0px solid #000000;' colspan=2><font size=3><b>$r[FBTNo] $status</b></font></td></tr>
          <tr><td style='border: 0px solid #000000;' colspan=2>Attn : $r[BookersName]</td></tr>
          <tr><td style='border: 0px solid #000000;' colspan=2>$r[BookersAddress]</td></tr>
          <tr><td style='border: 0px solid #000000;' colspan=2>( $r[BookersTelp] / $r[BookersMobile] )</td></tr>
          <tr><td style='border: 0px solid #000000; '>TC Name/Counter : $r[TCName] - $r[TCDivision]</td><td style='border: 0px solid #000000;' width=100>Tour</td><td style='border: 0px solid #000000;' width=230>: $r[TourCode] ($r[ProductCode])</td></tr> 
          <tr><td style='border: 0px solid #000000;'>Date : $fbtdate</td><td style='border: 0px solid #000000;'>Departure Date</td><td style='border: 0px solid #000000;'>: $depdet </td></tr></table><table>";    
          if($r[PrintSum]=='1'){
          echo"<tr><td width=800 style='border: 0px solid #000000;'><font size=3><b><i>- DUPLICATE -</i></b></font></td></tr>";
          }
    echo "<tr><td width=800 style='border: 0px solid #000000;'>Booking ID : $r[BookingID]</td></tr> </table>";
          $tampil=mysql_query("SELECT * FROM tour_fbtbookingdetail   
                                WHERE FBTNo = '$_GET[code]'
                                And Status <> 'CANCEL'
                                Group by Package,Gender,RoomType 
                                ORDER BY Gender ASC,Package ASC,RoomType ASC ");
          if($buk[GroupType]=='CRUISE'){$rtype='TYPE';}else{$rtype='ROOM TYPE';}
    echo" <table >
          <tr><th BGCOLOR='#f48221'>No</th><th width=200 BGCOLOR='#f48221'>Total Pax</th><th width=60 BGCOLOR='#f48221'>Type</th><th BGCOLOR='#f48221'>Package</th><th BGCOLOR='#f48221'>$rtype</th><th BGCOLOR='#f48221'>Price</th><th BGCOLOR='#f48221'>Disc</th><th BGCOLOR='#f48221'>Disc Exh</th><th BGCOLOR='#f48221'>Total</th></tr>";
          $no=$posisi+1;
          while ($data=mysql_fetch_array($tampil)){
          $itung=mysql_query("SELECT count(IDDetail)as jump,sum(Price)as totp, sum(AddCharge)as totc,sum(Discount)as totd,sum(AddDiscount)as totadd,sum(SubTotal)as totsub FROM tour_fbtbookingdetail
                                WHERE FBTNo = '$_GET[code]'
                                And Status <> 'CANCEL'
                                AND Package = '$data[Package]'
                                AND Gender =  '$data[Gender]'
                                AND RoomType = '$data[RoomType]' ");
          $banyakpax=mysql_num_rows($itung);
          $itungan=mysql_fetch_array($itung);
    echo" <tr><td>$no <input type='hidden' name='iddetail$no' value='$data[IDDetail]'> </td>   
          <td><center>$itungan[jump] PAX</td>   
          <td><center>$data[Gender]</td>     
          <td><center>";if($data[Gender]=='INFANT'){}else{echo"$data[Package]";}echo"</td>";
          
          $hargaplus=$itungan[totp]+$itungan[totc];
    echo" <td><center>";
           if($buk[GroupType]=='CRUISE'){                            
               if($data[Gender]=='ADULT'){   
                if($data[RoomType]=='12 Pax'){echo"1-2 PAX";}else if($data[RoomType]=='34 Pax'){echo"3-4 PAX";}else if($data[RoomType]=='1 Pax'){echo"Single";}   
               }else if($data[Gender]=='CHILD'){
                if($data[RoomType]=='12 Pax'){echo"1-2 PAX";}else if($data[RoomType]=='34 Pax'){echo"3-4 PAX";}else if($data[RoomType]=='1 Pax'){echo"Single";}   
               }else if($data[Gender]=='INFANT'){
               echo"No Bed";  
               }
           }else{
               if($data[Gender]=='ADULT'){   
               echo"$data[RoomType]";  
               }else if($data[Gender]=='CHILD'){
              echo"$data[RoomType]";    
               }else if($data[Gender]=='INFANT'){
               echo"No Bed";  
               }
           }
           echo"</select> <input type=hidden name='selectroom$no' value='$data[RoomType]'</td>    
          <td><input type=text name='harga$no'  value=".number_format($hargaplus, 0, ',', '.');echo" style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type=text name='disc$no' value=".number_format($itungan[totd], 0, ',', '.');echo"  style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type=text name='adddisc$no' value=".number_format($itungan[totadd], 0, ',', '.');echo"  style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type=text name='total$no' value=".number_format($itungan[totsub], 0, ',', '.');echo"  style='text-align: right;border: 0px solid #000000;' readonly></td>
          </tr>";
          $no++;
          }
          $bawah=mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE BookingID = '$r[BookingID]'
                                And Status <> 'CANCEL'
                                AND Package <> 'L.A Only'
                                ORDER BY RoomNo ASC,IDDetail ASC ");
          $banyak=mysql_num_rows($bawah);      
          $bawahcruise=mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE BookingID = '$r[BookingID]'
                                And Status <> 'CANCEL'    
                                ORDER BY RoomNo ASC,IDDetail ASC ");
          $banyakcruise=mysql_num_rows($bawahcruise);  
          $airtax=$r[TaxInsSell];
          $airseatax=$r[SeaTaxSell];
          $totairtax=$airtax*$banyak;
          $totseatax=$airseatax*$banyakcruise;
          $tottax=$totairtax+$totseatax;
          $totsblmppn=$tottax+$r[TotalPrice] -$r[ExtraDiscount];
          $ppntot=$totsblmppn*1/100;
          $totbayar=$totsblmppn+$ppntot;
          $sisabayar=$totbayar-$r[DepositAmount];
          $totairjkt=$r[AirTaxSell]*$banyak;
          $totvisa=$r[VisaSell]*$banyak;
          $ppnvisa=$totvisa*1/100;
          $bayarvisa=$totvisa+$ppnvisa;
          $totvisa2=$r[VisaSell2]*$banyak;
          $depositdet = date("d M Y", strtotime($r[DepositDate]));
          if($r[ExtraDiscount]==''){$xtradisc='0';}else{$xtradisc=$r[ExtraDiscount];}
    echo "<tr><td colspan=8 style='text-align: right'>International Airport Tax<br><font size=1><b>(subject to change)</b></td><td><input type='text' value=".number_format($totairtax, 0, ',', '.');echo" style='text-align: right;border: 0px solid #000000;' readonly><br><input type='text' value='(".number_format($airtax, 0, ',', '.');echo" x $banyak)'  style='text-align: right;border: 0px solid #000000;font-size:8' readonly></font></td></tr>";
          if($buk[GroupType]=='CRUISE'){
    echo "<tr><td colspan=8 style='text-align: right'>Sea Tax<br><font size=1><b>(subject to change)</b></td><td><input type='text' value=".number_format($totseatax, 0, ',', '.');echo"  style='text-align: right;border: 0px solid #000000;' readonly><br><input type='text' value='(".number_format($airseatax, 0, ',', '.');echo" x $banyakcruise)'  style='text-align: right;border: 0px solid #000000;font-size:8' readonly></font></td></tr>";
          }
    echo "<tr><td colspan=8 style='text-align: right'>Extra Discount</td><td><input type='text' value='(".number_format($xtradisc, 0, ',', '.');echo")'  style='text-align: right;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=8 style='text-align: right'><i>Total before VAT </i></td><td><input type='text'  value=".number_format($totsblmppn, 0, ',', '.');echo"  style='text-align: right;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=8 style='text-align: right'>VAT 1%</td><td><input type='text'  value=".number_format($ppntot, 0, ',', '.');echo" style='text-align: right; border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=8 style='text-align: right'><b>ESTIMATE TOTAL PAYMENT ($r[SellingCurr])</b></td><td style='text-align: right'><b>".number_format($totbayar, 0, ',', '.')." </b></td></tr></table>
		  <table><tr><td colspan=2>Deposit </td><td style='text-align: right;'>$r[DepositCurr]</td><td colspan=2><input type='text'  value=".number_format($r[DepositAmount], 0, ',', '.');echo" style='text-align: right;border: 0px solid #000000;' readonly> </td><td colspan=3>Deposit No : $r[DepositNo] ($depositdet)</td></tr> ";
		      $ambil=mysql_query("SELECT * FROM tour_msproduct                                         
                    WHERE tour_msproduct.IDProduct ='$buk[IDTourcode]'");
            $isi=mysql_fetch_array($ambil);
		    if($isi[Embassy01]<>'0')
                {   $Qvisa=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy01]'");
                    $Dvisa=mysql_fetch_array($Qvisa);
                    if($Dvisa[Country]<>''){
                        $DvisaCountry=$Dvisa[Country];
                    }else {
                        $qdoc = mysql_query("SELECT * FROM doa_product where CountryName = $isi[Embassy01] ");
                        $doc = mysql_fetch_array($qdoc);
                        $DvisaCountry=$doc[CountryName];
                    }
                    echo"<tr><td colspan=2>VISA $DvisaCountry</td><td style='text-align:right'>IDR</td><td style='text-align:right' colspan=2>".number_format($isi[VisaSell], 0, '', ',');echo"</td></tr>";
                }
                if($isi[Embassy02]<>'0')
                {   $Qvisa2=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy02]'");
                    $Dvisa2=mysql_fetch_array($Qvisa2);
                    if($Dvisa2[Country]<>''){
                        $DvisaCountry2=$Dvisa2[Country];
                    }else {
                        $qdoc2 = mysql_query("SELECT * FROM doa_product where CountryName = $isi[Embassy02] ");
                        $doc2 = mysql_fetch_array($qdoc2);
                        $DvisaCountry2=$doc2[CountryName];
                    }
                    echo"<tr><td colspan=2>VISA $DvisaCountry2</td><td style='text-align:right'>IDR</td><td style='text-align:right' colspan=2>".number_format($isi[VisaSell2], 0, '', ',');echo"</td></tr>";
                }
                if($isi[Embassy03]<>'0')
                {   $Qvisa3=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy03]'");
                    $Dvisa3=mysql_fetch_array($Qvisa3);
                    if($Dvisa3[Country]<>''){
                        $DvisaCountry3=$Dvisa3[Country];
                    }else {
                        $qdoc3 = mysql_query("SELECT * FROM doa_product where CountryName = $isi[Embassy03] ");
                        $doc3 = mysql_fetch_array($qdoc3);
                        $DvisaCountry3=$doc3[CountryName];
                    }
                    echo"<tr><td colspan=2>VISA $DvisaCountry3</td><td style='text-align:right'>IDR</td><td style='text-align:right' colspan=2>".number_format($isi[VisaSell3], 0, '', ',');echo"</td></tr>";
                }
                if($isi[Embassy04]<>'0')
                {   $Qvisa4=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy04]'");
                    $Dvisa4=mysql_fetch_array($Qvisa4);
                    if($Dvisa4[Country]<>''){
                        $DvisaCountry4=$Dvisa4[Country];
                    }else {
                        $qdoc4 = mysql_query("SELECT * FROM doa_product where CountryName = $isi[Embassy04] ");
                        $doc4 = mysql_fetch_array($qdoc4);
                        $DvisaCountry4=$doc4[CountryName];
                    }
                    echo"<tr><td colspan=2>VISA $DvisaCountry4</td><td style='text-align:right'>IDR</td><td style='text-align:right' colspan=2>".number_format($isi[VisaSell4], 0, '', ',');echo"</td></tr>";
                }
                if($isi[Embassy05]<>'0')
                {   $Qvisa5=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy05]'");
                    $Dvisa5=mysql_fetch_array($Qvisa5);
                    if($Dvisa5[Country]<>''){
                        $DvisaCountry5=$Dvisa5[Country];
                    }else {
                        $qdoc5 = mysql_query("SELECT * FROM doa_product where CountryName = $isi[Embassy05] ");
                        $doc5 = mysql_fetch_array($qdoc5);
                        $DvisaCountry5=$doc5[CountryName];
                    }
                    echo"<tr><td colspan=2>VISA $DvisaCountry5</td><td style='text-align:right'>IDR</td><td style='text-align:right' colspan=2>".number_format($isi[VisaSell5], 0, '', ',');echo"</td></tr>";
                }
				echo"</table>";
		  
          echo"<table style='border: 0px solid #000000;'>
          <tr><td width=800 style='border: 0px solid #000000;'><b>REMARKS</b></td></tr>
          <tr><td>$r[OperationNote]</td></tr></table>";
		  
          echo"<table style='border: 0px solid #000000;'>
          <tr><td width=800 style='border: 0px solid #000000;'>Saya yang bertanda tangan di bawah ini menyatakan telah membaca dan mengerti <b>Syarat dan Kondisi Tour</b> yang terlampir.<br>Apabila terjadi perubahan yang berhubungan dengan perjalanan saya, maka akan mengacu kepada <b>Syarat dan Kondisi Tour</b> tersebut.<br></td></tr>
          <tr><td width=800 style='border: 0px solid #000000;'>I the undersigned have read and agreed <b>the terms and conditions</b> applicable for booking tour.<br>If there any changes related with my itinerary, then it will refer to the applicable <b>terms and conditions</b>.<br><br></td></tr>
          <tr><td style='text-align: right;border: 0px solid #000000;'><font size=1>Materai Rp. 6.000,-</font>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td></tr>
          <tr><td style='border: 0px solid #000000;'><br></td></tr>
          <tr><td style='text-align: right;border: 0px solid #000000;'><font size=1>(____________________________)</font></td></tr>
          </table>";
?>
</div>
<div class="page">
<?php
if($isi[GroupType]=='TUR EZ') {
    echo "<center><table style=\"width:100%;border: hidden\">
<tr><td style=\"text-align:center; font-size:20px;border: hidden\"; colspan=3;><b>SYARAT DAN KETENTUAN GRUP TUR</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;border: hidden\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden\"; colspan=3;><b>HARAP DIBACA DENGAN SEKSAMA</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden\"; colspan=3;><table>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden\"; >Pembelian setiap perjalanan grup yang ditawarkan oleh PT Panorama Tours Indonesia merupakan perjanjian antara peserta dan Panorama Tours. Pastikan bahwa Anda membaca dengan seksama dan memahami Syarat dan Ketentuan sebelum pemesanan.</td></tr>
</table></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden\"; colspan=3;></td></tr></table>";
    if ($isi[GroupType] == 'CRUISE') {
        $dp = "15.000.000";
    } else {
        $dp = "4.000.000";
    }
    echo "<center><table style=\"width:100%;border: hidden\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden\"; colspan=3;><b>PENDAFTARAN & PEMBAYARAN</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden\"; colspan=3;><table>";
    if ($isi[GroupType] == 'CRUISE' or $isi[GroupType] == 'TUR EZ') {
        echo "
<tr><td style=\"Vertical-align:top;border: hidden\">&#8226;</td><td style=\"text-align:justify; font-size:10px;border: hidden\"; >Pendaftaran peserta grup tur dengan memberikan uang muka sebesar IDR $dp,-/peserta. Uang muka tidak dapat dikembalikan (non-refundable) kecuali adanya pembatalan perjalanan dari $Perusahaan.</td></tr>";
    } else {
        echo "
<table border='1'>
<tr><th width='170'><font size=1>HARGA TUR PER-PESERTA</th><th width='170'><font size=1>UANG MUKA PER-PESERTA</th></tr>
<tr><td><font size=1>IDR 0,- sampai IDR 29.999.999,-</td><td><font size=1>IDR 5.000.000,-</td></tr>
<tr><td><font size=1>IDR 30.000.000,- sampai IDR 59.999,999,-</td><td><font size=1>IDR 8.000.000,-</td></tr>
<tr><td><font size=1>IDR 60.000.000,- atau lebih</td><td><font size=1> IDR 10.000.000,-</td></tr>
</table>
</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden\">&#8226;</td><td style=\"text-align:justify; font-size:10px;border: hidden\"; >Uang muka tidak dapat dikembalikan (non-refundable) kecuali adanya pembatalan perjalanan dari $Perusahaan.</td></tr>";
    }
    echo "<tr><td style=\"Vertical-align:top;border: hidden;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Peserta harus melunasi seluruh biaya perjalanan paling lambat 21 hari sebelum tanggal keberangkatan.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Pendaftaran peserta grup tur yang dilakukan kurang dari 21 hari sebelum tanggal keberangkatan, harus dibayar lunas.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Pemesanan grup tur yang tidak disertai dengan pemberian uang muka dapat dibatalkan secara sepihak oleh $Perusahaan.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Pembayaran wajib dilakukan melalui transfer bank dan ditujukan ke rekening resmi Perusahaan.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Setiap pembayaran yang sudah dilakukan harap dimintakan bukti penerimaan uang berupa Receipt dan Invoice asli ke kasir yang ada di Kantor Cabang Panorama.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Kami tidak bertanggungjawab atas segala resiko yang timbul atas pembayaran yang tidak ditujukan ke rekening Perusahaan.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Peminjaman paspor hanya dapat dilakukan apabila peserta telah melunasi semua biaya perjalanan.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Dengan melakukan pembayaran uang muka menunjukkan Anda telah membaca dan menerima Syarat dan Ketentuan ini.</td></tr>
</table></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>PERUBAHAN HARGA</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;>
<table>
<tr><td style=\"Vertical-align:top;border: hidden;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Nilai dalam mata uang rupiah berdasarkan kurs asumsi, dan harga dapat berubah sewaktu waktu.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >$Perusahaan berhak untuk menagih selisih biaya perjalanan dan lain-lain (jika terjadi kenaikan harga grup tur, pajak bandara, dll) kepada calon peserta tur yang belum atau pun yang sudah membayar uang muka.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\">&#8226;</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Jika ada penambahan service dalam perjalanan atas permintaan tamu untuk keperluan pribadi, maka akan dibebankan kepada peserta tur.</td></tr></table>
</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>BIAYA GRUP TUR</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;>
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>Seluruh biaya grup tur sudah termasuk:</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;><table>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>a.</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Tiket pesawat udara pulang pergi kelas ekonomi (Non-endorsable, non-refundable & non-rerouteable).</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>b.</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Akomodasi di hotel-hotel bertaraf internasional dengan 2 (dua) atau 3 (tiga) orang dalam satu kamar.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>c.</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Acara tur sudah termasuk semua tiket masuk sesuai dengan yang tercantum dalam acara perjalanan.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>d.</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Makanan dan minuman sesuai dengan yang tercantum dalam acara perjalanan.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>e.</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Bagasi maksimum 1 buah dengan berat maksimum 20 (sesuai ketentuan perusahaan penerbangan yang berlaku)  & 1 tas tangan untuk dibawa peserta ke kabin dengan berat maksimum 7 kg.</td></tr>
</table></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>Biaya grup tur tidak termasuk:</b></td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>a.</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Airport tax & fuel surcharge internasional dari maskapai penerbangan yang di pergunakan.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>b.</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Biaya pembuatan dokumen perjalanan seperti passport, visa dan lain-lain.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>c.</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Pengeluaran pribadi seperti mini bar, phone, room service, laundry, tambahan makan di luar acara perjalanan, dan pengeluaran pribadi lainnya.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>d.</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Tur tambahan (optional tour).</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>e.</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Asuransi perjalanan sesuai dengan syarat yang dikehendaki oleh kedutaan negara yang dikunjungi.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>f.</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Biaya kelebihan berat bagasi (excess baggage).</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>g.</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Biaya bea masuk bagi barang yang dikenakan bea masuk oleh custom di Indonesia dan di negara-negara yang dikunjungi.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>h.</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Biaya tambahan (single supplement) bagi peserta yang menempati 1 kamar sendiri.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>i.</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Tips local guide, pengemudi local, tour leader dan porter hotel & airport dengan jumlah umum dan disarankan.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>j.</td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Pajak pertambahan nilai (PPN) 1%.</td></tr>
</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>PEMBATALAN & PERUBAHAN</b></td></tr>
<tr><td style=\"text-align:justify; font-size:10px;border: hidden;\"; colspan=3;>Apabila peserta membatalkan keikutsertaan dalam grup tur dengan alasan apapun, maka timbul biaya pembatalan sbb:</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;>
<tr><td style=\"text-align:center; font-size:12px;border: hidden;\"; colspan=3;><b>BIAYA PEMBATALAN PER-PESERTA</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr>
<table border='1'>
<tr><td width='170'><font size=1>0 - 30 hari</td><td width='170'><font size=1>Uang muka hangus</td></tr>
<tr><td><font size=1>30 - 20 hari</td><td><font size=1>50% dari total invoice</td></tr>
<tr><td><font size=1>19 - 10 hari</td><td><font size=1>75 % dari total invoice</td></tr>
<tr><td><font size=1><10 hari (kurang dari 10 hari)</td><td><font size=1>100% dari total invoice</td></tr>
</table>
</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr>
<tr><td style=\"text-align:justify; font-size:10px;border: hidden;\"; colspan=3;>Biaya pembatalan juga berlaku bagi peserta yang mengganti tanggal keberangkatan ataupun pindah ke jenis tur lain dengan alasan apapun. Apabila peserta melakukan perubahan tur ke program tur lain atas kemauan sendiri, maka biaya tur, discount dan ketentuan lain akan mengikuti aturan tur baru tersebut.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>HAK & TANGGUNG JAWAB</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;>$Perusahaan senantiasa berusaha untuk memberikan pelayanan terbaik dan bertanggungjawab selama perjalanan namun sebagai pelaksana pihak <b> $Perusahaan dan seluruh agen-agennya tidak bertanggungjawab dan tidak bisa dituntut atas:</b></td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>a. </td><td style='border: hidden'><font size=1>Kecelakaan, kerusakan, kehilangan dan keterlambatan bagasi oleh maskapai penerbangan, hotel dan alat angkutan lainnya.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>b. </td><td style='border: hidden'><font size=1>Kegagalan, gangguan & keterlambatan dari pesawat udara/kereta api/alat angkutan lainnya yang menyebabkan kerugian waktu, tambahan biaya pergantian hotel, transportasi udara ataupun tidak digunakannya visa kunjungan yang telah dimiliki oleh peserta tur.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>c. </td><td style='border: hidden'><font size=1>Kerusakan dan kerugian (termasuk cedera pribadi, kematian atau kerugian harta benda) dan biaya yang disebabkan oleh tindakan atau kelalaian dari peserta.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>d. </td><td style='border: hidden'><font size=1>Perubahan acara perjalanan akibat bencana alam, kerusuhan, dan sebagainya yang bersifat \"Force Majeure\" (banjir, kebakaran, perubahan cuaca ekstrim, bencana alam, perang, kerusuhan, revolusi, pemogokan, epidemi dan kebijaksanaan Pemerintah).</td></tr></table></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>Panorama Tours dan seluruh agen berhak untuk:</b></td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>a. </td><td style='border: hidden'><font size=1>Membatalkan tanggal keberangkatan apabila jumlah peserta kurang dari 20 peserta dewasa.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>b. </td><td style='border: hidden'><font size=1>Meminta peserta grup tur untuk keluar dari rombongan apabila peserta tersebut membuat kerusuhan, mengacaukan acara, ataupun merusak kenyamanan dan keselamatan peserta lain.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>c. </td><td style='border: hidden'><font size=1>Menunda atau mengganti tanggal keberangkatan karena masalah \"overbook\" maskapai penerbangan.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>PASPOR DAN DOKUMEN PERJALANAN LAINNYA</b></td></tr>
<tr><td style=\"text-align:justify;border: hidden;\";><font size=1>Peserta bertanggungjawab untuk memastikan bahwa seluruh dokumen termasuk paspor, visa, sertifikat kesehatan dan dokumen lain yang diperlukan untuk memasuki suatu negara adalah benar dan masih berlaku. Panorama Tours tidak bertanggungjawab apabila peserta ditolak masuk ataupun dideportasi ke/dari suatu negara karena kegagalan peserta untuk membawa dokumentasi yang benar. Panorama Tours juga tidak bertanggungjawab atas biaya yang timbul karena kegagalan untuk menyediakan dokumentasi saat diperlukan.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>VISA</b></td></tr>
<tr><td style=\"text-align:justify;border: hidden;\";><font size=1>Setiap kedutaan mempunyai perbedaan dalam ketentuan dan lamanya pembuatan visa, Panorama Tours tidak menangani pembuatan visa bagi peserta WNA kecuali apabila WNA tersebut memilik Kartu Ijin Menetap Sementara. Panorama Tours akan membantu Anda dalam proses permohonan pembuatan visa (kecuali untuk negara-negara tertentu dimana Anda harus mengajukan sendiri). Kedutaan berhak untuk meminta dokumen tambahan dan dokumen yang diserahkan tidak menjamin aplikasi permohonan visa Anda akan dikabulkan. Keputusan mengabulkan atau menolak permohonan visa adalah hak prerogatif kedutaan, Panorama Tours tidak dapat menjamin diterimanya permohonan visa.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>PERUBAHAN/PENAMBAHAN MASA TINGGAL (DEVIASI)</b></td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>&#8226; </td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Perubahan masa tinggal/deviasi diperbolehkan di tengah perjalanan (pulang lebih awal dikarenakan kondisi khusus seperti sakit, kemalangan, kematian, dll) atau diakhir perjalanan tur (ingin menikmati perjalanan lebih lama).</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>&#8226; </td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Permintaan deviasi tergantung dari ketersediaan tiket penerbangan, masa berlaku dokumen (visa/paspor, dll) dan ketersediaan hotel. </td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>&#8226; </td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Jika permohonan deviasi tidak disetujui, maka peserta harus mengikuti jadwal tur semula.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>&#8226; </td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >eserta yang melakukan pembatalan deviasi yang telah disetujui akan dikenakan biaya pembatalan sesuai dengan ketentuan yang berlaku.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>&#8226; </td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Semua biaya tambahan yang diperlukan dalam deviasi seperti surcharge, biaya masa tinggal, issued tiket baru, dll merupakan tanggung jawab peserta.</td></tr>
<tr><td style=\"Vertical-align:top;border: hidden;\"><font size=1>&#8226; </td><td style=\"text-align:justify; font-size:10px;border: hidden;\"; >Besar biaya deviasi sesuai dengan tarif yang sudah ditentukan pihak ke 3 yang bersangkutan (hotel, kedutaan, maskapai, dll).</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>BAGASI</b></td></tr>
<tr><td style=\"text-align:justify;border: hidden;\";><font size=1>Setiap peserta diperbolehkan membawa bagasi seberat 20 atau sesuai dengan ketentuan perusahaan penerbangan yang berlaku. Hanya satu buah tas/koper kecil dengan berat maksimal 7 kg diperkenankan untuk dibawa bersama peserta ke kabin. Penambahan biaya atas kelebihan berat bagasi dibayarkan langsung oleh penumpang. Apabila bagasi di pesawat mengalami kehilangan, kerusakan, dll maka pertanggungjawaban adalah sesuai dengan ketentuan maskapai yang digunakan.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>ASURANSI PERJALANAN</b></td></tr>
<tr><td style=\"text-align:justify;border: hidden;\";><font size=1>Semua perjalanan luar negeri Panorama Tours sudah termasuk asuransi perjalanan (dalam bentuk asuransi grup) kecuali untuk grup tur tertentu yang sudah diinformasikan kepada peserta. Untuk grup tur yang tidak mendapatkan asuransi perjalanan, Anda disarankan untuk membeli asuransi perjalanan Anda, hal ini untuk memberikan perlindungan apabila hal-hal yang tidak diinginkan terjadi seperti pembatalan atau penundaan, biaya medis akibat kecelakaan ataupun sakit, keterlambatan pesawat, kehilangan bagasi, dll. Staf kami akan memberikan penjelasan mengenai asuransi perjalanan ini.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>MAKANAN</b></td></tr>
<tr><td style=\"text-align:justify;border: hidden;\";><font size=1>Kami hanya menyediakan makanan yang sesuai dengan acara perjalanan termasuk makanan dalam pesawat. Apabila makanan tidak dihidangkan dalam pesawat dengan alasan apapun maka tidak ada penggantian ataupun kompensasi dari Panorama Tours.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>HOTEL</b></td></tr>
<tr><td style=\"text-align:justify;border: hidden;\";><font size=1>Kami menyediakan hotel dengan ketentuan sekamar berdua. Sebagian besar hotel tidak mengizinkan untuk check-in sebelum pukul 14.00 waktu setempat. Kami akan berusaha untuk memberikan kamar yang berdekatan bagi peserta yang menghendakinya, namun kami tidak menjamin tersedianya kamar tersebut. Harap untuk memberitahukan keinginan Anda pada saat pendaftaran.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>TIPS</b></td></tr>
<tr><td style=\"text-align:justify;border: hidden;\";><font size=1>Merupakan kebiasaan untuk memberikan tips kepada pengemudi, porter hotel, guide dan tour leader. Saran dan besarnya tips akan diberikan tour leader yang akan menyertai Anda.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>KUNJUNGAN WAJIB</b></td></tr>
<tr><td style=\"text-align:justify;border: hidden;\";><font size=1>Beberapa program acara kami memiliki kunjungan wajib yang harus diikuti semua peserta dengan kondisi barang yang sudah dibeli tidak dapat ditukar/dikembalikan. Ada pinalty yang berlaku jika tidak mengikuti kunjungan wajib ini.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>PERMINTAAN KHUSUS</b></td></tr>
<tr><td style=\"text-align:justify;border: hidden;\";><font size=1>Jika ada permintaan khusus seperti menu makanan (makanan khusus bagi vegetarian, diet, dll) atau kamar bersebelahan/saling berhubungan (connection room), dll, silahkan memberitahukan kepada staf kami pada waktu pendaftaran karena permintaan khusus membutuhkan waktu untuk konfirmasi juga berdasarkan ketersediaan-nya dari pihak hotel/airlines/restaurant.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; colspan=3;><b>SERVICE YANG TIDAK DIGUNAKAN</b></td></tr>
<tr><td style=\"text-align:justify;border: hidden;\";><font size=1>Apabila peserta dengan alasan apapun tidak menggunakan/mengikuti akomodasi/hotel, makanan acara tur, dll yang termasuk dalam biaya tur, maka tidak ada pengembalian uang ataupun kompensasi dari Panorama Tours.</td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr></table>";

    echo "<center><table style=\"width:100%;\">
<tr><td style=\"text-align:left justify; font-size:12px;border: hidden;\"; ><b>CATATAN</b></td></tr>
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; >$Perusahaan dan agen-nya dapat sewaktu-waktu merubah / menyesuaikan acara tur dan hotel dengan keadaan setempat, baik susunan maupun urutannya.</td></tr></table>";

    echo "<center><table style=\"width:100 %;\">
<tr><td style=\"text-align:left justify; font-size:10px;border: hidden;\"; colspan=3;></td></tr>
<table>
<tr><td width='170' style='border: hidden'></td><td width='170' style='border: hidden'><font size=1>Mengetahui dan menyetujui,</td></tr>
<tr><td height='30' style='border: hidden'></td><td style='border: hidden'></td></tr>
<tr><td style='border: hidden'></td><td style='border: hidden'>____________________</td></tr>
</table>
<tr><td style='border: hidden'></td></tr></table>";
}else{
    $qtc=mysql_query("SELECT * FROM tour_termncondition");
    $dtc=mysql_fetch_array($qtc);
    echo"<font size=1>$dtc[termcondition]</font>";
}
?></div> 
</body>
</html>
<script>
	window.opener.location.reload();
</script>
