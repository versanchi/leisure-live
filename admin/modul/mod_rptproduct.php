<?php 
switch($_GET[act]){
  // Tampil Office
  default:
  	$CompanyID=$_SESSION['company_id'];
    $blnini = date("m");
    $thnini = date("Y");
    $mont=$_GET['bulan'];
    $yer=$_GET['year'];
	$Dest=$_GET['Destination'];
	$Comp=$_GET['Comp'];
    if($mont==''){$mont=$blnini;}
    if($yer==''){$yer=$thnini;} 
    if($Dest==''){$Dest='ALL';}
       echo "<h2>Report Destination - By Product</h2>
          <form method='GET' action='expproduct.php?' target='_blank'>
		  <input type=hidden name=module value='rptproduct'>
		  <input type=text name='Comp' value='$CompanyID' style='display:none;'>
               Period&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Month <select name='bulan' >
                      <option value='01'";if($mont=='01'){echo"selected";}echo">JAN</option>
                      <option value='02'";if($mont=='02'){echo"selected";}echo">FEB</option>
					  <option value='03'";if($mont=='03'){echo"selected";}echo">MAR</option>
					  <option value='04'";if($mont=='04'){echo"selected";}echo">APR</option>
                      <option value='05'";if($mont=='05'){echo"selected";}echo">MAY</option>
					  <option value='06'";if($mont=='06'){echo"selected";}echo">JUN</option>
					  <option value='07'";if($mont=='07'){echo"selected";}echo">JUL</option>
                      <option value='08'";if($mont=='08'){echo"selected";}echo">AUG</option>
					  <option value='09'";if($mont=='09'){echo"selected";}echo">SEP</option>
					  <option value='10'";if($mont=='10'){echo"selected";}echo">OCT</option>
                      <option value='11'";if($mont=='11'){echo"selected";}echo">NOV</option>
					  <option value='12'";if($mont=='12'){echo"selected";}echo">DEC</option>
                      </select>
              Year <select name='year' ><option value='0' >- Select Year -</option>";
            $tampil=mysql_query("SELECT Year FROM tour_msproduct where year <>'' group BY Year asc");
            while($s=mysql_fetch_array($tampil)){  // <input type='button' value='Cek Seat' onclick=ceking() >
               if($yer==$s[Year]){
                    echo "<option value='$s[Year]' selected>$s[Year]</option>";     
                }else { 
                echo "<option value='$s[Year]' >$s[Year]</option>";
                } 
            }
    echo "</select>";
	echo "<br>Product Type :<select name='GroupType' id='GroupType'>";  
           
			$tampilGtype=mysql_query("SELECT * FROM tour_msgroup order by GroupName ASC"); 
							  echo "<option value='ALL'>ALL</option>";  
            while($sGtype=mysql_fetch_array($tampilGtype)){
				if ($Gtype==$sGtype[GroupName]){
                        echo "<option value='$sGtype[GroupName]' selected>$sGtype[GroupName]</option>";
						}
				else {
						echo "<option value='$sGtype[GroupName]'>$sGtype[GroupName]</option>";}
				
            }
    echo "</select>";
	 echo "<br>Destination&nbsp;&nbsp;&nbsp;&nbsp;:<select name='Destination' id='Destination'>";  
           
			$tampilDest=mysql_query("SELECT distinct Destination FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa"); 
			
			echo "<option value='ALL'>ALL</option>";  
            
			while($sDest=mysql_fetch_array($tampilDest)){
				if ($Dest==$sDest[Destination]){
                        echo "<option value='$sDest[Destination]' selected>$sDest[Destination]</option>";
						}
				else {
						echo "<option value='$sDest[Destination]'>$sDest[Destination]</option>";}
				
            }
    echo "</select>
              <input type=submit name='namelist' value='view'> 
          </form>";

     break;   
	 
	        
}
?>
