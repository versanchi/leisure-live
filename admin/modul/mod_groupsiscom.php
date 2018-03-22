<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>         
<script type="text/javascript" src="../head/editable-select.js"></script>
<script type="text/javascript">
            $(document).ready(function(){
                
                //    -- Datepicker
                $(".my_date").datepicker({
                    dateFormat: 'yy-mm-dd',
                    showButtonPanel: true
                });                    
                                //    -- Datepicker2
                $(".my_date2").datepicker({
                    dateFormat: 'yy-mm-dd',
                    showButtonPanel: true
                });                      
                // -- Clone table rows
                $(".cloneTableRows").live('click', function(){

                    // this tables id
                    var thisTableId = $(this).parents("table").attr("id");
                
                    // lastRow
                    var lastRow = $('#'+thisTableId + " tr:last");
                      
                    var rowCount = $('#'+thisTableId).attr('rows').length;
 
        
                    // clone last row
                    var newRow = lastRow.clone(true);
                    
                    // append row to this table
                    $('#'+thisTableId).append(newRow);
                    
                    // make the delete image visible
                    $('#'+thisTableId + " tr:last td:first img").css("visibility", "visible");
                    
                     
                     
                    // clear the inputs (Optional)
                    $('#'+thisTableId + " tr:last td :input").val('');
                    
                    // new rows datepicker need to be re-initialized
                    $(newRow).find("select").each(function(){
                       // if($(this).hasClass("hasDatepicker")){ // if the current input has the hasDatpicker class
                            var this_id = $(this).attr("id"); // current inputs id
                            var new_id = this_id +1; // a new id
                            $(this).attr("id", new_id); // change to new id  
                           // $(this).attr("value", new_id); 
                            $(this).removeClass('hasDatepicker'); // remove hasDatepicker class
                             // re-init datepicker
                            $(this).datepicker({
                                dateFormat: 'yy-mm-dd',
                                showButtonPanel: true , 
                            });                  
                     //   }        
                       
                    });                    
                         
    
                    return false; 
                });
               
                // Delete a table row
                $("img.delRow").click(function(){
                    $(this).parents("tr").remove();
                    return false;
                });
            
            });
        </script> 
<script language="JavaScript"  type="text/javascript">   
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
function openprod(ID,NO)
{
    var b = eval("example.statusprod" + NO + ".value;")
    window.location.href = '?module=group&act=openproduct&id=' + ID +'&pilih=' + b ;
}

