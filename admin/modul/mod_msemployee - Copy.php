<script language="JavaScript"  type="text/javascript">     
function delfile(ID, Employee)         
{
if (confirm("Are you sure you want to delete "+ Employee +" "))
{
 window.location.href = '?module=msemployee&act=deleteemployee&id=' + ID +'&emp='+ Employee ;
 
} 
}
</script>    
<script type="text/javascript"> 
function validateFormOnSubmit(theForm) {
var reason = "";                            
  reason += validateEmpty(theForm.employee_id);
  reason += validateEmpty(theForm.EmployeePassword);
  reason += validateEmpty(theForm.employee_name); 
  reason += validatePhone(theForm.EmployeeMobile);
  reason += validateSelect(theForm.office_id);
  reason += validateEmail(theForm.EmployeeEmail);  
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
function validateEditOnSubmit(theForm) {
var reason = "";                                    
  reason += validateEmpty(theForm.employee_name); 
  reason += validatePhone(theForm.EmployeeMobile);
  reason += validateSelect(theForm.office_id);
  reason += validateEmail(theForm.EmployeeEmail);  
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

$(document).ready(function(){

$("#employee_id").change(function() { 

var usr = $("#employee_id").val();

if(usr.length >= 4)
{
$("#status").html('<img src="./modul/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "./modul/check.php",  
    data: "employee_id="+ usr,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

    if(msg == 'OK')
    { 
        $("#employee_id").removeClass('object_error'); // if necessary
        $("#employee_id").addClass("object_ok");
        $(this).html('&nbsp;<img src="./modul/tick.gif" align="absmiddle">');
    }  
    else  
    {  
        $("#employee_id").removeClass('object_ok'); // if necessary
        $("#employee_id").addClass("object_error");
        $(this).html(msg);
    }  
   
   });

 } 
   
  }); 

}
else
    {
    $("#status").html('<font color="red">Employee ID should have at least <strong>8</strong> characters.</font>');
    $("#employee_id").removeClass('object_ok'); // if necessary
    $("#employee_id").addClass("object_error");
    }

});

});

