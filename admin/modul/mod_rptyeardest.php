
<SCRIPT LANGUAGE="Javascript" SRC="FusionChartsXT/Code/FusionCharts/FusionCharts.js"></SCRIPT>
<link href="./css/fixedheadertable.css" rel="stylesheet" media="screen" />
<link href="./css/custom.css" rel="stylesheet" media="screen" />
<!--<script src="./js/jquery-1.7.2.min.js"></script>-->
<script src="./js/jquery.fixedheadertable.js"></script>

<script type="text/javascript">
	/* <![CDATA[ */
	$(document).ready(function() {
		$('#myDemoTable').fixedHeaderTable({
			altClass : 'odd',
			footer : true,
			fixedColumns : 2
		});
	});
	
	
	$(document).ready(function() {
		$('#DetailDestination').fixedHeaderTable({
			altClass : 'odd',
			footer : true,
			fixedColumns : 2
		});
	});
	/* ]]> */
</script>
<?php
$CompanyID=$_SESSION['company_id'];
switch($_GET[act]) {
    // Tampilan header
    default:

        $thnini = date("Y");
        $yer = $_GET['year'];
        $type = $_GET['Type'];
        $Dep = $_GET['Department'];
        $company1 = $_GET['company'];
        $company = str_replace("+", " ", $company1);
        if ($company == '') {
            $company = 'ALL';
        }

        if ($yer == '') {
            $yer = $thnini;
        }
        if ($type == '') {
            $type = 'Pax';
        }
        if ($Dep == '') {
            $Dep = 'ALL';
        } else {
            $Dep = $_GET['Department'];
        }

        echo "<h2>Report by Destination</h2>
			   	
    <form method='get' action='media.php?'><input type=hidden name=module value='rptyeardest'>   
		      
    Year  &nbsp;:  <select name='year' ><option value='0' >- Select Year -</option>";
        $tampil = mysql_query("SELECT Year FROM tour_msproduct where year <>'' group BY Year asc");
        while ($s = mysql_fetch_array($tampil)) {  // <input type='button' value='Cek Seat' onclick=ceking() >
            if ($yer == $s[Year]) {
                echo "<option value='$s[Year]' selected>$s[Year]</option>";
            } else {
                echo "<option value='$s[Year]' >$s[Year]</option>";
            }
        }

        echo "</select> &nbsp&nbsp
	 Type : <select name='Type' >";
        if ($type == Pax) {
            echo "<option value='Pax' selected>Pax</option>";
        } else {
            echo "<option value='Pax' >Pax</option>";
        }
        if ($type == Grp) {
            echo "<option value='Grp' selected>Group</option>";
        } else {
            echo "<option value='Grp' >Group</option>";
        }
        if ($type == Amt) {
            echo "<option value='Amt' selected>Amount</option></select>&nbsp;&nbsp;&nbsp;";
        } else {
            echo "<option value='Amt' >Amount</option></select>";
        }
        echo "<br>
			Company : <select name='company' ><option value='ALL' >- ALL -</option>";
        $qcomp = mysql_query("SELECT Company FROM tour_msproduct where Company <> '' group BY Company");
        while ($comp = mysql_fetch_array($qcomp)) {
            if ($company == $comp[Company]) {
                echo "<option value='$comp[Company]' selected>$comp[Company]</option>";
            } else {
                echo "<option value='$comp[Company]' >$comp[Company]</option>";
            }
        }
        echo "</select>&nbsp; Department :&nbsp;&nbsp;<select name='Department' ><br>
			<option value='ALL'>ALL</option>";
        $QDepartment = mysql_query("select distinct Department from tour_msproduct where Department<>'' and CompanyID='$CompanyID' ");
        while ($DDepartment = mysql_fetch_array($QDepartment)) {

            if ($Dep == $DDepartment[Department]) {
                echo "<option value='$DDepartment[Department]' selected>$DDepartment[Department]</option>";
            } else {
                echo "<option value='$DDepartment[Department]' >$DDepartment[Department]</option>";
            }
        }


        echo "</select>&nbsp;&nbsp;<input type=submit name='submit' size='20'value='View'>
          </form>";
        $oke = $_GET['oke'];
        $Lastyear = $yer - 1;

        if ($Dep == 'LEISURE') {
            $TableTarget = "tour_mstargetpo";
        };
        if ($Dep == 'MINISTRY') {
            $TableTarget = "tour_mstargetpoPMT";
        };
        if ($Dep == 'TUR EZ') {
            $TableTarget = "tour_mstargetpotez";
        };
        if ($Dep == 'TMR') {
            $TableTarget = "tour_mstargetpotmr";
        };

        echo "<h><u>Report Destination Period  $Lastyear  VS  $yer </u></h><br>";

        if ($Dep == 'ALL') {
            if ($type == 'Pax') {
                $strQuerytable = mysql_query("SELECT Destination,ProductcodeArea, 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),(AdultPax+ChildPax+InfantPax),0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=1),(AdultPax+ChildPax+InfantPax),0)) as JanLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),(AdultPax+ChildPax+InfantPax),0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=2),(AdultPax+ChildPax+InfantPax),0)) as FebLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),(AdultPax+ChildPax+InfantPax),0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=3),(AdultPax+ChildPax+InfantPax),0)) as MarLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),(AdultPax+ChildPax+InfantPax),0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=4),(AdultPax+ChildPax+InfantPax),0)) as AprLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),(AdultPax+ChildPax+InfantPax),0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=5),(AdultPax+ChildPax+InfantPax),0)) as MayLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),(AdultPax+ChildPax+InfantPax),0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=6),(AdultPax+ChildPax+InfantPax),0)) as JunLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),(AdultPax+ChildPax+InfantPax),0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=7),(AdultPax+ChildPax+InfantPax),0)) as JulLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),(AdultPax+ChildPax+InfantPax),0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=8),(AdultPax+ChildPax+InfantPax),0)) as AgtLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),(AdultPax+ChildPax+InfantPax),0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=9),(AdultPax+ChildPax+InfantPax),0)) as SepLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),(AdultPax+ChildPax+InfantPax),0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=10),(AdultPax+ChildPax+InfantPax),0)) as OctLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),(AdultPax+ChildPax+InfantPax),0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=11),(AdultPax+ChildPax+InfantPax),0)) as NovLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),(AdultPax+ChildPax+InfantPax),0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=12),(AdultPax+ChildPax+InfantPax),0)) as DecLast ,
		  
		  sum(if(year(DateTravelFrom) =$yer,(AdultPax+ChildPax+InfantPax),0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,(AdultPax+ChildPax+InfantPax),0)) as TotalLast 
	  
	  FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode 
	  inner join tour_msproductcode on  tour_msproductcode.productcodeName= tour_msproduct.ProductCode
	  where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'
	  and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and CompanyID=$CompanyID
	  and DUMMY='NO' group by ProductcodeArea order by TotalNow desc");

            } else if ($type == 'Grp') {
                $strQuerytable = mysql_query("SELECT Destination,ProductcodeArea, 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=1),1,0)) as JanLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=2),1,0)) as FebLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=3),1,0)) as MarLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=4),1,0)) as AprLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=5),1,0)) as MayLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=6),1,0)) as JunLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=7),1,0)) as JulLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=8),1,0)) as AgtLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=9),1,0)) as SepLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=10),1,0)) as OctLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=11),1,0)) as NovLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=12),1,0)) as DecLast ,
		  
		  sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,1,0)) as TotalLast 
	  
	  FROM tour_msproduct inner join tour_msproductcode on  tour_msproductcode.productcodeName= tour_msproduct.ProductCode  where  Status <> 'VOID'  and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and CompanyID=$CompanyID group by ProductcodeArea ");
            } else {
                $strQuerytable = mysql_query("SELECT Destination,ProductcodeArea, 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=1),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=2),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=3),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=4),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=5),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=6),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=7),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=8),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=9),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=10),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=11),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=12),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecLast ,
		  
		  sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,1,0)) as TotalLast 	
	  
	  
	  FROM tour_msbookingdetail 
		  inner join 
	  (select TCDivision,BookingID,Destination,ProductcodeArea,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode   inner join tour_msproductcode on  tour_msproductcode.productcodeName= tour_msproduct.ProductCode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and CompanyID=$CompanyID)tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by ProductcodeArea order by TotalNow desc");


            }

        } else {

            if ($type == 'Pax') {
                $strQuerytable = mysql_query("SELECT Destination,ProductcodeArea, 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),(AdultPax+ChildPax+InfantPax),0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=1),(AdultPax+ChildPax+InfantPax),0)) as JanLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),(AdultPax+ChildPax+InfantPax),0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=2),(AdultPax+ChildPax+InfantPax),0)) as FebLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),(AdultPax+ChildPax+InfantPax),0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=3),(AdultPax+ChildPax+InfantPax),0)) as MarLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),(AdultPax+ChildPax+InfantPax),0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=4),(AdultPax+ChildPax+InfantPax),0)) as AprLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),(AdultPax+ChildPax+InfantPax),0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=5),(AdultPax+ChildPax+InfantPax),0)) as MayLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),(AdultPax+ChildPax+InfantPax),0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=6),(AdultPax+ChildPax+InfantPax),0)) as JunLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),(AdultPax+ChildPax+InfantPax),0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=7),(AdultPax+ChildPax+InfantPax),0)) as JulLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),(AdultPax+ChildPax+InfantPax),0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=8),(AdultPax+ChildPax+InfantPax),0)) as AgtLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),(AdultPax+ChildPax+InfantPax),0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=9),(AdultPax+ChildPax+InfantPax),0)) as SepLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),(AdultPax+ChildPax+InfantPax),0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=10),(AdultPax+ChildPax+InfantPax),0)) as OctLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),(AdultPax+ChildPax+InfantPax),0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=11),(AdultPax+ChildPax+InfantPax),0)) as NovLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),(AdultPax+ChildPax+InfantPax),0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=12),(AdultPax+ChildPax+InfantPax),0)) as DecLast ,
		  
		  sum(if(year(DateTravelFrom) =$yer,(AdultPax+ChildPax+InfantPax),0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,(AdultPax+ChildPax+InfantPax),0)) as TotalLast 

	  FROM tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode and tour_msproduct.Department='$Dep'
	  inner join tour_msproductcode on  tour_msproductcode.productcodeName= tour_msproduct.ProductCode
	  where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'
	  and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.TourCode<>'' and Seat<>SeatSisa
	  and Dummy='NO' and CompanyID=$CompanyID  group by ProductcodeArea order by TotalNow desc");

            } else if ($type == 'Grp') {
                $strQuerytable = mysql_query("SELECT Destination,ProductcodeArea, 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=1),1,0)) as JanLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=2),1,0)) as FebLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=3),1,0)) as MarLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=4),1,0)) as AprLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=5),1,0)) as MayLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=6),1,0)) as JunLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=7),1,0)) as JulLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=8),1,0)) as AgtLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=9),1,0)) as SepLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=10),1,0)) as OctLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=11),1,0)) as NovLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=12),1,0)) as DecLast ,
		  
		  sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,1,0)) as TotalLast 
	  
	  FROM tour_msproduct inner join tour_msproductcode on  tour_msproductcode.productcodeName= tour_msproduct.ProductCode  and tour_msproduct.Department='$Dep' where  Status <> 'VOID'  and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and CompanyID=$CompanyID group by ProductcodeArea ");
            } else {
                $strQuerytable = mysql_query("SELECT Destination,ProductcodeArea, 
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=1),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JanLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=2),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as FebLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=3),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MarLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=4),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AprLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=5),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as MayLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=6),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JunLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=7),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as JulLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=8),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as AgtLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=9),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as SepLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=10),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as OctLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=11),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as NovLast ,
		  
		  sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecNow , 
		  sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=12),(Subtotal+DevAmount+SeaTaxSell)*exRate+if((Package<>'L.A Only'and Gender<>'INFANT'),if(TaxInsSell>10000,TaxInsSell,TaxInsSell*exRate),0),0)) as DecLast ,
		  
		  sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,1,0)) as TotalLast 	
	  
	  
	  FROM tour_msbookingdetail 
		  inner join 
	  (select TCDivision,BookingID,Destination,ProductcodeArea,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode  and tour_msproduct.Department='$Dep' inner join tour_msproductcode on  tour_msproductcode.productcodeName= tour_msproduct.ProductCode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and CompanyID=$CompanyID)tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by ProductcodeArea order by TotalNow desc");

            }

        }

        //munculin table
        $No = 1;
        $Total = 0;

        echo " <div class='outerbox'>
            <div class='innerbox'>
	 			<table class='bluetable' id='myDemoTable' cellpadding='0' cellspacing='0'>
	 				<thead><tr>
	 					<th>No</th><th>Destination</th><th colspan=4>JAN</th><th colspan=4>FEB</th><th colspan=4>MAR</th><th colspan=4>APR</th><th colspan=4>MAY</th><th colspan=4>JUN</th><th colspan=4>JUL</th><th colspan=4>AGT</th><th colspan=4>SEP</th><th colspan=4>OCT</th><th colspan=4>NOV</th><th colspan=4>DEC</th><th colspan=5>TOTAL</th></tr></thead><tbody><tr>
			<tr><th style='background-color: #000000; color:#000000;'>No</th><th style='background-color: #000000; color:#000000;'>Destination</td><td style='background-color: #000000; color:#FFFFFF'>Target</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th>
			<td style='background-color: #000000; color:#FFFFFF'>Target</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th>
			<td style='background-color: #000000; color:#FFFFFF'>Target</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th>
			<td style='background-color: #000000; color:#FFFFFF'>Target</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th>
			<td style='background-color: #000000; color:#FFFFFF'>Target</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th>
			<td style='background-color: #000000; color:#FFFFFF'>Target</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th>
			<td style='background-color: #000000; color:#FFFFFF'>Target</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th>
			<td style='background-color: #000000; color:#FFFFFF'>Target</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th>
			<td style='background-color: #000000; color:#FFFFFF'>Target</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th>
			<td style='background-color: #000000; color:#FFFFFF'>Target</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th>
			<td style='background-color: #000000; color:#FFFFFF'>Target</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th>
			<td style='background-color: #000000; color:#FFFFFF'>Target</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th>
			<td style='background-color: #000000; color:#FFFFFF'>Target</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th></tr>";


        $No = 1;
        while ($DPax = mysql_fetch_array($strQuerytable)) {
            $TotalNow = 0;
            $TotalLast = 0;
            $QTarget = mysql_query("select * from $TableTarget where TargetBSO='$DPax[ProductcodeArea]' and TargetYear='$yer'");
            $DTarget = mysql_fetch_array($QTarget);
            if ($type == 'Pax' OR $type == 'Grp') {
                $target01 = $DTarget[JAN];
                $target02 = $DTarget[FEB];
                $target03 = $DTarget[MAR];
                $target04 = $DTarget[APR];
                $target05 = $DTarget[MAY];
                $target06 = $DTarget[JUN];
                $target07 = $DTarget[JUL];
                $target08 = $DTarget[AUG];
                $target09 = $DTarget[SEP];
                $target10 = $DTarget[OCT];
                $target11 = $DTarget[NOV];
                $target12 = $DTarget[DES];
            } else {
                $target01 = $DTarget[JANA];
                $target02 = $DTarget[FEBA];
                $target03 = $DTarget[MARA];
                $target04 = $DTarget[APRA];
                $target05 = $DTarget[MAYA];
                $target06 = $DTarget[JUNA];
                $target07 = $DTarget[JULA];
                $target08 = $DTarget[AUGA];
                $target09 = $DTarget[SEPA];
                $target10 = $DTarget[OCTA];
                $target11 = $DTarget[NOVA];
                $target12 = $DTarget[DESA];
            }

            echo "<tr> <td>$No</td>
						 <td><a href='?module=rptyeardest&act=showdetails&Dest=$DPax[ProductcodeArea]&thn=$yer&type=$type'>$DPax[ProductcodeArea]</a></td>
					 <td style='text-align:right'>" . number_format($target01, 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[JanLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[JanNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[JanNow] / $target01 * 100, 0, ',', '.');
            echo "%</td>
					 					 
					 <td style='text-align:right'>" . number_format($target02, 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[FebLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[FebNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[FebNow] / $target02 * 100, 0, ',', '.');
            echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($target03, 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[MarLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[MarNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[MarNow] / $target03 * 100, 0, ',', '.');
            echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($target04, 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[AprLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[AprNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[AprNow] / $target04 * 100, 0, ',', '.');
            echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($target05, 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[MayLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[MayNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[MayNow] / $target05 * 100, 0, ',', '.');
            echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($target06, 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[JunLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[JunNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[JunNow] / $target06 * 100, 0, ',', '.');
            echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($target07, 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[JulLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[JulNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[JulNow] / $target07 * 100, 0, ',', '.');
            echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($target08, 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[AgtLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[AgtNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[AgtNow] / $target08 * 100, 0, ',', '.');
            echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($target09, 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[SepLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[SepNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[SepNow] / $target09 * 100, 0, ',', '.');
            echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($target10, 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[OctLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[OctNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[OctNow] / $target10 * 100, 0, ',', '.');
            echo "%</td>

					 <td style='text-align:right'>" . number_format($target11, 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[NovLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[NovNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[NovNow] / $target11 * 100, 0, ',', '.');
            echo "%</td>

					 <td style='text-align:right'>" . number_format($target12, 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[DecLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[DecNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[DecNow] / $target12 * 100, 0, ',', '.');
            echo "%</td>";

            $TotalNow = $DPax[JanNow] + $DPax[FebNow] + $DPax[MarNow] + $DPax[AprNow] + $DPax[MayNow] + $DPax[JunNow] + $DPax[JulNow] + $DPax[AgtNow] + $DPax[SepNow] + $DPax[OctNow] + $DPax[NovNow] + $DPax[DecNow];
            $TotalLast = $DPax[JanLast] + $DPax[FebLast] + $DPax[MarLast] + $DPax[AprLast] + $DPax[MayLast] + $DPax[JunLast] + $DPax[JulLast] + $DPax[AgtLast] + $DPax[SepLast] + $DPax[OctLast] + $DPax[NovLast] + $DPax[DecLast];
            $TotalTarget = $target01 + $target02 + $target03 + $target04 + $target05 + $target06 + $target07 + $target08 + $target09 + $target10 + $target11 + $target12;

            echo "<td style='text-align:right'>" . number_format($TotalTarget, 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($TotalLast, 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($TotalNow, 0, ',', '.');
            if ($TotalNow < $TotalLast) {
                $warnaminus = "COLOR:Red;";
            } else {
                $warnaminus = "COLOR:black";
            }
            echo "</td><td style='text-align:right;$warnaminus'>" . number_format($TotalNow / $TotalLast * 100, 0, ',', '.');
            echo "%</td></tr>";

            $No++;
            $GrandTotalNow = $GrandTotalNow + $TotalNow;
            $GrandTotalLast = $GrandTotalLast + $TotalLast;
            $GrandTotalTarget = $GrandTotalTarget + $TotalTarget;

            $GrandJanNow = $GrandJanNow + $DPax[JanNow];
            $GrandJanLast = $GrandJanLast + $DPax[JanLast];
            $GrandJanTarget = $GrandJanTarget + $target01;

            $GrandFebNow = $GrandFebNow + $DPax[FebNow];
            $GrandFebLast = $GrandFebLast + $DPax[FebLast];
            $GrandFebTarget = $GrandFebTarget + $target02;

            $GrandMarNow = $GrandMarNow + $DPax[MarNow];
            $GrandMarLast = $GrandMarLast + $DPax[MarLast];
            $GrandMarTarget = $GrandMarTarget + $target03;

            $GrandAprNow = $GrandAprNow + $DPax[AprNow];
            $GrandAprLast = $GrandAprLast + $DPax[AprLast];
            $GrandAprTarget = $GrandAprTarget + $target04;

            $GrandMayNow = $GrandMayNow + $DPax[MayNow];
            $GrandMayLast = $GrandMayLast + $DPax[MayLast];
            $GrandMayTarget = $GrandMayTarget + $target05;


            $GrandJunNow = $GrandJunNow + $DPax[JunNow];
            $GrandJunLast = $GrandJunLast + $DPax[JunLast];
            $GrandJunTarget = $GrandJunTarget + $target06;

            $GrandJulNow = $GrandJulNow + $DPax[JulNow];
            $GrandJulLast = $GrandJulLast + $DPax[JulLast];
            $GrandJulTarget = $GrandJulTarget + $target07;

            $GrandAgtNow = $GrandAgtNow + $DPax[AgtNow];
            $GrandAgtLast = $GrandAgtLast + $DPax[AgtLast];
            $GrandAgtTarget = $GrandAgtTarget + $target08;

            $GrandSepNow = $GrandSepNow + $DPax[SepNow];
            $GrandSepLast = $GrandSepLast + $DPax[SepLast];
            $GrandSepTarget = $GrandSepTarget + $target09;

            $GrandOctNow = $GrandOctNow + $DPax[OctNow];
            $GrandOctLast = $GrandOctLast + $DPax[OctLast];
            $GrandOctTarget = $GrandOctTarget + $target10;

            $GrandNovNow = $GrandNovNow + $DPax[NovNow];
            $GrandNovLast = $GrandNovLast + $DPax[NovLast];
            $GrandNovTarget = $GrandNovTarget + $target11;

            $GrandDecNow = $GrandDecNow + $DPax[DecNow];
            $GrandDecLast = $GrandDecLast + $DPax[DecLast];
            $GrandDecTarget = $GrandDecTarget + $target12;

        }

        //Total keseluruhan
        echo "<tr><td colspan=2 style='background-color: #000000; color:#FFFFFF'><center><b>TOTAL</b></center></td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJanTarget, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJanLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJanNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJanNow / $GrandJanLast * 100, 0, ',', '.');
        echo "%</td>
					 					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandFebTarget, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandFebLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandFebNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandFebNow / $GrandFebLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandMarTarget, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandMarLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandMarNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandMarNow / $GrandMarLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandAprTarget, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandAprLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandAprNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandAprNow / $GrandAprLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandMayTarget, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandMayLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandMayNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandMayNow / $GrandMayLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJunTarget, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJunLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJunNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJunNow / $GrandJunLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJulTarget, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJulLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJulNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJulNow / $GrandJulLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandAgtTarget, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandAgtLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandAgtNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandAgtNow / $GrandAgtLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandSepTarget, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandSepLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandSepNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandSepNow / $GrandSepLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandOctTarget, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandOctLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandOctNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandOctNow / $GrandOctLast * 100, 0, ',', '.');
        echo "%</td>

					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandNovTarget, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandNovLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandNovNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandNovNow / $GrandNovLast * 100, 0, ',', '.');
        echo "%</td>

					<td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandDecTarget, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandDecLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandDecNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandDecNow / $GrandDecLast * 100, 0, ',', '.');
        echo "%</td>";

        $GrandTotalTarget = $GrandJanTarget + $GrandFebTarget + $GrandMarTarget + $GrandAprTarget + $GrandMayTarget + $GrandJunTarget + $GrandJulTarget + $GrandAgtTarget + $GrandSepTarget + $GrandOctTarget + $GrandNovTarget + $GrandDecTarget;
        $GrandTotalNow = $GrandJanNow + $GrandFebNow + $GrandMarNow + $GrandAprNow + $GrandMayNow + $GrandJunNow + $GrandJulNow + $GrandAgtNow + $GrandSepNow + $GrandOctNow + $GrandNovNow + $GrandDecNow;
        $GrandTotalLast = $GrandJanLast + $GrandFebLast + $GrandMarLast + $GrandAprLast + $GrandMayLast + $GrandJunLast + $GrandJulLast + $GrandAgtLast + $GrandSepLast + $GrandOctLast + $GrandNovLast + $GrandDecLast;

        echo "<td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandTotalTarget, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandTotalLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandTotalNow, 0, ',', '.');
        if ($GrandTotalNow < $GrandTotalLast) {
            $warnaminus = "COLOR:Red;";
        } else {
            $warnaminus = "COLOR:black";
        }
        echo "</td><td style='text-align:right;$warnaminus;background-color: #000000; color:#FFFFFF'>" . number_format($GrandTotalNow / $GrandTotalLast * 100, 0, ',', '.');
        echo "%</td></tr>";

        echo "</tbody></table></div>
        			<div class='clear'></div></div>";

        break;

    //details
    case "showdetails":

        $yer = $_GET['thn'];
        $type = $_GET['type'];
        $Dest = $_GET['Dest'];
        $TDetail = $_GET[TDetail];
        if ($TDetail == '') {
            $TDetail = 'ProductCode';
        } else {
            $TDetail = $TDetail;
        }

        echo "<h2>Report by Destination - $Dest</h2><br>
				   	
    <form method='get' action='media.php?'><input type=hidden name=module value='rptyeardest'>
	<input type=hidden name=act value='showdetails'>
	<input type=hidden name=Dest value='$Dest'>
	<input type=hidden name=thn value='$yer'>
	<input type=hidden name=type value='$type'>
	 Base on : <select name='TDetail' >
	 		<option value='ProductCode'";
        if ($TDetail == 'ProductCode') {
            echo "selected";
        }
        echo ">Product Code</option>
      		<option value='TCName'";
        if ($TDetail == 'TCName') {
            echo "selected";
        }
        echo ">TC Name</option>
			<option value='POS'";
        if ($TDetail == 'POS') {
            echo "selected";
        }
        echo ">Division</option>
        </select>
	 <input type=submit name='submit' size='20'value='View'>
          </form>";
        $oke = $_GET['oke'];
        $Lastyear = $yer - 1;
        echo "<h><u>Report Detail Destination Period  $Lastyear  VS  $yer</u></h><br>";
        //munculin table
        $No = 1;
        $Total = 0;

        if ($TDetail == 'ProductCode') {
            $Description = "Product Code";

            $strQuerytable = mysql_query("SELECT CONCAT(ProductCode,' - ',ProductCodeName) as Description , 
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=1),1,0)) as JanLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=2),1,0)) as FebLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=3),1,0)) as MarLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=4),1,0)) as AprLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=5),1,0)) as MayLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=6),1,0)) as JunLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=7),1,0)) as JulLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=8),1,0)) as AgtLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=9),1,0)) as SepLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=10),1,0)) as OctLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=11),1,0)) as NovLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=12),1,0)) as DecLast ,
		
		sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,1,0)) as TotalLast ,Department
	
	FROM tour_msbookingdetail 
		inner join 
	(select TCDivision,ProductCode,ProductCodeName,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom
	from tour_msbooking
	inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode
	where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'
	and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and DUMMY ='NO' and CompanyID=$CompanyID
	and ProductCode in (select ProductcodeName from tour_msproductcode where ProductcodeArea='$Dest') )tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID  where tour_msbookingdetail.status<>'CANCEL'
	group by Description,Department order by Department, TotalNow desc");


        } else if ($TDetail == 'TCName') {
            $Description = "TC Name";
            $strQuerytable = mysql_query("SELECT TCName as Description, 
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=1),1,0)) as JanLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=2),1,0)) as FebLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=3),1,0)) as MarLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=4),1,0)) as AprLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=5),1,0)) as MayLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=6),1,0)) as JunLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=7),1,0)) as JulLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=8),1,0)) as AgtLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=9),1,0)) as SepLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=10),1,0)) as OctLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=11),1,0)) as NovLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=12),1,0)) as DecLast ,
		
		sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,1,0)) as TotalLast ,Department
	
	FROM tour_msbookingdetail 
		inner join 
	(select TCName, TCDivision,ProductCode,ProductCodeName,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and CompanyID=$CompanyID and ProductCode in (select ProductcodeName from tour_msproductcode where ProductcodeArea='$Dest'))tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by Description,Department order by Department, TotalNow desc");

        } else {
            $Description = "Division";
            $strQuerytable = mysql_query("SELECT TCDivision as Description, 
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=1),1,0)) as JanNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=1),1,0)) as JanLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=2),1,0)) as FebNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=2),1,0)) as FebLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=3),1,0)) as MarNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=3),1,0)) as MarLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=4),1,0)) as AprNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=4),1,0)) as AprLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=5),1,0)) as MayNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=5),1,0)) as MayLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=6),1,0)) as JunNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=6),1,0)) as JunLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=7),1,0)) as JulNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=7),1,0)) as JulLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=8),1,0)) as AgtNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=8),1,0)) as AgtLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=9),1,0)) as SepNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=9),1,0)) as SepLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=10),1,0)) as OctNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=10),1,0)) as OctLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=11),1,0)) as NovNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=11),1,0)) as NovLast ,
		
		sum(if((year(DateTravelFrom) =$yer and month(DateTravelFrom)=12),1,0)) as DecNow , 
		sum(if((year(DateTravelFrom) =$Lastyear and month(DateTravelFrom)=12),1,0)) as DecLast ,
		
		sum(if(year(DateTravelFrom) =$yer,1,0)) as TotalNow , sum(if(year(DateTravelFrom) =$Lastyear,1,0)) as TotalLast ,Department
	
	FROM tour_msbookingdetail 
		inner join 
	(select TCDivision,ProductCode,ProductCodeName,BookingID,Destination,SellingCurr,TaxInsSell,SeaTaxSell,GroupType,ProductType,Department,DateTravelFrom from tour_msbooking inner join tour_msproduct on tour_msproduct.IDProduct=tour_msbooking.IDTourcode where tour_msbooking.status='ACTIVE'  and BookingStatus='DEPOSIT'  and TCDivision<>'' and tour_msproduct.Status <> 'VOID'  and (year(DateTravelFrom)=$yer or year(DateTravelFrom)=$Lastyear)  and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and Dummy='NO' and CompanyID=$CompanyID and ProductCode in (select ProductcodeName from tour_msproductcode where ProductcodeArea='$Dest'))tour_msbooking on tour_msbookingdetail.BookingID=tour_msbooking.BookingID where tour_msbookingdetail.status<>'CANCEL'  group by Description,Department order by Department,TotalNow desc");

        }

        $jum = mysql_num_rows($strQuerytable);


        echo " <div class='outerbox'>
            <div class='innerbox'>
	 			<table class='bluetable' id='DetailDestination' cellpadding='0' cellspacing='0'>
	 				<thead>
			<tr><th>No</th><th style='width:50px;'>&nbsp;&nbsp;$Description&nbsp;&nbsp;</th><th colspan=3>JAN</th><th colspan=3>FEB</th><th colspan=3>MAR</th><th colspan=3>APR</th><th colspan=3>MAY</th><th colspan=3>JUN</th><th colspan=3>JUL</th><th colspan=3>AGT</th><th colspan=3>SEP</th><th colspan=3>OCT</th><th colspan=3>NOV</th><th colspan=3>DEC</th><th colspan=4>TOTAL</th></tr></thead><tbody>
			<tr><td style='background-color: #000000; color:#FFFFFF'></td><td style='background-color: #000000; color:#FFFFFF'></td><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th><td style='background-color: #000000; color:#FFFFFF'>$Lastyear</th><td style='background-color: #000000; color:#FFFFFF'>$yer</th><td style='background-color: #000000; color:#FFFFFF'>%</th>";
        $Department = 'awal';
        while ($DPax = mysql_fetch_array($strQuerytable)) {

            $TotalNow = 0;
            $TotalLast = 0;

            if ($Department <> $DPax[Department] or $Department == 'awal') {
                if ($Department <> 'awal') {

                    echo "<tr>
					 <td colspan=2><b>Total</td>
					 
					 <td style='text-align:right'>" . number_format($TotalJanDepartLast, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalJanDepartNow, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalJanDepartNow / $TotalJanDepartLast * 100, 0, ',', '.');
                    echo "%</td>
					 					 
					 <td style='text-align:right'>" . number_format($TotalFebDepartLast, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalFebDepartNow, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalFebDepartNow / $TotalFebDepartLast * 100, 0, ',', '.');
                    echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($TotalMarDepartLast, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalMarDepartNow, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalMarDepartNow / $TotalMarDepartLast * 100, 0, ',', '.');
                    echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($TotalAprDepartLast, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalAprDepartNow, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalAprDepartNow / $TotalAprDepartLast * 100, 0, ',', '.');
                    echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($TotalMayDepartLast, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalMayDepartNow, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalMayDepartNow / $TotalMayDepartLast * 100, 0, ',', '.');
                    echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($TotalJunDepartLast, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalJunDepartNow, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalJunDepartNow / $TotalJunDepartLast * 100, 0, ',', '.');
                    echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($TotalJulDepartLast, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalJulDepartNow, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalJulDepartNow / $TotalJulDepartLast * 100, 0, ',', '.');
                    echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($TotalAgtDepartLast, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalAgtDepartNow, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalAgtDepartNow / $TotalAgtDepartLast * 100, 0, ',', '.');
                    echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($TotalSepDepartLast, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalSepDepartNow, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalSepDepartNow / $TotalSepDepartLast * 100, 0, ',', '.');
                    echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($TotalOctDepartLast, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalOctDepartNow, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalOctDepartNow / $TotalOctDepartLast * 100, 0, ',', '.');
                    echo "%</td>

					 <td style='text-align:right'>" . number_format($TotalNovDepartLast, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalNovDepartNow, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalNovDepartNow / $TotalNovDepartLast * 100, 0, ',', '.');
                    echo "%</td>

					 <td style='text-align:right'>" . number_format($TotalDecDepartLast, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalDecDepartNow, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalDecDepartNow / $TotalDecDepartLast * 100, 0, ',', '.');
                    echo "%</td>";


                    $TotalDepartNow = $TotalJanDepartNow + $TotalFebDepartNow + $TotalMarDepartNow + $TotalAprDepartNow + $TotalMayDepartNow + $TotalJunDepartNow + $TotalJulDepartNow + $TotalAgtDepartNow + $TotalSepDepartNow + $TotalOctDepartNow + $TotalNovDepartNow + $TotalDecDepartNow;
                    $TotalDepartLast = $TotalJanDepartLast + $TotalFebDepartLast + $TotalMarDepartLast + $TotalAprDepartLast + $TotalMayDepartLast + $TotalJunDepartLast + $TotalJulDepartLast + $TotalAgtDepartLast + $TotalSepDepartLast + $TotalOctDepartLast + $TotalNovDepartLast + $TotalDecDepartLast;

                    echo "<td style='text-align:right'>" . number_format($TotalDepartLast, 0, ',', '.');
                    echo "</td><td style='text-align:right'>" . number_format($TotalDepartNow, 0, ',', '.');
                    if ($GrandTotalNow < $GrandTotalLast) {
                        $warnaminus = "COLOR:Red;";
                    } else {
                        $warnaminus = "COLOR:black";
                    }
                    echo "</td><td style='text-align:right;$warnaminus'>" . number_format($TotalDepartNow / $TotalDepartLast * 100, 0, ',', '.');
                    echo "%</td></tr><tr><th colspan=42> </th></tr>";

                }
                echo "<tr><td colspan=2></td><td colspan=40><center><b>$DPax[Department]</b></center></td></tr>";
                $Department = $DPax[Department];
                $TotalDepartNow = 0;
                $TotalDepartLast = 0;
                $TotalJanDepartNow = 0;
                $TotalJanDepartLast = 0;
                $TotalFebDepartNow = 0;
                $TotalFebDepartLast = 0;
                $TotalMarDepartNow = 0;
                $TotalMarDepartLast = 0;
                $TotalAprDepartNow = 0;
                $TotalAprDepartLast = 0;
                $TotalMayDepartNow = 0;
                $TotalMayDepartLast = 0;
                $TotalJunDepartNow = 0;
                $TotalJunDepartLast = 0;
                $TotalJulDepartNow = 0;
                $TotalJulDepartLast = 0;
                $TotalAgtDepartNow = 0;
                $TotalAgtDepartLast = 0;
                $TotalSepDepartNow = 0;
                $TotalSepDepartLast = 0;
                $TotalOctDepartNow = 0;
                $TotalOctDepartLast = 0;
                $TotalNovDepartNow = 0;
                $TotalNovDepartLast = 0;
                $TotalDecDepartNow = 0;
                $TotalDecDepartLast = 0;

            }

            echo "<tr>
					 <td>$No</td>
					 <td><center>$DPax[Description]  $DPax[Department]</td>
					 <td style='text-align:right'>" . number_format($DPax[JanLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[JanNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[JanNow] / $DPax[JanLast] * 100, 0, ',', '.');
            echo "%</td>
					 					 
					 <td style='text-align:right'>" . number_format($DPax[FebLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[FebNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[FebNow] / $DPax[FebLast] * 100, 0, ',', '.');
            echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($DPax[MarLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[MarNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[MarNow] / $DPax[MarLast] * 100, 0, ',', '.');
            echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($DPax[AprLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[AprNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[AprNow] / $DPax[AprLast] * 100, 0, ',', '.');
            echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($DPax[MayLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[MayNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[MayNow] / $DPax[MayLast] * 100, 0, ',', '.');
            echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($DPax[JunLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[JunNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[JunNow] / $DPax[JunLast] * 100, 0, ',', '.');
            echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($DPax[JulLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[JulNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[JulNow] / $DPax[JulLast] * 100, 0, ',', '.');
            echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($DPax[AgtLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[AgtNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[AgtNow] / $DPax[AgtLast] * 100, 0, ',', '.');
            echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($DPax[SepLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[SepNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[SepNow] / $DPax[SepLast] * 100, 0, ',', '.');
            echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($DPax[OctLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[OctNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[OctNow] / $DPax[OctLast] * 100, 0, ',', '.');
            echo "%</td>

					 <td style='text-align:right'>" . number_format($DPax[NovLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[NovNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[NovNow] / $DPax[NovLast] * 100, 0, ',', '.');
            echo "%</td>

					 <td style='text-align:right'>" . number_format($DPax[DecLast], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[DecNow], 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($DPax[DecNow] / $DPax[DecLast] * 100, 0, ',', '.');
            echo "%</td>";

            $TotalNow = $DPax[JanNow] + $DPax[FebNow] + $DPax[MarNow] + $DPax[AprNow] + $DPax[MayNow] + $DPax[JunNow] + $DPax[JulNow] + $DPax[AgtNow] + $DPax[SepNow] + $DPax[OctNow] + $DPax[NovNow] + $DPax[DecNow];
            $TotalLast = $DPax[JanLast] + $DPax[FebLast] + $DPax[MarLast] + $DPax[AprLast] + $DPax[MayLast] + $DPax[JunLast] + $DPax[JulLast] + $DPax[AgtLast] + $DPax[SepLast] + $DPax[OctLast] + $DPax[NovLast] + $DPax[DecLast];

            echo "<td style='text-align:right'>" . number_format($TotalLast, 0, ',', '.');
            echo "</td><td style='text-align:right'>" . number_format($TotalNow, 0, ',', '.');
            if ($TotalNow < $TotalLast) {
                $warnaminus = "COLOR:Red;";
            } else {
                $warnaminus = "COLOR:black";
            }
            echo "</td><td style='text-align:right;$warnaminus'>" . number_format($TotalNow / $TotalLast * 100, 0, ',', '.');
            echo "%</td></tr>";

            $No++;
            $GrandTotalNow = $GrandTotalNow + $TotalNow;
            $GrandTotalLast = $GrandTotalLast + $TotalLast;
            $TotalDepartNow = $TotalDepartNow + $TotalNow;
            $TotalDepartLast = $TotalDepartLast + $TotalLast;

            $GrandJanNow = $GrandJanNow + $DPax[JanNow];
            $GrandJanLast = $GrandJanLast + $DPax[JanLast];
            $TotalJanDepartNow = $TotalJanDepartNow + $DPax[JanNow];
            $TotalJanDepartLast = $TotalJanDepartLast + $DPax[JanLast];

            $GrandFebNow = $GrandFebNow + $DPax[FebNow];
            $GrandFebLast = $GrandFebLast + $DPax[FebLast];
            $TotalFebDepartNow = $TotalFebDepartNow + $DPax[FebNow];
            $TotalFebDepartLast = $TotalFebDepartLast + $DPax[FebLast];

            $GrandMarNow = $GrandMarNow + $DPax[MarNow];
            $GrandMarLast = $GrandMarLast + $DPax[MarLast];
            $TotalMarDepartNow = $TotalMarDepartNow + $DPax[MarNow];
            $TotalMarDepartLast = $TotalMarDepartLast + $DPax[MarLast];

            $GrandAprNow = $GrandAprNow + $DPax[AprNow];
            $GrandAprLast = $GrandAprLast + $DPax[AprLast];
            $TotalAprDepartNow = $TotalAprDepartNow + $DPax[AprNow];
            $TotalAprDepartLast = $TotalAprDepartLast + $DPax[AprLast];

            $GrandMayNow = $GrandMayNow + $DPax[MayNow];
            $GrandMayLast = $GrandMayLast + $DPax[MayLast];
            $TotalMayDepartNow = $TotalMayDepartNow + $DPax[MayNow];
            $TotalMayDepartLast = $TotalMayDepartLast + $DPax[MayLast];

            $GrandJunNow = $GrandJunNow + $DPax[JunNow];
            $GrandJunLast = $GrandJunLast + $DPax[JunLast];
            $TotalJunDepartNow = $TotalJunDepartNow + $DPax[JunNow];
            $TotalJunDepartLast = $TotalJunDepartLast + $DPax[JunLast];

            $GrandJulNow = $GrandJulNow + $DPax[JulNow];
            $GrandJulLast = $GrandJulLast + $DPax[JulLast];
            $TotalJulDepartNow = $TotalJulDepartNow + $DPax[JulNow];
            $TotalJulDepartLast = $TotalJulDepartLast + $DPax[JulLast];

            $GrandAgtNow = $GrandAgtNow + $DPax[AgtNow];
            $GrandAgtLast = $GrandAgtLast + $DPax[AgtLast];
            $TotalAgtDepartNow = $TotalAgtDepartNow + $DPax[AgtNow];
            $TotalAgtDepartLast = $TotalAgtDepartLast + $DPax[AgtLast];

            $GrandSepNow = $GrandSepNow + $DPax[SepNow];
            $GrandSepLast = $GrandSepLast + $DPax[SepLast];
            $TotalSepDepartNow = $TotalSepDepartNow + $DPax[SepNow];
            $TotalSepDepartLast = $TotalSepDepartLast + $DPax[SepLast];

            $GrandOctNow = $GrandOctNow + $DPax[OctNow];
            $GrandOctLast = $GrandOctLast + $DPax[OctLast];
            $TotalOctDepartNow = $TotalOctDepartNow + $DPax[OctNow];
            $TotalOctDepartLast = $TotalOctDepartLast + $DPax[OctLast];

            $GrandNovNow = $GrandNovNow + $DPax[NovNow];
            $GrandNovLast = $GrandNovLast + $DPax[NovLast];
            $TotalNovDepartNow = $TotalNovDepartNow + $DPax[NovNow];
            $TotalNovDepartLast = $TotalNovDepartLast + $DPax[NovLast];

            $GrandDecNow = $GrandDecNow + $DPax[DecNow];
            $GrandDecLast = $GrandDecLast + $DPax[DecLast];
            $TotalDecDepartNow = $TotalDecDepartNow + $DPax[DecNow];
            $TotalDecDepartLast = $TotalDecDepartLast + $DPax[DecLast];


        }

        echo "<tr>
					 <td colspan=2><b>Total</td>
					 
					 <td style='text-align:right'>" . number_format($TotalJanDepartLast, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalJanDepartNow, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalJanDepartNow / $TotalJanDepartLast * 100, 0, ',', '.');
        echo "%</td>
					 					 
					 <td style='text-align:right'>" . number_format($TotalFebDepartLast, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalFebDepartNow, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalFebDepartNow / $TotalFebDepartLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($TotalMarDepartLast, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalMarDepartNow, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalMarDepartNow / $TotalMarDepartLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($TotalAprDepartLast, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalAprDepartNow, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalAprDepartNow / $TotalAprDepartLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($TotalMayDepartLast, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalMayDepartNow, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalMayDepartNow / $TotalMayDepartLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($TotalJunDepartLast, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalJunDepartNow, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalJunDepartNow / $TotalJunDepartLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($TotalJulDepartLast, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalJulDepartNow, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalJulDepartNow / $TotalJulDepartLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($TotalAgtDepartLast, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalAgtDepartNow, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalAgtDepartNow / $TotalAgtDepartLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($TotalSepDepartLast, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalSepDepartNow, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalSepDepartNow / $TotalSepDepartLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right'>" . number_format($TotalOctDepartLast, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalOctDepartNow, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalOctDepartNow / $TotalOctDepartLast * 100, 0, ',', '.');
        echo "%</td>

					 <td style='text-align:right'>" . number_format($TotalNovDepartLast, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalNovDepartNow, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalNovDepartNow / $TotalNovDepartLast * 100, 0, ',', '.');
        echo "%</td>

					 <td style='text-align:right'>" . number_format($TotalDecDepartLast, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalDecDepartNow, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalDecDepartNow / $TotalDecDepartLast * 100, 0, ',', '.');
        echo "%</td>";


        $TotalDepartNow = $TotalJanDepartNow + $TotalFebDepartNow + $TotalMarDepartNow + $TotalAprDepartNow + $TotalMayDepartNow + $TotalJunDepartNow + $TotalJulDepartNow + $TotalAgtDepartNow + $TotalSepDepartNow + $TotalOctDepartNow + $TotalNovDepartNow + $TotalDecDepartNow;
        $TotalDepartLast = $TotalJanDepartLast + $TotalFebDepartLast + $TotalMarDepartLast + $TotalAprDepartLast + $TotalMayDepartLast + $TotalJunDepartLast + $TotalJulDepartLast + $TotalAgtDepartLast + $TotalSepDepartLast + $TotalOctDepartLast + $TotalNovDepartLast + $TotalDecDepartLast;

        echo "<td style='text-align:right'>" . number_format($TotalDepartLast, 0, ',', '.');
        echo "</td><td style='text-align:right'>" . number_format($TotalDepartNow, 0, ',', '.');
        if ($GrandTotalNow < $GrandTotalLast) {
            $warnaminus = "COLOR:Red;";
        } else {
            $warnaminus = "COLOR:black";
        }
        echo "</td><td style='text-align:right;$warnaminus'>" . number_format($TotalDepartNow / $TotalDepartLast * 100, 0, ',', '.');
        echo "%</td></tr><tr><th colspan=42></th></tr>";


        //Total keseluruhan
        echo "<tr>
					 <td colspan=2 style='background-color: #000000; color:#FFFFFF'><b>Grand Total</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJanLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJanNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJanNow / $GrandJanLast * 100, 0, ',', '.');
        echo "%</td>
					 					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandFebLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandFebNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandFebNow / $GrandFebLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandMarLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandMarNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandMarNow / $GrandMarLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandAprLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandAprNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandAprNow / $GrandAprLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandMayLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandMayNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandMayNow / $GrandMayLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJunLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJunNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJunNow / $GrandJunLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJulLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJulNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandJulNow / $GrandJulLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandAgtLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandAgtNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandAgtNow / $GrandAgtLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandSepLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandSepNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandSepNow / $GrandSepLast * 100, 0, ',', '.');
        echo "%</td>
					 
					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandOctLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandOctNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandOctNow / $GrandOctLast * 100, 0, ',', '.');
        echo "%</td>

					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandNovLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandNovNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandNovNow / $GrandNovLast * 100, 0, ',', '.');
        echo "%</td>

					 <td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandDecLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandDecNow, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandDecNow / $GrandDecLast * 100, 0, ',', '.');
        echo "%</td>";


        $GrandTotalNow = $GrandJanNow + $GrandFebNow + $GrandMarNow + $GrandAprNow + $GrandMayNow + $GrandJunNow + $GrandJulNow + $GrandAgtNow + $GrandSepNow + $GrandOctNow + $GrandNovNow + $GrandDecNow;
        $GrandTotalLast = $GrandJanLast + $GrandFebLast + $GrandMarLast + $GrandAprLast + $GrandMayLast + $GrandJunLast + $GrandJulLast + $GrandAgtLast + $GrandSepLast + $GrandOctLast + $GrandNovLast + $GrandDecLast;

        echo "<td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandTotalLast, 0, ',', '.');
        echo "</td><td style='text-align:right;background-color: #000000; color:#FFFFFF'>" . number_format($GrandTotalNow, 0, ',', '.');
        if ($GrandTotalNow < $GrandTotalLast) {
            $warnaminus = "COLOR:Red;";
        } else {
            $warnaminus = "COLOR:black";
        }
        echo "</td><td style='text-align:right;$warnaminus;background-color: #000000; color:#FFFFFF'>" . number_format($GrandTotalNow / $GrandTotalLast * 100, 0, ',', '.');
        echo "%</td></tr>";

        echo "<tbody></table></div>
        			<div class='clear'></div></div><br><center><input type=button value=Close onclick=self.history.back()><br>";


        break;

}
?>