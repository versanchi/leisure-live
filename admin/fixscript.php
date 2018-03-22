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
//include "../config/koneksihrd.php";
//include "../config/koneksimaster.php";
//update seat deposit

/*$mencari1=mysql_query("SELECT * FROM tour_msproduct WHERE Status <> 'VOID' AND DateTravelFrom >='2017-03-22' and DateTravelFrom <='2017-04-22'");
        while($ulang=mysql_fetch_array($mencari1)){
        $caribook=mysql_query("SELECT count(IDDetail) as totbuking FROM tour_msbookingdetail WHERE IDTourcode = '$ulang[IDProduct]' and Gender <> 'INFANT' and Status <> 'CANCEL'");  
        $kebook=mysql_fetch_array($caribook);
        $seatdeplast = $kebook[totbuking];
        $seatsisalast = $ulang[Seat] - $seatdeplast;
        if($ulang[SeatDeposit]<>$seatdeplast){echo"$ulang[IDProduct]</br>";}
        mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdeplast',
                                                        SeatSisa='$seatsisalast'
                                                        WHERE IDProduct = '$ulang[IDProduct]'");

        }

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
/*$pameran = mysql_query("SELECT * FROM tour_marketing where MarketingID = '74' ");
$discp = mysql_fetch_array($pameran);*/
/*include "../config/koneksifabs.php";
$qpromodayall = mysql_query("SELECT * FROM tbl_exhibition where ExhibitionID='218'");//Type = 'INHOUSE' and StartDate <= '$today' and EndDate >= '$today' and InhouseBSO = 'ALL' AND Status ='ACTIVE' AND StatusExh ='FIX' ");
$adainhouseall = mysql_num_rows($qpromodayall);
$promoday = mysql_fetch_array($qpromodayall);
if($promoday[Branch]=='ALL'){
    if($promoday[Area]=='ALL'){
        $incinhouse='yes';$exibition=$promoday[ExhibitionID];
    }elseif($promoday[Area]==$_SESSION[district]){
        $incinhouse='yes';$exibition=$promoday[ExhibitionID];
    }else{
        $incinhouse='no';$exibition='';
    }
}elseif($promoday[Branch]==$_SESSION[company_group]){
    if($promoday[Area]=='ALL'){
        $incinhouse='yes';$exibition=$promoday[ExhibitionID];
    }elseif($promoday[Area]==$_SESSION[district]){
        $incinhouse='yes';$exibition=$promoday[ExhibitionID];
    }else{
        $incinhouse='no';$exibition='';
    }
}else{
    $incinhouse='no';$exibition='';
}
mysql_close($dbfabs);
include "../config/koneksi.php";
$mencari1=mysql_query("SELECT * FROM tour_msbooking WHERE DATE(BookingDate)='2017-04-16' and `Status` <>'VOID' ");
while($ulang=mysql_fetch_array($mencari1)){
    $mencari2=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct='$ulang[IDTourcode]' ");
    $dapet=mysql_fetch_array($mencari2);

    if ($dapet[CompanyID] == '1'  AND $dapet[ShockingOffer] <> 'YES' AND ($dapet[GroupType] == 'MINISTRY' OR $dapet[GroupType] == 'SERIES')) {
                if($promoday[DiscountCategory]=='SEASON') {
                    //cek low high season
                    if ($dapet[SeasonType] == 'LOW') {
                        if ($dapet[SellingCurr] == $promoday[XtraDiscCurr]) {
                            $discpromoday = $promoday[XtraDisc];
                        } else {
                            $discpromoday = 0;
                        }
                    } else if ($dapet[SeasonType] == 'HIGH') {
                        if ($dapet[SellingCurr] == $promoday[XtraDiscCurr2]) {
                            $discpromoday = $promoday[XtraDisc2];
                        } else {
                            $discpromoday = 0;
                        }
                    }
                }else if($promoday[DiscountCategory]=='PRODUCT'){
                    if($promoday[Product]=='ALL'){
                        $discpromoday = $promoday[XtraDiscProd];
                    }else if($promoday[Product]=='SELECTED'){
                        include "../config/koneksifabs.php";
                        $cariprod=mysql_query("SELECT * FROM tbl_exhibition_tourcode where ExhibitionID = '$promoday[ExhibitionID]' AND IDProduct = '$_POST[idproduct]'");
                        $dptprod=mysql_num_rows($cariprod);
                        mysql_close($dbfabs);
                        include "../config/koneksi.php";
                        if($dptprod>0){
                            $discpromoday = $promoday[XtraDiscProd];
                        }else{
                            $discpromoday = 0;
                        }
                    }
                }
            } else {
                $discpromoday = 0;
            }
    //$discpameran=150000;
    $mencaridata=mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$ulang[BookingID]' ");

    while($ulangdata=mysql_fetch_array($mencaridata)){

    //update booking detail
    $cariadd = mysql_query("SELECT AddDiscount,Discount FROM tour_msbookingdetail WHERE IDDetail = '$ulangdata[IDDetail]'");
    $add = mysql_fetch_array($cariadd);
    //pameran $dis = $discpameran + $add[Discount];
    $dis = $add[Discount];
    //pameran $subtotal = $dapet[SellingAdlTwn] - $dis; //$discpameran - $add[AddDiscount];
        $subtotal1 = $dapet[SellingAdlTwn] - $dis;
        $subtotal = $subtotal1-$discpromoday;
    mysql_query("UPDATE tour_msbookingdetail set Discount = '$dis',
                                                 AddDiscount = '$discpromoday',
                                                 SubTotal = '$subtotal',
                                                 Status = '$discpameran'
                                           WHERE IDDetail = '$ulangdata[IDDetail]'");


    }
    /*$mencaridata1=mysql_query("SELECT * FROM tour_tbfbookingdetail WHERE BookingID = '$ulang[BookingID]' ");
    while($ulangdata1=mysql_fetch_array($mencaridata1)){
        //update TBF booking detail
        $caritbf = mysql_query("SELECT AddDiscount,Discount FROM tour_tbfbookingdetail WHERE IDDetail = '$ulangdata1[IDDetail]'");
        $tbf = mysql_fetch_array($caritbf);
        $distbf = $discpameran + $tbf[Discount];
            $subtotaltbf = $dapet[SellingAdlTwn] - $distbf;//$discpameran - $tbf[AddDiscount];
            mysql_query("UPDATE tour_tbfbookingdetail set Discount = '$distbf',
                                                     SubTotal = '$subtotaltbf',
                                                     Status = '$discpameran'
                                               WHERE IDDetail = '$ulangdata1[IDDetail]'");

    }
    $mencaridata2=mysql_query("SELECT * FROM tour_fbtbookingdetail WHERE BookingID = '$ulang[BookingID]' ");
    while($ulangdata2=mysql_fetch_array($mencaridata2)){
        //update FBT booking detail
        $carifbt = mysql_query("SELECT AddDiscount,Discount FROM tour_fbtbookingdetail WHERE IDDetail = '$ulangdata2[IDDetail]'");
        $fbt = mysql_fetch_array($carifbt);
        $disfbt = $discpameran + $fbt[Discount];
        $subtotalfbt = $dapet[SellingAdlTwn] - $disfbt;//$discpameran - $fbt[AddDiscount];
        mysql_query("UPDATE tour_fbtbookingdetail set Discount = '$disfbt',
                                                 SubTotal = '$subtotalfbt',
                                                 Status = '$discpameran'
                                                       WHERE IDDetail = '$ulangdata2[IDDetail]'");
    }

    $isitot = mysql_query("SELECT sum(SubTotal)as jumtot FROM tour_msbookingdetail WHERE BookingID = '$ulang[BookingID]'");
    $tot = mysql_fetch_array($isitot);
    mysql_query("UPDATE tour_msbooking set  TotalPrice = '$tot[jumtot]'
                                                WHERE BookingID = '$ulang[BookingID]'");
    $isitbf = mysql_query("SELECT sum(SubTotal)as jumtot FROM tour_tbfbookingdetail WHERE BookingID = '$ulang[BookingID]'");
    $tottbf = mysql_fetch_array($isitbf);
    mysql_query("UPDATE tour_tbfbooking set  TotalPrice = '$tottbf[jumtot]'
                                                WHERE BookingID = '$ulang[BookingID]'");
    $isifbt = mysql_query("SELECT sum(SubTotal)as jumtot FROM tour_fbtbookingdetail WHERE BookingID = '$ulang[BookingID]'");
    $totfbt = mysql_fetch_array($isifbt);
    mysql_query("UPDATE tour_fbtbooking set TotalPrice = '$totfbt[jumtot]'
                                                WHERE BookingID = '$ulang[BookingID]'");
*/
//}
//update booking detail status
/*$mencari1=mysql_query("SELECT * FROM tour_msbooking WHERE Status = 'VOID' and Year = '2017'");
        while($ulang=mysql_fetch_array($mencari1)){
        
        mysql_query("UPDATE tour_msbookingdetail set Status = 'CANCEL'
                                                        WHERE BookingID = '$ulang[BookingID]'");       
        }
*/
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
$discp = mysql_fetch_array($pameran);*/

