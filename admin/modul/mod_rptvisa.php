
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
switch($_GET[act]) {
    // Tampil Visa
    default:
        $nama = $_GET['nama'];
        $hariini = date("Y-m-d ");
        $tampil2 = mssql_query("SELECT DivisiNo,Employee.DivisiID,Category,EmployeeName,LTMAuthority FROM [HRM].[dbo].[Employee]
                      inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                      WHERE EmployeeID = '$_SESSION[employee_code]'");
        $hasil2 = mssql_fetch_array($tampil2);
        if ($hasil2[LTMAuthority] == 'PO BRANCH') {
            $filterpo = "AND tour_msproduct.InputDivision = '$hasil2[DivisiID]'";
        } else {
            $filterpo = '';
        }

        echo "<h2>Visa Progress</h2>
          <form method='GET' action='media.php'>
                <input type=hidden name=module value='rptvisa'>   
              Tour Code 
              <select name='nama'><option value=''>- Select TourCode -</option>";
        $option = mysql_query("SELECT tour_msproduct.IDProduct,tour_msproduct.TourCode FROM tour_msbooking 
                                    left join tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode
                                    WHERE tour_msproduct.DateTravelTo >= '$hariini'
                                    AND tour_msproduct.Year = tour_msbooking.Year 
                                    AND tour_msbooking.TourCode <> ''
                                    and tour_msproduct.Status = 'PUBLISH'  
									and (Embassy01<>'' or Embassy02<>'' or Embassy03<>'' or Embassy04<>'' or Embassy05<>'')
                                    $filterpo
                                    GROUP BY tour_msbooking.TourCode ASC");
        while ($s = mysql_fetch_array($option)) {
            if ($s['IDProduct'] == $nama) {
                echo "<option value='$s[IDProduct]' selected >$s[TourCode]</option>";
            } else {
                echo "<option value='$s[IDProduct]'>$s[TourCode]</option>";
            }

        }
        echo "</select> <input type=submit name='rptvisa' value='Show'> 
          </form>";

        $IDProduct = $nama;
        if ($IDProduct <> '') {
            $ambil = mysql_query("SELECT * FROM tour_msproduct                                         
                    WHERE tour_msproduct.IDProduct ='$IDProduct'");
            $isi = mysql_fetch_array($ambil);
            $edit = mysql_query("SELECT tour_msbookingdetail.*,TCName,TCDivision FROM tour_msbookingdetail                                                 
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$IDProduct'
                    AND tour_msbookingdetail.Status <> 'CANCEL'
                    order by BookingID ASC,IDDetail ASC");
            $jumlah = mysql_num_rows($edit);
            $depdet = date("d M Y", strtotime($isi[DateTravelFrom]));

            $rum = mysql_query("SELECT sum(AdultPax)as jumlaadult,sum(ChildPax)as jumlachild,sum(InfantPax)as jumlainf FROM tour_msbooking   
                                WHERE IDTourcode = '$IDProduct'
                                And Status = 'ACTIVE'
                                And BookingStatus = 'DEPOSIT'  
                                group by TourCode ASC");
            $room = mysql_fetch_array($rum);
            $jumteel = mysql_query("SELECT * FROM tour_msproducttl   
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL' 
                                order by IDPTL ASC");
            $banyakteel = mysql_num_rows($jumteel);
            if ($isi[TourLeaderInc] == 'YES') {
                $tl = $banyakteel;;
            } else {
                $tl = 0;
            }
            $seluruh = $room[jumlaadult] + $room[jumlachild] + $tl;

            if ($jumlah > 0) {
                echo "  <table style='border: 0px solid #000000;'>
                    <tr><td style='border: 0px solid #000000;'><img src='images/pano1.jpg'></td></tr>
                    <tr><td style='border: 0px solid #000000;'><font size=3><b>TOUR NAME : $isi[TourCode]</b></font></td></tr>
                    <tr><td style='border: 0px solid #000000;'><font size=3><b>DEPARTURE : $depdet / $isi[Flight]</b></font></td></tr>
                    <tr><td style='border: 0px solid #000000;'><font size=1><b>TOTAL PAX : $room[jumlaadult] ADT + $room[jumlachild] CHD + $tl TL= $seluruh PAXS</b></font></td></tr>
                    </table>
                    <table STYLE='font-size: 12px;' id='passportlist'>
                    <tr><th>NO</th><th>booking id</th><th>TC</th><th>passanger's name</th><th>passport no</th><th colspan=2>place & date of expiry</th>";

                for ($i = 1; $i < 6; $i++) {
                    $Embassy = 'Embassy0' . $i;
                    if ($isi[$Embassy] <> '0') {
                        $Qvisa = mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[$Embassy]'");
                        $Dvisa = mysql_fetch_array($Qvisa);
                        echo "<th><center>$Dvisa[CountryGroup]</th>";
                    }

                }

                echo "<th>Remarks</th></tr>";

                if ($isi[TourLeaderInc] == 'YES') {
                    $cariteel = mysql_query("SELECT * FROM tour_msproducttl   
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL' 
                                order by IDPTL ASC");

                    $hasilteel = mysql_num_rows($cariteel);
                    $no = $hasilteel + 1;
                    $notl = 1;
                    while ($tlnya = mysql_fetch_array($cariteel)) {
                        $carisatu = mssql_query("SELECT * FROM Employee
                                where EmployeeID = '$tlnya[EmployeeID]'
                                order by EmployeeName ASC");
                        $hasilsatu = mssql_num_rows($carisatu);

                        $datatl = mssql_fetch_array($carisatu);
                        if ($datatl[PassportValid] == '0000-00-00' OR $datatl[PassportValid] == '') {
                            $pvalid = "";
                        } else {
                            $pvalid = date("d M Y", strtotime($datatl[PassportValid]));
                        }
                        echo "<tr><td>1</td>
                                <td></td>
                                <td>TOUR LEADER</td>
                                <td>$datatl[UserCall] $datatl[NameAsPassport]</td>
                                <td>$datatl[PassportNo]</td>
                                <td>$datatl[PassportIssued]</td>
                                <td>$pvalid</td>";
                        for ($i = 1; $i < 6; $i++) {
                            $Embassy = 'Embassy0' . $i;
                            if ($isi[$Embassy] <> '0') {
                                $Qvisa = mysql_query("SELECT * FROM tbl_msembassy WHERE Country='$isi[$Embassy]'");
                                $Dvisa = mysql_fetch_array($Qvisa);
                                $grupschengen = $Dvisa[CountryGroup];
                                //$cari=mysql_query("SELECT * FROM msvisa WHERE PassNo = '$data[PassportNo]' AND ProdEmbassy ='$Dvisa[CountryID]' ORDER BY Id DESC limit 1");
                                $cari = mysql_query("SELECT * FROM msvisa
                                                           inner join tbl_msembassy on tbl_msembassy.Country = msvisa.Country
                                                           WHERE PaxName = '$datatl[NameAsPassport]'
                                                           and IDTourcode = '$tlnya[IDProduct]'
                                                           and CountryGroup = '$grupschengen' ");
                                $cek = mysql_num_rows($cari);
                                $r = mysql_fetch_array($cari);
                                if ($cek > 0) {
                                    if ($r[ActIn] == '0000-00-00') {
                                        $tglin = '';
                                    } else {
                                        $tglin = date('d M Y', strtotime($r[ActIn]));
                                    }
                                    if ($r[ProgressStatus] == 'PENDING') {
                                        $rpt = "<img src='../images/done.png'> - PENDING<br>$tglin<br>($r[DONo])";
                                        $clr = "blue";
                                    } else if ($r[ProgressStatus] == 'PROCESS TO EMBASSY') {
                                        $rpt = "<img src='../images/process.gif'> - PROCESS TO EMBASSY<br>$tglin<br>($r[DONo])";
                                        $clr = "yellow";
                                    } else if ($r[ProgressStatus] == 'PROCESS TO OPERATION') {
                                        $rpt = "<img src='../images/process.gif'> - PROCESS TO OPERATION<br>$tglin<br>($r[DONo])";
                                        $clr = "yellow";
                                    } else if ($r[ProgressStatus] == 'DONE') {
                                        $rpt = "<img src='../images/done.png'> - DONE<br>" . date('d M Y', strtotime($r[ActOut])) . "<br>($r[DONo])";
                                        $clr = "lime";
                                    } else if ($r[ProgressStatus] == 'REJECTED' or $r[ProgressStatus] == 'CANCEL' or $r[ProgressStatus] == 'REVISE' or $r[ProgressStatus] == 'VOID') {
                                        $rpt = "<img src='../images/cancel.gif'><font color='white'> - $r[ProgressStatus]<br>" . date('d M Y', strtotime($r[ActOut])) . "<br>($r[DONo])</font>";
                                        $clr = "black";
                                    }
                                } else {
                                    $rpt = "<img src='../images/delete.png'>";
                                    $clr = "pink";
                                }
                                echo "<td style='background-color: $clr'><center>";
                                if ($datatl[PassportNo] <> '') {
                                    echo "$rpt";
                                }
                                echo "</center></td>";
                            }
                        }
                        echo "<td></td></tr>";
                        $notl++;
                    }
                } else {
                    $no = 1;
                }
                $lastbooking = 'awal';
                while ($data = mysql_fetch_array($edit)) {
                    if ($data[PassportValid] == '0000-00-00' OR $data[PassportValid] == '') {
                        $pvalid = '';
                    } else {
                        $pvalid = date("d M Y", strtotime($data[PassportValid]));
                    }
                    $dtable = mysql_query("SELECT * FROM tour_msbooking                                                 
                                                WHERE BookingID ='$data[BookingID]'
                                                order by IDBookers ASC");
                    $itable = mysql_fetch_array($dtable);

                    $BookingID = mysql_query("SELECT * FROM tour_msbookingdetail                                                 
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.TourCode ='$isi[TourCode]'
                    AND tour_msbooking.Year ='$isi[Year]'  
                    AND tour_msbookingdetail.Status <> 'CANCEL' and tour_msbooking.BookingID='$data[BookingID]'
                    order by tour_msbooking.BookingID ASC,IDDetail ASC");
                    $jumlahBooking = mysql_num_rows($BookingID);

                    if ($data[PaxName] == '') {
                        $pax = 'TBA';
                    } else {
                        $pax = $data[PaxName];
                    }
                    echo "<tr><td>$no</td>";
                    if ($lastbooking <> $data[BookingID]) {
                        echo "<td rowspan='$jumlahBooking' style=vertical-align:middle>$data[BookingID]</td>";
                        echo "<td rowspan='$jumlahBooking' style=vertical-align:middle>$data[TCName] - $data[TCDivision]</td>";
                    }
                    echo "<td>$data[Title] $pax</td>
                        <td>$data[PassportNo]</td>
                        <td>$data[PassportIssued]</td> 
                        <td>$pvalid</td>";
                    for ($i = 1; $i < 6; $i++) {
                        $Embassy = 'Embassy0' . $i;
                        if ($isi[$Embassy] <> '0') {
                            $Qvisa = mysql_query("SELECT * FROM tbl_msembassy WHERE Country='$isi[$Embassy]'");
                            $Dvisa = mysql_fetch_array($Qvisa);
                            $grupschengen = $Dvisa[CountryGroup];

                            //$cari=mysql_query("SELECT * FROM msvisa WHERE PassNo = '$data[PassportNo]' AND ProdEmbassy ='$Dvisa[CountryID]' ORDER BY Id DESC limit 1");
                            $cari = mysql_query("SELECT * FROM msvisa
                                                           inner join tbl_msembassy on tbl_msembassy.Country = msvisa.Country
                                                           WHERE IDBookingdetail = '$data[IDDetail]'
                                                           and IDTourcode = '$data[IDTourcode]'
                                                           and CountryGroup = '$grupschengen' ");
                            $cek = mysql_num_rows($cari);
                            $r = mysql_fetch_array($cari);
                            if ($cek > 0) {
                                if ($r[ActIn] == '0000-00-00') {
                                    $tglin = '';
                                } else {
                                    $tglin = date('d M Y', strtotime($r[ActIn]));
                                }
                                if ($r[ProgressStatus] == 'PENDING') {
                                    $rpt = "<img src='../images/done.png'> - PENDING<br>$tglin<br>($r[DONo])";
                                    $clr = "blue";
                                } else if ($r[ProgressStatus] == 'PROCESS TO EMBASSY') {
                                    $rpt = "<img src='../images/process.gif'> - PROCESS TO EMBASSY<br>$tglin<br>($r[DONo])";
                                    $clr = "yellow";
                                } else if ($r[ProgressStatus] == 'PROCESS TO OPERATION') {
                                    $rpt = "<img src='../images/process.gif'> - PROCESS TO OPERATION<br>$tglin<br>($r[DONo])";
                                    $clr = "yellow";
                                } else if ($r[ProgressStatus] == 'DONE') {
                                    $rpt = "<img src='../images/done.png'> - DONE<br>" . date('d M Y', strtotime($r[ActOut])) . "<br>($r[DONo])";
                                    $clr = "lime";
                                } else if ($r[ProgressStatus] == 'REJECTED' or $r[ProgressStatus] == 'CANCEL' or $r[ProgressStatus] == 'REVISE' or $r[ProgressStatus] == 'VOID') {
                                    $rpt = "<img src='../images/cancel.gif'><font color='white'> - $r[ProgressStatus]<br>" . date('d M Y', strtotime($r[ActOut])) . "<br>($r[DONo])</font>";
                                    $clr = "black";
                                }

                            } else {
                                $rpt = "<img src='../images/delete.png'>";
                                $clr = "pink";
                            }
                            echo "<td style='background-color: $clr'><center>";
                            if ($data[PassportNo] <> '') {
                                echo "$rpt";
                            }
                            echo "</center></td>";
                        }
                    }
                    if ($data[HoldingVisa] == 'NO' OR $data[HoldingVisa] == '') {
                        $holding = "";
                    } else {
                        $holding = "($data[HoldingVisa])";
                    }
                    echo "<td>$holding $data[Note4Doc]</td></tr>";
                    $no++;
                    $lastbooking = $data[BookingID];
                }
                echo "
                   
                    </table><br><center><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('passportlist')></center>";
            }
        }
        break;

}
?>
