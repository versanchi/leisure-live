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
<script type="text/javascript">
            $(document).ready(function(){
                
                //    -- Datepicker
                $(".my_date").datepicker({
                    dateFormat: 'dd-mm-yy',
                    showButtonPanel: true
                });                    
                //    -- Datepicker2           
                $(".my_date2").datepicker({
                    dateFormat: 'yy-mm-dd',
                    showButtonPanel: true
                });                      
                // -- Clone table rows
                $(".cloneTableRows").live('click', function(){

                    // this tables id
                    var thisTableId = $(this).parents("table").attr("id");
                
                    // lastRow
                    var lastRow = $('#'+thisTableId + " tr:last");
                      
                    var rowCount = $('#'+thisTableId).attr('rows').length;
 
        
                    // clone last row
                    var newRow = lastRow.clone(true);
                    
                    // append row to this table
                    $('#'+thisTableId).append(newRow);
                    
                    // make the delete image visible
                    $('#'+thisTableId + " tr:last td:first img").css("visibility", "visible");
                                                                                               
                    // clear the inputs (Optional)
                    $('#'+thisTableId + " tr:last td :input").val('');          
                    // new rows datepicker need to be re-initialized
                    $(newRow).find("input").each(function(){
                        if($(this).hasClass("hasDatepicker")){ // if the current input has the hasDatpicker class
                            var this_id = $(this).attr("id"); // current inputs id
                            var new_id = this_id +1; // a new id
                            $(this).attr("id", new_id); // change to new id  
                           // $(this).attr("value", new_id); 
                            $(this).removeClass('hasDatepicker'); // remove hasDatepicker class
                             // re-init datepicker
                            $(this).datepicker({
                                dateFormat: 'dd-mm-yy',
                                showButtonPanel: true , 
                            });                  
                        }        
                       
                    });                    
                                           
                    return false; 
                });
               
                // Delete a table row
                $("img.delRow").click(function(){
                    $(this).parents("tr").remove();
                    return false;
                });
            
            });
</script>


