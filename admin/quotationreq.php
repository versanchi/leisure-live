 <script language="javascript" type="text/javascript">
    function updatepage()
    {
        window.close();
        window.opener.location.reload();
    }
</script>
 <script language="JavaScript"  type="text/javascript">   
 function isNumber(field) {
var re = /^[0-9'.']*$/;
if (!re.test(field.value)) {
alert('VALUE MUST BE NUMBER !');
field.value = field.value.replace(/[^0-9'.']/g,"");
}
if(field.value == ''){
    field.style.backgroundColor = "red"; }
    else {field.style.backgroundColor = "white";}
}
 function itung(){
    UpdateSellA(1); UpdateSellC(1);
    UpdateSellA(2); UpdateSellC(2);
    UpdateSellA(3); UpdateSellC(3);
    UpdateSellA(4); UpdateSellC(4);
    UpdateSellA(5); UpdateSellC(5);
    UpdateSellA(6); UpdateSellC(6);
    UpdateSellA(7); UpdateSellC(7);
    UpdateSellA(8); UpdateSellC(8);
    UpdateSellA(9); UpdateSellC(9);
    UpdateSellA(10); UpdateSellC(10); 
    document.calculate.elements['recalculate'].disabled=true; 
    document.calculate.elements['submit'].disabled=false;                        
 }
 function TotalA(){
    var t = calculate.totalfixadult;
    var n1 = eval(calculate.selladult1.value);
    var n2 = eval(calculate.selladult2.value);
    var n3 = eval(calculate.selladult3.value);
    var n4 = eval(calculate.selladult4.value);
    var n5 = eval(calculate.selladult5.value);
    var n6 = eval(calculate.selladult6.value);
    var n7 = eval(calculate.selladult7.value);
    var n8 = eval(calculate.selladult8.value);
    var n9 = eval(calculate.selladult9.value);
    var n10 = eval(calculate.selladult10.value);
    t.value = (n1 + n2 + n3 + n4 + n5 + n6 + n7 + n8 + n9 + n10).toFixed(2) ;
    if (isNaN(t.value)) {
      t.value=0   
}
 }
 function UpdateSellA(NO) {                               
    var a = eval("calculate.quoadult" + NO + ".value;")  
    var b = calculate.sellingoperator.value;
    var c = eval(calculate.sellingrate.value);
    var n = eval("calculate.selladult" + NO + ";")  
    if(a==0){n.value = (0).toFixed(2) ;}else{
        if(b=='/'){
            var x = a / c ;   
            n.value = (x).toFixed(2) ;          
        }else if(b=='*'){
            var x = a * c ;   
            n.value = (x).toFixed(2) ;          
        }
    }
    if(n < a){
    n.style.backgroundColor = "red"; }
    else {n.style.backgroundColor = "white";}   
    TotalA();
}
function TotalC(){
    var t = calculate.totalfixchd;
    var n1 = eval(calculate.sellchd1.value);
    var n2 = eval(calculate.sellchd2.value);
    var n3 = eval(calculate.sellchd3.value);
    var n4 = eval(calculate.sellchd4.value);
    var n5 = eval(calculate.sellchd5.value);
    var n6 = eval(calculate.sellchd6.value);
    var n7 = eval(calculate.sellchd7.value);
    var n8 = eval(calculate.sellchd8.value);
    var n9 = eval(calculate.sellchd9.value);
    var n10 = eval(calculate.sellchd10.value);
    t.value = (n1 + n2 + n3 + n4 + n5 + n6 + n7 + n8 + n9 + n10).toFixed(2) ;
    if (isNaN(t.value)) {
      t.value=0   
}
 }
 function UpdateSellC(NO) {                               
    var a = eval("calculate.quochd" + NO + ".value;")  
    var b = calculate.sellingoperator.value;
    var c = eval(calculate.sellingrate.value);
    var n = eval("calculate.sellchd" + NO + ";")  
    if(a==0){}else{
        if(b=='/'){
            var x = a / c ;   
            n.value = (x).toFixed(2) ;          
        }else if(b=='*'){
            var x = a * c ;   
            n.value = (x).toFixed(2) ;          
        }
    }
    if(n < a){
    n.style.backgroundColor = "red"; }
    else {n.style.backgroundColor = "white";}   
    TotalC();
} 
</script>

<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" /> 
<?php 
include "../config/koneksi.php"; 
  
