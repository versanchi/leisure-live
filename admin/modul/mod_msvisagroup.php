<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script> 
<link type="text/css" href="../head/jquery-ui-1.7.2.custom.css" rel="stylesheet" />    
<script language="JavaScript"  type="text/javascript">   
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
</script>
<script type="text/javascript"> 
function generateexcel(tableid) {
  var table= document.getElementById(tableid);
  var html = table.outerHTML;   
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));    
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
include "../config/fungsi_an.php";

switch($_GET[act]){
  // Tampil Search Tour code
  default:
      $nama=$_GET['nama'];
      $opnama=$_GET['opnama'];
      if($opnama==''){$opnama='TourCode';}
      $hariini = date("Y-m-d ");              
            
     echo "<h2>VISA TIME FRAMES</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='msvisagroup'>
              <center><input type=text name='nama' value='$nama' size=20>    
              <input type=submit name=oke value=Search>
          </form>";
          $oke=$_GET['oke'];
          $hari = date("Y-m-d", time());
          // Langkah 1
          $batas = 15;
          $halaman= $_GET['halaman'];
          if(empty($halaman)){
              $posisi  = 0;
            $halaman = 1;
          } else {
              $posisi = ($halaman-1) * $batas; }
            
            // Langkah 2   AND DateTravelFrom > '$hari' 
            $tampil=mysql_query("SELECT * FROM tbl_msembassy   
                                WHERE Status = 'ACTIVE'
                                AND Type = 'VISA'
                                AND Country LIKE '%$nama%'
                                ORDER BY Country ASC LIMIT $posisi,$batas");
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "<table>
                    <tr><th>no</th><th>country</th><th>Visa Time frame</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){     
               echo "<tr><td>$no</td>
                     <td>$data[Country]</td>                                   
                     <td><center><a href=\"javascript:PopupCenter('visatimeframe.php?code=$data[CountryID]','variable',300,170)\">$data[VisaTimeFrame] DAYS</a></td></tr>";
                      $no++;
                    }
                    echo "</table>";
                    
                    // Langkah 3            
                    $tampil2    = "SELECT * FROM tbl_msembassy   
                                WHERE Status = 'ACTIVE'
                                AND Type = 'VISA'
                                AND Country LIKE '%$nama%'
                                ORDER BY Country ASC";
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=msvisagroup";
                    // Link ke halaman sebelumnya (previous)
                    echo "<center><div id='paging'>";
                    if ($halaman >1) {
                        $previous = $halaman-1;
                        echo "<a href=$file&halaman=1&opnama=$opnama&nama=$nama&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&opnama=$opnama&nama=$nama&oke=$oke> < Previous</a> | ";
                    } else {
                        echo "<< First | < Previous | ";
                    }
                    // Tampilkan link halaman 1,2,3 ... modifikasi ala google
                    // Angka awal
                    $angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
                    for ($i=$halaman-2; $i<$halaman; $i++) {
                        if ($i < 1 )
                            continue;
                        $angka .= "<a href=$file&halaman=$i&opnama=$opnama&nama=$nama&oke=$oke>$i</a> ";
                    }
                    // Angka tengah
                    $angka .= " <b>$halaman</b> ";
                    for ($i=$halaman+1; $i<($halaman+3); $i++) {
                        if ($i > $jmlhalaman)
                            break;
                        $angka .= "<a href=$file&halaman=$i&opnama=$opnama&nama=$nama&oke=$oke>$i</a> ";    
                    }
                    // Angka akhir
                    $angka .= ($halaman+2<$jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&opnama=$opnama&nama=$nama&oke=$oke>$jmlhalaman</a> |" : " ");
                    // Cetak angka seluruhnya (awal, tengah, akhir)
                    echo "$angka";
                    // Link ke halaman berikutnya (Next)
                    if ($halaman < $jmlhalaman) {
                        $next = $halaman+1;
                        echo "<a href=$file&halaman=$next&opnama=$opnama&nama=$nama&oke=$oke> Next ></a> |
                              <a href=$file&halaman=$jmlhalaman&opnama=$opnama&nama=$nama&oke=$oke> Last >></a> ";
                    } else {
                        echo " Next > | Last >>";
                    }                    
                    echo "<br><br>Found <b>$jmldata</b> data(s)<p>";
                    echo "</div>";
            } else {
                echo "<div id='paging'>";
                echo "<br><br>Data Not Found<p>";
                echo "</div>";
            }     

    break;
    
     case "tambahdateline":
    echo "<h2>Visa Group</h2>
          <form method=get action='media.php?'>
              Tour Code 
              <select name='nama'><option value=''>- Select TourCode -</option>"; 
              $option = mysql_query("SELECT tour_msproduct.IDProduct,tour_msproduct.TourCode FROM tour_msbooking 
                                    left join tour_msproduct on tour_msproduct.TourCode = tour_msbooking.TourCode
                                    WHERE tour_msproduct.DateTravelTo >= '$hariini'
                                    AND tour_msproduct.Year = tour_msbooking.Year 
                                    AND tour_msbooking.TourCode <> '' AND tour_msproduct.Status <> 'VOID' AND tour_msproduct.Status = 'PUBLISH' AND tour_msbooking.Status = 'ACTIVE'
                                    GROUP BY tour_msbooking.TourCode ASC");  
              while($s=mysql_fetch_array($option)){
              if ($s['IDProduct']==$nama){
                echo "<option value='$s[IDProduct]' selected >$s[TourCode]</option>";  
              }else {
              echo "<option value='$s[IDProduct]'>$s[TourCode]</option>";
              }
                   
              }
    echo "</select> <input type=hidden name=module value='msvisagroup'> 
              <input type=submit name=oke value=Show>
          </form>";
		   $oke=$_GET['oke'];
   
	
		$IDProduct=$nama;    
	    
		if($IDProduct<>''){
         $ambil=mysql_query("SELECT tour_msproduct.IDProduct,tour_msproduct.TourCode,tour_msproduct.Year,TCDivision,tour_msbooking.BookingID,tour_msproduct.VisaDateline,
                    tour_msproductcode.Productcode,tour_msproduct.DateTravelFrom,tour_msproduct.TourLeaderInc,tour_msproduct.TourLeader,
                    tour_msproduct.Flight FROM tour_msproduct
                    left join tour_msbooking on tour_msbooking.IDTourcode = tour_msproduct.IDProduct 
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode     
                    WHERE tour_msproduct.IDProduct ='$IDProduct'");
         $isi=mysql_fetch_array($ambil);
         $edit=mysql_query("SELECT tour_msbookingdetail.*,tour_msbooking.TBFNo FROM tour_msbookingdetail                                                 
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                    AND tour_msbooking.Status = 'ACTIVE' 
                    AND tour_msbookingdetail.Status <> 'CANCEL'
                    order by tour_msbookingdetail.BookingID ,RoomNo ASC,IDDetail ASC");
		 $roomnow='awal';
         $jumlah=mysql_num_rows($edit);
         $depdet = date("d M Y", strtotime($isi[DateTravelFrom]));  
          if($isi[TourLeaderInc]=='YES'){$tl=$banyakteel;}else{$tl=0;}
         $seluruh=$room[jumlaadult]+$room[jumlachild] + $tl;
          $totrum=mysql_query("SELECT tour_msbookingdetail.RoomNo FROM tour_msbookingdetail                                                 
                                left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                                AND tour_msbookingdetail.Status <> 'CANCEL'
                                AND tour_msbooking.Status = 'ACTIVE'
                                group by tour_msbookingdetail.RoomNo ASC");        
         $totroom=mysql_num_rows($totrum);
		 
            if ($jumlah > 0) {              
            $VD = date('d-m-Y', strtotime($isi[VisaDateline]));
            $new_date = date('d-m-Y');                                          
            if($isi[VisaDateline]=='0000-00-00'){$VD='';}else{$VD=$VD;}
            echo "  <form name='example' method='POST' action='./aksi.php?module=msvisagroup&act=update'>
                    <input type=hidden name='id' value='$isi[IDProduct]'>
                    <table STYLE='border: 0px solid #000000'>
			        <tr><td style='border: 0px solid #000000;' colspan=6></td></tr>
                    <tr><td style='border: 0px solid #000000;' colspan=6><font size=4><u><b>VISA GROUP</b></u></font></td></tr>
                    <tr><td style='border: 0px solid #000000;' colspan=6><font size=3><b>TOUR NAME </td><td style='border: 0px solid #000000;' colspan=6><font size=3><b>: $isi[Productcode] - $isi[TourCode]</b></font></td></tr>
                    <tr><td style='border: 0px solid #000000;' colspan=6><font size=3><b>DEPARTURE </td><td style='border: 0px solid #000000;' colspan=6><font size=3><b>: $depdet </b></font></td></tr>
                    <tr><td style='border: 0px solid #000000;' colspan=6><font size=3><b>VISA DATELINE </td><td style='border: 0px solid #000000;' colspan=6><font size=3><b>: <input type='text' value='$VD'  name='datelinevisa' size='10' onfocus='selisih()' onClick="."cal.select(document.forms['example'].datelinevisa,'ActIn1','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(dd-mm-yyyy)</font> <input type=submit value=Save></b></font></td></tr>  
                    </table>
                    </form><br><center>";
	}
	}        
	break;
	
case "namelistgrv":
      $idgrv=$_GET['no'];
      $list=$_GET['list'];
      $hariini = date("Y-m-d ");
      $tampil2=mysql_query("SELECT job_desc FROM tbl_msemployee WHERE employee_username='$_SESSION[namauser]'");
      $hasil2=mysql_fetch_object($tampil2);
      $JobDesc=$hasil2->job_desc;
      $option = mysql_query("SELECT * FROM tour_msproductpnr 
                                    WHERE GrvID = '$idgrv'
                                    order BY PnrID ASC");  
      //echo "<h2>Name List</h2>";
      $qpnr=mysql_query("SELECT * FROM tour_msgrv                                                 
                                        WHERE IDGrv ='$idgrv'");
      $pnr=mysql_fetch_array($qpnr);
      echo"  <table STYLE='border: 0px solid #000000' id='namelistgrv'>
                    <tr><td style='border: 0px solid #000000;' colspan=6></td></tr>
                    <tr><td style='border: 0px solid #000000;' colspan=6><font size=4><u><b>FINAL NAME LIST </b></u></font></td></tr>
                    <tr><td style='border: 0px solid #000000;' colspan=5><u>FLIGHT SCHEDULE : $pnr[GrvPnr]</u></td></tr>";
                    
                    $fly=mysql_query("SELECT * FROM tour_msprodflight                                                 
                                        WHERE IDGrv ='$idgrv' order by FID ASC");
                    echo"<tr><td style='border: 0px solid #000000;' colspan='4'>
                        <table STYLE='border: 0px solid #000000'>";
                    while($flight=mysql_fetch_array($fly)){
                        $AD = date('d-m-Y', strtotime($flight[AirDate]));
                        echo"
                        <tr><td style='border: 0px solid #000000;'><font size=1>$flight[AirCode]</font></td>
                        <td style='border: 0px solid #000000;'><font size=1>$AD</font></td>
                        <td style='border: 0px solid #000000;'><center><font size=1>$flight[AirRouteDep] - $flight[AirRouteArr]</font></td>
                        <td style='border: 0px solid #000000;'><font size=1>$flight[AirTimeDep]</font></td>
                        <td style='border: 0px solid #000000;'><font size=1>$flight[AirTimeArr]</font></td></tr>";
                       
                    }echo"</table>  
                        </td></tr>
                        <tr><th>NO</th><th>Tourcode/Booking no</th><th>passanger's name</th><th>remarks</th><th>contact no</th><th>TC</th><th>passport no</th><th colspan=2>place & date of birth</th><th colspan=2>place & date of expiry</th></tr>"; 
      while($s=mysql_fetch_array($option)){      
                                 
        $IDProduct=$s[PnrProd];    
        
        if($IDProduct<>''){
         $ambil=mysql_query("SELECT tour_msproduct.IDProduct,tour_msproduct.TourCode,tour_msproduct.Year,TCDivision,tour_msbooking.BookingID,
                    tour_msproductcode.Productcode,tour_msproduct.DateTravelFrom,tour_msproduct.TourLeaderInc,tour_msproduct.TourLeader,
                    tour_msproduct.Flight FROM tour_msproduct
                    left join tour_msbooking on tour_msbooking.IDTourcode = tour_msproduct.IDProduct 
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode     
                    WHERE tour_msproduct.IDProduct ='$IDProduct'");
         $isi=mysql_fetch_array($ambil);
         $edit=mysql_query("SELECT tour_msbookingdetail.*,tour_msbooking.TBFNo FROM tour_msbookingdetail                                                 
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                    AND tour_msbooking.Status = 'ACTIVE' 
                    AND tour_msbookingdetail.Status <> 'CANCEL'
                    order by tour_msbookingdetail.BookingID ,RoomNo ASC,IDDetail ASC");
         $roomnow='awal';
         $jumlah=mysql_num_rows($edit);
         $depdet = date("d M Y", strtotime($isi[DateTravelFrom]));
         
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
         $seluruh=$room[jumlaadult]+$room[jumlachild] + $tl;
          $totrum=mysql_query("SELECT tour_msbookingdetail.RoomNo FROM tour_msbookingdetail                                                 
                                left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                                AND tour_msbookingdetail.Status <> 'CANCEL'
                                AND tour_msbooking.Status = 'ACTIVE'
                                group by tour_msbookingdetail.RoomNo ASC");        
         $totroom=mysql_num_rows($totrum);
                                                
                    
                   $nonya=$nonya;
                   if($nonya>1){$nonya=$nonya;}else{$nonya=$nonya+1;}
                   if ($jumlah > 0) {
                   if($isi[TourLeaderInc]=='YES'){
                       $cariteel=mysql_query("SELECT * FROM tour_msproducttl   
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL' 
                                order by IDPTL ASC");        
                       $hasilteel=mysql_num_rows($cariteel);
                       $no=$hasilteel+1;
                       $notl=1;
                       while($tlnya=mysql_fetch_array($cariteel)){
                           $carisatu=mysql_query("SELECT * FROM tour_mstourleader   
                                    where TourleaderStatus = 'ACTIVE'
                                    AND TourleaderName = '$tlnya[TLName]' 
                                    order by TourleaderName ASC");        
                           $hasilsatu=mysql_num_rows($carisatu);
                           $caridua=mysql_query("SELECT * FROM tbl_msemployee 
                                    where employee_tl = 'on'
                                    AND employee_name = '$tlnya[TLName]'
                                    ORDER BY employee_name ASC");        
                           $hasildua=mysql_num_rows($caridua);
                           if($hasilsatu>0){
                                $datatl=mysql_fetch_array($carisatu);
                                if($datatl[TourleaderBirthDate]=='0000-00-00' OR $datatl[TourleaderBirthDate]==''){$bdate="";}else{
                                $bdate = date("d M Y", strtotime($datatl[TourleaderBirthDate]));
                                }
                                if($datatl[TourleaderPassportValid]=='0000-00-00' OR $datatl[TourleaderPassportValid]==''){$pvalid="";}else{
                                $pvalid = date("d M Y", strtotime($datatl[TourleaderPassportValid]));
                                }          
                                echo "<tr><td>$nonya </td>
                                    <td></td>
                                    <td>$datatl[TourleaderName]</td>   
                                    <td><center>TOUR LEADER</td>
                                    <td>$datatl[TourleaderMobile]</td>
                                    <td></td>
                                    <td>$datatl[TourleaderPassportNo]</td>
                                    <td>$datatl[TourleaderBirthPlace]</td>
                                    <td>$bdate</td>
                                    <td>$datatl[TourleaderPassportIssued]</td> 
                                    <td>$pvalid</td>             
                                    </tr>";
                                    $nonya++;      
                           }else{
                                $datatl=mysql_fetch_array($caridua);
                               if($datatl[TourleaderBirthDate]=='0000-00-00' OR $datatl[TourleaderBirthDate]==''){$bdate="";}else{
                                $bdate = date("d M Y", strtotime($datatl[TourleaderBirthDate]));
                                }
                                if($datatl[TourleaderPassportValid]=='0000-00-00' OR $datatl[TourleaderPassportValid]==''){$pvalid="";}else{
                                $pvalid = date("d M Y", strtotime($datatl[TourleaderPassportValid]));
                                }          
                                echo "<tr><td>$nonya</td>
                                    <td></td>
                                    <td>$datatl[employee_name]</td>
                                    <td><center>TOUR LEADER</td>
                                    <td></td>
                                    <td></td>
                                    <td>$datatl[PassportNo]</td>
                                    <td>$datatl[BirthPlace]</td>
                                    <td>$bdate</td>
                                    <td>$datatl[PassportIssued]</td> 
                                    <td>$pvalid</td>             
                                    </tr>";
                                    $nonya++;    
                           }
                           $notl++;
                              
                       }
                   }else{$no=1;}
                    $lastbooking='awal';
                    while ($data=mysql_fetch_array($edit)){
                        if($data[BirthDate]=='0000-00-00' OR $data[BirthDate]==''){$bdate='';}else{
                        $bdate = date("d M Y", strtotime($data[BirthDate]));}
                        if($data[PassportValid]=='0000-00-00' OR $data[PassportValid]==''){$pvalid='';}else{
                        $pvalid = date("d M Y", strtotime($data[PassportValid]));}         
                        $dtable=mysql_query("SELECT * FROM tour_msbooking                                                 
                                                WHERE BookingID ='$data[BookingID]'
                                                AND Status = 'ACTIVE'
                                                order by IDBookers ASC");        
                        $itable=mysql_fetch_array($dtable);    
                        $BookingID=mysql_query("SELECT * FROM tour_msbookingdetail                                                 
                        left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                        WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                        AND tour_msbooking.Status = 'ACTIVE'
                        AND tour_msbookingdetail.Status <> 'CANCEL' 
                        and tour_msbooking.BookingID='$data[BookingID]'
                        order by tour_msbooking.BookingID ASC,IDDetail ASC");
                        $jumlahBooking=mysql_num_rows($BookingID);
                        if($data[Gender]=='ADULT'){$gender='ADL';}
                        else if($data[Gender]=='CHILD'){$gender='CHD';}
                        else if($data[Gender]=='INFANT'){$gender='INF';}
                        if($data[PaxName]==''){$pax='TBA';}else{$pax=$data[PaxName];}
               echo "<tr><td>$nonya</td>";
                        if($lastbooking<>$data[BookingID]){echo"<td rowspan='$jumlahBooking' style=vertical-align:middle>$isi[Productcode] <br> $isi[TourCode]<br>$data[BookingID]</td>";}
                echo"<td>($gender) $data[Title] $pax</td>";    
                        if($data[Package]=='L.A Only'){echo"<td><center>$data[Package]  $data[Deviasi]</td>";}else{echo"<td><center>$data[Deviasi]</td>";}
                        if($lastbooking<>$data[BookingID]){echo"<td rowspan='$jumlahBooking' style=vertical-align:middle>$itable[BookersName] <br> $itable[BookersTelp] <br>$itable[BookersMobile]</td>";
                        echo"<td rowspan='$jumlahBooking' style=vertical-align:middle>$itable[TCName] <br>( $itable[TCDivision] ) </td>";
                        $lastbooking=$data[BookingID];}
                        
                        echo"<td>$data[PassportNo]</td>
                        <td>$data[BirthPlace]</td>
                        <td>$bdate</td>
                        <td>$data[PassportIssued]</td> 
                        <td>$pvalid</td>             
                     </tr> ";
                      $no++;
                      $nonya++;
                    }
            }
                    
    }           
    }  echo"</table><br><center><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('namelistgrv')>";   
    break; 
        
}
?>
