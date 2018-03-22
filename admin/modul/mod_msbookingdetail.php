<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>         
<script type="text/javascript" src="../head/editable-select.js"></script> 
<script language="JavaScript"  type="text/javascript">   
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
function diprint(ID) {alert('Refresh page?')
        window.location.href = '?module=msbookingdetail&act=printvoucher&no=' + ID  ;
}
function Batal(ID) {
var alasan=prompt("Reason for Cancel Pax:" );
    if (alasan!=null && alasan!="")
{
 window.location.href = '?module=msbookingdetail&act=cancelpax&id=' + ID + '&reason=' + alasan ;   
} 
}
function Batals(ID) {
var alasan=prompt("Reason for Cancel Pax:" );
    if (alasan!=null && alasan!="")
{
 window.location.href = '?module=msbookingdetail&act=cancelpaxs&id=' + ID + '&reason=' + alasan ;   
} 
}
function hapusd(DP,ID) {
    var alasan=prompt("Reason for Cancel Booking ID: " + ID );
    if (alasan!=null && alasan!="")
{                                                                                     
 window.location.href = '?module=msbookingdetail&act=cancelbook&code=' + ID + '&dp=' + DP + '&reason=' + alasan ;      
} 
}
function hapusi(IN,ID) {
var alasan=prompt("Reason for Cancel Inquiry: " + ID );
    if (alasan!=null && alasan!="")
{
 window.location.href = '?module=msbookingdetail&act=cancelinq&code=' + ID + '&inq=' + IN + '&reason=' + alasan ; ;      
} 
}
function hello(string) {
   var name=string
   document.getElementById('myseat').value=name;
}
function refpage(ID) {   window.location.href ='?module=msbooking&act=deviasi&id='+ID
}
function isNumber(field) {
var re = /^[0-9'.']*$/;
if (!re.test(field.value)) {
alert('PLEASE INPUT NUMBER!');
field.value = field.value.replace(/[^0-9'.']/g,"");
}
}
function jumlahin() {
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
  reason += validateEmail(theForm.bookersemail);
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
function showPrice(angka,banyak) {
  var tipe = example.grouptype;
  var a = eval("example.room" + angka)
  var dis = eval("example.disc" + angka + ".value;")
  var adddis = eval("example.adddisc" + angka + ".value;")
  var p = eval("example.package" + angka)
  var gen = eval("example.gen" + angka)
  var tat = eval(example.tourat);var lat = eval(example.laat);
  var tct = eval(example.tourct);var lct = eval(example.lact);
  var tcx = eval(example.tourcx);var lcx = eval(example.lacx);
  var tcn = eval(example.tourcn);var lcn = eval(example.lacn);
  var tin = eval(example.tourin);var lin = eval(example.lain);
  var ca12 = eval(example.cruisea12);var ca34 = eval(example.cruisea34);
  var cc12 = eval(example.cruisec12);var cc34 = eval(example.cruisec34);
  var cla12 = eval(example.cruisela12);var cla34 = eval(example.cruisela34);
  var clc12 = eval(example.cruiselc12);var clc34 = eval(example.cruiselc34);
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
        t.value = eval(eval(tat.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='ADULT' && a.value=='Double'){
        b.value = eval(tat.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(tat.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='ADULT' && a.value=='Single'){
        b.value = eval(tat.value).toFixed(2);
        d.value = eval(single.value).toFixed(2);
        t.value = eval(eval(tat.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='ADULT' && a.value=='Triple'){
        b.value = eval(tat.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(tat.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='ADULT' && a.value=='12 Pax'){
        b.value = eval(ca12.value).toFixed(2);   
        t.value = eval(eval(b.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='ADULT' && a.value=='34 Pax'){
        b.value = eval(ca34.value).toFixed(2);   
        t.value = eval(eval(b.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='ADULT' && a.value=='1 Pax'){
        b.value = eval(ca12.value).toFixed(2);
        d.value = eval(single.value).toFixed(2);
        t.value = eval(eval(b.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='Twin'){
        b.value = eval(tct.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(tct.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='Double'){
        b.value = eval(tct.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(tct.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='Xtra Bed'){
        b.value = eval(tcx.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(tcx.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='No Bed'){
        b.value = eval(tcn.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(tcn.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='Single'){
        b.value = eval(tct.value).toFixed(2);
        d.value = eval(single.value).toFixed(2);
        t.value = eval(eval(tct.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='Triple'){
        b.value = eval(tct.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(tct.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='12 Pax'){
        b.value = eval(cc12.value).toFixed(2);   
        t.value = eval(eval(b.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='34 Pax'){
        b.value = eval(cc34.value).toFixed(2);   
        t.value = eval(eval(b.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='1 Pax'){
        b.value = eval(cc12.value).toFixed(2);
        d.value = eval(single.value).toFixed(2);
        t.value = eval(eval(b.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='INFANT' ){
        b.value = eval(tin.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(tin.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }
  }else if(p.value=='L.A Only'){
      if(gen.value=='ADULT' && a.value=='Twin'){
        b.value = eval(lat.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(lat.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='ADULT' && a.value=='Double'){
        b.value = eval(lat.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(lat.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='ADULT' && a.value=='Single'){
        b.value = eval(lat.value).toFixed(2);
        d.value = eval(single.value).toFixed(2);
        t.value = eval(eval(lat.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='ADULT' && a.value=='Triple'){
        b.value = eval(lat.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(lat.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='ADULT' && a.value=='12 Pax'){
        b.value = eval(cla12.value).toFixed(2);   
        t.value = eval(eval(b.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='ADULT' && a.value=='34 Pax'){
        b.value = eval(cla34.value).toFixed(2);   
        t.value = eval(eval(b.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='ADULT' && a.value=='1 Pax'){
        b.value = eval(cla12.value).toFixed(2);
        d.value = eval(single.value).toFixed(2);
        t.value = eval(eval(b.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='Twin'){
        b.value = eval(lct.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(lct.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='Double'){
        b.value = eval(lct.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(lct.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='Xtra Bed'){
        b.value = eval(lcx.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(lcx.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='No Bed'){
        b.value = eval(lcn.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(lcn.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='Single'){
        b.value = eval(lct.value).toFixed(2);
        d.value = eval(single.value).toFixed(2);
        t.value = eval(eval(lct.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='Triple'){
        b.value = eval(lct.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(lct.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='12 Pax'){
        b.value = eval(clc12.value).toFixed(2);   
        t.value = eval(eval(b.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='34 Pax'){
        b.value = eval(clc34.value).toFixed(2);   
        t.value = eval(eval(b.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='CHILD' && a.value=='1 Pax'){
        b.value = eval(clc12.value).toFixed(2);
        d.value = eval(single.value).toFixed(2);
        t.value = eval(eval(b.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }else if(gen.value=='INFANT' ){
        b.value = eval(lin.value).toFixed(2);
        d.value = eval('0').toFixed(2);
        t.value = eval(eval(lin.value) + eval(d.value) - eval(dis) - eval(adddis)).toFixed(2);
      }
  }
  Totalnya(banyak);  
 }   
function Totalnya(ulang) {
    var xdisc = eval(example.xtradisc);
    var sum = 0;
    var tot = eval("example.jumtotal")
  for (i=1; i<= ulang; i++) {
      var t = eval("example.total" + i)  
       sum += eval(t.value);
  }
  var XD = sum - xdisc.value ;                                                           
  tot.value = accounting.formatMoney(XD); 
  }
function Totalnyas(ulang) {
    var xdisc = eval(examples.xtradisc);
    var sum = 0;
    var tot = eval("examples.jumtotal")
  for (i=1; i<= ulang; i++) {
      var t = eval("examples.total" + i)  
       sum += eval(t.value);
  }
  var XD = sum - xdisc.value ;                                                           
  tot.value = accounting.formatMoney(XD); 
  }
function updatepage(ID) {   window.open(ID);
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
function cekdepositptes() {

    var usr = $("#depositno").val();
    var company = $("#company").val();

    $("#status").html('<img src="./modul/loader.gif" align="absmiddle">&nbsp;Checking deposit...');

    $.ajax({
        type: "POST",
        url: "./modul/checkdepptes.php",
        data: { depositno: usr ,comp: company },
        success: function(msg){

            $("#status").ajaxComplete(function(event, request, settings){
                hasil = msg.split("-");
                var stat = hasil[0];
                var curr = hasil[1];
                var amount = hasil[2];
                if(msg == 'NO')
                {
                    $("#depositno").removeClass('object_ok'); // if necessary
                    $("#depositno").addClass("object_error");
                    $(this).html('<font color="red">PLEASE CREATE NEW DEPOSIT FIRST.</font>');
                    example.depositcurr.value='';
                    example.depositamount.value='';
                }
                else if(stat == 'DP')
                {
                    $("#depositno").removeClass('object_ok'); // if necessary
                    $("#depositno").addClass("object_error");
                    $(this).html('<font color="red">Deposit: <STRONG>'+usr+'</STRONG> is duplicate.</font>');
                    document.example.elements['dobel'].disabled=false;
                    example.depositcurr.value=curr;
                    example.depositamount.value=amount;
                }
                else
                {
                    $("#depositno").removeClass('object_error'); // if necessary
                    $("#depositno").addClass("object_ok");
                    $(this).html('&nbsp;<img src="./modul/tick.gif" align="absmiddle">');
                    document.example.elements['dobel'].disabled=true;
                    example.depositcurr.value=curr;
                    example.depositamount.value=amount;
                }
                                         
            });

        }

    });

}
function gantioption(NO,BANYAK) {
 var gen = eval("example.gen" + NO)       
 var tipe = example.grouptype;
    if(tipe.value =='CRUISE'){                                       
        var select = document.getElementById('room'+NO);
        var content= '<option value="12 Pax">1-2 PAX</option>';
        content+= '<option value="34 Pax">3-4 PAX</option>';
        content+= '<option value="1 Pax">Single</option>';            
        select.innerHTML = content; 
        showPrice(NO,BANYAK)   
    }else{
        if(gen.value =='ADULT'){  
        var select = document.getElementById('room'+NO);
        var content= '<option value="Twin">Twin</option>';
        content+= '<option value="Double">Double</option>';
        content+= '<option value="Single">Single</option>';
        content+= '<option value="Triple">Triple</option>';
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
        content+= '<option value="Triple">Triple</option>';
        select.innerHTML = content; 
        showPrice(NO,BANYAK)
        }
    }
  }
function gantititle(NO,BANYAK) {
 var gen = eval("example.gen" + NO)       
                       
if(gen.value =='ADULT'){  
var select = document.getElementById('title'+NO);
var content= '<option value="MR">MR</option>';
content+= '<option value="MRS">MRS</option>';
content+= '<option value="MS">MS</option>';
select.innerHTML = content; 
}   
if(gen.value =='CHILD'){
var select = document.getElementById('title'+NO);
var content= '<option value="MISS">MISS</option>';
content+= '<option value="MSTR">MSTR</option>';
select.innerHTML = content;   
} 
   
  }
</SCRIPT>
<?php 
$username=$_SESSION[employee_code];
/*$sqluser=mssql_query("SELECT DivisiNO,Employee.DivisiID,EmployeeID,Category,EmployeeName,CompanyGroup,LTMAuthority,ClientNo FROM [HRM].[dbo].[Employee]
                  inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                  WHERE EmployeeID = '$username'");
$tampiluser=mssql_fetch_array($sqluser);*/
$EmpName="$_SESSION[employee_name] ($_SESSION[employee_code])";
$EmpOff=$_SESSION[employee_office];
$offgroup=$_SESSION[company_group];
$companyid = $_SESSION['company_id'];
$clientnumber = explode("-", $_SESSION[client_no]);
$clientno = $clientnumber[0];
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
$hariini = date("Y-m-d ");
include "../config/koneksisql.php";
$divq=mssql_query("SELECT * FROM ClientsDetails
                  WHERE ClientID = '$clientno'");
$divclient=mssql_fetch_array($divq);
mysql_close($linkptes);
include "../config/koneksimaster.php";
switch($_GET[act]) {
    // Tampil Office
    default:
        $nama = $_GET['nama'];
        $nama2 = $_GET['nama2'];
        $cate = $_GET['cate'];
        $cate2 = $_GET['cate2'];
        $qnama = str_replace(" ", "%", $nama);
        $qnama2 = str_replace(" ", "%", $nama2);
        //if($cate==''){$cate='tour_msbooking.TourCode';}
        echo "<h2>Booking Detail</h2>
          <form method=get action='media.php?'>
          <select name='cate'><option value=''";
        if ($cate == '') {
            echo "selected";
        }
        echo ">- please select -</option>
                                  <option value='tour_msbooking.TourCode'";
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
              </select> <input type=text name=nama value='$nama' size=20><br>
              <select name='cate2'><option value=''";
        if ($cate2 == '') {
            echo "selected";
        }
        echo ">- please select -</option>
                                  <option value='tour_msbooking.TourCode'";
        if ($cate2 == 'tour_msbooking.TourCode') {
            echo "selected";
        }
        echo ">Tour Code</option>
                                  <option value='tour_msbooking.TCName'";
        if ($cate2 == 'tour_msbooking.TCName') {
            echo "selected";
        }
        echo ">TC Name</option>
                                  <option value='tour_msbooking.BookingID'";
        if ($cate2 == 'tour_msbooking.BookingID') {
            echo "selected";
        }
        echo ">Booking ID</option>
                                  <option value='tour_msproduct.DateTravelFrom'";
        if ($cate2 == 'tour_msproduct.DateTravelFrom') {
            echo "selected";
        }
        echo ">Dept Date</option>
                                  <option value='tour_msproduct.Season'";
        if ($cate2 == 'tour_msproduct.Season') {
            echo "selected";
        }
        echo ">Season</option>
                                  <option value='tour_msbooking.BookersName'";
        if ($cate2 == 'tour_msbooking.BookersName') {
            echo "selected";
        }
        echo ">Bookers Name</option>
              </select> <input type=text name='nama2' value='$nama2' size=20>       <input type=hidden name=module value='msbookingdetail'>
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
        /*$filt=mssql_query("SELECT DivisiNO,Employee.DivisiID,EmployeeID,Category,EmployeeName,CompanyGroup,LTMAuthority,JobTitle FROM [HRM].[dbo].[Employee]
                  inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                  WHERE EmployeeID = '$_SESSION[employee_code]'");
        $filter = mssql_fetch_array($filt);*/
        $team = $_SESSION[employee_office];
        $ltm_authority = $_SESSION[ltm_authority];
        $thisyear = date("Y");

        if ($cate == '' and $cate2 == '') {
            if ($_SESSION[ltm_authority]=='DEVELOPER') {
                $tampil = mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.BookingDate,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,tour_msbooking.TCCompany,
                                    tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,tour_msbooking.TCNameAlias,
                                    tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.StatusPrice,tour_msbooking.DUMMY FROM tour_msbooking
                                    left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                    WHERE tour_msbooking.Status ='ACTIVE'
                                    and tour_msproduct.Status <> 'VOID'
                                    and tour_msproduct.DateTravelFrom >= '$hariini'
                                    ORDER BY tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            }else if (($_SESSION[ltm_authority]=='PO' or $_SESSION[ltm_authority]=='PO MANAGER' or $_SESSION[ltm_authority]=='ADMINISTRATOR')AND $companyid==1) {
                $tampil = mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.BookingDate,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,tour_msbooking.TCCompany,
                                    tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,tour_msbooking.TCNameAlias,
                                    tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.StatusPrice,tour_msbooking.DUMMY FROM tour_msbooking
                                    left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                    WHERE tour_msbooking.Status ='ACTIVE'
                                    and tour_msproduct.Status <> 'VOID'
                                    and tour_msproduct.DateTravelFrom >= '$hariini'
                                    AND tour_msproduct.CompanyID = '$companyid'
                                    ORDER BY tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            } else {
                $tampil = mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.BookingDate,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,tour_msbooking.TCCompany,
                                    tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,tour_msbooking.TCNameAlias,
                                    tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.StatusPrice,tour_msbooking.DUMMY FROM tour_msbooking
                                    left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                    WHERE TCDivision = '$team'
                                    AND tour_msbooking.Status ='ACTIVE'
                                    and tour_msproduct.Status <> 'VOID'
                                    and tour_msproduct.DateTravelFrom >= '$hariini'
                                    ORDER BY tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            }
            $jumlah = mysql_num_rows($tampil);
        } else if ($cate == '' and $cate2 <> '') {
            if ($_SESSION[ltm_authority]=='DEVELOPER') {
                $tampil = mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.BookingDate,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,tour_msbooking.TCCompany,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,tour_msbooking.TCNameAlias,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.StatusPrice,tour_msbooking.DUMMY FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate2 LIKE '%$qnama2%'
                                AND tour_msbooking.Status ='ACTIVE'
                                and tour_msproduct.Status <> 'VOID'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
                                ORDER BY tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            }else if (($_SESSION[ltm_authority]=='PO' or $_SESSION[ltm_authority]=='PO MANAGER' or $_SESSION[ltm_authority]=='ADMINISTRATOR')AND $companyid==1) {
                $tampil = mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.BookingDate,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,tour_msbooking.TCCompany,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,tour_msbooking.TCNameAlias,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.StatusPrice,tour_msbooking.DUMMY FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate2 LIKE '%$qnama2%'
                                AND tour_msbooking.Status ='ACTIVE'
                                and tour_msproduct.Status <> 'VOID'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
                                AND tour_msproduct.CompanyID = '$companyid'
                                ORDER BY tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            } else {
                $tampil = mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.BookingDate,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,tour_msbooking.TCCompany,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,tour_msbooking.TCNameAlias,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.StatusPrice,tour_msbooking.DUMMY FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate2 LIKE '%$qnama2%'
                                AND TCDivision = '$team'
                                AND tour_msbooking.Status ='ACTIVE'
                                and tour_msproduct.Status <> 'VOID'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
                                ORDER BY tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            }
            $jumlah = mysql_num_rows($tampil);
        } else if ($cate2 == '' and $cate <> '') {
            if ($_SESSION[ltm_authority]=='DEVELOPER') {
                $tampil = mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.BookingDate,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,tour_msbooking.TCCompany,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,tour_msbooking.TCNameAlias,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.StatusPrice,tour_msbooking.DUMMY FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate LIKE '%$qnama%'
                                AND tour_msbooking.Status ='ACTIVE'
                                and tour_msproduct.Status <> 'VOID'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
                                ORDER BY tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            }else if (($_SESSION[ltm_authority]=='PO' or $_SESSION[ltm_authority]=='PO MANAGER' or $_SESSION[ltm_authority]=='ADMINISTRATOR')AND $companyid==1) {
                $tampil = mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.BookingDate,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,tour_msbooking.TCCompany,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,tour_msbooking.TCNameAlias,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.StatusPrice,tour_msbooking.DUMMY FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate LIKE '%$qnama%'
                                AND tour_msbooking.Status ='ACTIVE'
                                and tour_msproduct.Status <> 'VOID'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
                                AND tour_msproduct.CompanyID = '$companyid'
                                ORDER BY tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            } else {
                $tampil = mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.BookingDate,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,tour_msbooking.TCCompany,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,tour_msbooking.TCNameAlias,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.StatusPrice,tour_msbooking.DUMMY FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate LIKE '%$qnama%'
                                AND TCDivision = '$team'
                                AND tour_msbooking.Status ='ACTIVE'
                                and tour_msproduct.Status <> 'VOID'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
                                ORDER BY tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            }
            $jumlah = mysql_num_rows($tampil);
        } else if ($cate <> '' and $cate2 <> '') {
            if ($_SESSION[ltm_authority]=='DEVELOPER') {
                $tampil = mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.BookingDate,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,tour_msbooking.TCCompany,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,tour_msbooking.TCNameAlias,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.StatusPrice,tour_msbooking.DUMMY FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate LIKE '%$qnama%'
                                AND $cate2 LIKE '%$qnama2%'
                                AND tour_msbooking.Status ='ACTIVE'
                                and tour_msproduct.Status <> 'VOID'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
                                ORDER BY tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            }else if (($_SESSION[ltm_authority]=='PO' or $_SESSION[ltm_authority]=='PO MANAGER' or $_SESSION[ltm_authority]=='ADMINISTRATOR')AND $companyid==1) {
                $tampil = mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.BookingDate,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,tour_msbooking.TCCompany,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,tour_msbooking.TCNameAlias,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.StatusPrice,tour_msbooking.DUMMY FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate LIKE '%$qnama%'
                                AND $cate2 LIKE '%$qnama2%'
                                AND tour_msbooking.Status ='ACTIVE'
                                and tour_msproduct.Status <> 'VOID'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
                                AND tour_msproduct.CompanyID = '$companyid'
                                ORDER BY tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            } else {
                $tampil = mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.BookingDate,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,tour_msbooking.TCCompany,
                                tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,tour_msbooking.TCNameAlias,
                                tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo,tour_msbooking.StatusPrice,tour_msbooking.DUMMY FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                WHERE $cate LIKE '%$qnama%'
                                AND $cate2 LIKE '%$qnama2%'
                                AND TCDivision = '$team'
                                AND tour_msbooking.Status ='ACTIVE'
                                and tour_msproduct.Status <> 'VOID'
                                and tour_msproduct.DateTravelFrom >= '$hariini'
                                ORDER BY tour_msbooking.BookingID DESC LIMIT $posisi,$batas");
            }
            $jumlah = mysql_num_rows($tampil);
        } else {
            $jumlah = 0;
        }

        if ($jumlah > 0) {
            echo "   <table class='bordered'>
                    <tr><th colspan=9></th><th colspan=3>total pax</th><th colspan=2>amount</th><th></th></tr>
                    <tr><th>no</th><th>Booking ID</th><th>Date</th><th width='200'>tour code</th><th>Dept</th><th>Bookers</th><th>tc name</th><th>divisi</th><th>cash receipt</th><th>adult</th><th>child</th><th>infant</th><th>tour</th><th>deviasi</th><th width='120'>action</th></tr>";
            $no = $posisi + 1;
            while ($data = mysql_fetch_array($tampil)) {
                if(strlen($data[TBFNo])==15) {
                    $notbf = substr($data[TBFNo], 0, 13);
                }elseif (strlen($data[TBFNo])==16) {
                    $notbf = substr($data[TBFNo], 0, 14);
                }
                $cari1 = mysql_query("SELECT * FROM tour_tbfbooking WHERE TBFNo = '$notbf'");
                $ulang = mysql_fetch_array($cari1);
                $carifbt = mysql_query("SELECT * FROM tour_fbtbooking WHERE BookingID = '$data[BookingID]' order by IDFbt DESC limit 1");
                $datafbt = mysql_fetch_array($carifbt);
                $edith = mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$data[BookingID]' and PaxName <> '' ORDER BY IDDetail ASC");
                $r = mysql_fetch_array($edith);
                $sqlharga = mysql_query("SELECT sum(`SubTotal`)as ST,sum(`DevAmount`)as DA FROM `tour_msbookingdetail` WHERE `BookingID`= '$data[BookingID]' ORDER BY IDDetail ASC");
                $am = mysql_fetch_array($sqlharga);
                $qflight = mysql_query("SELECT * FROM tour_msprodflight WHERE IDProduct = '$data[IDProduct]'");
                $rowflight = mysql_num_rows($qflight);
                if ($r[PaxName] == '' or $rowflight == '0') {
                    $dev = 'disabled';
                } else {
                    $dev = 'enabled';
                }

                $carivoucher = mysql_query("SELECT * FROM tour_voucherpromo WHERE BookingID = '$data[BookingID]' and VoucherStatus='REDEEM' ");
                $adavoucher = mysql_num_rows($carivoucher);
                $QTotalSales = mysql_query("SELECT sum((Subtotal+SeaTaxSell)+if((Package<>'L.A only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell),0)) as Harga FROM tour_msbookingdetail
                                            inner join  tour_msproduct on tour_msproduct.IDProduct=tour_msbookingdetail.IDTourcode where BookingId='$data[BookingID]' ");
                $DTotalSales = mysql_fetch_array($QTotalSales);
                $TotalSales = $DTotalSales[Harga];
                if ($data[StatusPrice] <> '') {
                    $statlok = "<br><img src='../images/lockprice.png' title='LOCK PRICE'>";
                } else {
                    $statlok = "";
                }

                echo "<tr><td>$no</td>
                     <td>";
                if ($data[StatusProduct] == 'FINALIZE') {
                    echo "<a href=\"javascript:PopupCenter('option.php?code=$data[BookingID]&user=$username','variable',300,250)\">$data[BookingID]</a>";//echo"$data[BookingID]";
                } else {
                    if ($data[DepositNo] == '' or $data[DepositAmount] == '') {
                        echo "$data[BookingID]";
                    } else {
                        echo "<a href=\"javascript:PopupCenter('option.php?code=$data[BookingID]&user=$username','variable',300,250)\">$data[BookingID]</a>";
                    }
                }
                $edit1 = mysql_query("SELECT count(IDDetail)as bnyk FROM tour_msbookingdetail WHERE BookingID ='$data[BookingID]' and Gender <> 'INFANT' and Status <> 'CANCEL' ");
                $r2 = mysql_fetch_array($edit1);
                if ($data[DepositNo] == '') {
                    $totalinq = $data[AdultPax] + $data[ChildPax];
                } else {
                    $totalinq = $r2[bnyk];
                }
                if ($data[FBTNo] <> '' or ($data[TBFNo] <> '' AND $ulang[Status] <> 'REVISE')) {
                    $bisa = "disabled";
                } else {
                    $bisa = "enabled";
                }
                if ($data[TBFNo] == '') {
                    $bisa1 = "enabled";
                } else {
                    $bisa1 = "disabled"; 
                }
                if ($data[TBFNo] == '' or $ulang[Status] == 'REVISE') {
                    if ($data[StatusPrice] == '') {
                        //if($data[FBTNo]=='' AND $data[TBFNo]==''){
                        if ($data[FBTNo] == '' OR $datafbt[Status] == 'VOID') {
                            $lin = "?module=msbookingdetail&act=editdetail&code=$data[BookingID]";
                            $det = "Edit Detail";
                            if($divclient[PaymentType]=='TOPUP' AND $data[ProductType] <> 'TUR EZ') {
                                $ap = "<a href='?module=msbooking&act=addpaxtopup&id=$data[BookingID]'><img src='../images/addpax1.png' title='Add Pax'></a> ";
                            }else{
                                $ap = "<a href='?module=msbooking&act=addpax&id=$data[BookingID]'><img src='../images/addpax1.png' title='Add Pax'></a> ";
                            }
                        } else {//if($data[TBFNo]=='')
                            $lin = "?module=msbookingdetail&act=editdetails&code=$data[BookingID]";
                            $det = "Edit Detail";
                            $ap = "<img src='../images/addpax2.png' title='Add Pax Not Allowed'> ";
                        }
                    } else {
                        $lin = "?module=msbookingdetail&act=editdetails&code=$data[BookingID]";
                        $det = "Edit Detail";
                        if($divclient[PaymentType]=='TOPUP'  AND $data[ProductType] <> 'TUR EZ') {
                            $ap = "<a href='?module=msbooking&act=addpaxtopup&id=$data[BookingID]'><img src='../images/addpax1.png' title='Add Pax'></a> ";
                        }else{
                            $ap = "<a href='?module=msbooking&act=addpax&id=$data[BookingID]'><img src='../images/addpax1.png' title='Add Pax'></a> ";
                        }
                    }
                } else {
                    $lin = "?module=msbookingdetail&act=showdetail&code=$data[BookingID]";
                    $det = "Show Detail";
                    $ap = "<img src='../images/addpax2.png' title='Add Pax Not Allowed'> ";
                }
                echo "<br>";
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
                if($data[DUMMY]=='YES') {
                    $tcname = $data[TCNameAlias];
                    if ($data[TCCompany] == 'PANORAMA TOURS') {
                        $tcdiv = 'THO';
                    } else {
                        $tcdiv = 'TEZ';
                    }
                }
                else{$tcname=$data[TCName];$tcdiv=$data[TCDivision];
                }
                echo"</td></td>
					 <td>" . date('d M y', strtotime($data[BookingDate])) . "</td>
                     <td>$data[TourCode]</td>
                     <td>" . date('d M y', strtotime($data[DateTravelFrom])) . "</td>
                     <td>$data[BookersName]</td>
                     <td><center>";
                     if($data[DUMMY]=='NO' AND $_SESSION[ltm_authority]=='DEVELOPER') {
                         echo "<a href=\"javascript:PopupCenter('transfer.php?code=$data[BookingID]&tc=$tcname&div=$tcdiv&usr=$username', 'variable', 300, 250)\">$tcname</a>";
                     }else{
                         echo "$tcname";
                     }
                echo"</td>
                     <td><center>$tcdiv</td>
                     <td><center>";
                     if($data[DUMMY]=='YES'){
                         $dpn = substr($data[BookingID],2,2);
                         $blkg = substr($data[BookingID],-7);
                         echo"$data[DepositNo]$dpn-$blkg";
                     }else{
                         echo"$data[DepositNo]";
                     }
                echo"</td>
                     <td><center>$data[AdultPax]</td>
                     <td><center>$data[ChildPax]</td>
                     <td><center>$data[InfantPax]</td>
                     <td><center>" . number_format($TotalSales, 0, '.', ',');
                echo "$statlok</td>
                     <td><center>" . number_format($am[DA], 0, '.', ',');
                echo "</td>
                     <td><center>";
                if ($data[StatusProduct] == 'FINALIZE') {
                    echo "<b>FINALIZE</b> ";
                } else {
                    if ($data[DepositNo] == '') {
                        //echo"<a href='?module=msbookingdetail&act=editbooking&id=$data[BookingID]'><img src='../images/editbooking.png' title='Edit Booking'></a> ";
                        echo "<a href='?module=msbookingdetail&act=editdetail&code=$data[BookingID]'><img src='../images/editbooking.png' title='Edit Detail'></a> ";
                        if ($bisa == 'enabled') {
                            echo "<img src='../images/cancel2.png' title='Cancel Not Allowed'>";
                            //echo "<a href=\"javascript:hapusd('$totalinq','$data[BookingID]')\"><img src='../images/cancel1.png' title='Cancel'></a> ";
                        } else {
                            echo "<img src='../images/cancel2.png' title='Cancel Not Allowed'> ";
                        }
                        echo "<img src='../images/deviasi2.png' title='Deviasi Not Allowed'> ";
                        echo "<img src='../images/addpax2.png' title='Add Pax Not Allowed'>";
                    } else {
                        if ($det == 'Show Detail') {
                            echo "<a href='?module=msbookingdetail&act=showdetail&code=$data[BookingID]'><img src='../images/showdetail.png' title='Show Detail'></a> ";
                        } else {
                            echo "<a href='$lin'><img src='../images/editdetail.png' title='Edit Detail'></a> ";
                        }
                        if ($bisa == 'enabled') {
                            if ($adavoucher > 0 or $data[ProductType] == 'TUR EZ') {
                                echo "<img src='../images/cancel2.png' title='Cancel Not Allowed'> ";
                            } else {
                                if ($_SESSION[ltm_uthority] <> 'OTHERS' or ($data[DepositNo] == '')) {
                                    echo "<img src='../images/cancel2.png' title='Cancel Not Allowed'>";
                                    //echo "<a href=\"javascript:hapusd('$totalinq','$data[BookingID]')\"><img src='../images/cancel1.png' title='Cancel'></a> ";
                                } else {
                                    echo "<img src='../images/cancel2.png' title='Cancel Not Allowed'>";
                                }
                            }
                            echo "<a href=\"javascript:refpage('$data[BookingID]')\"><img src='../images/deviasi1.png' title='Deviasi'></a> ";
                        } else {
                            echo "<img src='../images/cancel2.png' title='Cancel Not Allowed'> ";
                            echo "<img src='../images/deviasi2.png' title='Deviasi Not Allowed'> ";
                        }
                        if($divclient[PaymentType]=='TOPUP' AND $data[ProductType] <> 'TUR EZ'){
                            echo "$ap";
                            // echo "<img src='../images/addpax2.png' title='CONTACT PO team for Add Pax'>";
                        }else{
                            echo "$ap";
                        }
                    }
                }
                echo "
                     </td></tr>";
                $no++;
            }
            echo "</table>";

            // Langkah 3
            if ($cate == '' and $cate2 == '') {
                if ($_SESSION[ltm_authority]=='DEVELOPER') {
                    $tampil2 = "SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE tour_msbooking.Status ='ACTIVE'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
                                        ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC ";
                }else if (($_SESSION[ltm_authority]=='PO' or $_SESSION[ltm_authority]=='PO MANAGER' or $_SESSION[ltm_authority]=='ADMINISTRATOR')AND $companyid==1) {
                    $tampil2 = "SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE tour_msbooking.Status ='ACTIVE'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
                                        AND tour_msproduct.CompanyID = '$companyid'
                                        ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC ";
                } else {
                    $tampil2 = "SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                    tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.DepositAmount,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                    tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msproduct.ProductType,tour_msbooking.FBTNo,tour_msbooking.TBFNo FROM tour_msbooking
                                    left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                    WHERE TCDivision = '$team'
                                    AND tour_msbooking.Status ='ACTIVE'
                                    and tour_msproduct.Status <> 'VOID'
                                    and tour_msproduct.DateTravelFrom >= '$hariini'
                                    ORDER BY tour_msbooking.BookingID DESC ";
                }
            } else if ($cate == '' and $cate2 <> '') {
                if ($_SESSION[ltm_authority]=='DEVELOPER') {
                    $tampil2 = "SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE $cate2 LIKE '%$qnama2%'
                                        AND tour_msbooking.Status ='ACTIVE'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
                                        ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC ";
                }else if (($_SESSION[ltm_authority]=='PO' or $_SESSION[ltm_authority]=='PO MANAGER' or $_SESSION[ltm_authority]=='ADMINISTRATOR')AND $companyid==1) {
                    $tampil2 = "SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE $cate2 LIKE '%$qnama2%'
                                        AND tour_msbooking.Status ='ACTIVE'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
                                        AND tour_msproduct.CompanyID = '$companyid'
                                        ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC ";
                } else {
                    $tampil2 = "SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE $cate2 LIKE '%$qnama2%'
                                        AND TCDivision = '$team'
                                        AND tour_msbooking.Status ='ACTIVE'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
                                        ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC ";
                }
            } else if ($cate2 == '' and $cate <> '') {
                if ($_SESSION[ltm_authority]=='DEVELOPER') {
                    $tampil2 = "SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE $cate LIKE '%$qnama%'
                                        AND tour_msbooking.Status ='ACTIVE'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
                                        ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC ";
                }else if (($_SESSION[ltm_authority]=='PO' or $_SESSION[ltm_authority]=='PO MANAGER' or $_SESSION[ltm_authority]=='ADMINISTRATOR')AND $companyid==1) {
                    $tampil2 = "SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE $cate LIKE '%$qnama%'
                                        AND tour_msbooking.Status ='ACTIVE'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
                                        AND tour_msproduct.CompanyID = '$companyid'
                                        ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC ";
                } else {
                    $tampil2 = "SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE $cate LIKE '%$qnama%'
                                        AND TCDivision = '$team'
                                        AND tour_msbooking.Status ='ACTIVE'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
                                        ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC";
                }
            } else if ($cate <> '' and $cate2 <> '') {
                if ($_SESSION[ltm_authority]=='DEVELOPER') {
                    $tampil2 = "SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE $cate LIKE '%$qnama%'
                                        AND $cate2 LIKE '%$qnama2%'
                                        AND tour_msbooking.Status ='ACTIVE'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
                                        ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC ";
                }else if (($_SESSION[ltm_authority]=='PO' or $_SESSION[ltm_authority]=='PO MANAGER' or $_SESSION[ltm_authority]=='ADMINISTRATOR')AND $companyid==1) {
                    $tampil2 = "SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE $cate LIKE '%$qnama%'
                                        AND $cate2 LIKE '%$qnama2%'
                                        AND tour_msbooking.Status ='ACTIVE'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
                                        AND tour_msproduct.CompanyID = '$companyid'
                                        ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC ";
                } else {
                    $tampil2 = "SELECT tour_msbooking.BookingID,tour_msbooking.TourCode,tour_msproduct.DateTravelFrom,tour_msbooking.BookersName,tour_msbooking.TCName,
                                        tour_msbooking.TCDivision,tour_msbooking.DepositNo,tour_msbooking.AdultPax,tour_msbooking.ChildPax,tour_msbooking.InfantPax,
                                        tour_msbooking.Status,tour_msproduct.StatusProduct,tour_msbooking.FBTNo FROM tour_msbooking
                                        left join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
                                        WHERE $cate LIKE '%$qnama%'
                                        AND $cate2 LIKE '%$qnama2%'
                                        AND TCDivision = '$team'
                                        AND tour_msbooking.Status ='ACTIVE'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
                                        ORDER BY tour_msproduct.DateTravelFrom DESC,tour_msbooking.BookingID DESC ";
                }
            }
            $hasil2 = mysql_query($tampil2);
            $jmldata = mysql_num_rows($hasil2);
            $jmlhalaman = ceil($jmldata / $batas);
            $file = "media.php?module=msbookingdetail";
            $namas = str_replace(" ", "+", $nama);
            $namas2 = str_replace(" ", "+", $nama2);
            // Link ke halaman sebelumnya (previous)
            echo "<center><div id='paging'>";
            if ($halaman > 1) {
                $previous = $halaman - 1;
                echo "<a href=$file&halaman=1&nama=$namas&cate=$cate&nama2=$namas2&cate2=$cate2&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&nama=$namas&cate=$cate&nama2=$namas2&cate2=$cate2&oke=$oke> < Previous</a> | ";
            } else {
                echo "<< First | < Previous | ";
            }
            // Tampilkan link halaman 1,2,3 ... modifikasi ala google
            // Angka awal
            $angka = ($halaman > 3 ? " ... " : " "); //Ternary Operator
            for ($i = $halaman - 2; $i < $halaman; $i++) {
                if ($i < 1)
                    continue;
                $angka .= "<a href=$file&halaman=$i&nama=$namas&cate=$cate&nama2=$namas2&cate2=$cate2&oke=$oke>$i</a> ";
            }
            // Angka tengah
            $angka .= " <b>$halaman</b> ";
            for ($i = $halaman + 1; $i < ($halaman + 3); $i++) {
                if ($i > $jmlhalaman)
                    break;
                $angka .= "<a href=$file&halaman=$i&nama=$namas&cate=$cate&nama2=$namas2&cate2=$cate2&oke=$oke>$i</a> ";
            }
            // Angka akhir
            $angka .= ($halaman + 2 < $jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&nama=$namas&cate=$cate&nama2=$namas2&cate2=$cate2&oke=$oke>$jmlhalaman</a> |" : " ");
            // Cetak angka seluruhnya (awal, tengah, akhir)
            echo "$angka";
            // Link ke halaman berikutnya (Next)
            if ($halaman < $jmlhalaman) {
                $next = $halaman + 1;
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
        $cari = mssql_query("SELECT DivisiNO,Employee.DivisiID,EmployeeID,Category,EmployeeName,CompanyGroup,LTMAuthority,JobTitle FROM [HRM].[dbo].[Employee]
                  inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                  WHERE EmployeeID = '$_SESSION[employee_code]'");
        $staff = mssql_fetch_array($cari);
        if ($_SESSION[employee_office] == 'TUREZ') {
            $company = 2;
        } else {
            $company = 1;
        }
        $edit = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[id]'");
        $r = mysql_fetch_array($edit);
        $cariid = mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$r[IDTourcode]' and Status <> 'VOID'");
        $hasilnya = mysql_fetch_array($cariid);
        $thisyear = date("Y");
        $nextyear = $thisyear + 1;

        $datenow = date("d", time());
        $monthnow = date("m", time());
        $today = $thisyear . "-" . $monthnow . "-" . $datenow;
        if ($r[DepositDate] == '0000-00-00') {
            $depdate = '$today';
        } else {
            $depdate = $r[DepositDate];
        }
        if ($r[DepositAmount] == '0.00') {
            $depamount = '';
        } else {
            $depamount = $r[DepositAmount];
        }
        if($r[BookingPlace]==''){$location='';}else{$location='(EXHIBITION)';}
        echo "<h2>Booking ID : $_GET[id] $location</h2>
          <table style='border: 0px solid #000000;'>
          <tr><td style='border: 0px solid #000000;'>
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msbookingdetail&act=input' >
          <input type=hidden name='id' value='$_GET[id]'><input type='hidden' name='company' id='company' value='$company'>
          <table class='bordered'>
          <tr><td>Tour Code</td> <td>$r[TourCode]</td></tr>
          <tr><td>Bookers Name</td> <td><input type=text name='bookersname' value='$r[BookersName]'></td></tr>
          <tr><td>Telephone</td> <td><input type=text name='bookerstelp' value='$r[BookersTelp]'></td></tr>
          <tr><td>Mobile</td> <td><input type=text name='bookersmobile' value='$r[BookersMobile]'></td></tr>
          <tr><td>Address</td><td><textarea name='bookersaddress' cols='50' rows='3'>$r[BookersAddress]</textarea></td></tr>
          <tr><td>Email</td> <td><input type=text name='bookersemail' value='$r[BookersEmail]'></td></tr>
          <tr><td>Emergency Call</td> <td><textarea name='emergencycall' cols='50' rows='3'>$r[EmergencyCall]</textarea></td></tr>
          <tr><td>TC Name</td> <td>$r[TCName] - Division: $r[TCDivision]
          <input type=hidden name='tcname' value='$staff[EmployeeName]'><input type=hidden name='tcdivision' value='$_SESSION[employee_office]'></td></tr>
          <tr><td>Total Pax</td> <td>Adult <input type=text name='adultpax' size=3 onkeyup='jumlahin(),isNumber(this)' value='$r[AdultPax]' readonly>&nbsp
                                     Child <input type=text name='childpax' size=3 onkeyup='jumlahin(),isNumber(this)' value='$r[ChildPax]' readonly>&nbsp
                                     Infant <input type=text name='infantpax' size=3 onkeyup='isNumber(this)' value='$r[InfantPax]' readonly>
          </td></tr>
          <input type='hidden' name='adultpaxb4' value='$r[AdultPax]'>
          <input type='hidden' name='childpaxb4' value='$r[ChildPax]'>
          <input type='hidden' name='tourcode' value='$r[TourCode]'><input type='hidden' name='idproduct' value='$r[IDTourcode]'>
          <tr><td>Total Room</td> <td><input type=text name='totalroom' size=3 onkeyup='isNumber(this)' value='$r[TotalRoom]'></td></tr>";
        //GROUP
        /*if (($offgroup == 'PANORAMA TOURS' AND preg_match('/LTM/', $team)) OR $offgroup == 'PANORAMA WORLD' OR $offgroup == 'SISTER COMPANY') {
            echo "
          <tr><th colspan=2></th></tr>
          <input type='hidden' value='$today' name='depositdate' size='10' onClick=" . "cal.select(document.forms['example'].depositdate,'ActIn1','yyyy-MM-dd'); return false;" . " NAME='anchor3' ID='ActIn1'>
          <tr><td>Deposit No</td> <td>
          <input type=text name='depositno' id='depositno' onBlur='cekdeposit()'> <input type='checkbox' name='dobel' value='ya' disabled>&nbsp Duplicate <div id='status' style='float:right;'></div><div id='status1' style='float:right;'></div> </td></tr>
          <tr><td>Deposit Amount</td> <td><select name='depositcurr' >";
            $tampil = mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            while ($s = mysql_fetch_array($tampil)) {
                if ($r[DepositCurr] <> '') {
                    if ($s[curr] == $r[DepositCurr]) {
                        echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                        echo "<option value='$s[curr]' >$s[curr]</option>";
                    }
                } else {
                    if ($s[curr] == 'IDR') {
                        echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                        echo "<option value='$s[curr]' >$s[curr]</option>";
                    }
                }
            }
            echo "</select> <input type=text name='depositamount' value='$depamount' onkeyup='isNumber(this)'><input type='hidden' name='jumsit' value='1'><input type='hidden' id='myseat' value='$r[SeatSisa]'></td></tr>
          ";
        } //PANORAMA TOURS   <input type='button' name='button' value='Create Deposit' onclick=PopupCenter('createdeposit.php','fix',800,600) > LTMBookingID
        else {*/
            echo "
          <tr><th colspan=2>

          </th></tr>
          <input type='hidden' value='$today' name='depositdate' size='10' onClick=" . "cal.select(document.forms['example'].depositdate,'ActIn1','yyyy-MM-dd'); return false;" . " NAME='anchor3' ID='ActIn1'>

          <tr><td>Deposit No</td> <td>";
            /*<select name='depositcurr'>";
            $cobams=mssql_query("SELECT [CashReceiptId] FROM [PTES].[dbo].[CashReceipt] ");
          while($cobams1=mssql_fetch_array($cobams)){
          echo"<option value='$cobams1[CashReceiptId]'>$cobams1[CashReceiptId]</option>";
          }
    echo "</select>";*/
            echo " <input type=text name='depositno' id='depositno' placeholder='ex: CSRxx-xxxxxxx' onBlur='cekdepositptes()'> <input type='checkbox' name='dobel' value='ya' disabled>&nbsp Duplicate &nbsp<div id='status' style='float:right;'></div> </td></tr>
          <tr><td>Deposit Amount</td> <td><input type='text' name='depositcurr' id='depositcurr' readonly size='3'>
          <input type=text name='depositamount' id='depositamount' readonly><input type='hidden' name='jumsit' value='1'><input type='hidden' id='myseat' value='$r[SeatSisa]'></td></tr>
          ";
        //}
        echo "
          <tr><td colspan=2><center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick=location.href='?module=msbookingdetail'></td></tr>
          </table> </form>
          </td><td style='border: 0px solid #000000;'></td><td style='border: 0px solid #000000;'><iframe src='info.php?id=$hasilnya[IDProduct]' width='500' height='800' frameborder='0'></iframe></td></tr></table><br><br>";
        break;
    /*<tr><td>Selling Price in <select name='sellingcurr' >
            <option value='IDR' selected>IDR</option>
            <option value='USD'>USD</option>
            <option value='EUR'>EUR</option>
            </select></td><td>ADL TWN &nbsp<input type=text name='sellingadltwn' size='10'></td></tr>
            <tr><td></td><td>CHD TWN &nbsp<input type=text name='sellingchdtwn' size='10'></td></tr>
            <tr><td></td><td>CHD XBED <input type=text name='sellingchdxbed' size='10'></td></tr>
            <tr><td></td><td>CHD NBED <input type=text name='sellingchdnbed' size='10'></td></tr>
            <tr><td></td><td>SINGLE &nbsp&nbsp&nbsp&nbsp <input type=text name='sellingsingle' size='10'></td></tr>
            <tr><td></td><td>TAX &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type=text name='sellingtax' size='10'></td></tr>  */

    case "editdetail":
        $edit = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");
        $r = mysql_fetch_array($edit);
        $awal = mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$r[IDTourcode]' and Status <> 'VOID'");
        $curawal = mysql_fetch_array($awal);
        $thisyear = date("Y");
        $nextyear = $thisyear + 1;
        /*$filt=mssql_query("SELECT DivisiNO,Employee.DivisiID,EmployeeID,Category,EmployeeName,CompanyGroup,LTMAuthority,JobTitle FROM [HRM].[dbo].[Employee]
                  inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                  WHERE EmployeeID = '$_SESSION[employee_code]'");
        $filter = mssql_fetch_array($filt);*/
        $team = $_SESSION[employee_office];
        $DDate = date('d-m-Y', strtotime($r[DepositDate]));
        if ($r[FBTNo] <> '' OR $r[StatusPrice] == 'LOCK') {
            $kurensi = "$r[Curr]";
        } else {
            $kurensi = "$curawal[SellingCurr]";
        }
        if($r[BookingPlace]=='' OR $r[Website]=='TOUR'){$indeposit='enabled'; $location='';}else{$indeposit='disabled'; $location='(EXHIBITION)';}
        echo "<h2>Booking ID : $_GET[code] $location</h2>
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msbookingdetail&act=update' >
          <input type=hidden name='moduls' value='msbookingdetail'><input type=hidden name='idprod' value='$r[IDTourcode]'>
          <table style='border:0px'><td style='border:0px'>
          <table class='bordered'>
          <tr><td>Tour Code</td> <td>$r[TourCode]</td></tr>
          <tr><td>Client</td> <td>$r[ClientType]</td></tr>
          <tr><td>Bookers Name</td> <td>$r[BookersName]</td></tr>
          <tr><td>Telephone</td> <td><input type='text' name='bookerstelp' value='$r[BookersTelp]' onkeyup='isNumber(this)' required></td></tr>
          <tr><td>Mobile</td> <td><input type='text' name='bookersmobile' value='$r[BookersMobile]' onkeyup='isNumber(this)'></td></tr>
          <tr><td>Address</td><td><textarea name='bookersaddress' cols='50' rows='3'>$r[BookersAddress]</textarea></td></tr>
          <tr><td>Emergency Call</td> <td><textarea name='emergencycall' cols='50' rows='3'>$r[EmergencyCall]</textarea></td></tr>
          <tr><td>TC Name</td> <td>$r[TCName] - Division: $r[TCDivision]</td></tr>
          <tr><td>Total Pax</td> <td>Adult : $r[AdultPax]<input type=hidden name='adultpaxb4' value='$r[AdultPax]'> &nbsp
                                     Child : $r[ChildPax]<input type=hidden name='childpaxb4' value='$r[ChildPax]'> &nbsp
                                     Infant : $r[InfantPax]
          </td></tr>
          <tr><td>Total Room</td> <td>$r[TotalRoom] Room <input type='button' name='submit' value='CHANGE' onclick=PopupCenter('room.php?id=$_GET[code]','variable',300,150)></td></tr>
          <tr><th colspan=2></th></tr>
          <tr><td>Deposit Date</td> <td>$DDate</td></tr>
          <tr><td>Deposit No</td> <td>$r[DepositNo]";
        if ($r[InvoiceNo] == '') {
            if ($r[DepositNo] == '') {
                if($divclient[PaymentType]=='TOPUP' AND $curawal[CompanyID] <> 2) {
                    echo "<input type='button' name='submit' value='INPUT DEPOSIT' onclick=PopupCenter('deposit.php?id=$_GET[code]&emp=$r[TCEmpID]','variable',310,200) $indeposit>
                          <input type='button' name='submit' value='CREATE DEPOSIT' onclick=PopupCenter('csrtopup.php?id=$_GET[code]&emp=$r[TCEmpID]','variable',310,200)>";
                }else{
                    echo "<input type='button' name='submit' value='INPUT DEPOSIT' onclick=PopupCenter('deposit.php?id=$_GET[code]&emp=$r[TCEmpID]','variable',310,200) $indeposit>";
                }
            } else {
                echo " <input type='button' name='submit' value='CHANGE DEPOSIT' onclick=PopupCenter('deposit.php?id=$_GET[code]&emp=$r[TCEmpID]','variable',310,200)>";
            }
        }
        echo "</td></tr>
          <tr><td>Deposit Amount</td> <td>$r[DepositCurr] " . number_format($r[DepositAmount], 2, '.', '.');
        echo "</td></tr>
          <tr><td>Invoice No</td> <td>";
        if ($r[InvoiceNo] <> '') {
            echo "$r[InvoiceNo]";
        } else {
            echo "<input type='button' name='submit' value='INPUT INVOICE' onclick=PopupCenter('invoice.php?id=$_GET[code]','variable',310,200) $indeposit>";
        }
        echo "</td></tr>";
        $up = $r[AdultPax] + $r[ChildPax];
        if ($up > 10) {
            echo "
          <tr><th colspan=2>Template Pax Name</th></tr>
          <tr><td colspan=2><center><input type='button' name='submit' value='Download' onclick=location.href='PaxName.php?BookingID=$_GET[code]'>
          <input type=button value='Upload' onclick=\"javascript:PopupCenter('uppaxname.php?BookingID=$_GET[code]','variable',350,170)\"></center></td><tr>";
        }
        echo "</table>
          </td><td style='border:0px'></td><td style='border:0px'>";
        $editd = mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_GET[code]' AND Gender <> 'INFANT' ");
        $jd = mysql_num_rows($editd);
        $rd = mysql_fetch_array($editd);
        $totreq = $r[ReqPromo];

        if ($totreq == $jd) {
            $reqpromo = 'disabled';
        } else {
            $reqpromo = 'enabled';
        }
        $username = $_SESSION[employee_code];
        echo "<table class='bordered'>";
        $qvoucher = mysql_query("SELECT * FROM tour_voucherpromo WHERE BookingID = '$_GET[code]' ORDER BY VoucherStatus, VoucherNo ASC ");
        $jvoucher = mysql_num_rows($qvoucher);
        if ($jvoucher > 0) {
            echo "<tr><th colspan='6'>You Have $jvoucher Bonus Voucher</th></tr>
          <tr><th>no</th><th>voucher no</th><th>pax</th><th>bonus</th><th>status</th><th></th>";
            $s = 1;
            while ($rvoucher = mysql_fetch_array($qvoucher)) {
                if ($rvoucher[VoucherStatus] == 'REQUEST') {
                    $stts = 'ON REQUEST';
                } else {
                    $stts = $rvoucher[VoucherStatus];
                }
                if ($rvoucher['Print'] == '1' OR $rvoucher[VoucherStatus] <> 'APPROVE') {
                    $lok = 'disabled';
                } else {
                    $lok = 'enabled';
                }
                $vid = $rvoucher[VoucherID];
                $bid = $_GET[code];
                echo "<tr><td>$s</td>
          <td>$rvoucher[VoucherNo]</td>
          <td><center>$rvoucher[Pax]</center></td>
          <td>$rvoucher[Promo]</td>
          <td><center>$stts<center></td>
          <td><iframe src='voucherpromo.php?code=$rvoucher[VoucherID]' name='voucher$s' style='visibility: hidden' height='0' width='0' frameborder='0'>
          </iframe>
          <input type='button' value='PRINT' onClick=frames['voucher$s'].print(),diprint($vid) $lok>
          </td></tr>";
                $s++;
            }
        }
        echo "</table>
          </td>
          </table>

          <input type=hidden name='id' value='$_GET[code]'><input type=hidden name='grouptype' value='$curawal[GroupType]'>
          <input type='hidden' name='tourat' value='$curawal[SellingAdlTwn]'><input type='hidden' name='laat' value='$curawal[LAAdlTwn]'>
          <input type='hidden' name='tourct' value='$curawal[SellingChdTwn]'><input type='hidden' name='lact' value='$curawal[LAChdTwn]'>
          <input type='hidden' name='tourcx' value='$curawal[SellingChdXbed]'><input type='hidden' name='lacx' value='$curawal[LAChdXbed]'>
          <input type='hidden' name='tourcn' value='$curawal[SellingChdNbed]'><input type='hidden' name='lacn' value='$curawal[LAChdNbed]'>
          <input type='hidden' name='tourin' value='$curawal[SellingInfant]'><input type='hidden' name='lain' value='$curawal[LAInfant]'>
          <input type='hidden' name='singleprice' value='$curawal[SingleSell]'>
          <input type='hidden' name='cruisea12' value='$curawal[CruiseAdl12]'><input type='hidden' name='cruisea34' value='$curawal[CruiseAdl34]'>
          <input type='hidden' name='cruisec12' value='$curawal[CruiseChd12]'><input type='hidden' name='cruisec34' value='$curawal[CruiseChd34]'>
          <input type='hidden' name='cruisela12' value='$curawal[CruiseLoAdl12]'><input type='hidden' name='cruisela34' value='$curawal[CruiseLoAdl34]'>
          <input type='hidden' name='cruiselc12' value='$curawal[CruiseLoChd12]'><input type='hidden' name='cruiselc34' value='$curawal[CruiseLoChd34]'>
          Booking Information<br>
          <font size='2' color='red'>*<i>all price in $kurensi</i></font>";
        $tampil = mysql_query("SELECT * ,CONVERT(SUBSTRING_INDEX(RoomNo,'-',-1),UNSIGNED INTEGER) AS num FROM tour_msbookingdetail
                                WHERE BookingID = '$_GET[code]'
                                ORDER BY num ASC,IDDetail ASC ");
        $cekstatus = mysql_query("SELECT * FROM tour_msbookingdetail
                                WHERE BookingID = '$_GET[code]'
                                AND Status <>'CANCEL' ");
        $dapet = mysql_num_rows($cekstatus);
        if ($curawal[GroupType] == 'CRUISE') {
            $rtype = 'Type';
        } else {
            $rtype = 'bed Type';
        }
        echo " <table class='bordered'>
          <tr><th>no</th><th>title</th><th>pax name</th><th>passport no</th><th>type</th><th>package</th><th>room no</th><th>$rtype</th><th>voucher</th><th>price</th><th>sgl supplemen</th><th>disc</th><th>disc exh</th><th>total</th><th></th></tr>";
        $no = $posisi + 1;
        $banyak = mysql_num_rows($tampil);
        while ($data = mysql_fetch_array($tampil)) {

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
          <td><input type=text name='paxname$no' maxlength='50' value='$data[PaxName]' ";
            if ($data[Status] == 'CANCEL' OR $data[DoaProcess] > 0) {
                echo "readonly";
            }
            echo "></td>
          <td>$data[PassportNo]</td>
          <td><select name='gen$no' onChange='showPrice($no,$banyak),gantioption($no,$banyak),gantititle($no,$banyak)' ";
            if ($data[Status] == 'CANCEL') {
                echo "disabled";
            }
            echo ">
               ";
            if ($data[Gender] <> 'INFANT') {
                echo "
               <option value='ADULT'";
                if ($data[Gender] == 'ADULT') {
                    echo "selected";
                }
                echo ">ADULT</option>
               <option value='CHILD'";
                if ($data[Gender] == 'CHILD') {
                    echo "selected";
                }
                echo ">CHILD</option>";
            } else {
                echo "
               <option value='INFANT'";
                if ($data[Gender] == 'INFANT') {
                    echo "selected";
                }
                echo ">INFANT</option>";
            }
            echo "
               </select></td>
          <td><select name='package$no' onChange='showPrice($no,$banyak)' ";
            if ($data[Status] == 'CANCEL') {
                echo "disabled";
            }
            echo "><option value='Tour'";
            if ($data[Package] == 'Tour') {
                echo "selected";
            }
            echo ">Tour</option>
                                       <option value='L.A Only'";
            if ($data[Package] == 'L.A Only') {
                echo "selected";
            }
            echo ">L.A Only</option>
                                       </select></td>";
            $cadltwn = mysql_query("SELECT * FROM tour_msproduct
                                        WHERE IDProduct = '$r[IDTourcode]' and Status <> 'VOID'");
            $harga = mysql_fetch_array($cadltwn);

            echo " <td><center><select name='noroom$no' ";
            if ($data[Status] == 'CANCEL') {
                echo "disabled";
            }
            echo ">";
            for ($satu = $r[StartRoom]; $satu <= $r[EndRoom]; $satu++) {
                if ($data[RoomNo] == $satu) {
                    echo "<option value='$satu' selected>$satu</option>";
                } else {
                    echo "<option value='$satu'>$satu</option>";
                }

            }
            echo "</select></td>
          <td><center><select name='room$no' id='room$no' onChange='showPrice($no,$banyak)'";
            if ($data[Status] == 'CANCEL') {
                echo "disabled";
            }
            echo ">";
            //HARGA BILA CRUISE
            if ($curawal[GroupType] == 'CRUISE') {
                if ($data[Gender] == 'ADULT' and $data[Package] == 'Tour') {
                    echo "<option value='12 Pax'";
                    if ($data[RoomType] == '12 Pax') {
                        echo "selected";
                        $hargaroom = $harga[CruiseAdl12];
                        $hargacharge = '0';
                    }
                    echo ">1-2 PAX</option>
           <option value='34 Pax'";
                    if ($data[RoomType] == '34 Pax') {
                        echo "selected";
                        $hargaroom = $harga[CruiseAdl34];
                        $hargacharge = '0';
                    }
                    echo ">3-4 PAX</option>
           <option value='1 Pax'";
                    if ($data[RoomType] == '1 Pax') {
                        echo "selected";
                        $hargaroom = $harga[CruiseAdl12];
                        $hargacharge = $harga[SingleSell];
                    }
                    echo ">Single</option>";
                } else if ($data[Gender] == 'CHILD' and $data[Package] == 'Tour') {
                    echo "<option value='12 Pax'";
                    if ($data[RoomType] == '12 Pax') {
                        echo "selected";
                        $hargaroom = $harga[CruiseChd12];
                        $hargacharge = '0';
                    }
                    echo ">1-2 PAX</option>
           <option value='34 Pax'";
                    if ($data[RoomType] == '34 Pax') {
                        echo "selected";
                        $hargaroom = $harga[CruiseChd34];
                        $hargacharge = '0';
                    }
                    echo ">3-4 PAX</option>
           <option value='1 Pax'";
                    if ($data[RoomType] == '1 Pax') {
                        echo "selected";
                        $hargaroom = $harga[CruiseChd12];
                        $hargacharge = $harga[SingleSell];
                    }
                    echo ">Single</option>";
                } else if ($data[Gender] == 'INFANT' and $data[Package] == 'Tour') {
                    $hargaroom = $harga[SellingInfant];
                    $hargacharge = '0';
                    echo "
           <option value='No Bed'>No Bed</option>";
                } else if ($data[Gender] == 'ADULT' and $data[Package] == 'L.A Only') {
                    echo "<option value='12 Pax'";
                    if ($data[RoomType] == '12 Pax') {
                        echo "selected";
                        $hargaroom = $harga[CruiseLoAdl12];
                        $hargacharge = '0';
                    }
                    echo ">1-2 PAX</option>
           <option value='34 Pax'";
                    if ($data[RoomType] == '34 Pax') {
                        echo "selected";
                        $hargaroom = $harga[CruiseLoAdl34];
                        $hargacharge = '0';
                    }
                    echo ">3-4 PAX</option>
           <option value='1 Pax'";
                    if ($data[RoomType] == '1 Pax') {
                        echo "selected";
                        $hargaroom = $harga[CruiseLoAdl12];
                        $hargacharge = $harga[SingleSell];
                    }
                    echo ">Single</option>";
                } else if ($data[Gender] == 'CHILD' and $data[Package] == 'L.A Only') {
                    echo "<option value='12 Pax'";
                    if ($data[RoomType] == '12 Pax') {
                        echo "selected";
                        $hargaroom = $harga[CruiseLoChd12];
                        $hargacharge = '0';
                    }
                    echo ">1-2 PAX</option>
           <option value='34 Pax'";
                    if ($data[RoomType] == '34 Pax') {
                        echo "selected";
                        $hargaroom = $harga[CruiseLoChd34];
                        $hargacharge = '0';
                    }
                    echo ">3-4 PAX</option>
           <option value='1 Pax'";
                    if ($data[RoomType] == '1 Pax') {
                        echo "selected";
                        $hargaroom = $harga[CruiseLoChd12];
                        $hargacharge = $harga[SingleSell];
                    }
                    echo ">Single</option>";
                } else if ($data[Gender] == 'INFANT' and $data[Package] == 'L.A Only') {
                    $hargaroom = $harga[LAInfant];
                    $hargacharge = '0';
                    echo "
           <option value='No Bed'>No Bed</option>";
                }
                //BILA HARGA TOUR
            } else {
                if ($data[Gender] == 'ADULT' and $data[Package] == 'Tour') {
                    echo "<option value='Twin'";
                    if ($data[RoomType] == 'Twin') {
                        echo "selected";
                        $hargaroom = $harga[SellingAdlTwn];
                        $hargacharge = '0';
                    }
                    echo ">Twin</option>
           <option value='Double'";
                    if ($data[RoomType] == 'Double') {
                        echo "selected";
                        $hargaroom = $harga[SellingAdlTwn];
                        $hargacharge = '0';
                    }
                    echo ">Double</option>
           <option value='Single'";
                    if ($data[RoomType] == 'Single') {
                        echo "selected";
                        $hargaroom = $harga[SellingAdlTwn];
                        $hargacharge = $harga[SingleSell];
                    }
                    echo ">Single</option>
           <option value='Triple'";
                    if ($data[RoomType] == 'Triple') {
                        echo "selected";
                        $hargaroom = $harga[SellingAdlTwn];
                        $hargacharge = '0';
                    }
                    echo ">Triple</option>";
                } else if ($data[Gender] == 'CHILD' and $data[Package] == 'Tour') {
                    echo "<option value='Twin'";
                    if ($data[RoomType] == 'Twin') {
                        echo "selected";
                        $hargaroom = $harga[SellingChdTwn];
                        $hargacharge = '0';
                    }
                    echo ">Twin</option>
           <option value='Double'";
                    if ($data[RoomType] == 'Double') {
                        echo "selected";
                        $hargaroom = $harga[SellingChdTwn];
                        $hargacharge = '0';
                    }
                    echo ">Double</option>
           <option value='Xtra Bed'";
                    if ($data[RoomType] == 'Xtra Bed') {
                        echo "selected";
                        $hargaroom = $harga[SellingChdXbed];
                        $hargacharge = '0';
                    }
                    echo ">Xtra Bed</option>
           <option value='No Bed'";
                    if ($data[RoomType] == 'No Bed') {
                        echo "selected";
                        $hargaroom = $harga[SellingChdNbed];
                        $hargacharge = '0';
                    }
                    echo ">No Bed</option>
           <option value='Single'";
                    if ($data[RoomType] == 'Single') {
                        echo "selected";
                        $hargaroom = $harga[SellingChdTwn];
                        $hargacharge = $harga[SingleSell];
                    }
                    echo ">Single</option>
           <option value='Triple'";
                    if ($data[RoomType] == 'Triple') {
                        echo "selected";
                        $hargaroom = $harga[SellingChdTwn];
                        $hargacharge = '0';
                    }
                    echo ">Triple</option>";
                } else if ($data[Gender] == 'INFANT' and $data[Package] == 'Tour') {
                    $hargaroom = $harga[SellingInfant];
                    $hargacharge = '0';
                    echo "
           <option value='No Bed'>No Bed</option>";
                } else if ($data[Gender] == 'ADULT' and $data[Package] == 'L.A Only') {
                    echo "<option value='Twin'";
                    if ($data[RoomType] == 'Twin') {
                        echo "selected";
                        $hargaroom = $harga[LAAdlTwn];
                        $hargacharge = '0';
                    }
                    echo ">Twin</option>
           <option value='Double'";
                    if ($data[RoomType] == 'Double') {
                        echo "selected";
                        $hargaroom = $harga[LAAdlTwn];
                        $hargacharge = '0';
                    }
                    echo ">Double</option>
           <option value='Single'";
                    if ($data[RoomType] == 'Single') {
                        echo "selected";
                        $hargaroom = $harga[LAAdlTwn];
                        $hargacharge = $harga[SingleSell];
                    }
                    echo ">Single</option>
           <option value='Triple'";
                    if ($data[RoomType] == 'Triple') {
                        echo "selected";
                        $hargaroom = $harga[LAAdlTwn];
                        $hargacharge = '0';
                    }
                    echo ">Triple</option>";
                } else if ($data[Gender] == 'CHILD' and $data[Package] == 'L.A Only') {
                    echo "<option value='Twin'";
                    if ($data[RoomType] == 'Twin') {
                        echo "selected";
                        $hargaroom = $harga[LAChdTwn];
                        $hargacharge = '0';
                    }
                    echo ">Twin</option>
           <option value='Double'";
                    if ($data[RoomType] == 'Double') {
                        echo "selected";
                        $hargaroom = $harga[LAChdTwn];
                        $hargacharge = '0';
                    }
                    echo ">Double</option>
           <option value='Xtra Bed'";
                    if ($data[RoomType] == 'Xtra Bed') {
                        echo "selected";
                        $hargaroom = $harga[LAChdXbed];
                        $hargacharge = '0';
                    }
                    echo ">Xtra Bed</option>
           <option value='No Bed'";
                    if ($data[RoomType] == 'No Bed') {
                        echo "selected";
                        $hargaroom = $harga[LAChdNbed];
                        $hargacharge = '0';
                    }
                    echo ">No Bed</option>
           <option value='Single'";
                    if ($data[RoomType] == 'Single') {
                        echo "selected";
                        $hargaroom = $harga[LAChdTwn];
                        $hargacharge = $harga[SingleSell];
                    }
                    echo ">Single</option>
           <option value='Triple'";
                    if ($data[RoomType] == 'Triple') {
                        echo "selected";
                        $hargaroom = $harga[LAChdTwn];
                        $hargacharge = '0';
                    }
                    echo ">Triple</option>";
                } else if ($data[Gender] == 'INFANT' and $data[Package] == 'L.A Only') {
                    $hargaroom = $harga[LAInfant];
                    $hargacharge = '0';
                    echo "
           <option value='No Bed'>No Bed</option>";
                }
            }
            //------------------
            echo "</select> <input type=hidden name='selectroom$no' value='$data[RoomType]'></td>";
            $dataDiscount = $data[Discount];
            $addDiscount = $data[AddDiscount];
            $totDiscount = $dataDiscount + $addDiscount;
            $subtotal1 = $hargaroom + $hargacharge;
            $subtotalnya = $subtotal1 - $totDiscount;

            if ($data[Status] == 'CANCEL') {
                $hargaroom = '0';
                $hargacharge = '0';
                $subtotalnya = '0';
                $dataDiscount = '0';
                $addDiscount = '0';
            } else {
                if ($hargaroom == '') {
                    $hargaroom = '0';
                } else {
                    $hargaroom = $hargaroom;
                }
                if ($r[StatusPrice] == 'LOCK') {
                    $hargacharge = $data[AddCharge];
                    $subtotalnya = $data[subtotal];
                    $dataDiscount = $data[Discount];
                    $addDiscount = $data[AddDiscount];
                } else {
                    $hargacharge = $hargacharge;
                    $subtotalnya = $subtotalnya;
                    $dataDiscount = $dataDiscount;
                    $addDiscount = $addDiscount;
                }
            }
            if ($dapet == 1) {
                $buttonx = "hapusd('$dapet','$_GET[code]')";
            } else {
                $buttonx = "Batal($data[IDDetail])";
            }
            echo " <td>$data[VoucherNo]</td>
          <td><input type='text' name='harga$no' size='10' value=" . number_format($hargaroom, 2, '.', '');
            echo " style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='add$no' size='10' value=" . number_format($hargacharge, 2, '.', '');
            echo " style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='disc$no' value=" . number_format($dataDiscount, 2, '.', '');
            echo " size='8' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='adddisc$no' value=" . number_format($addDiscount, 2, '.', '');
            echo " size='7' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='total$no' value=" . number_format($subtotalnya, 2, '.', '');
            echo " size='13' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><center>";
            if ($data[Status] <> 'CANCEL') {
                echo "<a href=\"javascript:PopupCenter('infodetail.php?id=$data[IDDetail]&usr=$username','variable',540,600)\"><img src='../images/infodetail.png' title='Info Detail'></a> &nbsp";
                if ($data[VoucherNo] == '') {
                    if ($_SESSION[ltm_authority] == 'PO' OR $_SESSION[ltm_authority] == 'PO BRANCH' OR $_SESSION[ltm_authority] == 'PO MANAGER' OR $_SESSION[ltm_authority] == 'DEVELOPER') {
                        echo "<a href=\"javascript:$buttonx\"><img src='../images/deletepax.png' title='Delete Pax'></a>";
                    } else {
                        echo "";
                    }
                } else {
                    echo "
                            <img src='../images/deletepax1.png' title='Delete Pax Not Allowed'>";
                }
            } else {
                echo "<img src='../images/cancel.png' title='CANCEL'>";
            }
            echo "</td></tr>";
            $totalseluruh = $totalseluruh + $subtotalnya;
            $no++;
        }
        $totalseluruhxtra = $totalseluruh - $r[ExtraDiscount];
        echo "<tr><td colspan='13' style='text-align: right'><b>Extra Discount</b></td><td colspan=2>";
        if ($_SESSION[ltm_authority] == 'DEVELOPER' or $_SESSION[ltm_authority] == 'PO' or $_SESSION[ltm_authority] == 'PO MANAGER' or $_SESSION[ltm_authority] == 'ADMINISTRATOR' ) {
            echo "<input type='text' name='xtradisc' value='$r[ExtraDiscount]' size='13' style='text-align: right;' onkeyup=isNumber(this),Totalnya($banyak)>";
        } else {
            echo "<input type='hidden' name='xtradisc' value='$r[ExtraDiscount]' size='13'>$r[ExtraDiscount]";
        }
        echo "</td></tr>
          <tr><td colspan='13' style='text-align: right'><b>Total</b></td><td colspan=2><b>$harga[SellingCurr]</b><input type='text' name='jumtotal' value=" . number_format($totalseluruhxtra, 2, ',', '.');
        echo " size='12' style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan='15'>Note For Operation <br><textarea name='operationnote' cols='50' rows='3'>$r[OperationNote]</textarea></td></tr>
          <input type='hidden' name='banyak' value='$banyak'>
          <tr><td colspan=15><center><input type='submit' name='submit' value=Save>";
        //cari fbt
        $cari = mysql_query("SELECT * FROM tour_msbooking WHERE FBTNo <> '' and BookingID = '$r[BookingID]'");
        $ada = mysql_num_rows($cari);
        $adaisinya = mysql_fetch_array($cari);
        if ($ada == 0) {
            $ling = "../admin/fbt.php?code=" . $r[BookingID];
        } else {
            $ling = "../admin/fbt.php?act=showfbt&FBT=$adaisinya[FBTNo]";
        }
        $cari1 = mysql_query("SELECT * FROM tour_msbooking WHERE TBFNo <> '' and BookingID = '$r[BookingID]'");
        $ada1 = mysql_num_rows($cari1);
        $adaisinya1 = mysql_fetch_array($cari1);
        if(strlen($adaisinya1[TBFNo])==15) {
            $notbf = substr($adaisinya1[TBFNo], 0, 13);
        }elseif (strlen($adaisinya1[TBFNo])==16) {
            $notbf = substr($adaisinya1[TBFNo], 0, 14);
        }
        $caritbf = mysql_query("SELECT * FROM tour_tbfbooking WHERE TBFNo = '$notbf'");
        $stattbf = mysql_fetch_array($caritbf);
        if ($ada1 == 0 or $stattbf[Status] == 'REVISE') {
            $ling1 = "../admin/tbf.php?code=$_GET[code]&stat=$stattbf[Status]";
        } else {
            $ling1 = "../admin/tbf.php?act=showtbf&TBF=$notbf";
        }
        if ($r[BookingStatus] == 'DEPOSIT') {
            $aktiv = "enabled";
            if ($r[FBTNo] <> '') {
                $aktiv1 = "enabled";
            } else {
                $aktiv1 = "disabled";
            }
        } else {
            $aktiv = "disabled";
            $aktiv1 = "disabled";
        }
        echo "<input type=button value='Tour Reservation Form' onclick=updatepage('$ling') $aktiv>
          <input type=button value='Template Booking Form' onclick=updatepage('$ling1') $aktiv1>
          <br><input type=button style='width:320' value='Close' onclick=location.href='?module=msbookingdetail'></td></tr>
          </table>
          </form><br><br>";
        break;

    case "editdetails":
        $edit = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");
        $r = mysql_fetch_array($edit);
        $awal = mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r[TourCode]' and Status <> 'VOID'");
        $curawal = mysql_fetch_array($awal);
        $thisyear = date("Y");
        $nextyear = $thisyear + 1;
        /*$filt=mssql_query("SELECT DivisiNO,Employee.DivisiID,EmployeeID,Category,EmployeeName,CompanyGroup,LTMAuthority,JobTitle FROM [HRM].[dbo].[Employee]
                  inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                  WHERE EmployeeID = '$_SESSION[employee_code]'");
        $filter = mssql_fetch_array($filt);*/
        $team = $_SESSION[employee_office];
        $DDate = date('d-m-Y', strtotime($r[DepositDate]));
        if ($r[FBTNo] <> '' OR $r[StatusPrice] == 'LOCK') {
            $kurensi = "$r[Curr]";
        } else {
            $kurensi = "$curawal[SellingCurr]";
        }
        if($r[BookingPlace]==''){$location='';}else{$location='(EXHIBITION)';}
        echo "<h2>Booking ID : $_GET[code] $location</h2>
          <table style='border:0px'><td style='border:0px'>
          <table>
          <tr><td>Tour Code</td> <td>$r[TourCode]</td></tr>
          <tr><td>Client</td> <td>$r[ClientType]</td></tr>
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
          <tr><td>Total Room</td> <td>$r[TotalRoom] Room <input type='button' name='submit' value='CHANGE' onclick=PopupCenter('room.php?id=$_GET[code]','variable',300,150)></td></tr>
          <tr><th colspan=2></th></tr>
          <tr><td>Deposit Date</td> <td>$DDate</td></tr>
          <tr><td>Deposit No</td> <td>$r[DepositNo]</td></tr>
          <tr><td>Deposit Amount</td> <td>$r[DepositCurr] " . number_format($r[DepositAmount], 2, '.', '.');
        echo "</td></tr>";
        $up = $r[AdultPax] + $r[ChildPax];
        if ($up > 10) {
            echo "
          <tr><th colspan=2>Template Pax Name</th></tr>
          <tr><td colspan=2><center><input type='button' name='submit' value='Download' onclick=location.href='PaxName.php?BookingID=$_GET[code]'>
          <input type=button value='Upload' onclick=\"javascript:PopupCenter('uppaxname.php?BookingID=$_GET[code]','variable',350,170)\"></center></td><tr>";
        }
        echo "</table>
          </td><td style='border:0px'></td><td style='border:0px'>";
        $editd = mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_GET[code]' AND Gender <> 'INFANT' ");
        $jd = mysql_num_rows($editd);
        $rd = mysql_fetch_array($editd);
        $totreq = $r[ReqPromo];

        if ($totreq == $jd) {
            $reqpromo = 'disabled';
        } else {
            $reqpromo = 'enabled';
        }
        $username = $_SESSION[employee_code];
        echo "<table>";
        $qvoucher = mysql_query("SELECT * FROM tour_voucherpromo WHERE BookingID = '$_GET[code]' ORDER BY VoucherStatus, VoucherNo ASC ");
        $jvoucher = mysql_num_rows($qvoucher);
        if ($jvoucher > 0) {
            echo "<tr><th colspan='6'>You Have $jvoucher Bonus Voucher</th></tr>
              <tr><th>no</th><th>voucher no</th><th>pax</th><th>bonus</th><th>status</th><th></th>";
            $s = 1;
            while ($rvoucher = mysql_fetch_array($qvoucher)) {
                if ($rvoucher[VoucherStatus] == 'REQUEST') {
                    $stts = 'ON REQUEST';
                } else {
                    $stts = $rvoucher[VoucherStatus];
                }
                if ($rvoucher['Print'] == '1' OR $rvoucher[VoucherStatus] <> 'APPROVE') {
                    $lok = 'disabled';
                } else {
                    $lok = 'enabled';
                }
                $vid = $rvoucher[VoucherID];
                $bid = $_GET[code];
                echo "<tr><td>$s</td>
          <td>$rvoucher[VoucherNo]</td>
          <td><center>$rvoucher[Pax]</center></td>
          <td>$rvoucher[Promo]</td>
          <td><center>$stts<center></td>
          <td><iframe src='voucherpromo.php?code=$rvoucher[VoucherID]' name='voucher$s' style='visibility: hidden' height='0' width='0' frameborder='0'>
          </iframe>
          <input type='button' value='PRINT' onClick=frames['voucher$s'].print(),diprint($vid) $lok>
          </td></tr>";
                $s++;
            }
        }
        echo "</table>
          </td>
          </table>
          <form name='examples' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msbookingdetails&act=update' >
          <input type=hidden name='moduls' value='msbookingdetail'>
          <input type=hidden name='id' value='$_GET[code]'><input type='hidden' name='laprice' value='$curawal[LandArrSell]'>
          Booking Information<br>
          <font size='2' color='red'>*<i>all price in $kurensi</i></font>";
        $tampil = mysql_query("SELECT * FROM tour_msbookingdetail
                                WHERE BookingID = '$_GET[code]'
                                ORDER BY RoomNo ASC,IDDetail ASC ");
        $cekstatus = mysql_query("SELECT * FROM tour_msbookingdetail
                                WHERE BookingID = '$_GET[code]'
                                AND Status <>'CANCEL' ");
        $dapet = mysql_num_rows($cekstatus);
        if ($curawal[GroupType] == 'CRUISE') {
            $rtype = 'Type';
        } else {
            $rtype = 'bed Type';
        }
        echo " <table>
          <tr><th>no</th><th>title</th><th>pax name</th><th>passport no</th><th>type</th><th>package</th><th>room no</th><th>$rtype</th><th>price</th><th>sgl supplemen</th><th>disc</th><th>disc exh</th><th>total</th><th></th></tr>";
        $no = $posisi + 1;
        $banyak = mysql_num_rows($tampil);
        while ($data = mysql_fetch_array($tampil)) {
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
            if ($data[Status] == 'CANCEL' OR $data[DoaProcess] > 0) {
                echo "readonly";
            }
            echo "></td>
          <td>$data[PassportNo]</td>
          <td><center>$data[Gender]</td>
          <td><input type=text name='package$no' value='$data[Package]' size='8' readonly></td>";
            $cadltwn = mysql_query("SELECT * FROM tour_msproduct
                                        WHERE TourCode = '$r[TourCode]' and Status <> 'VOID'");
            $harga = mysql_fetch_array($cadltwn);
            if ($dapet <> 1) {
                $buttonx = "Batals($data[IDDetail])";
            } else {
                $buttonx = "hapusd('$dapet','$_GET[code]')";
            }
            echo " <td><center><select name='noroom$no' ";
            if ($data[Status] == 'CANCEL') {
                echo "disabled";
            }
            echo ">";
            for ($satu = $r[StartRoom]; $satu <= $r[EndRoom]; $satu++) {
                if ($data[RoomNo] == $satu) {
                    echo "<option value='$satu' selected>$satu</option>";
                } else {
                    echo "<option value='$satu'>$satu</option>";
                }

            }
            echo "</select></td>";
            if ($data[RoomType] == '12 Pax') {
                $tipe = '1-2 PAX';
            } else if ($data[RoomType] == '34 Pax') {
                $tipe = '3-4 PAX';
            } else {
                $tipe = $data[RoomType];
            }
            echo "<td><center><select name='room$no' id='room$no'";
            if ($data[Status] == 'CANCEL') {
                echo "disabled";
            }
            echo ">";
            //HARGA BILA CRUISE
            if ($curawal[GroupType] == 'CRUISE') {
                if ($data[RoomType] == '12 Pax' OR $data[RoomType] == '34 Pax') {
                    echo "<option value='12 Pax'";
                    if ($data[RoomType] == '12 Pax') {
                        echo "selected";
                    }
                    echo ">1-2 PAX</option>
                           <option value='34 Pax'";
                    if ($data[RoomType] == '34 Pax') {
                        echo "selected";
                    }
                    echo ">3-4 PAX</option>";
                } else if ($data[RoomType] == '1 Pax') {
                    echo "<option value='1 Pax'";
                    if ($data[RoomType] == '1 Pax') {
                        echo "selected";
                    }
                    echo ">Single</option>";
                } else if ($data[RoomType] == 'No Bed') {
                    echo "<option value='No Bed'>No Bed</option>";
                }
                //BILA HARGA TOUR
            } else {
                if ($data[Gender] == 'ADULT') {
                    if ($data[RoomType] == 'Single') {
                        echo "<option value='Single'";
                        if ($data[RoomType] == 'Single') {
                            echo "selected";
                        }
                        echo ">Single</option>";
                    } else {
                        echo "<option value='Twin'";
                        if ($data[RoomType] == 'Twin') {
                            echo "selected";
                        }
                        echo ">Twin</option>
                               <option value='Double'";
                        if ($data[RoomType] == 'Double') {
                            echo "selected";
                        }
                        echo ">Double</option>
                               <option value='Triple'";
                        if ($data[RoomType] == 'Triple') {
                            echo "selected";
                        }
                        echo ">Triple</option>";
                    }
                } else if ($data[Gender] == 'CHILD') {
                    if ($data[RoomType] == 'Single') {
                        echo "<option value='Single'";
                        if ($data[RoomType] == 'Single') {
                            echo "selected";
                        }
                        echo ">Single</option>";
                    } else {
                        echo "<option value='Twin'";
                        if ($data[RoomType] == 'Twin') {
                            echo "selected";
                        }
                        echo ">Twin</option>
                               <option value='Double'";
                        if ($data[RoomType] == 'Double') {
                            echo "selected";
                        }
                        echo ">Double</option>
                               <option value='Xtra Bed'";
                        if ($data[RoomType] == 'Xtra Bed') {
                            echo "selected";
                        }
                        echo ">Xtra Bed</option>
                               <option value='No Bed'";
                        if ($data[RoomType] == 'No Bed') {
                            echo "selected";
                        }
                        echo ">No Bed</option>
                               <option value='Triple'";
                        if ($data[RoomType] == 'Triple') {
                            echo "selected";
                        }
                        echo ">Triple</option>";
                    }
                } else if ($data[Gender] == 'INFANT') {
                    echo "<option value='No Bed'>No Bed</option>";
                }
            }
            //------------------
            echo "</select> <input type=hidden name='selectroom$no' value='$data[RoomType]'></td>
          <td><input type='text' name='harga$no' size='10' value=" . number_format($data[Price], 2, '.', '');
            echo " style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='add$no' size='10' value=" . number_format($data[AddCharge], 2, '.', '');
            echo " style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='disc$no' value=" . number_format($data[Discount], 2, '.', '');
            echo " size='8' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='adddisc$no' value=" . number_format($data[AddDiscount], 2, '.', '');
            echo " size='7' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='total$no' value=" . number_format($data[SubTotal], 2, '.', '');
            echo " size='13' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><center>";
            if ($data[Status] <> 'CANCEL') {
                echo "<a href=\"javascript:PopupCenter('infodetail.php?id=$data[IDDetail]&usr=$username','variable',540,600)\"><img src='../images/infodetail.png' title='Info Detail'></a> &nbsp";
                if ($data[VoucherNo] == '') {
                    if ($_SESSION[ltm_authority] == 'PO' OR $_SESSION[ltm_authority] == 'PO BRANCH' OR $_SESSION[ltm_authority] == 'PO MANAGER' OR $_SESSION[ltm_authority] == 'DEVELOPER') {
                        echo "<a href=\"javascript:$buttonx\"><img src='../images/deletepax.png' title='Delete Pax'></a>";
                    } else {
                        echo "";
                    }
                } else {
                    echo "
                            <img src='../images/deletepax1.png' title='Delete Pax Not Allowed'>";
                }
            } else {
                echo "<img src='../images/cancel.png' title='CANCEL'>";
            }
            echo "</td></tr>";
            $totalseluruh = $totalseluruh + $data[SubTotal];
            $no++;
        }
        $totalseluruhxtra = $totalseluruh - $r[ExtraDiscount];
        echo "<tr><td colspan=12 style='text-align: right'><b>Extra Discount</b></td><td colspan=2>";
        if ($_SESSION[ltm_authority] == 'DEVELOPER' or $_SESSION[ltm_authority] == 'PO' or $_SESSION[ltm_authority] == 'PO MANAGER' or $_SESSION[ltm_authority] == 'ADMINISTRATOR' ) {
            echo "<input type='text' name='xtradisc' value='$r[ExtraDiscount]' size='13' style='text-align: right;' onkeyup=isNumber(this),Totalnya($banyak)>";
        } else {
            echo "<input type='hidden' name='xtradisc' value='$r[ExtraDiscount]' size='13'>$r[ExtraDiscount]";
        }
        echo "</td></tr>
          <tr><td colspan=12 style='text-align: right'><b>Total</b></td><td colspan=2><b>$harga[SellingCurr]</b><input type='text' name='jumtotal' value=" . number_format($totalseluruhxtra, 2, ',', '.');
        echo " size='12' style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=14>Note For Operation <br><textarea name='operationnote' cols='50' rows='3'>$r[OperationNote]</textarea></td></tr>
          <input type='hidden' name='banyak' value='$banyak'>
          <tr><td colspan=14><center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick=location.href='?module=msbookingdetail'></td></tr>
          </table>
          </form><br><br>";
        break;

    case "showdetail":
        $edit = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[code]'");
        $r = mysql_fetch_array($edit);
        $awal = mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r[TourCode]' and Status <> 'VOID'");
        $curawal = mysql_fetch_array($awal);
        $thisyear = date("Y");
        $nextyear = $thisyear + 1;
        $datenow = date("d", time());
        $monthnow = date("m", time());
        $today = $thisyear . "-" . $monthnow . "-" . $datenow;

        if ($r[DepositDate] == '0000-00-00') {
            $tanggalDep = $today;
        } else {
            $tanggalDep = $r[DepositDate];
        }
        $DDate = date('d-m-Y', strtotime($tanggalDep));
        if ($r[FBTNo] <> '' OR $r[StatusPrice] == 'LOCK') {
            $kurensi = "$r[Curr]";
        } else {
            $kurensi = "$curawal[SellingCurr]";
        }
        if($r[BookingPlace]==''){$location='';}else{$location='(EXHIBITION)';}
        echo "<h2>Booking ID : $_GET[code] $location</h2>
          <table style='border:0px'><td style='border:0px'>
          <table class='bordered'>
          <tr><td>Tour Code</td> <td>$r[TourCode]</td></tr>
          <tr><td>Client</td> <td>$r[ClientType]</td></tr>
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
          <tr><td>Deposit Amount</td> <td>$r[DepositCurr] " . number_format($r[DepositAmount], 2, '.', '.');
        echo "</td></tr>
          <tr><td>Invoice No</td> <td>";
        if ($r[InvoiceNo] <> '') {
            echo "$r[InvoiceNo]";
        } else {
            echo "<input type='button' name='submit' value='INPUT INVOICE' onclick=PopupCenter('invoice.php?id=$_GET[code]','variable',300,150)>";
        }
        echo "</td></tr>
          </table>
          </td><td style='border:0px'></td><td style='border:0px'>";
        $editd = mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_GET[code]' AND Gender <> 'INFANT' ");
        $jd = mysql_num_rows($editd);
        $rd = mysql_fetch_array($editd);
        $totreq = $r[ReqPromo];

        if ($totreq == $jd) {
            $reqpromo = 'disabled';
        } else {
            $reqpromo = 'enabled';
        }
        $username = $_SESSION[employee_code];
        echo "<table class='bordered'>";
        $qvoucher = mysql_query("SELECT * FROM tour_voucherpromo WHERE BookingID = '$_GET[code]' ORDER BY VoucherStatus, VoucherNo ASC ");
        $jvoucher = mysql_num_rows($qvoucher);
        if ($jvoucher > 0) {
            echo "<tr><th colspan='6'>You Have $jvoucher Bonus Voucher</th></tr>
          <tr><th>no</th><th>voucher no</th><th>pax</th><th>bonus</th><th>status</th><th></th>";
            $s = 1;
            while ($rvoucher = mysql_fetch_array($qvoucher)) {
                if ($rvoucher[VoucherStatus] == 'REQUEST') {
                    $stts = 'ON REQUEST';
                } else {
                    $stts = $rvoucher[VoucherStatus];
                }
                if ($rvoucher['Print'] == '1' OR $rvoucher[VoucherStatus] <> 'APPROVE') {
                    $lok = 'disabled';
                } else {
                    $lok = 'enabled';
                }
                $vid = $rvoucher[VoucherID];
                $bid = $_GET[code];
                echo "<tr><td>$s</td>
          <td>$rvoucher[VoucherNo]</td>
          <td><center>$rvoucher[Pax]</center></td>
          <td>$rvoucher[Promo]</td>
          <td><center>$stts<center></td>
          <td><iframe src='voucherpromo.php?code=$rvoucher[VoucherID]' name='voucher$s' style='visibility: hidden' height='0' width='0' frameborder='0'>
          </iframe>
          <input type='button' value='PRINT' onClick=frames['voucher$s'].print(),diprint($vid) $lok>
          </td></tr>";
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
        $tampil = mysql_query("SELECT * FROM tour_msbookingdetail
                                WHERE BookingID = '$_GET[code]'
                                ORDER BY RoomNo ASC,IDDetail ASC ");
        if ($curawal[GroupType] == 'CRUISE') {
            $rtype = 'Type';
        } else {
            $rtype = 'bed Type';
        }
        echo " <table class='bordered'>
          <tr><th>no</th><th>title</th><th>pax name</th><th>type</th><th>package</th><th>room no</th><th>$rtype</th><th>price</th><th>sgl supplemen</th><th>disc</th><th>disc exh</th><th>total</th><th></th></tr>";
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
          <td><input type='text' name='harga$no' size='10' value=" . number_format($data[Price], 2, ',', '.');
            echo " style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='add$no' size='10' value=" . number_format($data[AddCharge], 2, ',', '.');
            echo " style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='disc$no' value=" . number_format($data[Discount], 2, ',', '.');
            echo " size='10' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='adddisc$no' value=" . number_format($data[AddDiscount], 2, ',', '.');
            echo " size='10' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><input type='text' name='total$no' value=" . number_format($data[SubTotal], 2, ',', '.');
            echo " size='13' style='text-align: right;border: 0px solid #000000;' readonly></td>
          <td><center>";
            if ($data[Status] <> 'CANCEL') {
                echo "<a href=\"javascript:PopupCenter('infodetailro.php?id=$data[IDDetail]&usr=$username','variable',540,600)\"><img src='../images/detail.png' title='Info Detail'></a>";
            } else {
                echo "<img src='../images/cancel.png' title='CANCEL'>";
            }
            echo "</td></tr>";
            $no++;
        }
        $modul = $_GET[mod];
        if ($modul == 'msvoucher') {
            $modul = $modul;
        } else {
            $modul = 'msbookingdetail';
        }
        if ($r[TotalPrice] == '') {
            $totalprice = '0';
        } else {
            $totalprice = $r[TotalPrice];
        }
        echo "<tr><td colspan=11 style='text-align: right'><b>Total</b></td><td colspan=2><b>$harga[SellingCurr]</b><input type='text' name='jumtotal' size='12' value=" . number_format($totalprice, 2, ',', '.');
        echo " style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
          <tr><td colspan=13>Note For Operation <br><textarea name='operationnote' cols='50' rows='3' readonly>$r[OperationNote]</textarea></td></tr>
          <input type='hidden' name='banyak' value='$banyak'>
          <tr><td colspan=13><center>
                            <input type=button value=Back onclick=location.href='?module=$modul'></td></tr>
          </table>
          </form><br><br>";
        break;

    case "cancelpax":
        $edit1 = mysql_query("SELECT * FROM tour_msbookingdetail WHERE IDDetail ='$_GET[id]'");
        $r2 = mysql_fetch_array($edit1);
        $upbook1 = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$r2[BookingID]'");
        $upbook = mysql_fetch_array($upbook1);
        $edit = mysql_query("UPDATE tour_msbookingdetail set Status = 'CANCEL',
                                                        Price='0',
                                                        AddCharge='0',
                                                        Discount = '0',
                                                        SubTotal='0',
                                                        ReasonCancel='$_GET[reason]',
                                                        CancelBy='$EmpName',
                                                        CancelDate='$today'
                                                        WHERE IDDetail = '$r2[IDDetail]'");
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
        if ($upbook[SFID] <> '') {
            $edit = mssql_query("UPDATE dbo.SalesFolderDetails set StatusLTM = 'CANCEL'
                                                        WHERE ConfirmationNo = '$r2[BookingID]' and PAXNAME ='$r2[PaxName]' ");
        }
        $mencari1 = mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$upbook[IDTourcode]' and Status <> 'VOID' ");
        $ulang = mysql_fetch_array($mencari1);
        $caribook = mysql_query("SELECT count(IDDetail) as totbuking FROM tour_msbookingdetail WHERE IDTourcode = '$upbook[IDTourcode]' and Gender <> 'INFANT' and Status <> 'CANCEL'");
        $kebook = mysql_fetch_array($caribook);
        $seatdep = $kebook[totbuking];
        $seatsisa = $ulang[Seat] - $seatdep;
        $updet = mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdep',
                                                        SeatSisa='$seatsisa'
                                                        WHERE IDProduct = '$upbook[IDTourcode]'");
        $Description = "Cancel Pax $r2[IDDetail]";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('$EmpName',
                                   '$Description',
                                   '$today')");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msbookingdetail&act=editdetail&code=$r2[BookingID]'>";
        break;

    case "cancelpaxs":
        $edit1 = mysql_query("SELECT * FROM tour_msbookingdetail WHERE IDDetail ='$_GET[id]'");
        $r2 = mysql_fetch_array($edit1);
        $upbook1 = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$r2[BookingID]'");
        $upbook = mysql_fetch_array($upbook1);
        $edit = mysql_query("UPDATE tour_msbookingdetail set Status = 'CANCEL',
                                                        Price='0',
                                                        AddCharge='0',
                                                        Discount = '0',
                                                        SubTotal='0',
                                                        ReasonCancel='$_GET[reason]',
                                                        CancelBy='$EmpName',
                                                        CancelDate='$today'
                                                        WHERE IDDetail = '$r2[IDDetail]'");
        $mencari1 = mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$upbook[IDTourcode]' and Status <> 'VOID' ");
        $ulang = mysql_fetch_array($mencari1);
        $caribook = mysql_query("SELECT count(IDDetail) as totbuking FROM tour_msbookingdetail WHERE IDTourcode = '$upbook[IDTourcode]' and Gender <> 'INFANT' and Status <> 'CANCEL'");
        $kebook = mysql_fetch_array($caribook);
        $seatdep = $kebook[totbuking];
        $seatsisa = $ulang[Seat] - $seatdep;
        $updet = mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdep',
                                                        SeatSisa='$seatsisa'
                                                        WHERE IDProduct = '$upbook[IDTourcode]'");
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
        /*if($upbook[SFID]<>''){
     $edit=mssql_query("UPDATE [PTES].[dbo].[SalesFolderDetails] set [StatusPax] = 'CANCEL'
                                                        WHERE ConfirmationNo = '$r2[BookingID]' and IDDetailLTM ='$r2[PaxName]' ");
     }*/
        $Description = "Cancel Pax $r2[IDDetail]";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('$EmpName',
                                   '$Description',
                                   '$today')");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msbookingdetail&act=editdetails&code=$r2[BookingID]'>";
        break;

    case "deletedetail":
        $edit = mysql_query("DELETE FROM tour_detail WHERE IDDetail = '$_GET[id]'");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msbookingdetail&act=quotation&id=$_GET[no]'>";
        break;

    case "cancelbook":
        $hariini = date("Y-m-d ");
        $updets = mysql_query("UPDATE tour_msbooking set Status='VOID',ReasonCancel='$_GET[reason]',CancelBy='$EmpName',CancelDate='$today' WHERE BookingID = '$_GET[code]'");
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
        // cek data pameran
        $datpameran = mysql_query("SELECT * FROM tour_marketing WHERE DateFrom <= '$hariini' and DateTo >= '$hariini' and Status ='FIX' and MarketingID = '$upbook[BookingPlace]' ");
        $lgpameran = mysql_num_rows($datpameran);
        if ($lgpameran > 0) {
            $apuspameran = mysql_query("UPDATE tour_msbooking set BookingPlace = '' WHERE BookingID = '$_GET[code]'");
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
        if (($offgroup == 'PANORAMA TOURS' AND !preg_match('/LTM/', $EmpOff)) OR $offgroup <> 'PANORAMA WORLD' OR $offgroup <> 'SISTER COMPANY') {
            $cekduplicate = mysql_query("SELECT * FROM tour_msbooking WHERE DepositNo = '$cek[DepositNo]' and Status = 'ACTIVE' limit 1");
            $jumlahduplicate = mysql_num_rows($cekduplicate);
            $hasilduplicate = mysql_fetch_array($cekduplicate);
            if ($jumlahduplicate > 0) {
                mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = '$hasilduplicate[BookingID]'
                                                WHERE [CashReceiptId] = '$cek[DepositNo]'");
            } else if ($jumlahduplicate == 0) {
                mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = NULL
                                                WHERE [CashReceiptId] = '$cek[DepositNo]'");
            }
        }
        //void voucher
        mysql_query("UPDATE tour_voucherpromo set VoucherStatus = 'VOID',
                                        UpdateBy = 'SYSTEM',
                                        UpdateDate = '$today'
                                        WHERE BookingID = '$bookdraft[BookingID]'");
        // void CSR Pameran
        $cekingcsr = mysql_query("SELECT * FROM tour_CashReceipt_Payment WHERE CashReceiptId = '$cek[DepositNo]'");
        $cekcsr = mysql_fetch_array($cekingcsr);
        if ($cekcsr[StatusReport] == '' AND $cekcsr[TypePayment] == 'Cash') {
            //void csr
            mysql_query("UPDATE tour_CashReceipt set StatusVoid = '1',
                                    Status = 'V',
                                    WhoVoid = '$_SESSION[employee_code]',
                                    DateVoid = '$today'
                                    WHERE LTMBookingID = '$cek[BookingID]' AND CashReceiptId = '$cek[DepositNo]'");
        }
        //apus no bookingan di csr local
        mysql_query("UPDATE tour_CashReceipt set LTMBookingID = NULL
                                    WHERE CashReceiptId = '$cek[DepositNo]'");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msbookingdetail'>";
        break;
    /*
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
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msbookingdetail'>";
    break;
    */
    case "showexhibition":
        $edit = mysql_query("SELECT BookingDate FROM tour_msbooking WHERE BookingPlace = '$_GET[id]' AND Status = 'ACTIVE' group by BookingDate ASC");
        while ($r1 = mysql_fetch_array($edit)) {
            $tanggalbook = date("d M Y", strtotime($r1[BookingDate]));
            echo "<font color='blue' size='2'>Date: $tanggalbook</font> <br>";
            $edit1 = mysql_query("SELECT IDTourcode FROM tour_msbooking WHERE BookingPlace ='$_GET[id]' AND Status ='ACTIVE' AND BookingDate = '$r1[BookingDate]' group by TourCode ASC");
            echo "<table><tr><th>no</th><th width='250'>TourCode</th><th>Total Deposit</th><th>Adult</th><th>Child</th><th>Infant</th></tr>";
            $no = 1;
            $totaldp = 0;
            $totaladult = 0;
            $totalchild = 0;
            $totalinfant = 0;
            while ($r2 = mysql_fetch_array($edit1)) {
                $d = mysql_query("SELECT TourCode,count(BookingID)as deppameran,sum(AdultPax)as totadult,sum(ChildPax)as totchild,sum(InfantPax)as totinf FROM tour_msbooking
                                WHERE BookingPlace = '$_GET[id]'
                                and BookingDate = '$r1[BookingDate]'
                                and IDTourcode = '$r2[IDTourcode]'

                                group by TourCode,BookingDate ASC");
                while ($dd = mysql_fetch_array($d)) {
                    echo "<tr><td>$no</td>
         <td><center>$dd[TourCode]</td>
         <td><center>$dd[deppameran]</td>
         <td><center>$dd[totadult]</td>
         <td><center>$dd[totchild]</td>
         <td><center>$dd[totinf]</td>
         </tr>";
                    $no++;
                    $totaldp = $totaldp + $dd[deppameran];
                    $totaladult = $totaladult + $dd[totadult];
                    $totalchild = $totalchild + $dd[totchild];
                    $totalinfant = $totalinfant + $dd[totinf];
                }
            }
            echo "<tr><td></td><td><center><b>TOTAL</b></td><td><center><b>$totaldp</b></td><td><center><b>$totaladult</b></td><td><center><b>$totalchild</b></td><td><center><b>$totalinfant</b></td></tr></table>";
        }
        echo "<center><input type=button value=Back onclick=location.href='?module=home'></center><br>";
        break;

    case "showexcancel":
        $edit = mysql_query("SELECT * FROM tour_msbooking
                    left join tour_marketing on tour_msbooking.BookingPlace = tour_marketing.MarketingID
                    left join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                    WHERE tour_msbooking.BookingPlace = '$_GET[id]' and tour_msbooking.Status='VOID'");
        $edit1 = mysql_query("SELECT * FROM tour_marketing
                    WHERE MarketingID = '$_GET[id]'");
        $ye = mysql_fetch_array($edit1);
        echo "<h2> Detail Cancel Booking from $ye[Event] </h2>
        <table>
                <tr><th colspan=8></th><th colspan=3>total pax</th><th></th></tr>
                <tr><th>no</th><th>Booking ID</th><th>tour code</th><th>Dept</th><th>Bookers</th><th>tc name</th><th>divisi</th><th>cash receipt</th><th>adult</th><th>child</th><th>infant</th><th>reason</th></tr>";
        $no = 1;
        while ($data = mysql_fetch_array($edit)) {

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
        echo "</table><center><input type=button value=Back onclick=location.href='?module=rpsalesex'></center><br>";
        break;

    case "ltmbook":
        $nama = $_GET['nama'];
        echo "<h2>Booking Detail</h2>
      <form method=get action='media.php?'>
            <input type=hidden name=module value='msbookingdetail'>
          TourCode <input type=text name=nama value='$nama' size=20>
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
        /*$filt=mssql_query("SELECT DivisiNO,Employee.DivisiID,EmployeeID,Category,EmployeeName,CompanyGroup,LTMAuthority,JobTitle FROM [HRM].[dbo].[Employee]
                  inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                  WHERE EmployeeID = '$_SESSION[employee_code]'");
        $filter = mssql_fetch_array($filt);*/
        $team = $_SESSION[employee_office];
        $tampil = mysql_query("SELECT * FROM tour_msbooking
                            inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourCode
                            WHERE tour_msbooking.TourCode LIKE '%$nama%'
                            AND DUMMY = 'YES'
                            AND tour_msbooking.Status ='ACTIVE'
                            and tour_msproduct.Status <> 'VOID'
                            and tour_msproduct.DateTravelFrom >= '$hariini'
                            and Company = '$_SESSION[company_group]'
                            ORDER BY BookingID DESC LIMIT $posisi,$batas");
        $jumlah = mysql_num_rows($tampil);

        if ($jumlah > 0) {
            echo "   <table>
                <tr><th colspan=8></th><th colspan=3>total pax</th><th></th></tr>
                <tr><th>no</th><th>Booking ID</th><th>Date</th><th>tour code</th><th>Dept</th><th>Bookers</th><th>tc name</th><th>alias name</th><th>adult</th><th>child</th><th>infant</th><th>action</th></tr>";
            $no = $posisi + 1;
            while ($data = mysql_fetch_array($tampil)) {
                echo "<tr><td>$no</td>
                 <td>
                 ";
                if ($data[DepositNo] == '' or $data[DepositAmount] == '') {
                    echo "$data[BookingID]";
                } else {
                    echo "<a href=\"javascript:PopupCenter('option.php?code=$data[BookingID]','variable',180,90)\">$data[BookingID]</a>";
                }
                $edit1 = mysql_query("SELECT count(IDDetail)as bnyk FROM tour_msbookingdetail WHERE BookingID ='$data[BookingID]' and Gender <> 'INFANT' and Status <> 'CANCEL' group by BookingID");
                $r2 = mysql_fetch_array($edit1);
                if ($data[DepositNo] == '') {
                    $totalinq = $data[AdultPax] + $data[ChildPax];
                } else {
                    $totalinq = $r2[bnyk];
                }
                if ($data[FBTNo] == '') {
                    $bisa = "enabled";
                    $lin = "?module=msbookingdetail&act=editdetail&code=$data[BookingID]";
                } else {
                    $bisa = "disabled";
                    $lin = "?module=msbookingdetail&act=editdetails&code=$data[BookingID]";
                }
                echo "
                 </td></td>
				 <td>" . date("d M y", strtotime($data[BookingDate])) . "</td>
                 <td>$data[TourCode]</td>
                 <td>" . date("d M y", strtotime($data[DateTravelFrom])) . "</td>
                 <td>$data[BookersName]</td>
                 <td><center>$data[TCName]</td>
                 <td><center>$data[TCNameAlias]</td>
                 <td><center>$data[AdultPax]</td>
                 <td><center>$data[ChildPax]</td>
                 <td><center>$data[InfantPax]</td>
                 <td><center>";
                if ($data[DepositNo] == '') {
                    echo "<input type=button value='Edit Booking' onclick=location.href='?module=msbookingdetail&act=editbooking&id=$data[BookingID]'>
                    <input type='button' name='submit' value='CANCEL' onclick=hapusd('$totalinq','$data[BookingID]') $bisa>";
                } else {
                    echo "<input type=button value='Edit Detail' onclick=location.href='$lin'>
                    <input type='button' name='submit' value='CANCEL' onclick=hapusd('$totalinq','$data[BookingID]') $bisa>";
                }
                echo "
                 </td></tr>";
                $no++;
            }
            echo "</table>";

            // Langkah 3

            $tampil2 = "SELECT * FROM tour_msbooking
                                        inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourCode
                                        WHERE tour_msbooking.TourCode LIKE '%$nama%'
                                        AND DUMMY = 'YES'
                                        AND tour_msbooking.Status ='ACTIVE'
                                        and tour_msproduct.Status <> 'VOID'
                                        and tour_msproduct.DateTravelFrom >= '$hariini'
                                        and Company = '$_SESSION[company_group]'
                                        ORDER BY BookingID ASC";

            $hasil2 = mysql_query($tampil2);
            $jmldata = mysql_num_rows($hasil2);
            $jmlhalaman = ceil($jmldata / $batas);
            $file = "media.php?module=msbookingdetail";
            // Link ke halaman sebelumnya (previous)
            echo "<center><div id='paging'>";
            if ($halaman > 1) {
                $previous = $halaman - 1;
                echo "<a href=$file&act=ltmbook&halaman=1&nama=$nama&oke=$oke> << First</a> |
                          <a href=$file&act=ltmbook&halaman=$previous&nama=$nama&oke=$oke> < Previous</a> | ";
            } else {
                echo "<< First | < Previous | ";
            }
            // Tampilkan link halaman 1,2,3 ... modifikasi ala google
            // Angka awal
            $angka = ($halaman > 3 ? " ... " : " "); //Ternary Operator
            for ($i = $halaman - 2; $i < $halaman; $i++) {
                if ($i < 1)
                    continue;
                $angka .= "<a href=$file&act=ltmbook&halaman=$i&nama=$nama&oke=$oke>$i</a> ";
            }
            // Angka tengah
            $angka .= " <b>$halaman</b> ";
            for ($i = $halaman + 1; $i < ($halaman + 3); $i++) {
                if ($i > $jmlhalaman)
                    break;
                $angka .= "<a href=$file&act=ltmbook&halaman=$i&nama=$nama&oke=$oke>$i</a> ";
            }
            // Angka akhir
            $angka .= ($halaman + 2 < $jmlhalaman ? " ...
                    <a href=$file&act=ltmbook&halaman=$jmlhalaman&nama=$nama&oke=$oke>$jmlhalaman</a> |" : " ");
            // Cetak angka seluruhnya (awal, tengah, akhir)
            echo "$angka";
            // Link ke halaman berikutnya (Next)
            if ($halaman < $jmlhalaman) {
                $next = $halaman + 1;
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
        $edit = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[id]'");
        $r = mysql_fetch_array($edit);
        $totalpax = $r[AdultPax] + $r[ChildPax];
        $oke2 = mysql_query("SELECT * FROM tour_msproduct
                            WHERE IDProduct = '$r[IDTourcode]'
                            ORDER BY DateTravelFrom ASC");
        $o = mysql_fetch_array($oke2);
        echo "
          <h2>Move Booking</h2>
          <form name='example' method='POST' onsubmit action='./aksi.php?module=msbookingdetail&act=move' >
          <input type='hidden' name='id' value='$_GET[id]'><input type='hidden' name='totalroom' value='$r[TotalRoom]'>
          <table>
          <tr><td>Booking ID</td> <td>$r[BookingID]</td></tr>
          <tr><td>Total Pax</td> <td>$totalpax Pax (Adult : $r[AdultPax] Pax, Child : $r[ChildPax] Pax, Infant : $r[InfantPax] Pax)</td></tr><input type='hidden' name='pax' value='$totalpax'>
          <tr><td>Bookers</td> <td>$r[BookersName]</td></tr>
          <tr><td>Tour Code</td> <td>$r[TourCode]</td></tr><input type=hidden name='idbefore' value='$r[IDTourcode]'><input type=hidden name='turbefore' value='$r[TourCode]'><input type=hidden name='yearbefore' value='$r[Year]'>
          <tr><td>Move to</td> <td><select name='tourcode' required><option value=''>- Select -</option>";
        if ($o[GroupType] == 'CRUISE') {
            $GT = "GroupType = 'CRUISE'";
        } else {
            $GT = "GroupType <> 'CRUISE'";
        }
        $tampil = mysql_query("SELECT * FROM tour_msproduct
                            WHERE SeatSisa >= '$totalpax'
                            and Status = 'PUBLISH'
                            and (StatusProduct = 'OPEN' OR StatusProduct='GUARANTEE')
                            and DateTravelFrom >= '$hariini'
                            and TourCode <> '$r[TourCode]'
                            AND $GT
                            AND CompanyID = '$companyid'
                            ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC");
        while ($s = mysql_fetch_array($tampil)) {
            echo "<option value='$s[IDProduct]'>$s[TourCode]</option>";
        }
        echo "</select></td></tr>
          <tr><td colspan=2><center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick=location.href='?module=opbookingdetail'></td></tr>
          </table>
          </form>";
        $no = 1;
        echo "<br><br>";
        break;

    case "printvoucher":
        $qvoucher = mysql_query("SELECT * FROM tour_voucherpromo WHERE VoucherID = '$_GET[no]' ");
        $s = mysql_fetch_array($qvoucher);
        $edit = mysql_query("update tour_voucherpromo set Print='1',PrintStatus='LOCK' WHERE VoucherID = '$s[VoucherID]'");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?module=msbookingdetail&act=editdetail&code=$s[BookingID]'>";
        break;
}
?>
