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
}
 function itung(){
    UpdateSellA(1); UpdateSellC(1); UpdateSellD(1); UpdateSellN(1); 
    UpdateSellA(2); UpdateSellC(2); UpdateSellD(2); UpdateSellN(2);
    UpdateSellA(3); UpdateSellC(3); UpdateSellD(3); UpdateSellN(3);
    UpdateSellA(4); UpdateSellC(4); UpdateSellD(4); UpdateSellN(4);
    UpdateSellA(5); UpdateSellC(5); UpdateSellD(5); UpdateSellN(5);
    UpdateSellA(6); UpdateSellC(6); UpdateSellD(6); UpdateSellN(6);
    UpdateSellA(7); UpdateSellC(7); UpdateSellD(7); UpdateSellN(7);
    UpdateSellA(8); UpdateSellC(8); UpdateSellD(8); UpdateSellN(8);
    UpdateSellA(9); UpdateSellC(9); UpdateSellD(9); UpdateSellN(9);
    UpdateSellA(10); UpdateSellC(10); UpdateSellD(10); UpdateSellN(10);
    document.calculate.elements['recalculate'].disabled=true; 
    document.calculate.elements['submit'].disabled=false;                        
 }
 function TotalA(){
    var t = calculate.totaladulta;
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
    t.value = n1 + n2 + n3 + n4 + n5 + n6 + n7 + n8 + n9 + n10;
    if (isNaN(t.value)) {
      t.value=0   
}
 }
 function UpdateSellA(NO) {                               
    var a = eval("calculate.quoadult" + NO + ".value;")  
    var b = calculate.sellingoperator.value;
    var c = eval(calculate.sellingrate.value);
    var n = eval("calculate.selladult" + NO + ";")  
    if(a==0){}else{
    if(b=='/'){
        var x = a / c ;   
        n.value = x;          
    }else if(b=='*'){
        var x = a * c ;   
        n.value = x;          
    }
    }
    if(n < a){
    n.style.backgroundColor = "red"; }
    else {n.style.backgroundColor = "white";}   
    TotalA();
}
function TotalC(){
    var t = calculate.totalchdtwna;
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
    t.value = n1 + n2 + n3 + n4 + n5 + n6 + n7 + n8 + n9 + n10;
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
        n.value = x;          
    }else if(b=='*'){
        var x = a * c ;   
        n.value = x;          
    }
    }
    if(n < a){
    n.style.backgroundColor = "red"; }
    else {n.style.backgroundColor = "white";}   
    TotalC();
} 
function TotalD(){
    var t = calculate.totalchdxbeda;
    var n1 = eval(calculate.sellchdx1.value);
    var n2 = eval(calculate.sellchdx2.value);
    var n3 = eval(calculate.sellchdx3.value);
    var n4 = eval(calculate.sellchdx4.value);
    var n5 = eval(calculate.sellchdx5.value);
    var n6 = eval(calculate.sellchdx6.value);
    var n7 = eval(calculate.sellchdx7.value);
    var n8 = eval(calculate.sellchdx8.value);
    var n9 = eval(calculate.sellchdx9.value);
    var n10 = eval(calculate.sellchdx10.value);
    t.value = n1 + n2 + n3 + n4 + n5 + n6 + n7 + n8 + n9 + n10;
    if (isNaN(t.value)) {
      t.value=0   
}
 }
 function UpdateSellD(NO) {                               
    var a = eval("calculate.quochdx" + NO + ".value;")  
    var b = calculate.sellingoperator.value;
    var c = eval(calculate.sellingrate.value);
    var n = eval("calculate.sellchdx" + NO + ";")  
    if(a==0){}else{
    if(b=='/'){
        var x = a / c ;   
        n.value = x;          
    }else if(b=='*'){
        var x = a * c ;   
        n.value = x;          
    }
    }
    if(n < a){
    n.style.backgroundColor = "red"; }
    else {n.style.backgroundColor = "white";}   
    TotalD();
}
function TotalN(){
    var t = calculate.totalchdnbeda;
    var n1 = eval(calculate.sellchdn1.value);
    var n2 = eval(calculate.sellchdn2.value);
    var n3 = eval(calculate.sellchdn3.value);
    var n4 = eval(calculate.sellchdn4.value);
    var n5 = eval(calculate.sellchdn5.value);
    var n6 = eval(calculate.sellchdn6.value);
    var n7 = eval(calculate.sellchdn7.value);
    var n8 = eval(calculate.sellchdn8.value);
    var n9 = eval(calculate.sellchdn9.value);
    var n10 = eval(calculate.sellchdn10.value);
    t.value = n1 + n2 + n3 + n4 + n5 + n6 + n7 + n8 + n9 + n10;
    if (isNaN(t.value)) {
      t.value=0   
}
 }
 function UpdateSellN(NO) {                               
    var a = eval("calculate.quochdn" + NO + ".value;")  
    var b = calculate.sellingoperator.value;
    var c = eval(calculate.sellingrate.value);
    var n = eval("calculate.sellchdn" + NO + ";")  
    if(a==0){}else{
    if(b=='/'){
        var x = a / c ;   
        n.value = x;          
    }else if(b=='*'){
        var x = a * c ;   
        n.value = x;          
    }
    }
    if(n < a){
    n.style.backgroundColor = "red"; }
    else {n.style.backgroundColor = "white";}   
    TotalN();
}  
</script>

<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" /> 
<?php 
include "../config/koneksi.php"; 
  
