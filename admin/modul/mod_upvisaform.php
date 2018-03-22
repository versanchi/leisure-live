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

$dir = "./upload/visa/"; //Change this to the correct dir  RELATIVE TO WHERE THIS SCRIPT IS, or /full/path/

//MIME types to allow, Gif, jpeg, zip ::Edit this to your liking 
$types = array("application/pdf"); 
//$types = array("application/pdf","image/png","image/x-png","audio/wav","image/gif","image/jpeg","image/pjpeg","application/x-zip-compressed"); 


//Check to determine if the submit button has been pressed 
if(isset($_POST['submit'])){ 

	//Shorten Variables 
	$tmp_name = $_FILES['upload']['tmp_name']; 
	$new_name = $_FILES['upload']['name']; 
	$path = "visa";
	$fullpath = "./upload/visa/";
	$fullpath = str_replace("..", "", str_replace("\.", "", str_replace("//", "/", $fullpath)));
    $clean_name = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name) ) ) );
// lets see if we are uploading a file or doing a dir listing
	if(isset($_POST['Dir'])){
		echo "Directory listing for $fullpath\n";
		scandir("$fullpath");
		}else{

        $username=$_SESSION[employee_code];
        $sqluser=mysql_query("SELECT employee_name, employee_code, office_code, office_group FROM tbl_msemployee
                        left join tbl_msoffice on tbl_msoffice.office_id = tbl_msemployee.office_id
                        WHERE employee_code='$username'");
        $tampiluser=mysql_fetch_array($sqluser);
        $EmpName="$tampiluser[employee_name] ($tampiluser[employee_code])";
		//Check MIME Type 
		//if ((in_array($_FILES['upload']['type'], $types)) and (!file_exists($fullpath.$clean_name))){ 
           if ((!file_exists($fullpath.$clean_name))){
			// create a sub-directory if required
			if (!is_dir($fullpath)){
				mkdir("$fullpath", 0755);
			}
			//Move file from tmp dir to new location 
			move_uploaded_file($tmp_name,$fullpath . $clean_name);

            $desc = strtoupper($_POST['desc']);
			$date = date("Y-m-d G:i:s", time());
			$name =  $_FILES['upload']['name']; 	
			$emb = $_POST['Embassy'];
            $Description="Upload Form Visa ID: $emb";

//			for($i=0;$i<sizeof($_POST['list_prod']);$i++)
//			{
//			$test=($_POST['list_prod'][$i]);
			
			//$sql = "insert into tbl_name values ($_POST["test"][$i])"; }
			//sql = "INSERT INTO table_name VALUES ('" . join(",",$_POST["test"]) . "')";
			mysql_query("INSERT INTO tour_upload (FileCategory,FileName,FileDesc,FileAttach,FileCountry,UploadUser,UploadDate)
						VALUES ('VISA','$name','$desc',
								'$fullpath','$emb',
								'$EmpName','$date')");
			
			 
			 //}
               mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('$EmpName',
                                   '$Description',
                                   '$date')");
				
			  
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

<p><form name="myForm" action="<?php  echo './media.php?module=upvisaform'; ?>" method="POST" enctype="multipart/form-data" >

<fieldset>
<legend><font size=3 color=red >Upload Manual Visa Form</font></legend>
<p>Embassy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp : <?php  echo "<select name='Embassy' required>
            <option value='' selected>- Select Embassy -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' AND Type='VISA' ORDER BY Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[CountryID]'>$r[Country]</option>";
            }
    echo "</select>";?>
<br><p> File Name &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <input type="text" name="desc" size="40" required>
<br><p> File to upload &nbsp&nbsp: <input type="file" name="upload" required> <br />
<p><input type="submit" name="submit" value="Upload" onclick="seeList(form)" /> 
</fieldset> 
</form>
</body>
</html>
