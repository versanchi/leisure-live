<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script> 
<script type="text/javascript"> 
function generateexcel(tableid) {
  var table= document.getElementById(tableid);
  var html = table.outerHTML;
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
}
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<?php 
switch($_GET[act]){
  // Tampil Office
   default:   
    $employee_code=$_SESSION['employee_code'];
    $sqluser=mysql_query("SELECT tbl_msoffice.office_code,tbl_msemployee.ltm_authority,tbl_msemployee.employee_name,cim_msjob.JobLevel FROM tbl_msemployee   
                            left join tbl_msoffice on tbl_msoffice.office_id=tbl_msemployee.office_id
                            left join cim_msjob on cim_msjob.IDJob=tbl_msemployee.employee_title
                            WHERE tbl_msemployee.employee_code = '$employee_code'");
    $hasiluser=mysql_fetch_array($sqluser);
    $user=$hasiluser['employee_name'];
    $joblevel=$hasiluser['JobLevel'];         
    $blnini = date("m");
    $thnini = date("Y");
    $mont=$_GET['bulan'];
    $yer=$_GET['year'];
    $Dest=$_GET['Destination'];
    $today = date("Y-m-d ");
    if($mont==''){$mont=$blnini;}
    if($yer==''){$yer=$thnini;}
    if($Dest==''){$Dest='ALL';}
    echo "<h2>Group Detail</h2>
          <form method='get' action='media.php?'><input type=hidden name=module value='rptgrpdep'> ";       
              echo "Month &nbsp &nbsp &nbsp &nbsp:&nbsp<select name='bulan' >
                      <option value='01'";if($mont=='01'){echo"selected";}echo">JAN</option>
                      <option value='02'";if($mont=='02'){echo"selected";}echo">FEB</option>
                      <option value='03'";if($mont=='03'){echo"selected";}echo">MAR</option>
                      <option value='04'";if($mont=='04'){echo"selected";}echo">APR</option>
                      <option value='05'";if($mont=='05'){echo"selected";}echo">MAY</option>
                      <option value='06'";if($mont=='06'){echo"selected";}echo">JUN</option>
                      <option value='07'";if($mont=='07'){echo"selected";}echo">JUL</option>
                      <option value='08'";if($mont=='08'){echo"selected";}echo">AUG</option>
                      <option value='09'";if($mont=='09'){echo"selected";}echo">SEP</option>
                      <option value='10'";if($mont=='10'){echo"selected";}echo">OCT</option>
                      <option value='11'";if($mont=='11'){echo"selected";}echo">NOV</option>
                      <option value='12'";if($mont=='12'){echo"selected";}echo">DEC</option>
                      </select>
              &nbsp &nbsp Year    :  <select name='year' ><option value='0' >- Select Year -</option>";
            
            //begin
              $last=$thnini-1;
              $tampil=mysql_query("SELECT Year FROM tour_msproduct where year <>'' and Year >= '$last' group BY Year asc");
// kalau sudah disiplin            $tampil=mysql_query("SELECT Year FROM tour_msproduct where year <>'' and Year >= '$yer' group BY Year asc");
            // end
            
            while($s=mysql_fetch_array($tampil)){  // <input type='button' value='Cek Seat' onclick=ceking() >
               if($yer==$s[Year]){
                    echo "<option value='$s[Year]' selected>$s[Year]</option>";     
                }else { 
                echo "<option value='$s[Year]' >$s[Year]</option>";
                } 
            }
    echo "</select> <input type=submit name='submit' size='20'value='View'>
          </form>";
          $oke=$_GET['oke'];
         
         if($mont=='01'){$montText='JAN';}
         if($mont=='02'){$montText='FEB';}
         if($mont=='03'){$montText='MAR';}
         if($mont=='04'){$montText='APR';}
         if($mont=='05'){$montText='MAY';}
         if($mont=='06'){$montText='JUN';}
         if($mont=='07'){$montText='JUL';}
         if($mont=='08'){$montText='AUG';}
         if($mont=='09'){$montText='SEP';}
         if($mont=='10'){$montText='OCT';}
         if($mont=='11'){$montText='NOV';}
         if($mont=='12'){$montText='DEC';}


    
    $QProduct=mysql_query("SELECT *, tour_msproductpnr.GrvID FROM tour_msproduct 
                            left join tour_msproductpnr on tour_msproductpnr.PnrProd = tour_msproduct.IDProduct
                            left join tour_msprodflight on tour_msprodflight.IDGrv = tour_msproductpnr.GrvID
                            where Status <> 'VOID'
                            and month(DateTravelFrom)='$mont' 
                            and year(DateTravelFrom)='$yer' 
                            and TourCode<>'' 
                            and SeatDeposit > 0
                            and IDProduct in (SELECT IDTourcode from tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT')  
                            group by tour_msproduct.IDProduct
                            order by DateTravelFrom,AirDate,AirTimeDep asc");
    
    $Products=mysql_num_rows($QProduct);
    
      if ($Products > 0){
      $NO=1;       
     echo" <table id='GroupDep'>";
echo "<tr><td colspan=16><h><B>Group Detail $montText - $yer</B></h></td></tr>";
	
    echo"<tr><th>No</th><th>Tour Code</th><th>Region</th><th>Department</th><th>Departure</th><th>Flight</th><th>Arrival</th><th>Flight</th><th>Pax</th><th>Inf</th><th>Tour Leader</th><th>Agent</th></tr>";
    
     while($DProduct=mysql_fetch_array($QProduct)){

        if($DProduct[ProductFor]=='ALL'){$Dep=$DProduct[Department];}else{$Dep=$DProduct[ProductFor];}     
                
                $DataDep=mysql_query("SELECT * FROM `tour_msprodflight` WHERE `IDGrv`='$DProduct[GrvID]' ORDER BY FID ASC limit 1");
                $DataArr=mysql_query("SELECT * FROM `tour_msprodflight` WHERE `IDGrv`='$DProduct[GrvID]' ORDER BY FID DESC limit 1");
                $RDepData=mysql_num_rows($DataDep);
                $DepData=mysql_fetch_array($DataDep);
                $RArrData=mysql_num_rows($DataArr);
                $ArrData=mysql_fetch_array($DataArr);
                
                $QBookingan=mysql_query("SELECT IDTourCode,sum(if(TCDivision<>'LTM' AND TCDivision <> 'LTM-TEZ' ,(AdultPax+ChildPax),0)) as pax,sum(if(TCDivision<>'LTM' AND TCDivision <> 'LTM-TEZ' ,(InfantPax),0)) as infpax,sum(if(TCDivision<>'LTM' AND TCDivision <> 'LTM-TEZ' ,(ChildPax+InfantPax),0)) as chd,sum(if(TCDivision='LTM' ,(AdultPax+ChildPax),0)) as DumPax
                            FROM tour_msbooking 
                            WHERE tour_msbooking.Status ='ACTIVE' 
                            and  tour_msbooking.BookingStatus='DEPOSIT' 
                            and IDTourCode='$DProduct[IDProduct]'  
                            group by IDTourCode");
                $DTPax=mysql_fetch_array($QBookingan);
                //LA only
                $QLA=mysql_query("SELECT * FROM tour_msbookingdetail where Bookingid in( Select Bookingid from tour_msbooking tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProduct[IDProduct]') and tour_msbookingdetail.status <>'CANCEL' and Package='L.A Only' ");
                $BookingLA=mysql_num_rows($QLA);        
        
                        if($DTPax[pax]>0) {
                            //merubah format tampilan date
                            $Selling = number_format($DProduct[SellingAdlTwn], 0, ',', '.');
                            $Tax = number_format($DProduct[TaxInsSell], 0, ',', '.');
                            if ($RDepData > 0) {
                                if ($DepData[AirDate] == '0000-00-00') {
                                    $depdate = 'tba';
                                } else {
                                    $depdate = strtoupper(date('d M', strtotime($DepData[AirDate])));  //if($depdate=='01 JAN'){$depdate='';}else{$depdate="&nbsp$depdate&nbsp";}
                                }
                            } else {
                                $depdate = '';
                            }
                            if ($RArrData > 0) {
                                if ($DepData[AirDate] == '0000-00-00') {
                                    $arrdate = 'tba';
                                } else {
                                    $arrdate = strtoupper(date('d M', strtotime($ArrData[AirDate]))); //if($arrdate=='01 JAN'){$arrdate='';}else{$arrdate="&nbsp$arrdate&nbsp";}
                                }
                            } else {
                                $arrdate = '';
                            }


                            //pewarnaan row kalau status close
                            if (($DProduct[StatusProduct] == 'CLOSE')) {
                                $warna = "BGCOLOR='#f5bebe'";
                            } else {
                                $warna = "BGCOLOR='#ffffff'";
                            }
                            //NAMA TL FINAL
                            $NamaFinalTL = '';
                            $FinalTL = mysql_query("SELECT *,tbl_msemployee.*,tbl_msoffice.* FROM tour_msproducttl
                                                    left join tbl_msemployee on tbl_msemployee.employee_id = tour_msproducttl.IDTourleader
                                                    left join tbl_msoffice on tbl_msoffice.office_id = tbl_msemployee.office_id
                                                    WHERE IDProduct='$DProduct[IDProduct]'
                                                    and tour_msproducttl.TLStatus='FINAL'
                                                    and tbl_msemployee.StatusTL='APPROVED'");
                            $AdaFinal = mysql_num_rows($FinalTL);
                            if ($AdaFinal > 0) {
                                $cb = 0;
                                while ($DFinalTL = mysql_fetch_array($FinalTL)) {
                                    $tourleader1 = $DFinalTL[employee_name];
                                    $tlhp = $DFinalTL[Mobile];
                                    $bso = $DFinalTL[office_code];
                                    if ($cb == 0) {
                                        $ttl = "$tourleader1 @$bso ($tlhp)";
                                    } else {
                                        $ttl = ",<br>$tourleader1 @$bso ($tlhp)";
                                    }
                                    $NamaFinalTL = $NamaFinalTL . $ttl;
                                    $cb++;
                                }
                            }
                            //NAMA TL TENTATIF
                            $NamaTL = '';
                            $TentativeTL = mysql_query("SELECT *,tbl_msemployee.* FROM tour_msproducttl
                                                    left join tbl_msemployee on tbl_msemployee.employee_id = tour_msproducttl.IDTourleader
                                                    WHERE IDProduct='$DProduct[IDProduct]' 
                                                    and tour_msproducttl.TLStatus='TENTATIVE'");
                            $AdaTentative = mysql_num_rows($TentativeTL);
                            if ($AdaTentative > 0) {
                                $cb = 0;
                                while ($DTentativeTL = mysql_fetch_array($TentativeTL)) {
                                    $tourleader1 = $DTentativeTL[TLName];
                                    $tlhp = $DTentativeTL[Mobile];

                                    if ($cb == 0) {
                                        $ttl = "$tourleader1 ($tlhp)";
                                    } else {
                                        $ttl = ",<br>$tourleader1 ($tlhp)";
                                    }
                                    $NamaTL = $NamaTL . $ttl;
                                    $cb++;
                                }
                            }
                            $NoRegTL = mysql_query("SELECT *,tbl_msemployee.* FROM tour_msproducttl
                                                left join tbl_msemployee on tbl_msemployee.employee_id = tour_msproducttl.IDTourleader
                                                WHERE IDProduct='$DProduct[IDProduct]'
                                                and tour_msproducttl.TLStatus='FINAL'
                                                and (tour_msproducttl.IDTourleader='0' OR tbl_msemployee.StatusTL<>'APPROVED')");
                            $JumNoReg = mysql_num_rows($NoRegTL);
                            $NoReg = mysql_fetch_array($NoRegTL);
                            if ($JumNoReg > 0) {
                                $noregtl = '';
                                $RegTL = mysql_query("SELECT *,tour_mstourleaderdihapus.* FROM tour_msproducttl
                                                    left join tour_mstourleaderdihapus on tour_mstourleaderdihapus.IDTourleader = tour_msproducttl.IDLama
                                                    WHERE tour_msproducttl.IDProduct='$DProduct[IDProduct]'
                                                    and tour_msproducttl.TLStatus='FINAL'
                                                    and tour_mstourleaderdihapus.TourleaderStatus='ACTIVE'");
                                $AdaFinal = mysql_num_rows($RegTL);
                                if ($AdaFinal > 0) {
                                    $cb = 0;
                                    while ($DRegTL = mysql_fetch_array($RegTL)) {
                                        $rtourleader1 = $DRegTL[TourleaderName];
                                        $tlhp = $DRegTL[TourleaderMobile];
                                        if ($cb == 0) {
                                            $ttl = "$rtourleader1 ($tlhp)";
                                        } else {
                                            $ttl = ",<br>$rtourleader1 ($tlhp)";
                                        }
                                        $noregtl = $noregtl . $ttl;
                                        $cb++;
                                    }
                                }
                            } else {
                                $noregtl = '';
                            }

                            if ($NamaFinalTL == '') {
                                $finaltl = '';
                            } else {
                                $finaltl = $NamaFinalTL;
                            }
                            if ($NamaTL == '') {
                                $tl = 'ASSIGN';
                            } else {
                                $tl = $NamaTL;
                            }
                            $turcode = str_replace(" ", "_", $DProduct[TourCode]);
                            echo "
                             <td $warna>$NO</td>
                             <td $warna>$DProduct[TourCode] <a href=?module=msproduct&act=showquotation&id=$DProduct[IDProduct]> <img src='../images/file.gif' title='Quotation'></a>";
                             if($DProduct[QuotationFinalOption]<>'' and $DProduct[QuotationStatus]='LOCK'){
                             echo" <a href=?module=msproduct&act=showfinalquotation&id=$DProduct[IDProduct] > <img src = '../images/file.gif' title = 'Final Quotation' ></a >";
                             }
                             echo"</td>
                             <td $warna><center>$DProduct[Destination]</td>
                             <td $warna><center>$Dep</td>
                             <td $warna><center>$depdate</td>
                             <td $warna><center>$DepData[AirCode]</td>
                             
                             <td $warna><center>$arrdate</td>
                             <td $warna><center>$ArrData[AirCode]</td>

                             <td style='text-align:right' $warna><center>";   
                             if($DTPax[chd]==0){$chd="";}else{$chd=$DTPax[chd];} 
							 if($DTPax[infpax]==0){$inf="";}else{$inf=$DTPax[infpax];}    
                             if($DTPax[pax]==0){echo"";}else{
                                 $Bookingan= $DTPax[pax]-$BookingLA;   
                        echo"$Bookingan";}
                        echo"</td>
						
							  <td $warna><center>$inf</td>	
                           
                             
							 <td $warna><center>";
							 if($DProduct[TourLeaderInc]=='YES') {
                                 echo "$finaltl";
                             }else{
                                 echo"NO TL";
                             }
							 echo"</td>";
                       
							 
							 $QAgent =mysql_fetch_array(mysql_query("SELECT  * FROM tour_agent 
                                                    WHERE IDProduct='$DProduct[IDProduct]'
                                                    and (Supplier <>'') limit 1 "));

							 
							 
                             echo"<td $warna><center>$QAgent[Supplier] </td></tr>";
                             $NO++;
                             };
                            
            
    };
    echo "</Table><br><center><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('GroupDep')>";
    }
    else
    
    { echo "NO PRODUCT AVAILABLE IN $montText - $yer";
    } 
       
    break;
  
}
?>
