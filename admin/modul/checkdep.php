<?php 
// This is a sample code in case you wish to check the username from a mysql db table
//include "./mod/koneksi.php";   
if(isSet($_POST['depositno'])) {
    $depositno = $_POST['depositno'];
    $comp = $_POST['comp'];
    $dbHost = 'localhost'; // usually localhost
    $dbUsername = 'dbvisa';
    $dbPassword = 'adminphp';
    $dbDatabase = 'zadmin_dbvisa';
    $db = mysql_connect($dbHost, $dbUsername, $dbPassword) or die ("Unable to connect to Database Server.");
    mysql_select_db($dbDatabase, $db) or die ("Could not select database.");

    if ($comp == '1') {
        $tccomp = 'PANORAMA TOURS';
    } else if ($comp == '2') {
        $tccomp = 'TUR EZ';
    } else {
        $tccomp = 'PANORAMA WORLD';
    }
    $sql_check = mysql_query("select DepositNo,DepositCurr,DepositAmount from tour_msbooking 
                              where BookingStatus = 'DEPOSIT' 
                              AND DepositNo ='" . $depositno . "' 
                              AND TCCompany ='" . $tccomp . "' 
                              AND Status='ACTIVE'
                              AND DepositAmount > '10000'
                              AND DUMMY ='NO' ") or die(mysql_error());
    $isi = mysql_fetch_array($sql_check);
    if (mysql_num_rows($sql_check)) {
        echo "OK-$isi[DepositCurr]-$isi[DepositAmount]";
    } else {
        echo '<font color="red">Deposit No <STRONG>' . $depositno . '</STRONG> not found.</font>';
    }

}

?>