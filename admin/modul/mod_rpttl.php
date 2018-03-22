
<SCRIPT LANGUAGE="Javascript" SRC="FusionChartsXT/Code/FusionCharts/FusionCharts.js"></SCRIPT>
<SCRIPT language='Javascript'>
<!-- input just numeric, if input with character is not allowed
function isNumberKey(evt)
{
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;

 return true;
}
//-->
function PopupCenter(pageURL, ID,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
function generateexcel(tableid) {
  var table= document.getElementById(tableid);
  var html = table.outerHTML;
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
}
</SCRIPT>
<?php
include("FusionChartsXT/Code/PHP/Includes/FusionCharts.php");  
include("FusionChartsXT/Code/PHP/Includes/DBConn.php");
$CompanyID=$_SESSION['company_id'];
switch($_GET[act]){
  // Tampilan header
   default:
   
   	$hariini = date("Y-m-d");
    $thnini = date("Y");
    $yer=$_GET['year'];
	$TL=$_GET['TLnama'];
	$Category=$_GET['Category'];
	if($Category==''){$Category='INHOUSE';}else{$Category=$Category;}
	if($yer==''){$yer=$thnini;} 
    
    echo "<h2>Report Tourleader</h2>
			   	
    <form method='get' action='media.php?'><input type=hidden name=module value='rpttl'>   
		      
    Year &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  <select name='year' ><option value='0' >- Select Year -</option>";
    $tampil=mysql_query("SELECT Year FROM tour_msproduct where year <>'' group BY Year asc");
            while($s=mysql_fetch_array($tampil)){  // <input type='button' value='Cek Seat' onclick=ceking() >
               if($yer==$s[Year]){
                    echo "<option value='$s[Year]' selected>$s[Year]</option>";     
                }else { 
                echo "<option value='$s[Year]' >$s[Year]</option>";
                } 
            }
			
    echo "</select> &nbsp;&nbsp;
	<select name='Category' onChange=ganti()>
              <option value='INHOUSE' ";if($Category=='INHOUSE'){echo"selected";}echo">INHOUSE</option>
              <option value='FREELANCE' ";if($Category=='FREELANCE'){echo"selected";}echo">FREELANCE</option>
              </select>
		";
	 echo "<br>Tourleader Name : <input type=text name=TLnama value='$nama' size=20>
              <input type=submit name='submit' size='20'value='View'>
          </form>";
          $oke=$_GET['oke'];	
	  
	//echo "<h><u>Report Tourleader Period  $yer </u></h><br>";

// xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
// DATA QUERY
 
		  if ($TL=='') {

			  $DataTL = mysql_query("SELECT tour_msproducttl.TLName as TLName ,tour_msproducttl.EmployeeID, sum(if(month(DateTravelFrom)='1',1,0)) as JAN, sum(if(month(DateTravelFrom)='2',1,0)) as FEB , sum(if(month(DateTravelFrom)='3',1,0)) as MAR, sum(if(month(DateTravelFrom)='4',1,0)) as APR, sum(if(month(DateTravelFrom)='5',1,0)) as MAY, sum(if(month(DateTravelFrom)='6',1,0)) as JUN, sum(if(month(DateTravelFrom)='7',1,0)) as JUL, sum(if(month(DateTravelFrom)='8',1,0)) as AUG, sum(if(month(DateTravelFrom)='9',1,0)) as SEP , sum(if(month(DateTravelFrom)='10',1,0)) as OCT, sum(if(month(DateTravelFrom)='11',1,0)) as NOV, sum(if(month(DateTravelFrom)='12',1,0)) as DES, count(tour_msproducttl.IDProduct) as Total,score
										FROM `tour_msproducttl` 
										inner join tour_msproduct on tour_msproduct.IDProduct=tour_msproducttl.IDProduct
										left join (SELECT Tourleader,EmployeeID,round(avg ((inPerjalanan+inInformasi+inSuasana+inAcara+inMasalah)/5),2) as score FROM tbl_trquestion  where IDTourcode in (select  IDProduct from tour_msproduct WHERE  year(DateTravelFrom)='$yer' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa ) group by EmployeeID)Questioner on Questioner.EmployeeID=tour_msproducttl.EmployeeID WHERE  year(DateTravelFrom)='$yer' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa  and tour_msproduct.CompanyId=$CompanyID and EmployeeType='$Category' group by tour_msproducttl.Employeeid order by TLName  asc ");
		  } else {
			  $DataTL = mysql_query("SELECT tour_msproducttl.TLName as TLName ,tour_msproducttl.EmployeeID, sum(if(month(DateTravelFrom)='1',1,0)) as JAN, sum(if(month(DateTravelFrom)='2',1,0)) as FEB , sum(if(month(DateTravelFrom)='3',1,0)) as MAR, sum(if(month(DateTravelFrom)='4',1,0)) as APR, sum(if(month(DateTravelFrom)='5',1,0)) as MAY, sum(if(month(DateTravelFrom)='6',1,0)) as JUN, sum(if(month(DateTravelFrom)='7',1,0)) as JUL, sum(if(month(DateTravelFrom)='8',1,0)) as AUG, sum(if(month(DateTravelFrom)='9',1,0)) as SEP , sum(if(month(DateTravelFrom)='10',1,0)) as OCT, sum(if(month(DateTravelFrom)='11',1,0)) as NOV, sum(if(month(DateTravelFrom)='12',1,0)) as DES, count(tour_msproducttl.IDProduct) as Total,score  FROM `tour_msproducttl`
										inner join tour_msproduct on tour_msproduct.IDProduct=tour_msproducttl.IDProduct
										left join (SELECT Tourleader,EmployeeID,round(avg ((inPerjalanan+inInformasi+inSuasana+inAcara+inMasalah)/5),2)  as score FROM tbl_trquestion  where IDTourcode in (select  IDProduct from tour_msproduct WHERE  year(DateTravelFrom)='$yer' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa ) group by EmployeeID)Questioner on Questioner.EmployeeID=tour_msproducttl.EmployeeID WHERE  year(DateTravelFrom)='$yer' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa  and tour_msproduct.CompanyId=$CompanyID  and EmployeeType='$Category' and tour_msproducttl.TLName like '%$TL%' group by tour_msproducttl.Employeeid order by TLName  asc");
		  }
	
	$JumData = mysql_num_rows($DataTL);

	
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
	if ($JumData > 0){   
	
  //munculin table
	 $No=1;

	
	 echo" <table id='tabletl'>
			<tr><th colspan='17'>Report Tourleader Period  $yer</th></tr>
			<tr><th>No</th><th>Tourleader</th><th>JAN</th><th>FEB</th><th>MAR</th><th>APR</th><th>MAY</th><th>JUN</th><th>JUL</th><th>AUG</th><th>SEP</th><th>OCT</th><th>NOV</th><th>DEC</th><th>TOTAL</th><th colspan=2>SCORE</th></tr>";
while($DDataTL=mysql_fetch_array($DataTL)){
          
			$berangkat=mysql_query("SELECT * FROM `tour_msproducttl` inner join tour_msproduct on tour_msproduct.IDProduct=tour_msproducttl.IDProduct WHERE  year(DateTravelFrom)='$yer' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and tour_msproducttl.EmployeeID='$DDataTL[EmployeeID]' and DateTravelFrom< '$hariini'  and tour_msproduct.CompanyId=$CompanyID");
			$Jumberangkat = mysql_num_rows($berangkat);
			
			echo "<tr>
			  <td style='text-align:left' bgcolor='$Colour'>$No</td>
			 <td style='text-align:left' bgcolor='$Colour'><a href='./media.php?module=rpttl&act=dtlTourleader&TL=$DDataTL[EmployeeID]&Thn=$yer'>$DDataTL[TLName]</a></td>
             <td style='text-align:right' bgcolor='$Colour'>".number_format($DDataTL[JAN], 0, ',', '.');echo"</td>
             <td style='text-align:right' bgcolor='$Colour'>".number_format($DDataTL[FEB], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='$Colour'>".number_format($DDataTL[MAR], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='$Colour'>".number_format($DDataTL[APR], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='$Colour'>".number_format($DDataTL[MAY], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='$Colour'>".number_format($DDataTL[JUN], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='$Colour'>".number_format($DDataTL[JUL], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='$Colour'>".number_format($DDataTL[AUG], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='$Colour'>".number_format($DDataTL[SEP], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='$Colour'>".number_format($DDataTL[OCT], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='$Colour'>".number_format($DDataTL[NOV], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='$Colour'>".number_format($DDataTL[DES], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='$Colour'>".number_format($DDataTL[Total], 0, ',', '.');echo"</td>
			 <td style='text-align:right' bgcolor='$Colour'>".number_format($DDataTL[score], 2, ',', '.');echo"</td>
			 <td style='text-align:center' bgcolor='$Colour'><center>";
			 if($Jumberangkat >0){
			if($DDataTL[score]<=1){echo"<img src='../admin/images/smile/bad.jpg'/>";}
			if($DDataTL[score]>1 and $DDataTL[score]<=1.5){echo"<img src='../admin/images/smile/sad.jpg' />";}
			if($DDataTL[score]>1.5 and $DDataTL[score]<=2){echo"<img src='../admin/images/smile/ok.jpg' />";}
			if($DDataTL[score]>2){echo"<img src='../admin/images/smile/happy.jpg' />";};}
			else
			{echo"NONE";}
			
			echo"</center></td></tr>";
		$No++;}
		echo "</table><br><center><input type='button' name='submit' value='Export to Excel' onclick=generateexcel('tabletl')>";
		}
	else	
	{ echo "NO TRANSACTION AVAILABLE IN $yer";
	} 
  
  break;   
	
	case "dtlTourleader" :
	 
			$QuestionerTL=mysql_query("SELECT tour_msproducttl.TLName as TLName ,Questioner.EmployeeID,tour_msproduct.IDProduct, tour_msproduct.TourCode,Destination,DateTravelFrom,seat,score
			FROM `tour_msproducttl` inner join tour_msproduct on tour_msproduct.IDProduct=tour_msproducttl.IDProduct 
			left join (SELECT IDTourcode,Tourleader,EmployeeID,round(avg ((inPerjalanan+inInformasi+inSuasana+inAcara+inMasalah)/5),2) as score
			FROM tbl_trquestion group by IDTourcode,Tourleader )Questioner on Questioner.IDTourcode=tour_msproducttl.IDProduct 
			and Questioner.EmployeeID =  tour_msproducttl.EmployeeID  WHERE
			year(DateTravelFrom)='$_GET[Thn]' and tour_msproduct.TourCode<>'' and Seat<>SeatSisa  and tour_msproduct.CompanyID=$CompanyID
			and tour_msproducttl.EmployeeID = '$_GET[TL]' group by IDProduct order by Destination,datetravelfrom  asc");
			
			$NoP=1;
 
	
	 echo" <table>
			<tr><th>No</th><th>Tour Code </th><th>Destination</th><th>Departure</th><th>Pax</th><th colspan=2>Score</th></tr>"; 
while($DQuestTL=mysql_fetch_array($QuestionerTL)){
			  $dtf= date("d-m-Y", strtotime($DQuestTL[DateTravelFrom]));
			echo "<tr>
			  <td style='text-align:left'>$NoP</td>
			 <td style='text-align:left'><a href='./media.php?module=rpttl&act=dtlQuestioner&ID=$DQuestTL[IDProduct]&TL=$DQuestTL[EmployeeID]'>$DQuestTL[TourCode]</a></td>
			 <td style='text-align:left'>$DQuestTL[Destination]</td>
			 <td style='text-align:left'>$dtf</td>
			 <td style='text-align:left'>$DQuestTL[seat]</td>
			 <td style='text-align:right' >".number_format($DQuestTL[score], 2, ',', '.');echo"</td>
			 <td style='text-align:center'><center>";
			if($DQuestTL[score]<=1){echo"<img src='../admin/images/smile/bad.jpg'/>";}
			if($DQuestTL[score]>1 and $DQuestTL[score]<=1.5){echo"<img src='../admin/images/smile/sad.jpg' />";}
			if($DQuestTL[score]>1.5 and $DQuestTL[score]<=2){echo"<img src='../admin/images/smile/ok.jpg' />";}
			if($DQuestTL[score]>2){echo"<img src='../admin/images/smile/happy.jpg' />";}
			echo"</center></td></tr>";
		$NoP++;}
		echo "</table><br><center><input type=button value='Back' onclick=self.history.back()><br>";
			
			
	break;



	case "dtlQuestioner" :
			$tampil=mysql_query("SELECT   *, round(avg((extAcara+extPenerbangan+extTransportasi+extWisata+extAkomodasi+extSajian+extBelanja+extPemandu+extTLpanorama)/9),2) as perjalanan, round(avg((inOperator+inTourConsultant+inKasir+inDocument+inAirport)/5),2) as Staff , round(avg ((inPerjalanan+inInformasi+inSuasana+inAcara+inMasalah)/5),2) as TL,round(avg((extAcara+extPenerbangan+extTransportasi+extWisata+extAkomodasi+extSajian+extBelanja+extPemandu+extTLpanorama+inOperator+inTourConsultant+inKasir+inDocument+inAirport+inPerjalanan+inInformasi+inSuasana+inAcara+inMasalah)/19),2) as semua
			 FROM tbl_trquestion  where tbl_trquestion.Status<>'VOID' and IDTourcode='$_GET[ID]'  and EmployeeID='$_GET[TL]' group by QuestionID order by QuestionID desc");
			
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			//header
			$QHeader=mysql_query("SELECT   * FROM tour_msproduct  where IDProduct ='$_GET[ID]'");
			$DHeader=mysql_fetch_array($QHeader);
			$dari = date("d M Y", strtotime($DHeader[DateTravelFrom]));
			echo"<table style='border:none';>
			<tr><td style='border:none';>Tour Code</td><td style='border:none';></td><td style='border:none';>: $DHeader[TourCode]</td></tr>
			<tr><td style='border:none';>Tour Leader</td><td style='border:none';></td><td style='border:none';>: $DHeader[TourLeader]</td></tr>
			<tr><td style='border:none';>Departure date</td><td style='border:none';></td><td style='border:none';>: $dari</td></tr>
			</table>";
		
			//Detail
			echo "<table>
          		  <tr><th>no</th><th>Questioner</th><th>Name</th><th>Trip</th><th>Staff</th><th>Tourleader</th><th colspan=2>Average</th><th>action</th></tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
			   echo "<tr><td>$no</td>
                     <td>$data[QuestionID]</td>
					 <td><left>$data[Nama]</td> 
					  <td><center>$data[perjalanan]</td> 
					  <td><center>$data[Staff]</td> 
					  <td><center>$data[TL]</td>  
					  <td><center>$data[semua]</td> 
					  <td><center>";
							if($data[semua]<=1){echo"<img src='../admin/images/smile/bad.jpg'/>";}
							if($data[semua]>1 and $data[semua]<=1.5){echo"<img src='../admin/images/smile/sad.jpg' />";}
							if($data[semua]>1.5 and $data[semua]<=2){echo"<img src='../admin/images/smile/ok.jpg' />";}
							if($data[semua]>2){echo"<img src='../admin/images/smile/happy.jpg' />";}
					  echo"</center></td> 
					 <td><center><a href=\"javascript:PopupCenter('./viewquestioner.php?id=$data[QuestionID]','variable',895,550)\">View</a>
					 </td></tr>";
					  $no++;
					} 
					echo "</table>  <center><input type=button value='Back' onclick=self.history.back()><br><br>";
					}
			else
			{
			echo "<center> SORRY,  DATA NOT FOUND </center>";
			echo "<center><input type=button value='Back' onclick=self.history.back()><br><br>";
			}
			
			
	break;

 }        
?>
