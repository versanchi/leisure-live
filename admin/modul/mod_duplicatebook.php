<script language="JavaScript"  type="text/javascript">         
function hapusd(DP,ID)
{
    var alasan=prompt("Reason for Cancel Booking ID: " + ID );
    if (alasan!=null && alasan!="")
{                                                                                     
 window.location.href = '?module=duplicatebook&act=cancelbook&code=' + ID + '&dp=' + DP + '&reason=' + alasan ;      
} 
}
function hapusi(IN,ID)
{
var alasan=prompt("Reason for Cancel Inquiry: " + ID );
    if (alasan!=null && alasan!="")
{
 window.location.href = '?module=duplicatebook&act=cancelinq&code=' + ID + '&inq=' + IN + '&reason=' + alasan ; ;      
} 
}
 
</script>
<?php 
$username=$_SESSION[employee_code];
$sqluser=mssql_query("SELECT EmployeeID,DivisiNO,Employee.DivisiID,Category,EmployeeName,CompanyGroup,LTMAuthority FROM [HRM].[dbo].[Employee]
                      inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                      WHERE EmployeeID = '$username'");
$tampiluser=mssql_fetch_array($sqluser);
$EmpName=$tampiluser[EmployeeName];
$team=$filter[DivisiID];
$ltm_authority=$filter[LTMAuthority];
$companyid = $_SESSION['company_id'];
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
$hariini = date("Y-m-d ");
switch($_GET[act]){
  // Tampil Office
  default:
      $nama=$_GET['nama'];
    echo "<h2>Duplicate Booking</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='duplicatebook'>
              TourCode <input type=text name=nama value='$nama' size=20>    
              <input type=submit name=oke value=Search>
          </form>";
          $oke=$_GET['oke'];
 
          // Langkah 1
          $batas = 10;
          $halaman= $_GET['halaman'];
          if(empty($halaman)){
              $posisi  = 0;
            $halaman = 1;
          } else {
              $posisi = ($halaman-1) * $batas; }
            
            // Langkah 2
            /*$filt=mysql_query("SELECT * FROM tbl_msemployee
                                left join tbl_msoffice on tbl_msoffice.office_id=tbl_msemployee.office_id
                                WHERE tbl_msemployee.employee_code = '$_SESSION[employee_code]'");
            $filter=mysql_fetch_array($filt);*/

            $thisyear = date("Y");
            if($tampiluser[LTMAuthority]=='DEVELOPER'){
            $tampil=mysql_query("SELECT * FROM tour_msbooking 
                                inner join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                inner join (select depositno,count(depositno) as total,status from tour_msbooking where status='active'  
                                GROUP BY depositno ) jumlah on tour_msbooking.depositno=jumlah.depositno 
                                where jumlah.total > 1
                                AND tour_msbooking.TourCode LIKE '%$nama%'
                                AND tour_msbooking.Status ='ACTIVE'
                                AND tour_msbooking.BookingStatus ='DEPOSIT'
                                AND tour_msbooking.Year >= '$thisyear'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
                                group by BookingID ASC order by tour_msbooking.DepositNo,BookingID LIMIT $posisi,$batas");
            }else if($tampiluser[LTMAuthority]=='PO' or $tampiluser[LTMAuthority]=='PO MANAGER'){
            $tampil=mysql_query("SELECT * FROM tour_msbooking
                                inner join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                inner join (select depositno,count(depositno) as total,status from tour_msbooking where status='active'
                                GROUP BY depositno ) jumlah on tour_msbooking.depositno=jumlah.depositno
                                where jumlah.total > 1
                                AND tour_msbooking.TourCode LIKE '%$nama%'
                                AND tour_msbooking.Status ='ACTIVE'
                                AND tour_msbooking.BookingStatus ='DEPOSIT'
                                AND tour_msbooking.Year >= '$thisyear'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
                                AND tour_msproduct.CompanyID = '$companyid'
                                group by BookingID ASC order by tour_msbooking.DepositNo,BookingID LIMIT $posisi,$batas");
            } else {
            $tampil=mysql_query("SELECT * FROM tour_msbooking 
                                inner join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                inner join (select depositno,count(depositno) as total,status from tour_msbooking where status='active'  
                                GROUP BY depositno ) jumlah on tour_msbooking.depositno=jumlah.depositno 
                                where jumlah.total > 1
                                AND tour_msbooking.TourCode LIKE '%$nama%'
                                AND TCDivision = '$team'
                                AND tour_msbooking.Status ='ACTIVE'
                                AND tour_msbooking.BookingStatus ='DEPOSIT'
                                AND tour_msbooking.Year >= '$thisyear'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
                                group by BookingID ASC order by tour_msbooking.DepositNo,BookingID LIMIT $posisi,$batas");    
            }
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "   <table>   
                    <tr><th colspan=8></th><th colspan=3>total pax</th><th></th></tr>
                    <tr><th>no</th><th>Booking ID</th><th>tour code</th><th>Dept</th><th>Bookers</th><th>tc name</th><th>divisi</th><th>cash receipt</th><th>adult</th><th>child</th><th>infant</th><th>action</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){                                                
               echo "<tr><td>$no</td>
                     <td>$data[BookingID]</td></td>                                   
                     <td>$data[TourCode]</td>
                     <td>$data[DateTravelFrom]</td>
                     <td>$data[BookersName]</td>
                     <td><center>$data[TCName]</td>
                     <td><center>$data[TCDivision]</td>
                     <td><center>$data[DepositNo]</td>
                     <td><center>$data[AdultPax]</td>
                     <td><center>$data[ChildPax]</td>
                     <td><center>$data[InfantPax]</td>   
                     <td><center>";
                     if($data[StatusProduct]=='FINALIZE'){echo"<b>FINALIZE</b>";
                     }else{if($data[DepositNo]==''){ 
                         echo"<input type='button' name='submit' value='CANCEL' onclick=hapusi('$totalinq','$data[BookingID]') $bisa>";    
                     }else{               
                         echo"<input type='button' name='submit' value='CANCEL' onclick=hapusd('$totalinq','$data[BookingID]') $bisa>"; 
                     }}
                     echo"
                     </td></tr>";
                      $no++;
                    }
                    echo "</table>";
                    
                    // Langkah 3            
                        if($tampiluser[LTMAuthority]=='DEVELOPER'){
                        $tampil2="SELECT * FROM tour_msbooking
                                inner join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                inner join (select depositno,count(depositno) as total,status from tour_msbooking where status='active'  
                                GROUP BY depositno ) jumlah on tour_msbooking.depositno=jumlah.depositno 
                                where jumlah.total > 1
                                AND tour_msbooking.TourCode LIKE '%$nama%'
                                AND tour_msbooking.Status ='ACTIVE'
                                AND tour_msbooking.BookingStatus ='DEPOSIT'
                                AND tour_msbooking.Year >= '$thisyear'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
                                group by BookingID ASC order by tour_msbooking.DepositNo,BookingID";
                        }else if($tampiluser[LTMAuthority]=='PO' or $tampiluser[LTMAuthority]=='PO MANAGER'){
                            $tampil2="SELECT * FROM tour_msbooking
                                inner join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                inner join (select depositno,count(depositno) as total,status from tour_msbooking where status='active'
                                GROUP BY depositno ) jumlah on tour_msbooking.depositno=jumlah.depositno
                                where jumlah.total > 1
                                AND tour_msbooking.TourCode LIKE '%$nama%'
                                AND tour_msbooking.Status ='ACTIVE'
                                AND tour_msbooking.BookingStatus ='DEPOSIT'
                                AND tour_msbooking.Year >= '$thisyear'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
                                AND tour_msproduct.CompanyID = '$companyid'
                                group by BookingID ASC order by tour_msbooking.DepositNo,BookingID";
                        }else {
                        $tampil2="SELECT * FROM tour_msbooking 
                                inner join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                inner join (select depositno,count(depositno) as total,status from tour_msbooking where status='active'  
                                GROUP BY depositno ) jumlah on tour_msbooking.depositno=jumlah.depositno 
                                where jumlah.total > 1
                                AND tour_msbooking.TourCode LIKE '%$nama%'
                                AND TCDivision = '$team'
                                AND tour_msbooking.Status ='ACTIVE'
                                AND tour_msbooking.BookingStatus ='DEPOSIT'
                                AND tour_msbooking.Year >= '$thisyear'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
                                group by BookingID ASC order by tour_msbooking.DepositNo,BookingID";    
                        }
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=duplicatebook";
                    // Link ke halaman sebelumnya (previous)
                    echo "<center><div id='paging'>";
                    if ($halaman >1) {
                        $previous = $halaman-1;
                        echo "<a href=$file&halaman=1&nama=$nama&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&nama=$nama&oke=$oke> < Previous</a> | ";
                    } else {
                        echo "<< First | < Previous | ";
                    }
                    // Tampilkan link halaman 1,2,3 ... modifikasi ala google
                    // Angka awal
                    $angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
                    for ($i=$halaman-2; $i<$halaman; $i++) {
                        if ($i < 1 )
                            continue;
                        $angka .= "<a href=$file&halaman=$i&nama=$nama&oke=$oke>$i</a> ";
                    }
                    // Angka tengah
                    $angka .= " <b>$halaman</b> ";
                    for ($i=$halaman+1; $i<($halaman+3); $i++) {
                        if ($i > $jmlhalaman)
                            break;
                        $angka .= "<a href=$file&halaman=$i&nama=$nama&oke=$oke>$i</a> ";    
                    }
                    // Angka akhir
                    $angka .= ($halaman+2<$jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&nama=$nama&oke=$oke>$jmlhalaman</a> |" : " ");
                    // Cetak angka seluruhnya (awal, tengah, akhir)
                    echo "$angka";
                    // Link ke halaman berikutnya (Next)
                    if ($halaman < $jmlhalaman) {
                        $next = $halaman+1;
                        echo "<a href=$file&halaman=$next&nama=$nama&oke=$oke> Next ></a> |
                              <a href=$file&halaman=$jmlhalaman&nama=$nama&oke=$oke> Last >></a> ";
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
              
 case "cancelbook":    
    $edit1=mysql_query("SELECT count(IDDetail)as tota,BookingID,TourCode FROM tour_duplicatebook WHERE BookingID ='$_GET[code]' and Status <> 'CANCEL' and Gender <>'INFANT' GROUP BY BookingID");  
    $r2=mysql_fetch_array($edit1);
    $cari1=mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r2[TourCode]' and Status <> 'VOID'");  
    $ulang=mysql_fetch_array($cari1);
    $seatcancel = $r2[tota];  
    $seatdep = $ulang[SeatDeposit] - $seatcancel;
    $seatsisa = $ulang[SeatSisa] + $seatcancel;
    $updet=mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdep',
                                                        SeatSisa='$seatsisa'
                                                        WHERE IDProduct = '$ulang[IDProduct]'");
    $updets=mysql_query("UPDATE tour_msbooking set Status='VOID',ReasonCancel='$_GET[reason]',CancelBy='$EmpName',CancelDate='$today' WHERE BookingID = '$_GET[code]'");
    $edit=mysql_query("UPDATE tour_duplicatebook set Status = 'CANCEL',
                                                        Price='0',
                                                        AddCharge='0',
                                                        SubTotal='0' 
                                                        WHERE BookingID = '$r2[BookingID]'");
    $Description="Cancel Booking $r2[BookingID]";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
    $ceking=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");  
    $cek=mysql_fetch_array($ceking);
    $autocek=mysql_query("UPDATE tour_msbooking set Duplicate='NO' WHERE DepositNo = '$cek[DepositNo]' and Duplicate='YES' order by IDBookers ASC limit 1");                        
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=duplicatebook'>";
    break; 
    
  case "cancelinq":    
    $edit1=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID ='$_GET[code]'");  
    $r2=mysql_fetch_array($edit1);
    $cari1=mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r2[TourCode]' and Status <> 'VOID'");  
    $ulang=mysql_fetch_array($cari1);
    $seatcancel = $_GET[inq];  
    $seatdep = $ulang[SeatInquiry] - $seatcancel; 
    $updet=mysql_query("UPDATE tour_msproduct set SeatInquiry = '$seatdep'
                                                        WHERE IDProduct = '$ulang[IDProduct]'");
    $updets=mysql_query("UPDATE tour_msbooking set Status='VOID',ReasonCancel='$_GET[reason]',CancelBy='$EmpName',CancelDate='$today' WHERE BookingID = '$_GET[code]'");
    $Description="Cancel Inquiry $_GET[code]";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=duplicatebook'>";
    break;
    
 
}
?>
