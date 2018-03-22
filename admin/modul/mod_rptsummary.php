<script language="JavaScript"  type="text/javascript">
     
function voidfile(ID, File)
{
if (confirm("Are you sure want to VOID Cash Advance No '" + File + "'"))
{
 window.location.href = '?module=rptsummary&act=addmsvoid&id=' + ID;
 
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
      $div=$_GET['div']; 
    $tampil2=mysql_query("SELECT job_desc FROM tbl_msemployee WHERE employee_username='$_SESSION[namauser]'");
            $hasil2=mysql_fetch_object($tampil2);
            $JobDesc=$hasil2->job_desc;
            
    echo "<h2>Summary Data</h2>
          <form method=get action='media.php?'>
          Division : <select name='div'>
            <option value='' ";if($div==''){echo"selected";}echo">- ALL -</option>
            <option value='MICE' ";if($div=='MICE'){echo"selected";}echo">MICE</option>
            <option value='LTM' ";if($div=='LTM'){echo"selected";}echo">LTM</option>
            <option value='SISCOM' ";if($div=='SISCOM'){echo"selected";}echo">SISCOM</option>
            <option value='FIT' ";if($div=='FIT'){echo"selected";}echo">FIT</option>
            </select> &nbsp
                <input type=hidden name=module value='rptsummary'>
              <input type=text name=nama value='$nama' size=40>    
              <input type=submit name=oke value=Search>
          </form>";
          $username=$_SESSION[namauser];
          $oke=$_GET['oke'];
          $hari = date("Y-m-d", time());
          // Langkah 1
          $batas = 10;
          $halaman= $_GET['halaman'];
          if(empty($halaman)){
              $posisi  = 0;
            $halaman = 1;
          } else {
              $posisi = ($halaman-1) * $batas; }
            
            // Langkah 2
            $tampil=mysql_query("SELECT msvisa.ProdEmbassy,msvisa.TourCode,productdetails.Start,tbl_mscountry.Country FROM productdetails
                                left join msvisa on productdetails.tourcode = msvisa.TourCode
                                left join tbl_mscountry on tbl_mscountry.CountryID = msvisa.ProdEmbassy
                                where msvisa.TourCode <> ''
                                AND msvisa.TourCode LIKE '%$nama%'
                                AND productdetails.divi LIKE '%$div%'
                                AND productdetails.Start > '$hari'
                                Group BY msvisa.TourCode ASC,msvisa.ProdEmbassy ASC  
                                order by productdetails.Start ASC LIMIT $posisi,$batas");
            $jumlah=mysql_num_rows($tampil);
           /* $t=mysql_query("SELECT logkasbon.KasNo,logkasbon.KasCurr,logkasbon.KasDate,logsettle.PRVNo FROM logkasbon                                                  
                                left join logsettle on logsettle.DONo = logkasbon.DONo
                                WHERE (logkasbon.KasNo LIKE '%$nama%'
                                OR logkasbon.KasDate LIKE '%$nama%')
                                AND logkasbon.statuslog ='0'  
                                Group BY logkasbon.KasNo DESC LIMIT $posisi,$batas");  
             */       
            if ($jumlah > 0) {
                $awal = microtime(true);
            echo "<table>
                    <tr><th>no</th><th>Tour Code</th><th>Embassy</th><th>Dep Date</th><th>Receive</th><th>Process</th><th>Complete</th><th>Unprocess</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
                       //  $j=mysql_fetch_array($t);
                       $emb=mysql_query("SELECT TourCode FROM msvisa                                                  
                                WHERE TourCode = '$data[TourCode]'
                                AND ProdEmbassy = '$data[ProdEmbassy]'   
                                 ");               
                       $isiemb=mysql_fetch_array($emb);
                       $satu=mysql_query("SELECT count(TourCode) as receive FROM msvisa                                                  
                                WHERE TourCode = '$data[TourCode]'
                                AND ProdEmbassy = '$data[ProdEmbassy]'  
                                 ");               
                       $isisatu=mysql_fetch_array($satu);
                       $dua=mysql_query("SELECT count(TourCode) as process FROM msvisa                                                  
                                WHERE TourCode = '$data[TourCode]'
                                AND WONo <> '' 
                                AND ActOut = '0000-00-00' 
                                AND ProdEmbassy = '$data[ProdEmbassy]'
                                 ");               
                       $isidua=mysql_fetch_array($dua);
                        $tiga=mysql_query("SELECT count(TourCode) as complete FROM msvisa                                                  
                                WHERE TourCode = '$data[TourCode]'   
                                AND ActOut <> '0000-00-00' 
                                AND ProdEmbassy = '$data[ProdEmbassy]' 
                                 ");               
                       $isitiga=mysql_fetch_array($tiga);
                       $empat=mysql_query("SELECT count(TourCode) as unprocess FROM msvisa                                                  
                                WHERE TourCode = '$data[TourCode]'
                                AND WONo = ''
                                AND ActOut = '0000-00-00'  
                                AND ProdEmbassy = '$data[ProdEmbassy]'
                                 ");               
                       $isiempat=mysql_fetch_array($empat);
                       $lima=mysql_query("SELECT count(TourCode) as cacat FROM msvisa                                                  
                                WHERE TourCode = '$data[TourCode]'
                                AND WONo = ''
                                AND ActOut <> '0000-00-00'  
                                AND ProdEmbassy = '$data[ProdEmbassy]'
                                 ");               
                       $isilima=mysql_fetch_array($lima);
                       $thn = substr($data[Start],0,4);  
               echo "<tr><td>$no</td>
                     <td><a style='color: blue' href='exptourcodelbd1.php?nama=$data[TourCode]&tahun=$thn'>$data[TourCode]</a></td>
                     <td>$data[Country]</td>
                     <td>$data[Start]</td>
                     <td>$isisatu[receive]</td>
                     <td>$isidua[process]</td>
                     <td>$isitiga[complete]</td> 
                     <td>$isiempat[unprocess]</td>";  
                      $no++;
                    }
                    echo "</table>";
                    $akhir = microtime(true);
                    $lama = $akhir - $awal;
                   // echo "<font size=1>time for execute: ".$lama." second </font></br></br>";
                    // Langkah 3            
                    $tampil2    = "SELECT msvisa.ProdEmbassy,msvisa.TourCode,productdetails.Start,tbl_mscountry.Country FROM productdetails
                                left join msvisa on productdetails.tourcode = msvisa.TourCode
                                left join tbl_mscountry on tbl_mscountry.CountryID = msvisa.ProdEmbassy
                                where msvisa.TourCode <> ''
                                AND msvisa.TourCode LIKE '%$nama%'
                                AND productdetails.divi LIKE '%$div%'
                                AND productdetails.Start > '$hari'
                                Group BY msvisa.TourCode ASC,msvisa.ProdEmbassy ASC  
                                order by productdetails.Start ASC";
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=rptsummary";
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
  
  case "showrptsummary":
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
                     <td><a href=?module=rptsummary&act=showrptsummary&id=$data[KasNo]>Show</a></tr>";
                      $no++;
                    }
                    echo "</table>";
            }
     break;
    
  case "editvisa":
    $edit=mysql_query("SELECT * FROM rptsummary WHERE Id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Visa Data</h2>
          <form name='visa' method=POST action=./aksi.php?module=rptsummary&act=update>
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
    
    case "addmsvoid":    
    
    $edit=mysql_query("update msvisa set KasNo = '', Status = '0' WHERE KasNo = '$_GET[id]'");
    $edit1=mysql_query("update logkasbon set statuslog = '1' WHERE KasNo = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=rptsummary'>";   
     break; 
      
}
?>
