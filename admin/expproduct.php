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
session_start();
include "../config/koneksi.php";
include "../config/fungsi_an.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));           
?>
<body>
<?php 	

switch($_GET[act]){
  // Tampilan header
   default:
   		$CompanyID=$_GET[Comp];
		$Dest=$_GET[Destination];
		$mont=$_GET[bulan]; 
		$yer=$_GET[year];
		$GroupType=$_GET[GroupType];
		
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
    
	if($Dest=='ALL'){
	$QDestination=mysql_query("SELECT DISTINCT Destination FROM tour_msproduct where month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa  ");}
	else
	{
	$QDestination=mysql_query("SELECT DISTINCT Destination FROM tour_msproduct where month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Destination='$Dest' ");
		
	}
	
			
	$Destination=mysql_num_rows($QDestination);
	
	if ($Destination > 0){
	$Lastyear = $yer-1;	  
	

  //munculin table
	 $No=1;
	 $Total=0;
	
	
	echo"
		<table id='RptDestination' >
		 <tr ><td style='font-size:20px; border-color:#FFFFFF;'; colspan ='7;'><strong><h><u>Report Destination -  $montText $yer</u></h></strong></td></tr><tr><td style='border-color:#FFFFFF;'; colspan ='7;'>Product Type : $GroupType - $Dest</td></tr>
		    <tr></tr>
			<tr><th rowspan=2 >No</th><th rowspan=2>Destination</th><th colspan=2>Pax</th><th colspan=2>Amount</th></tr>
			<tr><th>$Lastyear</th><th>$yer</th><th>$Lastyear</th><th>$yer</th></tr>";
	
	
	 	$Drate=mysql_query("select * from tour_rate where RateYear=$yer" );
		 $kursnow=mysql_fetch_array($Drate);
		 
		 $DLastrate=mysql_query("select * from tour_rate where RateYear=$Lastyear" );
		 $kursLast=mysql_fetch_array($DLastrate);
		
		if($GroupType=='ALL'){
			
		if($Dest=='ALL'){	
				  $strQuerytable =mysql_query("SELECT Destination, 
				sum(if(year(DateTravelFrom) =$yer ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AmtNow , 
				sum(if(year(DateTravelFrom) =$Lastyear ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AmtLast ,
				sum(if(year(DateTravelFrom) =$yer ,1,0)) as PaxNow , 
				sum(if(year(DateTravelFrom) =$Lastyear ,1,0)) as PaxLast,
				sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,1,0)) as TotalLast 	
		
			FROM tour_msbookingdetail 
				inner join 
			(select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and month(DateTravelFrom)=$mont and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and (TCCompanyID=$CompanyID or CompanyID=$CompanyID))tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'   group by Destination order by TotalNow desc"); }
				  
			else
			{
			 $strQuerytable =mysql_query("SELECT Destination, 
				sum(if(year(DateTravelFrom) =$yer ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AmtNow , 
				sum(if(year(DateTravelFrom) =$Lastyear ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AmtLast ,
				sum(if(year(DateTravelFrom) =$yer ,1,0)) as PaxNow , 
				sum(if(year(DateTravelFrom) =$Lastyear ,1,0)) as PaxLast,
				sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,1,0)) as TotalLast 	
		
			FROM tour_msbookingdetail 
				inner join 
			(select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear )  and month(DateTravelFrom)=$mont and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and (TCCompanyID=$CompanyID or CompanyID=$CompanyID) and tour_msproduct.Destination='$Dest' )tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'   group by Destination order by TotalNow desc");
			}
		  
		  }
		  else
		  {
		
		if($Dest=='ALL'){	
		  $strQuerytable =mysql_query("SELECT Destination, 
		sum(if(year(DateTravelFrom) =$yer ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AmtNow , 
		sum(if(year(DateTravelFrom) =$Lastyear ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AmtLast ,
		sum(if(year(DateTravelFrom) =$yer ,1,0)) as PaxNow , 
		sum(if(year(DateTravelFrom) =$Lastyear ,1,0)) as PaxLast,
		sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,1,0)) as TotalLast 	

	FROM tour_msbookingdetail 
		inner join 
	(select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and month(DateTravelFrom)=$mont and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and (TCCompanyID=$CompanyID or CompanyID=$CompanyID)  and tour_msproduct.GroupType='$GroupType')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'   group by Destination order by TotalNow desc");}
		  
		  else
		  {
		  
		    $strQuerytable =mysql_query("SELECT Destination, 
		sum(if(year(DateTravelFrom) =$yer ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AmtNow , 
		sum(if(year(DateTravelFrom) =$Lastyear ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AmtLast ,
		sum(if(year(DateTravelFrom) =$yer ,1,0)) as PaxNow , 
		sum(if(year(DateTravelFrom) =$Lastyear ,1,0)) as PaxLast,
		sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,1,0)) as TotalLast 	

	FROM tour_msbookingdetail 
		inner join 
	(select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear )  and month(DateTravelFrom)=$mont and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and (TCCompanyID=$CompanyID or CompanyID=$CompanyID)  and tour_msproduct.GroupType='$GroupType' and tour_msproduct.Destination='$Dest')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'   group by Destination order by TotalNow desc");
		  
		  
		  }
		  
		  }
			
			$Jum=mysql_num_rows($strQuerytable);
			
			$PaxLast=0;
			$PaxNow=0;
			$AmtLast=0;
			$AmtNow=0;	

			
			while($DPax = mysql_fetch_array($strQuerytable)){
            $DPaxDestination = str_replace("&", "%",str_replace(" ", "_", $DPax[Destination]));
            //$DPaxDestination = $DPax[Destination];
			echo "<tr>
					 <td>$No</td>
					 <td><center><a href='?module=rptproduct&act=dtlProduct&GroupType=$GroupType&Destination=$DPaxDestination&Bln=$mont&thn=$yer&Comp=$CompanyID'>$DPax[Destination]</a></td>

					 
					 <td style='text-align:right'>".number_format($DPax[PaxLast], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[PaxNow], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[AmtLast], 0, ',', '.');
					 echo"</td><td style='text-align:right'>".number_format($DPax[AmtNow], 0, ',', '.');
					 echo"</td></tr>";
					 $PaxLast=$PaxLast+$DPax[PaxLast];
					 $PaxNow=$PaxNow+$DPax[PaxNow];
					 $AmtLast=$AmtLast+$DPax[AmtLast];
					 $AmtNow=$AmtNow+$DPax[AmtNow];
					 $No++;
			}
			
			
			echo "<tr>
					 <th colspan=2>Total</th>					 
					 <th style='text-align:right'>".number_format($PaxLast, 0, ',', '.');
					 echo"</th><th style='text-align:right'>".number_format($PaxNow, 0, ',', '.');
					 echo"</th><th style='text-align:right'>".number_format($AmtLast, 0, ',', '.');
					 echo"</th><th style='text-align:right'>".number_format($AmtNow, 0, ',', '.');
					 echo"</th></tr>";
			echo"</table><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('RptDestination')>";
			
	} 
	
	else
	
	{ echo "NO TRANSACTION AVAILABLE IN $montText - $yer";
	} 
	
	break;
    
	case "dtlProduct":
	$CompanyID=$_GET[Comp]; 
	//$Dest=$_GET['Destination'];
    $Dest = str_replace("_%_", " & ", $_GET['Destination']);
	$mont=$_GET[Bln]; 
	$yer=$_GET[thn]; 
	$GroupType=$_GET[GroupType];
		
	 $No=1;

	 $Drate=mysql_query("select * from tour_rate where RateYear=$yer" );
     $rate=mysql_fetch_array($Drate);
	
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
		 
     echo"<table  id='product'>
	 <tr><td colspan='3;' STYLE='font-size:20px; border-color:#FFFFFF;'><strong>Destination : $Dest - $GroupType</strong></td></tr>
	 <tr><td colspan='3;' STYLE='border-color:#FFFFFF;' font size='2'>PERIODE $montText - $yer<br>USD 1 = IDR $rate[$montText]</td></tr>	
	 <tr><td style='border-color:#FFFFFF;'>
	 <table>
	
		<table STYLE='border-color:#FFFFFF;'><tr><td STYLE='border-color:#FFFFFF;'>
		<table><tr><td colspan=4; STYLE='border-color:#FFFFFF;'><strong>Base on Product</strong></td></tr>		
	 	  <tr><th>No</th><th>Product Name</th><th>Pax</th><th>Amount</th></tr>"; 
		
	if($GroupType=='ALL'){	
$Booking=mysql_query("SELECT  TCDivision,Destination,ProductName,count(IDdetail) as total,ProductCode as Prod, 
		sum(if(SellingCurr='USD',
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))
		)) as Amt
	
	
	FROM tour_msbookingdetail 
		inner join 
	(select TCDivision,BookingID,Destination,tour_msproduct.Productcodename as ProductName,ProductCode,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and year(DateTravelFrom)=$yer and month(DateTravelFrom)=$mont and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and DUMMY='NO' and (TCCompanyID=$CompanyID or CompanyID=$CompanyID))tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  and Destination='$Dest' group by productname order by Amt desc");}

else
{
$Booking=mysql_query("SELECT  TCDivision,Destination,ProductName,count(IDdetail) as total,ProductCode as Prod, 
		sum(if(SellingCurr='USD',
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))
		)) as Amt
	
	
	FROM tour_msbookingdetail 
		inner join 
	(select TCDivision,BookingID,Destination,tour_msproduct.Productcodename as ProductName,ProductCode,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and year(DateTravelFrom)=$yer and month(DateTravelFrom)=$mont and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and DUMMY='NO' and (TCCompanyID=$CompanyID or CompanyID=$CompanyID)  and tour_msproduct.GroupType='$GroupType')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  and Destination='$Dest' group by productname order by Amt desc");
	
}
		
		while($DBooking=mysql_fetch_array($Booking)){		
	
		echo "<tr>
			  <td style='font-size: 12px; '>$No</td>
			  <td>$DBooking[Prod] - $DBooking[ProductName]</td>
             <td style='text-align:right'>".number_format($DBooking[total], 0, ',', '.');echo"</td>
             <td style='text-align:right'>".number_format($DBooking[Amt], 0, ',', '.');echo"</td>
			 </tr>";
		$No++;
		$Amount=$Amount+$DBooking[Amt];
		$Total=$Total+$DBooking[total];
		
		};
		
		 $NoDiv=1;	
	echo "<tr><th colspan=2>Total</th><th>".number_format($Total, 0, ',', '.');echo"</th><th>".number_format($Amount, 0, ',', '.');echo"</th></tr>
	</table>
	
	<table><tr style='border-color:#FFFFFF;'><td colspan=4; style='border-color:#FFFFFF;'><strong>Base on Division</strong></td></tr>
	  <tr><th>No</th><th>Division</th><th>Pax</th><th>Amount</th></tr>"; 
	  
	// per divisi
	
	if($GroupType=='ALL'){
		
$BDivision=mysql_query("SELECT  TCDivision,Destination,ProductName,count(IDdetail) as total,ProductCode as Prod, 
		sum(if(SellingCurr='USD',
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))
		)) as Amt
	FROM tour_msbookingdetail 
		inner join 
	(select TCDivision,BookingID,Destination,tour_msproduct.Productcodename as ProductName,ProductCode,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and year(DateTravelFrom)=$yer and month(DateTravelFrom)=$mont and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and (TCCompanyID=$CompanyID))tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  and Destination='$Dest' group by TCDivision order by Amt desc");


$BOtherDivision=mysql_query("SELECT  TCDivision,Destination,ProductName,count(IDdetail) as total,ProductCode as Prod, 
		sum(if(SellingCurr='USD',
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))
		)) as Amt
	FROM tour_msbookingdetail 
		inner join 
	(select TCDivision,BookingID,Destination,tour_msproduct.Productcodename as ProductName,ProductCode,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and year(DateTravelFrom)=$yer and month(DateTravelFrom)=$mont and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and (TCCompanyID<>$CompanyID and CompanyID=$CompanyID))tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  and Destination='$Dest' group by TCDivision order by Amt desc");
	}
	else
	{
		
	$BDivision=mysql_query("SELECT  TCDivision,Destination,ProductName,count(IDdetail) as total,ProductCode as Prod, 
		sum(if(SellingCurr='USD',
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))
		)) as Amt
	
	
	FROM tour_msbookingdetail 
		inner join 
	(select TCDivision,BookingID,Destination,tour_msproduct.Productcodename as ProductName,ProductCode,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and year(DateTravelFrom)=$yer and month(DateTravelFrom)=$mont and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and (TCCompanyID=$CompanyID) and tour_msproduct.GroupType='$GroupType')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  and Destination='$Dest' group by TCDivision order by Amt desc");

$BOtherDivision=mysql_query("SELECT  TCDivision,Destination,ProductName,count(IDdetail) as total,ProductCode as Prod, 
		sum(if(SellingCurr='USD',
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))
		)) as Amt
	
	
	FROM tour_msbookingdetail 
		inner join 
	(select TCDivision,BookingID,Destination,tour_msproduct.Productcodename as ProductName,ProductCode,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and year(DateTravelFrom)=$yer and month(DateTravelFrom)=$mont and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and (TCCompanyID<>$CompanyID and CompanyID=$CompanyID) and tour_msproduct.GroupType='$GroupType')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  and Destination='$Dest' group by TCDivision order by Amt desc");
	}
		
		while($DDivision=mysql_fetch_array($BDivision)){		
	
		echo "<tr>
			  <td style='font-size: 12px;'>$NoDiv</td>
			  <td>$DDivision[TCDivision]</td>
             <td style='text-align:right'>".number_format($DDivision[total], 0, ',', '.');echo"</td>
             <td style='text-align:right'>".number_format($DDivision[Amt], 0, ',', '.');echo"</td>
			 </tr>";
		$No++;
		$AmountDiv=$AmountDiv+$DDivision[Amt];
		$TotalDiv=$TotalDiv+$DDivision[total];
		$NoDiv++;
		};
			
	echo "<tr><th colspan=2>Total</th><th>".number_format($TotalDiv, 0, ',', '.');echo"</th><th>".number_format($AmountDiv, 0, ',', '.');echo"</th></tr>";
	
	$JumOthers=mysql_num_rows($BOtherDivision);
		
	if($JumOthers>0)
	{
	echo"<tr><td colspan=4;><strong>SISTER COMPANY/FRANCHISE</strong></td></tr>";
	$AmountOtherDiv=0;
	$TotalOtherDiv=0;
	
		while($DOtherDivision=mysql_fetch_array($BOtherDivision)){		
	
		echo "<tr>
			  <td style='font-size: 12px;'>$NoDiv</td>
			  <td>$DOtherDivision[TCDivision]</td>
             <td style='text-align:right'>".number_format($DOtherDivision[total], 0, ',', '.');echo"</td>
             <td style='text-align:right'>".number_format($DOtherDivision[Amt], 0, ',', '.');echo"</td>
			 </tr>";
		$No++;
		$AmountOtherDiv=$AmountOtherDiv+$DOtherDivision[Amt];
		$TotalOtherDiv=$TotalOtherDiv+$DOtherDivision[total];
		$NoDiv++;
	}
	

	
	echo "<tr><th colspan=2>Total</th><th>".number_format($TotalOtherDiv, 0, ',', '.');echo"</th><th>".number_format($AmountOtherDiv, 0, ',', '.');echo"</th></tr>";
		$AmountDiv=$AmountDiv+$AmountOtherDiv;
		$TotalDiv=$TotalDiv+$TotalOtherDiv;
		}
	echo "<tr><td colspan=4;></td></tr><tr><th colspan=2>Grand Total</th><th>".number_format($TotalDiv, 0, ',', '.');echo"</th><th>".number_format($AmountDiv, 0, ',', '.');echo"</th></tr>";
	
	echo"</table>
	</td></tr></table>
	</td>
	<td style='border-color:#FFFFFF;' rowspan=2;></td><td style='border-color:#FFFFFF;'><table style='border-color:#FFFFFF;' rowspan=2;>";
	$NoTC=1;
	echo"<tr><td colspan=5; style='border-color:#FFFFFF;'><strong>Base on TCName</strong></td></tr>
	  <tr><th>No</th><th>TC Name</th><th>Division</th><th>Pax</th><th>Amount</th></tr>"; 
//per tc

if($GroupType=='ALL'){
		
$BTCName=mysql_query("SELECT  TCNameAlias,TCDivision,Destination,ProductName,count(IDdetail) as total,ProductCode as Prod, 
		sum(if(SellingCurr='USD',
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))
		)) as Amt
	
	
	FROM tour_msbookingdetail 
		inner join 
	(select TCNameAlias,TCDivision,BookingID,Destination,tour_msproduct.Productcodename as ProductName,ProductCode,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and year(DateTravelFrom)=$yer and month(DateTravelFrom)=$mont and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and (TCCompanyID=$CompanyID) )tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  and Destination='$Dest' group by TCNameAlias order by Amt desc");

$BOtherTCName=mysql_query("SELECT  TCNameAlias,TCDivision,Destination,ProductName,count(IDdetail) as total,ProductCode as Prod, 
		sum(if(SellingCurr='USD',
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))
		)) as Amt
	
	
	FROM tour_msbookingdetail 
		inner join 
	(select TCNameAlias,TCDivision,BookingID,Destination,tour_msproduct.Productcodename as ProductName,ProductCode,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and year(DateTravelFrom)=$yer and month(DateTravelFrom)=$mont and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and (TCCompanyID<>$CompanyID and CompanyID=$CompanyID) )tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  and Destination='$Dest' group by TCNameAlias order by Amt desc");
}
else
{
		
$BTCName=mysql_query("SELECT  TCNameAlias,TCDivision,Destination,ProductName,count(IDdetail) as total,ProductCode as Prod, 
		sum(if(SellingCurr='USD',
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))
		)) as Amt
	
	
	FROM tour_msbookingdetail 
		inner join 
	(select TCNameAlias,TCDivision,BookingID,Destination,tour_msproduct.Productcodename as ProductName,ProductCode,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and year(DateTravelFrom)=$yer and month(DateTravelFrom)=$mont and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and (TCCompanyID=$CompanyID)  and tour_msproduct.GroupType='$GroupType')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  and Destination='$Dest' group by TCNameAlias order by Amt desc");

$BOtherTCName=mysql_query("SELECT  TCNameAlias,TCDivision,Destination,ProductName,count(IDdetail) as total,ProductCode as Prod, 
		sum(if(SellingCurr='USD',
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],
		(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and Gender<>'INFANT'),TaxInsSell,0))
		)) as Amt
	
	
	FROM tour_msbookingdetail 
		inner join 
	(select TCNameAlias,TCDivision,BookingID,Destination,tour_msproduct.Productcodename as ProductName,ProductCode,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and year(DateTravelFrom)=$yer and month(DateTravelFrom)=$mont and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and (TCCompanyID<>$CompanyID and CompanyID=$CompanyID)  and tour_msproduct.GroupType='$GroupType')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  and Destination='$Dest' group by TCNameAlias order by Amt desc");

}


	
	while($DTCName=mysql_fetch_array($BTCName)){		
	
		echo "<tr>
			  <td style='font-size: 12px;'>$NoTC</td>
			  <td>$DTCName[TCNameAlias]</td>
			  <td>$DTCName[TCDivision]</td>
             <td style='text-align:right'>".number_format($DTCName[total], 0, ',', '.');echo"</td>
             <td style='text-align:right'>".number_format($DTCName[Amt], 0, ',', '.');echo"</td>
			 </tr>";
		$AmountTCName=$AmountTCName+$DTCName[Amt];
		$TotalTCName=$TotalTCName+$DTCName[total];
		$NoTC++;
		};
		
		echo "<tr><th colspan=3>Total</th><th>".number_format($TotalTCName, 0, ',', '.');echo"</th><th>".number_format($AmountTCName, 0, ',', '.');
	$JumOthers=mysql_num_rows($BOtherTCName);
		
	if($JumOthers>0)
	{
		  echo"<tr><td colspan=5;><strong>SISTER COMPANY/FRANCHISE</strong></td></tr>";	
		$AmountOtherTCName=0;
		$TotalOtherTCName=0;
		
	while($DOtherTCName=mysql_fetch_array($BOtherTCName)){		
	
		echo "<tr>
			  <td style='font-size: 12px;'>$NoTC</td>
			  <td>$DOtherTCName[TCNameAlias]</td>
			  <td>$DOtherTCName[TCDivision]</td>
             <td style='text-align:right'>".number_format($DOtherTCName[total], 0, ',', '.');echo"</td>
             <td style='text-align:right'>".number_format($DOtherTCName[Amt], 0, ',', '.');echo"</td>
			 </tr>";
		$AmountOtherTCName=$AmountOtherTCName+$DOtherTCName[Amt];
		$TotalOtherTCName=$TotalOtherTCName+$DOtherTCName[total];
		$NoTC++;
		};
		
	
	
		$AmountTCName=$AmountTCName+$AmountOtherTCName;
		$TotalTCName=$TotalTCName+$TotalOtherTCName;
	echo "<tr><th colspan=3>Total</th><th>".number_format($TotalOtherTCName, 0, ',', '.');echo"</th><th>".number_format($AmountOtherTCName, 0, ',', '.');echo"</th></tr> </th></tr>";
	}
	echo"<tr><td colspan=5></td></tr>
		  <tr><th colspan=3>Total</th><th>".number_format($TotalTCName, 0, ',', '.');echo"</th><th>".number_format($AmountTCName, 0, ',', '.');echo"</th></tr>";
	
	echo"</table>
	
	</td></tr>";
	echo"</table>
	<input type='button' name='submit' value='Export to Excel' onclick=generateexcel('product')>";
	
	
	
	break;


}

	   
?> <?php 
      
?>
</body>
</html>
<script>
	window.opener.location.reload();
</script>