
<?php
$CompanyID=$_SESSION['company_id'];
switch($_GET[act]){
  // Tampil productcode
  default:
    $hariini = date("Y-m-d ");
    $nama=$_GET['nama'];
    $nama2=$_GET['nama2'];
    $opnama=$_GET['opnama'];
    $opnama2=$_GET['opnama2'];
    echo "<h2>Report GRV</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='rptgrv'>
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
 
          // Langkah 1
          $batas = 10;
          $halaman= $_GET['halaman'];
          if(empty($halaman)){
              $posisi  = 0;
            $halaman = 1;
          } else {
              $posisi = ($halaman-1) * $batas; }
            
            // Langkah 2                                 
            if($opnama=='' and $opnama2<>''){
                    $tampil=mysql_query("SELECT * FROM tour_msgrv                                               
                                WHERE $opnama2 LIKE '%$nama2%' 
                                AND grvDateOfDep >= '$hariini' and CompanyID=$CompanyID               
                                ORDER BY GrvDateOfDep ASC LIMIT $posisi,$batas");}
            else if($opnama2=='' and $opnama<>''){
                    $tampil=mysql_query("SELECT * FROM tour_msgrv                                                
                                WHERE $opnama LIKE '%$nama%'
                                AND grvDateOfDep >= '$hariini' and CompanyID=$CompanyID               
                                ORDER BY GrvDateOfDep ASC LIMIT $posisi,$batas");}
            else if($opnama2<>'' and $opnama<>''){
                    $tampil=mysql_query("SELECT * FROM tour_msgrv                                                
                                WHERE $opnama LIKE '%$nama%'
                                AND $opnama2 LIKE '%$nama2%' 
                                AND grvDateOfDep >= '$hariini' and CompanyID=$CompanyID            
                                ORDER BY GrvDateOfDep ASC LIMIT $posisi,$batas");}
            else if($optnama=='' and $optnama2==''){
                    $tampil=mysql_query("SELECT * FROM tour_msgrv where grvDateOfDep >= '$hariini' and CompanyID=$CompanyID
										ORDER BY GrvDateOfDep ASC LIMIT $posisi,$batas");}
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "<table>
                  <tr><th>no</th><th>Airlines</th><th>Area</th><th>Date Of Dep</th>
                  <th>Seat</th><th>PNR</th><th>Product</th><th>booking pax</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
                    $GDOD = date('d M Y', strtotime($data[GrvDateOfDep]));
                    $GDD = date('d M Y', strtotime($data[GrvDeadlineDeposit])); 
                    $cprod=mysql_query("SELECT * FROM tour_msproductpnr                                               
                                WHERE GrvID = '$data[IDGrv]'              
                                ORDER BY PnrID ASC ");
                    $jprod=mysql_num_rows($cprod);
                    $grandpax=0;
                    while ($dprod=mysql_fetch_array($cprod)){
                        $itung=mysql_query("SELECT sum(AdultPax+ChildPax) as subpax FROM tour_msbooking                                               
                                WHERE IDTourcode = '$dprod[PnrProd]'
                                AND Status <> 'VOID'
                                AND BookingStatus = 'DEPOSIT'
								AND TCCompanyID=$CompanyID
                                ORDER BY IDBookers ASC ");
                        $itungan=mysql_fetch_array($itung);
                        $grandpax=$grandpax+$itungan[subpax];    
                    }
                    if($data[GrvStatus]=='VOID'){$grvstatus="<font color=red><b>VOID</b></font>";}
                    else if($data[GrvStatus]=='NONE'){$grvstatus="<i>- NONE -</i>";}
                    else {$grvstatus="$data[GrvStatus]";}      
               echo "<tr><td>$no</td>
                     <td><center>$data[GrvAirlines]</td>
                     <td><center>$data[GrvArea]</td>
                     <td><center>$GDOD</td>                   
                     <td><center>$data[GrvSeat]</td> 
                     <td><center>$data[GrvPnr]</td>
                     <td><center>$jprod</td>
                     <td><center>$grandpax</td>
                     ";
                    
                    $edit1=mysql_query("SELECT * FROM tour_msgrv WHERE IDGrv ='$data[IDGrv]' and GrvStatus <>'VOID' AND TCCompany=$CompanyID");  
                    $r2=mysql_num_rows($edit1);             
               echo" </tr>";
                      $no++;
                    } 
                    echo"        
                    
                    </table>
                    <iframe src='grvprint.php?opnama=$opnama&nama=$nama&opnama2=$opnama2&nama2=$nama2&oke=Search' name='grvprint' style='visibility: hidden' height='0' width='0' frameborder='0'>
                    </iframe>
                    <center><input type='button' value='PRINT' onClick=frames['grvprint'].print() ><center><br>";
                    
                    // Langkah 3                         
                    if($opnama=='' and $opnama2<>''){
                    $tampil2    = "SELECT * FROM tour_msgrv                                               
                                WHERE $opnama2 LIKE '%$nama2%' 
                                AND grvDateOfDep >= '$hariini'
								AND TCCompany=$CompanyID
                                ORDER BY GrvDateOfDep ASC";}
                    else if($opnama2=='' and $opnama<>''){
                    $tampil2    = "SELECT * FROM tour_msgrv                                                
                                WHERE $opnama LIKE '%$nama%' 
                                AND grvDateOfDep >= '$hariini'
								AND TCCompany=$CompanyID
                                ORDER BY GrvDateOfDep ASC";}
                    else if($opnama2<>'' and $opnama<>''){
                    $tampil2    = "SELECT * FROM tour_msgrv                                              
                                WHERE $opnama LIKE '%$nama%'
                                AND $opnama2 LIKE '%$nama2%' 
                                AND grvDateOfDep >= '$hariini'
								AND TCCompany=$CompanyID
                                ORDER BY GrvDateOfDep ASC";}
                    else if($optnama=='' and $optnama2==''){
                    $tampil2    = "SELECT * FROM tour_msgrv where grvDateOfDep >= '$hariini' AND TCCompany=$Company                                   ORDER BY GrvDateOfDep ASC";}
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=rptgrv";
                    // Link ke halaman sebelumnya (previous)
                    echo "<center><div id='paging'>";
                    if ($halaman >1) {
                        $previous = $halaman-1;
                        echo "<a href=$file&halaman=1&opnama=$opnama&nama=$nama&opnama2=$opnama2&nama2=$nama2&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&opnama=$opnama&nama=$nama&opnama2=$opnama2&nama2=$nama2&oke=$oke> < Previous</a> | ";
                    } else {
                        echo "<< First | < Previous | ";
                    }
                    // Tampilkan link halaman 1,2,3 ... modifikasi ala google
                    // Angka awal
                    $angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
                    for ($i=$halaman-2; $i<$halaman; $i++) {
                        if ($i < 1 )
                            continue;
                        $angka .= "<a href=$file&halaman=$i&opnama=$opnama&nama=$nama&opnama2=$opnama2&nama2=$nama2&oke=$oke>$i</a> ";
                    }
                    // Angka tengah
                    $angka .= " <b>$halaman</b> ";
                    for ($i=$halaman+1; $i<($halaman+3); $i++) {
                        if ($i > $jmlhalaman)
                            break;
                        $angka .= "<a href=$file&halaman=$i&opnama=$opnama&nama=$nama&opnama2=$opnama2&nama2=$nama2&oke=$oke>$i</a> ";    
                    }
                    // Angka akhir
                    $angka .= ($halaman+2<$jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&opnama=$opnama&nama=$nama&opnama2=$opnama2&nama2=$nama2&oke=$oke>$jmlhalaman</a> |" : " ");
                    // Cetak angka seluruhnya (awal, tengah, akhir)
                    echo "$angka";
                    // Link ke halaman berikutnya (Next)
                    if ($halaman < $jmlhalaman) {
                        $next = $halaman+1;
                        echo "<a href=$file&halaman=$next&opnama=$opnama&nama=$nama&opnama2=$opnama2&nama2=$nama2&oke=$oke> Next ></a> |
                              <a href=$file&halaman=$jmlhalaman&opnama=$opnama&nama=$nama&opnama2=$opnama2&nama2=$nama2&oke=$oke> Last >></a> ";
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
