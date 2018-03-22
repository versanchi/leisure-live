<?php
/** Error reporting */
error_reporting(E_ALL);
/** Include path **/
ini_set('include_path', ini_get('include_path').';../Classes/');
                                                                    
include "../config/koneksi.php";
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
                             ->setDescription("Upload Pax Name.")
                             ->setKeywords("office 2007 openxml php")
                             ->setCategory("Template PaxName");


                             
//set width table
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(8);                                                     
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);             
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
                                                                
$BookingID=$_GET['BookingID'];

$ambil=mysql_query("SELECT * ,CONVERT(SUBSTRING_INDEX(RoomNo,'-',-1),UNSIGNED INTEGER) AS num FROM tour_msbookingdetail
                    WHERE BookingID ='$BookingID' 
                    AND Status <>'CANCEL'
                    ORDER BY num ASC,IDDetail ASC");
     
                                                                                     
$StartNo=1;
             
$objPHPExcel->getActiveSheet()->setCellValue('A'.$StartNo,'No');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$StartNo,'PaxName');
$objPHPExcel->getActiveSheet()->setCellValue('C'.$StartNo,'Title');
$objPHPExcel->getActiveSheet()->setCellValue('D'.$StartNo,'Gender');
$objPHPExcel->getActiveSheet()->setCellValue('E'.$StartNo,'BirthPlace');
$objPHPExcel->getActiveSheet()->setCellValue('F'.$StartNo,'BirthDate');
$objPHPExcel->getActiveSheet()->setCellValue('G'.$StartNo,'PassportNo');
$objPHPExcel->getActiveSheet()->setCellValue('H'.$StartNo,'PassportIssued');
$objPHPExcel->getActiveSheet()->setCellValue('I'.$StartNo,'PassportIssuedDate');
$objPHPExcel->getActiveSheet()->setCellValue('J'.$StartNo,'PassportValid'); 

$StartNo++;
$no=1;            
                    while ($data=mysql_fetch_array($ambil)){ 
                       
			  			$objPHPExcel->getActiveSheet()->setCellValue('A'.$StartNo,$no);                       
						$objPHPExcel->getActiveSheet()->setCellValue('B'.$StartNo,$data['PaxName']);
                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$StartNo,$data['Title']);
                        $objPHPExcel->getActiveSheet()->setCellValue('D'.$StartNo,$data['Gender']);
                        $objPHPExcel->getActiveSheet()->setCellValue('E'.$StartNo,$data['BirthPlace']);
                        $objPHPExcel->getActiveSheet()->setCellValue('F'.$StartNo,$data['BirthDate']);
                        $objPHPExcel->getActiveSheet()->setCellValue('G'.$StartNo,$data['PassportNo']);
                        $objPHPExcel->getActiveSheet()->setCellValue('H'.$StartNo,$data['PassportIssued']);
                        $objPHPExcel->getActiveSheet()->setCellValue('I'.$StartNo,$data['PassportIssuedDate']);
                        $objPHPExcel->getActiveSheet()->setCellValue('J'.$StartNo,$data['PassportValid']);
						 				                    
					  $no++;
					  $StartNo++;         
			}
$isidata=mysql_num_rows($ambil);
$jumrow=$isidata+1;                     
$xlsname=$BookingID;	
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);      
$objPHPExcel->getActiveSheet()->getStyle("A1:C$jumrow")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
$objPHPExcel->getActiveSheet()->getStyle("E1:J$jumrow")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED); 

// Save Excel 2007 file 
$filename="$xlsname.xls"; //just some random filename
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'"'); 
header('Cache-Control: max-age=0');



$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save("php://output"); 


exit(); 

?> 

