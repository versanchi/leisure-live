<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>         
<script type="text/javascript" src="../head/editable-select.js"></script> 
<script language="JavaScript"  type="text/javascript">   
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
//-->
</SCRIPT>
<?php 
switch($_GET[act]){
  // Tampil Office
  default:
      $hariini = date("Y-m-d ");
      $nama=$_GET['nama'];
      $opnama=$_GET['opnama'];
	  if($opnama==''){$opnama='PaxName';}
      $qnama=str_replace(" ", "%",$nama);
    echo "<h2>SEARCH PAX NAME </h2>
          Search By :  
          <form method='get' action='media.php?'>
                <input type=hidden name=module value='searchpaxname'>
				<select name='opnama'>
                                    <option value='PaxName'";if($opnama=='PaxName'){echo"selected";}echo">Pax Name</option>
                                    <option value='BirthDate'";if($opnama=='BirthDate'){echo"selected";}echo">Birth date</option>
                                    <option value='PassportNo'";if($opnama=='PassportNo'){echo"selected";}echo">Passport</option>
              </select> <input type=text name='nama' value='$nama' size=20><br>
              <input type=submit name='oke' size='20'value='Search'>
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
                                WHERE tbl_msemployee.employee_code = '$_SESSION[employee_code]'");
            $filter=mysql_fetch_array($filt);
            $team=$filter[office_code];
            
          
              $tampil=mysql_query("SELECT * FROM tour_msbookingdetail
								  inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbookingdetail.IDTourcode
                                WHERE $opnama LIKE '%$qnama%'  and tour_msbookingdetail.status<>'CANCEL'   
                                ORDER BY IDDetail desc LIMIT $posisi,$batas");    
			
			
		
            $jumlah=mysql_num_rows($tampil);          
			 
            if ($jumlah > 0 and $nama<>'') {
            echo "  <table>   
                    <tr><th>no</th><th>BookingID</th><th>Tour code</th><th>Destination</th><th>Pax Name</th><th>Birth Place</th><th>Birth Date</th><th>Passport No</th><th>Passport Valid</th></tr>";                   
				  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
					
                     echo "<tr><td $warna>$no</td>
                     <td $warna>$data[BookingID]</td>                                   
                     <td $warna>$data[TourCode]</td>
					 <td $warna>$data[Destination]</td>
                     <td $warna>$data[Title]. $data[PaxName]</td>
                     <td $warna><center>$data[BirthPlace]</td>
                     <td $warna><center>".date("d-m-Y", strtotime($data[BirthDate]))."</td>
                     <td $warna><center>$data[PassportNo]</td>
                     <td $warna><center>".date("d-m-Y", strtotime($data[PassportValid]))."</td>
                     </tr>";
                      $no++;
                    }
                    echo "</table>";
                    
                    // Langkah 3            
                    
					 $tampil2=mysql_query("SELECT * FROM tour_msbookingdetail
                                WHERE $opnama LIKE '%$qnama%' and status<>'CANCEL'");    
                    $jmldata    = mysql_num_rows($tampil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=searchpaxname";
                    $namas=str_replace(" ", "+", $nama);
                   
                    // Link ke halaman sebelumnya (previous)
                    echo "<center><div id='paging'>";
                    if ($halaman >1) {
                        $previous = $halaman-1;
                        echo "<a href=$file&halaman=1&group=$grup&opnama=$opnama&nama=$namas&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&group=$grup&opnama=$opnama&nama=$namas&oke=$oke> < Previous</a> | ";
                    } else {
                        echo "<< First | < Previous | ";
                    }
                    // Tampilkan link halaman 1,2,3 ... modifikasi ala google
                    // Angka awal
                    $angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
                    for ($i=$halaman-2; $i<$halaman; $i++) {
                        if ($i < 1 )
                            continue;
                        $angka .= "<a href=$file&halaman=$i&group=$grup&opnama=$opnama&nama=$namas&oke=$oke>$i</a> ";
                    }
                    // Angka tengah
                    $angka .= " <b>$halaman</b> ";
                    for ($i=$halaman+1; $i<($halaman+3); $i++) {
                        if ($i > $jmlhalaman)
                            break;
                        $angka .= "<a href=$file&halaman=$i&group=$grup&opnama=$opnama&nama=$namas&oke=$oke>$i</a> ";    
                    }
                    // Angka akhir
                    $angka .= ($halaman+2<$jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&group=$grup&opnama=$opnama&nama=$namas&oke=$oke>$jmlhalaman</a> |" : " ");
                    // Cetak angka seluruhnya (awal, tengah, akhir)
                    echo "$angka";
                    // Link ke halaman berikutnya (Next)
                    if ($halaman < $jmlhalaman) {
                        $next = $halaman+1;
                        echo "<a href=$file&halaman=$next&group=$grup&opnama=$opnama&nama=$namas&oke=$oke> Next ></a> |
                              <a href=$file&halaman=$jmlhalaman&group=$grup&opnama=$opnama&nama=$namas&oke=$oke> Last >></a> ";
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
