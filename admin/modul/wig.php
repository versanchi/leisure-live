<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>WIG</title>
<link rel="stylesheet" href="adminstyle.css">
</head>
<body>
<script type="text/javascript">
	function showBookingID() {

		<?php                                              
			$query = mysql_query("SELECT MarketingID, Event FROM tour_marketing ORDER BY MarketingID ASC");
			
			while ($data = mysql_fetch_array($query)) {
				$booking_place = $data[Event];

				echo "if (document.wig.event.value == \"".$booking_place."\")";
				echo "{";

				$queryBooking = mysql_query("SELECT BookingID FROM tour_msbooking WHERE BookingPlace = '$data[MarketingID]' ORDER BY BookingID ASC ");
				$content = "document.getElementById('booking_id').innerHTML = \"";
				$content .= "<option value=''>- Select Booking ID -</option>";
				while ($dataBooking = mysql_fetch_array($queryBooking)) {
					$content .= "<option value='".$dataBooking['BookingID']."'>".$dataBooking['BookingID']."</option>";
				}
				$content .= "\"";
				echo $content;
				echo "}\n";
				
				echo "else if (document.wig.event.value == ''){";
				
				$content = "document.getElementById('booking_id').innerHTML = \"";
				$content .= "<option value=''></option>";
				
				$content .= "\"";
				echo $content;
				echo "}\n";          
			}
		?>      
	}
  	function validateFormOnSubmit(theForm) {
		var reason = ""; 
		reason += validateEmpty(theForm.customername);
		reason += validateEmpty(theForm.customercp);
		reason += validateEmail(theForm.customeremail);
		reason += validateSelect(theForm.event);
		reason += validateSelect(theForm.destination);
		reason += validateSelect(theForm.periode);
        
		if (reason != "") {
		  alert("Some fields need correction:\n" + reason);
		  return false;
		}
		return confirm("Are you sure want to process?");
	}
	function trim(s) {
		return s.replace(/^\s+|\s+$/, '');
	}
	function validateEmpty(fld) {
		var error = "";
		
		if (fld.value.length == 0) {
			fld.style.background = 'Yellow'; 
			error = "The required field has not been filled in.\n"
		} else {
			fld.style.background = 'White';
		}
		return error;  
	}
	function validateEmail(fld) {
		var error="";
		var tfld = trim(fld.value);                        // value of field with whitespace trimmed off
		var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
		var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;
		
		// if (fld.value == "") {
		// 	fld.style.background = 'Yellow';
		// 	error = "You didn't enter an email address.\n";
		// }
		if (fld.value != "") {
			if (!emailFilter.test(tfld)) {
				fld.style.background = 'Yellow';
				error = "Please enter a valid email address.\n";
			} else if (fld.value.match(illegalChars)) {
				fld.style.background = 'Yellow';
				error = "The email address contains illegal characters.\n";
			} else {
				fld.style.background = 'White';
			}
		} else {
			fld.style.background = 'White';
		}
		return error;
	}
	function validateSelect(fld) {
		var error = "";
		
		if (fld.value == 0) {
			fld.style.background = 'Yellow'; 
			error = "The required field has not been selected.\n"
		} else {
			fld.style.background = 'White';
		}
		return error;  
	}
