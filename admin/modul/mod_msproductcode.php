<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>
<script language="JavaScript"  type="text/javascript">
     
function delfile(ID, productcode)         
{
if (confirm("Are you sure you want to delete "+ productcode +" "))
{
 window.location.href = '?module=msproductcode&act=deleteproductcode&id=' + ID +'&prod='+ productcode ;
 
} 
}
</script>
<script type='text/javascript'>
 function showRegion() {
 <?php                                                    
 // membaca semua data currency
 $query = "SELECT Region FROM Destination group by Region ";
 $hasil = mssql_query($query);
 
 // membuat if untuk masing-masing pilihan currency 
 while ($data = mssql_fetch_array($hasil))
 {
   $idDest = $data['Region'];                                                  
   // membuat IF untuk masing-masing currency
   echo "if (document.example.ProductcodeDestination.value == \"".$idDest."\")"; 
   echo "{";       
    
   // membuat hasil kurs untuk masing-masing currency
   $query2 = "SELECT Country FROM Destination
                WHERE Region = '$idDest' Group by Country ";
   $hasil2 = mssql_query($query2);
   $content = "document.getElementById('productcodecountry0').innerHTML = \"";
   $content .= "<option value='0'>- Select -</option>";
   while ($data2 = mssql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['Country']."'>".$data2['Country']."</option>";
   }
   $content .= "\"";
   echo $content;

   echo "}\n";
   echo "else if (document.example.ProductcodeDestination.value == '0'){";
   echo"{";
   // membuat hasil kurs untuk masing-masing currency
   $content = "document.getElementById('productcodecountry0').innerHTML = \"";
   $content .= "<option value='0'>- Select -</option>";
   $content .= "\"";
   echo $content;
   echo"}{";
   $content = "document.getElementById('productcodecountry1').innerHTML = \"";
   $content .= "<option value='0'>- Select -</option>";
   $content .= "\"";
   echo $content;
   echo"}{";
   $content = "document.getElementById('productcodecountry2').innerHTML = \"";
   $content .= "<option value='0'>- Select -</option>";
   $content .= "\"";
   echo $content;
   echo"}{";
   $content = "document.getElementById('productcodecountry3').innerHTML = \"";
   $content .= "<option value='0'>- Select -</option>";
   $content .= "\"";
   echo $content;
   echo"}{";
   $content = "document.getElementById('productcodecountry4').innerHTML = \"";
   $content .= "<option value='0'>- Select -</option>";
   $content .= "\"";
   echo $content;
  echo"}{";
   $content = "document.getElementById('productcodecountry5').innerHTML = \"";
   $content .= "<option value='0'>- Select -</option>";
   $content .= "\"";
   echo $content;
   echo"}{";
   $content = "document.getElementById('productcodecountry6').innerHTML = \"";
   $content .= "<option value='0'>- Select -</option>";
   $content .= "\"";
   echo $content;
   echo"}{";
   $content = "document.getElementById('productcodecountry7').innerHTML = \"";
   $content .= "<option value='0'>- Select -</option>";
   $content .= "\"";
   echo $content;
   echo"}";
   echo "}\n";          
 }
  ?>
  }
 function showRegion0() {
     <?php
     // membaca semua data currency
     $query = "SELECT Region FROM Destination group by Region ";
     $hasil = mssql_query($query);

     // membuat if untuk masing-masing pilihan currency
     while ($data = mssql_fetch_array($hasil))
     {
       $idDest = $data['Region'];
       // membuat IF untuk masing-masing currency
       echo "if (document.example.ProductcodeDestination.value == \"".$idDest."\")";
       echo "{";

       // membuat hasil kurs untuk masing-masing currency
       $query2 = "SELECT Country FROM Destination
                    WHERE Region = '$idDest' Group by Country ";
       $hasil2 = mssql_query($query2);
       $content = "document.getElementById('productcodecountry1').innerHTML = \"";
       $content .= "<option value='0'>- Select -</option>";
       while ($data2 = mssql_fetch_array($hasil2))
       {
           $content .= "<option value='".$data2['Country']."'>".$data2['Country']."</option>";
       }
       $content .= "\"";
       echo $content;

       echo "}\n";
       echo "else if (document.example.ProductcodeDestination.value == '0'){";

       // membuat hasil kurs untuk masing-masing currency
       $content = "document.getElementById('productcodecountry1').innerHTML = \"";
       $content .= "<option value=''></option>";

       $content .= "\"";
       echo $content;
       echo "}\n";
     }
      ?>
 }
 function showRegion1() {
     <?php
     // membaca semua data currency
     $query = "SELECT Region FROM Destination group by Region ";
     $hasil = mssql_query($query);

     // membuat if untuk masing-masing pilihan currency
     while ($data = mssql_fetch_array($hasil))
     {
       $idDest = $data['Region'];
       // membuat IF untuk masing-masing currency
       echo "if (document.example.ProductcodeDestination.value == \"".$idDest."\")";
       echo "{";

       // membuat hasil kurs untuk masing-masing currency
       $query2 = "SELECT Country FROM Destination
                    WHERE Region = '$idDest' Group by Country ";
       $hasil2 = mssql_query($query2);
       $content = "document.getElementById('productcodecountry2').innerHTML = \"";
       $content .= "<option value='0'>- Select -</option>";
       while ($data2 = mssql_fetch_array($hasil2))
       {
           $content .= "<option value='".$data2['Country']."'>".$data2['Country']."</option>";
       }
       $content .= "\"";
       echo $content;

       echo "}\n";
       echo "else if (document.example.ProductcodeDestination.value == '0'){";

       // membuat hasil kurs untuk masing-masing currency
       $content = "document.getElementById('productcodecountry2').innerHTML = \"";
       $content .= "<option value=''></option>";

       $content .= "\"";
       echo $content;
       echo "}\n";
     }
      ?>
 }
 function showRegion2() {
     <?php
     // membaca semua data currency
     $query = "SELECT Region FROM Destination group by Region ";
     $hasil = mssql_query($query);

     // membuat if untuk masing-masing pilihan currency
     while ($data = mssql_fetch_array($hasil))
     {
       $idDest = $data['Region'];
       // membuat IF untuk masing-masing currency
       echo "if (document.example.ProductcodeDestination.value == \"".$idDest."\")";
       echo "{";

       // membuat hasil kurs untuk masing-masing currency
       $query2 = "SELECT Country FROM Destination
                    WHERE Region = '$idDest' Group by Country ";
       $hasil2 = mssql_query($query2);
       $content = "document.getElementById('productcodecountry3').innerHTML = \"";
       $content .= "<option value='0'>- Select -</option>";
       while ($data2 = mssql_fetch_array($hasil2))
       {
           $content .= "<option value='".$data2['Country']."'>".$data2['Country']."</option>";
       }
       $content .= "\"";
       echo $content;

       echo "}\n";
       echo "else if (document.example.ProductcodeDestination.value == '0'){";

       // membuat hasil kurs untuk masing-masing currency
       $content = "document.getElementById('productcodecountry3').innerHTML = \"";
       $content .= "<option value=''></option>";

       $content .= "\"";
       echo $content;
       echo "}\n";
     }
      ?>
 }
 function showRegion3() {
     <?php
     // membaca semua data currency
     $query = "SELECT Region FROM Destination group by Region ";
     $hasil = mssql_query($query);

     // membuat if untuk masing-masing pilihan currency
     while ($data = mssql_fetch_array($hasil))
     {
       $idDest = $data['Region'];
       // membuat IF untuk masing-masing currency
       echo "if (document.example.ProductcodeDestination.value == \"".$idDest."\")";
       echo "{";

       // membuat hasil kurs untuk masing-masing currency
       $query2 = "SELECT Country FROM Destination
                    WHERE Region = '$idDest' Group by Country ";
       $hasil2 = mssql_query($query2);
       $content = "document.getElementById('productcodecountry4').innerHTML = \"";
       $content .= "<option value='0'>- Select -</option>";
       while ($data2 = mssql_fetch_array($hasil2))
       {
           $content .= "<option value='".$data2['Country']."'>".$data2['Country']."</option>";
       }
       $content .= "\"";
       echo $content;

       echo "}\n";
       echo "else if (document.example.ProductcodeDestination.value == '0'){";

       // membuat hasil kurs untuk masing-masing currency
       $content = "document.getElementById('productcodecountry4').innerHTML = \"";
       $content .= "<option value=''></option>";

       $content .= "\"";
       echo $content;
       echo "}\n";
     }
      ?>
 }
 function showRegion4() {
     <?php
     // membaca semua data currency
     $query = "SELECT Region FROM Destination group by Region ";
     $hasil = mssql_query($query);

     // membuat if untuk masing-masing pilihan currency
     while ($data = mssql_fetch_array($hasil))
     {
       $idDest = $data['Region'];
       // membuat IF untuk masing-masing currency
       echo "if (document.example.ProductcodeDestination.value == \"".$idDest."\")";
       echo "{";

       // membuat hasil kurs untuk masing-masing currency
       $query2 = "SELECT Country FROM Destination
                    WHERE Region = '$idDest' Group by Country ";
       $hasil2 = mssql_query($query2);
       $content = "document.getElementById('productcodecountry5').innerHTML = \"";
       $content .= "<option value='0'>- Select -</option>";
       while ($data2 = mssql_fetch_array($hasil2))
       {
           $content .= "<option value='".$data2['Country']."'>".$data2['Country']."</option>";
       }
       $content .= "\"";
       echo $content;

       echo "}\n";
       echo "else if (document.example.ProductcodeDestination.value == '0'){";

       // membuat hasil kurs untuk masing-masing currency
       $content = "document.getElementById('productcodecountry5').innerHTML = \"";
       $content .= "<option value=''></option>";

       $content .= "\"";
       echo $content;
       echo "}\n";
     }
      ?>
 }
 function showRegion5() {
     <?php
     // membaca semua data currency
     $query = "SELECT Region FROM Destination group by Region ";
     $hasil = mssql_query($query);

     // membuat if untuk masing-masing pilihan currency
     while ($data = mssql_fetch_array($hasil))
     {
       $idDest = $data['Region'];
       // membuat IF untuk masing-masing currency
       echo "if (document.example.ProductcodeDestination.value == \"".$idDest."\")";
       echo "{";

       // membuat hasil kurs untuk masing-masing currency
       $query2 = "SELECT Country FROM Destination
                    WHERE Region = '$idDest' Group by Country ";
       $hasil2 = mssql_query($query2);
       $content = "document.getElementById('productcodecountry6').innerHTML = \"";
       $content .= "<option value='0'>- Select -</option>";
       while ($data2 = mssql_fetch_array($hasil2))
       {
           $content .= "<option value='".$data2['Country']."'>".$data2['Country']."</option>";
       }
       $content .= "\"";
       echo $content;

       echo "}\n";
       echo "else if (document.example.ProductcodeDestination.value == '0'){";

       // membuat hasil kurs untuk masing-masing currency
       $content = "document.getElementById('productcodecountry6').innerHTML = \"";
       $content .= "<option value=''></option>";

       $content .= "\"";
       echo $content;
       echo "}\n";
     }
      ?>
 }
 function showRegion6() {
     <?php
     // membaca semua data currency
     $query = "SELECT Region FROM Destination group by Region ";
     $hasil = mssql_query($query);

     // membuat if untuk masing-masing pilihan currency
     while ($data = mssql_fetch_array($hasil))
     {
       $idDest = $data['Region'];
       // membuat IF untuk masing-masing currency
       echo "if (document.example.ProductcodeDestination.value == \"".$idDest."\")";
       echo "{";

       // membuat hasil kurs untuk masing-masing currency
       $query2 = "SELECT Country FROM Destination
                    WHERE Region = '$idDest' Group by Country ";
       $hasil2 = mssql_query($query2);
       $content = "document.getElementById('productcodecountry7').innerHTML = \"";
       $content .= "<option value='0'>- Select -</option>";
       while ($data2 = mssql_fetch_array($hasil2))
       {
           $content .= "<option value='".$data2['Country']."'>".$data2['Country']."</option>";
       }
       $content .= "\"";
       echo $content;

       echo "}\n";
       echo "else if (document.example.ProductcodeDestination.value == '0'){";

       // membuat hasil kurs untuk masing-masing currency
       $content = "document.getElementById('productcodecountry7').innerHTML = \"";
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
            
function validateFormOnSubmit(theForm) {
var reason = "";                            
  reason += validateEmpty(theForm.Productcode);
  reason += validateEmpty(theForm.ProductcodeName); 
  reason += validateSelect(theForm.ProductcodeArea);  
  reason += validateSelect(theForm.ProductcodeDestination);
  reason += validateSelect(theForm.ProductcodeBy);        
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
<SCRIPT type="text/javascript">
pic1 = new Image(16, 16); 
pic1.src = "./modul/loader.gif";

function cekcode() { 

var pcode = $("#prodcode").val();

if(pcode.length >= 3)
{
$("#status").html('<img src="./modul/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "./modul/checkpcode.php",  
    data: { prodcode: pcode },
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

    if(msg == 'OK')
    { 
        $("#prodcode").removeClass('object_error'); // if necessary
        $("#prodcode").addClass("object_ok");
        $(this).html('&nbsp;<img src="./modul/tick.gif" align="absmiddle">');
    }  
    else  
    {  
        $("#prodcode").removeClass('object_ok'); // if necessary
        $("#prodcode").addClass("object_error");
        $(this).html(msg);
    }  
   
   });

 } 
   
  }); 
}else
    {
    $("#status").html('<font color="red">Product Code should have min <strong>3</strong> characters.</font>');
    $("#prodcode").removeClass('object_ok'); // if necessary
    $("#prodcode").addClass("object_error");
    }


}

