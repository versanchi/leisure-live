<?
	  $connection = mysql_connect('localhost', 'root', '') or die("please contact ferry_budiono@panorama-tours.com!");
mysql_select_db("dbvisa", $connection);
		if(isset($_POST['queryString1'])) {
			$queryString = $_POST['queryString1'];	
            $Region = $_POST['queryString'];	
			if(strlen($queryString) >0) {
				$query = "SELECT Country FROM cim_mscountry WHERE Country LIKE '$queryString%' AND Region = '$Region'  group by Country ";
				$result = mysql_query($query) or die("There is an error in database");
					while($row = mysql_fetch_array($result)){                          
					echo '<li onClick="fill1(\''.$row['Country'].'\');">'.$row['Country'].'</li>';               
      }
	  }
	  }
?>
