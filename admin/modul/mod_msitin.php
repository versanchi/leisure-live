<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>
<script type="text/javascript">
    function generateexcel(tableid) {
        var table= document.getElementById(tableid);
        var html = table.outerHTML;
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    }
    function delattach(ID, ATTACHFILE) {
        if (confirm("Are you sure you want to delete " + ATTACHFILE +" "));
        {
            window.location.href = '?module=msitin&act=delattach&id=' + ID;

        }
    }
    function delattach1(ID, ATTACHFILE) {
        if (confirm("Are you sure you want to delete " + ATTACHFILE +" "));
        {
            window.location.href = '?module=msitin&act=delpdf&id=' + ID;

        }
    }
    function deltmrpdf(ID, ATTACHFILE) {
        if (confirm("Are you sure you want to delete " + ATTACHFILE +" "));
        {
            window.location.href = '?module=msitin&act=deltmrpdf&id=' + ID + "&opt= "+ ATTACHFILE;

        }
    }
    function delmap(ID, ATTACHFILE) {
        if (confirm("Are you sure you want to delete " + ATTACHFILE +" "))
        {
            window.location.href = '?module=msitin&act=delmap&id=' + ID;

        }
    }
    function delphoto(ID, ATTACHFILE) {
        if (confirm("Are you sure you want to delete " + ATTACHFILE +" "))
        {
            window.location.href = '?module=msitin&act=delphoto&id=' + ID;

        }
    }
    function tampil(sel,teks,isi) {
        var base = eval("example."+sel+".value");
        var b = eval("example."+isi);
        if(base=='YES'){
            b.readOnly=false;
            b.value='Unlimited';
        }else {
            b.readOnly=true;
            b.value='';
        }
    }
    function intip() {
        //document.getElementById('karensi').type='hidden';
        document.getElementById('tipping').type='hidden';
        document.getElementById('tipping').value='';
    }
    function notip() {
        //document.getElementById('karensi').type='text';
        document.getElementById('tipping').type='text';
        document.getElementById('tipping').value='0';
    }
    function Sowit() {
        document.kopi.iwant.value='Copy From';
        document.kopi.iwant.disabled=true;
        document.getElementById('idcopy').style.visibility='visible';
        document.getElementById('apdet').style.visibility='visible';
        document.getElementById('tutup').style.visibility='visible';
    }
    function Hidit() {
        document.kopi.iwant.value='Copy Itin';
        document.kopi.iwant.disabled=false;
        document.getElementById('idcopy').style.visibility='hidden';
        document.getElementById('apdet').style.visibility='hidden';
        document.getElementById('tutup').style.visibility='hidden';
        document.example.elements['idcopy'].selectedIndex=0;
    }
    function pilihhtl(ket,no){
        var dtlke = "hoteldetail"+no;
        var tempke = "temphtl"+no;
        var hotel = "hotel"+no;
        if(ket=="htlhotel"){
            document.getElementById(hotel).disabled=false;
            document.getElementById(dtlke).type='hidden';
            document.getElementById(dtlke).value = document.getElementById(tempke).value;
        }else{
            document.getElementById(hotel).disabled=true;
            document.getElementById(dtlke).type='text';
            document.getElementById(dtlke).value='FREE TEXT';
        }
    }
    function ganti() {
        document.getElementById("myform").submit();
    }
    function gantiattach() {
        document.getElementById("jenisattach").submit();
    }
    function airshow(ID,Q,PROD) {
        var air1 = document.getElementById('flight').value;
        window.location.href = '?module=msitin&act=simpanair&air=' + air1 + '&no=' + ID + '&prod=' + PROD + '&q=' + Q;
    }
    function validateFormOnSubmit(theForm) {
        var reason = "";
        reason += validateSelect(theForm.idcopy);

        if (reason != "") {
            alert("Some fields need correction:\n" + reason);
            return false;
        }

        return true;
    }
    function validateSelect(fld) {
        var error = "";

        if (fld.value == 0) {
            fld.style.background = 'Yellow';
            error = "The required field has not been selected.\n"
        } else {
            fld.style.background = 'White';
        }
        return error;
    }
    function isNumber(field) {
        var re = /^[0-9'.']*$/;
        if (!re.test(field.value)) {
            alert('PLEASE INPUT NUMBER!');
            field.value = field.value.replace(/[^0-9'.']/g,"");
        }
    }
    function bukaitin(){
        document.getElementById("jenisitin").submit();
    }
    function editflight() {
        document.getElementById('copyidgrv').disabled=true;
        document.getElementById('copyidgrv').selectedIndex=0;
        document.getElementById("air").style.display = '';
    }
    function copyflight() {
        document.getElementById('copyidgrv').disabled=false;
        document.getElementById('copyidgrv').selectedIndex=0;
        document.getElementById("air").style.display = 'none';
    }
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
<script type="text/javascript" src="./fckeditor/ckeditor.js"></script>
<?php
include "../config/koneksi.php";
include "../config/fungsi_an.php";

