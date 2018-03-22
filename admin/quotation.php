<script language="javascript" type="text/javascript">
function updatepage(){
        window.close();
        window.opener.location.reload();
    }
function buka(NO) {
    var d = eval("calculate.desc"+NO+ ";")
    var a = eval("calculate.quoadult" + NO+ ";")
    var s = eval("calculate.selladult" + NO+ ";")
    var ac = eval("calculate.quochd" + NO+ ";")
    var sc = eval("calculate.sellchd" + NO+ ";")
    if (d.value.length == 0) {
        a.readOnly=true;a.value='0.00';
        s.readOnly=true;s.value='0.00';
        ac.readOnly=true;ac.value='0.00';
        sc.readOnly=true;sc.value='0.00';
        TotalA();TotalC();
    } else {
        a.readOnly=false;
        s.readOnly=false;
        ac.readOnly=false;
        sc.readOnly=false;
    }
}
function isNumber(field) {
    //var re = /^[0-9'.']*$/;
    var re = /^[-+]?[0-9]*\.?[0-9]+$/;
    if (!re.test(field.value)) {
        alert('VALUE MUST BE NUMBER !');
        field.value = field.value.replace(/[^0-9'.']/g, "");
    }
    if (field.value == '') {
        field.style.backgroundColor = "red";
    }
    else {
        field.style.backgroundColor = "white";
    }
}
function itung(){
    /*UpdateSellA(1); UpdateSellC(1);
    UpdateSellA(2); UpdateSellC(2);
    UpdateSellA(3); UpdateSellC(3);
    UpdateSellA(4); UpdateSellC(4);
    UpdateSellA(5); UpdateSellC(5);
    UpdateSellA(6); UpdateSellC(6);
    UpdateSellA(7); UpdateSellC(7);
    UpdateSellA(8); UpdateSellC(8);
    UpdateSellA(9); UpdateSellC(9);
    UpdateSellA(10); UpdateSellC(10);*/
    oncurr(1);
    oncurr(2);
    oncurr(3);
    oncurr(4);
    oncurr(5);
    oncurr(6);
    oncurr(7);
    oncurr(8);
    oncurr(9);
    oncurr(10);
    oncurr(11);
    oncurr(12);
    oncurr(13);
    oncurr(14);
    oncurr(15);
 }
function TotalA(){
    var t = calculate.totalfixadult;
    var tc = calculate.totalfixchd;
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
    var n11 = eval(calculate.selladult11.value);
    var n12 = eval(calculate.selladult12.value);
    var n13 = eval(calculate.selladult13.value);
    var n14 = eval(calculate.selladult14.value);
    var n15 = eval(calculate.selladult15.value);
    t.value = (n1 + n2 + n3 + n4 + n5 + n6 + n7 + n8 + n9 + n10 + n11 + n12 + n13 + n14 + n15).toFixed(2) ;
    if (isNaN(t.value)) {
      t.value=0   
    }
    /*if(t.value != 0 || tc.value != 0 ){document.calculate.elements['submit'].disabled=false; }
    else{document.calculate.elements['submit'].disabled=true; }*/
 }
function UpdateSellA(NO) {
    var a = eval("calculate.quoadult" + NO + ".value;")  
    var b = eval("calculate.sellingoperator" + NO + ".value;")
     var c = eval("calculate.sellingrate" + NO + ".value;")
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
    var ta = calculate.totalfixadult;
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
    var n11 = eval(calculate.sellchd11.value);
    var n12 = eval(calculate.sellchd12.value);
    var n13 = eval(calculate.sellchd13.value);
    var n14 = eval(calculate.sellchd14.value);
    var n15 = eval(calculate.sellchd15.value);
    t.value = (n1 + n2 + n3 + n4 + n5 + n6 + n7 + n8 + n9 + n10 + n11 + n12 + n13 + n14 + n15).toFixed(2) ;
    if (isNaN(t.value)) {
      t.value=0   
    }

 }
