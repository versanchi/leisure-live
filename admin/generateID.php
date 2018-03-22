<?php
    $TL = mysql_query("SELECT employee_code as maxID FROM tbl_msemployee
					   WHERE substring(employee_code,1,3)='FL-'
					   ORDER BY employee_id DESC LIMIT 1");
    $r    = mysql_fetch_array($TL);
	$idMax = $r['maxID'];
	$noUrut = (int) substr($idMax, 4, 6);
	$noUrut++;
	$jenis = "FL-";
	$newID = $jenis . sprintf("%06s", $noUrut);
	
	//Generate ID untuk Auto Increment WORK
    $Work = mysql_query("SELECT max(WorkID) as maxID FROM tl_mswork");
    $row1    = mysql_fetch_array($Work);
	$idMaxWork = $row1['maxID'];
	$noUrutWork = (int) substr($idMaxWork, 4, 5);
	$noUrutWork++;
	$jenisWork = "WRK";
	$newIDWork = $jenisWork . sprintf("%05s", $noUrutWork);
	
	//Generate ID untuk Auto Increment FREELANCE
    $Freelance = mysql_query("SELECT max(FreelanceID) as maxID FROM tl_msfreelance");
    $row2    = mysql_fetch_array($Freelance);
	$idMaxFreelance = $row2['maxID'];
	$noUrutFreelance = (int) substr($idMaxFreelance, 4, 5);
	$noUrutFreelance++;
	$jenisFreelance = "FRL";
	$newIDFreelance = $jenisFreelance . sprintf("%05s", $noUrutFreelance);
	
	//Generate ID untuk Auto Increment RUTE
    $Rute = mysql_query("SELECT max(RuteID) as maxID FROM tl_msrute");
    $row3 = mysql_fetch_array($Rute);
	$idMaxRute = $row3['maxID'];
	$noUrutRute = (int) substr($idMaxRute, 4, 5);
	$noUrutRute++;
	$jenisRute = "RUT";
	$newIDRute = $jenisRute . sprintf("%05s", $noUrutRute);
	
	//Generate ID untuk Auto Increment VISA
    $Visa = mysql_query("SELECT max(VisaID) as maxID FROM tl_msvisa");
    $row4 = mysql_fetch_array($Visa);
	$idMaxVisa = $row4['maxID'];
	$noUrutVisa = (int) substr($idMaxVisa, 4, 5);
	$noUrutVisa++;
	$jenisVisa = "VSA";
	$newIDVisa = $jenisVisa . sprintf("%05s", $noUrutVisa);
	
	//Generate ID untuk Auto Increment Educational Background
    $Education = mysql_query("SELECT max(EducationID) as maxID FROM tl_mseducation");
    $row5    = mysql_fetch_array($Education);
	$idMaxEdu = $row5['maxID'];
	$noUrutEdu = (int) substr($idMaxEdu, 4, 5);
	$noUrutEdu++;
	$jenisEdu = "EDU";
	$newIDEdu = $jenisEdu . sprintf("%05s", $noUrutEdu);
	
	//Generate ID untuk Auto Increment Informal Education
    $InformalEdu = mysql_query("SELECT max(InformalEduID) as maxID FROM tl_msInformalEdu");
    $row6    = mysql_fetch_array($InformalEdu);
	$idMaxInforEdu = $row6['maxID'];
	$noUrutInforEdu = (int) substr($idMaxInforEdu, 4, 5);
	$noUrutInforEdu++;
	$jenisInforEdu = "IDU";
	$newIDInforEdu = $jenisInforEdu . sprintf("%05s", $noUrutInforEdu);
	
	//Generate ID untuk Auto Increment Language
    $Language = mysql_query("SELECT max(LanguageID) as maxID FROM tl_msLanguage");
    $row7    = mysql_fetch_array($Language);
	$idMaxLang = $row7['maxID'];
	$noUrutLang = (int) substr($idMaxLang, 4, 5);
	$noUrutLang++;
	$jenisLang = "LAG";
	$newIDLang = $jenisLang . sprintf("%05s", $noUrutLang);
	
	//Generate ID untuk Auto Increment Special Event Handling
    $SpecialEvent = mysql_query("SELECT max(SpecialEventID) as maxID FROM tl_specialevent");
    $row8    = mysql_fetch_array($SpecialEvent);
	$idMaxEvent = $row8['maxID'];
	$noUrutEvent = (int) substr($idMaxEvent, 4, 5);
	$noUrutEvent++;
	$jenisEvent = "SPE";
	$newIDEvent = $jenisEvent . sprintf("%05s", $noUrutEvent);
?>