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
                             ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                             ->setKeywords("office 2007 openxml php")
                             ->setCategory("Export Data");

//set width table
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$objPHPExcel->getActiveSheet()->getStyle('F:N')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F:J')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);


							 
//set table header
//Tabel akan kita mulai dari Kolom B10 dan seterusnya
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(20) ->setBold(true);
$objPHPExcel->getActiveSheet()->mergeCells('A2:N2');
$objPHPExcel->getActiveSheet()->setCellValue('A2','FINAL NAME LIST');


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

$edit=mysql_query("SELECT tour_msbookingdetail.*,tour_msbooking.TBFNo FROM tour_msbookingdetail                                                 
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                    AND tour_msbooking.Status = 'ACTIVE' 
                    AND tour_msbookingdetail.Status <> 'CANCEL'
                    order by tour_msbookingdetail.BookingID ,RoomNo ASC,IDDetail ASC");
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
         $seluruh=$room[jumlaadult]+$room[jumlachild] + $tl;
          $totrum=mysql_query("SELECT tour_msbookingdetail.RoomNo FROM tour_msbookingdetail                                                 
                                left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                                AND tour_msbookingdetail.Status <> 'CANCEL'
                                AND tour_msbooking.Status = 'ACTIVE'
                                group by tour_msbookingdetail.RoomNo ASC");        
         $totroom=mysql_num_rows($totrum);

$objPHPExcel->getActiveSheet()->getStyle('A5:A6')->getFont()->setSize(16) ->setBold(true);
$objPHPExcel->getActiveSheet()->mergeCells('A5:N5');

$objPHPExcel->getActiveSheet()->setCellValue('A5','Tour Code : ' .$isi['Productcode'].' - '.$isi['TourCode']);
$objPHPExcel->getActiveSheet()->mergeCells('A6:N6');
$objPHPExcel->getActiveSheet()->setCellValue('A6','DEPARTURE : ' .$depdet);

$objPHPExcel->getActiveSheet()->getStyle('A7:A8')->getFont()->setSize(10) ->setBold(true);
$objPHPExcel->getActiveSheet()->mergeCells('A7:N7');
$objPHPExcel->getActiveSheet()
	->setCellValue('A7','TOTAL PAX : ' .$room[jumlaadult] .' ADT + '.$room[jumlachild].' CHD + '.$tl .' TL= '.$seluruh.' PAXS');
$objPHPExcel->getActiveSheet()->mergeCells('A8:N8');
$objPHPExcel->getActiveSheet()->setCellValue('A8','TOTAL ROOM : ' .$totroom.' ROOMS');

$objPHPExcel->getActiveSheet()->setCellValue('A9','FLIGHT SCHEDULE :');
$StartNo=10;
$StartNo++;
$qpnr=mysql_query("SELECT * FROM tour_msproductpnr                                                 
                                        WHERE PnrProd ='$isi[IDProduct]'");
                    $pnr=mysql_fetch_array($qpnr);
                    $fly=mysql_query("SELECT * FROM tour_msprodflight                                                 
                                        WHERE IDGrv ='$pnr[GrvID]' order by FID ASC");
                    while($flight=mysql_fetch_array($fly)){
                        $AD = strtoupper(date('d M', strtotime($flight[AirDate]))); 
                        $ATD = date('H.i', strtotime($flight[AirTimeDep]));
                        $ATA = date('H.i', strtotime($flight[AirTimeArr]));
                        $objPHPExcel->getActiveSheet()->setCellValue('A'.$StartNo,$flight[AirCode]);
                        $objPHPExcel->getActiveSheet()->setCellValue('B'.$StartNo,$AD);
                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$StartNo,$flight[AirRouteDep].' - '.$flight[AirRouteArr]);  
                        $objPHPExcel->getActiveSheet()->setCellValue('D'.$StartNo,"$ATD - $ATA"); 
                        $StartNo++;
                    }

$StartNo++;
$objPHPExcel->getActiveSheet()->getStyle('A'.$StartNo.':N'.$StartNo)->getFont()->setSize(10) ->setBold(true)->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$objPHPExcel->getActiveSheet()->getStyle('A'.$StartNo.':N'.$StartNo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A'.$StartNo.':N'.$StartNo)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FE7008');


$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THICK
    )
  )
);

