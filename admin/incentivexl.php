<?php  
include "../config/koneksi.php";
$sel = $_POST['sel'];  
//$tahun = $_POST['tahun'];  
$nama = $_POST['nama'];   
$frd = $_POST['date1'];
$tod = $_POST['date2'];
$tampil=mysql_query("SELECT * FROM tbl_msemployee where employee_id = '$_POST[nama]' ");
$r=mysql_fetch_array($tampil);
$pic=$r['employee_name'];                                                                                                               
if ($nama == '0'){
$expSQL = " SELECT tbl_msemployee.employee_name,msvisa.Date,msvisa.DONo,msvisa.PaxName,msvisa.ProdType,tbl_mscountry.Country,msvisa.Incentive,msvisa.AppDate,msvisa.PRVNo,msvisa.WONo,msvisa.Invoice,tbl_msoffice.office_code,productdetails.tourcode,productdetails.divi FROM msvisa                                                
                                left JOIN tbl_msemployee ON tbl_msemployee.employee_id = msvisa.ActPIC
                                left JOIN tbl_mscountry ON tbl_mscountry.CountryID = msvisa.ProdEmbassy
                                left JOIN tbl_msoffice ON tbl_msoffice.office_id = msvisa.Divisi 
                                left JOIN productdetails ON productdetails.tourcode = msvisa.TourCode  
                                WHERE (msvisa.AppDate >= '$frd' AND msvisa.AppDate <= '$tod')
                                AND msvisa.ActPIC <> '' 
                                AND msvisa.Status <> '0'
                                AND msvisa.StatCancel = '0'
                                AND msvisa.WONo <> '' 
                                order by AppDate ASC,PRVNo ASC,Country ASC,ProdType ASC ";
  
$membername = "ALL";       
}else {
$expSQL = " SELECT msvisa.Date,msvisa.DONo,msvisa.PaxName,msvisa.ProdType,tbl_mscountry.Country,msvisa.Incentive,msvisa.AppDate,msvisa.PRVNo,msvisa.WONo,msvisa.Invoice,tbl_msoffice.office_code,productdetails.tourcode,productdetails.divi FROM msvisa                                                
                                left JOIN tbl_msemployee ON tbl_msemployee.employee_id = msvisa.ActPIC
                                left JOIN tbl_mscountry ON tbl_mscountry.CountryID = msvisa.ProdEmbassy
                                left JOIN tbl_msoffice ON tbl_msoffice.office_id = msvisa.Divisi 
                                left JOIN productdetails ON productdetails.tourcode = msvisa.TourCode  
                                WHERE (msvisa.AppDate >= '$frd' AND msvisa.AppDate <= '$tod')
                                AND msvisa.ActPIC = '$nama' 
                                AND msvisa.Status <> '0'
                                AND msvisa.StatCancel = '0'
                                AND msvisa.WONo <> '' 
                                order by AppDate ASC,PRVNo ASC,Country ASC,ProdType ASC";
                                  
$membername = "$pic";    
}
$expname = "Sales_from_".$frd."_to_".$tod."_".$membername;
$query = mysql_query($expSQL);
$field_count = mysql_num_fields($query); 
for ($x = 0; $x < $field_count;) { 
   $get_field .= mysql_field_name($query, $x)."\t"; 
   $x++; 
} 
//ekstrak data 
while($get_row = mysql_fetch_row($query)) { 
   $baris = ''; 
   foreach($get_row as $row) {                                            
      if ((!isset($row)) OR ($row == "")) { 
         $row = "\t"; 
      } else { 
         $row = str_replace('"', '""', $row); 
         $row = '"' . $row . '"' . "\t"; 
      } 
      $baris .= $row; 
   } 
   $ambil .= trim($baris)."\n"; 
} 
$ambil = str_replace("\r","",$ambil); 
header("Content-type: application/force-download"); 
header("Content-Disposition: attachment; filename=".$expname.".xls"); 
header("Pragma: no-cache"); 
header("Expires: 0"); 
print "$get_field\n$ambil"; 
?> 