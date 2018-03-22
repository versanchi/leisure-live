<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>         
<script type="text/javascript" src="./fckeditor/ckeditor.js"></script>  
<script language="JavaScript"  type="text/javascript">   
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
function delfile(ID, SUPPLIER)
{
    if (confirm("Are you sure you want to delete " + SUPPLIER +"  "))
    {
        window.location.href = '?module=msproduct&act=deletedetail&id=' + ID  ;

    }
}
function delattach(ID, ATTACHFILE)
{
if (confirm("Are you sure you want to delete " + ATTACHFILE +" "))
{
 window.location.href = '?module=msproduct&act=delattach&id=' + ID;
 
} 
}
function delattachapp(ID, ATTACHFILE)
{
if (confirm("Are you sure you want to delete " + ATTACHFILE +" "))
{
 window.location.href = '?module=msproduct&act=delattachapp&id=' + ID;
 
} 
}
function publishprod(ID)
{
 window.location.href = '?module=msproduct&act=publishmsproduct&id=' + ID ;
}
function lockprice(ID,YR)
{
    if (confirm("LOCK ALL PRICE (" + ID +") ?"))
    {
      window.location.href = '?module=msproduct&act=lockprice&id=' + ID + '&yr=' + YR;  
    }  
}
function hapuspnr(PNR,ID)
{
if (confirm("Are you sure DELETE PNR : " + PNR +" "))
{
 window.location.href = '?module=msproduct&act=delpnr&id=' + ID;
 
} 
}
function showDay(d)
 { 
 var emb = eval("example.embassy0"+d);
 var idembassy = eval("example.idembassy0"+d);
 var rangeemb = eval("example.rangehari"+d);
 if(emb.value!=0){
     hasil = emb.value.split(",");
     var idemb = hasil[0]; 
     var dayemb = hasil[1]; 
     idembassy.value=idemb;
     rangeemb.value=dayemb;       
 }else{
     idembassy.value='';
     rangeemb.value=0;
 }
 var rh1=eval(example.rangehari1.value);
 var rh2=eval(example.rangehari2.value);
 var rh3=eval(example.rangehari3.value);
 var rh4=eval(example.rangehari4.value);
 var rh5=eval(example.rangehari5.value);
 var tothari=rh1+rh2+rh3+rh4+rh5;
 example.visatimeframe.value=tothari;
 
 var datefrom1 = example.datetravelfrom.value;    
 dep1 = datefrom1.split("-");
 var datefrom = dep1[2]+ "/" +dep1[1]+ "/" +dep1[0];  
 var firstDay = new Date(datefrom);     
 var previousweek= new Date(firstDay.getTime() - tothari * 24 * 60 * 60 * 1000);
 var date = new Date(previousweek);
 var d  = date.getDate();
 var day = (d < 10) ? '0' + d : d;
 var m = date.getMonth() + 1;
 var month = (m < 10) ? '0' + m : m;
 var yy = date.getYear();
 var year = (yy < 1000) ? yy + 1900 : yy;
 var depdate = day + "-" + month + "-" + year  ;     
 example.visadateline.value=depdate;
 } 
function UNall(){
    var coma = calculate.comaa;
    coma.value = calculate.comall.value;
    var comb = calculate.comca;
    comb.value = calculate.comall.value;
    var comc = calculate.comcxa;
    comc.value = calculate.comall.value;
    var comd = calculate.comcna;
    comd.value = calculate.comall.value;
    var coma = calculate.comab;
    coma.value = calculate.comall.value;
    var comb = calculate.comcb;
    comb.value = calculate.comall.value;
    var comc = calculate.comcxb;
    comc.value = calculate.comall.value;
    var comd = calculate.comcnb;
    comd.value = calculate.comall.value;
    var coma = calculate.comac;
    coma.value = calculate.comall.value;
    var comb = calculate.comcc;
    comb.value = calculate.comall.value;
    var comc = calculate.comcxc;
    comc.value = calculate.comall.value;
    var comd = calculate.comcnc;
    comd.value = calculate.comall.value;
    UpdateNetta()
    UpdateNettb()
    UpdateNettc()
 }
function UpdateNetta(){
    
    var a = calculate.nettaa;
    var c = calculate.nettca; 
    var cx = calculate.nettcxa;
    var cn = calculate.nettcna;  
    var n1 = eval(calculate.sumaa.value);
    var n2 = eval(calculate.sumca.value);
    var n3 = eval(calculate.sumcxa.value);
    var n31 = eval(calculate.sumcna.value);  
    var n4 = eval(calculate.comaa.value);
    var n5 = eval(calculate.comca.value);
    var n6 = eval(calculate.comcxa.value);
    var n61 = eval(calculate.comcna.value);       
    a.value = (n1 + n4).toFixed(2) ;
    c.value = (n2 + n5).toFixed(2) ;
    cx.value = (n3 + n6).toFixed(2) ;
    cn.value = (n31 + n61).toFixed(2) ;
    if (isNaN(a.value)) {
      a.value=(n1).toFixed(2) ;   
      }
    if (isNaN(c.value)) {
      c.value=(n2).toFixed(2) ;   
      }
    if (isNaN(cx.value)) {
      cx.value=(n3).toFixed(2) ;   
      }
    if (isNaN(cn.value)) {
      cn.value=(n31).toFixed(2) ;   
      }
      UpdateSell()  
 }
function UpdateNettb(){
    
    var a = calculate.nettab;
    var c = calculate.nettcb; 
    var cx = calculate.nettcxb; 
    var cn = calculate.nettcnb;
    var n1 = eval(calculate.sumab.value);
    var n2 = eval(calculate.sumcb.value);
    var n3 = eval(calculate.sumcxb.value);
    var n31 = eval(calculate.sumcnb.value);  
    var n4 = eval(calculate.comab.value);
    var n5 = eval(calculate.comcb.value);
    var n6 = eval(calculate.comcxb.value);
    var n61 = eval(calculate.comcnb.value);      
    a.value = (n1 + n4).toFixed(2) ;
    c.value = (n2 + n5).toFixed(2) ;
    cx.value = (n3 + n6).toFixed(2) ;
    cn.value = (n31 + n61).toFixed(2) ;
    if (isNaN(a.value)) {
      a.value=(n1).toFixed(2) ;   
      }
    if (isNaN(c.value)) {
      c.value=(n2).toFixed(2) ;   
      }
    if (isNaN(cx.value)) {
      cx.value=(n3).toFixed(2) ;   
      }
    if (isNaN(cn.value)) {
      cn.value=(n31).toFixed(2) ;   
      }
      UpdateSell()           
 }
function UpdateNettc(){
    
    var a = calculate.nettac;
    var c = calculate.nettcc; 
    var cx = calculate.nettcxc;
    var cn = calculate.nettcnc; 
    var n1 = eval(calculate.sumac.value);
    var n2 = eval(calculate.sumcc.value);
    var n3 = eval(calculate.sumcxc.value);
    var n31 = eval(calculate.sumcnc.value);  
    var n4 = eval(calculate.comac.value);
    var n5 = eval(calculate.comcc.value);
    var n6 = eval(calculate.comcxc.value);
    var n61 = eval(calculate.comcnc.value);      
    a.value = (n1 + n4).toFixed(2) ;
    c.value = (n2 + n5).toFixed(2) ;
    cx.value = (n3 + n6).toFixed(2) ;
    cn.value = (n31 + n61).toFixed(2) ;
    if (isNaN(a.value)) {
      a.value=(n1).toFixed(2) ;   
      }
    if (isNaN(c.value)) {
      c.value=(n2).toFixed(2) ;   
      }
    if (isNaN(cx.value)) {
      cx.value=(n3).toFixed(2) ;   
      }
    if (isNaN(cn.value)) {
      cn.value=(n31).toFixed(2) ;   
      }
      UpdateSell()
 }
function UpdateProfit(){
    var aa = calculate.paa;
    var ca = calculate.pca; 
    var cxa = calculate.pcxa;
    var cna = calculate.pcna;
    var ab = calculate.pab;
    var cb = calculate.pcb; 
    var cxb = calculate.pcxb;
    var cnb = calculate.pcnb;
    var ac = calculate.pac;
    var cc = calculate.pcc; 
    var cxc = calculate.pcxc;
    var cnc = calculate.pcnc; 
    var n1 = eval(calculate.nettaa.value);
    var n2 = eval(calculate.nettca.value);
    var n3 = eval(calculate.nettcxa.value);
    var n31 = eval(calculate.nettcna.value);   
    var n4 = eval(calculate.nettab.value);
    var n5 = eval(calculate.nettcb.value);
    var n6 = eval(calculate.nettcxb.value);
    var n61 = eval(calculate.nettcnb.value);
    var n7 = eval(calculate.nettac.value);
    var n8 = eval(calculate.nettcc.value);
    var n9 = eval(calculate.nettcxc.value);
    var n91 = eval(calculate.nettcnc.value);
    var per = calculate.persen.value;
    if(per==''){n10=0}else{n10=eval(calculate.persen.value)};
           
    aa.value = (n1 * n10 /100).toFixed(2);
    ca.value = (n2 * n10 /100).toFixed(2);
    cxa.value = (n3 * n10 /100).toFixed(2);
    cna.value = (n31 * n10 /100).toFixed(2);
    ab.value = (n4 * n10 /100).toFixed(2);
    cb.value = (n5 * n10 /100).toFixed(2);
    cxb.value = (n6 * n10 /100).toFixed(2);
    cnb.value = (n61 * n10 /100).toFixed(2);
    ac.value = (n7 * n10 /100).toFixed(2);
    cc.value = (n8 * n10 /100).toFixed(2);
    cxc.value = (n9 * n10 /100).toFixed(2);
    cnc.value = (n91 * n10 /100).toFixed(2);
    if (isNaN(aa.value) ) {
      aa.value=(n1).toFixed(2) ;   
      }
    if (isNaN(ca.value) ) {
      ca.value=(n2).toFixed(2) ;   
      }
    if (isNaN(cxa.value) ) {
      cxa.value=(n3).toFixed(2) ;   
      }
    if (isNaN(cna.value) ) {
      cna.value=(n31).toFixed(2) ;   
      }
    if (isNaN(ab.value) ) {
      ab.value=(n4).toFixed(2) ;   
      }
    if (isNaN(cb.value) ) {
      cb.value=(n5).toFixed(2) ;   
      }
    if (isNaN(cxb.value) ) {
      cxb.value=(n6).toFixed(2) ;   
      }
    if (isNaN(cnb.value) ) {
      cnb.value=(n61).toFixed(2) ;   
      }
    if (isNaN(ac.value) ) {
      ac.value=(n7).toFixed(2) ;   
      }
    if (isNaN(cc.value) ) {
      cc.value=(n8).toFixed(2) ;   
      }
    if (isNaN(cxc.value) ) {
      cxc.value=(n9).toFixed(2) ;   
      }
    if (isNaN(cnc.value) ) {
      cnc.value=(n91).toFixed(2) ;   
      }
      UpdateSell()
 }
function USall(){
    var discaa = calculate.discaa;
    discaa.value = calculate.discall.value;
    var discab = calculate.discca;
    discab.value = calculate.discall.value;
    var discac = calculate.disccxa;
    discac.value = calculate.discall.value;
    var discad = calculate.disccna;
    discad.value = calculate.discall.value;
    var discba = calculate.discab;
    discba.value = calculate.discall.value;
    var discbb = calculate.disccb;
    discbb.value = calculate.discall.value;
    var discbc = calculate.disccxb;
    discbc.value = calculate.discall.value;
    var discbd = calculate.disccnb;
    discbd.value = calculate.discall.value;
    var discca = calculate.discac;
    discca.value = calculate.discall.value;
    var disccb = calculate.disccc;
    disccb.value = calculate.discall.value;
    var disccc = calculate.disccxc;
    disccc.value = calculate.discall.value;
    var disccd = calculate.disccnc;
    disccd.value = calculate.discall.value;
    UpdateSell()
    }
function UpdateSell(){
    var aa = calculate.sellaa;
    var ca = calculate.sellca; 
    var cxa = calculate.sellcxa;
    var cna = calculate.sellcna;
    var ab = calculate.sellab;
    var cb = calculate.sellcb; 
    var cxb = calculate.sellcxb;
    var cnb = calculate.sellcnb;
    var ac = calculate.sellac;
    var cc = calculate.sellcc; 
    var cxc = calculate.sellcxc;
    var cnc = calculate.sellcnc;  
    var n1 = eval(calculate.nettaa.value); var n11 = eval(calculate.paa.value); var n12 = eval(calculate.discaa.value);
    var n2 = eval(calculate.nettca.value); var n21 = eval(calculate.pca.value); var n22 = eval(calculate.discca.value);
    var n3 = eval(calculate.nettcxa.value); var n31 = eval(calculate.pcxa.value); var n32 = eval(calculate.disccxa.value);
    var n3n = eval(calculate.nettcna.value); var n31n = eval(calculate.pcna.value); var n32n = eval(calculate.disccna.value);
    var n4 = eval(calculate.nettab.value); var n41 = eval(calculate.pab.value); var n42 = eval(calculate.discab.value);
    var n5 = eval(calculate.nettcb.value); var n51 = eval(calculate.pcb.value); var n52 = eval(calculate.disccb.value);
    var n6 = eval(calculate.nettcxb.value); var n61 = eval(calculate.pcxb.value); var n62 = eval(calculate.disccxb.value);
    var n6n = eval(calculate.nettcnb.value); var n61n = eval(calculate.pcnb.value); var n62n = eval(calculate.disccnb.value);
    var n7 = eval(calculate.nettac.value); var n71 = eval(calculate.pac.value); var n72 = eval(calculate.discac.value);
    var n8 = eval(calculate.nettcc.value); var n81 = eval(calculate.pcc.value); var n82 = eval(calculate.disccc.value);
    var n9 = eval(calculate.nettcxc.value); var n91 = eval(calculate.pcxc.value); var n92 = eval(calculate.disccxc.value);
    var n9n = eval(calculate.nettcnc.value); var n91n = eval(calculate.pcnc.value); var n92n = eval(calculate.disccnc.value);        
    aa.value = (n1 + n11 + n12).toFixed(2) ;
    ca.value = (n2 + n21 + n22).toFixed(2) ;
    cxa.value = (n3 + n31 + n32).toFixed(2) ;
    cna.value = (n3n + n31n + n32n).toFixed(2) ;
    ab.value = (n4 + n41 + n42).toFixed(2) ;
    cb.value = (n5 + n51 + n52).toFixed(2) ;
    cxb.value = (n6 + n61 + n62).toFixed(2) ;
    cnb.value = (n6n + n61n + n62n).toFixed(2) ;
    ac.value = (n7 + n71 + n72).toFixed(2) ;
    cc.value = (n8 + n81 + n82).toFixed(2) ;        
    cxc.value = (n9 + n91 + n92).toFixed(2) ;
    cnc.value = (n9n + n91n + n92n).toFixed(2) ;        
    if (isNaN(aa.value) || n12==0 || n12=='') {
      aa.value=(n1 + n11).toFixed(2) ;    
      }
    if (isNaN(ca.value) || n22==0 || n22=='') {
      ca.value=(n2 + n21).toFixed(2) ;  
      }
    if (isNaN(cxa.value) || n32==0 || n32=='') {
      cxa.value=(n3 + n31).toFixed(2) ;  
      }
    if (isNaN(cna.value) || n32n==0 || n32n=='') {
      cna.value=(n3n + n31n).toFixed(2) ;  
      }
    if (isNaN(ab.value) || n42==0 || n42=='') {
      ab.value=(n4 + n41).toFixed(2) ;  
      }
    if (isNaN(cb.value) || n52==0 || n52=='') {
      cb.value=(n5 + n51).toFixed(2) ;  
      }
    if (isNaN(cxb.value) || n62==0 || n62=='') {
      cxb.value=(n6 + n61).toFixed(2) ;  
      }
    if (isNaN(cnb.value) || n62n==0 || n62n=='') {
      cnb.value=(n6n + n61n).toFixed(2) ;  
      }
    if (isNaN(ac.value) || n72==0 || n72=='') {
      ac.value=(n7 + n71).toFixed(2) ;  
      }
    if (isNaN(cc.value) || n82==0 || n82=='') {
      cc.value=(n8 + n81).toFixed(2) ;  
      }
    if (isNaN(cxc.value) || n92==0 || n92=='') {
      cxc.value=(n9 + n91).toFixed(2) ;  
      }
    if (isNaN(cnc.value) || n92n==0 || n92n=='') {
      cnc.value=(n9n + n91n).toFixed(2) ;  
      }
 }
function offemb()
{                                       
document.example.elements['embassy01'].disabled=true;
document.example.elements['embassy02'].disabled=true;
document.example.elements['embassy03'].disabled=true;
document.example.elements['embassy04'].disabled=true;
document.example.elements['embassy05'].disabled=true;
document.example.elements['embassy01'].selectedIndex=0;
document.example.elements['embassy02'].selectedIndex=0;
document.example.elements['embassy03'].selectedIndex=0;
document.example.elements['embassy04'].selectedIndex=0;
document.example.elements['embassy05'].selectedIndex=0;
document.example.elements['visatimeframe'].value=0;
document.example.elements['visadateline'].value='';    
}
function onemb()
{                                      
document.example.elements['embassy01'].disabled=false;
document.example.elements['embassy02'].disabled=false; 
document.example.elements['embassy03'].disabled=false;
document.example.elements['embassy04'].disabled=false;
document.example.elements['embassy05'].disabled=false;  
}
function oncurr()
{                          
var curr1 = example.quotationcurr.value;
var curr2 = example.sellingcurr.value;
    if(curr1==curr2){
        document.example.elements['sellingrate'].disabled=true;
        document.example.elements['sellingrate'].value=1;
    }else{
        document.example.elements['sellingrate'].disabled=false;
    }
}
function Sowit() {   
document.example.iwant.value='Copy From'; 
document.example.iwant.disabled=true;       
document.getElementById('idcopy').style.visibility='visible';
document.getElementById('apdet').style.visibility='visible';    
}
function airshow(ID,Q,PROD) {   
var air1 = example.flight.value;
document.calculate.airlines.value=air1; 
window.location.href = '?module=msproduct&act=simpanair&air=' + air1 + '&no=' + ID + '&prod=' + PROD + '&q=' + Q;                       
} 
</script>
<SCRIPT type="text/javascript">
pic1 = new Image(16, 16); 
pic1.src = "./modul/loader.gif";

function cektur() { 

var usr = $("#tourcode").val();
var tahun = $("#year").val();

if(usr.length >= 3)
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
    $("#status").html('<font color="red">Tour Code should have at least <strong>3</strong> characters.</font>');
    $("#tourcode").removeClass('object_ok'); // if necessary
    $("#tourcode").addClass("object_error");
    }

}

