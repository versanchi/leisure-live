
<SCRIPT LANGUAGE="Javascript" SRC="FusionChartsXT/Code/FusionCharts/FusionCharts.js"></SCRIPT>
<script type="text/javascript" src="js/formcalculations.js"></script>
  <SCRIPT language='Javascript'>
      <!-- input just numeric, if input with character is not allowed
     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
	  function PopupCenter(pageURL, ID,w,h) {
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
		var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		} 
   </SCRIPT>
   
<?php
$CompanyID=$_SESSION['company_id'];
include("FusionChartsXT/Code/PHP/Includes/FusionCharts.php");  
include("FusionChartsXT/Code/PHP/Includes/DBConn.php");
switch($_GET[act]){
  // Tampil Office
   default:
    
    $mont=$_GET['bulan'];
    $yer=$_GET['year'];
	$Dest=$_GET['Destination'];
	$PCode =$_GET['PCode'];
	
	$awaldate=mysql_query("select month(DateTravelFrom) as bulan, year(DateTravelFrom) as thn FROM tbl_trquestion  inner join tour_msproduct on tour_msproduct.IDProduct = tbl_trquestion.IDTourcode where tour_msproduct.Status <> 'VOID' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and CompanyID=$CompanyID order by DateTravelFrom desc limit 1");
	$awal=mysql_fetch_array($awaldate);
	$blnini = $awal[bulan];
    $thnini = $awal[thn];
	
    if($mont==''){$mont=$blnini;}
    if($yer==''){$yer=$thnini;}
	
	
    if($Dest==''){$Dest='ALL';}
	if($PCode==''){$PCode='ALL';}
	
    echo "<h2>Report by Tour Code</h2>
          <form method='get' action='media.php?'><input type=hidden name=module value='rptquestioner'> ";       
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
           
			$tampilDest=mysql_query("SELECT distinct Destination FROM  tour_msproduct where destination<>'' and destination<>'0' and CompanyID=$CompanyID order by Destination ASC"); 
							  echo "<option value='ALL'>ALL</option>";  
            while($sDest=mysql_fetch_array($tampilDest)){
				if ($Dest==$sDest[Destination]){
                        echo "<option value='$sDest[Destination]' selected>$sDest[Destination]</option>";
						}
				else {
						echo "<option value='$sDest[Destination]'>$sDest[Destination]</option>";}
				}
    echo "</select>
			  <input type=hidden name='PCode' value='ALL'>
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
	
	
	echo "<h><B>Questioner Report $montText - $yer </B></h><br>";	                          
    
	//Query tidak memunculkan tourcode yang kosong dan yang tidak terjual
	if($Dest=='ALL'){
	$QProduct=mysql_query("SELECT * FROM `tour_msproduct` where Status <> 'VOID' and month(DateTravelFrom)=$mont and Year(DateTravelFrom)=$yer and TourCode<>'' and Seat<>SeatSisa and CompanyID=$CompanyID order by Destination,GroupType,SeatDeposit desc");}else{
	$QProduct=mysql_query("SELECT * FROM `tour_msproduct` where Status <> 'VOID' and month(DateTravelFrom)=$mont and Year(DateTravelFrom)=$yer and TourCode<>'' and Seat<>SeatSisa and Destination='$Dest' and CompanyID=$CompanyID order by Destination,GroupType,SeatDeposit desc");}
	
	$Products=mysql_num_rows($QProduct);
	
	if ($Products > 0){
	
   //$strXML will be used to store the entire XML document generated
   //Generate the chart element
     
   //Fetch all factory records
   if($PCode=='ALL'){
			 if($Dest=='ALL'){
			 $strQNewCust = "SELECT  sum( IF ( isProduct='Tidak',1,0) ) as Tidak, SUM( IF ( isProduct='Ya',1,0) ) as Ya,sum( IF ( isFavorite='Tidak',1,0) ) as FavTidak, SUM( IF ( isFavorite='Ya',1,0) ) as FavYa, sum( IF ( isKnowing LIKE '%Iklan dan Promosi%',1,0) ) as Iklan, sum( IF ( isKnowing LIKE '%Pameran%',1,0) ) as Pameran,sum( IF ( isKnowing LIKE '%Kantor Penjualan%',1,0) ) as Kantor,sum( IF ( isKnowing LIKE '%Teman%',1,0) ) as Teman,sum( IF ( isKnowing LIKE '%Perusahaan%',1,0) ) as Perusahaan ,sum( IF ( isEffective LIKE '%Iklan%',1,0) ) as EIklan,sum( IF ( isEffective LIKE '%Pameran%',1,0) ) as EPameran,sum( IF ( isEffective LIKE '%Kunjungan langsung%',1,0) ) as EKunjungan,sum( IF ( isEffective LIKE '%Direct Mail%',1,0) ) as EDirect,sum( IF ( isEffective LIKE '%Brosur dan Tour Catalog%',1,0) ) as EBrosur, sum( IF ( isEffective LIKE '%Internet%',1,0) ) as EInternet,	 sum( IF ( isSuperior LIKE '%Harga%',1,0) ) as SupHarga,sum( IF ( isSuperior LIKE '%Maskapai%',1,0) ) as SupMaskapai,sum( IF ( isSuperior LIKE '%Acara%',1,0) ) as SupAcara,sum( IF ( isSuperior LIKE '%Waktu%',1,0) ) as SupWaktu,sum( IF ( isSuperior LIKE '%Tour Consultant%',1,0) ) as SupTC,sum( IF ( isSuperior LIKE '%Lokasi%',1,0) ) as SupLokasi,sum( IF ( isSuperior LIKE '%Informasi%',1,0) ) as SupInformasi,sum( IF ( isSuperior LIKE '%Lainnya%',1,0) ) as SupLainnya, sum( IF ( isNikmat='Tidak',1,0) ) as EnjoyTidak, SUM( IF ( isNikmat='Ya',1,0) ) as EnjoyYa,sum( IF ( isMinat='Tidak',1,0) ) as JoinTidak, SUM( IF ( isMinat='Ya',1,0) ) as JoinYa
			 
			 FROM tbl_trquestion  inner join tour_msproduct on tour_msproduct.IDProduct = tbl_trquestion.IDTourcode where tour_msproduct.Status <> 'VOID' and year(DateTravelFrom)=$yer and month(DateTravelFrom)='$mont' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and tour_msproduct.CompanyID=$CompanyID ";
			 
			  $strQTable = mysql_query("SELECT  *, round(avg((extAcara+extPenerbangan+extTransportasi+extWisata+extAkomodasi+extSajian+extBelanja+extPemandu+extTLpanorama)/9),2) as perjalanan, round(avg((inOperator+inTourConsultant+inKasir+inDocument+inAirport)/5),2) as Staff , round(avg ((inPerjalanan+inInformasi+inSuasana+inAcara+inMasalah)/5),2) as TL,round(avg((extAcara+extPenerbangan+extTransportasi+extWisata+extAkomodasi+extSajian+extBelanja+extPemandu+extTLpanorama+inOperator+inTourConsultant+inKasir+inDocument+inAirport+inPerjalanan+inInformasi+inSuasana+inAcara+inMasalah)/19),2) as semua
			 FROM tbl_trquestion  inner join tour_msproduct on tour_msproduct.IDProduct = tbl_trquestion.IDTourcode where tour_msproduct.Status <> 'VOID' and year(DateTravelFrom)='$yer' and month(DateTravelFrom)='$mont' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and tour_msproduct.CompanyID=$CompanyID group by destination");
			 
			 }
			 else
			 {
			 $strQNewCust = "SELECT  sum( IF ( isProduct='Tidak',1,0) ) as Tidak, SUM( IF ( isProduct='Ya',1,0) ) as Ya ,sum( IF ( isFavorite='Tidak',1,0) ) as FavTidak, SUM( IF ( isFavorite='Ya',1,0) ) as FavYa,sum( IF ( isKnowing LIKE '%Iklan dan Promosi%',1,0) ) as Iklan, sum( IF ( isKnowing LIKE '%Pameran%',1,0) ) as Pameran,sum( IF ( isKnowing LIKE '%Kantor Penjualan%',1,0) ) as Kantor,sum( IF ( isKnowing LIKE '%Teman%',1,0) ) as Teman,sum( IF ( isKnowing LIKE '%Perusahaan%',1,0) ) as Perusahaan ,sum( IF ( isEffective LIKE '%Iklan%',1,0) ) as EIklan,sum( IF ( isEffective LIKE '%Pameran%',1,0) ) as EPameran,sum( IF ( isEffective LIKE '%Kunjungan langsung%',1,0) ) as EKunjungan,sum( IF ( isEffective LIKE '%Direct Mail%',1,0) ) as EDirect,sum( IF ( isEffective LIKE '%Brosur dan Tour Catalog%',1,0) ) as EBrosur, sum( IF ( isEffective LIKE '%Internet%',1,0) ) as EInternet,	 sum( IF ( isSuperior LIKE '%Harga%',1,0) ) as SupHarga,sum( IF ( isSuperior LIKE '%Maskapai%',1,0) ) as SupMaskapai,sum( IF ( isSuperior LIKE '%Acara%',1,0) ) as SupAcara,sum( IF ( isSuperior LIKE '%Waktu%',1,0) ) as SupWaktu,sum( IF ( isSuperior LIKE '%Tour Consultant%',1,0) ) as SupTC,sum( IF ( isSuperior LIKE '%Lokasi%',1,0) ) as SupLokasi,sum( IF ( isSuperior LIKE '%Informasi%',1,0) ) as SupInformasi,sum( IF ( isSuperior LIKE '%Lainnya%',1,0) ) as SupLainnya, sum( IF ( isNikmat='Tidak',1,0) ) as EnjoyTidak, SUM( IF ( isNikmat='Ya',1,0) ) as EnjoyYa,sum( IF ( isMinat='Tidak',1,0) ) as JoinTidak, SUM( IF ( isMinat='Ya',1,0) ) as JoinYa
			 FROM tbl_trquestion  inner join tour_msproduct on tour_msproduct.IDProduct = tbl_trquestion.IDTourcode where tour_msproduct.Status <> 'VOID' and year(DateTravelFrom)=$yer and month(DateTravelFrom)=$mont and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Destination='$Dest'";
			 
			 $strQTable = mysql_query("SELECT   *, round(avg((extAcara+extPenerbangan+extTransportasi+extWisata+extAkomodasi+extSajian+extBelanja+extPemandu+extTLpanorama)/9),2) as perjalanan, round(avg((inOperator+inTourConsultant+inKasir+inDocument+inAirport)/5),2) as Staff , round(avg ((inPerjalanan+inInformasi+inSuasana+inAcara+inMasalah)/5),2) as TL,round(avg((extAcara+extPenerbangan+extTransportasi+extWisata+extAkomodasi+extSajian+extBelanja+extPemandu+extTLpanorama+inOperator+inTourConsultant+inKasir+inDocument+inAirport+inPerjalanan+inInformasi+inSuasana+inAcara+inMasalah)/19),2) as semua
			 FROM tbl_trquestion  inner join tour_msproduct on tour_msproduct.IDProduct = tbl_trquestion.IDTourcode where tour_msproduct.Status <> 'VOID' and year(DateTravelFrom)='$yer' and month(DateTravelFrom)='$mont' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa  and Destination='$Dest'  and tour_msproduct.CompanyID=$CompanyID group by ProductCode");
	 }
	 }
	 else
	 {
	 $strQNewCust = "SELECT  sum( IF ( isProduct='Tidak',1,0) ) as Tidak, SUM( IF ( isProduct='Ya',1,0) ) as Ya ,sum( IF ( isFavorite='Tidak',1,0) ) as FavTidak, SUM( IF ( isFavorite='Ya',1,0) ) as FavYa,sum( IF ( isKnowing LIKE '%Iklan dan Promosi%',1,0) ) as Iklan, sum( IF ( isKnowing LIKE '%Pameran%',1,0) ) as Pameran,sum( IF ( isKnowing LIKE '%Kantor Penjualan%',1,0) ) as Kantor,sum( IF ( isKnowing LIKE '%Teman%',1,0) ) as Teman,sum( IF ( isKnowing LIKE '%Perusahaan%',1,0) ) as Perusahaan ,sum( IF ( isEffective LIKE '%Iklan%',1,0) ) as EIklan,sum( IF ( isEffective LIKE '%Pameran%',1,0) ) as EPameran,sum( IF ( isEffective LIKE '%Kunjungan langsung%',1,0) ) as EKunjungan,sum( IF ( isEffective LIKE '%Direct Mail%',1,0) ) as EDirect,sum( IF ( isEffective LIKE '%Brosur dan Tour Catalog%',1,0) ) as EBrosur, sum( IF ( isEffective LIKE '%Internet%',1,0) ) as EInternet,	 sum( IF ( isSuperior LIKE '%Harga%',1,0) ) as SupHarga,sum( IF ( isSuperior LIKE '%Maskapai%',1,0) ) as SupMaskapai,sum( IF ( isSuperior LIKE '%Acara%',1,0) ) as SupAcara,sum( IF ( isSuperior LIKE '%Waktu%',1,0) ) as SupWaktu,sum( IF ( isSuperior LIKE '%Tour Consultant%',1,0) ) as SupTC,sum( IF ( isSuperior LIKE '%Lokasi%',1,0) ) as SupLokasi,sum( IF ( isSuperior LIKE '%Informasi%',1,0) ) as SupInformasi,sum( IF ( isSuperior LIKE '%Lainnya%',1,0) ) as SupLainnya, sum( IF ( isNikmat='Tidak',1,0) ) as EnjoyTidak, SUM( IF ( isNikmat='Ya',1,0) ) as EnjoyYa,sum( IF ( isMinat='Tidak',1,0) ) as JoinTidak, SUM( IF ( isMinat='Ya',1,0) ) as JoinYa
			 FROM tbl_trquestion  inner join tour_msproduct on tour_msproduct.IDProduct = tbl_trquestion.IDTourcode where tour_msproduct.Status <> 'VOID' and year(DateTravelFrom)=$yer and month(DateTravelFrom)=$mont and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Destination='$Dest' and ProductCode='$PCode and tour_msproduct.CompanyID=$CompanyID'";
			 
			 $strQTable = mysql_query("SELECT   *, round(avg((extAcara+extPenerbangan+extTransportasi+extWisata+extAkomodasi+extSajian+extBelanja+extPemandu+extTLpanorama)/9),2) as perjalanan, round(avg((inOperator+inTourConsultant+inKasir+inDocument+inAirport)/5),2) as Staff , round(avg ((inPerjalanan+inInformasi+inSuasana+inAcara+inMasalah)/5),2) as TL,round(avg((extAcara+extPenerbangan+extTransportasi+extWisata+extAkomodasi+extSajian+extBelanja+extPemandu+extTLpanorama+inOperator+inTourConsultant+inKasir+inDocument+inAirport+inPerjalanan+inInformasi+inSuasana+inAcara+inMasalah)/19),2) as semua
			 FROM tbl_trquestion  inner join tour_msproduct on tour_msproduct.IDProduct = tbl_trquestion.IDTourcode where tour_msproduct.Status <> 'VOID' and year(DateTravelFrom)='$yer' and month(DateTravelFrom)='$mont' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa  and Destination='$Dest' and ProductCode='$PCode' and tour_msproduct.CompanyID=$CompanyID group by tour_msproduct.TourCode");
	 }
	 
	$link = connectToDB(); 
     $resultNewCust = mysql_query($strQNewCust) or die(mysql_error());
	  echo"<table>
	 <tr>
	 <td style='border-color:#ffffff';>";
	 		
		//pie cart new customer
		$strXML = "<chart caption='New Customer' numbersuffix='%25' showValues='0'>";
 	  	   $orsNewCust = mysql_fetch_array($resultNewCust);
           $strXML .= "<set label='NEW' value='" . $orsNewCust['Tidak'] . "' />";
		   $strXML .= "<set label='REPEATER' value='" . $orsNewCust['Ya'] . "' />";
           $strXML .= "</chart>";
           echo renderChart("FusionChartsXT/Code/FusionCharts/Pie3D.swf","", $strXML, "FactorySum", 300, 200, false, true);   
echo"</td><td style='border-color:#ffffff';>";

//pie cart panorama favorite
		   $strXML1 = "<chart caption='Favorite Agent' numbersuffix='%25' showValues='0'>";
           $strXML1 .= "<set label='OTHERS' value='" . $orsNewCust['FavTidak'] . "' />";
		   $strXML1 .= "<set label='PANORAMA' value='" . $orsNewCust['FavYa'] . "' />";
           $strXML1 .= "</chart>";
           echo renderChart("FusionChartsXT/Code/FusionCharts/Pie3D.swf","", $strXML1, "FactorySum1", 300, 200, false, true);   
echo"</td><td style='border-color:#ffffff';>";		
		
		//cart know panorama
		$strXMLKNOWPNO = "<chart caption='How do you know Panorama ?' showValues='0'>";
           $strXMLKNOWPNO .= "<set label='ADVERTISEMENT' value='" . $orsNewCust['Iklan'] . "' />";
		   $strXMLKNOWPNO .= "<set label='EXHIBITION' value='" . $orsNewCust['Pameran'] . "' />";
		   $strXMLKNOWPNO .= "<set label='BRANCH OUTLET' value='" . $orsNewCust['Kantor'] . "' />";
		   $strXMLKNOWPNO .= "<set label='FRIEND' value='" . $orsNewCust['Teman'] . "' />";
		   $strXMLKNOWPNO .= "<set label='COMPANY' value='" . $orsNewCust['Perusahaan'] . "' />";
           $strXMLKNOWPNO .= "</chart>";
           echo renderChart("FusionChartsXT/Code/FusionCharts/Column2D.swf","", $strXMLKNOWPNO, "FactorySum2", 400, 200, false, true);   

	echo"</td></tr>
	<tr><td style='border-color:#ffffff';>";
	?>
	<?php	 
	// table data

	if($PCode=='ALL'){
	 $No=1;
	 echo"<table>
	 <tr><th>No</th><th>";if($Dest=='ALL'){echo"Destination";}else{echo"Product Code";}
	 echo"</th><th>Trip</th><th>Staff</th><th>Tourleader</th><th colspan=2>Average</th></tr>";	 
	 while ($data=mysql_fetch_array($strQTable)){
	 	echo"<tr><td><center>$No</center></td><td>";
			if($Dest=='ALL'){echo"<a href='./media.php?module=rptquestioner&bulan=$mont&year=$yer&Destination=$data[Destination]&PCode=ALL&submit=View'> $data[Destination]</a></td>";
			}else{echo"<a href='./media.php?module=rptquestioner&bulan=$mont&year=$yer&Destination=$data[Destination]&PCode=$data[ProductCode]&submit=View'>$data[ProductCode]</a></td>";}
			echo"<td><center>";
			if($data[perjalanan]<1.5){echo"<font color='#FF0505'>$data[perjalanan]</font>";}else{echo"$data[perjalanan]";}echo"</center></td>
			<td><center>";if($data[Staff]<1.5){echo"<font color='#FF0505'>$data[Staff]</font>";}else{echo"$data[Staff]";}echo"</center></td>
			<td><center>";if($data[TL]<1.5){echo"<font color='#FF0505'>$data[TL]</font>";}else{echo"$data[TL]";}echo"</center></td>
			<td><center>$data[semua]</center></td>
			<td><center>";
			if($data[semua]<=1){echo"<img src='../admin/images/smile/bad.jpg'/>";}
			if($data[semua]>1 and $data[semua]<=1.5){echo"<img src='../admin/images/smile/sad.jpg' />";}
			if($data[semua]>1.5 and $data[semua]<=2){echo"<img src='../admin/images/smile/ok.jpg' />";}
			if($data[semua]>2){echo"<img src='../admin/images/smile/happy.jpg' />";}
			echo"</center></td></tr>";
		 $No++;
	 }
	 echo"</table>"; }
	 else
	 {
	 //  table per tourcode
	 $No=1;
	 echo"<table>
	 <tr><th>No</th><th>Tour Code</th><th>TL</th><th>Trip</th><th>Staff</th><th>Tourleader</th><th colspan=2>Average</th></tr>";	 
	 while ($data=mysql_fetch_array($strQTable)){
	 	echo"<tr><td><center>$No</center></td><td><a href='./media.php?module=rptquestioner&act=dtlquestioner&ID=$data[IDProduct]'>$data[TourCode]</a></td>
		<td>$data[TourLeader]</td><td><center>";
			if($data[perjalanan]<1.5){echo"<font color='#FF0505'>$data[perjalanan]</font>";}else{echo"$data[perjalanan]";}echo"</center></td>
			<td><center>";if($data[Staff]<1.5){echo"<font color='#FF0505'>$data[Staff]</font>";}else{echo"$data[Staff]";}echo"</center></td>
			<td><center>";if($data[TL]<1.5){echo"<font color='#FF0505'>$data[TL]</font>";}else{echo"$data[TL]";}echo"</center></td>
			<td><center>$data[semua]</center></td>
			<td><center>";
			if($data[semua]<=1){echo"<img src='../admin/images/smile/bad.jpg'/>";}
			if($data[semua]>1 and $data[semua]<=1.5){echo"<img src='../admin/images/smile/sad.jpg' />";}
			if($data[semua]>1.5 and $data[semua]<=2){echo"<img src='../admin/images/smile/ok.jpg' />";}
			if($data[semua]>2){echo"<img src='../admin/images/smile/happy.jpg' />";}
			echo"</center></td></tr>";
		 $No++;
	 }
	 echo"</table>";
	 }
?>	 
<?php	 
	 echo"</td><td style='border-color:#ffffff';><table><tr><td style='border-color:#ffffff';>";
	 
	 //pie cart enjoy trip
		   $strXML5 = "<chart caption='Enjoy the trip' numbersuffix='%25' showValues='0'>";
           $strXML5 .= "<set label='DISLIKE' value='" . $orsNewCust['EnjoyTidak'] . "' />";
		   $strXML5 .= "<set label='LIKE' value='" . $orsNewCust['EnjoyYa'] . "' />";
           $strXML5 .= "</chart>";
           echo renderChart("FusionChartsXT/Code/FusionCharts/Pie3D.swf","", $strXML5, "FactorySum5", 300, 200, false, true);   
	
	echo"</td></tr><tr><td style='border-color:#ffffff';>";
	
	//pie cart enjoy trip
		   $strXML6 = "<chart caption='will join others trip' numbersuffix='%25' showValues='0'>";
           $strXML6 .= "<set label='NO' value='" . $orsNewCust['JoinTidak'] . "' />";
		   $strXML6 .= "<set label='YES' value='" . $orsNewCust['JoinYa'] . "' />";
           $strXML6 .= "</chart>";
           echo renderChart("FusionChartsXT/Code/FusionCharts/Pie3D.swf","", $strXML6, "FactorySum6", 300, 200, false, true);   
	
echo"</td></tr></table></td><td style='border-color:#ffffff';><table><tr><td style='border-color:#ffffff';>";

		
		//chart effective media
		   $strXML3 = "<chart caption='Effective Information' showValues='0'>";
           $strXML3 .= "<set label='ADVERTISEMET' value='" . $orsNewCust['EIklan'] . "' />";
		   $strXML3 .= "<set label='EXHIBITION' value='" . $orsNewCust['EPameran'] . "' />";
		   $strXML3 .= "<set label='DIRECT VISIT' value='" . $orsNewCust['EKunjungan'] . "' />";
		   $strXML3 .= "<set label='DIRECT MAIL' value='" . $orsNewCust['EDirect'] . "' />";
		   $strXML3 .= "<set label='BROSUR AND CATALOG' value='" . $orsNewCust['EBrosur'] . "' />";
		   $strXML3 .= "<set label='INTERNET' value='" . $orsNewCust['EInternet'] . "' />";		   
           $strXML3 .= "</chart>";
           echo renderChart("FusionChartsXT/Code/FusionCharts/Column2D.swf","", $strXML3, "FactorySum3", 400, 200, false, true);   
	echo"</td></tr><tr><td style='border-color:#ffffff';>";
	
	//chart keunggulan panorama
		   $strXML4 = "<chart caption='PANORAMA EXCELLENCE' showValues='0'>";
           $strXML4 .= "<set label='PRICE' value='" . $orsNewCust['SupHarga'] . "' />";
		   $strXML4 .= "<set label='AIRLINES' value='" . $orsNewCust['SupMaskapai'] . "' />";
		   $strXML4 .= "<set label='ITINERARY' value='" . $orsNewCust['SupAcara'] . "' />";
		   $strXML4 .= "<set label='TIME' value='" . $orsNewCust['SupWaktu'] . "' />";
		   $strXML4 .= "<set label='STAFF' value='" . $orsNewCust['SupTC'] . "' />";
		   $strXML4 .= "<set label='BRANCH' value='" . $orsNewCust['SupLokasi'] . "' />";
   		   $strXML4 .= "<set label='INFORMATIVE' value='" . $orsNewCust['SupInformasi'] . "' />";
   		   $strXML4 .= "<set label='OTHERS' value='" . $orsNewCust['SupLainnya'] . "' />";		   
           $strXML4 .= "</chart>";
           
		    mysql_free_result($resultNewCust);
		   echo renderChart("FusionChartsXT/Code/FusionCharts/Column2D.swf","", $strXML4, "FactorySum4", 400, 200, false, true);   
	
		echo"</td></tr>
	 </table></table>";
	 
	
	 $Complain= mysql_query("SELECT * FROM `tbl_trquestion` inner join tour_msproduct on tour_msproduct.IDProduct = tbl_trquestion.IDTourcode  WHERE (`isNikmat` ='TIDAK' or `isMinat` ='TIDAK') and `inKesan`<>'' and  year(DateTravelFrom)='$yer' and month(DateTravelFrom)='$mont' and tbl_trquestion.Status<>'VOID' and tour_msproduct.CompanyID=$CompanyID");
		$jumComplain=mysql_num_rows($Complain);
		 if($jumComplain>0){
		  echo"<STRONG>NEED YOUR ATTENTION</STRONG>";
		 echo"<table><tr><th>Tour Code</th><th>Name</th><th>Note</th></tr>";
		 while ($DComplain=mysql_fetch_array($Complain)){
		 echo"<tr>
			   <td>$DComplain[TourCode]</td>
					 <td><left>$DComplain[Nama]</td>
					  <td><left>$DComplain[inKesan]</td> 
			    </tr>";	 
		 }
		 echo"</table>";
		 }
	 
    }
	else
	
	{ echo "NO PRODUCT AVAILABLE IN $montText - $yer";
	} 
	 
    break;               
	
	case "dtlquestioner" :
	
			$tampil=mysql_query("SELECT   *, round(avg((extAcara+extPenerbangan+extTransportasi+extWisata+extAkomodasi+extSajian+extBelanja+extPemandu+extTLpanorama)/9),2) as perjalanan, round(avg((inOperator+inTourConsultant+inKasir+inDocument+inAirport)/5),2) as Staff , round(avg ((inPerjalanan+inInformasi+inSuasana+inAcara+inMasalah)/5),2) as TL,round(avg((extAcara+extPenerbangan+extTransportasi+extWisata+extAkomodasi+extSajian+extBelanja+extPemandu+extTLpanorama+inOperator+inTourConsultant+inKasir+inDocument+inAirport+inPerjalanan+inInformasi+inSuasana+inAcara+inMasalah)/19),2) as semua
			 FROM tbl_trquestion  where tbl_trquestion.Status<>'VOID' and IDTourcode='$_GET[ID]' group by QuestionID order by QuestionID desc");
			
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			//header
			$QHeader=mysql_query("SELECT   * FROM tour_msproduct  where IDProduct ='$_GET[ID]'");
			$DHeader=mysql_fetch_array($QHeader);
			$dari = date("d M Y", strtotime($DHeader[DateTravelFrom]));
			echo"<table style='border:none';>
			<tr><td style='border:none';>Tour Code</td><td style='border:none';></td><td style='border:none';>: $DHeader[TourCode]</td></tr>
			<tr><td style='border:none';>Tour Leader</td><td style='border:none';></td><td style='border:none';>: $DHeader[TourLeader]</td></tr>
			<tr><td style='border:none';>Departure date</td><td style='border:none';></td><td style='border:none';>: $dari</td></tr>
			</table>";
		
			//Detail
			echo "<table>
          		  <tr><th>no</th><th>Questioner</th><th>Name</th><th>Trip</th><th>Staff</th><th>Tourleader</th><th colspan=2>Average</th><th>action</th></tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
			   echo "<tr><td>$no</td>
                     <td>$data[QuestionID]</td>
					 <td><left>$data[Nama]</td> 
					  <td><center>$data[perjalanan]</td> 
					  <td><center>$data[Staff]</td> 
					  <td><center>$data[TL]</td>  
					  <td><center>$data[semua]</td> 
					  <td><center>";
							if($data[semua]<=1){echo"<img src='../admin/images/smile/bad.jpg'/>";}
							if($data[semua]>1 and $data[semua]<=1.5){echo"<img src='../admin/images/smile/sad.jpg' />";}
							if($data[semua]>1.5 and $data[semua]<=2){echo"<img src='../admin/images/smile/ok.jpg' />";}
							if($data[semua]>2){echo"<img src='../admin/images/smile/happy.jpg' />";}
					  echo"</center></td> 
					 <td><center><a href=\"javascript:PopupCenter('./viewquestioner.php?id=$data[QuestionID]','variable',895,550)\">View</a>
					 </td></tr>";
					  $no++;
					} 
					echo "</table>  <center><input type=button value='Back' onclick=self.history.back()><br><br>";
					}
					
					
	
	break;
	
	
}
?>