/*$mencari1=mysql_query("SELECT * FROM tour_msproduct
                        left join tour_msbooking on tour_msbooking.IDTourcode = tour_msproduct.IDProduct
                        WHERE IDTourcode='18329' and tour_msproduct.Status <> 'VOID' and tour_msbooking.Status = 'ACTIVE' and BookingPlace <>''");*/
/*$mencari1=mysql_query("SELECT * FROM tour_msproduct
                            left join tour_msbooking on tour_msbooking.IDTourcode = tour_msproduct.IDProduct 
                            WHERE tour_msproduct.ShockingOffer='YES' and tour_msproduct.Status <> 'VOID' 
                            and tour_msbooking.Status = 'ACTIVE' and BookingPlace <>'' and tour_msproduct.DateTravelFrom >='2017-04-10'");
while($ulang=mysql_fetch_array($mencari1)) {
    //mencari bookingan
    $mencari2 = mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID='$ulang[BookingID]' AND Status <>'CANCEL' AND Price <> '0.00'  ");
    while ($dapet = mysql_fetch_array($mencari2)) {
        echo "ID:$dapet[IDDetail], BookingID:$dapet[BookingID], Price:$dapet[Price], Disc:$dapet[Discount]<br>";
        $price = $dapet[PriceInvoice] ;//+ $dapet[Discount];
        mysql_query("UPDATE tour_msbookingdetail set Discount = '0',
                                                     Price = '$ulang[SellingAdlTwn]',
                                                     SubTotal = '$ulang[SellingAdlTwn]',
                                                     Status = '0'
                                               WHERE IDDetail = '$dapet[IDDetail]' and Gender ='ADULT'");

            mysql_query("UPDATE tour_msbookingdetail set Discount = '0',
                                                     Price = '$ulang[SellingChdTwn]',
                                                     SubTotal = '$ulang[SellingChdTwn]',
                                                     Status = '0'
                                               WHERE IDDetail = '$dapet[IDDetail]' and RoomType='Twin' and Gender ='CHILD'");

            mysql_query("UPDATE tour_msbookingdetail set Discount = '0',
                                                     Price = '$ulang[SellingChdNbed]',
                                                     SubTotal = '$ulang[SellingChdNbed]',
                                                     Status = '0'
                                               WHERE IDDetail = '$dapet[IDDetail]' and RoomType='No Bed' and Gender ='CHILD'");

        $isitot = mysql_query("SELECT sum(SubTotal)as jumtot FROM tour_msbookingdetail WHERE BookingID = '$dapet[BookingID]'");
        $tot = mysql_fetch_array($isitot);
        mysql_query("UPDATE tour_msbooking set  TotalPrice = '$tot[jumtot]'
                                                    WHERE BookingID = '$dapet[BookingID]'");
    }*/
        //merubah tbf bookingan*/
        /*$mencari3 = mysql_query("SELECT * FROM tour_fbtbookingdetail WHERE BookingID='$ulang[BookingID]' and Price AND Status <>'CANCEL' AND Price<>'0.00' and PriceInvoice<>'0.00' ");
        while ($dapet3 = mysql_fetch_array($mencari3)) {
            echo "ID:$dapet3[IDDetail], BookingID:$dapet3[BookingID], Price:$dapet3[Price], Disc:$dapet3[Discount]<br>";
            $price3 = $dapet3[PriceInvoice] ;//+ $dapet3[Discount];
            mysql_query("UPDATE tour_fbtbookingdetail set Discount = '0',
                                                         Price = '$price3',
                                                         SubTotal = '$price3',
                                                         Status = '0'
                                                   WHERE IDDetail = '$dapet3[IDDetail]'");

            $isitot3 = mysql_query("SELECT sum(SubTotal)as jumtot FROM tour_fbtbookingdetail WHERE BookingID = '$dapet3[BookingID]'");
            $tot3 = mysql_fetch_array($isitot3);
            mysql_query("UPDATE tour_fbtbooking set  TotalPrice = '$tot3[jumtot]'
                                                        WHERE BookingID = '$dapet3[BookingID]'");
        }*/

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