//-->
</SCRIPT>
<script type="text/javascript">
function kopitgl() {
var datefrom = example.datetravelfrom.value; 
example.datetravelto.value= datefrom;   
}
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
var empat = example.flight.value; 
if(empat.length>1){
var satu = example.productcode.value;   
var lama = example.daystravel.value;
if (lama.length==1){dua="0"+lama}
else {dua =lama}
dep = example.datetravelfrom.value; 
dep1 = dep.split("-");
var tiga = dep1[1]+ "" +dep1[0]; 
example.tourcode.value = satu+"-"+ dua + " " + tiga +"/" + empat ;
}
var radiovalue= $('input[name="visa"]:checked').val();
if(radiovalue!='NO REQUIRED'){
vtm = example.visatimeframe.value
var previousweek= new Date(a.getTime() - vtm * 24 * 60 * 60 * 1000);
 var date = new Date(previousweek);
 var d  = date.getDate();
 var day = (d < 10) ? '0' + d : d;
 var m = date.getMonth() + 1;
 var month = (m < 10) ? '0' + m : m;
 var yy = date.getYear();
 var year = (yy < 1000) ? yy + 1900 : yy;
 var depdate = day + "-" + month + "-" + year  ;     
 example.visadateline.value=depdate;
} 
}        
function turcode() {
var satu = example.productcode.value;   
var lama = example.daystravel.value;
if (lama.length==1){dua="0"+lama}
else {dua =lama}
dep = example.datetravelfrom.value; 
dep1 = dep.split("-");
var tiga = dep1[1]+ "" +dep1[0];
var empat = example.flight.value;         
example.tourcode.value = satu+"-"+ dua + " " + tiga +"/" + empat ;
cektur()
} 
function turcodetmr() {
var satu = calculate.productcode.value;   
var lama = calculate.daystravel.value;
if (lama.length==1){dua="0"+lama}
else {dua =lama}
dep = calculate.datetravelfrom.value; 
dep1 = dep.split("-");
var tiga = dep1[1]+ "" +dep1[0];
var empat = calculate.airlines.value;         
calculate.tourcode.value = satu+"-"+ dua + " " + tiga +"/" + empat ;

}   
function isNumber(field) {
var re = /^[0-9'.']*$/;
if (!re.test(field.value)) {
alert('PLEASE INPUT NUMBER!');
field.value = field.value.replace(/[^0-9'.']/g,"");
}
}
function validateFormGRV(theForm) {
    var reason = "";
    reason += validateSelect(theForm.producttype);
    reason += validateSelect(theForm.productcode);
    reason += validateSelect(theForm.flight);
    reason += validateEmpty(theForm.tourcode);
    reason += validatePhone(theForm.seat);
    if (reason != "") {
        alert("Some fields need correction:\n" + reason);
        return false;
    }

    return true;
}
function validateFormsOnSubmit(theForm) {
var reason = ""; 
  reason += validateSelect(theForm.season);
  reason += validateCek(theForm.seat);     
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);
    return false;
  }

  return true;
}
function validateFormsKosong(theForm) {
var reason = ""; 
  reason += validateAirlines(theForm.airlines);
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
  reason += validateSelect(theForm.season);
  reason += validateSelect(theForm.producttype);
  reason += validateSelect(theForm.grouptype);
  reason += validateSelect(theForm.productcode);  
  reason += validateDate(theForm.datetravelfrom);
  reason += validateDateto(theForm.datetravelto); 
  reason += validateSelect(theForm.flight);
  reason += validateEmpty(theForm.tourcode);  
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
function validateCek(fld) {
    var error = "";
    var arr = eval(example.adaseat.value);    
    var dep = eval(example.seat.value);
                                      
    if(dep==0){
        fld.style.background = 'Yellow'; 
        error = "Please Input Min 1 seat.\n"    
    }else{
        if (dep < arr) {
            fld.style.background = 'Yellow'; 
            error = "Already booking " + arr + " seat .\n"
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
function validateAirlines(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        fld.style.background = 'Yellow'; 
        error = "Please Select Airlines"
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
<script type='text/javascript'>
 function showDate()
 {
          
 <?PHP                                                   
 $q1 = "SELECT * FROM tour_msgrv group by GrvAirlines ";
 $h1 = mysql_query($q1);  
 // dapetin pesawat
 while ($d1 = mysql_fetch_array($h1))
 {
 $id1 = $d1['GrvAirlines'];
 echo "if (document.flight.pesawat.value == \"".$id1."\")"; 
 echo "{";
 
     // membaca semua data currency
     $query = "SELECT * FROM tour_msgrv where GrvAirlines = '$id1' group by GrvCityOfDep ";
     $hasil = mysql_query($query);  
     // membuat if untuk masing-masing pilihan currency 
     while ($data = mysql_fetch_array($hasil))
     {
       $idDest = $data['GrvCityOfDep'];                                                  
       // membuat IF untuk masing-masing currency
       echo "if (document.flight.kota.value == '$idDest')"; 
       echo "{";       
        
       // membuat hasil kurs untuk masing-masing currency
       $query2 = "SELECT * FROM tour_msgrv 
                    WHERE GrvCityOfDep = '$idDest' AND GrvAirlines = '$id1' group by GrvDateOfDep ASC ";
       $hasil2 = mysql_query($query2);
       $content = "document.getElementById('tanggal').innerHTML = \"";
       $content .= "<option value='0'>- select -</option>";
       while ($data2 = mysql_fetch_array($hasil2))
       {   $DT = date('d M Y', strtotime($data2[GrvDateOfDep]));
           $content .= "<option value='".$data2['GrvDateOfDep']."'>".$DT."</option>";
       }
       $content .= "\"";
       echo $content;
       echo "}\n";
       echo "else if (document.flight.kota.value == '0'){(";
       
       // membuat hasil kurs untuk masing-masing currency
       $content = "document.getElementById('tanggal').innerHTML = \"";
       $content .= "<option value=''>- select -</option>";   
       $content .= "\"";    
       echo $content; 
       echo ")(";
       
       // membuat hasil kurs untuk masing-masing currency
       $content = "document.getElementById('idgrv').innerHTML = \"";
       $content .= "<option value=''>- select -</option>";   
       $content .= "\"";    
       echo $content; 
       echo ")}\n";  
     }
     echo "} \n";
 }
  ?>    
  
 } 
function showCity()
 {                                    
 <?PHP                                                   
 // membaca semua data currency
 $query = "SELECT * FROM tour_msgrv group by GrvAirlines ";
 $hasil = mysql_query($query);
 
 // membuat if untuk masing-masing pilihan currency 
 while ($data = mysql_fetch_array($hasil))
 {
   $idDest = $data['GrvAirlines'];                                                  
   // membuat IF untuk masing-masing currency
   echo "if (document.flight.pesawat.value == \"".$idDest."\")"; 
   echo "{(";       
    
   // membuat hasil kurs untuk masing-masing currency
   $query2 = "SELECT * FROM tour_msgrv 
                WHERE GrvAirlines = '$idDest' group by GrvCityOfDep ASC ";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('kota').innerHTML = \"";
   $content .= "<option value='0'>- select -</option>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['GrvCityOfDep']."'>".$data2['GrvCityOfDep']."</option>";
   }
   $content .= "\"";
   echo $content;
   echo ")(";
   
   // membuat hasil kurs untuk masing-masing currency
   $content = "document.getElementById('tanggal').innerHTML = \"";
   $content .= "<option value=''>- select -</option>";   
   $content .= "\"";    
   echo $content; 
   echo ")(";               
   // membuat hasil kurs untuk masing-masing currency
   $content = "document.getElementById('idgrv').innerHTML = \"";
   $content .= "<option value=''>- select -</option>";   
   $content .= "\"";    
   echo $content; 
   echo ")}\n"; 
   echo "else if (document.flight.pesawat.value == '0'){(";
   
   // membuat hasil kurs untuk masing-masing currency
   $content = "document.getElementById('kota').innerHTML = \"";
   $content .= "<option value=''>- select -</option>";   
   $content .= "\"";    
   echo $content; 
   echo ")(";
   
   // membuat hasil kurs untuk masing-masing currency
   $content = "document.getElementById('tanggal').innerHTML = \"";
   $content .= "<option value=''>- select -</option>";   
   $content .= "\"";    
   echo $content; 
   echo ")(";
   
   // membuat hasil kurs untuk masing-masing currency
   $content = "document.getElementById('idgrv').innerHTML = \"";
   $content .= "<option value=''>- select -</option>";   
   $content .= "\"";    
   echo $content; 
   echo ")}\n";        
 }
  ?>
 
 } 
 function showPNR()
 {                                    
 <?PHP                                                   
 $q1 = "SELECT * FROM tour_msgrv group by GrvAirlines ";
 $h1 = mysql_query($q1);  
 // dapetin pesawat
 while ($d1 = mysql_fetch_array($h1))
 {
 $id1 = $d1['GrvAirlines'];
 echo "if (document.flight.pesawat.value == \"".$id1."\")"; 
 echo "{";
     $q2 = "SELECT * FROM tour_msgrv where GrvAirlines = '$id1' group by GrvCityOfDep";
     $h2 = mysql_query($q2);  
     // dapetin kota
     while ($d2 = mysql_fetch_array($h2))
     {
     $id2 = $d2['GrvCityOfDep'];
     echo "if (document.flight.kota.value == \"".$id2."\")"; 
     echo "{";
         $q3 = "SELECT * FROM tour_msgrv where GrvStatus <> 'VOID' and GrvAirlines = '$id1' AND GrvCityOfDep = '$id2' group by GrvDateOfDep";
         $h3 = mysql_query($q3);  
         // dapetin kota
         while ($d3 = mysql_fetch_array($h3))
         {
         $id3 = $d3['GrvDateOfDep'];
         echo "if (document.flight.tanggal.value == \"".$id3."\")"; 
         echo "{";
     // membaca semua data currency
         
           // membuat hasil kurs untuk masing-masing currency
           $query2 = "SELECT * FROM tour_msgrv 
                        WHERE GrvAirlines = '$id1' AND GrvCityOfDep = '$id2' AND GrvDateOfDep = '$id3' and GrvStatus <> 'VOID' group by GrvPnr ASC ";
           $hasil2 = mysql_query($query2);
           $content = "document.getElementById('idgrv').innerHTML = \"";
           $content .= "<option value='0'>- select -</option>";
           while ($data2 = mysql_fetch_array($hasil2))
           {
               $content .= "<option value='".$data2['IDGrv']."'>".$data2['GrvPnr']." (".$data2['GrvArea'].")</option>";
           }
           $content .= "\"";
           echo $content;
           echo "}\n";
           echo "else if (document.flight.tanggal.value == '0'){";
           
           // membuat hasil kurs untuk masing-masing currency
           $content = "document.getElementById('idgrv').innerHTML = \"";
           $content .= "<option value=''>- select -</option>";   
           $content .= "\"";    
           echo $content; 
           echo "}\n";        
       
     }
     echo "} \n";
     }
     echo "} \n";
 }
  ?>
 
 } 
</script>
<script type="text/javascript">
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
<?PHP   
$username=$_SESSION['employee_code'];
$sqluser=mysql_query("SELECT employee_name, employee_code, office_code, office_group, ltm_authority FROM tbl_msemployee
                        left join tbl_msoffice on tbl_msoffice.office_id = tbl_msemployee.office_id
                        WHERE employee_code='$username'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName="$tampiluser[employee_name] ($tampiluser[employee_code])";
$EmpOff=$tampiluser[office_code];   
$offgroup=$tampiluser[office_group];
$ltmauthority=$tampiluser[ltm_authority];
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
switch($_GET['act']){
  // Tampil Office
  default:
      $nama=$_GET['nama'];
      $opnama=$_GET['opnama'];
      if($opnama==''){$opnama='TourCode';}
    echo "<h2>Master Product </h2>  
          Search By :
          <form method=get action='media.php?'>
                <input type=hidden name=module value='msproduct'>
              <select name='opnama'><option value=''";if($opnama==''){echo"selected";}echo">- please select -</option>
                                    <option value='TourCode'";if($opnama=='TourCode'){echo"selected";}echo">Tour Code</option>
                                    <option value='DateTravelFrom'";if($opnama=='DateTravelFrom'){echo"selected";}echo">Departure Date</option>
                                    <option value='Flight'";if($opnama=='Flight'){echo"selected";}echo">Flight</option>
                                    <option value='Destination'";if($opnama=='Destination'){echo"selected";}echo">Destination</option>
                                    <option value='ProductCodeName'";if($opnama=='ProductCodeName'){echo"selected";}echo">Product</option>
                                    <option value='DaysTravel'";if($opnama=='DaysTravel'){echo"selected";}echo">Days</option>
                                    <option value='Season'";if($opnama=='Season'){echo"selected";}echo">Season</option>
              </select> <input type=text name='nama' value='$nama' size=20>    
              <input type=submit name=oke value=Search>
          </form><input type=button value='Add New Product' onclick=location.href='?module=msproduct&act=tambahmsproduct'>";
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
            
            // Langkah 2   AND DateTravelFrom > '$hari' 
            if($EmpOff=='IFM' or preg_match('/LTM/',$EmpOff)){
            $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                WHERE $opnama LIKE '%$nama%'
                                AND Status <> 'VOID' 
                                AND DateTravelFrom > '$hari'
                                ORDER BY DateTravelFrom DESC LIMIT $posisi,$batas");     
            }else if(preg_match('/LTM/',$EmpOff)){
                $tampil=mysql_query("SELECT * FROM tour_msproduct
                                WHERE $opnama LIKE '%$nama%'
                                AND Status <> 'VOID'
                                AND DateTravelFrom > '$hari'
                                AND Company = '$offgroup'
                                ORDER BY DateTravelFrom DESC LIMIT $posisi,$batas");
            }else{
            $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                WHERE $opnama LIKE '%$nama%'
                                AND Status <> 'VOID' 
                                AND DateTravelFrom > '$hari'
                                AND InputDivision = '$EmpOff'
                                ORDER BY DateTravelFrom DESC LIMIT $posisi,$batas");    
            }
            $jumlah=mysql_num_rows($tampil);
            if ($jumlah > 0) {
            echo "<table>
                    <tr><th>no</th><th>product</th><th>type</th><th>tour code</th><th>days</th><th>departure</th><th>flight</th><th>seat</th><th>season</th><th>status</th><th>tour leader</th><th>option</th></tr>";
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
                    $edit1=mysql_query("SELECT * FROM tour_msbooking WHERE IDTourCode ='$data[IDProduct]' and Status = 'ACTIVE' ");  
                    $r2=mysql_num_rows($edit1);
                    $itin=mysql_query("SELECT * FROM tour_msitin WHERE ProductID ='$data[IDProduct]' group by ProductID ");  
                    $isiitin=mysql_num_rows($itin);
                    if($isiitin>0){$tom='enabled';}else{$tom='disabled';}
                    if($r2 > 0){$editan="editmsproductapp";}
                    else{$editan="editmsproduct";}

                    if($data[Status]=='NOT PUBLISHED'){$status="<font color=red>$data[Status]</font>";$status2="<font color=red><b>UNPUBLISH</b></font>";}
                    else if($data[Status]=='PUBLISH'){$status="<font color=green><b>$data[Status]</b></font>";$status2="<font color=green><b>PUBLISH</b></font>";}

					
                    if($data[SellingAdlTwn]=='0' and $data[SellingChdTwn]=='0' and $data[SellingChdXbed]=='0' and $data[SellingChdNbed]=='0' and $data[SellingInfant]=='0'){
                        $lok="<input type=button value='LOCK PRICE' disabled>";
                    }else{   
                        $lok="<input type=button value='LOCK PRICE' onclick=\"javascript:lockprice('$data[IDProduct]','$data[Year]')\">";
                    }
                    $DTF = date('d-m-Y', strtotime($data[DateTravelFrom]));       
               echo "<tr><td>$no</td>
                     <td>$data[ProductCode] - $data[ProductCodeName]</td>
                     <td><center>$data[GroupType]</td>
                     <td><a href=\"javascript:PopupCenter('optionprod.php?code=$data[IDProduct]','variable',180,210)\">$data[TourCode]</a></td>
                     <td><center>$data[DaysTravel]</td>
                     <td>$DTF</td>
                     <td><center>$data[Flight]</td>
                     <td><center>$data[Seat]</td>
                     <td><center>$data[Season]</td>   
                     <td><center>";
					 //ini buat klik publish unpublish
                     //if($data[TotalAdult]=='0' || $data[Status]=='VOID'  ){ echo"$status2</td>";
                     //}else
					 if($data[QuotationStatus]=='APPROVE' AND $data[Status]<>'VOID'){ echo"<a href=\"javascript:publishprod('$data[IDProduct]')\">$status2</a></td>";
                     }else{echo"$data[QuotationStatus]</td>";}
               echo "<td>$data[TourLeader]</td>   
                     <td><center>
                     <input type='button' value='VIEW ATTACH' onclick=location.href='?module=msitin&act=showitin&id=$data[IDProduct]' $tom>
                     $lok
                     <input type='button' value='VOID' onclick=\"javascript:delfile('$data[IDProduct]','$data[TourCode]')\">                    
                     </td></tr>";
                      $no++;
                    }
                    echo "</table>";
                    
                    // Langkah 3            
                    if($EmpOff=='IFM' or preg_match('/LTM/',$EmpOff)){
                    $tampil2    = "SELECT * FROM tour_msproduct   
                                WHERE $opnama LIKE '%$nama%'
                                AND Status <> 'VOID' 
                                AND DateTravelFrom > '$hari'
                                ORDER BY DateTravelFrom DESC";
                    }else if(preg_match('/LTM/',$EmpOff)){
                        $tampil2    = "SELECT * FROM tour_msproduct
                                WHERE $opnama LIKE '%$nama%'
                                AND Status <> 'VOID'
                                AND DateTravelFrom > '$hari'
                                AND Company = '$offgroup'
                                ORDER BY DateTravelFrom DESC";
                    }else{
                    $tampil2    = "SELECT * FROM tour_msproduct   
                                WHERE $opnama LIKE '%$nama%'
                                AND Status <> 'VOID' 
                                AND DateTravelFrom > '$hari'
                                AND InputDivision = '$EmpOff'
                                ORDER BY DateTravelFrom DESC";    
                    }
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=msproduct";
                    // Link ke halaman sebelumnya (previous)
                    echo "<center><div id='paging'>";
                    if ($halaman >1) {
                        $previous = $halaman-1;
                        echo "<a href=$file&halaman=1&opnama=$opnama&nama=$nama&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&opnama=$opnama&nama=$nama&oke=$oke> < Previous</a> | ";
                    } else {
                        echo "<< First | < Previous | ";
                    }
                    // Tampilkan link halaman 1,2,3 ... modifikasi ala google
                    // Angka awal
                    $angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
                    for ($i=$halaman-2; $i<$halaman; $i++) {
                        if ($i < 1 )
                            continue;
                        $angka .= "<a href=$file&halaman=$i&opnama=$opnama&nama=$nama&oke=$oke>$i</a> ";
                    }
                    // Angka tengah
                    $angka .= " <b>$halaman</b> ";
                    for ($i=$halaman+1; $i<($halaman+3); $i++) {
                        if ($i > $jmlhalaman)
                            break;
                        $angka .= "<a href=$file&halaman=$i&opnama=$opnama&nama=$nama&oke=$oke>$i</a> ";    
                    }
                    // Angka akhir
                    $angka .= ($halaman+2<$jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&opnama=$opnama&nama=$nama&oke=$oke>$jmlhalaman</a> |" : " ");
                    // Cetak angka seluruhnya (awal, tengah, akhir)
                    echo "$angka";
                    // Link ke halaman berikutnya (Next)
                    if ($halaman < $jmlhalaman) {
                        $next = $halaman+1;
                        echo "<a href=$file&halaman=$next&opnama=$opnama&nama=$nama&oke=$oke> Next ></a> |
                              <a href=$file&halaman=$jmlhalaman&opnama=$opnama&nama=$nama&oke=$oke> Last >></a> ";
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
  
case "tambahmsproduct":
            $thisyear = date("Y");
            $nextyear = $thisyear+1;
            
    echo "<h2>New Product</h2>
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msproduct&act=input' enctype='multipart/form-data'>
          <table>
          <tr><td>Season</td> <td>  
            <select name='season'>
            <option value='0' selected>- Select Season -</option>";
            if(isset($_POST['redirected'])) { $seasonb=$_POST['season']; }  
            $tampil=mysql_query("SELECT * FROM tour_msseason where SeasonStatus='ACTIVE' ORDER BY SeasonName");
            while($r=mysql_fetch_array($tampil)){
                if($seasonb==$r[SeasonName]){
                    echo "<option value='$r[SeasonName]' selected>$r[SeasonName]</option>";     
                }else{
                    echo "<option value='$r[SeasonName]'>$r[SeasonName]</option>"; 
                }
                
            }
    echo "</select>
            <select name='year' id='year'>
            <option value='$thisyear' selected>$thisyear</option>
            <option value='$nextyear' >$nextyear</option>
            </select>
            <input type=radio name='seasontype' value='LOW' checked>&nbsp;Low Season
            <input type=radio name='seasontype' value='HIGH'>&nbsp;High Season</td></tr>
            
            <tr><td>Product by</td> <td>
            <select name='producttype'>
            <option value='0' selected>- Select Type -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msproducttype where Status='ACTIVE' ORDER BY ProducttypeName");
            if(isset($_POST['redirected'])) { $producttypeb=$_POST['producttype']; }
            
            while($r=mysql_fetch_array($tampil)){
                if($producttypeb==$r[ProducttypeName]){
                    echo "<option value='$r[ProducttypeName]' selected>$r[ProducttypeName]</option>";    
                }else{
                    echo "<option value='$r[ProducttypeName]'>$r[ProducttypeName]</option>";
                }
                
            }
    echo "</select></td></tr>
            <tr><td>Handle by</td>     <td>";   
            if(isset($_POST['redirected'])) { $departmentb=$_POST['department']; }   
    echo "<select name='department'>
            <option value='0' selected>- Select Type -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msproducttype where Status='ACTIVE' ORDER BY ProducttypeName");
            if(isset($_POST['redirected'])) { $producttypeb=$_POST['department']; }    
            while($r=mysql_fetch_array($tampil)){
                if($departmentb==$r[ProducttypeName]){
                    echo "<option value='$r[ProducttypeName]' selected>$r[ProducttypeName]</option>";    
                }else{
                    echo "<option value='$r[ProducttypeName]'>$r[ProducttypeName]</option>";
                }
                
            }
    echo "</select>
            </select></td></tr>
            <tr><td>Product Type</td> <td>  
            <select name='grouptype'>
            <option value='0' selected>- Select Type -</option>";
            if(isset($_POST['redirected'])) { $grouptypeb=$_POST['grouptype']; }
            
            $tampil=mysql_query("SELECT * FROM tour_msgroup where Status = 'ACTIVE' ORDER BY GroupName");
            while($r=mysql_fetch_array($tampil)){
                if($grouptypeb==$r[GroupName]){
                    echo "<option value='$r[GroupName]' selected>$r[GroupName]</option>";    
                }else{
                    echo "<option value='$r[GroupName]'>$r[GroupName]</option>";
                }
                
            }
    echo "</select>
          </td></tr>
          
          <tr><td>BSO Handler</td>  <td>  
          <select name='productfor'>
            <option value='ALL' selected>- ALL -</option>";
            
            $tampil=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name");
            while($r=mysql_fetch_array($tampil)){
                if($prodforb==$r[office_code]){
                    echo "<option value='$r[office_code]' selected>$r[office_code]</option>";    
                }else{
                    echo "<option value='$r[office_code]'>$r[office_code]</option>";    
                }         
            }    
    echo "</select>
          </td></tr>
          <tr><td>Product Code/Name</td> <td>  <select name='productcode' onChange='turcode()'>
            <option value='0' selected>- Select Product -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msproductcode ORDER BY ProductcodeName");
            if(isset($_POST['redirected'])) { $productcodeb=$_POST['productcode']; }
            while($r=mysql_fetch_array($tampil)){
                if($productcodeb==$r[ProductcodeName]){
                    echo "<option value='$r[ProductcodeName]' selected>$r[ProductcodeName] - $r[Productcode]</option>";    
                }else{
                    echo "<option value='$r[ProductcodeName]'>$r[ProductcodeName] - $r[Productcode]</option>";
                }
                
            }
    echo "</select></td></tr>    
            <tr><td>Date of Service</td> <td>From <input type='text' value='";if(isset($_POST['redirected'])) { echo $_POST['datetravelfrom']; } echo"'  name='datetravelfrom' size='10' onfocus='selisih()' onblur='kopitgl()' onClick="."cal.select(document.forms['example'].datetravelfrom,'ActIn1','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(dd-mm-yyyy)</font>
          - To <input type=text value='";if(isset($_POST['redirected'])) { echo $_POST['datetravelto']; } echo"' name='datetravelto' size='10' onfocus='selisih()' onClick="."cal.select(document.forms['example'].datetravelto,'anchor2','dd-MM-yyyy'); return false;"." NAME='anchor2' ID='anchor2'>
           <font color='red'>(dd-mm-yyyy)</font></td></tr>
           <tr><td>Number of Days</td> <td><input type=text name='daystravel' id='daystravel' value='";if(isset($_POST['redirected'])) { echo $_POST['daystravel']; } echo"' size='3'> days</td></tr>   
          <tr><td>Flight</td> <td>  <select name='flight' onChange='turcode()'>
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
    echo "</select></td></tr>
          <tr><td>Tour Code</td> <td><input type=text name='tourcode' id='tourcode' value='"; if(isset($_POST['redirected'])) { echo $_POST['tourcode']; } echo"' onBlur='cektur()'><div  id='status'></div></td></tr> 
          <tr><td>Seat</td> <td><input type=text value='"; if(isset($_POST['redirected'])) { echo $_POST['seat']; }  echo"' name='seat' size='3' onkeyup='isNumber(this)'> Pax <font color='red'>*<i>Not Include Infant and Tour leader</i></font></td></tr>
          <tr><td>Tour Leader</td> <td>";   
          if(isset($_POST['redirected'])) { $tourleaderincb=$_POST['tourleaderinc']; }
          if($tourleaderincb=='NO'){$b='checked';}else{$a='checked';}
    echo "<input type=radio name='tourleaderinc' value='YES' $a>&nbsp;Yes
          <input type=radio name='tourleaderinc' value='NO' $b>&nbsp;No  
          </td></tr>
          <tr><td>Insurance</td> <td>";   
          if(isset($_POST['redirected'])) { $insuranceb=$_POST['insurance']; }
          if($insuranceb=='INCLUDE'){$a='checked';}else{$b='checked';}
    echo "<input type=radio name='insurance' value='INCLUDE' $a>&nbsp;Include
          <input type=radio name='insurance' value='NOT INCLUDE' $b>&nbsp;Not Include  
          </td></tr>
          <tr><td>Visa</td> <td>   
          <input type=radio name='visa' value='INCLUDE' onclick='onemb()'>&nbsp;Include
          <input type=radio name='visa' value='NOT INCLUDE' onclick='onemb()'>&nbsp;Not Include
          <input type=radio name='visa' value='NO REQUIRED' onclick='offemb()' checked>&nbsp;Not Required        
          </td></tr>
          <tr><td></td><td><select name='embassy01' onChange='showDay(1)' disabled>
            <option value='0' selected>- Embassy 01 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' AND Type='VISA' ORDER BY Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[CountryID],$r[VisaTimeFrame]'>$r[Country]</option>";
            }
    echo "</select><input type='hidden' name='idembassy01' id='idembassy01'>&nbsp&nbsp <select name='embassy03' onChange='showDay(3)' disabled >
            <option value='0' selected>- Embassy 03 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' AND Type='VISA' ORDER BY Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[CountryID],$r[VisaTimeFrame]'>$r[Country]</option>";
            }
    echo "</select><input type='hidden' name='idembassy03' id='idembassy03'>&nbsp&nbsp <select name='embassy05' onChange='showDay(5)' disabled >
            <option value='0' selected>- Embassy 05 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' AND Type='VISA' ORDER BY Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[CountryID],$r[VisaTimeFrame]'>$r[Country]</option>";
            }
    echo "</select><input type='hidden' name='idembassy05' id='idembassy05'></td></tr>
          <tr><td></td><td><select name='embassy02' onChange='showDay(2)' disabled >
            <option value='0' selected>- Embassy 02 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' AND Type='VISA' ORDER BY Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[CountryID],$r[VisaTimeFrame]'>$r[Country]</option>";
            }
    echo "</select><input type='hidden' name='idembassy02' id='idembassy02'>&nbsp&nbsp <select name='embassy04' onChange='showDay(4)' disabled >
            <option value='0' selected>- Embassy 04 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' AND Type='VISA' ORDER BY Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[CountryID],$r[VisaTimeFrame]'>$r[Country]</option>";
            }
    echo "</select><input type='hidden' name='idembassy04' id='idembassy04'>
            <input type='hidden' name='rangehari1' value='0'><input type='hidden' name='rangehari2' value='0'><input type='hidden' name='rangehari3' value='0'>
            <input type='hidden' name='rangehari4' value='0'><input type='hidden' name='rangehari5' value='0'>
            <input type='hidden' name='visatimeframe' value='0'></td></tr>
            <tr><td>Visa Time Limit</td><td><input type=text value='";if(isset($_POST['redirected'])) { echo $_POST['visadateline']; } echo"' name='visadateline' size='10'  onClick="."cal.select(document.forms['example'].visadateline,'anchor3','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='anchor3'> <font color='red'>(dd-mm-yyyy)</font></td></tr>
            
            <tr><td>Selling </td><td>Currency <select name='sellingcurr' onchange='oncurr()'>
                     <option value='USD' selected>USD</option>   
                     <option value='IDR' >IDR</option>
          </select></td></tr>
            
            <tr><td>Remarks</td><td><textarea name='remarks' cols='50' rows='3'>"; if(isset($_POST['redirected'])) { echo $_POST['remarks']; } echo"</textarea>  </td></tr>
             <input type='hidden' name='status' value='NOT PUBLISHED'>  
          <tr><td colspan=2><center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table> </form><br><br>";
          //attach
          //<tr><td>Attachment</td><td><input type='file' name='upload'>  </td></tr>
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
case "editmsproduct":
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $thisyear = date("Y");
    $nextyear = $thisyear+1;
    $DTF = date('d-m-Y', strtotime($r[DateTravelFrom]));  
    $DTT = date('d-m-Y', strtotime($r[DateTravelTo]));
    if($r[VisaDateline]=='0000-00-00'or $r[VisaDateline]=='1970-01-01'){$VisaDateLine ='';}else{$VisaDateLine = date('d-m-Y', strtotime($r[VisaDateline]));}
    echo "<h2>Edit Product</h2>
          <form method=POST name='example' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msproduct&act=update' enctype='multipart/form-data'>
          <input type=hidden name=id value='$r[IDProduct]'>
          <table>
             <tr><td>Season</td> <td>  
            <select name='season'>
            <option value='0' selected>- Select Season -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msseason where SeasonStatus='ACTIVE' ORDER BY SeasonName");
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
            </select>
            <input type=radio name='seasontype' value='LOW'";if($r[SeasonType]=='LOW' or $r[SeasonType]==''){echo"checked";}echo">&nbsp;Low Season
            <input type=radio name='seasontype' value='HIGH'";if($r[SeasonType]=='HIGH'){echo"checked";}echo">&nbsp;High Season</td></td></tr>
            <tr><td>Product by</td> <td>$r[ProductType]  <input type='hidden' name='producttype' value='$r[ProductType]'></td></tr> 
            <tr><td>Handle by</td>     <td>   
            <select name='department'> 
            <option value='0' selected>- Select Type -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msproducttype where Status = 'ACTIVE' ORDER BY ProducttypeName");
            while($s=mysql_fetch_array($tampil)){
                if($r[Department]==$s[ProducttypeName]){
                    echo "<option value='$s[ProducttypeName]' selected>$s[ProducttypeName]</option>";
                }else {
                    echo "<option value='$s[ProducttypeName]'>$s[ProducttypeName]</option>";
                }
            }
    echo "</select></td></tr> 
            <tr><td>Product Type</td> <td>  <select name='grouptype'>
            <option value='0' selected>- Select Type -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msgroup where Status = 'ACTIVE' ORDER BY GroupName");
            while($s=mysql_fetch_array($tampil)){
                if($r[GroupType]==$s[GroupName]){ 
                    echo "<option value='$s[GroupName]' selected>$s[GroupName]</option>";
                } else {
                    echo "<option value='$s[GroupName]'>$s[GroupName]</option>";    
                }
            }
    echo "</select></td></tr>
                                
          <tr><td>BSO Handler</td>  <td>  <select name='productfor'>
         <option value='ALL' selected>- ALL -</option>";
         $tampils=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name");
            while($r1=mysql_fetch_array($tampils)){
                if($r[ProductFor]==$r1[office_code]){
                    echo "<option value='$r1[office_code]' selected>$r1[office_code]</option>";    
                }else{
                    echo "<option value='$r1[office_code]'>$r1[office_code]</option>";
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
            $tampil=mysql_query("SELECT * FROM tour_msproductcode ORDER BY ProductcodeName");
            while($s=mysql_fetch_array($tampil)){
                if($r[ProductCode]==$s[ProductcodeName]){
                    echo "<option value='$s[ProductcodeName]' selected>$s[ProductcodeName] - $s[Productcode]</option>";
                } else {
                    echo "<option value='$s[ProductcodeName]'>$s[ProductcodeName] - $s[Productcode]</option>";    
                }
            }
    echo "</select></td></tr>    
            <tr><td>Date Travel</td> <td>From <input type='text' name='datetravelfrom' size='10' value='$DTF' onfocus='selisih()' onClick="."cal.select(document.forms['example'].datetravelfrom,'ActIn1','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(dd-mm-yyyy)</font>
          - To <input type=text name='datetravelto' size='10' value='$DTT' onfocus='selisih()' onClick="."cal.select(document.forms['example'].datetravelto,'anchor2','dd-MM-yyyy'); return false;"." NAME='anchor2' ID='anchor2'>
           <font color='red'>(dd-mm-yyyy)</font></td></tr>
           <tr><td>Days of Travel</td> <td><input type=text name='daystravel' id='daystravel' size='3' value='$r[DaysTravel]' readonly> days</td></tr>   
          <tr><td>Flight</td> <td>  <select name='flight' onChange='turcode()'>
            <option value='0' selected>- Select Airlines -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msairlines where AirlinesStatus='ACTIVE' ORDER BY AirlinesID");
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
          <input type=radio name='visa' value='NO REQUIRED' onclick='offemb()' ";if($r[Visa]=='NO REQUIRED'){$bisa='disabled';echo"checked";}echo">&nbsp;Not Required
          </td></tr>
          <tr><td></td><td><select name='embassy01' onChange='showDay(1)' $bisa>
            <option value='0' selected>- Embassy 01 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' AND Type='VISA' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy01]==$s[CountryID]){
                    $qid=mysql_query("SELECT * FROM tbl_msembassy where CountryID = '$r[Embassy01]'");
                    $idemb=mysql_fetch_array($qid);
                    $idembassy1=$idemb[CountryID]; $visarange1=$idemb[VisaTimeFrame];if($visarange1==''){$visarange1='0';}else{$visarange1=$visarange1;}
                    echo "<option value='$s[CountryID],$s[VisaTimeFrame]' selected>$s[Country]</option>";    
                }else {
                    $visarange1='0';
                    echo "<option value='$s[CountryID],$s[VisaTimeFrame]'>$s[Country]</option>";
                }
            }
    echo "</select><input type='hidden' name='idembassy01' id='idembassy01' value='$idembassy1'>&nbsp&nbsp <select name='embassy03' onChange='showDay(3)' $bisa>
            <option value='0' selected>- Embassy 03 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' AND Type='VISA' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy03]==$s[CountryID]){
                    $qid=mysql_query("SELECT * FROM tbl_msembassy where CountryID = '$r[Embassy03]'");
                    $idemb=mysql_fetch_array($qid);
                    $idembassy3=$idemb[CountryID]; $visarange3=$idemb[VisaTimeFrame];if($visarange3==''){$visarange3='0';}else{$visarange3=$visarange3;}
                    echo "<option value='$s[CountryID],$s[VisaTimeFrame]' selected>$s[Country]</option>";    
                }else {
                    $visarange3='0';
                    echo "<option value='$s[CountryID],$s[VisaTimeFrame]'>$s[Country]</option>";
                }
            }
    echo "</select><input type='hidden' name='idembassy03' id='idembassy03' value='$idembassy3'>&nbsp&nbsp <select name='embassy05' onChange='showDay(5)' $bisa>
            <option value='0' selected>- Embassy 05 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' AND Type='VISA' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy05]==$s[CountryID]){
                    $qid=mysql_query("SELECT * FROM tbl_msembassy where CountryID = '$r[Embassy05]'");
                    $idemb=mysql_fetch_array($qid);
                    $idembassy5=$idemb[CountryID]; $visarange5=$idemb[VisaTimeFrame];if($visarange5==''){$visarange5='0';}else{$visarange5=$visarange5;}
                    echo "<option value='$s[CountryID],$s[VisaTimeFrame]' selected>$s[Country]</option>";    
                }else {
                    $visarange5='0';
                    echo "<option value='$s[CountryID],$s[VisaTimeFrame]'>$s[Country]</option>";
                }
            }
    echo "</select><input type='hidden' name='idembassy05' id='idembassy05' value='$idembassy5'></td></tr>
          <tr><td></td><td><select name='embassy02' onChange='showDay(2)' $bisa>
            <option value='0' selected>- Embassy 02 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' AND Type='VISA' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy02]==$s[CountryID]){
                    $qid=mysql_query("SELECT * FROM tbl_msembassy where CountryID = '$r[Embassy02]'");
                    $idemb=mysql_fetch_array($qid);
                    $idembassy2=$idemb[CountryID]; $visarange2=$idemb[VisaTimeFrame];if($visarange2==''){$visarange2='0';}else{$visarange2=$visarange2;}
                    echo "<option value='$s[CountryID],$s[VisaTimeFrame]' selected>$s[Country]</option>";    
                }else {
                    $visarange2='0';
                    echo "<option value='$s[CountryID],$s[VisaTimeFrame]'>$s[Country]</option>";
                }
            }
    echo "</select><input type='hidden' name='idembassy02' id='idembassy02' value='$idembassy2'>&nbsp&nbsp <select name='embassy04' onChange='showDay(4)' $bisa>
            <option value='0' selected>- Embassy 04 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' AND Type='VISA' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy04]==$s[CountryID]){
                    $qid=mysql_query("SELECT * FROM tbl_msembassy where CountryID = '$r[Embassy04]'");
                    $idemb=mysql_fetch_array($qid);
                    $idembassy4=$idemb[CountryID]; $visarange4=$idemb[VisaTimeFrame];if($visarange4==''){$visarange4='0';}else{$visarange4=$visarange4;}
                    echo "<option value='$s[CountryID],$s[VisaTimeFrame]' selected>$s[Country]</option>";    
                }else {
                    $visarange4='0';
                    echo "<option value='$s[CountryID],$s[VisaTimeFrame]'>$s[Country]</option>";
                }
            }
    echo "</select><input type='hidden' name='idembassy04' id='idembassy04' value='$idembassy4'>
            <input type='hidden' name='rangehari1' value='$visarange1'><input type='hidden' name='rangehari2' value='$visarange2'><input type='hidden' name='rangehari3' value='$visarange3'>
            <input type='hidden' name='rangehari4' value='$visarange4'><input type='hidden' name='rangehari5' value='$visarange5'>
            <input type='hidden' name='visatimeframe' value='$r[VisaTimeFrame]'>
            </td></tr>      
            <tr><td>Visa Time Limit</td><td><input type=text value='$VisaDateLine' name='visadateline' size='10'  onClick="."cal.select(document.forms['example'].visadateline,'anchor3','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='anchor3'> <font color='red'>(dd-mm-yyyy)</font></td></tr>

            <tr><td>Selling</td><td>Currency <select name='sellingcurr'>
            <option value='USD'"; if($r[SellingCurr]=='USD'){echo"selected";}echo">USD</option>
            <option value='IDR'"; if($r[SellingCurr]=='IDR'){echo"selected";}echo">IDR</option></td></tr>";
            $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[AttachmentFile]) ) ) );
    if($r[AttachmentFile]<>''){echo"<tr><td>Attachment</td><td>
        <input type='hidden' name='attachmentfile' value='$r[AttachmentFile]'>
        <a href='$r[Attachment]$file' target='_blank' style=text-decoration:none >$r[AttachmentFile]</a></td></tr>";}
                                        echo"
            <tr><td>Remarks</td><td><textarea name='remarks' cols='50' rows='3'>$r[Remarks]</textarea>  </td></tr>   
          <tr><td colspan=2><center><input type='submit' name='submit' value='Update'>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;
    
case "editmsproductapp":
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    //if($r[SeatDeposit]<>'0'){$adabuking=$r[SeatDeposit];}else{$adabuking='0';}
    $adabuking=$r[SeatDeposit];
    $dari = date("d M Y", strtotime($r[DateTravelFrom]));
    $sampai = date("d M Y", strtotime($r[DateTravelTo]));
    if($r[VisaDateline]=='1970-01-01' OR $r[VisaDateline]=='0000-00-00'){
        $VisaDateline = 'NONE';
    }else{
        $VisaDateline = date("d M Y", strtotime($r[VisaDateline]));
    }
    echo "<h2>Edit Product</h2>
          <form method=POST name='example' onsubmit='return validateFormsOnSubmit(this)' action='./aksi.php?module=msproduct&act=updateprod' enctype='multipart/form-data'>
          <input type=hidden name=id value='$r[IDProduct]'><input type='hidden' name='adaseat' value='$adabuking'>
          <table>
           <tr><td>Season</td> <td><select name='season'>
            <option value='0' selected>- Select Season -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msseason ORDER BY SeasonName");
            while($s=mysql_fetch_array($tampil)){
                if($r[Season]==$s[SeasonName]){
                    echo "<option value='$s[SeasonName]' selected>$s[SeasonName]</option>";
                }else {
                    echo "<option value='$s[SeasonName]'>$s[SeasonName]</option>";    
                }
            }
    echo "</select> $r[Year]</td></tr>
          <tr><td>Product by</td> <td>";
            $tampil=mysql_query("SELECT * FROM tour_msproducttype ORDER BY ProducttypeName");
            while($s=mysql_fetch_array($tampil)){
                if($r[ProductType]==$s[ProducttypeName]){
                    echo "$s[ProducttypeName]";
                }
            }
    echo "</td></tr>                            
            <tr><td>Handle By</td><td>   
            ";if($r[Department]=='LEISURE'){echo"Leisure";}
            else if($r[Department]=='MINISTRY'){echo"Ministry";}  
    echo "</td></tr>
            <tr><td>Product Type</td> <td>";
            $tampil=mysql_query("SELECT * FROM tour_msgroup where Status = 'ACTIVE' ORDER BY GroupName");
            while($s=mysql_fetch_array($tampil)){
                if($r[GroupType]==$s[GroupName]){ 
                    echo "$s[GroupName]";
                } 
            }
    echo "</select></td></tr>
          
          <tr><td>BSO Handler</td>  <td>";
        if($r[ProductFor]<>'ALL'){
        $tampil=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name");
        while($w=mysql_fetch_array($tampil)){
          if ($r[ProductFor]==$w[office_code]){
            echo "$w[office_code]";
          } 
        }
        }else{echo"$r[ProductFor]";}
    echo "</select></td></tr>
          <tr><td>Product Code/Name</td> <td>";
            $tampil=mysql_query("SELECT * FROM tour_msproductcode ORDER BY ProductcodeName");
            while($s=mysql_fetch_array($tampil)){
                if($r[ProductCode]==$s[ProductcodeName]){
                    echo "$s[ProductcodeName] - $s[Productcode]";
                } 
            }
    echo "</select></td></tr>    
            <tr><td>Date of Service</td> <td>$dari - $sampai</td></tr>
           <tr><td>Number of Days</td> <td>$r[DaysTravel] days</td></tr>   
          <tr><td>Flight</td> <td> ";
            $tampil=mysql_query("SELECT * FROM tour_msairlines where AirlinesStatus='ACTIVE' ORDER BY AirlinesID");
            while($s=mysql_fetch_array($tampil)){
                if($r[Flight]==$s[AirlinesID]){
                    echo "$s[AirlinesID] - $s[AirlinesName]";    
                }
            }
    echo "</td></tr>
          <tr><td>Tour Code</td> <td>$r[TourCode] <input type='button' name='submit' value='CHANGE' onclick=PopupCenter('changer.php?id=$_GET[id]','variable',350,200)></td></tr>
          <tr><td>Seat</td> <td><input type=text name='seat' size='3' value='$r[Seat]' onkeyup='isNumber(this)'> Pax <font color='red'>*<i>Not Include Infant and Tour leader</i></font></td></tr>
          <tr><td>Tour Leader</td> <td>$r[TourLeaderInc]</td></tr> 
          <tr><td>Tour Leader</td> <td>   
          <input type=radio name='tourleaderinc' value='YES'";if($r[TourLeaderInc]=='YES'){echo"checked";}echo">&nbsp;Yes
          <input type=radio name='tourleaderinc' value='NO'";if($r[TourLeaderInc]=='NO'){echo"checked";}echo">&nbsp;No        
          </td></tr>
          <tr><td>Insurance</td> <td>
          <input type=radio name='insurance' value='INCLUDE'";if($r[Insurance]=='INCLUDE'){echo"checked";}echo">&nbsp;Include
          <input type=radio name='insurance' value='NOT INCLUDE'";if($r[Insurance]=='NOT INCLUDE'){echo"checked";}echo">&nbsp;Not Include
          </td></tr>
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
            <tr><td>Visa Time Limit</td><td>$VisaDateline </td></tr>
            <tr><td>Quotation</td><td>Currency : $r[QuotationCurr]</td></tr>
            <tr><td>Selling</td><td>Currency : $r[SellingCurr] &nbsp Operator : $r[SellingOperator] &nbsp Rate : $r[SellingRate]</td></tr>";  
            $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[AttachmentFile]) ) ) ); 
    echo"<tr><td>Attachment</td><td>";if($r[AttachmentFile]<>''){echo"<input type='hidden' name='attachmentfile' value='$r[AttachmentFile]'><a href='$r[Attachment]$file' target='_blank' style=text-decoration:none >$r[AttachmentFile]</a> &nbsp<a href=\"javascript:delattachapp('$r[IDProduct]','$r[AttachmentFile]')\"><font color=red>remove</font></a>";}
                                        else{echo"<input type='file' name='upload' >";
                                        }echo"</td></tr>
            <tr><td>Remarks</td><td><textarea name='remarks' cols='50' rows='3'>$r[Remarks]</textarea></td></tr>     
          <tr><td colspan=2><center><input type='submit' name='submit' value='Update'>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;

case "appmsproduct":
    $nama=$_GET['nama'];
    $opnama=$_GET['opnama'];
    if($opnama==''){$opnama='TourCode';}
    echo "<h2>Product Approval</h2>
          Search By :
          <form method=get action='media.php?'>
                <input type=hidden name=module value='msproduct'><input type=hidden name=act value='appmsproduct'>
              <select name='opnama'><option value=''";if($opnama==''){echo"selected";}echo">- please select -</option>
                                    <option value='TourCode'";if($opnama=='TourCode'){echo"selected";}echo">Tour Code</option>
                                    <option value='DateTravelFrom'";if($opnama=='DateTravelFrom'){echo"selected";}echo">Departure Date</option>
                                    <option value='Flight'";if($opnama=='Flight'){echo"selected";}echo">Flight</option>
                                    <option value='Destination'";if($opnama=='Destination'){echo"selected";}echo">Destination</option>
                                    <option value='ProductCodeName'";if($opnama=='ProductCodeName'){echo"selected";}echo">Product</option>
                                    <option value='DaysTravel'";if($opnama=='DaysTravel'){echo"selected";}echo">Days</option>
                                    <option value='Season'";if($opnama=='Season'){echo"selected";}echo">Season</option>
              </select> <input type=text name='nama' value='$nama' size=20>
              <input type=submit name=oke value=Search>
          </form>";
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

    // Langkah 2   AND DateTravelFrom > '$hari'
    if($EmpOff=='IFM' or $EmpOff=='ACC' or $EmpOff=='LTM'){
        $tampil=mysql_query("SELECT * FROM tour_msproduct
                                WHERE $opnama LIKE '%$nama%'
                                AND Status <> 'VOID'
                                AND (QuotationStatus = 'REQUEST' OR QuotationStatus = 'EDIT')
                                AND DateTravelFrom > '$hari'
                                ORDER BY DateTravelFrom DESC LIMIT $posisi,$batas");
    }else{
        $tampil=mysql_query("SELECT * FROM tour_msproduct
                                WHERE $opnama LIKE '%$nama%'
                                AND Status <> 'VOID'
                                AND (QuotationStatus = 'REQUEST' OR QuotationStatus = 'EDIT')
                                AND DateTravelFrom > '$hari'
                                AND InputDivision = '$EmpOff'
                                ORDER BY DateTravelFrom DESC LIMIT $posisi,$batas");
    }
    $jumlah=mysql_num_rows($tampil);
    if ($jumlah > 0) {
        echo "<table>
                    <tr><th>no</th><th>product</th><th>type</th><th>tour code</th><th>days</th><th>departure</th><th>flight</th><th>seat</th><th>season</th><th>status</th><th>tour leader</th><th>Quotation Status</th><th>option</th></tr>";
        $no=$posisi+1;
        while ($data=mysql_fetch_array($tampil)){
            $edit1=mysql_query("SELECT * FROM tour_msbooking WHERE IDTourCode ='$data[IDProduct]' and Status = 'ACTIVE' ");
            $r2=mysql_num_rows($edit1);
            $itin=mysql_query("SELECT * FROM tour_msitin WHERE ProductID ='$data[IDProduct]' group by ProductID ");
            $isiitin=mysql_num_rows($itin);
            $itinpdf=mysql_query("SELECT * FROM tour_msitinpdf WHERE IDProduct ='$data[IDProduct]' group by IDProduct");
            $isiitinpdf=mysql_num_rows($itinpdf);
            if($isiitin>0 or $isiitinpdf>0 or $data[AttachmentFile]<>''){$tom='enabled';}else{$tom='disabled';}
            if($isiitin>0){$tom='enabled';}else{$tom='disabled';}
            if($r2 > 0){$editan="editmsproductapp";}
            else{$editan="editmsproduct";}
            if($data[Status]=='NOT PUBLISHED'){$status="<font color=red>$data[Status]</font>";$status2="<font color=red><b>UNPUBLISH</b></font>";}
            else if($data[Status]=='PUBLISH'){$status="<font color=green><b>$data[Status]</b></font>";$status2="<font color=green><b>PUBLISH</b></font>";}
            if($data[SellingAdlTwn]=='0' and $data[SellingChdTwn]=='0' and $data[SellingChdXbed]=='0' and $data[SellingChdNbed]=='0' and $data[SellingInfant]=='0'){
                $lok="<input type=button value='LOCK PRICE' disabled>";
            }else{
                $lok="<input type=button value='LOCK PRICE' onclick=\"javascript:lockprice('$data[IDProduct]','$data[Year]')\">";
            }
            $DTF = date('d-m-Y', strtotime($data[DateTravelFrom]));
            echo "<tr><td>$no</td>
                     <td>$data[ProductCode] - $data[ProductCodeName]</td>
                     <td><center>$data[GroupType]</td>
                     <td>$data[TourCode]</td>
                     <td><center>$data[DaysTravel]</td>
                     <td>$DTF</td>
                     <td><center>$data[Flight]</td>
                     <td><center>$data[Seat]</td>
                     <td><center>$data[Season]</td>
                     <td><center>$status2</td>
                     <td>$data[TourLeader]</td>
                     <td><center>$data[QuotationStatus]</td>
                     <td><center>
                     <input type='button' value='QUOTATION' onclick=location.href='?module=msproduct&act=showquotation&id=$data[IDProduct]'>
                     <input type='button' value='ATTACH' onclick=location.href='?module=msitin&act=showitin&id=$data[IDProduct]' $tom>
                     </td></tr>";
            $no++;
        }
        echo "</table>";

        // Langkah 3 preg_match('/LTM/',$EmpOff)
        if($EmpOff=='IFM' or $EmpOff=='ACC'){
            $tampil2    = "SELECT * FROM tour_msproduct
                                WHERE $opnama LIKE '%$nama%'
                                AND Status <> 'VOID'
                                AND QuotationStatus = 'REQUEST'
                                AND DateTravelFrom > '$hari'
                                ORDER BY DateTravelFrom DESC";
        }else{
            $tampil2    = "SELECT * FROM tour_msproduct
                                WHERE $opnama LIKE '%$nama%'
                                AND Status <> 'VOID'
                                AND QuotationStatus = 'REQUEST'
                                AND DateTravelFrom > '$hari'
                                AND InputDivision = '$EmpOff'
                                ORDER BY DateTravelFrom DESC";
        }
        $hasil2     = mysql_query($tampil2);
        $jmldata    = mysql_num_rows($hasil2);
        $jmlhalaman = ceil($jmldata/$batas);
        $file = "media.php?module=msproduct";
        // Link ke halaman sebelumnya (previous)
        echo "<center><div id='paging'>";
        if ($halaman >1) {
            $previous = $halaman-1;
            echo "<a href=$file&halaman=1&opnama=$opnama&act=appmsproduct&nama=$nama&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&opnama=$opnama&act=appmsproduct&nama=$nama&oke=$oke> < Previous</a> | ";
        } else {
            echo "<< First | < Previous | ";
        }
        // Tampilkan link halaman 1,2,3 ... modifikasi ala google
        // Angka awal
        $angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
        for ($i=$halaman-2; $i<$halaman; $i++) {
            if ($i < 1 )
                continue;
            $angka .= "<a href=$file&halaman=$i&opnama=$opnama&act=appmsproduct&nama=$nama&oke=$oke>$i</a> ";
        }
        // Angka tengah
        $angka .= " <b>$halaman</b> ";
        for ($i=$halaman+1; $i<($halaman+3); $i++) {
            if ($i > $jmlhalaman)
                break;
            $angka .= "<a href=$file&halaman=$i&opnama=$opnama&act=appmsproduct&nama=$nama&oke=$oke>$i</a> ";
        }
        // Angka akhir
        $angka .= ($halaman+2<$jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&opnama=$opnama&act=appmsproduct&nama=$nama&oke=$oke>$jmlhalaman</a> |" : " ");
        // Cetak angka seluruhnya (awal, tengah, akhir)
        echo "$angka";
        // Link ke halaman berikutnya (Next)
        if ($halaman < $jmlhalaman) {
            $next = $halaman+1;
            echo "<a href=$file&halaman=$next&opnama=$opnama&act=appmsproduct&nama=$nama&oke=$oke> Next ></a> |
                              <a href=$file&halaman=$jmlhalaman&opnama=$opnama&act=appmsproduct&nama=$nama&oke=$oke> Last >></a> ";
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

case "deletemsproduct":
    $edit=mysql_query("DELETE FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproduct'>";
    break;
     
case "delattach":
    $edit1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1);
    $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r2[AttachmentFile]) ) ) );
    $path = $r2[Attachment];
    $files = ("$path$file");
    unlink($files);
    $edit=mysql_query("UPDATE tour_msproduct set Attachment = '',AttachmentFile='' WHERE IDProduct = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproduct&act=editmsproduct&id=$_GET[id]'>";     
     break;
  
case "delattachapp":
    $edit1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1);
    $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r2[AttachmentFile]) ) ) );
    $path = $r2[Attachment];
    $files = ("$path$file");
    unlink($files);
    $edit=mysql_query("UPDATE tour_msproduct set Attachment = '',AttachmentFile='' WHERE IDProduct = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproduct&act=editmsproductapp&id=$_GET[id]'>";     
     break;
     
case "delpnr":
     $edit1=mysql_query("SELECT * from tour_msproductpnr WHERE PnrID = '$_GET[id]'");  
     $r2=mysql_fetch_array($edit1);
     $prodid=$r2[PnrProd];
     $edit=mysql_query("DELETE from tour_msproductpnr WHERE PnrID = '$r2[PnrID]'");
     $Description="DELETE PNR $r2[TourCode]";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproduct&act=prodflight&id=$prodid'>";   
     break;
     
case "publishmsproduct":
    $edit1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1);
    if($r2[Status]=='NOT PUBLISHED'){$status="PUBLISH";$buka="OPEN";}
    else if($r2[Status]=='PUBLISH'){$status="NOT PUBLISHED";$buka="CLOSE";}             
    $edit=mysql_query("UPDATE tour_msproduct SET Status = '$status',StatusProduct = '$buka' WHERE IDProduct = '$_GET[id]'");
     $Description="$status $r2[TourCode]";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproduct'>";   
     break;
     
