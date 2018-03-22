<html>
<head>
<title>Detail Booking Tour</title>
<link href="../config/print.css" rel="stylesheet" type="text/css" /> 
</head>
<?php 
include "../config/koneksi.php";
include "../config/fungsi_an.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

?>
<body>
<?php 	  $edit=mysql_query("SELECT * FROM tour_fbtbooking WHERE FBTNo = '$_GET[code]'");
          $r=mysql_fetch_array($edit);     
          $qbuk=mysql_query("SELECT * FROM tour_msbooking left join tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode WHERE BookingID = '$r[BookingID]'");
          $buk=mysql_fetch_array($qbuk);
          $thisyear = date("Y");
          $nextyear = $thisyear+1;
          if($r[Status]=='VOID'){$status="-$r[Status]-";}else {$status='';}
    echo "<center>
          <table style='border: 0px solid #000000;'>
          <tr><td style='border: 0px solid #000000;'></td><td width='200' style='border: 0px solid #000000;' colspan=2><br><font size=5><b>APPENDIX</b></font></td></tr>
          <tr><td width=600 style='border: 0px solid #000000;'><b>Booking ID : $r[BookingID]</b></td><td style='border: 0px solid #000000;' colspan=2><font size=3><b>$r[FBTNo] $status</b></font></td></tr>
                                                        
          </table> ";
          
          if($r[PrintDetail]=='1'){
          echo"
          <table style='border: 0px solid #000000;'>
          <tr><td width=800 style='border: 0px solid #000000;'><font size=3><b><i>- DUPLICATE -</i></b></font></td></tr>
          </table>";
          }   
          $tampil=mysql_query("SELECT * FROM tour_fbtbookingdetail   
                                WHERE FBTNo = '$_GET[code]'
                                And Status <> 'CANCEL'
                                ORDER BY RoomNo ASC,IDDetail ASC ");
          if($buk[GroupType]=='CRUISE'){$rtype='TYPE';}else{$rtype='ROOM TYPE';}
    echo" <font size='2' color='red'>*<i>all price in $r[SellingCurr] exclude tax and vat</i></font>
          <table style='border: 0px solid #000000;'>
          <tr><th BGCOLOR='#f48221'>No</th><th BGCOLOR='#f48221' width=200>Pax Name</th><th BGCOLOR='#f48221' width=40>Type</th><th BGCOLOR='#f48221' width=70>Passport</th><th BGCOLOR='#f48221'>Package</th><th BGCOLOR='#f48221' width=65>$rtype</th><th BGCOLOR='#f48221'>Price</th><th BGCOLOR='#f48221'>Sgl SUPPLEMENT</th><th BGCOLOR='#f48221'>Disc</th><th BGCOLOR='#f48221'>Disc Exh</th><th BGCOLOR='#f48221'>Total</th></tr>";
          $no=$posisi+1;
          $banyak=mysql_num_rows($tampil);
          while ($data=mysql_fetch_array($tampil)){
          if($data[PaxName]==''){$namapax='<center>TBA</center>';}else{$namapax=$data[Title].'. '.$data[PaxName];}
          if($data[Promo]<>''){$bintang="<font color=red>*</font>";$Promo="<font size=1><i>* $data[Promo]</i></font>";}else{$bintang="";}
    echo" <tr><td>$no <input type='hidden' name='iddetail$no' value='$data[IDDetail]'> </td>   
          <td>$namapax $bintang</td>   
          <td><center>$data[Gender]</td>
          <td><center>$data[PassportNo]</td> 
          <td><center>";if($data[Gender]=='INFANT'){}else{echo"$data[Package]";}echo"</td>";
          $cadltwn=mysql_query("SELECT * FROM tour_msproduct   
                                        WHERE IDProduct = '$r[IDTourcode]'");
          $harga=mysql_fetch_array($cadltwn);
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
          <td><input type=text name='harga$no' size='11' value=".number_format($data[Price], 2, ',', '.');echo" style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type=text name='add$no' size='10' value=".number_format($data[AddCharge], 2, ',', '.');echo" style='text-align: right;border: 0px solid #000000;' readonly></td> 
          <td><input type=text name='disc$no' value=".number_format($data[Discount], 2, ',', '.');echo" size='7' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type=text name='adddisc$no' value=".number_format($data[AddDiscount], 2, ',', '.');echo" size='7' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type=text name='total$no' value=".number_format($data[SubTotal], 2, ',', '.');echo" size='11' style='text-align: right;border: 0px solid #000000;' readonly></td>
          </tr>";
          $no++;
          }      
    echo "<tr style='border: 0px solid #000000;'><td style='border: 0px solid #000000;' colspan='11'>$Promo</td></tr></table><br><br>
          ";
?> <?php 
      
?>
</body>
</html>
<script>
	window.opener.location.reload();
</script>