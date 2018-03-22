<link href="css/fixed_table_rc.css" type="text/css" rel="stylesheet" media="all" />
<script src="js/fixtablejquery.min.js" type="text/javascript"></script>
<script src="js/fixtablejquery-1.10.2.min.js" type="text/javascript"></script>
<script src="js/sortable_table.js" type="text/javascript"></script>
<script src="js/fixed_table_rc.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
function updatepage() {
    window.close();
    window.opener.location.reload();
}
function buka(NO) {
    var d = eval("variable.desc"+NO+ ";")
    var a = eval("variable.quoadult" + NO+ ";")
    var s = eval("variable.selladult" + NO+ ";")
    if (d.value.length == 0) {
        a.readOnly=true;a.value='0.00';
        s.readOnly=true;s.value='0.00';
        TotalA();
    } else {
        a.readOnly=false;
        s.readOnly=false;
    }
}
function isNumber(field) {
    var re = /^[-+]?[0-9]*\.?[0-9]+$/;
    if (!re.test(field.value)) {
        alert('VALUE MUST BE NUMBER !');
        field.value = field.value.replace(/[^0-9]/g,"");
    }
    if(field.value == ''){
        field.style.backgroundColor = "red"; }
    else {field.style.backgroundColor = "white";}
}
function itung() {
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
    UpdateSellA(11);
    UpdateSellA(12);
    UpdateSellA(13);
    UpdateSellA(14);
    UpdateSellA(15);
}
function TotalA() {
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
    var n11 = eval(variable.selladult11.value);
    var n12 = eval(variable.selladult12.value);
    var n13 = eval(variable.selladult13.value);
    var n14 = eval(variable.selladult14.value);
    var n15 = eval(variable.selladult15.value);
    t.value = (n1 + n2 + n3 + n4 + n5 + n6 + n7 + n8 + n9 + n10 + n11 + n12 + n13 + n14 + n15).toFixed(2) ;
    if (isNaN(t.value)) {
        t.value=0
    }
}
function UpdateSellA(NO) {
    var a = eval("variable.quoadult" + NO + ".value;")
    var b = eval("variable.sellingoperator" + NO + ".value;")
    var c = eval("variable.sellingrate" + NO + ".value;")
    var n = eval("variable.selladult" + NO + ";")
    if(a==0){n.value = (0).toFixed(2) ;}else{
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
function oncurr(NO) {
    var curr1 = eval("variable.quotationcurr" + NO + ".value;")
    var curr2 = variable.sellingcurr.value;
    if(variable.elements[curr1]){
        if(curr1=='IDR'){
            var rateidr = 1;
        }else{
            var rateidr = variable.elements[curr1].value;
        }
    }else{
        if(curr1=='IDR'){
            var rateidr = 1;
        }else{
            var rateidr = 0;
        }
    }
    var selrate = "sellingrate" + NO ;
    if(curr1=='IDR'){
        document.variable.elements[selrate].readOnly=true;
        document.variable.elements[selrate].value=rateidr;
        UpdateSellA(NO);
    }else{
        document.variable.elements[selrate].readOnly=true;
        document.variable.elements[selrate].value=rateidr;
        UpdateSellA(NO);
    }
    var r1 = eval(variable.sellingrate1.value);
    var r2 = eval(variable.sellingrate2.value);
    var r3 = eval(variable.sellingrate3.value);
    var r4 = eval(variable.sellingrate4.value);
    var r5 = eval(variable.sellingrate5.value);
    var r6 = eval(variable.sellingrate6.value);
    var r7 = eval(variable.sellingrate7.value);
    var r8 = eval(variable.sellingrate8.value);
    var r9 = eval(variable.sellingrate9.value);
    var r10 = eval(variable.sellingrate10.value);
    var r11 = eval(variable.sellingrate11.value);
    var r12 = eval(variable.sellingrate12.value);
    var r13 = eval(variable.sellingrate13.value);
    var r14 = eval(variable.sellingrate14.value);
    var r15 = eval(variable.sellingrate15.value);
    if(r1 == 0 || r2 == 0 || r3 == 0 || r4 == 0 || r5 == 0 || r6 == 0 || r7 == 0 || r8 == 0 || r9 == 0 || r10 == 0 || r11 == 0 || r12 == 0 || r13 == 0 || r14 == 0 || r15 == 0)
    {document.variable.elements['submit'].disabled=true; }
    else{document.variable.elements['submit'].disabled=false; }
}
$(function () {
        $('#fixed_hdr2').fxdHdrCol({
            fixedCols: 0,
            width: "100%",
            height: 400,
            colModal: [
                { width: 250, align: 'center' },
                { width: 320, align: 'center' },
                { width: 180, align: 'center' },
                { width: 80, align: 'center' },
                { width: 120, align: 'center' }
            ],
            sort: true
        });
    });
</script>

<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" />
<?php
include "../config/koneksi.php";
//include "../config/koneksisql.php";
include "../config/koneksimaster.php";
switch($_GET[act]){
    // Tampil Office
    default:
        $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
        $r=mysql_fetch_array($edit);
        $depdate = substr($r[DateTravelFrom],8,2);
        $pakerate=$r[DateTravelFrom];
        //cek banyak data
        $datavar=mysql_query("SELECT * FROM tour_detailfinal where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]'");
        $jumvar=mysql_num_rows($datavar);
        if($jumvar=='10'){
            for($i=11;$i<16;$i++){
                mysql_query("INSERT INTO tour_detailfinal(Detail,
                                   IDProduct,
                                   Category,
                                   QuotationCurr,
                                   SellingCurr,
                                   SellingOperator,
                                   SellingRate)
                            VALUES ('VAR$i',
                                   '$r[IDProduct]',
                                   'VARIABLE',
                                   '$r[QuotationCurr]',
                                   '$r[SellingCurr]',
                                   '$r[SellingOperator]',
                                   '$r[SellingRate]')");
            }
        }
        echo "<h2>VARIABLE COST - $r[TourCode]</h2>    
          <form method=POST name='variable' action='?module=variable&act=save'>
          <input type='hidden' name=id value='$r[IDProduct]'><input type='hidden' name='tourcode' value='$r[TourCode]'> 
          <input type='hidden' name='oldsellingoperator' value='$r[SellingOperator]'>
          <input type='hidden' name='oldsellingrate' value='$r[SellingRate]'>
          <input type='hidden' name='oldquotationcurr' value='$r[QuotationCurr]'>
          <input type='hidden' name='sellingcurr' value='$r[SellingCurr]'>";
        /*$carirate=mssql_query("SELECT * FROM Currency_Details
                                        where StartDate <= '$pakerate' and EndDate >= '$pakerate' order by IDDetail DESC");*/
        $cariperiod=mssql_query("SELECT TOP 1 * FROM AgingKurs
                                        where StartDate <= '$pakerate' and EndDate >= '$pakerate' order by AgingKurs.IDHeader DESC");
        $periodrate=mssql_fetch_array($cariperiod);
        $carirate=mssql_query("SELECT * FROM AgingKursDetails
                                        where IDHeader = '$periodrate[IDHeader]'");
        while($rateidr=mssql_fetch_array($carirate)){echo"<input type='hidden' name='$rateidr[Currency]' value='$rateidr[ExRate]'>";}
        $isivar1=mysql_query("SELECT * FROM tour_detailfinal
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR1' ");
        $var1=mysql_fetch_array($isivar1);
        $isivar2=mysql_query("SELECT * FROM tour_detailfinal
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR2' ");
        $var2=mysql_fetch_array($isivar2);
        $isivar3=mysql_query("SELECT * FROM tour_detailfinal
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR3' ");
        $var3=mysql_fetch_array($isivar3);
        $isivar4=mysql_query("SELECT * FROM tour_detailfinal
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR4' ");
        $var4=mysql_fetch_array($isivar4);
        $isivar5=mysql_query("SELECT * FROM tour_detailfinal
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR5' ");
        $var5=mysql_fetch_array($isivar5);
        $isivar6=mysql_query("SELECT * FROM tour_detailfinal
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR6' ");
        $var6=mysql_fetch_array($isivar6);
        $isivar7=mysql_query("SELECT * FROM tour_detailfinal
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR7' ");
        $var7=mysql_fetch_array($isivar7);
        $isivar8=mysql_query("SELECT * FROM tour_detailfinal
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR8' ");
        $var8=mysql_fetch_array($isivar8);
        $isivar9=mysql_query("SELECT * FROM tour_detailfinal
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR9' ");
        $var9=mysql_fetch_array($isivar9);
        $isivar10=mysql_query("SELECT * FROM tour_detailfinal
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR10' ");
        $var10=mysql_fetch_array($isivar10);
        $isivar11=mysql_query("SELECT * FROM tour_detailfinal
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR11' ");
        $var11=mysql_fetch_array($isivar11);
        $isivar12=mysql_query("SELECT * FROM tour_detailfinal
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR12' ");
        $var12=mysql_fetch_array($isivar12);
        $isivar13=mysql_query("SELECT * FROM tour_detailfinal
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR13' ");
        $var13=mysql_fetch_array($isivar13);
        $isivar14=mysql_query("SELECT * FROM tour_detailfinal
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR14' ");
        $var14=mysql_fetch_array($isivar14);
        $isivar15=mysql_query("SELECT * FROM tour_detailfinal
                                where Category = 'VARIABLE' and IDProduct = '$r[IDProduct]' and Detail = 'VAR15' ");
        $var15=mysql_fetch_array($isivar15);
        $isitotal=mysql_query("SELECT * FROM tour_msdetailfinal
                                where IDProduct = '$r[IDProduct]' ");
        $totvar=mysql_fetch_array($isitotal);
        if($totvar[TotalVar] > 0){$tampil1='enable';}else{$tampil1='disabled';}
        echo "<table class='bordered' id='fixed_hdr2'>
        <thead><th></th><th></th><th></th><th colspan='2'></th></thead>
                    <tr><th>supplier</th><th>description</th><th>quotation</th><th colspan=2>adult</th></tr>
                    <tr><th></th><th></th><th>Curr - Operator - Rate</th><th></th><th>In $r[SellingCurr]</th>
                    <tbody>
                    <tr><td><select name='supplier1'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($var1[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc1' size='45' value='$var1[Description]' onkeyup='buka(1)'></td>
                     <td><select name='quotationcurr1' onchange='oncurr(1)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$var1[QuotationCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator1' size='3' value='$var1[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate1' size='10' value='$var1[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult1' size='12' value='$var1[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(1)' ";if($var1[Description]==''){echo"readonly";}echo"></td>
                     <td><input type='text' name='selladult1' value='$var1[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td></tr>
                     <tr><td><select name='supplier2'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($var2[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc2' size='45' value='$var2[Description]' onkeyup='buka(2)'></td>
                     <td><select name='quotationcurr2' onchange='oncurr(2)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$var2[QuotationCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator2' size='3' value='$var2[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate2' size='10' value='$var2[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult2' size='12' value='$var2[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(2)' ";if($var2[Description]==''){echo"readonly";}echo"></td>
                     <td><input type='text' name='selladult2' value='$var2[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td></tr>
                     <tr><td><select name='supplier3'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($var3[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc3' size='45' value='$var3[Description]' onkeyup='buka(3)'></td>
                     <td><select name='quotationcurr3' onchange='oncurr(3)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$var3[QuotationCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator3' size='3' value='$var3[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate3' size='10' value='$var3[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult3' size='12' value='$var3[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(3)' ";if($var3[Description]==''){echo"readonly";}echo"></td>
                     <td><input type='text' name='selladult3' value='$var3[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td></tr>
                     <tr><td><select name='supplier4'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($var4[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc4' size='45' value='$var4[Description]' onkeyup='buka(4)'></td>
                     <td><select name='quotationcurr4' onchange='oncurr(4)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$var4[QuotationCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator4' size='3' value='$var4[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate4' size='10' value='$var4[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult4' size='12' value='$var4[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(4)' ";if($var4[Description]==''){echo"readonly";}echo"></td>
                     <td><input type='text' name='selladult4'  value='$var4[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td></tr>
                     <tr><td><select name='supplier5'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($var5[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc5' size='45' value='$var5[Description]' onkeyup='buka(5)'></td>
                     <td><select name='quotationcurr5' onchange='oncurr(5)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$var5[QuotationCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator5' size='3' value='$var5[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate5' size='10' value='$var5[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult5' size='12' value='$var5[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(5)' ";if($var5[Description]==''){echo"readonly";}echo"></td>
                     <td><input type='text' name='selladult5'  value='$var5[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td></tr>
                     <tr><td><select name='supplier6'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($var6[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc6' size='45' value='$var6[Description]' onkeyup='buka(6)'></td>
                     <td><select name='quotationcurr6' onchange='oncurr(6)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$var6[QuotationCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator6' size='3' value='$var6[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate6' size='10' value='$var6[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult6' size='12' value='$var6[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(6)' ";if($var6[Description]==''){echo"readonly";}echo"></td>
                     <td><input type='text' name='selladult6'  value='$var6[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td></tr>
                     <tr><td><select name='supplier7'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($var7[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc7' size='45' value='$var7[Description]' onkeyup='buka(7)'></td>
                     <td><select name='quotationcurr7' onchange='oncurr(7)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$var7[QuotationCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator7' size='3' value='$var7[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate7' size='10' value='$var7[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult7' size='12' value='$var7[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(7)' ";if($var7[Description]==''){echo"readonly";}echo"></td>
                     <td><input type='text' name='selladult7'  value='$var7[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td></tr>
                     <tr><td><select name='supplier8'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($var8[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc8' size='45' value='$var8[Description]' onkeyup='buka(8)'></td>
                     <td><select name='quotationcurr8' onchange='oncurr(8)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$var8[QuotationCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator8' size='3' value='$var8[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate8' size='10' value='$var8[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult8' size='12' value='$var8[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(8)' ";if($var8[Description]==''){echo"readonly";}echo"></td>
                     <td><input type='text' name='selladult8' value='$var8[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td></tr>
                     <tr><td><select name='supplier9'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($var9[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc9' size='45' value='$var9[Description]' onkeyup='buka(9)'></td>
                     <td><select name='quotationcurr9' onchange='oncurr(9)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$var9[QuotationCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator9' size='3' value='$var9[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate9' size='10' value='$var9[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult9' size='12' value='$var9[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(9)' ";if($var9[Description]==''){echo"readonly";}echo"></td>
                     <td><input type='text' name='selladult9'  value='$var9[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td></tr>
                     <tr><td><select name='supplier10'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($var10[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc10' size='45' value='$var10[Description]' onkeyup='buka(10)'></td>
                     <td><select name='quotationcurr10' onchange='oncurr(10)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$var10[QuotationCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator10' size='3' value='$var10[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate10' size='10' value='$var10[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult10' size='12' value='$var10[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(10)' ";if($var10[Description]==''){echo"readonly";}echo"></td>
                     <td><input type='text' name='selladult10' value='$var10[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <tr><td><select name='supplier11'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($var11[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc11' size='45' value='$var11[Description]' onkeyup='buka(11)'></td>
                                     <td><select name='quotationcurr11' onchange='oncurr(11)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$var11[QuotationCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator11' size='3' value='$var11[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate11' size='10' value='$var11[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult11' size='12' value='$var11[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(11)' ";if($var11[Description]==''){echo"readonly";}echo"></td>
                     <td><input type='text' name='selladult11' value='$var11[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <tr><td><select name='supplier12'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($var12[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc12' size='45' value='$var12[Description]' onkeyup='buka(12)'></td>
                                     <td><select name='quotationcurr12' onchange='oncurr(12)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$var12[QuotationCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator12' size='3' value='$var12[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate12' size='10' value='$var12[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult12' size='12' value='$var12[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(12)' ";if($var12[Description]==''){echo"readonly";}echo"></td>
                     <td><input type='text' name='selladult12' value='$var12[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <tr><td><select name='supplier13'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($var13[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc13' size='45' value='$var13[Description]' onkeyup='buka(13)'></td>
                                     <td><select name='quotationcurr13' onchange='oncurr(13)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$var13[QuotationCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator13' size='3' value='$var13[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate13' size='10' value='$var13[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult13' size='12' value='$var13[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(13)' ";if($var13[Description]==''){echo"readonly";}echo"></td>
                     <td><input type='text' name='selladult13' value='$var13[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <tr><td><select name='supplier14'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($var14[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc14' size='45' value='$var14[Description]' onkeyup='buka(14)'></td>
                                     <td><select name='quotationcurr14' onchange='oncurr(14)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$var14[QuotationCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator14' size='3' value='$var14[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate14' size='10' value='$var14[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult14' size='12' value='$var14[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(14)' ";if($var14[Description]==''){echo"readonly";}echo"></td>
                     <td><input type='text' name='selladult14' value='$var14[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <tr><td><select name='supplier15'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($var15[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc15' size='45' value='$var15[Description]' onkeyup='buka(15)'></td>
                                     <td><select name='quotationcurr15' onchange='oncurr(15)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$var15[QuotationCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator15' size='3' value='$var15[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate15' size='10' value='$var15[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult15' size='12' value='$var15[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(15)' ";if($var15[Description]==''){echo"readonly";}echo"></td>
                     <td><input type='text' name='selladult15' value='$var15[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <tr><td colspan=4><b><i>TOTAL</td><td><input type='text' name='totalvaradult' value='$totvar[TotalVar]' size='12' style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
                    <tbody>
                    </table>
          
          <center><input type='submit' name='submit' value='Save'>
          </form>";
        break;

    case "save":

        $pax=$_POST[pax];
        $Description="Update Fix Cost ($_POST[tourcode])";
        $Sup1=strtoupper($_POST[supplier1]);
        $Desc1=strtoupper($_POST[desc1]);
        mysql_query("UPDATE tour_detailfinal set Supplier = '$Sup1',
                                        Description = '$Desc1', 
                                        QuoAdult = '$_POST[quoadult1]',
                                        SellAdult = '$_POST[selladult1]',
                                        QuotationCurr = '$_POST[quotationcurr1]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator1]',
                                        SellingRate = '$_POST[sellingrate1]'
                                        WHERE Detail = 'VAR1' AND IDProduct = '$_POST[id]'");
        $Sup2=strtoupper($_POST[supplier2]);
        $Desc2=strtoupper($_POST[desc2]);
        mysql_query("UPDATE tour_detailfinal set Supplier = '$Sup2',
                                        Description = '$Desc2',
                                        QuoAdult = '$_POST[quoadult2]',
                                        SellAdult = '$_POST[selladult2]',
                                        QuotationCurr = '$_POST[quotationcurr2]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator2]',
                                        SellingRate = '$_POST[sellingrate2]'
                                        WHERE Detail = 'VAR2' AND IDProduct = '$_POST[id]'");
        $Sup3=strtoupper($_POST[supplier3]);
        $Desc3=strtoupper($_POST[desc3]);
        mysql_query("UPDATE tour_detailfinal set Supplier = '$Sup3',
                                        Description = '$Desc3',
                                        QuoAdult = '$_POST[quoadult3]',
                                        SellAdult = '$_POST[selladult3]',
                                        QuotationCurr = '$_POST[quotationcurr3]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator3]',
                                        SellingRate = '$_POST[sellingrate3]'
                                        WHERE Detail = 'VAR3' AND IDProduct = '$_POST[id]'");
        $Sup4=strtoupper($_POST[supplier4]);
        $Desc4=strtoupper($_POST[desc4]);
        mysql_query("UPDATE tour_detailfinal set Supplier = '$Sup4',
                                        Description = '$Desc4',
                                        QuoAdult = '$_POST[quoadult4]',
                                        SellAdult = '$_POST[selladult4]',
                                        QuotationCurr = '$_POST[quotationcurr4]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator4]',
                                        SellingRate = '$_POST[sellingrate4]'
                                        WHERE Detail = 'VAR4' AND IDProduct = '$_POST[id]'");
        $Sup5=strtoupper($_POST[supplier5]);
        $Desc5=strtoupper($_POST[desc5]);
        mysql_query("UPDATE tour_detailfinal set Supplier = '$Sup5',
                                        Description = '$Desc5',
                                        QuoAdult = '$_POST[quoadult5]',
                                        SellAdult = '$_POST[selladult5]',
                                        QuotationCurr = '$_POST[quotationcurr5]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator5]',
                                        SellingRate = '$_POST[sellingrate5]'
                                        WHERE Detail = 'VAR5' AND IDProduct = '$_POST[id]'");
        $Sup6=strtoupper($_POST[supplier6]);
        $Desc6=strtoupper($_POST[desc6]);
        mysql_query("UPDATE tour_detailfinal set Supplier = '$Sup6',
                                        Description = '$Desc6',
                                        QuoAdult = '$_POST[quoadult6]',
                                        SellAdult = '$_POST[selladult6]',
                                        QuotationCurr = '$_POST[quotationcurr6]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator6]',
                                        SellingRate = '$_POST[sellingrate6]'
                                        WHERE Detail = 'VAR6' AND IDProduct = '$_POST[id]'");
        $Sup7=strtoupper($_POST[supplier7]);
        $Desc7=strtoupper($_POST[desc7]);
        mysql_query("UPDATE tour_detailfinal set Supplier = '$Sup7',
                                        Description = '$Desc7',
                                        QuoAdult = '$_POST[quoadult7]',
                                        SellAdult = '$_POST[selladult7]',
                                        QuotationCurr = '$_POST[quotationcurr7]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator7]',
                                        SellingRate = '$_POST[sellingrate7]'
                                        WHERE Detail = 'VAR7' AND IDProduct = '$_POST[id]'");
        $Sup8=strtoupper($_POST[supplier8]);
        $Desc8=strtoupper($_POST[desc8]);
        mysql_query("UPDATE tour_detailfinal set Supplier = '$Sup8',
                                        Description = '$Desc8',
                                        QuoAdult = '$_POST[quoadult8]',
                                        SellAdult = '$_POST[selladult8]',
                                        QuotationCurr = '$_POST[quotationcurr8]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator8]',
                                        SellingRate = '$_POST[sellingrate8]'
                                        WHERE Detail = 'VAR8' AND IDProduct = '$_POST[id]'");
        $Sup9=strtoupper($_POST[supplier9]);
        $Desc9=strtoupper($_POST[desc9]);
        mysql_query("UPDATE tour_detailfinal set Supplier = '$Sup9',
                                        Description = '$Desc9',
                                        QuoAdult = '$_POST[quoadult9]',
                                        SellAdult = '$_POST[selladult9]',
                                        QuotationCurr = '$_POST[quotationcurr9]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator9]',
                                        SellingRate = '$_POST[sellingrate9]'
                                        WHERE Detail = 'VAR9' AND IDProduct = '$_POST[id]'");
        $Sup10=strtoupper($_POST[supplier10]);
        $Desc10=strtoupper($_POST[desc10]);
        mysql_query("UPDATE tour_detailfinal set Supplier = '$Sup10',
                                        Description = '$Desc10',
                                        QuoAdult = '$_POST[quoadult10]',
                                        SellAdult = '$_POST[selladult10]',
                                        QuotationCurr = '$_POST[quotationcurr10]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator10]',
                                        SellingRate = '$_POST[sellingrate10]'
                                        WHERE Detail = 'VAR10' AND IDProduct = '$_POST[id]'");
        $Sup11=strtoupper($_POST[supplier11]);
        $Desc11=strtoupper($_POST[desc11]);
        mysql_query("UPDATE tour_detailfinal set Supplier = '$Sup11',
                                        Description = '$Desc11',
                                        QuoAdult = '$_POST[quoadult11]',
                                        SellAdult = '$_POST[selladult11]',
                                        QuotationCurr = '$_POST[quotationcurr11]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator11]',
                                        SellingRate = '$_POST[sellingrate11]'
                                        WHERE Detail = 'VAR11' AND IDProduct = '$_POST[id]'");
        $Sup12=strtoupper($_POST[supplier12]);
        $Desc12=strtoupper($_POST[desc12]);
        mysql_query("UPDATE tour_detailfinal set Supplier = '$Sup12',
                                        Description = '$Desc12',
                                        QuoAdult = '$_POST[quoadult12]',
                                        SellAdult = '$_POST[selladult12]',
                                        QuotationCurr = '$_POST[quotationcurr12]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator12]',
                                        SellingRate = '$_POST[sellingrate12]'
                                        WHERE Detail = 'VAR12' AND IDProduct = '$_POST[id]'");
        $Sup13=strtoupper($_POST[supplier13]);
        $Desc13=strtoupper($_POST[desc13]);
        mysql_query("UPDATE tour_detailfinal set Supplier = '$Sup13',
                                        Description = '$Desc13',
                                        QuoAdult = '$_POST[quoadult13]',
                                        SellAdult = '$_POST[selladult13]',
                                        QuotationCurr = '$_POST[quotationcurr13]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator13]',
                                        SellingRate = '$_POST[sellingrate13]'
                                        WHERE Detail = 'VAR13' AND IDProduct = '$_POST[id]'");
        $Sup14=strtoupper($_POST[supplier14]);
        $Desc14=strtoupper($_POST[desc14]);
        mysql_query("UPDATE tour_detailfinal set Supplier = '$Sup14',
                                        Description = '$Desc14',
                                        QuoAdult = '$_POST[quoadult14]',
                                        SellAdult = '$_POST[selladult14]',
                                        QuotationCurr = '$_POST[quotationcurr14]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator14]',
                                        SellingRate = '$_POST[sellingrate14]'
                                        WHERE Detail = 'VAR14' AND IDProduct = '$_POST[id]'");
        $Sup15=strtoupper($_POST[supplier15]);
        $Desc15=strtoupper($_POST[desc15]);
        mysql_query("UPDATE tour_detailfinal set Supplier = '$Sup15',
                                        Description = '$Desc15',
                                        QuoAdult = '$_POST[quoadult15]',
                                        SellAdult = '$_POST[selladult15]',
                                        QuotationCurr = '$_POST[quotationcurr15]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator15]',
                                        SellingRate = '$_POST[sellingrate15]'
                                        WHERE Detail = 'VAR15' AND IDProduct = '$_POST[id]'");
        mysql_query("UPDATE tour_msdetailfinal set TotalVar = '$_POST[totalvaradult]'
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