</script>
<script type="text/javascript">
function OpenFirst(bEnable) {               
    if(bEnable==false){
    document.example.elements["max1"].disabled=true;
    document.example.elements["disc1"].disabled=true;
    document.example.elements["max2"].disabled=true;
    document.example.elements["disc2"].disabled=true;
    document.example.elements["max3"].disabled=true;
    document.example.elements["disc3"].disabled=true;
    document.example.elements["max4"].disabled=true;
    document.example.elements["disc4"].disabled=true;
    document.example.elements["max5"].disabled=true;
    document.example.elements["disc5"].disabled=true;
    document.example.elements["max6"].disabled=true;
    document.example.elements["disc6"].disabled=true;
    document.example.elements["max7"].disabled=true;
    document.example.elements["disc7"].disabled=true;
    document.example.elements["max1"].value="";document.example.elements["min1"].value=""; 
    document.example.elements["disc1"].value="";
    document.example.elements["max2"].value="";document.example.elements["min2"].value=""; 
    document.example.elements["disc2"].value="";
    document.example.elements["max3"].value="";document.example.elements["min3"].value=""; 
    document.example.elements["disc3"].value="";
    document.example.elements["max4"].value="";document.example.elements["min4"].value=""; 
    document.example.elements["disc4"].value="";
    document.example.elements["max5"].value="";document.example.elements["min5"].value=""; 
    document.example.elements["disc5"].value="";
    document.example.elements["max6"].value="";document.example.elements["min6"].value=""; 
    document.example.elements["disc6"].value="";
    document.example.elements["max7"].value="";document.example.elements["min7"].value=""; 
    document.example.elements["disc7"].value="";
    }else {
  //  var b = eval(example.awalmin.value)+1;
    var b = 1;
    document.example.elements["max1"].disabled=false;document.example.elements["min1"].value=b;
    document.example.elements["disc1"].disabled=false;
    document.example.elements["max1"].value="";
    document.example.elements["disc1"].value="";
    
    }   
}
function OpenText(NO) {
    var en = "max" + NO ;
    var di = "disc" + NO ; 
    document.example.elements[en].disabled=false;
    document.example.elements[di].disabled=false; 
}
function CekMax(NO) {                               
    var b = eval("example.min" + NO + ".value;")
    var a = eval("example.max" + NO + ".value;")
    var c = eval("example.max" + NO )
    var lanjut = NO + 1 ;
    var n = eval("example.min" + lanjut + ";")   
    var i = "max"+NO ;
    if (a==''){}
    else if(parseInt(a) < parseInt(b) || parseInt(a) == parseInt(b)){
        alert('Value must be larger than min!');
        c.value = ""; n.value="";                      
    }                                     
}
function UpdateMin(NO) {                               
    var b = eval("example.min" + NO + ".value;")
    var a = eval("example.max" + NO + ".value;")
    var lanjut = NO + 1 ;
    var n = eval("example.min" + lanjut + ";")  
    n.value =  parseInt(a) + 1 ;    
    if (isNaN(n.value)) {
      n.value=''   
    }
}
function isNumber(field) {
var re = /^[0-9'.']*$/;
if (!re.test(field.value)) {
alert('Value must be all numberic charcters, including "." non numerics will be removed from field!');
field.value = field.value.replace(/[^0-9'.']/g,"");
}
}
function validateFormsOnSubmit(theForm) {
var reason = ""; 
  reason += validatePhone(theForm.seat);     
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);
    return false;
  }

  return true;
}
function validateFormOnSubmit(theForm) {
var reason = ""; 
  reason += validateMaxs(theForm.max7,theForm.max6); 
  reason += validateMax(theForm.max6,theForm.max5,theForm.max7); 
  reason += validateMax(theForm.max5,theForm.max4,theForm.max6); 
  reason += validateMax(theForm.max4,theForm.max3,theForm.max5); 
  reason += validateMax(theForm.max3,theForm.max2,theForm.max4); 
  reason += validateMax(theForm.max2,theForm.max1,theForm.max3);         
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);
    return false;
  }

  return true;
}
function validatePhone(fld) {
    var error = "";
    var stripped = fld.value.replace(/[\(\)\.\-\ ]/g, '');    

   if (fld.value == "") {
        error = "You didn't enter a number.\n";
        fld.style.background = 'Yellow';
    } else if (isNaN(stripped)) {
        error = "The number contains illegal characters.\n";
        fld.style.background = 'Yellow';
    } else if (!(stripped.length > 0)) {
        error = "The number is the wrong length.\n";
        fld.style.background = 'Yellow';
    } else {
        fld.style.background = 'White';
    }
    return error;
}
function validatePhone1(fld) {
    var error = "";
    //var stripped = fld.value.replace(/[\(\)\.\-\ ]/g, '');    
    var illegalChars= /[\(\)\<\>\,\;\:\-\\\"\[\]]/ ; 
   if (fld.value == "") {
        error = "You didn't enter a number.\n";
        fld.style.background = 'Yellow';
    } else if (fld.value.match(illegalChars)) {
        fld.style.background = 'Yellow';
        error = "The number contains illegal characters.\n";
    } else if (fld.value <= 0) {
        error = "Please input number > than 0.\n";
        fld.style.background = 'Yellow';
    } else {
        fld.style.background = 'White';
    }
    return error;
}
function trim(s)
{
  return s.replace(/^\s+|\s+$/, '');
}

function validateEmail(fld) {
    var error="";
    var tfld = trim(fld.value);                        // value of field with whitespace trimmed off
    var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
    var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;
   
    if (fld.value != "") {
      //  fld.style.background = 'Yellow';
     //   error = "You didn't enter an email address.\n";
    //} else 
        if (!emailFilter.test(tfld)) {              //test email for illegal characters
            fld.style.background = 'Yellow';
            error = "Please enter a valid email address.\n";
        } else if (fld.value.match(illegalChars)) {
            fld.style.background = 'Yellow';
            error = "The email address contains illegal characters.\n";
        } else {
            fld.style.background = 'White';
        }
    }
    return error;
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
function validateDate(fld) {
    var error = "";
    var dep = fld.value;          
    var date = new Date(dep);
    var d  = date.getDate();
    var day = (d < 10) ? '0' + d : d;
    var m = date.getMonth() + 1;
    var month = (m < 10) ? '0' + m : m;
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    var depdate = year + "/" + month + "/" + day ;
    
    var dates = new Date();
    var ds  = dates.getDate();
    var days = (ds < 10) ? '0' + ds : ds;
    var ms = dates.getMonth() + 1;
    var months = (ms < 10) ? '0' + ms : ms;
    var yys = dates.getYear();
    var years = (yys < 1000) ? yys + 1900 : yys;
    var sekarang = years + "/" + months + "/" + days ;                                   
    if (fld.value.length == 0) {
        fld.style.background = 'Yellow'; 
        error = "Date from has not been select.\n"
    } else if (depdate < sekarang) {
        fld.style.background = 'Yellow'; 
        error = "Please choose travel date(from) large than today.\n"
    } else {   
        fld.style.background = 'White';   
    }
    return error;  
}
function validateDateto(fld) {
    var error = "";
    var arr = fld.value;          
    var date = new Date(arr);
    var d  = date.getDate();
    var day = (d < 10) ? '0' + d : d;
    var m = date.getMonth() + 1;
    var month = (m < 10) ? '0' + m : m;
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    var arrdate = year + "/" + month + "/" + day ;
    
    var dep = example.datetravelfrom.value;
    var dates = new Date(dep);
    var ds  = dates.getDate();
    var days = (ds < 10) ? '0' + ds : ds;
    var ms = dates.getMonth() + 1;
    var months = (ms < 10) ? '0' + ms : ms;
    var yys = dates.getYear();
    var years = (yys < 1000) ? yys + 1900 : yys;
    var depdate = years + "/" + months + "/" + days ; 
                                      
    if (fld.value.length == 0) {
        fld.style.background = 'Yellow'; 
        error = "Date to has not been select.\n"
    } else if (depdate > arrdate) {
        fld.style.background = 'Yellow'; 
        error = "Please choose date(to) large than date(from).\n"
    } else {   
        fld.style.background = 'White';   
    }
    return error;  
}
function validateSelect(fld) {
    var error = "";
 
    if (fld.value == '') {
        fld.style.background = 'Yellow'; 
        error = "The required field has not been selected.\n"
    } else {
        fld.style.background = 'White';
    }
    return error;  
} 
function validateMax(fld2,fld1,fld3) {
    var error = "";
    var a = fld2.value;
    var b = fld1.value;
    if(fld3.value == "" && fld2.value == ""){return error; }else{
        if (parseInt(a) < parseInt(b)) {
            fld2.style.background = 'Yellow'; 
            error = "Please correct the value.\n"
        } else if (fld3.value != "" && fld2.value == ""){
            fld2.style.background = 'Yellow'; 
            error = "Please correct the value.\n"
        } else {
            fld2.style.background = 'White';
        }
        return error;
    }     
}      
function validateMaxs(fld2,fld1) {
    var error = "";                
    var a = fld2.value;
    var b = fld1.value
        if (parseInt(a) < parseInt(b)){
            fld2.style.background = 'Yellow'; 
            error = "Please correct the value.\n"
        } else {
            fld2.style.background = 'White';
        }
        return error;      
}                                                                                                                                                                
</script>
<?php 
$username=$_SESSION[employee_code];
$sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_code='$username'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName=$tampiluser[employee_name];
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
$hariini = date("Y-m-d ");
$tahun= date("Y", $waktu);
switch($_GET[act]){
  // Tampil Office
  default:
      $nama=$_GET['nama'];
    $cate=$_GET['cate'];
    if($cate==''){$cate='TourCode';}
    echo "<h2>Manage Group</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='groupsiscom'>
              <select name='cate'><option value='TourCode'";if($cate=='TourCode'){echo"selected";}echo">Tour Code</option>
                                  <option value='Destination'";if($cate=='Destination'){echo"selected";}echo">Destination</option>
              </select> <input type=text name=nama value='$nama' size=20>    
              <input type=submit name=oke value=Search>
          </form>";
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
            $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $cate LIKE '%$nama%'
                                and Status = 'PUBLISH' 
                                and DateTravelFrom >= '$hariini'
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $posisi,$batas");
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "<form name='example'><table>
                    <tr><th>no</th><th>product</th><th>tour code</th><th>tour leader</th><th>days</th><th>departure</th><th>flight</th><th>disc</th><th>seat</th><th>deposit</th><th>available</th><th>inquiry</th><th>cancel</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){   
                    $mari=mysql_query("SELECT count(IDDetail)as wow FROM tour_msbookingdetail where TourCode = '$data[TourCode]' and Status = 'CANCEL' and Gender <>'INFANT'");
                    $tung=mysql_fetch_array($mari);
                    $tes=mysql_query("SELECT TourCode FROM tour_msproduct   
                                WHERE IDProduct = '$data[IDProduct]'");
                    $testing=mysql_fetch_array($tes);
                    $maritot=mysql_query("SELECT count(tour_msbookingdetail.IDDetail)as tot FROM tour_msbookingdetail 
                                        left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                        where tour_msbookingdetail.TourCode = '$testing[TourCode]' and tour_msbookingdetail.Gender <>'INFANT'
                                        AND tour_msbookingdetail.Status<>'CANCEL' 
                                        AND tour_msbooking.Status='ACTIVE'
                                        AND Year >= $tahun ");
                    $tungtot=mysql_fetch_array($maritot);                                     
                    $totl=$tungtot[tot]+1;
                    $d = mysql_query("SELECT * FROM tour_msdiscount                                                       
                                    WHERE IDProduct = '$data[IDProduct]' and Status='ACTIVE'");
                    $dd = mysql_fetch_array($d);
                    $julh=mysql_num_rows($d);
                    if($julh>0){
                    if($totl<=$dd[Max1]){$diskon=$dd[Disc1];}
                    else if($totl<=$dd[Max2]){$diskon=$dd[Disc2];}
                    else if($totl<=$dd[Max3]){$diskon=$dd[Disc3];}
                    else if($totl<=$dd[Max4]){$diskon=$dd[Disc4];}
                    else if($totl<=$dd[Max5]){$diskon=$dd[Disc5];}
                    else if($totl<=$dd[Max6]){$diskon=$dd[Disc6];}
                    else if($totl<=$dd[Max7]){$diskon=$dd[Disc7];}
                    else $diskon='0';
                    if($diskon==''){$diskon='0';}
                    }else{$diskon='0';}                          
                    if($data[StatusProduct]=='CLOSE'){$status="<font color=red><b>CLOSE</b></font>";}
                    else if($data[StatusProduct]=='OPEN'){$status="<font color=green><b>OPEN</b></font>";}
                    $idprod= $data[IDProduct];       
               echo "<tr><td>$no</td>
                     <td>$data[ProductCode] - $data[Productcode]</td>                                   
                     <td><a href='../admin/media.php?module=msproduct&act=showquotation&id=$idprod'>$data[TourCode]</a></td>
                     <td>$data[TourLeader]</td>
                     <td><center>$data[DaysTravel]</td>
                     <td>$data[DateTravelFrom]</td>
                     <td><center>$data[Flight]</td>
                     <td><center>$diskon</td>
                     <td><center>$data[Seat]</td>
                     <td><center>";if($data[SeatDeposit]=='0'){echo"$data[SeatDeposit]";}else{echo"
                     <a href=?module=group&act=showdeposit&id=$data[IDProduct]>$data[SeatDeposit]</a>";}echo"
                     </td>
                     <td><center>$data[SeatSisa]</td>
                     <td><center>$data[SeatInquiry]</td>
                     <td><center>$tung[wow]</td>";   
               echo "                
                     </tr>";
                      $no++;
                    }
                    echo "</table></form>";
                    
                    // Langkah 3            
                    $tampil2    = "SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $cate LIKE '%$nama%'
                                and Status = 'PUBLISH' 
                                and DateTravelFrom >= '$hariini'
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC ";
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=group";
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
                        $angka .= "<a href=$file&halaman=$i&nama=$nama&cate=$cate&oke=$oke>$i</a> ";
                    }
                    // Angka tengah
                    $angka .= " <b>$halaman</b> ";
                    for ($i=$halaman+1; $i<($halaman+3); $i++) {
                        if ($i > $jmlhalaman)
                            break;
                        $angka .= "<a href=$file&halaman=$i&nama=$nama&cate=$cate&oke=$oke>$i</a> ";    
                    }
                    // Angka akhir
                    $angka .= ($halaman+2<$jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&nama=$nama&cate=$cate&oke=$oke>$jmlhalaman</a> |" : " ");
                    // Cetak angka seluruhnya (awal, tengah, akhir)
                    echo "$angka";
                    // Link ke halaman berikutnya (Next)
                    if ($halaman < $jmlhalaman) {
                        $next = $halaman+1;
                        echo "<a href=$file&halaman=$next&nama=$nama&cate=$cate&oke=$oke> Next ></a> |
                              <a href=$file&halaman=$jmlhalaman&nama=$nama&cate=$cate&oke=$oke> Last >></a> ";
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
  
 
  case "editgroup":
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $xtra=mysql_query("SELECT * FROM tour_xtrapameran WHERE IDProduct = '$_GET[id]' order by IDXtra DESC LIMIT 1");
    $xpameran=mysql_fetch_array($xtra);
    $cuma = mysql_query("SELECT * FROM tour_msdiscount WHERE IDProduct = '$_GET[id]' and Status = 'ACTIVE'  
                                    ORDER BY IDDiscount DESC limit 1");
    $saja = mysql_fetch_array($cuma);
    $maritot=mysql_query("SELECT count(IDDetail)as tot FROM tour_msbookingdetail where TourCode = '$r[TourCode]' and Gender <>'INFANT'");
    $tungtot=mysql_fetch_array($maritot);
    //$minawal=$tungtot[tot]+1;
    $minawal=1;
    if($saja[Max1]==''){
        $min1 = '';
        $min2 = '';
        $min3 = '';
        $min4 = '';
        $min5 = '';
        $min6 = '';
        $min7 = '';    
    }else{
        $min1 = 1;
        if($saja[Max2]==''){$min2='';}else{$min2 = $saja[Max1]+1;}
        if($saja[Max3]==''){$min3='';}else{$min3 = $saja[Max2]+1;}
        if($saja[Max4]==''){$min4='';}else{$min4 = $saja[Max3]+1;}
        if($saja[Max5]==''){$min5='';}else{$min5 = $saja[Max4]+1;}
        if($saja[Max6]==''){$min6='';}else{$min6 = $saja[Max5]+1;}
        if($saja[Max7]==''){$min7='';}else{$min7 = $saja[Max6]+1;}
    }
    $dari = date("d M Y", strtotime($r[DateTravelFrom]));
    $sampai = date("d M Y", strtotime($r[DateTravelTo]));
    echo "<h2>Manage Group</h2>       
          <table>                                           
          <tr><td colspan=2>Product Code/Name</td> <td colspan=4>  $r[ProductCode]</td></tr>    
          <tr><td colspan=2>Date of Service</td> <td colspan=4>$dari - $sampai</td></tr>
          <tr><td colspan=2>Number of Days</td><td colspan=4> $r[DaysTravel] days</td></tr>   
          <tr><td colspan=2>Flight</td> <td colspan=4>$r[Flight]</td></tr>
          <tr><td colspan=2>Tour Code</td> <td colspan=4>$r[TourCode]</td></tr>  
          
          <tr><td colspan=2>Visa</td> <td colspan=4>$r[Visa] ";if($r[Visa]=='INCLUDE' || $r[Visa]=='NOT INCLUDE'){
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where CountryID = $r[Embassy01]");
            $s=mysql_fetch_array($tampil);
            if($s[Country]<>''){echo"<br>- $s[Country]";}else{}
            $tampil1=mysql_query("SELECT * FROM tbl_msembassy where CountryID = $r[Embassy02]");
            $s1=mysql_fetch_array($tampil1);
            if($s1[Country]<>''){echo"<br>- $s1[Country]";}else{}
            $tampil2=mysql_query("SELECT * FROM tbl_msembassy where CountryID = $r[Embassy03]");
            $s2=mysql_fetch_array($tampil2);
            if($s2[Country]<>''){echo"<br>- $s2[Country]";}else{}
            $tampil3=mysql_query("SELECT * FROM tbl_msembassy where CountryID = $r[Embassy04]");
            $s3=mysql_fetch_array($tampil3);
            if($s3[Country]<>''){echo"<br>- $s3[Country]";}else{}
            $tampil4=mysql_query("SELECT * FROM tbl_msembassy where CountryID = $r[Embassy05]");
            $s4=mysql_fetch_array($tampil4);
            if($s4[Country]<>''){echo"<br>- $s4[Country]";}else{}
          }echo"</td></tr>      
            
            <tr><td colspan=2>Selling Price Visa</td><td colspan=4>$r[VisaCurr].$r[VisaSell]</td></tr>
            <tr><td colspan=2>Selling Price Visa 2</td><td colspan=4> $r[VisaCurr2].$r[VisaSell2]</td></tr> 
            <tr><td colspan=2>Domestic Airport Tax</td><td colspan=4>";if($r[AirTaxSell]==0){echo"INCLUDE";}else{echo"$r[AirTaxCurr].$r[AirTaxSell]";}echo"</td></tr>
            <tr><td colspan=2>Seat</td> <td colspan=4>$r[Seat] Pax <font color='red'>*<i>Not Include Infant and Tour leader</i></font></td></tr>";          
            $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[AttachmentFile]) ) ) );
            
    echo"<tr><td colspan=2>Attachment</td><td colspan=4><a href='$r[Attachment]$file' target='_blank' style=text-decoration:none >$r[AttachmentFile]</a></td></tr>
            <tr><td colspan=2>Remarks</td><td colspan=4>$r[Remarks]</td></tr>   
            
            <tr><td colspan=6><center>Selling Price in $r[SellingCurr]</td></tr>
            
            <tr><th width=80>ADULT</th><th width=80>CHILD TWN</th><th width=80>CHILD X BED</th><th width=80>Child No bed</th><th width=80>Infant</th><th width=80>Tax</th></tr>
                    <tr><td><center>$r[SellingAdlTwn]</td></td>
                         <td><center>$r[SellingChdTwn]</td>
                         <td><center>$r[SellingChdXbed]</td>
                         <td><center>$r[SellingChdNbed]</td>
                         <td><center>$r[SellingInfant]</td>
                         <td><center>$r[TaxInsSell]</td></tr>     
          </table>
          <form method='POST' name='example' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=group&act=update' >
          <input type=hidden name=id value='$r[IDProduct]'>
          <table style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'>
          <table style='border: 0px solid #000000;'>
          <tr style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'>Tour Leader</td><td colspan =2 style='border: 0px solid #000000;'><select name='tourleader'";if($r[TourLeaderInc]=='NO'){echo"disabled";}echo" ><option value='' selected>- Select TL -</option>";
            $tampil=mysql_query("(SELECT TourleaderName as TLNAME FROM tour_mstourleader where TourleaderStatus = 'ACTIVE' ORDER BY TourleaderName ASC) 
                                UNION
                                (SELECT employee_name as TLNAME FROM tbl_msemployee where employee_tl = 'on' ORDER BY employee_name ASC)");
            while($s=mysql_fetch_array($tampil)){    
                if($r[TourLeader]==$s[TLNAME]){
                    echo "<option value='$s[TLNAME]' selected>$s[TLNAME]</option>";
                }else {     
                    echo "<option value='$s[TLNAME]'>$s[TLNAME]</option>";
                }   
            }
    echo "</select></td>
          <tr><th colspan=7>Discount Range</th><td style='text-align: left;border: 0px solid #000000;'></td></tr>
          <tr><td colspan=3 style='text-align: left;border: 0px solid #000000;'><input type='checkbox' name='cvalue'  onClick='OpenFirst(this.checked)'>&nbsp change discount range</td></tr>
          <tr><th colspan=2>TOTAL PAX</th><th></th><td style='text-align: left;border: 0px solid #000000;'></td><th colspan=3>current discount composition</th></tr>
          <tr><th width=60>MIN</th><th width=60>MAX</th><th width=80>AMOUNT</th><td style='text-align: left;border: 0px solid #000000;'></td><th width=60>MIN</th><th width=60>MAX</th><th width=80>AMOUNT</th></td></tr>
          <tr><td><center><input type='text' name='min1' size='3' style='text-align: left;border: 0px solid #000000;' readonly></td>
          <td><center><input type='text' name='max1' id='max1' size='3' onkeyup='isNumber(this);UpdateMin(1);OpenText(2)' onblur='CekMax(1)' disabled></td>
          <td><center><input type='text' name='disc1' size='3' onkeyup='isNumber(this)' disabled></td>
          <td style='text-align: left;border: 0px solid #000000;'></td>
          <td><center>$min1</td>
          <td><center>$saja[Max1]</td>
          <td><center>$saja[Disc1]</td></tr>
          
          <tr><td><center><input type='text' name='min2' size='3' style='text-align: left;border: 0px solid #000000;' readonly></td>
          <td><center><input type='text' name='max2' id='max2' size='3' onkeyup='isNumber(this);UpdateMin(2);OpenText(3)' onblur='CekMax(2)' disabled></td>
          <td><center><input type='text' name='disc2' size='3' onkeyup='isNumber(this)' disabled></td>
          <td style='text-align: left;border: 0px solid #000000;'></td>
          <td><center>$min2</td>
          <td><center>$saja[Max2]</td>
          <td><center>$saja[Disc2]</td></tr>
          
          <tr><td><center><input type='text' name='min3'  size='3' style='text-align: left;border: 0px solid #000000;' readonly></td>
          <td><center><input type='text' name='max3' id='max3' size='3' onkeyup='isNumber(this);UpdateMin(3);OpenText(4)' onblur='CekMax(3)' disabled></td>
          <td><center><input type='text' name='disc3' size='3' onkeyup='isNumber(this)' disabled></td>
          <td style='text-align: left;border: 0px solid #000000;'></td>
          <td><center>$min3</td>
          <td><center>$saja[Max3]</td>
          <td><center>$saja[Disc3]</td></tr>
          
          <tr><td><center><input type='text' name='min4' size='3' style='text-align: left;border: 0px solid #000000;' readonly></td>
          <td><center><input type='text' name='max4' id='max4' size='3' onkeyup='isNumber(this);UpdateMin(4);OpenText(5)' onblur='CekMax(4)' disabled></td>
          <td><center><input type='text' name='disc4' size='3' onkeyup='isNumber(this)' disabled></td>
          <td style='text-align: left;border: 0px solid #000000;'></td>
          <td><center>$min4</td>
          <td><center>$saja[Max4]</td>
          <td><center>$saja[Disc4]</td></tr>
          
          <tr><td><center><input type='text' name='min5' size='3' style='text-align: left;border: 0px solid #000000;' readonly></td>
          <td><center><input type='text' name='max5' id='max5' size='3' onkeyup='isNumber(this);UpdateMin(5);OpenText(6)' onblur='CekMax(5)' disabled></td>
          <td><center><input type='text' name='disc5' size='3' onkeyup='isNumber(this)' disabled></td>
          <td style='text-align: left;border: 0px solid #000000;'></td>
          <td><center>$min5</td>
          <td><center>$saja[Max5]</td>
          <td><center>$saja[Disc5]</td></tr>
          
          <tr><td><center><input type='text' name='min6' size='3' style='text-align: left;border: 0px solid #000000;' readonly></td>
          <td><center><input type='text' name='max6' id='max6' size='3' onkeyup='isNumber(this);UpdateMin(6);OpenText(7)' onblur='CekMax(6)' disabled></td>
          <td><center><input type='text' name='disc6' size='3' onkeyup='isNumber(this)' disabled></td>
          <td style='text-align: left;border: 0px solid #000000;'></td>
          <td><center>$min6</td>
          <td><center>$saja[Max6]</td>
          <td><center>$saja[Disc6]</td></tr>
          
          <tr><td><center><input type='text' name='min7' size='3' style='text-align: left;border: 0px solid #000000;' readonly></td>
          <td><center><input type='text' name='max7' id='max7' size='3' onkeyup='isNumber(this)' onblur='CekMax(7)' disabled></td>
          <td><center><input type='text' name='disc7' size='3' onkeyup='isNumber(this)' disabled></td>
          <td style='text-align: left;border: 0px solid #000000;'></td>
          <td><center>$min7</td>
          <td><center>$saja[Max7]</td>
          <td><center>$saja[Disc7]</td></tr>
          </table></td>
          <td style='border: 0px solid #000000;'><table style='border: 0px solid #000000;'>
          <tr><td height='80' style='border: 0px solid #000000;' colspan=2></td></tr>
          <tr><th colspan=2>Discount Information</th></tr>
          <tr><th width=100>description</th><th width=100>total pax</th></tr>";
          $mulai=mysql_query("SELECT * FROM tour_msbookingdetail where TourCode = '$r[TourCode]' and Gender <>'INFANT' group by Status DESC");
          while($yo=mysql_fetch_array($mulai)){
              $mari=mysql_query("SELECT count(IDDetail)as wow FROM tour_msbookingdetail where TourCode = '$r[TourCode]' and Status = '$yo[Status]' and Gender <>'INFANT'");
              $tung=mysql_fetch_array($mari);
              echo"<tr><td><center>$yo[Status]</td><td><center>$tung[wow]</td></tr>";    
          }
          $maritot=mysql_query("SELECT count(IDDetail)as tot FROM tour_msbookingdetail where TourCode = '$r[TourCode]' and Gender <>'INFANT'");
          $tungtot=mysql_fetch_array($maritot);
    echo" <tr><td><center><b>TOTAL</td><td><center><b>$tungtot[tot]</td><input type='hidden' name='awalmin' value='$tungtot[tot]'></tr>
          </table></td></table>
          <font color='red' size=2>*Promo for Exhibition</font><br>
            <table  id='productpromo' border='1'>   
              <tr><th>range pax</th><th>promo description</th><th>status</th></tr>
              <tr>
              <td><input type='text' name='min' size='3' value='$xpameran[Min]' onkeyup='isNumber(this)'> - <input type='text' name='max' size='3' value='$xpameran[Max]' onkeyup='isNumber(this)'></td>
              <td><input type='text' name='promo' value='$xpameran[Promo]' size='50'></td>
              <td><select name='statuspromo' >
              <option value='ACTIVE'";if($xpameran[Status]=='ACTIVE' or $xpameran[Status]==''){echo"selected";}echo">ACTIVE</option>
              <option value='INACTIVE'";if($xpameran[Status]=='INACTIVE'){echo"selected";}echo">INACTIVE</option>
              </select></td>
              </tr>
              </table>
          <center><input type='submit' name='submit' value='Update'>
                            <input type=button value=Cancel onclick=self.history.back()>
          </form><br><br>";
     break;
    
 
  case "openproduct":    
    
    $edit1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1);
    $status= $_GET[pilih];
   // if($r2[StatusProduct]=='CLOSE'){$status="OPEN";}
    //else if($r2[StatusProduct]=='OPEN'){$status="CLOSE";}             
    $edit=mysql_query("UPDATE tour_msproduct SET StatusProduct = '$status' WHERE IDProduct = '$_GET[id]'");
     $Description="$status Product $r2[TourCode]";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=group'>";   
     break;
 
 case "showdeposit":    
    $kriet=mysql_query("SELECT * FROM tour_msproduct   
                                WHERE IDProduct = '$_GET[id]'");
    $sow=mysql_fetch_array($kriet);   
    $tampil=mysql_query("SELECT * FROM tour_msbooking   
                                WHERE IDTourcode='$sow[IDProduct]'
                                AND Status = 'ACTIVE' 
                                AND BookingStatus = 'DEPOSIT'
                                ORDER BY BookingID ASC ");
    
            echo "  <h2>Deposit Detail - $sow[TourCode]</h2> 
                    <table>   
                    <tr><th colspan=6>$sow[TourCode]</th><th colspan=4>total pax</th><th></th></tr>
                    <tr><th>no</th><th>Booking ID</th><th width=150>Bookers</th><th>tc name</th><th>divisi</th><th>Booking date</th><th>adult</th><th>child</th><th>infant</th><th>cancel</th><th>Total Price</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
                    $qprod=mysql_query("SELECT * FROM tour_msproduct   
                                WHERE IDProduct = '$data[IDTourcode]'");
                    $hqprod=mysql_fetch_array($qprod); 
                    $hargapajak=($data[AdultPax]+$data[ChildPax])*$hqprod[TaxInsSell];           
                    $hargakotor=$data[TotalPrice]+$hargapajak;
                    $tampil2=mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE TourCode = '$sow[TourCode]'
                                AND Status = 'CANCEL'
                                AND Gender <> 'INFANT' 
                                AND BookingID = '$data[BookingID]'
                                ORDER BY BookingID ASC ");
     $jumla=mysql_num_rows($tampil2);                                                                                                       
               echo "<tr><td>$no</td>
                     <td>$data[BookingID]";    
                     $edit1=mysql_query("SELECT count(IDDetail)as bnyk FROM tour_msbookingdetail WHERE BookingID ='$data[BookingID]' and Gender <> 'INFANT' and Status <> 'CANCEL' ");  
                     $r2=mysql_fetch_array($edit1);
                     if($data[DepositNo]=='' || $data[DepositAmount]=='0.00' || $data[DepositDate]=='0000-00-00'){
                     $totalinq = $data[AdultPax] + $data[ChildPax];
                     }else{$totalinq = $r2[bnyk];}
                     if($data[FBTNo]==''){$bisa="enabled";$lin="?module=opbookingdetail&act=editdetail&code=$data[BookingID]";}else{$bisa="disabled";$lin="?module=opbookingdetail&act=editdetails&code=$data[BookingID]";}
                     if($data[TCDivision]=='LTM'){$diva='THO';$tcalias=$data[TCNameAlias];}else{$diva=$data[TCDivision];$tcalias=$data[TCName];}
                     echo"              
                     </td></td>                                   
                     <td>$data[BookersName]</td>
                     <td><center>$tcalias</td>
                     <td><center>$diva</td>
                     <td><center>$data[BookingDate]</td>     
                     <td><center>$data[AdultPax]</td>
                     <td><center>$data[ChildPax]</td>
                     <td><center>$data[InfantPax]</td>
                     <td><center>$jumla</td>
                     <td style='text-align:right'>".number_format($hargakotor, 0, '', '.');echo"</td>   
                     </tr>";
                      $no++;
                    $tadult=$tadult+$data[AdultPax];
                    $tchild=$tchild+$data[ChildPax];
                    $tinf=$tinf+$data[InfantPax];
                    $tcan=$tcan+$jumla;
                    $tprice=$tprice+$hargakotor;
                    }
                    echo "
                    <tr><td colspan='6' style='text-align:right'><b>TOTAL</b></td><td><center>$tadult</td><td><center>$tchild</td><td><center>$tinf</td><td><center>$tcan</td><td style='text-align:right'>".number_format($tprice, 0, '', '.');echo"</td></tr></table><br>
                    <center><input type=button value=Close onclick=self.history.back()><br><br>";    
     break; 
 
case "showdepositex":    
    $kriet=mysql_query("SELECT * FROM tour_msproduct   
                                WHERE IDProduct = '$_GET[id]'");
    $sow=mysql_fetch_array($kriet);   
    $tampil=mysql_query("SELECT * FROM tour_msbooking   
                                WHERE IDTourcode='$_GET[id]'
                                AND BookingPlace = '$_GET[ex]' 
                                AND Status = 'ACTIVE' 
                                AND BookingStatus = 'DEPOSIT'
                                ORDER BY BookingID ASC ");  
    
            echo "  <h2>Deposit Detail - $sow[TourCode]</h2> 
                    <table>   
                    <tr><th colspan=6>$sow[TourCode]</th><th colspan=4>total pax</th><th></th></tr>
                    <tr><th>no</th><th>Booking ID</th><th width=150>Bookers</th><th>tc name</th><th>divisi</th><th>Booking date</th><th>adult</th><th>child</th><th>infant</th><th>cancel</th><th>Total Price</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
                    $qprod=mysql_query("SELECT * FROM tour_msproduct   
                                WHERE IDProduct = '$data[IDTourcode]'");
                    $hqprod=mysql_fetch_array($qprod); 
                    $hargapajak=($data[AdultPax]+$data[ChildPax])*$hqprod[TaxInsSell];           
                    $hargakotor=$data[TotalPrice]+$hargapajak;
                    $tampil2=mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE TourCode = '$sow[TourCode]'
                                AND Status = 'CANCEL'
                                AND Gender <> 'INFANT' 
                                AND BookingID = '$data[BookingID]'
                                ORDER BY BookingID ASC ");
     $jumla=mysql_num_rows($tampil2);                                                                                                       
               echo "<tr><td>$no</td>
                     <td>$data[BookingID]";    
                     $edit1=mysql_query("SELECT count(IDDetail)as bnyk FROM tour_msbookingdetail WHERE BookingID ='$data[BookingID]' and Gender <> 'INFANT' and Status <> 'CANCEL' ");  
                     $r2=mysql_fetch_array($edit1);
                     if($data[DepositNo]=='' || $data[DepositAmount]=='0.00' || $data[DepositDate]=='0000-00-00'){
                     $totalinq = $data[AdultPax] + $data[ChildPax];
                     }else{$totalinq = $r2[bnyk];}
                     if($data[FBTNo]==''){$bisa="enabled";$lin="?module=opbookingdetail&act=editdetail&code=$data[BookingID]";}else{$bisa="disabled";$lin="?module=opbookingdetail&act=editdetails&code=$data[BookingID]";}
                     if($data[TCDivision]=='LTM'){$diva='THO';$tcalias=$data[TCNameAlias];}else{$diva=$data[TCDivision];$tcalias=$data[TCName];}
                     echo"              
                     </td></td>                                   
                     <td>$data[BookersName]</td>
                     <td><center>$tcalias</td>
                     <td><center>$diva</td>
                     <td><center>$data[BookingDate]</td>     
                     <td><center>$data[AdultPax]</td>
                     <td><center>$data[ChildPax]</td>
                     <td><center>$data[InfantPax]</td>
                     <td><center>$jumla</td>
                     <td style='text-align:right'>".number_format($hargakotor, 0, '', '.');echo"</td>   
                     </tr>";
                      $no++;
                    }
                    echo "</table><br>
                    <center><input type=button value=Close onclick=self.history.back()><br><br>";    
     break;   
     
case "showdepositcode":    
    $kriet=mysql_query("SELECT * FROM tour_msproduct   
                                WHERE ProductCode = '$_GET[code]'");
    $sow=mysql_fetch_array($kriet);   
    $tampil=mysql_query("SELECT * FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode   
                                WHERE ProductCode = '$_GET[code]'  
                                AND BookingPlace = '$_GET[ex]' 
                                AND tour_msbooking.Status = 'ACTIVE' 
                                AND BookingStatus = 'DEPOSIT'
                                ORDER BY BookingID ASC ");  
    
            echo "  <h2>Deposit Detail - Product: $sow[ProductCode]</h2> 
                    <table>   
                    <tr><th colspan=7>$sow[ProductCode]</th><th colspan=4>total pax</th><th></th></tr>
                    <tr><th>no</th><th>Booking ID</th><th>TourCode</th><th width=150>Bookers</th><th>tc name</th><th>divisi</th><th>Booking date</th><th>adult</th><th>child</th><th>infant</th><th>cancel</th><th>Total Price</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
                    $qprod=mysql_query("SELECT * FROM tour_msproduct   
                                WHERE IDProduct = '$data[IDTourcode]'");
                    $hqprod=mysql_fetch_array($qprod); 
                    $hargapajak=($data[AdultPax]+$data[ChildPax])*$hqprod[TaxInsSell];           
                    $hargakotor=$data[TotalPrice]+$hargapajak;
                    $tampil2=mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE TourCode = '$sow[TourCode]'
                                AND Status = 'CANCEL'
                                AND Gender <> 'INFANT' 
                                AND BookingID = '$data[BookingID]'
                                ORDER BY BookingID ASC ");
     $jumla=mysql_num_rows($tampil2);                                                                                                       
               echo "<tr><td>$no</td>
                     <td>$data[BookingID]";    
                     $edit1=mysql_query("SELECT count(IDDetail)as bnyk FROM tour_msbookingdetail WHERE BookingID ='$data[BookingID]' and Gender <> 'INFANT' and Status <> 'CANCEL' ");  
                     $r2=mysql_fetch_array($edit1);
                     if($data[DepositNo]=='' || $data[DepositAmount]=='0.00' || $data[DepositDate]=='0000-00-00'){
                     $totalinq = $data[AdultPax] + $data[ChildPax];
                     }else{$totalinq = $r2[bnyk];}
                     if($data[FBTNo]==''){$bisa="enabled";$lin="?module=opbookingdetail&act=editdetail&code=$data[BookingID]";}else{$bisa="disabled";$lin="?module=opbookingdetail&act=editdetails&code=$data[BookingID]";}
                     if($data[TCDivision]=='LTM'){$diva='THO';$tcalias=$data[TCNameAlias];}else{$diva=$data[TCDivision];$tcalias=$data[TCName];}
                     echo"              
                     </td></td>
                     <td>$data[TourCode]</td>                                   
                     <td>$data[BookersName]</td>
                     <td><center>$tcalias</td>
                     <td><center>$diva</td>
                     <td><center>$data[BookingDate]</td>     
                     <td><center>$data[AdultPax]</td>
                     <td><center>$data[ChildPax]</td>
                     <td><center>$data[InfantPax]</td>
                     <td><center>$jumla</td>
                     <td style='text-align:right'>".number_format($hargakotor, 0, '', '.');echo"</td>   
                     </tr>";
                      $no++;
                    }
                    echo "</table><br>
                    <center><input type=button value=Close onclick=self.history.back()><br><br>";    
     break;        
}
?>
