
<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>         
<script type="text/javascript" src="../head/editable-select.js"></script> 
<script language="JavaScript"  type="text/javascript">   
function openprod(ID)
{
 window.location.href = '?module=rpsalesex&act=openproduct&id=' + ID ;
}
function gantidiv() {
    document.getElementById("jenisdiv").submit();
}
</script>

<?php
session_start();
include "../config/koneksi.php";
include "../config/koneksimaster.php";
//include "../config/koneksifbd.php";
$username=$_SESSION[employee_code];
/*$sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_code='$username'");
$tampiluser=mysql_fetch_array($sqluser);*/
$EmpName=$_SESSION[employee_name];
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");

switch($_GET[act]) {
	
	default:
		$CompanyID = $_SESSION['company_id'];
		if($CompanyID=='2'){$filtercompany="and TCCompanyID = '2' ";}else{$filtercompany="and TCCompanyID <> '2' ";}
		$nama = $_GET['nama'];
		$PeriodExh = $_GET['PeriodExh'];
		if ($PeriodExh == '') {
			$PeriodExh = 'NEW';
		}
		echo "<h2>Repot Exhibition Sales</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='rpsalesex'>
			  Exhibition <select name='PeriodExh'>
							<option value='NEW'";
		if ($PeriodExh == 'NEW') {
			echo "selected";
		}
		echo ">NEW</option>
							<option value='PAST'";
		if ($PeriodExh == 'PAST') {
			echo "selected";
		}
		echo ">PAST</option>
            			</select>
			<input type=text name=nama value='$nama' size=20>	
			  <input type=submit name=oke value=Search>
		  </form>";
		$oke = $_GET['oke'];

		// Langkah 1
		$batas = 10;
		$halaman = $_GET['halaman'];
		if (empty($halaman)) {
			$posisi = 0;
			$halaman = 1;
		} else {
			$posisi = ($halaman - 1) * $batas;
		}

		// Langkah 2

		if ($PeriodExh == 'NEW') {
			include "../config/koneksifabs.php";
			$tampil = mysql_query("SELECT * FROM tbl_exhibition WHERE StartDate >= '2016-08-24' and StatusExh ='FIX'  AND ExhibitionName LIKE '%$nama%' ORDER BY
							  	StartDate DESC LIMIT $posisi,$batas");
			$jumlah = mysql_num_rows($tampil);

			if ($jumlah > 0) {

				echo "<table class='bordered'>
          		  <tr><th>no</th><th>exhibition</th><th>date</th><th>location</th><th>Total Deposit</th><th>Adult</th><th>Child</th><th>Infant</th><th>Amount</th></tr>";
				$no = $posisi + 1;

				while ($data = mysql_fetch_array($tampil)) {
					mysql_close($dbfabs);
					include "../config/koneksi.php";
					$d = mysql_query("SELECT count(BookingID) as deppameran,sum(if(tour_msbooking.Status='VOID',1,0)) as Canceldep,sum(tour_msbooking.AdultPax)as totadult,sum(tour_msbooking.ChildPax)as totchild,sum(tour_msbooking.InfantPax)as totinf ,sum((TotalPrice+DevPrice+SeaTaxSell)*Exrate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))) as Amt FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                    WHERE tour_msbooking.BookingPlace = '$data[ExhibitionID]' and Duplicate='NO' and DUMMY='NO' $filtercompany");
					$dd = mysql_fetch_array($d);


					$persen = ($dd[deppameran] != 0) ? ($dd[deppameran] / ($dd[deppameran] + $dd[Canceldep])) * 100 : 0;
					$persennya = round($persen, 2);
					$dari = date("d M Y", strtotime($data[StartDate]));
					$sampai = date("d M Y", strtotime($data[EndDate]));
					echo "<tr><td>$no</td>";
					if ($dd[deppameran] == '0') {
						echo "<td>$data[ExhibitionName]</td>";
					} else {
						echo "<td><a href=?module=rpsalesex&act=showexhibition&Period=New&id=$data[ExhibitionID]>$data[ExhibitionName]</a></td>";
					}
					echo "<td>$dari - $sampai</td>
					 <td>$data[ExhibitionLocation]</td>
					 <td><center>$dd[deppameran]</td>
					 <td><center>$dd[totadult]</td>
					 <td><center>$dd[totchild]</td>
					 <td><center>$dd[totinf]</td>
					 <td style='text-align:right';>" . number_format($dd[Amt], 0, ',', '.') . "</td>
					 </tr>";
					$no++;
				}
				echo "</table>";
				include "../config/koneksifabs.php";
				// Langkah 3
				$tampil2 = "SELECT * FROM tbl_exhibition WHERE StartDate >= '2016-08-24' and StatusExh ='FIX'  AND ExhibitionName LIKE '%$nama%' ORDER BY
							  	StartDate DESC";
				$hasil2 = mysql_query($tampil2);
				$jmldata = mysql_num_rows($hasil2);
				$jmlhalaman = ceil($jmldata / $batas);
				$file = "media.php?module=rpsalesex";
				// Link ke halaman sebelumnya (previous)
				echo "<center><div id='paging'>";
				if ($halaman > 1) {
					$previous = $halaman - 1;
					echo "<a href=$file&halaman=1&nama=$nama&oke=$oke> << First</a> |
	    					  <a href=$file&halaman=$previous&nama=$nama&oke=$oke> < Previous</a> | ";
				} else {
					echo "<< First | < Previous | ";
				}
				// Tampilkan link halaman 1,2,3 ... modifikasi ala google
				// Angka awal
				$angka = ($halaman > 3 ? " ... " : " "); //Ternary Operator
				for ($i = $halaman - 2; $i < $halaman; $i++) {
					if ($i < 1)
						continue;
					$angka .= "<a href=$file&halaman=$i&nama=$nama&oke=$oke>$i</a> ";
				}
				// Angka tengah
				$angka .= " <b>$halaman</b> ";
				for ($i = $halaman + 1; $i < ($halaman + 3); $i++) {
					if ($i > $jmlhalaman)
						break;
					$angka .= "<a href=$file&halaman=$i&nama=$nama&oke=$oke>$i</a> ";
				}
				// Angka akhir
				$angka .= ($halaman + 2 < $jmlhalaman ? " ...
						<a href=$file&halaman=$jmlhalaman&nama=$nama&oke=$oke>$jmlhalaman</a> |" : " ");
				// Cetak angka seluruhnya (awal, tengah, akhir)
				echo "$angka";
				// Link ke halaman berikutnya (Next)
				if ($halaman < $jmlhalaman) {
					$next = $halaman + 1;
					echo "<a href=$file&halaman=$next&nama=$nama&oke=$oke> Next ></a> |
	    					  <a href=$file&halaman=$jmlhalaman&nama=$nama&oke=$oke> Last >></a> ";
				} else {
					echo " Next > | Last >>";
				}
				echo "<br><br>Found <b>$jmldata</b> data(s)<p>";
				echo "</div>";
			} else {
				echo "<div id='paging'>";
				echo "<br><br>Data Not Found<p>";
				echo "</div>";
			}
			mysql_close($dbfabs);
			include "../config/koneksi.php";
		} else {
			$tampil = mysql_query("SELECT * FROM tour_marketing WHERE tour_marketing.Status ='FIX' AND Event LIKE '%$nama%'                                    order by DateFrom DESC LIMIT $posisi,$batas");

			$jumlah = mysql_num_rows($tampil);

			if ($jumlah > 0) {

				echo "<table class='bordered'>
          		  <tr><th>no</th><th>exhibition</th><th>date</th><th>location</th><th>Total Deposit</th><th>Adult</th><th>Child</th><th>Infant</th><th>Amount</th></tr>";
				$no = $posisi + 1;

				while ($data = mysql_fetch_array($tampil)) {

					$d = mysql_query("SELECT count(bookingid) as deppameran,sum(if(tour_msbooking.Status='VOID',1,0)) as Canceldep,sum(tour_msbooking.AdultPax)as totadult,sum(tour_msbooking.ChildPax)as totchild,sum(tour_msbooking.InfantPax)as totinf ,sum((TotalPrice+DevPrice+SeaTaxSell)*Exrate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))) as Amt   FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                    WHERE tour_msbooking.BookingPlaceOLD = '$data[MarketingID]' and Duplicate='NO' and Dummy='NO' and TCCompanyID=$CompanyID");
					$dd = mysql_fetch_array($d);


					$persen = ($dd[deppameran] != 0) ? ($dd[deppameran] / ($dd[deppameran] + $dd[Canceldep])) * 100 : 0;
					$persennya = round($persen, 2);
					$dari = date("d M Y", strtotime($data[DateFrom]));
					$sampai = date("d M Y", strtotime($data[DateTo]));
					echo "<tr><td>$no</td>";
					if ($dd[deppameran] == '0') {
						echo "<td>$data[Event]</td>";
					} else {
						echo "<td><a href=?module=rpsalesex&act=showexhibition&Period=Past&id=$data[MarketingID]>$data[Event]</a></td>";
					}
					echo "<td>$dari - $sampai</td>
					 <td>$data[Place]</td>
					 <td><center>$dd[deppameran]</td>
					 <td><center>$dd[totadult]</td>
					 <td><center>$dd[totchild]</td>
					 <td><center>$dd[totinf]</td>
					 <td style='text-align:right';>" . number_format($dd[Amt], 0, ',', '.') . "</td>
					 </tr>";
					$no++;
				}
				echo "</table>";

				// Langkah 3
				$tampil2 = "SELECT * FROM tour_marketing WHERE Status ='FIX'  AND Event LIKE '%$nama%'";
				$hasil2 = mysql_query($tampil2);
				$jmldata = mysql_num_rows($hasil2);
				$jmlhalaman = ceil($jmldata / $batas);
				$file = "media.php?module=rpsalesex";
				// Link ke halaman sebelumnya (previous)
				echo "<center><div id='paging'>";
				if ($halaman > 1) {
					$previous = $halaman - 1;
					echo "<a href=$file&halaman=1&nama=$nama&PeriodExh=PAST&oke=$oke> << First</a> |
	    					  <a href=$file&halaman=$previous&nama=$nama&PeriodExh=PAST&oke=$oke> < Previous</a> | ";
				} else {
					echo "<< First | < Previous | ";
				}
				// Tampilkan link halaman 1,2,3 ... modifikasi ala google
				// Angka awal
				$angka = ($halaman > 3 ? " ... " : " "); //Ternary Operator
				for ($i = $halaman - 2; $i < $halaman; $i++) {
					if ($i < 1)
						continue;
					$angka .= "<a href=$file&halaman=$i&nama=$nama&PeriodExh=PAST&oke=$oke>$i</a> ";
				}
				// Angka tengah
				$angka .= " <b>$halaman</b> ";
				for ($i = $halaman + 1; $i < ($halaman + 3); $i++) {
					if ($i > $jmlhalaman)
						break;
					$angka .= "<a href=$file&halaman=$i&nama=$nama&PeriodExh=PAST&oke=$oke>$i</a> ";
				}
				// Angka akhir
				$angka .= ($halaman + 2 < $jmlhalaman ? " ...
						<a href=$file&halaman=$jmlhalaman&nama=$nama&PeriodExh=PAST&oke=$oke>$jmlhalaman</a> |" : " ");
				// Cetak angka seluruhnya (awal, tengah, akhir)
				echo "$angka";
				// Link ke halaman berikutnya (Next)
				if ($halaman < $jmlhalaman) {
					$next = $halaman + 1;
					echo "<a href=$file&halaman=$next&nama=$nama&PeriodExh=PAST&oke=$oke> Next ></a> |
	    					  <a href=$file&halaman=$jmlhalaman&nama=$nama&PeriodExh=PAST&oke=$oke> Last >></a> ";
				} else {
					echo " Next > | Last >>";
				}
				echo "<br><br>Found <b>$jmldata</b> data(s)<p>";
				echo "</div>";
			} else {
				echo "<div id='paging'>";
				echo "<br><br>Data Not Found<p>";
				echo "</div>";
			}
		}


		break;

///////////////////////////////////////////////////////////////////////////////  detail  ////////////////////////////////////////////////////////

	case "showexhibition":

		$Pameran = $_GET['id'];
		$Tanggal = '';
		$PeriodExh = $_GET['Period'];
		$headdir = $_GET['headdir'];
		if($headdir <> ''){
            $qdivid = mssql_query("SELECT DivisiID FROM [HRM].[dbo].[Divisi]
                                  WHERE DIV = '$headdir' 
                                  AND Category = 'SALES OUTLET' 
                                  AND CompanyGroup <> 'SISTER COMPANY'
                                  AND Active = 1 
                                  order by DivisiID ASC");
            $a = 1;
            while($ddivid = mssql_fetch_array($qdivid)){
                if($a == 1){
                    $div = "AND (TCDivision = '$ddivid[DivisiID]'";
                }else{
                    $div = " OR TCDivision = '$ddivid[DivisiID]'";
                }
                $divisi = $divisi.$div;
                $a++;
            }
            $divisiid="$divisi)";
        }else{
            $divisiid='';
        }

		if ($PeriodExh == 'New') {
			include "../config/koneksifabs.php";
			$title = mysql_query("SELECT * FROM tbl_exhibition WHERE ExhibitionID= '$Pameran'");

			$Dtitle = mysql_fetch_array($title);
			echo "<form method='get' id='jenisdiv' action='media.php?'>
            <input type=hidden name=module value='rpsalesex'><input type=hidden name='act' value='showexhibition'>
            <input type=hidden name='id' value='$_GET[id]'><input type=hidden name='Period' value='$_GET[Period]'>
            <b>Exhibition : $Dtitle[ExhibitionName]
		    <br>
		    Period &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	: " . date("d M Y", strtotime($Dtitle[StartDate])) . " - " . date("d M Y", strtotime($Dtitle[EndDate])) . "</b>
		    <br>
		    Base On &nbsp;&nbsp;&nbsp;&nbsp;: <select name='headdir' onchange='gantidiv()'><option value=''";if($headdir==''){echo"selected";}echo">ALL</option>";
            $qdivpanel = mssql_query("SELECT DIV FROM [HRM].[dbo].[Divisi]
                                  WHERE Category = 'SALES OUTLET' AND CompanyGroup <> 'SISTER COMPANY'
                                  AND Active = 1 GROUP BY DIV
                                  order by DIV ASC");
            while($ddiv = mssql_fetch_array($qdivpanel)){
                echo"<option value='$ddiv[DIV]'";if($headdir==$ddiv[DIV]){echo"selected";}echo">$ddiv[DIV]</option>";
            }
            echo"</select>
            </form>";


			mysql_close($dbfabs);
			include "../config/koneksi.php";

			$Dept = mysql_query("SELECT * from tour_msproducttype where status='ACTIVE'");
			$Dep = 1;
			while ($DDepartment = mysql_fetch_array($Dept)) {
				$Department[$Dep] = $DDepartment[ProducttypeName];
				if ($Department[$Dep] == "LEISURE") {
					$WarnaDep[$Dep] = '#FD7304';
				}
				if ($Department[$Dep] == "TUR EZ") {
					$WarnaDep[$Dep] = '#16C53F';
				}
				if ($Department[$Dep] == "MINISTRY") {
					$WarnaDep[$Dep] = '#FC0101';
				}
				// if($Department[$Dep]=="DRY TICKET"){$WarnaDep[$Dep]='#FAF704';}
				if ($Department[$Dep] == "TMR") {
					$WarnaDep[$Dep] = '#0882FF';
				}
				$Dep++;
			}

			$tgldetail = mysql_query("SELECT DATE(BookingDate)as BookingDate from tour_msbooking where BookingPlace='$Pameran' $divisiid group by DATE(BookingDate) order by BookingDate");


			echo "<table> ";

			while ($tglPameran = mysql_fetch_array($tgldetail)) {
				for ($j = 1; $j < $Dep; $j++) {
					$Amt[$j] = 0;
				}
				if ($Tanggal != '') {
					echo "<tr><th colspan=3;></th></tr>";
				};
				$Tanggal = date("d M Y", strtotime($tglPameran[BookingDate]));
				echo "<tr><td style='border-color:white'; colspan=3;><font color='blue' size='2'>Date: $Tanggal</font></td></tr>";

				$no = 1;
				$totaladult = 0;
				$totalchild = 0;
				$totalinfant = 0;
				$totalAmtdetail = 0;

				echo "<tr><td style='width:47%; border-color:white'>
			  <table class='bordered'><tr><th>no</th><th width='250'>TourCode</th><th>Booking ID</th><th>TC</th><th>Divisi</th><th>Adult</th><th>Child</th><th>Infant</th><th>Amount</th><th>Status</th></tr>";
				$edit = mysql_query("SELECT tour_msbooking.TourCode,tour_msbooking.BookingID,tour_msbooking.TCName,tour_msbooking.TCDivision,tour_msbooking.status,tour_msbooking.AdultPax,
                                tour_msbooking.ChildPax,tour_msbooking.InfantPax,tour_msbooking.Curr ,((TotalPrice+DevPrice+SeaTaxSell)*Exrate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))) as Amt
                                FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
                                WHERE tour_msbooking.BookingPlace = '$Pameran' $divisiid and DATE(tour_msbooking.BookingDate)='$tglPameran[BookingDate]' and Duplicate='NO'
                                order by tour_msbooking.BookingID asc");

				while ($r1 = mysql_fetch_array($edit)) {

					echo "<tr><td>$no</td>
			  		<td>$r1[TourCode]</td>
                    <td>$r1[BookingID]</td>
					<td>$r1[TCName]</td>
					<td>$r1[TCDivision]</td>
					<td><center>$r1[AdultPax]</td>
					<td><center>$r1[ChildPax]</td>
					<td><center>$r1[InfantPax]</td>
					<td style='text-align:right';>" . number_format($r1[Amt], 0, ',', '.') . "</td>";
					if ($r1[status] == 'VOID') {
						echo "<td>VOID</td></tr>";
					} else {
						echo "<td></td></tr>";
					}
					$no++;
					$totaladult = $totaladult + $r1[AdultPax];
					$totalchild = $totalchild + $r1[ChildPax];
					$totalinfant = $totalinfant + $r1[InfantPax];
					$totalAmtdetail = $totalAmtdetail + $r1[Amt];
				};

				echo "<tr><td colspan=5><center><b>TOTAL</b></td></td><td><center><b>$totaladult</b></td><td><center><b>$totalchild</b></td><td><center><b>$totalinfant</b></td><td style='text-align:right';><b>" . number_format($totalAmtdetail, 0, ',', '.') . "</b></td><td></td></tr></table>";
				echo "</td>";


				echo "<td style='width:1%; border-color:white'> </td>";

				//per departemen
				echo "<td style='width:47%; border-color:white'>";

				echo "<table class='bordered'><tr><th bgcolor='#000000'; rowspan=2><font color='#FFFFFF'>No</th><td bgcolor='#000000'; rowspan=2><font color='#FFFFFF'>Destination</td>";
				for ($j = 1; $j < $Dep; $j++) {
					echo "<td  bgcolor='$WarnaDep[$j]' colspan=2><center>$Department[$j]</td>";
				}
				echo "<th bgcolor='#000000' colspan=2><center><font color='#FFFFFF'>Total</th></tr><tr>";

				for ($j = 1; $j < $Dep; $j++) {
					echo "<td  bgcolor='$WarnaDep[$j]' ><center>Pax</td>";
					echo "<td  bgcolor='$WarnaDep[$j]' ><center>Amount</td>";
					$TotPax[$j] = 0;
					$AmtUSD[$j] = 0;
					$TotalPaxAll = 0;
					$TotalAmount = 0;
				}
				echo "<td bgcolor='#000000'><font color='#FFFFFF'>Pax</td><td bgcolor='#000000'><font color='#FFFFFF'>Amount</td></tr>";
				$No = 1;

				$DtlBooking = mysql_query("SELECT Destination,
	  							sum(tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax)as totPax ,
								sum((TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))) as Amt,
								
								sum(if(Department='$Department[1]' ,(AdultPax+ChildPax+InfantPax),0)) as totPax1 ,
								sum(if( Department='$Department[1]' ,((TotalPrice+DevPrice+SeaTaxSell)*Exrate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))),0)) as Amt1,								
								sum(if(Department='$Department[2]' ,tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax,0)) as totPax2,
								sum(if( Department='$Department[2]' ,((TotalPrice+DevPrice+SeaTaxSell)*Exrate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))),0)) as Amt2,
								
								sum(if(Department='$Department[3]' ,tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax,0)) as totPax3,
								sum(if( Department='$Department[3]' ,((TotalPrice+DevPrice+SeaTaxSell)*Exrate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))),0)) as Amt3,
								
								sum(if(Department='$Department[4]' ,tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax,0)) as totPax4,
								sum(if(Department='$Department[4]' ,((TotalPrice+DevPrice+SeaTaxSell)*Exrate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))),0)) as Amt4,
								
								sum(if(Department='$Department[5]' ,tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax,0)) as totPax5 ,
								sum(if(Department='$Department[5]' ,((TotalPrice+DevPrice+SeaTaxSell)*Exrate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))),0)) as Amt5
									
							FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
                                    WHERE tour_msbooking.BookingPlace = '$Pameran' $divisiid and DATE(tour_msbooking.BookingDate)='$tglPameran[BookingDate]' and Duplicate='NO' group by Destination order by totPax desc");

				while ($DDtlBooking = mysql_fetch_array($DtlBooking)) {

					echo "<tr><td>$No</td><td>$DDtlBooking[Destination]</td>";
					$TotalDest = 0;
					$AMTDest = 0;


					for ($j = 1; $j < $Dep; $j++) {

						$Pax = 'totPax' . $j;
						$USD = 'Amt' . $j;
						echo "<td bgcolor='$WarnaDep[$j]'><center>$DDtlBooking[$Pax]</td>";
						echo "<td bgcolor='$WarnaDep[$j]'><center>" . number_format($DDtlBooking[$USD], 0, ',', '.') . "</td>";
						$TotPax[$j] = $TotPax[$j] + $DDtlBooking[$Pax];
						$Amt[$j] = $Amt[$j] + $DDtlBooking[$USD];
					}

					echo "<td bgcolor='$WarnaDep[$j]'><center>$DDtlBooking[totPax]</td>";
					echo "<td bgcolor='$WarnaDep[$j]'><center>" . number_format($DDtlBooking[Amt], 0, ',', '.') . "</td></tr>";
					$TotalPaxAll = $TotalPaxAll + $DDtlBooking[totPax];
					$TotalAmount = $TotalAmount + $DDtlBooking[Amt];

					$No++;
				}

				echo "<tr><td colspan=2><b><center>Total</center></b></td>";
				for ($j = 1; $j < $Dep; $j++) {
					echo "<td bgcolor='$WarnaDep[$j]'><center><b>$TotPax[$j]</b></td>";
					echo "<td bgcolor='$WarnaDep[$j]'><center><b>" . number_format($Amt[$j], 0, ',', '.') . "</b></td>";
				}

				echo "<td>$TotalPaxAll</td><td><b>" . number_format($TotalAmount, 0, ',', '.') . "</b></td></tr>";


				echo "</table>";

				//TC
				$no = 1;
				echo "<table class='bordered'><tr><th>no</th><th width='250'>TC Name</th><th>Divisi</th><th>Adult</th><th>Child</th><th>Infant</th><th>Amount</th></tr>";
				$TotalAmtTC = 0;
				$editTC = mysql_query("SELECT tour_msbooking.TCName,tour_msbooking.TCDivision,sum(tour_msbooking.AdultPax) as AdultPax,sum(tour_msbooking.ChildPax) as ChildPax,sum(tour_msbooking.InfantPax) as InfantPax,tour_msbooking.Curr ,sum((TotalPrice+DevPrice+SeaTaxSell)*Exrate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))) as Amt ,sum(tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax) as Pax FROM tour_msbooking 
                                             inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
                                             WHERE tour_msbooking.BookingPlace = '$Pameran' $divisiid and DATE(tour_msbooking.BookingDate)='$tglPameran[BookingDate]' and Duplicate='NO' group by TCName order by Amt desc");

				while ($rTC = mysql_fetch_array($editTC)) {
					echo "<tr><td>$no</td>
					<td>$rTC[TCName]</td>
					<td>$rTC[TCDivision]</td>
					<td><center>$rTC[AdultPax]</td>
					<td><center>$rTC[ChildPax]</td>
					<td><center>$rTC[InfantPax]</td>
					<td style='text-align:right';>" . number_format($rTC[Amt], 0, ',', '.') . "</td>
					</tr>";
					$TotalAmtTC = $TotalAmtTC + $rTC[Amt];
					$no++;
				};


				echo "<tr><td colspan=6><center><b>Total</b></td><td><b>" . number_format($TotalAmtTC, 0, ',', '.') . "</b></td></tr>";
				echo "</table>";


				echo "</td></tr>";

			};

			echo "<tr><th colspan=3;></th></tr>";


			//summarry
			echo "<tr>";
			echo "<tr><td style='border-color:white'; colspan=3;><font color='blue' size='2'>Summary</font></td></tr>";

			$no = 1;
			$totaladult = 0;
			$totalchild = 0;
			$totalinfant = 0;
			$totalDeposit = 0;
			$totalAmtSum = 0;

			echo "<tr><td style='width:47%; border-color:white'>
			  <table class='bordered'><tr><th>no</th><th width='250'>TourCode</th><th>Deposit</th><th>Adult</th><th>Child</th><th>Infant</th><th>Amount</th></tr>";

			$Sumedit = mysql_query("SELECT tour_msbooking.TourCode,count(tour_msbooking.BookingID) as Grp,sum(tour_msbooking.AdultPax) as AdultPax,sum(tour_msbooking.ChildPax) as ChildPax,sum(tour_msbooking.InfantPax) as InfantPax,tour_msbooking.Curr ,sum((TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))) as Amt ,sum(tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax) as Pax 
                                          FROM tour_msbooking 
                                          inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
                                          WHERE tour_msbooking.BookingPlace= '$Pameran' $divisiid and Duplicate='NO' group by TourCode order by Pax desc");

			while ($Sumr1 = mysql_fetch_array($Sumedit)) {
				echo "<tr><td>$no</td>
			  		<td>$Sumr1[TourCode]</td>
					<td><center>$Sumr1[Grp]</td>
					<td><center>$Sumr1[AdultPax]</td>
					<td><center>$Sumr1[ChildPax]</td>
					<td><center>$Sumr1[InfantPax]</td>
					<td style='text-align:right';>" . number_format($Sumr1[Amt], 0, ',', '.') . "</td>
					</tr>";
				$no++;
				$totalDeposit = $totalDeposit + $Sumr1[Grp];
				$totaladult = $totaladult + $Sumr1[AdultPax];
				$totalchild = $totalchild + $Sumr1[ChildPax];
				$totalinfant = $totalinfant + $Sumr1[InfantPax];
				$totalAmtSum = $totalAmtSum + $Sumr1[Amt];

			};

			echo "<tr><td colspan=2><center><b>TOTAL</b></td><td><center><b>$totalDeposit</b></td><td><center><b>$totaladult</b></td><td><center><b>$totalchild</b></td><td><center><b>$totalinfant</b></td><td style='text-align:right';><b>" . number_format($totalAmtSum, 0, ',', '.') . "</b></td></tr></table>";
			echo "</td>";


			echo "<td style='width:1%; border-color:white'></td>";

			//per departemen
			echo "<td style='width:47%; border-color:white'>";

			echo "<table class='bordered'><tr><th bgcolor='#000000'; rowspan=2><font color='#FFFFFF'>No</td><td bgcolor='#000000'; rowspan=2><font color='#FFFFFF'>Destination</th>";
			for ($j = 1; $j < $Dep; $j++) {
				echo "<td  bgcolor='$WarnaDep[$j]' colspan=2><center>$Department[$j]</td>";
			}
			echo "<th bgcolor='#000000' colspan=2><center><font color='#FFFFFF'>Total</th></tr><tr>";

			for ($j = 1; $j < $Dep; $j++) {
				echo "<td  bgcolor='$WarnaDep[$j]' ><center>Pax</td>";
				echo "<td  bgcolor='$WarnaDep[$j]' ><center>Amount</td>";
				$TotPax[$j] = 0;
				$AmtUSD[$j] = 0;
				$TotalPaxAll = 0;
				$TotalUSD = 0;
			}
			echo "<td bgcolor='#000000'><font color='#FFFFFF'>Pax</td><td bgcolor='#000000'><font color='#FFFFFF'>Amount</td></tr>";
			$No = 1;

			$SumDtlBooking = mysql_query("SELECT Destination,
	  							sum(tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax)as totPax ,
								sum((TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))) as Amt ,								
								sum(if(Department='$Department[1]' ,(AdultPax+ChildPax+InfantPax),0)) as totPax1 ,
								sum(if(Department='$Department[1]' ,(TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)),0)) as Amt1,
								
								sum(if(Department='$Department[2]' ,tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax,0)) as totPax2,
								sum(if(Department='$Department[2]' , (TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)),0)) as Amt2,
								
								sum(if(Department='$Department[3]' ,tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax,0)) as totPax3,
								sum(if(Department='$Department[3]' , (TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)),0)) as Amt3,
								
								sum(if(Department='$Department[4]' ,tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax,0)) as totPax4,
								sum(if(Department='$Department[4]' ,(TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)),0)) as Amt4,
								
								sum(if(Department='$Department[5]' ,tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax,0)) as totPax5 ,
								sum(if(Department='$Department[5]' , (TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)),0)) as Amt5
									
							FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
                                    WHERE tour_msbooking.BookingPlace = '$Pameran' $divisiid and Duplicate='NO' group by Destination order by totPax desc");

			while ($SumDDtlBooking = mysql_fetch_array($SumDtlBooking)) {

				echo "<tr><td>$No</td><td>$SumDDtlBooking[Destination]</td>";
				$TotalDest = 0;
				$AMTDest = 0;

				for ($j = 1; $j < $Dep; $j++) {

					$Pax = 'totPax' . $j;
					$USD = 'Amt' . $j;
					echo "<td bgcolor='$WarnaDep[$j]'><center>$SumDDtlBooking[$Pax]</td>";
					echo "<td bgcolor='$WarnaDep[$j]'><center>" . number_format($SumDDtlBooking[$USD], 0, ',', '.') . "</td>";
					$TotPax[$j] = $TotPax[$j] + $SumDDtlBooking[$Pax];
					$AmtSum[$j] = $AmtSum[$j] + $SumDDtlBooking[$USD];
				}

				echo "<td bgcolor='$WarnaDep[$j]'><center>$SumDDtlBooking[totPax]</td>";
				echo "<td bgcolor='$WarnaDep[$j]'><center>" . number_format($SumDDtlBooking[Amt], 0, ',', '.') . "</td></tr>";
				$TotalPaxAll = $TotalPaxAll + $SumDDtlBooking[totPax];
				$TotalAmtSum = $TotalAmtSum + $SumDDtlBooking[Amt];

				$No++;
			}

			echo "<tr><td colspan=2><center><b>Total</b></center></td>";
			for ($j = 1; $j < $Dep; $j++) {
				echo "<td bgcolor='$WarnaDep[$j]'><b><center>$TotPax[$j]</b></td>";
				echo "<td bgcolor='$WarnaDep[$j]'><b><center>" . number_format($AmtSum[$j], 0, ',', '.') . "</b></td>";
			}
			echo "<td>$TotalPaxAll</td><td><b>" . number_format($TotalAmtSum, 0, ',', '.') . "</b></td></tr>";
			echo "</table>";

			//TC
			$no = 1;
			$totalsalesTC = 0;
			echo "<table class='bordered'><tr><th>no</th><th width='250'>TC Name</th><th>Divisi</th><th>Adult</th><th>Child</th><th>Infant</th><th>Amount</th></tr>";

			$SumeditTC = mysql_query("SELECT tour_msbooking.TCName,tour_msbooking.TCDivision,sum(tour_msbooking.AdultPax) as AdultPax,sum(tour_msbooking.ChildPax) as ChildPax,sum(tour_msbooking.InfantPax) as InfantPax,tour_msbooking.Curr ,sum((TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)))  as Amt ,sum(tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax) as Pax 
                                            FROM tour_msbooking 
                                            inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
                                            WHERE tour_msbooking.BookingPlace = '$Pameran' $divisiid and Duplicate='NO' group by TCName order by Amt desc");

			while ($SumrTC = mysql_fetch_array($SumeditTC)) {
				echo "<tr><td>$no</td>
					<td>$SumrTC[TCName]</td>
					<td>$SumrTC[TCDivision]</td>
					<td><center>$SumrTC[AdultPax]</td>
					<td><center>$SumrTC[ChildPax]</td>
					<td><center>$SumrTC[InfantPax]</td>
					<td style='text-align:right';>" . number_format($SumrTC[Amt], 0, ',', '.') . "</td>
					</tr>";
				if ($ProduktifTC == '') {
					$ProduktifTC = "'" . $SumrTC[TCName] . "'";
				} else {
					$ProduktifTC = $ProduktifTC . ",'" . $SumrTC[TCName] . "'";
				}
				$totalsalesTC = $totalsalesTC + $SumrTC[Amt];
				$no++;
			};

			//TC tidak produktif
			$NonSalesTC = mysql_query("SELECT * FROM `tour_crewpameran` WHERE `IDEvent`=$Pameran and `EmployeeName` not in ($ProduktifTC)  and EmployeeName<>'' order by EmployeeName");
			while ($DNonSalesTC = mysql_fetch_array($NonSalesTC)) {
				echo "<tr><td>$no</td>
					<td>$DNonSalesTC[EmployeeName]</td>
					<td>$DNonSalesTC[EmployeeDiv]</td>
					<td><center>0</td>
					<td><center>0</td>
					<td><center>0</td>
					<td style='text-align:right';>0</td>
					</tr>";
				$no++;

			};
			echo "<tr><td colspan=6><b><center>Total</center></b></td><td><b>" . number_format($totalsalesTC, 0, ',', '.') . "</b></td></tr>";

			echo "</table><br><br>";

			//rekap summary per departure

			$Bykbln = mysql_query("SELECT distinct month(datetravelfrom) as bln FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode WHERE tour_msbooking.BookingPlace = '$Pameran' and Duplicate='NO' order by bln");

			$jumBykbln = mysql_num_rows($Bykbln);
			$j = 1;
			while ($Blndep = mysql_fetch_array($Bykbln)) {
				$i = "$Blndep[bln]";
				if ($i == 1) {
					$montText[$j] = 'JAN';
					$monthA[$j] = 1;
				} elseif ($i == '02') {
					$montText[$j] = 'FEB';
					$monthA[$j] = 2;
				} elseif ($i == '03') {
					$montText[$j] = 'MAR';
					$monthA[$j] = 3;
				} elseif ($i == '04') {
					$montText[$j] = 'APR';
					$monthA[$j] = 4;
				} elseif ($i == '05') {
					$montText[$j] = 'MAY';
					$monthA[$j] = 5;
				} elseif ($i == '06') {
					$montText[$j] = 'JUN';
					$monthA[$j] = 6;
				} elseif ($i == '07') {
					$montText[$j] = 'JUL';
					$monthA[$j] = 7;
				} elseif ($i == '08') {
					$montText[$j] = 'AUG';
					$monthA[$j] = 8;
				} elseif ($i == '09') {
					$montText[$j] = 'SEP';
					$monthA[$j] = 9;
				} elseif ($i == '10') {
					$montText[$j] = 'OCT';
					$monthA[$j] = 10;
				} elseif ($i == '11') {
					$montText[$j] = 'NOV';
					$monthA[$j] = 11;
				} elseif ($i == '12') {
					$montText[$j] = 'DES';
					$monthA[$j] = 12;
				}
				$j++;
			}

			echo "<table><tr><th>Travel Period</th>";
			for ($i = 1; $i < $j; $i++) {
				echo "<th>$montText[$i]</th>";
			}
			echo "<th>TOTAL</th></tr>";
			mysql_data_seek($tgldetail, 0);
			$TotalBooking = 0;
			$jumBooking = 0;
			while ($tglSumPameran = mysql_fetch_array($tgldetail)) {
				$Tanggal = date("d M Y", strtotime($tglSumPameran[BookingDate]));
				echo "<tr><td>$Tanggal</td>";
				$TotalBooking = 0;
				$jumBooking = 0;
				for ($i = 1; $i < $j; $i++) {
					$SumBooking = mysql_query("SELECT sum(tour_msbooking.AdultPax) as AdultPax,sum(tour_msbooking.ChildPax) as ChildPax,sum(tour_msbooking.InfantPax) as InfantPax,tour_msbooking.Curr ,sum((TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)))  as Amt ,sum(tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax) as Pax 
                                                      FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
                                                      WHERE tour_msbooking.BookingPlace = '$Pameran' $divisiid  and DATE(BookingDate)='$tglSumPameran[BookingDate]' and month(DateTravelFrom)='$monthA[$i]' and Duplicate='NO' group by DATE(BookingDate)");
					$DSumBooking = mysql_fetch_array($SumBooking);

					if ($DSumBooking[Pax] == '') {
						$jumBooking = 0;
					} else {
						$jumBooking = $DSumBooking[Pax];
					}
					echo "<td><center>$jumBooking</td>";
					$Booking[$i] = $Booking[$i] + $jumBooking;
					$TotalBooking = $TotalBooking + $jumBooking;
				}

				echo "<td><center>$TotalBooking</td></tr>";

			}

			echo "<tr><td><b><center>Total</center></b></td>";
			$TTLBooking = 0;
			for ($i = 1; $i < $j; $i++) {
				echo "<td><center>$Booking[$i]</td>";
				$TTLBooking = $TTLBooking + $Booking[$i];
			}
			echo "<td><center>$TTLBooking</td></tr>";

			echo "<tr><td><b><center>%</center></b></td>";

			for ($i = 1; $i < $j; $i++) {
				echo "<td><center>" . number_format($Booking[$i] / $TTLBooking * 100, 2, ',', '.');
				echo " % </td>";

			}
			echo "<td><center>" . number_format($TTLBooking / $TTLBooking * 100, 0, ',', '.');
			echo " % </td></tr>";

			echo "</table><br>";

			echo "</td></tr>";

			echo "</tr>";
			echo "<tr><th colspan=3;></th></tr><tr><td style='border-color:white'; colspan=3;>";

// table per product type

			echo "<table><tr><th>Product</th>";
			for ($i = 1; $i < $Dep; $i++) {
				echo "<td  bgcolor='$WarnaDep[$i]' colspan=$jumBykbln;><center><b>$Department[$i]</b></center></td><td  bgcolor='$WarnaDep[$i]'; rowspan=2;><center><b>Total</center></b></td>";
			}

			echo "<tr><th>Travel Period</th>";

			for ($P = 1; $P < $Dep; $P++) {
				for ($i = 1; $i < $j; $i++) {
					echo "<td  bgcolor='$WarnaDep[$P]'><center><b>$montText[$i]</b></center></td>";
				}

			}
			echo "</tr><tr>";

			echo "</tr>";

			mysql_data_seek($tgldetail, 0);


			while ($tglSumPameran = mysql_fetch_array($tgldetail)) {
				$Tanggal = date("d M Y", strtotime($tglSumPameran[BookingDate]));

				for ($i = 1; $i < $Dep; $i++) {
					$Total[$i] = 0;
				}

				echo "<tr><td>$Tanggal</td>";


				for ($Prod = 1; $Prod < $Dep; $Prod++) {

					//ini untuk Series
					for ($i = 1; $i < $j; $i++) {
						$SumPNO = mysql_query("SELECT sum(tour_msbooking.AdultPax) as AdultPax,sum(tour_msbooking.ChildPax) as ChildPax,sum(tour_msbooking.InfantPax) as InfantPax,tour_msbooking.Curr ,sum((TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)))  as Amt ,sum(tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax) as Pax 
                                                      FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
                                                      WHERE tour_msbooking.BookingPlace = '$Pameran' $divisiid and DATE(BookingDate)='$tglSumPameran[BookingDate]' and month(datetravelfrom)='$monthA[$i]' and tour_msproduct.Department='$Department[$Prod]' and Duplicate='NO' group by DATE(BookingDate)");
						$DSumPNO = mysql_fetch_array($SumPNO);

						if ($DSumPNO[Pax] == '') {
							$jumPNO = 0;
						} else {
							$jumPNO = $DSumPNO[Pax];
						}
						echo "<td bgcolor='$WarnaDep[$Prod]'><center>$jumPNO</td>";
						$Total[$Prod] = $Total[$Prod] + $jumPNO;
					}

					echo "<td bgcolor='$WarnaDep[$Prod]'><center>$Total[$Prod]</td>";
				}

			}

			echo "</tr><tr><td><b><center>Total</center></b></td>";

			for ($Prod = 1; $Prod < $Dep; $Prod++) {
				$TTLAll[$Prod] = 0;

				for ($i = 1; $i < $j; $i++) {
					$SumAll = mysql_query("SELECT sum(tour_msbooking.AdultPax) as AdultPax,sum(tour_msbooking.ChildPax) as ChildPax,sum(tour_msbooking.InfantPax) as InfantPax,tour_msbooking.Curr ,sum((TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)))  as Amt ,sum(tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax) as Pax 
                                                  FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
                                                  WHERE tour_msbooking.BookingPlace = '$Pameran' $divisiid and month(datetravelfrom)='$monthA[$i]' and tour_msproduct.Department='$Department[$Prod]' and Duplicate='NO' group by month(datetravelfrom)");
					$DSumAll = mysql_fetch_array($SumAll);

					if ($DSumAll[Pax] == '') {
						$jumAll = 0;
					} else {
						$jumAll = $DSumAll[Pax];
					}
					echo "<td bgcolor='$WarnaDep[$Prod]'><center>$jumAll</td>";
					$TTLAll[$Prod] = $TTLAll[$Prod] + $jumAll;
				}

				echo "<td bgcolor='$WarnaDep[$Prod]'><center>$TTLAll[$Prod]</td>";
			}


			echo "</tr>";
			echo "</table>";

			echo "</td></tr></table>";

			echo "<center><input type=button value=Back onclick=location.href='?module=rpsalesex'></center><br>";

		} else {
			//untuk masa transii
			$title = mysql_query("SELECT * FROM tour_marketing where MarketingID= '$Pameran'");

			$Dtitle = mysql_fetch_array($title);
			echo "<b>Exhibition : $Dtitle[Event]
		  <br>
		  Period &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	: " . date("d M Y", strtotime($Dtitle[DateFrom])) . " - " . date("d M Y", strtotime($Dtitle[DateTo])) . "</b>";

			$Dept = mysql_query("SELECT * from tour_msproducttype where status='ACTIVE'");
			$Dep = 1;
			while ($DDepartment = mysql_fetch_array($Dept)) {
				$Department[$Dep] = $DDepartment[ProducttypeName];
				if ($Department[$Dep] == "LEISURE") {
					$WarnaDep[$Dep] = '#FD7304';
				}
				if ($Department[$Dep] == "TUR EZ") {
					$WarnaDep[$Dep] = '#16C53F';
				}
				if ($Department[$Dep] == "MINISTRY") {
					$WarnaDep[$Dep] = '#FC0101';
				}
				// if($Department[$Dep]=="DRY TICKET"){$WarnaDep[$Dep]='#FAF704';}
				if ($Department[$Dep] == "TMR") {
					$WarnaDep[$Dep] = '#0882FF';
				}
				$Dep++;
			}

			$tgldetail = mysql_query("SELECT DATE(BookingDate)as BookingDate from tour_msbooking where BookingPlaceOLD ='$Pameran' group by DATE(BookingDate) order by BookingDate");


			echo "<table> ";

			while ($tglPameran = mysql_fetch_array($tgldetail)) {
				for ($j = 1; $j < $Dep; $j++) {
					$Amt[$j] = 0;
				}
				if ($Tanggal != '') {
					echo "<tr><th colspan=3;></th></tr>";
				};
				$Tanggal = date("d M Y", strtotime($tglPameran[BookingDate]));
				echo "<tr><td style='border-color:white'; colspan=3;><font color='blue' size='2'>Date: $Tanggal</font></td></tr>";

				$no = 1;
				$totaladult = 0;
				$totalchild = 0;
				$totalinfant = 0;
				$totalAmtdetail = 0;

				echo "<tr><td style='width:47%; border-color:white'>
			  <table class='bordered'><tr><th>no</th><th width='250'>TourCode</th><th>Booking ID</th><th>TC</th><th>Divisi</th><th>Adult</th><th>Child</th><th>Infant</th><th>Amount</th><th>Status</th></tr>";
				$edit = mysql_query("SELECT tour_msbooking.TourCode,tour_msbooking.BookingID,tour_msbooking.TCName,tour_msbooking.TCDivision,tour_msbooking.status,tour_msbooking.AdultPax,
                                tour_msbooking.ChildPax,tour_msbooking.InfantPax,tour_msbooking.Curr ,((TotalPrice+DevPrice+SeaTaxSell)*Exrate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))) as Amt
                                FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
                                WHERE tour_msbooking.BookingPlaceOLD = '$Pameran' and DATE(tour_msbooking.BookingDate)='$tglPameran[BookingDate]' and Duplicate='NO'
                                order by tour_msbooking.BookingID asc");

				while ($r1 = mysql_fetch_array($edit)) {

					echo "<tr><td>$no</td>
			  		<td>$r1[TourCode]</td>
                    <td>$r1[BookingID]</td>
					<td>$r1[TCName]</td>
					<td>$r1[TCDivision]</td>
					<td><center>$r1[AdultPax]</td>
					<td><center>$r1[ChildPax]</td>
					<td><center>$r1[InfantPax]</td>
					<td style='text-align:right';>" . number_format($r1[Amt], 0, ',', '.') . "</td>";
					if ($r1[status] == 'VOID') {
						echo "<td>VOID</td></tr>";
					} else {
						echo "<td></td></tr>";
					}
					$no++;
					$totaladult = $totaladult + $r1[AdultPax];
					$totalchild = $totalchild + $r1[ChildPax];
					$totalinfant = $totalinfant + $r1[InfantPax];
					$totalAmtdetail = $totalAmtdetail + $r1[Amt];
				};

				echo "<tr><td colspan=5><center><b>TOTAL</b></td></td><td><center><b>$totaladult</b></td><td><center><b>$totalchild</b></td><td><center><b>$totalinfant</b></td><td style='text-align:right';><b>" . number_format($totalAmtdetail, 0, ',', '.') . "</b></td><td></td></tr></table>";
				echo "</td>";


				echo "<td style='width:1%; border-color:white'> </td>";

				//per departemen
				echo "<td style='width:47%; border-color:white'>";

				echo "<table class='bordered'><tr><th bgcolor='#000000'; rowspan=2><font color='#FFFFFF'>No</th><td bgcolor='#000000'; rowspan=2><font color='#FFFFFF'>Destination</td>";
				for ($j = 1; $j < $Dep; $j++) {
					echo "<td  bgcolor='$WarnaDep[$j]' colspan=2><center>$Department[$j]</td>";
				}
				echo "<th bgcolor='#000000' colspan=2><center><font color='#FFFFFF'>Total</th></tr><tr>";

				for ($j = 1; $j < $Dep; $j++) {
					echo "<td  bgcolor='$WarnaDep[$j]' ><center>Pax</td>";
					echo "<td  bgcolor='$WarnaDep[$j]' ><center>Amount</td>";
					$TotPax[$j] = 0;
					$AmtUSD[$j] = 0;
					$TotalPaxAll = 0;
					$TotalAmount = 0;
				}
				echo "<td bgcolor='#000000'><font color='#FFFFFF'>Pax</td><td bgcolor='#000000'><font color='#FFFFFF'>Amount</td></tr>";
				$No = 1;

				$DtlBooking = mysql_query("SELECT Destination,
	  							sum(tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax)as totPax ,
								sum((TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))) as Amt,
								
								sum(if(Department='$Department[1]' ,(AdultPax+ChildPax+InfantPax),0)) as totPax1 ,
								sum(if( Department='$Department[1]' ,((TotalPrice+DevPrice+SeaTaxSell)*Exrate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))),0)) as Amt1,								
								sum(if(Department='$Department[2]' ,tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax,0)) as totPax2,
								sum(if( Department='$Department[2]' ,((TotalPrice+DevPrice+SeaTaxSell)*Exrate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))),0)) as Amt2,
								
								sum(if(Department='$Department[3]' ,tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax,0)) as totPax3,
								sum(if( Department='$Department[3]' ,((TotalPrice+DevPrice+SeaTaxSell)*Exrate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))),0)) as Amt3,
								
								sum(if(Department='$Department[4]' ,tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax,0)) as totPax4,
								sum(if(Department='$Department[4]' ,((TotalPrice+DevPrice+SeaTaxSell)*Exrate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))),0)) as Amt4,
								
								sum(if(Department='$Department[5]' ,tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax,0)) as totPax5 ,
								sum(if(Department='$Department[5]' ,((TotalPrice+DevPrice+SeaTaxSell)*Exrate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))),0)) as Amt5
									
							FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
                                    WHERE tour_msbooking.BookingPlaceOLD = '$Pameran' and DATE(tour_msbooking.BookingDate)='$tglPameran[BookingDate]' and Duplicate='NO' group by Destination order by totPax desc");

				while ($DDtlBooking = mysql_fetch_array($DtlBooking)) {

					echo "<tr><td>$No</td><td>$DDtlBooking[Destination]</td>";
					$TotalDest = 0;
					$AMTDest = 0;


					for ($j = 1; $j < $Dep; $j++) {

						$Pax = 'totPax' . $j;
						$USD = 'Amt' . $j;
						echo "<td bgcolor='$WarnaDep[$j]'><center>$DDtlBooking[$Pax]</td>";
						echo "<td bgcolor='$WarnaDep[$j]'><center>" . number_format($DDtlBooking[$USD], 0, ',', '.') . "</td>";
						$TotPax[$j] = $TotPax[$j] + $DDtlBooking[$Pax];
						$Amt[$j] = $Amt[$j] + $DDtlBooking[$USD];
					}

					echo "<td bgcolor='$WarnaDep[$j]'><center>$DDtlBooking[totPax]</td>";
					echo "<td bgcolor='$WarnaDep[$j]'><center>" . number_format($DDtlBooking[Amt], 0, ',', '.') . "</td></tr>";
					$TotalPaxAll = $TotalPaxAll + $DDtlBooking[totPax];
					$TotalAmount = $TotalAmount + $DDtlBooking[Amt];

					$No++;
				}

				echo "<tr><td colspan=2><b><center>Total</center></b></td>";
				for ($j = 1; $j < $Dep; $j++) {
					echo "<td bgcolor='$WarnaDep[$j]'><center><b>$TotPax[$j]</b></td>";
					echo "<td bgcolor='$WarnaDep[$j]'><center><b>" . number_format($Amt[$j], 0, ',', '.') . "</b></td>";
				}

				echo "<td>$TotalPaxAll</td><td><b>" . number_format($TotalAmount, 0, ',', '.') . "</b></td></tr>";


				echo "</table>";

				//TC
				$no = 1;
				echo "<table class='bordered'><tr><th>no</th><th width='250'>TC Name</th><th>Divisi</th><th>Adult</th><th>Child</th><th>Infant</th><th>Amount</th></tr>";
				$TotalAmtTC = 0;
				$editTC = mysql_query("SELECT tour_msbooking.TCName,tour_msbooking.TCDivision,sum(tour_msbooking.AdultPax) as AdultPax,sum(tour_msbooking.ChildPax) as ChildPax,sum(tour_msbooking.InfantPax) as InfantPax,tour_msbooking.Curr ,sum((TotalPrice+DevPrice+SeaTaxSell)*Exrate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))) as Amt ,sum(tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax) as Pax FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode WHERE tour_msbooking.BookingPlaceOLD = '$Pameran' and DATE(tour_msbooking.BookingDate)='$tglPameran[BookingDate]' and Duplicate='NO' group by TCName order by Amt desc");

				while ($rTC = mysql_fetch_array($editTC)) {
					echo "<tr><td>$no</td>
					<td>$rTC[TCName]</td>
					<td>$rTC[TCDivision]</td>
					<td><center>$rTC[AdultPax]</td>
					<td><center>$rTC[ChildPax]</td>
					<td><center>$rTC[InfantPax]</td>
					<td style='text-align:right';>" . number_format($rTC[Amt], 0, ',', '.') . "</td>
					</tr>";
					$TotalAmtTC = $TotalAmtTC + $rTC[Amt];
					$no++;
				};


				echo "<tr><td colspan=6><center><b>Total</b></td><td><b>" . number_format($TotalAmtTC, 0, ',', '.') . "</b></td></tr>";
				echo "</table>";

				echo "</td></tr>";

			};

			echo "<tr><th colspan=3;></th></tr>";

			//summarry
			echo "<tr>";
			echo "<tr><td style='border-color:white'; colspan=3;><font color='blue' size='2'>Summary</font></td></tr>";

			$no = 1;
			$totaladult = 0;
			$totalchild = 0;
			$totalinfant = 0;
			$totalDeposit = 0;

			$totalAmtSum = 0;

			echo "<tr><td style='width:47%; border-color:white'>
			  <table class='bordered'><tr><th>no</th><th width='250'>TourCode</th><th>Deposit</th><th>Adult</th><th>Child</th><th>Infant</th><th>Amount</th></tr>";

			$Sumedit = mysql_query("SELECT tour_msbooking.TourCode,count(tour_msbooking.BookingID) as Grp,sum(tour_msbooking.AdultPax) as AdultPax,sum(tour_msbooking.ChildPax) as ChildPax,sum(tour_msbooking.InfantPax) as InfantPax,tour_msbooking.Curr ,sum((TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))) as Amt ,sum(tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax) as Pax FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode WHERE tour_msbooking.BookingPlaceOLD = '$Pameran' and Duplicate='NO' group by TourCode order by Pax desc");

			while ($Sumr1 = mysql_fetch_array($Sumedit)) {
				echo "<tr><td>$no</td>
			  		<td>$Sumr1[TourCode]</td>
					<td><center>$Sumr1[Grp]</td>
					<td><center>$Sumr1[AdultPax]</td>
					<td><center>$Sumr1[ChildPax]</td>
					<td><center>$Sumr1[InfantPax]</td>
					<td style='text-align:right';>" . number_format($Sumr1[Amt], 0, ',', '.') . "</td>
					</tr>";
				$no++;
				$totalDeposit = $totalDeposit + $Sumr1[Grp];
				$totaladult = $totaladult + $Sumr1[AdultPax];
				$totalchild = $totalchild + $Sumr1[ChildPax];
				$totalinfant = $totalinfant + $Sumr1[InfantPax];
				$totalAmtSum = $totalAmtSum + $Sumr1[Amt];

			};

			echo "<tr><td colspan=2><center><b>TOTAL</b></td><td><center><b>$totalDeposit</b></td><td><center><b>$totaladult</b></td><td><center><b>$totalchild</b></td><td><center><b>$totalinfant</b></td><td style='text-align:right';><b>" . number_format($totalAmtSum, 0, ',', '.') . "</b></td></tr></table>";
			echo "</td>";


			echo "<td style='width:1%; border-color:white'></td>";

			//per departemen
			echo "<td style='width:47%; border-color:white'>";

			echo "<table class='bordered'><tr><th bgcolor='#000000'; rowspan=2><font color='#FFFFFF'>No</td><td bgcolor='#000000'; rowspan=2><font color='#FFFFFF'>Destination</th>";
			for ($j = 1; $j < $Dep; $j++) {
				echo "<td  bgcolor='$WarnaDep[$j]' colspan=2><center>$Department[$j]</td>";
			}
			echo "<th bgcolor='#000000' colspan=2><center><font color='#FFFFFF'>Total</th></tr><tr>";

			for ($j = 1; $j < $Dep; $j++) {
				echo "<td  bgcolor='$WarnaDep[$j]' ><center>Pax</td>";
				echo "<td  bgcolor='$WarnaDep[$j]' ><center>Amount</td>";
				$TotPax[$j] = 0;
				$AmtUSD[$j] = 0;
				$TotalPaxAll = 0;
				$TotalUSD = 0;
			}
			echo "<td bgcolor='#000000'><font color='#FFFFFF'>Pax</td><td bgcolor='#000000'><font color='#FFFFFF'>Amount</td></tr>";
			$No = 1;

			$SumDtlBooking = mysql_query("SELECT Destination,
	  							sum(tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax)as totPax ,
								sum((TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate))) as Amt ,								
								sum(if(Department='$Department[1]' ,(AdultPax+ChildPax+InfantPax),0)) as totPax1 ,
								sum(if(Department='$Department[1]' ,(TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)),0)) as Amt1,
								
								sum(if(Department='$Department[2]' ,tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax,0)) as totPax2,
								sum(if(Department='$Department[2]' , (TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)),0)) as Amt2,
								
								sum(if(Department='$Department[3]' ,tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax,0)) as totPax3,
								sum(if(Department='$Department[3]' , (TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)),0)) as Amt3,
								
								sum(if(Department='$Department[4]' ,tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax,0)) as totPax4,
								sum(if(Department='$Department[4]' ,(TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)),0)) as Amt4,
								
								sum(if(Department='$Department[5]' ,tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax,0)) as totPax5 ,
								sum(if(Department='$Department[5]' , (TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)),0)) as Amt5
									
							FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
                                    WHERE tour_msbooking.BookingPlaceOLD = '$Pameran' and Duplicate='NO' group by Destination order by totPax desc");


			while ($SumDDtlBooking = mysql_fetch_array($SumDtlBooking)) {

				echo "<tr><td>$No</td><td>$SumDDtlBooking[Destination]</td>";
				$TotalDest = 0;
				$AMTDest = 0;

				for ($j = 1; $j < $Dep; $j++) {

					$Pax = 'totPax' . $j;
					$USD = 'Amt' . $j;
					echo "<td bgcolor='$WarnaDep[$j]'><center>$SumDDtlBooking[$Pax]</td>";
					echo "<td bgcolor='$WarnaDep[$j]'><center>" . number_format($SumDDtlBooking[$USD], 0, ',', '.') . "</td>";
					$TotPax[$j] = $TotPax[$j] + $SumDDtlBooking[$Pax];
					$AmtSum[$j] = $AmtSum[$j] + $SumDDtlBooking[$USD];
				}

				echo "<td bgcolor='$WarnaDep[$j]'><center>$SumDDtlBooking[totPax]</td>";
				echo "<td bgcolor='$WarnaDep[$j]'><center>" . number_format($SumDDtlBooking[Amt], 0, ',', '.') . "</td></tr>";
				$TotalPaxAll = $TotalPaxAll + $SumDDtlBooking[totPax];
				$TotalAmtSum = $TotalAmtSum + $SumDDtlBooking[Amt];

				$No++;
			}

			echo "<tr><td colspan=2><center><b>Total</b></center></td>";
			for ($j = 1; $j < $Dep; $j++) {
				echo "<td bgcolor='$WarnaDep[$j]'><b><center>$TotPax[$j]</b></td>";
				echo "<td bgcolor='$WarnaDep[$j]'><b><center>" . number_format($AmtSum[$j], 0, ',', '.') . "</b></td>";
			}

			echo "<td>$TotalPaxAll</td><td><b>" . number_format($TotalAmtSum, 0, ',', '.') . "</b></td></tr>";

			echo "</table>";

			//TC
			$no = 1;
			$totalsalesTC = 0;
			echo "<table class='bordered'><tr><th>no</th><th width='250'>TC Name</th><th>Divisi</th><th>Adult</th><th>Child</th><th>Infant</th><th>Amount</th></tr>";

			$SumeditTC = mysql_query("SELECT tour_msbooking.TCName,tour_msbooking.TCDivision,sum(tour_msbooking.AdultPax) as AdultPax,sum(tour_msbooking.ChildPax) as ChildPax,sum(tour_msbooking.InfantPax) as InfantPax,tour_msbooking.Curr ,sum((TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)))  as Amt ,sum(tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax) as Pax FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode WHERE tour_msbooking.BookingPlaceOLD = '$Pameran' and Duplicate='NO' group by TCName order by Amt desc");

			while ($SumrTC = mysql_fetch_array($SumeditTC)) {
				echo "<tr><td>$no</td>
					<td>$SumrTC[TCName]</td>
					<td>$SumrTC[TCDivision]</td>
					<td><center>$SumrTC[AdultPax]</td>
					<td><center>$SumrTC[ChildPax]</td>
					<td><center>$SumrTC[InfantPax]</td>
					<td style='text-align:right';>" . number_format($SumrTC[Amt], 0, ',', '.') . "</td>
					</tr>";
				if ($ProduktifTC == '') {
					$ProduktifTC = "'" . $SumrTC[TCName] . "'";
				} else {
					$ProduktifTC = $ProduktifTC . ",'" . $SumrTC[TCName] . "'";
				}
				$totalsalesTC = $totalsalesTC + $SumrTC[Amt];
				$no++;
			};


			//TC tidak produktif
			$NonSalesTC = mysql_query("SELECT * FROM `tour_crewpameran` WHERE `IDEvent`=$Pameran and `EmployeeName` not in ($ProduktifTC)  and EmployeeName<>'' order by EmployeeName");
			while ($DNonSalesTC = mysql_fetch_array($NonSalesTC)) {
				echo "<tr><td>$no</td>
					<td>$DNonSalesTC[EmployeeName]</td>
					<td>$DNonSalesTC[EmployeeDiv]</td>
					<td><center>0</td>
					<td><center>0</td>
					<td><center>0</td>
					<td style='text-align:right';>0</td>
					</tr>";
				$no++;

			};
			echo "<tr><td colspan=6><b><center>Total</center></b></td><td><b>" . number_format($totalsalesTC, 0, ',', '.') . "</b></td></tr>";

			echo "</table><br><br>";

			//rekap summary per departure

			$Bykbln = mysql_query("SELECT distinct month(datetravelfrom) as bln FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode WHERE tour_msbooking.BookingPlaceOLD = '$Pameran' and Duplicate='NO' order by bln");

			$jumBykbln = mysql_num_rows($Bykbln);
			$j = 1;
			while ($Blndep = mysql_fetch_array($Bykbln)) {
				$i = "$Blndep[bln]";
				if ($i == 1) {
					$montText[$j] = 'JAN';
					$monthA[$j] = 1;
				} elseif ($i == '02') {
					$montText[$j] = 'FEB';
					$monthA[$j] = 2;
				} elseif ($i == '03') {
					$montText[$j] = 'MAR';
					$monthA[$j] = 3;
				} elseif ($i == '04') {
					$montText[$j] = 'APR';
					$monthA[$j] = 4;
				} elseif ($i == '05') {
					$montText[$j] = 'MAY';
					$monthA[$j] = 5;
				} elseif ($i == '06') {
					$montText[$j] = 'JUN';
					$monthA[$j] = 6;
				} elseif ($i == '07') {
					$montText[$j] = 'JUL';
					$monthA[$j] = 7;
				} elseif ($i == '08') {
					$montText[$j] = 'AUG';
					$monthA[$j] = 8;
				} elseif ($i == '09') {
					$montText[$j] = 'SEP';
					$monthA[$j] = 9;
				} elseif ($i == '10') {
					$montText[$j] = 'OCT';
					$monthA[$j] = 10;
				} elseif ($i == '11') {
					$montText[$j] = 'NOV';
					$monthA[$j] = 11;
				} elseif ($i == '12') {
					$montText[$j] = 'DES';
					$monthA[$j] = 12;
				}
				$j++;
			}


			echo "<table><tr><th>Travel Period</th>";
			for ($i = 1; $i < $j; $i++) {
				echo "<th>$montText[$i]</th>";
			}
			echo "<th>TOTAL</th></tr>";
			mysql_data_seek($tgldetail, 0);


			while ($tglSumPameran = mysql_fetch_array($tgldetail)) {
				$Tanggal = date("d M Y", strtotime($tglSumPameran[BookingDate]));
				echo "<tr><td>$Tanggal</td>";


				for ($i = 1; $i < $j; $i++) {
					$SumBooking = mysql_query("SELECT sum(tour_msbooking.AdultPax) as AdultPax,sum(tour_msbooking.ChildPax) as ChildPax,sum(tour_msbooking.InfantPax) as InfantPax,tour_msbooking.Curr ,sum((TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)))  as Amt ,sum(tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax) as Pax FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode WHERE tour_msbooking.BookingPlaceOLD = '$Pameran'  and DATE(BookingDate)='$tglSumPameran[BookingDate]' and month(DateTravelFrom)='$monthA[$i]' and Duplicate='NO' group by DATE(BookingDate)");
					$DSumBooking = mysql_fetch_array($SumBooking);

					if ($DSumBooking[Pax] == '') {
						$jumBooking = 0;
					} else {
						$jumBooking = $DSumBooking[Pax];
					}
					echo "<td><center>$jumBooking</td>";
					$Booking[$i] = $Booking[$i] + $jumBooking;
					$TotalBooking = $TotalBooking + $jumBooking;
				}

				echo "<td><center>$TotalBooking</td></tr>";

			}

			echo "<tr><td><b><center>Total</center></b></td>";

			for ($i = 1; $i < $j; $i++) {
				echo "<td><center>$Booking[$i]</td>";
				$TTLBooking = $TTLBooking + $Booking[$i];
			}
			echo "<td><center>$TTLBooking</td></tr>";

			echo "<tr><td><b><center>%</center></b></td>";

			for ($i = 1; $i < $j; $i++) {
				echo "<td><center>" . number_format($Booking[$i] / $TTLBooking * 100, 2, ',', '.');
				echo " % </td>";

			}
			echo "<td><center>" . number_format($TTLBooking / $TTLBooking * 100, 0, ',', '.');
			echo " % </td></tr>";

			echo "</table><br>";

			echo "</td></tr>";

			echo "</tr>";
			echo "<tr><th colspan=3;></th></tr><tr><td style='border-color:white'; colspan=3;>";

