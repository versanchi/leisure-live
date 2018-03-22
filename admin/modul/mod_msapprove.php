<script language="JavaScript"  type="text/javascript">
     
function approvefile(ID, File)
{
if (confirm("Are you sure want to Approve Settlement No '" + File + "'"))
{
 window.location.href = '?module=msapprove&act=addmsapprove&id=' + ID;
 
} 
}
function voidfile(ID, File)
{
if (confirm("Are you sure want to UN-APPROVE Settlement No '" + File + "'"))
{
 window.location.href = '?module=msapprove&act=addmsvoid&id=' + ID;
 
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
            
    echo "<h2>Approval Settlement</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='msapprove'>
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
            $tampil=mysql_query("SELECT logsettle.KasNo,logsettle.PRVCode,logsettle.PRVNo,logsettle.PRVCurr,logsettle.PRVDate,SUM(logsettle.PRVAmount)as Total FROM logsettle                                                  
                                left JOIN logkasbon ON logkasbon.DONo = logsettle.DONo
                                WHERE (PRVNo LIKE '%$nama%'
                                OR PRVDate LIKE '%$nama%')
                                AND logsettle.statuslog ='0'
                                AND logkasbon.statuslog ='0' 
                                AND logsettle.KasNo = logkasbon.KasNo 
                                Group BY logsettle.PRVCode 
                                order by logsettle.PRVDate Desc, logsettle.PRVNo DESC LIMIT $posisi,$batas");
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
                     <td><center><a href=\"javascript:approvefile('$data[PRVCode]','$data[PRVNo]')\"><img src='../images/approve.gif'></a>&nbsp
                    | &nbsp<a href=\"javascript:voidfile('$data[PRVCode]','$data[PRVNo]')\"><img src='../images/cancel.gif'></a></tr>";
                      $no++;
                    }
                    echo "</table>";
                    
                    // Langkah 3            
                    $tampil2    = "SELECT logsettle.KasNo,logsettle.PRVCode,logsettle.PRVNo,logsettle.PRVCurr,logsettle.PRVDate,SUM(logsettle.PRVAmount)as Total FROM logsettle                                                  
                                left JOIN logkasbon ON logkasbon.DONo = logsettle.DONo
                                WHERE (PRVNo LIKE '%$nama%'
                                OR PRVDate LIKE '%$nama%')
                                AND logsettle.statuslog ='0'
                                AND logkasbon.statuslog ='0' 
                                AND logsettle.KasNo = logkasbon.KasNo 
                                Group BY logsettle.PRVCode  ";
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=msapprove";
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
  
    case "addmsapprove":   //approve 
    $inputdate = date("Y-m-d", time());       
    $edit=mysql_query("update logsettle set statuslog ='1' , AppDate='$inputdate' WHERE PRVCode = '$_GET[id]'");
    $tampil=mysql_query("SELECT * FROM logsettle                                                 
                                WHERE PRVCode = '$_GET[id]'");
    while ($data=mysql_fetch_array($tampil)){
        
        $tampi=mysql_query("SELECT * FROM msvisa                                                 
                                WHERE DONo = '$data[DONo]'");
        $dat=mysql_fetch_array($tampi);
        mysql_query("UPDATE logwo SET Status = '1'
                               WHERE DONo = '$dat[DONo]' 
                               AND WONo = '$dat[WONo]' ");
        if($dat[NettAmount]<>0){   
         mysql_query("UPDATE msvisa SET KasNo = '',    
                                    Status = '0',
                                    PRVNo = '',
                                    AppDate='$inputdate'
                               WHERE DONo = '$dat[DONo]'
                               AND ($data[PRVAmount] = '0'
                               OR $data[PRVAmount] = '') "); 
         mysql_query("UPDATE msvisa SET 
                                AppDate='$inputdate'
                               WHERE DONo = '$dat[DONo]'
                               AND ($data[PRVAmount] <> '0'
                               OR $data[PRVAmount] <> '') ");               
         }else if($dat[NettAmount]==0){   
         mysql_query("UPDATE msvisa AppDate='$inputdate'
                               WHERE DONo = '$dat[DONo]'
                               AND ($data[PRVAmount] <> '0'
                               OR $data[PRVAmount] <> '') "); 
                       
         } 
    }    
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msapprove'>";   
     break; 
    
  case "addmsvoid":  //un-approve          
    
    /*$dua=mysql_query("SELECT msvisa.DONo,logsettle.AppDate,logsettle.PRVDate FROM `logsettle`       
    left join msvisa on logsettle.DONo = msvisa.DONo    
    where msvisa.DONo = logsettle.DONo AND msvisa.PRVNo = logsettle.PRVNo AND logsettle.StatCancel='0' AND logsettle.statuslog='1' AND logsettle.AppDate <> '0000-00-00' "); 
    while($isidua=mysql_fetch_array($dua)){ 
     mysql_query("update msvisa set PRVDate = '$isidua[PRVDate]',AppDate = '$isidua[AppDate]'
                                    WHERE DONo = '$isidua[DONo]'");
    } */                                                                                   
    $dua=mysql_query("SELECT * FROM logsettle                                                  
                                WHERE PRVCode = '$_GET[id]'   ");
    
    while($isidua=mysql_fetch_array($dua)){
    mysql_query("update msvisa set PRVNo = '', StatCancel = '0'
                                    WHERE DONo = '$isidua[DONo]'");
    }                                                                                    
    $edit=mysql_query("update logsettle set statuslog='2' WHERE PRVCode = '$_GET[id]'");    
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msapprove'>";   
     break; 
}
?>
