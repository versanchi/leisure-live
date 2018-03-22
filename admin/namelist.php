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
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(7);
$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$objPHPExcel->getActiveSheet()->getStyle('F:M')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);

						 
//set table header
//Tabel akan kita mulai dari Kolom B10 dan seterusnya
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(20) ->setBold(true);
$objPHPExcel->getActiveSheet()->mergeCells('A2:M2');
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
         $seluruh=$room[jumlaadult]+$room[jumlachild] + $tl;
          $totrum=mysql_query("SELECT tour_msbookingdetail.RoomNo FROM tour_msbookingdetail                                                 
                                left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                                AND tour_msbookingdetail.Status <> 'CANCEL'
                                AND tour_msbooking.Status = 'ACTIVE'
                                group by tour_msbookingdetail.BookingID,RoomNo ASC");
         $totroom=mysql_num_rows($totrum);
         if($tl>0){$rmtl="+ $tl TL ROOM";}
$objPHPExcel->getActiveSheet()->getStyle('A5:A6')->getFont()->setSize(16) ->setBold(true);
$objPHPExcel->getActiveSheet()->mergeCells('A5:M5');

$objPHPExcel->getActiveSheet()->setCellValue('A5','Tour Code : ' .$isi['Productcode'].' - '.$isi['TourCode']);
$objPHPExcel->getActiveSheet()->mergeCells('A6:H6');
$objPHPExcel->getActiveSheet()->setCellValue('A6','DEPARTURE : ' .$depdet);

$objPHPExcel->getActiveSheet()->getStyle('A7:A8')->getFont()->setSize(10) ->setBold(true);
$objPHPExcel->getActiveSheet()->mergeCells('A7:H7');
$objPHPExcel->getActiveSheet()
	->setCellValue('A7','TOTAL PAX : ' .$room[jumlaadult] .' ADT + '.$room[jumlachild].' CHD + '.$tl .' TL= '.$seluruh.' PAXS');
$objPHPExcel->getActiveSheet()->mergeCells('A8:H8');
$objPHPExcel->getActiveSheet()->setCellValue('A8','TOTAL ROOM : ' .$totroom.' ROOMS ' .$rmtl );
$objPHPExcel->getActiveSheet()->mergeCells('I6:L6');
$objPHPExcel->getActiveSheet()->setCellValue('I6','FLIGHT SCHEDULE :');
$StartNo=8;
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
                        $objPHPExcel->getActiveSheet()->setCellValue('J'.$StartNo,$flight[AirCode]);
                        $objPHPExcel->getActiveSheet()->setCellValue('K'.$StartNo,$AD);
                        $objPHPExcel->getActiveSheet()->setCellValue('L'.$StartNo,$flight[AirRouteDep].' - '.$flight[AirRouteArr]);  
                        $objPHPExcel->getActiveSheet()->setCellValue('M'.$StartNo,"$ATD - $ATA"); 
                        $StartNo++;
                    }

$StartNo++;
$objPHPExcel->getActiveSheet()->getStyle('A'.$StartNo.':M'.$StartNo)->getFont()->setSize(10) ->setBold(true)->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$objPHPExcel->getActiveSheet()->getStyle('A'.$StartNo.':M'.$StartNo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A'.$StartNo.':M'.$StartNo)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FE7008');


$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THICK
    )
  )
);

$objPHPExcel->getActiveSheet()->getStyle('A'.$StartNo.':M'.$StartNo)->applyFromArray($styleArray);
unset($styleArray);

