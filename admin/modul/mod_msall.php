<script language="JavaScript"  type="text/javascript">
	 
function delfile(ID, File)
{
if (confirm("Are you sure you want to delete '" + File + "'"))
{
 window.location.href = '?module=msall&act=deletemsall&id=' + ID;
 
} 
}
</script>
<?php 
switch($_GET[act]){
  // Tampil database
  default:
    $nama=$_GET['nama']; 
    echo "<h2>General Info</h2> ";
		  $oke=$_GET['oke'];
          $username=$_SESSION[namauser];  
          $sqluser=mysql_query("SELECT job_desc FROM tbl_msemployee WHERE employee_username='$username'");
          $hasiluser=mysql_fetch_object($sqluser);
          $jobdesc=$hasiluser->job_desc;
		  
			
			// Langkah 2
			
			 $group=mysql_query("SELECT * FROM infoprod                                  
								 WHERE infocountry = 'GENERAL'  
								 order BY infoupdate DESC ");    
			           echo"<p>
                       <table>
              		   <tr><th>no</th>   
    				  	  <th>File</th>
                          <th>Description</th>				  
    					  <th>Update</th>";
    					  if ($jobdesc == "1" OR $jobdesc == "3"){	
    					  echo"<th>Action</th>"; 
    					  } else {
    					  };
    				  $no=1;
    					while ($data=mysql_fetch_array($group)){
    					
    						$file= ereg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($data[infofile]) ) ) );
    						echo "<tr><td>$no</td>
    							   
    					   		 <td><a href=$data[infopath]$file target=_blank style=text-decoration:none >$data[infofile]</a></td>							 
    					   		 <td><center>$data[description]</td>
                                 <td>$data[infoupdate]</td>";
    							 if ($jobdesc == "1" OR $jobdesc == "3"){
    						echo"<td><center><a href=\"javascript:delfile('$data[infoid]','$data[infofile]')\">Delete</a>";
    								 }
    							else if($_SESSION[leveluser] == "user"){
    							}
    						echo"</td></tr>";
    					  $no++;
    					}
    					echo "</table>";     
            
    break;
	
	case "editmsall":
    $edit=mysql_query("SELECT * FROM infoprod WHERE infoid ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit);  
    echo "<h2>Edit Document File</h2>
          <form NAME='example' method=POST action='./aksi.php?module=msall&act=update'>
          <input type=hidden name=id value='$r2[infoid]'>
		  <input type=hidden name=modul value='msall'>		  
          <table>
  		  <tr><td colspan=2 bgcolor='#666666'><font color='#FFFFFF'><b>Document File</b></font></td></tr>		  
		  <tr><td>Product Desc</td><td> <input type=text name='infocode' value='$r2[infocode]' size=10></td></tr>
		  <tr><td>File</td><td> $r2[infofile]</td></tr>
		  <tr><td>Update</td><td> $r2[infoupdate]</td></tr>
		  <tr><td colspan=2><center><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
		  </table></form><br><br>";
     break;
	 
	 case "deletemsall":
    
    $edit1=mysql_query("SELECT * FROM infoprod WHERE infoid ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1);
	$file= ereg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r2[infofile]) ) ) );
    $path = $r2[infopath];
    $files = ("$path$file");
    unlink($files);
    $edit=mysql_query("DELETE FROM infoprod WHERE infoid = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msall'>"; 
    //header('location:media.php?module=msall');
	//$edit=mysql_query("SELECT * FROM infoprod WHERE infoid = '$_GET[id]'");  
    /*$r2=mysql_fetch_array($edit);  
    
	echo "<h2>Delete File, are you sure?</h2>
          <form NAME='example' method=POST action='./aksi.php?module=msjahe&act=delete'>
          <input type=hidden name=id value='$r2[infoid]'>
		  <input type=hidden name=info value='$r2[infopath]$file'>
		  <input type=hidden name=modul value='msall'>		  
          <table>
  		  <tr><td colspan=2><input type=submit value=Yes>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
		  </table></form><br><br>";*/
     break;
}
?>
