<?php
date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari = date("w");
$hari_ini = $seminggu[$hari];

$DateTime_now = date("Y-m-d H:i:s");
$tgl_sekarang = date("Ymd");
$tgl_skrg     = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");
$nextmont	= date("Y-m-d",strtotime("+5 years"));

$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                    "Juni", "Juli", "Agustus", "September", 
                    "Oktober", "November", "Desember");
					


function get_months($startstring, $endstring)
{
	$time1  = strtotime($startstring);//absolute date comparison needs to be done here, because PHP doesn't do date comparisons
	$time2  = strtotime($endstring);
	$my1     = date('mY', $time1); //need these to compare dates at 'month' granularity
	$my2    = date('mY', $time2);
	$year1 = date('Y', $time1);
	$year2 = date('Y', $time2);
	$years = range($year1, $year2);
	 
	foreach($years as $year)
	{
	$months[$year] = array();
	while($time1 < $time2)
	{
		if(date('Y',$time1) == $year)
		{
			$months[$year][] = date('m', $time1);
			$time1 = strtotime(date('Y-m-d', $time1).' +1 month');
		}
		else
		{
			break;
		}
	}
	continue;
}
 
return $months;
}

?>
