<script language="javascript" type="text/javascript">
    function updatepage(ID)
    {   window.open(ID);                                                                    
        window.close();   
    }
    function quotpage(ID)
    {   window.opener.location.href='../admin/media.php?module=msproduct&act=showquotation&id='+ID                                                                    
        window.close();   
    }
    function discpage(ID)
    {   window.opener.location.href='../admin/media.php?module=group&act=editgroup&id='+ID                                                                    
        window.close();   
    }
    function flightpage(ID)
    {   window.opener.location.href='../admin/media.php?module=msproduct&act=prodflight&id='+ID                                                                    
        window.close();   
    }
    function roompage(ID)
    {   window.opener.location.href='../admin/media.php?module=rptroominglist&act=editroom&id='+ID                                                                    
        window.close();   
    }
    function finpage(ID)
    {   window.opener.location.href='../admin/media.php?module=upfinal&id='+ID
        window.close();
    }
    function finquotpage(ID)
    {   window.opener.location.href='../admin/media.php?module=msproduct&act=finalquotation&id='+ID
        window.close();
    }
</script>    
 <SCRIPT LANGUAGE="JavaScript" SRC="../config/CalendarPopup.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
    var cal = new CalendarPopup();
cal.showYearNavigation();
cal.showYearNavigationInput(); 
</SCRIPT>
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript">           
     setTimeout(window.close, 10000);     
</script>
<?php 
include "../config/koneksi.php"; 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));  
switch($_GET[act]){
  // Tampil Office         
  default:
    $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                WHERE IDProduct = '$_GET[code]'");  
    $data=mysql_fetch_array($tampil);
    $edit1=mysql_query("SELECT * FROM tour_msbooking WHERE TourCode ='$data[TourCode]' and Status = 'ACTIVE' ");  
    $r2=mysql_num_rows($edit1);
    if($r2 > 0){$editan="editmsproductapp";}else{$editan="editmsproduct";}
    if($data[Status]=='NOT PUBLISHED'){$qv='enabled';}else if($data[Status]=='PUBLISH'){$qv='disabled';}                
    if($data[StatusProduct]=='FINALIZE'){$rum='enabled';}else{$rum='disabled';}
    if($data[QuotationStatus]=='APPROVE' OR $data[QuotationStatus]=='LOCK'){$fin='enabled';}else{$fin='disabled';}
    echo "  <center><table style='border: 0px solid #000000;'>
            <tr><th>$data[TourCode]</th><tr>
            <tr><td style='border: 0px solid #000000;'><center><input type=button value='QUOTATION' onclick=quotpage('$data[IDProduct]') ></td></tr>
            <tr><td style='border: 0px solid #000000;'><center><input type=button value='FINAL QUOTATION' onclick=finquotpage('$data[IDProduct]') $fin></td></tr>
            <tr><td style='border: 0px solid #000000;'><center><input type=button value='DISCOUNT & PROMO' onclick=discpage('$data[IDProduct]')></td></tr>
            <tr><td style='border: 0px solid #000000;'><center><input type=button value='FLIGHT SCHEDULE' onclick=flightpage('$data[IDProduct]')></td></tr>
            <tr><td style='border: 0px solid #000000;'><center><input type=button value='ROOM MANAGE' onclick=roompage('$data[IDProduct]') $rum></td></tr>
            <tr><td style='border: 0px solid #000000;'><center><input type=button value='FINAL DOCUMENT' onclick=finpage('$data[IDProduct]')></td></tr>
            </table>
          </form>";
     break;           
}
?>
