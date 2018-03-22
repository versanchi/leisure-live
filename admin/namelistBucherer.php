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
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);

						 
//set table header
//Tabel akan kita mulai dari Kolom B10 dan seterusnya
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15) ->setBold(true);
$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
$objPHPExcel->getActiveSheet()->setCellValue('A1','CLIENT LIST ');


// Menambahkan file gambar pada document excel pada kolom B2
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Panorama Tours');
$objDrawing->setDescription('Logo');
//$objDrawing->setPath(base_url().'images/pano1.jpg');
$objDrawing->setPath('./images/pano.jpg');
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

$edit=mysql_query("SELECT tour_msbookingdetail.*,tour_msbooking.TBFNo,CONVERT(RoomNo, UNSIGNED INTEGER) as urut FROM tour_msbookingdetail
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                    AND tour_msbooking.Status = 'ACTIVE' 
                    AND tour_msbookingdetail.Status <> 'CANCEL'
                    order by urut, tour_msbooking.BookingID ASC,IDDetail ASC");
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
         $seluruh=$room[jumlaadult]+$room[jumlachild]+$room[jumlainf];// + $tl;

$objPHPExcel->getActiveSheet()->getStyle('A5:A6')->getFont()->setSize(16) ->setBold(true);
$objPHPExcel->getActiveSheet()->mergeCells('A5:F5');

$objPHPExcel->getActiveSheet()->setCellValue('A5','Tour Code : ' .$isi['Productcode'].' - '.$isi['TourCode']);
$objPHPExcel->getActiveSheet()->mergeCells('A6:F6');
$objPHPExcel->getActiveSheet()->getStyle('A7:A8')->getFont()->setSize(10) ->setBold(true);
$objPHPExcel->getActiveSheet()->mergeCells('A7:F7');
$objPHPExcel->getActiveSheet()
	->setCellValue('A7','TOTAL PAX : '.$seluruh.' + '.$tl.' TL');
$objPHPExcel->getActiveSheet()->mergeCells('A8:F8');

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


$objPHPExcel->getActiveSheet()->mergeCells('A9:F9');
$objPHPExcel->getActiveSheet()
	->setCellValue('A9','TOURLEADER : '.$TLName);
$StartNo=10;

$objPHPExcel->getActiveSheet()->getStyle('A'.$StartNo.':F'.$StartNo)->getFont()->setSize(10) ->setBold(true)->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$objPHPExcel->getActiveSheet()->getStyle('A'.$StartNo.':F'.$StartNo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A'.$StartNo.':F'.$StartNo)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FE7008');


$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THICK
    )
  )
);

$objPHPExcel->getActiveSheet()->getStyle('A'.$StartNo.':F'.$StartNo)->applyFromArray($styleArray);
unset($styleArray);

$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->setCellValue('A'.$StartNo,'NO');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$StartNo,'GENDER');
$objPHPExcel->getActiveSheet()->setCellValue('C'.$StartNo,'FAMILY NAME');
$objPHPExcel->getActiveSheet()->setCellValue('D'.$StartNo,'FIRST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('E'.$StartNo,'PASSPORT NO');
$objPHPExcel->getActiveSheet()->setCellValue('F'.$StartNo,'COUNTRY OF ISSUE');
//isi data
$StartNo++;
$Awal=$StartNo;
$no=1;
if($isi[TourLeaderInc]=='YES'){

         				 mysql_data_seek($cariteel,0);
                       while($tlnya=mysql_fetch_array($cariteel)){
                           $carisatu=mssql_query("SELECT * ,substring(NameAsPassport,1,CHARINDEX(' ',NameAsPassport,1)) as Firstname, SUBSTRING(NameAsPassport, CHARINDEX(' ', NameAsPassport) + 1, 8000) AS Lastname FROM Employee
                                    where EmployeeID = '$tlnya[EmployeeID]'
                                    order by EmployeeName ASC");
                           $hasilsatu=mssql_num_rows($carisatu);

                           if($hasilsatu>0){
                            $datatl=mssql_fetch_array($carisatu);
                            if($datatl[BirthDate]=='0000-00-00' OR $datatl[BirthDate]==''){$bdate="";}else{
                            $bdate = date("d M Y", strtotime($datatl[BirthDate]));}
                            if($datatl[PassportValid]=='0000-00-00' OR $datatl[PassportValid]==''){$pvalid="";}else{
                            $pvalid = date("d M Y", strtotime($datatl[PassportValid]));}


								$objPHPExcel->getActiveSheet()->setCellValue('A'.$StartNo,$no);
								$objPHPExcel->getActiveSheet()->setCellValue('B'.$StartNo,"$datatl[Title]");
								$objPHPExcel->getActiveSheet()->setCellValue('C'.$StartNo,"$datatl[Lastname]");
								$objPHPExcel->getActiveSheet()->setCellValue('D'.$StartNo,"$datatl[Firstname]");
								$objPHPExcel->getActiveSheet()->setCellValue('E'.$StartNo,"$datatl[PassportNo]");
								$objPHPExcel->getActiveSheet()->setCellValue('F'.$StartNo,"$datatl[PassportIssued]");
								$StartNo++;
								$no++;


						   }

                   }

}
            
	
                    while ($data=mysql_fetch_array($edit)){ 
					
                        if($data[BirthDate]=='0000-00-00' OR $data[BirthDate]==''){$bdate='';}else{
                        $bdate = date("d M Y", strtotime($data[BirthDate]));}
                        if($data[PassportValid]=='0000-00-00' OR $data[PassportValid]==''){$pvalid='';}else{
                        $pvalid = date("d M Y", strtotime($data[PassportValid]));}         
                	
                    
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$StartNo,$no);				 
						$objPHPExcel->getActiveSheet()->setCellValue('B'.$StartNo,"$data[Title]");
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$StartNo,"$data[LastPaxName]");
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$StartNo,"$data[FirstPaxName]");
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$StartNo,"$data[PassportNo]");
						$objPHPExcel->getActiveSheet()->setCellValue('F'.$StartNo,"$data[PassportIssued]");
						  $no++;
						  $StartNo++;
					}
				

$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);
$Akhir=$StartNo-1;
$objPHPExcel->getActiveSheet()->getStyle('A'.$Awal.':F'.$Akhir)->applyFromArray($styleArray);
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

