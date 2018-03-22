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

switch($_GET[act]) {
    // Tampil Office
    default:
        $employee_code = $_SESSION['employee_code'];
        $EmpOff=$_SESSION['employee_office'];
        $user = $_SESSION[employee_name];
        $ltm_authority = $_SESSION[ltm_authority];
        $joblevel = $_SESSION[employee_joblevel];
        $blnini = date("m");
        $thnini = date("Y");
        $mont = $_GET['bulan'];
        $yer = $_GET['year'];
        $Dest = $_GET['Destination'];
        $Dept=$_GET['Department'];
        $companyid = $_SESSION['company_id'];
        $today = date("Y-m-d ");
        if ($mont == '') {
            $mont = $blnini;
        }
        if ($yer == '') {
            $yer = $thnini;
        }
        if ($Dest == '') {
            $Dest = 'ALL';
        }
        if($Dep==''){$Dep='ALL';}else{$Dep=$_GET['Department'];}

        echo "<h2>Group TL Assignment</h2>
          <form method='get' action='media.php?'><input type=hidden name=module value='mstlassign'> ";
        echo "Month &nbsp &nbsp &nbsp:&nbsp<select name='bulan' >
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
        $last2=$thnini-2;
        

        if($yer==$last2){echo "<option value='$last2' selected>$last2</option>";}else {echo "<option value='$last2' >$last2</option>";}
        if($yer==$thnini){echo "<option value='$last' selected>$last</option>";}else {echo "<option value='$last' >$last</option>";}
        if($yer==$thnini){echo "<option value='$thnini' selected>$thnini</option>";}else {echo "<option value='$thnini' >$thnini</option>";}

        echo "</select><br>
         Department :&nbsp;&nbsp;<select name='Department' >
			<option value='ALL'>ALL</option>";
        $QDepartment=mysql_query("select distinct Department from tour_msproduct where Department<>''")	;
        while($DDepartment=mysql_fetch_array($QDepartment)) {
            if ($Dept == $DDepartment[Department]) {
                echo "<option value='$DDepartment[Department]' selected>$DDepartment[Department]</option>";
            } else {
                echo "<option value='$DDepartment[Department]' >$DDepartment[Department]</option>";
            }
        }
        echo "</select>
          <input type=submit name='submit' size='20'value='View'>
          </form>";
        $oke = $_GET['oke'];

        if ($mont == '01') {
            $montText = 'JAN';
        }
        if ($mont == '02') {
            $montText = 'FEB';
        }
        if ($mont == '03') {
            $montText = 'MAR';
        }
        if ($mont == '04') {
            $montText = 'APR';
        }
        if ($mont == '05') {
            $montText = 'MAY';
        }
        if ($mont == '06') {
            $montText = 'JUN';
        }
        if ($mont == '07') {
            $montText = 'JUL';
        }
        if ($mont == '08') {
            $montText = 'AUG';
        }
        if ($mont == '09') {
            $montText = 'SEP';
        }
        if ($mont == '10') {
            $montText = 'OCT';
        }
        if ($mont == '11') {
            $montText = 'NOV';
        }
        if ($mont == '12') {
            $montText = 'DEC';
        }

        if($Dept=='ALL'){$filtdep='';}
        else{$filtdep="AND tour_msproduct.Department like '%$Dept%'";}
        if($ltm_authority=='PO BRANCH'){$branch="AND InputDivision = '$EmpOff'";}
        else{$branch="";}
        //Mulai Table
        //Query tidak memunculkan tourcode yang kosong dan yang tidak terjual

//di buka sementara untuk bisa lewat dari tanggal keberangkatan by vili
        /*$QProduct=mysql_query("SELECT * FROM tour_msproduct where Status <> 'VOID' and DateTravelFrom >='$today' and month(DateTravelFrom)='$mont' and year(DateTravelFrom)='$yer' and TourCode<>'' and SeatDeposit > 0 and TourLeaderInc='YES' order by DateTravelFrom asc");*/

        $QProduct = mysql_query("SELECT *, tour_msproductpnr.GrvID FROM tour_msproduct
                            left join tour_msproductpnr on tour_msproductpnr.PnrProd = tour_msproduct.IDProduct
                            left join tour_msprodflight on tour_msprodflight.IDGrv = tour_msproductpnr.GrvID
                            where Status <> 'VOID'
                            and month(DateTravelFrom)='$mont'
                            and year(DateTravelFrom)='$yer'
                            and TourCode<>''
                            and SeatDeposit > 0
                            AND tour_msproduct.CompanyID = '$companyid'
                            $filtdep
                            $branch
                            and IDProduct in (SELECT IDTourcode from tour_msbooking WHERE tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT')  
                            group by tour_msproduct.IDProduct
                            order by DateTravelFrom,AirDate,AirTimeDep asc");

        $Products = mysql_num_rows($QProduct);

        if ($Products > 0) {
            $NO = 1;
            $totpax=0;$totchd=0;$totinf=0;$totadlt=0;
            echo " <table id='GroupDep'>";
            echo "<tr><td colspan=16><h><B>Group Departure $montText - $yer</B></h></td></tr>";
            // HANYA LEVEL MANAGER KEATAS
            if ($ltm_authority == 'PO MANAGER' OR $ltm_authority == 'DEVELOPER') {
                echo "
        <tr><th colspan=14></th><th colspan=2>Tour Leader</th></tr>
        <tr><th>No</th><th>Tour Code</th><th>Region</th><th>Department</th><th>Departure</th><th>By</th><th>ETD</th><th>Arrival</th><th>Flight</th><th>ETA</th><th>Adult</th><th>Child</th><th>Inf</th><th>Pax</th><th>Final</th><th>Tentative</th></tr>";
            } else {
                echo "
        <tr><th>No</th><th>Tour Code</th><th>Region</th><th>Department</th><th>Departure</th><th>By</th><th>ETD</th><th>Arrival</th><th>Flight</th><th>ETA</th><th>Adult</th><th>Child</th><th>Inf</th><th>Pax</th><th>Tour Leader</th></tr>";
            }

            while ($DProduct = mysql_fetch_array($QProduct)) {

                if ($DProduct[ProductFor] == 'ALL') {
                    $Dep = $DProduct[Department];
                } else {
                    $Dep = $DProduct[ProductFor];
                }
                $DataDep = mysql_query("SELECT * FROM `tour_msprodflight` WHERE `IDGrv`='$DProduct[GrvID]' ORDER BY FID ASC limit 1");
                $DataArr = mysql_query("SELECT * FROM `tour_msprodflight` WHERE `IDGrv`='$DProduct[GrvID]' ORDER BY FID DESC limit 1");
                $RDepData = mysql_num_rows($DataDep);
                $DepData = mysql_fetch_array($DataDep);
                $RArrData = mysql_num_rows($DataArr);
                $ArrData = mysql_fetch_array($DataArr);

                $QBookingan = mysql_query("SELECT IDTourCode,sum(if(DUMMY = 'NO' ,(AdultPax+ChildPax+InfantPax),0)) as pax,sum(if(DUMMY = 'NO' ,(InfantPax),0)) as infpax,sum(if(DUMMY = 'NO' ,(ChildPax),0)) as chd
                            ,sum(if(DUMMY = 'NO' ,(AdultPax),0)) as adlt
                            FROM tour_msbooking 
                            WHERE Status ='ACTIVE'
                            and BookingStatus='DEPOSIT'
                            and IDTourCode='$DProduct[IDProduct]'
                            $alldiv
                            group by IDTourCode");
                $DTPax = mysql_fetch_array($QBookingan);
                //LA only
                $QLA = mysql_query("SELECT * FROM tour_msbookingdetail where Bookingid in( Select Bookingid from tour_msbooking tour_msbooking.Status ='ACTIVE' and  tour_msbooking.BookingStatus='DEPOSIT' and IDTourCode='$DProduct[IDProduct]') and tour_msbookingdetail.status <>'CANCEL' and Package='L.A Only' ");
                $BookingLA = mysql_num_rows($QLA);

                if ($DTPax[pax] > 0) {
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

                    $D11 = substr($DepData[AirTimeDep], 0, 2);
                    $D12 = substr($DepData[AirTimeDep], 2, 2);
                    $ATD = date('H.i', strtotime($DepData[AirTimeDep]));
                    if ($DepData[AirTimeDep] == '') {
                        $ATD = '';
                    } else {
                        $ATD = "&nbsp$ATD&nbsp";
                    }
                    $ATA = date('H.i', strtotime($ArrData[AirTimeArr]));
                    if ($ArrData[AirTimeArr] == '') {
                        $ATA = '';
                    } else {
                        $ATA = "&nbsp$ATA&nbsp";
                    }
                    //pewarnaan row kalau status close
                    if (($DProduct[StatusProduct] == 'CLOSE')) {
                        $warna = "BGCOLOR='#f5bebe'";
                    } else {
                        $warna = "BGCOLOR='#ffffff'";
                    }
                    //NAMA TL FINAL
                    $NamaFinalTL = '';
                    $FinalTL = mysql_query("SELECT * FROM tour_msproducttl
                                                    WHERE IDProduct='$DProduct[IDProduct]'
                                                    and tour_msproducttl.TLStatus='FINAL'");
                    $AdaFinal = mysql_num_rows($FinalTL);
                    if ($AdaFinal > 0) {
                        $cb = 0;
                        while ($HFinalTL = mysql_fetch_array($FinalTL)) {
                            $sqlTL = mssql_query("SELECT EmployeeName,Mobile,DivisiID FROM [HRM].[dbo].[Employee]
                                                  WHERE (EmployeeID = '$HFinalTL[EmployeeID]'
                                                  OR IDPHP = '$HFinalTL[EmployeeID]')");
                            $DFinalTL = mssql_fetch_array($sqlTL);
                            $tourleader1 = $DFinalTL[EmployeeName];
                            $tlhp = $DFinalTL[Mobile];
                            $bso = $DFinalTL[DivisiID];
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
                    $TentativeTL = mysql_query("SELECT * FROM tour_msproducttl
                                                    WHERE IDProduct='$DProduct[IDProduct]'
                                                    and TLStatus='TENTATIVE'");
                    $AdaTentative = mysql_num_rows($TentativeTL);
                    if ($AdaTentative > 0) {
                        $cb = 0;
                        while ($HTentativeTL = mysql_fetch_array($TentativeTL)) {
                            $sqlTL = mssql_query("SELECT EmployeeName,Mobile,DivisiID FROM [HRM].[dbo].[Employee]
                                                  WHERE (EmployeeID = '$HTentativeTL[EmployeeID]'
                                                  OR IDPHP = '$HTentativeTL[EmployeeID]')");
                            $DTentativeTL = mssql_fetch_array($TentativeTL);
                            $tourleader1 = $DTentativeTL[EmployeeName];
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
                             <td $warna>$DProduct[TourCode]</td>
                             <td $warna><center>$DProduct[Destination]</td>
                             <td $warna><center>$Dep</td>
                             <td $warna><center>$depdate</td>
                             <td $warna><center>$DepData[AirCode]</td>
                             <td $warna><center>$ATD</td>
                             <td $warna><center>$arrdate</td>
                             <td $warna><center>$ArrData[AirCode]</td>
                             <td $warna><center>$ATA</td>
                             <td style='text-align:right' $warna><center>";
                    if ($DTPax[chd] == 0) {
                        $chd = "";
                    } else {
                        $chd = $DTPax[chd];
                    }
                    if ($DTPax[adlt] == 0) {
                        $adlt = "";
                    } else {
                        $adlt = $DTPax[adlt];
                    }
                    if ($DTPax[infpax] == 0) {
                        $inf = "";
                    } else {
                        $inf = $DTPax[infpax];
                    }
                    if ($DTPax[pax] == 0) {
                        echo "";
                    } else {
                        $Bookingan = $DTPax[pax] - $BookingLA;
                    }
                    $totpax=$totpax+$Bookingan;
                    $totadlt=$totadlt+$adlt;
                    $totchd=$totchd+$chd;
                    $totinf=$totinf+$inf;
                    echo "$adlt</td>
							 <td $warna><center>$chd</td>
                             <td $warna><center>$inf</td>
                             <td $warna><center>$Bookingan</td>
							 <td $warna><center>";
							 if($DProduct[TourLeaderInc]=='YES') {
                                 echo "$finaltl";
                             }else{
                                 echo"NO TL";
                             }
							 echo"</td>";
                    // HANYA LEVEL MANAGER KEATAS
                    if ($ltm_authority == 'PO MANAGER' OR $ltm_authority == 'DEVELOPER') {
                        echo "
                             <td $warna><center>";
                             if($DProduct[TourLeaderInc]=='YES') {
                                 echo "<a href=?module=mstlassign&act=assign&code=$DProduct[IDProduct]>$tl</a>";
                             }
                             echo"</td>";
                    }
                    echo "</tr>";
                    $NO++;
                };
                
            };
            echo "
            <tr><td colspan='10'><b><center>Total</center></b></td><td><b><center>$totadlt</center></b></td><td><b><center>$totchd</center></b></td><td><b><center>$totinf</center></b></td><td><b><center>$totpax</center></b></td><td colspan='2'></td></tr>
            </Table><br><center><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('GroupDep')>";
        } else {
            echo "NO PRODUCT AVAILABLE IN $montText - $yer";
        }
        break;


    case "assign":
        $edit = mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[code]'");
        $r = mysql_fetch_array($edit);
        $hariini = date("Y-m-d ");
        $batas = date('Y-m-d', strtotime('-1 second', strtotime('+6 month', strtotime(date($bulan) . '/' . date($tanggal) . '/' . date($tahun) . ' 00:00:00'))));
        echo "<h2>ASSIGN TL : $r[TourCode]</h2>
          <form method=POST name='info' onsubmit='return validateFormOnSubmit(this)' action='?module=mstlassign&act=save'>
          <input type='hidden' name=id value='$r[IDProduct]'>   
            <center>         
          <table id='assign' border='1'>
          <tr><th>Tour Leader</th><th>Status</th></tr>";
        $i = 1;
        $coba = mysql_query("SELECT * FROM tour_msproducttl where IDProduct ='$_GET[code]' order by IDPTL ASC,TLStatus ASC");
        $baris = mysql_num_rows($coba);
        if ($baris > 0) {
            while ($tes = mysql_fetch_array($coba)) {
                echo "
          <tr><td><select name='tourleader[$i]'><option value='' selected>- Select TL -</option>";
                $tampil = mssql_query("SELECT ISNULL(NickName, EmployeeName)as Nick, EmployeeName as TLNAME, EmployeeID, DivisiID
                                FROM [HRM].[dbo].[Employee]
                                WHERE PassportNo <> ''
                                AND PassportValid > '$hariini'
                                AND StatusTL='APPROVED'
                                AND Active = 1
                                order by EmployeeName ASC ");
                while ($s = mssql_fetch_array($tampil)) {
                    if ($tes[TLName] == $s[TLNAME]) {
                        echo "<option value='$s[EmployeeID]' selected>$s[TLNAME] - $s[Nick] @$s[DivisiID]</option>";
                    } else {
                        echo "<option value='$s[EmployeeID]'>$s[TLNAME] - $s[Nick] @$s[DivisiID]</option>";
                    }

                }
                echo "</select></td>
                     <td><select name='status[$i]'>
                     <option value='TENTATIVE'";
                if ($tes[TLStatus] == 'TENTATIVE') {
                    echo "selected";
                }
                echo ">TENTATIVE</option>
                     <option value='FINAL'";
                if ($tes[TLStatus] == 'FINAL') {
                    echo "selected";
                }
                echo ">FINAL</option>
                     </select></td>  
                  </tr>";
                $i++;
            }
            for ($a = 3; $a > $baris; $a--) {
                echo "
            <tr><td><select name='tourleader[$a]'><option value='' selected>- Select TL -</option>";
                $tampil = mssql_query("SELECT ISNULL(NickName, EmployeeName)as Nick, EmployeeName as TLNAME, EmployeeID, DivisiID
                                FROM [HRM].[dbo].[Employee]
                                WHERE PassportNo <> ''
                                AND PassportValid > '$hariini'
                                AND StatusTL='APPROVED'
                                AND Active = 1
                                order by EmployeeName ASC ");
                while ($s = mssql_fetch_array($tampil)) {
                    echo "<option value='$s[EmployeeID]'>$s[TLNAME] - $s[Nick] @$s[DivisiID]</option>";
                }
                echo "</select></td>
         <td><select name='status[]'>
                     <option value='TENTATIVE'>TENTATIVE</option>
                     <option value='FINAL'>FINAL</option>
                     </select></td>
          </tr>";
            }
        } else {
            for ($a = 1; $a < 4; $a++) {
                echo "
            <tr><td><select name='tourleader[$a]'><option value='' selected>- Select TL -</option>";
                $tampil = mssql_query("SELECT ISNULL(NickName, EmployeeName)as Nick, EmployeeName as TLNAME, EmployeeID, DivisiID
                                FROM [HRM].[dbo].[Employee]
                                WHERE PassportNo <> ''
                                AND PassportValid > '$hariini'
                                AND StatusTL='APPROVED'
                                AND Active = 1
                                order by EmployeeName ASC ");
                while ($s = mssql_fetch_array($tampil)) {
                    echo "<option value='$s[EmployeeID]'>$s[TLNAME] - $s[Nick] @$s[DivisiID]</option>";
                }
                echo "</select></td>
         <td><select name='status[$a]'>
                     <option value='TENTATIVE'>TENTATIVE</option>
                     <option value='FINAL'>FINAL</option>
                     </select></td> 
          </tr>";
            }
        }
        echo "
          </table>          
          <center><input type='submit' name='submit' value='Save' > <input type=button value=Back onclick=self.history.back()> 
          </form>";
        break;
        

    case "save":
        $username = $_SESSION[employee_code];
        $sqluser = mssql_query("SELECT DivisiNo,Employee.DivisiID,EmployeeID,Category,EmployeeName,CompanyGroup FROM [HRM].[dbo].[Employee]
                      inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                      WHERE EmployeeID ='$username'");
        $tampiluser = mssql_fetch_array($sqluser);
        $EmpName = "$tampiluser[EmployeeName] ($tampiluser[EmployeeID])";
        $today = date("Y-m-d G:i:s");
        $edit1 = mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_POST[id]'");
        $r2 = mysql_fetch_array($edit1);
        $bulan = substr($r2[DateTravelFrom], 5, 2);
        $year = substr($r2[DateTravelFrom], 0, 4);
        $cuma = mysql_query("DELETE FROM tour_msproducttl WHERE IDProduct = '$r2[IDProduct]'");
        $tourleader = $_POST['tourleader'];
        $status = $_POST['status'];
        $lim = count($tourleader);
        $batas = $lim + 1;
        $cb = 1;
        for ($satu = 1; $satu < 4; $satu++) {
            $tourleader1 = $tourleader[$satu];
            $status1 = $status[$satu];
            if($tourleader1<>'') {
                $caridatatl = mssql_query("SELECT EmployeeName,EmployeeID,EmployeeType FROM [HRM].[dbo].[Employee] where EmployeeID ='$tourleader1' AND PassportNo <> '' AND PassportValid > '$hariini' AND StatusTL = 'APPROVED' AND Active = 1");
                $datatl = mssql_fetch_array($caridatatl);
                mysql_query("INSERT INTO tour_msproducttl(IDProduct,
                                                EmployeeID,
                                                TLName,
                                                EmployeeType,
                                                TLStatus,
                                                UpdateDate,
                                                UpdateUser) 
                                    VALUES ('$r2[IDProduct]',
                                            '$datatl[EmployeeID]',
                                            '$datatl[EmployeeName]',
                                            '$datatl[EmployeeType]',
                                            '$status1',
                                            '$today',
                                            '$EmpName')");
                if ($status1 == 'FINAL') {
                    if ($cb == 1) {
                        $ttl = "$datatl[EmployeeName]";
                    } else {
                        $ttl = ",$datatl[EmployeeName]";
                    }
                    $a = $a . $ttl;
                    $cb = $cb + 1;
                }
            }
        }
        $updet = mysql_query("UPDATE tour_msproduct set TourLeader = '$a'
                                                        WHERE IDProduct = '$r2[IDProduct]'");

        $Description = "ASSIGN TL FOR ($r2[TourCode])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mstlassign&bulan=$bulan&year=$year&submit=View'>";
        break;
}
?>