$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->setCellValue('A'.$StartNo,'NO');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$StartNo,'PASSANGERS NAME');
$objPHPExcel->getActiveSheet()->setCellValue('C'.$StartNo,'ROOM TYPE');
$objPHPExcel->getActiveSheet()->setCellValue('D'.$StartNo,'ROOM NO');
$objPHPExcel->getActiveSheet()->setCellValue('E'.$StartNo,'NOTE PO');
$objPHPExcel->getActiveSheet()->setCellValue('F'.$StartNo,'REMARKS');
$objPHPExcel->getActiveSheet()->setCellValue('G'.$StartNo,'CONTACT NO');
$objPHPExcel->getActiveSheet()->setCellValue('H'.$StartNo,'TC');
$objPHPExcel->getActiveSheet()->setCellValue('I'.$StartNo,'PASSPORT NO');
$objPHPExcel->getActiveSheet()->mergeCells('J'.$StartNo.':K'.$StartNo);
$objPHPExcel->getActiveSheet()->setCellValue('J'.$StartNo,'PLACE & DATE OF BIRTH');
$objPHPExcel->getActiveSheet()->mergeCells('L'.$StartNo.':M'.$StartNo);
$objPHPExcel->getActiveSheet()->setCellValue('L'.$StartNo,'PLACE & ISSUING DATE PASSPORT');

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
                           $carisatu=mssql_query("SELECT * FROM [HRM].[dbo].[Employee]
                                    where EmployeeID = '$tlnya[EmployeeID]'
                                    order by EmployeeName ASC");
                           $hasilsatu=mssql_num_rows($carisatu);
                           if($hasilsatu>0){
                            $datatl=mssql_fetch_array($carisatu);
                            if($datatl[BirthDate]=='0000-00-00' OR $datatl[BirthDate]==''){$bdate="";}else{
                            $bdate = date("d M Y", strtotime($datatl[BirthDate]));
                            }
                            if($datatl[PassportValid]=='0000-00-00' OR $datatl[PassportValid]==''){$pvalid="";}else{
                            $pvalid = date("Y", strtotime($datatl[PassportValid]));
                            }
                            if($datatl[PassportIssuedDate]=='0000-00-00' OR $datatl[PassportIssuedDate]==''){$pissue="";}else{
                            $pissue = date("d M Y", strtotime($datatl[PassportIssuedDate]));}
                            $StartNo++;               
							$objPHPExcel->getActiveSheet()->setCellValue('A'.$StartNo,$notl);
							$objPHPExcel->getActiveSheet()->setCellValue('B'.$StartNo,"$datatl[Title] $datatl[NameAsPassport]");
							$objPHPExcel->getActiveSheet()->setCellValue('C'.$StartNo,'SGL');
							$objPHPExcel->getActiveSheet()->setCellValue('D'.$StartNo,'');
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$StartNo,'');
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$StartNo,'TOUR LEADER');
							$objPHPExcel->getActiveSheet()->setCellValue('G'.$StartNo,"$datatl[Mobile]");
							$objPHPExcel->getActiveSheet()->setCellValue('H'.$StartNo,'');
							$objPHPExcel->getActiveSheet()->setCellValue('I'.$StartNo,$datatl[PassportNo]);
							$objPHPExcel->getActiveSheet()->setCellValue('J'.$StartNo,$datatl[BirthPlace]);
							$objPHPExcel->getActiveSheet()->setCellValue('K'.$StartNo,$bdate);
							$objPHPExcel->getActiveSheet()->setCellValue('L'.$StartNo,$datatl[PassportIssued]);
							$objPHPExcel->getActiveSheet()->setCellValue('M'.$StartNo,"$pissue - $pvalid");

                       }$notl++;
				   }
                       
                   }else{$no=1;}
				    $StartNo++;

                    $lastbooking='awal';
				
                    while ($data=mysql_fetch_array($edit)){ 
                        if($data[BirthDate]=='0000-00-00' OR $data[BirthDate]==''){$bdate='';}else{
                        $bdate = date("d M Y", strtotime($data[BirthDate]));}
                        if($data[PassportValid]=='0000-00-00' OR $data[PassportValid]==''){$pvalid='';}else{
                        $pvalid = date("Y", strtotime($data[PassportValid]));}
                        if($data[PassportIssuedDate]=='0000-00-00' OR $data[PassportIssuedDate]==''){$pissue='';}else{
                        $pissue = date("d M Y", strtotime($data[PassportIssuedDate]));}
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
						$vch=mysql_query("SELECT * FROM `tour_voucherpromo` WHERE `VoucherNo` = '$data[VoucherNo]' and `VoucherStatus`='APPROVE'");
						$vchok=mysql_num_rows($vch);
                        if($data['Promo']<>'' AND $vchok > 0){$promo='*';$ket="* $data[Promo]";}else{$promo="";}
                        if($data[Age]<>'' and ($data[Gender]=='CHILD' OR $data[Gender]=='INFANT')){$age="($data[Age])";}else{$age="";}
                        if($data[Gender]=='INFANT'){$inf="INF ";}else{$inf="";}
                        if($data['PaxName']==''){$pax="TBA $promo";}else{$pax="$data[PaxName] $promo";}
               			$objPHPExcel->getActiveSheet()->setCellValue('A'.$StartNo,$no);
							
				 if($lastbooking<>$data['BookingID']){$Merge=$StartNo+$jumlahBooking-1;}
				 
                   $objPHPExcel->getActiveSheet()->setCellValue('B'.$StartNo,$inf.' '.$data['Title'].' '.$pax.' '.$age);
                  
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
						 	if($dtyperoom[RoomType]=='Double'){$RoomType='DBL';}
							else
							if($dtyperoom[RoomType]=='Triple'){$RoomType='TRP';}
							else
							if($dtyperoom[RoomType]=='Twin'){$RoomType='TWN';}
							else
							{$RoomType=$dtyperoom[RoomType];}

						 	if ($jenis=='awal')
							{
								$jenis=$RoomType;
							}
							else
							{
								$jenis=$jenis." + ".$RoomType;
							}
						} 
					
						$MergeR=$StartNo+$jumlahparty-1;
						$objPHPExcel->getActiveSheet()->mergeCells('C'.$StartNo.':C'.$MergeR);
						$objPHPExcel->getActiveSheet()->getStyle('C'.$StartNo)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$StartNo,$jenis);
						$objPHPExcel->getActiveSheet()->mergeCells('D'.$StartNo.':D'.$MergeR);
						$objPHPExcel->getActiveSheet()->getStyle('D'.$StartNo)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$StartNo,'');
						$roomnow=$data['RoomNo'];}
						
						 if($lastbooking<>$data['BookingID']){
						 $objPHPExcel->getActiveSheet()->mergeCells('E'.$StartNo.':E'.$Merge);
						 $objPHPExcel->getActiveSheet()->getStyle('E'.$StartNo)->getAlignment()
						 	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						 $objPHPExcel->getActiveSheet()->setCellValue('E'.$StartNo,$itable['OperationNote']);}
						 
                        if($data['Package']=='L.A Only'){
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$StartNo,$data['Package'].' '.$data['Deviasi']);
						}else{
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$StartNo,$data['Deviasi']);
						}
						
                        if($lastbooking<>$data['BookingID']){
						$objPHPExcel->getActiveSheet()->mergeCells('G'.$StartNo.':G'.$Merge);
						$objPHPExcel->getActiveSheet()->getStyle('G'.$StartNo)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						$objPHPExcel->getActiveSheet()->setCellValue('G'.$StartNo,$itable['BookersName'].' - '.$itable['BookersTelp'].' - '.$itable['BookersMobile']);
						$objPHPExcel->getActiveSheet()->mergeCells('H'.$StartNo.':H'.$Merge);
						$objPHPExcel->getActiveSheet()->getStyle('H'.$StartNo)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						$objPHPExcel->getActiveSheet()->setCellValue('H'.$StartNo,$itable['TCName'].' ( '.$itable['TCDivision'].' )');
						$lastbooking=$data['BookingID'];}

						$objPHPExcel->getActiveSheet()->setCellValue('I'.$StartNo,$data['PassportNo']);
						$objPHPExcel->getActiveSheet()->setCellValue('J'.$StartNo,$data['BirthPlace']);
						$objPHPExcel->getActiveSheet()->setCellValue('K'.$StartNo,$bdate);
						$objPHPExcel->getActiveSheet()->setCellValue('L'.$StartNo,$data['PassportIssued']);
						$objPHPExcel->getActiveSheet()->setCellValue('M'.$StartNo,"$pissue - $pvalid");
                        
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
$objPHPExcel->getActiveSheet()->getStyle('A'.$Awal.':M'.$Akhir)->applyFromArray($styleArray);
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

