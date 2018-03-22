<!--<script type="text/javascript" src="../resources/library/ckeditor/ckeditor.js"></script>-->
<script type="text/javascript" src="./fckeditor/ckeditor.js"></script>
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<link href="css/tour_object.css" rel="stylesheet"/>

<script language="JavaScript"  type="text/javascript">

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function (e) {
        $('#showimage').show()
        $('#showimage').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
  }
  
  $(function() {
    $("#userfile").change(function(){
      readURL(this);
    });
  });
     
  function delfile(ID) {
    if (confirm("Are you sure you want to delete image ?")) {
      window.location.href = '?module=mstouristobject&act=deleteimage&id=' + ID;
    }
  }

  function showCountry() {    
    // Show City
    <?php

      $hasil = mysql_query("SELECT * FROM cim_mscountry GROUP BY Country");
      
      while ($data = mysql_fetch_array($hasil))
      {
        $idDest = $data['Country'];                                                  

        echo "if (document.example.country.value == \"".$idDest."\")"; 
        echo "{";       

        $hasil2 = mysql_query("SELECT * FROM cim_mscountry WHERE Country = '$idDest' ORDER BY City ASC ");
        $content = "document.getElementById('city').innerHTML = \"";
        $content .= "<option value='0'>- Select -</option>";
        while ($data2 = mysql_fetch_array($hasil2)) {
          $content .= "<option value='".$data2['City']."'>".$data2['City']."</option>";
        }
        $content .= "\"";
        echo $content;
        echo "}\n";
        
        echo "else if (document.example.country.value == ''){";
           
        $content = "document.getElementById('city').innerHTML = \"";
        $content .= "<option value=''></option>";
        
        $content .= "\"";
        echo $content;
        echo "}\n";          
      }
    ?>
  }

</script>

