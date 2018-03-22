<SCRIPT LANGUAGE="Javascript" SRC="FusionChartsXT/Code/FusionCharts/FusionCharts.js">

function ganti() {
document.example.elements['submit'].click(); 
}
</script>

<?php
include("FusionChartsXT/Code/PHP/Includes/FusionCharts.php");  
include("FusionChartsXT/Code/PHP/Includes/DBConn.php");

switch($_GET['act']){
   default:
    $thnini = date("Y");
	$yer=$_GET['year'];
	if($yer==''){$yer=$thnini;}
	$Lthn=$thnini-1;
	$Dthn=$thnini-2;
	
	
	
	
echo"<form name='dashboard' method=get action='media.php?' >
    <input type='hidden' name='module' value='dashmonthbooking'>
    <h2><br/>MONTHLY BOOKING DASHBOARD: 
 		<select name='year' >
                      <option value='$thnini'";if($yer=='$thnini'){echo"selected";}echo">$thnini</option>
                      <option value='$Lthn'";if($yer=='$Lthn'){echo"selected";}echo">$Lthn</option>
					  <option value='$Dthn'";if($yer=='$Dthn'){echo"selected";}echo">$Dthn</option>
             </select>
			  <input type='submit' name='submit' id='submit' value=Show >  </h2>
	   </form>"; 
	
echo"<center><table>
	<tr><td><CENTER><b>WEEKLY BOOKING</b></center>
	
	</td></tr><tr><td><center>";
	
	//---------------------------monthly chart ------------------------------------------//
	$link = connectToDB(); 
	$strXML = "<chart caption='WEEKLY BOOKING $yer' xAxisName='Weekly' yAxisName='Pax' showValues='0' >";

   	$strXML .="<categories>";
	

	for ($i=1;$i<13;$i++)
	{
		 if($i==1){$montText='JAN';}
		 elseif($i=='02'){$montText='FEB';}
		 elseif($i=='03'){$montText='MAR';}
		 elseif($i=='04'){$montText='APR';}
		 elseif($i=='05'){$montText='MAY';}
		 elseif($i=='06'){$montText='JUN';}
		 elseif($i=='07'){$montText='JUL';}
		 elseif($i=='08'){$montText='AUG';}
		 elseif($i=='09'){$montText='SEP';}
		 elseif($i=='10'){$montText='OCT';}
		 elseif($i=='11'){$montText='NOV';}
		 elseif($i=='12'){$montText='DES';}
		 
	for ($W=1;$W<5;$W++)
		
			{
				$strXML .="<category label='$montText$W' />";

				
			}
			
	}   
   
  		$strXML .="</categories>";


//---SERIES--//

	$strXML .="<dataset seriesName='Series'>";
	
	for($i=1;$i<13;$i++)
	{
		
		 
		 $QSeries="SELECT  sum(if(DAY(BookingDate)<=7 ,1,0)) as SERIESNow1,
				 sum(if((DAY(BookingDate)>7 and DAY(BookingDate)<=14 ) ,1,0)) as SERIESNow2,
				 sum(if((DAY(BookingDate)>14 and DAY(BookingDate)<=21 ) ,1,0)) as SERIESNow3,
				sum(if((DAY(BookingDate)>21 ),1,0)) as SERIESNow4
			 from tour_msbookingdetail inner join (Select tour_msbooking.BookingID,Bookingdate,GroupType from tour_msbooking inner join tour_msproduct on tour_msbooking.IDTourcode=tour_msproduct.IDProduct where TCDivision<>'LTM' and TCDivision <>'LTM-TEZ' and BookingStatus='DEPOSIT' and (year(Bookingdate)='$yer')and  month(Bookingdate)='$i' and tour_msproduct.status<>'VOID' and (GroupType='SERIES' or GroupType='CONSORTIUM' or GroupType='CRUISE'))tour_msbooking on tour_msbooking.BookingID =tour_msbookingdetail.BookingID where Gender<>'INFANT'";
				
		  $DSeries = mysql_query($QSeries) or die(mysql_error());
		  $GraphSeries = mysql_fetch_array($DSeries);
		  
		  $strXML .="<set value='".$GraphSeries[SERIESNow1]."'/>";
		  $strXML .="<set value='".$GraphSeries[SERIESNow2]."'/>";
		  $strXML .="<set value='".$GraphSeries[SERIESNow3]."'/>";
		  $strXML .="<set value='".$GraphSeries[SERIESNow4]."'/>";
		  
		  
		 
		$SERIES[$i]=$GraphSeries[SERIESNow1]+$GraphSeries[SERIESNow2]+$GraphSeries[SERIESNow3]+$GraphSeries[SERIESNow4];
		 
	}

		$strXML .="</dataset>";
		
		
//--TUREZ--//

	$strXML .="<dataset seriesName='TUREZ'>";
	
	for($i=1;$i<13;$i++)
	{
		 $QTUREZ="SELECT  sum(if(DAY(BookingDate)<=7 ,1,0)) as TUREZNow1,
				 sum(if((DAY(BookingDate)>7 and DAY(BookingDate)<=14 ) ,1,0)) as TUREZNow2,
				 sum(if((DAY(BookingDate)>14 and DAY(BookingDate)<=21 ) ,1,0)) as TUREZNow3,
				sum(if((DAY(BookingDate)>21 ),1,0)) as TUREZNow4
			 from tour_msbookingdetail inner join (Select tour_msbooking.BookingID,Bookingdate,GroupType from tour_msbooking inner join tour_msproduct on tour_msbooking.IDTourcode=tour_msproduct.IDProduct where TCDivision<>'LTM' and TCDivision <>'LTM-TEZ' and BookingStatus='DEPOSIT' and (year(Bookingdate)='$yer')and  month(Bookingdate)='$i' and tour_msproduct.status<>'VOID' and GroupType='TUR EZ')tour_msbooking on tour_msbooking.BookingID =tour_msbookingdetail.BookingID where Gender<>'INFANT'";
				
		  $DTUREZ = mysql_query($QTUREZ) or die(mysql_error());
		  $GraphTUREZ = mysql_fetch_array($DTUREZ);
		  
		  $strXML .="<set value='".$GraphTUREZ[TUREZNow1]."'/>";
		  $strXML .="<set value='".$GraphTUREZ[TUREZNow2]."'/>";
		  $strXML .="<set value='".$GraphTUREZ[TUREZNow3]."'/>";
		  $strXML .="<set value='".$GraphTUREZ[TUREZNow4]."'/>";
		  
		  		  
 		$TUREZ[$i]=$GraphTUREZ[TUREZNow1]+$GraphTUREZ[TUREZNow2]+$GraphTUREZ[TUREZNow3]+$GraphTUREZ[TUREZNow4];
		  
		 
	}

		$strXML .="</dataset>";


		
//--MINISTRY--//

	$strXML .="<dataset seriesName='MINISTRY'>";
	
	for($i=1;$i<13;$i++)
	{
		 $QMINISTRY="SELECT  sum(if(DAY(BookingDate)<=7 ,1,0)) as MINISTRYNow1,
				 sum(if((DAY(BookingDate)>7 and DAY(BookingDate)<=14 ) ,1,0)) as MINISTRYNow2,
				 sum(if((DAY(BookingDate)>14 and DAY(BookingDate)<=21 ) ,1,0)) as MINISTRYNow3,
				sum(if((DAY(BookingDate)>21 ),1,0)) as MINISTRYNow4
			 from tour_msbookingdetail inner join (Select tour_msbooking.BookingID,Bookingdate,GroupType from tour_msbooking inner join tour_msproduct on tour_msbooking.IDTourcode=tour_msproduct.IDProduct where TCDivision<>'LTM' and TCDivision <>'LTM-TEZ' and BookingStatus='DEPOSIT' and (year(Bookingdate)='$yer')and  month(Bookingdate)='$i' and tour_msproduct.status<>'VOID' and GroupType='MINISTRY')tour_msbooking on tour_msbooking.BookingID =tour_msbookingdetail.BookingID where Gender<>'INFANT'";
				
		  $DMINISTRY = mysql_query($QMINISTRY) or die(mysql_error());
		  $GraphMINISTRY = mysql_fetch_array($DMINISTRY);
		  
		  $strXML .="<set value='".$GraphMINISTRY[MINISTRYNow1]."'/>";
		  $strXML .="<set value='".$GraphMINISTRY[MINISTRYNow2]."'/>";
		  $strXML .="<set value='".$GraphMINISTRY[MINISTRYNow3]."'/>";
		  $strXML .="<set value='".$GraphMINISTRY[MINISTRYNow4]."'/>";
		  
		 $MINISTRY[$i]=$GraphMINISTRY[MINISTRYNow1]+$GraphMINISTRY[MINISTRYNow2]+$GraphMINISTRY[MINISTRYNow3]+$GraphMINISTRY[MINISTRYNow4];
		  
		 
	}

		$strXML .="</dataset>";
		

//--TMR--//

	$strXML .="<dataset seriesName='TMR'>";
	
	for($i=1;$i<13;$i++)
	{
		 $QTMR="SELECT  sum(if(DAY(BookingDate)<=7 ,1,0)) as TMRNow1,
				 sum(if((DAY(BookingDate)>7 and DAY(BookingDate)<=14 ) ,1,0)) as TMRNow2,
				 sum(if((DAY(BookingDate)>14 and DAY(BookingDate)<=21 ) ,1,0)) as TMRNow3,
				sum(if((DAY(BookingDate)>21 ),1,0)) as TMRNow4
			 from tour_msbookingdetail inner join (Select tour_msbooking.BookingID,Bookingdate,GroupType from tour_msbooking inner join tour_msproduct on tour_msbooking.IDTourcode=tour_msproduct.IDProduct where TCDivision<>'LTM' and TCDivision <>'LTM-TEZ' and BookingStatus='DEPOSIT' and (year(Bookingdate)='$yer')and  month(Bookingdate)='$i' and tour_msproduct.status<>'VOID' and GroupType='TMR')tour_msbooking on tour_msbooking.BookingID =tour_msbookingdetail.BookingID where Gender<>'INFANT'";
				
		  $DTMR = mysql_query($QTMR) or die(mysql_error());
		  $GraphTMR = mysql_fetch_array($DTMR);
		  
		  $strXML .="<set value='".$GraphTMR[TMRNow1]."'/>";
		  $strXML .="<set value='".$GraphTMR[TMRNow2]."'/>";
		  $strXML .="<set value='".$GraphTMR[TMRNow3]."'/>";
		  $strXML .="<set value='".$GraphTMR[TMRNow4]."'/>";
		  
		    
		
		$TMR[$i]=$GraphTMR[TMRNow1]+$GraphTMR[TMRNow2]+$GraphTMR[TMRNow3]+$GraphTMR[TMRNow4];
		
		  
		 
	}

		$strXML .="</dataset>";

//--TOTAL--//

	$strXML .="<dataset seriesName='TOTAL'>";
	
	for($i=1;$i<13;$i++)
	{
		 $QTOTAL="SELECT  sum(if(DAY(BookingDate)<=7 ,1,0)) as TOTALNow1,
				 sum(if((DAY(BookingDate)>7 and DAY(BookingDate)<=14 ) ,1,0)) as TOTALNow2,
				 sum(if((DAY(BookingDate)>14 and DAY(BookingDate)<=21 ) ,1,0)) as TOTALNow3,
				sum(if((DAY(BookingDate)>21 ),1,0)) as TOTALNow4
			 from tour_msbookingdetail inner join (Select tour_msbooking.BookingID,Bookingdate,GroupType from tour_msbooking inner join tour_msproduct on tour_msbooking.IDTourcode=tour_msproduct.IDProduct where TCDivision<>'LTM' and TCDivision <>'LTM-TEZ' and BookingStatus='DEPOSIT' and (year(Bookingdate)='$yer')and  month(Bookingdate)='$i' and tour_msproduct.status<>'VOID')tour_msbooking on tour_msbooking.BookingID =tour_msbookingdetail.BookingID where Gender<>'INFANT'";
				
		  $DTOTAL = mysql_query($QTOTAL) or die(mysql_error());
		  $GraphTOTAL = mysql_fetch_array($DTOTAL);
		  
		  $strXML .="<set value='".$GraphTOTAL[TOTALNow1]."'/>";
		  $strXML .="<set value='".$GraphTOTAL[TOTALNow2]."'/>";
		  $strXML .="<set value='".$GraphTOTAL[TOTALNow3]."'/>";
		  $strXML .="<set value='".$GraphTOTAL[TOTALNow4]."'/>";
		  
		$TOTAL[$i]=$GraphTOTAL[TOTALNow1]+$GraphTOTAL[TOTALNow2]+$GraphTOTAL[TOTALNow3]+$GraphTOTAL[TOTALNow4];
		  
		 
	}

		$strXML .="</dataset>";


//--LAST--//
	$Lastyear=$yer-1;

	$strXML .="<dataset seriesName='$Lastyear'>";
	
	for($i=1;$i<13;$i++)
	{
		 $QLAST="SELECT  sum(if(DAY(BookingDate)<=7 ,1,0)) as LASTNow1,
				 sum(if((DAY(BookingDate)>7 and DAY(BookingDate)<=14 ) ,1,0)) as LASTNow2,
				 sum(if((DAY(BookingDate)>14 and DAY(BookingDate)<=21 ) ,1,0)) as LASTNow3,
				sum(if((DAY(BookingDate)>21 ),1,0)) as LASTNow4
			 from tour_msbookingdetail inner join (Select tour_msbooking.BookingID,Bookingdate,GroupType from tour_msbooking inner join tour_msproduct on tour_msbooking.IDTourcode=tour_msproduct.IDProduct where TCDivision<>'LTM' and TCDivision <>'LTM-TEZ' and BookingStatus='DEPOSIT' and (year(Bookingdate)='$Lastyear')and  month(Bookingdate)='$i' and tour_msproduct.status<>'VOID')tour_msbooking on tour_msbooking.BookingID =tour_msbookingdetail.BookingID where Gender<>'INFANT'";
				
		  $DLAST = mysql_query($QLAST) or die(mysql_error());
		  $GraphLAST = mysql_fetch_array($DLAST);
		  
		  $strXML .="<set value='".$GraphLAST[LASTNow1]."'/>";
		  $strXML .="<set value='".$GraphLAST[LASTNow2]."'/>";
		  $strXML .="<set value='".$GraphLAST[LASTNow3]."'/>";
		  $strXML .="<set value='".$GraphLAST[LASTNow4]."'/>";
		  
		$LAST[$i]=$GraphLAST[LASTNow1]+$GraphLAST[LASTNow2]+$GraphLAST[LASTNow3]+$GraphLAST[LASTNow4];
		  
		 
	}

		$strXML .="</dataset>";



		$strXML .="</chart>";
	
	echo renderChart("FusionChartsXT/Code/FusionCharts/MSLine.swf","", $strXML, "FactorySum", 900, 400, false, true);
	
	//-----------------------end WEEKly chart ------------------------------------------//
	echo"</center></td></tr><tr><th></th></tr>
	<tr><td><CENTER><b>MONTHLY BOOKING</b></center>
	
	</td></tr><tr><td><center>";
	
	//-----------------------MONTHLY chart ------------------------------------------//
	
	
	$strXML2 = "<chart caption='Monthly Booking $yer' xAxisName='Weekly' yAxisName='Pax' showValues='0' >";

   	$strXML2 .="<categories>";
	
	
	for ($i=1;$i<13;$i++)
	{
		 if($i==1){$montText='JAN';}
		 elseif($i=='02'){$montText='FEB';}
		 elseif($i=='03'){$montText='MAR';}
		 elseif($i=='04'){$montText='APR';}
		 elseif($i=='05'){$montText='MAY';}
		 elseif($i=='06'){$montText='JUN';}
		 elseif($i=='07'){$montText='JUL';}
		 elseif($i=='08'){$montText='AUG';}
		 elseif($i=='09'){$montText='SEP';}
		 elseif($i=='10'){$montText='OCT';}
		 elseif($i=='11'){$montText='NOV';}
		 elseif($i=='12'){$montText='DES';}
		 
		$strXML2 .="<category label='$montText' />";
		
	}   
   
  		$strXML2 .="</categories>";


//---SERIES--//

	$strXML2 .="<dataset seriesName='Series'>";
	
	for($i=1;$i<13;$i++)
	{
		
		
		  $strXML2 .="<set value='".$SERIES[$i]."'/>";
	}

		$strXML2 .="</dataset>";
		
		
//--TUREZ--//

	$strXML2 .="<dataset seriesName='TUREZ'>";
	
	for($i=1;$i<13;$i++)
	{
		  
		 $strXML2 .="<set value='".$TUREZ[$i]."'/>";
	}

		$strXML2 .="</dataset>";


		
//--MINISTRY--//

	$strXML2 .="<dataset seriesName='MINISTRY'>";
	
	for($i=1;$i<13;$i++)
	{
		  
		  $strXML2 .="<set value='".$MINISTRY[$i]."'/>";
		 
	}

		$strXML2 .="</dataset>";
		

//--TMR--//

	$strXML2 .="<dataset seriesName='TMR'>";
	
	for($i=1;$i<13;$i++)
	{
	
		$strXML2 .="<set value='".$TMR[$i]."'/>";
		  
		 
	}

		$strXML2 .="</dataset>";

//--TOTAL--//

	$strXML2 .="<dataset seriesName='TOTAL'>";
	
	for($i=1;$i<13;$i++)
	{
		  
		  $strXML2 .="<set value='".$TOTAL[$i]."'/>";
		 
	}

		$strXML2 .="</dataset>";


//--LAST--//
	$Lastyear=$yer-1;

	$strXML2 .="<dataset seriesName='$Lastyear'>";
	
	for($i=1;$i<13;$i++)
	{
 
		  $strXML2 .="<set value='".$LAST[$i]."'/>";	
		 
	}

		$strXML2 .="</dataset>";



		$strXML2 .="</chart>";
	
	echo renderChart("FusionChartsXT/Code/FusionCharts/MSLine.swf","", $strXML2, "FactorySum2", 900, 400, false, true);
	

	//-----------------------END MONTHLY chart ------------------------------------------//
	echo"</td></tr></table>";

   echo"<center><input type=button value=Close onclick=self.history.back()><br><br>";    
   
     break;        

}