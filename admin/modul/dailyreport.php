<script language="JavaScript"  type="text/javascript">   
function ganti() {
document.example.elements['submit'].click(); 
}
</script>
<?php

$username=$_SESSION[employee_code];
$sqluser=mssql_query("SELECT EmployeeID,Employee.DivisiID,LTMAuthority,EmployeeName,JobLevel,Category FROM [HRM].[dbo].[Employee]
                      inner join Divisi on Divisi.DivisiID = Employee.DivisiID
                      WHERE EmployeeID = '$username'");
$tampiluser=mssql_fetch_array($sqluser);
$EmpOff=$tampiluser[DivisiID];
$OffCat=$tampiluser[Category];
$qdivpanel=mssql_query("SELECT DivisiID FROM [HRM].[dbo].[Divisi] WHERE Category = 'PRODUCT' or Category = 'SALES SUPPORT' ");
while($divpanel=mssql_fetch_array($qdivpanel)){
    $divp="AND TCDivision <>'$divpanel[DivisiID]' ";
    $alldiv= $alldiv.''.$divp;
    $divp='';
}

$tuday=$_GET['todaydate'];
    if($tuday==''){$tuday=date("Y-m-d");$hariini = date("l, d M Y");}else{$tuday=$tuday;$hariini =date("l, d M Y", strtotime($tuday));}
    echo "
    <form method=get action='media.php?' name='example' >
    <input type='hidden' name='module' value='dailyreport'>
    <h2><br/>DAILY STATUS: 
    <input type='text' name='todaydate' size='30' value='$hariini'  onClick="."cal.select(document.forms['example'].todaydate,'ActIn1','yyyy-MM-dd'); return false;"." onchange='ganti()' NAME='anchor3' ID='ActIn1' style='text-align: center;font-weight:bold;color:blue; font-size:16;'>
    <input type='submit' name='submit' id='submit' value=Show ></h2>
    </form>"; 
	
	$tudayq=date("Y-m-d",strtotime($tuday));
	
				// menghitung jumlah Group yang belum berangkat
				$Summary=mysql_query("SELECT Department,GroupType,ProductType,sum(if(DUMMY = 'NO',
				                      AdultPax+Childpax,0)) as TotalPax,sum(if(DUMMY = 'YES',
				                      AdultPax+Childpax,0)) as TotalDummyPax,if(DUMMY = 'NO', count(tour_msproduct.TourCode),0) as TotalGroup,
				                      datetravelfrom FROM `tour_msbooking`
				                      inner join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
				                      where DatetravelFrom > '$tudayq' and tour_msbooking.Status='Active' and tour_msproduct.Status <> 'VOID' group by Department,GroupType,ProductType order by Department,GroupType");

				$JumSummary = mysql_num_rows($Summary);
				
				if ($JumSummary >0 ){
					echo "<B><center><font color=orange>SUMMARY UPCOMING GROUP</font></B>
						<table class='bordered'><center>
						<tr><th>Department</th><th>TYPE</th><th>PRODUCT</th><th>TOTAL GROUP</th>";
						
						if($OffCat<>'PRODUCT' and $OffCat<>'SYSTEM DEVELOPER'){
						echo"<th>TOTAL PAX</th></tr>";
						}
						else
						{
						echo"<th>DUMMY PAX</th><th>TOTAL PAX</th></tr>";
						}
						
						$Tgroup=0;
						$Tpax=0;
						$Dumgroup=0;
					 	$Dumpax=0;
						 while($dSummary = mysql_fetch_array($Summary)){			 
						echo "<tr>
                             <td><center>$dSummary[Department]</td>
							 <td><center>$dSummary[GroupType]</td>
							 <td><center>$dSummary[ProductType]</td>
							 <td><center>$dSummary[TotalGroup]</td>";
							 
							 if($OffCat<>'PRODUCT' and $OffCat<>'SYSTEM DEVELOPER'){
							 $Pax=$dSummary[TotalPax]+$dSummary[TotalDummyPax];
							 }
							 else
							 {
							 echo"<td><center>$dSummary[TotalDummyPax]</td>";
							 $Pax=$dSummary[TotalPax];
							 }
							
							 echo"
							 <td><center>$Pax</td>";
							 echo"</tr>";
							 $Tgroup=$dSummary[TotalGroup]+$Tgroup;
							 $Tpax=$Pax+$Tpax;
							 $Dumpax=$dSummary[TotalDummyPax]+$Dumpax;
							 
							 } 
						
						  echo"<tr><td colspan=3><B><center>TOTAL</B></td><td><B><center>$Tgroup</B></td>";
						 
						  if($OffCat=='PRODUCT' OR $OffCat=='SYSTEM DEVELOPER'){
							 echo"<td><B><center>$Dumpax</B></td>";						
						  }
						  
						  
						  
						   echo"
								 <td><B><center>$Tpax</B></td></tr>";	             
						  echo "</table>";

}
	
				// menghitung jumlah season yang belum berangkat
            	$Bulanq= mysql_query("SELECT distinct month(datetravelfrom) as bulan,year(datetravelfrom) as tahun FROM tour_msproduct where datetravelfrom > '$tudayq' group by bulan, tahun order by datetravelfrom");
				
				$JumSeason = mysql_num_rows($Bulanq);
				
				
		if ($JumSeason >0) {

			while ($Typebulan = mysql_fetch_array($Bulanq)) {

				// Kolom untuk summary tour code per season
				$tampil = mysql_query("SELECT Department,Season,GroupType,ProductType,sum(if(DUMMY = 'NO',AdultPax+Childpax,0)) as TotalPax,sum(if(DUMMY = 'YES',AdultPax+Childpax,0)) as TotalDummyPax ,datetravelfrom,month(datetravelfrom) as bulanp, year(datetravelfrom) as tahunp
					FROM `tour_msbooking` inner join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
					where tour_msbooking.Status='Active' and month(tour_msproduct.datetravelfrom) = '$Typebulan[bulan]' and year(datetravelfrom)='$Typebulan[tahun]' and datetravelfrom > '$tudayq'
                    group by Department,GroupType,ProductType order by Department,datetravelfrom");

				$JumData = mysql_num_rows($tampil);

				if ($JumData > 0) {

					$mont = $Typebulan[bulan];
					if ($mont == '01') {
						$montText = 'JAN';
					} elseif ($mont == '02') {
						$montText = 'FEB';
					} elseif ($mont == '03') {
						$montText = 'MAR';
					} elseif ($mont == '04') {
						$montText = 'APR';
					} elseif ($mont == '05') {
						$montText = 'MAY';
					} elseif ($mont == '06') {
						$montText = 'JUN';
					} elseif ($mont == '07') {
						$montText = 'JUL';
					} elseif ($mont == '08') {
						$montText = 'AUG';
					} elseif ($mont == '09') {
						$montText = 'SEP';
					} elseif ($mont == '10') {
						$montText = 'OCT';
					} elseif ($mont == '11') {
						$montText = 'NOV';
					} elseif ($mont == '12') {
						$montText = 'DEC';
					}

					echo "<table>";
					echo "<tr><td><center><B><font size='4' color='red'>DEPARTURE : $montText - $Typebulan[tahun]</font></B><br>
                        ---------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>
						<B><center>Summary pax</B>
						<table class='bordered'><center>
						<tr><th>department</th><th>TYPE</th><th>PRODUCT</th>";
					if ($OffCat == 'PRODUCT' or $OffCat == 'SYSTEM DEVELOPER') {
						echo "<th>DUMMY PAX</th>";
					}
					echo "<th>TOTAL PAX</th></tr>";
					$TPaxSum = 0;
					$TDumPaxSum = 0;

					while ($dd = mysql_fetch_array($tampil)) {

						$Pax = 0;

						echo "<tr>
							 <td><center>$dd[Department]</td>
                             <td><center>$dd[GroupType]</td>
							 <td><center>$dd[ProductType]</td>";
						if ($OffCat == 'PRODUCT' or $OffCat == 'SYSTEM DEVELOPER') {
							echo "<td><center>$dd[TotalDummyPax]</td>";
							$Pax = $dd[TotalPax];
						} else {
							$Pax = $dd[TotalPax] + $dd[TotalDummyPax];
						}
						echo "<td><center>$Pax</td>
							 </tr>";
						$TDumPaxSum = $dd[TotalDummyPax] + $TDumPaxSum;
						$TPaxSum = $Pax + $TPaxSum;
					}

					echo "<tr><td colspan=3><B><center>TOTAL</B></td>";
					if ($OffCat == 'PRODUCT' or $OffCat == 'SYSTEM DEVELOPER') {
						echo "<td><B><center>$TDumPaxSum</B></td>";
					}
					echo "<td><B><center>$TPaxSum</B></td></tr>";
					echo "</table>";


					// detail New booking Today
					if ($OffCat == 'PRODUCT' or $OffCat == 'SYSTEM DEVELOPER') {
						$transaction = mysql_query("SELECT Department,GroupType,BookingId,tour_msbooking.TourCode,TCName,TCNameAlias,TCDivision, AdultPax,ChildPax,DUMMY
                                            FROM `tour_msbooking` inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                            where month(tour_msproduct.datetravelfrom) = '$Typebulan[bulan]' and DATE(Bookingdate) = '$tudayq' and DATE(Bookingdate)<> Date(CancelDate)
                                            and datetravelfrom > '$tudayq' and DUMMY = 'NO' and tour_msproduct.Status <> 'VOID'
                                            and BookingStatus='DEPOSIT'  order by Department,GroupType,TourCode");
					} else {
						$transaction = mysql_query("SELECT Department,GroupType,BookingId,tour_msbooking.TourCode,TCName,TCNameAlias,TCDivision, AdultPax,ChildPax,OfficeCategory,DUMMY
                                            FROM `tour_msbooking` inner join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                            where month(tour_msproduct.datetravelfrom) = '$Typebulan[bulan]' and DATE(Bookingdate) = '$tudayq' and DATE(Bookingdate)<> Date(CancelDate)
                                            and datetravelfrom > '$tudayq' and tour_msproduct.Status <> 'VOID'  and BookingStatus='DEPOSIT'  order by Department,GroupType,TourCode");
					}

					$JumTransaction = mysql_num_rows($transaction);

					if ($JumTransaction > 0) {
						echo "<B><center>Today Booking</B>
							<table class='bordered'><center>
						<tr><th>NO</th><th>department</th><th>TYPE</th><th>TOUR CODE</th><th>BOOKING ID</th><th>TC</th><th>DIVISION</th><th>TOTAL PAX</th></tr>";
						$no = 1;
						$TpaxBook = 0;
						while ($dd = mysql_fetch_array($transaction)) {
							$TotalPax = $dd[AdultPax] + $dd[ChildPax];

							if ($dd[DUMMY] == "YES") {
								$Division = $dd[TCDivisionAlias];
								$TC = $dd[TCNameAlias];
							} else {
								$Division = $dd[TCDivision];
								$TC = $dd[TCName];
							};

							$TotalPax = $dd[AdultPax] + $dd[ChildPax];
							echo "<tr>
							<td><center>$no</td>
							 <td><center>$dd[Department]</td>
                             <td><center>$dd[GroupType]</td>
							 <td><center>$dd[TourCode]</td>
							  <td><center>$dd[BookingId]</td>
							 <td><center>$TC</td>
          					  <td><center>$Division</td>
							 <td><center>$TotalPax</td>
							 </tr>";
							$no++;
							$TpaxBook = $TpaxBook + $TotalPax;
						}

						echo "<tr><td colspan=7><B><center>TOTAL</B></td>
								 <td><B><center>$TpaxBook</B></td></tr>";
						echo "</table>";
					}


					// detail Cancel booking Today
					if ($OffCat == 'PRODUCT' or $OffCat == 'SYSTEM DEVELOPER') {
						$Cancel = mysql_query("SELECT Department,GroupType,BookingId,tour_msbooking.TourCode,TCName,TCNameAlias,TCDivision,TCDivisionAlias,OfficeCategory, AdultPax,ChildPax,ReasonCancel FROM `tour_msbooking` inner join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode  where month(tour_msproduct.datetravelfrom) = '$Typebulan[bulan]' and date(CancelDate) = '$tudayq' and Bookingdate<> Date(CancelDate) and datetravelfrom > '$tudayq' and DUMMY = 'NO'  and tour_msproduct.Status <> 'VOID'  order by Department,GroupType,TourCode");
					} else {
						$Cancel = mysql_query("SELECT Department,GroupType,BookingId,tour_msbooking.TourCode,TCName,TCNameAlias,TCDivision,TCDivisionAlias,OfficeCategory, AdultPax,ChildPax,ReasonCancel,DUMMY
									 FROM `tour_msbooking`
									 inner join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
									 where month(tour_msproduct.datetravelfrom) = '$Typebulan[bulan]' and date(CancelDate) = '$tudayq' and DATE(Bookingdate)<> Date(CancelDate) and datetravelfrom > '$tudayq' and tour_msproduct.Status <> 'VOID' order by Department,GroupType,TourCode");
					}

					$JumCancel = mysql_num_rows($Cancel);

					if ($JumCancel > 0) {
						echo "<B><center>Cancel Booking</B>
							<table class='bordered'><center>
						<tr><th>NO</th><th>department</th><th>TYPE</th><th>TOUR CODE</th><th>BOOKING ID</th><th>TC</th><th>DIVISION</th><th>TOTAL PAX</th><th>REASON</th></tr>";
						$no = 1;
						$TPaxCancel = 0;

						while ($dCancel = mysql_fetch_array($Cancel)) {
							$TotalCancel = $dCancel[AdultPax] + $dCancel[ChildPax];

							if ($dCancel[DUMMY] == "YES") {
								$Division = $dCancel[TCDivisionAlias];
								$TC = $dCancel[TCNameAlias];
								$CancelReason = 'PAX CANCEL';
							} else {
								$Division = $dCancel[TCDivision];
								$TC = $dCancel[TCName];
								$CancelReason = $dCancel[ReasonCancel];
							};

							echo "<tr>
							<td><center>$no</td>
							 <td><center>$dCancel[Department]</td>
                             <td><center>$dCancel[GroupType]</td>
							 <td><center>$dCancel[TourCode]</td>
							  <td><center>$dCancel[BookingId]</td>
							 <td><center>$TC</td>
          					  <td><center>$Division</td>
							 <td><center>$TotalCancel</td>
							 <td><center>$CancelReason</td>
							 </tr>";
							$no++;
							$TPaxCancel = $TPaxCancel + $TotalCancel;
						}

						echo "<tr><td colspan=7><B><center>TOTAL</B></td>
								 <td><B><center>$TPaxCancel</B></td><td></td></tr>";
						echo "</table>";
					}
					echo "</td></tr></table><br>";
				}

				echo "</table>";
			}
		}