switch($_GET[act]){
    // Tampil Search Tour code
    default:
        $type=$_GET['type'];
        $itin=$_GET['itin'];
        $lang=$_GET['language'];
        $style=$_GET['style'];
        $statusitin=$_GET['statusitin'];

        $hariini = date("Y-m-d ");
        $IDProduct=$_GET['nama'];
        /*$tampil2=mysql_query("SELECT job_desc FROM tbl_msemployee WHERE employee_username='$_SESSION[namauser]'");
        $hasil2=mysql_fetch_object($tampil2);
        $JobDesc=$hasil2->job_desc;*/
        $ambil=mysql_query("SELECT tour_msproduct.*,
                    tour_msproductcode.* FROM tour_msproduct                                            
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode     
                    WHERE tour_msproduct.IDProduct ='$IDProduct'");
        $isi=mysql_fetch_array($ambil);
        if($lang==''){$lang='INDONESIA';}else{$lang=$lang;}
        if($itin==''){$itin='createitin';}else{$itin=$itin;}
        if($style==''){
            if($isi[Department]=='TUR EZ'){
                $style='TEZ';
            }else{
                $style='LTM';
            }
        }else{$style=$style;}
        if($isi[StyleItin]==$style){$itsts="<font size='1' color='blue'>(PUBLISH)</font>";}else{$itsts="<font size='1' color='red'>(UNPUBLISH)</font>";}
        echo "<h2>Attachment File $isi[TourCode]</h2>";
        $oke=$_GET['oke'];

        echo "  <form method='get' id='myform' action='media.php?'>
            <input type=hidden name=module value='msitin'><input type=hidden name='nama' value='$IDProduct'>
            Attachment <select name='type' onchange='ganti()'>
            <option value=''";if($type==''){echo"selected";}echo">- select type-</option>                        
            <option value='itin'";if($type=='itin'){echo"selected";}echo">Itinerary & Hotel</option>           
            <option value='information'";if($type=='information'){echo"selected";}echo">Information</option>
            </select>
            </form> ";
        /*<br>
            <input type=radio name='itin' value='createitin' onclick='bukaitin()'";if($itin=='createitin'){echo"checked";}echo"><font size=2>Create/Edit Itin & Hotel</font>&nbsp&nbsp
            <input type=radio name='itin' value='uploaditin' onclick='bukaitin()'";if($itin=='uploaditin'){echo"checked";}echo"><font size=2>Upload Itin (.pdf)</font>
        */
        if($type=='itin'){
            echo"<form method='get' id='jenisitin' action='media.php?'>
            <input type=hidden name=module value='msitin'><input type=hidden name='nama' value='$IDProduct'><input type=hidden name=type value='itin'>
            <font size=2>Language: </font> <select name='language' onChange='bukaitin()'>
            <option value='CHINESE'";if($lang=='CHINESE'){echo"selected";}echo">Chinese</option>
            <option value='ENGLISH'";if($lang=='ENGLISH'){echo"selected";}echo">English</option>
            <option value='INDONESIA'";if($lang=='INDONESIA'){echo"selected";}echo">Indonesia</option>
            </select><br><br>
            <font size=2>Style: &nbsp&nbsp&nbsp&nbsp</font> <select name='style' onChange='bukaitin()'>";
            //<option value='LTM'";if($style=='LTM'){echo"selected";}echo">LTM Style</option>
            //<option value='TEZ'";if($style=='TEZ'){echo"selected";}echo">TUR EZ Style</option>
            if($style=='LTM'){echo"<option value='LTM' selected>LTM Style</option>";}
            else if($style=='TEZ'){echo"<option value='TEZ' selected>TUR EZ Style</option>";}echo"
            </select> $itsts
            </form>";

            if($itin=='uploaditin'){
                if($lang=='INDONESIA'){
                    $pilihpdf=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$IDProduct'");
                    $del='delattach';
                    $prod1='IDProduct';
                }else{
                    $pilihpdf=mysql_query("SELECT * FROM tour_msitinpdf WHERE IDProduct ='$IDProduct' AND Language = '$lang'");
                    $del='delattach1';
                    $prod1='ItinID';
                }
                $isipdf=mysql_fetch_array($pilihpdf);
                echo"<form name='example' method='POST' action='./aksi.php?module=msitin&act=upload' enctype='multipart/form-data'>
                    <input type=hidden name='id' value='$IDProduct'><input type=hidden name='lang' value='$lang'>
                    <table><tr><td>File Itinerary PDF</td><td>";
                $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isipdf[AttachmentFile]) ) ) );
                if($isipdf[AttachmentFile]<>''){$ok="disabled";echo"Itinerary:
                    <input type='hidden' name='attachmentfile' value='$isipdf[AttachmentFile]'>
                    <a href='$isipdf[Attachment]$file' target='_blank' style=text-decoration:none >$isipdf[AttachmentFile]</a> &nbsp<a href=\"javascript:$del('$isipdf[$prod1]','$isipdf[AttachmentFile]')\"><font color=red>remove</font></a></td></tr>";}
                else{$ok="enabled";echo"<input type='file' name='upload'>";}
                echo"</td></tr><tr><td colspan=2><center><input type='submit' value='Submit' $ok></center></td></tr></table> </form>";
            }
            else if($itin=='createitin'){
                // STYLE TEZ
                if($style=='TEZ'){
                    $prodpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                left join tour_msgrv on tour_msgrv.IDGrv = tour_msproductpnr.GrvID
                                left join tour_msairlines on tour_msairlines.AirlinesID = tour_msgrv.GrvAirlines
                                WHERE PnrProd = '$isi[IDProduct]' Group By GrvAirlines ");

                    $cb=0;
                    while($pnr=mysql_fetch_array($prodpnr)){
                        $airlines1=$pnr[AirlinesName];
                        if($cb==0){
                            $air="$airlines1";
                        }else{
                            $air=" & $airlines1";
                        }
                        $Airlines=$Airlines.$air;
                        $cb++;
                    }

                    $roomnow='awal';
                    $jumlah=mysql_num_rows($edit);
                    $depdet = strtoupper(date("d M Y", strtotime($isi[DateTravelFrom])));

                    if($isi[ProductTippingStatus]=='include'){$tips='';}else{$tips=$isi[ProductTipping];}
                    if($isi[GroupType]=='CRUISE'){$logo='images/PTICruise.png';}
                    else if($isi[Department]=='TUR EZ'){$logo='images/PTITUREZ.png';}
                    else {$logo='images/PTIExperience.png';}
                    echo "
            <form method=POST name='kopi' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msitin&act=copyitintez' >
            <input type=hidden name='id' value='$IDProduct'><input type=hidden name='daystravel' value='$isi[DaysTravel]'>
            <table style='border: 0px;'>
            <tr style='background:white;border: 0px;'><td style='border: 0px;'><input type='button' name='iwant' name='iwant' value='Copy Itin'  onclick=Sowit() ></td>
            <td style='border: 0px;'> <select name='idcopy' id='idcopy' style='visibility:hidden'>
            <option value='0' selected>- Select TourCode -</option>";
                    // copy itinerary berdasarkan product code yang sama saja
                    $tampil0=mysql_query("SELECT * FROM tour_msproduct
                                left join tour_msitin on tour_msitin.ProductID = tour_msproduct.IDProduct   
                                WHERE Status <> 'VOID'
                                AND IDProduct <> '$IDProduct' and ProductCode='$isi[ProductCode]'
                                AND DaysTravel = '$isi[DaysTravel]'
                                AND ProductID <> ''
                                AND tour_msitin.Language = '$lang'
                                AND StyleItin = '$style'
                                group by TourCode ORDER BY TourCode ASC ");
                    while($r0=mysql_fetch_array($tampil0)){
                        echo "<option value='$r0[IDProduct]'>$r0[TourCode]</option>";
                    }
                    echo "</select></td></tr>
          <tr style='border: 0px;'>
          <td style='border: 0px;'></td><td style='border: 0px;'><input type='submit' name='apdet' id='apdet' value='Copy' style='visibility:hidden'> <input type='button' name='tutup' id='tutup' value='Cancel' style='visibility:hidden' onclick=Hidit()></td></tr>
          </table>
          </form>
            <form name='example' method='POST' action='./aksi.php?module=msitintez&act=input' enctype='multipart/form-data'>
            <input type='hidden' name='productid' value='$isi[IDProduct]'><input type='hidden' name='daystravel' value='$isi[DaysTravel]'>
            <input type=hidden name='lang' value='$lang'><input type=hidden name='style' value='$style'>
            <table class='bordered' STYLE='border: 0px solid #000000'>
            <tr><td style='background:white;border: 0px solid #000000;' colspan=3></td>
            <td style='background:white;border: 0px solid #000000;' rowspan=4 colspan=3><img src='$logo'></td></tr>
            <tr><td style='background:white;border: 0px solid #000000;' colspan=3><font size=3><b>$isi[Productcode] - $isi[TourCode]</b></font></td></tr>
            <tr><td style='background:white;border: 0px solid #000000;' colspan=3><font size=3><b>BY $Airlines </b></font></td></tr>
            <tr><td style='background:white;border: 0px solid #000000;' colspan=3><font size=3><b>DEP.: $depdet </b></font></td></tr>

          <tr><th>day</th><th>route*</th><th>Detail</th><th>MEALS</th></tr>";
                    for($c=1;$c<=$isi[DaysTravel];$c++){
                        $prod=mysql_query("SELECT * FROM tour_msitin
                    WHERE ProductID = '$isi[IDProduct]'
                    AND Language = '$lang'
                    AND Days='$c' and Style = '$style' ");
                        $isiprod=mysql_fetch_array($prod);
                        if($isiprod[HotelID]=='0'){$htldetail=$isiprod[Hotel];$keluar='text';$keluar1='disabled';}else{$htldetail=$isiprod[Hotel];$keluar='hidden';$keluar1='enabled';}
                        echo"<tr height='20'>
          <td><center>$c</center></td>   
          <td>
          <input type='text' name='object01$c' value='$isiprod[Object01]' placeholder='City/Object 01'>
          <select name='objecttrans01$c' id='objecttrans01$c'>
          <option value='' ";if($isiprod[ObjectTrans01]==''){echo"selected";}echo">- Select Transportation -</option>
          <option value='PLANE'";if($isiprod[ObjectTrans01]=='PLANE'){echo"selected";}echo">Plane</option>
          <option value='TRAIN'";if($isiprod[ObjectTrans01]=='TRAIN'){echo"selected";}echo">Train</option>
          <option value='BUS'";if($isiprod[ObjectTrans01]=='BUS'){echo"selected";}echo">Bus</option>
          <option value='FERRY'";if($isiprod[ObjectTrans01]=='FERRY'){echo"selected";}echo">Ferry</option>
          </select><br><br>
          <input type='text' name='object02$c' value='$isiprod[Object02]' placeholder='City/Object 02'>
          <select name='objecttrans02$c' id='objecttrans02$c'>
          <option value='' ";if($isiprod[ObjectTrans02]==''){echo"selected";}echo">- Select Transportation -</option>
          <option value='PLANE'";if($isiprod[ObjectTrans02]=='PLANE'){echo"selected";}echo">Plane</option>
          <option value='TRAIN'";if($isiprod[ObjectTrans02]=='TRAIN'){echo"selected";}echo">Train</option>
          <option value='BUS'";if($isiprod[ObjectTrans02]=='BUS'){echo"selected";}echo">Bus</option>
          <option value='FERRY'";if($isiprod[ObjectTrans02]=='FERRY'){echo"selected";}echo">Ferry</option>
          </select><br><br>
          <input type='text' name='object03$c' value='$isiprod[Object03]' placeholder='City/Object 03'>
          <select name='objecttrans03$c' id='objecttrans03$c'>
          <option value='' ";if($isiprod[ObjectTrans03]==''){echo"selected";}echo">- Select Transportation -</option>
          <option value='PLANE'";if($isiprod[ObjectTrans03]=='PLANE'){echo"selected";}echo">Plane</option>
          <option value='TRAIN'";if($isiprod[ObjectTrans03]=='TRAIN'){echo"selected";}echo">Train</option>
          <option value='BUS'";if($isiprod[ObjectTrans03]=='BUS'){echo"selected";}echo">Bus</option>
          <option value='FERRY'";if($isiprod[ObjectTrans03]=='FERRY'){echo"selected";}echo">Ferry</option>
          </select><br><br>
          <input type='text' name='object04$c' value='$isiprod[Object04]' placeholder='City/Object 04'>
          <select name='objecttrans04$c' id='objecttrans04$c'>
          <option value='' ";if($isiprod[ObjectTrans04]==''){echo"selected";}echo">- Select Transportation -</option>
          <option value='PLANE'";if($isiprod[ObjectTrans04]=='PLANE'){echo"selected";}echo">Plane</option>
          <option value='TRAIN'";if($isiprod[ObjectTrans04]=='TRAIN'){echo"selected";}echo">Train</option>
          <option value='BUS'";if($isiprod[ObjectTrans04]=='BUS'){echo"selected";}echo">Bus</option>
          <option value='FERRY'";if($isiprod[ObjectTrans04]=='FERRY'){echo"selected";}echo">Ferry</option>
          </select><br><br>
          <input type='text' name='object05$c' value='$isiprod[Object05]' placeholder='City/Object 05'>
          </td>";
                        $Mengunjungi=str_replace("'",'&#39',"$isiprod[Mengunjungi]");$Melewati=str_replace("'",'&#39',"$isiprod[Melewati]");
                        $Mengunjungi2=str_replace("'",'&#39',"$isiprod[Mengunjungi2]");$Melewati2=str_replace("'",'&#39',"$isiprod[Melewati2]");
                        $Mengunjungi3=str_replace("'",'&#39',"$isiprod[Mengunjungi3]");$Melewati3=str_replace("'",'&#39',"$isiprod[Melewati3]");
                        $Mengunjungi4=str_replace("'",'&#39',"$isiprod[Mengunjungi4]");$Melewati4=str_replace("'",'&#39',"$isiprod[Melewati4]");
                        $Mengunjungi5=str_replace("'",'&#39',"$isiprod[Mengunjungi5]");$Melewati5=str_replace("'",'&#39',"$isiprod[Melewati5]");
                        $Mengunjungi6=str_replace("'",'&#39',"$isiprod[Mengunjungi6]");$Melewati6=str_replace("'",'&#39',"$isiprod[Melewati6]");
                        $Mengunjungi7=str_replace("'",'&#39',"$isiprod[Mengunjungi7]");$Melewati7=str_replace("'",'&#39',"$isiprod[Melewati7]");
                        $Mengunjungi8=str_replace("'",'&#39',"$isiprod[Mengunjungi8]");$Melewati8=str_replace("'",'&#39',"$isiprod[Melewati8]");
                        $Shopping=str_replace("'",'&#39',"$isiprod[Shopping]");$Photostop=str_replace("'",'&#39',"$isiprod[Photostop]");
                        $Shopping2=str_replace("'",'&#39',"$isiprod[Shopping2]");$Photostop2=str_replace("'",'&#39',"$isiprod[Photostop2]");
                        $Shopping3=str_replace("'",'&#39',"$isiprod[Shopping3]");$Photostop3=str_replace("'",'&#39',"$isiprod[Photostop3]");
                        $Shopping4=str_replace("'",'&#39',"$isiprod[Shopping4]");$Photostop4=str_replace("'",'&#39',"$isiprod[Photostop4]");
                        $Shopping5=str_replace("'",'&#39',"$isiprod[Shopping5]");$Photostop5=str_replace("'",'&#39',"$isiprod[Photostop5]");
                        $Shopping6=str_replace("'",'&#39',"$isiprod[Shopping6]");$Photostop6=str_replace("'",'&#39',"$isiprod[Photostop6]");
                        $Shopping7=str_replace("'",'&#39',"$isiprod[Shopping7]");$Photostop7=str_replace("'",'&#39',"$isiprod[Photostop7]");
                        $Shopping8=str_replace("'",'&#39',"$isiprod[Shopping8]");$Photostop8=str_replace("'",'&#39',"$isiprod[Photostop8]");

                        echo" <td height='10'>Mengunjungi: <input type='text' name='mengunjungi$c' value='$Mengunjungi' placeholder='Mengunjungi1' size='20'>
                                       <input type='text' name='mengunjungi2$c' value='$Mengunjungi2' placeholder='Mengunjungi2' size='20'>
                                       <input type='text' name='mengunjungi3$c' value='$Mengunjungi3' placeholder='Mengunjungi3' size='20'>
                                       <input type='text' name='mengunjungi4$c' value='$Mengunjungi4' placeholder='Mengunjungi4' size='20'><br><br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                       <input type='text' name='mengunjungi5$c' value='$Mengunjungi5' placeholder='Mengunjungi5' size='20'>
                                       <input type='text' name='mengunjungi6$c' value='$Mengunjungi6' placeholder='Mengunjungi6' size='20'>
                                       <input type='text' name='mengunjungi7$c' value='$Mengunjungi7' placeholder='Mengunjungi7' size='20'>
                                       <input type='text' name='mengunjungi8$c' value='$Mengunjungi8' placeholder='Mengunjungi8' size='20'>
                          <br><br>Melewati:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type='text' name='melewati$c' value='$Melewati' placeholder='Melewati1' size='20'>
                                        <input type='text' name='melewati2$c' value='$Melewati2' placeholder='Melewati2' size='20'>
                                        <input type='text' name='melewati3$c' value='$Melewati3' placeholder='Melewati3' size='20'>
                                        <input type='text' name='melewati4$c' value='$Melewati4' placeholder='Melewati4' size='20'><br><br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                        <input type='text' name='melewati5$c' value='$Melewati5' placeholder='Melewati5' size='20'>
                                        <input type='text' name='melewati6$c' value='$Melewati6' placeholder='Melewati6' size='20'>
                                        <input type='text' name='melewati7$c' value='$Melewati7' placeholder='Melewati7' size='20'>
                                        <input type='text' name='melewati8$c' value='$Melewati8' placeholder='Melewati8' size='20'>
                          <br><br>Shopping:&nbsp&nbsp&nbsp&nbsp&nbsp <input type='text' name='shopping$c' value='$Shopping' placeholder='Shopping1' size='20'>
                                        <input type='text' name='shopping2$c' value='$Shopping2' placeholder='Shopping2' size='20'>
                                        <input type='text' name='shopping3$c' value='$Shopping3' placeholder='Shopping3' size='20'>
                                        <input type='text' name='shopping4$c' value='$Shopping4' placeholder='Shopping4' size='20'><br><br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                        <input type='text' name='shopping5$c' value='$Shopping5' placeholder='Shopping5' size='20'>
                                        <input type='text' name='shopping6$c' value='$Shopping6' placeholder='Shopping6' size='20'>
                                        <input type='text' name='shopping7$c' value='$Shopping7' placeholder='Shopping7' size='20'>
                                        <input type='text' name='shopping8$c' value='$Shopping8' placeholder='Shopping8' size='20'>
                          <br><br>Photostop:&nbsp&nbsp&nbsp <input type='text' name='photostop$c' value='$Photostop' placeholder='Photostop' size='20'>
                                        <input type='text' name='photostop2$c' value='$Photostop2' placeholder='Photostop2' size='20'>
                                        <input type='text' name='photostop3$c' value='$Photostop3' placeholder='Photostop3' size='20'>
                                        <input type='text' name='photostop4$c' value='$Photostop4' placeholder='Photostop4' size='20'><br><br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                        <input type='text' name='photostop5$c' value='$Photostop5' placeholder='Photostop5' size='20'>
                                        <input type='text' name='photostop6$c' value='$Photostop6' placeholder='Photostop6' size='20'>
                                        <input type='text' name='photostop7$c' value='$Photostop7' placeholder='Photostop7' size='20'>
                                        <input type='text' name='photostop8$c' value='$Photostop8' placeholder='Photostop8' size='20'>
                          <br><br>
                          Hotel:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <select name='hotel$c' id='hotel$c' >
              <option value='' selected>- Select Hotel -</option>";
                        $hot=mysql_query("SELECT * FROM tour_mshotel where  Active='True' order by City,HotelName ASC");
                        while($htl=mysql_fetch_array($hot)){
                            if($isiprod[HotelID]==$htl[IDHotel]){
                                echo "<option value='$htl[IDHotel]' selected>$htl[City]: $htl[HotelName]</option>";
                            }else{
                                echo "<option value='$htl[IDHotel]'>$htl[City]: $htl[HotelName]</option>";
                            }
                        }

                        echo "</select>";
                        $ItinInfo=str_replace("'",'&#39',"$isiprod[ItinInfo]");
                        echo"<br><br>Information:&nbsp&nbsp <input type='text' name='itininfo$c' value='$ItinInfo' size='100'>
          </td>
          <td>MP: <select name='breakfast$c'>
                    <option value='NO MEALS'>NO MEALS</option>";
                        $qbreak=mysql_query("SELECT * FROM tour_mealstype where MealsStatus = 'ACTIVE' order by MealsName ASC");
                        while($breakf=mysql_fetch_array($qbreak)){
                            if($isiprod[BreakfastType]==$breakf[MealsName]){
                                echo "<option value='$breakf[MealsName]' selected>$breakf[MealsName]</option>";
                            }else{
                                echo "<option value='$breakf[MealsName]'>$breakf[MealsName]</option>";
                            }
                        }
                        echo "
                  </select><br><br>
          MS: <select name='lunch$c'>
                    <option value='NO MEALS'>NO MEALS</option>";
                        $qlunch=mysql_query("SELECT * FROM tour_mealstype where MealsStatus = 'ACTIVE' order by MealsName ASC");
                        while($lunch=mysql_fetch_array($qlunch)){
                            if($isiprod[LunchType]==$lunch[MealsName]){
                                echo "<option value='$lunch[MealsName]' selected>$lunch[MealsName]</option>";
                            }else{
                                echo "<option value='$lunch[MealsName]'>$lunch[MealsName]</option>";
                            }
                        }
                        echo "
                  </select><br><br>
          MM: <select name='dinner$c'>
                    <option value='NO MEALS'>NO MEALS</option>";
                        $qdinner=mysql_query("SELECT * FROM tour_mealstype where MealsStatus = 'ACTIVE' order by MealsName ASC");
                        while($dinner=mysql_fetch_array($qdinner)){
                            if($isiprod[DinnerType]==$dinner[MealsName]){
                                echo "<option value='$dinner[MealsName]' selected>$dinner[MealsName]</option>";
                            }else{
                                echo "<option value='$dinner[MealsName]'>$dinner[MealsName]</option>";
                            }
                        }
                        echo "
                  </select></td>
          </tr>";
                    }
                    echo" </table>
          <table class='bordered' STYLE='border: 0px solid #000000'>
          <tr><th colspan='5'>Flight Schedule</th></tr>";
                    $qpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                        WHERE PnrProd ='$isi[IDProduct]'");
                    while($pnr=mysql_fetch_array($qpnr)){
                        $fly=mysql_query("SELECT * FROM tour_msprodflight
                                            WHERE IDGrv ='$pnr[GrvID]' order by FID ASC");
                        while($flight=mysql_fetch_array($fly)){
                            if($flight[AirDate]=='1970-01-01' or $flight[AirDate]==''){$AD='';}else{
                                $AD = strtoupper(date('d M', strtotime($flight[AirDate])));}

                            $ATD = date('H.i', strtotime($flight[AirTimeDep]));
                            $ATA = date('H.i', strtotime($flight[AirTimeArr]));
                            echo"
                            <tr><td style='border: 0px solid #000000;'><font size=1>$flight[AirCode]</font></td>
                            <td style='border: 0px solid #000000;'><font size=1>$AD</font></td>
                            <td style='border: 0px solid #000000;'><center><font size=1>$flight[AirRouteDep] - $flight[AirRouteArr]</font></td>
                            <td style='border: 0px solid #000000;'><font size=1>$ATD - $ATA</font></td>
                            <td style='border: 0px solid #000000;'><font size=1>$flight[Note]</font></td>";
                        }
                    }
                    $cthcuaca= strtoupper(date("M Y", time()));
                    echo"
          </tr></table>
          <table class='bordered'>
          <tr><th colspan='2'>additional info</th></tr>
          <tr><td>Product Desc</td><td><input type='text' name='productdescription' placeholder='DESCRIPTION PRODUCT' value='$isi[ProductDescription]' size='100'></td></tr>
          <tr><td>Highlight</td><td><input type='text' name='highlightcountry' placeholder='HIGHLIGHT COUNTRY' value='$isi[HighlightCountry]' size='100'></td></tr>
          <tr><td>Bonus</td><td><input type='text' name='bonus' size='100' placeholder='BONUS PRODUCT' value='$isi[ProductBonus]'></td></tr>
          <tr><td>Cuaca</td><td><input type='text' name='cuacaitin' size='50' value='$isi[CuacaItin]' placeholder='ex: $cthcuaca: 15-20*C'></td></tr>
          <tr><td>Tipping</td><td>
          <input type=radio name='tipsi' value='include' onclick='intip()' ";if($isi[ProductTippingStatus]=='include' OR $isi[ProductTipping]==''){echo"checked";}echo">&nbsp;Include
          <input type=radio name='tipsi' value='notinclude' onclick='notip()' ";if($isi[ProductTippingStatus]=='notinclude'){echo"checked";}echo">&nbsp;Not Include
          <input type='text' name='tipping' id='tipping' value='$tips'></td></tr>
          <input type='hidden' name='column' value='one'>
          <tr><td>Meeting Point</td><td><textarea cols='3' id='tempatkumpul' name='tempatkumpul' rows='2'>$isi[TempatKumpul]</textarea>
          ";?>
                    <script type="text/javascript">
                        //<![CDATA[

                        CKEDITOR.replace( tempatkumpul, {
                            extraPlugins : 'autogrow',
                            autoGrow_maxHeight : '130',
                            height : '130px',
                            width : '400px',
                            removePlugins : 'resize',
                            resize_dir : 'vertical'
                        });

                        //]]>
                    </script>
                    <?PHP echo"</td></tr>";
                    $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isi[MapFile]) ) ) );
                    echo"<tr><td>Map Picture</td><td>";if($isi[MapFile]<>''){
                        echo"<input type='hidden' name='mapfile' value='$isi[MapFile]'>
        <a href='$isi[MapFolder]$file' target='_blank' style=text-decoration:none >$isi[MapFile]</a> &nbsp<a href=\"javascript:delmap('$isi[IDProduct]','$isi[MapFile]')\"><font color=red>remove</font></a>";}
                    else{echo"<input type='file' name='upload' >";
                    }echo"
          </table>";
                    //select hotel di hide
                    /*<table id='hotel' border='1'>";
                              $i=0;
                              $coba=mysql_query("SELECT * FROM tour_msitinhotel where ProductID ='$isi[IDProduct]' order by HotinID ASC");
                              $baris=mysql_num_rows($coba);
                              if ($baris==0){
                                  echo"<tr>
                               <td>Hotel <img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' />&nbsp</td>
                               <td><img src='../images/add.png' class='cloneTableRows' /> &nbsp <select name='hotel[]' >
                                <option value='0' selected>- Select Hotel -</option>";
                                  $hot=mysql_query("SELECT * FROM tour_mshotel where  Active='True' order by City,HotelName ASC");
                                  while($htl=mysql_fetch_array($hot)){
                                          echo "<option value='$htl[IDHotel]'>$htl[City]: $htl[HotelName]</option>";
                                  }
                                  echo "</select></td>
                            </tr>
                            </table>";
                              }else {
                                  while($tes=mysql_fetch_array($coba)){
                                      if($i==0){
                                          $vis="style='visibility: hidden;'";
                                      }else {$vis="style='visibility: visible;'";}
                                      echo"
                    <tr>
                    <td>Hotel <img src='../images/delete.png' alt='' class='delRow' $vis />&nbsp</td>
                    <td><img src='../images/add.png' class='cloneTableRows' /> &nbsp <select name='hotel[]' >
                    <option value='0' selected>- Select Hotel -</option>";
                                      $hot=mysql_query("SELECT * FROM tour_mshotel where  Active='True' order by City,HotelName ASC");
                                      while($htl=mysql_fetch_array($hot)){
                                          if($tes[HotelID]==$htl[IDHotel]){
                                              echo "<option value='$htl[IDHotel]' selected>$htl[City]: $htl[HotelName]</option>";
                                          }else{
                                              echo "<option value='$htl[IDHotel]'>$htl[City]: $htl[HotelName]</option>";
                                          }
                                      }
                                      echo "</select></td></tr>";$i++;}echo"
                    </table>";}*/
                    echo" <br><center><select name='statusitin'>
            <option value='ACTIVE'";if($isi[StyleItin]==$style){echo"selected";}echo">PUBLISH ITIN</option>
            <option value='INACTIVE'";if($isi[StyleItin]<>$style){echo"selected";}echo">UNPUBLISH ITIN</option>
            </select>
          <br><br>";
                    if($_GET['statusitin']=='ACTIVE'){$style=$_GET['style'];}
                    echo"<input type='submit' value='Save'> <input type=button value='Close' onclick=location.href='?module=msproduct'></form>";

                }
                // STYLE LTM
                else {
                    $prodpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                left join tour_msgrv on tour_msgrv.IDGrv = tour_msproductpnr.GrvID
                                left join tour_msairlines on tour_msairlines.AirlinesID = tour_msgrv.GrvAirlines
                                WHERE PnrProd = '$isi[IDProduct]' Group By GrvAirlines ");

                    $cb=0;
                    while($pnr=mysql_fetch_array($prodpnr)){
                        $airlines1=$pnr[AirlinesName];
                        if($cb==0){
                            $air="$airlines1";
                        }else{
                            $air=" & $airlines1";
                        }
                        $Airlines=$Airlines.$air;
                        $cb++;
                    }

                    $roomnow='awal';
                    $jumlah=mysql_num_rows($edit);
                    $depdet = strtoupper(date("d M Y", strtotime($isi[DateTravelFrom])));

                    if($isi[ProductTippingStatus]=='include'){$tips='';}else{$tips=$isi[ProductTipping];}
                    if($isi[GroupType]=='CRUISE'){$logo='images/PTICruise.png';}
                    else if($isi[Department]=='TUR EZ'){$logo='images/PTITUREZ.png';}
                    else {$logo='images/PTIExperience.png';}
                    echo "
            <form method=POST name='kopi' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msitin&act=copyitin' >
            <input type=hidden name='id' value='$IDProduct'><input type=hidden name='daystravel' value='$isi[DaysTravel]'>
            <table style='border: 0px;'>
            <tr style='background:white;border: 0px;'><td style='border: 0px;'><input type='button' name='iwant' name='iwant' value='Copy Itin'  onclick=Sowit() ></td>
            <td style='border: 0px;'> <select name='idcopy' id='idcopy' style='visibility:hidden'>
            <option value='0' selected>- Select TourCode -</option>";
                    // copy itinerary berdasarkan product code yang sama saja
                    $tampil0=mysql_query("SELECT * FROM tour_msproduct
                                left join tour_msitin on tour_msitin.ProductID = tour_msproduct.IDProduct
                                WHERE Status <> 'VOID'
                                AND IDProduct <> '$IDProduct' and ProductCode='$isi[ProductCode]'
                                AND DaysTravel = '$isi[DaysTravel]'
                                AND ProductID <> ''
                                AND tour_msitin.Language = '$lang'
                                AND StyleItin = '$style'
                                group by TourCode ORDER BY TourCode ASC ");
                    while($r0=mysql_fetch_array($tampil0)){
                        echo "<option value='$r0[IDProduct]'>$r0[TourCode]</option>";
                    }
                    echo "</select></td></tr>
          <tr style='border: 0px;'>
          <td style='border: 0px;'></td><td style='border: 0px;'><input type='submit' name='apdet' id='apdet' value='Copy' style='visibility:hidden'> <input type='button' name='tutup' id='tutup' value='Cancel' style='visibility:hidden' onclick=Hidit()></td></tr>
          </table>
          </form>
                    <form name='example' method='POST' action='./aksi.php?module=msitin&act=input' enctype='multipart/form-data'>
                    <input type='hidden' name='productid' value='$isi[IDProduct]'><input type='hidden' name='daystravel' value='$isi[DaysTravel]'>
                    <input type=hidden name='lang' value='$lang'><input type=hidden name='style' value='$style'>
                    <table class='bordered' STYLE='border: 0px solid #000000'>";
                    if($isi[GroupType]=='TUR EZ'){
                        echo "<tr><td style='background:white;border: 0px solid #000000;' colspan=3></td>
                    <td style='background:white;border: 0px solid #000000;' rowspan=4 colspan=3><img src='$logo'></td></tr>
                    <tr><td style='background:white;border: 0px solid #000000;' colspan=3><font size=3><b>$isi[Productcode] - $isi[TourCode]</b></font></td></tr>
                    <tr><td style='background:white;border: 0px solid #000000;' colspan=3><font size=3><b>BY $Airlines </b></font></td></tr>
                    <tr><td style='background:white;border: 0px solid #000000;' colspan=3><font size=3><b>DEP.: $depdet </b></font></td></tr> ";
                    }else{
                        echo "<tr><td style='background:white;border: 0px solid #000000;' colspan=6></td></tr>
                    <tr><td style='background:white;border: 0px solid #000000;' colspan=6><img src='$logo'></td></tr>
                    <tr><td style='background:white;border: 0px solid #000000;' colspan=6><font size=3><b>$isi[Productcode] - $isi[TourCode]</b></font></td></tr>
                    <tr><td style='background:white;border: 0px solid #000000;' colspan=6><font size=3><b>BY $Airlines </b></font></td></tr>
                    <tr><td style='background:white;border: 0px solid #000000;' colspan=6><font size=3><b>DEP.: $depdet </b></font></td></tr> ";
                    }echo"
                    <tr><th colspan=5></th><th colspan=3>meals</th></tr>
          <tr><th>day</th><th>route*</th><th>Detail</th><th>Hotel</th><th>transportation By</th><th>bfast</th><th>lunch</th><th>dinner</th></tr>";
                    for($c=1;$c<=$isi[DaysTravel];$c++){
                        $prod=mysql_query("SELECT * FROM tour_msitin
                    WHERE ProductID = '$isi[IDProduct]'
                    AND Language = '$lang'
                    AND Days='$c' ");
                        $isiprod=mysql_fetch_array($prod);
                        if($isiprod[HotelID]=='0'){$htldetail=$isiprod[Hotel];$keluar='text';$keluar1='disabled';}else{$htldetail=$isiprod[Hotel];$keluar='hidden';$keluar1='enabled';}
                        echo"<tr height='20'>
          <td><center>$c</center></td>
          <td><center><input type='text' name='route$c' size='40' value='$isiprod[Route]'></td>
          <td height='10'><center><textarea cols='3' id='tcb$c' name='detail$c' rows='2'>$isiprod[Detail]</textarea>
          ";?>
                        <script type="text/javascript">
                            //<![CDATA[

                            CKEDITOR.replace( <?PHP echo"tcb$c," ?> {
                                extraPlugins : 'autogrow',
                                autoGrow_maxHeight : '130',
                                height : '130px',
                                width : '400px',
                                removePlugins : 'resize',
                                resize_dir : 'vertical'
                            });

                            //]]>
                        </script>
                        <?PHP echo"</td>
          <td>
          <input type=radio name='htlnote$c' id='radiohotel' value='htlhotel' onclick=pilihhtl('htlhotel','$c') ";if($isiprod[HotelID]<>'0'){echo"checked";}echo">&nbsp;
          <select name='hotel$c' id='hotel$c' $keluar1>
              <option value='' selected>- Select Hotel -</option>";
                        $hot=mysql_query("SELECT * FROM tour_mshotel where Country = '$isi[Destination]' AND Active='True' order by HotelName ASC");
                        while($htl=mysql_fetch_array($hot)){
                            if($isiprod[HotelID]==$htl[IDHotel]){
                                echo "<option value='$htl[IDHotel]' selected>$htl[HotelName] (+$htl[Telephone])</option>";
                            }else{
                                echo "<option value='$htl[IDHotel]'>$htl[HotelName] (+$htl[Telephone])</option>";
                            }
                        }
                        echo "</select><br><br>
          <input type=radio name='htlnote$c' id='radionote' value='htlnote' onclick=pilihhtl('htlnote','$c') ";if($isiprod[HotelID]=='0'){echo"checked";}echo">&nbsp;
          <input type='$keluar' name='hoteldetail$c' id='hoteldetail$c' value='$htldetail'><input type='hidden' name='temphtl$c' id='temphtl$c' value='$htldetail'>
          </td>
          <td><select name='trans$c' id='trans$c'>
              <option value='' ";if($isiprod[Transport]==''){echo"selected";}echo">- Select Transportation -</option>
              <option value='PLANE'";if($isiprod[Transport]=='PLANE'){echo"selected";}echo">Plane</option>
              <option value='TRAIN'";if($isiprod[Transport]=='TRAIN'){echo"selected";}echo">Train</option>
              <option value='BUS'";if($isiprod[Transport]=='BUS'){echo"selected";}echo">Bus</option>
              <option value='FERRY'";if($isiprod[Transport]=='FERRY'){echo"selected";}echo">Ferry</option>
              </select><br><br>
              <center>
              <input type='text' name='cashbackmeals$c' placeholder='ex:CASH BACK USD 150' size='20' value='$isiprod[CashbackMeals]'></center></td>
          <td><center><input type='checkbox' name='breakfast$c' value='YES'";if($isiprod[Breakfast]=='YES'){echo"checked";}echo"></td>
          <td><center><input type='checkbox' name='lunch$c' value='YES'";if($isiprod[Lunch]=='YES'){echo"checked";}echo"></td>
          <td><center><input type='checkbox' name='dinner$c' value='YES'";if($isiprod[Dinner]=='YES'){echo"checked";}echo"></td>
          </tr>";
                    }
                    echo" </table>
          <table class='bordered' STYLE='border: 0px solid #000000'>
          <tr><th colspan='5'>Flight Schedule</th></tr>";
                    $qpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                        WHERE PnrProd ='$isi[IDProduct]'");
                    while($pnr=mysql_fetch_array($qpnr)){
                        $fly=mysql_query("SELECT * FROM tour_msprodflight
                                            WHERE IDGrv ='$pnr[GrvID]' order by FID ASC");
                        while($flight=mysql_fetch_array($fly)){
                            if($flight[AirDate]=='1970-01-01' or $flight[AirDate]==''){$AD='';}else{
                                $AD = strtoupper(date('d M', strtotime($flight[AirDate])));}

                            $ATD = date('H.i', strtotime($flight[AirTimeDep]));
                            $ATA = date('H.i', strtotime($flight[AirTimeArr]));
                            echo"
                            <tr><td style='border: 0px solid #000000;'><font size=1>$flight[AirCode]</font></td>
                            <td style='border: 0px solid #000000;'><font size=1>$AD</font></td>
                            <td style='border: 0px solid #000000;'><center><font size=1>$flight[AirRouteDep] - $flight[AirRouteArr]</font></td>
                            <td style='border: 0px solid #000000;'><font size=1>$ATD - $ATA</font></td>
                            <td style='border: 0px solid #000000;'><font size=1>$flight[Note]</font></td>";
                        }
                    }
                    echo"
          </tr></table>
          <table class='bordered'>
          <tr><th colspan='2'>additional info</th></tr>
          <tr><td>Product Desc</td><td><input type='text' name='productdescription' placeholder='DESCRIPTION PRODUCT' value='$isi[ProductDescription]' size='100'></td></tr>
          <tr><td width='100'>Bonus</td><td><input type='text' name='bonus' size='100' value='$isi[ProductBonus]'></td></tr>
          <tr><td>Tipping</td><td>
          <input type=radio name='tipsi' value='include' onclick='intip()' ";if($isi[ProductTippingStatus]=='include' OR $isi[ProductTipping]==''){echo"checked";}echo">&nbsp;Include
          <input type=radio name='tipsi' value='notinclude' onclick='notip()' ";if($isi[ProductTippingStatus]=='notinclude'){echo"checked";}echo">&nbsp;Not Include
          ";/*<select name='karensi' id='karensi'><option value='' selected>-select-</option>";
                $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
                while($s=mysql_fetch_array($tampil)){
                    if($s[curr]==$isi[ProductTippingCurr]){
                        echo "<option value='$s[curr]' selected>$s[curr]</option>";
                    } else {
                        echo "<option value='$s[curr]' >$s[curr]</option>";
                    }
                }
                echo "</select>*/echo" <input type='text' name='tipping' id='tipping' value='$tips'></td></tr>
          <tr><td>Show Detail in</td><td><input type=radio name='column' value='one'";if($isi[ProductColumn]=='' OR $isi[ProductColumn]=='one'){echo"checked";}echo">&nbsp;One Column
          <input type=radio name='column' value='two'";if($isi[ProductColumn]=='two'){echo"checked";}echo">&nbsp;Two Column</td></tr>
          <tr><td>Meeting Point</td><td><textarea cols='3' id='tempatkumpul' name='tempatkumpul' rows='2'>$isi[TempatKumpul]</textarea>
          ";?>
                    <script type="text/javascript">
                        //<![CDATA[

                        CKEDITOR.replace( tempatkumpul, {
                            extraPlugins : 'autogrow',
                            autoGrow_maxHeight : '130',
                            height : '130px',
                            width : '400px',
                            removePlugins : 'resize',
                            resize_dir : 'vertical'
                        });

                        //]]>
                    </script>
                    <?PHP echo"</td></tr>";
                    $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isi[MapFile]) ) ) );
                    echo"<tr><td>Map Picture</td><td>";if($isi[MapFile]<>''){
                        echo"<input type='hidden' name='mapfile' value='$isi[MapFile]'>
                    <a href='$isi[MapFolder]$file' target='_blank' style=text-decoration:none >$isi[MapFile]</a> &nbsp<a href=\"javascript:delmap('$isi[IDProduct]','$isi[MapFile]')\"><font color=red>remove</font></a>";}
                    else{echo"<input type='file' name='upload' >";
                    }echo"
                    </table>
                    <table class='bordered' id='opttour' border='1'>";
                    $i=0;
                    $coba=mysql_query("SELECT * FROM tour_msitinopttour where ProductID ='$isi[IDProduct]' order by OptionID ASC");
                    $baris=mysql_num_rows($coba);
                    if ($baris==0){
                        echo"<tr>
                     <td width='100'>Optional Tour <img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' />&nbsp</td>
                     <td><img src='../images/add.png' class='cloneTableRows' /> &nbsp <input type='text' name='optiontour[]' placeholder='Object Name'>
                     <input type='text' name='optiondesc[]' size='50' placeholder='Description'>
                     <input type='text' name='optionprice[]' placeholder='Price'></td>
                    </tr>
                    </table>";
                    }else {
                        while($tes=mysql_fetch_array($coba)){
                            if($i==0){
                                $vis="style='visibility: hidden;'";
                            }else {$vis="style='visibility: visible;'";}
                            echo"
          <tr>
          <td>Optional Tour <img src='../images/delete.png' alt='' class='delRow' $vis />&nbsp</td>
          <td><img src='../images/add.png' class='cloneTableRows' /> &nbsp <input type='text' name='optiontour[]' value='$tes[OptionName]' placeholder='Object Name'>
          <input type='text' name='optiondesc[]' size='50' value='$tes[OptionDescription]' placeholder='Description'>
          <input type='text' name='optionprice[]' value='$tes[OptionPrice]' placeholder='Price'></td></tr>";$i++;}echo"
          </table>";}
                    echo"<br><center>
          <select name='statusitin'>
            <option value='ACTIVE'";if($isi[StyleItin]==$style){echo"selected";}echo">PUBLISH ITIN</option>
            <option value='INACTIVE'";if($isi[StyleItin]<>$style){echo"selected";}echo">UNPUBLISH ITIN</option>
            </select><br><br>";
                    if($_GET['statusitin']=='ACTIVE'){$style=$_GET['style'];}
                    echo"<input type='submit' value='Save'> <input type=button value='Close' onclick=location.href='?module=msproduct'></form>";

                }
            }
        }else if($type=='information'){
            if($isi[ProductTipping]=='0'){$tips='';}else{$tips=$isi[ProductTipping];}
            if($isi[GroupType]=='CRUISE'){$logo='images/PTICruise.png';}
            else if($isi[Department]=='TUR EZ'){$logo='images/PTITUREZ.png';}
            else {$logo='images/PTIExperience.png';}
            echo "<img src='$logo'><br>
            HAL-HAL PERHATIAN<br>
            <form name='example' method='POST' action='./aksi.php?module=msitin&act=information' enctype='multipart/form-data'>
            <input type=hidden name='id' value='$IDProduct'>
            <textarea id='inf' name='info'>$isi[ProductInformation]</textarea>
          ";?>
            <script type="text/javascript">
                //<![CDATA[
                CKEDITOR.replace( inf, {
                    extraPlugins : 'autogrow',
                    autoGrow_maxHeight : '850',
                    height : '850px',
                    width : '800px',
                    removePlugins : 'resize',
                    resize_dir : 'vertical'
                });
                //]]>
            </script><?PHP echo"
            <br><center><input type='submit' value='Save'> <input type=button value='Close' onclick=location.href='?module=msproduct'></form>";
        }
        break;

    case "showitin":
        $IDProduct=$_GET[id];
        $attach=$_GET[attach];
        $lang=$_GET['language'];
        $style=$_GET['style'];
        if($lang==''){$lang='INDONESIA';}else{$lang=$lang;}
        if($attach==''){$attach='itin';}else{$attach=$attach;}
        $filt=mssql_query("SELECT EmployeeID,DivisiNO,Employee.DivisiID,Category,EmployeeName,CompanyGroup,LTMAuthority FROM [HRM].[dbo].[Employee]
                      inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                      WHERE EmployeeID = '$_SESSION[employee_code]'");
        $filter=mssql_fetch_array($filt);
        $team=$filter[LTMAuthority];
        $qdprt=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$IDProduct'");
        $dprt=mysql_fetch_array($qdprt);
        $style=$dprt[StyleItin];
        echo"<form method='get' id='jenisattach' action='media.php?'>
            <input type=hidden name=module value='msitin'><input type=hidden name='id' value='$IDProduct'><input type='hidden' name='act' value='showitin'>
            Attachment <select name='attach' onchange='gantiattach()'>
            <option value='itin'";if($attach=='itin'){echo"selected";}echo">Itinerary</option>
            <option value='hotel'";if($attach=='hotel'){echo"selected";}echo">Hotel List</option>
            <option value='information'";if($attach=='information'){echo"selected";}echo">Information</option>
            </select>
            </form>";
        if($attach=='itin'){

            echo"<form method='get' id='jenisitin' action='media.php?'>
            <input type=hidden name=module value='msitin'><input type=hidden name='id' value='$IDProduct'><input type=hidden name='act' value='showitin'>
            <font size=2>Language: </font> <select name='language' onChange='bukaitin()'>
            <option value='CHINESE'";if($lang=='CHINESE'){echo"selected";}echo">Chinese</option>
            <option value='ENGLISH'";if($lang=='ENGLISH'){echo"selected";}echo">English</option>
            <option value='INDONESIA'";if($lang=='INDONESIA'){echo"selected";}echo">Indonesia</option>
            </select></form>";
            $tblitin=mysql_query("SELECT * FROM tour_msitin
                                WHERE ProductID ='$IDProduct' AND Language ='$lang' and Style ='$style'");
            $cek1=mysql_num_rows($tblitin);
            $pilihpdf=mysql_query("SELECT * FROM tour_msitinpdf WHERE IDProduct ='$IDProduct' AND Language = '$lang'");
            $cek2=mysql_num_rows($pilihpdf);
            $pdfprod=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$IDProduct' AND Language = '$lang'");
            $cek3=mysql_num_rows($pdfprod);
//---- cek pertama
            /*if($cek2>0){
                $pilihpdf=mysql_query("SELECT * FROM tour_msitinpdf WHERE IDProduct ='$IDProduct' AND Language = '$lang'");
                $isipdf=mysql_fetch_array($pilihpdf);
                echo"
                <table><tr><td>File Itinerary PDF</td><td>";
                $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isipdf[AttachmentFile]) ) ) );
                echo"Itinerary: <a href='$isipdf[Attachment]$file' target='_blank' style=text-decoration:none >$isipdf[AttachmentFile]</a></td></tr></table><br><br>
                <center><input type=button value='Back' onclick=self.history.back()>";

            }else */
            if($cek1>0){
                if($style=='LTM'){
                    $ambil=mysql_query("SELECT tour_msproduct.*,
                    tour_msproductcode.* FROM tour_msproduct
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode
                    WHERE tour_msproduct.IDProduct ='$IDProduct'");
                    $isi=mysql_fetch_array($ambil);
                    $prodpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                left join tour_msgrv on tour_msgrv.IDGrv = tour_msproductpnr.GrvID
                                left join tour_msairlines on tour_msairlines.AirlinesID = tour_msgrv.GrvAirlines
                                WHERE PnrProd = '$isi[IDProduct]'");

                    $cb=0;
                    while($pnr=mysql_fetch_array($prodpnr)){
                        $airlines1=$pnr[AirlinesName];
                        if($cb==0){
                            $air="$airlines1";
                        }else{
                            $air=" & $airlines1";
                        }
                        $Airlines=$Airlines.$air;
                        $cb++;
                    }

                    $depdet = strtoupper(date("d M Y", strtotime($isi[DateTravelFrom])));
                    if($isi[ProductTippingCurr]==''){$tipscurr=$isi[SellingCurr];}else{$tipscurr=$isi[ProductTippingCurr];}
                    if($isi[ProductTippingStatus]=='include'){$tips='INCLUDE';}else{$tips=$isi[ProductTipping];}//{$tips="$tipscurr.$isi[ProductTipping]";}
                    if($isi[GroupType]=='CRUISE'){$logo='images/PTICruise.png';}
                    else if ($isi[GroupType]=='CONSORTIUM'){$logo='';}
                    else if($isi[Department]=='TUR EZ'){$logo='images/PTITUREZ.png';}
                    else {$logo='images/PTIExperience.png';}
                    if($isi[ShockingOffer]=='YES'){$shockimg="<img src='images/shockoff.png'>";}
                    if($isi[ProductBonus]==''){$bns='';$bns1='';}else{$bns="<font size=2><b>$isi[ProductBonus]</b></font><br>";$bns1="<font size=2><b>$isi[ProductBonus]</b></font></td>";}
                    if(($isi[ProductCode]=='HFS' OR $isi[ProductCode]=='HFL' OR $isi[ProductCode]=='HFR'
                        OR $isi[ProductCode]=='HLF' OR $isi[ProductCode]=='HRL' OR $isi[ProductCode]=='HSL')
                        AND $isi[DateTravelFrom] >= '2018-01-01' AND $isi[DateTravelFrom] <= '2019-01-01') {
                        $promoministry = "<img src='images/160lourdes.png'>";
                    }
                    //table utama
                    echo "  <center><table style='border:0' >";
                    if($isi[GroupType]=='TUR EZ'){
                        echo "  <tr><td style='border:0'>
                    <font size=3><b>$isi[DaysTravel] DAYS $isi[Productcode]</b></font><br>
                    <font size=3><b>BY $Airlines </b></font><br>
                    <font size=2><b>DEP.: $depdet </b></font><br>
                    <font size=2><b>$isi[TourCode]</b></font><br>
                    $bns1
                    <td style='border:0' align='right'><img src='$logo'></td></tr>
                    <tr><td colspan=2 width='695px' height='842px' align='justify' style='border:0'>";
                    }else{
                        echo "  <tr><td style='border:0' width='695px' height='842px' align='justify'>

                    <img src='$logo'> $shockimg$promoministry<br>
                    <font size=3><b>$isi[DaysTravel] DAYS $isi[Productcode]</b></font> <br>
                    <font size=3><b>BY $Airlines </b></font><br>
                    <font size=2><b>DEP.: $depdet </b></font><br>
                    <font size=2><b>$isi[TourCode]</b></font><br>$bns
                    ";
                    }
                    $tblitin=mysql_query("SELECT *,CONVERT(Days, UNSIGNED INTEGER) as urut FROM tour_msitin
                                WHERE ProductID ='$isi[IDProduct]' and Language = '$lang' and Style = '$style' order by urut");
                    $day=0;
                    $mapfile= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isi[MapFile]) ) ) );
                    if($isi[MapFile]<>''){$map="<img src='$isi[MapFolder]$mapfile' width='330px' height='330px'>";}else{$map='';}
                    while($itin=mysql_fetch_array($tblitin)){
                        if(strlen($itin[Days])==1){$hari="0$itin[Days]";}else{$hari="$itin[Days]";}
                        $route=$itin[Route];
                        if($itin[CashbackMeals]<>''){$cbm="$itin[CashbackMeals]";}else{$cbm="";}
                        if($itin[Breakfast]=='YES' AND $itin[Lunch]=='YES' AND $itin[Dinner]=='YES'){$meals="<b>(B/L/D$cbm)</b>";}
                        else if($itin[Breakfast]=='YES' AND $itin[Lunch]=='YES' AND $itin[Dinner]==''){$meals="<b>(B/L$cbm)</b>";}
                        else if($itin[Breakfast]=='YES' AND $itin[Lunch]=='' AND $itin[Dinner]=='YES'){$meals="<b>(B/D$cbm)</b>";}
                        else if($itin[Breakfast]=='' AND $itin[Lunch]=='YES' AND $itin[Dinner]=='YES'){$meals="<b>(L/D$cbm)</b>";}
                        else if($itin[Breakfast]=='YES' AND $itin[Lunch]=='' AND $itin[Dinner]==''){$meals="<b>(B$cbm)</b>";}
                        else if($itin[Breakfast]=='' AND $itin[Lunch]=='YES' AND $itin[Dinner]==''){$meals="<b>(L$cbm)</b>";}
                        else if($itin[Breakfast]=='' AND $itin[Lunch]=='' AND $itin[Dinner]=='YES'){$meals="<b>(D$cbm)</b>";}else{$meals='';}
                        $detail=preg_replace("[<p>]", "", str_replace("</p>", "", $itin[Detail] ) );
                        if($itin[Transport]=='PLANE'){$trans="<img src='../images/plane.png'>";}
                        else if($itin[Transport]=='TRAIN'){$trans="<img src='../images/train.png'>";}
                        else if($itin[Transport]=='BUS'){$trans="<img src='../images/bus.png'>";}
                        else if($itin[Transport]=='FERRY'){$trans="<img src='../images/ferry.png'>";}
                        else {$trans="";}
                        $dateday = $isi[DateTravelFrom];
                        $tanggalday = substr($dateday,8,2);
                        $bulanday = substr($dateday,5,2);
                        $tahunday = substr($dateday,0,4);

                        //$detail= $itin[Detail] ;
                        if($day==0){
                            $oneday= strtoupper(date('d M',strtotime('0 second',strtotime($day.' day',strtotime(date($bulanday).'/'.date($tanggalday).'/'.date($tahunday).' 00:00:00')))));
                            $itin="<b>HARI $hari/$oneday: $route $trans</b><br>
                           $detail $meals<br><br>";
                        }else{
                            $oneday= strtoupper(date('d M',strtotime('0 second',strtotime($day.' day',strtotime(date($bulanday).'/'.date($tanggalday).'/'.date($tahunday).' 00:00:00')))));
                            $itin="<b>HARI $hari/$oneday: $route $trans</b><br>
                           $detail $meals<br><br>";
                        }
                        $detailitin=$detailitin.$itin;
                        $day++;
                    }
                    //FORMAT CRUISE
                    if($isi[GroupType]=='CRUISE'){
                        if($isi[ProductColumn]=='one'){echo"<div class='one-col'>$isi[TempatKumpul]<br><br>$detailitin<br>$map";}
                        else if($isi[ProductColumn]=='two'){echo"<div class='two-col'>$isi[TempatKumpul]<br><br>$detailitin<br>$map";}

                        $qpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                        WHERE PnrProd ='$isi[IDProduct]'");
                        $tpnr=mysql_num_rows($qpnr);
                        if($tpnr>0){
                            echo "<u><b>FLIGHT DETAILS</b></u><br><table style='border:0'>";
                            while($pnr=mysql_fetch_array($qpnr)){
                                $fly=mysql_query("SELECT * FROM tour_msprodflight
                                            WHERE IDGrv ='$pnr[GrvID]' order by FID ASC");
                                while($flight=mysql_fetch_array($fly)){
                                    if($flight[AirDate]=='0000-00-00' or $flight[AirDate]=='1970-01-01'){
                                        $AD='';
                                    }else{
                                        $AD = strtoupper(date('d M', strtotime($flight[AirDate])));
                                    }
                                    $ATD = date('H.i', strtotime($flight[AirTimeDep]));
                                    $ATA = date('H.i', strtotime($flight[AirTimeArr]));
                                    echo"
                            <tr><td style='border:0'><font size=1>$flight[AirCode]</td><td style='border:0'>$AD &nbsp$flight[AirRouteDep] - $flight[AirRouteArr] </td><td style='border:0'>$ATD - $ATA &nbsp$flight[Note]</font></td></tr>";
                                }
                            }echo"</table>";
                        }
                        if($isi[SellingCurr]=='IDR'){
                            $cruiseadl12=$isi[CruiseAdl12]/1000;
                            $cruiseadl34=$isi[CruiseAdl34]/1000;
                            $cruisechd12=$isi[CruiseChd12]/1000;
                            $cruisechd34=$isi[CruiseChd34]/1000;
                            $singlesell=$isi[SingleSell]/1000;
                            $seataxsell=$isi[SeaTaxSell]/1000;
                            $taxinssell=$isi[TaxInsSell]/1000;
                            $VisaSell=$isi[VisaSell]/1000;
                            $VisaSell2=$isi[VisaSell2]/1000;
                            $VisaSell3=$isi[VisaSell3]/1000;
                            $VisaSell4=$isi[VisaSell4]/1000;
                            $VisaSell5=$isi[VisaSell5]/1000;
                            $ribuan="<font size='1'>(HARGA DALAM RIBUAN)</font><br>";
                        }else{
                            $cruiseadl12=$isi[CruiseAdl12];
                            $cruiseadl34=$isi[CruiseAdl34];
                            $cruisechd12=$isi[CruiseChd12];
                            $cruisechd34=$isi[CruiseChd34];
                            $singlesell=$isi[SingleSell];
                            $seataxsell=$isi[SeaTaxSell];
                            $taxinssell=$isi[TaxInsSell];
                            $VisaSell=$isi[VisaSell];
                            $VisaSell2=$isi[VisaSell2];
                            $VisaSell3=$isi[VisaSell3];
                            $VisaSell4=$isi[VisaSell4];
                            $VisaSell5=$isi[VisaSell5];
                            $ribuan="";
                        }
                        if($isi[StatusProduct]<>'FINALIZE'){
                            echo"</div><br>";
                            echo"<font size='1'>HARGA TOUR DALAM IDR (RIBUAN)<br>

          <table class='bordered'><tr><th width='80' colspan='2' style=vertical-align:middle>DEWASA</th><th colspan='2'>ANAK-ANAK</th>
                <th width=60 rowspan='2' style=vertical-align:middle>SGL SUPP</th>
                <th width=60 rowspan='2' style=vertical-align:middle>SEAPORT TAX DEPT TAX GRATUITIES</th>
                <th width='80' rowspan='2' style=vertical-align:middle>APO TAX INTL*</th>
                <th width='100' rowspan='2' style=vertical-align:middle>TIPPING**</th>";
                            if($isi[Embassy01]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy01]</th>";
                            }
                            if($isi[Embassy02]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy02]</th>";
                            }
                            if($isi[Embassy03]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy03]</th>";
                            }
                            if($isi[Embassy04]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy04]</th>";
                            }
                            if($isi[Embassy05]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy05]</th>";
                            }
                            echo "</tr><tr><th width=70>1st & 2nd Person</th><th width=70>3rd & 4th Person</th><th width=70>1st & 2nd Person</th><th width=70>3rd & 4th Person</th>
                    <tr><td><center>$isi[SellingCurr]. ".number_format($cruiseadl12, 0, '', ',');echo"</td></td>
                    <td><center>$isi[SellingCurr]. ".number_format($cruiseadl34, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($cruisechd12, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($cruisechd34, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($singlesell, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($seataxsell, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($taxinssell, 0, '', ',');echo"</td>
                    <td><center>$tips</td>";
                            if($isi[Embassy01]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell, 0, '', ',');echo"</td>";}
                            if($isi[Embassy02]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell2, 0, '', ',');echo"</td>";}
                            if($isi[Embassy03]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell3, 0, '', ',');echo"</td>";}
                            if($isi[Embassy04]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell4, 0, '', ',');echo"</td>";}
                            if($isi[Embassy05]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell5, 0, '', ',');echo"</td>";}
                            echo "</tr>";
                            echo "</table>";
          if($isi[DoaId01]<>'0'){
              $qvisadoa = mysql_query("SELECT * FROM doa_product_price WHERE Id = '$isi[DoaId01]' ");
              $dvisadoa = mysql_fetch_array($qvisadoa);
              echo"VISA $isi[Embassy01] CATEGORY: $dvisadoa[Type] - $dvisadoa[Name] - $dvisadoa[Process] - $dvisadoa[IsAdult]";
          }
          echo"<font size=1>* AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** TIPPING DIBAYARKAN DI NEGARA TUJUAN<br>
                        **** HARGA TOUR BELUM TERMASUK PPN 1%<br>
                        <b>***** NILAI DALAM MATA UANG RUPIAH DIHITUNG BERDASARKAN KURS ASUMSI DAN DAPAT BERUBAH SEWAKTU-WAKTU</b>
                                        </font><br>";
                        }
                        if($isi[Insurance]=='INCLUDE'){echo"<center><img src='images/panoramasure.png'>";}echo"
          <br><center><font size=1><b>JADWAL PERJALANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font>";
                        // FORMAT SERIES
                    }else if($isi[GroupType]=='TUR EZ'){
                        if($isi[ProductColumn]=='one'){echo"<div class='one-col'>$isi[TempatKumpul]<br><br>$detailitin<br>$map</div>";}
                        else if($isi[ProductColumn]=='two'){echo"<div class='two-col'>$isi[TempatKumpul]<br><br>$detailitin<br>$map</div><br>";}

                        $qpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                        WHERE PnrProd ='$isi[IDProduct]'");
                        $tpnr=mysql_num_rows($qpnr);
                        if($tpnr>0){
                            echo "<u><b>FLIGHT DETAILS</b></u><br><table style='border:0'>";
                            while($pnr=mysql_fetch_array($qpnr)){
                                $fly=mysql_query("SELECT * FROM tour_msprodflight
                                            WHERE IDGrv ='$pnr[GrvID]' order by FID ASC");
                                while($flight=mysql_fetch_array($fly)){
                                    if($flight[AirDate]=='0000-00-00' or $flight[AirDate]=='1970-01-01'){
                                        $AD='';
                                    }else{
                                        $AD = strtoupper(date('d M', strtotime($flight[AirDate])));
                                    }
                                    $ATD = date('H.i', strtotime($flight[AirTimeDep]));
                                    $ATA = date('H.i', strtotime($flight[AirTimeArr]));
                                    echo"
                            <tr><td style='border:0'><font size=1>$flight[AirCode]</td><td style='border:0'>$AD &nbsp$flight[AirRouteDep] - $flight[AirRouteArr] </td><td style='border:0'>$ATD - $ATA &nbsp$flight[Note]</font></td></tr>";
                                }
                            }echo"</table>";
                        }
                        if($isi[SellingCurr]=='IDR'){
                            $SellingAdlTwn=$isi[SellingAdlTwn]/1000;
                            $SellingChdTwn=$isi[SellingChdTwn]/1000;
                            $SellingChdXbed=$isi[SellingChdXbed]/1000;
                            $SellingChdNbed=$isi[SellingChdNbed]/1000;
                            $SingleSell=$isi[SingleSell]/1000;
                            $TaxInsSell=$isi[TaxInsSell]/1000;
                            $VisaSell=$isi[VisaSell]/1000;
                            $VisaSell2=$isi[VisaSell2]/1000;
                            $VisaSell3=$isi[VisaSell3]/1000;
                            $VisaSell4=$isi[VisaSell4]/1000;
                            $VisaSell5=$isi[VisaSell5]/1000;
                            $ribuan="<font size='1'>(HARGA DALAM RIBUAN)</font><br>";
                        }else{
                            $SellingAdlTwn=$isi[SellingAdlTwn];
                            $SellingChdTwn=$isi[SellingChdTwn];
                            $SellingChdXbed=$isi[SellingChdXbed];
                            $SellingChdNbed=$isi[SellingChdNbed];
                            $SingleSell=$isi[SingleSell];
                            $TaxInsSell=$isi[TaxInsSell];
                            $VisaSell=$isi[VisaSell];
                            $VisaSell2=$isi[VisaSell2];
                            $VisaSell3=$isi[VisaSell3];
                            $VisaSell4=$isi[VisaSell4];
                            $VisaSell5=$isi[VisaSell5];
                            $ribuan="";
                        }
                        if($isi[StatusProduct]<>'FINALIZE'){
                            echo"
          <font size=2><b>MINIMUM KEBERANGKATAN 20 PESERTA DEWASA:</b></font><br>
          $ribuan
          <table><tr><th width='80' rowspan='2' style=vertical-align:middle>DEWASA TWIN SHARE</th><th colspan='3'>ANAK-ANAK (2 - 11 TAHUN)</th>
                <th width=60 rowspan='2' style=vertical-align:middle>SGL SUPP</th><th width='80' rowspan='2' style=vertical-align:middle>APO TAX INTL*</th>
                <th width='100' rowspan='2' style=vertical-align:middle>TIPPING**</th>";
                            if($isi[Embassy01]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy01]</th>";
                            }
                            if($isi[Embassy02]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy02]</th>";
                            }
                            if($isi[Embassy03]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy03]</th>";
                            }
                            if($isi[Embassy04]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy04]</th>";
                            }
                            if($isi[Embassy05]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy05]</th>";
                            }
                            echo "</tr><tr><th width=70>TWIN SHARE</th><th width=70>EXTRA BED</th><th width=70>NO BED</th>
                <tr><td><center>$isi[SellingCurr]. ".number_format($SellingAdlTwn, 0, '', ',');echo"</td></td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdTwn, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdXbed, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdNbed, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SingleSell, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($TaxInsSell, 0, '', ',');echo"</td>
                    <td><center>$tips</td>";
                            if($isi[Embassy01]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell, 0, '', ',');echo"</td>";}
                            if($isi[Embassy02]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell2, 0, '', ',');echo"</td>";}
                            if($isi[Embassy03]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell3, 0, '', ',');echo"</td>";}
                            if($isi[Embassy04]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell4, 0, '', ',');echo"</td>";}
                            if($isi[Embassy05]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell5, 0, '', ',');echo"</td>";}
                            echo "</tr>";
                            echo "</table>";
                            if($isi[DoaId01]<>'0'){
                                $qvisadoa = mysql_query("SELECT * FROM doa_product_price WHERE Id = '$isi[DoaId01]' ");
                                $dvisadoa = mysql_fetch_array($qvisadoa);
                                echo"VISA $isi[Embassy01] CATEGORY: $dvisadoa[Type] - $dvisadoa[Name] - $dvisadoa[Process] - $dvisadoa[IsAdult]";
                            }
                            echo"<font size=1>* AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** TIPPING DIBAYARKAN DI NEGARA TUJUAN<br>
                        **** HARGA TOUR BELUM TERMASUK PPN 1%<br>
                        <b>***** NILAI DALAM MATA UANG RUPIAH DIHITUNG BERDASARKAN KURS ASUMSI DAN DAPAT BERUBAH SEWAKTU-WAKTU</b>
                                        </font><br>";
                        }
                        if($isi[Insurance]=='INCLUDE'){echo"<center><img src='images/panoramasure.png'>";}echo"
          <br><center><font size=1><b>JADWAL PERJALANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font>";
                        // FORMAT SERIES
                    }else{
                        if($isi[ProductColumn]=='one'){echo"<div class='one-col'>$isi[TempatKumpul]<br><br>$detailitin<br>$map</div>";}
                        else if($isi[ProductColumn]=='two'){echo"<div class='two-col'>$isi[TempatKumpul]<br><br>$detailitin<br>$map</div><br>";}
                        $caridummy=mysql_query("SELECT * FROM tour_msproductpnr
                                    inner join tour_msprodflight on tour_msprodflight.IDGrv = tour_msproductpnr.GrvID
                                        WHERE PnrProd ='$isi[IDProduct]' AND AirDate <> '0000-00-00' ");
                        $pnrdum=mysql_num_rows($caridummy);
                        if($pnrdum>0){$order='AirDate,AirTimeDep';}else{$order='FID';}
                        $qpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                    inner join tour_msprodflight on tour_msprodflight.IDGrv = tour_msproductpnr.GrvID
                                        WHERE PnrProd ='$isi[IDProduct]' order by $order ASC");
                        $tpnr=mysql_num_rows($qpnr);
                        if($tpnr>0){
                            echo "<u><b>FLIGHT DETAILS</b></u><br><table style='border:0'>";
                            while($pnr=mysql_fetch_array($qpnr)){
                                //$fly=mysql_query("SELECT * FROM tour_msprodflight
                                //                    WHERE IDGrv ='$pnr[GrvID]' order by AirDate,AirTimeDep ASC");
                                //while($flight=mysql_fetch_array($fly)){
                                if($pnr[AirDate]=='0000-00-00' or $pnr[AirDate]=='1970-01-01'){
                                    $AD='';
                                }else{
                                    $AD = strtoupper(date('d M', strtotime($pnr[AirDate])));
                                }
                                $ATD = date('H.i', strtotime($pnr[AirTimeDep]));
                                $ATA = date('H.i', strtotime($pnr[AirTimeArr]));
                                echo"
                            <tr><td style='border:0'><font size=1>$pnr[AirCode]</td><td style='border:0'>$AD &nbsp$pnr[AirRouteDep] - $pnr[AirRouteArr] </td><td style='border:0'>$ATD - $ATA &nbsp$pnr[Note]</font></td></tr>";
                                // }
                            }echo"</table>";
                        }
                        if($isi[SellingCurr]=='IDR'){
                            $SellingAdlTwn=$isi[SellingAdlTwn]/1000;
                            $SellingChdTwn=$isi[SellingChdTwn]/1000;
                            $SellingChdXbed=$isi[SellingChdXbed]/1000;
                            $SellingChdNbed=$isi[SellingChdNbed]/1000;
                            $SingleSell=$isi[SingleSell]/1000;
                            $TaxInsSell=$isi[TaxInsSell]/1000;
                            $VisaSell=$isi[VisaSell]/1000;
                            $VisaSell2=$isi[VisaSell2]/1000;
                            $VisaSell3=$isi[VisaSell3]/1000;
                            $VisaSell4=$isi[VisaSell4]/1000;
                            $VisaSell5=$isi[VisaSell5]/1000;
                            $ribuan="<font size='1'>(HARGA DALAM RIBUAN)</font><br>";
                        }else{
                            $SellingAdlTwn=$isi[SellingAdlTwn];
                            $SellingChdTwn=$isi[SellingChdTwn];
                            $SellingChdXbed=$isi[SellingChdXbed];
                            $SellingChdNbed=$isi[SellingChdNbed];
                            $SingleSell=$isi[SingleSell];
                            $TaxInsSell=$isi[TaxInsSell];
                            $VisaSell=$isi[VisaSell];
                            $VisaSell2=$isi[VisaSell2];
                            $VisaSell3=$isi[VisaSell3];
                            $VisaSell4=$isi[VisaSell4];
                            $VisaSell5=$isi[VisaSell5];
                            $ribuan="";
                        }
                        if($isi[StatusProduct]<>'FINALIZE'){
                            echo"
          <font size=2><b>MINIMUM KEBERANGKATAN 20 PESERTA DEWASA:</b></font><br>
          $ribuan
          <table><tr><th width='80' rowspan='2' style=vertical-align:middle>DEWASA TWIN SHARE</th><th colspan='3'>ANAK-ANAK (2 - 11 TAHUN)</th>
                <th width=60 rowspan='2' style=vertical-align:middle>SGL SUPP</th><th width='80' rowspan='2' style=vertical-align:middle>APO TAX INTL*</th>
                <th width='100' rowspan='2' style=vertical-align:middle>TIPPING**</th></tr>
                <tr><th width=70>TWIN SHARE</th><th width=70>EXTRA BED</th><th width=70>NO BED</th>
                <tr><td><center>$isi[SellingCurr]. ".number_format($SellingAdlTwn, 0, '', ',');echo"</td></td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdTwn, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdXbed, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdNbed, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SingleSell, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($TaxInsSell, 0, '', ',');echo"</td>
                    <td><center>$tips</td></tr>
                </table>";
            if($isi[Embassy01]<>'0' OR $isi[Embassy02]<>'0' OR $isi[Embassy03]<>'0' OR $isi[Embassy04]<>'0' OR $isi[Embassy05]<>'0' ) {
                echo "<table><tr><th colspan='3'>VISA - $isi[Visa]</th></tr>
                        <tr><th>COUNTRY</th><th>TYPE</th><th>PRICE</th></tr>";
                if ($isi[Embassy01] <> '0') {
                    if ($isi[DoaId01] <> '0') {
                        $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                              WHERE B.Id = '$isi[DoaId01]' ");
                        $dvisadoa = mysql_fetch_array($qvisadoa);
                        $visadoa = $dvisadoa[SellingValueInRupiah] / 1000;
                        echo "<tr><td>$isi[Embassy01]</td>
                              <td>$dvisadoa[Name] - $dvisadoa[Process]</td>
                              <td><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                        echo "</td></tr>";
                    } else {
                        echo "<tr><td>$isi[Embassy01]</td>
                              <td></td>
                              <td><center>$isi[VisaCurr]. " . number_format($VisaSell, 0, '', ',');
                        echo "</td></tr>";
                    }
                }
                if ($isi[Embassy02] <> '0') {
                    if ($isi[DoaId02] <> '0') {
                        $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                              WHERE B.Id = '$isi[DoaId02]' ");
                        $dvisadoa = mysql_fetch_array($qvisadoa);
                        $visadoa = $dvisadoa[SellingValueInRupiah] / 1000;
                        echo "<tr><td>$isi[Embassy02]</td>
                              <td>$dvisadoa[Name] - $dvisadoa[Process]</td>
                              <td><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                        echo "</td></tr>";
                    } else {
                        echo "<tr><td>$isi[Embassy02]</td>
                              <td></td>
                              <td><center>$isi[VisaCurr]. " . number_format($VisaSell2, 0, '', ',');
                        echo "</td></tr>";
                    }
                }
                if ($isi[Embassy03] <> '0') {
                    if ($isi[DoaId03] <> '0') {
                        $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                              WHERE B.Id = '$isi[DoaId03]' ");
                        $dvisadoa = mysql_fetch_array($qvisadoa);
                        $visadoa = $dvisadoa[SellingValueInRupiah] / 1000;
                        echo "<tr><td>$isi[Embassy03]</td>
                              <td>$dvisadoa[Name] - $dvisadoa[Process]</td>
                              <td><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                        echo "</td></tr>";
                    } else {
                        echo "<tr><td>$isi[Embassy03]</td>
                              <td></td>
                              <td><center>$isi[VisaCurr]. " . number_format($VisaSell3, 0, '', ',');
                        echo "</td></tr>";
                    }
                }
                if ($isi[Embassy04] <> '0') {
                    if ($isi[DoaId04] <> '0') {
                        $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                              WHERE B.Id = '$isi[DoaId04]' ");
                        $dvisadoa = mysql_fetch_array($qvisadoa);
                        $visadoa = $dvisadoa[SellingValueInRupiah] / 1000;
                        echo "<tr><td>$isi[Embassy04]</td>
                              <td>$dvisadoa[Name] - $dvisadoa[Process]</td>
                              <td><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                        echo "</td></tr>";
                    } else {
                        echo "<tr><td>$isi[Embassy04]</td>
                              <td></td>
                              <td><center>$isi[VisaCurr]. " . number_format($VisaSell4, 0, '', ',');
                        echo "</td></tr>";
                    }
                }
                if ($isi[Embassy05] <> '0') {
                    if ($isi[DoaId05] <> '0') {
                        $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                              WHERE B.Id = '$isi[DoaId05]' ");
                        $dvisadoa = mysql_fetch_array($qvisadoa);
                        $visadoa = $dvisadoa[SellingValueInRupiah] / 1000;
                        echo "<tr><td>$isi[Embassy05]</td>
                              <td>$dvisadoa[Name] - $dvisadoa[Process]</td>
                              <td><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                        echo "</td></tr>";
                    } else {
                        echo "<tr><td>$isi[Embassy05]</td>
                              <td></td>
                              <td><center>$isi[VisaCurr]. " . number_format($VisaSell5, 0, '', ',');
                        echo "</td></tr>";
                    }
                }
                echo"</table>";
            }
          echo"<font size=1>* AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** TIPPING DIBAYARKAN DI NEGARA TUJUAN<br>
                        **** HARGA TOUR BELUM TERMASUK PPN 1%<br>
                        <b>***** NILAI DALAM MATA UANG RUPIAH DIHITUNG BERDASARKAN KURS ASUMSI DAN DAPAT BERUBAH SEWAKTU-WAKTU</b>
                                        </font><br>";
                        }
                        if($isi[Insurance]=='INCLUDE'){echo"<center><img src='images/panoramasure.png'>";}echo"
          <br><center><font size=1><b>JADWAL PERJALANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font>";
                    }
                    echo "</td></tr></table>
         <iframe src='printitin.php?id=$isi[IDProduct]' name='tbfprint' style='visibility: hidden' height='0' width='0' frameborder='0'>
          </iframe>
          <iframe src='printitinemb.php?id=$isi[IDProduct]' name='embprint' style='visibility: hidden' height='0' width='0' frameborder='0'>
          </iframe>
          <input type='button' value='PRINT' onClick=frames['tbfprint'].print() >";
                    if($team=='DEVELOPER' or $team=='PO' OR $team=='PO MANAGER'){
                        echo" <input type='button' value='PRINT for EMBASSY' onClick=frames['embprint'].print() >";
                    }echo"
          <input type=button value='Back' onclick=self.history.back()>
          <a href='printpdfitin.php?id=$isi[IDProduct]' target='_blank'><img src='../admin/images/pdf.png' /></a>
          ";
                    /*}else if($cek3>0){
                        $pilihpdf=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$IDProduct'");
                        $isipdf=mysql_fetch_array($pilihpdf);
                        echo"
                        <table><tr><td>File Itinerary PDF</td><td>";
                        $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isipdf[AttachmentFile]) ) ) );
                        echo"Itinerary: <a href='$isipdf[Attachment]$file' target='_blank' style=text-decoration:none >$isipdf[AttachmentFile]</a></td></tr></table><br><br>
                        <center><input type=button value='Back' onclick=self.history.back()>";
                    */
                }
                //STYLE TEZ
                else{
                    $ambil=mysql_query("SELECT tour_msproduct.*, tour_msairlines.*,
                    tour_msproductcode.* FROM tour_msproduct
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode
                    left join tour_msairlines on tour_msproduct.Flight = tour_msairlines.AirlinesID
                    WHERE tour_msproduct.IDProduct ='$IDProduct'");
                    $isi=mysql_fetch_array($ambil);
                    $prodpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                left join tour_msgrv on tour_msgrv.IDGrv = tour_msproductpnr.GrvID
                                left join tour_msairlines on tour_msairlines.AirlinesID = tour_msgrv.GrvAirlines
                                WHERE PnrProd = '$isi[IDProduct]'");

                    $cb=0;
                    while($pnr=mysql_fetch_array($prodpnr)){
                        $airlines1=$pnr[AirlinesName];
                        if($cb==0){
                            $air="$airlines1";
                        }else{
                            $air=" & $airlines1";
                        }
                        $Airlines=$Airlines.$air;
                        $cb++;
                    }

                    $depdet = strtoupper(date("d M Y", strtotime($isi[DateTravelFrom])));
                    if($isi[ProductTippingCurr]==''){$tipscurr=$isi[SellingCurr];}else{$tipscurr=$isi[ProductTippingCurr];}
                    if($isi[ProductTippingStatus]=='include'){$tips='INCLUDE';}else{$tips=$isi[ProductTipping];}//{$tips="$tipscurr.$isi[ProductTipping]";}
                    if($isi[GroupType]=='CRUISE'){$logo='images/PTICruise.png';}
                    else if($isi[Department]=='TUR EZ'){$logo='images/PTITUREZ.png';}
                    else {$logo='images/PTIExperience.png';}
                    if($isi[ProductBonus]==''){$bns='';$bns1='';}else{$bns="<font size=2><b>$isi[ProductBonus]</b></font><br>";$bns1="<font size=2><b>BONUS: $isi[ProductBonus]</b></font></td>";}
                    if($isi[HighlightCountry]==''){$highlight='';}else{$highlight="HIGHLIGHT: $isi[HighlightCountry]";}
                    //table utama
                    echo "  <center><table style='border:0' >
                <tr><td style='border:0' align='right' width='120px'><center><img src='$logo'></center></td>
                <td style='border:0' width='630'>
                <font size=5><b>$isi[DaysTravel]D $isi[Productcode]</b></font><br>
                <font size=2 style='background-color: #ffff00'>$highlight</font><br>
                <font size=2>By &nbsp&nbsp&nbsp: $isi[AirlinesName] ($isi[AirlinesID]) </font><br>
                <font size=2>Dep &nbsp: $depdet </font><br>
                <font size=2>Code : $isi[TourCode]</font><br>
                $bns1
                </tr>
                <tr><td colspan=2 width='750px' height='842px' align='justify' style='border:0'>";

                    $tblitin=mysql_query("SELECT *,CONVERT(Days, UNSIGNED INTEGER) as urut FROM tour_msitin
                                WHERE ProductID ='$isi[IDProduct]' and Language = '$lang' and Style = '$style' order by urut");
                    $day=0;
                    $mapfile= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isi[MapFile]) ) ) );
                    if($isi[MapFile]<>''){$map="<img src='$isi[MapFolder]$mapfile' width='330px' height='330px'>";}else{$map='';}
                    echo"<table class='bordered'>
                     <tr><th width='60px'>HARI</th><th width='540px'>JADWAL PERJALANAN</th><th width='50px'>MP</th><th width='50px'>MS</th><th width='50px'>MM</th><tr>";
                    while($itin=mysql_fetch_array($tblitin)){
                        if(strlen($itin[Days])==1){$hari="0$itin[Days]";}else{$hari="$itin[Days]";}

                        if($itin[ObjectTrans01]=='PLANE'){$trans01="<img src='../images/plane.png' width='10' height='10'>";}
                        else if($itin[ObjectTrans01]=='TRAIN'){$trans01="<img src='../images/train.png' width='20' height='10'>";}
                        else if($itin[ObjectTrans01]=='BUS'){$trans01="<img src='../images/bus.png' width='20' height='10'>";}
                        else if($itin[ObjectTrans01]=='FERRY'){$trans01="<img src='../images/ferry.png' width='20' height='10'>";}
                        else {$trans01="";}
                        if($itin[ObjectTrans02]=='PLANE'){$trans02="<img src='../images/plane.png' width='10' height='10'>";}
                        else if($itin[ObjectTrans02]=='TRAIN'){$trans02="<img src='../images/train.png' width='20' height='10'>";}
                        else if($itin[ObjectTrans02]=='BUS'){$trans02="<img src='../images/bus.png' width='20' height='10'>";}
                        else if($itin[ObjectTrans02]=='FERRY'){$trans02="<img src='../images/ferry.png' width='20' height='10'>";}
                        else {$trans02="";}
                        if($itin[ObjectTrans03]=='PLANE'){$trans03="<img src='../images/plane.png' width='10' height='10'>";}
                        else if($itin[ObjectTrans03]=='TRAIN'){$trans03="<img src='../images/train.png' width='20' height='10'>";}
                        else if($itin[ObjectTrans03]=='BUS'){$trans03="<img src='../images/bus.png' width='20' height='10'>";}
                        else if($itin[ObjectTrans03]=='FERRY'){$trans03="<img src='../images/ferry.png' width='20' height='10'>";}
                        else {$trans03="";}
                        if($itin[ObjectTrans04]=='PLANE'){$trans04="<img src='../images/plane.png' width='10' height='10'>";}
                        else if($itin[ObjectTrans04]=='TRAIN'){$trans04="<img src='../images/train.png' width='20' height='10'>";}
                        else if($itin[ObjectTrans04]=='BUS'){$trans04="<img src='../images/bus.png' width='20' height='10'>";}
                        else if($itin[ObjectTrans04]=='FERRY'){$trans04="<img src='../images/ferry.png' width='20' height='10'>";}
                        else {$trans04="";}
                        $dateday = $isi[DateTravelFrom];
                        $tanggalday = substr($dateday,8,2);
                        $bulanday = substr($dateday,5,2);
                        $tahunday = substr($dateday,0,4);
                        if($itin[BreakfastType]=='NO MEALS'){$breakfasttype="<img src='../images/nomeals.png'>";}else{$breakfasttype=$itin[BreakfastType];}
                        if($itin[LunchType]=='NO MEALS'){$lunchtype="<img src='../images/nomeals.png'>";}else{$lunchtype=$itin[LunchType];}
                        if($itin[DinnerType]=='NO MEALS'){$dinnertype="<img src='../images/nomeals.png'>";}else{$dinnertype=$itin[DinnerType];}

                        //$detail= $itin[Detail] ;
                        if($day==0){
                            $oneday= strtoupper(date('d M',strtotime('0 second',strtotime($day.' day',strtotime(date($bulanday).'/'.date($tanggalday).'/'.date($tahunday).' 00:00:00')))));
                            echo"<tr><td style='vertical-align:middle;text-align:center'><b>HARI $hari/$oneday</b></td>
                             <td><b>";
                            if($itin[Object01]<>''){echo"$itin[Object01] ";}
                            if($trans01<>''){echo"$trans01 ";}
                            if($itin[Object02]<>''){echo"$itin[Object02] ";}
                            if($trans02<>''){echo"$trans02 ";}
                            if($itin[Object03]<>''){echo"$itin[Object03] ";}
                            if($trans03<>''){echo"$trans03 ";}
                            if($itin[Object04]<>''){echo"$itin[Object04] ";}
                            if($trans04<>''){echo"$trans04 ";}
                            if($itin[Object05]<>''){echo"$itin[Object05] ";}
                            echo"</b>";
                            if($itin[Mengunjungi]<>''){echo"<br><b>Mengunjungi: </b> $itin[Mengunjungi]";}
                            if($itin[Mengunjungi2]<>''){echo", $itin[Mengunjungi2]";}if($itin[Mengunjungi3]<>''){echo", $itin[Mengunjungi3]";}
                            if($itin[Mengunjungi4]<>''){echo", $itin[Mengunjungi4]";}if($itin[Mengunjungi5]<>''){echo", $itin[Mengunjungi5]";}
                            if($itin[Mengunjungi6]<>''){echo", $itin[Mengunjungi6]";}if($itin[Mengunjungi7]<>''){echo", $itin[Mengunjungi7]";}
                            if($itin[Mengunjungi8]<>''){echo", $itin[Mengunjungi8]";}
                            if($itin[Melewati]<>''){echo"<br><b>Melewati: </b> $itin[Melewati]";}
                            if($itin[Melewati2]<>''){echo", $itin[Melewati2]";}if($itin[Melewati3]<>''){echo", $itin[Melewati3]";}
                            if($itin[Melewati4]<>''){echo", $itin[Melewati4]";}if($itin[Melewati5]<>''){echo", $itin[Melewati5]";}
                            if($itin[Melewati6]<>''){echo", $itin[Melewati6]";}if($itin[Melewati7]<>''){echo", $itin[Melewati7]";}
                            if($itin[Melewati8]<>''){echo", $itin[Melewati8]";}
                            if($itin[Shopping]<>''){echo"<br><b>Shopping: </b> $itin[Shopping]";}
                            if($itin[Shopping2]<>''){echo", $itin[Shopping2]";}if($itin[Shopping3]<>''){echo", $itin[Shopping3]";}
                            if($itin[Shopping4]<>''){echo", $itin[Shopping4]";}if($itin[Shopping5]<>''){echo", $itin[Shopping5]";}
                            if($itin[Shopping6]<>''){echo", $itin[Shopping6]";}if($itin[Shopping7]<>''){echo", $itin[Shopping7]";}
                            if($itin[Shopping8]<>''){echo", $itin[Shopping8]";}
                            if($itin[Photostop]<>''){echo"<br><b>Photostop: </b> $itin[Photostop]";}
                            if($itin[Photostop2]<>''){echo", $itin[Photostop2]";}if($itin[Photostop3]<>''){echo", $itin[Photostop3]";}
                            if($itin[Photostop4]<>''){echo", $itin[Photostop4]";}if($itin[Photostop5]<>''){echo", $itin[Photostop5]";}
                            if($itin[Photostop6]<>''){echo", $itin[Photostop6]";}if($itin[Photostop7]<>''){echo", $itin[Photostop7]";}
                            if($itin[Photostop8]<>''){echo", $itin[Photostop8]";}
                            if($itin[ItinInfo]<>''){echo"<br><font style='background-color: yellow'>$itin[ItinInfo]</font>";}
                            if($itin[HotelID]<>'0'){
                                $Qhot=mysql_query("SELECT * FROM tour_mshotel
                                           WHERE IDHotel='$itin[HotelID]'");
                                $hot=mysql_fetch_array($Qhot);
                                $htlname1=strtolower($hot[HotelName]);
                                $htlname=ucwords($htlname1);
                                echo"<br><b>Hotel: </b>$htlname/Setaraf</b>";}
                            echo"</td>
                        <td style='vertical-align:middle'><center>$breakfasttype</center></td>
                        <td style='vertical-align:middle'><center>$lunchtype</center></td>
                        <td style='vertical-align:middle'><center>$dinnertype</center></td></tr>";
                        }else{
                            $oneday= strtoupper(date('d M',strtotime('0 second',strtotime($day.' day',strtotime(date($bulanday).'/'.date($tanggalday).'/'.date($tahunday).' 00:00:00')))));
                            echo"<tr><td style='vertical-align:middle;text-align:center'><b>HARI $hari/$oneday</b></td>
                             <td><b>";
                            if($itin[Object01]<>''){echo"$itin[Object01] ";}
                            if($trans01<>''){echo"$trans01 ";}
                            if($itin[Object02]<>''){echo"$itin[Object02] ";}
                            if($trans02<>''){echo"$trans02 ";}
                            if($itin[Object03]<>''){echo"$itin[Object03] ";}
                            if($trans03<>''){echo"$trans03 ";}
                            if($itin[Object04]<>''){echo"$itin[Object04] ";}
                            if($trans04<>''){echo"$trans04 ";}
                            if($itin[Object05]<>''){echo"$itin[Object05] ";}
                            echo"</b>";
                            if($itin[Mengunjungi]<>''){echo"<br><b>Mengunjungi: </b> $itin[Mengunjungi]";}
                            if($itin[Mengunjungi2]<>''){echo", $itin[Mengunjungi2]";}if($itin[Mengunjungi3]<>''){echo", $itin[Mengunjungi3]";}
                            if($itin[Mengunjungi4]<>''){echo", $itin[Mengunjungi4]";}if($itin[Mengunjungi5]<>''){echo", $itin[Mengunjungi5]";}
                            if($itin[Mengunjungi6]<>''){echo", $itin[Mengunjungi6]";}if($itin[Mengunjungi7]<>''){echo", $itin[Mengunjungi7]";}
                            if($itin[Mengunjungi8]<>''){echo", $itin[Mengunjungi8]";}
                            if($itin[Melewati]<>''){echo"<br><b>Melewati: </b> $itin[Melewati]";}
                            if($itin[Melewati2]<>''){echo", $itin[Melewati2]";}if($itin[Melewati3]<>''){echo", $itin[Melewati3]";}
                            if($itin[Melewati4]<>''){echo", $itin[Melewati4]";}if($itin[Melewati5]<>''){echo", $itin[Melewati5]";}
                            if($itin[Melewati6]<>''){echo", $itin[Melewati6]";}if($itin[Melewati7]<>''){echo", $itin[Melewati7]";}
                            if($itin[Melewati8]<>''){echo", $itin[Melewati8]";}
                            if($itin[Shopping]<>''){echo"<br><b>Shopping: </b> $itin[Shopping]";}
                            if($itin[Shopping2]<>''){echo", $itin[Shopping2]";}if($itin[Shopping3]<>''){echo", $itin[Shopping3]";}
                            if($itin[Shopping4]<>''){echo", $itin[Shopping4]";}if($itin[Shopping5]<>''){echo", $itin[Shopping5]";}
                            if($itin[Shopping6]<>''){echo", $itin[Shopping6]";}if($itin[Shopping7]<>''){echo", $itin[Shopping7]";}
                            if($itin[Shopping8]<>''){echo", $itin[Shopping8]";}
                            if($itin[Photostop]<>''){echo"<br><b>Photostop: </b> $itin[Photostop]";}
                            if($itin[Photostop2]<>''){echo", $itin[Photostop2]";}if($itin[Photostop3]<>''){echo", $itin[Photostop3]";}
                            if($itin[Photostop4]<>''){echo", $itin[Photostop4]";}if($itin[Photostop5]<>''){echo", $itin[Photostop5]";}
                            if($itin[Photostop6]<>''){echo", $itin[Photostop6]";}if($itin[Photostop7]<>''){echo", $itin[Photostop7]";}
                            if($itin[Photostop8]<>''){echo", $itin[Photostop8]";}
                            if($itin[ItinInfo]<>''){echo"<br><font style='background-color: yellow'>$itin[ItinInfo]</font>";}
                            if($itin[HotelID]<>'0'){
                                $Qhot=mysql_query("SELECT * FROM tour_mshotel
                                           WHERE IDHotel='$itin[HotelID]'");
                                $hot=mysql_fetch_array($Qhot);
                                $htlname1=strtolower($hot[HotelName]);
                                $htlname=ucwords($htlname1);
                                echo"<br><b>Hotel: </b>$htlname/Setaraf</b>";}
                            echo"</td>
                        <td style='vertical-align:middle'><center>$breakfasttype</center></td>
                        <td style='vertical-align:middle'><center>$lunchtype</center></td>
                        <td style='vertical-align:middle'><center>$dinnertype</center></td></tr>";
                        }
                        $detailitin=$detailitin.$itin;
                        $day++;
                    }
                    echo"</table>";
                    //FORMAT CRUISE
                    if($isi[GroupType]=='CRUISE'){
                        $qpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                        WHERE PnrProd ='$isi[IDProduct]'");
                        $tpnr=mysql_num_rows($qpnr);
                        if($tpnr>0){
                            echo "<u><b>FLIGHT DETAILS</b></u><br><table style='border:0'>";
                            while($pnr=mysql_fetch_array($qpnr)){
                                $fly=mysql_query("SELECT * FROM tour_msprodflight
                                            WHERE IDGrv ='$pnr[GrvID]' order by FID ASC");
                                while($flight=mysql_fetch_array($fly)){
                                    if($flight[AirDate]=='0000-00-00' or $flight[AirDate]=='1970-01-01'){
                                        $AD='';
                                    }else{
                                        $AD = strtoupper(date('d M', strtotime($flight[AirDate])));
                                    }
                                    $ATD = date('H.i', strtotime($flight[AirTimeDep]));
                                    $ATA = date('H.i', strtotime($flight[AirTimeArr]));
                                    echo"
                            <tr><td style='border:0'><font size=1>$flight[AirCode]</td><td style='border:0'>$AD &nbsp$flight[AirRouteDep] - $flight[AirRouteArr] </td><td style='border:0'>$ATD - $ATA &nbsp$flight[Note]</font></td></tr>";
                                }
                            }echo"</table>";
                        }
                        if($isi[SellingCurr]=='IDR'){
                            $cruiseadl12=$isi[CruiseAdl12]/1000;
                            $cruiseadl34=$isi[CruiseAdl34]/1000;
                            $cruisechd12=$isi[CruiseChd12]/1000;
                            $cruisechd34=$isi[CruiseChd34]/1000;
                            $singlesell=$isi[SingleSell]/1000;
                            $seataxsell=$isi[SeaTaxSell]/1000;
                            $taxinssell=$isi[TaxInsSell]/1000;
                            $VisaSell=$isi[VisaSell]/1000;
                            $VisaSell2=$isi[VisaSell2]/1000;
                            $VisaSell3=$isi[VisaSell3]/1000;
                            $VisaSell4=$isi[VisaSell4]/1000;
                            $VisaSell5=$isi[VisaSell5]/1000;
                            $ribuan="<font size='1'>(HARGA DALAM RIBUAN)</font><br>";
                        }else{
                            $cruiseadl12=$isi[CruiseAdl12];
                            $cruiseadl34=$isi[CruiseAdl34];
                            $cruisechd12=$isi[CruiseChd12];
                            $cruisechd34=$isi[CruiseChd34];
                            $singlesell=$isi[SingleSell];
                            $seataxsell=$isi[SeaTaxSell];
                            $taxinssell=$isi[TaxInsSell];
                            $VisaSell=$isi[VisaSell];
                            $VisaSell2=$isi[VisaSell2];
                            $VisaSell3=$isi[VisaSell3];
                            $VisaSell4=$isi[VisaSell4];
                            $VisaSell5=$isi[VisaSell5];
                            $ribuan="";
                        }
                        if($isi[StatusProduct]<>'FINALIZE'){
                            echo"</div><br>";
                            echo"<font size='1'>HARGA TOUR DALAM IDR (RIBUAN)<br>

          <table class='bordered'><tr><th width='80' colspan='2' style=vertical-align:middle>DEWASA</th><th colspan='2'>ANAK-ANAK</th>
                <th width=60 rowspan='2' style=vertical-align:middle>SGL SUPP</th>
                <th width=60 rowspan='2' style=vertical-align:middle>SEAPORT TAX DEPT TAX GRATUITIES</th>
                <th width='80' rowspan='2' style=vertical-align:middle>APO TAX INTL*</th>
                <th width='100' rowspan='2' style=vertical-align:middle>TIPPING**</th>";
                            if($isi[Embassy01]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy01]</th>";
                            }
                            if($isi[Embassy02]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy02]</th>";
                            }
                            if($isi[Embassy03]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy03]</th>";
                            }
                            if($isi[Embassy04]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy04]</th>";
                            }
                            if($isi[Embassy05]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy05]</th>";
                            }
                            echo "</tr><tr><th width=70>1st & 2nd Person</th><th width=70>3rd & 4th Person</th><th width=70>1st & 2nd Person</th><th width=70>3rd & 4th Person</th>
                    <tr><td><center>$isi[SellingCurr]. ".number_format($cruiseadl12, 0, '', ',');echo"</td></td>
                    <td><center>$isi[SellingCurr]. ".number_format($cruiseadl34, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($cruisechd12, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($cruisechd34, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($singlesell, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($seataxsell, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($taxinssell, 0, '', ',');echo"</td>
                    <td><center>$tips</td>";
                            if($isi[Embassy01]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell, 0, '', ',');echo"</td>";}
                            if($isi[Embassy02]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell2, 0, '', ',');echo"</td>";}
                            if($isi[Embassy03]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell3, 0, '', ',');echo"</td>";}
                            if($isi[Embassy04]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell4, 0, '', ',');echo"</td>";}
                            if($isi[Embassy05]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell5, 0, '', ',');echo"</td>";}
                            echo "</tr>";

                            echo "</table>
          <font size=1>* AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** TIPPING DIBAYARKAN DI NEGARA TUJUAN<br>
                        **** HARGA TOUR BELUM TERMASUK PPN 1%<br>
                        <b>***** NILAI DALAM MATA UANG RUPIAH DIHITUNG BERDASARKAN KURS ASUMSI DAN DAPAT BERUBAH SEWAKTU-WAKTU</b>
                                        </font><br>";
                        }
                        if($isi[Insurance]=='INCLUDE'){echo"<center><img src='images/panoramasure.png'>";}echo"
          <br><center><font size=1><b>JADWAL PERJALANAN/JENIS MAKANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font></center><br>
                                        $map<br>
                        <table style='border:0px'>
                        <tr><td style='border:0px' colspan='2'><b><u>PERKIRAAN CUACA</b></u></td></tr>
                        <tr><td style='border:0px' colspan='2'>$isi[CuacaItin]<br>
                        Cuaca diatas adalah Perkiraan, jika ingin update silahkan klik http://www.accuweather.com</td></tr>
                        <tr><td style='border:0px' colspan='2'><b><u>HOTEL YANG AKAN DI GUNAKAN</b></u></td></tr>";
                        $Qhot=mysql_query("SELECT * FROM tour_msitinhotel
                                           inner join tour_mshotel on tour_mshotel.IDHotel = tour_msitinhotel.HotelID
                                           WHERE ProductID='$isi[IDProduct]'");
                        while($hot=mysql_fetch_array($Qhot)){
                            if($hot[Website]<>''){$web="($hot[Website])";}else{$web="";}
                            echo"<tr><td style='border:0px'>$hot[City]</td><td style='border:0px'>: $hot[HotelName] $web atau Setaraf</td></tr>";
                        }
                        echo"</table><center>";
                        // FORMAT SERIES
                    }
                    else if($isi[GroupType]=='TUR EZ'){

                        $qpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                        WHERE PnrProd ='$isi[IDProduct]'");
                        $tpnr=mysql_num_rows($qpnr);
                        if($tpnr>0){
                            echo "<u><b>FLIGHT DETAILS</b></u><br><table style='border:0'>";
                            while($pnr=mysql_fetch_array($qpnr)){
                                $fly=mysql_query("SELECT * FROM tour_msprodflight
                                            WHERE IDGrv ='$pnr[GrvID]' order by FID ASC");
                                while($flight=mysql_fetch_array($fly)){
                                    if($flight[AirDate]=='0000-00-00' or $flight[AirDate]=='1970-01-01'){
                                        $AD='';
                                    }else{
                                        $AD = strtoupper(date('d M', strtotime($flight[AirDate])));
                                    }
                                    $ATD = date('H.i', strtotime($flight[AirTimeDep]));
                                    $ATA = date('H.i', strtotime($flight[AirTimeArr]));
                                    echo"
                            <tr><td style='border:0'><font size=1>$flight[AirCode]</td><td style='border:0'>$AD &nbsp$flight[AirRouteDep] - $flight[AirRouteArr] </td><td style='border:0'>$ATD - $ATA &nbsp$flight[Note]</font></td></tr>";
                                }
                            }echo"</table>";
                        }
                        if($isi[SellingCurr]=='IDR'){
                            $SellingAdlTwn=$isi[SellingAdlTwn]/1000;
                            $SellingChdTwn=$isi[SellingChdTwn]/1000;
                            $SellingChdXbed=$isi[SellingChdXbed]/1000;
                            $SellingChdNbed=$isi[SellingChdNbed]/1000;
                            $SingleSell=$isi[SingleSell]/1000;
                            $TaxInsSell=$isi[TaxInsSell]/1000;
                            $VisaSell=$isi[VisaSell]/1000;
                            $VisaSell2=$isi[VisaSell2]/1000;
                            $VisaSell3=$isi[VisaSell3]/1000;
                            $VisaSell4=$isi[VisaSell4]/1000;
                            $VisaSell5=$isi[VisaSell5]/1000;
                            $ribuan="<font size='1'>(HARGA DALAM RIBUAN)</font><br>";
                        }else{
                            $SellingAdlTwn=$isi[SellingAdlTwn];
                            $SellingChdTwn=$isi[SellingChdTwn];
                            $SellingChdXbed=$isi[SellingChdXbed];
                            $SellingChdNbed=$isi[SellingChdNbed];
                            $SingleSell=$isi[SingleSell];
                            $TaxInsSell=$isi[TaxInsSell];
                            $VisaSell=$isi[VisaSell];
                            $VisaSell2=$isi[VisaSell2];
                            $VisaSell3=$isi[VisaSell3];
                            $VisaSell4=$isi[VisaSell4];
                            $VisaSell5=$isi[VisaSell5];
                            $ribuan="";
                        }
                        if($isi[StatusProduct]<>'FINALIZE'){
                            echo"
          <font size='1'>HARGA TOUR DALAM IDR (RIBUAN)/MINIMUM</font><font size='2'><b> 25 </b></font><font size='1'>PESERTA DEWASA</font><br>

          <table class='bordered'><tr><th width='80' rowspan='2' style=vertical-align:middle>DEWASA TWIN SHARE</th><th colspan='3'>ANAK-ANAK (02 - 11 TAHUN)</th>
                <th width=60 rowspan='2' style=vertical-align:middle>SGL SUPP</th><th width='80' rowspan='2' style=vertical-align:middle>APO TAX INTL*</th>
                <th width='100' rowspan='2' style=vertical-align:middle>TIPPING**</th>";
                            if($isi[Embassy01]<>'0') {
                                echo "<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy01]</th>";
                            }
                            if($isi[Embassy02]<>'0') {
                                echo "<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy02]</th>";
                            }
                            if($isi[Embassy03]<>'0') {
                                echo "<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy03]</th>";
                            }
                            if($isi[Embassy04]<>'0') {
                                echo "<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy04]</th>";
                            }
                            if($isi[Embassy05]<>'0') {
                                echo "<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy05]</th>";
                            }
                            echo "</tr><tr><th width=70>TWIN SHARE</th><th width=70>EXTRA BED</th><th width=70>NO BED</th>
                <tr><td><center>$isi[SellingCurr]. ".number_format($SellingAdlTwn, 0, '', ',');echo"</td></td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdTwn, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdXbed, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdNbed, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SingleSell, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($TaxInsSell, 0, '', ',');echo"</td>
                    <td><center>$tips</td>";
                            if($isi[Embassy01]<>'0') {
                                if($isi[DoaId01]<>'0'){
                                    $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                                              WHERE B.Id = '$isi[DoaId01]' ");
                                    $dvisadoa = mysql_fetch_array($qvisadoa);
                                    $typevisa1="# VISA $isi[Embassy01] TYPE: $dvisadoa[Type] - $dvisadoa[Name] - $dvisadoa[Process] - $dvisadoa[IsAdult]<br>";
                                    $visadoa = $dvisadoa[SellingValueInRupiah]/1000;
                                } else {
                                    $typevisa1="";
                                    $visadoa = $VisaSell;
                                }
                                echo "<td><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                                echo "</td>";
                            }
                            if($isi[Embassy02]<>'0') {
                                if($isi[DoaId02]<>'0'){
                                    $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                                              WHERE B.Id = '$isi[DoaId02]' ");
                                    $dvisadoa = mysql_fetch_array($qvisadoa);
                                    $typevisa2="# VISA $isi[Embassy02] TYPE: $dvisadoa[Type] - $dvisadoa[Name] - $dvisadoa[Process] - $dvisadoa[IsAdult]<br>";
                                    $visadoa = $dvisadoa[SellingValueInRupiah]/1000;
                                } else {
                                    $typevisa2="";
                                    $visadoa = $VisaSell2;
                                }
                                echo "<td><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                                echo "</td>";
                            }
                            if($isi[Embassy03]<>'0') {
                                if($isi[DoaId03]<>'0'){
                                    $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                                              WHERE B.Id = '$isi[DoaId03]' ");
                                    $dvisadoa = mysql_fetch_array($qvisadoa);
                                    $typevisa3="# VISA $isi[Embassy03] TYPE: $dvisadoa[Type] - $dvisadoa[Name] - $dvisadoa[Process] - $dvisadoa[IsAdult]<br>";
                                    $visadoa = $dvisadoa[SellingValueInRupiah]/1000;
                                } else {
                                    $typevisa3="";
                                    $visadoa = $VisaSell3;
                                }
                                echo "<td><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                                echo "</td>";
                            }
                            if($isi[Embassy04]<>'0') {
                                if($isi[DoaId04]<>'0'){
                                    $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                                              WHERE B.Id = '$isi[DoaId04]' ");
                                    $dvisadoa = mysql_fetch_array($qvisadoa);
                                    $typevisa4="# VISA $isi[Embassy04] TYPE: $dvisadoa[Type] - $dvisadoa[Name] - $dvisadoa[Process] - $dvisadoa[IsAdult]<br>";
                                    $visadoa = $dvisadoa[SellingValueInRupiah]/1000;
                                } else {
                                    $typevisa4="";
                                    $visadoa = $VisaSell4;
                                }
                                echo "<td><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                                echo "</td>";
                            }
                            if($isi[Embassy05]<>'0') {
                                if($isi[DoaId05]<>'0'){
                                    $qvisadoa = mysql_query("SELECT B.*,C.Name FROM doa_product_price B
                                                              INNER JOIN doa_product_price_category C on C.Id = B.DoaProductPriceCategoryId
                                                              WHERE B.Id = '$isi[DoaId05]' ");
                                    $dvisadoa = mysql_fetch_array($qvisadoa);
                                    $typevisa5="# VISA $isi[Embassy05] TYPE: $dvisadoa[Type] - $dvisadoa[Name] - $dvisadoa[Process] - $dvisadoa[IsAdult]<br>";
                                    $visadoa = $dvisadoa[SellingValueInRupiah]/1000;
                                } else {
                                    $typevisa5="";
                                    $visadoa = $VisaSell5;
                                }
                                echo "<td><center>$isi[VisaCurr]. " . number_format($visadoa, 0, '', ',');
                                echo "</td>";
                            }
                            echo "</tr></table><font size=1>
                        * AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** TIPPING DIBAYARKAN DI NEGARA TUJUAN<br>
                        **** HARGA TOUR BELUM TERMASUK PPN 1%<br>
                        <b>***** NILAI DALAM MATA UANG RUPIAH DIHITUNG BERDASARKAN KURS ASUMSI DAN DAPAT BERUBAH SEWAKTU-WAKTU</b>
                                        </font><br>";
                        }
                        if($isi[Insurance]=='INCLUDE'){echo"<center><img src='images/panoramasure.png'>";}echo"
          <br><center><font size=1><b>JADWAL PERJALANAN/JENIS MAKANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font></center><br>
                                        $map<br>
                        <table style='border:0px'>
                        <tr><td style='border:0px' colspan='2'><b><u>PERKIRAAN CUACA</b></u></td></tr>
                        <tr><td style='border:0px' colspan='2'>$isi[CuacaItin]<br>
                        Cuaca diatas adalah Perkiraan, jika ingin update silahkan klik http://www.accuweather.com</td></tr>";
                        /*<tr><td style='border:0px' colspan='2'><b><u>HOTEL YANG AKAN DI GUNAKAN</b></u></td></tr>";
                        $Qhot=mysql_query("SELECT * FROM tour_msitinhotel
                                           inner join tour_mshotel on tour_mshotel.IDHotel = tour_msitinhotel.HotelID
                                           WHERE ProductID='$isi[IDProduct]'");
                        while($hot=mysql_fetch_array($Qhot)){
                            if($hot[Website]<>''){$web="($hot[Website])";}else{$web="";}
                            echo"<tr><td style='border:0px'>$hot[City]</td><td style='border:0px'>: $hot[HotelName] $web atau Setaraf</td></tr>";
                        }*/
                        echo"</table><center>";
                        // FORMAT SERIES
                    }
                    else{
                        $qpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                        WHERE PnrProd ='$isi[IDProduct]'");
                        $tpnr=mysql_num_rows($qpnr);
                        if($tpnr>0){
                            echo "<u><b>FLIGHT DETAILS</b></u><br><table style='border:0'>";
                            while($pnr=mysql_fetch_array($qpnr)){
                                $fly=mysql_query("SELECT * FROM tour_msprodflight
                                            WHERE IDGrv ='$pnr[GrvID]' order by FID ASC");
                                while($flight=mysql_fetch_array($fly)){
                                    if($flight[AirDate]=='0000-00-00' or $flight[AirDate]=='1970-01-01'){
                                        $AD='';
                                    }else{
                                        $AD = strtoupper(date('d M', strtotime($flight[AirDate])));
                                    }
                                    $ATD = date('H.i', strtotime($flight[AirTimeDep]));
                                    $ATA = date('H.i', strtotime($flight[AirTimeArr]));
                                    echo"
                            <tr><td style='border:0'><font size=1>$flight[AirCode]</td><td style='border:0'>$AD &nbsp$flight[AirRouteDep] - $flight[AirRouteArr] </td><td style='border:0'>$ATD - $ATA &nbsp$flight[Note]</font></td></tr>";
                                }
                            }echo"</table>";
                        }
                        if($isi[SellingCurr]=='IDR'){
                            $SellingAdlTwn=$isi[SellingAdlTwn]/1000;
                            $SellingChdTwn=$isi[SellingChdTwn]/1000;
                            $SellingChdXbed=$isi[SellingChdXbed]/1000;
                            $SellingChdNbed=$isi[SellingChdNbed]/1000;
                            $SingleSell=$isi[SingleSell]/1000;
                            $TaxInsSell=$isi[TaxInsSell]/1000;
                            $VisaSell=$isi[VisaSell]/1000;
                            $VisaSell2=$isi[VisaSell2]/1000;
                            $VisaSell3=$isi[VisaSell3]/1000;
                            $VisaSell4=$isi[VisaSell4]/1000;
                            $VisaSell5=$isi[VisaSell5]/1000;
                            $ribuan="<font size='1'>(HARGA DALAM RIBUAN)</font><br>";
                        }else{
                            $SellingAdlTwn=$isi[SellingAdlTwn];
                            $SellingChdTwn=$isi[SellingChdTwn];
                            $SellingChdXbed=$isi[SellingChdXbed];
                            $SellingChdNbed=$isi[SellingChdNbed];
                            $SingleSell=$isi[SingleSell];
                            $TaxInsSell=$isi[TaxInsSell];
                            $VisaSell=$isi[VisaSell];
                            $VisaSell2=$isi[VisaSell2];
                            $VisaSell3=$isi[VisaSell3];
                            $VisaSell4=$isi[VisaSell4];
                            $VisaSell5=$isi[VisaSell5];
                            $ribuan="";
                        }
                        if($isi[StatusProduct]<>'FINALIZE'){
                            echo"
          <font size='1'>HARGA TOUR DALAM IDR (RIBUAN)/MINIMUM</font><font size='2'><b> 25 </b></font><font size='1'>PESERTA DEWASA</font><br>

          <table class='bordered'><tr><th width='80' rowspan='2' style=vertical-align:middle>DEWASA TWIN SHARE</th><th colspan='3'>ANAK-ANAK (02 - 11 TAHUN)</th>
                <th width=60 rowspan='2' style=vertical-align:middle>SGL SUPP</th><th width='80' rowspan='2' style=vertical-align:middle>APO TAX INTL*</th>
                <th width='100' rowspan='2' style=vertical-align:middle>TIPPING**</th>";
                            if($isi[Embassy01]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy01]</th>";
                            }
                            if($isi[Embassy02]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy02]</th>";
                            }
                            if($isi[Embassy03]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy03]</th>";
                            }
                            if($isi[Embassy04]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy04]</th>";
                            }
                            if($isi[Embassy05]<>'0')
                            {echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $isi[Embassy05]</th>";
                            }
                            echo "</tr><tr><th width=70>TWIN SHARE</th><th width=70>EXTRA BED</th><th width=70>NO BED</th>
                    <tr><td><center>$isi[SellingCurr]. ".number_format($SellingAdlTwn, 0, '', ',');echo"</td></td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdTwn, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdXbed, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SellingChdNbed, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($SingleSell, 0, '', ',');echo"</td>
                    <td><center>$isi[SellingCurr]. ".number_format($TaxInsSell, 0, '', ',');echo"</td>
                    <td><center>$tips</td>";
                            if($isi[Embassy01]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell, 0, '', ',');echo"</td>";}
                            if($isi[Embassy02]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell2, 0, '', ',');echo"</td>";}
                            if($isi[Embassy03]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell3, 0, '', ',');echo"</td>";}
                            if($isi[Embassy04]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell4, 0, '', ',');echo"</td>";}
                            if($isi[Embassy05]<>'0')
                            {echo"<td><center>$isi[VisaCurr]. ".number_format($VisaSell5, 0, '', ',');echo"</td>";}
                            echo "</tr>";

                            echo "</table>
            <font size=1>* AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** TIPPING DIBAYARKAN DI NEGARA TUJUAN<br>
                        **** HARGA TOUR BELUM TERMASUK PPN 1%<br>
                        <b>***** NILAI DALAM MATA UANG RUPIAH DIHITUNG BERDASARKAN KURS ASUMSI DAN DAPAT BERUBAH SEWAKTU-WAKTU</b>
                                        </font><br>";
                        }
                        if($isi[Insurance]=='INCLUDE'){echo"<center><img src='images/panoramasure.png'>";}echo"
          <br><center><font size=1><b>JADWAL PERJALANAN/JENIS MAKANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font></center><br>
                                        $map<br>
          <table style='border:0px'>
          <tr><td style='border:0px' colspan='2'><b><u>PERKIRAAN CUACA</b></u></td></tr>
          <tr><td style='border:0px' colspan='2'>$isi[CuacaItin]<br>
          Cuaca diatas adalah Perkiraan, jika ingin update silahkan klik http://www.accuweather.com</td></tr>
          <tr><td style='border:0px' colspan='2'><b><u>HOTEL YANG AKAN DI GUNAKAN</b></u></td></tr>";
                        $Qhot=mysql_query("SELECT * FROM tour_msitinhotel
                                   inner join tour_mshotel on tour_mshotel.IDHotel = tour_msitinhotel.HotelID
                                   WHERE ProductID='$isi[IDProduct]'");
                        while($hot=mysql_fetch_array($Qhot)){
                            if($hot[Website]<>''){$web="($hot[Website])";}else{$web="";}
                            echo"<tr><td style='border:0px'>$hot[City]</td><td style='border:0px'>: $hot[HotelName] $web atau Setaraf</td></tr>";
                        }
                        echo"</table><center>";
                    }
                    echo "</td></tr></table>
         <iframe src='printitin.php?id=$isi[IDProduct]' name='tbfprint' style='visibility: hidden' height='0' width='0' frameborder='0'>
          </iframe>
          <iframe src='printitinemb.php?id=$isi[IDProduct]' name='embprint' style='visibility: hidden' height='0' width='0' frameborder='0'>
          </iframe>
          <input type='button' value='PRINT' onClick=frames['tbfprint'].print() >";
                    if($team=='DEVELOPER' or $team=='PO' OR $team=='PO MANAGER'){
                        echo" <input type='button' value='PRINT for EMBASSY' onClick=frames['embprint'].print() >";
                    }echo"
          <input type=button value='Back' onclick=self.history.back()>
          <a href='printpdfitintez.php?id=$isi[IDProduct]' target='_blank'><img src='../admin/images/pdf.png' /></a>";
                }
            }else{
                echo"<center>SORRY, ITIN HAS NOT BEEN CREATED</center>";
            }
