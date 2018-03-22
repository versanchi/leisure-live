<script language="JavaScript"  type="text/javascript">   
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
function delfile(ID, SUPPLIER, cat,no)
{
if (confirm("Are you sure you want to delete " + SUPPLIER +" ("+ cat +") "))
{
 window.location.href = '?module=mstargetpotmr&act=deletedetail&id=' + ID + '&no=' + no ;
 
} 
}
 
</script>
<script type="text/javascript">

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
function trim(s)
{
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
switch($_GET[act]){
  // Tampil Office
  default:
      $hariini = date("Y-m-d");
      $thnini = date("Y");
      $targetyear=$_GET['targetyear'];        
      if($targetyear==''){$targetyear=$thnini;}else{$targetyear=$targetyear;}               
    echo "<h2>TARGET TMR $targetyear</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='mstargetpotmr'>
              Year <select name='targetyear'>";                                  
            $tampil=mysql_query("SELECT * FROM tour_mstargetpotmr where TargetYear >= '$thnini' group by TargetYear ORDER BY TargetYear ASC");
            while($r=mysql_fetch_array($tampil)){
                if($targetyear==$r[TargetYear]){
                    echo "<option value='$r[TargetYear]' selected>$r[TargetYear]</option>";     
                }else{
                    echo "<option value='$r[TargetYear]'>$r[TargetYear]</option>"; 
                }
                
            }
            $dis=mysql_num_rows($tampil);
            if($dis>0){$visper='enable';}else{$visper='disabled';}
    echo "</select>
              <input type=submit name=oke value=Show>
          </form>
          <input type=button value='New Period' onclick=location.href='?module=mstargetpotmr&act=tambahtarget' $visper> 
          <input type=button value='Insert New Destination' onclick=location.href='?module=mstargetpotmr&act=tambahpo'>";
          $oke=$_GET['oke'];      
          //pax
          $tampil=mysql_query("SELECT * FROM tour_mstargetpotmr   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeArea = tour_mstargetpotmr.TargetBSO
                                WHERE TargetYear = '$targetyear'
                                AND ProductcodeStatus='ACTIVE'
                                group by ProductcodeArea
                                ORDER BY ProductcodeArea ASC,tour_mstargetpotmr.TargetBSO ASC");
          
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {                                                                                          
            echo "<center><table class='bordered'><tr><th colspan='15'>TARGET PAX</th></tr>
                    <tr><th>no</th><th>bso</th><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th><th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Des</th><th>total</th></tr>";
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
                    $totbso=$data[JAN]+$data[FEB]+$data[MAR]+$data[APR]+$data[MAY]+$data[JUN]+$data[JUL]+$data[AUG]+$data[SEP]+$data[OCT]+$data[NOV]+$data[DES];       
               echo "<tr><td>$no</td>
                     <td><a href='?module=mstargetpotmr&act=edittarget&id=$data[TargetID]'>$data[TargetBSO]</a></td>                                   
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
                    }
                    $tampils=mysql_query("SELECT sum(JAN)as TJAN,sum(FEB)as TFEB,sum(MAR)as TMAR,sum(APR)as TAPR,sum(MAY)as TMAY,sum(JUN)as TJUN,sum(JUL)as TJUL,
                                            sum(AUG)as TAUG,sum(SEP)as TSEP,sum(OCT)as TOCT,sum(NOV)as TNOV,sum(DES)as TDES FROM tour_mstargetpotmr   
                                WHERE TargetYear = '$targetyear'
                                ORDER BY tour_mstargetpotmr.TargetBSO ASC");
                    $datas=mysql_fetch_array($tampils);

                    $inret=mysql_query("SELECT * FROM tour_rate   
                                WHERE RateYear = '$targetyear'
                                ORDER BY RateID ASC");     
                    $ret=mysql_fetch_array($inret);
                    $totals=$datas[TJAN]+$datas[TFEB]+$datas[TMAR]+$datas[TAPR]+$datas[TMAY]+$datas[TJUN]+$datas[TJUL]+$datas[TAUG]+$datas[TSEP]+$datas[TOCT]+$datas[TNOV]+$datas[TDES]; 
                    $totalj=$dataj[TJAN]+$dataj[TFEB]+$dataj[TMAR]+$dataj[TAPR]+$dataj[TMAY]+$dataj[TJUN]+$dataj[TJUL]+$dataj[TAUG]+$dataj[TSEP]+$dataj[TOCT]+$dataj[TNOV]+$dataj[TDES]; 
                    $totaln=$datan[TJAN]+$datan[TFEB]+$datan[TMAR]+$datan[TAPR]+$datan[TMAY]+$datan[TJUN]+$datan[TJUL]+$datan[TAUG]+$datan[TSEP]+$datan[TOCT]+$datan[TNOV]+$datan[TDES]; 
                    $totalja=$dataj[JTJAN]+$dataj[JTFEB]+$dataj[JTMAR]+$dataj[JTAPR]+$dataj[JTMAY]+$dataj[JTJUN]+$dataj[JTJUL]+$dataj[JTAUG]+$dataj[JTSEP]+$dataj[JTOCT]+$dataj[JTNOV]+$dataj[JTDES]; 
                    $totalna=$datan[JTJAN]+$datan[JTFEB]+$datan[JTMAR]+$datan[JTAPR]+$datan[JTMAY]+$datan[JTJUN]+$datan[JTJUL]+$datan[JTAUG]+$datan[JTSEP]+$datan[JTOCT]+$datan[JTNOV]+$datan[JTDES]; 
                    echo "    
                    <tr><td colspan=2><center><b>TOTAL</b></td><td><center><font color=red><b>$datas[TJAN]</b></font></td><td><center><font color=red><b>$datas[TFEB]</b></font></td><td><center><font color=red><b>$datas[TMAR]</b<</font></td>
                    <td><center><font color=red><b>$datas[TAPR]</b></font></td><td><center><font color=red><b>$datas[TMAY]</b></font></td><td><center><b><font color=red>$datas[TJUN]</b></font></td>
                    <td><center><font color=red><b>$datas[TJUL]</b></font></td><td><center><font color=red><b>$datas[TAUG]</b></font></td><td><center><b><font color=red>$datas[TSEP]</b></font></td>
                    <td><center><font color=red><b>$datas[TOCT]</b></font></td><td><center><font color=red><b>$datas[TNOV]</b></font></td><td><center><b><font color=red>$datas[TDES]</b></font></td>
                    </td><td><center><font color=red><b>$totals</b></font></td></tr>
                    </table>

                    </center>";   
            }else{echo"<center>NO TARGET</center>";}    
            //amount
            $tampils=mysql_query("SELECT * FROM tour_mstargetpotmr   
                                WHERE TargetYear = '$targetyear'
                                ORDER BY tour_mstargetpotmr.TargetBSO ASC");
          
            $jumlahs=mysql_num_rows($tampils);
            
            if ($jumlahs > 0) {                                                                                          
            echo "<font size='1' color='red'>* Amount in IDR</font>  
            <center><table class='bordered'><tr><th colspan='15'>TARGET AMOUNT</th></tr>
                    <tr><th>no</th><th>bso</th><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th><th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Des</th><th>total</th></tr>";
                  $no=$posisi+1;
                    while ($datas=mysql_fetch_array($tampils)){
                    $totbso=$datas[JANA]+$datas[FEBA]+$datas[MARA]+$datas[APRA]+$datas[MAYA]+$datas[JUNA]+$datas[JULA]+$datas[AUGA]+$datas[SEPA]+$datas[OCTA]+$datas[NOVA]+$datas[DESA];       
               echo "<tr><td>$no</td>
                     <td><a href='?module=mstargetpotmr&act=edittarget&id=$datas[TargetID]'>$datas[TargetBSO]</a></td>                                  
                     <td style='text-align:right'>".number_format($datas[JANA], 0, '', '.');echo"</td>   
                     <td style='text-align:right' BGCOLOR='#bef5c6'>".number_format($datas[FEBA], 0, '', '.');echo"</td>
                     <td style='text-align:right'>".number_format($datas[MARA], 0, '', '.');echo"</td>
                     <td style='text-align:right' BGCOLOR='#bef5c6'>".number_format($datas[APRA], 0, '', '.');echo"</td>
                     <td style='text-align:right'>".number_format($datas[MAYA], 0, '', '.');echo"</td>
                     <td style='text-align:right' BGCOLOR='#bef5c6'>".number_format($datas[JUNA], 0, '', '.');echo"</td>
                     <td style='text-align:right'>".number_format($datas[JULA], 0, '', '.');echo"</td>
                     <td style='text-align:right' BGCOLOR='#bef5c6'>".number_format($datas[AUGA], 0, '', '.');echo"</td>
                     <td style='text-align:right'>".number_format($datas[SEPA], 0, '', '.');echo"</td>
                     <td style='text-align:right' BGCOLOR='#bef5c6'>".number_format($datas[OCTA], 0, '', '.');echo"</td>
                     <td style='text-align:right'>".number_format($datas[NOVA], 0, '', '.');echo"</td>
                     <td style='text-align:right' BGCOLOR='#bef5c6'>".number_format($datas[DESA], 0, '', '.');echo"</td>
                     <td style='text-align:right'><font color=red>".number_format($totbso, 0, '', '.');echo"</font></td></tr>";
                      $no++;
                    }
                    $tampils=mysql_query("SELECT sum(JANA)as TJAN,sum(FEBA)as TFEB,sum(MARA)as TMAR,sum(APRA)as TAPR,sum(MAYA)as TMAY,sum(JUNA)as TJUN,sum(JULA)as TJUL,
                                            sum(AUGA)as TAUG,sum(SEPA)as TSEP,sum(OCTA)as TOCT,sum(NOVA)as TNOV,sum(DESA)as TDES FROM tour_mstargetpotmr   
                                WHERE TargetYear = '$targetyear'
                                ORDER BY tour_mstargetpotmr.TargetBSO ASC");
                    $datas=mysql_fetch_array($tampils);
                    $totals=$datas[TJAN]+$datas[TFEB]+$datas[TMAR]+$datas[TAPR]+$datas[TMAY]+$datas[TJUN]+$datas[TJUL]+$datas[TAUG]+$datas[TSEP]+$datas[TOCT]+$datas[TNOV]+$datas[TDES]; 
                    echo "
                    <tr><td colspan=2 ><center><b>TOTAL</b></td><td><center><font color=red><b>".number_format($datas[TJAN], 0, '', '.');echo"</b></font></td><td><center><font color=red><b>".number_format($datas[TFEB], 0, '', '.');echo"</b></font></td><td><center><font color=red><b>".number_format($datas[TMAR], 0, '', '.');echo"</b<</font></td>
                    <td><center><font color=red><b>".number_format($datas[TAPR], 0, '', '.');echo"</b></font></td><td><center><font color=red><b>".number_format($datas[TMAY], 0, '', '.');echo"</b></font></td><td><center><b><font color=red>".number_format($datas[TJUN], 0, '', '.');echo"</b></font></td>
                    <td><center><font color=red><b>".number_format($datas[TJUL], 0, '', '.');echo"</b></font></td><td><center><font color=red><b>".number_format($datas[TAUG], 0, '', '.');echo"</b></font></td><td><center><b><font color=red>".number_format($datas[TSEP], 0, '', '.');echo"</b></font></td>
                    <td><center><font color=red><b>".number_format($datas[TOCT], 0, '', '.');echo"</b></font></td><td><center><font color=red><b>".number_format($datas[TNOV], 0, '', '.');echo"</b></font></td><td><center><b><font color=red>".number_format($datas[TDES], 0, '', '.');echo"</b></font></td>
                    </td><td><center><font color=red><b>".number_format($totals, 0, '', '.');echo"</b></font></td></tr>
                    </table>"; 
                    
            }
    break;
  
  case "tambahtarget":
        $cuma = mysql_query("SELECT * FROM tour_mstargetpotmr group by TargetYear  
                                    ORDER BY TargetYear DESC limit 1");
        $saja = mysql_fetch_array($cuma);
        $neksyear=$saja[TargetYear]+1;    
    echo "<h2>New Target for $neksyear</h2>                                                                      
          
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=mstargetpotmr&act=input' >
          <table class='bordered'><input type='hidden' name='neksyear' value='$neksyear'><input type='hidden' name='disyear' value='$saja[TargetYear]'>
          <tr><td>PAX</td><td><select name='operate'><option value='+'>Increase</option><option value='-'>Decrease</option></select> Target from $saja[TargetYear]</td> <td><input type=text name='incpersen' size='3' value='0' onkeyup=isNumber(this)> %</td></tr>   
          <tr><td>AMOUNT</td><td><select name='operatea'><option value='+'>Increase</option><option value='-'>Decrease</option></select> Target from $saja[TargetYear]</td> <td><input type=text name='incpersena' size='3' value='0' onkeyup=isNumber(this)> %</td></tr>   
          <tr><td colspan=2><center><input type='submit' name='submit' value=Create >
                            <input type=button value=Cancel onclick=location.href='?module=mstargetpotmr'></td></tr>
          </table> </form>
          <br><br>";
     break;
     
 case "tambahpo":
        $hariini = date("Y-m-d");
      $thnini = date("Y");                                                                                        
    echo "<h2>New Destination in target</h2>";
            echo "<form name='example' method='POST' onsubmit='return validateFormOnBSO(this)' action='./aksi.php?module=mstargetpotmr&act=insertpo' >
                    <input type='hidden' name='thn' value='$thnini'>
                    <center>New Destination <select name='targetbso'>
                    <option value='0' selected>- select destination -</option>";
                    
                    $tampil=mysql_query("SELECT * FROM tour_msproductcode
                                         left outer join tour_mstargetpotmr on tour_mstargetpotmr.TargetBSO = tour_msproductcode.ProductcodeArea
                                         where ProductcodeStatus = 'ACTIVE'
                                         AND tour_mstargetpotmr.TargetID IS NULL
                                         AND ProductcodeArea <> 'ALL'
                                         group by ProductcodeArea ASC
                                         ORDER BY ProductcodeArea ASC");
                    while($r=mysql_fetch_array($tampil)){        
                            echo "<option value='$r[ProductcodeArea]'>$r[ProductcodeArea]</option>";
                    }    
            echo "</select>
                    <table class='bordered'><tr><th>month</th><th>pax</th><th>amount</th></tr>
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
                    <center><input type='submit' name='submit' value='Insert'> <input type=button value='Cancel' onclick=location.href='?module=mstargetpotmr&targetyear=$data[TargetYear]'>
                    </form><br><br>";  
     break;
     
 case "edittarget":
    $hariini = date("Y-m-d");
      $thnini = date("Y");
      $targetid=$_GET[id]; 
      $tampil=mysql_query("SELECT * FROM tour_mstargetpotmr   
                                WHERE TargetID = '$targetid'");
      $data=mysql_fetch_array($tampil);                                                                            
    echo "<h2>TARGET $data[TargetBSO] $data[TargetYear]</h2>";          
            echo "<form name='example' method='POST' onsubmit='return validateFormOnBlank(this)' action='./aksi.php?module=mstargetpotmr&act=update' >  
                    <input type='hidden' name='id' value='$targetid'><input type='hidden' name='thn' value='$data[TargetYear]'>
                    <center><table class='bordered'><tr><th>month</th><th>pax</th><th>amount</th></tr>
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
                    <input type='submit' name='submit' value='Update'> <input type=button value='Cancel' onclick=location.href='?module=mstargetpotmr&targetyear=$data[TargetYear]'>
                    </form><br><br>";         
     break;
                    
}
?>
