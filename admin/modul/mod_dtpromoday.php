<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        //    -- Datepicker
        $(".my_date").datepicker({
            dateFormat: 'yy-mm-dd',
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
            $('#'+thisTableId + " tr:last td :input").val('0');

            // new rows datepicker need to be re-initialized
            $(newRow).find("select").each(function(){
                // if($(this).hasClass("hasDatepicker")){ // if the current input has the hasDatpicker class
                var this_id = $(this).attr("id"); // current inputs id
                var new_id = this_id +1; // a new id
                $(this).attr("id", new_id); // change to new id
                // $(this).attr("value", new_id);
                $(this).removeClass('hasDatepicker'); // remove hasDatepicker class
                // re-init datepicker
                $(this).datepicker({
                    dateFormat: 'yy-mm-dd',
                    showButtonPanel: true ,
                });
                //   }

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
<script type="text/javascript">
    function isNumber(field) {
        var re = /^[0-9'.']*$/;
        if (!re.test(field.value)) {
            alert('PLEASE INPUT NUMBER!');
            field.value = field.value.replace(/[^0-9'.']/g,"");
        }
    }
    function outhouse()
    {
        document.example.elements['inhousebso'].disabled=true;
        document.example.elements['inhousebso'].value='';
    }
    function inhouse()
    {
        document.example.elements['inhousebso'].disabled=false;
    }
    function validateFormOnSubmit(theForm) {
        var reason = "";
        reason += validateEmpty(theForm.event);
        reason += validateDate(theForm.datefrom);
        reason += validateDateto(theForm.dateto);

        if (reason != "") {
            alert("Some fields need correction:\n" + reason);
            return false;
        }

        return true;
    }

    function validateEmpty(fld) {
        var error = "";

        if (fld.value.length == 0) {
            fld.style.background = 'Yellow';
            error = "The required field has not been filled in.\n"
        } else {
            fld.style.background = 'White';
        }
        return error;
    }
    function validateDate(fld) {
        var error = "";
        var dep = fld.value;
        var date = new Date(dep);
        var d  = date.getDate();
        var day = (d < 10) ? '0' + d : d;
        var m = date.getMonth() + 1;
        var month = (m < 10) ? '0' + m : m;
        var yy = date.getYear();
        var year = (yy < 1000) ? yy + 1900 : yy;
        var depdate = year + "/" + month + "/" + day ;

        var dates = new Date();
        var ds  = dates.getDate();
        var days = (ds < 10) ? '0' + ds : ds;
        var ms = dates.getMonth() + 1;
        var months = (ms < 10) ? '0' + ms : ms;
        var yys = dates.getYear();
        var years = (yys < 1000) ? yys + 1900 : yys;
        var sekarang = years + "/" + months + "/" + days ;
        if (fld.value.length == 0) {
            fld.style.background = 'Yellow';
            error = "Date from has not been select.\n"
        } else if (depdate < sekarang) {
            fld.style.background = 'Yellow';
            error = "Please choose event date(from) large than today.\n"
        } else {
            fld.style.background = 'White';
        }
        return error;
    }
    function validateDateto(fld) {
        var error = "";
        var arr = fld.value;
        var date = new Date(arr);
        var d  = date.getDate();
        var day = (d < 10) ? '0' + d : d;
        var m = date.getMonth() + 1;
        var month = (m < 10) ? '0' + m : m;
        var yy = date.getYear();
        var year = (yy < 1000) ? yy + 1900 : yy;
        var arrdate = year + "/" + month + "/" + day ;

        var dep = example.datefrom.value;
        var dates = new Date(dep);
        var ds  = dates.getDate();
        var days = (ds < 10) ? '0' + ds : ds;
        var ms = dates.getMonth() + 1;
        var months = (ms < 10) ? '0' + ms : ms;
        var yys = dates.getYear();
        var years = (yys < 1000) ? yys + 1900 : yys;
        var depdate = years + "/" + months + "/" + days ;

        if (fld.value.length == 0) {
            fld.style.background = 'Yellow';
            error = "Date to has not been select.\n"
        } else if (depdate > arrdate) {
            fld.style.background = 'Yellow';
            error = "Please choose date(to) large than date(from).\n"
        } else {
            fld.style.background = 'White';
        }
        return error;
    }

</script>
<?php
session_start();
switch($_GET[act]){
    // Tampil User
    default:
        $datenow = date("d", time());
        $monthnow = date("m", time());
        $monthnext = date("m", time())+1;
        $yearnow = date("Y", time());
        $today = $yearnow."-".$monthnow."-".$datenow;
        $firstday = $yearnow."-".$monthnow."-01";
        $lastday = $yearnow."-".$monthnext."-01";
        echo "<h2>Promo Day</h2>
          <input type=button value='Add' onclick=location.href='?module=dtpromoday&act=tambahpromoday'>
          <table class='bordered'>
          <tr><th>no</th><th>Promo</th><th>date</th><th>status</th><th>action</th></tr>";
        $tampil=mysql_query("SELECT * FROM tour_promoday WHERE DateTo >= '$today' ORDER BY DateFrom ASC ");
        $no=1;
        while ($r=mysql_fetch_array($tampil)){
            if($r[InhouseBSO]==''){$inbso="<a href=?module=dtpromoday&act=crewpromoday&id=$r[MarketingID]>Staff</a>";}else{{$inbso='Staff';}}
            $DF = date('d M Y', strtotime($r[DateFrom]));
            $DT = date('d M Y', strtotime($r[DateTo]));
            echo "<tr><td>$no</td>
             <td>$r[Event]</td>
             <td>$DF until $DT</td>
             <td>$r[Status]</td>  
             <td><center>$inbso | <a href=?module=dtpromoday&act=editpromoday&id=$r[MarketingID]>Edit</a> 
             </td></tr>";
            $no++;
        }
        echo "</table>";
        break;

    case "tambahpromoday":
        $datenow = date("d", time());
        $monthnow = date("m", time());
        $yearnow = date("Y", time());
        $today = $yearnow."-".$monthnow."-".$datenow;
        //<tr><td>Agents</td><td> <textarea name='agent' cols=56 rows=3></textarea></td></tr>
        echo "<h2>New Promo</h2>
          <form name=example method=POST onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=dtpromoday&act=input'>
          <table class='bordered'>
          <tr><td>Promo Name</td><td><input type=text name='event' size='50'></td></tr>
          <tr><td>Date</td> <td>From <input type='text' name='datefrom' size='10'  onClick="."cal.select(document.forms['example'].datefrom,'ActIn1','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(dd-mm-yyyy)</font>
          - To <input type=text name='dateto' size='10'  onClick="."cal.select(document.forms['example'].dateto,'anchor2','dd-MM-yyyy'); return false;"." NAME='anchor2' ID='anchor2'>
           <font color='red'>(dd-mm-yyyy)</font></td></tr>
          <tr><td>Extra Disc</td><td>
          <table style='border:0'><tr><td style='border:0'>
          Low Season </td><td style='border:0'>IDR. <input type='hidden' name='xtradisccurr' value='IDR'>
          <input type=text name='xtradisc' size='10' onkeyup='isNumber(this)'></td></tr>
          <tr><td style='border:0'>
          High Season </td><td style='border:0'>IDR. <input type='hidden' name='xtradisccurr2' value='IDR'>
          <input type=text name='xtradisc2' size='10' onkeyup='isNumber(this)'></td></tr>
          </table>
          </td></tr>
          <tr><td>Remarks</td> <td>  <textarea rows='3' cols='40' name='remarks'></textarea></td></tr>
          <tr><td>Status</td><td><select name='status'><option value='FIX' selected>FIX</option>
                                                       <option value='TENTATIF'>TENTATIF</option>
                                                       <option value='CANCEL'>CANCEL</option>
                                </select></td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
        break;

    case "editpromoday":
        $edit=mysql_query("SELECT * FROM tour_promoday WHERE MarketingID ='$_GET[id]'");
        $r=mysql_fetch_array($edit);
        $DF = date('d-m-Y', strtotime($r[DateFrom]));
        $DT = date('d-m-Y', strtotime($r[DateTo]));
        if($r[Type]=='INHOUSE'){$inbso='enabled';}else{$inbso='disabled';}
        //<tr><td>Agents</td><td> <textarea name='agent' cols=56 rows=3>$r[Agent]</textarea></td></tr>
        echo "<h2>Edit Promo</h2>
          <form name='example' method=POST action=./aksi.php?module=dtpromoday&act=update>
          <input type=hidden name=id value='$r[MarketingID]'>
          <table class='bordered'>
          <tr><td>Promo Name</td><td><input type=text name='event' size='50' value='$r[Event]'></td></tr>
          <tr><td>Date</td> <td>From <input type='text' value='$DF' name='datefrom' size='10'  onClick="."cal.select(document.forms['example'].datefrom,'ActIn1','dd-MM-yyyy'); return false;"." NAME='anchor3' ID='ActIn1'>
           <font color='red'>(dd-mm-yyyy)</font>
          - To <input type=text value='$DT' name='dateto' size='10'  onClick="."cal.select(document.forms['example'].dateto,'anchor2','dd-MM-yyyy'); return false;"." NAME='anchor2' ID='anchor2'>
           <font color='red'>(dd-mm-yyyy)</font></td></tr>
          <tr><td>Extra Disc</td><td>
          <table style='border:0'><tr><td style='border:0'>
          Low Season</td><td style='border:0'>IDR.
          <input type='hidden' name='xtradisccurr' value='IDR'> <input type=text name='xtradisc' value='$r[XtraDisc]' size='10' onkeyup='isNumber(this)'></td></tr>
                  <tr><td style='border:0'>
                  High Season</td><td style='border:0'>IDR.
                  <input type='hidden' name='xtradisccurr2' value='IDR'> <input type=text name='xtradisc2' value='$r[XtraDisc2]' size='10' onkeyup='isNumber(this)'></td></tr>
          </table>
          </td></tr>
          <tr><td>Remarks</td> <td>  <textarea rows='3' cols='40' name='remarks'>$r[Remarks]</textarea></td></tr>
          <tr><td>Status</td><td><select name='status'><option value='FIX' ";if($r[Status]=='FIX'){echo"selected";}echo">FIX</option>
                                                       <option value='TENTATIF' ";if($r[Status]=='TENTATIF'){echo"selected";}echo">TENTATIF</option>
                                                       <option value='CANCEL' ";if($r[Status]=='CANCEl'){echo"selected";}echo">CANCEL</option>
                                </select></td></tr>
          <tr><td colspan=2><center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
        break;

    case "crewpromoday":
        $edit=mysql_query("SELECT * FROM tour_promoday WHERE MarketingID ='$_GET[id]'");
        $r=mysql_fetch_array($edit);

        echo "<h2>Staff for $r[Event]</h2>
          <form method='POST' name='example' action=./aksi.php?module=crewpromoday&act=update>
          <input type=hidden name=id value='$r[MarketingID]'>
          <input type=hidden name='event' value='$r[event]'>
          <table id='crew' border='1' class='bordered'>";
        $i=0;
        $coba=mysql_query("SELECT * FROM tour_crewpromoday where IDEvent ='$_GET[id]' ");
        $baris=mysql_num_rows($coba);
        if ($baris==0){
            echo"<tr>
                     <td>Employee <img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' />&nbsp</td>
                     <td><img src='../images/add.png' class='cloneTableRows' /> &nbsp <select name='employee[]' >
                      <option value='0' selected>- Select Employee -</option>";
            $tampil=mysql_query("SELECT tbl_msoffice.office_key,tbl_msoffice.office_code,tbl_msemployee.employee_name,tbl_msemployee.employee_code
                                        FROM tbl_msemployee
                                        left join tbl_msoffice on tbl_msemployee.office_id = tbl_msoffice.office_id
                                        where tbl_msemployee.active = '1'
                                        AND tbl_msoffice.active = '1'
                                        AND tbl_msoffice.office_category = 'SALES OUTLET'
                                        order by tbl_msemployee.employee_name ASC");
            while($w=mysql_fetch_array($tampil)){
                echo "<option value='$w[employee_code]'>$w[employee_name] ($w[office_code])</option>";

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
          <td>Employee <img src='../images/delete.png' alt='' class='delRow' $vis />&nbsp</td>
          <td><img src='../images/add.png' class='cloneTableRows' /> &nbsp <select name='employee[]' >
          <option value='0' selected>- Select Employee -</option>";
                $tampil=mysql_query("SELECT tbl_msoffice.office_key,tbl_msoffice.office_code,tbl_msemployee.employee_name,tbl_msemployee.employee_code
                                        FROM tbl_msemployee
                                        left join tbl_msoffice on tbl_msemployee.office_id = tbl_msoffice.office_id
                                        where tbl_msemployee.active = '1'
                                        AND tbl_msoffice.active = '1'
                                        AND tbl_msoffice.office_category = 'SALES OUTLET'
                                        order by tbl_msemployee.employee_name ASC");
                while($w=mysql_fetch_array($tampil)){
                    if ($tes[IDEmployee]==$w[employee_code]){
                        echo "<option value='$w[employee_code]' selected>$w[employee_name] ($w[office_code])</option>";
                    } else {
                        echo "<option value='$w[employee_code]'>$w[employee_name] ($w[office_code])</option>";
                    }
                }
                echo "</select></td></tr>";$i++;}echo"
          </table>";
        }
        echo"
          <center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()>
          </form>";
        break;
}

?>
