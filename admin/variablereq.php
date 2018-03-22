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
    UpdateSellA(1);
    UpdateSellA(2);
    UpdateSellA(3); 
    UpdateSellA(4); 
    UpdateSellA(5); 
    UpdateSellA(6); 
    UpdateSellA(7); 
    UpdateSellA(8); 
    UpdateSellA(9); 
    UpdateSellA(10); 
    document.variable.elements['recalculate'].disabled=true; 
    document.variable.elements['submit'].disabled=false;                        
 }
 function TotalA(){
    var t = variable.totalvaradult;
    var n1 = eval(variable.selladult1.value);
    var n2 = eval(variable.selladult2.value);
    var n3 = eval(variable.selladult3.value);
    var n4 = eval(variable.selladult4.value);
    var n5 = eval(variable.selladult5.value);
    var n6 = eval(variable.selladult6.value);
    var n7 = eval(variable.selladult7.value);
    var n8 = eval(variable.selladult8.value);
    var n9 = eval(variable.selladult9.value);
    var n10 = eval(variable.selladult10.value);
    t.value = (n1 + n2 + n3 + n4 + n5 + n6 + n7 + n8 + n9 + n10).toFixed(2) ;
    if (isNaN(t.value)) {
      t.value=0   
}
 }
 function UpdateSellA(NO) {                               
    var a = eval("variable.quoadult" + NO + ".value;")  
    var b = variable.sellingoperator.value;
    var c = eval(variable.sellingrate.value);
    var n = eval("variable.selladult" + NO + ";")  
    if(a==0){}else{
        if(b=='/'){
            var x = a / c ;   
            n.value = (x).toFixed(2) ;;          
        }else if(b=='*'){
            var x = a * c ;   
            n.value = (x).toFixed(2) ;;          
        }
    }
    if(n < a){
    n.style.backgroundColor = "red"; }
    else {n.style.backgroundColor = "white";}   
    TotalA();
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
    echo "<h2>VARIABLE COST - TMR $datatmr[TmrNo].$datatmr[TmrOption]</h2>    
          <form method=POST name='variable' action='?module=variablereq&act=save'>
          <input type='hidden' name=id value='$r[IDProduct]'><input type='hidden' name='tourcode' value='$r[TourCode]'> 
          <input type='hidden' name='sellingoperator' value='$r[SellingOperator]'>
          <input type='hidden' name='sellingrate' value='$r[SellingRate]'>
          <input type='hidden' name='quotationcurr' value='$r[QuotationCurr]'>
          <input type='hidden' name='sellingcurr' value='$r[SellingCurr]'>";
             $isivar1=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR1' ");
            $var1=mysql_fetch_array($isivar1);  
            $isivar2=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR2' ");
            $var2=mysql_fetch_array($isivar2);
            $isivar3=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR3' ");
            $var3=mysql_fetch_array($isivar3);
            $isivar4=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR4' ");
            $var4=mysql_fetch_array($isivar4);
            $isivar5=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR5' ");
            $var5=mysql_fetch_array($isivar5);
            $isivar6=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR6' ");
            $var6=mysql_fetch_array($isivar6);
            $isivar7=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR7' ");
            $var7=mysql_fetch_array($isivar7);
            $isivar8=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR8' ");
            $var8=mysql_fetch_array($isivar8);
            $isivar9=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR9' ");
            $var9=mysql_fetch_array($isivar9);
            $isivar10=mysql_query("SELECT * FROM tour_detailreq
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR10' ");
            $var10=mysql_fetch_array($isivar10);
            $isitotal=mysql_query("SELECT * FROM tour_msdetailreq
                                where IDProduct = '$r[IDProduct]' ");
            $totvar=mysql_fetch_array($isitotal);
            if($var1[SellingOperator]==''){$tampil1='enable';$tampil2='disabled';}
            else if($r[SellingOperator]<>$var1[SellingOperator] && $r[SellingRate]<>$var1[SellingRate]){$tampil1='disabled';$tampil2='enable'; }
                else if($r[SellingOperator]==$var1[SellingOperator] && $r[SellingRate]<>$var1[SellingRate]){$tampil1='disabled';$tampil2='enable';}
                else if($r[SellingOperator]<>$var1[SellingOperator] && $r[SellingRate]==$var1[SellingRate]){$tampil1='disabled';$tampil2='enable';}
                else if($r[SellingOperator]==$var1[SellingOperator] && $r[SellingRate]==$var1[SellingRate]){$tampil1='enable';$tampil2='disabled';} 
            
            echo "<table>
                    <tr><th>supplier</th><th>description</th><th colspan=2>adult</th></tr>
                    <tr><th></th><th></th><th>In $r[QuotationCurr]</th><th>In $r[SellingCurr]</th> 
                    <tr><td><select name='supplier1'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($var1[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc1' size='30' value='$var1[Description]'></td>
                     <td><input type=text name='quoadult1' size='12' value='$var1[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(1)'></td><td><input type='text' name='selladult1' value='$var1[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td></tr>
                     <tr><td><select name='supplier2'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($var2[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc2' size='30' value='$var2[Description]'></td>
                     <td><input type=text name='quoadult2' size='12' value='$var2[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(2)'></td><td><input type='text' name='selladult2' value='$var2[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td></tr>
                     <tr><td><select name='supplier3'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($var3[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc3' size='30' value='$var3[Description]'></td>
                     <td><input type=text name='quoadult3' size='12' value='$var3[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(3)'></td><td><input type='text' name='selladult3' value='$var3[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td></tr>
                     <tr><td><select name='supplier4'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($var4[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc4' size='30' value='$var4[Description]'></td>
                     <td><input type=text name='quoadult4' size='12' value='$var4[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(4)'></td><td><input type='text' name='selladult4'  value='$var4[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td></tr>
                     <tr><td><select name='supplier5'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($var5[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc5' size='30' value='$var5[Description]'></td>
                     <td><input type=text name='quoadult5' size='12' value='$var5[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(5)'></td><td><input type='text' name='selladult5'  value='$var5[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td></tr>
                     <tr><td><select name='supplier6'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($var6[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc6' size='30' value='$var6[Description]'></td>
                     <td><input type=text name='quoadult6' size='12' value='$var6[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(6)'></td><td><input type='text' name='selladult6'  value='$var6[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td></tr>
                     <tr><td><select name='supplier7'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($var7[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc7' size='30' value='$var7[Description]'></td>
                     <td><input type=text name='quoadult7' size='12' value='$var7[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(7)'></td><td><input type='text' name='selladult7'  value='$var7[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td></tr>
                     <tr><td><select name='supplier8'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($var8[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc8' size='30' value='$var8[Description]'></td>
                     <td><input type=text name='quoadult8' size='12' value='$var8[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(8)'></td><td><input type='text' name='selladult8' value='$var8[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td></tr>
                     <tr><td><select name='supplier9'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($var9[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc9' size='30' value='$var9[Description]'></td>
                     <td><input type=text name='quoadult9' size='12' value='$var9[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(9)'></td><td><input type='text' name='selladult9'  value='$var9[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td></tr>
                     <tr><td><select name='supplier10'>
                    <option value='' selected>- Select Supplier -</option>";
                    $tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
                    while($s=mysql_fetch_array($tampil)){
                        if($var10[Supplier]==$s[SupplierName]){
                            echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
                        }else {
                            echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";    
                        }
                    }
               echo "</select></td><td><input type=text name='desc10' size='30' value='$var10[Description]'></td>
                     <td><input type=text name='quoadult10' size='12' value='$var10[QuoAdult]'onkeyup='isNumber(this);UpdateSellA(10)'></td><td><input type='text' name='selladult10' value='$var10[SellAdult]' size='12' onkeyup='isNumber(this);TotalA()'></td>
                     <tr><td colspan=3><b><i>TOTAL</td><td><input type='text' name='totalvaradult' value='$totvar[TotalVar]' size='12' style='text-align: left;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
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
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'VAR1' AND IDProduct = '$_POST[id]'");
  $Sup2=strtoupper($_POST[supplier2]);
  $Desc2=strtoupper($_POST[desc2]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup2',
                                        Description = '$Desc2',
                                        QuoAdult = '$_POST[quoadult2]',
                                        SellAdult = '$_POST[selladult2]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'VAR2' AND IDProduct = '$_POST[id]'");
  $Sup3=strtoupper($_POST[supplier3]);
  $Desc3=strtoupper($_POST[desc3]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup3',
                                        Description = '$Desc3',
                                        QuoAdult = '$_POST[quoadult3]',
                                        SellAdult = '$_POST[selladult3]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'VAR3' AND IDProduct = '$_POST[id]'");
  $Sup4=strtoupper($_POST[supplier4]);
  $Desc4=strtoupper($_POST[desc4]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup4',
                                        Description = '$Desc4',
                                        QuoAdult = '$_POST[quoadult4]',
                                        SellAdult = '$_POST[selladult4]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'VAR4' AND IDProduct = '$_POST[id]'");
  $Sup5=strtoupper($_POST[supplier5]);
  $Desc5=strtoupper($_POST[desc5]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup5',
                                        Description = '$Desc5',
                                        QuoAdult = '$_POST[quoadult5]',
                                        SellAdult = '$_POST[selladult5]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'VAR5' AND IDProduct = '$_POST[id]'");
  $Sup6=strtoupper($_POST[supplier6]);
  $Desc6=strtoupper($_POST[desc6]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup6',
                                        Description = '$Desc6',
                                        QuoAdult = '$_POST[quoadult6]',
                                        SellAdult = '$_POST[selladult6]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'VAR6' AND IDProduct = '$_POST[id]'");
   $Sup7=strtoupper($_POST[supplier7]);
  $Desc7=strtoupper($_POST[desc7]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup7',
                                        Description = '$Desc7',
                                        QuoAdult = '$_POST[quoadult7]',
                                        SellAdult = '$_POST[selladult7]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'VAR7' AND IDProduct = '$_POST[id]'");
  $Sup8=strtoupper($_POST[supplier8]);
  $Desc8=strtoupper($_POST[desc8]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup8',
                                        Description = '$Desc8',
                                        QuoAdult = '$_POST[quoadult8]',
                                        SellAdult = '$_POST[selladult8]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'VAR8' AND IDProduct = '$_POST[id]'");
  $Sup9=strtoupper($_POST[supplier9]);
  $Desc9=strtoupper($_POST[desc9]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup9',
                                        Description = '$Desc9',
                                        QuoAdult = '$_POST[quoadult9]',
                                        SellAdult = '$_POST[selladult9]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'VAR9' AND IDProduct = '$_POST[id]'");
  $Sup10=strtoupper($_POST[supplier10]);
  $Desc10=strtoupper($_POST[desc10]);
  mysql_query("UPDATE tour_detailreq set Supplier = '$Sup10',
                                        Description = '$Desc10',
                                        QuoAdult = '$_POST[quoadult10]',
                                        SellAdult = '$_POST[selladult10]',
                                        QuotationCurr = '$_POST[quotationcurr]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator]',
                                        SellingRate = '$_POST[sellingrate]'
                                        WHERE Detail = 'VAR10' AND IDProduct = '$_POST[id]'");
  mysql_query("UPDATE tour_msdetailreq set TotalVar = '$_POST[totalvaradult]'
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