//update productuse msgrv
/*$mencari1=mysql_query("SELECT *,COUNT(*)as produse FROM tour_msproductpnr group by GrvID");
        while($ulang=mysql_fetch_array($mencari1)){

        mysql_query("UPDATE tour_msgrv set ProductUse = '$ulang[produse]'
                                                        WHERE IDGrv = '$ulang[GrvID]'");
        }*/

//menghapus productpnr yg product sudah void
/*$mencari1=mysql_query("select * FROM `tour_msproductpnr`
inner join `tour_msproduct` on `tour_msproduct`.IDProduct = `tour_msproductpnr`.PnrProd
WHERE `tour_msproduct`.Status = 'VOID'");
while($ulang=mysql_fetch_array($mencari1)){
    echo"$ulang[PnrID] <br>";
    mysql_query("DELETE FROM `zadmin_dbvisa`.`tour_msproductpnr` WHERE `tour_msproductpnr`.`PnrID` = $ulang[PnrID] ");
}*/

//merubah currency ke IDR yg blm ada bookingan
/*$mencari1=mysql_query("select * FROM `tour_msproduct`
WHERE `DateTravelFrom`>='2015-07-01' AND SellingCurr<>'IDR'");
while($ulang=mysql_fetch_array($mencari1)){
    $mencari2=mysql_query("select * FROM `tour_msbooking`
    WHERE `IDTourcode`='$ulang[IDProduct]'");
    $adabok=mysql_num_rows($mencari2);
    if($adabok==0){
        /*mysql_query("UPDATE `tour_agent` SET `SellingCurrA`='IDR',`SellingOperatorA`='*',`SellingRateA`='1',`QuoAdultA`='0.00',
        `SellAdultA`='0.00',`QuoChdTwnA`='0.00',`SellChdTwnA`='0.00',`QuoChdXbedA`='0.00',`SellChdXbedA`='0.00',
        `QuoChdNbedA`='0.00',`SellChdNbedA`='0.00',`SellingCurrB`='IDR',
        `SellingOperatorB`='*',`SellingRateB`='1',`QuoAdultB`='0.00',`SellAdultB`='0.00',
        `QuoChdTwnB`='0.00',`SellChdTwnB`='0.00',`QuoChdXbedB`='0.00',`SellChdXbedB`='0.00',`QuoChdNbedB`='0.00',
        `SellChdNbedB`='0.00',`SellingCurrC`='IDR',`SellingOperatorC`='*',
        `SellingRateC`='1',`QuoAdultC`='0.00',`SellAdultC`='0.00',`QuoChdTwnC`='0.00',
        `SellChdTwnC`='0.00',`QuoChdXbedC`='0.00',`SellChdXbedC`='0.00',`QuoChdNbedC`='0.00',`SellChdNbedC`='0.00'
        WHERE `IDProduct` = '$ulang[IDProduct]'");

        mysql_query("UPDATE `tour_detail` SET `SellingCurr`='IDR',
        `SellingOperator`='*',`SellingRate`='1',`QuoAdult`='0.00',`SellAdult`='0.00',`QuoChd`='0.00',
        `SellChd`='0.00'
        WHERE `IDProduct`='$ulang[IDProduct]'");

        mysql_query("UPDATE `tour_msdetail` SET `TotalVar`='0.00',`TotalFixAdult`='0.00',
        `TotalFixChd`='0.00',`TotalAdultA`='0.00',`TotalChdTwnA`='0.00',
        `TotalChdXbedA`='0.00',`TotalChdNbedA`='0.00',`TotalAdultB`='0.00',
        `TotalChdTwnB`='0.00',`TotalChdXbedB`='0.00',`TotalChdNbedB`='0.00',
        `TotalAdultC`='0.00',`TotalChdTwnC`='0.00',`TotalChdXbedC`='0.00',`TotalChdNbedC`='0.00',
        `ProfAdultA`='0.00',`ProfChdTwnA`='0.00',`ProfChdXbedA`='0.00',`ProfChdNbedA`='0.00',`ProfAdultB`='0.00',
        `ProfChdTwnB`='0.00',`ProfChdXbedB`='0.00',`ProfChdNbedB`='0.00',`ProfAdultC`='0.00',`ProfChdTwnC`='0.00',
        `ProfChdXbedC`='0.00',`ProfChdNbedC`='0.00',`ComAdultA`='0.00',`ComChdTwnA`='0.00',`ComChdXbedA`='0.00',
        `ComChdNbedA`='0.00',`ComAdultB`='0.00',`ComChdTwnB`='0.00',`ComChdXbedB`='0.00',`ComChdNbedB`='0.00',
        `ComAdultC`='0.00',`ComChdTwnC`='0.00',`ComChdXbedC`='0.00',`ComChdNbedC`='0.00',`DiscAdultA`='0.00',
        `DiscChdTwnA`='0.00',`DiscChdXbedA`='0.00',`DiscChdNbedA`='0.00',`DiscAdultB`='0.00',`DiscChdTwnB`='0.00',
        `DiscChdXbedB`='0.00',`DiscChdNbedB`='0.00',`DiscAdultC`='0.00',`DiscChdTwnC`='0.00',`DiscChdXbedC`='0.00',
        `DiscChdNbedC`='0.00' WHERE `IDProduct`='$ulang[IDProduct]'");

        mysql_query("UPDATE `tour_msproduct` SET `TaxInsNett`='0.00',
        `TaxInsSell`='0.00',`LandArrNett`='0.00',`LandArrSell`='0.00',`SingleNett`='0.00',`SingleSell`='0.00',
        `VisaCurr`='IDR',`VisaNett`='0.00',`VisaSell`='0.00',`AirTaxCurr`='IDR',`AirTaxNett`='0.00',`AirTaxSell`='0.00',`SeaTaxCurr`='IDR',
        `SeaTaxNett`='0.00',`SeaTaxSell`='0.00',`QuotationCurr`='IDR',`SellingCurr`='IDR',`SellingOperator`='*',
        `SellingRate`='1',`SellingAdlTwn`='0.00',`SellingChdTwn`='0.00',`SellingChdXbed`='0.00',
        `SellingChdNbed`='0.00',`SellingInfant`='0.00',`LAAdlTwn`='0.00',`LAChdTwn`='0.00',`LAChdXbed`='0.00',
        `LAChdNbed`='0.00',`LAInfant`='0.00',`CruiseAdl12`='0.00',`CruiseAdl34`='0.00',`CruiseChd12`='0.00',
        `CruiseChd34`='0.00',`CruiseLoAdl12`='0.00',`CruiseLoAdl34`='0.00',`CruiseLoChd12`='0.00',
        `CruiseLoChd34`='0.00' WHERE `IDProduct`='$ulang[IDProduct]'");*/
        //mysql_query("UPDATE `tour_msproduct` SET `QuotationStatus`='REQUEST' WHERE `IDProduct`='$ulang[IDProduct]'");
        //echo"$ulang[IDProduct] ($adabok)<br>";
    //}
    //mysql_query("DELETE FROM `zadmin_dbvisa`.`tour_msproductpnr` WHERE `tour_msproductpnr`.`PnrID` = $ulang[PnrID] ");
