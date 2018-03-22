<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>         
<script type="text/javascript" src="../head/editable-select.js"></script> 
 <script language="JavaScript"  type="text/javascript">      
function rubah(ID)
{
if (confirm("Are you sure you want to void " + ID +""))
{
 window.location.href = 'media.php?module=formbookingtour&act=voidfbt&FBT=' + ID  ;  
} 
}

</script> 

<?php
$username=$_SESSION[employee_code];
$sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_code='$username'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName=$tampiluser[employee_name];
$timezone_offset = +5;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s"); 
switch($_GET[act]){
  // Tampil Office
  default:
      $nama=$_GET['nama'];
      $hariini = date("Y-m-d ");
    echo "<h2>TRF List</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='formbookingtour'>
              TRF No <input type=text name=nama value='$nama' size=20>
              <input type=submit name=oke value=Search>
          </form>";
          $oke=$_GET['oke'];
 
          // Langkah 1
          $batas = 20;
          $halaman= $_GET['halaman'];
          if(empty($halaman)){
              $posisi  = 0;
            $halaman = 1;
          } else {
              $posisi = ($halaman-1) * $batas; }
            
            // Langkah 2 
            $filt=mysql_query("SELECT * FROM tbl_msemployee   
                                left join tbl_msoffice on tbl_msoffice.office_id=tbl_msemployee.office_id
                                WHERE tbl_msemployee.employee_code = '$_SESSION[employee_code]'");
            $filter=mysql_fetch_array($filt);
            $team=$filter[office_code];
            if($team=='IFM'){
            $tampil=mysql_query("SELECT * FROM tour_fbtbooking                                              
                                WHERE FBTNo LIKE '%$nama%' 
                                AND BookingID <> '' 
                                and DateTravelFrom >= '$hariini'
                                ORDER BY FBTNo ASC LIMIT 0,$batas");
            }else {
            $tampil=mysql_query("SELECT * FROM tour_fbtbooking                                              
                                WHERE FBTNo LIKE '%$nama%'
                                AND TCDivision = '$team'
                                and DateTravelFrom >= '$hariini'
                                ORDER BY FBTNo ASC LIMIT 0,$batas");
            }
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "   <table>   
                    <tr><th colspan=9></th><th colspan=3>total pax</th><th></th></tr>
                    <tr><th>no</th><th>TRF No</th><th>Booking ID</th><th>tour code</th><th>Dept</th><th width=80>Bookers</th><th>tc name</th><th>divisi</th><th>cash receipt</th><th>adult</th><th>child</th><th>infant</th><th>action</th></tr>";
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){                                                
               echo "<tr><td>$no</td>
                     <td><a href='../admin/fbt.php?act=showfbt&FBT=$data[FBTNo]' target='_blank'>$data[FBTNo]</a></td>
                     <td>$data[BookingID]"; 
                     $edit1=mysql_query("SELECT count(IDDetail)as bnyk FROM tour_fbtbookingdetail WHERE FBTNo ='$data[FBTNo]' and Gender <> 'INFANT' and Status <> 'CANCEL' ");  
                     $r2=mysql_fetch_array($edit1);
                     if($data[DepositNo]=='' || $data[DepositAmount]=='0.00' || $data[DepositDate]=='0000-00-00'){
                     $totalinq = $data[AdultPax] + $data[ChildPax];
                     }else{$totalinq = $r2[bnyk];} 
                     if($data[Status]=='ACTIVE'){$bisa="enabled";}else{$bisa="disabled";}                                 
                     echo"              
                     </td></td>                                   
                     <td>$data[TourCode]</td>
                     <td>$data[DateTravelFrom]</td>
                     <td>$data[BookersName]</td>
                     <td><center>$data[TCName]</td>
                     <td><center>$data[TCDivision]</td>
                     <td><center>$data[DepositNo]</td>
                     <td><center>$data[AdultPax]</td>
                     <td><center>$data[ChildPax]</td>
                     <td><center>$data[InfantPax]</td>   
                     <td><center><input type='button' name='submit' value='VOID' onclick=rubah('$data[FBTNo]') $bisa></td></tr>";
                      $no++;
                    }
                    echo "</table>";   
            } 

    break;
  
 
  case "voidfbt":    
    $edit=mysql_query("UPDATE tour_fbtbooking set Status = 'VOID',VoidDate='$today',VoidBy='$EmpName' WHERE FBTNo = '$_GET[FBT]'");
    $updet=mysql_query("UPDATE tour_msbooking set FBTNo='' WHERE FBTNo = '$_GET[FBT]'");
    $Description="VOID FBT ($_GET[FBT])";          
    mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");         
      echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=formbookingtour'>";
    break; 
}
?>
