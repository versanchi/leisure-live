<?php
switch($_GET[act]){
  // Tampil productcode
  default:
    $hariini = date("Y-m-d ");
    $nama=$_GET['nama'];
    $nama2=$_GET['nama2'];
    $opnama=$_GET['opnama'];
    $opnama2=$_GET['opnama2'];
    $blnini = date("m");
    $thnini = date("Y");
    $mont=$_GET['bulan'];
    $yer=$_GET['year'];   
    $jenis=$_GET['jenis'];

    if($yer==''){$yer=$thnini;}
    if($jenis==''){$jenis='noconfi';}     
    echo "<h2>SEARCH FLIGHT</h2>
          <form name='awal' id='myform' method=get action='media.php?'><input type=hidden name=module value='searchpnr'>
          <input type=radio name='jenis' value='confi'";if($jenis=='confi'){echo"checked";}echo" onclick='confi()'>&nbsp;<font size=2>Confi Fare</font>&nbsp;&nbsp;&nbsp;
          <input type=radio name='jenis' value='noconfi'";if($jenis=='noconfi'){echo"checked";}echo" onclick='noconfi()'>
          <font size=2>Period : Month &nbsp:</font> <select name='bulan'>                                  
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
               <font size=2> Year :</font> <select name='year'> ";
            $tampil=mysql_query("SELECT Year,YEAR(GrvDateOfDep) as Tahun FROM tour_msgrv where year <>'' group BY Year asc");
            while($s=mysql_fetch_array($tampil)){  // <input type='button' value='Cek Seat' onclick=ceking() >
               if($yer==$s[Year]){
                    echo "<option value='$s[Year]' selected>$s[Year]</option>";
                }else { 
                echo "<option value='$s[Year]' >$s[Year]</option>";
                } 
            }
    echo "</select><br>
              <select name='opnama'><option value=''";if($opnama==''){echo"selected";}echo">- please select -</option>
                                    <option value='GrvAirlines'";if($opnama=='GrvAirlines'){echo"selected";}echo">Airlines</option>
                                    <option value='GrvArea'";if($opnama=='GrvArea'){echo"selected";}echo">Area</option>
                                    <option value='GrvPnr'";if($opnama=='GrvPnr'){echo"selected";}echo">PNR No</option> 
              </select> <input type=text name='nama' value='$nama' size=20><br>
              <select name='opnama2'><option value=''";if($opnama2==''){echo"selected";}echo">- please select -</option>
                                    <option value='GrvAirlines'";if($opnama2=='GrvAirlines'){echo"selected";}echo">Airlines</option>
                                    <option value='GrvArea'";if($opnama2=='GrvArea'){echo"selected";}echo">Area</option>
                                    <option value='GrvPnr'";if($opnama2=='GrvPnr'){echo"selected";}echo">PNR No</option> 
              </select> <input type=text name='nama2' value='$nama2' size=20>     
              <input type=submit name=oke value=Search>
          </form>";
          $oke=$_GET['oke'];
          if($mont<>''){
          // Langkah 1
          $batas = 10;
          $halaman= $_GET['halaman'];
          if(empty($halaman)){
              $posisi  = 0;
            $halaman = 1;
          } else {
              $posisi = ($halaman-1) * $batas; }       
            // Langkah 2                                 
            if($jenis=='confi'){
            if($opnama=='' and $opnama2<>''){
                    $tampil=mysql_query("SELECT * FROM tour_msgrv                                               
                                WHERE $opnama2 LIKE '%$nama2%'
                                AND GrvDateOfDep = '0000-00-00'                                                
                                ORDER BY GrvDateOfDep Desc,GrvDeadlineDeposit,GrvTourcode ASC  LIMIT $posisi,$batas");}
            else if($opnama2=='' and $opnama<>''){
                    $tampil=mysql_query("SELECT * FROM tour_msgrv                                                
                                WHERE $opnama LIKE '%$nama%'
                                AND GrvDateOfDep = '0000-00-00'                                                   
                                ORDER BY GrvDateOfDep Desc,GrvDeadlineDeposit,GrvTourcode ASC LIMIT $posisi,$batas");}
            else if($opnama2<>'' and $opnama<>''){
                    $tampil=mysql_query("SELECT * FROM tour_msgrv                                                
                                WHERE $opnama LIKE '%$nama%'
                                AND $opnama2 LIKE '%$nama2%' 
                                AND GrvDateOfDep = '0000-00-00'                                               
                                ORDER BY GrvDateOfDep Desc,GrvDeadlineDeposit,GrvTourcode ASC LIMIT $posisi,$batas");}
            else if($optnama=='' and $optnama2==''){
                    $tampil=mysql_query("SELECT * FROM tour_msgrv where GrvDateOfDep = '0000-00-00'                                              
                                ORDER BY GrvDateOfDep Desc,GrvDeadlineDeposit,GrvTourcode ASC LIMIT $posisi,$batas");}
            }else{
            if($opnama=='' and $opnama2<>''){
                    $tampil=mysql_query("SELECT * FROM tour_msgrv                                               
                                WHERE $opnama2 LIKE '%$nama2%'
                                AND Year(GrvDateOfDep) = '$yer' AND Month(GrvDateOfDep) = '$mont'              
                                ORDER BY GrvDateOfDep Desc,GrvDeadlineDeposit,GrvTourcode ASC LIMIT $posisi,$batas");}
            else if($opnama2=='' and $opnama<>''){
                    $tampil=mysql_query("SELECT * FROM tour_msgrv                                                
                                WHERE $opnama LIKE '%$nama%'
                                AND Year(GrvDateOfDep) = '$yer' AND Month(GrvDateOfDep) = '$mont'                
                                ORDER BY GrvDateOfDep Desc,GrvDeadlineDeposit,GrvTourcode ASC LIMIT $posisi,$batas");}
            else if($opnama2<>'' and $opnama<>''){
                    $tampil=mysql_query("SELECT * FROM tour_msgrv                                                
                                WHERE $opnama LIKE '%$nama%'
                                AND $opnama2 LIKE '%$nama2%'
                                AND Year(GrvDateOfDep) = '$yer' AND Month(GrvDateOfDep) = '$mont'              
                                ORDER BY GrvDateOfDep Desc,GrvDeadlineDeposit,GrvTourcode ASC LIMIT $posisi,$batas");}
            else if($optnama=='' and $optnama2==''){
                    $tampil=mysql_query("SELECT * FROM tour_msgrv where Year(GrvDateOfDep) = '$yer' AND Month(GrvDateOfDep) = '$mont'
                                ORDER BY GrvDateOfDep Desc,GrvDeadlineDeposit,GrvTourcode ASC LIMIT $posisi,$batas");}    
            }
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "<table class='bordered'>
                    <tr><th colspan='14'></th><th colspan='2'>Deposit Amount</th><th colspan='6'></th></tr>
                  <tr><th>no</th><th>Airlines</th><th>Area</th><th>Date Of Dep</th>
                  <th>Seat</th><th>PNR</th><th>Curr</th><th>Adt Fare</th><th>chd Fare</th><th>Fuel Surc</th><th>tax</th><th>foc</th><th>dateline deposit</th><th>Review deposit</th>
                  <th>per pax</th><th>total</th><th>booking pax</th><th>Status</th></tr>";
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
                    if($data[GrvDateOfDep]=='0000-00-00'){$GDOD='NO DATE';}else{
                    $GDOD = date('d M Y', strtotime($data[GrvDateOfDep]));}
                    if($data[GrvDeadlineDeposit]=='0000-00-00'){$GDD='NO DATE';}else{
                    $GDD = date('d M Y', strtotime($data[GrvDeadlineDeposit]));}
                    if($data[GrvReviewDeposit]=='0000-00-00'){$GRD='NO DATE';}else{
                        $GRD = date('d M Y', strtotime($data[GrvReviewDeposit]));}
                    if($data[GrvStatus]=='VOID'){$grvstatus="<font color=red><b>VOID</b></font>";}
                    else if($data[GrvStatus]=='NONE'){$grvstatus="<i>- NONE -</i>";}
                    else {$grvstatus="$data[GrvStatus]";}
                    $cprod=mysql_query("SELECT * FROM tour_msproductpnr                                               
                                WHERE GrvID = '$data[IDGrv]'              
                                ORDER BY PnrID ASC ");
                    $grandpax=0;
                    while ($dprod=mysql_fetch_array($cprod)){
                        $itung=mysql_query("SELECT Count(IDDetail) as subpax FROM tour_msbookingdetail                                               
                                WHERE IDTourcode = '$dprod[PnrProd]'
                                AND Status <> 'CANCEL'  
                                AND Package <> 'L.A Only'              
                                ORDER BY IDDetail ASC ");
                        $itungan=mysql_fetch_array($itung);
                        $grandpax=$grandpax+$itungan[subpax];    
                    }
                    $selisih=$data[GrvSeat]-$grandpax;
                    if($data[GrvSeat] < $grandpax){$warna="BGCOLOR='red'";}
                    else if($selisih <= 5 AND $selisih > 0){$warna="BGCOLOR='yellow'";}
                    else {$warna="BGCOLOR='white'";}        
               echo "<tr><td $warna>$no</td>
                     <td $warna><center>$data[GrvAirlines]</td>
                     <td $warna><center>$data[GrvArea]</td>
                     <td $warna><center>$GDOD</td>                   
                     <td $warna><center>$data[GrvSeat]</td> 
                     <td $warna><center>$data[GrvPnr]</td>
                     <td $warna><center>$data[GrvAdlFareCurr]</td>
                     <td $warna><center>$data[GrvAdlFare]</td>
                     <td $warna><center>$data[GrvChdFare]</td>
                     <td $warna><center>$data[GrvFuelSurcharge]</td>
                     <td $warna><center>$data[GrvTax]</td>
                     <td $warna><center>$data[GrvFoc]</td>
                     <td $warna><center>$GDD</td>
                     <td $warna><center>$GRD</td>
                     <td $warna><center>$data[GrvAmountSeatCurr] $data[GrvAmountSeat]</td>
                     <td $warna><center>$data[GrvAmountCurr] $data[GrvAmount]</td>
                     <td $warna><center>";
                     if($grandpax==0){echo"$grandpax";}else{echo"
                     <a href=?module=rptnamelist&act=namelistgrv&no=$data[IDGrv]>$grandpax</a>";
                     }echo"
                     </td>";
                    
                    $edit1=mysql_query("SELECT * FROM tour_msgrv WHERE IDGrv ='$data[IDGrv]' and GrvStatus <>'VOID'");  
                    $r2=mysql_num_rows($edit1);

               echo" <td $warna><center>$grvstatus</td></tr>";
                      $no++;
                    } 
                    echo"
                    
                    </table>";
                    
                    // Langkah 3                         
                    if($jenis=='confi'){
            if($opnama=='' and $opnama2<>''){
                    $tampil2="SELECT * FROM tour_msgrv                                               
                                WHERE $opnama2 LIKE '%$nama2%'
                                AND GrvDateOfDep = '0000-00-00'                                                
                                ORDER BY GrvDeadlineDeposit,GrvTourcode ASC,GrvDateOfDep ASC";}
            else if($opnama2=='' and $opnama<>''){
                    $tampil2="SELECT * FROM tour_msgrv                                                
                                WHERE $opnama LIKE '%$nama%'
                                AND GrvDateOfDep = '0000-00-00'                                                   
                                ORDER BY GrvDeadlineDeposit,GrvTourcode ASC,GrvDateOfDep ASC";}
            else if($opnama2<>'' and $opnama<>''){
                    $tampil2="SELECT * FROM tour_msgrv                                                
                                WHERE $opnama LIKE '%$nama%'
                                AND $opnama2 LIKE '%$nama2%' 
                                AND GrvDateOfDep = '0000-00-00'                                               
                                ORDER BY GrvDeadlineDeposit,GrvTourcode ASC,GrvDateOfDep ASC";}
            else if($optnama=='' and $optnama2==''){
                    $tampil2="SELECT * FROM tour_msgrv where GrvDateOfDep = '0000-00-00'                                              
                                ORDER BY GrvDeadlineDeposit,GrvTourcode ASC,GrvDateOfDep ASC";}
            }else{
            if($opnama=='' and $opnama2<>''){
                    $tampil2="SELECT * FROM tour_msgrv                                               
                                WHERE $opnama2 LIKE '%$nama2%'
                                AND Year(GrvDateOfDep) = '$yer' AND Month(GrvDateOfDep) = '$mont'              
                                ORDER BY GrvDeadlineDeposit,GrvTourcode ASC,GrvDateOfDep ASC";}
            else if($opnama2=='' and $opnama<>''){
                    $tampil2="SELECT * FROM tour_msgrv                                                
                                WHERE $opnama LIKE '%$nama%'
                                AND Year(GrvDateOfDep) = '$yer' AND Month(GrvDateOfDep) = '$mont'                
                                ORDER BY GrvDeadlineDeposit,GrvTourcode ASC,GrvDateOfDep ASC";}
            else if($opnama2<>'' and $opnama<>''){
                    $tampil2="SELECT * FROM tour_msgrv                                                
                                WHERE $opnama LIKE '%$nama%'
                                AND $opnama2 LIKE '%$nama2%'
                                AND Year(GrvDateOfDep) = '$yer' AND Month(GrvDateOfDep) = '$mont'              
                                ORDER BY GrvDeadlineDeposit,GrvTourcode ASC,GrvDateOfDep ASC";}
            else if($optnama=='' and $optnama2==''){
                    $tampil2="SELECT * FROM tour_msgrv where Year(GrvDateOfDep) = '$yer' AND Month(GrvDateOfDep) = '$mont'
                                ORDER BY GrvDeadlineDeposit,GrvTourcode ASC,GrvDateOfDep ASC";}    
            }
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=searchpnr";
                    // Link ke halaman sebelumnya (previous)
                    echo "<center><div id='paging'>";
                    if ($halaman >1) {
                        $previous = $halaman-1;
                        echo "<a href=$file&halaman=1&jenis=$jenis&opnama=$opnama&nama=$nama&opnama2=$opnama2&nama2=$nama2&bulan=$mont&year=$yer&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&jenis=$jenis&opnama=$opnama&nama=$nama&opnama2=$opnama2&nama2=$nama2&bulan=$mont&year=$yer&oke=$oke> < Previous</a> | ";
                    } else {
                        echo "<< First | < Previous | ";
                    }
                    // Tampilkan link halaman 1,2,3 ... modifikasi ala google
                    // Angka awal
                    $angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
                    for ($i=$halaman-2; $i<$halaman; $i++) {
                        if ($i < 1 )
                            continue;
                        $angka .= "<a href=$file&halaman=$i&jenis=$jenis&opnama=$opnama&nama=$nama&opnama2=$opnama2&nama2=$nama2&bulan=$mont&year=$yer&oke=$oke>$i</a> ";
                    }
                    // Angka tengah
                    $angka .= " <b>$halaman</b> ";
                    for ($i=$halaman+1; $i<($halaman+3); $i++) {
                        if ($i > $jmlhalaman)
                            break;
                        $angka .= "<a href=$file&halaman=$i&jenis=$jenis&opnama=$opnama&nama=$nama&opnama2=$opnama2&nama2=$nama2&bulan=$mont&year=$yer&oke=$oke>$i</a> ";
                    }
                    // Angka akhir
                    $angka .= ($halaman+2<$jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&jenis=$jenis&opnama=$opnama&nama=$nama&opnama2=$opnama2&nama2=$nama2&bulan=$mont&year=$yer&oke=$oke>$jmlhalaman</a> |" : " ");
                    // Cetak angka seluruhnya (awal, tengah, akhir)
                    echo "$angka";
                    // Link ke halaman berikutnya (Next)
                    if ($halaman < $jmlhalaman) {
                        $next = $halaman+1;
                        echo "<a href=$file&halaman=$next&jenis=$jenis&opnama=$opnama&nama=$nama&opnama2=$opnama2&nama2=$nama2&bulan=$mont&year=$yer&oke=$oke> Next ></a> |
                              <a href=$file&halaman=$jmlhalaman&jenis=$jenis&opnama=$opnama&nama=$nama&opnama2=$opnama2&nama2=$nama2&bulan=$mont&year=$yer&oke=$oke> Last >></a> ";
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
          }
     break;
                                   
// buat input baru  
  case "tambahgrv":
    $hariini = date("Y-m-d ");        
    $new_date = date('d-m-Y');
    $thisyear = date("Y");
    $nextyear = $thisyear+1;   
    echo "<h2>New Booking Flight</h2>
          <form name='tambah' onsubmit='return validateFormOnSubmit(this)' method='POST' action='./aksi.php?module=searchpnr&act=input'>
          <table>             
          <tr><td>Season</td> <td>  
            <select name='season'>
            <option value='0' selected>- Select Season -</option>";
            if(isset($_POST['redirected'])) { $seasonb=$_POST['season']; }  
            $tampil=mysql_query("SELECT * FROM tour_msseason where SeasonStatus='ACTIVE' ORDER BY SeasonName");
            while($r=mysql_fetch_array($tampil)){
                if($seasonb==$r[SeasonName]){
                    echo "<option value='$r[SeasonName]' selected>$r[SeasonName]</option>";     
                }else{
                    echo "<option value='$r[SeasonName]'>$r[SeasonName]</option>"; 
                }
                
            }
    echo "</select>
            <select name='year' id='year' onChange='mee()'>
            <option value='$thisyear' selected>$thisyear</option>
            <option value='$nextyear' >$nextyear</option>
            </select></td></tr>
          <tr><td>Airlines</td>     <td><select name='GrvAirlines' onChange='showPnr()'>
            <option value='0' selected>- Select Airlines -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msairlines ORDER BY AirlinesID");
            while($r=mysql_fetch_array($tampil)){          
                    echo "<option value='$r[AirlinesID]'>$r[AirlinesID] - $r[AirlinesName]</option>"; 
            }
    echo "</select></td></tr>
          <tr><td>Supplier Name</td><td><input type=text name='GrvSuppName'></td></tr>
          <tr><td>Destination</td><td><select name='GrvArea' onChange='showPnr()'>
            <option value='0' selected>- Select Area -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msproductcode group by ProductcodeDestination ORDER BY ProductcodeDestination ASC");
            while($r=mysql_fetch_array($tampil)){          
                    echo "<option value='$r[ProductcodeDestination]'>$r[ProductcodeDestination]</option>"; 
            }
    echo "</select></td></tr>
          <tr><td>PNR</td><td><input type=text name='GrvPnr'></td></tr>     
          <tr><td>Seat</td><td><input type=text name='GrvSeat' size='4' onkeyup='isNumber(this),Total()'></td></tr>
          <tr><td>Currency</td><td><select name='GrvAdlFareCurr' >";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            while($s=mysql_fetch_array($tampil)){ 
                if($s[curr]=='USD'){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";    
                } else {
                     echo "<option value='$s[curr]' >$s[curr]</option>";
                }
            }
    echo "</select></td></tr> 
          <tr><td style='vertical-align:middle';>Fare</td><td>
                  <table><tr><td><center>Adult</center></td><td><center>Child</center></td><td><center>Infant</center></td></tr>
                  <tr><td><center><input type=text name='GrvAdlFare' onkeyup='isNumber(this)' style='text-align:center'></center></td>
                    <td><center><input type=text name='GrvChdFare' onkeyup='isNumber(this)' style='text-align:center'></center></td>
                    <td><center><input type=text name='GrvInfFare' onkeyup='isNumber(this)' style='text-align:center'></center></td></tr></table>
            </td></tr>
          <tr><td>Fuel Surcharge</td><td><input type=text name='GrvFuelSurcharge' onkeyup='isNumber(this)'></td></tr>
          <tr><td>Tax</td><td><input type=text name='GrvTax' onkeyup='isNumber(this)'></td></tr>     
          <tr><td>Deposit Amount</td><td><input type=text name='GrvAmountSeat' onkeyup='isNumber(this),Total()'> / Seat</td></tr>
          <tr><td>Estimate Deposit</td><td><input type=text name='GrvAmount' onkeyup='isNumber(this)' style='text-align: left;font-weight:bold;border: 0px solid #000000;'></td></tr>
          <tr><td>FOC</td><td><input type=text name='GrvFoc' size='10'> PAX</td></tr>
          <tr><td>Deadline Deposit</td> <td><input type='text' name='GrvDeadlineDeposit' value='$new_date' size='10' onClick="."cal.select(document.forms['example'].GrvDeadlineDeposit,'ActIn1','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='ActIn1'>
          <font color='red'>(dd-mm-yyyy)</font></td></tr>
          <tr><td>Review Deposit</td> <td><input type='text' name='GrvReviewDeposit' value='$new_date' size='10' onClick="."cal.select(document.forms['example'].GrvReviewDeposit,'ActIn1','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='ActIn1'>
          <font color='red'>(dd-mm-yyyy)</font></td></tr>
          <tr><td>Remarks</td><td><textarea name='GrvRemarks' cols='50' rows='3'></textarea>  </td></tr>       
          </table>
          Flight Detail
          <br><input type=radio name='flightdetail' id='newdetail' value='newflight' onclick='editflight()' checked><font size=2>New</font>&nbsp&nbsp
            <input type=radio name='flightdetail' id='copydetail' value='copyflight' onclick='copyflight()' disabled><font size=2>Copy From</font> 
            <select name='copyidgrv' id='copyidgrv' disabled>
            <option value='0' selected>- No PNR -</option>
            </select>
          <table id='air' border='1'>
          <tr><th><img src='../images/add.png' class='cloneTableRows' /></th><th>Flight No</th><th>Class</th><th>Date</th><th>Dep</th><th>Arr</th><th>ETD</th><th>ETA</th><th>Cross</th><th>Status</th><th>Note</th></tr>   
          <tr>
          <td><img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' /></td>
          <td><select name='airline[]'><option value='' >- select -</option>";
            $tampila=mysql_query("SELECT * FROM tour_msairlines ORDER BY AirlinesID ASC");
            while($a=mysql_fetch_array($tampila)){   
                     echo "<option value='$a[AirlinesID]' >$a[AirlinesID]</option>";   
            }
    echo "</select>
          <input type='text' name='aircode[]' size='4'></td>
          <td><center><input type='text' name='airclass[]' size='3' maxlength='3' ></td>
          <td><input type='text' name='airdate[]' class='my_date' size='8' value='00-00-0000'></td>     
          <td><center><select name='airroutedep[]'><option value='' >- select city -</option>";
            $tampil2=mysql_query("SELECT * FROM tbl_city ");
            while($s2=mysql_fetch_array($tampil2)){   
                     echo "<option value='$s2[CityCode]' >$s2[CityCode] ($s2[CityName])</option>";   
            }
    echo "</select></td>
          <td><center><select name='airroutearr[]'><option value='' >- select city -</option>";
            $tampil2=mysql_query("SELECT * FROM tbl_city ");
            while($s2=mysql_fetch_array($tampil2)){   
                     echo "<option value='$s2[CityCode]' >$s2[CityCode] ($s2[CityName])</option>";   
            }
    echo "</select></td>
          <td><input type='text' name='airtimedep[]' size='4' maxlength='4' onkeyup='isNumber(this)'></td>
          <td><input type='text' name='airtimearr[]' size='4' maxlength='4' onkeyup='isNumber(this)'></td>
          <td><select name='aircross[]' >
              <option value='NO' selected>NO</option>
              <option value='YES'>YES</option>
              </select></td>
           <td><select name='airstatus[]' >
              <option value='HK' selected>HK</option>
              <option value='HL'>HL</option>
              </select></td>
          <td><input type='text' name='note[]'></td>        
          </tr>
          </table>
          
          <br><br>
          <center><input type=submit value='Submit'>
                            <input type=button value='Close' onclick=self.history.back()>         
          </form><br><br>";
     break;
    
  case "editgrv":
    $edit=mysql_query("SELECT * FROM tour_msgrv WHERE IDGrv='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    if($r[GrvDateOfDep]=='0000-00-00'){$GDOD='00-00-0000';}else{
    $GDOD = date('d M Y', strtotime($r[GrvDateOfDep]));}
    if($r[GrvDateOfArr]=='0000-00-00'){$GDOA='00-00-0000';}else{
    $GDOA = date('d M Y', strtotime($r[GrvDateOfArr]));}
    if($r[GrvDeadlineDeposit]=='0000-00-00'){$GDD='00-00-0000';}else{
    $GDD = date('d-m-Y', strtotime($r[GrvDeadlineDeposit]));}
    if($r[GrvReviewDeposit]=='0000-00-00'){$GRD='00-00-0000';}else{
    $GRD = date('d-m-Y', strtotime($r[GrvReviewDeposit]));}
    $ceking=mysql_query("SELECT * FROM tour_msproductpnr WHERE GrvID ='$r[IDGrv]'");
    $cekrow=mysql_num_rows($ceking);
    $thisyear = date("Y");
    $nextyear = $thisyear+1;  
    echo "<h2>Edit Booking Flight</h2>
          <form name='example' onsubmit='return validateFormOnSubmit(this)' method=POST action=./aksi.php?module=searchpnr&act=update>
          <input type=hidden name=id value='$r[IDGrv]'><input type=hidden name='terpakai' value='$cekrow'>
          <table style='border:0px;'><td style='border:0px;'>                                 
          <table>              
          <tr><td>Season</td> <td>  
            <select name='season'>
            <option value='0' selected>- Select Season -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msseason where SeasonStatus='ACTIVE' ORDER BY SeasonName");
            while($s=mysql_fetch_array($tampil)){
                if($r[Season]==$s[SeasonName]){
                    echo "<option value='$s[SeasonName]' selected>$s[SeasonName]</option>";
                }else {
                    echo "<option value='$s[SeasonName]'>$s[SeasonName]</option>";    
                }
            }
    echo "</select>
            <select name='year'>
            <option value=''>Select Year</option>
            <option value='$thisyear' ";if($r[Year]=="$thisyear"){echo"selected";}echo">$thisyear</option>
            <option value='$nextyear' ";if($r[Year]=="$nextyear"){echo"selected";}echo">$nextyear</option>
            </select></td></tr>      
          <tr><td>Airlines</td>";
            $tampil=mysql_query("SELECT * FROM tour_msairlines where AirlinesId='$r[GrvAirlines]' ORDER BY AirlinesID");   
            $s=mysql_fetch_array($tampil); 
    echo "<td>$s[AirlinesID] - $s[AirlinesName]</td></tr>
          <tr><td>Supplier Name</td><td><input type=text name='GrvSuppName' value='$r[GrvSuppName]'></td></tr>
          <tr><td>Destination</td><td>$r[GrvArea]</td></tr>
          <tr><td>PNR</td><td><input type=text name='GrvPnr' value='$r[GrvPnr]'></td></tr>
          <tr><td>Date of Dep</td> <td>";if($GDOD=='00-00-0000'){echo"NO DATE";}else{echo"<b>$GDOD</b> until <b>$GDOA</b>";}echo"</td></tr>  
          <tr><td>Seat</td><td><input type=text name='GrvSeat' size='4' value='$r[GrvSeat]' onkeyup='isNumber(this),Total()'></td></tr>
          <tr><td>Currency</td><td>$r[GrvAdlFareCurr]</td></tr><input type=hidden name='GrvAdlFareCurr' value='$r[GrvAdlFareCurr]'>
          <td style='vertical-align:middle';>Fare</td><td>
                  <table>";
                  if($cekrow > 0){
                  echo"<tr><td width='75'><center>Adult</center></td><td width='75'><center>Child</center></td><td width='75'><center>Infant</center></td></tr>
                  <tr><td><center><input type=hidden name='GrvAdlFare' value='$r[GrvAdlFare]'>$r[GrvAdlFare]</center></td>
                  <td><center><input type=hidden name='GrvChdFare' value='$r[GrvChdFare]'>$r[GrvChdFare]</center></td>
                  <td><center><input type=hidden name='GrvInfFare' value='$r[GrvInfFare]'>$r[GrvInfFare]</center></td></tr>";
                  }else{
                  echo"<tr><td><center>Adult</center></td><td><center>Child</center></td><td><center>Infant</center></td></tr>
                  <tr><td><center><input type=text name='GrvAdlFare' value='$r[GrvAdlFare]' onkeyup='isNumber(this)' style='text-align:center'></center></td>
                  <td><center><input type=text name='GrvChdFare' value='$r[GrvChdFare]' onkeyup='isNumber(this)' style='text-align:center'></center></td>
                  <td><center><input type=text name='GrvInfFare' value='$r[GrvInfFare]' onkeyup='isNumber(this)' style='text-align:center'></center></td></tr>";
                  }
            echo "</table>
          </td></tr>
          <tr><td>Fuel Surcharge</td><td><input type=text name='GrvFuelSurcharge' value='$r[GrvFuelSurcharge]' onkeyup='isNumber(this)'></td></tr>
          <tr><td>Tax</td><td><input type=text name='GrvTax' value='$r[GrvTax]' onkeyup='isNumber(this)'></td></tr>        
          <tr><td>Deposit Amount</td><td><input type=text name='GrvAmountSeat' value='$r[GrvAmountSeat]' onkeyup='isNumber(this),Total()'> / Seat</td></tr>
          <tr><td>Estimate Deposit</td><td><input type=text name='GrvAmount' value='$r[GrvAmount]' onkeyup='isNumber(this)' style='text-align: left;font-weight:bold;border: 0px solid #000000;'></td></tr>
          <tr><td>FOC</td><td>";if($cekrow > 0){echo"$r[GrvFoc]";}else{echo"<input type=text name='GrvFoc' value='$r[GrvFoc]' size='10'>";}echo" PAX</td></tr>
          <tr><td>Deadline Deposit</td> <td><input type='text' name='GrvDeadlineDeposit' value='$GDD' size='10' onClick="."cal.select(document.forms['example'].GrvDeadlineDeposit,'ActIn1','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='ActIn1'>
          <font color='red'>(dd-mm-yyyy)</font></td></tr>
          <tr><td>Review Deposit</td> <td><input type='text' name='GrvReviewDeposit' value='$GRD' size='10' onClick="."cal.select(document.forms['example'].GrvReviewDeposit,'ActIn1','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='ActIn1'>
          <font color='red'>(dd-mm-yyyy)</font></td></tr>
          <tr><td>Status</td><td>$r[GrvStatus]</tr> 
          <tr><td>Remarks</td><td><textarea name='GrvRemarks' cols='50' rows='3'>$r[GrvRemarks]</textarea>  </td></tr>       
          </table>
          </td><td style='border:0px;'>";
          //check ada deposit atau tidak
          $Deposit=mysql_query("SELECT * FROM tour_msgrvdepo where IDGrv='$r[IDGrv]' and Status<>'VOID' order by IDDep ");
          $JumDeposit=mysql_num_rows($Deposit);     
          
          if ($JumDeposit>0){
              $no=1;
            echo"<h3>DEPOSIT</h3>
            <table><th>No</th><th>Reff No</th><th>Supplier</th><th>Amount</th><th>Create by</th><th>Date</th>";
              while ($DepositDtl=mysql_fetch_array($Deposit)){
                 echo"<tr>
                            <td>$no</td>      
                            <td>$DepositDtl[RefNo]</td>
                            <td>$DepositDtl[SupplierName]</td>   
                            <td>$DepositDtl[Curr]. ".number_format($DepositDtl[DepAmount], 0, '', '.');echo"</td>
                            <td>$DepositDtl[InputBy]</td>
                            <td>$DepositDtl[InputDate]</td>                                                                                         
                  </tr>";
                  $no++;
              }
            echo"</table>";
          }
      $Product=mysql_query("SELECT * FROM tour_msproductpnr
                            left join tour_msproduct on tour_msproduct.IDProduct = tour_msproductpnr.PnrProd
                            where GrvID='$r[IDGrv]'  order by IDProduct ASC ");
      $JumProduct=mysql_num_rows($Product);

      if ($JumProduct>0){
          $no=1;
          echo"<h3>Product List</h3>
            <table><th>No</th><th>Tour Code</th><th>Seat</th><th>Seat Deposit</th>";
          while ($ProductDtl=mysql_fetch_array($Product)){
              echo"<tr>
                            <td>$no</td>
                            <td>$ProductDtl[TourCode]</td>
                            <td><center>$ProductDtl[Seat]</center></td>
                            <td><center>$ProductDtl[SeatDeposit]</center></td>
                  </tr>";
              $no++;
          }
          echo"</table>";
      }
          echo"</td></table>  
          Flight Detail";
          if($cekrow > 0){
    echo" <table border='1'>
          <tr><th>Flight No</th><th>Class</th><th>Date</th><th>Dep</th><th>Arr</th><th>ETD</th><th>ETA</th><th>Cross</th><th>Status</th><th>Note</th></tr>";   
           $i=0;
           $coba=mysql_query("SELECT * FROM tour_msprodflight where IDGrv ='$_GET[id]' order by FID ASC ");
            $baris=mysql_num_rows($coba);              
            while($tes=mysql_fetch_array($coba)){                  
            $al=substr($tes[AirCode],0,2);
            $ac=substr($tes[AirCode],2,8);
            if($tes[AirDate]=='0000-00-00'){$AD='00-00-0000';}else{
            $AD = date('d-m-Y', strtotime($tes[AirDate]));}
            $ATD = date('H.i', strtotime($tes[AirTimeDep]));
            $ATA = date('H.i', strtotime($tes[AirTimeArr]));
            echo"       
          <tr><td>$al $ac</td>
                     <td><center>$tes[AirClass]</td>
                     <td>$AD</td>        
                  <td><center>";
            $tampil=mysql_query("SELECT * FROM tbl_city ");
            while($sc=mysql_fetch_array($tampil)){   
                if($tes[AirRouteDep]==$sc[CityCode]){
                    echo "$sc[CityCode] ($sc[CityName])";    
                }    
            }
    echo "</td>
          <td><center>";
            $tampil=mysql_query("SELECT * FROM tbl_city ");
            while($s=mysql_fetch_array($tampil)){   
                if($tes[AirRouteArr]==$s[CityCode]){
                    echo "$s[CityCode] ($s[CityName])";    
                }  
            }
    echo "</td>
                  <td>$ATD</td>
                  <td>$ATA</td>
                  <td><center>$tes[AirCross]</center></td>
                  <td><center>$tes[AirStatus]</center></td>
                  <td><center>$tes[Note]</center></td>
                  </tr>";$i++;}    
    echo" </table>";
          //tampilan belom dipilih PNR
          }else {
    echo" <br><input type=radio name='flightdetail' value='editflight' onclick='editflight()' checked><font size=2>Edit</font>&nbsp&nbsp
            <input type=radio name='flightdetail' value='copyflight' onclick='copyflight()'><font size=2>Copy From</font> <select name='copyidgrv' disabled>
            <option value='0' selected>- Select PNR -</option>";     
           // copy quotation berdasarkan product code yang sama saja
            $tampil0=mysql_query("SELECT tour_msgrv.* FROM tour_msprodflight
                                left join tour_msgrv on tour_msgrv.IDGrv = tour_msprodflight.IDGrv   
                                WHERE tour_msprodflight.IDGrv <> '$r[IDGrv]'
                                AND tour_msgrv.GrvAirlines = '$r[GrvAirlines]'
                                AND tour_msgrv.GrvArea = '$r[GrvArea]'
                                group by tour_msprodflight.IDGrv order by tour_msgrv.GrvPnr ASC");
            while($r0=mysql_fetch_array($tampil0)){     
                    echo "<option value='$r0[IDGrv]'>$r0[GrvPnr]</option>"; 
            }
    echo "</select>
          <table id='air' border='1'>
          <tr><th><img src='../images/add.png' class='cloneTableRows' /></th><th>Flight No</th><th>Class</th><th>Date</th><th>Dep</th><th>Arr</th><th>ETD</th><th>ETA</th><th>Cross</th><th>Status</th><th>Note</th></tr>";   
           $i=0;
           $coba=mysql_query("SELECT * FROM tour_msprodflight where IDGrv ='$_GET[id]' order by FID ASC ");
            $baris=mysql_num_rows($coba);     
            if($baris>0){
            while($tes=mysql_fetch_array($coba)){              
            $al=substr($tes[AirCode],0,2);
            $ac=substr($tes[AirCode],2,8);
            if($tes[AirDate]=='0000-00-00'){$AD='00-00-0000';}else{
            $AD = date('d-m-Y', strtotime($tes[AirDate]));}
            echo"       
          <tr>
          <td><img src='../images/delete.png' alt='' class='delRow' $vis></td>
                     <td><select name='airline[]'>";
                     $tampila=mysql_query("SELECT * FROM tour_msairlines ORDER BY AirlinesID ASC");
                     while($a=mysql_fetch_array($tampila)){   
                         if($al==$a[AirlinesID]){
                             echo "<option value='$a[AirlinesID]' selected>$a[AirlinesID]</option>"; 
                         }else{
                             echo "<option value='$a[AirlinesID]' >$a[AirlinesID]</option>"; 
                         }    
                           
                             }
               echo "</select>
                     <input type='text' name='aircode[]' size='7' value='$ac'></td>
                     <td><center><input type='text' name='airclass[]' size='3' value='$tes[AirClass]' maxlength='3'></td>
                     <td><input type='text' name='airdate[]' class='my_date' value='$AD' size='8'></td>        
                  <td><center><select name='airroutedep[]'>";
            $tampil=mysql_query("SELECT * FROM tbl_city ");
            while($sc=mysql_fetch_array($tampil)){   
                if($tes[AirRouteDep]==$sc[CityCode]){
                    echo "<option value='$sc[CityCode]' selected>$sc[CityCode] ($sc[CityName])</option>";    
                }else{
                    echo "<option value='$sc[CityCode]' >$sc[CityCode] ($sc[CityName])</option>";     
                }      
            }
    echo "</select></td>
          <td><center><select name='airroutearr[]'>";
            $tampil=mysql_query("SELECT * FROM tbl_city ");
            while($s=mysql_fetch_array($tampil)){   
                if($tes[AirRouteArr]==$s[CityCode]){
                    echo "<option value='$s[CityCode]' selected>$s[CityCode] ($s[CityName])</option>";    
                }else{
                    echo "<option value='$s[CityCode]' >$s[CityCode] ($s[CityName])</option>";     
                }     
            }
    echo "</select></td>
                  <td><input type='text' name='airtimedep[]' size='4' value='$tes[AirTimeDep]' maxlength='4' onkeyup='isNumber(this)'></td>
                  <td><input type='text' name='airtimearr[]' size='4' value='$tes[AirTimeArr]' maxlength='4' onkeyup='isNumber(this)'></td>
                  <td><select name='aircross[]' >
                      <option value='YES'";if($tes[AirCross]=='YES'){echo"selected";}echo">YES</option>
                      <option value='NO'";if($tes[AirCross]=='NO'){echo"selected";}echo">NO</option>
                      </select></td>
                      <td><select name='airstatus[]' >
                      <option value='HK'";if($tes[AirStatus]=='HK'){echo"selected";}echo">HK</option>
                      <option value='HL'";if($tes[AirStatus]=='HL'){echo"selected";}echo">HL</option>
                      </select></td>
                  <td><input type='text' name='note[]' value='$tes[Note]'></td>
                  </tr>";$i++;}
            }else{echo"
            <tr>
         <td><img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' /></td>
         <td><select name='airline[]'>";
                     $tampila=mysql_query("SELECT * FROM tour_msairlines ORDER BY AirlinesID ASC");
                     while($a=mysql_fetch_array($tampila)){                            
                             echo "<option value='$a[AirlinesID]' >$a[AirlinesID]</option>"; 
                             }
               echo "</select>
               <input type='text' name='aircode[]' size='7'></td>
         <td><center><input type='text' name='airclass[]' size='3' maxlength='3' ></td>
         <td><input type='text' name='airdate[]' class='my_date'  size='8'></td>    
          <td><center><select name='airroutedep[]'>";
            $tampil=mysql_query("SELECT * FROM tbl_city ORDER BY CityName ASC");
            while($s=mysql_fetch_array($tampil)){   
                     echo "<option value='$s[CityCode]' >$s[CityCode] ($s[CityName])</option>";   
            }
    echo "</select></td>
          <td><center><select name='airroutearr[]'>";
            $tampil=mysql_query("SELECT * FROM tbl_city ORDER BY CityName ASC");
            while($s=mysql_fetch_array($tampil)){   
                     echo "<option value='$s[CityCode]' >$s[CityCode] ($s[CityName])</option>";   
            }
    echo "</select></td>
          <td><input type='text' name='airtimedep[]' size='4' maxlength='4' onkeyup='isNumber(this)'></td>
          <td><input type='text' name='airtimearr[]' size='4' maxlength='4' onkeyup='isNumber(this)'></td>
          <td><select name='aircross[]' >
              <option value='NO' selected>NO</option>
              <option value='YES'>YES</option>              
              </select></td>
           <td><select name='airstatus[]' >
              <option value='HK' selected>HK</option>
              <option value='HL'>HL</option>
              </select></td>
          <td><input type='text' name='note[]'></td>
          </tr>";    
            }
    echo" </table>";
          }
    echo" <br><br>
          <center><input type=submit value='Submit'>
          <input type=button value='Close' onclick=location.href='?module=searchpnr'>
          </form>";
    break; 
    
case "deletepnr":    
     $username=$_SESSION[employee_code];
     $sqluser=mysql_query("SELECT employee_name,employee_code FROM tbl_msemployee WHERE employee_code='$username'");
     $tampiluser=mysql_fetch_array($sqluser);
     $EmpName="$tampiluser[employee_name] ($tampiluser[employee_code])";    
     $today = date("Y-m-d G:i:s");
     $edit=mysql_query("UPDATE tour_msgrv set GrvStatus='VOID' WHERE IDGrv = '$_GET[id]'");
     $Description="VOID PNR $_GET[pnr]";
     $menghapus=mysql_query("DELETE from tour_msproductpnr WHERE GrvID = '$_GET[id]'");
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=searchpnr'>";   
     break;          
     
case "voiddep":    
     $username=$_SESSION[employee_code];
     $sqluser=mysql_query("SELECT employee_name,employee_code FROM tbl_msemployee WHERE employee_code='$username'");
     $tampiluser=mysql_fetch_array($sqluser);
     $EmpName="$tampiluser[employee_name] ($tampiluser[employee_code])";    
     $today = date("Y-m-d G:i:s");
     $editg=mysql_query("SELECT * FROM tour_msgrvdepo WHERE IDDep='$_GET[id]'");
     $rg=mysql_fetch_array($editg);
     $idgrv=$rg[IDGrv];
     $edit=mysql_query("UPDATE tour_msgrvdepo set Status='VOID',UpdateBy='$EmpName',UpdateDate='$today' WHERE IDDep = '$_GET[id]'");
     $Description="VOID DEPOSIT ID ($_GET[id])";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=searchpnr&act=managegrv&id=$idgrv'>";   
     break;                         
     
case "viewgrv":
    $edit=mysql_query("SELECT * FROM tour_msgrv WHERE IDGrv='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $GDOD = date('d M Y', strtotime($r[GrvDateOfDep]));
    $GDD = date('d-m-Y', strtotime($r[GrvDeadlineDeposit]));  
    echo "<h2>Booking Flight</h2>
          <input type=hidden name=id value='$r[IDGrv]'>                                 
          <table>              
          <tr><td width='150px'>Airlines</td><td width='600px'>$r[AirlinesID] - $r[AirlinesName]</td></tr>
          <tr><td>Destination</td><td>$r[GrvArea]</td></tr>
          <tr><td>PNR</td><td>$r[GrvPnr]</td></tr>
          <tr><td>Date of Dep</td> <td>$GDOD</td></tr>  
          <tr><td>Seat</td><td>$r[GrvSeat]</td></tr>
          <tr><td>Currency</td><td>$r[GrvAdlFareCurr]</td></tr>
          <td style='vertical-align:middle';>Fare</td><td>
          <table  width='100%'><tr><td><center>Adult</center></td><td><center>Child</center></td><td><center>Infant</center></td></tr>
                  <tr><td width='100px'><center>$r[GrvAdlFare]</center></td>
                    <td width='100px'><center>$r[GrvChdFare]</center></td>
                    <td width='100px'><center>$r[GrvInfFare]</center></td></tr></table>
                    </td></tr>
          <tr><td>Tax</td><td>$r[GrvTax]</td></tr>
          <tr><td>FOC</td><td>$r[GrvFoc]</td></tr>
          <tr><td>Deadline Deposit</td> <td>$GDD &nbsp;&nbsp;<font color='red'>(dd-mm-yyyy)</font></td></tr>
          <tr><td>Deposit Amount</td><td>$r[GrvAmountSeat] / Seat</td></tr>
          <tr><td>Deposit Total</td><td>$r[GrvAmount]</td></tr>
          <tr><td>Status</td><td>$r[GrvStatus]</tr> 
          <tr><td>Remarks</td><td>$r[GrvRemarks]</td></tr>       
          </table> ";                                                                 
              $no=1;
               $coba=mysql_query("SELECT * FROM tour_msprodflight where IDGrv ='$_GET[id]' order by FID ASC ");
            $baris=mysql_num_rows($coba);   
            echo"Flight Detail
            <table border='1'>
          <tr><th>Flight No</th><th>Class</th><th>Date</th><th>Dep</th><th>Arr</th><th>ETD</th><th>ETA</th><th>Cross</th><th>Status</th><th>Note</th></tr>";   
           $i=0;                   
            while($tes=mysql_fetch_array($coba)){                  
            $al=substr($tes[AirCode],0,2);
            $ac=substr($tes[AirCode],2,8);
            $AD = date('d-m-Y', strtotime($tes[AirDate]));
            $ATD = date('H.i', strtotime($tes[AirTimeDep]));
            $ATA = date('H.i', strtotime($tes[AirTimeArr]));
            echo"       
          <tr><td>$al $ac</td>
                     <td><center>$tes[AirClass]</td>
                     <td>$AD</td>        
                  <td><center>";
            $tampil=mysql_query("SELECT * FROM tbl_city ");
            while($sc=mysql_fetch_array($tampil)){   
                if($tes[AirRouteDep]==$sc[CityCode]){
                    echo "$sc[CityCode] ($sc[CityName])";    
                }    
            }
    echo "</td>
          <td><center>";
            $tampil=mysql_query("SELECT * FROM tbl_city ");
            while($s=mysql_fetch_array($tampil)){   
                if($tes[AirRouteArr]==$s[CityCode]){
                    echo "$s[CityCode] ($s[CityName])";    
                }  
            }
    echo "</td>
                  <td>$ATD</td>
                  <td>$ATA</td>
                  <td><center>$tes[AirCross]</center></td>
                  <td><center>$tes[AirStatus]</center></td>
                  <td><center>$tes[Note]</center></td>
                  </tr>";$i++;}    
    echo" </table> 
            <br><br>
          <center><input type=button value='CLOSE' onclick=self.history.back()></input>";
    break; 
     
case "managegrv":
    $id=$_GET[id];
    $edit=mysql_query("SELECT * FROM tour_msgrv WHERE IDGrv = '$id'");
    $r=mysql_fetch_array($edit); 
    $cur=$r[GrvAdlFareCurr];                              
    echo "<h2>Deposit for PNR: $r[GrvPnr]</h2>";
          $mencari=mysql_query("SELECT * FROM tour_msgrvdepo WHERE IDGrv ='$id' order by IDDep ASC");
          $adakah=mysql_num_rows($mencari);        
          if($adakah<1){
              echo"<i>** DEPOSIT NOT FOUND **</i>";
          }else{echo"
              <table><tr><th>No</th><th>Reff NO</th><th>Dep Date</th><th>amount</th><th>action</th><tr>";
              $r=1;
              while($tunjukan=mysql_fetch_array($mencari)){
                $DD = date('d M Y', strtotime($tunjukan[DepDate]));
                if($tunjukan[Status]=='VOID'){$kl='disabled';}else{$kl='enabled';}
                $refno=str_replace(" ", "_", $tunjukan[RefNo]);
                echo"<tr><td>$r</td><td>$tunjukan[RefNo]</td><td>$DD</td><td>$cur. $tunjukan[DepAmount]</td>
                <td><input type='button' value='VOID' onclick=voiddep('$tunjukan[IDDep]','$refno') $kl></td></tr>";
                $r++;    
              }echo"</table>";
          }
    echo "<h2>Add Deposit</h2>                      
          <form method='POST' name='example' action=./aksi.php?module=grvdeposit&act=input>
          <input type='hidden' name='id' value='$id'><input type='hidden' name='curr' value='$cur'>   
          <table>
          <tr><td>Deposit Date</td><td><input type='text' name='depdate' size='10' onClick="."cal.select(document.forms['example'].depdate,'ActIn1','dd-MM-yyyy'); return false;"." NAME='anchor1' ID='ActIn1' required>
          <font color='red'>(dd-mm-yyyy)</font></td></tr>
          <tr><td>Reff No</td><td><input type='text' name='refno' required><font color='red'><i> ex: LG NO, VMPD, etc</i></font></td></tr>  
          <tr><td>Amount</td><td>$cur <input type='text' name='depamount' onkeyup='isNumber(this)' required></td></tr> 
          <tr><td colspan='2'><center><input type=submit value='Add'></td></tr>
          </table>
          <center><input type=button value=Back onclick=location.href='?module=searchpnr'>";
    break;

} 
?>
