<?php
 
/*if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = $_POST['kepada'];
    //$email_to = 'ferry_budiono@panorama-tours.com';
 
    $email_subject = $_POST['subject'];;
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
        echo "These errors appear below.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />
        <br><input type=button value='SEND AGAIN' onclick=location.href='media.php?module=sendemail'>"; 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['first_name']) ||
 
        !isset($_POST['last_name']) ||
 
        !isset($_POST['email']) ||
 
        !isset($_POST['telephone']) ||
 
        !isset($_POST['comments'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');      
 
    }
 
     
 
    $first_name = $_POST['first_name']; // required
 
    $last_name = $_POST['last_name']; // required
 
    $email_from = $_POST['email']; // required
 
    $telephone = $_POST['telephone']; // not required
 
    $comments = $_POST['comments']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
 
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
 
  }
 
  if(!preg_match($string_exp,$last_name)) {
 
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
 
  }
 
  if(strlen($comments) < 2) {
 
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Form details below.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
 
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
 
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
     
 
     
 
// create email headers
 
/*$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion(); */

 /*$headers = "From: PanoramaWebsys <ferry@panoramawebsys.com> \n"; 
 $headers.= "Content-Type: text/html; charset=ISO-8859-1 "; 
 $headers .= "MIME-Version: 1.0 ";
 
 mail($email_to, $email_subject, $email_message, $headers); 
 
?>
 
 
 
<!-- include your own success html here -->
 
 
 
Thank you for contacting us. We will be in touch with you very soon.
<br><input type=button value='SEND AGAIN' onclick=location.href='media.php?module=sendemail'>  
 
 
<?php     
 
} */
include "../config/koneksi.php";
//update seat deposit
/*$mencari1=mysql_query("SELECT * FROM tour_msproduct WHERE Status <> 'VOID' AND Year ='2015'");
        while($ulang=mysql_fetch_array($mencari1)){
        $caribook=mysql_query("SELECT count(IDDetail) as totbuking FROM tour_msbookingdetail WHERE IDTourcode = '$ulang[IDProduct]' and Gender <> 'INFANT' and Status <> 'CANCEL'");  
        $kebook=mysql_fetch_array($caribook);
        $seatdeplast = $kebook[totbuking];
        $seatsisalast = $ulang[Seat] - $seatdeplast;
        if($ulang[SeatDeposit]<>$seatdeplast){echo"$ulang[IDProduct]</br>";}
        mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdeplast',
                                                        SeatSisa='$seatsisalast'
                                                        WHERE IDProduct = '$ulang[IDProduct]'");       
        }*/

/*$mencari1=mysql_query("SELECT * FROM tour_msbooking WHERE BookingStatus = 'DEPOSIT' and Status = 'ACTIVE' and BookingDate >= '2014-01-01' ");  
        while($ulang=mysql_fetch_array($mencari1)){
        $caribook=mysql_query("SELECT count(IDDetail) as totbuking FROM tour_msbookingdetail WHERE BookingID = '$ulang[BookingID]' and Gender = 'CHILD' and Status <> 'CANCEL'");  
        $kebook=mysql_fetch_array($caribook);
        $seatdeplast = $kebook[totbuking];
        $seatsisalast = $ulang[Seat] - $seatdeplast;
        if($ulang[ChildPax]<>$seatdeplast){//echo"$ulang[BookingID]</br>";}
        mysql_query("UPDATE tour_msbooking set ChildPax = '$seatdeplast'
                                                       WHERE BookingID = '$ulang[BookingID]'");
        } 
        }
//update tanggal
/*$mencari1=mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '20140002984' ");  
        while($ulang=mysql_fetch_array($mencari1)){
        $target=$ulang[PassportValid];
        $tanggal = substr($target,8,2);
        $bulan = substr($target,5,2);
        $tahun = substr($target,0,4); 
        $batas= date('Y-m-d',strtotime('0 second',strtotime('-5 year',strtotime(date($bulan).'/'.date($tanggal).'/'.date($tahun).' 00:00:00')))); 
        //echo"$ulang[PassportValid] - $batas <br>";
        
        //echo"$ulang[BookingID]</br>";}
        mysql_query("UPDATE tour_msbookingdetail set PassportIssuedDate = '$batas'
                                                       WHERE IDDetail = '$ulang[IDDetail]'");
       */ 
