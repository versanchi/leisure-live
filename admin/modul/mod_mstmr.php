<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>         
<script language="JavaScript"  type="text/javascript">  
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
function nodeal(ID)
{
    var alasan=prompt("Why your client NO DEAL ");
    if (alasan!=null && alasan!="")
{
 window.location.href = '?module=mstmr&act=nodeal&id=' + ID +'&reason='+ alasan;      
}
}
function deal(TMR)
{
var a = example.idproduct.value;
//var b = example.idpax.value;
//if(a !="" && b !=""){
if(a !=""){
    if (confirm("Confirm for Option no: "+a+", Are you sure?"))
    {
     //window.location.href = '?module=mstmr&act=deal&pop=' + a +'&hop='+ b +'&tmr='+ TMR;
        window.location.href = '?module=mstmr&act=deal&pop=' + a +'&tmr='+ TMR;
    }
}else{
    alert("Please Select Option" );     
}
}
function rejek(ID)
{
    var alasan=prompt("Why you REJECT this TMR ");
    if (alasan!=null && alasan!="")
{
 window.location.href = '?module=mstmr&act=rejek&id=' + ID +'&reason='+ alasan;      
}
}
function offbid()
{                                       
document.example.elements['bidding'].disabled=true;
document.example.elements['bidding'].value='';   
}
function onbid()
{                                      
document.example.elements['bidding'].disabled=false;  
}
function quotpage(ID)
{   window.location.href='../admin/media.php?module=msproduct&act=quotationtmr&id='+ID                                                                    
       
}
function editpage(ID,ED)
{   window.location.href='../admin/media.php?module=msproduct&act='+ED+'&id='+ID     
}
function masuk(AIR,OPT)
{                                                  
document.example.elements['pilihan'].value=AIR;
document.example.elements['harga'].value=OPT;   
}
function pilihpax()
{
    <?php
    // membaca semua data currency
    $query = "SELECT * FROM tour_msproductreq ";
    $hasil = mysql_query($query);

    // membuat if untuk masing-masing pilihan currency
    while ($data = mysql_fetch_array($hasil))
    {
      $idDest = $data['IDProduct'];
      // membuat IF untuk masing-masing currency
      echo "if (document.example.idproduct.value == \"".$idDest."\")";
      echo "{";

      // membuat hasil kurs untuk masing-masing currency
      $query2 = "SELECT * FROM tour_msproductpricetmrreq
                   WHERE ProdID = '$idDest' order by IDPrice ";
      $hasil2 = mysql_query($query2);
      $content = "document.getElementById('idpax').innerHTML = \"";

      while ($data2 = mysql_fetch_array($hasil2))
      {
          $content .= "<option value='".$data2['IDPrice']."'>".$data2['PaxFor']." Pax</option>";
      }
      $content .= "\"";
      echo $content;
      echo "}\n";
      echo "else if (document.example.idproduct.value == '0'){";

      // membuat hasil kurs untuk masing-masing currency
      $content = "document.getElementById('idpax').innerHTML = \"";
      $content .= "<option value=''></option>";

      $content .= "\"";
      echo $content;
      echo "}\n";
    }
     ?>

}
</script>
<SCRIPT type="text/javascript">
pic1 = new Image(16, 16); 
pic1.src = "./modul/loader.gif";

function cektur() {                               
var usr = $("#tourcode").val();
var tahun = $("#year").val();

if(usr.length >= 14)
{
$("#status").html('<img src="./modul/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "./modul/check.php",  
    data: { tourcode: usr ,tahun: tahun },
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

    if(msg == 'OK')
    { 
        $("#tourcode").removeClass('object_error'); // if necessary
        $("#tourcode").addClass("object_ok");
        $(this).html('&nbsp;<img src="./modul/tick.gif" align="absmiddle">');
    }  
    else  
    {  
        $("#tourcode").removeClass('object_ok'); // if necessary
        $("#tourcode").addClass("object_error");
        $(this).html(msg);
    }  
   
   });

 } 
   
  }); 

}
else
    {
    $("#status").html('<font color="red">Tour Code should have at least <strong>14</strong> characters.</font>');
    $("#tourcode").removeClass('object_ok'); // if necessary
    $("#tourcode").addClass("object_error");
    }

}

