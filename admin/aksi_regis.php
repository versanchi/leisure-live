<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/koneksimaster.php";
include "../config/library.php";
$module=$_GET[module];
$act=$_GET[act];

if ($module=='questioner' AND $act=='input'){  
  if($_POST[totalAvg2] <= 0){
	echo "<script>alert('Choose one of Questioner'); window.location = 'media.php?module=questioner&act=tambahquestioner&id=$_POST[TourLeaderCode]'</script>";
	exit(0);
}

  $NamaPerusahaan = strtoupper($_POST[NamaPerusahaan]);
  $alamatPerusahaan = strtoupper($_POST[alamatPerusahaan]);
  $petugasDihubungi = strtoupper($_POST[petugasDihubungi]);
  $jabatan = strtoupper($_POST[jabatan]);
  
  if (!empty($_POST['isKnowing'])){
    $radioisKnowing = $_POST['isKnowing'];
    $isKnowing=implode(', ',$radioisKnowing);
  }
  if (!empty($_POST['isEffective'])){
    $radioisEffective = $_POST['isEffective'];
    $isEffective=implode(', ',$radioisEffective);
  }
  if (!empty($_POST['isSuperior'])){
    $radioisSuperior = $_POST['isSuperior'];
    $isSuperior=implode(', ',$radioisSuperior);
  }
  $tgl_sekarang= date("Y-m-d G:i:s");
  $result = mysql_query("SELECT PaxName FROM tour_msbookingdetail WHERE IDDetail = '$_POST[NamaLengkap]'");
  $row = mysql_fetch_array($result);
  $PaxName = $row[PaxName];
  
/*  //check duplicated mobile phone
  $sql="SELECT Nama FROM tbl_trquestion WHERE Nama='$_POST[NamaLengkap]'";
  $result=mysql_query($sql);
  $count=mysql_num_rows($result);
  if ($count > 0){
	echo "<script>alert('Anda sudah pernah mengisi Questioner'); window.location = 'media.php?module=questioner'</script>";
	exit(0);
  } 
  else{
*/

	//Generate ID untuk Auto Increment
    $edit = mysql_query("SELECT QuestionID as maxID FROM tbl_trquestion ORDER BY idQues DESC LIMIT 1");
    $r    = mysql_fetch_array($edit);
	$idMax = $r['maxID'];
	$noUrut = (int) substr($idMax, 4, 5);
	$noUrut++;
	$jenis = "QST";
	$newID = $jenis . sprintf("%05s", $noUrut);
	
	//Karena IDTourLeader = employee_id
	$getEmp	= mssql_query("SELECT EmployeeName FROM Employee WHERE EmployeeID='$_POST[IDTourLeader]'");
	$ge		= mssql_fetch_array($getEmp);
	
   mysql_query("INSERT INTO tbl_trquestion (QuestionID,
											IDTourcode,
											IDTourleader,
											EmployeeID,
											TourCode,
											Year,
											TourLeader,
											isProduct,
											isFavorite,
											isKnowing,
											isEffective,
											isSuperior,
											extAcara,
											extPenerbangan,
											extTransportasi,
											extWisata,
											extAkomodasi,
											extSajian,
											extBelanja,
											extPemandu,
											extTLpanorama,
											AirlineName,
											extKesan,
											inOperator,
											inTourConsultant,
											inKasir,
											inDocument,
											inAirport,
											inPerjalanan,
											inInformasi,
											inSuasana,
											inAcara,
											inMasalah,
											inKesan,
											isNikmat,
											isMinat,											
											isLiburSekolah,
											liburSekolah,
											isLiburLebaran,
											liburLebaran,
											isLiburNatal,
											liburNatal,											
											IDDetail,
											Nama,
											teleponPribadi,
											faxPribadi,
											emailPribadi,
											isPerusahaan,
											perusahaan,
											alamatPerusahaan,
											tlpPerusahaan,
											faxPerusahaan,
											emailPerusahaan,
											dihubungi,
											jabatan,
											UserCreate,
											DateCreate )
									VALUES( '$newID',
											'$_POST[IDTourcode]',
											'$_POST[IDTourLeader]',
											'$ge[EmployeeID]',
											'$_POST[TourLeaderCode]',
											'$_POST[Year]',
											'$ge[EmployeeName]',
											'$_POST[isProduct]',
											'$_POST[isFavorite]',
											'$isKnowing',
											'$isEffective',
											'$isSuperior',
											'$_POST[acara]',
											'$_POST[terbang]',
											'$_POST[trans]',
											'$_POST[wisata]',
											'$_POST[hotel]',
											'$_POST[makan]',
											'$_POST[belanja]',
											'$_POST[pemandu]',
											'$_POST[tl]',
											'$_POST[AirlineName]',
											'$_POST[extKesan]',
											'$_POST[petugas]',
											'$_POST[consultant]',
											'$_POST[kasir]',
											'$_POST[doc]',
											'$_POST[airport]',
											'$_POST[perjalanan]',
											'$_POST[info]',
											'$_POST[hidup]',
											'$_POST[aturacara]',
											'$_POST[masalah]',
											'$_POST[inKesan]',
											'$_POST[isNikmat]',
											'$_POST[isMinat]',
											'$_POST[isLiburSekolah]',
											'$_POST[libursekolah]',
											'$_POST[isLiburLebaran]',
											'$_POST[liburlebaran]',
											'$_POST[isLiburNatal]',
											'$_POST[liburannatal]',
											'$_POST[NamaLengkap]',
											'$PaxName',
											'$_POST[tlpPribadi]',
											'$_POST[faxPribadi]',
											'$_POST[emailPribadi]',
											'$_POST[isPerusahaan]',
											'$NamaPerusahaan',
											'$alamatPerusahaan',
											'$_POST[tlpPerusahaan]',
											'$_POST[faxPerusahaan]',
											'$_POST[emailPerusahaan]',
											'$petugasDihubungi',
											'$jabatan',
											'$_SESSION[employee_name]',
											'$tgl_sekarang')");
  echo "<script>alert('Data Anda Telah tersimpan'); window.location = 'media.php?module=questioner'</script>";
//  }
 }
if ($module=='questioner' AND $act=='void'){  
	mysql_query("UPDATE tbl_trquestion SET 	Status 		= 'VOID',
											UserUpdate	= '$_SESSION[employee_name]',
											DateUpdate	= '$tgl_sekarang'
									WHERE 	QuestionID 	= '$_GET[id]'");
	header("location:media.php?module=questioner");
}
?>
