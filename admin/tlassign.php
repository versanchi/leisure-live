 <script language="javascript" type="text/javascript">
    function updatepage()
    {
        window.close();
        window.opener.location.reload();                         
    }
setTimeout(window.close, 30000);  
</script>     
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" /> 
<?php 
include "../config/koneksi.php"; 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$username=$_SESSION[employee_code];
$sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_code='$username'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName=$tampiluser[employee_name];
$today = date("Y-m-d G:i:s");  
switch($_GET[act]){
  // Tampil Office
  default:
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[code]'");
    $r=mysql_fetch_array($edit);         
         
    $batas= date('Y-m-d',strtotime('-1 second',strtotime('+6 month',strtotime(date($bulan).'/'.date($tanggal).'/'.date($tahun).' 00:00:00')))); 
    echo "<h2>ASSIGN TL : $r[TourCode]</h2>    
          <form method=POST name='info' onsubmit='return validateFormOnSubmit(this)' action='?module=tlassign&act=save'>
          <input type='hidden' name=id value='$r[IDProduct]'>   
            <center><table>
            <tr><td>Tour Leader</td><td><select name='tourleader'";if($r[TourLeaderInc]=='NO'){echo"disabled";}echo" ><option value='' selected>- Select TL -</option>";
            $tampil=mysql_query("(SELECT TourleaderName as TLNAME FROM tour_mstourleader where TourleaderStatus = 'ACTIVE' ORDER BY TourleaderName ASC) 
                                UNION
                                (SELECT employee_name as TLNAME FROM tbl_msemployee where employee_tl = 'on' ORDER BY employee_name ASC)order by TLNAME ASC");
            while($s=mysql_fetch_array($tampil)){    
                if($r[TourLeader]==$s[TLNAME]){
                    echo "<option value='$s[TLNAME]' selected>$s[TLNAME]</option>";
                }else {     
                    echo "<option value='$s[TLNAME]'>$s[TLNAME]</option>";
                }   
            }
    echo "</select></td></tr>       
            </table>     
          <center><input type='submit' name='submit' value='Save' > 
          </form>";
     break;  
  
case "save":    
    $edit1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_POST[id]'");
    $r2=mysql_fetch_array($edit1);
    $bulan=substr($r2[DateTravelFrom],5,2); 
    $year=substr($r2[DateTravelFrom],0,4);
    $updet=mysql_query("UPDATE tour_msproduct set TourLeader = '$_POST[tourleader]'
                                                        WHERE IDProduct = '$r2[IDProduct]'");
    $Description="ASSIGN TL FOR ($r2[TourCode])";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");    
   
  ?>
  <script language='javascript' type='text/javascript'>
    updatepage();
   
</script> <?php 
}
?>