switch($_GET[act]){
  // Tampil Office
  default:
  	
    $edit=mysql_query("SELECT * FROM tour_msproductreq WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $caridata=mysql_query("SELECT * FROM tour_mstmrreq WHERE IDTmr = '$r[TmrNo]'");
    $datatmr=mysql_fetch_array($caridata);
    $depdate = substr($r[DateTravelFrom],8,2);         
    echo "<h2>FIX COST - TMR $datatmr[TmrNo].$datatmr[TmrOption]</h2>    
          <form method=POST name='calculate' action='?module=quotationreq&act=save'>
          <input type='hidden' name=id value='$r[IDProduct]'><input type='hidden' name='tourcode' value='$r[TourCode]'> 
          <input type='hidden' name='sellingoperator' value='$r[SellingOperator]'>
          <input type='hidden' name='sellingrate' value='$r[SellingRate]'>
          <input type='hidden' name='quotationcurr' value='$r[QuotationCurr]'>
          <input type='hidden' name='sellingcurr' value='$r[SellingCurr]'>";
            $isifix1=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX1' ");
            $fix1=mysql_fetch_array($isifix1);  
            $isifix2=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX2' ");
            $fix2=mysql_fetch_array($isifix2);
            $isifix3=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX3' ");
            $fix3=mysql_fetch_array($isifix3);
            $isifix4=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX4' ");
            $fix4=mysql_fetch_array($isifix4);
            $isifix5=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX5' ");
            $fix5=mysql_fetch_array($isifix5);
            $isifix6=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX6' ");
            $fix6=mysql_fetch_array($isifix6);
            $isifix7=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX7' ");
            $fix7=mysql_fetch_array($isifix7);
            $isifix8=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX8' ");
            $fix8=mysql_fetch_array($isifix8);
            $isifix9=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX9' ");
            $fix9=mysql_fetch_array($isifix9);
            $isifix10=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX10' ");
            $fix10=mysql_fetch_array($isifix10);
            $isitotal=mysql_query("SELECT * FROM tour_msdetailreq
                                where IDProduct = '$r[IDProduct]' ");
            $totfix=mysql_fetch_array($isitotal);
            if($fix1[SellingOperator]==''){$tampil1='enable';$tampil2='disabled';}else{
                if($r[SellingOperator]<>$fix1[SellingOperator] && $r[SellingRate]<>$fix1[SellingRate]){$tampil1='disabled';$tampil2='enable';}
                else if($r[SellingOperator]==$fix1[SellingOperator] && $r[SellingRate]<>$fix1[SellingRate]){$tampil1='disabled';$tampil2='enable';}
                else if($r[SellingOperator]<>$fix1[SellingOperator] && $r[SellingRate]==$fix1[SellingRate]){$tampil1='disabled';$tampil2='enable';}
                else if($r[SellingOperator]==$fix1[SellingOperator] && $r[SellingRate]==$fix1[SellingRate]){$tampil1='enable';$tampil2='disabled';} 
            }
            echo "<table>
                    <tr><th>supplier</th><th>description</th><th colspan=2>adult</th><th colspan=2>Child </th></tr>
                    <tr><th></th><th></th><th>In $r[QuotationCurr]</th><th>In $r[SellingCurr]</th><th>In $r[QuotationCurr]</th><th>In $r[SellingCurr]</th> 
                     
                     <tr><td><select name='supplier1'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($fix1[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }                                                                           
               echo "</select></td><td><input type=text name='desc1' size='30' value='$fix1[Description]'></td>
                     <td><input type=text name='quoadult1' size='12' value='$fix1[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(1)'></td><td><input type='text' name='selladult1' value='$fix1[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd1' size='12' value='$fix1[QuoChd]'onkeyup='isNumber(this);UpdateSellC(1)'></td><td><input type='text' name='sellchd1' value='$fix1[SellChd]' size='12'onkeyup='isNumber(this);TotalC()' ></td></tr>
                     <tr><td><select name='supplier2'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($fix2[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc2' size='30' value='$fix2[Description]'></td>
                     <td><input type=text name='quoadult2' size='12' value='$fix2[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(2)'></td><td><input type='text' name='selladult2' value='$fix2[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd2' size='12' value='$fix2[QuoChd]'onkeyup='isNumber(this);UpdateSellC(2)'></td><td><input type='text' name='sellchd2'  value='$fix2[SellChd]' size='12' onkeyup='isNumber(this);TotalC()'></td></tr>
                     <tr><td><select name='supplier3'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($fix3[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc3' size='30' value='$fix3[Description]'></td>
                     <td><input type=text name='quoadult3' size='12' value='$fix3[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(3)'></td><td><input type='text' name='selladult3' value='$fix3[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd3' size='12' value='$fix3[QuoChd]'onkeyup='isNumber(this);UpdateSellC(3)'></td><td><input type='text' name='sellchd3'  value='$fix3[SellChd]' size='12' onkeyup='isNumber(this);TotalC()'></td></tr>
                     <tr><td><select name='supplier4'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($fix4[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc4' size='30' value='$fix4[Description]'></td>
                     <td><input type=text name='quoadult4' size='12' value='$fix4[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(4)'></td><td><input type='text' name='selladult4'  value='$fix4[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd4' size='12' value='$fix4[QuoChd]'onkeyup='isNumber(this);UpdateSellC(4)'></td><td><input type='text' name='sellchd4' value='$fix4[SellChd]' size='12' onkeyup='isNumber(this);TotalC()'></td></tr>
                     <tr><td><select name='supplier5'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($fix5[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc5' size='30' value='$fix5[Description]'></td>
                     <td><input type=text name='quoadult5' size='12' value='$fix5[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(5)'></td><td><input type='text' name='selladult5'  value='$fix5[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd5' size='12' value='$fix5[QuoChd]'onkeyup='isNumber(this);UpdateSellC(5)'></td><td><input type='text' name='sellchd5'  value='$fix5[SellChd]' size='12' onkeyup='isNumber(this);TotalC()'></td></tr>
                     <tr><td><select name='supplier6'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($fix6[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc6' size='30' value='$fix6[Description]'></td>
                     <td><input type=text name='quoadult6' size='12' value='$fix6[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(6)'></td><td><input type='text' name='selladult6'  value='$fix6[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd6' size='12' value='$fix6[QuoChd]'onkeyup='isNumber(this);UpdateSellC(6)'></td><td><input type='text' name='sellchd6' value='$fix6[SellChd]' size='12' onkeyup='isNumber(this);TotalC()'></td></tr>
                     <tr><td><select name='supplier7'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($fix7[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc7' size='30' value='$fix7[Description]'></td>
                     <td><input type=text name='quoadult7' size='12' value='$fix7[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(7)'></td><td><input type='text' name='selladult7'  value='$fix7[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd7' size='12' value='$fix7[QuoChd]'onkeyup='isNumber(this);UpdateSellC(7)'></td><td><input type='text' name='sellchd7' value='$fix7[SellChd]' size='12' onkeyup='isNumber(this);TotalC()'></td></tr>
                     <tr><td><select name='supplier8'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($fix8[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc8' size='30' value='$fix8[Description]'></td>
                     <td><input type=text name='quoadult8' size='12' value='$fix8[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(8)'></td><td><input type='text' name='selladult8' value='$fix8[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd8' size='12' value='$fix8[QuoChd]'onkeyup='isNumber(this);UpdateSellC(8)'></td><td><input type='text' name='sellchd8'  value='$fix8[SellChd]' size='12' onkeyup='isNumber(this);TotalC()'></td></tr>
                     <tr><td><select name='supplier9'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($fix9[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc9' size='30' value='$fix9[Description]'></td>
                     <td><input type=text name='quoadult9' size='12' value='$fix9[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(9)'></td><td><input type='text' name='selladult9'  value='$fix9[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd9' size='12' value='$fix9[QuoChd]'onkeyup='isNumber(this);UpdateSellC(9)'></td><td><input type='text' name='sellchd9'  value='$fix9[SellChd]' size='12' onkeyup='isNumber(this);TotalC()'></td></tr>
                     <tr><td><select name='supplier10'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($fix10[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc10' size='30' value='$fix10[Description]'></td>
                     <td><input type=text name='quoadult10' size='12' value='$fix10[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(10)'></td><td><input type='text' name='selladult10' value='$fix10[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd10' size='12' value='$fix10[QuoChd]'onkeyup='isNumber(this);UpdateSellC(10)'></td><td><input type='text' name='sellchd10' value='$fix10[SellChd]' size='12' onkeyup='isNumber(this);TotalC()'></td></tr>
                    <tr><td colspan=3><b><i>TOTAL</td><td><input type='text' name='totalfixadult' value='$totfix[TotalFixAdult]' size='12' style='text-align: left;font-weight:bold;border: 0px solid #000000;' readonly></td><td></td><td><input type='text' name='totalfixchd' value='$totfix[TotalFixChd]' size='12' style='text-align: left;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
                    </table>    
          
          <center><input type='submit' name='submit' value='Save' $tampil1> <input type='button' name='recalculate' value='Re-Calculate' onclick='itung()' $tampil2>
          </form>";
     break;  
  
  case "save":
     
  $pax=$_POST[pax];                   
  $Description="Update Fix Cost TMR($_POST[tourcode])"; 
  $Sup1=strtoupper($_POST[supplier1]);
  $Desc1=strtoupper($_POST[desc1]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup1',
                                        Description = '$Desc1', 
                                        QuoAdult = '$_POST[quoadult1]',
                                        SellAdult = '$_POST[selladult1]',
                                        QuoChd = '$_POST[quochd1]',
                                        SellChd = '$_POST[sellchd1]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'FIX1' AND IDProduct = '$_POST[id]'");
  $Sup2=strtoupper($_POST[supplier2]);
  $Desc2=strtoupper($_POST[desc2]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup2',
                                        Description = '$Desc2',
                                        QuoAdult = '$_POST[quoadult2]',
                                        SellAdult = '$_POST[selladult2]',
                                        QuoChd = '$_POST[quochd2]',
                                        SellChd = '$_POST[sellchd2]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'FIX2' AND IDProduct = '$_POST[id]'");
  $Sup3=strtoupper($_POST[supplier3]);
  $Desc3=strtoupper($_POST[desc3]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup3',
                                        Description = '$Desc3',
                                        QuoAdult = '$_POST[quoadult3]',
                                        SellAdult = '$_POST[selladult3]',
                                        QuoChd = '$_POST[quochd3]',
                                        SellChd = '$_POST[sellchd3]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'FIX3' AND IDProduct = '$_POST[id]'");
  $Sup4=strtoupper($_POST[supplier4]);
  $Desc4=strtoupper($_POST[desc4]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup4',
                                        Description = '$Desc4',
                                        QuoAdult = '$_POST[quoadult4]',
                                        SellAdult = '$_POST[selladult4]',
                                        QuoChd = '$_POST[quochd4]',
                                        SellChd = '$_POST[sellchd4]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'FIX4' AND IDProduct = '$_POST[id]'");
  $Sup5=strtoupper($_POST[supplier5]);
  $Desc5=strtoupper($_POST[desc5]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup5',
                                        Description = '$Desc5',
                                        QuoAdult = '$_POST[quoadult5]',
                                        SellAdult = '$_POST[selladult5]',
                                        QuoChd = '$_POST[quochd5]',
                                        SellChd = '$_POST[sellchd5]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'FIX5' AND IDProduct = '$_POST[id]'");
  $Sup6=strtoupper($_POST[supplier6]);
  $Desc6=strtoupper($_POST[desc6]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup6',
                                        Description = '$Desc6',
                                        QuoAdult = '$_POST[quoadult6]',
                                        SellAdult = '$_POST[selladult6]',
                                        QuoChd = '$_POST[quochd6]',
                                        SellChd = '$_POST[sellchd6]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'FIX6' AND IDProduct = '$_POST[id]'");
  $Sup7=strtoupper($_POST[supplier7]);
  $Desc7=strtoupper($_POST[desc7]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup7',
                                        Description = '$Desc7',
                                        QuoAdult = '$_POST[quoadult7]',
                                        SellAdult = '$_POST[selladult7]',
                                        QuoChd = '$_POST[quochd7]',
                                        SellChd = '$_POST[sellchd7]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'FIX7' AND IDProduct = '$_POST[id]'");
  $Sup8=strtoupper($_POST[supplier8]);
  $Desc8=strtoupper($_POST[desc8]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup8',
                                        Description = '$Desc8',
                                        QuoAdult = '$_POST[quoadult8]',
                                        SellAdult = '$_POST[selladult8]',
                                        QuoChd = '$_POST[quochd8]',
                                        SellChd = '$_POST[sellchd8]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'FIX8' AND IDProduct = '$_POST[id]'");
  $Sup9=strtoupper($_POST[supplier9]);
  $Desc9=strtoupper($_POST[desc9]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup9',
                                        Description = '$Desc9',
                                        QuoAdult = '$_POST[quoadult9]',
                                        SellAdult = '$_POST[selladult9]',
                                        QuoChd = '$_POST[quochd9]',
                                        SellChd = '$_POST[sellchd9]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'FIX9' AND IDProduct = '$_POST[id]'");
  $Sup10=strtoupper($_POST[supplier10]);
  $Desc10=strtoupper($_POST[desc10]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup10',
                                        Description = '$Desc10',
                                        QuoAdult = '$_POST[quoadult10]',
                                        SellAdult = '$_POST[selladult10]',
                                        QuoChd = '$_POST[quochd10]',
                                        SellChd = '$_POST[sellchd10]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'FIX10' AND IDProduct = '$_POST[id]'");
  mysql_query("UPDATE tour_msdetailreq set TotalFixAdult = '$_POST[totalfixadult]',
                                        TotalFixChd = '$_POST[totalfixchd]'
                                        WHERE IDProduct = '$_POST[id]'");
  mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')"); 
  ?>
  <script language='javascript' type='text/javascript'>
    updatepage();
   
</script> <?php 
}
?>
