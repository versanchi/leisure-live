
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
switch($_GET[act]){
  // Tampil Visa
  default:
      $nama=$_GET['nama'];
      $hariini = date("Y-m-d ");
      $tampil2=mssql_query("SELECT DivisiNO,Employee.DivisiID,Category,EmployeeName,LTMAuthority FROM [HRM].[dbo].[Employee]
                      inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                      WHERE EmployeeID = '$_SESSION[employee_code]'");
      $hasil2=mssql_fetch_array($tampil2);
      if($hasil2[LTMAuthority]=='PO BRANCH'){
          $filterpo="AND tour_msproduct.InputDivision = '$hasil2[DivisiID]'";
      }else{
          $filterpo='';
      }
    echo "<h2>Rooming List</h2>
          <form method='GET' action='roominglist.php' target='_blank'>
                <input type=hidden name=module value='rptroominglist'>   
              Tour Code 
              <select name='nama'><option value=''>- Select TourCode -</option>"; 
              $option = mysql_query("SELECT tour_msproduct.IDProduct,tour_msproduct.TourCode FROM tour_msbooking 
                                    left join tour_msproduct on tour_msproduct.TourCode = tour_msbooking.TourCode
                                    WHERE tour_msproduct.DateTravelTo >= '$hariini'
                                    AND tour_msproduct.Year = tour_msbooking.Year 
                                    AND tour_msbooking.TourCode <> ''
                                    and tour_msproduct.Status = 'PUBLISH'
                                    $filterpo
                                    GROUP BY tour_msbooking.TourCode ASC");  
              while($s=mysql_fetch_array($option)){
              if ($s['IDProduct']==$nama){
                echo "<option value='$s[IDProduct]' selected >$s[TourCode]</option>";    
              }else {
              echo "<option value='$s[IDProduct]'>$s[TourCode]</option>";
              }
                   
              }
    echo "</select> <input type=submit name='namelist' value='Show'> 
          </form>";
          
     break;
     
  case "editroom":
          $hariini = date("Y-m-d ");
          $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
          $r=mysql_fetch_array($edit);
          $totalpax=$r[AdultPax] + $r[ChildPax]; 
          $oke2=mysql_query("SELECT * FROM tour_msproduct 
                            WHERE SeatSisa >= '$totalpax'
                            and Status = 'PUBLISH'
                            and StatusProduct = 'OPEN'
                            and DateTravelFrom >= '$hariini'                                        
                            ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC");
          echo"
          <h2>Manage Room List $r[TourCode]</h2>
          <form name='example' method='POST'  action='./aksi.php?module=roominglist&act=manage' > 
          ";
          $tourcode=$r[TourCode]; 
          $edit=mysql_query("SELECT * FROM tour_msbookingdetail                                                 
                    WHERE TourCode ='$tourcode'  
                    AND Status <> 'CANCEL'
                    order by RoomNo,BookingID ASC,IDDetail ASC");
         $jumlah=mysql_num_rows($edit);    
            if ($jumlah > 0) {
            echo "   <input type='hidden' name='jumlah' value='$jumlah'><input type=hidden name='tur' value='$tourcode'>  
                    <table>
                    <tr><th>NO</th><th>booking id</th><th>passanger's name</th><th >room type</th><th>room no</th><th>remarks</th><th>contact no</th></tr>"; 
                        
                    $no=1;
                    while ($data=mysql_fetch_array($edit)){                         
                        $dtable=mysql_query("SELECT * FROM tour_msbooking                                                 
                                                WHERE BookingID ='$data[BookingID]' and RoomNo='$data[RoomNo]'
                                                order by IDBookers ASC");        
                        $itable=mysql_fetch_array($dtable);
                        if($data[PaxName]==''){$pax='TBA';}else{$pax=$data[PaxName];}
               echo "<tr><td>$no</td>
                        <td>$data[BookingID]<input type='hidden' name='bookid$no' value='$data[IDDetail]'></td>
                        <td>$data[Title] $pax</td>
                        <td>$data[RoomType]</td>
                        <td><input type='text' name='roomno$no' value='$data[RoomNo]' size='3'></td>
                        <td>$data[Deviasi]</td>
                        <td>$itable[BookersMobile]</td>
                         
                     </tr> ";
                      $no++;
                    }echo"
                    <tr><td colspan='7'><center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick=location.href='?module=group'></td></tr>
                    </table>
          </form>";
                   }     
        echo "<br><br>";
     break;    
                
}
?>