//update msdetail
        /*$mencari1=mysql_query("SELECT IDProduct FROM tour_msproduct WHERE tour_msproduct.IDProduct NOT IN (select IDProduct from tour_msdetail)");  
        while($ulang=mysql_fetch_array($mencari1)){
            //echo"$ulang[IDProduct]<br>";
            mysql_query("INSERT INTO tour_msdetail(IDProduct) 
                            VALUES ('$ulang[IDProduct]')"); 
        } */
//update ID bookingdetail
       /* $mencari1=mysql_query("SELECT tour_msbooking.BookingID,tour_msbooking.IDTourcode FROM tour_msbooking 
                                left join tour_msbookingdetail on tour_msbookingdetail.BookingID = tour_msbooking.BookingID
                                WHERE tour_msbookingdetail.IDTourcode='0' group by tour_msbooking.BookingID");  
        while($ulang=mysql_fetch_array($mencari1)){
            echo"$ulang[BookingID]<br>";
           // mysql_query("UPDATE tour_msbookingdetail set IDTourcode = '$ulang[IDTourcode]'
           //                                            WHERE BookingID = '$ulang[BookingID]'");
        } */
        // trim
        /*$mencari1=mysql_query("SELECT * FROM tour_msbookingdetail");
        while($ulang=mysql_fetch_array($mencari1)){
            $PassNo1=strtoupper($ulang[PassportNo]);
            $PassNo2=str_replace(" ","", $PassNo1);
            $PassNo=trim($PassNo2);              
            mysql_query("UPDATE tour_msbookingdetail set PassportNo = '$PassNo'
                                                       WHERE IDDetail = '$ulang[IDDetail]'");
        }
$sqlreg=mysql_query("SELECT * from tbl_msemployee WHERE StatusTL='APPROVED' and employee_type='FREELANCE' and employee_email <>'' ");
while($userreg=mysql_fetch_array($sqlreg)){
$sqluser=mysql_query("SELECT * from tbl_msemployee WHERE employee_code='$userreg[employee_code]'");
$tampiluser=mysql_fetch_array($sqluser);
$useremail=$tampiluser[employee_email];
$usercode=$tampiluser[employee_code];
$userpassport=$tampiluser[NameAsPassport];
$userstatus=$tampiluser[StatusTL];
$userpass=$tampiluser[StatusTL];
    $message = "\n";
    $message .= "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">"."\n";
    $message .= "<html>"."\n";
    $message .= "<head>"."\n";
    $message .= "</head>"."\n";
    $message .= '<body bgcolor="#FFFFFF" text="#333333" style="background-color: #FFFFFF; margin-bottom : 0px; margin-left : 0px; margin-top : 0px; margin-right : 0px;">
                <table style="font-size: 10px; font-family: verdana; color: #ffffff; width: 700px;" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
                <tbody>
                <tr>
                <style type="text/css">
                body, table, td, p { font-size: 14px; }
                img { border: 0px; }
                p { margin: 10px 0px; line-height: 237% }
                </style>
                </tr>
                <tr>
                  <td colspan="2"style="padding: 40px; color: #333333">
                  <h1>Dear LTM Division,</h1>
                        <p style="font-size: 13px; line-height: 237%">Terima Kasih untuk memilih Panorama Tours sebagai partner berpetualang Anda.</p>
                        <p style="font-size: 13px; line-height: 237%">Request Anda sudah terkirim dengan <strong>TMR NO '.$inqid.'-1</strong></p>
                        <table style="font-size: 13px; font-family: verdana; color: #333333; width: 600px;" border="0" cellspacing="1" cellpadding="4" align="center" bgcolor="#FFFFFF">
                            <tr><td style="background-color: #eee; font-weight: bold;">Keterangan</td>    <td style="background-color: #eee; font-weight: bold;">Jumlah</td>    <td style="background-color: #eee; font-weight: bold; width: 150px;">Subtotal</td></tr>
                            <tr><td style="background-color: #eee;">'.$dealname.'</td>    <td style="background-color: #eee; text-align: center;">'.$qty.'</td>    <td style="background-color: #eee;">Rp '.$price.'</td></tr>
                            <tr><td style="background-color: #eee;">Kode Pembayaran</td>    <td style="background-color: #eee;"></td>    <td style="background-color: #eee;">'.$nmr.'</td></tr>
                            <tr><td colspan="2" style="background-color: #eee; font-size: 16px;"><strong>Yang Harus Dibayarkan</strong></td>    <td style="background-color: #eee; font-size: 16px; text-align: right;"><strong>Rp '.number_format(($ttlprice + $nmr),2,',','.').'</strong></td></tr>
                        </table>
                  </td>
                </tr>

              </tbody>
            </table>
            <p><small>Email ini dikirim oleh .</small></p>
            </body>';
    $message .= "</HTML>"."\n";
    $message .= "\n";
    $to= "ferry_budiono@panorama-tours.com" ;
    $subject = "TMR Request from $_POST[productfor] ";
    $headers  = "MIME-Version: 1.0 \n";
    $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
    $headers .= "From: Panorama Web System <noreply@panoramawebsys.com> \n";
    $headers .= "Reply-To: noreply@panoramawebsys.com \r\n";
    $headers .= "Return-Path: noreply@panoramawebsys.com\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
     mail($to, $subject, $message, $headers);
    echo"SEND";*/

