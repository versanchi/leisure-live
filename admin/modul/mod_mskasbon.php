<script type="text/javascript">  
function UpdateCost(JUM, No) {                               
    var sum = 0;
    var gn, elem,coba;
    var nod, elems, tes;
    var el;     
  for (i=1; i< JUM; i++) {
    gn = 'game'+i;
    elem = document.getElementById(gn);
    if (elem.checked == true) { sum += Number(elem.value); }
  }  
  document.getElementById('totalcost').value = accounting.formatMoney(sum);
  nod = 'nodo'+No;
  tes = 'game'+No;
  coba = 'nomor'+No;
  el = document.getElementById(coba);
  elems = document.getElementById(tes);
  if (elems.checked == true) {
  document.getElementById(nod).value = el.value; }
  if (elems.checked == false) {
  document.getElementById(nod).value = ''; } 
}
  
</script>
<script type="text/javascript"> 
function validateFormOnSubmit(theForm) {
var reason = "";                            
  reason += validateEmpty(theForm.totalcost);
  if (reason != "") {
    alert("You MUST check at least one:\n" + reason);
    return false;
  }

  return true;
}
function validateEmpty(fld) {
    var error = "";
 
    if (fld.value == 0.00 ) {
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
     $mem = $_GET['nama'];
     $kurr = $_GET['curr']; 
     $hari= date("Y", time());
    $tampil = mysql_query("SELECT * FROM msvisa
                GROUP BY KasNo DESC limit 1");
    $hasil = mysql_fetch_array($tampil);
    $jumlah = mysql_num_rows($tampil);
    $tahun = substr($hasil[KasNo],0,4); 
    
    if($jumlah > 0){
        if($hari==$tahun){
            $tahun1 = $hari;
            $tiket=substr($hasil[KasNo],6,5)+1;
            switch ($tiket){
            case ($tiket<10):
            $tiket1 = "0000".$tiket;
            break;  
            case ($tiket>9 && $tiket<100):
            $tiket1 = "000".$tiket;
            break;  
            case ($tiket>99 && $tiket<1000):
            $tiket1 = "00".$tiket;
            break;
            case ($tiket>999 && $tiket<10000):
            $tiket1 = "0".$tiket;
            break; 
               
            }   
        } else if ($hari > $tahun) {
            $tahun1 = $hari;
            $tiket1="00001"; 
        }
    }else {
       $tahun1 = $hari;
       $tiket1="00001";  
    }
     echo "<h2>Add Cash Advance</h2>
            <form name='cari' method=get action='./media.php?module=mskasbon'>
          <input type=hidden name=module value='mskasbon'>
          
          Date : <select name='nama' >
            <option value='0' selected>- select date -</option>";
            $tampil=mysql_query("SELECT * FROM msvisa where KasNo = '' AND StatusCA = '1'  AND Status ='0' AND  StatCancel <>'1' group by ActEstimasi   ");
            while($r=mysql_fetch_array($tampil)){
                if ($mem == $r[ActEstimasi]){
                   echo "<option value=$r[ActEstimasi] selected>$r[ActEstimasi]</option>";
                } else {
                   echo "<option value=$r[ActEstimasi]>$r[ActEstimasi]</option>";
                }                                          
                
            }
    echo "</select> 
     <select name='curr'>"; 
          if ($kurr=='IDR'){echo"<option value='IDR' selected>IDR</option>
                                      <option value='USD'>USD</option>
                                      <option value='EUR'>EUR</option>" ;} 
          else if ($kurr=='USD'){echo"<option value='IDR'>IDR</option>
                                      <option value='USD' selected>USD</option>
                                      <option value='EUR'>EUR</option>";}
          else if ($kurr=='EUR'){echo"<option value='IDR'>IDR</option>
                                      <option value='USD'>USD</option>
                                      <option value='EUR' selected>EUR</option>";}
          else if ($kurr==''){echo"<option value='IDR' selected>IDR</option>
                                      <option value='USD'>USD</option>
                                      <option value='EUR'>EUR</option>" ;}    
    echo"</select>
    <input type=submit name=oke value=Show>
          </form>";
          $oke=$_GET['oke'];
          
    $nama=$_GET['nama'];
     $tampil=mysql_query("SELECT * FROM msvisa 
                                LEFT JOIN tbl_mscountry ON tbl_mscountry.CountryID=msvisa.ProdEmbassy
                                WHERE msvisa.ActEstimasi = '$mem'
                                AND msvisa.KasCurr = '$kurr'
                                AND msvisa.StatusCA = '1' 
                                AND msvisa.KasNo = '' 
                                AND msvisa.StatCancel <> 1 
                                ORDER BY tbl_mscountry.Country ASC,msvisa.ActIn DESC");
     $jumlah=mysql_num_rows($tampil);
     $tam=mysql_query("SELECT SUM(NettAmount) as Total,ActEstimasi FROM msvisa                                                           
                                WHERE ActEstimasi = '$mem'
                                AND KasCurr = '$kurr'
                                AND StatusCA = '1' 
                                AND KasNo = '' 
                                AND StatCancel <> 1 group by ActEstimasi ");
     $dat=mysql_fetch_array($tam); 
            if ($jumlah > 0) {
                $baris = $jumlah+1 ;
                echo "
                <form method=POST name='visa' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=mskasbon&act=input'>
                <input type=hidden name='KASNo' value='$tahun1-$tiket1'>  
                <input type=hidden name='KASDate' value='$mem'>
                <table>
                    <tr><th>no</th><th></th><th>do/tc no.</th><th>pax name</th><th>passport no</th><th>Type</th><th>embassy</th><th>process</th><th>completed</th><th>Price</th><th>Remarks</th>";
            
            echo "</tr>"; 
                  $no=$posisi+1;
                  echo"<input type=hidden name='No' value='$no'>";
                while ($data=mysql_fetch_array($tampil)){
                    $dono = $data['DONo'];    
               echo "<input type=hidden name='DONo' id='nomor$no' value='$data[DONo]'>
               <input type=hidden name='sell[]' value='$data[NettAmount]'>
                     <tr><td>$no</td>
                     <td><input type='checkbox' id='game$no' value='$data[NettAmount]' onclick='UpdateCost($baris,$no,$no)' checked></td>
                     <td>$data[DONo]</td>
                     <td>$data[PaxName]</td>
                     <td>$data[PassNo]</td>
                     <td>$data[ProdType]</td>
                     <td>$data[Country]</td>
                     <td>$data[ActIn]</td>      
                     <td>$data[ActOut]</td>
                     <td align=right>".number_format($data[NettAmount], 2, ',', '.');echo"
                     <input type='hidden' name='do[]' id='nodo$no' value='$dono'></td>
                     <td>$data[PRVNote]</td>
                     </tr>";
                      $no++;
                    }
                    echo "</table>
                    Total $kurr <input type='text' id='totalcost' name='totalcost' value=".number_format($dat[Total], 2, ',', '.');echo" readonly></br></br>
                    <input type=submit value='Create Cash Advance'>
                    </form>";
            }
     break;
  
  case "tambahkasbon":
    $mem = $_GET['nama'];  
    $hari= date("y", time());
    $tampil = mysql_query("SELECT * FROM msvisa
                ORDER BY Id DESC limit 1");
    $hasil = mysql_fetch_array($tampil);
    $jumlah = mysql_num_rows($tampil);
    $tahun = substr($hasil[DONo],3,2); 
    
    if($jumlah > 0){
        if($hari==$tahun){
            $tahun1 = $hari;
            $tiket=substr($hasil[DONo],5,7)+1;
            switch ($tiket){
            case ($tiket<10):
            $tiket1 = "000000".$tiket;
            break;  
            case ($tiket>9 && $tiket<100):
            $tiket1 = "00000".$tiket;
            break;  
            case ($tiket>99 && $tiket<1000):
            $tiket1 = "0000".$tiket;
            break;
            case ($tiket>999 && $tiket<10000):
            $tiket1 = "000".$tiket;
            break; 
            case ($tiket>9999 && $tiket<100000):
            $tiket1 = "00".$tiket;
            break;
            case ($tiket>99999 && $tiket<1000000):
            $tiket1 = "0".$tiket;
            break;   
            }   
        } else if ($hari > $tahun) {
            $tahun1 = $hari;
            $tiket1="0000001"; 
        }
    }else {
       $tahun1 = $hari;
       $tiket1="0000001";  
    }
     $inputdate = date("Y-m-d", time());   
   
    echo "<h2>Add New Kasbon</h2>
         <form name='cari' method=get action='./media.php?module=mskasbon&act=tambahkasbon'>
          <input type=hidden name=module value='mskasbon&act=tambahkasbon'>
          Member: <select name='nama' >
            <option value='0' selected>- select date -</option>";
            $tampil=mysql_query("SELECT * FROM msvisa group by ActEstimasi ");
            while($r=mysql_fetch_array($tampil)){
                if ($mem == $r[ActEstimasi]){
                   echo "<option value=$r[ActEstimasi] selected>$r[ActEstimasi]</option>";
                } else {
                   echo "<option value=$r[ActEstimasi]>$r[ActEstimasi]</option>";
                }                                          
                
            }
    echo "</select> <input type=submit name=oke value=Search>
          </form>
          <form method=POST name='visa' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=mskasbon&act=input'>
          <input type=hidden name='DONo' value='DO-$tahun1$tiket1'>
          <table>                                                    
		  <th colspan=2>Kasbon</th>
          <tr><td>Date</td> <td>  <input type=text name='KasDate' size=15 value='$inputdate'>              
          </td></tr>
          <tr><td>No</td> <td>  <input type=text name='KasNo' size=15 value='DO-$tahun1$tiket1'>
          <tr><td>Amount</td>  <td>  
          <select name='KasCurr'>
            <option value='IDR' selected>IDR</option>
            <option value='USD'>USD</option>
           </select> <input type=text name='KasAmount' size=15> </td></tr>
          <th colspan=2>PRV</th>
          <tr><td>Date</td> <td>  <input type=text name='PRVDate' size=15> 
          <A HREF='#' onClick="."cal.select(document.forms['visa'].PRVDate,'anchor3','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='anchor3'> Select</A> (yyyy-mm-dd)
          </td></tr>
          <tr><td>No</td> <td>  <input type=text name='PRVNo' size=15>
          <tr><td>Amount</td>  <td>  
          <select name='PRVCurr'>
            <option value='IDR' selected>IDR</option>
            <option value='USD'>USD</option>
           </select> <input type=text name='PRVAmount' size=15> </td></tr>                 
		  <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;
    
  case "sukseskasbon":
    $edit=$_GET['id'];             
    $username=$_SESSION[namauser];
    echo "<h2>SUCCESS Create Cash Advance No : <a href=kasbon.php?id=$edit&usr=$username target=_blank>$edit</a></h2>
          <center><input type=button value='Next' onclick=location.href='?module=mskasbon'>      
         <br><br>";
    break;  
}
?>
