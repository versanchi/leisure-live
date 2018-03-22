<html>
<head>
<title>REPORT PRODUCT</title>
<link href="../config/print.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">           
     setTimeout(window.close, 120000);     
</script>
<script type="text/javascript"> 
function generateexcel(tableid) {
  var table= document.getElementById(tableid);
  var html = table.outerHTML;   
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));    
}  
</script>
<?php 
include "../config/koneksi.php";
include "../config/fungsi_an.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));           
?>
<body>
<?php 	
		$Dest=$_GET[Destination]; 
		$mont=$_GET[bulan]; 
		$yer=$_GET[year]; 
		
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
    
	if ($Dest=='ALL'){
	//Query tidak memunculkan tourcode yang kosong dan yang tidak terjual
	$QDestination=mysql_query("SELECT DISTINCT Destination FROM tour_msproduct where month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa");}else
	{
	$QDestination=mysql_query("SELECT DISTINCT Destination FROM tour_msproduct where month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Destination='$Dest'");}
	
			
	$Destination=mysql_num_rows($QDestination);
	
	if ($Destination > 0){

	 $No=1;
	 $TTMR=0;
	 $TSeries=0;
	 $TPMT=0;
	 $Total=0;
	 $THarga=0;
	 $lastDest='awal';
	 $Drate=mysql_query("select * from tour_rate where RateYear=$yer" );
     $rate=mysql_fetch_array($Drate);
	 
     echo"<table  id='product'>
	<tr><td colspan='10;' STYLE='font-size:20px; border-color:#FFFFFF;'><strong>PRODUCT LIST : $Dest</strong></td></tr>
	<tr><td colspan='10;' STYLE='border-color:#FFFFFF;' font size='2'>PERIODE $montText - $yer<br>USD 1 = IDR $rate[$montText]</td></tr>					
	 	  <tr><th>No</th><th>Destination</th><th>Product Name</th><th>TMR</th><th>Series</th><th>Ministry</th>
		   <th>Pax</th><th>Amount</th><th>Real Pax</th><th>Real Amount</th></tr>"; 
		
		while($DDestination=mysql_fetch_array($QDestination)){
		
		$Booking=mysql_query("SELECT TCDivision,Destination,ProductName,tour_msproduct.ProductCode as Prod,tour_msproduct.SellingCurr,sum(if(GroupType ='TMR' ,AdultPax+ChildPax,0)) as PaxTMR,sum(if(GroupType <>'TMR' and Department='LEISURE' ,AdultPax+ChildPax,0)) as PaxSeries,sum(if(GroupType <>'TMR' and Department<>'LEISURE' ,AdultPax+ChildPax,0)) as PaxPMT, sum(AdultPax+ChildPax) as Total ,sum(TotalPrice) as Harga,sum((AdultPax+ChildPax)*TaxInsSell) as hargatax , sum(if(TCDivision<>'LTM',AdultPax+ChildPax,0)) as TotalReal ,sum(if(TCDivision<>'LTM',TotalPrice,0)) as HargaReal,sum(if(TCDivision<>'LTM',(AdultPax+ChildPax)*TaxInsSell,0)) as hargataxReal FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and  Destination='$DDestination[Destination]' group by Prod order by Total desc");

		$JumBooking=mysql_num_rows($Booking);
		
		while($DBooking=mysql_fetch_array($Booking)){		
	
		echo "<tr>
			  <td style='font-size: 12px;'>$No</td>";
             if($DBooking[Destination]<>$lastDest){echo"<td rowspan=$JumBooking style='vertical-align:middle'><center>$DBooking[Destination]</center></td>";}
			 echo"<td>$DBooking[Prod] - $DBooking[ProductName]</td>
             <td style='text-align:right'>".number_format($DBooking[PaxTMR], 0, ',', '.');echo"</td>
             <td style='text-align:right'>".number_format($DBooking[PaxSeries], 0, ',', '.');echo"</td>
             <td style='text-align:right'>".number_format($DBooking[PaxPMT], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>";
			 $TampilTotal=number_format($DBooking[Total], 0, ',', '.');
			 if($DBooking[Total]=='0'){echo"$TampilTotal";}else{echo"
           <a href=?module=rptproduct&act=dtltourcode&Prod=$DBooking[Prod]&Bln=$mont&thn=$yer>$TampilTotal</a>";}
		    if($DBooking[SellingCurr]=='USD'){
			$DHarga=($DBooking[Harga]+$DBooking[hargatax])*$rate[$montText];
			$DHargaReal=($DBooking[HargaReal]+$DBooking[hargataxReal])*$rate[$montText];
			}else{
			$DHarga=($DBooking[Harga]+$DBooking[hargatax]);
			$DHargaReal=($DBooking[HargaReal]+$DBooking[hargataxReal]);}
			 echo "</td>
			 <td style='text-align:right'>".number_format($DHarga, 0, ',', '.');echo"</td>
 			 <td style='text-align:right'>$DBooking[TotalReal]</td>
  			 <td style='text-align:right'>".number_format($DHargaReal, 0, ',', '.');echo"</td>
			 </tr>";
		$No++;
		$TTMR=$TTMR+$DBooking[PaxTMR];
		$TSeries=$TSeries+$DBooking[PaxSeries];
		$TPMT=$TPMT+$DBooking[PaxPMT];
		$Total=$Total+$DBooking[Total];
		$THarga=$THarga+$DHarga;
		$TotalReal=$TotalReal+$DBooking[TotalReal];
		$THargaReal=$THargaReal+$DHargaReal;
		$lastDest=$DBooking[Destination];
		};
		};		
	echo "<tr><th colspan=3>Total</th><th>".number_format($TTMR, 0, ',', '.');echo"</th><th>".number_format($TSeries, 0, ',', '.');echo"</th><th>".number_format($TPMT, 0, ',', '.');echo"</th><th>".number_format($Total, 0, ',', '.');echo"</th><th>".number_format($THarga, 0, ',', '.');echo"</th><th>".number_format($TotalReal, 0, ',', '.');echo"</th><th>".number_format($THargaReal, 0, ',', '.');echo"</th></tr>
	</table>
	<input type='button' name='submit' value='Export to Excel' onclick=generateexcel('product')>";
	
	} 
	
	else
	
	{ echo "NO TRANSACTION AVAILABLE IN $montText - $yer";
	} 
	   
?> <?php 
      
?>
</body>
</html>
<script>
	window.opener.location.reload();
</script>