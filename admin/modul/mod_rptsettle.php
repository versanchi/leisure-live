<script language="JavaScript"  type="text/javascript">
     
function voidfile(ID, File)
{
if (confirm("Are you sure want to VOID Settlement No '" + File + "'"))
{
 window.location.href = '?module=rptsettle&act=addmsvoid&id=' + ID;
 
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
            
    echo "<h2>Settlement</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='rptsettle'>
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
            $tampil=mysql_query("SELECT logsettle.AppDate,logsettle.statuslog,logsettle.KasNo,logsettle.PRVCode,logsettle.PRVNo,logsettle.PRVCurr,logsettle.PRVDate,SUM(logsettle.PRVAmount)as Total FROM logsettle                                                  
                                left JOIN logkasbon ON logkasbon.DONo = logsettle.DONo
                                WHERE (PRVNo LIKE '%$nama%'
                                OR PRVDate LIKE '%$nama%')
                                AND (logsettle.statuslog ='0' OR logsettle.statuslog ='1')
                                AND logkasbon.statuslog ='0' 
                                AND logsettle.KasNo = logkasbon.KasNo   
                                Group BY logsettle.PRVCode DESC
                                order by logsettle.statuslog ASC, logsettle.AppDate DESC, logsettle.PRVDAte DESC  LIMIT $posisi,$batas");
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "<table>
                    <tr><th>no</th><th>date</th><th>Settlement no.</th><th>Cash Adv No</th><th colspan=2>Amount</th><th>Status</th><th>Approve date</th><th>action</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){    
                    if($data[statuslog]==1){$stat='<font color=blue>APPROVE</font>';}
                    else if($data[statuslog]==2){$stat='<font color=red>REJECT</font>';}
                    else if($data[statuslog]==0){$stat='<font color=grey>WAITING</font>';}
                    else if($data[statuslog]==3){$stat='<font color=grey>VOID</font>';}
                    /*$satu=mysql_query("SELECT * FROM logsettle                                                  
                                WHERE PRVCode = '$data[PRVCode]'   ");
                    $coba=0;
                    while($isisatu=mysql_fetch_array($satu)){
                    $tampil1=mysql_query("SELECT * FROM logkasbon                                                  
                                WHERE KasNo <> '$data[KasNo]'
                                AND DONo = '$isisatu[DONo]'     ");
                    $jumtampil=mysql_num_rows($tampil1);
                    $jum=mysql_fetch_array($tampil1); 
                    if ($jumtampil >0){$coba++;}
                    }*/
               echo "<tr><td>$no</td>
                     <td>$data[PRVDate]</td>
                     <td>$data[PRVNo]</td>
                     <td>$data[KasNo]</td>
                     <td>$data[PRVCurr]</td>
                     <td align=right>".number_format($data[Total], 2, ',', '.');echo"</td>
                     <td>$stat</td>
                     <td>$data[AppDate]</td>  
                     <td>"; 
                     if($data[statuslog]<>3){echo"
                     <center><a href=settle.php?id=$data[PRVCode]&usr=$username target=_blank><img src='../images/print.gif'></a> &nbsp|&nbsp <a href=expset.php?id=$data[PRVCode]&usr=$username ><img src='../images/export.gif'></a> ";
                     if($data[statuslog]==1){echo" 
                     &nbsp|&nbsp <font color=grey><img src='../images/cancelb.gif'></font></tr>";
                    }else{
                     if($data[statuslog]==0){echo" 
                     &nbsp|&nbsp <a href=\"javascript:voidfile('$data[PRVCode]','$data[PRVNo]')\"><img src='../images/cancel.gif'></a></tr>";
                    }}
                    } 
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
                    $file = "media.php?module=rptsettle";
                    // Link ke halaman sebelumnya (previous)
                    echo "<center><div id='paging'>";
                    if ($halaman >1) {
                        $previous = $halaman-1;
                        echo "<a href=$file&halaman=1&nama=$nama&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&nama=$nama&oke=$oke> < Previous</a>  ";
                    } else {
                        echo "<< First | < Previous  ";
                    }
                    // Tampilkan link halaman 1,2,3 ... modifikasi ala google
                    // Angka awal
                    $angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
                    for ($i=$halaman-2; $i<$halaman; $i++) {
                        if ($i < 1 )
                            continue;
                        $angka .= " <a href=$file&halaman=$i&nama=$nama&oke=$oke>$i</a> ";
                    }
                    // Angka tengah
                    $angka .= " <b>$halaman</b> ";
                    for ($i=$halaman+1; $i<($halaman+3); $i++) {
                        if ($i > $jmlhalaman)
                            break;
                        $angka .= " <a href=$file&halaman=$i&nama=$nama&oke=$oke>$i</a> ";    
                    }
                    // Angka akhir
                    $angka .= ($halaman+2<$jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&nama=$nama&oke=$oke>$jmlhalaman</a> |" : " ");
                    // Cetak angka seluruhnya (awal, tengah, akhir)
                    echo " $angka ";
                    // Link ke halaman berikutnya (Next)
                    if ($halaman < $jmlhalaman) {
                        $next = $halaman+1;
                        echo " <a href=$file&halaman=$next&nama=$nama&oke=$oke> Next ></a> |
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
  
  case "showrptsettle":
     $hari= date("y", time());
    $tampil=mysql_query("SELECT * FROM msvisa                                                  
                                WHERE KasNo = '$_GET[id]' ");
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "<table>
                    <tr><th>no</th><th>Kasbon no.</th><th>Amount</th><th>date</th><th>action</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){    
               echo "<tr><td>$no</td>
                     <td>$data[KasNo]</td>
                     <td>$data[KasCurr]
                     $data[Total]</td>
                     <td>$data[KasDate]</td>
                     <td><a href=?module=rptsettle&act=showrptsettle&id=$data[KasNo]>Show</a></tr>";
                      $no++;
                    }
                    echo "</table>";
            }
     break;
    
  case "editvisa":
    $edit=mysql_query("SELECT * FROM rptsettle WHERE Id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Visa Data</h2>
          <form name='visa' method=POST action=./aksi.php?module=rptsettle&act=update>
          <input type=hidden name=id value='$r[Id]'>
          <table>
          <th colspan=2>detail</th>
          <tr><td>DO No.</td> <td> $r[DONo]</td></tr>
          <tr><td>Date</td> <td> $r[Date]</td></tr>
          <tr><td>Divisi</td> <td>  <input type=text name='Divisi' size=10 value='$r[Divisi]'></td></tr> 
          <tr><td>TC Name</td> <td>  <input type=text name='TcName' size=50 value='$r[TcName]'></td></tr> 
          <tr><td>Pax Name</td> <td>  <input type=text name='PaxName' size=50 value='$r[PaxName]'></td></tr>
          <tr><td>Passport No.</td> <td>  <input type=text name='PassNo' size=15 value='$r[PassNo]'></td></tr>
          <tr><td>Invoice</td> <td>  <input type=text name='Invoice' size=15 value='$r[Invoice]'></td></tr> 
          <tr><td>Selling</td> <td>
          <select name='curr'>"; 
          if ($r[KasCurr]=='IDR'){echo"<option value='IDR' selected>IDR</option>
                                      <option value='USD'>USD</option>" ;} 
          else if ($r[KasCurr]=='USD'){echo"<option value='IDR'>IDR</option>
                                      <option value='USD' selected>USD</option>";}   
    echo"</select> 
          <input type=text name='Selling' size=15 value='$r[Selling]'></td></tr>
          <tr><td>PO</td> <td>  <input type=text name='PO' size=15 value='$r[PO]'></td></tr> 
          <th colspan=2>Product</th>
          <tr><td>Type</td><td>
           
          <select name='ProdType'>"; 
          if ($r[ProdType]=='1'){echo"<option value='1' selected>Visa</option>
                                      <option value='2'>Passport</option>" ;} 
          else if ($r[ProdType]=='2'){echo"<option value='1'>Visa</option>
                                      <option value='2' selected>Passport</option>";}   
    echo"</select></td></tr>
          <tr><td>Embassy</td>  <td>  
          <select name='ProdEmbassy'>
            <option value=0 selected>- Select Embassy -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_mscountry ORDER BY Country");
            while($v=mysql_fetch_array($tampil)){
               if ($r[ProdEmbassy]==$v[CountryID]) {
                               echo "<option value=$v[CountryID] selected>$v[Country]</option>";
                            } else {
                               echo "<option value=$v[CountryID]>$v[Country]</option>";
                            }  
                        }
    echo "</select></td></tr>
          <tr><td>Process</td>  <td><input type=text name='ProdProcess' size=15 value='$r[ProdProcess]'></td></tr>
          
           <th colspan='2'>Action</th>
          <tr><td>PIC</td> <td>  <input type=text name='ActPIC' size=50 value='$r[ActPIC]'></td></tr>
          <tr><td>In</td> <td>  <input type=text name='ActIn' size=15 value='$r[ActIn]'>
          <A HREF='#' onClick="."cal.select(document.forms['visa'].ActIn,'anchor3','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='anchor3'>Select</A> (yyyy-mm-dd)
          </td></tr>
          <tr><td>Estimasi</td> <td>  <input type=text name='ActEstimasi' size=15 value='$r[ActEstimasi]'> 
          <A HREF='#' onClick="."cal.select(document.forms['visa'].ActEstimasi,'anchor1','yyyy-MM-dd'); return false;"." NAME='anchor1' ID='anchor1'>Select</A> (yyyy-mm-dd)
          </td></tr>
          <tr><td>Out</td> <td>  <input type=text name='ActOut' size=15 value='$r[ActOut]'>
          <A HREF='#' onClick="."cal.select(document.forms['visa'].ActOut,'anchor2','yyyy-MM-dd'); return false;"." NAME='anchor2' ID='anchor2'>Select</A> (yyyy-mm-dd)          
          </td></tr>
          <tr><td>Remarks</td><td><textarea name='ActRemarks' cols='50' rows='3'>$r[ActRemarks]</textarea></td></tr>
          <tr><td colspan=2><center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
    
    case "addmsvoid": //void   
   /* $satu=mysql_query("SELECT * FROM logsettle                                                  
                                WHERE PRVCode = '$_GET[id]' 
                                AND PRVAmount ='0' ");
    
    while($isisatu=mysql_fetch_array($satu)){
    $tampil1=mysql_query("SELECT * FROM logkasbon                                                  
                WHERE DONo = '$isisatu[DONo]'     ");   
    $jum=mysql_fetch_array($tampil1); 
    mysql_query("update msvisa set KasNo = '$jum[KasNo]',
                                    PRVNo = '',
                                    StatCancel = '0', 
                                    Status = '1' 
                                    WHERE DONo = '$jum[DONo]'");
    } */
    $dua=mysql_query("SELECT * FROM logsettle                                                  
                                WHERE PRVCode = '$_GET[id]'   ");
    
    while($isidua=mysql_fetch_array($dua)){
    mysql_query("update msvisa set PRVNo = '', StatCancel = '0'
                                    WHERE DONo = '$isidua[DONo]'");
    }
    $edit1=mysql_query("update logsettle set statuslog = '3' WHERE PRVCode = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=rptsettle'>";   
     break; 
}
?>
