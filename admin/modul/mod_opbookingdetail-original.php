<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>         
<script type="text/javascript" src="../head/editable-select.js"></script> 
<script language="JavaScript"  type="text/javascript">   
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
function Batal(ID)
{
if (confirm("Cancel this Pax ?"))
{
 window.location.href = '?module=opbookingdetail&act=cancelpax&id=' + ID  ;
 
} 
}
function hapusd(DP,ID)
{
if (confirm("Are you sure CANCEL booking (" + ID +") ?"))
{
 window.location.href = '?module=opbookingdetail&act=cancelbook&code=' + ID + '&dp=' + DP  ;      
} 
}
function hapusi(IN,ID)
{
if (confirm("Are you sure CANCEL Inquiry (" + ID +") ?"))
{
 window.location.href = '?module=opbookingdetail&act=cancelinq&code=' + ID + '&inq=' + IN  ;      
} 
}
</script>
<script type="text/javascript">
 
function isNumber(field) {
var re = /^[0-9'.']*$/;
if (!re.test(field.value)) {
alert('PLEASE INPUT NUMBER!');
field.value = field.value.replace(/[^0-9'.']/g,"");
}
}

function UpdateSubtotal(angka,banyak){
    var h = eval("example.hharga" + angka + ".value;")
    var a = eval("example.add" + angka + ".value;")
    var d = eval("example.disc" + angka + ".value;")
    var st = eval("example.total" + angka )
   
    var harga = eval(eval(h) + eval(a)) ;
    st.value = (harga - d).toFixed(2);
    
    if (isNaN(st.value) ) {
      st.value=(h).toFixed(2) ;   
      }
     UpdateJumt(banyak) 
 }

 function UpdateJumt(ulang){  
    var sum = 0;
    var tot = eval("example.jumtotal")
  for (i=1; i<= ulang; i++) {
      var t = eval("example.total" + i)  
       sum += eval(t.value);
  }                                                           
  tot.value = accounting.formatMoney(sum); 
 }
 
function validateFormOnSubmit(theForm) {
var reason = ""; 
  reason += validateSelect(theForm.season);
  reason += validateSelect(theForm.producttype);
  reason += validateSelect(theForm.grouptype);
  reason += validateSelect(theForm.productcode);  
  reason += validateDate(theForm.datetravelfrom);
  reason += validateDateto(theForm.datetravelto); 
  reason += validateSelect(theForm.flight);
  reason += validateEmpty(theForm.tourcode);  
  reason += validatePhone(theForm.seat);       
  reason += validatePhone1(theForm.sellingrate);
  reason += validatePilih(theForm.depositdate);     
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
 
    if (fld.value == 0) {
        fld.style.background = 'Yellow'; 
        error = "The required field has not been selected.\n"
    } else {
        fld.style.background = 'White';
    }
    return error;  
}                                          
</script>

<script type='text/javascript'>
 function showPrice(angka,banyak)
 {
  var a = eval("example.room" + angka + ".value;")
  var dis = eval("example.disc" + angka + ".value;")  
  var s = a.split(";");   
  var p = eval("example.package" + angka)
  var la = eval(example.laprice)
  var b = eval("example.harga" + angka)
  var c = eval("example.selectroom" + angka)
  var d = eval("example.add" + angka)
  var t = eval("example.total" + angka) 
  if(p.value=='Tour'){ 
    b.value = eval(s[0]).toFixed(2) ;
  }else{
    b.value = eval(la.value).toFixed(2) ; 
  }
  c.value = s[1];
  d.value = eval(s[2]).toFixed(2); 
  t.value = eval(eval(b.value) + eval(d.value) - eval(dis)).toFixed(2);  
  Totalnya(banyak);  
 }   
  function Totalnya(ulang){  
    var sum = 0;
    var tot = eval("example.jumtotal")
  for (i=1; i<= ulang; i++) {
      var t = eval("example.total" + i)  
       sum += eval(t.value);
  }                                                           
  tot.value = accounting.formatMoney(sum); 
  } 
</script>

