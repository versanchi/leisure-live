<SCRIPT type="text/javascript">
function showadd()
{                                      
    if(document.getElementById("employee_id").checked == true){
        document.example.elements['birthplace'].disabled=false;
        document.example.elements['birthdate'].disabled=false;
        document.example.elements['passportno'].disabled=false;
        document.example.elements['passportissued'].disabled=false;
        document.example.elements['passportissueddate'].disabled=false;
        document.example.elements['passportvalid'].disabled=false; 
    }else{
        document.example.elements['birthplace'].disabled=true;
        document.example.elements['birthdate'].disabled=true;
        document.example.elements['passportno'].disabled=true;
        document.example.elements['passportissued'].disabled=true;
        document.example.elements['passportissueddate'].disabled=true;
        document.example.elements['passportvalid'].disabled=true;
        document.example.elements['birthplace'].value='';
        document.example.elements['birthdate'].value='';
        document.example.elements['passportno'].value='';
        document.example.elements['passportissued'].value='';
        document.example.elements['passportissueddate'].value='';
        document.example.elements['passportvalid'].value='';
    }
}
</script>

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
          </form><input type=button value='Add New Employee' onclick=location.href='?module=msemployee&act=tambahmsemployee'>";
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
                                OR tbl_msemployee.employee_code LIKE '%$nama%'
                                OR tbl_msoffice.office_name LIKE '%$nama%'
                                ORDER BY employee_id LIMIT $posisi,$batas");
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "<table>
                    <tr><th>no</th><th>nip</th><th>initial</th><th>employee</th><th>branch</th><th>action</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
               echo "<tr><td>$no</td>
                     <td>$data[employee_code]</td>       
                     <td>$data[employee_initial]</td>
                     <td>$data[employee_name]</td>
                     <td>$data[office_name]</td>             
                     <td><center>"; if($_SESSION[employee_code]=='TMC-06870'){
                        echo"
                             <a href=?module=msemployee&act=editmsemployee&id=$data[employee_id]>Edit</a>
                             |
                             <a href=?module=msemployee&act=deletemsemployee&id=$data[employee_id]>Delete</a>"; 
                     }else {
                     
                     if($data[employee_code]=='TMC-06870'or $data[employee_code]=='TMC-03509'or $data[employee_code]=='TMC-081445'){
                             echo"<center>Master ";
                     } else { echo"
                             <a href=?module=msemployee&act=editmsemployee&id=$data[employee_id]>Edit</a>
                             ";
                             } }
               echo "</td></tr>";
                      $no++;
                    }  //|
                        //     <a href=?module=msemployee&act=deletemsemployee&id=$data[employee_id]>Delete</a>
                    echo "</table>";
                    
                    // Langkah 3            
                    $tampil2    = "SELECT * FROM tbl_msemployee 
                                LEFT JOIN tbl_msoffice ON tbl_msemployee.office_id = tbl_msoffice.office_id
                                WHERE tbl_msemployee.employee_name LIKE '%$nama%'
                                OR tbl_msemployee.employee_code LIKE '%$nama%'
                                OR tbl_msoffice.office_name LIKE '%$nama%'
                                OR tbl_msemployee.employee_initial LIKE '%$nama%' 
                                ORDER BY employee_id";
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
          
          <form name='example' method=POST action='./aksi.php?module=msemployee&act=input'>
            
          <table>
          <tr><td>NIP</td> <td>  <input type=text name='employee_code' size=10></td></tr>
          <tr><td>Initial</td> <td>  <input type=text name='employee_initial' size=5></td></tr>          
          <tr><td>Name</td> <td>  <input type=text name='employee_name' size=30></td></tr>      
          <tr><td>E-mail</td> <td>  <input type=text name='employee_email' size=30></td></tr>                    
          <tr><td>Job Title</td> <td>  
          <select name='employee_title'>
            <option value=0 selected>- Select Title -</option>";
            $tampil=mysql_query("SELECT * FROM cim_msjob ORDER BY JobID");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value='$r[IDJob]'>$r[JobID] - $r[JobName]</option>";
            }
    echo "</select>                                                        
          </td></tr>          
          <tr><td>Tour Leader Assigned</td> <td>  <input type='checkbox' name='employee_tl' id='employee_id' onClick='showadd()'> YES</td></tr>
          <tr><td>Birth Place</td><td><input type='text' name='birthplace' disabled> </td></tr>
            <tr><td>Birth Date</td><td><input type='text' name='birthdate' size='10' onClick="."cal.select(document.forms['example'].birthdate,'ActIn1','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn1' disabled>
           <font color='red'>(yyyy-mm-dd)</font> </td></tr>
            <tr><td>Passport Number</td><td><input type='text' name='passportno'  disabled> </td></tr>
            <tr><td>Passport Issued Place</td><td><input type='text' name='passportissued'  disabled> </td></tr>
            <tr><td>Passport Issued Date</td><td><input type='text' name='passportissueddate' size='10'  onClick="."cal.select(document.forms['example'].passportissueddate,'ActIn3','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn3' disabled>
           <font color='red'>(yyyy-mm-dd)</font></td></tr>
            <tr><td>Passport Exp Date</td><td><input type='text' name='passportvalid' size='10'  onClick="."cal.select(document.forms['example'].passportvalid,'ActIn2','yyyy-MM-dd'); return false;"." NAME='anchor2' ID='ActIn2' disabled>
           <font color='red'>(yyyy-mm-dd)</font></td></tr>
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
          <tr><td>Division</td>  <td>  
          <select name='office_id'>
            <option value=0 selected>- Select Division -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[office_id]>$r[office_name]</option>";
            }
    echo "</select></td></tr>
    <tr><td>Status</td> <td><select name='Status'>    
            <option value='1' selected>Active</option>
            <option value='2' >Inactive</option>   
            </select></td></tr>                                                                      
          <tr><td>Password</td> <td>  <input type=password name='employee_password' value='PANORAMA' size=30></td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;
    
  case "editmsemployee":
    $edit=mysql_query("SELECT * FROM tbl_msemployee WHERE employee_id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Employee</h2>
          <form name='example' method=POST action=./aksi.php?module=msemployee&act=update>
          <input type=hidden name=id value='$r[employee_id]'>
          <table>
          <tr><td>NIP</td> <td>  <input type=text name='employee_code' size=10  value='$r[employee_code]' readonly></td></tr>
          <tr><td>Initial</td> <td>  <input type=text name='employee_initial' size=5  value='$r[employee_initial]'></td></tr>                                        
          <tr><td>Name</td> <td>  <input type=text name='employee_name' size=30  value='$r[employee_name]'></td></tr>     
          <tr><td>E-mail</td> <td>  <input type=text name='employee_email' size=30  value='$r[employee_email]'></td></tr>
          <tr><td>Job Title</td> <td>  
          <select name='employee_title'>
            <option value=0 selected>- Select Title -</option>";
            $tampil=mysql_query("SELECT * FROM cim_msjob ORDER BY JobID");
            while($w=mysql_fetch_array($tampil)){
                 if ($r[employee_title]==$w[IDJob]){
                echo "<option value=$w[IDJob] selected>$w[JobID] - $w[JobName]</option>";
                } else{ echo "<option value=$w[IDJob]>$w[JobID] - $w[JobName]</option>";
                }
            }
    echo "</select>
            </td></tr>
           <tr><td>Tour Leader Assigned</td> <td>  <input type='checkbox' name='employee_tl'";if($r[employee_tl]=='on'){$visi="enabled";echo"checked";}else{$visi="disabled";} echo" id='employee_id' onClick='showadd()'> YES</td></tr>
           <tr><td>Birth Place</td><td><input type='text' name='birthplace' value='$r[BirthPlace]' $visi> </td></tr>
            <tr><td>Birth Date</td><td><input type='text' name='birthdate' size='10' value='$r[BirthDate]' onClick="."cal.select(document.forms['example'].birthdate,'ActIn1','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn1' $visi>
           <font color='red'>(yyyy-mm-dd)</font> </td></tr>
            <tr><td>Passport Number</td><td><input type='text' name='passportno' value='$r[PassportNo]' $visi> </td></tr>
            <tr><td>Passport Issued Place</td><td><input type='text' name='passportissued' value='$r[PassportIssued]' $visi> </td></tr>
            <tr><td>Passport Issued Date</td><td><input type='text' name='passportissueddate' size='10' value='$r[PassportIssuedDate]' onClick="."cal.select(document.forms['example'].passportissueddate,'ActIn3','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn3' $visi>
           <font color='red'>(yyyy-mm-dd)</font></td></tr>
            <tr><td>Passport Exp Date</td><td><input type='text' name='passportvalid' size='10' value='$r[PassportValid]' onClick="."cal.select(document.forms['example'].passportvalid,'ActIn2','yyyy-MM-dd'); return false;"." NAME='anchor2' ID='ActIn2' $visi>
           <font color='red'>(yyyy-mm-dd)</font></td></tr>
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
          <tr><td>Division</td>  <td>  <select name='office_id'>
         <option value=0 selected>- Select Division -</option>";
        $tampil=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name");
        while($w=mysql_fetch_array($tampil)){
          if ($r[office_id]==$w[office_id]){
            echo "<option value=$w[office_id] selected>$w[office_name]</option>";
          } else{
            echo "<option value=$w[office_id]>$w[office_name]</option>";
          }
        }
    echo "</select></td></tr>
    <tr><td>Status</td> <td><select name='Status'>    
            <option value='1' ";if($r[active]=='1'){echo"selected";}echo">Active</option>
            <option value='2' ";if($r[active]=='2'){echo"selected";}echo">Inactive</option>   
            </select></td></tr>                                                                                                                                             
          <tr><td>Password</td> <td>  <input type=password name='employee_password' size=30> *)</td></tr>
          <tr><td colspan=2>*) Leave blank if you don't want to change the password.</td></tr>          
          <tr><td colspan=2><center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
    
  case "deletemsemployee":
    $edit=mysql_query("SELECT * FROM tbl_msemployee WHERE employee_id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Delete Employee</h2>
          <form method=POST action=./aksi.php?module=msemployee&act=delete>
          <input type=hidden name=id value='$r[employee_id]'>
          <table>
          <tr><td>NIP</td> <td>  <input type=text name='employee_code' size=10  value='$r[employee_code]' disabled></td></tr>
          <tr><td>Initial</td> <td>  <input type=text name='employee_initial' size=5  value='$r[employee_initial]' disabled></td></tr>                                        
          <tr><td>Name</td> <td>  <input type=text name='employee_name' size=30  value='$r[employee_name]' disabled></td></tr>
          <tr><td>Title</td> <td>  <input type=text name='employee_title' size=30  value='$r[employee_title]' disabled></td></tr>
          <tr><td>E-mail</td> <td>  <input type=text name='employee_email' size=30  value='$r[employee_email]' disabled></td></tr>
          <tr><td>Job Title</td> <td>  
          <select name='jobtitle'>
            <option value=0 selected>- Select Title -</option>";
            $tampil=mysql_query("SELECT * FROM cim_msjob ORDER BY JobID");
            while($w=mysql_fetch_array($tampil)){
                 if ($r[employee_title]==$w[IDJob]){
                echo "<option value=$w[IDJob] selected>$w[JobID] - $w[JobName]</option>";
                } else{ echo "<option value=$w[IDJob]>$w[JobID] - $w[JobName]</option>";
                }
            }
    echo "</select>
            </td></tr>
          <tr><td>Authority</td> <td>  ";?>
          <input type=radio name='job_desc' value=1 <?php  if ($r['job_desc']==1) echo "checked";?> disabled>&nbsp;Administrator&nbsp;&nbsp;
          <input type=radio name='job_desc' value=3 <?php  if ($r['job_desc']==3) echo "checked";?> disabled>&nbsp;Document&nbsp;&nbsp;
          <input type=radio name='job_desc' value=2 <?php  if ($r['job_desc']==2) echo "checked";?> disabled>&nbsp;Others&nbsp;&nbsp;
    <?php           
    echo "</td></tr><tr><td>Division</td>  <td>  <select name='office_id' disabled>
         <option value=0 selected>- Select Division -</option>";
        $tampil=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name");
        while($w=mysql_fetch_array($tampil)){
          if ($r[office_id]==$w[office_id]){
            echo "<option value=$w[office_id] selected>$w[office_name]</option>";
          } else{
            echo "<option value=$w[office_id]>$w[office_name]</option>";
          }
        }
    echo "</select></td></tr>
          <tr><td>Username</td> <td>  <input type=text name='employee_username' size=30  value='$r[employee_username]' disabled></td></tr>                                        
          <tr><td colspan=2><center><input type=submit value=Delete>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
?>
