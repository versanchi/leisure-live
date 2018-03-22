<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<link type="text/css" href="../head/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../head/ui.core.js"></script>
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
                    $(newRow).find("input").each(function(){
                        if($(this).hasClass("hasDatepicker")){ // if the current input has the hasDatpicker class
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
<script type="text/javascript">
function formatJam(obj) {
if (obj) { // object exist
var val = obj.value
if(val==''){         
obj.value = "00:00"
}              
if (!parseFloat(val) || val.match(/[^\d]$/)) { // invalid character input
if (val.length>0) { // delete invalid char
obj.value = val.substring(1, val.length-2)
} 
}
else { // valid char input for the key stroke   
var val = obj.value
if(val.length==4){
var front = val.substring(2,0) 
var back = val.substring(4,2)    
obj.value = front+":"+back
} else if(val.length==3){
var front = val.substring(2,0) 
var back = val.substring(3,2)    
obj.value = front+":"+back+"0"
}  
else if(val.length==2){
var front = val.substring(2,0) 
var back = val.substring(3,2)    
obj.value = front+":00"
}     
else if(val.length==1){
var front = val.substring(1,0) 
var back = val.substring(3,2)    
obj.value = "0"+front+":00"
}  

}
}
}
function isNumber(field) {
var re = /^[0-9'.']*$/;
if (!re.test(field.value)) {
alert('PLEASE INPUT NUMBER!');
field.value = field.value.replace(/[^0-9'.']/g,"");
}
}
function delattach(ID, ATTACHFILE)
{
if (confirm("Are you sure you want to delete " + ATTACHFILE +" "))
{
 window.location.href = '?module=dtevent&act=delattach&id=' + ID;
 
} 
}
function outhouse()
{                                       
document.example.elements['inhousebso'].disabled=true;
document.example.elements['inhousebso'].value='';   
}
function inhouse()
{                                      
document.example.elements['inhousebso'].disabled=false;  
}
function validateFormOnSubmit(theForm) {
var reason = ""; 
  reason += validateEmpty(theForm.event);  
  reason += validateDate(theForm.datefrom);
  reason += validateDateto(theForm.dateto); 
  
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);
    return false;
  }

  return true;
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
        error = "Please choose event date(from) large than today.\n"
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
    
    var dep = example.datefrom.value;
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

</script>
<?php
session_start();              
switch($_GET[act]){
  // Tampil User
  default:
    $datenow = date("d", time());
    $monthnow = date("m", time());
    $monthnext = date("m", time())+1;
    $yearnow = date("Y", time());
    $today = $yearnow."-".$monthnow."-".$datenow;
    $firstday = $yearnow."-".$monthnow."-01";
    $lastday = $yearnow."-".$monthnext."-01";      
    echo "<h2>Event Schedule</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='dtevent'>
              <input type=text name=nama value='$nama' size=40>    
              <input type=submit name=oke value=Search>
          </form><input type=button value='New Event' onclick=location.href='?module=dtevent&act=tambahevent'>";
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
            $tampil=mysql_query("SELECT * FROM rbd_event 
                                WHERE EventName LIKE '%$nama%'
                                AND EventDateTo >= '$today' ORDER BY EventDateFrom ASC LIMIT $posisi,$batas");
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "<table>
                    <tr><th>no</th><th>Event</th><th>date</th><th>place</th><th>status</th><th>action</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
              echo "<tr><td>$no</td>
             <td>$data[EventName]</td>
             <td>$data[EventDateFrom]</td>
             <td>$data[EventPlace]</td>
             <td><center>$data[EventStatus]</td>  
             <td><center><a href=?module=dtevent&act=editevent&id=$data[EventID]>Edit</a> | <a href=?module=dtevent&act=eventcategory&id=$data[EventID]>Category</a> 
             </td></tr>";
      $no++;
                    }  //|&nbsp; 
                    // <a href=\"javascript:delfile('$data[IDAirlines]','$data[AirlinesName]')\">Delete</a> 
                    echo "</table>";
                    
                    // Langkah 3            
                    $tampil2    = "SELECT * FROM rbd_event 
                                WHERE EventName LIKE '%$nama%'
                                AND EventDateTo >= '$today' ORDER BY EventDateFrom ASC";
                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=dtevent";
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
  
  case "tambahevent":
    $datenow = date("d", time());
    $monthnow = date("m", time());
    $yearnow = date("Y", time());
    $today = $yearnow."-".$monthnow."-".$datenow;
    //<tr><td>Agents</td><td> <textarea name='agent' cols=56 rows=3></textarea></td></tr>  
    echo "<h2>New Event</h2>
          <form name=example method=POST onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=dtevent&act=input' enctype='multipart/form-data'>
          <table>
          <tr><td>Event Name</td><td><input type=text name='event' size='50'></td></tr>
          <tr><td>Price in</td><td><select name='sellingcurr''>";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            while($s=mysql_fetch_array($tampil)){   
                if($s[curr]=='IDR'){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";    
                } else {
                     echo "<option value='$s[curr]' >$s[curr]</option>";     
                }
            }
    echo "</select></td></tr>
          <tr><td>Date</td> <td>From <input type='text' name='datefrom' size='10'  onClick="."cal.select(document.forms['example'].datefrom,'ActIn1','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(yyyy-mm-dd)</font>
          - To <input type=text name='dateto' size='10'  onClick="."cal.select(document.forms['example'].dateto,'anchor2','yyyy-MM-dd'); return false;"." NAME='anchor2' ID='anchor2'>
           <font color='red'>(yyyy-mm-dd)</font></td></tr>
          <tr><td>Place</td><td><input type=text name='place' size='40'></td></tr>       
          <tr><td>Remarks</td> <td>  <textarea rows='3' cols='40' name='remarks'></textarea></td></tr>
          <tr><td>Front Banner</td><td><input type='file' name='upload'>  </td></tr>
          <tr><td>Status</td><td><select name='status'><option value='OPEN' selected>OPEN</option>
                                                       <option value='CLOSE'>CLOSE</option>   
                                </select></td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;
    
  case "editevent":
    $edit=mysql_query("SELECT * FROM rbd_event WHERE EventID ='$_GET[id]'");
    $r=mysql_fetch_array($edit);                                                                                                         
    //<tr><td>Agents</td><td> <textarea name='agent' cols=56 rows=3>$r[Agent]</textarea></td></tr> 
    echo "<h2>Edit Event</h2>
          <form name='example' onsubmit='return validateFormOnSubmit(this)' method=POST action='./aksi.php?module=dtevent&act=update' enctype='multipart/form-data'>
          <input type=hidden name=id value='$r[EventID]'>
          <table>
          <tr><td>Event Name</td><td><input type=text name='event' size='50' value='$r[EventName]'></td></tr>
          <tr><td>Price in</td><td><select name='sellingcurr''>";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            while($s=mysql_fetch_array($tampil)){   
                if($s[curr]==$r[EventCurr]){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";    
                } else {
                     echo "<option value='$s[curr]' >$s[curr]</option>";     
                }
            }
    echo "</select></td></tr>
          <tr><td>Date</td> <td>From <input type='text' value='$r[EventDateFrom]' name='datefrom' size='10'  onClick="."cal.select(document.forms['example'].datefrom,'ActIn1','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(yyyy-mm-dd)</font>
          - To <input type=text value='$r[EventDateTo]' name='dateto' size='10'  onClick="."cal.select(document.forms['example'].dateto,'anchor2','yyyy-MM-dd'); return false;"." NAME='anchor2' ID='anchor2'>
           <font color='red'>(yyyy-mm-dd)</font></td></tr>
          <tr><td>Place</td><td><input type=text name='place' value='$r[EventPlace]' size='40'></td></tr>      
          <tr><td>Remarks</td> <td>  <textarea rows='3' cols='40' name='remarks'>$r[EventRemarks]</textarea></td></tr>";   
          $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[AttachmentFile]) ) ) );
    echo "<tr><td>Front Banner</td><td>";if($r[AttachmentFile]<>''){
    echo "<input type='hidden' name='attachmentfile' value='$r[AttachmentFile]'>
        <a href='$r[Attachment]$file' target='_blank' style=text-decoration:none >$r[AttachmentFile]</a> &nbsp<a href=\"javascript:delattach('$r[EventID]','$r[AttachmentFile]')\"><font color=red>remove</font></a>";}
                                        else{echo"<input type='file' name='upload' >";
                                        }echo"</td></tr>
          <tr><td>Status</td><td><select name='status'><option value='OPEN' ";if($r[EventStatus]=='OPEN'){echo"selected";}echo">OPEN</option>
                                                       <option value='CLOSE' ";if($r[EventStatus]=='CLOSE'){echo"selected";}echo">CLOSE</option>   
                                </select></td></tr>
          <tr><td colspan=2><center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
    break;
    
    case "eventcategory":
     $edit=mysql_query("SELECT * FROM rbd_event WHERE EventID ='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Category for $r[EventName]</h2>
          <form method='POST' name='example' action=./aksi.php?module=category&act=update>
          <input type=hidden name=id value='$r[EventID]'>
          <input type=hidden name='event' value='$r[EventName]'>
          <table id='crew' border='1'>";   
           $i=0;
           $coba=mysql_query("SELECT * FROM rbd_eventcat where EventID ='$_GET[id]' ");
            $baris=mysql_num_rows($coba);
            if ($baris==0){
                echo"<tr><th colspan=3></th><th colspan=2>Distribution date</th><th></th></tr>
                     <tr><th><img src='../images/add.png' class='cloneTableRows' /></th><th>Category</th><th>Price in $r[EventCurr]</th><th>From</th><th>To</th><th>Available Ticket</th></tr>
                     
                     <tr><td><img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' /></td>
                     <td><input type=text name='CatName[]' id='CatName[]' size=30 ></td>
                     <td><input type=text name='CatPrice[]' id='CatPrice[]' size=10 ></td>
                     <td><input type=text name='CatDateFrom[]' id='CatDateFrom[]' size=10  class='my_date'></td>
                     <td><input type=text name='CatDateTo[]' id='CatDateTo[]' size=10  class='my_date'></td>
                     <td><center><input type=text name='CatPax[]' id='CatPax[]' size=10 ></td> 
                  </tr>
                  </table>";    
            }else {
                echo"       
                    <tr><th colspan=3></th><th colspan=2>Distribution date</th><th></th></tr>
                    <tr><th><img src='../images/add.png' class='cloneTableRows' /></th><th>Category</th><th>Price in $r[EventCurr]</th><th>From</th><th>To</th><th>Available Ticket</th></tr>";
            while($tes=mysql_fetch_array($coba)){ 
                if($i==0){
                $vis="style='visibility: hidden;'";
                }else {$vis="style='visibility: visible;'";}                                     
            echo"<tr><td><img src='../images/delete.png' alt='' class='delRow' $vis />&nbsp</td>
          <td><input type=text name='CatName[]' id='CatName[]' size=30 value='$tes[CatName]'></td>
                     <td><input type=text name='CatPrice[]' id='CatPrice[]' size=10 value='$tes[CatPrice]'></td>
                     <td><input type=text name='CatDateFrom[]' id='CatDateFrom[]' size=10   value='$tes[CatDateFrom]'><input type=text name='CatTimeFrom[]' size=5 value='$tes[CatTimeFrom]' onblur='formatJam(this)'></td>
                     <td><input type=text name='CatDateTo[]' id='CatDateTo[]' size=10  value='$tes[CatDateTo]'><input type=text name='CatTimeTo[]' size=5 value='$tes[CatTimeTo]' onblur='formatJam(this)'></td>
                     <td><center><input type=text name='CatPax[]' id='CatPax[]' size=10 value='$tes[CatPax]'></td> 
                  </tr>";$i++;}echo"
          </table>";
          }
    echo"
          <center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()>
          </form>";
    break;
    
    case "delattach":    
    $edit1=mysql_query("SELECT * FROM rbd_event WHERE EventID ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1);
    $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r2[AttachmentFile]) ) ) );
    $path = $r2[Attachment];
    $files = ("$path$file");
    unlink($files);
    $edit=mysql_query("UPDATE rbd_event set Attachment = '',AttachmentFile='' WHERE EventID = '$_GET[id]'");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=dtevent&act=editevent&id=$_GET[id]'>";     
     break;    
}

?>
