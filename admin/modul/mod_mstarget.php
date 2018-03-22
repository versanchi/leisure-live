<script language="JavaScript"  type="text/javascript">   
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
function delfile(ID, SUPPLIER, cat,no) {
if (confirm("Are you sure you want to delete " + SUPPLIER +" ("+ cat +") "))
{
 window.location.href = '?module=mstarget&act=deletedetail&id=' + ID + '&no=' + no ;
 
} 
}
function isNumber(field) {
var re = /^[0-9'.']*$/;
if (!re.test(field.value)) {
alert('PLEASE INPUT NUMBER!');
field.value = field.value.replace(/[^0-9'.']/g,"");
}
}
function jumlahin(){             
    var a = example.jumsit;    
    var n1 = eval(example.adultpax.value);
    var n2 = eval(example.childpax.value);
    a.value = (n1 + n2) ;
    if (isNaN(a.value)) {
      a.value=0 ;   
      }      
 }
function validateRate(theForm) {
var reason = "";                            
  reason += validateEmpty(theForm.jan);
  reason += validateEmpty(theForm.feb);
  reason += validateEmpty(theForm.mar);
  reason += validateEmpty(theForm.apr);
  reason += validateEmpty(theForm.may);
  reason += validateEmpty(theForm.jun);
  reason += validateEmpty(theForm.jul);
  reason += validateEmpty(theForm.aug);
  reason += validateEmpty(theForm.sep);
  reason += validateEmpty(theForm.oct);
  reason += validateEmpty(theForm.nov);
  reason += validateEmpty(theForm.des);         
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);    
    return false;
  }            
  return true;
}
function validateFormOnBSO(theForm) {
var reason = "";                            
  reason += validateSelect(theForm.targetbso);
  reason += validateEmpty(theForm.jan);
  reason += validateEmpty(theForm.feb);
  reason += validateEmpty(theForm.mar);
  reason += validateEmpty(theForm.apr);
  reason += validateEmpty(theForm.may);
  reason += validateEmpty(theForm.jun);
  reason += validateEmpty(theForm.jul);
  reason += validateEmpty(theForm.aug);
  reason += validateEmpty(theForm.sep);
  reason += validateEmpty(theForm.oct);
  reason += validateEmpty(theForm.nov);
  reason += validateEmpty(theForm.des);
  reason += validateEmpty(theForm.jana);
  reason += validateEmpty(theForm.feba);
  reason += validateEmpty(theForm.mara);
  reason += validateEmpty(theForm.apra);
  reason += validateEmpty(theForm.maya);
  reason += validateEmpty(theForm.juna);
  reason += validateEmpty(theForm.jula);
  reason += validateEmpty(theForm.auga);
  reason += validateEmpty(theForm.sepa);
  reason += validateEmpty(theForm.octa);
  reason += validateEmpty(theForm.nova);
  reason += validateEmpty(theForm.desa);      
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);    
    return false;
  }            
  return true;
}
function validateFormOnBlank(theForm) {
var reason = "";                            
  reason += validateEmpty(theForm.jan);
  reason += validateEmpty(theForm.feb);
  reason += validateEmpty(theForm.mar);
  reason += validateEmpty(theForm.apr);
  reason += validateEmpty(theForm.may);
  reason += validateEmpty(theForm.jun);
  reason += validateEmpty(theForm.jul);
  reason += validateEmpty(theForm.aug);
  reason += validateEmpty(theForm.sep);
  reason += validateEmpty(theForm.oct);
  reason += validateEmpty(theForm.nov);
  reason += validateEmpty(theForm.des);
  reason += validateEmpty(theForm.jana);
  reason += validateEmpty(theForm.feba);
  reason += validateEmpty(theForm.mara);
  reason += validateEmpty(theForm.apra);
  reason += validateEmpty(theForm.maya);
  reason += validateEmpty(theForm.juna);
  reason += validateEmpty(theForm.jula);
  reason += validateEmpty(theForm.auga);
  reason += validateEmpty(theForm.sepa);
  reason += validateEmpty(theForm.octa);
  reason += validateEmpty(theForm.nova);
  reason += validateEmpty(theForm.desa);      
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);    
    return false;
  }            
  return true;
}
function validateFormOnSubmit(theForm) {
var reason = "";                            
  reason += validateEmpty(theForm.incpersen);      
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);    
    return false;
  }

  return true;
}
function validatePhone(fld) {
    var error = "";
    var stripped = fld.value.replace(/[\(\)\.\-\ ]/g, '');    

   if (fld.value == "") {                     
        fld.style.background = 'white';
    } else if (isNaN(stripped)) {
        error = "The number contains illegal characters.\n";
        fld.style.background = 'Yellow';
    } else if (!(stripped.length > 0)) {
        error = "The number is the wrong length.\n";
        fld.style.background = 'Yellow';
    } 
    return error;
}
function validatePhone1(fld) {
    var error = "";
    //var stripped = fld.value.replace(/[\(\)\.\-\ ]/g, '');    
    var illegalChars= /[\(\)\<\>\,\;\:\-\\\"\[\]]/ ; 
   if (fld.value == "") {
        error = "You didn't enter a number.\n";
        fld.style.background = 'Yellow';
    } else if (fld.value.match(illegalChars)) {
        fld.style.background = 'Yellow';
        error = "The number contains illegal characters.\n";
    } else if (fld.value <= 0) {
        error = "Please input number > than 0.\n";
        fld.style.background = 'Yellow';
    } else {
        fld.style.background = 'White';
    }
    return error;
}
function trim(s) {
  return s.replace(/^\s+|\s+$/, '');
}
function validateEmail(fld) {
    var error="";
    var tfld = trim(fld.value);                        // value of field with whitespace trimmed off
    var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
    var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;
   
    if (fld.value != "") {
      //  fld.style.background = 'Yellow';
     //   error = "You didn't enter an email address.\n";
    //} else 
        if (!emailFilter.test(tfld)) {              //test email for illegal characters
            fld.style.background = 'Yellow';
            error = "Please enter a valid email address.\n";
        } else if (fld.value.match(illegalChars)) {
            fld.style.background = 'Yellow';
            error = "The email address contains illegal characters.\n";
        } else {
            fld.style.background = 'White';
        }
    }
    return error;
}
function validateEmpty(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        fld.style.background = 'Yellow'; 
        error = "The required field has not been filled in.\n"
    } else {
        fld.style.background = 'White';
    }
    return error;  
}
function validateDate(fld) {
    var error = "";
    var dep = fld.value;          
    var date = new Date(dep);
    var d  = date.getDate();
    var day = (d < 10) ? '0' + d : d;
    var m = date.getMonth() + 1;
    var month = (m < 10) ? '0' + m : m;
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    var depdate = year + "/" + month + "/" + day ;
    
    var dates = new Date();
    var ds  = dates.getDate();
    var days = (ds < 10) ? '0' + ds : ds;
    var ms = dates.getMonth() + 1;
    var months = (ms < 10) ? '0' + ms : ms;
    var yys = dates.getYear();
    var years = (yys < 1000) ? yys + 1900 : yys;
    var sekarang = years + "/" + months + "/" + days ;                                   
    if (fld.value != "") { 
    if (depdate > sekarang) {
        fld.style.background = 'Yellow'; 
        error = "Deposit date large than today.\n"
    } else {   
        fld.style.background = 'White';   
    }
    }
    return error;  
}
function validateCek(fld) {
    var error = "";
    var arr = eval(example.jumsit.value);    
    var dep = eval(example.myseat.value);
                                      
    if(arr==0){
        fld.style.background = 'Yellow'; 
        error = "Please Input Min 1 Pax.\n"    
    }else{
        if (dep < arr) {
            fld.style.background = 'Yellow'; 
            error = "Available seat only " + dep + " .\n"
        } else {   
            fld.style.background = 'White';   
        }
    }    
    return error;  
}
function validateSelect(fld) {
    var error = "";
 
    if (fld.value == 0) {
        fld.style.background = 'Yellow'; 
        error = "The required field has not been selected.\n"
    } else {
        fld.style.background = 'White';
    }
    return error;  
}                                          
</script>
<?php 
switch($_GET[act]) {
    // Tampil Office
    default:
        $hariini = date("Y-m-d");
        $thnini = date("Y");
        $targetyear = $_GET['targetyear'];
        if ($targetyear == '') {
            $targetyear = $thnini;
        } else {
            $targetyear = $targetyear;
        }
        echo "<h2>TARGET BSO $targetyear</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='mstarget'>
              Year <select name='targetyear'>";
        $tampil = mysql_query("SELECT * FROM tour_mstarget where TargetYear >= '$thnini' group by TargetYear ORDER BY TargetYear ASC");
        while ($r = mysql_fetch_array($tampil)) {
            if ($targetyear == $r[TargetYear]) {
                echo "<option value='$r[TargetYear]' selected>$r[TargetYear]</option>";
            } else {
                echo "<option value='$r[TargetYear]'>$r[TargetYear]</option>";
            }

        }
        echo "</select>
              <input type=submit name=oke value=Show>
          </form>
          <input type=button value='New Period' onclick=location.href='?module=mstarget&act=tambahtarget'>";
        $oke = $_GET['oke'];
        //pax
        $qdivpanel = mssql_query("SELECT DivisiID FROM [HRM].[dbo].[Divisi]
                                  WHERE Category = 'SALES OUTLET' AND CompanyGroup ='PANORAMA TOURS'
                                  AND Active = 1
                                  order by District ASC,DivisiID ASC");
        $divtampil = mssql_num_rows($qdivpanel);
        if ($divtampil > 0) {
            echo "<center><table style='border: 0px solid #000000;'><td style='border: 0px solid #000000;'>
                    <table><tr><th colspan='15'>TARGET PAX</th></tr>   
                    <tr><th>no</th><th>bso</th><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th><th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Des</th><th>total</th></tr>";
            $no = $posisi + 1;
            $jumlah=0;
            while ($divpanel = mssql_fetch_array($qdivpanel)) {
                $tampil = mysql_query("SELECT * FROM tour_mstarget
                                WHERE TargetYear = '$targetyear'
                                AND TargetBSO = '$divpanel[DivisiID]'
                                ORDER BY TargetBSO ASC");
                $jumlah = mysql_num_rows($tampil);
                $data = mysql_fetch_array($tampil);
                if($jumlah>0) {$klik="?module=mstarget&act=edittarget&id=$data[TargetID]";}
                else {$klik="?module=mstarget&act=tambahbso&bso=$divpanel[DivisiID]";}
                    $totbso = $data[JAN] + $data[FEB] + $data[MAR] + $data[APR] + $data[MAY] + $data[JUN] + $data[JUL] + $data[AUG] + $data[SEP] + $data[OCT] + $data[NOV] + $data[DES];
                    echo "<tr><td>$no</td>
                     <td><a href='$klik'>$divpanel[DivisiID]</a></td>
                     <td><center>$data[JAN]</td>  
                     <td BGCOLOR='#bef5c6'><center>$data[FEB]</td>
                     <td><center>$data[MAR]</td>
                     <td BGCOLOR='#bef5c6'><center>$data[APR]</td>
                     <td><center>$data[MAY]</td>
                     <td BGCOLOR='#bef5c6'><center>$data[JUN]</td>
                     <td><center>$data[JUL]</td>
                     <td BGCOLOR='#bef5c6'><center>$data[AUG]</td>
                     <td><center>$data[SEP]</td>
                     <td BGCOLOR='#bef5c6'><center>$data[OCT]</td>
                     <td><center>$data[NOV]</td>
                     <td BGCOLOR='#bef5c6'><center>$data[DES]</td>
                     <td><center><font color=red>$totbso</font></td>
                     </tr>";
                    $no++;
               // }
            }
            $qdiv = mssql_query("SELECT DivisiID FROM [HRM].[dbo].[Divisi] WHERE Active = 1 ");
            while($divactive = mssql_fetch_array($qdiv)) {
                $tampils = mysql_query("SELECT JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DES FROM tour_mstarget
                                WHERE TargetYear = '$targetyear' AND TargetBSO = '$divactive[DivisiID]' ");
                $datas = mysql_fetch_array($tampils);

                $sumjan = $sumjan + $datas[JAN]; $sumfeb = $sumfeb + $datas[FEB]; $summar = $summar + $datas[MAR];
                $sumapr = $sumapr + $datas[APR]; $summay = $summay + $datas[MAY]; $sumjun = $sumjun + $datas[JUN];
                $sumjul = $sumjul + $datas[JUL]; $sumaug = $sumaug + $datas[AUG]; $sumsep = $sumsep + $datas[SEP];
                $sumoct = $sumoct + $datas[OCT]; $sumnov = $sumnov + $datas[NOV]; $sumdes = $sumdes + $datas[DES];
                $sum1 = $datas[JAN]+$datas[FEB]+$datas[MAR]+$datas[APR]+$datas[MAY]+$datas[JUN]+$datas[JUL]+$datas[AUG]+$datas[SEP]+$datas[OCT]+$datas[NOV]+$datas[DES];
                $totals = $totals + $sum1;

                $tampilj = mysql_query("SELECT JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DES,JANA,FEBA,MARA,APRA,MAYA,JUNA,JULA,AUGA,SEPA,OCTA,NOVA,DESA FROM tour_mstarget
                                WHERE TargetYear = '$targetyear'
                                AND TargetArea = 'JAKARTA'
                                AND TargetBSO = '$divactive[DivisiID]' ");
                $dataj = mysql_fetch_array($tampilj);

                $jsumjan = $jsumjan + $dataj[JAN]; $jsumfeb = $jsumfeb + $dataj[FEB]; $jsummar = $jsummar + $dataj[MAR];
                $jsumapr = $jsumapr + $dataj[APR]; $jsummay = $jsummay + $dataj[MAY]; $jsumjun = $jsumjun + $dataj[JUN];
                $jsumjul = $jsumjul + $dataj[JUL]; $jsumaug = $jsumaug + $dataj[AUG]; $jsumsep = $jsumsep + $dataj[SEP];
                $jsumoct = $jsumoct + $dataj[OCT]; $jsumnov = $jsumnov + $dataj[NOV]; $jsumdes = $jsumdes + $dataj[DES];

                $tjsumjan = $tjsumjan + $dataj[JANA]; $tjsumfeb = $tjsumfeb + $dataj[FEBA]; $tjsummar = $tjsummar + $dataj[MARA];
                $tjsumapr = $tjsumapr + $dataj[APRA]; $tjsummay = $tjsummay + $dataj[MAYA]; $tjsumjun = $tjsumjun + $dataj[JUNA];
                $tjsumjul = $tjsumjul + $dataj[JULA]; $tjsumaug = $tjsumaug + $dataj[AUGA]; $tjsumsep = $tjsumsep + $dataj[SEPA];
                $tjsumoct = $tjsumoct + $dataj[OCTA]; $tjsumnov = $tjsumnov + $dataj[NOVA]; $tjsumdes = $tjsumdes + $dataj[DESA];

                $sum2 = $dataj[JAN]+$dataj[FEB]+$dataj[MAR]+$dataj[APR]+$dataj[MAY]+$dataj[JUN]+$dataj[JUL]+$dataj[AUG]+$dataj[SEP]+$dataj[OCT]+$dataj[NOV]+$dataj[DES];
                $totalj = $totalj + $sum2;
                $sum3 = $dataj[JANA]+$dataj[FEBA]+$dataj[MARA]+$dataj[APRA]+$dataj[MAYA]+$dataj[JUNA]+$dataj[JULA]+$dataj[AUGA]+$dataj[SEPA]+$dataj[OCTA]+$dataj[NOVA]+$dataj[DESA];
                $totalja = $totalja + $sum3;

                $tampiln = mysql_query("SELECT JAN,FEB,MAR,APR,MAY,JUN,JUL,AUG,SEP,OCT,NOV,DES,JANA,FEBA,MARA,APRA,MAYA,JUNA,JULA,AUGA,SEPA,OCTA,NOVA,DESA FROM tour_mstarget
                                WHERE TargetYear = '$targetyear'
                                AND TargetArea = 'NON JAKARTA'
                                AND TargetBSO = '$divactive[DivisiID]' ");
                $datan = mysql_fetch_array($tampiln);

                $nsumjan = $nsumjan + $datan[JAN]; $nsumfeb = $nsumfeb + $datan[FEB]; $nsummar = $nsummar + $datan[MAR];
                $nsumapr = $nsumapr + $datan[APR]; $nsummay = $nsummay + $datan[MAY]; $nsumjun = $nsumjun + $datan[JUN];
                $nsumjul = $nsumjul + $datan[JUL]; $nsumaug = $nsumaug + $datan[AUG]; $nsumsep = $nsumsep + $datan[SEP];
                $nsumoct = $nsumoct + $datan[OCT]; $nsumnov = $nsumnov + $datan[NOV]; $nsumdes = $nsumdes + $datan[DES];

                $tnsumjan = $tnsumjan + $datan[JANA]; $tnsumfeb = $tnsumfeb + $datan[FEBA]; $tnsummar = $tnsummar + $datan[MARA];
                $tnsumapr = $tnsumapr + $datan[APRA]; $tnsummay = $tnsummay + $datan[MAYA]; $tnsumjun = $tnsumjun + $datan[JUNA];
                $tnsumjul = $tnsumjul + $datan[JULA]; $tnsumaug = $tnsumaug + $datan[AUGA]; $tnsumsep = $tnsumsep + $datan[SEPA];
                $tnsumoct = $tnsumoct + $datan[OCTA]; $tnsumnov = $tnsumnov + $datan[NOVA]; $tnsumdes = $tnsumdes + $datan[DESA];

                $sum4 = $datan[JAN]+$datan[FEB]+$datan[MAR]+$datan[APR]+$datan[MAY]+$datan[JUN]+$datan[JUL]+$datan[AUG]+$datan[SEP]+$datan[OCT]+$datan[NOV]+$datan[DES];
                $totaln = $totaln + $sum4;
                $sum5 = $datan[JANA]+$datan[FEBA]+$datan[MARA]+$datan[APRA]+$datan[MAYA]+$datan[JUNA]+$datan[JULA]+$datan[AUGA]+$datan[SEPA]+$datan[OCTA]+$datan[NOVA]+$datan[DESA];
                $totalna = $totalna + $sum5;
            }
            $inret = mysql_query("SELECT * FROM tour_rate
                                WHERE RateYear = '$targetyear'
                                ORDER BY RateID ASC");
            $ret = mysql_fetch_array($inret);
            //$totals = $datas[TJAN] + $datas[TFEB] + $datas[TMAR] + $datas[TAPR] + $datas[TMAY] + $datas[TJUN] + $datas[TJUL] + $datas[TAUG] + $datas[TSEP] + $datas[TOCT] + $datas[TNOV] + $datas[TDES];
            //$totalj = $dataj[TJAN] + $dataj[TFEB] + $dataj[TMAR] + $dataj[TAPR] + $dataj[TMAY] + $dataj[TJUN] + $dataj[TJUL] + $dataj[TAUG] + $dataj[TSEP] + $dataj[TOCT] + $dataj[TNOV] + $dataj[TDES];
            //$totaln = $datan[TJAN] + $datan[TFEB] + $datan[TMAR] + $datan[TAPR] + $datan[TMAY] + $datan[TJUN] + $datan[TJUL] + $datan[TAUG] + $datan[TSEP] + $datan[TOCT] + $datan[TNOV] + $datan[TDES];
            //$totalja = $dataj[JTJAN] + $dataj[JTFEB] + $dataj[JTMAR] + $dataj[JTAPR] + $dataj[JTMAY] + $dataj[JTJUN] + $dataj[JTJUL] + $dataj[JTAUG] + $dataj[JTSEP] + $dataj[JTOCT] + $dataj[JTNOV] + $dataj[JTDES];
            //$totalna = $datan[JTJAN] + $datan[JTFEB] + $datan[JTMAR] + $datan[JTAPR] + $datan[JTMAY] + $datan[JTJUN] + $datan[JTJUL] + $datan[JTAUG] + $datan[JTSEP] + $datan[JTOCT] + $datan[JTNOV] + $datan[JTDES];
            echo "
                    <tr><td colspan=2><center><b>TOTAL</b></td><td><center><font color=red><b>$sumjan</b></font></td><td><center><font color=red><b>$sumfeb</b></font></td><td><center><font color=red><b>$summar</b<</font></td>
                    <td><center><font color=red><b>$sumapr</b></font></td><td><center><font color=red><b>$summay</b></font></td><td><center><b><font color=red>$sumjun</b></font></td>
                    <td><center><font color=red><b>$sumjul</b></font></td><td><center><font color=red><b>$sumaug</b></font></td><td><center><b><font color=red>$sumsep</b></font></td>
                    <td><center><font color=red><b>$sumoct</b></font></td><td><center><font color=red><b>$sumnov</b></font></td><td><center><b><font color=red>$sumdes</b></font></td>
                    </td><td><center><font color=red><b>$totals</b></font></td></tr>
                    </table></td><td style='border: 0px solid #000000;' width='100'></td><td style='border: 0px solid #000000;'>
                    <table>
                    <tr><th colspan=2><center>$targetyear</th><th colspan=2>JAKARTA</th><th colspan=2>NON JAKARTA</th></tr>
                    <tr><th>month</th><th><a href='?module=mstarget&act=editrate&id=$ret[RateID]' style='color:white'>rate USD</a></th><th>pax</th><th>amount</th><th>pax</th><th>amount</th></tr>
                    <tr><th>January</th><td style='text-align:right'>" . number_format($ret[JAN], 0, '', '.');
            echo "</td>
                    <td><center><font color=red>$jsumjan</font></td><td style='text-align:right'><font color=red>" . number_format($tjsumjan, 0, '', '.');
            echo "</font></td>
                    <td><center><font color=red>$nsumjan</font></td><td style='text-align:right'><font color=red>" . number_format($tnsumjan, 0, '', '.');
            echo "</font></td></tr>
                    <tr><th>February</th><td style='text-align:right'>" . number_format($ret[FEB], 0, '', '.');
            echo "</td>
                    <td><center><font color=red>$jsumfeb</font></td><td style='text-align:right'><font color=red>" . number_format($tjsumfeb, 0, '', '.');
            echo "</font></td>
                    <td><center><font color=red>$nsumfeb</font></td><td style='text-align:right'><font color=red>" . number_format($tnsumfeb, 0, '', '.');
            echo "</font></td></tr>
                    <tr><th>March</th><td style='text-align:right'>" . number_format($ret[MAR], 0, '', '.');
            echo "</td>
                    <td><center><font color=red>$jsummar</b<</font></td><td style='text-align:right'><font color=red>" . number_format($tjsummar, 0, '', '.');
            echo "</font></td>
                    <td><center><font color=red>$nsummar</b<</font></td><td style='text-align:right'><font color=red>" . number_format($tnsummar, 0, '', '.');
            echo "</font></td></tr>
                    <tr><th>April</th><td style='text-align:right'>" . number_format($ret[APR], 0, '', '.');
            echo "</td>
                    <td><center><font color=red>$jsumapr</font></td><td style='text-align:right'><font color=red>" . number_format($tjsumapr, 0, '', '.');
            echo "</font></td>
                    <td><center><font color=red>$nsumapr</font></td><td style='text-align:right'><font color=red>" . number_format($tnsumapr, 0, '', '.');
            echo "</font></td></tr>
                    <tr><th>May</th><td style='text-align:right'>" . number_format($ret[MAY], 0, '', '.');
            echo "</td>
                    <td><center><font color=red>$jsummay</font></td><td style='text-align:right'><font color=red>" . number_format($tjsummay, 0, '', '.');
            echo "</font></td>
                    <td><center><font color=red>$nsummay</font></td><td style='text-align:right'><font color=red>" . number_format($tnsummay, 0, '', '.');
            echo "</font></td></tr>
                    <tr><th>June</th><td style='text-align:right'>" . number_format($ret[JUN], 0, '', '.');
            echo "</td>
                    <td><center><font color=red>$jsumjun</font></td><td style='text-align:right'><font color=red>" . number_format($tjsumjun, 0, '', '.');
            echo "</font></td>
                    <td><center><font color=red>$nsumjun</font></td><td style='text-align:right'><font color=red>" . number_format($tnsumjun, 0, '', '.');
            echo "</font></td></tr>
                    <tr><th>July</th><td style='text-align:right'>" . number_format($ret[JUL], 0, '', '.');
            echo "</td>
                    <td><center><font color=red>$jsumjul</font></td><td style='text-align:right'><font color=red>" . number_format($tjsumjul, 0, '', '.');
            echo "</font></td>
                    <td><center><font color=red>$nsumjul</font></td><td style='text-align:right'><font color=red>" . number_format($tnsumjul, 0, '', '.');
            echo "</font></td></tr>
                    <tr><th>August</th><td style='text-align:right'>" . number_format($ret[AUG], 0, '', '.');
            echo "</td>
                    <td><center><font color=red>$jsumaug</font></td><td style='text-align:right'><font color=red>" . number_format($tjsumaug, 0, '', '.');
            echo "</font></td>
                    <td><center><font color=red>$nsumaug</font></td><td style='text-align:right'><font color=red>" . number_format($tnsumaug, 0, '', '.');
            echo "</font></td></tr>
                    <tr><th>September</th><td style='text-align:right'>" . number_format($ret[SEP], 0, '', '.');
            echo "</td>
                    <td><center><font color=red>$jsumsep</font></td><td style='text-align:right'><font color=red>" . number_format($tjsumsep, 0, '', '.');
            echo "</font></td>
                    <td><center><font color=red>$nsumsep</font></td><td style='text-align:right'><font color=red>" . number_format($tnsumsep, 0, '', '.');
            echo "</font></td></tr>
                    <tr><th>October</th><td style='text-align:right'>" . number_format($ret[OCT], 0, '', '.');
            echo "</td>
                    <td><center><font color=red>$jsumoct</font></td><td style='text-align:right'><font color=red>" . number_format($tjsumoct, 0, '', '.');
            echo "</font></td>
                    <td><center><font color=red>$nsumoct</font></td><td style='text-align:right'><font color=red>" . number_format($tnsumoct, 0, '', '.');
            echo "</font></td></tr>
                    <tr><th>November</th><td style='text-align:right'>" . number_format($ret[NOV], 0, '', '.');
            echo "</td>
                    <td><center><font color=red>$jsumnov</font></td><td style='text-align:right'><font color=red>" . number_format($tjsumnov, 0, '', '.');
            echo "</font></td>
                    <td><center><font color=red>$nsumnov</font></td><td style='text-align:right'><font color=red>" . number_format($tnsumnov, 0, '', '.');
            echo "</font></td></tr>
                    <tr><th>December</th><td style='text-align:right'>" . number_format($ret[DES], 0, '', '.');
            echo "</td>
                    <td><center><font color=red>$jsumdes</font></td><td style='text-align:right'><font color=red>" . number_format($tjsumdes, 0, '', '.');
            echo "</font></td>
                    <td><center><font color=red>$nsumdes</font></td><td style='text-align:right'><font color=red>" . number_format($tnsumdes, 0, '', '.');
            echo "</font></td></tr>
                    <tr><td colspan=2><center><b>TOTAL</b></td><td><center><font color=red><b>$totalj</b></font></td></td><td style='text-align:right'><font color=red><b>" . number_format($totalja, 0, '', '.');
            echo "</b></font></td>
                    <td><center><font color=red><b>$totaln</b></font></td></td><td style='text-align:right'><font color=red><b>" . number_format($totalna, 0, '', '.');
            echo "</b></font></td>
                    </tr></table>
                    </td></table>
                    </center>";
        }
        //amount
        $tampils = mysql_query("SELECT * FROM tour_mstarget
                                WHERE TargetYear = '$targetyear'
                                ORDER BY tour_mstarget.TargetBSO ASC");

        $jumlahs = mysql_num_rows($tampils);

        if ($jumlahs > 0) {
            echo "<font size='1' color='red'>* Amount in IDR</font>  
            <center><table><tr><th colspan='15'>TARGET AMOUNT</th></tr>   
                    <tr><th>no</th><th>bso</th><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th><th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Des</th><th>total</th></tr>";
            $no = $posisi + 1;
            while ($datas = mysql_fetch_array($tampils)) {
                $qdivpanel = mssql_query("SELECT DivisiID FROM [HRM].[dbo].[Divisi] 
                                              WHERE DivisiID = '$datas[TargetBSO]' 
                                              AND CompanyGroup ='PANORAMA TOURS'
                                              AND Active = 1 ");
                $divtampil = mssql_num_rows($qdivpanel);
                if($divtampil>0) {
                    $divpanel = mssql_fetch_array($qdivpanel);
                    $totbso = $datas[JANA] + $datas[FEBA] + $datas[MARA] + $datas[APRA] + $datas[MAYA] + $datas[JUNA] + $datas[JULA] + $datas[AUGA] + $datas[SEPA] + $datas[OCTA] + $datas[NOVA] + $datas[DESA];
                    echo "<tr><td>$no</td>
                     <td><a href='?module=mstarget&act=edittarget&id=$datas[TargetID]'>$divpanel[DivisiID]</a></td>
                     <td style='text-align:right'>" . number_format($datas[JANA], 0, '', '.');
                    echo "</td>
                     <td style='text-align:right' BGCOLOR='#bef5c6'>" . number_format($datas[FEBA], 0, '', '.');
                    echo "</td>
                     <td style='text-align:right'>" . number_format($datas[MARA], 0, '', '.');
                    echo "</td>
                     <td style='text-align:right' BGCOLOR='#bef5c6'>" . number_format($datas[APRA], 0, '', '.');
                    echo "</td>
                     <td style='text-align:right'>" . number_format($datas[MAYA], 0, '', '.');
                    echo "</td>
                     <td style='text-align:right' BGCOLOR='#bef5c6'>" . number_format($datas[JUNA], 0, '', '.');
                    echo "</td>
                     <td style='text-align:right'>" . number_format($datas[JULA], 0, '', '.');
                    echo "</td>
                     <td style='text-align:right' BGCOLOR='#bef5c6'>" . number_format($datas[AUGA], 0, '', '.');
                    echo "</td>
                     <td style='text-align:right'>" . number_format($datas[SEPA], 0, '', '.');
                    echo "</td>
                     <td style='text-align:right' BGCOLOR='#bef5c6'>" . number_format($datas[OCTA], 0, '', '.');
                    echo "</td>
                     <td style='text-align:right'>" . number_format($datas[NOVA], 0, '', '.');
                    echo "</td>
                     <td style='text-align:right' BGCOLOR='#bef5c6'>" . number_format($datas[DESA], 0, '', '.');
                    echo "</td>
                     <td style='text-align:right'><font color=red>" . number_format($totbso, 0, '', '.');
                    echo "</font></td></tr>";
                    $no++;
                }
            }
            $qdiv = mssql_query("SELECT DivisiID FROM [HRM].[dbo].[Divisi] WHERE Active = 1 ");
            while($divactive = mssql_fetch_array($qdiv)) {
                $tampils = mysql_query("SELECT JANA,FEBA,MARA,APRA,MAYA,JUNA,JULA,AUGA,SEPA,OCTA,NOVA,DESA FROM tour_mstarget
                                WHERE TargetYear = '$targetyear' AND TargetBSO = '$divactive[DivisiID]' ");
                $datas = mysql_fetch_array($tampils);

                $asumjan = $asumjan + $datas[JANA];
                $asumfeb = $asumfeb + $datas[FEBA];
                $asummar = $asummar + $datas[MARA];
                $asumapr = $asumapr + $datas[APRA];
                $asummay = $asummay + $datas[MAYA];
                $asumjun = $asumjun + $datas[JUNA];
                $asumjul = $asumjul + $datas[JULA];
                $asumaug = $asumaug + $datas[AUGA];
                $asumsep = $asumsep + $datas[SEPA];
                $asumoct = $asumoct + $datas[OCTA];
                $asumnov = $asumnov + $datas[NOVA];
                $asumdes = $asumdes + $datas[DESA];
                $asum1 = $datas[JANA] + $datas[FEBA] + $datas[MARA] + $datas[APRA] + $datas[MAYA] + $datas[JUNA] + $datas[JULA] + $datas[AUGA] + $datas[SEPA] + $datas[OCTA] + $datas[NOVA] + $datas[DESA];
                $atotals = $atotals + $asum1;
            }
            //$totals = $datas[TJAN] + $datas[TFEB] + $datas[TMAR] + $datas[TAPR] + $datas[TMAY] + $datas[TJUN] + $datas[TJUL] + $datas[TAUG] + $datas[TSEP] + $datas[TOCT] + $datas[TNOV] + $datas[TDES];
            echo "
                    <tr><td colspan=2 ><center><b>TOTAL</b></td><td><center><font color=red><b>" . number_format($asumjan, 0, '', '.');
            echo "</b></font></td><td><center><font color=red><b>" . number_format($asumfeb, 0, '', '.');
            echo "</b></font></td><td><center><font color=red><b>" . number_format($asummar, 0, '', '.');
            echo "</b<</font></td>
                    <td><center><font color=red><b>" . number_format($asumapr, 0, '', '.');
            echo "</b></font></td><td><center><font color=red><b>" . number_format($asummay, 0, '', '.');
            echo "</b></font></td><td><center><b><font color=red>" . number_format($asumjun, 0, '', '.');
            echo "</b></font></td>
                    <td><center><font color=red><b>" . number_format($asumjul, 0, '', '.');
            echo "</b></font></td><td><center><font color=red><b>" . number_format($asumaug, 0, '', '.');
            echo "</b></font></td><td><center><b><font color=red>" . number_format($asumsep, 0, '', '.');
            echo "</b></font></td>
                    <td><center><font color=red><b>" . number_format($asumoct, 0, '', '.');
            echo "</b></font></td><td><center><font color=red><b>" . number_format($asumnov, 0, '', '.');
            echo "</b></font></td><td><center><b><font color=red>" . number_format($asumdes, 0, '', '.');
            echo "</b></font></td>
                    </td><td><center><font color=red><b>" . number_format($atotals, 0, '', '.');
            echo "</b></font></td></tr>
                    </table>";
        }
        break;

    case "tambahtarget":
        $cuma = mysql_query("SELECT * FROM tour_mstarget group by TargetYear  
                                    ORDER BY TargetYear DESC limit 1");
        $saja = mysql_fetch_array($cuma);
        $neksyear = $saja[TargetYear] + 1;
        echo "<h2>New Target for $neksyear</h2>
          
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=mstarget&act=input' >
          <table><input type='hidden' name='neksyear' value='$neksyear'><input type='hidden' name='disyear' value='$saja[TargetYear]'>
          <tr><td>PAX</td><td><select name='operate'><option value='+'>Increase</option><option value='-'>Decrease</option></select> Target from $saja[TargetYear]</td> <td><input type=text name='incpersen' size='3' value='0' onkeyup=isNumber(this)> %</td></tr>   
          <tr><td>AMOUNT</td><td><select name='operatea'><option value='+'>Increase</option><option value='-'>Decrease</option></select> Target from $saja[TargetYear]</td> <td><input type=text name='incpersena' size='3' value='0' onkeyup=isNumber(this)> %</td></tr>   
          <tr><td colspan=2><center><input type='submit' name='submit' value=Create >
                            <input type=button value=Cancel onclick=location.href='?module=mstarget'></td></tr>
          </table> </form>
          <br><br>";
        break;

    case "tambahbso":
        $hariini = date("Y-m-d");
        $thnini = date("Y");
        $bso=$_GET['bso'];
        echo "<h2>New BSO in target</h2>";
        echo "<form name='example' method='POST' onsubmit='return validateFormOnBSO(this)' action='./aksi.php?module=mstarget&act=insertbso' >
                    <input type='hidden' name='thn' value='$thnini'>
                    <center>New BSO <input type='text' name='targetbso' value='$bso'>

                    <table><tr><th>month</th><th>pax</th><th>amount</th></tr>
                    <tr><th>January</th><td><input type=text style='text-align:center' name='jan' value='0' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='jana' value='0' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>February</th><td><input type=text style='text-align:center' name='feb' value='0' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='feba' value='0' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>March</th><td><input type=text style='text-align:center' name='mar' value='0' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='mara' value='0' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>April</th><td><input type=text style='text-align:center' name='apr' value='0' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='apra' value='0' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>May</th><td><input type=text style='text-align:center' name='may' value='0' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='maya' value='0' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>June</th><td><input type=text name='jun' style='text-align:center' value='0' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='juna' value='0' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>July</th><td><input type=text name='jul' style='text-align:center' value='0' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='jula' value='0' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>August</th><td><input type=text name='aug' style='text-align:center' value='0' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='auga' value='0' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>September</th><td><input type=text name='sep' style='text-align:center' value='0' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='sepa' value='0' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>October</th><td><input type=text name='oct' style='text-align:center' value='0' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='octa' value='0' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>November</th><td><input type=text name='nov' style='text-align:center' value='0' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='nova' value='0' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>December</th><td><input type=text name='des' style='text-align:center' value='0' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='desa' value='0' size='10' onkeyup=isNumber(this)> IDR</td></tr>   
                    </table>
                    <center><input type='submit' name='submit' value='Insert'> <input type=button value='Cancel' onclick=location.href='?module=mstarget&targetyear=$data[TargetYear]'>
                    </form><br><br>";
        break;

    case "edittarget":
        $hariini = date("Y-m-d");
        $thnini = date("Y");
        $targetid = $_GET[id];
        $tampil = mysql_query("SELECT * FROM tour_mstarget
                                WHERE TargetID = '$targetid'");
        $data = mysql_fetch_array($tampil);
        echo "<h2>TARGET $data[TargetBSO] $data[TargetYear]</h2>";
        echo "<form name='example' method='POST' onsubmit='return validateFormOnBlank(this)' action='./aksi.php?module=mstarget&act=update' >
                    <input type='hidden' name='id' value='$targetid'><input type='hidden' name='thn' value='$data[TargetYear]'>
                    <center><table><tr><th>month</th><th>pax</th><th>amount</th></tr>
                    <tr><th>January</th><td><input type=text style='text-align:center' name='jan' value='$data[JAN]' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='jana' value='$data[JANA]' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>February</th><td><input type=text style='text-align:center' name='feb' value='$data[FEB]' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='feba' value='$data[FEBA]' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>March</th><td><input type=text style='text-align:center' name='mar' value='$data[MAR]' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='mara' value='$data[MARA]' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>April</th><td><input type=text style='text-align:center' name='apr' value='$data[APR]' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='apra' value='$data[APRA]' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>May</th><td><input type=text style='text-align:center' name='may' value='$data[MAY]' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='maya' value='$data[MAYA]' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>June</th><td><input type=text name='jun' style='text-align:center' value='$data[JUN]' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='juna' value='$data[JUNA]' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>July</th><td><input type=text name='jul' style='text-align:center' value='$data[JUL]' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='jula' value='$data[JULA]' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>August</th><td><input type=text name='aug' style='text-align:center' value='$data[AUG]' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='auga' value='$data[AUGA]' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>September</th><td><input type=text name='sep' style='text-align:center' value='$data[SEP]' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='sepa' value='$data[SEPA]' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>October</th><td><input type=text name='oct' style='text-align:center' value='$data[OCT]' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='octa' value='$data[OCTA]' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>November</th><td><input type=text name='nov' style='text-align:center' value='$data[NOV]' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='nova' value='$data[NOVA]' size='10' onkeyup=isNumber(this)> IDR</td></tr>
                    <tr><th>December</th><td><input type=text name='des' style='text-align:center' value='$data[DES]' size='6' onkeyup=isNumber(this)></td><td><input type=text style='text-align:right' name='desa' value='$data[DESA]' size='10' onkeyup=isNumber(this)> IDR</td></tr>   
                    </table>
                    <input type='submit' name='submit' value='Update'> <input type=button value='Cancel' onclick=location.href='?module=mstarget&targetyear=$data[TargetYear]'>
                    </form><br><br>";
        break;

    case "tambahrate":
        $thnini = date("Y");
        $cuma = mysql_query("SELECT * FROM tour_rate group by RateYear  
                                    ORDER BY RateYear DESC limit 1");
        $saja = mysql_fetch_array($cuma);
        if ($saja[RateYear] == '') {
            $neksyear = $thnini;
        } else {
            $neksyear = $saja[RateYear] + 1;
        }
        echo "<h2>New Rate for $neksyear</h2>
          
          <form name='example' method='POST' onsubmit='return validateRate(this)' action='./aksi.php?module=msrate&act=input' >
          <input type='hidden' name='thn' value='$neksyear'>
          <center><table><tr><th>month</th><th width='50'>USD</th><th>IDR</th></tr>
                    <tr><th>January</th><td><center>1</td><td><input type=text style='text-align:right' name='jan' value='0' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>February</th><td><center>1</td><td><input type=text style='text-align:right' name='feb' value='0' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>March</th><td><center>1</td><td><input type=text style='text-align:right' name='mar' value='0' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>April</th><td><center>1</td><td><input type=text style='text-align:right' name='apr' value='0' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>May</th><td><center>1</td><td><input type=text style='text-align:right' name='may' value='0' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>June</th><td><center>1</td><td><input type=text style='text-align:right' name='jun' value='0' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>July</th><td><center>1</td><td><input type=text style='text-align:right' name='jul' value='0' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>August</th><td><center>1</td><td><input type=text style='text-align:right' name='aug' value='0' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>September</th><td><center>1</td><td><input type=text style='text-align:right' name='sep' value='0' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>October</th><td><center>1</td><td><input type=text style='text-align:right' name='oct' value='0' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>November</th><td><center>1</td><td><input type=text style='text-align:right' name='nov' value='0' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>December</th><td><center>1</td><td><input type=text style='text-align:right' name='des' value='0' size='10' onkeyup=isNumber(this)></td></tr>   
                    </table>
                    <center><input type='submit' name='submit' value='Insert'> <input type=button value='Cancel' onclick=location.href='?module=mstarget&targetyear=$data[TargetYear]'>
                    </form><br><br>";
        break;
    case "editrate":

        $rateid = $_GET[id];
        $tampil = mysql_query("SELECT * FROM tour_rate
                                WHERE RateID = '$rateid'");
        $data = mysql_fetch_array($tampil);
        echo "<h2>Edit Rate for $data[RateYear]</h2>
          
          <form name='example' method='POST' onsubmit='return validateRate(this)' action='./aksi.php?module=msrate&act=update' >
          <input type='hidden' name='id' value='$rateid'><input type='hidden' name='thn' value='$data[RateYear]'>
          <center><table><tr><th>month</th><th width='50'>USD</th><th>IDR</th></tr>
                    <tr><th>January</th><td><center>1</td><td><input type=text style='text-align:right' name='jan' value='$data[JAN]' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>February</th><td><center>1</td><td><input type=text style='text-align:right' name='feb' value='$data[FEB]' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>March</th><td><center>1</td><td><input type=text style='text-align:right' name='mar' value='$data[MAR]' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>April</th><td><center>1</td><td><input type=text style='text-align:right' name='apr' value='$data[APR]' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>May</th><td><center>1</td><td><input type=text style='text-align:right' name='may' value='$data[MAY]' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>June</th><td><center>1</td><td><input type=text style='text-align:right' name='jun' value='$data[JUN]' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>July</th><td><center>1</td><td><input type=text style='text-align:right' name='jul' value='$data[JUL]' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>August</th><td><center>1</td><td><input type=text style='text-align:right' name='aug' value='$data[AUG]' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>September</th><td><center>1</td><td><input type=text style='text-align:right' name='sep' value='$data[SEP]' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>October</th><td><center>1</td><td><input type=text style='text-align:right' name='oct' value='$data[OCT]' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>November</th><td><center>1</td><td><input type=text style='text-align:right' name='nov' value='$data[NOV]' size='10' onkeyup=isNumber(this)></td></tr>
                    <tr><th>December</th><td><center>1</td><td><input type=text style='text-align:right' name='des' value='$data[DES]' size='10' onkeyup=isNumber(this)></td></tr>   
                    </table>
                    <center><input type='submit' name='submit' value='Update'> <input type=button value='Cancel' onclick=location.href='?module=mstarget&targetyear=$data[TargetYear]'>
                    </form><br><br>";
        break;
}
?>
