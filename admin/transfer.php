<SCRIPT LANGUAGE="JavaScript" SRC="../config/CalendarPopup.js"></SCRIPT>               
<script type="text/javascript" src="../config/jquery.js"></script>            
<script type="text/javascript" src="../head/jquery-1.3.2.min.js"></script>         
<SCRIPT LANGUAGE="JavaScript">
    var cal = new CalendarPopup(); 
</SCRIPT>
 <script language="javascript" type="text/javascript">
    function updatepage()
    {
        window.close();
        window.opener.location.reload();
    }
    setTimeout(window.close, 10000);
 </script>
                 
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" /> 
<?php 
include "../config/koneksi.php";
include "../config/koneksimaster.php";
$username=$_GET[usr];
$sqluser=mssql_query("SELECT EmployeeName FROM Employee WHERE EmployeeID='$username'");
$tampiluser=mssql_fetch_array($sqluser);
$EmpName=$tampiluser[EmployeeName];
$today = date("Y-m-d G:i:s");    
switch($_GET[act]){
  // Tampil Office
  default:
    $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");
    $r=mysql_fetch_array($edit);
    $depdate = substr($r[DateTravelFrom],8,2);         
    echo "<form method=POST name='example' action='transfer.php?act=save'>
          <input type='hidden' name='tcold' value='$r[TCEmpID]'><input type='hidden' name='id' value='$r[BookingID]'>
          <input type='hidden' name='tcdiv' value='$r[TCDivision]'>";
            echo "<center><font color=blue><b>TRANSFER BOOKING TO: </b></font><br>
          <select name='tcnew' required><option value='' selected>- Select TC -</option>";
                $tampil = mssql_query("SELECT * FROM [HRM].[dbo].[Employee]
                                WHERE DivisiID = '$r[TCDivision]'
                                AND EmployeeID <> '$r[TCEmpID]'
                                AND Active = 1
                                AND JobLevel < 30
                                order by EmployeeName ASC ");
                while ($s = mssql_fetch_array($tampil)) {
                        echo "<option value='$s[EmployeeID]'>$s[EmployeeName]</option>";
                }
                echo "</select><br><br>
          <input type='submit' name='submits' value='UPDATE' >
          </form>";
     break;  
  
  case "save":
  $TourCode=strtoupper($_POST[newtourcode]);                        
  $Description="Transfer TC BookingID '$_POST[id]' from '$_POST[tcold]' to '$_POST[tcnew]'";
  $kuery = mssql_query("SELECT * FROM Employee where EmployeeID = '$_POST[tcnew]'");
  $dapet = mssql_fetch_array($kuery);
  mysql_query("UPDATE tour_msbooking set TCName = '$dapet[EmployeeName]',
                                        TCNameAlias = '$dapet[EmployeeName]',
                                        TCEmpID = '$dapet[EmployeeID]'
                                        WHERE BookingID = '$_POST[id]'");
  mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                               Description,
                               LogTime)
                        VALUES ('$EmpName',
                               '$Description',
                               '$today')");
  ?>
  <script language='javascript' type='text/javascript'>
    updatepage();
   
</script>  <?php 
}
?>
