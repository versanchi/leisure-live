<script language="javascript" type="text/javascript">
    function updatepage(ID)
    {   window.open(ID);                                                                    
        window.close();   
    }
    function refpage(ID)
    {   window.opener.location.href='../admin/media.php?module=msbooking&act=deviasireq&id='+ID                                                                    
        window.close();   
    }
    function PopupCenter(pageURL, ID,w,h)
    {
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);

    }
    function finpage(ID)
    {   window.opener.location.href='../admin/media.php?module=upfinal&act=view&id='+ID
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
    $hari = date("Y-m-d", time());
    $edit=mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_GET[code]' ORDER BY IDDetail ASC limit 1");
    $r=mysql_fetch_array($edit);                       
    $cari=mysql_query("SELECT * FROM tour_msbooking WHERE FBTNo <> '' and BookingID = '$r[BookingID]'");
    $ada=mysql_num_rows($cari);
    $adaisinya=mysql_fetch_array($cari);

    $cari1=mysql_query("SELECT * FROM tour_msbooking WHERE TBFNo <> '' and BookingID = '$r[BookingID]'");
    $ada1=mysql_num_rows($cari1);
    $adaisinya1=mysql_fetch_array($cari1);
    $notbf=substr($adaisinya1[TBFNo],0,13);
    $caritbf=mysql_query("SELECT * FROM tour_tbfbooking WHERE TBFNo = '$notbf'");  
    $stattbf=mysql_fetch_array($caritbf);

    $qdev=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$adaisinya[IDTourcode]' and Year= '$adaisinya[Year]'");
    $querydev=mysql_fetch_array($qdev);
    $qflight=mysql_query("SELECT * FROM tour_devbooking WHERE BookingID = '$r[BookingID]' and Status ='REQUEST'");
    $rowflight=mysql_num_rows($qflight);
    if($ada==0 AND $querydev[StatusProduct]<>'FINALIZE'){$ling="../admin/fbt.php?code=".$_GET[code];}else{$ling="../admin/fbt.php?act=showfbt&FBT=$adaisinya[FBTNo]";}
    if($ada1==0 or $stattbf[Status]=='REVISE'){$ling1="../admin/tbf.php?code=$_GET[code]&stat=$stattbf[Status]";}else{$ling1="../admin/tbf.php?act=showtbf&TBF=$notbf";}
    if($ada < 1){$dev='disabled';}else{
        if($querydev[StatusProduct]=='FINALIZE'){$dev='disabled';}
        else{$dev='enabled';}
    }
    $ed=mysql_query("SELECT * FROM tour_msbooking
                            left join tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode
                            WHERE BookingID = '$_GET[code]'");
    $rit=mysql_fetch_array($ed);
    $editd=mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_GET[code]' AND Gender <> 'INFANT' ");
    $jd=mysql_num_rows($editd);
    $rd=mysql_fetch_array($editd);
    $totreq=$rit[ReqPromo];
    if($rit[FinalItin]<>'' OR $rit[FinalItin]<>'' OR $rit[FinalHalper]<>''){$f='enabled';}else{$f='disabled';}
    if($totreq==$jd OR $rit[DateTravelFrom] <= $hari OR $querydev[StatusProduct]=='FINALIZE'){$reqpromo='disabled';}else{$reqpromo='enabled';}
    //if($querydev[StatusProduct]=='FINALIZE'){$cant="disabled";}else{$cant="enabled";}
    /*<tr><td style='border: 0px solid #000000;'><center><input type=button value='Tour Reservation Form' onclick=updatepage('$ling') $cant></td></tr>
            <tr><td style='border: 0px solid #000000;'><center><input type=button value='Template Booking Form' onclick=updatepage('$ling1') $dev></td></tr>
    */
    echo "  <center><table style='border: 0px solid #000000;'>
            <tr><th>$r[BookingID]</th><tr>
            <tr><td style='border: 0px solid #000000;'><center><input type=button value='Tour Reservation Form' onclick=updatepage('$ling')></td></tr>
            <tr><td style='border: 0px solid #000000;'><center><input type=button value='Template Booking Form' onclick=updatepage('$ling1')></td></tr>
            <tr><td style='border: 0px solid #000000;'><center><input type=button value='Request Bonus' onclick=PopupCenter('voucher.php?id=$_GET[code]&user=$_GET[user]','variable',300,220) $reqpromo>
            <tr><td style='border: 0px solid #000000;'><center><input type=button value='Final Document' onclick=finpage('$rit[IDTourcode]') $f></td></tr>
            </table>";
     break;           
}
?>
