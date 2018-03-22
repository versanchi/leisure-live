 <script language="javascript" type="text/javascript">
    function updatepage()
    {
        window.close();                                  
    }
 
</script>
<script type="text/javascript">          
 setTimeout(window.close, 10000); 
</script>     
 <SCRIPT LANGUAGE="JavaScript" SRC="../config/CalendarPopup.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
    var cal = new CalendarPopup();
cal.showYearNavigation();
cal.showYearNavigationInput(); 
</SCRIPT>
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" /> 
<?php 
include "../config/koneksi.php"; 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));  
switch($_GET[act]){
  // Tampil Office
  default:
    $edit=mysql_query("SELECT * FROM tour_msbookingdetail WHERE IDDetail = '$_GET[id]'");
    $r=mysql_fetch_array($edit);                       
    $ceking = mysql_query("SELECT DateTravelFrom FROM tour_msproduct where TourCode = '$r[TourCode]'");
    $tgl=mysql_fetch_array($ceking);
    $target=$tgl[DateTravelFrom];
    $tanggal = substr($target,8,2);
    $bulan = substr($target,5,2);
    $tahun = substr($target,0,4);             
    $batas= date('Y-m-d',strtotime('-1 second',strtotime('+6 month',strtotime(date($bulan).'/'.date($tanggal).'/'.date($tahun).' 00:00:00')))); 
    echo "<h2>ADDITIONAL INFORMATION</h2>    
          <form method=POST name='info' onsubmit='return validateFormOnSubmit(this)' action='?module=infodetail&act=save'>
          <input type='hidden' name=id value='$_GET[id]'>   
            <center><table><input type='hidden' name='batas' value='$batas'>
            <tr><th colspan=2>PERSONAL INFO</th></tr>
            <tr><td>Birth Place</td><td>$r[BirthPlace]</td></tr>
            <tr><td>Birth Date</td><td>$r[BirthDate] <font color='red'>(yyyy-mm-dd)</font> </td></tr>
            <tr><td>Passport Number</td><td>$r[PassportNo]</td></tr>
            <tr><td>Passport Issued Place</td><td>$r[PassportIssued]</td></tr>
            <tr><td>Passport Issued Date</td><td>$r[PassportIssuedDate] <font color='red'>(yyyy-mm-dd)</font></td></tr>
            <tr><td>Passport Exp Date</td><td>$r[PassportValid] <font color='red'>(yyyy-mm-dd)</font></td></tr>
            <tr><th colspan=2></th></tr>
            <tr><td>Invoice No</td><td><input type=text name='invoiceno' value='$r[DevInvoice]'></td></tr>
            <tr><td>Invoice Amount</td><td><input type=text name='invoiceamount' value='$r[DevAmount]'></td></tr>
            <tr><td>Note For Operation</td><td><textarea name='deviasi' cols='40' rows='3'>$r[Deviasi]</textarea> </td></tr>
            <tr><td>Note For Doc</td><td><input type='text' size='45' name='note4doc' value='$r[Note4Doc]'> </td></tr>
            </table>     
          <center><input type='button' name='button' value='Close' onclick=updatepage()> 
          </form>";
     break;        
}
?>
