
<?php 

include "../config/koneksi.php";
include "../config/koneksisql.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/class_paging.php";     
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// Bagian Home
if ($_GET['module']=='home'){?>
    <script src="../config/jquery.cookie.js"></script>
    <link rel="stylesheet" href="../config/colorbox/example4/colorbox.css" />
    <script src="../config/jquery.colorbox.js"></script>
    <script>
    function createCookie() {
        $.cookie("pop", "on", { expires: 1, path: '/' });
    }
    function openColorBox(){
        if(!$.cookie("pop")){
            $.colorbox({iframe:true, width:"70%", height:"85%", href: "pop.php",overlayClose: false});
        createCookie();
        }
    }
    $(window).load(openColorBox())

    </script> <?PHP
  /*$mssql=mssql_query("SELECT TOP 10 * FROM Invoice");
  while($hasilmssql=mssql_fetch_array($mssql)){
  echo"tes: $hasilmssql[InvoiceID]<br>";           } */
  
  $sql=mysql_query("SELECT tbl_msoffice.office_key,tbl_msoffice.office_code,tbl_msoffice.office_bso,tbl_msemployee.employee_name FROM tbl_msemployee left join tbl_msoffice on tbl_msemployee.office_id = tbl_msoffice.office_id WHERE employee_code = '$_SESSION[employee_code]'");
  $hasil=mysql_fetch_array($sql);
  $employee = $hasil['employee_name'];
  $hour = date("G");
    if ($hour >= 0 && $hour <= 11) {
        $say="Good morning";
        } else {
            if ($hour >= 12 && $hour <= 17) {
                $say= "Good afternoon";
                } else {
                    if ($hour >= 18 && $hour <= 19) {
                        $say= "Good evening";
                        }else {
                            $say= "Good evening";
                   }
                }
        }
    
  echo "<h2>Welcome</h2> 
          <p>$say <b>$employee</b>, please click the menu at above to manage your website content.</p>";
  //$oke=$_GET['oke'];
  $hariini = date("Y-m-d ");
  $thnini = date("Y");     
  $blnini = date("m");
  $batas = date("Y-m-d",(mktime(date("H"), date("i"), date("s"), date("m"), date("d")+14, date("Y"))));
  $montText = strtoupper(date("M"));  
  
  //pendingan TBF
if($hasil[office_bso]=='YES'){

  $TBFPending=mysql_query("select TCNameAlias,TCEmpID,TCDivision,count(bookingID) as Booking from tour_msbooking
                            where BookingStatus='DEPOSIT' 
                            AND Status='ACTIVE' 
                            and (AdultPax+ChildPax+InfantPax)>0 
                            and TBFNo ='' 
                            and IDTourcode in (select IDProduct from tour_msproduct where Status<>'VOID' and DateTravelFrom < '$batas' and DateTravelFrom >'$hariini')  and TCDivision='$hasil[office_code]' 
                            group by TCNameAlias order by Booking DESC,TCNameAlias ASC");

 $jumrPendingan=mysql_num_rows($TBFPending);    

  if (('$hasil[office_code]'!='LTM') and ( $jumrPendingan>0)){
	  		
			   echo "<center><table style='border: 0px solid #000000;'>
				 <tr><td style='border: 0px solid #000000;' colspan='2' ><center><font size=3; color='red';><b>PLEASE SEND YOUR TBF</td><tr>
				 <tr><th><b>TC Name</th><th><b>Total Booking</th></tr>";
				 
				  while($DTBFPending=mysql_fetch_array($TBFPending)){
						if($employee==$DTBFPending[TCNameAlias]){$c="BGCOLOR='red'";$b="<b>";}else{$c="BGCOLOR='#fff'";$b="";}
                        $namealias=str_replace(" ", "+", $DTBFPending[TCNameAlias]);
                         echo"<tr $c>        
						 <td $c>$b$DTBFPending[TCNameAlias]</td>
						 <td $c>$b<center><a href=?module=msbooking&Div=$DTBFPending[TCDivision]&act=showTBF&TC=$namealias>$DTBFPending[Booking]
						 </a></td>
						 </tr>";
			   	  }
			   echo"</table>";		   
        }
	 
  }   
  $satu=mysql_query("SELECT Season,Year FROM tour_msproduct   
                                WHERE Status = 'PUBLISH'
                                and DateTravelFrom > '$hariini'
                                and Year >= '$thnini' 
                                ORDER BY DateTravelFrom ASC LIMIT 1");
  $satu1=mysql_fetch_array($satu);
  
                                                                                                                                                       //TC OF THE YEAR 
  $TopTC=mysql_query("SELECT TCName,TCDivision,sum(AdultPax+ChildPax) as Total  FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.IDProduct=tour_msbooking.IDTourcode) where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and year(DateTravelFrom)=$thnini and tour_msproduct.TourCode<>'' and Seat<>SeatSisa AND TCDivision <>'LTM'
                                AND TCDivision <>'LTM-SA' AND tour_msbooking.TCDivision <>'LTM TMR'  group by TCName,TCDivision order by Total desc limit 3");
      
  echo"<center><table><tr style='border-bottom: 0px solid #000000;'><td style='border-bottom: 0px solid #ffffff;' BGCOLOR='red'><center><b>CONGRATULATIONS FOR BEST SELLER OF THE YEAR</b>";
  				   $v=1;
                   while($DTopTC=mysql_fetch_array($TopTC)){ 
                   if($v==1){$h="<font size=3><center><b>$DTopTC[TCName] ($DTopTC[TCDivision])</b><br><center> $DTopTC[Total] Pax";}else{$h="<font size=1><center>$DTopTC[TCName] ($DTopTC[TCDivision]) $DTopTC[Total] Pax<center>";}
                   echo"<tr><td>$h</td></tr>";
                   $v++;
                   }echo"
                   </table>";
        
  
  //menampilan target jika termasuk divisi bso
  if($hasil[office_bso]=='YES'){
  //$Booking=mysql_query("SELECT TCDivision,TaxInsSell, sum(AdultPax+ChildPax) as Total,sum(TotalPrice) as Harga,sum((AdultPax+ChildPax)*TaxInsSell) as hargatax FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode) where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and TCDivision<>'' and month(DateTravelFrom)='$blnini' and tour_msproduct.Year='$thnini' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision ='$hasil[office_code]' group by TCDivision order by Total desc");
  $Booking=mysql_query("SELECT TCDivision,TaxInsSell, (sum(AdultPax) + sum(ChildPax)) as Total,sum(TotalPrice) as Harga,sum((AdultPax+ChildPax)*TaxInsSell) as hargatax FROM tour_msbooking
                        inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
                        where tour_msproduct.Status <> 'VOID' 
                        and tour_msbooking.status='ACTIVE' 
                        and BookingStatus='DEPOSIT' 
                        and month(DepositDate)='$blnini' 
                        and year(DepositDate)='$thnini' 
                        and tour_msproduct.Year >='$satu1[Year]'
                        and tour_msproduct.TourCode<>'' 
                        and Seat<>SeatSisa 
                        and TCDivision ='$hasil[office_code]' 
                        group by TCDivision order by Total desc");
  while($DBooking=mysql_fetch_array($Booking)){
  if($DBooking[TCDivision]!='LTM'){
        $Target=mysql_query("SELECT $montText from tour_mstarget where TargetBSO='$hasil[office_code]' and TargetYear='$thnini'");
        $DTarget=mysql_fetch_array($Target);
        $montangka=$montText.A;
        $inrate=mysql_query("SELECT $montText from tour_rate where RateYear='$thnini' and ");
        $ret=mysql_fetch_array($inrate);
        $persen=$ret[$montText];
        $hargapajak=$DBooking[Harga]+$DBooking[hargatax];
        $Harga=$hargapajak*$persen;
        $TampilTotal=number_format($DBooking[Total], 0, ',', '.');
        //$TampilTotal=200;
         if(($DBooking[Total]/$DTarget[$montText]>=1)or($DTarget[$montText]==0) or 
         ($Harga/$DTarget[$montangka]>=1) or($DTarget[$montangka]==0)){$warna="BGCOLOR='grey'";}else {$warna="BGCOLOR='#ffffff'";}
        echo "<center><table>
             <tr><td colspan=2><center><font size=1><b>REPORT PAX OF THE MONTH </td><tr>
             <tr>        
             <td $warna width=250><font size=5><b>";
             if($DTarget[$montText]==''){echo"<center>0";}else{echo"<center> TARGET: $DTarget[$montText] ";}
             if($DTarget[$montangka]==''){$TargetAngka=0;}else{$TargetAngka=$DTarget[$montangka];};
             echo"</td>
             <td $warna width=250><font size=5><b>";
             $tgt=$DTarget[$montText] / 2;
             if($TampilTotal <= $tgt){$fcol="red";}
             else if($TampilTotal > $tgt & $TampilTotal < $DTarget[$montText]){$fcol="#f600cb";}
             else if($TampilTotal > $DTarget[$montText] ){$fcol="blue";}    
             if($DBooking[Total]=='0'){echo"<center><font color='$fcol'>REAL: $TampilTotal </font>"; $AchievePax=0;}else{echo"<center><font color='$fcol'>REAL: $TampilTotal </font>"; 
           if($DTarget[$montText]==0){$AchievePax=100;}else{$AchievePax=round(($TampilTotal/$DTarget[$montText]*100),0);};}
             echo "</td>  ";
             echo "</tr></table>";
            }
        }
		
  }
    $Booking=mysql_query("SELECT TCName,TCDivision,sum(AdultPax+ChildPax) as Total,".$QueryDest." ,
    sum(if(tour_msproduct.SellingCurr='USD',
    (TotalPrice+((AdultPax+ChildPax)*TaxInsSell))*$rate[$montText],
    (TotalPrice+((AdultPax+ChildPax)*TaxInsSell)))) as Harga
		FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.IDProduct=tour_msbooking.IDTourcode) inner join (select ProductCodeName,ProductCode as ProductName from tour_msproductcode) product on product.ProductcodeName=tour_msproduct.ProductCode
		where tour_msproduct.Status <> 'VOID'
		and tour_msbooking.status='ACTIVE'
		and BookingStatus='DEPOSIT'
		and TCDivision<>''
		and month(DateTravelFrom)=$mont
		and year(DateTravelFrom)=$yer
		and tour_msproduct.TourCode<>''
		and Seat<>SeatSisa
		and TCDivision<>'LTM'
		group by TCName,TCDivision order by Harga desc limit $Rank");

    $tampil1=mysql_query("SELECT TCName,TCDivision,sum(AdultPax)as apax,sum(ChildPax)as cpax,(sum(AdultPax) + sum(ChildPax))as totalpax FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE month(DepositDate) ='$blnini'
                                AND year(DepositDate)='$thnini'
                                AND tour_msproduct.Year >='$satu1[Year]'
                                AND tour_msbooking.Status ='ACTIVE'
                                and tour_msbooking.BookingStatus='DEPOSIT'       
                                and tour_msproduct.Status <> 'VOID'
                                AND tour_msbooking.TCDivision <>'LTM'
                                AND tour_msbooking.TCDivision <>'LTM-SA'
								AND tour_msbooking.TCDivision <>'LTM TMR'  
                                GROUP BY TCName order by totalpax DESC,TCName ASC limit 10 ");
      $jumr2=mysql_num_rows($tampil1);
      if($jumr2>0){
      echo"<center>
      <table style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'>
      <font size=2><i><b>TOP 10 Best Seller TC of the month </b><font color='blue' size='1'> (based on deposit date)</font></i></font>
      <table><tr><th>no</th><th width='250'>TC Name</th><th>Total PAX</th></tr>";
      $no=1;            
      while($r2=mysql_fetch_array($tampil1)){
        $riloff=mysql_query("SELECT tbl_msemployee.employee_name,tbl_msoffice.office_code FROM tbl_msemployee   
                                left join tbl_msoffice on tbl_msoffice.office_id = tbl_msemployee.office_id
                                WHERE tbl_msemployee.employee_name ='$r2[TCName]' AND tbl_msemployee.active = '1' ");
        $ro=mysql_fetch_array($riloff);
        if($employee==$r2[TCName]){$c="BGCOLOR='#ea7c1f'";}else{$c="BGCOLOR='#fff'";}
        echo "<tr $c><td>$no</td>
             <td $c><center>$ro[employee_name] ($ro[office_code])</td>   
             <td $c><center>$r2[totalpax]</td>
             </tr>";
      $no++;
                                                       
    }
    echo"</table></td><td style='border: 0px solid #000000;'>";
    $tampil2=mysql_query("SELECT TCDivision,sum(AdultPax)as apax,sum(ChildPax)as cpax,(sum(AdultPax) + sum(ChildPax))as totalpax FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                WHERE month(DepositDate) ='$blnini'
                                AND year(DepositDate)='$thnini'
                                AND tour_msproduct.Year >='$satu1[Year]'
                                and BookingStatus='DEPOSIT' 
                                AND tour_msbooking.Status ='ACTIVE'       
                                and tour_msproduct.Status <> 'VOID'
                                AND tour_msbooking.TCDivision <>'LTM'
                                AND tour_msbooking.TCDivision <>'LTM-SA'
								AND tour_msbooking.TCDivision <>'LTM TMR' 
                                GROUP BY TCDivision order by totalpax DESC,TCName ASC limit 10 ");
      echo"<font size=2><i><b>TOP 10 Best Seller Division of the month</b><font color='blue' size='1'> (based on deposit date)</font></i></font>
      <table><tr><th>no</th><th width='250'>Division</th><th>TOTAL PAX</th></tr>";
      $n=1;           
      while($r=mysql_fetch_array($tampil2)){ 
        echo "<tr><td>$n</td>
             <td><center>$r[TCDivision]</td>   
             <td><center>$r[totalpax]</td>
             </tr>";
      $n++;
                                                       
    }
    
    echo "</table></td></table>";
    }
     $tampil=mysql_query("SELECT * FROM tour_marketing WHERE DateTo >= '$hariini' and Status ='FIX' ORDER BY DateFrom ASC ");
  $ada=mysql_num_rows($tampil);  
  echo "<font size='2' color='red'><i>Exhibition Information</i></font>";  
       if($ada==0){echo"<br><font size='2' color='red'>*No New Exhibition Event</font>";}else{
  echo"<table>
          <tr><th>no</th><th>exhibition</th><th>date</th><th>location</th><th>Deposit</th></tr>"; 
    $no=1;
              while ($r=mysql_fetch_array($tampil)){
        $d = mysql_query("SELECT count(tour_msbooking.BookingID)as deppameran,sum(tour_msbooking.AdultPax)as totadult,sum(tour_msbooking.ChildPax)as totchild,sum(tour_msbooking.InfantPax)as totinf FROM tour_msbooking 
                                    left join tour_marketing on tour_msbooking.BookingPlace = tour_marketing.MarketingID 
                                    WHERE tour_msbooking.BookingPlace = '$r[MarketingID]' and tour_msbooking.Status='ACTIVE'");
        $dd = mysql_fetch_array($d);
        $dari = date("d M Y", strtotime($r['DateFrom']));
        $sampai = date("d M Y", strtotime($r['DateTo']));
        echo "<tr><td>$no</td>";
             if($dd['deppameran']=='0'){
                 echo"<td>$r[Event]</td>";
             }else {
                 echo"<td><a href=?module=msbookingdetail&act=showexhibition&id=$r[MarketingID]>$r[Event]</a></td>";
             }   
        echo"<td>$dari - $sampai</td>
             <td>$r[Place]</td>
             <td><center>$dd[deppameran]</td>  
             </tr>";
      $no++;
    }echo"</table>";
    } echo"
    </center>";
    //tes visitor counter
    $dataFile = "visitors.txt";

$sessionTime = 30; //this is the time in **minutes** to consider someone online before removing them from our file

//Please do not edit bellow this line

error_reporting(E_ERROR | E_PARSE);

if(!file_exists($dataFile)) {
    $fp = fopen($dataFile, "w+");
    fclose($fp);
}

$ip = $_SERVER['REMOTE_ADDR'];
$users = array();
$onusers = array();

//getting
$fp = fopen($dataFile, "r");
flock($fp, LOCK_SH);
while(!feof($fp)) {
    $users[] = rtrim(fgets($fp, 32));
}
flock($fp, LOCK_UN);
fclose($fp);


//cleaning
$x = 0;
$alreadyIn = FALSE;
foreach($users as $key => $data) {
    list( , $lastvisit) = explode("|", $data);
    if(time() - $lastvisit >= $sessionTime * 60) {
        $users[$x] = "";
    } else {
        if(strpos($data, $ip) !== FALSE) {
            $alreadyIn = TRUE;
            $users[$x] = "$ip|" . time(); //updating
        }
    }
    $x++;
}

if($alreadyIn == FALSE) {
    $users[] = "$ip|" . time();
}

//writing
$fp = fopen($dataFile, "w+");
flock($fp, LOCK_EX);
$i = 0;
foreach($users as $single) {
    if($single != "") {
        fwrite($fp, $single . "\r\n");
        $i++;
    }
}
flock($fp, LOCK_UN);
fclose($fp);

if($uo_keepquiet != TRUE) {
    echo '<div style="padding:5px; margin:auto; background-color:#fff"><b>' . $i . ' branch connected</b></div>';
}
  //+++++++++++++++++++++++++++++  
  echo "<p align=right>Login Today: ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");  
  echo "</p>";
}


// Bagian Master Country
elseif ($_GET['module']=='mscountry'){
  include "modul/mod_mscountry.php";
}
// Bagian tester
elseif ($_GET['module']=='tester'){
  include "modul/mod_tester.php";
}                                        
// Bagian View Log
elseif ($_GET['module']=='log'){
  include "modul/mod_log.php";
}
// Bagian Product Best TC
elseif ($_GET['module']=='bestsbo'){
  include "modul/mod_bestsbo.php";
}
// Bagian MS Division
elseif ($_GET['module']=='msdivision'){
  include "modul/mod_msdivision.php";
}
// Bagian MS Exibition
elseif ($_GET['module']=='dtpameran'){
  include "modul/mod_dtpameran.php";
}  
// Bagian MS Iklan
elseif ($_GET['module']=='dtiklan'){
  include "modul/mod_dtiklan.php";
}  
// Bagian News Update
elseif ($_GET['module']=='information'){
  include "modul/mod_information.php";
}  
// Bagian MS Employee
elseif ($_GET['module']=='msemployee'){
  include "modul/mod_msemployee.php";
}
// Bagian MS Employee Doc
elseif ($_GET['module']=='msemployee1'){
  include "modul/mod_msemployee1.php";
} 
// Bagian Change profile
elseif ($_GET['module']=='profile'){
  include "modul/profile.php";
}
// Bagian Change password
elseif ($_GET['module']=='mspassword'){
    include "modul/mod_mspassword.php";
}
// Bagian MS Destination
elseif ($_GET['module']=='msdestination'){
  include "modul/mod_msdestination.php";
}
// Bagian MS Department
elseif ($_GET['module']=='msoffice'){
  include "modul/mod_msoffice.php";
}
// Bagian MS Airlines
elseif ($_GET['module']=='msairlines'){
  include "modul/mod_msairlines.php";
}
// Bagian MS Group
elseif ($_GET['module']=='msgroup'){
  include "modul/mod_msgroup.php";
}
// Bagian MS Group List
elseif ($_GET['module']=='msgrouplist'){
  include "modul/mod_msgrouplist.php";
}
// Bagian MS TL
elseif ($_GET['module']=='mstourleader'){
  include "modul/mod_mstourleader.php";
}
// Bagian MS Supplier
elseif ($_GET['module']=='mssupplier'){
  include "modul/mod_mssupplier.php";
}
// Bagian MS Season
elseif ($_GET['module']=='msseason'){
  include "modul/mod_msseason.php";
}
// Bagian MS Tourcode
elseif ($_GET['module']=='msproductcode'){
  include "modul/mod_msproductcode.php";
}
// Bagian MS Product Type
elseif ($_GET['module']=='msproducttype'){
  include "modul/mod_msproducttype.php";
}
// Bagian MS Product
elseif ($_GET['module']=='msproduct'){    
    include "modul/mod_msproduct.php";
}
// Bagian MS Product T&C
elseif ($_GET['module']=='tandc'){    
    include "modul/mod_tandc.php";
}
// Bagian MS Product Flight
elseif ($_GET['module']=='msprodflight'){
  include "modul/mod_msprodflight.php";
}
// Bagian MS Voucher
elseif ($_GET['module']=='msvoucher'){
    include "modul/mod_msvoucher.php";
}
// Bagian Voucher Generate
elseif ($_GET['module']=='voucherex'){
    include "modul/mod_voucherex.php";
}
// Bagian Manage Group
elseif ($_GET['module']=='group'){
  include "modul/mod_group.php";
}
elseif ($_GET['module']=='groupsiscom'){
  include "modul/mod_groupsiscom.php";
}
// Bagian TL Assignment
elseif ($_GET['module']=='mstlassign'){
  include "modul/mod_mstlassign.php";
}
// Setup target POS
elseif ($_GET['module']=='mstarget'){
  include "modul/mod_mstarget.php";
}
// Setup target PW
elseif ($_GET['module']=='mstargetpw'){
  include "modul/mod_mstargetpw.php";
}
// Setup Visa Timeframe
elseif ($_GET['module']=='msvisagroup'){
  include "modul/mod_msvisagroup.php";
}
// Setup Itinerary
elseif ($_GET['module']=='msitin'){
  include "modul/mod_msitin.php";
}
// Setup Hotel
elseif ($_GET['module']=='mshotel'){
  include "modul/mod_mshotel.php";
}
// Setup Send Email
elseif ($_GET['module']=='sendemail'){
  include "emailform.php";
}
// Bagian DASHBOARD - Dailybooking
elseif ($_GET['module']=='dashdailybooking'){
  include "modul/mod_dashdailybooking.php";
}  
// Bagian DASHBOARD - Department
elseif ($_GET['module']=='dashdepartment'){
  include "modul/mod_dashdepartment.php";
} 
// Bagian DASHBOARD - Destiantion
elseif ($_GET['module']=='dashdestination'){
  include "modul/mod_dashdestination.php";
}
// Bagian DASHBOARD - Destiantion
elseif ($_GET['module']=='dashcustomer'){
  include "modul/mod_dashcustomer.php";
}                            
// Bagian TC
elseif ($_GET['module']=='rpttc'){
  include "modul/mod_rpttc.php";
}
// Bagian Tour Code
elseif ($_GET['module']=='rpttourcode'){
  include "modul/mod_rpttourcode.php";
}
// Report Airline
elseif ($_GET['module']=='rptairlines'){
  include "modul/mod_rptairlines.php";
}
// Report Airline pnr
elseif ($_GET['module']=='rptyearairlinesnew'){
    include "modul/mod_rptyearairlinesnew.php";
}
// Report sales division
elseif ($_GET['module']=='rptdivision'){
  include "modul/mod_rptdivision.php";
}
// Report Operation Today
elseif ($_GET['module']=='rpttoday'){
  include "modul/mod_rpttoday.php";
}
// Report Yearly Ailines
elseif ($_GET['module']=='rptyearairlines'){
  include "modul/mod_rptyearairlines.php";
}
// Report Yearly Destination
elseif ($_GET['module']=='rptyeardest'){
  include "modul/mod_rptyeardest.php";
}
// Report Yearly Department
elseif ($_GET['module']=='rptyeardept'){
  include "modul/mod_rptyeardept.php";
}
// Report Yearly POS
elseif ($_GET['module']=='rptyearpos'){
  include "modul/mod_rptyearpos.php";
}
// Bagian Name List
elseif ($_GET['module']=='rptnamelist'){
  include "modul/mod_rptnamelist.php";
}
// Bagian Passport List
elseif ($_GET['module']=='rptpassportlist'){
  include "modul/mod_rptpassportlist.php";
}
// Bagian Rooming List
elseif ($_GET['module']=='rptroominglist'){
  include "modul/mod_rptroominglist.php";
}
// Bagian Group Departure
elseif ($_GET['module']=='rptgrpdep'){
  include "modul/mod_rptgrpdep.php";
}
// Bagian Lugagge tag
elseif ($_GET['module']=='rptlugagetag'){
  include "modul/mod_rptlugagetag.php";
}
// Bagian Product
elseif ($_GET['module']=='rptbooking'){
  include "modul/mod_rptbooking.php";
}
// Bagian Report Realisasi
elseif ($_GET['module']=='rptrealisasi'){
  include "modul/mod_rptrealisasi.php";
}
// Bagian Report Questioner
elseif ($_GET['module']=='rptquestioner'){
  include "modul/mod_rptquestioner.php";
}
// Bagian Report Visa
elseif ($_GET['module']=='rptvisa'){
  include "modul/mod_rptvisa.php";
}
// Bagian Report daily
elseif ($_GET['module']=='dailyreport'){
  include "modul/dailyreport.php";
}
// Bagian Report daily
elseif ($_GET['module']=='dailysummary'){
  include "modul/dailysummary.php";
}
// Bagian Report daily
elseif ($_GET['module']=='pricelist'){
  include "modul/pricelist.php";
}
// Bagian Report GRV
elseif ($_GET['module']=='rptgrv'){
  include "modul/mod_rptgrv.php";
}
// Bagian Report GRV
elseif ($_GET['module']=='rpttl'){
  include "modul/mod_rpttl.php";
}
// Bagian Report Group Schedule
elseif ($_GET['module']=='rptgroupschdl'){
  include "modul/mod_rptgroupschdl.php";
}
// Bagian Booking Detail
elseif ($_GET['module']=='opbookingdetail'){
  include "modul/mod_opbookingdetail.php";
}
// Bagian Manage Sales | Booking
elseif ($_GET['module']=='msbooking'){
  include "modul/mod_msbooking.php";
}
// Bagian Manage Sales | Booking Detail
elseif ($_GET['module']=='msbookingdetail'){
  include "modul/mod_msbookingdetail.php";
}
// Bagian Manage Sales | Duplicate Booking
elseif ($_GET['module']=='duplicatebook'){
  include "modul/mod_duplicatebook.php";
}
// Bagian Manage Sales | Form Booking Tour
elseif ($_GET['module']=='formbookingtour'){
  include "modul/mod_formbookingtour.php";
}
// Bagian Manage Sales | GRV
elseif ($_GET['module']=='msgrv'){
  include "modul/mod_msgrv.php";
}
// Bagian Manage Sales | TMR Request
elseif ($_GET['module']=='mstmr'){
  include "modul/mod_mstmr.php";
}
// Bagian Manage Sales | Questioner
elseif ($_GET['module']=='questioner'){
  include "questioner.php";
}
// Bagian Search | Booking
elseif ($_GET['module']=='searchdata'){
  include "modul/mod_searchdata.php";
}
// Bagian Search | Product
elseif ($_GET['module']=='searchbooking'){
  include "modul/mod_searchbooking.php";
}
// Bagian Search | Pax Name
elseif ($_GET['module']=='searchpaxname'){
    include "modul/mod_searchpaxname.php";
}
// Bagian Report Sales | Division Group
elseif ($_GET['module']=='rptdivgroup'){
  include "modul/mod_rptdivgroup.php";
}
// Bagian Report Sales | Product
elseif ($_GET['module']=='rptproduct'){
  include "modul/mod_rptproduct.php";
}
// Bagian Report Sales | Booking Detail
elseif ($_GET['module']=='rpsalesex'){
  include "modul/mod_rpsalesex.php";
}
// Apabila modul tidak ditemukan
else{
  echo "<p><b>UNDER CONSTRUCTION</b></p>";
}





	
?>
