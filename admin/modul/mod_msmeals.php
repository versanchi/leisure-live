<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>
<script language="JavaScript"  type="text/javascript">
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
    echo "<h2>Meals Menu</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='msmeals'>
			  <input type=text name=nama value='$nama' size=40>	
			  <input type=submit name=oke value=Search>
		  </form><input type=button value='Add Meals' onclick=location.href='?module=msmeals&act=tambahmeals'>";
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
		    $tampil=mysql_query("SELECT * FROM tour_mealstype 
								WHERE MealsName LIKE '%$nama%'
								ORDER BY MealsStatus,MealsName ASC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>Name</th><th>status</th><th>action</th></tr>";
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
                    if($data[Website]=='www.'){$web='';}else{$web=$data[Website];}
			   echo "<tr><td>$no</td>
					 <td>$data[MealsName]</td>
					 <td>$data[MealsStatus]</td>
					 <td><center><a href=?module=msmeals&act=editmeals&id=$data[MealsID]>Edit</a>
					         ";
					  $no++;
					}   //|
                     //<a href=\"javascript:delfile('$data[IDSupplier]','$data[SupplierName]')\">Delete</a></td></tr>
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tour_mealstype 
                                WHERE MealsName LIKE '%$nama%'
                                ORDER BY MealsName ASC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=msmeals";
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
  
  case "tambahmeals":
    echo "<h2>Add New Meals</h2>
          <form method='POST' name='example' action='./aksi.php?module=msmeals&act=input'>
          <table>
		  <tr><td>Meals Name</td> <td>  <input type=text name='mealsname' size=30 required></td></tr>
          <tr><td>Status</td> <td><select name='mealsstatus'>
            <option value='ACTIVE' selected>Active</option>
            <option value='INACTIVE' >Inactive</option>
            </select></td></tr>
          </table>      
          <center><input type='submit' name='submit' value='Save'>
                            <input type=button value=Cancel onclick=self.history.back()>
          </form><br><br>";
     break;
    
  case "editmeals":
    $edit=mysql_query("SELECT * FROM tour_mealstype WHERE MealsID='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Meals</h2>
          <form method='POST' name='example' action=./aksi.php?module=msmeals&act=update>
          <input type=hidden name=id value='$r[MealsID]'>
          <table>
          <tr><td>Meals Name</td> <td>  <input type=text name='mealsname' size='30' value='$r[MealsName]' readonly></td></tr>
          <tr><td>Status</td> <td><select name='mealsstatus'>
            <option value='ACTIVE'";if($r['MealsStatus']=='ACTIVE'){echo"selected";}echo">Active</option>
            <option value='INACTIVE'";if($r['MealsStatus']=='INACTIVE'){echo"selected";}echo">Inactive</option>
            </select></td></tr>
          </table> 
          <center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()>
          </form>";
    break;  

} 
?>
