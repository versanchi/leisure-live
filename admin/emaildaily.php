<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
//include "../config/koneksi.php";
$dbHost = 'localhost';
$dbUsername = 'c0dbvisa';
$dbPassword = 'adminphp';
$dbDatabase = 'c0dbvisa';
$db = mysql_connect($dbHost, $dbUsername, $dbPassword) or die ("Unable to connect to Database Server.");
mysql_select_db ($dbDatabase, $db) or die ("Could not select database.");
switch($_GET[act]){

    default:
        echo "<h2>Report by Division</h2>";
        echo"<table class='bordered'><tr>
		<th>Date</th>
		<th>Department</th>
		<th>BookingAwal</th>
		<th>AddBooking</th>
		<th>Cancel</th>
		<th>Total</th></tr>";

        $Bookingawal=0;
        $QDepartment=mysql_query("select distinct Department from tour_msproduct where status<>'VOID'");
        $kmrndl = mktime (0,0,0, date("m"), date("d")-2,date("Y"));
        $kemarindl = date('Y-m-d', $kmrndl);
        //$kemarindl = '2015-10-21';
        $kmrn = mktime (0,0,0, date("m"), date("d")-1,date("Y"));
        $kemarin = date('Y-m-d', $kmrn);
        //$kemarin = '2015-10-22';
        $bln=date("m",strtotime($kemarin));
        $tgl=date("d",strtotime($kemarin));
        $thn=date("Y",strtotime($kemarin));
        while ($DDepartment=mysql_fetch_array($QDepartment))
        {
            $Department=$DDepartment[Department];
            //$TotalBooking=$Bookingawal+$AddBooking+$CancelBooking;
            $Booking=mysql_query("select sum(AdultPax+ChildPax+InfantPax) as Booking from tour_msbooking where  Bookingdate='$kemarin' and IDTourcode in (select IDProduct from tour_msproduct where Department='$Department')  and TCDivision <> 'LTM' AND TCDivision <> 'LTM-TEZ'");
            $DBooking=mysql_fetch_array($Booking);

            $LBooking=mysql_query("select sum(AdultPax+ChildPax+InfantPax) as Booking from tour_msbooking where  Bookingdate<='$kemarin' and year(Bookingdate)='$thn' and Status<> 'VOID'  and IDTourcode in (select IDProduct from tour_msproduct where Department='$Department') and TCDivision <> 'LTM' AND TCDivision <> 'LTM-TEZ'");
            $DLBooking=mysql_fetch_array($LBooking);

            $qdata=mysql_query("select * from tour_RptClosingDay where Bookingdate = '$kemarindl' and Department = '$Department' ");
            $databooking=mysql_fetch_array($qdata);

            if($bln==1 && $tgl==1){$Bookingawal=0;}else{$Bookingawal=$databooking[TotalBooking];}
            if($DBooking[Booking]==null){$AddBooking=0;}else{$AddBooking=$DBooking[Booking];}
            if($DLBooking[Booking]==null){$TotalBooking=0;}else{$TotalBooking=$DLBooking[Booking];}

            $CancelBooking=($Bookingawal+$AddBooking)-$TotalBooking;
			if($CancelBooking<0)
			{	$AddBooking=$CancelBooking*-1;
				$CancelBooking=0;}

            echo"<tr>
			<td>$kemarin</td>
			<td>$Department</td>
			<td>$Bookingawal</td>
			<td>$AddBooking</td>
			<td>$CancelBooking</td>
			<td>$TotalBooking</td>
		    </tr>";
            mysql_query("INSERT INTO tour_RptClosingDay(BookingDate,
                                        Department,
                                        BookingAwal,
                                        AddBooking,
                                        CancelBooking,
                                        TotalBooking)
                                VALUES ('$kemarin',
                                        '$Department',
                                        $Bookingawal,
                                        $AddBooking,
                                        $CancelBooking,
                                        $TotalBooking)");
        }
        echo"</table>";
        //mencari data terbaru
        $qemail1=mysql_query("select * from tour_RptClosingDay where Bookingdate = '$kemarin' and Department ='LEISURE' ");
        $dataemail1=mysql_fetch_array($qemail1);
        $bookawal1=$dataemail1[BookingAwal];$bookadd1=$dataemail1[AddBooking];
        $bookcancel1=$dataemail1[CancelBooking];$booktotal1=$dataemail1[TotalBooking];
        $qemail2=mysql_query("select * from tour_RptClosingDay where Bookingdate = '$kemarin' and Department ='MINISTRY' ");
        $dataemail2=mysql_fetch_array($qemail2);
        $bookawal2=$dataemail2[BookingAwal];$bookadd2=$dataemail2[AddBooking];
        $bookcancel2=$dataemail2[CancelBooking];$booktotal2=$dataemail2[TotalBooking];
        $qemail3=mysql_query("select * from tour_RptClosingDay where Bookingdate = '$kemarin' and Department ='TMR' ");
        $dataemail3=mysql_fetch_array($qemail3);
        $bookawal3=$dataemail3[BookingAwal];$bookadd3=$dataemail3[AddBooking];
        $bookcancel3=$dataemail3[CancelBooking];$booktotal3=$dataemail3[TotalBooking];
        $qemail4=mysql_query("select * from tour_RptClosingDay where Bookingdate = '$kemarin' and Department ='TUR EZ' ");
        $dataemail4=mysql_fetch_array($qemail4);
        $bookawal4=$dataemail4[BookingAwal];$bookadd4=$dataemail4[AddBooking];
        $bookcancel4=$dataemail4[CancelBooking];$booktotal4=$dataemail4[TotalBooking];
        $tglb4 = mktime (0,0,0, date("m"), date("d")-1,date("Y"));
        $tglemail = date('d M Y', $tglb4);
        $blnemail=date("m",strtotime($tglemail));
        $tglemails=date("d",strtotime($tglemail));
        $jamkirim = date("d M Y, G:i:s");
		$TotalBookAwal=$bookawal1+$bookawal2+$bookawal3+$bookawal4;
		$TotalBookAdd=$bookadd1+$bookadd2+$bookadd3+$bookadd4;
		$TotalBookCancel=$bookcancel1+$bookcancel2+$bookcancel3+$bookcancel4;
		$TotalBook=$booktotal1+$booktotal2+$booktotal3+$booktotal4;
        if($blnemail==1 && $tglemails==1){$kata="Start Booking";}else{$kata="Total Last Booking";}

        //kirim email data terbaru
        $message = "\n";
        $message .= "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">"."\n";
        $message .= "<html>"."\n";
        $message .= "<head>"."\n";
        $message .= "</head>"."\n";
        $message .= '<body bgcolor="#FFFFFF" text="#333333" style="background-color: #FFFFFF; margin-bottom : 0px; margin-left : 0px; margin-top : 0px; margin-right : 0px;">
                        <table style="border:0"><tr><td style="border:0">
                        <p>Dear All,
                        <br>Herewith, LTM report daily division period : '.$tglemail.'</p>
                        <table class="bordered" style="font-size: 13px; font-family: verdana; color: #333333; width: 600px;" border="0" cellspacing="1" cellpadding="4" align="left" bgcolor="#FFFFFF">
                            <tr><th style="background-color: #f58220;">Department</th><th style="background-color: #f58220;">'.$kata.'</th><th style="background-color: #f58220;">Add Booking</th><th style="background-color: #f58220;">Cancel Booking</th><th style="background-color: #f58220;">Total Booking</th></tr>
                            <tr><td style="background-color: #eea262;">LEISURE</td><td style="background-color: #eea262;text-align:right;">'.number_format($bookawal1, 0, '', '.').'</td><td style="background-color: #eea262;text-align:right;">'.number_format($bookadd1, 0, '', '.').'</td>
                                                                                <td style="background-color: #eea262;text-align:right;">'.number_format($bookcancel1, 0, '', '.').'</td><td style="background-color: #eea262;text-align:right;">'.number_format($booktotal1, 0, '', '.').'</td></tr>
                            <tr><td style="background-color: #ebb486;">MINISTRY</td><td style="background-color: #ebb486;text-align:right;">'.number_format($bookawal2, 0, '', '.').'</td><td style="background-color: #ebb486;text-align:right;">'.number_format($bookadd2, 0, '', '.').'</td>
                                                                                <td style="background-color: #ebb486;text-align:right;">'.number_format($bookcancel2, 0, '', '.').'</td><td style="background-color: #ebb486;text-align:right;">'.number_format($booktotal2, 0, '', '.').'</td></tr>
                            <tr><td style="background-color: #eea262;">TMR</td><td style="background-color: #eea262;text-align:right;">'.number_format($bookawal3, 0, '', '.').'</td><td style="background-color: #eea262;text-align:right;">'.number_format($bookadd3, 0, '', '.').'</td>
                                                                                <td style="background-color: #eea262;text-align:right;">'.number_format($bookcancel3, 0, '', '.').'</td><td style="background-color: #eea262;text-align:right;">'.number_format($booktotal3, 0, '', '.').'</td></tr>
                            <tr><td style="background-color: #ebb486;">TUR EZ</td><td style="background-color: #ebb486;text-align:right;">'.number_format($bookawal4, 0, '', '.').'</td><td style="background-color: #ebb486;text-align:right;">'.number_format($bookadd4, 0, '', '.').'</td>
                                                                                <td style="background-color: #ebb486;text-align:right;">'.number_format($bookcancel4, 0, '', '.').'</td><td style="background-color: #ebb486;text-align:right;">'.number_format($booktotal4, 0, '', '.').'</td></tr>
						<tr><td style="background-color: #f58220;">TOTAL</td><td style="background-color: #f58220;text-align:right;">'.number_format($TotalBookAwal, 0, '', '.').'</td><td style="background-color: #f58220;text-align:right;">'.number_format($TotalBookAdd, 0, '', '.').'</td>
                                                                                <td style="background-color: #f58220;text-align:right;">'.number_format($TotalBookCancel, 0, '', '.').'</td><td style="background-color: #f58220;text-align:right;">'.number_format($TotalBook, 0, '', '.').'</td></tr>
                        </table>
                  </td></tr>
                  <tr><td style="border:0">
                  <br>
                  <p>Regards,
                  <br>Information System Division
                  <br>-------------------------------------------------------------------------------------------------------------</p>
                  <br>
            <p><small>IMPORTANT INFO :</small></p>
            <p style="font-size: 10px;">* This email is sent automatically via Panorama Integrated system and does not require a reply.
            <br>* This LTM report daily division has been generated on '.$jamkirim.'
            <br>* E-mail transmission cannot be guaranteed to be secured or error-free as information could be corrupted,lost,arrive late or incomplete, or contain viruses.
            <br>* The sender shall not be held responsible for any errors or omissions in the contents of this message, which arise as a result of e-mail transmission.</p>
            </td></tr></table>
            </body>';
        $message .= "</HTML>"."\n";
        $message .= "\n";
        $headers  = "MIME-Version: 1.0 \n";
        $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
        $headers .= "From: Panorama Web System <noreply@panoramawebsys.com> \n";
        $headers .= "Reply-To: noreply@panoramawebsys.com \r\n";
        $headers .= "Return-Path: noreply@panoramawebsys.com\r\n";
        $headers .= "Bcc: ferry_budiono@panorama-tours.com\r\n";
        $headers .= "CC: vili@panorama-tours.com\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        $useremail = "ltm@panorama-tours.com";
        //$useremail = "versus_f2000@panorama-tours.com";

        mail($useremail, "LTM Report Daily Division $tglemail", $message, $headers);
        break;
}
?>
