<link type="text/css" href="../head/jquery-ui-1.7.2.custom.css" rel="stylesheet" />    
<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>
<script language="JavaScript"  type="text/javascript">     
function delfile(ID, TourLeader)         
{
if (confirm("Are you sure you want to delete "+ TourLeader +" "))
{
 window.location.href = '?module=mstourleader&act=deletetourleader&id=' + ID +'&tl='+ TourLeader ;
 
} 
}
</script> 
<script type="text/javascript"> 
function isNumber(field) {
var re = /^[0-9'.']*$/;
if (!re.test(field.value)) {
alert('VALUE MUST BE NUMBER !');
field.value = field.value.replace(/[^0-9'.']/g,"");
}                                 
}
function validateFormOnSubmit(theForm) {
var reason = "";
  if (document.example.TourleaderType.value == "IN HOUSE"){
  reason += validateSelect(theForm.TourleaderNameS);
  }else if (document.example.TourleaderType.value == "FREELANCE"){
  reason += validateEmptys(theForm.TourleaderName);
  }  
  reason += validateTelp(theForm.TourleaderMobile);      
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);
    return false;
  }

  return true;
}
function validateTelp(fld) {
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
function validateEmptys(fld) {
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
function lockTl()
 {                                            
 if (document.example.TourleaderType.value == "IN HOUSE") { 
    document.getElementById('TourleaderName').type='hidden';
    document.getElementById('TourleaderNameS').style.visibility='visible';  
    document.example.elements['Divisi'].disabled=false ; 
    document.example.TourleaderName.value = ""                               
 }else if (document.example.TourleaderType.value == "FREELANCE"){ 
    document.getElementById('TourleaderName').type='text';
    document.getElementById('TourleaderNameS').style.visibility='hidden';  
    document.example.elements['Divisi'].disabled=true ;
    document.getElementById('Divisi').selectedIndex=0; 
    document.getElementById('TourleaderNameS').innerHTML = "<option value='0'></option>";    
 }  
 }
function showTl()
 {                                    
 <?php                                                   
 // membaca semua data currency
 $query = "SELECT * FROM tbl_msoffice ";
 $hasil = mysql_query($query);
 
 // membuat if untuk masing-masing pilihan currency 
 while ($data = mysql_fetch_array($hasil))
 {
   $idDest = $data['office_id'];                                                  
   // membuat IF untuk masing-masing currency
   echo "if (document.example.Divisi.value == \"".$idDest."\")"; 
   echo "{";       
    
   // membuat hasil kurs untuk masing-masing currency
   $query2 = "SELECT * FROM tbl_msemployee 
                LEFT JOIN tbl_msoffice ON tbl_msoffice.office_id = tbl_msemployee.office_id
                WHERE tbl_msemployee.office_id = '$idDest' AND tbl_msemployee.active='1' order by employee_name ";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('TourleaderNameS').innerHTML = \"";
   $content .= "<option value='0'>- Select -</option>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['employee_code']."'>".$data2['employee_name']."</option>";
   }
   $content .= "\"";
   echo $content;
   echo "}\n";
   echo "else if (document.example.Divisi.value == '0'){";
   
   // membuat hasil kurs untuk masing-masing currency
   $content = "document.getElementById('TourleaderNameS').innerHTML = \"";
   $content .= "<option value=''></option>";
   
   $content .= "\"";
   echo $content;
   echo "}\n";          
 }
  ?>           
 }
function ganti()
{
    document.getElementById("myform").submit();
}
</script>   
         <script type="text/javascript">
            $(document).ready(function(){
                
                //    -- Datepicker
                $(".my_date").datepicker({
                    dateFormat: 'dd-mm-yy',
                    showButtonPanel: true
                });                    
                              
                // -- Clone table rows
                $(".cloneTableRows").live('click', function(){

                    // this tables id
                    var thisTableId = $(this).parents("table").attr("id");
                
                    // lastRow
                    var lastRow = $('#'+thisTableId + " tr:last");
                      
                    var rowCount = $('#'+thisTableId).attr('rows').length;
                    //alert(rowCount);
        
                    // clone last row
                    var newRow = lastRow.clone(true);
                    
                    // append row to this table
                    $('#'+thisTableId).append(newRow);
                    
                    // make the delete image visible
                    $('#'+thisTableId + " tr:last td:first img").css("visibility", "visible");
                    
                     
                     
                    // clear the inputs (Optional)
                    $('#'+thisTableId + " tr:last td :input").val('');
                    
                    // new rows datepicker need to be re-initialized
                    $(newRow).find("input").each(function(){
                        if($(this).hasClass("hasDatepicker")){ // if the current input has the hasDatpicker class
                            var this_id = $(this).attr("id"); // current inputs id
                            var new_id = this_id +1; // a new id
                            $(this).attr("id", new_id); // change to new id  
                           // $(this).attr("value", new_id); 
                            $(this).removeClass('hasDatepicker'); // remove hasDatepicker class
                             // re-init datepicker
                            $(this).datepicker({
                                dateFormat: 'dd-mm-yy',
                                showButtonPanel: true , 
                            });                  
                        }        
                        
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
<?php 
switch($_GET[act]){
  // Tampil Country
  default:
  	$nama=$_GET['nama'];
    $stts=$_GET['status'];
    if($stts==''){$stts='ACTIVE';}else{$stts=$stts;}
    echo "<h2>Master Tour Leader</h2>
		  <form method=get id='myform' action='media.php?'>
		  	  <input type=hidden name=module value='mstourleader'>
			  <select name='status' onChange=ganti()>
              <option value='ACTIVE' ";if($stts=='ACTIVE'){echo"selected";}echo">ACTIVE</option>
              <option value='INACTIVE' ";if($stts=='INACTIVE'){echo"selected";}echo">INACTIVE</option>
              </select>
			  <input type=text name=nama value='$nama' size=40>
			  <input type=submit name=oke value=Search>
		  </form><input type=button value='Add Tour Leader' onclick=location.href='?module=mstourleader&act=tambahtourleader'>";
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
		    $tampil=mysql_query("SELECT * FROM tour_mstourleader 
								WHERE TourleaderName LIKE '%$nama%'
								AND TourleaderStatus = '$stts'
								ORDER BY TourleaderName ASC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>Name</th><th>Nick Name</th><th>Mobile</th><th>Type</th><th>status</th><th>action</th></tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
                    if($data[TourleaderStatus]=='ACTIVE'){$stat="<font color=blue>ACTIVE</font>";}else
                    if($data[TourleaderStatus]=='INACTIVE'){$stat="<font color=red>INACTIVE</font>";}
                    if($data[TourleaderGender]=='MALE'){$gen='Mr.';}else if($data[TourleaderGender]=='FEMALE'){$gen='Ms.';}else{$gen='';}
			   echo "<tr><td>$no</td>         
                     <td>$gen $data[TourleaderName]</td>
                     <td>$data[TourleaderNickName]</td>
                     <td>$data[TourleaderMobile]</td>
                     <td>$data[TourleaderType]</td>
                     <td>$stat</td>   
					 <td><center><a href=?module=mstourleader&act=edittourleader&id=$data[IDTourleader]>Edit</a>
					 &nbsp;
					 </td></tr>";
					  $no++;
					}  //|&nbsp; 
                    // <a href=\"javascript:delfile('$data[IDTourleader]','$data[TourleaderName]')\">Delete</a> 
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tour_mstourleader 
                                WHERE TourleaderName LIKE '%$nama%'
                                AND TourleaderStatus = '$stts'
                                ORDER BY TourleaderName ASC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=mstourleader";
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
  
  case "tambahtourleader":
    echo "<h2>New Tour Leader</h2>
          <form method='POST' name='example' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=mstourleader&act=input'>
          <table>                                                                                    
          <tr><td>TL Type</td> <td><select name='TourleaderType' onChange='lockTl()'>    
            <option value='FREELANCE' selected>FREELANCE</option> 
            <option value='IN HOUSE'>IN HOUSE</option>     
            </select></td></tr> 
          <tr><td>Divisi</td> <td> <select name='Divisi' id='Divisi' onChange='showTl()' disabled>
            <option value=0 selected>- Select Divisi -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msemployee 
                                left join tbl_msoffice on tbl_msoffice.office_id = tbl_msemployee.office_id
                                where tbl_msoffice.active ='1'
                                group by tbl_msemployee.office_id
                                order by office_code ASC");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[office_id]>$r[office_code]</option>";
            }
    echo "</select></td></tr>    
          <tr><td>Real Name</td> <td><input type='text' name='TourleaderName' id='TourleaderName'> <select name='TourleaderNameS' id='TourleaderNameS' style='visibility:hidden'>  </select></td></tr> 
          <tr><td>Nick Name</td><td><input type=text name='TourleaderNickName'></td></tr> 
          <tr><td>Gender</td><td><select name='TourleaderGender'>
                                    <option value='MALE' selected>MALE</option>
                                    <option value='FEMALE'>FEMALE</option>
                                    </select></td></tr>
          <tr><td>Mobile</td><td><input type=text name='TourleaderMobile' onkeyup='isNumber(this)'></td></tr>
          <tr><td>Phone</td><td><input type=text name='TourleaderPhone' onkeyup='isNumber(this)'></td></tr>
          <tr><td>Address</td><td><textarea name='TourleaderAddress' cols='50' rows='3'></textarea></td></tr>
          <tr><td>Expertise</td><td><input type=text name='TourleaderExpertise'></td></tr>
          <tr><td>Passport Name</td><td><input type=text name='TourleaderPassportName' required></td></tr>
          <tr><td>Passport No</td><td><input type=text name='TourleaderPassportNo'> 
          Validity : <input type=text name='TourleaderPassportValid' size='10' class='my_date'>
           <font color='red'>(dd-mm-yyyy)</font></td></tr>   
          <tr><td>Remarks</td><td><textarea name='TourleaderRemarks' cols='50' rows='3'></textarea></td></tr>
          <tr><td>Status</td> <td><select name='TourleaderStatus'>    
            <option value='ACTIVE' selected>Active</option>
            <option value='INACTIVE' >Inactive</option>   
            </select></td></tr>                                                         
          </table>
          <font color='red' size=2>*Additional Info </font><br>  
          <table  id='holding' border='1'>   
              <tr><th><img src='../images/add.png' class='cloneTableRows' /></th><th>Holding visa</th><th>validity </th></tr>
              <tr>
              <td><img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' />&nbsp</td>
              <td><select name='HoldingVisa[]' >
              <option value='0' selected>- Select Country -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' order by Country ASC");
            while($w=mysql_fetch_array($tampil)){    
                 echo "<option value='$w[Country]'>$w[Country]</option>";
                
            }
    echo "</select></td>
              <td><input type=text name='HoldingVisaValid[]' id='HoldingVisaValid[]' size='10' class='my_date' ></td>
              </tr>
              </table>    
          <center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()>          
          </form><br><br>";
     break;
    
  case "edittourleader":
    $edit=mysql_query("SELECT * FROM tour_mstourleader WHERE IDTourleader='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $qemp=mysql_query("SELECT * FROM tbl_msemployee WHERE employee_code='$r[EmpID]'");
    $emp=mysql_fetch_array($qemp);
    if($r[TourleaderPassportValid]=='0000-00-00'){
    $TPV='00-00-0000';
    }else{
    $TPV = date('d-m-Y', strtotime($r[TourleaderPassportValid]));
    }
    if($r[TourleaderType]=='FREELANCE'){$name1='text';$name2="style='visibility:hidden'";}else{$name1='hidden';$name2="style='visibility:visible'";}
    echo "<h2>Edit Tour Leader</h2>
          <form name='example' onsubmit='return validateFormOnSubmit(this)' method=POST action=./aksi.php?module=mstourleader&act=update>
          <input type=hidden name=id value='$r[IDTourleader]'>
          <table>                                                                                                        
          <tr><td>TL Type</td> <td><select name='TourleaderType' onChange='lockTl()'>
            <option value='FREELANCE'";if($r[TourleaderType]=='FREELANCE'){echo"selected";}echo">FREELANCE</option>
            <option value='IN HOUSE'";if($r[TourleaderType]=='IN HOUSE'){echo"selected";}echo">IN HOUSE</option>
            </select></td></tr>
          <tr><td>Divisi</td> <td> <select name='Divisi' id='Divisi' onChange='showTl()'";if($r[TourleaderType]=='FREELANCE'){echo"disabled";}echo">
            <option value=0 selected>- Select Divisi -</option>";
          $tampil=mysql_query("SELECT tbl_msemployee.*, tbl_msoffice.*,tbl_msemployee.office_id as empoffice FROM tbl_msemployee
                                    left join tbl_msoffice on tbl_msoffice.office_id = tbl_msemployee.office_id
                                    where tbl_msoffice.active ='1'
                                    group by tbl_msemployee.office_id
                                    order by office_code ASC");
          while($e=mysql_fetch_array($tampil)){
              if($emp[office_id]==$e[empoffice]){
                echo "<option value='$e[office_id]' selected>$e[office_code]</option>";
              }else{
                echo "<option value='$e[office_id]''>$e[office_code]</option>";
              }
          }
      echo "</select></td></tr>
          <tr><td>Real Name</td> <td><input type='$name1' name='TourleaderName' id='TourleaderName'  value='$r[TourleaderName]'>
          <select name='TourleaderNameS' id='TourleaderNameS' $name2>";
      $tampil2=mysql_query("SELECT * FROM tbl_msemployee
                LEFT JOIN tbl_msoffice ON tbl_msoffice.office_id = tbl_msemployee.office_id
                WHERE tbl_msemployee.office_id = '$emp[office_id]' AND tbl_msemployee.active='1' order by employee_name");
      while($n=mysql_fetch_array($tampil2)){
          if($emp[employee_code]==$n[employee_code]){
              echo "<option value='$n[employee_code]' selected>$n[employee_name]</option>";
          }else{
              echo "<option value='$n[employee_code]'>$n[employee_name]</option>";
          }
      }
      echo "
          </select></td></tr>
          <tr><td>Nick Name</td><td><input type=text name='TourleaderNickName' value='$r[TourleaderNickName]'></td></tr>
          <tr><td>Gender</td><td><select name='TourleaderGender'>
                                    <option value='MALE'";if($r[TourleaderGender]=='MALE'){echo"selected";}echo">MALE</option>
                                    <option value='FEMALE'";if($r[TourleaderGender]=='FEMALE'){echo"selected";}echo">FEMALE</option>
                                    </select></td></tr>
          <tr><td>Mobile</td><td><input type=text name='TourleaderMobile' value='$r[TourleaderMobile]' onkeyup='isNumber(this)'></td></tr>
          <tr><td>Phone</td><td><input type=text name='TourleaderPhone' value='$r[TourleaderPhone]' onkeyup='isNumber(this)'></td></tr>
          <tr><td>Address</td><td><textarea name='TourleaderAddress' cols='50' rows='3'>$r[TourleaderAddress]</textarea></td></tr>
          <tr><td>Expertise</td><td><input type=text name='TourleaderExpertise' value='$r[TourleaderExpertise]'></td></tr>
          <tr><td>Passport Name</td><td><input type=text name='TourleaderPassportName' value='$r[TourleaderPassportName]' required></td></tr>
          <tr><td>Passport No</td><td><input type=text name='TourleaderPassportNo' value='$r[TourleaderPassportNo]'>
          Validity : <input type=text name='TourleaderPassportValid' size='10' class='my_date' value='$TPV'>
           <font color='red'>(dd-mm-yyyy)</font></td></tr>  
          <tr><td>Remarks</td><td><textarea name='TourleaderRemarks' cols='50' rows='3'>$r[TourleaderRemarks]</textarea></td></tr>
          <tr><td>Status</td> <td><select name='TourleaderStatus'>    
            <option value='ACTIVE' ";if($r[TourleaderStatus]=='ACTIVE'){echo"selected";}echo">Active</option>
            <option value='INACTIVE' ";if($r[TourleaderStatus]=='INACTIVE'){echo"selected";}echo">Inactive</option>   
            </select></td></tr>
          </table>
          <font color='red' size=2>*Additional Info </font><br>
          <table id='holding' border='1'>";   
           $i=0;
           $coba=mysql_query("SELECT * FROM tour_tourleaderholding where IDTourleader ='$r[IDTourleader]' ");
            $baris=mysql_num_rows($coba);
            if ($baris==0){
                echo"    <tr><th><img src='../images/add.png' class='cloneTableRows' /></th><th>Holding visa</th><th>validity </th></tr>    
              <tr>
              <td><img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' />&nbsp</td>
              <td><select name='HoldingVisa[]' >
              <option value='0' selected>- Select Country -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' order by Country ASC");
            while($w=mysql_fetch_array($tampil)){    
                 echo "<option value='$w[Country]'>$w[Country]</option>";
                
            }
    echo "</select></td>
              <td><input type=text name='HoldingVisaValid[]' id='HoldingVisaValid[]' size='10' class='my_date' ></td>
              </tr>
                  </table>";    
            }else {echo"
                <tr><th><img src='../images/add.png' class='cloneTableRows' /></th><th>Holding visa</th><th>validity </th></tr>";
                while($tes=mysql_fetch_array($coba)){ 
                if($tes[HoldingVisaValid]=='0000-00-00'){
                $HVV='00-00-0000';
                }else{
                $HVV = date('d-m-Y', strtotime($tes[HoldingVisaValid]));
                }    
                if($i==0){
                $vis="style='visibility: hidden;'";
                }else {$vis="style='visibility: visible;'";}
            echo"       
          
              <tr>
              <td><img src='../images/delete.png' alt='' class='delRow' $vis />&nbsp</td>
              <td><select name='HoldingVisa[]' >
              <option value='0' selected>- Select Country -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where Status = 'ACTIVE' order by Country ASC");
            while($w=mysql_fetch_array($tampil)){    
            if ($tes[HoldingVisa]==$w[Country]){
                     echo "<option value='$w[Country]' selected>$w[Country]</option>";
                } else {
                    echo "<option value='$w[Country]'>$w[Country]</option>";
                }     
            }
    echo "</select></td>
              <td><input type=text name='HoldingVisaValid[]' id='HoldingVisaValid[]' size='10' class='my_date' value='$HVV'></td>
              </tr>";$i++;}echo"
          </table>";
          }
    echo" <center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()>       
          </form>";
    break;  
	
  case "sametl":
    $edit=mysql_query("SELECT * FROM tour_mstourleader WHERE IDTourleader = '$_GET[id]'");
    $r=mysql_fetch_array($edit);       
    echo "<center><font color = 'red' size='4'><b>WE FIND SAME NAME WITH MOBILE NUMBER :<br> <a href=?module=mstourleader&nama=$r[TourleaderName]&oke=Search>$r[TourleaderName] - $r[TourleaderMobile]</b></a></font>
           <br><br>
          <center><input type=button value='Close' onclick=location.href='?module=mstourleader'>
         <br><br> ";
    break;  
} 
?>