<?php 
switch($_GET[act]){
  // Tampil Office
   default:   
    $employee_code=$_SESSION['employee_code'];
    $sqluser = mssql_query("SELECT EmployeeID,DivisiNo,Employee.DivisiID,Category,EmployeeName,CompanyGroup,LTMAuthority,JobLevel FROM [HRM].[dbo].[Employee]
                      inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                      WHERE EmployeeID = '$employee_code'");
    $hasiluser = mssql_fetch_array($sqluser);
    $user=$hasiluser['EmployeeName'];
    $ltm_authority=$hasiluser['LTMAuthority'];
    $companyid = $_SESSION['company_id'];
    $joblevel=$hasiluser['JobTitle'];
    $blnini = date("m");
    $thnini = date("Y");
    $mont=$_GET['bulan'];
    $yer=$_GET['year'];
    $Dest=$_GET['Destination'];
    $today = date("Y-m-d ");
    if($mont==''){$mont=$blnini;}
    if($yer==''){$yer=$thnini;}
    if($Dest==''){$Dest='ALL';}
    echo "<h2>Group Arrival</h2>
          <form method='get' action='media.php?'><input type=hidden name=module value='grouparr'> ";       
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
            

              $last=$thnini-1;
              $tampil=mysql_query("SELECT Year FROM tour_msproduct where year <>'' and Year >= '$last' group BY Year asc");
            
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

       if($ltm_authority=='PO BRANCH'){$branch="AND InputDivision = '$EmpOff'";}
       else{$branch="";}
   
    $QProduct=mysql_query("SELECT *, tour_msproductpnr.GrvID FROM tour_msproduct 
                            left join tour_msproductpnr on tour_msproductpnr.PnrProd = tour_msproduct.IDProduct
                            left join tour_msprodflight on tour_msprodflight.IDGrv = tour_msproductpnr.GrvID
                            where Status <> 'VOID'
                            and month(DateTravelTo)='$mont' 
                            and year(DateTravelTo)='$yer' 
                            and TourCode<>'' 
                            and SeatDeposit > 0
                            and IDProduct in (SELECT IDTourcode from tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT')  
                            AND tour_msproduct.CompanyID = '$companyid'
                            $branch
                            group by tour_msproduct.IDProduct
                            order by DateTravelTo,AirTimeArr asc");
    
    $Products=mysql_num_rows($QProduct);
    
      if ($Products > 0){
      $NO=1;
     echo" <table id='GroupArr'>";     
echo "<tr><td colspan=10><h><B>Group Arrival $montText - $yer</B></h></td></tr>";
	// HANYA LEVEL MANAGER KEATAS
    echo"<tr><th>No</th><th>Tour Code</th><th>Region</th><th>Department</th><th>Arrival</th><th>Flight</th><th>ETA</th><th>Pax</th><th>Inf</th><th>TourLeader</th></tr>";
  
    
     while($DProduct=mysql_fetch_array($QProduct)){
        
                     
        if($DProduct[ProductFor]=='ALL'){$Dep=$DProduct[Department];}else{$Dep=$DProduct[ProductFor];}     
                
                $DataDep=mysql_query("SELECT * FROM `tour_msprodflight` WHERE `IDGrv`='$DProduct[GrvID]' ORDER BY FID ASC limit 1");
                $DataArr=mysql_query("SELECT * FROM `tour_msprodflight` WHERE `IDGrv`='$DProduct[GrvID]' ORDER BY FID DESC limit 1");
                $RDepData=mysql_num_rows($DataDep);
                $DepData=mysql_fetch_array($DataDep);
                $RArrData=mysql_num_rows($DataArr);
                $ArrData=mysql_fetch_array($DataArr);
                
                $QBookingan=mysql_query("SELECT IDTourCode,sum(AdultPax+ChildPax) as pax,sum(InfantPax) as infpax,sum(ChildPax) as chd
                            FROM tour_msbooking 
                            WHERE tour_msbooking.Status ='ACTIVE' 
                            and  tour_msbooking.BookingStatus='DEPOSIT' 
                            and IDTourCode='$DProduct[IDProduct]'  and (TCDivision<>'LTM' and TCDivision<>'LTM-TEZ')
                            group by IDTourCode");
                $DTPax=mysql_fetch_array($QBookingan);
                //LA only
                $QLA=mysql_query("SELECT * FROM tour_msbookingdetail where Bookingid in( Select Bookingid from tour_msbooking tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProduct[IDProduct]' and (TCDivision<>'LTM' and TCDivision<>'LTM-TEZ')) and tour_msbookingdetail.status <>'CANCEL' and Package='L.A Only' ");
                $BookingLA=mysql_num_rows($QLA);        
        
                        if($DTPax[pax]>0){                           
                        //merubah format tampilan date
                        $Selling=number_format($DProduct[SellingAdlTwn], 0, ',', '.');
                        $Tax=number_format($DProduct[TaxInsSell], 0, ',', '.');
                 
                        if($RArrData>0){
                        $arrdate =strtoupper(date('d M', strtotime($ArrData[AirDate]))); //if($arrdate=='01 JAN'){$arrdate='';}else{$arrdate="&nbsp$arrdate&nbsp";}
                        }else{$arrdate='';}

                        $D11=substr($DepData[AirTimeDep],0,2);$D12=substr($DepData[AirTimeDep],2,2);
                        $ATD = date('H.i', strtotime($DepData[AirTimeDep])); if($DepData[AirTimeDep]==''){$ATD='';}else{$ATD="&nbsp$ATD&nbsp";}
                        $ATA = date('H.i', strtotime($ArrData[AirTimeArr])); if($ArrData[AirTimeArr]==''){$ATA='';}else{$ATA="&nbsp$ATA&nbsp";}     
                        //pewarnaan row kalau status close
                        if(($DProduct[StatusProduct]=='CLOSE')){$warna="BGCOLOR='#f5bebe'";}else {$warna="BGCOLOR='#ffffff'";}
						//NAMA TL FINAL
                        $NamaFinalTL='';
                        $FinalTL =mysql_query("SELECT * FROM tour_msproducttl
                                                    WHERE IDProduct='$DProduct[IDProduct]'
                                                    and tour_msproducttl.TLStatus='FINAL'");
                    $AdaFinal = mysql_num_rows($FinalTL);
                    if ($AdaFinal > 0) {
                        $cb = 0;
                        while ($HFinalTL = mysql_fetch_array($FinalTL)) {
                            $sqlTL = mssql_query("SELECT * FROM [HRM].[dbo].[Employee]
                                                  WHERE (EmployeeID = '$HFinalTL[EmployeeID]'
                                                  OR IDPHP = '$HFinalTL[EmployeeID]')");
                        
                            $DFinalTL=mssql_fetch_array($sqlTL);
                                 $tourleader1 = $DFinalTL[EmployeeName];
                            	  $tlhp = $DFinalTL[Mobile];
                            	  $bso = $DFinalTL[DivisiID];
                                    if($cb==0){
                                        $ttl="$tourleader1 @$bso ($tlhp)";
                                    }else{
                                        $ttl=",<br>$tourleader1 @$bso ($tlhp)";
                                    }
                                    $NamaFinalTL=$NamaFinalTL.$ttl; 
                                    $cb++;    
                            }
                        }
                     
                        $NoRegTL =mysql_query("SELECT *,tbl_msemployee.* FROM tour_msproducttl
                                                left join tbl_msemployee on tbl_msemployee.employee_id = tour_msproducttl.IDTourleader
                                                WHERE IDProduct='$DProduct[IDProduct]'
                                                and tour_msproducttl.TLStatus='FINAL'
                                                and (tour_msproducttl.IDTourleader='0' OR tbl_msemployee.StatusTL<>'APPROVED')");
                        $JumNoReg=mysql_num_rows($NoRegTL);
                        $NoReg=mysql_fetch_array($NoRegTL);
                        if($JumNoReg>0){
                            $noregtl='';
                            $RegTL =mysql_query("SELECT *,tour_mstourleaderdihapus.* FROM tour_msproducttl
                                                    left join tour_mstourleaderdihapus on tour_mstourleaderdihapus.IDTourleader = tour_msproducttl.IDLama
                                                    WHERE tour_msproducttl.IDProduct='$DProduct[IDProduct]'
                                                    and tour_msproducttl.TLStatus='FINAL'
                                                    and tour_mstourleaderdihapus.TourleaderStatus='ACTIVE'");
                            $AdaFinal=mysql_num_rows($RegTL);
                            if($AdaFinal>0){
                                $cb=0;
                                while($DRegTL=mysql_fetch_array($RegTL)){
                                    $rtourleader1=$DRegTL[TourleaderName];
                                    $tlhp=$DRegTL[TourleaderMobile];
                                    if($cb==0){
                                        $ttl="$rtourleader1 ($tlhp)";
                                    }else{
                                        $ttl=",<br>$rtourleader1 ($tlhp)";
                                    }
                                    $noregtl=$noregtl.$ttl;
                                    $cb++;
                                }
                            }
                        }else{$noregtl='';}
						
						if($NamaFinalTL==''){$finaltl='';}else{$finaltl=$NamaFinalTL;}
                        if($NamaTL==''){$tl='ASSIGN';}else{$tl=$NamaTL;}
                        $turcode=str_replace(" ", "_", $DProduct[TourCode]);
                        echo "
                             <td $warna>$NO</td>
                             <td $warna>$DProduct[TourCode]</td>
                             <td $warna><center>$DProduct[Destination]</td>
                             <td $warna><center>$Dep</td>
                             <td $warna><center>$arrdate</td>
                             <td $warna><center>$ArrData[AirCode]</td>
                             <td $warna><center>$ATA</td>
                             <td style='text-align:right' $warna><center>";   
                             if($DTPax[chd]==0){$chd="";}else{$chd=$DTPax[chd];} 
							 if($DTPax[infpax]==0){$inf="";}else{$inf=$DTPax[infpax];}    
                             if($DTPax[pax]==0){echo"";}else{
                                 $Bookingan= $DTPax[pax]-$BookingLA;   
                        echo"$Bookingan";}
                        echo"</td>
						
							  <td $warna><center>$inf</td>	
							 <td $warna><center>$finaltl</td></tr>";    
                             $NO++;
                             };
                            
            
    };        
    echo "</Table><br><center><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('GroupArr')>";
    }
    else
    
    { echo "NO PRODUCT AVAILABLE IN $montText - $yer";
    } 
       
    break;
 }
?>
