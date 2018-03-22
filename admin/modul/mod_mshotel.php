<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>
<script language="JavaScript"  type="text/javascript">
function showCity()
 {                                    
 <?php                                                   
 // membaca semua data currency
 $query = "SELECT Country FROM dbo.DestinationList ";
 $hasil = mssql_query($query);
 
 // membuat if untuk masing-masing pilihan currency 
 while ($data = mssql_fetch_array($hasil))
 {
   $idDest = $data['Country'];                                                  
   // membuat IF untuk masing-masing currency
   echo "if (document.example.Country.value == \"".$idDest."\")"; 
   echo "{";       
    
   // membuat hasil kurs untuk masing-masing currency
   $query2 = "SELECT City FROM dbo.DestinationList 
                WHERE Country = '$idDest' order by City ";
   $hasil2 = mssql_query($query2);
   $content = "document.getElementById('City').innerHTML = \"";
   $content .= "<option value=''>- Select City-</option>";
   while ($data2 = mssql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['City']."'>".$data2['City']."</option>";
   }
   $content .= "\"";
   echo $content;
   echo "}\n";
   echo "else if (document.example.Country.value == ''){";
   
   // membuat hasil kurs untuk masing-masing currency
   $content = "document.getElementById('City').innerHTML = \"";
   $content .= "<option value=''></option>";
   
   $content .= "\"";
   echo $content;
   echo "}\n";          
 }
  ?>
 
 }
function isNumber(field) {
var re = /^[0-9'.']*$/;
if (!re.test(field.value)) {
alert('PLEASE INPUT NUMBER!');
field.value = field.value.replace(/[^0-9'.']/g,"");
}
} 
function validateFormOnSubmit(theForm) {
var reason = ""; 
  reason += validateEmail(theForm.Email);            
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);
    return false;
  }

  return true;
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
</script>
<SCRIPT type="text/javascript">
pic1 = new Image(16, 16); 
pic1.src = "./modul/loader.gif";

function cektelp() { 

var tlp = $("#Telephone").val();  
if(tlp.length > 0)
{                           
$("#status").html('<img src="./modul/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "./modul/checkhotel.php",  
    data: { telepon: tlp },
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

    if(msg == 'OK')
    {   document.example.elements['submit'].disabled=false;
        $("#Telephone").removeClass('object_error'); // if necessary
        $("#Telephone").addClass("object_ok");
        $(this).html('&nbsp;<img src="./modul/tick.gif" align="absmiddle">');
    }  
    else  
    {   document.example.elements['submit'].disabled=true;
        $("#Telephone").removeClass('object_ok'); // if necessary
        $("#Telephone").addClass("object_error");
        $(this).html(msg);
    }          
   });         
 }              
  });
  }
else
    {
    $("#status").html('<font color="red">Telephone should have at least <strong>7</strong> digit number.</font>');
    $("#Telephone").removeClass('object_ok'); // if necessary
    $("#Telephone").addClass("object_error");
    document.example.elements['submit'].disabled=true;
    }   
}

