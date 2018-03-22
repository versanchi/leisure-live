<?php 
// This is a sample code in case you wish to check the username from a mysql db table
//include "./mod/koneksi.php";   
if(isSet($_POST['air']))
{
$air = $_POST['air']; 

if($air<>'')
{
echo $depositno;
}
else
{
echo 'OK';
}

}

?>