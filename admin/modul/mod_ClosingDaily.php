<script type="text/javascript"> 
function generateexcel(tableid) {
  var table= document.getElementById(tableid);
  var html = table.outerHTML;   
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));    
}  
</script>
<?php 
switch($_GET[act]){
  // Tampil Office
   default:
    $blnini = date("m");
    $thnini = date("Y");
    $mont=$_GET['bulan'];
    $yer=$_GET['year'];
	$Div=$_GET['BOSO'];
	$Gtype=$_GET['GroupType'];
    $grup=$_GET['grup']; 
    /*if($mont==''){$mont=$blnini;}
    if($yer==''){$yer=$thnini;}*/
	if($mont==''){$mont='01';}
    if($yer==''){$yer='2014';}
    if($Div==''){$Div='ALL';}
	if($Gtype==''){$Gtype='ALL';}
   echo "<h2>Report by Division</h2>
          <form method='get' action='media.php?'><input type=hidden name=module value='tester'>        
               Period  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Month &nbsp: <select name='bulan' >
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
                Year : <select name='year' ><option value='0' >- Select -</option>";
            $tampil=mysql_query("SELECT Year FROM tour_msproduct where year <>'' group BY Year asc");
            while($s=mysql_fetch_array($tampil)){  // <input type='button' value='Cek Seat' onclick=ceking() >
               if($yer==$s[Year]){
                    echo "<option value='$s[Year]' selected>$s[Year]</option>";     
                }else { 
                echo "<option value='$s[Year]' >$s[Year]</option>";
                } 
            }
    echo "</select>
              <input type=submit name='submit' size='20'value='View'>
          </form>";
          $oke=$_GET['oke'];
		 
		if($mont=='01'){$montText='JAN';}
         elseif($mont=='02'){$montText='FEB';}
		 elseif($mont=='03'){$montText='MAR';}
		 elseif($mont=='04'){$montText='APR';}
		 elseif($mont=='05'){$montText='MAY';}
		 elseif($mont=='06'){$montText='JUN';}
		 elseif($mont=='07'){$montText='JUL';}
		 elseif($mont=='08'){$montText='AUG';}
		 elseif($mont=='09'){$montText='SEP';}
		 elseif($mont=='10'){$montText='OCT';}
		 elseif($mont=='11'){$montText='NOV';}
 		 elseif($mont=='12'){$montText='DES';}
		
		$tglawal=$yer.'-'.$mont.'-01';
		$tglakhir='2015-06-01';
		$Start=date("Y-m-d",strtotime($tglawal));
		$End=date("Y-m-d",strtotime($tglakhir));
		$tanggal=$Start;
		
		
		echo"<table><tr>
		<td>Date</td>
		<td>Department</td>
		<td>BookingAwal</td>
		<td>AddBooking</td>
		<td>Cancel</td>
		<td>Total</td></tr>";
		
		/*$Awal=mysql_query("select * from tour_RptClosingDay where  year(Bookingdate)=year($tanggal) order by date desc, limit 1");
		$JAwal=mysql_num_rows($Awal);
		$DAwal=mysql_fetch_array($Awal);
		if($JAwal==0){$Bookingawal=0;}else{$Bookingawal=$DAwal[TotalBooking];}*/
		$Bookingawal=0;
		$QDepartment=mysql_query("select distinct Department from tour_msproduct where status<>'VOID'");

		while ($DDepartment=mysql_fetch_array($QDepartment))
		{
		$Department=$DDepartment[Department];
		
		while (strtotime($tanggal) < strtotime($tglakhir)) {
			
				$bln=date("m",strtotime($tanggal));
				$tgl=date("d",strtotime($tanggal));
		
				
				//$TotalBooking=$Bookingawal+$AddBooking+$CancelBooking;	
				$Booking=mysql_query("select sum(AdultPax+ChildPax+InfantPax) as Booking from tour_msbooking where  Bookingdate='$tanggal' and IDTourcode in (select IDProduct from tour_msproduct where Department='LEISURE') ");
				$DBooking=mysql_fetch_array($Booking);

				
				$LBooking=mysql_query("select sum(AdultPax+ChildPax+InfantPax) as Booking from tour_msbooking where  Bookingdate<='$tanggal' and year(Bookingdate)=year('$tanggal') and Status<> 'VOID'  and IDTourcode in (select IDProduct from tour_msproduct where Department='LEISURE')");
				$DLBooking=mysql_fetch_array($LBooking);
				
				if($bln==1 && $tgl==1){$Bookingawal=0;}
				if($DBooking[Booking]==null){$AddBooking=0;}else{$AddBooking=$DBooking[Booking];}
				if($DLBooking[Booking]==null){$TotalBooking=0;}else{$TotalBooking=$DLBooking[Booking];}
				
				$CancelBooking=($Bookingawal+$AddBooking)-$TotalBooking;
			
				
				
		echo"<tr>
			<td>$tanggal</td>
			<td>$Department</td>
			<td>$Bookingawal</td>
			<td>$AddBooking</td>
			<td>$CancelBooking</td>
			<td>$TotalBooking</td>
		</tr>";
		
		$tanggal = date("Y-m-d", strtotime($tanggal . " +1 day"));
		$Bookingawal=$TotalBooking;
		}
		
		
		$tglawal=$yer.'-'.$mont.'-01';
		$Start=date("Y-m-d",strtotime($tglawal));
		$End=date("Y-m-d",strtotime($tglakhir));
		$tanggal=$Start;
		
		}
		echo"</table>";
	
		
         echo" <center><input type=button value=Close onclick=self.history.back()><br><br>"; 
     break;    
}
?>
