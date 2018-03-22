<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "../config/koneksi.php";
include "../config/koneksimaster.php";
include "../config/library.php";
$module=$_GET[module];
$act=$_GET[act];
$username=$_SESSION[employee_code];
/*$sql=mssql_query("SELECT DivisiNO,Employee.DivisiID,EmployeeID,Category,EmployeeName,CompanyGroup FROM [HRM].[dbo].[Employee]
                  inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                  WHERE EmployeeID = '$username'");
$tampiluser=mssql_fetch_array($sql);*/
$employee = $_SESSION[employee_name];
$companyid=$_SESSION['company_id'];
$EmpName="$_SESSION[employee_name] ($_SESSION[employee_code])";
$EmpOff=$_SESSION[employee_office];
$offgroup=$_SESSION[company_group];
$timezone_offset = 1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
if($offgroup=='TUR EZ'){$company=2;}else{$company=1;}
if($username=='' or $EmpName==''){
    echo "<link href='../config/adminstyle.css' rel='stylesheet' type='text/css'>
          <center>Session Time Out, You must re-login<br>";
    echo "<a href=indexadmin.php><b>LOGIN</b></a></center>";
}else{
    // update TOOLS BANNER
    if ($module=='banner' AND $act=='update'){

        $updateuser = $_SESSION['namauser'];
        $updatedate = date("Y-m-d G:i:s", time());
        mysql_query ("UPDATE banner SET bvalue = '$_POST[value]',
                                    bsubject = '$_POST[subject]',
                                    bcontent1 = '$_POST[baris1]',
                                    bcontent2 = '$_POST[baris2]',
                                    bcontent3 = '$_POST[baris3]',
                                    bvalid = '$_POST[valid]',
                                    buser = '$updateuser',
                                    bupdate = '$updatedate',    
                                    bcolor = '$_POST[input1]',
                                    fcolor = '$_POST[input2]'    
               WHERE bid = '$_POST[id]'");
        //echo $mysql_query;
        //exit();
        header('location:media.php?module=banner');
    }
// update T&C
    elseif ($module=='tandc' AND $act=='update'){

        mysql_query("UPDATE tour_tandc set TCBahasa = '$_POST[tcb]'
                                           where TcID = $_POST[id]");

        $Description="Update T&C";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header("location:media.php?module=tandc");
    }
// update T&C TMR
    elseif ($module=='tandc' AND $act=='updatetmr'){

        mysql_query("UPDATE tour_mstmrreq set TnC = '$_POST[tcb]'
                                       WHERE IDTmr = $_POST[id]");

        $Description="Update T&C TMR";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                               Description,
                               LogTime)
                        VALUES ('$EmpName',
                               '$Description',
                               '$today')");
        header("location:media.php?module=tandc&act=edittmr&no=$_POST[id]");
    }
// Update MS Password
    elseif ($module=='mspassword' AND $act=='update'){
        $employee_code=$_POST[id];
        $Description="Change password Employee (".$employee_code.")";
        $pass=strtolower($_POST[employee_password]);
        mssql_query("UPDATE [HRM].[dbo].[Employee] SET Password = '$pass'
                               WHERE EmployeeID = '$_POST[id]'");
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module=home');
    }
// add Data | Iklan
    elseif ($module=='dtiklan' AND $act=='input'){
        $media=strtoupper($_POST[media]);
        $size=strtoupper($_POST[size]);
        $description=strtoupper($_POST[description]);
        $from = date('Y-m-d', strtotime($_POST['datefrom']));
        $to = date('Y-m-d', strtotime($_POST['dateto']));
        $Description="Add Advertise ($media - $subject)";
        mysql_query ("INSERT INTO tour_iklan (Media,
                                    Size,
                                    Description,
                                    DateFrom,
                                    DateTo,
                                    InputBy,
                                    InputDate,
                                    Status) 
                            VALUES ('$media',
                                    '$size',
                                    '$description',
                                    '$from',
                                    '$to',
                                    '$EmpName',
                                    '$today',
                                    'ACTIVE')");

        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);
    }
// update data | Iklan
    elseif ($module=='dtiklan' AND $act=='update'){
        $media=strtoupper($_POST[media]);
        $size=strtoupper($_POST[size]);
        $description=strtoupper($_POST[description]);
        $from = date('Y-m-d', strtotime($_POST['datefrom']));
        $to = date('Y-m-d', strtotime($_POST['dateto']));
        $Description="Edit Advertise ($media - $description)";
        mysql_query ("UPDATE tour_iklan SET Media = '$media',
                                    Size = '$size',
                                    Description = '$description',
                                    DateFrom = '$from',
                                    DateTo = '$to',
                                    InputBy = '$EmpName',
                                    InputDate = '$today'
               WHERE IDIklan = '$_POST[id]'");

        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);
    }
// update news
    elseif ($module=='information' AND $act=='update'){
        $news=strtoupper($_POST['informationdesc']);
        $Description="Edit News no ($_POST[id])";
        mysql_query ("UPDATE tour_information SET InformationDesc = '$news',UpdateBy='$EmpName',UpdateDate='$today'
               WHERE InformationID = '$_POST[id]'");
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);
    }
//Input MS Booking
    elseif ($module=='msbooking' AND $act=='input') {
        $tccompany = $offgroup;
        $tanggalskrg=date("Y-m-d");
        if ($_POST[dummy] == 'NO') {
            if ($_POST[dobel] == 'ya') {
                $depono = "$_POST[depositno]";
                $duplicate = 'YES';
            } else {
                if ($_POST[depositno] <> '') {
                    $ceking = mysql_query("SELECT DepositNo FROM tour_msbooking where DepositNo = '$_POST[depositno]' and TCCompany = '$company' and Status ='ACTIVE'");
                    $ketemu = mysql_num_rows($ceking);
                    if ($ketemu > 0) {
                        $depono = "$_POST[depositno]";
                        $duplicate = 'YES';
                    } else {
                        $depono = "$_POST[depositno]";
                        $duplicate = 'NO';
                    }
                } else {
                    $depono = "$_POST[depositno]";
                    $duplicate = 'NO';
                }
            }
        } else {
            $depono = "CSR";
            $duplicate = 'NO';
        }
        include "../config/koneksifabs.php";

        $qpromoday = mysql_query("SELECT * FROM tbl_exhibition where Type = 'INHOUSE' and StartDate <= '$tanggalskrg' and EndDate >= '$tanggalskrg' and InhouseBSO = '$_POST[tcdivision]' AND Status ='ACTIVE' AND StatusExh ='FIX' ");
        $adainhouse = mysql_num_rows($qpromoday);
        $qpromodayall = mysql_query("SELECT * FROM tbl_exhibition where Type = 'INHOUSE' and StartDate <= '$tanggalskrg' and EndDate >= '$tanggalskrg' and InhouseBSO = 'ALL' AND Status ='ACTIVE' AND StatusExh ='FIX' ");
        $adainhouseall = mysql_num_rows($qpromodayall);

        if ($adainhouse > 0) {
            $promoday = mysql_fetch_array($qpromoday);
            $incinhouse='yes';$exibition=$promoday[ExhibitionID];
        } elseif ($adainhouseall > 0) {
            $promoday = mysql_fetch_array($qpromodayall);
            if($promoday[Branch]=='ALL' OR $promoday[Branch]==$_SESSION[company_group]){
                if($promoday[Area]==$_SESSION[district] OR $promoday[Area]=='ALL'){
                    $incinhouse='yes';$exibition=$promoday[ExhibitionID];
                }else{
                    $incinhouse='no';$exibition='';
                }
            }else{
                $incinhouse='no';$exibition='';
            }
        } else{
            $incinhouse='no';$exibition='';
        }
        mysql_close($dbfabs);
        include "../config/koneksi.php";
        $username = $_SESSION[namauser];
        $hari = date("Y", time());
        // running number booking
        $tampil = mysql_query("SELECT * FROM tour_msbooking
                ORDER BY BookingID DESC limit 1");
        $hasil = mysql_fetch_array($tampil);
        $jumlah = mysql_num_rows($tampil);
        $tahun = substr($hasil[BookingID], 0, 4);

        if ($jumlah > 0) {
            if ($hari == $tahun) {
                $tahun1 = $hari;
                $tiket = substr($hasil[BookingID], 5, 7) + 1;
                switch ($tiket) {
                    case ($tiket < 10):
                        $tiket1 = "000000" . $tiket;
                        break;
                    case ($tiket > 9 && $tiket < 100):
                        $tiket1 = "00000" . $tiket;
                        break;
                    case ($tiket > 99 && $tiket < 1000):
                        $tiket1 = "0000" . $tiket;
                        break;
                    case ($tiket > 999 && $tiket < 10000):
                        $tiket1 = "000" . $tiket;
                        break;
                    case ($tiket > 9999 && $tiket < 100000):
                        $tiket1 = "00" . $tiket;
                        break;
                    case ($tiket > 99999 && $tiket < 1000000):
                        $tiket1 = "0" . $tiket;
                        break;
                }
            } else if ($hari > $tahun) {
                $tahun1 = $hari;
                $tiket1 = "0000001";
            }
        } else {
            $tahun1 = $hari;
            $tiket1 = "0000001";
        }

        //running csr number PTES
        if($_POST[autocsr]=='YES') {
            $sqldiv = mssql_query("SELECT c.ClientNo,c.CompanyName FROM Divisi d
                                   inner join Company c on c.CompanyCode = d.DivisiID
                                   WHERE d.DivisiID = '$_POST[tcdivision]' ");
            $datadiv = mssql_fetch_array($sqldiv);
            $sqlrar = mssql_query("SELECT * FROM Divisi WHERE DivisiID = 'FSD' ");
            $norar = mssql_fetch_array($sqlrar);
            $csrdepan = "CSR$norar[DivisiNO]-";
            include "../config/koneksisql.php";
            $tampilin = mssql_query("SELECT TOP 1 CashReceiptId FROM CashReceipt where CashReceiptId like '$csrdepan%'
                            ORDER BY CashReceiptId DESC ");
            $hasilin = mssql_fetch_array($tampilin);
            $jumlahin = mssql_num_rows($tampilin);
            mssql_close($linkptes);
            include "../config/koneksimaster.php";

            if ($jumlahin > 0) {
                $csrno1 = substr($hasilin[CashReceiptId], -7) + 1;
                switch ($csrno1) {
                    case ($csrno1 < 10):
                        $csrno = "000000" . $csrno1;
                        break;
                    case ($csrno1 > 9 && $csrno1 < 100):
                        $csrno = "00000" . $csrno1;
                        break;
                    case ($csrno1 > 99 && $csrno1 < 1000):
                        $csrno = "0000" . $csrno1;
                        break;
                    case ($csrno1 > 999 && $csrno1 < 10000):
                        $csrno = "000" . $csrno1;
                        break;
                    case ($csrno1 > 9999 && $csrno1 < 100000):
                        $csrno = "00" . $csrno1;
                        break;
                    case ($csrno1 > 99999 && $csrno1 < 1000000):
                        $csrno = "0" . $csrno1;
                        break;
                }
            } else {
                $csrno = "0000001";
            }
            $csrtour = "$csrdepan$csrno";
            $depono = $csrtour;
        }
        $bookersname=strtoupper($_POST[bookersname]);
        $bookersaddress=strtoupper($_POST[bookersaddress]);
        $emergencycall=strtoupper($_POST[emergencycall]);
        //proses check seat
        mysql_query("UPDATE tour_msbookingdetail set Status='CANCEL' where IDTourcode = '$_POST[idproduct]' and Status ='0' and ReasonCancel <>'' ");
        $kuery = mysql_query("SELECT * FROM tour_msproduct where IDProduct = '$_POST[idproduct]'");
        $dapet = mysql_fetch_array($kuery);
        $seatsisa = $dapet[SeatSisa];
        $qcek2 = mysql_query("SELECT count(IDDetail) as jumdetail FROM tour_msbookingdetail where IDTourcode = '$_POST[idproduct]' and Status <>'CANCEL' and Gender <> 'INFANT' ");
        $rcek2 = mysql_fetch_array($qcek2);
        $seatsisa2 = $dapet[Seat] - $rcek2[jumdetail];
        if($seatsisa < $_POST[jumsit] OR $seatsisa2 < $_POST[jumsit]){
            header("location:media.php?module=msbooking&act=tambahmsbooking&id=$_POST[idproduct]&err=fullquota");
        }
        else {
            $roomAkhir = mysql_query("SELECT CONVERT(RoomNo, UNSIGNED INTEGER) as urut FROM tour_msbookingdetail where IDtourcode = '$_POST[idproduct]' and RoomNo !='' order by urut desc limit 1 ");
            $droomAkhir = mysql_fetch_array($roomAkhir);
            $ada = mysql_num_rows($kuery);
            $startroom = $droomAkhir[urut] + 1;
            $endroom = $droomAkhir[urut] + $_POST[totalroom];
            if ($depono == '') {
                $statbook = 'HOLD';
                $mod = "msbookingdetail&act=editdetail&code=$tahun1$tiket1";  //$mod="msbookingdetail";
            } else if ($depono <> '') {
                $statbook = 'DEPOSIT';
                $mod = "msbookingdetail&act=editdetail&code=$tahun1$tiket1";
            }
            if ($_POST[tcnamealias] == '') {
                $tcalias = $_POST[tcname];
            } else {
                $tcalias = $_POST[tcnamealias];
            }
            $caritchold = mssql_query("SELECT ClientNo,DivisiNO,Employee.DivisiID,Employee.CompanyID,EmployeeID,Category,EmployeeName,CompanyGroup FROM [HRM].[dbo].[Employee]
              inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
              WHERE EmployeeID = '$_POST[tchold]'");
            $tchold = mssql_fetch_array($caritchold);
            if ($_POST[tchold] == '') {
                $tcname = $_POST[tcname];
                $tcdivision = $_POST[tcdivision];
                $tccomp = $tccompany;
                $compid = $companyid;
                $officekey = $_POST[officekey];
            } else {
                $tcname = $tchold[EmployeeName];
                $tcdivision = $tchold[DivisiID];
                $tccomp = $tchold[CompanyGroup];
                $compid = $tchold[CompanyID];
                $officekey = $tchold[DivisiNO];
            }
            //------ test
            mysql_query("INSERT INTO tour_msbooking(BookingID,
                                      Duplicate,
                                      IDTourcode,
                                      TourCode,
                                      Year,
                                      BookersName,
                                      BookersTelp,
                                      BookersMobile,                 
                                      BookersAddress,
                                      BookersEmail,
                                      EmergencyCall,
                                      TCName,
                                      TCNameAlias,
                                      TCDivision,
                                      TCCompany,
                                      TCCompanyID,
                                      TCEmpID,
                                      OfficeKey,
                                      OfficeCategory,
                                      AdultPax,
                                      ChildPax,        
                                      InfantPax,
                                      StartRoom,
                                      EndRoom,
                                      TotalRoom, 
                                      DepositDate,
                                      DepositNo,
                                      DepositCurr,
                                      DepositAmount,
                                      Curr,
                                      exRate,
                                      BookingPlace,
                                      BookingStatus,
                                      BookingDate,
                                      ClientType,
                                      DUMMY,
                                      Website) 
                            VALUES('$tahun1$tiket1',
                                   '$duplicate',
                                   '$_POST[idproduct]',
                                   '$_POST[tourcode]',
                                   '$_POST[year]',
                                   '$bookersname',
                                   '$_POST[bookerstelp]', 
                                   '$_POST[bookersmobile]', 
                                   '$bookersaddress',
                                   '$_POST[bookersemail]',
                                   '$emergencycall',
                                   '$tcname',
                                   '$tcalias',
                                   '$tcdivision',
                                   '$tccomp',
                                   '$compid',
                                   '$_POST[tcempid]',
                                   '$officekey',
                                   '$_POST[officecategory]',
                                   '$_POST[adultpax]', 
                                   '$_POST[childpax]',           
                                   '$_POST[infantpax]',
                                   '$startroom',
                                   '$endroom',
                                   '$_POST[totalroom]',
                                   '$_POST[depositdate]', 
                                   '$depono',
                                   '$_POST[depositcurr]',
                                   '$_POST[depositamount]',
                                   '$_POST[sellcurr]',
                                   '1',
                                   '$exibition',
                                   '$statbook',
                                   '$today',
                                   '$_POST[clienttype]',
                                   '$_POST[dummy]',
                                   'TOUR')");
            $jumlahseat = $_POST[jumsit];
            $seatdep = $dapet[SeatDeposit] + $jumlahseat;
            $jumroom = $droomAkhir[urut] + $_POST[totalroom];
            $sisaseat = $dapet[Seat] - $seatdep;
            $bookseat = $dapet[SeatBooking] + $seatdep;
            $gruptype = $dapet[GroupType];

            //kalau ada inhouse
            if ($incinhouse == 'yes') {
                if ($dapet[CompanyID] == '1' AND $dapet[ShockingOffer] <> 'YES' AND ($dapet[GroupType] == 'MINISTRY' OR $dapet[GroupType] == 'SERIES' OR $dapet[GroupType] == 'CRUISE')) {
                    if ($promoday[DiscountCategory] == 'SEASON') {
                        //cek low high season
                        if ($dapet[SeasonType] == 'LOW') {
                            $discpromoday = $promoday[XtraDisc];
                        } else if ($dapet[SeasonType] == 'HIGH') {
                            $discpromoday = $promoday[XtraDisc2];
                        }
                    } else if ($promoday[DiscountCategory] == 'PRODUCT') {
                        if ($promoday[Product] == 'ALL') {
                            $discpromoday = $promoday[XtraDiscProd];
                        } else if ($promoday[Product] == 'SELECTED') {
                            include "../config/koneksifabs.php";
                            $cariprod = mysql_query("SELECT * FROM tbl_exhibition_tourcode where ExhibitionID = '$promoday[ExhibitionID]' AND IDProduct = '$_POST[idproduct]'");
                            $dptprod = mysql_num_rows($cariprod);
                            mysql_close($dbfabs);
                            include "../config/koneksi.php";
                            if ($dptprod > 0) {
                                $discpromoday = $promoday[XtraDiscProd];
                            } else {
                                $discpromoday = 0;
                            }
                        }
                    }
                } else {
                    $discpromoday = 0;
                }
            } else {
                $discpromoday = 0;
            }
            if ($gruptype == 'CRUISE') {
                $rumtype = '12 Pax';
            } else {
                $rumtype = 'Twin';
            }

            mysql_query("UPDATE tour_msproduct SET SeatDeposit = '$seatdep',
                                   SeatSisa = '$sisaseat',
                                   SeatBooking = '$bookseat',
                                   Room = '$jumroom' 
                               WHERE IDProduct = '$_POST[idproduct]'");
            for ($satu = 1; $satu <= $_POST[adultpax]; $satu++) {
                $ad = mysql_query("SELECT count(tour_msbookingdetail.IDDetail) as uruta FROM tour_msbookingdetail
                                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                    WHERE tour_msbooking.IDTourcode = '$_POST[idproduct]' 
                                    and tour_msbookingdetail.Gender <> 'INFANT'  
                                    AND tour_msbookingdetail.Status<>'CANCEL' 
                                    and tour_msbooking.Status = 'ACTIVE'
                                    ORDER BY Urutan DESC ");
                $isiad = mysql_fetch_array($ad);
                $mulai = $isiad[uruta];
                $urut = $mulai + 1;
                $d = mysql_query("SELECT * FROM tour_msdiscount
                                    left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct 
                                    WHERE tour_msproduct.IDProduct = '$_POST[idproduct]' and tour_msdiscount.Status='ACTIVE'");
                $dd = mysql_fetch_array($d);
                if ($urut <= $dd[Max1]) {
                    $dis = $dd[Disc1];
                }//+$discpromoday;}
                else if ($urut <= $dd[Max2]) {
                    $dis = $dd[Disc2];
                }//+$discpromoday;}
                else if ($urut <= $dd[Max3]) {
                    $dis = $dd[Disc3];
                }//+$discpromoday;}
                else if ($urut <= $dd[Max4]) {
                    $dis = $dd[Disc4];
                }//+$discpromoday;}
                else if ($urut <= $dd[Max5]) {
                    $dis = $dd[Disc5];
                }//+$discpromoday;}
                else if ($urut <= $dd[Max6]) {
                    $dis = $dd[Disc6];
                }//+$discpromoday;}
                else if ($urut <= $dd[Max7]) {
                    $dis = $dd[Disc7];
                }//+$discpromoday;}
                else $dis = '0';
                if ($dis == '') {
                    $dis = '0';
                }
                $subtotal1 = $dapet[SellingAdlTwn] - $dis;
                $subtotal = $subtotal1 - $discpromoday;
                mysql_query("INSERT INTO tour_msbookingdetail(Urutan,IDTourcode,TourCode,BookingID,Gender,Package,RoomType,Discount,AddDiscount,Price,SubTotal,Status,Curr,ExRate)
                                            VALUES ('$urut','$_POST[idproduct]','$_POST[tourcode]','$tahun1$tiket1','ADULT','Tour','$rumtype','$dis','$discpromoday','$dd[SellingAdlTwn]','$subtotal','$dis','IDR','1')");
            }
            for ($satu = 1; $satu <= $_POST[childpax]; $satu++) {
                $ad = mysql_query("SELECT count(tour_msbookingdetail.IDDetail) as uruta FROM tour_msbookingdetail
                                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                    WHERE tour_msbooking.IDTourcode = '$_POST[idproduct]'
                                    and tour_msbookingdetail.Gender <> 'INFANT'  
                                    AND tour_msbookingdetail.Status<>'CANCEL' 
                                    and tour_msbooking.Status = 'ACTIVE'
                                    ORDER BY Urutan DESC");
                $isiad = mysql_fetch_array($ad);
                $mulai = $isiad[uruta];
                $urut = $mulai + 1;
                $d = mysql_query("SELECT * FROM tour_msdiscount
                                    left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct 
                                    WHERE tour_msproduct.IDProduct = '$_POST[idproduct]' and tour_msdiscount.Status='ACTIVE'");
                $dd = mysql_fetch_array($d);
                if ($urut <= $dd[Max1]) {
                    $dis = $dd[Disc1];
                }//+$discpromoday;}
                else if ($urut <= $dd[Max2]) {
                    $dis = $dd[Disc2];
                }//+$discpromoday;}
                else if ($urut <= $dd[Max3]) {
                    $dis = $dd[Disc3];
                }//+$discpromoday;}
                else if ($urut <= $dd[Max4]) {
                    $dis = $dd[Disc4];
                }//+$discpromoday;}
                else if ($urut <= $dd[Max5]) {
                    $dis = $dd[Disc5];
                }//+$discpromoday;}
                else if ($urut <= $dd[Max6]) {
                    $dis = $dd[Disc6];
                }//+$discpromoday;}
                else if ($urut <= $dd[Max7]) {
                    $dis = $dd[Disc7];
                }//+$discpromoday;}
                else $dis = '0';
                if ($dis == '') {
                    $dis = '0';
                }
                $subtotal1 = $dapet[SellingChdTwn] - $dis;
                $subtotal = $subtotal1 - $discpromoday;
                mysql_query("INSERT INTO tour_msbookingdetail(Urutan,IDTourcode,TourCode,BookingID,Gender,Package,RoomType,Discount,AddDiscount,Price,SubTotal,Status,Curr,ExRate)
                                            VALUES ('$urut','$_POST[idproduct]','$_POST[tourcode]','$tahun1$tiket1','CHILD','Tour','$rumtype','$dis','$discpromoday','$dd[SellingChdTwn]','$subtotal','$dis','IDR','1')");
            }
            for ($satu = 0; $satu < $_POST[infantpax]; $satu++) {
                $cadltwn = mysql_query("SELECT * FROM tour_msproduct
                                        WHERE IDProduct = '$_POST[idproduct]' and Status='ACTIVE'");
                $harga = mysql_fetch_array($cadltwn);
                mysql_query("INSERT INTO tour_msbookingdetail(IDTourcode,TourCode,BookingID,Gender,Package,RoomType,Price,SubTotal,Status,Curr,ExRate)
                                            VALUES ('$_POST[idproduct]','$_POST[tourcode]','$tahun1$tiket1','INFANT','Tour','No Bed','$harga[SellingInfant]','$harga[SellingInfant]','0','IDR','1')");
            }
            //update PTES
            $nocsr = substr($_POST[depositno], 0, 3);
            //if(($offgroup =='PANORAMA TOURS' AND !preg_match('/LTM/',$EmpOff)) OR $offgroup <> 'PANORAMA WORLD' OR $offgroup <> 'SISTER COMPANY'){
            if ($nocsr == 'CSR') {
                include "../config/koneksisql.php";
                mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = '$tahun1$tiket1'
                                                WHERE [CashReceiptId] = '$_POST[depositno]' AND [COMPANYID]= '$company' ");
                mssql_close($linkptes);
                include "../config/koneksimaster.php";
            }
            //}
            $isitot = mysql_query("SELECT sum(SubTotal)as jumtot FROM tour_msbookingdetail WHERE TourCode = '$_POST[tourcode]' and BookingID = '$tahun1$tiket1' group by TourCode");
            $tot = mysql_fetch_array($isitot);
            //update jumlah product
            $mencari1 = mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_POST[idproduct]' and Status <> 'VOID' ");
            $ulang = mysql_fetch_array($mencari1);
            $caribook = mysql_query("SELECT count(IDDetail) as totbuking FROM tour_msbookingdetail WHERE IDTourcode = '$_POST[idproduct]' and Gender <> 'INFANT' and Status <> 'CANCEL'");
            $kebook = mysql_fetch_array($caribook);
            $seatdeplast = $kebook[totbuking];
            $seatsisalast = $ulang[Seat] - $seatdeplast;
            $updet = mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdeplast',
                                                        SeatSisa='$seatsisalast'
                                                        WHERE IDProduct = '$_POST[idproduct]'");
            if ($_POST[autocsr] == 'YES' AND $dapet[CompanyID] == '1') {
                //CREATE CSR
                $catat = "$_SESSION[employee_name] ($_SESSION[employee_code]) $tahun1$tiket1";
                $detailamount = $_POST[depositamount];
                $remak = "$_POST[tourcode] ($tahun1$tiket1)";
                include "../config/koneksisql.php";
                mssql_query("INSERT INTO CashReceipt(CashReceiptId,
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
                                                            LTMBookingID,
                                                            CompanyID,
                                                            Remarks,
                                                            BOSOName,
                                                            BOSOAddress,
                                                            BOSOPhone,
                                                            BOSOFax,
                                                            BOSOEmail)
                                                    VALUES ('$csrtour',
                                                            '$today',
                                                            '$datadiv[ClientNo]',
                                                            '$datadiv[CompanyName]',
                                                            'FSD',
                                                            'IDR',
                                                            '$detailamount',
                                                            '0',
                                                            '0',
                                                            '0',
                                                            'A',
                                                            'SYSADMIN',
                                                            '$today',
                                                            'SYSADMIN',
                                                            '$today',
                                                            '$tahun1$tiket1',
                                                            '$norar[CompanyID]',
                                                            '$catat',
                                                            '$norar[DivisiName]',
                                                            '$norar[Address]',
                                                            '$norar[Phone]',
                                                            '$norar[Fax]',
                                                            '$norar[Email]')");
                // pembayaran
                $qcariindex = mssql_query("SELECT * FROM CashReceipt where CashReceiptId = '$csrtour' AND CompanyID ='$norar[CompanyID]'");
                $index = mssql_fetch_array($qcariindex);
                mssql_query("INSERT INTO CashReceipt_Payment(CashReceiptId,
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
                                                    VALUES ('$csrtour',
                                                            '$index[IndexCashReceiptHeader]',
                                                            '1',
                                                            'TOP UP',
                                                            '$remak',
                                                            'IDR',
                                                            '$detailamount',
                                                            '0',
                                                            '$detailamount',
                                                            'SYSADMIN',
                                                            '$today',
                                                            'SYSADMIN',
                                                            '$today')");
                $sqllasttopup = mssql_query("SELECT * FROM TopUpAccountBalance where ClientNo = '$datadiv[ClientNo]' and StatusLastBalance = 1 ");
                $lasttopup = mssql_fetch_array($sqllasttopup);
                $endingbalance = $lasttopup[EndingBalance] - $detailamount;
                $desc = "DEPOSIT $csrtour";
                mssql_query("INSERT INTO TopUpAccountBalance(ClientNo,
                                                            ClientName,
                                                            CategoryID,
                                                            CostCenter,
                                                            ReferenceID,
                                                            TypicalBalance,
                                                            Currency,
                                                            BeginningBalance,
                                                            Mutation,
                                                            EndingBalance,
                                                            WarningBalance,
                                                            MinimumBalance,
                                                            StatusLastBalance,
                                                            Description,
                                                            DateofCreated,
                                                            CreatedBy,
                                                            CompanyID,
                                                            StatusLastEmail)
                                                    VALUES ('$datadiv[ClientNo]',
                                                            '$datadiv[CompanyName]',
                                                            '$lasttopup[CategoryID]',
                                                            '$tahun1$tiket1',
                                                            '$csrtour',
                                                            'CREDIT',
                                                            'IDR',
                                                            '$lasttopup[EndingBalance]',
                                                            '$detailamount',
                                                            '$endingbalance',
                                                            '$lasttopup[WarningBalance]',
                                                            '$lasttopup[MinimumBalance]',
                                                            '1',
                                                            '$desc',
                                                            '$today',
                                                            'SYSADMIN',
                                                            '$norar[CompanyID]',
                                                            '$lasttopup[StatusLastEmail]')");
                mssql_query("UPDATE TopUpAccountBalance SET StatusLastBalance = 0 WHERE BalanceID = '$lasttopup[BalanceID]' ");
                mssql_close($linkptes);
                include "../config/koneksimaster.php";

            }
            //AUTO OPEN STATUS DOA
            $qopendoc = mysql_query(" SELECT SUM(AdultPax + ChildPax) as banyakseat 
                                        FROM tour_msbooking 
                                        WHERE IDTourcode = '$_POST[idproduct]' 
                                        AND Status = 'ACTIVE' 
                                        AND DUMMY = 'NO' ");
            $opendoc= mysql_fetch_array($qopendoc);
            if($opendoc[banyakseat] > 15){
                mysql_query("UPDATE tour_msproduct SET StatusDOA = 'OPEN' 
                                  WHERE IDProduct = '$_POST[idproduct]'
                                  AND StatusDOA = 'CLOSE' ");
            }
            //-------
            $Description = "Add New Booking ($tahun1$tiket1)";
            mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
            header("location:media.php?module=$mod");
        }
    }
//Input MS Booking detail
    elseif ($module=='msbookingdetail' AND $act=='input'){
        if($_POST[dobel]=='ya'){
            $depono="$_POST[depositno]";
            $duplicate='YES';
        }else{
            $ceking = mysql_query("SELECT DepositNo FROM tour_msbooking where DepositNo = '$_POST[depositno]' and Status ='ACTIVE'");
            $ketemu = mysql_num_rows($ceking);
            if($ketemu > 0){
                $depono="";$duplicate='';
            }else{$depono="$_POST[depositno]";$duplicate='NO';}
        }
        $bookid = $_POST[id];
        $Description="Edit Booking $bookid";
        $username=$_SESSION[namauser];
        $hari= date("Y", time());
        $bookersname=strtoupper($_POST[bookersname]);
        $bookersaddress=strtoupper($_POST[bookersaddress]);
        $emergencycall=strtoupper($_POST[emergencycall]);
        $kuery = mysql_query("SELECT * FROM tour_msproduct where IDProduct = '$_POST[idproduct]'");
        $dapet = mysql_fetch_array($kuery);

        $ada = mysql_num_rows($kuery);
        $startroom=$dapet[Room]+1;
        $endroom=$dapet[Room]+$_POST[totalroom];
        if($depono=='' )
        { $statbook = 'HOLD';$mod="msbookingdetail&act=editdetail&code=$bookid";//$mod="msbookingdetail";
        }else  if($depono<>'' ){$statbook = 'DEPOSIT';$mod="msbookingdetail&act=editdetail&code=$bookid";}
        //}else  if($depono<>'' && $_POST[depositamount]<>'' && $_POST[depositdate] <> ''){$statbook = 'DEPOSIT';$mod="msbookingdetail&act=editdetail&code=$bookid";}
        mysql_query("UPDATE tour_msbooking set  DepositDate = '$_POST[depositdate]',
                                                DepositNo = '$depono',
                                                DepositCurr = '$_POST[depositcurr]', 
                                                DepositAmount = '$_POST[depositamount]',
                                                BookingStatus = '$statbook'
                                                WHERE BookingID = '$bookid'");
        /*$jumlahseat= $_POST[adultpax] + $_POST[childpax];
        $jumlahseatb4= $_POST[adultpaxb4] + $_POST[childpaxb4];
        
        /*if($statbook == 'INQUIRY'){
            $inqseat = $dapet[SeatInquiry] + $jumlahseat;
            $inqseatafter = $inqseat - $jumlahseatb4;        
            mysql_query("UPDATE tour_msproduct SET SeatInquiry = '$inqseatafter'
                               WHERE IDProduct = '$_POST[idproduct]'");    
        }else if($statbook == 'DEPOSIT'){
            $inqseat = $dapet[SeatInquiry] - $jumlahseatb4;
            $seatdep = $dapet[SeatDeposit] + $jumlahseat;
            $jumroom = $dapet[Room] + $_POST[totalroom];
            $sisaseat = $dapet[Seat] - $seatdep;
            $bookseat = $dapet[SeatBooking] + $seatdep;
            $gruptype=$dapet[GroupType];
            if($gruptype=='CRUISE'){$rumtype='12 Pax';}else{$rumtype='Twin';}
            mysql_query("UPDATE tour_msproduct SET SeatDeposit = '$seatdep',
                                   SeatSisa = '$sisaseat',
                                   SeatBooking = '$bookseat',
                                   SeatInquiry = '$inqseat',
                                   Room = '$jumroom'
                               WHERE IDProduct = '$_POST[idproduct]'");
            $adulpax=$_POST[adultpax];
            for ($satu=1; $satu<=$adulpax; $satu++) {
                $ad = mysql_query("SELECT count(tour_msbookingdetail.IDDetail) as uruta FROM tour_msbookingdetail
                                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                    WHERE tour_msbooking.IDTourcode = '$_POST[idproduct]'
                                    and tour_msbookingdetail.Gender <> 'INFANT'
                                    AND tour_msbookingdetail.Status<>'CANCEL'
                                    and tour_msbooking.Status = 'ACTIVE'
                                    ORDER BY Urutan DESC");
                $isiad = mysql_fetch_array($ad);
                $mulai=$isiad[uruta];
                $urut=$mulai+1;
                $d = mysql_query("SELECT * FROM tour_msdiscount
                                    left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct
                                    WHERE tour_msproduct.IDProduct = '$_POST[idproduct]' and tour_msdiscount.Status='ACTIVE' ");
                $dd = mysql_fetch_array($d);
                if($urut<=$dd[Max1]){$dis=$dd[Disc1];}
                else if($urut<=$dd[Max2]){$dis=$dd[Disc2];}
                else if($urut<=$dd[Max3]){$dis=$dd[Disc3];}
                else if($urut<=$dd[Max4]){$dis=$dd[Disc4];}
                else if($urut<=$dd[Max5]){$dis=$dd[Disc5];}
                else if($urut<=$dd[Max6]){$dis=$dd[Disc6];}
                else if($urut<=$dd[Max7]){$dis=$dd[Disc7];}
                else $dis='0';
                if($dis==''){$dis='0';}
                $subtotal = $dd[SellingAdlTwn] - $dis;
                mysql_query("INSERT INTO tour_msbookingdetail(Urutan,IDTourcode,TourCode,BookingID,Gender,Package,RoomType,Discount,Price,SubTotal,Status)
                                            VALUES ('$urut','$_POST[idproduct]','$_POST[tourcode]','$bookid','ADULT','Tour','$rumtype','$dis','$dd[SellingAdlTwn]','$subtotal','$dis')");
            }
            $chilpax=$_POST[childpax];
            for ($satu=1; $satu<=$chilpax; $satu++) {
                $ad = mysql_query("SELECT count(tour_msbookingdetail.IDDetail) as uruta FROM tour_msbookingdetail
                                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                    WHERE tour_msbooking.IDTourcode = '$_POST[idproduct]'
                                    and tour_msbookingdetail.Gender <> 'INFANT'
                                    AND tour_msbookingdetail.Status<>'CANCEL'
                                    and tour_msbooking.Status = 'ACTIVE'
                                    ORDER BY Urutan DESC");
                $isiad = mysql_fetch_array($ad);
                $mulai=$isiad[uruta];
                $urut=$mulai+1;
                $d = mysql_query("SELECT * FROM tour_msdiscount
                                    left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct
                                    WHERE tour_msproduct.IDProduct = '$_POST[idproduct]' and tour_msdiscount.Status='ACTIVE'  ");
                $dd = mysql_fetch_array($d);
                if($urut<=$dd[Max1]){$dis=$dd[Disc1];}
                else if($urut<=$dd[Max2]){$dis=$dd[Disc2];}
                else if($urut<=$dd[Max3]){$dis=$dd[Disc3];}
                else if($urut<=$dd[Max4]){$dis=$dd[Disc4];}
                else if($urut<=$dd[Max5]){$dis=$dd[Disc5];}
                else if($urut<=$dd[Max6]){$dis=$dd[Disc6];}
                else if($urut<=$dd[Max7]){$dis=$dd[Disc7];}
                else $dis='0';
                if($dis==''){$dis='0';}
                $subtotal = $dd[SellingChdTwn] - $dis;
                mysql_query("INSERT INTO tour_msbookingdetail(Urutan,IDTourcode,TourCode,BookingID,Gender,Package,RoomType,Discount,Price,SubTotal,Status)
                                            VALUES ('$urut','$_POST[idproduct]','$_POST[tourcode]','$bookid','CHILD','Tour','$rumtype','$dis','$dd[SellingChdTwn]','$subtotal','$dis')");
            }
            $infanpax=$_POST[infantpax];
            for ($satu=0; $satu<$infanpax; $satu++) {
                $cadltwn=mysql_query("SELECT * FROM tour_msproduct
                                        WHERE IDProduct = '$_POST[idproduct]'");
                $harga=mysql_fetch_array($cadltwn);
                mysql_query("INSERT INTO tour_msbookingdetail(IDTourcode,TourCode,BookingID,Gender,Package,RoomType,Price,SubTotal,Status)
                                            VALUES ('$_POST[idproduct]','$_POST[tourcode]','$bookid','INFANT','Tour','No Bed','$harga[SellingInfant]','$harga[SellingInfant]','0')");
            }*/
        //update PTES
        $nocsr=substr($_POST[depositno],0,3);
        //if(($offgroup =='PANORAMA TOURS' AND !preg_match('/LTM/',$EmpOff)) OR $offgroup <> 'PANORAMA WORLD' OR $offgroup <> 'SISTER COMPANY'){
        if($nocsr=='CSR'){
            mssql_query("UPDATE [PTES].[dbo].[CashReceipt] set [LTMBookingID] = '$tahun1$tiket1'
                                                    WHERE [CashReceiptId] = '$_POST[depositno]' AND [COMPANYID]= '$company' ");
        }
        //}
        /*$isitot = mysql_query("SELECT sum(SubTotal)as jumtot FROM tour_msbookingdetail WHERE TourCode = '$_POST[tourcode]' and BookingID = '$bookid' group by TourCode");
        $tot = mysql_fetch_array($isitot);

        mysql_query("UPDATE tour_msbooking set  TotalPrice = '$tot[jumtot]'
                                                WHERE BookingID = '$bookid'");
        //update jumlah product
        $mencari1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_POST[idproduct]' and Status <> 'VOID' ");
        $ulang=mysql_fetch_array($mencari1);
        $caribook=mysql_query("SELECT count(IDDetail) as totbuking FROM tour_msbookingdetail WHERE IDTourcode = '$_POST[idproduct]' and Gender <> 'INFANT' and Status <> 'CANCEL'");
        $kebook=mysql_fetch_array($caribook);
        $seatdeplast = $kebook[totbuking];
        $seatsisalast = $ulang[Seat] - $seatdeplast;
        $updet=mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdeplast',
                                                        SeatSisa='$seatsisalast'
                                                        WHERE IDProduct = '$_POST[idproduct]'");*/
        //-------
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$mod);
    }
// Update MS Booking detail
    elseif ($module=='msbookingdetail' AND $act=='update'){
        $bookid = $_POST[id];
        $prodid = $_POST[idprod];
        $Description="Edit Detail Booking $bookid";
        $username=$_SESSION[namauser];
        $Notes = strtoupper($_POST[operationnote]);
        $bookersaddress=strtoupper($_POST[bookersaddress]);
        $emergencycall=strtoupper($_POST[emergencycall]);
        $perdisc = $_POST[xtradisc] / $_POST[banyak];
        $awal=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$prodid' and Status <> 'VOID'");
        $curawal=mysql_fetch_array($awal);

        for ($satu=1; $satu<=$_POST[banyak]; $satu++) {
            $isig1=$_POST[iddetail.$satu];
            $isig2=strtoupper($_POST[paxname.$satu]);
            $isig3=$_POST[title.$satu];
            $isig4=$_POST[noroom.$satu];
            $isig5=$_POST[room.$satu];
            $isig6=$_POST[harga.$satu];
            $isig7=$_POST[add.$satu];
            $isig8=$_POST[total.$satu];
            $isig9=$_POST[package.$satu];
            $isig10=$_POST[gen.$satu];
            if($satu==$_POST[banyak]){
                $kali=$_POST[banyak] -1;
                $discpaxb=floor($perdisc * 100) / 100 ;
                $discpaxs=round($discpaxb,1);
                $tes=$discpaxs*$kali;
                $discpax=round($_POST[xtradisc] - $tes,1);
                // $discpax=floor($perdisc * 100) / 100 ;
            }else{
                $discpaxa=floor($perdisc * 100) / 100 ;
                $discpax=round($discpaxa,1);
            }
            //bila company sama
            if($offgroup==$curawal[Company]){
                if($EmpOff==$curawal[InputDivision]){
                    $qpriceinv=mysql_query("SELECT * FROM tour_msproductprice WHERE PriceFor = 'GENERAL' and ProductID = '$prodid' ");
                    $harga=mysql_fetch_array($qpriceinv);

                    //HARGA BILA CRUISE
                    if($curawal[GroupType]=='CRUISE'){
                        if($isig10=='ADULT' and $isig9=='Tour'){
                            if($isig5=='12 Pax'){$hargaroom=$harga[CruiseAdl12];$pricenet='0';}
                            if($isig5=='34 Pax'){$hargaroom=$harga[CruiseAdl34];$pricenet='0';}
                            if($isig5=='1 Pax'){$hargaroom=$harga[CruiseAdl12]+$curawal[SingleSell];$pricenet='0';}
                        }else if($isig10=='CHILD' and $isig9=='Tour'){
                            if($isig5=='12 Pax'){$hargaroom=$harga[CruiseChd12];$pricenet='0';}
                            if($isig5=='34 Pax'){$hargaroom=$harga[CruiseChd34];$pricenet='0';}
                            if($isig5=='1 Pax'){$hargaroom=$harga[CruiseChd12]+$curawal[SingleSell];$pricenet='0';}
                        }else if($isig10=='INFANT' and $isig9=='Tour'){$hargaroom=$harga[SellingInfant];$pricenet='0';
                        }else if($isig10=='ADULT' and $isig9=='L.A Only'){
                            if($isig5=='12 Pax'){$hargaroom=$harga[CruiseLoAdl12];$pricenet='0';}
                            if($isig5=='34 Pax'){$hargaroom=$harga[CruiseLoAdl34];$pricenet='0';}
                            if($isig5=='1 Pax'){$hargaroom=$harga[CruiseLoAdl12]+$curawal[SingleSell];$pricenet='0';}
                        }else if($isig10=='CHILD' and $isig9=='L.A Only'){
                            if($isig5=='12 Pax'){$hargaroom=$harga[CruiseLoChd12];$pricenet='0';}
                            if($isig5=='34 Pax'){$hargaroom=$harga[CruiseLoChd34];$pricenet='0';}
                            if($isig5=='1 Pax'){$hargaroom=$harga[CruiseLoChd12]+$curawal[SingleSell];$pricenet='0';}
                        }else if($isig10=='INFANT' and $isig9=='L.A Only'){$hargaroom=$harga[LAInfant];$pricenet='0';}
                        //BILA HARGA TOUR
                    }else{
                        if($isig10=='ADULT' and $isig9=='Tour'){
                            if($isig5=='Twin'){$hargaroom=$harga[SellingAdlTwn];$pricenet='0';}
                            if($isig5=='Double'){$hargaroom=$harga[SellingAdlTwn];$pricenet='0';}
                            if($isig5=='Single'){$hargaroom=$harga[SellingAdlTwn]+$curawal[SingleSell];$pricenet='0';}
                            if($isig5=='Triple'){$hargaroom=$harga[SellingAdlTwn];$pricenet='0';}
                        }else if($isig10=='CHILD' and $isig9=='Tour'){
                            if($isig5=='Twin'){$hargaroom=$harga[SellingChdTwn];$pricenet='0';}
                            if($isig5=='Double'){$hargaroom=$harga[SellingChdTwn];$pricenet='0';}
                            if($isig5=='Xtra Bed'){$hargaroom=$harga[SellingChdXbed];$pricenet='0';}
                            if($isig5=='No Bed'){$hargaroom=$harga[SellingChdNbed];$pricenet='0';}
                            if($isig5=='Single'){$hargaroom=$harga[SellingChdTwn]+$curawal[SingleSell];$pricenet='0';}
                            if($isig5=='Triple'){$hargaroom=$harga[SellingChdTwn];$pricenet='0';}
                        }else if($isig10=='INFANT' and $isig9=='Tour'){$hargaroom=$harga[SellingInfant];$pricenet='0';
                        }else if($isig10=='ADULT' and $isig9=='L.A Only'){
                            if($isig5=='Twin'){$hargaroom=$harga[LAAdlTwn];$pricenet='0';}
                            if($isig5=='Double'){$hargaroom=$harga[LAAdlTwn];$pricenet='0';}
                            if($isig5=='Single'){$hargaroom=$harga[LAAdlTwn]+$curawal[SingleSell];$pricenet='0';}
                            if($isig5=='Triple'){$hargaroom=$harga[LAAdlTwn];$pricenet='0';}
                        }else if($isig10=='CHILD' and $isig9=='L.A Only'){
                            if($isig5=='Twin'){$hargaroom=$harga[LAChdTwn];$pricenet='0';}
                            if($isig5=='Double'){$hargaroom=$harga[LAChdTwn];$pricenet='0';}
                            if($isig5=='Xtra Bed'){$hargaroom=$harga[LAChdXbed];$pricenet='0';}
                            if($isig5=='No Bed'){$hargaroom=$harga[LAChdNbed];$pricenet='0';}
                            if($isig5=='Single'){$hargaroom=$harga[LAChdTwn]+$curawal[SingleSell];$pricenet='0';}
                            if($isig5=='Triple'){$hargaroom=$harga[LAChdTwn];$pricenet='0';}
                        }else if($isig10=='INFANT' and $isig9=='L.A Only'){$hargaroom=$harga[LAInfant];$pricenet='0';}
                    }
                }
                else{
                    $qpriceinv=mysql_query("SELECT * FROM tour_msproductprice WHERE PriceFor = 'GENERAL' and ProductID = '$prodid' ");
                    $harga=mysql_fetch_array($qpriceinv);
                    $qpricenet=mysql_query("SELECT * FROM tour_msproductprice WHERE PriceFor = 'INTERNAL' and ProductID = '$prodid' ");
                    $harganet=mysql_fetch_array($qpricenet);

                    //HARGA BILA CRUISE
                    if($curawal[GroupType]=='CRUISE'){
                        if($isig10=='ADULT' and $isig9=='Tour'){
                            if($isig5=='12 Pax'){$hargaroom=$harga[CruiseAdl12];$pricenet=$harganet[CruiseAdl12];}
                            if($isig5=='34 Pax'){$hargaroom=$harga[CruiseAdl34];$pricenet=$harganet[CruiseAdl34];}
                            if($isig5=='1 Pax'){$hargaroom=$harga[CruiseAdl12]+$curawal[SingleSell];$pricenet=$harganet[CruiseAdl12]+$curawal[SingleSell];}
                        }else if($isig10=='CHILD' and $isig9=='Tour'){
                            if($isig5=='12 Pax'){$hargaroom=$harga[CruiseChd12];$pricenet=$harganet[CruiseChd12];}
                            if($isig5=='34 Pax'){$hargaroom=$harga[CruiseChd34];$pricenet=$harganet[CruiseChd34];}
                            if($isig5=='1 Pax'){$hargaroom=$harga[CruiseChd12]+$curawal[SingleSell];$pricenet=$harganet[CruiseChd12]+$curawal[SingleSell];}
                        }else if($isig10=='INFANT' and $isig9=='Tour'){$hargaroom=$harga[SellingInfant];$pricenet=$harganet[SellingInfant];
                        }else if($isig10=='ADULT' and $isig9=='L.A Only'){
                            if($isig5=='12 Pax'){$hargaroom=$harga[CruiseLoAdl12];$pricenet=$harganet[CruiseLoAdl12];}
                            if($isig5=='34 Pax'){$hargaroom=$harga[CruiseLoAdl34];$pricenet=$harganet[CruiseLoAdl34];}
                            if($isig5=='1 Pax'){$hargaroom=$harga[CruiseLoAdl12]+$curawal[SingleSell];$pricenet=$harganet[CruiseLoAdl12]+$curawal[SingleSell];}
                        }else if($isig10=='CHILD' and $isig9=='L.A Only'){
                            if($isig5=='12 Pax'){$hargaroom=$harga[CruiseLoChd12];$pricenet=$harganet[CruiseLoChd12];}
                            if($isig5=='34 Pax'){$hargaroom=$harga[CruiseLoChd34];$pricenet=$harganet[CruiseLoChd34];}
                            if($isig5=='1 Pax'){$hargaroom=$harga[CruiseLoChd12]+$curawal[SingleSell];$pricenet=$harganet[CruiseLoChd12]+$curawal[SingleSell];}
                        }else if($isig10=='INFANT' and $isig9=='L.A Only'){$hargaroom=$harga[LAInfant];$pricenet=$harganet[LAInfant];}
                        //BILA HARGA TOUR
                    }else{
                        if($isig10=='ADULT' and $isig9=='Tour'){
                            if($isig5=='Twin'){$hargaroom=$harga[SellingAdlTwn];$pricenet=$harganet[SellingAdlTwn];}
                            if($isig5=='Double'){$hargaroom=$harga[SellingAdlTwn];$pricenet=$harganet[SellingAdlTwn];}
                            if($isig5=='Single'){$hargaroom=$harga[SellingAdlTwn]+$curawal[SingleSell];$pricenet=$harganet[SellingAdlTwn]+$curawal[SingleSell];}
                            if($isig5=='Triple'){$hargaroom=$harga[SellingAdlTwn];$pricenet=$harganet[SellingAdlTwn];}
                        }else if($isig10=='CHILD' and $isig9=='Tour'){
                            if($isig5=='Twin'){$hargaroom=$harga[SellingChdTwn];$pricenet=$harganet[SellingChdTwn];}
                            if($isig5=='Double'){$hargaroom=$harga[SellingChdTwn];$pricenet=$harganet[SellingChdTwn];}
                            if($isig5=='Xtra Bed'){$hargaroom=$harga[SellingChdXbed];$pricenet=$harganet[SellingChdXbed];}
                            if($isig5=='No Bed'){$hargaroom=$harga[SellingChdNbed];$pricenet=$harganet[SellingChdNbed];}
                            if($isig5=='Single'){$hargaroom=$harga[SellingChdTwn]+$curawal[SingleSell];$pricenet=$harganet[SellingChdTwn]+$curawal[SingleSell];}
                            if($isig5=='Triple'){$hargaroom=$harga[SellingChdTwn];$pricenet=$harganet[SellingChdTwn];}
                        }else if($isig10=='INFANT' and $isig9=='Tour'){$hargaroom=$harga[SellingInfant];$pricenet=$harganet[SellingInfant];
                        }else if($isig10=='ADULT' and $isig9=='L.A Only'){
                            if($isig5=='Twin'){$hargaroom=$harga[LAAdlTwn];$pricenet=$harganet[LAAdlTwn];}
                            if($isig5=='Double'){$hargaroom=$harga[LAAdlTwn];$pricenet=$harganet[LAAdlTwn];}
                            if($isig5=='Single'){$hargaroom=$harga[LAAdlTwn]+$curawal[SingleSell];$pricenet=$harganet[LAAdlTwn]+$curawal[SingleSell];}
                            if($isig5=='Triple'){$hargaroom=$harga[LAAdlTwn];$pricenet=$harganet[LAAdlTwn];}
                        }else if($isig10=='CHILD' and $isig9=='L.A Only'){
                            if($isig5=='Twin'){$hargaroom=$harga[LAChdTwn];$pricenet=$harganet[LAChdTwn];}
                            if($isig5=='Double'){$hargaroom=$harga[LAChdTwn];$pricenet=$harganet[LAChdTwn];}
                            if($isig5=='Xtra Bed'){$hargaroom=$harga[LAChdXbed];$pricenet=$harganet[LAChdXbed];}
                            if($isig5=='No Bed'){$hargaroom=$harga[LAChdNbed];$pricenet=$harganet[LAChdNbed];}
                            if($isig5=='Single'){$hargaroom=$harga[LAChdTwn]+$curawal[SingleSell];$pricenet=$harganet[LAChdTwn]+$curawal[SingleSell];}
                            if($isig5=='Triple'){$hargaroom=$harga[LAChdTwn];$pricenet=$harganet[LAChdTwn];}
                        }else if($isig10=='INFANT' and $isig9=='L.A Only'){$hargaroom=$harga[LAInfant];$pricenet=$harganet[LAInfant];}
                    }
                }
            }else if($offgroup=='SISTER COMPANY' OR $offgroup=='TUR EZ' OR $offgroup=='PANORAMA TOURS'){
                $qpriceinv=mysql_query("SELECT * FROM tour_msproductprice WHERE PriceFor = 'SISTER COMPANY' and ProductID = '$prodid' ");
                $harga=mysql_fetch_array($qpriceinv);

                //HARGA BILA CRUISE
                if($curawal[GroupType]=='CRUISE'){
                    if($isig10=='ADULT' and $isig9=='Tour'){
                        if($isig5=='12 Pax'){$hargaroom=$harga[CruiseAdl12];$pricenet='0';}
                        if($isig5=='34 Pax'){$hargaroom=$harga[CruiseAdl34];$pricenet='0';}
                        if($isig5=='1 Pax'){$hargaroom=$harga[CruiseAdl12]+$curawal[SingleSell];$pricenet='0';}
                    }else if($isig10=='CHILD' and $isig9=='Tour'){
                        if($isig5=='12 Pax'){$hargaroom=$harga[CruiseChd12];$pricenet='0';}
                        if($isig5=='34 Pax'){$hargaroom=$harga[CruiseChd34];$pricenet='0';}
                        if($isig5=='1 Pax'){$hargaroom=$harga[CruiseChd12]+$curawal[SingleSell];$pricenet='0';}
                    }else if($isig10=='INFANT' and $isig9=='Tour'){$hargaroom=$harga[SellingInfant];$pricenet='0';
                    }else if($isig10=='ADULT' and $isig9=='L.A Only'){
                        if($isig5=='12 Pax'){$hargaroom=$harga[CruiseLoAdl12];$pricenet='0';}
                        if($isig5=='34 Pax'){$hargaroom=$harga[CruiseLoAdl34];$pricenet='0';}
                        if($isig5=='1 Pax'){$hargaroom=$harga[CruiseLoAdl12]+$curawal[SingleSell];$pricenet='0';}
                    }else if($isig10=='CHILD' and $isig9=='L.A Only'){
                        if($isig5=='12 Pax'){$hargaroom=$harga[CruiseLoChd12];$pricenet='0';}
                        if($isig5=='34 Pax'){$hargaroom=$harga[CruiseLoChd34];$pricenet='0';}
                        if($isig5=='1 Pax'){$hargaroom=$harga[CruiseLoChd12]+$curawal[SingleSell];$pricenet='0';}
                    }else if($isig10=='INFANT' and $isig9=='L.A Only'){$hargaroom=$harga[LAInfant];$pricenet='0';}
                    //BILA HARGA TOUR
                }else{
                    if($isig10=='ADULT' and $isig9=='Tour'){
                        if($isig5=='Twin'){$hargaroom=$harga[SellingAdlTwn];$pricenet='0';}
                        if($isig5=='Double'){$hargaroom=$harga[SellingAdlTwn];$pricenet='0';}
                        if($isig5=='Single'){$hargaroom=$harga[SellingAdlTwn]+$curawal[SingleSell];$pricenet='0';}
                        if($isig5=='Triple'){$hargaroom=$harga[SellingAdlTwn];$pricenet='0';}
                    }else if($isig10=='CHILD' and $isig9=='Tour'){
                        if($isig5=='Twin'){$hargaroom=$harga[SellingChdTwn];$pricenet='0';}
                        if($isig5=='Double'){$hargaroom=$harga[SellingChdTwn];$pricenet='0';}
                        if($isig5=='Xtra Bed'){$hargaroom=$harga[SellingChdXbed];$pricenet='0';}
                        if($isig5=='No Bed'){$hargaroom=$harga[SellingChdNbed];$pricenet='0';}
                        if($isig5=='Single'){$hargaroom=$harga[SellingChdTwn]+$curawal[SingleSell];$pricenet='0';}
                        if($isig5=='Triple'){$hargaroom=$harga[SellingChdTwn];$pricenet='0';}
                    }else if($isig10=='INFANT' and $isig9=='Tour'){$hargaroom=$harga[SellingInfant];$pricenet='0';
                    }else if($isig10=='ADULT' and $isig9=='L.A Only'){
                        if($isig5=='Twin'){$hargaroom=$harga[LAAdlTwn];$pricenet='0';}
                        if($isig5=='Double'){$hargaroom=$harga[LAAdlTwn];$pricenet='0';}
                        if($isig5=='Single'){$hargaroom=$harga[LAAdlTwn]+$curawal[SingleSell];$pricenet='0';}
                        if($isig5=='Triple'){$hargaroom=$harga[LAAdlTwn];$pricenet='0';}
                    }else if($isig10=='CHILD' and $isig9=='L.A Only'){
                        if($isig5=='Twin'){$hargaroom=$harga[LAChdTwn];$pricenet='0';}
                        if($isig5=='Double'){$hargaroom=$harga[LAChdTwn];$pricenet='0';}
                        if($isig5=='Xtra Bed'){$hargaroom=$harga[LAChdXbed];$pricenet='0';}
                        if($isig5=='No Bed'){$hargaroom=$harga[LAChdNbed];$pricenet='0';}
                        if($isig5=='Single'){$hargaroom=$harga[LAChdTwn]+$curawal[SingleSell];$pricenet='0';}
                        if($isig5=='Triple'){$hargaroom=$harga[LAChdTwn];$pricenet='0';}
                    }else if($isig10=='INFANT' and $isig9=='L.A Only'){$hargaroom=$harga[LAInfant];$pricenet='0';}
                }

            }
            else {
                $qpriceinv=mysql_query("SELECT * FROM tour_msproductprice WHERE PriceFor = '$offgroup' and ProductID = '$prodid' ");
                $harga=mysql_fetch_array($qpriceinv);

                //HARGA BILA CRUISE
                if($curawal[GroupType]=='CRUISE'){
                    if($isig10=='ADULT' and $isig9=='Tour'){
                        if($isig5=='12 Pax'){$hargaroom=$harga[CruiseAdl12];$pricenet='0';}
                        if($isig5=='34 Pax'){$hargaroom=$harga[CruiseAdl34];$pricenet='0';}
                        if($isig5=='1 Pax'){$hargaroom=$harga[CruiseAdl12]+$curawal[SingleSell];$pricenet='0';}
                    }else if($isig10=='CHILD' and $isig9=='Tour'){
                        if($isig5=='12 Pax'){$hargaroom=$harga[CruiseChd12];$pricenet='0';}
                        if($isig5=='34 Pax'){$hargaroom=$harga[CruiseChd34];$pricenet='0';}
                        if($isig5=='1 Pax'){$hargaroom=$harga[CruiseChd12]+$curawal[SingleSell];$pricenet='0';}
                    }else if($isig10=='INFANT' and $isig9=='Tour'){$hargaroom=$harga[SellingInfant];$pricenet='0';
                    }else if($isig10=='ADULT' and $isig9=='L.A Only'){
                        if($isig5=='12 Pax'){$hargaroom=$harga[CruiseLoAdl12];$pricenet='0';}
                        if($isig5=='34 Pax'){$hargaroom=$harga[CruiseLoAdl34];$pricenet='0';}
                        if($isig5=='1 Pax'){$hargaroom=$harga[CruiseLoAdl12]+$curawal[SingleSell];$pricenet='0';}
                    }else if($isig10=='CHILD' and $isig9=='L.A Only'){
                        if($isig5=='12 Pax'){$hargaroom=$harga[CruiseLoChd12];$pricenet='0';}
                        if($isig5=='34 Pax'){$hargaroom=$harga[CruiseLoChd34];$pricenet='0';}
                        if($isig5=='1 Pax'){$hargaroom=$harga[CruiseLoChd12]+$curawal[SingleSell];$pricenet='0';}
                    }else if($isig10=='INFANT' and $isig9=='L.A Only'){$hargaroom=$harga[LAInfant];$pricenet='0';}
                    //BILA HARGA TOUR
                }else{
                    if($isig10=='ADULT' and $isig9=='Tour'){
                        if($isig5=='Twin'){$hargaroom=$harga[SellingAdlTwn];$pricenet='0';}
                        if($isig5=='Double'){$hargaroom=$harga[SellingAdlTwn];$pricenet='0';}
                        if($isig5=='Single'){$hargaroom=$harga[SellingAdlTwn]+$curawal[SingleSell];$pricenet='0';}
                        if($isig5=='Triple'){$hargaroom=$harga[SellingAdlTwn];$pricenet='0';}
                    }else if($isig10=='CHILD' and $isig9=='Tour'){
                        if($isig5=='Twin'){$hargaroom=$harga[SellingChdTwn];$pricenet='0';}
                        if($isig5=='Double'){$hargaroom=$harga[SellingChdTwn];$pricenet='0';}
                        if($isig5=='Xtra Bed'){$hargaroom=$harga[SellingChdXbed];$pricenet='0';}
                        if($isig5=='No Bed'){$hargaroom=$harga[SellingChdNbed];$pricenet='0';}
                        if($isig5=='Single'){$hargaroom=$harga[SellingChdTwn]+$curawal[SingleSell];$pricenet='0';}
                        if($isig5=='Triple'){$hargaroom=$harga[SellingChdTwn];$pricenet='0';}
                    }else if($isig10=='INFANT' and $isig9=='Tour'){$hargaroom=$harga[SellingInfant];$pricenet='0';
                    }else if($isig10=='ADULT' and $isig9=='L.A Only'){
                        if($isig5=='Twin'){$hargaroom=$harga[LAAdlTwn];$pricenet='0';}
                        if($isig5=='Double'){$hargaroom=$harga[LAAdlTwn];$pricenet='0';}
                        if($isig5=='Single'){$hargaroom=$harga[LAAdlTwn]+$curawal[SingleSell];$pricenet='0';}
                        if($isig5=='Triple'){$hargaroom=$harga[LAAdlTwn];$pricenet='0';}
                    }else if($isig10=='CHILD' and $isig9=='L.A Only'){
                        if($isig5=='Twin'){$hargaroom=$harga[LAChdTwn];$pricenet='0';}
                        if($isig5=='Double'){$hargaroom=$harga[LAChdTwn];$pricenet='0';}
                        if($isig5=='Xtra Bed'){$hargaroom=$harga[LAChdXbed];$pricenet='0';}
                        if($isig5=='No Bed'){$hargaroom=$harga[LAChdNbed];$pricenet='0';}
                        if($isig5=='Single'){$hargaroom=$harga[LAChdTwn]+$curawal[SingleSell];$pricenet='0';}
                        if($isig5=='Triple'){$hargaroom=$harga[LAChdTwn];$pricenet='0';}
                    }else if($isig10=='INFANT' and $isig9=='L.A Only'){$hargaroom=$harga[LAInfant];$pricenet='0';}
                }

            }
            $parts = explode(" ", $isig2);
            $lastname = array_pop($parts);
            $firstname = implode(" ", $parts);
            if($firstname==''){$firstname=$lastname;$lastname='';}
            mysql_query("UPDATE tour_msbookingdetail set  PaxName = '$isig2',
                                                FirstPaxName = '$firstname',
                                                LastPaxName='$lastname',
                                                Title = '$isig3',
                                                RoomNo = '$isig4',
                                                RoomType = '$isig5',
                                                PriceNett = '$pricenet',
                                                PriceInvoice = '$hargaroom',
                                                Price = '$isig6',
                                                AddCharge = '$isig7',        
                                                SubTotal = '$isig8',
                                                XtraDiscount = '$discpax',
                                                Package = '$isig9',
                                                Gender = '$isig10'
                                                WHERE IDDetail = '$isig1'");

        }
        $jumtotal1=str_replace(".", "",$_POST[jumtotal]);
        $jumtotal=str_replace(",", ".",$jumtotal1);
        $kuericeka=mysql_query("SELECT count(Gender)as paxadult FROM tour_msbookingdetail WHERE BookingID = '$bookid' and Gender='ADULT' and Status<>'CANCEL' group by Gender");
        $cekulanga=mysql_fetch_array($kuericeka);
        $kuericekc=mysql_query("SELECT count(Gender)as paxchild FROM tour_msbookingdetail WHERE BookingID = '$bookid' and Gender='CHILD' and Status<>'CANCEL' group by Gender");
        $cekulangc=mysql_fetch_array($kuericekc);
        $kuericeki=mysql_query("SELECT count(Gender)as paxinfant FROM tour_msbookingdetail WHERE BookingID = '$bookid' and Gender='INFANT' and Status<>'CANCEL' group by Gender");
        $cekulangi=mysql_fetch_array($kuericeki);
        if($cekulanga[paxadult]==''){$apax='0';}else{$apax=$cekulanga[paxadult];}
        if($cekulangc[paxchild]==''){$cpax='0';}else{$cpax=$cekulangc[paxchild];}
        if($cekulangi[paxinfant]==''){$ipax='0';}else{$ipax=$cekulangi[paxinfant];}
        mysql_query("UPDATE tour_msbooking set AdultPax = '$apax',
                                              ChildPax = '$cpax',
                                              InfantPax = '$ipax',
                                              ExtraDiscount = '$_POST[xtradisc]',
                                              TotalPrice = '$jumtotal',
                                              TotalPriceOri = '$jumtotal',
                                              BookersTelp = '$_POST[bookerstelp]',
                                              BookersMobile = '$_POST[bookersmobile]',
                                              BookersAddress = '$bookersaddress',      
                                              EmergencyCall = '$emergencycall',
                                              OperationNote = '$Notes'  
       WHERE BookingID = '$bookid'");
        mysql_query("UPDATE tour_tbfbooking set AdultPax = '$apax',
                                              ChildPax = '$cpax',
                                              InfantPax = '$ipax',
                                              ExtraDiscount = '$_POST[xtradisc]',
                                              TotalPrice = '$jumtotal',
                                              BookersTelp = '$_POST[bookerstelp]',
                                              BookersMobile = '$_POST[bookersmobile]',
                                              BookersAddress = '$bookersaddress',      
                                              EmergencyCall = '$emergencycall',
                                              OperationNote = '$Notes'  
       WHERE BookingID = '$bookid'");
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header("location:media.php?module=$_POST[moduls]");

    }
// Update MS Booking details
    elseif ($module=='msbookingdetails' AND $act=='update'){
        $bookid = $_POST[id];
        $Description="Edit Detail Booking $bookid";
        $username=$_SESSION[namauser];
        $Notes = strtoupper($_POST[operationnote]);
        $bookersaddress=strtoupper($_POST[bookersaddress]);
        $emergencycall=strtoupper($_POST[emergencycall]);
        $perdisc = $_POST[xtradisc] / $_POST[banyak];

        for ($satu=1; $satu<=$_POST[banyak]; $satu++) {
            $isig1=$_POST[iddetail.$satu];
            $isig2=strtoupper($_POST[paxname.$satu]);
            $isig3=$_POST[title.$satu];
            $isig4=$_POST[noroom.$satu];
            $isig5=$_POST[room.$satu];
            $isig6=$_POST[harga.$satu];
            $isig7=$_POST[add.$satu];
            $isig8=$_POST[total.$satu];
            $isig9=$_POST[package.$satu];
            $isig10=$_POST[gen.$satu];
            if($satu==$_POST[banyak]){
                $kali=$_POST[banyak] -1;
                $discpaxb=floor($perdisc * 100) / 100 ;
                $discpaxs=round($discpaxb,1);
                $tes=$discpaxs*$kali;
                $discpax=round($_POST[xtradisc] - $tes,1);
                // $discpax=floor($perdisc * 100) / 100 ;
            }else{
                $discpaxa=floor($perdisc * 100) / 100 ;
                $discpax=round($discpaxa,1);
            }
            $parts = explode(" ", $isig2);
            $lastname = array_pop($parts);
            $firstname = implode(" ", $parts);
            if($firstname==''){$firstname=$lastname;$lastname='';}
            mysql_query("UPDATE tour_msbookingdetail set  PaxName = '$isig2',
                                                FirstPaxName = '$firstname',
                                                LastPaxName='$lastname',
                                                Title = '$isig3',
                                                RoomNo = '$isig4',
                                                RoomType = '$isig5'
                                                WHERE IDDetail = '$isig1'");
        }
        $jumtotal1=str_replace(".", "",$_POST[jumtotal]);
        $jumtotal=str_replace(",", ".",$jumtotal1);
        $kuericeka=mysql_query("SELECT count(Gender)as paxadult FROM tour_msbookingdetail WHERE BookingID = '$bookid' and Gender='ADULT' and Status<>'CANCEL' group by Gender");
        $cekulanga=mysql_fetch_array($kuericeka);
        $kuericekc=mysql_query("SELECT count(Gender)as paxchild FROM tour_msbookingdetail WHERE BookingID = '$bookid' and Gender='CHILD' and Status<>'CANCEL' group by Gender");
        $cekulangc=mysql_fetch_array($kuericekc);
        $kuericeki=mysql_query("SELECT count(Gender)as paxinfant FROM tour_msbookingdetail WHERE BookingID = '$bookid' and Gender='INFANT' and Status<>'CANCEL' group by Gender");
        $cekulangi=mysql_fetch_array($kuericeki);
        if($cekulanga[paxadult]==''){$apax='0';}else{$apax=$cekulanga[paxadult];}
        if($cekulangc[paxchild]==''){$cpax='0';}else{$cpax=$cekulangc[paxchild];}
        if($cekulangi[paxinfant]==''){$ipax='0';}else{$ipax=$cekulangi[paxinfant];}
        mysql_query("UPDATE tour_msbooking set AdultPax = '$apax',
                                              ChildPax = '$cpax',
                                              InfantPax = '$ipax',
                                              ExtraDiscount = '$_POST[xtradisc]',
                                              TotalPrice = '$jumtotal',
                                              OperationNote = '$Notes'  
                                                WHERE BookingID = '$bookid'");
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header("location:media.php?module=$_POST[moduls]");

    }
// ADD Booking PAX
    elseif ($module=='msbooking' AND $act=='addpax'){
        $username=$_SESSION[namauser];
        $hari= date("Y", time());
        $bukingid=$_POST[nobooking];
        $editr=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$bukingid'");
        $bok=mysql_fetch_array($editr);
        $kuery = mysql_query("SELECT * FROM tour_msproduct where IDProduct = '$bok[IDTourcode]'");
        $dapet = mysql_fetch_array($kuery);
        $ada = mysql_num_rows($kuery);
        $mod="msbookingdetail&act=editdetail&code=$bukingid";
        if($_POST[tcnamealias]==''){$tcalias=$_POST[tcname];}else{$tcalias=$_POST[tcnamealias];}
        mysql_query("update tour_msbooking set AdultPax = '$_POST[adulttotal]',
                                      ChildPax = '$_POST[childtotal]',        
                                      InfantPax = '$_POST[infanttotal]'
                                      where BookingID = '$bukingid'");
        mysql_query("INSERT INTO tour_msbookingaddon(BookingID,
                                      IDTourcode,   
                                      TCName,
                                      TCNameAlias,
                                      TCDivision,
                                      TCEmpID,
                                      OfficeKey,
                                      AdultPax,
                                      ChildPax,        
                                      InfantPax,   
                                      DepositDate,
                                      DepositNo,
                                      DepositCurr,
                                      DepositAmount,
                                      Curr,          
                                      BookingStatus,
                                      BookingDate) 
                            VALUES('$bukingid',          
                                   '$bok[IDTourcode]',
                                   '$_POST[tcname]',
                                   '$tcalias', 
                                   '$_POST[tcdivision]',
                                   '$_POST[tcempid]',
                                   '$_POST[officekey]',
                                   '$_POST[adultpax]', 
                                   '$_POST[childpax]',           
                                   '$_POST[infantpax]',  
                                   '$_POST[depositdate]', 
                                   '$_POST[depositno]',
                                   '$_POST[depositcurr]',
                                   '$_POST[depositamount]',
                                   '$_POST[sellcurr]',    
                                   '$statbook',
                                   '$today')");
        $jumlahseat= $_POST[jumsit];
        $seatdep = $dapet[SeatDeposit] + $jumlahseat;
        $sisaseat = $dapet[Seat] - $seatdep;
        $bookseat = $dapet[SeatBooking] + $seatdep;
        $gruptype=$dapet[GroupType];
        if($gruptype=='CRUISE'){$rumtype='12 Pax';}else{$rumtype='Twin';}
        mysql_query("UPDATE tour_msproduct SET SeatDeposit = '$seatdep',
                                   SeatSisa = '$sisaseat',
                                   SeatBooking = '$bookseat',
                                   Room = '$jumroom' 
                               WHERE IDProduct = '$bok[IDTourcode]'");
        for ($satu=1; $satu<=$_POST[adultpax]; $satu++) {
            $ad = mysql_query("SELECT count(tour_msbookingdetail.IDDetail) as uruta FROM tour_msbookingdetail
                                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                    WHERE tour_msbooking.IDTourcode = '$bok[IDTourcode]' 
                                    and tour_msbookingdetail.Gender <> 'INFANT'  
                                    AND tour_msbookingdetail.Status<>'CANCEL' 
                                    and tour_msbooking.Status = 'ACTIVE'
                                    ORDER BY Urutan DESC ");
            $isiad = mysql_fetch_array($ad);
            $mulai=$isiad[uruta];
            $urut=$mulai+1;
            $d = mysql_query("SELECT * FROM tour_msdiscount
                                    left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct 
                                    WHERE tour_msproduct.IDProduct = '$bok[IDTourcode]' and tour_msdiscount.Status='ACTIVE'");
            $dd = mysql_fetch_array($d);
            if($urut<=$dd[Max1]){$dis=$dd[Disc1]+$discpameran;}
            else if($urut<=$dd[Max2]){$dis=$dd[Disc2]+$discpameran;}
            else if($urut<=$dd[Max3]){$dis=$dd[Disc3]+$discpameran;}
            else if($urut<=$dd[Max4]){$dis=$dd[Disc4]+$discpameran;}
            else if($urut<=$dd[Max5]){$dis=$dd[Disc5]+$discpameran;}
            else if($urut<=$dd[Max6]){$dis=$dd[Disc6]+$discpameran;}
            else if($urut<=$dd[Max7]){$dis=$dd[Disc7]+$discpameran;}
            else $dis='0';
            if($dis==''){$dis='0';}
            $subtotal = $dd[SellingAdlTwn] - $dis;
            mysql_query("INSERT INTO tour_msbookingdetail(Urutan,IDTourcode,TourCode,BookingID,Gender,Package,RoomType,Discount,Price,SubTotal,Status)
                                            VALUES ('$urut','$bok[IDTourcode]','$bok[TourCode]','$bukingid','ADULT','Tour','$rumtype','$dis','$dd[SellingAdlTwn]','$subtotal','$dis')");
        }
        for ($satu=1; $satu<=$_POST[childpax]; $satu++) {
            $ad = mysql_query("SELECT count(tour_msbookingdetail.IDDetail) as uruta FROM tour_msbookingdetail
                                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                    WHERE tour_msbooking.IDTourcode = '$bok[IDTourcode]'
                                    and tour_msbookingdetail.Gender <> 'INFANT'  
                                    AND tour_msbookingdetail.Status<>'CANCEL' 
                                    and tour_msbooking.Status = 'ACTIVE'
                                    ORDER BY Urutan DESC");
            $isiad = mysql_fetch_array($ad);
            $mulai=$isiad[uruta];
            $urut=$mulai+1;
            $d = mysql_query("SELECT * FROM tour_msdiscount
                                    left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct 
                                    WHERE tour_msproduct.IDProduct = '$bok[IDTourcode]' and tour_msdiscount.Status='ACTIVE'");
            $dd = mysql_fetch_array($d);
            if($urut<=$dd[Max1]){$dis=$dd[Disc1]+$discpameran;}
            else if($urut<=$dd[Max2]){$dis=$dd[Disc2]+$discpameran;}
            else if($urut<=$dd[Max3]){$dis=$dd[Disc3]+$discpameran;}
            else if($urut<=$dd[Max4]){$dis=$dd[Disc4]+$discpameran;}
            else if($urut<=$dd[Max5]){$dis=$dd[Disc5]+$discpameran;}
            else if($urut<=$dd[Max6]){$dis=$dd[Disc6]+$discpameran;}
            else if($urut<=$dd[Max7]){$dis=$dd[Disc7]+$discpameran;}
            else $dis='0';
            if($dis==''){$dis='0';}
            $subtotal = $dd[SellingChdTwn] - $dis;
            mysql_query("INSERT INTO tour_msbookingdetail(Urutan,IDTourcode,TourCode,BookingID,Gender,Package,RoomType,Discount,Price,SubTotal,Status)
                                            VALUES ('$urut','$bok[IDTourcode]','$bok[TourCode]','$bukingid','CHILD','Tour','$rumtype','$dis','$dd[SellingChdTwn]','$subtotal','$dis')");
        }
        for ($satu=0; $satu<$_POST[infantpax]; $satu++) {
            $cadltwn=mysql_query("SELECT * FROM tour_msproduct
                                        WHERE IDProduct = '$bok[IDTourcode]' and Status='ACTIVE'");
            $harga=mysql_fetch_array($cadltwn);
            mysql_query("INSERT INTO tour_msbookingdetail(IDTourcode,TourCode,BookingID,Gender,Package,RoomType,Price,SubTotal,Status)
                                            VALUES ('$bok[IDTourcode]','$bok[TourCode]','$bukingid','INFANT','Tour','No Bed','$harga[SellingInfant]','$harga[SellingInfant]','0')");
        }
        $isitot = mysql_query("SELECT sum(SubTotal)as jumtot FROM tour_msbookingdetail WHERE TourCode = '$bok[TourCode]' and BookingID = '$bukingid' group by TourCode");
        $tot = mysql_fetch_array($isitot);
        mysql_query("UPDATE tour_msbooking set  TotalPrice = '$tot[jumtot]'
                                                WHERE BookingID = '$bukingid'");
        //update jumlah product
        $mencari1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$bok[IDTourcode]' and Status <> 'VOID' ");
        $ulang=mysql_fetch_array($mencari1);
        $caribook=mysql_query("SELECT count(IDDetail) as totbuking FROM tour_msbookingdetail WHERE IDTourcode = '$bok[IDTourcode]' and Gender <> 'INFANT' and Status <> 'CANCEL'");
        $kebook=mysql_fetch_array($caribook);
        $seatdeplast = $kebook[totbuking];
        $seatsisalast = $ulang[Seat] - $seatdeplast;
        $updet=mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdeplast',
                                                        SeatSisa='$seatsisalast'
                                                        WHERE IDProduct = '$_POST[idproduct]'");
        //-------
        $Description="Add Pax Booking ($bukingid)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header("location:media.php?module=$mod");

    }
// ADD Booking PAX TOPUP
    elseif ($module=='msbooking' AND $act=='addpaxtopup'){
        $username=$_SESSION[namauser];
        $hari= date("Y", time());
        $bukingid=$_POST[nobooking];
        $editr=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$bukingid'");
        $bok=mysql_fetch_array($editr);
        $kuery = mysql_query("SELECT * FROM tour_msproduct where IDProduct = '$bok[IDTourcode]'");
        $dapet = mysql_fetch_array($kuery);
        $ada = mysql_num_rows($kuery);
        $mod="msbookingdetail&act=editdetail&code=$bukingid";
        if($_POST[tcnamealias]==''){$tcalias=$_POST[tcname];}else{$tcalias=$_POST[tcnamealias];}
        //running csr number PTES
        if($_POST[autocsr]=='YES') {
            $sqldiv = mssql_query("SELECT c.ClientNo,c.CompanyName FROM Divisi d
                                   inner join Company c on c.CompanyCode = d.DivisiID
                                   WHERE d.DivisiID = '$_POST[tcdivision]' ");
            $datadiv = mssql_fetch_array($sqldiv);
            $sqlrar = mssql_query("SELECT * FROM Divisi WHERE DivisiID = 'FSD' ");
            $norar = mssql_fetch_array($sqlrar);
            $csrdepan = "CSR$norar[DivisiNO]-";
            include "../config/koneksisql.php";
            $tampilin = mssql_query("SELECT TOP 1 CashReceiptId FROM CashReceipt where CashReceiptId like '$csrdepan%'
                            ORDER BY CashReceiptId DESC ");
            $hasilin = mssql_fetch_array($tampilin);
            $jumlahin = mssql_num_rows($tampilin);
            mssql_close($linkptes);
            include "../config/koneksimaster.php";

            if ($jumlahin > 0) {
                $csrno1 = substr($hasilin[CashReceiptId], -7) + 1;
                switch ($csrno1) {
                    case ($csrno1 < 10):
                        $csrno = "000000" . $csrno1;
                        break;
                    case ($csrno1 > 9 && $csrno1 < 100):
                        $csrno = "00000" . $csrno1;
                        break;
                    case ($csrno1 > 99 && $csrno1 < 1000):
                        $csrno = "0000" . $csrno1;
                        break;
                    case ($csrno1 > 999 && $csrno1 < 10000):
                        $csrno = "000" . $csrno1;
                        break;
                    case ($csrno1 > 9999 && $csrno1 < 100000):
                        $csrno = "00" . $csrno1;
                        break;
                    case ($csrno1 > 99999 && $csrno1 < 1000000):
                        $csrno = "0" . $csrno1;
                        break;
                }
            } else {
                $csrno = "0000001";
            }
            $csrtour = "$csrdepan$csrno";
            $depono = $csrtour;
        }

        mysql_query("update tour_msbooking set AdultPax = '$_POST[adulttotal]',
                                      ChildPax = '$_POST[childtotal]',        
                                      InfantPax = '$_POST[infanttotal]'
                                      where BookingID = '$bukingid'");
        mysql_query("INSERT INTO tour_msbookingaddon(BookingID,
                                      IDTourcode,   
                                      TCName,
                                      TCNameAlias,
                                      TCDivision,
                                      TCEmpID,
                                      OfficeKey,
                                      AdultPax,
                                      ChildPax,        
                                      InfantPax,   
                                      DepositDate,
                                      DepositNo,
                                      DepositCurr,
                                      DepositAmount,
                                      Curr,          
                                      BookingStatus,
                                      BookingDate) 
                            VALUES('$bukingid',          
                                   '$bok[IDTourcode]',
                                   '$_POST[tcname]',
                                   '$tcalias', 
                                   '$_POST[tcdivision]',
                                   '$_POST[tcempid]',
                                   '$_POST[officekey]',
                                   '$_POST[adultpax]', 
                                   '$_POST[childpax]',           
                                   '$_POST[infantpax]',  
                                   '$_POST[depositdate]', 
                                   '$depono',
                                   '$_POST[depositcurr]',
                                   '$_POST[depositamount]',
                                   '$_POST[sellcurr]',    
                                   '$statbook',
                                   '$today')");
        $jumlahseat= $_POST[jumsit];
        $seatdep = $dapet[SeatDeposit] + $jumlahseat;
        $sisaseat = $dapet[Seat] - $seatdep;
        $bookseat = $dapet[SeatBooking] + $seatdep;
        $gruptype=$dapet[GroupType];
        if($gruptype=='CRUISE'){$rumtype='12 Pax';}else{$rumtype='Twin';}
        mysql_query("UPDATE tour_msproduct SET SeatDeposit = '$seatdep',
                                   SeatSisa = '$sisaseat',
                                   SeatBooking = '$bookseat',
                                   Room = '$jumroom' 
                               WHERE IDProduct = '$bok[IDTourcode]'");
        for ($satu=1; $satu<=$_POST[adultpax]; $satu++) {
            $ad = mysql_query("SELECT count(tour_msbookingdetail.IDDetail) as uruta FROM tour_msbookingdetail
                                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                    WHERE tour_msbooking.IDTourcode = '$bok[IDTourcode]' 
                                    and tour_msbookingdetail.Gender <> 'INFANT'  
                                    AND tour_msbookingdetail.Status<>'CANCEL' 
                                    and tour_msbooking.Status = 'ACTIVE'
                                    ORDER BY Urutan DESC ");
            $isiad = mysql_fetch_array($ad);
            $mulai=$isiad[uruta];
            $urut=$mulai+1;
            $d = mysql_query("SELECT * FROM tour_msdiscount
                                    left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct 
                                    WHERE tour_msproduct.IDProduct = '$bok[IDTourcode]' and tour_msdiscount.Status='ACTIVE'");
            $dd = mysql_fetch_array($d);
            if($urut<=$dd[Max1]){$dis=$dd[Disc1]+$discpameran;}
            else if($urut<=$dd[Max2]){$dis=$dd[Disc2]+$discpameran;}
            else if($urut<=$dd[Max3]){$dis=$dd[Disc3]+$discpameran;}
            else if($urut<=$dd[Max4]){$dis=$dd[Disc4]+$discpameran;}
            else if($urut<=$dd[Max5]){$dis=$dd[Disc5]+$discpameran;}
            else if($urut<=$dd[Max6]){$dis=$dd[Disc6]+$discpameran;}
            else if($urut<=$dd[Max7]){$dis=$dd[Disc7]+$discpameran;}
            else $dis='0';
            if($dis==''){$dis='0';}
            $subtotal = $dd[SellingAdlTwn] - $dis;
            mysql_query("INSERT INTO tour_msbookingdetail(Urutan,IDTourcode,TourCode,BookingID,Gender,Package,RoomType,Discount,Price,SubTotal,Status)
                                            VALUES ('$urut','$bok[IDTourcode]','$bok[TourCode]','$bukingid','ADULT','Tour','$rumtype','$dis','$dd[SellingAdlTwn]','$subtotal','$dis')");
        }
        for ($satu=1; $satu<=$_POST[childpax]; $satu++) {
            $ad = mysql_query("SELECT count(tour_msbookingdetail.IDDetail) as uruta FROM tour_msbookingdetail
                                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                                    WHERE tour_msbooking.IDTourcode = '$bok[IDTourcode]'
                                    and tour_msbookingdetail.Gender <> 'INFANT'  
                                    AND tour_msbookingdetail.Status<>'CANCEL' 
                                    and tour_msbooking.Status = 'ACTIVE'
                                    ORDER BY Urutan DESC");
            $isiad = mysql_fetch_array($ad);
            $mulai=$isiad[uruta];
            $urut=$mulai+1;
            $d = mysql_query("SELECT * FROM tour_msdiscount
                                    left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct 
                                    WHERE tour_msproduct.IDProduct = '$bok[IDTourcode]' and tour_msdiscount.Status='ACTIVE'");
            $dd = mysql_fetch_array($d);
            if($urut<=$dd[Max1]){$dis=$dd[Disc1]+$discpameran;}
            else if($urut<=$dd[Max2]){$dis=$dd[Disc2]+$discpameran;}
            else if($urut<=$dd[Max3]){$dis=$dd[Disc3]+$discpameran;}
            else if($urut<=$dd[Max4]){$dis=$dd[Disc4]+$discpameran;}
            else if($urut<=$dd[Max5]){$dis=$dd[Disc5]+$discpameran;}
            else if($urut<=$dd[Max6]){$dis=$dd[Disc6]+$discpameran;}
            else if($urut<=$dd[Max7]){$dis=$dd[Disc7]+$discpameran;}
            else $dis='0';
            if($dis==''){$dis='0';}
            $subtotal = $dd[SellingChdTwn] - $dis;
            mysql_query("INSERT INTO tour_msbookingdetail(Urutan,IDTourcode,TourCode,BookingID,Gender,Package,RoomType,Discount,Price,SubTotal,Status)
                                            VALUES ('$urut','$bok[IDTourcode]','$bok[TourCode]','$bukingid','CHILD','Tour','$rumtype','$dis','$dd[SellingChdTwn]','$subtotal','$dis')");
        }
        for ($satu=0; $satu<$_POST[infantpax]; $satu++) {
            $cadltwn=mysql_query("SELECT * FROM tour_msproduct
                                        WHERE IDProduct = '$bok[IDTourcode]' and Status='ACTIVE'");
            $harga=mysql_fetch_array($cadltwn);
            mysql_query("INSERT INTO tour_msbookingdetail(IDTourcode,TourCode,BookingID,Gender,Package,RoomType,Price,SubTotal,Status)
                                            VALUES ('$bok[IDTourcode]','$bok[TourCode]','$bukingid','INFANT','Tour','No Bed','$harga[SellingInfant]','$harga[SellingInfant]','0')");
        }
        $isitot = mysql_query("SELECT sum(SubTotal)as jumtot FROM tour_msbookingdetail WHERE TourCode = '$bok[TourCode]' and BookingID = '$bukingid' group by TourCode");
        $tot = mysql_fetch_array($isitot);
        mysql_query("UPDATE tour_msbooking set  TotalPrice = '$tot[jumtot]'
                                                WHERE BookingID = '$bukingid'");
        //update jumlah product
        $mencari1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$bok[IDTourcode]' and Status <> 'VOID' ");
        $ulang=mysql_fetch_array($mencari1);
        $caribook=mysql_query("SELECT count(IDDetail) as totbuking FROM tour_msbookingdetail WHERE IDTourcode = '$bok[IDTourcode]' and Gender <> 'INFANT' and Status <> 'CANCEL'");
        $kebook=mysql_fetch_array($caribook);
        $seatdeplast = $kebook[totbuking];
        $seatsisalast = $ulang[Seat] - $seatdeplast;
        $updet=mysql_query("UPDATE tour_msproduct set SeatDeposit = '$seatdeplast',
                                                        SeatSisa='$seatsisalast'
                                                        WHERE IDProduct = '$_POST[idproduct]'");
        if ($_POST[autocsr] == 'YES') {
            //CREATE CSR
            $catat = "$_SESSION[employee_name] ($_SESSION[employee_code]) $bukingid";
            $detailamount = $_POST[depositamount];
            $remak = "$bok[TourCode] ($bukingid)";
            include "../config/koneksisql.php";
            mssql_query("INSERT INTO CashReceipt(CashReceiptId,
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
                                                            LTMBookingID,
                                                            CompanyID,
                                                            Remarks,
                                                            BOSOName,
                                                            BOSOAddress,
                                                            BOSOPhone,
                                                            BOSOFax,
                                                            BOSOEmail)
                                                    VALUES ('$csrtour',
                                                            '$today',
                                                            '$datadiv[ClientNo]',
                                                            '$datadiv[CompanyName]',
                                                            'FSD',
                                                            'IDR',
                                                            '$detailamount',
                                                            '0',
                                                            '0',
                                                            '0',
                                                            'A',
                                                            'SYSADMIN',
                                                            '$today',
                                                            'SYSADMIN',
                                                            '$today',
                                                            '$bukingid',
                                                            '$norar[CompanyID]',
                                                            '$catat',
                                                            '$norar[DivisiName]',
                                                            '$norar[Address]',
                                                            '$norar[Phone]',
                                                            '$norar[Fax]',
                                                            '$norar[Email]')");
            // pembayaran
            $qcariindex = mssql_query("SELECT * FROM CashReceipt where CashReceiptId = '$csrtour' AND CompanyID ='$norar[CompanyID]'");
            $index = mssql_fetch_array($qcariindex);
            mssql_query("INSERT INTO CashReceipt_Payment(CashReceiptId,
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
                                                    VALUES ('$csrtour',
                                                            '$index[IndexCashReceiptHeader]',
                                                            '1',
                                                            'TOP UP',
                                                            '$remak',
                                                            'IDR',
                                                            '$detailamount',
                                                            '0',
                                                            '$detailamount',
                                                            'SYSADMIN',
                                                            '$today',
                                                            'SYSADMIN',
                                                            '$today')");
            $sqllasttopup = mssql_query("SELECT * FROM TopUpAccountBalance where ClientNo = '$datadiv[ClientNo]' and StatusLastBalance = 1 ");
            $lasttopup = mssql_fetch_array($sqllasttopup);
            $endingbalance = $lasttopup[EndingBalance] - $detailamount;
            $desc = "DEPOSIT $csrtour";
            mssql_query("INSERT INTO TopUpAccountBalance(ClientNo,
                                                            ClientName,
                                                            CategoryID,
                                                            CostCenter,
                                                            ReferenceID,
                                                            TypicalBalance,
                                                            Currency,
                                                            BeginningBalance,
                                                            Mutation,
                                                            EndingBalance,
                                                            WarningBalance,
                                                            MinimumBalance,
                                                            StatusLastBalance,
                                                            Description,
                                                            DateofCreated,
                                                            CreatedBy,
                                                            CompanyID,
                                                            StatusLastEmail)
                                                    VALUES ('$datadiv[ClientNo]',
                                                            '$datadiv[CompanyName]',
                                                            '$lasttopup[CategoryID]',
                                                            '$tahun1$tiket1',
                                                            '$csrtour',
                                                            'CREDIT',
                                                            'IDR',
                                                            '$lasttopup[EndingBalance]',
                                                            '$detailamount',
                                                            '$endingbalance',
                                                            '$lasttopup[WarningBalance]',
                                                            '$lasttopup[MinimumBalance]',
                                                            '1',
                                                            '$desc',
                                                            '$today',
                                                            'SYSADMIN',
                                                            '$norar[CompanyID]',
                                                            '$lasttopup[StatusLastEmail]')");
            mssql_query("UPDATE TopUpAccountBalance SET StatusLastBalance = 0 WHERE BalanceID = '$lasttopup[BalanceID]' ");
            mssql_close($linkptes);
            include "../config/koneksimaster.php";
            //AUTO OPEN STATUS DOA
            $qopendoc = mysql_query(" SELECT SUM(AdultPax + ChildPax) as uruta 
                                        FROM tour_msbooking 
                                        WHERE IDTourcode = '$_POST[idproduct]' 
                                        AND Status = 'ACTIVE' 
                                        AND DUMMY = 'NO' ");
            $opendoc= mysql_fetch_array($qopendoc);
            if($opendoc[uruta] > 15){
                mysql_query("UPDATE tour_msproduct SET StatusDOA = 'OPEN' 
                                  WHERE IDProduct = '$_POST[idproduct]'
                                  AND StatusDOA = 'CLOSE' ");
            }
        }
        //-------
        $Description="Add Pax Booking ($bukingid)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header("location:media.php?module=$mod");

    }
// Deviasi Request
    elseif ($module=='msbooking' AND $act=='devreq'){
        $bookid = $_POST[id];
        $check = $_POST[sector];
        $tampil = mysql_query("SELECT * FROM tour_devbooking
                where BookingID = '$bookid'
                ORDER BY DevNo DESC limit 1");
        $hasil = mysql_fetch_array($tampil);
        $jumlah = mysql_num_rows($tampil);

        if($jumlah > 0){
            $notiket=substr($hasil[DevNo],11,2)+1;
            switch ($notiket){
                case ($notiket<10):
                    $notiket1 = "0".$notiket;
                    break;
            }
        }else {
            $notiket1="01";
        }

        $checkBox = $_POST[listing];

        if(sizeof($checkBox)==0){
            header("location:media.php?module=msbooking&act=deviasireq&id=$bookid");
        }else{
            $Ticket1=strtoupper($_POST[ticket1]);
            $Ticket2=strtoupper($_POST[ticket2]);
            $Ticket3=strtoupper($_POST[ticket3]);
            $others1=strtoupper($_POST[others1]);
            $others2=strtoupper($_POST[others2]);
            $others3=strtoupper($_POST[others3]);
            mysql_query("insert tour_devbooking(BookingID,
                                   DevNo,
                                   Ticket1,
                                   Ticket2,
                                   Ticket3,
                                   Others1,
                                   Others2,
                                   Others3,
                                   Status) 
                            VALUES ('$bookid', 
                                   '$bookid$notiket1',
                                   '$Ticket1',
                                   '$Ticket2',
                                   '$Ticket3',
                                   '$others1',
                                   '$others2',
                                   '$others3', 
                                   'REQUEST')");

            $ambil1=mysql_query("SELECT * FROM tour_devbooking WHERE BookingID = $bookid");
            $baru=mysql_fetch_array($ambil1);
            $devid=$baru[DevID];
            //$checkBox = $_POST[listing];
            for($i=0; $i<sizeof($checkBox); $i++){
                $cari1=mysql_query("SELECT * FROM tour_msbookingdetail WHERE IDDetail = $checkBox[$i]");
                $listdev=mysql_fetch_array($cari1);
                $bukid=$listdev[BookingID];
                mysql_query("INSERT INTO tour_devbookingdetail(IDBooking,
                                   DevNo,
                                   TourCode,
                                   BookingID,
                                   PaxName,
                                   Title,
                                   Gender,
                                   BirthPlace,
                                   BirthDate,
                                   PassportNo,
                                   PassportIssued,
                                   PassportIssuedDate,
                                   PassportValid,
                                   Status) 
                            VALUES ('$checkBox[$i]', 
                                   '$bukid$notiket1',
                                   '$listdev[TourCode]',
                                   '$bukid',
                                   '$listdev[PaxName]',
                                   '$listdev[Title]',
                                   '$listdev[Gender]',
                                   '$listdev[BirthPlace]',
                                   '$listdev[BirthDate]',
                                   '$listdev[PassportNo]',
                                   '$listdev[PassportIssued]',
                                   '$listdev[PassportIssuedDate]',
                                   '$listdev[PassportValid]', 
                                   'ACTIVE')");
                mysql_query("UPDATE tour_msbookingdetail set InfoDeviasi = 'DEVIASI',DeviasiNo='$bukid$notiket1'
                                                WHERE IDDetail = $checkBox[$i]");
            }
            $Description="Add Deviasi $bukid$notiket1";
            mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
            header("location:media.php?module=msbooking&act=deviasi&id=$bukid");
        }
    }
// Deviasi Void
    elseif ($module=='msbooking' AND $act=='devvoid'){
        $devno = $_POST[id];
        $bookno=substr($devno,0,11);
        mysql_query("UPDATE tour_devbooking SET Status = 'VOID' where DevNo = $devno ");

        mysql_query("UPDATE tour_devbookingdetail set Status='VOID'
                                                WHERE DevNo = $devno ");

        $cari1=mysql_query("SELECT * FROM tour_devbookingdetail WHERE DevNo = '$devno' and Status = 'VOID'");
        while($listdev=mysql_fetch_array($cari1)){
            $bukid=$listdev[IDBooking];
            mysql_query("UPDATE tour_msbookingdetail set InfoDeviasi = '',DeviasiNo=''
                                                WHERE IDDetail = $bukid ");
        }
        $Description="Void Deviasi $devno";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header("location:media.php?module=msbooking&act=deviasi&id=$bookno");
    }
//Deviasi Pick
    elseif ($module=='msbooking' AND $act=='devpick'){
        $devno = $_POST[id];
        $bookno=substr($devno,0,11);
        mysql_query("UPDATE tour_devbooking SET Result = '$_POST[pilihan]',Status='CONFIRM',DevCurr='$_POST[devcurr]',DevPrice='$_POST[devprice]' where DevNo = $devno ");

        mysql_query("UPDATE tour_devbookingdetail set Status='CONFIRM'
                                                WHERE DevNo = $devno ");

        $Description="Confirm Deviasi $devno";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header("location:media.php?module=opbookingdetail&act=deviasi&id=$bookno");
    }
// MOVE Booking
    elseif ($module=='msbookingdetail' AND $act=='move'){
        $bookid = $_POST[id];
        $paxmove=$_POST[pax];
        $Description="Move Booking ID $bookid";
        $cari1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_POST[idbefore]' and Status <>'VOID'");
        $tablefrom=mysql_fetch_array($cari1);
        $cari2=mysql_query("SELECT * from tour_msproduct WHERE IDProduct = '$_POST[tourcode]' ");
        $tableto=mysql_fetch_array($cari2);

        $reserva=$tablefrom[SeatDeposit]-$paxmove;
        $reservb=$tablefrom[SeatSisa]+$paxmove;

        $availablea=$tableto[SeatDeposit]+$paxmove;
        $availableb=$tableto[SeatSisa]-$paxmove;
        $mod=$_POST[id];
        $startroom=$tableto[Room]+1;
        $endroom=$tableto[Room]+$_POST[totalroom];

        mysql_query("UPDATE tour_msproduct set SeatDeposit = '$reserva',SeatSisa = '$reservb'
                                                WHERE IDProduct = '$tablefrom[IDProduct]'");
        mysql_query("UPDATE tour_msproduct set SeatDeposit = '$availablea',SeatSisa = '$availableb',
                                            Room = '$endroom'
                                             WHERE IDProduct = '$tableto[IDProduct]'");
        mysql_query("UPDATE tour_msbooking set StatusPrice = '', IDTourcode = '$tableto[IDProduct]',
                                            TourCode = '$tableto[TourCode]',Year='$tableto[Year]',
                                            TourCodeBefore='$_POST[turbefore]',YearBefore='$_POST[yearbefore]',
                                            StartRoom = '$startroom',EndRoom = '$endroom'
                                            WHERE BookingID = '$bookid'");
        mysql_query("UPDATE tour_msbookingdetail set IDTourcode='$tableto[IDProduct]',TourCode = '$tableto[TourCode]',RoomNo='$startroom'
                                            WHERE BookingID = '$bookid'");
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                               Description,
                               LogTime)
                        VALUES ('$EmpName',
                               '$Description',
                               '$today')");
        header('location:media.php?module=opbookingdetail');
    }
// Manage Rooming List
    elseif ($module=='roominglist' AND $act=='manage'){
        $tourcode = $_POST[tur];
        $Description="Manage room list $tourcode";
        for ($satu=1; $satu<=$_POST[jumlah]; $satu++) {
            $isig1=$_POST[bookid.$satu];
            $isig2=$_POST[roomno.$satu];
            mysql_query("UPDATE tour_msbookingdetail set  RoomNo = '$isig2'
                                                WHERE IDDetail = '$isig1'");
        }
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module=group');
    }
// Change Rooming List
    elseif ($module=='rptnamelist' AND $act=='changeroom'){
    $tourcode = $_POST[turkod];
    $Description="Change room no, ID: $tourcode";
    for ($satu=1; $satu<=$_POST[banyak]; $satu++) {
        $isig1=$_POST[iddetail.$satu];
        $isig2=$_POST[newroom.$satu];
        mysql_query("UPDATE tour_msbookingdetail set  RoomNo = '$isig2'
                                            WHERE IDDetail = '$isig1'");
    }
    mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                               Description,
                               LogTime)
                        VALUES ('$EmpName',
                               '$Description',
                               '$today')");
    header("location:media.php?module=rptnamelist&nama=$tourcode&oke=Show");
}
// Update OP Booking detail
    elseif ($module=='opbookingdetail' AND $act=='update'){
        $bookid = $_POST[id];
        $Description="Edit Detail Booking $bookid";
        $username=$_SESSION[namauser];
        $Notes = strtoupper($_POST[operationnote]);
        $dp = mysql_query("SELECT * FROM tour_xtrapameran
                                    WHERE IDProduct = '$_POST[prodid]' and Status='ACTIVE'");
        $ddp = mysql_fetch_array($dp);
        $promo=$ddp[Promo];
        for ($satu=1; $satu<=$_POST[banyak]; $satu++) {
            $isig1=$_POST[iddetail.$satu];
            $isig2=strtoupper($_POST[paxname.$satu]);
            $isig3=$_POST[title.$satu];
            $isig4=$_POST[noroom.$satu];
            $isig5=$_POST[selectroom.$satu];
            $isig6=$_POST[disc.$satu];
            $isig7=$_POST[total.$satu];
            $isig8=$_POST[promo.$satu];
            $isig9=$_POST[adddisc.$satu];
            if($isig8<>''){$p=$promo;}else{$p='';}
            $parts = explode(" ", $isig2);
            $lastname = array_pop($parts);
            $firstname = implode(" ", $parts);
            if($firstname==''){$firstname=$lastname;$lastname='';}
            mysql_query("UPDATE tour_msbookingdetail set  PaxName = '$isig2',
                                                FirstPaxName = '$firstname',
                                                LastPaxName='$lastname',
                                                Title = '$isig3',
                                                RoomNo = '$isig4',
                                                RoomType = '$isig5',      
                                                Discount = '$isig6',
                                                AddDiscount = '$isig9',
                                                Status = '$isig6',
                                                SubTotal = '$isig7',
                                                Promo = '$p'
                                                WHERE IDDetail = '$isig1'");
        }
        $jumtotal1=str_replace(".", "",$_POST[jumtotal]);
        $jumtotal=str_replace(",", ".",$jumtotal1);
        mysql_query("UPDATE tour_msbooking set TotalPrice = '$jumtotal',
                                              OperationNote = '$Notes'  
                                                WHERE BookingID = '$bookid'");
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module=opbookingdetail');

    }
// Input Airlines
/*    elseif ($module=='msairlines' AND $act=='input'){
        $AirlinesID=strtoupper($_POST[AirlinesID]);
        $AirlinesName=strtoupper($_POST[AirlinesName]);
        $Description="Input New Airlines ($AirlinesID - $AirlinesName)";
        mysql_query("INSERT INTO tour_msairlines(AirlinesID,AirlinesName,AirlinesStatus)
                                       VALUES('$AirlinesID','$AirlinesName','$_POST[AirlinesStatus]')");
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);
    } */
// Update Airlines
/*    elseif ($module=='msairlines' AND $act=='update'){
        $AirlinesID=strtoupper($_POST[AirlinesID]);
        $AirlinesName=strtoupper($_POST[AirlinesName]);
        $Description="Edit Airlines ($AirlinesID - $AirlinesName)";
        mysql_query("UPDATE tour_msairlines SET AirlinesID = '$AirlinesID',
                                            AirlinesName = '$AirlinesName',
                                            AirlinesStatus = '$_POST[AirlinesStatus]'
                               WHERE IDAirlines = '$_POST[id]'");
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);
    } */
// Input Group
    elseif ($module=='msgroup' AND $act=='input'){
        $GroupName=strtoupper($_POST[GroupName]);
        $Description="Input New Group ($GroupName)";
        mysql_query("INSERT INTO tour_msgroup(GroupName,Status)
                                       VALUES('$GroupName','$_POST[Status]')");
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);
    }
// Update Group
    elseif ($module=='msgroup' AND $act=='update'){
        $GroupName=strtoupper($_POST[GroupName]);
        $Description="Edit Group ($GroupName)";
        mysql_query("UPDATE tour_msgroup SET GroupName = '$GroupName',Status='$_POST[Status]'
                               WHERE IDGroup = '$_POST[id]'");
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);
    }
// Input Tourleader
    elseif ($module=='mstourleader' AND $act=='input'){
        $ceking = mysql_query("SELECT * FROM tbl_msemployee where employee_code = '$_POST[TourleaderNameS]' ");
        $ketemu = mysql_fetch_array($ceking);
        if($_POST[TourleaderType]=='IN HOUSE'){
            $TourleaderName=strtoupper($ketemu[employee_name]);
        }else{
            $TourleaderName=strtoupper($_POST[TourleaderName]);
        }
        $cari=mysql_query("SELECT * FROM tour_mstourleader WHERE TourleaderName = '$TourleaderName' AND TourleaderMobile ='$_POST[TourleaderMobile]' ORDER BY IDTourleader DESC limit 1");
        $cek=mysql_num_rows($cari);
        $r=mysql_fetch_array($cari);
        if ($cek > 0){
            $sameid = $r[IDTourleader];
            header('location:media.php?module=mstourleader&act=sametl&id='.$sameid);
        }else {

            $TourleaderPassportName=strtoupper($_POST[TourleaderPassportName]);
            $TourleaderNickName=strtoupper($_POST[TourleaderNickName]);
            $TourleaderAddress=strtoupper($_POST[TourleaderAddress]);
            $TourleaderExpertise=strtoupper($_POST[TourleaderExpertise]);
            $TourleaderPassportValid=date('Y-m-d', strtotime($_POST[TourleaderPassportValid]));
            $Description="Input New Tourleader ($TourleaderName)";
            mysql_query("INSERT INTO tour_mstourleader(TourleaderType,
                                        EmpID,
                                        TourleaderName,
                                        TourleaderNickName,
                                        TourleaderGender,
                                        TourleaderMobile,
                                        TourleaderPhone,
                                        TourleaderAddress,
                                        TourleaderExpertise,
                                        TourleaderPassportName,
                                        TourleaderPassportNo,
                                        TourleaderPassportValid,
                                        TourleaderStatus,
                                        TourleaderRemarks)   
                                       VALUES('$_POST[TourleaderType]',
                                       '$_POST[TourleaderNameS]',
                                       '$TourleaderName',
                                       '$TourleaderNickName',
                                       '$_POST[TourleaderGender]', 
                                       '$_POST[TourleaderMobile]',
                                       '$_POST[TourleaderPhone]',
                                       '$TourleaderAddress',
                                       '$TourleaderExpertise',
                                       '$TourleaderPassportName',
                                       '$_POST[TourleaderPassportNo]', 
                                       '$TourleaderPassportValid',   
                                       '$_POST[TourleaderStatus]',
                                       '$_POST[TourleaderRemarks]')");
            $cuma = mysql_query("SELECT * FROM tour_mstourleader
                                    ORDER BY IDTourleader DESC limit 1");
            $saja = mysql_fetch_array($cuma);
            $inqid=$saja[IDTourleader];
            $hol=$_POST['HoldingVisa'];
            $val=$_POST['HoldingVisaValid'];
            $lim=count($hol);
            for ($satu=0; $satu<$lim; $satu++) {
                $hol1=$hol[$satu];
                $val1=$val[$satu];
                $validity=date('Y-m-d', strtotime($val1));
                mysql_query("INSERT INTO tour_tourleaderholding(IDTourleader,
                                           HoldingVisa,
                                           HoldingVisaValid) 
                                    VALUES ('$inqid','$hol1','$validity')");
            }
            mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
            header('location:media.php?module='.$module);
        }
    }
// Update Tourleader
    elseif ($module=='mstourleader' AND $act=='update'){
        $ceking = mysql_query("SELECT * FROM tbl_msemployee where employee_code = '$_POST[TourleaderNameS]' ");
        $ketemu = mysql_fetch_array($ceking);
        if($_POST[TourleaderType]=='IN HOUSE'){
            $TourleaderName=strtoupper($ketemu[employee_name]);
        }else{
            $TourleaderName=strtoupper($_POST[TourleaderName]);
        }
        $TourleaderPassportName=strtoupper($_POST[TourleaderPassportName]);
        $TourleaderNickName=strtoupper($_POST[TourleaderNickName]);
        $TourleaderAddress=strtoupper($_POST[TourleaderAddress]);
        $TourleaderExpertise=strtoupper($_POST[TourleaderExpertise]);
        $TourleaderPassportValid=date('Y-m-d', strtotime($_POST[TourleaderPassportValid]));
        $Description="Edit Tourleader ($TourleaderName)";
        mysql_query("UPDATE tour_mstourleader SET TourleaderGender = '$_POST[TourleaderGender]',
                                        EmpID = '$_POST[TourleaderNameS]',
                                        TourleaderType = '$_POST[TourleaderType]',
                                        TourleaderName = '$TourleaderName',
                                        TourleaderNickName = '$TourleaderNickName',
                                        TourleaderMobile = '$_POST[TourleaderMobile]',
                                        TourleaderPhone = '$_POST[TourleaderPhone]',
                                        TourleaderAddress = '$TourleaderAddress',
                                        TourleaderExpertise = '$TourleaderExpertise',
                                        TourleaderPassportName = '$TourleaderPassportName',
                                        TourleaderPassportNo = '$_POST[TourleaderPassportNo]',
                                        TourleaderPassportValid = '$TourleaderPassportValid',
                                        TourleaderStatus = '$_POST[TourleaderStatus]',
                                        TourleaderRemarks = '$_POST[TourleaderRemarks]'
                               WHERE IDTourleader = '$_POST[id]'");
        mysql_query("UPDATE tour_msproducttl SET TLName = '$_POST[TourleaderName]'
                               WHERE IDTourleader = '$_POST[id]'");
        $inqid=$_POST[id];
        mysql_query("DELETE from tour_tourleaderholding WHERE IDTourleader = '$_POST[id]'");
        $hol=$_POST['HoldingVisa'];
        $val=$_POST['HoldingVisaValid'];
        $lim=count($hol);
        for ($satu=0; $satu<$lim; $satu++) {
            $hol1=$hol[$satu];
            $val1=$val[$satu];
            $validity=date('Y-m-d', strtotime($val1));
            mysql_query("INSERT INTO tour_tourleaderholding(IDTourleader,
                                           HoldingVisa,
                                           HoldingVisaValid) 
                                    VALUES ('$inqid','$hol1','$validity')");
        }
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);
    }
// Input MS Supplier
    elseif ($module=='mssupplier' AND $act=='input'){
        $SupplierPIC = strtoupper($_POST['SupplierPIC']);
        $SupplierName = strtoupper($_POST['SupplierName']);
        $SupplierAddress = strtoupper($_POST['SupplierAddress']);

        $Description="Input New Supplier ($SupplierName)";
        mysql_query("INSERT INTO tour_mssupplier(SupplierName,SupplierPIC,SupplierAddress,SupplierPhone,SupplierFax,SupplierStatus)
                                       VALUES('$SupplierName','$SupplierPIC','$SupplierAddress','$_POST[SupplierPhone]',
                                                 '$_POST[SupplierFax]','$_POST[SupplierStatus]')");
        $cuma = mysql_query("SELECT * FROM tour_mssupplier
                                    ORDER BY IDSupplier DESC limit 1");
        $saja = mysql_fetch_array($cuma);
        $inqid=$saja[IDSupplier];
        $sup=$_POST['supplier'];
        $lim=count($sup);
        for ($satu=0; $satu<$lim; $satu++) {
            $sup1=$sup[$satu];
            mysql_query("INSERT INTO tour_destsupplier(IDCountry,
                                           IDSupplier) 
                                    VALUES ('$sup1','$inqid')");
        }
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);
    }
// Update MS Supplier
    elseif ($module=='mssupplier' AND $act=='update'){
        $SupplierPIC = strtoupper($_POST['SupplierPIC']);
        $SupplierName = strtoupper($_POST['SupplierName']);
        $SupplierAddress = strtoupper($_POST['SupplierAddress']);
        $edit=mysql_query("DELETE FROM tour_mshandler WHERE IDSupplier = '$SupplierName'");
        mysql_query("UPDATE tour_mssupplier SET SupplierName   = '$SupplierName',
                                       SupplierPIC      = '$SupplierPIC',
                                       SupplierAddress  = '$SupplierAddress',
                                       SupplierPhone    = '$_POST[SupplierPhone]',
                                       SupplierFax      = '$_POST[SupplierFax]',
                                       SupplierStatus      = '$_POST[SupplierStatus]' 
                               WHERE IDSupplier = '$_POST[id]'");
        $cuma = mysql_query("DELETE FROM tour_destsupplier WHERE IDSupplier = '$_POST[id]'");
        $sup=$_POST['supplier'];
        $lim=count($sup);
        for ($satu=0; $satu<$lim; $satu++) {
            $sup1=$sup[$satu];
            mysql_query("INSERT INTO tour_destsupplier(IDCountry,
                                           IDSupplier) 
                                    VALUES ('$sup1','$_POST[id]')");
        }
        $Description="Edit Supplier ($SupplierName)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);
    }
// Update crew pameran
    elseif ($module=='crewpameran' AND $act=='update'){
        $event = strtoupper($_POST['event']);
        $cuma = mysql_query("DELETE FROM tour_crewpameran WHERE IDEvent = '$_POST[id]'");
        $sup=$_POST['employee'];
        $lim=count($sup);
        for ($satu=0; $satu<$lim; $satu++) {
            $sup1=$sup[$satu];
            $tampil=mysql_query("SELECT tbl_msoffice.office_code,tbl_msemployee.employee_name
                                    FROM tbl_msemployee
                                    left join tbl_msoffice on tbl_msemployee.office_id = tbl_msoffice.office_id
                                    where employee_code='$sup1'");
            $emp=mysql_fetch_array($tampil);
            mysql_query("INSERT INTO tour_crewpameran(IDEvent,
                                           IDEmployee,
                                           EmployeeName,
                                           EmployeeDiv)
                                    VALUES ('$_POST[id]','$sup1','$emp[employee_name]','$emp[office_code]')");
        }
        $Description="Update Crew ($event)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module=dtpameran');
    }
// Update Flight Schedule
    elseif ($module=='prodflight' AND $act=='update'){ 
        $prodid=$_POST[id];
        $ceking = mysql_query("SELECT * FROM tour_msproductpnr where PnrProd = '$prodid' and GrvID = '$_POST[grvid]' ");
        $ketemu = mysql_num_rows($ceking);
        if($ketemu > 0){
            header("location:media.php?module=msproduct&act=prodflight&id=$prodid");
        }else{
            mysql_query("INSERT INTO tour_msproductpnr(PnrProd,
                                                PnrCountry,
                                                PnrCity,
                                                GrvID,
												InputDate) 
                                    VALUES ('$_POST[id]',
                                            '$_POST[pesawat]',
                                            '$_POST[kota]',     
											'$_POST[grvid]',
											'$today')");
            $cekgrv = mysql_query("SELECT * FROM tour_msgrv where IDGrv = '$_POST[grvid]' ");
            $hslcek=mysql_fetch_array($cekgrv);
            $tambah=$hslcek[ProductUse]+1;
            mysql_query("UPDATE tour_msgrv SET ProductUse  = '$tambah'
                           WHERE IDGrv = '$_POST[grvid]'");

            $Description="ADD PNR Product ID ($_POST[id])";
            mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
            header("location:media.php?module=msproduct&act=prodflight&id=$prodid");
        }
    }
// Update Flight Schedule
    elseif ($module=='grvdeposit' AND $act=='input'){
        $idgrv=$_POST[id];
        $DepDate = date('Y-m-d', strtotime($_POST['depdate']));
        $qcekgrv = mysql_query("SELECT DepStatus FROM tour_msgrv where IDGrv = '$idgrv' ");
        $dcekgrv=mysql_fetch_array($qcekgrv);

        mysql_query("INSERT INTO tour_msgrvdepo(IDGrv,
                                            RefNo,
                                            DepDate,
                                            Curr,
                                            DepAmount,
                                            Status,
                                            InputBy,
                                            InputDate) 
                                    VALUES ('$idgrv',
                                            '$_POST[refno]',
                                            '$DepDate',     
                                            '$_POST[curr]',
                                            '$_POST[depamount]',
                                            'NONE',
                                            '$EmpName',
                                            '$today')");
    	
        if($dcekgrv[DepStatus]!='NO REFUND'){
            mysql_query("UPDATE tour_msgrv 
		                   SET DepStatus = 'DEPOSIT', Updateby = '$EmpName', UpdateDate = '$today'
		                   WHERE IDGrv = '$idgrv'");
        }

        $Description="ADD Deposit for GRV ID ($_POST[id])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header("location:media.php?module=msgrv&act=managegrv&id=$idgrv");
        
    }
// Input Tourcode
    elseif ($module=='msproductcode' AND $act=='input'){
        $ceking = mysql_query("SELECT ProductcodeName FROM tour_msproductcode where ProductcodeName = '$_POST[ProductcodeName]'");
        $ketemu = mysql_num_rows($ceking);
        if($ketemu > 0){
            header('location:media.php?module=msproductcode&act=tambahproductcode');
        }else{
            $Productcode=strtoupper($_POST[Productcode]);
            $ProductcodeDestination=strtoupper($_POST['ProductcodeDestination']);
            $ProductcodeName=strtoupper($_POST[ProductcodeName]);
            $ProductcodeArea=strtoupper($_POST['ProductcodeArea']);
            $Description="Input New Tourcode ($ProductcodeDestination - $ProductcodeName)";
            mysql_query("INSERT INTO tour_msproductcode(Productcode,ProductcodeArea,ProductcodeDestination,ProductcodeName,ProductcodeBy,ProductcodeStatus)
                                       VALUES('$Productcode','$ProductcodeArea','$ProductcodeDestination','$ProductcodeName','$_POST[ProductcodeBy]','$_POST[ProductcodeStatus]')");
            $cuma = mysql_query("SELECT * FROM tour_msproductcode
                                    ORDER BY IDProductcode DESC limit 1");
            $saja = mysql_fetch_array($cuma);
            $inqid=$saja[IDProductcode];
            $sup=$_POST['ProductcodeCountry'];
            $lim=count($sup);
            for ($satu=0; $satu<$lim; $satu++) {
                $sup1=$sup[$satu];
                if($sup1<>'0') {
                    mysql_query("INSERT INTO tour_countryprodcode(Country,
                                           IDProductcode) 
                                    VALUES ('$sup1','$inqid')");
                }
            }
            mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
            header('location:media.php?module='.$module);
        }
    }
// Update Tourcode
    elseif ($module=='msproductcode' AND $act=='update'){
        $Productcode=strtoupper($_POST[Productcode]);
        $ProductcodeDestination=strtoupper($_POST[ProductcodeDestination]);
        $ProductcodeName=strtoupper($_POST[ProductcodeName]);
        $Description="Edit Tourcode ($ProductcodeDestination - $ProductcodeName)";
        mysql_query("UPDATE tour_msproductcode SET ProductcodeBy = '$_POST[ProductcodeBy]',
                                            ProductcodeArea = '$_POST[ProductcodeArea]',
                                            ProductcodeStatus = '$_POST[ProductcodeStatus]'
                               WHERE IDProductcode = '$_POST[id]'");
        $cuma = mysql_query("DELETE FROM tour_countryprodcode WHERE IDProductcode = '$_POST[id]'");
        $sup=$_POST['ProductcodeCountry'];
        $lim=count($sup);
        for ($satu=0; $satu<$lim; $satu++) {
            $sup1=$sup[$satu];
            if($sup1<>'0') {
                mysql_query("INSERT INTO tour_countryprodcode(Country,
                                           IDProductcode) 
                                    VALUES ('$sup1','$_POST[id]')");
            }
        }
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);
    }
// Input Producttype
    elseif ($module=='msproducttype' AND $act=='input'){
        $ProducttypeName=strtoupper($_POST[ProducttypeName]);
        $Description="Input New Product Type ($ProducttypeName)";
        mysql_query("INSERT INTO tour_msproducttype(ProducttypeName,CompanyID,Status)
                                       VALUES('$ProducttypeName','$_POST[companyid]','$_POST[Status]')");
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);
    }
// Update Producttype
    elseif ($module=='msproducttype' AND $act=='update'){
        $ProducttypeName=strtoupper($_POST[ProducttypeName]);
        $Description="Edit Product Type ($ProducttypeName)";
        mysql_query("UPDATE tour_msproducttype SET ProducttypeName = '$ProducttypeName',Status='$_POST[Status]'
                               WHERE IDProducttype = '$_POST[id]'");
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);
    }
// Input MS GRV
    elseif ($module=='msgrv' AND $act=='input'){
        $GrvArea=strtoupper($_POST[GrvArea]);
        $GrvSuppName=strtoupper($_POST[GrvSuppName]);
        $GrvDateOfDep = date('Y-m-d', strtotime($_POST['GrvDateOfDep']));
        $GrvPNR=strtoupper($_POST[GrvPnr]);
        $GrvFlightDetail=strtoupper($_POST[GrvFlightDetail]);
        $GrvFoc=strtoupper($_POST[GrvFoc]);
        $GrvDeadlineDeposit = date('Y-m-d', strtotime($_POST['GrvDeadlineDeposit']));
        $GrvReviewDeposit = date('Y-m-d', strtotime($_POST['GrvReviewDeposit']));
        $Description="Input New GRV";
        mysql_query("INSERT INTO tour_msgrv(GrvAirlines,
                                      Season,
                                      Year,
                                      GrvSuppName,
                                      GrvArea,          
                                      GrvStatus,
                                      DepStatus,
                                      GrvSeat,
                                      GrvPnr,
                                      GrvAdlFareCurr,
                                      GrvAdlFare,
                                      GrvFuelSurcharge,
                                      GrvTax,
                                      GrvChdFare,
                                      GrvInfFare,
                                      GrvFoc,
                                      GrvDeadlineDeposit,
                                      GrvReviewDeposit,
                                      GrvAmountSeat,
                                      GrvAmount,
                                      GrvSeatMat,
                                      GrvPenaltyDeposit,
                                      GrvRemarks,
                                      PnrFor,
                                      InputBy,
                                      InputDate,
                                      CompanyID)
                              VALUES('$_POST[GrvAirlines]',
                                     '$_POST[seaon]',
                                     '$_POST[year]',
                                     '$GrvSuppName',
                                     '$GrvArea',         
                                     'NONE',
                                     'ACTIVE',
                                     '$_POST[GrvSeat]',
                                     '$GrvPNR',
                                     '$_POST[GrvAdlFareCurr]',
                                     '$_POST[GrvAdlFare]',
                                     '$_POST[GrvFuelSurcharge]',
                                     '$_POST[GrvTax]',
                                     '$_POST[GrvChdFare]',
                                     '$_POST[GrvInfFare]',
                                     '$GrvFoc',
                                     '$GrvDeadlineDeposit',
                                     '$GrvReviewDeposit',
                                     '$_POST[GrvAmountSeat]',
                                     '$_POST[GrvAmount]',
                                     '0',
                                     '$_POST[GrvPenaltyDeposit]',
                                     '$_POST[GrvRemarks]',
                                     '$_POST[pnrfor]',
                                     '$EmpName',
                                     '$today',
                                     '$companyid')");
        $cuma = mysql_query("SELECT * FROM tour_msgrv
                                    ORDER BY IDGrv DESC limit 1");
        $saja = mysql_fetch_array($cuma);
        $grvid=$saja[IDGrv];
        $cuma = mysql_query("DELETE FROM tour_msprodflight WHERE IDGrv = '$grvid'");
        // New Flight 
        if($_POST[flightdetail]=='newflight'){
            $airline = $_POST['airline'];
            $aircode = $_POST['aircode'];
            $airdate= $_POST['airdate'];
            $airmonth=$_POST['airmonth'];
            $airclass=$_POST['airclass'];
            $airroutedep= $_POST['airroutedep'];
            $airroutearr= $_POST['airroutearr'];
            $airtimedep=$_POST['airtimedep'];
            $airtimearr=$_POST['airtimearr'];
            $aircross=$_POST['aircross'];
            $airstatus=$_POST['airstatus'];
            $note=$_POST['note'];
            $lim=count($aircode);
            $akhir=$lim-1;
            for ($satu=0; $satu<$lim; $satu++) {
                $airline1=strtoupper($airline[$satu]);
                $aircode1=strtoupper($aircode[$satu]);
                if($airdate[$satu]=='0000-00-00' or $airdate[$satu]==''){$airdate1='0000-00-00';}
                else{$airdate1=date('Y-m-d', strtotime($airdate[$satu])); }
                $airmonth1=$airmonth[$satu];
                $airclass1=strtoupper($airclass[$satu]);
                $airroutedep1=strtoupper($airroutedep[$satu]);
                $airroutearr1=strtoupper($airroutearr[$satu]);
                $airtimedep1=$airtimedep[$satu];
                $airtimearr1=$airtimearr[$satu];
                $aircross1=$aircross[$satu];
                $airstatus1=$airstatus[$satu];
                $note1=$note[$satu];
                if($aircode1<>'' and $airroutedep1<>'' and $airroutearr1 <>''){
                    mysql_query("INSERT INTO tour_msprodflight(IDGrv,
                                                    AirCode,
                                                    AirDate,
                                                    AirMonth,
												    AirClass,
                                                    AirRouteDep,
                                                    AirRouteArr,
                                                    AirTimeDep,
                                                    AirTimeArr,
                                                    AirCross,
												    AirStatus,
                                                    Note) 
                                        VALUES ('$grvid',
                                                '$airline1$aircode1',
                                                '$airdate1',
                                                '$airmonth1',
											    '$airclass1',
                                                '$airroutedep1',
                                                '$airroutearr1',
                                                '$airtimedep1',
                                                '$airtimearr1',
                                                '$aircross1',
											    '$airstatus1',
                                                '$note1')");
                    if ($satu == 0) {
                        $thnini = date("Y");
                        $nmonth = date("m", strtotime($airmonth1));
                        if ($airdate1 == '1970-01-01') {
                            $airdate1 = '0000-00-00';
                            $depstatus='INACTIVE';
                        } else {
                            $airdate1 = $airdate1;
                            $depstatus='ACTIVE';
                        }
                        $grvdepdate = "$airdate1";
                        mysql_query("UPDATE tour_msgrv set DepStatus = '$depstatus', GrvDateOfDep = '$grvdepdate',GrvCityOfDep = '$airroutedep1'
                                    WHERE IDGrv = '$grvid'");
                    }
                    if ($satu >= 0) {
                        $thnini = date("Y");
                        $nmonth = date("m", strtotime($airmonth1));
                        if ($airroutedep1 <> '') {
                            if ($airdate1 == '1970-01-01') {
                                $airdate1 = '0000-00-00';
                            } else {
                                $airdate1 = $airdate1;
                            }
                            $grvdepdate = "$airdate1";
                            mysql_query("UPDATE tour_msgrv set GrvDateOfArr = '$grvdepdate',GrvCityOfArr = '$airroutedep1'
                                        WHERE IDGrv = '$grvid'");
                        }
                    }
                }
            }
            //------
        }else if($_POST[flightdetail]=='copyflight'){
            $tampil=mysql_query("SELECT * FROM tour_msprodflight
                                WHERE IDGrv = '$_POST[copyidgrv]'");
            while($r=mysql_fetch_array($tampil)){
                mysql_query("INSERT INTO tour_msprodflight(IDGrv,
                                                        AirCode,
                                                        AirDate,
                                                        AirMonth,
                                                        AirClass,
                                                        AirRouteDep,
                                                        AirRouteArr,
                                                        AirTimeDep,
                                                        AirTimeArr,
                                                        AirCross,
                                                        AirStatus,
                                                        Note) 
                                            VALUES ('$grvid',
                                                    '$r[AirCode]',
                                                    '$r[AirDate]',
                                                    '$r[AirMonth]',
                                                    '$r[AirClass]',
                                                    '$r[AirRouteDep]',
                                                    '$r[AirRouteArr]',
                                                    '$r[AirTimeDep]',
                                                    '$r[AirTimeArr]',
                                                    '$r[AirCross]',
                                                    '$r[AirStatus]',
                                                    '$r[Note]')");
            }
            $copygrv=mysql_query("SELECT * FROM tour_msgrv
                                WHERE IDGrv = '$_POST[copyidgrv]'");
            $copy=mysql_fetch_array($copygrv);
            mysql_query("UPDATE tour_msgrv set GrvDateOfDep = '$copy[GrvDateOfDep]',
                                               GrvCityOfDep = '$copy[GrvCityOfDep]',
                                               GrvDateOfArr = '$copy[GrvDateOfArr]',
                                               GrvCityOfArr = '$copy[GrvCityOfArr]'
                                        WHERE IDGrv = '$grvid'");
        }
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header("location:media.php?module=msgrv&act=editgrv&id=$grvid");
    }
// Update MS GRV
    elseif ($module=='msgrv' AND $act=='update'){
        $GrvDateOfDep = date('Y-m-d', strtotime($_POST['GrvDateOfDep']));
        $GrvPNR=strtoupper($_POST[GrvPnr]);
        $GrvFlightDetail=strtoupper($_POST[GrvFlightDetail]);
        $GrvFoc=strtoupper($_POST[GrvFoc]);
        $GrvDeadlineDeposit = date('Y-m-d', strtotime($_POST['GrvDeadlineDeposit']));
        $GrvReviewDeposit = date('Y-m-d', strtotime($_POST['GrvReviewDeposit']));
        $Description="Update GRV";
        if($_POST[terpakai] > 0){
            mysql_query("UPDATE tour_msgrv set  Season = '$_POST[season]',
                                      Year = '$_POST[year]',       
                                      GrvSeat = '$_POST[GrvSeat]',
                                      GrvPnr = '$GrvPNR',                        
                                      GrvTax = '$_POST[GrvTax]',            
                                      GrvDeadlineDeposit = '$GrvDeadlineDeposit',
                                      GrvReviewDeposit = '$GrvReviewDeposit',
                                      GrvAmountSeat = '$_POST[GrvAmountSeat]',
                                      GrvAmount = '$_POST[GrvAmount]',
                                      GrvRemarks = '$_POST[GrvRemarks]',
                                      PnrFor = '$_POST[pnrfor]',
                                      DepStatus = '$depstatus',
                                      UpdateBy = '$EmpName',
                                      UpdateDate = '$today'
                                WHERE IDGrv = '$_POST[id]'");
        }else{
            mysql_query("UPDATE tour_msgrv set  Season = '$_POST[season]',
                                      Year = '$_POST[year]',
                                      GrvDateOfDep = '$GrvDateOfDep',
                                      GrvFlightDetail = '$GrvFlightDetail',
                                      GrvSeat = '$_POST[GrvSeat]',
                                      GrvPnr = '$GrvPNR',
                                      GrvAdlFareCurr = '$_POST[GrvAdlFareCurr]',
                                      GrvAdlFare = '$_POST[GrvAdlFare]',
                                      GrvTax = '$_POST[GrvTax]',
                                      GrvChdFare = '$_POST[GrvChdFare]',
                                      GrvInfFare = '$_POST[GrvInfFare]',
                                      GrvFoc = '$GrvFoc',
                                      GrvDeadlineDeposit = '$GrvDeadlineDeposit',
                                      GrvReviewDeposit = '$GrvReviewDeposit',
                                      GrvAmountSeat = '$_POST[GrvAmountSeat]',
                                      GrvAmount = '$_POST[GrvAmount]',
                                      GrvRemarks = '$_POST[GrvRemarks]',
                                      PnrFor = '$_POST[pnrfor]',
                                      DepStatus = '$depstatus',
                                      UpdateBy = '$EmpName',
                                      UpdateDate = '$today'
                                WHERE IDGrv = '$_POST[id]'");
        }
        if($_POST[terpakai] < 1){
            if($_POST[flightdetail]=='editflight'){
                $cuma = mysql_query("DELETE FROM tour_msprodflight WHERE IDGrv = '$_POST[id]'");
                $grvid = $_POST['id'];
                $airline = $_POST['airline'];
                $aircode = $_POST['aircode'];
                $airdate= $_POST['airdate'];
                $airmonth=$_POST['airmonth'];
                $airclass=$_POST['airclass'];
                $airroutedep= $_POST['airroutedep'];
                $airroutearr= $_POST['airroutearr'];
                $airtimedep=$_POST['airtimedep'];
                $airtimearr=$_POST['airtimearr'];
                $aircross=$_POST['aircross'];
                $airstatus=$_POST['airstatus'];
                $note=$_POST['note'];
                $lim=count($aircode);
                $akhir=$lim-1;
                for ($satu=0; $satu<$lim; $satu++) {
                    $airline1=strtoupper($airline[$satu]);
                    $aircode1=strtoupper($aircode[$satu]);
                    if($airdate[$satu]=='0000-00-00' or $airdate[$satu]==''){$airdate1='0000-00-00';}
                    else{$airdate1=date('Y-m-d', strtotime($airdate[$satu])); }
                    $airmonth1=$airmonth[$satu];
                    $airclass1=strtoupper($airclass[$satu]);
                    $airroutedep1=strtoupper($airroutedep[$satu]);
                    $airroutearr1=strtoupper($airroutearr[$satu]);
                    $airtimedep1=$airtimedep[$satu];
                    $airtimearr1=$airtimearr[$satu];
                    $aircross1=$aircross[$satu];
                    $airstatus1=$airstatus[$satu];
                    $note1=$note[$satu];
                    if($aircode1<>'' and $airroutedep1<>'' and $airroutearr1 <> '') {
                        mysql_query("INSERT INTO tour_msprodflight(IDGrv,
                                                        AirCode,
                                                        AirDate,
                                                        AirMonth,
                                                        AirClass,
                                                        AirRouteDep,
                                                        AirRouteArr,
                                                        AirTimeDep,
                                                        AirTimeArr,
                                                        AirCross,
                                                        AirStatus,
                                                        Note) 
                                            VALUES ('$grvid',
                                                    '$airline1$aircode1',
                                                    '$airdate1',
                                                    '$airmonth1',
                                                    '$airclass1',
                                                    '$airroutedep1',
                                                    '$airroutearr1',
                                                    '$airtimedep1',
                                                    '$airtimearr1',
                                                    '$aircross1',
                                                    '$airstatus1',
                                                    '$note1')");
                        if ($satu == 0) {
                            $thnini = date("Y");
                            $nmonth = date("m", strtotime($airmonth1));
                            if ($airdate1 == '1970-01-01') {
                                $airdate1 = '0000-00-00';
                                $depstatus = 'INACTIVE';
                            } else {
                                $airdate1 = $airdate1;
                                $depstatus ='ACTIVE';
                            }
                            $grvdepdate = "$airdate1";
                            mysql_query("UPDATE tour_msgrv set DepStatus = '$depstatus',GrvDateOfDep = '$grvdepdate',GrvCityOfDep = '$airroutedep1'
                                        WHERE IDGrv = '$grvid'");
                        }
                        if ($satu == $akhir) {
                            $thnini = date("Y");
                            $nmonth = date("m", strtotime($airmonth1));
                            if ($airdate1 == '1970-01-01') {
                                $airdate1 = '0000-00-00';
                            } else {
                                $airdate1 = $airdate1;
                            }
                            $grvdepdate = "$airdate1";
                            mysql_query("UPDATE tour_msgrv set GrvDateOfArr = '$grvdepdate',GrvCityOfArr = '$airroutedep1'
                                        WHERE IDGrv = '$grvid'");
                        }
                    }
                }
            }else if($_POST[flightdetail]=='copyflight'){
                $cuma = mysql_query("DELETE FROM tour_msprodflight WHERE IDGrv = '$_POST[id]'");
                $grvid = $_POST['id'];
                $tampil=mysql_query("SELECT * FROM tour_msprodflight
                                WHERE IDGrv = '$_POST[copyidgrv]'");
                while($r=mysql_fetch_array($tampil)){
                    mysql_query("INSERT INTO tour_msprodflight(IDGrv,
                                                        AirCode,
                                                        AirDate,
                                                        AirMonth,
                                                        AirClass,
                                                        AirRouteDep,
                                                        AirRouteArr,
                                                        AirTimeDep,
                                                        AirTimeArr,
                                                        AirCross,
                                                        AirStatus,
                                                        Note) 
                                            VALUES ('$grvid',
                                                    '$r[AirCode]',
                                                    '$r[AirDate]',
                                                    '$r[AirMonth]',
                                                    '$r[AirClass]',
                                                    '$r[AirRouteDep]',
                                                    '$r[AirRouteArr]',
                                                    '$r[AirTimeDep]',
                                                    '$r[AirTimeArr]',
                                                    '$r[AirCross]',
                                                    '$r[AirStatus]',
                                                    '$r[Note]')");
                }
                $copygrv=mysql_query("SELECT * FROM tour_msgrv
                                WHERE IDGrv = '$_POST[copyidgrv]'");
                $copy=mysql_fetch_array($copygrv);
                mysql_query("UPDATE tour_msgrv set GrvDateOfDep = '$copy[GrvDateOfDep]',
                                               GrvCityOfDep = '$copy[GrvCityOfDep]',
                                               GrvDateOfArr = '$copy[GrvDateOfArr]',
                                               GrvCityOfArr = '$copy[GrvCityOfArr]'
                                        WHERE IDGrv = '$grvid'");
            }
        }
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header("location:media.php?module=msgrv&act=editgrv&id=$_POST[id]");
    }
// Input Season
    elseif ($module=='msseason' AND $act=='input'){

        $SeasonName=strtoupper($_POST[seasonname]);
        $Description="Input New Season ($SeasonName)";
        mysql_query("INSERT INTO tour_msseason(SeasonName,SeasonStatus)
                                       VALUES('$SeasonName','$_POST[seasonstatus]')");
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);

    }
// Update Season
    elseif ($module=='msseason' AND $act=='update'){
        $SeasonName=strtoupper($_POST[seasonname]);
        $Description="Input New Season ($SeasonName)";
        mysql_query("UPDATE tour_msseason SET SeasonName = '$SeasonName',
                                        SeasonStatus = '$_POST[seasonstatus]'
                               WHERE IDSeason = '$_POST[id]'");
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);

    }
// insert product TMR         
    elseif ($module=='msproducttmr' AND $act=='input'){
        $ceking = mysql_query("SELECT TourCode FROM tour_msproduct where TourCode = '$_POST[tourcode]' and Year = '$_POST[year]' and Status <> 'VOID' ");
        $ketemu = mysql_num_rows($ceking);
        if($ketemu > 0){?>
            <form method='POST' action='./media.php?module=msproduct&act=reqmsproduct' name='thisForm' id='thisForm'>
                <?php    foreach ($_POST as $key => $value) { ?>
                    <input name='<?php    echo $key; ?>' value='<?php    echo $value; ?>' type='hidden'>
                <?php    } ?>
                <input name='redirected' type='hidden'><input type='submit' id='submit'>
            </form>
            <script type="text/javascript">
                document.getElementById("submit").click();
            </script>

            <?php
            //  header('location:media.php?module=msproduct&act=tambahmsproduct');
        }else{
            $tmp_name = $_FILES['upload']['tmp_name'];
            $new_name = $_FILES['upload']['name'];
            $a=$_POST[quotationcurr];
            $b=$_POST[sellingcurr];
            if($a == $b){
                $selrat='1';
            }else{
                $selrat=$_POST[sellingrate];
            }
            $fullpath = "./itin/";
            $fullpath = str_replace("..", "", str_replace("\.", "", str_replace("//", "/", $fullpath)));
            $clean_name = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name) ) ) );
            if($new_name==''){
                $date = date("Y-m-d G:i:s", time());
                $name =  $_FILES['upload']['name'];
                $remarks=strtoupper($_POST[remarks]);
                $tourcode=strtoupper($_POST[tourcode]);
                $cuma = mysql_query("SELECT * FROM tour_msproductcodereq where Productcodename = '$_POST[productcode]' ");
                $saja = mysql_fetch_array($cuma);
                $Dest=$saja[ProductcodeDestination];
                mysql_query("INSERT INTO tour_msproductreq( Season,
                        Year,
                        ProductType,
                        Department,
                        GroupType,
                        ProductFor,    
                        ProductCode,
                        Destination,   
                        DateTravelFrom,
                        DateTravelTo,
                        DaysTravel,
                        Flight,
                        Seat,
                        SeatSisa,
                        TourCode,
                        TourLeaderInc,
                        Insurance,
                        Visa,
                        Embassy01,
                        Embassy02,
                        Embassy03,
                        Embassy04,
                        Embassy05,
                        QuotationCurr,
                        SellingCurr,
                        SellingOperator,
                        SellingRate,
                        Remarks,
                        Status,
                        TmrNo,
                        InputBy,
                        InputDate)
                        VALUES( '$_POST[season]',
                        '$_POST[year]',
                        '$_POST[producttype]',
                        '$_POST[department]', 
                        '$_POST[grouptype]',
                        '$_POST[productfor]',   
                        '$_POST[productcode]',
                        '$Dest', 
                        '$_POST[datetravelfrom]',
                        '$_POST[datetravelto]',
                        '$_POST[daystravel]',
                        '$_POST[flight]', 
                        '$_POST[seat]',
                        '$_POST[seat]',
                        '$tourcode',
                        '$_POST[tourleaderinc]',
                        '$_POST[insurance]',
                        '$_POST[visa]',
                        '$_POST[embassy01]',
                        '$_POST[embassy02]',
                        '$_POST[embassy03]',
                        '$_POST[embassy04]',    
                        '$_POST[embassy05]',
                        '$_POST[quotationcurr]', 
                        '$_POST[sellingcurr]',
                        '$_POST[sellingoperator]',
                        '$selrat',
                        '$remarks',    
                        '$_POST[status]',
                        '$_POST[tmrno]',
                        '$EmpName',
                        '$date')");

                $cuma = mysql_query("SELECT * FROM tour_msproductreq
                                    ORDER BY IDProduct DESC limit 1");
                $saja = mysql_fetch_array($cuma);
                $inqid=$saja[IDProduct];
                for($i=1;$i<11;$i++){
                    mysql_query("INSERT INTO tour_detailreq(Detail,
                                   IDProduct,
                                   Category) 
                            VALUES ('VAR$i', 
                                   '$inqid', 
                                   'VARIABLE')");
                    mysql_query("INSERT INTO tour_detailreq(Detail,
                                   IDProduct,
                                   Category) 
                            VALUES ('FIX$i', 
                                   '$inqid', 
                                   'FIX')");
                    mysql_query("INSERT INTO tour_agentreq(IDProduct,
                                   Category ) 
                            VALUES ('$inqid', 
                                   'AGENT$i')");
                }
                if($_POST[tmrno]<>''){
                    mysql_query("UPDATE tour_mstmrreq SET Status = 'NEED CONFIRM',IDProduct='$inqid'
                               WHERE IDTmr = '$_POST[tmrno]'");
                }
                mysql_query("UPDATE tour_detailreq SET Description = 'TICKET'
                               WHERE IDProduct = '$inqid' AND Detail ='FIX1' ");
                mysql_query("UPDATE tour_detailreq SET Description = 'AIRPORT HANDLING'
                               WHERE IDProduct = '$inqid' AND Detail ='FIX2' ");
                mysql_query("UPDATE tour_detailreq SET Description = 'INSURANCE'
                               WHERE IDProduct = '$inqid' AND Detail ='FIX3' ");
                mysql_query("UPDATE tour_detailreq SET Description = 'PROMOTION'
                               WHERE IDProduct = '$inqid' AND Detail ='FIX4' ");
                mysql_query("UPDATE tour_detailreq SET Description = 'APT TAX + FLT INSR + FUEL SURC'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR1' ");
                mysql_query("UPDATE tour_detailreq SET Description = 'T/L APT TAX JKT'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR2' ");
                mysql_query("UPDATE tour_detailreq SET Description = 'GHC'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR3' ");
                mysql_query("UPDATE tour_detailreq SET Description = 'TL ACCOMODATION'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR4' ");
                mysql_query("UPDATE tour_detailreq SET Description = 'T/L TICKETS'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR5' ");
                mysql_query("UPDATE tour_detailreq SET Description = 'MISCELANEOUS'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR6' ");
                mysql_query("INSERT INTO tour_msdetailreq(IDProduct)
                            VALUES ('$inqid')");
                $Description="Input New TMR Product ($tourcode)";
                mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
                header('location:media.php?module=msproduct&act=quotationtmr&id='.$inqid);
            }else{
                if ((!file_exists($fullpath.$clean_name))){
                    // create a sub-directory if required
                    if (!is_dir($fullpath)){
                        mkdir("$fullpath", 0755);
                    }
                    //Move file from tmp dir to new location
                    move_uploaded_file($tmp_name,$fullpath . $clean_name);
                    $date = date("Y-m-d G:i:s", time());
                    $name =  $_FILES['upload']['name'];
                    $remarks=strtoupper($_POST[remarks]);
                    $tourcode=strtoupper($_POST[tourcode]);
                    $cuma = mysql_query("SELECT * FROM tour_msproductcode where Productcodename = '$_POST[productcode]' ");
                    $saja = mysql_fetch_array($cuma);
                    $Dest=$saja[ProductcodeDestination];
                    mysql_query("INSERT INTO tour_msproductreq( Season,
                        Year,
                        ProductType,
                        Department,
                        GroupType,
                        ProductFor,    
                        ProductCode,
                        Destination,   
                        DateTravelFrom,
                        DateTravelTo,
                        DaysTravel,
                        Flight,
                        Seat,
                        SeatSisa,
                        TourCode,
                        TourLeaderInc,
                        Insurance,
                        Visa,
                        Embassy01,
                        Embassy02,
                        Embassy03,
                        Embassy04,
                        Embassy05,
                        QuotationCurr,
                        SellingCurr,
                        SellingOperator,
                        SellingRate,
                        Attachment,
                        AttachmentFile,
                        Remarks,
                        Status,
                        TmrNo,
                        InputBy,
                        InputDate)
                        VALUES( '$_POST[season]',
                        '$_POST[year]',
                        '$_POST[producttype]',
                        '$_POST[department]', 
                        '$_POST[grouptype]',
                        '$_POST[productfor]',   
                        '$_POST[productcode]',
                        '$Dest', 
                        '$_POST[datetravelfrom]',
                        '$_POST[datetravelto]',
                        '$_POST[daystravel]',
                        '$_POST[flight]', 
                        '$_POST[seat]',
                        '$_POST[seat]',
                        '$tourcode',
                        '$_POST[tourleaderinc]',
                        '$_POST[insurance]',
                        '$_POST[visa]',
                        '$_POST[embassy01]',
                        '$_POST[embassy02]',
                        '$_POST[embassy03]',
                        '$_POST[embassy04]',    
                        '$_POST[embassy05]',
                        '$_POST[quotationcurr]', 
                        '$_POST[sellingcurr]',
                        '$_POST[sellingoperator]',
                        '$selrat',
                        '$fullpath', 
                        '$name',
                        '$remarks',    
                        '$_POST[status]',
                        '$_POST[tmrno]',
                        '$EmpName',
                        '$date')");

                    $cuma = mysql_query("SELECT * FROM tour_msproductreq
                                    ORDER BY IDProduct DESC limit 1");
                    $saja = mysql_fetch_array($cuma);
                    $inqid=$saja[IDProduct];
                    for($i=1;$i<11;$i++){
                        mysql_query("INSERT INTO tour_detailreq(Detail,
                                   IDProduct,
                                   Category) 
                            VALUES ('VAR$i', 
                                   '$inqid', 
                                   'VARIABLE')");
                        mysql_query("INSERT INTO tour_detailreq(Detail,
                                   IDProduct,
                                   Category) 
                            VALUES ('FIX$i', 
                                   '$inqid', 
                                   'FIX')");
                        mysql_query("INSERT INTO tour_agentreq(IDProduct,
                                   Category ) 
                            VALUES ('$inqid', 
                                   'AGENT$i')");
                    }
                    if($_POST[tmrno]<>''){
                        mysql_query("UPDATE tour_mstmrreq SET Status = 'NEED CONFIRM',IDProduct='$inqid'
                               WHERE IDTmr = '$_POST[tmrno]'");
                    }
                    mysql_query("UPDATE tour_detailreq SET Description = 'TICKET'
                               WHERE IDProduct = '$inqid' AND Detail ='FIX1' ");
                    mysql_query("UPDATE tour_detailreq SET Description = 'AIRPORT HANDLING'
                               WHERE IDProduct = '$inqid' AND Detail ='FIX2' ");
                    mysql_query("UPDATE tour_detailreq SET Description = 'INSURANCE'
                               WHERE IDProduct = '$inqid' AND Detail ='FIX3' ");
                    mysql_query("UPDATE tour_detailreq SET Description = 'PROMOTION'
                               WHERE IDProduct = '$inqid' AND Detail ='FIX4' ");
                    mysql_query("UPDATE tour_detailreq SET Description = 'APT TAX + FLT INSR + FUEL SURC'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR1' ");
                    mysql_query("UPDATE tour_detailreq SET Description = 'T/L APT TAX JKT'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR2' ");
                    mysql_query("UPDATE tour_detailreq SET Description = 'GHC'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR3' ");
                    mysql_query("UPDATE tour_detailreq SET Description = 'TL ACCOMODATION'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR4' ");
                    mysql_query("UPDATE tour_detailreq SET Description = 'T/L TICKETS'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR5' ");
                    mysql_query("UPDATE tour_detailreq SET Description = 'MISCELANEOUS'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR6' ");
                    mysql_query("INSERT INTO tour_msdetailreq(IDProduct)
                            VALUES ('$inqid')");
                    $Description="Input New TMR Product ($tourcode)";
                    mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
                    header('location:media.php?module=msproduct&act=quotationtmr&id='.$inqid);

                    //   $status= "<font size ='2' color=red>$clean_name of {$_FILES['upload']['size']} bytes was uploaded sucessfully </font>";
                }else{
                    //Print Error Message
                    $status="<small>File <strong><em> {$_FILES[upload][name]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
                    echo"<center>$status <br><input type=button value=Back onclick=self.history.back()></center>";
                }
            }
        }
    }
// insert ITINERARY         
    elseif ($module=='msitin' AND $act=='input'){
        $daystravel=$_POST[daystravel];
        $prod=mysql_query("SELECT * FROM tour_msitin
                    WHERE ProductID = '$_POST[productid]'
                    AND Language = '$_POST[lang]' and Style='LTM' ");
        $adaprod=mysql_num_rows($prod);
        if($adaprod<>$daystravel){
            mysql_query("DELETE FROM tour_msitin
                    WHERE ProductID = '$_POST[productid]' and Style='LTM' ");
        }
        for ($satu=1; $satu<=$daystravel; $satu++) {
            $route=strtoupper($_POST[route.$satu]);
            $detail=$_POST[detail.$satu];
            $hotel=$_POST[hotel.$satu];
            $trans=$_POST[trans.$satu];
            $breakfast=$_POST[breakfast.$satu];
            $lunch=$_POST[lunch.$satu];
            $dinner=$_POST[dinner.$satu];
            $cashbackmeals=$_POST[cashbackmeals.$satu];
            if($adaprod<1 OR $adaprod<>$daystravel){
                $hot=mysql_query("SELECT * FROM tour_mshotel where IDHotel='$hotel' ");
                $htlada=mysql_num_rows($hot);
                $htl=mysql_fetch_array($hot);
                if($_POST[htlnote.$satu]=='htlhotel'){
                    if($htlada>'0'){
                        $hotelupdate="$htl[HotelName]<br>$htl[Address]<br>$htl[City],$htl[Country]<br>$htl[Telephone]";
                    }else{
                        $hotelupdate="";
                    }
                }else{
                    $hotel='0';
                    $hotelupdate=$_POST[hoteldetail.$satu];
                }
                mysql_query("INSERT INTO tour_msitin(ProductID,
                                                   Language,
                                                   Days,
                                                   Route,
                                                   Detail,
                                                   HotelID,
                                                   Hotel, 
                                                   Transport,     
                                                   Breakfast,
                                                   Lunch,
                                                   Dinner,
                                                   CashbackMeals,
                                                   Style)
                                            VALUES ('$_POST[productid]', 
                                                   '$_POST[lang]',
                                                   '$satu',
                                                   '$route',
                                                   '$detail',
                                                   '$hotel',   
                                                   '$hotelupdate',
                                                   '$trans',   
                                                   '$breakfast',
                                                   '$lunch',
                                                   '$dinner',
                                                   '$cashbackmeals',
                                                   '$_POST[style]')");
            }else{
                if($_POST[htlnote.$satu]=='htlnote'){
                    $hotel='0';
                }
                $qid=mysql_query("SELECT * FROM tour_msitin
                    WHERE ProductID = '$_POST[productid]' AND Language = '$_POST[lang]' and Days = '$satu' and Style='LTM' ");
                $idlama=mysql_fetch_array($qid);
                $hot=mysql_query("SELECT * FROM tour_mshotel where IDHotel='$hotel' ");
                $htl=mysql_fetch_array($hot);
                $hotelupdate=$_POST[hoteldetail.$satu];
                mysql_query("UPDATE tour_msitin SET Route = '$route',
                                                Detail = '$detail',
                                                HotelID = '$hotel',
                                                Hotel = '$hotelupdate',
                                                Transport = '$trans',
                                                Breakfast = '$breakfast',
                                                Lunch = '$lunch',
                                                Dinner = '$dinner',
                                                CashbackMeals = '$cashbackmeals',
                                                Style = '$_POST[style]'
                               WHERE ProductID='$_POST[productid]' and Language ='$_POST[lang]' and Days = '$satu'");
            }
        }
        $quphtl=mysql_query("SELECT * FROM tour_msitin
                    WHERE ProductID = '$_POST[productid]' AND Language = '$_POST[lang]' and Style='LTM'  and HotelID <> '0' limit 1");
        $uphtl=mysql_fetch_array($quphtl);
        mysql_query("update tour_msproduct SET HotelID = '$uphtl[HotelID]' where IDProduct = '$_POST[productid]' ");

        $bonus=strtoupper($_POST[bonus]);
        $tmp_name = $_FILES['upload']['tmp_name'];
        $new_name = $_FILES['upload']['name'];

        $fullpath = "./map/";
        $fullpath = str_replace("..", "", str_replace("\.", "", str_replace("//", "/", $fullpath)));
        $clean_name = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name) ) ) );
        $productdescription = $_POST[productdescription];
        if($new_name==''){
            $name =  $_FILES['upload']['name'];
            mysql_query("UPDATE tour_msproduct SET ProductBonus = '$bonus',
                                          ProductColumn = '$_POST[column]',
                                          ProductTippingStatus = '$_POST[tipsi]',
                                          ProductDescription = '$productdescription',
                                          ProductTipping = '$_POST[tipping]',
										  StyleItin='$_POST[style]',
                                          TempatKumpul = '$_POST[tempatkumpul]'
                               WHERE IDProduct = '$_POST[productid]'");
        }else{
            if ((!file_exists($fullpath.$clean_name))){
                // create a sub-directory if required
                if (!is_dir($fullpath)){
                    mkdir("$fullpath", 0755);
                }
                //Move file from tmp dir to new location
                move_uploaded_file($tmp_name,$fullpath . $clean_name);
                $date = date("Y-m-d G:i:s", time());
                $name =  $_FILES['upload']['name'];
                mysql_query("UPDATE tour_msproduct SET ProductBonus = '$bonus',
                                          ProductColumn = '$_POST[column]',
                                          ProductTippingStatus = '$_POST[tipsi]',
                                          ProductDescription = '$productdescription',
                                          ProductTipping = '$_POST[tipping]',
										  StyleItin='$_POST[style]',
                                          TempatKumpul = '$_POST[tempatkumpul]',
                                          MapFolder = '$fullpath',
                                          MapFile = '$name'
                               WHERE IDProduct = '$_POST[productid]'");
            }else{
                //Print Error Message
                $status="<small>File <strong><em> {$_FILES[upload][name]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
                echo"<center>$status <br><input type=button value=Back onclick=self.history.back()></center>";
            }
        }
        mysql_query("DELETE from tour_msitinopttour WHERE ProductID = '$_POST[productid]'");
        $opttour=$_POST['optiontour'];
        $optdesc=$_POST['optiondesc'];
        $optprice=$_POST['optionprice'];
        $optlim=count($opttour);
        for ($hsatu=0; $hsatu<$optlim; $hsatu++) {
            $opttour1=$opttour[$hsatu];
            $optdesc1=$optdesc[$hsatu];
            $optprice1=$optprice[$hsatu];
            if($opttour1<>''){
            mysql_query("INSERT INTO tour_msitinopttour(ProductID,
                                                        OptionName,
                                                        OptionDescription,
                                                        OptionPrice)
                                                   VALUES ('$_POST[productid]','$opttour1','$optdesc1','$optprice1')");
            }
        }

        $Description="Itinerary (IDProduct: $_POST[productid])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module=msproduct');

    }
// insert ITINERARY TEZ
    elseif ($module=='msitintez' AND $act=='input'){
        $daystravel=$_POST[daystravel];
        $prod=mysql_query("SELECT *,CONVERT(Days, UNSIGNED INTEGER) as urut FROM tour_msitin
                    WHERE ProductID = '$_POST[productid]'
                    AND Language = '$_POST[lang]'
                    AND Style = 'TEZ' order by urut");
        $adaprod=mysql_num_rows($prod);
        for ($satu=1; $satu<=$daystravel; $satu++) {
            $object01=$_POST[object01.$satu];
            $objecttrans01=$_POST[objecttrans01.$satu];
            $object02=$_POST[object02.$satu];
            $objecttrans02=$_POST[objecttrans02.$satu];
            $object03=$_POST[object03.$satu];
            $objecttrans03=$_POST[objecttrans03.$satu];
            $object04=$_POST[object04.$satu];
            $objecttrans04=$_POST[objecttrans04.$satu];
            $object05=$_POST[object05.$satu];
            $mengunjungi=mysql_real_escape_string($_POST[mengunjungi.$satu]);$melewati=mysql_real_escape_string($_POST[melewati.$satu]);
            $mengunjungi2=mysql_real_escape_string($_POST[mengunjungi2.$satu]);$melewati2=mysql_real_escape_string($_POST[melewati2.$satu]);
            $mengunjungi3=mysql_real_escape_string($_POST[mengunjungi3.$satu]);$melewati3=mysql_real_escape_string($_POST[melewati3.$satu]);
            $mengunjungi4=mysql_real_escape_string($_POST[mengunjungi4.$satu]);$melewati4=mysql_real_escape_string($_POST[melewati4.$satu]);
            $mengunjungi5=mysql_real_escape_string($_POST[mengunjungi5.$satu]);$melewati5=mysql_real_escape_string($_POST[melewati5.$satu]);
            $mengunjungi6=mysql_real_escape_string($_POST[mengunjungi6.$satu]);$melewati6=mysql_real_escape_string($_POST[melewati6.$satu]);
            $mengunjungi7=mysql_real_escape_string($_POST[mengunjungi7.$satu]);$melewati7=mysql_real_escape_string($_POST[melewati7.$satu]);
            $mengunjungi8=mysql_real_escape_string($_POST[mengunjungi8.$satu]);$melewati8=mysql_real_escape_string($_POST[melewati8.$satu]);
            $shopping=mysql_real_escape_string($_POST[shopping.$satu]);$photostop=mysql_real_escape_string($_POST[photostop.$satu]);
            $shopping2=mysql_real_escape_string($_POST[shopping2.$satu]);$photostop2=mysql_real_escape_string($_POST[photostop2.$satu]);
            $shopping3=mysql_real_escape_string($_POST[shopping3.$satu]);$photostop3=mysql_real_escape_string($_POST[photostop3.$satu]);
            $shopping4=mysql_real_escape_string($_POST[shopping4.$satu]);$photostop4=mysql_real_escape_string($_POST[photostop4.$satu]);
            $shopping5=mysql_real_escape_string($_POST[shopping5.$satu]);$photostop5=mysql_real_escape_string($_POST[photostop5.$satu]);
            $shopping6=mysql_real_escape_string($_POST[shopping6.$satu]);$photostop6=mysql_real_escape_string($_POST[photostop6.$satu]);
            $shopping7=mysql_real_escape_string($_POST[shopping7.$satu]);$photostop7=mysql_real_escape_string($_POST[photostop7.$satu]);
            $shopping8=mysql_real_escape_string($_POST[shopping8.$satu]);$photostop8=mysql_real_escape_string($_POST[photostop8.$satu]);
            $itininfo=mysql_real_escape_string($_POST[itininfo.$satu]);
            //$itininfo=mysql_real_escape_string($itininfo1);
            $breakfasttype=$_POST[breakfast.$satu];
            $lunchtype=$_POST[lunch.$satu];
            $dinnertype=$_POST[dinner.$satu];
            $hotel=$_POST[hotel.$satu];
            if($adaprod<1){
                $hot=mysql_query("SELECT * FROM tour_mshotel where IDHotel='$hotel' ");
                $htlada=mysql_num_rows($hot);
                $htl=mysql_fetch_array($hot);
                    if($htlada>0){
                        $hotelupdate="$htl[HotelName]<br>$htl[Address]<br>$htl[City],$htl[Country]<br>$htl[Telephone]";
                    }else{
                        $hotelupdate="";
                    }
                mysql_query("INSERT INTO tour_msitin(ProductID,
                                                   Language,
                                                   Days,
                                                   Object01,
                                                   Object02,
                                                   Object03,
                                                   Object04,
                                                   Object05,
                                                   ObjectTrans01,
                                                   ObjectTrans02,
                                                   ObjectTrans03,
                                                   ObjectTrans04,
                                                   Mengunjungi,Mengunjungi2,Mengunjungi3,Mengunjungi4,Mengunjungi5,Mengunjungi6,Mengunjungi7,Mengunjungi8,
                                                   Melewati,Melewati2,Melewati3,Melewati4,Melewati5,Melewati6,Melewati7,Melewati8,
                                                   Shopping,Shopping2,Shopping3,Shopping4,Shopping5,Shopping6,Shopping7,Shopping8,
                                                   Photostop,Photostop2,Photostop3,Photostop4,Photostop5,Photostop6,Photostop7,Photostop8,
                                                   ItinInfo,
                                                   BreakfastType,
                                                   LunchType,
                                                   DinnerType,
                                                   HotelID,
                                                   Hotel,
                                                   Style)
                                            VALUES ('$_POST[productid]',
                                                   '$_POST[lang]',
                                                   '$satu',
                                                   '$object01',
                                                   '$object02',
                                                   '$object03',
                                                   '$object04',
                                                   '$object05',
                                                   '$objecttrans01',
                                                   '$objecttrans02',
                                                   '$objecttrans03',
                                                   '$objecttrans04',
                                                   '$mengunjungi','$mengunjungi2','$mengunjungi3','$mengunjungi4','$mengunjungi5','$mengunjungi6','$mengunjungi7','$mengunjungi8',
                                                   '$melewati','$melewati2','$melewati3','$melewati4','$melewati5','$melewati6','$melewati7','$melewati8',
                                                   '$shopping','$shopping2','$shopping3','$shopping4','$shopping5','$shopping6','$shopping7','$shopping8',
                                                   '$photostop','$photostop2','$photostop3','$photostop4','$photostop5','$photostop6','$photostop7','$photostop8',
                                                   '$itininfo',
                                                   '$breakfasttype',
                                                   '$lunchtype',
                                                   '$dinnertype',
                                                   '$hotel',
                                                   '$hotelupdate',
                                                   'TEZ')");
            }else{
                mysql_query("UPDATE tour_msitin SET Object01 = '$object01',
                                                    Object02 = '$object02',
                                                    Object03 = '$object03',
                                                    Object04 = '$object04',
                                                    Object05 = '$object05',
                                                    ObjectTrans01 = '$objecttrans01',
                                                    ObjectTrans02 = '$objecttrans02',
                                                    ObjectTrans03 = '$objecttrans03',
                                                    ObjectTrans04 = '$objecttrans04',
                                                    Mengunjungi = '$mengunjungi',Mengunjungi2 = '$mengunjungi2',Mengunjungi3 = '$mengunjungi3',Mengunjungi4 = '$mengunjungi4',
                                                    Mengunjungi5 = '$mengunjungi5',Mengunjungi6 = '$mengunjungi6',Mengunjungi7 = '$mengunjungi7',Mengunjungi8 = '$mengunjungi8',
                                                    Melewati = '$melewati',Melewati2 = '$melewati2',Melewati3 = '$melewati3',Melewati4 = '$melewati4',
                                                    Melewati5 = '$melewati5',Melewati6 = '$melewati6',Melewati7 = '$melewati7',Melewati8 = '$melewati8',
                                                    Shopping = '$shopping',Shopping2 = '$shopping2',Shopping3 = '$shopping3',Shopping4 = '$shopping4',
                                                    Shopping5 = '$shopping5',Shopping6 = '$shopping6',Shopping7 = '$shopping7',Shopping8 = '$shopping8',
                                                    Photostop = '$photostop',Photostop2 = '$photostop2',Photostop3 = '$photostop3',Photostop4 = '$photostop4',
                                                    Photostop5 = '$photostop5',Photostop6 = '$photostop6',Photostop7 = '$photostop7',Photostop8 = '$photostop8',
                                                    HotelID = '$hotel', Hotel = '$hotelupdate',
                                                    ItinInfo = '$itininfo',
                                                    BreakfastType = '$breakfasttype',
                                                    LunchType = '$lunchtype',
                                                    DinnerType = '$dinnertype',
                                                    Style = 'TEZ'
                               WHERE ProductID='$_POST[productid]' and Language ='$_POST[lang]' and Style ='TEZ' and Days = '$satu'");
            }
            /*mysql_query("DELETE from tour_msitinhotel WHERE ProductID = '$_POST[productid]'");
            $hot=$_POST['hotel'];
            $htllim=count($hot);
            for ($hsatu=0; $hsatu<$htllim; $hsatu++) {
                $hot1=$hot[$hsatu];
                $qhtl=mysql_query("SELECT * FROM tour_mshotel where IDHotel='$hot1' ");
                $htl=mysql_fetch_array($qhtl);
                mysql_query("INSERT INTO tour_msitinhotel(ProductID,
                                                          HotelID,
                                                          HotelName)
                                                   VALUES ('$_POST[productid]','$hot1','$htl[HotelName]')");
            }*/
        }

        $bonus=strtoupper($_POST[bonus]);
        $tmp_name = $_FILES['upload']['tmp_name'];
        $new_name = $_FILES['upload']['name'];

        $fullpath = "./map/"; 
        $fullpath = str_replace("..", "", str_replace("\.", "", str_replace("//", "/", $fullpath)));
        $clean_name = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name) ) ) );
        $productdescription = $_POST[productdescription];
        $highcountry = strtoupper($_POST[highlightcountry]);
        if($_POST[statusitin]=='ACTIVE'){$styleitin="StyleItin = '$_POST[style]',";}else{$styleitin="";}
        if($new_name==''){
            $name =  $_FILES['upload']['name'];
            mysql_query("UPDATE tour_msproduct SET ProductBonus = '$bonus',
                                          ProductColumn = '$_POST[column]',
                                          ProductTippingStatus = '$_POST[tipsi]',
                                          ProductTipping = '$_POST[tipping]',
                                          ProductDescription = '$productdescription',
                                          HighlightCountry = '$highcountry',
                                          StyleItin='$_POST[style]',
                                          CuacaItin = '$_POST[cuacaitin]',
                                          TempatKumpul = '$_POST[tempatkumpul]'
                               WHERE IDProduct = '$_POST[productid]'");
        }else{
            if ((!file_exists($fullpath.$clean_name))){
                // create a sub-directory if required
                if (!is_dir($fullpath)){
                    mkdir("$fullpath", 0755);
                }
                //Move file from tmp dir to new location
                move_uploaded_file($tmp_name,$fullpath . $clean_name);
                $date = date("Y-m-d G:i:s", time());
                $name =  $_FILES['upload']['name'];
                mysql_query("UPDATE tour_msproduct SET ProductBonus = '$bonus',
                                          ProductColumn = '$_POST[column]',
                                          ProductTippingStatus = '$_POST[tipsi]',
                                          ProductTipping = '$_POST[tipping]',
                                          ProductDescription = '$productdescription',
                                          HighlightCountry = '$highcountry',
                                          StyleItin='TEZ',
                                          CuacaItin = '$_POST[cuacaitin]',
                                          TempatKumpul = '$_POST[tempatkumpul]',
                                          MapFolder = '$fullpath',
                                          MapFile = '$name'
                               WHERE IDProduct = '$_POST[productid]'");
            }else{
                //Print Error Message
                $status="<small>File <strong><em> {$_FILES[upload][name]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
                echo"<center>$status <br><input type=button value=Back onclick=self.history.back()></center>";
            }
        }

        $Description="Itinerary (IDProduct: $_POST[productid])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('$EmpName',
                                   '$Description',
                                   '$today')");
        header('location:media.php?module=msproduct');

    }
// insert ITINERARY TMR
    elseif ($module=='msitin' AND $act=='tmr'){
        $daystravel=$_POST[daystravel];
        $tmrid=$_POST[tmrid];
        $prod=mysql_query("SELECT * FROM tour_msitintmrreq
                WHERE ProdID = '$_POST[productid]'
                AND TmrOption = '$_POST[opt]'
                AND Language = '$_POST[lang]'");
        $adaprod=mysql_num_rows($prod);
        $nol=0;
        if($_POST[productstatus]=='baru'){
            $caridata=mysql_query("SELECT * FROM tour_mstmrreq WHERE IDTmr = '$tmrid' ");
            $datatmr=mysql_fetch_array($caridata);
            $seat=$datatmr[Seat]+$datatmr[SeatChild];
            mysql_query("INSERT INTO tour_msproductreq( Season,
                        Year,
                        ProductType,
                        Department,
                        GroupType,
                        ProductFor,
                        ProductCode,
                        Destination,
                        DateTravelFrom,
                        DateTravelTo,
                        DaysTravel,
                        Flight,
                        Seat,
                        SeatSisa,
                        TourCode,
                        TourLeaderInc,
                        Insurance,
                        Visa,
                        Embassy01,
                        Embassy02,
                        Embassy03,
                        Embassy04,
                        Embassy05,
                        QuotationCurr,
                        SellingCurr,
                        SellingOperator,
                        SellingRate,
                        Remarks,
                        Status,
                        TmrNo,
                        InputBy,
                        InputDate)
                        VALUES( '',
                        '',
                        'TAILOR MADE REQUEST',
                        '$datatmr[Department]',
                        'TMR',
                        '$datatmr[ProductFor]',
                        'TMR',
                        '$datatmr[Destination]',
                        '$datatmr[DateTravelFrom]',
                        '$datatmr[DateTravelTo]',
                        '$datatmr[DaysTravel]',
                        '$_POST[flight]',
                        '$seat',
                        '$seat',
                        '',
                        '$datatmr[TourLeaderInc]',
                        '$datatmr[Insurance]',
                        'NOT INCLUDE',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '$datatmr[BudgetCurr]',
                        '$datatmr[BudgetCurr]',
                        '*',
                        '1',
                        '',
                        'NOT PUBLISHED',
                        '$tmrid',
                        '$EmpName',
                        '$today')");

            $cuma = mysql_query("SELECT * FROM tour_msproductreq
                                    ORDER BY IDProduct DESC limit 1");
            $saja = mysql_fetch_array($cuma);
            $inqid=$saja[IDProduct];
            for($i=1;$i<11;$i++){
                mysql_query("INSERT INTO tour_detailreq(Detail,
                                   IDProduct,
                                   Category)
                            VALUES ('VAR$i',
                                   '$inqid',
                                   'VARIABLE')");
                mysql_query("INSERT INTO tour_detailreq(Detail,
                                   IDProduct,
                                   Category)
                            VALUES ('FIX$i',
                                   '$inqid',
                                   'FIX')");
                mysql_query("INSERT INTO tour_agentreq(IDProduct,
                                   Category )
                            VALUES ('$inqid',
                                   'AGENT$i')");
            }
            mysql_query("UPDATE tour_mstmrreq SET Status = 'NEED CONFIRM',IDProduct='$inqid'
                               WHERE IDTmr = '$datatmr[IDTmr]'");

            mysql_query("UPDATE tour_detailreq SET Description = 'TICKET'
                               WHERE IDProduct = '$inqid' AND Detail ='FIX1' ");
            mysql_query("UPDATE tour_detailreq SET Description = 'AIRPORT HANDLING'
                               WHERE IDProduct = '$inqid' AND Detail ='FIX2' ");
            mysql_query("UPDATE tour_detailreq SET Description = 'INSURANCE'
                               WHERE IDProduct = '$inqid' AND Detail ='FIX3' ");
            mysql_query("UPDATE tour_detailreq SET Description = 'PROMOTION'
                               WHERE IDProduct = '$inqid' AND Detail ='FIX4' ");
            mysql_query("UPDATE tour_detailreq SET Description = 'APT TAX + FLT INSR + FUEL SURC'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR1' ");
            mysql_query("UPDATE tour_detailreq SET Description = 'T/L APT TAX JKT'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR2' ");
            mysql_query("UPDATE tour_detailreq SET Description = 'GHC'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR3' ");
            mysql_query("UPDATE tour_detailreq SET Description = 'TL ACCOMODATION'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR4' ");
            mysql_query("UPDATE tour_detailreq SET Description = 'T/L TICKETS'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR5' ");
            mysql_query("UPDATE tour_detailreq SET Description = 'MISCELANEOUS'
                               WHERE IDProduct = '$inqid' AND Detail ='VAR6' ");
            mysql_query("INSERT INTO tour_msdetailreq(IDProduct)
                            VALUES ('$inqid')");
        }else{
            $inqid=$_POST[productid];
        }
        for ($satu=1; $satu<=$daystravel; $satu++) {

            $route=strtoupper($_POST[route.$satu]);
            $detail=$_POST[detail.$satu];
            $hotel=$_POST[hotel.$satu];
            $trans=$_POST[trans.$satu];
            $breakfast=$_POST[breakfast.$satu];
            $lunch=$_POST[lunch.$satu];
            $dinner=$_POST[dinner.$satu];
            $breakfastdesc=strtoupper($_POST[breakfastdesc.$satu]);
            $lunchdesc=strtoupper($_POST[lunchdesc.$satu]);
            $dinnerdesc=strtoupper($_POST[dinnerdesc.$satu]);
            $photo=$_POST[photo][$satu];
            $ptmp_name = $_FILES['photo']['tmp_name'][$satu];
            $pnew_name = $_FILES['photo']['name'][$satu];

            $pfullpath = "./itin/tmr/$_POST[productid]/";
            //$pfullpath = str_replace("..", "", str_replace("\.", "", str_replace("//", "/", $pfullpath)));
            $pclean_name = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($pnew_name) ) ) );


            if($pnew_name==''){
                $pname =$photo;
            }else{
                if ((!file_exists($pfullpath.$pclean_name))){
                    // create a sub-directory if required
                    if (!is_dir($pfullpath)){
                        mkdir("$pfullpath", 0755);
                    }
                    //Move file from tmp dir to new location
                    move_uploaded_file($ptmp_name,$pfullpath . $pclean_name);

                    $pname =  $_FILES['photo']['name'][$satu];
                    $headermskphoto="PhotoFolder,
                                 Photo,";
                    $dtlmskphoto="'$pfullpath',
                              '$pname',";
                    $mskphoto="PhotoFolder = '$pfullpath',
                           Photo = '$pname',";
                }else{
                    //Print Error Message
                    $pstatus="<small>File <strong><em> {$_FILES[photo][name][$satu]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
                    echo"<center>$pstatus <br><input type=button value=Back onclick=self.history.back()></center>";
                }
            }
            //new itin
            if($_POST[productstatus]=='baru'){
                $hot=mysql_query("SELECT * FROM tour_mshotel where IDHotel='$hotel' ");
                $htlada=mysql_num_rows($hot);
                $htl=mysql_fetch_array($hot);
                if($_POST[htlnote.$satu]=='htlhotel'){
                    if($htlada>'0'){
                        $hotelupdate="$htl[HotelName]";
                    }else{
                        $hotelupdate="";
                    }
                }else{
                    $hotel='0';
                    $hotelupdate=$_POST[hoteldetail.$satu];
                }
                mysql_query("INSERT INTO tour_msitintmrreq(ProdID,
                                               TmrOption,
                                               Language,
                                               Days,
                                               Route,
                                               Detail,
                                               HotelID,
                                               Hotel,
                                               Transport,
                                               PhotoFolder,
                                               Photo,
                                               Breakfast,
                                               Lunch,
                                               Dinner,
                                               BreakfastDesc,
                                               LunchDesc,
                                               DinnerDesc)
                                        VALUES ('$inqid',
                                               '$_POST[opt]',
                                               '$_POST[lang]',
                                               '$satu',
                                               '$route',
                                               '$detail',
                                               '$hotel',
                                               '$hotelupdate',
                                               '$trans',
                                               '$pfullpath',
                                               '$pname',
                                               '$breakfast',
                                               '$lunch',
                                               '$dinner',
                                               '$breakfastdesc',
                                               '$lunchdesc',
                                               '$dinnerdesc')");
            }
            //edit itin
            else{
                if($_POST[htlnote.$satu]=='htlnote'){
                    $hotel='0';
                }
                $qid=mysql_query("SELECT * FROM tour_msitintmrreq
                WHERE ProdID = '$_POST[productid]' AND TmrOption = '$_POST[opt]' AND Language = '$_POST[lang]' and Days = '$satu'");
                $idlama=mysql_fetch_array($qid);
                $hot=mysql_query("SELECT * FROM tour_mshotel where IDHotel='$hotel' ");
                $htl=mysql_fetch_array($hot);
                $hotelupdate=$_POST[hoteldetail.$satu];
                mysql_query("UPDATE tour_msitintmrreq SET Route = '$route',
                                            Detail = '$detail',
                                            HotelID = '$hotel',
                                            Hotel = '$hotelupdate',
                                            Transport = '$trans',
                                            PhotoFolder = '$pfullpath',
                                            Photo = '$pname',
                                            Breakfast = '$breakfast',
                                            Lunch = '$lunch',
                                            Dinner = '$dinner',
                                            BreakfastDesc = '$breakfastdesc',
                                            LunchDesc = '$lunchdesc',
                                            DinnerDesc = '$dinnerdesc'
                           WHERE ProdID = '$inqid' and Language ='$_POST[lang]' and Days = '$satu'");
            }$nol++;
        }
        $quphtl=mysql_query("SELECT * FROM tour_msitintmrreq
                WHERE ProdID = '$inqid' AND TmrOption = '$_POST[opt]' AND Language = '$_POST[lang]' and HotelID <> '0' limit 1");
        $uphtl=mysql_fetch_array($quphtl);
        mysql_query("update tour_msproduct SET HotelID = '$uphtl[HotelID]' where IDProduct = '$inqid' ");
        $bonus=strtoupper($_POST[bonus]);
        $tmp_name = $_FILES['upload']['tmp_name'];
        $new_name = $_FILES['upload']['name'];

        $fullpath = "./map/tmr/$inqid/";
        $fullpath = str_replace("..", "", str_replace("\.", "", str_replace("//", "/", $fullpath)));
        $clean_name = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name) ) ) );
        if($new_name==''){
            $name =  $_FILES['upload']['name'];
            mysql_query("UPDATE tour_msproductreq SET
                                       SellingAdlTwn = '$_POST[rsadult1]',
                                       SellingChdTwn = '$_POST[rschdtwn1]',
                                       SellingChdNbed = '$_POST[rschdnbed1]',
                                       SellingChdXbed = '$_POST[rschdxbed1]',
                                       SellingInfant = '$_POST[rsinfant1]',
                                       TaxInsNett = '$_POST[taxinsnett]',
                                       TaxInsSell = '$_POST[taxinssell]',
                                       LandArrNett = '$_POST[landarrnett]',
                                       LandArrSell = '$_POST[landarrsell]',
                                       SingleNett = '$_POST[singlenett]',
                                       SingleSell = '$_POST[singlesell]',
                                       VisaCurr = '$_POST[visacurr]',
                                       VisaNett = '$_POST[visanett]',
                                       VisaSell = '$_POST[visasell]',
                                       VisaCurr2 = '$_POST[visacurr2]',
                                       VisaNett2 = '$_POST[visanett2]',
                                       VisaSell2 = '$_POST[visasell2]',
                                       AirTaxCurr = '$_POST[airtaxcurr]',
                                       AirTaxNett = '$_POST[airtaxnett]',
                                       AirTaxSell = '$_POST[airtaxsell]',
                                       SeaTaxNett = '$_POST[seataxnett]',
                                       SeaTaxSell = '$_POST[seataxsell]',
                                       ProductBonus = '$bonus',
                                       ProductColumn = '$_POST[column]',
                                       ProductTippingCurr = '$_POST[karensi]',
                                       ProductTipping = '$_POST[tipping]',
                                       TempatKumpul = '$_POST[tempatkumpul]'
                           WHERE IDProduct = '$inqid'");
        }else{
            if ((!file_exists($fullpath.$clean_name))){
                // create a sub-directory if required
                if (!is_dir($fullpath)){
                    mkdir("$fullpath", 0755);
                }
                //Move file from tmp dir to new location
                move_uploaded_file($tmp_name,$fullpath . $clean_name);
                $date = date("Y-m-d G:i:s", time());
                $name =  $_FILES['upload']['name'];
                mysql_query("UPDATE tour_msproductreq SET
                                       SellingAdlTwn = '$_POST[rsadult1]',
                                       SellingChdTwn = '$_POST[rschdtwn1]',
                                       SellingChdNbed = '$_POST[rschdnbed1]',
                                       SellingChdXbed = '$_POST[rschdxbed1]',
                                       SellingInfant = '$_POST[rsinfant1]',
                                       TaxInsNett = '$_POST[taxinsnett]',
                                       TaxInsSell = '$_POST[taxinssell]',
                                       LandArrNett = '$_POST[landarrnett]',
                                       LandArrSell = '$_POST[landarrsell]',
                                       SingleNett = '$_POST[singlenett]',
                                       SingleSell = '$_POST[singlesell]',
                                       VisaCurr = '$_POST[visacurr]',
                                       VisaNett = '$_POST[visanett]',
                                       VisaSell = '$_POST[visasell]',
                                       VisaCurr2 = '$_POST[visacurr2]',
                                       VisaNett2 = '$_POST[visanett2]',
                                       VisaSell2 = '$_POST[visasell2]',
                                       AirTaxCurr = '$_POST[airtaxcurr]',
                                       AirTaxNett = '$_POST[airtaxnett]',
                                       AirTaxSell = '$_POST[airtaxsell]',
                                       SeaTaxNett = '$_POST[seataxnett]',
                                       SeaTaxSell = '$_POST[seataxsell]',
                                       ProductBonus = '$bonus',
                                       ProductColumn = '$_POST[column]',
                                       ProductTippingCurr = '$_POST[karensi]',
                                       ProductTipping = '$_POST[tipping]',
                                       TempatKumpul = '$_POST[tempatkumpul]',
                                       MapFolder = '$fullpath',
                                       MapFile = '$name'
                           WHERE IDProduct = '$inqid'");
            }else{
                //Print Error Message
                $status="<small>File <strong><em> {$_FILES[upload][name]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
                echo"<center>$status <br><input type=button value=Back onclick=self.history.back()></center>";
            }
        }
        mysql_query("DELETE FROM tour_msprodflighttmrreq where IDProduct = '$inqid' ");
        $airline = $_POST['airline'];
        $aircode = $_POST['aircode'];
        $airdate= $_POST['airdate'];
        $airmonth=$_POST['airmonth'];
        $airclass=$_POST['airclass'];
        $airroutedep= $_POST['airroutedep'];
        $airroutearr= $_POST['airroutearr'];
        $airtimedep=$_POST['airtimedep'];
        $airtimearr=$_POST['airtimearr'];
        $aircross=$_POST['aircross'];
        $airstatus=$_POST['airstatus'];
        $note=$_POST['note'];
        $lim=count($aircode);
        $akhir=$lim-1;
        for ($satu=0; $satu<$lim; $satu++) {
            $airline1=strtoupper($airline[$satu]);
            $aircode1=strtoupper($aircode[$satu]);
            if($airdate[$satu]=='0000-00-00' or $airdate[$satu]==''){$airdate1='0000-00-00';}
            else{$airdate1=date('Y-m-d', strtotime($airdate[$satu])); }
            $airmonth1=$airmonth[$satu];
            $airclass1=strtoupper($airclass[$satu]);
            $airroutedep1=strtoupper($airroutedep[$satu]);
            $airroutearr1=strtoupper($airroutearr[$satu]);
            $airtimedep1=$airtimedep[$satu];
            $airtimearr1=$airtimearr[$satu];
            $aircross1=$aircross[$satu];
            $airstatus1=$airstatus[$satu];
            $note1=$note[$satu];
            mysql_query("INSERT INTO tour_msprodflighttmrreq(IDProduct,
                                                    AirCode,
                                                    AirDate,
                                                    AirMonth,
												    AirClass,
                                                    AirRouteDep,
                                                    AirRouteArr,
                                                    AirTimeDep,
                                                    AirTimeArr,
                                                    AirCross,
												    AirStatus,
                                                    Note)
                                        VALUES ('$inqid',
                                                '$airline1$aircode1',
                                                '$airdate1',
                                                '$airmonth1',
											    '$airclass1',
                                                '$airroutedep1',
                                                '$airroutearr1',
                                                '$airtimedep1',
                                                '$airtimearr1',
                                                '$aircross1',
											    '$airstatus1',
                                                '$note1')");

        }
        mysql_query("DELETE FROM tour_msproductpricetmrreq where ProdID = '$inqid' ");
        mysql_query("INSERT INTO tour_msproductpricetmrreq(ProdID,
                                               PaxFor,
                                               Harga,
                                               SellingAdlTwn,
                                               SellingChdtwn,
                                               SellingChdXbed,
                                               SellingChdNbed,
                                               SellingInfant)
                                        VALUES ('$inqid',
                                               '$_POST[pax1]',
                                               '1',
                                               '$_POST[rsadult1]',
                                               '$_POST[rschdtwn1]',
                                               '$_POST[rschdxbed1]',
                                               '$_POST[rschdnbed1]',
                                               '$_POST[rsinfant1]')");
        if($_POST[pax2]<>''){
            mysql_query("INSERT INTO tour_msproductpricetmrreq(ProdID,
                                               PaxFor,
                                               Harga,
                                               SellingAdlTwn,
                                               SellingChdtwn,
                                               SellingChdXbed,
                                               SellingChdNbed,
                                               SellingInfant)
                                        VALUES ('$inqid',
                                               '$_POST[pax2]',
                                               '2',
                                               '$_POST[rsadult2]',
                                               '$_POST[rschdtwn2]',
                                               '$_POST[rschdxbed2]',
                                               '$_POST[rschdnbed2]',
                                               '$_POST[rsinfant2]')");
        }
        $Description="Itinerary (TMR: $inqid)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                               Description,
                               LogTime)
                        VALUES ('$EmpName',
                               '$Description',
                               '$today')");

        header("location:media.php?module=mstmr");

    }
// insert ITINERARY TMR PDF
    elseif ($module=='msitin' AND $act=='tmrpdf'){
    $idtmr=$_POST[idtmr];
    $fullpath = "./itin/tmr$idtmr/";
    $prod=mysql_query("SELECT * FROM tour_msitintmrpdf
                WHERE IDTmr = '$idtmr'");
    $adaprod=mysql_num_rows($prod);
    if($adaprod<1){
        mysql_query("INSERT INTO tour_msitintmrpdf(IDTmr,PdfFolder,Status)
                        VALUES ('$idtmr','$fullpath','NEED CONFIRM')");
    }
    //Itin Option 1
    $tmp_name0 = $_FILES['itinoption1']['tmp_name'];
    $new_name0 = $_FILES['itinoption1']['name'];
    $clean_name0 = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name0) ) ) );
    if($new_name0==''){
        $name0 =  $_POST[itin1];
        mysql_query("UPDATE tour_msitintmrpdf SET ItinOption1 = '$name0' WHERE IDTmr = '$idtmr'");
    }else{
        if ((!file_exists($fullpath.$clean_name0))){
            // create a sub-directory if required
            if (!is_dir($fullpath)){
                mkdir("$fullpath", 0755);
            }
            //Move file from tmp dir to new location
            move_uploaded_file($tmp_name0,$fullpath . $clean_name0);
            $name0 =  $clean_name0;
            mysql_query("UPDATE tour_msitintmrpdf SET ItinOption1 = '$name0' WHERE IDTmr = '$idtmr'");
        }else{
            //Print Error Message
            $status0="<small>File <strong><em> {$_FILES[itinoption1][name]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
            echo"<center>$status0 <br><input type=button value=Back onclick=self.history.back()></center>";
        }
    }

    //Quotation Option 1
    $tmp_name1 = $_FILES['quotationoption1']['tmp_name'];
    $new_name1 = $_FILES['quotationoption1']['name'];
    $clean_name1 = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name1) ) ) );
    if($new_name1==''){
        $name1 =  $_POST[quotation1];
        mysql_query("UPDATE tour_msitintmrpdf SET QuotationOption1 = '$name1' WHERE IDTmr = '$idtmr'");
    }else{
        if ((!file_exists($fullpath.$clean_name1))){
            // create a sub-directory if required
            if (!is_dir($fullpath)){
                mkdir("$fullpath", 0755);
            }
            //Move file from tmp dir to new location
            move_uploaded_file($tmp_name1,$fullpath . $clean_name1);
            $name1 =  $clean_name1;
            mysql_query("UPDATE tour_msitintmrpdf SET QuotationOption1 = '$name1' WHERE IDTmr = '$idtmr'");
        }else{
            //Print Error Message
            $status1="<small>File <strong><em> {$_FILES[quotationoption1][name]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
            echo"<center>$status1 <br><input type=button value=Back onclick=self.history.back()></center>";
        }
    }

    //Itin Option 2
    $tmp_name3 = $_FILES['itinoption2']['tmp_name'];
    $new_name3 = $_FILES['itinoption2']['name'];
    $clean_name3 = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name3) ) ) );
    if($new_name3==''){
        $name3 =  $_POST[itin2];
        mysql_query("UPDATE tour_msitintmrpdf SET ItinOption2 = '$name3' WHERE IDTmr = '$idtmr'");
    }else{
        if ((!file_exists($fullpath.$clean_name3))){
            // create a sub-directory if required
            if (!is_dir($fullpath)){
                mkdir("$fullpath", 0755);
            }
            //Move file from tmp dir to new location
            move_uploaded_file($tmp_name3,$fullpath . $clean_name3);
            $name3 =  $clean_name3;
            mysql_query("UPDATE tour_msitintmrpdf SET ItinOption2 = '$name3' WHERE IDTmr = '$idtmr'");
        }else{
            //Print Error Message
            $status3="<small>File <strong><em> {$_FILES[itinoption2][name]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
            echo"<center>$status3 <br><input type=button value=Back onclick=self.history.back()></center>";
        }
    }

    //Quotation Option 2
    $tmp_name4 = $_FILES['quotationoption2']['tmp_name'];
    $new_name4= $_FILES['quotationoption2']['name'];
    $clean_name4 = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name4) ) ) );
    if($new_name4==''){
        $name4 =  $_POST[quotation2];
        mysql_query("UPDATE tour_msitintmrpdf SET QuotationOption2 = '$name4' WHERE IDTmr = '$idtmr'");
    }else{
        if ((!file_exists($fullpath.$clean_name4))){
            // create a sub-directory if required
            if (!is_dir($fullpath)){
                mkdir("$fullpath", 0755);
            }
            //Move file from tmp dir to new location
            move_uploaded_file($tmp_name4,$fullpath . $clean_name4);
            $name4 =  $clean_name4;
            mysql_query("UPDATE tour_msitintmrpdf SET QuotationOption2 = '$name4' WHERE IDTmr = '$idtmr'");
        }else{
            //Print Error Message
            $status4="<small>File <strong><em> {$_FILES[quotationoption2][name]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
            echo"<center>$status4 <br><input type=button value=Back onclick=self.history.back()></center>";
        }
    }

    //Itin Option 3
    $tmp_name5 = $_FILES['itinoption3']['tmp_name'];
    $new_name5 = $_FILES['itinoption3']['name'];
    $clean_name5 = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name5) ) ) );
    if($new_name5==''){
        $name5 =  $_POST[itin3];
        mysql_query("UPDATE tour_msitintmrpdf SET ItinOption3 = '$name5' WHERE IDTmr = '$idtmr'");
    }else{
        if ((!file_exists($fullpath.$clean_name5))){
            // create a sub-directory if required
            if (!is_dir($fullpath)){
                mkdir("$fullpath", 0755);
            }
            //Move file from tmp dir to new location
            move_uploaded_file($tmp_name5,$fullpath . $clean_name5);
            $name5 =  $clean_name5;
            mysql_query("UPDATE tour_msitintmrpdf SET ItinOption3 = '$name5' WHERE IDTmr = '$idtmr'");
        }else{
            //Print Error Message
            $status5="<small>File <strong><em> {$_FILES[itinoption3][name]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
            echo"<center>$status5 <br><input type=button value=Back onclick=self.history.back()></center>";
        }
    }

    //Quotation Option 3
    $tmp_name6 = $_FILES['quotationoption3']['tmp_name'];
    $new_name6= $_FILES['quotationoption3']['name'];
    $clean_name6 = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name6) ) ) );
    if($new_name6==''){
        $name6 =  $_POST[quotation3];
        mysql_query("UPDATE tour_msitintmrpdf SET QuotationOption3 = '$name6' WHERE IDTmr = '$idtmr'");
    }else{
        if ((!file_exists($fullpath.$clean_name6))){
            // create a sub-directory if required
            if (!is_dir($fullpath)){
                mkdir("$fullpath", 0755);
            }
            //Move file from tmp dir to new location
            move_uploaded_file($tmp_name6,$fullpath . $clean_name6);
            $name6 =  $clean_name6;
            mysql_query("UPDATE tour_msitintmrpdf SET QuotationOption3 = '$name6' WHERE IDTmr = '$idtmr'");
        }else{
            //Print Error Message
            $status6="<small>File <strong><em> {$_FILES[quotationoption3][name]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
            echo"<center>$status6 <br><input type=button value=Back onclick=self.history.back()></center>";
        }
    }
    $qchoice=mysql_query("SELECT * FROM tour_msitintmrpdf
                    WHERE IDTmr = '$idtmr'");
    $isichoice=mysql_fetch_array($qchoice);
    if(($isichoice[ItinOption1]<>'' AND $isichoice[QuotationOption1]<>'')
        OR ($isichoice[ItinOption2]<>'' AND $isichoice[QuotationOption2]<>'')
        OR ($isichoice[ItinOption3]<>'' AND $isichoice[QuotationOption3]<>'')){
    mysql_query("UPDATE tour_mstmrreq SET Status = 'NEED CONFIRM'
                               WHERE IDTmr = '$idtmr'");
    }
    $Description="PDF Option (TMR: $idtmr)";
    mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                               Description,
                               LogTime)
                        VALUES ('$EmpName',
                               '$Description',
                               '$today')");

    header("location:media.php?module=msitin&act=tmrpdf&no=$idtmr");
}
// copy itin          
    elseif ($module=='msitin' AND $act=='copyitin'){
        $daystravel=$_POST[daystravel];
        $prod=mysql_query("SELECT * FROM tour_msitin
                    WHERE ProductID = '$_POST[id]' and Style='LTM' ");
        $adaprod=mysql_num_rows($prod);
        $prodcopy=mysql_query("SELECT * FROM tour_msitin
                    WHERE ProductID = '$_POST[idcopy]' and Style='LTM' order by Days ASC");
        $prodetailcopy=mysql_query("SELECT * FROM tour_msproduct
                    WHERE IDProduct = '$_POST[idcopy]' ");
        $isiprodetailcopy=mysql_fetch_array($prodetailcopy);
        //mysql_query("DELETE * FROM tour_msitin
        //            WHERE ProductID = '$_POST[id]'");
        if($adaprod<1){
            while($isiprodcopy=mysql_fetch_array($prodcopy)){
                $language=$isiprodcopy[Language];
                $days=$isiprodcopy[Days];
                $route=$isiprodcopy[Route];
                $detail=$isiprodcopy[Detail];
                $hotelid=$isiprodcopy[HotelID];
                $hotel=$isiprodcopy[Hotel];
                $transport=$isiprodcopy[Transport];
                $breakfast=$isiprodcopy[Breakfast];
                $lunch=$isiprodcopy[Lunch];
                $dinner=$isiprodcopy[Dinner];
                $Style=$isiprodcopy[Style];
                mysql_query("INSERT INTO tour_msitin(ProductID,
                                                   Language,
                                                   Days,
                                                   Route,
                                                   Detail,
                                                   HotelID,
                                                   Hotel,
                                                   Transport,
                                                   Breakfast,
                                                   Lunch,
                                                   Dinner,
                                                   Style)
                                            VALUES ('$_POST[id]', 
                                                   '$language',
                                                   '$days',
                                                   '$route',
                                                   '$detail',
                                                   '$hotelid',
                                                   '$hotel',
                                                   '$transport',
                                                   '$breakfast',
                                                   '$lunch',
                                                   '$dinner',
                                                   '$Style')");
            }
        }else {
            while ($isiprodcopy = mysql_fetch_array($prodcopy)) {
                $days = $isiprodcopy[Days];
                $route = $isiprodcopy[Route];
                $detail = $isiprodcopy[Detail];
                $hotelid = $isiprodcopy[HotelID];
                $hotel = $isiprodcopy[Hotel];
                $transport = $isiprodcopy[Transport];
                $breakfast = $isiprodcopy[Breakfast];
                $lunch = $isiprodcopy[Lunch];
                $dinner = $isiprodcopy[Dinner];
                $Style = $isiprodcopy[Style];
                mysql_query("UPDATE tour_msitin SET Route = '$route',
                                                Detail = '$detail',
                                                HotelID = '$hotelid',
                                                Hotel = '$hotel',
                                                Transport = '$transport',
                                                Breakfast = '$breakfast',
                                                Lunch = '$lunch',
                                                Dinner = '$dinner'
                               WHERE ProductID='$_POST[id]' and Days = '$days' and Style = '$Style'");
            }
        }
        mysql_query("UPDATE tour_msproduct SET ProductBonus = '$isiprodetailcopy[ProductBonus]',
                                          ProductColumn = '$isiprodetailcopy[ProductColumn]',
                                          StyleItin = '$isiprodetailcopy[StyleItin]',
                                          ProductTippingCurr = '$isiprodetailcopy[ProductTippingCurr]',
                                          ProductTipping = '$isiprodetailcopy[ProductTipping]',
                                          TempatKumpul = '$isiprodetailcopy[TempatKumpul]'
                               WHERE IDProduct = '$_POST[id]'");
        $Description="Update Itinerary ID Product ($_POST[id]) from ID Product ($_POST[idcopy])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                               Description,
                               LogTime) 
                        VALUES ('$EmpName', 
                               '$Description', 
                               '$today')");
        header("location:media.php?module=msitin&nama=$_POST[id]&type=createitin");
    }
//copy itin TUR EZ
    elseif ($module=='msitin' AND $act=='copyitintez'){
        $daystravel=$_POST[daystravel];
        $prod=mysql_query("SELECT * FROM tour_msitin
                    WHERE ProductID = '$_POST[id]' and Style='TEZ' ");
        $adaprod=mysql_num_rows($prod);
        $prodcopy=mysql_query("SELECT *,CONVERT(Days, UNSIGNED INTEGER) as urut FROM tour_msitin
                    WHERE ProductID = '$_POST[idcopy]' and Style='TEZ' order by urut ASC");
        $prodetailcopy=mysql_query("SELECT * FROM tour_msproduct
                    WHERE IDProduct = '$_POST[idcopy]' ");
        $isiprodetailcopy=mysql_fetch_array($prodetailcopy);
        mysql_query("DELETE FROM tour_msitinhotel
                    WHERE ProductID = '$_POST[id]'");
        /*$qhotelcopy=mysql_query("SELECT * FROM tour_msitinhotel
                    WHERE ProductID = '$_POST[idcopy]'");

        while($hotelcopy=mysql_fetch_array($qhotelcopy)){
        mysql_query("INSERT INTO tour_msitinhotel(ProductID,
                                           HotelID,
                                           HotelName)
                                    VALUES ('$_POST[id]',
                                           '$hotelcopy[HotelID]',
                                           '$hotelcopy[HotelName]')");
        }*/
        if($adaprod<1){
            $satu=1;
            while($isiprodcopy=mysql_fetch_array($prodcopy)){
                $language=$isiprodcopy[Language];
                $Days=$isiprodcopy[Days];
                $Object01=$isiprodcopy[Object01];
                $Object02=$isiprodcopy[Object02];
                $Object03=$isiprodcopy[Object03];
                $Object04=$isiprodcopy[Object04];
                $Object05=$isiprodcopy[Object05];
                $ObjectTrans01=$isiprodcopy[ObjectTrans01];
                $ObjectTrans02=$isiprodcopy[ObjectTrans02];
                $ObjectTrans03=$isiprodcopy[ObjectTrans03];
                $ObjectTrans04=$isiprodcopy[ObjectTrans04];
                $Mengunjungi=mysql_real_escape_string($isiprodcopy[Mengunjungi]);$Melewati=mysql_real_escape_string($isiprodcopy[Melewati]);
                $Mengunjungi2=mysql_real_escape_string($isiprodcopy[Mengunjungi2]);$Melewati2=mysql_real_escape_string($isiprodcopy[Melewati2]);
                $Mengunjungi3=mysql_real_escape_string($isiprodcopy[Mengunjungi3]);$Melewati3=mysql_real_escape_string($isiprodcopy[Melewati3]);
                $Mengunjungi4=mysql_real_escape_string($isiprodcopy[Mengunjungi4]);$Melewati4=mysql_real_escape_string($isiprodcopy[Melewati4]);
                $Mengunjungi5=mysql_real_escape_string($isiprodcopy[Mengunjungi5]);$Melewati5=mysql_real_escape_string($isiprodcopy[Melewati5]);
                $Mengunjungi6=mysql_real_escape_string($isiprodcopy[Mengunjungi6]);$Melewati6=mysql_real_escape_string($isiprodcopy[Melewati6]);
                $Mengunjungi7=mysql_real_escape_string($isiprodcopy[Mengunjungi7]);$Melewati7=mysql_real_escape_string($isiprodcopy[Melewati7]);
                $Mengunjungi8=mysql_real_escape_string($isiprodcopy[Mengunjungi8]);$Melewati8=mysql_real_escape_string($isiprodcopy[Melewati8]);
                $Shopping=mysql_real_escape_string($isiprodcopy[Shopping]);$Photostop=mysql_real_escape_string($isiprodcopy[Photostop]);
                $Shopping2=mysql_real_escape_string($isiprodcopy[Shopping2]);$Photostop2=mysql_real_escape_string($isiprodcopy[Photostop2]);
                $Shopping3=mysql_real_escape_string($isiprodcopy[Shopping3]);$Photostop3=mysql_real_escape_string($isiprodcopy[Photostop3]);
                $Shopping4=mysql_real_escape_string($isiprodcopy[Shopping4]);$Photostop4=mysql_real_escape_string($isiprodcopy[Photostop4]);
                $Shopping5=mysql_real_escape_string($isiprodcopy[Shopping5]);$Photostop5=mysql_real_escape_string($isiprodcopy[Photostop5]);
                $Shopping6=mysql_real_escape_string($isiprodcopy[Shopping6]);$Photostop6=mysql_real_escape_string($isiprodcopy[Photostop6]);
                $Shopping7=mysql_real_escape_string($isiprodcopy[Shopping7]);$Photostop7=mysql_real_escape_string($isiprodcopy[Photostop7]);
                $Shopping8=mysql_real_escape_string($isiprodcopy[Shopping8]);$Photostop8=mysql_real_escape_string($isiprodcopy[Photostop8]);
                $ItinInfo=$isiprodcopy[ItinInfo];
                $BreakfastType=$isiprodcopy[BreakfastType];
                $LunchType=$isiprodcopy[LunchType];
                $DinnerType=$isiprodcopy[DinnerType];
                $Style=$isiprodcopy[Style];
                $HotelID=$isiprodcopy[HotelID];$Hotel=$isiprodcopy[Hotel];
                mysql_query("INSERT INTO tour_msitin(ProductID,
                                                   Language,
                                                   Days,
                                                   Object01,
                                                   Object02,
                                                   Object03,
                                                   Object04,
                                                   Object05,
                                                   ObjectTrans01,
                                                   ObjectTrans02,
                                                   ObjectTrans03,
                                                   ObjectTrans04,
                                                   Mengunjungi,Mengunjungi2,Mengunjungi3,Mengunjungi4,
                                                   Mengunjungi5,Mengunjungi6,Mengunjungi7,Mengunjungi8,
                                                   Melewati,Melewati2,Melewati3,Melewati4,
                                                   Melewati5,Melewati6,Melewati7,Melewati8,
                                                   Shopping,Shopping2,Shopping3,Shopping4,
                                                   Shopping5,Shopping6,Shopping7,Shopping8,
                                                   Photostop,Photostop2,Photostop3,Photostop4,
                                                   Photostop5,Photostop6,Photostop7,Photostop8,
                                                   HotelID,Hotel,
                                                   ItinInfo,
                                                   BreakfastType,
                                                   LunchType,
                                                   DinnerType,
                                                   Style)
                                            VALUES ('$_POST[id]',
                                                   '$language',
                                                   '$Days',
                                                   '$Object01',
                                                   '$Object02',
                                                   '$Object03',
                                                   '$Object04',
                                                   '$Object05',
                                                   '$ObjectTrans01',
                                                   '$ObjectTrans02',
                                                   '$ObjectTrans03',
                                                   '$ObjectTrans04',
                                                   '$Mengunjungi','$Mengunjungi2','$Mengunjungi3','$Mengunjungi4',
                                                   '$Mengunjungi5','$Mengunjungi6','$Mengunjungi7','$Mengunjungi8',
                                                   '$Melewati','$Melewati2','$Melewati3','$Melewati4',
                                                   '$Melewati5','$Melewati6','$Melewati7','$Melewati8',
                                                   '$Shopping','$Shopping2','$Shopping3','$Shopping4',
                                                   '$Shopping5','$Shopping6','$Shopping7','$Shopping8',
                                                   '$Photostop','$Photostop2','$Photostop3','$Photostop4',
                                                   '$Photostop5','$Photostop6','$Photostop7','$Photostop8',
                                                   '$HotelID','$Hotel',
                                                   '$ItinInfo',
                                                   '$BreakfastType',
                                                   '$LunchType',
                                                   '$DinnerType',
                                                   '$Style')");
                $satu++;
            }
        }else{
            /*while($isiprodcopy=mysql_fetch_array($prodcopy)){
                $language=$isiprodcopy[Language];
                $Days=$isiprodcopy[Days];
                $Object01=$isiprodcopy[Object01];
                $Object02=$isiprodcopy[Object02];
                $Object03=$isiprodcopy[Object03];
                $Object04=$isiprodcopy[Object04];
                $Object05=$isiprodcopy[Object05];
                $ObjectTrans01=$isiprodcopy[ObjectTrans01];
                $ObjectTrans02=$isiprodcopy[ObjectTrans02];
                $ObjectTrans03=$isiprodcopy[ObjectTrans03];
                $ObjectTrans04=$isiprodcopy[ObjectTrans04];
                $Mengunjungi=$isiprodcopy[Mengunjungi];
                $Melewati=$isiprodcopy[Melewati];
                $Shopping=$isiprodcopy[Shopping];
                $ItinInfo=$isiprodcopy[ItinInfo];
                $BreakfastType=$isiprodcopy[BreakfastType];
                $LunchType=$isiprodcopy[LunchType];
                $DinnerType=$isiprodcopy[DinnerType];
                $Style=$isiprodcopy[Style];
                mysql_query("UPDATE tour_msitin SET Object01 = '$Object01',
                                                    Object02 = '$Object02',
                                                    Object03 = '$Object03',
                                                    Object04 = '$Object04',
                                                    Object05 = '$Object05',
                                                    ObjectTrans01 = '$Objecttrans01',
                                                    ObjectTrans02 = '$ObjectTrans02',
                                                    ObjectTrans03 = '$ObjectTrans03',
                                                    ObjectTrans04 = '$ObjectTrans04',
                                                    Mengunjungi = '$Mengunjungi',
                                                    Melewati = '$Melewati',
                                                    Shopping = '$Shopping',
                                                    ItinInfo = '$ItinInfo',
                                                    BreakfastType = '$BreakfastType',
                                                    LunchType = '$LunchType',
                                                    DinnerType = '$DinnerType'
                               WHERE ProductID = '$_POST[id]' and Days = '$Days' and Style = '$Style' and Language = '$language' ");
            }*/
            mysql_query("DELETE FROM tour_msitin
                    WHERE ProductID = '$_POST[id]' and Style='TEZ' ");
            $satu=1;
            while($isiprodcopy=mysql_fetch_array($prodcopy)){
                $language=$isiprodcopy[Language];
                $Days=$isiprodcopy[Days];
                $Object01=$isiprodcopy[Object01];
                $Object02=$isiprodcopy[Object02];
                $Object03=$isiprodcopy[Object03];
                $Object04=$isiprodcopy[Object04];
                $Object05=$isiprodcopy[Object05];
                $ObjectTrans01=$isiprodcopy[ObjectTrans01];
                $ObjectTrans02=$isiprodcopy[ObjectTrans02];
                $ObjectTrans03=$isiprodcopy[ObjectTrans03];
                $ObjectTrans04=$isiprodcopy[ObjectTrans04];
                $Mengunjungi=mysql_real_escape_string($isiprodcopy[Mengunjungi]);$Melewati=mysql_real_escape_string($isiprodcopy[Melewati]);
                $Mengunjungi2=mysql_real_escape_string($isiprodcopy[Mengunjungi2]);$Melewati2=mysql_real_escape_string($isiprodcopy[Melewati2]);
                $Mengunjungi3=mysql_real_escape_string($isiprodcopy[Mengunjungi3]);$Melewati3=mysql_real_escape_string($isiprodcopy[Melewati3]);
                $Mengunjungi4=mysql_real_escape_string($isiprodcopy[Mengunjungi4]);$Melewati4=mysql_real_escape_string($isiprodcopy[Melewati4]);
                $Mengunjungi5=mysql_real_escape_string($isiprodcopy[Mengunjungi5]);$Melewati5=mysql_real_escape_string($isiprodcopy[Melewati5]);
                $Mengunjungi6=mysql_real_escape_string($isiprodcopy[Mengunjungi6]);$Melewati6=mysql_real_escape_string($isiprodcopy[Melewati6]);
                $Mengunjungi7=mysql_real_escape_string($isiprodcopy[Mengunjungi7]);$Melewati7=mysql_real_escape_string($isiprodcopy[Melewati7]);
                $Mengunjungi8=mysql_real_escape_string($isiprodcopy[Mengunjungi8]);$Melewati8=mysql_real_escape_string($isiprodcopy[Melewati8]);
                $Shopping=mysql_real_escape_string($isiprodcopy[Shopping]);$Photostop=mysql_real_escape_string($isiprodcopy[Photostop]);
                $Shopping2=mysql_real_escape_string($isiprodcopy[Shopping2]);$Photostop2=mysql_real_escape_string($isiprodcopy[Photostop2]);
                $Shopping3=mysql_real_escape_string($isiprodcopy[Shopping3]);$Photostop3=mysql_real_escape_string($isiprodcopy[Photostop3]);
                $Shopping4=mysql_real_escape_string($isiprodcopy[Shopping4]);$Photostop4=mysql_real_escape_string($isiprodcopy[Photostop4]);
                $Shopping5=mysql_real_escape_string($isiprodcopy[Shopping5]);$Photostop5=mysql_real_escape_string($isiprodcopy[Photostop5]);
                $Shopping6=mysql_real_escape_string($isiprodcopy[Shopping6]);$Photostop6=mysql_real_escape_string($isiprodcopy[Photostop6]);
                $Shopping7=mysql_real_escape_string($isiprodcopy[Shopping7]);$Photostop7=mysql_real_escape_string($isiprodcopy[Photostop7]);
                $Shopping8=mysql_real_escape_string($isiprodcopy[Shopping8]);$Photostop8=mysql_real_escape_string($isiprodcopy[Photostop8]);

                $ItinInfo=$isiprodcopy[ItinInfo];
                $BreakfastType=$isiprodcopy[BreakfastType];
                $LunchType=$isiprodcopy[LunchType];
                $DinnerType=$isiprodcopy[DinnerType];
                $Style=$isiprodcopy[Style];
                $HotelID=$isiprodcopy[HotelID];$Hotel=$isiprodcopy[Hotel];
                mysql_query("INSERT INTO tour_msitin(ProductID,
                                                   Language,
                                                   Days,
                                                   Object01,
                                                   Object02,
                                                   Object03,
                                                   Object04,
                                                   Object05,
                                                   ObjectTrans01,
                                                   ObjectTrans02,
                                                   ObjectTrans03,
                                                   ObjectTrans04,
                                                   Mengunjungi,Mengunjungi2,Mengunjungi3,Mengunjungi4,
                                                   Mengunjungi5,Mengunjungi6,Mengunjungi7,Mengunjungi8,
                                                   Melewati,Melewati2,Melewati3,Melewati4,
                                                   Melewati5,Melewati6,Melewati7,Melewati8,
                                                   Shopping,Shopping2,Shopping3,Shopping4,
                                                   Shopping5,Shopping6,Shopping7,Shopping8,
                                                   Photostop,Photostop2,Photostop3,Photostop4,
                                                   Photostop5,Photostop6,Photostop7,Photostop8,
                                                   HotelID,Hotel,
                                                   ItinInfo,
                                                   BreakfastType,
                                                   LunchType,
                                                   DinnerType,
                                                   Style)
                                            VALUES ('$_POST[id]',
                                                   '$language',
                                                   '$Days',
                                                   '$Object01',
                                                   '$Object02',
                                                   '$Object03',
                                                   '$Object04',
                                                   '$Object05',
                                                   '$ObjectTrans01',
                                                   '$ObjectTrans02',
                                                   '$ObjectTrans03',
                                                   '$ObjectTrans04',
                                                   '$Mengunjungi','$Mengunjungi2','$Mengunjungi3','$Mengunjungi4',
                                                   '$Mengunjungi5','$Mengunjungi6','$Mengunjungi7','$Mengunjungi8',
                                                   '$Melewati','$Melewati2','$Melewati3','$Melewati4',
                                                   '$Melewati5','$Melewati6','$Melewati7','$Melewati8',
                                                   '$Shopping','$Shopping2','$Shopping3','$Shopping4',
                                                   '$Shopping5','$Shopping6','$Shopping7','$Shopping8',
                                                   '$Photostop','$Photostop2','$Photostop3','$Photostop4',
                                                   '$Photostop5','$Photostop6','$Photostop7','$Photostop8',
                                                   '$HotelID','$Hotel',
                                                   '$ItinInfo',
                                                   '$BreakfastType',
                                                   '$LunchType',
                                                   '$DinnerType',
                                                   '$Style')");
                $satu++;
            }
        }
        mysql_query("UPDATE tour_msproduct SET ProductBonus = '$isiprodetailcopy[ProductBonus]',
                                          ProductColumn = '$isiprodetailcopy[ProductColumn]',
                                          ProductTippingCurr = '$isiprodetailcopy[ProductTippingCurr]',
                                          ProductTipping = '$isiprodetailcopy[ProductTipping]',
                                          ProductDescription = '$isiprodetailcopy[ProductDescription]',
                                          TempatKumpul = '$isiprodetailcopy[TempatKumpul]',
                                          ProductTippingStatus = '$isiprodetailcopy[ProductTippingStatus]',
                                          HighlightCountry = '$isiprodetailcopy[HighlightCountry]',
                                          StyleItin = '$isiprodetailcopy[StyleItin]',
                                          CuacaItin = '$isiprodetailcopy[CuacaItin]',
                                          MapFolder = '$isiprodetailcopy[MapFolder]',
                                          MapFile = '$isiprodetailcopy[MapFile]'
                               WHERE IDProduct = '$_POST[id]'");
        $Description="Update Itinerary ID Product ($_POST[id]) from ID Product ($_POST[idcopy])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                               Description,
                               LogTime)
                        VALUES ('$EmpName',
                               '$Description',
                               '$today')");
        header("location:media.php?module=msitin&nama=$_POST[id]&type=createitin");
    }
// upload itin          
    elseif ($module=='msitin' AND $act=='upload'){
        $tmp_name = $_FILES['upload']['tmp_name'];
        $new_name = $_FILES['upload']['name'];
        $fullpath = "./itin/";
        $fullpath = str_replace("..", "", str_replace("\.", "", str_replace("//", "/", $fullpath)));
        $clean_name = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name) ) ) );
        if ((!file_exists($fullpath.$clean_name))or $new_name==''){
            // create a sub-directory if required
            if (!is_dir($fullpath)){
                mkdir("$fullpath", 0755);
            }
            //Move file from tmp dir to new location 
            move_uploaded_file($tmp_name,$fullpath . $clean_name);
            $date = date("Y-m-d G:i:s", time());
            $name =  $_FILES['upload']['name'];
            if($_POST[lang]=='INDONESIA'){
                mysql_query("UPDATE tour_msproduct set
                        Attachment = '$fullpath', 
                        AttachmentFile = '$name'
                        WHERE IDProduct = '$_POST[id]'");
            }else{
                mysql_query("INSERT INTO tour_msitinpdf (IDProduct,
                           Language,
                           Attachment,
                           AttachmentFile)
                    VALUES ('$_POST[id]',
                           '$_POST[lang]',
                           '$fullpath',
                           '$name')");
            }
            $Description="Upload Itinerary ID Product ($_POST[id])";
            mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                           Description,
                           LogTime)
                    VALUES ('$EmpName',
                           '$Description',
                           '$today')");
            header("location:media.php?module=msitin&nama=$_POST[id]&type=createitin");
        }else{
            //Print Error Message 
            $status="<small>File <strong><em> {$_FILES[upload][name]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
            echo"<center>$status <br><input type=button value=Back onclick=self.history.back()></center>";
        }

    }
// Input Information          
    elseif ($module=='msitin' AND $act=='information'){

        mysql_query("UPDATE tour_msproduct set
                        ProductInformation = '$_POST[info]'
                        WHERE IDProduct = '$_POST[id]'");

        $Description="Add/Edit Information ID Product ($_POST[id])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                               Description,
                               LogTime) 
                        VALUES ('$EmpName', 
                               '$Description', 
                               '$today')");
        header("location:media.php?module=msitin&nama=$_POST[id]&type=information");
    }
// insert TMR         
    elseif ($module=='mstmr' AND $act=='input'){

        $date = date("Y-m-d G:i:s", time());
        $hari= date("y", time());
        $tampil = mysql_query("SELECT * FROM tour_mstmrreq group by TmrNo
                ORDER BY TmrNo DESC limit 1");
        $hasil = mysql_fetch_array($tampil);
        $jumlah = mysql_num_rows($tampil);
        $tahun = substr($hasil[TmrNo],0,2);

        if($jumlah > 0){
            if($hari==$tahun){
                $tahun1 = $hari;
                $tiket=substr($hasil[TmrNo],3,4)+1;
                switch ($tiket){
                    case ($tiket<10):
                        $tiket1 = "000".$tiket;
                        break;
                    case ($tiket>9 && $tiket<100):
                        $tiket1 = "00".$tiket;
                        break;
                    case ($tiket>99 && $tiket<1000):
                        $tiket1 = "0".$tiket;
                        break;

                }
            } else if ($hari > $tahun) {
                $tahun1 = $hari;
                $tiket1="0001";
            }
        }else {
            $tahun1 = $hari;
            $tiket1="0001";
        }
        $specialrequest=strtoupper($_POST[specialrequest]);
        $company=strtoupper($_POST[company]);
        $DateTravelFrom = date('Y-m-d', strtotime($_POST['datetravelfrom']));
        $DateTravelTo = date('Y-m-d', strtotime($_POST['datetravelto']));
        $ProposalDeadline = date('Y-m-d', strtotime($_POST['proposaldeadline']));
        mysql_query("INSERT INTO tour_mstmrreq( TmrNo,
                        TmrOption,
                        Department,
                        ProductFor,    
                        Destination,
                        DateTravelFrom,
                        DateTravelTo,
                        DaysTravel,
                        Flight,
                        Seat,
                        SeatChild,
                        SeatInfant,
                        BudgetCurr,   
                        Budget,
                        LevelService,
                        HotelCategory,
                        Meals,       
                        PillowGift,   
                        TourLeaderInc,
                        Insurance,          
                        ProposalDeadline,   
                        Bidding,
                        CompanyName,
                        Pic,
                        Address,
                        Email,
                        Mobile,
                        SpecialRequest,
                        TnC,
                        Status,
                        InputBy,
                        InputDate)
                        VALUES( '$tahun1$tiket1',
                        '1',
                        '$_POST[department]', 
                        '$_POST[productfor]',   
                        '$_POST[destination]', 
                        '$DateTravelFrom',
                        '$DateTravelTo',
                        '$_POST[daystravel]',
                        '$_POST[flight]', 
                        '$_POST[seat]',
                        '$_POST[seatchild]',
                        '$_POST[seatinfant]',   
                        '$_POST[budgetcurr]',
                        '$_POST[budget]',
                        '$_POST[levelservice]',
                        '$_POST[hotelcategory]',
                        '$_POST[meals]',       
                        '$_POST[pillowgift]',    
                        '$_POST[tourleaderinc]',
                        '$_POST[insurance]',          
                        '$ProposalDeadline',
                        '$_POST[bidding]',
                        '$company',
                        '$_POST[pic]',
                        '$_POST[address]',
                        '$_POST[email]',
                        '$_POST[mobile]',         
                        '$specialrequest',
                        '$_POST[tnc]',
                        '$_POST[status]',
                        '$EmpName',
                        '$date')");

        $cuma = mysql_query("SELECT * FROM tour_mstmrreq
                        ORDER BY TmrNo DESC limit 1");
        $saja = mysql_fetch_array($cuma);
        $inqid=$saja[TmrNo];
        $comp=$_POST['competitor'];
        $lims=count($comp);
        for ($satu=0; $satu<$lims; $satu++) {
            $comp1=$comp[$satu];
            mysql_query("INSERT INTO tour_tmrcompetitor(TmrID,
                                       TmrOption,
                                       CompetitorID)
                                VALUES ('$inqid',
                                       '1',
                                       '$comp1')");
        }
        $day=$_POST[day];
        $route=$_POST[route];
        $service=$_POST[service];
        $b=$_POST['b'];
        $l=$_POST["l"];
        $d=$_POST["d"];
        $lim=count($day);
        $remarks=$_POST[remarks];
        for ($satu=0; $satu<$lim; $satu++) {
            $day1=$day[$satu];
            $route1=$route[$satu];
            $service1=$service[$satu];
            $b1=$b[$satu];
            $l1=$l[$satu];
            $d1=$d[$satu];
            $remarks1=$remarks[$satu];
            mysql_query("INSERT INTO tour_mstmritinreq(TmrID,
                                            TmrOption,
                                            Day,        
                                            Route,
                                            Service,
                                            B,
                                            L,
                                            D,
                                            Remarks) 
                                    VALUES ('$inqid',
                                            '1',
                                            '$day1',         
                                            '$route1',
                                            '$service1',
                                            '$b1',
                                            '$l1',
                                            '$d1',
                                            '$remarks1')");
        }
        $Productcode="TAILOR MADE REQUEST (TMR$inqid.1)";
        $ProductcodeDestination=$_POST[destination];
        $ProductcodeName="TMR$inqid.1";
        //$Description="Input New TMR Tourcode ($ProductcodeDestination - $ProductcodeName)";
        mysql_query("INSERT INTO tour_msproductcodereq(Productcode,ProductcodeDestination,ProductcodeName,ProductcodeStatus)
                                       VALUES('$Productcode','$ProductcodeDestination','$ProductcodeName','REQUEST')");
        $cuma = mysql_query("SELECT * FROM tour_msproductcodereq
                                    ORDER BY IDProductcode DESC limit 1");
        $saja = mysql_fetch_array($cuma);
        $sups=$_POST['country'];
        $lims=count($sups);
        for ($satu=0; $satu<$lims; $satu++) {
            $sup1=$sups[$satu];
            mysql_query("INSERT INTO tour_countrytmrreq(Country,
                                           IDTmr) 
                                    VALUES ('$sup1','$inqid')");
        }
        //mysql_query("INSERT INTO tour_msdetail(IDProduct)
        //                          VALUES ('$inqid')");
        $message .= "\n";
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
        $email= "versus_f2000@yahoo.com" ;
        $approver= $_POST['approval'];
        $dat=mysql_query("SELECT * FROM tbl_corporateemployee WHERE CorporateEmployeeID='$approver' ");
        $d=mysql_fetch_array($dat);
        $activate = md5($email) ;
        $kepada= $_POST['approval'];
        //$to = "$kepada" ;
        $to= $email ;
        $subject = "TMR Request from $_POST[productfor] ";
        // $message ="Click on this link below for response your approval \r\n";
        $headers  = "MIME-Version: 1.0 \n";
        $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
        $headers .= "From: Panorama Web System <no-reply@panoramawebsys.com> \n";
        $headers .= "Reply-To: noreply@panoramawebsys.com \r\n";
        $headers .= "Return-Path: noreply@panoramawebsys.com\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        // mail($to, $subject, $message, $headers);
        $Description="Request New TMR ($inqid-1)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module=mstmr');

    }
// insert TMR option         
    elseif ($module=='mstmr' AND $act=='inputoption'){

        $date = date("Y-m-d G:i:s", time());
        $hari= date("y", time());

        $specialrequest=strtoupper($_POST[specialrequest]);
        $tmrno = $_POST[tmrno];
        $cekah = mysql_query("SELECT * FROM tour_mstmrreq where TmrNo = '$tmrno'
                group by TmrOption ");
        $isicek = mysql_num_rows($cekah);
        $cektnc = mysql_query("SELECT * FROM tour_mstmrreq where TmrNo = '$tmrno'
                order by IDTmr DESC limit 1 ");
        $tenc=mysql_fetch_array($cektnc);
        $nooption = $isicek + 1;
        $qhist=mysql_query("SELECT * FROM tour_mstmrreq WHERE TmrNo = '$tmrno' and TmrOption ='1' ");
        $hist=mysql_fetch_array($qhist);
        mysql_query("INSERT INTO tour_mstmrreq( TmrNo,
                        TmrOption,
                        Department,
                        ProductFor,    
                        Destination, 
                        DateTravelFrom,
                        DateTravelTo,
                        DaysTravel,
                        Flight,
                        Seat,
                        SeatChild,
                        SeatInfant,
                        BudgetCurr,   
                        Budget,
                        LevelService,
                        HotelCategory,
                        Meals,       
                        PillowGift,   
                        TourLeaderInc,
                        Insurance,          
                        ProposalDeadline,   
                        Bidding,
                        CompanyName,
                        Pic,
                        Address,
                        Email,
                        Mobile,
                        SpecialRequest,
                        TnC,
                        Status,
                        InputBy,
                        InputDate)
                        VALUES( '$tmrno',
                        '$nooption',
                        '$_POST[department]', 
                        '$hist[ProductFor]',   
                        '$_POST[destination]', 
                        '$_POST[datetravelfrom]',
                        '$_POST[datetravelto]',
                        '$_POST[daystravel]',
                        '$_POST[flight]', 
                        '$_POST[seat]',
                        '$_POST[seatchild]',
                        '$_POST[seatinfant]',   
                        '$_POST[budgetcurr]',
                        '$_POST[budget]',
                        '$_POST[levelservice]',
                        '$_POST[hotelcategory]',
                        '$_POST[meals]',       
                        '$_POST[pillowgift]',    
                        '$_POST[tourleaderinc]',
                        '$_POST[insurance]',          
                        '$_POST[proposaldeadline]',
                        '$hist[Bidding]',
                        '$hist[CompanyName]',
                        '$hist[Pic]',
                        '$hist[Address]',
                        '$hist[Email]',
                        '$hist[Mobile]',         
                        '$specialrequest',
                        '$tenc[TnC]',    
                        '$_POST[status]',
                        '$EmpName',
                        '$date')");
        $inqid=$_POST[tmrno];
        $day=$_POST[day];
        $route=$_POST[route];
        $service=$_POST[service];
        $b=$_POST['b'];
        $l=$_POST["l"];
        $d=$_POST["d"];
        $lim=count($day);
        $remarks=$_POST[remarks];
        for ($satu=0; $satu<$lim; $satu++) {
            $day1=$day[$satu];
            $route1=$route[$satu];
            $service1=$service[$satu];
            $b1=$b[$satu];
            $l1=$l[$satu];
            $d1=$d[$satu];
            $remarks1=$remarks[$satu];
            mysql_query("INSERT INTO tour_mstmritinreq(TmrID,
                                            TmrOption,
                                            Day,        
                                            RouteCountry,
                                            Service,
                                            B,
                                            L,
                                            D,
                                            Remarks) 
                                    VALUES ('$inqid',
                                            '$nooption',
                                            '$day1',         
                                            '$route1',
                                            '$service1',
                                            '$b1',
                                            '$l1',
                                            '$d1',
                                            '$remarks1')");
        }
        $Productcode="TAILOR MADE REQUEST (TMR$inqid.$nooption)";
        $ProductcodeDestination=$_POST[destination];
        $ProductcodeName="TMR$inqid.$nooption";
        //$Description="Input New TMR Tourcode ($ProductcodeDestination - $ProductcodeName)";
        mysql_query("INSERT INTO tour_msproductcodereq(Productcode,ProductcodeDestination,ProductcodeName,ProductcodeStatus)
                                       VALUES('$Productcode','$ProductcodeDestination','$ProductcodeName','REQUEST')");
        $cuma = mysql_query("SELECT * FROM tour_msproductcodereq
                                    ORDER BY IDProductcode DESC limit 1");
        $saja = mysql_fetch_array($cuma);
        $sups=$_POST['country'];
        $lims=count($sups);
        for ($satu=0; $satu<$lims; $satu++) {
            $sup1=$sups[$satu];
            mysql_query("INSERT INTO tour_countrytmrreq(Country,
                                           IDTmr) 
                                    VALUES ('$sup1','$inqid')");
        }
        //mysql_query("INSERT INTO tour_msdetail(IDProduct)
        //                          VALUES ('$inqid')");
        $message .= "\n";
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
                            <p style="font-size: 13px; line-height: 237%">Terima Kasih untuk memilih Travelicious sebagai partner berpetualang Anda.</p>
                            <p style="font-size: 13px; line-height: 237%">Pesanan Anda sudah kami terima dengan <strong>Order ID '.$idlast.'</strong></p>
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
        $email= "versus_f2000@yahoo.com" ;
        $approver= $_POST['approval'];
        $dat=mysql_query("SELECT * FROM tbl_corporateemployee WHERE CorporateEmployeeID='$approver' ");
        $d=mysql_fetch_array($dat);
        $activate = md5($email) ;
        $kepada= $_POST['approval'];
        //$to = "$kepada" ;
        $to= $email ;
        $subject = "TMR Request from $_POST[productfor] ";
        // $message ="Click on this link below for response your approval \r\n";
        $headers  = "MIME-Version: 1.0 \n";
        $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
        $headers .= "From: LTM DIVISION <no-reply@panorama-tours.com> \n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        // mail($to, $subject, $message, $headers);
        $Description="Request New TMR ($inqid-$nooption)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module=mstmr');

    }
// mstmr upload file itin
    elseif ($module=='mstmr' AND $act=='upload'){
        $no=$_POST['no'];
        $tmp_name = $_FILES['upload']['tmp_name'];
        $new_name = $_FILES['upload']['name'];
        $fullpath = "./itin/";
        $fullpath = str_replace("..", "", str_replace("\.", "", str_replace("//", "/", $fullpath)));
        $clean_name = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name) ) ) );
        if ((!file_exists($fullpath.$clean_name))or $new_name==''){
            // create a sub-directory if required
            if (!is_dir($fullpath)){
                mkdir("$fullpath", 0755);
            }
            //Move file from tmp dir to new location
            move_uploaded_file($tmp_name,$fullpath . $clean_name);
            $date = date("Y-m-d G:i:s", time());
            $name =  $_FILES['upload']['name'];
            mysql_query("UPDATE tour_mstmr set Attachment = '$fullpath',
                                            AttachmentFile = '$name'
                                        WHERE TmrNo = '$no'");
            $Description="Edit Product ($tourcode)";
            mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                       Description,
                       LogTime) 
                VALUES ('$EmpName', 
                       '$Description', 
                       '$today')");
            header("location:media.php?module=mstmr&act=showtmr&no=$no");
        }
        else{
            //Print Error Message
            $status="<small>File <strong><em> {$_FILES[upload][name]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
            echo"<center>$status <br><input type=button value=Back onclick=self.history.back()></center>";
        }
    }
// insert FINAL DOCUMENT
    elseif ($module=='upload' AND $act=='final'){
        $idp=$_POST[idp];
        $fullpath = "./upload/final/$idp/";
        $fullpath = str_replace("..", "", str_replace("\.", "", str_replace("//", "/", $fullpath)));
        mysql_query("UPDATE tour_msproduct SET FinalAttach = '$fullpath' WHERE IDProduct = '$idp'");

        //Final Itin
        $tmp_name = $_FILES['finalitin']['tmp_name'];
        $new_name = $_FILES['finalitin']['name'];
        $clean_name = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name) ) ) );
        if($new_name==''){
            $name =  $_POST[finalitin];
            mysql_query("UPDATE tour_msproduct SET FinalItin = '$name' WHERE IDProduct = '$idp'");
        }else{
            $itininfo="$EmpName $today";
            if ((!file_exists($fullpath.$clean_name))){
                // create a sub-directory if required
                if (!is_dir($fullpath)){
                    mkdir("$fullpath", 0755);
                }
                //Move file from tmp dir to new location
                move_uploaded_file($tmp_name,$fullpath . $clean_name);
                $name =  $_FILES['finalitin']['name'];
                mysql_query("UPDATE tour_msproduct SET FinalItin = '$name',FinalItinInfo='$itininfo' WHERE IDProduct = '$idp'");
            }else{
                //Print Error Message
                $status="<small>File <strong><em> {$_FILES[finalitin][name]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
                echo"<center>$status <br><input type=button value=Back onclick=self.history.back()></center>";
            }
        }
        //Final Hotel
        $tmp_name2 = $_FILES['finalhotel']['tmp_name'];
        $new_name2 = $_FILES['finalhotel']['name'];
        $clean_name2 = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name2) ) ) );
        if($new_name2==''){
            $name2 =  $_POST[finalhotel];
            mysql_query("UPDATE tour_msproduct SET FinalHotel = '$name2' WHERE IDProduct = '$idp'");
        }else{
            $hotelinfo="$EmpName $today";
            if ((!file_exists($fullpath.$clean_name2))){
                // create a sub-directory if required
                if (!is_dir($fullpath)){
                    mkdir("$fullpath", 0755);
                }
                //Move file from tmp dir to new location
                move_uploaded_file($tmp_name2,$fullpath . $clean_name2);
                $name2 =  $_FILES['finalhotel']['name'];
                mysql_query("UPDATE tour_msproduct SET FinalHotel = '$name2',FinalHotelInfo='$hotelinfo' WHERE IDProduct = '$idp'");
            }else{
                //Print Error Message
                $status2="<small>File <strong><em> {$_FILES[finalhotel][name2]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
                echo"<center>$status2 <br><input type=button value=Back onclick=self.history.back()></center>";
            }
        }
        //Final Halper
        $tmp_name3 = $_FILES['finalhalper']['tmp_name'];
        $new_name3 = $_FILES['finalhalper']['name'];
        $clean_name3 = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name3) ) ) );
        if($new_name3==''){
            $name3 =  $_POST[finalhalper];
            mysql_query("UPDATE tour_msproduct SET FinalHalper = '$name3' WHERE IDProduct = '$idp'");
        }else{
            $halperinfo="$EmpName $today";
            if ((!file_exists($fullpath.$clean_name3))){
                // create a sub-directory if required
                if (!is_dir($fullpath)){
                    mkdir("$fullpath", 0755);
                }
                //Move file from tmp dir to new location
                move_uploaded_file($tmp_name3,$fullpath . $clean_name3);
                $name3 =  $_FILES['finalhalper']['name'];
                mysql_query("UPDATE tour_msproduct SET FinalHalper = '$name3',FinalHalperInfo='$halperinfo' WHERE IDProduct = '$idp'");
            }else{
                //Print Error Message
                $status3="<small>File <strong><em> {$_FILES[finalhalper][name3]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
                echo"<center>$status3 <br><input type=button value=Back onclick=self.history.back()></center>";
            }
        }
        //Final Option
        $tmp_name4 = $_FILES['finaloption']['tmp_name'];
        $new_name4 = $_FILES['finaloption']['name'];
        $clean_name4 = preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($new_name4) ) ) );
        if($new_name4==''){
            $name4 =  $_POST[finaloption];
            mysql_query("UPDATE tour_msproduct SET FinalOption = '$name4' WHERE IDProduct = '$idp'");
        }else{
            $optioninfo="$EmpName $today";
            if ((!file_exists($fullpath.$clean_name4))){
                // create a sub-directory if required
                if (!is_dir($fullpath)){
                    mkdir("$fullpath", 0755);
                }
                //Move file from tmp dir to new location
                move_uploaded_file($tmp_name4,$fullpath . $clean_name4);
                $name4 =  $_FILES['finaloption']['name'];
                mysql_query("UPDATE tour_msproduct SET FinalOption = '$name4',FinalOptionInfo='$optioninfo' WHERE IDProduct = '$idp'");
            }else{
                //Print Error Message
                $status4="<small>File <strong><em> {$_FILES[finaloption][name4]} </em></strong> Was Not Uploaded - bad file type or file already exists</small><br />";
                echo"<center>$status4 <br><input type=button value=Back onclick=self.history.back()></center>";
            }
        }

        $Description="UPDATE FINAL DOCUMENT (ID: $idp)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                       Description,
                       LogTime)
                VALUES ('$EmpName',
                       '$Description',
                       '$today')");

        header("location:media.php?module=upfinal&id=$idp");

    }
// Input variable ada di variable.php
    elseif ($module=='variable' AND $act=='input'){
        $modul="msproduct&act=quotation&id=$_POST[id]";
        $Desc=strtoupper($_POST[description]);
        $amount=$_POST[amount];
        $pax=$_POST[pax];
        $hasil=($amount/$pax);
        $Description="Input New Variable ($SeasonName)";
        mysql_query("INSERT INTO tour_detail(IDProduct,Category,Supplier,Description,Amount,Pax,Adult,ChdTwn,ChdNbed,ChdXbed,Single,Infant)
                                       VALUES('$_POST[id]','VARIABLE','$_POST[supplier]','$Desc','$amount','$pax','$hasil','$hasil','$hasil','$hasil','$hasil','0')");
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$modul);
    }
// Input FIX n Cost ada di quotation.php
    elseif ($module=='fix' AND $act=='input'){

        $Desc=strtoupper($_POST[description]);
        $pax=$_POST[pax];
        $Description="Update Fix Cost ($SeasonName)";
        //for($i=1;$i<11;$i++){
        /*$supplier='supplier1';
        $desc = 'description1';
        $quoadult = 'quoadult1';
        $selladult = 'selladult1';
        $quochd = 'quochd1';
        $sellchd = 'sellchd1'; */
        mysql_query("UPDATE tour_detail set Supplier = '$_POST[supplier1]',
                                        Description = '$_POST[desc1]',
                                        QuoAdult = '$_POST[quoadult1]',
                                        SellAdult = '$_POST[selladult1]',
                                        QuoChd = '$_POST[quochd1]',
                                        SellChd = '$_POST[sellchd1]'
                                        WHERE Detail = 'FIX1' AND IDProduct = '$_POST[id]'");
        //}
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        //header('Refresh: 2; location:media.php?module='.$modul);
        //header('location:media.php?module='.$modul);
    }
// update quotation
    elseif ($module=='msproduct' AND $act=='quotation'){
        $tourcode=strtoupper($_POST[tourcode]); 
        mysql_query("UPDATE tour_msdetail set ComAdultA = '$_POST[comaa]',
                                               ComChdtwnA = '$_POST[comca]',
                                               ComChdXbedA = '$_POST[comcxa]',
                                               ComChdNbedA = '$_POST[comcna]',
                                               ComAdultB = '$_POST[comab]',
                                               ComChdTwnB = '$_POST[comcb]',
                                               ComChdXbedB = '$_POST[comcxb]',
                                               ComChdNbedB = '$_POST[comcnb]',  
                                               ComAdultC = '$_POST[comac]',
                                               ComChdTwnC = '$_POST[comcc]',
                                               ComChdXbedC = '$_POST[comcxc]',
                                               ComChdNbedC = '$_POST[comcnc]',
                                               Persen = '$_POST[persen]',
                                               ProfAdultA = '$_POST[paa]',
                                               ProfChdtwnA = '$_POST[pca]',
                                               ProfChdXbedA = '$_POST[pcxa]',
                                               ProfChdNbedA = '$_POST[pcna]',
                                               ProfAdultB = '$_POST[pab]',
                                               ProfChdTwnB = '$_POST[pcb]',
                                               ProfChdXbedB = '$_POST[pcxb]',
                                               ProfChdNbedB = '$_POST[pcnb]',  
                                               ProfAdultC = '$_POST[pac]',
                                               ProfChdTwnC = '$_POST[pcc]',
                                               ProfChdXbedC = '$_POST[pcxc]',
                                               ProfChdNbedC = '$_POST[pcnc]',
                                               DiscAdultA = '$_POST[discaa]',
                                               DiscChdtwnA = '$_POST[discca]',
                                               DiscChdXbedA = '$_POST[disccxa]',
                                               DiscChdNbedA = '$_POST[disccna]',
                                               DiscAdultB = '$_POST[discab]',
                                               DiscChdTwnB = '$_POST[disccb]',
                                               DiscChdXbedB = '$_POST[disccxb]',
                                               DiscChdNbedB = '$_POST[disccnb]',  
                                               DiscAdultC = '$_POST[discac]',
                                               DiscChdTwnC = '$_POST[disccc]',
                                               DiscChdXbedC = '$_POST[disccxc]',
                                               DiscChdNbedC = '$_POST[disccnc]'
                    WHERE IDProduct = '$_POST[id]'");
        $qproduct=mysql_query("SELECT * FROM tour_msproduct WHERE ProductID = '$_POST[id]'");
        $Dproduct=mysql_num_rows($qproduct);
        if($Dproduct[$QuotationStatus]==''){$statuslama='REQUEST';}else{$statuslama=$Dproduct[$QuotationStatus];}
        if($_POST[quostatus]==''){$QuotationStatus=$statuslama;}else{$QuotationStatus=$_POST[quostatus];}
        if($_POST[visanett]==''){$visanett='0';}else{$visanett=$_POST[visanett];}if($_POST[visasell]==''){$visasell='0';}else{$visasell=$_POST[visasell];}
        if($_POST[visanett2]==''){$visanett2='0';}else{$visanett2=$_POST[visanett2];}if($_POST[visasell2]==''){$visasell2='0';}else{$visasell2=$_POST[visasell2];}
        if($_POST[visanett3]==''){$visanett3='0';}else{$visanett3=$_POST[visanett3];}if($_POST[visasell3]==''){$visasell3='0';}else{$visasell3=$_POST[visasell3];}
        if($_POST[visanett4]==''){$visanett4='0';}else{$visanett4=$_POST[visanett4];}if($_POST[visasell4]==''){$visasell4='0';}else{$visasell4=$_POST[visasell4];}
        if($_POST[visanett5]==''){$visanett5='0';}else{$visanett5=$_POST[visanett5];}if($_POST[visasell5]==''){$visasell5='0';}else{$visasell5=$_POST[visasell5];}
        mysql_query("UPDATE tour_msproduct set SellingAdlTwn = '$_POST[rsadult]',
                                               SellingChdTwn = '$_POST[rschdtwn]',
                                               SellingChdNbed = '$_POST[rschdnbed]',
                                               SellingChdXbed = '$_POST[rschdxbed]',
                                               SellingInfant = '$_POST[rsinfant]',
                                               LAAdlTwn = '$_POST[laadltwn]',
                                               LAChdTwn = '$_POST[lachdtwn]',
                                               LAChdNbed = '$_POST[lachdnbed]',
                                               LAChdXbed = '$_POST[lachdxbed]',
                                               LAInfant = '$_POST[lainfant]',
                                               CruiseAdl12 = '$_POST[cadl12]',
                                               CruiseAdl34 = '$_POST[cadl34]',
                                               CruiseChd12 = '$_POST[cchd12]',
                                               CruiseChd34 = '$_POST[cchd34]',
                                               CruiseLoAdl12 = '$_POST[cladl12]',
                                               CruiseLoAdl34 = '$_POST[cladl34]',
                                               CruiseLoChd12 = '$_POST[clchd12]',
                                               CruiseLoChd34 = '$_POST[clchd34]',
                                               TaxInsCurr = '$_POST[taxinscurr]',
                                               TaxInsRate = '$_POST[taxinsrate]',
                                               TaxInsNett = '$_POST[taxinsnett]',
                                               TaxInsNettIDR = '$_POST[taxinsnettidr]',
                                               TaxInsSell = '$_POST[taxinssell]',
                                               LandArrNett = '$_POST[landarrnett]',
                                               LandArrSell = '$_POST[landarrsell]',
                                               SingleCurr = '$_POST[singlecurr]',
                                               SingleRate = '$_POST[singlerate]',
                                               SingleNett = '$_POST[singlenett]',
                                               SingleNettIDR = '$_POST[singlenettidr]',
                                               SingleSell = '$_POST[singlesell]', 
                                               VisaCurr = 'IDR',
                                               VisaNett = '$visanett',
                                               VisaSell = '$visasell',
                                               DoaId01 = '$_POST[visaemb01]',
                                               VisaNett2 = '$visanett2',
                                               VisaSell2 = '$visasell2',
                                               DoaId02 = '$_POST[visaemb02]',
                                               VisaNett3 = '$visanett3',
                                               VisaSell3 = '$visasell3',
                                               DoaId03 = '$_POST[visaemb03]',
                                               VisaNett4 = '$visanett4',
                                               VisaSell4 = '$visasell4',
                                               DoaId04 = '$_POST[visaemb04]',
                                               VisaNett5 = '$visanett5',
                                               VisaSell5 = '$visasell5',
                                               DoaId05 = '$_POST[visaemb05]',
                                               AirTaxCurr = 'IDR',
                                               AirTaxNett = '$_POST[airtaxnett]',
                                               AirTaxSell = '$_POST[airtaxsell]', 
                                               SeaTaxNett = '$_POST[seataxnett]',
                                               SeaTaxSell = '$_POST[seataxsell]',
                                               QuotationStatus = '$QuotationStatus'
                    WHERE IDProduct = '$_POST[id]'");
        $qprice=mysql_query("SELECT * FROM tour_msproductprice WHERE ProductID = '$_POST[id]'");
        $price=mysql_num_rows($qprice);
        if($price>0){
            mysql_query("UPDATE tour_msproductprice set SellingAdlTwn = '$_POST[rsadult]',
                                               SellingChdTwn = '$_POST[rschdtwn]',
                                               SellingChdNbed = '$_POST[rschdnbed]',
                                               SellingChdXbed = '$_POST[rschdxbed]',
                                               SellingInfant = '$_POST[rsinfant]',
                                               LAAdlTwn = '$_POST[laadltwn]',
                                               LAChdTwn = '$_POST[lachdtwn]',
                                               LAChdNbed = '$_POST[lachdnbed]',
                                               LAChdXbed = '$_POST[lachdxbed]',
                                               LAInfant = '$_POST[lainfant]',
                                               CruiseAdl12 = '$_POST[cadl12]',
                                               CruiseAdl34 = '$_POST[cadl34]',
                                               CruiseChd12 = '$_POST[cchd12]',
                                               CruiseChd34 = '$_POST[cchd34]',
                                               CruiseLoAdl12 = '$_POST[cladl12]',
                                               CruiseLoAdl34 = '$_POST[cladl34]',
                                               CruiseLoChd12 = '$_POST[clchd12]',
                                               CruiseLoChd34 = '$_POST[clchd34]'
                    WHERE ProductID = '$_POST[id]' AND PriceFor = 'GENERAL'");
            mysql_query("UPDATE tour_msproductprice set SellingAdlTwn = '$_POST[rsadultin]',
                                               SellingChdTwn = '$_POST[rschdtwnin]',
                                               SellingChdNbed = '$_POST[rschdnbedin]',
                                               SellingChdXbed = '$_POST[rschdxbedin]',
                                               SellingInfant = '$_POST[rsinfantin]',
                                               LAAdlTwn = '$_POST[laadltwnin]',
                                               LAChdTwn = '$_POST[lachdtwnin]',
                                               LAChdNbed = '$_POST[lachdnbedin]',
                                               LAChdXbed = '$_POST[lachdxbedin]',
                                               LAInfant = '$_POST[lainfantin]',
                                               CruiseAdl12 = '$_POST[cadl12in]',
                                               CruiseAdl34 = '$_POST[cadl34in]',
                                               CruiseChd12 = '$_POST[cchd12in]',
                                               CruiseChd34 = '$_POST[cchd34in]',
                                               CruiseLoAdl12 = '$_POST[cladl12in]',
                                               CruiseLoAdl34 = '$_POST[cladl34in]',
                                               CruiseLoChd12 = '$_POST[clchd12in]',
                                               CruiseLoChd34 = '$_POST[clchd34in]'
                    WHERE ProductID = '$_POST[id]' AND PriceFor = 'INTERNAL'");
            mysql_query("UPDATE tour_msproductprice set SellingAdlTwn = '$_POST[rsadultpw]',
                                               SellingChdTwn = '$_POST[rschdtwnpw]',
                                               SellingChdNbed = '$_POST[rschdnbedpw]',
                                               SellingChdXbed = '$_POST[rschdxbedpw]',
                                               SellingInfant = '$_POST[rsinfantpw]',
                                               LAAdlTwn = '$_POST[laadltwnpw]',
                                               LAChdTwn = '$_POST[lachdtwnpw]',
                                               LAChdNbed = '$_POST[lachdnbedpw]',
                                               LAChdXbed = '$_POST[lachdxbedpw]',
                                               LAInfant = '$_POST[lainfantpw]',
                                               CruiseAdl12 = '$_POST[cadl12pw]',
                                               CruiseAdl34 = '$_POST[cadl34pw]',
                                               CruiseChd12 = '$_POST[cchd12pw]',
                                               CruiseChd34 = '$_POST[cchd34pw]',
                                               CruiseLoAdl12 = '$_POST[cladl12pw]',
                                               CruiseLoAdl34 = '$_POST[cladl34pw]',
                                               CruiseLoChd12 = '$_POST[clchd12pw]',
                                               CruiseLoChd34 = '$_POST[clchd34pw]'
                    WHERE ProductID = '$_POST[id]' AND PriceFor = 'PANORAMA WORLD'");
            mysql_query("UPDATE tour_msproductprice set SellingAdlTwn = '$_POST[rsadultsc]',
                                               SellingChdTwn = '$_POST[rschdtwnsc]',
                                               SellingChdNbed = '$_POST[rschdnbedsc]',
                                               SellingChdXbed = '$_POST[rschdxbedsc]',
                                               SellingInfant = '$_POST[rsinfantsc]',
                                               LAAdlTwn = '$_POST[laadltwnsc]',
                                               LAChdTwn = '$_POST[lachdtwnsc]',
                                               LAChdNbed = '$_POST[lachdnbedsc]',
                                               LAChdXbed = '$_POST[lachdxbedsc]',
                                               LAInfant = '$_POST[lainfantsc]',
                                               CruiseAdl12 = '$_POST[cadl12sc]',
                                               CruiseAdl34 = '$_POST[cadl34sc]',
                                               CruiseChd12 = '$_POST[cchd12sc]',
                                               CruiseChd34 = '$_POST[cchd34sc]',
                                               CruiseLoAdl12 = '$_POST[cladl12sc]',
                                               CruiseLoAdl34 = '$_POST[cladl34sc]',
                                               CruiseLoChd12 = '$_POST[clchd12sc]',
                                               CruiseLoChd34 = '$_POST[clchd34sc]'
                    WHERE ProductID = '$_POST[id]' AND PriceFor = 'SISTER COMPANY'");
            mysql_query("UPDATE tour_msproductprice set SellingAdlTwn = '$_POST[rsadultsa]',
                                               SellingChdTwn = '$_POST[rschdtwnsa]',
                                               SellingChdNbed = '$_POST[rschdnbedsa]',
                                               SellingChdXbed = '$_POST[rschdxbedsa]',
                                               SellingInfant = '$_POST[rsinfantsa]',
                                               LAAdlTwn = '$_POST[laadltwnsa]',
                                               LAChdTwn = '$_POST[lachdtwnsa]',
                                               LAChdNbed = '$_POST[lachdnbedsa]',
                                               LAChdXbed = '$_POST[lachdxbedsa]',
                                               LAInfant = '$_POST[lainfantsa]',
                                               CruiseAdl12 = '$_POST[cadl12sa]',
                                               CruiseAdl34 = '$_POST[cadl34sa]',
                                               CruiseChd12 = '$_POST[cchd12sa]',
                                               CruiseChd34 = '$_POST[cchd34sa]',
                                               CruiseLoAdl12 = '$_POST[cladl12sa]',
                                               CruiseLoAdl34 = '$_POST[cladl34sa]',
                                               CruiseLoChd12 = '$_POST[clchd12sa]',
                                               CruiseLoChd34 = '$_POST[clchd34sa]'
                    WHERE ProductID = '$_POST[id]' AND PriceFor = 'SUB AGENT'");
        }else{
            mysql_query("INSERT into tour_msproductprice (ProductID,
                                               SellingAdlTwn,
                                               SellingChdTwn,
                                               SellingChdNbed,
                                               SellingChdXbed,
                                               SellingInfant,
                                               LAAdlTwn,
                                               LAChdTwn,
                                               LAChdNbed,
                                               LAChdXbed,
                                               LAInfant,
                                               CruiseAdl12,
                                               CruiseAdl34,
                                               CruiseChd12,
                                               CruiseChd34,
                                               CruiseLoAdl12,
                                               CruiseLoAdl34,
                                               CruiseLoChd12,
                                               CruiseLoChd34,
                                               PriceFor)
                                        VALUES( '$_POST[id]',
                                                '$_POST[rsadult]',
                                                '$_POST[rschdtwn]',
                                                '$_POST[rschdnbed]',
                                                '$_POST[rschdxbed]',
                                                '$_POST[rsinfant]',
                                                '$_POST[laadltwn]',
                                                '$_POST[lachdtwn]',
                                                '$_POST[lachdnbed]',
                                                '$_POST[lachdxbed]',
                                                '$_POST[lainfant]',
                                                '$_POST[cadl12]',
                                                '$_POST[cadl34]',
                                                '$_POST[cchd12]',
                                                '$_POST[cchd34]',
                                                '$_POST[cladl12]',
                                                '$_POST[cladl34]',
                                                '$_POST[clchd12]',
                                                '$_POST[clchd34]',
                                                'GENERAL')");
            mysql_query("INSERT into tour_msproductprice (ProductID,
                                               SellingAdlTwn,
                                               SellingChdTwn,
                                               SellingChdNbed,
                                               SellingChdXbed,
                                               SellingInfant,
                                               LAAdlTwn,
                                               LAChdTwn,
                                               LAChdNbed,
                                               LAChdXbed,
                                               LAInfant,
                                               CruiseAdl12,
                                               CruiseAdl34,
                                               CruiseChd12,
                                               CruiseChd34,
                                               CruiseLoAdl12,
                                               CruiseLoAdl34,
                                               CruiseLoChd12,
                                               CruiseLoChd34,
                                               PriceFor)
                                        VALUES( '$_POST[id]',
                                                '$_POST[rsadultin]',
                                                '$_POST[rschdtwnin]',
                                                '$_POST[rschdnbedin]',
                                                '$_POST[rschdxbedin]',
                                                '$_POST[rsinfantin]',
                                                '$_POST[laadltwnin]',
                                                '$_POST[lachdtwnin]',
                                                '$_POST[lachdnbedin]',
                                                '$_POST[lachdxbedin]',
                                                '$_POST[lainfantin]',
                                                '$_POST[cadl12in]',
                                                '$_POST[cadl34in]',
                                                '$_POST[cchd12in]',
                                                '$_POST[cchd34in]',
                                                '$_POST[cladl12in]',
                                                '$_POST[cladl34in]',
                                                '$_POST[clchd12in]',
                                                '$_POST[clchd34in]',
                                                'INTERNAL')");
            mysql_query("INSERT into tour_msproductprice (ProductID,
                                               SellingAdlTwn,
                                               SellingChdTwn,
                                               SellingChdNbed,
                                               SellingChdXbed,
                                               SellingInfant,
                                               LAAdlTwn,
                                               LAChdTwn,
                                               LAChdNbed,
                                               LAChdXbed,
                                               LAInfant,
                                               CruiseAdl12,
                                               CruiseAdl34,
                                               CruiseChd12,
                                               CruiseChd34,
                                               CruiseLoAdl12,
                                               CruiseLoAdl34,
                                               CruiseLoChd12,
                                               CruiseLoChd34,
                                               PriceFor)
                                        VALUES( '$_POST[id]',
                                                '$_POST[rsadultpw]',
                                                '$_POST[rschdtwnpw]',
                                                '$_POST[rschdnbedpw]',
                                                '$_POST[rschdxbedpw]',
                                                '$_POST[rsinfantpw]',
                                                '$_POST[laadltwnpw]',
                                                '$_POST[lachdtwnpw]',
                                                '$_POST[lachdnbedpw]',
                                                '$_POST[lachdxbedpw]',
                                                '$_POST[lainfantpw]',
                                                '$_POST[cadl12pw]',
                                                '$_POST[cadl34pw]',
                                                '$_POST[cchd12pw]',
                                                '$_POST[cchd34pw]',
                                                '$_POST[cladl12pw]',
                                                '$_POST[cladl34pw]',
                                                '$_POST[clchd12pw]',
                                                '$_POST[clchd34pw]',
                                                'PANORAMA WORLD')");
            mysql_query("INSERT into tour_msproductprice (ProductID,
                                               SellingAdlTwn,
                                               SellingChdTwn,
                                               SellingChdNbed,
                                               SellingChdXbed,
                                               SellingInfant,
                                               LAAdlTwn,
                                               LAChdTwn,
                                               LAChdNbed,
                                               LAChdXbed,
                                               LAInfant,
                                               CruiseAdl12,
                                               CruiseAdl34,
                                               CruiseChd12,
                                               CruiseChd34,
                                               CruiseLoAdl12,
                                               CruiseLoAdl34,
                                               CruiseLoChd12,
                                               CruiseLoChd34,
                                               PriceFor)
                                        VALUES( '$_POST[id]',
                                                '$_POST[rsadultsc]',
                                                '$_POST[rschdtwnsc]',
                                                '$_POST[rschdnbedsc]',
                                                '$_POST[rschdxbedsc]',
                                                '$_POST[rsinfantsc]',
                                                '$_POST[laadltwnsc]',
                                                '$_POST[lachdtwnsc]',
                                                '$_POST[lachdnbedsc]',
                                                '$_POST[lachdxbedsc]',
                                                '$_POST[lainfantsc]',
                                                '$_POST[cadl12sc]',
                                                '$_POST[cadl34sc]',
                                                '$_POST[cchd12sc]',
                                                '$_POST[cchd34sc]',
                                                '$_POST[cladl12sc]',
                                                '$_POST[cladl34sc]',
                                                '$_POST[clchd12sc]',
                                                '$_POST[clchd34sc]',
                                                'SISTER COMPANY')");
            mysql_query("INSERT into tour_msproductprice (ProductID,
                                               SellingAdlTwn,
                                               SellingChdTwn,
                                               SellingChdNbed,
                                               SellingChdXbed,
                                               SellingInfant,
                                               LAAdlTwn,
                                               LAChdTwn,
                                               LAChdNbed,
                                               LAChdXbed,
                                               LAInfant,
                                               CruiseAdl12,
                                               CruiseAdl34,
                                               CruiseChd12,
                                               CruiseChd34,
                                               CruiseLoAdl12,
                                               CruiseLoAdl34,
                                               CruiseLoChd12,
                                               CruiseLoChd34,
                                               PriceFor)
                                        VALUES( '$_POST[id]',
                                                '$_POST[rsadultsa]',
                                                '$_POST[rschdtwnsa]',
                                                '$_POST[rschdnbedsa]',
                                                '$_POST[rschdxbedsa]',
                                                '$_POST[rsinfantsa]',
                                                '$_POST[laadltwnsa]',
                                                '$_POST[lachdtwnsa]',
                                                '$_POST[lachdnbedsa]',
                                                '$_POST[lachdxbedsa]',
                                                '$_POST[lainfantsa]',
                                                '$_POST[cadl12sa]',
                                                '$_POST[cadl34sa]',
                                                '$_POST[cchd12sa]',
                                                '$_POST[cchd34sa]',
                                                '$_POST[cladl12sa]',
                                                '$_POST[cladl34sa]',
                                                '$_POST[clchd12sa]',
                                                '$_POST[clchd34sa]',
                                                'SUB AGENT')");
        }
        $Description="Input Quotation selling price ($tourcode)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                               Description,
                               TourAdult,
                               TourChdTwn,
                               TourChdNbed,
                               TourChdXbed,
                               TourInfant,
                               LAAdult,
                               LAChdTwn,
                               LAChdNbed,
                               LAChdXbed,
                               LAInfant,
                               LogTime) 
                        VALUES ('$EmpName', 
                                '$Description',
                                '$_POST[rsadult]',
                                '$_POST[rschdtwn]',
                                '$_POST[rschdnbed]',
                                '$_POST[rschdxbed]',
                                '$_POST[rsinfant]',
                                '$_POST[laadltwn]',
                                '$_POST[lachdtwn]',
                                '$_POST[lachdnbed]',
                                '$_POST[lachdxbed]',
                                '$_POST[lainfant]',
                                '$today')");
        header('location:media.php?module=msproduct');
    }
// update status quotation
    elseif ($module=='showquotation' AND $act=='update'){

        mysql_query("UPDATE tour_msproduct set QuotationStatus = '$_POST[quostatus]'
                WHERE IDProduct = '$_POST[id]'");
        if($_POST[quostatus]=='APPROVE'){
            mysql_query("UPDATE tour_msproduct set Status='PUBLISH',StatusProduct='OPEN'
                WHERE IDProduct = '$_POST[id]'");
        }else if($_POST[quostatus]=='DRAFT'){
            mysql_query("UPDATE tour_msproduct set Status='NOT PUBLISHED',StatusProduct='CLOSE'
                WHERE IDProduct = '$_POST[id]'");
        }
        $Description="Update Status Quotation ID ($_POST[id])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                           Description,
                           LogTime)
                    VALUES ('$EmpName',
                           '$Description',
                           '$today')");
        header("location:media.php?module=msproduct&act=appmsproduct");
    }
// update quotation TMR
    elseif ($module=='msproduct' AND $act=='quotationtmr'){
        $tourcode=strtoupper($_POST[tourcode]);
        mysql_query("UPDATE tour_msdetailreq set ComAdultA = '$_POST[comaa]',
                                               ComChdtwnA = '$_POST[comca]',
                                               ComChdXbedA = '$_POST[comcxa]',
                                               ComChdNbedA = '$_POST[comcna]',
                                               ComAdultB = '$_POST[comab]',
                                               ComChdTwnB = '$_POST[comcb]',
                                               ComChdXbedB = '$_POST[comcxb]',
                                               ComChdNbedB = '$_POST[comcnb]',  
                                               ComAdultC = '$_POST[comac]',
                                               ComChdTwnC = '$_POST[comcc]',
                                               ComChdXbedC = '$_POST[comcxc]',
                                               ComChdNbedC = '$_POST[comcnc]',
                                               Persen = '$_POST[persen]',
                                               DiscAdultA = '$_POST[discaa]',
                                               DiscChdtwnA = '$_POST[discca]',
                                               DiscChdXbedA = '$_POST[disccxa]',
                                               DiscChdNbedA = '$_POST[disccna]',
                                               DiscAdultB = '$_POST[discab]',
                                               DiscChdTwnB = '$_POST[disccb]',
                                               DiscChdXbedB = '$_POST[disccxb]',
                                               DiscChdNbedB = '$_POST[disccnb]',  
                                               DiscAdultC = '$_POST[discac]',
                                               DiscChdTwnC = '$_POST[disccc]',
                                               DiscChdXbedC = '$_POST[disccxc]',
                                               DiscChdNbedC = '$_POST[disccnc]'
                    WHERE IDProduct = '$_POST[id]'");
        mysql_query("UPDATE tour_msproductreq set Flight = '$_POST[airlines]',
                                               TourCode = '$_POST[tourcode]', 
                                               SellingAdlTwn = '$_POST[rsadult]',
                                               SellingChdTwn = '$_POST[rschdtwn]',
                                               SellingChdNbed = '$_POST[rschdnbed]',
                                               SellingChdXbed = '$_POST[rschdxbed]',
                                               SellingInfant = '$_POST[rsinfant]',
                                               LAAdlTwn = '$_POST[laadltwn]',
                                               LAChdTwn = '$_POST[lachdtwn]',
                                               LAChdNbed = '$_POST[lachdnbed]',
                                               LAChdXbed = '$_POST[lachdxbed]',
                                               LAInfant = '$_POST[lainfant]',
                                               SellingAdlTwnB = '$_POST[rsadultb]',
                                               SellingChdTwnB = '$_POST[rschdtwnb]',
                                               SellingChdNbedB = '$_POST[rschdnbedb]',
                                               SellingChdXbedB = '$_POST[rschdxbedb]',
                                               SellingInfantB = '$_POST[rsinfantb]',
                                               LAAdlTwnB = '$_POST[laadltwnb]',
                                               LAChdTwnB = '$_POST[lachdtwnb]',
                                               LAChdNbedB = '$_POST[lachdnbedb]',
                                               LAChdXbedB = '$_POST[lachdxbedb]',
                                               LAInfantB = '$_POST[lainfantb]',
                                               SellingAdlTwnC = '$_POST[rsadultc]',
                                               SellingChdTwnC = '$_POST[rschdtwnc]',
                                               SellingChdNbedC = '$_POST[rschdnbedc]',
                                               SellingChdXbedC = '$_POST[rschdxbedc]',
                                               SellingInfantC = '$_POST[rsinfantc]',
                                               LAAdlTwnC = '$_POST[laadltwnc]',
                                               LAChdTwnC = '$_POST[lachdtwnc]',
                                               LAChdNbedC = '$_POST[lachdnbedc]',
                                               LAChdXbedC = '$_POST[lachdxbedc]',
                                               LAInfantC = '$_POST[lainfantc]',    
                                               TaxInsNett = '$_POST[taxinsnett]',
                                               TaxInsSell = '$_POST[taxinssell]',
                                               LandArrNett = '$_POST[landarrnett]',
                                               LandArrSell = '$_POST[landarrsell]',
                                               SingleNett = '$_POST[singlenett]',
                                               SingleSell = '$_POST[singlesell]', 
                                               VisaCurr = '$_POST[visacurr]',
                                               VisaNett = '$_POST[visanett]',
                                               VisaSell = '$_POST[visasell]',
                                               VisaCurr2 = '$_POST[visacurr2]',
                                               VisaNett2 = '$_POST[visanett2]',
                                               VisaSell2 = '$_POST[visasell2]',
                                               AirTaxCurr = '$_POST[airtaxcurr]',
                                               AirTaxNett = '$_POST[airtaxnett]',
                                               AirTaxSell = '$_POST[airtaxsell]'
                    WHERE IDProduct = '$_POST[id]'");
        $caridataakhir=mysql_query("SELECT * FROM tour_mstmrreq WHERE IDTmr = '$_POST[idtmr]' order by IDTmr DESC limit 1");
        $datatmrakhir=mysql_fetch_array($caridataakhir);
        mysql_query("UPDATE tour_mstmrreq set TnC = '$_POST[tcb]'
                    WHERE TmrNo = '$datatmrakhir[TmrNo]'");
        $Description="Input Quotation TMR selling price ($tourcode)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                               Description,
                               LogTime) 
                        VALUES ('$EmpName', 
                               '$Description', 
                               '$today')");
        header('location:media.php?module=mstmr');
    }
// update quotation
    elseif ($module=='group' AND $act=='update'){
        $cuma = mysql_query("SELECT * FROM tour_msdiscount
                    where IDProduct = $_POST[id]
                    ORDER BY IDDiscount DESC limit 1");
        $saja = mysql_fetch_array($cuma);
        $jum = mysql_num_rows($cuma);
        $inqid=$saja[IDDiscount];
        if ($jum>0 && $_POST[cvalue]=='on'){
            mysql_query("UPDATE tour_msdiscount set Status = 'INACTIVE'
                    WHERE IDDiscount = '$inqid'");
        }
        if($_POST[cvalue]=='on'){
            mysql_query("INSERT INTO tour_msdiscount(IDProduct,
                                            Max1,
                                            Max2,
                                            Max3,
                                            Max4,
                                            Max5,
                                            Max6,
                                            Max7,
                                            Disc1,
                                            Disc2,
                                            Disc3,
                                            Disc4,
                                            Disc5,
                                            Disc6,
                                            Disc7,
                                            Status,
                                            UpdateBy,
                                            UpdateDate) 
                                   VALUES ('$_POST[id]', 
                                            '$_POST[max1]',
                                            '$_POST[max2]',
                                            '$_POST[max3]',
                                            '$_POST[max4]',
                                            '$_POST[max5]',
                                            '$_POST[max6]',
                                            '$_POST[max7]',
                                            '$_POST[disc1]',
                                            '$_POST[disc2]',
                                            '$_POST[disc3]',
                                            '$_POST[disc4]',
                                            '$_POST[disc5]',
                                            '$_POST[disc6]',
                                            '$_POST[disc7]',
                                            'ACTIVE',
                                            '$EmpName', 
                                            '$today')");
        }
        //incentive
        mysql_query("UPDATE tour_msproduct set IncentiveCurr = '$_POST[incentivecurr]',
                                         Incentive = '$_POST[incentive]',
                                         VisaFree = '$_POST[free]'
                    WHERE IDProduct = '$_POST[id]'");

        $exh = mysql_query("SELECT * FROM tour_xtrapameran
                    where IDProduct = $_POST[id] 
                    ORDER BY IDXtra DESC Limit 1");
        $jumpamer = mysql_num_rows($exh);
        $pamer = mysql_fetch_array($exh);
        $idproduct=$_POST['id'];
        $min=$_POST['min'];
        $max=$_POST['max'];
        $mindisc=$_POST['mindisc'];
        $maxdisc=$_POST['maxdisc'];
        $promo=strtoupper($_POST['promo']);
        $statuspromo=$_POST['statuspromo'];
        $statusdisc=$_POST['statusdisc'];
        $adddiscamount=strtoupper($_POST['adddiscamount']);
        if($jumpamer==0){
            if(($min <> "" and $max <> "" and $promo <> "" )OR($mindisc <> "" and $maxdisc <> "" and $adddiscamount <> "")){
                mysql_query("INSERT INTO tour_xtrapameran(IDProduct,
                                           Min,
                                           Max,
                                           Promo,MinDisc,
                                           MaxDisc,AddDiscAmount,Status,StatusDisc,UpdateBy,UpdateDate)
                                    VALUES ('$idproduct','$min','$max','$promo','$mindisc','$maxdisc','$adddiscamount','$statuspromo','$statusdisc','$EmpName','$today')");
            }
        }else{
            if($pamer[Min]==$min AND $pamer[Max]==$max AND $pamer[MinDisc]==$mindisc AND $pamer[MaxDisc]==$maxdisc){
                mysql_query("UPDATE tour_xtrapameran set Promo = '$promo',
                                               Status = '$statuspromo',
                                               AddDiscAmount = '$adddiscamount',
                                               StatusDisc = '$statusdisc',
                                               UpdateBy = '$EmpName',
                                               UpdateDate = '$today'
                    WHERE IDXtra = '$pamer[IDXtra]'");
            }else{
                mysql_query("UPDATE tour_xtrapameran set Status = 'INACTIVE',
                                               StatusDisc = 'INACTIVE',
                                               UpdateBy = '$EmpName',
                                               UpdateDate = '$today'
                    WHERE IDProduct = '$_POST[id]'");
                mysql_query("INSERT INTO tour_xtrapameran(IDProduct,
                                           Min,
                                           Max,
                                           Promo,MinDisc,
                                           MaxDisc,AddDiscAmount,Status,StatusDisc,UpdateBy,UpdateDate)
                                    VALUES ('$idproduct','$min','$max','$promo','$mindisc','$maxdisc','$adddiscamount','$statuspromo','$statusdisc','$EmpName','$today')");
            }
        }
        $Description="Update discount for product id ($_POST[id])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                               Description,
                               LogTime) 
                        VALUES ('$EmpName', 
                               '$Description', 
                               '$today')");
        header("location:media.php?module=group");
    }
// copy quotation
    elseif ($module=='quotation' AND $act=='copyquotation'){
        mysql_query("DELETE FROM tour_msdetail
                    where IDProduct = '$_POST[id]'");
        $cuma = mysql_query("SELECT * FROM tour_msdetail
                    where IDProduct = '$_POST[idcopy]'");
        $jum = mysql_num_rows($cuma);
        $saja = mysql_fetch_array($cuma);
        mysql_query("INSERT INTO tour_msdetail(IDProduct,
                                            TotalVar,
                                            TotalFixAdult,
                                            TotalFixChd,
                                            AliasOptA,
                                            PaxA,
                                            TotalAdultA,
                                            TotalChdTwnA,
                                            TotalChdXbedA,
                                            TotalChdNbedA,
                                            AliasOptB,
                                            PaxB,
                                            TotalAdultB,
                                            TotalChdTwnB,
                                            TotalChdXbedB,
                                            TotalChdNbedB,
                                            AliasOptC,
                                            PaxC,
                                            TotalAdultC,
                                            TotalChdTwnC,
                                            TotalChdXbedC,
                                            TotalChdNbedC,
                                            Persen,
                                            ProfAdultA,
                                            ProfChdTwnA,
                                            ProfChdXbedA,
                                            ProfChdNbedA,
                                            ProfAdultB,
                                            ProfChdTwnB,
                                            ProfChdXbedB,
                                            ProfChdNbedB,
                                            ProfAdultC,
                                            ProfChdTwnC,
                                            ProfChdXbedC,
                                            ProfChdNbedC,
                                            ComAdultA,
                                            ComChdTwnA,
                                            ComChdXbedA,
                                            ComChdNbedA,
                                            ComAdultB,
                                            ComChdTwnB,
                                            ComChdXbedB,
                                            ComChdNbedB,  
                                            ComAdultC,
                                            ComChdTwnC,
                                            ComChdXbedC,
                                            ComChdNbedC,
                                            DiscAdultA,
                                            DiscChdTwnA,
                                            DiscChdXbedA,
                                            DiscChdNbedA,
                                            DiscAdultB,
                                            DiscChdTwnB,
                                            DiscChdXbedB,
                                            DiscChdNbedB,  
                                            DiscAdultC,
                                            DiscChdTwnC,
                                            DiscChdXbedC,
                                            DiscChdNbedC) 
                                    VALUES ('$_POST[id]',
                                            '$saja[TotalVar]',                 
                                            '$saja[TotalFixAdult]',
                                            '$saja[TotalFixChd]',
                                            '$saja[AliasOptA]',
                                            '$saja[PaxA]',
                                            '$saja[TotalAdultA]',
                                            '$saja[TotalChdTwnA]',
                                            '$saja[TotalChdXbedA]',
                                            '$saja[TotalChdNbedA]',
                                            '$saja[AliasOptB]',
                                            '$saja[PaxB]',
                                            '$saja[TotalAdultB]',
                                            '$saja[TotalChdTwnB]',
                                            '$saja[TotalChdXbedB]',
                                            '$saja[TotalChdNbedB]',
                                            '$saja[AliasOptC]',
                                            '$saja[PaxC]',
                                            '$saja[TotalAdultC]',
                                            '$saja[TotalChdTwnC]',
                                            '$saja[TotalChdXbedC]',
                                            '$saja[TotalChdNbedC]',
                                            '$saja[Persen]',
                                            '$saja[ProfAdultA]',
                                            '$saja[ProfChdTwnA]',
                                            '$saja[ProfChdXbedA]',
                                            '$saja[ProfChdNbedA]',
                                            '$saja[ProfAdultB]',
                                            '$saja[ProfChdTwnB]',
                                            '$saja[ProfChdXbedB]',
                                            '$saja[ProfChdNbedB]',
                                            '$saja[ProfAdultC]',
                                            '$saja[ProfChdTwnC]',
                                            '$saja[ProfChdXbedC]',
                                            '$saja[ProfChdNbedC]',
                                            '$saja[ComAdultA]',
                                            '$saja[ComChdTwnA]',
                                            '$saja[ComChdXbedA]',
                                            '$saja[ComChdNbedA]',
                                            '$saja[ComAdultB]',
                                            '$saja[ComChdTwnB]',
                                            '$saja[ComChdXbedB]',
                                            '$saja[ComChdNbedB]',  
                                            '$saja[ComAdultC]',
                                            '$saja[ComChdTwnC]',
                                            '$saja[ComChdXbedC]',
                                            '$saja[ComChdNbedC]',              
                                            '$saja[DiscAdultA]',
                                            '$saja[DiscChdTwnA]',
                                            '$saja[DiscChdXbedA]',
                                            '$saja[DiscChdNbedA]',
                                            '$saja[DiscAdultB]',
                                            '$saja[DiscChdTwnB]',
                                            '$saja[DiscChdXbedB]',
                                            '$saja[DiscChdNbedB]',  
                                            '$saja[DiscAdultC]',
                                            '$saja[DiscChdTwnC]',
                                            '$saja[DiscChdXbedC]',
                                            '$saja[DiscChdNbedC]')");

        mysql_query("DELETE FROM tour_detail
                    where IDProduct = $_POST[id]");
        $cuma1 = mysql_query("SELECT * FROM tour_detail
                    where IDProduct = $_POST[idcopy]");
        $jum1 = mysql_num_rows($cuma1);
        while($saja1 = mysql_fetch_array($cuma1)){
            mysql_query("INSERT INTO tour_detail(Detail,
                                            IDProduct,
                                            Category,
                                            Supplier,
                                            Description,
                                            QuotationCurr,
                                            SellingCurr,
                                            SellingOperator,
                                            SellingRate,
                                            QuoAdult,
                                            SellAdult,
                                            QuoChd,
                                            SellChd) 
                                    VALUES ('$saja1[Detail]',
                                            '$_POST[id]',
                                            '$saja1[Category]',
                                            '$saja1[Supplier]',
                                            '$saja1[Description]',
                                            '$saja1[QuotationCurr]',
                                            '$saja1[SellingCurr]',
                                            '$saja1[SellingOperator]',
                                            '$saja1[SellingRate]',
                                            '$saja1[QuoAdult]',
                                            '$saja1[SellAdult]',
                                            '$saja1[QuoChd]',
                                            '$saja1[SellChd]')");
        }
        mysql_query("DELETE FROM tour_agent
                    where IDProduct = $_POST[id]");
        $cuma2 = mysql_query("SELECT * FROM tour_agent
                    where IDProduct = $_POST[idcopy]");
        $jum2 = mysql_num_rows($cuma2);
        while($saja2 = mysql_fetch_array($cuma2)){
            mysql_query("INSERT INTO tour_agent(IDProduct,
                                            Category,
                                            Supplier,
                                            Description,
                                            QuotationCurrA,
                                            SellingCurrA,
                                            SellingOperatorA,
                                            SellingRateA,
                                            PaxA,
                                            QuoAdultA,
                                            SellAdultA,
                                            QuoChdTwnA,
                                            SellChdTwnA,
                                            QuoChdXbedA,
                                            SellChdXbedA,
                                            QuoChdNbedA,
                                            SellChdNbedA,
                                            QuotationCurrB,
                                            SellingCurrB,
                                            SellingOperatorB,
                                            SellingRateB,
                                            PaxB,
                                            QuoAdultB,
                                            SellAdultB,
                                            QuoChdTwnB,
                                            SellChdTwnB,
                                            QuoChdXbedB,
                                            SellChdXbedB,
                                            QuoChdNbedB,
                                            SellChdNbedB,
                                            QuotationCurrC,
                                            SellingCurrC,
                                            SellingOperatorC,
                                            SellingRateC,
                                            PaxC,
                                            QuoAdultC,
                                            SellAdultC,
                                            QuoChdTwnC,
                                            SellChdTwnC,
                                            QuoChdXbedC,
                                            SellChdXbedC,
                                            QuoChdNbedC,
                                            SellChdNbedC) 
                                    VALUES ('$_POST[id]',
                                            '$saja2[Category]',
                                            '$saja2[Supplier]',
                                            '$saja2[Description]',
                                            '$saja2[QuotationCurrA]',
                                            '$saja2[SellingCurrA]',
                                            '$saja2[SellingOperatorA]',
                                            '$saja2[SellingRateA]',
                                            '$saja2[PaxA]',
                                            '$saja2[QuoAdultA]',
                                            '$saja2[SellAdultA]',
                                            '$saja2[QuoChdTwnA]',
                                            '$saja2[SellChdTwnA]',
                                            '$saja2[QuoChdXbedA]',
                                            '$saja2[SellChdXbedA]',
                                            '$saja2[QuoChdNbedA]',
                                            '$saja2[SellChdNbedA]',
                                            '$saja2[QuotationCurrB]',
                                            '$saja2[SellingCurrB]',
                                            '$saja2[SellingOperatorB]',
                                            '$saja2[SellingRateB]',
                                            '$saja2[PaxB]',
                                            '$saja2[QuoAdultB]',
                                            '$saja2[SellAdultB]',
                                            '$saja2[QuoChdTwnB]',
                                            '$saja2[SellChdTwnB]',
                                            '$saja2[QuoChdXbedB]',
                                            '$saja2[SellChdXbedB]',
                                            '$saja2[QuoChdNbedB]',
                                            '$saja2[SellChdNbedB]',
                                            '$saja2[QuotationCurrC]',
                                            '$saja2[SellingCurrC]',
                                            '$saja2[SellingOperatorC]',
                                            '$saja2[SellingRateC]',
                                            '$saja2[PaxC]',
                                            '$saja2[QuoAdultC]',
                                            '$saja2[SellAdultC]',
                                            '$saja2[QuoChdTwnC]',
                                            '$saja2[SellChdTwnC]',
                                            '$saja2[QuoChdXbedC]',
                                            '$saja2[SellChdXbedC]',
                                            '$saja2[QuoChdNbedC]',
                                            '$saja2[SellChdNbedC]')");
        }
        $cuma3 = mysql_query("SELECT * FROM tour_msproduct
                    where IDProduct = $_POST[idcopy]");
        $saja3 = mysql_fetch_array($cuma3);
        mysql_query("UPDATE tour_msproduct set SellingAdlTwn = '$saja3[SellingAdlTwn]',
                                               SellingChdTwn = '$saja3[SellingChdTwn]',
                                               SellingChdNbed = '$saja3[SellingChdNbed]',
                                               SellingChdXbed = '$saja3[SellingChdXbed]',
                                               SellingInfant = '$saja3[SellingInfant]',
                                               LAAdlTwn = '$saja3[LAAdlTwn]',
                                               LAChdTwn = '$saja3[LAChdTwn]',
                                               LAChdNbed = '$saja3[LAChdNbed]',
                                               LAChdXbed = '$saja3[LAChdXbed]', 
                                               LAInfant = '$saja3[LAInfant]',  
                                               TaxInsNett = '$saja3[TaxInsNett]',
                                               TaxInsSell = '$saja3[TaxInsSell]',
                                               LandArrNett = '$saja3[LandArrNett]',
                                               LandArrSell = '$saja3[LandArrSell]',
                                               SingleNett = '$saja3[SingleNett]',
                                               SingleSell = '$saja3[SingleSell]', 
                                               VisaCurr = '$saja3[VisaCurr]',
                                               VisaNett = '$saja3[VisaNett]',
                                               VisaSell = '$saja3[VisaSell]',
                                               VisaCurr2 = '$saja3[VisaCurr2]',
                                               VisaNett2 = '$saja3[VisaNett2]',
                                               VisaSell2 = '$saja3[VisaSell2]',
                                               AirTaxCurr = '$saja3[AirTaxCurr]',
                                               AirTaxNett = '$saja3[AirTaxNett]',
                                               AirTaxSell = '$saja3[AirTaxSell]'
                    WHERE IDProduct = '$_POST[id]'");
        $Description="Update quotation ID Product ($_POST[id]) from ID Product ($_POST[idcopy])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                               Description,
                               LogTime) 
                        VALUES ('$EmpName', 
                               '$Description', 
                               '$today')");
        header("location:media.php?module=msproduct&act=quotation&id=$_POST[id]");
    }
// create final quotation 
    elseif ($module=='msproduct' AND $act=='finalquotation'){
        $idproduct=$_POST[id];
        $optagent=$_POST[quotfinaloption];
        $cuma = mysql_query("SELECT * FROM tour_msdetail
                where IDProduct = '$_POST[id]'");
        $jum = mysql_num_rows($cuma);
        $saja = mysql_fetch_array($cuma);
        $qprod = mysql_query("SELECT * FROM tour_msproduct
                where IDProduct = '$_POST[id]'");
        $rprod = mysql_fetch_array($qprod);
        $AliasOpt=$saja['AliasOpt'.$optagent];
        $Pax=$saja['Pax'.$optagent];
        $TotalAdult=$saja['TotalAdult'.$optagent];
        $TotalChdTwn=$saja['TotalChdTwn'.$optagent];
        $TotalChdXbed=$saja['TotalChdXbed'.$optagent];
        $TotalChdNbed=$saja['TotalChdNbed'.$optagent];
        $ProfAdult=$saja['ProfAdult'.$optagent];
        $ProfChdTwn=$saja['ProfChdTwn'.$optagent];
        $ProfChdXbed=$saja['ProfChdXbed'.$optagent];
        $ProfChdNbed=$saja['ProfChdNbed'.$optagent];
        $ComAdult=$saja['ComAdult'.$optagent];
        $ComChdTwn=$saja['ComChdTwn'.$optagent];
        $ComChdXbed=$saja['ComChdXbed'.$optagent];
        $ComChdNbed=$saja['ComChdNbed'.$optagent];
        $DiscAdult=$saja['DiscAdult'.$optagent];
        $DiscChdTwn=$saja['DiscChdTwn'.$optagent];
        $DiscChdXbed=$saja['DiscChdXbed'.$optagent];
        $DiscChdNbed=$saja['DiscChdNbed'.$optagent];
        $SingleCurr=$rprod[SingleCurr];
        $SingleRate=$rprod[SingleRate];
        $SingleNett=$rprod[SingleNett];
        $SingleNettIDR=$rprod[SingleNettIDR];
        $SingleSell=$rprod[SingleSell];

        mysql_query("INSERT INTO tour_msdetailfinal(IDProduct,
                                        TotalVar,
                                        TotalFixAdult,
                                        TotalFixChd,
                                        AliasOpt,
                                        Pax,
                                        TotalAdult,
                                        TotalChdTwn,
                                        TotalChdXbed,
                                        TotalChdNbed,
                                        Persen,
                                        ProfAdult,
                                        ProfChdTwn,
                                        ProfChdXbed,
                                        ProfChdNbed,
                                        ComAdult,
                                        ComChdTwn,
                                        ComChdXbed,
                                        ComChdNbed,
                                        DiscAdult,
                                        DiscChdTwn,
                                        DiscChdXbed,
                                        DiscChdNbed,
                                        SingleCurr,
                                        SingleRate,
                                        SingleNett,
                                        SingleNettIDR,
                                        SingleSell)
                                VALUES ('$_POST[id]',
                                        '$saja[TotalVar]',
                                        '$saja[TotalFixAdult]',
                                        '$saja[TotalFixChd]',
                                        '$AliasOpt',
                                        '$Pax',
                                        '$TotalAdult',
                                        '$TotalChdTwn',
                                        '$TotalChdXbed',
                                        '$TotalChdNbed',
                                        '$saja[Persen]',
                                        '$ProfAdult',
                                        '$ProfChdTwn',
                                        '$ProfChdXbed',
                                        '$ProfChdNbed',
                                        '$ComAdult',
                                        '$ComChdTwn',
                                        '$ComChdXbed',
                                        '$ComChdNbed',
                                        '$DiscAdult',
                                        '$DiscChdTwn',
                                        '$DiscChdXbed',
                                        '$DiscChdNbed',
                                        '$SingleCurr',
                                        '$SingleRate',
                                        '$SingleNett',
                                        '$SingleNettIDR',
                                        '$SingleSell')");

        $cuma1 = mysql_query("SELECT * FROM tour_detail
                where IDProduct = '$_POST[id]'");
        $jum1 = mysql_num_rows($cuma1);
        while($saja1 = mysql_fetch_array($cuma1)){
            mysql_query("INSERT INTO tour_detailfinal(Detail,
                                        IDProduct,
                                        Category,
                                        Supplier,
                                        Description,
                                        QuotationCurr,
                                        SellingCurr,
                                        SellingOperator,
                                        SellingRate,
                                        QuoAdult,
                                        SellAdult,
                                        QuoChd,
                                        SellChd)
                                VALUES ('$saja1[Detail]',
                                        '$_POST[id]',
                                        '$saja1[Category]',
                                        '$saja1[Supplier]',
                                        '$saja1[Description]',
                                        '$saja1[QuotationCurr]',
                                        '$saja1[SellingCurr]',
                                        '$saja1[SellingOperator]',
                                        '$saja1[SellingRate]',
                                        '$saja1[QuoAdult]',
                                        '$saja1[SellAdult]',
                                        '$saja1[QuoChd]',
                                        '$saja1[SellChd]')");
        }
        $cuma2 = mysql_query("SELECT * FROM tour_agent
                where IDProduct = '$_POST[id]'");
        $jum2 = mysql_num_rows($cuma2);
        while($saja2 = mysql_fetch_array($cuma2)){
            $QuotationCurr=$saja2['QuotationCurr'.$optagent];
            $SellingCurr=$saja2['SellingCurr'.$optagent];
            $SellingOperator=$saja2['SellingOperator'.$optagent];
            $SellingRate=$saja2['SellingRate'.$optagent];
            $Pax=$saja2['Pax'.$optagent];
            $QuoAdult=$saja2['QuoAdult'.$optagent];
            $SellAdult=$saja2['SellAdult'.$optagent];
            $QuoChdTwn=$saja2['QuoChdTwn'.$optagent];
            $SellChdTwn=$saja2['SellChdTwn'.$optagent];
            $QuoChdXbed=$saja2['QuoChdXbed'.$optagent];
            $SellChdXbed=$saja2['SellChdXbed'.$optagent];
            $QuoChdNbed=$saja2['QuoChdNbed'.$optagent];
            $SellChdNbed=$saja2['SellChdNbed'.$optagent];
            mysql_query("INSERT INTO tour_agentfinal(IDProduct,
                                        Category,
                                        Supplier,
                                        Description,
                                        QuotationCurr,
                                        SellingCurr,
                                        SellingOperator,
                                        SellingRate,
                                        Pax,
                                        QuoAdult,
                                        SellAdult,
                                        QuoChdTwn,
                                        SellChdTwn,
                                        QuoChdXbed,
                                        SellChdXbed,
                                        QuoChdNbed,
                                        SellChdNbed)
                                VALUES ('$_POST[id]',
                                        '$saja2[Category]',
                                        '$saja2[Supplier]',
                                        '$saja2[Description]',
                                        '$QuotationCurr',
                                        '$SellingCurr',
                                        '$SellingOperator',
                                        '$SellingRate',
                                        '$Pax',
                                        '$QuoAdult',
                                        '$SellAdult',
                                        '$QuoChdTwn',
                                        '$SellChdTwn',
                                        '$QuoChdXbed',
                                        '$SellChdXbed',
                                        '$QuoChdNbed',
                                        '$SellChdNbed')");
        }
        $cuma3 = mysql_query("SELECT * FROM tour_msproductprice
                where ProductID = '$_POST[id]'");
        $jum3 = mysql_num_rows($cuma3);
        while($saja3 = mysql_fetch_array($cuma3)){
            mysql_query("INSERT INTO tour_msproductpricefinal(
                                        ProductID,
                                        PriceFor,
                                        SellingCurr,
                                        SellingAdlTwn,
                                        SellingChdTwn,
                                        SellingChdXbed,
                                        SellingChdNbed,
                                        SellingInfant,
                                        LAAdlTwn,
                                        LAChdTwn,
                                        LAChdXbed,
                                        LAChdNbed,
                                        LAInfant,
                                        CruiseAdl12,
                                        CruiseAdl34,
                                        CruiseChd12,
                                        CruiseChd34,
                                        CruiseLoAdl12,
                                        CruiseLoAdl34,
                                        CruiseLoChd12,
                                        CruiseLoChd34)
                                VALUES ('$_POST[id]',
                                        '$saja3[PriceFor]',
                                        '$saja3[SellingCurr]',
                                        '$saja3[SellingAdlTwn]',
                                        '$saja3[SellingChdTwn]',
                                        '$saja3[SellingChdXbed]',
                                        '$saja3[SellingChdNbed]',
                                        '$saja3[SellingInfant]',
                                        '$saja3[LAAdlTwn]',
                                        '$saja3[LAChdTwn]',
                                        '$saja3[LAChdXbed]',
                                        '$saja3[LAChdNbed]',
                                        '$saja3[LAInfant]',
                                        '$saja3[CruiseAdl12]',
                                        '$saja3[CruiseAdl34]',
                                        '$saja3[CruiseChd12]',
                                        '$saja3[CruiseChd34]',
                                        '$saja3[CruiseLoAdl12]',
                                        '$saja3[CruiseLoAdl34]',
                                        '$saja3[CruiseLoChd12]',
                                        '$saja3[CruiseLoChd34]')");
        }
        mysql_query("UPDATE tour_msproduct set QuotationStatus = 'LOCK',
                                               QuotationFinalOption = '$optagent',
                                               QuotationFinalBy = '$EmpName',
                                               QuotationFinalDate = '$today'
                    where IDProduct = '$_POST[id]' ");

        $Description="Create Final quotation ID Product ($_POST[id])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                           Description,
                           LogTime)
                    VALUES ('$EmpName',
                           '$Description',
                           '$today')");
        header("location:media.php?module=msproduct&act=finalquotation&id=$_POST[id]");
    }
// update final quotation
    elseif ($module=='msproduct' AND $act=='finalselling'){
        $tourcode=strtoupper($_POST[tourcode]);
        mysql_query("UPDATE tour_msdetailfinal set ComAdult = '$_POST[comaa]',
                                               ComChdtwn = '$_POST[comca]',
                                               ComChdXbed = '$_POST[comcxa]',
                                               ComChdNbed = '$_POST[comcna]',
                                               Persen = '$_POST[persen]',
                                               ProfAdult = '$_POST[paa]',
                                               ProfChdtwn = '$_POST[pca]',
                                               ProfChdXbed = '$_POST[pcxa]',
                                               ProfChdNbed = '$_POST[pcna]',
                                               DiscAdult = '$_POST[discaa]',
                                               DiscChdtwn = '$_POST[discca]',
                                               DiscChdXbed = '$_POST[disccxa]',
                                               DiscChdNbed = '$_POST[disccna]',
                                               SingleCurr = '$_POST[singlecurr]',
                                               SingleRate = '$_POST[singlerate]',
                                               SingleNett = '$_POST[singlenett]',
                                               SingleNettIDR = '$_POST[singlenettidr]',
                                               SingleSell = '$_POST[singlesell]'
                    WHERE IDProduct = '$_POST[id]'");

        $qprice=mysql_query("SELECT * FROM tour_msproductpricefinal WHERE ProductID = '$_POST[id]'");
        $price=mysql_num_rows($qprice);
        if($price>0){
            mysql_query("UPDATE tour_msproductpricefinal set SellingAdlTwn = '$_POST[rsadult]',
                                               SellingChdTwn = '$_POST[rschdtwn]',
                                               SellingChdNbed = '$_POST[rschdnbed]',
                                               SellingChdXbed = '$_POST[rschdxbed]',
                                               SellingInfant = '$_POST[rsinfant]',
                                               LAAdlTwn = '$_POST[laadltwn]',
                                               LAChdTwn = '$_POST[lachdtwn]',
                                               LAChdNbed = '$_POST[lachdnbed]',
                                               LAChdXbed = '$_POST[lachdxbed]',
                                               LAInfant = '$_POST[lainfant]',
                                               CruiseAdl12 = '$_POST[cadl12]',
                                               CruiseAdl34 = '$_POST[cadl34]',
                                               CruiseChd12 = '$_POST[cchd12]',
                                               CruiseChd34 = '$_POST[cchd34]',
                                               CruiseLoAdl12 = '$_POST[cladl12]',
                                               CruiseLoAdl34 = '$_POST[cladl34]',
                                               CruiseLoChd12 = '$_POST[clchd12]',
                                               CruiseLoChd34 = '$_POST[clchd34]'
                    WHERE ProductID = '$_POST[id]' AND PriceFor = 'GENERAL'");
            mysql_query("UPDATE tour_msproductpricefinal set SellingAdlTwn = '$_POST[rsadultin]',
                                               SellingChdTwn = '$_POST[rschdtwnin]',
                                               SellingChdNbed = '$_POST[rschdnbedin]',
                                               SellingChdXbed = '$_POST[rschdxbedin]',
                                               SellingInfant = '$_POST[rsinfantin]',
                                               LAAdlTwn = '$_POST[laadltwnin]',
                                               LAChdTwn = '$_POST[lachdtwnin]',
                                               LAChdNbed = '$_POST[lachdnbedin]',
                                               LAChdXbed = '$_POST[lachdxbedin]',
                                               LAInfant = '$_POST[lainfantin]',
                                               CruiseAdl12 = '$_POST[cadl12in]',
                                               CruiseAdl34 = '$_POST[cadl34in]',
                                               CruiseChd12 = '$_POST[cchd12in]',
                                               CruiseChd34 = '$_POST[cchd34in]',
                                               CruiseLoAdl12 = '$_POST[cladl12in]',
                                               CruiseLoAdl34 = '$_POST[cladl34in]',
                                               CruiseLoChd12 = '$_POST[clchd12in]',
                                               CruiseLoChd34 = '$_POST[clchd34in]'
                    WHERE ProductID = '$_POST[id]' AND PriceFor = 'INTERNAL'");
            mysql_query("UPDATE tour_msproductpricefinal set SellingAdlTwn = '$_POST[rsadultpw]',
                                               SellingChdTwn = '$_POST[rschdtwnpw]',
                                               SellingChdNbed = '$_POST[rschdnbedpw]',
                                               SellingChdXbed = '$_POST[rschdxbedpw]',
                                               SellingInfant = '$_POST[rsinfantpw]',
                                               LAAdlTwn = '$_POST[laadltwnpw]',
                                               LAChdTwn = '$_POST[lachdtwnpw]',
                                               LAChdNbed = '$_POST[lachdnbedpw]',
                                               LAChdXbed = '$_POST[lachdxbedpw]',
                                               LAInfant = '$_POST[lainfantpw]',
                                               CruiseAdl12 = '$_POST[cadl12pw]',
                                               CruiseAdl34 = '$_POST[cadl34pw]',
                                               CruiseChd12 = '$_POST[cchd12pw]',
                                               CruiseChd34 = '$_POST[cchd34pw]',
                                               CruiseLoAdl12 = '$_POST[cladl12pw]',
                                               CruiseLoAdl34 = '$_POST[cladl34pw]',
                                               CruiseLoChd12 = '$_POST[clchd12pw]',
                                               CruiseLoChd34 = '$_POST[clchd34pw]'
                    WHERE ProductID = '$_POST[id]' AND PriceFor = 'PANORAMA WORLD'");
            mysql_query("UPDATE tour_msproductpricefinal set SellingAdlTwn = '$_POST[rsadultsc]',
                                               SellingChdTwn = '$_POST[rschdtwnsc]',
                                               SellingChdNbed = '$_POST[rschdnbedsc]',
                                               SellingChdXbed = '$_POST[rschdxbedsc]',
                                               SellingInfant = '$_POST[rsinfantsc]',
                                               LAAdlTwn = '$_POST[laadltwnsc]',
                                               LAChdTwn = '$_POST[lachdtwnsc]',
                                               LAChdNbed = '$_POST[lachdnbedsc]',
                                               LAChdXbed = '$_POST[lachdxbedsc]',
                                               LAInfant = '$_POST[lainfantsc]',
                                               CruiseAdl12 = '$_POST[cadl12sc]',
                                               CruiseAdl34 = '$_POST[cadl34sc]',
                                               CruiseChd12 = '$_POST[cchd12sc]',
                                               CruiseChd34 = '$_POST[cchd34sc]',
                                               CruiseLoAdl12 = '$_POST[cladl12sc]',
                                               CruiseLoAdl34 = '$_POST[cladl34sc]',
                                               CruiseLoChd12 = '$_POST[clchd12sc]',
                                               CruiseLoChd34 = '$_POST[clchd34sc]'
                    WHERE ProductID = '$_POST[id]' AND PriceFor = 'SISTER COMPANY'");
            mysql_query("UPDATE tour_msproductpricefinal set SellingAdlTwn = '$_POST[rsadultsa]',
                                               SellingChdTwn = '$_POST[rschdtwnsa]',
                                               SellingChdNbed = '$_POST[rschdnbedsa]',
                                               SellingChdXbed = '$_POST[rschdxbedsa]',
                                               SellingInfant = '$_POST[rsinfantsa]',
                                               LAAdlTwn = '$_POST[laadltwnsa]',
                                               LAChdTwn = '$_POST[lachdtwnsa]',
                                               LAChdNbed = '$_POST[lachdnbedsa]',
                                               LAChdXbed = '$_POST[lachdxbedsa]',
                                               LAInfant = '$_POST[lainfantsa]',
                                               CruiseAdl12 = '$_POST[cadl12sa]',
                                               CruiseAdl34 = '$_POST[cadl34sa]',
                                               CruiseChd12 = '$_POST[cchd12sa]',
                                               CruiseChd34 = '$_POST[cchd34sa]',
                                               CruiseLoAdl12 = '$_POST[cladl12sa]',
                                               CruiseLoAdl34 = '$_POST[cladl34sa]',
                                               CruiseLoChd12 = '$_POST[clchd12sa]',
                                               CruiseLoChd34 = '$_POST[clchd34sa]'
                    WHERE ProductID = '$_POST[id]' AND PriceFor = 'SUB AGENT'");
        }else{
            mysql_query("INSERT into tour_msproductpricefinal (ProductID,
                                               SellingAdlTwn,
                                               SellingChdTwn,
                                               SellingChdNbed,
                                               SellingChdXbed,
                                               SellingInfant,
                                               LAAdlTwn,
                                               LAChdTwn,
                                               LAChdNbed,
                                               LAChdXbed,
                                               LAInfant,
                                               CruiseAdl12,
                                               CruiseAdl34,
                                               CruiseChd12,
                                               CruiseChd34,
                                               CruiseLoAdl12,
                                               CruiseLoAdl34,
                                               CruiseLoChd12,
                                               CruiseLoChd34,
                                               PriceFor)
                                        VALUES( '$_POST[id]',
                                                '$_POST[rsadult]',
                                                '$_POST[rschdtwn]',
                                                '$_POST[rschdnbed]',
                                                '$_POST[rschdxbed]',
                                                '$_POST[rsinfant]',
                                                '$_POST[laadltwn]',
                                                '$_POST[lachdtwn]',
                                                '$_POST[lachdnbed]',
                                                '$_POST[lachdxbed]',
                                                '$_POST[lainfant]',
                                                '$_POST[cadl12]',
                                                '$_POST[cadl34]',
                                                '$_POST[cchd12]',
                                                '$_POST[cchd34]',
                                                '$_POST[cladl12]',
                                                '$_POST[cladl34]',
                                                '$_POST[clchd12]',
                                                '$_POST[clchd34]',
                                                'GENERAL')");
            mysql_query("INSERT into tour_msproductpricefinal (ProductID,
                                               SellingAdlTwn,
                                               SellingChdTwn,
                                               SellingChdNbed,
                                               SellingChdXbed,
                                               SellingInfant,
                                               LAAdlTwn,
                                               LAChdTwn,
                                               LAChdNbed,
                                               LAChdXbed,
                                               LAInfant,
                                               CruiseAdl12,
                                               CruiseAdl34,
                                               CruiseChd12,
                                               CruiseChd34,
                                               CruiseLoAdl12,
                                               CruiseLoAdl34,
                                               CruiseLoChd12,
                                               CruiseLoChd34,
                                               PriceFor)
                                        VALUES( '$_POST[id]',
                                                '$_POST[rsadultin]',
                                                '$_POST[rschdtwnin]',
                                                '$_POST[rschdnbedin]',
                                                '$_POST[rschdxbedin]',
                                                '$_POST[rsinfantin]',
                                                '$_POST[laadltwnin]',
                                                '$_POST[lachdtwnin]',
                                                '$_POST[lachdnbedin]',
                                                '$_POST[lachdxbedin]',
                                                '$_POST[lainfantin]',
                                                '$_POST[cadl12in]',
                                                '$_POST[cadl34in]',
                                                '$_POST[cchd12in]',
                                                '$_POST[cchd34in]',
                                                '$_POST[cladl12in]',
                                                '$_POST[cladl34in]',
                                                '$_POST[clchd12in]',
                                                '$_POST[clchd34in]',
                                                'INTERNAL')");
            mysql_query("INSERT into tour_msproductpricefinal (ProductID,
                                               SellingAdlTwn,
                                               SellingChdTwn,
                                               SellingChdNbed,
                                               SellingChdXbed,
                                               SellingInfant,
                                               LAAdlTwn,
                                               LAChdTwn,
                                               LAChdNbed,
                                               LAChdXbed,
                                               LAInfant,
                                               CruiseAdl12,
                                               CruiseAdl34,
                                               CruiseChd12,
                                               CruiseChd34,
                                               CruiseLoAdl12,
                                               CruiseLoAdl34,
                                               CruiseLoChd12,
                                               CruiseLoChd34,
                                               PriceFor)
                                        VALUES( '$_POST[id]',
                                                '$_POST[rsadultpw]',
                                                '$_POST[rschdtwnpw]',
                                                '$_POST[rschdnbedpw]',
                                                '$_POST[rschdxbedpw]',
                                                '$_POST[rsinfantpw]',
                                                '$_POST[laadltwnpw]',
                                                '$_POST[lachdtwnpw]',
                                                '$_POST[lachdnbedpw]',
                                                '$_POST[lachdxbedpw]',
                                                '$_POST[lainfantpw]',
                                                '$_POST[cadl12pw]',
                                                '$_POST[cadl34pw]',
                                                '$_POST[cchd12pw]',
                                                '$_POST[cchd34pw]',
                                                '$_POST[cladl12pw]',
                                                '$_POST[cladl34pw]',
                                                '$_POST[clchd12pw]',
                                                '$_POST[clchd34pw]',
                                                'PANORAMA WORLD')");
            mysql_query("INSERT into tour_msproductpricefinal (ProductID,
                                               SellingAdlTwn,
                                               SellingChdTwn,
                                               SellingChdNbed,
                                               SellingChdXbed,
                                               SellingInfant,
                                               LAAdlTwn,
                                               LAChdTwn,
                                               LAChdNbed,
                                               LAChdXbed,
                                               LAInfant,
                                               CruiseAdl12,
                                               CruiseAdl34,
                                               CruiseChd12,
                                               CruiseChd34,
                                               CruiseLoAdl12,
                                               CruiseLoAdl34,
                                               CruiseLoChd12,
                                               CruiseLoChd34,
                                               PriceFor)
                                        VALUES( '$_POST[id]',
                                                '$_POST[rsadultsc]',
                                                '$_POST[rschdtwnsc]',
                                                '$_POST[rschdnbedsc]',
                                                '$_POST[rschdxbedsc]',
                                                '$_POST[rsinfantsc]',
                                                '$_POST[laadltwnsc]',
                                                '$_POST[lachdtwnsc]',
                                                '$_POST[lachdnbedsc]',
                                                '$_POST[lachdxbedsc]',
                                                '$_POST[lainfantsc]',
                                                '$_POST[cadl12sc]',
                                                '$_POST[cadl34sc]',
                                                '$_POST[cchd12sc]',
                                                '$_POST[cchd34sc]',
                                                '$_POST[cladl12sc]',
                                                '$_POST[cladl34sc]',
                                                '$_POST[clchd12sc]',
                                                '$_POST[clchd34sc]',
                                                'SISTER COMPANY')");
            mysql_query("INSERT into tour_msproductpricefinal (ProductID,
                                               SellingAdlTwn,
                                               SellingChdTwn,
                                               SellingChdNbed,
                                               SellingChdXbed,
                                               SellingInfant,
                                               LAAdlTwn,
                                               LAChdTwn,
                                               LAChdNbed,
                                               LAChdXbed,
                                               LAInfant,
                                               CruiseAdl12,
                                               CruiseAdl34,
                                               CruiseChd12,
                                               CruiseChd34,
                                               CruiseLoAdl12,
                                               CruiseLoAdl34,
                                               CruiseLoChd12,
                                               CruiseLoChd34,
                                               PriceFor)
                                        VALUES( '$_POST[id]',
                                                '$_POST[rsadultsa]',
                                                '$_POST[rschdtwnsa]',
                                                '$_POST[rschdnbedsa]',
                                                '$_POST[rschdxbedsa]',
                                                '$_POST[rsinfantsa]',
                                                '$_POST[laadltwnsa]',
                                                '$_POST[lachdtwnsa]',
                                                '$_POST[lachdnbedsa]',
                                                '$_POST[lachdxbedsa]',
                                                '$_POST[lainfantsa]',
                                                '$_POST[cadl12sa]',
                                                '$_POST[cadl34sa]',
                                                '$_POST[cchd12sa]',
                                                '$_POST[cchd34sa]',
                                                '$_POST[cladl12sa]',
                                                '$_POST[cladl34sa]',
                                                '$_POST[clchd12sa]',
                                                '$_POST[clchd34sa]',
                                                'SUB AGENT')");
        }
        $Description="Input Final Quotation selling price ($tourcode)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                               Description,
                               TourAdult,
                               TourChdTwn,
                               TourChdNbed,
                               TourChdXbed,
                               TourInfant,
                               LAAdult,
                               LAChdTwn,
                               LAChdNbed,
                               LAChdXbed,
                               LAInfant,
                               LogTime)
                        VALUES ('$EmpName',
                                '$Description',
                                '$_POST[rsadult]',
                                '$_POST[rschdtwn]',
                                '$_POST[rschdnbed]',
                                '$_POST[rschdxbed]',
                                '$_POST[rsinfant]',
                                '$_POST[laadltwn]',
                                '$_POST[lachdtwn]',
                                '$_POST[lachdnbed]',
                                '$_POST[lachdxbed]',
                                '$_POST[lainfant]',
                                '$today')");
        header('location:media.php?module=group');
    }
// copy quotation TMR
    elseif ($module=='quotationtmr' AND $act=='copyquotation'){
        mysql_query("DELETE FROM tour_msdetailreq
                    where IDProduct = $_POST[id]");
        $cuma = mysql_query("SELECT * FROM tour_msdetailreq
                    where IDProduct = $_POST[idcopy]");
        $jum = mysql_num_rows($cuma);
        while($saja = mysql_fetch_array($cuma)){
            mysql_query("INSERT INTO tour_msdetailreq(IDProduct,
                                            TotalVar,
                                            TotalFixAdult,
                                            TotalFixChd,
                                            PaxA,
                                            TotalAdultA,
                                            TotalChdTwnA,
                                            TotalChdXbedA,
                                            PaxB,
                                            TotalAdultB,
                                            TotalChdTwnB,
                                            TotalChdXbedB,
                                            PaxC,
                                            TotalAdultC,
                                            TotalChdTwnC,
                                            TotalChdXbedC,
                                            Persen,
                                            ComAdultA,
                                            ComChdTwnA,
                                            ComChdXbedA,
                                            ComAdultB,
                                            ComChdTwnB,
                                            ComChdXbedB,  
                                            ComAdultC,
                                            ComChdTwnC,
                                            ComChdXbedC,
                                            DiscAdultA,
                                            DiscChdTwnA,
                                            DiscChdXbedA,
                                            DiscAdultB,
                                            DiscChdTwnB,
                                            DiscChdXbedB,  
                                            DiscAdultC,
                                            DiscChdTwnC,
                                            DiscChdXbedC) 
                                    VALUES ('$_POST[id]',
                                            '$saja[TotalVar]',
                                            '$saja[TotalFixAdult]',
                                            '$saja[TotalFixChd]',
                                            '$saja[PaxA]',
                                            '$saja[TotalAdultA]',
                                            '$saja[TotalChdTwnA]',
                                            '$saja[TotalChdXbedA]',
                                            '$saja[PaxB]',
                                            '$saja[TotalAdultB]',
                                            '$saja[TotalChdTwnB]',
                                            '$saja[TotalChdXbedB]',
                                            '$saja[PaxC]',
                                            '$saja[TotalAdultC]',
                                            '$saja[TotalChdTwnC]',
                                            '$saja[TotalChdXbedC]',
                                            '$saja[Persen]',
                                            '$saja[ComAdultA]',
                                            '$saja[ComChdTwnA]',
                                            '$saja[ComChdXbedA]',
                                            '$saja[ComAdultB]',
                                            '$saja[ComChdTwnB]',
                                            '$saja[ComChdXbedB]',  
                                            '$saja[ComAdultC]',
                                            '$saja[ComChdTwnC]',
                                            '$saja[ComChdXbedC]',
                                            '$saja[DiscAdultA]',
                                            '$saja[DiscChdTwnA]',
                                            '$saja[DiscChdXbedA]',
                                            '$saja[DiscAdultB]',
                                            '$saja[DiscChdTwnB]',
                                            '$saja[DiscChdXbedB]',  
                                            '$saja[DiscAdultC]',
                                            '$saja[DiscChdTwnC]',
                                            '$saja[DiscChdXbedC]')");
        }
        mysql_query("DELETE FROM tour_detailreq
                    where IDProduct = $_POST[id]");
        $cuma1 = mysql_query("SELECT * FROM tour_detailreq
                    where IDProduct = $_POST[idcopy]");
        $jum1 = mysql_num_rows($cuma1);
        while($saja1 = mysql_fetch_array($cuma1)){
            mysql_query("INSERT INTO tour_detailreq(Detail,
                                            IDProduct,
                                            Category,
                                            Supplier,
                                            Description,
                                            QuotationCurr,
                                            SellingCurr,
                                            SellingOperator,
                                            SellingRate,
                                            QuoAdult,
                                            SellAdult,
                                            QuoChd,
                                            SellChd) 
                                    VALUES ('$saja1[Detail]',
                                            '$_POST[id]',
                                            '$saja1[Category]',
                                            '$saja1[Supplier]',
                                            '$saja1[Description]',
                                            '$saja1[QuotationCurr]',
                                            '$saja1[SellingCurr]',
                                            '$saja1[SellingOperator]',
                                            '$saja1[SellingRate]',
                                            '$saja1[QuoAdult]',
                                            '$saja1[SellAdult]',
                                            '$saja1[QuoChd]',
                                            '$saja1[SellChd]')");
        }
        mysql_query("DELETE FROM tour_agentreq
                    where IDProduct = $_POST[id]");
        $cuma2 = mysql_query("SELECT * FROM tour_agentreq
                    where IDProduct = $_POST[idcopy]");
        $jum2 = mysql_num_rows($cuma2);
        while($saja2 = mysql_fetch_array($cuma2)){
            mysql_query("INSERT INTO tour_agentreq(IDProduct,
                                            Category,
                                            Supplier,
                                            Description,
                                            QuotationCurrA,
                                            SellingCurrA,
                                            SellingOperatorA,
                                            SellingRateA,
                                            PaxA,
                                            QuoAdultA,
                                            SellAdultA,
                                            QuoChdTwnA,
                                            SellChdTwnA,
                                            QuoChdXbedA,
                                            SellChdXbedA,
                                            QuotationCurrB,
                                            SellingCurrB,
                                            SellingOperatorB,
                                            SellingRateB,
                                            PaxB,
                                            QuoAdultB,
                                            SellAdultB,
                                            QuoChdTwnB,
                                            SellChdTwnB,
                                            QuoChdXbedB,
                                            SellChdXbedB,
                                            QuotationCurrC,
                                            SellingCurrC,
                                            SellingOperatorC,
                                            SellingRateC,
                                            PaxC,
                                            QuoAdultC,
                                            SellAdultC,
                                            QuoChdTwnC,
                                            SellChdTwnC,
                                            QuoChdXbedC,
                                            SellChdXbedC) 
                                    VALUES ('$_POST[id]',
                                            '$saja2[Category]',
                                            '$saja2[Supplier]',
                                            '$saja2[Description]',
                                            '$saja2[QuotationCurrA]',
                                            '$saja2[SellingCurrA]',
                                            '$saja2[SellingOperatorA]',
                                            '$saja2[SellingRateA]',
                                            '$saja2[PaxA]',
                                            '$saja2[QuoAdultA]',
                                            '$saja2[SellAdultA]',
                                            '$saja2[QuoChdTwnA]',
                                            '$saja2[SellChdTwnA]',
                                            '$saja2[QuoChdXbedA]',
                                            '$saja2[SellChdXbedA]',
                                            '$saja2[QuotationCurrB]',
                                            '$saja2[SellingCurrB]',
                                            '$saja2[SellingOperatorB]',
                                            '$saja2[SellingRateB]',
                                            '$saja2[PaxB]',
                                            '$saja2[QuoAdultB]',
                                            '$saja2[SellAdultB]',
                                            '$saja2[QuoChdTwnB]',
                                            '$saja2[SellChdTwnB]',
                                            '$saja2[QuoChdXbedB]',
                                            '$saja2[SellChdXbedB]',
                                            '$saja2[QuotationCurrC]',
                                            '$saja2[SellingCurrC]',
                                            '$saja2[SellingOperatorC]',
                                            '$saja2[SellingRateC]',
                                            '$saja2[PaxC]',
                                            '$saja2[QuoAdultC]',
                                            '$saja2[SellAdultC]',
                                            '$saja2[QuoChdTwnC]',
                                            '$saja2[SellChdTwnC]',
                                            '$saja2[QuoChdXbedC]',
                                            '$saja2[SellChdXbedC]')");
        }
        $cuma3 = mysql_query("SELECT * FROM tour_msproductreq
                    where IDProduct = $_POST[idcopy]");
        $saja3 = mysql_fetch_array($cuma3);
        mysql_query("UPDATE tour_msproductreq set SellingAdlTwn = '$saja3[SellingAdlTwn]',
                                               SellingChdTwn = '$saja3[SellingChdTwn]',
                                               SellingChdNbed = '$saja3[SellingChdNbed]',
                                               SellingChdXbed = '$saja3[SellingChdXbed]',
                                               SellingInfant = '$saja3[SellingInfant]',
                                               LAAdlTwn = '$saja3[LAAdlTwn]',
                                               LAChdTwn = '$saja3[LAChdTwn]',
                                               LAChdNbed = '$saja3[LAChdNbed]',
                                               LAChdXbed = '$saja3[LAChdXbed]', 
                                               LAInfant = '$saja3[LAInfant]',  
                                               TaxInsNett = '$saja3[TaxInsNett]',
                                               TaxInsSell = '$saja3[TaxInsSell]',
                                               LandArrNett = '$saja3[LandArrNett]',
                                               LandArrSell = '$saja3[LandArrSell]',
                                               SingleNett = '$saja3[SingleNett]',
                                               SingleSell = '$saja3[SingleSell]', 
                                               VisaCurr = '$saja3[VisaCurr]',
                                               VisaNett = '$saja3[VisaNett]',
                                               VisaSell = '$saja3[VisaSell]',
                                               VisaCurr2 = '$saja3[VisaCurr2]',
                                               VisaNett2 = '$saja3[VisaNett2]',
                                               VisaSell2 = '$saja3[VisaSell2]',
                                               AirTaxCurr = '$saja3[AirTaxCurr]',
                                               AirTaxNett = '$saja3[AirTaxNett]',
                                               AirTaxSell = '$saja3[AirTaxSell]'
                    WHERE IDProduct = '$_POST[id]'");
        $Description="Update quotation TMR ID Product ($_POST[id]) from ID Product ($_POST[idcopy])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                               Description,
                               LogTime) 
                        VALUES ('$EmpName', 
                               '$Description', 
                               '$today')");
        header("location:media.php?module=msproduct&act=quotationtmr&no=$saja3[TmrNo]");
    }
// Input next target
    elseif ($module=='mstarget' AND $act=='input'){
        $neksyear=$_POST[neksyear];
        $disyear=$_POST[disyear];
        $naik=$_POST[incpersen];
        $operate=$_POST[operate];
        $naika=$_POST[incpersena];
        $operatea=$_POST[operatea];
        $cuma = mysql_query("SELECT * FROM tour_mstarget where TargetYear = '$disyear' ORDER BY TargetID ASC");
        while($saja = mysql_fetch_array($cuma)){
            if($operate=='+'){
                $nambahjan = $saja[JAN] *  $naik/100 ; $persenjan = $saja[JAN] + $nambahjan;
                $nambahfeb = $saja[FEB] *  $naik/100 ; $persenfeb = $saja[FEB] + $nambahfeb;
                $nambahmar = $saja[MAR] *  $naik/100 ; $persenmar = $saja[MAR] + $nambahmar;
                $nambahapr = $saja[APR] *  $naik/100 ; $persenapr = $saja[APR] + $nambahapr;
                $nambahmay = $saja[MAY] *  $naik/100 ; $persenmay = $saja[MAY] + $nambahmay;
                $nambahjun = $saja[JUN] *  $naik/100 ; $persenjun = $saja[JUN] + $nambahjun;
                $nambahjul = $saja[JUL] *  $naik/100 ; $persenjul = $saja[JUL] + $nambahjul;
                $nambahaug = $saja[AUG] *  $naik/100 ; $persenaug = $saja[AUG] + $nambahaug;
                $nambahsep = $saja[SEP] *  $naik/100 ; $persensep = $saja[SEP] + $nambahsep;
                $nambahoct = $saja[OCT] *  $naik/100 ; $persenoct = $saja[OCT] + $nambahoct;
                $nambahnov = $saja[NOV] *  $naik/100 ; $persennov = $saja[NOV] + $nambahnov;
                $nambahdes = $saja[DES] *  $naik/100 ; $persendes = $saja[DES] + $nambahdes;
            }else if($operate=='-'){
                $nambahjan = $saja[JAN] *  $naik/100 ; $persenjan = $saja[JAN] - $nambahjan;
                $nambahfeb = $saja[FEB] *  $naik/100 ; $persenfeb = $saja[FEB] - $nambahfeb;
                $nambahmar = $saja[MAR] *  $naik/100 ; $persenmar = $saja[MAR] - $nambahmar;
                $nambahapr = $saja[APR] *  $naik/100 ; $persenapr = $saja[APR] - $nambahapr;
                $nambahmay = $saja[MAY] *  $naik/100 ; $persenmay = $saja[MAY] - $nambahmay;
                $nambahjun = $saja[JUN] *  $naik/100 ; $persenjun = $saja[JUN] - $nambahjun;
                $nambahjul = $saja[JUL] *  $naik/100 ; $persenjul = $saja[JUL] - $nambahjul;
                $nambahaug = $saja[AUG] *  $naik/100 ; $persenaug = $saja[AUG] - $nambahaug;
                $nambahsep = $saja[SEP] *  $naik/100 ; $persensep = $saja[SEP] - $nambahsep;
                $nambahoct = $saja[OCT] *  $naik/100 ; $persenoct = $saja[OCT] - $nambahoct;
                $nambahnov = $saja[NOV] *  $naik/100 ; $persennov = $saja[NOV] - $nambahnov;
                $nambahdes = $saja[DES] *  $naik/100 ; $persendes = $saja[DES] - $nambahdes;
            }
            if($operatea=='+'){
                $nambahjana = $saja[JANA] *  $naika/100 ; $persenjana = $saja[JANA] + $nambahjana;
                $nambahfeba = $saja[FEBA] *  $naika/100 ; $persenfeba = $saja[FEBA] + $nambahfeba;
                $nambahmara = $saja[MARA] *  $naika/100 ; $persenmara = $saja[MARA] + $nambahmara;
                $nambahapra = $saja[APRA] *  $naika/100 ; $persenapra = $saja[APRA] + $nambahapra;
                $nambahmaya = $saja[MAYA] *  $naika/100 ; $persenmaya = $saja[MAYA] + $nambahmaya;
                $nambahjuna = $saja[JUNA] *  $naika/100 ; $persenjuna = $saja[JUNA] + $nambahjuna;
                $nambahjula = $saja[JULA] *  $naika/100 ; $persenjula = $saja[JULA] + $nambahjula;
                $nambahauga = $saja[AUGA] *  $naika/100 ; $persenauga = $saja[AUGA] + $nambahauga;
                $nambahsepa = $saja[SEPA] *  $naika/100 ; $persensepa = $saja[SEPA] + $nambahsepa;
                $nambahocta = $saja[OCTA] *  $naika/100 ; $persenocta = $saja[OCTA] + $nambahocta;
                $nambahnova = $saja[NOVA] *  $naika/100 ; $persennova = $saja[NOVA] + $nambahnova;
                $nambahdesa = $saja[DESA] *  $naika/100 ; $persendesa = $saja[DESA] + $nambahdesa;
            }else if($operatea=='-'){
                $nambahjana = $saja[JANA] *  $naika/100 ; $persenjana = $saja[JANA] - $nambahjana;
                $nambahfeba = $saja[FEBA] *  $naika/100 ; $persenfeba = $saja[FEBA] - $nambahfeba;
                $nambahmara = $saja[MARA] *  $naika/100 ; $persenmara = $saja[MARA] - $nambahmara;
                $nambahapra = $saja[APRA] *  $naika/100 ; $persenapra = $saja[APRA] - $nambahapra;
                $nambahmaya = $saja[MAYA] *  $naika/100 ; $persenmaya = $saja[MAYA] - $nambahmaya;
                $nambahjuna = $saja[JUNA] *  $naika/100 ; $persenjuna = $saja[JUNA] - $nambahjuna;
                $nambahjula = $saja[JULA] *  $naika/100 ; $persenjula = $saja[JULA] - $nambahjula;
                $nambahauga = $saja[AUGA] *  $naika/100 ; $persenauga = $saja[AUGA] - $nambahauga;
                $nambahsepa = $saja[SEPA] *  $naika/100 ; $persensepa = $saja[SEPA] - $nambahsepa;
                $nambahocta = $saja[OCTA] *  $naika/100 ; $persenocta = $saja[OCTA] - $nambahocta;
                $nambahnova = $saja[NOVA] *  $naika/100 ; $persennova = $saja[NOVA] - $nambahnova;
                $nambahdesa = $saja[DESA] *  $naika/100 ; $persendesa = $saja[DESA] - $nambahdesa;
            }
            mysql_query("INSERT INTO tour_mstarget(TargetBSO,TargetYear,TargetOperate,TargetIncrease,JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DES,TargetOperateA,TargetIncreaseA,JANA,FEBA,MARA,APRA,MAYA,JUNA,JULA,AUGA,SEPA,OCTA,NOVA,DESA)
                            VALUES ('$saja[TargetBSO]','$neksyear','$operate','$naik','$persenjan','$persenfeb','$persenmar','$persenapr','$persenmay','$persenjun','$persenjul',
                            '$persenaug','$persensep','$persenoct','$persennov','$persendes','$operatea','$naika','$persenjana','$persenfeba','$persenmara','$persenapra','$persenmaya','$persenjuna','$persenjula',
                            '$persenauga','$persensepa','$persenocta','$persennova','$persendesa')");
        }
        $qrb = mysql_query("SELECT * FROM tour_rate where RateYear = '$disyear'");
        $isiqrb = mysql_fetch_array($qrb);
        $thn=$neksyear;
        $jan=$isiqrb[JAN];$jul=$isiqrb[JUL];
        $feb=$isiqrb[FEB];$aug=$isiqrb[AUG];
        $mar=$isiqrb[MAR];$sep=$isiqrb[SEP];
        $apr=$isiqrb[APR];$oct=$isiqrb[OCT];
        $may=$isiqrb[MAY];$nov=$isiqrb[NOV];
        $jun=$isiqrb[JUN];$des=$isiqrb[DES];
        mysql_query("INSERT INTO tour_rate(RateYear,JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DES)
                            VALUES ('$thn','$jan','$feb','$mar','$apr','$may','$jun','$jul',
                            '$aug','$sep','$oct','$nov','$des')");
        $Description="Input Target POS ($neksyear)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module=mstarget');
    }
// Input neew bso target
    elseif ($module=='mstarget' AND $act=='insertbso'){
        $thn=$_POST[thn];
        $jan=$_POST[jan];$jul=$_POST[jul];
        $feb=$_POST[feb];$aug=$_POST[aug];
        $mar=$_POST[mar];$sep=$_POST[sep];
        $apr=$_POST[apr];$oct=$_POST[oct];
        $may=$_POST[may];$nov=$_POST[nov];
        $jun=$_POST[jun];$des=$_POST[des];
        $jana=$_POST[jana];$jula=$_POST[jula];
        $feba=$_POST[feba];$auga=$_POST[auga];
        $mara=$_POST[mara];$sepa=$_POST[sepa];
        $apra=$_POST[apra];$octa=$_POST[octa];
        $maya=$_POST[maya];$nova=$_POST[nova];
        $juna=$_POST[juna];$desa=$_POST[desa];
        mysql_query("INSERT INTO tour_mstarget(TargetBSO,TargetYear,TargetOperate,TargetIncrease,JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DES,TargetOperateA,TargetIncreaseA,JANA,FEBA,MARA,APRA,MAYA,JUNA,JULA,AUGA,SEPA,OCTA,NOVA,DESA)
                            VALUES ('$_POST[targetbso]','$thn','+','0','$jan','$feb','$mar','$apr','$may','$jun','$jul',
                            '$aug','$sep','$oct','$nov','$des','+','0','$jana','$feba','$mara','$apra','$maya','$juna','$jula',
                            '$auga','$sepa','$octa','$nova','$desa')");
        $cuma = mysql_query("SELECT * FROM tour_mstarget where TargetYear > '$thn' group by TargetYear ORDER BY TargetID ASC");
        while($saja = mysql_fetch_array($cuma)){
            if($saja[TargetOperate]=='+'){
                $nambahjan = $jan *  $saja[targetIncrease]/100 ; $persenjan = $jan + $nambahjan;
                $nambahfeb = $feb *  $saja[targetIncrease]/100 ; $persenfeb = $feb + $nambahfeb;
                $nambahmar = $mar *  $saja[targetIncrease]/100 ; $persenmar = $mar + $nambahmar;
                $nambahapr = $apr *  $saja[targetIncrease]/100 ; $persenapr = $apr + $nambahapr;
                $nambahmay = $may *  $saja[targetIncrease]/100 ; $persenmay = $may + $nambahmay;
                $nambahjun = $jun *  $saja[targetIncrease]/100 ; $persenjun = $jun + $nambahjun;
                $nambahjul = $jul *  $saja[targetIncrease]/100 ; $persenjul = $jul + $nambahjul;
                $nambahaug = $aug *  $saja[targetIncrease]/100 ; $persenaug = $aug + $nambahaug;
                $nambahsep = $sep *  $saja[targetIncrease]/100 ; $persensep = $sep + $nambahsep;
                $nambahoct = $oct *  $saja[targetIncrease]/100 ; $persenoct = $oct + $nambahoct;
                $nambahnov = $nov *  $saja[targetIncrease]/100 ; $persennov = $nov + $nambahnov;
                $nambahdes = $des *  $saja[targetIncrease]/100 ; $persendes = $des + $nambahdes;
            }else if($saja[TargetOperate]=='-'){
                $nambahjan = $jan *  $saja[targetIncrease]/100 ; $persenjan = $jan - $nambahjan;
                $nambahfeb = $feb *  $saja[targetIncrease]/100 ; $persenfeb = $feb - $nambahfeb;
                $nambahmar = $mar *  $saja[targetIncrease]/100 ; $persenmar = $mar - $nambahmar;
                $nambahapr = $apr *  $saja[targetIncrease]/100 ; $persenapr = $apr - $nambahapr;
                $nambahmay = $may *  $saja[targetIncrease]/100 ; $persenmay = $may - $nambahmay;
                $nambahjun = $jun *  $saja[targetIncrease]/100 ; $persenjun = $jun - $nambahjun;
                $nambahjul = $jul *  $saja[targetIncrease]/100 ; $persenjul = $jul - $nambahjul;
                $nambahaug = $aug *  $saja[targetIncrease]/100 ; $persenaug = $aug - $nambahaug;
                $nambahsep = $sep *  $saja[targetIncrease]/100 ; $persensep = $sep - $nambahsep;
                $nambahoct = $oct *  $saja[targetIncrease]/100 ; $persenoct = $oct - $nambahoct;
                $nambahnov = $nov *  $saja[targetIncrease]/100 ; $persennov = $nov - $nambahnov;
                $nambahdes = $des *  $saja[targetIncrease]/100 ; $persendes = $des - $nambahdes;
            }
            if($saja[TargetOperateA]=='+'){
                $nambahjana = $jana *  $saja[targetIncreaseA]/100 ; $persenjana = $jana + $nambahjana;
                $nambahfeba = $feba *  $saja[targetIncreaseA]/100 ; $persenfeba = $feba + $nambahfeba;
                $nambahmara = $mara *  $saja[targetIncreaseA]/100 ; $persenmara = $mara + $nambahmara;
                $nambahapra = $apra *  $saja[targetIncreaseA]/100 ; $persenapra = $apra + $nambahapra;
                $nambahmaya = $maya *  $saja[targetIncreaseA]/100 ; $persenmaya = $maya + $nambahmaya;
                $nambahjuna = $juna *  $saja[targetIncreaseA]/100 ; $persenjuna = $juna + $nambahjuna;
                $nambahjula = $jula *  $saja[targetIncreaseA]/100 ; $persenjula = $jula + $nambahjula;
                $nambahauga = $auga *  $saja[targetIncreaseA]/100 ; $persenauga = $auga + $nambahauga;
                $nambahsepa = $sepa *  $saja[targetIncreaseA]/100 ; $persensepa = $sepa + $nambahsepa;
                $nambahocta = $octa *  $saja[targetIncreaseA]/100 ; $persenocta = $octa + $nambahocta;
                $nambahnova = $nova *  $saja[targetIncreaseA]/100 ; $persennova = $nova + $nambahnova;
                $nambahdesa = $desa *  $saja[targetIncreaseA]/100 ; $persendesa = $desa + $nambahdesa;
            }else if($saja[TargetOperateA]=='-'){
                $nambahjana = $jana *  $saja[targetIncreaseA]/100 ; $persenjana = $jana - $nambahjana;
                $nambahfeba = $feba *  $saja[targetIncreaseA]/100 ; $persenfeba = $feba - $nambahfeba;
                $nambahmara = $mara *  $saja[targetIncreaseA]/100 ; $persenmara = $mara - $nambahmara;
                $nambahapra = $apra *  $saja[targetIncreaseA]/100 ; $persenapra = $apra - $nambahapra;
                $nambahmaya = $maya *  $saja[targetIncreaseA]/100 ; $persenmaya = $maya - $nambahmaya;
                $nambahjuna = $juna *  $saja[targetIncreaseA]/100 ; $persenjuna = $juna - $nambahjuna;
                $nambahjula = $jula *  $saja[targetIncreaseA]/100 ; $persenjula = $jula - $nambahjula;
                $nambahauga = $auga *  $saja[targetIncreaseA]/100 ; $persenauga = $auga - $nambahauga;
                $nambahsepa = $sepa *  $saja[targetIncreaseA]/100 ; $persensepa = $sepa - $nambahsepa;
                $nambahocta = $octa *  $saja[targetIncreaseA]/100 ; $persenocta = $octa - $nambahocta;
                $nambahnova = $nova *  $saja[targetIncreaseA]/100 ; $persennova = $nova - $nambahnova;
                $nambahdesa = $desa *  $saja[targetIncreaseA]/100 ; $persendesa = $desa - $nambahdesa;
            }
            mysql_query("INSERT INTO tour_mstarget(TargetBSO,TargetYear,TargetOperate,TargetIncrease,JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DES,TargetOperateA,TargetIncreaseA,JANA,FEBA,MARA,APRA,MAYA,JUNA,JULA,AUGA,SEPA,OCTA,NOVA,DESA)
                            VALUES ('$_POST[targetbso]','$saja[TargetYear]','$saja[TargetOperate]','$saja[TargetIncrease]','$persenjan','$persenfeb','$persenmar','$persenapr','$persenmay','$persenjun','$persenjul',
                            '$persenaug','$persensep','$persenoct','$persennov','$persendes','$saja[TargetOperateA]','$saja[TargetIncreaseA]','$persenjana','$persenfeba','$persenmara','$persenapra','$persenmaya','$persenjuna','$persenjula',
                            '$persenauga','$persensepa','$persenocta','$persennova','$persendesa')");
        }
        $Description="Input new pos target ($_POST[targetbso])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module=mstarget');
    }
// update target
    elseif ($module=='mstarget' AND $act=='update'){

        mysql_query("UPDATE tour_mstarget set TargetIncrease = '0',
                                             JAN = '$_POST[jan]',
                                             FEB = '$_POST[feb]',
                                             MAR = '$_POST[mar]',
                                             APR = '$_POST[apr]',
                                             MAY = '$_POST[may]',
                                             JUN = '$_POST[jun]',
                                             JUL = '$_POST[jul]',
                                             AUG = '$_POST[aug]',
                                             SEP = '$_POST[sep]',
                                             OCT = '$_POST[oct]',
                                             NOV = '$_POST[nov]',
                                             DES = '$_POST[des]',
                                             TargetIncreaseA = '0',
                                             JANA = '$_POST[jana]',
                                             FEBA = '$_POST[feba]',
                                             MARA = '$_POST[mara]',
                                             APRA = '$_POST[apra]',
                                             MAYA = '$_POST[maya]',
                                             JUNA = '$_POST[juna]',
                                             JULA = '$_POST[jula]',
                                             AUGA = '$_POST[auga]',
                                             SEPA = '$_POST[sepa]',
                                             OCTA = '$_POST[octa]',
                                             NOVA = '$_POST[nova]',
                                             DESA = '$_POST[desa]'   
                    WHERE TargetID = '$_POST[id]'");
        $Description="Update Target ID ($_POST[id])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                               Description,
                               LogTime) 
                        VALUES ('$EmpName', 
                               '$Description', 
                               '$today')");
        header("location:media.php?module=mstarget&targetyear=$_POST[thn]");
    }
// Input new rate
    elseif ($module=='msrate' AND $act=='input'){
        $thn=$_POST[thn];
        $jan=$_POST[jan];$jul=$_POST[jul];
        $feb=$_POST[feb];$aug=$_POST[aug];
        $mar=$_POST[mar];$sep=$_POST[sep];
        $apr=$_POST[apr];$oct=$_POST[oct];
        $may=$_POST[may];$nov=$_POST[nov];
        $jun=$_POST[jun];$des=$_POST[des];
        mysql_query("INSERT INTO tour_rate(RateYear,JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DES)
                            VALUES ('$thn','$jan','$feb','$mar','$apr','$may','$jun','$jul',
                            '$aug','$sep','$oct','$nov','$des')");

        $Description="Insert Rate ($thn)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module=mstarget');
    }
// update rate
    elseif ($module=='msrate' AND $act=='update'){
        mysql_query("UPDATE tour_rate set JAN = '$_POST[jan]',
                                             FEB = '$_POST[feb]',
                                             MAR = '$_POST[mar]',
                                             APR = '$_POST[apr]',
                                             MAY = '$_POST[may]',
                                             JUN = '$_POST[jun]',
                                             JUL = '$_POST[jul]',
                                             AUG = '$_POST[aug]',
                                             SEP = '$_POST[sep]',
                                             OCT = '$_POST[oct]',
                                             NOV = '$_POST[nov]',
                                             DES = '$_POST[des]'  
                    WHERE RateID = '$_POST[id]'");
        $Description="Update Rate ($_POST[thn])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                               Description,
                               LogTime) 
                        VALUES ('$EmpName', 
                               '$Description', 
                               '$today')");
        header("location:media.php?module=mstarget&targetyear=$_POST[thn]");
    }
// Input next target PW
    elseif ($module=='mstargetpw' AND $act=='input'){
        $neksyear=$_POST[neksyear];
        $disyear=$_POST[disyear];
        $naik=$_POST[incpersen];
        $operate=$_POST[operate];
        $naika=$_POST[incpersena];
        $operatea=$_POST[operatea];
        $cuma = mysql_query("SELECT * FROM tour_mstargetpw where TargetYear = '$disyear' ORDER BY TargetID ASC");
        while($saja = mysql_fetch_array($cuma)){
            if($operate=='+'){
                $nambahjan = $saja[JAN] *  $naik/100 ; $persenjan = $saja[JAN] + $nambahjan;
                $nambahfeb = $saja[FEB] *  $naik/100 ; $persenfeb = $saja[FEB] + $nambahfeb;
                $nambahmar = $saja[MAR] *  $naik/100 ; $persenmar = $saja[MAR] + $nambahmar;
                $nambahapr = $saja[APR] *  $naik/100 ; $persenapr = $saja[APR] + $nambahapr;
                $nambahmay = $saja[MAY] *  $naik/100 ; $persenmay = $saja[MAY] + $nambahmay;
                $nambahjun = $saja[JUN] *  $naik/100 ; $persenjun = $saja[JUN] + $nambahjun;
                $nambahjul = $saja[JUL] *  $naik/100 ; $persenjul = $saja[JUL] + $nambahjul;
                $nambahaug = $saja[AUG] *  $naik/100 ; $persenaug = $saja[AUG] + $nambahaug;
                $nambahsep = $saja[SEP] *  $naik/100 ; $persensep = $saja[SEP] + $nambahsep;
                $nambahoct = $saja[OCT] *  $naik/100 ; $persenoct = $saja[OCT] + $nambahoct;
                $nambahnov = $saja[NOV] *  $naik/100 ; $persennov = $saja[NOV] + $nambahnov;
                $nambahdes = $saja[DES] *  $naik/100 ; $persendes = $saja[DES] + $nambahdes;
            }else if($operate=='-'){
                $nambahjan = $saja[JAN] *  $naik/100 ; $persenjan = $saja[JAN] - $nambahjan;
                $nambahfeb = $saja[FEB] *  $naik/100 ; $persenfeb = $saja[FEB] - $nambahfeb;
                $nambahmar = $saja[MAR] *  $naik/100 ; $persenmar = $saja[MAR] - $nambahmar;
                $nambahapr = $saja[APR] *  $naik/100 ; $persenapr = $saja[APR] - $nambahapr;
                $nambahmay = $saja[MAY] *  $naik/100 ; $persenmay = $saja[MAY] - $nambahmay;
                $nambahjun = $saja[JUN] *  $naik/100 ; $persenjun = $saja[JUN] - $nambahjun;
                $nambahjul = $saja[JUL] *  $naik/100 ; $persenjul = $saja[JUL] - $nambahjul;
                $nambahaug = $saja[AUG] *  $naik/100 ; $persenaug = $saja[AUG] - $nambahaug;
                $nambahsep = $saja[SEP] *  $naik/100 ; $persensep = $saja[SEP] - $nambahsep;
                $nambahoct = $saja[OCT] *  $naik/100 ; $persenoct = $saja[OCT] - $nambahoct;
                $nambahnov = $saja[NOV] *  $naik/100 ; $persennov = $saja[NOV] - $nambahnov;
                $nambahdes = $saja[DES] *  $naik/100 ; $persendes = $saja[DES] - $nambahdes;
            }
            if($operatea=='+'){
                $nambahjana = $saja[JANA] *  $naika/100 ; $persenjana = $saja[JANA] + $nambahjana;
                $nambahfeba = $saja[FEBA] *  $naika/100 ; $persenfeba = $saja[FEBA] + $nambahfeba;
                $nambahmara = $saja[MARA] *  $naika/100 ; $persenmara = $saja[MARA] + $nambahmara;
                $nambahapra = $saja[APRA] *  $naika/100 ; $persenapra = $saja[APRA] + $nambahapra;
                $nambahmaya = $saja[MAYA] *  $naika/100 ; $persenmaya = $saja[MAYA] + $nambahmaya;
                $nambahjuna = $saja[JUNA] *  $naika/100 ; $persenjuna = $saja[JUNA] + $nambahjuna;
                $nambahjula = $saja[JULA] *  $naika/100 ; $persenjula = $saja[JULA] + $nambahjula;
                $nambahauga = $saja[AUGA] *  $naika/100 ; $persenauga = $saja[AUGA] + $nambahauga;
                $nambahsepa = $saja[SEPA] *  $naika/100 ; $persensepa = $saja[SEPA] + $nambahsepa;
                $nambahocta = $saja[OCTA] *  $naika/100 ; $persenocta = $saja[OCTA] + $nambahocta;
                $nambahnova = $saja[NOVA] *  $naika/100 ; $persennova = $saja[NOVA] + $nambahnova;
                $nambahdesa = $saja[DESA] *  $naika/100 ; $persendesa = $saja[DESA] + $nambahdesa;
            }else if($operatea=='-'){
                $nambahjana = $saja[JANA] *  $naika/100 ; $persenjana = $saja[JANA] - $nambahjana;
                $nambahfeba = $saja[FEBA] *  $naika/100 ; $persenfeba = $saja[FEBA] - $nambahfeba;
                $nambahmara = $saja[MARA] *  $naika/100 ; $persenmara = $saja[MARA] - $nambahmara;
                $nambahapra = $saja[APRA] *  $naika/100 ; $persenapra = $saja[APRA] - $nambahapra;
                $nambahmaya = $saja[MAYA] *  $naika/100 ; $persenmaya = $saja[MAYA] - $nambahmaya;
                $nambahjuna = $saja[JUNA] *  $naika/100 ; $persenjuna = $saja[JUNA] - $nambahjuna;
                $nambahjula = $saja[JULA] *  $naika/100 ; $persenjula = $saja[JULA] - $nambahjula;
                $nambahauga = $saja[AUGA] *  $naika/100 ; $persenauga = $saja[AUGA] - $nambahauga;
                $nambahsepa = $saja[SEPA] *  $naika/100 ; $persensepa = $saja[SEPA] - $nambahsepa;
                $nambahocta = $saja[OCTA] *  $naika/100 ; $persenocta = $saja[OCTA] - $nambahocta;
                $nambahnova = $saja[NOVA] *  $naika/100 ; $persennova = $saja[NOVA] - $nambahnova;
                $nambahdesa = $saja[DESA] *  $naika/100 ; $persendesa = $saja[DESA] - $nambahdesa;
            }
            mysql_query("INSERT INTO tour_mstargetpw(TargetBSO,TargetYear,TargetOperate,TargetIncrease,JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DES,TargetOperateA,TargetIncreaseA,JANA,FEBA,MARA,APRA,MAYA,JUNA,JULA,AUGA,SEPA,OCTA,NOVA,DESA)
                            VALUES ('$saja[TargetBSO]','$neksyear','$operate','$naik','$persenjan','$persenfeb','$persenmar','$persenapr','$persenmay','$persenjun','$persenjul',
                            '$persenaug','$persensep','$persenoct','$persennov','$persendes','$operatea','$naika','$persenjana','$persenfeba','$persenmara','$persenapra','$persenmaya','$persenjuna','$persenjula',
                            '$persenauga','$persensepa','$persenocta','$persennova','$persendesa')");
        }
        $qrb = mysql_query("SELECT * FROM tour_rate where RateYear = '$disyear'");
        $isiqrb = mysql_fetch_array($qrb);
        $thn=$neksyear;
        $jan=$isiqrb[JAN];$jul=$isiqrb[JUL];
        $feb=$isiqrb[FEB];$aug=$isiqrb[AUG];
        $mar=$isiqrb[MAR];$sep=$isiqrb[SEP];
        $apr=$isiqrb[APR];$oct=$isiqrb[OCT];
        $may=$isiqrb[MAY];$nov=$isiqrb[NOV];
        $jun=$isiqrb[JUN];$des=$isiqrb[DES];
        mysql_query("INSERT INTO tour_rate(RateYear,JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DES)
                            VALUES ('$thn','$jan','$feb','$mar','$apr','$may','$jun','$jul',
                            '$aug','$sep','$oct','$nov','$des')");
        $Description="Input Target PW ($neksyear)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module=mstargetpw');
    }
// Input new pw target
    elseif ($module=='mstargetpw' AND $act=='insertpw'){
        $thn=$_POST[thn];
        $jan=$_POST[jan];$jul=$_POST[jul];
        $feb=$_POST[feb];$aug=$_POST[aug];
        $mar=$_POST[mar];$sep=$_POST[sep];
        $apr=$_POST[apr];$oct=$_POST[oct];
        $may=$_POST[may];$nov=$_POST[nov];
        $jun=$_POST[jun];$des=$_POST[des];
        $jana=$_POST[jana];$jula=$_POST[jula];
        $feba=$_POST[feba];$auga=$_POST[auga];
        $mara=$_POST[mara];$sepa=$_POST[sepa];
        $apra=$_POST[apra];$octa=$_POST[octa];
        $maya=$_POST[maya];$nova=$_POST[nova];
        $juna=$_POST[juna];$desa=$_POST[desa];
        mysql_query("INSERT INTO tour_mstargetpw(TargetBSO,TargetYear,TargetOperate,TargetIncrease,JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DES,TargetOperateA,TargetIncreaseA,JANA,FEBA,MARA,APRA,MAYA,JUNA,JULA,AUGA,SEPA,OCTA,NOVA,DESA)
                            VALUES ('$_POST[targetpw]','$thn','+','0','$jan','$feb','$mar','$apr','$may','$jun','$jul',
                            '$aug','$sep','$oct','$nov','$des','+','0','$jana','$feba','$mara','$apra','$maya','$juna','$jula',
                            '$auga','$sepa','$octa','$nova','$desa')");
        $cuma = mysql_query("SELECT * FROM tour_mstargetpw where TargetYear > '$thn' group by TargetYear ORDER BY TargetID ASC");
        while($saja = mysql_fetch_array($cuma)){
            if($saja[TargetOperate]=='+'){
                $nambahjan = $jan *  $saja[targetIncrease]/100 ; $persenjan = $jan + $nambahjan;
                $nambahfeb = $feb *  $saja[targetIncrease]/100 ; $persenfeb = $feb + $nambahfeb;
                $nambahmar = $mar *  $saja[targetIncrease]/100 ; $persenmar = $mar + $nambahmar;
                $nambahapr = $apr *  $saja[targetIncrease]/100 ; $persenapr = $apr + $nambahapr;
                $nambahmay = $may *  $saja[targetIncrease]/100 ; $persenmay = $may + $nambahmay;
                $nambahjun = $jun *  $saja[targetIncrease]/100 ; $persenjun = $jun + $nambahjun;
                $nambahjul = $jul *  $saja[targetIncrease]/100 ; $persenjul = $jul + $nambahjul;
                $nambahaug = $aug *  $saja[targetIncrease]/100 ; $persenaug = $aug + $nambahaug;
                $nambahsep = $sep *  $saja[targetIncrease]/100 ; $persensep = $sep + $nambahsep;
                $nambahoct = $oct *  $saja[targetIncrease]/100 ; $persenoct = $oct + $nambahoct;
                $nambahnov = $nov *  $saja[targetIncrease]/100 ; $persennov = $nov + $nambahnov;
                $nambahdes = $des *  $saja[targetIncrease]/100 ; $persendes = $des + $nambahdes;
            }else if($saja[TargetOperate]=='-'){
                $nambahjan = $jan *  $saja[targetIncrease]/100 ; $persenjan = $jan - $nambahjan;
                $nambahfeb = $feb *  $saja[targetIncrease]/100 ; $persenfeb = $feb - $nambahfeb;
                $nambahmar = $mar *  $saja[targetIncrease]/100 ; $persenmar = $mar - $nambahmar;
                $nambahapr = $apr *  $saja[targetIncrease]/100 ; $persenapr = $apr - $nambahapr;
                $nambahmay = $may *  $saja[targetIncrease]/100 ; $persenmay = $may - $nambahmay;
                $nambahjun = $jun *  $saja[targetIncrease]/100 ; $persenjun = $jun - $nambahjun;
                $nambahjul = $jul *  $saja[targetIncrease]/100 ; $persenjul = $jul - $nambahjul;
                $nambahaug = $aug *  $saja[targetIncrease]/100 ; $persenaug = $aug - $nambahaug;
                $nambahsep = $sep *  $saja[targetIncrease]/100 ; $persensep = $sep - $nambahsep;
                $nambahoct = $oct *  $saja[targetIncrease]/100 ; $persenoct = $oct - $nambahoct;
                $nambahnov = $nov *  $saja[targetIncrease]/100 ; $persennov = $nov - $nambahnov;
                $nambahdes = $des *  $saja[targetIncrease]/100 ; $persendes = $des - $nambahdes;
            }
            if($saja[TargetOperateA]=='+'){
                $nambahjana = $jana *  $saja[targetIncreaseA]/100 ; $persenjana = $jana + $nambahjana;
                $nambahfeba = $feba *  $saja[targetIncreaseA]/100 ; $persenfeba = $feba + $nambahfeba;
                $nambahmara = $mara *  $saja[targetIncreaseA]/100 ; $persenmara = $mara + $nambahmara;
                $nambahapra = $apra *  $saja[targetIncreaseA]/100 ; $persenapra = $apra + $nambahapra;
                $nambahmaya = $maya *  $saja[targetIncreaseA]/100 ; $persenmaya = $maya + $nambahmaya;
                $nambahjuna = $juna *  $saja[targetIncreaseA]/100 ; $persenjuna = $juna + $nambahjuna;
                $nambahjula = $jula *  $saja[targetIncreaseA]/100 ; $persenjula = $jula + $nambahjula;
                $nambahauga = $auga *  $saja[targetIncreaseA]/100 ; $persenauga = $auga + $nambahauga;
                $nambahsepa = $sepa *  $saja[targetIncreaseA]/100 ; $persensepa = $sepa + $nambahsepa;
                $nambahocta = $octa *  $saja[targetIncreaseA]/100 ; $persenocta = $octa + $nambahocta;
                $nambahnova = $nova *  $saja[targetIncreaseA]/100 ; $persennova = $nova + $nambahnova;
                $nambahdesa = $desa *  $saja[targetIncreaseA]/100 ; $persendesa = $desa + $nambahdesa;
            }else if($saja[TargetOperateA]=='-'){
                $nambahjana = $jana *  $saja[targetIncreaseA]/100 ; $persenjana = $jana - $nambahjana;
                $nambahfeba = $feba *  $saja[targetIncreaseA]/100 ; $persenfeba = $feba - $nambahfeba;
                $nambahmara = $mara *  $saja[targetIncreaseA]/100 ; $persenmara = $mara - $nambahmara;
                $nambahapra = $apra *  $saja[targetIncreaseA]/100 ; $persenapra = $apra - $nambahapra;
                $nambahmaya = $maya *  $saja[targetIncreaseA]/100 ; $persenmaya = $maya - $nambahmaya;
                $nambahjuna = $juna *  $saja[targetIncreaseA]/100 ; $persenjuna = $juna - $nambahjuna;
                $nambahjula = $jula *  $saja[targetIncreaseA]/100 ; $persenjula = $jula - $nambahjula;
                $nambahauga = $auga *  $saja[targetIncreaseA]/100 ; $persenauga = $auga - $nambahauga;
                $nambahsepa = $sepa *  $saja[targetIncreaseA]/100 ; $persensepa = $sepa - $nambahsepa;
                $nambahocta = $octa *  $saja[targetIncreaseA]/100 ; $persenocta = $octa - $nambahocta;
                $nambahnova = $nova *  $saja[targetIncreaseA]/100 ; $persennova = $nova - $nambahnova;
                $nambahdesa = $desa *  $saja[targetIncreaseA]/100 ; $persendesa = $desa - $nambahdesa;
            }
            mysql_query("INSERT INTO tour_mstargetpw(TargetBSO,TargetYear,TargetOperate,TargetIncrease,JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DES,TargetOperateA,TargetIncreaseA,JANA,FEBA,MARA,APRA,MAYA,JUNA,JULA,AUGA,SEPA,OCTA,NOVA,DESA)
                            VALUES ('$_POST[targetpw]','$saja[TargetYear]','$saja[TargetOperate]','$saja[TargetIncrease]','$persenjan','$persenfeb','$persenmar','$persenapr','$persenmay','$persenjun','$persenjul',
                            '$persenaug','$persensep','$persenoct','$persennov','$persendes','$saja[TargetOperateA]','$saja[TargetIncreaseA]','$persenjana','$persenfeba','$persenmara','$persenapra','$persenmaya','$persenjuna','$persenjula',
                            '$persenauga','$persensepa','$persenocta','$persennova','$persendesa')");
        }
        $Description="Input new pw target ($_POST[targetpw])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module=mstargetpw');
    }
// update target
    elseif ($module=='mstargetpw' AND $act=='update'){

        mysql_query("UPDATE tour_mstargetpw set TargetIncrease = '0',
                                             JAN = '$_POST[jan]',
                                             FEB = '$_POST[feb]',
                                             MAR = '$_POST[mar]',
                                             APR = '$_POST[apr]',
                                             MAY = '$_POST[may]',
                                             JUN = '$_POST[jun]',
                                             JUL = '$_POST[jul]',
                                             AUG = '$_POST[aug]',
                                             SEP = '$_POST[sep]',
                                             OCT = '$_POST[oct]',
                                             NOV = '$_POST[nov]',
                                             DES = '$_POST[des]',
                                             TargetIncreaseA = '0',
                                             JANA = '$_POST[jana]',
                                             FEBA = '$_POST[feba]',
                                             MARA = '$_POST[mara]',
                                             APRA = '$_POST[apra]',
                                             MAYA = '$_POST[maya]',
                                             JUNA = '$_POST[juna]',
                                             JULA = '$_POST[jula]',
                                             AUGA = '$_POST[auga]',
                                             SEPA = '$_POST[sepa]',
                                             OCTA = '$_POST[octa]',
                                             NOVA = '$_POST[nova]',
                                             DESA = '$_POST[desa]'   
                    WHERE TargetID = '$_POST[id]'");
        $Description="Update Target ID ($_POST[id])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                               Description,
                               LogTime) 
                        VALUES ('$EmpName', 
                               '$Description', 
                               '$today')");
        header("location:media.php?module=mstargetpw&targetyear=$_POST[thn]");
    }
//Input next target PO
    elseif ($module=='mstargetpo' AND $act=='input'){
        $neksyear=$_POST[neksyear];
        $disyear=$_POST[disyear];
        $naik=$_POST[incpersen];
        $operate=$_POST[operate];
        $naika=$_POST[incpersena];
        $operatea=$_POST[operatea];
        $cuma = mysql_query("SELECT * FROM tour_mstargetpo where TargetYear = '$disyear' ORDER BY TargetID ASC");
        while($saja = mysql_fetch_array($cuma)){
            if($operate=='+'){
                $nambahjan = $saja[JAN] *  $naik/100 ; $persenjan = $saja[JAN] + $nambahjan;
                $nambahfeb = $saja[FEB] *  $naik/100 ; $persenfeb = $saja[FEB] + $nambahfeb;
                $nambahmar = $saja[MAR] *  $naik/100 ; $persenmar = $saja[MAR] + $nambahmar;
                $nambahapr = $saja[APR] *  $naik/100 ; $persenapr = $saja[APR] + $nambahapr;
                $nambahmay = $saja[MAY] *  $naik/100 ; $persenmay = $saja[MAY] + $nambahmay;
                $nambahjun = $saja[JUN] *  $naik/100 ; $persenjun = $saja[JUN] + $nambahjun;
                $nambahjul = $saja[JUL] *  $naik/100 ; $persenjul = $saja[JUL] + $nambahjul;
                $nambahaug = $saja[AUG] *  $naik/100 ; $persenaug = $saja[AUG] + $nambahaug;
                $nambahsep = $saja[SEP] *  $naik/100 ; $persensep = $saja[SEP] + $nambahsep;
                $nambahoct = $saja[OCT] *  $naik/100 ; $persenoct = $saja[OCT] + $nambahoct;
                $nambahnov = $saja[NOV] *  $naik/100 ; $persennov = $saja[NOV] + $nambahnov;
                $nambahdes = $saja[DES] *  $naik/100 ; $persendes = $saja[DES] + $nambahdes;
            }else if($operate=='-'){
                $nambahjan = $saja[JAN] *  $naik/100 ; $persenjan = $saja[JAN] - $nambahjan;
                $nambahfeb = $saja[FEB] *  $naik/100 ; $persenfeb = $saja[FEB] - $nambahfeb;
                $nambahmar = $saja[MAR] *  $naik/100 ; $persenmar = $saja[MAR] - $nambahmar;
                $nambahapr = $saja[APR] *  $naik/100 ; $persenapr = $saja[APR] - $nambahapr;
                $nambahmay = $saja[MAY] *  $naik/100 ; $persenmay = $saja[MAY] - $nambahmay;
                $nambahjun = $saja[JUN] *  $naik/100 ; $persenjun = $saja[JUN] - $nambahjun;
                $nambahjul = $saja[JUL] *  $naik/100 ; $persenjul = $saja[JUL] - $nambahjul;
                $nambahaug = $saja[AUG] *  $naik/100 ; $persenaug = $saja[AUG] - $nambahaug;
                $nambahsep = $saja[SEP] *  $naik/100 ; $persensep = $saja[SEP] - $nambahsep;
                $nambahoct = $saja[OCT] *  $naik/100 ; $persenoct = $saja[OCT] - $nambahoct;
                $nambahnov = $saja[NOV] *  $naik/100 ; $persennov = $saja[NOV] - $nambahnov;
                $nambahdes = $saja[DES] *  $naik/100 ; $persendes = $saja[DES] - $nambahdes;
            }
            if($operatea=='+'){
                $nambahjana = $saja[JANA] *  $naika/100 ; $persenjana = $saja[JANA] + $nambahjana;
                $nambahfeba = $saja[FEBA] *  $naika/100 ; $persenfeba = $saja[FEBA] + $nambahfeba;
                $nambahmara = $saja[MARA] *  $naika/100 ; $persenmara = $saja[MARA] + $nambahmara;
                $nambahapra = $saja[APRA] *  $naika/100 ; $persenapra = $saja[APRA] + $nambahapra;
                $nambahmaya = $saja[MAYA] *  $naika/100 ; $persenmaya = $saja[MAYA] + $nambahmaya;
                $nambahjuna = $saja[JUNA] *  $naika/100 ; $persenjuna = $saja[JUNA] + $nambahjuna;
                $nambahjula = $saja[JULA] *  $naika/100 ; $persenjula = $saja[JULA] + $nambahjula;
                $nambahauga = $saja[AUGA] *  $naika/100 ; $persenauga = $saja[AUGA] + $nambahauga;
                $nambahsepa = $saja[SEPA] *  $naika/100 ; $persensepa = $saja[SEPA] + $nambahsepa;
                $nambahocta = $saja[OCTA] *  $naika/100 ; $persenocta = $saja[OCTA] + $nambahocta;
                $nambahnova = $saja[NOVA] *  $naika/100 ; $persennova = $saja[NOVA] + $nambahnova;
                $nambahdesa = $saja[DESA] *  $naika/100 ; $persendesa = $saja[DESA] + $nambahdesa;
            }else if($operatea=='-'){
                $nambahjana = $saja[JANA] *  $naika/100 ; $persenjana = $saja[JANA] - $nambahjana;
                $nambahfeba = $saja[FEBA] *  $naika/100 ; $persenfeba = $saja[FEBA] - $nambahfeba;
                $nambahmara = $saja[MARA] *  $naika/100 ; $persenmara = $saja[MARA] - $nambahmara;
                $nambahapra = $saja[APRA] *  $naika/100 ; $persenapra = $saja[APRA] - $nambahapra;
                $nambahmaya = $saja[MAYA] *  $naika/100 ; $persenmaya = $saja[MAYA] - $nambahmaya;
                $nambahjuna = $saja[JUNA] *  $naika/100 ; $persenjuna = $saja[JUNA] - $nambahjuna;
                $nambahjula = $saja[JULA] *  $naika/100 ; $persenjula = $saja[JULA] - $nambahjula;
                $nambahauga = $saja[AUGA] *  $naika/100 ; $persenauga = $saja[AUGA] - $nambahauga;
                $nambahsepa = $saja[SEPA] *  $naika/100 ; $persensepa = $saja[SEPA] - $nambahsepa;
                $nambahocta = $saja[OCTA] *  $naika/100 ; $persenocta = $saja[OCTA] - $nambahocta;
                $nambahnova = $saja[NOVA] *  $naika/100 ; $persennova = $saja[NOVA] - $nambahnova;
                $nambahdesa = $saja[DESA] *  $naika/100 ; $persendesa = $saja[DESA] - $nambahdesa;
            }
            mysql_query("INSERT INTO tour_mstargetpo(TargetBSO,TargetYear,TargetOperate,TargetIncrease,JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DES,TargetOperateA,TargetIncreaseA,JANA,FEBA,MARA,APRA,MAYA,JUNA,JULA,AUGA,SEPA,OCTA,NOVA,DESA)
                        VALUES ('$saja[TargetBSO]','$neksyear','$operate','$naik','$persenjan','$persenfeb','$persenmar','$persenapr','$persenmay','$persenjun','$persenjul',
                        '$persenaug','$persensep','$persenoct','$persennov','$persendes','$operatea','$naika','$persenjana','$persenfeba','$persenmara','$persenapra','$persenmaya','$persenjuna','$persenjula',
                        '$persenauga','$persensepa','$persenocta','$persennova','$persendesa')");
        }
        $qrb = mysql_query("SELECT * FROM tour_rate where RateYear = '$disyear'");
        $isiqrb = mysql_fetch_array($qrb);
        $thn=$neksyear;
        $jan=$isiqrb[JAN];$jul=$isiqrb[JUL];
        $feb=$isiqrb[FEB];$aug=$isiqrb[AUG];
        $mar=$isiqrb[MAR];$sep=$isiqrb[SEP];
        $apr=$isiqrb[APR];$oct=$isiqrb[OCT];
        $may=$isiqrb[MAY];$nov=$isiqrb[NOV];
        $jun=$isiqrb[JUN];$des=$isiqrb[DES];
        mysql_query("INSERT INTO tour_rate(RateYear,JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DES)
                        VALUES ('$thn','$jan','$feb','$mar','$apr','$may','$jun','$jul',
                        '$aug','$sep','$oct','$nov','$des')");
        $Description="Input Target PO ($neksyear)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                               Description,
                               LogTime)
                        VALUES ('$EmpName',
                               '$Description',
                               '$today')");
        header('location:media.php?module=mstargetpo');
    }
// Input new po target
    elseif ($module=='mstargetpo' AND $act=='insertpo'){
        $thn=$_POST[thn];
        $jan=$_POST[jan];$jul=$_POST[jul];
        $feb=$_POST[feb];$aug=$_POST[aug];
        $mar=$_POST[mar];$sep=$_POST[sep];
        $apr=$_POST[apr];$oct=$_POST[oct];
        $may=$_POST[may];$nov=$_POST[nov];
        $jun=$_POST[jun];$des=$_POST[des];
        $jana=$_POST[jana];$jula=$_POST[jula];
        $feba=$_POST[feba];$auga=$_POST[auga];
        $mara=$_POST[mara];$sepa=$_POST[sepa];
        $apra=$_POST[apra];$octa=$_POST[octa];
        $maya=$_POST[maya];$nova=$_POST[nova];
        $juna=$_POST[juna];$desa=$_POST[desa];
        mysql_query("INSERT INTO tour_mstargetpo(TargetBSO,TargetYear,TargetOperate,TargetIncrease,JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DES,TargetOperateA,TargetIncreaseA,JANA,FEBA,MARA,APRA,MAYA,JUNA,JULA,AUGA,SEPA,OCTA,NOVA,DESA)
                        VALUES ('$_POST[targetbso]','$thn','+','0','$jan','$feb','$mar','$apr','$may','$jun','$jul',
                        '$aug','$sep','$oct','$nov','$des','+','0','$jana','$feba','$mara','$apra','$maya','$juna','$jula',
                        '$auga','$sepa','$octa','$nova','$desa')");
        $cuma = mysql_query("SELECT * FROM tour_mstargetpo where TargetYear > '$thn' group by TargetYear ORDER BY TargetID ASC");
        while($saja = mysql_fetch_array($cuma)){
            if($saja[TargetOperate]=='+'){
                $nambahjan = $jan *  $saja[targetIncrease]/100 ; $persenjan = $jan + $nambahjan;
                $nambahfeb = $feb *  $saja[targetIncrease]/100 ; $persenfeb = $feb + $nambahfeb;
                $nambahmar = $mar *  $saja[targetIncrease]/100 ; $persenmar = $mar + $nambahmar;
                $nambahapr = $apr *  $saja[targetIncrease]/100 ; $persenapr = $apr + $nambahapr;
                $nambahmay = $may *  $saja[targetIncrease]/100 ; $persenmay = $may + $nambahmay;
                $nambahjun = $jun *  $saja[targetIncrease]/100 ; $persenjun = $jun + $nambahjun;
                $nambahjul = $jul *  $saja[targetIncrease]/100 ; $persenjul = $jul + $nambahjul;
                $nambahaug = $aug *  $saja[targetIncrease]/100 ; $persenaug = $aug + $nambahaug;
                $nambahsep = $sep *  $saja[targetIncrease]/100 ; $persensep = $sep + $nambahsep;
                $nambahoct = $oct *  $saja[targetIncrease]/100 ; $persenoct = $oct + $nambahoct;
                $nambahnov = $nov *  $saja[targetIncrease]/100 ; $persennov = $nov + $nambahnov;
                $nambahdes = $des *  $saja[targetIncrease]/100 ; $persendes = $des + $nambahdes;
            }else if($saja[TargetOperate]=='-'){
                $nambahjan = $jan *  $saja[targetIncrease]/100 ; $persenjan = $jan - $nambahjan;
                $nambahfeb = $feb *  $saja[targetIncrease]/100 ; $persenfeb = $feb - $nambahfeb;
                $nambahmar = $mar *  $saja[targetIncrease]/100 ; $persenmar = $mar - $nambahmar;
                $nambahapr = $apr *  $saja[targetIncrease]/100 ; $persenapr = $apr - $nambahapr;
                $nambahmay = $may *  $saja[targetIncrease]/100 ; $persenmay = $may - $nambahmay;
                $nambahjun = $jun *  $saja[targetIncrease]/100 ; $persenjun = $jun - $nambahjun;
                $nambahjul = $jul *  $saja[targetIncrease]/100 ; $persenjul = $jul - $nambahjul;
                $nambahaug = $aug *  $saja[targetIncrease]/100 ; $persenaug = $aug - $nambahaug;
                $nambahsep = $sep *  $saja[targetIncrease]/100 ; $persensep = $sep - $nambahsep;
                $nambahoct = $oct *  $saja[targetIncrease]/100 ; $persenoct = $oct - $nambahoct;
                $nambahnov = $nov *  $saja[targetIncrease]/100 ; $persennov = $nov - $nambahnov;
                $nambahdes = $des *  $saja[targetIncrease]/100 ; $persendes = $des - $nambahdes;
            }
            if($saja[TargetOperateA]=='+'){
                $nambahjana = $jana *  $saja[targetIncreaseA]/100 ; $persenjana = $jana + $nambahjana;
                $nambahfeba = $feba *  $saja[targetIncreaseA]/100 ; $persenfeba = $feba + $nambahfeba;
                $nambahmara = $mara *  $saja[targetIncreaseA]/100 ; $persenmara = $mara + $nambahmara;
                $nambahapra = $apra *  $saja[targetIncreaseA]/100 ; $persenapra = $apra + $nambahapra;
                $nambahmaya = $maya *  $saja[targetIncreaseA]/100 ; $persenmaya = $maya + $nambahmaya;
                $nambahjuna = $juna *  $saja[targetIncreaseA]/100 ; $persenjuna = $juna + $nambahjuna;
                $nambahjula = $jula *  $saja[targetIncreaseA]/100 ; $persenjula = $jula + $nambahjula;
                $nambahauga = $auga *  $saja[targetIncreaseA]/100 ; $persenauga = $auga + $nambahauga;
                $nambahsepa = $sepa *  $saja[targetIncreaseA]/100 ; $persensepa = $sepa + $nambahsepa;
                $nambahocta = $octa *  $saja[targetIncreaseA]/100 ; $persenocta = $octa + $nambahocta;
                $nambahnova = $nova *  $saja[targetIncreaseA]/100 ; $persennova = $nova + $nambahnova;
                $nambahdesa = $desa *  $saja[targetIncreaseA]/100 ; $persendesa = $desa + $nambahdesa;
            }else if($saja[TargetOperateA]=='-'){
                $nambahjana = $jana *  $saja[targetIncreaseA]/100 ; $persenjana = $jana - $nambahjana;
                $nambahfeba = $feba *  $saja[targetIncreaseA]/100 ; $persenfeba = $feba - $nambahfeba;
                $nambahmara = $mara *  $saja[targetIncreaseA]/100 ; $persenmara = $mara - $nambahmara;
                $nambahapra = $apra *  $saja[targetIncreaseA]/100 ; $persenapra = $apra - $nambahapra;
                $nambahmaya = $maya *  $saja[targetIncreaseA]/100 ; $persenmaya = $maya - $nambahmaya;
                $nambahjuna = $juna *  $saja[targetIncreaseA]/100 ; $persenjuna = $juna - $nambahjuna;
                $nambahjula = $jula *  $saja[targetIncreaseA]/100 ; $persenjula = $jula - $nambahjula;
                $nambahauga = $auga *  $saja[targetIncreaseA]/100 ; $persenauga = $auga - $nambahauga;
                $nambahsepa = $sepa *  $saja[targetIncreaseA]/100 ; $persensepa = $sepa - $nambahsepa;
                $nambahocta = $octa *  $saja[targetIncreaseA]/100 ; $persenocta = $octa - $nambahocta;
                $nambahnova = $nova *  $saja[targetIncreaseA]/100 ; $persennova = $nova - $nambahnova;
                $nambahdesa = $desa *  $saja[targetIncreaseA]/100 ; $persendesa = $desa - $nambahdesa;
            }
            mysql_query("INSERT INTO tour_mstargetpo(TargetBSO,TargetYear,TargetOperate,TargetIncrease,JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DES,TargetOperateA,TargetIncreaseA,JANA,FEBA,MARA,APRA,MAYA,JUNA,JULA,AUGA,SEPA,OCTA,NOVA,DESA)
                        VALUES ('$_POST[targetbso]','$saja[TargetYear]','$saja[TargetOperate]','$saja[TargetIncrease]','$persenjan','$persenfeb','$persenmar','$persenapr','$persenmay','$persenjun','$persenjul',
                        '$persenaug','$persensep','$persenoct','$persennov','$persendes','$saja[TargetOperateA]','$saja[TargetIncreaseA]','$persenjana','$persenfeba','$persenmara','$persenapra','$persenmaya','$persenjuna','$persenjula',
                        '$persenauga','$persensepa','$persenocta','$persennova','$persendesa')");
        }
        $Description="Input new po target ($_POST[targetbso])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                               Description,
                               LogTime)
                        VALUES ('$EmpName',
                               '$Description',
                               '$today')");
        header('location:media.php?module=mstargetpo');
    }
// update target
    elseif ($module=='mstargetpo' AND $act=='update'){

        mysql_query("UPDATE tour_mstargetpo set TargetIncrease = '0',
                                         JAN = '$_POST[jan]',
                                         FEB = '$_POST[feb]',
                                         MAR = '$_POST[mar]',
                                         APR = '$_POST[apr]',
                                         MAY = '$_POST[may]',
                                         JUN = '$_POST[jun]',
                                         JUL = '$_POST[jul]',
                                         AUG = '$_POST[aug]',
                                         SEP = '$_POST[sep]',
                                         OCT = '$_POST[oct]',
                                         NOV = '$_POST[nov]',
                                         DES = '$_POST[des]',
                                         TargetIncreaseA = '0',
                                         JANA = '$_POST[jana]',
                                         FEBA = '$_POST[feba]',
                                         MARA = '$_POST[mara]',
                                         APRA = '$_POST[apra]',
                                         MAYA = '$_POST[maya]',
                                         JUNA = '$_POST[juna]',
                                         JULA = '$_POST[jula]',
                                         AUGA = '$_POST[auga]',
                                         SEPA = '$_POST[sepa]',
                                         OCTA = '$_POST[octa]',
                                         NOVA = '$_POST[nova]',
                                         DESA = '$_POST[desa]'
                WHERE TargetID = '$_POST[id]'");
        $Description="Update Target ID ($_POST[id])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                           Description,
                           LogTime)
                    VALUES ('$EmpName',
                           '$Description',
                           '$today')");
        header("location:media.php?module=mstargetpo&targetyear=$_POST[thn]");
    }
// Input Hotel
    elseif ($module=='mshotel' AND $act=='input'){
        $HotelName=strtoupper($_POST[HotelName]);
        $Address=strtoupper($_POST[Address]);
        mysql_query("INSERT INTO tour_mshotel(HotelName,
                                        Address,
                                        Country,
                                        City,
                                        Telephone,
                                        Fax,
                                        Email,
                                        Class,
                                        Active)   
                                       VALUES('$HotelName',
                                       '$Address',
                                       '$_POST[Country]',
                                       '$_POST[City]',
                                       '$_POST[Telephone]',
                                       '$_POST[Fax]',
                                       '$_POST[Email]',
                                       '$_POST[Class]',
                                       '$_POST[Active]')");
        $Description="Input Hotel ($HotelName)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);
    }
// Update Hotel
    elseif ($module=='mshotel' AND $act=='update'){
        $HotelName=strtoupper($_POST[HotelName]);
        $Address=strtoupper($_POST[Address]);
        mysql_query("UPDATE tour_mshotel SET HotelName = '$HotelName',
                                            Address = '$Address',
                                            Country = '$_POST[Country]',
                                            City = '$_POST[City]',           
                                            Fax = '$_POST[Fax]',
                                            Email = '$_POST[Email]',
                                            Class = '$_POST[Class]',
                                            Active = '$_POST[Active]'
                                            WHERE IDHotel = '$_POST[id]'");
        $Description="Edit Hotel $HotelName($_POST[id])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
        header('location:media.php?module='.$module);
    }
// Tourist Object Input
    else if ($module == 'mstouristobject' AND $act == 'input') {

    $objectName = strtoupper($_POST[objectname]);
    $description = "Input Tourist Object (".$_POST[city]." ".$objectName.")";
    $fileNameFirst = $_FILES['file']['name'];
    $fileNameReplace = str_replace("+", '(plus)', $fileNameFirst);
    $fileName = str_replace("&", '(and)', $fileNameReplace);
    $tmpName  = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $subFolder = $_POST['ObjectID'];
    mkdir('upload/tour/'.$_POST['ObjectID']);
    $folder = 'upload/tour/'.$_POST['ObjectID'].'/';

    move_uploaded_file($tmpName,$folder.$fileName);

    $fp = fopen($tmpName, 'r');
    $fileContent = fread($fp, filesize($tmpName));
    $fileContent = addslashes($fileContent);
    fclose($fp);

    if (!get_magic_quotes_gpc()) { $fileName = addslashes($fileName); }

    mysql_query("INSERT INTO cim_mstouristobject (Country,
                                                  City,
                                                  ObjectName,
                                                  ImageName,
                                                  ImageType,
                                                  ImageSize,
                                                  Description,
                                                  urlimage,
                                                  Status,
                                                  CreateBy,
                                                  LastUpdateBy,
                                                  CreateDate)
                                          VALUES('$_POST[country]',
                                                 '$_POST[city]',
                                                 '$objectName',
                                                 '$fileName',
                                                 '$fileType',
                                                 '$fileSize',
                                                 '$_POST[description]',
                                                 'http://testweb.panoramawebsys.net/admin/',
                                                 '$_POST[status]',
                                                 '$employeeName',
                                                 '$employeeName',
                                                 '$today')");
    mysql_query("INSERT INTO tbl_logtour (EmployeeName, Description, LogTime) VALUES ('$EmpName', '$description', '$today')");
    header('location:media.php?module='.$module);
}
// Tourist Object Update
    else if ($module == 'mstouristobject' AND $act == 'update') {

    $objectName = strtoupper($_POST[objectname]);
    $description = "Edit Tourist Object (".$_POST[city]." ".$objectName.")";
    $fileNameFirst = $_FILES['file']['name'];
    $fileNameReplace = str_replace("+", '(plus)', $fileNameFirst);
    $fileName = str_replace("&", '(and)', $fileNameReplace);
    $tmpName  = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $subFolder = $_POST['ObjectID'];
    $folder = 'upload/tour/'.$_POST['ObjectID'].'/';

    move_uploaded_file($tmpName,$folder.$fileName);

    $fp      = fopen($tmpName, 'r');
    $fileContent = fread($fp, filesize($tmpName));
    $fileContent = addslashes($fileContent);
    fclose($fp);

    if (!get_magic_quotes_gpc()) { $fileName = addslashes($fileName); }

    if (strlen($fileName) > 0) {
        mysql_query("UPDATE cim_mstouristobject SET Country = '$_POST[country]',
                                                  City = '$_POST[city]',
                                                  ObjectName = '$objectName',
                                                  ImageName = '$fileName',
                                                  ImageType = '$fileType',
                                                  ImageSize = '$fileSize',
                                                  Description = '$_POST[description]',
                                                  urlimage = 'http://testweb.panoramawebsys.net/admin/',
                                                  Status = '$_POST[status]',
                                                  LastUpdateBy = '$employeeName'
                                            WHERE ObjectID = '$_POST[ObjectID]'");
    } else {
        mysql_query("UPDATE cim_mstouristobject SET Country = '$_POST[country]',
                                                  City = '$_POST[city]',
                                                  ObjectName = '$objectName',
                                                  Description = '$_POST[description]',
                                                  Description = '$_POST[description]',
                                                  Status = '$_POST[status]',
                                                  LastUpdateBy = '$employeeName'
                                            WHERE ObjectID = '$_POST[ObjectID]'");
    }
    mysql_query("INSERT INTO tbl_logtour (EmployeeName, Description, LogTime) VALUES ('$EmpName', '$description', '$today')");
    header('location:media.php?module='.$module);
    }
// Input Meals
    elseif ($module=='msmeals' AND $act=='input'){
        $MealsName=strtoupper($_POST[mealsname]);
        mysql_query("INSERT INTO tour_mealstype(MealsName,
                                        MealsStatus)
                                       VALUES('$MealsName',
                                       '$_POST[mealsstatus]')");
        $Description="Input Meals ($MealsName)";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('$EmpName',
                                   '$Description',
                                   '$today')");
        header('location:media.php?module='.$module);
    }
// Update Meals
    elseif ($module=='msmeals' AND $act=='update'){
        $MealsName=strtoupper($_POST[mealsname]);
        mysql_query("UPDATE tour_mealstype SET MealsName = '$MealsName',
                                            MealsStatus = '$_POST[mealsstatus]'
                                            WHERE MealsID = '$_POST[id]'");
        $Description="Edit Meals $MealsName($_POST[id])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('$EmpName',
                                   '$Description',
                                   '$today')");
        header('location:media.php?module='.$module);
    }
}
?>
