
<SCRIPT LANGUAGE="Javascript" SRC="FusionChartsXT/Code/FusionCharts/FusionCharts.js"></SCRIPT>
<link href="./css/fixedheadertable.css" rel="stylesheet" media="screen" />
<link href="./css/custom.css" rel="stylesheet" media="screen" />
<!--<script src="./js/jquery-1.7.2.min.js"></script>-->
<script src="./js/jquery.fixedheadertable.js"></script>

<script type="text/javascript">
    function generateexcel(tableid) {
            var table= document.getElementById(tableid);
            var html = table.outerHTML;
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
        }
	$(document).ready(function() {
		$('#myDemoTable').fixedHeaderTable({
			altClass : 'odd',
			footer : true,
			fixedColumns : 2
		});
	});
	
	
	$(document).ready(function() {
		$('#DetailDepartment').fixedHeaderTable({
			altClass : 'odd',
			footer : true,
			fixedColumns : 2
		});
	});

</script>
<?php
$CompanyID=$_SESSION['company_id'];
switch($_GET[act]){
  // Tampilan header
   default:
    $thnini = date("Y");
    $yer=$_GET['year'];
    if($yer==''){$yer=$thnini;}
	$type=$_GET['Type'];
	if($type==''){$type='Pax';}
    
    echo "<h2>Report by Department</h2>
			   	
    <form method='get' action='media.php?'><input type=hidden name=module value='rptyeardept'>   
		      
    Year  &nbsp;:  <select name='year' ><option value='0' >- Select Year -</option>";
    $tampil=mysql_query("SELECT Year FROM tour_msproduct where year <>'' and CompanyID=$CompanyID group BY Year asc");
            while($s=mysql_fetch_array($tampil)){  // <input type='button' value='Cek Seat' onclick=ceking() >
               if($yer==$s[Year]){
                    echo "<option value='$s[Year]' selected>$s[Year]</option>";     
                }else { 
                echo "<option value='$s[Year]' >$s[Year]</option>";
                } 
            }
			
    echo "</select><br>
		  Type : <select name='Type' >";
	 		if($type==Pax){echo"<option value='Pax' selected>Pax</option>";}else{echo"<option value='Pax' >Pax</option>";}
      		if($type==Amt){echo"<option value='Amt' selected>Amount</option></select>&nbsp;&nbsp;&nbsp;";}else{echo"<option value='Amt' >Amount</option></select>&nbsp;&nbsp;&nbsp;";}
	 echo "<input type=submit name='submit' size='20'value='View'>
          </form>";
          $oke=$_GET['oke'];	
	$Lastyear = $yer-1;	  
	
	echo "<h><u>Report Department Period  $Lastyear  VS  $yer </u></h><br>";	
if($type=='Pax'){echo"Base on Total Pax";}else{echo"Base on Total Amount";}

	$Dept=mysql_query("SELECT * from tour_msproducttype where status='ACTIVE'");
		
		 
		 
		 $JumDept = mysql_num_rows($Dept);
		 
		 
	if ($JumDept> 0){   

  //munculin table
	 $No=1;
	 $Total=0;
	 $kolom=1;
	
	echo" <div class='outerbox'>
            <div class='innerbox'>
	 			<table class='bluetable' id='myDemoTable' cellpadding='0' cellspacing='0'>
	 				<thead>
			<tr><th>No</th><th>Department</th><th colspan=3>JAN</th><th colspan=3>FEB</th><th colspan=3>MAR</th><th colspan=3>APR</th><th colspan=3>MAY</th><th colspan=3>JUN</th><th colspan=3>JUL</th><th colspan=3>AGT</th><th colspan=3>SEP</th><th colspan=3>OCT</th><th colspan=3>NOV</th><th colspan=3>DEC</th><th colspan=4>TOTAL</th></tr></thead><tbody>
			<tr><td style='background-color: #000000; color:#FFFFFF'></td><td style='background-color: #000000; color:#FFFFFF;'></td><td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td>
					<td style='background-color: #000000; color:#FFFFFF'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td>
					<td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td>
					<td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td>
					<td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td>
					<td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td>
					<td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$Lastyear</b></td><td style='background-color: #000000; color:#FFFFFF;'><b>$yer</b></td><td style='background-color: #000000; color:#FFFFFF;'><b><center>%</center></b></td></tr>";


     if($type=='Pax'){
			
		$strQuerytable =mysql_query("SELECT Department,month(DateTravelFrom) as bulan,sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,1,0)) as TotalLast FROM tour_msbookingdetail inner join (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and (TCCompanyID=$CompanyID or CompanyID=$CompanyID))tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL' group by Department,bulan order by Department,bulan");
	
		
		$JumTransaction = mysql_num_rows($strQuerytable);
		
		if ($JumTransaction > 0){
		      $Departmentawal='';
			  
		
			while($DestinationTable = mysql_fetch_array($strQuerytable))
			{
			
			
				if($kolom<=13 and $Departmentawal <>'' and $DestinationTable[Department]<> $Departmentawal){	
					  $loop=13-$kolom;
					  for($i=1;$i<=$loop;$i++)
					  {
						  echo"<td style='text-align:right'>0</td>
							   <td style='text-align:right'>0</td>
							   <td style='text-align:right;$warnaminus'> 0 % </td>";
							 $kolom++;}
				}
							 
			
			if($DestinationTable[Department]<> $Departmentawal){
				if($Departmentawal<>''){
				echo"<td style='text-align:right'>".number_format($LastTotal, 0, ',', '.');echo"</td>
							<td style='text-align:right'>".number_format($Total, 0, ',', '.');echo"</td>";
					if ($Total<$LastTotal){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}		
					echo"<td style='text-align:right;$warnaminus'>".number_format(($Total/$LastTotal*100), 0, ',', '.'); echo"% </td>";
					echo"</tr>";	
					$No++;	}
			
				$Total=0;
				$LastTotal=0;
                $kolom=1;
				if($DestinationTable[Department]=="LEISURE"){$WarnaDep='#FD7304';}
				 if($DestinationTable[Department]=="TUR EZ"){$WarnaDep='#16C53F';}
				 if($DestinationTable[Department]=="MINISTRY"){$WarnaDep='#FC0101';}
				 if($DestinationTable[Department]=="DRY TICKET"){$WarnaDep='#FAF704';}
				 if($DestinationTable[Department]=="TMR"){$WarnaDep='#0882FF';}
		 
				
 			 echo "<tr>
			  <td bgcolor='$WarnaDep';>$No</td>
			 <td bgcolor='$WarnaDep';><a href='?module=rptyeardept&act=showdetails&Dept=$DestinationTable[Department]&thn=$yer&type=$type'>$DestinationTable[Department]</a> </td>";
				
						$kolom=1;
						$Departmentawal=$DestinationTable[Department];
		
			 }
				
				
	
			
			if($kolom < $DestinationTable[bulan]){
				  $loop=$DestinationTable[bulan]-$kolom;
				  for($i=1;$i<=$loop;$i++)
				  {
					  echo"<td style='text-align:right'>0</td>
						   <td style='text-align:right'>0</td>
						   <td style='text-align:right;$warnaminus'> 0 % </td>";
						 $kolom++;}
			}
			
			
			if($DestinationTable[bulan]== $kolom ){
					if ($DestinationTable[TotalNow]=='0'){$increase='0';}else {$increase=$DestinationTable[TotalNow]/$DestinationTable[TotalLast]*100;						
						}
					if ($increase<100){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}
							
					echo"<td style='text-align:right'>".number_format($DestinationTable[TotalLast], 0, ',', '.');echo"</td>
					<td style='text-align:right'>".number_format($DestinationTable[TotalNow], 0, ',', '.');echo"</td>
					<td style='text-align:right;$warnaminus'>".number_format($increase, 0, ',', '.'); echo"% </td>";
					$Total=$Total+$DestinationTable[TotalNow];
					$LastTotal=$LastTotal+$DestinationTable[TotalLast];	
					$Totalall[$DestinationTable[bulan]]=$Totalall[$DestinationTable[bulan]]+$DestinationTable[TotalNow];
					$LastTotalall[$DestinationTable[bulan]]=$LastTotalall[$DestinationTable[bulan]]+$DestinationTable[TotalLast];
					$kolom++;}						
			 		
	  
	    }
		if($kolom<=13){	
					  $loop=13-$kolom;
					  for($i=1;$i<=$loop;$i++)
					  {
						  echo"<td style='text-align:right'>0</td>
							   <td style='text-align:right'>0</td>
							   <td style='text-align:right;$warnaminus'> 0 % </td>";
							 $kolom++;}
							 
				echo"<td style='text-align:right'>".number_format($LastTotal, 0, ',', '.');echo"</td>
					<td style='text-align:right'>".number_format($Total, 0, ',', '.');echo"</td>";
			if ($Total<$LastTotal){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}		
			echo"<td style='text-align:right;$warnaminus'>".number_format(($Total/$LastTotal*100), 0, ',', '.'); echo"% </td>";
			echo"</tr>";			
		
		}
	}
    }
	
		else
	
		{
		
		
	//base on amount	
		
	
		$i=1;
		while($DDepartment=mysql_fetch_array($Dept))
		{$Department[$i]=$DDepartment[ProducttypeName];
		if($Department[$i]=="LEISURE"){$WarnaDep[$i]='#FD7304';}
		 if($Department[$i]=="TUR EZ"){$WarnaDep[$i]='#16C53F';}
		 if($Department[$i]=="MINISTRY"){$WarnaDep[$i]='#FC0101';}
		 if($Department[$i]=="DRY TICKET"){$WarnaDep[$i]='#FAF704';}
		 if($Department[$i]=="TMR"){$WarnaDep[$i]='#0882FF';}
		 $i++;}
		

		
	for($j=1;$j<$i;$j++){
       echo "<tr>
			  <td bgcolor='$WarnaDep[$j]';>$No</td>
			 <td bgcolor='$WarnaDep[$j]';><a href='?module=rptyeardept&act=showdetails&Dept=$Department[$j]&Cat=Amt&thn=$yer&type=$type'>$Department[$j]</a></td>";
	 
	$Total=0;
	$LastTotal=0;

					 
	for ($bln=1;$bln<=12;$bln++)
	{		
		
		 
	$strQuerytable =mysql_query("SELECT sum(
			if((year(DateTravelFrom)=$yer),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0))
			 as TotalNow,sum(if((year(DateTravelFrom)=$Lastyear),
			(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0))  as TotalLast  FROM tour_msbookingdetail inner join (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and month(DateTravelFrom)=$bln and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and tour_msproduct.Department = '$Department[$j]' and Dummy='NO' and (TCCompanyID=$CompanyID or CompanyID=$CompanyID))tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL' group by Department");
			
			
				$DestinationTable = mysql_fetch_array($strQuerytable);
					
				
				
					if ($DestinationTable[TotalNow]=='0'){$increase='0';}else {$increase=$DestinationTable[TotalNow]/$DestinationTable[TotalLast]*100;}
						if ($increase<100){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}
								
						echo"<td style='text-align:right'>".number_format($DestinationTable[TotalLast], 0, ',', '.');echo"</td>
						<td style='text-align:right'>".number_format($DestinationTable[TotalNow], 0, ',', '.');echo"</td>
						<td style='text-align:right;$warnaminus'>".number_format($increase, 0, ',', '.'); echo"% </td>";
						$Total=$Total+$DestinationTable[TotalNow];
						$LastTotal=$LastTotal+$DestinationTable[TotalLast];	
						$Totalall[$bln]=$Totalall[$bln]+$DestinationTable[TotalNow];
						$LastTotalall[$bln]=$LastTotalall[$bln]+$DestinationTable[TotalLast];					
				
			   
			 }	
			
			echo"<td style='text-align:right'>".number_format($LastTotal, 0, ',', '.');echo"</td>
				<td style='text-align:right'>".number_format($Total, 0, ',', '.');echo"</td>";
		if ($Total<$LastTotal){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}		
		echo"<td style='text-align:right;$warnaminus'>".number_format(($Total/$LastTotal*100), 0, ',', '.'); echo"% </td>";
		echo"</tr>";		
		$No++;
	
		}
		
	}
	


	
		//Total keseluruhan
	 echo "<tr>
 <td colspan=2 style='background-color: #000000; color:#FFFFFF;'><center><b>Total</b></center></td>";
	 
						 
	for ($i=1;$i<=12;$i++)
	{
	
				if ($Totalall[$i]=='0'){$increase='0';}else {$increase=$Totalall[$i]/$LastTotalall[$i]*100;}
				if ($increase<100){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}
						
				echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($LastTotalall[$i], 0, ',', '.');echo"</td>
				<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($Totalall[$i], 0, ',', '.');echo"</td>
				<td style='text-align:right;$warnaminus;background-color: #000000; color:#FFFFFF;'>".number_format($increase, 0, ',', '.'); echo"% </td>";
				$sumTotal=$sumTotal+$Totalall[$i];
				$sumLastTotal=$sumLastTotal+$LastTotalall[$i];				
	 }	
			echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($sumLastTotal, 0, ',', '.');echo"</td>
				<td style='text-align:right;;background-color: #000000; color:#FFFFFF;'>".number_format($sumTotal, 0, ',', '.');echo"</td>";
		if ($sumTotal<$sumLastTotal){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}		
		echo"<td style='text-align:right;$warnaminus;background-color: #000000; color:#FFFFFF;'>".number_format(($sumTotal/$sumLastTotal*100), 0, ',', '.'); echo"% </td></tr></tbody></table>
					</div>
        			<div class='clear'></div></div>
        <center><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('myDemoTable')></center>";
	}
		
	else	
	{ echo "NO TRANSACTION AVAILABLE IN $yer";
	} 
  
    break;   
	   

	
	//details
	case "showdetails":
	
	
	$yer=$_GET['thn'];
	$type=$_GET['type'];
    $Dept=$_GET['Dept'];
	$Lastyear=$yer-1;
	
	if($TDetail==''){$TDetail='ProductCode';}else{$TDetail=$TDetail;}
    
    echo "<h2>Report by Department - $Dept <br>
			  Period : $yer </h2>";
	
	 $No=1;
	 $Total=0;
	 $kolom=1;
	
	echo" <div class='outerbox'>
            <div class='innerbox'>
	 			<table class='bluetable' id='DetailDepartment' cellpadding='0' cellspacing='0'>
	 				<thead>
			<tr><th>No</th><th>Division</th><th colspan=3>JAN</th><th colspan=3>FEB</th><th colspan=3>MAR</th><th colspan=3>APR</th><th colspan=3>MAY</th><th colspan=3>JUN</th><th colspan=3>JUL</th><th colspan=3>AGT</th><th colspan=3>SEP</th><th colspan=3>OCT</th><th colspan=3>NOV</th><th colspan=3>DEC</th><th colspan=4>TOTAL</th></tr></thead><tbody>
			<tr><td style='background-color: #000000; color:#FFFFFF;width:5px;'>&nbsp;</td><td style='background-color: #000000; color:#FFFFFF;width:25px;'></td>&nbsp;<td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</td><td style='background-color: #000000; color:#FFFFFF'>$yer</td><td style='background-color: #000000; color:#FFFFFF'>%</td></tr>";


     if($type=='Pax'){
		$strQuerytable =mysql_query("SELECT TCDivision,month(DateTravelFrom) as bulan,sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,1,0)) as TotalLast FROM tour_msbookingdetail inner join (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and (TCCompanyID=$CompanyID or CompanyID=$CompanyID))tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL' and Department='$Dept' group by TCDivision,bulan order by TCDivision,bulan");
	
		
		$JumTransaction = mysql_num_rows($strQuerytable);
		
		if ($JumTransaction > 0){
		      $Divisi='';
			  
		
			while($QueryDivisi = mysql_fetch_array($strQuerytable))
			{
			
			
				if($kolom<=13 and $Divisi <>'' and $QueryDivisi[TCDivision]<> $Divisi){	
					  $loop=13-$kolom;
					  for($i=1;$i<=$loop;$i++)
					  {
						  echo"<td style='text-align:right'>0</td>
							   <td style='text-align:right'>0</td>
							   <td style='text-align:right;$warnaminus'> 0 % </td>";
							 $kolom++;}
				}
							 
			
			if($QueryDivisi[TCDivision]<> $Divisi){
				if($Divisi<>''){
				echo"<td style='text-align:right'>".number_format($LastTotal, 0, ',', '.');echo"</td>
							<td style='text-align:right'>".number_format($Total, 0, ',', '.');echo"</td>";
					if ($Total<$LastTotal){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}		
					echo"<td style='text-align:right;$warnaminus'>".number_format(($Total/$LastTotal*100), 0, ',', '.'); echo"% </td>";
					echo"</tr>";	
					$No++;	}
			
				$Total=0;
				$LastTotal=0;
                $kolom=1;
				
 			 echo "<tr>
			  <td>$No</td>
			 <td>$QueryDivisi[TCDivision] </td>";
				
						$kolom=1;
						$Divisi=$QueryDivisi[TCDivision];
		
			 }
				
				
	
			
			if($kolom < $QueryDivisi[bulan]){
				  $loop=$QueryDivisi[bulan]-$kolom;
				  for($i=1;$i<=$loop;$i++)
				  {
					  echo"<td style='text-align:right'>0</td>
						   <td style='text-align:right'>0</td>
						   <td style='text-align:right;$warnaminus'> 0 % </td>";
						 $kolom++;}
			}

			
			
			if($QueryDivisi[bulan]== $kolom ){
					if ($QueryDivisi[TotalNow]=='0'){$increase='0';}else {$increase=$QueryDivisi[TotalNow]/$QueryDivisi[TotalLast]*100;						
						}
					if ($increase<100){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}
							
					echo"<td style='text-align:right'>".number_format($QueryDivisi[TotalLast], 0, ',', '.');echo"</td>
					<td style='text-align:right'>".number_format($QueryDivisi[TotalNow], 0, ',', '.');echo"</td>
					<td style='text-align:right;$warnaminus'>".number_format($increase, 0, ',', '.'); echo"% </td>";
					$Total=$Total+$QueryDivisi[TotalNow];
					$LastTotal=$LastTotal+$QueryDivisi[TotalLast];	
					$Totalall[$QueryDivisi[bulan]]=$Totalall[$QueryDivisi[bulan]]+$QueryDivisi[TotalNow];
					$LastTotalall[$QueryDivisi[bulan]]=$LastTotalall[$QueryDivisi[bulan]]+$QueryDivisi[TotalLast];
					$kolom++;}						
			 		
	  
	    }
		if($kolom<=13){	
					  $loop=13-$kolom;
					  for($i=1;$i<=$loop;$i++)
					  {
						  echo"<td style='text-align:right'>0</td>
							   <td style='text-align:right'>0</td>
							   <td style='text-align:right;$warnaminus'> 0 % </td>";
							 $kolom++;}
							 
				echo"<td style='text-align:right'>".number_format($LastTotal, 0, ',', '.');echo"</td>
					<td style='text-align:right'>".number_format($Total, 0, ',', '.');echo"</td>";
			if ($Total<$LastTotal){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}		
			echo"<td style='text-align:right;$warnaminus'>".number_format(($Total/$LastTotal*100), 0, ',', '.'); echo"% </td>";
			echo"</tr>";			
		
		}
	}
    }
	
	else

	{
		
		
	//base on amount	
		
$strQueryDivisi =mysql_query("Select TCDivision from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and (TCCompanyID=$CompanyID or CompanyID=$CompanyID) and Department='$Dept' group by TCDivision order by TCDivision");
	
		$JumTransaction = mysql_num_rows($strQueryDivisi);
		
		if ($JumTransaction > 0){
	
		while($QueryDivisi = mysql_fetch_array($strQueryDivisi))
		{
       echo "<tr>
			  <td>$No</td>
			 <td>$QueryDivisi[TCDivision]</td>";
	 
	$Total=0;
	$LastTotal=0;


							 
			for ($bln=1;$bln<=12;$bln++)
			{		
				
				 
			$strQuerytable =mysql_query("SELECT sum(
					if((year(DateTravelFrom)=$yer),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as TotalNow,sum(if((year(DateTravelFrom)=$Lastyear),
					(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0))  as TotalLast  FROM tour_msbookingdetail inner join (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and month(DateTravelFrom)=$bln and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear) and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and tour_msproduct.Department = '$Dept' and Dummy='NO' and (TCCompanyID=$CompanyID or CompanyID=$CompanyID))tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL' and TCDivision='$QueryDivisi[TCDivision]'");
					
			
				$DestinationTable = mysql_fetch_array($strQuerytable);
					
				
				
					if ($DestinationTable[TotalNow]=='0'){$increase='0';}else {$increase=$DestinationTable[TotalNow]/$DestinationTable[TotalLast]*100;}
						if ($increase<100){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}
								
						echo"<td style='text-align:right'>".number_format($DestinationTable[TotalLast], 0, ',', '.');echo"</td>
						<td style='text-align:right'>".number_format($DestinationTable[TotalNow], 0, ',', '.');echo"</td>
						<td style='text-align:right;$warnaminus'>".number_format($increase, 0, ',', '.'); echo"% </td>";
						$Total=$Total+$DestinationTable[TotalNow];
						$LastTotal=$LastTotal+$DestinationTable[TotalLast];	
						$Totalall[$bln]=$Totalall[$bln]+$DestinationTable[TotalNow];
						$LastTotalall[$bln]=$LastTotalall[$bln]+$DestinationTable[TotalLast];					
				
			   
			 }	
			
			echo"<td style='text-align:right'>".number_format($LastTotal, 0, ',', '.');echo"</td>
				<td style='text-align:right'>".number_format($Total, 0, ',', '.');echo"</td>";
		if ($Total<$LastTotal){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}		
		echo"<td style='text-align:right;$warnaminus'>".number_format(($Total/$LastTotal*100), 0, ',', '.'); echo"% </td>";
		echo"</tr>";		
		$No++;
	
		
		
	}
	
	}

	}
		//Total keseluruhan
	 echo "<tr>
 <td colspan=2 style='background-color: #000000; color:#FFFFFF;'><center><b>Total</b></center></td>";
	 
						 
	for ($i=1;$i<=12;$i++)
	{
	
				if ($Totalall[$i]=='0'){$increase='0';}else {$increase=$Totalall[$i]/$LastTotalall[$i]*100;}
				if ($increase<100){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}
						
				echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($LastTotalall[$i], 0, ',', '.');echo"</td>
				<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($Totalall[$i], 0, ',', '.');echo"</td>
				<td style='text-align:right;$warnaminus;background-color: #000000; color:#FFFFFF;'>".number_format($increase, 0, ',', '.'); echo"% </td>";
				$sumTotal=$sumTotal+$Totalall[$i];
				$sumLastTotal=$sumLastTotal+$LastTotalall[$i];				
	 }	
			echo"<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($sumLastTotal, 0, ',', '.');echo"</td>
				<td style='text-align:right;background-color: #000000; color:#FFFFFF;'>".number_format($sumTotal, 0, ',', '.');echo"</td>";
		if ($sumTotal<$sumLastTotal){$warnaminus="COLOR:Red;";}else{$warnaminus="COLOR:black";}		
		echo"<td style='text-align:right;$warnaminus;background-color: #000000; color:#FFFFFF;'>".number_format(($sumTotal/$sumLastTotal*100), 0, ',', '.'); echo"% </td>";
		echo"</tr></tbody></table>
					</div>
        			<div class='clear'></div></div><br><center><input type=button value=Close onclick=self.history.back()><br>";

		
	break;

 }        
?>
