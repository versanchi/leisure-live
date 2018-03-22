<script language="JavaScript"  type="text/javascript">
	 
function delfile(ID, File)
{
if (confirm("Are you sure you want to delete '" + File + "'"))
{
 window.location.href = '?module=msdoc&act=deletemsdoc&id=' + ID;
 
} 
}
</script>
<?php 
switch($_GET[act]){
  // Tampil database
  default:
    $nama=$_GET['nama']; 
    echo "<h2>Product Info</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='msdoc'>
			  <select name='nama'>
            <option value='0' selected>- Select Embassy -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_mscountry                               
                group by Country");
            while($r=mysql_fetch_array($tampil)){
                if($nama==$r[Country]){
                     echo "<option value='$r[Country]' selected>$r[Country]</option>";
                } else {
                    echo "<option value='$r[Country]'>$r[Country]</option>"; 
                }
               
            }
    echo "</select>	
			  <input type=submit name=oke value=Search>
		  </form>";
		  $oke=$_GET['oke'];
          $username=$_SESSION[namauser];  
          $sqluser=mysql_query("SELECT job_desc FROM tbl_msemployee WHERE employee_username='$username'");
          $hasiluser=mysql_fetch_object($sqluser);
          $jobdesc=$hasiluser->job_desc;
		  
			
			// Langkah 2
			
			 $group=mysql_query("SELECT * FROM infoprod
								 LEFT JOIN product ON infoprod.infocat = product.prodid
								 WHERE infocountry = '$nama'  
								 GROUP BY infocat ASC ");
			     $jumgroup=mysql_num_rows($group);
                 $group1=mysql_query("SELECT * FROM infoprod
								 LEFT JOIN product ON infoprod.infocat = product.prodid
								 WHERE infocountry = '$nama'    
								 order BY infocat ASC");
			     $jumgroup1=mysql_num_rows($group1);
                if ($jumgroup > 0) {
                    while ($isi=mysql_fetch_array($group)){
                    	
                    $tampil=mysql_query("SELECT * FROM infoprod
        								 LEFT JOIN product ON infoprod.infocat = product.prodid
        								 WHERE infocat = '$isi[infocat]' 
        								 and infocountry = '$isi[infocountry]'   
                                         ORDER BY infoupdate ASC");
        			$jumlah=mysql_num_rows($tampil);
                    if ($jumlah > 0) {
			           echo"<p>$isi[prodname]
                       <table>
              		   <tr><th>no</th>
    					  <th>Embassy</th>       
    				  	  <th>File</th>				  
    					  <th>Update</th>";
    					  if ($jobdesc == "1" OR $jobdesc == "3"){	
    					  echo"<th>Action</th>"; 
    					  } else {
    					  };
    				  $no=1;
    					while ($data=mysql_fetch_array($tampil)){
    					
    						$file= ereg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($data[infofile]) ) ) );
    						echo "<tr><td>$no</td>
    							 <td><center>$data[infocountry]</td>  
    					   		 <td><a href=$data[infopath]$file target=_blank style=text-decoration:none >$data[infofile]</a></td>							 
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
					} 
                    }
                }
             $coba=mysql_query("SELECT * FROM tbl_address 
                                left join tbl_mscountry on tbl_mscountry.CountryID = tbl_address.AddressCountry
                                where tbl_mscountry.Country ='$nama' order by tbl_address.AddressID ASC");  
            $jumadd=mysql_num_rows($coba);
            if ($jumadd > 0) {
            echo"  
            ADDRESS
            <table>   
           <tr><th>City</th><th>Address</th><th>Phone</th><th>Office Hour</th></tr>";
            while($tes=mysql_fetch_array($coba)){   
    echo"<tr>                                                                    
          <td>$tes[AddressCity]</td>
          <td>$tes[Address]</td>
          <td>$tes[AddressPhone]</td>
          <td>$tes[AddressOffHour]</td></tr>";}echo"
          </table>";}
          
          $jajal=mysql_query("SELECT * FROM tbl_holiday 
                                left join tbl_mscountry on tbl_mscountry.CountryID = tbl_holiday.HolidayCountry
                                where tbl_mscountry.Country ='$nama' order by tbl_holiday.HolidayDate ASC");  
            $jumhol=mysql_num_rows($jajal);
            if ($jumhol > 0) {
            echo"  
            PUBLIC HOLIDAY
            <table>   
           <tr><th>date</th><th>description</th></tr>";
            while($testing=mysql_fetch_array($jajal)){   
    echo"<tr>                                                                    
          <td>$testing[HolidayDate]</td>
          <td>$testing[HolidayDesc]</td></tr>";}echo"
          </table>";}
    break;
	
	case "editmsdoc":
    $edit=mysql_query("SELECT * FROM infoprod WHERE infoid ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit);  
    echo "<h2>Edit Document File</h2>
          <form NAME='example' method=POST action='./aksi.php?module=msdoc&act=update'>
          <input type=hidden name=id value='$r2[infoid]'>
		  <input type=hidden name=modul value='msdoc'>		  
          <table>
  		  <tr><td colspan=2 bgcolor='#666666'><font color='#FFFFFF'><b>Document File</b></font></td></tr>		  
		  <tr><td>Product Desc</td><td> <input type=text name='infocode' value='$r2[infocode]' size=10></td></tr>
		  <tr><td>File</td><td> $r2[infofile]</td></tr>
		  <tr><td>Update</td><td> $r2[infoupdate]</td></tr>
		  <tr><td colspan=2><center><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
		  </table></form><br><br>";
     break;
	 
	 case "deletemsdoc":
    
    $edit1=mysql_query("SELECT * FROM infoprod WHERE infoid ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1);
	$file= ereg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r2[infofile]) ) ) );
    $path = $r2[infopath];
    $files = ("$path$file");
    unlink($files);
    $edit=mysql_query("DELETE FROM infoprod WHERE infoid = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msdoc'>"; 
    //header('location:media.php?module=msdoc');
	//$edit=mysql_query("SELECT * FROM infoprod WHERE infoid = '$_GET[id]'");  
    /*$r2=mysql_fetch_array($edit);  
    
	echo "<h2>Delete File, are you sure?</h2>
          <form NAME='example' method=POST action='./aksi.php?module=msjahe&act=delete'>
          <input type=hidden name=id value='$r2[infoid]'>
		  <input type=hidden name=info value='$r2[infopath]$file'>
		  <input type=hidden name=modul value='msdoc'>		  
          <table>
  		  <tr><td colspan=2><input type=submit value=Yes>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
		  </table></form><br><br>";*/
     break;
}
?>
