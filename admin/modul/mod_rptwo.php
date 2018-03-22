<script language="JavaScript"  type="text/javascript">
     
function voidfile(ID, File)
{
if (confirm("Are you sure want to RELEASE WO No '" + File + "'"))
{
 window.location.href = '?module=rptwo&act=addmsvoid&id=' + ID;
 
} 
}
</script>
<script type="text/javascript"> 
function validateFormOnSubmit(theForm) {
var reason = "";                            
  reason += validateEmpty(theForm.Divisi);
  reason += validateEmpty(theForm.TcName);
  reason += validateEmpty(theForm.PaxName);  
      
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);
    return false;
  }

  return true;
}
function validateEmpty(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        fld.style.background = 'Yellow'; 
        error = "The required field has not been filled in.\n"
    } else {
        fld.style.background = 'White';
    }
    return error;  
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
            
    echo "<h2>WORK ORDER</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='rptwo'>
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
            $tampil=mysql_query("SELECT tbl_msemployee.employee_name,logwo.WONo,logwo.WODate,logwo.ActIn,logwo.WOStatus,tbl_mscountry.Country FROM logwo
                                LEFT JOIN tbl_msemployee ON tbl_msemployee.employee_id = logwo.WOPIC
                                left join tbl_mscountry on tbl_mscountry.CountryID = logwo.ProdEmbassy                             
                                WHERE logwo.WOPIC LIKE '%$nama%'
                                OR logwo.WONo LIKE '%$nama%'
                                OR logwo.WODate LIKE '%$nama%' 
                                Group BY logwo.WONo DESC LIMIT $posisi,$batas");
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "<table>
                    <tr><th>no</th><th>date</th><th>Work Order no.</th><th>pic</th><th>process date</th><th>embassy</th><th>action</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){   
                   /* $tampil1=mysql_query("SELECT * FROM msvisa                                                  
                                WHERE WONo = '$data[WONo]'     ");
                    $jumtampil=mysql_num_rows($tampil1);  
                    */    
               echo "<tr><td>$no</td>
                     <td>$data[WODate]</td>
                     <td>$data[WONo]</td>
                     <td>$data[employee_name]</td>   
                     <td>$data[ActIn]</td>
                     <td>$data[Country]</td> 
                     <td><center><a href=wo.php?id=$data[WONo]&usr=$username target=_blank><img src='../images/print.gif'></a> &nbsp|&nbsp <a href=expwo.php?id=$data[WONo]&usr=$username ><img src='../images/export.gif'></a>";
                     //if($jumtampil ==0){echo" 
                     //| <font color=grey>Void</font></tr>";
                    //}else{ 
                    
                      if($data[WOStatus]==1){echo" 
                     &nbsp|&nbsp <font color=grey><img src='../images/cancelb.gif'></font></tr>";
                    }else{
                     if($data[WOStatus]==0){echo" 
                     &nbsp|&nbsp <a href=\"javascript:voidfile('$data[WONo]','$data[WONo]')\"><img src='../images/cancel.gif'></a></tr>";
                    }}
                      
                    } $no++;
                    //}
                    echo "</table>";
                    
                    // Langkah 3            
                    $tampil2    = "SELECT * FROM logwo
                                LEFT JOIN tbl_msemployee ON tbl_msemployee.employee_id = logwo.WOPIC                                                    
                                WHERE WOPIC LIKE '%$nama%'
                                OR WONo LIKE '%$nama%'
                                OR WODate LIKE '%$nama%' 
                                Group BY WONo";
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=rptwo";
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
   $edit=mysql_query("update msvisa set WONo = '' WHERE WONo = '$_GET[id]'");
   $edit=mysql_query("update logwo set WOStatus = '1' WHERE WONo = '$_GET[id]'"); 
     
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=rptwo'>";   
     break; 
      
}
?>