// quotation awal
case "quotation":
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $qpricein=mysql_query("SELECT * FROM tour_msproductprice WHERE ProductID = '$_GET[id]' AND PriceFor = 'INTERNAL'");
    $pricein=mysql_fetch_array($qpricein);
    $qpricepw=mysql_query("SELECT * FROM tour_msproductprice WHERE ProductID = '$_GET[id]' AND PriceFor = 'PANORAMA WORLD'");
    $pricepw=mysql_fetch_array($qpricepw);
    $qpricesc=mysql_query("SELECT * FROM tour_msproductprice WHERE ProductID = '$_GET[id]' AND PriceFor = 'SISTER COMPANY'");
    $pricesc=mysql_fetch_array($qpricesc);
    $qpricesa=mysql_query("SELECT * FROM tour_msproductprice WHERE ProductID = '$_GET[id]' AND PriceFor = 'SUB AGENT'");
    $pricesa=mysql_fetch_array($qpricesa);
    $depdate = substr($r[DateTravelFrom],8,2);  
    $bulan = date("M", strtotime($r[DateTravelFrom]));
    $inputdate = date("d M Y", strtotime($r[InputDate]));
    $targetcopy=$r[DateTravelFrom];
    $tanggalcopy = substr($targetcopy,8,2);
    $bulancopy = substr($targetcopy,5,2);
    $tahuncopy = substr($targetcopy,0,4);             
    $batas= date('Y-m-d',strtotime('-1 second',strtotime('-3 month',strtotime(date($bulancopy).'/'.date($tanggalcopy).'/'.date($tahuncopy).' 00:00:00'))));
    $edit1=mysql_query("SELECT * FROM tour_msdetail WHERE IDProduct = '$_GET[id]'");
    $m=mysql_fetch_array($edit1);
    $a1=mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]'  ORDER BY SellingRate DESC ");
    $cek1=mysql_fetch_array($a1);  
    $a2=mysql_query("SELECT * FROM tour_detail
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]'  ORDER BY SellingRate DESC ");
    $cek2=mysql_fetch_array($a2);
    
    echo "<h2>Quotation</h2> 
           <form method=POST name='example' action='./aksi.php?module=quotation&act=copyquotation' >
          <input type=hidden name='id' value='$r[IDProduct]'>
		  
          <table>
		  <tr style='border: hidden;'><td style='border: hidden;'><b>STATUS : $r[QuotationStatus]</b></td></tr>
          <tr style='border: hidden;'><td style='border: hidden;'>Created By</td><td>: $r[InputBy]</td><td width='200' style='border: hidden;'></td> <td style='border: hidden;'>Tour Code</td> <td>: $r[TourCode]</td></tr>
          <tr style='border: hidden;'><td style='border: hidden;'>Created Date</td> <td>: $inputdate</td><td style='border: hidden;'></td><td style='border: hidden;'>Number of Days</td> <td>: $r[DaysTravel] Days</td></tr>                       
          <tr style='border: hidden;'><td style='border: hidden;'>Currency</td> <td>: $r[SellingCurr]</td><td style='border: hidden;'></td><td style='border: hidden;'>Departure Date</td> <td>: $depdate $bulan/$r[Flight]</td></tr>
          <tr style='border: hidden;'><td style='border: hidden;'>Total Seat</td> <td>: $r[Seat] PAX ";if($r[TourLeaderInc]=='YES'){echo" + Tour Leader";} echo"</td><td style='border: hidden;'></td><td style='border: hidden;'><input type='button' name='iwant' name='iwant' value='Copy Quotation'  onclick=Sowit() ></td>
          <td> <select name='idcopy' id='idcopy' style='visibility:hidden'>
            <option value='0' selected>- Select TourCode -</option>";     
           // copy quotation berdasarkan product code yang sama saja
		    $tampil0=mysql_query("SELECT * FROM tour_msproduct   
                                WHERE Status <> 'VOID'
                                AND IDProduct <> '$r[IDProduct]' and ProductCode='$r[ProductCode]'
                                AND DatetravelFrom > '$batas'
                                ORDER BY TourCode ASC");
            while($r0=mysql_fetch_array($tampil0)){     
                    echo "<option value='$r0[IDProduct]'>$r0[TourCode]</option>"; 
            }
    echo "</select></td></tr>  
          <tr style='border: hidden;'><td style='border: hidden;'></td>
          <td></td><td width='200' style='border: hidden;'></td><td style='border: hidden;'></td> <td><input type='submit' name='apdet' id='apdet' value=Copy style='visibility:hidden'></td></tr>
          </table>
          </form>
          <table><td  style='border: hidden;'>           
          <input type='button' name='submit' value='Edit Fix Cost' onclick=PopupCenter('quotation.php?id=$_GET[id]','fix',1200,490) >
                    <table>
                    <tr><th width='180'>FIX Cost</th><th width='80'>adult</th><th width='80'>child</th></tr>";
                    for ($x=1;$x<11;$x++){ 
                    $tampil=mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX$x' ORDER BY IDDetail ASC ");
                    $data=mysql_fetch_array($tampil);
               echo "
                    <tr><td>$data[Description]</td><td>$r[SellingCurr]. $data[SellAdult]</td><td>$r[SellingCurr]. $data[SellChd]</td></tr>";
                    }
                    $tam=mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct = '$r[IDProduct]'  ");
                    $dt=mysql_fetch_array($tam);
               echo"<tr><td><b><i>TOTAL</td><td><b><i>$r[SellingCurr]. $dt[TotalFixAdult]</td><td><b><i>$r[SellingCurr]. $dt[TotalFixChd]</td></table>";
                    
          echo"
          </td><td width='20'  style='border: hidden;'></td><td  style='border: hidden;'>  
          <input type='button' name='submit' value='Edit Variable Cost' onclick=PopupCenter('variable.php?id=$_GET[id]','variable',970,490)>
                     <table>
                    <tr><th width='180'>variable</th><th width='90'>adult</th></tr>";
                    for ($i=1;$i<11;$i++){ 
                    $tampil=mysql_query("SELECT * FROM tour_detail
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR$i' ORDER BY IDDetail ASC ");
                    $data=mysql_fetch_array($tampil);
               echo "
                    <tr><td>$data[Description]</td><td>$r[SellingCurr]. $data[SellAdult]</td></tr>";
                    }
                    $tam2=mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct = '$r[IDProduct]'  ");
                    $dt2=mysql_fetch_array($tam2);
               echo"<tr><td><b><i>TOTAL</td><td><b><i>$r[SellingCurr]. $dt2[TotalVar]</td></table>
          </td></table>
          
          <form method=POST name='quotation' action='./aksi.php?module=fixcost&act=input'>
          <input type=hidden name=id value='$r[IDProduct]'>
          <input type=hidden name='pax' value='$r[Seat]'>
          <font size='2'><i>Agent Cost</i></font>";
                    $tam3=mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct = '$r[IDProduct]'  ");
                    $dt3=mysql_fetch_array($tam3);
                    if($dt3[AliasOptA]==''){$aliasa='OPTION A';}else{$aliasa=$dt3[AliasOptA];}
                    if($dt3[AliasOptB]==''){$aliasb='OPTION B';}else{$aliasb=$dt3[AliasOptB];}
                    if($dt3[AliasOptC]==''){$aliasc='OPTION C';}else{$aliasc=$dt3[AliasOptC];}
              echo "<table>
                    <tr><th></th><th colspan =4><input type='button' name='submit' value='$aliasa' onclick=PopupCenter('agent.php?id=$_GET[id]','variable',1320,520)></th>
                    <th colspan=4><input type='button' name='submit' value='$aliasb' onclick=PopupCenter('agent.php?id=$_GET[id]&act=b','variable',1320,520) ";if($m[TotalAdultA]=='0'){echo"disabled";} echo"></th>
                    <th colspan=4><input type='button' name='submit' value='$aliasc' onclick=PopupCenter('agent.php?id=$_GET[id]&act=c','variable',1320,520) ";if($m[TotalAdultB]=='0'){echo"disabled";} echo"></th></tr>
                    <tr><th>Number of Pax --></th><th colspan =4>$dt3[PaxA] PAX</th><th colspan=4>$dt3[PaxB] PAX</th><th colspan=4>$dt3[PaxC] PAX</th></tr>
                    <tr><th width='150'>Description</th>
                    <th width='78'>ADULT</th><th width='78'>CHILD TWN</th><th width='78'>CHILD X BED</th><th width='78'>CHILD NO BED</th>
                    <th width='78'>ADULT</th><th width='78'>CHILD TWN</th><th width='78'>CHILD X BED</th><th width='78'>CHILD NO BED</th>
                    <th width='78'>ADULT</th><th width='78'>CHILD TWN</th><th width='78'>CHILD X BED</th><th width='78'>CHILD NO BED</th></tr>"; 
                    for ($i=1;$i<11;$i++){ 
                    $tampil=mysql_query("SELECT * FROM tour_agent
                                where IDProduct = '$r[IDProduct]' and Category = 'AGENT$i' ");
                    $data=mysql_fetch_array($tampil);  
               echo "<td>$data[Description]</td> 
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellAdultA]</td>
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellChdTwnA]</td>
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellChdXbedA]</td>
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellChdNbedA]</td>
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellAdultB]</td>
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellChdTwnB]</td>
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellChdXbedB]</td>
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellChdNbedB]</td>
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellAdultC]</td>
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellChdTwnC]</td>
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellChdXbedC]</td>
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellChdNbedC]</td></tr>";
                    }
                    
                    echo "
                    <tr><td><b><i>TOTAL</td><td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalAdultA]</td><td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalChdTwnA]</td><td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalChdXbedA]</td><td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalChdNbedA]</td>
                    <td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalAdultB]</td><td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalChdTwnB]</td><td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalChdXbedB]</td><td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalChdNbedB]</td>
                    <td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalAdultC]</td><td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalChdTwnC]</td><td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalChdXbedC]</td><td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalChdNbedC]</td></tr></table>";
                    
          echo"</form>
          
          <form method=POST name='calculate' onsubmit='return validateFormsKosong(this)' action='./aksi.php?module=msproduct&act=quotation'>
          <input type=hidden name=id value='$r[IDProduct]'> 
          <input type=hidden name='tourcode' value='$r[TourCode]'>";
            $tampil=mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct='$r[IDProduct]'  ");
            $data=mysql_fetch_array($tampil);    
            if($data[PaxA]=='0'){$tva=number_format(($data[TotalVar]), 2, '.', '');}else{$tva=number_format(($data[TotalVar] / $data[PaxA]), 2, '.', '');}
            if($data[PaxB]=='0'){$tvb=number_format(($data[TotalVar]), 2, '.', '');}else{$tvb=number_format(($data[TotalVar] / $data[PaxB]), 2, '.', '');}
            if($data[PaxC]=='0'){$tvc=number_format(($data[TotalVar]), 2, '.', '');}else{$tvc=number_format(($data[TotalVar] / $data[PaxC]), 2, '.', '');}
            
            if($data[PaxA]<>''){$tfaa=number_format(($data[TotalFixAdult]), 2, '.', '');$tfca=number_format(($data[TotalFixChd]), 2, '.', '');}//else{$tfaa=$data[TotalFixAdult] / $data[PaxA];$tfca=$data[TotalFixChd] / $data[PaxA];}
            if($data[PaxB]<>''){$tfab=number_format(($data[TotalFixAdult]), 2, '.', '');$tfcb=number_format(($data[TotalFixChd]), 2, '.', '');}//else{$tfab=$data[TotalFixAdult] / $data[PaxB];$tfcb=$data[TotalFixChd] / $data[PaxB];}
            if($data[PaxC]<>''){$tfac=number_format(($data[TotalFixAdult]), 2, '.', '');$tfcc=number_format(($data[TotalFixChd]), 2, '.', '');}//else{$tfac=$data[TotalFixAdult] / $data[PaxC];$tfcc=$data[TotalFixChd] / $data[PaxC];}
            
            if($data[PaxA]<>''){$taaa=number_format(($data[TotalAdultA]), 2, '.', '');$taca=number_format(($data[TotalChdTwnA]), 2, '.', '');$tacxa=number_format(($data[TotalChdXbedA]), 2, '.', '');$tacna=number_format(($data[TotalChdNbedA]), 2, '.', '');}//else{$taaa=$data[TotalAdultA] / $data[PaxA];$taca=$data[TotalChdTwnA] / $data[PaxA];$tacxa=$data[TotalChdXbedA] / $data[PaxA];}
            if($data[PaxB]<>''){$taab=number_format(($data[TotalAdultB]), 2, '.', '');$tacb=number_format(($data[TotalChdTwnB]), 2, '.', '');$tacxb=number_format(($data[TotalChdXbedB]), 2, '.', '');$tacnb=number_format(($data[TotalChdNbedB]), 2, '.', '');}//else{$taab=$data[TotalAdultB] / $data[PaxB];$tacb=$data[TotalChdTwnB] / $data[PaxB];$tacxb=$data[TotalChdXbedB] / $data[PaxB];}
            if($data[PaxC]<>''){$taac=number_format(($data[TotalAdultC]), 2, '.', '');$tacc=number_format(($data[TotalChdTwnC]), 2, '.', '');$tacxc=number_format(($data[TotalChdXbedC]), 2, '.', '');$tacnc=number_format(($data[TotalChdNbedC]), 2, '.', '');}//else{$taac=$data[TotalAdultC] / $data[PaxC];$tacc=$data[TotalChdTwnC] / $data[PaxC];$tacxc=$data[TotalChdXbedC] / $data[PaxC];}
            
            $comaa=number_format(($data[ComAdultA]), 2, '.', '');$comca=number_format(($data[ComChdTwnA]), 2, '.', '');$comcxa=number_format(($data[ComChdXbedA]), 2, '.', '');$comcna=number_format(($data[ComChdNbedA]), 2, '.', '');
            $comab=number_format(($data[ComAdultB]), 2, '.', '');$comcb=number_format(($data[ComChdTwnB]), 2, '.', '');$comcxb=number_format(($data[ComChdXbedB]), 2, '.', '');$comcnb=number_format(($data[ComChdNbedB]), 2, '.', '');
            $comac=number_format(($data[ComAdultC]), 2, '.', '');$comcc=number_format(($data[ComChdTwnC]), 2, '.', '');$comcxc=number_format(($data[ComChdXbedC]), 2, '.', '');$comcnc=number_format(($data[ComChdNbedC]), 2, '.', '');
            //real nett
            $nettaa=number_format(($tva+$tfaa+$comaa+$taaa), 2, '.', ''); 
            $nettca=number_format(($tva+$tfca+$comca+$taca), 2, '.', ''); 
            $nettcxa=number_format(($tva+$tfca+$comcxa+$tacxa), 2, '.', '');
            $nettcna=number_format(($tva+$tfca+$comcna+$tacna), 2, '.', ''); 
            $nettab=number_format(($tvb+$tfab+$comab+$taab), 2, '.', '');
            $nettcb=number_format(($tvb+$tfcb+$comcb+$tacb), 2, '.', ''); 
            $nettcxb=number_format(($tvb+$tfcb+$comcxb+$tacxb), 2, '.', '');
            $nettcnb=number_format(($tvb+$tfcb+$comcnb+$tacnb), 2, '.', '');  
            $nettac=number_format(($tvc+$tfac+$comac+$taac), 2, '.', ''); 
            $nettcc=number_format(($tvc+$tfcc+$comcc+$tacc), 2, '.', '');
            $nettcxc=number_format(($tvc+$tfcc+$comcxc+$tacxc), 2, '.', '');
            $nettcnc=number_format(($tvc+$tfcc+$comcnc+$tacnc), 2, '.', ''); 
            //itung net var + fix + agent
            $nettaa1=number_format(($tva+$tfaa+$taaa), 2, '.', ''); 
            $nettca1=number_format(($tva+$tfca+$taca), 2, '.', ''); 
            $nettcxa1=number_format(($tva+$tfca+$tacxa), 2, '.', ''); 
            $nettcna1=number_format(($tva+$tfca+$tacna), 2, '.', ''); 
            $nettab1=number_format(($tvb+$tfab+$taab), 2, '.', ''); 
            $nettcb1=number_format(($tvb+$tfcb+$tacb), 2, '.', '');
            $nettcxb1=number_format(($tvb+$tfcb+$tacxb), 2, '.', '');
            $nettcnb1=number_format(($tvb+$tfcb+$tacnb), 2, '.', ''); 
            $nettac1=number_format(($tvc+$tfac+$taac), 2, '.', ''); 
            $nettcc1=number_format(($tvc+$tfcc+$tacc), 2, '.', ''); 
            $nettcxc1=number_format(($tvc+$tfcc+$tacxc), 2, '.', '');
            $nettcnc1=number_format(($tvc+$tfcc+$tacnc), 2, '.', ''); 
            //itung profit margin
            /*if($data[Persen]=='0'){
            $paa=0;$pca=0;$pcxa=0;$pcna=0; 
            $pab=0;$pcb=0;$pcxb=0;$pcnb=0; 
            $pac=0;$pcc=0;$pcxc=0;$pcnc=0;
            }else{ */
            $paa=number_format($data[ProfAdultA], 2, '.', '');
            $pca=number_format($data[ProfChdTwnA], 2, '.', '');
            $pcxa=number_format($data[ProfChdXbedA], 2, '.', '');
            $pcna=number_format($data[ProfChdNbedA], 2, '.', '');
            $pab=number_format($data[ProfAdultB], 2, '.', '');
            $pcb=number_format($data[ProfChdTwnB], 2, '.', '');
            $pcxb=number_format($data[ProfChdXbedB], 2, '.', '');
            $pcnb=number_format($data[ProfChdNbedB], 2, '.', '');
            $pac=number_format($data[ProfAdultC], 2, '.', '');
            $pcc=number_format($data[ProfChdTwnC], 2, '.', '');
            $pcxc=number_format($data[ProfChdXbedC], 2, '.', '');
            $pcnc=number_format($data[ProfChdNbedC], 2, '.', '');
            //}
            // itung selling
            $sellaa = number_format($nettaa + $paa + $data[DiscAdultA], 2, '.', '');
            $sellca = number_format($nettca + $pca + $data[DiscChdTwnA], 2, '.', '');
            $sellcxa = number_format($nettcxa + $pcxa + $data[DiscChdXbedA], 2, '.', '');
            $sellcna = number_format($nettcna + $pcna + $data[DiscChdNbedA], 2, '.', '');
            $sellab = number_format($nettab + $pab + $data[DiscAdultB], 2, '.', '');
            $sellcb = number_format($nettcb + $pcb + $data[DiscChdTwnB], 2, '.', '');
            $sellcxb = number_format($nettcxb + $pcxb + $data[DiscChdXbedB], 2, '.', '');
            $sellcnb = number_format($nettcnb + $pcnb + $data[DiscChdNbedB], 2, '.', '');
            $sellac = number_format($nettac + $pac + $data[DiscAdultC], 2, '.', '');
            $sellcc = number_format($nettcc + $pcc + $data[DiscChdTwnC], 2, '.', '');
            $sellcxc = number_format($nettcxc + $pcxc + $data[DiscChdXbedC], 2, '.', '');
            $sellcnc = number_format($nettcnc + $pcnc + $data[DiscChdNbedC], 2, '.', '');
            //disc
            $disaa=number_format($data[DiscAdultA], 2, '.', '');
            $disca = number_format($data[DiscChdTwnA], 2, '.', '');
            $discxa = number_format($data[DiscChdXbedA], 2, '.', '');
            $discna = number_format($data[DiscChdNbedA], 2, '.', '');
            $disab = number_format($data[DiscAdultB], 2, '.', '');
            $discb = number_format($data[DiscChdTwnB], 2, '.', '');
            $discxb = number_format($data[DiscChdXbedB], 2, '.', '');
            $discnb = number_format($data[DiscChdNbedB], 2, '.', '');
            $disac = number_format($data[DiscAdultC], 2, '.', '');
            $discc = number_format($data[DiscChdTwnC], 2, '.', '');
            $discxc = number_format($data[DiscChdXbedC], 2, '.', ''); 
            $discnc = number_format($data[DiscChdNbedC], 2, '.', '');  
            
            echo "<table><input type=hidden name='sumaa' value='$nettaa1'><input type=hidden name='sumca' value='$nettca1'><input type=hidden name='sumcxa' value='$nettcxa1'><input type=hidden name='sumcna' value='$nettcna1'>
            <input type=hidden name='sumab' value='$nettab1'><input type=hidden name='sumcb' value='$nettcb1'><input type=hidden name='sumcxb' value='$nettcxb1'><input type=hidden name='sumcnb' value='$nettcnb1'> 
            <input type=hidden name='sumac' value='$nettac1'><input type=hidden name='sumcc' value='$nettcc1'><input type=hidden name='sumcxc' value='$nettcxc1'><input type=hidden name='sumcnc' value='$nettcnc1'> 
                    <tr><th width=150></th><th width=78>ADULT</th><th width=78>CHILD TWN</th><th width=78>CHILD X BED</th><th width=78>CHILD NO BED</th><th width=78>ADULT</th><th width=78>CHILD TWN</th><th width=78>CHILD X BED</th><th width=78>CHILD NO BED</th><th width=78>ADULT</th><th width=78>CHILD TWN</th><th width=78>CHILD X BED</th><th width=78>CHILD NO BED</th></tr>
                     <tr><td width='150'>Total Variable Cost</td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvaradulta' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvarchdtwna' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvarchdxbeda' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvarchdnbeda' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvaradultb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvarchdtwnb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvarchdxbedb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvarchdnbedb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvaradultc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvarchdtwnc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvarchdxbedc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvarchdnbedc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     
                     <tr><td>Total Fix Cost</td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixadulta' value='$tfaa'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixchdtwna' value='$tfca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixchdxbeda' value='$tfca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixchdnbeda' value='$tfca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixadultb' value='$tfab'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixchdtwnb' value='$tfcb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixchdxbedb' value='$tfcb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixchdnbedb' value='$tfcb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixadultc' value='$tfac'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixchdtwnc' value='$tfcc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixchdxbedc' value='$tfcc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixchdnbedc' value='$tfcc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     
                     <tr><td>Total Agent Cost</td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentadulta' value='$taaa'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentchdtwna' value='$taca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentchdxbeda' value='$tacxa'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentchdnbeda' value='$tacna'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentadultb' value='$taab'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentchdtwnb' value='$tacb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentchdxbedb' value='$tacxb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentchdnbedb' value='$tacnb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentadultc' value='$taac'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentchdtwnc' value='$tacc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentchdxbedc' value='$tacxc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentchdnbedc' value='$tacnc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     
                     <tr><td>Agent Commision <input type=text name='comall' id='sadult' size='5' style='text-align: right' onkeyup='isNumber(this),UNall()' value='0'></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='comaa' id='sadult' size='8' style='background-color:#f5bebe;text-align: right;' onkeyup='isNumber(this),UpdateNetta()' value='$comaa'></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='comca' id='ssin' size='8' style='background-color:#f5bebe;text-align: right;' onkeyup='isNumber(this),UpdateNetta()' value='$comca'></td></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='comcxa' id='schdtwn' size='8' style='background-color:#f5bebe;text-align: right;' onkeyup='isNumber(this),UpdateNetta()' value='$comcxa'></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='comcna' id='schdtwn' size='8' style='background-color:#f5bebe;text-align: right;' onkeyup='isNumber(this),UpdateNetta()' value='$comcna'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='comab' id='schdnbed' size='8' style='background-color:#bef5c6;text-align: right;' onkeyup='isNumber(this),UpdateNettb()' value='$comab'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='comcb' id='schdxbed' size='8' style='background-color:#bef5c6;text-align: right;' onkeyup='isNumber(this),UpdateNettb()' value='$comcb'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='comcxb' id='sinfant' size='8' style='background-color:#bef5c6;text-align: right;' onkeyup='isNumber(this),UpdateNettb()' value='$comcxb'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='comcnb' id='sinfant' size='8' style='background-color:#bef5c6;text-align: right;' onkeyup='isNumber(this),UpdateNettb()' value='$comcnb'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='comac' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;' onkeyup='isNumber(this),UpdateNettc()' value='$comac'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='comcc' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;' onkeyup='isNumber(this),UpdateNettc()' value='$comcc'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='comcxc' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;' onkeyup='isNumber(this),UpdateNettc()' value='$comcxc'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='comcnc' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;' onkeyup='isNumber(this),UpdateNettc()' value='$comcnc'></td></tr>
                     
                     <tr><td>Nett </td><td BGCOLOR='#f5bebe'><input type='text' name='nettaa' id='padult' value='$nettaa'  size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettaa<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='nettca' id='psingle' value='$nettca' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettca<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='nettcxa' id='pchdtwn' value='$nettcxa' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcxa<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='nettcna' id='pchdtwn' value='$nettcna' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcna<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='nettab' id='pchdnbed' value='$nettab' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettab<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='nettcb' id='pchdxbed' value='$nettcb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcb<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='nettcxb' id='pinfant' value='$nettcxb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcxb<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='nettcnb' id='pinfant' value='$nettcnb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcnb<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='nettac' id='pchdnbed' value='$nettac' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettac<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='nettcc' id='pchdxbed' value='$nettcc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcc<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='nettcxc' id='pinfant' value='$nettcxc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcxc<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='nettcnc' id='pinfant' value='$nettcnc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcnc<0){echo"background: red";}echo"' readonly></td></tr>
                     <tr><th colspan=13></th></tr>
                     
                     <tr><td>Profit Margin <input type=text name='persen' size='2' onkeyup='isNumber(this),UpdateProfit()'value='0'> %</td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='paa' size='8' value='$paa' style='background-color:#f5bebe;text-align: right;border: 0px;' onkeyup='isNumber(this),UpdateSell()' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='pca' size='8' value='$pca' style='background-color:#f5bebe;text-align: right;border: 0px;' onkeyup='isNumber(this),UpdateSell()' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='pcxa' size='8' value='$pcxa' style='background-color:#f5bebe;text-align: right;border: 0px;' onkeyup='isNumber(this),UpdateSell()' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='pcna' size='8' value='$pcna' style='background-color:#f5bebe;text-align: right;border: 0px;' onkeyup='isNumber(this),UpdateSell()' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='pab' size='8' value='$pab' style='background-color:#bef5c6;text-align: right;border: 0px;' onkeyup='isNumber(this),UpdateSell()' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='pcb' size='8' value='$pcb' style='background-color:#bef5c6;text-align: right;border: 0px;' onkeyup='isNumber(this),UpdateSell()' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='pcxb' size='8' value='$pcxb' style='background-color:#bef5c6;text-align: right;border: 0px;' onkeyup='isNumber(this),UpdateSell()' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='pcnb' size='8' value='$pcnb' style='background-color:#bef5c6;text-align: right;border: 0px;' onkeyup='isNumber(this),UpdateSell()' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='pac' size='8' value='$pac' style='background-color:#becaf5;text-align: right;border: 0px;' onkeyup='isNumber(this),UpdateSell()' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='pcc' size='8' value='$pcc' style='background-color:#becaf5;text-align: right;border: 0px;' onkeyup='isNumber(this),UpdateSell()' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='pcxc' size='8' value='$pcxc' style='background-color:#becaf5;text-align: right;border: 0px;' onkeyup='isNumber(this),UpdateSell()' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='pcnc' size='8' value='$pcnc' style='background-color:#becaf5;text-align: right;border: 0px;' onkeyup='isNumber(this),UpdateSell()' readonly></td></tr>
                     
                     <tr><td>Spare for Discount <input type=text name='discall' id='sadult' size='5' style='text-align: right' onkeyup='isNumber(this),USall()' value='0'></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='discaa' size='8' style='background-color:#f5bebe;text-align: right;' onkeyup='isNumber(this),UpdateSell()' value='$disaa'></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='discca' size='8' style='background-color:#f5bebe;text-align: right;' onkeyup='isNumber(this),UpdateSell()' value='$disca'></td></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='disccxa' size='8' style='background-color:#f5bebe;text-align: right;' onkeyup='isNumber(this),UpdateSell()' value='$discxa'></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='disccna' size='8' style='background-color:#f5bebe;text-align: right;' onkeyup='isNumber(this),UpdateSell()' value='$discna'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='discab' size='8' style='background-color:#bef5c6;text-align: right;' onkeyup='isNumber(this),UpdateSell()' value='$disab'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='disccb' size='8' style='background-color:#bef5c6;text-align: right;' onkeyup='isNumber(this),UpdateSell()' value='$discb'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='disccxb' size='8' style='background-color:#bef5c6;text-align: right;' onkeyup='isNumber(this),UpdateSell()' value='$discxb'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='disccnb' size='8' style='background-color:#bef5c6;text-align: right;' onkeyup='isNumber(this),UpdateSell()' value='$discnb'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='discac' size='8' style='background-color:#becaf5;text-align: right;' onkeyup='isNumber(this),UpdateSell()' value='$disac'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='disccc' size='8' style='background-color:#becaf5;text-align: right;' onkeyup='isNumber(this),UpdateSell()' value='$discc'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='disccxc' size='8' style='background-color:#becaf5;text-align: right;' onkeyup='isNumber(this),UpdateSell()' value='$discxc'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='disccnc' size='8' style='background-color:#becaf5;text-align: right;' onkeyup='isNumber(this),UpdateSell()' value='$discnc'></td></tr> 
                    
                     <tr><td>Selling Price</td><td BGCOLOR='#f5bebe'><input type='text' name='sellaa' value='$sellaa'  size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellaa<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='sellca' value='$sellca' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellca<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='sellcxa' value='$sellcxa' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcxa<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='sellcna' value='$sellcna' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcna<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='sellab' value='$sellab' size='6'  style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellab<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='sellcb' value='$sellcb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcb<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='sellcxb' value='$sellcxb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcxb<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='sellcnb' value='$sellcnb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcnb<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='sellac' value='$sellac' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellac<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='sellcc' value='$sellcc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcc<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='sellcxc' value='$sellcxc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcxc<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='sellcnc' value='$sellcnc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcnc<0){echo"background: red";}echo"' readonly></td></tr>
                     </table>";    
          if($r[GroupType]=='CRUISE'){
          echo"
          <table>
                    <tr><th></th><th>Recommended Selling Price in $r[SellingCurr]</th><th>ADULT (1-2 PAX)</th><th>ADULT (3-4 PAX)</th><th>CHILD (1-2 PAX)</th><th>Child (3-4 PAX)</th><th>Infant</th></tr>
                    <tr><th rowspan='2'>REGULAR</th><td>Cruise - Tour</td>
                         <td><input type=text name='cadl12' value='$r[CruiseAdl12]' size='12' onkeyup='isNumber(this)'></td></td>
                         <td><input type=text name='cadl34' value='$r[CruiseAdl34]' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='cchd12' value='$r[CruiseChd12]' size='12'onkeyup='isNumber(this)'></td>
                         <td><input type=text name='cchd34' value='$r[CruiseChd34]' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='rsinfant' value='$r[SellingInfant]' size='10' onkeyup='isNumber(this)'></td></tr>
                    <tr><td>Cruise - Land Only</td>
                         <td><input type=text name='cladl12' value='$r[CruiseLoAdl12]' size='12' onkeyup='isNumber(this)'></td></td>
                         <td><input type=text name='cladl34' value='$r[CruiseLoAdl34]' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='clchd12' value='$r[CruiseLoChd12]' size='12'onkeyup='isNumber(this)'></td>
                         <td><input type=text name='clchd34' value='$r[CruiseLoChd34]' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='lainfant' value='$r[LAInfant]' size='10' onkeyup='isNumber(this)'></td></tr>

                    <tr><th rowspan='2' style='background-color:#f58232;'>INTERNAL</th><td>Cruise - Tour</td>
                         <td><input type=text name='cadl12in' value='$pricein[CruiseAdl12]' style='background-color:#f58232;' size='12' onkeyup='isNumber(this)'></td></td>
                         <td><input type=text name='cadl34in' value='$pricein[CruiseAdl34]' style='background-color:#f58232;' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='cchd12in' value='$pricein[CruiseChd12]' style='background-color:#f58232;' size='12'onkeyup='isNumber(this)'></td>
                         <td><input type=text name='cchd34in' value='$pricein[CruiseChd34]' style='background-color:#f58232;' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='rsinfantin' value='$pricein[SellingInfant]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)'></td></tr>
                    <tr><td>Cruise - Land Only</td>
                         <td><input type=text name='cladl12in' value='$pricein[CruiseLoAdl12]' style='background-color:#f58232;' size='12' onkeyup='isNumber(this)'></td></td>
                         <td><input type=text name='cladl34in' value='$pricein[CruiseLoAdl34]' style='background-color:#f58232;' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='clchd12in' value='$pricein[CruiseLoChd12]' style='background-color:#f58232;' size='12'onkeyup='isNumber(this)'></td>
                         <td><input type=text name='clchd34in' value='$pricein[CruiseLoChd34]' style='background-color:#f58232;' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='lainfantin' value='$pricein[LAInfant]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)'></td></tr>

                    <tr><th rowspan='2' style='background-color:red;'>PANORAMA WORLD</th><td>Cruise - Tour</td>
                         <td><input type=text name='cadl12pw' value='$pricepw[CruiseAdl12]' style='background-color:red;' size='12' onkeyup='isNumber(this)'></td></td>
                         <td><input type=text name='cadl34pw' value='$pricepw[CruiseAdl34]' style='background-color:red;' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='cchd12pw' value='$pricepw[CruiseChd12]' style='background-color:red;' size='12'onkeyup='isNumber(this)'></td>
                         <td><input type=text name='cchd34pw' value='$pricepw[CruiseChd34]' style='background-color:red;' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='rsinfantpw' value='$pricepw[SellingInfant]' style='background-color:red;' size='10' onkeyup='isNumber(this)'></td></tr>
                    <tr><td>Cruise - Land Only</td>
                         <td><input type=text name='cladl12pw' value='$pricepw[CruiseLoAdl12]' style='background-color:red;' size='12' onkeyup='isNumber(this)'></td></td>
                         <td><input type=text name='cladl34pw' value='$pricepw[CruiseLoAdl34]' style='background-color:red;' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='clchd12pw' value='$pricepw[CruiseLoChd12]' style='background-color:red;' size='12'onkeyup='isNumber(this)'></td>
                         <td><input type=text name='clchd34pw' value='$pricepw[CruiseLoChd34]' style='background-color:red;' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='lainfantpw' value='$pricepw[LAInfant]' style='background-color:red;' size='10' onkeyup='isNumber(this)'></td></tr>

                    <tr><th rowspan='2' style='background-color:blue;'>SISTER COMPANY</th><td>Cruise - Tour</td>
                         <td><input type=text name='cadl12sc' value='$pricesc[CruiseAdl12]' style='background-color:blue;color:white;' size='12' onkeyup='isNumber(this)'></td></td>
                         <td><input type=text name='cadl34sc' value='$pricesc[CruiseAdl34]' style='background-color:blue;color:white;' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='cchd12sc' value='$pricesc[CruiseChd12]' style='background-color:blue;color:white;' size='12'onkeyup='isNumber(this)'></td>
                         <td><input type=text name='cchd34sc' value='$pricesc[CruiseChd34]' style='background-color:blue;color:white;' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='rsinfantsc' value='$pricesc[SellingInfant]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)'></td></tr>
                    <tr><td>Cruise - Land Only</td>
                         <td><input type=text name='cladl12sc' value='$pricesc[CruiseLoAdl12]' style='background-color:blue;color:white;' size='12' onkeyup='isNumber(this)'></td></td>
                         <td><input type=text name='cladl34sc' value='$pricesc[CruiseLoAdl34]' style='background-color:blue;color:white;' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='clchd12sc' value='$pricesc[CruiseLoChd12]' style='background-color:blue;color:white;' size='12'onkeyup='isNumber(this)'></td>
                         <td><input type=text name='clchd34sc' value='$pricesc[CruiseLoChd34]' style='background-color:blue;color:white;' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='lainfantsc' value='$pricesc[LAInfant]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)'></td></tr>

                    <tr><th rowspan='2' style='background-color:green;'>SUB AGENT</th><td>Cruise - Tour</td>
                         <td><input type=text name='cadl12sa' value='$pricesa[CruiseAdl12]' style='background-color:green;color:white;' size='12' onkeyup='isNumber(this)'></td></td>
                         <td><input type=text name='cadl34sa' value='$pricesa[CruiseAdl34]' style='background-color:green;color:white;' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='cchd12sa' value='$pricesa[CruiseChd12]' style='background-color:green;color:white;' size='12'onkeyup='isNumber(this)'></td>
                         <td><input type=text name='cchd34sa' value='$pricesa[CruiseChd34]' style='background-color:green;color:white;' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='rsinfantsa' value='$pricesa[SellingInfant]' style='background-color:green;color:white;' size='10' onkeyup='isNumber(this)'></td></tr>
                    <tr><td>Cruise - Land Only</td>
                         <td><input type=text name='cladl12sa' value='$pricesa[CruiseLoAdl12]' style='background-color:green;color:white;' size='12' onkeyup='isNumber(this)'></td></td>
                         <td><input type=text name='cladl34sa' value='$pricesa[CruiseLoAdl34]' style='background-color:green;color:white;' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='clchd12sa' value='$pricesa[CruiseLoChd12]' style='background-color:green;color:white;' size='12'onkeyup='isNumber(this)'></td>
                         <td><input type=text name='clchd34sa' value='$pricesa[CruiseLoChd34]' style='background-color:green;color:white;' size='12' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='lainfantsa' value='$pricesa[LAInfant]' style='background-color:green;color:white;' size='10' onkeyup='isNumber(this)'></td></tr>
          </table>";
          }else{
          echo"
          <table>
                    <tr><th></th><th>Recommended Selling Price in $r[SellingCurr]</th><th>ADULT</th><th>CHILD TWN</th><th>CHILD X BED</th><th>Child No bed</th><th>Infant</th></tr>
                    <tr><th rowspan='2'>REGULAR</th><td>Tour</td><td><input type=text name='rsadult' value='$r[SellingAdlTwn]' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='rschdtwn' value='$r[SellingChdTwn]' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdxbed' value='$r[SellingChdXbed]' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdnbed' value='$r[SellingChdNbed]' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rsinfant' value='$r[SellingInfant]' size='10' onkeyup='isNumber(this)' required></td></tr>
                    <tr><td>Land Arrangement Only</td><td><input type=text name='laadltwn' value='$r[LAAdlTwn]' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='lachdtwn' value='$r[LAChdTwn]' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdxbed' value='$r[LAChdXbed]' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdnbed' value='$r[LAChdNbed]' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lainfant' value='$r[LAInfant]' size='10' onkeyup='isNumber(this)' required></td></tr>

                    <tr><th rowspan='2' style='background-color:#f58232;'>INTERNAL</th><td>Tour</td><td><input type=text name='rsadultin' value='$pricein[SellingAdlTwn]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='rschdtwnin' value='$pricein[SellingChdTwn]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdxbedin' value='$pricein[SellingChdXbed]' style='background-color:#f58232;' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdnbedin' value='$pricein[SellingChdNbed]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rsinfantin' value='$pricein[SellingInfant]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td></tr>
                    <tr><td>Land Arrangement Only</td><td><input type=text name='laadltwnin' value='$pricein[LAAdlTwn]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='lachdtwnin' value='$pricein[LAChdTwn]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdxbedin' value='$pricein[LAChdXbed]' style='background-color:#f58232;' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdnbedin' value='$pricein[LAChdNbed]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lainfantin' value='$pricein[LAInfant]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td></tr>

                    <tr><th rowspan='2' style='background-color:red;'>PANORAMA WORLD</th><td>Tour</td><td><input type=text name='rsadultpw' value='$pricepw[SellingAdlTwn]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='rschdtwnpw' value='$pricepw[SellingChdTwn]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdxbedpw' value='$pricepw[SellingChdXbed]' style='background-color:red;' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdnbedpw' value='$pricepw[SellingChdNbed]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rsinfantpw' value='$pricepw[SellingInfant]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td></tr>
                    <tr><td>Land Arrangement Only</td><td><input type=text name='laadltwnpw' value='$pricepw[LAAdlTwn]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='lachdtwnpw' value='$pricepw[LAChdTwn]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdxbedpw' value='$pricepw[LAChdXbed]' style='background-color:red;' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdnbedpw' value='$pricepw[LAChdNbed]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lainfantpw' value='$pricepw[LAInfant]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td></tr>

                    <tr><th rowspan='2' style='background-color:blue;'>SISTER COMPANY</th><td>Tour</td><td><input type=text name='rsadultsc' value='$pricesc[SellingAdlTwn]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='rschdtwnsc' value='$pricesc[SellingChdTwn]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdxbedsc' value='$pricesc[SellingChdXbed]' style='background-color:blue;color:white;' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdnbedsc' value='$pricesc[SellingChdNbed]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rsinfantsc' value='$pricesc[SellingInfant]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td></tr>
                    <tr><td>Land Arrangement Only</td><td><input type=text name='laadltwnsc' value='$pricesc[LAAdlTwn]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='lachdtwnsc' value='$pricesc[LAChdTwn]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdxbedsc' value='$pricesc[LAChdXbed]' style='background-color:blue;color:white;' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdnbedsc' value='$pricesc[LAChdNbed]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lainfantsc' value='$pricesc[LAInfant]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td></tr>

                    <tr><th rowspan='2' style='background-color:green;'>SUB AGENT</th><td>Tour</td><td><input type=text name='rsadultsa' value='$pricesa[SellingAdlTwn]' style='background-color:green;color:white;' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='rschdtwnsa' value='$pricesa[SellingChdTwn]' style='background-color:green;color:white;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdxbedsa' value='$pricesa[SellingChdXbed]' style='background-color:green;color:white;' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdnbedsa' value='$pricesa[SellingChdNbed]' style='background-color:green;color:white;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rsinfantsa' value='$pricesa[SellingInfant]' style='background-color:green;color:white;' size='10' onkeyup='isNumber(this)' required></td></tr>
                    <tr><td>Land Arrangement Only</td><td><input type=text name='laadltwnsa' value='$pricesa[LAAdlTwn]' style='background-color:green;color:white;' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='lachdtwnsa' value='$pricesa[LAChdTwn]' style='background-color:green;color:white;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdxbedsa' value='$pricesa[LAChdXbed]' style='background-color:green;color:white;' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdnbedsa' value='$pricesa[LAChdNbed]' style='background-color:green;color:white;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lainfantsa' value='$pricesa[LAInfant]' style='background-color:green;color:white;' size='10' onkeyup='isNumber(this)' required></td></tr>

          </table>";
          }
          echo"
          <table>
          <tr><th>Description</th><th>Curr</th><th>Nett</th><th>selling</th></tr>
          <tr><td>Airport Tax & Flight Insurance</td> <td>$r[SellingCurr]</td><td> <input type=text name='taxinsnett' size='12' value='$r[TaxInsNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='taxinssell' size='12' value='$r[TaxInsSell]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Single Supplement</td> <td>$r[SellingCurr]</td><td> <input type=text name='singlenett' size='12' value='$r[SingleNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='singlesell' size='12' value='$r[SingleSell]'onkeyup='isNumber(this)'></td></tr> 
          <tr><td>Visa </td><td><select name='visacurr' ";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo">";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($r[VisaCurr]==''){$r[VisaCurr]='IDR';}
            while($s=mysql_fetch_array($tampil)){
                  if($s[curr]==$r[VisaCurr]){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                     echo "<option value='$s[curr]'>$s[curr]</option>";   
                    }         
            }
    echo "</select></td><td> <input type=text name='visanett' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaNett]'onkeyup='isNumber(this)'></td><td><input type=text name='visasell' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaSell]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Visa 2</td><td><select name='visacurr2' ";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo">";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($r[VisaCurr2]==''){$r[VisaCurr2]='USD';}
            while($s=mysql_fetch_array($tampil)){
                  if($s[curr]==$r[VisaCurr2]){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                     echo "<option value='$s[curr]'>$s[curr]</option>";   
                    }         
            }
    echo "</select></td><td> <input type=text name='visanett2' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaNett2]'onkeyup='isNumber(this)'></td><td><input type=text name='visasell2' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaSell2]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Domestic Airport Tax</td><td><select name='airtaxcurr' >";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($r[AirTaxCurr]==''){$r[AirTaxCurr]='IDR';} 
            while($s=mysql_fetch_array($tampil)){    
                     if($s[curr]==$r[AirTaxCurr]){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                     echo "<option value='$s[curr]'>$s[curr]</option>";   
                    }
                
            }
          if($r[AirTaxNett]==''){$airtaxnet='150000';}else{$airtaxnet=$r[AirTaxNett];}
          if($r[AirTaxSell]==''){$airtaxsell='150000';}else{$airtaxsell=$r[AirTaxSell];}
    echo "</select></td><td> <input type=text name='airtaxnett' size='12' value='$airtaxnet'onkeyup='isNumber(this)'></td><td> <input type=text name='airtaxsell' size='12' value='$airtaxsell'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Sea Tax</td><td>$r[SellingCurr]</td><td> <input type=text name='seataxnett' size='12' value='$r[SeaTaxNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='seataxsell' size='12' value='$r[SeaTaxSell]'onkeyup='isNumber(this)'></td></tr>
          </table>
          <center>";
          if($r[QuotationStatus]=='DRAFT' OR $r[QuotationStatus]=='REQUEST'){
		  	if(($ltmauthority=='LEISURE ADMINISTRATOR' or $ltmauthority=='ADMINISTRATOR') and $r[QuotationStatus]=='REQUEST')
			{
				 echo"
                  	<input type='radio' name='quostatus' value='APPROVE'";if($r[QuotationStatus]=='APPROVE'){echo"checked";}echo">APPROVE
                  	<input type='radio' name='quostatus' value='DRAFT'";if($r[QuotationStatus]=='DRAFT'){echo"checked";}echo">REVISE
					  <br><br>
					  <input type='submit' name='submit' value='SAVE'>
					  <input type=button value=CLOSE onclick=self.history.back()>
					  </form>";
		
			}
			else
			{
			  echo"
			  <input type='radio' name='quostatus' value='DRAFT'";if($r[QuotationStatus]=='DRAFT'){echo"checked";}echo">DRAFT
			  <input type='radio' name='quostatus' value='REQUEST'";if($r[QuotationStatus]=='REQUEST'){echo"checked";}echo">REQUEST APPROVAL";
			  echo "<br><br>
         		 <input type='submit' name='submit' value='SAVE'>
      		    </form>";
 			  }
          }


    
     break;
     
