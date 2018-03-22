<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>         
<script type="text/javascript" src="../head/editable-select.js"></script> 
<script language="JavaScript"  type="text/javascript">   
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
function Batal(ID) {
var alasan=prompt("Reason for Cancel Pax:" );
    if (alasan!=null && alasan!="")
{
 window.location.href = '?module=opbookingdetail&act=cancelpax&id=' + ID + '&reason=' + alasan ;   
}                                                                              
}
function hapusd(DP,ID) {
var alasan=prompt("Reason for Cancel Booking ID: " + ID );
    if (alasan!=null && alasan!="")
{                                                                                     
 window.location.href = '?module=opbookingdetail&act=cancelbook&code=' + ID + '&dp=' + DP + '&reason=' + alasan ;     
} 
}
function hapusi(IN,ID) {
var alasan=prompt("Reason for Cancel Inquiry: " + ID );
    if (alasan!=null && alasan!="")
{
 window.location.href = '?module=opbookingdetail&act=cancelinq&code=' + ID + '&inq=' + IN + '&reason=' + alasan ; ;    
} 
}
function unlocktbf(ID) {
    var alasan=prompt("Reason for Revise Booking ID: " + ID );
    if (alasan!=null && alasan!="")
{                                                                                     
 window.location.href = '?module=opbookingdetail&act=unlocktbf&code=' + ID + '&reason=' + alasan ;      
} 
}
function unlockprice(ID) {
    if (confirm("Are you sure UNLOCK PRICE this booking?"))
    {
        window.location.href = '?module=opbookingdetail&act=unlockprice&code=' + ID  ;
    }
}
function refpage(ID) {   window.location.href ='?module=opbookingdetail&act=deviasi&id='+ID
}
function voiddev(ID) {
if (confirm("Are you sure you want to void " + ID ))
{                          
 window.location.href = '?module=opbookingdetail&act=devvoid&id=' + ID ;
 
} 
}
function isNumber(field) {
var re = /^[0-9'.']*$/;
if (!re.test(field.value)) {
alert('PLEASE INPUT NUMBER!');
field.value = field.value.replace(/[^0-9'.']/g,"");
}
}
function UpdateSubtotal(angka,banyak){
    var h = eval("example.hharga" + angka + ".value;")
    var a = eval("example.aadd" + angka + ".value;")
    var d = eval("example.disc" + angka + ".value;")
    var add = eval("example.adddisc" + angka + ".value;")
    var st = eval("example.total" + angka )
   
    var harga = eval(eval(h) + eval(a)) ;
    st.value = (harga - d - add).toFixed(2);
    
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
function validateSwitch(theForm) {
var reason = ""; 
  reason += validateKlik(theForm.pilihan);
  reason += validateEmpty(theForm.devprice);     
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);
    return false;
  }

  return true;
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
function trim(s) {
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
function validateKlik(fld) {
    var error = "";     
    for(var i=0; i<fld.length; i++){ if(fld+i.checked==false) {error = "Please choose the option.\n" }else{return error}}
    if(!error) error = 1 
    return error
}
function showPrice(angka,banyak) {
var a = eval("example.room" + angka + ".value;")
var dis = eval("example.disc" + angka + ".value;")
var adddis = eval("example.adddisc" + angka + ".value;")
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
t.value = eval(eval(b.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
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
session_start();
$username=$_SESSION[employee_code];
/*$sqluser=mssql_query("SELECT EmployeeID,DivisiNO,Employee.DivisiID,Category,EmployeeName,CompanyGroup,LTMAuthority FROM [HRM].[dbo].[Employee]
                      inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                      WHERE EmployeeID = '$username'");
$tampiluser=mssql_fetch_array($sqluser);*/
$EmpName=$_SESSION[employee_name];
$companyid = $_SESSION['company_id'];
$today = date("Y-m-d G:i:s");
switch($_GET[act]) {
    // Tampil Booking
    default:
        $nama = $_GET['nama'];
        $qnama = str_replace(" ", "%", $nama);
        $sta = $_GET['sta'];
        if ($sta == '') {
            $sta = 'ACTIVE';
            $a = 'checked';
            $b = '';
        } else if ($sta == 'ACTIVE') {
            $a = 'checked';
            $b = '';
        } else if ($sta == 'VOID') {
            $a = '';
            $b = 'checked';
        }
        $cate = $_GET['cate'];
        if ($cate == '') {
            $cate = 'tour_msbooking.TourCode';
        }
        $hariini = date("Y-m-d ");
        //$hariini = date("2015-12-01");

        echo "<h2>Booking Detail</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='opbookingdetail'>
              <select name='cate'><option value='tour_msbooking.TourCode'";
        if ($cate == 'tour_msbooking.TourCode') {
            echo "selected";
        }
        echo ">Tour Code</option>
                                  <option value='tour_msbooking.TCName'";
        if ($cate == 'tour_msbooking.TCName') {
            echo "selected";
        }
        echo ">TC Name</option>
                                  <option value='tour_msbooking.BookingID'";
        if ($cate == 'tour_msbooking.BookingID') {
            echo "selected";
        }
        echo ">Booking ID</option>
                                  <option value='tour_msproduct.DateTravelFrom'";
        if ($cate == 'tour_msproduct.DateTravelFrom') {
            echo "selected";
        }
        echo ">Dept Date</option>
                                  <option value='tour_msproduct.Season'";
        if ($cate == 'tour_msproduct.Season') {
            echo "selected";
        }
        echo ">Season</option>
                                  <option value='tour_msbooking.BookersName'";
        if ($cate == 'tour_msbooking.BookersName') {
            echo "selected";
        }
        echo ">Bookers Name</option>
              </select> <input type=text name=nama value='$nama' size=20>
              <input type=radio name='sta' value='ACTIVE' $a>&nbsp;ACTIVE 
          <input type=radio name='sta' value='VOID' $b>&nbsp;VOID  
              <input type=submit name=oke value=Search>
          </form>";
        $oke = $_GET['oke'];

        // Langkah 1
        $batas = 10;
        $halaman = $_GET['halaman'];
        if (empty($halaman)) {
            $posisi = 0;
            $halaman = 1;
        } else {
            $posisi = ($halaman - 1) * $batas;
        }

        // Langkah 2
        $thisyear = date("Y") - 1;
        if($_SESSION[ltm_authority]=='DEVELOPER'){
            $filterdeveloper='';
        }else{
            $filterdeveloper="AND tour_msproduct.CompanyID = '$companyid'";
        }
        if($_SESSION[ltm_authority]=='PO BRANCH'){
            $filterpo="AND tour_msproduct.InputDivision = '$_SESSION[employee_office]'";
        }else{
            $filterpo='';
        }
        //AND YEAR(tour_msbooking.BookingDate) >= '$thisyear'
        $tampil = mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msbooking.StatusPrice,tour_msproduct.StatusProduct,tour_msbooking.FBTNo,tour_msbooking.TBFNo FROM tour_msbooking
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE $cate LIKE '%$qnama%'
                                        AND tour_msbooking.Status ='$sta'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
                                        $filterdeveloper
                                        $filterpo
                                       ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
        $jumlah = mysql_num_rows($tampil);
        if ($qnama == '') {
            $jumlah = 0;
        } else {
            $jumlah = $jumlah;
        }
        if ($jumlah > 0) {
            echo "   <table>   
                    <tr><th colspan=8>$nama</th><th colspan=3>total pax</th><th></th></tr>
                    <tr><th>no</th><th>Booking ID</th><th>tour code</th><th>Dept</th><th>Bookers</th><th>tc name</th><th>divisi</th><th>cash receipt</th><th>adult</th><th>child</th><th>infant</th><th>action</th></tr>";
            $no = $posisi + 1;
            while ($data = mysql_fetch_array($tampil)) {
                if (strlen($data[TBFNo]) == 15) {
                    $notbf = substr($data[TBFNo], 0, 13);
                } elseif (strlen($data[TBFNo]) == 16) {
                    $notbf = substr($data[TBFNo], 0, 14);
                }
                $cari1 = mysql_query("SELECT * FROM tour_tbfbooking WHERE TBFNo = '$notbf'");
                $ulang = mysql_fetch_array($cari1);
                $carifbt = mysql_query("SELECT * FROM tour_fbtbooking WHERE BookingID = '$data[BookingID]'");
                $datafbt = mysql_fetch_array($carifbt);
                $DateTravelFrom = date('d-m-Y', strtotime($data[DateTravelFrom]));

                echo "<tr><td>$no</td>
                     <td>$data[BookingID]<br>";
                if ($data[FBTNo] <> '' OR $datafbt[Status] == 'ACTIVE') {
                    echo "TRF <img src='../images/ada.png'> ";
                } else {
                    echo " TRF <img src='../images/belum.png'> ";
                }
                if ($data[TBFNo] <> '' AND $ulang[Status] == 'ACTIVE') {
                    echo " TBF <img src='../images/ada.png'>";
                } else {
                    echo " TBF <img src='../images/belum.png'>";
                }
                echo"</td>";
                $edit1 = mysql_query("SELECT count(IDDetail)as bnyk FROM tour_msbookingdetail WHERE BookingID ='$data[BookingID]' and Gender <> 'INFANT' and Status <> 'CANCEL' ");
                $r2 = mysql_fetch_array($edit1);
                if ($data[DepositNo] == '') {
                    $liat = "disabled";
                    $totalinq = $data[AdultPax] + $data[ChildPax];
                } else {
                    $liat = "enabled";
                    $totalinq = $r2[bnyk];
                }
                if (($data[TBFNo] == '' OR $ulang[Status] == 'REVISE') AND $data[FBTNo] == '' AND $data[Status] <> 'VOID') {
                    $opedit = "enabled";
                } else {
                    $opedit = "disabled";
                }
                if ($data[TBFNo] == '' or $ulang[Status] == 'REVISE') {
                    if ($data[StatusPrice] == '') {
                        if ($data[FBTNo] == '' or $data[TBFNo] == '') {
                            $lin = "?module=opbookingdetail&act=editdetails&code=$data[BookingID]";
                            $det = "Edit Booking";
                        } else {
                            $lin = "?module=opbookingdetail&act=editdetails&code=$data[BookingID]";
                            $det = "Edit Booking";
                        }
                    } else {
                        $lin = "?module=opbookingdetail&act=editdetails&code=$data[BookingID]";
                        $det = "Edit Booking";
                    }
                } else {
                    //$lin="?module=opbookingdetail&act=showdetails&code=$data[BookingID]";$det="Show Detail";
                    $lin = "?module=opbookingdetail&act=editdetails&code=$data[BookingID]";
                    $det = "Edit Booking";
                }
                if ($data[TBFNo] <> '' AND $ulang[Status] == 'ACTIVE') {
                    $bisa = "enabled";
                } else {
                    $bisa = "disabled";
                }
                if ($data[StatusPrice] == 'LOCK') {
                    $bisa1 = "enabled";
                } else {
                    $bisa1 = "disabled";
                }
                echo"<td>$data[TourCode]</td>
                     <td>$DateTravelFrom</td>
                     <td>$data[BookersName]</td>
                     <td><center>$data[TCName]</td>
                     <td><center>$data[TCDivision]</td>
                     <td><center>$data[DepositNo]</td>
                     <td><center>$data[AdultPax]</td>
                     <td><center>$data[ChildPax]</td>
                     <td><center>$data[InfantPax]</td>   
                     <td><center>";
                if ($sta == 'ACTIVE') {
                    echo "<input type=button value='$det' onclick=location.href='$lin' $liat>";
                } else {
                    echo "<input type=button value='Edit Booking' disabled>";
                }
                if ($data[DUMMY] == 'YES') {
                    echo "<input type=button value='Move' title='DUMMY Cannot Moved'  disabled>";
                } else {
                    echo "<input type=button value='Move' onclick=location.href='?module=msbookingdetail&act=movebook&id=$data[BookingID]' $opedit>";
                }

                echo "<input type=button value='Cancel Booking' onclick=hapusd('$totalinq','$data[BookingID]') $opedit><br>
                     <input type='button' name='submit' value='UNLOCK TBF' onclick=unlocktbf('$data[BookingID]') $bisa>
                     <input type='button' name='submit' value='UNLOCK PRICE' onclick=unlockprice('$data[BookingID]') $bisa1>

                     </td></tr>";
                $no++;
            }
            echo "</table>";

            // Langkah 3
            $tampil2 = "SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo,tour_msbooking.TBFNo FROM tour_msbooking
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE $cate LIKE '%$qnama%'        
                                        AND tour_msbooking.Status ='$sta'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
                                        $filterdeveloper
                                        $filterpo
                                       ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC";
            $hasil2 = mysql_query($tampil2);
            $jmldata = mysql_num_rows($hasil2);
            $jmlhalaman = ceil($jmldata / $batas);
            $file = "media.php?module=opbookingdetail";
            // Link ke halaman sebelumnya (previous)
            echo "<center><div id='paging'>";
            //$nama1 = str_replace("+", "%2B", str_replace("/", "%2F", str_replace(" ", "+", $nama)));
            $nama1 = str_replace(" ", "+", $nama);
            if ($halaman > 1) {
                $previous = $halaman - 1;
                echo "<a href=$file&halaman=1&nama=$nama1&cate=$cate&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&nama=$nama1&cate=$cate&oke=$oke> < Previous</a> | ";
            } else {
                echo "<< First | < Previous | ";
            }
            // Tampilkan link halaman 1,2,3 ... modifikasi ala google
            // Angka awal
            $angka = ($halaman > 3 ? " ... " : " "); //Ternary Operator
            for ($i = $halaman - 2; $i < $halaman; $i++) {
                if ($i < 1)
                    continue;
                $angka .= "<a href=$file&halaman=$i&nama=$nama1&cate=$cate&oke=$oke>$i</a> ";
            }
            // Angka tengah
            $angka .= " <b>$halaman</b> ";
            for ($i = $halaman + 1; $i < ($halaman + 3); $i++) {
                if ($i > $jmlhalaman)
                    break;
                $angka .= "<a href=$file&halaman=$i&nama=$nama1&cate=$cate&oke=$oke>$i</a> ";
            }
            // Angka akhir
            $angka .= ($halaman + 2 < $jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&nama=$nama1&cate=$cate&oke=$oke>$jmlhalaman</a> |" : " ");
            // Cetak angka seluruhnya (awal, tengah, akhir)
            echo "$angka";
            // Link ke halaman berikutnya (Next)
            if ($halaman < $jmlhalaman) {
                $next = $halaman + 1;
                echo "<a href=$file&halaman=$next&nama=$nama1&cate=$cate&oke=$oke> Next ></a> |
                              <a href=$file&halaman=$jmlhalaman&nama=$nama1&cate=$cate&oke=$oke> Last >></a> ";
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
        $edit = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");
        $r = mysql_fetch_array($edit);
        $awal = mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$r[IDTourcode]'");
        $curawal = mysql_fetch_array($awal);
        $dp = mysql_query("SELECT * FROM tour_xtrapameran 
                                    WHERE IDProduct = '$r[IDTourcode]' and Status='ACTIVE'");
        $ddp = mysql_num_rows($dp);
        $thisyear = date("Y");
        $nextyear = $thisyear + 1;
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
          <tr><td>Deposit Amount</td> <td>$r[DepositCurr] " . number_format($r[DepositAmount], 2, '.', '.');
        echo "</td></tr>                             
          </table> 
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=opbookingdetail&act=update' >
          <input type=hidden name='id' value='$_GET[code]'><input type='hidden' name='laprice' value='$curawal[LandArrSell]'>
          <input type='hidden' name='prodid' value='$curawal[IDProduct]'>   
          Booking Information<br>
          <font size='2' color='red'>*<i>all price in $curawal[SellingCurr]</i></font>";
        $tampil = mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE BookingID = '$_GET[code]'
                                ORDER BY IDDetail ASC ");

        echo " <table>
        <tr><th>no</th><th>title</th><th>pax name</th><th>passport no</th><th>type</th><th>package</th><th>room no</th><th>bed type</th><th>price</th><th>sgl supplemen</th><th>disc</th><th>disc exh</th><th>total</th><th>promo</th><th></th></tr>";
        $no = $posisi + 1;
        $banyak = mysql_num_rows($tampil);
        while ($data = mysql_fetch_array($tampil)) {
            $notbf = substr($data[TBFNo], 0, 13);
            $cari1 = mysql_query("SELECT * FROM tour_tbfbooking WHERE TBFNo = '$notbf'");
            $ulang = mysql_fetch_array($cari1);
            echo " <tr><td>$no <input type='hidden' name='iddetail$no' value='$data[IDDetail]'> </td>
          <td>";
          if($data[DoaProcess] == 0) {
              echo "<select name='title$no' id='title$no'";
              if ($data[Status] == 'CANCEL') {
                  echo "disabled";
              }
              echo ">"; //<option value=''";if($data[Title]==''){echo"selected";}echo"></option>
              if ($data[Gender] == 'ADULT') {
                  echo " <option value='MR'";
                  if ($data[Title] == 'MR') {
                      echo "selected";
                  }
                  echo ">MR</option>
                   <option value='MRS'";
                  if ($data[Title] == 'MRS') {
                      echo "selected";
                  }
                  echo ">MRS</option>
                   <option value='MS'";
                  if ($data[Title] == 'MS') {
                      echo "selected";
                  }
                  echo ">MS</option>";
              }
              if ($data[Gender] == 'CHILD' OR $data[Gender] == 'INFANT') {
                  echo " <option value='MISS'";
                  if ($data[Title] == 'MISS') {
                      echo "selected";
                  }
                  echo ">MISS</option>
                   <option value='MSTR'";
                  if ($data[Title] == 'MSTR') {
                      echo "selected";
                  }
                  echo ">MSTR</option>";
              }
              /*if($data[Gender]=='INFANT'){
               echo" <option value='INF'";if($data[Title]=='INF'){echo"selected";}echo">INF</option>";
                     }*/
              echo " </select>";
          }else{
              echo"<input type='text' name='title$no' id='title$no' value='$data[Title]' size='3' readonly>";
          }
          echo"</td>
          <td><input type=text name='paxname$no' value='$data[PaxName]' ";
            if ($data[Status] == 'CANCEL' OR $data[TBFNo] <> '' or $ulang[Status] == 'ACTIVE' OR $data[DoaProcess] > 0) {
                echo "readonly";
            }
            echo "></td>
          <td>$data[PassportNo]</td>
          <td><center>$data[Gender]</td>
          <td><input type=text name='package$no' value='$data[Package]' size='8' style='text-align: center;border: 0px solid #000000;' readonly></td>";
            $cadltwn = mysql_query("SELECT * FROM tour_msproduct   
                                        WHERE TourCode = '$r[TourCode]' and Status <> 'VOID'");
            $harga = mysql_fetch_array($cadltwn);

            echo " <td><center><input type='text' name='noroom$no' value='$data[RoomNo]' size='2' onkeyup='isNumber(this)'></td>
          <td><center><input type=text name='selectroom$no' value='$data[RoomType]' size='10' style='text-align: center;border: 0px solid #000000;' readonly></td>";
            if ($data[Gender] == 'ADULT' and $data[Package] == 'Tour') {
                if ($data[RoomType] == 'Twin') {
                    $hargaroom = $harga[SellingAdlTwn];
                    $hargacharge = '0';
                }
                if ($data[RoomType] == 'Double') {
                    $hargaroom = $harga[SellingAdlTwn];
                    $hargacharge = '0';
                }
                if ($data[RoomType] == 'Single') {
                    $hargaroom = $harga[SellingAdlTwn];
                    $hargacharge = $harga[SingleSell];
                }
            } else if ($data[Gender] == 'CHILD' and $data[Package] == 'Tour') {
                if ($data[RoomType] == 'Twin') {
                    $hargaroom = $harga[SellingChdTwn];
                    $hargacharge = '0';
                }
                if ($data[RoomType] == 'Double') {
                    $hargaroom = $harga[SellingChdTwn];
                    $hargacharge = '0';
                }
                if ($data[RoomType] == 'Xtra Bed') {
                    $hargaroom = $harga[SellingChdXbed];
                    $hargacharge = '0';
                }
                if ($data[RoomType] == 'No Bed') {
                    $hargaroom = $harga[SellingChdNbed];
                    $hargacharge = '0';
                }
                if ($data[RoomType] == 'Single') {
                    $hargaroom = $harga[SellingChdTwn];
                    $hargacharge = $harga[SingleSell];
                }
            } else if ($data[Gender] == 'INFANT' and $data[Package] == 'Tour') {
                $hargaroom = $harga[SellingInfant];
                $hargacharge = '0';
            } else if ($data[Gender] == 'ADULT' and $data[Package] == 'L.A Only') {
                if ($data[RoomType] == 'Twin') {
                    $hargaroom = $harga[LAAdlTwn];
                    $hargacharge = '0';
                }
                if ($data[RoomType] == 'Double') {
                    $hargaroom = $harga[LAAdlTwn];
                    $hargacharge = '0';
                }
                if ($data[RoomType] == 'Single') {
                    $hargaroom = $harga[LAAdlTwn];
                    $hargacharge = $harga[SingleSell];
                }
            } else if ($data[Gender] == 'CHILD' and $data[Package] == 'L.A Only') {
                if ($data[RoomType] == 'Twin') {
                    $hargaroom = $harga[LAChdTwn];
                    $hargacharge = '0';
                }
                if ($data[RoomType] == 'Double') {
                    $hargaroom = $harga[LAChdTwn];
                    $hargacharge = '0';
                }
                if ($data[RoomType] == 'Xtra Bed') {
                    $hargaroom = $harga[LAChdXbed];
                    $hargacharge = '0';
                }
                if ($data[RoomType] == 'No Bed') {
                    $hargaroom = $harga[LAChdNbed];
                    $hargacharge = '0';
                }
                if ($data[RoomType] == 'Single') {
                    $hargaroom = $harga[LAChdTwn];
                    $hargacharge = $harga[SingleSell];
                }
            } else if ($data[Gender] == 'INFANT' and $data[Package] == 'L.A Only') {
                $hargaroom = $harga[LAInfant];
                $hargacharge = '0';
            }
            $dataDiscount = $data[Discount];
            $addDiscount = $data[AddDiscount];
            $totDiscount = $dataDiscount + $addDiscount;
            $subtotal1 = $hargaroom + $hargacharge;
            $subtotalnya = $subtotal1 - $totDiscount;
            echo " <td><input type='hidden' name='hharga$no' value='$data[Price]'><input type='text' name='harga$no' size='10' value=" . number_format($data[Price], 2, ',', '.');
            echo " style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='hidden' name='aadd$no' value='$data[AddCharge]'><input type='text' name='add$no' size='10' value=" . number_format($data[AddCharge], 2, ',', '.');
            echo " style='text-align: right;border: 0px solid #000000;' readonly></td> 
          <td><input type='text' name='disc$no' value='$data[Discount]' size='7' onkeyup='isNumber(this);UpdateSubtotal($no,$banyak)' ";
            if ($data[Status] == 'CANCEL' OR $data[TBFNo] <> '' or $ulang[Status] == 'ACTIVE') {
                echo "readonly";
            }
            echo "></td>
          <td><input type='text' name='adddisc$no' value='$data[AddDiscount]' size='7' onkeyup='isNumber(this);UpdateSubtotal($no,$banyak)' ";
            if ($data[Status] == 'CANCEL' OR $data[TBFNo] <> '' or $ulang[Status] == 'ACTIVE') {
                echo "readonly";
            }
            echo "></td>
          <td><input type='text' name='total$no' value='$data[SubTotal]' size='13' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><center>";
            if ($ddp < 1) {
                echo "NO";
            } else {
                echo "
          <input type='checkbox' value='YES' name='promo$no'";
                if ($data[Promo] <> '') {
                    echo "checked";
                }
                echo ">";
            }
            echo "</td>
          <td><center>";
            if ($data[Status] <> 'CANCEL') {
                echo "<input type='button' name='submit' value='Detail' onclick=PopupCenter('infodetail.php?id=$data[IDDetail]','variable',420,350)> <input type='button' name='submit' value='X' onclick=Batal($data[IDDetail])>";
            } else {
                echo "CANCEL";
            }
            echo "</td></tr>";
            $totalseluruh = $totalseluruh + $subtotalnya;
            $no++;
        }
        echo "<tr><td colspan=12 style='text-align: right'><b>Total</b></td><td colspan=3><b>$harga[SellingCurr]</b><input type='text' name='jumtotal' value=" . number_format($r[TotalPrice], 2, ',', '.');
        echo "size='10' style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=15>Note For Operation <br><textarea name='operationnote' cols='50' rows='3'>$r[OperationNote]</textarea></td></tr>
          <input type='hidden' name='banyak' value='$banyak'>
          <tr><td colspan=15><center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick=location.href='?module=opbookingdetail'></td></tr>
          </table> 
          </form><br><br>";
        break;

    case "cancelpax":
        $edit1 = mysql_query("SELECT * FROM tour_msbookingdetail WHERE IDDetail ='$_GET[id]'");
        $r2 = mysql_fetch_array($edit1);
        $edit = mysql_query("UPDATE tour_msbookingdetail set Status = 'CANCEL',
                                                        Price='0',
                                                        AddCharge='0',
                                                        Discount = '0',
                                                        SubTotal='0',
                                                        ReasonCancel='$_GET[reason]',
                                                        CancelBy='$EmpName',
                                                        CancelDate='$today' 
                                                        WHERE IDDetail = '$r2[IDDetail]'");
        $cari1 = mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r2[TourCode]' and Status <> 'VOID'");
        $ulang = mysql_fetch_array($cari1);
        $seatdep = $ulang[SeatDeposit] - 1;
        $seatsisa = $ulang[SeatSisa] + 1;
        $updet = mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdep',
                                                        SeatSisa='$seatsisa'
                                                        WHERE IDProduct = '$ulang[IDProduct]'");
        $upbook1 = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$r2[BookingID]'");
        $upbook = mysql_fetch_array($upbook1);
        $adultfix = $upbook[AdultPax] - 1;
        $childfix = $upbook[ChildPax] - 1;
        $inffix = $upbook[InfantPax] - 1;
        if ($r2[Gender] == 'ADULT') {
            $updets = mysql_query("UPDATE tour_msbooking set AdultPax='$adultfix' WHERE BookingID = '$r2[BookingID]'");
        } else if ($r2[Gender] == 'CHILD') {
            $updets = mysql_query("UPDATE tour_msbooking set ChildPax='$childfix' WHERE BookingID = '$r2[BookingID]'");
        } else if ($r2[Gender] == 'INFANT') {
            $updets = mysql_query("UPDATE tour_msbooking set InfantPax='$inffix' WHERE BookingID = '$r2[BookingID]'");
        }
        $Description = "Cancel Pax $r2[IDDetail]";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=opbookingdetail&act=editdetail&code=$r2[BookingID]'>";
        break;

    case "deletedetail":
        $edit = mysql_query("DELETE FROM tour_detail WHERE IDDetail = '$_GET[id]'");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=opbookingdetail&act=quotation&id=$_GET[no]'>";
        break;

    case "cancelbook":
        $hariini = date("Y-m-d ");
        $updets = mysql_query("UPDATE tour_msbooking set Status='VOID',ReasonCancel='$_GET[reason]',CancelBy='$EmpName',CancelDate='$today' WHERE BookingID = '$_GET[code]'");
        $apuspameran = mysql_query("UPDATE tour_msbooking set BookingPlace = '' WHERE BookingID = '$_GET[code]' AND DATE(BookingDate)='$hariini' ");
        $edit = mysql_query("UPDATE tour_msbookingdetail set Status = 'CANCEL',
                                                        Price='0',
                                                        AddCharge='0',
                                                        SubTotal='0'
                                                        WHERE BookingID = '$_GET[code]'");

        $edit1 = mysql_query("SELECT count(IDDetail)as tota,BookingID,TourCode FROM tour_msbookingdetail WHERE BookingID ='$_GET[code]' and Status <> 'CANCEL' and Gender <>'INFANT' GROUP BY BookingID");
        $r2 = mysql_fetch_array($edit1);
        $upbook1 = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");
        $upbook = mysql_fetch_array($upbook1);
        if ($upbook[SFID] <> '') {
            $editptes = mssql_query("UPDATE [PTES].[dbo].[SalesFolderDetails] set [StatusPax] = 'CANCEL'
                                                        WHERE ConfirmationNo = '$r2[BookingID]' AND SupplierName = 'LTM'");
        }
        $mencari1 = mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$upbook[IDTourcode]' and Status <> 'VOID' ");
        $ulang = mysql_fetch_array($mencari1);
        $caribook = mysql_query("SELECT count(IDDetail) as totbuking FROM tour_msbookingdetail WHERE IDTourcode = '$upbook[IDTourcode]' and Gender <> 'INFANT' and Status <> 'CANCEL'");
        $kebook = mysql_fetch_array($caribook);
        /*$seatcancel = $r2[tota];
        $seatdep = $ulang[SeatDeposit] - $seatcancel;
        $seatsisa = $ulang[SeatSisa] + $seatcancel; */
        $seatdep = $kebook[totbuking];
        $seatsisa = $ulang[Seat] - $seatdep;
        $updet = mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdep',
                                                        SeatSisa='$seatsisa'
                                                        WHERE IDProduct = '$upbook[IDTourcode]'");

        $Description = "Cancel Booking $r2[BookingID]";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('$EmpName',
                                   '$Description',
                                   '$today')");
        $ceking = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");
        $cek = mysql_fetch_array($ceking);
        $autocek = mysql_query("UPDATE tour_msbooking set Duplicate = 'NO' WHERE DepositNo = '$cek[DepositNo]' and Duplicate = 'YES' order by IDBookers ASC limit 1");
        //update PTES
        if ($cek[DUMMY] == 'NO') {
            $cekduplicate = mysql_query("SELECT * FROM tour_msbooking WHERE DepositNo = '$cek[DepositNo]' and Status = 'ACTIVE' limit 1");
            $jumlahduplicate = mysql_num_rows($cekduplicate);
            $hasilduplicate = mysql_fetch_array($cekduplicate);
            include "../config/koneksisql.php";
            if ($jumlahduplicate > 0) {
                mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = '$hasilduplicate[BookingID]'
                                                WHERE [CashReceiptId] = '$cek[DepositNo]'");
            } else if ($jumlahduplicate == 0) {
                mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = NULL
                                                WHERE [CashReceiptId] = '$cek[DepositNo]'");
            }
            mysql_close($linkptes);
            include "../config/koneksimaster.php";
        }
        //void voucher
        mysql_query("UPDATE tour_voucherpromo set VoucherStatus = 'VOID',
                                        UpdateBy = 'SYSTEM',
                                        UpdateDate = '$today'
                                        WHERE BookingID = '$bookdraft[BookingID]'");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=opbookingdetail'>";
        break;

    case "cancelinq":
        $edit1 = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID ='$_GET[code]'");
        $r2 = mysql_fetch_array($edit1);
        $cari1 = mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r2[TourCode]' and Status <> 'VOID' and DateTravelFrom >= '$hariini'");
        $ulang = mysql_fetch_array($cari1);
        $seatcancel = $_GET[inq];
        $seatdep = $ulang[SeatInquiry] - $seatcancel;
        $updet = mysql_query("UPDATE tour_msproduct set SeatInquiry = '$seatdep'
                                                        WHERE IDProduct = '$ulang[IDProduct]'");
        $updets = mysql_query("UPDATE tour_msbooking set Status='VOID',ReasonCancel='$_GET[reason]',CancelBy='$EmpName',CancelDate='$today' WHERE BookingID = '$_GET[code]'");
        $Description = "Cancel Inquiry $_GET[code]";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=opbookingdetail'>";
        break;

    case "unlocktbf":
        $edit1 = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID ='$_GET[code]'");
        $r2 = mysql_fetch_array($edit1);
        if (strlen($r2[TBFNo]) == 15) {
            $notbf = substr($r2[TBFNo], 0, 13);
        } elseif (strlen($r2[TBFNo]) == 16) {
            $notbf = substr($r2[TBFNo], 0, 14);
        }
        $cari1 = mysql_query("SELECT * FROM tour_tbfbooking WHERE TBFNo = '$notbf' and Status = 'ACTIVE'");
        $ulang = mysql_fetch_array($cari1);
        $updet = mysql_query("UPDATE tour_tbfbooking set Status='REVISE'
                                                        WHERE TBFNo = '$ulang[TBFNo]'");
        $updets = mysql_query("UPDATE tour_tbfbookingdetail set ReasonRevise='$_GET[reason]' WHERE TBFNo = '$ulang[TBFNo]' and TBFRevNo = '$ulang[TBFRevNo]' ");
        $Description = "Revise TBF $ulang[TBFNo].$ulang[TBFRevNo]";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=opbookingdetail'>";
        break;

    case "unlockprice":
        $updet = mysql_query("UPDATE tour_msbooking set StatusPrice='' WHERE BookingID = '$_GET[code]' ");
        $updets = mysql_query("UPDATE tour_msbookingdetail set StatusPrice='' WHERE BookingID = '$_GET[code]' ");
        $Description = "UNLOCK PRICE BookingID: $_GET[code]";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('$EmpName',
                                   '$Description',
                                   '$today')");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=opbookingdetail'>";
        break;

    case "deviasi":
        $nama = $_GET['nama'];
        echo "<h2>Deviasi List</h2>
          <form method=get action='media.php?'>
                <input type=text name='nama'> 
                <input type=hidden name=module value='opbookingdetail'> 
                <input type=hidden name=act value='deviasi'>   
              <input type=submit name=oke value=Search>
          </form>";
        $oke = $_GET['oke'];
        $batas = 10;
        $halaman = $_GET['halaman'];
        if (empty($halaman)) {
            $posisi = 0;
            $halaman = 1;
        } else {
            $posisi = ($halaman - 1) * $batas;
        }
        if($_SESSION[ltm_authority]=='PO BRANCH'){
            $filterpo="AND tour_msproduct.InputDivision = '$_SESSION[employee_office]'";
        }else{
            $filterpo='';
        }
        $tampil = mysql_query("SELECT tour_devbooking.DevNo,tour_devbooking.BookingID,tour_devbooking.Status,tour_msbooking.TourCode,tour_msbooking.TCName,tour_msbooking.TCDivision FROM tour_devbooking 
                                left join tour_msbooking on tour_msbooking.BookingID = tour_devbooking.BookingID                
                                WHERE (tour_devbooking.DevNo LIKE '%$nama%' 
                                OR tour_msbooking.TCName LIKE '%$nama%'
                                OR tour_msbooking.BookingID LIKE '%$nama%'
                                OR tour_msbooking.TOurCode LIKE '%$nama%'
                                OR tour_devbooking.DevNo LIKE '%$nama%')
                                AND tour_devbooking.Status <> 'VOID' 
                                $filterpo
                                order by tour_devbooking.Status ASC LIMIT $posisi,$batas");
        $jumlah = mysql_num_rows($tampil);

        if ($jumlah > 0) {
            echo "<table>
            <tr><th>no</th><th>Deviasi No</th><th>booking ID</th><th>TourCode</th><th>TC Name</th><th>TC Division</th><th>deviasi status</th><th>action</th>";
            $no = $posisi + 1;
            while ($s = mysql_fetch_array($tampil)) {
                echo "<tr><td>$no</td><td>$s[DevNo]</td><td>$s[BookingID]</td><td>$s[TourCode]</td><td>$s[TCName]</td><td>$s[TCDivision]</td><td>$s[Status]</td><td><input type=button value='View' onclick=location.href='?module=opbookingdetail&act=deviasishow&dev=$s[DevNo]' > <input type='button' value='Void' onclick=voiddev($s[DevNo]) ";
                if ($s[Status] == 'VOID') {
                    echo "disabled";
                }
                echo ">
            </td></tr>";
                $no++;
            }
            echo "</table>";
            $tampil2 = "SELECT tour_devbooking.DevNo,tour_devbooking.BookingID,tour_devbooking.Status,tour_msbooking.TourCode,tour_msbooking.TCName,tour_msbooking.TCDivision FROM tour_devbooking 
                                left join tour_msbooking on tour_msbooking.BookingID = tour_devbooking.BookingID                
                                WHERE (tour_devbooking.DevNo LIKE '%$nama%' 
                                OR tour_msbooking.TCName LIKE '%$nama%'
                                OR tour_msbooking.TOurCode LIKE '%$nama%'
                                OR tour_devbooking.DevNo LIKE '%$nama%')
                                AND tour_devbooking.Status <> 'VOID' 
                                $filterpo
                                order by tour_devbooking.Status ASC";
            $hasil2 = mysql_query($tampil2);
            $jmldata = mysql_num_rows($hasil2);
            $jmlhalaman = ceil($jmldata / $batas);
            $file = "media.php?module=opbookingdetail&act=deviasi";
            // Link ke halaman sebelumnya (previous)
            echo "<center><div id='paging'>";
            $nama1 = str_replace("/", "%2F", str_replace(" ", "+", $nama));
            if ($halaman > 1) {
                $previous = $halaman - 1;
                echo "<a href=$file&halaman=1&nama=$nama1&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&nama=$nama1&oke=$oke> < Previous</a> | ";
            } else {
                echo "<< First | < Previous | ";
            }
            // Tampilkan link halaman 1,2,3 ... modifikasi ala google
            // Angka awal
            $angka = ($halaman > 3 ? " ... " : " "); //Ternary Operator
            for ($i = $halaman - 2; $i < $halaman; $i++) {
                if ($i < 1)
                    continue;
                $angka .= "<a href=$file&halaman=$i&nama=$nama1&oke=$oke>$i</a> ";
            }
            // Angka tengah
            $angka .= " <b>$halaman</b> ";
            for ($i = $halaman + 1; $i < ($halaman + 3); $i++) {
                if ($i > $jmlhalaman)
                    break;
                $angka .= "<a href=$file&halaman=$i&nama=$nama1&oke=$oke>$i</a> ";
            }
            // Angka akhir
            $angka .= ($halaman + 2 < $jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&nama=$nama1&oke=$oke>$jmlhalaman</a> |" : " ");
            // Cetak angka seluruhnya (awal, tengah, akhir)
            echo "$angka";
            // Link ke halaman berikutnya (Next)
            if ($halaman < $jmlhalaman) {
                $next = $halaman + 1;
                echo "<a href=$file&halaman=$next&nama=$nama1&oke=$oke> Next ></a> |
                              <a href=$file&halaman=$jmlhalaman&nama=$nama1&oke=$oke> Last >></a> ";
            } else {
                echo " Next > | Last >>";
            }
            echo "<br><br>Found <b>$jmldata</b> data(s)<p>";
            echo "</div>";
        } else {
            echo "<div id='paging'>";
            echo "<br><br><center>DEVIASI HAS NOT BEEN CREATED</center><br>";
            echo "</div>";
        }
        break;

    case "deviasireq":
        $edit = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[id]'");
        $r = mysql_fetch_array($edit);
        $qdev = mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r[TourCode]' and Year= '$r[Year]'");
        $querydev = mysql_fetch_array($qdev);
        $qflight = mysql_query("SELECT * FROM tour_msprodflight WHERE IDProduct = '$querydev[IDProduct]'");

        echo "<h2>Deviasi Request #$_GET[id]</h2>";
        $cari = mysql_query("SELECT * FROM tour_msbookingdetail where BookingID = '$r[BookingID]' AND Status <> 'CANCEL' AND InfoDeviasi ='' ORDER BY IDDetail ASC");
        $rcari = mysql_num_rows($cari);
        if ($rcari == 0) {
            echo "<center>DEVIASI HAS BEEN CREATED</center><br><center><input type=button value='Close' onclick='self.history.back()'><br><br>";
        } else {
            echo "
          <form name='example' method='POST' action='./aksi.php?module=opbookingdetail&act=devreq' >  
          <font size=2>Tour Code : $r[TourCode]</font>
          <table><input type='hidden' name='id' value='$r[BookingID]'>
          <tr><th width='200'>Passanger Name</th><th width='100'>Passport No</th></tr>";
            $no = 1;
            while ($s = mysql_fetch_array($cari)) {
                echo "<tr><td><input type='checkbox' name='listing[]' id='listing$no' value='$s[IDDetail]'> $s[Title] $s[PaxName]</td><td>$s[PassportNo]</td></tr>";
                $no++;
            }
            echo "</table>
          <font size=2><u>EXTEND / DEVIASI FROM :</u></font><br><br>";
            while ($isiflight = mysql_fetch_array($qflight)) {
                //<input type='checkbox' name='sector[]' id='sector$ke' value='$ke'><input type='hidden' name='aircode$ke' value='$isiflight[IDProduct]'>
                echo "<font size=2>Flight No: $isiflight[AirCode], $isiflight[AirDate] $isiflight[AirMonth] : $isiflight[AirRouteDep]$isiflight[AirRouteArr] ($isiflight[AirTimeDep] - $isiflight[AirTimeArr])</font>";
            }
            echo "<table>
          <tr><th width='70'></th><th width='150'>main</th><th width='150'>option 1</th><th width='150'>option 2</th></tr>
          <tr><td>Ticket</td><td><textarea name='ticket1' cols='40' rows='3'></textarea></td><td><textarea name='ticket2' cols='40' rows='3'></textarea></td><td><textarea name='ticket3' cols='40' rows='3'></textarea></td></tr>
          <tr><td>Others</td><td><textarea name='others1' cols='40' rows='3'></textarea></td><td><textarea name='others2' cols='40' rows='3'></textarea></td><td><textarea name='others3' cols='40' rows='3'></textarea></td></tr>
          </table>
          <center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick='self.history.back()'>
          </form><br><br>";
        }
        break;

    case "deviasishow":
        $edit = mysql_query("SELECT tour_devbooking.DevCurr,tour_devbooking.DevPrice,tour_devbooking.Status,tour_devbooking.Result,tour_msbooking.TourCode,tour_msbooking.Year,
                            tour_devbooking.Ticket1,tour_devbooking.Ticket2,tour_devbooking.Ticket3,tour_devbooking.Others1,tour_devbooking.Others2,tour_devbooking.Others3 FROM tour_devbooking 
                        left join tour_msbooking on tour_msbooking.BookingID = tour_devbooking.BookingID
                        WHERE DevNo = '$_GET[dev]'");
        $r = mysql_fetch_array($edit);
        $qdev = mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r[TourCode]' and Year= '$r[Year]'");
        $querydev = mysql_fetch_array($qdev);
        $qflight = mysql_query("SELECT * FROM tour_msprodflight WHERE IDProduct = '$querydev[IDProduct]'");
        echo "<h2>Deviasi Detail #$_GET[dev]</h2>";
        $cari = mysql_query("SELECT * FROM tour_devbookingdetail where DevNo = '$_GET[dev]' ORDER BY IDDev ASC");
        echo "
          <form name='example' method='POST' onsubmit='return validateSwitch(this)' action='./aksi.php?module=msbooking&act=devpick' >  
          <font size=2>Tour Code : $r[TourCode]</font>
          <table><input type='hidden' name='id' value='$_GET[dev]'>
          <tr><th width='200'>Passanger Name</th><th width='100'>Passport No</th></tr>";
        $no = 1;
        while ($s = mysql_fetch_array($cari)) {
            echo "<tr><td>$s[Title] $s[PaxName]</td><td>$s[PassportNo]</td></tr>";
            $no++;
        }
        echo "</table>
          <font size=2><u>EXTEND / DEVIASI FROM :</u></font><br>
          <table>
          <tr><th colspan=2>flight</th><th colspan=2>Departure</th><th colspan=2>Arrival</th></tr>
          <tr><th width=75>number</th><th width=50>date</th><th width=100>from</th><th width=50>time</th><th width=100>to</th><th width=50>time</th></tr>";
        while ($isiflight = mysql_fetch_array($qflight)) {
            echo "<tr><td>$isiflight[AirCode]</td><td><center>$isiflight[AirDate] $isiflight[AirMonth]</td><td>$isiflight[AirRouteDep]</td><td><center>$isiflight[AirTimeDep]</td><td>$isiflight[AirRouteArr]</td><td><center>$isiflight[AirTimeArr]</td></tr>";
        }
        if ($r[Result] == '1') {
            $p1clr1 = "<font color=red>";
            $p1clr2 = "</font>";
        } else if ($r[Result] == '2') {
            $p2clr1 = "<font color=red>";
            $p2clr2 = "</font>";
        } else if ($r[Result] == '3') {
            $p3clr1 = "<font color=red>";
            $p3clr2 = "</font>";
        }
        echo "</table>
          <table>
          <tr><th width='70'></th>
          <th width='150'>";
        if ($r[Status] == 'REQUEST') {
            echo "<input type='radio' name='pilihan' value='1'>";
        }
        echo "$p1clr1 main$p1clr2</th>
          <th width='150'>";
        if ($r[Status] == 'REQUEST') {
            echo "<input type='radio' name='pilihan' value='2'>";
        }
        echo "$p2clr1 option 1$p2clr2</th>
          <th width='150'>";
        if ($r[Status] == 'REQUEST') {
            echo "<input type='radio' name='pilihan' value='3'>";
        }
        echo "$p3clr1 option 2$p3clr2</th></tr>
          <tr><td>Ticket</td><td><textarea name='ticket1' cols='40' rows='3'>$r[Ticket1]</textarea></td><td><textarea name='ticket2' cols='40' rows='3'>$r[Ticket2]</textarea></td><td><textarea name='ticket3' cols='40' rows='3'>$r[Ticket3]</textarea></td></tr>
          <tr><td>Others</td><td><textarea name='others1' cols='40' rows='3'>$r[Others1]</textarea></td><td><textarea name='others2' cols='40' rows='3'>$r[Others2]</textarea></td><td><textarea name='others3' cols='40' rows='3'>$r[Others3]</textarea></td></tr>
          </table>
          Price : <select name='devcurr' onchange='oncurr()'>";
        $tampil = mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while ($s = mysql_fetch_array($tampil)) {
            if ($r[DevCurr] == '') {
                $dc = "USD";
            } else {
                $dc = $r[DevCurr];
            }
            if ($s[curr] == $dc) {
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select> <input type='text' name='devprice' value='$r[DevPrice]'>";
        echo "<center><input type='submit' name='submit' value='Confirm' ";
        if ($r[Status] == 'VOID' or $r[Result] <> '') {
            echo "disabled";
        }
        echo ">
                            <input type=button value=Cancel onclick='self.history.back()'>
          </form><br><br>";
        break;

    case "devvoid":
        $devno = $_GET[id];
        $bookno = substr($devno, 0, 11);
        mysql_query("UPDATE tour_devbooking SET Status = 'VOID' where DevNo = $devno ");

        mysql_query("UPDATE tour_devbookingdetail set Status='VOID'
                                                WHERE DevNo = $devno ");

        $cari1 = mysql_query("SELECT * FROM tour_devbookingdetail WHERE DevNo = '$devno' and Status = 'VOID'");
        while ($listdev = mysql_fetch_array($cari1)) {
            $bukid = $listdev[IDBooking];
            mysql_query("UPDATE tour_msbookingdetail set InfoDeviasi = '',DeviasiNo=''
                                                WHERE IDDetail = $bukid ");
        }
        $Description = "Void Deviasi $devno";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=opbookingdetail&act=deviasi&id='$bookno'>";
        break;

    case "showdetails":
        $edit = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");
        $r = mysql_fetch_array($edit);
        $awal = mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r[TourCode]' and Status <> 'VOID'");
        $curawal = mysql_fetch_array($awal);
        $thisyear = date("Y");
        $nextyear = $thisyear + 1;
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
          <tr><td>Deposit Amount</td> <td>$r[DepositCurr] " . number_format($r[DepositAmount], 2, '.', '.');
        echo "</td></tr>                             
          </table> 
          <form name='examples' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msbookingdetail&act=update' >
          <input type=hidden name='id' value='$_GET[code]'><input type='hidden' name='laprice' value='$curawal[LandArrSell]'>  
          Booking Information<br>
          <font size='2' color='red'>*<i>all price in $curawal[SellingCurr]</i></font>";
        $tampil = mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE BookingID = '$_GET[code]'
                                ORDER BY RoomNo ASC,IDDetail ASC ");
        if ($curawal[GroupType] == 'CRUISE') {
            $rtype = 'Type';
        } else {
            $rtype = 'bed Type';
        }
        echo " <table>
          <tr><th>no</th><th>title</th><th>pax name</th><th>type</th><th>package</th><th>room no</th><th>$rtype</th><th>price</th><th>sgl supplemen</th><th>disc</th><th>total</th><th></th></tr>";
        $no = $posisi + 1;
        $banyak = mysql_num_rows($tampil);
        while ($data = mysql_fetch_array($tampil)) {
            echo " <tr><td>$no <input type='hidden' name='iddetail$no' value='$data[IDDetail]'> </td>
          <td>$data[Title]</td>
          <td>$data[PaxName]</td>
          <td><center>$data[Gender]</td>
          <td>$data[Package]</td>";
            $cadltwn = mysql_query("SELECT * FROM tour_msproduct   
                                        WHERE TourCode = '$r[TourCode]' and Status <> 'VOID'");
            $harga = mysql_fetch_array($cadltwn);
            if ($data[RoomType] == '12 Pax') {
                $tipe = '1-2 PAX';
            } else if ($data[RoomType] == '34 Pax') {
                $tipe = '3-4 PAX';
            } else {
                $tipe = $data[RoomType];
            }
            echo " <td><center>$data[RoomNo]</td>
          <td><center>$tipe</td>    
          <td><input type='text' name='harga$no' size='10' value=" . number_format($data[Price], 2, '.', '');
            echo " style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='add$no' size='10' value=" . number_format($data[AddCharge], 2, '.', '');
            echo " style='text-align: right;border: 0px solid #000000;' readonly></td> 
          <td><input type='text' name='disc$no' value=" . number_format($data[Discount], 2, '.', '');
            echo " size='7' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='total$no' value=" . number_format($data[SubTotal], 2, '.', '');
            echo " size='13' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><center>";
            if ($data[Status] <> 'CANCEL') {
                echo "<input type='button' name='submit' value='Detail' onclick=PopupCenter('infodetailro.php?id=$data[IDDetail]&usr=$username','variable',420,370)> ";
            } else {
                echo "CANCEL";
            }
            echo "</td></tr>";
            $no++;
        }
        echo "<tr><td colspan=10 style='text-align: right'><b>Total</b></td><td colspan=2><b>$harga[SellingCurr]</b><input type='text' name='jumtotal' value=" . number_format($r[TotalPrice], 2, ',', '.');
        echo " size='10' style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=12>Note For Operation <br><textarea name='operationnote' cols='50' rows='3' readonly>$r[OperationNote]</textarea></td></tr>
          <input type='hidden' name='banyak' value='$banyak'>
          <tr><td colspan=12><center>
                            <input type=button value=Back onclick='self.history.back()'></td></tr>
          </table> 
          </form><br><br>";
        break;

}
?>
