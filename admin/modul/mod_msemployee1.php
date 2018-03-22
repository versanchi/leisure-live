<?php
switch($_GET[act]){
  // Tampil Employee
  default:
  	$nama=$_GET['nama'];
    echo "<h2>Master Employee</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='msemployee1'>
			  <input type=text name=nama value='$nama' size=40>	
			  <input type=submit name=oke value=Search>
		  </form><input type=button value='Add New Employee' onclick=location.href='?module=msemployee1&act=tambahmsemployee'>";
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
					 <td>";               
                     if($data[employee_code]=='TMC-06870'or $data[employee_code]=='TMC-03509'or $data[employee_code]=='TMC-081445'){
                             echo"<center>Master ";
                     } else { echo"
                             <a href=?module=msemployee1&act=editmsemployee&id=$data[employee_id]>Edit</a>
					         |
					         <a href=?module=msemployee1&act=deletemsemployee&id=$data[employee_id]>Delete</a>";
					         } 
               echo "</td></tr>";
					  $no++;
					}
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tbl_msemployee 
								LEFT JOIN tbl_msoffice ON tbl_msemployee.office_id = tbl_msoffice.office_id
								WHERE tbl_msemployee.employee_name LIKE '%$nama%'
								OR tbl_msoffice.office_name LIKE '%$nama%'
								OR tbl_msemployee.employee_initial LIKE '%$nama%' 
								ORDER BY employee_id";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=msemployee1";
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
          <form method=POST action='./aksi.php?module=msemployee&act=input'>
          <table>
		  <tr><td>NIP</td> <td>  <input type=text name='employee_code' size=10></td></tr>
		  <tr><td>Initial</td> <td>  <input type=text name='employee_initial' size=5></td></tr>		  
		  <tr><td>Name</td> <td>  <input type=text name='employee_name' size=30></td></tr>
		  <tr><td>Title</td> <td>  <input type=text name='employee_title' size=30></td></tr>
		  <tr><td>E-mail</td> <td>  <input type=text name='employee_email' size=30></td></tr>		  		  
		  <tr><td>Job Desc</td> <td>  
		  <select name='job_desc'>     
                
            <option value='3' >Document</option>   
            <option value='2' selected>Others</option>
            </select>                                                        
		  </td></tr>		  
          <tr><td>Department</td>  <td>  
          <select name='office_id'>
            <option value=0 selected>- Select Department -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[office_id]>$r[office_name]</option>";
            }
    echo "</select></td></tr>
		  <tr><td>Username</td> <td>  <input type=text name='employee_username' size=30></td></tr>
		  <tr><td>Password</td> <td>  <input type=password name='employee_password' size=30></td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;
    
  case "editmsemployee":
    $edit=mysql_query("SELECT * FROM tbl_msemployee WHERE employee_id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Employee</h2>
          <form method=POST action=./aksi.php?module=msemployee&act=update>
          <input type=hidden name=id value='$r[employee_id]'>
          <table>
          <tr><td>NIP</td> <td>  <input type=text name='employee_code' size=10  value='$r[employee_code]'></td></tr>
          <tr><td>Initial</td> <td>  <input type=text name='employee_initial' size=5  value='$r[employee_initial]'></td></tr>		  		  		  		  
          <tr><td>Name</td> <td>  <input type=text name='employee_name' size=30  value='$r[employee_name]'></td></tr>
          <tr><td>Title</td> <td>  <input type=text name='employee_title' size=30  value='$r[employee_title]'></td></tr>
		  <tr><td>E-mail</td> <td>  <input type=text name='employee_email' size=30  value='$r[employee_email]'></td></tr>
		  <tr><td>Job Desc</td> <td>
          <select name='job_desc'>                                                                      
            <option value=3 "; if ($r['job_desc']==3) {echo "selected";} echo">Document</option>   
            <option value=2 "; if ($r['job_desc']==2) {echo "selected";} echo">Others</option>
            </select>     
            </td></tr><tr><td>Department</td>  <td>  <select name='office_id'>
		 <option value=0 selected>- Select Department -</option>";
		$tampil=mysql_query("SELECT * FROM tbl_msoffice ORDER BY office_name");
		while($w=mysql_fetch_array($tampil)){
		  if ($r[office_id]==$w[office_id]){
			echo "<option value=$w[office_id] selected>$w[office_name]</option>";
		  } else{
			echo "<option value=$w[office_id]>$w[office_name]</option>";
		  }
		}
    echo "</select></td></tr>
		  <tr><td>Username</td> <td>  <input type=text name='employee_username' size=30  value='$r[employee_username]'></td></tr>		  		  		  		  
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
		  <tr><td>Job Desc</td> <td>  ";?>                                                                                                
		  <input type=radio name='job_desc' value=3 <? if ($r['job_desc']==3) echo "checked";?> disabled>&nbsp;Document&nbsp;&nbsp;
		  <input type=radio name='job_desc' value=2 <? if ($r['job_desc']==2) echo "checked";?> disabled>&nbsp;Others&nbsp;&nbsp;
	<?		  
    echo "</td></tr><tr><td>Department</td>  <td>  <select name='office_id' disabled>
		 <option value=0 selected>- Select Department -</option>";
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