//-->
</SCRIPT>
<script type="text/javascript">
function selisih() {
var datefrom1 = example.datetravelfrom.value;
dep1 = datefrom1.split("-");
var datefrom = dep1[2]+ "/" +dep1[1]+ "/" +dep1[0];
var dateto1 = example.datetravelto.value;
dep1 = dateto1.split("-");
var dateto = dep1[2]+ "/" +dep1[1]+ "/" +dep1[0];
var a = new Date(datefrom);
var b = new Date(dateto);
var day=1000*60*60*24;
var X = Math.ceil((b.getTime()-a.getTime())/(day));
example.daystravel.value = X + 1 ;
if (isNaN(example.daystravel.value)) {
      example.daystravel.value=0   
    }   
example.showdays.value = X + 1 ;
if (isNaN(example.showdays.value)) {
      example.showdays.value=0   
    }  
example.nighttravel.value = X  ;
if (isNaN(example.nighttravel.value)) {
      example.nighttravel.value=0   
    } 
example.shownight.value = X  ;
if (isNaN(example.shownight.value)) {
      example.shownight.value=0   
    }     
}            
function turcode() {
var satu = example.productcode.value;   
var lama = example.daystravel.value;
if (lama.length==1){dua="0"+lama}
else {dua =lama}
dep = example.datetravelfrom.value; 
dep1 = dep.split("-");
var tiga = dep1[1]+ "" +dep1[2];
var empat = example.flight.value;         
example.tourcode.value = satu+"-"+ dua + " " + tiga +"/" + empat ;
cektur()
}   
function isNumber(field) {
var re = /^[0-9'.']*$/;
if (!re.test(field.value)) {
alert('PLEASE INPUT NUMBER!');
field.value = field.value.replace(/[^0-9'.']/g,"");
}
}
function keluarin(fild) {           
   
    if (fild.value=='') {
      document.getElementById('gbrtambah').style.visibility='invisible';  
}else{
        document.getElementById('gbrtambah').style.visibility='visible';     
    }
    
}
function validateConfirm(theForm) {
var reason = ""; 
  reason += validateEmpty(theForm.pilihan);     
  if (reason != "") {
    alert("Pick One:\n" + reason);
    return false;
  }

  return true;
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
function validateFormsKosong(theForm) {
var reason = ""; 
  reason += validateEmpty(theForm.comaa);
  reason += validateEmpty(theForm.comca);
  reason += validateEmpty(theForm.comcxa);
  reason += validateEmpty(theForm.comab);
  reason += validateEmpty(theForm.comcb);
  reason += validateEmpty(theForm.comcxb);
  reason += validateEmpty(theForm.comac);
  reason += validateEmpty(theForm.comcc);
  reason += validateEmpty(theForm.comcxc);
  reason += validateEmpty(theForm.discaa);
  reason += validateEmpty(theForm.discca);
  reason += validateEmpty(theForm.disccxa);
  reason += validateEmpty(theForm.discab);
  reason += validateEmpty(theForm.disccb);
  reason += validateEmpty(theForm.disccxb);
  reason += validateEmpty(theForm.discac);
  reason += validateEmpty(theForm.disccc);
  reason += validateEmpty(theForm.disccxc);     
  if (reason != "") {
    alert("Fields cannot empty:\n" + reason);
    return false;
  }

  return true;
}
function validateFormOnSubmit(theForm) {
var reason = ""; 
  reason += validateSelect(theForm.destination);         
  reason += validateDate(theForm.datetravelfrom);  
  reason += validateDateto(theForm.datetravelto);    
  reason += validateSelect(theForm.flight);
  reason += validateDateline(theForm.proposaldeadline);    
  reason += validateEmpty(theForm.company);
  reason += validatePhone(theForm.seat);
  reason += validateEmail(theForm.email);
  reason += validateEmpty(theForm.mobile);
  reason += validateEmpty(theForm.pic);
  reason += validateEmpty(theForm.address);             
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);
    return false;
  }

  return true;
}
function validateFormOptionSubmit(theForm) {
var reason = ""; 
  reason += validateSelect(theForm.destination);         
  reason += validateDate(theForm.datetravelfrom);  
  reason += validateDateto(theForm.datetravelto);    
  reason += validateSelect(theForm.flight);
  reason += validateDateline(theForm.proposaldeadline);  
  reason += validatePhone(theForm.seat);                
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
function validateCek(fld) {
    var error = "";
    var bids = example.bid.value;
    if (fld.value.length > 0 & example.bid.value == 'YES' ) {
        fld.style.background = 'Yellow'; 
        error = "The required field has not been filled in.\n"
    } else {
        fld.style.background = 'White';
    }
    return error;  
}
function validateDate(fld) {
    var error = "";
    var datefrom1 = fld.value;
    dep1 = datefrom1.split("-");
    var dep = dep1[2]+ "/" +dep1[1]+ "/" +dep1[0];
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
    var datefrom1 = fld.value;
    dep1 = datefrom1.split("-");
    var arr = dep1[2]+ "/" +dep1[1]+ "/" +dep1[0];
    var date = new Date(arr);
    var d  = date.getDate();
    var day = (d < 10) ? '0' + d : d;
    var m = date.getMonth() + 1;
    var month = (m < 10) ? '0' + m : m;
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    var arrdate = year + "/" + month + "/" + day ;

    var deps = example.datetravelfrom.value;
    dep2 = deps.split("-");
    var dep = dep2[2]+ "/" +dep2[1]+ "/" +dep2[0];
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
        error = "Please choose date(to) large than date of traveling(from).\n"
    } else {   
        fld.style.background = 'White';   
    }
    return error;  
}
function validateDateline(fld) {
    var error = "";
    var datefrom1 = fld.value;
    dep1 = datefrom1.split("-");
    var arr = dep1[2]+ "/" +dep1[1]+ "/" +dep1[0];
    var date = new Date(arr);
    var d  = date.getDate();
    var day = (d < 10) ? '0' + d : d;
    var m = date.getMonth() + 1;
    var month = (m < 10) ? '0' + m : m;
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    var arrdate = year + "/" + month + "/" + day

    var deps = example.datetravelfrom.value;
    dep2 = deps.split("-");
    var dep = dep2[2]+ "/" +dep2[1]+ "/" +dep2[0];
    var dates = new Date(dep);
    var tigahari= new Date(dates.getTime() - 3 * 24 * 60 * 60 * 1000);
    var ds  = tigahari.getDate();
    var days = (ds < 10) ? '0' + ds : ds;
    var ms = tigahari.getMonth() + 1;
    var months = (ms < 10) ? '0' + ms : ms;
    var yys = tigahari.getYear();
    var years = (yys < 1000) ? yys + 1900 : yys;
    var depdate = years + "/" + months + "/" + days;
    
    var dates1 = new Date();
    var ds1  = dates1.getDate();
    var days1 = (ds1 < 10) ? '0' + ds1 : ds1;
    var ms1 = dates1.getMonth() + 1;
    var months1 = (ms1 < 10) ? '0' + ms1 : ms1;
    var yys1 = dates1.getYear();
    var years1 = (yys1 < 1000) ? yys1 + 1900 : yys1;
    var sekarang = years1 + "/" + months1 + "/" + days1 ; 
                                      
    if (fld.value.length == 0) {
        fld.style.background = 'Yellow'; 
        error = "Deadline has not been select.\n"
    } else if (arrdate < sekarang) {
        fld.style.background = 'Yellow'; 
        error = "Please choose deadline large than today.\n"
    } else if (arrdate > depdate) {
        fld.style.background = 'Yellow'; 
        error = "Deadline min 3 days before date of traveling(from).\n"
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
function showCountry()
 {                                    
 <?php                                                   
 // membaca semua data currency
 $query = "SELECT * FROM cim_mscountry group by Region";
 $hasil = mysql_query($query);
 
 // membuat if untuk masing-masing pilihan currency 
 while ($data = mysql_fetch_array($hasil))
 {
   $idDest = $data['Region'];                                                  
   // membuat IF untuk masing-masing currency
   echo "if (document.example.destination.value == \"".$idDest."\")"; 
   echo "{";       
    
   // membuat hasil kurs untuk masing-masing currency
   $query2 = "SELECT * FROM cim_mscountry                                                   
                WHERE Region = '$idDest' group by Country ASC ";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('country').innerHTML = \"";
   $content .= "<option value='0'>- Select Country -</option>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['Country']."'>".$data2['Country']."</option>";
   }
   $content .= "\"";
   echo $content;
   echo "}\n";
   echo "else if (document.example.destination.value == '0'){";
   
   // membuat hasil kurs untuk masing-masing currency
   $content = "document.getElementById('country').innerHTML = \"";
   $content .= "<option value=''></option>";
   
   $content .= "\"";
   echo $content;
   echo "}\n";          
 }
  ?>
  }                                         
</script>
 <script type="text/javascript">
            $(document).ready(function(){
                
                //    -- Datepicker
                $(".my_date").datepicker({
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
                    $(newRow).find("input[type=checkbox]").each(function(){    
                            $(this).attr('checked', false);// remove check
                                       
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
<script type='text/javascript'>
function showRegion()
{
                                     
 <?php                                                      
 // membaca semua data currency
 $query = "SELECT * FROM tour_mscountry group by Destination ";
 $hasil = mysql_query($query);
 
 // membuat if untuk masing-masing pilihan currency 
 while ($data = mysql_fetch_array($hasil))
 {
   $idDest = $data['Destination'];                                                  
   // membuat IF untuk masing-masing currency
   echo "if (document.example.destination.value == \"".$idDest."\")"; 
   echo "{";       
    
   // membuat hasil kurs untuk masing-masing currency
   $query2 = "SELECT * FROM tour_mscountry                                                   
                WHERE Destination = '$idDest' order by Country ASC ";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('region').innerHTML = \"";
   $content .= "<option value='0'>- Select -</option>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['Country']."'>".$data2['Country']."</option>";
   }
   $content .= "\"";
   echo $content;
   echo "}\n";
   echo "else if (document.example.destination.value == '0'){";
   
   // membuat hasil kurs untuk masing-masing currency
   $content = "document.getElementById('region').innerHTML = \"";
   $content .= "<option value=''></option>";
   
   $content .= "\"";
   echo $content;
   echo "}\n";          
 }
  ?>
  }
function lookup(inputString) {
    if(inputString.length == 0) {
        // Hide the suggestion box.
        $('#suggestions').hide();
    } else {
        $.post("../admin/modul/desc.php", {queryString: ""+inputString+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // lookup

function fill(thisValue) {
    $('#inputString').val(thisValue);
    setTimeout("$('#suggestions').hide();", 200);
}

function hapus()
{
        document.getElementById("inputString").value = "";
    }
</script>
<style type="text/css">
    .suggestionsBox { background:url(../config/shadow.png) no-repeat bottom right;  position:auto; top:0px; left:0px; margin: auto; /* IE6 fix: */ _background:none; _margin:1px 0 0 0;  }
    .suggestionList { border:1px solid #999; background:#FFF;  cursor:default;padding-left:5px;padding-right: 5px; text-align:left ;font-size:12;  max-height:350px; overflow:auto; margin: 0px 6px 6px 0px; /* IE6 specific: */ _height:350px;  _margin:0; _overflow-x:hidden; }
    .sugestionList div { padding:2px 5px; white-space:nowrap; } 
    .suggestionList li {   
        margin: 0px 0px 3px 0px;
        padding: 0px;
        cursor: pointer;
    }  
    .suggestionList li:hover {
        background-color: #fd6205;
    }
</style>
<?php   
$username=$_SESSION['employee_code'];
$sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_code='$username'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName=$tampiluser['employee_name'];
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
switch($_GET['act']){
  // Tampil Office
  default:
      $nama=$_GET['nama'];
    echo "<h2>TMR Request</h2>";
          $oke=$_GET['oke'];
          $hari = date("Y-m-d", time());
          // Langkah 1
          $filt=mysql_query("SELECT * FROM tbl_msemployee   
                                left join tbl_msoffice on tbl_msoffice.office_id=tbl_msemployee.office_id
                                WHERE tbl_msemployee.employee_code = '$_SESSION[employee_code]'");
          $filter=mysql_fetch_array($filt);
          $team=$filter[office_code];
          $statue=$_GET['statue'];
          $batas = 10;
          $halaman= $_GET['halaman'];
          if(empty($halaman)){
              $posisi  = 0;
            $halaman = 1;
          } else {
              $posisi = ($halaman-1) * $batas; }
            if($team <> 'LTM' or $team<>'LTM TMR'){
            echo"<input type=button value='NEW TMR' onclick=location.href='?module=mstmr&act=tmrrequest'>";
            }
            // Langkah 2   AND DateTravelFrom > '$hari' 
            echo"  
            <form method='get' action='media.php?'>
            </br><font size=2>Status:</font>
            <input type=hidden name=module value='mstmr'> 
              <select name='statue'><option value=''";if($statue==''){echo"selected";}echo">- ALL -</option>
                                    <option value='REQUEST'";if($statue=='REQUEST'){echo"selected";}echo">Request</option>
                                    <option value='NEED CONFIRM'";if($statue=='NEED CONFIRM'){echo"selected";}echo">Need Confirm</option>
                                    <option value='CONFIRM'";if($statue=='CONFIRM'){echo"selected";}echo">Confirm</option>
                                    <option value='CANCEL'";if($statue=='CANCEL'){echo"selected";}echo">Cancel</option>
                                    <option value='REJECT'";if($statue=='REJECT'){echo"selected";}echo">Reject</option>
                                    <option value='EXPIRED'";if($statue=='EXPIRED'){echo"selected";}echo">Expired</option>
            </select> <input type=submit name='oke' size='20'value='View'>
            </form>";
            if($statue==''){$g="";}else{$g="AND Status = '$statue'";}  
            if($team=='IFM' or $team=='LTM' or $team=='LTM TMR'){
            $tampil1=mysql_query("SELECT distinct TmrNo FROM tour_mstmrreq                                                           
                                WHERE (ProductFor LIKE '%$nama%'
                                or TmrNo LIKE '%$nama%')
                                AND DateTravelFrom > '$hari' 
                                AND Status <> 'VOID'
                                $g           
                                ORDER BY TmrNo DESC,TmrOption ASC LIMIT $posisi,$batas");
            }else{
            $tampil1=mysql_query("SELECT distinct TmrNo FROM tour_mstmrreq                                                           
                                WHERE (ProductFor LIKE '%$nama%' 
                                or TmrNo LIKE '%$nama%')
                                AND DateTravelFrom > '$hari'
                                AND Status <> 'VOID' 
                                and (ProductFor = '$team' or ProductFor = 'ALL')          
                                $g
                                ORDER BY IDTmr DESC,TmrOption ASC LIMIT $posisi,$batas");    
            }
            $jumlah=mysql_num_rows($tampil1);
            
            if ($jumlah > 0) {
            echo "<table class='bordered'>
                    <tr><th>no</th><th>Tmr No</th><th>Option</th><th>destination</th><th>days</th><th>departure</th><th>flight</th><th>seat</th><th>tc</th><th>boso</th><th>status</th><th>action</th><th>Tour Code/Booking ID</th>";if($team<>'LTM'){echo"<th>action</th>";}echo"</tr>"; 
                  $no=$posisi+1;
                    while ($data1=mysql_fetch_array($tampil1)){
                        if($team=='IFM' or $team=='LTM' or $team=='LTM TMR'){
                        $tampil=mysql_query("SELECT * FROM tour_mstmrreq                                                           
                                WHERE (ProductFor LIKE '%$nama%' 
                                or TmrNo LIKE '%$nama%')
                                AND DateTravelFrom > '$hari'
                                AND Status <> 'VOID'  AND TmrNo= $data1[TmrNo]            
                                $g 
                                ORDER BY IDTmr ASC,TmrOption ASC ");
                        }else{
                        $tampil=mysql_query("SELECT * FROM tour_mstmrreq                                                           
                                WHERE (ProductFor LIKE '%$nama%' 
                                or TmrNo LIKE '%$nama%')
                                AND DateTravelFrom > '$hari'
                                AND Status <> 'VOID'  AND TmrNo= $data1[TmrNo]
                                and (ProductFor = '$team' or ProductFor = 'ALL')          
                                $g 
                                ORDER BY IDTmr ASC,TmrOption ASC ");    
                        } 
                         $jum=mysql_num_rows($tampil);        
                        
                     while ($data=mysql_fetch_array($tampil)){
                    $con=strtotime($data[InputDate]);
                    $tglin=date("Y-m-d", $con);   
                    $timeStamp = strtotime($hari);
                    $timeStamp += 24 * 60 * 60 * 7;
                    $minggudpn = date("Y-m-d", $timeStamp);
                    $duamglalu = strtotime($hari);
                    $duamglalu -= 24 * 60 * 60 * 14;
                    $duaminggu = date("Y-m-d", $duamglalu);
                    $deadline= $data[ProposalDeadline]; 
                    //color
                    if($deadline < $hari OR $data[Status]=='REJECT' OR $data[Status]=='CANCEL')
                    {$warna="BGCOLOR='grey'";$rbl="";}
                    else if($deadline < $minggudpn and $deadline > $hari){$warna="BGCOLOR='yellow'";$rbl="";}  
                    else if($data[Status]=='REQUEST' and $tglin <= $duaminggu)
                    {$warna="BGCOLOR='red'";$rbl="<blink>";}
                    else
                    {$warna="BGCOLOR='white'";$rbl="";}
                    //bold
                    if($hari==$tglin AND $data[Status]=='REQUEST'){$bl="<b>";}else{$bl="";}
                    
                    if(($data[Status]=='NEED CONFIRM' OR $data[Status]=='REQUEST')AND $deadline >= $hari){$tom='enabled';}else{$tom='disabled';}
                    if($data[Status]=='CONFIRM'){
                    $cek=mysql_query("SELECT * FROM tour_msproduct                                                               
                                WHERE TmrNo = '$data[TmrNo]' 
                                AND Status <> 'VOID'        
                                ORDER BY DateTravelFrom ASC");    
                    }else{
                    $cek=mysql_query("SELECT * FROM tour_msproductreq                                                               
                                WHERE TmrNo = '$data[IDTmr]' 
                                AND Status <> 'VOID'           
                                ORDER BY DateTravelFrom ASC");
                    }
                    $fain=mysql_fetch_array($cek);
                    $totalseat=$data[Seat]+$data[SeatChild];
                    $datetr = date("d M Y", strtotime($data[DateTravelFrom]));
                    $cekitin=mysql_query("SELECT * FROM tour_msproductpricetmrreq WHERE ProdID = '$fain[IDProduct]'");
                    $adaharga=mysql_num_rows($cekitin);
                         /*if($adaharga>0){$bkitin="<a href=?module=mstmr&group=4&act=show&id=$fain[TmrNo]>Confirm Quotation</a>";}else{$bkitin="On Process";}
                         */
                         $bkitin="<a href=?module=mstmr&group=4&act=showpdf&id=$data[IDTmr]>Confirm Quotation</a>";
                         echo "<tr>";
                if($lastTMR<>$data[TmrNo]){
               echo "<td rowspan='$jum' style=vertical-align:middle>$rbl$no</td>
                      <td rowspan='$jum' style=vertical-align:middle>$bl$rbl<center>$data[TmrNo]</td>";
                      $no++;}
                      
               echo "<td $warna>$bl$rbl<center>$data[TmrOption]</td>
                     <td $warna>$bl$rbl<center>$data[Destination]</td>    
                     <td $warna>$bl$rbl<center>$data[DaysTravel]</td>
                     <td $warna>$bl$rbl$datetr</td>
                     <td $warna>$bl$rbl<center>$data[Flight]</td>
                     <td $warna>$bl$rbl<center>$totalseat</td>
                     <td $warna>$bl$rbl<center>$data[InputBy]</td>
                     <td $warna>$bl$rbl<center>$data[ProductFor]</td>   
                     <td $warna>$bl$rbl<center>$data[Status]</td>            
                     <td $warna>$bl$rbl<center><a href=?module=mstmr&act=showtmr&no=$data[IDTmr]>view</a></td>
                     <td $warna>$bl<center>";
                     if($data[Status]=='REJECT' OR $data[Status]=='CANCEL'){
                     echo"<i>$data[ReasonNodeal]</i>";    
                     }else{
                         if($data[BookingID]<>'' AND $fain[TmrNo]<>''){
                             $turkod= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($fain[TourCode]) ) ) ); 
                             if($fain[DateTravelFrom] < $hari){
                             echo"$data[BookingID]";    
                             }else{
                                 if($team<>'LTM' or $team<>'LTM TMR'){    
                                    echo"<a href=?module=msbookingdetail&act=editdetail&code=$data[BookingID]>$data[BookingID]</a>";
                                }else{
                                    echo"$data[BookingID]";
                                }                       
                             }
                         //}else if($data[BookingID]=='' AND $fain[TmrNo]<>''){
                         }
                            if($data[Status]=='NEED CONFIRM'){
                                if($team<>'LTM' or $team<>'LTM TMR'){    
                                    echo"$bkitin";
                                }else{
                                    echo"Confirm Quotation";
                                }                                       
                            }else if($data[Status]=='CONFIRM'){
                            if($fain[Status]=='NOT PUBLISHED' OR $fain[Season]==''){
                            echo"ON PROCESS";    
                            }else{
                                if($team<>'LTM' or $team<>'LTM TMR'){    
                                    echo"<a href=?module=msbooking&group=4&act=show&id=$fain[IDProduct]>$fain[TourCode]</a>";
                                }else{
                                    echo"$fain[TourCode]";
                                }
                            }
                            }
                             //}
                             else if($data[Status]=='REQUEST'){
                                 if($deadline < $hari){
                                 mysql_query("UPDATE tour_mstmrreq SET Status = 'EXPIRED'
                                   WHERE IDTmr = '$data[IDTmr]'");
                                 echo"REQUEST EXPIRED";
                                 }else{
                                 echo"<blink>NEW REQUEST</blink>";
                                 }
                             }else if($data[Status]=='EXPIRED'){
                             echo"REQUEST EXPIRED";
                             }else{
                                 echo"ON PROGRESS";
                             }
                     }
               echo "</td>";
                      if($team<>'LTM' or $team<>'LTM TMR'){    
                          echo"<td $warna><input type=button value='New Option' onclick=location.href='?module=mstmr&act=tmroption&tmrno=$data[TmrNo]' $tom></td></tr>";
                      }
                      $lastTMR=$data[TmrNo];
                    }
                }// batas while per TmrNo    
                    echo "</table>";
                    
                    // Langkah 3            
                    if($team=='IFM' or $team=='LTM' or $team=='LTM TMR'){
                    $tampil2="SELECT * FROM tour_mstmrreq                                                           
                                        WHERE (ProductFor LIKE '%$nama%' 
                                        or TmrNo LIKE '%$nama%')
                                        AND Status <> 'VOID'
                                        AND DateTravelFrom > '$hari'           
                                        $g
                                        Group by TmrNo
                                        ORDER BY IDTmr DESC";
                    }else{
                    $tampil2="SELECT * FROM tour_mstmrreq                                                           
                                        WHERE (ProductFor LIKE '%$nama%' 
                                        or TmrNo LIKE '%$nama%')
                                        AND Status <> 'VOID'
                                        AND DateTravelFrom > '$hari' 
                                        and (ProductFor = '$team' or ProductFor = 'ALL')          
                                        $g
                                        Group by TmrNo
                                        ORDER BY IDTmr DESC";    
                    }                      
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=mstmr";
                    // Link ke halaman sebelumnya (previous)
                    echo "<center><div id='paging'>";
                    if ($halaman >1) {
                        $previous = $halaman-1;
                        echo "<a href=$file&halaman=1&nama=$nama&statue=$statue&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&nama=$nama&statue=$statue&oke=$oke> < Previous</a> | ";
                    } else {
                        echo "<< First | < Previous | ";
                    }
                    // Tampilkan link halaman 1,2,3 ... modifikasi ala google
                    // Angka awal
                    $angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
                    for ($i=$halaman-2; $i<$halaman; $i++) {
                        if ($i < 1 )
                            continue;
                        $angka .= "<a href=$file&halaman=$i&nama=$nama&statue=$statue&oke=$oke>$i</a> ";
                    }
                    // Angka tengah
                    $angka .= " <b>$halaman</b> ";
                    for ($i=$halaman+1; $i<($halaman+3); $i++) {
                        if ($i > $jmlhalaman)
                            break;
                        $angka .= "<a href=$file&halaman=$i&nama=$nama&statue=$statue&oke=$oke>$i</a> ";    
                    }
                    // Angka akhir
                    $angka .= ($halaman+2<$jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&nama=$nama&statue=$statue&oke=$oke>$jmlhalaman</a> |" : " ");
                    // Cetak angka seluruhnya (awal, tengah, akhir)
                    echo "$angka";
                    // Link ke halaman berikutnya (Next)
                    if ($halaman < $jmlhalaman) {
                        $next = $halaman+1;
                        echo "<a href=$file&halaman=$next&nama=$nama&statue=$statue&oke=$oke> Next ></a> |
                              <a href=$file&halaman=$jmlhalaman&nama=$nama&statue=$statue&oke=$oke> Last >></a> ";
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
  
  case "tmrrequest":
          $cari=mysql_query("SELECT tbl_msoffice.office_key,tbl_msoffice.office_code,tbl_msemployee.employee_name FROM tbl_msemployee left join tbl_msoffice on tbl_msemployee.office_id = tbl_msoffice.office_id WHERE employee_code = '$_SESSION[employee_code]'");
          $staff=mysql_fetch_array($cari);  
          $thisyear = date("Y");
          $nextyear = $thisyear+1;
    echo "<h2>TMR Request</h2>
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=mstmr&act=input'>
          <table class='bordered'>
          <tr><th colspan=2>contact info (client)</th></tr>
          <tr><td>Company Name</td> <td><input type=text name='company'></td></tr>
          <tr><td>PIC</td> <td><input type=text name='pic'></td></tr>    
          <tr><td>Address</td><td><textarea name='address' cols='50' rows='3'></textarea>  </td></tr>
          <tr><td>Email</td> <td><input type=text name='email'></td></tr>
          <tr><td>Handphone</td> <td><input type=text name='mobile'></td></tr>
          <tr><th colspan=2>product info (request)</th></tr>                     
          <tr><td>Request for</td><td>
          <input type=radio name='department' value='LEISURE' checked>&nbsp;Leisure
          <input type=radio name='department' value='MINISTRY'>&nbsp;Ministry
          <input type=radio name='department' value='TUREZ'>&nbsp;Tur EZ
          </td></tr>
          <tr><td>BSO Request</td>  <td>  
          <select name='productfor'>";
            $tampil=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name");
            while($r=mysql_fetch_array($tampil)){
              if($staff[office_code]==$r[office_code]){
                 echo "<option value='$r[office_code]' selected>$r[office_code]</option>";    
              }
            } 
          /*  $tampil=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[office_code]'>$r[office_code]</option>";    <select name='city' id='city'>
            } */
    echo "</select></td></tr>                                      
          
          <tr><td>Date of Travelling</td> <td>From <input type='text' name='datetravelfrom' size='10' onfocus='selisih()' onClick="."cal.select(document.forms['example'].datetravelfrom,'ActIn1','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(dd-mm-yyyy)</font>
          - To <input type=text name='datetravelto' size='10' onfocus='selisih()' onClick="."cal.select(document.forms['example'].datetravelto,'anchor2','dd-MM-yyyy'); return false;"." NAME='anchor2' ID='anchor2'>
           <font color='red'>(dd-mm-yyyy)</font></td></tr>
           <tr><td>Number of Days</td> <td><input type='hidden' name='daystravel' id='daystravel'><input type=text name='showdays' id='showdays' size='2' size='3' style='text-align: center;border: 0px solid #000000;' readonly> Days 
            <input type='hidden' name='nighttravel' id='nighttravel'><input type='hidden' name='shownight' id='shownight' size='2' size='3' style='text-align: center;border: 0px solid #000000;' readonly></td></tr>   
          <tr><td>Destination</td> <td><select name='destination' onChange='showCountry()'>
            <option value='0' selected>- Select Destination -</option>";
            $tampil=mysql_query("SELECT * FROM cim_mscountry                                                
                                group by Region
                                order by Region ASC");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[Region]'>$r[Region]</option>";
            }
    echo "</select></td></tr>    
          <tr><td>Prefered Airlines</td> <td><input type='text' name='flight'></td></tr>";                                                                                                            
          /*<select name='flight'>
            <option value='0' selected>- Select Airlines -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msairlines ORDER BY AirlinesID");
            if(isset($_POST['redirected'])) { $flightb=$_POST['flight']; }
            while($r=mysql_fetch_array($tampil)){
                if($flightb==$r[AirlinesID]){
                    echo "<option value='$r[AirlinesID]' selected>$r[AirlinesID] - $r[AirlinesName]</option>";    
                }else{
                    echo "<option value='$r[AirlinesID]'>$r[AirlinesID] - $r[AirlinesName]</option>";
                }
                
            }            
    echo "</select>*/echo"
          <tr><td>Total Participant</td> <td><input type='text' name='seat' size='3' onkeyup='isNumber(this)'> Adult <input type='text' name='seatchild' size='3' onkeyup='isNumber(this)'> Child <input type='text' name='seatinfant' size='3' onkeyup='isNumber(this)'> Infant</td></tr>
          
          <tr><td>Approx Budget</td> <td><select name='budgetcurr'>
          
          <option value='IDR' selected>IDR</option>
          
    	  </select> <input type=text name='budget' size='6'> / Pax</td></tr>
          <tr><td>Level of Service</td> <td><select name='levelservice'>
          <option value='HIGH'>High</option>
          <option value='MED' selected>Med</option>
          <option value='LOW'>Low</option>     
          </select></td></tr>
          <tr><td>Hotel Category</td> <td>      
          <select name='hotelcategory'>     
          <option value='THREE STAR'>3 star</option>
          <option value='FOUR STAR'>4 star</option>
          <option value='FIVE STAR'>5 star</option>  
          </select></td></tr>
                   
          <tr><td>Tour Leader</td> <td>";   
          if(isset($_POST['redirected'])) { $tourleaderincb=$_POST['tourleaderinc']; }
          if($tourleaderincb=='NO'){$b='checked';}
          else if($tourleaderincb=='YES'){$a='checked';}
          else if($tourleaderincb=='BOTH'){$c='checked';}
          else {$a='checked';}
    echo "<input type=radio name='tourleaderinc' value='NO' $b>&nbsp;No
          <input type=radio name='tourleaderinc' value='YES' $a>&nbsp;Yes
          <input type=radio name='tourleaderinc' value='BOTH' $c>&nbsp;Both   
          </td></tr>
          <tr><td>Insurance</td> <td>";   
          if(isset($_POST['redirected'])) { $insuranceb=$_POST['insurance']; }
          if($insuranceb=='INCLUDE'){$a='checked';}else{$b='checked';}
    echo "<input type=radio name='insurance' value='INCLUDE' $a>&nbsp;Include
          <input type=radio name='insurance' value='NOT INCLUDE' $b>&nbsp;Not Include  
          </td></tr>                             
          <tr><td>Proposal Deadline</td> <td><input type=text name='proposaldeadline' size='10' onClick="."cal.select(document.forms['example'].proposaldeadline,'anchor3','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='anchor3'>
           <font color='red'>(dd-mm-yyyy)</td></tr>
          <tr><td>Special Request</td><td><textarea name='specialrequest' cols='50' rows='3'></textarea>  </td></tr>
          <tr><td>Bidding</td> <td>
          <input type=radio name='bidding' value='NO' checked>&nbsp;No
          <input type=radio name='bidding' value='YES'>&nbsp;Yes </td></tr>
          <input type='hidden' name='status' value='REQUEST'>                              
          </table>
          <table class='bordered' id='competitor' border='1'>
          <tr>
          <td>Competitor &nbsp&nbsp&nbsp&nbsp<img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' />&nbsp</td>
          <td><img src='../images/add.png' class='cloneTableRows' /> &nbsp <select name='competitor[]' >
              <option value='0' selected>- Select Competitor -</option>";
          $tampil=mysql_query("SELECT * FROM cim_mscompetitor where Status='active' ORDER BY CompetitorID ASC");
          while($w=mysql_fetch_array($tampil)){
              echo "<option value='$w[CompetitorID]'>$w[CompetitorID] : $w[Competitor]</option>";

          }
          echo "</select></td>
          </tr>
          </table>";
          /*
          <table class='bordered' id='countrys' border='1'>
          <tr>
          <td width=105>Country  &nbsp&nbsp <img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' />&nbsp</td>
          <td><img src='../images/add.png' class='cloneTableRows' /> &nbsp <select name='country[]' id='country'></select></td>
          </tr>
          </table>*/
          echo"
          <table class='bordered' id='itin' border='1'>
          <tr><th colspan=3></th><th>service</th><th colspan=3>meals</th><th></th></tr>
          <tr><th><img src='../images/add.png' id='gbrtambah' class='cloneTableRows' style='visibility: hidden;'/></th><th>day</th><th>route</th><th>(transfer, tour, meeting, optional)</th><th>b</th><th>l</th><th>d</th><th>remarks</th></tr>
          <tr>
          <td><img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' />&nbsp</td>
          <td><input type=text name='day[]' size='2' onkeyup='isNumber(this),keluarin(this)'></td>   
          <td><textarea name='route[]' cols='20' rows='2' onkeyup='keluarin(this)'></textarea></td>
          <td><textarea name='service[]' cols='40' rows='2' onkeyup='keluarin(this)'></textarea></td>
          <td><select name='b[]' >                                          
          <option value='' selected>NO</option>
          <option value='BREAKFAST'>YES</option>
          </select></td>
          <td><select name='l[]' >                                          
          <option value='' selected>NO</option>
          <option value='LUNCH'>YES</option>
          </select></td>
          <td><select name='d[]' >                                         
          <option value='' selected>NO</option>
          <option value='DINNER'>YES</option> 
          </select></td>
          <td><textarea name='remarks[]' cols='40' rows='2'></textarea></td>
          </tr>
          </table>       
          <center><input type='submit' name='submit' value=Save><input type=button value=Cancel onclick=self.history.back()> 
          </form>
          <br><br>";
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
            <tr><td></td><td>TAX &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type=text name='sellingtax' size='10'></td>
            <td><select name='datedate[]' >
                      <option value='01'>01</option>
                      <option value='02'>02</option><option value='03'>03</option>
                      <option value='04'>04</option><option value='05'>05</option>
                      <option value='06'>06</option><option value='07'>07</option>
                      <option value='08'>08</option><option value='09'>09</option>
                      <option value='10'>10</option><option value='11'>11</option>
                      <option value='12'>12</option><option value='13'>13</option>
                      <option value='14'>14</option><option value='15'>15</option>
                      <option value='16'>16</option><option value='17'>17</option>
                      <option value='18'>18</option><option value='19'>19</option>
                      <option value='20'>20</option><option value='21'>21</option>
                      <option value='22'>22</option><option value='23'>23</option>
                      <option value='24'>24</option><option value='25'>25</option>
                      <option value='26'>26</option><option value='27'>27</option>
                      <option value='28'>28</option><option value='29'>29</option>
                      <option value='30'>30</option><option value='31'>31</option>
                      </select>
                      <select name='datemonth[]' >
                      <option value='JAN'>JAN</option>
                      <option value='FEB'>FEB</option><option value='MAR'>MAR</option><option value='APR'>APR</option>
                      <option value='MAY'>MAY</option><option value='JUN'>JUN</option><option value='JUL'>JUL</option>
                      <option value='AUG'>AUG</option><option value='SEP'>SEP</option><option value='OCT'>OCT</option>
                      <option value='NOV'>NOV</option><option value='DEC'>DEC</option>
                      </select></td>
                      </tr>  */ 
                      
  case "tmroption":
          $cari=mysql_query("SELECT tbl_msoffice.office_key,tbl_msoffice.office_code,tbl_msemployee.employee_name FROM tbl_msemployee left join tbl_msoffice on tbl_msemployee.office_id = tbl_msoffice.office_id WHERE employee_code = '$_SESSION[employee_code]'");
          $staff=mysql_fetch_array($cari);    
          $thisyear = date("Y");
          $nextyear = $thisyear+1;
          $tmrno = $_GET[tmrno];
          $qhist=mysql_query("SELECT * FROM tour_mstmrreq WHERE TmrNo = '$tmrno' and TmrOption ='1' ");
          $hist=mysql_fetch_array($qhist);
          $DTF = date('d-m-Y', strtotime($hist[DateTravelFrom]));
          $DTT = date('d-m-Y', strtotime($hist[DateTravelTo]));
          $PD = date('d-m-Y', strtotime($hist[ProposalDeadline]));
    echo "<h2>TMR $tmrno Option Request</h2>
          <form name='example' method='POST' onsubmit='return validateFormOptionSubmit(this)' action='./aksi.php?module=mstmr&act=inputoption'>
          <table>
          <input type='hidden' value='$tmrno' name='tmrno'>
          <tr><th colspan=2>contact info (client)</th></tr>
          <tr><td>Company Name</td> <td>$hist[CompanyName]</td></tr>
          <tr><td>PIC</td> <td>$hist[Pic]</td></tr>    
          <tr><td>Address</td><td><textarea name='address' cols='50' rows='3' readonly>$hist[Address]</textarea>  </td></tr>
          <tr><td>Email</td> <td>$hist[Email]</td></tr>
          <tr><td>Handphone</td> <td>$hist[Mobile]</td></tr> 
          <tr><th colspan=2>product info (request)</th></tr>                     
          <tr><td>Request for</td><td>
          <input type=radio name='department' value='LEISURE'";if($hist[Department]=='LEISURE'){echo"checked";}echo">&nbsp;Leisure
          <input type=radio name='department' value='MINISTRY'";if($hist[Department]=='MINISTRY'){echo"checked";}echo">&nbsp;Ministry
          <input type=radio name='department' value='TUREZ'";if($hist[Department]=='TUREZ'){echo"checked";}echo">&nbsp;Tur EZ
          </td></tr>                                         
          <tr><td>BSO Request</td>  <td>$hist[ProductFor]  
          </td></tr>    
          <tr><td>Date of Travelling</td> <td>From <input type='text' name='datetravelfrom' value='$DTF' size='10' onfocus='selisih()' onClick="."cal.select(document.forms['example'].datetravelfrom,'ActIn1','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(dd-mm-yyyy)</font>
          - To <input type=text name='datetravelto' value='$DTT' size='10' onfocus='selisih()' onClick="."cal.select(document.forms['example'].datetravelto,'anchor2','dd-MM-yyyy'); return false;"." NAME='anchor2' ID='anchor2'>
           <font color='red'>(dd-mm-yyyy)</font></td></tr>
           <tr><td>Number of Days</td> <td><input type='hidden' name='daystravel' id='daystravel' value='$hist[DaysTravel]'><input type=text name='showdays' id='showdays' size='2' value='$hist[DaysTravel]' style='text-align: center;border: 0px solid #000000;' readonly> Days 
            <input type='hidden' name='nighttravel' id='nighttravel'><input type='hidden' name='shownight' id='shownight' size='2' size='3' style='text-align: center;border: 0px solid #000000;' readonly></td></tr>   
          <tr><td>Destination</td> <td><select name='destination' onChange='showCountry()'>
            <option value='0' selected>- Select Destination -</option>";
            $tampil=mysql_query("SELECT * FROM cim_mscountry                                                
                                group by Region
                                order by Region ASC");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[Region]'>$r[Region]</option>";
            }
    echo "</select></td></tr>    
          <tr><td>Prefered Airlines</td> <td><input type='text' name='flight' value='$hist[Flight]'></td></tr>                                                                                                            
          <tr><td>Total Participant</td> <td><input type='text' name='seat' value='$hist[Seat]' size='3' onkeyup='isNumber(this)'> Adult <input type='text' name='seatchild' value='$hist[SeatChild]' size='3' onkeyup='isNumber(this)'> Child <input type='text' name='seatinfant' value='$hist[SeatInfant]' size='3' onkeyup='isNumber(this)'> Infant</td></tr>
          <tr><td>Approx Budget</td> <td><select name='budgetcurr'>
                 <option value='IDR' selected>IDR</option>
                </select> <input type=text name='budget' value='$hist[Budget]' size='6'> / Pax</td></tr>
          <tr><td>Level of Service</td> <td><select name='levelservice'>
          <option value='HIGH'";if($hist[LevelService]=='HIGH'){echo"selected";}echo">High</option>
          <option value='MED'";if($hist[LevelService]=='MED'){echo"selected";}echo">Med</option>
          <option value='LOW'";if($hist[LevelService]=='LOW'){echo"selected";}echo">Low</option>     
          </select></td></tr>
          <tr><td>Hotel Category</td> <td>      
          <select name='hotelcategory'>
          <option value='THREE STAR'";if($hist[HotelCategory]=='THREE STAR'){echo"selected";}echo">3 star</option>
          <option value='FOUR STAR'";if($hist[HotelCategory]=='FOUR STAR'){echo"selected";}echo">4 star</option>
          <option value='FIVE STAR'";if($hist[HotelCategory]=='FIVE STAR'){echo"selected";}echo">5 star</option>  
          </select></td></tr>                        
          <tr><td>Tour Leader</td> <td>";   
          if($hist[TourLeaderInc]=='NO'){$b='checked';}
          if($hist[TourLeaderInc]=='YES'){$a='checked';}
          if($hist[TourLeaderInc]=='BOTH'){$c='checked';}   
    echo "<input type=radio name='tourleaderinc' value='NO' $b>&nbsp;No
          <input type=radio name='tourleaderinc' value='YES' $a>&nbsp;Yes
          <input type=radio name='tourleaderinc' value='BOTH' $c>&nbsp;Both   
          </td></tr>
          <tr><td>Insurance</td> <td>";   
          
          if($hist[Insurance]=='INCLUDE'){$ii='checked';}else{$in='checked';}
    echo "<input type=radio name='insurance' value='INCLUDE' $ii>&nbsp;Include 
          <input type=radio name='insurance' value='NOT INCLUDE' $in>&nbsp;Not Include  
          </td></tr>                             
          <tr><td>Proposal Deadline</td> <td><input type=text name='proposaldeadline' size='10' value='$PD' onClick="."cal.select(document.forms['example'].proposaldeadline,'anchor3','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='anchor3'>
           <font color='red'>(dd-mm-yyyy)</td></tr>
          <tr><td>Special Request</td><td><textarea name='specialrequest' cols='50' rows='3'>$hist[SpecialRequest]</textarea>  </td></tr>
          <tr><td>Bidding</td> <td> $hist[Bidding]</td></tr>
          <input type='hidden' name='status' value='REQUEST'>    
          </table>
          <table class='bordered' id='competitor' border='1'>
          <tr>
          <td>Competitor &nbsp&nbsp&nbsp&nbsp<img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' />&nbsp</td>
          <td><img src='../images/add.png' class='cloneTableRows' /> &nbsp <select name='competitor[]' >
              <option value='0' selected>- Select Competitor -</option>";
          $tampil=mysql_query("SELECT * FROM cim_mscompetitor where Status='active' ORDER BY CompetitorID ASC");
          while($w=mysql_fetch_array($tampil)){
              echo "<option value='$w[CompetitorID]'>$w[CompetitorID] : $w[Competitor]</option>";

          }
          echo "</select></td>
          </tr>
          </table>

          <table  id='itin' border='1'>   
          <tr><th colspan=3></th><th>service</th><th colspan=3>meals</th><th></th></tr>
          <tr><th><img src='../images/add.png' id='gbrtambah' class='cloneTableRows' style='visibility: hidden;'/></th><th>day</th><th>route</th><th>(transfer, tour, meeting, optional)</th><th>b</th><th>l</th><th>d</th><th>remarks</th></tr>
          <tr>
          <td><img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' />&nbsp</td>
          <td><input type=text name='day[]' size='2' onkeyup='isNumber(this),keluarin(this)'></td>   
          <td><textarea name='route[]' cols='20' rows='2' onkeyup='keluarin(this)'></textarea></td>
          <td><textarea name='service[]' cols='40' rows='2' onkeyup='keluarin(this)'></textarea></td>
          <td><select name='b[]' >                                          
          <option value='' selected>NO</option>
          <option value='BREAKFAST'>YES</option>
          </select></td>
          <td><select name='l[]' >                                          
          <option value='' selected>NO</option>
          <option value='LUNCH'>YES</option>
          </select></td>
          <td><select name='d[]' >                                         
          <option value='' selected>NO</option>
          <option value='DINNER'>YES</option> 
          </select></td>
          <td><textarea name='remarks[]' cols='40' rows='2'></textarea></td>
          </tr>
          </table>       
          <center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick=self.history.back()> </form><br><br>";
     break;
  
  case "editmstmr":
    $edit=mysql_query("SELECT * FROM tour_mstmr WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $thisyear = date("Y");
    $nextyear = $thisyear+1;
    echo "<h2>Edit Product</h2>
          <form method=POST name='example' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=mstmr&act=update' enctype='multipart/form-data'>
          <input type=hidden name=id value='$r[IDProduct]'>
          <table>
             <tr><td>Season</td> <td>  
            <select name='season'>
            <option value='0' selected>- Select Season -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msseason ORDER BY SeasonName");
            while($s=mysql_fetch_array($tampil)){
                if($r[Season]==$s[SeasonName]){
                    echo "<option value='$s[SeasonName]' selected>$s[SeasonName]</option>";
                }else {
                    echo "<option value='$s[SeasonName]'>$s[SeasonName]</option>";    
                }
            }
    echo "</select>
            <select name='year'>
            <option value=''>Select Year</option>
            <option value='$thisyear' ";if($r[Year]=="$thisyear"){echo"selected";}echo">$thisyear</option>
            <option value='$nextyear' ";if($r[Year]=="$nextyear"){echo"selected";}echo">$nextyear</option>
            </select></td></tr>
          <tr><td>Product Type</td> <td>  <select name='producttype'>
            <option value='0' selected>- Select Type -</option>";
            $tampil=mysql_query("SELECT * FROM tour_mstmrtype ORDER BY ProducttypeName");
            while($s=mysql_fetch_array($tampil)){
                if($r[ProductType]==$s[ProducttypeName]){
                    echo "<option value='$s[ProducttypeName]' selected>$s[ProducttypeName]</option>";
                }else {
                    echo "<option value='$s[ProducttypeName]'>$s[ProducttypeName]</option>";
                }
            }
    echo "</select></td></tr>                  
            <tr><td>Handle by</td>     <td>   
            <input type=radio name='department' value='LEISURE'";if($r[Department]=='LEISURE'){echo"checked";}echo">&nbsp;Leisure
            <input type=radio name='department' value='MINISTRY'";if($r[Department]=='MINISTRY'){echo"checked";}echo">&nbsp;Ministry  
            </td></tr>
            <tr><td>Group Type</td> <td>  <select name='grouptype'>
            <option value='0' selected>- Select Type -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msgroup ORDER BY GroupName");
            while($s=mysql_fetch_array($tampil)){
                if($r[GroupType]==$s[GroupName]){ 
                    echo "<option value='$s[GroupName]' selected>$s[GroupName]</option>";
                } else {
                    echo "<option value='$s[GroupName]'>$s[GroupName]</option>";    
                }
            }
    echo "</select></td></tr>
          <tr><td>Product For</td>  <td>  <select name='productfor'>
         <option value='ALL' selected>- ALL -</option>";
         $tampils=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name");
            while($r1=mysql_fetch_array($tampils)){
                if($r[ProductFor]==$r1[office_code]){
                    echo "<option value='$r[office_code]' selected>$r[office_code]</option>";    
                }else{
                    echo "<option value='$r[office_code]'>$r[office_code]</option>";
                }
            } 
      /*  $tampil=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name");
        while($w=mysql_fetch_array($tampil)){
          if ($r[ProductFor]==$w[office_code]){
            echo "<option value=$w[office_code] selected>$w[office_code]</option>";
          } else{
            echo "<option value=$w[office_code]>$w[office_code]</option>";
          }
        }    */
    echo "</select></td></tr>
          <tr><td>Product Code/Name</td> <td>  <select name='productcode' onChange='turcode()'>
            <option value='0' selected>- Select Product -</option>";
            $tampil=mysql_query("SELECT * FROM tour_mstmrcode ORDER BY ProductcodeName");
            while($s=mysql_fetch_array($tampil)){
                if($r[ProductCode]==$s[ProductcodeName]){
                    echo "<option value='$s[ProductcodeName]' selected>$s[ProductcodeName] - $s[Productcode]</option>";
                } else {
                    echo "<option value='$s[ProductcodeName]'>$s[ProductcodeName] - $s[Productcode]</option>";    
                }
            }
    echo "</select></td></tr>    
            <tr><td>Date Travel</td> <td>From <input type='text' name='datetravelfrom' size='10' value='$r[DateTravelFrom]' onfocus='selisih()' onClick="."cal.select(document.forms['example'].datetravelfrom,'ActIn1','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(dd-mm-yyyy)</font>
          - To <input type=text name='datetravelto' size='10' value='$r[DateTravelTo]' onfocus='selisih()' onClick="."cal.select(document.forms['example'].datetravelto,'anchor2','dd-MM-yyyy'); return false;"." NAME='anchor2' ID='anchor2'>
           <font color='red'>(dd-mm-yyyy)</font></td></tr>
           <tr><td>Days of Travel</td> <td><input type=text name='daystravel' id='daystravel' size='3' value='$r[DaysTravel]' readonly> days</td></tr>   
          <tr><td>Flight</td> <td>  <select name='flight' onChange='turcode()'>
            <option value='0' selected>- Select Airlines -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msairlines ORDER BY AirlinesID");
            while($s=mysql_fetch_array($tampil)){
                if($r[Flight]==$s[AirlinesID]){
                    echo "<option value='$s[AirlinesID]' selected>$s[AirlinesID] - $s[AirlinesName]</option>";    
                }else {
                    echo "<option value='$s[AirlinesID]'>$s[AirlinesID] - $s[AirlinesName]</option>";
                }
            }
    echo "</select></td></tr>
          <tr><td>Tour Code</td> <td><input type=text name='tourcode' id='tourcode' value='$r[TourCode]'></td></tr>  
          <tr><td>Seat</td> <td><input type=text name='seat' size='3' value='$r[Seat]' onkeyup='isNumber(this)'> Pax <font color='red'>*<i>Not Include Infant and Tour leader</i></font></td></tr>
          <tr><td>Tour Leader</td> <td>   
          <input type=radio name='tourleaderinc' value='YES'";if($r[TourLeaderInc]=='YES'){echo"checked";}echo">&nbsp;Yes
          <input type=radio name='tourleaderinc' value='NO'";if($r[TourLeaderInc]=='NO'){echo"checked";}echo">&nbsp;No        
          </td></tr>
          <tr><td>Insurance</td> <td>   
          <input type=radio name='insurance' value='INCLUDE'";if($r[Insurance]=='INCLUDE'){echo"checked";}echo">&nbsp;Include
          <input type=radio name='insurance' value='NOT INCLUDE'";if($r[Insurance]=='NOT INCLUDE'){echo"checked";}echo">&nbsp;Not Include        
          </td></tr>
          <tr><td>Visa</td> <td>   
          <input type=radio name='visa' value='INCLUDE' onclick='onemb()' ";if($r[Visa]=='INCLUDE'){$bisa='enable';echo"checked";}echo">&nbsp;Include
          <input type=radio name='visa' value='NOT INCLUDE' onclick='onemb()' ";if($r[Visa]=='NOT INCLUDE'){$bisa='enable';echo"checked";}echo">&nbsp;Not Include
          <input type=radio name='visa' value='NO REQUIRED' onclick='offemb()' ";if($r[Visa]=='NO REQUIRED'){$bisa='disabled';echo"checked";}echo">&nbsp;No Required
          </td></tr>
          <tr><td></td><td><select name='embassy01' $bisa>
            <option value='0' selected>- Embassy 01 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy01]==$s[CountryID]){
                    echo "<option value='$s[CountryID]' selected>$s[Country]</option>";    
                }else {
                    echo "<option value=$s[CountryID]>$s[Country]</option>";
                }
            }
    echo "</select>&nbsp&nbsp <select name='embassy03' $bisa>
            <option value='0' selected>- Embassy 03 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy03]==$s[CountryID]){
                    echo "<option value='$s[CountryID]' selected>$s[Country]</option>";    
                }else {
                    echo "<option value=$s[CountryID]>$s[Country]</option>";
                }
            }
    echo "</select>&nbsp&nbsp <select name='embassy05' $bisa>
            <option value='0' selected>- Embassy 05 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy05]==$s[CountryID]){
                    echo "<option value='$s[CountryID]' selected>$s[Country]</option>";    
                }else {
                    echo "<option value=$s[CountryID]>$s[Country]</option>";
                }
            }
    echo "</select></td></tr>
          <tr><td></td><td><select name='embassy02' $bisa>
            <option value='0' selected>- Embassy 02 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy02]==$s[CountryID]){
                    echo "<option value='$s[CountryID]' selected>$s[Country]</option>";    
                }else {
                    echo "<option value=$s[CountryID]>$s[Country]</option>";
                }
            }
    echo "</select>&nbsp&nbsp <select name='embassy04' $bisa>
            <option value='0' selected>- Embassy 04 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy04]==$s[CountryID]){
                    echo "<option value='$s[CountryID]' selected>$s[Country]</option>";    
                }else {
                    echo "<option value=$s[CountryID]>$s[Country]</option>";
                }
            }
    echo "</select></td></tr>      
            <tr><td>Quotation</td><td>Currency <select name='quotationcurr' onchange='oncurr()'>";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            while($s=mysql_fetch_array($tampil)){
                if($s[curr]==$r[QuotationCurr]){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";    
                } else {
                     echo "<option value='$s[curr]' >$s[curr]</option>";
                }
            }
    echo "</select></td></tr> 
            <tr><td>Selling</td><td>Currency <select name='sellingcurr' onchange='oncurr()'>
			<option value='IDR' selected>IDR</option>";    
            
    if($r[QuotationCurr]==$r[SellingCurr]){$ok="disabled";}else{$ok="enabled";}
    echo "</select>&nbsp Operator <select name='sellingoperator' >
                                <option value='*' ";if($r[SellingOperator]=='*'){echo"selected";}echo"> X </option>
                                <option value='/' ";if($r[SellingOperator]=='/'){echo"selected";}echo"> : </option></select>&nbsp Rate <input type='text' name='sellingrate' size='3' value='$r[SellingRate]' onkeyup='isNumber(this)' $ok></td></tr>      </td></tr>";     
            $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[AttachmentFile]) ) ) );
    echo"<tr><td>Attachment</td><td>";if($r[AttachmentFile]<>''){
        echo"<input type='hidden' name='attachmentfile' value='$r[AttachmentFile]'>
        <a href='$r[Attachment]$file' target='_blank' style=text-decoration:none >$r[AttachmentFile]</a> &nbsp<a href=\"javascript:delattach('$r[IDProduct]','$r[AttachmentFile]')\"><font color=red>remove</font></a>";}
                                        else{echo"<input type='file' name='upload' >";
                                        }echo"</td></tr>
            <tr><td>Remarks</td><td><textarea name='remarks' cols='50' rows='3'>$r[Remarks]</textarea>  </td></tr>   
          <tr><td colspan=2><center><input type='submit' name='submit' value='Update'>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;
    
  case "editmstmrapp":
    $edit=mysql_query("SELECT * FROM tour_mstmr WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $dari = date("d M Y", strtotime($r[DateTravelFrom]));
    $sampai = date("d M Y", strtotime($r[DateTravelTo]));
    echo "<h2>Edit Product</h2>
          <form method=POST name='example' onsubmit='return validateFormsOnSubmit(this)' action='./aksi.php?module=mstmr&act=updateprod' enctype='multipart/form-data'>
          <input type=hidden name=id value='$r[IDProduct]'>
          <table>
           <tr><td>Season</td> <td>";
            $tampil=mysql_query("SELECT * FROM tour_msseason ORDER BY SeasonName");
            while($s=mysql_fetch_array($tampil)){
                if($r[Season]==$s[SeasonName]){
                    echo "$s[SeasonName]";
                }
            }
    echo " $r[Year]</td></tr>
          <tr><td>Product Type</td> <td>";
            $tampil=mysql_query("SELECT * FROM tour_mstmrtype ORDER BY ProducttypeName");
            while($s=mysql_fetch_array($tampil)){
                if($r[ProductType]==$s[ProducttypeName]){
                    echo "$s[ProducttypeName]";
                }
            }
    echo "</td></tr>                       
            <tr><td>Handle by</td><td>   
            ";if($r[Department]=='LEISURE'){echo"Leisure";}
            else if($r[Department]=='MINISTRY'){echo"Ministry";}  
    echo "</td></tr>
            <tr><td>Group Type</td> <td>";
            $tampil=mysql_query("SELECT * FROM tour_msgroup ORDER BY GroupName");
            while($s=mysql_fetch_array($tampil)){
                if($r[GroupType]==$s[GroupName]){ 
                    echo "$s[GroupName]";
                } 
            }
    echo "</select></td></tr>
          <tr><td>BSO Handler</td>  <td>";
        $tampil=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name");
        while($w=mysql_fetch_array($tampil)){
          if ($r[ProductFor]==$w[office_code]){
            echo "$w[office_code]";
          } 
        }
    echo "</select></td></tr>
          <tr><td>Product Code/Name</td> <td>";
            $tampil=mysql_query("SELECT * FROM tour_mstmrcode ORDER BY ProductcodeName");
            while($s=mysql_fetch_array($tampil)){
                if($r[ProductCode]==$s[ProductcodeName]){
                    echo "$s[ProductcodeName] - $s[Productcode]";
                } 
            }
    echo "</select></td></tr>    
            <tr><td>Date of Service</td> <td>$dari - $sampai</td></tr>
           <tr><td>Number of Days</td> <td>$r[DaysTravel] days</td></tr>   
          <tr><td>Flight</td> <td> ";
            $tampil=mysql_query("SELECT * FROM tour_msairlines ORDER BY AirlinesID");
            while($s=mysql_fetch_array($tampil)){
                if($r[Flight]==$s[AirlinesID]){
                    echo "$s[AirlinesID] - $s[AirlinesName]";    
                }
            }
    echo "</td></tr>
          <tr><td>Tour Code</td> <td>$r[TourCode] <input type='button' name='submit' value='CHANGE' onclick=PopupCenter('changer.php?id=$_GET[id]','variable',300,180)></td></tr>
          <tr><td>Seat</td> <td><input type=text name='seat' size='3' value='$r[Seat]'> Pax <font color='red'>*<i>Not Include Infant and Tour leader</i></font></td></tr>
          <tr><td>Tour Leader</td> <td>$r[TourLeaderInc]</td></tr> 
          <tr><td>Insurance</td> <td>$r[Insurance]</td></tr>
          <tr><td>Visa</td> <td>$r[Visa]
          </td></tr>
          <tr><td>Embassy 01</td><td>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy01]==$s[CountryID]){
                    echo "$s[Country]";    
                }
            }
    echo "</td></tr>
           <tr><td>Embassy 02</td><td>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy02]==$s[CountryID]){
                    echo "$s[Country]";    
                }
            }
    echo "</td></tr>
            <tr><td>Embassy 03</td><td>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy03]==$s[CountryID]){
                    echo "$s[Country]";    
                }
            }
    echo "</td></tr>
            <tr><td>Embassy 04</td><td>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy04]==$s[CountryID]){
                    echo "$s[Country]";    
                }
            }
    echo "</td></tr>
            <tr><td>Embassy 05</td><td>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy05]==$s[CountryID]){
                    echo "$s[Country]";    
                }
            }
    echo "</td></tr>      
            <tr><td>Quotation</td><td>Currency : $r[QuotationCurr]</td></tr>
            <tr><td>Selling</td><td>Currency : $r[SellingCurr] &nbsp Operator : $r[SellingOperator] &nbsp Rate : $r[SellingRate]</td></tr>";  
            $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[AttachmentFile]) ) ) ); 
    echo"<tr><td>Attachment</td><td>";if($r[AttachmentFile]<>''){echo"<input type='hidden' name='attachmentfile' value='$r[AttachmentFile]'><a href='$r[Attachment]$file' target='_blank' style=text-decoration:none >$r[AttachmentFile]</a> &nbsp<a href=\"javascript:delattachapp('$r[IDProduct]','$r[AttachmentFile]')\"><font color=red>remove</font></a>";}
                                        else{echo"<input type='file' name='upload' >";
                                        }echo"</td></tr>
            <tr><td>Remarks</td><td> $r[Remarks]</td></tr>     
          <tr><td colspan=2><center><input type='submit' name='submit' value='Update'>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;  
    
  case "deletemstmr":    
    $edit=mysql_query("DELETE FROM tour_mstmr WHERE IDProduct = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mstmr'>";   
     break;
     
  case "delattach":    
    $edit1=mysql_query("SELECT * FROM tour_mstmr WHERE IDProduct ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1);
    $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r2[AttachmentFile]) ) ) );
    $path = $r2[Attachment];
    $files = ("$path$file");
    unlink($files);
    $edit=mysql_query("UPDATE tour_mstmr set Attachment = '',AttachmentFile='' WHERE IDProduct = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mstmr&act=editmstmr&id=$_GET[id]'>";     
     break;
  
  case "delattachapp":    
    $edit1=mysql_query("SELECT * FROM tour_mstmr WHERE IDProduct ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1);
    $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r2[AttachmentFile]) ) ) );
    $path = $r2[Attachment];
    $files = ("$path$file");
    unlink($files);
    $edit=mysql_query("UPDATE tour_mstmr set Attachment = '',AttachmentFile='' WHERE IDProduct = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mstmr&act=editmstmrapp&id=$_GET[id]'>";     
     break;
     
  case "publishmstmr":    
    $edit1=mysql_query("SELECT * FROM tour_mstmr WHERE IDProduct ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1);
    if($r2[Status]=='NOT PUBLISHED'){$status="PUBLISH";$buka="OPEN";}
    else if($r2[Status]=='PUBLISH'){$status="NOT PUBLISHED";$buka="CLOSE";}             
    $edit=mysql_query("UPDATE tour_mstmr SET Status = '$status',StatusProduct = '$buka' WHERE IDProduct = '$_GET[id]'");
     $Description="$status $r2[TourCode]";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mstmr'>";   
     break;      
     
  case "showtmr":
    $edit=mysql_query("SELECT * FROM tour_mstmrreq WHERE IDTmr = '$_GET[no]'");
    $r=mysql_fetch_array($edit);
    $cek=mysql_query("SELECT * FROM tour_msproduct                                                               
                                WHERE TmrNo = '$r[TmrNo]' 
                                AND Status <> 'VOID'        
                                ORDER BY DateTravelFrom ASC");
    $oncek=mysql_fetch_array($cek);
    $prodada=mysql_num_rows($cek);
    $night=$r[DaysTravel]-1;
    if($r[HotelCategory]=='ONE STAR'){$star="<img src='../admin/images/onestar.jpg'>";}
    else if($r[HotelCategory]=='TWO STAR'){$star="<img src='../admin/images/twostar.jpg'>";}
    else if($r[HotelCategory]=='THREE STAR'){$star="<img src='../admin/images/threestar.jpg'>";}
    else if($r[HotelCategory]=='FOUR STAR'){$star="<img src='../admin/images/fourstar.jpg'>";}
    else if($r[HotelCategory]=='FIVE STAR'){$star="<img src='../admin/images/fivestar.jpg'>";}
    $DateFrom = date('d-m-Y', strtotime($r[DateTravelFrom]));
    $DateTo = date('d-m-Y', strtotime($r[DateTravelTo]));
    $Dead = date('d-m-Y', strtotime($r[ProposalDeadline]));
     //<tr><td>Itinerary</td><td><font color=red size=1><input type='button' name='submit' value='ITIN' onclick=PopupCenter('itinreq.php?id=$r[TmrNo]','TMR',920,250)>*click for detail</td></tr>

     echo"<center>
          <form method=POST name='example' action='./aksi.php?module=mstmr&act=upload' enctype='multipart/form-data'>
          <input type='hidden' name='no' value='$_GET[no]'>
          <table style='border: 0px solid #000000;'>
          <tr><td style='border: 0px solid #000000;'>
          <table class='bordered'>
          <tr><th colspan=2>product info (request) </th></tr>                     
          <tr><td width='120'>Request for</td><td width='350'>$r[Department]</td></tr>                                         
          <tr><td>BSO Request</td>  <td>$r[ProductFor]</td></tr>                                      
          <tr><td>Destination</td> <td>$r[Destination]</td></tr>
          <tr><td>Date of Travelling</td> <td>$DateFrom until $DateTo</td></tr>
          <tr><td>Number of Days</td> <td>$r[DaysTravel] Days</td></tr>   
          <tr><td>Prefered Airlines</td> <td>  $r[Flight]</td></tr>                                                                                                            
          <tr><td>Total Participant</td> <td>$r[Seat] Adult - $r[SeatChild] Child - $r[SeatInfant] Infant</td></tr>
          <tr><td>Approx Budget</td> <td>$r[BudgetCurr] $r[Budget] /pax</td></tr>
          <tr><td>Level of Service</td> <td>$r[LevelService]</td></tr>
          <tr><td>Hotel Category</td> <td>$star</td></tr>
          <tr><td>Tour Leader</td> <td>$r[TourLeaderInc]</td></tr>
          <tr><td>Insurance</td> <td>$r[Insurance]</td></tr>
          <tr><td>Proposal Deadline</td> <td>$Dead</td></tr>
          <tr><td>Special Request</td><td>$r[SpecialRequest]</td></tr>
          <tr><td>Bidding</td> <td>";if($r[Bidding]==''){}else{echo"$r[Bidding]";}echo"</td></tr>
          <tr><th colspan=2>contact info</th></tr>
          <tr><td>Company Name</td> <td>$r[CompanyName]</td></tr>
          <tr><td>PIC</td> <td>$r[Pic]</td></tr>    
          <tr><td>Address</td><td>$r[Address]</td></tr>
          <tr><td>Email</td> <td>$r[Email]</td></tr>
          <tr><td>Handphone</td> <td>$r[Mobile]</td></tr>      
          <input type='hidden' name='status' value='REQUEST'>
          </table>
          </td><td style='border: 0px solid #000000;'></td><td style='border: 0px solid #000000;'>
          <table class='bordered'>
          <tr><th colspan='7'>ITINERARY (REQUEST)</th></tr>";
          $cekitin=mysql_query("SELECT * FROM tour_mstmritinreq WHERE TmrID = '$r[TmrNo]' and Route <> '' order by IDTmritin ASC limit 1");
          $okitin=mysql_num_rows($cekitin);
          if($okitin<1){
              echo"<tr><td colspan='7'><center>NO REQUEST</td></tr>";
          }else{
     echo"<tr><th colspan=2></th><th>service</th><th colspan=3>meals</th><th></th></tr>
          <tr><th>day</th><th>route</th><th>(transfer, tour, meeting, optional)</th><th>b</th><th>l</th><th>d</th><th>remarks</th></tr>";
          $qitin=mysql_query("SELECT * FROM tour_mstmritinreq WHERE TmrID = '$r[TmrNo]'");
          while($it=mysql_fetch_array($qitin)){
     echo"<tr><td><center>$it[Day]</td>
          <td width='150'>$it[Route]</td>
          <td>$it[Service]</td>
          <td><center>";if($it[B]=='BREAKFAST'){echo"<img src='../images/done.png'>";}else{echo"<img src='../images/cancel.gif'>";}echo"</td>
          <td><center>";if($it[L]=='LUNCH'){echo"<img src='../images/done.png'>";}else{echo"<img src='../images/cancel.gif'>";}echo"</td>
          <td><center>";if($it[D]=='DINNER'){echo"<img src='../images/done.png'>";}else{echo"<img src='../images/cancel.gif'>";}echo"</td>
          <td width='200'>$it[Remarks]</td></tr>";
          }}echo"
          </table>";
          $qchoice=mysql_query("SELECT * FROM tour_msitintmrpdf
                        WHERE IDTmr = '$_GET[no]'");
          $isichoice=mysql_fetch_array($qchoice);
          $pilihanopt="ItinOption$r[OptionProduct]";
    if($r[Status]=='CONFIRM'){
   echo"  <table class='bordered'>
          <tr><th>Itinerary (CONFIRM DEAL)</th></tr>";
          $itin1= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isichoice[$pilihanopt]) ) ) );
   echo"  <tr><td><a href='$isichoice[PdfFolder]$itin1' target='_blank' style=text-decoration:none >$isichoice[$pilihanopt]</a></td></tr>
          </table>";
            }
   echo"  </table>
          <center>
          <input type=button value=Close onclick=location.href='?module=mstmr'>";
          $employee_code=$_SESSION['employee_code'];
          $sqluser=mysql_query("SELECT ltm_authority,employee_name FROM tbl_msemployee WHERE employee_code = '$employee_code'");
          $hasiluser=mysql_fetch_array($sqluser);
          $user=$hasiluser['employee_name'];
          $ltm_authority=$hasiluser['ltm_authority'];
          if($ltm_authority=='ADMINISTRATOR' or $ltm_authority=='LEISURE TRAVEL MANAGEMENT'){
          
          $option = mysql_query("SELECT * FROM tour_msproductreq
                                    WHERE TmrNo = '$_GET[no]' ");
          $s=mysql_num_rows($option);
          $si=mysql_fetch_array($option);
          if($s < 1){$bisa='disabled';$ok='enabled';$totquo=1;}else{$bisa='enabled';$ok='disabled';$totquo=$s+1;}

    echo" <input type=button value='Reject TMR' onclick=location.href=\"javascript:rejek('$_GET[no]')\" $ok>";
          if($team=='LTM' or $team=='IFM' or $team=='LTM TMR'){
            if($r[Status]=='CONFIRM'){$ling= str_replace(" ", "+", str_replace("/", "%2F", $oncek[TourCode] ) );
            if($oncek[Season]<>''){$lnk="<input style='width: 110px;' type=button value='MANAGE PRODUCT' onclick=location.href='?module=msproduct&opnama=TourCode&nama=$ling&oke=Search' $lnk1>";}
            //else{$lnk="<input style='width: 100px;' type=button value='CREATE PRODUCT' onclick=editpage('$oncek[IDProduct]','editmsproducttmr')>";}
            else{$lnk="<input style='width: 110px;' type=button value='CREATE PRODUCT' onclick=location.href='?module=msproduct&act=tambahmsproduct'>";}
            echo"$lnk";    
            }  
          if($r[Status]=='REQUEST' OR $r[Status]=='NEED CONFIRM'){echo"
          <!--<input type=button value='NEW QUOTATION' onclick=location.href='?module=msproduct&act=quotationtmr&no=$_GET[no]&q=$totquo'>
          <input type=button value='EDIT QUOTATION' onclick=location.href='?module=msproduct&act=editquotationtmr&no=$_GET[no]' $bisa>-->
          <input type=button value='TMR OPTION' onclick=location.href='?module=msitin&act=tmrpdf&no=$_GET[no]'>
          <input type=button value='EDIT ITIN' onclick=location.href='?module=msitin&act=edittmr&no=$_GET[no]' $bisa>";
          }
          }
          }echo" 
          </form>";
     break;
     
  case "show":        
    $filt=mysql_query("SELECT * FROM tbl_msemployee   
                                left join tbl_msoffice on tbl_msoffice.office_id=tbl_msemployee.office_id
                                WHERE tbl_msemployee.employee_code = '$_SESSION[employee_code]'");
    $filter=mysql_fetch_array($filt);
    $team=$filter[office_code];
    $tenc=mysql_query("SELECT * FROM tour_mstmrreq WHERE IDTmr = '$_GET[id]'");
    $isitnc=mysql_fetch_array($tenc);
    echo"
    <font size='5'><b>A. TOUR DETAIL</b></font></br><br>";
    $edit=mysql_query("SELECT * FROM tour_msproductreq
                        inner join tour_msairlines on tour_msairlines.AirlinesID = tour_msproductreq.Flight
                        WHERE TmrNo = '$_GET[id]' AND Status <>'VOID' ");
    $nom=1;
    while($r=mysql_fetch_array($edit)){
        echo"<b>FLIGHT $r[AirlinesName] - OPTION $nom</b><br>";
        $tblitin=mysql_query("SELECT * FROM tour_msitintmrreq
                                WHERE ProdID ='$r[IDProduct]'");
        $day=0;
        $detailitin="";
        $mapfile= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isi[MapFile]) ) ) );
        if($isi[MapFile]<>''){$map="<img src='../admin/map/$mapfile' width='330px' height='330px'>";}else{$map='';}
        while($itin=mysql_fetch_array($tblitin)){
            if(strlen($itin[Days])==1){$hari="0$itin[Days]";}else{$hari="$itin[Days]";}
            $route=$itin[Route];
            if($itin[Breakfast]=='YES' AND $itin[Lunch]=='YES' AND $itin[Dinner]=='YES'){$meals="<b>B: $itin[BreakfastDesc], L: $itin[LunchDesc], D: $itin[DinnerDesc]</b>";}
            else if($itin[Breakfast]=='YES' AND $itin[Lunch]=='YES' AND $itin[Dinner]==''){$meals="<b>B: $itin[BreakfastDesc], L: $itin[LunchDesc]</b>";}
            else if($itin[Breakfast]=='YES' AND $itin[Lunch]=='' AND $itin[Dinner]=='YES'){$meals="<b>B: $itin[BreakfastDesc], D: $itin[DinnerDesc]</b>";}
            else if($itin[Breakfast]=='' AND $itin[Lunch]=='YES' AND $itin[Dinner]=='YES'){$meals="<b>L: $itin[LunchDesc], D: $itin[DinnerDesc]</b>";}
            else if($itin[Breakfast]=='YES' AND $itin[Lunch]=='' AND $itin[Dinner]==''){$meals="<b>B: $itin[BreakfastDesc]</b>";}
            else if($itin[Breakfast]=='' AND $itin[Lunch]=='YES' AND $itin[Dinner]==''){$meals="<b>L: $itin[LunchDesc]</b>";}
            else if($itin[Breakfast]=='' AND $itin[Lunch]=='' AND $itin[Dinner]=='YES'){$meals="<b>D: $itin[DinnerDesc]</b>";}else{$meals="<font color=red><b><i>NO MEALS</i></b></font>";}
            $detail=preg_replace("[<p>]", "", str_replace("</p>", "", $itin[Detail] ) );
            if($itin[Transport]=='PLANE'){$trans="<img src='../images/plane.png'>";}
            else if($itin[Transport]=='TRAIN'){$trans="<img src='../images/train.png'>";}
            else if($itin[Transport]=='BUS'){$trans="<img src='../images/bus.png'>";}
            else if($itin[Transport]=='FERRY'){$trans="<img src='../images/ferry.png'>";}
            else {$trans="";}
            $dateday = $isi[DateTravelFrom];
            $tanggalday = substr($dateday,8,2);
            $bulanday = substr($dateday,5,2);
            $tahunday = substr($dateday,0,4);
            if($itin[Hotel]==''){$hotel="<font color=red><b><i>NO ACCOMMODATION</i></b></font>";}else{$hotel="<b>$itin[Hotel]</b>";}
            //$detail= $itin[Detail] ;
                $photo= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($itin[Photo]) ) ) );
                if($itin[Photo]<>''){$poto="<img src='$itin[PhotoFolder]$photo' width='150px' height='150px'>";}else{$poto="<img src='../admin/itin/default.jpg' width='150px' height='150px'>";}
                $oneday= strtoupper(date('d M',strtotime('0 second',strtotime($day.' day',strtotime(date($bulanday).'/'.date($tanggalday).'/'.date($tahunday).' 00:00:00')))));
                $itin="<tr><td rowspan='4'>$poto</td>
                       <td width='120'><font size=1><b>HARI $hari/$oneday</b></td><td><b>$route $trans</b></font></td></tr>
                       <tr><td colspan='2'><font size=1>Accommodation: $hotel</font></td></tr>
                       <tr><td colspan='2'><font size=1>Restaurant: $meals</font></td></tr>
                       <tr><td colspan='2'><font size=1>$detail</font></td></tr>";
            $detailitin=$detailitin.$itin;
            $day++;
        }
        echo"<table>$detailitin</table><br>
        Flight Detail
        <table>
        <tr><th width='100'>Flight No</th><th width='50'>Class</th><th width='50'>Date</th><th width='50'>Dep</th><th width='50'>Arr</th><th width='50'>ETD</th><th width='50'>ETA</th><th width='50'>Cross</th><th width='50'>Status</th><th>Note</th></tr>";
        $i=0;
        $coba=mysql_query("SELECT * FROM tour_msprodflighttmrreq where IDProduct ='$r[IDProduct]' order by FID ASC ");
        $baris=mysql_num_rows($coba);
        if($baris>0){
            while($tes=mysql_fetch_array($coba)){
                $al=substr($tes[AirCode],0,2);
                $ac=substr($tes[AirCode],2,8);
                if($tes[AirDate]=='0000-00-00'){$AD='00-00-0000';}else{
                    $AD = strtoupper(date('d M', strtotime($tes[AirDate])));}
                echo"
        <tr>
        <td><center>$al $ac</td>
        <td><center>$tes[AirClass]</td>
        <td><center>$AD</td>
        <td><center>$tes[AirRouteDep]</td>
        <td><center>$tes[AirRouteArr]</td>
        <td><center>$tes[AirTimeDep]</td>
        <td><center>$tes[AirTimeArr]</td>
        <td><center>$tes[AirCross]</td>
        <td><center>$tes[AirStatus]</td>
        <td><center>$tes[Note]</td>
        </tr>";$i++;}
        }echo"</table><br>";
        /*$itinhtl=mysql_query("SELECT * FROM tour_msitintmrreq
                                WHERE ProdID ='$r[IDProduct]'");
        echo"Accommodation<table>";
        while($htlitin=mysql_fetch_array($itinhtl)){echo"
        <tr><td>$htlitin[Route]</td><td>$htlitin[Hotel]</td></tr>
        ";
        }echo"</table><br>";
        $itineat=mysql_query("SELECT * FROM tour_msitintmrreq
                                WHERE ProdID ='$r[IDProduct]'");
        echo"Restaurant<table>
        <tr><th></th><th>Breakfast</th><th>Lunch</th><th>Dinner</th></tr>";
        while($eatitin=mysql_fetch_array($itineat)){
        if($eatitin[Breakfast]<>''){$b="$eatitin[BreakfastDesc]";}else{$b="<center>x";}
        if($eatitin[Lunch]<>''){$l="$eatitin[LunchDesc]";}else{$l="<center>x";}
        if($eatitin[Dinner]<>''){$d="$eatitin[DinnerDesc]";}else{$d="<center>x";}
        echo"
        <tr><td>$eatitin[Route]</td><td>$b</td><td>$l</td><td>$d</td></tr>
        ";
        }echo"</table>";*/

        $nom++;
    }
    echo"<font size='5'><b>B. TOUR PRICE</b></font></br>
    <font size='3'><b>ALL PRICE IN $isitnc[BudgetCurr]</b></font><br><br>";
    $qprod=mysql_query("SELECT * FROM tour_msproductreq
                         WHERE TmrNo = '$_GET[id]' AND Status <>'VOID' ");
    $ke=1;
    while($prodke=mysql_fetch_array($qprod)){
        if($prodke[ProductTippingCurr]==''){$tipscurr=$prodke[SellingCurr];}else{$tipscurr=$prodke[ProductTippingCurr];}
        if($prodke[ProductTipping]=='0' or $prodke[ProductTipping]==''){$tips='INCLUDE';}else{$tips="$tipscurr.$prodke[ProductTipping]";}
        echo"Option $ke
                <table><tr><th width='80' rowspan='2' style=vertical-align:middle>DEWASA TWIN SHARE</th><th colspan='3'>ANAK-ANAK (2 - 11 TAHUN)</th>
                <th width=60 rowspan='2' style=vertical-align:middle>SGL SUPP</th><th width='80' rowspan='2' style=vertical-align:middle>APO TAX INTL*</th>
                <th width='70' rowspan='2' style=vertical-align:middle>TIPPING**</th><th width='80' rowspan='2' style=vertical-align:middle>APO TAX JAKARTA</th>";
        if($prodke[VisaSell]<>'' and $prodke[VisaSell]<>'0')
        {$Qvisa=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$prodke[Embassy01]'");
            $Dvisa=mysql_fetch_array($Qvisa);
            echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $Dvisa[Country]</th>";
        }
        if($prodke[VisaSell2]<>'' and $prodke[VisaSell2]<>'0')
        {$Qvisa=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$prodke[Embassy02]'");
            $Dvisa=mysql_fetch_array($Qvisa);
            echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $Dvisa[Country]</th>";
        }
        echo "</tr><tr><th width=70>TWIN SHARE</th><th width=70>EXTRA BED</th><th width=70>NO BED</th>";
        $itinprice=mysql_query("SELECT * FROM tour_msproductpricetmrreq
                            WHERE ProdID ='$prodke[IDProduct]'");
        $jumlahProd=mysql_num_rows($itinprice);
        $p=1;
        while($priceitin=mysql_fetch_array($itinprice)){
                echo "
                    <tr><td><center>$prodke[SellingCurr].$priceitin[SellingAdlTwn]</td></td>
                    <td><center>$prodke[SellingCurr].$priceitin[SellingChdTwn]</td>
                    <td><center>$prodke[SellingCurr].$priceitin[SellingChdXbed]</td>
                    <td><center>$prodke[SellingCurr].$priceitin[SellingChdNbed]</td>";
                    if($p==1){
                   echo"<td rowspan='$jumlahProd' style=vertical-align:middle><center>$prodke[SellingCurr].$prodke[SingleSell]</td>
                    <td rowspan='$jumlahProd' style=vertical-align:middle><center>$prodke[SellingCurr].$prodke[TaxInsSell]</td>
                    <td rowspan='$jumlahProd' style=vertical-align:middle><center>$tips</td>
                    <td rowspan='$jumlahProd' style=vertical-align:middle><center>$prodke[AirTaxCurr]. ".number_format($prodke[AirTaxSell], 0, ',', '.');echo"</td>";
                if($prodke[VisaSell]<>'' and $prodke[VisaSell]<>'0')
                {
                    echo"<td rowspan='$jumlahProd' style=vertical-align:middle><center>$prodke[VisaCurr]. ".number_format($prodke[VisaSell], 0, ',', '.');echo"</td>";
                }
                if($prodke[VisaSell2]<>'' and $prodke[VisaSell2]<>'0')
                {
                    echo"<td rowspan='$jumlahProd' style=vertical-align:middle><center>$prodke[VisaCurr2]. ".number_format($prodke[VisaSell2], 0, ',', '.');echo"</td>";
                }
                echo "</tr>";
                    }$p++;
        }
                echo"</table>";

        $ke++;
    }echo"
    <br><font size='5'><b>C. TOUR CONDITIONS</b></font></br>
    $isitnc[TnC]<br>";

    /*$edit=mysql_query("SELECT * FROM tour_msproductreq WHERE IDProduct = '$_GET[id]' AND Status <>'VOID'");
    $r=mysql_fetch_array($edit);
    $caristatus=mysql_query("SELECT * FROM tour_mstmrreq WHERE IDTmr = '$r[TmrNo]'");
    $statustmr=mysql_fetch_array($caristatus);
    $cuma = mysql_query("SELECT * FROM tour_msdiscount WHERE IDProduct = '$_GET[id]' and Status = 'ACTIVE'  
                                    ORDER BY IDDiscount DESC limit 1");
    $saja = mysql_fetch_array($cuma);
    $mari=mysql_query("SELECT count(IDDetail)as wow FROM tour_msbookingdetail where TourCode = '$r[TourCode]' and Status = 'CANCEL' and Gender <>'INFANT'");
    $tung=mysql_fetch_array($mari);
    $maritot=mysql_query("SELECT count(tour_msbookingdetail.IDDetail)as tot FROM tour_msbookingdetail 
                                        left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                        where tour_msbookingdetail.TourCode = '$r[TourCode]' and tour_msbookingdetail.Gender <>'INFANT'
                                        AND tour_msbookingdetail.Status<>'CANCEL'
                                        AND tour_msbooking.Status='ACTIVE'");
    $tungtot=mysql_fetch_array($maritot);
    $totl=$tungtot[tot]+1;
    if($r[StatusProduct]=='CLOSE'){$tom='disabled';}
    else if($r[StatusProduct]=='OPEN'){$tom='enabled';}
    $d = mysql_query("SELECT * FROM tour_msdiscount 
                    left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct      
                    WHERE tour_msproduct.TourCode = '$r[TourCode]' and tour_msproduct.Status <> 'VOID' and tour_msdiscount.Status='ACTIVE'");
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
    }else{$diskon='0';}
    $dari = date("d M Y", strtotime($r[DateTravelFrom]));
    $sampai = date("d M Y", strtotime($r[DateTravelTo]));
    echo "<h2>Detail Product</h2>       
          <table>                                           
          <tr><td colspan=2>TMR Status</td> <td colspan=5>$statustmr[Status]</td></tr>
          <tr><td colspan=2>Product Code/Name</td> <td colspan=5>  $r[ProductCode]</td></tr>    
          <tr><td colspan=2>Date of Service</td> <td colspan=5>$dari - $sampai</td></tr>
          <tr><td colspan=2>Number of Days</td><td colspan=5> $r[DaysTravel] days</td></tr>   
          <tr><td colspan=2>Flight</td> <td colspan=5>$r[Flight]</td></tr>
          <tr><td colspan=2>Tour Code</td> <td colspan=5>$r[TourCode]</td></tr>  
          
          <tr><td colspan=2>Visa</td> <td colspan=5>$r[Visa] ";if($r[Visa]=='INCLUDE' || $r[Visa]=='NOT INCLUDE'){
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
            
            <tr><td colspan=2>Selling Price Visa</td><td colspan=5>$r[VisaCurr]. ".number_format($r[VisaSell], 2, ',', '.');echo"</td></tr>
            <tr><td colspan=2>Selling Price Visa 2</td><td colspan=5>$r[VisaCurr2]. ".number_format($r[VisaSell2], 2, ',', '.');echo"</td></tr>
            <tr><td colspan=2>Domestic Airport Tax</td><td colspan=5>";if($r[AirTaxSell]==0){echo"INCLUDE";}else{echo"$r[AirTaxCurr]. ".number_format($r[AirTaxSell], 2, ',', '.');}echo"</td></tr>
            <tr><td colspan=2>Airport Tax & Flight Insurance</td><td colspan=5>$r[SellingCurr]. ".number_format($r[TaxInsSell], 2, ',', '.');echo"</td></tr>
            <tr><td colspan=2>Single Supplement</td><td colspan=5>$r[SellingCurr]. ".number_format($r[SingleSell], 2, ',', '.');echo"</td></tr>
            <tr><td colspan=2>Seat</td> <td colspan=5>$r[Seat] Pax <font color='red'>*<i>Not Include Infant and Tour leader</i></font></td></tr>";          
            $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[AttachmentFile]) ) ) );  
    echo"   <tr><td colspan=2>Attachment</td><td colspan=5>";
            if($r[AttachmentFile]==''){
                echo"NONE";    
            }else {
                echo"<a href='$r[Attachment]$file' target='_blank' style=text-decoration:none>$r[AttachmentFile]</a> &nbsp<font color='red'>*<i>click for open file</i></font>";
            }
    echo"   </td></tr>
            <tr><td colspan=2>Remarks</td><td colspan=5>$r[Remarks]</td></tr>   
            <tr><td colspan=2>TourLeader</td><td colspan=5>$r[TourLeader]</td></tr>
            <tr><td colspan=7><center>Selling Price in $r[SellingCurr]</td></tr>    
            <tr><th></th><th width=80>ADULT</th><th width=80>CHILD TWN</th><th width=80>CHILD X BED</th><th width=80>Child No bed</th><th width=80>Infant</th><th width=80>Tax</th></tr>
                <tr><th>Tour</th>
                    <td><center>$r[SellingAdlTwn]</td></td>
                    <td><center>$r[SellingChdTwn]</td>
                    <td><center>$r[SellingChdXbed]</td>
                    <td><center>$r[SellingChdNbed]</td>
                    <td><center>$r[SellingInfant]</td>
                    <td><center>$r[TaxInsSell]</td>
                </tr>
                <tr><th>LA Only</th>
                    <td><center>$r[LAAdlTwn]</td></td>
                    <td><center>$r[LAChdTwn]</td>
                    <td><center>$r[LAChdXbed]</td>
                    <td><center>$r[LAChdNbed]</td>
                    <td><center>$r[LAInfant]</td>
                    <td></td>
                </tr>   
          
                     <tr><td colspan=7><center>";
          
          if($statustmr[Status]=='NEED CONFIRM'){
            if($team=='LTM' or $team=='IFM'){
            echo"<input style='width: 100px;' type=button value='EDIT PRODUCT' onclick=editpage('$_GET[id]','editmsproducttmr')> <input type=button value='EDIT QUOTATION' onclick=quotpage('$_GET[id]')> ";    
            }if($team<>'LTM'){
            echo"<input style='width: 100px;' type=button value='CONFIRM TMR' onclick=location.href=\"javascript:deal('$r[TmrNo]')\"> ";
            };
          echo"<input style='width: 100px;' type=button value='CANCEL TMR' onclick=location.href=\"javascript:nodeal('$r[TmrNo]')\"> ";    
          }else if($statustmr[Status]=='DEAL'){
          echo"<input style='width: 100px;' type=button value='ADD BOOKING' onclick=location.href='?module=msbooking&act=tambahmsbooking&id=$_GET[id]&no=$r[TmrNo]' $tom>";    
          }echo"   
          </td></tr>
          </table> 
          */     
    echo" <form method=POST name='example'>
          <font size='5'><b>D. YOUR OPTION</b></font><br><br>
          <input type='hidden' name='pilihan'><input type='hidden' name='harga'>
          Flight with <select name='idproduct' onChange=pilihpax()><option value='0'>- select Flight -</option>";
            $tampil2=mysql_query("SELECT * FROM tour_msproductreq
                                      left join tour_msairlines on tour_msairlines.AirlinesID = tour_msproductreq.Flight
                                      where TmrNo = '$_GET[id]' AND Status <>'VOID'
                                      order by AirlinesID ASC");
            while($s2=mysql_fetch_array($tampil2)){
              echo "<option value='$s2[IDProduct]' >$s2[AirlinesName] ($s2[AirlinesID])</option>";
            }
            echo "</select>
          Min Pax <select name='idpax' id='idpax'></select>
            <center>";
            if($isitnc[Status]=='NEED CONFIRM'){
            if($team<>'LTM'){
            echo"<input style='width: 100px;' type=button value='CONFIRM TMR' onclick=location.href=\"javascript:deal('$isitnc[IDTmr]')\"> ";
            };
            echo"<input style='width: 100px;' type=button value='CANCEL TMR' onclick=location.href=\"javascript:nodeal('$isitnc[IDTmr]')\"> ";
            }echo"
          </form><a href='?module=mstmr'><font size=2>back to previous page</font></a>";
     break;

  case "showpdf":
        $filt=mysql_query("SELECT * FROM tbl_msemployee
                                left join tbl_msoffice on tbl_msoffice.office_id=tbl_msemployee.office_id
                                WHERE tbl_msemployee.employee_code = '$_SESSION[employee_code]'");
        $filter=mysql_fetch_array($filt);
        $team=$filter[office_code];
        $tenc=mysql_query("SELECT * FROM tour_mstmrreq WHERE IDTmr = '$_GET[id]'");
        $isitnc=mysql_fetch_array($tenc);
        echo"
        <input type=hidden name='idtmr' value='$_GET[id]'>";
        $qchoice=mysql_query("SELECT * FROM tour_msitintmrpdf
                    WHERE IDTmr = '$_GET[id]'");
        $isichoice=mysql_fetch_array($qchoice);
  echo" <table class='bordered'>

         <tr><th>Option</th><th>Itinerary</th>
         <tr><td><center>1</td><td>";
         if($isichoice[ItinOption1]<>''){
         $itin1= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isichoice[ItinOption1]) ) ) );
   echo" <input type='hidden' name='itin1' value='$isichoice[ItinOption1]'>
         <center><a href='$isichoice[PdfFolder]$itin1' target='_blank' style=text-decoration:none >$isichoice[ItinOption1]</a>";}
         else{echo"<center><i>- no itinerary -</i>";
         }echo"</td></tr>

         <tr><td><center>2</td><td>";
         if($isichoice[ItinOption2]<>''){
            $itin2= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isichoice[ItinOption2]) ) ) );
            echo"<input type='hidden' name='itin2' value='$isichoice[ItinOption2]'>
                 <center><a href='$isichoice[PdfFolder]$itin2' target='_blank' style=text-decoration:none >$isichoice[ItinOption2]</a>";}
         else{echo"<center><i>- no itinerary -</i>";
         }echo"</td></tr>

         <tr><td><center>3</td><td>";
         if($isichoice[ItinOption3]<>''){
            $itin3= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isichoice[ItinOption3]) ) ) );
            echo"<input type='hidden' name='itin3' value='$isichoice[ItinOption3]'>
                 <center><a href='$isichoice[PdfFolder]$itin3' target='_blank' style=text-decoration:none >$isichoice[ItinOption3]</a>";}
         else{echo"<center><i>- no itinerary -</i>";
         }echo"</td></tr>
         </table>";

        echo" <form method=POST name='example'>
          <font size='1'><b>CONFIRM</b></font>
          <select name='idproduct' required><option value=''>- select Option -</option>";
                                if($isichoice[ItinOption1]<>''){echo"<option value='1'>Option 1</option>";}
                                if($isichoice[ItinOption2]<>''){echo"<option value='2'>Option 2</option>";}
                                if($isichoice[ItinOption3]<>''){echo"<option value='3'>Option 3</option>";}
          echo"</select>
          <center>";
        if($isitnc[Status]=='NEED CONFIRM'){
            if($team<>'LTM'){
                echo"<input style='width: 100px;' type=button value='CONFIRM TMR' onclick=location.href=\"javascript:deal('$isitnc[IDTmr]')\"> ";
            };
            echo"<input style='width: 100px;' type=button value='CANCEL TMR' onclick=location.href=\"javascript:nodeal('$isitnc[IDTmr]')\"> ";
        }echo"
          </form><a href='?module=mstmr'><font size=1>back to previous page</font></a>";
        break;
     
  case "nodeal":
     $username=$_SESSION[namauser];
     $sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_username='$username'");
     $tampiluser=mysql_fetch_object($sqluser);
     $EmpName=$tampiluser->employee_name;
     $timezone_offset = -1;
     $tz_adjust = ($timezone_offset * 60 * 60);
     $jam = time();
     $waktu = ($jam + $tz_adjust);
     $today = date("Y-m-d", $waktu);
     $Description="TMR $_GET[id] NO DEAL"; 
     $edit=mysql_query("UPDATE tour_mstmrreq SET Status = 'CANCEL',
                            ReasonNodeal = '$_GET[reason]',NodealDate='$today'
                           WHERE IDTmr = '$_GET[id]'");                                      
     $ganti=mysql_query("update tour_msproductreq set Status ='VOID' WHERE TmrNo = '$_GET[id]'");
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')"); 
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mstmr'>";   
     break; 
     
  case "deal":
     $idprod=$_GET[pop];
     //$priceprod=$_GET[hop];
     $idtmr=$_GET[tmr];
     $username=$_SESSION[namauser];
     $sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_username='$username'");
     $tampiluser=mysql_fetch_object($sqluser);
     $sqltmr=mysql_query("SELECT * FROM tour_mstmrreq WHERE IDTmr='$idtmr'");
     $tampiltmr=mysql_fetch_array($sqltmr);
     $EmpName=$tampiluser->employee_name;
     $timezone_offset = -1;
     $tz_adjust = ($timezone_offset * 60 * 60);
     $jam = time();
     $waktu = ($jam + $tz_adjust);
     $today = date("Y-m-d");    
     $edit=mysql_query("update tour_mstmrreq set Status ='CONFIRM',
                                                 OptionProduct = '$idprod',
                                                 DealDate='$today'
                                                 WHERE IDTmr = '$idtmr'");
     $autovoid=mysql_query("UPDATE tour_mstmrreq SET Status = 'CANCEL',
                            ReasonNodeal = 'AUTO CANCEL',NodealDate='$today'
                           WHERE TmrNo = '$tampiltmr[TmrNo]'
                           and ReasonNodeal = ''
                           and Status <> 'CONFIRM'");
     //$ganti=mysql_query("update tour_msproductreq set Status ='VOID' WHERE TmrNo = '$idtmr' AND IDProduct <> '$idprod' ");
     /*$sqlcopy=mysql_query("SELECT * FROM tour_msproductreq WHERE IDProduct='$idprod'");
     $copyprod=mysql_fetch_array($sqlcopy);
     if($pilih=='A'){$SellingAdlTwn=$copyprod[SellingAdlTwn];$LAAdlTwn=$copyprod[LAAdlTwn];
                     $SellingChdTwn=$copyprod[SellingChdTwn];$LAChdTwn=$copyprod[LAChdTwn];
                     $SellingChdXbed=$copyprod[SellingChdXbed];$LAChdXbed=$copyprod[LAChdXbed];
                     $SellingChdNbed=$copyprod[SellingChdNbed];$LAChdNbed=$copyprod[LAChdNbed];
                     $SellingInfant=$copyprod[SellingInfant];$LAInfant=$copyprod[LAInfant];}
     else if($pilih=='B'){$SellingAdlTwn=$copyprod[SellingAdlTwnB];$LAAdlTwn=$copyprod[LAAdlTwnB];
                     $SellingChdTwn=$copyprod[SellingChdTwnB];$LAChdTwn=$copyprod[LAChdTwnB];
                     $SellingChdXbed=$copyprod[SellingChdXbedB];$LAChdXbed=$copyprod[LAChdXbedB];
                     $SellingChdNbed=$copyprod[SellingChdNbedB];$LAChdNbed=$copyprod[LAChdNbedB];
                     $SellingInfant=$copyprod[SellingInfantB];$LAInfant=$copyprod[LAInfantB];}
     else if($pilih=='C'){$SellingAdlTwn=$copyprod[SellingAdlTwnC];$LAAdlTwn=$copyprod[LAAdlTwnC];
                     $SellingChdTwn=$copyprod[SellingChdTwnC];$LAChdTwn=$copyprod[LAChdTwnC];
                     $SellingChdXbed=$copyprod[SellingChdXbedC];$LAChdXbed=$copyprod[LAChdXbedC];
                     $SellingChdNbed=$copyprod[SellingChdNbedC];$LAChdNbed=$copyprod[LAChdNbedC];
                     $SellingInfant=$copyprod[SellingInfantC];$LAInfant=$copyprod[LAInfantC];}  */
     //INSERT PRODUCT REQUEST KE PRODUCT                                       
     /*mysql_query("insert into tour_msproduct
                (Season,Year,ProductType,ProductCode,Destination,Department,GroupType,ProductFor,TourCode,TourCodeOld,DateTravelFrom,DateTravelTo,
                DaysTravel,Flight,Seat,SeatDeposit,SeatSisa,SeatInquiry,SeatBooking,Room,Insurance,Visa,Embassy01,Embassy02,Embassy03,Embassy04,Embassy05,
                TaxInsNett,TaxInsSell,LandArrNett,LandArrSell,SingleNett,SingleSell,VisaCurr,VisaNett,VisaSell,VisaCurr2,VisaNett2,VisaSell2,AirTaxCurr,AirTaxNett,AirTaxSell,
                QuotationCurr,SellingCurr,SellingOperator,SellingRate,SellingAdlTwn,SellingChdTwn,SellingChdXbed,SellingChdNbed,SellingInfant,LAAdlTwn,LAChdTwn,LAChdXbed,LAChdNbed,LAInfant,
                Attachment,AttachmentFile,Remarks,TourLeaderInc,TourLeader,Status,StatusProduct,TmrNo,OptionDeal,InputBy,InputDate,UpdateBy,UpdateDate)values(   
                '$copyprod[Season]','$copyprod[Year]','$copyprod[ProductType]','$copyprod[ProductCode]','$copyprod[Destination]','$copyprod[Department]','$copyprod[GroupType]','$copyprod[ProductFor]','$copyprod[TourCode]','$copyprod[TourCodeOld]','$copyprod[DateTravelFrom]','$copyprod[DateTravelTo]',
                '$copyprod[DaysTravel]','$copyprod[Flight]','$copyprod[Seat]','$copyprod[SeatDeposit]','$copyprod[SeatSisa]','$copyprod[SeatInquiry]','$copyprod[SeatBooking]','$copyprod[Room]','$copyprod[Insurance]','$copyprod[Visa]','$copyprod[Embassy01]','$copyprod[Embassy02]','$copyprod[Embassy03]','$copyprod[Embassy04]','$copyprod[Embassy05]',
                '$copyprod[TaxInsNett]','$copyprod[TaxInsSell]','$copyprod[LandArrNett]','$copyprod[LandArrSell]','$copyprod[SingleNett]','$copyprod[SingleSell]','$copyprod[VisaCurr]','$copyprod[VisaNett]','$copyprod[VisaSell]','$copyprod[VisaCurr2]','$copyprod[VisaNett2]','$copyprod[VisaSell2]','$copyprod[AirTaxCurr]','$copyprod[AirTaxNett]','$copyprod[AirTaxSell]',
                '$copyprod[QuotationCurr]','$copyprod[SellingCurr]','$copyprod[SellingOperator]','$copyprod[SellingRate]','$SellingAdlTwn','$SellingChdTwn','$SellingChdXbed','$SellingChdNbed','$SellingInfant','$LAAdlTwn','$LAChdTwn','$LAChdXbed','$LAChdNbed','$LAInfant',
                '$copyprod[Attachment]','$copyprod[AttachmentFile]','$copyprod[Remarks]','$copyprod[TourLeaderInc]','$copyprod[TourLeader]','NOT PUBLISHED','OPEN','$tampiltmr[TmrNo]','$copyprod[OptionDeal]','$copyprod[InputBy]','$copyprod[InputDate]','$copyprod[UpdateBy]','$copyprod[UpdateDate]')");
     $cuma3 = mysql_query("SELECT * FROM tour_msproduct   
                    order by IDProduct DESC limit 1");
     $saja3 = mysql_fetch_array($cuma3);
     $newid=$saja3[IDProduct];          
     $cuma = mysql_query("SELECT * FROM tour_msdetailreq   
                    where IDProduct = $copyprod[IDProduct]");
     $jum = mysql_num_rows($cuma);
     while($saja = mysql_fetch_array($cuma)){
      mysql_query("INSERT INTO tour_msdetail(IDProduct,
                                            TotalVar,
                                            TotalFixAdult,
                                            TotalFixChd,
                                            AliasOptA,
                                            PaxA,
                                            TotalAdultA,
                                            TotalChdTwnA,
                                            TotalChdXbedA,
                                            AliasOptB,
                                            PaxB,
                                            TotalAdultB,
                                            TotalChdTwnB,
                                            TotalChdXbedB,
                                            AliasOptC,
                                            PaxC,
                                            TotalAdultC,
                                            TotalChdTwnC,
                                            TotalChdXbedC,
                                            Persen,
                                            ComAdultA,
                                            ComChdTwnA,
                                            ComChdXbedA,
                                            ComAdultB,
                                            ComChdTwnB,
                                            ComChdXbedB,  
                                            ComAdultC,
                                            ComChdTwnC,
                                            ComChdXbedC,
                                            DiscAdultA,
                                            DiscChdTwnA,
                                            DiscChdXbedA,
                                            DiscAdultB,
                                            DiscChdTwnB,
                                            DiscChdXbedB,  
                                            DiscAdultC,
                                            DiscChdTwnC,
                                            DiscChdXbedC) 
                                    VALUES ('$newid',
                                            '$saja[TotalVar]',
                                            '$saja[TotalFixAdult]',
                                            '$saja[TotalFixChd]',
                                            '$saja[AliasOptA]',
                                            '$saja[PaxA]',
                                            '$saja[TotalAdultA]',
                                            '$saja[TotalChdTwnA]',
                                            '$saja[TotalChdXbedA]',
                                            '$saja[AliasOptB]',
                                            '$saja[PaxB]',
                                            '$saja[TotalAdultB]',
                                            '$saja[TotalChdTwnB]',
                                            '$saja[TotalChdXbedB]',
                                            '$saja[AliasOptC]',
                                            '$saja[PaxC]',
                                            '$saja[TotalAdultC]',
                                            '$saja[TotalChdTwnC]',
                                            '$saja[TotalChdXbedC]',
                                            '$saja[Persen]',
                                            '$saja[ComAdultA]',
                                            '$saja[ComChdTwnA]',
                                            '$saja[ComChdXbedA]',
                                            '$saja[ComAdultB]',
                                            '$saja[ComChdTwnB]',
                                            '$saja[ComChdXbedB]',  
                                            '$saja[ComAdultC]',
                                            '$saja[ComChdTwnC]',
                                            '$saja[ComChdXbedC]',
                                            '$saja[DiscAdultA]',
                                            '$saja[DiscChdTwnA]',
                                            '$saja[DiscChdXbedA]',
                                            '$saja[DiscAdultB]',
                                            '$saja[DiscChdTwnB]',
                                            '$saja[DiscChdXbedB]',  
                                            '$saja[DiscAdultC]',
                                            '$saja[DiscChdTwnC]',
                                            '$saja[DiscChdXbedC]')");  
  }
  $cuma1 = mysql_query("SELECT * FROM tour_detailreq   
                    where IDProduct = $copyprod[IDProduct]");
  $jum1 = mysql_num_rows($cuma1);
  while($saja1 = mysql_fetch_array($cuma1)){
      mysql_query("INSERT INTO tour_detail(Detail,
                                            IDProduct,
                                            Category,
                                            Supplier,
                                            Description,
                                            QuotationCurr,
                                            SellingCurr,
                                            SellingOperator,
                                            SellingRate,
                                            QuoAdult,
                                            SellAdult,
                                            QuoChd,
                                            SellChd) 
                                    VALUES ('$saja1[Detail]',
                                            '$newid',
                                            '$saja1[Category]',
                                            '$saja1[Supplier]',
                                            '$saja1[Description]',
                                            '$saja1[QuotationCurr]',
                                            '$saja1[SellingCurr]',
                                            '$saja1[SellingOperator]',
                                            '$saja1[SellingRate]',
                                            '$saja1[QuoAdult]',
                                            '$saja1[SellAdult]',
                                            '$saja1[QuoChd]',
                                            '$saja1[SellChd]')");  
  }
 
  $cuma2 = mysql_query("SELECT * FROM tour_agentreq   
                    where IDProduct = $copyprod[IDProduct]");
  $jum2 = mysql_num_rows($cuma2);
  while($saja2 = mysql_fetch_array($cuma2)){
      mysql_query("INSERT INTO tour_agent(IDProduct,
                                            Category,
                                            Supplier,
                                            Description,
                                            QuotationCurrA,
                                            SellingCurrA,
                                            SellingOperatorA,
                                            SellingRateA,
                                            PaxA,
                                            QuoAdultA,
                                            SellAdultA,
                                            QuoChdTwnA,
                                            SellChdTwnA,
                                            QuoChdXbedA,
                                            SellChdXbedA,
                                            QuotationCurrB,
                                            SellingCurrB,
                                            SellingOperatorB,
                                            SellingRateB,
                                            PaxB,
                                            QuoAdultB,
                                            SellAdultB,
                                            QuoChdTwnB,
                                            SellChdTwnB,
                                            QuoChdXbedB,
                                            SellChdXbedB,
                                            QuotationCurrC,
                                            SellingCurrC,
                                            SellingOperatorC,
                                            SellingRateC,
                                            PaxC,
                                            QuoAdultC,
                                            SellAdultC,
                                            QuoChdTwnC,
                                            SellChdTwnC,
                                            QuoChdXbedC,
                                            SellChdXbedC) 
                                    VALUES ('$newid',
                                            '$saja2[Category]',
                                            '$saja2[Supplier]',
                                            '$saja2[Description]',
                                            '$saja2[QuotationCurrA]',
                                            '$saja2[SellingCurrA]',
                                            '$saja2[SellingOperatorA]',
                                            '$saja2[SellingRateA]',
                                            '$saja2[PaxA]',
                                            '$saja2[QuoAdultA]',
                                            '$saja2[SellAdultA]',
                                            '$saja2[QuoChdTwnA]',
                                            '$saja2[SellChdTwnA]',
                                            '$saja2[QuoChdXbedA]',
                                            '$saja2[SellChdXbedA]',
                                            '$saja2[QuotationCurrB]',
                                            '$saja2[SellingCurrB]',
                                            '$saja2[SellingOperatorB]',
                                            '$saja2[SellingRateB]',
                                            '$saja2[PaxB]',
                                            '$saja2[QuoAdultB]',
                                            '$saja2[SellAdultB]',
                                            '$saja2[QuoChdTwnB]',
                                            '$saja2[SellChdTwnB]',
                                            '$saja2[QuoChdXbedB]',
                                            '$saja2[SellChdXbedB]',
                                            '$saja2[QuotationCurrC]',
                                            '$saja2[SellingCurrC]',
                                            '$saja2[SellingOperatorC]',
                                            '$saja2[SellingRateC]',
                                            '$saja2[PaxC]',
                                            '$saja2[QuoAdultC]',
                                            '$saja2[SellAdultC]',
                                            '$saja2[QuoChdTwnC]',
                                            '$saja2[SellChdTwnC]',
                                            '$saja2[QuoChdXbedC]',
                                            '$saja2[SellChdXbedC]')");  
  }
  */
       //$Description="Insert Product TMR DEAL ($newid) from request ($copyprod[IDProduct])";
     $Description="Confirm option tmr (id: $idtmr, option: $idprod)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                               Description,
                               LogTime) 
                        VALUES ('$EmpName', 
                               '$Description', 
                               '$today')");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mstmr'>";                                                                    
     //echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msbooking&group=4&act=show&id=$newid'>";   
     break; 
     
  case "rejek":
     $username=$_SESSION[namauser];
     $sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_username='$username'");
     $tampiluser=mysql_fetch_object($sqluser);
     $EmpName=$tampiluser->employee_name;
     $timezone_offset = -1;
     $tz_adjust = ($timezone_offset * 60 * 60);
     $jam = time();
     $waktu = ($jam + $tz_adjust);
     $today = date("Y-m-d", $waktu);
     $Description="TMR $_GET[id] REJECTED"; 
     $edit=mysql_query("UPDATE tour_mstmrreq SET Status = 'REJECT',
                            ReasonNodeal = '$_GET[reason]',NodealDate='$today'
                           WHERE IDTmr = '$_GET[id]'");                                      
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')"); 
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mstmr'>";   
     break;              
}
?>
