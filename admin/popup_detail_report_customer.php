<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" />
<?php                                                           
$dbHost = 'localhost'; // usually localhost                                           
$dbUsername = 'dbvisa';
$dbPassword = 'adminphp';
$dbDatabase = 'zadmin_dbvisa';

//db mwn
/*$dbHost = 'localhost'; // usually localhost
$dbUsername = 'root';
$dbPassword = 'admin8*tour';
$dbDatabase = 't53235_tour'; */
$db = mysql_connect($dbHost, $dbUsername, $dbPassword) or die ("Unable to connect to Database Server.");
mysql_select_db ($dbDatabase, $db) or die ("Could not select database.");

$PassportNo = $_GET['id']; 
$Country = $_GET['country'];
$query = "
SELECT * FROM tour_msbookingdetail
inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbookingdetail.IDTourcode
WHERE tour_msproduct.Destination LIKE '%".$Country."%'  and tour_msbookingdetail.status<>'CANCEL'
AND tour_msbookingdetail.PassportNo = '".$PassportNo."'
ORDER BY IDDetail desc
";
$tampil=mysql_query($query); 
$table = '
<table class="bordered">
	<tr>
		<th>BookingID</th>
		<th>Tour code</th>
		<th>Travel Date</th>
		<th>Destination</th>
		<th>Pax Name</th>
		<th>Passport No</th>
	</tr>';
	
	while ($result = mysql_fetch_array($tampil))
		$table .= '
	<tr>
		<td>'.$result['BookingID'].'</td>
		<td>'.$result['TourCode'].'</td>
		<td>'.$result['DateTravelFrom'].'</td>
		<td>'.$result['Destination'].'</td>
		<td>'.$result['PaxName'].'</td>
		<td>'.$result['PassportNo'].'</td>
	</tr>
		';
	
$table .= '
</table>
';
echo $table;
?>