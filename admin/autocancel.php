<?php   
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
//include "../config/koneksi.php";
$dbHost = 'localhost';
$dbUsername = 'admin_dbvisa';
$dbPassword = 'adminphp';
$dbDatabase = 'admin_dbvisa';
$dbltm=mysql_connect($dbHost,$dbUsername,$dbPassword) or die("Opps sorry, Your Connection failed");
mysql_select_db($dbDatabase) or die("Database can't open");
//include "../config/koneksisql.php";
$mssqlHost = "10.10.200.3\INS";
$mssqlUser = "sa";
$mssqlPass = "Entertain04";
$mssqlDB = "PTES";
$linkptes = mssql_connect($mssqlHost,$mssqlUser,$mssqlPass) or die ('Upss we loose PTES connection Server on '.$mssqlHost1.' '. mssql_get_last_message());
$dbptes = mssql_select_db($mssqlDB, $linkptes) or die("PTES database is gone");
include "../config/library.php";

$module=$_GET[module];
$act=$_GET[act];

$timezone_offset = 1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
$tigahrkmrn = mktime (0,0,0, date("m"), date("d")-3,date("Y"));
$tigahrkemarin = date('Y-m-d', $tigahrkmrn);
//echo "$tigahrkemarin";
    //search draft booking
    $qdraft=mysql_query("SELECT * FROM tour_msbooking WHERE BookingStatus = 'HOLD' AND Status <>'VOID' AND DATE(BookingDate) <='$tigahrkemarin' ");

    while($bookdraft=mysql_fetch_array($qdraft)){

    $updets=mysql_query("UPDATE tour_msbooking set Status='VOID',ReasonCancel='AUTO CANCEL',CancelBy='SYSTEM',CancelDate='$today' WHERE BookingID = '$bookdraft[BookingID]'");
    $edit=mysql_query("UPDATE tour_msbookingdetail set Status = 'CANCEL',
                                                        Price='0',
                                                        AddCharge='0',
                                                        SubTotal='0'
                                                        WHERE BookingID = '$bookdraft[BookingID]'");

    $edit1=mysql_query("SELECT count(IDDetail)as tota,BookingID,TourCode FROM tour_msbookingdetail WHERE BookingID ='$bookdraft[BookingID]' and Status <> 'CANCEL' and Gender <>'INFANT' GROUP BY BookingID");
    $r2=mysql_fetch_array($edit1);
    $upbook1=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$bookdraft[BookingID]'");
    $upbook=mysql_fetch_array($upbook1);
    if($upbook[SFID]<>''){
        $editptes=mssql_query("UPDATE [PTES].[dbo].[SalesFolderDetails] set [StatusPax] = 'CANCEL'
                                                    WHERE ConfirmationNo = '$r2[BookingID]' AND SupplierName = 'LTM'");
    }
    $mencari1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$upbook[IDTourcode]' and Status <> 'VOID' ");
    $ulang=mysql_fetch_array($mencari1);
    $caribook=mysql_query("SELECT count(IDDetail) as totbuking FROM tour_msbookingdetail WHERE IDTourcode = '$upbook[IDTourcode]' and Gender <> 'INFANT' and Status <> 'CANCEL'");
    $kebook=mysql_fetch_array($caribook);
    $seatdep = $kebook[totbuking];
    $seatsisa = $ulang[Seat] - $seatdep;
    $updet=mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdep',
                                                        SeatSisa='$seatsisa',
                                                        SeatInquiry = '0'
                                                        WHERE IDProduct = '$upbook[IDTourcode]'");


    $Description="Auto Cancel Booking $r2[BookingID]";
    mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('SYSTEM',
                                   '$Description',
                                   '$today')");
    $ceking=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$bookdraft[BookingID]'");
    $cek=mysql_fetch_array($ceking);
    $autocek=mysql_query("UPDATE tour_msbooking set Duplicate = 'NO' WHERE DepositNo = '$cek[DepositNo]' and Duplicate = 'YES' order by IDBookers ASC limit 1");
    //update PTES
        $nocsr=substr($bookdraft[depositno],0,3);
        //if(($offgroup =='PANORAMA TOURS' AND !preg_match('/LTM/',$EmpOff)) OR $offgroup <> 'PANORAMA WORLD' OR $offgroup <> 'SISTER COMPANY'){
        if($nocsr=='CSR'){
        $cekduplicate=mysql_query("SELECT * FROM tour_msbooking WHERE DepositNo = '$cek[DepositNo]' and Status = 'ACTIVE' limit 1");
        $jumlahduplicate=mysql_num_rows($cekduplicate);
        $hasilduplicate=mysql_fetch_array($cekduplicate);
        if($jumlahduplicate>0){
            mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = '$hasilduplicate[BookingID]'
                                                WHERE [CashReceiptId] = '$cek[DepositNo]'");
        }else if($jumlahduplicate==0){
            mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = NULL
                                                WHERE [CashReceiptId] = '$cek[DepositNo]'");
        }
    }
        //void voucher
        mysql_query("UPDATE tour_voucherpromo set VoucherStatus = 'VOID',
                                        UpdateBy = 'SYSTEM',
                                        UpdateDate = '$today'
                                        WHERE BookingID = '$bookdraft[BookingID]'");
        
    }

//auto cancel
$skrg = date("Y-m-d");
$thnberjalan = date("Y");
$ceking=mysql_query("SELECT * FROM tour_msbooking WHERE YEAR(BookingDate) <= '$thnberjalan' and Duplicate = 'YES' and Status = 'ACTIVE' ");
$ada=mysql_num_rows($ceking);echo"ketemu:$ada<br>";
if($ada>0){
    while($cek=mysql_fetch_array($ceking)){
        $nextday=$cek[DepositDate];
        $rumus = mysql_query("SELECT datediff('$skrg', '$nextday') as selisih ");
        $jawab = mysql_fetch_array($rumus);
        $selisih=$jawab[selisih];
        // 3 hari auto cancel duplicate book 
        if($selisih > 3){
            $edit1=mysql_query("SELECT count(IDDetail)as tota,tour_msbooking.BookingID,tour_msbooking.TourCode,IDTourcode,Year
                                FROM tour_msbookingdetail
                                inner join tour_msbooking on tour_msbooking.BookingID= tour_msbookingdetail.BookingID
                                WHERE tour_msbookingdetail.BookingID ='$cek[BookingID]'
                                and tour_msbookingdetail.Status <> 'CANCEL'
                                and Gender <>'INFANT'
                                GROUP BY tour_msbookingdetail.BookingID");
            $r2=mysql_fetch_array($edit1);
            $cari1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$r2[IDTourcode]'  and Status <> 'VOID'");
            $ulang=mysql_fetch_array($cari1);
            $seatcancel = $r2[tota];
            $seatdep = $ulang[SeatDeposit] - $seatcancel;
            $seatsisa = $ulang[SeatSisa] + $seatcancel;
            $updet=mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdep',
                                                               SeatSisa='$seatsisa'
                                                               WHERE IDProduct = '$ulang[IDProduct]'");
            $updets=mysql_query("UPDATE tour_msbooking set Status='VOID',ReasonCancel='AUTO CANCEL',CancelBy='SYSTEM',CancelDate='$today' WHERE BookingID = '$cek[BookingID]'");
            $edit=mysql_query("UPDATE tour_msbookingdetail set Status = 'CANCEL',
                                                               Price='0',
                                                               AddCharge='0',
                                                               SubTotal='0'
                                                        WHERE BookingID = '$cek[BookingID]'");
            //update PTES
            //if((($offgroup =='PANORAMA TOURS' OR $offgroup =='TUR EZ') AND !preg_match('/LTM/',$EmpOff)) OR $offgroup <> 'PANORAMA WORLD' OR $offgroup <> 'SISTER COMPANY'){
                $cekduplicate=mysql_query("SELECT * FROM tour_msbooking WHERE DepositNo = '$cek[DepositNo]' and Status = 'ACTIVE' limit 1");
                $jumlahduplicate=mysql_num_rows($cekduplicate);
                $hasilduplicate=mysql_fetch_array($cekduplicate);
                if($jumlahduplicate>0){
                    mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = '$hasilduplicate[BookingID]'
                                            WHERE [CashReceiptId] = '$cek[DepositNo]' AND [COMPANYID]= '$company' ");
                }else if($jumlahduplicate==0){
                    mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = NULL
                                            WHERE [CashReceiptId] = '$cek[DepositNo]' AND [COMPANYID]= '$company' ");
                }
            //}
            //void voucher
            mysql_query("UPDATE tour_voucherpromo set VoucherStatus = 'VOID',
                                        UpdateBy = 'SYSTEM',
                                        UpdateDate = '$today'
                                        WHERE BookingID = '$cek[BookingID]'");
        }
    }}
    mysql_query("UPDATE tour_msbookingdetail set Status = 'CANCEL'
                                                        WHERE ReasonCancel <> '' ");
$useremail='ferry_budiono@panorama-tours.com';
$message = "\n";
$message .= "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">" . "\n";
$message .= "<html>" . "\n";
$message .= "<head>" . "\n";
$message .= "</head>" . "\n";
$message .= '<body bgcolor="#FFFFFF" text="#333333" style="background-color: #FFFFFF; margin-bottom : 0px; margin-left : 0px; margin-top : 0px; margin-right : 0px;">

            <p><small>IMPORTANT INFO :</small></p>
            <p style="font-size: 10px;">* This email is sent automatically via Panorama Integrated system and does not require a reply.
            </body>';
$message .= "</HTML>" . "\n";
$message .= "\n";
$headers = "MIME-Version: 1.0 \n";
$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
$headers .= "From: Panorama WebSys <noreply@panoramawebsys.com> \n";
$headers .= "Reply-To: noreply@panoramawebsys.com \r\n";
$headers .= "Return-Path: noreply@panoramawebsys.com\r\n";
//$headers .= "Bcc: ferry_budiono@panorama-tours.com\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

mail($useremail, "Auto Cancel Status", $message, $headers);
?>