//}
/*$mencari1=mysql_query("SELECT * FROM tour_msbooking where YEAR(BookingDate)='2013'");
while($ulang=mysql_fetch_array($mencari1)){
    mysql_query("UPDATE tour_msbookingdetail set Curr = '$ulang[Curr]'
                                                        WHERE BookingID = '$ulang[BookingID]'");
}*/

//update total price msbooking
/*$mencari=mysql_query("SELECT * FROM tour_msproduct WHERE MONTH(DateTravelFrom) = '07' and YEAR(DateTravelFrom) = '2015' and Status <> 'VOID'");
while($idtur=mysql_fetch_array($mencari)){
$mencari2=mysql_query("SELECT * FROM tour_msbooking WHERE IDTourcode = '$idtur[IDProduct]' and Status ='ACTIVE'");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){

    $isitot = mysql_query("SELECT sum(SubTotal)as jumtot,Curr,ExRate FROM tour_msbookingdetail WHERE BookingID = '$dapet[BookingID]'");
    $tot = mysql_fetch_array($isitot);
    mysql_query("UPDATE tour_msbooking set TotalPrice = '$tot[jumtot]',Curr='$tot[Curr]',exRate='$tot[ExRate]'
                                                WHERE BookingID = '$dapet[BookingID]'");
    echo"$a: BookingID:$dapet[BookingID]<br>";
    $a++;
    }
}*/
//update status tipping
/*$mencari2=mysql_query("SELECT * FROM tour_msproduct WHERE YEAR(DateTravelFrom) > '2013'");
while($dapet=mysql_fetch_array($mencari2)){
    //if($dapet[ProductTipping]=='0' OR $dapet[ProductTipping]==''){
    $gab="$dapet[ProductTippingCurr]. $dapet[ProductTipping]";
        mysql_query("UPDATE tour_msproduct set  ProductTipping = '$gab'
                                                WHERE IDProduct = '$dapet[IDProduct]'");
    }else{
        mysql_query("UPDATE tour_msproduct set  ProductTippingStatus = 'notinclude'
                                                WHERE IDProduct = '$dapet[IDProduct]'");
    }
    }*/

//export CSR to PTES
/*$hari= date("Y", time());
$tahun1 = "2015";
$tiket1 = "0000006";
$compid = '1';

$QBookExh=mysql_query("SELECT tour_CashReceipt.*,tour_CashReceipt.IndexCashReceiptHeader as inheader FROM tour_CashReceipt
                                INNER JOIN tour_CashReceipt_Payment ON tour_CashReceipt_Payment.CashReceiptId=tour_CashReceipt.CashReceiptId
                                WHERE tour_CashReceipt.CompanyID='1' and ExhibitionID='100' and (DCRID IS NULL OR DCRID ='')
                                and Day(`Date`)='27' AND ReportDate='2015-09-30 10:19:26'
                                ORDER BY tour_CashReceipt.IndexCashReceiptHeader DESC");
$jcsr=mysql_num_rows($QBookExh);
while($isic=mysql_fetch_array($QBookExh)){
    mysql_query("UPDATE tour_CashReceipt SET StatusReport = '20150000006',DCRID = '20150000006'
                               WHERE IndexCashReceiptHeader = '$isic[IndexCashReceiptHeader]' ");
    echo"$isic[IndexCashReceiptHeader]";
}

//export to PTES
$qstart = mysql_query("SELECT * FROM tour_CashReceipt where StatusReport = '20150000006' and CompanyID='$compid'
                AND ReportDate='2015-09-30 10:19:26' ORDER BY IndexCashReceiptHeader ASC");
//$qstart = mysql_query("SELECT * FROM tour_CashReceipt where IndexCashReceiptHeader = '32' ");
while($isi=mysql_fetch_array($qstart)){
    if($isi[StatusVoid]==1){
        mssql_query("INSERT INTO [PTES].[dbo].[CashReceipt](CashReceiptId,
                                                        Date,
                                                        ClientNo,
                                                        ClientName,
                                                        BOSOID,
                                                        Currency,
                                                        TotalAmount,
                                                        StatusVoid,
                                                        VoidReason,
                                                        WhoVoid,
                                                        DateVoid,
                                                        StatusPrinted,
                                                        Duplicate,
                                                        Status,
                                                        CreateBy,
                                                        CreateDate,
                                                        LastBy,
                                                        LastDate,
                                                        DCRID,
                                                        LTMBookingID,
                                                        CompanyID)
                                                VALUES ('$isi[CashReceiptId]',
                                                        '$isi[Date]',
                                                        '$isi[ClientNo]',
                                                        '$isi[ClientName]',
                                                        '$isi[BOSOID]',
                                                        '$isi[Currency]',
                                                        $isi[TotalAmount],
                                                        '$isi[StatusVoid]',
                                                        '$isi[VoidReason]',
                                                        '$isi[WhoVoid]',
                                                        '$isi[DateVoid]',
                                                        '$isi[StatusPrinted]',
                                                        '$isi[Duplicate]',
                                                        '$isi[Status]',
                                                        '$isi[CreateBy]',
                                                        '$isi[CreateDate]',
                                                        '$isi[LastBy]',
                                                        '$isi[LastDate]',
                                                        '$isi[DCRID]',
                                                        '$isi[LTMBookingID]',
                                                        '$isi[CompanyID]')");
    }else{
        mssql_query("INSERT INTO [PTES].[dbo].[CashReceipt](CashReceiptId,
                                                        Date,
                                                        ClientNo,
                                                        ClientName,
                                                        BOSOID,
                                                        Currency,
                                                        TotalAmount,
                                                        StatusVoid,
                                                        StatusPrinted,
                                                        Duplicate,
                                                        Status,
                                                        CreateBy,
                                                        CreateDate,
                                                        LastBy,
                                                        LastDate,
                                                        DCRID,
                                                        LTMBookingID,
                                                        CompanyID)
                                                VALUES ('$isi[CashReceiptId]',
                                                        '$isi[Date]',
                                                        '$isi[ClientNo]',
                                                        '$isi[ClientName]',
                                                        '$isi[BOSOID]',
                                                        '$isi[Currency]',
                                                        $isi[TotalAmount],
                                                        '$isi[StatusVoid]',
                                                        '$isi[StatusPrinted]',
                                                        '$isi[Duplicate]',
                                                        '$isi[Status]',
                                                        '$isi[CreateBy]',
                                                        '$isi[CreateDate]',
                                                        '$isi[LastBy]',
                                                        '$isi[LastDate]',
                                                        '$isi[DCRID]',
                                                        '$isi[LTMBookingID]',
                                                        '$isi[CompanyID]')");
    }
    $qstart2 = mysql_query("SELECT * FROM tour_CashReceipt_Payment where CashReceiptId = '$isi[CashReceiptId]'
                                     ORDER BY IndexCashReceiptPayment ASC");
    $isi2=mysql_fetch_array($qstart2);
    $qcariindex = mssql_query("SELECT * FROM [PTES].[dbo].[CashReceipt] where CashReceiptId = '$isi[CashReceiptId]' AND CompanyID ='$compid'");
    $index=mssql_fetch_array($qcariindex);
    mssql_query("INSERT INTO [PTES].[dbo].[CashReceipt_Payment](CashReceiptId,
                                                                IndexCashReceiptHeader,
                                                                Urut,
                                                                TypePayment,
                                                                Remarks,
                                                                Currency,
                                                                Amount,
                                                                BankCharges,
                                                                AmountReal,
                                                                CreateBy,
                                                                CreateDate,
                                                                LastBy,
                                                                LastDate)
                                                        VALUES ('$isi2[CashReceiptId]',
                                                                '$index[IndexCashReceiptHeader]',
                                                                '$isi2[Urut]',
                                                                '$isi2[TypePayment]',
                                                                '$isi2[Remarks]',
                                                                '$isi2[Currency]',
                                                                $isi2[Amount],
                                                                $isi2[BankCharges],
                                                                $isi2[AmountReal],
                                                                '$isi2[CreateBy]',
                                                                '$isi2[CreateDate]',
                                                                '$isi2[LastBy]',
                                                                '$isi2[LastDate]')");
}
*/
//update Title Umur
/*$mencari1=mysql_query("SELECT * FROM tour_msbookingdetail WHERE Age <> ''");
        while($ulang=mysql_fetch_array($mencari1)){
        if($ulang[Gender]=='INFANT'){$title=" Month";}else{$title=" Years";}
        $angka=substr($ulang[Age],0,2);
        $umur="$angka$title";
        mysql_query("UPDATE tour_msbookingdetail set Age = '$umur'
                                                        WHERE IDDetail = '$ulang[IDDetail]'");
        }*/

