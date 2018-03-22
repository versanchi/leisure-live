
<script type="text/javascript"> 
function validateFormOnSubmit(theForm) {
var reason = "";                            
reason += validateEmpty(theForm.Divisi);
reason += validateEmpty(theForm.TcName);
reason += validateEmpty(theForm.PaxName);

if (reason != "") {
alert("Some fields need correction:\n" + reason);
return false;
}

return true;
}
function generateexcel(tableid) {
var table= document.getElementById(tableid);
var html = table.outerHTML;
window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
}
</script>
<?php
$username=$_SESSION['employee_code'];
switch($_GET[act]) {
// Tampil Visa
    default:
        $nama = $_GET['nama'];
        $hariini = date("Y-m-d ");
        $batasDoc = date("Y-m-d ", strtotime('+7 days'));
        $batasTravel = date("Y-m-d ", strtotime('+30 days'));
        $tampil2 = mssql_query("SELECT EmployeeID,DivisiNO,Employee.DivisiID,Category,EmployeeName,CompanyGroup,LTMAuthority FROM [HRM].[dbo].[Employee]
                                        inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                                        WHERE EmployeeID = '$username'");
        $hasil2 = mssql_fetch_array($tampil2);
        echo "<h2>Visa Dateline</h2>";

        if ($_SESSION[ltm_authority] == 'ADMINISTRATOR' or $_SESSION[ltm_authority] == 'DEVELOPER' or $_SESSION[ltm_authority] == 'PO' or $_SESSION[ltm_authority] == 'PO ADMINISTRATOR') {
            $QPax = mysql_query("SELECT tour_msbooking.TCDivision,tour_msbooking.TCName,tour_msbooking.BookersName,tour_msproduct.IDProduct,
                                        tour_msproduct.TourCode,tour_msbookingdetail.BookingID ,tour_msbookingdetail.IDDetail ,tour_msbookingdetail.Title,
                                        tour_msbookingdetail.PaxName,tour_msbookingdetail.Gender,tour_msbookingdetail.PassportNo,tour_msbookingdetail.PassportValid,
                                        tour_msbookingdetail.HoldingVisa,tour_msbookingdetail.Note4Doc,tour_msproduct.visadateline,Embassy01,Embassy02,Embassy03,Embassy04,Embassy05  FROM tour_msbookingdetail
                                        inner join tour_msbooking on tour_msbooking.BookingID=tour_msbookingdetail.BookingID 
                                        inner join tour_msproduct on tour_msproduct.IDProduct = tour_msbookingdetail.IDTourcode
                                        WHERE tour_msproduct.DateTravelfrom > '$hariini'
                                        and tour_msproduct.DateTravelfrom <= '$batasTravel'
                                        and tour_msproduct.visadateline <= '$batasDoc'
                                        and tour_msproduct.Status = 'PUBLISH'  
                                        and tour_msbooking.DUMMY = 'NO'
                                        and tour_msbooking.BookingStatus='DEPOSIT'
                                        and tour_msbooking.status='ACTIVE'
                                        and (Embassy01<>'' or Embassy02<>'' or Embassy03<>'' or Embassy04<>'' or Embassy05<>'') order by datetravelfrom ,bookingid,visadateline asc
                                        ");
        } else {
            $QPax = mysql_query("SELECT tour_msbookingdetail.Note4Doc,tour_msbooking.TCDivision,tour_msbooking.TCName,tour_msbooking.BookersName,tour_msproduct.IDProduct,tour_msproduct.TourCode,tour_msbookingdetail.BookingID ,tour_msbookingdetail.IDDetail ,tour_msbookingdetail.Title,tour_msbookingdetail.PaxName,tour_msbookingdetail.Gender,tour_msbookingdetail.PassportNo,tour_msbookingdetail.PassportValid,tour_msbookingdetail.HoldingVisa,tour_msproduct.visadateline,Embassy01,Embassy02,Embassy03,Embassy04,Embassy05  FROM tour_msbookingdetail
                                        inner join tour_msbooking on tour_msbooking.BookingID=tour_msbookingdetail.BookingID 
                                        inner join tour_msproduct on tour_msproduct.IDProduct = tour_msbookingdetail.IDTourcode
                                        WHERE tour_msproduct.DateTravelfrom > '$hariini'
                                        and tour_msproduct.DateTravelfrom <= '$batasTravel'
                                        and tour_msproduct.visadateline <= '$batasDoc'
                                        and tour_msproduct.Status = 'PUBLISH'  
                                        and tour_msbooking.DUMMY = 'NO'
                                        and tour_msbooking.TCDivision='$hasil2[DivisiID]'
                                        and tour_msbooking.BookingStatus='DEPOSIT'
                                        and tour_msbooking.status='ACTIVE'
                                        and (Embassy01<>'' or Embassy02<>'' or Embassy03<>'' or Embassy04<>'' or Embassy05<>'') order by datetravelfrom ,bookingid,visadateline asc
                                        ");
        }

        $JPax = mysql_num_rows($QPax);

        if ($JPax > 0) {

            echo "<table><tr>
                    <th>No</th>
                    <th>BookingID</th>
                    <th>BOSO</th>
                    <th>TCName</th>
                    <th>TourCode</th>
                    <th>Pax Name</th>
                    <th>Visa Dateline</th>
                    <th>Visa</th>
                    <th>Doc Status</th>
                    <th>Remarks</th>
                    </tr>";

            $No = 1;
            while ($DPax = mysql_fetch_array($QPax)) {
                for ($i = 1; $i <= 5; $i++) {
                    if ($i == 1) {
                        $Embassy = $DPax[Embassy01];
                    }
                    if ($i == 2) {
                        $Embassy = $DPax[Embassy02];
                    }
                    if ($i == 3) {
                        $Embassy = $DPax[Embassy03];
                    }
                    if ($i == 4) {
                        $Embassy = $DPax[Embassy04];
                    }
                    if ($i == 5) {
                        $Embassy = $DPax[Embassy05];
                    }

                    if ($Embassy <> '0') {

                        $QDocProcess = mysql_query("SELECT * from msvisa where IDBookingdetail = '$DPax[IDDetail]' and StatCancel = 0");
                        $DDocProcess = mysql_fetch_array($QDocProcess);
                        $JDocProcess = mysql_num_rows($QDocProcess);
                        
                        if ($DPax[HoldingVisa] <> 'NO') {
                            $DocRemarks = $DPax[HoldingVisa] . " " . $DPax[Note4Doc];
                        } else {
                            $DocRemarks = $DPax[Note4Doc];
                        }

                        if ($JDocProcess > 0) {
                            $DocRemarks = $DPax[Note4Doc];
                            if ($DDocProcess[ProgressStatus] <> 'DONE') {

                                echo "<tr>
                                                            <td>$No</td>
                                                            <td>$DPax[BookingID]</td>
                                                            <td>$DPax[TCDivision]</td>
                                                            <td>$DPax[TCName]</td>
                                                            <td>$DPax[TourCode]</td>
                                                            <td>$DPax[Title] $DPax[PaxName]</td>
                                                            <td>" . date("d M Y", strtotime($DPax[visadateline])) . "</td>
                                                            <td>$DDocProcess[Country]</td>
                                                            <td><span>$DDocProcess[DONo]</span> <br>$DDocProcess[ProgressStatus]</td>
                                                            <td>$DocRemarks</td>
                                                            </tr>";
                                $No++;
                            }
                        } else {
                            echo "<tr>
                                    <td>$No</td>
                                    <td>$DPax[BookingID]</td>
                                    <td>$DPax[TCDivision]</td>
                                    <td>$DPax[TCName]</td>
                                    <td>$DPax[TourCode]</td>
                                    <td>$DPax[Title] $DPax[PaxName]</td>
                                    <td>" . date("d M Y", strtotime($DPax[visadateline])) . "</td>
                                    <td>$DDocProcess[Country]</td>
                                    <td><span>$DDocProcess[DONo]</span></td>
                                    <td>$DocRemarks</td>
                                    </tr>";
                            $No++;
                        }
                    }
                }
            }

            echo "</table>";
        } else {
            echo "NO Data Found";
        }
        break;
}
?>
