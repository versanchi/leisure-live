<script language="JavaScript"  type="text/javascript">   
function ganti() {
document.example.elements['submit'].click(); 
}
</script>
<?php
switch($_GET['act']){
   default:
    $tanggal=$_GET['tanggal'];
    if($tanggal==''){$tanggal=date("d-m-Y");}else{$tanggal=$tanggal;}
    $tanggal2=$_GET['tanggal2'];
    if($tanggal2==''){$tanggal2=date("d-m-Y");}else{$tanggal2=$tanggal2;}
    $opnama=$_GET['opnama'];
    if($opnama==''){$opnama='BookingDate';}     
    
	echo "
    <form name='dashboard' method=get action='media.php?' >
    <input type='hidden' name='module' value='dashcustomer'>
    <h2><br/>Customer Dashboard: 
    <select name='opnama'>          
    <option value='DateTravelFrom'";if($opnama=='DateTravelFrom'){echo"selected";}echo">Departure Date</option>
    <option value='BookingDate'";if($opnama=='BookingDate'){echo"selected";}echo">Booking Date</option>
    </select>
    From <input type=text name='tanggal' size='10' value='$tanggal' onClick="."cal.select(document.forms['dashboard'].tanggal,'anchor1','dd-MM-yyyy'); return false;"." NAME='anchor1' ID='anchor1'> - 
    To <input type=text name='tanggal2' size='10' value='$tanggal2' onClick="."cal.select(document.forms['dashboard'].tanggal2,'anchor2','dd-MM-yyyy'); return false;"." NAME='anchor2' ID='anchor2'> 
   <input type='submit' name='submit' id='submit' value=Show >  </h2>
    </form>"; 
	
	$tudayq=date("Y-m-d",strtotime($tuday));
	$Start=date("Y-m-d",strtotime($tanggal));
	$End=date("Y-m-d",strtotime($tanggal2));
	$thn=date("Y",strtotime($tanggal));
	$Lthn=$thn-1;
	
	if($opnama=='DateTravelFrom'){$Base='Departure Date';}else{$Base='Booking Date';}
	echo"<table>
	      <tr><td style='border-color:white; font-size: 20px ;font-weight:bold'; colspan=3><center>$Base Period : ".date("d-M-Y",strtotime($tanggal))." until ".date("d-M-Y",strtotime($tanggal2))."	
		  </td></tr>
		  <tr><td style='width:40%; border-color:white'>";
	
	echo"<table>
		<tr><th>Destination</th><th><center>NOT VALID</th><th><center>CHILD</th><th><center>ADOLESCENT</th><th><center>YOUNG ADULT</th><th><center>EARLY ADULTHOOD</th><th><center>MATURE</th><th><center>MIDDLE AGE</th><th><center>SENIOR</th><th><center>TOTAL</th></tr>";
	
	
		
		 	

        if($opnama=='DateTravelFrom'){
		$This=mysql_query("select Destination,sum(if(BirthDate='0000-00-00' or BirthDate>CURDATE(),1,0)) as NOTVALID,sum(if(((YEAR(CURDATE()) - YEAR(BirthDate))>0 and (YEAR(CURDATE()) - YEAR(BirthDate))<=12),1,0))  AS Childage,sum(if(((YEAR(CURDATE()) - YEAR(BirthDate))>12 and (YEAR(CURDATE()) - YEAR(BirthDate))<=18) ,1,0))  AS RemajaAwal,sum(if(((YEAR(CURDATE()) - YEAR(BirthDate))>18 and (YEAR(CURDATE()) - YEAR(BirthDate))<=25) ,1,0))  AS RemajaAkhir,sum(if(((YEAR(CURDATE()) - YEAR(BirthDate))>25 and (YEAR(CURDATE()) - YEAR(BirthDate))<=35) ,1,0))  AS DewasaAwal,sum(if(((YEAR(CURDATE()) - YEAR(BirthDate))>35 and (YEAR(CURDATE()) - YEAR(BirthDate))<=45) ,1,0))  AS DewasaAkhir,sum(if(((YEAR(CURDATE()) - YEAR(BirthDate))>45 and (YEAR(CURDATE()) - YEAR(BirthDate))<=55) ,1,0))  AS LansiaAwal,sum(if(((YEAR(CURDATE()) - YEAR(BirthDate))>55 and BirthDate<>'0000-00-00') ,1,0))  AS Senior, count(IDDetail) as Total 
		from 
		tour_msbookingdetail inner join (select * from tour_msproduct where tour_msproduct.status<>'VOID' and  tour_msproduct.datetravelfrom >='$Start' and tour_msproduct.datetravelfrom <= '$End') as tour_msproduct on tour_msbookingdetail.IDTourcode=tour_msproduct.IDProduct
		   where tour_msbookingdetail.status<>'CANCEL' and tour_msbookingdetail.bookingid in  (select bookingid from tour_msbooking where 
	  tour_msbooking.TCDivision<>'LTM' and TCDivision <>'LTM-TEZ' and tour_msbooking.BookingStatus='DEPOSIT' and tour_msbooking.Status='Active' )  
		  group by Destination");
	}
	else
	{
	$This=mysql_query("select Destination,sum(if(BirthDate='0000-00-00' or BirthDate>CURDATE(),1,0)) as NOTVALID,sum(if(((YEAR(CURDATE()) - YEAR(BirthDate))>0 and (YEAR(CURDATE()) - YEAR(BirthDate))<=12),1,0))  AS Childage,sum(if(((YEAR(CURDATE()) - YEAR(BirthDate))>12 and (YEAR(CURDATE()) - YEAR(BirthDate))<=18) ,1,0))  AS RemajaAwal,sum(if(((YEAR(CURDATE()) - YEAR(BirthDate))>18 and (YEAR(CURDATE()) - YEAR(BirthDate))<=25) ,1,0))  AS RemajaAkhir,sum(if(((YEAR(CURDATE()) - YEAR(BirthDate))>25 and (YEAR(CURDATE()) - YEAR(BirthDate))<=35) ,1,0))  AS DewasaAwal,sum(if(((YEAR(CURDATE()) - YEAR(BirthDate))>35 and (YEAR(CURDATE()) - YEAR(BirthDate))<=45) ,1,0))  AS DewasaAkhir,sum(if(((YEAR(CURDATE()) - YEAR(BirthDate))>45 and (YEAR(CURDATE()) - YEAR(BirthDate))<=55) ,1,0))  AS LansiaAwal,sum(if(((YEAR(CURDATE()) - YEAR(BirthDate))>55 and BirthDate<>'0000-00-00') ,1,0))  AS Senior, count(IDDetail) as Total 
		from 
		tour_msbookingdetail inner join (select * from tour_msproduct where tour_msproduct.status<>'VOID') as tour_msproduct on tour_msbookingdetail.IDTourcode=tour_msproduct.IDProduct 
		   where tour_msbookingdetail.status<>'CANCEL' and tour_msbookingdetail.bookingid in (select bookingid from tour_msbooking where 
	  tour_msbooking.TCDivision<>'LTM' and TCDivision <>'LTM-TEZ'  and tour_msbooking.BookingStatus='DEPOSIT' and  tour_msbooking.bookingdate >='$Start' and tour_msbooking.bookingdate <= '$End' and tour_msbooking.Status='Active' ) group by Destination");
	 
	}
	
	while ($DThis=mysql_fetch_array($This)) {
		echo"<tr><td>$DThis[Destination]</td>
				  <td style='text-align:center';>$DThis[NOTVALID]</td>
				  <td style='text-align:center';>$DThis[Childage]</td>
				  <td style='text-align:center';>$DThis[RemajaAwal]</td>
				  <td style='text-align:center';>$DThis[RemajaAkhir]</td>
				  <td style='text-align:center';>$DThis[DewasaAwal]</td>
				  <td style='text-align:center';>$DThis[DewasaAkhir]</td>
				  <td style='text-align:center';>$DThis[LansiaAwal]</td>
				  <td style='text-align:center';>$DThis[Senior]</td>
				  <td style='text-align:center';>$DThis[Total]</td>
				  </tr>";
				  $NOTVALID=$NOTVALID+$DThis[NOTVALID];
				  $Childage=$Childage+$DThis[Childage];
				  $RemajaAwal=$RemajaAwal+$DThis[RemajaAwal];
				  $RemajaAkhir=$RemajaAkhir+$DThis[RemajaAkhir];
				  $DewasaAwal=$DewasaAwal+$DThis[DewasaAwal];
				  $DewasaAkhir=$DewasaAkhir+$DThis[DewasaAkhir];
				  $LansiaAwal=$LansiaAwal+$DThis[LansiaAwal];
				  $Senior=$Senior+$DThis[Senior];
				  $Total=$Total+$DThis[Total];
				  

		}
					echo"<tr><th>Total</th>
				  <th style='text-align:center';>$NOTVALID</th>
				  <th style='text-align:center';>$Childage</th>
				  <th style='text-align:center';>$RemajaAwal</th>
				  <th style='text-align:center';>$RemajaAkhir</th>
				  <th style='text-align:center';>$DewasaAwal</th>
				  <th style='text-align:center';>$DewasaAkhir</th>
				  <th style='text-align:center';>$LansiaAwal</th>
				  <th style='text-align:center';>$Senior</th>
				  <th style='text-align:center';>$Total</th>
				  </tr>";
	
	echo"</table>";
	echo"<td style='border-color:white'></td><td style='width:40%; border-color:white'>
	Note :
	<table>
		<tr><th>Age</th><th>Category</th></tr>
		<tr><td> 0 - 12 Yrs</td><td>CHILD</td></tr>
		<tr><td>13 - 18 Yrs</td><td>ADOLESCENT</td></tr>
		<tr><td>19 - 25 Yrs</td><td>YOUNG ADULT</td></tr>
		<tr><td>26 - 35 Yrs</td><td>EARLY ADULTHOOD</td></tr>
		<tr><td>36 - 45 Yrs</td><td>MATURE</td></tr>
		<tr><td>45 - 55 Yrs</td><td>MIDDLE AGE</td></tr>
		<tr><td>55 Yrs Above</td><td>SENIOR</td></tr>
	</table>";
	
	echo"</td></table>";
		
	break; 

}