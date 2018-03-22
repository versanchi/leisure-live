<script type="text/javascript"> 
function generateexcel(tableid) {
  var table= document.getElementById(tableid);
  var html = table.outerHTML;  
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));    
}  
</script>


<?php 
switch($_GET[act]){
  // Tampil Office
   default:
    $blnini = date("m");
    $thnini = date("Y");
    $mont=$_GET['bulan'];
    $yer=$_GET['year'];
    $Dest=$_GET['Destination'];
    $GroupType=$_GET['grouptype'];
    if($mont==''){$mont=$blnini;}
    if($yer==''){$yer=$thnini;}
    if($Dest==''){$Dest='ALL';}
    if($GroupType==''){$GroupType='ALL';}
    echo "<h2>Daily Status</h2>
          <form method='get' action='media.php?'><input type=hidden name=module value='dailysummary'> ";       
              echo "Month &nbsp &nbsp &nbsp &nbsp:&nbsp<select name='bulan' >
                      <option value='01'";if($mont=='01'){echo"selected";}echo">JAN</option>
                      <option value='02'";if($mont=='02'){echo"selected";}echo">FEB</option>
                      <option value='03'";if($mont=='03'){echo"selected";}echo">MAR</option>
                      <option value='04'";if($mont=='04'){echo"selected";}echo">APR</option>
                      <option value='05'";if($mont=='05'){echo"selected";}echo">MAY</option>
                      <option value='06'";if($mont=='06'){echo"selected";}echo">JUN</option>
                      <option value='07'";if($mont=='07'){echo"selected";}echo">JUL</option>
                      <option value='08'";if($mont=='08'){echo"selected";}echo">AUG</option>
                      <option value='09'";if($mont=='09'){echo"selected";}echo">SEP</option>
                      <option value='10'";if($mont=='10'){echo"selected";}echo">OCT</option>
                      <option value='11'";if($mont=='11'){echo"selected";}echo">NOV</option>
                      <option value='12'";if($mont=='12'){echo"selected";}echo">DEC</option>
                      </select>
              &nbsp &nbsp Year    :  <select name='year' ><option value='0' >- Select Year -</option>";
            $tampil=mysql_query("SELECT Year FROM tour_msproduct where year <>'' group BY Year asc");
            while($s=mysql_fetch_array($tampil)){  // <input type='button' value='Cek Seat' onclick=ceking() >
               if($yer==$s[Year]){
                    echo "<option value='$s[Year]' selected>$s[Year]</option>";     
                }else { 
                echo "<option value='$s[Year]' >$s[Year]</option>";
                } 
            }
    echo "</select> <br>";
     echo "<br>Destination :  <select name='Destination' id='Destination'>";  
           
            $tampilDest=mysql_query("SELECT distinct Destination FROM  tour_msproduct where destination<>'' and destination<>'0' order by Destination ASC"); 
                              echo "<option value='ALL'>ALL</option>";  
            while($sDest=mysql_fetch_array($tampilDest)){
                if ($Dest==$sDest[Destination]){
                        echo "<option value='$sDest[Destination]' selected>$sDest[Destination]</option>";
                        }
                else {
                        echo "<option value='$sDest[Destination]'>$sDest[Destination]</option>";}
                
            }
    echo "</select>
        Type : <select name='grouptype'><option value='ALL' selected>ALL</option>"; 
    $gr=mysql_query("SELECT * FROM tour_msgroup where Status = 'ACTIVE' order by GroupName asc ");
                while($grp=mysql_fetch_array($gr)){
                     if($GroupType==$grp[GroupName])
                     {
                        echo"<option value='$grp[GroupName]' selected>$grp[GroupName]</option></a></li>";     
                     }else{
                         echo"<option value='$grp[GroupName]'>$grp[GroupName]</option></a></li>"; 
                     }
                        
                } 
    echo "</select> 
              <input type=submit name='submit' size='20'value='View'>
          </form>";
          $oke=$_GET['oke'];
         
         if($mont=='01'){$montText='JAN';}
         if($mont=='02'){$montText='FEB';}
         if($mont=='03'){$montText='MAR';}
         if($mont=='04'){$montText='APR';}
         if($mont=='05'){$montText='MAY';}
         if($mont=='06'){$montText='JUN';}
         if($mont=='07'){$montText='JUL';}
         if($mont=='08'){$montText='AUG';}
         if($mont=='09'){$montText='SEP';}
         if($mont=='10'){$montText='OCT';}
         if($mont=='11'){$montText='NOV';}
          if($mont=='12'){$montText='DEC';}
    
    
    echo "<h><B>UPDATE STATUS $montText - $yer </B></h><br>";                              
    //Mulai Table
    //Query tidak memunculkan tourcode yang kosong dan yang tidak terjual
    if($Dest=='ALL'){
        if($GroupType=='ALL'){
            $QProduct=mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and TourCode<>'' and GroupType<>'TMR' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' order by Destination,GroupType,ProductCode,ProductName,DateTravelFrom asc");
            $QProductTMR=mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and TourCode<>'' and GroupType='TMR' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' order by Destination,ProductCode,ProductName,GroupType,DateTravelFrom asc");
        }else{
            $QProduct=mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and TourCode<>'' and GroupType = '$GroupType' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' order by Destination,GroupType,ProductCode,ProductName,DateTravelFrom asc");
            $QProductTMR=mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and TourCode<>'' and GroupType = '$GroupType' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' order by Destination,ProductCode,ProductName,GroupType,DateTravelFrom asc");
        }
    }
    else{
        if($GroupType=='ALL'){
            $QProduct=mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and Destination='$Dest'  and  TourCode<>'' and GroupType<>'TMR' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' order by Destination,GroupType,ProductCode,ProductName,DateTravelFrom asc");
            $QProductTMR=mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and Destination='$Dest'  and  TourCode<>'' and GroupType='TMR' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' order by Destination,ProductCode,ProductName,GroupType,DateTravelFrom asc");
        }else{
            $QProduct=mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and Destination='$Dest'  and  TourCode<>'' and GroupType = '$GroupType' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' order by Destination,GroupType,ProductCode,ProductName,DateTravelFrom asc");
            $QProductTMR=mysql_query("SELECT * FROM tour_msproduct inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and Destination='$Dest'  and  TourCode<>'' and GroupType = '$GroupType' and (StatusProduct <>'CLOSE'or SeatDeposit >0 ) and status='PUBLISH' order by Destination,ProductCode,ProductName,GroupType,DateTravelFrom asc");
        }
    }
    

    $TotalSeat=0;
    $TotalBooking=0;
    $TotalDum=0;
    
    
    $desbefore='awal';
    $PCbefore='awal';
    $PCbeforeTMR='awal';
    
    $Products=mysql_num_rows($QProduct);
    
      if ($Products > 0){
  
     $TPax=0;
     $TSales=0;
    // Query bukan TMR
     echo" <table id='dailystatus'>";         


    
     while($DProduct=mysql_fetch_array($QProduct)){
                    
                            if($DProduct[ProductFor]=='ALL'){$Dep=$DProduct[Department];}else{$Dep=$DProduct[ProductFor];}     
                    
             if ($desbefore<>$DProduct[Destination]){
    echo "<tr><td colspan=14 style=font-size:15px><b><center>$DProduct[Destination]</center></b></td></tr>
    <tr><th>Tour Name</th><th>Tour Code</th><th>Airlines</th><th>Department</th><th>Departure</th><th>Visa Dateline</th><th> Seat</th><th>Pax</th><th>Available</th><th>LA only</th><th>Price</th><th>Tax</th><th>Status</th><th>Remarks</th></tr>"; 
    $desbefore=$DProduct[Destination];
    $Typebefore='awal';}
    
    if($Typebefore<>$DProduct[GroupType])
    { echo "<tr><td colspan=14; font-size=24px;><strong>$DProduct[GroupType]</strong></td></tr>";
    $Typebefore=$DProduct[GroupType];
	$PCbefore='awal';
    }
                    
                if ($PCbefore<>$DProduct[ProductCode]){
                    $QPC=mysql_query("SELECT * FROM `tour_msproduct` where tour_msproduct.Status <> 'VOID' and tour_msproduct.ProductCode='$DProduct[ProductCode]' and month(DateTravelFrom)='$mont' and  year(DateTravelFrom)='$yer' and TourCode<>'' and Destination='$DProduct[Destination]' and (StatusProduct <>'CLOSE' or SeatDeposit >0) and GroupType='$DProduct[GroupType]' and status='PUBLISH' ");
                    $TPC=mysql_num_rows($QPC);
                    echo"<tr><td rowspan='$TPC'; style=vertical-align:middle><center>$DProduct[ProductName]</td>";
                    $PCbefore=$DProduct[ProductCode];}

        
                $QBookingan=mysql_query("SELECT IDTourCode,sum(if(TCDivision<>'LTM' ,(AdultPax+ChildPax),0)) as pax,sum(if(TCDivision='LTM' ,(AdultPax+ChildPax),0)) as DumPax FROM tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProduct[IDProduct]'  group by IDTourCode");
                
                $Booking=mysql_num_rows($QBookingan);
                $DBooking=mysql_fetch_array($QBookingan);
                
                //LA only
                        $QLA=mysql_query("SELECT * FROM tour_msbookingdetail where Bookingid in( Select Bookingid from tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProduct[IDProduct]') and tour_msbookingdetail.status <>'CANCEL' and Package='L.A Only' ");
                  
                  $BookingLA=mysql_num_rows($QLA);    


                        
                  //xxxxxxxxxxxxxxxxxx
                        
                        //merubah format tampilan ke currency
						if($DProduct[GroupType]=='CRUISE'){$Selling=number_format($DProduct[CruiseAdl12], 0, ',', '.');}else{$Selling=number_format($DProduct[SellingAdlTwn], 0, ',', '.');}
                        $Tax=number_format($DProduct[TaxInsSell], 0, ',', '.');
                        $new_date = substr($DProduct[DateTravelFrom],8,2);
                        $VDL = date('d M Y', strtotime($DProduct[VisaDateline]));
                        if($DProduct[VisaDateline]=='0000-00-00'){$VDL="";}else{$VDL="$VDL";}
                        
                        //pewarnaan row kalau status close            
                        if(($DProduct[StatusProduct]=='CLOSE' OR $DProduct[StatusProduct]=='FINALIZE')){$warna="BGCOLOR='#f5bebe'";}else {$warna="BGCOLOR='#ffffff'";}
                        $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($DProduct['AttachmentFile']) ) ) ); 
                        echo "
                             <td $warna><a href='$DProduct[Attachment]$file' target='_blank' style=text-decoration:none >$DProduct[TourCode]</a></td>
                             <td $warna><center>$DProduct[Flight]</td>
                             <td $warna><center>$Dep</td>
                             <td $warna><center>$new_date $montText</td>
                             <td $warna><center>$VDL</td>
                             <td $warna><center>$DProduct[Seat]</td>     
                             <td style='text-align:right' $warna>";
                             $bookingan=$DBooking[pax]+$DBooking[DumPax];
                             if($bookingan==0){echo"";}else{echo"<a href=?module=group&act=showdeposit&id=$DProduct[IDProduct]>$bookingan</a>";}
                             echo"</td>
                             <td $warna><center>";
                                     if($DBooking[pax]==0 and $DBooking[DumPax]==0 ){echo"$DProduct[Seat]";}else
                                     {$sisa=$DProduct[Seat]-($DBooking[pax]+$DBooking[DumPax]);
                                     echo"$sisa";}
                                     echo"</td> <td style='text-align:right' $warna>";    
                                      if($BookingLA==0){echo"";}else{echo"$BookingLA";}
                            
                                     
                                     echo"</td><td style='text-align:right' $warna>$Selling</td>
                                     <td style='text-align:right' $warna>$Tax</td>
                                     <td $warna><center>$DProduct[StatusProduct]</td>
                                     <td $warna>$DProduct[Remarks]</td>";
                                     $TotalSeat=$TotalSeat+$DProduct[Seat];
                                     $TotalBooking=$TotalBooking+$DBooking[pax]+$DBooking[DumPax];
                                    
                             echo"</tr>";
            };
            
            $TotalSisa=$TotalSeat-($TotalBooking+$TotalDum);
                echo"<tr><td colspan=6><Center><b>Total</td>
                     <td><Center><b>$TotalSeat</td>
                     <td><Center><b>$TotalBooking</td>
                     <td><Center><b>$TotalSisa</td></tr>";
            
    
            
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX            
            //TMR report
             if($Dest=='ALL' and $GroupType=='ALL'){
        
            echo"<tr><td colspan=15></td></tr><tr><td colspan=16; font-size=24px;><h2>TMR</h2></td></tr>";
                 
            //filter destinasi
            
    $TotalSeatTMR=0;
    $TotalBookingTMR=0;
    $TotalDumTMR=0;
            

            echo "<tr><th>Tour Name</th><th>Tour Code</th><th>Airlines</th><th>Department</th><th>Departure</th><th>Visa Dateline</th><th>Seat</th><th>Pax</th><th>Available</th><th>LA only</th><th>Price</th><th>Tax</th><th>Status</th><th width=150 px>Remarks</th></tr>"; 
            
            $ProductsTMR=mysql_num_rows($QProductTMR);
                    
            if ($ProductsTMR > 0){
             
            
             $TPaxTMR=0;
             $TSalesTMR=0;
             
                while($DProductTMR=mysql_fetch_array($QProductTMR)){
                    
                    if($DProductTMR[ProductFor]=='ALL'){$DepTMR=$DProduct[Department];}else{$Dep=$DProductTMR[ProductFor];}     
        
                $QBookinganTMR=mysql_query("SELECT IDTourCode,sum(if(TCDivision<>'LTM' ,(AdultPax+ChildPax),0)) as pax,sum(if(TCDivision='LTM' ,(AdultPax+ChildPax),0)) as DumPax FROM tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProductTMR[IDProduct]'  group by IDTourCode");
                
                $BookingTMR=mysql_num_rows($QBookinganTMR);
                $DBookingTMR=mysql_fetch_array($QBookinganTMR);
                
                
                //LA only
                            $QLATMR=mysql_query("SELECT * FROM tour_msbookingdetail where Bookingid in( Select Bookingid from tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProductTMR[IDProduct]') and tour_msbookingdetail.status <>'CANCEL' and Package='L.A Only'");
                  
                  $BookingLATMR=mysql_num_rows($QLATMR);

                  
                  //xxxxxxxxxxxxxxxxxx
                  
                
                //merubah format tampilan ke currency
                $Selling=number_format($DProductTMR[SellingAdlTwn], 0, ',', '.');
                $Tax=number_format($DProductTMR[TaxInsSell], 0, ',', '.');
                $new_date = substr($DProductTMR[DateTravelFrom],8,2);
                $VDL = date('d m Y', strtotime($DProductTMR[VisaDateline]));
                if($DProductTMR[VisaDateline]=='0000-00-00'){$VDL="";}else{$VDL="$VDL";}
                
                //pewarnaan row kalau status close
                if(($DProductTMR[StatusProduct]=='CLOSE')){$warna="BGCOLOR='#f5bebe'";}else {$warna="BGCOLOR='#ffffff'";}
                 
                echo "
                     <td $warna>$DProductTMR[TourCode]</td>
                     <td $warna>$DProductTMR[TourCode]</td>
                     <td $warna><center>$DProductTMR[Flight]</td>
                     <td $warna><center>$Dep</td>
                     <td $warna><center>$new_date $montText</td>
                     <td $warna><center>$VDL</td>
                     <td $warna><center>$DProductTMR[Seat]</td>
                     
                     <td style='text-align:right' $warna>";
                     $bookinganTMR=$DBookingTMR[pax]+$DBookingTMR[DumPax];
                     if($bookinganTMR==0){echo"";}else{echo"<a href=?module=group&act=showdeposit&id=$DProductTMR[IDProduct]>$bookinganTMR</a>";}
                     
                     echo"</td>
                     <td $warna><center>";
                     if($DBookingTMR[pax]==0 and $DBookingTMR[DumPax]==0 ){echo"$DProductTMR[Seat]";}else
                     {$sisa=$DProductTMR[Seat]-($DBookingTMR[pax]+$DBookingTMR[DumPax]);
                     echo"$sisa";}
                     echo"</td><td style='text-align:right' $warna>";
                     if($BookingLATMR==0){echo"";}else{echo"$BookingLATMR";}
                     
        
                     
                     echo"</td>
                     <td style='text-align:right' $warna>$Selling</td>
                     <td style='text-align:right' $warna>$Tax</td>
                     <td $warna><center>$DProductTMR[StatusProduct]</td>
                     <td $warna>$DProductTMR[Remarks]</td>";
                     $TotalSeatTMR=$TotalSeatTMR+$DProductTMR[Seat];
                     $TotalBookingTMR=$TotalBookingTMR+$DBookingTMR[pax]+$DBookingTMR[DumPax];
                
                     echo"</tr>";
        
            
        
    };
    $TotalSisaTMR=$TotalSeatTMR-($TotalBookingTMR);
        echo"<tr><td colspan=6><Center><b>Total</td>
             <td><Center><b>$TotalSeatTMR</td>
             <td><Center><b>$TotalBookingTMR</td>
             <td><Center><b>$TotalSisaTMR</td></tr>";
    };}             
    echo "</Table><br><center><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('dailystatus')>";
    
    
    
    }
    else
    
    { echo "NO PRODUCT AVAILABLE IN $montText - $yer";
    } 
       
    break;               
}
?>
