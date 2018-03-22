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
var alasan=prompt("Reason for Cancel Pax:" );
    if (alasan!=null && alasan!="")
{
 window.location.href = '?module=searchdata&act=cancelpax&id=' + ID + '&reason=' + alasan ;   
} 
}
function Batals(ID)
{
var alasan=prompt("Reason for Cancel Pax:" );
    if (alasan!=null && alasan!="")
{
 window.location.href = '?module=searchdata&act=cancelpaxs&id=' + ID + '&reason=' + alasan ;   
} 
}
function hapusd(DP,ID)
{
    var alasan=prompt("Reason for Cancel Booking ID: " + ID );
    if (alasan!=null && alasan!="")
{                                                                                     
 window.location.href = '?module=searchdata&act=cancelbook&code=' + ID + '&dp=' + DP + '&reason=' + alasan ;      
} 
}
function hapusi(IN,ID)
{
var alasan=prompt("Reason for Cancel Inquiry: " + ID );
    if (alasan!=null && alasan!="")
{
 window.location.href = '?module=searchdata&act=cancelinq&code=' + ID + '&inq=' + IN + '&reason=' + alasan ; ;      
} 
}
function hello(string){
   var name=string
   document.getElementById('myseat').value=name;
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
function jumlahin(){             
    var a = example.jumsit;    
    var n1 = eval(example.adultpax.value);
    var n2 = eval(example.childpax.value);
    a.value = (n1 + n2) ;
    if (isNaN(a.value)) {
      a.value=0 ;   
      }
      
 }
function validateFormOnSubmit(theForm) {
var reason = "";                            
  reason += validateEmpty(theForm.bookersname); 
  reason += validateEmpty(theForm.adultpax);  
  reason += validateEmpty(theForm.childpax);  
  reason += validateEmpty(theForm.infantpax);
  reason += validateEmpty(theForm.totalroom);
  reason += validateCek(theForm.adultpax);
  reason += validateDate(theForm.depositdate);         
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
        fld.style.background = 'white';
    } else if (isNaN(stripped)) {
        error = "The number contains illegal characters.\n";
        fld.style.background = 'Yellow';
    } else if (!(stripped.length > 0)) {
        error = "The number is the wrong length.\n";
        fld.style.background = 'Yellow';
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
    if (fld.value != "") { 
    if (depdate > sekarang) {
        fld.style.background = 'Yellow'; 
        error = "Deposit date large than today.\n"
    } else {   
        fld.style.background = 'White';   
    }
    }
    return error;  
}
function validateCek(fld) {
    var error = "";
    var arr = eval(example.jumsit.value);    
    var dep = eval(example.myseat.value);
                                      
    if(arr==0){
        fld.style.background = 'Yellow'; 
        error = "Please Input Min 1 Pax.\n"    
    }else{
        if (dep < arr) {
            fld.style.background = 'Yellow'; 
            error = "Available seat only " + dep + " .\n"
        } else {   
            fld.style.background = 'White';   
        }
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
  var a = eval("example.room" + angka)
  var dis = eval("example.disc" + angka + ".value;")  
  var p = eval("example.package" + angka)
  var gen = eval("example.gen" + angka)
  var tat = eval(example.tourat);var lat = eval(example.laat);
  var tct = eval(example.tourct);var lct = eval(example.lact);
  var tcx = eval(example.tourcx);var lcx = eval(example.lacx);
  var tcn = eval(example.tourcn);var lcn = eval(example.lacn);
  var tin = eval(example.tourin);var lin = eval(example.lain);
  var single = eval(example.singleprice);
  var b = eval("example.harga" + angka)
  var c = eval("example.selectroom" + angka)
  var d = eval("example.add" + angka)
  var t = eval("example.total" + angka) 
  /*if(p.value=='Tour'){ 
    b.value = eval(s[0]).toFixed(2) ;
  }else{
    b.value = eval(la.value).toFixed(2) ; 
  }                                   
  c.value = s[1];
  d.value = eval(s[2]).toFixed(2); 
  t.value = eval(eval(b.value) + eval(d.value) - eval(dis)).toFixed(2);  */
   if(p.value=='Tour'){
      if(gen.value=='ADULT' && a.value=='Twin'){
        b.value = eval(tat.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(tat.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }else if(gen.value=='ADULT' && a.value=='Double'){
        b.value = eval(tat.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(tat.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }else if(gen.value=='ADULT' && a.value=='Single'){
        b.value = eval(tat.value).toFixed(2);
        d.value = eval(single.value).toFixed(2);
        t.value = eval(eval(tat.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }else if(gen.value=='CHILD' && a.value=='Twin'){
        b.value = eval(tct.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(tct.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }else if(gen.value=='CHILD' && a.value=='Double'){
        b.value = eval(tct.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(tct.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }else if(gen.value=='CHILD' && a.value=='Xtra Bed'){
        b.value = eval(tcx.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(tcx.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }else if(gen.value=='CHILD' && a.value=='No Bed'){
        b.value = eval(tcn.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(tcn.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }else if(gen.value=='CHILD' && a.value=='Single'){
        b.value = eval(tct.value).toFixed(2);
        d.value = eval(single.value).toFixed(2);
        t.value = eval(eval(tct.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }else if(gen.value=='INFANT' ){
        b.value = eval(tin.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(tin.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }
  }else if(p.value=='L.A Only'){
      if(gen.value=='ADULT' && a.value=='Twin'){
        b.value = eval(lat.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(lat.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }else if(gen.value=='ADULT' && a.value=='Double'){
        b.value = eval(lat.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(lat.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }else if(gen.value=='ADULT' && a.value=='Single'){
        b.value = eval(lat.value).toFixed(2);
        d.value = eval(single.value).toFixed(2);
        t.value = eval(eval(lat.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }else if(gen.value=='CHILD' && a.value=='Twin'){
        b.value = eval(lct.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(lct.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }else if(gen.value=='CHILD' && a.value=='Double'){
        b.value = eval(lct.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(lct.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }else if(gen.value=='CHILD' && a.value=='Xtra Bed'){
        b.value = eval(lcx.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(lcx.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }else if(gen.value=='CHILD' && a.value=='No Bed'){
        b.value = eval(lcn.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(lcn.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }else if(gen.value=='CHILD' && a.value=='Single'){
        b.value = eval(lct.value).toFixed(2);
        d.value = eval(single.value).toFixed(2);
        t.value = eval(eval(lct.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }else if(gen.value=='INFANT' ){
        b.value = eval(lin.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(lin.value) + eval(d.value) - eval(dis)).toFixed(2);    
      }
  }  
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
<SCRIPT type="text/javascript">
pic1 = new Image(16, 16); 
pic1.src = "./modul/loader.gif";

function cekdeposit() { 

var usr = $("#depositno").val();

if(usr.length >= 1)
{
$("#status").html('<img src="./modul/loader.gif" align="absmiddle">&nbsp;Checking deposit...');

    $.ajax({  
    type: "POST",  
    url: "./modul/checkdep.php",  
    data: { depositno: usr },
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

    if(msg == 'OK')
    { 
        $("#depositno").removeClass('object_error'); // if necessary
        $("#depositno").addClass("object_ok");
        $(this).html('&nbsp;<img src="./modul/tick.gif" align="absmiddle">');
        document.example.elements['dobel'].disabled=true;
    }  
    else  
    {  
        $("#depositno").removeClass('object_ok'); // if necessary
        $("#depositno").addClass("object_error");
        $(this).html(msg);
        document.example.elements['dobel'].disabled=false;
    }  
   
   });

 } 
   
  }); 

}
else
    {
    $("#status").html('<font color="red">Deposit No should have at least <strong>1</strong> characters.</font>');
    $("#depositno").removeClass('object_ok'); // if necessary
    $("#depositno").addClass("object_error");
    }

}
function gantioption(NO,BANYAK)
 { 
 var gen = eval("example.gen" + NO)       
 
 
if(gen.value =='ADULT'){  
var select = document.getElementById('room'+NO);
var content= '<option value="Twin">Twin</option>';
content+= '<option value="Double">Double</option>';
content+= '<option value="Single">Single</option>';
select.innerHTML = content; 
showPrice(NO,BANYAK)
}   
if(gen.value =='CHILD'){
var select = document.getElementById('room'+NO);
var content= '<option value="Twin">Twin</option>';
content+= '<option value="Double">Double</option>';
content+= '<option value="Xtra Bed">Xtra Bed</option>';
content+= '<option value="No Bed">No Bed</option>';
content+= '<option value="Single">Single</option>';
select.innerHTML = content; 
showPrice(NO,BANYAK)
} 
   
  }
</SCRIPT>
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
switch($_GET[act]){
  // Tampil Office
  default:
      $nama=$_GET['nama'];
      $nama2=$_GET['nama2'];
      $qnama=str_replace(" ", "%", $nama);
      $qnama2=str_replace(" ", "%", $nama2);
      if($nama <> '' OR $nama2 <> ''){   
      $cate=$_GET['cate'];
      $cate2=$_GET['cate2'];
      }          
    echo "<h2>Booking Search</h2>
          <form method=get action='media.php?'><input type=hidden name=module value='searchdata'>
          <select name='cate'><option value=''";if($cate==''){echo"selected";}echo">- please select -</option>
                                  <option value='tour_msbooking.TourCode'";if($cate=='tour_msbooking.TourCode'){echo"selected";}echo">Tour Code</option>
                                  <option value='tour_msbooking.TCName'";if($cate=='tour_msbooking.TCName'){echo"selected";}echo">TC Name</option>
                                  <option value='tour_msbooking.BookingID'";if($cate=='tour_msbooking.BookingID'){echo"selected";}echo">Booking ID</option>
                                  <option value='tour_msproduct.DateTravelFrom'";if($cate=='tour_msproduct.DateTravelFrom'){echo"selected";}echo">Dept Date</option>
                                  <option value='tour_msproduct.Season'";if($cate=='tour_msproduct.Season'){echo"selected";}echo">Season</option>
                                  <option value='tour_msbooking.BookersName'";if($cate=='tour_msbooking.BookersName'){echo"selected";}echo">Bookers Name</option>
              </select> <input type=text name=nama value='$nama' size=20><br>
              <select name='cate2'><option value=''";if($cate2==''){echo"selected";}echo">- please select -</option>
                                  <option value='tour_msbooking.TourCode'";if($cate2=='tour_msbooking.TourCode'){echo"selected";}echo">Tour Code</option>
                                  <option value='tour_msbooking.TCName'";if($cate2=='tour_msbooking.TCName'){echo"selected";}echo">TC Name</option>
                                  <option value='tour_msbooking.BookingID'";if($cate2=='tour_msbooking.BookingID'){echo"selected";}echo">Booking ID</option>
                                  <option value='tour_msproduct.DateTravelFrom'";if($cate2=='tour_msproduct.DateTravelFrom'){echo"selected";}echo">Dept Date</option>
                                  <option value='tour_msproduct.Season'";if($cate2=='tour_msproduct.Season'){echo"selected";}echo">Season</option>
                                  <option value='tour_msbooking.BookersName'";if($cate2=='tour_msbooking.BookersName'){echo"selected";}echo">Bookers Name</option>
              </select> <input type=text name='nama2' value='$nama2' size=20>     
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
            $filt=mysql_query("SELECT * FROM tbl_msemployee   
                                left join tbl_msoffice on tbl_msoffice.office_id=tbl_msemployee.office_id
                                WHERE tbl_msemployee.employee_code = '$_SESSION[employee_code]'");
            $filter=mysql_fetch_array($filt);
            $team=$filter[office_code];
            $ltm_authority=$filter[ltm_authority];
            $thisyear = date("Y");
            if($cate=='' and $cate2<>''){
            if($team=='IFM' or $team=='LTM' or $team=='ACC'){
            $tampil=mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.ReasonCancel,tour_msbooking.BookingPlace FROM tour_msbooking   
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate2 LIKE '%$qnama2%'
                                group by tour_msbooking.BookingID ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            }else{
            $tampil=mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.ReasonCancel,tour_msbooking.BookingPlace FROM tour_msbooking   
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate2 LIKE '%$qnama2%'
                                AND TCDivision = '$team'
                                group by tour_msbooking.BookingID ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC LIMIT $posisi,$batas");   
            }$jumlah=mysql_num_rows($tampil);
            }else if($cate2=='' and $cate<>''){
            if($team=='IFM' or $team=='LTM' or $team=='ACC'){
            $tampil=mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.ReasonCancel,tour_msbooking.BookingPlace FROM tour_msbooking   
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate LIKE '%$qnama%'
                                group by tour_msbooking.BookingID ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            }else {
            $tampil=mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.ReasonCancel,tour_msbooking.BookingPlace FROM tour_msbooking   
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate LIKE '%$qnama%'
                                AND TCDivision = '$team'
                                group by tour_msbooking.BookingID ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC LIMIT $posisi,$batas");   
            }$jumlah=mysql_num_rows($tampil);
            }else if($cate<>'' and $cate2<>''){
            if($team=='IFM' or $team=='LTM' or $team=='ACC'){
            $tampil=mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.ReasonCancel,tour_msbooking.BookingPlace FROM tour_msbooking   
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate LIKE '%$qnama%' 
                                AND $cate2 LIKE '%$qnama2%'
                                group by tour_msbooking.BookingID ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            }else {
            $tampil=mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.ReasonCancel,tour_msbooking.BookingPlace FROM tour_msbooking   
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate LIKE '%$qnama%'
                                AND $cate2 LIKE '%$qnama2%'
                                AND TCDivision = '$team'
                                group by tour_msbooking.BookingID ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC LIMIT $posisi,$batas");  
            }$jumlah=mysql_num_rows($tampil);
            }else{$jumlah=0;}
            
            
            if ($jumlah > 0) {
            echo "   <table>   
                    <tr><th colspan=9></th><th colspan=3>total pax</th><th colspan=4></th></tr>
                    <tr><th>no</th><th>Booking ID</th><th>tour code</th><th>Dept</th><th>Bookers</th><th>tc name</th><th>divisi</th><th>cash receipt</th><th>TBF NO</th><th>adult</th><th>child</th><th>infant</th><th>booking Place</th><th>Amount</th><th>status</th><th>info</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){ 
                    $notbf=substr($data[TBFNo],0,13);
                    $cari1=mysql_query("SELECT * FROM tour_tbfbooking WHERE TBFNo = '$notbf'");  
                    $ulang=mysql_fetch_array($cari1); 
                    $edith=mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$data[BookingID]' and PaxName <> '' ORDER BY IDDetail ASC");
                    $r=mysql_fetch_array($edith);  
                    $qflight=mysql_query("SELECT * FROM tour_msprodflight WHERE IDProduct = '$data[IDProduct]'");
                    $rowflight=mysql_num_rows($qflight);
                    if($r[PaxName]=='' or $rowflight=='0'){$dev='disabled';}else{$dev='enabled';}
                    include "../config/koneksifabs.php";
                    $sqlex = mysql_query("SELECT * FROM tbl_exhibition WHERE ExhibitionID = '$data[BookingPlace]' ");
                    //$sqlex=mysql_query("SELECT * FROM tour_marketing WHERE MarketingID = '$data[BookingPlace]'");
                    $dataex=mysql_fetch_array($sqlex);
                    if($dataex[ExhibitionName]<>''){$place=$dataex[ExhibitionName];}else{$place=$data[TCDivision];}
                    mysql_close($dbfabs);
                    include "../config/koneksi.php";
                    $DTF = date("d M Y", strtotime($data[DateTravelFrom]));
					$QTotalSales=mysql_query("SELECT sum((Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0)) as Harga FROM tour_msbookingdetail inner join  tour_msproduct on tour_msproduct.IDProduct=tour_msbookingdetail.IDTourcode where BookingId='$data[BookingID]' ");
				
	
					$DTotalSales=mysql_fetch_array($QTotalSales);
					
					$TotalSales=$DTotalSales[Harga];
					
					
					
               echo "<tr><td>$no</td>
                     <td>";
                     if($data[StatusProduct]=='FINALIZE'){echo"<a href='?module=searchdata&act=showBookingdetail&code=$data[BookingID]'>$data[BookingID]</a>";
                     }else if($data[DateTravelFrom]<$today){echo"<a href=\"javascript:PopupCenter('option.php?code=$data[BookingID]&user=$username','variable',300,250)\">$data[BookingID]</a>";
                     }else if($data[Status]=='VOID'){echo"$data[BookingID]";
                     }else{
						 if($data[DepositNo]=='' or $data[DepositAmount]==''){
							echo"$data[BookingID]";    
						 }else{
							echo"<a href=\"javascript:PopupCenter('option.php?code=$data[BookingID]&user=$username','variable',300,250)\">$data[BookingID]</a>"; 
						 }
					}
					
                     $edit1=mysql_query("SELECT count(IDDetail)as bnyk FROM tour_msbookingdetail WHERE BookingID ='$data[BookingID]' and Gender <> 'INFANT' and Status <> 'CANCEL' ");  
                     $r2=mysql_fetch_array($edit1);
                     if($data[DepositNo]==''){
                     $totalinq = $data[AdultPax] + $data[ChildPax];
                     }else{$totalinq = $r2[bnyk];}
                     if($data[FBTNo]<>'' or ($data[TBFNo]<>'' AND $ulang[Status]<>'REVISE')){$bisa="disabled";}
                     else {$bisa="enabled";}
                     $notbf=substr($data[TBFNo],0,13);
                     $caritbf=mysql_query("SELECT * FROM tour_tbfbooking WHERE TBFNo = '$notbf'");  
                     $stattbf=mysql_fetch_array($caritbf);
                     $ada1=mysql_num_rows($caritbf);      
                     if($ada1>0 AND $data[Status]<>'VOID'){
                     if($stattbf[Status]=='ACTIVE'){$linktbf="<a href='../admin/tbf.php?act=showtbf&TBF=$notbf' target='blank'>$data[TBFNo]</a>";}else{$linktbf="REVISE";}
                     }else{$linktbf="";}  
                     if($data[TBFNo]==''or $ulang[Status]=='REVISE'){
                         if($data[StatusPrice]==''){
                             if($data[FBTNo]=='' or $data[TBFNo]==''){
                             $lin="?module=searchdata&act=editdetail&code=$data[BookingID]";$det="Edit Detail";}
                             else{
                             $lin="?module=searchdata&act=editdetails&code=$data[BookingID]";$det="Edit Detail";    
                             }
                         }  
                         else{$lin="?module=searchdata&act=editdetails&code=$data[BookingID]";$det="Edit Detail";}
                     }else{
                     $lin="?module=searchdata&act=editdetail&code=$data[BookingID]";$det="Show Detail";    
                     }    
                     echo"              
                     </td></td>                                   
                     <td>$data[TourCode]</td>
                     <td>$DTF</td>
                     <td>$data[BookersName]</td>
                     <td><center>$data[TCName]</td>
                     <td><center>$data[TCDivision]</td>
                     <td><center>$data[DepositNo]</td>
                     <td><center>$linktbf</td>
                     <td><center>$data[AdultPax]</td>
                     <td><center>$data[ChildPax]</td>
                     <td><center>$data[InfantPax]</td>
                     <td><center>$place</td> 
					 <td style='text-align:right';>".number_format($TotalSales, 0, '.', ',')."</td>
                     <td><center>$data[Status]</td>   
                     <td><center>";
                     if($data[StatusProduct]=='FINALIZE'){echo"<b>FINALIZE</b>";
                     }else if($data[Status]=='VOID'){echo"<font color=red><b>VOID - $data[ReasonCancel]</b></font>";
                     }else if($data[DateTravelFrom]<$today){echo"<font color=green><b>DEPARTURE</b></font>";
                     }else{}
                     echo"
                     </td></tr>";
                      $no++;
                    }
                    echo "</table>";
                    
                    // Langkah 3         
                    if($cate=='' and $cate2<>''){
                    if($team=='IFM' or $team=='LTM' or $team=='ACC'){
                    $tampil2="SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking   
                                        left join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                        WHERE $cate2 LIKE '%$qnama2%'
                                        group by tour_msbooking.BookingID ORDER BY BookingID DESC LIMIT 50";
                    }else {
                    $tampil2="SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking   
                                        left join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                        WHERE $cate2 LIKE '%$qnama2%'
                                        AND TCDivision = '$team'
                                        group by tour_msbooking.BookingID ORDER BY BookingID DESC LIMIT 50";    
                    }
                    }else if($cate2=='' and $cate<>''){
                    if($team=='IFM' or $team=='LTM' or $team=='ACC'){
                    $tampil2="SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking   
                                        left join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                        WHERE $cate LIKE '%$qnama%'
                                        group by tour_msbooking.BookingID ORDER BY BookingID DESC LIMIT 50";
                    }else {
                    $tampil2="SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking   
                                        left join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                        WHERE $cate LIKE '%$qnama%'
                                        AND TCDivision = '$team'
                                        group by tour_msbooking.BookingID ORDER BY BookingID DESC LIMIT 50";    
                    }
                    }else if($cate<>'' and $cate2<>''){
                    if($team=='IFM' or $team=='LTM' or $team=='ACC'){
                    $tampil2="SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking   
                                        left join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                        WHERE $cate LIKE '%$qnama%' 
                                        AND $cate2 LIKE '%$nama2%'
                                        group by tour_msbooking.BookingID ORDER BY BookingID DESC LIMIT 50";
                    }else {
                    $tampil2="SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking   
                                        left join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                        WHERE $cate LIKE '%$qnama%'
                                        AND $cate2 LIKE '%$qnama2%'
                                        AND TCDivision = '$team'
                                        group by tour_msbooking.BookingID ORDER BY BookingID DESC LIMIT 50";    
                    }
                    }   
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=searchdata";
                    $namas=str_replace(" ", "+", $nama);
                    $namas2=str_replace(" ", "+", $nama2);
                    // Link ke halaman sebelumnya (previous)
                    echo "<center><div id='paging'>";
                    if ($halaman >1) {
                        $previous = $halaman-1;
                        echo "<a href=$file&halaman=1&nama=$namas&cate=$cate&nama2=$namas2&cate2=$cate2&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&nama=$namas&cate=$cate&nama2=$namas2&cate2=$cate2&oke=$oke> < Previous</a> | ";
                    } else {
                        echo "<< First | < Previous | ";
                    }
                    // Tampilkan link halaman 1,2,3 ... modifikasi ala google
                    // Angka awal
                    $angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
                    for ($i=$halaman-2; $i<$halaman; $i++) {
                        if ($i < 1 )
                            continue;
                        $angka .= "<a href=$file&halaman=$i&nama=$namas&cate=$cate&nama2=$namas2&cate2=$cate2&oke=$oke>$i</a> ";
                    }
                    // Angka tengah
                    $angka .= " <b>$halaman</b> ";
                    for ($i=$halaman+1; $i<($halaman+3); $i++) {
                        if ($i > $jmlhalaman)
                            break;
                        $angka .= "<a href=$file&halaman=$i&nama=$namas&cate=$cate&nama2=$namas2&cate2=$cate2&oke=$oke>$i</a> ";    
                    }
                    // Angka akhir
                    $angka .= ($halaman+2<$jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&nama=$namas&cate=$cate&nama2=$namas2&cate2=$cate2&oke=$oke>$jmlhalaman</a> |" : " ");
                    // Cetak angka seluruhnya (awal, tengah, akhir)
                    echo "$angka";
                    // Link ke halaman berikutnya (Next)
                    if ($halaman < $jmlhalaman) {
                        $next = $halaman+1;
                        echo "<a href=$file&halaman=$next&nama=$namas&cate=$cate&nama2=$namas2&cate2=$cate2&oke=$oke> Next ></a> |
                              <a href=$file&halaman=$jmlhalaman&nama=$namas&cate=$cate&nama2=$namas2&cate2=$cate2&oke=$oke> Last >></a> ";
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
  
  case "editbooking":
          $cari=mysql_query("SELECT tbl_msoffice.office_code,tbl_msemployee.employee_name FROM tbl_msemployee left join tbl_msoffice on tbl_msemployee.office_id = tbl_msoffice.office_id WHERE employee_code = '$_SESSION[employee_code]'");
          $staff=mysql_fetch_array($cari);  
          $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[id]'");
          $r=mysql_fetch_array($edit);  
          $cariid=mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r[TourCode]' and Status <> 'VOID'");
          $hasilnya=mysql_fetch_array($cariid);
          $thisyear = date("Y");
          $nextyear = $thisyear+1;            
          if($r[DepositDate]=='0000-00-00'){$depdate='';}else{$depdate=$r[DepositDate];}
          if($r[DepositAmount]=='0.00'){$depamount='';}else{$depamount=$r[DepositAmount];}
    echo "<h2>Booking ID : $_GET[id]</h2>
          <table style='border: 0px solid #000000;'>
          <tr><td style='border: 0px solid #000000;'>
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msbookingdetail&act=input' >
          <input type=hidden name='id' value='$_GET[id]'> 
          <table>
          <tr><td>Tour Code</td> <td>$r[TourCode]</td></tr>   
          <tr><td>Bookers Name</td> <td><input type=text name='bookersname' value='$r[BookersName]'></td></tr> 
          <tr><td>Telephone</td> <td><input type=text name='bookerstelp' value='$r[BookersTelp]'></td></tr>
          <tr><td>Mobile</td> <td><input type=text name='bookersmobile' value='$r[BookersMobile]'></td></tr>
          <tr><td>Address</td><td><textarea name='bookersaddress' cols='50' rows='3'>$r[BookersAddress]</textarea></td></tr>    
          <tr><td>Emergency Call</td> <td><textarea name='emergencycall' cols='50' rows='3'>$r[EmergencyCall]</textarea></td></tr>
          <tr><td>TC Name</td> <td>$r[TCName] - Division: $r[TCDivision]
          <input type=hidden name='tcname' value='$staff[employee_name]'><input type=hidden name='tcdivision' value='$satff[office_code]'></td></tr>
          <tr><td>Total Pax</td> <td>Adult <input type=text name='adultpax' size=3 onkeyup='jumlahin(),isNumber(this)' value='$r[AdultPax]'>&nbsp 
                                     Child <input type=text name='childpax' size=3 onkeyup='jumlahin(),isNumber(this)' value='$r[ChildPax]'>&nbsp 
                                     Infant <input type=text name='infantpax' size=3 onkeyup='isNumber(this)' value='$r[InfantPax]'>
          </td></tr>
          <input type='hidden' name='adultpaxb4' value='$r[AdultPax]'>
          <input type='hidden' name='childpaxb4' value='$r[ChildPax]'>
          <input type='hidden' name='tourcode' value='$r[TourCode]'>
          <tr><td>Total Room</td> <td><input type=text name='totalroom' size=3 onkeyup='isNumber(this)' value='$r[TotalRoom]'></td></tr>
          <tr><th colspan=2></th></tr>
          <tr><td>Deposit Date</td> <td><input type='text' name='depositdate' size='10' value='$depdate' onClick="."cal.select(document.forms['example'].depositdate,'ActIn1','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(yyyy-mm-dd)</font></td></tr>
          <tr><td>Deposit No</td> <td><input type=text name='depositno' value='$r[DepositNo]' id='depositno' onBlur='cekdeposit()'> <input type='checkbox' name='dobel' value='ya' disabled>&nbsp Duplicate<div  id='status'></div></td></tr>
          <tr><td>Deposit Amount</td> <td><select name='depositcurr' >";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            while($s=mysql_fetch_array($tampil)){
                if($r[DepositCurr]<>''){
                    if($s[curr]==$r[DepositCurr]){
                         echo "<option value='$s[curr]' selected>$s[curr]</option>";    
                    } else {
                         echo "<option value='$s[curr]' >$s[curr]</option>";
                    }
                }else{
                    if($s[curr]=='IDR'){
                         echo "<option value='$s[curr]' selected>$s[curr]</option>";    
                    } else {
                         echo "<option value='$s[curr]' >$s[curr]</option>";
                    }
                }
            }
            $jumsit=$r[AdultPax]+$r[ChildPax];
    echo "</select><input type=text name='depositamount' value='$depamount' onkeyup='isNumber(this)'><input type='hidden' name='jumsit' value='$jumsit'><input type='hidden' id='myseat' value='$hasilnya[SeatSisa]'></td></tr>
          <tr><td colspan=2><center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick=location.href='?module=searchdata'></td></tr>
          </table> </form>
          </td><td style='border: 0px solid #000000;'></td><td style='border: 0px solid #000000;'><iframe src='info.php?id=$hasilnya[IDProduct]' width='500' height='700' frameborder='0'></iframe></td></tr></table><br><br>";
     break;


case "editdetail":
          $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");
          $r=mysql_fetch_array($edit);  
          $awal=mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r[TourCode]' and Status <> 'VOID'");
          $curawal=mysql_fetch_array($awal);
          $thisyear = date("Y");
          $nextyear = $thisyear+1;
    echo "<h2>Booking ID : $_GET[code]</h2>
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msbookingdetail&act=update' >
          <input type=hidden name='moduls' value='searchdata'>
          <table>
          <tr><td>Tour Code</td> <td>$r[TourCode]</td></tr>   
          <tr><td>Bookers Name</td> <td>$r[BookersName]</td></tr> 
          <tr><td>Telephone</td> <td><input type='text' name='bookerstelp' value='$r[BookersTelp]' onkeyup='isNumber(this)'></td></tr>
          <tr><td>Mobile</td> <td><input type='text' name='bookersmobile' value='$r[BookersMobile]' onkeyup='isNumber(this)'></td></tr>
          <tr><td>Address</td><td><textarea name='bookersaddress' cols='50' rows='3'>$r[BookersAddress]</textarea></td></tr>    
          <tr><td>Emergency Call</td> <td><textarea name='emergencycall' cols='50' rows='3'>$r[EmergencyCall]</textarea></td></tr>
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
          
          <input type=hidden name='id' value='$_GET[code]'>
          <input type='hidden' name='tourat' value='$curawal[SellingAdlTwn]'><input type='hidden' name='laat' value='$curawal[LAAdlTwn]'>
          <input type='hidden' name='tourct' value='$curawal[SellingChdTwn]'><input type='hidden' name='lact' value='$curawal[LAChdTwn]'>
          <input type='hidden' name='tourcx' value='$curawal[SellingChdXbed]'><input type='hidden' name='lacx' value='$curawal[LAChdXbed]'>
          <input type='hidden' name='tourcn' value='$curawal[SellingChdNbed]'><input type='hidden' name='lacn' value='$curawal[LAChdNbed]'>
          <input type='hidden' name='tourin' value='$curawal[SellingInfant]'><input type='hidden' name='lain' value='$curawal[LAInfant]'>  
          <input type='hidden' name='singleprice' value='$curawal[SingleSell]'>
          Booking Information<br>
          <font size='2' color='red'>*<i>all price in $curawal[SellingCurr]</i></font>";
          $tampil=mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE BookingID = '$_GET[code]'
                                ORDER BY IDDetail ASC ");
          $cekstatus=mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE BookingID = '$_GET[code]'
                                AND Status <>'CANCEL' ");
          $dapet=mysql_num_rows($cekstatus);                      
    echo" <table>
          <tr><th>no</th><th>title</th><th>pax name</th><th>passport no</th><th>type</th><th>package</th><th>room no</th><th>bed type</th><th>price</th><th>sgl supplemen</th><th>disc</th><th>total</th><th></th></tr>";
          $no=$posisi+1;
          $banyak=mysql_num_rows($tampil);
          while ($data=mysql_fetch_array($tampil)){
              
    echo" <tr><td>$no <input type='hidden' name='iddetail$no' value='$data[IDDetail]'> </td>
          <td><select name='title$no' ";if($data[Status]=='CANCEL'){echo"disabled";}echo"><option value=''";if($data[Title]==''){echo"selected";}echo"></option>
                                       <option value='MR'";if($data[Title]=='MR'){echo"selected";}echo">MR</option>
                                       <option value='MRS'";if($data[Title]=='MRS'){echo"selected";}echo">MRS</option>
                                       <option value='MS'";if($data[Title]=='MS'){echo"selected";}echo">MS</option>
                                       <option value='MSTR'";if($data[Title]=='MSTR'){echo"selected";}echo">MSTR</option>   
                                       <option value='INF'";if($data[Title]=='INF'){echo"selected";}echo">INF</option>
                                       </select></td>
          <td><input type=text name='paxname$no' maxlength='50' value='$data[PaxName]' ";if($data[Status]=='CANCEL'){echo"readonly";}echo"></td>
          <td>$data[PassportNo]</td>
          <td><select name='gen$no' onChange='showPrice($no,$banyak),gantioption($no,$banyak)' ";if($data[Status]=='CANCEL'){echo"disabled";}echo">
                                       ";if($data[Gender]<>'INFANT'){echo"
                                       <option value='ADULT'";if($data[Gender]=='ADULT'){echo"selected";}echo">ADULT</option>
                                       <option value='CHILD'";if($data[Gender]=='CHILD'){echo"selected";}echo">CHILD</option>";
                                       }else {echo"
                                       <option value='INFANT'";if($data[Gender]=='INFANT'){echo"selected";}echo">INFANT</option>";  
                                       }echo"
                                       </select></td>
          <td><select name='package$no' onChange='showPrice($no,$banyak)' ";if($data[Status]=='CANCEL'){echo"disabled";}echo"><option value='Tour'";if($data[Package]=='Tour'){echo"selected";}echo">Tour</option>
                                       <option value='L.A Only'";if($data[Package]=='L.A Only'){echo"selected";}echo">L.A Only</option>  
                                       </select></td>";
          $cadltwn=mysql_query("SELECT * FROM tour_msproduct   
                                        WHERE TourCode = '$r[TourCode]' and Status <> 'VOID'");
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
          <td><center><select name='room$no' id='room$no' onChange='showPrice($no,$banyak)'";if($data[Status]=='CANCEL'){echo"disabled";}echo">";
                                       
                                       if($data[Gender]=='ADULT' and $data[Package]=='Tour'){   
                                       echo"<option value='Twin'";if($data[RoomType]=='Twin'){echo"selected"; $hargaroom=$harga[SellingAdlTwn];$hargacharge='0';}echo">Twin</option>
                                       <option value='Double'";if($data[RoomType]=='Double'){echo"selected";$hargaroom=$harga[SellingAdlTwn];$hargacharge='0';}echo">Double</option>
                                       <option value='Single'";if($data[RoomType]=='Single'){echo"selected";$hargaroom=$harga[SellingAdlTwn];$hargacharge=$harga[SingleSell];}echo">Single</option>
                                       <option value='Triple'";if($data[RoomType]=='Triple'){echo"selected"; $hargaroom=$harga[SellingAdlTwn];$hargacharge='0';}echo">Triple</option>";  
                                       }else if($data[Gender]=='CHILD' and $data[Package]=='Tour'){
                                       echo"<option value='Twin'";if($data[RoomType]=='Twin'){echo"selected";$hargaroom=$harga[SellingChdTwn];$hargacharge='0';}echo">Twin</option>
                                       <option value='Double'";if($data[RoomType]=='Double'){echo"selected";$hargaroom=$harga[SellingChdTwn];$hargacharge='0';}echo">Double</option>
                                       <option value='Xtra Bed'";if($data[RoomType]=='Xtra Bed'){echo"selected";$hargaroom=$harga[SellingChdXbed];$hargacharge='0';}echo">Xtra Bed</option>
                                       <option value='No Bed'";if($data[RoomType]=='No Bed'){echo"selected";$hargaroom=$harga[SellingChdNbed];$hargacharge='0';}echo">No Bed</option>
                                       <option value='Single'";if($data[RoomType]=='Single'){echo"selected";$hargaroom=$harga[SellingChdTwn];$hargacharge=$harga[SingleSell];}echo">Single</option>
                                       <option value='Triple'";if($data[RoomType]=='Triple'){echo"selected";$hargaroom=$harga[SellingChdTwn];$hargacharge='0';}echo">Triple</option>";  
                                       }else if($data[Gender]=='INFANT' and $data[Package]=='Tour'){$hargaroom=$harga[SellingInfant];$hargacharge='0';
                                       echo"
                                       <option value='No Bed'>No Bed</option>";  
                                       }
                                       else if($data[Gender]=='ADULT' and $data[Package]=='L.A Only'){   
                                       echo"<option value='Twin'";if($data[RoomType]=='Twin'){echo"selected"; $hargaroom=$harga[LAAdlTwn];$hargacharge='0';}echo">Twin</option>
                                       <option value='Double'";if($data[RoomType]=='Double'){echo"selected";$hargaroom=$harga[LAAdlTwn];$hargacharge='0';}echo">Double</option>
                                       <option value='Single'";if($data[RoomType]=='Single'){echo"selected";$hargaroom=$harga[LAAdlTwn];$hargacharge=$harga[SingleSell];}echo">Single</option>
                                       <option value='Triple'";if($data[RoomType]=='Triple'){echo"selected"; $hargaroom=$harga[LAAdlTwn];$hargacharge='0';}echo">Triple</option>";  
                                       }else if($data[Gender]=='CHILD' and $data[Package]=='L.A Only'){
                                       echo"<option value='Twin'";if($data[RoomType]=='Twin'){echo"selected";$hargaroom=$harga[LAChdTwn];$hargacharge='0';}echo">Twin</option>
                                       <option value='Double'";if($data[RoomType]=='Double'){echo"selected";$hargaroom=$harga[LAChdTwn];$hargacharge='0';}echo">Double</option>
                                       <option value='Xtra Bed'";if($data[RoomType]=='Xtra Bed'){echo"selected";$hargaroom=$harga[LAChdXbed];$hargacharge='0';}echo">Xtra Bed</option>
                                       <option value='No Bed'";if($data[RoomType]=='No Bed'){echo"selected";$hargaroom=$harga[LAChdNbed];$hargacharge='0';}echo">No Bed</option>
                                       <option value='Single'";if($data[RoomType]=='Single'){echo"selected";$hargaroom=$harga[LAChdTwn];$hargacharge=$harga[SingleSell];}echo">Single</option>
                                       <option value='Triple'";if($data[RoomType]=='Triple'){echo"selected";$hargaroom=$harga[LAChdTwn];$hargacharge='0';}echo">Triple</option>";  
                                       }else if($data[Gender]=='INFANT' and $data[Package]=='L.A Only'){$hargaroom=$harga[LAInfant];$hargacharge='0';
                                       echo"
                                       <option value='No Bed'>No Bed</option>";  
                                       }
                                       echo"</select> <input type=hidden name='selectroom$no' value='$data[RoomType]'</td>";    
          $dataDiscount=$data[Discount];
          $subtotal1=$hargaroom+$hargacharge;
          $subtotalnya=$subtotal1-$dataDiscount;
          
          if($data[Status]=='CANCEL'){
              $hargaroom='0';
              $hargacharge='0';
              $subtotalnya='0';
              $dataDiscount='0';
          }else{
              $hargaroom=$hargaroom;
              $hargacharge=$hargacharge;
              $subtotalnya=$subtotalnya;
              $dataDiscount=$dataDiscount;}
           if($dapet>1){$buttonx="onclick=Batal($data[IDDetail])";}else{$buttonx="onclick=hapusd('$dapet','$_GET[code]')";}   
    echo" <td><input type='text' name='harga$no' size='10' value=".number_format($hargaroom, 2, '.', '');echo" style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='add$no' size='10' value=".number_format($hargacharge, 2, '.', '');echo" style='text-align: right;border: 0px solid #000000;' readonly></td> 
          <td><input type='text' name='disc$no' value=".number_format($dataDiscount, 2, '.', '');echo" size='7' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='total$no' value=".number_format($subtotalnya, 2, '.', '');echo" size='13' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><center>";if($data[Status]<>'CANCEL'){echo"<input type='button' name='submit' value='Detail' onclick=PopupCenter('infodetail.php?id=$data[IDDetail]','variable',420,370)> <input type='button' name='submit' value='X' $buttonx>";}else{echo"CANCEL";} echo"</td></tr>";
          $totalseluruh=$totalseluruh+$subtotalnya;
          $no++;
          }
    echo "<tr><td colspan=11 style='text-align: right'><b>Extra Discount</b></td><td colspan=2><input type='text' name='xtradisc' value='0' size='13' style='text-align: right;' onkeyup=Totalnya($banyak)></td></tr>
          <tr><td colspan=11 style='text-align: right'><b>Total</b></td><td colspan=2><b>$harga[SellingCurr]</b><input type='text' name='jumtotal' value=".number_format($totalseluruh, 2, ',', '.');echo" size='10' style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=13>Note For Operation <br><textarea name='operationnote' cols='50' rows='3'>$r[OperationNote]</textarea></td></tr>
          <input type='hidden' name='banyak' value='$banyak'>
          <tr><td colspan=13><center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick=location.href='?module=searchdata'></td></tr>
          </table> 
          </form><br><br>";
     break;  
  
  case "editdetails":
          $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");
          $r=mysql_fetch_array($edit);  
          $awal=mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r[TourCode]' and Status <> 'VOID'");
          $curawal=mysql_fetch_array($awal);
          $thisyear = date("Y");
          $nextyear = $thisyear+1;
          $filt=mysql_query("SELECT * FROM tbl_msemployee   
                                left join tbl_msoffice on tbl_msoffice.office_id=tbl_msemployee.office_id
                                left join cim_msjob on cim_msjob.IDJob=tbl_msemployee.employee_title
                                WHERE tbl_msemployee.employee_code = '$_SESSION[employee_code]'");
            $filter=mysql_fetch_array($filt);
            $team=$filter[office_code];
            $jabatan=$filter[JobID];
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
          <form name='examples' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msbookingdetails&act=update' >
          <input type=hidden name='moduls' value='searchdata'>
          <input type=hidden name='id' value='$_GET[code]'><input type='hidden' name='laprice' value='$curawal[LandArrSell]'>  
          Booking Information<br>
          <font size='2' color='red'>*<i>all price in $curawal[SellingCurr]</i></font>";
          $tampil=mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE BookingID = '$_GET[code]'
                                ORDER BY IDDetail ASC ");
          $cekstatus=mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE BookingID = '$_GET[code]'
                                AND Status <>'CANCEL' ");
          $dapet=mysql_num_rows($cekstatus); 
    echo" <table>
          <tr><th>no</th><th>title</th><th>pax name</th><th>passport no</th><th>type</th><th>package</th><th>room no</th><th>bed type</th><th>price</th><th>sgl supplemen</th><th>disc</th><th>total</th><th></th></tr>";
          $no=$posisi+1;
          $banyak=mysql_num_rows($tampil);
          while ($data=mysql_fetch_array($tampil)){
    echo" <tr><td>$no <input type='hidden' name='iddetail$no' value='$data[IDDetail]'> </td>
          <td><select name='title$no' ";if($data[Status]=='CANCEL'){echo"disabled";}echo"><option value=''";if($data[Title]==''){echo"selected";}echo"></option>
                                       <option value='MR'";if($data[Title]=='MR'){echo"selected";}echo">MR</option>
                                       <option value='MRS'";if($data[Title]=='MRS'){echo"selected";}echo">MRS</option>
                                       <option value='MS'";if($data[Title]=='MS'){echo"selected";}echo">MS</option>
                                       <option value='MSTR'";if($data[Title]=='MSTR'){echo"selected";}echo">MSTR</option>   
                                       <option value='INF'";if($data[Title]=='INF'){echo"selected";}echo">INF</option>  
                                       </select></td>
          <td><input type=text name='paxname$no' value='$data[PaxName]' ";if($data[Status]=='CANCEL'){echo"readonly";}echo"></td>
          <td>$data[PassportNo]</td>
          <td><center>$data[Gender]</td>
          <td><input type=text name='package$no' value='$data[Package]' size='8' readonly></td>";
          $cadltwn=mysql_query("SELECT * FROM tour_msproduct   
                                        WHERE TourCode = '$r[TourCode]' and Status <> 'VOID'");
          $harga=mysql_fetch_array($cadltwn);
          if($dapet<>1){$buttonx="onclick=Batals($data[IDDetail])";}else{$buttonx="onclick=hapusd('$dapet','$_GET[code]')";}   
    echo" <td><center><select name='noroom$no' ";if($data[Status]=='CANCEL'){echo"disabled";}echo">";
                                       for ($satu=$r[StartRoom]; $satu<=$r[EndRoom]; $satu++){
                                           if($data[RoomNo]==$satu){
                                                echo"<option value='$satu' selected>$satu</option>";     
                                           }else{
                                                echo"<option value='$satu'>$satu</option>";     
                                           }
                                           
                                               }  
                                  echo"</select></td>
          <td><center><input type=text name='selectroom$no' value='$data[RoomType]' size='10' readonly></td>    
          <td><input type='text' name='harga$no' size='10' value=".number_format($data[Price], 2, '.', '');echo" style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='add$no' size='10' value=".number_format($data[AddCharge], 2, '.', '');echo" style='text-align: right;border: 0px solid #000000;' readonly></td> 
          <td><input type='text' name='disc$no' value=".number_format($data[Discount], 2, '.', '');echo" size='7' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='total$no' value=".number_format($data[SubTotal], 2, '.', '');echo" size='13' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><center>";if($data[Status]<>'CANCEL'){echo"<input type='button' name='submit' value='Detail' onclick=PopupCenter('infodetail.php?id=$data[IDDetail]','variable',420,370)> <input type='button' name='submit' value='X' $buttonx >";}else{echo"CANCEL";} echo"</td></tr>";
          $no++;
          }
    echo "<tr><td colspan=11 style='text-align: right'><b>Extra Discount</b></td><td colspan=2>";
          if($team=='IFM' or $team=='LTM' or $jabatan=='MGR'){
          echo"<input type='text' name='xtradisc' value='$r[ExtraDiscount]' size='13' style='text-align: right;' onkeyup=isNumber(this),Totalnyas($banyak)>";
          }else{
          echo"<input type='hidden' name='xtradisc' value='$r[ExtraDiscount]' size='13'>$r[ExtraDiscount]";    
          }
    echo "</td></tr>
          <tr><td colspan=11 style='text-align: right'><b>Total</b></td><td colspan=2><b>$harga[SellingCurr]</b><input type='text' name='jumtotal' value=".number_format($r[TotalPrice], 2, ',', '.');echo" size='10' style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=13>Note For Operation <br><textarea name='operationnote' cols='50' rows='3'>$r[OperationNote]</textarea></td></tr>
          <input type='hidden' name='banyak' value='$banyak'>
          <tr><td colspan=13><center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick=location.href='?module=searchdata'></td></tr>
          </table> 
          </form><br><br>";
     break;    
    
   case "showdetail":
          $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");
          $r=mysql_fetch_array($edit);  
          $awal=mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r[TourCode]' and Status <> 'VOID'");
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
          <form name='examples' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=searchdata&act=update' >
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
          <td>$data[Title]</td>
          <td>$data[PaxName]</td>
          <td><center>$data[Gender]</td>
          <td>$data[Package]</td>";
          $cadltwn=mysql_query("SELECT * FROM tour_msproduct   
                                        WHERE TourCode = '$r[TourCode]' and Status <> 'VOID'");
          $harga=mysql_fetch_array($cadltwn);
    echo" <td><center>$data[RoomNo]</td>
          <td><center>$data[RoomType]</td>    
          <td><input type='text' name='harga$no' size='10' value=".number_format($data[Price], 2, '.', '');echo" style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='add$no' size='10' value=".number_format($data[AddCharge], 2, '.', '');echo" style='text-align: right;border: 0px solid #000000;' readonly></td> 
          <td><input type='text' name='disc$no' value=".number_format($data[Discount], 2, '.', '');echo" size='7' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='total$no' value=".number_format($data[SubTotal], 2, '.', '');echo" size='13' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><center>";if($data[Status]<>'CANCEL'){echo"<input type='button' name='submit' value='Detail' onclick=PopupCenter('infodetailro.php?id=$data[IDDetail]','variable',420,370)> ";}else{echo"CANCEL";} echo"</td></tr>";
          $no++;
          }
    echo "<tr><td colspan=10 style='text-align: right'><b>Total</b></td><td colspan=2><b>$harga[SellingCurr]</b><input type='text' name='jumtotal' value=".number_format($r[TotalPrice], 2, ',', '.');echo" size='10' style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=12>Note For Operation <br><textarea name='operationnote' cols='50' rows='3' readonly>$r[OperationNote]</textarea></td></tr>
          <input type='hidden' name='banyak' value='$banyak'>
          <tr><td colspan=12><center>
                            <input type=button value=Back onclick=location.href='?module=searchdata'></td></tr>
          </table> 
          </form><br><br>";
     break;  
	 
 
   case "showBookingdetail":
          $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");
          $r=mysql_fetch_array($edit);  
          $awal=mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r[TourCode]' and Status <> 'VOID'");
          $curawal=mysql_fetch_array($awal);
          $thisyear = date("Y");
          $nextyear = $thisyear+1;
		  $datenow = date("d", time());
          $monthnow = date("m", time());          
          $today = $thisyear."-".$monthnow."-".$datenow;
		  
		  if ($r[DepositDate]=='0000-00-00' ){$tanggalDep=$today;}else{$tanggalDep=$r[DepositDate];}
          $DDate = date('d-m-Y', strtotime($tanggalDep));
          if($r[FBTNo]<>'' OR $r[StatusPrice]=='LOCK'){$kurensi="$r[Curr]";}else{$kurensi="$curawal[SellingCurr]";}
    echo "<h2>Booking ID : $_GET[code]</h2>
          <table style='border:0px'><td style='border:0px'>
          <table class='bordered'>
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
          <tr><td>Deposit Date</td> <td>$DDate</td></tr>
          <tr><td>Deposit No</td> <td>$r[DepositNo]</td></tr>
          <tr><td>Deposit Amount</td> <td>$r[DepositCurr] ".number_format($r[DepositAmount], 2, '.', '.');echo"</td></tr>                             
          <tr><td>Invoice No</td> <td>$r[InvoiceNo]</td></tr>
          </table>
          </td><td style='border:0px'></td><td style='border:0px'>";
       $editd=mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_GET[code]' AND Gender <> 'INFANT' ");
       $jd=mysql_num_rows($editd);
       $rd=mysql_fetch_array($editd);
       $totreq=$r[ReqPromo];

       if($totreq==$jd){$reqpromo='disabled';}else{$reqpromo='enabled';}
       $username=$_SESSION[employee_code];
       echo "<table class='bordered'>";
       $qvoucher=mysql_query("SELECT * FROM tour_voucherpromo WHERE BookingID = '$_GET[code]' ORDER BY VoucherStatus, VoucherNo ASC ");
       $jvoucher=mysql_num_rows($qvoucher);
       if($jvoucher>0){
           echo "<tr><th colspan='6'>You Have $jvoucher Bonus Voucher</th></tr>
          <tr><th>no</th><th>voucher no</th><th>pax</th><th>bonus</th><th>status</th>";
           $s=1;
           while($rvoucher=mysql_fetch_array($qvoucher)){
               if($rvoucher[VoucherStatus]=='REQUEST'){$stts='ON REQUEST';}
               else{$stts=$rvoucher[VoucherStatus];}
               if($rvoucher['Print']=='1' OR $rvoucher[VoucherStatus]<>'APPROVE'){$lok='disabled';}else{$lok='enabled';}
               $vid=$rvoucher[VoucherID];
               $bid=$_GET[code];
               echo "<tr><td>$s</td>
          <td>$rvoucher[VoucherNo]</td>
          <td><center>$rvoucher[Pax]</center></td>
          <td>$rvoucher[Promo]</td>
          <td><center>$stts<center></td>
          </tr>";
               $s++;
           }
       }
       echo "</table>
          </td>
          </table>
          <form name='examples' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msbookingdetail&act=update' >
          <input type=hidden name='id' value='$_GET[code]'><input type='hidden' name='laprice' value='$curawal[LandArrSell]'>  
          Booking Information<br>
          <font size='2' color='red'>*<i>all price in $kurensi</i></font>";
          $tampil=mysql_query("SELECT * FROM tour_msbookingdetail   
                                WHERE BookingID = '$_GET[code]'
                                ORDER BY RoomNo ASC,IDDetail ASC ");
          if($curawal[GroupType]=='CRUISE'){$rtype='Type';}else{$rtype='bed Type';}
    echo" <table class='bordered'>
          <tr><th>no</th><th>title</th><th>pax name</th><th>type</th><th>package</th><th>room no</th><th>$rtype</th><th>price</th><th>sgl supplemen</th><th>disc</th><th>total</th><th>Status</th></tr>";
          $no=$posisi+1;
          $banyak=mysql_num_rows($tampil);
          while ($data=mysql_fetch_array($tampil)){
    echo" <tr><td>$no <input type='hidden' name='iddetail$no' value='$data[IDDetail]'> </td>
          <td>$data[Title]</td>
          <td>$data[PaxName]</td>
          <td><center>$data[Gender]</td>
          <td>$data[Package]</td>";
          $cadltwn=mysql_query("SELECT * FROM tour_msproduct   
                                        WHERE TourCode = '$r[TourCode]' and Status <> 'VOID'");
          $harga=mysql_fetch_array($cadltwn);
          if($data[RoomType]=='12 Pax'){$tipe='1-2 PAX';}
          else if($data[RoomType]=='34 Pax'){$tipe='3-4 PAX';}
          else{$tipe=$data[RoomType];}
    echo" <td><center>$data[RoomNo]</td>
          <td><center>$tipe</td>    
          <td><input type='text' name='harga$no' size='10' value=".number_format($data[Price], 2, '.', '');echo" style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='add$no' size='10' value=".number_format($data[AddCharge], 2, '.', '');echo" style='text-align: right;border: 0px solid #000000;' readonly></td> 
          <td><input type='text' name='disc$no' value=".number_format($data[Discount], 2, '.', '');echo" size='7' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='total$no' value=".number_format($data[SubTotal], 2, '.', '');echo" size='13' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><center>";if($data[Status]<>'CANCEL'){echo"ACTIVE";}else{echo"$data[Status]";} echo"</td></tr>";
          $no++;                                         
          }
          $modul=$_GET[mod];
          if($modul=='msvoucher'){$modul=$modul;}else{$modul='msbookingdetail';}
          if($r[TotalPrice]==''){$totalprice='0';}else{$totalprice=$r[TotalPrice];}
    echo "<tr><td colspan=10 style='text-align: right'><b>Total</b></td><td colspan=2><b>$harga[SellingCurr]</b><input type='text' name='jumtotal' size='10' value=".number_format($totalprice, 2, ',', '.');echo" style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=12>Note For Operation <br>$r[OperationNote]</td></tr>
          <input type='hidden' name='banyak' value='$banyak'>
          <tr><td colspan=12><center>
                            <input type=button value=Back onclick=location.href='?module=searchdata'></td></tr>
          </table> 
          </form><br><br>";
     break;    
	 
     
  case "cancelpax":    
    $edit1=mysql_query("SELECT * FROM tour_msbookingdetail WHERE IDDetail ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1); 
    $upbook1=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$r2[BookingID]'");  
    $upbook=mysql_fetch_array($upbook1);   
    $edit=mysql_query("UPDATE tour_msbookingdetail set Status = 'CANCEL',
                                                        Price='0',
                                                        AddCharge='0',
                                                        Discount = '0',
                                                        SubTotal='0',
                                                        ReasonCancel='$_GET[reason]',
                                                        CancelBy='$EmpName',
                                                        CancelDate='$today' 
                                                        WHERE IDDetail = '$r2[IDDetail]'");
     $cari1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$upbook[IDTourcode]' and Status <> 'VOID'");  
     $ulang=mysql_fetch_array($cari1);
     $caribook=mysql_query("SELECT count(IDDetail) as totbuking FROM tour_msbookingdetail WHERE IDTourcode = '$upbook[IDTourcode]' and Gender <> 'INFANT' and Status <> 'CANCEL'");  
     $kebook=mysql_fetch_array($caribook);
     $seatdep = $kebook[totbuking];
     $seatsisa = $ulang[Seat] - $seatdep;
     $updet=mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdep',
                                                        SeatSisa='$seatsisa'
                                                        WHERE IDProduct = '$ulang[IDProduct]'");
     
     $adultfix=$upbook[AdultPax]-1;
     $childfix=$upbook[ChildPax]-1;
     $inffix=$upbook[InfantPax]-1;
     if($r2[Gender]=='ADULT'){
     $updets=mysql_query("UPDATE tour_msbooking set AdultPax='$adultfix' WHERE BookingID = '$r2[BookingID]'");
     }else if($r2[Gender]=='CHILD'){
     $updets=mysql_query("UPDATE tour_msbooking set ChildPax='$childfix' WHERE BookingID = '$r2[BookingID]'");
     }else if($r2[Gender]=='INFANT'){
     $updets=mysql_query("UPDATE tour_msbooking set InfantPax='$inffix' WHERE BookingID = '$r2[BookingID]'");
     }
     if($upbook[SFID]<>''){
     $edit=mssql_query("UPDATE dbo.SalesFolderDetails set StatusLTM = 'CANCEL'
                                                        WHERE ConfirmationNo = '$r2[BookingID]' and PAXNAME ='$r2[PaxName]' ");    
     }
     $Description="Cancel Pax $r2[IDDetail]";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=searchdata&act=editdetail&code=$r2[BookingID]'>";     
     break;
     
 case "cancelpaxs":    
    $edit1=mysql_query("SELECT * FROM tour_msbookingdetail WHERE IDDetail ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1);     
    $upbook1=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$r2[BookingID]'");  
    $upbook=mysql_fetch_array($upbook1);
    $edit=mysql_query("UPDATE tour_msbookingdetail set Status = 'CANCEL',
                                                        Price='0',
                                                        AddCharge='0',
                                                        Discount = '0',
                                                        SubTotal='0',
                                                        ReasonCancel='$_GET[reason]',
                                                        CancelBy='$EmpName',
                                                        CancelDate='$today' 
                                                        WHERE IDDetail = '$r2[IDDetail]'");
     $cari1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$upbook[IDTourcode]' and Status <> 'VOID'");  
     $ulang=mysql_fetch_array($cari1);
     $caribook=mysql_query("SELECT count(IDDetail) as totbuking FROM tour_msbookingdetail WHERE IDTourcode = '$upbook[IDTourcode]' and Gender <> 'INFANT' and Status <> 'CANCEL'");  
     $kebook=mysql_fetch_array($caribook);
     $seatdep = $kebook[totbuking];
     $seatsisa = $ulang[Seat] - $seatdep;
     $updet=mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdep',
                                                        SeatSisa='$seatsisa'
                                                        WHERE IDProduct = '$ulang[IDProduct]'");
     
     $adultfix=$upbook[AdultPax]-1;
     $childfix=$upbook[ChildPax]-1;
     $inffix=$upbook[InfantPax]-1;
     if($r2[Gender]=='ADULT'){
     $updets=mysql_query("UPDATE tour_msbooking set AdultPax='$adultfix' WHERE BookingID = '$r2[BookingID]'");
     }else if($r2[Gender]=='CHILD'){
     $updets=mysql_query("UPDATE tour_msbooking set ChildPax='$childfix' WHERE BookingID = '$r2[BookingID]'");
     }else if($r2[Gender]=='INFANT'){
     $updets=mysql_query("UPDATE tour_msbooking set InfantPax='$inffix' WHERE BookingID = '$r2[BookingID]'");
     }
     if($upbook[SFID]<>''){
     $edit=mssql_query("UPDATE dbo.SalesFolderDetails set StatusLTM = 'CANCEL'
                                                        WHERE ConfirmationNo = '$r2[BookingID]' and PAXNAME ='$r2[PaxName]' ");    
     }
     $Description="Cancel Pax $r2[IDDetail]";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=searchdata&act=editdetails&code=$r2[BookingID]'>";     
     break;
     
 case "deletedetail":    
    $edit=mysql_query("DELETE FROM tour_detail WHERE IDDetail = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=searchdata&act=quotation&id=$_GET[no]'>";   
     break;
        
 case "cancelbook":    
    $updets=mysql_query("UPDATE tour_msbooking set Status='VOID',ReasonCancel='$_GET[reason]',CancelBy='$EmpName',CancelDate='$today' WHERE BookingID = '$_GET[code]'");
    $edit=mysql_query("UPDATE tour_msbookingdetail set Status = 'CANCEL',
                                                        Price='0',
                                                        AddCharge='0',
                                                        SubTotal='0' 
                                                        WHERE BookingID = '$_GET[code]'");
    if($upbook[SFID]<>''){
    $editptes=mssql_query("UPDATE dbo.SalesFolderDetails set StatusLTM = 'CANCEL'
                                                        WHERE ConfirmationNo = '$r2[BookingID]' ");   
    }
    $edit1=mysql_query("SELECT count(IDDetail)as tota,BookingID,TourCode FROM tour_msbookingdetail WHERE BookingID ='$_GET[code]' and Status <> 'CANCEL' and Gender <>'INFANT' GROUP BY BookingID");  
    $r2=mysql_fetch_array($edit1);
    $upbook1=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");  
    $upbook=mysql_fetch_array($upbook1);
    
    $cari1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$upbook[IDTourcode]' and Status <> 'VOID' and DateTravelFrom >= '$hariini'");  
    $ulang=mysql_fetch_array($cari1);
    $caribook=mysql_query("SELECT count(IDDetail) as totbuking FROM tour_msbookingdetail WHERE IDTourcode = '$upbook[IDTourcode]' and Gender <> 'INFANT' and Status <> 'CANCEL'");  
    $kebook=mysql_fetch_array($caribook);
    /*$seatcancel = $r2[tota];  
    $seatdep = $ulang[SeatDeposit] - $seatcancel;
    $seatsisa = $ulang[SeatSisa] + $seatcancel; */        
    $seatdep = $kebook[totbuking];
    $seatsisa = $ulang[Seat] - $seatdep;
    $updet=mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdep',
                                                        SeatSisa='$seatsisa'
                                                        WHERE IDProduct = '$ulang[IDProduct]'");
    $Description="Cancel Booking $r2[BookingID]";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
    $ceking=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");  
    $cek=mysql_fetch_array($ceking);
    $autocek=mysql_query("UPDATE tour_msbooking set Duplicate='NO' WHERE DepositNo = '$cek[DepositNo]' and Duplicate='YES' order by IDBookers ASC limit 1");                        
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=searchdata'>";
    break; 
    
  case "cancelinq":    
    $edit1=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID ='$_GET[code]'");  
    $r2=mysql_fetch_array($edit1);
    $cari1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$r2[IDTourcode]' and Status <> 'VOID' and DateTravelFrom >= '$hariini'");  
    $ulang=mysql_fetch_array($cari1);
    $seatcancel = $_GET[inq];  
    $seatdep = $ulang[SeatInquiry] - $seatcancel; 
    $updet=mysql_query("UPDATE tour_msproduct set SeatInquiry = '$seatdep'
                                                        WHERE IDProduct = '$ulang[IDProduct]'");
    $updets=mysql_query("UPDATE tour_msbooking set Status='VOID',ReasonCancel='$_GET[reason]',CancelBy='$EmpName',CancelDate='$today' WHERE BookingID = '$_GET[code]'");
    $Description="Cancel Inquiry $_GET[code]";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=searchdata'>";
    break;
    
  case "showexhibition":    
  $edit=mysql_query("SELECT BookingDate FROM tour_msbooking WHERE BookingPlace = '$_GET[id]' AND Status = 'ACTIVE' group by BookingDate ASC");
  while($r1=mysql_fetch_array($edit)) {
      $tanggalbook = date("d M Y", strtotime($r1[BookingDate]));
        echo"<font color='blue' size='2'>Date: $tanggalbook</font> <br>";
      $edit1=mysql_query("SELECT TourCode FROM tour_msbooking WHERE BookingPlace ='$_GET[id]' AND Status ='ACTIVE' AND BookingDate = '$r1[BookingDate]' group by TourCode ASC"); 
      echo"<table><tr><th>no</th><th width='250'>TourCode</th><th>Total Deposit</th><th>Adult</th><th>Child</th><th>Infant</th></tr>";
      $no=1;
      $totaldp = 0;
      $totaladult = 0;
      $totalchild = 0;
      $totalinfant = 0;
      while($r2=mysql_fetch_array($edit1)){
          $d = mysql_query("SELECT TourCode,count(BookingID)as deppameran,sum(AdultPax)as totadult,sum(ChildPax)as totchild,sum(InfantPax)as totinf FROM tour_msbooking 
                                    WHERE BookingPlace = '$_GET[id]' 
                                    and BookingDate = '$r1[BookingDate]' 
                                    and TourCode = '$r2[TourCode]'
                                    and Status = 'ACTIVE'
                                    group by TourCode,BookingDate ASC");
      while($dd = mysql_fetch_array($d)){
        echo "<tr><td>$no</td>
             <td><center>$dd[TourCode]</td>
             <td><center>$dd[deppameran]</td>   
             <td><center>$dd[totadult]</td>
             <td><center>$dd[totchild]</td>
             <td><center>$dd[totinf]</td> 
             </tr>";
      $no++;
      $totaldp = $totaldp+$dd[deppameran];
      $totaladult = $totaladult+$dd[totadult];
      $totalchild = $totalchild+$dd[totchild];
      $totalinfant = $totalinfant+$dd[totinf];
    }                                                                                        
    }
    echo"<tr><td></td><td><center><b>TOTAL</b></td><td><center><b>$totaldp</b></td><td><center><b>$totaladult</b></td><td><center><b>$totalchild</b></td><td><center><b>$totalinfant</b></td></tr></table>";
  }
    echo"<center><input type=button value=Back onclick=location.href='?module=home'></center><br>";                                                                                     
    break; 
    
  case "showexcancel":    
  $edit = mysql_query("SELECT * FROM tour_msbooking 
                        left join tour_marketing on tour_msbooking.BookingPlace = tour_marketing.MarketingID 
                        left join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                        WHERE tour_msbooking.BookingPlace = '$_GET[id]' and tour_msbooking.Status='VOID'");
  $edit1 = mysql_query("SELECT * FROM tour_marketing 
                        WHERE MarketingID = '$_GET[id]'");
  $ye=mysql_fetch_array($edit1);
  echo "<h2> Detail Cancel Booking from $ye[Event] </h2> 
            <table>   
                    <tr><th colspan=8></th><th colspan=3>total pax</th><th></th></tr>
                    <tr><th>no</th><th>Booking ID</th><th>tour code</th><th>Dept</th><th>Bookers</th><th>tc name</th><th>divisi</th><th>cash receipt</th><th>adult</th><th>child</th><th>infant</th><th>reason</th></tr>"; 
                  $no=1;
  while($data=mysql_fetch_array($edit)) {
      
        echo "<tr><td>$no</td>
             <td><center>$data[BookingID]</td>
             <td>$data[TourCode]</td>
             <td>$data[DateTravelFrom]</td>
             <td>$data[BookersName]</td>
             <td><center>$data[TCName]</td>
             <td><center>$data[TCDivision]</td>
             <td><center>$data[DepositNo]</td>
             <td><center>$data[AdultPax]</td>
             <td><center>$data[ChildPax]</td>
             <td><center>$data[InfantPax]</td>
             <td>$data[ReasonCancel]</td> 
             </tr>";
      $no++;                                                                                  
    }
    echo"</table><center><input type=button value=Back onclick=location.href='?module=rpsalesex'></center><br>";                                                                                     
    break;   
    
 case "ltmbook":    
  $nama=$_GET['nama'];
    echo "<h2>Booking Detail</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='msbookingdetail'>
              TourCode <input type=text name=nama value='$nama' size=20>    
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
            $filt=mysql_query("SELECT * FROM tbl_msemployee   
                                left join tbl_msoffice on tbl_msoffice.office_id=tbl_msemployee.office_id
                                WHERE tbl_msemployee.employee_code = '$_SESSION[employee_code]'");
            $filter=mysql_fetch_array($filt);
            $team=$filter[office_code];   
            $tampil=mysql_query("SELECT * FROM tour_msbooking   
                                left join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                WHERE tour_msbooking.TourCode LIKE '%$nama%'
                                AND TCDivision = 'LTM'
                                AND tour_msbooking.Status ='ACTIVE'
                                and tour_msproduct.Status <> 'VOID'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
                                ORDER BY BookingID DESC LIMIT $posisi,$batas");  
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "   <table>   
                    <tr><th colspan=9></th><th colspan=3>total pax</th><th></th></tr>
                    <tr><th>no</th><th>Booking ID</th><th>tour code</th><th>Dept</th><th>Bookers</th><th>tc name</th><th>alias name</th><th>divisi</th><th>cash receipt</th><th>adult</th><th>child</th><th>infant</th><th>action</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){                                                
               echo "<tr><td>$no</td>
                     <td>
                     ";if($data[DepositNo]=='' or $data[DepositAmount]==''){
                        echo"$data[BookingID]";    
                     }else{
                        echo"<a href=\"javascript:PopupCenter('option.php?code=$data[BookingID]','variable',180,90)\">$data[BookingID]</a>"; 
                     }
                     $edit1=mysql_query("SELECT count(IDDetail)as bnyk FROM tour_msbookingdetail WHERE BookingID ='$data[BookingID]' and Gender <> 'INFANT' and Status <> 'CANCEL' group by BookingID");  
                     $r2=mysql_fetch_array($edit1);
                     if($data[DepositNo]==''){
                     $totalinq = $data[AdultPax] + $data[ChildPax];
                     }else{$totalinq = $r2[bnyk];}
                     if($data[FBTNo]==''){$bisa="enabled";$lin="?module=searchdata&act=editdetail&code=$data[BookingID]";}else{$bisa="disabled";$lin="?module=searchdata&act=editdetails&code=$data[BookingID]";}
                     echo"              
                     </td></td>                                   
                     <td>$data[TourCode]</td>
                     <td>$data[DateTravelFrom]</td>
                     <td>$data[BookersName]</td>
                     <td><center>$data[TCName]</td>
                     <td><center>$data[TCNameAlias]</td>
                     <td><center>$data[TCDivision]</td>
                     <td><center>$data[DepositNo]</td>
                     <td><center>$data[AdultPax]</td>
                     <td><center>$data[ChildPax]</td>
                     <td><center>$data[InfantPax]</td>   
                     <td><center>";if($data[DepositNo]==''){
                        echo"<input type=button value='Edit Booking' onclick=location.href='?module=searchdata&act=editbooking&id=$data[BookingID]'>
                        <input type='button' name='submit' value='CANCEL' onclick=hapusi('$totalinq','$data[BookingID]') $bisa>";    
                     }else{
                        echo"<input type=button value='Edit Detail' onclick=location.href='$lin'> 
                        <input type='button' name='submit' value='CANCEL' onclick=hapusd('$totalinq','$data[BookingID]') $bisa>"; 
                     }
                     echo"
                     </td></tr>";
                      $no++;
                    }
                    echo "</table>";
                    
                    // Langkah 3            
                      
                        $tampil2="SELECT * FROM tour_msbooking   
                                            left join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                            WHERE tour_msbooking.TourCode LIKE '%$nama%'
                                            AND TCDivision = 'LTM'
                                            AND tour_msbooking.Status ='ACTIVE'
                                            and tour_msproduct.Status <> 'VOID'
                                            and tour_msproduct.DateTravelFrom >= '$hariini'
                                            ORDER BY BookingID ASC";    
                        
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=searchdata";
                    // Link ke halaman sebelumnya (previous)
                    echo "<center><div id='paging'>";
                    if ($halaman >1) {
                        $previous = $halaman-1;
                        echo "<a href=$file&act=ltmbook&halaman=1&nama=$nama&oke=$oke> << First</a> |
                              <a href=$file&act=ltmbook&halaman=$previous&nama=$nama&oke=$oke> < Previous</a> | ";
                    } else {
                        echo "<< First | < Previous | ";
                    }
                    // Tampilkan link halaman 1,2,3 ... modifikasi ala google
                    // Angka awal
                    $angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
                    for ($i=$halaman-2; $i<$halaman; $i++) {
                        if ($i < 1 )
                            continue;
                        $angka .= "<a href=$file&act=ltmbook&halaman=$i&nama=$nama&oke=$oke>$i</a> ";
                    }
                    // Angka tengah
                    $angka .= " <b>$halaman</b> ";
                    for ($i=$halaman+1; $i<($halaman+3); $i++) {
                        if ($i > $jmlhalaman)
                            break;
                        $angka .= "<a href=$file&act=ltmbook&halaman=$i&nama=$nama&oke=$oke>$i</a> ";    
                    }
                    // Angka akhir
                    $angka .= ($halaman+2<$jmlhalaman ? " ...
                        <a href=$file&act=ltmbook&halaman=$jmlhalaman&nama=$nama&oke=$oke>$jmlhalaman</a> |" : " ");
                    // Cetak angka seluruhnya (awal, tengah, akhir)
                    echo "$angka";
                    // Link ke halaman berikutnya (Next)
                    if ($halaman < $jmlhalaman) {
                        $next = $halaman+1;
                        echo "<a href=$file&act=ltmbook&halaman=$next&nama=$nama&oke=$oke> Next ></a> |
                              <a href=$file&act=ltmbook&halaman=$jmlhalaman&nama=$nama&oke=$oke> Last >></a> ";
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
    
    case "movebook":
          $hariini = date("Y-m-d ");
          $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[id]'");
          $r=mysql_fetch_array($edit);
          $totalpax=$r[AdultPax] + $r[ChildPax]; 
          $oke2=mysql_query("SELECT * FROM tour_msproduct 
                            WHERE SeatSisa >= '$totalpax'
                            and Status = 'PUBLISH'
                            and StatusProduct = 'OPEN'
                            and DateTravelFrom >= '$hariini'                                        
                            ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC");
          echo"
          <h2>Move Booking</h2>
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=searchdata&act=move' > 
          <input type=hidden name='id' value='$_GET[id]'>
          <table>
          <tr><td>Booking ID</td> <td>$r[BookingID]</td></tr>
          <tr><td>Total Pax</td> <td>$totalpax Pax (Adult : $r[AdultPax] Pax, Child : $r[ChildPax] Pax, Infant : $r[InfantPax] Pax)</td></tr><input type='hidden' name='pax' value='$totalpax'>  
          <tr><td>Bookers</td> <td>$r[BookersName]</td></tr> 
          <tr><td>Tour Code</td> <td>$r[TourCode]</td></tr> <input type=hidden name='turbefore' value='$r[TourCode]'><input type=hidden name='yearbefore' value='$r[Year]'>  
          <tr><td>Move to</td> <td><select name='tourcode'><option value='' >- Select -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msproduct 
                            WHERE SeatSisa >= '$totalpax'
                            and Status = 'PUBLISH'
                            and StatusProduct = 'OPEN'
                            and DateTravelFrom >= '$hariini'
                            and TourCode <> '$r[TourCode]'                                         
                            ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC");
            while($s=mysql_fetch_array($tampil)){ 
                    echo "<option value='$s[IDProduct]'>$s[TourCode]</option>";
           }
    echo "</select></td></tr>
          <tr><td colspan=2><center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick=location.href='?module=opbookingdetail'></td></tr>
          </table> 
          </form>";
          $no=1;     
        echo "<br><br>";
     break;         
}
?>
