<?php
/** Error reporting */
error_reporting(E_ALL);
	 
/** Include path **/
ini_set('include_path', ini_get('include_path').';../Classes/');

 

include "../config/koneksi.php";
include "../config/koneksimaster.php";
include "Classes/PHPExcel.php";
include "Classes/PHPExcel/IOFactory.php";


// Membuat documen excel baru
$objPHPExcel = new PHPExcel();

//$objPHPExcel = new  PHPExcel_Writer_Excel2007($spreadsheet);
$objPHPExcel->setActiveSheetIndex(0);

// Set Properti Documen excel yang akan dibuat
$objPHPExcel->getProperties()->setCreator("ISD Division")
                             ->setLastModifiedBy("ISD Division")
                             ->setTitle("Office 2007 XLSX Test Document")
                             ->setSubject("Office 2007 XLSX Test Document")
                             ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                             ->setKeywords("office 2007 openxml php")
                             ->setCategory("Export Data");

//set width table
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(70);


						 
//set table header
//Tabel akan kita mulai dari Kolom B10 dan seterusnya
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(20) ->setBold(true);
$objPHPExcel->getActiveSheet()->mergeCells('A2:M2');
$objPHPExcel->getActiveSheet()->setCellValue('A2','ITINERARY');


// Menambahkan file gambar pada document excel pada kolom B2
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Panorama Tours');
$objDrawing->setDescription('Logo');
//$objDrawing->setPath(base_url().'images/pano1.jpg');
$objDrawing->setPath('./images/pano1.jpg');
$objDrawing->setCoordinates('A3');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

$IDProduct=$_GET['IDProduct'];