//update xtra disc pameran
/*$pameran = mysql_query("SELECT * FROM tour_marketing where MarketingID = '72' ");
$discp = mysql_fetch_array($pameran);
$mencari1=mysql_query("SELECT * FROM tour_msbooking WHERE `BookingPlace`='72' and `Status` <>'VOID' and `FBTNo`='' and `TBFNo`='' ");
while($ulang=mysql_fetch_array($mencari1)){
    $mencari2=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct='$ulang[IDTourcode]' ");
    $dapet=mysql_fetch_array($mencari2);

    if($dapet[Company]=='PANORAMA TOURS' AND ($dapet[ProductCode]<>'CBD' OR $dapet[ProductCode]<>'CSD' OR $dapet[ProductCode]<>'MCD' OR $dapet[ProductCode]<>'HKZ' OR $dapet[ProductCode]<>'TZD') ){
        //cek low high season
        if($dapet[SeasonType]=='LOW'){
            if($dapet[SellingCurr]== $discp[XtraDiscCurr]){
                $discpameran=$discp[XtraDisc];
            }else {
                $discpameran=0;
            }
        }else if($dapet[SeasonType]=='HIGH'){
            if($dapet[SellingCurr]== $discp[XtraDiscCurr2]){
                $discpameran=$discp[XtraDisc2];
            }else {
                $discpameran=0;
            }
        }
    }else if($dapet[Company]=='TUR EZ'){
        $discpameran=0;
    }
    $subtotal = $dapet[SellingAdlTwn] - $discpameran;
    mysql_query("UPDATE tour_msbookingdetail set Discount = '$discpameran',
                                                 SubTotal = '$subtotal',
                                                 Status = '$discpameran'
                                                       WHERE BookingID = '$ulang[BookingID]' AND Discount='0'");
    $isitot = mysql_query("SELECT sum(SubTotal)as jumtot FROM tour_msbookingdetail WHERE BookingID = '$ulang[BookingID]'");
    $tot = mysql_fetch_array($isitot);
    mysql_query("UPDATE tour_msbooking set  TotalPrice = '$tot[jumtot]'
                                                WHERE BookingID = '$ulang[BookingID]'");

}*/
//update booking detail status
/*$mencari1=mysql_query("SELECT * FROM tour_msbooking WHERE Status = 'VOID' and Year = '2015'");
        while($ulang=mysql_fetch_array($mencari1)){
        
        mysql_query("UPDATE tour_msbookingdetail set Status = 'CANCEL'
                                                        WHERE BookingID = '$ulang[BookingID]'");       
        }*/

