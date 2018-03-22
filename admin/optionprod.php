<script language="javascript" type="text/javascript">
    function updatepage(ID)
    {   window.open(ID);                                                                    
        window.close();   
    }
    function quotpage(ID)
    {   window.opener.location.href='../admin/media.php?module=msproduct&act=quotation&id='+ID                                                                    
        window.close();   
    }
    function showquotpage(ID)
    {   window.opener.location.href='../admin/media.php?module=msproduct&act=showquotation&id='+ID
        window.close();
    }
    function quotpagetmr(ID)
    {   window.opener.location.href='../admin/media.php?module=msproduct&act=quotation4tmr&id='+ID                                                                    
        window.close();   
    }
    function itinpage(ID)
    {   window.opener.location.href='../admin/media.php?module=msitin&nama='+ID                                                                    
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
    function editpage(ID,ED)
    {   window.opener.location.href='../admin/media.php?module=msproduct&act='+ED+'&id='+ID                                                                    
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
    $edit1=mysql_query("SELECT * FROM tour_msbooking WHERE IDTourcode ='$data[IDProduct]' and Status = 'ACTIVE' ");
    $r2=mysql_num_rows($edit1);
    if($r2 > 0){$editan="editmsproductapp";}else{$editan="editmsproduct";}
    if($data[Status]=='NOT PUBLISHED'){$qv='enabled';}else if($data[Status]=='PUBLISH'){$qv='disabled';}                
    echo "  <center><table style='border: 0px solid #000000;'>
            <tr><th>$data[TourCode]</th><tr>
            <tr><td style='border: 0px solid #000000;'><center><input type=button value='EDIT PRODUCT' onclick=editpage('$data[IDProduct]','$editan')></td></tr>
            <tr><td style='border: 0px solid #000000;'><center><input type=button value='FLIGHT SCHEDULE' onclick=flightpage('$data[IDProduct]')></td></tr>";
            if($data[ProductCode]=='TMR'){echo"
            <tr><td style='border: 0px solid #000000;'><center><input type=button value='QUOTATION' onclick=quotpagetmr('$data[IDProduct]') $qv></td></tr>";
            }else{
                if($data[QuotationStatus]=='DRAFT' OR $data[QuotationStatus]=='EDIT' OR $data[QuotationStatus]=='REQUEST'){
                    echo"<tr><td style='border: 0px solid #000000;'><center><input type=button value='QUOTATION' onclick=quotpage('$data[IDProduct]') ></td></tr>";
                }else{
                    echo"<tr><td style='border: 0px solid #000000;'><center><input type=button value='QUOTATION' onclick=showquotpage('$data[IDProduct]')></td></tr>";
                }
            }echo"
            <tr><td style='border: 0px solid #000000;'><center><input type=button value='ATTACHMENT' onclick=itinpage('$data[IDProduct]')></td></tr>
            <tr><td style='border: 0px solid #000000;'><center><input type=button value='DISCOUNT & PROMO' onclick=discpage('$data[IDProduct]')></td></tr>
            </table>                                               
          </form>";
     break;           
}
?>