case "quotation4tmr":
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $depdate = substr($r[DateTravelFrom],8,2);  
    $bulan = date("M", strtotime($r[DateTravelFrom]));
    $inputdate = date("d M Y", strtotime($r[InputDate]));
    $edit1=mysql_query("SELECT * FROM tour_msdetail WHERE IDProduct = '$_GET[id]'");
    $m=mysql_fetch_array($edit1);
    $a1=mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]'  ORDER BY SellingRate DESC ");
    $cek1=mysql_fetch_array($a1);  
    $a2=mysql_query("SELECT * FROM tour_detail
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]'  ORDER BY SellingRate DESC ");
    $cek2=mysql_fetch_array($a2);
    $OD=$r[OptionDeal];
    echo "<h2>Quotation </h2>
           <form method=POST name='example' action='./aksi.php?module=quotation&act=copyquotation' >
          <input type=hidden name='id' value='$r[IDProduct]'>
          <table>
           <tr style='border: hidden;'><td style='border: hidden;'>Created By</td><td>: $r[InputBy]</td><td width='200' style='border: hidden;'></td> <td style='border: hidden;'>Tour Code</td> <td>: $r[TourCode]</td></tr>
          <tr style='border: hidden;'><td style='border: hidden;'>Created Date</td> <td>: $inputdate</td><td style='border: hidden;'></td><td style='border: hidden;'>Number of Days</td> <td>: $r[DaysTravel] Days</td></tr>                       
          <tr style='border: hidden;'><td style='border: hidden;'>Currency</td> <td>: $r[SellingCurr]</td><td style='border: hidden;'></td><td style='border: hidden;'>Departure Date</td> <td>: $depdate $bulan/$r[Flight]</td></tr>
          <tr style='border: hidden;'><td style='border: hidden;'>Total Seat</td> <td>: $r[Seat] PAX ";if($r[TourLeaderInc]=='YES'){echo" + Tour Leader";} echo"</td><td style='border: hidden;'></td><td style='border: hidden;'><input type='button' name='iwant' name='iwant' value='Copy Quotation'  onclick=Sowit() ></td>
          <td> <select name='idcopy' id='idcopy' style='visibility:hidden'>
            <option value='0' selected>- Select TourCode -</option>";     
           // copy quotation berdasarkan product code yang sama saja
            $tampil0=mysql_query("SELECT * FROM tour_msproduct   
                                WHERE Status <> 'VOID'
                                AND IDProduct <> '$r[IDProduct]' and ProductCode='$r[ProductCode]'
                                ORDER BY TourCode ASC");
            while($r0=mysql_fetch_array($tampil0)){     
                    echo "<option value='$r0[IDProduct]'>$r0[TourCode]</option>"; 
            }
    echo "</select></td></tr>  
          <tr style='border: hidden;'><td style='border: hidden;'></td>
          <td></td><td width='200' style='border: hidden;'></td><td style='border: hidden;'></td> <td><input type='submit' name='apdet' id='apdet' value=Copy style='visibility:hidden'></td></tr>
          </table>
          </form>
          <table><td  style='border: hidden;'>           
          <input type='button' name='submit' value='Edit Fix Cost' onclick=PopupCenter('quotation.php?id=$_GET[id]','fix',740,480) >
                    <table>
                    <tr><th width='180'>FIX Cost</th><th width='80'>adult</th><th width='80'>child</th></tr>";
                    for ($x=1;$x<11;$x++){ 
                    $tampil=mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX$x' ORDER BY IDDetail ASC ");
                    $data=mysql_fetch_array($tampil);
               echo "
                    <tr><td>$data[Description]</td><td>$r[SellingCurr]. $data[SellAdult]</td><td>$r[SellingCurr]. $data[SellChd]</td></tr>";
                    }
                    $tam=mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct = '$r[IDProduct]'  ");
                    $dt=mysql_fetch_array($tam);
               echo"<tr><td><b><i>TOTAL</td><td><b><i>$r[SellingCurr]. $dt[TotalFixAdult]</td><td><b><i>$r[SellingCurr]. $dt[TotalFixChd]</td></table>";
                    
          echo"
          </td><td width='20'  style='border: hidden;'></td><td  style='border: hidden;'>  
          <input type='button' name='submit' value='Edit Variable Cost' onclick=PopupCenter('variable.php?id=$_GET[id]','variable',550,480)>
                     <table>
                    <tr><th width='180'>variable</th><th width='80'>adult</th></tr>";
                    for ($i=1;$i<11;$i++){ 
                    $tampil=mysql_query("SELECT * FROM tour_detail
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR$i' ORDER BY IDDetail ASC ");
                    $data=mysql_fetch_array($tampil);
               echo "
                    <tr><td>$data[Description]</td><td>$r[SellingCurr]. $data[SellAdult]</td></tr>";
                    }
                    $tam2=mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct = '$r[IDProduct]'  ");
                    $dt2=mysql_fetch_array($tam2);
               echo"<tr><td><b><i>TOTAL</td><td><b><i>$r[SellingCurr]. $dt2[TotalVar]</td></table>
          </td></table>
          
          <form method=POST name='quotation' action='./aksi.php?module=fixcost&act=input'>
          <input type=hidden name=id value='$r[IDProduct]'>
          <input type=hidden name='pax' value='$r[Seat]'>
          <font size='2'><i>Agent Cost</i></font>";
                    $tam3=mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct = '$r[IDProduct]'  ");
                    $dt3=mysql_fetch_array($tam3);
                    if($dt3[AliasOptA]==''){$aliasa='OPTION A';}else{$aliasa=$dt3[AliasOptA];}
                    if($dt3[AliasOptB]==''){$aliasb='OPTION B';}else{$aliasb=$dt3[AliasOptB];}
                    if($dt3[AliasOptC]==''){$aliasc='OPTION C';}else{$aliasc=$dt3[AliasOptC];}
              echo "<table><tr><th></th>
                    ";if($OD=='A'){echo"
                    <th colspan =3><input type='button' name='submit' value='$aliasa' onclick=PopupCenter('agent.php?id=$_GET[id]','variable',920,520)></th>
                    ";}if($OD=='B'){echo"
                    <th colspan=3><input type='button' name='submit' value='$aliasb' onclick=PopupCenter('agent.php?id=$_GET[id]&act=b','variable',920,520) ";if($m[TotalAdultA]=='0'){echo"disabled";} echo"></th>
                    ";}if($OD=='C'){echo"
                    <th colspan=3><input type='button' name='submit' value='$aliasc' onclick=PopupCenter('agent.php?id=$_GET[id]&act=c','variable',920,520) ";if($m[TotalAdultB]=='0'){echo"disabled";} echo"></th></tr>
                    ";}echo"
                    <tr><th>Number of Pax --></th>
                    ";if($OD=='A'){echo"
                    <th colspan =3>$dt3[PaxA] PAX</th>
                    ";}if($OD=='B'){echo"
                    <th colspan=3>$dt3[PaxB] PAX</th>
                    ";}if($OD=='C'){echo"
                    <th colspan=3>$dt3[PaxC] PAX</th>
                    ";}echo"
                    </tr>
                    <tr><th width='150'>Description</th><th width='78'>ADULT</th><th width='78'>CHILD TWN</th><th width='78'>CHILD X BED</th></tr>"; 
                    for ($i=1;$i<11;$i++){ 
                    $tampil=mysql_query("SELECT * FROM tour_agent
                                where IDProduct = '$r[IDProduct]' and Category = 'AGENT$i' ");
                    $data=mysql_fetch_array($tampil);  
               echo "<td>$data[Description]</td> 
                     ";if($OD=='A'){echo"
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellAdultA]</td>
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellChdTwnA]</td>
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellChdXbedA]</td>
                     ";}if($OD=='B'){echo"
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellAdultB]</td>
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellChdTwnB]</td>
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellChdXbedB]</td>
                     ";}if($OD=='C'){echo"
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellAdultC]</td>
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellChdTwnC]</td>
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellChdXbedC]</td>
                     ";}echo"
                     </tr>";
                    }
                    
                    echo "
                    <tr><td><b><i>TOTAL</td>
                    ";if($OD=='A'){echo"
                    <td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalAdultA]</td><td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalChdTwnA]</td><td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalChdXbedA]</td>
                    ";}if($OD=='B'){echo"
                    <td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalAdultB]</td><td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalChdTwnB]</td><td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalChdXbedB]</td>
                    ";}if($OD=='C'){echo"
                    <td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalAdultC]</td><td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalChdTwnC]</td><td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalChdXbedC]</td>
                    ";}echo"
                    </tr></table>";  
          echo"</form>
          
          <form method=POST name='calculate' onsubmit='return validateFormsKosong(this)' action='./aksi.php?module=msproduct&act=quotation'>
          <input type=hidden name=id value='$r[IDProduct]'> 
          <input type=hidden name='tourcode' value='$r[TourCode]'>";
            $tampil=mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct='$r[IDProduct]'  ");
            $data=mysql_fetch_array($tampil);    
            if($data[PaxA]=='0'){$tva=number_format(($data[TotalVar]), 2, '.', '');}else{$tva=number_format(($data[TotalVar] / $data[PaxA]), 2, '.', '');}
            if($data[PaxB]=='0'){$tvb=number_format(($data[TotalVar]), 2, '.', '');}else{$tvb=number_format(($data[TotalVar] / $data[PaxB]), 2, '.', '');}
            if($data[PaxC]=='0'){$tvc=number_format(($data[TotalVar]), 2, '.', '');}else{$tvc=number_format(($data[TotalVar] / $data[PaxC]), 2, '.', '');}
            
            if($data[PaxA]<>''){$tfaa=number_format(($data[TotalFixAdult]), 2, '.', '');$tfca=number_format(($data[TotalFixChd]), 2, '.', '');}//else{$tfaa=$data[TotalFixAdult] / $data[PaxA];$tfca=$data[TotalFixChd] / $data[PaxA];}
            if($data[PaxB]<>''){$tfab=number_format(($data[TotalFixAdult]), 2, '.', '');$tfcb=number_format(($data[TotalFixChd]), 2, '.', '');}//else{$tfab=$data[TotalFixAdult] / $data[PaxB];$tfcb=$data[TotalFixChd] / $data[PaxB];}
            if($data[PaxC]<>''){$tfac=number_format(($data[TotalFixAdult]), 2, '.', '');$tfcc=number_format(($data[TotalFixChd]), 2, '.', '');}//else{$tfac=$data[TotalFixAdult] / $data[PaxC];$tfcc=$data[TotalFixChd] / $data[PaxC];}
            
            if($data[PaxA]<>''){$taaa=number_format(($data[TotalAdultA]), 2, '.', '');$taca=number_format(($data[TotalChdTwnA]), 2, '.', '');$tacxa=number_format(($data[TotalChdXbedA]), 2, '.', '');}//else{$taaa=$data[TotalAdultA] / $data[PaxA];$taca=$data[TotalChdTwnA] / $data[PaxA];$tacxa=$data[TotalChdXbedA] / $data[PaxA];}
            if($data[PaxB]<>''){$taab=number_format(($data[TotalAdultB]), 2, '.', '');$tacb=number_format(($data[TotalChdTwnB]), 2, '.', '');$tacxb=number_format(($data[TotalChdXbedB]), 2, '.', '');}//else{$taab=$data[TotalAdultB] / $data[PaxB];$tacb=$data[TotalChdTwnB] / $data[PaxB];$tacxb=$data[TotalChdXbedB] / $data[PaxB];}
            if($data[PaxC]<>''){$taac=number_format(($data[TotalAdultC]), 2, '.', '');$tacc=number_format(($data[TotalChdTwnC]), 2, '.', '');$tacxc=number_format(($data[TotalChdXbedC]), 2, '.', '');}//else{$taac=$data[TotalAdultC] / $data[PaxC];$tacc=$data[TotalChdTwnC] / $data[PaxC];$tacxc=$data[TotalChdXbedC] / $data[PaxC];}
            
            $comaa=number_format(($data[ComAdultA]), 2, '.', '');$comca=number_format(($data[ComChdTwnA]), 2, '.', '');$comcxa=number_format(($data[ComChdXbedA]), 2, '.', '');
            $comab=number_format(($data[ComAdultB]), 2, '.', '');$comcb=number_format(($data[ComChdTwnB]), 2, '.', '');$comcxb=number_format(($data[ComChdXbedB]), 2, '.', '');
            $comac=number_format(($data[ComAdultC]), 2, '.', '');$comcc=number_format(($data[ComChdTwnC]), 2, '.', '');$comcxc=number_format(($data[ComChdXbedC]), 2, '.', '');
            //real nett
            $nettaa=number_format(($tva+$tfaa+$comaa+$taaa), 2, '.', ''); 
            $nettca=number_format(($tva+$tfca+$comca+$taca), 2, '.', ''); 
            $nettcxa=number_format(($tva+$tfca+$comcxa+$tacxa), 2, '.', ''); 
            $nettab=number_format(($tvb+$tfab+$comab+$taab), 2, '.', '');
            $nettcb=number_format(($tvb+$tfcb+$comcb+$tacb), 2, '.', ''); 
            $nettcxb=number_format(($tvb+$tfcb+$comcxb+$tacxb), 2, '.', ''); 
            $nettac=number_format(($tvc+$tfac+$comac+$taac), 2, '.', ''); 
            $nettcc=number_format(($tvc+$tfcc+$comcc+$tacc), 2, '.', '');
            $nettcxc=number_format(($tvc+$tfcc+$comcxc+$tacxc), 2, '.', ''); 
            //itung net var + fix + agent
            $nettaa1=number_format(($tva+$tfaa+$taaa), 2, '.', ''); 
            $nettca1=number_format(($tva+$tfca+$taca), 2, '.', ''); 
            $nettcxa1=number_format(($tva+$tfca+$tacxa), 2, '.', ''); 
            $nettab1=number_format(($tvb+$tfab+$taab), 2, '.', ''); 
            $nettcb1=number_format(($tvb+$tfcb+$tacb), 2, '.', '');
            $nettcxb1=number_format(($tvb+$tfcb+$tacxb), 2, '.', ''); 
            $nettac1=number_format(($tvc+$tfac+$taac), 2, '.', ''); 
            $nettcc1=number_format(($tvc+$tfcc+$tacc), 2, '.', ''); 
            $nettcxc1=number_format(($tvc+$tfcc+$tacxc), 2, '.', ''); 
            //itung profit margin
            if($data[Persen]=='0'){
            $paa=0; 
            $pca=0; 
            $pcxa=0; 
            $pab=0; 
            $pcb=0;
            $pcxb=0; 
            $pac=0; 
            $pcc=0;
            $pcxc=0;
            }else{
            $paa=number_format(($nettaa*$data[Persen])/100, 2, '.', '');
            $pca=number_format(($nettca*$data[Persen])/100, 2, '.', '');
            $pcxa=number_format(($nettcxa*$data[Persen])/100, 2, '.', '');
            $pab=number_format(($nettab*$data[Persen])/100, 2, '.', '');
            $pcb=number_format(($nettcb*$data[Persen])/100, 2, '.', '');
            $pcxb=number_format(($nettcxb*$data[Persen])/100, 2, '.', '');
            $pac=number_format(($nettac*$data[Persen])/100, 2, '.', '');
            $pcc=number_format(($nettcc*$data[Persen])/100, 2, '.', '');
            $pcxc=number_format(($nettcxc*$data[Persen])/100, 2, '.', '');
            }
            // itung selling
            $sellaa = number_format($nettaa + $paa + $data[DiscAdultA], 2, '.', '');
            $sellca = number_format($nettca + $pca + $data[DiscChdTwnA], 2, '.', '');
            $sellcxa = number_format($nettcxa + $pcxa + $data[DiscChdXbedA], 2, '.', '');
            $sellab = number_format($nettab + $pab + $data[DiscAdultB], 2, '.', '');
            $sellcb = number_format($nettcb + $pcb + $data[DiscChdTwnB], 2, '.', '');
            $sellcxb = number_format($nettcxb + $pcxb + $data[DiscChdXbedB], 2, '.', '');
            $sellac = number_format($nettac + $pac + $data[DiscAdultC], 2, '.', '');
            $sellcc = number_format($nettcc + $pcc + $data[DiscChdTwnC], 2, '.', '');
            $sellcxc = number_format($nettcxc + $pcxc + $data[DiscChdXbedC], 2, '.', '');
            //disc
            $disaa=number_format($data[DiscAdultA], 2, '.', '');
            $disca = number_format($data[DiscChdTwnA], 2, '.', '');
            $discxa = number_format($data[DiscChdXbedA], 2, '.', '');
            $disab = number_format($data[DiscAdultB], 2, '.', '');
            $discb = number_format($data[DiscChdTwnB], 2, '.', '');
            $discxb = number_format($data[DiscChdXbedB], 2, '.', '');
            $disac = number_format($data[DiscAdultC], 2, '.', '');
            $discc = number_format($data[DiscChdTwnC], 2, '.', '');
            $discxc = number_format($data[DiscChdXbedC], 2, '.', '');   
            
            echo "<table><input type=hidden name='sumaa' value='$nettaa1'><input type=hidden name='sumca' value='$nettca1'><input type=hidden name='sumcxa' value='$nettcxa1'>
            <input type=hidden name='sumab' value='$nettab1'><input type=hidden name='sumcb' value='$nettcb1'><input type=hidden name='sumcxb' value='$nettcxb1'> 
            <input type=hidden name='sumac' value='$nettac1'><input type=hidden name='sumcc' value='$nettcc1'><input type=hidden name='sumcxc' value='$nettcxc1'> 
                    <tr><th width=150></th><th width=78>ADULT</th><th width=78>CHILD TWN</th><th width=78>CHILD X BED</th></tr>
                     <tr><td width='150'>Total Variable Cost</td>
                     ";if($OD=='A'){echo"
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvaradulta' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvarchdtwna' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvarchdxbeda' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     ";}if($OD=='B'){echo"
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvaradultb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvarchdtwnb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvarchdxbedb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     ";}if($OD=='C'){echo"
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvaradultc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvarchdtwnc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvarchdxbedc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     ";}echo"
                     <tr><td>Total Fix Cost</td>
                     ";if($OD=='A'){echo"
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixadulta' value='$tfaa'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixchdtwna' value='$tfca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixchdxbeda' value='$tfca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     ";}if($OD=='B'){echo"
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixadultb' value='$tfab'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixchdtwnb' value='$tfcb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixchdxbedb' value='$tfcb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     ";}if($OD=='C'){echo"
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixadultc' value='$tfac'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixchdtwnc' value='$tfcc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixchdxbedc' value='$tfcc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     ";}echo"
                     <tr><td>Total Agent Cost</td>
                     ";if($OD=='A'){echo"
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentadulta' value='$taaa'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentchdtwna' value='$taca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentchdxbeda' value='$tacxa'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     ";}if($OD=='B'){echo"
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentadultb' value='$taab'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentchdtwnb' value='$tacb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentchdxbedb' value='$tacxb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     ";}if($OD=='C'){echo"
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentadultc' value='$taac'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentchdtwnc' value='$tacc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentchdxbedc' value='$tacxc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     ";}echo"
                     <tr><td>Agent Commision <input type=text name='comall' id='sadult' size='5' style='text-align: right' onkeyup='isNumber(this),UpdateNetta(),UpdateNettb(),UpdateNettc()' value='$comaa'></td>
                     ";if($OD=='A'){echo"    
                     <td BGCOLOR='#f5bebe'><input type=text name='comaa' id='sadult' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly  value='$comaa'></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='comca' id='ssin' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$comca'></td></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='comcxa' id='schdtwn' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$comcxa'></td>
                     ";}if($OD=='B'){echo"
                     <td BGCOLOR='#bef5c6'><input type=text name='comab' id='schdnbed' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$comab'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='comcb' id='schdxbed' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$comcb'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='comcxb' id='sinfant' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$comcxb'></td>
                     ";}if($OD=='C'){echo"
                     <td BGCOLOR='#becaf5'><input type=text name='comac' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$comac'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='comcc' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$comcc'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='comcxc' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$comcxc'></td></tr>
                     ";}echo"
                     <tr><td>Nett </td>
                     ";if($OD=='A'){echo"  
                     <td BGCOLOR='#f5bebe'><input type='text' name='nettaa' id='padult' value='$nettaa'  size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettaa<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='nettca' id='psingle' value='$nettca' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettca<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='nettcxa' id='pchdtwn' value='$nettcxa' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcxa<0){echo"background: red";}echo"' readonly></td>
                     ";}if($OD=='B'){echo"
                     <td BGCOLOR='#bef5c6'><input type='text' name='nettab' id='pchdnbed' value='$nettab' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettab<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='nettcb' id='pchdxbed' value='$nettcb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcb<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='nettcxb' id='pinfant' value='$nettcxb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcxb<0){echo"background: red";}echo"' readonly></td>
                     ";}if($OD=='C'){echo"
                     <td BGCOLOR='#becaf5'><input type='text' name='nettac' id='pchdnbed' value='$nettac' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettac<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='nettcc' id='pchdxbed' value='$nettcc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcc<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='nettcxc' id='pinfant' value='$nettcxc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcxc<0){echo"background: red";}echo"' readonly></td></tr>
                     ";}echo"
                     <tr><th colspan=10></th></tr>   
                     <tr><td>Profit Margin <input type=text name='persen' size='2' onkeyup='isNumber(this),UpdateProfit()'value='$data[Persen]'> %</td>
                     ";if($OD=='A'){echo" 
                     <td BGCOLOR='#f5bebe'><input type='text' name='paa' size='8' value='$paa' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='pca' size='8' value='$pca' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='pcxa' size='8' value='$pcxa' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000; ' readonly></td>
                     ";}if($OD=='B'){echo"
                     <td BGCOLOR='#bef5c6'><input type='text' name='pab' size='8' value='$pab' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='pcb' size='8' value='$pcb' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='pcxb' size='8' value='$pcxb' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000; ' readonly></td>
                     ";}if($OD=='C'){echo"
                     <td BGCOLOR='#becaf5'><input type='text' name='pac' size='8' value='$pac' style='background-color:#becaf5;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='pcc' size='8' value='$pcc' style='background-color:#becaf5;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='pcxc' size='8' value='$pcxc' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     ";}echo"
                     <tr><td>Spare for Discount <input type=text name='discall' id='sadult' size='5' style='text-align: right' onkeyup='isNumber(this),UpdateSell()' value='$disaa'></td>
                     ";if($OD=='A'){echo" 
                     <td BGCOLOR='#f5bebe'><input type=text name='discaa' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$disaa'></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='discca' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$disca'></td></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='disccxa' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$discxa'></td>
                     ";}if($OD=='B'){echo"
                     <td BGCOLOR='#bef5c6'><input type=text name='discab' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$disab'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='disccb' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$discb'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='disccxb' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$discxb'></td>
                     ";}if($OD=='C'){echo"
                     <td BGCOLOR='#becaf5'><input type=text name='discac' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$disac'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='disccc' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$discc'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='disccxc' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$discxc'></td></tr> 
                     ";}echo"
                     <tr><td>Selling Price</td>
                     ";if($OD=='A'){echo" 
                     <td BGCOLOR='#f5bebe'><input type='text' name='sellaa' value='$sellaa'  size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellaa<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='sellca' value='$sellca' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellca<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='sellcxa' value='$sellcxa' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcxa<0){echo"background: red";}echo"' readonly></td>
                     ";}if($OD=='B'){echo"
                     <td BGCOLOR='#bef5c6'><input type='text' name='sellab' value='$sellab' size='6'  style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellab<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='sellcb' value='$sellcb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcb<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='sellcxb' value='$sellcxb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcxb<0){echo"background: red";}echo"' readonly></td>
                     ";}if($OD=='C'){echo"
                     <td BGCOLOR='#becaf5'><input type='text' name='sellac' value='$sellac' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellac<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='sellcc' value='$sellcc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcc<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='sellcxc' value='$sellcxc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcxc<0){echo"background: red";}echo"' readonly></td></tr>
                     ";}echo"
                     </table>    
          <table>
                    <tr><th>Recommended Selling Price in $r[SellingCurr]</th><th>ADULT</th><th>CHILD TWN</th><th>CHILD X BED</th><th>Child No bed</th><th>Infant</th></tr>
                    <tr><td>Tour</td><td><input type=text name='rsadult' value='$r[SellingAdlTwn]' size='10' onkeyup='isNumber(this)'></td></td>
                         <td><input type=text name='rschdtwn' value='$r[SellingChdTwn]' size='10' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='rschdxbed' value='$r[SellingChdXbed]' size='10'onkeyup='isNumber(this)'></td>
                         <td><input type=text name='rschdnbed' value='$r[SellingChdNbed]' size='10' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='rsinfant' value='$r[SellingInfant]' size='10' onkeyup='isNumber(this)'></td></tr>
                    <tr><td>Land Arrangement Only</td><td><input type=text name='laadltwn' value='$r[LAAdlTwn]' size='10' onkeyup='isNumber(this)'></td></td>
                         <td><input type=text name='lachdtwn' value='$r[LAChdTwn]' size='10' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='lachdxbed' value='$r[LAChdXbed]' size='10'onkeyup='isNumber(this)'></td>
                         <td><input type=text name='lachdnbed' value='$r[LAChdNbed]' size='10' onkeyup='isNumber(this)'></td>
                         <td><input type=text name='lainfant' value='$r[LAInfant]' size='10' onkeyup='isNumber(this)'></td></tr>     
          </table>
          <table>
          <tr><th>Description</th><th>Curr</th><th>Nett</th><th>selling</th></tr>
          <tr><td>Airport Tax & Flight Insurance</td> <td>$r[SellingCurr]</td><td> <input type=text name='taxinsnett' size='12' value='$r[TaxInsNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='taxinssell' size='12' value='$r[TaxInsSell]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Single Supplement</td> <td>$r[SellingCurr]</td><td> <input type=text name='singlenett' size='12' value='$r[SingleNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='singlesell' size='12' value='$r[SingleSell]'onkeyup='isNumber(this)'></td></tr> 
          <tr><td>Visa </td><td><select name='visacurr' ";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo">";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($r[VisaCurr]==''){$r[VisaCurr]='IDR';}
            while($s=mysql_fetch_array($tampil)){
                  if($s[curr]==$r[VisaCurr]){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                     echo "<option value='$s[curr]'>$s[curr]</option>";   
                    }         
            }
    echo "</select></td><td> <input type=text name='visanett' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaNett]'onkeyup='isNumber(this)'></td><td><input type=text name='visasell' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaSell]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Visa 2</td><td><select name='visacurr2' ";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo">";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($r[VisaCurr2]==''){$r[VisaCurr2]='USD';}
            while($s=mysql_fetch_array($tampil)){
                  if($s[curr]==$r[VisaCurr2]){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                     echo "<option value='$s[curr]'>$s[curr]</option>";   
                    }         
            }
    echo "</select></td><td> <input type=text name='visanett2' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaNett2]'onkeyup='isNumber(this)'></td><td><input type=text name='visasell2' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaSell2]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Domestic Airport Tax</td><td><select name='airtaxcurr' >";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($r[AirTaxCurr]==''){$r[AirTaxCurr]='IDR';} 
            while($s=mysql_fetch_array($tampil)){    
                     if($s[curr]==$r[AirTaxCurr]){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                     echo "<option value='$s[curr]'>$s[curr]</option>";   
                    }
                
            }
          if($r[AirTaxNett]==0){$airtaxnet='150000';}  
    echo "</select></td><td> <input type=text name='airtaxnett' size='12' value='$r[AirTaxNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='airtaxsell' size='12' value='$r[AirTaxSell]'onkeyup='isNumber(this)'></td></tr>
          </table>
          <center><input type='submit' name='submit' value='Save'>
          </form>";
     break;    
     