//hapus xtra disc pameran
/*$pameran = mysql_query("SELECT * FROM tour_marketing where MarketingID = '72' ");
$discp = mysql_fetch_array($pameran);
$mencari1=mysql_query("SELECT * FROM tour_msbooking WHERE `BookingPlace`<>'' and IDTourcode = '7307' and `Status` <>'VOID' and `FBTNo`='' and `TBFNo`='' ");
while($ulang=mysql_fetch_array($mencari1)){
    $mencari2=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct='$ulang[IDTourcode]' ");
    $dapet=mysql_fetch_array($mencari2);

    if($dapet[Company]=='PANORAMA TOURS' AND ($dapet[ProductCode]<>'CBD' OR $dapet[ProductCode]<>'CSD' OR $dapet[ProductCode]<>'MCD' OR $dapet[ProductCode]<>'HKZ' OR $dapet[ProductCode]<>'TZD') ){
        //cek low high season
        if($dapet[SeasonType]=='LOW'){
            if($dapet[SellingCurr]== $discp[XtraDiscCurr]){
                $discpameran=$discp[XtraDisc];
            }else {
                $discpameran=0;
            }
        }else if($dapet[SeasonType]=='HIGH'){
            if($dapet[SellingCurr]== $discp[XtraDiscCurr2]){
                $discpameran=$discp[XtraDisc2];
            }else {
                $discpameran=0;
            }
        }
    }else if($dapet[Company]=='TUR EZ'){
        $discpameran=0;
    }
    $subtotal = $dapet[SellingAdlTwn] + $discpameran;
    mysql_query("UPDATE tour_msbookingdetail set Discount = '$discpameran',
                                                 SubTotal = '$subtotal',
                                                 Status = '$discpameran'
                                                       WHERE BookingID = '$ulang[BookingID]' AND Discount='0'");
    $isitot = mysql_query("SELECT sum(SubTotal)as jumtot FROM tour_msbookingdetail WHERE BookingID = '$ulang[BookingID]'");
    $tot = mysql_fetch_array($isitot);
    mysql_query("UPDATE tour_msbooking set  TotalPrice = '$tot[jumtot]'
                                                WHERE BookingID = '$ulang[BookingID]'");

}*/

