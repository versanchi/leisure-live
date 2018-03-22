<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>         
<script type="text/javascript" src="../head/editable-select.js"></script> 
<script language="JavaScript"  type="text/javascript">   
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
function delfile(ID, SUPPLIER) {
    if (confirm("Are you sure you want to delete " + SUPPLIER +"  "))
    {
        window.location.href = '?module=searchbooking&act=deletedetail&id=' + ID  ;

    }
}
function delattach(ID, ATTACHFILE)
{
if (confirm("Are you sure you want to delete " + ATTACHFILE +" "))
{
 window.location.href = '?module=searchbooking&act=delattach&id=' + ID;
 
} 
}
function publishprod(ID)
{
 window.location.href = '?module=searchbooking&act=publishsearchbooking&id=' + ID ;
}
function ceking(ID)
{

 window.location.href = '?module=searchbooking&act=cekseat&id=' + ID  ;
 
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
  reason += validateEmpty(theForm.bookerstelp); 
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
      $hariini = date("Y-m-d ");
      $nama=$_GET['nama'];
      $nama2=$_GET['nama2'];
      $opnama=$_GET['opnama'];
      $opnama2=$_GET['opnama2'];
      $qnama=str_replace(" ", "%", $nama);
      $qnama2=str_replace(" ", "%", $nama2);
    echo "<h2>PRODUCT SEARCH</h2>
          Search By :  
          <form method='get' action='media.php?'>
                <input type=hidden name=module value='searchbooking'>
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
              <input type=submit name='oke' size='20'value='Search'>
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
          /*$filt=mysql_query("SELECT * FROM tbl_msemployee
                                left join tbl_msoffice on tbl_msoffice.office_id=tbl_msemployee.office_id
                                WHERE tbl_msemployee.employee_code = '$_SESSION[employee_code]'");
            $filter=mysql_fetch_array($filt);*/
            $team=$_SESSION[employee_office];
            
          if($opnama=='' and $opnama2<>''){
              if($_SESSION[category]=='SYSTEM DEVELOPER' or $_SESSION[category]=='OPERATION' or $_SESSION[category]=='PRODUCT'){
              $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama2 LIKE '%$qnama2%'    
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $posisi,$batas");    
              }else{  
              $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama2 LIKE '%$qnama2%'        
                                and (ProductFor = '$team' or ProductFor = 'ALL')  
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $posisi,$batas");}
          }
          else if($opnama2=='' and $opnama<>''){
              if($_SESSION[category]=='SYSTEM DEVELOPER' or $_SESSION[category]=='OPERATION' or $_SESSION[category]=='PRODUCT'){
              $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama LIKE '%$qnama%'     
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $posisi,$batas");    
              }else{
              $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama LIKE '%$qnama%'         
                                and (ProductFor = '$team' or ProductFor = 'ALL')  
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $posisi,$batas");}
          }
          else if($opnama2<>'' and $opnama<>''){
              if($_SESSION[category]=='SYSTEM DEVELOPER' or $_SESSION[category]=='OPERATION' or $_SESSION[category]=='PRODUCT'){
              $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama LIKE '%$qnama%'
                                AND $opnama2 LIKE '%$qnama2%'        
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $posisi,$batas");    
              }else{
              $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama LIKE '%$qnama%'
                                AND $opnama2 LIKE '%$qnama2%'          
                                and (ProductFor = '$team' or ProductFor = 'ALL')   
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $posisi,$batas");}
          }
          else if($optnama=='' and $optnama2==''){
              if($_SESSION[category]=='SYSTEM DEVELOPER' or $_SESSION[category]=='OPERATION' or $_SESSION[category]=='PRODUCT'){
              $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE Status = 'off'                      
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $posisi,$batas");    
              }else{
              $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE Status = 'off'                      
                                and (ProductFor = '$team' or ProductFor = 'ALL')   
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $posisi,$batas");}
          }
          
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            if($grouptype=='CONSORTIUM'){echo"<font color=red>*please contact operation for seat availability</font>";}
            echo "  <table>   
                    <tr><th>no</th><th>product</th><th>tour code</th><th>dest</th><th>days</th><th>departure</th><th>flight</th><th>disc</th><th>seat</th><th>deposit</th><th>available</th><th>inquiry</th>";
                  if($_SESSION[ltm_authority]=='PO MANAGER' OR $_SESSION[ltm_authority]=='DEVELOPER'){echo"<th>option</th>";}
            echo "</tr>";
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
                    $mari=mysql_query("SELECT count(IDBookers)as wow FROM tour_msbooking where TourCode = '$data[TourCode]' and Year = '$data[Year]' and Status = 'VOID' ");
                    $tung=mysql_fetch_array($mari);
                    $maritot=mysql_query("SELECT count(tour_msbookingdetail.IDDetail)as tot FROM tour_msbookingdetail 
                                        left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                        where tour_msbookingdetail.TourCode = '$data[TourCode]' and tour_msbookingdetail.Gender <>'INFANT'
                                        AND tour_msbookingdetail.Status<>'CANCEL' 
                                        AND tour_msbooking.Status='ACTIVE'
                                        AND tour_msbooking.Year='$data[year]' ");
                    $tungtot=mysql_fetch_array($maritot);
                    $totl=$tungtot[tot]+1;
                    $d = mysql_query("SELECT * FROM tour_msdiscount 
                                    left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct      
                                    WHERE tour_msproduct.TourCode = '$data[TourCode]' and tour_msproduct.Year = '$data[Year]' and tour_msproduct.Status <> 'VOID' and tour_msdiscount.Status='ACTIVE'");
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
                    if($data[StatusProduct]=='CLOSE'){$status="<font color=red><b>CLOSE</b></font>";$tom='disabled';$warna="BGCOLOR='#f5bebe'";}
                    else if($data[StatusProduct]=='OPEN'){$status="<font color=green><b>OPEN</b></font>";$tom='enabled';$warna="BGCOLOR='#ffffff'";}
                     $dtf = date("d-m-Y", strtotime($data[DateTravelFrom]));
               echo "<tr><td $warna>$no</td>
                     <td $warna>$data[ProductCode] - $data[Productcode]</td>                                   
                     <td $warna><a href=?module=searchbooking&group=$grup&act=show&id=$data[IDProduct]>$data[TourCode]</a></td>   
                     <td $warna>$data[Destination]</td>
                     <td $warna><center>$data[DaysTravel]</td>
                     <td $warna>$dtf</td>
                     <td $warna><center>$data[Flight]</td>
                     <td $warna><center>$diskon</td>
                     <td $warna><center>$data[Seat]</td>
                     <td $warna><center><a href=?module=group&act=showdeposit&id=$data[IDProduct]>$data[SeatDeposit]</a></td>
                     <td $warna><center>$data[SeatSisa]</td>
                     <td $warna><center>$data[SeatInquiry]</td>";
                if($_SESSION[ltm_authority]=='PO MANAGER' OR $_SESSION[ltm_authority]=='DEVELOPER'){
                    if($data[DateTravelFrom]< $hariini AND $data[Status]<>'VOID'){$void='enabled';}else{$void='disabled';}
                    echo"<td $warna><center><input type='button' value='VOID' onclick=\"javascript:delfile('$data[IDProduct]', '$data[TourCode]')\" $void></td>";
                }
                echo "</tr>";
                      $no++;
                    }
                    echo "</table>";
                    
                    // Langkah 3            
                           
                      if($opnama=='' and $opnama2<>''){
                          if($_SESSION[category]=='SYSTEM DEVELOPER' or $_SESSION[category]=='OPERATION' or $_SESSION[category]=='PRODUCT'){
                          $tampil2="SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama2 LIKE '%$qnama2%'                     
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC";
                          }else{
                          $tampil2="SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama2 LIKE '%$qnama2%'     
                                and (ProductFor = '$team' or ProductFor = 'ALL')  
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC";    
                          }}
                      else if($opnama2=='' and $opnama<>''){
                          if($_SESSION[category]=='SYSTEM DEVELOPER' or $_SESSION[category]=='OPERATION' or $_SESSION[category]=='PRODUCT'){
                              $tampil2="SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama LIKE '%$qnama%'                        
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC";}
                          else{
                          $tampil2="SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama LIKE '%$qnama%'        
                                and (ProductFor = '$team' or ProductFor = 'ALL')    
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC";    
                          }}
                      else if($opnama2<>'' and $opnama<>''){
                          if($_SESSION[category]=='SYSTEM DEVELOPER' or $_SESSION[category]=='OPERATION' or $_SESSION[category]=='PRODUCT'){
                              $tampil2="SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama LIKE '%$qnama%'
                                AND $opnama2 LIKE '%$qnama2%'                       
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC";}
                          else{
                                $tampil2="SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama LIKE '%$qnama%'
                                AND $opnama2 LIKE '%$qnama2%'         
                                and (ProductFor = '$team' or ProductFor = 'ALL')   
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC";}    
                                }   
          else if($optnama=='' and $optnama2==''){
          $tampil2="SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE Status = 'off'    
                                and DateTravelFrom >= '$hariini' 
                                and (ProductFor = '$team' or ProductFor = 'ALL') 
                                and GroupType = '$grouptype' 
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC";}
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=searchbooking";
                    $namas=str_replace(" ", "+", $nama);
                    $namas2=str_replace(" ", "+", $nama2);
                    // Link ke halaman sebelumnya (previous)
                    echo "<center><div id='paging'>";
                    if ($halaman >1) {
                        $previous = $halaman-1;
                        echo "<a href=$file&halaman=1&group=$grup&opnama=$opnama&nama=$namas&opnama2=$opnama2&nama2=$namas2&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&group=$grup&opnama=$opnama&nama=$namas&opnama2=$opnama2&nama2=$namas2&oke=$oke> < Previous</a> | ";
                    } else {
                        echo "<< First | < Previous | ";
                    }
                    // Tampilkan link halaman 1,2,3 ... modifikasi ala google
                    // Angka awal
                    $angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
                    for ($i=$halaman-2; $i<$halaman; $i++) {
                        if ($i < 1 )
                            continue;
                        $angka .= "<a href=$file&halaman=$i&group=$grup&opnama=$opnama&nama=$namas&opnama2=$opnama2&nama2=$namas2&oke=$oke>$i</a> ";
                    }
                    // Angka tengah
                    $angka .= " <b>$halaman</b> ";
                    for ($i=$halaman+1; $i<($halaman+3); $i++) {
                        if ($i > $jmlhalaman)
                            break;
                        $angka .= "<a href=$file&halaman=$i&group=$grup&opnama=$opnama&nama=$namas&opnama2=$opnama2&nama2=$namas2&oke=$oke>$i</a> ";    
                    }
                    // Angka akhir
                    $angka .= ($halaman+2<$jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&group=$grup&opnama=$opnama&nama=$namas&opnama2=$opnama2&nama2=$namas2&oke=$oke>$jmlhalaman</a> |" : " ");
                    // Cetak angka seluruhnya (awal, tengah, akhir)
                    echo "$angka";
                    // Link ke halaman berikutnya (Next)
                    if ($halaman < $jmlhalaman) {
                        $next = $halaman+1;
                        echo "<a href=$file&halaman=$next&group=$grup&opnama=$opnama&nama=$namas&opnama2=$opnama2&nama2=$namas2&oke=$oke> Next ></a> |
                              <a href=$file&halaman=$jmlhalaman&group=$grup&opnama=$opnama&nama=$namas&opnama2=$opnama2&nama2=$namas2&oke=$oke> Last >></a> ";
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

  case "show":
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]' AND Status <>'VOID'");
    $r=mysql_fetch_array($edit);
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
          <table class='bordered'>
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
          }echo"</td></tr>";
         $VisaSell=$r[VisaSell];
         $VisaSell2=$r[VisaSell2];
         $VisaSell3=$r[VisaSell3];
         $VisaSell4=$r[VisaSell4];
         $VisaSell5=$r[VisaSell5];
         if($r[Embassy01]<>'0')
         {   $Qvisa=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$r[Embassy01]'");
             $Dvisa=mysql_fetch_array($Qvisa);
             echo"<tr><td colspan=2>VISA $Dvisa[Country]</td><td colspan=5>IDR. ".number_format($VisaSell, 0, '', ',');echo"</td></tr>";
         }
         if($r[Embassy02]<>'0')
         {   $Qvisa2=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$r[Embassy02]'");
             $Dvisa2=mysql_fetch_array($Qvisa2);
             echo"<tr><td colspan=2>VISA $Dvisa2[Country]</td><td colspan=5>IDR. ".number_format($VisaSell2, 0, '', ',');echo"</td></tr>";
         }
         if($r[Embassy03]<>'0')
         {   $Qvisa3=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$r[Embassy03]'");
             $Dvisa3=mysql_fetch_array($Qvisa3);
             echo"<tr><td colspan=2>VISA $Dvisa3[Country]</td><td colspan=5>IDR. ".number_format($VisaSell3, 0, '', ',');echo"</td></tr>";
         }
         if($r[Embassy04]<>'0')
         {   $Qvisa4=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$r[Embassy04]'");
             $Dvisa4=mysql_fetch_array($Qvisa4);
             echo"<tr><td colspan=2>VISA $Dvisa4[Country]</td><td colspan=5>IDR. ".number_format($VisaSell4, 0, '', ',');echo"</td></tr>";
         }
         if($r[Embassy05]<>'0')
         {   $Qvisa5=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$r[Embassy05]'");
             $Dvisa5=mysql_fetch_array($Qvisa5);
             echo"<tr><td colspan=2>VISA $Dvisa5[Country]</td><td colspan=5>IDR. ".number_format($VisaSell5, 0, '', ',');echo"</td></tr>";
         }
     echo"<tr><td colspan=2>Domestic Airport Tax</td><td colspan=5>";if($r[AirTaxSell]==0){echo"INCLUDE";}else{echo"$r[AirTaxCurr]. ".number_format($r[AirTaxSell], 2, ',', '.');}echo"</td></tr>
            <tr><td colspan=2>Airport Tax & Flight Insurance</td><td colspan=5>$r[SellingCurr]. ".number_format($r[TaxInsSell], 2, ',', '.');echo"</td></tr>
            <tr><td colspan=2>Single Supplement</td><td colspan=5>$r[SellingCurr]. ".number_format($r[SingleSell], 2, ',', '.');echo"</td></tr>
            <tr><td colspan=2>Seat</td> <td colspan=5>$r[Seat] Pax <font color='red'>*<i>Not Include Infant and Tour leader</i></font></td></tr>";          
            $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[AttachmentFile]) ) ) );  
    echo"   <tr><td colspan=2>Attachment</td><td colspan=5>";
            //if($r[AttachmentFile]==''){
            //    echo"NONE";
            //}else {
                echo"<input type='button' value='VIEW' onclick=window.open('media.php?module=msitin&act=showitin&id=$r[IDProduct]')>";
            //}
    echo"   </td></tr>
            <tr><td colspan=2>Remarks</td><td colspan=5>$r[Remarks]</td></tr>   
            <tr><td colspan=2>TourLeader</td><td colspan=5>$r[TourLeader]</td></tr>
            <tr><td colspan=7><center>Selling Price in $r[SellingCurr]</td></tr>    
            <tr><th></th><th width=80>ADULT</th><th width=80>CHILD TWN</th><th width=80>CHILD X BED</th><th width=80>Child No bed</th><th width=80>Infant</th><th width=80>Tax</th></tr>
                <tr><th>Tour</th>
                    <td><center>".number_format($r[SellingAdlTwn], 0, '', ',');echo"</td></td>
                    <td><center>".number_format($r[SellingChdTwn], 0, '', ',');echo"</td>
                    <td><center>".number_format($r[SellingChdXbed], 0, '', ',');echo"</td>
                    <td><center>".number_format($r[SellingChdNbed], 0, '', ',');echo"</td>
                    <td><center>".number_format($r[SellingInfant], 0, '', ',');echo"</td>
                    <td><center>".number_format($r[TaxInsSell], 0, '', ',');echo"</td>
                </tr>
                <tr><th>LA Only</th>
                    <td><center>".number_format($r[LAAdlTwn], 0, '', ',');echo"</td></td>
                    <td><center>".number_format($r[LAChdTwn], 0, '', ',');echo"</td>
                    <td><center>".number_format($r[LAChdXbed], 0, '', ',');echo"</td>
                    <td><center>".number_format($r[LAChdNbed], 0, '', ',');echo"</td>
                    <td><center>".number_format($r[LAInfant], 0, '', ',');echo"</td>
                    <td></td>
                </tr>   
          <tr><th></th><th>disc</th><th>seat</th><th>deposit</th><th>available</th><th>inquiry</th><th>cancel</th></tr>
          <tr><th>Tour</th><td><center>$diskon</td>
                     <td><center>$r[Seat]</td>
                     <td><center>$r[SeatDeposit]</td>
                     <td><center>$r[SeatSisa]</td>
                     <td><center>$r[SeatInquiry]</td>
                     <td><center>$tung[wow]</td></tr>   
          </table>        
          <center><input type=button value=Close onclick=location.href='?module=searchbooking&group=$_GET[group]'>
          </form><br><br>";
     break;
  
  case "deviasi":                                                                      
          $cari=mysql_query("SELECT tour_devbooking.DevNo,tour_devbooking.BookingID,tour_devbooking.Status,tour_msbooking.TourCode,tour_msbooking.TCName,tour_msbooking.TCDivision FROM tour_devbooking
                                left join tour_msbooking on tour_msbooking.BookingID = tour_devbooking.BookingID
                                WHERE tour_devbooking.BookingID = '$_GET[id]'");
          $rcari=mysql_num_rows($cari);
    
    echo "<h2>Deviasi Request</h2>
          <input type=button value='New Deviasi' onclick=location.href='?module=searchbooking&act=deviasireq&id=$_GET[id]'>";
          
          if($rcari==0){
            echo"<center>DEVIASI HAS NOT BEEN CREATED</center><br>";    
          }else{
            $no=1;
            echo"<table>
            <tr><th>no</th><th>Deviasi No</th><th>booking ID</th><th>TourCode</th><th>TC Name</th><th>deviasi status</th><th>action</th>";
            while($s=mysql_fetch_array($cari)){ 
            echo "<tr><td>$no</td><td>$s[DevNo]</td><td>$s[BookingID]</td><td>$s[TourCode]</td><td>$s[TCName]</td><td>$s[Status]</td><td><input type=button value='View' onclick=location.href='?module=searchbooking&act=deviasishow&dev=$s[DevNo]' ";if($s[Status]=='VOID'){echo"disabled";}echo"></td></tr>";
            $no++;
            }
          }echo"</table>
    <center><input type=button value='Back' onclick=self.history.back()><br><br>";
     break;
     
  case "deviasireq":                                                                      
    $edit=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $qdev=mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r[TourCode]' and Year= '$r[Year]'");
    $querydev=mysql_fetch_array($qdev);
    $qflight=mysql_query("SELECT * FROM tour_msprodflight WHERE IDProduct = '$querydev[IDProduct]'");
    
    echo "<h2>Deviasi Request #$_GET[id]</h2>";
          $cari=mysql_query("SELECT * FROM tour_msbookingdetail where BookingID = '$r[BookingID]' AND Status <> 'CANCEL' AND InfoDeviasi ='' ORDER BY IDDetail ASC");
          $rcari=mysql_num_rows($cari);
          if($rcari==0){
            echo"<center>DEVIASI HAS BEEN CREATED</center><br><center><input type=button value='Close' onclick='self.history.back()'><br><br>";    
          }else{echo"
          <form name='example' method='POST' onsubmit='return validateSwitch(this)' action='./aksi.php?module=searchbooking&act=devreq' >  
          <font size=2>Tour Code : $r[TourCode]</font>
          <table><input type='hidden' name='id' value='$r[BookingID]'>
          <tr><th width='200'>Passanger Name</th><th width='100'>Passport No</th></tr>";
            $no=1;
            while($s=mysql_fetch_array($cari)){ 
                    echo "<tr><td><input type='checkbox' name='listing[]' id='listing$no' value='$s[IDDetail]'> $s[Title] $s[PaxName]</td><td>$s[PassportNo]</td></tr>";
            $no++;
            }
    echo "</table>
          <font size=2><u>EXTEND / DEVIASI FROM :</u></font><br>
          <table>
          <tr><th colspan=2>flight</th><th colspan=2>Departure</th><th colspan=2>Arrival</th></tr>
          <tr><th width=75>number</th><th width=50>date</th><th width=100>from</th><th width=50>time</th><th width=100>to</th><th width=50>time</th></tr>";     
          while($isiflight=mysql_fetch_array($qflight)){ 
    echo "<tr><td>$isiflight[AirCode]</td><td><center>$isiflight[AirDate] $isiflight[AirMonth]</td><td>$isiflight[AirRouteDep]</td><td><center>$isiflight[AirTimeDep]</td><td>$isiflight[AirRouteArr]</td><td><center>$isiflight[AirTimeArr]</td></tr>";
          }
          echo"</table>
          <table>
          <tr><th width='70'></th><th width='150'>main</th><th width='150'>option 1</th><th width='150'>option 2</th></tr>
          <tr><td>Ticket</td><td><textarea name='ticket1' cols='40' rows='3'></textarea></td><td><textarea name='ticket2' cols='40' rows='3'></textarea></td><td><textarea name='ticket3' cols='40' rows='3'></textarea></td></tr>
          <tr><td>Others</td><td><textarea name='others1' cols='40' rows='3'></textarea></td><td><textarea name='others2' cols='40' rows='3'></textarea></td><td><textarea name='others3' cols='40' rows='3'></textarea></td></tr>
          </table>
          <center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick='self.history.back()'>
          </form><br><br>";}
     break;
     
  case "deviasishow":                                                                      
          $edit=mysql_query("SELECT tour_devbooking.Status,tour_devbooking.DevCurr,tour_devbooking.DevPrice,tour_devbooking.Result,tour_msbooking.TourCode,tour_msbooking.Year,
                            tour_devbooking.Ticket1,tour_devbooking.Ticket2,tour_devbooking.Ticket3,tour_devbooking.Others1,tour_devbooking.Others2,tour_devbooking.Others3 FROM tour_devbooking 
                        left join tour_msbooking on tour_msbooking.BookingID = tour_devbooking.BookingID
                        WHERE DevNo = '$_GET[dev]'");
          $r=mysql_fetch_array($edit);
          $qdev=mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r[TourCode]' and Year= '$r[Year]'");
          $querydev=mysql_fetch_array($qdev);
          $qflight=mysql_query("SELECT * FROM tour_msprodflight WHERE IDProduct = '$querydev[IDProduct]'");
    echo "<h2>Deviasi Detail #$_GET[dev]</h2>";
          $cari=mysql_query("SELECT * FROM tour_devbookingdetail where DevNo = '$_GET[dev]' ORDER BY IDDev ASC");
          echo"
          <form name='example' method='POST' onsubmit='return validateSwitch(this)' action='./aksi.php?module=searchbooking&act=devvoid' >  
          <font size=2>Tour Code : $r[TourCode]</font>
          <table><input type='hidden' name='id' value='$_GET[dev]'>
          <tr><th width='200'>Passanger Name</th><th width='100'>Passport No</th></tr>";
            $no=1;
            while($s=mysql_fetch_array($cari)){ 
                    echo "<tr><td>$s[Title] $s[PaxName]</td><td>$s[PassportNo]</td></tr>";
            $no++;
            }
    echo "</table>
          <font size=2><u>EXTEND / DEVIASI FROM :</u></font><br>
          <table>
          <tr><th colspan=2>flight</th><th colspan=2>Departure</th><th colspan=2>Arrival</th></tr>
          <tr><th width=75>number</th><th width=50>date</th><th width=100>from</th><th width=50>time</th><th width=100>to</th><th width=50>time</th></tr>";     
          while($isiflight=mysql_fetch_array($qflight)){ 
    echo "<tr><td>$isiflight[AirCode]</td><td><center>$isiflight[AirDate] $isiflight[AirMonth]</td><td>$isiflight[AirRouteDep]</td><td><center>$isiflight[AirTimeDep]</td><td>$isiflight[AirRouteArr]</td><td><center>$isiflight[AirTimeArr]</td></tr>";
          }$harga=number_format($r[DevPrice], 0, '', '.');
          if($r[Result]=='1'){$p1clr1="<font color=red>";$p1clr2=" ($r[DevCurr] $harga)</font>";}
          else if($r[Result]=='2'){$p2clr1="<font color=red>";$p2clr2=" ($r[DevCurr] $harga)</font>";}
          else if($r[Result]=='3'){$p3clr1="<font color=red>";$p3clr2=" ($r[DevCurr] $harga)</font>";}
          echo"</table>
          <table>
          <tr><th width='70'></th>
          <th width='150'>$p1clr1 main$p1clr2</th>
          <th width='150'>$p2clr1 option 1$p2clr2</th>
          <th width='150'>$p3clr1 option 2$p3clr2</th></tr>
          <tr><td>Ticket</td><td><textarea name='ticket1' cols='40' rows='3'>$r[Ticket1]</textarea></td><td><textarea name='ticket2' cols='40' rows='3'>$r[Ticket2]</textarea></td><td><textarea name='ticket3' cols='40' rows='3'>$r[Ticket3]</textarea></td></tr>
          <tr><td>Others</td><td><textarea name='others1' cols='40' rows='3'>$r[Others1]</textarea></td><td><textarea name='others2' cols='40' rows='3'>$r[Others2]</textarea></td><td><textarea name='others3' cols='40' rows='3'>$r[Others3]</textarea></td></tr>
          </table>";   
    echo "<center><input type='submit' name='submit' value='Void' ";if($r[Status]=='VOID' or $r[Result]<>''){echo"disabled";}echo">
                            <input type=button value=Cancel onclick='self.history.back()'>
          </form><br><br>";
     break;

  case "deletedetail":
        $editpertama = mysql_query("UPDATE tour_msproduct set SeatDeposit='0',SeatSisa=Seat,Status='VOID' WHERE IDProduct = '$_GET[id]'");
        //----   void bookingan
        $mulai = mysql_query("SELECT * FROM tour_msbooking WHERE IDTourcode = '$_GET[id]'");
        $deteksi = mysql_num_rows($mulai);
        if ($deteksi > 0) {
            while ($autovoid = mysql_fetch_array($mulai)) {
                $updets = mysql_query("UPDATE tour_msbooking set Status='VOID',ReasonCancel='PRODUCT VOID',CancelBy='System',CancelDate='$today' WHERE BookingID = '$autovoid[BookingID]'");
                $edit = mysql_query("UPDATE tour_msbookingdetail set Status = 'CANCEL',
                                                        Price='0',
                                                        AddCharge='0',
                                                        SubTotal='0'
                                                        WHERE BookingID = '$autovoid[BookingID]'");

                $edit1 = mysql_query("SELECT count(IDDetail)as tota,BookingID,TourCode FROM tour_msbookingdetail WHERE BookingID ='$autovoid[BookingID]' and Status <> 'CANCEL' and Gender <>'INFANT' GROUP BY BookingID");
                $r2 = mysql_fetch_array($edit1);
                $upbook1 = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$autovoid[BookingID]'");
                $upbook = mysql_fetch_array($upbook1);
                if ($upbook[SFID] <> '') {
                    $editptes = mssql_query("UPDATE dbo.SalesFolderDetails set StatusLTM = 'CANCEL'
                                                        WHERE ConfirmationNo = '$r2[BookingID]' ");
                }
                $Description = "Cancel Booking $r2[BookingID]";
                mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('System',
                                   '$Description',
                                   '$today')");
                $ceking = mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$autovoid[BookingID]'");
                $cek = mysql_fetch_array($ceking);
                $autocek = mysql_query("UPDATE tour_msbooking set Duplicate='NO' WHERE DepositNo = '$cek[DepositNo]' and Duplicate='YES' order by IDBookers ASC limit 1");
                //update PTES

                //if(($offgroup =='PANORAMA TOURS' AND !preg_match('/LTM/',$EmpOff)) OR $offgroup <> 'PANORAMA WORLD' OR $offgroup <> 'SISTER COMPANY'){
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
            }
        }
        $cari1 = mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]' ");
        $ulang = mysql_fetch_array($cari1);
        $updet = mysql_query("UPDATE tour_msproduct set SeatDeposit = '0',
                                                        SeatSisa='$ulang[Seat]'
                                                        WHERE IDProduct = '$ulang[IDProduct]'");
        //edit product use grv
        $editgrv = mysql_query("SELECT * from tour_msproductpnr WHERE PnrProd = '$_GET[id]'");
        $grv = mysql_fetch_array($editgrv);
        $cekgrv = mysql_query("SELECT * FROM tour_msgrv where IDGrv = '$grv[GrvID]' ");
        $hslcek = mysql_fetch_array($cekgrv);
        $kurang = $hslcek[ProductUse] - 1;
        mysql_query("UPDATE tour_msgrv SET ProductUse  = '$kurang'
                           WHERE IDGrv = '$grv[GrvID]'");
        $prodid = $r2[PnrProd];
        $edit = mysql_query("DELETE from tour_msproductpnr WHERE PnrID = '$grv[PnrID]'");

        $Description = "VOID Product $_GET[id]";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('$EmpName',
                                   '$Description',
                                   '$today')");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=searchbooking'>";
        break;
}
?>
