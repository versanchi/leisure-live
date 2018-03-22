<?
	  $connection = mysql_connect('localhost', 'root', '') or die("please contact ferry_budiono@panorama-tours.com!");
mysql_select_db("dbvisa", $connection);
		if(isset($_POST['queryString'])) {
			$queryString = $_POST['queryString'];
			if(strlen($queryString) >0) {
				$query = "SELECT Description FROM tour_msdesc WHERE Description LIKE '$queryString%' order by Description ASC ";
				$result = mysql_query($query) or die("There is an error in database");
					while($row = mysql_fetch_array($result)){                          
					echo '<li onClick="fill(\''.$row['Description'].'\');">'.$row['Description'].'</li>';               
      }
	  }
	  }
?>
