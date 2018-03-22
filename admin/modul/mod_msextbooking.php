<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>         
<script type="text/javascript" src="../head/editable-select.js"></script> 
<script language="JavaScript"  type="text/javascript">   
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

function hello(string) {
   var name=string
   document.getElementById('myseat').value=name;
}

function refpage(ID) {   window.location.href ='?module=msbooking&act=deviasi&id='+ID
}

function isNumber(field) {
	var re = /^[0-9'.']*$/;
	if (!re.test(field.value)) {
		alert('PLEASE INPUT NUMBER!');
		field.value = field.value.replace(/[^0-9'.']/g,"");
	}
}
 
 
</SCRIPT>
<?php 
$username=$_SESSION[employee_code];
$sqluser=mysql_query("SELECT employee_name, employee_code, office_code, office_group FROM tbl_msemployee
                        left join tbl_msoffice on tbl_msoffice.office_id = tbl_msemployee.office_id
                        WHERE employee_code='$username'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName="$tampiluser[employee_name] ($tampiluser[employee_code])";
$EmpOff=$_SESSION[employee_office];
$offgroup=$tampiluser[office_group];
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
$hariini = date("Y-m-d ");
switch($_GET[act]){
  // Tampil Office
  default:
      $nama=$_GET['nama'];    
      $nama2=$_GET['nama2'];
      $cate=$_GET['cate'];
      $cate2=$_GET['cate2'];
      $qnama=str_replace(" ", "%", $nama);
      $qnama2=str_replace(" ", "%", $nama2);
 
    echo "<h2>External Booking Detail</h2>
          <form method=get action='media.php?'>
          <select name='cate'><option value=''";if($cate==''){echo"selected";}echo">- please select -</option>
                                  <option value='tour_msbooking.TourCode'";if($cate=='tour_msbooking.TourCode'){echo"selected";}echo">Tour Code</option>
                                  <option value='tour_msbooking.TCName'";if($cate=='tour_msbooking.TCName'){echo"selected";}echo">TC Name</option>
                                  <option value='tour_msbooking.BookingID'";if($cate=='tour_msbooking.BookingID'){echo"selected";}echo">Booking ID</option>
                                  <option value='tour_msproduct.DateTravelFrom'";if($cate=='tour_msproduct.DateTravelFrom'){echo"selected";}echo">Dept Date</option>
                                  <option value='tour_msproduct.Season'";if($cate=='tour_msproduct.Season'){echo"selected";}echo">Season</option>
                                  <option value='tour_msbooking.BookersName'";if($cate=='tour_msbooking.BookersName'){echo"selected";}echo">Bookers Name</option>
              </select> <input type=text name=nama value='$nama' size=20><br>
              <select name='cate2'><option value=''";if($cate2==''){echo"selected";}echo">- please select -</option>
                                  <option value='tour_msbooking.TourCode'";if($cate2=='tour_msbooking.TourCode'){echo"selected";}echo">Tour Code</option>
                                  <option value='tour_msbooking.TCName'";if($cate2=='tour_msbooking.TCName'){echo"selected";}echo">TC Name</option>
                                  <option value='tour_msbooking.BookingID'";if($cate2=='tour_msbooking.BookingID'){echo"selected";}echo">Booking ID</option>
                                  <option value='tour_msproduct.DateTravelFrom'";if($cate2=='tour_msproduct.DateTravelFrom'){echo"selected";}echo">Dept Date</option>
                                  <option value='tour_msproduct.Season'";if($cate2=='tour_msproduct.Season'){echo"selected";}echo">Season</option>
                                  <option value='tour_msbooking.BookersName'";if($cate2=='tour_msbooking.BookersName'){echo"selected";}echo">Bookers Name</option>
              </select> <input type=text name='nama2' value='$nama2' size=20>       
			  <input type=hidden name=module value='msextbooking'> 
              <input type=submit name=oke value=Search>
          </form>";
          $oke=$_GET['oke'];
 
          // Langkah 1
          $batas = 10;
          $halaman= $_GET['halaman'];
          if(empty($halaman)){
              $posisi  = 0;
            $halaman = 1;
          } else {
              $posisi = ($halaman-1) * $batas; }
            
            // Langkah 2
            $filt=mysql_query("SELECT * FROM tbl_msemployee   
                                left join tbl_msoffice on tbl_msoffice.office_id=tbl_msemployee.office_id
                                left join cim_msjob on cim_msjob.IDJob=tbl_msemployee.employee_title
                                WHERE tbl_msemployee.employee_code = '$_SESSION[employee_code]'");
            $filter=mysql_fetch_array($filt);
            $team=$filter[office_code];
            $jabatan=$filter[JobID];
            $ltm_authority=$filter[ltm_authority];
            $thisyear = date("Y");
			$OfficeKeyFBD='75';
            

            if($cate=='' and $cate2==''){
            
                  $tampil=mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.BookingDate,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                    tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                    tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.StatusPrice FROM tour_msbooking
                                    left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                    WHERE tour_msbooking.Status ='ACTIVE'
                                    and tour_msproduct.Status <> 'VOID'
                                    and tour_msproduct.DateTravelFrom >= '$hariini'
									and tour_msbooking.OfficeKey='$OfficeKeyFBD'									
                                    ORDER BY tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            $jumlah=mysql_num_rows($tampil);
            }else if($cate=='' and $cate2<>''){
            
            $tampil=mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.BookingDate,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.StatusPrice FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate2 LIKE '%$qnama2%'    
                                AND tour_msbooking.Status ='ACTIVE'
                                and tour_msproduct.Status <> 'VOID'
                                and tour_msproduct.DateTravelFrom >= '$hariini' 
								and tour_msbooking.OfficeKey='$OfficeKeyFBD'
                                ORDER BY tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            $jumlah=mysql_num_rows($tampil);
            }else if($cate2=='' and $cate<>''){
            
            $tampil=mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.BookingDate,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.StatusPrice FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate LIKE '%$qnama%'        
                                AND tour_msbooking.Status ='ACTIVE'
                                and tour_msproduct.Status <> 'VOID'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
								and tour_msbooking.OfficeKey='$OfficeKeyFBD'
                                ORDER BY tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            $jumlah=mysql_num_rows($tampil);
            }else if($cate<>'' and $cate2<>''){
            
            $tampil=mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.BookingDate,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.StatusPrice FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate LIKE '%$qnama%' 
                                AND $cate2 LIKE '%$qnama2%'     
                                AND tour_msbooking.Status ='ACTIVE'
                                and tour_msproduct.Status <> 'VOID'
                                and tour_msproduct.DateTravelFrom >= '$hariini'  
								and tour_msbooking.OfficeKey='$OfficeKeyFBD'
                                ORDER BY tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
           	$jumlah=mysql_num_rows($tampil);
            }else{$jumlah=0;}

            
            if ($jumlah > 0) {          
            echo "   <table class='bordered'>
                    <tr><th colspan=9></th><th colspan=3>total pax</th><th colspan=2>amount</th><th></th></tr>
                    <tr><th>no</th><th>Booking ID</th><th>Date</th><th width='200'>tour code</th><th>Dept</th><th>Bookers</th><th>tc name</th><th>divisi</th><th>cash receipt</th><th>adult</th><th>child</th><th>infant</th><th>tour</th><th>deviasi</th><th width='120'>action</th></tr>";
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
                    $notbf=substr($data[TBFNo],0,13);
                    $cari1=mysql_query("SELECT * FROM tour_tbfbooking WHERE TBFNo = '$notbf'");  
                    $ulang=mysql_fetch_array($cari1);
                    $carifbt=mysql_query("SELECT * FROM tour_fbtbooking WHERE BookingID = '$data[BookingID]'");
                    $datafbt=mysql_fetch_array($carifbt);
                    $edith=mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$data[BookingID]' and PaxName <> '' ORDER BY IDDetail ASC");
                    $r=mysql_fetch_array($edith);
                    $sqlharga=mysql_query("SELECT sum(`SubTotal`)as ST,sum(`DevAmount`)as DA FROM `tour_msbookingdetail` WHERE `BookingID`= '$data[BookingID]' ORDER BY IDDetail ASC");
                    $am=mysql_fetch_array($sqlharga); 
                    $qflight=mysql_query("SELECT * FROM tour_msprodflight WHERE IDProduct = '$data[IDProduct]'");
                    $rowflight=mysql_num_rows($qflight);
                    if($r[PaxName]=='' or $rowflight=='0'){$dev='disabled';}else{$dev='enabled';}
                    
                    $carivoucher=mysql_query("SELECT * FROM tour_voucherpromo WHERE BookingID = '$data[BookingID]' and VoucherStatus='REDEEM' ");
                    $adavoucher=mysql_num_rows($carivoucher);
					$QTotalSales=mysql_query("SELECT sum((Subtotal+SeaTaxSell)*exRate+if((Package<>'L.A only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0)) as Harga FROM tour_msbookingdetail inner join  tour_msproduct on tour_msproduct.IDProduct=tour_msbookingdetail.IDTourcode where BookingId='$data[BookingID]' ");
				    $DTotalSales=mysql_fetch_array($QTotalSales);
					$TotalSales=$DTotalSales[Harga];
					if($data[StatusPrice]<>''){$statlok="<br><img src='../images/lockprice.png' title='LOCK PRICE'>";}else{$statlok="";}
					
                    echo "<tr><td>$no</td>
                     <td>
                     ";
                     if($data[StatusProduct]=='FINALIZE'){echo"<a href=\"javascript:PopupCenter('option.php?code=$data[BookingID]&user=$username','variable',300,250)\">$data[BookingID]</a>";
                     }else{
                     if($data[DepositNo]=='' or $data[DepositAmount]==''){
                        echo"$data[BookingID]";    
                     }else{
                        echo"<a href=\"javascript:PopupCenter('option.php?code=$data[BookingID]&user=$username','variable',300,250)\">$data[BookingID]</a>";
                     }}
                     $edit1=mysql_query("SELECT count(IDDetail)as bnyk FROM tour_msbookingdetail WHERE BookingID ='$data[BookingID]' and Gender <> 'INFANT' and Status <> 'CANCEL' ");  
                     $r2=mysql_fetch_array($edit1);
                     if($data[DepositNo]==''){
                     $totalinq = $data[AdultPax] + $data[ChildPax];
                     }else{$totalinq = $r2[bnyk];}
                     if($data[FBTNo]<>'' or ($data[TBFNo]<>'' AND $ulang[Status]<>'REVISE')){$bisa="disabled";}
                     else {$bisa="enabled";}
                     if($data[TBFNo]==''){$bisa1="enabled";}
                     else{$bisa1="disabled";}
                     if($data[TBFNo]==''or $ulang[Status]=='REVISE'){
                         if($data[StatusPrice]==''){
                             if($data[FBTNo]=='' OR $datafbt[Status]=='VOID'){
                             $lin="?module=msbookingdetail&act=editdetail&code=$data[BookingID]";$det="Edit Detail";$ap="<a href='?module=msbooking&act=addpax&id=$data[BookingID]'><img src='../images/addpax1.png' title='Add Pax'></a> ";}
                             else {
                             $lin="?module=msbookingdetail&act=editdetails&code=$data[BookingID]";$det="Edit Detail";$ap="<img src='../images/addpax2.png' title='Add Pax Not Allowed'> ";
                             }
                         }
                         else{$lin="?module=msbookingdetail&act=editdetails&code=$data[BookingID]";$det="Edit Detail";$ap="<a href='?module=msbooking&act=addpax&id=$data[BookingID]'><img src='../images/addpax1.png' title='Add Pax'></a> ";}
                     }else{
                     $lin="?module=msbookingdetail&act=showdetail&code=$data[BookingID]";$det="Show Detail";$ap="<img src='../images/addpax2.png' title='Add Pax Not Allowed'> ";    
                     }    
                     echo"<br>";
                        if($data[FBTNo]<>'' OR $datafbt[Status]=='ACTIVE'){echo"TRF <img src='../images/ada.png'> ";}else{echo" TRF <img src='../images/belum.png'> ";}
                        if($data[TBFNo]<>'' AND $ulang[Status]=='ACTIVE'){echo" TBF <img src='../images/ada.png'>";}else{echo" TBF <img src='../images/belum.png'>";}
                     echo"</td></td>
					 <td>".date('d M y', strtotime($data[BookingDate]))."</td>
                     <td>$data[TourCode]</td>
                     <td>".date('d M y', strtotime($data[DateTravelFrom]))."</td>
                     <td>$data[BookersName]</td>
                     <td><center>$data[TCName]</td>
                     <td><center>$data[TCDivision]</td>
                     <td><center>$data[DepositNo]</td>
                     <td><center>$data[AdultPax]</td>
                     <td><center>$data[ChildPax]</td>
                     <td><center>$data[InfantPax]</td>
                     <td><center>".number_format($TotalSales, 0, '.', ',');echo"$statlok</td>
                     <td><center>".number_format($am[DA], 0, '.', ',');echo"</td>   
                     <td><center><input type='button' name='submit' value='INPUT INVOICE' onclick=PopupCenter('invoice.php?id=$data[BookingID]','variable',310,200)>";
                     echo"
                     </td></tr>";
                      $no++;
                    }
                    echo "</table>";
                    
                    // Langkah 3            
                    if($cate=='' and $cate2==''){
             
                        $tampil2="SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE tour_msbooking.Status ='ACTIVE'
                                        AND tour_msbooking.Year >= '$thisyear'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
										and tour_msbooking.OfficeKey='$OfficeKeyFBD'
                                        ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC ";
                   
                    }
                    else if($cate=='' and $cate2<>''){
                    
                    $tampil2="SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking   
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE $cate2 LIKE '%$qnama2%'    
                                        AND tour_msbooking.Status ='ACTIVE'
                                        AND tour_msbooking.Year >= '$thisyear'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
										and tour_msbooking.OfficeKey='$OfficeKeyFBD'
                                        ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC ";
                  
                    }else if($cate2=='' and $cate<>''){
                   
                    $tampil2="SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking   
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE $cate LIKE '%$qnama%'        
                                        AND tour_msbooking.Status ='ACTIVE'
                                        AND tour_msbooking.Year >= '$thisyear'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
										and tour_msbooking.OfficeKey='$OfficeKeyFBD'
                                        ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC ";
                    
                    }else if($cate<>'' and $cate2<>''){
                   
                    $tampil2="SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking   
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE $cate LIKE '%$qnama%' 
                                        AND $cate2 LIKE '%$qnama2%'     
                                        AND tour_msbooking.Status ='ACTIVE'
                                        AND tour_msbooking.Year >= '$thisyear'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
										and tour_msbooking.OfficeKey='$OfficeKeyFBD'
                                        ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC ";
                  
                    }
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    // $file = "media.php?module=msbookingdetail";
                    $file = "media.php?module=msextbooking";
                    $namas=str_replace(" ", "+", $nama);
                    // Link ke halaman sebelumnya (previous)
                    echo "<center><div id='paging'>";
                    if ($halaman >1) {
                        $previous = $halaman-1;
                        echo "<a href=$file&halaman=1&nama=$namas&cate=$cate&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&nama=$namas&cate=$cate&oke=$oke> < Previous</a> | ";
                    } else {
                        echo "<< First | < Previous | ";
                    }
                    // Tampilkan link halaman 1,2,3 ... modifikasi ala google
                    // Angka awal
                    $angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
                    for ($i=$halaman-2; $i<$halaman; $i++) {
                        if ($i < 1 )
                            continue;
                        $angka .= "<a href=$file&halaman=$i&nama=$namas&cate=$cate&oke=$oke>$i</a> ";
                    }
                    // Angka tengah
                    $angka .= " <b>$halaman</b> ";
                    for ($i=$halaman+1; $i<($halaman+3); $i++) {
                        if ($i > $jmlhalaman)
                            break;
                        $angka .= "<a href=$file&halaman=$i&nama=$namas&cate=$cate&oke=$oke>$i</a> ";    
                    }
                    // Angka akhir
                    $angka .= ($halaman+2<$jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&nama=$namas&cate=$cate&oke=$oke>$jmlhalaman</a> |" : " ");
                    // Cetak angka seluruhnya (awal, tengah, akhir)
                    echo "$angka";
                    // Link ke halaman berikutnya (Next)
                    if ($halaman < $jmlhalaman) {
                        $next = $halaman+1;
                        echo "<a href=$file&halaman=$next&nama=$namas&cate=$cate&oke=$oke> Next ></a> |
                              <a href=$file&halaman=$jmlhalaman&nama=$namas&cate=$cate&oke=$oke> Last >></a> ";
                    } else {
                        echo " Next > | Last >>";
                    }                    
                    echo "<br><br>Found <b>$jmldata</b> data(s)<p>";
                    echo "</div>";
            } else {
                echo "<div id='paging'>";
                echo "<br><br>Data Not Found<p>";
                echo "</div>";
            }     

    break;

}
?>