<script type="text/javascript"> 

  function validateFormOnSubmit(theForm) {
    var reason = ""; 
    reason += validateSelect(theForm.country);
    reason += validateSelect(theForm.city);
    reason += validateEmpty(theForm.objectname);
    reason += validateAttachment(theForm.file);
    reason += validateEmptyDesc(theForm.description);
    reason += validateSelect(theForm.status);
        
    if (reason != "") {
      alert("Some fields need correction:\n" + reason);
      return false;
    }
    return confirm("Are you sure you want to process?");;
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

  function validateEmptyDesc(fld) {
    var error = "";
   
    if (fld.value.length == 0) {
      fld.style.background = 'Yellow'; 
      error = "Description field has not been filled in.\n"
    } else if (fld.value == '<p></p>') {
      fld.style.background = 'Yellow'; 
      error = "Description field has not been filled in.\n"
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
    }
    else {
      fld.style.background = 'White';
    }
    return error;  
  }

  function validateAttachment(fld) {
    var error = "";
    var fileattach = fld.value;
    // var allowedExtensions = new Array("jpg","png","gif","zip","doc","docx","xls","xlsx","ppt","pptx","pdf","txt","jpeg");
    var fileExtension = fileattach.split('.').pop();
    var filepath = 'upload/' + fileattach;
    var max = document.getElementById('userfile');
    var maxsize = max.files[0];

    if (fileattach.length > 0) {
      if (fileExtension != 'jpg' && fileExtension != 'png' && fileExtension != 'gif' && fileExtension != 'jpeg') {
        fld.style.background = 'Yellow';
        error = "Attachment: Unidentified File Extension\n";
      } else if (maxsize.size > 500000) {
        fld.style.background = 'Yellow';
        error = "Attachment: File too large (Max: 500Kb)\n";
      } else {
        fld.style.background = 'White';
      }
    }
  
    return error;
    
  }

</script>


  <!-- BEGIN -->
  <!-- BEGIN -->
  <!-- BEGIN -->


<?php
switch($_GET[act]){
  
  default:
    $nama = $_GET['nama'];
    echo "
    <h2>Tourist Object</h2>
      <form method=get action='media.php?'>
        <input type=hidden name=module value='mstouristobject'>
        <input type=text name=nama value='$nama' size=40> 
        <input type=submit name=oke value=Search>
      </form>

      <input type=button value='Add Tourist Object' onclick=location.href='?module=mstouristobject&act=tambahtouristobject'>";

      $oke = $_GET['oke'];
 
      // Langkah 1
      $batas = 10;
      $halaman =  $_GET['halaman'];
      if (empty($halaman)) {
        $posisi  = 0;
        $halaman = 1;
      } else {
        $posisi = ($halaman-1) * $batas;
      }
      
      // Langkah 2
      $tampil = mysql_query("SELECT * FROM cim_mstouristobject                                               
                                      WHERE (Country LIKE '%$nama%'
                                      OR City LIKE '%$nama%'
                                      OR ObjectName LIKE '%$nama%')
                                      AND Status = 'ACTIVE'
                                      ORDER BY Country ASC LIMIT $posisi,$batas");
      $jumlah = mysql_num_rows($tampil);
      
      if ($jumlah > 0) {
        echo "
        <table>
          <tr>
            <th>No</th>
            <th>Country</th>
            <th>City</th>
            <th>Object Name</th>
            <th>Action</th>
          </tr>"; 
          $no = $posisi + 1;
          while ($data = mysql_fetch_array($tampil)) {
            echo "
            <tr>
              <td>$no</td>
              <td>$data[Country]</td>
              <td>$data[City]</td>
              <td>$data[ObjectName]</td>
              <td>
                <center>
                  <a href=?module=mstouristobject&act=edittouristobject&id=$data[ObjectID]><button><font style='font-family: Tahoma;'>Edit</font></button></a> 
                  <a href=?module=mstouristobject&act=deleteobject&id=$data[ObjectID]><button onclick=\"return confirm('Are you sure want to delete this tourist object?')\"><font style='font-family: Tahoma;'>Delete</font></button></a> 
                  <a href=?module=mstouristobject&act=showtourobject&id=$data[ObjectID]><button><font style='font-family: Tahoma;'>Show</font></button></a>
              </td>
            </tr>";
            $no++;
          }
          echo "
        </table>";
          
          // Langkah 3      
          $tampil2    = "SELECT * FROM cim_mstouristobject                                               
                                  WHERE (Country LIKE '%$nama%'
                                  OR City LIKE '%$nama%'
                                  OR ObjectName LIKE '%$nama%')
                                  AND Status = 'ACTIVE'
                                  ORDER BY Country";
          $hasil2     = mysql_query($tampil2);
          $jmldata    = mysql_num_rows($hasil2);
          $jmlhalaman = ceil($jmldata/$batas);
          $file = "media.php?module=mstouristobject";
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
  
  case "tambahtouristobject":
    $QObjectID = mysql_query("SELECT ObjectID FROM cim_mstouristobject ORDER BY ObjectID DESC LIMIT 1");
    $ObjectID = mysql_fetch_assoc($QObjectID);
    $countObject = mysql_num_rows($QObjectID);
    if ($countObject > 0) {
      $ObjectID = $ObjectID[ObjectID] + 1;
    } else {
      $ObjectID = 1;
    }
    echo "
    <h2>Add Tourist Object</h2>
      <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=mstouristobject&act=input' enctype='multipart/form-data'>
        <input type=hidden name='ObjectID' value='$ObjectID'>
        <table>

          <tr>
            <td>Country</td>
            <td>
              <select name='country' onChange='showCountry()'>
                <option value='' selected>- Select -</option>";
                $Qcountry = mysql_query("SELECT Country FROM cim_mscountry GROUP BY Country ASC");
                while ($country = mysql_fetch_array($Qcountry)) { 
                  echo "<option value='$country[Country]'>$country[Country]</option>";
                }
                echo "
              </select>
            </td>
          </tr>

          <tr>
            <td>City</td>
            <td>
              <select name='city' id=city></select>
            </td>
          </tr>

          <tr>
            <td>Object Name</td>
            <td><input type=text name='objectname' size='40'></td>
          </tr>     

          <tr>
            <td>Image</td>
            <td>
              <input name='file' type='file' id='userfile'/><br>
              <img id='showimage' src='#' alt='test' style='width: 480px; height:240px; display: none;'>
            </td>
          </tr>   
  
          <tr>
            <td>Description</td>
            <td><textarea class='ckeditor' name='description' cols='40' rows='3'></textarea></td>
          </tr>           
  
          <tr>
            <td>Status</td>
            <td>
              <select name='status'>    
                <option value='ACTIVE' selected>ACTIVE</option>
                <option value='INACTIVE'>INACTIVE</option>
              </select>
            </td>
          </tr>
  
          <tr>
            <td colspan=3><center><input type=submit value=Save><input type=button value=Cancel onclick=self.history.back()></td>
          </tr>
        </table>
    </form>
    <br><br>";
  break;
  
  case "edittouristobject":
    $edit = mysql_query("SELECT * FROM cim_mstouristobject WHERE ObjectID ='$_GET[id]'");
    $r = mysql_fetch_array($edit);
    
    echo "
    <h2>Edit Client</h2>
      <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=mstouristobject&act=update' enctype='multipart/form-data'>
        <input type=hidden name='ObjectID' value='$r[ObjectID]'>
          <table>

            <tr>
            <td>Country</td>
            <td>
              <select name='country' onChange='showCountry()'>";
                $Qcountry = mysql_query("SELECT Country FROM cim_mscountry GROUP BY Country ASC");
                while ($country = mysql_fetch_array($Qcountry)) { 
                  echo "<option value='$country[Country]' "; if($r[Country] == $country[Country]) {echo "selected";} echo ">$country[Country]</option>";
                }
                echo "
              </select>
            </td>
          </tr>

          <tr>
            <td>City</td>
            <td>
              <select name='city' id='city'>";
                $Qcity = mysql_query("SELECT City FROM cim_mscountry GROUP BY City ASC");
                while ($city = mysql_fetch_array($Qcity)) { 
                  echo "<option value='$city[City]' "; if($r[City] == $city[City]) {echo "selected";} echo ">$city[City]</option>";
                }
                echo "
              </select>
            </td>
          </tr>

          <tr>
            <td>Object Name</td>
            <td><input type=text name='objectname' value='$r[ObjectName]' size='40'></td>
          </tr>     

          <tr>
            <td>Image</td>
            <td>"; if($r[ImageName] == '') {echo "<input name='file' type='file' id='userfile'/><br><img id='showimage' src='#' alt='test' style='width: 480px; height:240px; display: none;'>";} else {$imageName = str_replace(" ", '+', $r[ImageName]); echo " <img src='$r[urlimage]upload/tour/$_GET[id]/$r[ImageName]' style='width: 480px; height:240px;'> <a href=modul/downloadtour.php?filename=$imageName&id=$_GET[id]>$r[ImageName]</a> <input type=button value='Delete' onclick=delfile($_GET[id])><input name='file' type='file' id='userfile' style='display:none;'/>";} echo "</td>
          </tr>
  
          <tr>
            <td>Description</td>
            <td><textarea class='ckeditor' name='description' cols='40' rows='3'>$r[Description]</textarea></td>
          </tr>           
  
          <tr>
            <td>Status</td>
            <td>
              <select name='status'>    
                <option value='ACTIVE'"; if($r[Status] == 'ACTIVE') {echo "selected";} echo ">ACTIVE</option>
                <option value='INACTIVE'"; if($r[Status] == 'INACTIVE') {echo "selected";} echo ">INACTIVE</option>
              </select>
            </td>
          </tr> 

            <tr>
              <td colspan=2><center><input type=submit value=Update><input type=button value=Cancel onclick=self.history.back()></td>
            </tr>

          </table>
      </form>";
  break;

  case "showtourobject":
    $edit = mysql_query("SELECT * FROM cim_mstouristobject WHERE ObjectID ='$_GET[id]'");
    $r = mysql_fetch_array($edit);
    
    echo "
      <table width=95% style='border: 0px solid #FFF;'>
        <tr style='border: 0px solid #FFF;' class='tr_tour'>
          <td style='border: 0px solid #FFF;' class='td_tour'>
            <div class='title_tour'>$r[ObjectName]</div> <br>
            <div class='location_tour'>$r[City] - $r[Country]</div> <br>
            <div class='desc_title_tour'><span>Description</span></div> <br>
            <div class='desc_tour'>$r[Description]</div>
          </td>
          <td style='border: 0px solid #FFF;'>"; if($r[ImageName] == '') {} else {echo "<img src='$r[urlimage]upload/tour/$_GET[id]/$r[ImageName]' style='width:480px;height:240; border: 0px solid #FFF; border-radius:10px;'>";} echo "</td>
        </tr>
        <tr>
          <td style='border: 0px solid #FFF;'colspan=2><center><input type=button value=Back onclick=self.history.back()></td>
        </tr>
      </table>
    ";
  break;    
  
  case "deleteimage":
    $username = $_SESSION[namauser];
    $Quser = mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_username = '$username'");
    $showUser = mysql_fetch_object($Quser);
    $EmpName = $showUser->employee_name;    
    $today = date("Y-m-d G:i:s");

    $Qfile = mysql_query("SELECT * FROM cim_mstouristobject WHERE ObjectID = '$_GET[id]'");
    $file = mysql_fetch_assoc($Qfile);
    $filename = $file[ImageName];

    $edit = mysql_query("UPDATE cim_mstouristobject SET ImageName = '', ImageType = '', ImageSize = '' WHERE ObjectID = '$_GET[id]'"); 
    $subfolder = $_GET[id];
    $folder = 'upload_tour/'.$_GET[id].'/'.$filename;
    
    // Delete File
    unlink($folder);

    $Description = "Delete Image Tourist Object (".$_GET[id].") "; 

    mysql_query("INSERT INTO tbl_logtour (EmployeeName,
                                      Description,
                                      LogTime) 
                             VALUES ('$EmpName', 
                                     '$Description', 
                                     '$today')");             
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mstouristobject&act=edittouristobject&id=$_GET[id]'>";   
  break;

  case "deleteobject":
    $username = $_SESSION[namauser];
    $Quser = mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_username = '$username'");
    $showUser = mysql_fetch_object($Quser);
    $EmpName = $showUser->employee_name;    
    $today = date("Y-m-d G:i:s");

    $edit = mysql_query("UPDATE cim_mstouristobject SET Status = 'INACTIVE' WHERE ObjectID = '$_GET[id]'"); 
    $Description = "Delete Tourist Object (".$_GET[id].") ";

    mysql_query("INSERT INTO tbl_logtour (EmployeeName,
                                      Description,
                                      LogTime) 
                             VALUES ('$EmpName', 
                                     '$Description', 
                                     '$today')");             
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mstouristobject'>";   
  break;
}
?>
