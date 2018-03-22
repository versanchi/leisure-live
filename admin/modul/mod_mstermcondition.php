<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>

<script type="text/javascript" src="./fckeditor/ckeditor.js"></script>
<?php
include "../config/koneksi.php";
include "../config/fungsi_an.php";

switch($_GET[act]) {
    // Tampil Search Tour code
    default:

        $hariini = date("Y-m-d ");
        $IDProduct = $_GET['nama'];
        $ambil = mysql_query("SELECT * FROM tour_termncondition");
        $isi = mysql_fetch_array($ambil);

        if ($isi[ProductTipping] == '0') {
            $tips = '';
        } else {
            $tips = $isi[ProductTipping];
        }
        if ($isi[GroupType] == 'CRUISE') {
            $logo = 'images/PTICruise.png';
        } else if ($isi[Department] == 'TUR EZ') {
            $logo = 'images/PTITUREZ.png';
        } else {
            $logo = 'images/PTIExperience.png';
        }
        echo "<img src='$logo'><br>
            Term & Condition<br>
            <form name='example' method='POST' action='?module=mstermcondition&act=input' enctype='multipart/form-data'>
            <input type=hidden name='id' value='$IDProduct'>
            <textarea id='inf' name='term'>$isi[termcondition]</textarea>
          "; ?>
        <script type="text/javascript">
            //<![CDATA[
            CKEDITOR.replace(inf, {
                extraPlugins: 'autogrow',
                autoGrow_maxHeight: '850',
                height: '850px',
                width: '800px',
                removePlugins: 'resize',
                resize_dir: 'vertical'
            });
            //]]>
        </script><?PHP echo "
            <br><center><input type='submit' value='Save'> <input type=button value='Close' onclick=location.href='?module=msproduct'>
            </form>";

        break;

    case "input":
        $edit = mysql_query("UPDATE tour_termncondition SET termcondition = '$_POST[term]'");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mstermcondition'>";
        break;
}
?>
