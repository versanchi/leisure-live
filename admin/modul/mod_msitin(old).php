<script type="text/javascript">
    function generateexcel(tableid) {
        var table= document.getElementById(tableid);
        var html = table.outerHTML;
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    }
    function delattach(ID, ATTACHFILE)
    {
        if (confirm("Are you sure you want to delete " + ATTACHFILE +" "));
        {
            window.location.href = '?module=msitin&act=delattach&id=' + ID;

        }
    }
    function delmap(ID, ATTACHFILE)
    {
        if (confirm("Are you sure you want to delete " + ATTACHFILE +" "))
        {
            window.location.href = '?module=msitin&act=delmap&id=' + ID;

        }
    }
    function tampil(sel,teks,isi)
    {
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
    function intip()
    {
        document.getElementById('karensi').type='hidden';
        document.getElementById('tipping').type='hidden';
        document.getElementById('tipping').value='0';
    }
    function notip() {
        document.getElementById('karensi').type='text';
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
    function ganti()
    {
        document.getElementById("myform").submit();
    }
    function gantiattach()
    {
        document.getElementById("jenisattach").submit();
    }
</script>
<script type="text/javascript">
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
        if($itin==''){$itin='createitin';}else{$itin=$itin;}
        $hariini = date("Y-m-d ");
        $IDProduct=$_GET['nama'];
        $tampil2=mysql_query("SELECT job_desc FROM tbl_msemployee WHERE employee_username='$_SESSION[namauser]'");
        $hasil2=mysql_fetch_object($tampil2);
        $JobDesc=$hasil2->job_desc;
        $ambil=mysql_query("SELECT tour_msproduct.*,
                    tour_msproductcode.* FROM tour_msproduct                                            
                    inner join tour_msproductcode on tour_msproductcode.ProductcodeName=tour_msproduct.ProductCode     
                    WHERE tour_msproduct.IDProduct ='$IDProduct'");
        $isi=mysql_fetch_array($ambil);
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
        if($type=='itin'){
            echo"<form method='get' id='jenisitin' action='media.php?'>
            <input type=hidden name=module value='msitin'><input type=hidden name='nama' value='$IDProduct'><input type=hidden name=type value='itin'>
            <input type=radio name='itin' value='createitin' onclick='bukaitin()'";if($itin=='createitin'){echo"checked";}echo"><font size=2>Create/Edit Itin & Hotel</font>&nbsp&nbsp
            <input type=radio name='itin' value='uploaditin' onclick='bukaitin()'";if($itin=='uploaditin'){echo"checked";}echo"><font size=2>Upload Itin (.pdf)</font>
            
            </form>";

            if($itin=='uploaditin'){
                echo"<form name='example' method='POST' action='./aksi.php?module=msitin&act=upload' enctype='multipart/form-data'>
            <input type=hidden name='id' value='$IDProduct'>
            <table><tr><td>File Itinerary PDF</td><td>";
                $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isi[AttachmentFile]) ) ) );
                if($isi[AttachmentFile]<>''){$ok="disabled";echo"Itinerary:
        <input type='hidden' name='attachmentfile' value='$isi[AttachmentFile]'>
        <a href='$isi[Attachment]$file' target='_blank' style=text-decoration:none >$isi[AttachmentFile]</a> &nbsp<a href=\"javascript:delattach('$isi[IDProduct]','$isi[AttachmentFile]')\"><font color=red>remove</font></a></td></tr>";}
                else{$ok="enabled";echo"<input type='file' name='upload'>";}
                echo"</td></tr><tr><td colspan=2><center><input type='submit' value='Submit' $ok></center></td></tr></table> </form>";
            }
            else if($itin=='createitin'){
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
                else if($isi[GroupType]=='TUR EZ'){$logo='images/PTITUREZ.png';}
                else {$logo='images/PTIExperience.png';}
                echo "
            <form method=POST name='kopi' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msitin&act=copyitin' >
            <input type=hidden name='id' value='$IDProduct'><input type=hidden name='daystravel' value='$isi[DaysTravel]'>
            <table style='border: 0px;'>
            <tr style='border: 0px;'><td style='border: 0px;'><input type='button' name='iwant' name='iwant' value='Copy Itin'  onclick=Sowit() ></td>
            <td style='border: 0px;'> <select name='idcopy' id='idcopy' style='visibility:hidden'>
            <option value='0' selected>- Select TourCode -</option>";
                // copy itinerary berdasarkan product code yang sama saja
                $tampil0=mysql_query("SELECT * FROM tour_msproduct
                                left join tour_msitin on tour_msitin.ProductID = tour_msproduct.IDProduct   
                                WHERE Status <> 'VOID'
                                AND IDProduct <> '$IDProduct' and ProductCode='$isi[ProductCode]'
                                AND DaysTravel = '$isi[DaysTravel]'
                                AND ProductID <> ''
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
                    <table STYLE='border: 0px solid #000000'>";
                if($isi[GroupType]=='TUR EZ'){
                    echo "  <tr><td style='border: 0px solid #000000;' colspan=3></td>
                    <td style='border: 0px solid #000000;' rowspan=4 colspan=3><img src='$logo'></td></tr>
                    <tr><td style='border: 0px solid #000000;' colspan=3><font size=3><b>$isi[Productcode] - $isi[TourCode]</b></font></td></tr>
                    <tr><td style='border: 0px solid #000000;' colspan=3><font size=3><b>BY $Airlines </b></font></td></tr>
                    <tr><td style='border: 0px solid #000000;' colspan=3><font size=3><b>DEP.: $depdet </b></font></td></tr> ";
                }else{
                    echo "  <tr><td style='border: 0px solid #000000;' colspan=6></td></tr>
                    <tr><td style='border: 0px solid #000000;' colspan=6><img src='$logo'></td></tr>
                    <tr><td style='border: 0px solid #000000;' colspan=6><font size=3><b>$isi[Productcode] - $isi[TourCode]</b></font></td></tr>
                    <tr><td style='border: 0px solid #000000;' colspan=6><font size=3><b>BY $Airlines </b></font></td></tr>
                    <tr><td style='border: 0px solid #000000;' colspan=6><font size=3><b>DEP.: $depdet </b></font></td></tr> ";
                }echo"
                    <tr><th colspan=5></th><th colspan=3>meals</th></tr>
          <tr><th>day</th><th>route*</th><th>Detail</th><th>Hotel</th><th>transportation By</th><th>bfast</th><th>lunch</th><th>dinner</th></tr>";
                for($c=1;$c<=$isi[DaysTravel];$c++){
                    $prod=mysql_query("SELECT * FROM tour_msitin
                    WHERE ProductID = '$isi[IDProduct]'
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
              </select></td>
          <td><center><input type='checkbox' name='breakfast$c' value='YES'";if($isiprod[Breakfast]=='YES'){echo"checked";}echo"></td>
          <td><center><input type='checkbox' name='lunch$c' value='YES'";if($isiprod[Lunch]=='YES'){echo"checked";}echo"></td>
          <td><center><input type='checkbox' name='dinner$c' value='YES'";if($isiprod[Dinner]=='YES'){echo"checked";}echo"></td>   
          </tr>";
                }
                echo" </table>
          <table STYLE='border: 0px solid #000000'>
          <tr><th colspan='5'>Flight Schedule</th></tr>";
                $qpnr=mysql_query("SELECT * FROM tour_msproductpnr
                                        WHERE PnrProd ='$isi[IDProduct]'");
                while($pnr=mysql_fetch_array($qpnr)){
                    $fly=mysql_query("SELECT * FROM tour_msprodflight
                                            WHERE IDGrv ='$pnr[GrvID]' order by FID ASC");
                    while($flight=mysql_fetch_array($fly)){
                        $AD = strtoupper(date('d M', strtotime($flight[AirDate])));
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
          <table>
          <tr><th colspan='2'>additional info</th></tr>
          <tr><td>Bonus</td><td><input type='text' name='bonus' size='100' value='$isi[ProductBonus]'></td></tr>     
          <tr><td>Tipping</td><td>
          <input type=radio name='tipsi' value='include' onclick='intip()' ";if($isi[ProductTipping]=='0'){echo"checked";}echo">&nbsp;Include
          <input type=radio name='tipsi' value='notinclude' onclick='notip()' ";if($isi[ProductTipping]<>'0'){echo"checked";}echo">&nbsp;Not Include
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
          </table><br><center><input type='submit' value='Save'> <input type=button value='Close' onclick=location.href='?module=msproduct'></form>";
            }
        }else if($type=='information'){
            if($isi[ProductTipping]=='0'){$tips='';}else{$tips=$isi[ProductTipping];}
            if($isi[GroupType]=='CRUISE'){$logo='images/PTICruise.png';}
            else if($isi[GroupType]=='TUR EZ'){$logo='images/PTITUREZ.png';}
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
        if($attach==''){$attach='itin';}else{$attach=$attach;}
        echo"<form method='get' id='jenisattach' action='media.php?'>
            <input type=hidden name=module value='msitin'><input type=hidden name='id' value='$IDProduct'><input type='hidden' name='act' value='showitin'>
            Attachment <select name='attach' onchange='gantiattach()'>
            <option value='itin'";if($attach=='itin'){echo"selected";}echo">Itinerary</option>
            <option value='hotel'";if($attach=='hotel'){echo"selected";}echo">Hotel List</option>           
            <option value='information'";if($attach=='information'){echo"selected";}echo">Information</option>
            </select>
            </form>";
        if($attach=='itin'){
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
            if($isi[ProductTipping]=='0' or $isi[ProductTipping]==''){$tips='INCLUDE';}else{$tips="$tipscurr.$isi[ProductTipping]";}
            if($isi[GroupType]=='CRUISE'){$logo='images/PTICruise.png';}
            else if($isi[GroupType]=='TUR EZ'){$logo='images/PTITUREZ.png';}
            else {$logo='images/PTIExperience.png';}
            if($isi[ProductBonus]==''){$bns='';}else{$bns="BONUS: $isi[ProductBonus]";}
            //table utama
            echo "  <center><table style='border:0' >";
            if($isi[GroupType]=='TUR EZ'){
                echo "  <tr><td style='border:0'>
                    <font size=3><b>$isi[DaysTravel] DAYS $isi[Productcode]</b></font><br>
                    <font size=3><b>BY $Airlines </b></font><br>
                    <font size=2><b>DEP.: $depdet </b></font><br>
                    <font size=2><b>$isi[TourCode]</b></font><br>
                    <font size=2><b>$bns</b></font></td>
                    <td style='border:0' align='right'><img src='$logo'></td></tr>
                    <tr><td colspan=2 width='695px' height='842px' align='justify' style='border:0'>";
            }else{
                echo "  <tr><td style='border:0' width='695px' height='842px' align='justify'>
                    <img src='$logo'><br>
                    <font size=3><b>$isi[DaysTravel] DAYS $isi[Productcode]</b></font><br>
                    <font size=3><b>BY $Airlines </b></font><br>
                    <font size=2><b>DEP.: $depdet </b></font><br>
                    <font size=2><b>$isi[TourCode]</b></font><br>
                    <font size=2><b>$bns</b></font><br><br>";
            }
            $tblitin=mysql_query("SELECT * FROM tour_msitin
                                WHERE ProductID ='$isi[IDProduct]' ");
            $day=0;
            $mapfile= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($isi[MapFile]) ) ) );
            if($isi[MapFile]<>''){$map="<img src='../admin/map/$mapfile' width='330px' height='330px'>";}else{$map='';}
            while($itin=mysql_fetch_array($tblitin)){
                if(strlen($itin[Days])==1){$hari="0$itin[Days]";}else{$hari="$itin[Days]";}
                $route=$itin[Route];
                if($itin[Breakfast]=='YES' AND $itin[Lunch]=='YES' AND $itin[Dinner]=='YES'){$meals="<b>(B/L/D)</b>";}
                else if($itin[Breakfast]=='YES' AND $itin[Lunch]=='YES' AND $itin[Dinner]==''){$meals="<b>(B/L)</b>";}
                else if($itin[Breakfast]=='YES' AND $itin[Lunch]=='' AND $itin[Dinner]=='YES'){$meals="<b>(B/D)</b>";}
                else if($itin[Breakfast]=='' AND $itin[Lunch]=='YES' AND $itin[Dinner]=='YES'){$meals="<b>(L/D)</b>";}
                else if($itin[Breakfast]=='YES' AND $itin[Lunch]=='' AND $itin[Dinner]==''){$meals="<b>(B)</b>";}
                else if($itin[Breakfast]=='' AND $itin[Lunch]=='YES' AND $itin[Dinner]==''){$meals="<b>(L)</b>";}
                else if($itin[Breakfast]=='' AND $itin[Lunch]=='' AND $itin[Dinner]=='YES'){$meals="<b>(D)</b>";}else{$meals='';}
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
                            if($flight[AirDate]=='0000-00-00'){
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
                echo"
          <table>
          <tr><th colspan=3>HARGA TOUR</th></tr>
          <tr><td>DEWASA (1st/2nd Person)</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>$isi[CruiseAdl12]</td></td>
          <tr><td>DEWASA (3rd/4th Person)</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>$isi[CruiseAdl34]</td>
          <tr><td>ANAK-ANAK (1st/2nd Person)</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>$isi[CruiseChd12]</td>
          <tr><td>ANAK-ANAK (3rd/4th Person)</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>$isi[CruiseChd34]</td>
          <tr><td>SINGLE SUPPLEMENT</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>$isi[SingleSell]</td>
          <tr><td>SEAPORT, DEPT TAX, GRATUITIES</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>$isi[SeaTaxSell]</td>
          <tr><td>AIRPORT TAX INTERNATIONAL*</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>$isi[TaxInsSell]</td>
          <tr><td>TIPPING**</td><td style='text-align:right'>$isi[SellingCurr]</td><td style='text-align:right'>$tips</td></tr>
          <tr><td>AIRPORT TAX JAKARTA</td><td style='text-align:right'>Rp</td><td style='text-align:right'>".number_format($isi[AirTaxSell], 0, ',', '.');echo"</td></tr>";
                if($isi[VisaSell]<>'')
                {   $Qvisa=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy01]'");
                    $Dvisa=mysql_fetch_array($Qvisa);
                    echo"<tr><td>VISA $Dvisa[Country]</td><td style='text-align:right'>Rp</td><td style='text-align:right'>".number_format($isi[VisaSell], 0, ',', '.');echo"</td></tr>";
                }
                if($isi[VisaSell2]<>'')
                {   $Qvisa2=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy02]'");
                    $Dvisa2=mysql_fetch_array($Qvisa2);
                    echo"<tr><td>VISA $Dvisa2[Country]</td><td style='text-align:right'>Rp</td><td style='text-align:right'>".number_format($isi[VisaSell2], 0, ',', '.');echo"</td></tr>";
                }
                echo "</table>
          </div><br>
          <font size='1'>* AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** HARGA TOUR BELUM TERMASUK PPN 1%
                                        </font><br>";
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
                            if($flight[AirDate]=='0000-00-00'){
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
                echo"
          <font size=2><b>MINIMUM KEBERANGKATAN 20 PESERTA DEWASA:</b></font>
          <table><tr><th width='80' rowspan='2' style=vertical-align:middle>DEWASA TWIN SHARE</th><th colspan='3'>ANAK-ANAK (2 - 11 TAHUN)</th>
                <th width=60 rowspan='2' style=vertical-align:middle>SGL SUPP</th><th width='80' rowspan='2' style=vertical-align:middle>APO TAX INTL*</th>
                <th width='70' rowspan='2' style=vertical-align:middle>TIPPING**</th><th width='80' rowspan='2' style=vertical-align:middle>APO TAX JAKARTA</th>";
                if($isi[VisaSell]<>'' and $isi[VisaSell]<>'0')
                {$Qvisa=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy01]'");
                    $Dvisa=mysql_fetch_array($Qvisa);
                    echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $Dvisa[Country]</th>";
                }
                if($isi[VisaSell2]<>'' and $isi[VisaSell2]<>'0')
                {$Qvisa=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy02]'");
                    $Dvisa=mysql_fetch_array($Qvisa);
                    echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $Dvisa[Country]</th>";
                }
                echo "</tr><tr><th width=70>TWIN SHARE</th><th width=70>EXTRA BED</th><th width=70>NO BED</th>
                <tr><td><center>$isi[SellingCurr].$isi[SellingAdlTwn]</td></td>
                    <td><center>$isi[SellingCurr].$isi[SellingChdTwn]</td>
                    <td><center>$isi[SellingCurr].$isi[SellingChdXbed]</td>
                    <td><center>$isi[SellingCurr].$isi[SellingChdNbed]</td>
                    <td><center>$isi[SellingCurr].$isi[SingleSell]</td>
                    <td><center>$isi[SellingCurr].$isi[TaxInsSell]</td>
                    <td><center>$tips</td>
                    <td><center>$isi[AirTaxCurr]. ".number_format($isi[AirTaxSell], 0, ',', '.');echo"</td>";
                if($isi[VisaSell]<>'' and $isi[VisaSell]<>'0')
                {
                    echo"<td><center>$isi[VisaCurr]. ".number_format($isi[VisaSell], 0, ',', '.');echo"</td>";
                }
                if($isi[VisaSell2]<>'' and $isi[VisaSell2]<>'0')
                {
                    echo"<td><center>$isi[VisaCurr2]. ".number_format($isi[VisaSell2], 0, ',', '.');echo"</td>";
                }
                echo "</tr>";

                echo "</table>
          <font size='1'>* AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** HARGA TOUR BELUM TERMASUK PPN 1%
                                        </font><br>";
                if($isi[Insurance]=='INCLUDE'){echo"<center><img src='images/panoramasure.png'>";}echo"
          <br><center><font size=1><b>JADWAL PERJALANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font>";
                // FORMAT SERIES
            }else{
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
                            if($flight[AirDate]=='0000-00-00'){
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
                echo"
          <font size=2><b>MINIMUM KEBERANGKATAN 20 PESERTA DEWASA:</b></font>
          <table><tr><th width='80' rowspan='2' style=vertical-align:middle>DEWASA TWIN SHARE</th><th colspan='3'>ANAK-ANAK (2 - 11 TAHUN)</th>
                <th width=60 rowspan='2' style=vertical-align:middle>SGL SUPP</th><th width='80' rowspan='2' style=vertical-align:middle>APO TAX INTL*</th>
                <th width='70' rowspan='2' style=vertical-align:middle>TIPPING**</th><th width='80' rowspan='2' style=vertical-align:middle>APO TAX JAKARTA</th>";
                if($isi[VisaSell]<>'' and $isi[VisaSell]<>'0')
                {$Qvisa=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy01]'");
                    $Dvisa=mysql_fetch_array($Qvisa);
                    echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $Dvisa[Country]</th>";
                }
                if($isi[VisaSell2]<>'' and $isi[VisaSell2]<>'0')
                {$Qvisa=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$isi[Embassy02]'");
                    $Dvisa=mysql_fetch_array($Qvisa);
                    echo"<th width='90' rowspan='2' style=vertical-align:middle>VISA $Dvisa[Country]</th>";
                }
                echo "</tr><tr><th width=70>TWIN SHARE</th><th width=70>EXTRA BED</th><th width=70>NO BED</th>
                <tr><td><center>$isi[SellingCurr].$isi[SellingAdlTwn]</td></td>
                    <td><center>$isi[SellingCurr].$isi[SellingChdTwn]</td>
                    <td><center>$isi[SellingCurr].$isi[SellingChdXbed]</td>
                    <td><center>$isi[SellingCurr].$isi[SellingChdNbed]</td>
                    <td><center>$isi[SellingCurr].$isi[SingleSell]</td>
                    <td><center>$isi[SellingCurr].$isi[TaxInsSell]</td>
                    <td><center>$tips</td>
                    <td><center>$isi[AirTaxCurr]. ".number_format($isi[AirTaxSell], 0, ',', '.');echo"</td>";
                if($isi[VisaSell]<>'' and $isi[VisaSell]<>'0')
                {
                    echo"<td><center>$isi[VisaCurr]. ".number_format($isi[VisaSell], 0, ',', '.');echo"</td>";
                }
                if($isi[VisaSell2]<>'' and $isi[VisaSell2]<>'0')
                {
                    echo"<td><center>$isi[VisaCurr2]. ".number_format($isi[VisaSell2], 0, ',', '.');echo"</td>";
                }
                echo "</tr>";

                echo "</table>
          <font size='1'>* AIRPORT TAX & FUEL SURCHARGE DAPAT BERUBAH SEWAKTU-WAKTU<br>
                        ** TIPPING ADALAH UNTUK TOUR LEADER, LOCAL GUIDE & LOCAL DRIVER, TIDAK TERMASUK PORTER HOTEL<br>
                        *** HARGA TOUR BELUM TERMASUK PPN 1%
                                        </font><br>";
                if($isi[Insurance]=='INCLUDE'){echo"<center><img src='images/panoramasure.png'>";}echo"
          <br><center><font size=1><b>JADWAL PERJALANAN/HOTEL/PESAWAT/HARGA TOUR DAPAT BERUBAH SEWAKTU-WAKTU<br>
                                        DENGAN/TANPA PEMBERITAHUAN TERLEBIH DAHULU UNTUK MENYESUAIKAN KEADAAN
                                        </b></font>";
            }
            echo "</td></tr></table>
         <iframe src='printitin.php?id=$isi[IDProduct]' name='tbfprint' style='visibility: hidden' height='0' width='0' frameborder='0'>
          </iframe>
          <input type='button' value='PRINT' onClick=frames['tbfprint'].print() > <input type=button value='Back' onclick=self.history.back()>";
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
            else if($isi[GroupType]=='TUR EZ'){$logo='images/PTITUREZ.png';}
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
            else if($isi[GroupType]=='TUR EZ'){$logo='images/PTITUREZ.png';}
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
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msitin'>";
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

}
?>