//hapus xtra disc TUR EZ
/*$pameran = mysql_query("SELECT * FROM tour_marketing where MarketingID = '72' ");
$discp = mysql_fetch_array($pameran);
$mencari1=mysql_query("SELECT * FROM tour_msproduct
                        left join tour_msbooking on tour_msbooking.IDTourcode = tour_msproduct.IDProduct
                        WHERE `Company`='TUR EZ' and tour_msproduct.Status <> 'VOID' and tour_msbooking.Status = 'ACTIVE' and BookingPlace <>''");
while($ulang=mysql_fetch_array($mencari1)){
    //mencari bookingan
    /*$mencari2=mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID='$ulang[BookingID]' and Discount <> '0' AND Status <>'CANCEL'");
    while($dapet=mysql_fetch_array($mencari2)){
    echo"ID:$dapet[IDDetail], BookingID:$dapet[BookingID], Price:$dapet[Price], Disc:$dapet[Discount]<br>";
        $price=$dapet[Price]+$dapet[Discount];
        mysql_query("UPDATE tour_msbookingdetail set Discount = '0',
                                                     Price = '$price',
                                                     SubTotal = '$price',
                                                     Status = '0'
                                               WHERE IDDetail = '$dapet[IDDetail]'");

        $isitot = mysql_query("SELECT sum(SubTotal)as jumtot FROM tour_msbookingdetail WHERE BookingID = '$dapet[BookingID]'");
        $tot = mysql_fetch_array($isitot);
        mysql_query("UPDATE tour_msbooking set  TotalPrice = '$tot[jumtot]'
                                                    WHERE BookingID = '$dapet[BookingID]'");*/
    //merubah tbf bookingan
        /*$mencari2=mysql_query("SELECT * FROM tour_fbtbookingdetail WHERE BookingID='$ulang[BookingID]' and Discount = '20' AND Status <>'CANCEL'");
        while($dapet=mysql_fetch_array($mencari2)){
            echo"ID:$dapet[IDDetail], BookingID:$dapet[BookingID], Price:$dapet[Price], Disc:$dapet[Discount]<br>";
            $price=$dapet[Price]+$dapet[Discount];
            mysql_query("UPDATE tour_fbtbookingdetail set Discount = '0',
                                                         Price = '$price',
                                                         SubTotal = '$price',
                                                         Status = '0'
                                                   WHERE IDDetail = '$dapet[IDDetail]'");

            $isitot = mysql_query("SELECT sum(SubTotal)as jumtot FROM tour_fbtbookingdetail WHERE BookingID = '$dapet[BookingID]'");
            $tot = mysql_fetch_array($isitot);
            mysql_query("UPDATE tour_fbtbooking set  TotalPrice = '$tot[jumtot]'
                                                        WHERE BookingID = '$dapet[BookingID]'");*/
//    }
//}

//update voucher no
/*$hari= date("Y", time());
$s=1;
$mencari1=mysql_query("SELECT * FROM `tour_voucherpromo` WHERE `Location`='' and `Print`='0' and (`VoucherStatus` <> 'VOID' or `VoucherStatus` ='REJECT') order by VoucherID ASC");
while($ulang=mysql_fetch_array($mencari1)){
$tampilv = mysql_query("SELECT * FROM tour_voucherpromo where Location = 'EXHIBITION' and (`VoucherStatus` <> 'VOID' or `VoucherStatus` <>'REJECT')
                ORDER BY VoucherID DESC limit 1");
    $hasilv = mysql_fetch_array($tampilv);
    $jumlahv = mysql_num_rows($tampilv);
    $tahunv = substr($hasilv[VoucherNo],4,4);

    if($jumlahv > 0){
        if($hari==$tahunv){
            $tahun1v = $hari;
            $tiketv=substr($hasilv[VoucherNo],9,7)+1;
            switch ($tiketv){
                case ($tiketv<10):
                    $tiket1v = "000000".$tiketv;
                    break;
                case ($tiketv>9 && $tiketv<100):
                    $tiket1v = "00000".$tiketv;
                    break;
                case ($tiketv>99 && $tiketv<1000):
                    $tiket1v = "0000".$tiketv;
                    break;
                case ($tiketv>999 && $tiketv<10000):
                    $tiket1v = "000".$tiketv;
                    break;
                case ($tiketv>9999 && $tiketv<100000):
                    $tiket1v = "00".$tiketv;
                    break;
                case ($tiketv>99999 && $tiketv<1000000):
                    $tiket1v = "0".$tiketv;
                    break;
            }
        } else if ($hari > $tahunv) {
            $tahun1v = $hari;
            $tiket1v="0000001";
        }
    }else {
        $tahun1v = $hari;
        $tiket1v="0000001";
    }
    echo"$s EXH/$tahun1v$tiket1v <br>";
    $s++;
mysql_query("UPDATE tour_voucherpromo set VoucherNo = 'EXH/$tahun1v$tiket1v' , Location='EXHIBITION'
                                                       WHERE VoucherID = '$ulang[VoucherID]' ");
mysql_query("UPDATE tour_msbookingdetail set VoucherNo = 'EXH/$tahun1v$tiket1v'
                                                       WHERE BookingID = '$ulang[BookingID]' AND VoucherNo = '$ulang[Voucher]'");
}*/
?>