<STYLE TYPE="text/css">
    P.breakhere {page-break-before: always}
    body{
        font-family: tahoma;
    }
</STYLE>

<?php
include "../config/koneksi.php";
include "../config/koneksimaster.php";
// Bagian Home            
    $ulangprint=$_GET[ulang];
    $ulangin=1;
	  $baris=0;
	 $kolom=1;
	
    for($ulang=0;$ulang<$ulangprint;$ulang++){
    $IDProduct=$_GET[nama];
         $ambil=mysql_query("SELECT tour_msproduct.IDProduct,tour_msproduct.TourCode,tour_msproduct.Year,TCDivision,tour_msbooking.BookingID,
                    tour_msproductcode.Productcode,tour_msproduct.DateTravelFrom,tour_msproduct.DateTravelTo,tour_msproduct.TourLeaderInc,tour_msproduct.TourLeader,
                    tour_msproduct.Flight,tour_msproduct.GroupType FROM tour_msproduct
                    left join tour_msbooking on tour_msbooking.IDTourcode = tour_msproduct.IDProduct
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode
                    WHERE tour_msproduct.IDProduct ='$IDProduct'");
         $isi=mysql_fetch_array($ambil);
         $fly=mysql_query("SELECT * FROM tour_msairlines                                                 
                                        WHERE AirlinesID ='$isi[Flight]'");
         $flight=mysql_fetch_array($fly);
         $edit=mysql_query("SELECT tour_msbookingdetail.*,tour_msbooking.TBFNo,CONVERT(RoomNo, UNSIGNED INTEGER) as urut FROM tour_msbookingdetail
                    left join tour_msbooking on tour_msbooking.BookingID = tour_msbookingdetail.BookingID
                    WHERE tour_msbooking.IDTourcode ='$isi[IDProduct]'
                    AND tour_msbooking.Status = 'ACTIVE'
                    AND tour_msbookingdetail.Status <> 'CANCEL'
                    order by urut, tour_msbooking.BookingID ASC,IDDetail ASC");
         $jum=mysql_num_rows($edit);
         $depdet = date("d M", strtotime($isi[DateTravelFrom]));
         $arrdet = date("d M Y", strtotime($isi[DateTravelTo]));      
		 
		 $i=1;$bts=2;$bf=1;
		
   if($isi[TourLeaderInc]=='YES'){
	        
           $cariteel=mysql_query("SELECT * FROM tour_msproducttl   
                                where IDProduct = '$isi[IDProduct]'
                                AND TLStatus = 'FINAL' 
                                order by IDPTL ASC");        
           $hasilteel=mysql_num_rows($cariteel);

           if($hasilteel>0){


           while($tlnya=mysql_fetch_array($cariteel)){
               $carisatu=mssql_query("SELECT * FROM [HRM].[dbo].[Employee]
                                    where EmployeeID = '$tlnya[EmployeeID]'
                                    AND StatusTL = 'APPROVED'
                                    order by EmployeeName ASC");
               $hasilsatu=mssql_num_rows($carisatu);


               if($hasilsatu>0){

                   while($datatl=mssql_fetch_array($carisatu)){
                           $panjang=strlen($datatl[EmployeeName]);
                            $stourcode=strlen($isi[TourCode]);
                            if($panjang<28){$s='18px';}else{$s='16px';}
                            if($stourcode<25){$st='12px';}else{$st='10px';}
                            if($kolom==1){
                                $baris++;
                        echo" <table border='0' style=font-size:14 height='150'>
                         <tr height=6></tr><tr><td width='275'> ";}

				echo "
             <table width='250' border='0' align='center' cellpadding='0' cellspacing='0' style=font-size:9>
             <tr><td height='52' width='40' style='border-top: 0px solid #000000;border-bottom: 0px solid #000000;border-left: 0px solid #000000;border-right: 1px solid #000000;'><font size='5'><b>$i</font></td>
                    <td style='font-size:$s';><center><b>$datatl[Title] $datatl[NameAsPassport] (T/L)</td></tr>
             <tr><td rowspan='3' style='border-top: 0px solid #000000;border-bottom: 0px solid #000000;border-left: 0px solid #000000;border-right: 1px solid #000000;'><font size='5'><b>$flight[AirlinesID]</font></td>
                    <td style='font-size:$st';><center><b>$isi[TourCode]</td>
             </tr>
             <tr>
                    <td style='font-size:$st';><center>$depdet - $arrdet</td>
             </tr>
             <tr>
                    <td style='font-size:$st';><center>BY : $flight[AirlinesName]</td>
             </tr>";
             echo"</table>";
			 
							
            if($kolom==1){echo"</td><td width='40'></td><td width=275>";$kolom++;}
            else{$kolom=1; $baris++;
            if($baris>5){echo"</td></tr><tr height=2></tr></table>";$hal=$hal+10; $baris=0;
            ?><P CLASS="breakhere"><?PHP }
            else {echo"</td></tr><tr height=6></tr></table>";}
                            }

                            $i++;
                        }
                    }
               }
            $ulangin++;
            
           // BLM ADA NAMA TL
		  
            }else{$hasilsatu=1;
                $stourcode=strlen($isi[TourCode]);
				$s='18px';
                if($stourcode<25){$st='10px';}else{$st='8px';}

                    echo"<table border='0' style=font-size:14 height='150'>
        <tr height=6></tr><tr><td width='275'>";
               echo "
             <table width='250' border='0' align='center' cellpadding='0' cellspacing='0' style=font-size:9>
             <tr><td height='52' width='40' style='border-top: 0px solid #000000;border-bottom: 0px solid #000000;border-left: 0px solid #000000;border-right: 1px solid #000000;'><font size='5'><b>$i</font></td>
                    <td style='font-size:$s';><center><b>TBA (T/L)</td></tr>
             <tr><td rowspan='3' style='border-top: 0px solid #000000;border-bottom: 0px solid #000000;border-left: 0px solid #000000;border-right: 1px solid #000000;'><font size='5'><b>$flight[AirlinesID]</font></td>
                    <td style='font-size:$st';><center><b>$isi[TourCode]</td>
             </tr>
             <tr>
                    <td style='font-size:$st';><center>$depdet - $arrdet</td>
             </tr>
             <tr>
                    <td style='font-size:$st';><center>BY : $flight[AirlinesName]</td>
             </tr>";
             echo"</table>";
                $i++;
                $ulangin++;
            	 if($kolom==1){echo"</td><td width='40'></td><td width=275>";$kolom++;}
								 else{$kolom=1; $baris++;
                if($baris>5){echo"</td></tr><tr height=2></tr></table>";$hal=$hal+10;$baris=0;
				?><P CLASS="breakhere"><?PHP }
                else {echo"</td></tr><tr height=6></tr></table>";}
								 	}

			}
    
   }
   
   //peserta
      while( $r=mysql_fetch_array($edit)){
    if($r[PaxName]==''){$pax='TBA';}else{$pax=$r[PaxName];}
    if($kolom==1){
    echo"<table border='0' style=font-size:14 height='150'>
            <tr height=6></tr><tr><td width='275'> ";}
             $panjang=strlen($pax);
            $stourcode=strlen($isi[TourCode]);
            if($panjang<28){$s='18px';}else{$s='16px';}
			if($stourcode<25){$st='12px';}else{$st='10px';}
            echo "
             <table width='250' border='0' align='center' cellpadding='0' cellspacing='0' style=font-size:9>
             <tr><td height='52' width='40' style='border-top: 0px solid #000000;border-bottom: 0px solid #000000;border-left: 0px solid #000000;border-right: 1px solid #000000;'><font size='5'><b>$i</font></td>
                    <td style='font-size:$s';><center><b>$r[Title] $pax</td></tr>
             <tr><td rowspan='3' style='border-top: 0px solid #000000;border-bottom: 0px solid #000000;border-left: 0px solid #000000;border-right: 1px solid #000000;'><font size='5'><b>$flight[AirlinesID]</font></td>
                    <td style='font-size:$st';><center><b>$isi[TourCode]</td>
             </tr>
             <tr>
                    <td style='font-size:$st';><center>$depdet - $arrdet</td>
             </tr>
             <tr>
                    <td style='font-size:$st';><center>BY : $flight[AirlinesName]</td>
             </tr>";
             echo"</table>";
             $i++;
            
           	 if($kolom==1){echo"</td><td width='40'></td><td width=275>";$kolom++;}
								 else{$kolom=1; $baris++;
                if($baris>5){echo"</td></tr><tr height=2></tr></table>";$hal=$hal+10;$baris=0;
				?><P CLASS="breakhere"><?PHP }
                else {echo"</td></tr><tr height=6></tr></table>";}
								 	}
   	  }
	 
        }
        $tjdata=$jum+$hasilsatu;
    $gnp=$tjdata%2;
        if($gnp<>0){
        echo "
             <table width='250' border='0' align='center' cellpadding='0' cellspacing='0' style=font-size:9>
             <tr>
                    <td height='52' width='40'><center><font size='5'><b></font></td>
                    <td><center><font size='$s'></font></td>
             </tr>
             <tr>
                    <td rowspan='3'><center><font size='5'><b></font></td>
                    <td><center><font size='$st'></td>
             </tr>
             <tr>
                    <td><center><font size='2'></td>
             </tr>
             <tr>
                    <td><center><font size='2'></td>
             </tr></table></td></tr><tr height=6></tr></table>";
        }

    
  
?>