$objPHPExcel->getActiveSheet()->getStyle('A'.$StartNo.':N'.$StartNo)->applyFromArray($styleArray);
unset($styleArray);

$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->setCellValue('A'.$StartNo,'NO');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$StartNo,'TBF No');
$objPHPExcel->getActiveSheet()->setCellValue('C'.$StartNo,'PASSANGERS NAME');
$objPHPExcel->getActiveSheet()->setCellValue('D'.$StartNo,'ROOM TYPE');
$objPHPExcel->getActiveSheet()->setCellValue('E'.$StartNo,'ROOM NO');
$objPHPExcel->getActiveSheet()->setCellValue('F'.$StartNo,'NOTE PO');
$objPHPExcel->getActiveSheet()->setCellValue('G'.$StartNo,'REMARKS');
$objPHPExcel->getActiveSheet()->setCellValue('H'.$StartNo,'CONTACT NO');
$objPHPExcel->getActiveSheet()->setCellValue('I'.$StartNo,'TC');
$objPHPExcel->getActiveSheet()->setCellValue('J'.$StartNo,'PASSPORT NO');
$objPHPExcel->getActiveSheet()->mergeCells('K'.$StartNo.':L'.$StartNo);
$objPHPExcel->getActiveSheet()->setCellValue('K'.$StartNo,'PLACE & DATE OF BIRTH');
$objPHPExcel->getActiveSheet()->mergeCells('M'.$StartNo.':N'.$StartNo);
$objPHPExcel->getActiveSheet()->setCellValue('M'.$StartNo,'PLACE & DATE OF EXPIRY');


