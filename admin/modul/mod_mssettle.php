<script type="text/javascript">  
function tampil1()
{
var example = document.visa.inc1;

document.visa.elements['PRVNo'].style.visibility='hidden'; 
document.visa.elements['operator1'].style.visibility='hidden';
document.visa.elements['PRVNo'].value='0';
document.visa.elements['PRVNo'].style.background='White';         
}
function tampil2()
{
var example = document.visa.inc1;

document.visa.elements['PRVNo'].style.visibility='visible';
document.visa.elements['operator1'].style.visibility='visible'; 
document.visa.elements['PRVNo'].value=''; 
}
function UpdateCost(JUM, No) {                               
    var sum = 0;
    var tot = 0;
    var gn, elem,coba;
    var nod, elems, tes;
    var el,bal,elems; 
    var elems1,net1,sum1,a;    
  for (i=1; i< JUM; i++) {                        
                                
      
    gn = 'game'+i;
    net = 'nett'+i;
    net1 = 'bal'+i;
    a = document.getElementById(net1);  
    elem = document.getElementById(gn);
    sum += Number(elem.value);
    sum1 = eval(elem.value);
    elems = document.getElementById(net);
    tot = eval(elems.value);
    elems1 = eval(tot)- eval(sum1);
    
  document.getElementById(net1).value = elems1;
  }                                                           
  document.getElementById('totalcost').value = accounting.formatMoney(sum);
  nod = 'nodo'+No;
  tes = 'game'+No;
  coba = 'nomor'+No;
  el = document.getElementById(coba);
  elems = document.getElementById(tes);   
  document.getElementById(nod).value = el.value;   
}

