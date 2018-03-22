<style>
td.hover {cursor: pointer;color: blue}
</style>
<?php
$CompanyID=$_SESSION['company_id'];
$queryTotal = "
SELECT 	tmbd.IDTourCode, tmbd.TourCode, tmbd.PaxName, tmbd.PassportNo,  COUNT(tmbd.IDDetail) as CountDetail, tmbd.IDDetail
FROM 	tour_msbooking tmb
JOIN 	tour_msbookingdetail tmbd ON tmb.BookingID = tmbd.BookingID 
WHERE 	tmb.Status = 'ACTIVE' AND tmb.BookingStatus = 'DEPOSIT' AND tmbd.Status != 'CANCEL' AND tmbd.PassportNo != '' AND tmbd.PaxName != '' AND Dummy='NO'
and TCCompanyID=$CompanyID
GROUP BY tmbd.PassportNo HAVING COUNT(tmbd.IDDetail) > 1
";
$mysql_queryTotal = mysql_query($queryTotal);
$TotalRepeater = mysql_num_rows($mysql_queryTotal);


$queryAll = "
SELECT 	tmbd.IDTourCode, tmbd.TourCode, tmbd.PaxName, tmbd.PassportNo,  COUNT(tmbd.IDDetail) as CountDetail, tmbd.IDDetail
FROM 	tour_msbooking tmb
JOIN 	tour_msbookingdetail tmbd ON tmb.BookingID = tmbd.BookingID 
WHERE 	tmb.Status = 'ACTIVE' AND tmb.BookingStatus = 'DEPOSIT' AND tmbd.Status != 'CANCEL' AND tmbd.PassportNo != '' AND tmbd.PaxName != ''
AND Dummy='NO' and TCCompanyID=$CompanyID
GROUP BY tmbd.PassportNo HAVING COUNT(tmbd.IDDetail) = 1
";
$mysql_queryAll = mysql_query($queryAll);
$TotalNonRepeater = mysql_num_rows($mysql_queryAll);


$query = "
SELECT booking.*, tmp.Destination FROM (
SELECT 	tmbd.IDTourCode, tmbd.TourCode, tmbd.PaxName, tmbd.PassportNo,  COUNT(tmbd.IDDetail) as CountDetail, tmbd.IDDetail
FROM 	tour_msbooking tmb
JOIN 	tour_msbookingdetail tmbd ON tmb.BookingID = tmbd.BookingID 
WHERE 	tmb.Status = 'ACTIVE' AND tmb.BookingStatus = 'DEPOSIT' AND tmbd.Status != 'CANCEL' AND tmbd.PassportNo != '' AND tmbd.PaxName != ''
AND tmbd.PaxName != 'AS DETAIL'
AND Dummy='NO' and TCCompanyID=$CompanyID 
GROUP BY tmbd.PassportNo HAVING COUNT(tmbd.IDDetail) > 1
) booking
INNER JOIN 	tour_msproduct tmp ON tmp.IDProduct = booking.IDTourCode 
WHERE YEAR(tmp.DateTravelFrom) = YEAR(NOW()) OR YEAR(tmp.DateTravelFrom) = (YEAR(NOW()) - 1)
ORDER BY booking.CountDetail DESC, booking.PaxName ASC LIMIT 0, 20
";

$data = '';
$booking = array();
$destination_place = array();
$mysql_query = mysql_query($query);

if ($mysql_query)
{
	while ($result = mysql_fetch_array($mysql_query))
	{
		$query_destination = '
		SELECT tmp.Destination FROM 
				tour_msproduct tmp 
		INNER JOIN tour_msbookingdetail tmbd ON 
				tmp.IDProduct = tmbd.IDTourCode 
		WHERE tmbd.PassportNo = "'.$result['PassportNo'].'" AND tmbd.Status <> "CANCEL"';
		$mysql_query_destination = mysql_query($query_destination);

		$flag = true;
		while ($value_destination = mysql_fetch_array($mysql_query_destination))
		{
			if ($flag)
				$total_destination_place[$result['IDDetail']][$value_destination['Destination']] = 0;
			
			$total_destination_place[$result['IDDetail']][$value_destination['Destination']] = $total_destination_place[$result['IDDetail']][$value_destination['Destination']] + 1;
				// $total_destination_place[$result['IDDetail']][$value_destination['Destination']] = 1;
			// else
			$booking[$result['IDDetail']]['Destination'][$value_destination['Destination']] = $value_destination['Destination'];
			$destination_place[$value_destination['Destination']] = $value_destination['Destination'];
			$flag = false;
		}

		$booking[$result['IDDetail']]['PaxName'] = $result['PaxName'];
		$booking[$result['IDDetail']]['PassportNo'] = $result['PassportNo'];
		$booking[$result['IDDetail']]['TourCode'] = $result['TourCode'];
		$booking[$result['IDDetail']]['CountDetail'] = $result['CountDetail'];
	}
}


foreach ($destination_place as $country => $count)
	$th .= '<th>'.$country.'</th>';
	
foreach ($booking as $IDDetail => $result)
{
	// $th = '';
	// $th .= '<th>'.$result['Destination'].'</th>';
	
	$data .= '
	<tr>
		<td>'.$result['PaxName'].'</td>
		<td>'.$result['PassportNo'].'</td>
		<td style="text-align: center">'.($result['CountDetail']).'</td>';

		foreach ($destination_place as $place)
			if ($place == $result['Destination'][$place])
				$data .= '<td class="hover" style="text-align: center" onclick="window.open(\'popup_detail_report_customer.php?id='.$result['PassportNo'].'&country='.$place.'&companyid='.$CompanyID.'\', \'detail_customer\', \'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=700, height=300, top=100, left=300\')">'.$total_destination_place[$IDDetail][$place].'</td>';
			else
				$data .= '<td></td>';

	$data .= '
	</tr>
	';
}


$table = '
<h4>Report Repeater Client Period '.(date('Y')-1).' - '.date('Y').'</h4>
<p style="text-indent: 0;padding-left: 0;margin: 0">Total Repeater : <b>'.$TotalRepeater.' Pax - '.number_format($TotalRepeater/($TotalRepeater+$TotalNonRepeater)*100, 0, ',', '.').' % </b></p>
<div style="overflow: scroll;width: 100%;height: 400px;">
	<table class="bordered" style="width: 100%">
		<tr>
			<th>PaxName</th>
			<th>PassportNo</th>
			<th>Total</th>'.
			$th.'
		</tr>
		'.
		$data.'
	</table>
</div>
';

echo $table;
?>