<html>
<head>
<title>Form Booking Tour</title>
<link href="../config/print.css" rel="stylesheet" type="text/css" />
       
</head>
<?php
session_start();
include "../config/koneksi.php";
include "../config/koneksimaster.php";
include "../config/fungsi_an.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
   

?>
<body>
<script type="text/javascript">          
 var time = new Date().getTime();
     document.onmousemove = function() {
         time = new Date().getTime();
     };                                
     function refresh() {
         if(new Date().getTime() - time >= 300000) 
             window.close(true);
         else 
             setTimeout(refresh, 300000);
     }
     setTimeout(refresh, 300000);  
function rubah(ID)
{
if (confirm("Are you sure you want to void " + ID +""))
{
 window.location.href = '../admin/fbt.php?act=voidfbt&FBT=' + ID  ;  
} 
}
function updatepage()
    {
        window.close();
        window.opener.location.reload();
    }
</script> 
<?php  
$username=$_SESSION[employee_code];
$sql1=mssql_query("SELECT IndexDivisi FROM [HRM].[dbo].[Employee]
                  WHERE EmployeeID = '$username'");
$dtuser=mssql_fetch_array($sql1);
$sqluser=mssql_query("SELECT Divisi.Address as divAddress,Divisi.Email as divEmail,
                  Divisi.Phone as divPhone,Divisi.Fax as divFax FROM [HRM].[dbo].[Divisi]
                  WHERE IndexDivisi = '$dtuser[IndexDivisi]'");
$tampiluser=mssql_fetch_array($sqluser);
$compid=$_SESSION[company_id];
$EmpName=$_SESSION[employee_name];
$timezone_offset = +5;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
$skrg = date("Y-m-d");
switch($_GET[act]){                 //  <img src='images/pano1.jpg'>
  default:
          $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");
          $r=mysql_fetch_array($edit);  
          $awal=mysql_query("SELECT * FROM tour_msproduct left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode WHERE IDProduct = '$r[IDTourcode]'");
          $curawal=mysql_fetch_array($awal);
          $datacomp=mysql_query("SELECT * FROM tbl_mscompany WHERE CompanyID = '$compid'");
          $comp=mysql_fetch_array($datacomp);
          //if($compid==1){$logo="<img src='$comp[Logo]'>";}else{$logo='';}
          $thisyear = date("Y");
          $nextyear = $thisyear+1;
          $getcode=$_GET[code];
          if($r[BookersMobile]<>''){$garing='/';}
    echo "<center>
          <table style='border: 0px solid #000000;'>
          <tr><td width='550' style='border: 0px solid #000000;'><img src='$comp[Logo]'></td><td width='500' style='border: 0px solid #000000;' colspan=2><br><font size=5><b>TOUR RESERVATION FORM</b></font></td></tr>
          <tr><td rowspan=4 width=200 style='border: 0px solid #000000;'><font size=1>$comp[CompanyName]<br>$tampiluser[divAddress]<br>
          Ph : $tampiluser[divPhone] (H) Fax : $tampiluser[divFax]<br>
          E-mail: $tampiluser[divEmail]<br>
          $comp[Website]</font></td><td width='50' style='border: 0px solid #000000;'>Attn</td><td style='border: 0px solid #000000;'>: $r[BookersName]</td></tr>
          <tr><td style='border: 0px solid #000000;' colspan=2>$r[BookersAddress]</td></tr>
          <tr><td style='border: 0px solid #000000;' colspan=2>( $r[BookersTelp] $garing $r[BookersMobile] )</td></tr>
          <tr><td style='border: 0px solid #000000;'>Tour</td><td style='border: 0px solid #000000;' width=230>: $curawal[TourCode] ($curawal[Productcode])</td></tr>
          <tr><td style='border: 0px solid #000000;'>TC Name/Counter : $r[TCName] - $r[TCDivision]<br>Booking ID : <b>$getcode</b></td>
          <td style='border: 0px solid #000000;'>Departure Date</td><td style='border: 0px solid #000000;'>:  ".date('d-m-Y', strtotime($curawal[DateTravelFrom])) ."</td></tr>
          <tr></tr>                                                
          </table>";
          $tampil=mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE BookingID = '$getcode'
                                And Status <> 'CANCEL'
                                ORDER BY RoomNo ASC,IDDetail ASC ");
          if($curawal[GroupType]=='CRUISE'){$rtype='TYPE';}else{$rtype='ROOM TYPE';}
    echo" <form name='example' method='POST' action='fbt.php?act=savefbt' > 
          <table style='border: 0px solid #000000;'>
          <tr><th BGCOLOR='#f48221'>No</th><th BGCOLOR='#f48221' width=200>PAX Name</th><th BGCOLOR='#f48221' width=40>Type</th>
          <th BGCOLOR='#f48221' width=70>Passport</th><th BGCOLOR='#f48221'>Package</th><th BGCOLOR='#f48221' width=65>$rtype</th>
          <th BGCOLOR='#f48221'>Price</th><th BGCOLOR='#f48221'>Add Charge</th><th BGCOLOR='#f48221'>Disc</th><th BGCOLOR='#f48221'>Disc Exh</th>
          <th BGCOLOR='#f48221'>Total</th></tr>";
          $no=$posisi+1;
          $banyak=mysql_num_rows($tampil);
          while ($data=mysql_fetch_array($tampil)){
          $vch=mysql_query("SELECT * FROM `tour_voucherpromo` WHERE `VoucherNo` = '$data[VoucherNo]' and `VoucherStatus`='APPROVE'");
          $vchok=mysql_num_rows($vch);
          if($data[PaxName]==''){$namapax="<center>TBA</center>";}else{$namapax="$data[Title]. $data[PaxName]";}
          if($data[Promo]<>'' AND $vchok > 0){$bintang="<font color=red>*</font>";$Promo="<font size=1><i>* $data[Promo]</i></font>";}else{$bintang=" ";}
    echo" <tr><td>$no <input type='hidden' name='iddetail$no' value='$data[IDDetail]'><input type='hidden' name='getcode' value='$getcode'> </td>   
          <td>$namapax $bintang</td>   
          <td><center>$data[Gender]</td>
          <td><center>$data[PassportNo]</td> 
          <td><center>";if($data[Gender]=='INFANT'){}else{echo"$data[Package]";}echo"</td>";
          $cadltwn=mysql_query("SELECT * FROM tour_msproduct   
                                        WHERE IDProduct = '$r[IDTourcode]' and Status <> 'VOID'");
          $harga=mysql_fetch_array($cadltwn);
    echo" <td><center>";  
           if($curawal[GroupType]=='CRUISE'){
               if($data[Gender]=='ADULT' and $data[Package]=='Tour'){   
               if($data[RoomType]=='12 Pax'){$hargaroom=$harga[CruiseAdl12];$hargacharge='0';$tipe='1-2 PAX';}
               if($data[RoomType]=='34 Pax'){$hargaroom=$harga[CruiseAdl34];$hargacharge='0';$tipe='3-4 PAX';}
               if($data[RoomType]=='1 Pax'){$hargaroom=$harga[CruiseAdl12];$hargacharge=$harga[SingleSell];$tipe='Single';}  
               echo"$tipe";  
               }else if($data[Gender]=='CHILD' and $data[Package]=='Tour'){
               if($data[RoomType]=='12 Pax'){$hargaroom=$harga[CruiseChd12];$hargacharge='0';$tipe='1-2 PAX';}
               if($data[RoomType]=='34 Pax'){$hargaroom=$harga[CruiseChd34];$hargacharge='0';$tipe='3-4 PAX';}
               if($data[RoomType]=='1 Pax'){$hargaroom=$harga[CruiseChd12];$hargacharge=$harga[SingleSell];$tipe='Single';}  
               echo"$tipe";  
               }else if($data[Gender]=='INFANT' and $data[Package]=='Tour'){$hargaroom=$harga[SellingInfant];$hargacharge='0';
               echo"No Bed";  
               }
               else if($data[Gender]=='ADULT' and $data[Package]=='L.A Only'){   
               if($data[RoomType]=='12 Pax'){$hargaroom=$harga[CruiseLoAdl12];$hargacharge='0';$tipe='1-2 PAX';}
               if($data[RoomType]=='34 Pax'){$hargaroom=$harga[CruiseLoAdl34];$hargacharge='0';$tipe='3-4 PAX';}
               if($data[RoomType]=='1 Pax'){$hargaroom=$harga[CruiseLoAdl12];$hargacharge=$harga[SingleSell];$tipe='Single';}  
               echo"$tipe";  
               }else if($data[Gender]=='CHILD' and $data[Package]=='L.A Only'){
               if($data[RoomType]=='12 Pax'){$hargaroom=$harga[CruiseLoChd12];$hargacharge='0';$tipe='1-2 PAX';}
               if($data[RoomType]=='34 Pax'){$hargaroom=$harga[CruiseloChd34];$hargacharge='0';$tipe='3-4 PAX';}
               if($data[RoomType]=='1 Pax'){$hargaroom=$harga[CruiseLoChd12];$hargacharge=$harga[SingleSell];$tipe='Single';}  
               echo"$tipe";   
               }else if($data[Gender]=='INFANT' and $data[Package]=='L.A Only'){$hargaroom=$harga[LAInfant];$hargacharge='0';
               echo"No Bed";  
               }
           }else{
               if($data[Gender]=='ADULT' and $data[Package]=='Tour'){   
               if($data[RoomType]=='Twin'){$hargaroom=$harga[SellingAdlTwn];$hargacharge='0';}
               if($data[RoomType]=='Double'){$hargaroom=$harga[SellingAdlTwn];$hargacharge='0';}
               if($data[RoomType]=='Single'){$hargaroom=$harga[SellingAdlTwn];$hargacharge=$harga[SingleSell];}
               if($data[RoomType]=='Triple'){$hargaroom=$harga[SellingAdlTwn];$hargacharge='0';}
               echo"$data[RoomType]";  
               }else if($data[Gender]=='CHILD' and $data[Package]=='Tour'){
               if($data[RoomType]=='Twin'){$hargaroom=$harga[SellingChdTwn];$hargacharge='0';}
               if($data[RoomType]=='Double'){$hargaroom=$harga[SellingChdTwn];$hargacharge='0';}
               if($data[RoomType]=='Xtra Bed'){$hargaroom=$harga[SellingChdXbed];$hargacharge='0';}
               if($data[RoomType]=='No Bed'){$hargaroom=$harga[SellingChdNbed];$hargacharge='0';}
               if($data[RoomType]=='Single'){$hargaroom=$harga[SellingChdTwn];$hargacharge=$harga[SingleSell];}
               if($data[RoomType]=='Triple'){$hargaroom=$harga[SellingChdTwn];$hargacharge='0';}
               echo"$data[RoomType]";  
               }else if($data[Gender]=='INFANT' and $data[Package]=='Tour'){$hargaroom=$harga[SellingInfant];$hargacharge='0';
               echo"No Bed";  
               }
               else if($data[Gender]=='ADULT' and $data[Package]=='L.A Only'){   
               if($data[RoomType]=='Twin'){$hargaroom=$harga[LAAdlTwn];$hargacharge='0';}
               if($data[RoomType]=='Double'){$hargaroom=$harga[LAAdlTwn];$hargacharge='0';}
               if($data[RoomType]=='Single'){$hargaroom=$harga[LAAdlTwn];$hargacharge=$harga[SingleSell];}
               if($data[RoomType]=='Triple'){$hargaroom=$harga[LAAdlTwn];$hargacharge='0';}
               echo"$data[RoomType]";  
               }else if($data[Gender]=='CHILD' and $data[Package]=='L.A Only'){
               if($data[RoomType]=='Twin'){$hargaroom=$harga[LAChdTwn];$hargacharge='0';}
               if($data[RoomType]=='Double'){$hargaroom=$harga[LAChdTwn];$hargacharge='0';}
               if($data[RoomType]=='Xtra Bed'){$hargaroom=$harga[LAChdXbed];$hargacharge='0';}
               if($data[RoomType]=='No Bed'){$hargaroom=$harga[LAChdNbed];$hargacharge='0';}
               if($data[RoomType]=='Single'){echo"selected";$hargaroom=$harga[LAChdTwn];$hargacharge=$harga[SingleSell];}
               if($data[RoomType]=='Triple'){$hargaroom=$harga[LAChdTwn];$hargacharge='0';}
               echo"$data[RoomType]";   
               }else if($data[Gender]=='INFANT' and $data[Package]=='L.A Only'){$hargaroom=$harga[LAInfant];$hargacharge='0';
               echo"No Bed";  
               }
           }
          if($r[StatusPrice]=='LOCK'){
              $hargaroom=$data[Price];
          }else{
              $hargaroom=$hargaroom;
          }
          $subtotal1=$hargaroom+$hargacharge;
          $totDiscount=$data[Discount]+$data[AddDiscount];
          $subtotalnya=$subtotal1-$totDiscount;
    echo" <input type=hidden name='selectroom$no' value='$data[RoomType]'</td>    
          <td><input type=text name='harga$no' size='10' value=".number_format($hargaroom, 0, ',', '.');echo" style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type=text name='add$no' size='10' value=".number_format($hargacharge, 0, ',', '.');echo" style='text-align: right;border: 0px solid #000000;' readonly></td> 
          <td><input type=text name='disc$no' value=".number_format($data[Discount], 0, ',', '.');echo" size='10' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type=text name='adddisc$no' value=".number_format($data[AddDiscount], 0, ',', '.');echo" size='10' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type=text name='total$no' value=".number_format($subtotalnya, 0, ',', '.');echo" size='11' style='text-align: right;border: 0px solid #000000;' readonly></td>
          </tr>";
          $totalseluruh=$totalseluruh+$subtotalnya;
          $no++;
          }
          $bawah=mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE BookingID = '$_GET[code]'
                                And Status <> 'CANCEL'
                                AND Package <> 'L.A Only'
                                ORDER BY RoomNo ASC,IDDetail ASC ");
          $banyak=mysql_num_rows($bawah);      
          $bawahcruise=mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE BookingID = '$_GET[code]'
                                And Status <> 'CANCEL'    
                                ORDER BY RoomNo ASC,IDDetail ASC ");
          $banyakcruise=mysql_num_rows($bawahcruise);  
          $airtax=$curawal[TaxInsSell]; 
          $airseatax=$curawal[SeaTaxSell];   
          $totairtax=$airtax*$banyak;
          $totseatax=$airseatax*$banyakcruise;
          $tottax=$totairtax+$totseatax;
          $totsblmppn=$tottax+$totalseluruh -$r[ExtraDiscount];
          $ppntot=$totsblmppn*1/100;
          $totbayar=$totsblmppn+$ppntot;
          $sisabayar=$totbayar-$r[DepositAmount];
          $totairjkt=$curawal[AirTaxSell]*$banyak;
          $totvisa=$curawal[VisaSell]*$banyak;
          $ppnvisa=$totvisa*1/100;
          $bayarvisa=$totvisa+$ppnvisa;
          $totvisa2=$curawal[VisaSell2]*$banyak;
          if($r[ExtraDiscount]==''){$xtradisc='0';}else{$xtradisc=$r[ExtraDiscount];}
    echo "<input type='hidden' name='banyak' value='$banyak'><input type='hidden' name='jumtotal' value='$totalseluruh'> 
          <tr><td colspan=10 style='text-align: right'>International Airport Tax<br><font size=1><b>(subject to change)</b></td><td><input type='text' value=".number_format($totairtax, 0, ',', '.');echo" size='11' style='text-align: right;border: 0px solid #000000;' readonly><br><input type='text' value='(".number_format($airtax, 0, '.', '.');echo" x $banyak)' size='14' style='text-align: right;border: 0px solid #000000;font-size:8' readonly></font></td></tr>";
          if($curawal[GroupType]=='CRUISE'){
    echo "<tr><td colspan=10 style='text-align: right'>Sea Tax<br><font size=1><b>(subject to change)</b></td><td><input type='text' value=".number_format($totseatax, 0, ',', '.');echo" size='11' style='text-align: right;border: 0px solid #000000;' readonly><br><input type='text' value='(".number_format($airseatax, 0, '.', '.');echo" x $banyakcruise)' size='14' style='text-align: right;border: 0px solid #000000;font-size:8' readonly></font></td></tr>";
          }
    echo "<tr><td colspan=10 style='text-align: right'>Extra Discount</td><td><input type='text'   value='".number_format($xtradisc, 0, ',', '.');echo"' size='11' style='text-align: right;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=10 style='text-align: right'><i>Total before VAT </i></td><td><input type='text'   value=".number_format($totsblmppn, 0, ',', '.');echo" size='11' style='text-align: right;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=10 style='text-align: right'>VAT 1%</td><td><input type='text'  value=".number_format($ppntot, 0, ',', '.');echo" size='11' style='text-align: right;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=10 style='text-align: right'><b>ESTIMATE TOTAL PAYMENT ($harga[SellingCurr])</b></td><td><input type='text'  value=".number_format($totbayar, 0, ',', '.');echo" size='11' style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
          <tr style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'></td></tr>
          <tr><td colspan=2>Deposit </td><td><center>$r[DepositCurr]</center></td><td colspan=2><input type='text' value=".number_format($r[DepositAmount], 0, ',', '.');echo" size='11' style='text-align: right;border: 0px solid #000000;' readonly> </td><td colspan=3>Deposit No : $r[DepositNo] ($r[DepositDate])</td></tr>";/*airport tax jakarta
          <tr><td colspan=2>Domestic Airport Tax</td><td><center>$curawal[AirTaxCurr]</center></td><td colspan=2><input type='text' value=".number_format($totairjkt, 0, ',', '.');echo" size='11' style='text-align: right;border: 0px solid #000000;' readonly> <font size=1 align=right>(".number_format($curawal[AirTaxSell], 0, '.', '.');echo" x $banyak)</font></td></tr>*/
				    $ambil=mysql_query("SELECT * FROM tour_msproduct                                         
                    WHERE tour_msproduct.IDProduct ='$r[IDTourcode]'");
            $isi=mysql_fetch_array($ambil);
		    if($isi[Embassy01]<>'0')
                {   $Qvisa=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy01]'");
                    $Dvisa=mysql_fetch_array($Qvisa);
                    echo"<tr><td colspan=2>VISA $Dvisa[Country]</td><td style='text-align:right'>IDR</td><td style='text-align:right' colspan=2>".number_format($isi[VisaSell], 0, '', ',');echo"</td></tr>";
                }
                if($isi[Embassy02]<>'0')
                {   $Qvisa2=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy02]'");
                    $Dvisa2=mysql_fetch_array($Qvisa2);
                    echo"<tr><td colspan=2>VISA $Dvisa2[Country]</td><td style='text-align:right'>IDR</td><td style='text-align:right' colspan=2>".number_format($isi[VisaSell2], 0, '', ',');echo"</td></tr>";
                }
                if($isi[Embassy03]<>'0')
                {   $Qvisa3=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy03]'");
                    $Dvisa3=mysql_fetch_array($Qvisa3);
                    echo"<tr><td colspan=2>VISA $Dvisa3[Country]</td><td style='text-align:right'>IDR</td><td style='text-align:right' colspan=2>".number_format($isi[VisaSell3], 0, '', ',');echo"</td></tr>";
                }
                if($isi[Embassy04]<>'0')
                {   $Qvisa4=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy04]'");
                    $Dvisa4=mysql_fetch_array($Qvisa4);
                    echo"<tr><td colspan=2>VISA $Dvisa4[Country]</td><td style='text-align:right'>IDR</td><td style='text-align:right' colspan=2>".number_format($isi[VisaSell4], 0, '', ',');echo"</td></tr>";
                }
                if($isi[Embassy05]<>'0')
                {   $Qvisa5=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy05]'");
                    $Dvisa5=mysql_fetch_array($Qvisa5);
                    echo"<tr><td colspan=2>VISA $Dvisa5[Country]</td><td style='text-align:right'>IDR</td><td style='text-align:right' colspan=2>".number_format($isi[VisaSell5], 0, '', ',');echo"</td></tr>";
                }
		echo"</table> 
                                
          <table style='border: 0px solid #000000;'>
          <tr><td width=1050 style='border: 0px solid #000000;'><b>REMARKS</b></td></tr>
          <tr><td>$r[OperationNote]</td></tr>
          <tr style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'>$Promo</td></tr></table>  
          <br>";
          if($totalseluruh < 1 OR $isi[DateTravelFrom]<=$skrg ){
            echo"<input type='submit' name='submit' value='CREATE TRF' disabled>";   
          }else {
            echo"<input type='submit' name='submit'' value='CREATE TRF' >";
          }
    echo" </form>
          <br><br>";
          break;
          
  case "savefbt":
     $today = date("Y-m-d", time());
     $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_POST[getcode]'");
     $r=mysql_fetch_array($edit);
     $editr=mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_POST[getcode]'");
     $s=mysql_fetch_array($editr);
     $awal=mysql_query("SELECT * FROM tour_msproduct left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode WHERE IDProduct = '$r[IDTourcode]'");
     $curawal=mysql_fetch_array($awal);
     $hari= date("Y", time());
     $bookid = $_POST[getcode]; 
     for ($satu=1; $satu<=$_POST[banyak]; $satu++) {             
        $isig1=$_POST[iddetail.$satu];     
        $isigsatu6=str_replace(".", "",$_POST[harga.$satu]);
        $isig6=str_replace(",", ".",$isigsatu6);  
        $isigsatu7=str_replace(".", "",$_POST[add.$satu]);
        $isig7=str_replace(",", ".",$isigsatu7);   
        $isigsatu8=str_replace(".", "",$_POST[total.$satu]);
        $isig8=str_replace(",", ".",$isigsatu8);                  
            mysql_query("UPDATE tour_msbookingdetail set Price = '$isig6',
                                                    AddCharge = '$isig7',        
                                                    SubTotal = '$isig8'
                                                    WHERE IDDetail = '$isig1'");      
      }
      $jumtotal1=str_replace(".", "",$_POST[jumtotal]);
       $jumtotal=str_replace(",", ".",$jumtotal1); 
       mysql_query("UPDATE tour_msbooking set TotalPrice = '$jumtotal'  
                                                WHERE BookingID = '$bookid'");              
     $tampil = mysql_query("SELECT * FROM tour_fbtbooking where OfficeKey = '$r[OfficeKey]'
                ORDER BY IDFbt DESC limit 1");
    $hasil = mysql_fetch_array($tampil);
    $jumlah = mysql_num_rows($tampil);
   // $tahun = substr($hasil[FBTNo],3,4); 
    
    if($jumlah > 0){       
        //$tahun1 = $hari; 
        if(strlen($r[OfficeKey])==2) {
            $tiket=substr($hasil[FBTNo],6,7)+1;
        }elseif(strlen($r[OfficeKey])==3){
            $tiket=substr($hasil[FBTNo],7,7)+1;
        }
            switch ($tiket){
            case ($tiket<10):
            $tiket1 = "000000".$tiket;
            break;  
            case ($tiket>9 && $tiket<100):
            $tiket1 = "00000".$tiket;
            break;  
            case ($tiket>99 && $tiket<1000):
            $tiket1 = "0000".$tiket;
            break;
            case ($tiket>999 && $tiket<10000):
            $tiket1 = "000".$tiket;
            break; 
            case ($tiket>9999 && $tiket<100000):
            $tiket1 = "00".$tiket;
            break;
            case ($tiket>99999 && $tiket<1000000):
            $tiket1 = "0".$tiket;
            break;   
            }  
    }else {
      // $tahun1 = $hari;
       $tiket1="0000001";  
    }
    $mencari=mysql_query("SELECT * FROM tour_fbtbooking WHERE FBTNo = 'TRF$r[OfficeKey]-$tiket1' and status = 'ACTIVE' ");
    $dapet=mysql_num_rows($mencari);
    if($dapet==0){
    mysql_query("UPDATE tour_msbooking SET FBTNo = 'TRF$r[OfficeKey]-$tiket1'
                               WHERE BookingID = '$_POST[getcode]'");    
    mysql_query("INSERT INTO tour_fbtbooking(FBTNo,
                                              BookingID,
                                              TourCode,
                                              BookersName,
                                              BookersTelp,
                                              BookersMobile,
                                              BookersAddress,
                                              EmergencyCall,
                                              TCName,
                                              TCDivision,
                                              OfficeKey,
                                              AdultPax,
                                              ChildPax,
                                              InfantPax,
                                              StartRoom,
                                              EndRoom,
                                              TotalRoom,
                                              DepositDate,
                                              DepositNo,
                                              DepositCurr,
                                              DepositAmount,
                                              ExtraDiscount,
                                              Curr,
                                              TotalPrice,
                                              OperationNote,
                                              BookingStatus,
                                              BookingDate,
                                              ProductCodeName,
                                              ProductCode,
                                              DateTravelFrom,
                                              TaxInsSell,
                                              SeaTaxSell,
                                              AirTaxCurr,
                                              AirTaxSell,
                                              VisaCurr,
                                              VisaSell,
                                              VisaCurr2,
                                              VisaSell2,
                                              VisaSell3,
                                              VisaSell4,
                                              VisaSell5,
                                              SellingCurr,
                                              Status,
                                              FBTDate)
                                VALUES('TRF$r[OfficeKey]-$tiket1',
                                       '$r[BookingID]',
                                       '$r[TourCode]',
                                       '$r[BookersName]',
                                       '$r[BookersTelp]', 
                                       '$r[BookersMobile]', 
                                       '$r[BookersAddress]',
                                       '$r[EmergencyCall]',
                                       '$r[TCName]', 
                                       '$r[TCDivision]',
                                       '$r[OfficeKey]',
                                       '$r[AdultPax]', 
                                       '$r[ChildPax]',           
                                       '$r[InfantPax]',
                                       '$r[StartRoom]',
                                       '$r[EndRoom]',
                                       '$r[TotalRoom]',  
                                       '$r[DepositDate]', 
                                       '$r[DepositNo]',
                                       '$r[DepositCurr]',
                                       '$r[DepositAmount]',
                                       '$r[ExtraDiscount]',
                                       '$r[Curr]',
                                       '$r[TotalPrice]',
                                       '$r[OperationNote]',
                                       '$r[BookingStatus]',
                                       '$r[BookingDate]',
                                       '$curawal[ProductCode]',
                                       '$curawal[Productcode]',
                                       '$curawal[DateTravelFrom]',
                                       '$curawal[TaxInsSell]',
                                       '$curawal[SeaTaxSell]',
                                       '$curawal[AirTaxCurr]',
                                       '$curawal[AirTaxSell]',
                                       '$curawal[VisaCurr]',
                                       '$curawal[VisaSell]',
                                       '$curawal[VisaCurr2]',
                                       '$curawal[VisaSell2]',
                                       '$curawal[VisaSell3]',
                                       '$curawal[VisaSell4]',
                                       '$curawal[VisaSell5]',
                                       '$curawal[SellingCurr]',
                                       'ACTIVE',
                                       '$today')");
    $Description="Create New TRF (TRF$r[OfficeKey]-$tiket1)"; 
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");  
    $editr=mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_POST[getcode]'");
     while($s=mysql_fetch_array($editr)){
        mysql_query("INSERT INTO tour_fbtbookingdetail( FBTNo,
                                                        Urutan,
                                                        TourCode,
                                                        BookingID,
                                                        PaxName,
                                                        Title,
                                                        Gender,
                                                        Package,
                                                        RoomType,
                                                        RoomNo,
                                                        Deviasi,
                                                        BirthPlace,
                                                        BirthDate,
                                                        PassportNo,
                                                        PassportIssued,
                                                        PassportValid,
                                                        Price,
                                                        AddCharge,
                                                        Discount,
                                                        AddDiscount,
                                                        SubTotal,
                                                        Promo,
                                                        Status,
                                                        InfoDeviasi,
                                                        DeviasiNo,
                                                        KuesionerNo) 
                                            VALUES ('TRF$r[OfficeKey]-$tiket1',
                                                    '$s[Urutan]',
                                                    '$s[TourCode]',
                                                    '$s[BookingID]',
                                                    '$s[PaxName]',
                                                    '$s[Title]',
                                                    '$s[Gender]',
                                                    '$s[Package]',
                                                    '$s[RoomType]',
                                                    '$s[RoomNo]',
                                                    '$s[Deviasi]',
                                                    '$s[BirthPlace]',
                                                    '$s[BirthDate]',
                                                    '$s[PassportNo]',
                                                    '$s[PassportIssued]',
                                                    '$s[PassportValid]',
                                                    '$s[Price]',
                                                    '$s[AddCharge]',
                                                    '$s[Discount]',
                                                    '$s[AddDiscount]',
                                                    '$s[SubTotal]',
                                                    '$s[Promo]',
                                                    '$s[Status]',
                                                    '$s[InfoDeviasi]',
                                                    '$s[DeviasiNo]',
                                                    '$s[KuesionerNo]')");    
     }
    }
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=fbt.php?act=showfbt&FBT=TRF$r[OfficeKey]-$tiket1'>";       
    break;
    
    case "showfbt":
    $sedit=mysql_query("SELECT * FROM tour_fbtbooking WHERE FBTNo = '$_GET[FBT]'");
    $sr=mysql_fetch_array($sedit);
    $seditr=mysql_query("SELECT * FROM tour_fbtbookingdetail WHERE FBTNo = '$_GET[FBT]'");
    $ss=mysql_fetch_array($seditr);                //               <img src='images/pano1.jpg'>
    $qbuk=mysql_query("SELECT * FROM tour_msbooking left join tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode WHERE BookingID = '$sr[BookingID]'");
    $buk=mysql_fetch_array($qbuk);
    $datacomp=mysql_query("SELECT * FROM tbl_mscompany WHERE CompanyID = '$compid'");
    $comp=mysql_fetch_array($datacomp);
    //if($compid==1){$logo="<img src='$comp[Logo]'>";}else{$logo='';}
    $fbtdate = date("d M Y", strtotime($sr[FBTDate]));
    $depdet = date("d M Y", strtotime($sr[DateTravelFrom]));
    if($sr[BookersMobile]<>''){$garing='/';}
      echo "<center>
          <table style='border: 0px solid #000000;'>
          <tr><td width='550' style='border: 0px solid #000000;'><img src='$comp[Logo]'></td><td width='500' style='border: 0px solid #000000;' colspan=2><br><font size=5><b>TOUR RESERVATION FORM</b></font></td></tr>
          <tr><td rowspan=4 width=200 style='border: 0px solid #000000;'><font size=1>$comp[CompanyName]<br>$tampiluser[divAddress]<br>
          Ph : $tampiluser[divPhone] (H) Fax: $tampiluser[divFax]<br>
          E-mail: $tampiluser[divEmail]<br>
          $comp[Website]</font></td><td style='border: 0px solid #000000;' colspan=2><font size=3><b>$sr[FBTNo]</b></font></td></tr>
          <td width='50' style='border: 0px solid #000000;'>Attn</td><td style='border: 0px solid #000000;'>: $sr[BookersName]</td></tr>
          <tr><td style='border: 0px solid #000000;' colspan=2>$sr[BookersAddress]</td></tr>
          <tr><td style='border: 0px solid #000000;' colspan=2>( $sr[BookersTelp] $garing $sr[BookersMobile] )</td></tr>
          <tr><td style='border: 0px solid #000000;'>TC Name/Counter : $sr[TCName] - $sr[TCDivision]</td><td style='border: 0px solid #000000;'>Tour</td><td style='border: 0px solid #000000;' width=230>: $sr[TourCode] ($sr[ProductCode])</td></tr>
          <tr><td style='border: 0px solid #000000;'>Date : $fbtdate <br>Booking ID : $sr[BookingID]</td><td style='border: 0px solid #000000;'>Departure Date</td><td style='border: 0px solid #000000;'>: $depdet </td></tr>
          <tr></tr>
          </table>";
          $tampil=mysql_query("SELECT * FROM tour_fbtbookingdetail   
                                WHERE FBTNo = '$_GET[FBT]'
                                And Status <> 'CANCEL'
                                ORDER BY RoomNo ASC,IDDetail ASC ");
          if($buk[GroupType]=='CRUISE'){$rtype='TYPE';}else{$rtype='ROOM TYPE';}
    echo" <table style='border: 0px solid #000000;'>
          <tr><th BGCOLOR='#f48221'>No</th><th BGCOLOR='#f48221' width=200>PAX Name</th><th BGCOLOR='#f48221' width=40>Type</th><th BGCOLOR='#f48221' width=70>Passport</th><th BGCOLOR='#f48221'>Package</th><th BGCOLOR='#f48221' width=70>$rtype</th><th BGCOLOR='#f48221'>Price</th><th BGCOLOR='#f48221'>SGL SUPPLEMENT</th><th BGCOLOR='#f48221'>Disc</th><th BGCOLOR='#f48221'>Disc Exh</th><th BGCOLOR='#f48221'>Total</th></tr>";
          $no=$posisi+1;
          $banyak=mysql_num_rows($tampil);
          while ($data=mysql_fetch_array($tampil)){
          $vch=mysql_query("SELECT * FROM `tour_voucherpromo` WHERE `VoucherNo` = '$data[VoucherNo]' and `VoucherStatus`='APPROVE'");
          $vchok=mysql_num_rows($vch);
          if($data[PaxName]==''){$namapax='<center>TBA</center>';}else{$namapax=$data[Title].'. '.$data[PaxName];}
          if($data[Promo]<>'' AND $vchok > 0){$bintang="<font color=red>*</font>";$Promo="<font size=1><i>* $data[Promo]</i></font>";}else{$bintang="";}
    echo" <tr><td>$no <input type='hidden' name='iddetail$no' value='$data[IDDetail]'> </td>   
          <td>$namapax $bintang</td>   
          <td><center>$data[Gender]</td>
          <td><center>$data[PassportNo]</td> 
          <td><center>";if($data[Gender]=='INFANT'){}else{echo"$data[Package]";}echo"</td>";
          
    echo" <td><center>";
           if($buk[GroupType]=='CRUISE'){                            
               if($data[Gender]=='ADULT'){   
                if($data[RoomType]=='12 Pax'){echo"1-2 PAX";}else if($data[RoomType]=='34 Pax'){echo"3-4 PAX";} else if($data[RoomType]=='1 Pax'){echo"Single";}  
               }else if($data[Gender]=='CHILD'){
                if($data[RoomType]=='12 Pax'){echo"1-2 PAX";}else if($data[RoomType]=='34 Pax'){echo"3-4 PAX";} else if($data[RoomType]=='1 Pax'){echo"Single";}   
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
          <td><input type=text name='harga$no' size='10' value=".number_format($data[Price], 0, ',', '.');echo" style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type=text name='add$no' size='10' value=".number_format($data[AddCharge], 0, ',', '.');echo" style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type=text name='disc$no' value=".number_format($data[Discount], 0, ',', '.');echo" size='10' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type=text name='adddisc$no' value=".number_format($data[AddDiscount], 0, ',', '.');echo" size='10' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type=text name='total$no' value=".number_format($data[SubTotal], 0, ',', '.');echo" size='11' style='text-align: right;border: 0px solid #000000;' readonly></td>
          </tr>";
          $no++;
          }
          $bawah=mysql_query("SELECT * FROM tour_fbtbookingdetail   
                                WHERE FBTNo = '$_GET[FBT]'
                                And Status <> 'CANCEL'
                                AND Package <> 'L.A Only'
                                ORDER BY RoomNo ASC,IDDetail ASC ");
          $banyak=mysql_num_rows($bawah); 
          $airseatax=$sr[TaxInsSell]+$sr[SeaTaxSell];
          $totairtax=$airseatax*$banyak;
          $totsblmppn=$totairtax + $sr[TotalPrice] - $sr[ExtraDiscount];
          $ppntot=$totsblmppn*1/100;
          $totbayar=$totsblmppn+$ppntot;
          $sisabayar=$totbayar-$sr[DepositAmount];
          $totairjkt=$sr[AirTaxSell]*$banyak;
          $totvisa=$sr[VisaSell]*$banyak;
          $ppnvisa=$totvisa*1/100;
          $bayarvisa=$totvisa+$ppnvisa;
          $totvisa2=$sr[VisaSell2]*$banyak;
          $depositdet = date("d M Y", strtotime($sr[DepositDate])); 
          if($sr[ExtraDiscount]==''){$xtradisc='0';}else{$xtradisc=$sr[ExtraDiscount];}
    echo "
             <tr><td colspan=10 style='text-align: right'>International Airport Tax<br><font size=1><b>(subject to change)</b></td><td><input type='text' value=".number_format($totairtax, 0, ',', '.');echo" size='11' style='text-align: right;border: 0px solid #000000;' readonly><br><input type='text' value='(".number_format($airseatax, 0, '.', '.');echo" x $banyak)' size='14' style='text-align: right;border: 0px solid #000000;font-size:8' readonly></font></td></tr>
          <tr><td colspan=10 style='text-align: right'>Extra Discount</td><td><input type='text'   value='(".number_format($xtradisc, 0, ',', '.');echo")' size='11' style='text-align: right;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=10 style='text-align: right'><i>Total before VAT </i></td><td><input type='text'   value=".number_format($totsblmppn, 0, ',', '.');echo" size='11' style='text-align: right;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=10 style='text-align: right'>VAT 1%</td><td><input type='text'  value=".number_format($ppntot, 0, ',', '.');echo" size='11' style='text-align: right;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=10 style='text-align: right'><b>ESTIMATE TOTAL PAYMENT ($sr[SellingCurr])</b></td><td><input type='text'  value=".number_format($totbayar, 0, ',', '.');echo" size='10' style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
          <tr style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'></td></tr>
          <tr><td colspan=2>Deposit </td><td><center>$sr[DepositCurr]</center></td><td colspan=2><input type='text'  value=".number_format($sr[DepositAmount], 0, ',', '.');echo" size='11' style='text-align: right;border: 0px solid #000000;' readonly> </td><td colspan=3>Deposit No : $sr[DepositNo] ($depositdet)</td></tr>";
       /*<tr><td colspan=2>Domestic Airport Tax</td><td><center>$sr[AirTaxCurr]</center></td><td colspan=2><input type='text' value=".number_format($totairjkt, 0, ',', '.');echo" size='11' style='text-align: right;border: 0px solid #000000;' readonly> <font size=1 align=right>(".number_format($sr[AirTaxSell], 0, '.', '.');echo" x $banyak)</font></td></tr>
	   
  if($isi[Embassy01]<>'0')
                {   $Qvisa=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy01]'");
                    $Dvisa=mysql_fetch_array($Qvisa);
                    echo"<tr><td>VISA $Dvisa[Country]</td><td style='text-align:right'>IDR</td><td style='text-align:right'>".number_format($VisaSell, 0, '', ',');echo"</td></tr>";
                }
                if($isi[Embassy02]<>'0')
                {   $Qvisa2=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy02]'");
                    $Dvisa2=mysql_fetch_array($Qvisa2);
                    echo"<tr><td>VISA $Dvisa2[Country]</td><td style='text-align:right'>IDR</td><td style='text-align:right'>".number_format($VisaSell2, 0, '', ',');echo"</td></tr>";
                }
                if($isi[Embassy03]<>'0')
                {   $Qvisa3=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy03]'");
                    $Dvisa3=mysql_fetch_array($Qvisa3);
                    echo"<tr><td>VISA $Dvisa3[Country]</td><td style='text-align:right'>IDR</td><td style='text-align:right'>".number_format($VisaSell3, 0, '', ',');echo"</td></tr>";
                }
                if($isi[Embassy04]<>'0')
                {   $Qvisa4=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy04]'");
                    $Dvisa4=mysql_fetch_array($Qvisa4);
                    echo"<tr><td>VISA $Dvisa4[Country]</td><td style='text-align:right'>IDR</td><td style='text-align:right'>".number_format($VisaSell4, 0, '', ',');echo"</td></tr>";
                }
                if($isi[Embassy05]<>'0')
                {   $Qvisa5=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy05]'");
                    $Dvisa5=mysql_fetch_array($Qvisa5);
                    echo"<tr><td>VISA $Dvisa5[Country]</td><td style='text-align:right'>IDR</td><td style='text-align:right'>".number_format($VisaSell5, 0, '', ',');echo"</td></tr>";
                }	   vili visa
	   
	   */

          echo"<tr><td colspan=2>VISA</td><td><center>$sr[VisaCurr]</center></td><td width='225' colspan=2><input type='text' value=".number_format($bayarvisa, 0, ',', '.');echo" size='11' style='text-align: right;border: 0px solid #000000;' readonly> <font size=1 align=right>(".number_format($sr[VisaSell], 0, '.', '.');echo" + 1% x $banyak)</font></td></tr>
          <tr><td colspan=2>VISA 2</td><td><center>$sr[VisaCurr2]</center></td><td colspan=2><input type='text' value=".number_format($totvisa2, 0, ',', '.');echo" size='11' style='text-align: right;border: 0px solid #000000;' readonly> <font size=1 align=right>(".number_format($sr[VisaSell2], 0, '.', '.');echo" x $banyak)</font></td></tr>
          </table>  
          <table style='border: 0px solid #000000;'>
          <tr><td width='1050' style='border: 0px solid #000000;'><b>REMARKS</b></td></tr>
          <tr><td>$sr[OperationNote]</td></tr>
          <tr style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'>$Promo</td></tr></table>  
          <br>
          <iframe src='fbtsum.php?code=$_GET[FBT]' name='fbtsum' style='visibility: hidden' height='0' width='0' frameborder='0'>
          </iframe>
          <iframe src='fbtdetail.php?code=$_GET[FBT]' name='fbtdetail' style='visibility: hidden' height='0' width='0' frameborder='0'>
          </iframe>";
          if($sr[PrintSum]=='1'){$printsum='PRINT SUMMARY (DUPLICATE)';}else {$printsum='PRINT SUMMARY';}
          if($sr[PrintDetail]=='1'){$printdet='PRINT DETAIL (DUPLICATE)';}else {$printdet='PRINT DETAIL';}
          if($sr[Status]=='VOID'){?>
          <style>            
        html { 
            background: url(../admin/images/void-stamp.png) no-repeat ;
            background-position: center 50px ;
        }       
    </style>  <?PHP                          //   date : $sr[VoidDate] by $sr[VoidBy]
          }else{
    if($buk[StatusProduct]=='FINALIZE'){$cant="disabled";}else{$cant="enabled";}
    echo "<input type='button' value='$printsum' onClick=frames['fbtsum'].print(),location.href='fbt.php?act=printsum&no=$_GET[FBT]' >   
          <input type='button' value='$printdet' onClick=frames['fbtdetail'].print(),location.href='fbt.php?act=printdetail&no=$_GET[FBT]' >
          <input type='button' value='VOID TRF' onclick=rubah('$_GET[FBT]') $cant>
          <br><br>
          ";
          }
    break;
    
  case "printsum":    
    $edit=mysql_query("update tour_fbtbooking set PrintSum='1' WHERE Status='ACTIVE' and FBTNo = '$_GET[no]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=fbt.php?act=showfbt&FBT=$_GET[no]'>";   
     break;
     
  case "printdetail":    
    $edit=mysql_query("update tour_fbtbooking set PrintDetail='1' WHERE Status='ACTIVE' and FBTNo = '$_GET[no]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=fbt.php?act=showfbt&FBT=$_GET[no]'>";   
     break;
     
  case "voidfbt":    
    $edit=mysql_query("UPDATE tour_fbtbooking set Status = 'VOID',VoidDate='$today',VoidBy='$EmpName' WHERE FBTNo = '$_GET[FBT]'");
    $updet=mysql_query("UPDATE tour_msbooking set FBTNo='' WHERE FBTNo = '$_GET[FBT]'");
    $Description="VOID FBT ($_GET[FBT])";          
    mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");       
      ?>
      <script language='javascript' type='text/javascript'>
      updatepage();   
      </script> <?php 
    break; 
}
?> <?php 
      
?>
</body>
</html>
<script>
	window.opener.location.reload();
</script>