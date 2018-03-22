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
   	$CompanyID=$_SESSION['company_id'];
    $blnini = date("m");
    $thnini = date("Y");
    $mont=$_GET['bulan'];
    $yer=$_GET['year'];
	$Div=$_GET['BOSO'];
	$Gtype=$_GET['GroupType'];
    $grup=$_GET['grup']; 
    if($mont==''){$mont=$blnini;}
    if($yer==''){$yer=$thnini;}
    if($Div==''){$Div='ALL';}else{$Div=$Div;}
	if($Gtype==''){$Gtype='ALL';}else{$Gtype=$Gtype;}
   echo "<style>
			table
			{
				border-collapse: collapse;
				width: 770px;
			}
			thead
			{
				display: block;
				overflow: auto;
				color: #fff;
				background: #000;
			}
			thead th
			{
				text-align: center;
			}
			tbody
			{
				display: block;
				max-height: 500px;
				height:auto;
				width:auto;
				background: white;
				overflow: scroll;
			}
			th,td
			{
				padding: 1px;
				float:left;
				text-align: left;
				vertical-align: top;
				border-left: 1px solid #fff;
			}
			th:nth-child(1), td:nth-child(1){
				width: 20px;
			}
			th:nth-child(2), td:nth-child(2){
				width: 90px;
			}
			th:nth-child(3), td:nth-child(3){
				width: 40px;
			}
			th:nth-child(4), td:nth-child(4){
				width: 160px;
			}
			th:nth-child(5), td:nth-child(5){
				width: 85px;
			}
			th:nth-child(6), td:nth-child(6){
				width: 160px;
			}
			th:nth-child(7), td:nth-child(7){
				width: 70px;
			}
			th:nth-child(8), td:nth-child(8){
				width: 92px;
			}
			</style>";
   echo "<h2>Report by Division</h2>
          <form method='get' action='media.php?'><input type=hidden name=module value='rptdivision'>        
               Period  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Month &nbsp: <select name='bulan' >
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
                Year : <select name='year' ><option value='0' >- Select -</option>";
            $tampil=mysql_query("SELECT Year FROM tour_msproduct where year <>'' group BY Year asc");
            while($s=mysql_fetch_array($tampil)){  // <input type='button' value='Cek Seat' onclick=ceking() >
               if($yer==$s[Year]){
                    echo "<option value='$s[Year]' selected>$s[Year]</option>";     
                }else { 
                echo "<option value='$s[Year]' >$s[Year]</option>";
                } 
            }
    echo "</select>";
	echo "<br>Product Type : <select name='GroupType' id='GroupType'>";  
           
			$tampilGtype=mysql_query("SELECT * FROM tour_msgroup order by GroupName ASC"); 
							  echo "<option value='ALL'>ALL</option>";  
            while($sGtype=mysql_fetch_array($tampilGtype)){
				if ($Gtype==$sGtype[GroupName]){
                        echo "<option value='$sGtype[GroupName]' selected>$sGtype[GroupName]</option>";
						}
				else {
						echo "<option value='$sGtype[GroupName]'>$sGtype[GroupName]</option>";}
				
            }
    echo "</select>";
	 echo "<br>Market &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <select name='BOSO' id='BOSO'>";  
		  echo "<option value='ALL'>ALL</option>"; 
		  echo "<option value='BSO'>BSO</option>";
		  echo "<option value='BOLK'>BOLK</option>"; 
		  echo "<option value='PANORAMA WORLD'>PANORAMA WORLD</option>"; 
		  echo "<option value='OTHERS'>OTHERS</option>"; 
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

	echo "<h><u>$Div SALES $Gtype PERIOD $montText $yer </u></h><br>";
	
	if($Div=='ALL'){$QOffice=mssql_query("select * from Divisi order by DivisiID");}
	if($Div=='BSO'){$QOffice=mssql_query("select * from Divisi where CompanyID=$CompanyID and District='JAKARTA' order by DivisiID");}
	if($Div=='BOLK'){$QOffice=mssql_query("select * from Divisi where  CompanyID=$CompanyID and District='NON JAKARTA' order by DivisiID");}
	if($Div=='PANORAMA WORLD'){$QOffice=mssql_query("select * from Divisi where CompanyID<>$CompanyID and CompanyGroup='PANORAMA WORLD' order by DivisiID");}
	if($Div=='OTHERS'){$QOffice=mssql_query("select * from Divisi where  CompanyID<>$CompanyID and CompanyGroup<>'PANORAMA WORLD'  order by DivisiID");}

	
