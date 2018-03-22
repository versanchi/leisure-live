<?php 
switch($_GET[act]){
  // Tampil Office
  default:
    $blnini = date("m");
    $thnini = date("Y");
    $mont=$_GET['bulan'];
    $yer=$_GET['year'];
    $grup=$_GET['grup']; 
    if($mont==''){$mont=$blnini;}
    if($yer==''){$yer=$thnini;}
	if($grup==''){$grup='ALL';}
    echo "<h2>Realisasi BSO $yer</h2>
          <form method='get' action='media.php?'><input type=hidden name=module value='rptrealisasi'>        
              Month <select name='bulan' >
                      <option value='01'";if($mont=='01'){echo"selected";}echo">JAN</option>
                      <option value='02'";if($mont=='02'){echo"selected";}echo">FEB</option>
					  <option value='03'";if($mont=='03'){echo"selected";}echo">MAR</option>
					  <option value='04'";if($mont=='04'){echo"selected";}echo">APR</option>
                      <option value='05'";if($mont=='05'){echo"selected";}echo">MAY</option>
					  <option value='06'";if($mont=='06'){echo"selected";}echo">JUN</option>
					  <option value='07'";if($mont=='07'){echo"selected";}echo">JUL</option>
                      <option value='08'";if($mont=='08'){echo"selected";}echo">AUG</option>
					  <option value='09'";if($mont=='09'){echo"selected";}echo">SEP</option>
					  <option value='10'";if($mont=='10'){echo"selected";}echo">OCT</option>
                      <option value='11'";if($mont=='11'){echo"selected";}echo">NOV</option>
					  <option value='12'";if($mont=='12'){echo"selected";}echo">DEC</option>
                      </select>
              Year <select name='year' ><option value='0' >- Select Year -</option>";
            $tampil=mysql_query("SELECT Year FROM tour_msproduct group BY Year asc");
            while($s=mysql_fetch_array($tampil)){  // <input type='button' value='Cek Seat' onclick=ceking() >
               if($yer==$s[Year]){
                    echo "<option value='$s[Year]' selected>$s[Year]</option>";     
                }else { 
                echo "<option value='$s[Year]' >$s[Year]</option>";
                } 
            }
    echo "</select><br>
          Group <select name='grup' >
                      <option value='ALL'";if($grup==''){echo"selected";}echo">ALL</option>
                      <option value='PANORAMA TOURS'";if($grup=='PANORAMA TOURS'){echo"selected";}echo">PANORAMA TOURS</option>
                      <option value='PANORAMA WORLD'";if($grup=='PANORAMA WORLD'){echo"selected";}echo">PANORAMA WORLD</option>
                      <option value='SISTER COMPANY'";if($grup=='SISTER COMPANY'){echo"selected";}echo">SISTER COMPANY</option>
                      </select>  
              <input type=submit name='submit' size='20'value='View'>
          </form>";
          $oke=$_GET['oke']; 
		  if($grup=='ALL'){                       
          $Divisi=mysql_query("SELECT office_code from tbl_msoffice  order by office_group ASC,office_code ASC");}else
		  {if($grup=='PANORAMA TOURS'){
		  $Divisi=mysql_query("SELECT office_code from tbl_msoffice where office_group='PANORAMA TOURS' and office_bso='YES'  order by office_code ASC");}else{
		 $Divisi=mysql_query("SELECT office_code from tbl_msoffice where office_group LIKE '%$grup%'   order by office_code ASC ");};}

          $jumlah=mysql_num_rows($Divisi); 
		  
            if ($jumlah > 0) { 
                    if($mont=='01'){$bulan='JANUARI';} 
					elseif($mont=='02'){$bulan='FEBRUARI';$bulans='JANUARI';}
                    elseif($mont=='03'){$bulan='MARET';$bulans='- FEBRUARI';} 
					elseif($mont=='04'){$bulan='APRIL';$bulans='- MARET';}
                    elseif($mont=='05'){$bulan='MEI';$bulans='- APRIL';} 
					elseif($mont=='06'){$bulan='JUNI';$bulans='- MEI';}
                    elseif($mont=='07'){$bulan='JULI';$bulans='- JUNI';} 
					elseif($mont=='08'){$bulan='AGUSTUS';$bulans='- JULI';}
                    elseif($mont=='09'){$bulan='SEPTEMBER';$bulans='- AGUSTUS';} 
					elseif($mont=='10'){$bulan='OKTOBER';$bulans='- SEPTEMBER';}
                    elseif($mont=='11'){$bulan='NOVEMBER';$bulans='- OKTOBER';} 
					elseif($mont=='12'){$bulan='DESEMBER';$bulans='- NOVEMBER';}
                    $blnsblm=$mont-1;


                    if($mont <>'01'){ 
					//tampilan kalau bukan bulan januari       
           			echo " <table>   
                    <tr><th colspan='5'>JANUARI $bulans $yer</th><th colspan='4'>$bulan $yer</th><th colspan='4'>JANUARI - $bulan $yer</th></tr>
                    <tr><th>BSO</th><th>TMR</th><th>SERIES</th><th>PMT</th><th><b><i>total pax</i></b></th>
                    <th>TMR</th><th>SERIES</th><th>PMT</th><th><b><i>total pax</i></b></th>
                    <th>TMR</th><th>SERIES</th><th>PMT</th><th><b><i>total pax</i></b></th></tr>";   
                    
					  $TTMR=0;
					  $TSeries=0;
					  $TPMT=0;
					  $TTotal=0;
					 
					  $LTMR=0;
					  $LSeries=0;
					  $LPMT=0;
					  $LTotal=0;
					 
					  $NTMR=0;
					  $NSeries=0;
					  $NPMT=0;
					  $NTotal=0;
					 
						
					while ($Ddivision=mysql_fetch_array($Divisi)){
                   
				   $tampil=mysql_query("SELECT TCDivision,Destination,sum(if(GroupType ='TMR' ,AdultPax+ChildPax,0)) as PaxTMR,sum(if(GroupType <>'TMR' and Department='LEISURE' ,AdultPax+ChildPax,0)) as PaxSeries,sum(if(GroupType <>'TMR' and Department<>'LEISURE' ,AdultPax+ChildPax,0)) as PaxPMT, sum(AdultPax+ChildPax) as Total ,sum(TotalPrice+((AdultPax+ChildPax)*TaxInsSell)) as Harga FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode)  left join tbl_msoffice on tbl_msoffice.office_code = tour_msbooking.TCDivision where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and month(DateTravelFrom)=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision<>'' and TCDivision='$Ddivision[office_code]'  and TCDivision<>'LTM' group by TCDivision order by office_group ASC,office_code ASC");
				   $DBooking=mysql_fetch_array($tampil);
				   
				   //bulan sebelumnya
				   $LastBooking=mysql_query("SELECT TCDivision,Destination,sum(if(GroupType ='TMR' ,AdultPax+ChildPax,0)) as PaxTMR,sum(if(GroupType <>'TMR' and Department='LEISURE' ,AdultPax+ChildPax,0)) as PaxSeries,sum(if(GroupType <>'TMR' and Department<>'LEISURE' ,AdultPax+ChildPax,0)) as PaxPMT, sum(AdultPax+ChildPax) as Total ,sum(TotalPrice+((AdultPax+ChildPax)*TaxInsSell)) as Harga FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode)  left join tbl_msoffice on tbl_msoffice.office_code = tour_msbooking.TCDivision where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and month(DateTravelFrom)<$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision<>''  and  TCDivision='$Ddivision[office_code]'  and TCDivision<>'LTM' group by TCDivision order by office_group ASC,office_code ASC");
				   $LBooking=mysql_fetch_array($LastBooking);
						  
						 //next booking 
				    $NextBooking=mysql_query("SELECT TCDivision,Destination,sum(if(GroupType ='TMR' ,AdultPax+ChildPax,0)) as PaxTMR,sum(if(GroupType <>'TMR' and Department='LEISURE' ,AdultPax+ChildPax,0)) as PaxSeries,sum(if(GroupType <>'TMR' and Department<>'LEISURE' ,AdultPax+ChildPax,0)) as PaxPMT, sum(AdultPax+ChildPax) as Total ,sum(TotalPrice+((AdultPax+ChildPax)*TaxInsSell)) as Harga FROM tour_msbooking inner join tour_msproduct on (tour_msproduct.year =tour_msbooking.year and tour_msproduct.TourCode=tour_msbooking.TourCode)  left join tbl_msoffice on tbl_msoffice.office_code = tour_msbooking.TCDivision where tour_msproduct.Status <> 'VOID' and tour_msbooking.status='ACTIVE' and BookingStatus='DEPOSIT' and month(DateTravelFrom)<=$mont and year(DateTravelFrom)=$yer and tour_msproduct.TourCode<>'' and Seat<>SeatSisa and TCDivision<>'' and  TCDivision='$Ddivision[office_code]' and TCDivision<>'LTM' group by TCDivision order by office_group ASC,office_code ASC");
				   $NBooking=mysql_fetch_array($NextBooking);
						  
					  echo "<tr>
					 <td bgcolor='#FFFF66'>$Ddivision[office_code]</td>
					 <td style='text-align:right' bgcolor='#FFFF66'>".number_format($LBooking[PaxTMR], 0, ',', '.');echo"</td>
					 <td style='text-align:right' bgcolor='#FFFF66'>".number_format($LBooking[PaxSeries], 0, ',', '.');echo"</td>
					 <td style='text-align:right' bgcolor='#FFFF66'>".number_format($LBooking[PaxPMT], 0, ',', '.');echo"</td>
					 <td style='text-align:right' bgcolor='#FFFF66'>".number_format($LBooking[Total], 0, ',', '.');echo"</td>

					  <td style='text-align:right'>".number_format($DBooking[PaxTMR], 0, ',', '.');echo"</td>
					 <td style='text-align:right'>".number_format($DBooking[PaxSeries], 0, ',', '.');echo"</td>
					 <td style='text-align:right'>".number_format($DBooking[PaxPMT], 0, ',', '.');echo"</td>
					 <td style='text-align:right'>".number_format($DBooking[Total], 0, ',', '.');echo"</td>

					  <td style='text-align:right' bgcolor='#D1EEFC'>".number_format($NBooking[PaxTMR], 0, ',', '.');echo"</td>
					 <td style='text-align:right' bgcolor='#D1EEFC'>".number_format($NBooking[PaxSeries], 0, ',', '.');echo"</td>
					 <td style='text-align:right' bgcolor='#D1EEFC'>".number_format($NBooking[PaxPMT], 0, ',', '.');echo"</td>
					 <td style='text-align:right' bgcolor='#D1EEFC'>".number_format($NBooking[Total], 0, ',', '.');echo"</td>

					 </tr>";
				$LTMR=$LTMR+$LBooking[PaxTMR];
				$LSeries=$LSeries+$LBooking[PaxSeries];
				$LPMT=$LPMT+$LBooking[PaxPMT];
				$LTotal=$LTotal+$LBooking[Total];

				$TTMR=$TTMR+$DBooking[PaxTMR];
				$TSeries=$TSeries+$DBooking[PaxSeries];
				$TPMT=$TPMT+$DBooking[PaxPMT];
				$TTotal=$TTotal+$DBooking[Total];

				$NTMR=$NTMR+$NBooking[PaxTMR];
				$NSeries=$NSeries+$NBooking[PaxSeries];
				$NPMT=$NPMT+$NBooking[PaxPMT];
				$NTotal=$NTotal+$NBooking[Total];

				};
				
			echo "<tr><th>Total</th><th style='text-align:right'>".number_format($LTMR, 0, ',', '.');
			echo"</th><th style='text-align:right'>".number_format($LSeries, 0, ',', '.');
			echo"</th><th style='text-align:right'>".number_format($LPMT, 0, ',', '.');
			echo"</th><th style='text-align:right'>".number_format($LTotal, 0, ',', '.');

			echo "</th><th style='text-align:right'>".number_format($TTMR, 0, ',', '.');
			echo"</th><th style='text-align:right'>".number_format($TSeries, 0, ',', '.');
			echo"</th><th style='text-align:right'>".number_format($TPMT, 0, ',', '.');
			echo"</th><th style='text-align:right'>".number_format($TTotal, 0, ',', '.');

			echo "</th><th style='text-align:right'>".number_format($NTMR, 0, ',', '.');
			echo"</th><th style='text-align:right'>".number_format($NSeries, 0, ',', '.');
			echo"</th><th style='text-align:right'>".number_format($NPMT, 0, ',', '.');
			echo"</th><th style='text-align:right'>".number_format($NTotal, 0, ',', '.');

			echo"</th></tr>	</table>";
                   
		}else{
					echo "<table>   <tr><th colspan='6'>JANUARI $yer</th></tr>
                    <tr><th>BSO</th><th>SERIES</th><th>TMR</th><th>PMT</th><th><b><i>total pax</i></b></th></tr>";   
                   
					  $TTMR=0;
					  $TSeries=0;
					  $TPMT=0;
					  $TTotal=0;
					 
						
					while ($DBooking=mysql_fetch_array($tampil)){
                    
					  echo "<tr>
					 <td>$DBooking[TCDivision]</td>
					  <td style='text-align:right'>".number_format($DBooking[PaxTMR], 0, ',', '.');echo"</td>
					 <td style='text-align:right'>".number_format($DBooking[PaxSeries], 0, ',', '.');echo"</td>
					 <td style='text-align:right'>".number_format($DBooking[PaxPMT], 0, ',', '.');echo"</td>
					 <td style='text-align:right'>".number_format($DBooking[Total], 0, ',', '.');echo"</td>
					 
					 </tr>";
				$TTMR=$TTMR+$DBooking[PaxTMR];
				$TSeries=$TSeries+$DBooking[PaxSeries];
				$TPMT=$TPMT+$DBooking[PaxPMT];
				$TTotal=$TTotal+$DBooking[Total];
				
				};
				
			echo "<tr><th>Total</th><th style='text-align:right'>".number_format($TTMR, 0, ',', '.');
			echo "</th><th style='text-align:right'>".number_format($TSeries, 0, ',', '.');
			echo"</th><th style='text-align:right'>".number_format($TPMT, 0, ',', '.');
			echo"</th><th style='text-align:right'>".number_format($TTotal, 0, ',', '.');
			
			echo"</th></tr>	</table>";
                   
		
                 
            }
			}else{echo"<center><font size=2 color=blue>DATA NOT FOUND</font><br><br>";}    
            echo"<center><input type=button value=Close onclick=location.href='?module=home'><br><br>"; 
			
    break;               
}
?>