//-->
</SCRIPT>   
<?php
switch($_GET[act]){
  // Tampil productcode
  default:
  	$nama=$_GET['nama'];
    echo "<h2>Master Product Code</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='msproductcode'>
			  <input type=text name=nama value='$nama' size=40>	
			  <input type=submit name=oke value=Search>
		  </form><input type=button value='Add Product Code' onclick=location.href='?module=msproductcode&act=tambahproductcode'>";
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
		    $tampil=mysql_query("SELECT * FROM tour_msproductcode 
								WHERE ProductcodeName LIKE '%$nama%'
                                OR ProductcodeDestination LIKE '%$nama%'
                                OR Productcode LIKE '%$nama%' 
								ORDER BY ProductcodeDestination ASC,ProductcodeName ASC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>Product Name</th><th>Product Code</th><th>Destination</th><th>action</th></tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
			   echo "<tr><td>$no</td>
                     <td>$data[Productcode]</td>
					 <td><center>$data[ProductcodeName]</td>
                     <td><center>$data[ProductcodeDestination]</td>  
					 <td><center><a href=?module=msproductcode&act=editproductcode&id=$data[IDProductcode]>Edit</a>
					 
					 </td></tr>";
					  $no++;
					}  //&nbsp;|&nbsp; 
                    // <a href=\"javascript:delfile('$data[IDProductcode]','$data[ProductcodeName]')\">Delete</a> 
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tour_msproductcode 
                                WHERE ProductcodeName LIKE '%$nama%'
                                OR ProductcodeDestination LIKE '%$nama%'
                                OR Productcode LIKE '%$nama%'  
                                ORDER BY ProductcodeDestination ASC,ProductcodeName ASC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=msproductcode";
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
  
  case "tambahproductcode":
    echo "<h2>New Product Code</h2>
          <form name='example' onsubmit='return validateFormOnSubmit(this)' method='POST' action='./aksi.php?module=msproductcode&act=input'>
          <table>
          <tr><td>Product Name</td>     <td>  <input type=text name='Productcode'></td></tr>
          <tr><td>Product Code</td>     <td>  <input type=text name='ProductcodeName' id='prodcode' maxlength='4' size='3' onBlur='cekcode()'><div id='status'></div></td></tr>
          <tr><td>Product Area</td>     <td>  <select name='ProductcodeArea'>
               <option value=0 selected>- Select Area -</option>
               <option value='ALL'>ALL</option>
               <option value='AFRICA'>AFRICA</option>
               <option value='AMERICA & CANADA'>AMERICA & CANADA</option>
               <option value='AUSTRALIA'>AUSTRALIA</option> 
               <option value='CENTRAL EUROPE'>CENTRAL EUROPE</option> 
               <option value='CHINA'>CHINA</option> 
               <option value='CRUISE'>CRUISE</option> 
               <option value='DOMESTIC'>DOMESTIC</option> 
               <option value='EAST EUROPE'>EAST EUROPE</option> 
               <option value='HONG KONG'>HONG KONG</option> 
               <option value='JAPAN'>JAPAN</option> 
               <option value='KOREA'>KOREA</option> 
               <option value='MEDITERANNEAN'>MEDITERANNEAN</option> 
               <option value='NEW ZEALAND'>NEW ZEALAND</option> 
               <option value='NORTH EUROPE'>NORTH EUROPE</option> 
               <option value='PMT'>PMT</option> 
               <option value='SOUTH AMERICA'>SOUTH AMERICA</option> 
               <option value='SOUTH EAST ASIA'>SOUTH EAST ASIA</option> 
               <option value='SOUTH EUROPE'>SOUTH EUROPE</option> 
               <option value='TAIWAN'>TAIWAN</option> 
               <option value='WEST EUROPE'>WEST EUROPE</option> 
          </select></td></tr>
          <tr><td>Product By</td> <td>  <select name='ProductcodeBy'>";    
               /*<option value='ACA'>ACA</option>
               <option value='DOM'>DOM</option>
               <option value='EEA'>EEA</option>
               <option value='GRV'>GRV</option>
               <option value='PMT'>PMT</option>*/
          echo "<option value='GROUP A'>GROUP A</option>
               <option value='GROUP B'>GROUP B</option>
               <option value='NONE'>NONE</option>
               </select></td></tr>  
          <tr><td>Destination</td> <td>  <select name='ProductcodeDestination' onChange='showRegion()'>
               <option value=0 selected>- Select Destination -</option>";
            $tampil=mssql_query("SELECT Region FROM Destination Group BY Region");
            while($r=mssql_fetch_array($tampil)){
              echo "<option value='$r[Region]'>$r[Region]</option>";
            }
    echo "</select></td></tr>      
          </table>
          <table  id='country' border='1'>";
          for($a=0;$a<7;$a++) {
              echo "<tr>
          <td>Country </td>
          <td><select name='ProductcodeCountry[]' id='productcodecountry$a' onChange='showRegion$a()'>
                      <option value='0' selected>- Select -</option>";
                    $tampil=mssql_query("SELECT Country FROM Destination where Region = '$r[ProductcodeDestination]' group by Country");
                    while($w=mssql_fetch_array($tampil)){
                        echo "<option value='$w[Country]'>$w[Country]</option>";
                    }
                    echo "</select></td>
          </tr>";
          }
          echo"</table>
          <center><input type=radio name='ProductcodeStatus' value='ACTIVE' checked>&nbsp;Active
            <input type=radio name='ProductcodeStatus' value='INACTIVE'>&nbspInactive  <br><br>
          <center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()>         
          </form><br><br>";
     break;
    
  case "editproductcode":
    $edit=mysql_query("SELECT * FROM tour_msproductcode WHERE IDProductcode='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Product Code</h2>
          <form name='example' onsubmit='return validateFormOnSubmit(this)' method=POST action=./aksi.php?module=msproductcode&act=update>
          <input type=hidden name=id value='$r[IDProductcode]'>
          <input type=hidden name='olddestination' value='$r[ProductcodeDestination]'>
          <table>
          <tr><td>Product Name</td><td>$r[Productcode]</td></tr>
          <tr><td>Product Code</td><td> $r[ProductcodeName]</td></tr>
          <tr><td>Product Area</td><td><select name='ProductcodeArea'>
               <option value='0'";if($r[ProductcodeArea]=='0'){echo"selected";}echo">- Select Area -</option>
               <option value='ALL'";if($r[ProductcodeArea]=='ALL'){echo"selected";}echo">ALL</option>
               <option value='AFRICA'";if($r[ProductcodeArea]=='AFRICA'){echo"selected";}echo">AFRICA</option>
               <option value='AMERICA & CANADA'";if($r[ProductcodeArea]=='AMERICA & CANADA'){echo"selected";}echo">AMERICA & CANADA</option>
               <option value='AUSTRALIA'";if($r[ProductcodeArea]=='AUSTRALIA'){echo"selected";}echo">AUSTRALIA</option>
               <option value='CENTRAL EUROPE'";if($r[ProductcodeArea]=='CENTRAL EUROPE'){echo"selected";}echo">CENTRAL EUROPE</option>
               <option value='CHINA'";if($r[ProductcodeArea]=='CHINA'){echo"selected";}echo">CHINA</option>
               <option value='CRUISE'";if($r[ProductcodeArea]=='CRUISE'){echo"selected";}echo">CRUISE</option>
               <option value='DOMESTIC'";if($r[ProductcodeArea]=='DOMESTIC'){echo"selected";}echo">DOMESTIC</option>
               <option value='EAST EUROPE'";if($r[ProductcodeArea]=='EAST EUROPE'){echo"selected";}echo">EAST EUROPE</option>
               <option value='HONG KONG'";if($r[ProductcodeArea]=='HONG KONG'){echo"selected";}echo">HONG KONG</option>
               <option value='JAPAN'";if($r[ProductcodeArea]=='JAPAN'){echo"selected";}echo">JAPAN</option>
               <option value='KOREA'";if($r[ProductcodeArea]=='KOREA'){echo"selected";}echo">KOREA</option>
               <option value='MEDITERANNEAN'";if($r[ProductcodeArea]=='MEDITERANNEAN'){echo"selected";}echo">MEDITERANNEAN</option>
               <option value='NEW ZEALAND'";if($r[ProductcodeArea]=='NEW ZEALAND'){echo"selected";}echo">NEW ZEALAND</option>
               <option value='NORTH EUROPE'";if($r[ProductcodeArea]=='NORTH EUROPE'){echo"selected";}echo">NORTH EUROPE</option>
               <option value='PMT'";if($r[ProductcodeArea]=='PMT'){echo"selected";}echo">PMT</option>
               <option value='SOUTH AMERICA'";if($r[ProductcodeArea]=='SOUTH AMERICA'){echo"selected";}echo">SOUTH AMERICA</option>
               <option value='SOUTH EAST ASIA'";if($r[ProductcodeArea]=='SOUTH EAST ASIA'){echo"selected";}echo">SOUTH EAST ASIA</option>
               <option value='SOUTH EUROPE'";if($r[ProductcodeArea]=='SOUTH EUROPE'){echo"selected";}echo">SOUTH EUROPE</option>
               <option value='TAIWAN'";if($r[ProductcodeArea]=='TAIWAN'){echo"selected";}echo">TAIWAN</option>
               <option value='WEST EUROPE'";if($r[ProductcodeArea]=='WEST EUROPE'){echo"selected";}echo">WEST EUROPE</option>
          </select></td></tr>
          <tr><td>Product By</td> <td>  <select name='ProductcodeBy'>";    
               /*<option value='ACA'";if($r[ProductcodeBy]=='ACA'){echo"selected";}echo">ACA</option>
               <option value='DOM'";if($r[ProductcodeBy]=='DOM'){echo"selected";}echo">DOM</option>
               <option value='EEA'";if($r[ProductcodeBy]=='EEA'){echo"selected";}echo">EEA</option>
               <option value='GRV'";if($r[ProductcodeBy]=='GRV'){echo"selected";}echo">GRV</option>
               <option value='PMT'";if($r[ProductcodeBy]=='PMT'){echo"selected";}echo">PMT</option>*/
          echo "<option value='GROUP A'";if($r[ProductcodeBy]=='GROUP A'){echo"selected";}echo">GROUP A</option>
               <option value='GROUP B'";if($r[ProductcodeBy]=='GROUP B'){echo"selected";}echo">GROUP B</option>
               <option value='NONE'";if($r[ProductcodeBy]=='NONE'){echo"selected";}echo">NONE</option>
               </select></td></tr>  
          <tr><td>Destination</td>     <td>$r[ProductcodeDestination]</td></tr>                
          
          </table>
          <table id='country' border='1'>";   
           $i=0;
           $coba=mysql_query("SELECT * FROM tour_countryprodcode where IDProductcode ='$_GET[id]' ");
            $baris=mysql_num_rows($coba);
            if ($baris==0){
                for($a=0;$a<7;$a++) {
                echo"<tr>
                      <td>Country&nbsp</td>
                      <td><select name='ProductcodeCountry[]' id='productcodecountry'>
                      <option value='0' selected>- Select -</option>";
                $tampil=mssql_query("SELECT Country FROM Destination where Region = '$r[ProductcodeDestination]' group by Country");
                while($w=mssql_fetch_array($tampil)){
                    echo "<option value='$w[Country]'>$w[Country]</option>";  
                }
                echo "</select></td>
                </tr>";
                }
                echo"</table>";
            }else {
                $a=7;
                $x=$a-$baris;
                while($tes=mysql_fetch_array($coba)){
            echo"
          <tr>
          <td>Country</td>
          <td><select name='ProductcodeCountry[]'  id='productcodecountry'>
          <option value='0' selected>- Select -</option>";
                $tampil=mssql_query("SELECT Country FROM Destination where Region = '$r[ProductcodeDestination]' group by Country");
                while($w=mssql_fetch_array($tampil)){
             if ($tes[Country]==$w[Country]){
                     echo "<option value='$w[Country]' selected>$w[Country]</option>";
                } else {
                    echo "<option value='$w[Country]'>$w[Country]</option>";
                }     
            }
            echo "</select></td></tr>";
            }
                for($b=0;$b<$x;$b++) {
                    echo"<tr>
                      <td>Country&nbsp</td>
                      <td><select name='ProductcodeCountry[]' id='productcodecountry'>
                      <option value='0' selected>- Select -</option>";
                    $tampil=mssql_query("SELECT Country FROM Destination where Region = '$r[ProductcodeDestination]' group by Country");
                    while($w=mssql_fetch_array($tampil)){
                        echo "<option value='$w[Country]'>$w[Country]</option>";
                    }
                    echo "</select></td>
                </tr>";
                }
                echo"
          </table>";
          }
    echo"  
    <center><input type=radio name='ProductcodeStatus' value='ACTIVE' ";if($r[ProductcodeStatus]=='ACTIVE'){echo"checked";}echo">&nbsp;Active
            <input type=radio name='ProductcodeStatus' value='INACTIVE' ";if($r[ProductcodeStatus]=='INACTIVE'){echo"checked";}echo">&nbspInactive  <br><br>
    <center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()>
          </form>";
    break;  
	
  case "deleteproductcode":
    $EmployeeID=$_SESSION[employeeid];
$sqluser=mysql_query("SELECT EmployeeName FROM tbl_msemployee WHERE EmployeeID='$EmployeeID'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName = $tampiluser[EmployeeName];     
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
     $edit=mysql_query("DELETE FROM tour_msproductcode WHERE IDProductcode ='$_GET[id]'"); 
     $Description="Delete productcode (".$_GET[prod].") "; 
     mysql_query("INSERT INTO tour_log(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");             
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproductcode'>";   
     break;
} 
?>