while($DOffice=mssql_fetch_array($QOffice)){
 if ($Boso=='')
  {
    $Boso="'$DOffice[DivisiID]'";
  }
  else
  {
    $Boso=$Boso.",'$DOffice[DivisiID]'";
  }
}

	$Drate=mysql_query("select * from tour_rate where RateYear=$yer" );
	$rate=mysql_fetch_array($Drate);
	
	$JumBooking=mssql_num_rows($QOffice);
	
	if ($JumBooking > 0){
	 
     $No=1;  
	 $Total=0;
	 $THarga=0;
	 echo"<font size='2'> USD 1 = IDR $rate[$montText] ,-</font>";

	 echo" <div id='wrapper'><table id='rptdiv'>
			<thead>
	 		<tr><th colspan='2' style='width: 114px;'>&nbsp;</th><th colspan='2' style='width: 204px;'>Realisasi</th><th colspan='2' style='width: 249px;'>Target</th><th colspan='2' style='width: 166px;'>Achievement</th></tr>
	 		<tr><th>No</th><th>BOSO</th><th>Pax</th><th>Amount</th><th>Target Pax</th><th>Target Amount</th><th>Pax</th><th>Amount</th></tr>
			</thead>"; 

		if($Gtype=='ALL'){
		if($Div=='ALL'){
		$kriet=mysql_query("
		SELECT TCDivision,Destination,count(IDDetail) as Total, sum(if(SellingCurr='USD',(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0)))) as Harga FROM tour_msbookingdetail inner join (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and DUMMY='NO' and (CompanyID=$CompanyID or TCCompanyID=$CompanyID))tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL' group by TCDivision order by Harga desc
		");
		}
		else
		{
		$kriet=mysql_query("SELECT TCDivision,Destination,count(IDDetail) as Total, sum(if(SellingCurr='USD',(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0)))) as Harga FROM tour_msbookingdetail inner join (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and DUMMY='NO' and  (CompanyID=$CompanyID or TCCompanyID=$CompanyID) and TCDivision in($Boso))tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by TCDivision order by Harga desc");
		}
		}
		else
		{
		if($Div=='ALL'){
		$kriet=mysql_query("
		SELECT TCDivision,Destination,count(IDDetail) as Total, sum(if(SellingCurr='USD',(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0)))) as Harga FROM tour_msbookingdetail inner join (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and GroupType ='$Gtype' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and DUMMY='NO' and  (CompanyID=$CompanyID or TCCompanyID=$CompanyID))tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL' group by TCDivision order by Harga desc
		");
		}
		else
		{
		$kriet=mysql_query("SELECT TCDivision,Destination,count(IDDetail) as Total, sum(if(SellingCurr='USD',(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0)))) as Harga FROM tour_msbookingdetail inner join (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID' and GroupType ='$Gtype' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and DUMMY='NO' and  (CompanyID=$CompanyID or TCCompanyID=$CompanyID) and TCDivision in($Boso))tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by TCDivision order by Harga desc");
		}
		}

$jumlah=mysql_num_rows($kriet);

if ($jumlah < 1){

		if($Div!='PANORAMA WORLD'){
			$Target=mysql_query("SELECT * from tour_mstarget where TargetYear=$yer and CompanyID=$CompanyID");
		}
		else{
			$Target=mysql_query("SELECT * from tour_mstargetpw where TargetYear=$yer");
		}	
		
		 while($DTarget=mysql_fetch_array($Target)){

		$montangka=$montText.A;

		$Harga=0;
		
		$TampilTotal=number_format(0, 0, ',', '.');
		
		$warna="BGCOLOR='#f5bebe'";
		 
    echo "<tr>
          <td $warna>$No</td>
          <td $warna>$DTarget[TargetBSO]</td>
          <td $warna style='text-align:right'>$TampilTotal";
		   if($DTarget[$montText]==0){$AchievePax=100;}else{$AchievePax=round(($TampilTotal/$DTarget[$montText]*100),0);}
		   
		
			 echo "</td>
			 <td $warna style='text-align:right'>".number_format($Harga, 0, ',', '.');echo"</td>
			 <td $warna style='text-align:right'>";
			 if($DTarget[$montText]==''){echo"0";}else{echo"$DTarget[$montText]";}
		
			 if($DTarget[$montangka]==''){$TargetAngka=0;}else{$TargetAngka=$DTarget[$montangka];};
			
			 echo" </td><td $warna style='text-align:right'>"
			 .number_format($TargetAngka, 0, ',', '.');
			 if($DTarget[$montangka]==0){$AchieveTotal=100;}else{$AchieveTotal=round(($Harga/$DTarget[$montangka]*100),0);}
			 echo"</td>	<td $warna style='text-align:right'>$AchievePax % </td>
			 <td $warna style='text-align:right'>$AchieveTotal %</td>";
			 echo "</tr>";
		$No++;
		$TTarget=$TTarget+$DTarget[$montText];
		$TTargetAngka=$TTargetAngka+$DTarget[$montangka];
			}



			}
else
{


while($DBooking=mysql_fetch_array($kriet)){	

		 if ($BosoJual=='')
		  {$BosoJual="'$DBooking[TCDivision]'";
		  }
		  else
		  {
			 $BosoJual=$BosoJual.",'$DBooking[TCDivision]'";
		   }	
	
		$Office_group=mssql_query("select * from Divisi where DivisiID ='$DBooking[TCDivision]'");
		$DOffice=mssql_fetch_array($Office_group);
		

		if($DOffice[CompanyGroup]!='PANORAMA WORLD'){
			$Target=mysql_query("SELECT * from tour_mstarget where TargetBSO='$DBooking[TCDivision]' and TargetYear=$yer and CompanyID=$CompanyID");
		}
		else{
			$Target=mysql_query("SELECT * from tour_mstargetpw where TargetBSO='$DBooking[TCDivision]' and TargetYear=$yer");
		}
		
		
		$DTarget=mysql_fetch_array($Target);
		$montangka=$montText.A;
		
		$Harga=$DBooking[Harga];
		
		$TampilTotal=number_format($DBooking[Total], 0, ',', '.');
		
		 if(($DBooking[Total]/$DTarget[$montText]>1 and $Harga/$DTarget[$montangka]>1)or($DTarget[$montText]==0
		  or $DTarget[$montangka]==0)){$warna="BGCOLOR='#ffffff'";} else {$warna="BGCOLOR='#f5bebe'";} 
		 
		echo "<tr>
			  <td $warna>$No</td>
			 <td $warna>$DBooking[TCDivision]</td>
			 <td $warna style='text-align:right'>";
			 if($DBooking[Total]=='0'){echo"$TampilTotal"; $AchievePax=0;}else{
			 
			 $Div=preg_replace('/[[:space:]]+/','--',$DBooking[TCDivision]);
			 echo"
           <a href='?module=rptdivision&act=dtlBooking&BSO=$Div&Gtype=$Gtype&Bln=$mont&thn=$yer'>$TampilTotal</a>"; }
		
		   if($DTarget[$montText]==0){$AchievePax=100;}else{$AchievePax=round(($DBooking[Total]/$DTarget[$montText]*100),0);}
		   
		
			 echo "</td>
			 <td $warna style='text-align:right'>".number_format($Harga, 0, ',', '.');echo"</td>
			 <td $warna style='text-align:right'>";
			 if($DTarget[$montText]==''){echo"0";}else{echo"$DTarget[$montText]";}
		
			 if($DTarget[$montangka]==''){$TargetAngka=0;}else{$TargetAngka=$DTarget[$montangka];};
		
			 echo"</td><td $warna style='text-align:right'>"
			 .number_format($TargetAngka, 0, ',', '.');
			 if($DTarget[$montangka]==0){$AchieveTotal=100;}else{$AchieveTotal=round(($Harga/$DTarget[$montangka]*100),0);}
			 echo"</td>	<td $warna style='text-align:right'>$AchievePax % </td>
			 <td $warna style='text-align:right'>$AchieveTotal %</td>";
			 echo "</tr>";
		$No++;
		$Total=$Total+$DBooking[Total];
		$THarga=$THarga+$Harga;
		$TTarget=$TTarget+$DTarget[$montText];
		$TTargetAngka=$TTargetAngka+$DTarget[$montangka];

		}
		
		//boso tidak ada bookingan
		$NoSales=mssql_query("select * from Divisi where DivisiID in($Boso) and DivisiID not in($BosoJual) and CompanyID=$CompanyID and category='SALES OUTLET' and Active=1 and dir<>'ORN'");
		
		while($DNoBooking=mssql_fetch_array($NoSales)){
		
		if($DNoBooking[CompanyGroup]!='PANORAMA WORLD'){
			$Target=mysql_query("SELECT * from tour_mstarget where TargetBSO='$DNoBooking[office_code]' and TargetYear=$yer and CompanyID=$CompanyID");
		}
		else{
			$Target=mysql_query("SELECT * from tour_mstargetpw where TargetBSO='$DNoBooking[office_code]' and TargetYear=$yer");
		}	
		
		$DTarget=mysql_fetch_array($Target);
		$montangka=$montText.A;
		
		
		$Harga=0;
		
		$TampilTotal=number_format(0, 0, ',', '.');
		
		$warna="BGCOLOR='#f5bebe'";
		 
		echo "<tr>
			  <td $warna>$No</td>
			 <td $warna>$DNoBooking[DivisiID]</td>
			 <td $warna style='text-align:right'>$TampilTotal";
		   if($DTarget[$montText]==0){$AchievePax=100;}else{$AchievePax=round(($TampilTotal/$DTarget[$montText]*100),0);}
		   
		
			 echo "</td>
			 <td $warna style='text-align:right'>".number_format($Harga, 0, ',', '.');echo"</td>
			 <td $warna style='text-align:right'>";
			 if($DTarget[$montText]==''){echo"0";}else{echo"$DTarget[$montText]";}
		
			 if($DTarget[$montangka]==''){$TargetAngka=0;}else{$TargetAngka=$DTarget[$montangka];};
			
			 echo" </td><td $warna style='text-align:right'>"
			 .number_format($TargetAngka, 0, ',', '.');
			 if($DTarget[$montangka]==0){$AchieveTotal=100;}else{$AchieveTotal=round(($Harga/$DTarget[$montangka]*100),0);}
			 echo"</td>	<td $warna style='text-align:right'>$AchievePax % </td>
			 <td $warna style='text-align:right'>$AchieveTotal %</td>";
			 echo "</tr>";
		$No++;
		$TTarget=$TTarget+$DTarget[$montText];
		$TTargetAngka=$TTargetAngka+$DTarget[$montangka];

		}
		
		
}

		if($TTarget==0){$TAchievePax=100;}else{$TAchievePax=round($Total/$TTarget*100,0);};
		if($TTargetAngka==0){$TAchieveTarget=100;}else{$TAchieveTarget=round($THarga/$TTargetAngka*100,0);};
	echo "<tr><th>&nbsp;</th><th colspan=2>Total</th><th style='text-align:right'>".number_format($Total, 0, ',', '.');echo"</th>
	<th style='text-align:right'>".number_format($THarga, 0, ',', '.');echo"</th>
	<th style='text-align:right'>".number_format($TTarget, 0, ',', '.');echo"</th>
	<th style='text-align:right'>".number_format($TTargetAngka, 0, ',', '.');echo"</th>
	<th style='text-align:right'>$TAchievePax % </th><th style='text-align:right'>$TAchieveTarget %</th>
	</tr>";
	echo"</table></div><br><center><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('rptdiv')>";
	}
	else
	
	{ echo "<br><center><font color=red>- NO TRANSACTION DATA IN $montText $yer -</font></center>";
	} 
	   
    break;
	        
case "dtlBooking":
	$DivGet=str_replace('--',' ',$_GET[BSO]);
	$Gtype=$_GET[Gtype];
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
 		 elseif($mont=='12'){$montText='DES';};
		  
	
	$Drate=mysql_query("select * from tour_rate where RateYear=$_GET[thn]" );
	$rate=mysql_fetch_array($Drate);
	
    if($Gtype=='ALL'){
        $kriet=mysql_query("SELECT TourCode,SellingCurr as curr,Department,TaxInsSell,Destination,ProductType,sum(if((tour_msbookingdetail.status<>'CANCEL' ),1,0)) as TotalActive,count(IDDetail) as Total, sum(if(SellingCurr='USD',(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0)))) as Harga FROM tour_msbookingdetail inner join (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and month(DateTravelFrom)='$_GET[Bln]' and year(DateTravelFrom)='$_GET[thn]' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision='$DivGet' and DUMMY='NO')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL' group by tour_msbookingdetail.TourCode order by Harga desc,Destination,Department,ProductType");
	}else{
        $kriet=mysql_query("
		SELECT TourCode,SellingCurr as curr,Department,TaxInsSell,Destination,ProductType,sum(if((tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),1,0)) as TotalActive,count(IDDetail) as Total, sum(if(SellingCurr='USD',(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0))*$rate[$montText],(Subtotal+DevAmount+SeaTaxSell+if((Package<>'LA only' and tour_msbookingdetail.status<>'CANCEL' and Gender<>'INFANT'),TaxInsSell,0)))) as Harga FROM tour_msbookingdetail inner join (select TCDivision,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'and ProductType ='$_GET[Gtype]'  and month(DateTravelFrom)='$_GET[Bln]' and year(DateTravelFrom)='$_GET[thn]' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision='$DivGet' and DUMMY='NO')tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID  where tour_msbookingdetail.status<>'CANCEL' group by tour_msbookingdetail.TourCode order by Harga desc,Destination,Department,ProductType");
    }       
	
	
	echo"<B>Booking Transaction $DivGet $montText -$_GET[thn] </B>
			<table>
			<tr><th>No</th><th>Destination</th><th>Department</th><th>productType</th><th>Tour Code</th><th>Pax</th><th>Amount</th></tr>";
			$no=1;
			$TPax=0;
			$THarga=0;
			while($sow=mysql_fetch_array($kriet)){   
                  	$TPax=$TPax+$sow[TotalActive];
					$THarga=$THarga+$sow[Harga];
					
				     echo"              
                     <tr>                                   
                     <td>$no</td>  
					 <td>$sow[Destination]</td> 
  					 <td>$sow[Department]</td> 
					 <td>$sow[ProductType]</td> 
					 <td>$sow[TourCode]</td> 
   					 <td style='text-align:right'>".number_format($sow[TotalActive], 0, ',', '.');echo"</td>
   					 <td style='text-align:right'>".number_format($sow[Harga], 0, ',', '.');echo"</td></tr>";
                      $no++;
                    };
					echo "
					<tr><th colspan=5><center>Total</th><th style='text-align:right'>".number_format($TPax, 0, ',', '.');echo"</th><th style='text-align:right'>".number_format($THarga, 0, ',', '.');echo"</th></tr></table><br>
                    <center><input type=button value=Close onclick=self.history.back()><br><br>"; 
     break;    
}
?>
