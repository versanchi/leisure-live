<?php 
switch($_GET[act]){
  // Tampil Office
   default:
    $blnini = date("m");
    $thnini = date("Y");
    $mont=$_GET['bulan'];
    $yer=$_GET['year'];
	$Div=$_GET['BOSO'];
	$Gtype=$_GET['GroupType'];
    $grup=$_GET['grup']; 
    if($mont==''){$mont=$blnini;}
    if($yer==''){$yer=$thnini;}
    if($Div==''){$Div='ALL';}
	if($Gtype==''){$Gtype='ALL';}
    echo "<h2>Report by Division</h2>
          <form method='get' action='media.php?'><input type=hidden name=module value='rptdivgroup'>        
              Period &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Month <select name='bulan' >
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
              Year <select name='year' ><option value='0' >- Select Year -</option>";
            $tampil=mysql_query("SELECT Year FROM tour_msproduct where year <>'' group BY Year asc");
            while($s=mysql_fetch_array($tampil)){  // <input type='button' value='Cek Seat' onclick=ceking() >
               if($yer==$s[Year]){
                    echo "<option value='$s[Year]' selected>$s[Year]</option>";     
                }else { 
                echo "<option value='$s[Year]' >$s[Year]</option>";
                } 
            }
    echo "</select>";
	echo "<br>Product Type :<select name='GroupType' id='GroupType'>";  
           
			$tampilGtype=mysql_query("SELECT * FROM tour_msgroup order by GroupName ASC"); 
							  echo "<option value='ALL'>ALL</option>";  
            while($sGtype=mysql_fetch_array($tampilGtype)){
				if ($Gtype==$sGtype[GroupName]){
                        echo "<option value='$sGtype[GroupName]' selected>$sGtype[GroupName]</option>";
						}
				else {
						echo "<option value='$sGtype[GroupName]'>$sGtype[GroupName]</option>";}
				
            }
    echo "</select>
	 	  <br>Division &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<select name='BOSO' id='BOSO'>";  
           
			$tampilDiv=mysql_query("SELECT * FROM tbl_msoffice WHERE office_code in (select distinct TCDivision from tour_msbooking) order by office_name ASC"); 
							  echo "<option value='ALL'>ALL</option>";  
            while($sDiv=mysql_fetch_array($tampilDiv)){
				if ($Div==$sDiv[office_code]){
                        echo "<option value='$sDiv[office_code]' selected>$sDiv[office_name]</option>";
						}
				else {
						echo "<option value='$sDiv[office_code]'>$sDiv[office_name]</option>";}
				
            }
    echo "</select>
              <input type=submit name='submit' size='20'value='View'>
          </form>";
          $oke=$_GET['oke'];
		 
		 
		if($mont=='01'){$montText='JAN';}
         elseif($mont=='02'){$montText='FEB';}
		 elseif($mont=='03'){$montText='MAR';}
		 elseif($mont=='04'){$montText='APR';}
		 elseif($mont=='05'){$montText='MAY';}
		 elseif($mont=='06'){$montText='JUN';}
		 elseif($mont=='07'){$montText='JUL';}
		 elseif($mont=='08'){$montText='AUG';}
		 elseif($mont=='09'){$montText='SEP';}
		 elseif($mont=='10'){$montText='OCT';}
		 elseif($mont=='11'){$montText='NOV';}
 		 elseif($mont=='12'){$montText='DES';}
		  
	echo "<h><u>Sales $Div Period $montText - $yer </u></h><br>";
	
	 $Drate=mysql_query("select * from tour_rate where RateYear=$yer" );
     $rate=mysql_fetch_array($Drate);
	                          
    if($Gtype=='ALL'){
	if ($Div=='ALL'){
	//Query tidak memunculkan tourcode yang kosong dan yang tidak terjual
	$Booking=mysql_query("SELECT TCDivision,Destination,SellingCurr,sum(if(GroupType='TMR' and Gender<>'INFANT' ,1,0)) as PaxTMR,sum(if(GroupType <>'TMR' and Gender<>'INFANT' and Department='LEISURE' ,1,0)) as PaxSeries,sum(if(GroupType <>'TMR' and Gender<>'INFANT' and Department<>'LEISURE' ,1,0)) as PaxPMT, count(IDDetail) as Total, sum(if(SellingCurr='USD',(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0)))) as Harga FROM tour_msbookingdetail inner join (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision<>'LTM')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID  group by TCDivision,Destination order by TCDivision");}else
	{
	$Booking=mysql_query("SELECT TCDivision,Destination,SellingCurr,sum(if(GroupType='TMR' and Gender<>'INFANT' ,1,0)) as PaxTMR,sum(if(GroupType <>'TMR' and Gender<>'INFANT' and Department='LEISURE' ,1,0)) as PaxSeries,sum(if(GroupType <>'TMR' and Gender<>'INFANT' and Department<>'LEISURE' ,1,0)) as PaxPMT, count(IDDetail) as Total, sum(if(SellingCurr='USD',(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0)))) as Harga FROM tour_msbookingdetail inner join (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision<>'LTM' and TCDivision='$Div')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID  group by TCDivision,Destination order by TCDivision");}}
	else{
	
	if ($Div=='ALL'){
	//Query tidak memunculkan tourcode yang kosong dan yang tidak terjual
	$Booking=mysql_query("SELECT TCDivision,Destination,SellingCurr,sum(if(GroupType='TMR' and Gender<>'INFANT' ,1,0)) as PaxTMR,sum(if(GroupType <>'TMR' and Gender<>'INFANT' and Department='LEISURE' ,1,0)) as PaxSeries,sum(if(GroupType <>'TMR' and Gender<>'INFANT' and Department<>'LEISURE' ,1,0)) as PaxPMT, count(IDDetail) as Total, sum(if(SellingCurr='USD',(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0)))) as Harga FROM tour_msbookingdetail inner join (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision<>'LTM' and GroupType='$Gtype')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID  group by TCDivision,Destination order by TCDivision");}else
	{
	$Booking=mysql_query("
	SELECT TCDivision,Destination,SellingCurr,sum(if(GroupType='TMR' and Gender<>'INFANT' ,1,0)) as PaxTMR,sum(if(GroupType <>'TMR' and Gender<>'INFANT' and Department='LEISURE' ,1,0)) as PaxSeries,sum(if(GroupType <>'TMR' and Gender<>'INFANT' and Department<>'LEISURE' ,1,0)) as PaxPMT, count(IDDetail) as Total, sum(if(SellingCurr='USD',(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0)))) as Harga FROM tour_msbookingdetail inner join (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision<>'LTM' and GroupType='$Gtype' and TCDivision='$Div')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID  group by TCDivision,Destination order by TCDivision");}
	}
	
	$JumBooking=mysql_num_rows($Booking);
	
	if ($JumBooking > 0){
	 $No=1;
	 $TTMR=0;
	 $TSeries=0;
	 $TPMT=0;
	 $Total=0;
	 $THarga=0;
	 
	 
     echo"<table style='border: 0px solid #000000;'> <tr><td colspan=6; style='border: 0px solid #000000;'><font size='2'> USD 1 = IDR $rate[$montText] ,-</td><td colspan=3; style='border: 0px solid #000000;'><strong>Group type :$Gtype </strong></font>
	 
	 		<tr><th>No</th><th>BOSO</th><th>Destination</th><th>TMR</th><th>Series</th><th>Ministry</th><th>Pax</th><th>Amount</th></tr>"; 
	
		while($DBooking=mysql_fetch_array($Booking)){		
	
		echo "<tr>
			  <td>$No</td>
			 <td>$DBooking[TCDivision]</td>
             <td>$DBooking[Destination]</td>
             <td style='text-align:right'>".number_format($DBooking[PaxTMR], 0, ',', '.');echo"</td>
             <td style='text-align:right'>".number_format($DBooking[PaxSeries], 0, ',', '.');echo"</td>
             <td style='text-align:right'>".number_format($DBooking[PaxPMT], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>";
			 $TampilTotal=number_format($DBooking[Total], 0, ',', '.');
			 if($DBooking[Total]=='0'){echo"$TampilTotal";}else{echo"
           <a href='?module=rptdivgroup&act=dtltourcode&BSO=$DBooking[TCDivision]&Dest=$DBooking[Destination]&Bln=$mont&thn=$yer&GType=$Gtype'>$TampilTotal</a>";}
		   
			 echo "</td>
			 <td style='text-align:right'>".number_format($DBooking[Harga], 0, ',', '.');echo"</td>
			 </tr>";
		$No++;
		$TTMR=$TTMR+$DBooking[PaxTMR];
		$TSeries=$TSeries+$DBooking[PaxSeries];
		$TPMT=$TPMT+$DBooking[PaxPMT];
		$Total=$Total+$DBooking[Total];
		$THarga=$THarga+$DBooking[Harga];
		};
				
	echo "<tr><th colspan=3>Total</th><th>".number_format($TTMR, 0, ',', '.');echo"</th><th>".number_format($TSeries, 0, ',', '.');echo"</th><th>".number_format($TPMT, 0, ',', '.');echo"</th><th>".number_format($Total, 0, ',', '.');echo"</th><th>".number_format($THarga, 0, ',', '.');echo"</th></tr>
	</table>";
	
	} 
	
	else
	
	{ echo "NO TRANSACTION AVAILABLE IN $montText - $yer";
	} 
	   
    break;   
	
	
	case "dtltourcode": 
	
	$mont=$_GET[Bln];
		 if($mont=='01'){$montText='JAN';}
         elseif($mont=='02'){$montText='FEB';}
		 elseif($mont=='03'){$montText='MAR';}
		 elseif($mont=='04'){$montText='APR';}
		 elseif($mont=='05'){$montText='MAY';}
		 elseif($mont=='06'){$montText='JUN';}
		 elseif($mont=='07'){$montText='JUL';}
		 elseif($mont=='08'){$montText='AUG';}
		 elseif($mont=='09'){$montText='SEP';}
		 elseif($mont=='10'){$montText='OCT';}
		 elseif($mont=='11'){$montText='NOV';}
 		 elseif($mont=='12'){$montText='DES';}
	 
	 $Drate=mysql_query("select * from tour_rate where RateYear=$_GET[thn]" );
     $rate=mysql_fetch_array($Drate);
	 
	   
	if($_GET[GType]=='ALL'){
	 
   $kriet=mysql_query("SELECT TCDivision,ProductType,Department,tour_msbooking.TourCode,Destination,SellingCurr,sum(if(GroupType='TMR' and Gender<>'INFANT' ,1,0)) as PaxTMR,sum(if(GroupType <>'TMR' and Gender<>'INFANT' and Department='LEISURE' ,1,0)) as PaxSeries,sum(if(GroupType <>'TMR' and Gender<>'INFANT' and Department<>'LEISURE' ,1,0)) as PaxPMT, count(IDDetail) as Total, sum(if(SellingCurr='USD',(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0)))) as Harga FROM tour_msbookingdetail inner join (select TCDivision,tour_msbooking.TourCode,ProductType,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$_GET[Bln]' and year(DateTravelFrom)='$_GET[thn]' and TCDivision='$_GET[BSO]' and Destination='$_GET[Dest]' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision<>'LTM')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID  group by tour_msbooking.TourCode order by Destination,Department,ProductType,Total desc");}
	else
	{
	 $kriet=mysql_query("SELECT TCDivision,ProductType,Department,tour_msbooking.TourCode,Destination,SellingCurr,sum(if(GroupType='TMR' and Gender<>'INFANT' ,1,0)) as PaxTMR,sum(if(GroupType <>'TMR' and Gender<>'INFANT' and Department='LEISURE' ,1,0)) as PaxSeries,sum(if(GroupType <>'TMR' and Gender<>'INFANT' and Department<>'LEISURE' ,1,0)) as PaxPMT, count(IDDetail) as Total, sum(if(SellingCurr='USD',(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0)))) as Harga FROM tour_msbookingdetail inner join (select TCDivision,tour_msbooking.TourCode,ProductType,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)='$_GET[Bln]' and year(DateTravelFrom)='$_GET[thn]' and TCDivision='$_GET[BSO]' and Destination='$_GET[Dest]' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision<>'LTM' and GroupType='$_GET[GType]')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID  group by tour_msbooking.TourCode order by Destination,Department,ProductType,Total desc");
	}
	
	 
	    
	echo"<table>
			<tr><th>No</th><th>Destination</th><th>Department</th><th>productType</th><th>Tour Code</th><th>Pax</th><th>Amount</th></tr>";
			$no=1;
			$TPax=0;
			$THarga=0;
			while($sow=mysql_fetch_array($kriet)){   
                  	$TPax=$TPax+$sow[Total];
					$THarga=$THarga+$sow[Harga];
				     echo"              
                     <tr>                                   
                     <td>$no</td>  
					 <td>$sow[Destination]</td> 
  					 <td>$sow[Department]</td> 
					 <td>$sow[ProductType]</td> 
					 <td>$sow[TourCode]</td> 
   					 <td style='text-align:right'>".number_format($sow[Total], 0, ',', '.');echo"</td> 
   					 <td style='text-align:right'>".number_format($sow[Harga], 0, ',', '.');echo"</td>
                     </tr>";
                      $no++;
                    };
					echo "
					<tr><th colspan=5><center>Total</th><th style='text-align:right'>".number_format($TPax, 0, ',', '.');echo"</th><th style='text-align:right'>".number_format($THarga, 0, ',', '.');echo"</th></tr></table><br>
                    <center><input type=button value=Close onclick=self.history.back()><br><br>"; 
     break;          
}
?>
