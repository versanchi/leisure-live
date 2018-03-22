<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>         
<script type="text/javascript" src="../head/editable-select.js"></script>
<script language="JavaScript"  type="text/javascript">
    function PopupCenter(pageURL, ID,w,h) {
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    }
    function delfile(ID, SUPPLIER, cat,no) {
        if (confirm("Are you sure you want to delete " + SUPPLIER +" ("+ cat +") "))
        {
            window.location.href = '?module=msbookingdummy&act=deletedetail&id=' + ID + '&no=' + no ;

        }
    }
    function delattach(ID, ATTACHFILE) {
        if (confirm("Are you sure you want to delete " + ATTACHFILE +" "))
        {
            window.location.href = '?module=msbookingdummy&act=delattach&id=' + ID;

        }
    }
    function publishprod(ID) {
        window.location.href = '?module=msbookingdummy&act=publishmsbookingdummy&id=' + ID ;
    }
    function ceking(ID) {

        window.location.href = '?module=msbookingdummy&act=cekseat&id=' + ID  ;

    }
    function hello(string){
        var name=string
        document.getElementById('myseat').value=name;
    }
    function isNumber(field) {
        var re = /^[0-9'.']*$/;
        if (!re.test(field.value)) {
            alert('PLEASE INPUT NUMBER!');
            field.value = field.value.replace(/[^0-9'.']/g,"");
        }
    }
    function jumlahin(){
        var a = example.jumsit;
        var n1 = eval(example.adultpax.value);
        var n2 = eval(example.childpax.value);
        a.value = (n1 + n2) ;
        if (isNaN(a.value)) {
            a.value=0 ;
        }
    }
    function jumlahtotal(){
        var at = example.adulttotal;
        var ct = example.childtotal;
        var it = example.infanttotal;
        var n1 = eval(example.adultpax.value);var m1 = eval(example.atawal.value);
        var n2 = eval(example.childpax.value);var m2 = eval(example.ctawal.value);
        var n3 = eval(example.infantpax.value);var m3 = eval(example.itawal.value);
        at.value = (n1 + m1) ;
        if (isNaN(at.value)) {
            at.value=m1 ;
        }
        ct.value = (n2 + m2) ;
        if (isNaN(ct.value)) {
            ct.value=m2 ;
        }
        it.value = (n3 + m3) ;
        if (isNaN(it.value)) {
            it.value=m3 ;
        }
    }
    function bukasubmit(){
        nama=example.bookersname.value;
        telp=example.bookerstelp.value;
        adult=example.adultpax.value;
        child=example.childpax.value;
        infant=example.infantpax.value;
        depamount=example.depositamount.value;
        var statusprod = example.statuspo.value;
        var ijin = example.ijin.value;
        if(statusprod=='GUARANTEE' && ijin=='TIDAK') {
            if (nama.length == 0 || telp.length == 0 || adult.length == 0 || child.length == 0 || infant.length == 0 || depamount.length == 0) {
                document.example.elements['submit'].disabled = true;
            } else {
                document.example.elements['submit'].disabled = false;
            }
        }else{
            if (nama.length == 0 || telp.length == 0 || adult.length == 0 || child.length == 0 || infant.length == 0 ) {
                document.example.elements['submit'].disabled = true;
            } else {
                document.example.elements['submit'].disabled = false;
            }
        }
    }
    function validateAddOnSubmit(theForm) {
        var reason = "";
        reason += validateEmpty(theForm.adultpax);
        reason += validateEmpty(theForm.childpax);
        reason += validateEmpty(theForm.infantpax);
        reason += validateCek(theForm.adultpax);
        reason += validateDate(theForm.depositdate);
        if (reason != "") {
            alert("Some fields need correction:\n" + reason);
            document.example.elements['submit'].disabled=false;
            return false;
        }

        return true;
    }
    function validateFormOnSubmit(theForm) {
        var reason = "";
        reason += validateEmpty(theForm.bookersname);
        reason += validateEmpty(theForm.bookerstelp);
        reason += validateEmail(theForm.bookersemail);
        //reason += validateEmpty(theForm.adultpax);
        //reason += validateEmpty(theForm.childpax);
        //reason += validateEmpty(theForm.infantpax);
        reason += validateEmpty(theForm.totalroom);
        reason += validateCek(theForm.adultpax);
        if (reason != "") {
            alert("Some fields need correction:\n" + reason);
            document.example.elements['submit'].disabled=false;
            return false;
        }

        return true;
    }
    function validatePhone(fld) {
        var error = "";
        var stripped = fld.value.replace(/[\(\)\.\-\ ]/g, '');

        if (fld.value == "") {
            fld.style.background = 'white';
        } else if (isNaN(stripped)) {
            error = "The number contains illegal characters.\n";
            fld.style.background = 'Yellow';
        } else if (!(stripped.length > 0)) {
            error = "The number is the wrong length.\n";
            fld.style.background = 'Yellow';
        }
        return error;
    }
    function validatePhone1(fld) {
        var error = "";
        //var stripped = fld.value.replace(/[\(\)\.\-\ ]/g, '');
        var illegalChars= /[\(\)\<\>\,\;\:\-\\\"\[\]]/ ;
        if (fld.value == "") {
            error = "You didn't enter a number.\n";
            fld.style.background = 'Yellow';
        } else if (fld.value.match(illegalChars)) {
            fld.style.background = 'Yellow';
            error = "The number contains illegal characters.\n";
        } else if (fld.value <= 0) {
            error = "Please input number > than 0.\n";
            fld.style.background = 'Yellow';
        } else {
            fld.style.background = 'White';
        }
        return error;
    }
    function trim(s) {
        return s.replace(/^\s+|\s+$/, '');
    }
    function validateEmail(fld) {
        var error="";
        var tfld = trim(fld.value);                        // value of field with whitespace trimmed off
        var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
        var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;

        if (fld.value != "") {
            //  fld.style.background = 'Yellow';
            //   error = "You didn't enter an email address.\n";
            //} else
            if (!emailFilter.test(tfld)) {              //test email for illegal characters
                fld.style.background = 'Yellow';
                error = "Please enter a valid email address.\n";
            } else if (fld.value.match(illegalChars)) {
                fld.style.background = 'Yellow';
                error = "The email address contains illegal characters.\n";
            } else {
                fld.style.background = 'White';
            }
        }
        return error;
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
    function validateIsi(fld) {
        var error = "";
        var statusprod = example.statuspo.value;
        var depamount = example.depositamount.value;
        var ijin = example.ijin.value;

        if (fld.value.length > 1 && depamount.length == 0) {
            fld.style.background = 'Yellow';
            error = "Your Deposit Not Found.\n"
        } else {
            if(statusprod=='GUARANTEE' && ijin=='TIDAK'){
                if (fld.value.length == 0){
                    error = "GUARANTEE SEAT Need Deposit.\n"
                    //error = "CONTACT OPERATION FOR HOLD BOOKING.\n"
                }else{
                    fld.style.background = 'White';
                }
            }else{
                fld.style.background = 'White';
            }
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
        if (fld.value != "") {
            if (depdate > sekarang) {
                fld.style.background = 'Yellow';
                error = "Deposit date large than today.\n"
            } else {
                fld.style.background = 'White';
            } <!-- ferry suruh lompatin dulu karena cuti 5 jan 2015 !-->
        }
        return error;
    }
    function validateCek(fld) {
        var error = "";
        var arr = eval(example.jumsit.value);
        var dep = eval(example.myseat.value);

        if(arr==0){
            fld.style.background = 'Yellow';
            error = "Please Input Min 1 Pax.\n"
        }else{
            if (dep < arr) {
                fld.style.background = 'Yellow';
                error = "Available seat only " + dep + " .\n"
            } else {
                fld.style.background = 'White';
            }
        }
        return error;
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
</script>
<SCRIPT type="text/javascript">
    pic1 = new Image(16, 16);
    pic1.src = "./modul/loader.gif";
    function cekdeposit() {

        var usr = $("#depositno").val();

        if(usr.length >= 1)
        {
            $("#status").html('<img src="./modul/loader.gif" align="absmiddle">&nbsp;Checking duplicate...');

            $.ajax({
                type: "POST",
                url: "./modul/checkdep.php",
                data: { depositno: usr },
                success: function(msg){

                    $("#status").ajaxComplete(function(event, request, settings){

                        if(msg == 'OK')
                        {
                            $("#depositno").removeClass('object_error'); // if necessary
                            $("#depositno").addClass("object_ok");
                            $(this).html('&nbsp;<img src="./modul/tick.gif" align="absmiddle">');
                            document.example.elements['dobel'].disabled=true;

                        }
                        else
                        {
                            $("#depositno").removeClass('object_ok'); // if necessary
                            $("#depositno").addClass("object_error");
                            $(this).html(msg);
                            document.example.elements['dobel'].disabled=false;

                        }

                    });

                }

            });

        }
        else
        {
            $("#status").html('<font color="red">Deposit should have at least <strong>1</strong> characters.</font>');
            $("#depositno").removeClass('object_ok'); // if necessary
            $("#depositno").addClass("object_error");
        }

    }
    function cekdepositptes() {

        var usr = $("#depositno").val();
        var company = $("#company").val();

        $("#status").html('<img src="./modul/loader.gif" align="absmiddle">&nbsp;Checking deposit...');

        $.ajax({
            type: "POST",
            url: "./modul/checkdepptes.php",
            data: { depositno: usr ,comp: company },
            success: function(msg){

                $("#status").ajaxComplete(function(event, request, settings){
                    hasil = msg.split("-");
                    var stat = hasil[0];
                    var curr = hasil[1];
                    var amount = hasil[2];
                    if(msg == 'NO')
                    {
                        $("#depositno").removeClass('object_ok'); // if necessary
                        $("#depositno").addClass("object_error");
                        $(this).html('<font color="red">PLEASE CREATE NEW DEPOSIT FIRST.</font>');
                        example.depositcurr.value='';
                        example.depositamount.value='';
                        bukasubmit()
                    }
                    else if(stat == 'DP')
                    {
                        $("#depositno").removeClass('object_ok'); // if necessary
                        $("#depositno").addClass("object_error");
                        $(this).html('<font color="red">Deposit: <STRONG>'+usr+'</STRONG> is duplicate.</font>');
                        document.example.elements['dobel'].disabled=false;
                        example.depositcurr.value=curr;
                        example.depositamount.value=amount;
                        bukasubmit()
                    }
                    else
                    {
                        $("#depositno").removeClass('object_error'); // if necessary
                        $("#depositno").addClass("object_ok");
                        $(this).html('&nbsp;<img src="./modul/tick.gif" align="absmiddle">');
                        document.example.elements['dobel'].disabled=true;
                        example.depositcurr.value=curr;
                        example.depositamount.value=amount;
                        bukasubmit()
                    }


                });

            }

        });

    }
    //-->
</SCRIPT>
<?php
$filt=mssql_query("SELECT DivisiNO,Employee.DivisiID,EmployeeID,Category,EmployeeName,CompanyGroup,LTMAuthority FROM [HRM].[dbo].[Employee]
                  inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                  WHERE EmployeeID = '$_SESSION[employee_code]'");
$filter=mssql_fetch_array($filt);
$EmpOff=$_SESSION[employee_office];
$team=$filter[DivisiID];
$ltm_authority=$filter['LTMAuthority'];
$offgroup=$filter[CompanyGroup];
switch($_GET[act]){
  // Tampil Office
  default:
      $hariini = date("Y-m-d ");
	  $nama=$_GET['nama'];
      $nama2=$_GET['nama2'];
      $opnama=$_GET['opnama'];
      $opnama2=$_GET['opnama2'];
      $grup=$_GET['group'];
      if($grup==''){$grup=3;}
      $gr=mysql_query("SELECT * FROM tour_msgroup                                                  
                                WHERE IDGroup = '$grup'");
      $grp=mysql_fetch_array($gr);
      $grouptype = $grp['GroupName'];
    echo "<h2>DUMMY BOOKING - PRODUCT $grouptype</h2>
          Search By :  
          <form method='get' action='media.php?'>
                <input type=hidden name=module value='msbookingdummy'><input type=hidden name='group' value='$grup'>
              <select name='opnama'><option value=''";if($opnama==''){echo"selected";}echo">- please select -</option>
                                    <option value='TourCode'";if($opnama=='TourCode'){echo"selected";}echo">Tour Code</option>
                                    <option value='DateTravelFrom'";if($opnama=='DateTravelFrom'){echo"selected";}echo">Departure Date</option>
                                    <option value='Flight'";if($opnama=='Flight'){echo"selected";}echo">Flight</option>
                                    <option value='Destination'";if($opnama=='Destination'){echo"selected";}echo">Destination</option>
                                    <option value='tour_msproductcode.Productcode'";if($opnama=='tour_msproductcode.Productcode'){echo"selected";}echo">Product</option>
                                    <option value='DaysTravel'";if($opnama=='DaysTravel'){echo"selected";}echo">Days</option>
              </select> <input type=text name='nama' value='$nama' size=20><br>
              <select name='opnama2'><option value=''";if($opnama==''){echo"selected";}echo">- please select -</option>
                                    <option value='TourCode'";if($opnama2=='TourCode'){echo"selected";}echo">Tour Code</option>
                                    <option value='DateTravelFrom'";if($opnama2=='DateTravelFrom'){echo"selected";}echo">Departure Date</option>
                                    <option value='Flight'";if($opnama2=='Flight'){echo"selected";}echo">Flight</option>
                                    <option value='Destination'";if($opnama2=='Destination'){echo"selected";}echo">Destination</option>
                                    <option value='tour_msproductcode.Productcode'";if($opnama2=='tour_msproductcode.Productcode'){echo"selected";}echo">Product</option>
                                    <option value='DaysTravel'";if($opnama2=='DaysTravel'){echo"selected";}echo">Days</option>
              </select> <input type=text name='nama2' value='$nama2' size=20>   
              <input type=submit name='oke' size='20'value='Search'>
          </form>";
          $oke=$_GET['oke'];
 
          // Langkah 1
          $batas = 20;
          $halaman= $_GET['halaman'];
          if(empty($halaman)){
              $posisi  = 0;
            $halaman = 1;
          } else {
              $posisi = ($halaman-1) * $batas; }
            
            // Langkah 2 
          if($ltm_authority=='PO BRANCH'){
              $filterpo="AND tour_msproduct.InputDivision = '$filter[DivisiID]'";
          }else{
              $filterpo='';
          }

          if($opnama=='' and $opnama2<>''){
              if($ltm_authority=='DEVELOPER'){
                $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama2 LIKE '%$nama2%'
                                and Status = 'PUBLISH'        
                                and DateTravelFrom >= '$hariini'
                                and GroupType = '$grouptype'
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $batas");
              }else{
                $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama2 LIKE '%$nama2%'
                                and Status = 'PUBLISH'        
                                and DateTravelFrom >= '$hariini' 
                                and GroupType = '$grouptype'
                                and Company = '$offgroup'
                                $filterpo
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $batas");
              }
          }else if($opnama2=='' and $opnama<>''){
              if($ltm_authority=='DEVELOPER'){
                  $tampil=mysql_query("SELECT * FROM tour_msproduct
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama LIKE '%$nama%' 
                                and Status = 'PUBLISH'      
                                and DateTravelFrom >= '$hariini'                 
                                and GroupType = '$grouptype'  
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $batas");
              }else{ 
              $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama LIKE '%$nama%' 
                                and Status = 'PUBLISH'      
                                and DateTravelFrom >= '$hariini' 
                                and GroupType = '$grouptype' 
                                and Company = '$offgroup'
                                $filterpo
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $batas");
              }
          }
          else if($opnama2<>'' and $opnama<>''){
              if($ltm_authority=='DEVELOPER'){
                  $tampil=mysql_query("SELECT * FROM tour_msproduct
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama LIKE '%$nama%'
                                AND $opnama2 LIKE '%$nama2%'
                                and Status = 'PUBLISH'       
                                and DateTravelFrom >= '$hariini'                 
                                and GroupType = '$grouptype'   
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $batas");
              }else{ 
              $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE $opnama LIKE '%$nama%'
                                AND $opnama2 LIKE '%$nama2%'
                                and Status = 'PUBLISH'       
                                and DateTravelFrom >= '$hariini' 
                                and GroupType = '$grouptype'
                                and Company = '$offgroup'
                                $filterpo
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $batas");
              }
          }
          else if($optnama=='' and $optnama2==''){
              if($ltm_authority=='DEVELOPER'){
                  $tampil=mysql_query("SELECT * FROM tour_msproduct
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE Status = 'PUBLISH'     
                                and DateTravelFrom >= '$hariini'                
                                and GroupType = '$grouptype'  
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $batas");
              }else{
              $tampil=mysql_query("SELECT * FROM tour_msproduct   
                                left join tour_msproductcode on tour_msproductcode.ProductcodeName = tour_msproduct.ProductCode
                                WHERE Status = 'PUBLISH'     
                                and DateTravelFrom >= '$hariini'
                                and GroupType = '$grouptype'
                                and Company = '$offgroup'
                                $filterpo
                                ORDER BY tour_msproduct.ProductCode ASC,DateTravelFrom ASC LIMIT $batas");
              }
          }
          
            $jumlah=mysql_num_rows($tampil);
            
            if ($jumlah > 0) {
            if($grouptype=='CONSORTIUM'){echo"<font color=red>*please contact operation for seat availability</font>";}
            echo "  <font color='red' size='1'><i>*ONLY $batas PRODUCT SHOW</i></font>
                    <table class='bordered'>
                    <tr><th>no</th><th>product</th><th>tour code</th><th>dest</th><th>days</th><th>departure</th><th>flight</th><th>disc</th><th>seat</th><th>deposit</th><th>available</th><th>hold</th><th>action</th></tr>";
                  $no=$posisi+1;
                    while ($data=mysql_fetch_array($tampil)){
                    $mari=mysql_query("SELECT count(IDBookers)as wow FROM tour_msbookingdummy where TourCode = '$data[TourCode]' and Year = '$data[Year]' and Status = 'VOID' ");
                    $tung=mysql_fetch_array($mari);
                    $maritot=mysql_query("SELECT count(tour_msbookingdummydetail.IDDetail)as tot FROM tour_msbookingdummydetail 
                                        left join tour_msbookingdummy on tour_msbookingdummy.BookingID = tour_msbookingdummydetail.BookingID    
                                        where tour_msbookingdummy.IDTourcode = '$data[IDProduct]' and tour_msbookingdummydetail.Gender <>'INFANT'
                                        AND tour_msbookingdummydetail.Status<>'CANCEL' 
                                        AND tour_msbookingdummy.Status='ACTIVE' ");
                    $tungtot=mysql_fetch_array($maritot);
                    $totl=$tungtot[tot]+1;
                    $d = mysql_query("SELECT * FROM tour_msdiscount 
                                    left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct      
                                    WHERE tour_msproduct.IDProduct = '$data[IDProduct]' and tour_msproduct.Status <> 'VOID' and tour_msdiscount.Status='ACTIVE'");
                    $dd = mysql_fetch_array($d);
                    $julh=mysql_num_rows($d);
                    if($julh>0){
                    if($totl<=$dd[Max1]){$diskon=$dd[Disc1];}
                    else if($totl<=$dd[Max2]){$diskon=$dd[Disc2];}
                    else if($totl<=$dd[Max3]){$diskon=$dd[Disc3];}
                    else if($totl<=$dd[Max4]){$diskon=$dd[Disc4];}
                    else if($totl<=$dd[Max5]){$diskon=$dd[Disc5];}
                    else if($totl<=$dd[Max6]){$diskon=$dd[Disc6];}
                    else if($totl<=$dd[Max7]){$diskon=$dd[Disc7];}
                    else $diskon='0'; 
                    if($diskon==''){$diskon='0';}                                                         
                    }else{$diskon='0';}                          
                    if($data[StatusProduct]=='CLOSE'){$status="<font color=red><b>CLOSE</b></font>";$tom='disabled';$warna="BGCOLOR='#f5bebe'";}
                    else if($data[StatusProduct]=='OPEN' OR $data[StatusProduct]=='GUARANTEE'){$status="<font color=green><b>OPEN</b></font>";$tom='enabled';$warna="BGCOLOR='#ffffff'";}
                     $dtf = date("d-m-Y", strtotime($data[DateTravelFrom]));
               echo "<tr><td $warna>$no</td>
                     <td $warna>$data[ProductCode] - $data[Productcode]</td>                                   
                     <td $warna><a href=?module=msbookingdummy&group=$grup&act=show&id=$data[IDProduct]>$data[TourCode]</a></td>   
                     <td $warna>$data[Destination]</td>
                     <td $warna><center>$data[DaysTravel]</td>
                     <td $warna>$dtf</td>
                     <td $warna><center>$data[Flight]</td>
                     <td $warna><center>$data[SellingCurr] $diskon</td>
                     <td $warna><center>$data[Seat]</td>
                     <td $warna><center><a href=?module=group&act=showdeposit&id=$data[IDProduct]>$data[SeatDeposit]</a></td>
                     <td $warna><center>$data[SeatSisa]</td>
                     <td $warna><center>$data[SeatInquiry]</td> 
                     <td $warna><center><input type=button value='Add Booking' onclick=location.href='?module=msbookingdummy&act=tambahmsbookingdummy&id=$data[IDProduct]' $tom></td></tr>";
                      $no++;
                    }
                    echo "</table>";

            } else {
                echo "<div id='paging'>";
                echo "<br><br>Data Not Found<p>";
                echo "</div>";
            }     

    break;
  
  case "tambahmsbookingdummy": 
          $cari=mssql_query("SELECT DivisiNO,Employee.DivisiID,EmployeeID,Category,EmployeeName,CompanyGroup FROM [HRM].[dbo].[Employee]
                  inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                  WHERE EmployeeID = '$_SESSION[employee_code]'");
          $staff=mssql_fetch_array($cari);
          if($staff[CompanyGroup]=='TUR EZ'){$company=2;}else{$company=1;}
          $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]' AND Status <>'VOID'");
          $r=mysql_fetch_array($edit);
          $QBookingan=mysql_query("SELECT IDTourCode,sum(AdultPax+ChildPax) as pax FROM tour_msbookingdummy WHERE tour_msbookingdummy.Status ='ACTIVE' and  IDTourCode='$r[IDProduct]' ");
          $DBooking=mysql_fetch_array($QBookingan);
          $SeatSisa=$r[Seat] - $DBooking[pax];
          $TmrNo=$_GET[no];
          $thisyear = date("Y", time());
          $nextyear = $thisyear+1;
          $datenow = date("d", time());
          $monthnow = date("m", time());
          $monthnext = date("m", time())+1;
          $yearnow = date("Y", time());
          $today = $yearnow."-".$monthnow."-".$datenow;
          include "../config/koneksifabs.php";
          $carievent=mysql_query("SELECT * FROM tbl_exhibition where StartDate <= '$today' and EndDate >= '$today' and InhouseBSO = '$staff[DivisiID]'");
          $dptevent=mysql_fetch_array($carievent);
          mysql_close($dbfabs);
          include "../config/koneksi.php";
          $err=$_GET[err];
          if($err<>''){$err="<font color='red'><b><i>*Sorry seat not available, please correct your pax value</i></b></font>";}else{$err='';}
    echo "<h2>New DUMMY Booking</h2> $err
          <table style='border: 0px solid #000000;'>
          <tr><td style='border: 0px solid #000000;'>
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=msbooking&act=input' enctype='multipart/form-data'>
          <input type='hidden' name='company' id='company' value='$company'>
          <table class='bordered'><input type='hidden' name='sellcurr' value='$r[SellingCurr]'><input type='hidden' name='tmrno' value='$TmrNo'><input type='hidden' name='exibition' value='$dptevent[ExhibitionID]'>
          <tr><td>Tour Code</td> <td>$r[TourCode]<input type='hidden' name='tourcode' value='$r[TourCode]'><input type='hidden' name='statuspo' value='$r[StatusProduct]'>"; //if($r[StatusProduct]=='GUARANTEE'){echo\" <font color=red><b>(</b></font><input type='text' name='statuspo' value='$r[StatusProduct]' style='border:0px;color:red;font-weight:bold' size='8' readonly><font color=red><b> SEAT)</b></font>\";}
    echo "<input type='hidden' name='clienttype' value='FIT'>
          <input type='hidden' name='idproduct' value='$r[IDProduct]'><input type='hidden' name='year' value='$r[Year]'></td></tr>
          <tr><td>Bookers Name</td> <td><input type=text name='bookersname' onkeyup='bukasubmit()' required></td></tr>
          <tr><td>Telephone</td> <td><input type=text name='bookerstelp' onkeyup='isNumber(this),bukasubmit()' required></td></tr>
          <tr><td>Mobile</td> <td><input type=text name='bookersmobile' onkeyup='isNumber(this)'></td></tr>
          <tr><td>Address</td><td><textarea name='bookersaddress' cols='50' rows='3'></textarea></td></tr>    
          <tr><td>Email</td> <td><input type=text name='bookersemail'></td></tr>
          <tr><td>Emergency Call</td> <td><textarea name='emergencycall' cols='50' rows='3'></textarea></td></tr>
          <input type=hidden name='tcname' value='$staff[EmployeeName]'><input type=hidden name='tcdivision' value='$staff[DivisiID]'>
          <input type=hidden name='officekey' value='$staff[DivisiNO]'>";
          // default ************
    echo "<tr><td>TC Name</td> <td>$staff[EmployeeName] - Division: $staff[DivisiID]</td></tr>";
    echo "<tr><td><b>Alias Name*</b></td> <td><select name='tcnamealias' id='tcnamealias'>";
			if($staff[CompanyGroup]=='TUR EZ')
			{
            	$tampil=mssql_query("SELECT DivisiID,EmployeeID,EmployeeName FROM [HRM].[dbo].[Employee]
                WHERE DivisiID = 'TEZ' AND Active='1' order by EmployeeName ASC");
			}else
			{
				$tampil=mssql_query("SELECT DivisiID,EmployeeID,EmployeeName FROM [HRM].[dbo].[Employee]
                WHERE DivisiID = 'THO' AND Active='1' order by EmployeeName ASC");
			}
            while($s=mssql_fetch_array($tampil)){
                        echo "<option value='$s[EmployeeName]'>$s[EmployeeName]</option>";
            }
    echo "</select><input type='hidden' name='tcempid' value='$staff[EmployeeID]'>";

          // END CODE **************

    echo "<tr><td>Total Pax</td> <td>Adult <input type=text name='adultpax' value='1' size='3' onkeyup='jumlahin(),isNumber(this),bukasubmit()' required>&nbsp
                                     Child <input type=text name='childpax' value='0' size='3' onkeyup='jumlahin(),isNumber(this),bukasubmit()'required >&nbsp
                                     Infant <input type=text name='infantpax' value='0' size='3' onkeyup='isNumber(this),bukasubmit()' required>
          </td></tr>
          <tr><td>Total Room </td> <td><input type=text name='totalroom' value='1' size='3' onkeyup='isNumber(this)'></td></tr>";
          //GROUP           

     echo"<input type='hidden' value='BOLEH' name='ijin'>
          <input type='hidden' value='YES' name='dummy'><input type='hidden' value='PRODUCT' name='officecategory'>

          <input type='hidden' value='$today' name='depositdate' size='10' onClick="."cal.select(document.forms['example'].depositdate,'ActIn1','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn1'>
          <input type='hidden' name='depositno' value=''>
          <input type='hidden' name='depositcurr' value='IDR'>
          <input type='hidden' name='depositamount' value='0' >
          <input type='hidden' name='jumsit' value='1'>
              <input type='hidden' id='myseat' value='$SeatSisa'></td></tr>";
           echo"
          <tr><td colspan=2><center><input type='submit' name='submit' value=Save onclick='this.disabled = true'>
                            <input type=button value=Cancel onclick=location.href='?module=msbookingdummy'></td></tr>
          </table> </form>
          </td><td style='border: 0px solid #000000;'></td><td style='border: 0px solid #000000;'><iframe src='info.php?id=$_GET[id]' width='500' height='800' frameborder='0'></iframe></td></tr></table><br><br>";
     break; 
     
 case "show":
    $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$_GET[id]' AND Status <>'VOID'");
    $r=mysql_fetch_array($edit);
    $cuma = mysql_query("SELECT * FROM tour_msdiscount WHERE IDProduct = '$_GET[id]' and Status = 'ACTIVE'  
                                    ORDER BY IDDiscount DESC limit 1");
    $saja = mysql_fetch_array($cuma);
    $mari=mysql_query("SELECT count(IDDetail)as wow FROM tour_msbookingdummydetail where TourCode = '$r[TourCode]' and Status = 'CANCEL' and Gender <>'INFANT'");
    $tung=mysql_fetch_array($mari);
    $maritot=mysql_query("SELECT count(tour_msbookingdummydetail.IDDetail)as tot FROM tour_msbookingdummydetail 
                                        left join tour_msbookingdummy on tour_msbookingdummy.BookingID = tour_msbookingdummydetail.BookingID
                                        where tour_msbookingdummy.IDTourcode = '$_GET[id]' and tour_msbookingdummydetail.Gender <>'INFANT'
                                        AND tour_msbookingdummydetail.Status<>'CANCEL'
                                        AND tour_msbookingdummy.Status='ACTIVE'");
    $tungtot=mysql_fetch_array($maritot);
    $totl=$tungtot[tot]+1;
    if($r[StatusProduct]=='CLOSE'){$tom='disabled';}
    else if($r[StatusProduct]=='OPEN'){$tom='enabled';}
    $d = mysql_query("SELECT * FROM tour_msdiscount 
                    left join tour_msproduct on tour_msproduct.IDProduct = tour_msdiscount.IDProduct      
                    WHERE tour_msproduct.IDProduct = '$r[IDProduct]' and tour_msproduct.Status <> 'VOID' and tour_msdiscount.Status='ACTIVE'");
    $dd = mysql_fetch_array($d);
    $julh=mysql_num_rows($d);
    if($julh>0){
    if($totl<=$dd[Max1]){$diskon=$dd[Disc1];}
    else if($totl<=$dd[Max2]){$diskon=$dd[Disc2];}
    else if($totl<=$dd[Max3]){$diskon=$dd[Disc3];}
    else if($totl<=$dd[Max4]){$diskon=$dd[Disc4];}
    else if($totl<=$dd[Max5]){$diskon=$dd[Disc5];}
    else if($totl<=$dd[Max6]){$diskon=$dd[Disc6];}
    else if($totl<=$dd[Max7]){$diskon=$dd[Disc7];}
    else $diskon='0'; 
    }else{$diskon='0';}
    $dari = date("d M Y", strtotime($r[DateTravelFrom]));
    $sampai = date("d M Y", strtotime($r[DateTravelTo]));
    $VisaSell=$r[VisaSell]/1000;
    $VisaSell2=$r[VisaSell2]/1000;
    $VisaSell3=$r[VisaSell3]/1000;
    $VisaSell4=$r[VisaSell4]/1000;
    $VisaSell5=$r[VisaSell5]/1000;
    echo "<h2>Detail Product</h2>       
          <table class='bordered'>
          <tr><th colspan=7><center>Selling Price in $r[SellingCurr]<br>
          (HARGA DALAM RIBUAN)</center></th></tr>
          <tr><td colspan=2>Product Code/Name</td> <td colspan=5>  $r[ProductCode]</td></tr>    
          <tr><td colspan=2>Date of Service</td> <td colspan=5>$dari - $sampai</td></tr>
          <tr><td colspan=2>Number of Days</td><td colspan=5> $r[DaysTravel] days</td></tr>   
          <tr><td colspan=2>Flight</td> <td colspan=5>$r[Flight]</td></tr>
          <tr><td colspan=2>Tour Code</td> <td colspan=5>$r[TourCode]</td></tr>  
          
          <tr><td colspan=2>Visa</td> <td colspan=5>$r[Visa] ";if($r[Visa]=='INCLUDE' || $r[Visa]=='NOT INCLUDE'){
            $tampil=mysql_query("SELECT * FROM tbl_msembassy where CountryID = $r[Embassy01]");
            $s=mysql_fetch_array($tampil);
            if($s[Country]<>''){echo"<br>- $s[Country]";}else{}
            $tampil1=mysql_query("SELECT * FROM tbl_msembassy where CountryID = $r[Embassy02]");
            $s1=mysql_fetch_array($tampil1);
            if($s1[Country]<>''){echo"<br>- $s1[Country]";}else{}
            $tampil2=mysql_query("SELECT * FROM tbl_msembassy where CountryID = $r[Embassy03]");
            $s2=mysql_fetch_array($tampil2);
            if($s2[Country]<>''){echo"<br>- $s2[Country]";}else{}
            $tampil3=mysql_query("SELECT * FROM tbl_msembassy where CountryID = $r[Embassy04]");
            $s3=mysql_fetch_array($tampil3);
            if($s3[Country]<>''){echo"<br>- $s3[Country]";}else{}
            $tampil4=mysql_query("SELECT * FROM tbl_msembassy where CountryID = $r[Embassy05]");
            $s4=mysql_fetch_array($tampil4);
            if($s4[Country]<>''){echo"<br>- $s4[Country]";}else{}
          }echo"</td></tr>";
         if($r[Embassy01]<>'0')
         {   $Qvisa=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$r[Embassy01]'");
             $Dvisa=mysql_fetch_array($Qvisa);
             echo"<tr><td colspan=2>VISA $Dvisa[Country]</td><td colspan='6'>IDR. ".number_format($VisaSell, 0, '', '.');echo"</td></tr>";
         }
         if($r[Embassy02]<>'0')
         {   $Qvisa2=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$r[Embassy02]'");
             $Dvisa2=mysql_fetch_array($Qvisa2);
             echo"<tr><td colspan=2>VISA $Dvisa2[Country]</td><td colspan='6'>IDR. ".number_format($VisaSell2, 0, '', '.');echo"</td></tr>";
         }
         if($r[Embassy03]<>'0')
         {   $Qvisa3=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$r[Embassy03]'");
             $Dvisa3=mysql_fetch_array($Qvisa3);
             echo"<tr><td colspan=2>VISA $Dvisa3[Country]</td><td colspan='6'>IDR. ".number_format($VisaSell3, 0, '', '.');echo"</td></tr>";
         }
         if($r[Embassy04]<>'0')
         {   $Qvisa4=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$r[Embassy04]'");
             $Dvisa4=mysql_fetch_array($Qvisa4);
             echo"<tr><td colspan=2>VISA $Dvisa4[Country]</td><td colspan='6'>IDR. ".number_format($VisaSell4, 0, '', '.');echo"</td></tr>";
         }
         if($r[Embassy05]<>'0')
         {   $Qvisa5=mysql_query("SELECT * FROM tbl_msembassy WHERE CountryID='$r[Embassy05]'");
             $Dvisa5=mysql_fetch_array($Qvisa5);
             echo"<tr><td colspan=2>VISA $Dvisa5[Country]</td><td colspan='6'>IDR. ".number_format($VisaSell5, 0, '', '.');echo"</td></tr>";
         }
      echo" <tr><td colspan=2>Domestic Airport Tax</td><td colspan=5>";if($r[AirTaxSell]==0){echo"INCLUDE";}else{echo"$r[AirTaxCurr]. ".number_format($r[AirTaxSell]/1000, 0, '', '.');}echo"</td></tr>
            <tr><td colspan=2>Airport Tax & Flight Insurance</td><td colspan=5>$r[SellingCurr]. ".number_format($r[TaxInsSell]/1000, 0, '', '.');echo"</td></tr>
            <tr><td colspan=2>Single Supplement</td><td colspan=5>$r[SellingCurr]. ".number_format($r[SingleSell]/1000, 0, '', '.');echo"</td></tr>
            <tr><td colspan=2>Seat</td> <td colspan=5>$r[Seat] Pax <font color='red'>*<i>Not Include Infant and Tour leader</i></font></td></tr>";          
            $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r[AttachmentFile]) ) ) );  
      echo" <tr><td colspan=2>Attachment</td><td colspan=5>";
            //if($r[AttachmentFile]==''){
                $cariitin=mysql_query("SELECT * FROM tour_msitin                            
                    WHERE ProductID = '$r[IDProduct]'");
                $adaitin=mysql_num_rows($cariitin);
                if($adaitin>0){
                    echo"<input type='button' value='VIEW ITIN' onclick=location.href='?module=msitin&act=showitin&id=$r[IDProduct]'";
                }else{
                    echo"<i>SORRY, ITIN HAS NOT BEEN CREATED</i>";
                }   
            //}else {
            //    echo"<a href='$r[Attachment]$file' target='_blank' style=text-decoration:none>$r[AttachmentFile]</a> &nbsp<font color='red'>*<i>click for open file</i></font>";
            //}
    echo"   </td></tr>
            <tr><td colspan=2>Remarks</td><td colspan=5>$r[Remarks]</td></tr>";
			
			$sekarang = date("d M Y", strtotime(today));
			$selisih = (strtotime($dari)- strtotime($sekarang))/(60*60*24);
			if ($selisih<7){echo"<tr><td colspan=2>Tour Leader</td><td colspan=5>$r[TourLeader]</td></tr>";}
		    

            echo"";    
          if($r[GroupType]=='CRUISE'){  
    echo "<tr><th></th><th width='160' colspan='2'>ADULT </th><th width='160' colspan='2'>Child</th><th width='160' colspan='2'>Tax</th></tr>
          <tr><th>Cruise</th><th width=80>1-2 PAX</th><th width=80>3-4 PAX</th><th width=80>1-2 PAX</th><th width=80>3-4 PAX</th><th width=80>Sea</th><th width=80>Int</th></tr>
                <tr><th>Tour</th>
                    <td><center>".number_format($r[CruiseAdl12]/1000, 0, '', '.');echo"</td></td>
                    <td><center>".number_format($r[CruiseAdl34]/1000, 0, '', '.');echo"</td>
                    <td><center>".number_format($r[CruiseChd12]/1000, 0, '', '.');echo"</td>
                    <td><center>".number_format($r[CruiseChd34]/1000, 0, '', '.');echo"</td>
                    <td><center>".number_format($r[SeaTaxSell]/1000, 0, '', '.');echo"</td>
                    <td><center>".number_format($r[TaxInsSell]/1000, 0, '', '.');echo"</td>
                </tr>
                <tr><th>Land Only</th>
                    <td><center>".number_format($r[CruiseLoAdl12]/1000, 0, '', '.');echo"</td></td>
                    <td><center>".number_format($r[CruiseLoAdl34]/1000, 0, '', '.');echo"</td>
                    <td><center>".number_format($r[CruiseLoChd12]/1000, 0, '', '.');echo"</td>
                    <td><center>".number_format($r[CruiseLoChd34]/1000, 0, '', '.');echo"</td>
                    <td><center>".number_format($r[SeaTaxSell]/1000, 0, '', '.');echo"</td>
                    <td><center>".number_format($r[TaxInsSell]/1000, 0, '', '.');echo"</td>
                </tr>";
          }else{
          echo "<tr><th></th><th width=80>ADULT</th><th width=80>CHILD TWN</th><th width=80>CHILD X BED</th><th width=80>Child No bed</th><th width=80>Infant</th><th width=80>Tax</th></tr>
                <tr><th>Tour</th>
                    <td><center>".number_format($r[SellingAdlTwn]/1000, 0, '', '.');echo"</td></td>
                    <td><center>".number_format($r[SellingChdTwn]/1000, 0, '', '.');echo"</td>
                    <td><center>".number_format($r[SellingChdXbed]/1000, 0, '', '.');echo"</td>
                    <td><center>".number_format($r[SellingChdNbed]/1000, 0, '', '.');echo"</td>
                    <td><center>".number_format($r[SellingInfant]/1000, 0, '', '.');echo"</td>
                    <td><center>".number_format($r[TaxInsSell]/1000, 0, '', '.');echo"</td>
                </tr>
                <tr><th>LA Only</th>
                    <td><center>".number_format($r[LAAdlTwn]/1000, 0, '', '.');echo"</td></td>
                    <td><center>".number_format($r[LAChdTwn]/1000, 0, '', '.');echo"</td>
                    <td><center>".number_format($r[LAChdXbed]/1000, 0, '', '.');echo"</td>
                    <td><center>".number_format($r[LAChdNbed]/1000, 0, '', '.');echo"</td>
                    <td><center>".number_format($r[LAInfant]/1000, 0, '', '.');echo"</td>
                    <td></td>
                </tr>";    
          }
    echo "
          <tr><th></th><th>disc</th><th>seat</th><th>deposit</th><th>available</th><th>inquiry</th><th>cancel</th></tr>
          <tr><th>Tour</th><td><center>$diskon</td>
                     <td><center>$r[Seat]</td>
                     <td><center>$r[SeatDeposit]</td>
                     <td><center>$r[SeatSisa]</td>
                     <td><center>$r[SeatInquiry]</td>
                     <td><center>$tung[wow]</td></tr>   
          </table>        
          <center><input type=button value='Add Booking' onclick=location.href='?module=msbookingdummy&act=tambahmsbookingdummy&id=$_GET[id]' $tom>
                            <input type=button value=Close onclick=location.href='?module=msbookingdummy&group=$_GET[group]'>
          </form><br><br>";
     break;
  
  case "deviasi":                                                                      
          $cari=mysql_query("SELECT tour_devbooking.DevNo,tour_devbooking.BookingID,tour_devbooking.Status,tour_msbookingdummy.TourCode,tour_msbookingdummy.TCName,tour_msbookingdummy.TCDivision FROM tour_devbooking
                                left join tour_msbookingdummy on tour_msbookingdummy.BookingID = tour_devbooking.BookingID
                                WHERE tour_devbooking.BookingID = '$_GET[id]'");
          $rcari=mysql_num_rows($cari);
    
    echo "<h2>Deviasi Request</h2>
          <input type=button value='New Deviasi' onclick=location.href='?module=msbookingdummy&act=deviasireq&id=$_GET[id]'>";
          
          if($rcari==0){
            echo"<center>DEVIASI HAS NOT BEEN CREATED</center><br>";    
          }else{
            $no=1;
            echo"<table class='bordered'>
            <tr><th>no</th><th>Deviasi No</th><th>booking ID</th><th>TourCode</th><th>TC Name</th><th>deviasi status</th><th>action</th>";
            while($s=mysql_fetch_array($cari)){ 
            echo "<tr><td>$no</td><td>$s[DevNo]</td><td>$s[BookingID]</td><td>$s[TourCode]</td><td>$s[TCName]</td><td>$s[Status]</td><td><input type=button value='View' onclick=location.href='?module=msbookingdummy&act=deviasishow&dev=$s[DevNo]' ";if($s[Status]=='VOID'){echo"disabled";}echo"></td></tr>";
            $no++;
            }
          }echo"</table>
    <center><input type=button value='Back' onclick=self.history.back()><br><br>";
     break;
     
  case "deviasireq":                                                                      
    $edit=mysql_query("SELECT * FROM tour_msbookingdummy WHERE BookingID = '$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $qdev=mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r[TourCode]' and Year= '$r[Year]'");
    $querydev=mysql_fetch_array($qdev);
    $qpnr=mysql_query("SELECT * FROM tour_msproductpnr                                                 
                                        WHERE PnrProd ='$querydev[IDProduct]'");
    $pnr=mysql_fetch_array($qpnr);
    $qflight=mysql_query("SELECT * FROM tour_msprodflight                                                 
                                        WHERE IDGrv ='$pnr[GrvID]' order by FID ASC");
    
    echo "<h2>Deviasi Request #$_GET[id]</h2>";
          $cari=mysql_query("SELECT * FROM tour_msbookingdummydetail where BookingID = '$r[BookingID]' AND Status <> 'CANCEL' AND InfoDeviasi ='' ORDER BY IDDetail ASC");
          $rcari=mysql_num_rows($cari);
          if($rcari==0){
            echo"<center>DEVIASI HAS BEEN CREATED</center><br><center><input type=button value='Close' onclick='self.history.back()'><br><br>";    
          }else{echo"
          <form name='example' method='POST' onsubmit='return validateSwitch(this)' action='./aksi.php?module=msbookingdummy&act=devreq' >  
          <font size=2>Tour Code : $r[TourCode]</font>
          <table class='bordered'><input type='hidden' name='id' value='$r[BookingID]'>
          <tr><th width='200'>Passanger Name</th><th width='100'>Passport No</th></tr>";
            $no=1;
            while($s=mysql_fetch_array($cari)){ 
                    echo "<tr><td><input type='checkbox' name='listing[]' id='listing$no' value='$s[IDDetail]'> $s[Title] $s[PaxName]</td><td>$s[PassportNo]</td></tr>";
            $no++;
            }
    echo "</table>
          <font size=2><u>EXTEND / DEVIASI FROM :</u></font><br>
          <table>
          <tr><th colspan=2>flight</th><th colspan=2>Departure</th><th colspan=2>Arrival</th></tr>
          <tr><th width=75>number</th><th width=50>date</th><th width=100>from</th><th width=50>time</th><th width=100>to</th><th width=50>time</th></tr>";     
          while($isiflight=mysql_fetch_array($qflight)){
          $AD = date('d-m-Y', strtotime($isiflight[AirDate])); 
    echo "<tr><td>$isiflight[AirCode]</td><td><center>$AD</td><td><center>$isiflight[AirRouteDep]</td><td><center>$isiflight[AirTimeDep]</td><td><center>$isiflight[AirRouteArr]</td><td><center>$isiflight[AirTimeArr]</td></tr>";
          }
          echo"</table>
          <table class='bordered'>
          <tr><th width='70'></th><th width='150'>main</th><th width='150'>option 1</th><th width='150'>option 2</th></tr>
          <tr><td>Ticket</td><td><textarea name='ticket1' cols='40' rows='3'></textarea></td><td><textarea name='ticket2' cols='40' rows='3'></textarea></td><td><textarea name='ticket3' cols='40' rows='3'></textarea></td></tr>
          <tr><td>Others</td><td><textarea name='others1' cols='40' rows='3'></textarea></td><td><textarea name='others2' cols='40' rows='3'></textarea></td><td><textarea name='others3' cols='40' rows='3'></textarea></td></tr>
          </table>
          <center><input type='submit' name='submit' value=Save>
                            <input type=button value=Cancel onclick='self.history.back()'>
          </form><br><br>";}
     break; 
     
  case "deviasishow":                                                                      
          $edit=mysql_query("SELECT tour_devbooking.Status,tour_devbooking.DevCurr,tour_devbooking.DevPrice,tour_devbooking.Result,tour_msbookingdummy.TourCode,tour_msbookingdummy.Year,
                            tour_devbooking.Ticket1,tour_devbooking.Ticket2,tour_devbooking.Ticket3,tour_devbooking.Others1,tour_devbooking.Others2,tour_devbooking.Others3 FROM tour_devbooking 
                        left join tour_msbookingdummy on tour_msbookingdummy.BookingID = tour_devbooking.BookingID
                        WHERE DevNo = '$_GET[dev]'");
          $r=mysql_fetch_array($edit);
          $qdev=mysql_query("SELECT * FROM tour_msproduct WHERE TourCode = '$r[TourCode]' and Year= '$r[Year]'");
          $querydev=mysql_fetch_array($qdev);
          $qpnr=mysql_query("SELECT * FROM tour_msproductpnr                                                 
                                        WHERE PnrProd ='$querydev[IDProduct]'");
          $pnr=mysql_fetch_array($qpnr);
          $qflight=mysql_query("SELECT * FROM tour_msprodflight                                                 
                                        WHERE IDGrv ='$pnr[GrvID]' order by FID ASC");
    echo "<h2>Deviasi Detail #$_GET[dev]</h2>";
          $cari=mysql_query("SELECT * FROM tour_devbookingdetail where DevNo = '$_GET[dev]' ORDER BY IDDev ASC");
          echo"
          <form name='example' method='POST' onsubmit='return validateSwitch(this)' action='./aksi.php?module=msbookingdummy&act=devvoid' >  
          <font size=2>Tour Code : $r[TourCode]</font>
          <table class='bordered'><input type='hidden' name='id' value='$_GET[dev]'>
          <tr><th width='200'>Passanger Name</th><th width='100'>Passport No</th></tr>";
            $no=1;
            while($s=mysql_fetch_array($cari)){ 
                    echo "<tr><td>$s[Title] $s[PaxName]</td><td>$s[PassportNo]</td></tr>";
            $no++;
            }
    echo "</table>
          <font size=2><u>EXTEND / DEVIASI FROM :</u></font><br>
          <table class='bordered'>
          <tr><th colspan=2>flight</th><th colspan=2>Departure</th><th colspan=2>Arrival</th></tr>
          <tr><th width=75>number</th><th width=50>date</th><th width=100>from</th><th width=50>time</th><th width=100>to</th><th width=50>time</th></tr>";     
          while($isiflight=mysql_fetch_array($qflight)){
          $AD = date('d-m-Y', strtotime($isiflight[AirDate])); 
    echo "<tr><td>$isiflight[AirCode]</td><td><center>$AD</td><td><center>$isiflight[AirRouteDep]</td><td><center>$isiflight[AirTimeDep]</td><td><center>$isiflight[AirRouteArr]</td><td><center>$isiflight[AirTimeArr]</td></tr>";
          }$harga=number_format($r[DevPrice], 0, '', '.');
          if($r[Result]=='1'){$p1clr1="<font color=red>";$p1clr2=" ($r[DevCurr] $harga)</font>";}
          else if($r[Result]=='2'){$p2clr1="<font color=red>";$p2clr2=" ($r[DevCurr] $harga)</font>";}
          else if($r[Result]=='3'){$p3clr1="<font color=red>";$p3clr2=" ($r[DevCurr] $harga)</font>";}
          echo"</table>
          <table class='bordered'>
          <tr><th width='70'></th>
          <th width='150'>$p1clr1 main$p1clr2</th>
          <th width='150'>$p2clr1 option 1$p2clr2</th>
          <th width='150'>$p3clr1 option 2$p3clr2</th></tr>
          <tr><td>Ticket</td><td><textarea name='ticket1' cols='40' rows='3'>$r[Ticket1]</textarea></td><td><textarea name='ticket2' cols='40' rows='3'>$r[Ticket2]</textarea></td><td><textarea name='ticket3' cols='40' rows='3'>$r[Ticket3]</textarea></td></tr>
          <tr><td>Others</td><td><textarea name='others1' cols='40' rows='3'>$r[Others1]</textarea></td><td><textarea name='others2' cols='40' rows='3'>$r[Others2]</textarea></td><td><textarea name='others3' cols='40' rows='3'>$r[Others3]</textarea></td></tr>
          </table>";   
    echo "<center><input type='submit' name='submit' value='Void' ";if($r[Status]=='VOID' or $r[Result]<>''){echo"disabled";}echo">
                            <input type=button value=Cancel onclick='self.history.back()'>
          </form><br><br>";
     break;
	 
  case "showTBF":
	  $hariini = date("Y-m-d ");
      $batas = date("Y-m-d",(mktime(date("H"), date("i"), date("s"), date("m"), date("d")+14, date("Y"))));
	

	 $TBFdetail=mysql_query("select * from tour_msbookingdummy where status='ACTIVE' 
                            and (AdultPax+ChildPax+InfantPax)>0 
                            and TBFNo ='' 
                            and IDTourcode in (select IDProduct from tour_msproduct where Status<>'VOID' and DateTravelFrom < '$batas' and DateTravelFrom>'$hariini')  and TCDivision='$_GET[Div]' and TCNameAlias='$_GET[TC]' ");
		$jumDetail=mysql_num_rows($TBFdetail);
		 echo"<center><font size=3; color='red';><b>$_GET[TC] PLEASE SEND YOUR TBF IMMEDIATELY !";
		
			
		if($jumDetail >0)
			{
			$no=1;
			echo"<table class='bordered'>
				<tr>
					<th>No</th>
					<th>Booking ID</th>
					<th>Tour Code</th>
					<th>Bookers Name</th>
					<th>Bookers phone</th>
					<th>Pax</th>
				</tr>";
				
			while($DTBFdetail=mysql_fetch_array($TBFdetail))
				{
				$Pax=$DTBFdetail[AdultPax]+$DTBFdetail[ChildPax]+$DTBFdetail[InfantPax];
				echo"<tr>
						<td>$no</td>
						<td>$DTBFdetail[BookingID]</td>
						<td>$DTBFdetail[TourCode]</td>
						<td>$DTBFdetail[BookersName]</td>
						<td>$DTBFdetail[BookersTelp]</td>
						<td>$Pax</td>
					</tr>";
				$no++;
				$Pax=0;
				}
				
			}
			echo"</table>";
		     echo "<center><input type=button value='Back' onclick='self.history.back()'>
          <br><br>";
          break;
          
 case "addpax":                                     
          $cari=mssql_query("SELECT DivisiNO,Employee.DivisiID,EmployeeID,Category,EmployeeName,CompanyGroup FROM [HRM].[dbo].[Employee]
                       inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                       WHERE EmployeeID = '$_SESSION[employee_code]'");
          $staff=mssql_fetch_array($cari);
          $editr=mysql_query("SELECT * FROM tour_msbookingdummy WHERE BookingID = '$_GET[id]'");
          $bok=mysql_fetch_array($editr);  
          $edit=mysql_query("SELECT * FROM tour_msproduct WHERE IDProduct = '$bok[IDTourcode]' AND Status <>'VOID'");
          $r=mysql_fetch_array($edit);     
          $thisyear = date("Y", time());
          $nextyear = $thisyear+1;
          $datenow = date("d", time());
          $monthnow = date("m", time());
          $monthnext = date("m", time())+1;
          $yearnow = date("Y", time());
          $today = $yearnow."-".$monthnow."-".$datenow;
          include "../config/koneksifabs.php";
          $carievent=mysql_query("SELECT * FROM tbl_exhibition where StartDate <= '$today' and EndDate >= '$today' and InhouseBSO = '$staff[DivisiID]'");
          $dptevent=mysql_fetch_array($carievent);
          mysql_close($dbfabs);
          include "../config/koneksi.php";

    echo "<h2>Add Pax for Booking $bok[BookingID]</h2>                                                                      
          <table style='border: 0px solid #000000;'>
          <tr><td style='border: 0px solid #000000;'>
          <form name='example' method='POST' onsubmit='return validateAddOnSubmit(this)' action='./aksi.php?module=msbookingdummy&act=addpax' enctype='multipart/form-data'>
          <table class='bordered'><input type='hidden' name='sellcurr' value='$r[SellingCurr]'>
          <tr><td>Tour Code</td> <td>$r[TourCode]<input type='hidden' name='nobooking' value='$bok[BookingID]'></td></tr>   
          <tr><td>Bookers Name</td> <td><input type='hidden' name='bookersname' value='$bok[BookersName]'>$bok[BookersName]</td></tr> 
          <tr><td>Telephone</td> <td><input type='hidden' name='bookerstelp' value='$bok[BookersTelp]'>$bok[BookersTelp]</td></tr>
          <tr><td>Mobile</td> <td><input type='hidden' name='bookersmobile' value='$bok[BookersMobile]'>$bok[BookersMobile]</td></tr>
          <tr><td>Address</td><td><textarea name='bookersaddress' cols='50' rows='3'>$bok[BookersAddress]</textarea></td></tr>    
          <tr><td>Emergency Call</td> <td><textarea name='emergencycall' cols='50' rows='3'>$bok[EmergencyCall]</textarea></td></tr>
          <input type=hidden name='tcname' value='$staff[EmployeeName]'><input type=hidden name='tcdivision' value='$staff[DivisiID]'>
          <input type=hidden name='officekey' value='$staff[DivisiNO]'>";
          // default ***********
    echo "<tr><td>TC Name</td> <td>$staff[EmployeeName] - Division: $staff[DivisiID]</td></tr>
          <input type=hidden name='tcnamealias' value='$staff[EmployeeName]'><input type='hidden' name='tcempid' value='$staff[EmployeeID]'>
          <tr><td>Add Pax</td> <td>Adult <input type=text name='adultpax' value='0' size='3' onkeyup='jumlahin(),jumlahtotal(),isNumber(this)'>&nbsp 
                                     Child <input type=text name='childpax' value='0' size='3' onkeyup='jumlahin(),jumlahtotal(),isNumber(this)'>&nbsp 
                                     Infant <input type=text name='infantpax' value='0' size='3' onkeyup='jumlahtotal(),isNumber(this)'> 
          </td></tr>
          <tr><td>Total Pax</td> <td>Adult :<input type='hidden' name='atawal' value='$bok[AdultPax]'><input type=text name='adulttotal' value='$bok[AdultPax]' size='3' style='text-align: center;border: 0px solid #000000;'>&nbsp 
                                     Child :<input type='hidden' name='ctawal' value='$bok[ChildPax]'><input type=text name='childtotal' value='$bok[ChildPax]' size='3' style='text-align: center;border: 0px solid #000000;'>&nbsp 
                                     Infant :<input type='hidden' name='itawal' value='$bok[InfantPax]'><input type=text name='infanttotal' value='$bok[InfantPax]' size='3' style='text-align: center;border: 0px solid #000000;'> </td></tr>
          <tr><th colspan=2></th></tr>
          <tr><td>Deposit Date</td> <td><input type='text' name='depositdate' size='10' onClick="."cal.select(document.forms['example'].depositdate,'ActIn1','yyyy-MM-dd'); return false;"." NAME='anchor3' ID='ActIn1' required>
           <font color='red'>(yyyy-mm-dd)</font></td></tr>
          <tr><td>Deposit No</td> <td>
          <input type=text name='depositno' id='depositno' required></td></tr>
          <tr><td>Deposit Amount</td> <td><select name='depositcurr' >";
            $tampil=mysql_query("SELECT * FROM cim_rate ORDER BY RateID");
            while($s=mysql_fetch_array($tampil)){  // <input type='button' value='Cek Seat' onclick=ceking() >
                if($s[curr]=='IDR'){
                     echo "<option value='$s[curr]' selected>$s[curr]</option>";    
                } else {
                     echo "<option value='$s[curr]' >$s[curr]</option>";
                }
            }
    echo "</select> <input type=text name='depositamount' onkeyup='isNumber(this)' required><input type='hidden' name='jumsit' value='0'><input type='hidden' id='myseat' value='$r[SeatSisa]'></td></tr>
          <tr><td colspan=2><center><input type='submit' name='submit' value=Save >
                            <input type=button value=Cancel onclick='self.history.back()'></td></tr>
          </table> </form>
          </td><td style='border: 0px solid #000000;'></td><td style='border: 0px solid #000000;'><iframe src='info.php?id=$r[IDProduct]' width='500' height='800' frameborder='0'></iframe></td></tr></table><br><br>";
     break;
}
?>
