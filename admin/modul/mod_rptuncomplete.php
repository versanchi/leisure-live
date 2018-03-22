    <?PHP
    $sql = mssql_query("SELECT DivisiNo,Employee.DivisiID,Category,EmployeeName FROM [HRM].[dbo].[Employee]
                      inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                      WHERE EmployeeID = '$_SESSION[employee_code]'");
    $hasil = mssql_fetch_array($sql);
    $employee = $hasil['EmployeeName'];
    $hariini = date("Y-m-d ");
    $thnini = date("Y");
    $blnini = date("m");
    $batas = date("Y-m-d", (mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 14, date("Y"))));
    $batasdoc = date("Y-m-d", (mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"))));
    $montText = strtoupper(date("M"));
    if ($montText == 'DEC') {
        $montText = 'DES';
    } else {
        $montText = $montText;
    }
    $montangka = $montText . A;
    // mencari divisi multi divisi
    $qdivisi = mssql_query("SELECT * FROM [HRM].[dbo].[Divisi]
                      WHERE DivisiID = '$_SESSION[employee_office]'");
    $ddivisi = mssql_fetch_array($qdivisi);

    //tampilan untuk operation
    $QTourCode = mysql_query("select tour_msbooking.Tourcode ,tour_msproduct.visa,tour_msproduct.IDProduct from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct= tour_msbooking.IDTourcode where tour_msbooking.BookingStatus='DEPOSIT' AND tour_msbooking.Status='ACTIVE' and (tour_msbooking.AdultPax+tour_msbooking.ChildPax+tour_msbooking.InfantPax)>0 AND dummy='NO' and 
        tour_msproduct.Status<>'VOID' and Visadateline < '$batasdoc' and DateTravelFrom >'$hariini' and tour_msproduct.CompanyID='$_SESSION[company_id]'  group by tour_msproduct.IDProduct order by DateTravelFrom ASC");

    echo"<table><tr><th>no</th><th width='250'>TourCode</th><th>Uncomplete TBF</th><th>Uncomplete Document</th></tr>";
    $No=1;
    while ($DTourCode = mysql_fetch_array($QTourCode)) {
        $PendingDoc=0;
        $PendingTBF=0;
        if($No<=10)
        {
            $QBooking = mysql_query("select BookingID,TBFNo from tour_msbooking where IDTourcode=$DTourCode[IDProduct] and Dummy='NO' and bookingstatus='DEPOSIT' and Status='ACTIVE' ");
            while ($DBooking = mysql_fetch_array($QBooking))
            {
                if( $DBooking[TBFNo]=="" )
                {
                    $PendingTBF++;
                }
                if($DTourCode[visa]<>"NO REQUIRED")
                {
                    $QBookingDetail= mysql_query("select IDDetail from tour_msbookingdetail where status <>'CANCEL' AND BookingID= $DBooking[BookingID] AND HoldingVisa='NO' ");
                    while ($DBookingDetail = mysql_fetch_array($QBookingDetail))
                    {
                        $DocCreate= mysql_query("select DoNo from msvisa where IDBookingdetail=$DBookingDetail[IDDetail] and (status='PROCESS TO EMBASSY' or status='DONE')");
                        $jumDoc = mysql_num_rows($DocCreate) * 1;
                        if ($jumDoc == 0)
                        {
                            $PendingDoc++;
                        }
                    }
                }
            }
            if($DTourCode[visa]=="NO REQUIRED")
            {
                $PendingDoc="NO REQUIRED";
            }
            if($PendingTBF>0 or ($PendingDoc>0 AND $PendingDoc<>"NO REQUIRED"))
            {
                echo"<tr><td>$No</td><td width='250'>$DTourCode[Tourcode] </td><td><center>$PendingTBF</center></td><td><center>$PendingDoc</center></td></tr>";
                $No++;
            }
        }
    }
    echo"</table>";

?>