case "showquotation":
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $qpricein=mysql_query("SELECT * FROM tour_msproductprice WHERE ProductID = '$_GET[id]' AND PriceFor = 'INTERNAL'");
    $pricein=mysql_fetch_array($qpricein);
    $qpricepw=mysql_query("SELECT * FROM tour_msproductprice WHERE ProductID = '$_GET[id]' AND PriceFor = 'PANORAMA WORLD'");
    $pricepw=mysql_fetch_array($qpricepw);
    $qpricesc=mysql_query("SELECT * FROM tour_msproductprice WHERE ProductID = '$_GET[id]' AND PriceFor = 'SISTER COMPANY'");
    $pricesc=mysql_fetch_array($qpricesc);
    $qpricesa=mysql_query("SELECT * FROM tour_msproductprice WHERE ProductID = '$_GET[id]' AND PriceFor = 'SUB AGENT'");
    $pricesa=mysql_fetch_array($qpricesa);
    //harga panorama
    /*if($pricein[SellingChdTwn]=='0'){$priceinSellingChdTwn='0';}else{$priceinSellingChdTwn=$pricein[SellingChdTwn];}
    if($pricein[SellingChdXbed]=='0'){$priceinSellingChdXbed='0';}else{$priceinSellingChdXbed=$pricein[SellingChdXbed];}
    if($pricein[SellingChdNbed]=='0'){$priceinSellingChdNbed='0';}else{$priceinSellingChdNbed=$pricein[SellingChdNbed];}
    if($pricein[SellingInfant]=='0'){$priceinSellingInfant='0';}else{$priceinSellingInfant=$pricein[SellingInfant];}
    if($pricein[LAAdlTwn]=='0'){$priceinLAAdlTwn='0';}else{$priceinLAAdlTwn=$pricein[LAAdlTwn];}
    if($pricein[LAChdTwn]=='0'){$priceinLAChdTwn='0';}else{$priceinLAChdTwn=$pricein[LAChdTwn];}
    if($pricein[LAChdXbed]=='0'){$priceinLAChdXbed='0';}else{$priceinLAChdXbed=$pricein[LAChdXbed];}
    if($pricein[LAChdNbed]=='0'){$priceinLAChdNbed='0';}else{$priceinLAChdNbed=$pricein[LAChdNbed];}
    if($pricein[LAInfant]=='0'){$priceinLAInfant='0';}else{$priceinLAInfant=$pricein[LAInfant];}
    //harga panorama world
    if($pricepw[SellingChdTwn]=='0'){$pricepwSellingChdTwn='0';}else{$pricepwSellingChdTwn=$pricepw[SellingChdTwn];}
    if($pricepw[SellingChdXbed]=='0'){$pricepwSellingChdXbed='0';}else{$pricepwSellingChdXbed=$pricepw[SellingChdXbed];}
    if($pricepw[SellingChdNbed]=='0'){$pricepwSellingChdNbed='0';}else{$pricepwSellingChdNbed=$pricepw[SellingChdNbed];}
    if($pricepw[SellingInfant]=='0'){$pricepwSellingInfant='0';}else{$pricepwSellingInfant=$pricepw[SellingInfant];}
    if($pricepw[LAAdlTwn]=='0'){$pricepwLAAdlTwn='0';}else{$pricepwLAAdlTwn=$pricepw[LAAdlTwn];}
    if($pricepw[LAChdTwn]=='0'){$pricepwLAChdTwn='0';}else{$pricepwLAChdTwn=$pricepw[LAChdTwn];}
    if($pricepw[LAChdXbed]=='0'){$pricepwLAChdXbed='0';}else{$pricepwLAChdXbed=$pricepw[LAChdXbed];}
    if($pricepw[LAChdNbed]=='0'){$pricepwLAChdNbed='0';}else{$pricepwLAChdNbed=$pricepw[LAChdNbed];}
    if($pricepw[LAInfant]=='0'){$pricepwLAInfant='0';}else{$pricepwLAInfant=$pricepw[LAInfant];}
    //harga siscom
    if($pricesc[SellingChdTwn]=='0'){$pricescSellingChdTwn='0';}else{$pricescSellingChdTwn=$pricesc[SellingChdTwn];}
    if($pricesc[SellingChdXbed]=='0'){$pricescSellingChdXbed='0';}else{$pricescSellingChdXbed=$pricesc[SellingChdXbed];}
    if($pricesc[SellingChdNbed]=='0'){$pricescSellingChdNbed='0';}else{$pricescSellingChdNbed=$pricesc[SellingChdNbed];}
    if($pricesc[SellingInfant]=='0'){$pricescSellingInfant='0';}else{$pricescSellingInfant=$pricesc[SellingInfant];}
    if($pricesc[LAAdlTwn]=='0'){$pricescLAAdlTwn='0';}else{$pricescLAAdlTwn=$pricesc[LAAdlTwn];}
    if($pricesc[LAChdTwn]=='0'){$pricescLAChdTwn='0';}else{$pricescLAChdTwn=$pricesc[LAChdTwn];}
    if($pricesc[LAChdXbed]=='0'){$pricescLAChdXbed='0';}else{$pricescLAChdXbed=$pricesc[LAChdXbed];}
    if($pricesc[LAChdNbed]=='0'){$pricescLAChdNbed='0';}else{$pricescLAChdNbed=$pricesc[LAChdNbed];}
    if($pricesc[LAInfant]=='0'){$pricescLAInfant='0';}else{$pricescLAInfant=$pricesc[LAInfant];}*/

    $depdate = substr($r[DateTravelFrom],8,2);
    $bulan = date("M", strtotime($r[DateTravelFrom]));
    $inputdate = date("d M Y", strtotime($r[InputDate]));
    $edit1=mysql_query("SELECT * FROM tour_msdetail WHERE IDProduct = '$_GET[id]'");
    $m=mysql_fetch_array($edit1);
    $a1=mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]'  ORDER BY SellingRate DESC ");
    $cek1=mysql_fetch_array($a1);  
    $a2=mysql_query("SELECT * FROM tour_detail
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]'  ORDER BY SellingRate DESC ");
    $cek2=mysql_fetch_array($a2);
    
    echo "<h2>Quotation</h2>
          <input type=hidden name='id' value='$r[IDProduct]'>
          <table>
           <tr style='border: hidden;'><td style='border: hidden;'>Created By</td><td>: $r[InputBy]</td><td width='200' style='border: hidden;'></td> <td style='border: hidden;'>Tour Code</td> <td>: $r[TourCode]</td></tr>
          <tr style='border: hidden;'><td style='border: hidden;'>Created Date</td> <td>: $inputdate</td><td style='border: hidden;'></td><td style='border: hidden;'>Number of Days</td> <td>: $r[DaysTravel] Days</td></tr>                       
          <tr style='border: hidden;'><td style='border: hidden;'>Currency</td> <td>: $r[SellingCurr]</td><td style='border: hidden;'></td><td style='border: hidden;'>Departure Date</td> <td>: $depdate $bulan/$r[Flight]</td></tr>
          <tr style='border: hidden;'><td style='border: hidden;'>Total Seat</td> <td>: $r[Seat] PAX ";if($r[TourLeaderInc]=='YES'){echo" + Tour Leader";} echo"</td><td style='border: hidden;'></td><td style='border: hidden;'></td>
          <td></td></tr>   
          </table>  
          <table><td  style='border: hidden;'>           
          
                    <table>
                    <tr><th width='180'>FIX Cost</th><th width='80'>adult</th><th width='80'>child</th></tr>";
                    for ($x=1;$x<11;$x++){ 
                    $tampil=mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX$x' ORDER BY IDDetail ASC ");
                    $data=mysql_fetch_array($tampil);
               echo "
                    <tr><td>$data[Description]</td><td>$r[SellingCurr]. $data[SellAdult]</td><td>$r[SellingCurr]. $data[SellChd]</td></tr>";
                    }
                    $tam=mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct = '$r[IDProduct]'  ");
                    $dt=mysql_fetch_array($tam);
               echo"<tr><td><b><i>TOTAL</td><td><b><i>$r[SellingCurr]. $dt[TotalFixAdult]</td><td><b><i>$r[SellingCurr]. $dt[TotalFixChd]</td></table>";
                    
          echo"
          </td><td width='20'  style='border: hidden;'></td><td  style='border: hidden;'>  
          
                     <table>
                    <tr><th width='180'>variable</th><th width='80'>adult</th></tr>";
                    for ($i=1;$i<11;$i++){ 
                    $tampil=mysql_query("SELECT * FROM tour_detail
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR$i' ORDER BY IDDetail ASC ");
                    $data=mysql_fetch_array($tampil);
               echo "
                    <tr><td>$data[Description]</td><td>$r[SellingCurr]. $data[SellAdult]</td></tr>";
                    }
                    $tam2=mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct = '$r[IDProduct]'  ");
                    $dt2=mysql_fetch_array($tam2);
               echo"<tr><td><b><i>TOTAL</td><td><b><i>$r[SellingCurr]. $dt2[TotalVar]</td></table>
          </td></table>
          
          <form method=POST name='quotation' action='./aksi.php?module=fixcost&act=input'>
          <input type=hidden name=id value='$r[IDProduct]'>
          <input type=hidden name='pax' value='$r[Seat]'>
          <font size='2'><i>Agent Cost</i></font>";
                    $tam3=mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct = '$r[IDProduct]'  ");
                    $dt3=mysql_fetch_array($tam3);
                    if($dt3[AliasOptA]==''){$aliasa='OPTION A';}else{$aliasa=$dt3[AliasOptA];}
                    if($dt3[AliasOptB]==''){$aliasb='OPTION B';}else{$aliasb=$dt3[AliasOptB];}
                    if($dt3[AliasOptC]==''){$aliasc='OPTION C';}else{$aliasc=$dt3[AliasOptC];}
              echo "<table>
                    <tr><th></th><th colspan =4>$aliasa</th>
                    <th colspan=4>$aliasb</th>
                    <th colspan=4>$aliasc</th></tr>
                    <tr><th>Number of Pax --></th><th colspan =4>$dt3[PaxA] PAX</th><th colspan=4>$dt3[PaxB] PAX</th><th colspan=4>$dt3[PaxC] PAX</th></tr>
                    <tr><th width='150'>Description</th>
                    <th width='78'>ADULT</th><th width='78'>CHILD TWN</th><th width='78'>CHILD X BED</th><th width='78'>CHILD NO BED</th>
                    <th width='78'>ADULT</th><th width='78'>CHILD TWN</th><th width='78'>CHILD X BED</th><th width='78'>CHILD NO BED</th>
                    <th width='78'>ADULT</th><th width='78'>CHILD TWN</th><th width='78'>CHILD X BED</th><th width='78'>CHILD NO BED</th></tr>"; 
                    for ($i=1;$i<11;$i++){ 
                    $tampil=mysql_query("SELECT * FROM tour_agent
                                where IDProduct = '$r[IDProduct]' and Category = 'AGENT$i' ");
                    $data=mysql_fetch_array($tampil);  
               echo "<td>$data[Description]</td> 
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellAdultA]</td>
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellChdTwnA]</td>
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellChdXbedA]</td>
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellChdNbedA]</td>
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellAdultB]</td>
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellChdTwnB]</td>
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellChdXbedB]</td>
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellChdNbedB]</td>
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellAdultC]</td>
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellChdTwnC]</td>
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellChdXbedC]</td>
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellChdNbedC]</td></tr>";
                    }
                    
                    echo "
                    <tr><td><b><i>TOTAL</td><td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalAdultA]</td><td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalChdTwnA]</td><td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalChdXbedA]</td><td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalChdNbedA]</td>
                    <td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalAdultB]</td><td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalChdTwnB]</td><td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalChdXbedB]</td><td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalChdNbedB]</td>
                    <td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalAdultC]</td><td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalChdTwnC]</td><td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalChdXbedC]</td><td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalChdNbedC]</td></tr></table>";
                    
          echo"</form>

          <input type=hidden name=id value='$r[IDProduct]'>
          <input type=hidden name='tourcode' value='$r[TourCode]'>";
            $tampil=mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct='$r[IDProduct]'  ");
            $data=mysql_fetch_array($tampil);    
            if($data[PaxA]=='0'){$tva=number_format(($data[TotalVar]), 2, '.', '');}else{$tva=number_format(($data[TotalVar] / $data[PaxA]), 2, '.', '');}
            if($data[PaxB]=='0'){$tvb=number_format(($data[TotalVar]), 2, '.', '');}else{$tvb=number_format(($data[TotalVar] / $data[PaxB]), 2, '.', '');}
            if($data[PaxC]=='0'){$tvc=number_format(($data[TotalVar]), 2, '.', '');}else{$tvc=number_format(($data[TotalVar] / $data[PaxC]), 2, '.', '');}
            
            if($data[PaxA]<>''){$tfaa=number_format(($data[TotalFixAdult]), 2, '.', '');$tfca=number_format(($data[TotalFixChd]), 2, '.', '');}//else{$tfaa=$data[TotalFixAdult] / $data[PaxA];$tfca=$data[TotalFixChd] / $data[PaxA];}
            if($data[PaxB]<>''){$tfab=number_format(($data[TotalFixAdult]), 2, '.', '');$tfcb=number_format(($data[TotalFixChd]), 2, '.', '');}//else{$tfab=$data[TotalFixAdult] / $data[PaxB];$tfcb=$data[TotalFixChd] / $data[PaxB];}
            if($data[PaxC]<>''){$tfac=number_format(($data[TotalFixAdult]), 2, '.', '');$tfcc=number_format(($data[TotalFixChd]), 2, '.', '');}//else{$tfac=$data[TotalFixAdult] / $data[PaxC];$tfcc=$data[TotalFixChd] / $data[PaxC];}
            
            if($data[PaxA]<>''){$taaa=number_format(($data[TotalAdultA]), 2, '.', '');$taca=number_format(($data[TotalChdTwnA]), 2, '.', '');$tacxa=number_format(($data[TotalChdXbedA]), 2, '.', '');$tacna=number_format(($data[TotalChdNbedA]), 2, '.', '');}//else{$taaa=$data[TotalAdultA] / $data[PaxA];$taca=$data[TotalChdTwnA] / $data[PaxA];$tacxa=$data[TotalChdXbedA] / $data[PaxA];}
            if($data[PaxB]<>''){$taab=number_format(($data[TotalAdultB]), 2, '.', '');$tacb=number_format(($data[TotalChdTwnB]), 2, '.', '');$tacxb=number_format(($data[TotalChdXbedB]), 2, '.', '');$tacnb=number_format(($data[TotalChdNbedB]), 2, '.', '');}//else{$taab=$data[TotalAdultB] / $data[PaxB];$tacb=$data[TotalChdTwnB] / $data[PaxB];$tacxb=$data[TotalChdXbedB] / $data[PaxB];}
            if($data[PaxC]<>''){$taac=number_format(($data[TotalAdultC]), 2, '.', '');$tacc=number_format(($data[TotalChdTwnC]), 2, '.', '');$tacxc=number_format(($data[TotalChdXbedC]), 2, '.', '');$tacnc=number_format(($data[TotalChdNbedC]), 2, '.', '');}//else{$taac=$data[TotalAdultC] / $data[PaxC];$tacc=$data[TotalChdTwnC] / $data[PaxC];$tacxc=$data[TotalChdXbedC] / $data[PaxC];}
            
            $comaa=number_format(($data[ComAdultA]), 2, '.', '');$comca=number_format(($data[ComChdTwnA]), 2, '.', '');$comcxa=number_format(($data[ComChdXbedA]), 2, '.', '');$comcna=number_format(($data[ComChdNbedA]), 2, '.', '');
            $comab=number_format(($data[ComAdultB]), 2, '.', '');$comcb=number_format(($data[ComChdTwnB]), 2, '.', '');$comcxb=number_format(($data[ComChdXbedB]), 2, '.', '');$comcnb=number_format(($data[ComChdNbedB]), 2, '.', '');
            $comac=number_format(($data[ComAdultC]), 2, '.', '');$comcc=number_format(($data[ComChdTwnC]), 2, '.', '');$comcxc=number_format(($data[ComChdXbedC]), 2, '.', '');$comcnc=number_format(($data[ComChdNbedC]), 2, '.', '');
            //real nett
            $nettaa=number_format(($tva+$tfaa+$comaa+$taaa), 2, '.', ''); 
            $nettca=number_format(($tva+$tfca+$comca+$taca), 2, '.', ''); 
            $nettcxa=number_format(($tva+$tfca+$comcxa+$tacxa), 2, '.', '');
            $nettcna=number_format(($tva+$tfca+$comcna+$tacna), 2, '.', ''); 
            $nettab=number_format(($tvb+$tfab+$comab+$taab), 2, '.', '');
            $nettcb=number_format(($tvb+$tfcb+$comcb+$tacb), 2, '.', ''); 
            $nettcxb=number_format(($tvb+$tfcb+$comcxb+$tacxb), 2, '.', '');
            $nettcnb=number_format(($tvb+$tfcb+$comcnb+$tacnb), 2, '.', '');  
            $nettac=number_format(($tvc+$tfac+$comac+$taac), 2, '.', ''); 
            $nettcc=number_format(($tvc+$tfcc+$comcc+$tacc), 2, '.', '');
            $nettcxc=number_format(($tvc+$tfcc+$comcxc+$tacxc), 2, '.', '');
            $nettcnc=number_format(($tvc+$tfcc+$comcnc+$tacnc), 2, '.', ''); 
            //itung net var + fix + agent
            $nettaa1=number_format(($tva+$tfaa+$taaa), 2, '.', ''); 
            $nettca1=number_format(($tva+$tfca+$taca), 2, '.', ''); 
            $nettcxa1=number_format(($tva+$tfca+$tacxa), 2, '.', ''); 
            $nettcna1=number_format(($tva+$tfca+$tacna), 2, '.', ''); 
            $nettab1=number_format(($tvb+$tfab+$taab), 2, '.', ''); 
            $nettcb1=number_format(($tvb+$tfcb+$tacb), 2, '.', '');
            $nettcxb1=number_format(($tvb+$tfcb+$tacxb), 2, '.', '');
            $nettcnb1=number_format(($tvb+$tfcb+$tacnb), 2, '.', ''); 
            $nettac1=number_format(($tvc+$tfac+$taac), 2, '.', ''); 
            $nettcc1=number_format(($tvc+$tfcc+$tacc), 2, '.', ''); 
            $nettcxc1=number_format(($tvc+$tfcc+$tacxc), 2, '.', '');
            $nettcnc1=number_format(($tvc+$tfcc+$tacnc), 2, '.', ''); 
            //itung profit margin
           /* if($data[Persen]=='0'){
            $paa=0;$pca=0;$pcxa=0;$pcna=0; 
            $pab=0;$pcb=0;$pcxb=0;$pcnb=0; 
            $pac=0;$pcc=0;$pcxc=0;$pcnc=0;
            }else{
			*/
			$paa=number_format($data[ProfAdultA], 2, '.', '');
            $pca=number_format($data[ProfChdTwnA], 2, '.', '');
            $pcxa=number_format($data[ProfChdXbedA], 2, '.', '');
            $pcna=number_format($data[ProfChdNbedA], 2, '.', '');
            $pab=number_format($data[ProfAdultB], 2, '.', '');
            $pcb=number_format($data[ProfChdTwnB], 2, '.', '');
            $pcxb=number_format($data[ProfChdXbedB], 2, '.', '');
            $pcnb=number_format($data[ProfChdNbedB], 2, '.', '');
            $pac=number_format($data[ProfAdultC], 2, '.', '');
            $pcc=number_format($data[ProfChdTwnC], 2, '.', '');
            $pcxc=number_format($data[ProfChdXbedC], 2, '.', '');
            $pcnc=number_format($data[ProfChdNbedC], 2, '.', '');
			
			/*ini kagak jadi percentage vili 7 januari 2015
            $paa=number_format(($nettaa*$data[Persen])/100, 2, '.', '');
            $pca=number_format(($nettca*$data[Persen])/100, 2, '.', '');
            $pcxa=number_format(($nettcxa*$data[Persen])/100, 2, '.', '');
            $pcna=number_format(($nettcna*$data[Persen])/100, 2, '.', '');
            $pab=number_format(($nettab*$data[Persen])/100, 2, '.', '');
            $pcb=number_format(($nettcb*$data[Persen])/100, 2, '.', '');
            $pcxb=number_format(($nettcxb*$data[Persen])/100, 2, '.', '');
            $pcnb=number_format(($nettcnb*$data[Persen])/100, 2, '.', '');
            $pac=number_format(($nettac*$data[Persen])/100, 2, '.', '');
            $pcc=number_format(($nettcc*$data[Persen])/100, 2, '.', '');
            $pcxc=number_format(($nettcxc*$data[Persen])/100, 2, '.', '');
            $pcnc=number_format(($nettcnc*$data[Persen])/100, 2, '.', '');
			
            }*/
			
            // itung selling
            $sellaa = number_format($nettaa + $paa + $data[DiscAdultA], 2, '.', '');
            $sellca = number_format($nettca + $pca + $data[DiscChdTwnA], 2, '.', '');
            $sellcxa = number_format($nettcxa + $pcxa + $data[DiscChdXbedA], 2, '.', '');
            $sellcna = number_format($nettcna + $pcna + $data[DiscChdNbedA], 2, '.', '');
            $sellab = number_format($nettab + $pab + $data[DiscAdultB], 2, '.', '');
            $sellcb = number_format($nettcb + $pcb + $data[DiscChdTwnB], 2, '.', '');
            $sellcxb = number_format($nettcxb + $pcxb + $data[DiscChdXbedB], 2, '.', '');
            $sellcnb = number_format($nettcnb + $pcnb + $data[DiscChdNbedB], 2, '.', '');
            $sellac = number_format($nettac + $pac + $data[DiscAdultC], 2, '.', '');
            $sellcc = number_format($nettcc + $pcc + $data[DiscChdTwnC], 2, '.', '');
            $sellcxc = number_format($nettcxc + $pcxc + $data[DiscChdXbedC], 2, '.', '');
            $sellcnc = number_format($nettcnc + $pcnc + $data[DiscChdNbedC], 2, '.', '');
            //disc
            $disaa=number_format($data[DiscAdultA], 2, '.', '');
            $disca = number_format($data[DiscChdTwnA], 2, '.', '');
            $discxa = number_format($data[DiscChdXbedA], 2, '.', '');
            $discna = number_format($data[DiscChdNbedA], 2, '.', '');
            $disab = number_format($data[DiscAdultB], 2, '.', '');
            $discb = number_format($data[DiscChdTwnB], 2, '.', '');
            $discxb = number_format($data[DiscChdXbedB], 2, '.', '');
            $discnb = number_format($data[DiscChdNbedB], 2, '.', '');
            $disac = number_format($data[DiscAdultC], 2, '.', '');
            $discc = number_format($data[DiscChdTwnC], 2, '.', '');
            $discxc = number_format($data[DiscChdXbedC], 2, '.', ''); 
            $discnc = number_format($data[DiscChdNbedC], 2, '.', '');  
            
            echo "<table><input type=hidden name='sumaa' value='$nettaa1'><input type=hidden name='sumca' value='$nettca1'><input type=hidden name='sumcxa' value='$nettcxa1'><input type=hidden name='sumcna' value='$nettcna1'>
            <input type=hidden name='sumab' value='$nettab1'><input type=hidden name='sumcb' value='$nettcb1'><input type=hidden name='sumcxb' value='$nettcxb1'><input type=hidden name='sumcnb' value='$nettcnb1'> 
            <input type=hidden name='sumac' value='$nettac1'><input type=hidden name='sumcc' value='$nettcc1'><input type=hidden name='sumcxc' value='$nettcxc1'><input type=hidden name='sumcnc' value='$nettcnc1'> 
                    <tr><th width=150></th><th width=78>ADULT</th><th width=78>CHILD TWN</th><th width=78>CHILD X BED</th><th width=78>CHILD NO BED</th><th width=78>ADULT</th><th width=78>CHILD TWN</th><th width=78>CHILD X BED</th><th width=78>CHILD NO BED</th><th width=78>ADULT</th><th width=78>CHILD TWN</th><th width=78>CHILD X BED</th><th width=78>CHILD NO BED</th></tr>
                     <tr><td width='150'>Total Variable Cost</td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvaradulta' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvarchdtwna' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvarchdxbeda' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvarchdnbeda' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvaradultb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvarchdtwnb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvarchdxbedb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvarchdnbedb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvaradultc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvarchdtwnc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvarchdxbedc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvarchdnbedc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     
                     <tr><td>Total Fix Cost</td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixadulta' value='$tfaa'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixchdtwna' value='$tfca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixchdxbeda' value='$tfca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixchdnbeda' value='$tfca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixadultb' value='$tfab'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixchdtwnb' value='$tfcb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixchdxbedb' value='$tfcb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixchdnbedb' value='$tfcb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixadultc' value='$tfac'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixchdtwnc' value='$tfcc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixchdxbedc' value='$tfcc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixchdnbedc' value='$tfcc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     
                     <tr><td>Total Agent Cost</td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentadulta' value='$taaa'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentchdtwna' value='$taca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentchdxbeda' value='$tacxa'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentchdnbeda' value='$tacna'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentadultb' value='$taab'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentchdtwnb' value='$tacb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentchdxbedb' value='$tacxb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentchdnbedb' value='$tacnb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentadultc' value='$taac'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentchdtwnc' value='$tacc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentchdxbedc' value='$tacxc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentchdnbedc' value='$tacnc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     
                     <tr><td>Agent Commision $comaa</td>
                     <td BGCOLOR='#f5bebe'><input type=text name='comaa' id='sadult' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly  value='$comaa'></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='comca' id='ssin' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$comca'></td></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='comcxa' id='schdtwn' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$comcxa'></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='comcna' id='schdtwn' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$comcna'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='comab' id='schdnbed' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$comab'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='comcb' id='schdxbed' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$comcb'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='comcxb' id='sinfant' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$comcxb'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='comcnb' id='sinfant' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$comcnb'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='comac' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$comac'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='comcc' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$comcc'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='comcxc' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$comcxc'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='comcnc' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$comcnc'></td></tr>
                     
                     <tr><td>Nett </td><td BGCOLOR='#f5bebe'><input type='text' name='nettaa' id='padult' value='$nettaa'  size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettaa<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='nettca' id='psingle' value='$nettca' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettca<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='nettcxa' id='pchdtwn' value='$nettcxa' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcxa<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='nettcna' id='pchdtwn' value='$nettcna' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcna<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='nettab' id='pchdnbed' value='$nettab' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettab<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='nettcb' id='pchdxbed' value='$nettcb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcb<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='nettcxb' id='pinfant' value='$nettcxb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcxb<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='nettcnb' id='pinfant' value='$nettcnb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcnb<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='nettac' id='pchdnbed' value='$nettac' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettac<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='nettcc' id='pchdxbed' value='$nettcc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcc<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='nettcxc' id='pinfant' value='$nettcxc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcxc<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='nettcnc' id='pinfant' value='$nettcnc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcnc<0){echo"background: red";}echo"' readonly></td></tr>
                     <tr><th colspan=13></th></tr>
                     
                     <tr><td>Profit Margin $data[Persen] %</td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='paa' size='8' value='$paa' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='pca' size='8' value='$pca' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='pcxa' size='8' value='$pcxa' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='pcna' size='8' value='$pcna' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='pab' size='8' value='$pab' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='pcb' size='8' value='$pcb' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='pcxb' size='8' value='$pcxb' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='pcnb' size='8' value='$pcnb' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='pac' size='8' value='$pac' style='background-color:#becaf5;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='pcc' size='8' value='$pcc' style='background-color:#becaf5;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='pcxc' size='8' value='$pcxc' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='pcnc' size='8' value='$pcnc' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     
                     <tr><td>Spare for Discount $disaa</td>
                     <td BGCOLOR='#f5bebe'><input type=text name='discaa' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$disaa'></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='discca' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$disca'></td></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='disccxa' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$discxa'></td>
                     <td BGCOLOR='#f5bebe'><input type=text name='disccna' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$discna'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='discab' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$disab'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='disccb' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$discb'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='disccxb' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$discxb'></td>
                     <td BGCOLOR='#bef5c6'><input type=text name='disccnb' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$discnb'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='discac' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$disac'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='disccc' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$discc'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='disccxc' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$discxc'></td>
                     <td BGCOLOR='#becaf5'><input type=text name='disccnc' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$discnc'></td></tr> 
                    
                     <tr><td>Selling Price</td><td BGCOLOR='#f5bebe'><input type='text' name='sellaa' value='$sellaa'  size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellaa<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='sellca' value='$sellca' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellca<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='sellcxa' value='$sellcxa' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcxa<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='sellcna' value='$sellcna' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcna<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='sellab' value='$sellab' size='6'  style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellab<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='sellcb' value='$sellcb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcb<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='sellcxb' value='$sellcxb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcxb<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='sellcnb' value='$sellcnb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcnb<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='sellac' value='$sellac' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellac<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='sellcc' value='$sellcc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcc<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='sellcxc' value='$sellcxc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcxc<0){echo"background: red";}echo"' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='sellcnc' value='$sellcnc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcnc<0){echo"background: red";}echo"' readonly></td></tr>
                     </table>";    
          if($r[GroupType]=='CRUISE'){
          echo"
          <table>
                    <tr><th></th><th>Recommended Selling Price in $r[SellingCurr]</th><th>ADULT (1-2 PAX)</th><th>ADULT (3-4 PAX)</th><th>CHILD (1-2 PAX)</th><th>Child (3-4 PAX)</th><th>Infant</th></tr>
                    <tr><th rowspan='2'>REGULAR</th><td>Cruise - Tour</td>
                         <td><input type=text name='cadl12' value='$r[CruiseAdl12]' size='12' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='cadl34' value='$r[CruiseAdl34]' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='cchd12' value='$r[CruiseChd12]' size='12'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='cchd34' value='$r[CruiseChd34]' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rsinfant' value='$r[SellingInfant]' size='10' onkeyup='isNumber(this)' required></td></tr>
                    <tr><td>Cruise - Land Only</td>
                         <td><input type=text name='cladl12' value='$r[CruiseLoAdl12]' size='12' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='cladl34' value='$r[CruiseLoAdl34]' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='clchd12' value='$r[CruiseLoChd12]' size='12'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='clchd34' value='$r[CruiseLoChd34]' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lainfant' value='$r[LAInfant]' size='10' onkeyup='isNumber(this)' required></td></tr>

                    <tr><th rowspan='2' style='background-color:#f58232;'>INTERNAL</th><td>Cruise - Tour</td>
                         <td><input type=text name='cadl12in' value='$pricein[CruiseAdl12]' style='background-color:#f58232;' size='12' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='cadl34in' value='$pricein[CruiseAdl34]' style='background-color:#f58232;' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='cchd12in' value='$pricein[CruiseChd12]' style='background-color:#f58232;' size='12'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='cchd34in' value='$pricein[CruiseChd34]' style='background-color:#f58232;' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rsinfantin' value='$pricein[SellingInfant]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td></tr>
                    <tr><td>Cruise - Land Only</td>
                         <td><input type=text name='cladl12in' value='$pricein[CruiseLoAdl12]' style='background-color:#f58232;' size='12' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='cladl34in' value='$pricein[CruiseLoAdl34]' style='background-color:#f58232;' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='clchd12in' value='$pricein[CruiseLoChd12]' style='background-color:#f58232;' size='12'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='clchd34in' value='$pricein[CruiseLoChd34]' style='background-color:#f58232;' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lainfantin' value='$pricein[LAInfant]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td></tr>

                    <tr><th rowspan='2' style='background-color:red;'>PANORAMA WORLD</th><td>Cruise - Tour</td>
                         <td><input type=text name='cadl12pw' value='$pricepw[CruiseAdl12]' style='background-color:red;' size='12' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='cadl34pw' value='$pricepw[CruiseAdl34]' style='background-color:red;' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='cchd12pw' value='$pricepw[CruiseChd12]' style='background-color:red;' size='12'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='cchd34pw' value='$pricepw[CruiseChd34]' style='background-color:red;' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rsinfantpw' value='$pricepw[SellingInfant]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td></tr>
                    <tr><td>Cruise - Land Only</td>
                         <td><input type=text name='cladl12pw' value='$pricepw[CruiseLoAdl12]' style='background-color:red;' size='12' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='cladl34pw' value='$pricepw[CruiseLoAdl34]' style='background-color:red;' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='clchd12pw' value='$pricepw[CruiseLoChd12]' style='background-color:red;' size='12'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='clchd34pw' value='$pricepw[CruiseLoChd34]' style='background-color:red;' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lainfantpw' value='$pricepw[LAInfant]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td></tr>

                    <tr><th rowspan='2' style='background-color:blue;'>SISTER COMPANY</th><td>Cruise - Tour</td>
                         <td><input type=text name='cadl12sc' value='$pricesc[CruiseAdl12]' style='background-color:blue;color:white;' size='12' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='cadl34sc' value='$pricesc[CruiseAdl34]' style='background-color:blue;color:white;' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='cchd12sc' value='$pricesc[CruiseChd12]' style='background-color:blue;color:white;' size='12'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='cchd34sc' value='$pricesc[CruiseChd34]' style='background-color:blue;color:white;' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rsinfantsc' value='$pricesc[SellingInfant]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td></tr>
                    <tr><td>Cruise - Land Only</td>
                         <td><input type=text name='cladl12sc' value='$pricesc[CruiseLoAdl12]' style='background-color:blue;color:white;' size='12' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='cladl34sc' value='$pricesc[CruiseLoAdl34]' style='background-color:blue;color:white;' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='clchd12sc' value='$pricesc[CruiseLoChd12]' style='background-color:blue;color:white;' size='12'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='clchd34sc' value='$pricesc[CruiseLoChd34]' style='background-color:blue;color:white;' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lainfantsc' value='$pricesc[LAInfant]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td></tr>

                    <tr><th rowspan='2' style='background-color:green;'>SUB AGENT</th><td>Cruise - Tour</td>
                         <td><input type=text name='cadl12sa' value='$pricesa[CruiseAdl12]' style='background-color:green;' size='12' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='cadl34sa' value='$pricesa[CruiseAdl34]' style='background-color:green;' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='cchd12sa' value='$pricesa[CruiseChd12]' style='background-color:green;' size='12'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='cchd34sa' value='$pricesa[CruiseChd34]' style='background-color:green;' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rsinfantsa' value='$pricesa[SellingInfant]' style='background-color:green;' size='10' onkeyup='isNumber(this)' required></td></tr>
                    <tr><td>Cruise - Land Only</td>
                         <td><input type=text name='cladl12sa' value='$pricesa[CruiseLoAdl12]' style='background-color:green;' size='12' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='cladl34sa' value='$pricesa[CruiseLoAdl34]' style='background-color:green;' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='clchd12sa' value='$pricesa[CruiseLoChd12]' style='background-color:green;' size='12'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='clchd34sa' value='$pricesa[CruiseLoChd34]' style='background-color:green;' size='12' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lainfantsa' value='$pricesa[LAInfant]' style='background-color:green;' size='10' onkeyup='isNumber(this)' required></td></tr>

          </table>";
          }else{
              echo"
          <table>
                    <tr><th></th><th>Recommended Selling Price in $r[SellingCurr]</th><th>ADULT</th><th>CHILD TWN</th><th>CHILD X BED</th><th>Child No bed</th><th>Infant</th></tr>
                    <tr><th rowspan='2'>REGULAR</th><td>Tour</td><td><input type=text name='rsadult' value='$r[SellingAdlTwn]' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='rschdtwn' value='$r[SellingChdTwn]' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdxbed' value='$r[SellingChdXbed]' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdnbed' value='$r[SellingChdNbed]' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rsinfant' value='$r[SellingInfant]' size='10' onkeyup='isNumber(this)' required></td></tr>
                    <tr><td>Land Arrangement Only</td><td><input type=text name='laadltwn' value='$r[LAAdlTwn]' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='lachdtwn' value='$r[LAChdTwn]' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdxbed' value='$r[LAChdXbed]' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdnbed' value='$r[LAChdNbed]' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lainfant' value='$r[LAInfant]' size='10' onkeyup='isNumber(this)' required></td></tr>

                    <tr><th rowspan='2' style='background-color:#f58232;'>INTERNAL</th><td>Tour</td><td><input type=text name='rsadultin' value='$pricein[SellingAdlTwn]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='rschdtwnin' value='$pricein[SellingChdTwn]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdxbedin' value='$pricein[SellingChdXbed]' style='background-color:#f58232;' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdnbedin' value='$pricein[SellingChdNbed]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rsinfantin' value='$pricein[SellingInfant]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td></tr>
                    <tr><td>Land Arrangement Only</td><td><input type=text name='laadltwnin' value='$pricein[LAAdlTwn]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='lachdtwnin' value='$pricein[LAChdTwn]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdxbedin' value='$pricein[LAChdXbed]' style='background-color:#f58232;' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdnbedin' value='$pricein[LAChdNbed]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lainfantin' value='$pricein[LAInfant]' style='background-color:#f58232;' size='10' onkeyup='isNumber(this)' required></td></tr>

                    <tr><th rowspan='2' style='background-color:red;'>PANORAMA WORLD</th><td>Tour</td><td><input type=text name='rsadultpw' value='$pricepw[SellingAdlTwn]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='rschdtwnpw' value='$pricepw[SellingChdTwn]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdxbedpw' value='$pricepw[SellingChdXbed]' style='background-color:red;' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdnbedpw' value='$pricepw[SellingChdNbed]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rsinfantpw' value='$pricepw[SellingInfant]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td></tr>
                    <tr><td>Land Arrangement Only</td><td><input type=text name='laadltwnpw' value='$pricepw[LAAdlTwn]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='lachdtwnpw' value='$pricepw[LAChdTwn]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdxbedpw' value='$pricepw[LAChdXbed]' style='background-color:red;' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdnbedpw' value='$pricepw[LAChdNbed]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lainfantpw' value='$pricepw[LAInfant]' style='background-color:red;' size='10' onkeyup='isNumber(this)' required></td></tr>

                    <tr><th rowspan='2' style='background-color:blue;'>SISTER COMPANY</th><td>Tour</td><td><input type=text name='rsadultsc' value='$pricesc[SellingAdlTwn]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='rschdtwnsc' value='$pricesc[SellingChdTwn]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdxbedsc' value='$pricesc[SellingChdXbed]' style='background-color:blue;color:white;' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdnbedsc' value='$pricesc[SellingChdNbed]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rsinfantsc' value='$pricesc[SellingInfant]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td></tr>
                    <tr><td>Land Arrangement Only</td><td><input type=text name='laadltwnsc' value='$pricesc[LAAdlTwn]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='lachdtwnsc' value='$pricesc[LAChdTwn]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdxbedsc' value='$pricesc[LAChdXbed]' style='background-color:blue;color:white;' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdnbedsc' value='$pricesc[LAChdNbed]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lainfantsc' value='$pricesc[LAInfant]' style='background-color:blue;color:white;' size='10' onkeyup='isNumber(this)' required></td></tr>

                    <tr><th rowspan='2' style='background-color:green;'>SUB AGENT</th><td>Tour</td><td><input type=text name='rsadultsa' value='$pricesa[SellingAdlTwn]' style='background-color:green;' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='rschdtwnsa' value='$pricesa[SellingChdTwn]' style='background-color:green;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdxbedsa' value='$pricesa[SellingChdXbed]' style='background-color:green;' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rschdnbedsa' value='$pricesa[SellingChdNbed]' style='background-color:green;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='rsinfantsa' value='$pricesa[SellingInfant]' style='background-color:green;' size='10' onkeyup='isNumber(this)' required></td></tr>
                    <tr><td>Land Arrangement Only</td><td><input type=text name='laadltwnsa' value='$pricesa[LAAdlTwn]' style='background-color:green;' size='10' onkeyup='isNumber(this)' required></td></td>
                         <td><input type=text name='lachdtwnsa' value='$pricesa[LAChdTwn]' style='background-color:green;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdxbedsa' value='$pricesa[LAChdXbed]' style='background-color:green;' size='10'onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lachdnbedsa' value='$pricesa[LAChdNbed]' style='background-color:green;' size='10' onkeyup='isNumber(this)' required></td>
                         <td><input type=text name='lainfantsa' value='$pricesa[LAInfant]' style='background-color:green;' size='10' onkeyup='isNumber(this)' required></td></tr>

          </table>";
          }
          echo"
          <table>
          <tr><th>Description</th><th>Curr</th><th>Nett</th><th>selling</th></tr>
          <tr><td>Airport Tax & Flight Insurance</td> <td>$r[SellingCurr]</td><td> <input type=text name='taxinsnett' size='12' value='$r[TaxInsNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='taxinssell' size='12' value='$r[TaxInsSell]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Single Supplement</td> <td>$r[SellingCurr]</td><td> <input type=text name='singlenett' size='12' value='$r[SingleNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='singlesell' size='12' value='$r[SingleSell]'onkeyup='isNumber(this)'></td></tr> 
          <tr><td>Visa </td><td><select name='visacurr' ";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo">";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($r[VisaCurr]==''){$r[VisaCurr]='IDR';}
            while($s=mysql_fetch_array($tampil)){
                  if($s[curr]==$r[VisaCurr]){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                     echo "<option value='$s[curr]'>$s[curr]</option>";   
                    }         
            }
    echo "</select></td><td> <input type=text name='visanett' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaNett]'onkeyup='isNumber(this)'></td><td><input type=text name='visasell' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaSell]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Visa 2</td><td><select name='visacurr2' ";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo">";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($r[VisaCurr2]==''){$r[VisaCurr2]='USD';}
            while($s=mysql_fetch_array($tampil)){
                  if($s[curr]==$r[VisaCurr2]){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                     echo "<option value='$s[curr]'>$s[curr]</option>";   
                    }         
            }
    echo "</select></td><td> <input type=text name='visanett2' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaNett2]'onkeyup='isNumber(this)'></td><td><input type=text name='visasell2' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaSell2]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Domestic Airport Tax</td><td><select name='airtaxcurr' >";
          $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
          if($r[AirTaxCurr]==''){$r[AirTaxCurr]='IDR';}
          while($s=mysql_fetch_array($tampil)){
                 if($s[curr]==$r[AirTaxCurr]){
                 echo "<option value='$s[curr]' selected>$s[curr]</option>";
                } else {
                 echo "<option value='$s[curr]'>$s[curr]</option>";
                }

          }
          if($r[AirTaxNett]==0){$airtaxnet='150000';}  
    echo "</select></td><td> <input type=text name='airtaxnett' size='12' value='$r[AirTaxNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='airtaxsell' size='12' value='$r[AirTaxSell]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Sea Tax</td><td>$r[SellingCurr]</td><td> <input type=text name='seataxnett' size='12' value='$r[SeaTaxNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='seataxsell' size='12' value='$r[SeaTaxSell]'onkeyup='isNumber(this)'></td></tr>
          </table><center>
          <form method=POST name='quotation' action='./aksi.php?module=showquotation&act=update'>
          <input type=hidden name=id value='$r[IDProduct]'>";
    if($ltmauthority=='LEISURE ADMINISTRATOR' or $EmpOff=='IFM'){
          if($r[QuotationStatus]=='APPROVE'){
                  echo"
                  <input type='radio' name='quostatus' value='APPROVE' checked>NO ACTION
                  <input type='radio' name='quostatus' value='DRAFT'>NEED REVISE
                  <br><br>
                  <input type='submit' name='submit' value='SAVE'>
                  <input type=button value=CLOSE onclick=self.history.back()>";

          }else if($r[QuotationStatus]=='REQUEST' OR $r[QuotationStatus]=='EDIT'){
                  echo"
                  <input type='radio' name='quostatus' value='APPROVE'";if($r[QuotationStatus]=='APPROVE' OR $r[QuotationStatus]=='REQUEST')
				  {echo"checked";}echo">APPROVE
                  <input type='radio' name='quostatus' value='DRAFT'";if($r[QuotationStatus]=='EDIT'){echo"checked";}echo">REVISE
                  <br><br>
                  <input type='submit' name='submit' value='SAVE'>
                  <input type=button value=CLOSE onclick=self.history.back()>";
              }else{
              echo "<br><br>
              <input type=button value=Close onclick=self.history.back()>";
              }
          }else{
    echo "<br><br>
          <input type=button value=Close onclick=self.history.back()>";
          }
    echo "</form>";
     break;
     