//update pax msbooking
/*$mencari2=mysql_query("SELECT * FROM tour_msbooking WHERE IDTourcode = '$idtur[IDProduct]' and Status ='ACTIVE'");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){

    $isitot = mysql_query("SELECT sum(SubTotal)as jumtot,Curr,ExRate FROM tour_msbookingdetail WHERE BookingID = '$dapet[BookingID]'");
    $tot = mysql_fetch_array($isitot);
    mysql_query("UPDATE tour_msbooking set TotalPrice = '$tot[jumtot]',Curr='$tot[Curr]',exRate='$tot[ExRate]'
                                                WHERE BookingID = '$dapet[BookingID]'");
    echo"$a: BookingID:$dapet[BookingID]<br>";
    $a++;
}*/

//update telpon msbooking
/*$mencari2=mysql_query("SELECT * FROM tour_msbooking WHERE BookersTelp = '' and Status ='ACTIVE'");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    $isitot = mysql_query("SELECT * FROM tour_fbtbooking WHERE BookingID = '$dapet[BookingID]'");
    $tot = mysql_fetch_array($isitot);
    mysql_query("UPDATE tour_msbooking set BookersTelp = '$tot[BookersTelp]',BookersMobile='$tot[BookersMobile]'
                                                WHERE BookingID = '$dapet[BookingID]'");
    echo"$a: BookingID:$dapet[BookingID]<br>";
    $a++;
}*/

//update First name last name
/*$mencari2=mysql_query("SELECT * FROM tour_msbookingdetail WHERE FirstPaxName = '' and Status <>'CANCEL'");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    $parts = explode(" ", $dapet[PaxName]);
    $lastname = array_pop($parts);
    $firstname = implode(" ", $parts);
    if($firstname==''){$firstname=$lastname;$lastname='';}
    mysql_query("UPDATE tour_msbookingdetail set FirstPaxName = '$firstname',LastPaxName='$lastname'
                                                WHERE IDDetail = '$dapet[IDDetail]'");
    echo"$a: FirstPaxName = '$firstname', LastPaxName='$lastname'<br>";
    $a++;
}*/

