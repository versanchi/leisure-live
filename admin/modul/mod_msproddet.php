<script language="JavaScript"  type="text/javascript">
     
function delfile(ID, File)
{
if (confirm("Are you sure you want to delete '" + File + "'"))
{
 window.location.href = '?module=msproddet&act=deletemsproddet&id=' + ID;
 
} 
}
</script>

<?php 
switch($_GET[act]){
  // Tampil Product
  default:
            $nama=$_GET['nama'];
    $tampil2=mysql_query("SELECT job_desc FROM tbl_msemployee WHERE employee_username='$_SESSION[namauser]'");
            $hasil2=mysql_fetch_object($tampil2);
            $JobDesc=$hasil2->job_desc;
            
    echo "<h2>Tour Code</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='msproddet'>
              <input type=text name=nama value='$nama' size=40>    
              <input type=submit name=oke value=Search>
          </form><input type=button value='Add New' onclick=location.href='?module=msproddet&act=tambahmsproddet'>";
          $username=$_SESSION[namauser];
          $oke=$_GET['oke'];
 
          // Langkah 1
          $batas = 25;
          $halaman= $_GET['halaman'];
          if(empty($halaman)){
              $posisi  = 0;
            $halaman = 1;
          } else {
              $posisi = ($halaman-1) * $batas; }
            
            // Langkah 2
            $tampil=mysql_query("SELECT * FROM productdetails  
                                WHERE (tourcode LIKE '%$nama%'
                                OR dest LIKE '%$nama%')  
                                order by dest ASC,tourcode ASC LIMIT $posisi,$batas");
            $jumlah=mysql_num_rows($tampil);
      
            if ($jumlah > 0) {
                $awal = microtime(true);
            echo "<table>
                    <tr><th>no</th><th>destination</th><th>Tour Code</th><th>start</th><th>end</th><th>action</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){

               echo "<tr><td>$no</td>
                     <td>$data[dest]</td> 
                     <td>$data[tourcode]</td>
                     <td>$data[Start]</td>      
                     <td>$data[End]</td>
                     
                     <td><center><a href=?module=msproddet&act=editmsproddet&id=$data[id]><img src='../images/edit.gif'></a> | <a href=\"javascript:delfile('$data[id]','$data[tourcode]')\"><img src='../images/cancel.gif'></a></tr>";
                     $no++;
                    }
                    echo "</table>";
                    $akhir = microtime(true);
                    $lama = $akhir - $awal;
                   // echo "<font size=1>time for execute: ".$lama." second </font></br></br>";
                    // Langkah 3            
                    $tampil2    = "SELECT * FROM productdetails  
                                WHERE (tourcode LIKE '%$nama%'
                                OR dest LIKE '%$nama%')  
                                order by dest ASC,tourcode ASC";
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=msproddet";
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
    
  case "tambahmsproddet":
    echo "<h2>Add Tour Code</h2>
          <form NAME='example' method=POST action='./aksi.php?module=msproddet&act=input'>
          <table>
          <tr><td>Destination</td><td> <select name='dest'>
            <option value='' selected>- Please Select -</option>";
            $tampil=mysql_query("SELECT * FROM destinations ORDER BY destination ASC");
            while($w=mysql_fetch_array($tampil)){                           
                    echo "<option value=$w[destination]>$w[destination]</option>";  
            }
    echo "</select></td></tr>
          
          <tr><td>Tour Code</td> <td> <input type=text name='tourcode' size=20></td></tr> 
          <tr><td>Group name</td> <td> <input type=text name='grup' size=20></td></tr>
          <tr><td>Division</td> <td><select name='divi'>
            <option value='' selected>- Please Select -</option>
            <option value='MICE'>MICE</option>
            <option value='LTM'>LTM</option>
            <option value='SISCOM'>SISCOM</option>
            <option value='FIT'>FIT</option>
            </select></td></tr>
           
          <tr><td>Date of Departure</td> <td> <input type=text name='date1' size=15 onClick="."cal.select(document.forms['example'].date1,'anchor3','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='anchor3' >
         (yyyy-mm-dd) </td></tr>
          <tr><td>Date of Arrival</td> <td><input type=text name='date2' size=15 onClick="."cal.select(document.forms['example'].date2,'anchor2','yyyy-MM-dd'); return false;"." NAME='anchor2' ID='anchor2' >
         (yyyy-mm-dd)</td></tr>                
          
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;
    
  case "editmsproddet":
    $edit=mysql_query("SELECT * FROM productdetails WHERE id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Tour Code</h2>
          <form name='example' method=POST action=./aksi.php?module=msproddet&act=update>
          <input type=hidden name=id value='$r[id]'>
          <table>   
          <tr><td>Destination</td><td> <select name='dest'>
            <option value='' selected>- Please Select -</option>";
            $tampil=mysql_query("SELECT * FROM destinations ORDER BY destination ASC");
            while($w=mysql_fetch_array($tampil)){                           
                    if ($r[dest]==$w[destination]){    
                echo "<option value=$w[destination] selected>$w[destination]</option>";
                }else {
                    echo "<option value=$w[destination]>$w[destination]</option>";
                }   
            }
    echo "</select></td></tr> 
          <tr><td>Tour Code</td> <td> <input type=text name='tourcode' value='$r[tourcode]' size=20></td></tr>
          <tr><td>Group name</td> <td> <input type=text name='grup' size=20 value='$r[grup]'></td></tr> ";   
          if($r[divi]=='MICE'){$a='selected';}
          else if($r[divi]=='LTM'){$b='selected';}
          else if($r[divi]=='SISCOM'){$c='selected';}
          else if($r[divi]=='FIT'){$d='selected';}
    echo"<tr><td>Division</td> <td><select name='divi'>
            <option value='' >- Please Select -</option>
            <option value='MICE' $a>MICE</option>
            <option value='LTM' $b>LTM</option>
            <option value='SISCOM' $c>SISCOM</option>
            <option value='FIT' $d>FIT</option>
            </select></td></tr>
          
          <tr><td>Date of Departure</td> <td> <input type=text name='date1' value='$r[Start]' size=10>
              <A HREF='#' onClick="."cal.select(document.forms['example'].date1,'anchor1','yyyy-MM-dd'); return false;"." NAME='anchor1' ID='anchor1'>select</A></td></tr>
          <tr><td>Date of Arrival</td> 
          <td> <input type=text name='date2' value='$r[End]' size=10>
              <A HREF='#' onClick="."cal.select(document.forms['example'].date2,'anchor2','yyyy-MM-dd'); return false;"." NAME='anchor2' ID='anchor2'>select</A></td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
    break; 
    
    case "deletemsproddet":
    /*$dua=mysql_query("SELECT * FROM `productdetails`       
    left join destinations on destinations.id = productdetails.dest    
     "); 
    while($isidua=mysql_fetch_array($dua)){ 
     mysql_query("update productdetails set dest = '$isidua[destination]'
                                    WHERE DONo = '$isidua[DONo]'");
    } */                                                                                   
    $edit=mysql_query("DELETE FROM productdetails WHERE id = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproddet'>";
   
     break; 
}
?>
