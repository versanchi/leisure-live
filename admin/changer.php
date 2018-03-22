<SCRIPT LANGUAGE="JavaScript" SRC="../config/CalendarPopup.js"></SCRIPT>               
<script type="text/javascript" src="../config/jquery.js"></script>            
<script type="text/javascript" src="../head/jquery-1.3.2.min.js"></script>         
<SCRIPT LANGUAGE="JavaScript">
    var cal = new CalendarPopup(); 
</SCRIPT>
 <script language="javascript" type="text/javascript">
    function updatepage()
    {
        window.close();
        window.opener.location.reload();
    }
    function validateFormOnSubmit(theForm) {
var reason = "";                            
  reason += validateEmpty(theForm.newtourcode);      
  if (reason != "") {
    alert("WARNING:\n" + reason);
    return false;
  }

  return true;
}

function validateEmpty(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        fld.style.background = 'Yellow'; 
        error = "PLEASE INPUT NEW TOURCODE"
    } else {
        fld.style.background = 'White';
    }
    return error;  
}
function cektur(field) {

var usr = $("#newtourcode").val();
var tahun = $("#year").val();

if(usr.length >= 3)
{
$("#status").html('<img src="../admin/modul/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "../admin/modul/check.php",  
    data: { tourcode: usr ,tahun: tahun },
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

    if(msg == 'OK')
    { 
        $("#newtourcode").removeClass('object_error'); // if necessary
        $("#newtourcode").addClass("object_ok");
        $(this).html('&nbsp;<img src="../admin/modul/tick.gif" align="absmiddle">');
        document.example.elements['submits'].disabled=false;
    }  
    else  
    {  
        $("#newtourcode").removeClass('object_ok'); // if necessary
        $("#newtourcode").addClass("object_error");
        $(this).html(msg);
        document.example.elements['submits'].disabled=true;
    }  
   
   });

 } 
   
  }); 

}
else
    {
    $("#status").html('<font color="red">Tour Code too short.</font>');
    $("#newtourcode").removeClass('object_ok'); // if necessary
    $("#newtourcode").addClass("object_error");
    document.example.elements['submits'].disabled=true;
    }
}
</script>
                 
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" /> 
<?php 
include "../config/koneksi.php";
switch($_GET[act]){
  // Tampil Office
  default:
  	
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $depdate = substr($r[DateTravelFrom],8,2);         
    echo "<h2>CHANGE TOUR CODE</h2>    
          <form method=POST name='example' onsubmit='return validateFormOnSubmit(this)' action='?module=changer&act=save'>
          <input type='hidden' name=id value='$r[IDProduct]'><input type='hidden' name='year' id='year' value='$r[Year]'>";
            echo "<center><table>
                    
          <tr><td><b>Tour Code</b></td> <td><input type='text' name='oldtourcode' value='$r[TourCode]' style='border: 0px solid #000000;' readonly></td></tr>
          <tr><td><font color=blue><b>Date of Service</b></font></td> <td><input type='text' name='datetravelfrom' size='10' value='$r[DateTravelFrom]' onClick="."cal.select(document.forms['example'].datetravelfrom,'ActIn1','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn1'> to 
          <input type=text name='datetravelto' size='10' value='$r[DateTravelTo]' onClick="."cal.select(document.forms['example'].datetravelto,'anchor2','yyyy-MM-dd'); return false;"." NAME='anchor2' ID='anchor2'></td></tr>
          <tr><td><font color=blue><b>NEW Tour Code</b></font></td> <td><input type='text' name='newtourcode' id='newtourcode' onkeyup='cektur(this)'><div  id='status'  style='float:right;'></div></td></tr>
          </table>   
          <input type='submit' name='submits' value='UPDATE' disabled>
          </form>";
     break;  
  
  case "save":
  $TourCode=strtoupper($_POST[newtourcode]);                        
  $Description="Change Tourcode '$_POST[oldtourcode]' with '$TourCode'"; 
   mysql_query("UPDATE tour_msproduct set TourCode = '$TourCode',
                                        TourCodeOld = '$_POST[oldtourcode]',
                                        DateTravelFrom = '$_POST[datetravelfrom]',
                                        DateTravelTo = '$_POST[datetravelto]'
                                        WHERE IDProduct = '$_POST[id]'");
   mysql_query("UPDATE tour_msbooking set TourCode = '$TourCode'
                                        WHERE IDTourCode = '$_POST[id]'");
   mysql_query("UPDATE tour_msbookingdetail set TourCode = '$TourCode'
                                        WHERE IDTourCode = '$_POST[id]'");
  mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')"); 
  ?>
  <script language='javascript' type='text/javascript'>
    updatepage();
   
</script>  <?php 
}
?>