</script>
<?php
session_start();
	$today = date("Y-m-d");
	switch($_GET[act]) {

		default:
			
			$nama = $_GET['nama'];
			echo "
			<h2>Walk In Guest</h2>
			<form method=get action='media.php?'>
				<input type=hidden name=module value='wig'>
				<input type=text name=nama value='$nama' size=40>	
				<input type=submit name=oke value=Search>
			</form>";

			$oke = $_GET['oke'];

			// Langkah 1
			$batas = 10;
			$halaman =  $_GET['halaman'];
			if (empty($halaman)) {
				$posisi  = 0;
				$halaman = 1;
			} else {
				$posisi = ($halaman-1) * $batas;
			}
  			
  			// Langkah 2
  			if ($_SESSION[employee_office] == 'IFM') {
  				$query = mysql_query("SELECT * FROM pameran_wig WHERE Name LIKE '%$nama%' OR Destination LIKE '%$nama%'
										   ORDER BY CustomerNo ASC LIMIT $posisi,$batas");
  			} else {
  				$query = mysql_query("SELECT * FROM pameran_wig WHERE (Name LIKE '%$nama%' OR Destination LIKE '%$nama%') AND InsertByID = '$_SESSION[employee_code]'
										   ORDER BY CustomerNo ASC LIMIT $posisi,$batas");
  			}
  			$rows = mysql_num_rows($query);
  			
			if ($rows > 0) {
				echo "
				<table>
					<tr>
						<th>No</th>
						<th>Customer Number</th>
						<th>Customer Name</th>
						<th>Telephone</th>
						<th>Email</th>
						<th>Event</th>
						<th>Destination</th>
						<th>Periode</th>
						<th>Invitation</th>
						<th>Booking ID</th>
						<th>Action</th>
					</tr>"; 
					$no = $posisi + 1;
					while ($data = mysql_fetch_array($query)) {
					    echo "
						<tr>
							<td>$no</td>
							<td>$data[CustomerNo]</td>
							<td>$data[Name]</td>
							<td>$data[Telephone]</td>
							<td>$data[Email]</td>
							<td>$data[Event]</td>
							<td>$data[Destination]</td>
							<td>$data[Periode]</td>
							<td><center>$data[Invitation]</td>
							<td>$data[BookingID]</td>
							<td><center><a href=?module=wig&act=edit&id=$data[CustomerID]>Edit</a></td>
						</tr>";
						$no++;
					}
					echo "
				</table>";
  					
  				// Langkah 3
  				if ($_SESSION[employee_office] == 'IFM') {
  					$query = mysql_query("SELECT * FROM pameran_wig WHERE Name LIKE '%$nama%' OR Destination LIKE '%$nama%'");
  				} else {
  					$query = mysql_query("SELECT * FROM pameran_wig WHERE (Name LIKE '%$nama%' OR Destination LIKE '%$nama%') AND InsertByID = '$_SESSION[employee_code]'");
  				}
  				$jmldata = mysql_num_rows($query);
  				$jmlhalaman = ceil($jmldata/$batas);
  				$file = "media.php?module=wig";
  				// Link ke halaman sebelumnya (previous)
  				echo "<center><div id='paging'>";
  				if ($halaman >1) {
  					$previous = $halaman-1;
  					echo "<a href=$file&halaman=1&nama=$nama&oke=$oke> << First</a> |
  	    				  <a href=$file&halaman=$previous&nama=$nama&oke=$oke> < Previous</a> | ";
  				} else {
  					echo "<< First | < Previous | ";
  				}
  				// Tampilkan link halaman 1,2,3 ... modifikasi ala google
  				// Angka awal
  				$angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
  				for ($i=$halaman-2; $i<$halaman; $i++) {
  					if ($i < 1 )
  						continue;
  					$angka .= "<a href=$file&halaman=$i&nama=$nama&oke=$oke>$i</a> ";
  				}
  				// Angka tengah
  				$angka .= " <b>$halaman</b> ";
  				for ($i=$halaman+1; $i<($halaman+3); $i++) {
  					if ($i > $jmlhalaman)
  						break;
  					$angka .= "<a href=$file&halaman=$i&nama=$nama&oke=$oke>$i</a> ";	
  				}
  				// Angka akhir
  				$angka .= ($halaman+2<$jmlhalaman ? " ...
  					<a href=$file&halaman=$jmlhalaman&nama=$nama&oke=$oke>$jmlhalaman</a> |" : " ");
  				// Cetak angka seluruhnya (awal, tengah, akhir)
  				echo "$angka";
  				// Link ke halaman berikutnya (Next)
  				if ($halaman < $jmlhalaman) {
  					$next = $halaman+1;
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
		break;
    
		case "addcustomer":
 			echo "
 			<h2>Add Customer</h2>
			<form name='wig' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=wig&act=input'>
 				<table>

					<tr>
						<td>Name</td>
						<td><input type=text id='customername' name='customername' size=30></td>
					</tr>

					<tr>
						<td>Telephone</td>
						<td><input type=text id='customercp' name='customercp' size=30></td>
					</tr>

					<tr>
						<td>Email</td>
						<td><input type=text id='customeremail' name='customeremail' size=30></td>
					</tr>

					<tr>
						<td>Event</td>
						<td>
							<select name='event' onchange='showBookingID()'>
								<option value=''>- Select Event -</option>";
								$query = mysql_query("SELECT Event FROM tour_marketing WHERE DateFrom <= '$today' AND DateTo >= '$today' AND Status = 'FIX' GROUP BY Event ORDER BY Event ASC");
								while ($data = mysql_fetch_assoc($query)) {
									echo "<option value='$data[Event]'>$data[Event]</option>";
								}
								echo "
							</select>
						</td>
					</tr>

					<tr>
						<td>Destination</td>
						<td>
							<select name='destination'>
								<option value=''>- Select Destination -</option>";
								$query = mysql_query("SELECT Region FROM cim_mscountry GROUP BY Region ORDER BY Region ASC");
								while ($data = mysql_fetch_assoc($query)) {
									echo "<option value='$data[Region]'>$data[Region]</option>";
								}
								echo "
							</select>
						</td>
					</tr>

					<tr>
						<td>Periode</td>
						<td>
							<select name='periode'>
								<option value='' selected>- Select Month -</option>
								<option value='JANUARY'>January</option>
								<option value='FEBRUARY'>February</option>
								<option value='MARCH'>March</option>
								<option value='APRIL'>April</option>
								<option value='MAY'>May</option>
								<option value='JUNE'>June</option>
								<option value='JULY'>July</option>
								<option value='AUGUST'>August</option>
								<option value='SEPTEMBER'>September</option>
								<option value='OCTOBER'>October</option>
								<option value='NOVEMBER'>November</option>
								<option value='DECEMBER'>December</option>
                			</select>
						</td>
					</tr>

					<tr>
						<td style='vertical-align: middle;'>Invitation</td>
						<td>
							<input type='radio' name='invitation' value='YES'> Yes
							<input type='radio' name='invitation' value='NO' checked> No 
						</td>
					</tr>

					<tr>
						<td>Booking ID</td>
						<td>
							<select name='booking_id' id='booking_id'>
								<option value=''>- Please Select Event -</option>
							</select>
						</td>
					</tr>

					<tr>
						<td colspan=3><center><input type=submit value=Save><input type=button value=Cancel onclick=self.history.back()></td>
					</tr>

				</table>
			</form>";
		break;
      
		case "edit":
			$query = mysql_query("SELECT * FROM pameran_wig WHERE CustomerID = '$_GET[id]'");
			$data = mysql_fetch_assoc($query);
      
			echo "
			<h2>Edit Customer</h2>
			<form name='wig' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=wig&act=update'>
				<input type=hidden name=id value='$data[CustomerID]'>
				<table>
					<tr>
						<td>Customer Number</td>
						<td>$data[CustomerNo]</td>
					</tr>
					<tr>
						<td>Name</td>
						<td><input type=text id='customername' name='customername' size=30 value='$data[Name]'></td>
					</tr>
					<tr>
						<td>Telephone</td>
						<td><input type=text id='customercp' name='customercp' size=30 value='$data[Telephone]'></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type=text id='customeremail' name='customeremail' size=30 value='$data[Email]'></td>
					</tr>
					<tr>
						<td>Event</td>
						<td>
							<select name='event' onchange='showBookingID()'>";
								$queryEvent = mysql_query("SELECT Event FROM tour_marketing WHERE DateFrom <= '$today' AND DateTo >= '$today' AND Status = 'FIX' GROUP BY Event ORDER BY Event ASC");
								while ($dataEvent = mysql_fetch_assoc($queryEvent)) {
									echo "<option value='$dataEvent[Event]' "; if ($dataEvent[Event] == $data[Event]) { echo "selected"; } echo ">$dataEvent[Event]</option>";
								}
								echo "
							</select>
						</td>
					</tr>
					<tr>
						<td>Destination</td>
						<td>
							<select name='destination'>";
								$queryRegion = mysql_query("SELECT Region FROM cim_mscountry GROUP BY Region ORDER BY Region ASC");
								while ($dataRegion = mysql_fetch_assoc($queryRegion)) {
									echo "<option value='$dataRegion[Region]' "; if ($dataRegion[Region] == $data[Destination]) { echo "selected"; } echo ">$dataRegion[Region]</option>";
								}
								echo "
							</select>
						</td>
					</tr>
					<tr>
						<td>Periode</td>
						<td>
							<select name='periode'>
								<option value='JANUARY' "; if ($data[Periode] == 'JANUARY') { echo "selected"; } echo ">January</option>
								<option value='FEBRUARY' "; if ($data[Periode] == 'FEBRUARY') { echo "selected"; } echo ">February</option>
								<option value='MARCH' "; if ($data[Periode] == 'MARCH') { echo "selected"; } echo ">March</option>
								<option value='APRIL' "; if ($data[Periode] == 'APRIL') { echo "selected"; } echo ">April</option>
								<option value='MAY' "; if ($data[Periode] == 'MAY') { echo "selected"; } echo ">May</option>
								<option value='JUNE' "; if ($data[Periode] == 'JUNE') { echo "selected"; } echo ">June</option>
								<option value='JULY' "; if ($data[Periode] == 'JULY') { echo "selected"; } echo ">July</option>
								<option value='AUGUST' "; if ($data[Periode] == 'AUGUST') { echo "selected"; } echo ">August</option>
								<option value='SEPTEMBER' "; if ($data[Periode] == 'SEPTEMBER') { echo "selected"; } echo ">September</option>
								<option value='OCTOBER' "; if ($data[Periode] == 'OCTOBER') { echo "selected"; } echo ">October</option>
								<option value='NOVEMBER' "; if ($data[Periode] == 'NOVEMBER') { echo "selected"; } echo ">November</option>
								<option value='DECEMBER' "; if ($data[Periode] == 'DECEMBER') { echo "selected"; } echo ">December</option>
                			</select>
						</td>
					</tr>
					<tr>
						<td style='vertical-align: middle;'>Invitation</td>
						<td>
							<input type='radio' name='invitation' value='YES' "; if($data[Invitation] == 'YES') { echo "checked"; } echo "> Yes
							<input type='radio' name='invitation' value='NO' "; if($data[Invitation] == 'NO') { echo "checked"; } echo "> No 
						</td>
					</tr>
					<tr>
						<td>Booking ID</td>
						<td>
							<select name='booking_id' id='booking_id'>";

								// Select Event
								$selectEvent = mysql_query("SELECT MarketingID FROM tour_marketing WHERE Event = '$data[Event]'");
								$marketingID = mysql_fetch_assoc($selectEvent);

								if (empty($data[BookingID])) {
									echo "<option value=''>- Select Booking ID -</option>";
									$queryBooking = mysql_query("SELECT BookingID FROM tour_msbooking WHERE BookingPlace = '$marketingID[MarketingID]' ORDER BY BookingID ASC ");
									while ($dataBooking = mysql_fetch_assoc($queryBooking)) {
										echo "<option value='$dataBooking[BookingID]'>$dataBooking[BookingID]</option>";
									}
								} else {
									echo "<option value=''>- Select Booking ID -</option>";
									$queryBooking = mysql_query("SELECT BookingID FROM tour_msbooking WHERE BookingPlace = '$marketingID[MarketingID]' ORDER BY BookingID ASC ");
									while ($dataBooking = mysql_fetch_assoc($queryBooking)) {
										echo "<option value='$dataBooking[BookingID]' "; if($data[BookingID] == $dataBooking[BookingID]) { echo "selected"; } echo ">$dataBooking[BookingID]</option>";
									}
								}
								echo "
							</select>
						</td>
					</tr>
					<tr>
						<td colspan=2><center><input type=submit value=Update><input type=button value=Cancel onclick=self.history.back()></td>
					</tr>

				</table>
			</form>";
		break;

	}

?>
</body>

</html> 