</script>
<script type="text/javascript"> 
function validateFormOnSubmit(theForm) {
var reason = "";                            
  
  reason += validateEmpty1(theForm.PRVNo);
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
function validateEmpty1(fld) {
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
     $get = $_GET['nama'];
     if($get==''){
         $mem='0';
     }else{
     $mem = $_GET['nama'];
     }
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
     echo "<h2>Add Settlement</h2>
            <form name='cari' method=get action='./media.php?module=mssettle'>
          <input type=hidden name=module value='mssettle'>
          
          Select No : <select name='nama' >
            <option value='0' selected>- select -</option>";
            $tampil=mysql_query("SELECT * FROM msvisa where KasNo <> '' AND PRVNo = '' group by KasNo  ");
            while($r=mysql_fetch_array($tampil)){
                if ($mem == $r[KasNo]){
                   echo "<option value=$r[KasNo] selected>$r[KasNo]</option>";
                } else {
                   echo "<option value=$r[KasNo]>$r[KasNo]</option>";
                }                                          
                
            }
    echo "</select>    
    <input type=submit name=oke value=Show>
          </form>";
          $oke=$_GET['oke'];
          
    $nama=$_GET['nama'];
     $tampil=mysql_query("SELECT * FROM msvisa 
                                LEFT JOIN tbl_mscountry ON tbl_mscountry.CountryID=msvisa.ProdEmbassy
                                WHERE msvisa.KasNo = '$mem' 
                                AND msvisa.StatusCA = '1'
                                AND (msvisa.PRVNo = '' OR msvisa.PRVNo = 'PASSPORT') 
                                ORDER BY tbl_mscountry.Country ASC,msvisa.ProdProcess ASC,msvisa.ActIn DESC");
     $jumlah=mysql_num_rows($tampil);
     $tam=mysql_query("SELECT SUM(PRVAmount) as Total,ActEstimasi,KasNo,KasCurr FROM msvisa                                                           
                                WHERE KasNo = '$mem' 
                                AND (PRVNo = '' OR PRVNo = 'PASSPORT')
                                AND msvisa.PRVNo = '' group by KasNo ");
     $dat=mysql_fetch_array($tam); 
            if ($jumlah > 0) {
                $baris = $jumlah+1 ;
                echo "
                <form method=POST name='visa' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=mssettle&act=input'>
                <input type=hidden name='KASNo' value='$tahun1-$tiket1'>  
                <input type=hidden name='KASDate' value='$mem'>
                
                Cash Advance No : $dat[KasNo]
                <table>
                    <tr><th>no</th><th>do no.</th><th>pax name</th><th>passport no</th><th>embassy</th><th>Price</th><th>settlement</th><th>balance</th><th>remarks</th>";
            
            echo "</tr>"; 
                  $no=$posisi+1;
                  echo"<input type=hidden name='No' value='$jumlah'>
                  <input type='hidden' name='curr' value='$dat[KasCurr]'><input type='hidden' name='kasno' value='$dat[KasNo]'>";
                    while ($data=mysql_fetch_array($tampil)){
                    $dono = $data['DONo'];    
               echo "<input type=hidden name='DONo' id='nomor$no' value='$data[DONo]'>
                     <input type=hidden name='Net[]' value='$data[NettAmount]'> 
                     <tr><td>$no</td> 
                     <td>$data[DONo]</td>
                     <td>$data[PaxName]</td>
                     <td>$data[PassNo]</td>
                     <td>$data[Country]</td>
                     <td><input type='text' name='operate' id='nett$no' size='10' value='$data[NettAmount]' style='text-align: right;border: 0px solid #000000;' align='right'>
                     <input type='hidden' name='do[]' id='nodo$no' value='$dono'></td>
                     <td ><input type='text' name='prv[]' id='game$no' value='$data[PRVAmount]' size='10' onkeyup='UpdateCost($baris,$no)'></td>
                     <td ><input type='text' name='bal[]' id='bal$no' value='$data[balance]' size='10' style='text-align: right;border: 0px solid #000000' onChange='UpdateBal($baris,$no)' readonly></td>
                     <td ><textarea name='PRVNote[]' cols='10' rows='1' style='resize: none'>$data[PRVNote]</textarea></td>
                     </tr>";
                      $no++;
                    }
                    echo "</table>
                    Total Settlement $dat[KasCurr] <input type='text' id='totalcost'  name='totalcost' value=".number_format($dat[Total], 2, ',', '.');echo" readonly></br></br>
                    <input type=radio name='inc1' value='1' checked onClick='tampil1()'>&nbsp;Save
                    <input type=radio name='inc1' value='2' onClick='tampil2()'>&nbsp;Settlement 
                    <input type='text' name='operator1' value=' No :' size='2' style='text-align: center;border: 0px solid #000000;visibility:hidden'><input type='text' id='PRVNo' name='PRVNo' value='0' style='visibility:hidden'><br><br>
                    <input type=submit value='submit'>
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
         <form name='cari' method=get action='./media.php?module=mssettle&act=tambahkasbon'>
          <input type=hidden name=module value='mssettle&act=tambahkasbon'>
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
          <form method=POST name='visa' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=mssettle&act=input'>
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
    
  case "editkasbon":
    $edit=mysql_query("SELECT * FROM msvisa WHERE Id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Visa Data</h2>
          <form name='visa' method=POST action=./aksi.php?module=mssettle&act=update>
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
          <tr><td>Selling</td> <td>  <input type=text name='Selling' size=15 value='$r[Selling]'></td></tr>
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
          <th colspan=2>Kasbon</th>
          <tr><td>Date</td> <td>  <input type=text name='KasDate' size=15 value='$r[KasDate]'> 
          <A HREF='#' onClick="."cal.select(document.forms['visa'].KasDate,'anchor3','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='anchor3'> Select</A> (yyyy-mm-dd)
          </td></tr>
          <tr><td>No</td> <td>  <input type=text name='KasNo' size=15 value='$r[KasNo]'>
          <tr><td>Amount</td>  <td>  
          <select name='KasCurr'>"; 
          if ($r[KasCurr]=='IDR'){echo"<option value='IDR' selected>IDR</option>
                                      <option value='USD'>USD</option>" ;} 
          else if ($r[KasCurr]=='USD'){echo"<option value='IDR'>IDR</option>
                                      <option value='USD' selected>USD</option>";}   
    echo"</select> <input type=text name='KasAmount' size=15 value='$r[KasAmount]'> </td></tr>
          <th colspan=2>PRV</th>
          <tr><td>Date</td> <td>  <input type=text name='PRVDate' size=15 value='$r[PRVDate]'> 
          <A HREF='#' onClick="."cal.select(document.forms['visa'].PRVDate,'anchor3','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='anchor3'> Select</A> (yyyy-mm-dd)
          </td></tr>
          <tr><td>No</td> <td>  <input type=text name='PRVNo' size=15 value='$r[PRVNo]'>
          <tr><td>Amount</td>  <td>  
          <select name='PRVCurr'>"; 
          if ($r[PRVCurr]=='IDR'){echo"<option value='IDR' selected>IDR</option>
                                      <option value='USD'>USD</option>" ;} 
          else if ($r[PRVCurr]=='USD'){echo"<option value='IDR'>IDR</option>
                                      <option value='USD' selected>USD</option>";}   
    echo"</select> <input type=text name='PRVAmount' size=15 value='$r[PRVAmount]'> </td></tr>
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
}
?>