case "deletedetail":
    $editpertama=mysql_query("UPDATE tour_msproduct set SeatDeposit='0',SeatSisa=Seat,Status='VOID' WHERE IDProduct = '$_GET[id]'");
     //----   voiud bookingan
     $mulai=mysql_query("SELECT * FROM tour_msbooking WHERE IDTourcode = '$_GET[id]'");
     $deteksi=mysql_num_rows($mulai);
     if($deteksi>0){
     while($autovoid=mysql_fetch_array($mulai)){ 
     $updets=mysql_query("UPDATE tour_msbooking set Status='VOID',ReasonCancel='PRODUCT VOID',CancelBy='System',CancelDate='$today' WHERE BookingID = '$autovoid[BookingID]'");
    $edit=mysql_query("UPDATE tour_msbookingdetail set Status = 'CANCEL',
                                                        Price='0',
                                                        AddCharge='0',
                                                        SubTotal='0' 
                                                        WHERE BookingID = '$autovoid[BookingID]'");
    
    $edit1=mysql_query("SELECT count(IDDetail)as tota,BookingID,TourCode FROM tour_msbookingdetail WHERE BookingID ='$autovoid[BookingID]' and Status <> 'CANCEL' and Gender <>'INFANT' GROUP BY BookingID");  
    $r2=mysql_fetch_array($edit1);
    $upbook1=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$autovoid[BookingID]'");  
    $upbook=mysql_fetch_array($upbook1);
    if($upbook[SFID]<>''){
    $editptes=mssql_query("UPDATE dbo.SalesFolderDetails set StatusLTM = 'CANCEL'
                                                        WHERE ConfirmationNo = '$r2[BookingID]' ");   
    }                
    $Description="Cancel Booking $r2[BookingID]";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('System', 
                                   '$Description', 
                                   '$today')");
    $ceking=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$autovoid[BookingID]'");  
    $cek=mysql_fetch_array($ceking);
    $autocek=mysql_query("UPDATE tour_msbooking set Duplicate='NO' WHERE DepositNo = '$cek[DepositNo]' and Duplicate='YES' order by IDBookers ASC limit 1");
     //update PTES
         $nocsr=substr($autovoid[DepositNo],0,3);
         //if(($offgroup =='PANORAMA TOURS' AND !preg_match('/LTM/',$EmpOff)) OR $offgroup <> 'PANORAMA WORLD' OR $offgroup <> 'SISTER COMPANY'){
         if($nocsr=='CSR'){
         $cekduplicate=mysql_query("SELECT * FROM tour_msbooking WHERE DepositNo = '$cek[DepositNo]' and Status = 'ACTIVE' limit 1");
         $jumlahduplicate=mysql_num_rows($cekduplicate);
         $hasilduplicate=mysql_fetch_array($cekduplicate);
         if($jumlahduplicate>0){
             mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = '$hasilduplicate[BookingID]'
                                            WHERE [CashReceiptId] = '$cek[DepositNo]'");
         }else if($jumlahduplicate==0){
             mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = NULL
                                            WHERE [CashReceiptId] = '$cek[DepositNo]'");
         }
     }

     }
     }
    $cari1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]' ");  
    $ulang=mysql_fetch_array($cari1);      
    $updet=mysql_query("UPDATE tour_msproduct set SeatDeposit = '0',
                                                        SeatSisa='$ulang[Seat]'
                                                        WHERE IDProduct = '$ulang[IDProduct]'");
     //---

     $Description="VOID Product $_GET[id]";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproduct'>";   
     break;
 
case "prodflight":
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $id=$_GET[id];
    $tgldep=substr($r[DateTravelFrom],8,2);
    $blndep=substr($r[DateTravelFrom],5,2);
    $kota=$_GET['kota'];       
    $tanggal=$_GET['tanggal'];     
    $pesawat=$_GET['pesawat'];
    $grvid=$_GET['idgrv'];
    echo "<h2>Flight Schedule $r[TourCode]</h2>";
          $mencari=mysql_query("SELECT * FROM tour_msproductpnr inner join tour_msgrv on tour_msgrv.IDGrv = tour_msproductpnr.GrvID WHERE PnrProd ='$id' order by PnrID ASC");
          $adakah=mysql_num_rows($mencari);
          if($adakah<1){
              echo"<i><font color='red'>** PNR HAS NOT BEEN SELECTED **</font></i>";
          }else{echo"
              <table><tr><th>No</th><th>PNR NO</th><th>Flight No</th><th>Date</th><th>Dep</th><th>Arr</th><th>ETD</th><th>ETA</th><th>cross</th><th>Note</th><th>action</th><tr>";
              $r=1;
              while($tunjukan=mysql_fetch_array($mencari)){
                $resq=mysql_query("SELECT * FROM tour_msprodflight where IDGrv ='$tunjukan[GrvID]' order by FID ASC ");
                $hasq=mysql_fetch_array($resq);     
                $D = date('d M Y', strtotime($hasq[AirDate]));
                $grvpnr=str_replace(" ", "_", $tunjukan[GrvPnr]);
                echo"<tr><td>$r</td><td>$tunjukan[GrvPnr]</td>
                <td>$hasq[AirCode]</td>
                  <td>$D</td>
                  <td><center>$hasq[AirRouteDep]</td>
                  <td><center>$hasq[AirRouteArr]</td>
                  <td>$hasq[AirTimeDep]</td>
                  <td>$hasq[AirTimeArr]</td>
                  <td><center>$hasq[AirCross]</td>
                  <td>$hasq[Note]</td>
                <td><input type='button' value='DELETE' onclick=hapuspnr('$grvpnr','$tunjukan[PnrID]')></td></tr>";
                $r++;    
              }echo"</table>";
          }
    echo "<h2>Add PNR</h2>
          <form name='flight' method='get' action='media.php?'><input type=hidden name=module value='msproduct'> 
          <input type=hidden name='act' value='prodflight'><input type=hidden name='id' value='$id'>
          <table style='border:0px;solid #000000;'>
          <tr><th width='75'>Airlines</th><th width='100'>Dep from</th><th width='100'>Dep Date</th><th width='150'>PNR No</th><th></th></tr>
          <tr><td><center><select name='pesawat' id='pesawat' onChange='showCity()'>
          <option value='0'>- select -</option>";    
            $tampil=mysql_query("SELECT * FROM tour_msgrv where GrvStatus <> 'VOID' Group by GrvAirlines ORDER BY GrvAirlines ASC");
            while($s=mysql_fetch_array($tampil)){                                 
                if($s[GrvAirlines]==$pesawat){
                    echo "<option value='$s[GrvAirlines]' selected>$s[GrvAirlines]</option>";    
                }else{    
                    echo "<option value='$s[GrvAirlines]'>$s[GrvAirlines]</option>"; 
                } 
            }
    echo "</select></td>
          <td><center><select name='kota' id='kota' onChange='showDate()'>
          <option value='0'>- select -</option>";    
            $tampil=mysql_query("SELECT * FROM tour_msgrv where GrvStatus <> 'VOID' and GrvAirlines = '$pesawat' Group by GrvCityOfDep ORDER BY GrvCityOfDep ASC");
            while($s=mysql_fetch_array($tampil)){                                 
                if($s[GrvCityOfDep]==$kota){
                    echo "<option value='$s[GrvCityOfDep]' selected>$s[GrvCityOfDep]</option>";    
                }else{    
                    echo "<option value='$s[GrvCityOfDep]'>$s[GrvCityOfDep]</option>"; 
                } 
            }
    echo "</select></td>
          <td><center><select name='tanggal' id='tanggal' onChange='showPNR()'>
          <option value='0'>- select -</option>";    
            $tampil=mysql_query("SELECT * FROM tour_msgrv where GrvStatus <> 'VOID' and GrvAirlines = '$pesawat' AND GrvCityOfDep = '$kota' Group by GrvDateOfDep ORDER BY GrvDateOfDep ASC");
            while($s=mysql_fetch_array($tampil)){                                 
                $DT = date('d M Y', strtotime($s[GrvDateOfDep]));
                if($s[GrvDateOfDep]==$tanggal){
                    echo "<option value='$s[GrvDateOfDep]' selected>$DT</option>";    
                }else{    
                    echo "<option value='$s[GrvDateOfDep]'>$DT</option>"; 
                } 
            }
    echo "</select></td>
          <td><center><select name='idgrv' id='idgrv'>
          <option value='0'>- select -</option>";    
            $tampil=mysql_query("SELECT * FROM tour_msgrv where GrvStatus <> 'VOID' and GrvAirlines = '$pesawat' AND GrvCityOfDep = '$kota' AND GrvDateOfDep = '$tanggal' Group by GrvPnr ORDER BY GrvPnr ASC");
            while($s=mysql_fetch_array($tampil)){                                 
                if($s[IDGrv]==$grvid){
                    echo "<option value='$s[IDGrv]' selected>$s[GrvPnr] ($s[GrvArea])</option>";    
                }else{    
                    echo "<option value='$s[IDGrv]'>$s[GrvPnr] ($s[GrvArea])</option>"; 
                } 
            }
    echo "</select></td>
          <td><center><input type=submit name='submit' size='20'value='View'></td></tr>
          </table>
          </form>
          <form method='POST' name='example' action=./aksi.php?module=prodflight&act=update>
          <input type='hidden' name='id' value='$_GET[id]'><input type='hidden' name='grvid' value='$grvid'>
          <input type='hidden' name='pnrcountry' value='$depcountry'><input type='hidden' name='pnrcity' value='$depcity'>";  
          if($grvid<>'' AND $grvid<>'0'){$b='enabled';echo"
          Flight Detail
          <table id='air' border='1'>
          <tr><th>Flight No</th><th>Date</th><th>Dep</th><th>Arr</th><th>ETD</th><th>ETA</th><th>cross</th><th>Note</th></tr>";   
           $i=0;
           $coba=mysql_query("SELECT * FROM tour_msprodflight where IDGrv ='$grvid' order by FID ASC ");
            $baris=mysql_num_rows($coba);     
            while($tes=mysql_fetch_array($coba)){     
                $D = date('d M Y', strtotime($tes[AirDate])); 
                echo"<tr>
                  <td>$tes[AirCode]</td>
                  <td>$D</td>
                  <td><center>$tes[AirRouteDep]</td>
                  <td><center>$tes[AirRouteArr]</td>
                  <td>$tes[AirTimeDep]</td>
                  <td>$tes[AirTimeArr]</td>
                  <td><center>$tes[AirCross]</td>
                  <td>$tes[Note]</td></tr>";$i++;}echo"
          </table>";
          }else{$b='disabled';}   
    echo"
          <center><input type=submit value='ADD' $b>
                            <input type=button value=Cancel onclick=location.href='?module=msproduct'>
          </form>";
    break; 
    
case "lockprice":
    $edit=mysql_query("UPDATE tour_msbooking SET StatusPrice = 'LOCK' WHERE IDTourCode ='$_GET[id]' AND (TotalPrice <> '' OR TotalPrice > '0.00') AND Status='ACTIVE'");
     $Description="Lock price for $_GET[id] ($_GET[yr])";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproduct'>";   
     break;
     
case "reqmsproduct":
            $thisyear = date("Y");
            $nextyear = $thisyear+1;
            $tmrno=$_GET[no];
            $tmrq=mysql_query("SELECT * FROM tour_mstmrreq WHERE IDTmr = '$tmrno'");
            $tmrr=mysql_fetch_array($tmrq);
            
    echo "<h2>TMR Product</h2>
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msproducttmr&act=input' enctype='multipart/form-data'>
          <input type='hidden' name='tmrno' value='$tmrno'>
          <table>
          <tr><td>Season</td> <td>  
            <select name='season'>
            <option value='0' selected>- Select Season -</option>";
            if(isset($_POST['redirected'])) { $seasonb=$_POST['season']; }  
            $tampil=mysql_query("SELECT * FROM tour_msseason where SeasonStatus='ACTIVE' ORDER BY SeasonName");
            while($r=mysql_fetch_array($tampil)){
                if($seasonb==$r[SeasonName]){
                    echo "<option value='$r[SeasonName]' selected>$r[SeasonName]</option>";     
                }else{
                    echo "<option value='$r[SeasonName]'>$r[SeasonName]</option>"; 
                }
                
            }
    echo "</select>
            <select name='year' id='year'>
            <option value='$thisyear' selected>$thisyear</option>
            <option value='$nextyear' >$nextyear</option>
            </select></td></tr>";
            if($tmrno<>''){$producttypeb='TAILOR MADE REQUEST';echo"
            <input type='hidden' name='producttype' value='TAILOR MADE REQUEST'>";
            }else{echo"
            <tr><td>Product Type</td> <td>
            <select name='producttype'>
            <option value='0' selected>- Select Type -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msproducttype where ProducttypeName <>'' ORDER BY ProducttypeName ASC");
            if(isset($_POST['redirected'])) { $producttypeb=$_POST['producttype']; }
            
            while($r=mysql_fetch_array($tampil)){
                if($producttypeb==$r[ProducttypeName]){
                    echo "<option value='$r[ProducttypeName]' selected>$r[ProducttypeName]</option>";    
                }else{
                    echo "<option value='$r[ProducttypeName]'>$r[ProducttypeName]</option>";
                }
                
            }
    echo "</select></td></tr>";}
    echo " <tr><td>Handle by</td>     <td>";   
            if(isset($_POST['redirected'])) { $departmentb=$_POST['department']; }
            if($tmrno<>''){$departmentb=$tmrr[Department];}
            if($departmentb=='MINISTRY'){$b='checked';}else{$a='checked';}
    echo "<input type=radio name='department' value='LEISURE' $a>&nbsp;Leisure
            <input type=radio name='department' value='MINISTRY' $b>&nbsp;Ministry  
            </td></tr>
            <tr><td>Group Type</td> <td>";  
            if($tmrno<>''){$grouptypeb='TMR';echo"
            <input type='hidden' name='grouptype' value='TMR'>$grouptypeb";}
            else{echo"
            <select name='grouptype'>
            <option value='0' selected>- Select Type -</option>";
            if(isset($_POST['redirected'])) { $grouptypeb=$_POST['grouptype']; }
            
            $tampil=mysql_query("SELECT * FROM tour_msgroup where Status = 'ACTIVE' ORDER BY GroupName");
            while($r=mysql_fetch_array($tampil)){
                if($grouptypeb==$r[GroupName]){
                    echo "<option value='$r[GroupName]' selected>$r[GroupName]</option>";    
                }else{
                    echo "<option value='$r[GroupName]'>$r[GroupName]</option>";
                }
                
            }
    echo "</select>";}
    echo "</td></tr>
          <tr><td>BSO Handler</td>  <td>";  
          if($tmrno<>''){$prodforb=$tmrr[ProductFor];echo"
          <input type='hidden' name='productfor' value='$prodforb'>$prodforb";}
          else{echo"
          <select name='productfor'>
            <option value='ALL' selected>- ALL -</option>";
            
            $tampil=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name");
            while($r=mysql_fetch_array($tampil)){
                if($prodforb==$r[office_code]){
                    echo "<option value='$r[office_code]' selected>$r[office_code]</option>";    
                }else{
                    echo "<option value='$r[office_code]'>$r[office_code]</option>";    
                }         
            }    
    echo "</select>";}
    echo "</td></tr>
          <tr><td>Product Code/Name</td> <td>  <select name='productcode' onChange='turcode()'>
            <option value='0' selected>- Select Product -</option>";
            $pcn = "TMR$tmrr[TmrNo].$tmrr[TmrOption]";
            
            $tampil=mysql_query("SELECT * FROM tour_msproductcodereq where ProductcodeName = '$pcn' ORDER BY ProductcodeName");
            if(isset($_POST['redirected'])) { $productcodeb=$_POST['productcode']; }
            while($r=mysql_fetch_array($tampil)){
                if($productcodeb==$r[ProductcodeName]){
                    echo "<option value='$r[ProductcodeName]' selected>$r[ProductcodeName] - $r[Productcode]</option>";    
                }else{
                    echo "<option value='$r[ProductcodeName]'>$r[ProductcodeName] - $r[Productcode]</option>";
                }
                
            }
    echo "</select></td></tr>    
            <tr><td>Date of Service</td> <td>From <input type='text' value='";if(isset($_POST['redirected'])) { echo $_POST['datetravelfrom']; }else if($tmrno<>''){echo $tmrr[DateTravelFrom];} echo"'  name='datetravelfrom' size='10' onfocus='selisih()' onClick="."cal.select(document.forms['example'].datetravelfrom,'ActIn1','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(yyyy-mm-dd)</font>
          - To <input type=text value='";if(isset($_POST['redirected'])) { echo $_POST['datetravelto']; }else if($tmrno<>''){echo $tmrr[DateTravelTo];} echo"' name='datetravelto' size='10' onfocus='selisih()' onClick="."cal.select(document.forms['example'].datetravelto,'anchor2','yyyy-MM-dd'); return false;"." NAME='anchor2' ID='anchor2'>
           <font color='red'>(yyyy-mm-dd)</font></td></tr>
           <tr><td>Number of Days</td> <td><input type=text name='daystravel' id='daystravel' value='";if(isset($_POST['redirected'])) { echo $_POST['daystravel']; }else if($tmrno<>''){echo $tmrr[DaysTravel];} echo"' size='3'> days</td></tr>   
          <tr><td>Flight</td> <td>  <select name='flight' onChange='turcode()'>
            <option value='0' selected>- Select Airlines -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msairlines where AirlinesStatus='ACTIVE' ORDER BY AirlinesID");
            if(isset($_POST['redirected'])) { $flightb=$_POST['flight']; }
            while($r=mysql_fetch_array($tampil)){
                if($flightb==$r[AirlinesID]){
                    echo "<option value='$r[AirlinesID]' selected>$r[AirlinesID] - $r[AirlinesName]</option>";    
                }else{
                    echo "<option value='$r[AirlinesID]'>$r[AirlinesID] - $r[AirlinesName]</option>";
                }
                
            }
    echo "</select></td></tr>
          <tr><td>Tour Code</td> <td><input type=text size='50' name='tourcode' id='tourcode' value='"; if(isset($_POST['redirected'])) { echo $_POST['tourcode']; } echo"' onBlur='cektur()'><div  id='status'></div></td></tr> 
          <tr><td>Seat</td> <td><input type=text value='"; if(isset($_POST['redirected'])) { echo $_POST['seat']; }else if($tmrno<>''){$tmrseat=$tmrr[Seat]+$tmrr[SeatChild];echo $tmrseat;}  echo"' name='seat' size='3' onkeyup='isNumber(this)'> Pax <font color='red'>*<i>Not Include Infant and Tour leader</i></font></td></tr>
          <tr><td>Tour Leader</td> <td>";   
          if(isset($_POST['redirected'])) { $tourleaderincb=$_POST['tourleaderinc']; }
          if($tourleaderincb=='NO'){$b='checked';}else{$a='checked';}
    echo "<input type=radio name='tourleaderinc' value='YES' $a>&nbsp;Yes
          <input type=radio name='tourleaderinc' value='NO' $b>&nbsp;No  
          </td></tr>
          <tr><td>Insurance</td> <td>";   
          if(isset($_POST['redirected'])) { $insuranceb=$_POST['insurance']; }
          if($insuranceb=='INCLUDE'){$a='checked';}else{$b='checked';}
    echo "<input type=radio name='insurance' value='INCLUDE' $a>&nbsp;Include
          <input type=radio name='insurance' value='NOT INCLUDE' $b>&nbsp;Not Include  
          </td></tr>
          <tr><td>Visa</td> <td>   
          <input type=radio name='visa' value='INCLUDE' onclick='onemb()'>&nbsp;Include
          <input type=radio name='visa' value='NOT INCLUDE' onclick='onemb()'>&nbsp;Not Include
          <input type=radio name='visa' value='NO REQUIRED' onclick='offemb()' checked>&nbsp;No Required        
          </td></tr>
          <tr><td></td><td><select name='embassy01' disabled>
            <option value='0' selected>- Embassy 01 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[CountryID]'>$r[Country]</option>";
            }
    echo "</select>&nbsp&nbsp <select name='embassy03' disabled >
            <option value='0' selected>- Embassy 03 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[CountryID]'>$r[Country]</option>";
            }
    echo "</select>&nbsp&nbsp <select name='embassy05' disabled >
            <option value='0' selected>- Embassy 05 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[CountryID]'>$r[Country]</option>";
            }
    echo "</select></td></tr>
          <tr><td></td><td><select name='embassy02' disabled >
            <option value='0' selected>- Embassy 02 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[CountryID]'>$r[Country]</option>";
            }
    echo "</select>&nbsp&nbsp <select name='embassy04' disabled >
            <option value='0' selected>- Embassy 04 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[CountryID]'>$r[Country]</option>";
            }
    echo "</select></td></tr>
            <tr><td>Quotation </td><td> Currency <select name='quotationcurr' onchange='oncurr()'>";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            while($s=mysql_fetch_array($tampil)){
                if($s[curr]=='USD'){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";    
                } else {
                     echo "<option value='$s[curr]' >$s[curr]</option>";
                }
            }
    echo "</select></td></tr> 
            <tr><td>Selling </td><td>Currency <select name='sellingcurr' onchange='oncurr()'>
                     <option value='USD' selected>USD</option>   
                     <option value='IDR' >IDR</option>
          </select>&nbsp Operator <select name='sellingoperator'>
                                <option value='*'> X </option>
                                <option value='/' > : </option></select>&nbsp Rate <input type='text' name='sellingrate' size='3' value='1' onkeyup='isNumber(this)' disabled></td></tr>     
            <tr><td>Attachment</td><td><input type='file' name='upload'>  </td></tr>
            <tr><td>Remarks</td><td><textarea name='remarks' cols='50' rows='3'>"; if(isset($_POST['redirected'])) { echo $_POST['remarks']; } echo"</textarea>  </td></tr>
             <input type='hidden' name='status' value='NOT PUBLISHED'>  
          <tr><td colspan=2><center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table> </form><br><br>";
     break;
     
