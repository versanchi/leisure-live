<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>         
<script type="text/javascript" src="../head/editable-select.js"></script> 
<script language="JavaScript"  type="text/javascript">   
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
function delfile(ID, SUPPLIER, cat,no)
{
if (confirm("Are you sure you want to delete " + SUPPLIER +" ("+ cat +") "))
{
 window.location.href = '?module=msbooking&act=deletedetail&id=' + ID + '&no=' + no ;
 
} 
}
function delattach(ID, ATTACHFILE)
{
if (confirm("Are you sure you want to delete " + ATTACHFILE +" "))
{
 window.location.href = '?module=msbooking&act=delattach&id=' + ID;
 
} 
}
function publishprod(ID)
{
 window.location.href = '?module=msbooking&act=publishmsbooking&id=' + ID ;
}
function ceking(ID)
{

 window.location.href = '?module=msbooking&act=cekseat&id=' + ID  ;
 
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
    document.example.elements['submit'].disabled=false; 
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
                                      
    if (dep < arr) {
        fld.style.background = 'Yellow'; 
        error = "Available seat only " + dep + " .\n"
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

//-->
</SCRIPT>
<?php 
switch($_GET[act]){
  // Tampil Office
  default:
      
    echo "<h2>Info Booking Product</h2>
          View By :  
          <form method='GET' action='expsalesprod.php' target='_blank'>        
              <select name='opnama'><option value=''";if($opnama==''){echo"selected";}echo">- please select -</option>
                                    <option value='TourCode'";if($opnama=='TourCode'){echo"selected";}echo">Tour Code</option>
                                    <option value='DateTravelFrom'";if($opnama=='DateTravelFrom'){echo"selected";}echo">Departure Date</option>
                                    <option value='Flight'";if($opnama=='Flight'){echo"selected";}echo">Flight</option>
                                    <option value='Destination'";if($opnama=='Destination'){echo"selected";}echo">Destination</option>
                                    <option value='tour_msproductcode.Productcode'";if($opnama=='tour_msproductcode.Productcode'){echo"selected";}echo">Product</option>
                                    <option value='DaysTravel'";if($opnama=='DaysTravel'){echo"selected";}echo">Days</option>
              </select> <input type=text name='nama' value='$nama' size=20><br>
              <select name='opnama2'><option value=''";if($opnama==''){echo"selected";}echo">- please select -</option>
                                    <option value='TourCode'";if($opnama2=='TourCode'){echo"selected";}echo">Tour Code</option>
                                    <option value='DateTravelFrom'";if($opnama2=='DateTravelFrom'){echo"selected";}echo">Departure Date</option>
                                    <option value='Flight'";if($opnama2=='Flight'){echo"selected";}echo">Flight</option>
                                    <option value='Destination'";if($opnama2=='Destination'){echo"selected";}echo">Destination</option>
                                    <option value='tour_msproductcode.Productcode'";if($opnama2=='tour_msproductcode.Productcode'){echo"selected";}echo">Product</option>
                                    <option value='DaysTravel'";if($opnama2=='DaysTravel'){echo"selected";}echo">Days</option>
              </select> <input type=text name='nama2' value='$nama2' size=20>    
              <input type=submit name='submit' size='20'value='View'>
          </form>";
          $oke=$_GET['oke'];                        

    break;               
}
?>
