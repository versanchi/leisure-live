<link rel="stylesheet" href="../public/css/style.min.css">
<?php
session_start();
include "../resources/koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$username=$_GET[usr];
$EmpName="$_SESSION[nama] ($_SESSION[employeeid])";
$today = date("Y-m-d G:i:s");  
switch($_GET[act]) {

    default:
        $edit = mysql_query("SELECT * FROM cim_namelistdetail WHERE IDDetail = '$_GET[id]'");
        $r = mysql_fetch_array($edit);
        $ceking = mysql_query("SELECT * FROM cim_inquiry where InquiryID = '$r[InquiryID]'");
        $tgl = mysql_fetch_array($ceking);
        $target = $tgl[DateOfDeparture];
        $regid=$_GET[id];
        $tanggal = substr($target, 8, 2);
        $bulan = substr($target, 5, 2);
        $tahun = substr($target, 0, 4);
        $batas = date('Y-m-d', strtotime('-1 second', strtotime('+6 month', strtotime(date($bulan) . '/' . date($tanggal) . '/' . date($tahun) . ' 00:00:00'))));
        $berangkat = date('d-m-Y', strtotime($tgl[DateOfDeparture]));
        $pulang = date('d-m-Y', strtotime($tgl[DateOfArrival]));
        if ($r[BirthDate] == '0000-00-00') {
            $birthdate = '00-00-0000';
        } else {
            $birthdate = date('d-m-Y', strtotime($r[BirthDate]));
        }
        if ($r[PassportIssuedDate] == '0000-00-00') {
            $passportissueddate = '00-00-0000';
        } else {
            $passportissueddate = date('d-m-Y', strtotime($r[PassportIssuedDate]));
        }
        if ($r[PassportValid] == '0000-00-00') {
            $passportvalid = '00-00-0000';
        } else {
            $passportvalid = date('d-m-Y', strtotime($r[PassportValid]));
        }
        if($tgl[VisaCountry1]<>''){$c1=1;}else{$c1=0;}
        if($tgl[VisaCountry2]<>''){$c2=1;}else{$c2=0;}
        if($tgl[VisaCountry3]<>''){$c3=1;}else{$c3=0;}
        if($tgl[VisaCountry4]<>''){$c4=1;}else{$c4=0;}
        if($tgl[VisaCountry5]<>''){$c5=1;}else{$c5=0;}
        $sumc=$c1+$c2+$c3+$c4+$c5;
        if ($r[Category] == 'ADDITIONAL PAX') {
            $display = 'visible';
        } else {
            $display = 'none';
        }
        ?><body onload="apdetexp();"><?php
        //table visa
        if($tgl[Area]=='DOMESTIC'){$domreq="<font color='red'>*</font>";$intreq="";$intrequired='';}else{$domreq="";$intreq="<font color='red'>*</font>";$intrequired='required';}
        echo "<h2>ADDITIONAL INFORMATION</h2>
        
  <div class='o-container'>

    <div class='o-section'>
    <form method=POST name='info' onsubmit='return validateFormOnSubmit(this)' action='?module=infodetail&act=save'>
    <input type='hidden' name=id value='$_GET[id]'><input type='hidden' name='reservationid' value='$r[ReservationID]'>    
    <input type='hidden' name='batas' value='$batas'><input type='hidden' name='area' value='$tgl[Area]'>
    <input type='hidden' name='berangkat' value='$berangkat'><input type='hidden' name='registrationno' value='$r[RegistrationNo]'> 
    <input type='hidden' name='pulang' value='$pulang'>
      <div id='tabs' class='c-tabs no-js'>
        <div class='c-tabs-nav'>
          <a href='#' class='c-tabs-nav__link is-active'>
            <span>Qualification & Additional Service</span>
          </a>
          <a href='#' class='c-tabs-nav__link'>
            <span>Personal Info</span>
          </a>
          <a href='#' class='c-tabs-nav__link'>
            <span>Passport Info</span>
          </a>
          <a href='#' class='c-tabs-nav__link'>
            <span>Visa Info</span>
          </a>
          <a href='#' class='c-tabs-nav__link'>
            <span>Special Request</span>
          </a>
        </div>
        <div class='c-tab is-active'>
          <div class='c-tab__content'>
            <h2>Qualification</h2>
            <table>
              <tr><td width='100'>Category</td><td><select name='category'onChange='showMainpax()' >
           <option value='REGULAR' selected>REGULAR</option>
           <option value='ADDITIONAL PAX'>ADDITIONAL PAX</option>";
                            $tampil = mysql_query("SELECT * FROM cim_mscategory WHERE Status = 1 ");
                            while ($rc = mysql_fetch_array($tampil)) {
                                if ($r[Category] == $rc[CategoryID]) {
                                    echo "<option value='$rc[CategoryID]' selected>$rc[Category]</option>";
                                } else {
                                    echo "<option value='$rc[CategoryID]'>$rc[Category]</option>";
                                }
                            }
                            echo "
           </select></td></tr>
           <tr id='mainpax1' style='display: $display;'><td width='75'>Registered ID</td>
            <td><select name='mainpax' id='mainpax'>
            <option value=''>- select -</option>";
                            $tampil2 = mysql_query("SELECT * FROM cim_namelistdetail where ReservationID = '$r[ReservationID]' and Category <>'ADDITIONAL PAX' and MainPax ='' and RegistrationNo <> '$r[RegistrationNo]' ");
                            while ($r2 = mysql_fetch_array($tampil2)) {
                                if ($r[MainPax] == $r2[RegistrationNo]) {
                                    echo "<option value='$r2[RegistrationNo]' selected>$r2[RegistrationNo]: $r2[KTPName]</option>";
                                } else {
                                    echo "<option value='$r2[RegistrationNo]'>$r2[RegistrationNo]: $r2[KTPName]</option>";
                                }
                            }
                            echo "
           </select></td></tr>
           <tr><td>Service</td><td><select name='service' >
           <option value='PACKAGE' selected>PACKAGE</option>";
                            $tampil2 = mysql_query("SELECT * FROM cim_msservice WHERE Status = 1 ");
                            while ($r2 = mysql_fetch_array($tampil2)) {
                                if ($r[Service] == $r2[ServiceID]) {
                                    echo "<option value='$r2[ServiceID]' selected>$r2[Service]</option>";
                                } else {
                                    echo "<option value='$r2[ServiceID]'>$r2[Service]</option>";
                                }
                            }
                            echo "
           </select></td></tr>
           
            <tr><td>Room Mate</td><td>";
            $qroom = mysql_query("SELECT * FROM cim_namelistdetail where InquiryID = '$r[InquiryID]' AND RoomNo <> '0' AND RoomNo = '$r[RoomNo]' AND PaxName <> '$r[PaxName]' ORDER BY IDDetail");
            $rm=1;
            while ($dmate = mysql_fetch_array($qroom)) {
                if($rm==1) {
                    echo "$dmate[PaxName]";
                }else{
                    echo "<br>$dmate[PaxName]";
                }
                $rm++;
            }
            echo"</td></tr>
            </table>
            
            <h2>Additional Service</h2>";
            $qserv = mysql_query("SELECT * FROM cim_inquiry_addservice where InquiryID = '$r[InquiryID]'");
            $cserv = mysql_num_rows($qserv);
            if($cserv<1){
                echo"<center>** Additional Service Not Available **</center>";
            }else{
                echo"<input type=button value='Add Service' onclick=\"javascript:PopupCenter('addservice.php?InquiryID=$r[InquiryID]&RegNo=$r[RegistrationNo]', 'variable', 600, 250)\">";
                $qserv = mysql_query("SELECT * FROM cim_msserviceorder where RegistrationNo = '$r[RegistrationNo]' order by OrderID");
                $rserv = mysql_num_rows($qserv);
                if($rserv > 0) {
                    echo "
                    <table>
                    <tr><th>no</th><th>service</th><th>description</th><th>curr</th><th>amount</th><th>Status</th><th>manage</th></tr>";
                        $no = 1;
                        while ($dserv = mysql_fetch_array($qserv)) {
                            echo "<tr><td>$no</td><td>$dserv[OrderName]</td><td>$dserv[OrderDescription]</td><td>$dserv[OrderCurr]</td><td align=right>" . number_format($dserv[OrderAmount], 0, '.', ',')."</td>
                                  <td>$dserv[OrderStatus]</td>
                                  <td><center>";
                                  if($dserv[OrderStatus]<>'VOID') {
                                      echo "<a href=\"javascript:hapus($dserv[OrderID],$regid)\">Void</a>";
                                  }else {
                                      echo " -- ";
                                  }echo"
                                  </center></td></tr>";
                            $no++;
                        }
                        echo "
                    </table>";
                }else{
                    echo"<center>Additional Service Not Found</center>";
                }
            }
            echo"
          </div>
        </div>
        <div class='c-tab'>
          <div class='c-tab__content'>
            <table>
                <tr><td>Pax Name <font color='red'>*</font></td><td>$r[Title].<input type='hidden' name='title' value='$r[Title]'>";
                $qcek1=mysql_query("SELECT * FROM cim_msserviceorder where RegistrationNo = '$r[RegistrationNo]' and OrderStatus <> 'VOID' ");
                $rcek1=mysql_num_rows($qcek1);
                $qcek2=mysql_query("SELECT * FROM msvisa where IDBookingdetail = '$r[RegistrationNo]' and ProgressStatus <> 'CANCEL' AND ProgressStatus <> 'REJECT' ");
                $rcek2=mysql_num_rows($qcek2);
                if($rcek1 > 0 OR $rcek2 > 0) {
                    echo "$r[KTPName]<input type='hidden' name='ktpname' size='30' value='$r[KTPName]' placeholder='Name on ID Card'>";
                }else {
                    echo "<input type='text' name='ktpname' size='30' value='$r[KTPName]' placeholder='Name on ID Card'>";
                }
                echo"</td></tr>
                <tr><td>Gender</td> <td>";
                        if ($r[Title] == '') {
                        $sex = '';
                        } elseif ($r[Title] == 'MR' OR $r[Title] == 'MSTR') {
                        $sex = 'MALE';
                        } else {
                        $sex = 'FEMALE';
                        }
                        echo " <input type='text' name='sex' id='sex' value='$sex' size='8' style='border: hidden; background-color: #e7e7e7' readonly> TYPE: <input type='text' name='gender' id='gender' value='$r[Gender]' size='8' style='border: hidden; background-color: #e7e7e7' readonly>
                    </td></tr>
                <tr><td>ID Card Number $domreq</td><td><input type='text' name='ktpno' value='$r[KTPNo]' onkeyup='isNumber(this)'></td></tr>
                <tr><td>Agent Number</td><td><input type='text' name='agentno' value='$r[AgentNumber]'></td></tr>
                <tr><td>Agency Name</td><td><input type='text' name='agencyname' value='$r[AgencyName]'></td></tr>
                <tr><td>Birth Place</td><td><input type='text' name='birthplace' value='$r[BirthPlace]'> </td></tr>
                <tr><td>Birth Date</td><td><input type='text' name='birthdate' size='10' value='$birthdate' onClick=" . "cal.select(document.forms['info'].birthdate,'ActIn1','dd-MM-yyyy'); return false;" . " NAME='anchor3' ID='ActIn1' onFocus=getAge(); onblur=getAge()>
                        <font color='red'>(dd-mm-yyyy)</font> </td></tr>
                <tr><td>Age when Travel</td><td><input type='text' name='age' id='age' value='$r[Age]' style='border:0px; background-color: #e7e7e7' readonly> </td></tr>
                <tr><td>Religion</td><td><select name='Religion' ><option value=''>- Select -</option>
                            <option value='Katolik'";
                            if ($r[Religion] == 'Katolik') echo "selected";
                            echo ">Katolik</option>
                            <option value='Budha'";
                            if ($r[Religion] == 'Budha') echo "selected";
                            echo ">Budha</option>
                            <option value='Hindu'";
                            if ($r[Religion] == 'Hindu') echo "selected";
                            echo ">Hindu</option>
                            <option value='Islam'";
                            if ($r[Religion] == 'Islam') echo "selected";
                            echo ">Islam</option>
                        </select></td></tr><tr><td>Mobile No</td><td>+<input type='text' name='mobileno' value='$r[MobileNo]' onkeyup='isNumber(this)'> </td></tr>
                <tr><td>Father's Name</td><td><input type='text' name='fathername' value='$r[FatherName]' size='30'> </td></tr>
                <tr><td>Mother's Name</td><td><input type='text' name='mothername' value='$r[MotherName]' size='30'> </td></tr>
                <tr><td>Nationality</td> <td><select name='Passport_Nationality'>
                            <option value='' selected>- Select -</option>";
                            $tampil = mssql_query("SELECT Country FROM Destination Group BY Country");
                            while ($r1 = mssql_fetch_array($tampil)) {
                                if ($r[Country] == $r1[Country]) {
                                    echo "<option value=$r1[Country] selected>$r1[Country]</option>";
                                } else {
                                    echo "<option value=$r1[Country]>$r1[Country]</option>";
                                }
                            }
                            echo "
                        </select></td></tr>
                <tr><td>Email</td><td><input type='text' name='email' value='$r[Email]' size='20'> </td></tr>
                <tr><td>Home Address</td><td><textarea style='resize:none' name='HomeAddress' rows='3' cols='40'>$r[HomeAddress]</textarea> </td></tr>
                <tr><td>
                        Country</td><td>
                        <select name='country' onChange='showCity()'>
                            <option value='' selected>- Select -</option>";
                            $tampil = mssql_query("SELECT Country FROM Destination Group BY Country");
                            while ($r1 = mssql_fetch_array($tampil)) {
                                if ($r[Country] == $r1[Country]) {
                                    echo "<option value=$r1[Country] selected>$r1[Country]</option>";
                                } else {
                                    echo "<option value=$r1[Country]>$r1[Country]</option>";
                                }
                            }
                            echo "
                        </select>
                    </td></tr>
                <tr><td>
                        City</td><td>
                        <select name='city' id='city'>
                            <option value='' selected>- Select -</option>";
                            if ($r[City] <> '') {
                                $tampil2 = mssql_query("SELECT City FROM Destination Group BY City");
                                while ($r2 = mssql_fetch_array($tampil2)) {
                                    if ($r[City] == $r2[City]) {
                                        echo "<option value=$r2[City] selected>$r2[City]</option>";
                                    } else {
                                        echo "<option value=$r2[City]>$r2[City]</option>";
                                    }
                                }
                            }
                            echo "
                        </select>
                    </td></tr>
            </table>
            </div>
        </div>
        <div class='c-tab'>
          <div class='c-tab__content'>
            <table>
            <tr><td>First Name $intreq</td><td><input type=text name='firstpaxname' maxlength='50' value='$r[FirstPaxName]' placeholder='First Name on Passport' $intrequired></td></tr> 
            <tr><td>Last Name</td><td><input type=text name='lastpaxname' maxlength='50' value='$r[LastPaxName]' placeholder='Last Name on Passport' ></td></tr>
            <tr><td>Name (see page 4)</td><td><input type=text name='namepage4' size='30' value='$r[NamePage4]' placeholder='Name (see on page 4)'></td></tr>
            <tr><td>Passport Number $intreq</td><td><input type='text' name='passportno' value='$r[PassportNo]' $intrequired> </td></tr>
            <tr><td>Passport Issued Place</td><td><input type='text' name='passportissued' value='$r[PassportIssued]'> </td></tr>
            <tr><td>Passport Issued Date</td><td><input type='text' name='passportissueddate' size='10' value='$passportissueddate' onfocus='apdetexp()' onblur='apdetexp()' onClick=" . "cal.select(document.forms['info'].passportissueddate,'ActIn3','dd-MM-yyyy'); return false;" . " NAME='anchor3' ID='ActIn3' required>
           <font color='red'>(dd-mm-yyyy)</font></td></tr>
            <tr><td>Passport Exp Date</td><td><input type='text' name='passportvalid' size='10' value='$passportvalid' onFocus='getexpired()'; onblur='getexpired()' onClick=" . "cal.select(document.forms['info'].passportvalid,'ActIn2','dd-MM-yyyy'); return false;" . " NAME='anchor2' ID='ActIn2' required>
           <font color='red'>(dd-mm-yyyy)</font></td></tr>
           <tr><td>Passport Valid after Arrival</td><td><input type='text' name='passportexpired' id='passportexpired' value='$r[PassportExpired]' style='border:0px; background-color: #e7e7e7' readonly> </td></tr>
           <tr><td>Passport Address</td><td><textarea style='resize:none' name='PassportAddress' rows='3' cols='40'>$r[PassportAddress]</textarea> </td></tr>
           </table>
           </div>
        </div>
        <div class='c-tab'>
          <div class='c-tab__content'>";
          if($tgl[VisaCountry1] == '' and $tgl[VisaCountry2] == '' and $tgl[VisaCountry3] == '' and $tgl[VisaCountry4] == '' and $tgl[VisaCountry5] == '') {
          echo"<center>NO NEED VISA</center>";
          }else{
              echo "<table>
            <tr><th>Visa Country</th><th>Status</th><th>1st Appointment Date</th><th>2nd Appointment Date</th><th>Visa Number</th><th>Visa Exp Date</th></tr>";
              if ($tgl[VisaCountry1] <> '') {
                  $qvisa = mysql_query("SELECT * FROM cim_namelistdetailvisa where RegistrationNo = '$r[RegistrationNo]' AND VisaCountry = '$tgl[VisaCountry1]' ");
                  $dtvisa = mysql_fetch_array($qvisa);
                  if ($dtvisa[VisaValid] == '0000-00-00' OR $dtvisa[VisaValid] == '') {
                      $visavalid = '00-00-0000';
                  } else {
                      $visavalid = date('d-m-Y', strtotime($dtvisa[VisaValid]));
                  }
                  if ($dtvisa[HoldingVisa] == 'NO' OR $dtvisa[HoldingVisa] == '') {
                      $visaapp = 'enabled';
                  } else {
                      $visaapp = 'disabled';
                  }
                  echo "
                <tr><td>$tgl[VisaCountry1]<input type='hidden' name='visacountry_1' value='$tgl[VisaCountry1]'></td> 
                    <td><select name='holdingvisa_1' onChange='openinputvisa(1)'>
                                  <option value='NO'";
                  if ($dtvisa[HoldingVisa] == 'NO' OR $dtvisa[HoldingVisa] == '') {
                      echo "selected";
                  }
                  echo ">No Visa</option>
                                  <option value='FOREIGN VISA'";
                  if ($dtvisa[HoldingVisa] == 'FOREIGN VISA') {
                      echo "selected";
                  }
                  echo ">Foreign Visa</option>
                                  <option value='HOLDING VISA'";
                  if ($dtvisa[HoldingVisa] == 'HOLDING VISA') {
                      echo "selected";
                  }
                  echo ">Holding Visa</option>
                                  <option value='OWN ARRANGEMENT'";
                  if ($dtvisa[HoldingVisa] == 'OWN ARRANGEMENT') {
                      echo "selected";
                  }
                  echo ">Own Arrangement</option>
                                   </select>
                </td>
                <td><input type='text' name='visaappointment1_1' value='$dtvisa[VisaAppointment1]' $visaapp></td>
                <td><input type='text' name='visaappointment2_1' value='$dtvisa[VisaAppointment2]' $visaapp></td>
                <td><input type='text' name='visano_1' value='$dtvisa[VisaNo]' > </td>
                <td><input type='text' name='visavalid_1' size='10' value='$visavalid' onClick=" . "cal.select(document.forms['info'].visavalid_1,'vs1','dd-MM-yyyy'); return false;" . " NAME='anchor1' ID='vs1' >
                <font color='red'>(dd-mm-yyyy)</font></td>
                </tr>";
              }
              if ($tgl[VisaCountry2] <> '') {
                  $qvisa = mysql_query("SELECT * FROM cim_namelistdetailvisa where RegistrationNo = '$r[RegistrationNo]' AND VisaCountry = '$tgl[VisaCountry2]' ");
                  $dtvisa = mysql_fetch_array($qvisa);
                  if ($dtvisa[VisaValid] == '0000-00-00' OR $dtvisa[VisaValid] == '') {
                      $visavalid = '00-00-0000';
                  } else {
                      $visavalid = date('d-m-Y', strtotime($dtvisa[VisaValid]));
                  }
                  if ($dtvisa[HoldingVisa] == 'NO' OR $dtvisa[HoldingVisa] == '') {
                      $visaapp = 'enabled';
                  } else {
                      $visaapp = 'disabled';
                  }
                  echo "
                <tr><td>$tgl[VisaCountry2]<input type='hidden' name='visacountry_2' value='$tgl[VisaCountry2]'></td> 
                <td><select name='holdingvisa_2' onChange='openinputvisa(2)'>
                                      <option value='NO'";
                  if ($dtvisa[HoldingVisa] == 'NO' OR $dtvisa[HoldingVisa] == '') {
                      echo "selected";
                  }
                  echo ">No Visa</option>
                                      <option value='FOREIGN VISA'";
                  if ($dtvisa[HoldingVisa] == 'FOREIGN VISA') {
                      echo "selected";
                  }
                  echo ">Foreign Visa</option>
                                      <option value='HOLDING VISA'";
                  if ($dtvisa[HoldingVisa] == 'HOLDING VISA') {
                      echo "selected";
                  }
                  echo ">Holding Visa</option>
                                      <option value='OWN ARRANGEMENT'";
                  if ($dtvisa[HoldingVisa] == 'OWN ARRANGEMENT') {
                      echo "selected";
                  }
                  echo ">Own Arrangement</option>
                                       </select>
                </td>
                <td><input type='text' name='visaappointment1_2' value='$dtvisa[VisaAppointment1]' $visaapp></td>
                <td><input type='text' name='visaappointment2_2' value='$dtvisa[VisaAppointment2]' $visaapp></td>
                <td><input type='text' name='visano_2' value='$dtvisa[VisaNo]' > </td>
                <td><input type='text' name='visavalid_2' size='10' value='$visavalid' onClick=" . "cal.select(document.forms['info'].visavalid_2,'vs2','dd-MM-yyyy'); return false;" . " NAME='anchor2' ID='vs2' >
                <font color='red'>(dd-mm-yyyy)</font></td>
                </tr>";
              }
              if ($tgl[VisaCountry3] <> '') {
                  $qvisa = mysql_query("SELECT * FROM cim_namelistdetailvisa where RegistrationNo = '$r[RegistrationNo]' AND VisaCountry = '$tgl[VisaCountry3]' ");
                  $dtvisa = mysql_fetch_array($qvisa);
                  if ($dtvisa[VisaValid] == '0000-00-00' OR $dtvisa[VisaValid] == '') {
                      $visavalid = '00-00-0000';
                  } else {
                      $visavalid = date('d-m-Y', strtotime($dtvisa[VisaValid]));
                  }
                  if ($dtvisa[HoldingVisa] == 'NO' OR $dtvisa[HoldingVisa] == '') {
                      $visaapp = 'enabled';
                  } else {
                      $visaapp = 'disabled';
                  }
                  echo "
                <tr><td>$tgl[VisaCountry3]<input type='hidden' name='visacountry_3' value='$tgl[VisaCountry3]'></td>
                <td><select name='holdingvisa_3' onChange='openinputvisa(3)'>
                                      <option value='NO'";
                  if ($dtvisa[HoldingVisa] == 'NO' OR $dtvisa[HoldingVisa] == '') {
                      echo "selected";
                  }
                  echo ">No Visa</option>
                                      <option value='FOREIGN VISA'";
                  if ($dtvisa[HoldingVisa] == 'FOREIGN VISA') {
                      echo "selected";
                  }
                  echo ">Foreign Visa</option>
                                      <option value='HOLDING VISA'";
                  if ($dtvisa[HoldingVisa] == 'HOLDING VISA') {
                      echo "selected";
                  }
                  echo ">Holding Visa</option>
                                      <option value='OWN ARRANGEMENT'";
                  if ($dtvisa[HoldingVisa] == 'OWN ARRANGEMENT') {
                      echo "selected";
                  }
                  echo ">Own Arrangement</option>
                                       </select>
                </td>
                <td><input type='text' name='visaappointment1_3' value='$dtvisa[VisaAppointment1]' $visaapp></td>
                <td><input type='text' name='visaappointment2_3' value='$dtvisa[VisaAppointment2]' $visaapp></td>
                <td><input type='text' name='visano_3' value='$r[VisaNo]'> </td>
                <td><input type='text' name='visavalid_3' size='10' value='$visavalid' onClick=" . "cal.select(document.forms['info'].visavalid_3,'vs3','dd-MM-yyyy'); return false;" . " NAME='anchor3' ID='vs3'>
                <font color='red'>(dd-mm-yyyy)</font></td>
                </tr>";
              }
              if ($tgl[VisaCountry4] <> '') {
                  $qvisa = mysql_query("SELECT * FROM cim_namelistdetailvisa where RegistrationNo = '$r[RegistrationNo]' AND VisaCountry = '$tgl[VisaCountry4]' ");
                  $dtvisa = mysql_fetch_array($qvisa);
                  if ($dtvisa[VisaValid] == '0000-00-00' OR $dtvisa[VisaValid] == '') {
                      $visavalid = '00-00-0000';
                  } else {
                      $visavalid = date('d-m-Y', strtotime($dtvisa[VisaValid]));
                  }
                  if ($dtvisa[HoldingVisa] == 'NO' OR $dtvisa[HoldingVisa] == '') {
                      $visaapp = 'enabled';
                  } else {
                      $visaapp = 'disabled';
                  }
                  echo "
                <tr><td>$tgl[VisaCountry4]<input type='hidden' name='visacountry_4' value='$tgl[VisaCountry4]'></td> 
                <td><select name='holdingvisa_4' onChange='openinputvisa(4)'>
                                      <option value='NO'";
                  if ($dtvisa[HoldingVisa] == 'NO' OR $dtvisa[HoldingVisa] == '') {
                      echo "selected";
                  }
                  echo ">No Visa</option>
                                      <option value='FOREIGN VISA'";
                  if ($dtvisa[HoldingVisa] == 'FOREIGN VISA') {
                      echo "selected";
                  }
                  echo ">Foreign Visa</option>
                                      <option value='HOLDING VISA'";
                  if ($dtvisa[HoldingVisa] == 'HOLDING VISA') {
                      echo "selected";
                  }
                  echo ">Holding Visa</option>
                                      <option value='OWN ARRANGEMENT'";
                  if ($dtvisa[HoldingVisa] == 'OWN ARRANGEMENT') {
                      echo "selected";
                  }
                  echo ">Own Arrangement</option>
                                       </select>
                </td>
                <td><input type='text' name='visaappointment1_4' value='$dtvisa[VisaAppointment1]' $visaapp></td>
                <td><input type='text' name='visaappointment2_4' value='$dtvisa[VisaAppointment2]' $visaapp></td>
                <td><input type='text' name='visano_4' value='$dtvisa[VisaNo]' > </td>
                <td><input type='text' name='visavalid_4' size='10' value='$visavalid' onClick=" . "cal.select(document.forms['info'].visavalid_4,'vs4','dd-MM-yyyy'); return false;" . " NAME='anchor4' ID='vs4' >
                <font color='red'>(dd-mm-yyyy)</font></td>
                </tr>";
              }
              if ($tgl[VisaCountry5] <> '') {
                  $qvisa = mysql_query("SELECT * FROM cim_namelistdetailvisa where RegistrationNo = '$r[RegistrationNo]' AND VisaCountry = '$tgl[VisaCountry5]' ");
                  $dtvisa = mysql_fetch_array($qvisa);
                  if ($dtvisa[VisaValid] == '0000-00-00' OR $dtvisa[VisaValid] == '') {
                      $visavalid = '00-00-0000';
                  } else {
                      $visavalid = date('d-m-Y', strtotime($dtvisa[VisaValid]));
                  }
                  if ($dtvisa[HoldingVisa] == 'NO' OR $dtvisa[HoldingVisa] == '') {
                      $visaapp = 'enabled';
                  } else {
                      $visaapp = 'disabled';
                  }
                  echo "
            <tr><td>$tgl[VisaCountry5]<input type='hidden' name='visacountry_5' value='$tgl[VisaCountry5]'></td>  
            <td><select name='holdingvisa_5' onChange='openinputvisa(5)'>
                                  <option value='NO'";
                  if ($dtvisa[HoldingVisa] == 'NO' OR $dtvisa[HoldingVisa] == '') {
                      echo "selected";
                  }
                  echo ">No Visa</option>
                                  <option value='FOREIGN VISA'";
                  if ($dtvisa[HoldingVisa] == 'FOREIGN VISA') {
                      echo "selected";
                  }
                  echo ">Foreign Visa</option>
                                  <option value='HOLDING VISA'";
                  if ($dtvisa[HoldingVisa] == 'HOLDING VISA') {
                      echo "selected";
                  }
                  echo ">Holding Visa</option>
                                  <option value='OWN ARRANGEMENT'";
                  if ($dtvisa[HoldingVisa] == 'OWN ARRANGEMENT') {
                      echo "selected";
                  }
                  echo ">Own Arrangement</option>
                                   </select>
            </td>
            <td><input type='text' name='visaappointment1_5' value='$dtvisa[VisaAppointment1]' $visaapp></td>
            <td><input type='text' name='visaappointment2_5' value='$dtvisa[VisaAppointment2]' $visaapp></td>
            <td><input type='text' name='visano_5' value='$dtvisa[VisaNo]' > </td>
            <td><input type='text' name='visavalid_5' size='10' value='$visavalid' onClick=" . "cal.select(document.forms['info'].visavalid_5,'vs5','dd-MM-yyyy'); return false;" . " NAME='anchor5' ID='vs5' >
            <font color='red'>(dd-mm-yyyy)</font></td>
            </tr>";
              }
              echo "</table><br>
              Note For Document: <input type='text' size='50' name='note4doc' value='$r[Note4Doc]'>";
          }
      echo"</div>
        </div>
        <div class='c-tab'>
          <div class='c-tab__content'>
            <table>
              <tr><td>Transport To Jakarta</td><td><select name='SpecialRequest_TransportJkt' >
           <option value='YES'";if ($r[SpecialRequest_TransportJkt] == 'YES') echo "selected";echo ">YES</option>
           <option value='NO' ";if ($r[SpecialRequest_TransportJkt] == 'NO') echo "selected";echo ">NO</option>
           </select></td></tr>
              <tr><td>Ticket Domestic</td><td><select name='SpecialRequest_TicketDom' >
           <option value='YES'";if ($r[SpecialRequest_TicketDom] == 'YES') echo "selected";echo ">YES</option>
           <option value='NO' ";if ($r[SpecialRequest_TicketDom] == 'NO') echo "selected";echo ">NO</option>
           </select></td></tr>
              <tr><td>Hotel Domestic</td><td><select name='SpecialRequest_HotelDom' >
           <option value='YES'";if ($r[SpecialRequest_HotelDom] == 'YES') echo "selected";echo ">YES</option>
           <option value='NO' ";if ($r[SpecialRequest_HotelDom] == 'NO') echo "selected";echo ">NO</option>
           </select></td></tr>
              <tr><td>Food</td><td><input type='text' name='SpecialRequest_Food' value='$r[SpecialRequest_Food]'></td></tr>
           <tr><td>Clothes Size</td><td><select name='SpecialRequest_Clothe' >
           <option value='-'";
        if ($r[SpecialRequest_Clothe] == '-') echo "selected";
        echo ">-</option>
        <option value='S'";
        if ($r[SpecialRequest_Clothe] == 'S') echo "selected";
        echo ">S</option>
           <option value='M'";
        if ($r[SpecialRequest_Clothe] == 'M') echo "selected";
        echo ">M</option>
           <option value='L'";
        if ($r[SpecialRequest_Clothe] == 'L') echo "selected";
        echo ">L</option>
           <option value='XL'";
        if ($r[SpecialRequest_Clothe] == 'XL') echo "selected";
        echo ">XL</option>
           </select></td></tr>
           <tr><td>Room Mate</td><td><input type='text' name='SpecialRequest_Roommate' size='30' value='$r[SpecialRequest_Roommate]'></td></tr>
            <tr><td>Airlines</td><td><select name='airlines'>
            <option value='' selected>- Select Airlines -</option>";
        $tampil = mssql_query("SELECT * FROM [HRM].[dbo].[Airline] where Active = '1' ORDER BY AirlineID");
        while ($ra = mssql_fetch_array($tampil)) {
            if ($r[Airlines] == $ra[AirlineID]) {
                echo "<option value='$ra[AirlineID]' selected>$ra[AirlineID] - $ra[AirlineName]</option>";
            }else{
                echo "<option value='$ra[AirlineID]'>$ra[AirlineID] - $ra[AirlineName]</option>";
            }
        }
        echo "</select></td></tr>
            <tr><td>Request Note</td><td><textarea style='resize:none' name='requestnote' rows='3' cols='40'>$r[RequestNote]</textarea></td></tr>
            </table>
          </div>
        </div><br>
        <center><input type='submit' name='submit' value='Save' > <input type=button value=Cancel onclick='self.history.back()'></center>
      </form>
      </div>
    </div>
  </div>";

  break;

    case "addnew":
        $edit = mysql_query("SELECT * FROM cim_namelist WHERE ReservationID = '$_GET[id]'");
        $r = mysql_fetch_array($edit);
        $ceking = mysql_query("SELECT * FROM cim_inquiry where InquiryID = '$r[InquiryID]'");
        $tgl = mysql_fetch_array($ceking);
        $target = $tgl[DateOfDeparture];
        $tanggal = substr($target, 8, 2);
        $bulan = substr($target, 5, 2);
        $tahun = substr($target, 0, 4);
        $batas = date('Y-m-d', strtotime('-1 second', strtotime('+6 month', strtotime(date($bulan) . '/' . date($tanggal) . '/' . date($tahun) . ' 00:00:00'))));
        $berangkat = date('d-m-Y', strtotime($tgl[DateOfDeparture]));
        $pulang = date('d-m-Y', strtotime($tgl[DateOfArrival]));
        if ($r[BirthDate] == '') {
            $birthdate = '00-00-0000';
        } else {
            $birthdate = date('d-m-Y', strtotime($r[BirthDate]));
        }
        if ($r[PassportIssuedDate] == '') {
            $passportissueddate = '00-00-0000';
        } else {
            $passportissueddate = date('d-m-Y', strtotime($r[PassportIssuedDate]));
        }
        if ($r[PassportValid] == '') {
            $passportvalid = '00-00-0000';
        } else {
            $passportvalid = date('d-m-Y', strtotime($r[PassportValid]));
        }
        if ($r[VisaValid] == '') {
            $visavalid = '00-00-0000';
        } else {
            $visavalid = date('d-m-Y', strtotime($r[VisaValid]));
        }
        if ($r[HoldingVisa] == '') {
            $visaapp = 'enabled';
        } else {
            $visaapp = 'disabled';
        }
        if($tgl[Area]=='DOMESTIC'){$domreq="<font color='red'>*</font>";$intreq="";$intrequired='';}else{$domreq="";$intreq="<font color='red'>*</font>";$intrequired='required';}
        echo "<h2>ADDITIONAL INFORMATION</h2>    
          <div class='o-container'>

    <div class='o-section'>
    <form method=POST name='info' onsubmit='return validateFormOnSubmit(this)' action='?module=infodetail&act=input'>
    <input type='hidden' name=id value='$_GET[id]'><input type='hidden' name='reservationid' value='$r[ReservationID]'>  
    <input type='hidden' name='batas' value='$batas'><input type='hidden' name='area' value='$tgl[Area]'>
    <input type='hidden' name='berangkat' value='$berangkat'>
    <input type='hidden' name='pulang' value='$pulang'>
    <input type='hidden' name='inquiryid' value='$tgl[InquiryID]'><input type='hidden' name='inquiryno' value='$tgl[InquiryNo]'>
      <div id='tabs' class='c-tabs no-js'>
        <div class='c-tabs-nav'>
          <a href='#' class='c-tabs-nav__link is-active'>
            <span>Qualification</span>
          </a>
          <a href='#' class='c-tabs-nav__link'>
            <span>Personal Info</span>
          </a>
          <a href='#' class='c-tabs-nav__link'>
            <span>Passport Info</span>
          </a>
          <a href='#' class='c-tabs-nav__link'>
            <span>Visa Info</span>
          </a>
          <a href='#' class='c-tabs-nav__link'>
            <span>Special Request</span>
          </a>
        </div>
        <div class='c-tab is-active'>
          <div class='c-tab__content'>
            <table>
              <tr><td width='100'>Category</td><td><select name='category' onchange='showMainpax()'>
           <option value='REGULAR' selected>REGULAR</option>
           <option value='ADDITIONAL PAX'>ADDITIONAL PAX</option>";
                            $tampil = mysql_query("SELECT * FROM cim_mscategory WHERE Status = 1 ");
                            while ($r = mysql_fetch_array($tampil)) {
                            echo "<option value=$r[CategoryID]>$r[Category]</option>";
                            }
                            echo "
           </select></td></tr>
           <tr id='mainpax1' style='display: none;'><td width='75'>Registered ID</td>
            <td><select name='mainpax' id='mainpax'>
            <option value=''>- select -</option>";
                            $tampil2 = mysql_query("SELECT * FROM cim_namelistdetail where ReservationID = '$_GET[id]' and Category <>'ADDITIONAL PAX' and MainPax ='' ");
                            while ($r2 = mysql_fetch_array($tampil2)) {
                                if ($r[MainPax] == $r2[RegistrationNo]) {
                                    echo "<option value='$r2[RegistrationNo]' selected>$r2[RegistrationNo]: $r2[KTPName]</option>";
                                } else {
                                    echo "<option value='$r2[RegistrationNo]'>$r2[RegistrationNo]: $r2[KTPName]</option>";
                                }
                            }
                            echo "
           </select></td></tr>
           <tr><td>Service</td><td><select name='service' >
           <option value='PACKAGE' selected>PACKAGE</option>";
                            $tampil2 = mysql_query("SELECT * FROM cim_msservice WHERE Status = 1 ");
                            while ($r2 = mysql_fetch_array($tampil2)) {
                            echo "<option value=$r2[ServiceID]>$r2[Service]</option>";
                            }
                            echo "
           </select></td></tr>
           
            </table>
          </div>
        </div>
        <div class='c-tab'>
          <div class='c-tab__content'>
            <table>
                <tr><td>Pax Name <font color='red'>*</font></td><td><select name='title' id='title' onChange='gantisex(),gantigender(),getAge()'";
                        if ($r[Status] == 'CANCEL') {
                        echo "disabled";
                        }
                        echo " required><option value=''> - - - </option>";
                        echo " <option value='MR'";
                        if ($r[Title] == 'MR') {
                        echo "selected";
                        }
                        echo ">MR</option>
                        <option value='MRS'";
                        if ($r[Title] == 'MRS') {
                        echo "selected";
                        }
                        echo ">MRS</option>
                        <option value='MS'";
                        if ($r[Title] == 'MS') {
                        echo "selected";
                        }
                        echo ">MS</option>
                        <option value='MISS'";
                        if ($r[Title] == 'MISS') {
                        echo "selected";
                        }
                        echo ">MISS</option>
                        <option value='MSTR'";
                        if ($r[Title] == 'MSTR') {
                        echo "selected";
                        }
                        echo ">MSTR</option>
                        <option value='INF'";
                        if ($r[Title] == 'INF') {
                        echo "selected";
                        }
                        echo ">INF</option>
                        </select> <input type=text name='ktpname' size='30' value='$r[KTPName]' placeholder='Name on ID Card/KTP' required> </td></tr>
                <tr><td>Gender</td> <td>";
                        if ($r[Title] == '') {
                        $sex = '';
                        } elseif ($r[Title] == 'MR' OR $r[Title] == 'MSTR') {
                        $sex = 'MALE';
                        } else {
                        $sex = 'FEMALE';
                        }
                        echo " <input type='text' name='sex' id='sex' value='$sex' size='8' style='border: hidden; background-color: #e7e7e7' readonly> TYPE: <input type='text' name='gender' id='gender' value='$r[Gender]' size='8' style='border: hidden; background-color: #e7e7e7' readonly>
                    </td></tr>
                <tr><td>ID Card/KTP Number $domreq</td><td><input type='text' name='ktpno' value='$r[KTPNo]' onkeyup='isNumber(this)'></td></tr>
                <tr><td>Agent Number</td><td><input type='text' name='agentno' value='$r[AgentNumber]'></td></tr>
                <tr><td>Agency Name</td><td><input type='text' name='agencyname' value='$r[AgencyName]'></td></tr>
                <tr><td>Birth Place</td><td><input type='text' name='birthplace' value='$r[BirthPlace]'> </td></tr>
                <tr><td>Birth Date</td><td><input type='text' name='birthdate' size='10' value='$birthdate' onClick=" . "cal.select(document.forms['info'].birthdate,'ActIn1','dd-MM-yyyy'); return false;" . " NAME='anchor3' ID='ActIn1' onFocus=getAge(); onblur=getAge()>
                        <font color='red'>(dd-mm-yyyy)</font> </td></tr>
                <tr><td>Age when Travel</td><td><input type='text' name='age' id='age' value='$r[Age]' style='border:0px; background-color: #e7e7e7' readonly> </td></tr>
                <tr><td>Religion</td><td><select name='Religion' ><option value=''>- Select -</option>
                            <option value='Katolik'";
                            if ($r[Religion] == 'Katolik') echo "selected";
                            echo ">Katolik</option>
                            <option value='Budha'";
                            if ($r[Religion] == 'Budha') echo "selected";
                            echo ">Budha</option>
                            <option value='Hindu'";
                            if ($r[Religion] == 'Hindu') echo "selected";
                            echo ">Hindu</option>
                            <option value='Islam'";
                            if ($r[Religion] == 'Islam') echo "selected";
                            echo ">Islam</option>
                        </select></td>
                </tr><tr><td>Mobile No</td><td>+<input type='text' name='mobileno' value='62' onkeyup='isNumber(this)'> </td></tr>
                <tr><td>Father's Name</td><td><input type='text' name='fathername' value='$r[FatherName]' size='30'> </td></tr>
                <tr><td>Mother's Name</td><td><input type='text' name='mothername' value='$r[MotherName]' size='30'> </td></tr>
                <tr><td>Nationality</td> <td><select name='Passport_Nationality'>
                            <option value='' selected>- Select -</option>";
                            $tampil = mssql_query("SELECT Country FROM Destination Group BY Country");
                            while ($r1 = mssql_fetch_array($tampil)) {
                            if ($r[Country] == $r1[Country]) {
                            echo "<option value=$r1[Country] selected>$r1[Country]</option>";
                            } else {
                            echo "<option value=$r1[Country]>$r1[Country]</option>";
                            }
                            }
                            echo "
                        </select></td></tr>
                <tr><td>Email</td><td><input type='text' name='email' value='$r[Email]' size='20'> </td></tr>
                <tr><td>Home Address</td><td><textarea style='resize:none' name='HomeAddress' rows='3' cols='40'>$r[HomeAddress]</textarea> </td></tr>
                <tr><td>Country</td><td>
                        <select name='country' onChange='showCity()'>
                            <option value='' selected>- Select -</option>";
                            $tampil = mssql_query("SELECT Country FROM Destination Group BY Country");
                            while ($r1 = mssql_fetch_array($tampil)) {
                            if ($r[Country] == $r1[Country]) {
                            echo "<option value=$r1[Country] selected>$r1[Country]</option>";
                            } else {
                            echo "<option value=$r1[Country]>$r1[Country]</option>";
                            }
                            }
                            echo "
                        </select>
                    </td></tr>
                <tr><td>City</td><td>
                        <select name='city' id='city'>
                            <option value='' selected>- Select -</option>";
                            if ($r[City] <> '') {
                            $tampil2 = mssql_query("SELECT City FROM Destination Group BY City");
                            while ($r2 = mssql_fetch_array($tampil2)) {
                            if ($r[City] == $r2[City]) {
                            echo "<option value=$r2[City] selected>$r2[City]</option>";
                            } else {
                            echo "<option value=$r2[City]>$r2[City]</option>";
                            }
                            }
                            }
                            echo "
                        </select>
                    </td></tr>
            </table>
            </div>
        </div>
        <div class='c-tab'>
          <div class='c-tab__content'>
            <table>
            <tr><td>First Name $intreq</td><td><input type=text name='firstpaxname' maxlength='50' value='$r[FirstPaxName]' placeholder='First Name on Passport' $intrequired></td></tr> 
            <tr><td>Last Name</td><td><input type=text name='lastpaxname' maxlength='50' value='$r[LastPaxName]' placeholder='Last Name on Passport' ></td></tr>
            <tr><td>see page 4</td><td><input type=text name='namepage4' size='30' value='$r[NamePage4]' placeholder='see on page 4'></td></tr>
            <tr><td>Passport Number $intreq</td><td><input type='text' name='passportno' value='$r[PassportNo]' $intrequired> </td></tr>
            <tr><td>Passport Issued Place</td><td><input type='text' name='passportissued' value='$r[PassportIssued]'> </td></tr>
            <tr><td>Passport Issued Date</td><td><input type='text' name='passportissueddate' size='10' value='$passportissueddate' onFocus='apdetexp()' onblur='getexpired()' onClick=" . "cal.select(document.forms['info'].passportissueddate,'ActIn3','dd-MM-yyyy'); return false;" . " NAME='anchor3' ID='ActIn3' required>
           <font color='red'>(dd-mm-yyyy)</font></td></tr>
            <tr><td>Passport Exp Date</td><td><input type='text' name='passportvalid' size='10' value='$passportvalid' onFocus='getexpired()'; onblur='getexpired()' onClick=" . "cal.select(document.forms['info'].passportvalid,'ActIn2','dd-MM-yyyy'); return false;" . " NAME='anchor2' ID='ActIn2' required>
           <font color='red'>(dd-mm-yyyy)</font></td></tr>
           <tr><td>Passport Valid after Arrival</td><td><input type='text' name='passportexpired' id='passportexpired' value='$r[PassportExpired]' style='border:0px; background-color: #e7e7e7' readonly> </td></tr>
           <tr><td>Passport Address</td><td><textarea style='resize:none' name='PassportAddress' rows='3' cols='40'>$r[PassportAddress]</textarea> </td></tr>
           </table>
           </div>
        </div>
        <div class='c-tab'>
          <div class='c-tab__content'>";
          if($tgl[VisaCountry1] == '' and $tgl[VisaCountry2] == '' and $tgl[VisaCountry3] == '' and $tgl[VisaCountry4] == '' and $tgl[VisaCountry5] == '') {
          echo"<center>NO NEED VISA</center>";
          }else{
              echo "<table>
            <tr><th>Visa Country</th><th>Status</th><th>1st Appointment Date</th><th>2nd Appointment Date</th><th>Visa Number</th><th>Visa Exp Date</th></tr>";
              if ($tgl[VisaCountry1] <> '') {
                  $qvisa = mysql_query("SELECT * FROM cim_namelistdetailvisa where IDDetailNameList = '$r[IDDetail]' AND VisaCountry = '$tgl[VisaCountry1]' ");
                  $dtvisa = mysql_fetch_array($qvisa);
                  $visavalid = '00-00-0000';
                  $visaapp = 'enabled';
                  echo "
                <tr><td>$tgl[VisaCountry1]<input type='hidden' name='visacountry_1' value='$tgl[VisaCountry1]'></td> 
                <td><select name='holdingvisa_1' onChange='openinputvisa(1)'>
                                      <option value='NO'>No Visa</option>
                                      <option value='FOREIGN VISA'>Foreign Visa</option>
                                      <option value='HOLDING VISA'>Holding Visa</option>
                                      <option value='OWN ARRANGEMENT'>Own Arrangement</option>
                                       </select>
                </td>
                <td><input type='text' name='visaappointment1_1' $visaapp></td>
                <td><input type='text' name='visaappointment2_1' $visaapp></td>
                <td><input type='text' name='visano_1'> </td>
                <td><input type='text' name='visavalid_1' size='10' value='$visavalid' onClick=" . "cal.select(document.forms['info'].visavalid_1,'vs1','dd-MM-yyyy'); return false;" . " NAME='anchor1' ID='vs1' >
                <font color='red'>(dd-mm-yyyy)</font></td>
                </tr>";
              }
              if ($tgl[VisaCountry2] <> '') {
                  $qvisa = mysql_query("SELECT * FROM cim_namelistdetailvisa where IDDetailNameList = '$r[IDDetail]' AND VisaCountry = '$tgl[VisaCountry2]' ");
                  $dtvisa = mysql_fetch_array($qvisa);
                  $visavalid = '00-00-0000';
                  $visaapp = 'enabled';
                  echo "
                <tr><td>$tgl[VisaCountry2]<input type='hidden' name='visacountry_2' value='$tgl[VisaCountry2]'></td> 
                <td><select name='holdingvisa_2' onChange='openinputvisa(2)'>
                                      <option value='NO'>No Visa</option>
                                      <option value='FOREIGN VISA'>Foreign Visa</option>
                                      <option value='HOLDING VISA'>Holding Visa</option>
                                      <option value='OWN ARRANGEMENT'>Own Arrangement</option>
                                       </select>
                </td>
                <td><input type='text' name='visaappointment1_2' $visaapp></td>
                <td><input type='text' name='visaappointment2_2' $visaapp></td>
                <td><input type='text' name='visano_2'> </td>
                <td><input type='text' name='visavalid_2' size='10' value='$visavalid' onClick=" . "cal.select(document.forms['info'].visavalid_2,'vs2','dd-MM-yyyy'); return false;" . " NAME='anchor2' ID='vs2' >
                <font color='red'>(dd-mm-yyyy)</font></td>
                </tr>";
              }
              if ($tgl[VisaCountry3] <> '') {
                  $qvisa = mysql_query("SELECT * FROM cim_namelistdetailvisa where IDDetailNameList = '$r[IDDetail]' AND VisaCountry = '$tgl[VisaCountry3]' ");
                  $dtvisa = mysql_fetch_array($qvisa);
                  $visavalid = '00-00-0000';
                  $visaapp = 'enabled';
                  echo "
                <tr><td>$tgl[VisaCountry3]<input type='hidden' name='visacountry_3' value='$tgl[VisaCountry3]'></td> 
                <td><select name='holdingvisa_3' onChange='openinputvisa(3)'>
                                      <option value='NO'>No Visa</option>
                                      <option value='FOREIGN VISA'>Foreign Visa</option>
                                      <option value='HOLDING VISA'>Holding Visa</option>
                                      <option value='OWN ARRANGEMENT'>Own Arrangement</option>
                                       </select>
                </td>
                <td><input type='text' name='visaappointment1_3' $visaapp></td>
                <td><input type='text' name='visaappointment2_3' $visaapp></td>
                <td><input type='text' name='visano_3'> </td>
                <td><input type='text' name='visavalid_3' size='10' value='$visavalid' onClick=" . "cal.select(document.forms['info'].visavalid_3,'vs3','dd-MM-yyyy'); return false;" . " NAME='anchor3' ID='vs3' >
                <font color='red'>(dd-mm-yyyy)</font></td>
                </tr>";
              }
              if ($tgl[VisaCountry4] <> '') {
                  $qvisa = mysql_query("SELECT * FROM cim_namelistdetailvisa where IDDetailNameList = '$r[IDDetail]' AND VisaCountry = '$tgl[VisaCountry4]' ");
                  $dtvisa = mysql_fetch_array($qvisa);
                  $visavalid = '00-00-0000';
                  $visaapp = 'enabled';
                  echo "
                <tr><td>$tgl[VisaCountry4]<input type='hidden' name='visacountry_4' value='$tgl[VisaCountry4]'></td> 
                <td><select name='holdingvisa_4' onChange='openinputvisa(4)'>
                                      <option value='NO'>No Visa</option>
                                      <option value='FOREIGN VISA'>Foreign Visa</option>
                                      <option value='HOLDING VISA'>Holding Visa</option>
                                      <option value='OWN ARRANGEMENT'>Own Arrangement</option>
                                       </select>
                </td>
                <td><input type='text' name='visaappointment1_4' $visaapp></td>
                <td><input type='text' name='visaappointment2_4' $visaapp></td>
                <td><input type='text' name='visano_4'> </td>
                <td><input type='text' name='visavalid_4' size='10' value='$visavalid' onClick=" . "cal.select(document.forms['info'].visavalid_4,'vs4','dd-MM-yyyy'); return false;" . " NAME='anchor4' ID='vs4' >
                <font color='red'>(dd-mm-yyyy)</font></td>
                </tr>";
              }
              if ($tgl[VisaCountry5] <> '') {
                  $visavalid = '00-00-0000';
                  $visaapp = 'enabled';
                  echo "
                <tr><td>$tgl[VisaCountry5]<input type='hidden' name='visacountry_5' value='$tgl[VisaCountry5]'></td> 
                <td><select name='holdingvisa_5' onChange='openinputvisa(5)'>
                                      <option value='NO'>No Visa</option>
                                      <option value='FOREIGN VISA'>Foreign Visa</option>
                                      <option value='HOLDING VISA'>Holding Visa</option>
                                      <option value='OWN ARRANGEMENT'>Own Arrangement</option>
                                       </select>
                </td>
                <td><input type='text' name='visaappointment1_5' $visaapp></td>
                <td><input type='text' name='visaappointment2_5' $visaapp></td>
                <td><input type='text' name='visano_5'> </td>
                <td><input type='text' name='visavalid_5' size='10' value='$visavalid' onClick=" . "cal.select(document.forms['info'].visavalid_5,'vs5','dd-MM-yyyy'); return false;" . " NAME='anchor5' ID='vs5' >
                <font color='red'>(dd-mm-yyyy)</font></td>
                </tr>";
              }
              echo "</table><br>
              Note For Document: <input type='text' size='50' name='note4doc'>";
          }
      echo"</div>
        </div>
        <div class='c-tab'>
          <div class='c-tab__content'>
            <table>
              <tr><td>Transport To Jakarta</td><td><select name='SpecialRequest_TransportJkt' >
           <option value='YES'>YES</option>
           <option value='NO' selected>NO</option>
           </select></td></tr>
              <tr><td>Ticket Domestic</td><td><select name='SpecialRequest_TicketDom' >
           <option value='YES'>YES</option>
           <option value='NO' selected>NO</option>
           </select></td></tr>
              <tr><td>Hotel Domestic</td><td><select name='SpecialRequest_HotelDom' >
           <option value='YES'>YES</option>
           <option value='NO' selected>NO</option>
           </select></td></tr>
              <tr><td>Food</td><td><input type='text' name='SpecialRequest_Food' value='$r[SpecialRequest_Food]'></td></tr>
           <tr><td>Clothes Size</td><td><select name='SpecialRequest_Clothe' >
           <option value='-'";
        if ($r[SpecialRequest_Clothe] == '-') echo "selected";
        echo ">-</option>
        <option value='S'";
        if ($r[SpecialRequest_Clothe] == 'S') echo "selected";
        echo ">S</option>
           <option value='M'";
        if ($r[SpecialRequest_Clothe] == 'M') echo "selected";
        echo ">M</option>
           <option value='L'";
        if ($r[SpecialRequest_Clothe] == 'L') echo "selected";
        echo ">L</option>
           <option value='XL'";
        if ($r[SpecialRequest_Clothe] == 'XL') echo "selected";
        echo ">XL</option>
           </select></td></tr>
           <tr><td>Room Mate</td><td><input type='text' name='SpecialRequest_Roommate' size='30'></td></tr>
           <tr><td>Airlines</td><td><select name='airlines'>
            <option value='' selected>- Select Airlines -</option>";
        $tampil = mssql_query("SELECT * FROM [HRM].[dbo].[Airline] where Active = '1' ORDER BY AirlineID");
        while ($r = mssql_fetch_array($tampil)) {
            echo "<option value='$r[AirlineID]'>$r[AirlineID] - $r[AirlineName]</option>";
        }
        echo "</select></td></tr>
            <tr><td>Request Note</td><td><textarea style='resize:none' name='requestnote' rows='3' cols='40'></textarea></td></tr>
            </table>
          </div>
        </div><br>
        <center><input type='submit' name='submit' value='Save' > <input type=button value=Cancel onclick='self.history.back()'></center>
      </form>
      </div>
    </div>
  </div>";
        break;

    case "save":
        $rsvid = $_POST[reservationid];
        $qpax = mysql_query("SELECT * FROM cim_namelistdetail where IDDetail='$_POST[id]'");
        $rpax = mysql_fetch_array($qpax);
        $qrsv = mysql_query("SELECT * FROM cim_namelist where ReservationID='$rsvid'");
        $rrsv = mysql_fetch_array($qrsv);
        $ceking = mysql_query("SELECT * FROM cim_inquiry where InquiryID = '$rrsv[InquiryID]'");
        $dtinq = mysql_fetch_array($ceking);

        $Description = "Add Info Detail ($_POST[id])";
        $birthp = strtoupper($_POST[birthplace]);
        $PassNo1 = strtoupper($_POST[passportno]);
        $PassNo2 = str_replace(" ", "", $PassNo1);
        $passno = trim($PassNo2);
        $dev = strtoupper($_POST[deviasi]);
        $pasis = strtoupper($_POST[passportissued]);
        $birthdate = date('Y-m-d', strtotime($_POST[birthdate]));
        $passportissueddate = date('Y-m-d', strtotime($_POST[passportissueddate]));
        $passportvalid = date('Y-m-d', strtotime($_POST[passportvalid]));
        $visavalid = date('Y-m-d', strtotime($_POST[visavalid]));
        $firstpaxname = strtoupper($_POST[firstpaxname]);
        $lastpaxname = strtoupper($_POST[lastpaxname]);
        $paxname = "$firstpaxname $lastpaxname";
        $ktpname = strtoupper($_POST[ktpname]);
        if ($_POST[gender] <> $rpax[Gender]) {
            if ($_POST[gender] == 'ADULT') {
                if ($rpax[Gender] == 'CHILD') {
                    $adult = $rrsv[AdultPax] + 1;
                    $child = $rrsv[ChildPax] - 1;
                    $infant = $rrsv[InfantPax];
                }
                if ($rpax[Gender] == 'INFANT') {
                    $adult = $rrsv[AdultPax] + 1;
                    $child = $rrsv[ChildPax];
                    $infant = $rrsv[InfantPax] - 1;
                }
                if ($r[Gender] == '') {
                    $adult = $rrsv[AdultPax] + 1;
                    $child = $rrsv[ChildPax];
                    $infant = $rrsv[InfantPax];
                }
            } else if ($_POST[gender] == 'CHILD') {
                if ($rpax[Gender] == 'ADULT') {
                    $adult = $rrsv[AdultPax] - 1;
                    $child = $rrsv[ChildPax] + 1;
                    $infant = $rrsv[InfantPax];
                }
                if ($rpax[Gender] == 'INFANT') {
                    $adult = $rrsv[AdultPax];
                    $child = $rrsv[ChildPax] + 1;
                    $infant = $rrsv[InfantPax] - 1;
                }
                if ($r[Gender] == '') {
                    $adult = $rrsv[AdultPax];
                    $child = $rrsv[ChildPax] + 1;
                    $infant = $rrsv[InfantPax];
                }
            } else if ($_POST[gender] == 'INFANT') {
                if ($rpax[Gender] == 'ADULT') {
                    $adult = $rrsv[AdultPax] - 1;
                    $child = $rrsv[ChildPax];
                    $infant = $rrsv[InfantPax] + 1;
                }
                if ($r[Gender] == 'CHILD') {
                    $adult = $rrsv[AdultPax];
                    $child = $rrsv[ChildPax] - 1;
                    $infant = $rrsv[InfantPax] + 1;
                }
                if ($r[Gender] == '') {
                    $adult = $rrsv[AdultPax];
                    $child = $rrsv[ChildPax];
                    $infant = $rrsv[InfantPax] + 1;
                }
            }
        } else {
            $adult = $rrsv[AdultPax];
            $child = $rrsv[ChildPax];
            $infant = $rrsv[InfantPax];
        }
        mysql_query("update cim_namelist set AdultPax = '$adult',
                                          ChildPax = '$child',        
                                          InfantPax = '$infant'
                                          where ReservationID = '$rsvid'");
        mysql_query("UPDATE cim_namelistdetail set BirthPlace = '$birthp',
                                        BirthDate = '$birthdate',
                                        Age = '$_POST[age]',
                                        Title = '$_POST[title]',
                                        Gender = '$_POST[gender]',
                                        KTPName = '$ktpname',
                                        KTPNo = '$_POST[ktpno]',
                                        AgentNumber = '$_POST[agentno]',
                                        AgencyName = UPPER('$_POST[agencyname]'),
                                        FirstPaxName = '$firstpaxname',
                                        LastPaxName = '$lastpaxname',
                                        PaxName = '$paxname',
                                        NamePage4 = '$_POST[namepage4]',
                                        Religion = '$_POST[Religion]',
                                        MobileNo = '$_POST[mobileno]',
                                        FatherName = UPPER('$_POST[fathername]'),
                                        MotherName = UPPER('$_POST[mothername]'),
                                        Email = '$_POST[email]',
                                        HomeAddress = UPPER('$_POST[HomeAddress]'),
                                        Country = '$_POST[country]',
                                        City = '$_POST[city]',
                                        PassportNo = '$passno',
                                        PassportIssued = '$pasis',
                                        PassportIssuedDate = '$passportissueddate',
                                        PassportValid = '$passportvalid',
                                        Passport_Nationality = UPPER('$_POST[Passport_Nationality]'),
                                        PassportAddress = UPPER('$_POST[PassportAddress]'),
                                        Category = '$_POST[category]',
                                        Service = '$_POST[service]',
                                        MainPax = '$_POST[mainpax]',
                                        Airlines = '$_POST[airlines]',
                                        Note4Doc = UPPER('$_POST[note4doc]'),
                                        RequestNote = UPPER('$_POST[requestnote]'),
                                        SpecialRequest_TransportJkt = '$_POST[SpecialRequest_TransportJkt]',
                                        SpecialRequest_TicketDom = '$_POST[SpecialRequest_TicketDom]',
                                        SpecialRequest_HotelDom = '$_POST[SpecialRequest_HotelDom]',
                                        SpecialRequest_Food = UPPER('$_POST[SpecialRequest_Food]'),
                                        SpecialRequest_Clothe = '$_POST[SpecialRequest_Clothe]',
                                        SpecialRequest_Roommate = UPPER('$_POST[SpecialRequest_Roommate]')
                                        WHERE IDDetail = '$_POST[id]'");
        $qcountry1 = mysql_query("SELECT * FROM cim_namelistdetailvisa where RegistrationNo = '$_POST[registrationno]' AND VisaCountry = '$_POST[visacountry_1]'");
        $rcountry1 = mysql_num_rows($qcountry1);
        //if($_POST[visacountry_1]<>'') {
        if($rcountry1 > 0){
            $visavalid_1 = date('Y-m-d', strtotime($_POST[visavalid_1]));
            $visaexpired_1 = date('Y-m-d', strtotime($_POST[visaexpired_1]));
            mysql_query("UPDATE cim_namelistdetailvisa SET 
                                   HoldingVisa = '$_POST[holdingvisa_1]',
                                   VisaAppointment1 = '$_POST[visaappointment1_1]',
                                   VisaAppointment2 = '$_POST[visaappointment2_1]',
                                   VisaNo = '$_POST[visano_1]',
                                   VisaValid = '$visavalid_1',
                                   VisaExpired = '$visaexpired_1'
                            WHERE RegistrationNo = '$_POST[registrationno]' AND VisaCountry = '$_POST[visacountry_1]'");
        }else{
            $visavalid_1 = date('Y-m-d', strtotime($_POST[visavalid_1]));
            $visaexpired_1 = date('Y-m-d', strtotime($_POST[visaexpired_1]));
            mysql_query("INSERT INTO cim_namelistdetailvisa(RegistrationNo,
                                   VisaCountry,
                                   HoldingVisa,
                                   VisaAppointment1,
                                   VisaAppointment2,
                                   VisaNo,
                                   VisaValid,
                                   VisaExpired) 
                            VALUES ('$rpax[RegistrationNo]', 
                                   '$_POST[visacountry_1]',
                                   '$_POST[holdingvisa_1]',
                                   '$_POST[visaappointment1_1]',
                                   '$_POST[visaappointment2_1]',
                                   '$_POST[visano_1]',
                                   '$visavalid_1',
                                   '$visaexpired_1')");
        }
        $qcountry2 = mysql_query("SELECT * FROM cim_namelistdetailvisa where RegistrationNo = '$_POST[registrationno]' AND VisaCountry = '$_POST[visacountry_2]'");
        $rcountry2 = mysql_num_rows($qcountry2);
        if($rcountry2 > 0){
            $visavalid_2 = date('Y-m-d', strtotime($_POST[visavalid_2]));
            $visaexpired_2 = date('Y-m-d', strtotime($_POST[visaexpired_2]));
            mysql_query("UPDATE cim_namelistdetailvisa SET 
                                   HoldingVisa = '$_POST[holdingvisa_2]',
                                   VisaAppointment1 = '$_POST[visaappointment1_2]',
                                   VisaAppointment2 = '$_POST[visaappointment2_2]',
                                   VisaNo = '$_POST[visano_2]',
                                   VisaValid = '$visavalid_2',
                                   VisaExpired = '$visaexpired_2'
                            WHERE RegistrationNo = '$_POST[registrationno]' AND VisaCountry = '$_POST[visacountry_2]'");
        }else{
            $visavalid_2 = date('Y-m-d', strtotime($_POST[visavalid_2]));
            $visaexpired_2 = date('Y-m-d', strtotime($_POST[visaexpired_2]));
            mysql_query("INSERT INTO cim_namelistdetailvisa(RegistrationNo,
                                   VisaCountry,
                                   HoldingVisa,
                                   VisaAppointment1,
                                   VisaAppointment2,
                                   VisaNo,
                                   VisaValid,
                                   VisaExpired) 
                            VALUES ('$rpax[RegistrationNo]', 
                                   '$_POST[visacountry_2]',
                                   '$_POST[holdingvisa_2]',
                                   '$_POST[visaappointment1_2]',
                                   '$_POST[visaappointment2_2]',
                                   '$_POST[visano_2]',
                                   '$visavalid_2',
                                   '$visaexpired_2')");
        }
        $qcountry3 = mysql_query("SELECT * FROM cim_namelistdetailvisa where RegistrationNo = '$_POST[registrationno]' AND VisaCountry = '$_POST[visacountry_3]'");
        $rcountry3 = mysql_num_rows($qcountry3);
        if($rcountry3 > 0){
            $visavalid_3 = date('Y-m-d', strtotime($_POST[visavalid_3]));
            $visaexpired_3 = date('Y-m-d', strtotime($_POST[visaexpired_3]));
            mysql_query("UPDATE cim_namelistdetailvisa SET 
                                   HoldingVisa = '$_POST[holdingvisa_3]',
                                   VisaAppointment1 = '$_POST[visaappointment1_3]',
                                   VisaAppointment2 = '$_POST[visaappointment2_3]',
                                   VisaNo = '$_POST[visano_3]',
                                   VisaValid = '$visavalid_3',
                                   VisaExpired = '$visaexpired_3'
                            WHERE RegistrationNo = '$_POST[registrationno]' AND VisaCountry = '$_POST[visacountry_3]'");
        }else{
            $visavalid_3 = date('Y-m-d', strtotime($_POST[visavalid_3]));
            $visaexpired_3 = date('Y-m-d', strtotime($_POST[visaexpired_3]));
            mysql_query("INSERT INTO cim_namelistdetailvisa(RegistrationNo,
                                   VisaCountry,
                                   HoldingVisa,
                                   VisaAppointment1,
                                   VisaAppointment2,
                                   VisaNo,
                                   VisaValid,
                                   VisaExpired) 
                            VALUES ('$rpax[RegistrationNo]', 
                                   '$_POST[visacountry_3]',
                                   '$_POST[holdingvisa_3]',
                                   '$_POST[visaappointment1_3]',
                                   '$_POST[visaappointment2_3]',
                                   '$_POST[visano_3]',
                                   '$visavalid_3',
                                   '$visaexpired_3')");
        }
        $qcountry4 = mysql_query("SELECT * FROM cim_namelistdetailvisa where RegistrationNo = '$_POST[registrationno]' AND VisaCountry = '$_POST[visacountry_4]'");
        $rcountry4 = mysql_num_rows($qcountry4);
        if($rcountry4 > 0){
            $visavalid_4 = date('Y-m-d', strtotime($_POST[visavalid_4]));
            $visaexpired_4 = date('Y-m-d', strtotime($_POST[visaexpired_4]));
            mysql_query("UPDATE cim_namelistdetailvisa SET 
                                   HoldingVisa = '$_POST[holdingvisa_4]',
                                   VisaAppointment1 = '$_POST[visaappointment1_4]',
                                   VisaAppointment2 = '$_POST[visaappointment2_4]',
                                   VisaNo = '$_POST[visano_4]',
                                   VisaValid = '$visavalid_4',
                                   VisaExpired = '$visaexpired_4'
                            WHERE RegistrationNo = '$_POST[registrationno]' AND VisaCountry = '$_POST[visacountry_4]'");
        }else{
            $visavalid_4 = date('Y-m-d', strtotime($_POST[visavalid_4]));
            $visaexpired_4 = date('Y-m-d', strtotime($_POST[visaexpired_4]));
            mysql_query("INSERT INTO cim_namelistdetailvisa(RegistrationNo,
                                   VisaCountry,
                                   HoldingVisa,
                                   VisaAppointment1,
                                   VisaAppointment2,
                                   VisaNo,
                                   VisaValid,
                                   VisaExpired) 
                            VALUES ('$rpax[RegistrationNo]', 
                                   '$_POST[visacountry_4]',
                                   '$_POST[holdingvisa_4]',
                                   '$_POST[visaappointment1_4]',
                                   '$_POST[visaappointment2_4]',
                                   '$_POST[visano_4]',
                                   '$visavalid_4',
                                   '$visaexpired_4')");
        }
        $qcountry5 = mysql_query("SELECT * FROM cim_namelistdetailvisa where RegistrationNo = '$_POST[registrationno]' AND VisaCountry = '$_POST[visacountry_5]'");
        $rcountry5 = mysql_num_rows($qcountry5);
        if($rcountry5 > 0){
            $visavalid_5 = date('Y-m-d', strtotime($_POST[visavalid_5]));
            $visaexpired_5 = date('Y-m-d', strtotime($_POST[visaexpired_5]));
            mysql_query("UPDATE cim_namelistdetailvisa SET 
                                   HoldingVisa = '$_POST[holdingvisa_5]',
                                   VisaAppointment1 = '$_POST[visaappointment1_5]',
                                   VisaAppointment2 = '$_POST[visaappointment2_5]',
                                   VisaNo = '$_POST[visano_5]',
                                   VisaValid = '$visavalid_5',
                                   VisaExpired = '$visaexpired_5'
                            WHERE RegistrationNo = '$_POST[registrationno]' AND VisaCountry = '$_POST[visacountry_5]'");
        }else{
            $visavalid_5 = date('Y-m-d', strtotime($_POST[visavalid_5]));
            $visaexpired_5 = date('Y-m-d', strtotime($_POST[visaexpired_5]));
            mysql_query("INSERT INTO cim_namelistdetailvisa(RegistrationNo,
                                   VisaCountry,
                                   HoldingVisa,
                                   VisaAppointment1,
                                   VisaAppointment2,
                                   VisaNo,
                                   VisaValid,
                                   VisaExpired) 
                            VALUES ('$rpax[RegistrationNo]', 
                                   '$_POST[visacountry_5]',
                                   '$_POST[holdingvisa_5]',
                                   '$_POST[visaappointment1_5]',
                                   '$_POST[visaappointment2_5]',
                                   '$_POST[visano_5]',
                                   '$visavalid_5',
                                   '$visaexpired_5')");
        }
        mysql_query("INSERT INTO cim_log(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$username',
                                   '$Description', 
                                   '$today')");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msbookingdetail&act=editdetail&code=$_POST[reservationid]'>";
        break;

    case "input":
        $tanggalskrg = date("Y-m-d");
        $username = $_SESSION[namauser];
        $hari = date("Y", time());
        $rsvid = $_POST[reservationid];
        $mod = "msbookingdetail&act=editdetail&code=$rsvid";
        $birthp = strtoupper($_POST[birthplace]);
        $PassNo1 = strtoupper($_POST[passportno]);
        $PassNo2 = str_replace(" ", "", $PassNo1);
        $passno = trim($PassNo2);
        $dev = strtoupper($_POST[deviasi]);
        $pasis = strtoupper($_POST[passportissued]);
        if($_POST[birthdate]=='00-00-0000'){
            $birthdate='0000-00-00';
        }else{
            $birthdate = date('Y-m-d', strtotime($_POST[birthdate]));
        }
        $passportissueddate = date('Y-m-d', strtotime($_POST[passportissueddate]));
        $passportvalid = date('Y-m-d', strtotime($_POST[passportvalid]));
        $random = substr(md5(mt_rand()), 0, 6);
        $firstpaxname = strtoupper($_POST[firstpaxname]);
        $lastpaxname = strtoupper($_POST[lastpaxname]);
        $paxname = "$firstpaxname $lastpaxname";
        $ktpname = strtoupper($_POST[ktpname]);
        //cek double data
        $qsearchreg = mysql_query("SELECT * FROM cim_namelistdetail where InquiryID = '$_POST[inquiryid]' 
                            and KTPName = '$ktpname' and BirthDate = '$birthdate' and Status <> 'CANCEL' ");
        $jsearchreg = mysql_num_rows($qsearchreg);
        //kalau double
        if($jsearchreg > 0){
            $dtsearchreg = mysql_fetch_array($qsearchreg);
            $regno=$dtsearchreg[RegistrationNo];
            echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=infodetail&act=double&reg=$regno'>";
        }else {
        // tidak double
            $qreg = mysql_query("SELECT * FROM cim_namelistdetail
            ORDER BY RegistrationNo DESC limit 1");
            $datareg = mysql_fetch_array($qreg);
            $jumlahreg = mysql_num_rows($qreg);
            $tahunreg = substr($datareg[RegistrationNo], 3, 4);

            if ($jumlahreg > 0) {
                if ($hari == $tahunreg) {
                    $tahunreg1 = $hari;
                    $tiketreg = substr($datareg[RegistrationNo], 8, 7) + 1;
                    switch ($tiketreg) {
                        case ($tiketreg < 10):
                            $tiketreg1 = "000000" . $tiketreg;
                            break;
                        case ($tiketreg > 9 && $tiketreg < 100):
                            $tiketreg1 = "00000" . $tiketreg;
                            break;
                        case ($tiketreg > 99 && $tiketreg < 1000):
                            $tiketreg1 = "0000" . $tiketreg;
                            break;
                        case ($tiketreg > 999 && $tiketreg < 10000):
                            $tiketreg1 = "000" . $tiketreg;
                            break;
                        case ($tiketreg > 9999 && $tiketreg < 100000):
                            $tiketreg1 = "00" . $tiketreg;
                            break;
                        case ($tiketreg > 99999 && $tiketreg < 1000000):
                            $tiketreg1 = "0" . $tiketreg;
                            break;
                    }
                } else if ($hari > $tahunreg) {
                    $tahunreg1 = $hari;
                    $tiketreg1 = "0000001";
                }
            } else {
                $tahunreg1 = $hari;
                $tiketreg1 = "0000001";
            }
            mysql_query("INSERT INTO cim_namelistdetail(RegistrationNo,
                                                          InquiryID,
                                                          InquiryNo,
                                                          ReservationID,
                                                          ConfirmationCode,
                                                          Gender,
                                                          Package,
                                                          RoomType,
                                                          Status,
                                                          Curr,
                                                          ExRate,
                                                          Title,
                                                          FirstPaxName,
                                                          LastPaxName,
                                                          PaxName,
                                                          KTPName,
                                                          KTPNo,
                                                          AgentNumber,
                                                          AgencyName,
                                                          BirthPlace,
                                                          BirthDate,
                                                          Age,
                                                          Religion,
                                                          MobileNo,
                                                          FatherName,
                                                          MotherName,
                                                          Email,
                                                          HomeAddress,
                                                          Country,
                                                          City,
                                                          NamePage4,
                                                          PassportNo,
                                                          PassportIssued,
                                                          PassportIssuedDate,
                                                          PassportValid,
                                                          Passport_Nationality,
                                                          PassportAddress,
                                                          Note4Doc,
                                                          RequestNote,
                                                          SpecialRequest_TransportJkt,
                                                          SpecialRequest_TicketDom,
                                                          SpecialRequest_HotelDom,
                                                          SpecialRequest_Food,
                                                          SpecialRequest_Clothe,
                                                          SpecialRequest_Roommate,
                                                          Category,
                                                          MainPax,
                                                          Service,
                                                          Airlines)
                                        VALUES ('REG$tahunreg1$tiketreg1',
                                                '$_POST[inquiryid]',
                                                '$_POST[inquiryno]',
                                                '$rsvid',
                                                '$random',
                                                '$_POST[gender]',
                                                'Tour',
                                                'Twin',
                                                '0',
                                                'IDR',
                                                '1',
                                                '$_POST[title]',
                                                '$firstpaxname',
                                                '$lastpaxname',
                                                '$paxname',
                                                '$ktpname',
                                                '$_POST[ktpno]',
                                                '$_POST[agentno]',
                                                UPPER('$_POST[agencyname]'),
                                                '$birthp',
                                                '$birthdate',
                                                '$_POST[age]',
                                                '$_POST[Religion]',
                                                '$_POST[mobileno]',
                                                UPPER('$_POST[fathername]'),
                                                UPPER('$_POST[mothername]'),
                                                '$_POST[email]',
                                                UPPER('$_POST[HomeAddress]'),
                                                '$_POST[country]',
                                                '$_POST[city]',
                                                UPPER('$_POST[namepage4]'),
                                                '$passno',
                                                '$pasis',
                                                '$passportissueddate',
                                                '$passportvalid',
                                                UPPER('$_POST[Passport_Nationality]'),
                                                UPPER('$_POST[PassportAddress]'),
                                                UPPER('$_POST[note4doc]'),
                                                UPPER('$_POST[requestnote]'),
                                                '$_POST[SpecialRequest_TransportJkt]',
                                                '$_POST[SpecialRequest_TicketDom]',
                                                '$_POST[SpecialRequest_HotelDom]',
                                                UPPER('$_POST[SpecialRequest_Food]'),
                                                '$_POST[SpecialRequest_Clothe]',
                                                UPPER('$_POST[SpecialRequest_Roommate]'),
                                                '$_POST[category]',
                                                '$_POST[mainpax]',
                                                '$_POST[service]',
                                                '$_POST[airlines]')");
            $qpax = mysql_query("SELECT * FROM cim_namelist where ReservationID='$rsvid'");
            $rpax = mysql_fetch_array($qpax);
            if ($_POST[gender] == 'ADULT') {
                $adult = $rpax[AdultPax] + 1;
                $child = $rpax[ChildPax];
                $infant = $rpax[InfantPax];
            }
            if ($_POST[gender] == 'CHILD') {
                $adult = $rpax[AdultPax];
                $child = $rpax[ChildPax] + 1;
                $infant = $rpax[InfantPax];
            }
            if ($_POST[gender] == 'INFANT') {
                $adult = $rpax[AdultPax];
                $child = $rpax[ChildPax];
                $infant = $rpax[InfantPax] + 1;
            }
            mysql_query("update cim_namelist set AdultPax = '$adult',
                                      ChildPax = '$child',        
                                      InfantPax = '$infant'
                                      where ReservationID = '$rsvid'");
            if ($_POST[visacountry_1] <> '') {
                $visavalid_1 = date('Y-m-d', strtotime($_POST[visavalid_1]));
                $visaexpired_1 = date('Y-m-d', strtotime($_POST[visaexpired_1]));
                mysql_query("INSERT INTO cim_namelistdetailvisa(RegistrationNo,
                                   VisaCountry,
                                   HoldingVisa,
                                   VisaAppointment1,
                                   VisaAppointment2,
                                   VisaNo,
                                   VisaValid,
                                   VisaExpired) 
                            VALUES ('REG$tahunreg1$tiketreg1', 
                                   '$_POST[visacountry_1]',
                                   '$_POST[holdingvisa_1]',
                                   '$_POST[visaappointment1_1]',
                                   '$_POST[visaappointment2_1]',
                                   '$_POST[visano_1]',
                                   '$visavalid_1',
                                   '$visaexpired_1')");
            }
            if ($_POST[visacountry_2] <> '') {
                $visavalid_2 = date('Y-m-d', strtotime($_POST[visavalid_2]));
                $visaexpired_2 = date('Y-m-d', strtotime($_POST[visaexpired_2]));
                mysql_query("INSERT INTO cim_namelistdetailvisa(RegistrationNo,
                                   VisaCountry,
                                   HoldingVisa,
                                   VisaAppointment1,
                                   VisaAppointment2,
                                   VisaNo,
                                   VisaValid,
                                   VisaExpired) 
                            VALUES ('REG$tahunreg1$tiketreg1', 
                                   '$_POST[visacountry_2]',
                                   '$_POST[holdingvisa_2]',
                                   '$_POST[visaappointment1_2]',
                                   '$_POST[visaappointment2_2]',
                                   '$_POST[visano_2]',
                                   '$visavalid_2',
                                   '$visaexpired_2')");
            }
            if ($_POST[visacountry_3] <> '') {
                $visavalid_3 = date('Y-m-d', strtotime($_POST[visavalid_3]));
                $visaexpired_3 = date('Y-m-d', strtotime($_POST[visaexpired_3]));
                mysql_query("INSERT INTO cim_namelistdetailvisa(RegistrationNo,
                                   VisaCountry,
                                   HoldingVisa,
                                   VisaAppointment1,
                                   VisaAppointment2,
                                   VisaNo,
                                   VisaValid,
                                   VisaExpired) 
                            VALUES ('REG$tahunreg1$tiketreg1', 
                                   '$_POST[visacountry_3]',
                                   '$_POST[holdingvisa_3]',
                                   '$_POST[visaappointment1_3]',
                                   '$_POST[visaappointment2_3]',
                                   '$_POST[visano_3]',
                                   '$visavalid_3',
                                   '$visaexpired_3')");
            }
            if ($_POST[visacountry_4] <> '') {
                $visavalid_4 = date('Y-m-d', strtotime($_POST[visavalid_4]));
                $visaexpired_4 = date('Y-m-d', strtotime($_POST[visaexpired_4]));
                mysql_query("INSERT INTO cim_namelistdetailvisa(RegistrationNo,
                                   VisaCountry,
                                   HoldingVisa,
                                   VisaAppointment1,
                                   VisaAppointment2,
                                   VisaNo,
                                   VisaValid,
                                   VisaExpired) 
                            VALUES ('REG$tahunreg1$tiketreg1', 
                                   '$_POST[visacountry_4]',
                                   '$_POST[holdingvisa_4]',
                                   '$_POST[visaappointment1_4]',
                                   '$_POST[visaappointment2_4]',
                                   '$_POST[visano_4]',
                                   '$visavalid_4',
                                   '$visaexpired_4')");
            }
            if ($_POST[visacountry_5] <> '') {
                $visavalid_5 = date('Y-m-d', strtotime($_POST[visavalid_5]));
                $visaexpired_5 = date('Y-m-d', strtotime($_POST[visaexpired_5]));
                mysql_query("INSERT INTO cim_namelistdetailvisa(RegistrationNo,
                                   VisaCountry,
                                   HoldingVisa,
                                   VisaAppointment1,
                                   VisaAppointment2,
                                   VisaNo,
                                   VisaValid,
                                   VisaExpired) 
                            VALUES ('REG$tahunreg1$tiketreg1', 
                                   '$_POST[visacountry_5]',
                                   '$_POST[holdingvisa_5]',
                                   '$_POST[visaappointment1_5]',
                                   '$_POST[visaappointment2_5]',
                                   '$_POST[visano_5]',
                                   '$visavalid_5',
                                   '$visaexpired_5')");
            }
            $Description = "Add New Namelist ID($rsvid)";
            mysql_query("INSERT INTO cim_log(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
            //header("location:media.php?module=$mod");
            echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=$mod'>";
        }
        break;

    case "double":
        $qsearchreg = mysql_query("SELECT * FROM cim_namelistdetail where RegistrationNo = '$_GET[reg]' ");
        $dtsearchreg = mysql_fetch_array($qsearchreg);
        if($dtsearchreg[BirthDate]=='0000-00-00'){
            $birthdate = '00-00-0000';
        }else{
            $birthdate = date('d M Y', strtotime($dtsearchreg[BirthDate]));
        }

        $reservation=$dtsearchreg[ReservationID];
        echo "<center><b>WE FOUND DUPLICATE DATA WITH REGISTRATION NO: $dtsearchreg[RegistrationNo]</b><br>
        KTP Name: $dtsearchreg[KTPName], BirthDate: $birthdate<br><br>
        <input type=button value='Close' onclick=location.href='?module=msbookingdetail&act=editdetail&code=$reservation'></center>";
    break;

    case "voidso":
    $Description="Void SO $_GET[so]";
    $id=$_GET[id];
    $updets = mysql_query("UPDATE cim_msserviceorder set OrderStatus='VOID',VoidReason='$_GET[reason]',VoidBy='$EmpName',VoidDate='$today' WHERE OrderID = '$_GET[so]'");
    mysql_query("INSERT INTO cim_log(EmployeeName,
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=infodetail&id=$id'>";
    break;
}
?>
<script language="javascript" type="text/javascript">
    function PopupCenter(pageURL, ID,w,h) {
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    }
    function isNumber(field) {
        var re = /^[0-9'.']*$/;
        if (!re.test(field.value)) {
            alert('PLEASE INPUT NUMBER!');
            field.value = field.value.replace(/[^0-9'.']/g,"");
        }
    }
    function validateFormOnSubmit(theForm) {
        getAge()
        var reason = "";
        if(theForm.area.value != 'DOMESTIC') {
            reason += validateEmpty(theForm.passportno);
            reason += validateDateto(theForm.passportissueddate);
            reason += validateDate(theForm.passportvalid);
        }
        //reason += validateEmpty(theForm.birthdate);
        //reason += validateEmpty(theForm.age);
        if (reason != "") {
            alert("WARNING!!\n" + reason);
            document.info.elements['submit'].disabled=false;
            return false;
        }
        return true;
    }
    function validateDate(fld) {
        var error = "";
        var datefrom1 = fld.value;
        dep1 = datefrom1.split("-");
        var dateString = dep1[2]+ "/" +dep1[1]+ "/" +dep1[0];
        var date = new Date(dateString);
        var d  = date.getDate();
        var day = (d < 10) ? '0' + d : d;
        var m = date.getMonth() + 1;
        var month = (m < 10) ? '0' + m : m;
        var yy = date.getYear();
        var year = (yy < 1000) ? yy + 1900 : yy;
        var depdate = year + "/" + month + "/" + day ;

        var dep = info.batas.value;
        var dates = new Date(dep);
        var ds  = dates.getDate();
        var days = (ds < 10) ? '0' + ds : ds;
        var ms = dates.getMonth() + 1;
        var months = (ms < 10) ? '0' + ms : ms;
        var yys = dates.getYear();
        var years = (yys < 1000) ? yys + 1900 : yys;
        var sekarang = years + "/" + months + "/" + days ;
        berangkat = dep.split("-");
        var tglberangkat = berangkat[2]+ "-" +berangkat[1]+ "-" +berangkat[0];
        if (fld.value != "" || fld.value!='0000-00-00') {
            if (depdate < sekarang) {
                fld.style.background = 'Yellow';
                error = "*Passport exp date must be at least six months after the date of departure or larger than "+ tglberangkat +".\n"
            } else {
                fld.style.background = 'White';
            }
        }
        return error;
    }
    function validateDateto(fld) {
        var error = "";
        var datefrom1 = fld.value;
        dep1 = datefrom1.split("-");
        var dateString = dep1[2]+ "/" +dep1[1]+ "/" +dep1[0];
        var date = new Date(dateString);
        var d  = date.getDate();
        var day = (d < 10) ? '0' + d : d;
        var m = date.getMonth() + 1;
        var month = (m < 10) ? '0' + m : m;
        var yy = date.getYear();
        var year = (yy < 1000) ? yy + 1900 : yy;
        var arrdate = year + "/" + month + "/" + day ;

        var dep = info.passportvalid.value;
        dep2 = dep.split("-");
        var dateString2 = dep2[2]+ "/" +dep2[1]+ "/" +dep2[0];
        var dates = new Date(dateString2);
        var ds  = dates.getDate();
        var days = (ds < 10) ? '0' + ds : ds;
        var ms = dates.getMonth() + 1;
        var months = (ms < 10) ? '0' + ms : ms;
        var yys = dates.getYear();
        var years = (yys < 1000) ? yys + 1900 : yys;
        var depdate = years + "/" + months + "/" + days ;

        if (fld.value != "" || fld.value!='0000-00-00') {
            if (depdate <= arrdate) {
                fld.style.background = 'Yellow';
                error = "*Please choose date(passport issued) small than date(passport exp).\n"
            } else {
                fld.style.background = 'White';
            }
        }
        return error;

    }
    function validateAmount(fld) {
        var error = "";
        var arr = eval(fld.value);
        if (fld.value.length != 0) {
            if(arr == 0){
                info.invoiceamount.style.background = 'Yellow';
                error = "Please Input Invoice Amount.\n"
            }
            else if(info.invoiceno.value.length == 0){
                info.invoiceno.style.background = 'Yellow';
                error = "Please Input Invoice No.\n"
            }else if(info.deviasi.value.length == 0){
                info.deviasi.style.background = 'Yellow';
                error = "The required field has not been filled in.\n"
            }
            return error;
        } else {
            fld.style.background = 'White';
        }
        return error;
    }
    function validateEmpty(fld) {
        var error = "";

        if (fld.value.length == 0 || fld.value=='00-00-0000') {
            fld.style.background = 'Yellow';
            error = "The required field has not been filled in.\n"
        } else {
            fld.style.background = 'White';
        }
        return error;

    }
    function apdetexp() {
        var brgkt1 = info.passportvalid.value;
        var datefrom1 = info.passportissueddate.value;
        dep1 = datefrom1.split("-");
        var dateString = dep1[2]+ "/" +dep1[1]+ "/" +dep1[0];
        var a = new Date(dateString);
        var ys = a.getYear() + 5;
        var years = (ys < 1000) ? ys + 1900 : ys;
        var ms = a.getMonth() + 1;
        var months = (ms < 10) ? '0' + ms : ms;
        var ds = a.getDate();
        var dt = (ds < 10) ? '0' + ds : ds;
        var yb = ys + 5;
        info.passportvalid.value =  dt + "-" + months + "-" + years;
        /*if(brgkt1 != '00-00-0000' || brgkt1 != ''){
            getexpired();
        }*/
    }
    function getAge() {
        var datefrom1 = info.birthdate.value;
        var gender = info.gender.value;
        dep1 = datefrom1.split("-");
        var dateString = dep1[1]+ "/" +dep1[0]+ "/" +dep1[2];
        //var dateString = new Date(dep); 09/09/1989 MM/dd/yyyy

        var brgkt1 = info.berangkat.value;
        brgkt = brgkt1.split("-");
        var now1 = brgkt[1]+ "/" +brgkt[0]+ "/" +brgkt[2];
        var now = new Date(now1);
        var today = new Date(now.getYear(),now.getMonth(),now.getDate());

        var yearNow = now.getYear();
        var monthNow = now.getMonth();
        var dateNow = now.getDate();

        var dob = new Date(dateString.substring(6,10),
            dateString.substring(0,2)-1,
            dateString.substring(3,5)
        );

        var yearDob = dob.getYear();
        var monthDob = dob.getMonth();
        var dateDob = dob.getDate();
        var age = {};
        var ageString = "";
        var yearString = "";
        var monthString = "";
        var dayString = "";


        yearAge = yearNow - yearDob;

        if (monthNow >= monthDob)
            var monthAge = monthNow - monthDob;
        else {
            yearAge--;
            var monthAge = 12 + monthNow -monthDob;
        }

        if (dateNow >= dateDob)
            var dateAge = dateNow - dateDob;
        else {
            monthAge--;
            var dateAge = 31 + dateNow - dateDob;

            if (monthAge < 0) {
                monthAge = 11;
                yearAge--;
            }
        }

        age = {
            years: yearAge,
            months: monthAge,
            days: dateAge
        };

        if ( age.years > 1 ) yearString = " Tahun";
        else yearString = " Tahun";
        if ( age.months> 1 ) monthString = " Bulan";
        else monthString = " Bulan";
        if ( age.days > 1 ) dayString = " Hari";
        else dayString = " Hari";


        if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
            ageString = age.days + dayString ;
        else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
            ageString = age.years + yearString + " old. Happy Birthday!!";
        else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
            ageString = age.years + yearString + " and " + age.months + monthString ;
        else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
            ageString = age.months + monthString + " and " + age.days + dayString ;
        else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
            ageString = age.years + yearString + " and " + age.days + dayString ;
        else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
            ageString = age.months + monthString + " old.";
        else ageString = "";
        //infant
        if(gender=='INFANT'){
            if(age.years>0){blnthn=age.years*12}else{blnthn=0}
            umurnya=blnthn + age.months;
            blkg=" Month";
        }else{
            umurnya=age.years;
            blkg=" Year";
        }
        if(dateString=='00/00/0000' || datefrom1==''){umur=''}else{umur=umurnya + blkg}
        info.age.value=umur ;
        if(umur!=''){
            if(gender=='INFANT'){
                if(umurnya>23){alert("MAXIMUM AGE FOR INFANT IS 23 MONTH");
                    info.birthdate.value='00-00-0000';
                    info.age.value='';
                }
            }else if(gender=='CHILD'){
                if(umurnya>11){alert("MAXIMUM AGE FOR CHILD IS 11 YEAR");
                    info.birthdate.value='00-00-0000';
                    info.age.value='';
                }
            }
        }
        return ageString;

    }
    function getexpired() {
        var datefrom1 = info.pulang.value;
        dep1 = datefrom1.split("-");
        var dateString = dep1[1]+ "/" +dep1[0]+ "/" +dep1[2];
        //var tglpulang = new Date(dateString); //09/09/1989 MM/dd/yyyy

        var brgkt1 = info.passportvalid.value;
        brgkt = brgkt1.split("-");
        var now1 = brgkt[1]+ "/" +brgkt[0]+ "/" +brgkt[2];
        var now = new Date(now1);

        var yearNow = brgkt[2];
        var monthNow = brgkt[1];
        var dateNow = brgkt[0];

        var dob = new Date(dateString.substring(6,10),
            dateString.substring(0,2)-1,
            dateString.substring(3,5)
        )

        var yearDob = dep1[2];
        var monthDob = dep1[1];
        var dateDob = dep1[0];
        var age = {};
        var ageString = "";
        var yearString = "";
        var monthString = "";
        var dayString = "";

        var tglpulang = yearDob + "/" + monthDob + "/" + dateDob ;
        var tglexpired = yearNow + "/" + monthNow + "/" + dateNow ;

        if(brgkt1 != '00-00-0000') {
            if (tglexpired <= tglpulang) {

                info.passportvalid.value = '';
                info.passportexpired.value = '';
                alert("*Passport Exp Date must be large than Arrival date or larger than " + datefrom1 + ".\n");

            } else {
                yearAge = yearNow - yearDob;

                if (monthNow >= monthDob)
                    var monthAge = monthNow - monthDob;
                else {
                    yearAge--;
                    var monthAge = 12 + monthNow - monthDob;
                }

                if (dateNow >= dateDob)
                    var dateAge = dateNow - dateDob;
                else {
                    monthAge--;
                    var dateAge = 31 + dateNow - dateDob;

                    if (monthAge < 0) {
                        monthAge = 11;
                        yearAge--;
                    }
                }

                age = {
                    years: yearAge,
                    months: monthAge,
                    days: dateAge
                };

                if (age.years > 1) yearString = " Tahun";
                else yearString = " Tahun";
                if (age.months > 1) monthString = " Bulan";
                else monthString = " Bulan";
                if (age.days > 1) dayString = " Hari";
                else dayString = " Hari";


                if ((age.years == 0) && (age.months == 0) && (age.days > 0))
                    ageString = age.days + dayString;
                else if ((age.years > 0) && (age.months == 0) && (age.days == 0))
                    ageString = age.years + yearString + " old. Happy Birthday!!";
                else if ((age.years > 0) && (age.months > 0) && (age.days == 0))
                    ageString = age.years + yearString + " and " + age.months + monthString;
                else if ((age.years == 0) && (age.months > 0) && (age.days > 0))
                    ageString = age.months + monthString + " and " + age.days + dayString;
                else if ((age.years > 0) && (age.months == 0) && (age.days > 0))
                    ageString = age.years + yearString + " and " + age.days + dayString;
                else if ((age.years == 0) && (age.months > 0) && (age.days == 0))
                    ageString = age.months + monthString + " old.";
                else ageString = "";
                //infant

                if (age.years > 0) {
                    blnthn = age.years * 12
                } else {
                    blnthn = 0
                }
                umurnya = blnthn + age.months;
                blkg = " Month";

                if (dateString == '00/00/0000' || datefrom1 == '') {
                    umur = ''
                } else {
                    umur = umurnya + blkg
                }
                info.passportexpired.value = umur;
                if (isNaN(umurnya)) {
                    info.passportexpired.value = '';
                }
                if (umur != '') {

                    if (umurnya < 6) {
                        alert("MINIMUM VALID IS 6 MONTH AFTER ARRIVAL");
                        info.passportvalid.value = '';
                        info.passportexpired.value = '';
                    }

                }
            }
        }
        return ageString;

    }
    function showCity() {
        <?php

        // membaca semua data currency
        $query = "SELECT Country FROM Destination group by Country ";
        $hasil = mssql_query($query);

        // membuat if untuk masing-masing pilihan currency
        while ($data = mssql_fetch_array($hasil))
        {
            $idDest = $data['Country'];
            // membuat IF untuk masing-masing currency
            echo "if (document.info.country.value == \"".$idDest."\")";
            echo "{";

            // membuat hasil kurs untuk masing-masing currency
            $query2 = "SELECT City FROM Destination
                WHERE Country = '$idDest' ";
            $hasil2 = mssql_query($query2);
            $content = "document.getElementById('city').innerHTML = \"";
            $content .= "<option value='0'>- Select -</option>";
            while ($data2 = mssql_fetch_array($hasil2))
            {
                $content .= "<option value='".$data2['City']."'>".$data2['City']."</option>";
            }
            $content .= "\"";
            echo $content;

            echo "}\n";
            echo "else if (document.info.country.value == '')";
            echo"{";
            // membuat hasil kurs untuk masing-masing currency
            $content = "document.getElementById('city').innerHTML = \"";
            $content .= "<option value='0'>- Select -</option>";
            $content .= "\"";
            echo $content;
            echo "}\n";
        }
        ?>
    }
    function gantisex() {
        var gen = info.title;
        if(gen.value =='MR' || gen.value =='MSTR'){
            var select = document.getElementById('sex');
            select.value = "MALE";
        }else{
            if(gen.value =='INF'){
                var select = document.getElementById('sex');
                select.value = "INFANT";
            }else if(gen.value ==''){
                var select = document.getElementById('sex');
                select.value = "";
            }else{
                var select = document.getElementById('sex');
                select.value = "FEMALE";
            }
        }
    }
    function gantigender() {
        var gen = info.title;
        if (gen.value == 'MR' || gen.value == 'MRS' || gen.value == 'MS') {
            var select = document.getElementById('gender');
            select.value = "ADULT";
        } else if (gen.value == 'MSTR' || gen.value == 'MISS') {
            var select = document.getElementById('gender');
            select.value = "CHILD";
        } else if (gen.value == '') {
            var select = document.getElementById('gender');
            select.value = "";
        } else {
            var select = document.getElementById('gender');
            select.value = "INFANT";
        }
    }
    function openinputvisa(no){
        var statusvisa = eval("info.holdingvisa_" + no + ".value;")
        var dtvisaappointment1 = eval("info.visaappointment1_" + no)
        var dtvisaappointment2 = eval("info.visaappointment2_" + no)
        if(statusvisa=='NO') {
            dtvisaappointment1.disabled = false;
            dtvisaappointment2.disabled = false;
            dtvisaappointment1.value = '';
            dtvisaappointment2.value = '';
        }else{
            dtvisaappointment1.disabled = true;
            dtvisaappointment2.disabled = true;
            dtvisaappointment1.value = '';
            dtvisaappointment2.value = '';
        }
    }
    function hapus(ID,regid) {
        var alasan=prompt("Reason for Cancel: " );
        if (alasan!=null && alasan!="")
        {
            window.location.href = '?module=infodetail&act=voidso&so=' + ID + '&reason=' + alasan + '&id=' + regid;
        }
    }
</script>
<SCRIPT LANGUAGE="JavaScript" SRC="../public/js/CalendarPopup.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
    var cal = new CalendarPopup();
    cal.showYearNavigation();
    cal.showYearNavigationInput();
</SCRIPT>
<script src="../public/js/tabs.js"></script>
<script>
    var myTabs = tabs({
        el: '#tabs',
        tabNavigationLinks: '.c-tabs-nav__link',
        tabContentContainers: '.c-tab'
    });

    myTabs.init();
    function showMainpax() {

        if (document.info.category.value == 'ADDITIONAL PAX') {
            document.getElementById('mainpax1').style.display = '';
            document.getElementById('mainpax').value = '';
        } else {
            document.getElementById('mainpax1').style.display = 'none';
            document.getElementById('mainpax').value = '';
        }

        <?php
        $hasil = mysql_query("SELECT * FROM cim_msprogress GROUP BY Progress");

        while ($data = mysql_fetch_array($hasil)) {
            $idDest = $data['Progress'];
            echo "if (document.example.progress.value == \"".$idDest."\")";
            echo "{";

            $query2 = "SELECT * FROM cim_msprogress WHERE Progress = '$idDest' AND Reason <> 'POSTPONE'";
            $hasil2 = mysql_query($query2);
            $content = "document.getElementById('reason').innerHTML = \"";

            while ($data2 = mysql_fetch_array($hasil2))
            {
                $content .= "<option value='".$data2['Reason']."'>".$data2['Reason']."</option>";
            }
            $content .= "\"";
            echo $content;
            echo "}\n";
            echo "else if (document.example.progress.value == '0'){";

            $content = "document.getElementById('reason').innerHTML = \"";
            $content .= "<option value=''></option>";

            $content .= "\"";
            echo $content;
            echo "}\n";
        }
        ?>
    }
</script>