case "quotationtmr":
    $tmrid=$_GET[no];
    $totquo=$_GET[q];      
    $caridata=mysql_query("SELECT * FROM tour_mstmrreq WHERE IDTmr = '$tmrid'");
    $datatmr=mysql_fetch_array($caridata);
    $barukah=mysql_num_rows($caridata);  
    $seat=$datatmr[Seat]+$datatmr[SeatChild];
    $baca=mysql_query("SELECT * FROM tour_msproductreq WHERE TmrNo = '$tmrid'");
    $bacakan=mysql_num_rows($baca);
    if($totquo<>$bacakan){
    mysql_query("INSERT INTO tour_msproductreq( Season,
                        Year,
                        ProductType,
                        Department,
                        GroupType,
                        ProductFor,    
                        ProductCode,
                        Destination,   
                        DateTravelFrom,
                        DateTravelTo,
                        DaysTravel,
                        Flight,
                        Seat,
                        SeatSisa,
                        TourCode,
                        TourLeaderInc,
                        Insurance,
                        Visa,
                        Embassy01,
                        Embassy02,
                        Embassy03,
                        Embassy04,
                        Embassy05,
                        QuotationCurr,
                        SellingCurr,
                        SellingOperator,
                        SellingRate,
                        Remarks,
                        Status,
                        TmrNo,
                        InputBy,
                        InputDate)
                        VALUES( '',
                        '',
                        'TAILOR MADE REQUEST',
                        '$datatmr[Department]', 
                        'TMR',
                        '$datatmr[ProductFor]',   
                        'TMR',
                        '$datatmr[Destination]', 
                        '$datatmr[DateTravelFrom]',
                        '$datatmr[DateTravelTo]',
                        '$datatmr[DaysTravel]',
                        '', 
                        '$seat',
                        '$seat',
                        '',
                        '$datatmr[TourLeaderInc]',
                        '$datatmr[Insurance]',
                        'NOT INCLUDE',
                        '',
                        '',
                        '',
                        '',    
                        '',
                        '$datatmr[BudgetCurr]', 
                        '$datatmr[BudgetCurr]',
                        '*',
                        '1',
                        '',    
                        'NOT PUBLISHED',
                        '$tmrid',
                        '$EmpName',
                        '$today')"); 
   
  $cuma = mysql_query("SELECT * FROM tour_msproductreq   
                                    ORDER BY IDProduct DESC limit 1");
  $saja = mysql_fetch_array($cuma);
  $inqid=$saja[IDProduct]; 
  for($i=1;$i<11;$i++){
  mysql_query("INSERT INTO tour_detailreq(Detail, 
                                   IDProduct,
                                   Category) 
                            VALUES ('VAR$i', 
                                   '$inqid', 
                                   'VARIABLE')");
  mysql_query("INSERT INTO tour_detailreq(Detail, 
                                   IDProduct,
                                   Category) 
                            VALUES ('FIX$i', 
                                   '$inqid', 
                                   'FIX')");
  mysql_query("INSERT INTO tour_agentreq(IDProduct,
                                   Category ) 
                            VALUES ('$inqid', 
                                   'AGENT$i')");
  }
  mysql_query("UPDATE tour_mstmrreq SET Status = 'NEED CONFIRM',IDProduct='$inqid'
                               WHERE IDTmr = '$datatmr[IDTmr]'");    
    
  mysql_query("UPDATE tour_detailreq SET Description = 'TICKET'
                               WHERE IDProduct = '$inqid' AND Detail ='FIX1' ");
  mysql_query("UPDATE tour_detailreq SET Description = 'AIRPORT HANDLING'
                               WHERE IDProduct = '$inqid' AND Detail ='FIX2' ");
  mysql_query("UPDATE tour_detailreq SET Description = 'INSURANCE'
                               WHERE IDProduct = '$inqid' AND Detail ='FIX3' ");
  mysql_query("UPDATE tour_detailreq SET Description = 'PROMOTION'
                               WHERE IDProduct = '$inqid' AND Detail ='FIX4' ");
  mysql_query("UPDATE tour_detailreq SET Description = 'APT TAX + FLT INSR + FUEL SURC'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR1' ");
  mysql_query("UPDATE tour_detailreq SET Description = 'T/L APT TAX JKT'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR2' ");
  mysql_query("UPDATE tour_detailreq SET Description = 'GHC'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR3' ");
  mysql_query("UPDATE tour_detailreq SET Description = 'TL ACCOMODATION'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR4' ");
  mysql_query("UPDATE tour_detailreq SET Description = 'T/L TICKETS'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR5' ");
  mysql_query("UPDATE tour_detailreq SET Description = 'MISCELANEOUS'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR6' ");
  mysql_query("INSERT INTO tour_msdetailreq(IDProduct) 
                            VALUES ('$inqid')");       
    }else{
    $cuma = mysql_query("SELECT * FROM tour_msproductreq WHERE TmrNo = '$tmrid'  
                                    ORDER BY IDProduct DESC limit 1");
    $saja = mysql_fetch_array($cuma);
    $inqid=$saja[IDProduct];
    }
                                                                               
    $edit=mysql_query("SELECT * FROM tour_msproductreq WHERE IDProduct = '$inqid'");
    $r=mysql_fetch_array($edit);
    $depdate = substr($r[DateTravelFrom],8,2);  
    $bulan = date("M", strtotime($r[DateTravelFrom]));
    $taon=substr($r[DateTravelFrom],0,4);
    $inputdate = date("d M Y", strtotime($r[InputDate]));
    $edit1=mysql_query("SELECT * FROM tour_msdetailreq WHERE IDProduct = '$inqid'");
    $m=mysql_fetch_array($edit1);
    $a1=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]'  ORDER BY SellingRate DESC ");
    $cek1=mysql_fetch_array($a1);  
    $a2=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]'  ORDER BY SellingRate DESC ");
    $cek2=mysql_fetch_array($a2);
    
    echo "<h2>Quotation TMR</h2>
    <form method=POST name='example' action='./aksi.php?module=quotationtmr&act=copyquotation' >
          <input type=hidden name='id' value='$r[IDProduct]'>
          <table>
          <tr style='border: hidden;'><td style='border: hidden;'>Created By</td><td>: $r[InputBy]</td><td width='200' style='border: hidden;'></td> <td style='border: hidden;'>Airlines</td> 
          <td><select name='flight' onChange='airshow($tmrid,$totquo,$inqid),turcodetmr()'>
            <option value='' selected>- Select Airlines -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msairlines where AirlinesStatus='ACTIVE' ORDER BY AirlinesID");
            while($s=mysql_fetch_array($tampil)){
                if($r[Flight]==$s[AirlinesID]){
                    echo "<option value='$s[AirlinesID]' selected>$s[AirlinesID] - $s[AirlinesName]</option>";    
                }else {
                    echo "<option value='$s[AirlinesID]'>$s[AirlinesID] - $s[AirlinesName]</option>";
                }
            }
    echo "</select></td></tr>
          <tr style='border: hidden;'><td style='border: hidden;'>Created Date</td> <td>: $inputdate</td><td style='border: hidden;'></td><td style='border: hidden;'>Number of Days</td> <td>: $r[DaysTravel] Days</td></tr>                       
          <tr style='border: hidden;'><td style='border: hidden;'>Currency</td> <td>: $r[SellingCurr]</td><td style='border: hidden;'></td><td style='border: hidden;'>Departure Date</td> <td>: $depdate $bulan $taon</td></tr>
          <tr style='border: hidden;'><td style='border: hidden;'>Total Seat</td> <td>: $r[Seat] PAX ";if($r[TourLeaderInc]=='YES'){echo" + Tour Leader";} echo"</td><td style='border: hidden;'></td><td style='border: hidden;'><input type='button' name='iwant' name='iwant' value='Copy Quotation'  onclick=Sowit() ></td>
          <td> <select name='idcopy' id='idcopy' style='visibility:hidden'>
            <option value='0' selected>- Select TourCode -</option>";     
            $tampil0=mysql_query("SELECT * FROM tour_msproduct   
                                WHERE Status <> 'VOID'
                                AND IDProduct <> '$r[IDProduct]' 
                                AND TourCode <> ''
                                ORDER BY TourCode ASC");
            while($r0=mysql_fetch_array($tampil0)){     
                    echo "<option value='$r0[IDProduct]'>$r0[TourCode]</option>"; 
            }
    echo "</select></td></tr>  
          <tr style='border: hidden;'><td style='border: hidden;'></td>
          <td></td><td width='200' style='border: hidden;'></td><td style='border: hidden;'></td> <td><input type='submit' name='apdet' id='apdet' value=Copy style='visibility:hidden'></td></tr>
          </table>
          </form>      
          <table><td  style='border: hidden;'>           
          <input type='button' name='submit' value='Edit Fix Cost' onclick=PopupCenter('quotationreq.php?id=$inqid','fix',740,480) >
                    <table>
                    <tr><th width='180'>FIX Cost</th><th width='80'>adult</th><th width='80'>child</th></tr>";
                    for ($x=1;$x<11;$x++){ 
                    $tampil=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX$x' ORDER BY IDDetail ASC ");
                    $data=mysql_fetch_array($tampil);
               echo "
                    <tr><td>$data[Description]</td><td>$r[SellingCurr]. $data[SellAdult]</td><td>$r[SellingCurr]. $data[SellChd]</td></tr>";
                    }
                    $tam=mysql_query("SELECT * FROM tour_msdetailreq
                                where IDProduct = '$r[IDProduct]'  ");
                    $dt=mysql_fetch_array($tam);
               echo"<tr><td><b><i>TOTAL</td><td><b><i>$r[SellingCurr]. $dt[TotalFixAdult]</td><td><b><i>$r[SellingCurr]. $dt[TotalFixChd]</td></table>";
                    
          echo"
          </td><td width='20'  style='border: hidden;'></td><td  style='border: hidden;'>  
          <input type='button' name='submit' value='Edit Variable Cost' onclick=PopupCenter('variablereq.php?id=$inqid','variable',550,480)>
                     <table>
                    <tr><th width='180'>variable</th><th width='80'>adult</th></tr>";
                    for ($i=1;$i<11;$i++){ 
                    $tampil=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR$i' ORDER BY IDDetail ASC ");
                    $data=mysql_fetch_array($tampil);
               echo "
                    <tr><td>$data[Description]</td><td>$r[SellingCurr]. $data[SellAdult]</td></tr>";
                    }
                    $tam2=mysql_query("SELECT * FROM tour_msdetailreq
                                where IDProduct = '$r[IDProduct]'  ");
                    $dt2=mysql_fetch_array($tam2);
               echo"<tr><td><b><i>TOTAL</td><td><b><i>$r[SellingCurr]. $dt2[TotalVar]</td></table>
          </td></table>
          
          <form method=POST name='quotation' action='./aksi.php?module=fixcost&act=input'>
          <input type=hidden name=id value='$r[IDProduct]'>
          <input type=hidden name='pax' value='$r[Seat]'>
          <font size='2'><i>Agent Cost</i></font>";
                    $tam3=mysql_query("SELECT * FROM tour_msdetailreq
                                where IDProduct = '$r[IDProduct]'  ");
                    $dt3=mysql_fetch_array($tam3);
                    if($dt3[AliasOptA]==''){$aliasa='OPTION A';}else{$aliasa=$dt3[AliasOptA];}
                    if($dt3[AliasOptB]==''){$aliasb='OPTION B';}else{$aliasb=$dt3[AliasOptB];}
                    if($dt3[AliasOptC]==''){$aliasc='OPTION C';}else{$aliasc=$dt3[AliasOptC];}
              echo "<table>
                    <tr><th></th><th colspan =3><input type='button' name='submit' value='$aliasa' onclick=PopupCenter('agentreq.php?id=$inqid','variable',920,520)></th>
                    <th colspan=3><input type='button' name='submit' value='$aliasb' onclick=PopupCenter('agentreq.php?id=$inqid&act=b','variable',920,520) ";if($m[TotalAdultA]=='0'){echo"disabled";} echo"></th>
                    <th colspan=3><input type='button' name='submit' value='$aliasc' onclick=PopupCenter('agentreq.php?id=$inqid&act=c','variable',920,520) ";if($m[TotalAdultB]=='0'){echo"disabled";} echo"></th></tr>
                    <tr><th>Number of Pax --></th><th colspan =3>$dt3[PaxA] PAX</th><th colspan=3>$dt3[PaxB] PAX</th><th colspan=3>$dt3[PaxC] PAX</th></tr>
                    <tr><th width='150'>Description</th><th width='78'>ADULT</th><th width='78'>CHILD TWN</th><th width='78'>CHILD X BED</th><th width='78'>ADULT</th><th width='78'>CHILD TWN</th><th width='78'>CHILD X BED</th><th width='78'>ADULT</th><th width='78'>CHILD TWN</th><th width='78'>CHILD X BED</th></tr>"; 
                    for ($i=1;$i<11;$i++){ 
                    $tampil=mysql_query("SELECT * FROM tour_agentreq
                                where IDProduct = '$r[IDProduct]' and Category = 'AGENT$i' ");
                    $data=mysql_fetch_array($tampil);  
               echo "<td>$data[Description]</td> 
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellAdultA]</td>
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellChdTwnA]</td>
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellChdXbedA]</td>
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellAdultB]</td>
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellChdTwnB]</td>
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellChdXbedB]</td>
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellAdultC]</td>
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellChdTwnC]</td>
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellChdXbedC]</td></tr>";
                    }
                    
                    echo "
                    <tr><td><b><i>TOTAL</td><td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalAdultA]</td><td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalChdTwnA]</td><td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalChdXbedA]</td>
                    <td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalAdultB]</td><td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalChdTwnB]</td><td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalChdXbedB]</td>
                    <td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalAdultC]</td><td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalChdTwnC]</td><td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalChdXbedC]</td></tr></table>";
                    
          echo"</form>
          
          <form method=POST name='calculate' onsubmit='return validateFormsKosong(this)' action='./aksi.php?module=msproduct&act=quotationtmr'>
          <input type=hidden name=id value='$r[IDProduct]'><input type=hidden name='productcode' value='TMR'><input type=hidden name='daystravel' value='$r[DaysTravel]'>   
          <input type=hidden name='tourcodes' value='$r[TourCode]'><input type=hidden name='datetravelfrom' value='$r[DateTravelFrom]'><input type=hidden name='idtmr' value='$tmrid'> ";
            $tampil=mysql_query("SELECT * FROM tour_msdetailreq
                                where IDProduct='$r[IDProduct]'  ");
            $data=mysql_fetch_array($tampil);    
            if($data[PaxA]=='0'){$tva=number_format(($data[TotalVar]), 2, '.', '');}else{$tva=number_format(($data[TotalVar] / $data[PaxA]), 2, '.', '');}
            if($data[PaxB]=='0'){$tvb=number_format(($data[TotalVar]), 2, '.', '');}else{$tvb=number_format(($data[TotalVar] / $data[PaxB]), 2, '.', '');}
            if($data[PaxC]=='0'){$tvc=number_format(($data[TotalVar]), 2, '.', '');}else{$tvc=number_format(($data[TotalVar] / $data[PaxC]), 2, '.', '');}
            
            if($data[PaxA]<>''){$tfaa=number_format(($data[TotalFixAdult]), 2, '.', '');$tfca=number_format(($data[TotalFixChd]), 2, '.', '');}//else{$tfaa=$data[TotalFixAdult] / $data[PaxA];$tfca=$data[TotalFixChd] / $data[PaxA];}
            if($data[PaxB]<>''){$tfab=number_format(($data[TotalFixAdult]), 2, '.', '');$tfcb=number_format(($data[TotalFixChd]), 2, '.', '');}//else{$tfab=$data[TotalFixAdult] / $data[PaxB];$tfcb=$data[TotalFixChd] / $data[PaxB];}
            if($data[PaxC]<>''){$tfac=number_format(($data[TotalFixAdult]), 2, '.', '');$tfcc=number_format(($data[TotalFixChd]), 2, '.', '');}//else{$tfac=$data[TotalFixAdult] / $data[PaxC];$tfcc=$data[TotalFixChd] / $data[PaxC];}
            
            if($data[PaxA]<>''){$taaa=number_format(($data[TotalAdultA]), 2, '.', '');$taca=number_format(($data[TotalChdTwnA]), 2, '.', '');$tacxa=number_format(($data[TotalChdXbedA]), 2, '.', '');}//else{$taaa=$data[TotalAdultA] / $data[PaxA];$taca=$data[TotalChdTwnA] / $data[PaxA];$tacxa=$data[TotalChdXbedA] / $data[PaxA];}
            if($data[PaxB]<>''){$taab=number_format(($data[TotalAdultB]), 2, '.', '');$tacb=number_format(($data[TotalChdTwnB]), 2, '.', '');$tacxb=number_format(($data[TotalChdXbedB]), 2, '.', '');}//else{$taab=$data[TotalAdultB] / $data[PaxB];$tacb=$data[TotalChdTwnB] / $data[PaxB];$tacxb=$data[TotalChdXbedB] / $data[PaxB];}
            if($data[PaxC]<>''){$taac=number_format(($data[TotalAdultC]), 2, '.', '');$tacc=number_format(($data[TotalChdTwnC]), 2, '.', '');$tacxc=number_format(($data[TotalChdXbedC]), 2, '.', '');}//else{$taac=$data[TotalAdultC] / $data[PaxC];$tacc=$data[TotalChdTwnC] / $data[PaxC];$tacxc=$data[TotalChdXbedC] / $data[PaxC];}
            
            $comaa=number_format(($data[ComAdultA]), 2, '.', '');$comca=number_format(($data[ComChdTwnA]), 2, '.', '');$comcxa=number_format(($data[ComChdXbedA]), 2, '.', '');
            $comab=number_format(($data[ComAdultB]), 2, '.', '');$comcb=number_format(($data[ComChdTwnB]), 2, '.', '');$comcxb=number_format(($data[ComChdXbedB]), 2, '.', '');
            $comac=number_format(($data[ComAdultC]), 2, '.', '');$comcc=number_format(($data[ComChdTwnC]), 2, '.', '');$comcxc=number_format(($data[ComChdXbedC]), 2, '.', '');
            //real nett
            $nettaa=number_format(($tva+$tfaa+$comaa+$taaa), 2, '.', ''); 
            $nettca=number_format(($tva+$tfca+$comca+$taca), 2, '.', ''); 
            $nettcxa=number_format(($tva+$tfca+$comcxa+$tacxa), 2, '.', ''); 
            $nettab=number_format(($tvb+$tfab+$comab+$taab), 2, '.', '');
            $nettcb=number_format(($tvb+$tfcb+$comcb+$tacb), 2, '.', ''); 
            $nettcxb=number_format(($tvb+$tfcb+$comcxb+$tacxb), 2, '.', ''); 
            $nettac=number_format(($tvc+$tfac+$comac+$taac), 2, '.', ''); 
            $nettcc=number_format(($tvc+$tfcc+$comcc+$tacc), 2, '.', '');
            $nettcxc=number_format(($tvc+$tfcc+$comcxc+$tacxc), 2, '.', ''); 
            //itung net var + fix + agent
            $nettaa1=number_format(($tva+$tfaa+$taaa), 2, '.', ''); 
            $nettca1=number_format(($tva+$tfca+$taca), 2, '.', ''); 
            $nettcxa1=number_format(($tva+$tfca+$tacxa), 2, '.', ''); 
            $nettab1=number_format(($tvb+$tfab+$taab), 2, '.', ''); 
            $nettcb1=number_format(($tvb+$tfcb+$tacb), 2, '.', '');
            $nettcxb1=number_format(($tvb+$tfcb+$tacxb), 2, '.', ''); 
            $nettac1=number_format(($tvc+$tfac+$taac), 2, '.', ''); 
            $nettcc1=number_format(($tvc+$tfcc+$tacc), 2, '.', ''); 
            $nettcxc1=number_format(($tvc+$tfcc+$tacxc), 2, '.', ''); 
            //itung profit margin
            if($data[Persen]=='0'){
            $paa=0; 
            $pca=0; 
            $pcxa=0; 
            $pab=0; 
            $pcb=0;
            $pcxb=0; 
            $pac=0; 
            $pcc=0;
            $pcxc=0;
            }else{
            $paa=number_format(($nettaa*$data[Persen])/100, 2, '.', '');
            $pca=number_format(($nettca*$data[Persen])/100, 2, '.', '');
            $pcxa=number_format(($nettcxa*$data[Persen])/100, 2, '.', '');
            $pab=number_format(($nettab*$data[Persen])/100, 2, '.', '');
            $pcb=number_format(($nettcb*$data[Persen])/100, 2, '.', '');
            $pcxb=number_format(($nettcxb*$data[Persen])/100, 2, '.', '');
            $pac=number_format(($nettac*$data[Persen])/100, 2, '.', '');
            $pcc=number_format(($nettcc*$data[Persen])/100, 2, '.', '');
            $pcxc=number_format(($nettcxc*$data[Persen])/100, 2, '.', '');
            }
            // itung selling
            $sellaa = number_format($nettaa + $paa + $data[DiscAdultA], 2, '.', '');
            $sellca = number_format($nettca + $pca + $data[DiscChdTwnA], 2, '.', '');
            $sellcxa = number_format($nettcxa + $pcxa + $data[DiscChdXbedA], 2, '.', '');
            $sellab = number_format($nettab + $pab + $data[DiscAdultB], 2, '.', '');
            $sellcb = number_format($nettcb + $pcb + $data[DiscChdTwnB], 2, '.', '');
            $sellcxb = number_format($nettcxb + $pcxb + $data[DiscChdXbedB], 2, '.', '');
            $sellac = number_format($nettac + $pac + $data[DiscAdultC], 2, '.', '');
            $sellcc = number_format($nettcc + $pcc + $data[DiscChdTwnC], 2, '.', '');
            $sellcxc = number_format($nettcxc + $pcxc + $data[DiscChdXbedC], 2, '.', '');
            //disc
            $disaa=number_format($data[DiscAdultA], 2, '.', '');
            $disca = number_format($data[DiscChdTwnA], 2, '.', '');
            $discxa = number_format($data[DiscChdXbedA], 2, '.', '');
            $disab = number_format($data[DiscAdultB], 2, '.', '');
            $discb = number_format($data[DiscChdTwnB], 2, '.', '');
            $discxb = number_format($data[DiscChdXbedB], 2, '.', '');
            $disac = number_format($data[DiscAdultC], 2, '.', '');
            $discc = number_format($data[DiscChdTwnC], 2, '.', '');
            $discxc = number_format($data[DiscChdXbedC], 2, '.', '');   
            
            echo "<table style='border: 0px solid #000000;'><input type=hidden name='sumaa' value='$nettaa1'><input type=hidden name='sumca' value='$nettca1'><input type=hidden name='sumcxa' value='$nettcxa1'>
            <input type=hidden name='sumab' value='$nettab1'><input type=hidden name='sumcb' value='$nettcb1'><input type=hidden name='sumcxb' value='$nettcxb1'> 
            <input type=hidden name='sumac' value='$nettac1'><input type=hidden name='sumcc' value='$nettcc1'><input type=hidden name='sumcxc' value='$nettcxc1'> 
                    <tr><th width=150></th><th width=78>ADULT</th><th width=78>CHILD TWN</th><th width=78>CHILD X BED</th><th width=78>ADULT</th><th width=78>CHILD TWN</th><th width=78>CHILD X BED</th><th width=78>ADULT</th><th width=78>CHILD TWN</th><th width=78>CHILD X BED</th></tr>
                     <tr><td width='150'>Total Variable Cost</td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvaradulta' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvarchdtwna' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvarchdxbeda' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvaradultb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvarchdtwnb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvarchdxbedb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvaradultc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvarchdtwnc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvarchdxbedc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     
                     <tr><td>Total Fix Cost</td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixadulta' value='$tfaa'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixchdtwna' value='$tfca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixchdxbeda' value='$tfca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixadultb' value='$tfab'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixchdtwnb' value='$tfcb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixchdxbedb' value='$tfcb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixadultc' value='$tfac'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixchdtwnc' value='$tfcc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixchdxbedc' value='$tfcc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     
                     <tr><td>Total Agent Cost</td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentadulta' value='$taaa'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentchdtwna' value='$taca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentchdxbeda' value='$tacxa'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentadultb' value='$taab'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentchdtwnb' value='$tacb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentchdxbedb' value='$tacxb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentadultc' value='$taac'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentchdtwnc' value='$tacc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentchdxbedc' value='$tacxc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     
                     <tr><td>Agent Commision <input type=text name='comall' id='sadult' size='5' style='text-align: right' onkeyup='isNumber(this),UpdateNetta(),UpdateNettb(),UpdateNettc()' value='$comaa'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='comaa' id='sadult' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly  value='$comaa'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='comca' id='ssin' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$comca'></td></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='comcxa' id='schdtwn' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$comcxa'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='comab' id='schdnbed' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$comab'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='comcb' id='schdxbed' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$comcb'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='comcxb' id='sinfant' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$comcxb'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='comac' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$comac'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='comcc' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$comcc'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='comcxc' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$comcxc'></td></tr>
                     
                     <tr><td>Nett </td><td BGCOLOR='#f5bebe'><input type='text' name='nettaa' id='padult' value='$nettaa'  size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettaa<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#f5bebe'><input type='text' name='nettca' id='psingle' value='$nettca' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettca<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#f5bebe'><input type='text' name='nettcxa' id='pchdtwn' value='$nettcxa' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcxa<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#bef5c6'><input type='text' name='nettab' id='pchdnbed' value='$nettab' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettab<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#bef5c6'><input type='text' name='nettcb' id='pchdxbed' value='$nettcb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcb<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#bef5c6'><input type='text' name='nettcxb' id='pinfant' value='$nettcxb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcxb<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#becaf5'><input type='text' name='nettac' id='pchdnbed' value='$nettac' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettac<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#becaf5'><input type='text' name='nettcc' id='pchdxbed' value='$nettcc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcc<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#becaf5'><input type='text' name='nettcxc' id='pinfant' value='$nettcxc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcxc<0){echo"background: red";}echo"' readonly></td></tr>
                     <tr><th colspan=10></th></tr>
                     
                     <tr><td>Profit Margin <input type=text name='persen' size='2' onkeyup='isNumber(this),UpdateProfit()'value='$data[Persen]'> %</td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='paa' size='8' value='$paa' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='pca' size='8' value='$pca' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='pcxa' size='8' value='$pcxa' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='pab' size='8' value='$pab' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='pcb' size='8' value='$pcb' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='pcxb' size='8' value='$pcxb' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='pac' size='8' value='$pac' style='background-color:#becaf5;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='pcc' size='8' value='$pcc' style='background-color:#becaf5;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='pcxc' size='8' value='$pcxc' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     
                     <tr><td>Spare for Discount <input type=text name='discall' id='sadult' size='5' style='text-align: right' onkeyup='isNumber(this),UpdateSell()' value='$disaa'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='discaa' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$disaa'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='discca' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$disca'></td></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='disccxa' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$discxa'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='discab' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$disab'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='disccb' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$discb'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='disccxb' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$discxb'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='discac' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$disac'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='disccc' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$discc'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='disccxc' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$discxc'></td></tr> 
                    
                    <tr><td>Selling Price</td><td BGCOLOR='#f5bebe'><input type='text' name='sellaa' value='$sellaa'  size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellaa<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#f5bebe'><input type='text' name='sellca' value='$sellca' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellca<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#f5bebe'><input type='text' name='sellcxa' value='$sellcxa' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcxa<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#bef5c6'><input type='text' name='sellab' value='$sellab' size='6'  style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellab<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#bef5c6'><input type='text' name='sellcb' value='$sellcb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcb<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#bef5c6'><input type='text' name='sellcxb' value='$sellcxb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcxb<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#becaf5'><input type='text' name='sellac' value='$sellac' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellac<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#becaf5'><input type='text' name='sellcc' value='$sellcc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcc<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#becaf5'><input type='text' name='sellcxc' value='$sellcxc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcxc<0){echo"background: red";}echo"' readonly></td></tr>
                         <tr style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'></td></tr>
                         
                         <tr><th colspan=6>Recommended Selling Price in $r[SellingCurr] <input type='hidden' name='airlines' value=$r[Flight]><input type='hidden' name='tourcode'></th><tr>
                         <tr><th>$aliasa</th><th>ADULT</th><th>CHILD TWN</th><th>CHILD X BED</th><th>Child No bed</th><th>Infant</th></tr>
                         <tr><td BGCOLOR='#f5bebe'>Tour</td><td BGCOLOR='#f5bebe'><input type=text name='rsadult' value='$r[SellingAdlTwn]' size='10' onkeyup='isNumber(this)'></td></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='rschdtwn' value='$r[SellingChdTwn]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='rschdxbed' value='$r[SellingChdXbed]' size='10'onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='rschdnbed' value='$r[SellingChdNbed]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='rsinfant' value='$r[SellingInfant]' size='10' onkeyup='isNumber(this)'></td></tr>
                         <tr><td BGCOLOR='#f5bebe'>Land Arrangement Only</td><td BGCOLOR='#f5bebe'><input type=text name='laadltwn' value='$r[LAAdlTwn]' size='10' onkeyup='isNumber(this)'></td></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='lachdtwn' value='$r[LAChdTwn]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='lachdxbed' value='$r[LAChdXbed]' size='10'onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='lachdnbed' value='$r[LAChdNbed]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='lainfant' value='$r[LAInfant]' size='10' onkeyup='isNumber(this)'></td></tr>
                         
                         <tr><th>$aliasb</th><th>ADULT</th><th>CHILD TWN</th><th>CHILD X BED</th><th>Child No bed</th><th>Infant</th></tr>
                         <tr><td BGCOLOR='#bef5c6'>Tour</td><td BGCOLOR='#bef5c6'><input type=text name='rsadultb' value='$r[SellingAdlTwnB]' size='10' onkeyup='isNumber(this)'></td></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='rschdtwnb' value='$r[SellingChdTwnB]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='rschdxbedb' value='$r[SellingChdXbedB]' size='10'onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='rschdnbedb' value='$r[SellingChdNbedB]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='rsinfantb' value='$r[SellingInfantB]' size='10' onkeyup='isNumber(this)'></td></tr>
                         <tr><td BGCOLOR='#bef5c6'>Land Arrangement Only</td><td BGCOLOR='#bef5c6'><input type=text name='laadltwnb' value='$r[LAAdlTwnB]' size='10' onkeyup='isNumber(this)'></td></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='lachdtwnb' value='$r[LAChdTwnB]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='lachdxbedb' value='$r[LAChdXbedB]' size='10'onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='lachdnbedb' value='$r[LAChdNbedB]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='lainfantb' value='$r[LAInfantB]' size='10' onkeyup='isNumber(this)'></td></tr> 
                         
                         <tr><th>$aliasc</th><th>ADULT</th><th>CHILD TWN</th><th>CHILD X BED</th><th>Child No bed</th><th>Infant</th></tr>
                         <tr><td BGCOLOR='#becaf5'>Tour</td><td BGCOLOR='#becaf5'><input type=text name='rsadultc' value='$r[SellingAdlTwnC]' size='10' onkeyup='isNumber(this)'></td></td>
                         <td BGCOLOR='#becaf5'><input type=text name='rschdtwnc' value='$r[SellingChdTwnC]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='rschdxbedc' value='$r[SellingChdXbedC]' size='10'onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='rschdnbedc' value='$r[SellingChdNbedC]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='rsinfantc' value='$r[SellingInfantC]' size='10' onkeyup='isNumber(this)'></td></tr>
                         <tr><td BGCOLOR='#becaf5'>Land Arrangement Only</td><td BGCOLOR='#becaf5'><input type=text name='laadltwnc' value='$r[LAAdlTwnC]' size='10' onkeyup='isNumber(this)'></td></td>
                         <td BGCOLOR='#becaf5'><input type=text name='lachdtwnc' value='$r[LAChdTwnC]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='lachdxbedc' value='$r[LAChdXbedC]' size='10'onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='lachdnbedc' value='$r[LAChdNbedC]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='lainfantc' value='$r[LAInfantC]' size='10' onkeyup='isNumber(this)'></td></tr>
                              
          </table>
          <table>
          <tr><th>Description</th><th>Curr</th><th>Nett</th><th>selling</th></tr>
          <tr><td>Airport Tax & Flight Insurance</td> <td>$r[SellingCurr]</td><td> <input type=text name='taxinsnett' size='12' value='$r[TaxInsNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='taxinssell' size='12' value='$r[TaxInsSell]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Single Supplement</td> <td>$r[SellingCurr]</td><td> <input type=text name='singlenett' size='12' value='$r[SingleNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='singlesell' size='12' value='$r[SingleSell]'onkeyup='isNumber(this)'></td></tr> 
          <tr><td>Visa </td><td><select name='visacurr' ";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo">";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($r[VisaCurr]==''){$r[VisaCurr]='IDR';}
            while($s=mysql_fetch_array($tampil)){
                  if($s[curr]==$r[VisaCurr]){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                     echo "<option value='$s[curr]'>$s[curr]</option>";   
                    }         
            }
    echo "</select></td><td> <input type=text name='visanett' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaNett]'onkeyup='isNumber(this)'></td><td><input type=text name='visasell' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaSell]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Visa 2</td><td><select name='visacurr2' ";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo">";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($r[VisaCurr2]==''){$r[VisaCurr2]='USD';}
            while($s=mysql_fetch_array($tampil)){
                  if($s[curr]==$r[VisaCurr2]){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                     echo "<option value='$s[curr]'>$s[curr]</option>";   
                    }         
            }
    echo "</select></td><td> <input type=text name='visanett2' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaNett2]'onkeyup='isNumber(this)'></td><td><input type=text name='visasell2' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaSell2]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Domestic Airport Tax</td><td><select name='airtaxcurr' >";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($r[AirTaxCurr]==''){$r[AirTaxCurr]='IDR';} 
            while($s=mysql_fetch_array($tampil)){    
                     if($s[curr]==$r[AirTaxCurr]){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                     echo "<option value='$s[curr]'>$s[curr]</option>";   
                    }
                
            }
          if($r[AirTaxNett]=='0' OR $r[AirTaxNett]==''){$airtaxnett='150000';}else {$airtaxnett=$r[AirTaxNett];}
          if($r[AirTaxSell]=='0' OR $r[AirTaxSell]==''){$airtaxsell='150000';}else {$airtaxsell=$r[AirTaxSell];}
    $tenc=mysql_query("SELECT * FROM tour_tandc order by TcID asc");
    $isitnc=mysql_fetch_array($tenc);
    $caridataakhir=mysql_query("SELECT * FROM tour_mstmrreq WHERE IDTmr = '$tmrid' order by IDTmr DESC limit 1");
    $datatmrakhir=mysql_fetch_array($caridataakhir);
    if($barukah==1){
    $BValue = $isitnc[TCBahasa];}
    else{$BValue=$datatmrakhir[TnC];}  
    echo "</select></td><td> <input type=text name='airtaxnett' size='12' value='$airtaxnett'onkeyup='isNumber(this)'></td><td> <input type=text name='airtaxsell' size='12' value='$airtaxsell'onkeyup='isNumber(this)'></td></tr>
          </table>          
          <table width=900 style='border: 0px solid #000000;'>
          <tr><th>Terms and Condition</th></tr>
          <tr><td style='border: 0px solid #000000;'>
          <textarea cols='50' id='tcb' name='tcb' rows='5'>$BValue</textarea>
          ";?>   
           <script type="text/javascript">
            //<![CDATA[

                CKEDITOR.replace( 'tcb', {
                    extraPlugins : 'autogrow',
                    autoGrow_maxHeight : 400,
                    removePlugins : 'resize'
                });

            //]]>
            </script> 
          <?PHP echo"                                       
          </td></tr></table>";
          if($r[Flight]<>''){?>
        <script type="text/javascript">
        turcodetmr();
        </script><?PHP
    }   
    echo"<center><input type='submit' name='submit' value='Save'>
          </form>";
     break;
     
case "editquotationtmr":
    $tmrid=$_GET[cd];
    $nomor=$_GET[no];
    echo "<h2>Quotation TMR</h2>
          <form method=get action='media.php?'><input type=hidden name='module' value='msproduct'> 
                <input type=hidden name='act' value='editquotationtmr'><input type='hidden' name='no' value='$nomor'>   
              <font size=2>Quotation Flight</font> 
              <select name='cd'><option value=''>- Select Flight -</option>"; 
              $option = mysql_query("SELECT * FROM tour_msproductreq 
                                    WHERE TmrNo = '$nomor' AND Flight <>''");  
              while($s=mysql_fetch_array($option)){
              /*if ($s[IDProduct]==$nomor){
                echo "<option value='$s[IDProduct]' selected >$s[Flight]</option>";    
              }else { */
              echo "<option value='$s[IDProduct]'>$s[Flight]</option>";
              //}
                   
              }
    echo "</select> <input type='submit' value='Show'> 
          </form>";
    if($tmrid<>''){
    $edit=mysql_query("SELECT * FROM tour_msproductreq WHERE IDProduct = '$tmrid'");
    $r=mysql_fetch_array($edit);
    $caridata=mysql_query("SELECT * FROM tour_mstmrreq WHERE IDTmr = '$r[TmrNo]'");
    $datatmr=mysql_fetch_array($caridata);                                   
    
    $depdate = substr($r[DateTravelFrom],8,2);  
    $bulan = date("M", strtotime($r[DateTravelFrom]));
    $taon=substr($r[DateTravelFrom],0,4);
    $inputdate = date("d M Y", strtotime($r[InputDate]));
    $edit1=mysql_query("SELECT * FROM tour_msdetailreq WHERE IDProduct = '$r[IDProduct]'");
    $m=mysql_fetch_array($edit1);
    $a1=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]'  ORDER BY SellingRate DESC ");
    $cek1=mysql_fetch_array($a1);  
    $a2=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]'  ORDER BY SellingRate DESC ");
    $cek2=mysql_fetch_array($a2);
    echo"                              
    <form method=POST name='example' action='./aksi.php?module=quotationtmr&act=copyquotation' >
          <input type=hidden name='id' value='$r[IDProduct]'>
          <table>
          <tr style='border: hidden;'><td style='border: hidden;'>Created By</td><td>: $r[InputBy]</td><td width='200' style='border: hidden;'></td> <td style='border: hidden;'>Airlines</td> 
          <td>";
            $tampil=mysql_query("SELECT * FROM tour_msairlines where AirlinesStatus='ACTIVE' ORDER BY AirlinesID");
            while($s=mysql_fetch_array($tampil)){
                if($r[Flight]==$s[AirlinesID]){
                    echo ": $s[AirlinesName] ($s[AirlinesID])";    
                }
            }
    echo "</select></td></tr>
          <tr style='border: hidden;'><td style='border: hidden;'>Created Date</td> <td>: $inputdate</td><td style='border: hidden;'></td><td style='border: hidden;'>Number of Days</td> <td>: $r[DaysTravel] Days</td></tr>                       
          <tr style='border: hidden;'><td style='border: hidden;'>Currency</td> <td>: $r[SellingCurr]</td><td style='border: hidden;'></td><td style='border: hidden;'>Departure Date</td> <td>: $depdate $bulan $taon</td></tr>
          <tr style='border: hidden;'><td style='border: hidden;'>Total Seat</td> <td>: $r[Seat] PAX ";if($r[TourLeaderInc]=='YES'){echo" + Tour Leader";} echo"</td><td style='border: hidden;'></td><td style='border: hidden;'><input type='button' name='iwant' name='iwant' value='Copy Quotation'  onclick=Sowit() ></td>
          <td> <select name='idcopy' id='idcopy' style='visibility:hidden'>
            <option value='0' selected>- Select TourCode -</option>";     
            $tampil0=mysql_query("SELECT * FROM tour_msproduct   
                                WHERE Status <> 'VOID'
                                AND IDProduct <> '$r[IDProduct]' 
                                AND TourCode <> ''
                                ORDER BY TourCode ASC");
            while($r0=mysql_fetch_array($tampil0)){     
                    echo "<option value='$r0[IDProduct]'>$r0[TourCode]</option>"; 
            }
    echo "</select></td></tr>  
          <tr style='border: hidden;'><td style='border: hidden;'></td>
          <td></td><td width='200' style='border: hidden;'></td><td style='border: hidden;'></td> <td><input type='submit' name='apdet' id='apdet' value=Copy style='visibility:hidden'></td></tr>
          </table>
          </form>      
          <table><td  style='border: hidden;'>           
          <input type='button' name='submit' value='Edit Fix Cost' onclick=PopupCenter('quotationreq.php?id=$r[IDProduct]','fix',770,500) >
                    <table>
                    <tr><th width='180'>FIX Cost</th><th width='80'>adult</th><th width='80'>child</th></tr>";
                    for ($x=1;$x<11;$x++){ 
                    $tampil=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX$x' ORDER BY IDDetail ASC ");
                    $data=mysql_fetch_array($tampil);
               echo "
                    <tr><td>$data[Description]</td><td>$r[SellingCurr]. $data[SellAdult]</td><td>$r[SellingCurr]. $data[SellChd]</td></tr>";
                    }
                    $tam=mysql_query("SELECT * FROM tour_msdetailreq
                                where IDProduct = '$r[IDProduct]'  ");
                    $dt=mysql_fetch_array($tam);
               echo"<tr><td><b><i>TOTAL</td><td><b><i>$r[SellingCurr]. $dt[TotalFixAdult]</td><td><b><i>$r[SellingCurr]. $dt[TotalFixChd]</td></table>";
                    
          echo"
          </td><td width='20'  style='border: hidden;'></td><td  style='border: hidden;'>  
          <input type='button' name='submit' value='Edit Variable Cost' onclick=PopupCenter('variablereq.php?id=$r[IDProduct]','variable',570,500)>
                     <table>
                    <tr><th width='180'>variable</th><th width='80'>adult</th></tr>";
                    for ($i=1;$i<11;$i++){ 
                    $tampil=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR$i' ORDER BY IDDetail ASC ");
                    $data=mysql_fetch_array($tampil);
               echo "
                    <tr><td>$data[Description]</td><td>$r[SellingCurr]. $data[SellAdult]</td></tr>";
                    }
                    $tam2=mysql_query("SELECT * FROM tour_msdetailreq
                                where IDProduct = '$r[IDProduct]'  ");
                    $dt2=mysql_fetch_array($tam2);
               echo"<tr><td><b><i>TOTAL</td><td><b><i>$r[SellingCurr]. $dt2[TotalVar]</td></table>
          </td></table>
          
          <form method=POST name='quotation' action='./aksi.php?module=fixcost&act=input'>
          <input type=hidden name=id value='$r[IDProduct]'>
          <input type=hidden name='pax' value='$r[Seat]'>
          <font size='2'><i>Agent Cost</i></font>";
                    $tam3=mysql_query("SELECT * FROM tour_msdetailreq
                                where IDProduct = '$r[IDProduct]'  ");
                    $dt3=mysql_fetch_array($tam3);
                    if($dt3[AliasOptA]==''){$aliasa='OPTION A';}else{$aliasa=$dt3[AliasOptA];}
                    if($dt3[AliasOptB]==''){$aliasb='OPTION B';}else{$aliasb=$dt3[AliasOptB];}
                    if($dt3[AliasOptC]==''){$aliasc='OPTION C';}else{$aliasc=$dt3[AliasOptC];}
              echo "<table>
                    <tr><th></th><th colspan =3><input type='button' name='submit' value='$aliasa' onclick=PopupCenter('agentreq.php?id=$r[IDProduct]','variable',950,550)></th>
                    <th colspan=3><input type='button' name='submit' value='$aliasb' onclick=PopupCenter('agentreq.php?id=$r[IDProduct]&act=b','variable',920,520) ";if($m[TotalAdultA]=='0'){echo"disabled";} echo"></th>
                    <th colspan=3><input type='button' name='submit' value='$aliasc' onclick=PopupCenter('agentreq.php?id=$r[IDProduct]&act=c','variable',920,520) ";if($m[TotalAdultB]=='0'){echo"disabled";} echo"></th></tr>
                    <tr><th>Number of Pax --></th><th colspan =3>$dt3[PaxA] PAX</th><th colspan=3>$dt3[PaxB] PAX</th><th colspan=3>$dt3[PaxC] PAX</th></tr>
                    <tr><th width='150'>Description</th><th width='78'>ADULT</th><th width='78'>CHILD TWN</th><th width='78'>CHILD X BED</th><th width='78'>ADULT</th><th width='78'>CHILD TWN</th><th width='78'>CHILD X BED</th><th width='78'>ADULT</th><th width='78'>CHILD TWN</th><th width='78'>CHILD X BED</th></tr>"; 
                    for ($i=1;$i<11;$i++){ 
                    $tampil=mysql_query("SELECT * FROM tour_agentreq
                                where IDProduct = '$r[IDProduct]' and Category = 'AGENT$i' ");
                    $data=mysql_fetch_array($tampil);  
               echo "<td>$data[Description]</td> 
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellAdultA]</td>
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellChdTwnA]</td>
                     <td BGCOLOR='#f5bebe' style='text-align:right'>$data[SellChdXbedA]</td>
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellAdultB]</td>
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellChdTwnB]</td>
                     <td BGCOLOR='#bef5c6' style='text-align:right'>$data[SellChdXbedB]</td>
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellAdultC]</td>
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellChdTwnC]</td>
                     <td BGCOLOR='#becaf5' style='text-align:right'>$data[SellChdXbedC]</td></tr>";
                    }
                    
                    echo "
                    <tr><td><b><i>TOTAL</td><td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalAdultA]</td><td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalChdTwnA]</td><td BGCOLOR='#f5bebe' style='text-align:right'><b><i>$dt3[TotalChdXbedA]</td>
                    <td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalAdultB]</td><td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalChdTwnB]</td><td BGCOLOR='#bef5c6' style='text-align:right'><b><i>$dt3[TotalChdXbedB]</td>
                    <td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalAdultC]</td><td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalChdTwnC]</td><td BGCOLOR='#becaf5' style='text-align:right'><b><i>$dt3[TotalChdXbedC]</td></tr></table>";
                    
          echo"</form>
          
          <form method=POST name='calculate' onsubmit='return validateFormsKosong(this)' action='./aksi.php?module=msproduct&act=quotationtmr'>
          <input type=hidden name=id value='$r[IDProduct]'><input type=hidden name='idtmr' value='$datatmr[IDTmr]'>  
          <input type=hidden name='tourcode' value='$r[TourCode]'>";
            $tampil=mysql_query("SELECT * FROM tour_msdetailreq
                                where IDProduct='$r[IDProduct]'  ");
            $data=mysql_fetch_array($tampil);    
            if($data[PaxA]=='0'){$tva=number_format(($data[TotalVar]), 2, '.', '');}else{$tva=number_format(($data[TotalVar] / $data[PaxA]), 2, '.', '');}
            if($data[PaxB]=='0'){$tvb=number_format(($data[TotalVar]), 2, '.', '');}else{$tvb=number_format(($data[TotalVar] / $data[PaxB]), 2, '.', '');}
            if($data[PaxC]=='0'){$tvc=number_format(($data[TotalVar]), 2, '.', '');}else{$tvc=number_format(($data[TotalVar] / $data[PaxC]), 2, '.', '');}
            
            if($data[PaxA]<>''){$tfaa=number_format(($data[TotalFixAdult]), 2, '.', '');$tfca=number_format(($data[TotalFixChd]), 2, '.', '');}//else{$tfaa=$data[TotalFixAdult] / $data[PaxA];$tfca=$data[TotalFixChd] / $data[PaxA];}
            if($data[PaxB]<>''){$tfab=number_format(($data[TotalFixAdult]), 2, '.', '');$tfcb=number_format(($data[TotalFixChd]), 2, '.', '');}//else{$tfab=$data[TotalFixAdult] / $data[PaxB];$tfcb=$data[TotalFixChd] / $data[PaxB];}
            if($data[PaxC]<>''){$tfac=number_format(($data[TotalFixAdult]), 2, '.', '');$tfcc=number_format(($data[TotalFixChd]), 2, '.', '');}//else{$tfac=$data[TotalFixAdult] / $data[PaxC];$tfcc=$data[TotalFixChd] / $data[PaxC];}
            
            if($data[PaxA]<>''){$taaa=number_format(($data[TotalAdultA]), 2, '.', '');$taca=number_format(($data[TotalChdTwnA]), 2, '.', '');$tacxa=number_format(($data[TotalChdXbedA]), 2, '.', '');}//else{$taaa=$data[TotalAdultA] / $data[PaxA];$taca=$data[TotalChdTwnA] / $data[PaxA];$tacxa=$data[TotalChdXbedA] / $data[PaxA];}
            if($data[PaxB]<>''){$taab=number_format(($data[TotalAdultB]), 2, '.', '');$tacb=number_format(($data[TotalChdTwnB]), 2, '.', '');$tacxb=number_format(($data[TotalChdXbedB]), 2, '.', '');}//else{$taab=$data[TotalAdultB] / $data[PaxB];$tacb=$data[TotalChdTwnB] / $data[PaxB];$tacxb=$data[TotalChdXbedB] / $data[PaxB];}
            if($data[PaxC]<>''){$taac=number_format(($data[TotalAdultC]), 2, '.', '');$tacc=number_format(($data[TotalChdTwnC]), 2, '.', '');$tacxc=number_format(($data[TotalChdXbedC]), 2, '.', '');}//else{$taac=$data[TotalAdultC] / $data[PaxC];$tacc=$data[TotalChdTwnC] / $data[PaxC];$tacxc=$data[TotalChdXbedC] / $data[PaxC];}
            
            $comaa=number_format(($data[ComAdultA]), 2, '.', '');$comca=number_format(($data[ComChdTwnA]), 2, '.', '');$comcxa=number_format(($data[ComChdXbedA]), 2, '.', '');
            $comab=number_format(($data[ComAdultB]), 2, '.', '');$comcb=number_format(($data[ComChdTwnB]), 2, '.', '');$comcxb=number_format(($data[ComChdXbedB]), 2, '.', '');
            $comac=number_format(($data[ComAdultC]), 2, '.', '');$comcc=number_format(($data[ComChdTwnC]), 2, '.', '');$comcxc=number_format(($data[ComChdXbedC]), 2, '.', '');
            //real nett
            $nettaa=number_format(($tva+$tfaa+$comaa+$taaa), 2, '.', ''); 
            $nettca=number_format(($tva+$tfca+$comca+$taca), 2, '.', ''); 
            $nettcxa=number_format(($tva+$tfca+$comcxa+$tacxa), 2, '.', ''); 
            $nettab=number_format(($tvb+$tfab+$comab+$taab), 2, '.', '');
            $nettcb=number_format(($tvb+$tfcb+$comcb+$tacb), 2, '.', ''); 
            $nettcxb=number_format(($tvb+$tfcb+$comcxb+$tacxb), 2, '.', ''); 
            $nettac=number_format(($tvc+$tfac+$comac+$taac), 2, '.', ''); 
            $nettcc=number_format(($tvc+$tfcc+$comcc+$tacc), 2, '.', '');
            $nettcxc=number_format(($tvc+$tfcc+$comcxc+$tacxc), 2, '.', ''); 
            //itung net var + fix + agent
            $nettaa1=number_format(($tva+$tfaa+$taaa), 2, '.', ''); 
            $nettca1=number_format(($tva+$tfca+$taca), 2, '.', ''); 
            $nettcxa1=number_format(($tva+$tfca+$tacxa), 2, '.', ''); 
            $nettab1=number_format(($tvb+$tfab+$taab), 2, '.', ''); 
            $nettcb1=number_format(($tvb+$tfcb+$tacb), 2, '.', '');
            $nettcxb1=number_format(($tvb+$tfcb+$tacxb), 2, '.', ''); 
            $nettac1=number_format(($tvc+$tfac+$taac), 2, '.', ''); 
            $nettcc1=number_format(($tvc+$tfcc+$tacc), 2, '.', ''); 
            $nettcxc1=number_format(($tvc+$tfcc+$tacxc), 2, '.', ''); 
            //itung profit margin
            if($data[Persen]=='0'){
            $paa=0; 
            $pca=0; 
            $pcxa=0; 
            $pab=0; 
            $pcb=0;
            $pcxb=0; 
            $pac=0; 
            $pcc=0;
            $pcxc=0;
            }else{
            $paa=number_format(($nettaa*$data[Persen])/100, 2, '.', '');
            $pca=number_format(($nettca*$data[Persen])/100, 2, '.', '');
            $pcxa=number_format(($nettcxa*$data[Persen])/100, 2, '.', '');
            $pab=number_format(($nettab*$data[Persen])/100, 2, '.', '');
            $pcb=number_format(($nettcb*$data[Persen])/100, 2, '.', '');
            $pcxb=number_format(($nettcxb*$data[Persen])/100, 2, '.', '');
            $pac=number_format(($nettac*$data[Persen])/100, 2, '.', '');
            $pcc=number_format(($nettcc*$data[Persen])/100, 2, '.', '');
            $pcxc=number_format(($nettcxc*$data[Persen])/100, 2, '.', '');
            }
            // itung selling
            $sellaa = number_format($nettaa + $paa + $data[DiscAdultA], 2, '.', '');
            $sellca = number_format($nettca + $pca + $data[DiscChdTwnA], 2, '.', '');
            $sellcxa = number_format($nettcxa + $pcxa + $data[DiscChdXbedA], 2, '.', '');
            $sellab = number_format($nettab + $pab + $data[DiscAdultB], 2, '.', '');
            $sellcb = number_format($nettcb + $pcb + $data[DiscChdTwnB], 2, '.', '');
            $sellcxb = number_format($nettcxb + $pcxb + $data[DiscChdXbedB], 2, '.', '');
            $sellac = number_format($nettac + $pac + $data[DiscAdultC], 2, '.', '');
            $sellcc = number_format($nettcc + $pcc + $data[DiscChdTwnC], 2, '.', '');
            $sellcxc = number_format($nettcxc + $pcxc + $data[DiscChdXbedC], 2, '.', '');
            //disc
            $disaa=number_format($data[DiscAdultA], 2, '.', '');
            $disca = number_format($data[DiscChdTwnA], 2, '.', '');
            $discxa = number_format($data[DiscChdXbedA], 2, '.', '');
            $disab = number_format($data[DiscAdultB], 2, '.', '');
            $discb = number_format($data[DiscChdTwnB], 2, '.', '');
            $discxb = number_format($data[DiscChdXbedB], 2, '.', '');
            $disac = number_format($data[DiscAdultC], 2, '.', '');
            $discc = number_format($data[DiscChdTwnC], 2, '.', '');
            $discxc = number_format($data[DiscChdXbedC], 2, '.', '');   
            
            echo "<table><input type=hidden name='sumaa' value='$nettaa1'><input type=hidden name='sumca' value='$nettca1'><input type=hidden name='sumcxa' value='$nettcxa1'>
            <input type=hidden name='sumab' value='$nettab1'><input type=hidden name='sumcb' value='$nettcb1'><input type=hidden name='sumcxb' value='$nettcxb1'> 
            <input type=hidden name='sumac' value='$nettac1'><input type=hidden name='sumcc' value='$nettcc1'><input type=hidden name='sumcxc' value='$nettcxc1'> 
                    <tr><th width=150></th><th width=78>ADULT</th><th width=78>CHILD TWN</th><th width=78>CHILD X BED</th><th width=78>ADULT</th><th width=78>CHILD TWN</th><th width=78>CHILD X BED</th><th width=78>ADULT</th><th width=78>CHILD TWN</th><th width=78>CHILD X BED</th></tr>
                     <tr><td width='150'>Total Variable Cost</td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvaradulta' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvarchdtwna' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalvarchdxbeda' value='$tva'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvaradultb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvarchdtwnb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalvarchdxbedb' value='$tvb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvaradultc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvarchdtwnc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalvarchdxbedc' value='$tvc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     
                     <tr><td>Total Fix Cost</td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixadulta' value='$tfaa'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixchdtwna' value='$tfca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalfixchdxbeda' value='$tfca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixadultb' value='$tfab'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixchdtwnb' value='$tfcb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalfixchdxbedb' value='$tfcb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixadultc' value='$tfac'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixchdtwnc' value='$tfcc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalfixchdxbedc' value='$tfcc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     
                     <tr><td>Total Agent Cost</td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentadulta' value='$taaa'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentchdtwna' value='$taca'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='totalagentchdxbeda' value='$tacxa'  size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentadultb' value='$taab'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentchdtwnb' value='$tacb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='totalagentchdxbedb' value='$tacxb'  size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentadultc' value='$taac'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentchdtwnc' value='$tacc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='totalagentchdxbedc' value='$tacxc'  size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     
                     <tr><td>Agent Commision <input type=text name='comall' id='sadult' size='5' style='text-align: right' onkeyup='isNumber(this),UpdateNetta(),UpdateNettb(),UpdateNettc()' value='$comaa'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='comaa' id='sadult' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly  value='$comaa'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='comca' id='ssin' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$comca'></td></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='comcxa' id='schdtwn' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$comcxa'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='comab' id='schdnbed' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$comab'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='comcb' id='schdxbed' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$comcb'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='comcxb' id='sinfant' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$comcxb'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='comac' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$comac'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='comcc' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$comcc'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='comcxc' id='schdnbed' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$comcxc'></td></tr>
                     
                     <tr><td>Nett </td><td BGCOLOR='#f5bebe'><input type='text' name='nettaa' id='padult' value='$nettaa'  size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettaa<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#f5bebe'><input type='text' name='nettca' id='psingle' value='$nettca' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettca<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#f5bebe'><input type='text' name='nettcxa' id='pchdtwn' value='$nettcxa' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcxa<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#bef5c6'><input type='text' name='nettab' id='pchdnbed' value='$nettab' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettab<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#bef5c6'><input type='text' name='nettcb' id='pchdxbed' value='$nettcb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcb<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#bef5c6'><input type='text' name='nettcxb' id='pinfant' value='$nettcxb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcxb<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#becaf5'><input type='text' name='nettac' id='pchdnbed' value='$nettac' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettac<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#becaf5'><input type='text' name='nettcc' id='pchdxbed' value='$nettcc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcc<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#becaf5'><input type='text' name='nettcxc' id='pinfant' value='$nettcxc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($nettcxc<0){echo"background: red";}echo"' readonly></td></tr>
                     <tr><th colspan=10></th></tr>
                     
                     <tr><td>Profit Margin <input type=text name='persen' size='2' onkeyup='isNumber(this),UpdateProfit()'value='$data[Persen]'> %</td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='paa' size='8' value='$paa' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='pca' size='8' value='$pca' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly></td>
                     <td BGCOLOR='#f5bebe'><input type='text' name='pcxa' size='8' value='$pcxa' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='pab' size='8' value='$pab' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='pcb' size='8' value='$pcb' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#bef5c6'><input type='text' name='pcxb' size='8' value='$pcxb' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='pac' size='8' value='$pac' style='background-color:#becaf5;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='pcc' size='8' value='$pcc' style='background-color:#becaf5;text-align: right;border: 0px solid #000000; ' readonly></td>
                     <td BGCOLOR='#becaf5'><input type='text' name='pcxc' size='8' value='$pcxc' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly></td></tr>
                     
                     <tr><td>Spare for Discount <input type=text name='discall' id='sadult' size='5' style='text-align: right' onkeyup='isNumber(this),UpdateSell()' value='$disaa'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='discaa' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$disaa'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='discca' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$disca'></td></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='disccxa' size='8' style='background-color:#f5bebe;text-align: right;border: 0px solid #000000;' readonly value='$discxa'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='discab' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$disab'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='disccb' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$discb'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='disccxb' size='8' style='background-color:#bef5c6;text-align: right;border: 0px solid #000000;' readonly value='$discxb'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='discac' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$disac'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='disccc' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$discc'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='disccxc' size='8' style='background-color:#becaf5;text-align: right;border: 0px solid #000000;' readonly value='$discxc'></td></tr> 
                    
                    <tr><td>Selling Price</td><td BGCOLOR='#f5bebe'><input type='text' name='sellaa' value='$sellaa'  size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellaa<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#f5bebe'><input type='text' name='sellca' value='$sellca' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellca<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#f5bebe'><input type='text' name='sellcxa' value='$sellcxa' size='6' style='background-color:#f5bebe;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcxa<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#bef5c6'><input type='text' name='sellab' value='$sellab' size='6'  style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellab<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#bef5c6'><input type='text' name='sellcb' value='$sellcb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcb<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#bef5c6'><input type='text' name='sellcxb' value='$sellcxb' size='6' style='background-color:#bef5c6;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcxb<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#becaf5'><input type='text' name='sellac' value='$sellac' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellac<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#becaf5'><input type='text' name='sellcc' value='$sellcc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcc<0){echo"background: red";}echo"' readonly></td>
                         <td BGCOLOR='#becaf5'><input type='text' name='sellcxc' value='$sellcxc' size='6' style='background-color:#becaf5;text-align: right;font-weight:bold;border: 0px solid #000000;";if($sellcxc<0){echo"background: red";}echo"' readonly></td></tr>
                         <tr style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'></td></tr>
                         
                         <tr><th colspan=6>Recommended Selling Price in $r[SellingCurr] <input type='hidden' name='airlines' value=$r[Flight]></th><tr>
                         <tr><th>$aliasa</th><th>ADULT</th><th>CHILD TWN</th><th>CHILD X BED</th><th>Child No bed</th><th>Infant</th></tr>
                         <tr><td BGCOLOR='#f5bebe'>Tour</td><td BGCOLOR='#f5bebe'><input type=text name='rsadult' value='$r[SellingAdlTwn]' size='10' onkeyup='isNumber(this)'></td></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='rschdtwn' value='$r[SellingChdTwn]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='rschdxbed' value='$r[SellingChdXbed]' size='10'onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='rschdnbed' value='$r[SellingChdNbed]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='rsinfant' value='$r[SellingInfant]' size='10' onkeyup='isNumber(this)'></td></tr>
                         <tr><td BGCOLOR='#f5bebe'>Land Arrangement Only</td><td BGCOLOR='#f5bebe'><input type=text name='laadltwn' value='$r[LAAdlTwn]' size='10' onkeyup='isNumber(this)'></td></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='lachdtwn' value='$r[LAChdTwn]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='lachdxbed' value='$r[LAChdXbed]' size='10'onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='lachdnbed' value='$r[LAChdNbed]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#f5bebe'><input type=text name='lainfant' value='$r[LAInfant]' size='10' onkeyup='isNumber(this)'></td></tr>
                         
                         <tr><th>$aliasb</th><th>ADULT</th><th>CHILD TWN</th><th>CHILD X BED</th><th>Child No bed</th><th>Infant</th></tr>
                         <tr><td BGCOLOR='#bef5c6'>Tour</td><td BGCOLOR='#bef5c6'><input type=text name='rsadultb' value='$r[SellingAdlTwnB]' size='10' onkeyup='isNumber(this)'></td></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='rschdtwnb' value='$r[SellingChdTwnB]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='rschdxbedb' value='$r[SellingChdXbedB]' size='10'onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='rschdnbedb' value='$r[SellingChdNbedB]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='rsinfantb' value='$r[SellingInfantB]' size='10' onkeyup='isNumber(this)'></td></tr>
                         <tr><td BGCOLOR='#bef5c6'>Land Arrangement Only</td><td BGCOLOR='#bef5c6'><input type=text name='laadltwnb' value='$r[LAAdlTwnB]' size='10' onkeyup='isNumber(this)'></td></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='lachdtwnb' value='$r[LAChdTwnB]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='lachdxbedb' value='$r[LAChdXbedB]' size='10'onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='lachdnbedb' value='$r[LAChdNbedB]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#bef5c6'><input type=text name='lainfantb' value='$r[LAInfantB]' size='10' onkeyup='isNumber(this)'></td></tr> 
                         
                         <tr><th>$aliasc</th><th>ADULT</th><th>CHILD TWN</th><th>CHILD X BED</th><th>Child No bed</th><th>Infant</th></tr>
                         <tr><td BGCOLOR='#becaf5'>Tour</td><td BGCOLOR='#becaf5'><input type=text name='rsadultc' value='$r[SellingAdlTwnC]' size='10' onkeyup='isNumber(this)'></td></td>
                         <td BGCOLOR='#becaf5'><input type=text name='rschdtwnc' value='$r[SellingChdTwnC]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='rschdxbedc' value='$r[SellingChdXbedC]' size='10'onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='rschdnbedc' value='$r[SellingChdNbedC]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='rsinfantc' value='$r[SellingInfantC]' size='10' onkeyup='isNumber(this)'></td></tr>
                         <tr><td BGCOLOR='#becaf5'>Land Arrangement Only</td><td BGCOLOR='#becaf5'><input type=text name='laadltwnc' value='$r[LAAdlTwnC]' size='10' onkeyup='isNumber(this)'></td></td>
                         <td BGCOLOR='#becaf5'><input type=text name='lachdtwnc' value='$r[LAChdTwnC]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='lachdxbedc' value='$r[LAChdXbedC]' size='10'onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='lachdnbedc' value='$r[LAChdNbedC]' size='10' onkeyup='isNumber(this)'></td>
                         <td BGCOLOR='#becaf5'><input type=text name='lainfantc' value='$r[LAInfantC]' size='10' onkeyup='isNumber(this)'></td></tr>
                              
          </table>
          <table>
          <tr><th>Description</th><th>Curr</th><th>Nett</th><th>selling</th></tr>
          <tr><td>Airport Tax & Flight Insurance</td> <td>$r[SellingCurr]</td><td> <input type=text name='taxinsnett' size='12' value='$r[TaxInsNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='taxinssell' size='12' value='$r[TaxInsSell]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Single Supplement</td> <td>$r[SellingCurr]</td><td> <input type=text name='singlenett' size='12' value='$r[SingleNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='singlesell' size='12' value='$r[SingleSell]'onkeyup='isNumber(this)'></td></tr> 
          <tr><td>Visa </td><td><select name='visacurr' ";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo">";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($r[VisaCurr]==''){$r[VisaCurr]='IDR';}
            while($s=mysql_fetch_array($tampil)){
                  if($s[curr]==$r[VisaCurr]){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                     echo "<option value='$s[curr]'>$s[curr]</option>";   
                    }         
            }
    echo "</select></td><td> <input type=text name='visanett' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaNett]'onkeyup='isNumber(this)'></td><td><input type=text name='visasell' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaSell]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Visa 2</td><td><select name='visacurr2' ";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo">";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($r[VisaCurr2]==''){$r[VisaCurr2]='USD';}
            while($s=mysql_fetch_array($tampil)){
                  if($s[curr]==$r[VisaCurr2]){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                     echo "<option value='$s[curr]'>$s[curr]</option>";   
                    }         
            }
    echo "</select></td><td> <input type=text name='visanett2' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaNett2]'onkeyup='isNumber(this)'></td><td><input type=text name='visasell2' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$r[VisaSell2]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Domestic Airport Tax</td><td><select name='airtaxcurr' >";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($r[AirTaxCurr]==''){$atc='IDR';}else{$atc=$r[AirTaxCurr];} 
            while($s=mysql_fetch_array($tampil)){    
                     if($s[curr]==$atc){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                     echo "<option value='$s[curr]'>$s[curr]</option>";   
                    }
                
            }
          if($r[AirTaxNett]=='0' OR $r[AirTaxNett]==''){$airtaxnett='150000';}else {$airtaxnett=$r[AirTaxNett];}
          if($r[AirTaxSell]=='0' OR $r[AirTaxSell]==''){$airtaxsell='150000';}else {$airtaxsell=$r[AirTaxSell];}
    $BValue = $datatmr[TnC];  
    echo "</select></td><td> <input type=text name='airtaxnett' size='12' value='$airtaxnett' onkeyup='isNumber(this)'></td><td> <input type=text name='airtaxsell' size='12' value='$airtaxsell'onkeyup='isNumber(this)'></td></tr>
          </table>
          <table width=900 style='border: 0px solid #000000;'>
          <tr><th>Terms and Condition</th></tr>
          <tr><td style='border: 0px solid #000000;'>
          <textarea cols='50' id='tcb' name='tcb' rows='5'>$BValue</textarea>
          ";?>   
           <script type="text/javascript">
            //<![CDATA[

                CKEDITOR.replace( 'tcb', {
                    extraPlugins : 'autogrow',
                    autoGrow_maxHeight : 400,
                    removePlugins : 'resize'
                });

            //]]>
            </script>
          <?PHP echo"                                       
          </td></tr></table> 
          <center><input type='submit' name='submit' value='Save'>
          </form>";
    }
     break; 
     