function UpdateSellC(NO) {
    var a = eval("calculate.quochd" + NO + ".value;")  
    var b = eval("calculate.sellingoperator" + NO + ".value;")
    var c =eval("calculate.sellingrate" + NO + ".value;")
    var n = eval("calculate.sellchd" + NO + ";")  
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
    TotalC();
}
function oncurr(NO)
{
    var curr1 = eval("calculate.quotationcurr" + NO + ".value;")
    var curr2 = calculate.sellingcurr.value;
    if(calculate.elements[curr1]){
        if(curr1=='IDR'){
            var rateidr = 1;
        }else{
            var rateidr = calculate.elements[curr1].value;
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
        document.calculate.elements[selrate].readOnly=true;
        document.calculate.elements[selrate].value=rateidr;
        UpdateSellA(NO);UpdateSellC(NO);
    }else{
        document.calculate.elements[selrate].readOnly=true;
        document.calculate.elements[selrate].value=rateidr;
        UpdateSellA(NO);UpdateSellC(NO);
    }
    var r1 = eval(calculate.sellingrate1.value);
    var r2 = eval(calculate.sellingrate2.value);
    var r3 = eval(calculate.sellingrate3.value);
    var r4 = eval(calculate.sellingrate4.value);
    var r5 = eval(calculate.sellingrate5.value);
    var r6 = eval(calculate.sellingrate6.value);
    var r7 = eval(calculate.sellingrate7.value);
    var r8 = eval(calculate.sellingrate8.value);
    var r9 = eval(calculate.sellingrate9.value);
    var r10 = eval(calculate.sellingrate10.value);
    var r11 = eval(calculate.sellingrate11.value);
    var r12 = eval(calculate.sellingrate12.value);
    var r13 = eval(calculate.sellingrate13.value);
    var r14 = eval(calculate.sellingrate14.value);
    var r15 = eval(calculate.sellingrate15.value);
    if(r1 == 0 || r2 == 0 || r3 == 0 || r4 == 0 || r5 == 0 || r6 == 0 || r7 == 0 || r8 == 0 || r9 == 0 || r10 == 0 || r11 == 0 || r12 == 0 || r13 == 0 || r14 == 0 || r15 == 0 )
    {document.calculate.elements['submit'].disabled=true; }
    else{document.calculate.elements['submit'].disabled=false; }

}
</script>

<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" /> 
<?php
session_start();
include "../config/koneksi.php";
include "../config/koneksimaster.php";

switch($_GET[act]) {
    // Tampil Office
    default:
        //$r[DateTravelFrom]
        $edit = mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
        $r = mysql_fetch_array($edit);
        $depdate = substr($r[DateTravelFrom], 8, 2);
        $pakerate = $r[DateTravelFrom];
        //cek banyak data
        $datafix = mysql_query("SELECT * FROM tour_detail where Category = 'FIX' and IDProduct = '$r[IDProduct]'");
        $jumfix = mysql_num_rows($datafix);
        if ($jumfix == '10') {
            for ($i = 11; $i < 16; $i++) { 
                mysql_query("INSERT INTO tour_detail(Detail,
                                   IDProduct,
                                   Category,
                                   QuotationCurr,
                                   SellingCurr,
                                   SellingOperator,
                                   SellingRate)
                            VALUES ('FIX$i',
                                   '$r[IDProduct]',
                                   'FIX',
                                   '$r[QuotationCurr]',
                                   '$r[SellingCurr]',
                                   '$r[SellingOperator]',
                                   '$r[SellingRate]')");
            }
        }
        echo "<h2>FIX COST - $r[TourCode]</h2>
          <form method=POST name='calculate' action='?module=quotation&act=save'>
          <input type='hidden' name=id value='$r[IDProduct]'><input type='hidden' name='tourcode' value='$r[TourCode]'> 
          <input type='hidden' name='oldsellingoperator' value='$r[SellingOperator]'>
          <input type='hidden' name='oldsellingrate' value='$r[SellingRate]'>
          <input type='hidden' name='oldquotationcurr' value='$r[QuotationCurr]'>
          <input type='hidden' name='sellingcurr' value='$r[SellingCurr]'>";
        $cariperiod = mssql_query("SELECT TOP 1 * FROM AgingKurs
                                where StartDate <= '$pakerate' and EndDate >= '$pakerate' order by AgingKurs.IDHeader DESC");
        $periodrate = mssql_fetch_array($cariperiod);
        $carirate = mssql_query("SELECT * FROM AgingKursDetails
                                where IDHeader = '$periodrate[IDHeader]'");
        while ($rateidr = mssql_fetch_array($carirate)) {
            echo "<input type='hidden' name='$rateidr[Currency]' value='$rateidr[ExRate]'>";
        }
        $isifix1 = mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX1' ");
        $fix1 = mysql_fetch_array($isifix1);
        $isifix2 = mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX2' ");
        $fix2 = mysql_fetch_array($isifix2);
        $isifix3 = mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX3' ");
        $fix3 = mysql_fetch_array($isifix3);
        $isifix4 = mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX4' ");
        $fix4 = mysql_fetch_array($isifix4);
        $isifix5 = mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX5' ");
        $fix5 = mysql_fetch_array($isifix5);
        $isifix6 = mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX6' ");
        $fix6 = mysql_fetch_array($isifix6);
        $isifix7 = mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX7' ");
        $fix7 = mysql_fetch_array($isifix7);
        $isifix8 = mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX8' ");
        $fix8 = mysql_fetch_array($isifix8);
        $isifix9 = mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX9' ");
        $fix9 = mysql_fetch_array($isifix9);
        $isifix10 = mysql_query("SELECT * FROM tour_detail
                                where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX10' ");
        $fix10 = mysql_fetch_array($isifix10);
        $isifix11 = mysql_query("SELECT * FROM tour_detail
                                        where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX11' ");
        $fix11 = mysql_fetch_array($isifix11);
        $isifix12 = mysql_query("SELECT * FROM tour_detail
                                        where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX12' ");
        $fix12 = mysql_fetch_array($isifix12);
        $isifix13 = mysql_query("SELECT * FROM tour_detail
                                        where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX13' ");
        $fix13 = mysql_fetch_array($isifix13);
        $isifix14 = mysql_query("SELECT * FROM tour_detail
                                        where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX14' ");
        $fix14 = mysql_fetch_array($isifix14);
        $isifix15 = mysql_query("SELECT * FROM tour_detail
                                        where Category = 'FIX' and IDProduct = '$r[IDProduct]' and Detail = 'FIX15' ");
        $fix15 = mysql_fetch_array($isifix15);
        $isitotal = mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct = '$r[IDProduct]' ");
        $totfix = mysql_fetch_array($isitotal);
        if ($totfix[TotalFixAdult] > 0 OR $totfix[TotalFixChd] > 0) {
            $tampil1 = 'enable';
        } else {
            $tampil1 = 'disabled';
        }
        echo "<table class='bordered'>
                    <tr><th>supplier</th><th>description</th><th>quotation</th><th colspan=2>adult</th><th colspan=2>Child </th></tr>
                    <tr><th></th><th></th><th>Curr - Operator - Rate</th><th></th><th>In $r[SellingCurr]</th><th></th><th>In $r[SellingCurr]</th>

                     <tr><td><select name='supplier1'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        //$tampil=mysql_query("SELECT * FROM tour_mssupplier ORDER BY SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix1[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc1' size='45' value='$fix1[Description]' onkeyup='buka(1)'></td>
                     <td>
                     <select name='quotationcurr1' onchange='oncurr(1)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group by Currency ORDER BY Currency ASC");
        while ($s = mssql_fetch_array($tampil)) {
            if ($s[Currency] == $fix1[QuotationCurr]) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select>";
        /*<select name='sellingoperator1' onchange='UpdateSellA(1)'>
                   <option value='*' ";if($fix1[SellingOperator]=='*'){echo"selected";}echo"> X </option>
                   <option value='/' ";if($fix1[SellingOperator]=='/'){echo"selected";}echo"> : </option></select>*/
        echo "<input type='hidden' name='sellingoperator1' size='3' value='$fix1[SellingOperator]' > x
                     <input type='text' style='border: hidden;' name='sellingrate1' size='10' value='$fix1[SellingRate]' readonly>
                     </td><td>
                     <input type=text name='quoadult1' size='12' value='$fix1[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(1)' ";
        if ($fix1[Description] == '') {
            echo "readonly";
        }
        echo ">
                     </td><td><input type='text' name='selladult1' value='$fix1[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <td><input type=text name='quochd1' size='12' value='$fix1[QuoChd]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(1)' ";
        if ($fix1[Description] == '') {
            echo "readonly";
        }
        echo "></td>
                     <td><input type='text' name='sellchd1' value='$fix1[SellChd]' style='text-align:right;border: hidden;' size='12'onkeyup='isNumber(this);TotalC()' readonly></td></tr>

                     <tr><td><select name='supplier2'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix2[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc2' size='45' value='$fix2[Description]' onkeyup='buka(2)'></td>
                                     <td>
                    <select name='quotationcurr2' onchange='oncurr(2)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group by Currency ORDER BY Currency ASC");
        while ($s = mssql_fetch_array($tampil)) {
            if ($s[Currency] == $fix2[QuotationCurr]) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator2' size='3' value='$fix2[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate2' size='4' value='$fix2[SellingRate]' readonly>
                     </td><td>
                     <input type=text name='quoadult2' size='12' value='$fix2[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(2)' ";
        if ($fix2[Description] == '') {
            echo "readonly";
        }
        echo ">
                     </td><td><input type='text' name='selladult2' value='$fix2[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <td><input type=text name='quochd2' size='12' value='$fix2[QuoChd]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(2)' ";
        if ($fix2[Description] == '') {
            echo "readonly";
        }
        echo "></td>
                     <td><input type='text' name='sellchd2' value='$fix2[SellChd]' style='text-align:right;border: hidden;' size='12'onkeyup='isNumber(this);TotalC()' readonly></td></tr>

                     <tr><td><select name='supplier3'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix3[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc3' size='45' value='$fix3[Description]' onkeyup='buka(3)'></td>
                                     <td>
                    <select name='quotationcurr3' onchange='oncurr(3)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group by Currency ORDER BY Currency ASC");
        while ($s = mssql_fetch_array($tampil)) {
            if ($s[Currency] == $fix3[QuotationCurr]) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator3' size='3' value='$fix3[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate3' size='3' value='$fix3[SellingRate]' readonly>
                     </td><td>
                     <input type=text name='quoadult3' size='12' value='$fix3[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(3)' ";
        if ($fix3[Description] == '') {
            echo "readonly";
        }
        echo ">
                     </td><td><input type='text' name='selladult3' value='$fix3[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <td><input type=text name='quochd3' size='12' value='$fix3[QuoChd]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(3)' ";
        if ($fix3[Description] == '') {
            echo "readonly";
        }
        echo "></td>
                     <td><input type='text' name='sellchd3' value='$fix3[SellChd]' style='text-align:right;border: hidden;' size='12'onkeyup='isNumber(this);TotalC()' readonly></td></tr>

                     <tr><td><select name='supplier4'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix4[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc4' size='45' value='$fix4[Description]' onkeyup='buka(4)'></td>
                                     <td>
                    <select name='quotationcurr4' onchange='oncurr(4)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group by Currency ORDER BY Currency ASC");
        while ($s = mssql_fetch_array($tampil)) {
            if ($s[Currency] == $fix4[QuotationCurr]) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator4' size='3' value='$fix4[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate4' size='4' value='$fix4[SellingRate]' readonly>
                     </td><td>
                     <input type=text name='quoadult4' size='12' value='$fix4[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(4)' ";
        if ($fix4[Description] == '') {
            echo "readonly";
        }
        echo ">
                     </td><td><input type='text' name='selladult4' value='$fix4[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <td><input type=text name='quochd4' size='12' value='$fix4[QuoChd]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(4)' ";
        if ($fix4[Description] == '') {
            echo "readonly";
        }
        echo "></td>
                     <td><input type='text' name='sellchd4' value='$fix4[SellChd]' style='text-align:right;border: hidden;' size='12'onkeyup='isNumber(this);TotalC()' readonly></td></tr>

                     <tr><td><select name='supplier5'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix5[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc5' size='45' value='$fix5[Description]' onkeyup='buka(5)'></td>
                                     <td>
                    <select name='quotationcurr5' onchange='oncurr(5)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group by Currency ORDER BY Currency ASC");
        while ($s = mssql_fetch_array($tampil)) {
            if ($s[Currency] == $fix5[QuotationCurr]) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator5' size='3' value='$fix5[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate5' size='4' value='$fix5[SellingRate]' readonly>
                     </td><td>
                     <input type=text name='quoadult5' size='12' value='$fix5[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(5)' ";
        if ($fix5[Description] == '') {
            echo "readonly";
        }
        echo ">
                     </td><td><input type='text' name='selladult5' value='$fix5[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <td><input type=text name='quochd5' size='12' value='$fix5[QuoChd]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(5)' ";
        if ($fix5[Description] == '') {
            echo "readonly";
        }
        echo "></td>
                     <td><input type='text' name='sellchd5' value='$fix5[SellChd]' style='text-align:right;border: hidden;' size='12'onkeyup='isNumber(this);TotalC()' readonly></td></tr>

                     <tr><td><select name='supplier6'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix6[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc6' size='45' value='$fix6[Description]' onkeyup='buka(6)'></td>
                                     <td>
                    <select name='quotationcurr6' onchange='oncurr(6)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group by Currency ORDER BY Currency ASC");
        while ($s = mssql_fetch_array($tampil)) {
            if ($s[Currency] == $fix6[QuotationCurr]) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator6' size='3' value='$fix6[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate6' size='3' value='$fix6[SellingRate]' readonly>
                     </td><td>
                     <input type=text name='quoadult6' size='12' value='$fix6[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(6)' ";
        if ($fix6[Description] == '') {
            echo "readonly";
        }
        echo ">
                     </td><td><input type='text' name='selladult6' value='$fix6[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <td><input type=text name='quochd6' size='12' value='$fix6[QuoChd]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(6)' ";
        if ($fix6[Description] == '') {
            echo "readonly";
        }
        echo "></td>
                     <td><input type='text' name='sellchd6' value='$fix6[SellChd]' style='text-align:right;border: hidden;' size='12'onkeyup='isNumber(this);TotalC()' readonly></td></tr>

                     <tr><td><select name='supplier7'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix7[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc7' size='45' value='$fix7[Description]' onkeyup='buka(7)'></td>
                                     <td>
                    <select name='quotationcurr7' onchange='oncurr(7)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group by Currency ORDER BY Currency ASC");
        while ($s = mssql_fetch_array($tampil)) {
            if ($s[Currency] == $fix7[QuotationCurr]) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator7' size='3' value='$fix7[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate7' size='3' value='$fix7[SellingRate]' readonly>
                     </td><td>
                     <input type=text name='quoadult7' size='12' value='$fix7[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(7)' ";
        if ($fix7[Description] == '') {
            echo "readonly";
        }
        echo ">
                     </td><td><input type='text' name='selladult7' value='$fix7[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <td><input type=text name='quochd7' size='12' value='$fix7[QuoChd]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(7)' ";
        if ($fix7[Description] == '') {
            echo "readonly";
        }
        echo "></td>
                     <td><input type='text' name='sellchd7' value='$fix7[SellChd]' style='text-align:right;border: hidden;' size='12'onkeyup='isNumber(this);TotalC()' readonly></td></tr>

                     <tr><td><select name='supplier8'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix8[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc8' size='45' value='$fix8[Description]' onkeyup='buka(8)'></td>
                                     <td>
                    <select name='quotationcurr8' onchange='oncurr(8)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group by Currency ORDER BY Currency ASC");
        while ($s = mssql_fetch_array($tampil)) {
            if ($s[Currency] == $fix8[QuotationCurr]) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator8' size='3' value='$fix8[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate8' size='3' value='$fix8[SellingRate]' readonly>
                     </td><td>
                     <input type=text name='quoadult8' size='12' value='$fix8[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(8)' ";
        if ($fix8[Description] == '') {
            echo "readonly";
        }
        echo ">
                     </td><td><input type='text' name='selladult8' value='$fix8[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <td><input type=text name='quochd8' size='12' value='$fix8[QuoChd]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(8)' ";
        if ($fix8[Description] == '') {
            echo "readonly";
        }
        echo "></td>
                     <td><input type='text' name='sellchd8' value='$fix8[SellChd]' style='text-align:right;border: hidden;' size='12'onkeyup='isNumber(this);TotalC()' readonly></td></tr>

                     <tr><td><select name='supplier9'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix9[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc9' size='45' value='$fix9[Description]' onkeyup='buka(9)'></td>
                                     <td>
                    <select name='quotationcurr9' onchange='oncurr(9)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group by Currency ORDER BY Currency ASC");
        while ($s = mssql_fetch_array($tampil)) {
            if ($s[Currency] == $fix9[QuotationCurr]) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator9' size='3' value='$fix9[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate9' size='3' value='$fix9[SellingRate]' readonly>
                     </td><td>
                     <input type=text name='quoadult9' size='12' value='$fix9[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(9)' ";
        if ($fix9[Description] == '') {
            echo "readonly";
        }
        echo ">
                     </td><td><input type='text' name='selladult9' value='$fix9[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <td><input type=text name='quochd9' size='12' value='$fix9[QuoChd]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(9)' ";
        if ($fix9[Description] == '') {
            echo "readonly";
        }
        echo "></td>
                     <td><input type='text' name='sellchd9' value='$fix9[SellChd]' style='text-align:right;border: hidden;' size='12'onkeyup='isNumber(this);TotalC()' readonly></td></tr>

                     <tr><td><select name='supplier10'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix10[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc10' size='45' value='$fix10[Description]' onkeyup='buka(10)'></td>
                                     <td>
                    <select name='quotationcurr10' onchange='oncurr(10)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group by Currency ORDER BY Currency ASC");
        while ($s = mssql_fetch_array($tampil)) {
            if ($s[Currency] == $fix10[QuotationCurr]) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator10' size='3' value='$fix10[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate10' size='3' value='$fix10[SellingRate]' readonly>
                     </td><td>
                     <input type=text name='quoadult10' size='12' value='$fix10[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(10)' ";
        if ($fix10[Description] == '') {
            echo "readonly";
        }
        echo ">
                     </td><td><input type='text' name='selladult10' value='$fix10[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <td><input type=text name='quochd10' size='12' value='$fix10[QuoChd]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(10)' ";
        if ($fix10[Description] == '') {
            echo "readonly";
        }
        echo "></td>
                     <td><input type='text' name='sellchd10' value='$fix10[SellChd]' style='text-align:right;border: hidden;' size='12'onkeyup='isNumber(this);TotalC()' readonly></td></tr>
<tr><td><select name='supplier11'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix11[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc11' size='45' value='$fix11[Description]' onkeyup='buka(11)'></td>
                     <td>
                     <select name='quotationcurr11' onchange='oncurr(11)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group by Currency ORDER BY Currency ASC");
        while ($s = mssql_fetch_array($tampil)) {
            if ($s[Currency] == $fix11[QuotationCurr]) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select>";
        echo "<input type='hidden' name='sellingoperator11' size='3' value='$fix11[SellingOperator]' > x
                     <input type='text' style='border: hidden;' name='sellingrate11' size='10' value='$fix11[SellingRate]' readonly>
                     </td><td>
                     <input type=text name='quoadult11' size='12' value='$fix11[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(11)' ";
        if ($fix11[Description] == '') {
            echo "readonly";
        }
        echo ">
                     </td><td><input type='text' name='selladult11' value='$fix11[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <td><input type=text name='quochd11' size='12' value='$fix11[QuoChd]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(11)' ";
        if ($fix11[Description] == '') {
            echo "readonly";
        }
        echo "></td>
                     <td><input type='text' name='sellchd11' value='$fix11[SellChd]' style='text-align:right;border: hidden;' size='12'onkeyup='isNumber(this);TotalC()' readonly></td></tr>

                     <tr><td><select name='supplier12'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix12[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc12' size='45' value='$fix12[Description]' onkeyup='buka(12)'></td>
                                     <td>
                    <select name='quotationcurr12' onchange='oncurr(12)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group by Currency ORDER BY Currency ASC");
        while ($s = mssql_fetch_array($tampil)) {
            if ($s[Currency] == $fix12[QuotationCurr]) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator12' size='3' value='$fix12[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate12' size='4' value='$fix12[SellingRate]' readonly>
                     </td><td>
                     <input type=text name='quoadult12' size='12' value='$fix12[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(12)' ";
        if ($fix12[Description] == '') {
            echo "readonly";
        }
        echo ">
                     </td><td><input type='text' name='selladult12' value='$fix12[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <td><input type=text name='quochd12' size='12' value='$fix12[QuoChd]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(12)' ";
        if ($fix12[Description] == '') {
            echo "readonly";
        }
        echo "></td>
                     <td><input type='text' name='sellchd12' value='$fix12[SellChd]' style='text-align:right;border: hidden;' size='12'onkeyup='isNumber(this);TotalC()' readonly></td></tr>

                     <tr><td><select name='supplier13'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix13[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc13' size='45' value='$fix13[Description]' onkeyup='buka(13)'></td>
                                     <td>
                    <select name='quotationcurr13' onchange='oncurr(13)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group by Currency ORDER BY Currency ASC");
        while ($s = mssql_fetch_array($tampil)) {
            if ($s[Currency] == $fix13[QuotationCurr]) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator13' size='3' value='$fix13[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate13' size='3' value='$fix13[SellingRate]' readonly>
                     </td><td>
                     <input type=text name='quoadult13' size='12' value='$fix13[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(13)' ";
        if ($fix13[Description] == '') {
            echo "readonly";
        }
        echo ">
                     </td><td><input type='text' name='selladult13' value='$fix13[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <td><input type=text name='quochd13' size='12' value='$fix13[QuoChd]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(13)' ";
        if ($fix13[Description] == '') {
            echo "readonly";
        }
        echo "></td>
                     <td><input type='text' name='sellchd13' value='$fix13[SellChd]' style='text-align:right;border: hidden;' size='12'onkeyup='isNumber(this);TotalC()' readonly></td></tr>

                     <tr><td><select name='supplier14'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix14[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc14' size='45' value='$fix14[Description]' onkeyup='buka(14)'></td>
                                     <td>
                    <select name='quotationcurr14' onchange='oncurr(14)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group by Currency ORDER BY Currency ASC");
        while ($s = mssql_fetch_array($tampil)) {
            if ($s[Currency] == $fix14[QuotationCurr]) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator14' size='3' value='$fix14[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate14' size='4' value='$fix14[SellingRate]' readonly>
                     </td><td>
                     <input type=text name='quoadult14' size='12' value='$fix14[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(14)' ";
        if ($fix14[Description] == '') {
            echo "readonly";
        }
        echo ">
                     </td><td><input type='text' name='selladult14' value='$fix14[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <td><input type=text name='quochd14' size='12' value='$fix14[QuoChd]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(14)' ";
        if ($fix14[Description] == '') {
            echo "readonly";
        }
        echo "></td>
                     <td><input type='text' name='sellchd14' value='$fix14[SellChd]' style='text-align:right;border: hidden;' size='12'onkeyup='isNumber(this);TotalC()' readonly></td></tr>

                     <tr><td><select name='supplier15'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix15[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc15' size='45' value='$fix15[Description]' onkeyup='buka(15)'></td>
                                     <td>
                    <select name='quotationcurr15' onchange='oncurr(15)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group by Currency ORDER BY Currency ASC");
        while ($s = mssql_fetch_array($tampil)) {
            if ($s[Currency] == $fix15[QuotationCurr]) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator15' size='3' value='$fix15[SellingOperator]' > x
                                <input type='text' style='border: hidden;' name='sellingrate15' size='4' value='$fix15[SellingRate]' readonly>
                     </td><td>
                     <input type=text name='quoadult15' size='12' value='$fix15[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(15)' ";
        if ($fix15[Description] == '') {
            echo "readonly";
        }
        echo ">
                     </td><td><input type='text' name='selladult15' value='$fix15[SellAdult]' style='text-align:right;border: hidden;' size='12' onkeyup='isNumber(this);TotalA()' readonly></td>
                     <td><input type=text name='quochd15' size='12' value='$fix15[QuoChd]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(15)' ";
        if ($fix15[Description] == '') {
            echo "readonly";
        }
        echo "></td>
                     <td><input type='text' name='sellchd15' value='$fix15[SellChd]' style='text-align:right;border: hidden;' size='12'onkeyup='isNumber(this);TotalC()' readonly></td></tr>

                     <tr><td colspan=4><b><i>TOTAL</td><td><input type='text' name='totalfixadult' value='$totfix[TotalFixAdult]' size='12' style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly></td><td></td><td><input type='text' name='totalfixchd' value='$totfix[TotalFixChd]' size='12' style='text-align: right;font-weight:bold;border: 0px solid #000000;' readonly></td></tr>
                    </table>    
          
          <center><input type='submit' name='submit' id='submitquo' value='Save'>
          </form>";
        break;

    case "save":

        $pax = $_POST[pax];
        $Description = "Update Fix Cost ($_POST[tourcode])";
        $EmpName="$_SESSION[employee_name] ($_SESSION[employee_code])";
        $Sup1 = strtoupper($_POST[supplier1]);
        $Desc1 = strtoupper($_POST[desc1]);
        mysql_query("UPDATE tour_detail set Supplier = '$Sup1',
                                        Description = '$Desc1', 
                                        QuoAdult = '$_POST[quoadult1]',
                                        SellAdult = '$_POST[selladult1]',
                                        QuoChd = '$_POST[quochd1]',
                                        SellChd = '$_POST[sellchd1]',
                                        QuotationCurr = '$_POST[quotationcurr1]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator1]',
                                        SellingRate = '$_POST[sellingrate1]'
                                        WHERE Detail = 'FIX1' AND IDProduct = '$_POST[id]'");
        $Sup2 = strtoupper($_POST[supplier2]);
        $Desc2 = strtoupper($_POST[desc2]);
        mysql_query("UPDATE tour_detail set Supplier = '$Sup2',
                                        Description = '$Desc2',
                                        QuoAdult = '$_POST[quoadult2]',
                                        SellAdult = '$_POST[selladult2]',
                                        QuoChd = '$_POST[quochd2]',
                                        SellChd = '$_POST[sellchd2]',
                                        QuotationCurr = '$_POST[quotationcurr2]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator2]',
                                        SellingRate = '$_POST[sellingrate2]'
                                        WHERE Detail = 'FIX2' AND IDProduct = '$_POST[id]'");
        $Sup3 = strtoupper($_POST[supplier3]);
        $Desc3 = strtoupper($_POST[desc3]);
        mysql_query("UPDATE tour_detail set Supplier = '$Sup3',
                                        Description = '$Desc3',
                                        QuoAdult = '$_POST[quoadult3]',
                                        SellAdult = '$_POST[selladult3]',
                                        QuoChd = '$_POST[quochd3]',
                                        SellChd = '$_POST[sellchd3]',
                                        QuotationCurr = '$_POST[quotationcurr3]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator3]',
                                        SellingRate = '$_POST[sellingrate3]'
                                        WHERE Detail = 'FIX3' AND IDProduct = '$_POST[id]'");
        $Sup4 = strtoupper($_POST[supplier4]);
        $Desc4 = strtoupper($_POST[desc4]);
        mysql_query("UPDATE tour_detail set Supplier = '$Sup4',
                                        Description = '$Desc4',
                                        QuoAdult = '$_POST[quoadult4]',
                                        SellAdult = '$_POST[selladult4]',
                                        QuoChd = '$_POST[quochd4]',
                                        SellChd = '$_POST[sellchd4]',
                                        QuotationCurr = '$_POST[quotationcurr4]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator4]',
                                        SellingRate = '$_POST[sellingrate4]'
                                        WHERE Detail = 'FIX4' AND IDProduct = '$_POST[id]'");
        $Sup5 = strtoupper($_POST[supplier5]);
        $Desc5 = strtoupper($_POST[desc5]);
        mysql_query("UPDATE tour_detail set Supplier = '$Sup5',
                                        Description = '$Desc5',
                                        QuoAdult = '$_POST[quoadult5]',
                                        SellAdult = '$_POST[selladult5]',
                                        QuoChd = '$_POST[quochd5]',
                                        SellChd = '$_POST[sellchd5]',
                                        QuotationCurr = '$_POST[quotationcurr5]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator5]',
                                        SellingRate = '$_POST[sellingrate5]'
                                        WHERE Detail = 'FIX5' AND IDProduct = '$_POST[id]'");
        $Sup6 = strtoupper($_POST[supplier6]);
        $Desc6 = strtoupper($_POST[desc6]);
        mysql_query("UPDATE tour_detail set Supplier = '$Sup6',
                                        Description = '$Desc6',
                                        QuoAdult = '$_POST[quoadult6]',
                                        SellAdult = '$_POST[selladult6]',
                                        QuoChd = '$_POST[quochd6]',
                                        SellChd = '$_POST[sellchd6]',
                                        QuotationCurr = '$_POST[quotationcurr6]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator6]',
                                        SellingRate = '$_POST[sellingrate6]'
                                        WHERE Detail = 'FIX6' AND IDProduct = '$_POST[id]'");
        $Sup7 = strtoupper($_POST[supplier7]);
        $Desc7 = strtoupper($_POST[desc7]);
        mysql_query("UPDATE tour_detail set Supplier = '$Sup7',
                                        Description = '$Desc7',
                                        QuoAdult = '$_POST[quoadult7]',
                                        SellAdult = '$_POST[selladult7]',
                                        QuoChd = '$_POST[quochd7]',
                                        SellChd = '$_POST[sellchd7]',
                                        QuotationCurr = '$_POST[quotationcurr7]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator7]',
                                        SellingRate = '$_POST[sellingrate7]'
                                        WHERE Detail = 'FIX7' AND IDProduct = '$_POST[id]'");
        $Sup8 = strtoupper($_POST[supplier8]);
        $Desc8 = strtoupper($_POST[desc8]);
        mysql_query("UPDATE tour_detail set Supplier = '$Sup8',
                                        Description = '$Desc8',
                                        QuoAdult = '$_POST[quoadult8]',
                                        SellAdult = '$_POST[selladult8]',
                                        QuoChd = '$_POST[quochd8]',
                                        SellChd = '$_POST[sellchd8]',
                                        QuotationCurr = '$_POST[quotationcurr8]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator8]',
                                        SellingRate = '$_POST[sellingrate8]'
                                        WHERE Detail = 'FIX8' AND IDProduct = '$_POST[id]'");
        $Sup9 = strtoupper($_POST[supplier9]);
        $Desc9 = strtoupper($_POST[desc9]);
        mysql_query("UPDATE tour_detail set Supplier = '$Sup9',
                                        Description = '$Desc9',
                                        QuoAdult = '$_POST[quoadult9]',
                                        SellAdult = '$_POST[selladult9]',
                                        QuoChd = '$_POST[quochd9]',
                                        SellChd = '$_POST[sellchd9]',
                                        QuotationCurr = '$_POST[quotationcurr9]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator9]',
                                        SellingRate = '$_POST[sellingrate9]'
                                        WHERE Detail = 'FIX9' AND IDProduct = '$_POST[id]'");
        $Sup10 = strtoupper($_POST[supplier10]);
        $Desc10 = strtoupper($_POST[desc10]);
        mysql_query("UPDATE tour_detail set Supplier = '$Sup10',
                                        Description = '$Desc10',
                                        QuoAdult = '$_POST[quoadult10]',
                                        SellAdult = '$_POST[selladult10]',
                                        QuoChd = '$_POST[quochd10]',
                                        SellChd = '$_POST[sellchd10]',
                                        QuotationCurr = '$_POST[quotationcurr10]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator10]',
                                        SellingRate = '$_POST[sellingrate10]'
                                        WHERE Detail = 'FIX10' AND IDProduct = '$_POST[id]'");
        $Sup11 = strtoupper($_POST[supplier11]);
        $Desc11 = strtoupper($_POST[desc11]);
        mysql_query("UPDATE tour_detail set Supplier = '$Sup11',
                                        Description = '$Desc11',
                                        QuoAdult = '$_POST[quoadult11]',
                                        SellAdult = '$_POST[selladult11]',
                                        QuoChd = '$_POST[quochd11]',
                                        SellChd = '$_POST[sellchd11]',
                                        QuotationCurr = '$_POST[quotationcurr11]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator11]',
                                        SellingRate = '$_POST[sellingrate11]'
                                        WHERE Detail = 'FIX11' AND IDProduct = '$_POST[id]'");
        $Sup12 = strtoupper($_POST[supplier12]);
        $Desc12 = strtoupper($_POST[desc12]);
        mysql_query("UPDATE tour_detail set Supplier = '$Sup12',
                                        Description = '$Desc12',
                                        QuoAdult = '$_POST[quoadult12]',
                                        SellAdult = '$_POST[selladult12]',
                                        QuoChd = '$_POST[quochd12]',
                                        SellChd = '$_POST[sellchd12]',
                                        QuotationCurr = '$_POST[quotationcurr12]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator12]',
                                        SellingRate = '$_POST[sellingrate12]'
                                        WHERE Detail = 'FIX12' AND IDProduct = '$_POST[id]'");
        $Sup13 = strtoupper($_POST[supplier13]);
        $Desc13 = strtoupper($_POST[desc13]);
        mysql_query("UPDATE tour_detail set Supplier = '$Sup13',
                                        Description = '$Desc13',
                                        QuoAdult = '$_POST[quoadult13]',
                                        SellAdult = '$_POST[selladult13]',
                                        QuoChd = '$_POST[quochd13]',
                                        SellChd = '$_POST[sellchd13]',
                                        QuotationCurr = '$_POST[quotationcurr13]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator13]',
                                        SellingRate = '$_POST[sellingrate13]'
                                        WHERE Detail = 'FIX13' AND IDProduct = '$_POST[id]'");
        $Sup14 = strtoupper($_POST[supplier14]);
        $Desc14 = strtoupper($_POST[desc14]);
        mysql_query("UPDATE tour_detail set Supplier = '$Sup14',
                                        Description = '$Desc14',
                                        QuoAdult = '$_POST[quoadult14]',
                                        SellAdult = '$_POST[selladult14]',
                                        QuoChd = '$_POST[quochd14]',
                                        SellChd = '$_POST[sellchd14]',
                                        QuotationCurr = '$_POST[quotationcurr14]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator14]',
                                        SellingRate = '$_POST[sellingrate14]'
                                        WHERE Detail = 'FIX14' AND IDProduct = '$_POST[id]'");
        $Sup15 = strtoupper($_POST[supplier15]);
        $Desc15 = strtoupper($_POST[desc15]);
        mysql_query("UPDATE tour_detail set Supplier = '$Sup15',
                                        Description = '$Desc15',
                                        QuoAdult = '$_POST[quoadult15]',
                                        SellAdult = '$_POST[selladult15]',
                                        QuoChd = '$_POST[quochd15]',
                                        SellChd = '$_POST[sellchd15]',
                                        QuotationCurr = '$_POST[quotationcurr15]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator15]',
                                        SellingRate = '$_POST[sellingrate15]'
                                        WHERE Detail = 'FIX15' AND IDProduct = '$_POST[id]'");
        mysql_query("UPDATE tour_msdetail set TotalFixAdult = '$_POST[totalfixadult]',
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
