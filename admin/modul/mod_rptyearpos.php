<link href="./css/fixedheadertable.css" rel="stylesheet" media="screen" />
<link href="./css/custom.css" rel="stylesheet" media="screen" />
<!--<script src="./js/jquery-1.7.2.min.js"></script>-->
<script src="./js/jquery.fixedheadertable.js"></script>

<script type="text/javascript">

	$(document).ready(function() {
		$('#myDemoTable').fixedHeaderTable({
			altClass : 'odd',
			footer : true,
			fixedColumns : 1
		});
	});

	$(document).ready(function() {
		$('#DetailPOS').fixedHeaderTable({
			altClass : 'odd',
			footer : true,
			fixedColumns : 1
		});
	});
	function generateexcel(tableid) {
		var table= document.getElementById(tableid);
		var html = table.outerHTML;
		window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
	}
</script>
<?php
$CompanyID=$_SESSION['company_id'];
switch($_GET[act]){
  // Tampilan header
   default:
    $thnini = date("Y");
    $yer=$_GET['year'];
	if($yer==''){$yer=$thnini;}
    
    echo "<h2>Report by POS</h2>
			   	
    <form method='get' action='media.php?'><input type=hidden name=module value='rptyearpos'>   
		      
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
    echo "<input type=submit name='submit' size='20'value='View'>
          </form>";
	$oke=$_GET['oke'];	


	echo "<h><u>Report POS Period   $yer </u></h><br>";	


 //munculin table pax

	 echo"<div class='outerbox'>
            <div class='innerbox'>
	 			<table class='bluetable' id='myDemoTable' cellpadding='0' cellspacing='0'>
	 				<thead>
	 				<tr>
	 					<th>POS</th><th colspan=2>JAN</th><th colspan=2>FEB</th><th colspan=2>MAR</th><th colspan=2>APR</th><th colspan=2>MAY</th><th colspan=2>JUN</th><th colspan=2>JUL</th><th colspan=2>AGT</th><th colspan=2>SEP</th><th colspan=2>OCT</th><th colspan=2>NOV</th><th colspan=2>DEC</th><th colspan=2>Total</th><th colspan=2>%</th>
	 				</tr></thead>
					
					<tr><td style='background-color: #000000; color:#FFFFFF'></td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax&nbsp;&nbsp;&nbsp;</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td></tr><tbody>";
 

$SalesALL =mysql_query("SELECT sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctAmtNow ,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecAmtNow ,
		  sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , 
		  sum(if(year(DateTravelFrom) =$yer ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AmtNow 
		  FROM tour_msbookingdetail inner join (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,datetravelfrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and (TCCompanyId=$CompanyID or tour_msproduct.CompanyID=$CompanyID) )tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'");

$DSalesALL = mysql_fetch_array($SalesALL);
	
$PaxALL=$DSalesALL[TotalNow];
$AmountALL=$DSalesALL[AmtNow];

//Sales BSO

	$QBSO=mssql_query("select * from Divisi where  CompanyID=$CompanyID and District='JAKARTA' order by DivisiID");
		
		while($DBSO=mssql_fetch_array($QBSO)){
			 if ($Boso=='')
			  {
				$Boso="'$DBSO[DivisiID]'";
			  }
			  else
			  {
				$Boso=$Boso.",'$DBSO[DivisiID]'";
			  }
		}

	echo "<tr><td><center><a href=?module=rptyearpos&act=dtlPOSPax&Market=BSO&thn=$yer>BSO</a></td>";

		$SalesBSO =mysql_query("SELECT 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctAmtNow ,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer),1,0)) as TotalNow , 
		  sum(if((year(DateTravelFrom) =$yer) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as TotalAmtNow 
		  FROM tour_msbookingdetail 
		  inner join 
		  (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,datetravelfrom 
		   from tour_msbooking 
		   inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
		   where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and TCCompanyId=$CompanyID and TCDivision in ($Boso) )tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'");
	
		
$DSalesBSO = mysql_fetch_array($SalesBSO);

         	 echo"<td style='text-align:right'>".number_format($DSalesBSO[JanNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[JanAmtNow], 0, ',', '.');echo"</td>";

			 echo"<td style='text-align:right'>".number_format($DSalesBSO[FebNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[FebAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[MarNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[MarAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[AprNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[AprAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[MayNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[MayAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[JunNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[JunAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[JulNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[JulAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[AgtNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[AgtAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[SepNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[SepAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[OctNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[OctAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[NovNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[NovAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[DecNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[DecAmtNow], 0, ',', '.');echo"</td>";
			 
	$PBSO=$DSalesBSO[TotalNow]/$PaxALL*100;
	$PAmtBSO=$DSalesBSO[TotalAmtNow]/$AmountALL*100;
	
	 	echo"<td style='text-align:right'>".number_format($DSalesBSO[TotalNow], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format($DSalesBSO[TotalAmtNow], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format($PBSO, 0, ',', '.');echo" % </td>
			 <td style='text-align:right'>".number_format($PAmtBSO, 0, ',', '.');echo"% </td>
			 </tr>";

	//Sales BOLK

	$QBOLK=mssql_query("select * from Divisi where Active=1 and CompanyID=$CompanyID and District='NON JAKARTA' order by DivisiID");
	
	while($DBOLK=mssql_fetch_array($QBOLK)){
			 if ($BOLK=='')
			  {
				$BOLK="'$DBOLK[DivisiID]'";
			  }
			  else
			  {
				$BOLK=$BOLK.",'$DBOLK[DivisiID]'";
			  }
		}
		
		echo "<tr><td><center><a href=?module=rptyearpos&act=dtlPOSPax&Market=BOLK&thn=$yer>BOLK</a></td>";

	$SalesBOLK =mysql_query("SELECT 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctAmtNow ,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer),1,0)) as TotalNow , 
		  sum(if((year(DateTravelFrom) =$yer) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as TotalAmtNow 
		  FROM tour_msbookingdetail 
		  inner join 
		  (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,datetravelfrom 
		   from tour_msbooking 
		   inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
		   where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and TCCompanyId=$CompanyID and TCDivision in ($BOLK) )tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'");
	
		
$DSalesBOLK = mysql_fetch_array($SalesBOLK);

         	  echo"<td style='text-align:right'>".number_format($DSalesBOLK[JanNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBOLK[JanAmtNow], 0, ',', '.');echo"</td>";

			 echo"<td style='text-align:right'>".number_format($DSalesBOLK[FebNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBOLK[FebAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBOLK[MarNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBOLK[MarAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBOLK[AprNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBOLK[AprAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBOLK[MayNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBOLK[MayAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBOLK[JunNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBOLK[JunAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBOLK[JulNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBOLK[JulAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBOLK[AgtNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBOLK[AgtAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBOLK[SepNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBOLK[SepAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBOLK[OctNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBOLK[OctAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBOLK[NovNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBOLK[NovAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBOLK[DecNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBOLK[DecAmtNow], 0, ',', '.');echo"</td>";
	
	$PBOLK=$DSalesBOLK[TotalNow]/$PaxALL*100;
	$PAmtBOLK=$DSalesBOLK[TotalAmtNow]/$AmountALL*100;
	
			 echo"<td style='text-align:right'>".number_format($DSalesBOLK[TotalNow], 0, ',', '.');echo"</td>
			<td style='text-align:right'>".number_format($DSalesBOLK[TotalAmtNow], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format($PBOLK, 0, ',', '.');echo" % </td>
			 <td style='text-align:right'>".number_format($PAmtBOLK, 0, ',', '.');echo"% </td>
			 </tr>";
		 
		//Sales SA
		
	$QSISCOM=mssql_query("select * from Divisi where CompanyID<>$CompanyID and CompanyGroup<>'PANORAMA WORLD'  order by DivisiID");
	
	while($DSISCOM=mssql_fetch_array($QSISCOM)){
			 if ($SISCOM=='')
			  {
				$SISCOM="'$DSISCOM[DivisiID]'";
			  }
			  else
			  {
				$SISCOM=$SISCOM.",'$DSISCOM[DivisiID]'";
			  }
		}
		
		echo "<tr><td><center><a href=?module=rptyearpos&act=dtlPOSPax&Market=SA&thn=$yer>SISCOM</a></td>";

		$SalesSA =mysql_query("SELECT 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctAmtNow ,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer),1,0)) as TotalNow , 
		  sum(if((year(DateTravelFrom) =$yer) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as TotalAmtNow 
		  FROM tour_msbookingdetail 
		  inner join 
		  (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,datetravelfrom 
		   from tour_msbooking 
		   inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
		   where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and tour_msproduct.CompanyID=$CompanyID and TCDivision in ($SISCOM) )tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'");
	
		
$DSalesSA = mysql_fetch_array($SalesSA);

         	 echo"<td style='text-align:right'>".number_format($DSalesSA[JanNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesSA[JanAmtNow], 0, ',', '.');echo"</td>";

			 echo"<td style='text-align:right'>".number_format($DSalesSA[FebNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesSA[FebAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesSA[MarNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesSA[MarAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesSA[AprNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesSA[AprAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesSA[MayNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesSA[MayAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesSA[JunNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesSA[JunAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesSA[JulNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesSA[JulAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesSA[AgtNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesSA[AgtAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesSA[SepNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesSA[SepAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesSA[OctNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesSA[OctAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesSA[NovNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesSA[NovAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesSA[DecNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesSA[DecAmtNow], 0, ',', '.');echo"</td>";
			 
	$PSA=$DSalesSA[TotalNow]/$PaxALL*100;
	$PAmtSA=$DSalesSA[TotalAmtNow]/$AmountALL*100;
	
			 echo"<td style='text-align:right'>".number_format($DSalesSA[TotalNow], 0, ',', '.');echo"</td>
			<td style='text-align:right'>".number_format($DSalesSA[TotalAmtNow], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format($PSA, 0, ',', '.');echo" % </td>
			 <td style='text-align:right'>".number_format($PAmtSA, 0, ',', '.');echo"% </td>
			 </tr>";


		 //Sales PW

	$QPW=mssql_query("select * from Divisi where CompanyID<>$CompanyID and CompanyGroup='PANORAMA WORLD'  order by DivisiID");
	
	while($DPW=mssql_fetch_array($QPW)){
			 if ($PW=='')
			  {
				$PW="'$DPW[DivisiID]'";
			  }
			  else
			  {
				$PW=$PW.",'$DPW[DivisiID]'";
			  }
		}
		echo "<tr><td><center><a href=?module=rptyearpos&act=dtlPOSPax&Market=PW&thn=$yer>PW</a></td>";
		
		

		$SalesPW =mysql_query("SELECT 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctAmtNow ,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer),1,0)) as TotalNow , 
		  sum(if((year(DateTravelFrom) =$yer) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as TotalAmtNow 
		  FROM tour_msbookingdetail 
		  inner join 
		  (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,datetravelfrom 
		   from tour_msbooking 
		   inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
		   where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and tour_msproduct.CompanyID=$CompanyID and TCDivision in ($PW) )tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'");
	
		
$DSalesPW = mysql_fetch_array($SalesPW);

         	 echo"<td style='text-align:right'>".number_format($DSalesPW[JanNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesPW[JanAmtNow], 0, ',', '.');echo"</td>";

			 echo"<td style='text-align:right'>".number_format($DSalesPW[FebNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesPW[FebAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesPW[MarNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesPW[MarAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesPW[AprNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesPW[AprAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesPW[MayNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesPW[MayAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesPW[JunNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesPW[JunAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesPW[JulNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesPW[JulAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesPW[AgtNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesPW[AgtAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesPW[SepNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesPW[SepAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesPW[OctNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesPW[OctAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesPW[NovNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesPW[NovAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesPW[DecNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesPW[DecAmtNow], 0, ',', '.');echo"</td>";
			 
	$PPW=$DSalesPW[TotalNow]/$PaxALL*100;
	$PAmtPW=$DSalesPW[TotalAmtNow]/$AmountALL*100;
	
			 echo"<td style='text-align:right'>".number_format($DSalesPW[TotalNow], 0, ',', '.');echo"</td>
			<td style='text-align:right'>".number_format($DSalesPW[TotalAmtNow], 0, ',', '.');echo"</td>
			 <td style='text-align:right'>".number_format($PPW, 0, ',', '.');echo" % </td>
			 <td style='text-align:right'>".number_format($PAmtPW, 0, ',', '.');echo"% </td>
			 </tr>";

	 //Sales ALL

		echo "<tr><td style='background-color: #000000; color:#FFFFFF;'><center><b>TOTAL</b></td>";
		 
		 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[JanNow], 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[JanAmtNow], 0, ',', '.');echo"</td>";

			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[FebNow], 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[FebAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[MarNow], 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[MarAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[AprNow], 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[AprAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[MayNow], 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[MayAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[JunNow], 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[JunAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[JulNow], 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[JulAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[AgtNow], 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[AgtAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[SepNow], 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[SepAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[OctNow], 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[OctAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[NovNow], 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[NovAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[DecNow], 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($DSalesALL[DecAmtNow], 0, ',', '.');echo"</td>";
	
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($PaxALL, 0, ',', '.');echo"</td>
			 <td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($AmountALL, 0, ',', '.');echo"</td>
			 <td style='text-align:right;background-color: #000000; color:#FFFFFF;'>100 % </td>
			 <td style='text-align:right;background-color: #000000; color:#FFFFFF;'>100 % </td>
			 </tr></tbody></table><center><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('myDemoTable')></center>
					</div>
        			<div class='clear'></div></div>";
	break;
	
	
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX//	

case "dtlPOSPax":
	$MarketGet=$_GET[Market];
	$yer=$_GET[thn];

//Sales BSO
			$TotalJan=0;
			$TotalAmtJan=0;
			
			$TotalFeb=0;
			$TotalAmtFeb=0;
			
			$TotalMar=0;
			$TotalAmtMar=0;
			
			$TotalApr=0;
			$TotalAmtApr=0;
			
			$TotalMay=0;
			$TotalAmtMay=0;
			
			$TotalJun=0;
			$TotalAmtJun=0;
			
			$TotalJul=0;
			$TotalAmtJul=0;
			
			$TotalAgt=0;
			$TotalAmtAgt=0;
			
			$TotalSep=0;
			$TotalAmtSep=0;
			
			$TotalOct=0;
			$TotalAmtOct=0;
			
			$TotalNov=0;
			$TotalAmtNov=0;
			
			$TotalDec=0;
			$TotalAmtDec=0;
			
			$TotalAll=0;
			$TotalAmtAll=0;
			
	
//Sales BSO
if ($MarketGet=='BSO'){
	
	$QBSO=mssql_query("select * from Divisi where CompanyID=$CompanyID and District='JAKARTA' order by DivisiID");
		
		while($DBSO=mssql_fetch_array($QBSO)){
			 if ($Boso=='')
			  {
				$Boso="'$DBSO[DivisiID]'";
			  }
			  else
			  {
				$Boso=$Boso.",'$DBSO[DivisiID]'";
			  }
		}
		
		$SalesBSO =mysql_query("SELECT TCDivision,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctAmtNow ,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer),1,0)) as TotalNow , 
		  sum(if((year(DateTravelFrom) =$yer) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as TotalAmtNow 
		  FROM tour_msbookingdetail 
		  inner join 
		  (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,datetravelfrom 
		   from tour_msbooking 
		   inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
		   where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and TCCompanyId=$CompanyID and TCDivision in ($Boso) )tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL' group by TCDivision");
}else 
if ($MarketGet=='BOLK'){	
	
	
	//Sales BOLK

	$QBOLK=mssql_query("select * from Divisi where Active=1 and CompanyID=$CompanyID and District='NON JAKARTA' order by DivisiID");
	
	while($DBSO=mssql_fetch_array($QBOLK)){
			 if ($Boso=='')
			  {
				$Boso="'$DBSO[DivisiID]'";
			  }
			  else
			  {
				$Boso=$Boso.",'$DBSO[DivisiID]'";
			  }
		}
		
		
		$SalesBSO =mysql_query("SELECT TCDivision,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctAmtNow ,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer),1,0)) as TotalNow , 
		  sum(if((year(DateTravelFrom) =$yer) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as TotalAmtNow 
		  FROM tour_msbookingdetail 
		  inner join 
		  (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,datetravelfrom 
		   from tour_msbooking 
		   inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
		   where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and TCCompanyId=$CompanyID and TCDivision in ($Boso) )tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL' group by TCDivision");

		
		
		
}

else if ($MarketGet=='SA'){
	
	$QSISCOM=mssql_query("select * from Divisi where CompanyID<>$CompanyID and CompanyGroup<>'PANORAMA WORLD'  order by DivisiID");
		
		while($DBSO=mssql_fetch_array($QSISCOM)){
			 if ($Boso=='')
			  {
				$Boso="'$DBSO[DivisiID]'";
			  }
			  else
			  {
				$Boso=$Boso.",'$DBSO[DivisiID]'";
			  }
		}
		
		
		$SalesBSO =mysql_query("SELECT TCDivision,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctAmtNow ,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer),1,0)) as TotalNow , 
		  sum(if((year(DateTravelFrom) =$yer) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as TotalAmtNow 
		  FROM tour_msbookingdetail 
		  inner join 
		  (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,datetravelfrom 
		   from tour_msbooking 
		   inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
		   where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and tour_msproduct.CompanyId=$CompanyID and TCDivision in ($Boso) )tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL' group by TCDivision");
		
		
		
	
} else
if ($MarketGet=='PW'){
	
	$QPW=mssql_query("select * from Divisi where CompanyID<>$CompanyID and CompanyGroup='PANORAMA WORLD'  order by DivisiID");
	
	
	while($DBSO=mssql_fetch_array($QPW)){
			 if ($Boso=='')
			  {
				$Boso="'$DBSO[DivisiID]'";
			  }
			  else
			  {
				$Boso=$Boso.",'$DBSO[DivisiID]'";
			  }
		}
		
		
		$SalesBSO =mysql_query("SELECT TCDivision,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctAmtNow ,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer),1,0)) as TotalNow , 
		  sum(if((year(DateTravelFrom) =$yer) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as TotalAmtNow 
		  FROM tour_msbookingdetail 
		  inner join 
		  (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,datetravelfrom 
		   from tour_msbooking 
		   inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
		   where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and tour_msproduct.CompanyId=$CompanyID and TCDivision in ($Boso) )tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL' group by TCDivision");
	
}


 echo"<div class='outerbox'>
            <div class='innerbox'>
	 			<table class='bluetable' id='myDemoTable' cellpadding='0' cellspacing='0'>
	 				<thead>
			<tr><th>DIVISION</th><th colspan=2>JAN</th><th colspan=2>FEB</th><th colspan=2>MAR</th><th colspan=2>APR</th><th colspan=2>MAY</th><th colspan=2>JUN</th><th colspan=2>JUL</th><th colspan=2>AGT</th><th colspan=2>SEP</th><th colspan=2>OCT</th><th colspan=2>NOV</th><th colspan=2>DEC</th><th colspan=2>Total</th></tr></thead>
					<tr><td style='background-color: #000000; color:#FFFFFF'>&nbsp;</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td></tr><tbody>";

while ($DSalesBSO = mysql_fetch_array($SalesBSO))
{	

    echo"<tr><td><a href='?module=rptyearpos&act=dtlPOS&Div=$DSalesBSO[TCDivision]&thn=$yer&Type=$MarketGet'>$DSalesBSO[TCDivision]</a></td>";



         	 echo"<td style='text-align:right'>".number_format($DSalesBSO[JanNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[JanAmtNow], 0, ',', '.');echo"</td>";

			 echo"<td style='text-align:right'>".number_format($DSalesBSO[FebNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[FebAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[MarNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[MarAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[AprNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[AprAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[MayNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[MayAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[JunNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[JunAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[JulNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[JulAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[AgtNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[AgtAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[SepNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[SepAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[OctNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[OctAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[NovNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[NovAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[DecNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[DecAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[TotalNow], 0, ',', '.');echo"</td>
			<td style='text-align:right'>".number_format($DSalesBSO[TotalAmtNow], 0, ',', '.');echo"</td></tr>";

			$TotalJan=$TotalJan+$DSalesBSO[JanNow];
			$TotalAmtJan=$TotalAmtJan+$DSalesBSO[JanAmtNow];
			
			$TotalFeb=$Totalfeb+$DSalesBSO[FebNow];
			$TotalAmtFeb=$TotalAmtFeb+$DSalesBSO[FebAmtNow];
			
			$TotalMar=$TotalMar+$DSalesBSO[MarNow];
			$TotalAmtMar=$TotalAmtMar+$DSalesBSO[MarAmtNow];
			
			$TotalApr=$TotalApr+$DSalesBSO[AprNow];
			$TotalAmtApr=$TotalAmtApr+$DSalesBSO[AprAmtNow];
			
			$TotalMay=$TotalMay+$DSalesBSO[MayNow];
			$TotalAmtMay=$TotalAmtMay+$DSalesBSO[MayAmtNow];
			
			$TotalJun=$TotalJun+$DSalesBSO[JunNow];
			$TotalAmtJun=$TotalAmtJun+$DSalesBSO[JunAmtNow];
			
			$TotalJul=$TotalJul+$DSalesBSO[JulNow];
			$TotalAmtJul=$TotalAmtJul+$DSalesBSO[JulAmtNow];
			
			$TotalAgt=$TotalAgt+$DSalesBSO[AgtNow];
			$TotalAmtAgt=$TotalAmtAgt+$DSalesBSO[AgtAmtNow];
			
			$TotalSep=$TotalSep+$DSalesBSO[SepNow];
			$TotalAmtSep=$TotalAmtSep+$DSalesBSO[SepAmtNow];
			
			$TotalOct=$TotalOct+$DSalesBSO[OctNow];
			$TotalAmtOct=$TotalAmtOct+$DSalesBSO[OctAmtNow];
			
			$TotalNov=$TotalNov+$DSalesBSO[NovNow];
			$TotalAmtNov=$TotalAmtNov+$DSalesBSO[NovAmtNow];
			
			$TotalDec=$TotalDec+$DSalesBSO[DecNow];
			$TotalAmtDec=$TotalAmtDec+$DSalesBSO[DecAmtNow];
			
			$TotalAll=$TotalAll+$DSalesBSO[TotalNow];
			$TotalAmtAll=$TotalAmtAll+$DSalesBSO[TotalAmtNow];
			

}	
		
		echo"<tr><td style='background-color: #000000; color:#FFFFFF;'>Total</td>";
		
 			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalJan, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtJan, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalFeb, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtFeb, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalMar, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtMar, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalApr, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtApr, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalMay, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtMay, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalJun, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtJun, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalJul, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtJul, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAgt, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtAgt, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalSep, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtSep, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalOct, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtOct, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalNov, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtNov, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalDec, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtDec, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAll, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtAll, 0, ',', '.');echo"</td>";

	 echo"</tr></tbody></table><center><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('myDemoTable')></center></div>
        			<div class='clear'></div></div>
					<br><center><input type=button value=Close onclick=self.history.back()><br><br>"; 
	break;



 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
case "dtlPOS":

	$Div=$_GET[Div];
	$MarketGet=$_GET[Type];
	$yer=$_GET[thn];
	
	if ($MarketGet=='PW' or $MarketGet=='SA'){

		$SalesBSO =mysql_query("SELECT TCName,TCDivision,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctAmtNow ,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer),1,0)) as TotalNow , 
		  sum(if((year(DateTravelFrom) =$yer) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as TotalAmtNow 
		  FROM tour_msbookingdetail 
		  inner join 
		  (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,datetravelfrom ,TCName
		   from tour_msbooking 
		   inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
		   where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and tour_msproduct.CompanyId=$CompanyID and TCDivision ='$Div' )tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by TCName");
	
} else
{
	$SalesBSO =mysql_query("SELECT TCName,TCDivision,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctAmtNow ,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer),1,0)) as TotalNow , 
		  sum(if((year(DateTravelFrom) =$yer) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as TotalAmtNow 
		  FROM tour_msbookingdetail 
		  inner join 
		  (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,datetravelfrom ,TCName
		   from tour_msbooking 
		   inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
		   where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and TCCompanyId=$CompanyID and TCDivision ='$Div' )tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by TCName");
}


 echo"<div class='outerbox'>
            <div class='innerbox'>
	 			<table class='bluetable' id='myDemoTable' cellpadding='0' cellspacing='0'>
	 				<thead>
			<tr><th>TC NAME</th><th colspan=2>JAN</th><th colspan=2>FEB</th><th colspan=2>MAR</th><th colspan=2>APR</th><th colspan=2>MAY</th><th colspan=2>JUN</th><th colspan=2>JUL</th><th colspan=2>AGT</th><th colspan=2>SEP</th><th colspan=2>OCT</th><th colspan=2>NOV</th><th colspan=2>DEC</th><th colspan=2>Total</th></tr></thead>
					<tr><td style='background-color: #000000; color:#FFFFFF'>&nbsp;</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td><td style='background-color: #000000; color:#FFFFFF'>Pax</td><td style='background-color: #000000; color:#FFFFFF'>Amount</td></tr><tbody>";
		  
while ($DSalesBSO = mysql_fetch_array($SalesBSO))
{	

    echo"<tr><td><a href='?module=rptyearpos&act=dtlPOSTcDest&Div=$DSalesBSO[TCDivision]&thn=$yer&Type=$MarketGet&TCName=$DSalesBSO[TCName]'>$DSalesBSO[TCName]</a></td>";



         	 echo"<td style='text-align:right'>".number_format($DSalesBSO[JanNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[JanAmtNow], 0, ',', '.');echo"</td>";

			 echo"<td style='text-align:right'>".number_format($DSalesBSO[FebNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[FebAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[MarNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[MarAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[AprNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[AprAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[MayNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[MayAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[JunNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[JunAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[JulNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[JulAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[AgtNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[AgtAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[SepNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[SepAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[OctNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[OctAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[NovNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[NovAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[DecNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[DecAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[TotalNow], 0, ',', '.');echo"</td>
			<td style='text-align:right'>".number_format($DSalesBSO[TotalAmtNow], 0, ',', '.');echo"</td></tr>";

			$TotalJan=$TotalJan+$DSalesBSO[JanNow];
			$TotalAmtJan=$TotalAmtJan+$DSalesBSO[JanAmtNow];
			
			$TotalFeb=$Totalfeb+$DSalesBSO[FebNow];
			$TotalAmtFeb=$TotalAmtFeb+$DSalesBSO[FebAmtNow];
			
			$TotalMar=$TotalMar+$DSalesBSO[MarNow];
			$TotalAmtMar=$TotalAmtMar+$DSalesBSO[MarAmtNow];
			
			$TotalApr=$TotalApr+$DSalesBSO[AprNow];
			$TotalAmtApr=$TotalAmtApr+$DSalesBSO[AprAmtNow];
			
			$TotalMay=$TotalMay+$DSalesBSO[MayNow];
			$TotalAmtMay=$TotalAmtMay+$DSalesBSO[MayAmtNow];
			
			$TotalJun=$TotalJun+$DSalesBSO[JunNow];
			$TotalAmtJun=$TotalAmtJun+$DSalesBSO[JunAmtNow];
			
			$TotalJul=$TotalJul+$DSalesBSO[JulNow];
			$TotalAmtJul=$TotalAmtJul+$DSalesBSO[JulAmtNow];
			
			$TotalAgt=$TotalAgt+$DSalesBSO[AgtNow];
			$TotalAmtAgt=$TotalAmtAgt+$DSalesBSO[AgtAmtNow];
			
			$TotalSep=$TotalSep+$DSalesBSO[SepNow];
			$TotalAmtSep=$TotalAmtSep+$DSalesBSO[SepAmtNow];
			
			$TotalOct=$TotalOct+$DSalesBSO[OctNow];
			$TotalAmtOct=$TotalAmtOct+$DSalesBSO[OctAmtNow];
			
			$TotalNov=$TotalNov+$DSalesBSO[NovNow];
			$TotalAmtNov=$TotalAmtNov+$DSalesBSO[NovAmtNow];
			
			$TotalDec=$TotalDec+$DSalesBSO[DecNow];
			$TotalAmtDec=$TotalAmtDec+$DSalesBSO[DecAmtNow];
			
			$TotalAll=$TotalAll+$DSalesBSO[TotalNow];
			$TotalAmtAll=$TotalAmtAll+$DSalesBSO[TotalAmtNow];
			

}	
		
		echo"<tr><td style='background-color: #000000; color:#FFFFFF;'>Total</td>";
		
 			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalJan, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtJan, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalFeb, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtFeb, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalMar, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtMar, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalApr, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtApr, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalMay, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtMay, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalJun, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtJun, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalJul, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtJul, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAgt, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtAgt, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalSep, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtSep, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalOct, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtOct, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalNov, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtNov, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalDec, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtDec, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAll, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtAll, 0, ',', '.');echo"</td>";

	 echo"</tr></tbody></table></div>
        			<div class='clear'></div></div>
					<br><center><input type=button value=Close onclick=self.history.back()><br><br>"; 






	break;
		

case "dtlPOSTcDest":
	$TCName=$_GET[TCName];
	$MarketGet=$_GET[Type];
	$Div=$_GET[Div];
	$yer=$_GET[thn];

if ($MarketGet=='PW' or $MarketGet=='SA'){
		
		
		$SalesBSO =mysql_query("SELECT Destination,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctAmtNow ,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer),1,0)) as TotalNow , 
		  sum(if((year(DateTravelFrom) =$yer) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as TotalAmtNow 
		  FROM tour_msbookingdetail 
		  inner join 
		  (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,datetravelfrom ,TCName
		   from tour_msbooking 
		   inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
		   where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and tour_msproduct.CompanyId=$CompanyID and TCDivision ='$Div' and TCName='$TCName' )tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by Destination");
	
} else
{
	$SalesBSO =mysql_query("SELECT Destination,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctAmtNow ,
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecAmtNow ,
		    sum(if((year(DateTravelFrom) =$yer),1,0)) as TotalNow , 
		  sum(if((year(DateTravelFrom) =$yer) ,(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only' and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as TotalAmtNow 
		  FROM tour_msbookingdetail 
		  inner join 
		  (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,datetravelfrom ,TCName
		   from tour_msbooking 
		   inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
		   where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and TCCompanyId=$CompanyID and TCDivision ='$Div' and TCName='$TCName')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by Destination");
}  
		  
 echo"<div class='outerbox'>
            <div class='innerbox'>
	 			<table class='bluetable' id='myDemoTable' cellpadding='0' cellspacing='0'>
	 				<thead>
			<tr><th>DESTINATION</th><th colspan=2>JAN</th><th colspan=2>FEB</th><th colspan=2>MAR</th><th colspan=2>APR</th><th colspan=2>MAY</th><th colspan=2>JUN</th><th colspan=2>JUL</th><th colspan=2>AGT</th><th colspan=2>SEP</th><th colspan=2>OCT</th><th colspan=2>NOV</th><th colspan=2>DEC</th><th colspan=2>Total</th></tr></thead>

					<tr><th></th>
					<th>Pax</th>
					<th>Amount</th>
					<th>Pax</th>
					<th>Amount</th>
					<th>Pax</th>
					<th>Amount</th>
					<th>Pax</th>
					<th>Amount</th>
					<th>Pax</th>
					<th>Amount</th>
					<th>Pax</th>
					<th>Amount</th>
					<th>Pax</th>
					<th>Amount</th>
					<th>Pax</th>
					<th>Amount</th>
					<th>Pax</th>
					<th>Amount</th>
					<th>Pax</th>
					<th>Amount</th>
					<th>Pax</th>
					<th>Amount</th>
					<th>Pax</th>
					<th>Amount</th>
					<th>Pax</th>
					<th>Amount</th>
					</tr><tbody>";
		  
while ($DSalesBSO = mysql_fetch_array($SalesBSO))
{	

    echo"<tr><td>$DSalesBSO[Destination]</a></td>";



         	 echo"<td style='text-align:right'>".number_format($DSalesBSO[JanNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[JanAmtNow], 0, ',', '.');echo"</td>";

			 echo"<td style='text-align:right'>".number_format($DSalesBSO[FebNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[FebAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[MarNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[MarAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[AprNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[AprAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[MayNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[MayAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[JunNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[JunAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[JulNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[JulAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[AgtNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[AgtAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[SepNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[SepAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[OctNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[OctAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[NovNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[NovAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[DecNow], 0, ',', '.');
			 echo"</td><td style='text-align:right'>".number_format($DSalesBSO[DecAmtNow], 0, ',', '.');echo"</td>";
			 
			 echo"<td style='text-align:right'>".number_format($DSalesBSO[TotalNow], 0, ',', '.');echo"</td>
			<td style='text-align:right'>".number_format($DSalesBSO[TotalAmtNow], 0, ',', '.');echo"</td></tr>";

			$TotalJan=$TotalJan+$DSalesBSO[JanNow];
			$TotalAmtJan=$TotalAmtJan+$DSalesBSO[JanAmtNow];
			
			$TotalFeb=$Totalfeb+$DSalesBSO[FebNow];
			$TotalAmtFeb=$TotalAmtFeb+$DSalesBSO[FebAmtNow];
			
			$TotalMar=$TotalMar+$DSalesBSO[MarNow];
			$TotalAmtMar=$TotalAmtMar+$DSalesBSO[MarAmtNow];
			
			$TotalApr=$TotalApr+$DSalesBSO[AprNow];
			$TotalAmtApr=$TotalAmtApr+$DSalesBSO[AprAmtNow];
			
			$TotalMay=$TotalMay+$DSalesBSO[MayNow];
			$TotalAmtMay=$TotalAmtMay+$DSalesBSO[MayAmtNow];
			
			$TotalJun=$TotalJun+$DSalesBSO[JunNow];
			$TotalAmtJun=$TotalAmtJun+$DSalesBSO[JunAmtNow];
			
			$TotalJul=$TotalJul+$DSalesBSO[JulNow];
			$TotalAmtJul=$TotalAmtJul+$DSalesBSO[JulAmtNow];
			
			$TotalAgt=$TotalAgt+$DSalesBSO[AgtNow];
			$TotalAmtAgt=$TotalAmtAgt+$DSalesBSO[AgtAmtNow];
			
			$TotalSep=$TotalSep+$DSalesBSO[SepNow];
			$TotalAmtSep=$TotalAmtSep+$DSalesBSO[SepAmtNow];
			
			$TotalOct=$TotalOct+$DSalesBSO[OctNow];
			$TotalAmtOct=$TotalAmtOct+$DSalesBSO[OctAmtNow];
			
			$TotalNov=$TotalNov+$DSalesBSO[NovNow];
			$TotalAmtNov=$TotalAmtNov+$DSalesBSO[NovAmtNow];
			
			$TotalDec=$TotalDec+$DSalesBSO[DecNow];
			$TotalAmtDec=$TotalAmtDec+$DSalesBSO[DecAmtNow];
			
			$TotalAll=$TotalAll+$DSalesBSO[TotalNow];
			$TotalAmtAll=$TotalAmtAll+$DSalesBSO[TotalAmtNow];
			

}	
		
		echo"<tr><td style='background-color: #000000; color:#FFFFFF;'>Total</td>";
		
 			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalJan, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtJan, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalFeb, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtFeb, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalMar, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtMar, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalApr, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtApr, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalMay, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtMay, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalJun, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtJun, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalJul, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtJul, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAgt, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtAgt, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalSep, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtSep, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalOct, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtOct, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalNov, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtNov, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalDec, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtDec, 0, ',', '.');echo"</td>";
			 echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAll, 0, ',', '.');
			 echo"</td><td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($TotalAmtAll, 0, ',', '.');echo"</td>";

	 echo"</tr></tbody></table></div>
        			<div class='clear'></div></div>
					<br><center><input type=button value=Close onclick=self.history.back()><br><br>"; 
break;

 }        
?>
