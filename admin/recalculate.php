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
    $cariperiod=mssql_query("SELECT TOP 1 * FROM AgingKurs
                        where StartDate <= '$pakerate' and EndDate >= '$pakerate' order by AgingKurs.IDHeader DESC");
    $periodrate=mssql_fetch_array($cariperiod);
    /*$carirate=mssql_query("SELECT * FROM AgingKursDetails
                        where IDHeader = '$periodrate[IDHeader]'");
    while($rateidr=mssql_fetch_array($carirate)){echo"<input type='text' name='$rateidr[Currency]' value='$rateidr[ExRate]'>";}*/
    //UPDATE tour_agent
    $cariagent=mysql_query("SELECT * FROM tour_agent where IDProduct = '$_GET[id]'");
    while($dataagent=mysql_fetch_array($cariagent)){
    //agenta
    $quocurra=$dataagent[QuotationCurrA];
    $cariratea=mssql_query("SELECT * FROM AgingKursDetails
                        where IDHeader = '$periodrate[IDHeader]' AND Currency = '$quocurra'");
    $rateidra=mssql_fetch_array($cariratea);
    $idra=$rateidra[ExRate];
    $quoadulta=$dataagent[QuoAdultA];
    $quochdtwna=$dataagent[QuoChdTwnA];
    $quochdxbeda=$dataagent[QuoChdXbedA];
    $quochdnbeda=$dataagent[QuoChdNbedA];
    $selladulta=$quoadulta*$idra;
    $sellchdtwna=$quochdtwna*$idra;
    $sellchdxbeda=$quochdxbeda*$idra;
    $sellchdnbeda=$quochdnbeda*$idra;
    //agentb
    $quocurrb=$dataagent[QuotationCurrB];
    $carirateb=mssql_query("SELECT * FROM AgingKursDetails
                        where IDHeader = '$periodrate[IDHeader]' AND Currency = '$quocurrb'");
    $rateidrb=mssql_fetch_array($carirateb);
    $idrb=$rateidrb[ExRate];
    $quoadultb=$dataagent[QuoAdultB];
    $quochdtwnb=$dataagent[QuoChdTwnB];
    $quochdxbedb=$dataagent[QuoChdXbedB];
    $quochdnbedb=$dataagent[QuoChdNbedB];
    $selladultb=$quoadultb*$idrb;
    $sellchdtwnb=$quochdtwnb*$idrb;
    $sellchdxbedb=$quochdxbedb*$idrb;
    $sellchdnbedb=$quochdnbedb*$idrb;
    //agentc
    $quocurrc=$dataagent[QuotationCurrC];
    $cariratec=mssql_query("SELECT * FROM AgingKursDetails
                        where IDHeader = '$periodrate[IDHeader]' AND Currency = '$quocurrc'");
    $rateidrc=mssql_fetch_array($cariratec);
    $idrc=$rateidrc[ExRate];
    $quoadultc=$dataagent[QuoAdultC];
    $quochdtwnc=$dataagent[QuoChdTwnC];
    $quochdxbedc=$dataagent[QuoChdXbedC];
    $quochdnbedc=$dataagent[QuoChdNbedC];
    $selladultc=$quoadultc*$idrc;
    $sellchdtwnc=$quochdtwnc*$idrc;
    $sellchdxbedc=$quochdxbedc*$idrc;
    $sellchdnbedc=$quochdnbedc*$idrc;
    mysql_query("UPDATE `tour_agent` SET `SellingRateA`='$idra',`SellingRateB`='$idrb',`SellingRateC`='$idrc',
    `SellAdultA`='$selladulta',`SellChdTwnA`='$sellchdtwna',`SellChdXbedA`='$sellchdxbeda',`SellChdNbedA`='$sellchdnbeda',
    `SellAdultB`='$selladultb',`SellChdTwnB`='$sellchdtwnb',`SellChdXbedB`='$sellchdxbedb',`SellChdNbedB`='$sellchdnbedb',
    `SellAdultC`='$selladultc',`SellChdTwnC`='$sellchdtwnc',`SellChdXbedC`='$sellchdxbedc',`SellChdNbedC`='$sellchdnbedc'
    WHERE `IDAgent` = '$dataagent[IDAgent]'");
    }
    //UPDATE tour_detail
    $caridetail=mysql_query("SELECT * FROM tour_detail where IDProduct = '$_GET[id]'");
    while($datadetail=mysql_fetch_array($caridetail)){
    $quocurr=$datadetail[QuotationCurr];
    $carirate=mssql_query("SELECT * FROM AgingKursDetails
                        where IDHeader = '$periodrate[IDHeader]' AND Currency = '$quocurr'");
    $rateidr=mssql_fetch_array($carirate);
    $idr=$rateidr[ExRate];
    $quoadult=$datadetail[QuoAdult];
    $quochd=$datadetail[QuoChd];
    $selladult=$quoadult*$idr;
    $sellchd=$quochd*$idr;
    mysql_query("UPDATE `tour_detail` SET `SellingRate`='$idr',`SellAdult`='$selladult',`SellChd`='$sellchd'
    WHERE `IDDetail`='$datadetail[IDDetail]'");
    }
    //UPDATE tour_msdetail
    $qdetailv=mysql_query("SELECT sum(SellAdult) as totadult FROM tour_detail where IDProduct = '$_GET[id]' AND Category='VARIABLE' ");
    $idrv=mysql_fetch_array($qdetailv);
    $qdetailf=mysql_query("SELECT sum(SellAdult) as totadult, sum(SellChd) as totchd FROM tour_detail where IDProduct = '$_GET[id]' AND Category='FIX' ");
    $idrf=mysql_fetch_array($qdetailf);
    $qtagent=mysql_query("SELECT sum(SellAdultA) as totadulta, sum(SellChdTwnA) as totchdtwna, sum(SellChdXbedA) as totchdxbeda, sum(SellChdNbedA) as totchdnbeda,
    sum(SellAdultB) as totadultb, sum(SellChdTwnB) as totchdtwnb, sum(SellChdXbedB) as totchdxbedb, sum(SellChdNbedB) as totchdnbedb,
    sum(SellAdultC) as totadultc, sum(SellChdTwnC) as totchdtwnc, sum(SellChdXbedC) as totchdxbedc, sum(SellChdNbedC) as totchdnbedc
    FROM tour_agent where IDProduct = '$_GET[id]'");
    $idragent=mysql_fetch_array($qtagent);

    mysql_query("UPDATE `tour_msdetail` SET `TotalVar`='$idrv[totadult]',`TotalFixAdult`='$idrf[totadult]',
    `TotalFixChd`='$idrf[totchd]',`TotalAdultA`='$idragent[totadulta]',`TotalChdTwnA`='$idragent[totchdtwna]',
    `TotalChdXbedA`='$idragent[totchdxbeda]',`TotalChdNbedA`='$idragent[totchdnbeda]',`TotalAdultB`='$idragent[totadultb]',
    `TotalChdTwnB`='$idragent[totchdtwnb]',`TotalChdXbedB`='$idragent[totchdxbedb]',`TotalChdNbedB`='$idragent[totchdnbedb]',
    `TotalAdultC`='$idragent[totadultc]',`TotalChdTwnC`='$idragent[totchdtwnc]',`TotalChdXbedC`='$idragent[totchdxbedc]',`TotalChdNbedC`='$idragent[totchdnbedc]'
    WHERE `IDProduct`='$r[IDProduct]'");

    //UPDATE AptTax & Sing Supp

        $quocurr=$datadetail[QuotationCurr];
        $carirateapt=mssql_query("SELECT * FROM AgingKursDetails
                        where IDHeader = '$periodrate[IDHeader]' AND Currency = '$r[TaxInsCurr]'");
        $rateidrapt=mssql_fetch_array($carirateapt);
        $idrapt=$rateidrapt[ExRate];
        $taxnett=$r[TaxInsNett];
        $taxinsnettidr=$taxnett*$idrapt;
        $taxinssell=$taxnett*$idrapt;
        $cariratesing=mssql_query("SELECT * FROM AgingKursDetails
                            where IDHeader = '$periodrate[IDHeader]' AND Currency = '$r[SingleCurr]'");
        $rateidrsing=mssql_fetch_array($cariratesing);
        $idrsing=$rateidrsing[ExRate];
        $singlenett=$r[SingleNett];
        $singlenettidr=$singlenett*$idrsing;
        $singlesell=$singlenett*$idrsing;
        mysql_query("UPDATE `tour_msproduct` SET `TaxInsRate`='$idrapt',`TaxInsNettIDR`='$taxinsnettidr',`TaxInsSell`='$taxinssell',
                    `SingleRate`='$idrsing',`SingleNettIDR`='$singlenettidr',`SingleSell`='$singlesell'
                    WHERE `IDProduct` = '$_GET[id]'");

    $Description="UPDATE NEW RATE PRODUCT ($r[IDProduct])";

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
