<?php 
session_start();
if (empty($_SESSION[namauser]) AND empty($_SESSION[passuser])){
  echo "<link href='../config/adminstyle.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
?>
<html>
<head>
<title>SETTLEMENT</title>
<link href="../config/invoice.css" rel="stylesheet" type="text/css">
</head>
<?php 
include "../config/koneksi.php";
include "../config/fungsi_an.php";

   

?>
<body>
<?php 	    $username=$_GET[usr];
        $frd=$_GET[frd];
        $tod=$_GET[tod];
        $edit=mysql_query("SELECT msvisa.Date,msvisa.DONo,msvisa.PaxName,msvisa.ProdType,tbl_mscountry.Country,msvisa.Incentive,msvisa.AppDate,msvisa.PRVNo,msvisa.WONo,msvisa.Invoice,tbl_msoffice.office_code,productdetails.tourcode,productdetails.divi FROM msvisa                                                
                                left JOIN tbl_msemployee ON tbl_msemployee.employee_id = msvisa.ActPIC
                                left JOIN tbl_mscountry ON tbl_mscountry.CountryID = msvisa.ProdEmbassy
                                left JOIN tbl_msoffice ON tbl_msoffice.office_id = msvisa.Divisi 
                                left JOIN productdetails ON productdetails.tourcode = msvisa.TourCode  
                                WHERE (msvisa.AppDate >= '$frd' AND msvisa.AppDate <= '$tod')
                                AND msvisa.ActPIC = '$username' 
                                AND msvisa.Status <> '0'
                                AND msvisa.StatCancel = '0'
                                AND msvisa.WONo <> '' 
                                order by AppDate ASC,PRVNo ASC,Country ASC,ProdType ASC ");
         $jumlah=mysql_num_rows($edit);
         $edit1=mysql_query("SELECT tbl_msemployee.employee_name,sum(msvisa.Incentive)as totincentive,msvisa.ActPIC FROM msvisa                                                
                                left JOIN tbl_msemployee ON tbl_msemployee.employee_id = msvisa.ActPIC
                                WHERE (msvisa.AppDate >= '$frd' AND msvisa.AppDate <= '$tod')
                                AND msvisa.ActPIC = '$username' 
                                AND msvisa.Status <> '0'
                                AND msvisa.StatCancel = '0'
                                AND msvisa.WONo <> '' group by msvisa.ActPIC");
         $data1=mysql_fetch_array($edit1); 
            if ($jumlah > 0) {
            echo "  <center><h1><u>REPORT INCENTIVE DOCUMENT</u></h1>
                    PIC NAME : $data1[employee_name] <br><br>
                    <table STYLE='font-size: 12px;'>
                    <tr><th>NO</th><th>APPROVE DATE</th><th>PRV NO.</th><th>DO DATE</th><th>DO NO.</th><th>PAX NAME</th><th>PRODUCT</th><th>EMBASSY</th><th>INCENTIVE</th><th>WO NO.</th><th>INVOICE</th><th>DIVISI</th><th>TOUR CODE</th><th>SBO</th></tr>"; 
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($edit)){
               echo "<tr><td>$no &nbsp&nbsp</td>            
                     <td>$data[AppDate]&nbsp&nbsp</td>
                     <td>$data[PRVNo]&nbsp&nbsp</td>
                     <td>$data[Date]&nbsp&nbsp</td>
                     <td><center>$data[DONo]&nbsp&nbsp</td>
                     <td>$data[PaxName]&nbsp&nbsp</td>
                     <td>$data[ProdType]&nbsp&nbsp</td>
                     <td>$data[Country]&nbsp&nbsp</td>
                     <td>$data[Incentive]&nbsp&nbsp</td>   
                     <td>$data[WONo]&nbsp&nbsp</td>
                     <td>$data[Invoice]&nbsp&nbsp</td>
                     <td>$data[office_code]&nbsp&nbsp</td>
                     <td>$data[tourcode]&nbsp&nbsp</td>
                     <td>$data[divi]&nbsp&nbsp</td>
                     </tr> ";
                      $no++;
                    }
                    $angka = "$data1[totincentive]";
                    $angka_arr = explode(".",$angka);
                    $terbilang = strtoupper(terbilang($angka_arr[0]));
                    If ($angka_arr[1] == 0) {
                        $terbilang = $terbilang;
                    } elseif (substr($angka_arr[1],0,1)=="0"){
                        $terbilang = $terbilang ." KOMA NOL ".strtoupper(terbilang(substr($angka_arr[1],1,1)));
                    } else {
                        $terbilang = $terbilang ." KOMA ".strtoupper(terbilang($angka_arr[1]));
                    }
                    echo "     <tr></tr><tr><td></td></tr></table>
                    <br><br>";
                    $tung=mysql_query("SELECT concat(tbl_mscountry.Country,' - ',msvisa.ProdType)as tot,msvisa.ProdEmbassy, msvisa.ProdType FROM msvisa
                                left JOIN tbl_mscountry ON tbl_mscountry.CountryID = msvisa.ProdEmbassy    
                                WHERE (msvisa.AppDate >= '$frd' AND msvisa.AppDate <= '$tod')
                                AND msvisa.ActPIC = '$username' 
                                AND msvisa.Status <> '0'
                                AND msvisa.StatCancel = '0'
                                AND msvisa.WONo <> ''  
                                group by tot ");
                     while($hit=mysql_fetch_array($tung)){
                         $emb=$hit[ProdEmbassy];
                         $type=$hit[ProdType];   
                        $one=mysql_query("SELECT * FROM msvisa                                             
                                WHERE (AppDate >= '$frd' AND AppDate <= '$tod')
                                AND ActPIC = '$username' 
                                AND Status <> '0'
                                AND StatCancel = '0'
                                AND msvisa.WONo <> '' 
                                AND ProdEmbassy = '$emb'
                                AND ProdType = '$type'
                                ");
                        $harga=mysql_fetch_array($one); 
                        $two=mysql_query("select sum(Incentive)as totincentive FROM msvisa                                                
                            WHERE (AppDate >= '$frd' AND AppDate <= '$tod')
                                AND ActPIC = '$username' 
                                AND Status <> '0'
                                AND StatCancel = '0'
                                AND msvisa.WONo <> '' 
                                AND ProdEmbassy = '$emb'
                                AND ProdType = '$type'
                                ");
                         $harga1=mysql_fetch_array($two);
                         $hitung=mysql_num_rows($one);
                     echo"
                     <table>
                     <tr>
                    <td width=400>$hit[tot] </td>
                    <td width=180>Total Document : $hitung</td>                                    
                    <td width=50>Rp. </td> 
                    <td align=right width=100> ".number_format($harga1[totincentive], 2, ',', '.');echo" 
                    </td><td width=300> </td> </tr>
                    </table>";  
                     }               echo"<br><br><table><tr>
                    <td width=150>TOTAL AMOUNT : </td>
                    <td width=900>IDR. ".number_format($data1[totincentive], 2, ',', '.');echo"  </td></tr>
                    <tr><td>TERBILANG &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: </td><td> "; echo  strtoupper($terbilang); 
               echo"IDR </table>
                    <br><br><br><br>";
            }
?> <?php 
      
?>
</body>
</html>
<script>
	window.opener.location.reload();
</script>
<?php 
}
?>
