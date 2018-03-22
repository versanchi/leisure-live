<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<style type="text/css">
body{
	background-repeat:no-repeat;
	font-family: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif;
	height:100%;
	background-color: #FFF;
	margin:0px;
	padding:0px;
}
select{
	width:150px;
}
</style>

<title></title>
</head>
<body>

<?php  

//$pw = 'upload';

$dir = "./upload/"; //Change this to the correct dir  RELATIVE TO WHERE THIS SCRIPT IS, or /full/path/

//MIME types to allow, Gif, jpeg, zip ::Edit this to your liking 
$types = array("application/pdf"); 
//$types = array("application/pdf","image/png","image/x-png","audio/wav","image/gif","image/jpeg","image/pjpeg","application/x-zip-compressed"); 
// Nothing to edit below here.

//Function to do a directory listing
/*function scandir($dirstr) {
	echo "<pre>\n";
	passthru("ls -l -F $dirstr 2>&1 ");
	echo "</pre>\n";
}*/

//Check to determine if the submit button has been pressed 
if(isset($_POST['submit'])){ 

	//Shorten Variables 
	$tmp_name = $_FILES['upload']['tmp_name']; 
	$new_name = $_FILES['upload']['name']; 
	$path = "Doc";
	$fullpath = "./upload/";
	$fullpath = str_replace("..", "", str_replace("\.", "", str_replace("//", "/", $fullpath)));
	$clean_name = ereg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name) ) ) );

// lets see if we are uploading a file or doing a dir listing
	if(isset($_POST['Dir'])){
		echo "Directory listing for $fullpath\n";
		scandir("$fullpath");
		}else{


		//Check MIME Type 
		//if ((in_array($_FILES['upload']['type'], $types)) and (!file_exists($fullpath.$clean_name))){ 
           if ((!file_exists($fullpath.$clean_name))){
			// create a sub-directory if required
			if (!is_dir($fullpath)){
				mkdir("$fullpath", 0755);
			}
			//Move file from tmp dir to new location 
			move_uploaded_file($tmp_name,$fullpath . $clean_name); 
 
			$pid =	$_POST['doc'];
			$date = date("Y-m-d G:i:s", time());
			$name =  $_FILES['upload']['name']; 	
			$emb = $_POST['Embassy'];
			
//			for($i=0;$i<sizeof($_POST['list_prod']);$i++)
//			{
//			$test=($_POST['list_prod'][$i]);
			
			//$sql = "insert into tbl_name values ($_POST["test"][$i])"; }
			//sql = "INSERT INTO table_name VALUES ('" . join(",",$_POST["test"]) . "')";
			mysql_query("INSERT INTO infoprod (infofile,infopath,infoupdate,infocat,infocountry) 
						VALUES ('$name',
								'$fullpath',
								'$date','$pid','$emb')");
			
			 
			 //}
				/*  mysql_query ("INSERT INTO infoprod (infoprod,
								  infocountry,infofile,infopath,infoupdate) 
			   			VALUES ('$pid',
								'$pcountry',
								'$name',
								'$fullpath',
								'$date')"); */
				
			  
			echo "<font size ='2' color=red>$clean_name of {$_FILES['upload']['size']} bytes was uploaded sucessfully </font>";
/*echo "<font size ='2' color=red>$clean_name of {$_FILES['upload']['size']} bytes was uploaded sucessfully to $fullpath</font>";*/
		}else{ 
          
			//Print Error Message 
			echo "<small>File <strong><em> {$_FILES['upload']['name']} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />"; 
			//Debug 
			/*$name =  $_FILES['upload']['name']; 
			$type =    $_FILES['upload']['type']; 
			$size =    $_FILES['upload']['size']; 
			$tmp =     $_FILES['upload']['name']; 
			
			echo "Name: $name<br />Type: $type<br />Size: $size<br />Tmp: $tmp "; */

		} 
      
	} 
} else { 
	
	echo 'Ready to upload your file'; 
} ?> 
          
<p><form name="myForm" action="<?php  echo './media.php?module=msuploaddoc'; ?>" method="POST" enctype="multipart/form-data" > 
      
<fieldset> 
<legend><font size=3 color=red  >Upload Product Files</font></legend>   
<p>Embassy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp : <?php  echo "<select name='Embassy'>
            <option value='0' selected>- Select Embassy -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_mscountry                               
                group by Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[Country]'>$r[Country]</option>";
            }
    echo "</select>";?>
<p>Product Detail &nbsp: <?php  echo "<select name='doc'>
            <option value= ''>- Select Detail -</option>";
            $tampil=mysql_query("SELECT * FROM product  ORDER BY prodname ASC");
            while($r=mysql_fetch_array($tampil)){
              echo"<option value='$r[prodid]'>$r[prodname]</option></p>";
            }
	echo "</select>";
?>

<br><p> File to upload &nbsp&nbsp: <input type="file" name="upload" /> <br />
<p><input type="submit" name="submit" value="Upload" onclick="seeList(form)" /> 
</fieldset> 
</form>
</body>
</html>