$ambil=mysql_query("SELECT tour_msproduct.IDProduct,tour_msproduct.TourCode,tour_msproduct.Year,TCDivision,tour_msbooking.BookingID,
                    tour_msproductcode.Productcode,tour_msproduct.DateTravelFrom,tour_msproduct.TourLeaderInc,tour_msproduct.TourLeader,
                    tour_msproduct.Flight FROM tour_msproduct
                    left join tour_msbooking on tour_msbooking.IDTourcode = tour_msproduct.IDProduct 
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode     
                    WHERE tour_msproduct.IDProduct ='$IDProduct'
                    AND tour_msbooking.Status = 'ACTIVE'  
                    AND tour_msproduct.Status = 'PUBLISH'");
$isi=mysql_fetch_array($ambil);


		 $roomnow='awal';
         $jumlah=mysql_num_rows($edit);
         $depdet = date("d M Y", strtotime($isi[DateTravelFrom]));
         
         $rum=mysql_query("SELECT sum(AdultPax)as jumlaadult,sum(ChildPax)as jumlachild,sum(InfantPax)as jumlainf FROM tour_msbooking   
                                WHERE IDTourcode = '$isi[IDProduct]'
                                And Status = 'ACTIVE'
                                And BookingStatus = 'DEPOSIT'  
                                group by TourCode ASC");        
         $room=mysql_fetch_array($rum);
         $jumteel=mysql_query("SELECT * FROM tour_msproducttl   
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL' 
                                order by IDPTL ASC");        
         $banyakteel=mysql_num_rows($jumteel);
          if($isi[TourLeaderInc]=='YES'){$tl=$banyakteel;}else{$tl=0;}
         $seluruh=$room[jumlaadult]+$room[jumlachild];// + $tl;

$objPHPExcel->getActiveSheet()->getStyle('A5:A6')->getFont()->setSize(16) ->setBold(true);
$objPHPExcel->getActiveSheet()->mergeCells('A5:F5');
$objPHPExcel->getActiveSheet()->setCellValue('A5','Tour Code : ' .$isi['Productcode'].' - '.$isi['TourCode']);

$objPHPExcel->getActiveSheet()->getStyle('A7:A8')->getFont()->setSize(10) ->setBold(true);
$objPHPExcel->getActiveSheet()->mergeCells('A7:F7');
$objPHPExcel->getActiveSheet()->setCellValue('A7','TOTAL PAX : '.$seluruh.' + '.$tl.' TL');

if($isi[TourLeaderInc]=='YES'){

    $cariteel=mysql_query("SELECT * FROM tour_msproducttl
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL'
                                order by IDPTL ASC");
    $hasilteel=mysql_num_rows($cariteel);
    if($hasilteel>0)
    {
        while($tlnya=mysql_fetch_array($cariteel)){
            $QCariNamaTL=mssql_query("SELECT * FROM Employee
										where EmployeeID = '$tlnya[EmployeeID]'
										order by EmployeeName ASC");
            $DCariNamaTL=mssql_fetch_array($QCariNamaTL);

            if($TLName=='')
            {$TLName="$DCariNamaTL[NameAsPassport] - $DCariNamaTL[Mobile]";}else{$TLName=$TLName.' , '.$DCariNamaTL[NameAsPassport].' - '.$DCariNamaTL[Mobile];}
        }
    }else
    {$TLName='';}
}

$objPHPExcel->getActiveSheet()->mergeCells('A8:F8');
$objPHPExcel->getActiveSheet()->setCellValue('A8','TOURLEADER : '.$TLName);
$StartNo=10;
$objPHPExcel->getActiveSheet()->getStyle('A'.$StartNo.':B'.$StartNo)->getFont()->setSize(10) ->setBold(true)->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$objPHPExcel->getActiveSheet()->getStyle('A'.$StartNo.':B'.$StartNo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A'.$StartNo.':B'.$StartNo)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FE7008');


$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THICK
    )
  )
);

$objPHPExcel->getActiveSheet()->getStyle('A'.$StartNo.':B'.$StartNo)->applyFromArray($styleArray);
unset($styleArray);

$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->setCellValue('A'.$StartNo,'DD.MM.YY');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$StartNo,'CITY');

//isi data
$Awal=$StartNo;

				    $StartNo++;

                    $lastbooking='awal';
                    $tblitin=mysql_query("SELECT *,CONVERT(Days, UNSIGNED INTEGER) as urut FROM tour_msitin
                                                    WHERE ProductID ='$isi[IDProduct]' and Language = 'INDONESIA' and Style = 'LTM' order by urut");
                    $dateday = $isi[DateTravelFrom];
                    $tanggalday = substr($dateday,8,2);
                    $bulanday = substr($dateday,5,2);
                    $tahunday = substr($dateday,0,4);
                    $day=0;
                    while ($itin=mysql_fetch_array($tblitin)){
                    if($day==0){
                        $oneday= strtoupper(date('d M Y',strtotime('0 second',strtotime($day.' day',strtotime(date($bulanday).'/'.date($tanggalday).'/'.date($tahunday).' 00:00:00')))));
			  			$objPHPExcel->getActiveSheet()->setCellValue('A'.$StartNo,$oneday);
                        $objPHPExcel->getActiveSheet()->setCellValue('B'.$StartNo,$itin['Route']);
                    }else{
                        $oneday= strtoupper(date('d M Y',strtotime('0 second',strtotime($day.' day',strtotime(date($bulanday).'/'.date($tanggalday).'/'.date($tahunday).' 00:00:00')))));
                        $objPHPExcel->getActiveSheet()->setCellValue('A'.$StartNo,$oneday);
                        $objPHPExcel->getActiveSheet()->setCellValue('B'.$StartNo,$itin['Route']);
                    }
					  $no++;
					  $StartNo++;
                      $day++;			        }

$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);
$Akhir=$StartNo-1;
$objPHPExcel->getActiveSheet()->getStyle('A'.$Awal.':B'.$Akhir)->applyFromArray($styleArray);
unset($styleArray);
			
$xlsname=trim($isi[TourCode]);	


// Save Excel 2007 file 
$filename="$xlsname.xls"; //just some random filename
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'"'); 
header('Cache-Control: max-age=0');



$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save("php://output"); 


exit(); 

?> 

