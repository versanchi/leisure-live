<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>

<script type="text/javascript">
function hideadv(ID, Media)
{
if (confirm("Are you sure you want to delete "+ Media +" "))
{
 window.location.href = '?module=dtiklan&act=hideiklan&id=' + ID;
 
} 
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
  reason += validateEmpty(theForm.media);   
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
    var datefrom1 = fld.value;    
    dep1 = datefrom1.split("-");
    var dep = dep1[2]+ "/" +dep1[1]+ "/" +dep1[0];    
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
    var dateto1 = fld.value;    
    dep2 = dateto1.split("-");
    var arr = dep2[2]+ "/" +dep2[1]+ "/" +dep2[0];    
    var date = new Date(arr);
    var d  = date.getDate();
    var day = (d < 10) ? '0' + d : d;
    var m = date.getMonth() + 1;
    var month = (m < 10) ? '0' + m : m;
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    var arrdate = year + "/" + month + "/" + day ;
    
    var datefrom1 = example.datefrom.value;   
    dep1 = datefrom1.split("-");
    var dep = dep1[2]+ "/" +dep1[1]+ "/" +dep1[0];    
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
$username=$_SESSION[namauser];
$sqluser=mysql_query("SELECT employee_name,employee_code,office_id FROM tbl_msemployee WHERE employee_username='$username'");
$tampiluser=mysql_fetch_array($sqluser);
$sqloffice=mysql_query("SELECT office_code FROM tbl_msoffice WHERE office_id ='$tampiluser[office_id]'");
$tampiloff=mysql_fetch_array($sqloffice);
$EmpName="$tampiluser[employee_name] ($tampiluser[employee_code])";
$EmpOff=$tampiloff[office_code];           
$today = date("Y-m-d G:i:s");              
switch($_GET[act]){
  // Tampil User
  default:                                               
    echo "<h2>Advertisement</h2>
          <input type=button value='Add' onclick=location.href='?module=dtiklan&act=tambahiklan'>"; 
    $tampil=mysql_query("SELECT * FROM tour_iklan WHERE Status = 'ACTIVE' ORDER BY DateFrom,Media ASC limit 100 ");
    $ada=mysql_num_rows($tampil);
    if($ada>0){
    echo"<table>
          <tr><th>no</th><th>Media</th><th>date From</th><th>Date To</th><th>size/duration</th><th>description</th><th>action</th><th>Pax</th></tr>";
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
    $DF = date('d-m-Y', strtotime($r[DateFrom]));  
    $DT = date('d-m-Y', strtotime($r[DateTo]));                                                                                              
        echo "<tr><td>$no</td>
             <td>$r[Media]</td>
             <td>$DF</td>
             <td>$DT</td>          
             <td>$r[Size]</td>
             <td>$r[Description] </td>";
	if ($r[DateTo] <= '$today'){
					echo"<td><center><a href=?module=dtiklan&act=editiklan&id=$r[IDIklan]>Edit</a> | <a href=\"javascript:hideadv('$r[IDIklan]','$r[Media]')\">Delete</a> 
					 </td>";
			 }
			 else
			 {
			 echo"
             <td>CLOSED</td>";
			 }
	 		
	$Iklanbook=mysql_query("SELECT count(BookingID)as Dep,Sum(AdultPax+ChildPax) as Pax FROM tour_msbooking WHERE BookingDate <= '$r[DateTo]' and BookingDate >= '$r[DateFrom]' and TCDivision<>'LTM' and BookingStatus='DEPOSIT' ");
   $IklanBooking=mysql_fetch_array($Iklanbook);
			 echo"<td><center><a href=?module=dtiklan&act=Bookiklan&id=$r[IDIklan]>$IklanBooking[Pax]</a></center></td></tr>";
			 
			 
      $no++;
    }
    }else{echo"<br><br><font size='2'><i>*NO ADVERTISEMENT</i></font>";}
    echo "</table>";
    break;
  
  case "tambahiklan":                               
    echo "<h2>New Advertisement</h2>
          <form name=example method=POST onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=dtiklan&act=input'>
          <table>                
          <tr><td>Media</td><td><input type=text name='media' size='20'></td></tr>
          <tr><td>Size/Duration</td><td><input type=text name='size' size='20'></td></tr>
          <tr><td>Description</td><td><input type=text name='description' size='50'></td></tr>
          <tr><td>Date</td> <td>From <input type='text' name='datefrom' size='10'  onClick="."cal.select(document.forms['example'].datefrom,'ActIn1','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(dd-MM-yyyy)</font>
          - To <input type=text name='dateto' size='10'  onClick="."cal.select(document.forms['example'].dateto,'anchor2','dd-MM-yyyy'); return false;"." NAME='anchor2' ID='anchor2'>
           <font color='red'>(dd-MM-yyyy)</font></td></tr>             
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;
    
  case "editiklan":
    $edit=mysql_query("SELECT * FROM tour_iklan WHERE IDIklan ='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $AF = date('d-m-Y', strtotime($r[DateFrom]));  
    $AT = date('d-m-Y', strtotime($r[DateTo]));                                                         
    echo "<h2>Edit Advertisement</h2>
          <form name='example' method=POST action=./aksi.php?module=dtiklan&act=update>
          <input type=hidden name=id value='$r[IDIklan]'><input type='hidden' name='media' size='20' value='$r[Media]'>
          <table>
          <tr><td>Media</td><td>$r[Media]</td></tr>
          <tr><td>Size/Duration</td><td><input type=text name='size' size='50' value='$r[Size]'></td></tr>
          <tr><td>Description</td><td><input type=text name='description' size='50' value='$r[Description]'></td></tr>
          <tr><td>Date</td> <td>From <input type='text' name='datefrom' size='10' value='$AF' onClick="."cal.select(document.forms['example'].datefrom,'ActIn1','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(dd-MM-yyyy)</font>
          - To <input type=text name='dateto' size='10' value='$AT' onClick="."cal.select(document.forms['example'].dateto,'anchor2','dd-MM-yyyy'); return false;"." NAME='anchor2' ID='anchor2'>
           <font color='red'>(dd-MM-yyyy)</font></td></tr>  
          <tr><td colspan=2><center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
    break;
	
	case "Bookiklan":
    $edit=mysql_query("SELECT * FROM tour_iklan WHERE IDIklan ='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	$Booking=mysql_query("SELECT Destination,count(bookingID) as Book,sum(AdultPax + ChildPax) as Pax  FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode  WHERE BookingDate <= '$r[DateTo]' and BookingDate >= '$r[DateFrom]' and TCDivision<>'LTM' and BookingStatus='DEPOSIT' group by Destination");
	
    $AF = date('d-m-Y', strtotime($r[DateFrom]));  
    $AT = date('d-m-Y', strtotime($r[DateTo]));                                                         
    echo "<h2>Transaction From $AF until $AT</h2>
          <table>
		  <tr><th>Destination</th><th>Deposit</th><th>Pax</th></tr>";
		  $Pax=0;
		  $Dep=0;
          while ($Databook=mysql_fetch_array($Booking))
		  {
		  echo"<tr><td>$Databook[Destination]</td>
		  		<td style='text-align:right';>$Databook[Book]</td>
				<td style='text-align:right';>$Databook[Pax]</td>
		  		</tr>";
				$Pax=$Pax+$Databook[Pax];
				$Dep=$Dep+$Databook[Book];
		  
		  }
		  
		  echo"
	 	 	<tr><th>Total</th><th>$Dep</th><th>$Pax</th></tr>
          <tr><td colspan=3><center><input type=button value=CLOSE onclick=self.history.back()></td></tr>
          </table>";
    break;
   
case "hideiklan":               
    $edit1=mysql_query("SELECT * FROM tour_iklan WHERE IDIklan ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit1);    
    $edit=mysql_query("UPDATE tour_iklan SET Status = 'DELETE' WHERE IDIklan = '$_GET[id]'");
     $Description="DELETE IDIklan $_GET[id]";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=dtiklan'>";   
     break;
}

?>
