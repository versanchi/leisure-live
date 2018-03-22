<link type="text/css" href="../head/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>
<script language="JavaScript"  type="text/javascript">
function delfile(ID, ATTACHFILE, KOLOM)
{
    if (confirm("Are you sure you want to delete " + ATTACHFILE +" "))
    {
        window.location.href = '?module=upfinal&act=delfile&id=' + ID + '&kol=' + KOLOM;

    }
}
</script>

<?php
$employee_code=$_SESSION['employee_code'];
$sqluser=mysql_query("SELECT tbl_msoffice.office_code,tbl_msemployee.ltm_authority,tbl_msemployee.employee_name,cim_msjob.JobLevel FROM tbl_msemployee
                                left join tbl_msoffice on tbl_msoffice.office_id=tbl_msemployee.office_id
                                left join cim_msjob on cim_msjob.IDJob=tbl_msemployee.employee_title
                                WHERE tbl_msemployee.employee_code = '$employee_code'");
$hasiluser=mysql_fetch_array($sqluser);
$ltm_authority=$hasiluser['ltm_authority'];
$EmpName="$tampiluser[employee_name] ($tampiluser[employee_code])";
$today = date("Y-m-d G:i:s");
switch($_GET[act]){
  // Tampil season
  default:
  	$nama=$_GET['nama'];
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    echo "<h2>Final Document $r[TourCode]</h2>";
		  $oke=$_GET['oke'];

    $file1= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[FinalItin]) ) ) );
    $file2= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[FinalHotel]) ) ) );
    $file3= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[FinalHalper]) ) ) );
    $file4= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[FinalOption]) ) ) );
    echo"<form name='example' method='POST' action='./aksi.php?module=upload&act=final' enctype='multipart/form-data'>
    <input type='hidden' name='idp' value='$r[IDProduct]'>
    <table>
    <tr><th></th><th>File</th><th>Update By</th></tr>
    <tr><th>Final Itinerary</th><td>";if($r[FinalItin]<>''){
    echo"<input type='hidden' name='finalitin' value='$r[FinalItin]'>
            <a href='$r[FinalAttach]$file1' target='_blank' style=text-decoration:none >$r[FinalItin]</a> &nbsp<a href=\"javascript:delfile('$r[IDProduct]','$r[FinalItin]','FinalItin')\"><font color=red>remove</font></a>";}
    else{echo"<input type='file' name='finalitin' multiple='multiple' accept='image/*'>";}echo"</td><td>$r[FinalItinInfo]</td></tr>
    <tr><th>Final Hotel List</th><td>";if($r[FinalHotel]<>''){
        echo"<input type='hidden' name='finalhotel' value='$r[FinalHotel]'>
                <a href='$r[FinalAttach]$file2' target='_blank' style=text-decoration:none >$r[FinalHotel]</a> &nbsp<a href=\"javascript:delfile('$r[IDProduct]','$r[FinalHotel]','FinalHotel')\"><font color=red>remove</font></a>";}
    else{echo"<input type='file' name='finalhotel' multiple='multiple' accept='image/*'>";}echo"</td><td>$r[FinalHotelInfo]</td></tr>
    <tr><th>Final Hal Perhatian</th><td>";if($r[FinalHalper]<>''){
        echo"<input type='hidden' name='finalhalper' value='$r[FinalHalper]'>
                <a href='$r[FinalAttach]$file3' target='_blank' style=text-decoration:none >$r[FinalHalper]</a> &nbsp<a href=\"javascript:delfile('$r[IDProduct]','$r[FinalHalper]','FinalHalper')\"><font color=red>remove</font></a>";}
    else{echo"<input type='file' name='finalhalper' multiple='multiple' accept='image/*'>";}echo"</td><td>$r[FinalHalperInfo]</td></tr>
    <tr><th>Final Optional List</th><td>";if($r[FinalOption]<>''){
        echo"<input type='hidden' name='finaloption' value='$r[FinalOption]'>
                <a href='$r[FinalAttach]$file4' target='_blank' style=text-decoration:none >$r[FinalOption]</a> &nbsp<a href=\"javascript:delfile('$r[IDProduct]','$r[FinalOption]','FinalOption')\"><font color=red>remove</font></a>";}
    else{echo"<input type='file' name='finaloption' multiple='multiple' accept='image/*'>";}echo"</td><td>$r[FinalOptionInfo]</td></tr>
    <tr><td colspan='3'><center><input type='submit' value='UPLOAD'> <input type='button' value='CLOSE' onclick=location.href='?module=group'></td></tr>
    </table></form>";

     break;

case "delfile":
    $edit1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$_GET[id]'");
    $r2=mysql_fetch_array($edit1);
    $kolom=$_GET[kol];
    $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r2[$kolom]) ) ) );
    $path = $r2[FinalAttach];
    $files = ("$path$file");
    unlink($files);
    $edit=mysql_query("UPDATE tour_msproduct set $kolom = '' WHERE IDProduct = '$_GET[id]'");
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=upfinal&id=$_GET[id]'>";
    break;

case "view":
    $nama=$_GET['nama'];
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    echo "<h2>Final Document $r[TourCode]</h2>";
    $oke=$_GET['oke'];

    $file1= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[FinalItin]) ) ) );
    $file2= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[FinalHotel]) ) ) );
    $file3= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[FinalHalper]) ) ) );
    $file4= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[FinalOption]) ) ) );
    echo"<form name='example' method='POST' action='./aksi.php?module=upload&act=final' enctype='multipart/form-data'>
    <input type='hidden' name='idp' value='$r[IDProduct]'>
    <table>
    <tr><th>Final Itinerary</th><td>";if($r[FinalItin]<>''){
    echo"<input type='hidden' name='finalitin' value='$r[FinalItin]'>
            <a href='$r[FinalAttach]$file1' target='_blank' style=text-decoration:none >$r[FinalItin]</a>";}else{echo"<i>FILE NOT READY</i>";}
echo"</td></tr>
    <tr><th>Final Hotel List</th><td>";if($r[FinalHotel]<>''){
    echo"<input type='hidden' name='finalhotel' value='$r[FinalHotel]'>
                <a href='$r[FinalAttach]$file2' target='_blank' style=text-decoration:none >$r[FinalHotel]</a>";}else{echo"<i>FILE NOT READY</i>";}
echo"</td></tr>
    <tr><th>Final Hal Perhatian</th><td>";if($r[FinalHalper]<>''){
    echo"<input type='hidden' name='finalhalper' value='$r[FinalHalper]'>
                <a href='$r[FinalAttach]$file3' target='_blank' style=text-decoration:none >$r[FinalHalper]</a>";}else{echo"<i>FILE NOT READY</i>";}
echo"</td></tr>
    <tr><th>Final Optional List</th><td>";if($r[FinalOption]<>''){
    echo"<input type='hidden' name='finaloption' value='$r[FinalOption]'>
                <a href='$r[FinalAttach]$file4' target='_blank' style=text-decoration:none >$r[FinalOption]</a>";}else{echo"<i>FILE NOT READY</i>";}
    echo"</td></tr>
    </table><center><input type=button value=Close onclick=self.history.back()></form>";

    break;
} 
?>
