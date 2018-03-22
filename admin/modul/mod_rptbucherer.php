<script type="text/javascript"> 
function generateexcel(tableid) {
  var table= document.getElementById(tableid);
  var html = table.outerHTML;   
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));    
}
function printData(tableid) {
    var divToPrint=document.getElementById(tableid);
    newWin= window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.print();
    newWin.close();
}
</script>
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

</script>

<?php 
include "../config/koneksi.php";
include "../config/koneksimaster.php";
include "../config/fungsi_an.php";

switch($_GET[act]){
  // Tampil Search Tour code
  default:
      $nama=$_GET['nama'];
      $file=$_GET['file'];
      $hariini = date("Y-m-d ");
	  $username=$_SESSION['employee_code'];
      $sqluser=mssql_query("SELECT EmployeeID,DivisiNO,Employee.DivisiID,Category,EmployeeName,CompanyGroup,LTMAuthority FROM [HRM].[dbo].[Employee]
                      inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                      WHERE EmployeeID = '$username'");
      $hasil2=mssql_fetch_array($sqluser);
            if($file=='namelist'){$subj='NAME LIST';}
            else if($file=='itin'){$subj='ITINERARY';}
            else {$subj='';}
      if($hasil2[LTMAuthority]=='PO BRANCH'){
          $filterpo="AND tour_msproduct.InputDivision = '$hasil2[DivisiID]'";
      }else{
          $filterpo='';
      }
    echo "<h2>$subj</h2>
          <form method=get action='media.php?'>
              Tour Code 
              <select name='nama'><option value=''>- Select TourCode -</option>"; 
              $option = mysql_query("SELECT tour_msproduct.IDProduct,tour_msproduct.TourCode FROM tour_msbooking 
                                    left join tour_msproduct on tour_msproduct.TourCode = tour_msbooking.TourCode
                                    WHERE tour_msproduct.DateTravelTo >= '$hariini'
                                    AND tour_msproduct.Year = tour_msbooking.Year 
                                    AND tour_msbooking.TourCode <> '' AND tour_msproduct.Status <> 'VOID' 
                                    AND tour_msproduct.Status = 'PUBLISH' AND tour_msbooking.Status = 'ACTIVE' 
                                    and DUMMY = 'NO' 
                                    $filterpo
                                    GROUP BY tour_msbooking.TourCode ASC");
									
              while($s=mysql_fetch_array($option)){
				  if ($s['IDProduct']==$nama){
					echo "<option value='$s[IDProduct]' selected >$s[TourCode]</option>";  
				  }else {
				  echo "<option value='$s[IDProduct]'>$s[TourCode]</option>";
				  }
                   
              }
    echo "</select> <input type=hidden name=module value='rptbucherer'>
     <select name='file'><option value='namelist'";if($file=='namelist'){echo"selected";}echo">Name List</option>
                         <option value='itin'";if($file=='itin'){echo"selected";}echo">Itinerary</option></select>
              <input type=submit name=oke value=Show>
          </form>";
		   $oke=$_GET['oke'];
		$IDProduct=$nama;    
		if($IDProduct<>''){
         if($file=='namelist'){
         $ambil=mysql_query("SELECT tour_msproduct.IDProduct,tour_msproduct.TourCode,tour_msproduct.Year,TCDivision,tour_msbooking.BookingID,
                    tour_msproductcode.Productcode,tour_msproduct.DateTravelFrom,tour_msproduct.TourLeaderInc,tour_msproduct.TourLeader,
                    tour_msproduct.Flight,tour_msproduct.StatusProduct,tour_msproduct.GroupType FROM tour_msproduct
                    left join tour_msbooking on tour_msbooking.IDTourcode = tour_msproduct.IDProduct 
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode     
                    WHERE tour_msproduct.IDProduct ='$IDProduct'");
         $isi=mysql_fetch_array($ambil);
		 
		 // ini urutannya name list harus sesuai nomor kamar karena ada sharing sales yang bikin kacau nomor kamar
         $edit=mysql_query("SELECT tour_msbookingdetail.*,tour_msbooking.TBFNo,CONVERT(RoomNo, UNSIGNED INTEGER) as urut FROM tour_msbookingdetail left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                    AND tour_msbooking.Status = 'ACTIVE' 
                    AND tour_msbookingdetail.Status <> 'CANCEL'
                    order by urut,tour_msbooking.BookingID ASC,IDDetail ASC");

         $jumlah=mysql_num_rows($edit);
            $rum=mysql_query("SELECT sum(AdultPax)as jumlaadult,sum(ChildPax)as jumlachild,sum(InfantPax)as jumlainf FROM tour_msbooking   
                                WHERE IDTourcode = '$isi[IDProduct]'
                                And Status = 'ACTIVE'
                                And BookingStatus = 'DEPOSIT'  
                                group by TourCode ASC");        
         $room=mysql_fetch_array($rum);
         $jumteel=mysql_query("SELECT * FROM tour_msproducttl   
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL' 
                                order by IDPTL ASC");        
         $banyakteel=mysql_num_rows($jumteel);
          if($isi[TourLeaderInc]=='YES'){$tl=$banyakteel;}else{$tl=0;}
         $seluruh=$room[jumlaadult]+$room[jumlachild]+$room[jumlainf];// + $tl;
         
            echo "<table STYLE='border: 0px solid #000000' id='namelistBucherer'>	
						<tr><td style='border: 0px solid #000000;' colspan='6'><font size=4><u><b>CLIENT LIST</b></u></font></td></tr>
						<tr><td style='border: 0px solid #000000; text-align:center' colspan='6'><img src='images/pano.jpg' height='50px'></td></tr>
						<tr><td style='border: 0px solid #000000;' colspan='12'><font size=3><b>TOUR CODE : $isi[Productcode] - $isi[TourCode]</b></font></td></tr>
						<tr><td style='border: 0px solid #000000;' colspan='6';><font size=1><b>TOTAL PAX :  $seluruh + $tl TL </b></font></td></tr>
						<tr><td style='border: 0px solid #000000;' colspan='6';>Tour Leader : ";
                   //if($isi[TourLeaderInc]=='YES') {
                       $cariteel = mysql_query("SELECT * FROM tour_msproducttl
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL' 
                                order by IDPTL ASC");
                       $hasilteel = mysql_num_rows($cariteel);
                       if ($hasilteel > 0) {

                           while ($Namatl = mysql_fetch_array($cariteel)) {
                               $QCariNamaTL = mssql_query("SELECT * FROM Employee
                                    where EmployeeID = '$Namatl[EmployeeID]'
                                    order by EmployeeName ASC");
                               $DCariNamaTL = mssql_fetch_array($QCariNamaTL);

                               if ($TLName == '') {
                                   $TLName = "$DCariNamaTL[NameAsPassport] - $DCariNamaTL[Mobile]";
                               } else {
                                   $TLName = $TLName . ' , ' . $DCariNamaTL[NameAsPassport].' - '.$DCariNamaTL[Mobile];
                               }
                           }
                           echo " $TLName ";

                       } else {
                           echo " - ";
                       }

                       echo "</td></tr>";
                   //}
					   $no=1;
                       
					   
					   echo"<tr><th>NO</th><th>GENDER</th><th>FAMILY NAME</th><th >FIRST NAME</th><th>PASSPORT NO</th><th>COUNTRY OF ISSUE</th></tr>";

					   mysql_data_seek($cariteel,0);
                       while($tlnya=mysql_fetch_array($cariteel)){
                           $carisatu=mssql_query("SELECT * ,substring(NameAsPassport,1,CHARINDEX(' ',NameAsPassport,1)) as Firstname, SUBSTRING(NameAsPassport, CHARINDEX(' ', NameAsPassport) + 1, 8000) AS Lastname FROM Employee
                                    where EmployeeID = '$tlnya[EmployeeID]'
                                    order by EmployeeName ASC");
                           $hasilsatu=mssql_num_rows($carisatu);
                         
                           if($hasilsatu>0){
                                $datatl=mssql_fetch_array($carisatu);
                                if($datatl[BirthDate]=='0000-00-00' OR $datatl[BirthDate]==''){$bdate="";}else{
                                $bdate = date("d M Y", strtotime($datatl[BirthDate]));
                                }
                                if($datatl[PassportValid]=='0000-00-00' OR $datatl[PassportValid]==''){$pvalid="";}else{
                                $pvalid = date("d M Y", strtotime($datatl[PassportValid]));
                                }          
                                echo "<tr><td>$no</td>
                                      <td>$datatl[Title]</td>
									  <td>$datatl[Lastname]</td>
								      <td>$datatl[Firstname]</td>
								      <td>$datatl[PassportNo]</td>
								      <td>$datatl[PassportIssued]</td>
                                      </tr>";    
                           }
                           $no++;
                       }
                  
				    while ($data=mysql_fetch_array($edit)){
					
                        if($data[BirthDate]=='0000-00-00' OR $data[BirthDate]==''){$bdate='';}else{
                        $bdate = date("d M Y", strtotime($data[BirthDate]));}
						
                        if($data[PassportValid]=='0000-00-00' OR $data[PassportValid]==''){$pvalid='';}else{
                        $pvalid = date("d M Y", strtotime($data[PassportValid]));}         
						
                        
						   echo "<tr><td>$no</td>
						   		<td>$data[Title]</td>
								<td>$data[LastPaxName]</td>
								<td>$data[FirstPaxName]</td>
								<td>$data[PassportNo]</td>
								<td>$data[PassportIssued]</td>";
							$no++;
					}
                    echo"</table><br><center><input type='button' name='submit' value='Export to Excel' onclick=location.href='namelistBucherer.php?IDProduct=$nama'>";

         }
         // ITINERARY
         else if($file=='itin'){
             $ambil=mysql_query("SELECT tour_msproduct.IDProduct,tour_msproduct.TourCode,tour_msproduct.Year,TCDivision,tour_msbooking.BookingID,
                    tour_msproductcode.Productcode,tour_msproduct.DateTravelFrom,tour_msproduct.TourLeaderInc,tour_msproduct.TourLeader,
                    tour_msproduct.Flight,tour_msproduct.StatusProduct,tour_msproduct.GroupType FROM tour_msproduct
                    left join tour_msbooking on tour_msbooking.IDTourcode = tour_msproduct.IDProduct
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode
                    WHERE tour_msproduct.IDProduct ='$IDProduct'");
             $isi=mysql_fetch_array($ambil);

             $jumlah=mysql_num_rows($edit);
             $rum=mysql_query("SELECT sum(AdultPax)as jumlaadult,sum(ChildPax)as jumlachild,sum(InfantPax)as jumlainf FROM tour_msbooking
                                WHERE IDTourcode = '$isi[IDProduct]'
                                And Status = 'ACTIVE'
                                And BookingStatus = 'DEPOSIT'
                                group by TourCode ASC");
             $room=mysql_fetch_array($rum);
             $jumteel=mysql_query("SELECT * FROM tour_msproducttl
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL'
                                order by IDPTL ASC");
             $banyakteel=mysql_num_rows($jumteel);
             if($isi[TourLeaderInc]=='YES'){$tl=$banyakteel;}else{$tl=0;}
             $seluruh=$room[jumlaadult]+$room[jumlachild]; //+ $tl;
             echo "<table STYLE='border: 0px solid #000000' id='itinBucherer'>
						<tr><td style='border: 0px solid #000000;' colspan='6'><font size=4><u><b>ITINERARY</b></u></font></td></tr>
						<tr><td style='border: 0px solid #000000; text-align:center' colspan='6'><img src='images/pano.jpg' height='50px'></td></tr>
						<tr><td style='border: 0px solid #000000;' colspan='12'><font size=3><b>TOUR CODE : $isi[Productcode] - $isi[TourCode]</b></font></td></tr>
						<tr><td style='border: 0px solid #000000;' colspan='6';><font size=1><b>TOTAL PAX :  $seluruh + $tl TL</b></font></td></tr>
						<tr><td style='border: 0px solid #000000;' colspan='6';>Tour Leader : ";
             $cariteel=mysql_query("SELECT * FROM tour_msproducttl
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL'
                                order by IDPTL ASC");
             $hasilteel=mysql_num_rows($cariteel);
             if($hasilteel>0){

                 while($Namatl=mysql_fetch_array($cariteel)){
                     $QCariNamaTL=mssql_query("SELECT * FROM Employee
                                    where EmployeeID = '$Namatl[EmployeeID]'
                                    order by EmployeeName ASC");
                     $DCariNamaTL=mssql_fetch_array($QCariNamaTL);

                     if($TLName=='')
                     {$TLName="$DCariNamaTL[NameAsPassport] - $DCariNamaTL[Mobile]";}else{$TLName=$TLName.' , '.$DCariNamaTL[NameAsPassport].' - '.$DCariNamaTL[Mobile];}
                 }
                 echo" $TLName ";

             }
             else
             {
                 echo" - ";
             }

             echo"</td></tr>
                  <tr><th width='100'>DD.MM.YY</th><th>City</th></tr>";
             $tblitin=mysql_query("SELECT *,CONVERT(Days, UNSIGNED INTEGER) as urut FROM tour_msitin
                                WHERE ProductID ='$isi[IDProduct]' and Language = 'INDONESIA' and Style = 'LTM' order by urut");
             $dateday = $isi[DateTravelFrom];
             $tanggalday = substr($dateday,8,2);
             $bulanday = substr($dateday,5,2);
             $tahunday = substr($dateday,0,4);
             $day=0;
             while($itin=mysql_fetch_array($tblitin)){
                 if($day==0){
                     $oneday= strtoupper(date('d M Y',strtotime('0 second',strtotime($day.' day',strtotime(date($bulanday).'/'.date($tanggalday).'/'.date($tahunday).' 00:00:00')))));
                     echo"<tr><td>$oneday</td><td>$itin[Route]</td></tr>";
                 }else{
                     $oneday= strtoupper(date('d M Y',strtotime('0 second',strtotime($day.' day',strtotime(date($bulanday).'/'.date($tanggalday).'/'.date($tahunday).' 00:00:00')))));
                     echo"<tr><td>$oneday</td><td>$itin[Route]</td></tr>";
                 }
                 $day++;
             }echo"</table><br><center><input type='button' name='submit' value='Export to Excel' onclick=location.href='itinBucherer.php?IDProduct=$nama'>";
         }
	    }
	break;

}
?>