case "editmsproducttmr":
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $thisyear = date("Y");
    $nextyear = $thisyear+1;
    $arrdate = date("d M Y", strtotime($r[DateTravelTo]));
    $depdate = date("d M Y", strtotime($r[DateTravelFrom]));
    echo "<h2>Edit Product</h2>
          <form method=POST name='example' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msproduct&act=update' enctype='multipart/form-data'>
          <input type=hidden name=id value='$r[IDProduct]'>
          <table>
             <tr><td>Season</td> <td>  
            <select name='season'>
            <option value='0' selected>- Select Season -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msseason where SeasonStatus='ACTIVE' ORDER BY SeasonName");
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
            <tr><td>Product Type</td> <td>$r[ProductType]  <input type='hidden' name='producttype' value='$r[ProductType]'></td></tr>
            <tr><td>Handle by</td>     <td>   
            <input type=radio name='department' value='LEISURE'";if($r[Department]=='LEISURE'){echo"checked";}echo">&nbsp;Leisure
            <input type=radio name='department' value='MINISTRY'";if($r[Department]=='MINISTRY'){echo"checked";}echo">&nbsp;Ministry  
            </td></tr>
            <input type='hidden' name='grouptype' value='$r[GroupType]'>
            <tr><td>Product For</td>  <td>$r[ProductFor]  <input type='hidden' name='productfor' value='$r[ProductFor]'></td></tr>
            <input type='hidden' name='productcode' value='$r[ProductCode]'>
            <tr><td>Date Travel</td> <td>From <font color='blue'>$depdate</font> <input type='hidden' name='datetravelfrom' size='10' value='$r[DateTravelFrom]' >  
          - To <font color='blue'>$arrdate</font> <input type='hidden' name='datetravelto' size='10' value='$r[DateTravelTo]' ></td></tr>
           <tr><td>Days of Travel</td> <td><input type='hidden' name='daystravel' id='daystravel' size='3' value='$r[DaysTravel]'>$r[DaysTravel] days</td></tr>   
          <tr><td>Flight</td> <td>  <input type='hidden' name='flight' value='$r[Flight]'>";
            $tampil=mysql_query("SELECT * FROM tour_msairlines where AirlinesStatus='ACTIVE' ORDER BY AirlinesID");
            while($s=mysql_fetch_array($tampil)){
                if($r[Flight]==$s[AirlinesID]){
                    echo "$s[AirlinesName] ($s[AirlinesID])";    
                }
            }
    echo "</select></td></tr>
          <tr><td>Tour Code</td> <td><input type='hidden' name='tourcode' id='tourcode' value='$r[TourCode]'>$r[TourCode]</td></tr>  
          <tr><td>Seat</td> <td><input type='hidden' name='seat' size='3' value='$r[Seat]'>$r[Seat] Pax <font color='red'>*<i>Not Include Infant and Tour leader</i></font></td></tr>
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
            <option value='USD'"; if($r[SellingCurr]=='USD'){echo"selected";}echo">USD</option>
            <option value='IDR'"; if($r[SellingCurr]=='IDR'){echo"selected";}echo">IDR</option>";
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
     
case "simpanair":
     $no=$_GET[no];
     $q=$_GET[q];
     $idprod=$_GET[prod];       
     $air=$_GET[air];
     $edit=mysql_query("UPDATE tour_msproductreq SET Flight = '$air'
                            WHERE IDProduct = '$idprod'");            
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproduct&act=quotationtmr&no=$no&q=$q'>";   
     break; 
     
case "productgrv":
    $thisyear = date("Y");
    $nextyear = $thisyear+1;
    $grvid=$_GET[id];
    $tmrq=mysql_query("SELECT * FROM tour_msgrv WHERE IDGrv = '$grvid'");
    $tmrr=mysql_fetch_array($tmrq);
    $GDOD = date('d M Y', strtotime($tmrr[GrvDateOfDep]));
    $GDOA = date('d M Y', strtotime($tmrr[GrvDateOfArr]));
    $DATECODE = date('md', strtotime($tmrr[GrvDateOfDep]));
    $diff = abs(strtotime($tmrr[GrvDateOfArr]) - strtotime($tmrr[GrvDateOfDep]));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));        
    $totday = $days + 1;
    $o=strlen($totday);
    if ($o==1){$days1="0$totday";}
    else {$days1 =$totday;}
    
    echo "<h2>GRV Dry Ticket </h2>
          <form name='example' method='POST' onsubmit='return validateFormGRV(this)' action='./aksi.php?module=msproduct&act=input' enctype='multipart/form-data'>
          <input type='hidden' name='tmrno' value='$tmrno'>
          <table>
          <tr><td>Season</td> <td>  
            <input type='hidden' name='season' value='$tmrr[Season]'><input type='hidden' name='year' value='$tmrr[Year]'>";
            $seasonb=$tmrr[Season];  
            $tampil=mysql_query("SELECT * FROM tour_msseason where SeasonStatus='ACTIVE' ORDER BY SeasonName");
            while($r=mysql_fetch_array($tampil)){
                if($seasonb==$r[SeasonName]){
                    echo "$r[SeasonName]";     
                }
                
            }
    echo " $tmrr[Year]</td></tr>
            <tr><td>Product Type</td> <td>
            <select name='producttype'>";
            $tampil=mysql_query("SELECT * FROM tour_msproducttype where ProducttypeName <>'' ORDER BY ProducttypeName ASC");
            $producttypeb='DRY TICKET'; 
            while($r=mysql_fetch_array($tampil)){
                if($producttypeb==$r[ProducttypeName]){
                    echo "<option value='$r[ProducttypeName]' selected>$r[ProducttypeName]</option>";    
                }
                
            }
    echo "</select></td></tr>
            <tr><td>Handle by</td>     <td>";   
            if($departmentb=='MINISTRY'){$b='checked';}else{$a='checked';}
    echo "<input type=radio name='department' value='LEISURE' $a>&nbsp;Leisure
            <input type=radio name='department' value='MINISTRY' $b>&nbsp;Ministry  
            </td></tr>
            <input type='hidden' name='grouptype' value='DRY TICKET'>
          <tr><td>BSO Handler</td>  <td>
          <select name='productfor'>
            <option value='ALL' selected>- ALL -</option>";        
            $tampil=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name");
            while($r=mysql_fetch_array($tampil)){
                if($prodforb==$r[office_code]){
                    echo "<option value='$r[office_code]' selected>$r[office_code]</option>";    
                }else{
                    echo "<option value='$r[office_code]'>$r[office_code]</option>";    
                }         
            }    
    echo "</select>
          </td></tr>
          <tr><td>Product Code/Name</td> <td>  <select name='productcode' onChange='turcode()'>";
            $tampil=mysql_query("SELECT * FROM tour_msproductcode ORDER BY ProductcodeName");
            while($r=mysql_fetch_array($tampil)){                     
                if('TIX'==$r[ProductcodeName]){
                    echo "<option value='$r[ProductcodeName]' selected>$r[ProductcodeName] - $r[Productcode]</option>";   
                }           
            }
    echo "</select></td></tr>    
            <tr><td>Date of Service</td> <td>From <input type='hidden' value='$tmrr[GrvDateOfDep]'  name='datetravelfrom' size='10'>
           <font color='red'>$GDOD</font>
          - To <input type='hidden' value='$tmrr[GrvDateOfArr]' name='datetravelto' size='10'>
           <font color='red'>$GDOA</font></td></tr>
           <tr><td>Number of Days</td> <td><input type='hidden' name='daystravel' value='$days1' size='3'>$totday days</td></tr>   
          <tr><td>Flight</td> <td>  <select name='flight' onChange='turcode()'>
            <option value='0' selected>- Select Airlines -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msairlines where AirlinesStatus='ACTIVE' ORDER BY AirlinesID");
            $flightb=$tmrr['GrvAirlines'];
            while($r=mysql_fetch_array($tampil)){
                if($flightb==$r[AirlinesID]){
                    echo "<option value='$r[AirlinesID]' selected>$r[AirlinesID] - $r[AirlinesName]</option>";    
                }
                
            }
    echo "</select></td></tr>
          <tr><td>Tour Code</td> <td><input type=text size='50' name='tourcode' id='tourcode' value='TIX-$days1 $DATECODE/$flightb' onBlur='cektur()'><div  id='status'></div></td></tr> 
          <tr><td>Seat</td> <td><input type=text value='' name='seat' size='3' onkeyup='isNumber(this)' onBlur='cektur()'> Pax <font color='red'>*<i>Not Include Infant and Tour leader</i></font></td></tr>
          <tr><td>Tour Leader</td> <td>                               
          <input type='hidden' name='tourleaderinc' value='NO'>No  
          </td></tr>
          <tr><td>Insurance</td> <td>";                
    echo "<input type='hidden' name='insurance' value='NOT INCLUDE' >Not Include  
          </td></tr>
          <tr><td>Visa</td> <td>   
          <input type='hidden' name='visa' value='NOT INCLUDE'>Not Include
          </td></tr>
          <tr><td></td><td><select name='embassy01' disabled>
            <option value='0' selected>- Embassy 01 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[CountryID]'>$r[Country]</option>";
            }
    echo "</select>&nbsp&nbsp <select name='embassy03' disabled >
            <option value='0' selected>- Embassy 03 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[CountryID]'>$r[Country]</option>";
            }
    echo "</select>&nbsp&nbsp <select name='embassy05' disabled >
            <option value='0' selected>- Embassy 05 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[CountryID]'>$r[Country]</option>";
            }
    echo "</select></td></tr>
          <tr><td></td><td><select name='embassy02' disabled >
            <option value='0' selected>- Embassy 02 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[CountryID]'>$r[Country]</option>";
            }
    echo "</select>&nbsp&nbsp <select name='embassy04' disabled >
            <option value='0' selected>- Embassy 04 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[CountryID]'>$r[Country]</option>";
            }
    echo "</select></td></tr>
            <tr><td>Quotation </td><td> Currency <select name='quotationcurr' onchange='oncurr()'>";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            while($s=mysql_fetch_array($tampil)){
                if($s[curr]=='USD'){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";    
                } else {
                     echo "<option value='$s[curr]' >$s[curr]</option>";
                }
            }
    echo "</select></td></tr> 
            <tr><td>Selling </td><td>Currency <select name='sellingcurr' onchange='oncurr()'>
                     <option value='USD' selected>USD</option>   
                     <option value='IDR' >IDR</option>
          </select>&nbsp Operator <select name='sellingoperator'>
                                <option value='*'> X </option>
                                <option value='/' > : </option></select>&nbsp Rate <input type='text' name='sellingrate' size='3' value='1' onkeyup='isNumber(this)' disabled></td></tr>     
            <tr><td>Attachment</td><td><input type='file' name='upload'>  </td></tr>
            <tr><td>Remarks</td><td><textarea name='remarks' cols='50' rows='3'>"; if(isset($_POST['redirected'])) { echo $_POST['remarks']; } echo"</textarea>  </td></tr>
             <input type='hidden' name='status' value='NOT PUBLISHED'>  
          <tr><td colspan=2><center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table> </form><br><br>";
     break;                 
}
?>