//--------------
        }else if($attach=='hotel'){
            $ambil=mysql_query("SELECT tour_msproduct.*,
                    tour_msproductcode.* FROM tour_msproduct                                         
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode     
                    WHERE tour_msproduct.IDProduct ='$IDProduct'");
            $isi=mysql_fetch_array($ambil);
            $prodpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                left join tour_msgrv on tour_msgrv.IDGrv = tour_msproductpnr.GrvID
                                left join tour_msairlines on tour_msairlines.AirlinesID = tour_msgrv.GrvAirlines
                                WHERE PnrProd = '$isi[IDProduct]'");

            $cb=0;
            while($pnr=mysql_fetch_array($prodpnr)){
                $airlines1=$pnr[AirlinesName];
                if($cb==0){
                    $air="$airlines1";
                }else{
                    $air=" & $airlines1";
                }
                $Airlines=$Airlines.$air;
                $cb++;
            }

            $depdet = strtoupper(date("d M Y", strtotime($isi[DateTravelFrom])));

            if($isi[ProductTipping]=='0' or $isi[ProductTipping]==''){$tips='INCLUDE';}else{$tips=$isi[ProductTipping];}
            if($isi[GroupType]=='CRUISE'){$logo='images/PTICruise.png';}
            else if($isi[Department]=='TUR EZ'){$logo='images/PTITUREZ.png';}
            else {$logo='images/PTIExperience.png';}
            //NAMA TL FINAL
            $NamaFinalTL='';
            $FinalTL =mysql_query("SELECT *,tour_mstourleader.* FROM tour_msproducttl
                                                    left join tour_mstourleader on tour_mstourleader.TourleaderName = tour_msproducttl.TLName
                                                    WHERE tour_msproducttl.IDProduct='$IDProduct' 
                                                    and tour_msproducttl.TLStatus='FINAL'
                                                    and tour_mstourleader.TourleaderStatus='ACTIVE'");
            $AdaFinal=mysql_num_rows($FinalTL);
            if($AdaFinal>0){
                $cb=0;
                while($DFinalTL=mysql_fetch_array($FinalTL)){
                    $tourleader1=$DFinalTL[TourleaderName];
                    $tlhp=$DFinalTL[TourleaderMobile];
                    if($cb==0){
                        $ttl="$tourleader1 ($tlhp)";
                    }else{
                        $ttl="<br>$tourleader1 ($tlhp)";
                    }
                    $NamaFinalTL=$NamaFinalTL.$ttl;
                    $cb++;
                }
            }
            if($NamaFinalTL==''){$finaltl='';}else{$finaltl=$NamaFinalTL;}
            //table utama
            echo "  <center><table style='border:0' >
                    <tr><td style='border:0' width='695px' height='842px' align='justify'>  
                    <center><img src='$logo'><br>
                    <font size=1>PANORAMA TOURS TMC</font><br>
                    <font size=1>TRAVEL MANAGEMENT COMPANY</font><br><br>
                    <font size=3><b>HOTEL LIST</b></font><br>
                    <font size=3><b>$isi[Productcode]</b></font><br>
                    <font size=3><b>BY $Airlines </b></font><br>
                    <font size=2>$isi[TourCode]</font><br>
                    <table style='border:0'>
                    <tr><td colspan='2' style='text-align: right;border:0'><b>TOUR LEADER :</b></td><td colspan='3' style='border:0'><b>$finaltl</b></td></tr>
                    <tr><th width='75'>Days & Date</th><th>Flight</th><th>Time</th><th>Route</th><th>Hotel</th></tr>";
            for($c=1;$c<=$isi[DaysTravel];$c++){
                $d=$c-1;
                $prod=mysql_query("SELECT * FROM tour_msitin
                                        WHERE ProductID = '$isi[IDProduct]'
                                        AND Days='$c' ");
                $isiprod=mysql_fetch_array($prod);
                $awaltgl=$isi[DateTravelFrom];
                $awaltanggal = substr($awaltgl,8,2);
                $awalbulan = substr($awaltgl,5,2);
                $awaltahun = substr($awaltgl,0,4);
                $hari= date('d M Y',strtotime('-0 second',strtotime("+$d days",strtotime(date($awalbulan).'/'.date($awaltanggal).'/'.date($awaltahun).' 00:00:00'))));
                $tglbiasa= date('Y-m-d',strtotime('-0 second',strtotime("+$d days",strtotime(date($awalbulan).'/'.date($awaltanggal).'/'.date($awaltahun).' 00:00:00'))));
                $fly=mysql_query("SELECT * FROM tour_msprodflight
                                            left join tour_msproductpnr on tour_msproductpnr.GrvID = tour_msprodflight.IDGrv
                                            WHERE PnrProd = '$isi[IDProduct]'
                                            and AirDate='$tglbiasa' order by FID ASC");
                $cb=0;
                $namaaircode='';
                $waktu='';
                while($flight=mysql_fetch_array($fly)){
                    $ATD = date('H.i', strtotime($flight[AirTimeDep]));
                    $ATA = date('H.i', strtotime($flight[AirTimeArr]));
                    $acode=$flight[AirCode];
                    if($cb==0){
                        $airc="$acode ($flight[AirRouteDep] - $flight[AirRouteArr])";
                        $atd1="$ATD - $ATA &nbsp$flight[Note]";
                    }else{
                        $airc="<br>$acode ($flight[AirRouteDep] - $flight[AirRouteArr])";
                        $atd1="<br>$ATD - $ATA &nbsp$flight[Note]";
                    }
                    $namaaircode=$namaaircode.$airc;
                    $waktu=$waktu.$atd1;
                    $cb++;
                }
                //if($namaaircode==''){$aircode='';}else{$aircode=$namaaircode;}
                echo "  <tr><td><center>DAY $c<br>$hari</center></td>
                    <td width='125'><center>$namaaircode</center></td>
                    <td width='100'><center>$waktu</center></td>
                    <td><center>$isiprod[Route]</center></td>
                    <td>$isiprod[Hotel]</td></tr>";
            }
            $tempatkumpul=preg_replace("[<p>]", "", str_replace("</p>", "<br>", $isi[TempatKumpul] ) );
            echo "  <tr><td colspan='5' style='border:0'><b>HARAP BERKUMPUL DI:</b><br> $tempatkumpul</td></tr>
                    </table>
                    <tr><td colspan='5' style='border:0'><b><i>Catatan : Hotel dan Flight dapat berubah sewaktu-waktu dengan/tanpa pemberitahuan terlebih dahulu</i></td></tr>
                    </td></tr></table>
                    <iframe src='printhotel.php?id=$isi[IDProduct]' name='tbfprint' style='visibility: hidden' height='0' width='0' frameborder='0'>
          </iframe>
          <input type='button' value='PRINT' onClick=frames['tbfprint'].print() > <input type=button value='Back' onclick=self.history.back()>";

        }else if($attach=='information'){
            $ambil=mysql_query("SELECT tour_msproduct.*,
                    tour_msproductcode.* FROM tour_msproduct
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode
                    WHERE tour_msproduct.IDProduct ='$IDProduct'");
            $isi=mysql_fetch_array($ambil);
            if($isi[ProductTipping]=='0'){$tips='';}else{$tips=$isi[ProductTipping];}
            if($isi[GroupType]=='CRUISE'){$logo='images/PTICruise.png';}
            else if($isi[Department]=='TUR EZ'){$logo='images/PTITUREZ.png';}
            else {$logo='images/PTIExperience.png';}
            echo "<img src='$logo'><br>
            HAL-HAL PERHATIAN<br>
            <input type=hidden name='id' value='$IDProduct'>
            <textarea id='inf' name='info'>$isi[ProductInformation]</textarea>
          ";?>
            <script type="text/javascript">
                CKEDITOR.replace( inf, {
                    extraPlugins : 'autogrow',
                    autoGrow_maxHeight : '850',
                    height : '850px',
                    width : '800px',
                    removePlugins : 'resize',
                    resize_dir : 'vertical'
                });
            </script><?PHP /*<input type='submit' value='Print'>*/ echo"
            <br><center> <input type=button value='Close' onclick=location.href='?module=msproduct'></form>";
        }

        break;

    case "delattach":
        $edit1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$_GET[id]'");
        $r2=mysql_fetch_array($edit1);
        $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r2[AttachmentFile]) ) ) );
        $path = $r2[Attachment];
        $files = ("$path$file");
        unlink($files);
        $edit=mysql_query("UPDATE tour_msproduct set Attachment = '',AttachmentFile='' WHERE IDProduct = '$_GET[id]'");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msitin&nama=$r2[IDProduct]&type=itin&itin=uploaditin'>";
        break;

    case "delpdf":
        $edit1=mysql_query("SELECT * FROM tour_msitinpdf WHERE ItinID ='$_GET[id]'");
        $r2=mysql_fetch_array($edit1);
        $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r2[AttachmentFile]) ) ) );
        $path = $r2[Attachment];
        $files = ("$path$file");
        unlink($files);
        $edit=mysql_query("DELETE FROM `tour_msitinpdf` WHERE ItinID = '$_GET[id]'");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msitin&nama=$r2[IDProduct]&type=itin&itin=uploaditin'>";
        break;

    case "delmap":
        $edit1=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct ='$_GET[id]'");
        $r2=mysql_fetch_array($edit1);
        $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r2[MapFile]) ) ) );
        $path = $r2[MapFolder];
        $files = ("$path$file");
        unlink($files);
        $edit=mysql_query("UPDATE tour_msproduct set MapFolder = '',MapFile='' WHERE IDProduct = '$_GET[id]'");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msitin&nama=$r2[IDProduct]&type=itin'>";
        break;

    case "delphoto":
        $edit1=mysql_query("SELECT * FROM tour_msitintmrreq
                            left join tour_msproductreq on tour_msproductreq.IDProduct = tour_msitintmrreq.ProdID
                            WHERE ItinID ='$_GET[id]'");
        $r2=mysql_fetch_array($edit1);
        $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r2[Photo]) ) ) );
        $path = $r2[PhotoFolder];
        $files = ("$path$file");
        unlink($files);
        $edit=mysql_query("UPDATE tour_msitintmrreq set PhotoFolder = '',Photo='' WHERE ItinID = '$_GET[id]'");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msitin&act=edittmr&no=$r2[TmrNo]&preq=$r2[TmrOption]'>";
        break;

    case "deltmrpdf":
        $opt=$_GET[opt];
        $edit1=mysql_query("SELECT $opt as opsi,PdfFolder FROM tour_msitintmrpdf WHERE IDTmr ='$_GET[id]'");
        $r2=mysql_fetch_array($edit1);
        $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r2[opsi]) ) ) );
        $path = $r2[PdfFolder];
        $files = ("$path$file");
        unlink($files);
        $edit=mysql_query("UPDATE `tour_msitintmrpdf` set $opt = ''  WHERE IDTmr = '$_GET[id]'");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msitin&act=tmrpdf&no=$_GET[id]'>";
        break;