//-->
</SCRIPT>
<?php 
switch($_GET[act]){
  // Tampil Supplier
  default:
  	$nama=$_GET['nama'];
    echo "<h2>Master Hotel</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='mshotel'>
			  <input type=text name=nama value='$nama' size=40>	
			  <input type=submit name=oke value=Search>
		  </form><input type=button value='Add Hotel' onclick=location.href='?module=mshotel&act=tambahhotel'>";
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
		    $tampil=mysql_query("SELECT * FROM tour_mshotel 
								WHERE HotelName LIKE '%$nama%'
								OR Address LIKE '%$nama%'
                                OR Country LIKE '%$nama%'
                                OR City LIKE '%$nama%'
								ORDER BY HotelName ASC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>Hotel</th><th>Address</th><th>Website</th><th>Telephone</th><th>Country</th><th>City</th><th>action</th></tr>";
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
                    if($data[Website]=='www.'){$web='';}else{$web=$data[Website];}
			   echo "<tr><td>$no</td>
					 <td>$data[HotelName]</td>	   
					 <td>$data[Address]</td>
					 <td><a href='http://$data[Website]' target='_blank' style=text-decoration:none>$web</a></td>
                     <td>+$data[Telephone]</td>
                     <td>$data[Country]</td>
					 <td>$data[City]</td>       
					 <td><center><a href=?module=mshotel&act=edithotel&id=$data[IDHotel]>Edit</a>
					         ";
					  $no++;
					}   //|
                     //<a href=\"javascript:delfile('$data[IDSupplier]','$data[SupplierName]')\">Delete</a></td></tr>
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tour_mshotel 
                                WHERE HotelName LIKE '%$nama%'
                                OR Address LIKE '%$nama%'
                                OR Country LIKE '%$nama%'
                                OR City LIKE '%$nama%'
                                ORDER BY HotelName ASC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=mshotel";
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
  
  case "tambahhotel":
    echo "<h2>Add New Hotel</h2>
          <form method='POST' name='example' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=mshotel&act=input'>
          <table>
		  <tr><td>Hotel Name</td> <td>  <input type=text name='HotelName' size=30 required></td></tr>   
		  <tr><td>Address</td> <td>  <textarea rows='3' cols='27' name='Address' required></textarea></td></tr>
          <tr>
          <td>Country</td><td><select name='Country' onChange='showCity()' required>
              <option value='' selected>- Select Country -</option>";
            $tampil=mssql_query("SELECT Country FROM dbo.DestinationList group by Country");
            while($w=mssql_fetch_array($tampil)){    
                 echo "<option value='$w[Country]'>$w[Country]</option>";  
            }
    echo "</select></td></tr>
          <tr><td>City</td><td><select name='City' id='City' required></select></td></tr>
          <tr><td>Telephone<font color='red'>*</font></td> <td>  <input type=text name='Telephone' id='Telephone' size='15' onkeyup='isNumber(this)' onBlur='cektelp()'> ex: 622125565555 <div  id='status'></div></td></tr>
          <tr><td>Fax Number</td> <td>  <input type=text name='Fax' size='15' onkeyup='isNumber(this)'> ex: 622125565556</td></tr> 
          <tr><td>E-mail</td> <td>  <input type=text name='Email' size=30></td></tr>
          <tr><td>Website</td> <td>  http://<input type=text name='Website' value='www.' size=30></td></tr>
          <tr><td>Class</td> <td>      
          <select name='Class'>     
          <option value='Undefined'>Undefined</option>
          <option value='1'>* [1 star]</option>
          <option value='2'>** [2 star]</option>
          <option value='3'>*** [3 star]</option>
          <option value='4'>**** [4 star]</option>
          <option value='5'>***** [5 star]</option>
          <option value='6'>****** [6 star]</option>
          <option value='7'>******* [7 star]</option> 
          </select></td></tr>       
          <tr><td>Status</td> <td><select name='Active'>    
            <option value='True' selected>Active</option>
            <option value='False' >Inactive</option>   
            </select></td></tr>
          </table>      
          <center><input type='submit' name='submit' value='Save' disabled>
                            <input type=button value=Cancel onclick=self.history.back()>
          </form><br><br>";
     break;
    
  case "edithotel":
    $edit=mysql_query("SELECT * FROM tour_mshotel WHERE IDHotel='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Hotel</h2>
          <form method='POST' name='example' action=./aksi.php?module=mshotel&act=update>
          <input type=hidden name=id value='$r[IDHotel]'>
          <table>
          <tr><td>Hotel Name</td> <td>  <input type=text name='HotelName' size='30' value='$r[HotelName]' required></td></tr>   
          <tr><td>Address</td> <td>  <textarea rows='3' cols='27' name='Address' required>$r[Address]</textarea></td></tr>
          <tr>
          <td>Country</td><td><select name='Country' onChange='showCity()' required>
              <option value='' selected>- Select Country -</option>";
            $tampil=mssql_query("SELECT Country FROM dbo.DestinationList group by Country");
            while($w=mssql_fetch_array($tampil)){
                if($r[Country]==$w[Country]){
                    echo "<option value='$w[Country]' selected>$w[Country]</option>";
                }else{
                    echo "<option value='$w[Country]'>$w[Country]</option>";
                }                                                   
            }
    echo "</select></td></tr>
          <tr><td>City</td><td><select name='City' id='City' required>
          <option value='' selected>- Select City -</option>";
            $tampil=mssql_query("SELECT City FROM dbo.DestinationList 
                WHERE Country = '$r[Country]' order by City");
            while($w=mssql_fetch_array($tampil)){
                if($r[City]==$w[City]){
                    echo "<option value='$w[City]' selected>$w[City]</option>";
                }else{
                    echo "<option value='$w[City]'>$w[City]</option>";
                }                                                   
            }
    echo "</select></td></tr>
          <tr><td>Telephone</td> <td>+$r[Telephone]</td></tr>
          <tr><td>Fax Number</td> <td>  <input type=text name='Fax' size='15' value='$r[Fax]' onkeyup='isNumber(this)'> ex: 622125565556</td></tr> 
          <tr><td>E-mail</td> <td>  <input type=text name='Email' value='$r[Email]' size=30></td></tr>
          <tr><td>Website</td> <td>  http://<input type=text name='Website' value='$r[Website]' size=30></td></tr>
          <tr><td>Class</td> <td>
          <select name='Class'>     
          <option value='Undefined'";if($r['Class']=='Undefined'){echo"selected";}echo">Undefined</option>
          <option value='1'";if($r['Class']=='1'){echo"selected";}echo">* [1 star]</option>
          <option value='2'";if($r['Class']=='2'){echo"selected";}echo">** [2 star]</option>
          <option value='3'";if($r['Class']=='3'){echo"selected";}echo">*** [3 star]</option>
          <option value='4'";if($r['Class']=='4'){echo"selected";}echo">**** [4 star]</option>
          <option value='5'";if($r['Class']=='5'){echo"selected";}echo">***** [5 star]</option>
          <option value='6'";if($r['Class']=='6'){echo"selected";}echo">****** [6 star]</option>
          <option value='7'";if($r['Class']=='7'){echo"selected";}echo">******* [7 star]</option> 
          </select></td></tr>       
          <tr><td>Status</td> <td><select name='Active'>    
            <option value='True'";if($r['Active']=='True'){echo"selected";}echo">Active</option>
            <option value='False'";if($r['Active']=='False'){echo"selected";}echo">Inactive</option>   
            </select></td></tr>
          </table> 
          <center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()>
          </form>";
    break;  
	
  case "deletesupplier":
  $EmployeeID=$_SESSION[Employeeid];
$sqluser=mysql_query("SELECT EmployeeName FROM tbl_msemployee WHERE EmployeeID='$EmployeeID'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName = $tampiluser[EmployeeName];     
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
     $edit=mysql_query("DELETE FROM tour_mshotel WHERE IDSupplier ='$_GET[id]'"); 
     $Description="Delete Supplier (".$_GET[sup].") "; 
     mysql_query("INSERT INTO tour_log(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");             
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mshotel'>";   
     break;
} 
?>