// table per product type

			echo "<table><tr><th>Product</th>";
			for ($i = 1; $i < $Dep; $i++) {
				echo "<td  bgcolor='$WarnaDep[$i]' colspan=$jumBykbln;><center><b>$Department[$i]</b></center></td><td  bgcolor='$WarnaDep[$i]'; rowspan=2;><center><b>Total</center></b></td>";
			}

			echo "<tr><th>Travel Period</th>";

			for ($P = 1; $P < $Dep; $P++) {
				for ($i = 1; $i < $j; $i++) {
					echo "<td  bgcolor='$WarnaDep[$P]'><center><b>$montText[$i]</b></center></td>";
				}

			}

			echo "</tr><tr>";

			echo "</tr>";

			mysql_data_seek($tgldetail, 0);

			while ($tglSumPameran = mysql_fetch_array($tgldetail)) {
				$Tanggal = date("d M Y", strtotime($tglSumPameran[BookingDate]));

				for ($i = 1; $i < $Dep; $i++) {
					$Total[$i] = 0;
				}

				echo "<tr><td>$Tanggal</td>";


				for ($Prod = 1; $Prod < $Dep; $Prod++) {

					//ini untuk Series
					for ($i = 1; $i < $j; $i++) {
						$SumPNO = mysql_query("SELECT sum(tour_msbooking.AdultPax) as AdultPax,sum(tour_msbooking.ChildPax) as ChildPax,sum(tour_msbooking.InfantPax) as InfantPax,tour_msbooking.Curr ,sum((TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)))  as Amt ,sum(tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax) as Pax FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode WHERE tour_msbooking.BookingPlaceOLD = '$Pameran'  and DATE(BookingDate)='$tglSumPameran[BookingDate]' and month(datetravelfrom)='$monthA[$i]' and tour_msproduct.Department='$Department[$Prod]' and Duplicate='NO' group by DATE(BookingDate)");
						$DSumPNO = mysql_fetch_array($SumPNO);

						if ($DSumPNO[Pax] == '') {
							$jumPNO = 0;
						} else {
							$jumPNO = $DSumPNO[Pax];
						}
						echo "<td bgcolor='$WarnaDep[$Prod]'><center>$jumPNO</td>";
						$Total[$Prod] = $Total[$Prod] + $jumPNO;
					}

					echo "<td bgcolor='$WarnaDep[$Prod]'><center>$Total[$Prod]</td>";
				}

			}

			echo "</tr><tr><td><b><center>Total</center></b></td>";

			for ($Prod = 1; $Prod < $Dep; $Prod++) {
				$TTLAll[$Prod] = 0;

				for ($i = 1; $i < $j; $i++) {
					$SumAll = mysql_query("SELECT sum(tour_msbooking.AdultPax) as AdultPax,sum(tour_msbooking.ChildPax) as ChildPax,sum(tour_msbooking.InfantPax) as InfantPax,tour_msbooking.Curr ,sum((TotalPrice+DevPrice+SeaTaxSell)*exRate+((AdultPax+ChildPax)*if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate)))  as Amt ,sum(tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax) as Pax FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode WHERE tour_msbooking.BookingPlaceOLD = '$Pameran'  and month(datetravelfrom)='$monthA[$i]' and tour_msproduct.Department='$Department[$Prod]' and Duplicate='NO' group by month(datetravelfrom)");
					$DSumAll = mysql_fetch_array($SumAll);

					if ($DSumAll[Pax] == '') {
						$jumAll = 0;
					} else {
						$jumAll = $DSumAll[Pax];
					}
					echo "<td bgcolor='$WarnaDep[$Prod]'><center>$jumAll</td>";
					$TTLAll[$Prod] = $TTLAll[$Prod] + $jumAll;
				}


				echo "<td bgcolor='$WarnaDep[$Prod]'><center>$TTLAll[$Prod]</td>";
			}


			echo "</tr>";
			echo "</table>";
			echo "</td></tr></table>";
			echo "<center><input type=button value=Back onclick=location.href='?module=rpsalesex'></center><br>";
		}

		break;
}
?>