/////////////////////////////////////////////////// TMR //////////////////////////////////////////////////////////
    case "tmr":
        $tmrid=$_GET[no];
        $totquo=$_GET[q];
        $caridata=mysql_query("SELECT * FROM tour_mstmrreq WHERE IDTmr = '$tmrid'");
        $datatmr=mysql_fetch_array($caridata);
        $barukah=mysql_num_rows($caridata);
        $seat=$datatmr[Seat]+$datatmr[SeatChild];

        $cuma = mysql_query("SELECT * FROM tour_msproductreq WHERE TmrNo = '$tmrid'
                                ORDER BY IDProduct DESC limit 1");
        $saja = mysql_fetch_array($cuma);
        $inqid=$saja[IDProduct];

        $lang=$_GET['language'];
        if($lang==''){$lang='INDONESIA';}else{$lang=$lang;}

        $hariini = date("Y-m-d ");
        $IDTmr=$_GET['no'];
        $tampil2=mysql_query("SELECT job_desc FROM tbl_msemployee WHERE employee_username='$_SESSION[namauser]'");
        $hasil2=mysql_fetch_object($tampil2);
        $JobDesc=$hasil2->job_desc;
        //$ambil=mysql_query("SELECT * FROM tour_mstmrreq
        //            WHERE IDTmr ='$IDTmr'");
        /*$ambil=mysql_query("SELECT tour_msproductreq.*,
                            tour_mstmrreq.IDTmr,tour_mstmrreq.TmrNo,tour_msairlines.*,tour_msproductreq.Flight as pesawat FROM tour_msproductreq
                            left join tour_mstmrreq on tour_mstmrreq.IDTmr = tour_msproductreq.TMRNo
                            left join tour_msairlines on tour_msairlines.AirlinesID = tour_msproductreq.Flight
                            WHERE tour_msproductreq.IDProduct = '$inqid'");
        $isi=mysql_fetch_array($ambil);*/
        echo "<h2>e-itin TMR: $datatmr[TmrNo]</h2>";
        $oke=$_GET['oke'];
        if($datatmr[HotelCategory]=='ONE STAR'){$star="<img src='../admin/images/onestar.jpg'>";}
        else if($datatmr[HotelCategory]=='TWO STAR'){$star="<img src='../admin/images/twostar.jpg'>";}
        else if($datatmr[HotelCategory]=='THREE STAR'){$star="<img src='../admin/images/threestar.jpg'>";}
        else if($datatmr[HotelCategory]=='FOUR STAR'){$star="<img src='../admin/images/fourstar.jpg'>";}
        else if($datatmr[HotelCategory]=='FIVE STAR'){$star="<img src='../admin/images/fivestar.jpg'>";}
        $DateFrom = date('d-m-Y', strtotime($datatmr[DateTravelFrom]));
        $DateTo = date('d-m-Y', strtotime($datatmr[DateTravelTo]));
        $Dead = date('d-m-Y', strtotime($datatmr[ProposalDeadline]));
        if($datatmr[Budget]=='' OR $datatmr[Budget]=='0'){$budget="No Budget";}else{$budget="$datatmr[BudgetCurr] $datatmr[Budget] /pax";}
        echo"<table style='border: 0px solid #000000;'>
          <tr><td style='border: 0px solid #000000;'>
          <table class='bordered'>
          <tr><th colspan=2>product info (request) </th></tr>
          <tr><td width='120'>BSO Request</td>  <td width='350'>$datatmr[ProductFor]</td></tr>
          <tr><td>Destination</td> <td>$datatmr[Destination]</td></tr>
          <tr><td>Date of Travelling</td> <td>$DateFrom until $DateTo</td></tr>
          <tr><td>Prefered Airlines</td> <td>  $datatmr[Flight]</td></tr>
          <tr><td>Total Participant</td> <td>$datatmr[Seat] Adult - $datatmr[SeatChild] Child - $datatmr[SeatInfant] Infant</td></tr>
          <tr><td>Approx Budget</td> <td>$budget</td></tr>
          <tr><td>Level of Service</td> <td>$datatmr[LevelService]</td></tr>
          <tr><td>Hotel Category</td> <td>$star</td></tr>
          <tr><td>Tour Leader</td> <td>$datatmr[TourLeaderInc]</td></tr>
          <tr><td>Insurance</td> <td>$datatmr[Insurance]</td></tr>
          <tr><td>Proposal Deadline</td> <td>$Dead</td></tr>
          <tr><td>Special Request</td><td>$datatmr[SpecialRequest]</td></tr>

          </table>
          </td><td style='border: 0px solid #000000;'></td><td style='border: 0px solid #000000;'>
          <table class='bordered'>
          <tr><th colspan='7'>ITINERARY (REQUEST)</th></tr>";
        $cekitin=mysql_query("SELECT * FROM tour_mstmritinreq WHERE TmrID = '$datatmr[TmrNo]' and Route <> '' order by IDTmritin ASC limit 1");
        $okitin=mysql_num_rows($cekitin);
        if($okitin<1){
            echo"<tr><td colspan='7'><center>NO REQUEST</td></tr>";
        }else{
            echo"<tr><th colspan=2></th><th>service</th><th colspan=3>meals</th><th></th></tr>
          <tr><th>day</th><th>route</th><th>(transfer, tour, meeting, optional)</th><th>b</th><th>l</th><th>d</th><th>remarks</th></tr>";
            $qitin=mysql_query("SELECT * FROM tour_mstmritinreq WHERE TmrID = '$datatmr[TmrNo]'");
            while($it=mysql_fetch_array($qitin)){
                echo"<tr><td><center>$it[Day]</td>
          <td width='150'>$it[Route]</td>
          <td>$it[Service]</td>
          <td><center>";if($it[B]=='BREAKFAST'){echo"<img src='../images/done.png'>";}else{echo"<img src='../images/cancel.gif'>";}echo"</td>
          <td><center>";if($it[L]=='LUNCH'){echo"<img src='../images/done.png'>";}else{echo"<img src='../images/cancel.gif'>";}echo"</td>
          <td><center>";if($it[D]=='DINNER'){echo"<img src='../images/done.png'>";}else{echo"<img src='../images/cancel.gif'>";}echo"</td>
          <td width='200'>$it[Remarks]</td></tr>";
            }}echo"
          </table>
          </table>
            <form name='example' method='POST' action='./aksi.php?module=msitin&act=tmr' enctype='multipart/form-data'>
            <input type=hidden name='nama' value='$IDTmr'>
            <input type=hidden name='opt' value='$_GET[q]'>
            <input type='hidden' name='language' value='INDONESIA'><input type='hidden' name='productstatus' value='baru'>";

        $prodpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                left join tour_msgrv on tour_msgrv.IDGrv = tour_msproductpnr.GrvID
                                left join tour_msairlines on tour_msairlines.AirlinesID = tour_msgrv.GrvAirlines
                                WHERE PnrProd = '$isi[IDProduct]' Group By GrvAirlines ");

        $cb=0;
        while($pnr=mysql_fetch_array($prodpnr)){
            $airlines1=$pnr[AirlinesName];
            if($cb==0){
                $air="$airlines1";
            }else{
                $air=" & $airlines1";
            }
            $Airlines=$Airlines.$air;
            $cb++;
        }

        $roomnow='awal';
        $jumlah=mysql_num_rows($edit);
        $depdet = strtoupper(date("d M Y", strtotime($datatmr[DateTravelFrom])));

        if($datatmr[ProductTipping]=='0'){$tips='';}else{$tips=$datatmr[ProductTipping];}

        echo "

                    <input type='hidden' name='tmrid' value='$tmrid'><input type='hidden' name='daystravel' value='$datatmr[DaysTravel]'>
                    <input type='hidden' name='lang' value='$lang'><input type='hidden' name='opsi' value='$_GET[q]'>
                    <table class='bordered' STYLE='border: 0px' >";

        //if($isi[pesawat]<>''){
        echo"
          <tr style='background: #ffffff;'><td style='border: 0px solid #000000;' colspan=4><font size=3><b>BY";
        echo"
                    <select name='flight' id='flight' onChange='airshow-delete($tmrid,$totquo,$inqid)' required>
                    <option value='' selected>- Select Airlines -</option>";
        $tampil=mysql_query("SELECT * FROM tour_msairlines where AirlinesStatus='ACTIVE' ORDER BY AirlinesID");
        while($s=mysql_fetch_array($tampil)){
            if($isi[pesawat]==$s[AirlinesID]){
                echo "<option value='$s[AirlinesID]' selected>$s[AirlinesID] - $s[AirlinesName]</option>";
            }else {
                echo "<option value='$s[AirlinesID]'>$s[AirlinesID] - $s[AirlinesName]</option>";
            }
        }
        echo "</select></b></font></td></tr>
          <tr style='background: #ffffff;'}><td style='border: 0px solid #000000;' colspan=6><font size=3><b>DEP.: $depdet </b></font></td></tr>
          <tr><th>day</th><th>route*</th><th>Detail</th><th>Hotel</th><th>transportation By</th><th>Meals</th></tr>";
        for($c=1;$c<=$datatmr[DaysTravel];$c++){
            $prod=mysql_query("SELECT * FROM tour_msitintmrreq
                    WHERE TmrID = '$datatmr[IDTmr]'
                    AND `Option` = '$_GET[q]'
                    AND Language = '$lang'
                    AND Days='$c' ");
            $isiprod=mysql_fetch_array($prod);
            if($isiprod[HotelID]=='0'){$htldetail=$isiprod[Hotel];$keluar='text';$keluar1='disabled';}else{$htldetail=$isiprod[Hotel];$keluar='hidden';$keluar1='enabled';}
            echo"<tr height='20'>
          <td><center>$c</center></td>
          <td><center><input type='text' name='route$c' size='40' value='$isiprod[Route]'><br><br>
          Image: ";if($isiprod[Photo]<>''){
                echo"<input type='hidden' name='photo[$c]' value='$isiprod[Photo]'>
            <a href='$isiprod[PhotoFolder]$file' target='_blank' style=text-decoration:none >$isiprod[Photo]</a> &nbsp<a href=\"javascript:delphoto('$isiprod[ItinID]','$isiprod[Photo]')\"><font color=red>remove</font></a>";}
            else{echo"<input type='file' name='photo[$c]' multiple='multiple' accept='image/*'>";
            }echo"</td>
          <td height='10'><center><textarea cols='3' id='tcb$c' name='detail$c' rows='2'>$isiprod[Detail]</textarea>
          ";?>
            <script type="text/javascript">
                //<![CDATA[

                CKEDITOR.replace( <?PHP echo"tcb$c," ?> {
                    extraPlugins : 'autogrow',
                    autoGrow_maxHeight : '130',
                    height : '130px',
                    width : '400px',
                    removePlugins : 'resize',
                    resize_dir : 'vertical'
                });

                //]]>
            </script>
            <?PHP echo"</td>
          <td>
          <input type=radio name='htlnote$c' id='radiohotel' value='htlhotel' onclick=pilihhtl('htlhotel','$c') ";if($isiprod[HotelID]<>'0'){echo"checked";}echo">&nbsp;
          <select name='hotel$c' id='hotel$c' $keluar1>
              <option value='' selected>- Select Hotel -</option>";
            $hot=mysql_query("SELECT * FROM tour_mshotel where Country = '$isi[Destination]' AND Active='True' order by HotelName ASC");
            while($htl=mysql_fetch_array($hot)){
                if($isiprod[HotelID]==$htl[IDHotel]){
                    echo "<option value='$htl[IDHotel]' selected>$htl[HotelName] (+$htl[Telephone])</option>";
                }else{
                    echo "<option value='$htl[IDHotel]'>$htl[HotelName] (+$htl[Telephone])</option>";
                }
            }
            echo "</select><br><br>
          <input type=radio name='htlnote$c' id='radionote' value='htlnote' onclick=pilihhtl('htlnote','$c') ";if($isiprod[HotelID]=='0'){echo"checked";}echo">&nbsp;
          <input type='$keluar' name='hoteldetail$c' id='hoteldetail$c' value='$htldetail'><input type='hidden' name='temphtl$c' id='temphtl$c' value='$htldetail'>
          </td>
          <td><select name='trans$c' id='trans$c'>
              <option value='' ";if($isiprod[Transport]==''){echo"selected";}echo">- Select Transportation -</option>
              <option value='PLANE'";if($isiprod[Transport]=='PLANE'){echo"selected";}echo">Plane</option>
              <option value='TRAIN'";if($isiprod[Transport]=='TRAIN'){echo"selected";}echo">Train</option>
              <option value='BUS'";if($isiprod[Transport]=='BUS'){echo"selected";}echo">Bus</option>
              <option value='FERRY'";if($isiprod[Transport]=='FERRY'){echo"selected";}echo">Ferry</option>
              </select></td>
          <td><input type='checkbox' name='breakfast$c' value='YES'";if($isiprod[Breakfast]=='YES'){echo"checked";}echo"> BREAKFAST<br>
              <input type='text' name='breakfastdesc$c' value='$isiprod[BreakfastDesc]'><br><br>
              <input type='checkbox' name='lunch$c' value='YES'";if($isiprod[Lunch]=='YES'){echo"checked";}echo"> LUNCH<br>
              <input type='text' name='lunchdesc$c' value='$isiprod[LunchDesc]'><br><br>
              <input type='checkbox' name='dinner$c' value='YES'";if($isiprod[Dinner]=='YES'){echo"checked";}echo"> DINNER<br>
              <input type='text' name='dinnerdesc$c' value='$isiprod[DinnerDesc]'></td>
          </tr>";
        }
        echo" </table>

          <table class='bordered'>
          <tr><th colspan='2'>additional info</th></tr>
          <tr><td>Bonus</td><td><input type='text' name='bonus' size='100' value='$isi[ProductBonus]'></td></tr>
          <tr><td>Tipping</td><td>
          <input type=radio name='tipsi' value='include' onclick='intip()' checked>&nbsp;Include
          <input type=radio name='tipsi' value='notinclude' onclick='notip()'>&nbsp;Not Include
          <select name='karensi' id='karensi'><option value='' selected>-select-</option>";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$isi[ProductTippingCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]' >$s[curr]</option>";
            }
        }
        echo "</select> <input type='hidden' name='tipping' id='tipping' value='$tips' onkeyup='isNumber(this)'></td></tr>
          <input type='hidden' name='column' value='one'>
          <tr><td>Meeting Point</td><td><textarea cols='3' id='tempatkumpul' name='tempatkumpul' rows='2'>$isi[TempatKumpul]</textarea>
          ";?>
        <script type="text/javascript">
            //<![CDATA[

            CKEDITOR.replace( tempatkumpul, {
                extraPlugins : 'autogrow',
                autoGrow_maxHeight : '130',
                height : '130px',
                width : '400px',
                removePlugins : 'resize',
                resize_dir : 'vertical'
            });

            //]]>
        </script>
        <?PHP echo"</td></tr>";
        $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isi[MapFile]) ) ) );
        echo"<tr><td>Map Picture</td><td>";if($isi[MapFile]<>''){
        echo"<input type='hidden' name='mapfile' value='$isi[MapFile]'>
          <a href='$isi[MapFolder]$file' target='_blank' style=text-decoration:none >$isi[MapFile]</a> &nbsp<a href=\"javascript:delmap('$inqid','$isi[MapFile]')\"><font color=red>remove</font></a>";}
    else{echo"<input type='file' name='upload' multiple='multiple' accept='image/*'>";
    }echo"
          </table>
          <table class='bordered'>
          <tr><th></th><th>ADULT</th><th>CHILD TWN</th><th>CHILD X BED</th><th>Child No bed</th><th>Infant</th></tr>";
        $qharga1=mysql_query("SELECT * FROM tour_msproductpricetmrreq
                            WHERE TmrID = '$IDTmr' AND Harga = '1'");
        $harga1=mysql_fetch_array($qharga1);
        echo"<tr><th><input type='text' name='pax1' value='0' size='2' required> PAX</th><td><input type=text name='rsadult1' value='0' size='10' onkeyup='isNumber(this)' required></td></td>
             <td><input type=text name='rschdtwn1' value='0' size='10' onkeyup='isNumber(this)' required></td>
             <td><input type=text name='rschdxbed1' value='0' size='10'onkeyup='isNumber(this)' required></td>
             <td><input type=text name='rschdnbed1' value='0' size='10' onkeyup='isNumber(this)' required></td>
             <td><input type=text name='rsinfant1' value='0' size='10' onkeyup='isNumber(this)' required></td></tr>";
        $qharga2=mysql_query("SELECT * FROM tour_msproductpricetmrreq
                            WHERE TmrID = '$IDTmr' AND Harga = '2'");
        $harga2=mysql_fetch_array($qharga2);
        echo"<tr><th><input type='text' name='pax2' value='' size='2'> PAX</th><td><input type=text name='rsadult2' value='' size='10' onkeyup='isNumber(this)' ></td></td>
             <td><input type=text name='rschdtwn2' value='' size='10' onkeyup='isNumber(this)' ></td>
             <td><input type=text name='rschdxbed2' value='' size='10'onkeyup='isNumber(this)' ></td>
             <td><input type=text name='rschdnbed2' value='' size='10' onkeyup='isNumber(this)'></td>
             <td><input type=text name='rsinfant2' value='' size='10' onkeyup='isNumber(this)' ></td></tr>
          </table>
          <table class='bordered'>
          <tr><th>Description</th><th>Curr</th><th>Nett</th><th>selling</th></tr>
          <tr><td>Airport Tax & Flight Insurance</td> <td>$datatmr[BudgetCurr]</td><td> <input type=text name='taxinsnett' size='12' value='0'onkeyup='isNumber(this)'></td><td> <input type=text name='taxinssell' size='12' value='0'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Single Supplement</td> <td>$datatmr[BudgetCurr]</td><td> <input type=text name='singlenett' size='12' value='0'onkeyup='isNumber(this)'></td><td> <input type=text name='singlesell' size='12' value='0'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Visa </td><td><select name='visacurr' ";if ($isi[Visa]=='NO REQUIRED'){echo"disabled";}echo">";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]=='IDR'){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]'>$s[curr]</option>";
            }
        }
        echo "</select></td><td> <input type=text name='visanett' size='12'";if ($isi[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='0'onkeyup='isNumber(this)'></td><td><input type=text name='visasell' size='12'";if ($isi[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='0'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Visa 2</td><td><select name='visacurr2' ";if ($isi[Visa]=='NO REQUIRED'){echo"disabled";}echo">";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]=='USD'){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]'>$s[curr]</option>";
            }
        }
        echo "</select></td><td> <input type=text name='visanett2' size='12'";if ($isi[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='0'onkeyup='isNumber(this)'></td><td><input type=text name='visasell2' size='12'";if ($isi[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='0'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Domestic Airport Tax</td><td><select name='airtaxcurr' >";
        $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
        if($isi[AirTaxCurr]==''){$isi[AirTaxCurr]='IDR';}
        while($s=mysql_fetch_array($tampil)){
            if($s[curr]==$isi[AirTaxCurr]){
                echo "<option value='$s[curr]' selected>$s[curr]</option>";
            } else {
                echo "<option value='$s[curr]'>$s[curr]</option>";
            }

        }
        if($isi[AirTaxNett]==''){$airtaxnet='150000';}else{$airtaxnet=$isi[AirTaxNett];}
        if($isi[AirTaxSell]==''){$airtaxsell='150000';}else{$airtaxsell=$isi[AirTaxSell];}
        echo "</select></td><td> <input type=text name='airtaxnett' size='12' value='$airtaxnet'onkeyup='isNumber(this)'></td><td> <input type=text name='airtaxsell' size='12' value='$airtaxsell'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Sea Tax</td><td>$datatmr[BudgetCurr]</td><td> <input type=text name='seataxnett' size='12' value='0'onkeyup='isNumber(this)'></td><td> <input type=text name='seataxsell' size='12' value='0' onkeyup='isNumber(this)'></td></tr>
          </table><br>
          Flight Detail
          <br>
          <!--<input type=radio name='flightdetail' id='newdetail' value='newflight' onclick='editflight()' checked><font size=2>Not Reserv</font>&nbsp&nbsp
            <input type=radio name='flightdetail' id='copydetail' value='copyflight' onclick='copyflight()' ><font size=2>Reserv</font>
            <select name='copyidgrv' id='copyidgrv' disabled>
            <option value='0' selected>- No PNR -</option>
            </select>-->
          <table id='air' border='1' class='bordered'>
          <tr><th><img src='../images/add.png' class='cloneTableRows' /></th><th>Flight No</th><th>Class</th><th>Date</th><th>Dep</th><th>Arr</th><th>ETD</th><th>ETA</th><th>Cross</th><th>Status</th><th>Note</th></tr>
          <tr>
          <td><img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' /></td>
          <td><select name='airline[]'><option value='' >- select -</option>";
        $tampila=mysql_query("SELECT * FROM tour_msairlines ORDER BY AirlinesID ASC");
        while($a=mysql_fetch_array($tampila)){
            echo "<option value='$a[AirlinesID]' >$a[AirlinesID]</option>";
        }
        echo "</select>
          <input type='text' name='aircode[]' size='4'></td>
          <td><center><input type='text' name='airclass[]' size='3' maxlength='3' ></td>
          <td><input type='text' name='airdate[]' class='my_date' size='8' value='00-00-0000'></td>
          <td><center><select name='airroutedep[]'><option value='' >- select city -</option>";
        $tampil2=mysql_query("SELECT * FROM tbl_city ");
        while($s2=mysql_fetch_array($tampil2)){
            echo "<option value='$s2[CityCode]' >$s2[CityCode] ($s2[CityName])</option>";
        }
        echo "</select></td>
          <td><center><select name='airroutearr[]'><option value='' >- select city -</option>";
        $tampil2=mysql_query("SELECT * FROM tbl_city ");
        while($s2=mysql_fetch_array($tampil2)){
            echo "<option value='$s2[CityCode]' >$s2[CityCode] ($s2[CityName])</option>";
        }
        echo "</select></td>
          <td><input type='text' name='airtimedep[]' size='4' maxlength='4' onkeyup='isNumber(this)'></td>
          <td><input type='text' name='airtimearr[]' size='4' maxlength='4' onkeyup='isNumber(this)'></td>
          <td><select name='aircross[]' >
              <option value='NO' selected>NO</option>
              <option value='YES'>YES</option>
              </select></td>
           <td><select name='airstatus[]' >
              <option value='HK' selected>HK</option>
              <option value='HL'>HL</option>
              </select></td>
          <td><input type='text' name='note[]'></td>
          </tr>
          </table>
          <center><input type='submit' value='Save'></form>";
        /*}else{
            echo"</td></tr></table>";
        }*/
        break;

    case "tmrpdf":
        $tmrid=$_GET[no];
        $totquo=$_GET[q];
        $caridata=mysql_query("SELECT * FROM tour_mstmrreq WHERE IDTmr = '$tmrid'");
        $datatmr=mysql_fetch_array($caridata);
        $barukah=mysql_num_rows($caridata);
        $seat=$datatmr[Seat]+$datatmr[SeatChild];

        $cuma = mysql_query("SELECT * FROM tour_msproductreq WHERE TmrNo = '$tmrid'
                                ORDER BY IDProduct DESC limit 1");
        $saja = mysql_fetch_array($cuma);
        $inqid=$saja[IDProduct];

        $lang=$_GET['language'];
        if($lang==''){$lang='INDONESIA';}else{$lang=$lang;}

        $hariini = date("Y-m-d ");
        $IDTmr=$_GET['no'];
        $tampil2=mysql_query("SELECT job_desc FROM tbl_msemployee WHERE employee_username='$_SESSION[namauser]'");
        $hasil2=mysql_fetch_object($tampil2);
        $JobDesc=$hasil2->job_desc;
        echo "<h2>e-itin TMR: $datatmr[TmrNo]</h2>";
        $oke=$_GET['oke'];
        if($datatmr[HotelCategory]=='ONE STAR'){$star="<img src='../admin/images/onestar.jpg'>";}
        else if($datatmr[HotelCategory]=='TWO STAR'){$star="<img src='../admin/images/twostar.jpg'>";}
        else if($datatmr[HotelCategory]=='THREE STAR'){$star="<img src='../admin/images/threestar.jpg'>";}
        else if($datatmr[HotelCategory]=='FOUR STAR'){$star="<img src='../admin/images/fourstar.jpg'>";}
        else if($datatmr[HotelCategory]=='FIVE STAR'){$star="<img src='../admin/images/fivestar.jpg'>";}
        $DateFrom = date('d-m-Y', strtotime($datatmr[DateTravelFrom]));
        $DateTo = date('d-m-Y', strtotime($datatmr[DateTravelTo]));
        $Dead = date('d-m-Y', strtotime($datatmr[ProposalDeadline]));
        if($datatmr[Budget]=='' OR $datatmr[Budget]=='0'){$budget="No Budget";}else{$budget="$datatmr[BudgetCurr] $datatmr[Budget] /pax";}
        echo"<table style='border: 0px solid #000000;'>
          <tr><td style='border: 0px solid #000000;'>
          <table class='bordered'>
          <tr><th colspan=2>product info (request) </th></tr>
          <tr><td width='120'>BSO Request</td>  <td width='350'>$datatmr[ProductFor]</td></tr>
          <tr><td>Destination</td> <td>$datatmr[Destination]</td></tr>
          <tr><td>Date of Travelling</td> <td>$DateFrom until $DateTo</td></tr>
          <tr><td>Prefered Airlines</td> <td>  $datatmr[Flight]</td></tr>
          <tr><td>Total Participant</td> <td>$datatmr[Seat] Adult - $datatmr[SeatChild] Child - $datatmr[SeatInfant] Infant</td></tr>
          <tr><td>Approx Budget</td> <td>$budget</td></tr>
          <tr><td>Level of Service</td> <td>$datatmr[LevelService]</td></tr>
          <tr><td>Hotel Category</td> <td>$star</td></tr>
          <tr><td>Tour Leader</td> <td>$datatmr[TourLeaderInc]</td></tr>
          <tr><td>Insurance</td> <td>$datatmr[Insurance]</td></tr>
          <tr><td>Proposal Deadline</td> <td>$Dead</td></tr>
          <tr><td>Special Request</td><td>$datatmr[SpecialRequest]</td></tr>

          </table>
          </td><td style='border: 0px solid #000000;'></td><td style='border: 0px solid #000000;'>
          <table class='bordered'>
          <tr><th colspan='7'>ITINERARY (REQUEST)</th></tr>";
        $cekitin=mysql_query("SELECT * FROM tour_mstmritinreq WHERE TmrID = '$datatmr[TmrNo]' and Route <> '' order by IDTmritin ASC limit 1");
        $okitin=mysql_num_rows($cekitin);
        if($okitin<1){
            echo"<tr><td colspan='7'><center>NO REQUEST</td></tr>";
        }else{
            echo"<tr><th colspan=2></th><th>service</th><th colspan=3>meals</th><th></th></tr>
          <tr><th>day</th><th>route</th><th>(transfer, tour, meeting, optional)</th><th>b</th><th>l</th><th>d</th><th>remarks</th></tr>";
            $qitin=mysql_query("SELECT * FROM tour_mstmritinreq WHERE TmrID = '$datatmr[TmrNo]'");
            while($it=mysql_fetch_array($qitin)){
                echo"<tr><td><center>$it[Day]</td>
          <td width='150'>$it[Route]</td>
          <td>$it[Service]</td>
          <td><center>";if($it[B]=='BREAKFAST'){echo"<img src='../images/done.png'>";}else{echo"<img src='../images/cancel.gif'>";}echo"</td>
          <td><center>";if($it[L]=='LUNCH'){echo"<img src='../images/done.png'>";}else{echo"<img src='../images/cancel.gif'>";}echo"</td>
          <td><center>";if($it[D]=='DINNER'){echo"<img src='../images/done.png'>";}else{echo"<img src='../images/cancel.gif'>";}echo"</td>
          <td width='200'>$it[Remarks]</td></tr>";
            }}echo"
          </table>
          </table>
        <form name='example' method='POST' action='./aksi.php?module=msitin&act=tmrpdf' enctype='multipart/form-data'>
        <input type=hidden name='idtmr' value='$IDTmr'>";
        $qchoice=mysql_query("SELECT * FROM tour_msitintmrpdf
                    WHERE IDTmr = '$datatmr[IDTmr]'");
        $isichoice=mysql_fetch_array($qchoice);
        echo"<table class='bordered'>

         <tr><th>Option</th><th>Itinerary</th><th>quotation</th>
         <tr><td><center>1</td><td>
        ";if($isichoice[ItinOption1]<>''){
        $itin1= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isichoice[ItinOption1]) ) ) );
        echo"<input type='hidden' name='itin1' value='$isichoice[ItinOption1]'>
        <a href='$isichoice[PdfFolder]$itin1' target='_blank' style=text-decoration:none >$isichoice[ItinOption1]</a> &nbsp<a href=\"javascript:deltmrpdf('$isichoice[IDTmr]','ItinOption1')\"><font color=red>remove</font></a>";}
    else{echo"<input type='file' name='itinoption1' accept='application/pdf'>";
    }echo"</td><td>
        ";if($isichoice[QuotationOption1]<>''){
        $quotation1= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isichoice[QuotationOption1]) ) ) );
        echo"<input type='hidden' name='quotation1' value='$isichoice[QuotationOption1]'>
        <a href='$isichoice[PdfFolder]$quotation1' target='_blank' style=text-decoration:none >$isichoice[QuotationOption1]</a> &nbsp<a href=\"javascript:deltmrpdf('$isichoice[IDTmr]','QuotationOption1')\"><font color=red>remove</font></a>";}
    else{echo"<input type='file' name='quotationoption1' accept='application/pdf'>";
    }echo"</td></tr>

        <tr><td><center>2</td><td>
        ";if($isichoice[ItinOption2]<>''){
        $itin2= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isichoice[ItinOption2]) ) ) );
        echo"<input type='hidden' name='itin2' value='$isichoice[ItinOption2]'>
        <a href='$isichoice[PdfFolder]$itin2' target='_blank' style=text-decoration:none >$isichoice[ItinOption2]</a> &nbsp<a href=\"javascript:deltmrpdf('$isichoice[IDTmr]','ItinOption2')\"><font color=red>remove</font></a>";}
    else{echo"<input type='file' name='itinoption2' accept='application/pdf'>";
    }echo"</td><td>
            ";if($isichoice[QuotationOption2]<>''){
        $quotation2= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isichoice[QuotationOption2]) ) ) );
        echo"<input type='hidden' name='quotation2' value='$isichoice[QuotationOption2]'>
            <a href='$isichoice[PdfFolder]$quotation2' target='_blank' style=text-decoration:none >$isichoice[QuotationOption2]</a> &nbsp<a href=\"javascript:deltmrpdf('$isichoice[IDTmr]','QuotationOption2')\"><font color=red>remove</font></a>";}
    else{echo"<input type='file' name='quotationoption2' accept='application/pdf'>";
    }echo"</td></tr>

        <tr><td><center>3</td><td>
        ";if($isichoice[ItinOption3]<>''){
        $itin3= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isichoice[ItinOption3]) ) ) );
        echo"<input type='hidden' name='itin3' value='$isichoice[ItinOption3]'>
        <a href='$isichoice[PdfFolder]$itin3' target='_blank' style=text-decoration:none >$isichoice[ItinOption3]</a> &nbsp<a href=\"javascript:deltmrpdf('$isichoice[IDTmr]','ItinOption3')\"><font color=red>remove</font></a>";}
    else{echo"<input type='file' name='itinoption3' accept='application/pdf'>";
    }echo"</td><td>
        ";if($isichoice[QuotationOption3]<>''){
        $quotation3= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isichoice[QuotationOption3]) ) ) );
        echo"<input type='hidden' name='quotation3' value='$isichoice[QuotationOption3]'>
        <a href='$isichoice[PdfFolder]$quotation3' target='_blank' style=text-decoration:none >$isichoice[QuotationOption3]</a> &nbsp<a href=\"javascript:deltmrpdf('$isichoice[IDTmr]','QuotationOption3')\"><font color=red>remove</font></a>";}
    else{echo"<input type='file' name='quotationoption3' accept='application/pdf'>";
    }echo"</td></tr>
          </table>
          <center><input type='submit' value='Save'> <input type=button value='Close' onclick=location.href='?module=mstmr'></form>";

        break;

    case "edittmr":
        $tmrid=$_GET[no];
        //$totquo=$_GET[q];
        $idprod=$_GET[preq];

        $cuma = mysql_query("SELECT * FROM tour_msproductreq WHERE IDProduct = '$idprod'
                                ORDER BY IDProduct DESC limit 1");
        $saja = mysql_fetch_array($cuma);
        $inqid=$saja[IDProduct];

        $lang=$_GET['language'];
        if($lang==''){$lang='INDONESIA';}else{$lang=$lang;}

        $hariini = date("Y-m-d ");
        $IDTmr=$_GET['no'];
        $tampil2=mysql_query("SELECT job_desc FROM tbl_msemployee WHERE employee_username='$_SESSION[namauser]'");
        $hasil2=mysql_fetch_object($tampil2);
        $JobDesc=$hasil2->job_desc;
        $ambil=mysql_query("SELECT tour_msproductreq.*,tour_msitintmrreq.*,
                            tour_mstmrreq.IDTmr,tour_mstmrreq.TmrNo,tour_mstmrreq.TnC,tour_msairlines.*,tour_msproductreq.Flight as pesawat FROM tour_msproductreq
                            left join tour_mstmrreq on tour_mstmrreq.IDTmr = tour_msproductreq.TMRNo
                            left join tour_msairlines on tour_msairlines.AirlinesID = tour_msproductreq.Flight
                            left join tour_msitintmrreq on tour_msitintmrreq.prodID = tour_msproductreq.IDProduct
                            WHERE tour_msproductreq.IDProduct = '$inqid'");
        $isi=mysql_fetch_array($ambil);
        if($isi[pesawat]<>''){
            echo "<h2>e-itin TMR: $isi[TmrNo]</h2>";
            $oke=$_GET['oke'];

            echo"<form name='example' method='POST' action='./aksi.php?module=msitin&act=tmr' enctype='multipart/form-data'>
            <input type=hidden name=module value='msitin'><input type='hidden' name='productstatus' value='lama'><input type=hidden name=type value='itin'>
            <input type='hidden' name='language' value='INDONESIA'><input type='hidden' name='productid' value='$inqid'>";

            $prodpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                left join tour_msgrv on tour_msgrv.IDGrv = tour_msproductpnr.GrvID
                                left join tour_msairlines on tour_msairlines.AirlinesID = tour_msgrv.GrvAirlines
                                WHERE PnrProd = '$isi[IDProduct]' Group By GrvAirlines ");

            $cb=0;
            while($pnr=mysql_fetch_array($prodpnr)){
                $airlines1=$pnr[AirlinesName];
                if($cb==0){
                    $air="$airlines1";
                }else{
                    $air=" & $airlines1";
                }
                $Airlines=$Airlines.$air;
                $cb++;
            }

            $roomnow='awal';
            $jumlah=mysql_num_rows($edit);
            $depdet = strtoupper(date("d M Y", strtotime($isi[DateTravelFrom])));

            if($isi[ProductTipping]=='0'){$tips='';}else{$tips=$isi[ProductTipping];}
            if($isi[GroupType]=='CRUISE'){$logo='images/PTICruise.png';}
            else if($isi[Department]=='TUR EZ'){$logo='images/PTITUREZ.png';}
            else {$logo='images/PTIExperience.png';}
            echo "

                    <input type='hidden' name='tmrid' value='$IDTmr'><input type='hidden' name='daystravel' value='$isi[DaysTravel]'>
                    <input type='hidden' name='lang' value='$lang'><input type='hidden' name='opt' value='$isi[TmrOption]'>
                    <table class='bordered' STYLE='border: 0px solid #000000'>";
            if($isi[GroupType]=='TUR EZ'){
                echo "  <tr style='background: #ffffff;'><td style='border: 0px solid #000000;' colspan=3></td>
                    <td style='border: 0px solid #000000;' rowspan=4 colspan=3><img src='$logo'></td></tr>
                    <tr style='background: #ffffff;'><td style='border: 0px solid #000000;' colspan=3><font size=3><b>BY $isi[AirlinesName] </b></font></td></tr>
                    <tr style='background: #ffffff;'><td style='border: 0px solid #000000;' colspan=3><font size=3><b>DEP.: $depdet </b></font></td></tr> ";
            }else{
                echo "  <tr style='background: #ffffff;'><td style='border: 0px solid #000000;' colspan=6></td></tr>
                    <tr style='background: #ffffff;'><td style='border: 0px solid #000000;' colspan=6><img src='$logo'></td></tr>
                    <tr style='background: #ffffff;'><td style='border: 0px solid #000000;' colspan=3><font size=3><b>BY $isi[AirlinesName] </b></font></td></tr>
                    <tr style='background: #ffffff;'><td style='border: 0px solid #000000;' colspan=6><font size=3><b>DEP.: $depdet </b></font></td></tr> ";
            }

            echo"
          <tr><th>day</th><th>route*</th><th>Detail</th><th>Hotel</th><th>transportation By</th><th>Meals</th></tr>";
            for($c=1;$c<=$isi[DaysTravel];$c++){
                $prod=mysql_query("SELECT * FROM tour_msitintmrreq
                    WHERE ProdID = '$_GET[preq]'
                    AND Days='$c' ");
                $isiprod=mysql_fetch_array($prod);
                if($isiprod[HotelID]=='0'){$htldetail=$isiprod[Hotel];$keluar='text';$keluar1='disabled';}else{$htldetail=$isiprod[Hotel];$keluar='hidden';$keluar1='enabled';}
                echo"<tr height='20'>
          <td><center>$c</center></td>
          <td><center><input type='text' name='route$c' size='40' value='$isiprod[Route]'><br><br>
          ";if($isiprod[Photo]<>''){
                    $photo= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isiprod[Photo]) ) ) );
                    echo"<input type='hidden' name='photo[$c]' value='$isiprod[Photo]'>
            <img src='$isiprod[PhotoFolder]$photo' width='150px' height='150px'><br><a href=\"javascript:delphoto('$isiprod[ItinID]','$isiprod[Photo]')\"><font color=red>remove</font></a>";}
                else{echo"Image: <input type='file' name='photo[$c]' multiple='multiple' accept='image/*'>";
                }echo"</td>
          <td height='10'><center><textarea cols='3' id='tcb$c' name='detail$c' rows='2'>$isiprod[Detail]</textarea>
          ";?>
                <script type="text/javascript">
                    //<![CDATA[

                    CKEDITOR.replace( <?PHP echo"tcb$c," ?> {
                        extraPlugins : 'autogrow',
                        autoGrow_maxHeight : '130',
                        height : '130px',
                        width : '400px',
                        removePlugins : 'resize',
                        resize_dir : 'vertical'
                    });

                    //]]>
                </script>
                <?PHP echo"</td>
          <td>
          <input type=radio name='htlnote$c' id='radiohotel' value='htlhotel' onclick=pilihhtl('htlhotel','$c') ";if($isiprod[HotelID]<>'0'){echo"checked";}echo">&nbsp;
          <select name='hotel$c' id='hotel$c' $keluar1>
              <option value='' selected>- Select Hotel -</option>";
                $hot=mysql_query("SELECT * FROM tour_mshotel where Country = '$isi[Destination]' AND Active='True' order by HotelName ASC");
                while($htl=mysql_fetch_array($hot)){
                    if($isiprod[HotelID]==$htl[IDHotel]){
                        echo "<option value='$htl[IDHotel]' selected>$htl[HotelName] (+$htl[Telephone])</option>";
                    }else{
                        echo "<option value='$htl[IDHotel]'>$htl[HotelName] (+$htl[Telephone])</option>";
                    }
                }
                echo "</select><br><br>
          <input type=radio name='htlnote$c' id='radionote' value='htlnote' onclick=pilihhtl('htlnote','$c') ";if($isiprod[HotelID]=='0'){echo"checked";}echo">&nbsp;
          <input type='$keluar' name='hoteldetail$c' id='hoteldetail$c' value='$htldetail'><input type='hidden' name='temphtl$c' id='temphtl$c' value='$htldetail'>
          </td>
          <td><select name='trans$c' id='trans$c'>
              <option value='' ";if($isiprod[Transport]==''){echo"selected";}echo">- Select Transportation -</option>
              <option value='PLANE'";if($isiprod[Transport]=='PLANE'){echo"selected";}echo">Plane</option>
              <option value='TRAIN'";if($isiprod[Transport]=='TRAIN'){echo"selected";}echo">Train</option>
              <option value='BUS'";if($isiprod[Transport]=='BUS'){echo"selected";}echo">Bus</option>
              <option value='FERRY'";if($isiprod[Transport]=='FERRY'){echo"selected";}echo">Ferry</option>
              </select></td>
          <td><input type='checkbox' name='breakfast$c' value='YES'";if($isiprod[Breakfast]=='YES'){echo"checked";}echo"> BFAST<br>
              <input type='text' name='breakfastdesc$c' value='$isiprod[BreakfastDesc]'><br><br>
              <input type='checkbox' name='lunch$c' value='YES'";if($isiprod[Lunch]=='YES'){echo"checked";}echo"> LUNCH<br>
              <input type='text' name='lunchdesc$c' value='$isiprod[LunchDesc]'><br><br>
              <input type='checkbox' name='dinner$c' value='YES'";if($isiprod[Dinner]=='YES'){echo"checked";}echo"> DINNER<br>
              <input type='text' name='dinnerdesc$c' value='$isiprod[DinnerDesc]'></td>
          </tr>";
            }
            echo" </table>
          <table class='bordered'>
          <tr><th colspan='2'>additional info</th></tr>
          <tr><td>Bonus</td><td><input type='text' name='bonus' size='100' value='$isi[ProductBonus]'></td></tr>
          <tr><td>Tipping</td><td>
          <input type=radio name='tipsi' value='include' onclick='intip()' ";if($isi[ProductTipping]=='0' OR $isi[ProductTipping]==''){echo"checked";}echo">&nbsp;Include
          <input type=radio name='tipsi' value='notinclude' onclick='notip()' ";if($isi[ProductTipping] > '0'){echo"checked";}echo">&nbsp;Not Include
          <select name='karensi' id='karensi'><option value='' selected>-select-</option>";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            while($s=mysql_fetch_array($tampil)){
                if($s[curr]==$isi[ProductTippingCurr]){
                    echo "<option value='$s[curr]' selected>$s[curr]</option>";
                } else {
                    echo "<option value='$s[curr]' >$s[curr]</option>";
                }
            }
            echo "</select> <input type='text' name='tipping' id='tipping' value='$tips' onkeyup='isNumber(this)'></td></tr>
          <input type='hidden' name='column' value='one'>
          <tr><td>Meeting Point</td><td><textarea cols='3' id='tempatkumpul' name='tempatkumpul' rows='2'>$isi[TempatKumpul]</textarea>
          ";?>
            <script type="text/javascript">
                //<![CDATA[

                CKEDITOR.replace( tempatkumpul, {
                    extraPlugins : 'autogrow',
                    autoGrow_maxHeight : '130',
                    height : '130px',
                    width : '400px',
                    removePlugins : 'resize',
                    resize_dir : 'vertical'
                });

                //]]>
            </script>
            <?PHP echo"</td></tr>";
            $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isi[MapFile]) ) ) );
            echo"<tr><td>Map Picture</td><td>";if($isi[MapFile]<>''){
                echo"<input type='hidden' name='mapfile' value='$isi[MapFile]'>
          <a href='$isi[MapFolder]$file' target='_blank' style=text-decoration:none ><img src='$isi[MapFolder]$file'></a> &nbsp<a href=\"javascript:delmap('$inqid','$isi[MapFile]')\"><font color=red>remove</font></a>";}
            else{echo"<input type='file' name='upload' multiple='multiple' accept='image/*'>";
            }echo"
          </table>
          <table class='bordered'>
          <tr><th>PAX</th><th>ADULT</th><th>CHILD TWN</th><th>CHILD X BED</th><th>Child No bed</th><th>Infant</th></tr>";
            $qharga1=mysql_query("SELECT * FROM tour_msproductpricetmrreq
                            WHERE ProdID = '$inqid' AND Harga = '1'");
            $harga1=mysql_fetch_array($qharga1);
            echo"<tr><th><input type='text' name='pax1' value='$harga1[PaxFor]' size='2' required> PAX</th><td><input type=text name='rsadult1' value='$harga1[SellingAdlTwn]' size='10' onkeyup='isNumber(this)' required></td></td>
             <td><input type=text name='rschdtwn1' value='$harga1[SellingChdTwn]' size='10' onkeyup='isNumber(this)' required></td>
             <td><input type=text name='rschdxbed1' value='$harga1[SellingChdXbed]' size='10'onkeyup='isNumber(this)' required></td>
             <td><input type=text name='rschdnbed1' value='$harga1[SellingChdNbed]' size='10' onkeyup='isNumber(this)' required></td>
             <td><input type=text name='rsinfant1' value='$harga1[SellingInfant]' size='10' onkeyup='isNumber(this)' required></td></tr>";
            $qharga2=mysql_query("SELECT * FROM tour_msproductpricetmrreq
                            WHERE ProdID = '$inqid' AND Harga = '2'");
            $harga2=mysql_fetch_array($qharga2);
            echo"<tr><th><input type='text' name='pax2' value='$harga2[PaxFor]' size='2'> PAX</th><td><input type=text name='rsadult2' value='$harga2[SellingAdlTwn]' size='10' onkeyup='isNumber(this)' ></td></td>
             <td><input type=text name='rschdtwn2' value='$harga2[SellingChdTwn]' size='10' onkeyup='isNumber(this)' ></td>
             <td><input type=text name='rschdxbed2' value='$harga2[SellingChdXbed]' size='10'onkeyup='isNumber(this)' ></td>
             <td><input type=text name='rschdnbed2' value='$harga2[SellingChdNbed]' size='10' onkeyup='isNumber(this)'></td>
             <td><input type=text name='rsinfant2' value='$harga2[SellingInfant]' size='10' onkeyup='isNumber(this)' ></td></tr>
          </table>
          <table class='bordered'>
          <tr><th>Description</th><th>Curr</th><th>Nett</th><th>selling</th></tr>
          <tr><td>Airport Tax & Flight Insurance</td> <td>$isi[SellingCurr]</td><td> <input type=text name='taxinsnett' size='12' value='$isi[TaxInsNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='taxinssell' size='12' value='$isi[TaxInsSell]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Single Supplement</td> <td>$isi[SellingCurr]</td><td> <input type=text name='singlenett' size='12' value='$isi[SingleNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='singlesell' size='12' value='$isi[SingleSell]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Visa </td><td><select name='visacurr' ";if ($isi[Visa]=='NO REQUIRED'){echo"disabled";}echo">";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($isi[VisaCurr]==''){$isi[VisaCurr]='IDR';}
            while($s=mysql_fetch_array($tampil)){
                if($s[curr]==$isi[VisaCurr]){
                    echo "<option value='$s[curr]' selected>$s[curr]</option>";
                } else {
                    echo "<option value='$s[curr]'>$s[curr]</option>";
                }
            }
            echo "</select></td><td> <input type=text name='visanett' size='12'";if ($isi[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$isi[VisaNett]'onkeyup='isNumber(this)'></td><td><input type=text name='visasell' size='12'";if ($isi[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$isi[VisaSell]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Visa 2</td><td><select name='visacurr2' ";if ($isi[Visa]=='NO REQUIRED'){echo"disabled";}echo">";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($isi[VisaCurr2]==''){$isi[VisaCurr2]='USD';}
            while($s=mysql_fetch_array($tampil)){
                if($s[curr]==$r[VisaCurr2]){
                    echo "<option value='$s[curr]' selected>$s[curr]</option>";
                } else {
                    echo "<option value='$s[curr]'>$s[curr]</option>";
                }
            }
            echo "</select></td><td> <input type=text name='visanett2' size='12'";if ($isi[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$isi[VisaNett2]'onkeyup='isNumber(this)'></td><td><input type=text name='visasell2' size='12'";if ($isi[Visa]=='NO REQUIRED'){echo"disabled";}echo" value='$isi[VisaSell2]'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Domestic Airport Tax</td><td><select name='airtaxcurr' >";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            if($isi[AirTaxCurr]==''){$isi[AirTaxCurr]='IDR';}
            while($s=mysql_fetch_array($tampil)){
                if($s[curr]==$isi[AirTaxCurr]){
                    echo "<option value='$s[curr]' selected>$s[curr]</option>";
                } else {
                    echo "<option value='$s[curr]'>$s[curr]</option>";
                }

            }
            if($isi[AirTaxNett]==''){$airtaxnet='150000';}else{$airtaxnet=$isi[AirTaxNett];}
            if($isi[AirTaxSell]==''){$airtaxsell='150000';}else{$airtaxsell=$isi[AirTaxSell];}
            echo "</select></td><td> <input type=text name='airtaxnett' size='12' value='$airtaxnet'onkeyup='isNumber(this)'></td><td> <input type=text name='airtaxsell' size='12' value='$airtaxsell'onkeyup='isNumber(this)'></td></tr>
          <tr><td>Sea Tax</td><td>$isi[SellingCurr]</td><td> <input type=text name='seataxnett' size='12' value='$isi[SeaTaxNett]'onkeyup='isNumber(this)'></td><td> <input type=text name='seataxsell' size='12' value='$isi[SeaTaxSell]'onkeyup='isNumber(this)'></td></tr>
          </table><br>
          Flight Detail
          <br>
          <!--<input type=radio name='flightdetail' id='newdetail' value='newflight' onclick='editflight()' checked><font size=2>Not Reserv</font>&nbsp&nbsp
            <input type=radio name='flightdetail' id='copydetail' value='copyflight' onclick='copyflight()' ><font size=2>Reserv</font>
            <select name='copyidgrv' id='copyidgrv' disabled>
            <option value='0' selected>- No PNR -</option>
            </select>-->
          <table class='bordered' id='air' border='1'>
          <tr><th><img src='../images/add.png' class='cloneTableRows' /></th><th>Flight No</th><th>Class</th><th>Date</th><th>Dep</th><th>Arr</th><th>ETD</th><th>ETA</th><th>Cross</th><th>Status</th><th>Note</th></tr>";
            $i=0;
            $coba=mysql_query("SELECT * FROM tour_msprodflighttmrreq where IDProduct ='$_GET[preq]' order by FID ASC ");
            $baris=mysql_num_rows($coba);
            if($baris>0){
                while($tes=mysql_fetch_array($coba)){
                    $al=substr($tes[AirCode],0,2);
                    $ac=substr($tes[AirCode],2,8);
                    if($tes[AirDate]=='0000-00-00'){$AD='00-00-0000';}else{
                        $AD = date('d-m-Y', strtotime($tes[AirDate]));}
                    echo"
          <tr>
          <td><img src='../images/delete.png' alt='' class='delRow' $vis></td>
                     <td><select name='airline[]'>";
                    $tampila=mysql_query("SELECT * FROM tour_msairlines ORDER BY AirlinesID ASC");
                    while($a=mysql_fetch_array($tampila)){
                        if($al==$a[AirlinesID]){
                            echo "<option value='$a[AirlinesID]' selected>$a[AirlinesID]</option>";
                        }else{
                            echo "<option value='$a[AirlinesID]' >$a[AirlinesID]</option>";
                        }

                    }
                    echo "</select>
                     <input type='text' name='aircode[]' size='7' value='$ac'></td>
                     <td><center><input type='text' name='airclass[]' size='3' value='$tes[AirClass]' maxlength='3'></td>
                     <td><input type='text' name='airdate[]' class='my_date' value='$AD' size='8'></td>
                  <td><center><select name='airroutedep[]'>";
                    $tampil=mysql_query("SELECT * FROM tbl_city ");
                    while($sc=mysql_fetch_array($tampil)){
                        if($tes[AirRouteDep]==$sc[CityCode]){
                            echo "<option value='$sc[CityCode]' selected>$sc[CityCode] ($sc[CityName])</option>";
                        }else{
                            echo "<option value='$sc[CityCode]' >$sc[CityCode] ($sc[CityName])</option>";
                        }
                    }
                    echo "</select></td>
          <td><center><select name='airroutearr[]'>";
                    $tampil=mysql_query("SELECT * FROM tbl_city ");
                    while($s=mysql_fetch_array($tampil)){
                        if($tes[AirRouteArr]==$s[CityCode]){
                            echo "<option value='$s[CityCode]' selected>$s[CityCode] ($s[CityName])</option>";
                        }else{
                            echo "<option value='$s[CityCode]' >$s[CityCode] ($s[CityName])</option>";
                        }
                    }
                    echo "</select></td>
                  <td><input type='text' name='airtimedep[]' size='4' value='$tes[AirTimeDep]' maxlength='4' onkeyup='isNumber(this)'></td>
                  <td><input type='text' name='airtimearr[]' size='4' value='$tes[AirTimeArr]' maxlength='4' onkeyup='isNumber(this)'></td>
                  <td><select name='aircross[]' >
                      <option value='YES'";if($tes[AirCross]=='YES'){echo"selected";}echo">YES</option>
                      <option value='NO'";if($tes[AirCross]=='NO'){echo"selected";}echo">NO</option>
                      </select></td>
                      <td><select name='airstatus[]' >
                      <option value='HK'";if($tes[AirStatus]=='HK'){echo"selected";}echo">HK</option>
                      <option value='HL'";if($tes[AirStatus]=='HL'){echo"selected";}echo">HL</option>
                      </select></td>
                  <td><input type='text' name='note[]' value='$tes[Note]'></td>
                  </tr>";$i++;}
            }else{echo"
            <tr>
         <td><img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' /></td>
         <td><select name='airline[]'>";
                $tampila=mysql_query("SELECT * FROM tour_msairlines ORDER BY AirlinesID ASC");
                while($a=mysql_fetch_array($tampila)){
                    echo "<option value='$a[AirlinesID]' >$a[AirlinesID]</option>";
                }
                echo "</select>
               <input type='text' name='aircode[]' size='7'></td>
         <td><center><input type='text' name='airclass[]' size='3' maxlength='3' ></td>
         <td><input type='text' name='airdate[]' class='my_date'  size='8'></td>
          <td><center><select name='airroutedep[]'>";
                $tampil=mysql_query("SELECT * FROM tbl_city ORDER BY CityName ASC");
                while($s=mysql_fetch_array($tampil)){
                    echo "<option value='$s[CityCode]' >$s[CityCode] ($s[CityName])</option>";
                }
                echo "</select></td>
          <td><center><select name='airroutearr[]'>";
                $tampil=mysql_query("SELECT * FROM tbl_city ORDER BY CityName ASC");
                while($s=mysql_fetch_array($tampil)){
                    echo "<option value='$s[CityCode]' >$s[CityCode] ($s[CityName])</option>";
                }
                echo "</select></td>
          <td><input type='text' name='airtimedep[]' size='4' maxlength='4' onkeyup='isNumber(this)'></td>
          <td><input type='text' name='airtimearr[]' size='4' maxlength='4' onkeyup='isNumber(this)'></td>
          <td><select name='aircross[]' >
              <option value='NO' selected>NO</option>
              <option value='YES'>YES</option>
              </select></td>
           <td><select name='airstatus[]' >
              <option value='HK' selected>HK</option>
              <option value='HL'>HL</option>
              </select></td>
          <td><input type='text' name='note[]'></td>
          </tr>";
            }
            echo" </table>

            <center><input type='submit' value='Update'> <input type=button value='Close' onclick=location.href='?module=mstmr'></form>";
        }else{
            echo"</table>";
        }
        break;

    case "simpanair":
        $no=$_GET[no];
        $q=$_GET[q];
        $idprod=$_GET[prod];
        $air=$_GET[air];
        $edit=mysql_query("UPDATE tour_msproductreq SET Flight = '$air'
                            WHERE IDProduct = '$idprod'");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msitin&act=tmr&no=$no&q=$q'>";
        break;
}
?>
