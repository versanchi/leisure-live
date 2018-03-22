<link type="text/css" href="../head/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>
<script type="text/javascript">
$(document).ready(function(){

    //-- Datepicker
    $(".my_date").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: '1950:2020',
        showButtonPanel: true
    });

    //-- Clone table rows
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
                    changeMonth: true,
                    changeYear: true,
                    yearRange: '1950:2020',
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
function setDateValue() {
    var valid = document.getElementById('PassportValid');
    var issue = document.getElementById('PassportIssuedDate').value;

    var datefrom1 = issue;
    dep1 = datefrom1.split("-");
    var dep = dep1[2]+ "/" +dep1[1]+ "/" +dep1[0];
    var date = new Date(dep);
    var d  = date.getDate();
    var day = (d < 10) ? '0' + d : d;
    var m = date.getMonth() + 1;
    var month = (m < 10) ? '0' + m : m;
    var yy = date.getYear() + 5;
    var year = (yy < 1000) ? yy + 1900 : yy;
    var valdate = day + "-" + month + "-" + year ;
    valid.value = valdate;
}
function dateValidate() {
    var fieldDateFirst = document.getElementById('PassportIssuedDate').value ;
    var fieldDateTwo = document.getElementById('PassportValid').value ;

    fieldDateFirst = fieldDateFirst.split("-");
    var StartDate = new Date();
    StartDate.setFullYear(fieldDateFirst[2],fieldDateFirst[1]-1,fieldDateFirst[0]);

    fieldDateTwo = fieldDateTwo.split("-");
    var EndDate = new Date();
    EndDate.setFullYear(fieldDateTwo[2],fieldDateTwo[1]-1,fieldDateTwo[0]);

    var today = new Date();
    if(StartDate > today)
    {
        alert("Date of issued can not be greater than current date");
        document.getElementById('PassportIssuedDate').value= "";
        fieldDateFirst.clear();
        fieldDateTwo.clear();
        return false;
    }
    else if(EndDate < StartDate)
    {
        alert("Date of Expiry should be greater than date of issued");
        document.getElementById('PassportIssuedDate').value= "";
        document.getElementById('PassportValid').value= "";
        fieldDateFirst.clear();
        fieldDateTwo.clear();
        return false;
    }
}
function ToGender(){
    var genVal = document.getElementById("call").value;
    if(genVal=="MR"){
        document.forms[0].sex[0].checked=true;
        document.forms[0].sex[0].disabled=false;
        document.forms[0].sex[1].disabled=true;
    }
    if(genVal=="MRS"){
        document.forms[0].sex[0].disabled=true;
        document.forms[0].sex[1].disabled=false;
        document.forms[0].sex[1].checked=true;
    }
}
function isNumber(field) {
    var re = /^[0-9'.']*$/;
    if (!re.test(field.value)) {
        alert('PLEASE INPUT NUMBER!');
        field.value = field.value.replace(/[^0-9'.']/g,"");
    }
}
function terimatl(ID) {
    if (confirm("Are you sure you want APPROVED: " + ID +"  "))
    {
        window.location.href = '?module=profile&act=terimatl&id=' + ID  ;

    }
}
function tolaktl(ID, STS, NM) {
        var alasan=prompt("Reason for REJECT/BLACKLIST: " + NM );
        if (alasan!=null && alasan!="")
        {
            window.location.href = '?module=profile&act=tolaktl&id=' + ID + '&status=' + STS + '&reason=' + alasan ;
        }
    }
