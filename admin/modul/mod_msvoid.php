<script language="JavaScript"  type="text/javascript">
     
function voidfile(ID, File)
{
if (confirm("Are you sure want to VOID Settlement No '" + File + "'"))
{
 window.location.href = '?module=msvoid&act=addmsvoid&id=' + ID;
 
} 
}
</script>

<?php 
switch($_GET[act]){
  // Tampil Visa
  default:
      $nama=$_GET['nama'];
    $tampil2=mysql_query("SELECT job_desc FROM tbl_msemployee WHERE employee_username='$_SESSION[namauser]'");
            $hasil2=mysql_fetch_object($tampil2);
            $JobDesc=$hasil2->job_desc;
            
    echo "<h2>Void Settlement</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='msvoid'>
              <input type=text name=nama value='$nama' size=40>    
              <input type=submit name=oke value=Search>
          </form>";
          $username=$_SESSION[namauser];
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
            $tampil=mysql_query("SELECT KasNo,PRVCode,PRVNo,PRVCurr,PRVDate,SUM(PRVAmount)as Total FROM logsettle                                                  
                                WHERE (PRVNo LIKE '%$nama%'
                                OR PRVDate LIKE '%$nama%')  
                                Group BY PRVCode ASC LIMIT $posisi,$batas");
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "<table>
                    <tr><th>no</th><th>date</th><th>Settlement no.</th><th>Cash Adv No</th><th>Amount</th><th>action</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){    
               echo "<tr><td>$no</td>
                     <td>$data[PRVDate]</td>
                     <td>$data[PRVNo]</td>
                     <td>$data[KasNo]</td>
                     <td>$data[PRVCurr]$data[Total]</td>  
                     <td><center><a href=\"javascript:voidfile('$data[SettleId]','$data[PRVNo]')\">Void</a></tr>";
                      $no++;
                    }
                    echo "</table>";
                    
                    // Langkah 3            
                    $tampil2    = "SELECT * FROM logsettle                                                  
                                WHERE (PRVNo LIKE '%$nama%'
                                OR PRVDate LIKE '%$nama%')  
                                Group BY PRVCode ASC ";
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=msvoid";
                    // Link ke halaman sebelumnya (previous)
                    echo "<center><div id='paging'>";
                    if ($halaman >1) {
                        $previous = $halaman-1;
                        echo "<a href=$file&halaman=1&nama=$nama&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&nama=$nama&oke=$oke> < Previous</a> | ";
                    } else {
                        echo "<< First | < Previous | ";
                    }
                    // Tampilkan link halaman 1,2,3 ... modifikasi ala google
                    // Angka awal
                    $angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
                    for ($i=$halaman-2; $i<$halaman; $i++) {
                        if ($i < 1 )
                            continue;
                        $angka .= "<a href=$file&halaman=$i&nama=$nama&oke=$oke>$i</a> ";
                    }
                    // Angka tengah
                    $angka .= " <b>$halaman</b> ";
                    for ($i=$halaman+1; $i<($halaman+3); $i++) {
                        if ($i > $jmlhalaman)
                            break;
                        $angka .= "<a href=$file&halaman=$i&nama=$nama&oke=$oke>$i</a> ";    
                    }
                    // Angka akhir
                    $angka .= ($halaman+2<$jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&nama=$nama&oke=$oke>$jmlhalaman</a> |" : " ");
                    // Cetak angka seluruhnya (awal, tengah, akhir)
                    echo "$angka";
                    // Link ke halaman berikutnya (Next)
                    if ($halaman < $jmlhalaman) {
                        $next = $halaman+1;
                        echo "<a href=$file&halaman=$next&nama=$nama&oke=$oke> Next ></a> |
                              <a href=$file&halaman=$jmlhalaman&nama=$nama&oke=$oke> Last >></a> ";
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
  
   case "addmsvoid":    
    
    $edit=mysql_query("update msvisa set StatCancel=1 WHERE Id = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msvoid'>";   
     break; 
    
    
 
}
?>
