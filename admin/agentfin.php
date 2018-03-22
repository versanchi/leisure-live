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
            { width: 250, align: 'center' },
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
//include "../config/koneksisql.php";
include "../config/koneksimaster.php";
switch($_GET[act]){
    // Tampil Office
    default:
        $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
        $r=mysql_fetch_array($edit);
        $depdate = substr($r[DateTravelFrom],8,2);
        $pakerate=$r[DateTravelFrom];
        $optfin=$_GET[op];
        echo "<h2>AGENT COST (OPTION $optfin) - $r[TourCode]</h2>
          <form method=POST name='calculate' action='?module=agentfin&act=save'>
          <input type='hidden' name=id value='$r[IDProduct]'><input type='hidden' name='tourcode' value='$r[TourCode]'> 
          <input type='hidden' name='sellingoperator' value='$r[SellingOperator]'>
          <input type='hidden' name='sellingrate' value='$r[SellingRate]'>
          <input type='hidden' name='quotationcurr' value='$r[QuotationCurr]'>
          <input type='hidden' name='sellingcurr' value='$r[SellingCurr]'>";
        /*$carirate=mssql_query("SELECT * FROM Currency_Details
                                        where StartDate <= '$pakerate' and EndDate >= '$pakerate' order by IDDetail DESC");*/
        $cariperiod=mssql_query("SELECT TOP 1 * FROM AgingKurs
                                                where StartDate <= '$pakerate' and EndDate >= '$pakerate' order by AgingKurs.IDHeader DESC");
        $periodrate=mssql_fetch_array($cariperiod);
        $carirate=mssql_query("SELECT * FROM AgingKursDetails
                                                where IDHeader = '$periodrate[IDHeader]'");
        while($rateidr=mssql_fetch_array($carirate)){echo"<input type='hidden' name='$rateidr[Currency]' value='$rateidr[ExRate]'>";}
        $isifix1=mysql_query("SELECT * FROM tour_agentfinal
                                where Category = 'AGENT1' and IDProduct = '$r[IDProduct]' ");
        $fix1=mysql_fetch_array($isifix1);
        $isifix2=mysql_query("SELECT * FROM tour_agentfinal
                                where Category = 'AGENT2' and IDProduct = '$r[IDProduct]' ");
        $fix2=mysql_fetch_array($isifix2);
        $isifix3=mysql_query("SELECT * FROM tour_agentfinal
                                where Category = 'AGENT3' and IDProduct = '$r[IDProduct]' ");
        $fix3=mysql_fetch_array($isifix3);
        $isifix4=mysql_query("SELECT * FROM tour_agentfinal
                                where Category = 'AGENT4' and IDProduct = '$r[IDProduct]' ");
        $fix4=mysql_fetch_array($isifix4);
        $isifix5=mysql_query("SELECT * FROM tour_agentfinal
                                where Category = 'AGENT5' and IDProduct = '$r[IDProduct]' ");
        $fix5=mysql_fetch_array($isifix5);
        $isifix6=mysql_query("SELECT * FROM tour_agentfinal
                                where Category = 'AGENT6' and IDProduct = '$r[IDProduct]' ");
        $fix6=mysql_fetch_array($isifix6);
        $isifix7=mysql_query("SELECT * FROM tour_agentfinal
                                where Category = 'AGENT7' and IDProduct = '$r[IDProduct]' ");
        $fix7=mysql_fetch_array($isifix7);
        $isifix8=mysql_query("SELECT * FROM tour_agentfinal
                                where Category = 'AGENT8' and IDProduct = '$r[IDProduct]' ");
        $fix8=mysql_fetch_array($isifix8);
        $isifix9=mysql_query("SELECT * FROM tour_agentfinal
                                where Category = 'AGENT9' and IDProduct = '$r[IDProduct]' ");
        $fix9=mysql_fetch_array($isifix9);
        $isifix10=mysql_query("SELECT * FROM tour_agentfinal
                                where Category = 'AGENT10' and IDProduct = '$r[IDProduct]' ");
        $fix10=mysql_fetch_array($isifix10);
        $isitotal=mysql_query("SELECT * FROM tour_msdetailfinal
                                where IDProduct = '$r[IDProduct]' ");
        $totfix=mysql_fetch_array($isitotal);
        if($totfix[TotalAdult] > 0 OR $totfix[TotalChdTwn] > 0 OR $totfix[TotalChdXbed] > 0 OR $totfix[TotalChdNbed] > 0)
        {$tampil1='enable';}else{$tampil1='disabled';}

        echo "<table class='bordered' id='fixed_hdr2'>
<thead><th></th><th></th><th></th><th colspan='8'></th></thead>
                  <tr><th></th><th></th><th></th>";
        if($r[GroupType]=='CRUISE'){
            echo "<th colspan=4>adult</th><th colspan=4>Child </th></tr>
                  <tr><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>PAX : <input type=text name='paxa' size='3' value='$totfix[Pax]'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>quotation</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>1-2 PAX</td><td colspan=2>3-4 PAX</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>1-2 PAX</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>3-4 PAX </td></tr>";
        }else{
            echo "<th colspan=2>adult</th><th colspan=6>Child </th></tr>
                  <tr><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>PAX : <input type=text name='paxa' size='3' value='$totfix[Pax]'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>quotation</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>Twin BED</td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>Extra BED </td><td colspan=2 style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>NO BED </td></tr>";
        }
        echo "<tr><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'><b>supplier</b></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>description</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>Curr - Operator - Rate</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>In $r[SellingCurr]</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>In $r[SellingCurr]</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>In $r[SellingCurr]</td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'></td><td style='color: #FFFFFF;font-size: 7pt;text-transform: uppercase;text-align: center;background-color: #000000;'>In $r[SellingCurr]</td></tr>

<tbody>
                    <tr><td width='250'><select name='supplier1'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($fix1[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc1' size='30' value='$fix1[Description]'></td>
                     <td><center><select name='quotationcurr1' onchange='oncurr(1)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($fix1[QuotationCurr]==''){$fca1='IDR';}else{$fca1=$fix1[QuotationCurr];}
            if($s[curr]==$fca1){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator1' size='3' value='$fix1[SellingOperator]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate1' size='6' value='$fix1[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult1' size='12' value='$fix1[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(1)'></td><td><input type='text' name='selladult1' value='$fix1[SellAdult]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd1' size='12' value='$fix1[QuoChdTwn]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(1)'></td><td><input type='text' name='sellchd1' value='$fix1[SellChdTwn]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx1' size='12' value='$fix1[QuoChdXbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(1)'></td><td><input type='text' name='sellchdx1' value='$fix1[SellChdXbed]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn1' size='12' value='$fix1[QuoChdNbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(1)'></td><td><input type='text' name='sellchdn1' value='$fix1[SellChdNbed]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
                     <tr><td><select name='supplier2'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($fix2[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc2' size='30' value='$fix2[Description]'></td>
                     <td><center><select name='quotationcurr2' onchange='oncurr(2)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($fix2[QuotationCurr]==''){$fca2='IDR';}else{$fca2=$fix2[QuotationCurr];}
            if($s[curr]==$fca2){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator2' size='3' value='$fix2[SellingOperator]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate2' size='6' value='$fix2[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult2' size='12' value='$fix2[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(2)'></td><td><input type='text' name='selladult2' value='$fix2[SellAdult]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd2' size='12' value='$fix2[QuoChdTwn]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(2)'></td><td><input type='text' name='sellchd2'  value='$fix2[SellChdTwn]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx2' size='12' value='$fix2[QuoChdXbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(2)'></td><td><input type='text' name='sellchdx2' value='$fix2[SellChdXbed]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn2' size='12' value='$fix2[QuoChdNbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(2)'></td><td><input type='text' name='sellchdn2' value='$fix2[SellChdNbed]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
                     <tr><td><select name='supplier3'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($fix3[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc3' size='30' value='$fix3[Description]'></td>
                     <td><center><select name='quotationcurr3' onchange='oncurr(3)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($fix3[QuotationCurr]==''){$fca3='IDR';}else{$fca3=$fix3[QuotationCurr];}
            if($s[curr]==$fca3){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator3' size='3' value='$fix3[SellingOperator]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate3' size='6' value='$fix3[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult3' size='12' value='$fix3[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(3)'></td><td><input type='text' name='selladult3' value='$fix3[SellAdult]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd3' size='12' value='$fix3[QuoChdTwn]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(3)'></td><td><input type='text' name='sellchd3'  value='$fix3[SellChdTwn]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx3' size='12' value='$fix3[QuoChdXbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(3)'></td><td><input type='text' name='sellchdx3' value='$fix3[SellChdXbed]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn3' size='12' value='$fix3[QuoChdNbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(3)'></td><td><input type='text' name='sellchdn3' value='$fix3[SellChdNbed]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
                     <tr><td><select name='supplier4'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($fix4[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc4' size='30' value='$fix4[Description]'></td>
                     <td><center><select name='quotationcurr4' onchange='oncurr(4)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($fix4[QuotationCurr]==''){$fca4='IDR';}else{$fca4=$fix4[QuotationCurr];}
            if($s[curr]==$fca4){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator4' size='3' value='$fix4[SellingOperator]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate4' size='6' value='$fix4[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult4' size='12' value='$fix4[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(4)'></td><td><input type='text' name='selladult4'  value='$fix4[SellAdult]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd4' size='12' value='$fix4[QuoChdTwn]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(4)'></td><td><input type='text' name='sellchd4' value='$fix4[SellChdTwn]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx4' size='12' value='$fix4[QuoChdXbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(4)'></td><td><input type='text' name='sellchdx4' value='$fix4[SellChdXbed]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn4' size='12' value='$fix4[QuoChdNbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(4)'></td><td><input type='text' name='sellchdn4' value='$fix4[SellChdNbed]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
                     <tr><td><select name='supplier5'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($fix5[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc5' size='30' value='$fix5[Description]'></td>
                     <td><center><select name='quotationcurr5' onchange='oncurr(5)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($fix5[QuotationCurr]==''){$fca5='IDR';}else{$fca5=$fix5[QuotationCurr];}
            if($s[curr]==$fca5){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator5' size='3' value='$fix5[SellingOperator]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate5' size='6' value='$fix5[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult5' size='12' value='$fix5[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(5)'></td><td><input type='text' name='selladult5'  value='$fix5[SellAdult]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd5' size='12' value='$fix5[QuoChdTwn]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(5)'></td><td><input type='text' name='sellchd5'  value='$fix5[SellChdTwn]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx5' size='12' value='$fix5[QuoChdXbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(5)'></td><td><input type='text' name='sellchdx5' value='$fix5[SellChdXbed]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn5' size='12' value='$fix5[QuoChdNbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(5)'></td><td><input type='text' name='sellchdn5' value='$fix5[SellChdNbed]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
                     <tr><td><select name='supplier6'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($fix6[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc6' size='30' value='$fix6[Description]'></td>
                     <td><center><select name='quotationcurr6' onchange='oncurr(6)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($fix6[QuotationCurr]==''){$fca6='IDR';}else{$fca6=$fix6[QuotationCurr];}
            if($s[curr]==$fca6){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator6' size='3' value='$fix6[SellingOperator]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate6' size='6' value='$fix6[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult6' size='12' value='$fix6[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(6)'></td><td><input type='text' name='selladult6'  value='$fix6[SellAdult]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd6' size='12' value='$fix6[QuoChdTwn]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(6)'></td><td><input type='text' name='sellchd6' value='$fix6[SellChdTwn]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx6' size='12' value='$fix6[QuoChdXbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(6)'></td><td><input type='text' name='sellchdx6' value='$fix6[SellChdXbed]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn6' size='12' value='$fix6[QuoChdNbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(6)'></td><td><input type='text' name='sellchdn6' value='$fix6[SellChdNbed]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
                     <tr><td><select name='supplier7'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($fix7[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc7' size='30' value='$fix7[Description]'></td>
                     <td><center><select name='quotationcurr7' onchange='oncurr(7)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($fix7[QuotationCurr]==''){$fca7='IDR';}else{$fca7=$fix7[QuotationCurr];}
            if($s[curr]==$fca7){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator7' size='3' value='$fix7[SellingOperator]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate7' size='6' value='$fix7[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult7' size='12' value='$fix7[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(7)'></td><td><input type='text' name='selladult7'  value='$fix7[SellAdult]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd7' size='12' value='$fix7[QuoChdTwn]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(7)'></td><td><input type='text' name='sellchd7' value='$fix7[SellChdTwn]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx7' size='12' value='$fix7[QuoChdXbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(7)'></td><td><input type='text' name='sellchdx7' value='$fix7[SellChdXbed]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn7' size='12' value='$fix7[QuoChdNbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(7)'></td><td><input type='text' name='sellchdn7' value='$fix7[SellChdNbed]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
                     <tr><td><select name='supplier8'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($fix8[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc8' size='30' value='$fix8[Description]'></td>
                     <td><center><select name='quotationcurr8' onchange='oncurr(8)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($fix8[QuotationCurr]==''){$fca8='IDR';}else{$fca8=$fix8[QuotationCurr];}
            if($s[curr]==$fca8){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator8' size='3' value='$fix8[SellingOperator]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate8' size='6' value='$fix8[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult8' size='12' value='$fix8[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(8)'></td><td><input type='text' name='selladult8' value='$fix8[SellAdult]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd8' size='12' value='$fix8[QuoChdTwn]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(8)'></td><td><input type='text' name='sellchd8'  value='$fix8[SellChdTwn]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx8' size='12' value='$fix8[QuoChdXbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(8)'></td><td><input type='text' name='sellchdx8' value='$fix8[SellChdXbed]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn8' size='12' value='$fix8[QuoChdNbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(8)'></td><td><input type='text' name='sellchdn8' value='$fix8[SellChdNbed]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
                     <tr><td><select name='supplier9'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($fix9[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc9' size='30' value='$fix9[Description]'></td>
                     <td><center><select name='quotationcurr9' onchange='oncurr(9)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($fix9[QuotationCurr]==''){$fca9='IDR';}else{$fca9=$fix9[QuotationCurr];}
            if($s[curr]==$fca9){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator9' size='3' value='$fix9[SellingOperator]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate9' size='6' value='$fix9[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult9' size='12' value='$fix9[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(9)'></td><td><input type='text' name='selladult9'  value='$fix9[SellAdult]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd9' size='12' value='$fix9[QuoChdTwn]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(9)'></td><td><input type='text' name='sellchd9'  value='$fix9[SellChdTwn]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx9' size='12' value='$fix9[QuoChdXbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(9)'></td><td><input type='text' name='sellchdx9' value='$fix9[SellChdXbed]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn9' size='12' value='$fix9[QuoChdNbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(9)'></td><td><input type='text' name='sellchdn9' value='$fix9[SellChdNbed]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
                     <tr><td><select name='supplier10'>
                    <option value='' selected>- Select Supplier -</option>";
        $tampil = mssql_query("SELECT SupplierName FROM Supplier where Active = '1' order by SupplierName");
        while ($s = mssql_fetch_array($tampil)) {
            if($fix10[Supplier]==$s[SupplierName]){
                echo "<option value='$s[SupplierName]' selected>$s[SupplierName]</option>";
            }else {
                echo "<option value='$s[SupplierName]'>$s[SupplierName]</option>";
            }
        }
        echo "</select></td><td><input type=text name='desc10' size='30' value='$fix10[Description]'></td>
                     <td><center><select name='quotationcurr10' onchange='oncurr(10)'>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($fix10[QuotationCurr]==''){$fca10='IDR';}else{$fca10=$fix10[QuotationCurr];}
            if($s[curr]==$fca10){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select><input type='hidden' name='sellingoperator10' size='3' value='$fix10[SellingOperator]' > <font size='1'>x</font>
                                <input type='text' style='border: hidden;text-align:left;' name='sellingrate10' size='6' value='$fix10[SellingRate]' readonly>
                     </td><td><input type=text name='quoadult10' size='12' value='$fix10[QuoAdult]' style='text-align:right' onkeyup='isNumber(this);UpdateSellA(10)'></td><td><input type='text' name='selladult10' value='$fix10[SellAdult]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochd10' size='12' value='$fix10[QuoChdTwn]' style='text-align:right' onkeyup='isNumber(this);UpdateSellC(10)'></td><td><input type='text' name='sellchd10' value='$fix10[SellChdTwn]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdx10' size='12' value='$fix10[QuoChdXbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellD(10)'></td><td><input type='text' name='sellchdx10' value='$fix10[SellChdXbed]' style='text-align:right;border: hidden;' size='12' readonly></td>
                     <td><input type=text name='quochdn10' size='12' value='$fix10[QuoChdNbed]' style='text-align:right' onkeyup='isNumber(this);UpdateSellN(10)'></td><td><input type='text' name='sellchdn10' value='$fix10[SellChdNbed]' style='text-align:right;border: hidden;' size='12' readonly></td></tr>
                    <tr><td colspan=4><b><i>TOTAL</td><td><input type='text' name='totaladulta' value='$totfix[TotalAdult]' size='12' style='text-align: right;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdtwna' value='$totfix[TotalChdTwn]' size='12' style='text-align: right;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdxbeda' value='$totfix[TotalChdXbed]' size='12' style='text-align: right;border: 0px solid #000000;' readonly></td>
                    <td></td><td><input type='text' name='totalchdnbeda' value='$totfix[TotalChdNbed]' size='12' style='text-align: right;border: 0px solid #000000;' readonly></td></tr>
                    </tbody>
                    </table>
          <br>
          <center><input type='submit' name='submit' value='Save'>
          </form>";
        break;

    case "save":
  $paxa=$_POST[paxa];                   
  $Description="Update Final Agent Cost ($_POST[tourcode])"; 
  $Sup1=strtoupper($_POST[supplier1]);
  $Desc1=strtoupper($_POST[desc1]);
   mysql_query("UPDATE tour_agentfinal set Supplier = '$Sup1',
                                        Description = '$Desc1', 
                                        QuoAdult = '$_POST[quoadult1]',
                                        SellAdult = '$_POST[selladult1]',
                                        QuoChdTwn = '$_POST[quochd1]',
                                        SellChdTwn = '$_POST[sellchd1]',
                                        QuoChdXbed = '$_POST[quochdx1]',
                                        SellChdXbed = '$_POST[sellchdx1]',
                                        QuoChdNbed = '$_POST[quochdn1]',
                                        SellChdNbed = '$_POST[sellchdn1]',
                                        QuotationCurr = '$_POST[quotationcurr1]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator1]',
                                        SellingRate = '$_POST[sellingrate1]'
                                        WHERE Category = 'AGENT1' AND IDProduct = '$_POST[id]'");
  $Sup2=strtoupper($_POST[supplier2]);
  $Desc2=strtoupper($_POST[desc2]);
  mysql_query("UPDATE tour_agentfinal set Supplier = '$Sup2',
                                        Description = '$Desc2',
                                        QuoAdult = '$_POST[quoadult2]',
                                        SellAdult = '$_POST[selladult2]',
                                        QuoChdTwn = '$_POST[quochd2]',
                                        SellChdTwn = '$_POST[sellchd2]',
                                        QuoChdXbed = '$_POST[quochdx2]',
                                        SellChdXbed = '$_POST[sellchdx2]',
                                        QuoChdNbed = '$_POST[quochdn2]',
                                        SellChdNbed = '$_POST[sellchdn2]',
                                        QuotationCurr = '$_POST[quotationcurr2]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator2]',
                                        SellingRate = '$_POST[sellingrate2]'
                                        WHERE Category = 'AGENT2' AND IDProduct = '$_POST[id]'");
  $Sup3=strtoupper($_POST[supplier3]);
  $Desc3=strtoupper($_POST[desc3]);
  mysql_query("UPDATE tour_agentfinal set Supplier = '$Sup3',
                                        Description = '$Desc3',
                                        QuoAdult = '$_POST[quoadult3]',
                                        SellAdult = '$_POST[selladult3]',
                                        QuoChdTwn = '$_POST[quochd3]',
                                        SellChdTwn = '$_POST[sellchd3]',
                                        QuoChdXbed = '$_POST[quochdx3]',
                                        SellChdXbed = '$_POST[sellchdx3]',
                                        QuoChdNbed = '$_POST[quochdn3]',
                                        SellChdNbed = '$_POST[sellchdn3]',
                                        QuotationCurr = '$_POST[quotationcurr3]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator3]',
                                        SellingRate = '$_POST[sellingrate3]'
                                        WHERE Category = 'AGENT3' AND IDProduct = '$_POST[id]'");
  $Sup4=strtoupper($_POST[supplier4]);
  $Desc4=strtoupper($_POST[desc4]);
  mysql_query("UPDATE tour_agentfinal set Supplier = '$Sup4',
                                        Description = '$Desc4',
                                        QuoAdult = '$_POST[quoadult4]',
                                        SellAdult = '$_POST[selladult4]',
                                        QuoChdTwn = '$_POST[quochd4]',
                                        SellChdTwn = '$_POST[sellchd4]',
                                        QuoChdXbed = '$_POST[quochdx4]',
                                        SellChdXbed = '$_POST[sellchdx4]',
                                        QuoChdNbed = '$_POST[quochdn4]',
                                        SellChdNbed = '$_POST[sellchdn4]',
                                        QuotationCurr = '$_POST[quotationcurr4]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator4]',
                                        SellingRate = '$_POST[sellingrate4]'
                                        WHERE Category = 'AGENT4' AND IDProduct = '$_POST[id]'");
  $Sup5=strtoupper($_POST[supplier5]);
  $Desc5=strtoupper($_POST[desc5]);
  mysql_query("UPDATE tour_agentfinal set Supplier = '$Sup5',
                                        Description = '$Desc5',
                                        QuoAdult = '$_POST[quoadult5]',
                                        SellAdult = '$_POST[selladult5]',
                                        QuoChdTwn = '$_POST[quochd5]',
                                        SellChdTwn = '$_POST[sellchd5]',
                                        QuoChdXbed = '$_POST[quochdx5]',
                                        SellChdXbed = '$_POST[sellchdx5]',
                                        QuoChdNbed = '$_POST[quochdn5]',
                                        SellChdNbed = '$_POST[sellchdn5]',
                                        QuotationCurr = '$_POST[quotationcurr5]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator5]',
                                        SellingRate = '$_POST[sellingrate5]'
                                        WHERE Category = 'AGENT5' AND IDProduct = '$_POST[id]'");
  $Sup6=strtoupper($_POST[supplier6]);
  $Desc6=strtoupper($_POST[desc6]);
  mysql_query("UPDATE tour_agentfinal set Supplier = '$Sup6',
                                        Description = '$Desc6',
                                        QuoAdult = '$_POST[quoadult6]',
                                        SellAdult = '$_POST[selladult6]',
                                        QuoChdTwn = '$_POST[quochd6]',
                                        SellChdTwn = '$_POST[sellchd6]',
                                        QuoChdXbed = '$_POST[quochdx6]',
                                        SellChdXbed = '$_POST[sellchdx6]',
                                        QuoChdNbed = '$_POST[quochdn6]',
                                        SellChdNbed = '$_POST[sellchdn6]',
                                        QuotationCurr = '$_POST[quotationcurr6]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator6]',
                                        SellingRate = '$_POST[sellingrate6]'
                                        WHERE Category = 'AGENT6' AND IDProduct = '$_POST[id]'");
  $Sup7=strtoupper($_POST[supplier7]);
  $Desc7=strtoupper($_POST[desc7]);
  mysql_query("UPDATE tour_agentfinal set Supplier = '$Sup7',
                                        Description = '$Desc7',
                                        QuoAdult = '$_POST[quoadult7]',
                                        SellAdult = '$_POST[selladult7]',
                                        QuoChdTwn = '$_POST[quochd7]',
                                        SellChdTwn = '$_POST[sellchd7]',
                                        QuoChdXbed = '$_POST[quochdx7]',
                                        SellChdXbed = '$_POST[sellchdx7]',
                                        QuoChdNbed = '$_POST[quochdn7]',
                                        SellChdNbed = '$_POST[sellchdn7]',
                                        QuotationCurr = '$_POST[quotationcurr7]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator7]',
                                        SellingRate = '$_POST[sellingrate7]'
                                        WHERE Category = 'AGENT7' AND IDProduct = '$_POST[id]'");
  $Sup8=strtoupper($_POST[supplier8]);
  $Desc8=strtoupper($_POST[desc8]);
  mysql_query("UPDATE tour_agentfinal set Supplier = '$Sup8',
                                        Description = '$Desc8',
                                        QuoAdult = '$_POST[quoadult8]',
                                        SellAdult = '$_POST[selladult8]',
                                        QuoChdTwn = '$_POST[quochd8]',
                                        SellChdTwn = '$_POST[sellchd8]',
                                        QuoChdXbed = '$_POST[quochdx8]',
                                        SellChdXbed = '$_POST[sellchdx8]',
                                        QuoChdNbed = '$_POST[quochdn8]',
                                        SellChdNbed = '$_POST[sellchdn8]',
                                        QuotationCurr = '$_POST[quotationcurr8]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator8]',
                                        SellingRate = '$_POST[sellingrate8]'
                                        WHERE Category = 'AGENT8' AND IDProduct = '$_POST[id]'");
  $Sup9=strtoupper($_POST[supplier9]);
  $Desc9=strtoupper($_POST[desc9]);
  mysql_query("UPDATE tour_agentfinal set Supplier = '$Sup9',
                                        Description = '$Desc9',
                                        QuoAdult = '$_POST[quoadult9]',
                                        SellAdult = '$_POST[selladult9]',
                                        QuoChdTwn = '$_POST[quochd9]',
                                        SellChdTwn = '$_POST[sellchd9]',
                                        QuoChdXbed = '$_POST[quochdx9]',
                                        SellChdXbed = '$_POST[sellchdx9]',
                                        QuoChdNbed = '$_POST[quochdn9]',
                                        SellChdNbed = '$_POST[sellchdn9]',
                                        QuotationCurr = '$_POST[quotationcurr9]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator9]',
                                        SellingRate = '$_POST[sellingrate9]'
                                        WHERE Category = 'AGENT9' AND IDProduct = '$_POST[id]'");
  $Sup10=strtoupper($_POST[supplier10]);
  $Desc10=strtoupper($_POST[desc10]);
  mysql_query("UPDATE tour_agentfinal set Supplier = '$Sup10',
                                        Description = '$Desc10',
                                        QuoAdult = '$_POST[quoadult10]',
                                        SellAdult = '$_POST[selladult10]',
                                        QuoChdTwn = '$_POST[quochd10]',
                                        SellChdTwn = '$_POST[sellchd10]',
                                        QuoChdXbed = '$_POST[quochdx10]',
                                        SellChdXbed = '$_POST[sellchdx10]',
                                        QuoChdNbed = '$_POST[quochdn10]',
                                        SellChdNbed = '$_POST[sellchdn10]',
                                        QuotationCurr = '$_POST[quotationcurr10]',
                                        SellingCurr = '$_POST[sellingcurr]',
                                        SellingOperator = '$_POST[sellingoperator10]',
                                        SellingRate = '$_POST[sellingrate10]'
                                        WHERE Category = 'AGENT10' AND IDProduct = '$_POST[id]'");
  mysql_query("UPDATE tour_msdetailfinal set TotalAdult = '$_POST[totaladulta]',
                                        TotalChdTwn = '$_POST[totalchdtwna]',
                                        TotalChdXbed = '$_POST[totalchdxbeda]',
                                        TotalChdNbed = '$_POST[totalchdnbeda]',
                                        Pax = '$paxa'
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
