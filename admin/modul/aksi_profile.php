<?php
session_start();

include "../config/koneksi.php";
include "../config/fungsi_thumb.php";
include "../config/library.php";

$module	= $_GET['module'];
$act	= $_GET['act'];

if ($module=='profile' AND $act=='updateAll'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file;

  $fullname			= strtoupper($_POST['fullname']);
  $nickname			= strtoupper($_POST['nickname']);
  $NameAsPassport	= strtoupper($_POST['NameAsPassport']);
  $freelance		= strtoupper($_POST['freelance']);
  $religion			= strtoupper($_POST['religion']);
  $education		= strtoupper($_POST['education']);
  $sma				= strtoupper($_POST['sma']);
  $university		= strtoupper($_POST['university']);
  $language			= strtoupper($_POST['language']);
  $work				= strtoupper($_POST['work']);
  $placebirth		= strtoupper($_POST['placebirth']);
  $address			= strtoupper($_POST['address']);
  $hobi				= strtoupper($_POST['hobi']);
  $remark			= strtoupper($_POST['remark']);
  
  if($_POST['dateofbirth']=="" or $_POST['dateofbirth']=='' or empty($_POST['dateofbirth']))
	{ $dateofbirth = '0000-00-00'; }
	else { $dateofbirth = date("Ymd", strtotime($_POST['dateofbirth'])); }
	
  if($_POST['PassportIssuedDate']=="" or $_POST['PassportIssuedDate']=='' or empty($_POST['PassportIssuedDate']))
	{ $PassportIssuedDate = '0000-00-00'; }
	else { $PassportIssuedDate = date("Ymd", strtotime($_POST['PassportIssuedDate'])); }
	
  if($_POST['PassportValid']=="" or $_POST['PassportValid']=='' or empty($_POST['PassportValid']))
	{ $PassportValid = '0000-00-00'; }
	else { $PassportValid = date("Ymd", strtotime($_POST['PassportValid'])); }
	
  //data akan di hapus semua base on TourleaderID
  /*
  	lakukan perubahan untuk mengambil satu-persatu ID dari data arrat disempen kedalem variable
	variabel digunakan untuk DELETE dan INSERT
  */
  $GetID = mysql_query("SELECT employee_code, FreelanceID, RuteID, VisaID, EducationID, InformalEduID, LanguageID, WorkID, SpecialEventID
  			  			FROM tbl_msemployee WHERE employee_code = '$_SESSION[employee_code]'");
  $row   = mysql_fetch_array($GetID);
  
  include "../admin/generateID.php";	//get ID setiap array yang akan di deklarasi
  
  if($row[FreelanceID]==''){ $FreelanceID = $newIDFreelance; }else{ $FreelanceID = $row[FreelanceID]; }
  if($row[RuteID]==''){ $RuteID = $newIDRute; }else{ $RuteID = $row[RuteID]; }
  if($row[VisaID]==''){ $VisaID = $newIDVisa; }else{ $VisaID = $row[VisaID]; }
  if($row[EducationID]==''){ $EducationID = $newIDEdu; }else{ $EducationID = $row[EducationID]; }
  if($row[InformalEduID]==''){ $InformalEduID = $newIDInforEdu; }else{ $InformalEduID = $row[InformalEduID]; }
  if($row[LanguageID]==''){ $LanguageID = $newIDLang; }else{ $LanguageID = $row[LanguageID]; }
  if($row[WorkID]==''){ $WorkID = $newIDWork; }else{ $WorkID = $row[WorkID]; }
  if($row[SpecialEventID]==''){ $SpecialEventID = $newIDEvent; }else{ $SpecialEventID = $row[SpecialEventID]; }  
  
  mysql_query("DELETE FROM tl_msfreelance WHERE FreelanceID = '$FreelanceID'");
  mysql_query("DELETE FROM tl_msrute WHERE RuteID = '$RuteID'");
  mysql_query("DELETE FROM tl_msvisa WHERE VisaID = '$VisaID'");
  mysql_query("DELETE FROM tl_mseducation WHERE EducationID = '$EducationID'");
  mysql_query("DELETE FROM tl_msinformaledu WHERE InformalEduID = '$InformalEduID'");
  mysql_query("DELETE FROM tl_mslanguage WHERE LanguageID = '$LanguageID'");
  mysql_query("DELETE FROM tl_mswork WHERE WorkID = '$WorkID'");
  mysql_query("DELETE FROM tl_specialevent WHERE SpecialEventID = '$SpecialEventID'");
  
  $freelenceName = $_POST['FreelanceName'];
  if ($freelenceName[0] != ""){
	$itung	= count($freelenceName); 
	for ($it = 0; $it < $itung; $it++) {
		$freein1=strtoupper($_POST['FreelanceName'][$it]);
		$freein2=$_POST['GroupCountry'][$it];
		$freein3=$_POST['TotalPax'][$it];
		$freein4=$_POST['YearFreelance'][$it];
		$freein5=strtoupper($_POST['Agent'][$it]);
		mysql_query("INSERT INTO tl_msfreelance (FreelanceID, FreelanceName, GroupCountry, TotalPax, FreelanceYear, Agent)
		 								 VALUES	('$FreelanceID','$freein1','$freein2','$freein3','$freein4','$freein5')");
	}
  }

  $country=$_POST['CountryName'];
  if ($country[0] != ""){
	$bnyk3=count($country); 
	for ($u = 0; $u < $bnyk3; $u++) {
		$countryName= $_POST['CountryName'][$u];
		$RuteDate	= $_POST['RuteDate'][$u];
		if($RuteDate=="" or $RuteDate=='' or empty($RuteDate))
			 { $convDate = '0000-00-00'; }
		else { $convDate = date("Ymd", strtotime($RuteDate)); }
		mysql_query("INSERT INTO tl_msrute (RuteID, RuteName, RuteYear) VALUES('$RuteID','$countryName','$RuteDate')");
	}
  }
		
	$visa	= $_POST['VisaName'];
	if ($visa[0] != ""){
		$bnyk4	= count($visa); 
		for ($e = 0; $e < $bnyk4; $e++) {
			$visaName		= $_POST['VisaName'][$e];
			$validitydate	= $_POST['ValidityDate'][$e];	
			if($validitydate=="" or $validitydate=='' or empty($validitydate)){ $convDate2 = '0000-00-00'; }
			else { $convDate2 = date("Ymd", strtotime($validitydate)); }
			mysql_query("INSERT INTO tl_msvisa (VisaID, VisaName, VisaDate) VALUES('$VisaID','$visaName','$convDate2')");
		}
	}
	
	$SchoolName = $_POST['SchoolName'];
	if($SchoolName[0] != ""){
		$Education=$_POST[EduLevel];
		$bnyk5=count($Education); 
		for ($educate = 0; $educate < $bnyk5; $educate++) {
			$edu1 = $_POST['EduLevel'][$educate];
			$edu2 = strtoupper($_POST['SchoolName'][$educate]);
			$edu3 = strtoupper($_POST['Location'][$educate]);
			$edu4 = $_POST['YearEducataion'][$educate];
			$edu5 = $_POST['GPA'][$educate];
			$edu6 = strtoupper($_POST['Major'][$educate]);
			mysql_query("INSERT INTO tl_mseducation (EducationID, EducationalLevel, SchoolName, Location, Year, GPA, Major) 
									 		 VALUES ('$EducationID','$edu1','$edu2','$edu3','$edu4','$edu5','$edu6')");
		}
	}
	
	$CourseName = $_POST['CourseName'];
	if($CourseName[0] != ""){
		$InformalEdu=$_POST[CourseName];
		$bnyk6=count($InformalEdu);
		for ($InfEdu = 0; $InfEdu < $bnyk6; $InfEdu++) {
			$inf1 = strtoupper($_POST['CourseName'][$InfEdu]);
			$inf2 = strtoupper($_POST['Organizer'][$InfEdu]);
			$inf3 = $_POST['CoursePeriod'][$InfEdu];
			$inf4 = strtoupper($_POST['Certified'][$InfEdu]);
			mysql_query("INSERT INTO tl_msinformaledu (InformalEduID, CourseName, Organizer, CoursePeriod, Certified) 
									 		   VALUES ('$InformalEduID','$inf1','$inf2','$inf3','$inf4')");
		}
	}
	
	$Language = $_POST[Language];
	if($Language[0] != ""){
		$bnyk7=count($Language);
		for ($Langu = 0; $Langu < $bnyk7; $Langu++) {
			$lang1 = strtoupper($_POST['Language'][$Langu]);
			$lang2 = strtoupper($_POST['Reading'][$Langu]);
			$lang3 = strtoupper($_POST['Writing'][$Langu]);
			$lang4 = strtoupper($_POST['Communication'][$Langu]);
			mysql_query("INSERT INTO tl_mslanguage (LanguageID, LanguageName, Reading, Writing, Communication) 
									 		VALUES ('$LanguageID','$lang1','$lang2','$lang3','$lang4')");
		}
	}
	
	$work = $_POST[CompanyName];
	if($work[0] != ""){
		$bnyk=count($work); 
		for ($a = 0; $a < $bnyk; $a++) {
			$var1 = strtoupper($_POST['CompanyName'][$a]);
			$var2 = $_POST['PhoneNo'][$a];
			$var3 = strtoupper($_POST['BusinessType'][$a]);
			$var4 = strtoupper($_POST['Position'][$a]);
			$var5 = $_POST['DateFrom'][$a];
			$var6 = $_POST['DateTo'][$a];
			$var7 = strtoupper($_POST['Reason'][$a]);
			mysql_query("INSERT INTO tl_mswork (WorkID, CompanyName, PhoneNo, BusinessType, Position, DateFrom, DateTo, Reason)
										VALUES ('$WorkID','$var1','$var2','$var3','$var4','$var5','$var6','$var7')");
		}
	}
	
	$SpecialEvent=$_POST[SpecialEvent];
	if($SpecialEvent[0] != ""){
		$bnyk8=count($SpecialEvent);
		for ($event = 0; $event < $bnyk8; $event++) {
			$Special1=strtoupper($_POST['SpecialEvent'][$event]);
			mysql_query("INSERT INTO tl_specialevent (SpecialEventID, SpecialEventName) VALUES('$SpecialEventID','$Special1')");
		}
	}
	
	if($freelenceName[0] == "") { $FreelanceID=''; }
	if($country[0] == "") { $RuteID = ''; }
	if($visa[0] == "") { $VisaID = ''; }
	if($SchoolName[0] == "") { $EducationID = ''; }
	if($CourseName[0] == "") { $InformalEduID = ''; }
	if($Language[0] == "") { $LanguageID = ''; }
	if($work[0] == "") { $WorkID = ''; }
	if($SpecialEvent[0] == "") { $SpecialEventID = ''; }
	
  //Cek duplikasi mobile phone
  $sql = mysql_query("SELECT Mobile FROM tbl_msemployee
  					  WHERE Mobile='$_POST[mobilephone]' AND Mobile !='' AND employee_code != '$_SESSION[employee_code]'");
  $ketemu=mysql_num_rows($sql);
  if($_POST[mobilephone]==''){
	echo "<script>alert('Mobile Phone Can not be empty'); window.location = '../../media.php?module=profile&act=editprofile&employee_code=$_SESSION[employee_code]'</script>";
	exit(0);
  }
  elseif($ketemu > 0){ 
	echo "<script> alert('Duplicated Mobile Phone');window.location='../../media.php?module=profile&act=editprofile&employee_code=$_SESSION[employee_code]'</script>\n";
	exit(0);
  }
  
  //cek adanya tourleader yg telah terdaftar dg beberapa indikasi
  $sqlIdentity = mysql_query("SELECT Name, BirthPlace, BirthDate FROM tl_staff
							  WHERE Name='$fullname' AND BirthPlace='$placebirth' AND BirthDate='$dateofbirth' AND
							  		employee_code != '$_SESSION[employee_code]'");
  $founded=mysql_num_rows($sqlIdentity);	 
  if($founded > 0){
	echo "<script> alert('$fullname, You have same identity with other tour leader');window.location='../../media.php?module=history&act=edithistory&employee_code=$_SESSION[employee_code]'</script>\n";
	exit(0);
  }
  //Logging Directory
  $desc="UPDATE Tour Leader Data From Internal Site";
  mysql_query("INSERT INTO tl_log (EmployeeName, Description, LogTime) VALUES ('$_SESSION[namalengkap]','$desc', '$DateTime_now')");
  
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
	mysql_query("UPDATE tbl_msemployee SET  NickName			= '$nickname',
											UserCall			= '$_POST[call]',
											NameAsPassport		= '$NameAsPassport',
											employee_email		= '$_POST[email]',
											Gender				= '$_POST[sex]',
											Height				= '$_POST[weight]',
											Weight				= '$_POST[height]',
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
											SpecialEventID		= '$SpecialEventID'
									  WHERE employee_code 		= '$_SESSION[employee_code]'");
	 	header('location:../../media.php?module='.$module);
	}
	else {
		if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
		echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
			window.location=('../../media.php?module=history')</script>";
		}
		else{
		/*
		$cp = mysql_fetch_array(mysql_query("SELECT Photo FROM tbl_msemployee WHERE employee_code = '$_SESSION[employee_code]'"));
		if($cp[Photo]!=""){
			unlink('../../foto_user/$cp[Photo]');
			unlink('../../foto_user/small_$cp[Photo]');
		}
		*/
		UploadImage($nama_file_unik);
		mysql_query("UPDATE tbl_msemployee SET  NickName			= '$nickname',
												UserCall			= '$_POST[call]',
												NameAsPassport		= '$NameAsPassport',
												employee_email		= '$_POST[email]',
												Gender				= '$_POST[sex]',
												Height				= '$_POST[weight]',
												Weight				= '$_POST[height]',	
												Nationality			= '$_POST[Nationality]',
												Mobile				= '$_POST[mobilephone]',
												Phone				= '$_POST[phone]',
												Address				= '$address',
												Religion			= '$religion',
												BBpin				= '$_POST[bbm]',
												Hobbies				= '$hobi',
												Photo				= '$nama_file_unik',
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
												SpecialEventID		= '$SpecialEventID'
										  WHERE employee_code 		= '$_SESSION[employee_code]'");
	 	header('location:../../media.php?module='.$module);
	   }
	}
  }

?>