//isi data
$Awal=$StartNo;
if($isi[TourLeaderInc]=='YES'){
         //$no=2;
         $cariteel=mysql_query("SELECT * FROM tour_msproducttl   
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL' 
                                order by IDPTL ASC");        
                       $hasilteel=mysql_num_rows($cariteel);
                       $no=$hasilteel+1;
                       $notl=1;
                       while($tlnya=mysql_fetch_array($cariteel)){
                           $carisatu=mysql_query("SELECT * FROM tour_mstourleader   
                                    where TourleaderStatus = 'ACTIVE'
                                    AND TourleaderName = '$tlnya[TLName]' 
                                    order by TourleaderName ASC");        
                           $hasilsatu=mysql_num_rows($carisatu);
                           $caridua=mysql_query("SELECT * FROM tbl_msemployee 
                                    where employee_tl = 'on'
                                    AND employee_name = '$tlnya[TLName]'
                                    ORDER BY employee_name ASC");        
                           $hasildua=mysql_num_rows($caridua);
                           if($hasilsatu>0){
                            $datatl=mysql_fetch_array($carisatu);
                            if($datatl[TourleaderBirthDate]=='0000-00-00' OR $datatl[TourleaderBirthDate]==''){$bdate="";}else{
                            $bdate = date("d M Y", strtotime($datatl[TourleaderBirthDate]));
                            }
                            if($datatl[TourleaderPassportValid]=='0000-00-00' OR $datatl[TourleaderPassportValid]==''){$pvalid="";}else{
                            $pvalid = date("d M Y", strtotime($datatl[TourleaderPassportValid]));
                            }
                            $StartNo++;               
							$objPHPExcel->getActiveSheet()->setCellValue('A'.$StartNo,$notl);
							$objPHPExcel->getActiveSheet()->setCellValue('B'.$StartNo,'');
							$objPHPExcel->getActiveSheet()->setCellValue('C'.$StartNo,$datatl[TourleaderName]);
							$objPHPExcel->getActiveSheet()->setCellValue('D'.$StartNo,'SGL');
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$StartNo,'');
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$StartNo,'');
							$objPHPExcel->getActiveSheet()->setCellValue('G'.$StartNo,'TOUR LEADER');
							$objPHPExcel->getActiveSheet()->setCellValue('H'.$StartNo,"$datatl[TourleaderMobile]");
							$objPHPExcel->getActiveSheet()->setCellValue('I'.$StartNo,'');
							$objPHPExcel->getActiveSheet()->setCellValue('J'.$StartNo,$datatl[TourleaderPassportNo]);
							$objPHPExcel->getActiveSheet()->setCellValue('K'.$StartNo,$datatl[TourleaderBirthPlace]);
							$objPHPExcel->getActiveSheet()->setCellValue('L'.$StartNo,$bdate);
							$objPHPExcel->getActiveSheet()->setCellValue('M'.$StartNo,$datatl[TourleaderPassportIssued]);
							$objPHPExcel->getActiveSheet()->setCellValue('N'.$StartNo,$pvalid);
							
					
                       }else{
                            $datatl=mysql_fetch_array($caridua);
                           if($datatl[TourleaderBirthDate]=='0000-00-00' OR $datatl[TourleaderBirthDate]==''){$bdate="";}else{
                            $bdate = date("d M Y", strtotime($datatl[TourleaderBirthDate]));                            }
                            if($datatl[TourleaderPassportValid]=='0000-00-00' OR $datatl[TourleaderPassportValid]==''){$pvalid="";}else{
                            $pvalid = date("d M Y", strtotime($datatl[TourleaderPassportValid]));
							
                            } 
							$StartNo++; 
							$objPHPExcel->getActiveSheet()->setCellValue('A'.$StartNo,$notl);
							$objPHPExcel->getActiveSheet()->setCellValue('B'.$StartNo,'');
							$objPHPExcel->getActiveSheet()->setCellValue('C'.$StartNo,$datatl[employee_name]);
							$objPHPExcel->getActiveSheet()->setCellValue('D'.$StartNo,'SGL');
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$StartNo,'');
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$StartNo,'');
							$objPHPExcel->getActiveSheet()->setCellValue('G'.$StartNo,'TOUR LEADER');
							$objPHPExcel->getActiveSheet()->setCellValue('H'.$StartNo,'');
							$objPHPExcel->getActiveSheet()->setCellValue('I'.$StartNo,'');
							$objPHPExcel->getActiveSheet()->setCellValue('J'.$StartNo,$datatl[PassportNo]);
							$objPHPExcel->getActiveSheet()->setCellValue('K'.$StartNo,$datatl[BirthPlace]);
							$objPHPExcel->getActiveSheet()->setCellValue('L'.$StartNo,$bdate);
							$objPHPExcel->getActiveSheet()->setCellValue('M'.$StartNo,$datatl[PassportIssued]);
							$objPHPExcel->getActiveSheet()->setCellValue('N'.$StartNo,$pvalid);
					
                       }$notl++;		
				   }
                       
                   }else{$no=1;}
				    $StartNo++;

                    $lastbooking='awal';
				
                    while ($data=mysql_fetch_array($edit)){ 
                        if($data[BirthDate]=='0000-00-00' OR $data[BirthDate]==''){$bdate='';}else{
                        $bdate = date("d M Y", strtotime($data[BirthDate]));}
                        if($data[PassportValid]=='0000-00-00' OR $data[PassportValid]==''){$pvalid='';}else{
                        $pvalid = date("d M Y", strtotime($data[PassportValid]));}         
                        $dtable=mysql_query("SELECT * FROM tour_msbooking                                                 
                                                WHERE BookingID ='$data[BookingID]'
                                                AND Status = 'ACTIVE'
                                                order by IDBookers ASC");        
                        $itable=mysql_fetch_array($dtable);
						 
					
						$BookingID=mysql_query("SELECT * FROM tour_msbookingdetail                                                 
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                    AND tour_msbooking.Status = 'ACTIVE'
                    AND tour_msbookingdetail.Status <> 'CANCEL' 
                    and tour_msbooking.BookingID='$data[BookingID]'
                    order by tour_msbooking.BookingID ASC,IDDetail ASC");
         			$jumlahBooking=mysql_num_rows($BookingID);
		 
                        if($data['PaxName']==''){$pax='TBA';}else{$pax=$data['PaxName'];}
               
			  			$objPHPExcel->getActiveSheet()->setCellValue('A'.$StartNo,$no);
							
				
                        if($lastbooking<>$data['BookingID']){
							$Merge=$StartNo+$jumlahBooking-1;
							$objPHPExcel->getActiveSheet()->mergeCells('B'.$StartNo.':B'.$Merge);
							$objPHPExcel->getActiveSheet()->getStyle('B'.$StartNo)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
							$objPHPExcel->getActiveSheet()->setCellValue('B'.$StartNo,$data['TBFNo']);}
						
							$objPHPExcel->getActiveSheet()->setCellValue('C'.$StartNo,$data['Title'].' '.$pax);
                  
				  if($roomnow<>$data['RoomNo'] or $lastbooking<>$data['BookingID'] ){
				  	$jenis='awal';
						$totalroom=mysql_query("SELECT * FROM tour_msbookingdetail                   
            	       WHERE BookingID='$data[BookingID]'
                    AND tour_msbookingdetail.Status <> 'CANCEL' and RoomNo='$data[RoomNo]'");
				
					$jumlahparty=mysql_num_rows($totalroom);
					//gabungan jenis kamar
							$typeroom=mysql_query("SELECT distinct RoomType FROM tour_msbookingdetail                   
              			      WHERE BookingID='$data[BookingID]'
                			   AND tour_msbookingdetail.Status <> 'CANCEL' and RoomNo='$data[RoomNo]'");
					 while ($dtyperoom=mysql_fetch_array($typeroom)){
						 	if ($jenis=='awal')
							{
								$jenis=$dtyperoom['RoomType'];
							}
							else
							{
								$jenis=$jenis." + ".$dtyperoom['RoomType'];
							}
							
						} 
						 
						$MergeR=$StartNo+$jumlahparty-1;
						$objPHPExcel->getActiveSheet()->mergeCells('D'.$StartNo.':D'.$MergeR);
						$objPHPExcel->getActiveSheet()->getStyle('D'.$StartNo)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$StartNo,$jenis);
						$objPHPExcel->getActiveSheet()->mergeCells('E'.$StartNo.':E'.$MergeR);
						$objPHPExcel->getActiveSheet()->getStyle('E'.$StartNo)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$StartNo,'');
						$roomnow=$data['RoomNo'];}
						
						 if($lastbooking<>$data['BookingID']){
						 $objPHPExcel->getActiveSheet()->mergeCells('F'.$StartNo.':F'.$Merge);
						 $objPHPExcel->getActiveSheet()->getStyle('F'.$StartNo)->getAlignment()
						 	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						 $objPHPExcel->getActiveSheet()->setCellValue('F'.$StartNo,$itable['OperationNote']);}
						 
                        if($data['Package']=='L.A Only'){
							$objPHPExcel->getActiveSheet()->setCellValue('G'.$StartNo,$data['Package'].' '.$data['Deviasi']);
						}else{
							$objPHPExcel->getActiveSheet()->setCellValue('G'.$StartNo,$data['Deviasi']);
						}
						
                        if($lastbooking<>$data['BookingID']){
						$objPHPExcel->getActiveSheet()->mergeCells('H'.$StartNo.':H'.$Merge);
						$objPHPExcel->getActiveSheet()->getStyle('H'.$StartNo)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						$objPHPExcel->getActiveSheet()->setCellValue('H'.$StartNo,$itable['BookersName'].' - '.$itable['BookersTelp'].' - '.$itable['BookersMobile']);
						$objPHPExcel->getActiveSheet()->mergeCells('I'.$StartNo.':I'.$Merge);
						$objPHPExcel->getActiveSheet()->getStyle('I'.$StartNo)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						$objPHPExcel->getActiveSheet()->setCellValue('I'.$StartNo,$itable['TCName'].' ( '.$itable['TCDivision'].' )');
						$lastbooking=$data['BookingID'];}

						$objPHPExcel->getActiveSheet()->setCellValue('J'.$StartNo,$data['PassportNo']);
						$objPHPExcel->getActiveSheet()->setCellValue('K'.$StartNo,$data['BirthPlace']);
						$objPHPExcel->getActiveSheet()->setCellValue('L'.$StartNo,$bdate);
						$objPHPExcel->getActiveSheet()->setCellValue('M'.$StartNo,$data['PassportIssued']);
						$objPHPExcel->getActiveSheet()->setCellValue('N'.$StartNo,$pvalid);						

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
$objPHPExcel->getActiveSheet()->getStyle('A'.$Awal.':N'.$Akhir)->applyFromArray($styleArray);
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

