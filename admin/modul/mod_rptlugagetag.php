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
      $list=$_GET['list'];
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
            
    echo "<h2>Luggage Tag</h2>
          <form method='GET' action='printdata.php' target='_blank'>
                <input type=hidden name=module value='rptlugagetag'>   
              Tour Code 
              <select name='nama' required><option value=''>- Select TourCode -</option>"; 
              $option = mysql_query("SELECT tour_msproduct.IDProduct,tour_msproduct.TourCode FROM tour_msbooking 
                                    left join tour_msproduct on tour_msproduct.TourCode = tour_msbooking.TourCode
                                    WHERE tour_msproduct.DateTravelFrom >= '$hariini'
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
    echo "</select> Copies <select name='ulang'>
          <option value='1'>1</option>
          <option value='2'>2</option>
          <option value='3'>3</option>
          <option value='4'>4</option></select> <input type=submit name='namelist' value='Show'> 
          </form>";
          
     break;
                
}
?>