</script>
<style>
    .list {
        border-collapse: collapse;
        width: 100%;
        border-top: 1px solid #BFBFBF;
        border-left: 1px solid #BFBFBF;
        margin-bottom: 20px;
        font-family: Tahoma;
        font-size: 8pt;
        padding-top:5px;
    }
    .list td {
        border-right: 1px solid #DDDDDD;
        border-bottom: 1px solid #DDDDDD;
    }
    .list thead td {
        background-color: #E5E5E5;
        padding: 0px 5px; text-transform: capitalize;
    }
    .list thead td a, .list thead td {
        text-decoration: none;
        color: #000000;
        font-weight: bold;

    }
    .list tbody a {
        text-decoration: none;
    }
    .list tbody td {
        vertical-align: middle;
        padding: 0px 5px;
    }
    .list tbody tr:odd {
        background: #FFFFFF;
    }
    .list tbody tr:even {
        background: #E4EEF7;
    }
    .list .left {
        text-align: left;
        padding: 7px;
    }
    .list .right {
        text-align: right;
        padding: 7px;
    }
    .list .center {
        text-align: center;
        padding: 7px;
    }
    .list .asc {
        padding-right: 15px;
        background: url('images/asc.png') right center no-repeat;
    }
    .list .desc {
        padding-right: 15px;
        background: url('images/desc.png') right center no-repeat;
    }
    .button{
        display: inline-block;
        white-space: nowrap;
        background-color: #ccc;
        background-image: -webkit-gradient(linear, left top, left bottom, from(#eee), to(#ccc));
        background-image: -webkit-linear-gradient(top, #eee, #ccc);
        background-image: -moz-linear-gradient(top, #eee, #ccc);
        background-image: -ms-linear-gradient(top, #eee, #ccc);
        background-image: -o-linear-gradient(top, #eee, #ccc);
        background-image: linear-gradient(top, #eee, #ccc);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#eeeeee', EndColorStr='#cccccc');
        border: 1px solid #777;
        padding: 0 1.5em;
        margin: 0.5em;
        font: bold 1em/2em Arial, Helvetica;
        text-decoration: none;
        color: #333;
        text-shadow: 0 1px 0 rgba(255,255,255,.8);
        -moz-border-radius: .2em;
        -webkit-border-radius: .2em;
        border-radius: .2em;
        -moz-box-shadow: 0 0 1px 1px rgba(255,255,255,.8) inset, 0 1px 0 rgba(0,0,0,.3);
        -webkit-box-shadow: 0 0 1px 1px rgba(255,255,255,.8) inset, 0 1px 0 rgba(0,0,0,.3);
        box-shadow: 0 0 1px 1px rgba(255,255,255,.8) inset, 0 1px 0 rgba(0,0,0,.3);
    }
</style>
<?php

$username=$_SESSION[employee_code];
$sqluser=mssql_query("SELECT DivisiNo,Employee.DivisiID,EmployeeID,Category,EmployeeName,CompanyGroup FROM [HRM].[dbo].[Employee]
                      inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                      WHERE EmployeeID ='$username'");
$tampiluser=mssql_fetch_array($sqluser);
$EmpName="$tampiluser[EmployeeName] ($tampiluser[EmployeeID])";
$EmpOff=$tampiluser[DivisiID];
$offgroup=$tampiluser[CompanyGroup];
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
$hariini = date("Y-m-d ");
switch($_GET[act]) {
    // Tampil Visa
    default:
        $edit = mssql_query("SELECT * FROM [HRM].[dbo].[Employee] WHERE EmployeeID='$_SESSION[employee_code]'");
        $r = mssql_fetch_array($edit);
        $TglLahir = date("d M Y", strtotime($r[BirthDate]));
        if ($r[Title] == '') {
            $title = '';
        } else {
            $title = "$r[Title].";
        }
        echo "<div style='display: inline-block; width: 100%; margin-bottom: 15px; clear: both;'>
		  	<div style='float: left; width: 49%;'><h2>$_SESSION[employee_name]'s Profile</h2></div>
			<div style='float: right; width: 49%; padding: 5px; font-size: 10px; text-align:right; valign:middle;'>$r[EmployeeType]</div>
		  </div>";
        echo "
		<div style=\"display: inline-block; width: 100%; margin-bottom: 15px; clear: both;\">
        <div style=\"float: left; width: 49%;\">
		 <div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
		 	Profile
		 </div>
		  <input type=hidden name='employee_code' value='$_SESSION[employee_code]'>
          <table class='list'>
			  <tr><td class='left' width='30%'>Full Name</td>	<td class='left'>  $title $r[EmployeeName]</td></tr>
			  <tr><td class='left'>Name as Passport</td>		<td class='left'>  $r[NameAsPassport]</td></tr>
			  <tr><td class='left'>Nick Name</td>				<td class='left'>  $r[NickName]</td></tr>
			  <tr><td class='left'>Gender</td>   		 		<td class='left'>  $r[Gender]</td></tr>
			  <tr><td class='left'>Address</td>   		 		<td class='left'>  $r[Address]</td></tr>
			  <tr><td class='left'>Place of Birth</td>			<td class='left'>  $r[BirthPlace]</td></tr>
			  <tr><td class='left'>Date of Birth</td>	 		<td class='left'>  $TglLahir</td></tr>
			  <tr><td class='left'>Nationality</td>				<td class='left'>  $r[Nationality]</td></tr>
			  <tr><td class='left'>Weight</td>					<td class='left'>  $r[Weight] Kg</td></tr>
			  <tr><td class='left'>Height</td>					<td class='left'>  $r[Height] Cm</td></tr>
			  <tr><td class='left'>Religion</td>				<td class='left'>  $r[Religion]</td></tr>
			  <tr><td class='left'>Hobbies</td>					<td class='left'>  $r[Hobbies]</td></tr>
		  </table>
		</div>

	<div style=\"float: right; width: 49%;\">
		<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
		Contact
		</div>
		<table class='list'>
		  <tr><td class='left' width='25%'>Phone Number</td><td class='left'>$r[Phone]</td></tr>
		  <tr><td class='left'>Mobile Phone</td><td class='left'>$r[Mobile]</td></tr>
		  <tr><td class='left'>Blackberry PIN No</td><td class='left'>$r[BBpin]</td></tr>
		  <tr><td class='left'>Email</td><td class='left'>$r[Email]</td></tr>
		</table>
		</div>
        <div style=\"float: right; width: 49%;\">
        <div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
             Photo
        </div>
        <table class='list'><tbody>";
        if ($r[Photo] != '') {
            echo "<tr><td class='center' colspan='3'> <img src='http://tourleader.panoramawebsys.com/foto_user/small_$r[Photo]'> </td></tr>";
        } else {
            echo "<tr><td class='center' colspan='3'><b>...::: No Image :::...</b></td></tr>";
        }
        echo "
        </tbody></table>
		<div align='center' style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">Tourleader Rating</div>
		<table class='list'>
		  <tr><td class='center'><div style='font-size:24px; font-weight: bold; color: #547C96;'>$r[Rate]</div></td></tr>
        </table>";

        $RuteEx = mssql_query("Select RT.RuteName, RT.RuteYear from [HRM].[dbo].[Employee] ST
							INNER JOIN [HRM].[dbo].[TourLeaderRute] RT ON ST.RuteID = RT.RuteID
					       WHERE EmployeeID = '$_SESSION[employee_code]'");
        $foundRuteEx = mssql_num_rows($RuteEx);
        if ($foundRuteEx > 0) {
            echo "<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
				Rute Experience
			 </div>
			  <table class='list'>
			  <thead>
			  	<tr><td class='center'>Destination</td><td class='center'>Year</td></tr>
			  </thead>";
            while ($row3 = mssql_fetch_array($RuteEx)) {
                echo "<tr><td class='left'>$row3[RuteName]</td><td class='center'>$row3[RuteYear]</td></tr>";
            }
            echo "</table>";
        }

        $visa = mssql_query("SELECT visa.VisaName, visa.VisaDate FROM [HRM].[dbo].[TourLeaderVisa] visa
							INNER JOIN [HRM].[dbo].[Employee] tl ON visa.VisaID = tl.VisaID
					     WHERE EmployeeID = '$_SESSION[employee_code]'");
        $foundVisa = mssql_num_rows($visa);
        if ($foundVisa > 0) {
            echo "<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
				Visa and Validity
			 </div>
			  <table class='list'>
			  <thead>
			  	<tr><td class='center'>Visa Name</td><td class='center'>Validity Date</td></tr>
			  </thead>";
            while ($row4 = mssql_fetch_array($visa)) {
                echo "<tr><td class='left'>$row4[VisaName]</td>
						<td class='center'>$row4[VisaDate]</td>
					</tr>";
            }
            echo "</table>";
        }

        $SpecialEvent = mssql_query("SELECT SpecialEventName FROM [HRM].[dbo].[TourLeaderSpecialEvent] sp
								INNER JOIN [HRM].[dbo].[Employee] tl ON tl.SpecialEventID = sp.SpecialEventID
								WHERE EmployeeID = '$_SESSION[employee_code]'");
        $foundEvnt = mssql_num_rows($SpecialEvent);
        if ($foundEvnt > 0) {
            echo "<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
				Special Event Handling
			 </div>
			  <table class='list'>";
            while ($row3 = mssql_fetch_array($SpecialEvent)) {
                echo "<tr><td class='left'>$row3[SpecialEventName]</td>
					</tr>";
            }
            echo "</table>";
        }
        echo "</div></div>";

        $EduFor = mssql_query("SELECT * FROM [HRM].[dbo].[TourLeaderEducation] EDU
		  					   INNER JOIN [HRM].[dbo].[Employee] TL ON TL.EducationID = EDU.EducationID
							   WHERE EmployeeID = '$_SESSION[employee_code]'");
        $foundEduFor = mssql_num_rows($EduFor);
        if ($foundEduFor > 0) {
            echo "<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
				Educational Backgroud
			 </div>
			  <table class='list' id='EducationalBackground' border='1'>
				  <thead>
					<tr>
						<td class='center'>Educational Level</td>
						<td class='center'>School Name</td>
						<td class='center'>Location</td>
						<td class='center'>Year</td>
						<td class='center'>GPA</td>
						<td class='center'>Degree - Major</td>
					</tr>
				  </thead>";

            while ($row1 = mssql_fetch_array($EduFor)) {
                echo "<tr>
						<td class='left'>$row1[EducationalLevel]</td>
						<td class='left'>$row1[SchoolName]</td>
						<td class='left'>$row1[Location]</td>
						<td class='center'>$row1[Year]</td>
						<td class='center'>$row1[GPA]</td>
						<td class='left'>$row1[Major]</td>
					  </tr>";
            }
            echo " </table>";
        }

        $EduFor = mssql_query("SELECT * FROM [HRM].[dbo].[TourLeaderInformalEdu] INFEDU
										INNER JOIN [HRM].[dbo].[Employee] TL ON TL.InformalEduID = INFEDU.InformalEduID
								     WHERE EmployeeID = '$_SESSION[employee_code]'");
        $foundEduFor = mssql_num_rows($EduFor);
        if ($foundEduFor > 0) {
            echo "<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
				Informal Education
			</div>
			  <table class='list' id='InformalEdu' border='1'>
				  <thead>
					<tr>
					   <td class='center'>Course Name</td>
						<td class='center'>Organizer</td>
						<td class='center' width='20%'>Course Period</td>
						<td class='center' width='20%'>Certified / Non</td>
					</tr>
				  </thead>";
            while ($row2 = mssql_fetch_array($EduFor)) {
                echo "		  <tr>
						<td class='left'>$row2[CourseName]</td>
						<td class='left'>$row2[Organizer]</td>
						<td class='center'>$row2[CoursePeriod]</td>
						<td class='center'>$row2[Certified]</td>
					  </tr>";
            }
            echo " </table>";
        }

        $Language = mssql_query("SELECT * FROM [HRM].[dbo].[TourLeaderLanguage] LANG
		  					 INNER JOIN [HRM].[dbo].[Employee] TL ON TL.LanguageID = LANG.LanguageID
							 WHERE EmployeeID = '$_SESSION[employee_code]'");
        $foundLanguage = mssql_num_rows($Language);
        if ($foundLanguage > 0) {
            echo "<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
				Mastery in Foreign & Regional Language
			</div>
			  <table class='list' id='Language' border='1'>
				  <thead>
					<tr>
						<td class='center'>Language</td>
						<td class='center'>Reading</td>
						<td class='center'>Writing</td>
						<td class='center' width='30%'>Communication (Speaking & Listening)</td>
					</tr>
				  </thead>";
            while ($row3 = mssql_fetch_array($Language)) {
                echo "		  <tr>
						<td class='left'>$row3[LanguageName]</td>
						<td class='center'>$row3[Reading]</td>
						<td class='center'>$row3[Writing]</td>
						<td class='center'>$row3[Communication]</td>
					  </tr>";
            }
            echo " </table>";
        }

        $work = mssql_query("SELECT * FROM [HRM].[dbo].[TourLeaderWork] work
					   		INNER JOIN [HRM].[dbo].[Employee] tl ON tl.WorkID = work.WorkID
					   	 WHERE EmployeeID = '$_SESSION[employee_code]'");
        $foundwork = mssql_num_rows($work);
        if ($foundwork > 0) {
            echo "<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
				Work Experience
			</div>
			  <table class='list'>
			  <thead>
					<tr>
						<td class='center' rowspan='2' style='vertical-align:middle;'>Company Name</td>
						<td class='center' rowspan='2' style='vertical-align:middle;'>Phone No</td>
						<td class='center' rowspan='2' style='vertical-align:middle;'>Type of Business</td>
						<td class='center' rowspan='2' style='vertical-align:middle;'>Position</td>
						<td class='center' colspan='2' style='vertical-align:middle;'>Job Period</td>
						<td class='center' rowspan='2' style='vertical-align:middle;'>Reason For Leaving</td>
					</tr>
					<tr>
						<td class='center'><i>From</i></td>
						<td class='center'><i>To</i></td>
					</tr>
			  </thead>";
            while ($row1 = mssql_fetch_array($work)) {
                echo "<tr>
						<td class='left'>$row1[CompanyName]</td>
						<td class='center'>$row1[PhoneNo]</td>
						<td class='left'>$row1[BusinessType]</td>
						<td class='left'>$row1[Position]</td>
						<td class='center'>$row1[DateFrom]</td>
						<td class='center'>$row1[DateTo]</td>
						<td class='left'>$row1[Reason]</td>
					</tr>";
            }
            echo "</table>";
        }

        $free = mssql_query("SELECT FreelanceName, GroupCountry, TotalPax, FreelanceYear, Agent FROM [HRM].[dbo].[TourLeaderFreelance] fr
					   	INNER JOIN [HRM].[dbo].[Employee] tl ON tl.FreelanceID = fr.FreelanceID
					    WHERE EmployeeID = '$_SESSION[employee_code]'");
        $foundFree = mssql_num_rows($free);
        if ($foundFree > 0) {
            echo "<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
				Group handling Experience
			</div>
			  <table class='list'>
			  <thead>
					<tr>
						<td class='center' rowspan='2' style='vertical-align:middle;'>Group Handing</td>
						<td class='center' rowspan='2' style='vertical-align:middle;'>Country</td>
						<td class='center' rowspan='2' style='vertical-align:middle;'>Total PAX</td>
						<td class='center' rowspan='2' style='vertical-align:middle;'>Year</td>
						<td class='center' colspan='2' style='vertical-align:middle;'>Agent</td>
					</tr>
			  </thead>";
            while ($row2 = mssql_fetch_array($free)) {
                echo "<tr><td class='left'>$row2[FreelanceName]</td>
						<td class='center'>$row2[GroupCountry]</td>
						<td class='center'>$row2[TotalPax]</td>
						<td class='center'>$row2[FreelanceYear]</td>
						<td class='left'>$row2[Agent]</td>
					</tr>";
            }
            echo "</table>";
        }
        echo "<table class='list' style='border:0'>
		  	<tr>
				<td class='center' style='border:0'>
					<a href='?module=profile&act=editprofile&employee_code=$r[EmployeeID]' class='button star'>Edit Profile</a>
				</td>
			</tr>
		  </table>";
        break;

    case "showprofile":
        $duapuluh = $thn_sekarang - 20;
        $edit = mssql_query("SELECT * FROM [HRM].[dbo].[Employee] WHERE EmployeeID ='$_GET[id]'");
        $r = mssql_fetch_array($edit);
        if ($r[BirthDate] == "" or $r[BirthDate] == "0000-00-00") {
            $dateofbirth = "";
        } else {
            $dateofbirth = date("d-m-Y", strtotime($r[BirthDate]));
        }
        $TglLahir = date("d-m-Y", strtotime($r[BirthDate]));

        if ($r[PassportValid] == '0000-00-00') {
            $PassportValid = '';
        } else {
            $PassportValid = date("d-m-Y", strtotime($r[PassportValid]));
        }
        if ($r[PassportIssuedDate] == '0000-00-00') {
            $PassportIssuedDate = '';
        } else {
            $PassportIssuedDate = date("d-m-Y", strtotime($r[PassportIssuedDate]));
        }


        echo "<h2>Detail Tour Leader</h2>

    <input type='hidden' name='idTourleader' value='$r[EmployeeID]' />
    <div style=\"display: inline-block; width: 100%; margin-bottom: 15px; clear: both;\">
    <div style=\"float: left; width: 49%;\">
     <div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
        Profile
     </div>

    <table class='list'><tbody>
      <tr><td class='left'>Full Name</td>
          <td class='left' colspan='4'>$r[Title]. $r[EmployeeName]
          </td>
      </tr>
      <tr><td class='left'>Name as Passport</td><td colspan='4'>$r[NameAsPassport]</td></tr>
      <tr><td class='left'>Nick Name</td>
          <td class='left' colspan='4'> $r[NickName]</td>
      </tr>
      <tr><td class='left'>Address</td>
          <td colspan='4'> <textarea name='address' id='loko' style='width: 250px; height: 90px;' readonly>$r[Address]</textarea></td></tr>";
        if ($r[Gender] == "") {
            echo "<tr><td>Gender</td>
          <td style='border:0;' width='1%' class='right'><input type=radio name='sex' value='MALE' checked></td>
          <td style='border:0;' width='5%'>Male</td>
          <td style='border:0;' width='1%' class='right'><input type=radio name='sex' value='FEMALE' disabled></td>
          <td style='border:0;'>Female</td></tr>";
        } else {
            echo "<tr><td class='left'>Gender</td>
          <td colspan='4'><input type='hidden' name='sex' value='$r[Gender]' /> $r[Gender]</td></tr>";
        }
        echo "<tr><td class='left'>Place of Birth</td>
          <td colspan='4'>";
        if ($r[BirthPlace] == "") {
            echo "<input type=text name='placebirth' value='$r[BirthPlace]' size=30 required />";
        } else {
            echo "<input type='hidden' name='placebirth' value='$r[BirthPlace]' /> $r[BirthPlace]";
        }
        echo "	  </td></tr>
      <tr><td class='left'>Date of Birth</td>
          <td colspan='4'>";
        if ($r[BirthDate] == "" or $r[BirthDate] == "0000-00-00") {
            echo "<input type='text' id='datepicker' name='dateofbirth' size='30' class='my_date' value='$dateofbirth' required />";
        } else {
            echo "<input type='hidden' name='dateofbirth' value='$dateofbirth' /> $dateofbirth";
        }
        echo "	  </td></tr>
      <tr><td class='left'>Nationality</td>
          <td class='left' colspan='4'>";
        if ($r[Nationality] == "") {
            echo "INDONESIA";
        } else {
            echo "$r[Nationality]";
        }
        echo "</td>
      </tr>
      <tr><td class='left'>Weight / Height</td>
          <td class='left' colspan='4'>
            $r[Weight] Kg /
            $r[Height] Cm<br /></td></tr>
      <tr><td class='left'>Religion</td><td>$r[Religion]</td></tr>
      <tr><td class='left'>Hobby</td>
          <td colspan='4'> <textarea name='hobi' id='loko' style='width: 250px; height: 90px;' readonly>$r[Hobbies]</textarea></td></tr>
      </tbody></table>
    </div>

    <div style=\"float: right; width: 49%;\">
    <div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
        Contact
    </div>
    <table class='list'>
          <tr><td class='left' width='25%'>Phone Number</td>
              <td class='left'> $r[Phone]</td></tr>
          <tr><td class='left'>Mobile Phone</td>
              <td class='left'> $r[Mobile]</td></tr>
          <tr><td class='left'>Blackberry PIN No</td>
              <td class='left'>$r[BBpin]</td></tr>
          <tr><td class='left'>Email</td>
              <td class='left'> $r[Email]</td></tr>
    </table>
    </div>
    <div style=\"float: right; width: 49%;\">
        <div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
             Photo
        </div>
        <table class='list'><tbody>";
        if ($r[Photo] != '') {
            echo "<tr><td class='center' colspan='3'> <img src='http://tourleader.panoramawebsys.com/foto_user/small_$r[Photo]'> </td></tr>";
        } else {
            echo "<tr><td class='center' colspan='3'><b>...::: No Image :::...</b></td></tr>";
        }
        echo "
        </tbody></table>
      <div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
        Rute Experience
      </div>
      <table class='list' id='RuteExperience' border='1'>
          <thead>
            <tr>

                <td class='center'>Destinantion</td>
                <td class='center'>Year</td>
            </tr>
          </thead>
          <tbody>";
        $i = 0;
        $Rute = mssql_query("Select RT.RuteName, RT.RuteDate, RT.RuteYear from [HRM].[dbo].[Employee] ST
                                INNER JOIN [HRM].[dbo].[TourLeaderRute] RT ON ST.RuteID = RT.RuteID
                               WHERE EmployeeID = '$_GET[id]' ORDER BY RT.RuteName ASC");
        $rowRute = mssql_num_rows($Rute);
        if ($row < 1) {
            echo "		  <tr>

                        <td class='center'>NONE</td>
                        <td class='center'>NONE</td>
                      </tr>";
        } else {
            while ($tes = mssql_fetch_array($Rute)) {
                if ($tes[RuteDate] == '0000-00-00') {
                    $RuteDate = '';
                } else {
                    $RuteDate = date("d-m-Y", strtotime($tes[RuteDate]));
                }
                if ($i == 0) {
                    $vis = "style='visibility: hidden;'";
                } else {
                    $vis = "style='visibility: visible;'";
                }
                echo "		  <tr>

                <td class='center'>$tes[RuteName]</td>
                <td class='center'>";
                if ($tes[RuteYear] == '') {
                    echo "NONE";
                } else {
                    $tes[RuteYear];

                }
                echo "		</td>
              </tr>";
                $i++;
            }
        }
        echo "</tbody>
      </table>

     <div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
        Visa and Validity
     </div>
     <table class='list' id='VisaAndValidity' border='1'>
          <thead>
            <tr>

                <td class='center'>Visa Name</td>
                <td class='center'>Validity Date</td>
            </tr>
          </thead>
          <tbody>";
        $i = 0;
        $visa = mssql_query("SELECT * FROM [HRM].[dbo].[TourLeaderVisa] VISA
								   	INNER JOIN [HRM].[dbo].[Employee] TL ON TL.VisaID = VISA.VisaID
                               WHERE EmployeeID = '$_GET[id]' ORDER BY VisaDate ASC");
        $row = mssql_num_rows($visa);
        if ($row < 1) {
            echo "		  <tr>

                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
              </tr>";
        } else {
            while ($tes = mssql_fetch_array($visa)) {
                if ($tes[VisaDate] == '0000-00-00') {
                    $VisaDate = '';
                } else {
                    $VisaDate = date("d M Y", strtotime($tes[VisaDate]));
                }

                echo "<tr>
                <td class='center'>$tes[VisaName]</td>
                <td class='center'>$VisaDate</td>
              </tr>";
                $i++;
            }
        }
        echo "</tbody>
      </table>

     <div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
        Special Event Handling
     </div>
     <table class='list' id='SpecialEventHandling' border='1'>
          <thead>
            <tr>

                <td class='center'>Special Event Handling</td>
            </tr>
          </thead>
          <tbody>";
        $i = 0;
        $visa = mssql_query("SELECT SpecialEventName FROM [HRM].[dbo].[TourLeaderSpecialEvent] SE
                                    INNER JOIN [HRM].[dbo].[Employee] TL ON TL.SpecialEventID = SE.SpecialEventID
                               WHERE EmployeeID = '$_GET[id]' ORDER BY SpecialEventName ASC");
        $row = mssql_num_rows($visa);
        if ($row == 0) {
            echo "		  <tr>

                <td class='center'>NONE</td>
              </tr>";
        } else {
            while ($tes = mssql_fetch_array($visa)) {

                echo "		  <tr>

                <td class='center'>$tes[SpecialEventName]</td>
              </tr>";
                $i++;
            }
        }
        echo "</tbody>
      </table>";
        echo "</div></div>";

        echo "<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
        Passport
     </div>
      <table class='list'><tbody>
          <tr><td class='left'>Passport No</td>
              <td class='left'> $r[PassportNo]</td>
              <td class='left'>Issuing Office</td>
              <td class='left'> $r[PassportIssued]</td>
          </tr>

          <tr><td class='left'>Date Of Issued</td>
              <td class='left'>$PassportIssuedDate</td>
          <td class='left'>Date Of Expiry</td>
              <td class='left'>$PassportValid</td></tr>
        </tbody></table>

     <div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
        Remark
     </div>
      <table class='list'><tbody>
          <tr><td class='left' width='30%'>Remark</td>
              <td class='left'> <textarea name='remark' id='loko' style='width: 250px; height: 90px;' readonly>$r[Remarks]</textarea></td></tr>
        </tbody></table>

     <div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
        Educational Backgroud
     </div>
      <table class='list' id='EducationalBackground' border='1'>
          <thead>
            <tr>

                <td class='center'>Educational Level</td>
                <td class='center'>School Name</td>
                <td class='center'>Location</td>
                <td class='center'>Year</td>
                <td class='center'>GPA</td>
                <td class='center'>Degree - Major</td>
            </tr>
          </thead>
          <tbody>";
        $i = 0;
        $edu = mssql_query("SELECT * FROM [HRM].[dbo].[TourLeaderEducation] EDU
                                INNER JOIN [HRM].[dbo].[Employee] TL ON TL.EducationID = EDU.EducationID
                              WHERE EmployeeID = '$_GET[id]' ORDER BY Year ASC");
        $rowEdu = mssql_num_rows($edu);
        if ($rowEdu == 0) {
            echo "		  <tr>

                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
              </tr>";
        } else {
            while ($row = mssql_fetch_array($edu)) {

                echo "<tr>

                <td class='center'>$row[EducationalLevel]</td>
                <td class='center'>$row[SchoolName]</td>
                <td class='center'>$row[Location]</td>
                <td class='center'>$row[Year]</td>
                <td class='center'>$row[GPA]</td>
                <td class='center'>$row[Major]</td>
              </tr>";
                $i++;
            }
        }
        echo "  </tbody>
      </table>

     <div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
        Informal Education
     </div>
      <table class='list' id='InformalEdu' border='1'>
          <thead>
            <tr>

                <td class='center'>Course Name</td>
                <td class='center'>Organizer</td>
                <td class='center'>Course Period</td>
                <td class='center'>Certified / Non</td>
            </tr>
          </thead>
          <tbody>";
        $i = 0;
        $InEdu = mssql_query("SELECT * FROM [HRM].[dbo].[TourLeaderInformalEdu] INEDU
                                INNER JOIN [HRM].[dbo].[Employee] TL ON TL.InformalEduID = INEDU.InformalEduID
                                WHERE EmployeeID = '$_GET[id]' ORDER BY CourseName ASC");
        $rowInEdu = mssql_num_rows($InEdu);
        if ($rowInEdu == 0) {
            echo "		  <tr>

                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
              </tr>";
        } else {
            while ($row = mssql_fetch_array($InEdu)) {

                echo "<tr>

                <td class='center'>$row[CourseName]</td>
                <td class='center'>$row[Organizer]</td>
                <td class='center'>$row[CoursePeriod]</td>
                <td class='center'>$row[Certified]</td>
              </tr>";
                $i++;
            }
        }
        echo "  </tbody>
      </table>

     <div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
        Mastery in Foreign & Regional Language
     </div>
      <table class='list' id='Language' border='1'>
          <thead>
            <tr>

                <td class='center'>Language</td>
                <td class='center'>Reading</td>
                <td class='center'>Writing</td>
                <td class='center'>Communication (Speaking & Listening)</td>
            </tr>
          </thead>
          <tbody>";
        $i = 0;
        $Lang = mssql_query("SELECT * FROM [HRM].[dbo].[TourLeaderLanguage] LANG
                                    INNER JOIN [HRM].[dbo].[Employee] TL ON TL.LanguageID = LANG.LanguageID
                               WHERE EmployeeID = '$_GET[id]' ORDER BY LanguageName ASC");
        $rowLang = mssql_num_rows($Lang);
        if ($rowLang == 0) {
            echo "		  <tr>

                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
              </tr>";
        } else {
            while ($row = mssql_fetch_array($Lang)) {

                echo "		  <tr>

                <td class='center'>$row[LanguageName]</td>
                <td class='center'>$row[Reading]</td>
                <td class='center'>$row[Writing]</td>
                <td class='center'>$row[Communication]</td>
              </tr>";
                $i++;
            }
        }
        echo "   </tbody>
      </table>

     <div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
        Working Experience
     </div>
      <table class='list' id='WorkingExperience' border='1'>
          <thead>
            <tr>

                <td class='center' rowspan='2' style='vertical-align:middle;'>Company Name</td>
                <td class='center' rowspan='2' style='vertical-align:middle;'>Phone No</td>
                <td class='center' rowspan='2' style='vertical-align:middle;'>Type of Business</td>
                <td class='center' rowspan='2' style='vertical-align:middle;'>Position</td>
                <td class='center' colspan='2' style='vertical-align:middle;'>Job Period</td>
                <td class='center' rowspan='2' style='vertical-align:middle;'>Reason For Leaving</td>
            </tr>
            <tr>
                <td class='center'><i>From</i></td>
                <td class='center'><i>To</i></td>
            </tr>
          </thead>
          <tbody>";
        $i = 0;
        $Work = mssql_query("SELECT * FROM [HRM].[dbo].[TourLeaderWork] WORK
                                    INNER JOIN [HRM].[dbo].[Employee] TL ON TL.WorkID = WORK.WorkID
                               WHERE EmployeeID = '$_GET[id]' ORDER BY DateFrom ASC");
        $rowWork = mssql_num_rows($Work);
        if ($rowWork == 0) {
            echo "		  <tr>

                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
              </tr>";
        } else {
            while ($row = mssql_fetch_array($Work)) {

                echo "		  <tr>

                <td class='center'>$row[CompanyName]</td>
                <td class='center'>$row[PhoneNo]</td>
                <td class='center'>$row[BusinessType]</td>
                <td class='center'>$row[Position]</td>
                <td class='center'>$row[DateFrom]</td>
                <td class='center'>$row[DateTo]</td>
                <td class='center'>$row[Reason]</td>
              </tr>";
                $i++;
            }
        }
        echo "    </tbody>
      </table>

     <div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
        Group handling Experience
     </div>
      <table class='list' id='FreelanceData' border='1'>
          <thead>
            <tr>

                <td class='center'>Group Handling</td>
                <td class='center'>Country</td>
                <td class='center'>Total PAX</td>
                <td class='center'>Year</td>
                <td class='center'>Agent</td>
            </tr>
          </thead>
          <tbody>";
        $i = 0;
        $coba = mssql_query("SELECT * FROM [HRM].[dbo].[TourLeaderFreelance] FREE
                                    INNER JOIN [HRM].[dbo].[Employee] TL ON TL.FreelanceID = FREE.FreelanceID
                                WHERE EmployeeID = '$_GET[id]' ORDER BY FreelanceYear, FreelanceName ASC");
        $baris = mssql_num_rows($coba);
        if ($baris == 0) {
            echo "		  <tr>

                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
                <td class='center'>NONE</td>
              </tr>";
        } else {
            while ($tes = mssql_fetch_array($coba)) {

                echo " <tr>

                <td class='center'>$tes[FreelanceName]</td>
                <td class='center'>$tes[GroupCountry]</td>
                <td class='center'>$tes[TotalPax]</td>
                <td class='center'>$tes[FreelanceYear]</td>
                <td class='center'>$tes[Agent]</td>
              </tr>";
                $i++;
            }
        }
        echo "     </tbody>
    </table>
    <form method='POST'>
    <table class='list' style='border:0'>
        <tr>
            <td class='center' style='border:0'>";
        if ($r[StatusTL] == 'REQUEST') {
            echo "
                <input type=button value='APPROVE' class='button' onclick=\"javascript:terimatl('$_GET[id]')\">
                <input type=button value='REJECT' class='button' onclick=\"javascript:tolaktl('$_GET[id]','REJECT','$r[employee_name]')\">
                <input type=button value='BLACKLIST' class='button' onclick=\"javascript:tolaktl('$_GET[id]','BLACKLIST','$r[employee_name]')\">";
        }
        if ($r[StatusTL] == 'APPROVED') {
            echo "
                <input type=button value='BLACKLIST' class='button' onclick=\"javascript:tolaktl('$_GET[id]','BLACKLIST','$r[employee_name]')\">";
        }
        echo "
                <input type=button value='CANCEL' class='button' onclick=self.history.back()>
            </td>
        </tr>
      </table>
    </form>";
        break;

    case "terimatl":
        $sqluser = mssql_query("SELECT * from [HRM].[dbo].[Employee] WHERE EmployeeID='$_GET[id]'");  
        $tampiluser = mssql_fetch_array($sqluser);
        $edit = mssql_query("UPDATE [HRM].[dbo].[Employee] set StatusTL = 'APPROVED',
                                                    TLApprovalName = '$EmpName',
                                                    TLApprovalDiv = '$EmpOff',
                                                    TLApprovalDate = '$today'
                                                    WHERE EmployeeID = '$_GET[id]'");

        $Description = "APPROVED TL ($_GET[id])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                               Description,
                               LogTime)
                        VALUES ('$EmpName',
                               '$Description',
                               '$today')");
        $useremail = "$tampiluser[Email]";
        //$useremail='ins@panorama-tours.com';
        $usercode = $tampiluser[EmployeeID];
        $userpassport = $tampiluser[NameAsPassport];
        $userstatus = $tampiluser[StatusTL];
        $userpass = $tampiluser[StatusTL];
        if ($tampiluser[EmployeeType] == 'INHOUSE') {
            $pswd = 'YOUR DEFAULT PASSWORD';
            $site = 'http://hrm.panoramawebsys.web.id';
        } else {
            $pswd = '*date of birth, format: DDMMYYYY';
            $site = 'http://tourleader.panoramawebsys.web.id';
        }
        //Rp '.number_format(($ttlprice + $nmr),2,',','.').'
        $message = "\n";
        $message .= "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">" . "\n";
        $message .= "<html>" . "\n";
        $message .= "<head>" . "\n";
        $message .= "</head>" . "\n";
        $message .= '<body bgcolor="#FFFFFF" text="#333333" style="background-color: #FFFFFF; margin-bottom : 0px; margin-left : 0px; margin-top : 0px; margin-right : 0px;">
                <table style="font-size: 10px; font-family: verdana; color: #ffffff; width: 700px;" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
                <tbody>
                <tr>
                <style type="text/css">
                body, table, td, p { font-size: 14px; }
                img { border: 0px; }
                p { margin: 10px 0px; line-height: 237% }
                </style>
                </tr>
                <tr>
                  <td colspan="2"style="padding: 40px; color: #333333">
                  <h1>Dear ' . $userpassport . ',</h1>
                        <p style="font-size: 13px; line-height: 237%">Congratulation you are dedicated to be Tour Leader - Panorama JTB Tours Indonesia.</p>
                        <p style="font-size: 13px; line-height: 237%">Please always update your profile at :</p>
                        <table style="font-size: 13px; font-family: verdana; color: #333333; width: 600px;" border="0" cellspacing="1" cellpadding="4" align="center" bgcolor="#FFFFFF">
                            <tr><td style="background-color: #eee;">url site </td><td style="background-color: #eee; font-weight: bold;">'.$site.'</td></tr>
                            <tr><td style="background-color: #eee;">user name</td>    <td style="background-color: #eee;">' . $usercode . '</td></tr>
                            <tr><td style="background-color: #eee;">password</td>    <td style="background-color: #eee;">' . $pswd . '</td></tr>
                            <tr><td style="background-color: #eee;">status</td>    <td style="background-color: #eee;"><strong>APPROVED</strong></td></tr>
                        </table>
                  <p style="font-size: 13px; line-height: 237%">Regards</p>
                  <p style="font-size: 13px; line-height: 237%">Panorama JTB Tours Indonesia</p>
                  <p style="font-size: 13px; line-height: 237%">--------------------------------------------------------------------------------</p>
                  </td>
                </tr>
              </tbody>
            </table>
            <p><small>IMPORTANT INFO :</small></p>
            <p style="font-size: 10px;">* This email is sent automatically via Panorama Integrated system and does not require a reply.
            <br>* E-mail transmission cannot be guaranteed to be secured or error-free as information could be corrupted,lost,arrive late or incomplete, or contain viruses.
            <br>* The sender shall not be held responsible for any errors or omissions in the contents of this message, which arise as a result of e-mail transmission.
            <br>* If you can not login, please call our support team on 021-25565555 ext 7000 directly from your mobile phone.
            <br>* We really appreciate your feedback and suggestions to improve the quality of our products and services.
            <br>* For your advice, please contact our support on 021-25565555 ext 7000 directly from your mobile phone or email system.developer@panorama-jtb.com.</p>
            </body>';
        $message .= "</HTML>" . "\n";
        $message .= "\n";
        $headers = "MIME-Version: 1.0 \n";
        $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
        $headers .= "From: Panorama JTB Tours <noreply@panoramawebsys.com> \n";
        $headers .= "Reply-To: noreply@panoramawebsys.com \r\n";
        $headers .= "Return-Path: noreply@panoramawebsys.com\r\n";
        $headers .= "Bcc: ferry_budiono@panorama-tours.com\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        mail($useremail, "Tour Leader Status", $message, $headers);
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mstourleader'>";
        break;

    case "tolaktl":
        $edit = mssql_query("UPDATE [HRM].[dbo].[Employee] set StatusTL = '$_GET[status]',
                                                RejectReason='$_GET[reason]'
                                                WHERE EmployeeID = '$_GET[id]'");

        $Description = "REJECT/BLACKLIST TL ($_GET[id])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                           Description,
                           LogTime)
                    VALUES ('$EmpName',
                           '$Description',
                           '$today')");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mstourleader'>";
        break;

    case "updateAll":
        $fullname = strtoupper($_POST['fullname']);
        $nickname = strtoupper($_POST['nickname']);
        $NameAsPassport = strtoupper($_POST['NameAsPassport']);
        $freelance = strtoupper($_POST['freelance']);
        $religion = strtoupper($_POST['religion']);
        $education = strtoupper($_POST['education']);
        $sma = strtoupper($_POST['sma']);
        $university = strtoupper($_POST['university']);
        $language = strtoupper($_POST['language']);
        $work = strtoupper($_POST['work']);
        $placebirth = strtoupper($_POST['placebirth']);
        $address = strtoupper($_POST['address']);
        $hobi = strtoupper($_POST['hobi']);
        $remark = strtoupper($_POST['remark']);

        if ($_POST['dateofbirth'] == "" or $_POST['dateofbirth'] == '' or empty($_POST['dateofbirth'])) {
            $dateofbirth = date("yyyy-mm-dd", strtotime('0000-00-00'));
        } else {
            $dateofbirth = date("yyyy-mm-dd", strtotime($_POST['dateofbirth']));
        }

        if ($_POST['PassportIssuedDate'] == "" or $_POST['PassportIssuedDate'] == '' or empty($_POST['PassportIssuedDate'])) {
            $PassportIssuedDate = date("yyyy-mm-dd", strtotime('0000-00-00'));
        } else {
            $PassportIssuedDate = date("yyyy-mm-dd", strtotime($_POST['PassportIssuedDate']));
        }

        if ($_POST['PassportValid'] == "" or $_POST['PassportValid'] == '' or empty($_POST['PassportValid'])) {
            $PassportValid = date("yyyy-mm-dd", strtotime('0000-00-00'));
        } else {
            $PassportValid = date("yyyy-mm-dd", strtotime($_POST['PassportValid']));
        }

        //data akan di hapus semua base on TourleaderID
        /*
        lakukan perubahan untuk mengambil satu-persatu ID dari data arrat disempen kedalem variable
        variabel digunakan untuk DELETE dan INSERT
        */
        $GetID = mssql_query("SELECT EmployeeID, FreelanceID, RuteID, VisaID, EducationID, InformalEduID, LanguageID, WorkID, SpecialEventID
                    FROM [HRM].[dbo].[Employee] WHERE EmployeeID = '$_POST[idTourleader]'");
        $row = mssql_fetch_array($GetID);

        include "generateID.php";    //get ID setiap array yang akan di deklarasi

        if ($row[FreelanceID] == '') {
            $FreelanceID = $newIDFreelance;
        } else {
            $FreelanceID = $row[FreelanceID];
        }
        if ($row[RuteID] == '') {
            $RuteID = $newIDRute;
        } else {
            $RuteID = $row[RuteID];
        }
        if ($row[VisaID] == '') {
            $VisaID = $newIDVisa;
        } else {
            $VisaID = $row[VisaID];
        }
        if ($row[EducationID] == '') {
            $EducationID = $newIDEdu;
        } else {
            $EducationID = $row[EducationID];
        }
        if ($row[InformalEduID] == '') {
            $InformalEduID = $newIDInforEdu;
        } else {
            $InformalEduID = $row[InformalEduID];
        }
        if ($row[LanguageID] == '') {
            $LanguageID = $newIDLang;
        } else {
            $LanguageID = $row[LanguageID];
        }
        if ($row[WorkID] == '') {
            $WorkID = $newIDWork;
        } else {
            $WorkID = $row[WorkID];
        }
        if ($row[SpecialEventID] == '') {
            $SpecialEventID = $newIDEvent;
        } else {
            $SpecialEventID = $row[SpecialEventID];
        }

        mssql_query("DELETE FROM [HRM].[dbo].[TourLeaderFreelance] WHERE FreelanceID = '$FreelanceID'");
        mssql_query("DELETE FROM [HRM].[dbo].[TourLeaderRute] WHERE RuteID = '$RuteID'");
        mssql_query("DELETE FROM [HRM].[dbo].[TourLeaderVisa] WHERE VisaID = '$VisaID'");
        mssql_query("DELETE FROM [HRM].[dbo].[TourLeaderEducation] WHERE EducationID = '$EducationID'");
        mssql_query("DELETE FROM [HRM].[dbo].[TourLeaderInformalEdu] WHERE InformalEduID = '$InformalEduID'");
        mssql_query("DELETE FROM [HRM].[dbo].[TourLeaderLanguage] WHERE LanguageID = '$LanguageID'");
        mssql_query("DELETE FROM [HRM].[dbo].[TourLeaderWork] WHERE WorkID = '$WorkID'");
        mssql_query("DELETE FROM [HRM].[dbo].[TourLeaderSpecialEvent] WHERE SpecialEventID = '$SpecialEventID'");

        $freelenceName = $_POST['FreelanceName'];
        if ($freelenceName[0] != "") {
            $itung = count($freelenceName);
            for ($it = 0; $it < $itung; $it++) {
                $freein1 = strtoupper($_POST['FreelanceName'][$it]);
                $freein2 = $_POST['GroupCountry'][$it];
                $freein3 = $_POST['TotalPax'][$it];
                $freein4 = $_POST['YearFreelance'][$it];
                $freein5 = strtoupper($_POST['Agent'][$it]);
                mssql_query("INSERT INTO [HRM].[dbo].[TourLeaderFreelance] (FreelanceID, FreelanceName, GroupCountry, TotalPax, FreelanceYear, Agent)
                                     VALUES	('$FreelanceID','$freein1','$freein2','$freein3','$freein4','$freein5')");
            }
        }

        $country = $_POST['CountryName'];
        if ($country[0] != "") {
            $bnyk3 = count($country);
            for ($u = 0; $u < $bnyk3; $u++) {
                $countryName = $_POST['CountryName'][$u];
                $RuteDate = $_POST['RuteDate'][$u];
                if ($RuteDate == "" or $RuteDate == '' or empty($RuteDate)) {
                    $convDate = date("yyyy-mm-dd", strtotime('0000-00-00'));
                } else {
                    $convDate = date("yyyy-mm-dd", strtotime($RuteDate));
                }
                mssql_query("INSERT INTO [HRM].[dbo].[TourLeaderRute] (RuteID, RuteName, RuteYear) VALUES('$RuteID','$countryName','$RuteDate')");
            }
        }

        $visa = $_POST['VisaName'];
        if ($visa[0] != "") {
            $bnyk4 = count($visa);
            for ($e = 0; $e < $bnyk4; $e++) {
                $visaName = $_POST['VisaName'][$e];
                $validitydate = $_POST['ValidityDate'][$e];
                if ($validitydate == "" or $validitydate == '' or empty($validitydate)) {
                    $convDate2 = date("yyyy-mm-dd", strtotime('0000-00-00'));
                } else {
                    $convDate2 = date("yyyy-mm-dd", strtotime($validitydate));
                }
                mssql_query("INSERT INTO [HRM].[dbo].[TourLeaderVisa] (VisaID, VisaName, VisaDate) VALUES('$VisaID','$visaName','$convDate2')");
            }
        }

        $SchoolName = $_POST['SchoolName'];
        if ($SchoolName[0] != "") {
            $Education = $_POST[EduLevel];
            $bnyk5 = count($Education);
            for ($educate = 0; $educate < $bnyk5; $educate++) {
                $edu1 = $_POST['EduLevel'][$educate];
                $edu2 = strtoupper($_POST['SchoolName'][$educate]);
                $edu3 = strtoupper($_POST['Location'][$educate]);
                $edu4 = $_POST['YearEducataion'][$educate];
                $edu5 = $_POST['GPA'][$educate];
                $edu6 = strtoupper($_POST['Major'][$educate]);
                mssql_query("INSERT INTO [HRM].[dbo].[TourLeaderEducation] (EducationID, EducationalLevel, SchoolName, Location, Year, GPA, Major)
                                         VALUES ('$EducationID','$edu1','$edu2','$edu3','$edu4','$edu5','$edu6')");
            }
        }

        $CourseName = $_POST['CourseName'];
        if ($CourseName[0] != "") {
            $InformalEdu = $_POST[CourseName];
            $bnyk6 = count($InformalEdu);
            for ($InfEdu = 0; $InfEdu < $bnyk6; $InfEdu++) {
                $inf1 = strtoupper($_POST['CourseName'][$InfEdu]);
                $inf2 = strtoupper($_POST['Organizer'][$InfEdu]);
                $inf3 = $_POST['CoursePeriod'][$InfEdu];
                $inf4 = strtoupper($_POST['Certified'][$InfEdu]);
                mssql_query("INSERT INTO [HRM].[dbo].[TourLeaderInformalEdu] (InformalEduID, CourseName, Organizer, CoursePeriod, Certified)
                                           VALUES ('$InformalEduID','$inf1','$inf2','$inf3','$inf4')");
            }
        }

        $Language = $_POST[Language];
        if ($Language[0] != "") {
            $bnyk7 = count($Language);
            for ($Langu = 0; $Langu < $bnyk7; $Langu++) {
                $lang1 = strtoupper($_POST['Language'][$Langu]);
                $lang2 = strtoupper($_POST['Reading'][$Langu]);
                $lang3 = strtoupper($_POST['Writing'][$Langu]);
                $lang4 = strtoupper($_POST['Communication'][$Langu]);
                mssql_query("INSERT INTO [HRM].[dbo].[TourLeaderLanguage] (LanguageID, LanguageName, Reading, Writing, Communication)
                                        VALUES ('$LanguageID','$lang1','$lang2','$lang3','$lang4')");
            }
        }

        $work = $_POST[CompanyName];
        if ($work[0] != "") {
            $bnyk = count($work);
            for ($a = 0; $a < $bnyk; $a++) {
                $var1 = strtoupper($_POST['CompanyName'][$a]);
                $var2 = $_POST['PhoneNo'][$a];
                $var3 = strtoupper($_POST['BusinessType'][$a]);
                $var4 = strtoupper($_POST['Position'][$a]);
                $var5 = $_POST['DateFrom'][$a];
                $var6 = $_POST['DateTo'][$a];
                $var7 = strtoupper($_POST['Reason'][$a]);
                mssql_query("INSERT INTO [HRM].[dbo].[TourLeaderWork] (WorkID, CompanyName, PhoneNo, BusinessType, Position, DateFrom, DateTo, Reason)
                                    VALUES ('$WorkID','$var1','$var2','$var3','$var4','$var5','$var6','$var7')");
            }
        }

        $SpecialEvent = $_POST[SpecialEvent];
        if ($SpecialEvent[0] != "") {
            $bnyk8 = count($SpecialEvent);
            for ($event = 0; $event < $bnyk8; $event++) {
                $Special1 = strtoupper($_POST['SpecialEvent'][$event]);
                mssql_query("INSERT INTO [HRM].[dbo].[TourLeaderSpecialEvent] (SpecialEventID, SpecialEventName) VALUES('$SpecialEventID','$Special1')");
            }
        }

        if ($freelenceName[0] == "") {
            $FreelanceID = '';
        }
        if ($country[0] == "") {
            $RuteID = '';
        }
        if ($visa[0] == "") {
            $VisaID = '';
        }
        if ($SchoolName[0] == "") {
            $EducationID = '';
        }
        if ($CourseName[0] == "") {
            $InformalEduID = '';
        }
        if ($Language[0] == "") {
            $LanguageID = '';
        }
        if ($work[0] == "") {
            $WorkID = '';
        }
        if ($SpecialEvent[0] == "") {
            $SpecialEventID = '';
        }

        //Cek duplikasi mobile phone
        $sql = mssql_query("SELECT Mobile FROM [HRM].[dbo].[Employee]
                  WHERE Mobile='$_POST[mobilephone]' AND Mobile !='' AND EmployeeID != '$_POST[idTourleader]' AND Active = '1'");
        $ketemu = mssql_num_rows($sql);
        if ($_POST[mobilephone] == '') {
            echo "<script>alert('Mobile Phone Can not be empty'); window.location = '../../media.php?module=profile&act=editprofile&employee_code=$_SESSION[employee_code]'</script>";
            exit(0);
        } elseif ($ketemu > 0) {
            echo "<script> alert('Duplicated Mobile Phone');window.location='../../media.php?module=profile&act=editprofile&employee_code=$_SESSION[employee_code]'</script>\n";
            exit(0);
        }

        //cek adanya tourleader yg telah terdaftar dg beberapa indikasi
        $sqlIdentity = mssql_query("SELECT EmployeeName, BirthPlace, BirthDate FROM [HRM].[dbo].[Employee]
                          WHERE EmployeeName='$fullname' AND BirthPlace='$placebirth' AND BirthDate='$dateofbirth' AND
                                EmployeeID != '$_POST[idTourleader]' AND Active = '1' ");
        $founded = mssql_num_rows($sqlIdentity);
        if ($founded > 0) {
            echo "<script> alert('$fullname, You have same identity with other tour leader');window.location='../../media.php?module=history&act=edithistory&employee_code=$_SESSION[employee_code]'</script>\n";
            exit(0);
        }
        //Logging Directory
        $desc = "UPDATE Tour Leader Data From Internal Site";
        mysql_query("INSERT INTO tl_log (EmployeeName, Description, LogTime) VALUES ('$_SESSION[namalengkap]','$desc', '$DateTime_now')");

        mysql_query("UPDATE [HRM].[dbo].[Employee] SET  NickName			= '$nickname',
                                        Title			    = '$_POST[call]',
                                        NameAsPassport		= '$NameAsPassport',
                                        Email		        = '$_POST[email]',
                                        Gender				= '$_POST[sex]',
                                        Height				= '$_POST[height]',
                                        Weight				= '$_POST[weight]',
                                        Nationality			= '$_POST[Nationality]',
                                        Mobile				= '$_POST[mobilephone]',
                                        Phone				= '$_POST[phone]',
                                        Address				= '$address',
                                        Religion			= '$religion',
                                        BBpin				= '$_POST[bbm]',
                                        Hobbies				= '$hobi',
                                        Remarks				= '$remark',
                                        BirthPlace			= '$placebirth',
                                        BirthDate  			= '$dateofbirth',
                                        PassportNo			= '$_POST[PassportNo]',
                                        PassportIssued		= '$_POST[PassportIssued]',
                                        PassportIssuedDate	= '$PassportIssuedDate',
                                        PassportValid		= '$PassportValid',
                                        WorkID				= '$WorkID',
                                        FreelanceID			= '$FreelanceID',
                                        RuteID				= '$RuteID',
                                        VisaID				= '$VisaID',
                                        EducationID			= '$EducationID',
                                        InformalEduID		= '$InformalEduID',
                                        LanguageID			= '$LanguageID',
                                        SpecialEventID		= '$SpecialEventID',
                                        StatusTL		    = '$_POST[reqtl]'
                                  WHERE EmployeeID 		= '$_POST[idTourleader]'");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=profile'>";
        break;
}
?>
