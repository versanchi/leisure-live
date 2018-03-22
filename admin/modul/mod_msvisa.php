<script type="text/javascript">  
function ceks(ISI) {                       
  if (document.example.elements['cek1'].checked == true) {  
     if (confirm("Are you sure want to CHANGE DATE "))
{
    document.example.elements['ActIn1'].disabled=false ;
    document.example.elements['ActIn1'].value='' ; 
}else {
    document.example.elements['cek1'].checked = false ;
}  
       }
  if (document.example.elements['cek1'].checked == false) {
   document.example.elements['ActIn1'].disabled=true ;
   document.example.elements['ActIn1'].value=document.example.elements['in'].value ;
  } 
}
  
</script>
<script language="JavaScript"  type="text/javascript">
     
function delfile(ID, File)
{
if (confirm("Are you sure you want to Cancel '" + File + "'"))
{
 window.location.href = '?module=msvisa&act=deletemsvisa&id=' + ID;   
}
}
</script>
<script type="text/javascript"> 
function validateFormOnSubmit(theForm) {   
var reason = "";
  reason += validateSelect(theForm.Divisi);
  reason += validateSelect(theForm.TcName);
  reason += validateEmpty(theForm.PaxName); 
  reason += validateEmpty(theForm.Invoice);      
  reason += validateSelect(theForm.ProdEmbassy);  
  reason += validateSelect(theForm.ProdProcess);
  reason += validateEmpty(theForm.ActIn);
  reason += validateType(theForm.ProdTy);  
      
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
function validateType(fld) {
    var error = "";     
    if (fld.value == 'Visa' && example.PassNo.value.length == 0) {
        example.PassNo.style.background = 'Yellow'; 
        error = "The required field has not been filled in.\n"    
    } else {  
        example.PassNo.style.background = 'White';   
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
<script type="text/javascript"> 
function validFormOnSubmit(theForm) {
var reason = ""; 
  reason += validateEmpty(theForm.Invoice);
  reason += validateEmpty(theForm.ActIn);  
      
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
<script type='text/javascript'>
 function showTc()
 {                                    
 <?php                                                    
 // membaca semua data currency
 $query = "SELECT * FROM tbl_msoffice ";
 $hasil = mysql_query($query);
 
 // membuat if untuk masing-masing pilihan currency 
 while ($data = mysql_fetch_array($hasil))
 {
   $idDest = $data['office_id'];                                                  
   // membuat IF untuk masing-masing currency
   echo "if (document.example.Divisi.value == \"".$idDest."\")"; 
   echo "{";       
    
   // membuat hasil kurs untuk masing-masing currency
   $query2 = "SELECT * FROM tbl_msemployee 
                LEFT JOIN tbl_msoffice ON tbl_msoffice.office_id = tbl_msemployee.office_id
                WHERE tbl_msemployee.office_id = '$idDest' order by employee_name ";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('TcNama').innerHTML = \"";
   $content .= "<option value='0'>- Select -</option>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['employee_id']."'>".$data2['employee_name']."</option>";
   }
   $content .= "\"";
   echo $content;
   echo "}\n";
   echo "else if (document.example.Divisi.value == '0'){";
   
   // membuat hasil kurs untuk masing-masing currency
   $content = "document.getElementById('TcNama').innerHTML = \"";
   $content .= "<option value=''></option>";
   
   $content .= "\"";
   echo $content;
   echo "}\n";          
 }
  ?>
 
 }
 function showNett()
 {                                    
 <?php                                                    
 // membaca semua data currency
 $query = "SELECT * FROM msproduct ";
 $hasil = mysql_query($query);
 
 // membuat if untuk masing-masing pilihan currency 
 while ($data = mysql_fetch_array($hasil))
 {
   $idDest = $data['ProdId'];                                                  
   // membuat IF untuk masing-masing currency
   echo "if (document.example.ProdProcess.value == \"".$idDest."\")"; 
   echo "{";       
    
   // membuat hasil kurs untuk masing-masing currency
   $query2 = "SELECT * FROM msproduct                                                      
                WHERE ProdId = '$idDest' ";  
   $hasil2 = mysql_query($query2);
   $data2 = mysql_fetch_array($hasil2); 
   $content = "document.getElementById('ProdNet').innerHTML = \"";   
   $content .= "<option value='".$data2['ProdNett']."'>".$data2['ProdCurr'].". ".$data2['ProdNett']."</option>";
   
   $content .= "\"";
   echo $content;
   echo "}\n";
   echo "else if (document.example.ProdProcess.value == '0'){";
   
   // membuat hasil kurs untuk masing-masing currency
   $content = "document.getElementById('ProdNet').innerHTML = \"";       
   $content .= "<option value=''></option>";
   
   $content .= "\"";
   echo $content;
   echo "}\n";          
 }
  ?>
  <?php                                                    
 // membaca semua data currency
 $query = "SELECT * FROM msproduct ";
 $hasil = mysql_query($query);
 
 // membuat if untuk masing-masing pilihan currency 
 while ($data = mysql_fetch_array($hasil))
 {
   $idDest = $data['ProdId'];                                                  
   // membuat IF untuk masing-masing currency
   echo "if (document.example.ProdProcess.value == \"".$idDest."\")"; 
   echo "{";       
    
   // membuat hasil kurs untuk masing-masing currency
   $query2 = "SELECT * FROM msproduct                                                      
                WHERE ProdId = '$idDest' ";  
   $hasil2 = mysql_query($query2);
   $data2 = mysql_fetch_array($hasil2); 
   $content = "document.getElementById('ProdTyp').value='".$data2['ProdType']."'";               
   echo $content;
   echo "}\n";
   echo "else if (document.example.ProdProcess.value == '0'){";
   
   // membuat hasil kurs untuk masing-masing currency
   $content = "document.getElementById('ProdTyp').value='tes'";   
   echo $content;
   echo "}\n";          
 }
  ?>
 }
 function showEmbassy()
 {                                    
 <?php                                                    
 // membaca semua data currency
 $query = "SELECT * FROM msproduct GROUP BY ProdType";
 $hasil = mysql_query($query);
 
 // membuat if untuk masing-masing pilihan currency 
 while ($data = mysql_fetch_array($hasil))
 {
   $idDest = $data['ProdType'];                                                  
   // membuat IF untuk masing-masing currency
   echo "if (document.example.ProdType.value == \"".$idDest."\")"; 
   echo "{";       
    
   // membuat hasil kurs untuk masing-masing currency
   $query2 = "SELECT * FROM msproduct 
                LEFT JOIN tbl_mscountry ON tbl_mscountry.CountryID = msproduct.ProdEmbassy
                WHERE ProdType = '$idDest' group by Country ";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('ProdEmb').innerHTML = \"";
   $content .= "<option value='0'>- Select -</option>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['CountryID']."'>".$data2['Country']."</option>";
   }
   $content .= "\"";
   echo $content;
   echo "}\n";
   echo "else if (document.example.ProdType.value == '0'){";
   
   // membuat hasil kurs untuk masing-masing currency
   $content = "document.getElementById('ProdEmb').innerHTML = \"";
   $content .= "<option value=''></option>";
   
   $content .= "\"";
   echo $content;
   echo "}\n";          
 }
  ?>
 
 }
 function showProcess()
 {
 <?php                                                    
 // membaca semua data currency
 $query = "SELECT * FROM tbl_mscountry ";
 $hasil = mysql_query($query);
 
 // membuat if untuk masing-masing pilihan currency 
 while ($data = mysql_fetch_array($hasil))
 {
   $idDest = $data['CountryID'];                                                  
   // membuat IF untuk masing-masing currency
   echo "if (document.example.ProdEmbassy.value == \"".$idDest."\")"; 
   echo "{";       
    
   // membuat hasil kurs untuk masing-masing currency
   $query2 = "SELECT * FROM msproduct                                                      
                WHERE ProdEmbassy = '$idDest' ";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('ProdPro').innerHTML = \"";
   $content .= "<option value='0'>- Select -</option>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['ProdId']."'>".$data2['ProdType']." - ".$data2['ProdProcess']."</option>";
   }
   $content .= "\"";
   echo $content;
   echo "}\n";
   echo "else if (document.example.ProdEmbassy.value == '0'){";
   
   // membuat hasil kurs untuk masing-masing currency
   $content = "document.getElementById('ProdPro').innerHTML = \"";
   $content .= "<option value=''></option>";
   
   $content .= "\"";
   echo $content;
   echo "}\n";          
 }
  ?>                        
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
			
    echo "<h2>Sales Progress</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='msvisa'>
			  <input type=text name=nama value='$nama' size=40>	
			  <input type=submit name=oke value=Search>
		  </form>";
    if ($JobDesc!=2) {
		echo "<input type=button value='Add New' onclick=location.href='?module=msvisa&act=tambahvisa'>";
	}
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
		    $tampil=mysql_query("SELECT * FROM msvisa 
								LEFT JOIN tbl_mscountry ON tbl_mscountry.CountryID=msvisa.ProdEmbassy
								WHERE (msvisa.PaxName LIKE '%$nama%' 
								OR msvisa.PassNo LIKE '%$nama%' 
								OR msvisa.DONo LIKE '%$nama%'
								OR tbl_mscountry.Country LIKE '%$nama%' )
                                AND msvisa.StatCancel = '0'
                                AND (msvisa.ActOut > '$hari'
                                OR msvisa.ActOut = '0000-00-00'
                                OR msvisa.PRVNo = '' )
								ORDER BY Id DESC,ActIn DESC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>do no.</th><th>pax name</th><th>passport no</th><th>embassy</th><th>process</th><th>Cash advance</th><th>completed</th><th>Status</th>";
			if ($JobDesc!=2) { echo "<th>action</th>"; }
			echo "</tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){    
			   echo "<tr><td>$no</td>
					 <td>$data[DONo]</td>
					 <td>$data[PaxName]</td>
					 <td>$data[PassNo]</td>
					 <td>$data[Country]</td>
					 <td>$data[ActIn]</td>
					 <td>$data[ActEstimasi]</td>
					 <td>$data[ActOut]</td>
                     <td><center>";if($data[PRVNo]<>''){echo"<img src='../images/done.png'>";}
                           else{
                                if($data[KasNo]<>''){echo"<img src='../images/process.gif'>";}
                                else{ if($data[ProdType]=='PASSPORT' && $data[ActOut] <> '0000-00-00') {echo"<img src='../images/done.png'>";}
                                    else {
                                    echo"";
                                    }
                                } 
                           }echo"</td>"; 
			   if ($JobDesc!=2) {
                 if($data[StatCancel]==0){    
					 if($data[KasNo]==''){
                     echo "<td><center><a href=?module=msvisa&act=editvisa&id=$data[Id]><img src='../images/edit.gif'></a>";
                     }
                     if($data[KasNo]<>''){
                     echo "<td><center><a href=?module=msvisa&act=editvisa1&id=$data[Id]><img src='../images/edit.gif'></a>";
                     }
                    if ($data[Status]=='0'){echo"
                     &nbsp|&nbsp <a href=\"javascript:delfile('$data[Id]','$data[DONo]')\"><img src='../images/cancel.gif'></a></td>";
                    } 
                    }
               }
			   echo "</tr>";
					  $no++;
					}
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM msvisa 
                                LEFT JOIN tbl_mscountry ON tbl_mscountry.CountryID=msvisa.ProdEmbassy
                                WHERE (msvisa.PaxName LIKE '%$nama%' 
                                OR msvisa.PassNo LIKE '%$nama%' 
                                OR msvisa.DONo LIKE '%$nama%'
                                OR tbl_mscountry.Country LIKE '%$nama%')
                                AND msvisa.StatCancel = '0' 
                                AND (msvisa.ActOut > '$hari'
                                OR msvisa.ActOut = '0000-00-00'
                                OR msvisa.PRVNo = '' ) 
                                ORDER BY ActIn DESC, Id DESC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=msvisa";
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
  
  case "tambahvisa":
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
    echo "<h2>Add New Sales</h2>
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msvisa&act=input'>
          <input type=hidden name='DONo' value='DO-$tahun1$tiket1'>
          <table>
		  <th colspan=2>detail</th>                
		  <tr><td>Date</td> <td>  <input type=text name='Date' size=10 value='$inputdate' readonly></td></tr>
          <tr><td>Divisi</td> <td> <select name='Divisi' onChange='showTc()'>
            <option value=0 selected>- Select Divisi -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msemployee 
                                left join tbl_msoffice on tbl_msoffice.office_id = tbl_msemployee.office_id
                                group by tbl_msemployee.office_id
                                order by office_code ASC");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[office_id]>$r[office_code]</option>";
            }
    echo "</select></td></tr> 
          <tr><td>TC Name</td> <td> <select name='TcName' id='TcNama'>  </select></td></tr> 
          <tr><td>Tour Code</td> <td><select name='TourCode' >
            <option value='' selected>- Select Tour Code -</option>";
            $tampil=mysql_query("SELECT * FROM productdetails     
                                order by tourcode ASC");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[tourcode]'>$r[tourcode]</option>";
            }
    echo "</select></td></tr> 
          <tr><td>Pax Name</td> <td>  <input type=text name='PaxName' size=50></td></tr>
		  <tr><td>Passport No.</td> <td>  <input type=text name='PassNo' size=15></td></tr>
          <tr><td>Invoice</td> <td>  <input type=text name='Invoice' size=15></td></tr> 
          <tr><td>Selling</td> <td><select name='curr'>
          <option value='IDR' selected>IDR</option>
          <option value='USD'>USD</option>
          <option value='EUR'>EUR</option>
          </select>  <input type=text name='Selling' size=15></td></tr>
          <tr><td>PO</td> <td>  <input type=text name='PO' size=15></td></tr> 
		  <th colspan=2>Product</th>    
          <tr><td>Embassy</td>  <td>  
          <select name='ProdEmbassy' id='ProdEmb' onChange='showProcess()'><option value='0' selected>- Select Embassy -</option>";
            $tampil=mysql_query("SELECT * FROM msproduct 
                LEFT JOIN tbl_mscountry ON tbl_mscountry.CountryID = msproduct.ProdEmbassy
                group by Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[CountryID]>$r[Country]</option>";
            }
    echo "</select></td></tr>
          <tr><td>Type</td>  <td><select name='ProdProcess' id='ProdPro' onChange='showNett()'></select><input type=hidden name='ProdTy' id='ProdTyp'></td></tr>
           
          <tr><td>Nett</td>  <td><text name='ProdNett' id='ProdNet' value=''></td></tr> 
           
           <th colspan='2'>Action</th>
          
          <tr><td>In</td> <td>  <input type=text name='ActIn' size=15 onClick="."cal.select(document.forms['example'].ActIn,'anchor3','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='anchor3' >
		 (yyyy-mm-dd)
		  </td></tr>
		  <tr><td>Cash Advance Date</td> <td>  <input type=text name='ActEstimasi' size=15 onClick="."cal.select(document.forms['example'].ActEstimasi,'anchor1','yyyy-MM-dd'); return false;"." NAME='anchor1' ID='anchor1'> 
		  (yyyy-mm-dd)
		  </td></tr>
		  <tr><td>Out</td> <td>  <input type=text name='ActOut' size=15 onClick="."cal.select(document.forms['example'].ActOut,'anchor2','yyyy-MM-dd'); return false;"." NAME='anchor2' ID='anchor2'>
		  (yyyy-mm-dd)		  
          </td></tr>
          <tr><td>Remarks</td><td><textarea name='ActRemarks' cols='50' rows='3'></textarea></td></tr>
		  <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;
    
  case "editvisa":
    $edit=mysql_query("SELECT * FROM msvisa WHERE Id='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $inact=$r[ActIn];
    if($r[WONo]==''){$dis='enabled';$cekdis='disabled';}
    else if($r[WONo]<>''){$dis='disabled';$cekdis='enabled';}
    echo "<h2>Edit Visa Data</h2>
          <form name='example' onsubmit='return validateFormOnSubmit(this)' method='POST' action=./aksi.php?module=msvisa&act=update>
          <input type=hidden name='id' value='$r[Id]'>
          <input type=hidden name='dis' value='$dis'> 
          <table>
		  <th colspan=2>detail</th>
          <tr><td>DO No.</td> <td>$r[DONo]</td></tr>
          <tr><td>Cash Advance No.</td> <td>$r[KasNo]</td></tr>
          <tr><td>Settlement No.</td> <td>$r[PRVNo]</td></tr>
          <tr><td>Date</td> <td>  <input type=text name='Date' size=10 value='$r[Date]' readonly></td></tr>
          <tr><td>Divisi</td> <td> <select name='Divisi' onChange='showTc()' ";if($r[KasNo]<>''){echo"disabled";} echo" >
            <option value=0 selected>- Select Divisi -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msemployee 
                                left join tbl_msoffice on tbl_msoffice.office_id = tbl_msemployee.office_id
                                group by tbl_msemployee.office_id
                                order by office_code ASC");
            while($v=mysql_fetch_array($tampil)){
                 if ($r[Divisi]==$v[office_id]) {
                               echo "<option value=$v[office_id] selected>$v[office_code]</option>";
                            } else {
                               echo "<option value=$v[office_id]>$v[office_code]</option>";
                            }  
                        }
    echo "</select></td></tr> 
          <tr><td>TC Name</td> <td> <select name='TcName' id='TcNama'";if($r[KasNo]<>''){echo"disabled";} echo">";
            $tampil=mysql_query("SELECT * FROM tbl_msemployee 
                                order by employee_name ASC");
            while($v=mysql_fetch_array($tampil)){
                 if ($r[TcName]==$v[employee_id]) {
                               echo "<option value=$v[employee_id] selected>$v[employee_name]</option>";
                            } else {
                               echo "<option value=$v[employee_id] >$v[employee_name]</option>";
                            }  
                        }
    echo"</select></td></tr> 
          <tr><td>Tour Code</td> <td><select name='TourCode' ";if($r[KasNo]<>''){echo"disabled";} echo" >
            <option value='' selected>- Select Tour Code -</option>";
            $tampil=mysql_query("SELECT * FROM productdetails     
                                order by tourcode ASC");
            while($v=mysql_fetch_array($tampil)){
                 if ($r[TourCode]==$v[tourcode]) {
                               echo "<option value='$v[tourcode]' selected>$v[tourcode]</option>";
                            } else {
                               echo "<option value='$v[tourcode]'>$v[tourcode]</option>";
                            }  
                        }
    echo "</select></td></tr>
          <tr><td>Pax Name</td> <td>  <input type=text name='PaxName' size=50 value='$r[PaxName]'";if($r[KasNo]<>''){echo"readonly";} echo"></td></tr>
          <tr><td>Passport No.</td> <td>  <input type=text name='PassNo' size=15 value='$r[PassNo]'";if($r[KasNo]<>''){echo"readonly";} echo"></td></tr>
          <tr><td>Invoice</td> <td>  <input type=text name='Invoice' size=15 value='$r[Invoice]'></td></tr> 
          <tr><td>Selling</td> <td><select name='curr'";if($r[KasNo]<>''){echo"disabled";} echo">"; 
          if ($r[KasCurr]=='IDR'){echo"<option value='IDR' selected>IDR</option>
                                      <option value='USD'>USD</option>
                                      <option value='EUR'>EUR</option>" ;} 
          else if ($r[KasCurr]=='USD'){echo"<option value='IDR'>IDR</option>
                                      <option value='USD' selected>USD</option>
                                      <option value='EUR'>EUR</option>";}
          else if ($r[KasCurr]=='EUR'){echo"<option value='IDR'>IDR</option>
                                      <option value='USD' selected>USD</option>
                                      <option value='EUR'>EUR</option>";}    
    echo"</select> <input type=text name='Selling' size=15 value='$r[Selling]'";if($r[KasNo]<>''){echo"readonly";} echo"></td></tr>
          <tr><td>PO</td> <td>  <input type=text name='PO' size=15 value='$r[PO]'";if($r[KasNo]<>''){echo"readonly";} echo"></td></tr> 
          <th colspan=2>Product</th>    
          <tr><td>Embassy</td>  <td>  
          <select name='ProdEmbassy' id='ProdEmb' onChange='showProcess()'";if($r[KasNo]<>''){echo"disabled";} echo"><option value=0 selected>- Select Embassy -</option>";
            $tampila=mysql_query("SELECT * FROM msproduct 
                LEFT JOIN tbl_mscountry ON tbl_mscountry.CountryID = msproduct.ProdEmbassy
                group by Country");
            while($s=mysql_fetch_array($tampila)){
                if ($r[ProdEmbassy]==$s[CountryID]) {
                               echo "<option value=$s[CountryID] selected>$s[Country]</option>";
                            } else {
                               echo "<option value=$s[CountryID]>$s[Country]</option>";  
                            }  
                        }
    echo "</select></td></tr>
          <tr><td>Type</td>  <td><select name='ProdProcess' id='ProdPro' onChange='showNett()'";if($r[KasNo]<>''){echo"disabled";} echo"> ";
          $tampilb=mysql_query("SELECT * FROM msproduct where ProdEmbassy = $r[ProdEmbassy] GROUP By ProdProcess");
            while($f=mysql_fetch_array($tampilb)){
                if ($r[ProdProcess]==$f[ProdProcess]) {
                               echo "<option value=$f[ProdId] selected>$f[ProdType] - $f[ProdProcess]</option>";
                            } else {
                               echo "<option value=$f[ProdId]>$f[ProdType] - $f[ProdProcess]</option>";  
                            }  
                        }
    echo"</select><input type=hidden name='ProdTy' id='ProdTyp' value='$r[ProdType]'></td></tr>
          <tr><td>Nett</td>  <td><text name='ProdNett' id='ProdNet' >$r[NettCurr]. $r[NettAmount]</td></tr>
           <th colspan='2'>Action</th>
          
          <tr><td>In</td> <td>  <input type='text' name='ActIn' size='15' value='$r[ActIn]' onClick="."cal.select(document.forms['example'].ActIn,'ActIn1','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn1' $dis>
           (yyyy-mm-dd)
          <input type='checkbox'  name='cek1' id='cek1' onclick='ceks($inact)' $cekdis> Change Date</td></tr>
          <input type=hidden name='in' id='in' value='$inact'>
          <tr><td>Cash Advance Date</td> <td>  <input type=text name='ActEstimasi' size=15 value='$r[ActEstimasi]' onClick="."cal.select(document.forms['example'].ActEstimasi,'anchor1','yyyy-MM-dd'); return false;"." NAME='anchor1' ID='anchor1'";if($r[KasNo]<>''){echo"disabled";} echo"> 
            (yyyy-mm-dd)   
          </td></tr>
          <tr><td>Out</td> <td>  <input type=text name='ActOut' size=15 value='$r[ActOut]' onClick="."cal.select(document.forms['example'].ActOut,'anchor2','yyyy-MM-dd'); return false;"." NAME='anchor2' ID='anchor2'>
           (yyyy-mm-dd)          
          </td></tr>
          <tr><td>Remarks</td><td><textarea name='ActRemarks' cols='50' rows='3' style='resize: none'>$r[ActRemarks]</textarea></td></tr>
          <tr><td colspan=2><center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
    break; 
    
     case "editvisa1":
    $edit=mysql_query("SELECT * FROM msvisa WHERE Id='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $inact=$r[ActIn];
    echo "<h2>Edit Visa Data</h2>
          <form name='example' onsubmit='return validFormOnSubmit(this)' method='POST' action=./aksi.php?module=msvisa&act=update1>
          <input type=hidden name=id value='$r[Id]'>
          <table>
          <th colspan=2>detail</th>
          <tr><td>DO No.</td> <td>$r[DONo]</td></tr>
          <tr><td>Cash Advance No.</td> <td>$r[KasNo]</td></tr>
          <tr><td>Settlement No.</td> <td>$r[PRVNo]</td></tr>
          <tr><td>Date</td> <td> $r[Date]</td></tr>
          <tr><td>Divisi</td> <td> ";
            $tampil=mysql_query("SELECT * FROM tbl_msemployee 
                                left join tbl_msoffice on tbl_msoffice.office_id = tbl_msemployee.office_id
                                group by tbl_msemployee.office_id
                                order by office_code ASC");
            while($v=mysql_fetch_array($tampil)){
                 if ($r[Divisi]==$v[office_id]) {
                               echo "$v[office_code]";
                            } 
                        }
    echo "</select></td></tr> 
          <tr><td>TC Name</td> <td> ";
            $tampil=mysql_query("SELECT * FROM tbl_msemployee 
                                order by employee_name ASC");
            while($v=mysql_fetch_array($tampil)){
                 if ($r[TcName]==$v[employee_id]) {
                               echo "$v[employee_name]";
                            } 
                        }
    echo"</select></td></tr> 
          <tr><td>Tour Code</td> <td> $r[TourCode]</td></tr>
          <tr><td>Pax Name</td> <td>  $r[PaxName]</td></tr>
          <tr><td>Passport No.</td> <td>$r[PassNo]</td></tr>
          <tr><td>Invoice</td> <td>  <input type=text name='Invoice' size=15 value='$r[Invoice]'></td></tr> 
          <tr><td>Selling</td> <td>"; 
          if ($r[KasCurr]=='IDR'){echo"IDR" ;} 
          else if ($r[KasCurr]=='USD'){echo"USD";}   
    echo"</select> $r[Selling]</td></tr>
          <tr><td>PO</td> <td> $r[PO]</td></tr> 
          <th colspan=2>Product</th>    
          <tr><td>Embassy</td>  <td>";
            $tampila=mysql_query("SELECT * FROM msproduct 
                LEFT JOIN tbl_mscountry ON tbl_mscountry.CountryID = msproduct.ProdEmbassy
                group by Country");
            while($s=mysql_fetch_array($tampila)){
                if ($r[ProdEmbassy]==$s[CountryID]) {
                               echo "$s[Country]";
                            } 
                        }
    echo "</select></td></tr>
          <tr><td>Type</td>  <td>$r[ProdType] - $r[ProdProcess]</td></tr>
          <tr><td>Nett</td>  <td><text name='ProdNett' id='ProdNet' >$r[NettCurr]. $r[NettAmount]</td></tr>
           <th colspan='2'>Action</th>
          
            <tr><td>In</td> <td>  <input type='text' name='ActIn' size='15' value='$r[ActIn]' onClick="."cal.select(document.forms['example'].ActIn,'ActIn1','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn1' disabled>
           (yyyy-mm-dd)
          <input type='checkbox'  name='cek1' id='cek1' onclick='ceks($inact)'> Change Date</td></tr>
          <input type=hidden name='in' id='in' value='$inact'>
          </td></tr>
          <tr><td>Cash Advance Date</td> <td> $r[ActEstimasi]
          </td></tr>
          <tr><td>Out</td> <td>  <input type=text name='ActOut' size=15 value='$r[ActOut]' onClick="."cal.select(document.forms['example'].ActOut,'anchor2','yyyy-MM-dd'); return false;"." NAME='anchor2' ID='anchor2'>
           (yyyy-mm-dd)          
          </td></tr>
          <tr><td>Remarks</td><td><textarea name='ActRemarks' cols='50' rows='3'>$r[ActRemarks]</textarea></td></tr>
          <tr><td colspan=2><center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
    break; 
    
    case "showvisa":
    $edit=mysql_query("SELECT * FROM msvisa WHERE Id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Your NEW Sales Data number : $r[DONo]</h2>
          
          <center><input type=button value='Add New Sales' onclick=location.href='?module=msvisa&act=tambahvisa'>
                            <input type=button value='Close' onclick=location.href='?module=msvisa'>
         <br><br> ";
    break;  
    
    case "samevisa":
    $edit=mysql_query("SELECT * FROM msvisa WHERE Id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<font color = 'red' size='4'><b>WE FIND THE SAME DATA WITH SALES DATA NUMBER : <a href=?module=msvisa&nama=$r[DONo]&oke=Search>$r[DONo]</b></a></font>
           <br><br>
          <center><input type=button value='Close' onclick=location.href='?module=msvisa'>
         <br><br> ";
    break;  
     
  case "deletemsvisa":    
    $dua=mysql_query("SELECT * FROM msvisa                                                  
                                WHERE Id = '$_GET[id]'");
    $teks=mysql_fetch_array($dua);
    
    $edit=mysql_query("update msvisa set StatCancel='1' WHERE Id = '$_GET[id]'");
    $edit1=mysql_query("update logvisa set statuslog='3' WHERE Id = '$_GET[id]'");
    $edit2=mysql_query("update logsettle set StatCancel='1' WHERE DoNo = '$teks[DONo]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msvisa'>";   
     break; 
}
?>
