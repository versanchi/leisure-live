<script language="JavaScript"  type="text/javascript">
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes,modal=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
function formatDollar(num) {
    var p = num.toFixed(2).split(".");
    return "$" + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
        return  num + (i && !(i % 3) ? "." : "") + acc;
    }, "") + "," + p[1];
}
     
function approvefile(ID, File)
{
if (confirm("Are you sure want to Approve Settlement No '" + File + "'"))
{
 window.location.href = '?module=mswo&act=addmswo&id=' + ID;
 
} 
}
function voidfile(ID, File)
{
if (confirm("Are you sure want to UN-APPROVE Settlement No '" + File + "'"))
{
 window.location.href = '?module=mswo&act=addmsvoid&id=' + ID;
 
} 
}
function UpdateCost(JUM, No) {                               
    var sum = 0;
    var tot = 0;
    var sumi = 0;
    var gn, elem,coba;
    var nod, elems, tes;
    var el,bal,elems,sum2,b; 
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
    sumi = eval(sum2)- eval(sum); 
  document.getElementById(net1).value = elems1.toFixed(0);
   
  }   document.getElementById('totalbalance').value = sum.toFixed(0);                                                        
  nod = 'nodo'+No;
  tes = 'game'+No;
  coba = 'nomor'+No;
  el = document.getElementById(coba);
  elems = document.getElementById(tes);   
  document.getElementById(nod).value = el.value;   
}
 function UpdateBal() {                                                       

var a = document.getElementById('totalbalance').value;
var b = document.getElementById('talbalance').value;
var Y1 = eval(b) - eval(a);
document.getElementById('totalcost').value = accounting.formatMoney(Y1);    
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
            
    echo "<h2>List Work Order</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='mswo'>
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
            $tampil=mysql_query("SELECT logwo.WONo,logwo.NettCurr,logwo.WODate,logwo.KasNo,tbl_mscountry.Country,tbl_msemployee.employee_name FROM logwo                                                  
                                LEFT JOIN tbl_msemployee ON tbl_msemployee.employee_id = logwo.WOPIC
                                left join tbl_mscountry on tbl_mscountry.CountryID = logwo.ProdEmbassy    
                                WHERE (logwo.WONo LIKE '%$nama%'
                                OR logwo.WODate LIKE '%$nama%')
                                AND logwo.WOStatus = '0'                           
                                Group BY logwo.WONo  
                                order by logwo.WODate Desc,logwo.WONo ASC LIMIT $posisi,$batas");
            $jumlah=mysql_num_rows($tampil);
            $tampil2=mysql_query("SELECT SUM(NettAmount) as Total FROM logwo                                                  
                                WHERE (WONo LIKE '%$nama%'
                                OR WODate LIKE '%$nama%')
                                AND WOStatus = '0'                           
                                Group BY WONo  
                                order by WODate Desc,WONo ASC LIMIT $posisi,$batas");
            if ($jumlah > 0) {
            echo "<table>
                    <tr><th>no</th><th>date</th><th>WO no.</th><th>PIC</th><th>embassy</th><th>Amount</th><th>action</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){ 
                    $data2=mysql_fetch_array($tampil2) ;  
               echo "<tr><td>$no</td>
                     <td>$data[WODate]</td>
                     <td>$data[WONo]</td>
                     <td>$data[employee_name]</td>
                     <td>$data[Country]</td>  
                     <td>$data[NettCurr] ".number_format($data2[Total], 2, ',', '.');echo"</td>  
                     <td>";if($data[KasNo]=='' or $data[PRVNo]<>'' ){}else{echo"
                     <center><a href=?module=mswo&act=addmswo&id=$data[WONo]><img src='../images/file.gif'></a>";
                     }echo"</td>
                     </tr>";
                      $no++;
                    }
                    echo "</table>";
                    
                    // Langkah 3            
                    $tampil2    = "SELECT WONo,NettCurr,WODate FROM logwo                                                  
                                WHERE (WONo LIKE '%$nama%'
                                OR WODate LIKE '%$nama%')
                                AND WOStatus = '0'                           
                                Group BY WONo 
                                order by WODate Desc ";
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=mswo";
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
  
    case "addmswo":    
      echo "<h2>Report WO</h2>";

     $tampil=mysql_query("SELECT * FROM msvisa 
                                LEFT JOIN tbl_mscountry ON tbl_mscountry.CountryID=msvisa.ProdEmbassy
                                WHERE msvisa.WONo = '$_GET[id]' 
                                AND msvisa.ProdType = 'Visa'          
                                ORDER BY tbl_mscountry.Country ASC,msvisa.ProdProcess ASC,msvisa.ActIn DESC");
     $jumlah=mysql_num_rows($tampil);
     $tam=mysql_query("SELECT SUM(balance) as Total,SUM(PRVAmount) as Totalprv,SUM(NettAmount) as Totalnet,ActEstimasi,WONo,KasCurr FROM msvisa                                                           
                                WHERE WONo = '$_GET[id]' 
                                AND ProdType = 'Visa' ");
     $dat=mysql_fetch_array($tam); 
            if ($jumlah > 0) {
                $baris = $jumlah+1 ;
                echo "
                <form method=POST name='visa' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=mswo&act=input'>
                <input type=hidden name='KASNo' value='$tahun1-$tiket1'>  
                <input type=hidden name='KASDate' value='$mem'>
                
                Work Order No : $dat[WONo]
                <table>
                    <tr><th>no</th><th>do no.</th><th>pax name</th><th>passport no</th><th>embassy</th><th>Price</th><th>settlement</th><th>balance</th><th>remarks</th><th>Date</th>";
            
            echo "</tr>"; 
                  $no=$posisi+1;
                  echo"<input type=hidden name='No' value='$jumlah'>
                  <input type='hidden' name='curr' value='$dat[KasCurr]'><input type='hidden' name='kasno' value='$dat[KasNo]'>";
                    while ($data=mysql_fetch_array($tampil)){
                    $dono = $data['DONo']; 
                    $not=$no-1;   
               echo "<input type=hidden name='DONo' id='nomor$no' value='$data[DONo]'>
                     <input type=hidden name='Net[]' value='$data[NettAmount]'> 
                     <tr><td>$no</td> 
                     <td>$data[DONo]</td>
                     <td>$data[PaxName]</td>
                     <td>$data[PassNo]</td>
                     <td>$data[Country]</td>
                     <td><input type='text' name='operate' id='nett$no' size='8' value='$data[NettAmount]'  style='text-align: right;border: 0px solid #000000;' align='right'>
                     <input type='hidden' name='do[]' id='nodo$no' value='$dono'></td>
                     <td ><input type='text' name='prv[]' id='game$no' value='$data[PRVAmount]' size='8' onkeyup='UpdateCost($baris,$no);UpdateBal();'></td>
                     <td ><input type='text' name='bal[]' id='bal$no' value='$data[balance]' size='8' style='text-align: right;border: 0px solid #000000' readonly></td>
                     <td ><textarea name='PRVNote[]' cols='10' rows='1' style='resize: none'>$data[PRVNote]</textarea></td>
                     <td><input type='text' name='ActIn[]' size='9' value='$data[ActIn]' onClick="."cal.select(document.forms['visa'].ActIn$not,'ActIns$not','yyyy-MM-dd'); return false;"." NAME='anchor$not' ID='ActIns$not'></td>
                     </tr>";
                      $no++;
                    }
                    echo "</table>
                    Total Balance $dat[KasCurr] <input type='text' id='totalcost'  name='totalcost' value=".number_format($dat[Total], 2, ',', '.');echo" readonly><input type='hidden' id='totalbalance'  name='totalbalance' value='$dat[Totalprv]' onkeyup='UpdateBal()' ><input type='hidden' id='talbalance'  name='talbalance' value='$dat[Totalnet]' ></br></br>
                    
                    <center><input type=submit value='Submit'> &nbsp&nbsp <input type=button value=Cancel onclick=self.history.back()> </center>
                    </form>";
            }
     break;
    
  case "addmsvoid":
    $dua=mysql_query("SELECT * FROM logsettle                                                  
                                WHERE PRVCode = '$_GET[id]'   ");
    
    while($isidua=mysql_fetch_array($dua)){
    mysql_query("update msvisa set PRVNo = '', StatCancel = '0'
                                    WHERE DONo = '$isidua[DONo]'");
    }                                                                                    
    $edit=mysql_query("update logsettle set statuslog='2' WHERE PRVCode = '$_GET[id]'"); 
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mswo'>";   
     break; 
}
?>