switch($_GET[act]){
  // Tampil Office
  default:
  	
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $depdate = substr($r[DateTravelFrom],8,2);         
    echo "<h2>AGENT COST (OPTION A) - $r[TourCode]</h2>    
          <form method=POST name='calculate' action='?module=agent&act=save'>
          <input type='hidden' name=id value='$r[IDProduct]'><input type='hidden' name='tourcode' value='$r[TourCode]'> 
          <input type='hidden' name='sellingoperator' value='$r[SellingOperator]'>
          <input type='hidden' name='sellingrate' value='$r[SellingRate]'>
          <input type='hidden' name='quotationcurr' value='$r[QuotationCurr]'>
          <input type='hidden' name='sellingcurr' value='$r[SellingCurr]'>";
            $isifix1=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT1' and IDProduct = '$r[IDProduct]' ");
            $fix1=mysql_fetch_array($isifix1);  
            $isifix2=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT2' and IDProduct = '$r[IDProduct]' ");
            $fix2=mysql_fetch_array($isifix2);
            $isifix3=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT3' and IDProduct = '$r[IDProduct]' ");
            $fix3=mysql_fetch_array($isifix3);
            $isifix4=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT4' and IDProduct = '$r[IDProduct]' ");
            $fix4=mysql_fetch_array($isifix4);
            $isifix5=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT5' and IDProduct = '$r[IDProduct]' ");
            $fix5=mysql_fetch_array($isifix5);
            $isifix6=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT6' and IDProduct = '$r[IDProduct]' ");
            $fix6=mysql_fetch_array($isifix6);
            $isifix7=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT7' and IDProduct = '$r[IDProduct]' ");
            $fix7=mysql_fetch_array($isifix7);
            $isifix8=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT8' and IDProduct = '$r[IDProduct]' ");
            $fix8=mysql_fetch_array($isifix8);
            $isifix9=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT9' and IDProduct = '$r[IDProduct]' ");
            $fix9=mysql_fetch_array($isifix9);
            $isifix10=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT10' and IDProduct = '$r[IDProduct]' ");
            $fix10=mysql_fetch_array($isifix10);
            $isitotal=mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct = '$r[IDProduct]' ");
            $totfix=mysql_fetch_array($isitotal);
            if($fix1[SellingOperator]==''){$tampil1='enable';$tampil2='disabled';}else{
                if($r[SellingOperator]<>$fix1[SellingOperatorA] && $r[SellingRate]<>$fix1[SellingRateA]){$tampil1='disabled';$tampil2='enable';}
                else if($r[SellingOperator]==$fix1[SellingOperatorA] && $r[SellingRate]<>$fix1[SellingRateA]){$tampil1='disabled';$tampil2='enable';}
                else if($r[SellingOperator]<>$fix1[SellingOperatorA] && $r[SellingRate]==$fix1[SellingRateA]){$tampil1='disabled';$tampil2='enable';}
                else if($r[SellingOperator]==$fix1[SellingOperatorA] && $r[SellingRate]==$fix1[SellingRateA]){$tampil1='enable';$tampil2='disabled';} 
            }
            echo "<table>
                    <tr><th>PAX : <input type=text name='paxa' size='3' value='$totfix[PaxA]'></th><th></th><th colspan=2>adult</th><th colspan=6>Child </th></tr>
                    <tr><th></th><th></th><th colspan=2></th><th colspan=2>Twin BED</th><th colspan=2>Extra BED </th><th colspan=2>NO BED </th></tr>
                    <tr><th>supplier</th><th>description</th><th>In $r[QuotationCurr]</th><th>In $r[SellingCurr]</th><th>In $r[QuotationCurr]</th><th>In $r[SellingCurr]</th><th>In $r[QuotationCurr]</th><th>In $r[SellingCurr]</th><th>In $r[QuotationCurr]</th><th>In $r[SellingCurr]</th></tr> 
                     
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
                     <td><input type=text name='quoadult1' size='12' value='$fix1[QuoAdultA]'onkeyup='isNumber(this);UpdateSellA(1)'></td><td><input type='text' name='selladult1' value='$fix1[SellAdultA]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd1' size='12' value='$fix1[QuoChdTwnA]'onkeyup='isNumber(this);UpdateSellC(1)'></td><td><input type='text' name='sellchd1' value='$fix1[SellChdTwnA]' size='12'onkeyup='isNumber(this);TotalC()' ></td>
                     <td><input type=text name='quochdx1' size='12' value='$fix1[QuoChdXbedA]'onkeyup='isNumber(this);UpdateSellD(1)'></td><td><input type='text' name='sellchdx1' value='$fix1[SellChdXbedA]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn1' size='12' value='$fix1[QuoChdNbedA]'onkeyup='isNumber(this);UpdateSellN(1)'></td><td><input type='text' name='sellchdn1' value='$fix1[SellChdNbedA]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
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
                     <td><input type=text name='quoadult2' size='12' value='$fix2[QuoAdultA]'onkeyup='isNumber(this);UpdateSellA(2)'></td><td><input type='text' name='selladult2' value='$fix2[SellAdultA]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd2' size='12' value='$fix2[QuoChdTwnA]'onkeyup='isNumber(this);UpdateSellC(2)'></td><td><input type='text' name='sellchd2'  value='$fix2[SellChdTwnA]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx2' size='12' value='$fix2[QuoChdXbedA]'onkeyup='isNumber(this);UpdateSellD(2)'></td><td><input type='text' name='sellchdx2' value='$fix2[SellChdXbedA]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn2' size='12' value='$fix2[QuoChdNbedA]'onkeyup='isNumber(this);UpdateSellN(2)'></td><td><input type='text' name='sellchdn2' value='$fix2[SellChdNbedA]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
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
                     <td><input type=text name='quoadult3' size='12' value='$fix3[QuoAdultA]'onkeyup='isNumber(this);UpdateSellA(3)'></td><td><input type='text' name='selladult3' value='$fix3[SellAdultA]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd3' size='12' value='$fix3[QuoChdTwnA]'onkeyup='isNumber(this);UpdateSellC(3)'></td><td><input type='text' name='sellchd3'  value='$fix3[SellChdTwnA]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx3' size='12' value='$fix3[QuoChdXbedA]'onkeyup='isNumber(this);UpdateSellD(3)'></td><td><input type='text' name='sellchdx3' value='$fix3[SellChdXbedA]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn3' size='12' value='$fix3[QuoChdNbedA]'onkeyup='isNumber(this);UpdateSellN(3)'></td><td><input type='text' name='sellchdn3' value='$fix3[SellChdNbedA]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
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
                     <td><input type=text name='quoadult4' size='12' value='$fix4[QuoAdultA]'onkeyup='isNumber(this);UpdateSellA(4)'></td><td><input type='text' name='selladult4'  value='$fix4[SellAdultA]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd4' size='12' value='$fix4[QuoChdTwnA]'onkeyup='isNumber(this);UpdateSellC(4)'></td><td><input type='text' name='sellchd4' value='$fix4[SellChdTwnA]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx4' size='12' value='$fix4[QuoChdXbedA]'onkeyup='isNumber(this);UpdateSellD(4)'></td><td><input type='text' name='sellchdx4' value='$fix4[SellChdXbedA]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn4' size='12' value='$fix4[QuoChdNbedA]'onkeyup='isNumber(this);UpdateSellN(4)'></td><td><input type='text' name='sellchdn4' value='$fix4[SellChdNbedA]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
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
                     <td><input type=text name='quoadult5' size='12' value='$fix5[QuoAdultA]'onkeyup='isNumber(this);UpdateSellA(5)'></td><td><input type='text' name='selladult5'  value='$fix5[SellAdultA]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd5' size='12' value='$fix5[QuoChdTwnA]'onkeyup='isNumber(this);UpdateSellC(5)'></td><td><input type='text' name='sellchd5'  value='$fix5[SellChdTwnA]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx5' size='12' value='$fix5[QuoChdXbedA]'onkeyup='isNumber(this);UpdateSellD(5)'></td><td><input type='text' name='sellchdx5' value='$fix5[SellChdXbedA]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn5' size='12' value='$fix5[QuoChdNbedA]'onkeyup='isNumber(this);UpdateSellN(5)'></td><td><input type='text' name='sellchdn5' value='$fix5[SellChdNbedA]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
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
                     <td><input type=text name='quoadult6' size='12' value='$fix6[QuoAdultA]'onkeyup='isNumber(this);UpdateSellA(6)'></td><td><input type='text' name='selladult6'  value='$fix6[SellAdultA]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd6' size='12' value='$fix6[QuoChdTwnA]'onkeyup='isNumber(this);UpdateSellC(6)'></td><td><input type='text' name='sellchd6' value='$fix6[SellChdTwnA]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx6' size='12' value='$fix6[QuoChdXbedA]'onkeyup='isNumber(this);UpdateSellD(6)'></td><td><input type='text' name='sellchdx6' value='$fix6[SellChdXbedA]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn6' size='12' value='$fix6[QuoChdNbedA]'onkeyup='isNumber(this);UpdateSellN(6)'></td><td><input type='text' name='sellchdn6' value='$fix6[SellChdNbedA]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
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
                     <td><input type=text name='quoadult7' size='12' value='$fix7[QuoAdultA]'onkeyup='isNumber(this);UpdateSellA(7)'></td><td><input type='text' name='selladult7'  value='$fix7[SellAdultA]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd7' size='12' value='$fix7[QuoChdTwnA]'onkeyup='isNumber(this);UpdateSellC(7)'></td><td><input type='text' name='sellchd7' value='$fix7[SellChdTwnA]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx7' size='12' value='$fix7[QuoChdXbedA]'onkeyup='isNumber(this);UpdateSellD(7)'></td><td><input type='text' name='sellchdx7' value='$fix7[SellChdXbedA]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn7' size='12' value='$fix7[QuoChdNbedA]'onkeyup='isNumber(this);UpdateSellN(7)'></td><td><input type='text' name='sellchdn7' value='$fix7[SellChdNbedA]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
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
                     <td><input type=text name='quoadult8' size='12' value='$fix8[QuoAdultA]'onkeyup='isNumber(this);UpdateSellA(8)'></td><td><input type='text' name='selladult8' value='$fix8[SellAdultA]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd8' size='12' value='$fix8[QuoChdTwnA]'onkeyup='isNumber(this);UpdateSellC(8)'></td><td><input type='text' name='sellchd8'  value='$fix8[SellChdTwnA]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx8' size='12' value='$fix8[QuoChdXbedA]'onkeyup='isNumber(this);UpdateSellD(8)'></td><td><input type='text' name='sellchdx8' value='$fix8[SellChdXbedA]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn8' size='12' value='$fix8[QuoChdNbedA]'onkeyup='isNumber(this);UpdateSellN(8)'></td><td><input type='text' name='sellchdn8' value='$fix8[SellChdNbedA]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
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
                     <td><input type=text name='quoadult9' size='12' value='$fix9[QuoAdultA]'onkeyup='isNumber(this);UpdateSellA(9)'></td><td><input type='text' name='selladult9'  value='$fix9[SellAdultA]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd9' size='12' value='$fix9[QuoChdTwnA]'onkeyup='isNumber(this);UpdateSellC(9)'></td><td><input type='text' name='sellchd9'  value='$fix9[SellChdTwnA]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx9' size='12' value='$fix9[QuoChdXbedA]'onkeyup='isNumber(this);UpdateSellD(9)'></td><td><input type='text' name='sellchdx9' value='$fix9[SellChdXbedA]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn9' size='12' value='$fix9[QuoChdNbedA]'onkeyup='isNumber(this);UpdateSellN(9)'></td><td><input type='text' name='sellchdn9' value='$fix9[SellChdNbedA]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
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
                     <td><input type=text name='quoadult10' size='12' value='$fix10[QuoAdultA]'onkeyup='isNumber(this);UpdateSellA(10)'></td><td><input type='text' name='selladult10' value='$fix10[SellAdultA]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd10' size='12' value='$fix10[QuoChdTwnA]'onkeyup='isNumber(this);UpdateSellC(10)'></td><td><input type='text' name='sellchd10' value='$fix10[SellChdTwnA]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx10' size='12' value='$fix10[QuoChdXbedA]'onkeyup='isNumber(this);UpdateSellD(10)'></td><td><input type='text' name='sellchdx10' value='$fix10[SellChdXbedA]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn10' size='12' value='$fix10[QuoChdNbedA]'onkeyup='isNumber(this);UpdateSellN(10)'></td><td><input type='text' name='sellchdn10' value='$fix10[SellChdNbedA]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                    <tr><td colspan=3><b><i>TOTAL</td><td><input type='text' name='totaladulta' value='$totfix[TotalAdultA]' size='12' style='text-align: left;border: 0px solid #000000;' readonly></td><td></td><td><input type='text' name='totalchdtwna' value='$totfix[TotalChdTwnA]' size='12' style='text-align: left;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdxbeda' value='$totfix[TotalChdXbedA]' size='12' style='text-align: left;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdnbeda' value='$totfix[TotalChdNbedA]' size='12' style='text-align: left;border: 0px solid #000000;' readonly></td></tr>
                    </table>    
          
          <center><input type='submit' name='submit' value='Save' $tampil1> <input type='button' name='recalculate' value='Re-Calculate' onclick='itung()' $tampil2>
          </form>";
     break;  
  
  case "save":
  $paxa=$_POST[paxa];                   
  $Description="Update Fix Cost ($_POST[tourcode])"; 
  $Sup1=strtoupper($_POST[supplier1]);
  $Desc1=strtoupper($_POST[desc1]);
   mysql_query("UPDATE tour_agent set Supplier = '$Sup1',
                                        Description = '$Desc1', 
                                        QuoAdultA = '$_POST[quoadult1]',
                                        SellAdultA = '$_POST[selladult1]',
                                        QuoChdTwnA = '$_POST[quochd1]',
                                        SellChdTwnA = '$_POST[sellchd1]',
                                        QuoChdXbedA = '$_POST[quochdx1]',
                                        SellChdXbedA = '$_POST[sellchdx1]',
                                        QuoChdNbedA = '$_POST[quochdn1]',
                                        SellChdNbedA = '$_POST[sellchdn1]',
                                        QuotationCurrA = '$_POST[quotationcurr]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator]',
                                        SellingRateA = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT1' AND IDProduct = '$_POST[id]'");
  $Sup2=strtoupper($_POST[supplier2]);
  $Desc2=strtoupper($_POST[desc2]);
  mysql_query("UPDATE tour_agent set Supplier = '$Sup2',
                                        Description = '$Desc2',
                                        QuoAdultA = '$_POST[quoadult2]',
                                        SellAdultA = '$_POST[selladult2]',
                                        QuoChdTwnA = '$_POST[quochd2]',
                                        SellChdTwnA = '$_POST[sellchd2]',
                                        QuoChdXbedA = '$_POST[quochdx2]',
                                        SellChdXbedA = '$_POST[sellchdx2]',
                                        QuoChdNbedA = '$_POST[quochdn2]',
                                        SellChdNbedA = '$_POST[sellchdn2]',
                                        QuotationCurrA = '$_POST[quotationcurr]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator]',
                                        SellingRateA = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT2' AND IDProduct = '$_POST[id]'");
  $Sup3=strtoupper($_POST[supplier3]);
  $Desc3=strtoupper($_POST[desc3]);
  mysql_query("UPDATE tour_agent set Supplier = '$Sup3',
                                        Description = '$Desc3',
                                        QuoAdultA = '$_POST[quoadult3]',
                                        SellAdultA = '$_POST[selladult3]',
                                        QuoChdTwnA = '$_POST[quochd3]',
                                        SellChdTwnA = '$_POST[sellchd3]',
                                        QuoChdXbedA = '$_POST[quochdx3]',
                                        SellChdXbedA = '$_POST[sellchdx3]',
                                        QuoChdNbedA = '$_POST[quochdn3]',
                                        SellChdNbedA = '$_POST[sellchdn3]',
                                        QuotationCurrA = '$_POST[quotationcurr]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator]',
                                        SellingRateA = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT3' AND IDProduct = '$_POST[id]'");
  $Sup4=strtoupper($_POST[supplier4]);
  $Desc4=strtoupper($_POST[desc4]);
  mysql_query("UPDATE tour_agent set Supplier = '$Sup4',
                                        Description = '$Desc4',
                                        QuoAdultA = '$_POST[quoadult4]',
                                        SellAdultA = '$_POST[selladult4]',
                                        QuoChdTwnA = '$_POST[quochd4]',
                                        SellChdTwnA = '$_POST[sellchd4]',
                                        QuoChdXbedA = '$_POST[quochdx4]',
                                        SellChdXbedA = '$_POST[sellchdx4]',
                                        QuoChdNbedA = '$_POST[quochdn4]',
                                        SellChdNbedA = '$_POST[sellchdn4]',
                                        QuotationCurrA = '$_POST[quotationcurr]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator]',
                                        SellingRateA = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT4' AND IDProduct = '$_POST[id]'");
  $Sup5=strtoupper($_POST[supplier5]);
  $Desc5=strtoupper($_POST[desc5]);
  mysql_query("UPDATE tour_agent set Supplier = '$Sup5',
                                        Description = '$Desc5',
                                        QuoAdultA = '$_POST[quoadult5]',
                                        SellAdultA = '$_POST[selladult5]',
                                        QuoChdTwnA = '$_POST[quochd5]',
                                        SellChdTwnA = '$_POST[sellchd5]',
                                        QuoChdXbedA = '$_POST[quochdx5]',
                                        SellChdXbedA = '$_POST[sellchdx5]',
                                        QuoChdNbedA = '$_POST[quochdn5]',
                                        SellChdNbedA = '$_POST[sellchdn5]',
                                        QuotationCurrA = '$_POST[quotationcurr]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator]',
                                        SellingRateA = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT5' AND IDProduct = '$_POST[id]'");
  $Sup6=strtoupper($_POST[supplier6]);
  $Desc6=strtoupper($_POST[desc6]);
  mysql_query("UPDATE tour_agent set Supplier = '$Sup6',
                                        Description = '$Desc6',
                                        QuoAdultA = '$_POST[quoadult6]',
                                        SellAdultA = '$_POST[selladult6]',
                                        QuoChdTwnA = '$_POST[quochd6]',
                                        SellChdTwnA = '$_POST[sellchd6]',
                                        QuoChdXbedA = '$_POST[quochdx6]',
                                        SellChdXbedA = '$_POST[sellchdx6]',
                                        QuoChdNbedA = '$_POST[quochdn6]',
                                        SellChdNbedA = '$_POST[sellchdn6]',
                                        QuotationCurrA = '$_POST[quotationcurr]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator]',
                                        SellingRateA = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT6' AND IDProduct = '$_POST[id]'");
  $Sup7=strtoupper($_POST[supplier7]);
  $Desc7=strtoupper($_POST[desc7]);
  mysql_query("UPDATE tour_agent set Supplier = '$Sup7',
                                        Description = '$Desc7',
                                        QuoAdultA = '$_POST[quoadult7]',
                                        SellAdultA = '$_POST[selladult7]',
                                        QuoChdTwnA = '$_POST[quochd7]',
                                        SellChdTwnA = '$_POST[sellchd7]',
                                        QuoChdXbedA = '$_POST[quochdx7]',
                                        SellChdXbedA = '$_POST[sellchdx7]',
                                        QuoChdNbedA = '$_POST[quochdn7]',
                                        SellChdNbedA = '$_POST[sellchdn7]',
                                        QuotationCurrA = '$_POST[quotationcurr]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator]',
                                        SellingRateA = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT7' AND IDProduct = '$_POST[id]'");
  $Sup8=strtoupper($_POST[supplier8]);
  $Desc8=strtoupper($_POST[desc8]);
  mysql_query("UPDATE tour_agent set Supplier = '$Sup8',
                                        Description = '$Desc8',
                                        QuoAdultA = '$_POST[quoadult8]',
                                        SellAdultA = '$_POST[selladult8]',
                                        QuoChdTwnA = '$_POST[quochd8]',
                                        SellChdTwnA = '$_POST[sellchd8]',
                                        QuoChdXbedA = '$_POST[quochdx8]',
                                        SellChdXbedA = '$_POST[sellchdx8]',
                                        QuoChdNbedA = '$_POST[quochdn8]',
                                        SellChdNbedA = '$_POST[sellchdn8]',
                                        QuotationCurrA = '$_POST[quotationcurr]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator]',
                                        SellingRateA = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT8' AND IDProduct = '$_POST[id]'");
  $Sup9=strtoupper($_POST[supplier9]);
  $Desc9=strtoupper($_POST[desc9]);
  mysql_query("UPDATE tour_agent set Supplier = '$Sup9',
                                        Description = '$Desc9',
                                        QuoAdultA = '$_POST[quoadult9]',
                                        SellAdultA = '$_POST[selladult9]',
                                        QuoChdTwnA = '$_POST[quochd9]',
                                        SellChdTwnA = '$_POST[sellchd9]',
                                        QuoChdXbedA = '$_POST[quochdx9]',
                                        SellChdXbedA = '$_POST[sellchdx9]',
                                        QuoChdNbedA = '$_POST[quochdn9]',
                                        SellChdNbedA = '$_POST[sellchdn9]',
                                        QuotationCurrA = '$_POST[quotationcurr]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator]',
                                        SellingRateA = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT9' AND IDProduct = '$_POST[id]'");
  $Sup10=strtoupper($_POST[supplier10]);
  $Desc10=strtoupper($_POST[desc10]);
  mysql_query("UPDATE tour_agent set Supplier = '$Sup10',
                                        Description = '$Desc10',
                                        QuoAdultA = '$_POST[quoadult10]',
                                        SellAdultA = '$_POST[selladult10]',
                                        QuoChdTwnA = '$_POST[quochd10]',
                                        SellChdTwnA = '$_POST[sellchd10]',
                                        QuoChdXbedA = '$_POST[quochdx10]',
                                        SellChdXbedA = '$_POST[sellchdx10]',
                                        QuoChdNbedA = '$_POST[quochdn10]',
                                        SellChdNbedA = '$_POST[sellchdn10]',
                                        QuotationCurrA = '$_POST[quotationcurr]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator]',
                                        SellingRateA = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT10' AND IDProduct = '$_POST[id]'");
  mysql_query("UPDATE tour_msdetail set TotalAdultA = '$_POST[totaladulta]',
                                        TotalChdTwnA = '$_POST[totalchdtwna]',
                                        TotalChdXbedA = '$_POST[totalchdxbeda]',
                                        TotalChdNbedA = '$_POST[totalchdnbeda]',
                                        PaxA = '$paxa'
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

// OPTION B
case "b":
$edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $depdate = substr($r[DateTravelFrom],8,2);         
    echo "<h2>AGENT COST (OPTION B) - $r[TourCode]</h2>    
          <form method=POST name='calculate' action='?module=agent&act=saveb'>
          <input type='hidden' name=id value='$r[IDProduct]'><input type='hidden' name='tourcode' value='$r[TourCode]'> 
          <input type='hidden' name='sellingoperator' value='$r[SellingOperator]'>
          <input type='hidden' name='sellingrate' value='$r[SellingRate]'>
          <input type='hidden' name='quotationcurr' value='$r[QuotationCurr]'>
          <input type='hidden' name='sellingcurr' value='$r[SellingCurr]'>";
            $isifix1=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT1' and IDProduct = '$r[IDProduct]' ");
            $fix1=mysql_fetch_array($isifix1);  
            $isifix2=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT2' and IDProduct = '$r[IDProduct]' ");
            $fix2=mysql_fetch_array($isifix2);
            $isifix3=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT3' and IDProduct = '$r[IDProduct]' ");
            $fix3=mysql_fetch_array($isifix3);
            $isifix4=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT4' and IDProduct = '$r[IDProduct]' ");
            $fix4=mysql_fetch_array($isifix4);
            $isifix5=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT5' and IDProduct = '$r[IDProduct]' ");
            $fix5=mysql_fetch_array($isifix5);
            $isifix6=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT6' and IDProduct = '$r[IDProduct]' ");
            $fix6=mysql_fetch_array($isifix6);
            $isifix7=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT7' and IDProduct = '$r[IDProduct]' ");
            $fix7=mysql_fetch_array($isifix7);
            $isifix8=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT8' and IDProduct = '$r[IDProduct]' ");
            $fix8=mysql_fetch_array($isifix8);
            $isifix9=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT9' and IDProduct = '$r[IDProduct]' ");
            $fix9=mysql_fetch_array($isifix9);
            $isifix10=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT10' and IDProduct = '$r[IDProduct]' ");
            $fix10=mysql_fetch_array($isifix10);
            $isitotal=mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct = '$r[IDProduct]' ");
            $totfix=mysql_fetch_array($isitotal);
            if($fix1[SellingOperator]==''){$tampil1='enable';$tampil2='disabled';}else{
                if($r[SellingOperator]<>$fix1[SellingOperatorB] && $r[SellingRate]<>$fix1[SellingRateB]){$tampil1='disabled';$tampil2='enable';}
                else if($r[SellingOperator]==$fix1[SellingOperatorB] && $r[SellingRate]<>$fix1[SellingRateB]){$tampil1='disabled';$tampil2='enable';}
                else if($r[SellingOperator]<>$fix1[SellingOperatorB] && $r[SellingRate]==$fix1[SellingRateB]){$tampil1='disabled';$tampil2='enable';}
                else if($r[SellingOperator]==$fix1[SellingOperatorB] && $r[SellingRate]==$fix1[SellingRateB]){$tampil1='enable';$tampil2='disabled';} 
            }
            echo "<table>
                    <tr><th width=200>PAX : <input type=text name='paxb' size='3' value='$totfix[PaxB]'></th><th width=300></th><th colspan=2>adult</th><th colspan=6>Child </th></tr>
                    <tr><th></th><th></th><th colspan=2></th><th colspan=2>Twin BED</th><th colspan=2>Extra BED </th><th colspan=2>NO BED </th></tr>
                    <tr><th>supplier</th><th>description</th><th>In $r[QuotationCurr]</th><th>In $r[SellingCurr]</th><th>In $r[QuotationCurr]</th><th>In $r[SellingCurr]</th><th>In $r[QuotationCurr]</th><th>In $r[SellingCurr]</th><th>In $r[QuotationCurr]</th><th>In $r[SellingCurr]</th></tr> 
                     
                     <tr><td>$fix1[Supplier]</td><td>$fix1[Description]</td>
                     <td><input type=text name='quoadult1' size='12' value='$fix1[QuoAdultB]'onkeyup='isNumber(this);UpdateSellA(1)'></td><td><input type='text' name='selladult1' value='$fix1[SellAdultB]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd1' size='12' value='$fix1[QuoChdTwnB]'onkeyup='isNumber(this);UpdateSellC(1)'></td><td><input type='text' name='sellchd1' value='$fix1[SellChdTwnB]' size='12'onkeyup='isNumber(this);TotalC()' ></td>
                     <td><input type=text name='quochdx1' size='12' value='$fix1[QuoChdXbedB]'onkeyup='isNumber(this);UpdateSellD(1)'></td><td><input type='text' name='sellchdx1' value='$fix1[SellChdXbedB]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn1' size='12' value='$fix1[QuoChdNbedB]'onkeyup='isNumber(this);UpdateSellN(1)'></td><td><input type='text' name='sellchdn1' value='$fix1[SellChdNbedB]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix2[Supplier]</td><td>$fix2[Description]</td>
                     <td><input type=text name='quoadult2' size='12' value='$fix2[QuoAdultB]'onkeyup='isNumber(this);UpdateSellA(2)'></td><td><input type='text' name='selladult2' value='$fix2[SellAdultB]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd2' size='12' value='$fix2[QuoChdTwnB]'onkeyup='isNumber(this);UpdateSellC(2)'></td><td><input type='text' name='sellchd2'  value='$fix2[SellChdTwnB]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx2' size='12' value='$fix2[QuoChdXbedB]'onkeyup='isNumber(this);UpdateSellD(2)'></td><td><input type='text' name='sellchdx2' value='$fix2[SellChdXbedB]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn2' size='12' value='$fix2[QuoChdNbedB]'onkeyup='isNumber(this);UpdateSellN(2)'></td><td><input type='text' name='sellchdn2' value='$fix2[SellChdNbedB]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix3[Supplier]</td><td>$fix3[Description]</td>
                     <td><input type=text name='quoadult3' size='12' value='$fix3[QuoAdultB]'onkeyup='isNumber(this);UpdateSellA(3)'></td><td><input type='text' name='selladult3' value='$fix3[SellAdultB]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd3' size='12' value='$fix3[QuoChdTwnB]'onkeyup='isNumber(this);UpdateSellC(3)'></td><td><input type='text' name='sellchd3'  value='$fix3[SellChdTwnB]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx3' size='12' value='$fix3[QuoChdXbedB]'onkeyup='isNumber(this);UpdateSellD(3)'></td><td><input type='text' name='sellchdx3' value='$fix3[SellChdXbedB]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn3' size='12' value='$fix3[QuoChdNbedB]'onkeyup='isNumber(this);UpdateSellN(3)'></td><td><input type='text' name='sellchdn3' value='$fix3[SellChdNbedB]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix4[Supplier]</td><td>$fix4[Description]</td>
                     <td><input type=text name='quoadult4' size='12' value='$fix4[QuoAdultB]'onkeyup='isNumber(this);UpdateSellA(4)'></td><td><input type='text' name='selladult4'  value='$fix4[SellAdultB]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd4' size='12' value='$fix4[QuoChdTwnB]'onkeyup='isNumber(this);UpdateSellC(4)'></td><td><input type='text' name='sellchd4' value='$fix4[SellChdTwnB]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx4' size='12' value='$fix4[QuoChdXbedB]'onkeyup='isNumber(this);UpdateSellD(4)'></td><td><input type='text' name='sellchdx4' value='$fix4[SellChdXbedB]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn4' size='12' value='$fix4[QuoChdNbedB]'onkeyup='isNumber(this);UpdateSellN(4)'></td><td><input type='text' name='sellchdn4' value='$fix4[SellChdNbedB]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix5[Supplier]</td><td>$fix5[Description]</td>
                     <td><input type=text name='quoadult5' size='12' value='$fix5[QuoAdultB]'onkeyup='isNumber(this);UpdateSellA(5)'></td><td><input type='text' name='selladult5'  value='$fix5[SellAdultB]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd5' size='12' value='$fix5[QuoChdTwnB]'onkeyup='isNumber(this);UpdateSellC(5)'></td><td><input type='text' name='sellchd5'  value='$fix5[SellChdTwnB]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx5' size='12' value='$fix5[QuoChdXbedB]'onkeyup='isNumber(this);UpdateSellD(5)'></td><td><input type='text' name='sellchdx5' value='$fix5[SellChdXbedB]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn5' size='12' value='$fix5[QuoChdNbedB]'onkeyup='isNumber(this);UpdateSellN(5)'></td><td><input type='text' name='sellchdn5' value='$fix5[SellChdNbedB]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix6[Supplier]</td><td>$fix6[Description]</td>
                     <td><input type=text name='quoadult6' size='12' value='$fix6[QuoAdultB]'onkeyup='isNumber(this);UpdateSellA(6)'></td><td><input type='text' name='selladult6'  value='$fix6[SellAdultB]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd6' size='12' value='$fix6[QuoChdTwnB]'onkeyup='isNumber(this);UpdateSellC(6)'></td><td><input type='text' name='sellchd6' value='$fix6[SellChdTwnB]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx6' size='12' value='$fix6[QuoChdXbedB]'onkeyup='isNumber(this);UpdateSellD(6)'></td><td><input type='text' name='sellchdx6' value='$fix6[SellChdXbedB]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn6' size='12' value='$fix6[QuoChdNbedB]'onkeyup='isNumber(this);UpdateSellN(6)'></td><td><input type='text' name='sellchdn6' value='$fix6[SellChdNbedB]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix7[Supplier]</td><td>$fix7[Description]</td>
                     <td><input type=text name='quoadult7' size='12' value='$fix7[QuoAdultB]'onkeyup='isNumber(this);UpdateSellA(7)'></td><td><input type='text' name='selladult7'  value='$fix7[SellAdultB]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd7' size='12' value='$fix7[QuoChdTwnB]'onkeyup='isNumber(this);UpdateSellC(7)'></td><td><input type='text' name='sellchd7' value='$fix7[SellChdTwnB]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx7' size='12' value='$fix7[QuoChdXbedB]'onkeyup='isNumber(this);UpdateSellD(7)'></td><td><input type='text' name='sellchdx7' value='$fix7[SellChdXbedB]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn7' size='12' value='$fix7[QuoChdNbedB]'onkeyup='isNumber(this);UpdateSellN(7)'></td><td><input type='text' name='sellchdn7' value='$fix7[SellChdNbedB]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix8[Supplier]</td><td>$fix8[Description]</td>
                     <td><input type=text name='quoadult8' size='12' value='$fix8[QuoAdultB]'onkeyup='isNumber(this);UpdateSellA(8)'></td><td><input type='text' name='selladult8' value='$fix8[SellAdultB]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd8' size='12' value='$fix8[QuoChdTwnB]'onkeyup='isNumber(this);UpdateSellC(8)'></td><td><input type='text' name='sellchd8'  value='$fix8[SellChdTwnB]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx8' size='12' value='$fix8[QuoChdXbedB]'onkeyup='isNumber(this);UpdateSellD(8)'></td><td><input type='text' name='sellchdx8' value='$fix8[SellChdXbedB]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn8' size='12' value='$fix8[QuoChdNbedB]'onkeyup='isNumber(this);UpdateSellN(8)'></td><td><input type='text' name='sellchdn8' value='$fix8[SellChdNbedB]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix9[Supplier]</td><td>$fix9[Description]</td>
                     <td><input type=text name='quoadult9' size='12' value='$fix9[QuoAdultB]'onkeyup='isNumber(this);UpdateSellA(9)'></td><td><input type='text' name='selladult9'  value='$fix9[SellAdultB]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd9' size='12' value='$fix9[QuoChdTwnB]'onkeyup='isNumber(this);UpdateSellC(9)'></td><td><input type='text' name='sellchd9'  value='$fix9[SellChdTwnB]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx9' size='12' value='$fix9[QuoChdXbedB]'onkeyup='isNumber(this);UpdateSellD(9)'></td><td><input type='text' name='sellchdx9' value='$fix9[SellChdXbedB]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn9' size='12' value='$fix9[QuoChdNbedB]'onkeyup='isNumber(this);UpdateSellN(9)'></td><td><input type='text' name='sellchdn9' value='$fix9[SellChdNbedB]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix10[Supplier]</td><td>$fix10[Description]</td>
                     <td><input type=text name='quoadult10' size='12' value='$fix10[QuoAdultB]'onkeyup='isNumber(this);UpdateSellA(10)'></td><td><input type='text' name='selladult10' value='$fix10[SellAdultB]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd10' size='12' value='$fix10[QuoChdTwnB]'onkeyup='isNumber(this);UpdateSellC(10)'></td><td><input type='text' name='sellchd10' value='$fix10[SellChdTwnB]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx10' size='12' value='$fix10[QuoChdXbedB]'onkeyup='isNumber(this);UpdateSellD(10)'></td><td><input type='text' name='sellchdx10' value='$fix10[SellChdXbedB]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn10' size='12' value='$fix10[QuoChdNbedB]'onkeyup='isNumber(this);UpdateSellN(10)'></td><td><input type='text' name='sellchdn10' value='$fix10[SellChdNbedB]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                    <tr><td colspan=3><b><i>TOTAL</td><td><input type='text' name='totaladulta' value='$totfix[TotalAdultB]' size='12' style='text-align: left;font-weight:bold;border: 0px solid #000000;' readonly></td><td></td><td><input type='text' name='totalchdtwna' value='$totfix[TotalChdTwnB]' size='12' style='text-align: left;font-weight:bold;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdxbeda' value='$totfix[TotalChdXbedB]' size='12' style='text-align: left;font-weight:bold;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdnbeda' value='$totfix[TotalChdNbedB]' size='12' style='text-align: left;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
                    </table>    
          
          <center><input type='submit' name='submit' value='Save' $tampil1> <input type='button' name='recalculate' value='Re-Calculate' onclick='itung()' $tampil2> 
          </form>";
     break;  
  
  case "saveb":
  $paxb=$_POST[paxb];                   
  $Description="Update Fix Cost ($_POST[tourcode])"; 
  $Sup1=strtoupper($_POST[supplier1]);
  $Desc1=strtoupper($_POST[desc1]);
  mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult1]',
                                        SellAdultB = '$_POST[selladult1]',
                                        QuoChdTwnB = '$_POST[quochd1]',
                                        SellChdTwnB = '$_POST[sellchd1]',
                                        QuoChdXbedB = '$_POST[quochdx1]',
                                        SellChdXbedB = '$_POST[sellchdx1]',
                                        QuoChdNbedB = '$_POST[quochdn1]',
                                        SellChdNbedB = '$_POST[sellchdn1]',
                                        QuotationCurrB = '$_POST[quotationcurr]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator]',
                                        SellingRateB = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT1' AND IDProduct = '$_POST[id]'");
  $Sup2=strtoupper($_POST[supplier2]);
  $Desc2=strtoupper($_POST[desc2]);
  mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult2]',
                                        SellAdultB = '$_POST[selladult2]',
                                        QuoChdTwnB = '$_POST[quochd2]',
                                        SellChdTwnB = '$_POST[sellchd2]',
                                        QuoChdXbedB = '$_POST[quochdx2]',
                                        SellChdXbedB = '$_POST[sellchdx2]',
                                        QuoChdNbedB = '$_POST[quochdn2]',
                                        SellChdNbedB = '$_POST[sellchdn2]',
                                        QuotationCurrB = '$_POST[quotationcurr]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator]',
                                        SellingRateB = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT2' AND IDProduct = '$_POST[id]'");
  $Sup3=strtoupper($_POST[supplier3]);
  $Desc3=strtoupper($_POST[desc3]);
  mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult3]',
                                        SellAdultB = '$_POST[selladult3]',
                                        QuoChdTwnB = '$_POST[quochd3]',
                                        SellChdTwnB = '$_POST[sellchd3]',
                                        QuoChdXbedB = '$_POST[quochdx3]',
                                        SellChdXbedB = '$_POST[sellchdx3]',
                                        QuoChdNbedB = '$_POST[quochdn3]',
                                        SellChdNbedB = '$_POST[sellchdn3]',
                                        QuotationCurrB = '$_POST[quotationcurr]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator]',
                                        SellingRateB = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT3' AND IDProduct = '$_POST[id]'");
  $Sup4=strtoupper($_POST[supplier4]);
  $Desc4=strtoupper($_POST[desc4]);
  mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult4]',
                                        SellAdultB = '$_POST[selladult4]',
                                        QuoChdTwnB = '$_POST[quochd4]',
                                        SellChdTwnB = '$_POST[sellchd4]',
                                        QuoChdXbedB = '$_POST[quochdx4]',
                                        SellChdXbedB = '$_POST[sellchdx4]' ,
                                        QuoChdNbedB = '$_POST[quochdn4]',
                                        SellChdNbedB = '$_POST[sellchdn4]',
                                        QuotationCurrB = '$_POST[quotationcurr]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator]',
                                        SellingRateB = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT4' AND IDProduct = '$_POST[id]'");
  $Sup5=strtoupper($_POST[supplier5]);
  $Desc5=strtoupper($_POST[desc5]);
  mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult5]',
                                        SellAdultB = '$_POST[selladult5]',
                                        QuoChdTwnB = '$_POST[quochd5]',
                                        SellChdTwnB = '$_POST[sellchd5]',
                                        QuoChdXbedB = '$_POST[quochdx5]',
                                        SellChdXbedB = '$_POST[sellchdx5]',
                                        QuoChdNbedB = '$_POST[quochdn5]',
                                        SellChdNbedB = '$_POST[sellchdn5]',
                                        QuotationCurrB = '$_POST[quotationcurr]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator]',
                                        SellingRateB = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT5' AND IDProduct = '$_POST[id]'");
  $Sup6=strtoupper($_POST[supplier6]);
  $Desc6=strtoupper($_POST[desc6]);
  mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult6]',
                                        SellAdultB = '$_POST[selladult6]',
                                        QuoChdTwnB = '$_POST[quochd6]',
                                        SellChdTwnB = '$_POST[sellchd6]',
                                        QuoChdXbedB = '$_POST[quochdx6]',
                                        SellChdXbedB = '$_POST[sellchdx6]',
                                        QuoChdNbedB = '$_POST[quochdn6]',
                                        SellChdNbedB = '$_POST[sellchdn6]',
                                        QuotationCurrB = '$_POST[quotationcurr]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator]',
                                        SellingRateB = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT6' AND IDProduct = '$_POST[id]'");
  $Sup7=strtoupper($_POST[supplier7]);
  $Desc7=strtoupper($_POST[desc7]);
  mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult7]',
                                        SellAdultB = '$_POST[selladult7]',
                                        QuoChdTwnB = '$_POST[quochd7]',
                                        SellChdTwnB = '$_POST[sellchd7]',
                                        QuoChdXbedB = '$_POST[quochdx7]',
                                        SellChdXbedB = '$_POST[sellchdx7]',
                                        QuoChdNbedB = '$_POST[quochdn7]',
                                        SellChdNbedB = '$_POST[sellchdn7]',
                                        QuotationCurrB = '$_POST[quotationcurr]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator]',
                                        SellingRateB = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT7' AND IDProduct = '$_POST[id]'");
  $Sup8=strtoupper($_POST[supplier8]);
  $Desc8=strtoupper($_POST[desc8]);
  mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult8]',
                                        SellAdultB = '$_POST[selladult8]',
                                        QuoChdTwnB = '$_POST[quochd8]',
                                        SellChdTwnB = '$_POST[sellchd8]',
                                        QuoChdXbedB = '$_POST[quochdx8]',
                                        SellChdXbedB = '$_POST[sellchdx8]',
                                        QuoChdNbedB = '$_POST[quochdn8]',
                                        SellChdNbedB = '$_POST[sellchdn8]',
                                        QuotationCurrB = '$_POST[quotationcurr]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator]',
                                        SellingRateB = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT8' AND IDProduct = '$_POST[id]'");
  $Sup9=strtoupper($_POST[supplier9]);
  $Desc9=strtoupper($_POST[desc9]);
  mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult9]',
                                        SellAdultB = '$_POST[selladult9]',
                                        QuoChdTwnB = '$_POST[quochd9]',
                                        SellChdTwnB = '$_POST[sellchd9]',
                                        QuoChdXbedB = '$_POST[quochdx9]',
                                        SellChdXbedB = '$_POST[sellchdx9]',
                                        QuoChdNbedB = '$_POST[quochdn9]',
                                        SellChdNbedB = '$_POST[sellchdn9]',
                                        QuotationCurrB = '$_POST[quotationcurr]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator]',
                                        SellingRateB = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT9' AND IDProduct = '$_POST[id]'");
  $Sup10=strtoupper($_POST[supplier10]);
  $Desc10=strtoupper($_POST[desc10]);
  mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult10]',
                                        SellAdultB = '$_POST[selladult10]',
                                        QuoChdTwnB = '$_POST[quochd10]',
                                        SellChdTwnB = '$_POST[sellchd10]',
                                        QuoChdXbedB = '$_POST[quochdx10]',
                                        SellChdXbedB = '$_POST[sellchdx10]',
                                        QuoChdNbedB = '$_POST[quochdn10]',
                                        SellChdNbedB = '$_POST[sellchdn10]',
                                        QuotationCurrB = '$_POST[quotationcurr]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator]',
                                        SellingRateB = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT10' AND IDProduct = '$_POST[id]'");
  mysql_query("UPDATE tour_msdetail set TotalAdultB = '$_POST[totaladulta]',
                                        TotalChdTwnB = '$_POST[totalchdtwna]',
                                        TotalChdXbedB = '$_POST[totalchdxbeda]',
                                        TotalChdNbedB = '$_POST[totalchdnbeda]',
                                        PaxB = '$paxb'
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

// OPTION C
case "c":
$edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $depdate = substr($r[DateTravelFrom],8,2);         
    echo "<h2>AGENT COST (OPTION C) - $r[TourCode]</h2>    
          <form method=POST name='calculate' action='?module=agent&act=savec'>
          <input type='hidden' name=id value='$r[IDProduct]'><input type='hidden' name='tourcode' value='$r[TourCode]'> 
          <input type='hidden' name='sellingoperator' value='$r[SellingOperator]'>
          <input type='hidden' name='sellingrate' value='$r[SellingRate]'>
          <input type='hidden' name='quotationcurr' value='$r[QuotationCurr]'>
          <input type='hidden' name='sellingcurr' value='$r[SellingCurr]'>";
            $isifix1=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT1' and IDProduct = '$r[IDProduct]' ");
            $fix1=mysql_fetch_array($isifix1);  
            $isifix2=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT2' and IDProduct = '$r[IDProduct]' ");
            $fix2=mysql_fetch_array($isifix2);
            $isifix3=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT3' and IDProduct = '$r[IDProduct]' ");
            $fix3=mysql_fetch_array($isifix3);
            $isifix4=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT4' and IDProduct = '$r[IDProduct]' ");
            $fix4=mysql_fetch_array($isifix4);
            $isifix5=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT5' and IDProduct = '$r[IDProduct]' ");
            $fix5=mysql_fetch_array($isifix5);
            $isifix6=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT6' and IDProduct = '$r[IDProduct]' ");
            $fix6=mysql_fetch_array($isifix6);
            $isifix7=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT7' and IDProduct = '$r[IDProduct]' ");
            $fix7=mysql_fetch_array($isifix7);
            $isifix8=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT8' and IDProduct = '$r[IDProduct]' ");
            $fix8=mysql_fetch_array($isifix8);
            $isifix9=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT9' and IDProduct = '$r[IDProduct]' ");
            $fix9=mysql_fetch_array($isifix9);
            $isifix10=mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT10' and IDProduct = '$r[IDProduct]' ");
            $fix10=mysql_fetch_array($isifix10);
            $isitotal=mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct = '$r[IDProduct]' ");
            $totfix=mysql_fetch_array($isitotal);
            if($fix1[SellingOperator]==''){$tampil1='enable';$tampil2='disabled';}else{
                if($r[SellingOperator]<>$fix1[SellingOperatorC] && $r[SellingRate]<>$fix1[SellingRateC]){$tampil1='disabled';$tampil2='enable';}
                else if($r[SellingOperator]==$fix1[SellingOperatorC] && $r[SellingRate]<>$fix1[SellingRateC]){$tampil1='disabled';$tampil2='enable';}
                else if($r[SellingOperator]<>$fix1[SellingOperatorC] && $r[SellingRate]==$fix1[SellingRateC]){$tampil1='disabled';$tampil2='enable';}
                else if($r[SellingOperator]==$fix1[SellingOperatorC] && $r[SellingRate]==$fix1[SellingRateC]){$tampil1='enable';$tampil2='disabled';} 
            }
            echo "<table>
                    <tr><th width=200>PAX : <input type=text name='paxc' size='3' value='$totfix[PaxC]'></th><th width=300></th><th colspan=2>adult</th><th colspan=6>Child </th></tr>
                    <tr><th></th><th></th><th colspan=2></th><th colspan=2>Twin BED</th><th colspan=2>Extra BED </th><th colspan=2>NO BED </th></tr>
                    <tr><th>supplier</th><th>description</th><th>In $r[QuotationCurr]</th><th>In $r[SellingCurr]</th><th>In $r[QuotationCurr]</th><th>In $r[SellingCurr]</th><th>In $r[QuotationCurr]</th><th>In $r[SellingCurr]</th><th>In $r[QuotationCurr]</th><th>In $r[SellingCurr]</th></tr> 
                     
                     <tr><td>$fix1[Supplier]</td><td>$fix1[Description]</td>
                     <td><input type=text name='quoadult1' size='12' value='$fix1[QuoAdultC]'onkeyup='isNumber(this);UpdateSellA(1)'></td><td><input type='text' name='selladult1' value='$fix1[SellAdultC]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd1' size='12' value='$fix1[QuoChdTwnC]'onkeyup='isNumber(this);UpdateSellC(1)'></td><td><input type='text' name='sellchd1' value='$fix1[SellChdTwnC]' size='12'onkeyup='isNumber(this);TotalC()' ></td>
                     <td><input type=text name='quochdx1' size='12' value='$fix1[QuoChdXbedC]'onkeyup='isNumber(this);UpdateSellD(1)'></td><td><input type='text' name='sellchdx1' value='$fix1[SellChdXbedC]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn1' size='12' value='$fix1[QuoChdNbedC]'onkeyup='isNumber(this);UpdateSellN(1)'></td><td><input type='text' name='sellchdn1' value='$fix1[SellChdNbedC]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix2[Supplier]</td><td>$fix2[Description]</td>
                     <td><input type=text name='quoadult2' size='12' value='$fix2[QuoAdultC]'onkeyup='isNumber(this);UpdateSellA(2)'></td><td><input type='text' name='selladult2' value='$fix2[SellAdultC]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd2' size='12' value='$fix2[QuoChdTwnC]'onkeyup='isNumber(this);UpdateSellC(2)'></td><td><input type='text' name='sellchd2'  value='$fix2[SellChdTwnC]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx2' size='12' value='$fix2[QuoChdXbedC]'onkeyup='isNumber(this);UpdateSellD(2)'></td><td><input type='text' name='sellchdx2' value='$fix2[SellChdXbedC]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn2' size='12' value='$fix2[QuoChdNbedC]'onkeyup='isNumber(this);UpdateSellN(2)'></td><td><input type='text' name='sellchdn2' value='$fix2[SellChdNbedC]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix3[Supplier]</td><td>$fix3[Description]</td>
                     <td><input type=text name='quoadult3' size='12' value='$fix3[QuoAdultC]'onkeyup='isNumber(this);UpdateSellA(3)'></td><td><input type='text' name='selladult3' value='$fix3[SellAdultC]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd3' size='12' value='$fix3[QuoChdTwnC]'onkeyup='isNumber(this);UpdateSellC(3)'></td><td><input type='text' name='sellchd3'  value='$fix3[SellChdTwnC]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx3' size='12' value='$fix3[QuoChdXbedC]'onkeyup='isNumber(this);UpdateSellD(3)'></td><td><input type='text' name='sellchdx3' value='$fix3[SellChdXbedC]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn3' size='12' value='$fix3[QuoChdNbedC]'onkeyup='isNumber(this);UpdateSellN(3)'></td><td><input type='text' name='sellchdn3' value='$fix3[SellChdNbedC]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix4[Supplier]</td><td>$fix4[Description]</td>
                     <td><input type=text name='quoadult4' size='12' value='$fix4[QuoAdultC]'onkeyup='isNumber(this);UpdateSellA(4)'></td><td><input type='text' name='selladult4'  value='$fix4[SellAdultC]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd4' size='12' value='$fix4[QuoChdTwnC]'onkeyup='isNumber(this);UpdateSellC(4)'></td><td><input type='text' name='sellchd4' value='$fix4[SellChdTwnC]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx4' size='12' value='$fix4[QuoChdXbedC]'onkeyup='isNumber(this);UpdateSellD(4)'></td><td><input type='text' name='sellchdx4' value='$fix4[SellChdXbedC]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn4' size='12' value='$fix4[QuoChdNbedC]'onkeyup='isNumber(this);UpdateSellN(4)'></td><td><input type='text' name='sellchdn4' value='$fix4[SellChdNbedC]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix5[Supplier]</td><td>$fix5[Description]</td>
                     <td><input type=text name='quoadult5' size='12' value='$fix5[QuoAdultC]'onkeyup='isNumber(this);UpdateSellA(5)'></td><td><input type='text' name='selladult5'  value='$fix5[SellAdultC]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd5' size='12' value='$fix5[QuoChdTwnC]'onkeyup='isNumber(this);UpdateSellC(5)'></td><td><input type='text' name='sellchd5'  value='$fix5[SellChdTwnC]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx5' size='12' value='$fix5[QuoChdXbedC]'onkeyup='isNumber(this);UpdateSellD(5)'></td><td><input type='text' name='sellchdx5' value='$fix5[SellChdXbedC]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn5' size='12' value='$fix5[QuoChdNbedC]'onkeyup='isNumber(this);UpdateSellN(5)'></td><td><input type='text' name='sellchdn5' value='$fix5[SellChdNbedC]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix6[Supplier]</td><td>$fix6[Description]</td>
                     <td><input type=text name='quoadult6' size='12' value='$fix6[QuoAdultC]'onkeyup='isNumber(this);UpdateSellA(6)'></td><td><input type='text' name='selladult6'  value='$fix6[SellAdultC]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd6' size='12' value='$fix6[QuoChdTwnC]'onkeyup='isNumber(this);UpdateSellC(6)'></td><td><input type='text' name='sellchd6' value='$fix6[SellChdTwnC]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx6' size='12' value='$fix6[QuoChdXbedC]'onkeyup='isNumber(this);UpdateSellD(6)'></td><td><input type='text' name='sellchdx6' value='$fix6[SellChdXbedC]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn6' size='12' value='$fix6[QuoChdNbedC]'onkeyup='isNumber(this);UpdateSellN(6)'></td><td><input type='text' name='sellchdn6' value='$fix6[SellChdNbedC]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix7[Supplier]</td><td>$fix7[Description]</td>
                     <td><input type=text name='quoadult7' size='12' value='$fix7[QuoAdultC]'onkeyup='isNumber(this);UpdateSellA(7)'></td><td><input type='text' name='selladult7'  value='$fix7[SellAdultC]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd7' size='12' value='$fix7[QuoChdTwnC]'onkeyup='isNumber(this);UpdateSellC(7)'></td><td><input type='text' name='sellchd7' value='$fix7[SellChdTwnC]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx7' size='12' value='$fix7[QuoChdXbedC]'onkeyup='isNumber(this);UpdateSellD(7)'></td><td><input type='text' name='sellchdx7' value='$fix7[SellChdXbedC]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn7' size='12' value='$fix7[QuoChdNbedC]'onkeyup='isNumber(this);UpdateSellN(7)'></td><td><input type='text' name='sellchdn7' value='$fix7[SellChdNbedC]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix8[Supplier]</td><td>$fix8[Description]</td>
                     <td><input type=text name='quoadult8' size='12' value='$fix8[QuoAdultC]'onkeyup='isNumber(this);UpdateSellA(8)'></td><td><input type='text' name='selladult8' value='$fix8[SellAdultC]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd8' size='12' value='$fix8[QuoChdTwnC]'onkeyup='isNumber(this);UpdateSellC(8)'></td><td><input type='text' name='sellchd8'  value='$fix8[SellChdTwnC]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx8' size='12' value='$fix8[QuoChdXbedC]'onkeyup='isNumber(this);UpdateSellD(8)'></td><td><input type='text' name='sellchdx8' value='$fix8[SellChdXbedC]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn8' size='12' value='$fix8[QuoChdNbedC]'onkeyup='isNumber(this);UpdateSellN(8)'></td><td><input type='text' name='sellchdn8' value='$fix8[SellChdNbedC]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix9[Supplier]</td><td>$fix9[Description]</td>
                     <td><input type=text name='quoadult9' size='12' value='$fix9[QuoAdultC]'onkeyup='isNumber(this);UpdateSellA(9)'></td><td><input type='text' name='selladult9'  value='$fix9[SellAdultC]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd9' size='12' value='$fix9[QuoChdTwnC]'onkeyup='isNumber(this);UpdateSellC(9)'></td><td><input type='text' name='sellchd9'  value='$fix9[SellChdTwnC]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx9' size='12' value='$fix9[QuoChdXbedC]'onkeyup='isNumber(this);UpdateSellD(9)'></td><td><input type='text' name='sellchdx9' value='$fix9[SellChdXbedC]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn9' size='12' value='$fix9[QuoChdNbedC]'onkeyup='isNumber(this);UpdateSellN(9)'></td><td><input type='text' name='sellchdn9' value='$fix9[SellChdNbedC]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                     <tr><td>$fix10[Supplier]</td><td>$fix10[Description]</td>
                     <td><input type=text name='quoadult10' size='12' value='$fix10[QuoAdultC]'onkeyup='isNumber(this);UpdateSellA(10)'></td><td><input type='text' name='selladult10' value='$fix10[SellAdultC]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <td><input type=text name='quochd10' size='12' value='$fix10[QuoChdTwnC]'onkeyup='isNumber(this);UpdateSellC(10)'></td><td><input type='text' name='sellchd10' value='$fix10[SellChdTwnC]' size='12' onkeyup='isNumber(this);TotalC()'></td>
                     <td><input type=text name='quochdx10' size='12' value='$fix10[QuoChdXbedC]'onkeyup='isNumber(this);UpdateSellD(10)'></td><td><input type='text' name='sellchdx10' value='$fix10[SellChdXbedC]' size='12'onkeyup='isNumber(this);TotalD()' ></td>
                     <td><input type=text name='quochdn10' size='12' value='$fix10[QuoChdNbedC]'onkeyup='isNumber(this);UpdateSellN(10)'></td><td><input type='text' name='sellchdn10' value='$fix10[SellChdNbedC]' size='12'onkeyup='isNumber(this);TotalN()' ></td></tr>
                    <tr><td colspan=3><b><i>TOTAL</td><td><input type='text' name='totaladulta' value='$totfix[TotalAdultC]' size='12' style='text-align: left;border: 0px solid #000000;' readonly></td><td></td><td><input type='text' name='totalchdtwna' value='$totfix[TotalChdTwnC]' size='12' style='text-align: left;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdxbeda' value='$totfix[TotalChdXbedC]' size='12' style='text-align: left;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdnbeda' value='$totfix[TotalChdNbedC]' size='12' style='text-align: left;border: 0px solid #000000;' readonly></td></tr>
                    </table>    
          
          <center><input type='submit' name='submit' value='Save' $tampil1> <input type='button' name='recalculate' value='Re-Calculate' onclick='itung()' $tampil2> 
          </form>";
     break;  
  
  case "savec":
  $paxc=$_POST[paxc];                   
  $Description="Update Fix Cost ($_POST[tourcode])"; 
  $Sup1=strtoupper($_POST[supplier1]);
  $Desc1=strtoupper($_POST[desc1]);
   mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult1]',
                                        SellAdultC = '$_POST[selladult1]',
                                        QuoChdTwnC = '$_POST[quochd1]',
                                        SellChdTwnC = '$_POST[sellchd1]',
                                        QuoChdXbedC = '$_POST[quochdx1]',
                                        SellChdXbedC = '$_POST[sellchdx1]',
                                        QuoChdNbedC = '$_POST[quochdn1]',
                                        SellChdNbedC = '$_POST[sellchdn1]',
                                        QuotationCurrC = '$_POST[quotationcurr]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator]',
                                        SellingRateC = '$_POST[sellingrate]'
                                        WHERE Category = 'AGENT1' AND IDProduct = '$_POST[id]'");
  $Sup2=strtoupper($_POST[supplier2]);
  $Desc2=strtoupper($_POST[desc2]);
  mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult2]',
                                        SellAdultC = '$_POST[selladult2]',
                                        QuoChdTwnC = '$_POST[quochd2]',
                                        SellChdTwnC = '$_POST[sellchd2]',
                                        QuoChdXbedC = '$_POST[quochdx2]',
                                        SellChdXbedC = '$_POST[sellchdx2]',
                                        QuoChdNbedC = '$_POST[quochdn2]',
                                        SellChdNbedC = '$_POST[sellchdn2]',
                                        QuotationCurrC = '$_POST[quotationcurr]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator]',
                                        SellingRateC = '$_POST[sellingrate]' 
                                        WHERE Category = 'AGENT2' AND IDProduct = '$_POST[id]'");
  $Sup3=strtoupper($_POST[supplier3]);
  $Desc3=strtoupper($_POST[desc3]);
  mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult3]',
                                        SellAdultC = '$_POST[selladult3]',
                                        QuoChdTwnC = '$_POST[quochd3]',
                                        SellChdTwnC = '$_POST[sellchd3]',
                                        QuoChdXbedC = '$_POST[quochdx3]',
                                        SellChdXbedC = '$_POST[sellchdx3]',
                                        QuoChdNbedC = '$_POST[quochdn3]',
                                        SellChdNbedC = '$_POST[sellchdn3]',
                                        QuotationCurrC = '$_POST[quotationcurr]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator]',
                                        SellingRateC = '$_POST[sellingrate]' 
                                        WHERE Category = 'AGENT3' AND IDProduct = '$_POST[id]'");
  $Sup4=strtoupper($_POST[supplier4]);
  $Desc4=strtoupper($_POST[desc4]);
  mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult4]',
                                        SellAdultC = '$_POST[selladult4]',
                                        QuoChdTwnC = '$_POST[quochd4]',
                                        SellChdTwnC = '$_POST[sellchd4]',
                                        QuoChdXbedC = '$_POST[quochdx4]',
                                        SellChdXbedC = '$_POST[sellchdx4]',
                                        QuoChdNbedC = '$_POST[quochdn4]',
                                        SellChdNbedC = '$_POST[sellchdn4]',
                                        QuotationCurrC = '$_POST[quotationcurr]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator]',
                                        SellingRateC = '$_POST[sellingrate]' 
                                        WHERE Category = 'AGENT4' AND IDProduct = '$_POST[id]'");
  $Sup5=strtoupper($_POST[supplier5]);
  $Desc5=strtoupper($_POST[desc5]);
  mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult5]',
                                        SellAdultC = '$_POST[selladult5]',
                                        QuoChdTwnC = '$_POST[quochd5]',
                                        SellChdTwnC = '$_POST[sellchd5]',
                                        QuoChdXbedC = '$_POST[quochdx5]',
                                        SellChdXbedC = '$_POST[sellchdx5]',
                                        QuoChdNbedC = '$_POST[quochdn5]',
                                        SellChdNbedC = '$_POST[sellchdn5]',
                                        QuotationCurrC = '$_POST[quotationcurr]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator]',
                                        SellingRateC = '$_POST[sellingrate]' 
                                        WHERE Category = 'AGENT5' AND IDProduct = '$_POST[id]'");
  $Sup6=strtoupper($_POST[supplier6]);
  $Desc6=strtoupper($_POST[desc6]);
  mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult6]',
                                        SellAdultC = '$_POST[selladult6]',
                                        QuoChdTwnC = '$_POST[quochd6]',
                                        SellChdTwnC = '$_POST[sellchd6]',
                                        QuoChdXbedC = '$_POST[quochdx6]',
                                        SellChdXbedC = '$_POST[sellchdx6]',
                                        QuoChdNbedC = '$_POST[quochdn6]',
                                        SellChdNbedC = '$_POST[sellchdn6]',
                                        QuotationCurrC = '$_POST[quotationcurr]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator]',
                                        SellingRateC = '$_POST[sellingrate]' 
                                        WHERE Category = 'AGENT6' AND IDProduct = '$_POST[id]'");
  $Sup7=strtoupper($_POST[supplier7]);
  $Desc7=strtoupper($_POST[desc7]);
  mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult7]',
                                        SellAdultC = '$_POST[selladult7]',
                                        QuoChdTwnC = '$_POST[quochd7]',
                                        SellChdTwnC = '$_POST[sellchd7]',
                                        QuoChdXbedC = '$_POST[quochdx7]',
                                        SellChdXbedC = '$_POST[sellchdx7]',
                                        QuoChdNbedC = '$_POST[quochdn7]',
                                        SellChdNbedC = '$_POST[sellchdn7]',
                                        QuotationCurrC = '$_POST[quotationcurr]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator]',
                                        SellingRateC = '$_POST[sellingrate]' 
                                        WHERE Category = 'AGENT7' AND IDProduct = '$_POST[id]'");
  $Sup8=strtoupper($_POST[supplier8]);
  $Desc8=strtoupper($_POST[desc8]);
  mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult8]',
                                        SellAdultC = '$_POST[selladult8]',
                                        QuoChdTwnC = '$_POST[quochd8]',
                                        SellChdTwnC = '$_POST[sellchd8]',
                                        QuoChdXbedC = '$_POST[quochdx8]',
                                        SellChdXbedC = '$_POST[sellchdx8]',
                                        QuoChdNbedC = '$_POST[quochdn8]',
                                        SellChdNbedC = '$_POST[sellchdn8]',
                                        QuotationCurrC = '$_POST[quotationcurr]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator]',
                                        SellingRateC = '$_POST[sellingrate]' 
                                        WHERE Category = 'AGENT8' AND IDProduct = '$_POST[id]'");
  $Sup9=strtoupper($_POST[supplier9]);
  $Desc9=strtoupper($_POST[desc9]);
  mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult9]',
                                        SellAdultC = '$_POST[selladult9]',
                                        QuoChdTwnC = '$_POST[quochd9]',
                                        SellChdTwnC = '$_POST[sellchd9]',
                                        QuoChdXbedC = '$_POST[quochdx9]',
                                        SellChdXbedC = '$_POST[sellchdx9]',
                                        QuoChdNbedC = '$_POST[quochdn9]',
                                        SellChdNbedC = '$_POST[sellchdn9]',
                                        QuotationCurrC = '$_POST[quotationcurr]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator]',
                                        SellingRateC = '$_POST[sellingrate]' 
                                        WHERE Category = 'AGENT9' AND IDProduct = '$_POST[id]'");
  $Sup10=strtoupper($_POST[supplier10]);
  $Desc10=strtoupper($_POST[desc10]);
  mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult10]',
                                        SellAdultC = '$_POST[selladult10]',
                                        QuoChdTwnC = '$_POST[quochd10]',
                                        SellChdTwnC = '$_POST[sellchd10]',
                                        QuoChdXbedC = '$_POST[quochdx10]',
                                        SellChdXbedC = '$_POST[sellchdx10]',
                                        QuoChdNbedC = '$_POST[quochdn10]',
                                        SellChdNbedC = '$_POST[sellchdn10]',
                                        QuotationCurrC = '$_POST[quotationcurr]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator]',
                                        SellingRateC = '$_POST[sellingrate]' 
                                        WHERE Category = 'AGENT10' AND IDProduct = '$_POST[id]'");
  mysql_query("UPDATE tour_msdetail set TotalAdultC = '$_POST[totaladulta]',
                                        TotalChdTwnC = '$_POST[totalchdtwna]',
                                        TotalChdXbedC = '$_POST[totalchdxbeda]',
                                        TotalChdNbedC = '$_POST[totalchdnbeda]',
                                        PaxC = '$paxc'
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
