<html>
<head>
<title>Template Booking Form</title>
<link href="../config/print.css" rel="stylesheet" type="text/css" />      
</head>
<?php 
include "../config/koneksi.php";
include "../config/koneksimaster.php";
include "../config/fungsi_an.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

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
</script>
<script language="JavaScript"  type="text/javascript"> 
function rubah(ID) {
if (confirm("Are you sure you want to void " + ID +""))
{
 window.location.href = '../admin/tbf.php?act=voidtbf&TBF=' + ID  ;  
} 
}
function updatepage() {
        window.close();
        window.opener.location.reload();
    }
function ngecek(ID,CODE) {
    if (ID == 0)
{
 window.location.href = 'tbf.php?act=savetbf&code=' + CODE  ;   
}else {
    alert('PLEASE CHECK AGAIN PAX NAME AND PASSPORT NO!!');  
    document.example.elements['submit'].disabled=true;
    return false;
    
} 
}
</script> 
<?php
$skrg = date("Y-m-d");
$username=$_SESSION[employee_code];
$sql1=mssql_query("SELECT IndexDivisi FROM [HRM].[dbo].[Employee]
                  WHERE EmployeeID = '$username'");
$dtuser=mssql_fetch_array($sql1);
$sqluser=mssql_query("SELECT Divisi.Address as divAddress,Divisi.Email as divEmail,
                  Divisi.Phone as divPhone,Divisi.Fax as divFax FROM [HRM].[dbo].[Divisi]
                  WHERE IndexDivisi = '$dtuser[IndexDivisi]'");
$tampiluser=mssql_fetch_array($sqluser);
$compid=$_SESSION[company_id];
switch($_GET[act]) {               //<img src='images/pano1.jpg'>
    default:
        $edit = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");
        $r = mysql_fetch_array($edit);
        $awal = mysql_query("SELECT * FROM tour_msproduct left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode WHERE IDProduct = '$r[IDTourcode]'");
        $curawal = mysql_fetch_array($awal);
        $thisyear = date("Y");
        $nextyear = $thisyear + 1;
        $getcode = $_GET[code];
        $datacomp=mysql_query("SELECT * FROM tbl_mscompany WHERE CompanyID = '$compid'");
        $comp=mysql_fetch_array($datacomp);
        echo "<center>
          <table style='border: 0px solid #000000;'>
          <tr><td width=450 style='border: 0px solid #000000;'><img src='$comp[Logo]'></td><td style='border: 0px solid #000000;' colspan=2><br><font size=5><b>TEMPLATE BOOKING FORM</b></font></td></tr>
          <tr><td rowspan=4 width=200 style='border: 0px solid #000000;'><font size=1>$comp[CompanyName]<br>$tampiluser[divAddress]<br>
          Ph : $tampiluser[divPhone] (H) Fax: $tampiluser[divFax]<br>
          E-mail: $tampiluser[divEmail]<br>
          $comp[Website]</font></td><td style='border: 0px solid #000000;'>Attn</td><td style='border: 0px solid #000000;'>: $r[BookersName]</td></tr>
          <tr><td style='border: 0px solid #000000;' colspan=2>$r[BookersAddress]</td></tr>
          <tr><td style='border: 0px solid #000000;' colspan=2>( $r[BookersTelp] / $r[BookersMobile] )</td></tr>   
          <tr><td style='border: 0px solid #000000;' width=100>Tour</td><td style='border: 0px solid #000000;' width=230>: $curawal[TourCode] ($curawal[Productcode])</td></tr>  
          <tr><td style='border: 0px solid #000000;'>TC Name/Counter : $r[TCName] - $r[TCDivision]</td> <td style='border: 0px solid #000000;'>Departure Date</td><td style='border: 0px solid #000000;'>:  " . date('d-m-Y', strtotime($curawal[DateTravelFrom])) . " </td></tr>
          <tr></tr>                                                
          </table> 
          <table style='border: 0px solid #000000;'>
          <tr><td width=800 style='border: 0px solid #000000;'>Booking ID : $getcode</td></tr>                                                             
          </table>";
        $tampil = mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE BookingID = '$getcode'
                                And Status <> 'CANCEL'
                                ORDER BY RoomNo ASC,IDDetail ASC ");
        $statact = $_GET[stat];
        if ($statact == 'REVISE') {
            $lnk = "tbf.php?act=revisetbf";
        } else {
            $lnk = "tbf.php?act=savetbf";
        }
        if ($curawal[GroupType] == 'CRUISE') {
            $rtype = 'TYPE';
        } else {
            $rtype = 'ROOM TYPE';
        }
        echo " <form name='example' method='POST' action='$lnk' > 
          <table style='border: 0px solid #000000;'>
          <tr><th BGCOLOR='#f48221'>No</th><th BGCOLOR='#f48221' width=200>PAX Name</th><th BGCOLOR='#f48221' width=40>Type</th><th BGCOLOR='#f48221' width=70>Passport</th><th BGCOLOR='#f48221'>Package</th><th BGCOLOR='#f48221' width=65>$rtype</th><th BGCOLOR='#f48221' width=290>Special request</th></tr>";
        $no = $posisi + 1;
        $banyak = mysql_num_rows($tampil);
        while ($data = mysql_fetch_array($tampil)) {
            $vch = mysql_query("SELECT * FROM `tour_voucherpromo` WHERE `VoucherNo` = '$data[VoucherNo]' and `VoucherStatus`='APPROVE'");
            $vchok = mysql_num_rows($vch);
            if ($data[PaxName] == '') {
                $namapax = '<center>TBA</center>';
            } else {
                $namapax = $data[Title] . '. ' . $data[PaxName];
            }
            if ($data[Promo] <> '' AND $vchok > 0) {
                $bintang = "<font color=red>*</font>";
                $Promo = "<font size=1><i>* $data[Promo]</i></font>";
            } else {
                $bintang = "";
            }
            echo " <tr><td>$no <input type='hidden' name='iddetail$no' value='$data[IDDetail]'><input type='hidden' name='getcode' value='$getcode'> </td>   
          <td>$namapax $bintang</td>   
          <td><center>$data[Gender]</td>
          <td><center>$data[PassportNo]</td> 
          <td><center>";
            if ($data[Gender] == 'INFANT') {
            } else {
                echo "$data[Package]";
            }
            echo "</td>";
            $cadltwn = mysql_query("SELECT * FROM tour_msproduct   
                                        WHERE IDProduct = '$r[IDTourcode]' and Status <> 'VOID'");
            $harga = mysql_fetch_array($cadltwn);
            echo " <td><center>";
            if ($curawal[GroupType] == 'CRUISE') {
                if ($data[Gender] == 'ADULT' and $data[Package] == 'Tour') {
                    if ($data[RoomType] == '12 Pax') {
                        $hargaroom = $harga[CruiseAdl12];
                        $hargacharge = '0';
                        $tipe = '1-2 PAX';
                    }
                    if ($data[RoomType] == '34 Pax') {
                        $hargaroom = $harga[CruiseAdl34];
                        $hargacharge = '0';
                        $tipe = '3-4 PAX';
                    }
                    if ($data[RoomType] == '1 Pax') {
                        $hargaroom = $harga[CruiseAdl12];
                        $hargacharge = $harga[SingleSell];
                        $tipe = 'Single';
                    }
                    echo "$tipe";
                } else if ($data[Gender] == 'CHILD' and $data[Package] == 'Tour') {
                    if ($data[RoomType] == '12 Pax') {
                        $hargaroom = $harga[CruiseChd12];
                        $hargacharge = '0';
                        $tipe = '1-2 PAX';
                    }
                    if ($data[RoomType] == '34 Pax') {
                        $hargaroom = $harga[CruiseChd34];
                        $hargacharge = '0';
                        $tipe = '3-4 PAX';
                    }
                    if ($data[RoomType] == '1 Pax') {
                        $hargaroom = $harga[CruiseChd12];
                        $hargacharge = $harga[SingleSell];
                        $tipe = 'Single';
                    }
                    echo "$tipe";
                } else if ($data[Gender] == 'INFANT' and $data[Package] == 'Tour') {
                    $hargaroom = $harga[SellingInfant];
                    $hargacharge = '0';
                    echo "No Bed";
                } else if ($data[Gender] == 'ADULT' and $data[Package] == 'L.A Only') {
                    if ($data[RoomType] == '12 Pax') {
                        $hargaroom = $harga[CruiseLoAdl12];
                        $hargacharge = '0';
                        $tipe = '1-2 PAX';
                    }
                    if ($data[RoomType] == '34 Pax') {
                        $hargaroom = $harga[CruiseLoAdl34];
                        $hargacharge = '0';
                        $tipe = '3-4 PAX';
                    }
                    if ($data[RoomType] == '1 Pax') {
                        $hargaroom = $harga[CruiseLoAdl12];
                        $hargacharge = $harga[SingleSell];
                        $tipe = 'Single';
                    }
                    echo "$tipe";
                } else if ($data[Gender] == 'CHILD' and $data[Package] == 'L.A Only') {
                    if ($data[RoomType] == '12 Pax') {
                        $hargaroom = $harga[CruiseLoChd12];
                        $hargacharge = '0';
                        $tipe = '1-2 PAX';
                    }
                    if ($data[RoomType] == '34 Pax') {
                        $hargaroom = $harga[CruiseloChd34];
                        $hargacharge = '0';
                        $tipe = '3-4 PAX';
                    }
                    if ($data[RoomType] == '1 pax') {
                        $hargaroom = $harga[CruiseLoChd12];
                        $hargacharge = $harga[SingleSell];
                        $tipe = 'Single';
                    }
                    echo "$tipe";
                } else if ($data[Gender] == 'INFANT' and $data[Package] == 'L.A Only') {
                    $hargaroom = $harga[LAInfant];
                    $hargacharge = '0';
                    echo "No Bed";
                }
            } else {
                if ($data[Gender] == 'ADULT' and $data[Package] == 'Tour') {
                    if ($data[RoomType] == 'Twin') {
                        $hargaroom = $harga[SellingAdlTwn];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Double') {
                        $hargaroom = $harga[SellingAdlTwn];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Single') {
                        $hargaroom = $harga[SellingAdlTwn];
                        $hargacharge = $harga[SingleSell];
                    }
                    if ($data[RoomType] == 'Triple') {
                        $hargaroom = $harga[SellingAdlTwn];
                        $hargacharge = '0';
                    }
                    echo "$data[RoomType]";
                } else if ($data[Gender] == 'CHILD' and $data[Package] == 'Tour') {
                    if ($data[RoomType] == 'Twin') {
                        $hargaroom = $harga[SellingChdTwn];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Double') {
                        $hargaroom = $harga[SellingChdTwn];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Xtra Bed') {
                        $hargaroom = $harga[SellingChdXbed];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'No Bed') {
                        $hargaroom = $harga[SellingChdNbed];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Single') {
                        $hargaroom = $harga[SellingChdTwn];
                        $hargacharge = $harga[SingleSell];
                    }
                    if ($data[RoomType] == 'Triple') {
                        $hargaroom = $harga[SellingChdTwn];
                        $hargacharge = '0';
                    }
                    echo "$data[RoomType]";
                } else if ($data[Gender] == 'INFANT' and $data[Package] == 'Tour') {
                    $hargaroom = $harga[SellingInfant];
                    $hargacharge = '0';
                    echo "No Bed";
                } else if ($data[Gender] == 'ADULT' and $data[Package] == 'L.A Only') {
                    if ($data[RoomType] == 'Twin') {
                        $hargaroom = $harga[LAAdlTwn];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Double') {
                        $hargaroom = $harga[LAAdlTwn];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Single') {
                        $hargaroom = $harga[LAAdlTwn];
                        $hargacharge = $harga[SingleSell];
                    }
                    if ($data[RoomType] == 'Triple') {
                        $hargaroom = $harga[LAAdlTwn];
                        $hargacharge = '0';
                    }
                    echo "$data[RoomType]";
                } else if ($data[Gender] == 'CHILD' and $data[Package] == 'L.A Only') {
                    if ($data[RoomType] == 'Twin') {
                        $hargaroom = $harga[LAChdTwn];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Double') {
                        $hargaroom = $harga[LAChdTwn];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Xtra Bed') {
                        $hargaroom = $harga[LAChdXbed];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'No Bed') {
                        $hargaroom = $harga[LAChdNbed];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Single') {
                        echo "selected";
                        $hargaroom = $harga[LAChdTwn];
                        $hargacharge = $harga[SingleSell];
                    }
                    if ($data[RoomType] == 'Triple') {
                        $hargaroom = $harga[LAChdTwn];
                        $hargacharge = '0';
                    }
                    echo "$data[RoomType]";
                } else if ($data[Gender] == 'INFANT' and $data[Package] == 'L.A Only') {
                    $hargaroom = $harga[LAInfant];
                    $hargacharge = '0';
                    echo "No Bed";
                }
            }
            if ($r[StatusPrice] == 'LOCK') {
                $hargaroom = $data[Price];
            } else {
                $hargaroom = $hargaroom;
            }
            $subtotal1 = $hargaroom + $hargacharge;
            $subtotalnya = $subtotal1 - $data[Discount];
            echo " <input type='hidden' name='selectroom$no' value='$data[RoomType]'</td>    
          <input type='hidden' name='harga$no' size='10' value=" . number_format($hargaroom, 2, ',', '.');
            echo " style='text-align: right;border: 0px solid #000000;' readonly>
          <input type='hidden' name='add$no' size='10' value=" . number_format($hargacharge, 2, ',', '.');
            echo " style='text-align: right;border: 0px solid #000000;' readonly> 
          <input type='hidden' name='disc$no' value=" . number_format($data[Discount], 2, ',', '.');
            echo " size='7' style='text-align: right;border: 0px solid #000000;' readonly>
          <input type='hidden' name='total$no' value=" . number_format($subtotalnya, 2, ',', '.');
            echo " size='11' style='text-align: right;border: 0px solid #000000;' readonly>
          <td>$data[Deviasi]</td>
          </tr>";
            $totalseluruh = $totalseluruh + $subtotalnya;
            $no++;
        }
        $bawah = mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE BookingID = '$_GET[code]'
                                And Status <> 'CANCEL'
                                AND Package <> 'L.A Only'
                                ORDER BY RoomNo ASC,IDDetail ASC ");
        $banyak = mysql_num_rows($bawah);
        $airseatax = $curawal[TaxInsSell] + $curawal[SeaTaxSell];
        $totairtax = $airseatax * $banyak;
        $totsblmppn = $totairtax + $totalseluruh;
        $ppntot = $totsblmppn * 1 / 100;
        $totbayar = $totsblmppn + $ppntot;
        $sisabayar = $totbayar - $r[DepositAmount];
        $totairjkt = $curawal[AirTaxSell] * $banyak;
        $totvisa = $curawal[VisaSell] * $banyak;
        $totvisa2 = $curawal[VisaSell2] * $banyak;
        //cek name pax and no pass
        $cekpax = mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_GET[code]' and (PaxName = '' or PassportNo = '') and Status <> 'CANCEL'");
        $paxok = mysql_num_rows($cekpax);
        echo "<input type='hidden' name='banyak' value='$banyak'><input type='hidden' name='jumtotal' value='$totalseluruh'> 
          <input type='hidden' value=" . number_format($totairtax, 2, ',', '.');
        echo " size='11' style='text-align: right;border: 0px solid #000000;' readonly><br><input type='hidden' value='(" . number_format($airseatax, 2, '.', '.');
        echo " x $banyak)' size='14' style='text-align: right;border: 0px solid #000000;font-size:8' readonly></font>
          <input type='hidden'   value=" . number_format($totsblmppn, 2, ',', '.');
        echo " size='11' style='text-align: right;border: 0px solid #000000;' readonly>
          <input type='hidden'  value=" . number_format($ppntot, 2, ',', '.');
        echo " size='11' style='text-align: right;border: 0px solid #000000;' readonly>
          <input type='hidden'  value=" . number_format($totbayar, 2, ',', '.');
        echo " size='9' style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly>
          <tr style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'></td></tr>
          <tr><td colspan=2>Deposit </td><td><center>$r[DepositCurr]</center></td><td colspan=2><input type='text'  value=" . number_format($r[DepositAmount], 2, ',', '.');
        echo " size='11' style='text-align: right;border: 0px solid #000000;' readonly> </td><td colspan=3>Deposit No : $r[DepositNo] ($r[DepositDate])</td></tr>   
          </table>";
        $qdev = mysql_query("SELECT tour_devbooking.DevNo,tour_devbooking.Ticket1,tour_devbooking.Ticket2,tour_devbooking.Ticket3,tour_devbooking.Others1,tour_devbooking.Others2,tour_devbooking.Others3,tour_devbooking.Result,tour_devbookingdetail.Title,tour_devbookingdetail.PaxName FROM tour_devbooking 
                                left join tour_devbookingdetail on tour_devbooking.DevNo = tour_devbookingdetail.DevNo
                                WHERE tour_devbooking.BookingID = '$getcode'
                                and tour_devbooking.Status='CONFIRM' order by tour_devbooking.DevNo ASC");
        $numdev = mysql_num_rows($qdev);
        if ($numdev > 0) {
            echo "<table>
          <tr><th>no</th><th width=200>Pax Name</th><th width=90>Deviasi No</th><th width=220>ticket</th><th width=220>others</th></tr>";
            $no = 1;
            while ($isidev = mysql_fetch_array($qdev)) {
                $re = $isidev[Result];
                $res1 = "Ticket" . $re;
                $res2 = "Others" . $re;
                echo "<tr><td>$no</td><td>$isidev[Title]. $isidev[PaxName]</td><td>$isidev[DevNo]</td><td>$isidev[$res1]</td><td>$isidev[$res2]</td></tr>";
                $no++;
            }
            echo "</table>";
        }
        echo "<table style='border: 0px solid #000000;'>
          <tr><td width=790 style='border: 0px solid #000000;'><b>REMARKS</b></td></tr>
          <tr><td>$r[OperationNote]</td></tr>
          <tr style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'>$Promo</td></tr></table>  
          <br>";
        if ($curawal[DateTravelFrom] > $skrg) {
            if ($r[TBFNo] <> '') {
                echo "<input type='submit' value='REVISE TBF' onClick=location.href='tbf.php?act=revisetbf&code=$_GET[code]'>";
            } else {
                if ($curawal[StatusProduct] == 'FINALIZE') {
                    $cant = "disabled";
                } else {
                    $cant = "enabled";
                }
                /*if($r[FBTNo] <> '' ){
                  echo"<input type='submit' value='CREATE TBF' onClick=location.href='tbf.php?act=savetbf&code=$_GET[code]' disabled>";
                }else {*/
                echo "<input type='submit' name='submit' value='CREATE TBF' onClick='return ngecek($paxok,$_GET[code])' $cant>";
                //}
            }
        }
        echo " </form>
          <br><br>
          ";
        break;

    case "savetbf":
        $today = date("Y-m-d G:i:s", time());
        $edit = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_POST[getcode]'");
        $r = mysql_fetch_array($edit);
        $editr = mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_POST[getcode]'");
        $s = mysql_fetch_array($editr);
        $awal = mysql_query("SELECT * FROM tour_msproduct left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode WHERE IDProduct = '$r[IDTourcode]'");
        $curawal = mysql_fetch_array($awal);
        $hari = date("Y", time());
        $bookid = $_GET[code];
        $tampil = mysql_query("SELECT * FROM tour_tbfbooking where OfficeKey = '$r[OfficeKey]'
                            ORDER BY IDTbf DESC limit 1");
        $hasil = mysql_fetch_array($tampil);
        $jumlah = mysql_num_rows($tampil);
        //$tahun = substr($hasil[TBFNo],3,4);

        if ($jumlah > 0) {
            if (strlen($r[OfficeKey]) == 2) {
                $tiket = substr($hasil[TBFNo], 6, 7) + 1;
            } elseif (strlen($r[OfficeKey]) == 3) {
                $tiket = substr($hasil[TBFNo], 7, 7) + 1;
            }
            switch ($tiket) {
                case ($tiket < 10):
                    $tiket1 = "000000" . $tiket;
                    break;
                case ($tiket > 9 && $tiket < 100):
                    $tiket1 = "00000" . $tiket;
                    break;
                case ($tiket > 99 && $tiket < 1000):
                    $tiket1 = "0000" . $tiket;
                    break;
                case ($tiket > 999 && $tiket < 10000):
                    $tiket1 = "000" . $tiket;
                    break;
                case ($tiket > 9999 && $tiket < 100000):
                    $tiket1 = "00" . $tiket;
                    break;
                case ($tiket > 99999 && $tiket < 1000000):
                    $tiket1 = "0" . $tiket;
                    break;
            }
        } else {
            //$tahun1 = $hari;
            $tiket1 = "0000001";
        }
        $mencari = mysql_query("SELECT * FROM tour_tbfbooking WHERE TBFNo = 'TBF$r[OfficeKey]-$tiket1' ");
        $dapet = mysql_num_rows($mencari);
        $rev = mysql_fetch_array($mencari);
        if ($dapet == 0) {
            mysql_query("UPDATE tour_msbooking SET TBFNo = 'TBF$r[OfficeKey]-$tiket1.0'
                               WHERE BookingID = '$_POST[getcode]'");
            mysql_query("INSERT INTO tour_tbfbooking(TBFNo,
                                            TBFRevNo,   
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
                                          TBFDate) 
                                VALUES('TBF$r[OfficeKey]-$tiket1',
                                       '0',
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
            $Description = "Create New TBF (TBF$r[OfficeKey]-$tiket1)";
            mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$r[TCName]', 
                                   '$Description', 
                                   '$today')");
            $editr = mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_POST[getcode]'");
            while ($s = mysql_fetch_array($editr)) {
                mysql_query("INSERT INTO tour_tbfbookingdetail( TBFNo,
                                                        TBFRevNo,
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
                                            VALUES ('TBF$r[OfficeKey]-$tiket1',
                                                    '0',
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
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=tbf.php?act=showtbf&TBF=TBF$r[OfficeKey]-$tiket1'>";
        break;

    case "revisetbf":
        $today = date("Y-m-d", time());
        $edit = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_POST[getcode]'");
        $r = mysql_fetch_array($edit);
        $editr = mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_POST[getcode]'");
        $s = mysql_fetch_array($editr);
        $awal = mysql_query("SELECT * FROM tour_msproduct left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode WHERE IDProduct = '$r[IDTourcode]'");
        $curawal = mysql_fetch_array($awal);
        $hari = date("Y", time());
        $bookid = $_GET[code];
        if (strlen($r[TBFNo]) == 15) {
            $notbf = substr($r[TBFNo], 0, 13);
        } elseif (strlen($r[TBFNo]) == 16) {
            $notbf = substr($r[TBFNo], 0, 14);
        }

        $mencari = mysql_query("SELECT * FROM tour_tbfbooking WHERE TBFNo = '$notbf' and Status='REVISE'  ");
        $dapet = mysql_num_rows($mencari);
        $rev = mysql_fetch_array($mencari);
        $revno = $rev[TBFRevNo] + 1;
        if ($dapet <> 0) {
            mysql_query("UPDATE tour_msbooking SET TBFNo = '$notbf.$revno'
                               WHERE BookingID = '$_POST[getcode]'");
            mysql_query("UPDATE tour_tbfbooking SET TBFRevNo = '$revno',Status='ACTIVE',TourCode='$r[TourCode]'
                               WHERE TBFNo = '$notbf' and Status='REVISE' ");
            $editr = mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_POST[getcode]'");
            while ($s = mysql_fetch_array($editr)) {
                mysql_query("INSERT INTO tour_tbfbookingdetail( TBFNo,
                                                        TBFRevNo,
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
                                                        SubTotal,
                                                        Promo,
                                                        Status,
                                                        InfoDeviasi,
                                                        DeviasiNo,
                                                        KuesionerNo) 
                                            VALUES ('$notbf',
                                                    '$revno',
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
                                                    '$s[SubTotal]',
                                                    '$s[Promo]',
                                                    '$s[Status]',
                                                    '$s[InfoDeviasi]',
                                                    '$s[DeviasiNo]',
                                                    '$s[KuesionerNo]')");
            }
            $message .= "\n";
            $message .= "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">" . "\n";
            $message .= "<html>" . "\n";
            $message .= "<head>" . "\n";
            $message .= "</head>" . "\n";
            $message .= '<body bgcolor="#FFFFFF" text="#333333" style="background-color: #FFFFFF; margin-bottom : 0px; margin-left : 0px; margin-top : 0px; margin-right : 0px;">
                    <table style="font-size: 10px; font-family: verdana; color: #ffffff; width: 700px;" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
                    <tbody>
                    <tr>
                    <style type="text/css">
                    body, table, td, p { font-size: 14px; }
                    img { border: 0px; }
                    p { margin: 10px 0px; line-height: 237% }
                    </style>     
                    </tr>
                    <tr>
                      <td colspan="2"style="padding: 40px; color: #333333">
                      <h1>Hai ' . $username . ',</h1>
                            <p style="font-size: 13px; line-height: 237%">Terima Kasih untuk memilih Travelicious sebagai partner berpetualang Anda.</p>
                            <p style="font-size: 13px; line-height: 237%">Pesanan Anda sudah kami terima dengan <strong>Order ID ' . $idlast . '</strong></p>
                            <table style="font-size: 13px; font-family: verdana; color: #333333; width: 600px;" border="0" cellspacing="1" cellpadding="4" align="center" bgcolor="#FFFFFF"> 
                                <tr><td style="background-color: #eee; font-weight: bold;">Keterangan</td>    <td style="background-color: #eee; font-weight: bold;">Jumlah</td>    <td style="background-color: #eee; font-weight: bold; width: 150px;">Subtotal</td></tr>
                                <tr><td style="background-color: #eee;">' . $dealname . '</td>    <td style="background-color: #eee; text-align: center;">' . $qty . '</td>    <td style="background-color: #eee;">Rp ' . $price . '</td></tr>
                                <tr><td style="background-color: #eee;">Kode Pembayaran</td>    <td style="background-color: #eee;"></td>    <td style="background-color: #eee;">' . $nmr . '</td></tr>
                                <tr><td colspan="2" style="background-color: #eee; font-size: 16px;"><strong>Yang Harus Dibayarkan</strong></td>    <td style="background-color: #eee; font-size: 16px; text-align: right;"><strong>Rp ' . number_format(($ttlprice + $nmr), 2, ',', '.') . '</strong></td></tr>
                            </table>     
                      </td>
                    </tr>
                    <tr>
                      <td><a href="http://www.twitter.com/traveliciousid"><img src="http://www.travelicious.co.id/themes/tmplt/twtr.jpg" ></a></td><td><a href="http://www.facebook.com/TraveliciousID"><img src="http://www.travelicious.co.id/themes/tmplt/fb.jpg" /></a></td>
                    </tr>
                    
                  </tbody>
                </table>
                <p><small>Email ini dikirim oleh .</small></p>
                </body>';
            $message .= "</HTML>" . "\n";
            $message .= "\n";
            $email = "versus_f2000@yahoo.com";
            $approver = $_POST['approval'];
            $dat = mysql_query("SELECT * FROM tbl_corporateemployee WHERE CorporateEmployeeID='$approver' ");
            $d = mysql_fetch_array($dat);
            $activate = md5($email);
            $kepada = $_POST['approval'];
            //$to = "$kepada" ;
            $to = $email;
            $subject = "Revision TBF Request from $peminta ";
            // $message ="Click on this link below for response your approval \r\n";
            $headers = "MIME-Version: 1.0 \n";
            $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
            $headers .= "From: LTM SITE <no-reply@panorama-tours.com> \n";
            $headers .= "X-Mailer: PHP/" . phpversion();
            // mail($to, $subject, $message, $headers);
        }
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=tbf.php?act=showtbf&TBF=$notbf&rev=$revno'>";
        break;

    case "showtbf":
        $sedit = mysql_query("SELECT * FROM tour_tbfbooking WHERE TBFNo = '$_GET[TBF]'");
        $sr = mysql_fetch_array($sedit);
        $qbuk = mysql_query("SELECT * FROM tour_msbooking left join tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode WHERE BookingID = '$sr[BookingID]'");
        $buk = mysql_fetch_array($qbuk);
        if ($_GET[rev] == '') {
            $seditr = mysql_query("SELECT * FROM tour_tbfbookingdetail WHERE TBFNo = '$_GET[TBF]' and TBFRevNo='$sr[TBFRevNo]'");
        } else {
            $seditr = mysql_query("SELECT * FROM tour_tbfbookingdetail WHERE TBFNo = '$_GET[TBF]' and TBFRevNo='$_GET[rev]' ");
        }
        $ss = mysql_fetch_array($seditr);                //               <img src='images/pano1.jpg'>
        $tbfdate = date("d M Y", strtotime($sr[TBFDate]));
        $depdet = date("d M Y", strtotime($sr[DateTravelFrom]));
        $datacomp=mysql_query("SELECT * FROM tbl_mscompany WHERE CompanyID = '$compid'");
        $comp=mysql_fetch_array($datacomp);
        echo "<center>
          <table style='border: 0px solid #000000;'>
          <tr><td width=450 style='border: 0px solid #000000;'><img src='$comp[Logo]'></td><td style='border: 0px solid #000000;' colspan=2><br><font size=5><b>TEMPLATE BOOKING FORM</b></font></td></tr>
          <tr><td rowspan=4 width=200 style='border: 0px solid #000000;'><font size=1>$comp[CompanyName]<br>$tampiluser[divAddress]<br>
          Ph : $tampiluser[divPhone] (H) Fax: $tampiluser[divFax]<br>
          E-mail: $tampiluser[divEmail]<br>
          $comp[Website]</font></td><td style='border: 0px solid #000000;' colspan=2><font size=3><b>$sr[TBFNo].$sr[TBFRevNo]</b></font></td></tr>  
          <tr><td style='border: 0px solid #000000;' colspan=2>Attn : $sr[BookersName]</td></tr>
          <tr><td style='border: 0px solid #000000;' colspan=2>$sr[BookersAddress]</td></tr>
          <tr><td style='border: 0px solid #000000;' colspan=2>( $sr[BookersTelp] / $sr[BookersMobile] )</td></tr>
          <tr><td style='border: 0px solid #000000;'>TC Name/Counter : $sr[TCName] - $sr[TCDivision]</td><td style='border: 0px solid #000000;' width=100>Tour</td><td style='border: 0px solid #000000;' width=230>: $sr[TourCode] ($sr[ProductCode])</td></tr> 
          <tr><td style='border: 0px solid #000000;'>Date : $tbfdate </td><td style='border: 0px solid #000000;'>Departure Date</td><td style='border: 0px solid #000000;'>: $depdet </td></tr>
          <tr></tr>                                              
          </table>      
          <table style='border: 0px solid #000000;'>
          <tr><td width=800 style='border: 0px solid #000000;'>Booking ID : $sr[BookingID]</td></tr>                                                             
          </table>";
        if ($_GET[rev] == '') {
            $tampil = mysql_query("SELECT * FROM tour_tbfbookingdetail   
                                WHERE TBFNo = '$_GET[TBF]'  
                                AND TBFRevNo = '$sr[TBFRevNo]'
                                And Status <> 'CANCEL'
                                ORDER BY RoomNo ASC,IDDetail ASC ");
        } else {
            $tampil = mysql_query("SELECT * FROM tour_tbfbookingdetail   
                                WHERE TBFNo = '$_GET[TBF]'
                                AND TBFRevNo = '$_GET[rev]'
                                And Status <> 'CANCEL'
                                ORDER BY RoomNo ASC,IDDetail ASC ");
        }
        if ($buk[GroupType] == 'CRUISE') {
            $rtype = 'TYPE';
        } else {
            $rtype = 'ROOM TYPE';
        }
        echo " <table style='border: 0px solid #000000;'>
          <tr><th BGCOLOR='#f48221'>No</th><th BGCOLOR='#f48221' width=200>PAX Name</th><th BGCOLOR='#f48221' width=40>Type</th><th BGCOLOR='#f48221' width=70>Passport</th><th BGCOLOR='#f48221'>Package</th><th BGCOLOR='#f48221' width=65>$rtype</th><th BGCOLOR='#f48221' width=290>Special request</th></tr>";
        $no = $posisi + 1;
        $banyak = mysql_num_rows($tampil);
        while ($data = mysql_fetch_array($tampil)) {
            $vch = mysql_query("SELECT * FROM `tour_voucherpromo` WHERE `VoucherNo` = '$data[VoucherNo]' and `VoucherStatus`='APPROVE'");
            $vchok = mysql_num_rows($vch);
            if ($data[PaxName] == '') {
                $namapax = '<center>TBA</center>';
            } else {
                $namapax = $data[Title] . '. ' . $data[PaxName];
            }
            if ($data[Promo] <> '' AND $vchok > 0) {
                $bintang = "<font color=red>*</font>";
                $Promo = "<font size=1><i>* $data[Promo]</i></font>";
            } else {
                $bintang = "";
            }
            echo " <tr><td>$no <input type='hidden' name='iddetail$no' value='$data[IDDetail]'><input type='hidden' name='getcode' value='$getcode'> </td>   
          <td>$namapax $bintang</td>   
          <td><center>$data[Gender]</td>
          <td><center>$data[PassportNo]</td> 
          <td><center>";
            if ($data[Gender] == 'INFANT') {
            } else {
                echo "$data[Package]";
            }
            echo "</td>";
            $cadltwn = mysql_query("SELECT * FROM tour_msproduct   
                                        WHERE IDProduct = '$r[IDTourcode]' and Status <> 'VOID'");
            $harga = mysql_fetch_array($cadltwn);
            echo " <td><center>";
            if ($buk[GroupType] == 'CRUISE') {
                if ($data[Gender] == 'ADULT' and $data[Package] == 'Tour') {
                    if ($data[RoomType] == '12 Pax') {
                        $hargaroom = $harga[CruiseAdl12];
                        $hargacharge = '0';
                        $tipe = '1-2 PAX';
                    }
                    if ($data[RoomType] == '34 Pax') {
                        $hargaroom = $harga[CruiseAdl34];
                        $hargacharge = '0';
                        $tipe = '3-4 PAX';
                    }
                    if ($data[RoomType] == '1 Pax') {
                        $hargaroom = $harga[CruiseAdl12];
                        $hargacharge = $harga[SingleSell];
                        $tipe = 'Single';
                    }
                    echo "$tipe";
                } else if ($data[Gender] == 'CHILD' and $data[Package] == 'Tour') {
                    if ($data[RoomType] == '12 Pax') {
                        $hargaroom = $harga[CruiseChd12];
                        $hargacharge = '0';
                        $tipe = '1-2 PAX';
                    }
                    if ($data[RoomType] == '34 Pax') {
                        $hargaroom = $harga[CruiseChd34];
                        $hargacharge = '0';
                        $tipe = '3-4 PAX';
                    }
                    if ($data[RoomType] == '1 Pax') {
                        $hargaroom = $harga[CruiseChd12];
                        $hargacharge = $harga[SingleSell];
                        $tipe = 'Single';
                    }
                    echo "$tipe";
                } else if ($data[Gender] == 'INFANT' and $data[Package] == 'Tour') {
                    $hargaroom = $harga[SellingInfant];
                    $hargacharge = '0';
                    echo "No Bed";
                } else if ($data[Gender] == 'ADULT' and $data[Package] == 'L.A Only') {
                    if ($data[RoomType] == '12 Pax') {
                        $hargaroom = $harga[CruiseLoAdl12];
                        $hargacharge = '0';
                        $tipe = '1-2 PAX';
                    }
                    if ($data[RoomType] == '34 Pax') {
                        $hargaroom = $harga[CruiseLoAdl34];
                        $hargacharge = '0';
                        $tipe = '3-4 PAX';
                    }
                    if ($data[RoomType] == '1 Pax') {
                        $hargaroom = $harga[CruiseLoAdl12];
                        $hargacharge = $harga[SingleSell];
                        $tipe = 'Single';
                    }
                    echo "$tipe";
                } else if ($data[Gender] == 'CHILD' and $data[Package] == 'L.A Only') {
                    if ($data[RoomType] == '12 Pax') {
                        $hargaroom = $harga[CruiseLoChd12];
                        $hargacharge = '0';
                        $tipe = '1-2 PAX';
                    }
                    if ($data[RoomType] == '34 Pax') {
                        $hargaroom = $harga[CruiseloChd34];
                        $hargacharge = '0';
                        $tipe = '3-4 PAX';
                    }
                    if ($data[RoomType] == '1 Pax') {
                        $hargaroom = $harga[CruiseLoChd12];
                        $hargacharge = $harga[SingleSell];
                        $tipe = 'Single';
                    }
                    echo "$tipe";
                } else if ($data[Gender] == 'INFANT' and $data[Package] == 'L.A Only') {
                    $hargaroom = $harga[LAInfant];
                    $hargacharge = '0';
                    echo "No Bed";
                }
            } else {
                if ($data[Gender] == 'ADULT' and $data[Package] == 'Tour') {
                    if ($data[RoomType] == 'Twin') {
                        $hargaroom = $harga[SellingAdlTwn];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Double') {
                        $hargaroom = $harga[SellingAdlTwn];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Single') {
                        $hargaroom = $harga[SellingAdlTwn];
                        $hargacharge = $harga[SingleSell];
                    }
                    if ($data[RoomType] == 'Triple') {
                        $hargaroom = $harga[SellingAdlTwn];
                        $hargacharge = '0';
                    }
                    echo "$data[RoomType]";
                } else if ($data[Gender] == 'CHILD' and $data[Package] == 'Tour') {
                    if ($data[RoomType] == 'Twin') {
                        $hargaroom = $harga[SellingChdTwn];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Double') {
                        $hargaroom = $harga[SellingChdTwn];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Xtra Bed') {
                        $hargaroom = $harga[SellingChdXbed];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'No Bed') {
                        $hargaroom = $harga[SellingChdNbed];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Single') {
                        $hargaroom = $harga[SellingChdTwn];
                        $hargacharge = $harga[SingleSell];
                    }
                    if ($data[RoomType] == 'Triple') {
                        $hargaroom = $harga[SellingChdTwn];
                        $hargacharge = '0';
                    }
                    echo "$data[RoomType]";
                } else if ($data[Gender] == 'INFANT' and $data[Package] == 'Tour') {
                    $hargaroom = $harga[SellingInfant];
                    $hargacharge = '0';
                    echo "No Bed";
                } else if ($data[Gender] == 'ADULT' and $data[Package] == 'L.A Only') {
                    if ($data[RoomType] == 'Twin') {
                        $hargaroom = $harga[LAAdlTwn];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Double') {
                        $hargaroom = $harga[LAAdlTwn];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Single') {
                        $hargaroom = $harga[LAAdlTwn];
                        $hargacharge = $harga[SingleSell];
                    }
                    if ($data[RoomType] == 'Triple') {
                        $hargaroom = $harga[LAAdlTwn];
                        $hargacharge = '0';
                    }
                    echo "$data[RoomType]";
                } else if ($data[Gender] == 'CHILD' and $data[Package] == 'L.A Only') {
                    if ($data[RoomType] == 'Twin') {
                        $hargaroom = $harga[LAChdTwn];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Double') {
                        $hargaroom = $harga[LAChdTwn];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Xtra Bed') {
                        $hargaroom = $harga[LAChdXbed];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'No Bed') {
                        $hargaroom = $harga[LAChdNbed];
                        $hargacharge = '0';
                    }
                    if ($data[RoomType] == 'Single') {
                        echo "selected";
                        $hargaroom = $harga[LAChdTwn];
                        $hargacharge = $harga[SingleSell];
                    }
                    if ($data[RoomType] == 'Triple') {
                        $hargaroom = $harga[LAChdTwn];
                        $hargacharge = '0';
                    }
                    echo "$data[RoomType]";
                } else if ($data[Gender] == 'INFANT' and $data[Package] == 'L.A Only') {
                    $hargaroom = $harga[LAInfant];
                    $hargacharge = '0';
                    echo "No Bed";
                }
            }
            if ($r[StatusPrice] == 'LOCK') {
                $hargaroom = $data[Price];
            } else {
                $hargaroom = $hargaroom;
            }
            $subtotal1 = $hargaroom + $hargacharge;
            $subtotalnya = $subtotal1 - $data[Discount];
            echo " <input type='hidden' name='selectroom$no' value='$data[RoomType]'</td>    
          <input type='hidden' name='harga$no' size='10' value=" . number_format($hargaroom, 2, ',', '.');
            echo " style='text-align: right;border: 0px solid #000000;' readonly>
          <input type='hidden' name='add$no' size='10' value=" . number_format($hargacharge, 2, ',', '.');
            echo " style='text-align: right;border: 0px solid #000000;' readonly> 
          <input type='hidden' name='disc$no' value=" . number_format($data[Discount], 2, ',', '.');
            echo " size='7' style='text-align: right;border: 0px solid #000000;' readonly>
          <input type='hidden' name='total$no' value=" . number_format($subtotalnya, 2, ',', '.');
            echo " size='11' style='text-align: right;border: 0px solid #000000;' readonly>
          <td>$data[Deviasi]</td>
          </tr>";
            $totalseluruh = $totalseluruh + $subtotalnya;
            $no++;
        }
        $bawah = mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE BookingID = '$_GET[code]'
                                And Status <> 'CANCEL'
                                AND Package <> 'L.A Only'
                                ORDER BY IDDetail ASC ");
        $banyak = mysql_num_rows($bawah);
        $totairtax = $curawal[TaxInsSell] * $banyak;
        $totsblmppn = $totairtax + $totalseluruh;
        $ppntot = $totsblmppn * 1 / 100;
        $totbayar = $totsblmppn + $ppntot;
        $sisabayar = $totbayar - $r[DepositAmount];
        $totairjkt = $curawal[AirTaxSell] * $banyak;
        $totvisa = $curawal[VisaSell] * $banyak;
        $totvisa2 = $curawal[VisaSell2] * $banyak;
        //cek name pax and no pass
        $cekpax = mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_GET[code]' and (PaxName = '' or PassportNo = '') ");
        $paxok = mysql_num_rows($cekpax);
        echo "<input type='hidden' name='banyak' value='$banyak'><input type='hidden' name='jumtotal' value='$totalseluruh'> 
          <input type='hidden' value=" . number_format($totairtax, 2, ',', '.');
        echo " size='11' style='text-align: right;border: 0px solid #000000;' readonly><br><input type='hidden' value='(" . number_format($curawal[TaxInsSell], 2, '.', '.');
        echo " x $banyak)' size='14' style='text-align: right;border: 0px solid #000000;font-size:8' readonly></font>
          <input type='hidden'   value=" . number_format($totsblmppn, 2, ',', '.');
        echo " size='11' style='text-align: right;border: 0px solid #000000;' readonly>
          <input type='hidden'  value=" . number_format($ppntot, 2, ',', '.');
        echo " size='11' style='text-align: right;border: 0px solid #000000;' readonly>
          <input type='hidden'  value=" . number_format($totbayar, 2, ',', '.');
        echo " size='9' style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly>
          <tr style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'></td></tr>
          <tr><td colspan=2>Deposit </td><td><center>$sr[DepositCurr]</center></td><td colspan=2><input type='text'  value=" . number_format($sr[DepositAmount], 2, ',', '.');
        echo " size='11' style='text-align: right;border: 0px solid #000000;' readonly> </td><td colspan=3>Deposit No : $sr[DepositNo] ($sr[DepositDate])</td></tr>   
          </table>";
        $qdev = mysql_query("SELECT tour_devbooking.DevNo,tour_devbooking.Ticket1,tour_devbooking.Ticket2,tour_devbooking.Ticket3,tour_devbooking.Others1,tour_devbooking.Others2,tour_devbooking.Others3,tour_devbooking.Result,tour_devbookingdetail.Title,tour_devbookingdetail.PaxName FROM tour_devbooking 
                                left join tour_devbookingdetail on tour_devbooking.DevNo = tour_devbookingdetail.DevNo
                                WHERE tour_devbooking.BookingID = '$getcode'
                                and tour_devbooking.Status='CONFIRM' order by tour_devbooking.DevNo ASC");
        $numdev = mysql_num_rows($qdev);
        if ($numdev > 0) {
            echo "<table>
          <tr><th>no</th><th width=200>Pax Name</th><th width=90>Deviasi No</th><th width=220>ticket</th><th width=220>others</th></tr>";
            $no = 1;
            while ($isidev = mysql_fetch_array($qdev)) {
                $re = $isidev[Result];
                $res1 = "Ticket" . $re;
                $res2 = "Others" . $re;
                echo "<tr><td>$no</td><td>$isidev[Title]. $isidev[PaxName]</td><td>$isidev[DevNo]</td><td>$isidev[$res1]</td><td>$isidev[$res2]</td></tr>";
                $no++;
            }
            echo "</table>";
        }
        echo "<table style='border: 0px solid #000000;'>
          <tr><td width=790 style='border: 0px solid #000000;'><b>REMARKS</b></td></tr>
          <tr><td>$sr[OperationNote]</td></tr>
          <tr style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'>$Promo</td></tr></table>
          <iframe src='tbfprint.php?act=showtbf&TBF=$_GET[TBF]' name='tbfprint' style='visibility: hidden' height='0' width='0' frameborder='0'>
          </iframe>
          <input type='button' value='PRINT' onClick=frames['tbfprint'].print() >
          <br><br><br>
          ";
        break;

}
?> <?php 
      
?>
</body>
</html>
<script>
    window.opener.location.reload();
</script>