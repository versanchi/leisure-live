 <script language="javascript" type="text/javascript">
    function updatepage()
    {
        window.close();
        window.opener.location.reload();                         
    }        
</script>
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" /> 
<?php 
include "../config/koneksi.php"; 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$username=$_SESSION[employee_code];
$sqluser=mysql_query("SELECT employee_name,employee_code FROM tbl_msemployee WHERE employee_code='$username'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName="$tampiluser[employee_name] ($tampiluser[employee_code])";
$today = date("Y-m-d G:i:s");  
switch($_GET[act]){
  // Tampil Office
  default:
    $edit=mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID = '$_GET[BookingID]'");
    $r=mysql_fetch_array($edit);                       
    
    echo "<h2>UPLOAD PAX NAME<br>Booking ID: $r[BookingID]</h2>    
          <form method='POST' name='info' action='?module=uppaxname&act=save' enctype='multipart/form-data'>
          <input type='hidden' name='id' value='$r[BookingID]'>   
            <center><table><input type='hidden' name='batas' value='$batas'>
            <tr><td><input type='file' name='upname' id='upname' required></td></tr>   
            </table>     
          <center><input type='submit' name='submit' value='Upload' > 
          </form>";
     break;  
  
case "save":                           
          $nama_file   = $_FILES['upname']['name'];
          $file_extension = strtolower(substr(strrchr($nama_file,"."),1));     
          switch($file_extension){
            case "pdf": $ctype="application/pdf"; break;
            case "exe": $ctype="application/octet-stream"; break;
            case "zip": $ctype="application/zip"; break;
            case "rar": $ctype="application/rar"; break;
            case "doc": $ctype="application/msword"; break;
            case "xls": $ctype="application/vnd.ms-excel"; break;
            case "xlsx": $ctype="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"; break;
            case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
            case "gif": $ctype="image/gif"; break;
            case "png": $ctype="image/png"; break;
            case "jpeg":
            case "jpg": $ctype="image/jpg"; break;
            default: $ctype="application/proses";
          }
        
            if ($file_extension!='xls'){
                echo "<script>window.alert('Please use Original Template .xls '); window.close();</script>";
                exit(0);
            }
            // menggunakan class phpExcelReader
            include "../admin/Classes/excel_reader2.php";
            $data = new Spreadsheet_Excel_Reader($_FILES['upname']['tmp_name']);
            $baris = $data->rowcount($sheet_index=0);
            
            $ambil=mysql_query("SELECT * ,CONVERT(SUBSTRING_INDEX(RoomNo,'-',-1),UNSIGNED INTEGER) AS num FROM tour_msbookingdetail
                    WHERE BookingID ='$_POST[id]' 
                    AND Status <>'CANCEL'
                    ORDER BY num ASC,IDDetail ASC");
            $banyak=mysql_num_rows($ambil);
            $edit=mysql_query("SELECT * FROM tour_msbookingdetail WHERE BookingID ='$_POST[id]'");
            $r=mysql_fetch_array($edit); 
            $ceking = mysql_query("SELECT DateTravelFrom FROM tour_msproduct where IDProduct = '$r[IDTourcode]'");
            $tgl=mysql_fetch_array($ceking);
            $target=$tgl[DateTravelFrom];
            $tanggal = substr($target,8,2);
            $bulan = substr($target,5,2);
            $tahun = substr($target,0,4);             
            $batas= date('Y-m-d',strtotime('0 second',strtotime('+6 month',strtotime(date($bulan).'/'.date($tanggal).'/'.date($tahun).' 00:00:00'))));  
            $banyakisi=$baris-1;
            if($banyak==$banyakisi){   
                if($data->val(1, 1)=='No' and $data->val(1, 2)=='PaxName' and $data->val(1, 3)=='Title'and $data->val(1, 4)=='Gender'
                and $data->val(1, 5)=='BirthPlace'and $data->val(1, 6)=='BirthDate'and $data->val(1, 7)=='PassportNo'and $data->val(1, 8)=='PassportIssued'
                and $data->val(1, 9)=='PassportIssuedDate'and $data->val(1, 10)=='PassportValid'){  
                    $i=2;
                    while ($isi=mysql_fetch_array($ambil)){
                        $No = $data->val($i, 1); $PaxName = strtoupper($data->val($i, 2)); $Title = strtoupper($data->val($i, 3)); $Gender = strtoupper($data->val($i, 4)); $BirthPlace = strtoupper($data->val($i, 5));
                        $PassportIssued = strtoupper($data->val($i, 8)); 
                        
                        $BirthDate1 = $data->val($i, 6); 
                        $formatsql0=substr($BirthDate1,4,1); $formatexcel0=substr($BirthDate1,-3,1);   
                        if($formatsql0=='-'){$BirthDate=$BirthDate1;}
                        else if($formatexcel0=='-'){
                        $BirthDate=date('Y-m-d', strtotime($BirthDate1));} 
                        
                        $PassportIssuedDate1 = $data->val($i, 9); 
                        $formatsql1=substr($PassportIssuedDate1,4,1); $formatexcel1=substr($PassportIssuedDate1,-3,1);   
                        if($formatsql1=='-'){$PassportIssuedDate=$PassportIssuedDate1;}
                        else if($formatexcel1=='-'){
                        $PassportIssuedDate=date('Y-m-d', strtotime($PassportIssuedDate1));}   
                        
                        $PassportValid1 = $data->val($i, 10);
                        $formatsql=substr($PassportValid1,4,1); $formatexcel=substr($PassportValid1,-3,1);   
                        if($formatsql=='-'){$PassportValid=$PassportValid1;}
                        else if($formatexcel=='-'){             
                        $PassportValid=date('Y-m-d', strtotime($PassportValid1));}     
                        
                        $PassNo1=strtoupper($data->val($i, 7));
                        $PassNo2=str_replace(" ","", $PassNo1);
                        $PassportNo=trim($PassNo2);                                      
                        if ($PassportValid <>'0000-00-00') {
                            if ($PassportValid < $batas) {
                                echo "<script>window.alert('Pax No: $No, Passport exp date must be at least six months after the date of departure'); window.close();</script>";
                                exit(0); 
                            }
                        }
                            mysql_query("UPDATE tour_msbookingdetail SET PaxName = '$PaxName',
                                                                        Title = '$Title',
                                                                        Gender = '$Gender',
                                                                        BirthPlace = '$BirthPlace',
                                                                        BirthDate = '$BirthDate',
                                                                        PassportNo = '$PassportNo',
                                                                        PassportIssued = '$PassportIssued',
                                                                        PassportIssuedDate = '$PassportIssuedDate',
                                                                        PassportValid = '$PassportValid'
                                                                        WHERE IDDetail = '$isi[IDDetail]'"); 
                        
                            
                        $i++;
                    }       
                }
                else{
                    echo "<script>window.alert('Please use Original Template'); window.close();</script>";
                    exit(0);
                }
            }else{
                echo "<script>window.alert('Total PaxName NOT same! $banyak - $banyakisi'); window.close();</script>";
                exit(0);
            }
  $Description="Upload Pax Name ($_POST[id])";                                                                                 
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
