<?
	  $connection = mysql_connect('localhost', 'root', '') or die("please contact ferry_budiono@panorama-tours.com!");
mysql_select_db("dbvisa", $connection);
		if(isset($_POST['queryString'])) {
			$queryString = $_POST['queryString'];		
			if(strlen($queryString) >0) {
				$query = "SELECT Region FROM cim_mscountry WHERE Region LIKE '$queryString%' group by Region ";
				$result = mysql_query($query) or die("There is an error in database");
					while($row = mysql_fetch_array($result)){                          
					echo '<li onClick="fill(\''.$row['Region'].'\');">'.$row['Region'].'</li>';               
      }
	  }
	  }
?>