//search draft booking
/*$qdraft=mysql_query("SELECT * FROM tour_msbooking WHERE IDTourcode = '13318' ");
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

}*/
//update id TL lama ke baru
/*$mencari2=mysql_query("SELECT * FROM tbl_msemployee ");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    mysql_query("UPDATE tour_msproducttl set EmployeeID = '$dapet[employee_code]'
                                                WHERE IDlama = '$dapet[employee_code_OLD]'");
    echo"$a: Name = '$dapet[employee_code]'<br>";
    $a++;
}*/
//update id booking lama ke baru
/*$mencari2=mysql_query("SELECT * FROM tbl_msemployee ");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    mysql_query("UPDATE tour_msbooking set TCEmpID = '$dapet[employee_code]'
                                                WHERE TCEmpID_OLD = '$dapet[employee_code_OLD]'");
    echo"$a: Name = '$dapet[employee_code]'<br>";
    $a++;
}*/
//update nama doa
/*$mencari2=mysql_query("SELECT * FROM msvisa where EmployeeName ='' and Date >='2016-10-01'");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    //$qptes=mssql_query("SELECT * FROM Invoice where InvoiceID like '%$dapet[Invoice]%' ");
    //$ptes=mssql_fetch_array($qptes);
    $qdb=mysql_query("SELECT * FROM cim_inquiry where InquiryNo = '$dapet[Invoice]' ");
    $db=mysql_fetch_array($qdb);
    mysql_query("UPDATE msvisa set EmployeeName = '$db[CreateBy]'
                                                WHERE DONo = '$dapet[DONo]'");
    echo"$a: Name = '$dapet[DONo]'<br>";
    $a++;
}*/
//update KasNo ms visa
/*$mencari2=mysql_query("SELECT * FROM logkasbon where KasNo ='2017-00104' ");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
     mysql_query("UPDATE msvisa set KasNo = '$dapet[KasNo]'
                                                WHERE DONo = '$dapet[DONo]'");
    echo"$a: $dapet[KasNo] = '$dapet[DONo]'<br>";
    $a++;
}*/
// update empid TL 
/*$mencari2=mysql_query("SELECT * FROM tbl_msemployee ");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    //$qptes=mssql_query("SELECT * FROM Invoice where InvoiceID like '%$dapet[Invoice]%' ");
    //$ptes=mssql_fetch_array($qptes);
    //$qdb=mysql_query("SELECT * FROM tour_msproducttl where IDlama = '$dapet[employee_code_OLD]' ");
    //$db=mysql_fetch_array($qdb);
    mysql_query("UPDATE tour_msproducttl set EmployeeID = '$dapet[employee_code]'
                                                WHERE IDlama = '$dapet[employee_code_OLD]'");
    echo"$a<br>";
    $a++;
}*/
//mencari selisih pax
/*$mencari2=mysql_query("SELECT * FROM tour_msbooking where Status <> 'VOID' and BookingStatus = 'DEPOSIT' and YEAR(BookingDate)='2016' ");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    $qdb=mysql_query("SELECT * FROM tour_msbookingdetail where BookingID = '$dapet[BookingID]' and Status<>'CANCEL'
                      and Gender <>'INFANT' ");
    $db=mysql_num_rows($qdb);
    $jumpax=$dapet[AdultPax]+$dapet[ChildPax];
    if($jumpax <> $db) {$b='beda';}else{$b='';}
        echo "$a. $dapet[BookingID] booking: $jumpax, Detail: $db $b<br>";
        $a++;

}*/
// update sttatus TL master
/*$mencari2=mysql_query("SELECT * FROM tbl_msemployee where employee_type='FREELANCE' and StatusTL='APPROVED' ");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    $qptes=mssql_query("UPDATE Employee set StatusTL='$dapet[StatusTL]' where EmployeeID = '$dapet[employee_code]' and StatusTL <> '$dapet[StatusTL]' ");
    $ptes=mssql_fetch_array($qptes);
     echo"$a $ptes[EmployeeID] $dapet[StatusTL] : $ptes[StatusTL]<br>";
    $a++;
}*/
// update sttatus TL master
/*$mencari2=mysql_query("SELECT * FROM msvisa where ActPIC<>'' and PICName='' ");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){

    $qptes=mysql_query("select * from tbl_msemployee where employee_id = '$dapet[ActPIC]'");
    $ptes=mysql_fetch_array($qptes);
    mysql_query("UPDATE msvisa set PICName = '$ptes[employee_name]'
                                                WHERE ActPIC = '$ptes[employee_id]'
                                                and PICName ='' ");
     echo"$a $dapet[ActPIC] : $ptes[employee_name]<br>";
    $a++;
}*/
/*$mencari2=mysql_query("SELECT * FROM msvisa where ActPIC NOT like 'PT%' and ActPIC <>'' ");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){

    $qptes=mysql_query("select * from tbl_msemployee where employee_id = '$dapet[ActPIC]'");
    $ptes=mysql_fetch_array($qptes);
    mysql_query("UPDATE msvisa set ActPIC = '$ptes[employee_code]'
                                                WHERE Id = '$dapet[Id]'");
    echo"$a $dapet[ActPIC] : $ptes[employee_name]<br>";
    $a++;
}*/
// update wopic sama wopic name DOA
/*$mencari2=mysql_query(" SELECT * FROM logwo where WOPIC LIKE 'PT%' and WOPIC <>'' AND YEAR(WODate)='2016' and WOPICName=''");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    $qptes=mysql_query("select * from msvisa where DONo = '$dapet[DONo]'");
    $ptes=mysql_fetch_array($qptes);
    mysql_query("UPDATE logwo set WOPIC = '$ptes[ActPIC]',WOPICName='$ptes[PICName]'
                                                WHERE DONo = '$dapet[DONo]'");
    echo"$a $dapet[ActPIC] : $ptes[employee_name]<br>";
    $a++;
}*/
// update final quotation by/date
/*$mencari2=mysql_query(" SELECT * FROM `tour_msproduct` WHERE `QuotationFinalOption`<>''");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){

    $qptes=mysql_query("select * from tbl_logtour where Description = 'Create Final quotation ID Product ($dapet[IDProduct])'");
    $ptes=mysql_fetch_array($qptes);
    mysql_query("UPDATE tour_msproduct set QuotationFinalDate = '$ptes[LogTime]'
                                                WHERE IDproduct = '$dapet[IDProduct]'");
    echo"$a $dapet[IDProduct] : $ptes[EmployeeName]<br>";
    $a++;
} */
//update employee id TL questioner
/*$mencari2=mysql_query("SELECT * FROM tbl_trquestion WHERE Year ='2017'");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    $qptes=mssql_query("SELECT * FROM Employee where EmployeeName = '$dapet[TourLeader]' ");
    $ptes=mssql_fetch_array($qptes);
    //$qdb=mysql_query("SELECT * FROM tour_msproducttl where IDlama = '$dapet[employee_code_OLD]' ");
    //$db=mysql_fetch_array($qdb);
    mysql_query("UPDATE tbl_trquestion set EmployeeID = '$ptes[EmployeeID]'
                                                WHERE TourLeader = '$dapet[TourLeader]'");
    echo"$a<br>";
    $a++;
}*/
//update officekey
/*$mencari2=mysql_query("SELECT * FROM tour_msbooking WHERE OfficeKey = ''");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    $qptes=mssql_query("SELECT * FROM Divisi where DivisiID = '$dapet[TCDivision]' ");
    $ptes=mssql_fetch_array($qptes);
    //$qdb=mysql_query("SELECT * FROM tour_msproducttl where IDlama = '$dapet[employee_code_OLD]' ");
    //$db=mysql_fetch_array($qdb);
    mysql_query("UPDATE tour_msbooking set OfficeKey = '$ptes[DivisiNO]'
                                                WHERE BookingID = '$dapet[BookingID]'");
    echo"$a $dapet[BookingID] $dapet[TCDivision] $ptes[DivisiNO]<br>";
    $a++;
}*/
//update date visa
/*$mencari2=mysql_query("SELECT * FROM tour_msproduct0604 WHERE Visa = 'NOT INCLUDE' and DateTravelFrom > '2017-04-06'");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    //$qdb=mysql_query("SELECT * FROM tour_msproducttl where IDlama = '$dapet[employee_code_OLD]' ");
    //$db=mysql_fetch_array($qdb);
    mysql_query("UPDATE tour_msproduct set VisaDateline = '$dapet[VisaDateline]'
                                                WHERE IDProduct = '$dapet[IDProduct]' and Embassy01 <> 0");
    echo"$a $dapet[IDProduct] $dapet[TCDivision] $ptes[DivisiNO]<br>";
    $a++;
}*/
//update TCDivision
/*$mencari2=mysql_query("SELECT * FROM tour_msbooking WHERE TCDivision = ''");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    $qptes=mssql_query("SELECT * FROM Employee where EmployeeID = '$dapet[TCEmpID]' ");
    $ptes=mssql_fetch_array($qptes);
    //$qdb=mysql_query("SELECT * FROM tour_msproducttl where IDlama = '$dapet[employee_code_OLD]' ");
    //$db=mysql_fetch_array($qdb);
    mysql_query("UPDATE tour_msbooking set TCDivision = '$ptes[DivisiID]'
                                                WHERE BookingID = '$dapet[BookingID]'");
    echo"$a $dapet[BookingID] $dapet[TCDivision] $ptes[DivisiID]<br>";
    $a++;
}*/
//update tanggal visa dateline
/*$mencari1=mysql_query("SELECT * FROM `tour_msproduct` WHERE DateTravelFrom >= '2017-06-18' and DateTravelFrom <= '2017-07-08' and CompanyID='1' ");
$a=1;
while($ulang=mysql_fetch_array($mencari1)) {
            $target = $ulang[DateTravelFrom];
            $tanggal = substr($target, 8, 2);
            $bulan = substr($target, 5, 2);
            $tahun = substr($target, 0, 4);
            $batas = date('Y-m-d', strtotime('0 second', strtotime('-1 month', strtotime(date($bulan) . '/' . date($tanggal) . '/' . date($tahun) . ' 00:00:00'))));
            echo "$a. $ulang[DateTravelFrom] - $batas <br>";

            //echo"$ulang[BookingID]</br>";}
            mysql_query("UPDATE tour_msproduct set VisaDateline = '$batas'
                                                           WHERE IDProduct = '$ulang[IDProduct]'");
$a++;
}*/
//menampilkan absen employee jtb /absen
//$tanggal = 01;
/*$bulan = 06;
$tahun = 2017;
echo "<table>
     <tr><th>Employee Number</th><th>Employee Name</th><th>divisi</th><th>Date</th><th>Actual Time In</th><th>Actual Time Out</th></tr>";
$staff = mysql_query("SELECT `EmployeeID`,EmployeeName,DivisiID FROM `Attendance` WHERE EmployeeID like 'PJT%' group by EmployeeID");
while($namastaff = mysql_fetch_array($staff)) {
    for ($tanggal = 1; $tanggal <= 31; $tanggal++) {
        $batas = date('Y-m-d', strtotime('0 second', strtotime(date($tahun) . '-' . date($bulan) . '-' . date($tanggal))));
        $mencari1 = mysql_query("SELECT `EmployeeID`,`EmployeeName`,DATE(`EmpDateTime`) as tanggal,TIME(`EmpDateTime`) as jam FROM `Attendance` WHERE EmployeeID = '$namastaff[EmployeeID]' and DATE(`EmpDateTime`)='$batas' order by tanggal ASC ");
        $a = 1;
        $ulang = mysql_fetch_array($mencari1);
        $mencariin = mysql_query("SELECT `EmployeeID`,`EmployeeName`,DATE(`EmpDateTime`),TIME(`EmpDateTime`)as jammasuk FROM `Attendance` 
                            WHERE EmployeeID = '$ulang[EmployeeID]' and DATE(`EmpDateTime`)='$ulang[tanggal]' and `InOutStat`='1' ");
        $mencariout = mysql_query("SELECT `EmployeeID`,`EmployeeName`,DATE(`EmpDateTime`),TIME(`EmpDateTime`)as jampulang FROM `Attendance` 
                            WHERE EmployeeID = '$ulang[EmployeeID]' and DATE(`EmpDateTime`)='$ulang[tanggal]' and `InOutStat`='0' ");
        $datain = mysql_fetch_array($mencariin);
        $dataout = mysql_fetch_array($mencariout);
        if($datain[jammasuk]=='' OR $datain[jammasuk]=='00:00:00'){$jamin='-';}else{$jamin=$datain[jammasuk];}
        if($dataout[jampulang]=='' OR $dataout[jampulang]=='00:00:00'){$jamout='-';}else{$jamout=$dataout[jampulang];}
        echo "<tr><td>$namastaff[EmployeeID]</td><td>$namastaff[EmployeeName]</td><td>$namastaff[DivisiID]</td><td><center>$batas</center></td><td><center>$jamin</center></td><td><center>$jamout</center></td></tr>";


    }
}
echo"<table>";*/
//input kasbon
/*$sql=mysql_query("SELECT * FROM msvisa WHERE KasNo ='2017-00100' ");
while($hasil=mysql_fetch_array($sql)) {
    $sql2=mysql_query("SELECT * FROM logkasbon WHERE KASNo='2017-00100' and DONo ='$hasil[DONo]' ");
    $ada=mysql_num_rows($sql2);
    $tampil=mysql_fetch_array($sql2);
    if($tampil[DONo]=='') {
        $tanggal = $hasil[KasDate];
        $curr = $hasil[KasCurr];
        $amount = $hasil[KasAmount];
        $kasno = $hasil[KasNo];
        $tourcode = $hasil[TourCode];
        $divisi = $hasil[BSOName];
        $tcname = $hasil[EmployeeName];
        $paxname = $hasil[PaxName];
        $invoice = $hasil[Invoice];
        $prodembassy = $hasil[ProdEmbassy];
        $Country = $hasil[Country];
        $prodprocess = $hasil[ProdProcess];
        $date = $hasil[Date];
        $inputdate = date("Y-m-d", time());
        mysql_query("INSERT INTO logkasbon(DONo,
                                      KasNo,      
                                      KasDateDELETE,
                                      KasCurr,
                                      KasAmount, 
                                      inputkas,
                                      TourCode,
                                      Divisi,
                                      TcName,
                                      PaxName,
                                      Invoice,
                                      ProdEmbassy,
                                      Country,
                                      ProdProcess,
                                      Date,
                                      KasCreate) 
                            VALUES('$hasil[DONo]',
                                   '$kasno',     
                                   '$tanggal',
                                   '$curr',
                                   '$amount',   
                                   '$username',
                                   '$tourcode',
                                   '$divisi',
                                   '$tcname',
                                   '$paxname',
                                   '$invoice',
                                   '$prodembassy',
                                   '$Country',
                                   '$prodprocess',
                                   '$date',
                                   '$inputdate')");
        echo"$hasil[DONo] : $hasil[PaxName]<br>";
    }
}*/
//update id booking lama ke baru
/*$mencari2=mysql_query("SELECT * FROM cim_msrespon");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    $qptes=mssql_query("SELECT * FROM Employee where IDPHP = '$dapet[EmployeeIDLama]' ");
    $ptes=mssql_fetch_array($qptes);
    //$qdb=mysql_query("SELECT * FROM tour_msproducttl where IDlama = '$dapet[employee_code_OLD]' ");
    //$db=mysql_fetch_array($qdb);
    mysql_query("UPDATE cim_msrespon set EmployeeID = '$ptes[EmployeeID]'
                                                WHERE EmployeeIDLama = '$dapet[EmployeeIDLama]'");
    echo"$a<br>";
    $a++;
}*/
//update booking id doa
/*$mencari2=mysql_query("SELECT * FROM msvisa where ProductFor = 'LTM' and YEAR(CreatedDate)='2017'");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    $qptes=mysql_query("SELECT * FROM tour_msbookingdetail where IDTourcode = '$dapet[IDTourcode]' and PassportNo = '$dapet[PassNo]'");
    $ptes=mysql_fetch_array($qptes);
    //$qdb=mysql_query("SELECT * FROM tour_msproducttl where IDlama = '$dapet[employee_code_OLD]' ");
    //$db=mysql_fetch_array($qdb);
    mysql_query("UPDATE msvisa set IDBookingdetailREAL = '$ptes[IDDetail]'
                                                WHERE Id = '$dapet[Id]'");
    echo"$a<br>";
    $a++;
}*/
/*$mencari2=mysql_query("SELECT * FROM msvisa where ProductFor = 'LTM' and IDBookingdetailREAL <> ''");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    //$qptes=mysql_query("SELECT * FROM tour_msbookingdetail where IDTourcode = '$dapet[IDTourcode]' and PassportNo = '$dapet[PassNo]'");
    //$ptes=mysql_fetch_array($qptes);
    //$qdb=mysql_query("SELECT * FROM tour_msproducttl where IDlama = '$dapet[employee_code_OLD]' ");
    //$db=mysql_fetch_array($qdb);
    mysql_query("UPDATE msvisa set IDBookingdetail = '$dapet[IDBookingdetailREAL]'
                                                WHERE Id = '$dapet[Id]'");
    echo"$a<br>";
    $a++;
}*/
//open status doa
/*$mencari2=mysql_query("SELECT IDTourcode,SUM(AdultPax + ChildPax) as banyakseat
                                        FROM tour_msbooking
                                        INNER  JOIN tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode
                                        WHERE DateTravelFrom > '2017-10-25'
                                        AND tour_msbooking.Status = 'ACTIVE'
                                        AND DUMMY = 'NO'
                                        AND StatusDOA = 'CLOSE'
                                        AND CompanyID = 1
                                        GROUP BY IDTourcode");
$a=1;
while($dapet=mysql_fetch_array($mencari2)) {
    if($dapet[banyakseat]>15) {
        $qptes = mysql_query("SELECT * FROM tour_msproduct where IDProduct = '$dapet[IDTourcode]'");
        $ptes = mysql_fetch_array($qptes);
        //mysql_query("UPDATE msvisa set IDBookingdetail = '$ptes[BookingID]'
        //                                            WHERE Id = '$dapet[Id]'");
        echo "$a:$dapet[banyakseat] $ptes[IDProduct] $ptes[TourCode]<br>";
        $a++;
    }
}*/
//update nama pax SO hope
/*$mencari2=mysql_query("SELECT * FROM cim_msserviceorder");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    $qptes=mysql_query("SELECT * FROM cim_namelistdetail where RegistrationNo = '$dapet[RegistrationNo]' ");
    $ptes=mysql_fetch_array($qptes);
    //$qdb=mysql_query("SELECT * FROM tour_msproducttl where IDlama = '$dapet[employee_code_OLD]' ");
    //$db=mysql_fetch_array($qdb);
    mysql_query("UPDATE cim_msserviceorder set PaxName = '$ptes[PaxName]'
                                                WHERE RegistrationNo = '$dapet[RegistrationNo]' ");
    echo"$a<br>";
    $a++;
}*/

//update date hope inquiry service
/*$mencari2=mysql_query("SELECT * FROM cim_inquiry_service WHERE Adult='0' AND Child='0' AND Infant='0' AND DateServiceFrom='0000-00-00' AND DateServiceTo='0000-00-00'");
$a=1;
while($dapet=mysql_fetch_array($mencari2)){
    $qptes=mysql_query("SELECT * FROM cim_inquiry where InquiryID = '$dapet[InquiryID]' ");
    $ptes=mysql_fetch_array($qptes);
    //$qdb=mysql_query("SELECT * FROM tour_msproducttl where IDlama = '$dapet[employee_code_OLD]' ");
    //$db=mysql_fetch_array($qdb);
    mysql_query("UPDATE cim_inquiry_service set Adult = '$ptes[SeatAdult]',
                                                      Child = '$ptes[SeatChild]',
                                                      Infant = '$ptes[SeatInfant]',
                                                      DateServiceFrom = '$ptes[DateOfDeparture]',
                                                      DateServiceTo = '$ptes[DateOfArrival]'
                                                WHERE ServiceID = '$dapet[ServiceID]' ");
    echo"$a<br>";
    $a++;
}*/
?>