//-->
</SCRIPT>
<?php 
switch($_GET[act]){
  // Tampil Employee
  default:
  	$nama=$_GET['nama'];
    echo "<h2>Master Employee</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='msemployee'>
			  <input type=text name=nama value='$nama' size=40>	
			  <input type=submit name=oke value=Search>
		  </form><input type=button value='Add Employee' onclick=location.href='?module=msemployee&act=tambahmsemployee'>";
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
		    $tampil=mysql_query("SELECT * FROM tbl_msemployee 
								LEFT JOIN tbl_msoffice ON tbl_msemployee.office_id = tbl_msoffice.office_id
								WHERE tbl_msemployee.employee_name LIKE '%$nama%'
								OR tbl_msoffice.office_name LIKE '%$nama%'
								ORDER BY employee_name ASC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>ID</th><th>employee</th><th>Division</th><th>action</th></tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
			   echo "<tr><td>$no</td>
					 <td>$data[employee_code]</td>	   
					 <td>$data[employee_name]</td>
					 <td>$data[office_name]</td> 		 
					 <td>"; if($_SESSION[employee_id]=='TMC-06870'){
                        echo"
                             <a href=?module=msemployee&act=editmsemployee&id=$data[employee_id]>Edit</a>
                             |
                             <a href=\"javascript:delfile('$data[employee_id]','$data[employee_id]')\">Delete</a>";
                     }else {
                     
                     if($data[employee_id]=='TMC-06870'or $data[employee_id]=='TMC-03509'or $data[employee_id]=='TMC-081445'){
                             echo"<center>Master ";
                     } else { echo"
                             <a href=?module=msemployee&act=editmsemployee&id=$data[employee_id]>Edit</a>
					         |
					         <a href=\"javascript:delfile('$data[employee_id]','$data[employee_id]')\">Delete</a>";
					         } }
               echo "</td></tr>";
					  $no++;
					}
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tbl_msemployee 
                                LEFT JOIN tbl_msoffice ON tbl_msemployee.office_id = tbl_msoffice.office_id
                                WHERE tbl_msemployee.employee_name LIKE '%$nama%'
                                OR tbl_msoffice.office_name LIKE '%$nama%'
                                ORDER BY employee_name ASC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=msemployee";
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
  
  case "tambahmsemployee":
    echo "<h2>Add New Employee</h2>
          <form method='POST' name='example' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msemployee&act=input'>
          <table>
		  <tr><td>Employee ID</td> <td> <input type=text id='employee_id' name='employee_id' size=10><div  id='status'></td></tr>
		  <tr><td>Password</td> <td>  <input type=password name='EmployeePassword' size=30></td></tr>  
		  <tr><td>Name</td> <td>  <input type=text name='employee_name' size=30></td></tr>
		  <tr><td>Mobile Phone</td> <td>  <input type=text name='EmployeeMobile' size=15></td></tr>
          <tr><td>Tour Leader Assigned</td> <td>  <input type='checkbox' name='EmployeeTL'> YES</td></tr>
          <tr><td>Division</td>  <td>  
          <select name='office_id'>
            <option value='0' selected>- Select Division -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name ASC");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[office_id]>$r[DivisionID] - $r[office_name]</option>";
            }
    echo "</select></td></tr>
          <tr><td>Job Title</td> <td><select name='EmployeeTitle'>
            <option value='STAFF' selected>Staff</option>
            <option value='TRAVEL CONSULTANT'>Travel Consultant</option>
            <option value='TRAVEL TRAINEE'>Travel Trainee</option>
            <option value='SUPERVISOR'>Supervisor</option>
            <option value='ASST MANAGER'>Asst Manager</option>
            <option value='MANAGER'>Manager</option>
            <option value='ASST VICE PRESIDENT'>Asst Vice President</option> 
            <option value='VICE PRESIDENT'>Vice President</option>
            <option value='DIRECTOR'>Director</option>
            <option value='CEO'>CEO</option>
            </select></td></tr>
		  <tr><td>User Level</td> <td>  
          <select name='ltm_authority'>
            <option value='ADMINISTRATOR'>Administrator</option>
            <option value='LEISURE SALES SUPPORT'>Leisure Sales Support</option>
            <option value='LEISURE OPERATION'>Leisure Operation</option>
            <option value='LEISURE PRODUCT'>Leisure Product</option>
            <option value='LEISURE TRAVEL MANAGEMENT'>Leisure Travel Management</option> 
            <option value='OTHERS' selected>Others</option>
            </select>                                                        
          </td></tr>          
          <tr><td>E-mail</td> <td>  <input type=text name='EmployeeEmail' size=30></td></tr>
          <tr><td>Status</td> <td><select name='EmployeeStatus'>    
            <option value='1' selected>Active</option>
            <option value='2' >Inactive</option>   
            </select></td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;
    
  case "editmsemployee":
    $edit=mysql_query("SELECT * FROM tbl_msemployee WHERE employee_id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Employee</h2>
          <form method='POST' name='example' onsubmit='return validateEditOnSubmit(this)' action=./aksi.php?module=msemployee&act=update>
          <input type=hidden name=id value='$r[employee_id]'>
          <table>
          <tr><td>Employee ID</td> <td> <input type=text name='employee_id' size='10' value='$r[employee_id]' readonly></td></tr>
          <tr><td>Password</td> <td>  <input type=password name='EmployeePassword' size=30></td></tr>  
          <tr><td colspan=2><font color=red>*<i>Leave blank password if you dont want to change it</i></font></td></tr>
          <tr><td>Name</td> <td>  <input type=text name='employee_name' size='30' value='$r[employee_name]'></td></tr>
          <tr><td>Mobile Phone</td> <td>  <input type=text name='EmployeeMobile' size='15' value='$r[EmployeeMobile]'></td></tr>
          <tr><td>Tour Leader Assigned</td> <td>  <input type='checkbox' name='EmployeeTL'";if($r[EmployeeTL]=='on'){echo"checked";} echo"> YES</td></tr>
          <tr><td>Division</td>  <td>  
          <select name='office_id'>
            <option value='0' selected>- Select Division -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name ASC");
            while($m=mysql_fetch_array($tampil)){
             if($r[office_id]==$m[office_id]){ 
                echo "<option value='$m[office_id]' selected>$m[DivisionID] - $m[office_name]</option>";
             } else {
                echo "<option value='$m[office_id]'>$m[DivisionID] - $m[office_name]</option>"; 
             }
             }
    echo "</select></td></tr>
          <tr><td>Job Title</td> <td><select name='EmployeeTitle'>
            <option value='STAFF'";if($r[EmployeeTitle]=='STAFF'){echo"selected";} echo">Staff</option>
            <option value='TRAVEL CONSULTANT'";if($r[EmployeeTitle]=='TRAVEL CONSULTANT'){echo"selected";} echo">Travel Consultant</option>
            <option value='TRAVEL TRAINEE'";if($r[EmployeeTitle]=='TRAVEL TRAINEE'){echo"selected";} echo">Travel Trainee</option>
            <option value='SUPERVISOR'";if($r[EmployeeTitle]=='SUPERVISOR'){echo"selected";} echo">Supervisor</option>
            <option value='ASST MANAGER'";if($r[EmployeeTitle]=='ASST MANAGER'){echo"selected";} echo">Asst Manager</option>
            <option value='MANAGER'";if($r[EmployeeTitle]=='MANAGER'){echo"selected";} echo">Manager</option>
            <option value='ASST VICE PRESIDENT'";if($r[EmployeeTitle]=='ASST VICE PRESIDENT'){echo"selected";} echo">Asst Vice President</option> 
            <option value='VICE PRESIDENT'";if($r[EmployeeTitle]=='VICE PRESIDENT'){echo"selected";} echo">Vice President</option>
            <option value='DIRECTOR'";if($r[EmployeeTitle]=='DIRECTOR'){echo"selected";} echo">Director</option>
            <option value='CEO'";if($r[EmployeeTitle]=='CEO'){echo"selected";} echo">CEO</option>
            </select></td></tr>
          <tr><td>User Level</td> <td>  
          <select name='ltm_authority'>
            <option value='ADMINISTRATOR'";if($r[ltm_authority]=='ADMINISTRATOR'){echo"selected";} echo">Administrator</option>
            <option value='LEISURE SALES SUPPORT'";if($r[ltm_authority]=='LEISURE SALES SUPPORT'){echo"selected";} echo">Leisure Sales Support</option>
            <option value='LEISURE OPERATION'";if($r[ltm_authority]=='LEISURE OPERATION'){echo"selected";} echo">Leisure Operation</option>
            <option value='LEISURE PRODUCT'";if($r[ltm_authority]=='LEISURE PRODUCT'){echo"selected";} echo">Leisure Product</option>
            <option value='LEISURE TRAVEL MANAGEMENT'";if($r[ltm_authority]=='LEISURE TRAVEL MANAGEMENT'){echo"selected";} echo">Leisure Travel Management</option> 
            <option value='OTHERS'";if($r[ltm_authority]=='OTHERS'){echo"selected";} echo">Others</option>
            </select>                                                        
          </td></tr>          
          <tr><td>E-mail</td> <td>  <input type=text name='EmployeeEmail' size='30' value='$r[EmployeeEmail]'></td></tr>
          <tr><td>Status</td> <td><select name='EmployeeStatus'>    
            <option value='1' ";if($r[active]=='1'){echo"selected";}echo">Active</option>
            <option value='2' ";if($r[active]=='2'){echo"selected";}echo">Inactive</option>   
            </select></td></tr>                                                             
          <tr><td colspan=2><center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
	
  case "deletemsemployee":
  $employee_id=$_SESSION[employee_id];
$sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_id='$employee_id'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName = $tampiluser[employee_name];     
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
     $edit=mysql_query("DELETE FROM tbl_msemployee WHERE employee_id ='$_GET[id]'"); 
     $Description="Delete Employee (".$_GET[emp].") "; 
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");             
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msemployee'>";   
     break;
} 
?>
