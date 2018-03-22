
<script type="text/javascript"> 
function validateFormOnSubmit(theForm) {
var reason = "";                            
  reason += validateEmpty(theForm.Divisi);
  reason += validateEmpty(theForm.TcName);
  reason += validateEmpty(theForm.PaxName);  
      
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);
    return false;
  }

  return true;
}
function generateexcel(tableid) {
    var table= document.getElementById(tableid);
    var html = table.outerHTML;
    window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
}
</script>
<?php 
switch($_GET[act]){
  // Tampil Visa
  default:
      	$VEmbassy=$_GET['Embassy'];
		$ValueEmbassy = explode(',', $VEmbassy);
		$Embassy = $ValueEmbassy[0];
		$GroupEmbassy = $ValueEmbassy[1];
		
		$hariini = date("Y-m-d ");
	  	$blnini = date("m");
    	$thnini = date("Y");
		$Nextthn = $thnini+1;
   		$mont=$_GET['bulan'];
    	$yer=$_GET['year'];
	 	if($mont==''){$mont=$blnini;}
    	if($yer==''){$yer=$thnini;}

      $tampil2=mssql_query("SELECT DivisiNO,Employee.DivisiID,Category,EmployeeName,LTMAuthority FROM [HRM].[dbo].[Employee]
                      inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                      WHERE EmployeeID = '$_SESSION[employee_code]'");
      $hasil2=mssql_fetch_array($tampil2);
      if($hasil2[LTMAuthority]=='PO BRANCH'){
          $filterpo="AND tour_msproduct.InputDivision = '$hasil2[DivisiID]'";
      }else{
          $filterpo='';
      }

    echo "<h2>Summary Visa Progress</h2>
          <form method='GET' action='media.php'>
                <input type=hidden name=module value='rptembassydoc'>
				Period of Departure :";
			echo "Month &nbsp:&nbsp<select name='bulan' >
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
              &nbsp &nbsp Year    :  <select name='year' >
			  		  <option value='$thnini'";if($yer=='$thnini'){echo"selected";}echo">$thnini</option>
                      <option value='$Nextthn'";if($yer=='$Nextthn'){echo"selected";}echo">$Nextthn</option>
					   </select> <br>
					       Embassy &nbsp &nbsp :
              <select name='Embassy'><option value=''>- Select Embassy -</option>"; 
		   	  
			  $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' AND Type='VISA' ORDER BY Country");
			  
            while($r=mysql_fetch_array($tampil)){
				if($Embassy==$r[CountryID]){
				  	echo "<option value='$r[CountryID],$r[CountryGroup]' selected >$r[Country]</option>";    
				  }else {
				  	echo "<option value='$r[CountryID],$r[CountryGroup]'>$r[Country]</option>";
				  }
				}
				echo"</select>
				<input type=submit name='rptembassydoc' value='Show'> 
          </form>";

     $IDEmbassy=$Embassy;

        $Product=mysql_query("SELECT * FROM `tour_msproduct` 
                              WHERE ( Embassy01='$IDEmbassy' or Embassy02='$IDEmbassy'
						      or Embassy03='$IDEmbassy' or Embassy04='$IDEmbassy' 
						      or Embassy05='$IDEmbassy') 
						      and visa <>'NO REQUIRED' 
						      and status<>'VOID' 
						      and DateTravelFrom>='$hariini'  
						      and month(DateTravelFrom)='$mont' 
						      and year(DateTravelFrom)='$yer' 
						      and (status='PUBLISH' or seatdeposit>0)
						      $filterpo
						      order by DateTravelFrom desc ");

		$JumProduct=mysql_num_rows($Product);
		$GrpEmbassy='';
		
		if($JumProduct>0){
			
			$QGrpEmbassy=mysql_query("SELECT * from tbl_msembassy where status='ACTIVE' and CountryGroup='$GroupEmbassy'");
			
			while($DGrpEmbassy=mysql_fetch_array($QGrpEmbassy)){			
					if($GrpEmbassy=='')
					{
						$GrpEmbassy="'".$DGrpEmbassy[CountryID]."'";
					}else
					{
						$GrpEmbassy=$GrpEmbassy.",'".$DGrpEmbassy[CountryID]."'";
					}
			}

		echo"<table><tr><th><center>No</th>
				<th><center>Group</th>
				<th><center>Seat</th>
				<th><center>Deposit</th>
				<th><center>Available</th>
				<th><center>Visa Done</th>
				<th><center>Visa On Process</th>
				<th><center>Waiting Fingerprint
							/Confirm Slot</th>
				<th><center>Pending Schedule</th>
				<th><center>No Copy passport</th>
				<th><center>Foreign/Holding Visa</th>
				<th><center>Rejected</th>
				<th><center>Total</th>
				</tr>";
		$No=1;		
		

		
		 while($DProduct=mysql_fetch_array($Product)){
			 
				$VisaDone=0;
				$VisaProcess =0;
				$VisaWait=0;
				$VisaPending=0;
				$VisaNoPassport=0;
				$VisaHolding=0;
				$VisaRejected=0;
				$Pax=0;
			 
			 
			 $QBooking=mysql_query("SELECT * FROM tour_msbookingdetail
			        inner join tour_msbooking on tour_msbooking.bookingid= tour_msbookingdetail.bookingid
			        WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and tour_msbookingdetail.IDTourCode='$DProduct[IDProduct]' and TCDivision <> 'LTM' AND TCDivision <> 'LTM-TEZ' and tour_msbookingdetail.status <>'CANCEL' ");
			 $JumBooking=mysql_num_rows($QBooking);
			 
			 if($JumBooking==0 or $JumBooking=='')
			 {
				$VisaDone=0;
				$VisaProcess =0;
				$VisaWait=0;
				$VisaPending=0;
				$VisaNoPassport=0;
				$VisaHolding=0;
				$VisaRejected=0;
				$Pax=0;
			 }
			 else
			 {
				 while($DBooking=mysql_fetch_array($QBooking))
				 {
					 if($DBooking[Gender]<>'INFANT')
						 {$Pax=$Pax+1;}
						 
					if( $DBooking[HoldingVisa]=='YES')
					{
						$VisaHolding=$VisaHolding+1;
					}
					else
					{				
					$QDocument=mysql_query("SELECT *  FROM `msvisa` WHERE ProdEmbassy in ($GrpEmbassy)  and IDBookingdetail='$DBooking[IDDetail]' and StatCancel<>1 ");
					 $DDocument=mysql_fetch_array($QDocument);
			 		 $JumDocument=mysql_num_rows($QDocument); 
					 if($JumDocument==0 or $JumDocument=='')
					 {
						$VisaNoPassport=$VisaNoPassport+1;
					 }
					 else
					 {
							 if($DDocument[ActIn]>=$hariini or $DDocument[ActIn]=='0000-00-00')
							 {
								 if($DDocument[ActIn]=='0000-00-00')
								 {
									$VisaPending=$VisaPending+1;
								 }
								 else
								 {
									 $VisaWait=$VisaWait+1;
								 }
							 }
							 else
							 {
								 
								 if($DDocument[StatCancel]=='REJECT')
								 {
									 $VisaRejected=$VisaRejected+1;
								 }
								 else
								 {
										 if($DDocument[ActOut]<=$hariini and $DDocument[ActOut]<>'0000-00-00')
										 {
												$VisaDone=$VisaDone+1;
										 }
										 else
										 {
												$VisaProcess =$VisaProcess+1;
										 }
								 }
							 }
					 }
					 
					}
				 }
				 
				
				 
			 }
			 
			 	 $Sisa=$DProduct[Seat]-$Pax;
				 $Total=$VisaDone+$VisaProcess+$VisaWait+$VisaPending+$VisaNoPassport+$VisaHolding+$VisaRejected;
		
			 echo"<tr>
			 	  <td><center>$No</td>
				  <td><center>$DProduct[TourCode]</td>
				  <td><center>$DProduct[Seat] </td>";
				  if($Pax>0){echo"<td><center><a href='?module=rptembassydoc&act=showdetail&id=$DProduct[IDProduct]&Embassy=$GroupEmbassy'>$Pax</a></td>";}
				  else{echo"<td><center>$Pax</td>";}
				  echo"<td><center>$Sisa</td>
				  <td><center>$VisaDone</td>
				  <td><center>$VisaProcess</td>
				  <td><center>$VisaWait</td>
				  <td><center>$VisaPending</td>
				  <td><center>$VisaNoPassport</td>
				  <td><center>$VisaHolding</td>
				  <td><center>$VisaRejected</td>
				  <td><center>$Total</td>
				  
				</tr>";

				$TotalSeat=$TotalSeat+$DProduct[Seat];
				$TotalPax=$TotalPax+$Pax;
				$TotalSisa=$TotalSisa+$Sisa;
				$TotalVisaDone=$TotalVisaDone+$VisaDone;
				$TotalVisaProcess=$TotalVisaProcess+$VisaProcess;
				$TotalVisaWait=$TotalVisaWait+$VisaWait;
				$TotalVisaPending=$TotalVisaPending+$VisaPending;
				$TotalVisaNoPassport=$TotalVisaNoPassport+$VisaNoPassport;
				$TotalVisaHolding=$TotalVisaHolding+$VisaHolding;
				$TotalVisaRejected=$TotalVisaRejected+$VisaRejected;
				$TotalAll=$TotalAll+$Total;
				
			 $No++;
		 }
		 
		 
		 echo"<tr><th colspan=2 ><center>Total</th>
				<th><center>$TotalSeat</th>
				<th><center>$TotalPax</th>
				<th><center>$TotalSisa</th>
				<th><center>$TotalVisaDone</th>
				<th><center>$TotalVisaProcess</th>
				<th><center>$TotalVisaWait</th>
				<th><center>$TotalVisaPending</th>
				<th><center>$TotalVisaNoPassport</th>
				<th><center>$TotalVisaHolding</th>
				<th><center>$TotalVisaRejected</th>
				<th><center>$TotalAll</th>
				</tr>";
		 
 		echo"</table>";
		}
		
  break;

/////////////////////////////////////////////////////////detail process document////////////////////////////////////////////////////////////////
  case "showdetail":
  		  $hariini = date("Y-m-d ");
		  $IDTourCode=$_GET[id];
		  $GroupEmbassy=$_GET[Embassy];
		  
		 $QProduct=mysql_query("SELECT * FROM `tour_msproduct` WHERE IDProduct='$IDTourCode'");
		$DProduct=mysql_fetch_array($QProduct);
		$tglberangkat=date("d-M-Y",strtotime($DProduct[DateTravelFrom]));
		echo"<b>Tour Code : $DProduct[TourCode]<br>
			Departure : $tglberangkat</b>";
		 
		 
		 $QGrpEmbassy=mysql_query("SELECT * from tbl_msembassy where status='ACTIVE' and CountryGroup='$GroupEmbassy'");
			
			while($DGrpEmbassy=mysql_fetch_array($QGrpEmbassy)){			
					if($GrpEmbassy=='')
					{
						$GrpEmbassy="'".$DGrpEmbassy[CountryID]."'";
					}else
					{
						$GrpEmbassy=$GrpEmbassy.",'".$DGrpEmbassy[CountryID]."'";
					}
			}
		 
		 
		 $QBooking=mysql_query("SELECT tour_msbookingdetail.bookingid as ID,TCName,TCDivision,PaxName,Title, PassportIssued,PassportNo,PassportValid,IDDetail  FROM tour_msbookingdetail inner join tour_msbooking on tour_msbooking.bookingid= tour_msbookingdetail.bookingid WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and tour_msbookingdetail.IDTourCode='$IDTourCode' and TCDivision <> 'LTM' AND TCDivision <> 'LTM-TEZ' and tour_msbookingdetail.status <>'CANCEL' ");
		 
		  echo"<table><tr><th rowspan=2;>no</th><th rowspan=2;>Booking ID</th><th rowspan=2;>tc name</th><th rowspan=2;>divisi</th><th rowspan=2;>Pax Name</th><th colspan=3;>Passport</th><th rowspan=2;>Status</th><th colspan=3;>Process</th></tr>
		  <tr><th>Issued Place</th><th>No</th><th>Valid</th><th>DO NO</th><th>In</th><th>Complete</th></tr>";
		  $No=1;
		  while($DBooking=mysql_fetch_array($QBooking))
				 {
					 
					 
					  if($DBooking[PassportValid]=='0000-00-00'){$ValidPassport='';}else{
					  $ValidPassport=date("d-M-Y",strtotime($DBooking[PassportValid]));}
					
					
				
					
					if( $DBooking[HoldingVisa]=='YES')
					{
						$Status ='HOLDING VISA';
					}
					else
					{				
					$QDocument=mysql_query("SELECT *  FROM `msvisa` WHERE ProdEmbassy in ($GrpEmbassy)  and IDBookingdetail='$DBooking[IDDetail]' and StatCancel<>1 ");
					 $DDocument=mysql_fetch_array($QDocument);
			 		 $JumDocument=mysql_num_rows($QDocument); 
					 if($JumDocument==0 or $JumDocument=='')
					 {
						$Status ='NO COPY PASSPORT';
					 }
					 else
					 {
							 if($DDocument[ActIn]>$hariini)
							 {
								 $Status ='WAITING FINGERPRINT';
							 }
							 else if($DDocument[ActIn]==0000-00-00)
						     {
									$Status ='PENDING';
							 }
							 else if($DDocument[StatCancel]=='REJECT')
							 {
									  $Status ='REJECTED';
							 }
							 else if($DDocument[ActIn]<=$hariini)
								 {
										 if($DDocument[ActOut]<=$hariini and $DDocument[ActOut]<>0000-00-00)
										 {
												$Status ='DONE';
										 }
										 else
										 {
												$Status ='PROCESS';
										 }
								 }
							 
					 }
					 
					}
		 
					
					if($DDocument[ActIn]=='0000-00-00' or $DDocument[ActIn]=='' ){$TglIn='';}else{$TglIn=date("d-M-Y",strtotime($DDocument[ActIn]));}
					if($DDocument[ActOut]=='0000-00-00' or $DDocument[ActOut]==''){$TglOut='';}else{$TglOut=date("d-M-Y",strtotime($DDocument[ActOut]));}
					
					
					echo"<tr>
						<td>$No</td>
						<td>$DBooking[ID]</td>
						<td>$DBooking[TCName]</td>
						<td>$DBooking[TCDivision]</td>
						<td>$DBooking[Title]  $DBooking[PaxName]</td>
						<td>$DBooking[PassportIssued]</td>
						<td>$DBooking[PassportNo]</td>
						<td>$ValidPassport</td>
						<td>$Status</td>
						<td>$DDocument[DONo]</td>
						<td>$TglIn</td>
						<td>$TglOut</td>
						
						</tr>";
						
						$No++;
					 
					 
					 
				 }
				 
		
		echo"</table>";		 
		
		 
		 
		
		echo"<center><input type=button value=Close onclick=self.history.back()><br><br>";    
  break;
                
}
?>
