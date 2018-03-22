<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>
<script type="text/javascript" src="../head/editable-select.js"></script> 
<script language="JavaScript"  type="text/javascript">   
function delfile(ID, SUPPLIER, cat,no)
{
if (confirm("Are you sure you want to delete " + SUPPLIER +" ("+ cat +") "))
{
 window.location.href = '?module=msproduct&act=deletedetail&id=' + ID + '&no=' + no ;
 
} 
}
function delattach(ID, ATTACHFILE)
{
if (confirm("Are you sure you want to delete " + ATTACHFILE +" "))
{
 window.location.href = '?module=msproduct&act=delattach&id=' + ID;
 
} 
}
function publishprod(ID)
{
 window.location.href = '?module=msproduct&act=publishmsproduct&id=' + ID ;
}
function UpdateProfita() {                               
    var a = eval(calculate.sadult.value);   
    var b = eval(calculate.tadult.value);
    var n = calculate.padult;     
    var x = a - b ;   
    n.value = x;      
    if(a < b){
    n.style.backgroundColor = "red"; }
    else {n.style.backgroundColor = "white";}   
   if (isNaN(n.value)) {
      n.value=0   
    } 
}
function UpdateProfitct() {                               
    var a = eval(calculate.schdtwn.value);   
    var b = eval(calculate.tchdtwn.value);
    var n = calculate.pchdtwn;     
    var x = a - b ;   
    n.value = x;      
    if(a < b){
    n.style.backgroundColor = "red"; }
    else {n.style.backgroundColor = "white";}   
   if (isNaN(n.value)) {
      n.value=0   
    } 
}
function UpdateProfitcn() {                               
    var a = eval(calculate.schdnbed.value);   
    var b = eval(calculate.tchdnbed.value);
    var n = calculate.pchdnbed;     
    var x = a - b ;   
    n.value = x;      
    if(a < b){
    n.style.backgroundColor = "red"; }
    else {n.style.backgroundColor = "white";}   
   if (isNaN(n.value)) {
      n.value=0   
    }                                                
}
function UpdateProfitcx() {                               
    var a = eval(calculate.schdxbed.value);   
    var b = eval(calculate.tchdxbed.value);
    var n = calculate.pchdxbed;     
    var x = a - b ;   
    n.value = x;      
    if(a < b){
    n.style.backgroundColor = "red"; }
    else {n.style.backgroundColor = "white";}   
   if (isNaN(n.value)) {
      n.value=0   
    } 
}
function UpdateProfits() {                               
    var a = eval(calculate.ssingle.value);   
    var b = eval(calculate.tsingle.value);
    var n = calculate.psingle;     
    var x = a - b ;   
    n.value = x;      
    if(a < b){
    n.style.backgroundColor = "red"; }
    else {n.style.backgroundColor = "white";}   
   if (isNaN(n.value)) {
      n.value=0   
    }                                              
}
function UpdateProfiti() {                               
    var a = eval(calculate.sinfant.value);   
    var b = eval(calculate.tinfant.value);
    var n = calculate.pinfant;     
    var x = a - b ;   
    n.value = x;      
    if(a < b){
    n.style.backgroundColor = "red"; }
    else {n.style.backgroundColor = "white";}   
   if (isNaN(n.value)) {
      n.value=0   
    }                                                 
}
function offemb()
{                                       
document.example.elements['embassy01'].disabled=true;
document.example.elements['embassy02'].disabled=true;
document.example.elements['embassy03'].disabled=true;
document.example.elements['embassy04'].disabled=true;
document.example.elements['embassy05'].disabled=true;  
}
function onemb()
{                                      
document.example.elements['embassy01'].disabled=false;
document.example.elements['embassy02'].disabled=false; 
document.example.elements['embassy03'].disabled=false;
document.example.elements['embassy04'].disabled=false;
document.example.elements['embassy05'].disabled=false;  
}
</script>
<script type="text/javascript">
function selisih() {
var a = new Date(example.datetravelfrom.value);   
var b = new Date(example.datetravelto.value);
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
var tiga = dep1[2]+ "" +dep1[1]; 
example.tourcode.value = satu+"-"+ dua + " " + tiga +"/" + empat ;
} 
}        
function turcode() {
var satu = example.productcode.value;   
var lama = example.daystravel.value;
if (lama.length==1){dua="0"+lama}
else {dua =lama}
dep = example.datetravelfrom.value; 
dep1 = dep.split("-");
var tiga = dep1[2]+ "" +dep1[1];
var empat = example.flight.value;         
example.tourcode.value = satu+"-"+ dua + " " + tiga +"/" + empat ;
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
  reason += validateSelect(theForm.season);
  reason += validateSelect(theForm.producttype);
  reason += validateSelect(theForm.grouptype);
  reason += validateSelect(theForm.productcode);  
  reason += validateDate(theForm.datetravelfrom);
  reason += validateDateto(theForm.datetravelto);
  reason += validatePhone(theForm.daystravel);  
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
<?php 
switch($_GET[act]){
  // Tampil Office
  default:
  	$nama=$_GET['nama'];
    echo "<h2>Master Product</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='msproduct'>
			  Tour Code <input type=text name=nama value='$nama' size=20>	
			  <input type=submit name=oke value=Search>
		  </form><input type=button value='Add New Product' onclick=location.href='?module=msproduct&act=tambahmsproduct'>";
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
								WHERE TourCode LIKE '%$nama%' 
								ORDER BY DateTravelFrom ASC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>product</th><th>tour code</th><th>days</th><th>departure</th><th>flight</th><th>seat</th><th>status</th><th>tour leader</th><th>action</th></tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
                    if($data[Status]=='NOT PUBLISHED'){$status="<font color=red>$data[Status]</font>";$status2="<font color=red><b>UNPUBLISH</b></font>";$editan="editmsproduct";}
                    else if($data[Status]=='PUBLISH'){$status="<font color=green><b>$data[Status]</b></font>";$status2="<font color=green><b>PUBLISH</b></font>";$editan="editmsproductapp";}    
			   echo "<tr><td>$no</td>
					 <td>$data[ProductType]</td>	   			 			   
					 <td><a href=?module=msproduct&act=$editan&id=$data[IDProduct]>$data[TourCode]</a></td>
                     <td><center>$data[DaysTravel]</td>
                     <td>$data[DateTravelFrom]</td>
                     <td><center>$data[Flight]</td>
                     <td><center>$data[Seat]</td>   
                     <td><center>";
                     if($data[TotalAdult]=='0'){ echo"$status2</td>";
                     }else { echo"<a href=\"javascript:publishprod('$data[IDProduct]')\">$status2</a></td>";
                     }    
               echo "<td>$data[TourLeader]</td>   			 
					 <td><center>";
                     if($data[Status]=='NOT PUBLISHED'){
               echo "<a href=?module=msproduct&act=quotation&id=$data[IDProduct]>QUOTATION</a> 
                     |
                     <a href=\"javascript:delfile('$data[IDProduct]','$data[TourCode]')\">VOID</a>";
					 }else if($data[Status]=='PUBLISH'){
               echo "QUOTATION | VOID";
                     }
               echo" </td></tr>";
					  $no++;
					}
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tour_msproduct                                                           
                                WHERE TourCode LIKE '%$nama%' ";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=msproduct";
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
  
  case "tambahmsproduct":
            $thisyear = date("Y");
            $nextyear = $thisyear+1;
    echo "<h2>New Product</h2>
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msproduct&act=input' enctype='multipart/form-data'>
          <table>
          <tr><td>Season</td> <td>  
            <select name='season'>
            <option value='0' selected>- Select Season -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msseason ORDER BY SeasonName");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[SeasonName]'>$r[SeasonName]</option>";
            }
    echo "</select>
            <select name='year'>
            <option value='$thisyear' selected>$thisyear</option>
            <option value='$nextyear' >$nextyear</option>
            </select></td></tr>
          <tr><td>Product Type</td> <td>  <select name='producttype'>
            <option value='0' selected>- Select Type -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msproducttype ORDER BY ProducttypeName");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[ProducttypeName]'>$r[ProducttypeName]</option>";
            }
    echo "</select></td></tr>   
            <tr><td>Handle by</td>     <td>   
            <input type=radio name='department' value='LEISURE' checked>&nbsp;Leisure
            <input type=radio name='department' value='MINISTRY'>&nbsp;Ministry  
            </td></tr>
            <tr><td>Group Type</td> <td>  <select name='grouptype'>
            <option value='0' selected>- Select Type -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msgroup ORDER BY GroupName");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[GroupName]'>$r[GroupName]</option>";
            }
    echo "</select></td></tr>
          
          <tr><td>Product Code/Name</td> <td>  <select name='productcode' onChange='turcode()'>
            <option value='0' selected>- Select Product -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msproductcode ORDER BY ProductcodeName");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[ProductcodeName]'>$r[ProductcodeName] - $r[Productcode]</option>";
            }
    echo "</select></td></tr>    
            <tr><td>Date Travel</td> <td>From <input type='text' name='datetravelfrom' size='10' onfocus='selisih()' onClick="."cal.select(document.forms['example'].datetravelfrom,'ActIn1','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(yyyy-mm-dd)</font>
          - To <input type=text name='datetravelto' size='10' onfocus='selisih()' onClick="."cal.select(document.forms['example'].datetravelto,'anchor2','yyyy-MM-dd'); return false;"." NAME='anchor2' ID='anchor2'>
           <font color='red'>(yyyy-mm-dd)</font></td></tr>
           <tr><td>Days Travel</td> <td><input type=text name='daystravel' id='daystravel' size='3'> days</td></tr>   
          <tr><td>Flight</td> <td>  <select name='flight' onChange='turcode()'>
            <option value='0' selected>- Select Airlines -</option>";
            $tampil=mysql_query("SELECT * FROM tour_msairlines ORDER BY AirlinesID");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[AirlinesID]'>$r[AirlinesID] - $r[AirlinesName]</option>";
            }
    echo "</select></td></tr>   
          <tr><td>Tour Code</td> <td><input type=text name='tourcode' id='tourcode'></td></tr> 
          <tr><td>Seat</td> <td><input type=text name='seat' size='3'> Pax <font color='red'>*<i>Not Include Infant and Tour leader</i></font></td></tr>
          <tr><td>Tour Leader</td> <td>   
          <input type=radio name='tourleaderinc' value='YES' checked>&nbsp;Yes
          <input type=radio name='tourleaderinc' value='NO'>&nbsp;No  
          </td></tr>
          <tr><td>Insurance</td> <td>   
          <input type=radio name='insurance' value='INCLUDE'>&nbsp;Include
          <input type=radio name='insurance' value='NOT INCLUDE' checked>&nbsp;Not Include  
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
            <tr><td>Currency Price in </td><td><select name='sellingcurr' >";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            while($s=mysql_fetch_array($tampil)){
                if($s[curr]=='USD'){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";    
                } else {
                     echo "<option value='$s[curr]' >$s[curr]</option>";
                }
            }
    echo "</select></td></tr>   
            <tr><td>Attachment</td><td><input type='file' name='upload'>  </td></tr>
            <tr><td>Remarks</td><td>  <input type='text' name='remarks' size='50'>  </td></tr>
             <input type='hidden' name='status' value='NOT PUBLISHED'>  
          <tr><td colspan=2><center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table> </form><br><br>";
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
    echo "<h2>Edit Product</h2>
          <form method=POST name='example' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msproduct&act=update' enctype='multipart/form-data'>
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
            $tampil=mysql_query("SELECT * FROM tour_msproducttype ORDER BY ProducttypeName");
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
            <tr><td>Date Travel</td> <td>From <input type='text' name='datetravelfrom' size='10' value='$r[DateTravelFrom]' onfocus='selisih()' onClick="."cal.select(document.forms['example'].datetravelfrom,'ActIn1','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(yyyy-mm-dd)</font>
          - To <input type=text name='datetravelto' size='10' value='$r[DateTravelTo]' onfocus='selisih()' onClick="."cal.select(document.forms['example'].datetravelto,'anchor2','yyyy-MM-dd'); return false;"." NAME='anchor2' ID='anchor2'>
           <font color='red'>(yyyy-mm-dd)</font></td></tr>
           <tr><td>Days Travel</td> <td><input type=text name='daystravel' id='daystravel' size='3' value='$r[DaysTravel]'> days</td></tr>   
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
          <tr><td>Seat</td> <td><input type=text name='seat' size='3' value='$r[Seat]'> Pax <font color='red'>*<i>Not Include Infant and Tour leader</i></font></td></tr>
          <tr><td>Tour Leader</td> <td>   
          <input type=radio name='tourleaderinc' value='YES'";if($r[TourLeaderInc]=='YES'){echo"checked";}echo">&nbsp;Yes
          <input type=radio name='tourleaderinc' value='NO'";if($r[TourLeaderInc]=='NO'){echo"checked";}echo">&nbsp;No        
          </td></tr>
          <tr><td>Insurance</td> <td>   
          <input type=radio name='insurance' value='INCLUDE'";if($r[Insurance]=='INCLUDE'){echo"checked";}echo">&nbsp;Include
          <input type=radio name='insurance' value='NOT INCLUDE'";if($r[Insurance]=='NOT INCLUDE'){echo"checked";}echo">&nbsp;Not Include        
          </td></tr>
          <tr><td>Visa</td> <td>   
          <input type=radio name='visa' value='INCLUDE'";if($r[Visa]=='INCLUDE'){echo"checked";}echo">&nbsp;Include
          <input type=radio name='visa' value='NOT INCLUDE'";if($r[Visa]=='NOT INCLUDE'){echo"checked";}echo">&nbsp;Not Include
          <input type=radio name='visa' value='NO REQUIRED'";if($r[Visa]=='NO REQUIRED'){echo"checked";}echo">&nbsp;No Required
          </td></tr>
          <tr><td></td><td><select name='embassy01' >
            <option value='0' selected>- Embassy 01 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy01]==$s[CountryID]){
                    echo "<option value='$s[CountryID]' selected>$s[Country]</option>";    
                }else {
                    echo "<option value=$s[CountryID]>$s[Country]</option>";
                }
            }
    echo "</select>&nbsp&nbsp <select name='embassy03' >
            <option value='0' selected>- Embassy 03 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy03]==$s[CountryID]){
                    echo "<option value='$s[CountryID]' selected>$s[Country]</option>";    
                }else {
                    echo "<option value=$s[CountryID]>$s[Country]</option>";
                }
            }
    echo "</select>&nbsp&nbsp <select name='embassy05' >
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
          <tr><td></td><td><select name='embassy02' >
            <option value='0' selected>- Embassy 02 -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' ORDER BY Country");
            while($s=mysql_fetch_array($tampil)){
                if($r[Embassy02]==$s[CountryID]){
                    echo "<option value='$s[CountryID]' selected>$s[Country]</option>";    
                }else {
                    echo "<option value=$s[CountryID]>$s[Country]</option>";
                }
            }
    echo "</select>&nbsp&nbsp <select name='embassy04' >
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
            <tr><td>Currency Price in </td><td><select name='sellingcurr' >";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            while($s=mysql_fetch_array($tampil)){
                if($s[curr]==$r[SellingCurr]){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";    
                } else {
                     echo "<option value='$s[curr]' >$s[curr]</option>";
                }
            }
    echo "</select></td></tr>   
            <tr><td>Attachment</td><td>";if($r[AttachmentFile]<>''){echo"<input type='hidden' name='attachmentfile' value='$r[AttachmentFile]'>$r[AttachmentFile] &nbsp<a href=\"javascript:delattach('$r[IDProduct]','$r[AttachmentFile]')\"><font color=red>remove</font></a>";}
                                        else{echo"<input type='file' name='upload' >";
                                        }echo"</td></tr>
            <tr><td>Remarks</td><td>  <input type='text' name='remarks' value='$r[Remarks]' size='50'>  </td></tr>   
          <tr><td colspan=2><center><input type='submit' name='submit' value='Update'>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;
	
  case "editmsproductapp":
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Product</h2>
          <form method=POST name='example' onsubmit='return validateFormsOnSubmit(this)' action='./aksi.php?module=msproduct&act=updateprod'>
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
            $tampil=mysql_query("SELECT * FROM tour_msproducttype ORDER BY ProducttypeName");
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
          
          <tr><td>Product Code/Name</td> <td>";
            $tampil=mysql_query("SELECT * FROM tour_msproductcode ORDER BY ProductcodeName");
            while($s=mysql_fetch_array($tampil)){
                if($r[ProductCode]==$s[ProductcodeName]){
                    echo "$s[ProductcodeName] - $s[Productcode]";
                } 
            }
    echo "</select></td></tr>    
            <tr><td>Date Travel</td> <td>$r[DateTravelFrom] - $r[DateTravelTo]</td></tr>
           <tr><td>Days Travel</td> <td>$r[DaysTravel] days</td></tr>   
          <tr><td>Flight</td> <td> ";
            $tampil=mysql_query("SELECT * FROM tour_msairlines ORDER BY AirlinesID");
            while($s=mysql_fetch_array($tampil)){
                if($r[Flight]==$s[AirlinesID]){
                    echo "$s[AirlinesID] - $s[AirlinesName]";    
                }
            }
    echo "</td></tr>
          <tr><td>Tour Code</td> <td>$r[TourCode]</td></tr>
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
            <tr><td>Currency Price in </td><td> $r[SellingCurr]</td></tr>  
            <tr><td>Attachment</td><td>$r[AttachmentFile]</td></tr>
            <tr><td>Remarks</td><td> $r[Remarks]</td></tr>     
          <tr><td colspan=2><center><input type='submit' name='submit' value='Update'>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;  
    
  case "deletemsproduct":    
    $edit=mysql_query("DELETE FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproduct'>";   
     break;
     
  case "delattach":    
    $edit1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1);
    $file= ereg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r2[AttachmentFile]) ) ) );
    $path = $r2[Attachment];
    $files = ("$path$file");
    unlink($files);
    $edit=mysql_query("UPDATE tour_msproduct set Attachment = '',AttachmentFile='' WHERE IDProduct = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproduct&act=editmsproduct&id=$_GET[id]'>";     
     break;
     
  case "publishmsproduct":    
    $edit1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1);
    if($r2[Status]=='NOT PUBLISHED'){$status="PUBLISH";}
    else if($r2[Status]=='PUBLISH'){$status="NOT PUBLISHED";}             
    $edit=mysql_query("UPDATE tour_msproduct SET Status = '$status' WHERE IDProduct = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproduct'>";   
     break;
     
  case "quotation":
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Quotation</h2>
           <table>
           <tr style='border: hidden;'><td style='border: hidden;'>Tour Code</td> <td>: $r[TourCode]</td></tr>
          <tr style='border: hidden;'><td style='border: hidden;'>Destination</td> <td>: $r[Destination]</td></tr>                       
          <tr style='border: hidden;'><td style='border: hidden;'>Departure Date</td> <td>: $r[DateTravelFrom]</td></tr>
          <tr style='border: hidden;'><td style='border: hidden;'>Total Seat</td> <td>: $r[Seat] PAX ";if($r[TourLeaderInc]=='YES'){echo" + Tour Leader";} echo"</td></tr>  
          </table><br>
          
          <form method=POST name='quotation' action='./aksi.php?module=variable&act=input'>
          <input type=hidden name=id value='$r[IDProduct]'>
          <input type=hidden name='pax' value='$r[Seat]'>
          <font size='2'><i>Variable Cost</i></font>";
            $tampil=mysql_query("SELECT * FROM tour_detail
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' ORDER BY IDDetail ASC ");
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "<table>
                    <tr><th>supplier</th><th>description</th><th>amount</th><th>action</th></tr>"; 
                    while ($data=mysql_fetch_array($tampil)){
               echo "<td>$data[Supplier]</td>                                   
                     <td>$data[Description]</td>
                     <td>$data[Amount]</td>
                     <td><center><a href=\"javascript:delfile('$data[IDDetail]','$data[Supplier]','$data[Description]','$r[IDProduct]')\">DELETE</a>
                     </td></tr>";
                    }
                    echo "</table>";
                    }
          echo"<table>
          <tr><td>Supplier</td><td><select name='supplier' >
            <option value='0' selected>- select -</option>";
            $tampil=mysql_query("SELECT * FROM tour_mssupplier where SupplierStatus = 'ACTIVE' ORDER BY SupplierName ASC");
            while($t=mysql_fetch_array($tampil)){
              echo "<option value='$t[SupplierName]'>$t[SupplierName]</option>";
            }
    echo "</select></td></tr>
          <tr><td>Description</td> <td><input type=text name='description' size='40'></td></tr>
          <tr><td>Amount</td> <td>$r[SellingCurr]. <input type=text name='amount' size='7'></td></tr>
          <tr><td colspan=2><center><input type='submit' name='submit' value='Add Variable Cost'></td></tr>
          </table></form>
          
          <form method=POST name='quotation' action='./aksi.php?module=fixcost&act=input'>
          <input type=hidden name=id value='$r[IDProduct]'>
          <input type=hidden name='pax' value='$r[Seat]'>
          <font size='2'><i>Fix and Agent Cost</i></font>";
            $tampil=mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct='$r[IDProduct]' ORDER BY IDDetail ASC ");
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "<table>
                    <tr><th>supplier</th><th>description</th><th>adult twin</th><th>adult single</th><th>Child Twin</th><th>child no bed</th><th>Child extra bed</th><th>infant</th><th>action</th></tr>"; 
                    while ($data=mysql_fetch_array($tampil)){
               echo "<td>$data[Supplier]</td>                                   
                     <td>$data[Description]</td>
                     <td>$data[Adult]</td>
                     <td>$data[Single]</td>
                     <td>$data[ChdTwn]</td>
                     <td>$data[ChdNbed]</td>
                     <td>$data[ChdXbed]</td>
                     <td>$data[Infant]</td>
                     <td><center><a href=\"javascript:delfile('$data[IDDetail]','$data[Supplier]','$data[Description]','$r[IDProduct]')\">DELETE</a>
                     </td></tr>";
                    }
                    echo "</table>";
                    }
          echo"<table>
          <tr><td>Supplier</td><td><select name='supplier' >
            <option value='0' selected>- select -</option>";
            $tampil=mysql_query("SELECT * FROM tour_mssupplier where SupplierStatus = 'ACTIVE' ORDER BY SupplierName ASC");
            while($t=mysql_fetch_array($tampil)){
              echo "<option value='$t[SupplierName]'>$t[SupplierName]</option>";
            }
    echo "</select></td></tr>
          <tr><td>Description</td> <td>
          <select name='description' id='lstDropDown_A' style='' onKeyDown='fnKeyDownHandler_A(this, event);' onKeyUp='fnKeyUpHandler_A(this, event); return false;' onKeyPress = 'return fnKeyPressHandler_A(this, event);'  onChange='fnChangeHandler_A(this);' onFocus='fnFocusHandler_A(this);'>
          <option value='' style='font-family:Courier,monospace;color:#ff0000;background-color:#ffff00;'> click and edit </option>";
            $tampil=mysql_query("SELECT * FROM tour_msdesc ORDER BY Description ASC");
            while($t=mysql_fetch_array($tampil)){
              echo "<option value='$t[Description]'>$t[Description]</option>";
            }
    echo "
        </select>
          </td></tr>
          <tr><td>Adult Twin</td> <td>$r[SellingCurr]. <input type=text name='adult' size='7'></td></tr>
          <tr><td>Adult Single</td> <td>$r[SellingCurr]. <input type=text name='single' size='7'></td></tr>
          <tr><td>Child Twin</td> <td>$r[SellingCurr]. <input type=text name='chdtwn' size='7'></td></tr>
          <tr><td>Child No Bed</td> <td>$r[SellingCurr]. <input type=text name='chdnbed' size='7'></td></tr>
          <tr><td>Child Extra bed</td> <td>$r[SellingCurr]. <input type=text name='chdxbed' size='7'></td></tr>   
          <tr><td>Infant</td> <td>$r[SellingCurr]. <input type=text name='infant' size='7'></td></tr>
          <tr><td colspan=2><center><input type='submit' name='submit' value='Add Fix and Agent Cost'></td></tr>
          </table></form>
          
          <form method=POST name='calculate' action='./aksi.php?module=calculate&act=input'>
          <input type=hidden name=id value='$r[IDProduct]'> 
          <input type=hidden name='tourcode' value='$r[TourCode]'>";
            $tampil=mysql_query("SELECT sum(Adult)as vadult,sum(ChdTwn)as vchdtwn,sum(ChdNbed)as vchdnbed,sum(ChdXbed)as vchdxbed,sum(Single)as vsingle,sum(Infant)as vinfant FROM tour_detail
                                where Category = 'VARIABLE' and IDProduct='$r[IDProduct]'  ");
            $data=mysql_fetch_array($tampil);
            $tampil1=mysql_query("SELECT sum(Adult)as fadult,sum(ChdTwn)as fchdtwn,sum(ChdNbed)as fchdnbed,sum(ChdXbed)as fchdxbed,sum(Single)as fsingle,sum(Infant)as finfant FROM tour_detail
                                where Category = 'FIX' and IDProduct='$r[IDProduct]'  ");
            $data1=mysql_fetch_array($tampil1);  
            $tadult=($data[vadult]+$data1[fadult]);
            $tchdtwn=($data[vchdtwn]+$data1[fchdtwn]);
            $tchdnbed=($data[vchdnbed]+$data1[fchdnbed]);
            $tchdxbed=($data[vchdxbed]+$data1[fchdxbed]);
            $tsingle=($data[vsingle]+$data1[fsingle]);
            $tinfant=($data[vinfant]+$data1[finfant]); 
            echo "<table>
                    <tr><th>description</th><th>adult twin</th><th>adult single</th><th>Child Twin</th><th>child no bed</th><th>Child extra bed</th><th>infant</th></tr> 
                     <tr><td>Variable Cost</td><td>$data[vadult]</td><td>$data[vsingle]</td><td>$data[vchdtwn]</td><td>$data[vchdnbed]</td><td>$data[vchdxbed]</td><td>$data[vinfant]</td></tr>
                     <tr><td>Fix Cost</td><td>$data1[fadult]</td><td>$data1[fsingle]</td><td>$data1[fchdtwn]</td><td>$data1[fchdnbed]</td><td>$data1[fchdxbed]</td><td>$data1[finfant]</td></tr>
                     <tr><td>Total Cost</td><td><input type='text' name='tadult' id='tadult' size='12' value='$tadult' style='text-align: left;border: 0px solid #000000; font-weight:bold;' readonly></td>
                     <td><input type='text' name='tsingle' id='tsingle' size='12' value='$tsingle' style='text-align: left;border: 0px solid #000000; font-weight:bold;' readonly></td>
                     <td><input type='text' name='tchdtwn' id='tchdtwn' size='12' value='$tchdtwn' style='text-align: left;border: 0px solid #000000; font-weight:bold;' readonly></td>
                     <td><input type='text' name='tchdnbed' id='tchdnbed' size='12' value='$tchdnbed' style='text-align: left;border: 0px solid #000000; font-weight:bold;' readonly></td>
                     <td><input type='text' name='tchdxbed' id='tchdxbed' size='12' value='$tchdxbed' style='text-align: left;border: 0px solid #000000; font-weight:bold;' readonly></td>
                     <td><input type='text' name='tinfant' id='tinfant' size='12' value='$tinfant' style='text-align: left;border: 0px solid #000000; font-weight:bold;' readonly></td>
                     <tr><td>Profit</td><td><input type='text' name='padult' id='padult' value='0' size='12' style='text-align: left;border: 0px solid #000000' readonly></td>
                         <td><input type='text' name='psingle' id='psingle' value='0' size='12' style='text-align: left;border: 0px solid #000000' readonly></td>
                         <td><input type='text' name='pchdtwn' id='pchdtwn' value='0' size='12' style='text-align: left;border: 0px solid #000000' readonly></td>
                         <td><input type='text' name='pchdnbed' id='pchdnbed' value='0' size='12' style='text-align: left;border: 0px solid #000000' readonly></td>
                         <td><input type='text' name='pchdxbed' id='pchdxbed' value='0' size='12' style='text-align: left;border: 0px solid #000000' readonly></td>
                         <td><input type='text' name='pinfant' id='pinfant' value='0' size='12' style='text-align: left;border: 0px solid #000000' readonly></td></tr>
                     <tr><td>Selling</td><td><input type=text name='sadult' id='sadult' size='13' onkeyup='UpdateProfita(this)'></td>
                         <td><input type=text name='ssingle' id='ssingle' size='13' onkeyup='UpdateProfits()'></td></td>
                         <td><input type=text name='schdtwn' id='schdtwn' size='13' onkeyup='UpdateProfitct()'></td>
                         <td><input type=text name='schdnbed' id='schdnbed' size='13' onkeyup='UpdateProfitcn()'></td>
                         <td><input type=text name='schdxbed' id='schdxbed' size='13' onkeyup='UpdateProfitcx()'></td>
                         <td><input type=text name='sinfant' id='sinfant' size='13' onkeyup='UpdateProfiti()'></td></td></tr> 
                    </table>    
          <table>
          <tr><td>Airport Tax International</td> <td>&nbsp&nbsp$r[SellingCurr]. &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type=text name='sellingtax' size='12'></td></tr>
          <tr><td>Visa Selling Price</td><td><select name='visacurr' ";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo">";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            while($s=mysql_fetch_array($tampil)){
                if($s[curr]=='IDR'){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";    
                } else {
                     echo "<option value='$s[curr]' >$s[curr]</option>";
                }
            }
    echo "</select> <input type=text name='visaprice' size='12'";if ($r[Visa]=='NO REQUIRED'){echo"disabled";}echo"></td></tr>
          <tr><td>Airport Tax Domestic</td><td><select name='airtaxcurr' >";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            while($s=mysql_fetch_array($tampil)){
                if($s[curr]=='IDR'){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";    
                } else {
                     echo "<option value='$s[curr]' >$s[curr]</option>";
                }
            }
    echo "</select> <input type=text name='airtaxamount' size='12'></td></tr>
          </table>
          <center><input type='submit' name='submit' value='Save'>
          </form>";
     break;
     
 case "deletedetail":    
    $edit=mysql_query("DELETE FROM tour_detail WHERE IDDetail = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproduct&act=quotation&id=$_GET[no]'>";   
     break;
       
}
?>
