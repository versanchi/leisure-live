<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script> 
<link type="text/css" href="../head/jquery-ui-1.7.2.custom.css" rel="stylesheet" />                                                                 
<script language="JavaScript"  type="text/javascript">      
function rejectv(VCH)
{
if (confirm("Are you sure want to REJECT : "+ VCH +" "))
{
 window.location.href = '?module=msvoucher&act=rejectvoucher&voucher='+ VCH ;
} 
}

function voidv(VCH,LOC)
{
if (confirm("Are you sure want to VOID : "+ VCH +" "))
{
    window.location.href = '?module=msvoucher&act=voidvoucher&voucher='+ VCH + '&loc=' + LOC ;
} 
}
function redeemv(ID,LOC)
{
    var alasan=prompt("Reference Number:" );
    if (alasan!=null && alasan!="")
    {
        window.location.href = '?module=msvoucher&act=redeemvoucher&voucher=' + ID + '&reason=' + alasan + '&loc=' + LOC ;
    }
}
function PopupCenter(pageURL, ID,w,h) {
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
function isNumber(field) {
var re = /^[0-9'.']*$/;
if (!re.test(field.value)) {
alert('PLEASE INPUT NUMBER!');
field.value = field.value.replace(/[^0-9'.']/g,"");
}
}
</script>
<script type='text/javascript'>
function mencari()
{
document.getElementById("myform").submit(); 
}

</script>
<script type="text/javascript">
            $(document).ready(function(){
                
                //    -- Datepicker
                $(".my_date").datepicker({
                    dateFormat: 'dd-mm-yy',
                    showButtonPanel: true
                });                    
                //    -- Datepicker2           
                $(".my_date2").datepicker({
                    dateFormat: 'yy-mm-dd',
                    showButtonPanel: true
                });                      
                // -- Clone table rows
                $(".cloneTableRows").live('click', function(){

                    // this tables id
                    var thisTableId = $(this).parents("table").attr("id");
                
                    // lastRow
                    var lastRow = $('#'+thisTableId + " tr:last");
                      
                    var rowCount = $('#'+thisTableId).attr('rows').length;
 
        
                    // clone last row
                    var newRow = lastRow.clone(true);
                    
                    // append row to this table
                    $('#'+thisTableId).append(newRow);
                    
                    // make the delete image visible
                    $('#'+thisTableId + " tr:last td:first img").css("visibility", "visible");
                                                                                               
                    // clear the inputs (Optional)
                    $('#'+thisTableId + " tr:last td :input").val('');          
                    // new rows datepicker need to be re-initialized
                    $(newRow).find("input").each(function(){
                        if($(this).hasClass("hasDatepicker")){ // if the current input has the hasDatpicker class
                            var this_id = $(this).attr("id"); // current inputs id
                            var new_id = this_id +1; // a new id
                            $(this).attr("id", new_id); // change to new id  
                           // $(this).attr("value", new_id); 
                            $(this).removeClass('hasDatepicker'); // remove hasDatepicker class
                             // re-init datepicker
                            $(this).datepicker({
                                dateFormat: 'dd-mm-yy',
                                showButtonPanel: true , 
                            });                  
                        }        
                       
                    });                    
                                           
                    return false; 
                });
               
                // Delete a table row
                $("img.delRow").click(function(){
                    $(this).parents("tr").remove();
                    return false;
                });
            
            });

</script> 

<?php                 
switch($_GET[act]){
  // Tampil productcode
  default:
    $hariini = date("Y-m-d ");
    $nama=$_GET['nama'];
    $opnama=$_GET['opnama'];
    if($opnama==''){$opnama='APPROVE';}else{$opnama=$opnama;}
    $jenis=$_GET['jenis'];
    if($jenis=='' OR $jenis=='REGULAR'){$qjenis="AND Location ='LTM'";$jenis=='REGULAR';}
    else if($jenis=='WOP'){$qjenis="AND Location ='WOP'";$jenis=='WOP';}
    else{$qjenis="AND Location ='EXHIBITION'";$jenis=='EXHIBITION';}
    $blnini = date("m");
    $thnini = date("Y");
    $mont=$_GET['bulan'];
    $yer=$_GET['year'];
    echo "<h2>Request List</h2>
          <form name='awal' id='myform' method=get action='media.php?'><input type=hidden name=module value='msvoucher'>
              <font size='2'>Event :</font> <select name='jenis' onChange='mencari()'>
              <option value='REGULAR'";if($jenis=='REGULAR'){echo"selected";}echo">REGULAR</option>
              <option value='EXHIBITION'";if($jenis=='EXHIBITION'){echo"selected";}echo">EXHIBITION</option>
              <option value='WOP'";if($jenis=='WOP'){echo"selected";}echo">WOP</option>
              </select><br>
              <font size='2'>Status:</font> <select name='opnama' onChange='mencari()'>
              <option value='REQUEST'";if($opnama=='REQUEST'){echo"selected";}echo">REQUEST</option>
              <option value='APPROVE'";if($opnama=='APPROVE'){echo"selected";}echo">APPROVE</option>
              <option value='REJECT'";if($opnama=='REJECT'){echo"selected";}echo">REJECT</option>
              <option value='VOID'";if($opnama=='VOID'){echo"selected";}echo">VOID</option>
              <option value='REDEEM'";if($opnama=='REDEEM'){echo"selected";}echo">REDEEM</option>
              </select> <input type=text name='nama' value='$nama' size=20>
              <input type=submit name=oke value=Search>
          </form><input type=button value='Create Voucher' onclick=location.href='?module=voucherex'>";
          $oke=$_GET['oke'];
 
          // Langkah 1
          $batas = 10;
          $halaman= $_GET['halaman'];
          if(empty($halaman)){
              $posisi  = 0;
            $halaman = 1;
          } else {
              $posisi = ($halaman-1) * $batas; }       
            // Langkah 2                                 
            {
            $tampil=mysql_query("SELECT * FROM tour_voucherpromo
                                WHERE (BookingID LIKE '%$nama%'
								OR VoucherNo LIKE '%$nama%'
                                OR RequestBy LIKE '%$nama%'
                                OR Promo LIKE '%$nama%')
                                AND VoucherStatus = '$opnama'
                                $qjenis
                                ORDER BY VoucherID ASC,BookingID ASC LIMIT $posisi,$batas");}

            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            echo "<table>
                  <tr><th>no</th><th>Voucher No</th><th>Amount</th><th>Request Date</th><th>Valid Date</th><th>booking id</th><th>Pax</th>
                  <th width='150'>Request Bonus</th><th>Tourcode</th><th>Departure Date</th><th>request by</th>";
                  if($opnama=='REQUEST' OR $opnama=='APPROVE'){echo"<th>action</th>";}
                  else if($opnama=='REDEEM'){echo"<th>reference</th><th>action</th>";}
                  echo"</tr>";
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
                        $qvalid = mysql_query("SELECT * FROM tour_msbooking
                                left join tour_msproduct on tour_msproduct.IDProduct = tour_msbooking.IDTourcode
                                where BookingID = '$data[BookingID]' ");
                        $qhasil = mysql_fetch_array($qvalid);
                    $RD = date('d M Y', strtotime($data[RequestDate]));
                    $DD = date('d M Y', strtotime($qhasil[DateTravelFrom]));
                    if($data[ValidDate]=='0000-00-00'){$VD="NONE";}else{
                    $VD = date('d M Y', strtotime($data[ValidDate]));}
                    $voucherno=$data[VoucherNo];
               echo "<tr><td $warna>$no</td>
                     <td><center>$voucherno</td>
                     <td><center>$data[Curr] ".number_format($data[Harga], 2, '.', ',');echo"</td>
                     <td><center>$RD</td>
                     <td><center>$VD</td>
                     <td><center><a href='?module=msbookingdetail&act=showdetail&code=$data[BookingID]&mod=msvoucher'>$data[BookingID]</a></td>
                     <td><center>$data[Pax]</td>
                     <td><center>$data[Promo]</td>
                     <td><center>$qhasil[TourCode]</td>
                     <td><center>$DD</td>
                     <td><center>$data[RequestBy]</td>
                     ";
                     if($data[VoucherStatus]=='REQUEST'){
               echo "<td><center><input type=button value='APPROVE' onclick=PopupCenter('voucherapp.php?id=$voucherno&prod=$qhasil[ProductID]','variable',420,160)>
                     <input type=button value='REJECT' onclick=rejectv('$voucherno')></td></tr>";
                     }else if($data[VoucherStatus]=='APPROVE'){
                     //******** KHUSUS WOP ************
                     $qturkod=mysql_query("SELECT * FROM tour_codewop WHERE ProductID ='$qhasil[IDProduct]'");
                     $voucher=mysql_fetch_array($qturkod);
                     if($voucher[Pax]=='1'){
                     //voucher extra disc NZ
                     echo "<iframe src='voucherNZ.php?code=$data[VoucherID]' name='voucher$no' style='visibility: hidden' height='0' width='0' frameborder='0'>
                      </iframe>";
                     }elseif($voucher[Pax]=='2'){
                     //voucher free tour
                     echo "<iframe src='voucherTour.php?code=$data[VoucherID]' name='voucher$no' style='visibility: hidden' height='0' width='0' frameborder='0'>
                      </iframe>";
                     }else{
                     //voucher biasa
               echo "<iframe src='voucherpromo.php?code=$data[VoucherID]' name='voucher$no' style='visibility: hidden' height='0' width='0' frameborder='0'>
                     </iframe>";
                     }echo"
                     <td><center><img src='../images/printerb.png' title='Print Voucher' onClick=frames['voucher$no'].print()>
                     <input type=button value='VOID' onclick=voidv('$voucherno','voucherpromo')>
                     <input type=button value='REDEEM' onclick=redeemv('$voucherno','voucherpromo')></td></tr>";

                     }else if($data[VoucherStatus]=='REDEEM'){
                         echo "<td><center>$data[Reference]</td><td><input type=button value='VOID' onclick=voidv('$voucherno','voucherpromo')></td></tr>";
                     }
                      $no++;
                    } 
                    echo"
                    
                    </table>";
                    
                    // Langkah 3                         

                    $tampil2="SELECT * FROM tour_voucherpromo
                                WHERE (BookingID LIKE '%$nama%'
								OR VoucherNo LIKE '%$nama%'
                                OR RequestBy LIKE '%$nama%'
                                OR Promo LIKE '%$nama%')
                                AND VoucherStatus = '$opnama'
                                $qjenis
                                ORDER BY VoucherID ASC,BookingID ASC";

                    $hasil2     = mysql_query($tampil2);
                    $jmldata    = mysql_num_rows($hasil2);
                    $jmlhalaman = ceil($jmldata/$batas);
                    $file = "media.php?module=msvoucher";
                    // Link ke halaman sebelumnya (previous)
                    echo "<center><div id='paging'>";
                    if ($halaman >1) {
                        $previous = $halaman-1;
                        echo "<a href=$file&halaman=1&opnama=$opnama&nama=$nama&jenis=$jenis&oke=$oke> << First</a> |
                              <a href=$file&halaman=$previous&opnama=$opnama&nama=$nama&jenis=$jenis&oke=$oke> < Previous</a> | ";
                    } else {
                        echo "<< First | < Previous | ";
                    }
                    // Tampilkan link halaman 1,2,3 ... modifikasi ala google
                    // Angka awal
                    $angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
                    for ($i=$halaman-2; $i<$halaman; $i++) {
                        if ($i < 1 )
                            continue;
                        $angka .= "<a href=$file&halaman=$i&opnama=$opnama&nama=$nama&jenis=$jenis&oke=$oke>$i</a> ";
                    }
                    // Angka tengah
                    $angka .= " <b>$halaman</b> ";
                    for ($i=$halaman+1; $i<($halaman+3); $i++) {
                        if ($i > $jmlhalaman)
                            break;
                        $angka .= "<a href=$file&halaman=$i&opnama=$opnama&nama=$nama&jenis=$jenis&oke=$oke>$i</a> ";
                    }
                    // Angka akhir
                    $angka .= ($halaman+2<$jmlhalaman ? " ...
                        <a href=$file&halaman=$jmlhalaman&opnama=$opnama&nama=$nama&jenis=$jenis&oke=$oke>$jmlhalaman</a> |" : " ");
                    // Cetak angka seluruhnya (awal, tengah, akhir)
                    echo "$angka";
                    // Link ke halaman berikutnya (Next)
                    if ($halaman < $jmlhalaman) {
                        $next = $halaman+1;
                        echo "<a href=$file&halaman=$next&opnama=$opnama&nama=$nama&jenis=$jenis&oke=$oke> Next ></a> |
                              <a href=$file&halaman=$jmlhalaman&opnama=$opnama&nama=$nama&jenis=$jenis&oke=$oke> Last >></a> ";
                    } else {
                        echo " Next > | Last >>";
                    }                    
                    echo "<br><br>Found <b>$jmldata</b> data(s)<p>";
                    echo "</div>";
            } else {
                echo "<div id='paging'>";
                echo "<br><br>Data Not Found<p>";
                echo "</div>";
            }


     break;

case "rejectvoucher":
     $username=$_SESSION[employee_code];
     $sqluser=mysql_query("SELECT employee_name,employee_code FROM tbl_msemployee WHERE employee_code='$username'");
     $tampiluser=mysql_fetch_array($sqluser);
     $EmpName="$tampiluser[employee_name] ($tampiluser[employee_code])";    
     $today = date("Y-m-d G:i:s");
     $qvoucher=mysql_query("SELECT * FROM tour_voucherpromo WHERE VoucherNo = '$_GET[voucher]' ");
     $hvoucher=mysql_fetch_array($qvoucher);
     $qbook=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$hvoucher[BookingID]' ");
     $hbook=mysql_fetch_array($qbook);
     $requpdate=$hbook[ReqPromo]-$hvoucher[Pax];
     mysql_query("UPDATE tour_voucherpromo set VoucherStatus = 'REJECT',
                                        UpdateBy = '$EmpName',
                                        UpdateDate = '$today'
                                        WHERE VoucherNo = '$_GET[voucher]'");
     mysql_query("UPDATE tour_msbooking set ReqPromo = '$requpdate'
                                        WHERE BookingID = '$hvoucher[BookingID]' ");
     mysql_query("UPDATE tour_msbookingdetail set VoucherNo = '',
                                        Promo = ''
                                        WHERE BookingID = '$hvoucher[BookingID]' AND VoucherNo = '$_GET[voucher]'");
     $Description="REJECT VOUCHER NO $_GET[voucher]";
     mysql_query("INSERT INTO tbl_logtour(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msvoucher'>";   
     break;          
     
case "voidvoucher":
    $loc=$_GET[loc];
    $username=$_SESSION[employee_code];
    $sqluser=mysql_query("SELECT employee_name,employee_code FROM tbl_msemployee WHERE employee_code='$username'");
    $tampiluser=mysql_fetch_array($sqluser);
    $EmpName="$tampiluser[employee_name] ($tampiluser[employee_code])";
    $today = date("Y-m-d G:i:s");
    $qvoucher=mysql_query("SELECT * FROM tour_voucherpromo WHERE VoucherNo = '$_GET[voucher]' ");
    $hvoucher=mysql_fetch_array($qvoucher);
    $qbook=mysql_query("SELECT * FROM tour_msbooking WHERE BookingID = '$hvoucher[BookingID]' ");
    $hbook=mysql_fetch_array($qbook);
    $requpdate=$hbook[ReqPromo]-$hvoucher[Pax];
    mysql_query("UPDATE tour_voucherpromo set VoucherStatus = 'VOID',
                                        UpdateBy = '$EmpName',
                                        UpdateDate = '$today'
                                        WHERE VoucherNo = '$_GET[voucher]'");
    mysql_query("UPDATE tour_msbooking set ReqPromo = '$requpdate'
                                        WHERE BookingID = '$hvoucher[BookingID]' ");
    mysql_query("UPDATE tour_msbookingdetail set VoucherNo = '',
                                        Promo = ''
                                        WHERE BookingID = '$hvoucher[BookingID]' AND VoucherNo = '$_GET[voucher]'");
    $Description="VOID VOUCHER NO $_GET[voucher]";
    mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('$EmpName',
                                   '$Description',
                                   '$today')");
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msvoucher'>";
    break;

case "redeemvoucher":
        $loc=$_GET[loc];
        $username=$_SESSION[employee_code];
        $sqluser=mysql_query("SELECT employee_name,employee_code FROM tbl_msemployee WHERE employee_code='$username'");
        $tampiluser=mysql_fetch_array($sqluser);
        $EmpName="$tampiluser[employee_name] ($tampiluser[employee_code])";
        $today = date("Y-m-d G:i:s");
        mysql_query("UPDATE tour_voucherpromo set VoucherStatus = 'REDEEM',
                                        Reference = '$_GET[reason]',
                                        UpdateBy = '$EmpName',
                                        UpdateDate = '$today'
                                        WHERE VoucherNo = '$_GET[voucher]'");

        $Description="REDEEM VOUCHER NO $_GET[voucher]";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('$EmpName',
                                   '$Description',
                                   '$today')");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msvoucher'>";
        break;

} 
?>
