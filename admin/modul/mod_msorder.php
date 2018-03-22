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
  reason += validateSelect(theForm.ActPIC);
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
function validateSelect(fld) {
    var error = "";
 
    if (fld.value == 0) {
        fld.style.background = 'Yellow'; 
        error = "The required field has not been selected.\n"
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
     $emb = $_GET['emb']; 
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
     $hari = date("Y-m-d", time());
     echo "<h2>Take Order</h2>
            <form name='cari' method=get action='./media.php?module=msorder'>
          <input type=hidden name=module value='msorder'>
          
          Date : <select name='nama'  >
            <option value='0' selected>- select date -</option>";
            $tampil=mysql_query("SELECT * FROM msvisa where WONo = '' AND ProdType='Visa'  AND  StatCancel <>'1' and ActIn >= '$hari' group by ActIn   ");
            while($r=mysql_fetch_array($tampil)){
                if ($mem == $r[ActIn]){
                   echo "<option value=$r[ActIn] selected>$r[ActIn]</option>";
                } else {
                   echo "<option value=$r[ActIn]>$r[ActIn]</option>";
                }                                          
                
            }
    echo "</select> 
     <select name='emb' id='emb'><option value=0 selected>- All Embassy -</option>"; 
           $tampila=mysql_query("SELECT * FROM tbl_mscountry                                  
                LEFT JOIN msvisa ON msvisa.ProdEmbassy = tbl_mscountry.CountryID 
                where msvisa.WONo = '' AND msvisa.ProdType='Visa'  AND  msvisa.StatCancel <>'1' 
                group by Country");
            while($s=mysql_fetch_array($tampila)){
                if ($emb==$s[CountryID]) {
                               echo "<option value=$s[CountryID] selected>$s[Country]</option>";
                            } else {
                               echo "<option value=$s[CountryID] >$s[Country]</option>";
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
     if($emb==0){
        $tampil=mysql_query("SELECT * FROM msvisa 
                                LEFT JOIN tbl_mscountry ON tbl_mscountry.CountryID=msvisa.ProdEmbassy
                                WHERE msvisa.ActIn = '$mem' 
                                AND msvisa.KasCurr = '$kurr'     
                                AND msvisa.ProdType = 'Visa' 
                                AND msvisa.WONo = '' 
                                AND msvisa.StatCancel <> 1 
                                ORDER BY tbl_mscountry.Country ASC,msvisa.ActIn DESC");    
     }else{
     $tampil=mysql_query("SELECT * FROM msvisa 
                                LEFT JOIN tbl_mscountry ON tbl_mscountry.CountryID=msvisa.ProdEmbassy
                                WHERE msvisa.ActIn = '$mem'
                                AND msvisa.KasCurr = '$kurr' 
                                AND msvisa.ProdEmbassy = '$emb'
                                AND msvisa.ProdType = 'Visa' 
                                AND msvisa.WONo = '' 
                                AND msvisa.StatCancel <> 1 
                                ORDER BY tbl_mscountry.Country,msvisa.ActIn DESC");
     }
     $jumlah=mysql_num_rows($tampil);
     if($emb==0){ 
        $tam=mysql_query("SELECT SUM(NettAmount) as Total,ActEstimasi FROM msvisa                                                           
                                WHERE ActIn = '$mem' 
                                AND msvisa.KasCurr = '$kurr'     
                                AND ProdType = 'Visa'
                                AND msvisa.WONo = ''
                                AND StatCancel <> 1 group by ActIn ");
     }else{
        $tam=mysql_query("SELECT SUM(NettAmount) as Total,ActEstimasi FROM msvisa                                                           
                                WHERE ActIn = '$mem'
                                AND KasCurr = '$kurr' 
                                AND ProdEmbassy = '$emb'
                                AND ProdType = 'Visa'
                                AND WONo = ''
                                AND StatCancel <> 1 group by ActIn ");
     }
     $dat=mysql_fetch_array($tam); 
            if ($jumlah > 0) {
                $baris = $jumlah+1 ;
                echo "
                <form method=POST name='visa' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msorder&act=input'>
                <input type=hidden name='KASNo' value='$tahun1-$tiket1'>  
                <input type=hidden name='KASDate' value='$mem'>
                <table>
                    <tr><th>no</th><th></th><th>do no.</th><th>pax name</th><th>passport no</th><th>embassy</th><th>process</th><th>completed</th><th>Price</th>";
            
            echo "</tr>"; 
                  $no=$posisi+1;
                  echo"<input type=hidden name='No' value='$no'>";
                while ($data=mysql_fetch_array($tampil)){
                    $dono = $data['DONo'];    
               echo "<input type=hidden name='DONo' id='nomor$no' value='$data[DONo]'>
                    <input type=hidden name='sell[]' value='$data[NettAmount]'>
                    <input type=hidden name='ProdProcess[]' value='$data[ProdProcess]'>
                    <input type=hidden name='ProdEmbassy[]' value='$data[ProdEmbassy]'>
                    <input type=hidden name='NettCurr[]' value='$data[NettCurr]'>
                    <input type=hidden name='PaxName[]' value='$data[PaxName]'>
                    <input type=hidden name='TourCode[]' value='$data[TourCode]'> 
                    <input type=hidden name='ActIn[]' value='$data[ActIn]'> 
                    <input type=hidden name='KasNo[]' value='$data[KasNo]'> 
                     <tr><td>$no</td>
                     <td><input type='checkbox' id='game$no' value='$data[NettAmount]' onclick='UpdateCost($baris,$no,$no)' checked></td>
                     <td>$data[DONo]</td>
                     <td>$data[PaxName]</td>
                     <td>$data[PassNo]</td>
                     <td>$data[Country]</td>
                     <td>$data[ActIn]</td>      
                     <td>$data[ActOut]</td>
                     <td align=right>".number_format($data[NettAmount], 2, ',', '.');echo"
                     <input type='hidden' name='do[]' id='nodo$no' value='$dono'></td>";
               echo "</tr>";
                      $no++;
                    }
                    echo "</table>
                    Total $kurr <input type='text' id='totalcost' name='totalcost' value=".number_format($dat[Total], 2, ',', '.');echo" readonly></br></br>
                    PIC <select name='ActPIC' >
                    <option value=0 selected>- Select PIC -</option>";
                        $tampil=mysql_query("SELECT * FROM tbl_msemployee
                        left join tbl_msoffice on tbl_msoffice.office_id = tbl_msemployee.office_id
                                        where tbl_msoffice.office_code = 'DOC'  
                                        order by employee_name ASC");
                    while($v=mysql_fetch_array($tampil)){
                         if ($r[ActPIC]==$v[employee_id]) {
                                       echo "<option value=$v[employee_id] selected>$v[employee_name]</option>";
                                    } else {
                                       echo "<option value=$v[employee_id]>$v[employee_name]</option>";  
                                    }  
                                }
                    echo "</select><br><br>
                            <input type=submit value='Create Order'>
                            </form>";
                    }
     break;
  
 
    
  case "suksesorder":
    $edit=$_GET['id'];             
    $tampilw = mysql_query("SELECT * FROM logwo
                where WONo ='$edit' ");
    $hasilw = mysql_fetch_array($tampilw);
    $pic=$hasilw[WOPIC];
    $tampil=mysql_query("SELECT * FROM tbl_msemployee   
                        where employee_id = '$pic'");
    $v=mysql_fetch_array($tampil); 
    echo "<h2>$v[employee_name] SUCCESS TAKE ORDER WITH : $edit</h2>
          <center><input type=button value='Next' onclick=location.href='?module=msorder'>      
         <br><br>";
    break;  
}
?>
