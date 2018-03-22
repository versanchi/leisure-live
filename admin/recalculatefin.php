<script language="javascript" type="text/javascript">
function updatepage(){
        window.close();
        window.opener.location.reload();
    }
</script>

<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" /> 
<?php 
include "../config/koneksi.php";
include "../config/koneksimaster.php";

switch($_GET[act]){
  // Tampil Office
  default:
    $username=$_SESSION[employee_code];
    $sqluser=mssql_query("SELECT EmployeeID,DivisiNO,Employee.DivisiID,Category,EmployeeName,CompanyGroup,LTMAuthority FROM [HRM].[dbo].[Employee]
                      inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                      WHERE EmployeeID = '$username'");
    $tampiluser=mssql_fetch_array($sqluser);
    $EmpName="$tampiluser[EmployeeName] ($tampiluser[EmployeeID])";
    $today = date("Y-m-d G:i:s");
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $depdate = substr($r[DateTravelFrom],8,2);
    $pakerate=$r[DateTravelFrom];
    /*$cariperiod=mssql_query("SELECT TOP 1 * FROM AgingKurs
                        where StartDate <= '$pakerate' and EndDate >= '$pakerate' order by AgingKurs.IDHeader DESC");
    $periodrate=mssql_fetch_array($cariperiod);
    $carirate=mssql_query("SELECT * FROM AgingKursDetails
                        where IDHeader = '$periodrate[IDHeader]'");
    while($rateidr=mssql_fetch_array($carirate)){echo"<input type='text' name='$rateidr[Currency]' value='$rateidr[ExRate]'>";}*/
    //UPDATE tour_agentfinal
    $cariagent=mysql_query("SELECT * FROM tour_agentfinal where IDProduct = '$_GET[id]'");
    while($dataagent=mysql_fetch_array($cariagent)){
    //agenta
    $quocurra=$dataagent[QuotationCurr];
    //$cariratea=mssql_query("SELECT * FROM Currency_Details
    //                                where StartDate <= '$pakerate' and EndDate >= '$pakerate' AND Currency = '$quocurra'");
    $cariperiod=mssql_query("SELECT TOP 1 * FROM AgingKurs
                    where StartDate <= '$pakerate' and EndDate >= '$pakerate' order by AgingKurs.IDHeader DESC");
    $periodrate=mssql_fetch_array($cariperiod);
    $cariratea=mssql_query("SELECT * FROM AgingKursDetails
                        where IDHeader = '$periodrate[IDHeader]' AND Currency = '$quocurra'");
    $rateidra=mssql_fetch_array($cariratea);
    $idra=$rateidra[ExRate];
    $quoadulta=$dataagent[QuoAdult];
    $quochdtwna=$dataagent[QuoChdTwn];
    $quochdxbeda=$dataagent[QuoChdXbed];
    $quochdnbeda=$dataagent[QuoChdNbed];
    $selladulta=$quoadulta*$idra;
    $sellchdtwna=$quochdtwna*$idra;
    $sellchdxbeda=$quochdxbeda*$idra;
    $sellchdnbeda=$quochdnbeda*$idra;

    mysql_query("UPDATE `tour_agentfinal` SET `SellingRate`='$idra',
    `SellAdult`='$selladulta',`SellChdTwn`='$sellchdtwna',`SellChdXbed`='$sellchdxbeda',`SellChdNbed`='$sellchdnbeda'
    WHERE `IDAgent` = '$dataagent[IDAgent]'");
    }
    //UPDATE tour_detailfinal
    $caridetail=mysql_query("SELECT * FROM tour_detailfinal where IDProduct = '$_GET[id]'");
    while($datadetail=mysql_fetch_array($caridetail)){
    $quocurr=$datadetail[QuotationCurr];
    //$carirate=mssql_query("SELECT * FROM Currency_Details
    //                                where StartDate <= '$pakerate' and EndDate >= '$pakerate' AND Currency = '$quocurr'");
    //$rateidr=mssql_fetch_array($carirate);
    $carirate=mssql_query("SELECT * FROM AgingKursDetails
                        where IDHeader = '$periodrate[IDHeader]' AND Currency = '$quocurr'");
    $rateidr=mssql_fetch_array($carirate);
    $idr=$rateidr[ExRate];
    $quoadult=$datadetail[QuoAdult];
    $quochd=$datadetail[QuoChd];
    $selladult=$quoadult*$idr;
    $sellchd=$quochd*$idr;
    mysql_query("UPDATE `tour_detailfinal` SET `SellingRate`='$idr',`SellAdult`='$selladult',`SellChd`='$sellchd'
    WHERE `IDDetail`='$datadetail[IDDetail]'");
    }
    //UPDATE tour_msdetailfinal
    $qdetailv=mysql_query("SELECT sum(SellAdult) as totadult FROM tour_detailfinal where IDProduct = '$_GET[id]' AND Category='VARIABLE' ");
    $idrv=mysql_fetch_array($qdetailv);
    $qdetailf=mysql_query("SELECT sum(SellAdult) as totadult, sum(SellChd) as totchd FROM tour_detailfinal where IDProduct = '$_GET[id]' AND Category='FIX' ");
    $idrf=mysql_fetch_array($qdetailf);
    $qtagent=mysql_query("SELECT sum(SellAdultA) as totadulta, sum(SellChdTwnA) as totchdtwna, sum(SellChdXbedA) as totchdxbeda, sum(SellChdNbedA) as totchdnbeda,
    sum(SellAdultB) as totadultb, sum(SellChdTwnB) as totchdtwnb, sum(SellChdXbedB) as totchdxbedb, sum(SellChdNbedB) as totchdnbedb,
    sum(SellAdultC) as totadultc, sum(SellChdTwnC) as totchdtwnc, sum(SellChdXbedC) as totchdxbedc, sum(SellChdNbedC) as totchdnbedc
    FROM tour_agentfinal where IDProduct = '$_GET[id]'");
    $idragent=mysql_fetch_array($qtagent);

    mysql_query("UPDATE `tour_msdetailfinal` SET `TotalVar`='$idrv[totadult]',`TotalFixAdult`='$idrf[totadult]',
    `TotalFixChd`='$idrf[totchd]',`TotalAdultA`='$idragent[totadulta]',`TotalChdTwnA`='$idragent[totchdtwna]',
    `TotalChdXbedA`='$idragent[totchdxbeda]',`TotalChdNbedA`='$idragent[totchdnbeda]',`TotalAdultB`='$idragent[totadultb]',
    `TotalChdTwnB`='$idragent[totchdtwnb]',`TotalChdXbedB`='$idragent[totchdxbedb]',`TotalChdNbedB`='$idragent[totchdnbedb]',
    `TotalAdultC`='$idragent[totadultc]',`TotalChdTwnC`='$idragent[totchdtwnc]',`TotalChdXbedC`='$idragent[totchdxbedc]',`TotalChdNbedC`='$idragent[totchdnbedc]'
    WHERE `IDProduct`='$r[IDProduct]'");

    //UPDATE AptTax & Sing Supp

        $quocurr=$datadetail[QuotationCurr];
        //$carirateapt=mssql_query("SELECT * FROM Currency_Details
        //                            where StartDate <= '$pakerate' and EndDate >= '$pakerate' AND Currency = '$r[TaxInsCurr]'");
        //$rateidrapt=mssql_fetch_array($carirateapt);
        $carirateapt=mssql_query("SELECT * FROM AgingKursDetails
                        where IDHeader = '$periodrate[IDHeader]' AND Currency = '$r[TaxInsCurr]'");
        $rateidrapt=mssql_fetch_array($carirateapt);
        $idrapt=$rateidrapt[ExRate];
        $taxnett=$r[TaxInsNett];
        $taxinsnettidr=$taxnett*$idrapt;
        $taxinssell=$taxnett*$idrapt;
        //$cariratesing=mssql_query("SELECT * FROM Currency_Details
        //                            where StartDate <= '$pakerate' and EndDate >= '$pakerate' AND Currency = '$r[SingleCurr]'");
        //$rateidrsing=mssql_fetch_array($cariratesing);
        $cariratesing=mssql_query("SELECT * FROM AgingKursDetails
                            where IDHeader = '$periodrate[IDHeader]' AND Currency = '$r[SingleCurr]'");
        $rateidrsing=mssql_fetch_array($cariratesing);
        $idrsing=$rateidrsing[ExRate];
        $singlenett=$r[SingleNett];
        $singlenettidr=$singlenett*$idrsing;
        $singlesell=$singlenett*$idrsing;
        /*mysql_query("UPDATE `tour_msproduct` SET `TaxInsRate`='$idrapt',`TaxInsNettIDR`='$taxinsnettidr',`TaxInsSell`='$taxinssell',
                    `SingleRate`='$idrsing',`SingleNettIDR`='$singlenettidr',`SingleSell`='$singlesell'
                     WHERE `IDProduct` = '$_GET[id]'");
*/
    $Description="UPDATE NEW RATE PRODUCT FINAL ($r[IDProduct])";

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