<?php 
switch($_GET[act]){
  // Tampil Office
  default:
      $nama=$_GET['nama'];
    echo "<h2>Booking Detail</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='opbookingdetail'>
              Booking ID <input type=text name=nama value='$nama' size=20>    
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
            $tampil=mysql_query("SELECT * FROM tour_msbooking   
                                left join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                WHERE BookingID LIKE '%$nama%'
                                AND tour_msbooking.Status ='ACTIVE'
                                ORDER BY BookingID ASC LIMIT $posisi,$batas");
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "   <table>   
                    <tr><th colspan=8></th><th colspan=3>total pax</th><th></th></tr>
                    <tr><th>no</th><th>Booking ID</th><th>tour code</th><th>Dept</th><th width=80>Bookers</th><th>tc name</th><th>divisi</th><th>cash receipt</th><th>adult</th><th>child</th><th>infant</th><th>action</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){                                                
               echo "<tr><td>$no</td>
                     <td>$data[BookingID]";    
                     $edit1=mysql_query("SELECT count(IDDetail)as bnyk FROM tour_msbookingdetail WHERE BookingID ='$data[BookingID]' and Gender <> 'INFANT' and Status <> 'CANCEL' ");  
                     $r2=mysql_fetch_array($edit1);
                     if($data[DepositNo]=='' || $data[DepositAmount]=='0.00' || $data[DepositDate]=='0000-00-00'){
                     $totalinq = $data[AdultPax] + $data[ChildPax];
                     }else{$totalinq = $r2[bnyk];}
                     if($data[FBTNo]==''){$bisa="enabled";$lin="?module=opbookingdetail&act=editdetail&code=$data[BookingID]";}else{$bisa="disabled";$lin="?module=opbookingdetail&act=editdetails&code=$data[BookingID]";}
                     echo"              
                     </td></td>                                   
                     <td>$data[TourCode]</td>
                     <td>$data[DateTravelFrom]</td>
                     <td>$data[BookersName]</td>
                     <td><center>$data[TCName]</td>
                     <td><center>$data[TCDivision]</td>
                     <td><center>$data[DepositNo]</td>
                     <td><center>$data[AdultPax]</td>
                     <td><center>$data[ChildPax]</td>
                     <td><center>$data[InfantPax]</td>   
                     <td><center><input type=button value='Edit Booking' onclick=location.href='?module=opbookingdetail&act=editdetails&code=$data[BookingID]'></td></tr>";
                      $no++;
                    }
                    echo "</table>";
                    
                    // Langkah 3            
                    $tampil2    = "SELECT * FROM tour_msbooking   
                                WHERE BookingID LIKE '%$nama%'
                                AND Status ='ACTIVE'   
                                ORDER BY BookingID ASC ";
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=opbookingdetail";
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
  
  case "editdetails":
          $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");
          $r=mysql_fetch_array($edit);  
          $awal=mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r[TourCode]'");
          $curawal=mysql_fetch_array($awal);
          $thisyear = date("Y");
          $nextyear = $thisyear+1;
    echo "<h2>Booking ID : $_GET[code]</h2>
          
          <table>
          <tr><td>Tour Code</td> <td>$r[TourCode]</td></tr>   
          <tr><td>Bookers Name</td> <td>$r[BookersName]</td></tr> 
          <tr><td>Telephone</td> <td>$r[BookersTelp]</td></tr>
          <tr><td>Mobile</td> <td>$r[BookersMobile]</td></tr>
          <tr><td>Address</td><td>$r[BookersAddress]</td></tr>    
          <tr><td>Emergency Call</td> <td>$r[EmergencyCall]</td></tr>
          <tr><td>TC Name</td> <td>$r[TCName] - Division: $r[TCDivision]</td></tr>
          <tr><td>Total Pax</td> <td>Adult : $r[AdultPax]<input type=hidden name='adultpaxb4' value='$r[AdultPax]'> &nbsp 
                                     Child : $r[ChildPax]<input type=hidden name='childpaxb4' value='$r[ChildPax]'> &nbsp 
                                     Infant : $r[InfantPax]
          </td></tr>
          <tr><td>Total Room</td> <td>$r[TotalRoom]</td></tr>
          <tr><th colspan=2></th></tr>
          <tr><td>Deposit Date</td> <td>$r[DepositDate]</td></tr>
          <tr><td>Deposit No</td> <td>$r[DepositNo]</td></tr>
          <tr><td>Deposit Amount</td> <td>$r[DepositCurr] ".number_format($r[DepositAmount], 2, '.', '.');echo"</td></tr>                             
          </table> 
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=opbookingdetail&act=update' >
          <input type=hidden name='id' value='$_GET[code]'><input type='hidden' name='laprice' value='$curawal[LandArrSell]'>  
          Booking Information<br>
          <font size='2' color='red'>*<i>all price in $curawal[SellingCurr]</i></font>";
          $tampil=mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE BookingID = '$_GET[code]'
                                ORDER BY IDDetail ASC ");
          
    echo" <table>
          <tr><th>no</th><th>title</th><th>pax name</th><th>type</th><th>package</th><th>room no</th><th>bed type</th><th>price</th><th>sgl supplemen</th><th>disc</th><th>total</th><th></th></tr>";
          $no=$posisi+1;
          $banyak=mysql_num_rows($tampil);
          while ($data=mysql_fetch_array($tampil)){
              
    echo" <tr><td>$no <input type='hidden' name='iddetail$no' value='$data[IDDetail]'> </td>
          <td><select name='title$no' ";if($data[Status]=='CANCEL'){echo"disabled";}echo"><option value=''";if($data[Title]==''){echo"selected";}echo"></option>
                                       <option value='MR'";if($data[Title]=='MR'){echo"selected";}echo">MR</option>
                                       <option value='MRS'";if($data[Title]=='MRS'){echo"selected";}echo">MRS</option>
                                       <option value='MS'";if($data[Title]=='MS'){echo"selected";}echo">MS</option>  
                                       </select></td>
          <td><input type=text name='paxname$no' value='$data[PaxName]' ";if($data[Status]=='CANCEL'){echo"readonly";}echo"></td>
          <td><center>$data[Gender]</td>
          <td><input type=text name='package$no' value='$data[Package]' size='8' style='text-align: center;border: 0px solid #000000;' readonly></td>";
          $cadltwn=mysql_query("SELECT * FROM tour_msproduct   
                                        WHERE TourCode = '$r[TourCode]'");
          $harga=mysql_fetch_array($cadltwn);                                                              
          
    echo" <td><center><select name='noroom$no' ";if($data[Status]=='CANCEL'){echo"disabled";}echo">";
                                       for ($satu=$r[StartRoom]; $satu<=$r[EndRoom]; $satu++){
                                           if($data[RoomNo]==$satu){
                                                echo"<option value='$satu' selected>$satu</option>";     
                                           }else{
                                                echo"<option value='$satu'>$satu</option>";     
                                           }
                                           
                                               }  
                                  echo"</select></td>
          <td><center><input type=text name='selectroom$no' value='$data[RoomType]' size='10' style='text-align: center;border: 0px solid #000000;' readonly></td>";    
          if($data[Gender]=='ADULT'){   
           if($data[RoomType]=='Twin Share'){$hargaroom=$harga[SellingAdlTwn];$hargacharge='0';}
           else if($data[RoomType]=='Double'){$hargaroom=$harga[SellingAdlTwn];$hargacharge='0';}
           else if($data[RoomType]=='Single'){$hargaroom=$harga[SellingAdlTwn];$hargacharge=$harga[SingleSell];}  
           }else if($data[Gender]=='CHILD'){
           if($data[RoomType]=='Twin Share'){$hargaroom=$harga[SellingChdTwn];$hargacharge='0';}
           else if($data[RoomType]=='Double'){$hargaroom=$harga[SellingChdTwn];$hargacharge='0';}
           else if($data[RoomType]=='Xtra Bed'){$hargaroom=$harga[SellingChdXbed];$hargacharge='0';}
           else if($data[RoomType]=='No Bed'){$hargaroom=$harga[SellingChdNbed];$hargacharge='0';}
           else if($data[RoomType]=='Single'){$hargaroom=$harga[SellingChdTwn];$hargacharge=$harga[SingleSell];}  
           }else if($data[Gender]=='INFANT'){$hargaroom=$harga[SellingInfant];$hargacharge='0';}
          $dataDiscount=$data[Discount];
          $subtotal1=$hargaroom+$hargacharge;
          $subtotalnya=$subtotal1-$dataDiscount;
    echo" <td><input type='hidden' name='hharga$no' size='10' value='$hargaroom'><input type='text' name='harga$no' size='10' value=".number_format($hargaroom, 2, '.', '');echo" style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='add$no' size='10' value=".number_format($hargacharge, 2, '.', '');echo" style='text-align: right;border: 0px solid #000000;' readonly></td> 
          <td><input type='text' name='disc$no' value='$dataDiscount' size='7' onkeyup='isNumber(this);UpdateSubtotal($no,$banyak)'></td>
          <td><input type='text' name='total$no' value=".number_format($subtotalnya, 2, '.', '');echo" size='13' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><center>";if($data[Status]<>'CANCEL'){echo"<input type='button' name='submit' value='Detail' onclick=PopupCenter('infodetail.php?id=$data[IDDetail]','variable',420,350)> <input type='button' name='submit' value='X' onclick=Batal($data[IDDetail])>";}else{echo"CANCEL";} echo"</td></tr>";
          $totalseluruh=$totalseluruh+$subtotalnya;
          $no++;
          }
    echo "<tr><td colspan=10 style='text-align: right'><b>Total</b></td><td colspan=2><b>$harga[SellingCurr]</b><input type='text' name='jumtotal' value=".number_format($totalseluruh, 2, ',', '.');echo" size='10' style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=12>Note For Operation <br><textarea name='operationnote' cols='50' rows='3'>$r[OperationNote]</textarea></td></tr>
          <input type='hidden' name='banyak' value='$banyak'>
          <tr><td colspan=12><center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick=location.href='?module=opbookingdetail'></td></tr>
          </table> 
          </form><br><br>";
     break;  
     
  case "cancelpax":    
    $edit1=mysql_query("SELECT * FROM tour_msbookingdetail WHERE IDDetail ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1);
    $book=mysql_query("UPDATE tour_msbooking set Status = 'CANCEL',
                                                Price='0',
                                                AddCharge='0',
                                                SubTotal='0' 
                                                WHERE BookingID = '$r2[BookingID]'");
    $edit=mysql_query("UPDATE tour_msbookingdetail set Status = 'CANCEL',
                                                        Price='0',
                                                        AddCharge='0',
                                                        SubTotal='0' 
                                                        WHERE IDDetail = '$r2[IDDetail]'");
     $cari1=mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r2[TourCode]'");  
     $ulang=mysql_fetch_array($cari1);
     $seatdep = $ulang[SeatDeposit] - 1;
     $seatsisa = $ulang[SeatSisa] + 1;
     $updet=mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdep',
                                                        SeatSisa='$seatsisa'
                                                        WHERE IDProduct = '$ulang[IDProduct]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=opbookingdetail&act=editdetail&code=$r2[BookingID]'>";     
     break;
     
 case "deletedetail":    
    $edit=mysql_query("DELETE FROM tour_detail WHERE IDDetail = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=opbookingdetail&act=quotation&id=$_GET[no]'>";   
     break;
        
 case "cancelbook":    
    $edit1=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID ='$_GET[code]'");  
    $r2=mysql_fetch_array($edit1);
    $cari1=mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r2[TourCode]'");  
    $ulang=mysql_fetch_array($cari1);
    $seatcancel = $_GET[dp];  
    $seatdep = $ulang[SeatDeposit] - $seatcancel;
    $seatsisa = $ulang[SeatSisa] + $seatcancel;
    $updet=mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdep',
                                                        SeatSisa='$seatsisa'
                                                        WHERE IDProduct = '$ulang[IDProduct]'");
    $updets=mysql_query("UPDATE tour_msbooking set Status='VOID' WHERE BookingID = '$_GET[code]'");
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=opbookingdetai'>";
    break; 
    
  case "cancelinq":    
    $edit1=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID ='$_GET[code]'");  
    $r2=mysql_fetch_array($edit1);
    $cari1=mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r2[TourCode]'");  
    $ulang=mysql_fetch_array($cari1);
    $seatcancel = $_GET[inq];  
    $seatdep = $ulang[SeatInquiry] - $seatcancel; 
    $updet=mysql_query("UPDATE tour_msproduct set SeatInquiry = '$seatdep'
                                                        WHERE IDProduct = '$ulang[IDProduct]'");
    $updets=mysql_query("UPDATE tour_msbooking set Status='VOID' WHERE BookingID = '$_GET[code]'");
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=opbookingdetai'>";
    break;             
}
?>
