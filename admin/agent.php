<link href="css/fixed_table_rc.css" type="text/css" rel="stylesheet" media="all" />
<script src="js/fixtablejquery.min.js" type="text/javascript"></script>
<script src="js/fixtablejquery-1.10.2.min.js" type="text/javascript"></script>
<script src="js/sortable_table.js" type="text/javascript"></script>
<script src="js/fixed_table_rc.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
function updatepage()
{
        window.close();
        window.opener.location.reload();
    }
</script>
<script language="JavaScript"  type="text/javascript">
function isNumber(field) {
//var re = /^[0-9'.']*$/;
    var re = /^[-+]?[0-9]*\.?[0-9]+$/;
    if (!re.test(field.value)) {
        alert('VALUE MUST BE NUMBER !');
        field.value = field.value.replace(/[^0-9'.']/g, "");
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
var ta = calculate.totalchdtwna;
var tb = calculate.totalchdxbeda;
var tc = calculate.totalchdnbeda;
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
function UpdateAll(NO){
    UpdateSellA(NO);
    UpdateSellC(NO);
    UpdateSellD(NO);
    UpdateSellN(NO);
}
function UpdateSellA(NO) {
var a = eval("calculate.quoadult" + NO + ".value;")
var b = eval("calculate.sellingoperator" + NO + ".value;")
var c = eval("calculate.sellingrate" + NO + ".value;")
var n = eval("calculate.selladult" + NO + ";")
    if(a==0){n.value = (0).toFixed(2) ;}else{

            var x = a * c ;
            n.value = (x).toFixed(2) ;;

    }
if(n < a){
n.style.backgroundColor = "red"; }
else {n.style.backgroundColor = "white";}
TotalA();
}
function TotalC(){
var t = calculate.totalchdtwna;
var ta = calculate.totaladulta;
var tb = calculate.totalchdxbeda;
var tc = calculate.totalchdnbeda;
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
var b = eval("calculate.sellingoperator" + NO + ".value;")
var c = eval("calculate.sellingrate" + NO + ".value;")
var n = eval("calculate.sellchd" + NO + ";")
    if(a==0){n.value = (0).toFixed(2) ;}else{

            var x = a * c ;
            n.value = (x).toFixed(2) ;;

    }
if(n < a){
n.style.backgroundColor = "red"; }
else {n.style.backgroundColor = "white";}
TotalC();
} 
function TotalD(){
var t = calculate.totalchdxbeda;
var ta = calculate.totaladulta;
var tb = calculate.totalchdtwna;
var tc = calculate.totalchdnbeda;
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
t.value = (n1 + n2 + n3 + n4 + n5 + n6 + n7 + n8 + n9 + n10).toFixed(2) ;
if (isNaN(t.value)) {
  t.value=0
}
}
function UpdateSellD(NO) {
var a = eval("calculate.quochdx" + NO + ".value;")
var b = eval("calculate.sellingoperator" + NO + ".value;")
var c = eval("calculate.sellingrate" + NO + ".value;")
var n = eval("calculate.sellchdx" + NO + ";")
    if(a==0){n.value = (0).toFixed(2) ;}else{

            var x = a * c ;
            n.value = (x).toFixed(2) ;;

    }
if(n < a){
n.style.backgroundColor = "red"; }
else {n.style.backgroundColor = "white";}
TotalD();
}
function TotalN(){
var t = calculate.totalchdnbeda;
var ta = calculate.totaladulta;
var tb = calculate.totalchdtwna;
var tc = calculate.totalchdxbeda;
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
t.value = (n1 + n2 + n3 + n4 + n5 + n6 + n7 + n8 + n9 + n10).toFixed(2) ;
if (isNaN(t.value)) {
  t.value=0
}
}
function UpdateSellN(NO) {
    var a = eval("calculate.quochdn" + NO + ".value;")
    var b = eval("calculate.sellingoperator" + NO + ".value;")
    var c = eval("calculate.sellingrate" + NO + ".value;")
    var n = eval("calculate.sellchdn" + NO + ";")
    if(a==0){n.value = (0).toFixed(2) ;}else{

            var x = a * c ;
            n.value = (x).toFixed(2) ;;

    }
    if(n < a){
    n.style.backgroundColor = "red"; }
    else {n.style.backgroundColor = "white";}   
    TotalN();
}
function oncurr(NO) {
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
        UpdateSellA(NO);UpdateSellC(NO);UpdateSellD(NO);UpdateSellN(NO);
    }else{
        document.calculate.elements[selrate].readOnly=true;
        document.calculate.elements[selrate].value=rateidr;
        UpdateSellA(NO);UpdateSellC(NO);UpdateSellD(NO);UpdateSellN(NO);
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
    if(r1 == 0 || r2 == 0 || r3 == 0 || r4 == 0 || r5 == 0 || r6 == 0 || r7 == 0 || r8 == 0 || r9 == 0 || r10 == 0 )
    {document.calculate.elements['submit'].disabled=true; }
    else{document.calculate.elements['submit'].disabled=false; }
}
$(function () {
    $('#fixed_hdr2').fxdHdrCol({
        fixedCols: 0,
        width: "100%",
        height: 400,
        colModal: [
            { width: 450, align: 'center' },
            { width: 180, align: 'center' },
            { width: 160, align: 'center' },
            { width: 80, align: 'center' },
            { width: 120, align: 'center' },
            { width: 70, align: 'center' },
            { width: 100, align: 'center' },
            { width: 100, align: 'center' },
            { width: 100, align: 'center' },
            { width: 90, align: 'center' },
            { width: 100, align: 'center' }
        ],
        sort: true
    });
});
</script>
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" /> 
<?php 
include "../config/koneksi.php";
include "../config/koneksimaster.php";
switch($_GET[act]) {
    
    default:
        $edit = mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
        $r = mysql_fetch_array($edit);
        $depdate = substr($r[DateTravelFrom], 8, 2);
        $pakerate = $r[DateTravelFrom];
        echo "<h2>AGENT COST (OPTION A) - $r[TourCode]</h2>
          <form method=POST name='calculate' action='?module=agent&act=save'>
          <input type='hidden' name=id value='$r[IDProduct]'><input type='hidden' name='tourcode' value='$r[TourCode]'> 
          <input type='hidden' name='sellingoperator' value='$r[SellingOperator]'>
          <input type='hidden' name='sellingrate' value='$r[SellingRate]'>
          <input type='hidden' name='quotationcurr' value='$r[QuotationCurr]'>
          <input type='hidden' name='sellingcurr' value='$r[SellingCurr]'>";
        $cariperiod = mssql_query("SELECT TOP 1 * FROM AgingKurs
                                                where StartDate <= '$pakerate' and EndDate >= '$pakerate' order by AgingKurs.IDHeader DESC");
        $periodrate = mssql_fetch_array($cariperiod);
        $carirate = mssql_query("SELECT Currency, ExRate FROM AgingKursDetails
                                                where IDHeader = '$periodrate[IDHeader]'");
        while ($rateidr = mssql_fetch_array($carirate)) {
            echo "<input type='hidden' name='$rateidr[Currency]' value='$rateidr[ExRate]'>";
        }
        $isifix1 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT1' and IDProduct = '$r[IDProduct]' ");
        $fix1 = mysql_fetch_array($isifix1);
        $isifix2 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT2' and IDProduct = '$r[IDProduct]' ");
        $fix2 = mysql_fetch_array($isifix2);
        $isifix3 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT3' and IDProduct = '$r[IDProduct]' ");
        $fix3 = mysql_fetch_array($isifix3);
        $isifix4 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT4' and IDProduct = '$r[IDProduct]' ");
        $fix4 = mysql_fetch_array($isifix4);
        $isifix5 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT5' and IDProduct = '$r[IDProduct]' ");
        $fix5 = mysql_fetch_array($isifix5);
        $isifix6 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT6' and IDProduct = '$r[IDProduct]' ");
        $fix6 = mysql_fetch_array($isifix6);
        $isifix7 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT7' and IDProduct = '$r[IDProduct]' ");
        $fix7 = mysql_fetch_array($isifix7);
        $isifix8 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT8' and IDProduct = '$r[IDProduct]' ");
        $fix8 = mysql_fetch_array($isifix8);
        $isifix9 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT9' and IDProduct = '$r[IDProduct]' ");
        $fix9 = mysql_fetch_array($isifix9);
        $isifix10 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT10' and IDProduct = '$r[IDProduct]' ");
        $fix10 = mysql_fetch_array($isifix10);
        $isitotal = mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct = '$r[IDProduct]' ");
        $totfix = mysql_fetch_array($isitotal);
        if ($totfix[TotalAdultA] > 0 OR $totfix[TotalChdTwnA] > 0 OR $totfix[TotalChdXbedA] > 0 OR $totfix[TotalChdNbedA] > 0) {
            $tampil1 = 'enable';
        } else {
            $tampil1 = 'disabled';
        }
        echo "<table class='bordered' id='fixed_hdr2'>
            <thead>
            <tr><th></th><th></th><th></th>";
        if ($r[GroupType] == 'CRUISE') {
            echo "<th colspan=4>adult</th><th colspan=4>Child </th></tr></thead>
            <tr><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>PAX : <input type=text name='paxa' size='3' value='$totfix[PaxA]'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>quotation</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>1-2 PAX</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>3-4 PAX</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>1-2 PAX</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>3-4 PAX </td></tr>";
        } else {
            echo "<th colspan=2>adult</th><th colspan=6>Child </th></tr></thead>
            <tr><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>PAX : <input type=text name='paxa' size='3' value='$totfix[PaxA]'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>quotation</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>Twin BED</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>Extra BED </td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>NO BED </td></tr>";
        }
        echo "<tr><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'><b>supplier</b></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>description</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>Curr - Operator - Rate</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>In $r[SellingCurr]</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>In $r[SellingCurr]</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>In $r[SellingCurr]</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>In $r[SellingCurr]</td></tr>
            <tbody>
                     <tr><td><select name='supplier1'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix1[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc1' size='25' value='$fix1[Description]'></td>
                     <td><center><select name='quotationcurr1' onchange='oncurr(1)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix1[QuotationCurrA] == '') {
                $fca1 = 'IDR';
            } else {
                $fca1 = $fix1[QuotationCurrA];
            }
            if ($s[Currency] == $fca1) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator1' size='3' value='$fix1[SellingOperatorA]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate1' size='6' value='$fix1[SellingRateA]' readonly>
                     </td><td><input type=text name='quoadult1' size='12' value='$fix1[QuoAdultA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(1)'></td><td><input type='text' name='selladult1' value='$fix1[SellAdultA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd1' size='12' value='$fix1[QuoChdTwnA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(1)'></td><td><input type='text' name='sellchd1' value='$fix1[SellChdTwnA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx1' size='12' value='$fix1[QuoChdXbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(1)'></td><td><input type='text' name='sellchdx1' value='$fix1[SellChdXbedA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn1' size='12' value='$fix1[QuoChdNbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(1)'></td><td><input type='text' name='sellchdn1' value='$fix1[SellChdNbedA]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc2' size='25' value='$fix2[Description]'></td>
                     <td><center><select name='quotationcurr2' onchange='oncurr(2)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix2[QuotationCurrA] == '') {
                $fca2 = 'IDR';
            } else {
                $fca2 = $fix2[QuotationCurrA];
            }
            if ($s[Currency] == $fca2) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator2' size='3' value='$fix2[SellingOperatorA]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate2' size='6' value='$fix2[SellingRateA]' readonly>
                     </td><td><input type=text name='quoadult2' size='12' value='$fix2[QuoAdultA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(2)'></td><td><input type='text' name='selladult2' value='$fix2[SellAdultA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd2' size='12' value='$fix2[QuoChdTwnA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(2)'></td><td><input type='text' name='sellchd2'  value='$fix2[SellChdTwnA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx2' size='12' value='$fix2[QuoChdXbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(2)'></td><td><input type='text' name='sellchdx2' value='$fix2[SellChdXbedA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn2' size='12' value='$fix2[QuoChdNbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(2)'></td><td><input type='text' name='sellchdn2' value='$fix2[SellChdNbedA]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc3' size='25' value='$fix3[Description]'></td>
                     <td><center><select name='quotationcurr3' onchange='oncurr(3)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix3[QuotationCurrA] == '') {
                $fca3 = 'IDR';
            } else {
                $fca3 = $fix3[QuotationCurrA];
            }
            if ($s[Currency] == $fca3) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator3' size='3' value='$fix3[SellingOperatorA]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate3' size='6' value='$fix3[SellingRateA]' readonly>
                     </td><td><input type=text name='quoadult3' size='12' value='$fix3[QuoAdultA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(3)'></td><td><input type='text' name='selladult3' value='$fix3[SellAdultA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd3' size='12' value='$fix3[QuoChdTwnA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(3)'></td><td><input type='text' name='sellchd3'  value='$fix3[SellChdTwnA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx3' size='12' value='$fix3[QuoChdXbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(3)'></td><td><input type='text' name='sellchdx3' value='$fix3[SellChdXbedA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn3' size='12' value='$fix3[QuoChdNbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(3)'></td><td><input type='text' name='sellchdn3' value='$fix3[SellChdNbedA]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc4' size='25' value='$fix4[Description]'></td>
                     <td><center><select name='quotationcurr4' onchange='oncurr(4)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix4[QuotationCurrA] == '') {
                $fca4 = 'IDR';
            } else {
                $fca4 = $fix4[QuotationCurrA];
            }
            if ($s[Currency] == $fca4) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator4' size='3' value='$fix4[SellingOperatorA]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate4' size='6' value='$fix4[SellingRateA]' readonly>
                     </td><td><input type=text name='quoadult4' size='12' value='$fix4[QuoAdultA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(4)'></td><td><input type='text' name='selladult4'  value='$fix4[SellAdultA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd4' size='12' value='$fix4[QuoChdTwnA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(4)'></td><td><input type='text' name='sellchd4' value='$fix4[SellChdTwnA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx4' size='12' value='$fix4[QuoChdXbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(4)'></td><td><input type='text' name='sellchdx4' value='$fix4[SellChdXbedA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn4' size='12' value='$fix4[QuoChdNbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(4)'></td><td><input type='text' name='sellchdn4' value='$fix4[SellChdNbedA]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc5' size='25' value='$fix5[Description]'></td>
                     <td><center><select name='quotationcurr5' onchange='oncurr(5)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix5[QuotationCurrA] == '') {
                $fca5 = 'IDR';
            } else {
                $fca5 = $fix5[QuotationCurrA];
            }
            if ($s[Currency] == $fca5) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator5' size='3' value='$fix5[SellingOperatorA]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate5' size='6' value='$fix5[SellingRateA]' readonly>
                     </td><td><input type=text name='quoadult5' size='12' value='$fix5[QuoAdultA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(5)'></td><td><input type='text' name='selladult5'  value='$fix5[SellAdultA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd5' size='12' value='$fix5[QuoChdTwnA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(5)'></td><td><input type='text' name='sellchd5'  value='$fix5[SellChdTwnA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx5' size='12' value='$fix5[QuoChdXbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(5)'></td><td><input type='text' name='sellchdx5' value='$fix5[SellChdXbedA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn5' size='12' value='$fix5[QuoChdNbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(5)'></td><td><input type='text' name='sellchdn5' value='$fix5[SellChdNbedA]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc6' size='25' value='$fix6[Description]'></td>
                     <td><center><select name='quotationcurr6' onchange='oncurr(6)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix6[QuotationCurrA] == '') {
                $fca6 = 'IDR';
            } else {
                $fca6 = $fix6[QuotationCurrA];
            }
            if ($s[Currency] == $fca6) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator6' size='3' value='$fix6[SellingOperatorA]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate6' size='6' value='$fix6[SellingRateA]' readonly>
                     </td><td><input type=text name='quoadult6' size='12' value='$fix6[QuoAdultA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(6)'></td><td><input type='text' name='selladult6'  value='$fix6[SellAdultA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd6' size='12' value='$fix6[QuoChdTwnA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(6)'></td><td><input type='text' name='sellchd6' value='$fix6[SellChdTwnA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx6' size='12' value='$fix6[QuoChdXbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(6)'></td><td><input type='text' name='sellchdx6' value='$fix6[SellChdXbedA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn6' size='12' value='$fix6[QuoChdNbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(6)'></td><td><input type='text' name='sellchdn6' value='$fix6[SellChdNbedA]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc7' size='25' value='$fix7[Description]'></td>
                     <td><center><select name='quotationcurr7' onchange='oncurr(7)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix7[QuotationCurrA] == '') {
                $fca7 = 'IDR';
            } else {
                $fca7 = $fix7[QuotationCurrA];
            }
            if ($s[Currency] == $fca7) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator7' size='3' value='$fix7[SellingOperatorA]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate7' size='6' value='$fix7[SellingRateA]' readonly>
                     </td><td><input type=text name='quoadult7' size='12' value='$fix7[QuoAdultA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(7)'></td><td><input type='text' name='selladult7'  value='$fix7[SellAdultA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd7' size='12' value='$fix7[QuoChdTwnA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(7)'></td><td><input type='text' name='sellchd7' value='$fix7[SellChdTwnA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx7' size='12' value='$fix7[QuoChdXbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(7)'></td><td><input type='text' name='sellchdx7' value='$fix7[SellChdXbedA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn7' size='12' value='$fix7[QuoChdNbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(7)'></td><td><input type='text' name='sellchdn7' value='$fix7[SellChdNbedA]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc8' size='25' value='$fix8[Description]'></td>
                     <td><center><select name='quotationcurr8' onchange='oncurr(8)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix8[QuotationCurrA] == '') {
                $fca8 = 'IDR';
            } else {
                $fca8 = $fix8[QuotationCurrA];
            }
            if ($s[Currency] == $fca8) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator8' size='3' value='$fix8[SellingOperatorA]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate8' size='6' value='$fix8[SellingRateA]' readonly>
                     </td><td><input type=text name='quoadult8' size='12' value='$fix8[QuoAdultA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(8)'></td><td><input type='text' name='selladult8' value='$fix8[SellAdultA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd8' size='12' value='$fix8[QuoChdTwnA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(8)'></td><td><input type='text' name='sellchd8'  value='$fix8[SellChdTwnA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx8' size='12' value='$fix8[QuoChdXbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(8)'></td><td><input type='text' name='sellchdx8' value='$fix8[SellChdXbedA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn8' size='12' value='$fix8[QuoChdNbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(8)'></td><td><input type='text' name='sellchdn8' value='$fix8[SellChdNbedA]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc9' size='25' value='$fix9[Description]'></td>
                     <td><center><select name='quotationcurr9' onchange='oncurr(9)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix9[QuotationCurrA] == '') {
                $fca9 = 'IDR';
            } else {
                $fca9 = $fix9[QuotationCurrA];
            }
            if ($s[Currency] == $fca9) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator9' size='3' value='$fix9[SellingOperatorA]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate9' size='6' value='$fix9[SellingRateA]' readonly>
                     </td><td><input type=text name='quoadult9' size='12' value='$fix9[QuoAdultA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(9)'></td><td><input type='text' name='selladult9'  value='$fix9[SellAdultA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd9' size='12' value='$fix9[QuoChdTwnA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(9)'></td><td><input type='text' name='sellchd9'  value='$fix9[SellChdTwnA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx9' size='12' value='$fix9[QuoChdXbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(9)'></td><td><input type='text' name='sellchdx9' value='$fix9[SellChdXbedA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn9' size='12' value='$fix9[QuoChdNbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(9)'></td><td><input type='text' name='sellchdn9' value='$fix9[SellChdNbedA]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc10' size='25' value='$fix10[Description]'></td>
                     <td><center><select name='quotationcurr10' onchange='oncurr(10)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix10[QuotationCurrA] == '') {
                $fca10 = 'IDR';
            } else {
                $fca10 = $fix10[QuotationCurrA];
            }
            if ($s[Currency] == $fca10) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator10' size='3' value='$fix10[SellingOperatorA]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate10' size='6' value='$fix10[SellingRateA]' readonly>
                     </td><td><input type=text name='quoadult10' size='12' value='$fix10[QuoAdultA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(10)'></td><td><input type='text' name='selladult10' value='$fix10[SellAdultA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd10' size='12' value='$fix10[QuoChdTwnA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(10)'></td><td><input type='text' name='sellchd10' value='$fix10[SellChdTwnA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx10' size='12' value='$fix10[QuoChdXbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(10)'></td><td><input type='text' name='sellchdx10' value='$fix10[SellChdXbedA]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn10' size='12' value='$fix10[QuoChdNbedA]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(10)'></td><td><input type='text' name='sellchdn10' value='$fix10[SellChdNbedA]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
                    <tr><td colspan=4><b><i>TOTAL</td><td><input type='text' name='totaladulta' value='$totfix[TotalAdultA]' size='12' style='text-align: right;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdtwna' value='$totfix[TotalChdTwnA]' size='12' style='text-align: right;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdxbeda' value='$totfix[TotalChdXbedA]' size='12' style='text-align: right;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdnbeda' value='$totfix[TotalChdNbedA]' size='12' style='text-align: right;border: 0px solid #000000;' readonly></td></tr>
                    </tbody></table>
                    <br>
          <center><input type='submit' name='submit' value='Save'>
          </form>";
        break;

    case "save":
        $paxa = $_POST[paxa];
        $Description = "Update Fix Cost ($_POST[tourcode])";
        $Sup1 = strtoupper($_POST[supplier1]);
        $Desc1 = strtoupper($_POST[desc1]);
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
                                        QuotationCurrA = '$_POST[quotationcurr1]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator1]',
                                        SellingRateA = '$_POST[sellingrate1]'
                                        WHERE Category = 'AGENT1' AND IDProduct = '$_POST[id]'");
        $Sup2 = strtoupper($_POST[supplier2]);
        $Desc2 = strtoupper($_POST[desc2]);
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
                                        QuotationCurrA = '$_POST[quotationcurr2]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator2]',
                                        SellingRateA = '$_POST[sellingrate2]'
                                        WHERE Category = 'AGENT2' AND IDProduct = '$_POST[id]'");
        $Sup3 = strtoupper($_POST[supplier3]);
        $Desc3 = strtoupper($_POST[desc3]);
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
                                        QuotationCurrA = '$_POST[quotationcurr3]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator3]',
                                        SellingRateA = '$_POST[sellingrate3]'
                                        WHERE Category = 'AGENT3' AND IDProduct = '$_POST[id]'");
        $Sup4 = strtoupper($_POST[supplier4]);
        $Desc4 = strtoupper($_POST[desc4]);
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
                                        QuotationCurrA = '$_POST[quotationcurr4]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator4]',
                                        SellingRateA = '$_POST[sellingrate4]'
                                        WHERE Category = 'AGENT4' AND IDProduct = '$_POST[id]'");
        $Sup5 = strtoupper($_POST[supplier5]);
        $Desc5 = strtoupper($_POST[desc5]);
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
                                        QuotationCurrA = '$_POST[quotationcurr5]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator5]',
                                        SellingRateA = '$_POST[sellingrate5]'
                                        WHERE Category = 'AGENT5' AND IDProduct = '$_POST[id]'");
        $Sup6 = strtoupper($_POST[supplier6]);
        $Desc6 = strtoupper($_POST[desc6]);
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
                                        QuotationCurrA = '$_POST[quotationcurr6]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator6]',
                                        SellingRateA = '$_POST[sellingrate6]'
                                        WHERE Category = 'AGENT6' AND IDProduct = '$_POST[id]'");
        $Sup7 = strtoupper($_POST[supplier7]);
        $Desc7 = strtoupper($_POST[desc7]);
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
                                        QuotationCurrA = '$_POST[quotationcurr7]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator7]',
                                        SellingRateA = '$_POST[sellingrate7]'
                                        WHERE Category = 'AGENT7' AND IDProduct = '$_POST[id]'");
        $Sup8 = strtoupper($_POST[supplier8]);
        $Desc8 = strtoupper($_POST[desc8]);
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
                                        QuotationCurrA = '$_POST[quotationcurr8]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator8]',
                                        SellingRateA = '$_POST[sellingrate8]'
                                        WHERE Category = 'AGENT8' AND IDProduct = '$_POST[id]'");
        $Sup9 = strtoupper($_POST[supplier9]);
        $Desc9 = strtoupper($_POST[desc9]);
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
                                        QuotationCurrA = '$_POST[quotationcurr9]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator9]',
                                        SellingRateA = '$_POST[sellingrate9]'
                                        WHERE Category = 'AGENT9' AND IDProduct = '$_POST[id]'");
        $Sup10 = strtoupper($_POST[supplier10]);
        $Desc10 = strtoupper($_POST[desc10]);
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
                                        QuotationCurrA = '$_POST[quotationcurr10]',
                                        SellingCurrA = '$_POST[sellingcurr]',
                                        SellingOperatorA = '$_POST[sellingoperator10]',
                                        SellingRateA = '$_POST[sellingrate10]'
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
        $edit = mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
        $r = mysql_fetch_array($edit);
        $depdate = substr($r[DateTravelFrom], 8, 2);
        $pakerate = $r[DateTravelFrom];
        echo "<h2>AGENT COST (OPTION B) - $r[TourCode]</h2>
          <form method=POST name='calculate' action='?module=agent&act=saveb'>
          <input type='hidden' name=id value='$r[IDProduct]'><input type='hidden' name='tourcode' value='$r[TourCode]'> 
          <input type='hidden' name='sellingoperator' value='$r[SellingOperator]'>
          <input type='hidden' name='sellingrate' value='$r[SellingRate]'>
          <input type='hidden' name='quotationcurr' value='$r[QuotationCurr]'>
          <input type='hidden' name='sellingcurr' value='$r[SellingCurr]'>";
        $cariperiod = mssql_query("SELECT TOP 1 * FROM AgingKurs
                                                        where StartDate <= '$pakerate' and EndDate >= '$pakerate' order by AgingKurs.IDHeader DESC");
        $periodrate = mssql_fetch_array($cariperiod);
        $carirate = mssql_query("SELECT Currency, ExRate FROM AgingKursDetails
                                                        where IDHeader = '$periodrate[IDHeader]'");
        while ($rateidr = mssql_fetch_array($carirate)) {
            echo "<input type='hidden' name='$rateidr[Currency]' value='$rateidr[ExRate]'>";
        }
        $isifix1 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT1' and IDProduct = '$r[IDProduct]' ");
        $fix1 = mysql_fetch_array($isifix1);
        $isifix2 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT2' and IDProduct = '$r[IDProduct]' ");
        $fix2 = mysql_fetch_array($isifix2);
        $isifix3 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT3' and IDProduct = '$r[IDProduct]' ");
        $fix3 = mysql_fetch_array($isifix3);
        $isifix4 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT4' and IDProduct = '$r[IDProduct]' ");
        $fix4 = mysql_fetch_array($isifix4);
        $isifix5 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT5' and IDProduct = '$r[IDProduct]' ");
        $fix5 = mysql_fetch_array($isifix5);
        $isifix6 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT6' and IDProduct = '$r[IDProduct]' ");
        $fix6 = mysql_fetch_array($isifix6);
        $isifix7 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT7' and IDProduct = '$r[IDProduct]' ");
        $fix7 = mysql_fetch_array($isifix7);
        $isifix8 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT8' and IDProduct = '$r[IDProduct]' ");
        $fix8 = mysql_fetch_array($isifix8);
        $isifix9 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT9' and IDProduct = '$r[IDProduct]' ");
        $fix9 = mysql_fetch_array($isifix9);
        $isifix10 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT10' and IDProduct = '$r[IDProduct]' ");
        $fix10 = mysql_fetch_array($isifix10);
        $isitotal = mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct = '$r[IDProduct]' ");
        $totfix = mysql_fetch_array($isitotal);
        if ($fix1[QuotationCurrB] == $r[SellingCurr]) {
            $ok1 = 'disabled';
        } else {
            $ok1 = 'enabled';
        }
        if ($fix2[QuotationCurrB] == $r[SellingCurr]) {
            $ok2 = 'disabled';
        } else {
            $ok2 = 'enabled';
        }
        if ($fix3[QuotationCurrB] == $r[SellingCurr]) {
            $ok3 = 'disabled';
        } else {
            $ok3 = 'enabled';
        }
        if ($fix4[QuotationCurrB] == $r[SellingCurr]) {
            $ok4 = 'disabled';
        } else {
            $ok4 = 'enabled';
        }
        if ($fix5[QuotationCurrB] == $r[SellingCurr]) {
            $ok5 = 'disabled';
        } else {
            $ok5 = 'enabled';
        }
        if ($fix6[QuotationCurrB] == $r[SellingCurr]) {
            $ok6 = 'disabled';
        } else {
            $ok6 = 'enabled';
        }
        if ($fix7[QuotationCurrB] == $r[SellingCurr]) {
            $ok7 = 'disabled';
        } else {
            $ok7 = 'enabled';
        }
        if ($fix8[QuotationCurrB] == $r[SellingCurr]) {
            $ok8 = 'disabled';
        } else {
            $ok8 = 'enabled';
        }
        if ($fix9[QuotationCurrB] == $r[SellingCurr]) {
            $ok9 = 'disabled';
        } else {
            $ok9 = 'enabled';
        }
        if ($fix10[QuotationCurrB] == $r[SellingCurr]) {
            $ok10 = 'disabled';
        } else {
            $ok10 = 'enabled';
        }
        echo "<table class='bordered' id='fixed_hdr2'>
            <thead>
            <tr><th></th><th></th><th></th>";
        if ($r[GroupType] == 'CRUISE') {
            echo "<th colspan=4>adult</th><th colspan=4>Child </th></tr></thead>
            <tr><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>PAX : <input type=text name='paxb' size='3' value='$totfix[PaxB]'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>quotation</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>1-2 PAX</td><td colspan=2>3-4 PAX</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>1-2 PAX</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>3-4 PAX </td></tr>";
        } else {
            echo "<th colspan=2>adult</th><th colspan=6>Child </th></tr></thead>
            <tr><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>PAX : <input type=text name='paxb' size='3' value='$totfix[PaxB]'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>quotation</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>Twin BED</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>Extra BED </td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>NO BED </td></tr>";
        }
        echo "<tr><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'><b>supplier</b></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>description</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>Curr - Operator - Rate</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>In $r[SellingCurr]</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>In $r[SellingCurr]</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>In $r[SellingCurr]</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>In $r[SellingCurr]</td></tr>
            <tbody>
                     <tr><td><select name='supplier1'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix1[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc1' size='25' value='$fix1[Description]'></td>
                     <td><center><select name='quotationcurr1' onchange='oncurr(1)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix1[QuotationCurrB] == '') {
                $fcb1 = 'IDR';
            } else {
                $fcb1 = $fix1[QuotationCurrB];
            }
            if ($s[Currency] == $fcb1) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator1' size='3' value='$fix1 [SellingOperatorB]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate1' size='6' value='$fix1[SellingRateB]' readonly>
                     </td><td><input type=text name='quoadult1' size='12' value='$fix1[QuoAdultB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(1)'></td><td><input type='text' name='selladult1' value='$fix1[SellAdultB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd1' size='12' value='$fix1[QuoChdTwnB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(1)'></td><td><input type='text' name='sellchd1' value='$fix1[SellChdTwnB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx1' size='12' value='$fix1[QuoChdXbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(1)'></td><td><input type='text' name='sellchdx1' value='$fix1[SellChdXbedB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn1' size='12' value='$fix1[QuoChdNbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(1)'></td><td><input type='text' name='sellchdn1' value='$fix1[SellChdNbedB]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc2' size='25' value='$fix2[Description]'></td>
                     <td><center><select name='quotationcurr2' onchange='oncurr(2)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix2[QuotationCurrB] == '') {
                $fcb2 = 'IDR';
            } else {
                $fcb2 = $fix2[QuotationCurrB];
            }
            if ($s[Currency] == $fcb2) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator2' size='3' value='$fix2 [SellingOperatorB]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate2' size='6' value='$fix2[SellingRateB]' readonly>
                     </td><td><input type=text name='quoadult2' size='12' value='$fix2[QuoAdultB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(2)'></td><td><input type='text' name='selladult2' value='$fix2[SellAdultB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd2' size='12' value='$fix2[QuoChdTwnB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(2)'></td><td><input type='text' name='sellchd2'  value='$fix2[SellChdTwnB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx2' size='12' value='$fix2[QuoChdXbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(2)'></td><td><input type='text' name='sellchdx2' value='$fix2[SellChdXbedB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn2' size='12' value='$fix2[QuoChdNbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(2)'></td><td><input type='text' name='sellchdn2' value='$fix2[SellChdNbedB]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc3' size='25' value='$fix3[Description]'></td>
                     <td><center><select name='quotationcurr3' onchange='oncurr(3)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix3[QuotationCurrB] == '') {
                $fcb3 = 'IDR';
            } else {
                $fcb3 = $fix3[QuotationCurrB];
            }
            if ($s[Currency] == $fcb3) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator3' size='3' value='$fix3 [SellingOperatorB]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate3' size='6' value='$fix3[SellingRateB]' readonly>
                     </td><td><input type=text name='quoadult3' size='12' value='$fix3[QuoAdultB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(3)'></td><td><input type='text' name='selladult3' value='$fix3[SellAdultB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd3' size='12' value='$fix3[QuoChdTwnB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(3)'></td><td><input type='text' name='sellchd3'  value='$fix3[SellChdTwnB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx3' size='12' value='$fix3[QuoChdXbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(3)'></td><td><input type='text' name='sellchdx3' value='$fix3[SellChdXbedB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn3' size='12' value='$fix3[QuoChdNbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(3)'></td><td><input type='text' name='sellchdn3' value='$fix3[SellChdNbedB]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc4' size='25' value='$fix4[Description]'></td>
                     <td><center><select name='quotationcurr4' onchange='oncurr(4)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix4[QuotationCurrB] == '') {
                $fcb4 = 'IDR';
            } else {
                $fcb4 = $fix4[QuotationCurrB];
            }
            if ($s[Currency] == $fcb4) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator4' size='3' value='$fix4 [SellingOperatorB]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate4' size='6' value='$fix4[SellingRateB]' readonly>
                     </td><td><input type=text name='quoadult4' size='12' value='$fix4[QuoAdultB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(4)'></td><td><input type='text' name='selladult4'  value='$fix4[SellAdultB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd4' size='12' value='$fix4[QuoChdTwnB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(4)'></td><td><input type='text' name='sellchd4' value='$fix4[SellChdTwnB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx4' size='12' value='$fix4[QuoChdXbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(4)'></td><td><input type='text' name='sellchdx4' value='$fix4[SellChdXbedB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn4' size='12' value='$fix4[QuoChdNbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(4)'></td><td><input type='text' name='sellchdn4' value='$fix4[SellChdNbedB]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc5' size='25' value='$fix5[Description]'></td>
                     <td><center><select name='quotationcurr5' onchange='oncurr(5)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix5[QuotationCurrB] == '') {
                $fcb5 = 'IDR';
            } else {
                $fcb5 = $fix5[QuotationCurrB];
            }
            if ($s[Currency] == $fcb5) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator5' size='3' value='$fix5 [SellingOperatorB]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate5' size='6' value='$fix5[SellingRateB]' readonly>
                     </td><td><input type=text name='quoadult5' size='12' value='$fix5[QuoAdultB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(5)'></td><td><input type='text' name='selladult5'  value='$fix5[SellAdultB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd5' size='12' value='$fix5[QuoChdTwnB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(5)'></td><td><input type='text' name='sellchd5'  value='$fix5[SellChdTwnB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx5' size='12' value='$fix5[QuoChdXbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(5)'></td><td><input type='text' name='sellchdx5' value='$fix5[SellChdXbedB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn5' size='12' value='$fix5[QuoChdNbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(5)'></td><td><input type='text' name='sellchdn5' value='$fix5[SellChdNbedB]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc6' size='25' value='$fix6[Description]'></td>
                     <td><center><select name='quotationcurr6' onchange='oncurr(6)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix6[QuotationCurrB] == '') {
                $fcb6 = 'IDR';
            } else {
                $fcb6 = $fix6[QuotationCurrB];
            }
            if ($s[Currency] == $fcb6) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator6' size='3' value='$fix6 [SellingOperatorB]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate6' size='6' value='$fix6[SellingRateB]' readonly>
                     </td><td><input type=text name='quoadult6' size='12' value='$fix6[QuoAdultB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(6)'></td><td><input type='text' name='selladult6'  value='$fix6[SellAdultB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd6' size='12' value='$fix6[QuoChdTwnB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(6)'></td><td><input type='text' name='sellchd6' value='$fix6[SellChdTwnB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx6' size='12' value='$fix6[QuoChdXbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(6)'></td><td><input type='text' name='sellchdx6' value='$fix6[SellChdXbedB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn6' size='12' value='$fix6[QuoChdNbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(6)'></td><td><input type='text' name='sellchdn6' value='$fix6[SellChdNbedB]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc7' size='25' value='$fix7[Description]'></td>
                     <td><center><select name='quotationcurr7' onchange='oncurr(7)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix7[QuotationCurrB] == '') {
                $fcb7 = 'IDR';
            } else {
                $fcb7 = $fix7[QuotationCurrB];
            }
            if ($s[Currency] == $fcb7) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator7' size='3' value='$fix7 [SellingOperatorB]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate7' size='6' value='$fix7[SellingRateB]' readonly>
                     </td><td><input type=text name='quoadult7' size='12' value='$fix7[QuoAdultB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(7)'></td><td><input type='text' name='selladult7'  value='$fix7[SellAdultB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd7' size='12' value='$fix7[QuoChdTwnB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(7)'></td><td><input type='text' name='sellchd7' value='$fix7[SellChdTwnB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx7' size='12' value='$fix7[QuoChdXbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(7)'></td><td><input type='text' name='sellchdx7' value='$fix7[SellChdXbedB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn7' size='12' value='$fix7[QuoChdNbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(7)'></td><td><input type='text' name='sellchdn7' value='$fix7[SellChdNbedB]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc8' size='25' value='$fix8[Description]'></td>
                     <td><center><select name='quotationcurr8' onchange='oncurr(8)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix8[QuotationCurrB] == '') {
                $fcb8 = 'IDR';
            } else {
                $fcb8 = $fix8[QuotationCurrB];
            }
            if ($s[Currency] == $fcb8) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator8' size='3' value='$fix8 [SellingOperatorB]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate8' size='6' value='$fix8[SellingRateB]' readonly>
                     </td><td><input type=text name='quoadult8' size='12' value='$fix8[QuoAdultB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(8)'></td><td><input type='text' name='selladult8' value='$fix8[SellAdultB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd8' size='12' value='$fix8[QuoChdTwnB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(8)'></td><td><input type='text' name='sellchd8'  value='$fix8[SellChdTwnB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx8' size='12' value='$fix8[QuoChdXbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(8)'></td><td><input type='text' name='sellchdx8' value='$fix8[SellChdXbedB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn8' size='12' value='$fix8[QuoChdNbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(8)'></td><td><input type='text' name='sellchdn8' value='$fix8[SellChdNbedB]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc9' size='25' value='$fix9[Description]'></td>
                     <td><center><select name='quotationcurr9' onchange='oncurr(9)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix9[QuotationCurrB] == '') {
                $fcb9 = 'IDR';
            } else {
                $fcb9 = $fix9[QuotationCurrB];
            }
            if ($s[Currency] == $fcb9) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator9' size='3' value='$fix9 [SellingOperatorB]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate9' size='6' value='$fix9[SellingRateB]' readonly>
                     </td><td><input type=text name='quoadult9' size='12' value='$fix9[QuoAdultB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(9)'></td><td><input type='text' name='selladult9'  value='$fix9[SellAdultB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd9' size='12' value='$fix9[QuoChdTwnB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(9)'></td><td><input type='text' name='sellchd9'  value='$fix9[SellChdTwnB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx9' size='12' value='$fix9[QuoChdXbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(9)'></td><td><input type='text' name='sellchdx9' value='$fix9[SellChdXbedB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn9' size='12' value='$fix9[QuoChdNbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(9)'></td><td><input type='text' name='sellchdn9' value='$fix9[SellChdNbedB]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc10' size='25' value='$fix10[Description]'></td>
                     <td><center><select name='quotationcurr10' onchange='oncurr(10)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix10[QuotationCurrB] == '') {
                $fcb10 = 'IDR';
            } else {
                $fcb10 = $fix10[QuotationCurrB];
            }
            if ($s[Currency] == $fcb10) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator10' size='3' value='$fix10 [SellingOperatorB]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate10' size='6' value='$fix10[SellingRateB]' readonly>
                     </td><td><input type=text name='quoadult10' size='12' value='$fix10[QuoAdultB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(10)'></td><td><input type='text' name='selladult10' value='$fix10[SellAdultB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd10' size='12' value='$fix10[QuoChdTwnB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(10)'></td><td><input type='text' name='sellchd10' value='$fix10[SellChdTwnB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx10' size='12' value='$fix10[QuoChdXbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(10)'></td><td><input type='text' name='sellchdx10' value='$fix10[SellChdXbedB]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn10' size='12' value='$fix10[QuoChdNbedB]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(10)'></td><td><input type='text' name='sellchdn10' value='$fix10[SellChdNbedB]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
                    <tr><td colspan=4><b><i>TOTAL</td><td><input type='text' name='totaladulta' value='$totfix[TotalAdultB]' size='12' style='text-align: right;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdtwna' value='$totfix[TotalChdTwnB]' size='12' style='text-align: right;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdxbeda' value='$totfix[TotalChdXbedB]' size='12' style='text-align: right;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdnbeda' value='$totfix[TotalChdNbedB]' size='12' style='text-align: right;border: 0px solid #000000;' readonly></td></tr>
                    </tbody></table>
                    <br>
          <center><input type='submit' name='submit' value='Save'>
          </form>";
        break;

    case "saveb":
        $paxb = $_POST[paxb];
        $Description = "Update Fix Cost ($_POST[tourcode])";
        $Sup1 = strtoupper($_POST[supplier1]);
        $Desc1 = strtoupper($_POST[desc1]);
        mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult1]',
                                        SellAdultB = '$_POST[selladult1]',
                                        QuoChdTwnB = '$_POST[quochd1]',
                                        SellChdTwnB = '$_POST[sellchd1]',
                                        QuoChdXbedB = '$_POST[quochdx1]',
                                        SellChdXbedB = '$_POST[sellchdx1]',
                                        QuoChdNbedB = '$_POST[quochdn1]',
                                        SellChdNbedB = '$_POST[sellchdn1]',
                                        QuotationCurrB = '$_POST[quotationcurr1]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator1]',
                                        SellingRateB = '$_POST[sellingrate1]'
                                        WHERE Category = 'AGENT1' AND IDProduct = '$_POST[id]'");
        $Sup2 = strtoupper($_POST[supplier2]);
        $Desc2 = strtoupper($_POST[desc2]);
        mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult2]',
                                        SellAdultB = '$_POST[selladult2]',
                                        QuoChdTwnB = '$_POST[quochd2]',
                                        SellChdTwnB = '$_POST[sellchd2]',
                                        QuoChdXbedB = '$_POST[quochdx2]',
                                        SellChdXbedB = '$_POST[sellchdx2]',
                                        QuoChdNbedB = '$_POST[quochdn2]',
                                        SellChdNbedB = '$_POST[sellchdn2]',
                                        QuotationCurrB = '$_POST[quotationcurr2]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator2]',
                                        SellingRateB = '$_POST[sellingrate2]'
                                        WHERE Category = 'AGENT2' AND IDProduct = '$_POST[id]'");
        $Sup3 = strtoupper($_POST[supplier3]);
        $Desc3 = strtoupper($_POST[desc3]);
        mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult3]',
                                        SellAdultB = '$_POST[selladult3]',
                                        QuoChdTwnB = '$_POST[quochd3]',
                                        SellChdTwnB = '$_POST[sellchd3]',
                                        QuoChdXbedB = '$_POST[quochdx3]',
                                        SellChdXbedB = '$_POST[sellchdx3]',
                                        QuoChdNbedB = '$_POST[quochdn3]',
                                        SellChdNbedB = '$_POST[sellchdn3]',
                                        QuotationCurrB = '$_POST[quotationcurr3]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator3]',
                                        SellingRateB = '$_POST[sellingrate3]'
                                        WHERE Category = 'AGENT3' AND IDProduct = '$_POST[id]'");
        $Sup4 = strtoupper($_POST[supplier4]);
        $Desc4 = strtoupper($_POST[desc4]);
        mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult4]',
                                        SellAdultB = '$_POST[selladult4]',
                                        QuoChdTwnB = '$_POST[quochd4]',
                                        SellChdTwnB = '$_POST[sellchd4]',
                                        QuoChdXbedB = '$_POST[quochdx4]',
                                        SellChdXbedB = '$_POST[sellchdx4]' ,
                                        QuoChdNbedB = '$_POST[quochdn4]',
                                        SellChdNbedB = '$_POST[sellchdn4]',
                                        QuotationCurrB = '$_POST[quotationcurr4]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator4]',
                                        SellingRateB = '$_POST[sellingrate4]'
                                        WHERE Category = 'AGENT4' AND IDProduct = '$_POST[id]'");
        $Sup5 = strtoupper($_POST[supplier5]);
        $Desc5 = strtoupper($_POST[desc5]);
        mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult5]',
                                        SellAdultB = '$_POST[selladult5]',
                                        QuoChdTwnB = '$_POST[quochd5]',
                                        SellChdTwnB = '$_POST[sellchd5]',
                                        QuoChdXbedB = '$_POST[quochdx5]',
                                        SellChdXbedB = '$_POST[sellchdx5]',
                                        QuoChdNbedB = '$_POST[quochdn5]',
                                        SellChdNbedB = '$_POST[sellchdn5]',
                                        QuotationCurrB = '$_POST[quotationcurr5]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator5]',
                                        SellingRateB = '$_POST[sellingrate5]'
                                        WHERE Category = 'AGENT5' AND IDProduct = '$_POST[id]'");
        $Sup6 = strtoupper($_POST[supplier6]);
        $Desc6 = strtoupper($_POST[desc6]);
        mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult6]',
                                        SellAdultB = '$_POST[selladult6]',
                                        QuoChdTwnB = '$_POST[quochd6]',
                                        SellChdTwnB = '$_POST[sellchd6]',
                                        QuoChdXbedB = '$_POST[quochdx6]',
                                        SellChdXbedB = '$_POST[sellchdx6]',
                                        QuoChdNbedB = '$_POST[quochdn6]',
                                        SellChdNbedB = '$_POST[sellchdn6]',
                                        QuotationCurrB = '$_POST[quotationcurr6]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator6]',
                                        SellingRateB = '$_POST[sellingrate6]'
                                        WHERE Category = 'AGENT6' AND IDProduct = '$_POST[id]'");
        $Sup7 = strtoupper($_POST[supplier7]);
        $Desc7 = strtoupper($_POST[desc7]);
        mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult7]',
                                        SellAdultB = '$_POST[selladult7]',
                                        QuoChdTwnB = '$_POST[quochd7]',
                                        SellChdTwnB = '$_POST[sellchd7]',
                                        QuoChdXbedB = '$_POST[quochdx7]',
                                        SellChdXbedB = '$_POST[sellchdx7]',
                                        QuoChdNbedB = '$_POST[quochdn7]',
                                        SellChdNbedB = '$_POST[sellchdn7]',
                                        QuotationCurrB = '$_POST[quotationcurr7]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator7]',
                                        SellingRateB = '$_POST[sellingrate7]'
                                        WHERE Category = 'AGENT7' AND IDProduct = '$_POST[id]'");
        $Sup8 = strtoupper($_POST[supplier8]);
        $Desc8 = strtoupper($_POST[desc8]);
        mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult8]',
                                        SellAdultB = '$_POST[selladult8]',
                                        QuoChdTwnB = '$_POST[quochd8]',
                                        SellChdTwnB = '$_POST[sellchd8]',
                                        QuoChdXbedB = '$_POST[quochdx8]',
                                        SellChdXbedB = '$_POST[sellchdx8]',
                                        QuoChdNbedB = '$_POST[quochdn8]',
                                        SellChdNbedB = '$_POST[sellchdn8]',
                                        QuotationCurrB = '$_POST[quotationcurr8]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator8]',
                                        SellingRateB = '$_POST[sellingrate8]'
                                        WHERE Category = 'AGENT8' AND IDProduct = '$_POST[id]'");
        $Sup9 = strtoupper($_POST[supplier9]);
        $Desc9 = strtoupper($_POST[desc9]);
        mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult9]',
                                        SellAdultB = '$_POST[selladult9]',
                                        QuoChdTwnB = '$_POST[quochd9]',
                                        SellChdTwnB = '$_POST[sellchd9]',
                                        QuoChdXbedB = '$_POST[quochdx9]',
                                        SellChdXbedB = '$_POST[sellchdx9]',
                                        QuoChdNbedB = '$_POST[quochdn9]',
                                        SellChdNbedB = '$_POST[sellchdn9]',
                                        QuotationCurrB = '$_POST[quotationcurr9]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator9]',
                                        SellingRateB = '$_POST[sellingrate9]'
                                        WHERE Category = 'AGENT9' AND IDProduct = '$_POST[id]'");
        $Sup10 = strtoupper($_POST[supplier10]);
        $Desc10 = strtoupper($_POST[desc10]);
        mysql_query("UPDATE tour_agent set QuoAdultB = '$_POST[quoadult10]',
                                        SellAdultB = '$_POST[selladult10]',
                                        QuoChdTwnB = '$_POST[quochd10]',
                                        SellChdTwnB = '$_POST[sellchd10]',
                                        QuoChdXbedB = '$_POST[quochdx10]',
                                        SellChdXbedB = '$_POST[sellchdx10]',
                                        QuoChdNbedB = '$_POST[quochdn10]',
                                        SellChdNbedB = '$_POST[sellchdn10]',
                                        QuotationCurrB = '$_POST[quotationcurr10]',
                                        SellingCurrB = '$_POST[sellingcurr]',
                                        SellingOperatorB = '$_POST[sellingoperator10]',
                                        SellingRateB = '$_POST[sellingrate10]'
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
        $edit = mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
        $r = mysql_fetch_array($edit);
        $depdate = substr($r[DateTravelFrom], 8, 2);
        $pakerate = $r[DateTravelFrom];
        echo "<h2>AGENT COST (OPTION C) - $r[TourCode]</h2>
          <form method=POST name='calculate' action='?module=agent&act=savec'>
          <input type='hidden' name=id value='$r[IDProduct]'><input type='hidden' name='tourcode' value='$r[TourCode]'> 
          <input type='hidden' name='sellingoperator' value='$r[SellingOperator]'>
          <input type='hidden' name='sellingrate' value='$r[SellingRate]'>
          <input type='hidden' name='quotationcurr' value='$r[QuotationCurr]'>
          <input type='hidden' name='sellingcurr' value='$r[SellingCurr]'>";
        $cariperiod = mssql_query("SELECT TOP 1 * FROM AgingKurs
                                                        where StartDate <= '$pakerate' and EndDate >= '$pakerate' order by AgingKurs.IDHeader DESC");
        $periodrate = mssql_fetch_array($cariperiod);
        $carirate = mssql_query("SELECT Currency, ExRate FROM AgingKursDetails
                                                        where IDHeader = '$periodrate[IDHeader]'");
        while ($rateidr = mssql_fetch_array($carirate)) {
            echo "<input type='hidden' name='$rateidr[Currency]' value='$rateidr[ExRate]'>";
        }
        $isifix1 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT1' and IDProduct = '$r[IDProduct]' ");
        $fix1 = mysql_fetch_array($isifix1);
        $isifix2 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT2' and IDProduct = '$r[IDProduct]' ");
        $fix2 = mysql_fetch_array($isifix2);
        $isifix3 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT3' and IDProduct = '$r[IDProduct]' ");
        $fix3 = mysql_fetch_array($isifix3);
        $isifix4 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT4' and IDProduct = '$r[IDProduct]' ");
        $fix4 = mysql_fetch_array($isifix4);
        $isifix5 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT5' and IDProduct = '$r[IDProduct]' ");
        $fix5 = mysql_fetch_array($isifix5);
        $isifix6 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT6' and IDProduct = '$r[IDProduct]' ");
        $fix6 = mysql_fetch_array($isifix6);
        $isifix7 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT7' and IDProduct = '$r[IDProduct]' ");
        $fix7 = mysql_fetch_array($isifix7);
        $isifix8 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT8' and IDProduct = '$r[IDProduct]' ");
        $fix8 = mysql_fetch_array($isifix8);
        $isifix9 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT9' and IDProduct = '$r[IDProduct]' ");
        $fix9 = mysql_fetch_array($isifix9);
        $isifix10 = mysql_query("SELECT * FROM tour_agent
                                where Category = 'AGENT10' and IDProduct = '$r[IDProduct]' ");
        $fix10 = mysql_fetch_array($isifix10);
        $isitotal = mysql_query("SELECT * FROM tour_msdetail
                                where IDProduct = '$r[IDProduct]' ");
        $totfix = mysql_fetch_array($isitotal);
        if ($fix1[QuotationCurrC] == $r[SellingCurr]) {
            $ok1 = 'disabled';
        } else {
            $ok1 = 'enabled';
        }
        if ($fix2[QuotationCurrC] == $r[SellingCurr]) {
            $ok2 = 'disabled';
        } else {
            $ok2 = 'enabled';
        }
        if ($fix3[QuotationCurrC] == $r[SellingCurr]) {
            $ok3 = 'disabled';
        } else {
            $ok3 = 'enabled';
        }
        if ($fix4[QuotationCurrC] == $r[SellingCurr]) {
            $ok4 = 'disabled';
        } else {
            $ok4 = 'enabled';
        }
        if ($fix5[QuotationCurrC] == $r[SellingCurr]) {
            $ok5 = 'disabled';
        } else {
            $ok5 = 'enabled';
        }
        if ($fix6[QuotationCurrC] == $r[SellingCurr]) {
            $ok6 = 'disabled';
        } else {
            $ok6 = 'enabled';
        }
        if ($fix7[QuotationCurrC] == $r[SellingCurr]) {
            $ok7 = 'disabled';
        } else {
            $ok7 = 'enabled';
        }
        if ($fix8[QuotationCurrC] == $r[SellingCurr]) {
            $ok8 = 'disabled';
        } else {
            $ok8 = 'enabled';
        }
        if ($fix9[QuotationCurrC] == $r[SellingCurr]) {
            $ok9 = 'disabled';
        } else {
            $ok9 = 'enabled';
        }
        if ($fix10[QuotationCurrC] == $r[SellingCurr]) {
            $ok10 = 'disabled';
        } else {
            $ok10 = 'enabled';
        }
        echo "<table class='bordered' id='fixed_hdr2'>
            <thead>
            <tr><th></th><th></th><th></th>";
        if ($r[GroupType] == 'CRUISE') {
            echo "<th colspan=4>adult</th><th colspan=4>Child </th></tr></thead>
            <tr><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>PAX : <input type=text name='paxc' size='3' value='$totfix[PaxC]'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>quotation</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>1-2 PAX</td><td colspan=2>3-4 PAX</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>1-2 PAX</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>3-4 PAX </td></tr>";
        } else {
            echo "<th colspan=2>adult</th><th colspan=6>Child </th></tr></thead>
            <tr><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>PAX : <input type=text name='paxc' size='3' value='$totfix[PaxC]'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>quotation</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>Twin BED</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>Extra BED </td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>NO BED </td></tr>";
        }
        echo "<tr><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'><b>supplier</b></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>description</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>Curr - Operator - Rate</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>In $r[SellingCurr]</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>In $r[SellingCurr]</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>In $r[SellingCurr]</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>In $r[SellingCurr]</td></tr>
            <tbody>
                     <tr><td><select name='supplier1'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix1[Supplier] == $s[SupplierName]) {
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            } else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc1' size='25' value='$fix1[Description]'></td>
                     <td><center><select name='quotationcurr1' onchange='oncurr(1)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix1[QuotationCurrC] == '') {
                $fcc1 = 'IDR';
            } else {
                $fcc1 = $fix1[QuotationCurrC];
            }
            if ($s[Currency] == $fcc1) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator1' size='3' value='$fix1 [SellingOperatorC]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate1' size='6' value='$fix1[SellingRateC]' readonly>
                     </td><td><input type=text name='quoadult1' size='12' value='$fix1[QuoAdultC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(1)'></td><td><input type='text' name='selladult1' value='$fix1[SellAdultC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd1' size='12' value='$fix1[QuoChdTwnC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(1)'></td><td><input type='text' name='sellchd1' value='$fix1[SellChdTwnC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx1' size='12' value='$fix1[QuoChdXbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(1)'></td><td><input type='text' name='sellchdx1' value='$fix1[SellChdXbedC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn1' size='12' value='$fix1[QuoChdNbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(1)'></td><td><input type='text' name='sellchdn1' value='$fix1[SellChdNbedC]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc2' size='25' value='$fix2[Description]'></td>
                     <td><center><select name='quotationcurr2' onchange='oncurr(2)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix2[QuotationCurrC] == '') {
                $fcc2 = 'IDR';
            } else {
                $fcc2 = $fix2[QuotationCurrC];
            }
            if ($s[Currency] == $fcc2) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator2' size='3' value='$fix2 [SellingOperatorC]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate2' size='6' value='$fix2[SellingRateC]' readonly>
                     </td><td><input type=text name='quoadult2' size='12' value='$fix2[QuoAdultC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(2)'></td><td><input type='text' name='selladult2' value='$fix2[SellAdultC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd2' size='12' value='$fix2[QuoChdTwnC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(2)'></td><td><input type='text' name='sellchd2'  value='$fix2[SellChdTwnC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx2' size='12' value='$fix2[QuoChdXbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(2)'></td><td><input type='text' name='sellchdx2' value='$fix2[SellChdXbedC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn2' size='12' value='$fix2[QuoChdNbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(2)'></td><td><input type='text' name='sellchdn2' value='$fix2[SellChdNbedC]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc3' size='25' value='$fix3[Description]'></td>
                     <td><center><select name='quotationcurr3' onchange='oncurr(3)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix3[QuotationCurrC] == '') {
                $fcc3 = 'IDR';
            } else {
                $fcc3 = $fix3[QuotationCurrC];
            }
            if ($s[Currency] == $fcc3) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator3' size='3' value='$fix3 [SellingOperatorC]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate3' size='6' value='$fix3[SellingRateC]' readonly>
                     </td><td><input type=text name='quoadult3' size='12' value='$fix3[QuoAdultC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(3)'></td><td><input type='text' name='selladult3' value='$fix3[SellAdultC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd3' size='12' value='$fix3[QuoChdTwnC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(3)'></td><td><input type='text' name='sellchd3'  value='$fix3[SellChdTwnC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx3' size='12' value='$fix3[QuoChdXbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(3)'></td><td><input type='text' name='sellchdx3' value='$fix3[SellChdXbedC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn3' size='12' value='$fix3[QuoChdNbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(3)'></td><td><input type='text' name='sellchdn3' value='$fix3[SellChdNbedC]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc4' size='25' value='$fix4[Description]'></td>
                     <td><center><select name='quotationcurr4' onchange='oncurr(4)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix4[QuotationCurrC] == '') {
                $fcc4 = 'IDR';
            } else {
                $fcc4 = $fix4[QuotationCurrC];
            }
            if ($s[Currency] == $fcc4) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator4' size='3' value='$fix4 [SellingOperatorC]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate4' size='6' value='$fix4[SellingRateC]' readonly>
                     </td><td><input type=text name='quoadult4' size='12' value='$fix4[QuoAdultC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(4)'></td><td><input type='text' name='selladult4'  value='$fix4[SellAdultC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd4' size='12' value='$fix4[QuoChdTwnC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(4)'></td><td><input type='text' name='sellchd4' value='$fix4[SellChdTwnC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx4' size='12' value='$fix4[QuoChdXbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(4)'></td><td><input type='text' name='sellchdx4' value='$fix4[SellChdXbedC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn4' size='12' value='$fix4[QuoChdNbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(4)'></td><td><input type='text' name='sellchdn4' value='$fix4[SellChdNbedC]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc5' size='25' value='$fix5[Description]'></td>
                     <td><center><select name='quotationcurr5' onchange='oncurr(5)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix5[QuotationCurrC] == '') {
                $fcc5 = 'IDR';
            } else {
                $fcc5 = $fix5[QuotationCurrC];
            }
            if ($s[Currency] == $fcc5) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator5' size='3' value='$fix5 [SellingOperatorC]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate5' size='6' value='$fix5[SellingRateC]' readonly>
                     </td><td><input type=text name='quoadult5' size='12' value='$fix5[QuoAdultC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(5)'></td><td><input type='text' name='selladult5'  value='$fix5[SellAdultC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd5' size='12' value='$fix5[QuoChdTwnC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(5)'></td><td><input type='text' name='sellchd5'  value='$fix5[SellChdTwnC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx5' size='12' value='$fix5[QuoChdXbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(5)'></td><td><input type='text' name='sellchdx5' value='$fix5[SellChdXbedC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn5' size='12' value='$fix5[QuoChdNbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(5)'></td><td><input type='text' name='sellchdn5' value='$fix5[SellChdNbedC]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc6' size='25' value='$fix6[Description]'></td>
                     <td><center><select name='quotationcurr6' onchange='oncurr(6)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix6[QuotationCurrC] == '') {
                $fcc6 = 'IDR';
            } else {
                $fcc6 = $fix6[QuotationCurrC];
            }
            if ($s[Currency] == $fcc6) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator6' size='3' value='$fix6 [SellingOperatorC]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate6' size='6' value='$fix6[SellingRateC]' readonly>
                     </td><td><input type=text name='quoadult6' size='12' value='$fix6[QuoAdultC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(6)'></td><td><input type='text' name='selladult6'  value='$fix6[SellAdultC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd6' size='12' value='$fix6[QuoChdTwnC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(6)'></td><td><input type='text' name='sellchd6' value='$fix6[SellChdTwnC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx6' size='12' value='$fix6[QuoChdXbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(6)'></td><td><input type='text' name='sellchdx6' value='$fix6[SellChdXbedC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn6' size='12' value='$fix6[QuoChdNbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(6)'></td><td><input type='text' name='sellchdn6' value='$fix6[SellChdNbedC]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc7' size='25' value='$fix7[Description]'></td>
                     <td><center><select name='quotationcurr7' onchange='oncurr(7)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix7[QuotationCurrC] == '') {
                $fcc7 = 'IDR';
            } else {
                $fcc7 = $fix7[QuotationCurrC];
            }
            if ($s[Currency] == $fcc7) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator7' size='3' value='$fix7 [SellingOperatorC]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate7' size='6' value='$fix7[SellingRateC]' readonly>
                     </td><td><input type=text name='quoadult7' size='12' value='$fix7[QuoAdultC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(7)'></td><td><input type='text' name='selladult7'  value='$fix7[SellAdultC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd7' size='12' value='$fix7[QuoChdTwnC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(7)'></td><td><input type='text' name='sellchd7' value='$fix7[SellChdTwnC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx7' size='12' value='$fix7[QuoChdXbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(7)'></td><td><input type='text' name='sellchdx7' value='$fix7[SellChdXbedC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn7' size='12' value='$fix7[QuoChdNbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(7)'></td><td><input type='text' name='sellchdn7' value='$fix7[SellChdNbedC]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc8' size='25' value='$fix8[Description]'></td>
                     <td><center><select name='quotationcurr8' onchange='oncurr(8)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix8[QuotationCurrC] == '') {
                $fcc8 = 'IDR';
            } else {
                $fcc8 = $fix8[QuotationCurrC];
            }
            if ($s[Currency] == $fcc8) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator8' size='3' value='$fix8 [SellingOperatorC]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate8' size='6' value='$fix8[SellingRateC]' readonly>
                     </td><td><input type=text name='quoadult8' size='12' value='$fix8[QuoAdultC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(8)'></td><td><input type='text' name='selladult8' value='$fix8[SellAdultC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd8' size='12' value='$fix8[QuoChdTwnC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(8)'></td><td><input type='text' name='sellchd8'  value='$fix8[SellChdTwnC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx8' size='12' value='$fix8[QuoChdXbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(8)'></td><td><input type='text' name='sellchdx8' value='$fix8[SellChdXbedC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn8' size='12' value='$fix8[QuoChdNbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(8)'></td><td><input type='text' name='sellchdn8' value='$fix8[SellChdNbedC]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc9' size='25' value='$fix9[Description]'></td>
                     <td><center><select name='quotationcurr9' onchange='oncurr(9)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix9[QuotationCurrC] == '') {
                $fcc9 = 'IDR';
            } else {
                $fcc9 = $fix9[QuotationCurrC];
            }
            if ($s[Currency] == $fcc9) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator9' size='3' value='$fix9 [SellingOperatorC]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate9' size='6' value='$fix9[SellingRateC]' readonly>
                     </td><td><input type=text name='quoadult9' size='12' value='$fix9[QuoAdultC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(9)'></td><td><input type='text' name='selladult9'  value='$fix9[SellAdultC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd9' size='12' value='$fix9[QuoChdTwnC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(9)'></td><td><input type='text' name='sellchd9'  value='$fix9[SellChdTwnC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx9' size='12' value='$fix9[QuoChdXbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(9)'></td><td><input type='text' name='sellchdx9' value='$fix9[SellChdXbedC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn9' size='12' value='$fix9[QuoChdNbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(9)'></td><td><input type='text' name='sellchdn9' value='$fix9[SellChdNbedC]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
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
        echo "</select></td><td><input type=text name='desc10' size='25' value='$fix10[Description]'></td>
                     <td><center><select name='quotationcurr10' onchange='oncurr(10)'>";
        $tampil = mssql_query("SELECT Currency FROM AgingKursDetails Group By Currency ORDER BY Currency");
        while ($s = mssql_fetch_array($tampil)) {
            if ($fix10[QuotationCurrC] == '') {
                $fcc10 = 'IDR';
            } else {
                $fcc10 = $fix10[QuotationCurrC];
            }
            if ($s[Currency] == $fcc10) {
                echo "<option value='$s[Currency]' selected>$s[Currency]</option>";
            } else {
                echo "<option value='$s[Currency]' >$s[Currency]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator10' size='3' value='$fix10 [SellingOperatorC]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate10' size='6' value='$fix10[SellingRateC]' readonly>
                     </td><td><input type=text name='quoadult10' size='12' value='$fix10[QuoAdultC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(10)'></td><td><input type='text' name='selladult10' value='$fix10[SellAdultC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd10' size='12' value='$fix10[QuoChdTwnC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(10)'></td><td><input type='text' name='sellchd10' value='$fix10[SellChdTwnC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx10' size='12' value='$fix10[QuoChdXbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(10)'></td><td><input type='text' name='sellchdx10' value='$fix10[SellChdXbedC]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn10' size='12' value='$fix10[QuoChdNbedC]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(10)'></td><td><input type='text' name='sellchdn10' value='$fix10[SellChdNbedC]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
                    <tr><td colspan=4><b><i>TOTAL</td><td><input type='text' name='totaladulta' value='$totfix[TotalAdultC]' size='12' style='text-align: right;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdtwna' value='$totfix[TotalChdTwnC]' size='12' style='text-align: right;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdxbeda' value='$totfix[TotalChdXbedC]' size='12' style='text-align: right;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdnbeda' value='$totfix[TotalChdNbedC]' size='12' style='text-align: right;border: 0px solid #000000;' readonly></td></tr>
                    </tbody></table>
                    <br>
          <center><input type='submit' name='submit' value='Save'>
          </form>";
        break;

    case "savec":
        $paxc = $_POST[paxc];
        $Description = "Update Fix Cost ($_POST[tourcode])";
        $Sup1 = strtoupper($_POST[supplier1]);
        $Desc1 = strtoupper($_POST[desc1]);
        mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult1]',
                                        SellAdultC = '$_POST[selladult1]',
                                        QuoChdTwnC = '$_POST[quochd1]',
                                        SellChdTwnC = '$_POST[sellchd1]',
                                        QuoChdXbedC = '$_POST[quochdx1]',
                                        SellChdXbedC = '$_POST[sellchdx1]',
                                        QuoChdNbedC = '$_POST[quochdn1]',
                                        SellChdNbedC = '$_POST[sellchdn1]',
                                        QuotationCurrC = '$_POST[quotationcurr1]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator1]',
                                        SellingRateC = '$_POST[sellingrate1]'
                                        WHERE Category = 'AGENT1' AND IDProduct = '$_POST[id]'");
        $Sup2 = strtoupper($_POST[supplier2]);
        $Desc2 = strtoupper($_POST[desc2]);
        mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult2]',
                                        SellAdultC = '$_POST[selladult2]',
                                        QuoChdTwnC = '$_POST[quochd2]',
                                        SellChdTwnC = '$_POST[sellchd2]',
                                        QuoChdXbedC = '$_POST[quochdx2]',
                                        SellChdXbedC = '$_POST[sellchdx2]',
                                        QuoChdNbedC = '$_POST[quochdn2]',
                                        SellChdNbedC = '$_POST[sellchdn2]',
                                        QuotationCurrC = '$_POST[quotationcurr2]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator2]',
                                        SellingRateC = '$_POST[sellingrate2]'
                                        WHERE Category = 'AGENT2' AND IDProduct = '$_POST[id]'");
        $Sup3 = strtoupper($_POST[supplier3]);
        $Desc3 = strtoupper($_POST[desc3]);
        mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult3]',
                                        SellAdultC = '$_POST[selladult3]',
                                        QuoChdTwnC = '$_POST[quochd3]',
                                        SellChdTwnC = '$_POST[sellchd3]',
                                        QuoChdXbedC = '$_POST[quochdx3]',
                                        SellChdXbedC = '$_POST[sellchdx3]',
                                        QuoChdNbedC = '$_POST[quochdn3]',
                                        SellChdNbedC = '$_POST[sellchdn3]',
                                        QuotationCurrC = '$_POST[quotationcurr3]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator3]',
                                        SellingRateC = '$_POST[sellingrate3]'
                                        WHERE Category = 'AGENT3' AND IDProduct = '$_POST[id]'");
        $Sup4 = strtoupper($_POST[supplier4]);
        $Desc4 = strtoupper($_POST[desc4]);
        mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult4]',
                                        SellAdultC = '$_POST[selladult4]',
                                        QuoChdTwnC = '$_POST[quochd4]',
                                        SellChdTwnC = '$_POST[sellchd4]',
                                        QuoChdXbedC = '$_POST[quochdx4]',
                                        SellChdXbedC = '$_POST[sellchdx4]',
                                        QuoChdNbedC = '$_POST[quochdn4]',
                                        SellChdNbedC = '$_POST[sellchdn4]',
                                        QuotationCurrC = '$_POST[quotationcurr4]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator4]',
                                        SellingRateC = '$_POST[sellingrate4]'
                                        WHERE Category = 'AGENT4' AND IDProduct = '$_POST[id]'");
        $Sup5 = strtoupper($_POST[supplier5]);
        $Desc5 = strtoupper($_POST[desc5]);
        mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult5]',
                                        SellAdultC = '$_POST[selladult5]',
                                        QuoChdTwnC = '$_POST[quochd5]',
                                        SellChdTwnC = '$_POST[sellchd5]',
                                        QuoChdXbedC = '$_POST[quochdx5]',
                                        SellChdXbedC = '$_POST[sellchdx5]',
                                        QuoChdNbedC = '$_POST[quochdn5]',
                                        SellChdNbedC = '$_POST[sellchdn5]',
                                        QuotationCurrC = '$_POST[quotationcurr5]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator5]',
                                        SellingRateC = '$_POST[sellingrate5]'
                                        WHERE Category = 'AGENT5' AND IDProduct = '$_POST[id]'");
        $Sup6 = strtoupper($_POST[supplier6]);
        $Desc6 = strtoupper($_POST[desc6]);
        mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult6]',
                                        SellAdultC = '$_POST[selladult6]',
                                        QuoChdTwnC = '$_POST[quochd6]',
                                        SellChdTwnC = '$_POST[sellchd6]',
                                        QuoChdXbedC = '$_POST[quochdx6]',
                                        SellChdXbedC = '$_POST[sellchdx6]',
                                        QuoChdNbedC = '$_POST[quochdn6]',
                                        SellChdNbedC = '$_POST[sellchdn6]',
                                        QuotationCurrC = '$_POST[quotationcurr6]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator6]',
                                        SellingRateC = '$_POST[sellingrate6]'
                                        WHERE Category = 'AGENT6' AND IDProduct = '$_POST[id]'");
        $Sup7 = strtoupper($_POST[supplier7]);
        $Desc7 = strtoupper($_POST[desc7]);
        mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult7]',
                                        SellAdultC = '$_POST[selladult7]',
                                        QuoChdTwnC = '$_POST[quochd7]',
                                        SellChdTwnC = '$_POST[sellchd7]',
                                        QuoChdXbedC = '$_POST[quochdx7]',
                                        SellChdXbedC = '$_POST[sellchdx7]',
                                        QuoChdNbedC = '$_POST[quochdn7]',
                                        SellChdNbedC = '$_POST[sellchdn7]',
                                        QuotationCurrC = '$_POST[quotationcurr7]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator7]',
                                        SellingRateC = '$_POST[sellingrate7]'
                                        WHERE Category = 'AGENT7' AND IDProduct = '$_POST[id]'");
        $Sup8 = strtoupper($_POST[supplier8]);
        $Desc8 = strtoupper($_POST[desc8]);
        mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult8]',
                                        SellAdultC = '$_POST[selladult8]',
                                        QuoChdTwnC = '$_POST[quochd8]',
                                        SellChdTwnC = '$_POST[sellchd8]',
                                        QuoChdXbedC = '$_POST[quochdx8]',
                                        SellChdXbedC = '$_POST[sellchdx8]',
                                        QuoChdNbedC = '$_POST[quochdn8]',
                                        SellChdNbedC = '$_POST[sellchdn8]',
                                        QuotationCurrC = '$_POST[quotationcurr8]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator8]',
                                        SellingRateC = '$_POST[sellingrate8]'
                                        WHERE Category = 'AGENT8' AND IDProduct = '$_POST[id]'");
        $Sup9 = strtoupper($_POST[supplier9]);
        $Desc9 = strtoupper($_POST[desc9]);
        mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult9]',
                                        SellAdultC = '$_POST[selladult9]',
                                        QuoChdTwnC = '$_POST[quochd9]',
                                        SellChdTwnC = '$_POST[sellchd9]',
                                        QuoChdXbedC = '$_POST[quochdx9]',
                                        SellChdXbedC = '$_POST[sellchdx9]',
                                        QuoChdNbedC = '$_POST[quochdn9]',
                                        SellChdNbedC = '$_POST[sellchdn9]',
                                        QuotationCurrC = '$_POST[quotationcurr9]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator9]',
                                        SellingRateC = '$_POST[sellingrate9]'
                                        WHERE Category = 'AGENT9' AND IDProduct = '$_POST[id]'");
        $Sup10 = strtoupper($_POST[supplier10]);
        $Desc10 = strtoupper($_POST[desc10]);
        mysql_query("UPDATE tour_agent set QuoAdultC = '$_POST[quoadult10]',
                                        SellAdultC = '$_POST[selladult10]',
                                        QuoChdTwnC = '$_POST[quochd10]',
                                        SellChdTwnC = '$_POST[sellchd10]',
                                        QuoChdXbedC = '$_POST[quochdx10]',
                                        SellChdXbedC = '$_POST[sellchdx10]',
                                        QuoChdNbedC = '$_POST[quochdn10]',
                                        SellChdNbedC = '$_POST[sellchdn10]',
                                        QuotationCurrC = '$_POST[quotationcurr10]',
                                        SellingCurrC = '$_POST[sellingcurr]',
                                        SellingOperatorC = '$_POST[sellingoperator10]',
                                        SellingRateC = '$_POST[sellingrate10]'
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
