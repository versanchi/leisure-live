<?php 
function tglindoDDMMMYYYY($thnblntgl) {
	$thn = substr($thnblntgl,0,4);
	$bln = substr($thnblntgl,5,2);
	$tgl = substr($thnblntgl,8,2);
	switch ($bln) {
	case 1:
		$bln="JAN";
		break;
	case 2:
		$bln="FEB";
		break;
	case 3:
		$bln="MAR";
		break;
	case 4:
		$bln="APR";
		break;
	case 5:
		$bln="MEI";
		break;
	case 6:
		$bln="JUN";
		break;
	case 7:
		$bln="JUL";
		break;
	case 8:
		$bln="AGT";
		break;
	case 9:
		$bln="SEP";
		break;
	case 10:
		$bln="OKT";
		break;
	case 11:
		$bln="NOP";
		break;
	case 12:
		$bln="DES";
		break;			
	}
	$DDMMMYYYY = "$tgl-$bln-$thn";
	return $DDMMMYYYY;
}

function terbilang($nilai){
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($nilai < 12) {
    return " " . $abil[$nilai];
  } else if ($nilai < 20) {
    return terbilang($nilai - 10) . "belas";
  } else if ($nilai < 100) {
    return terbilang($nilai / 10) . " puluh" . terbilang($nilai % 10);
  } else if ($nilai < 200) {
    return " seratus" . terbilang($nilai - 100);
  } else if ($nilai < 1000) {
    return terbilang($nilai / 100) . " ratus" . terbilang($nilai % 100);
  } else if ($nilai < 2000) {
    return " seribu" . terbilang($nilai - 1000);
  } else if ($nilai < 1000000) {
    return terbilang($nilai / 1000) . " ribu" . terbilang($nilai % 1000);
  } else if ($nilai < 1000000000) {
    return terbilang($nilai / 1000000) . " juta" . terbilang($nilai % 1000000);
  }
}
?>