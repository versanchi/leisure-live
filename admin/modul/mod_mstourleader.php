<link type="text/css" href="../head/jquery-ui-1.7.2.custom.css" rel="stylesheet" />    
<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>
<script language="JavaScript"  type="text/javascript">     
function delfile(ID, TourLeader) {
if (confirm("Are you sure you want to delete "+ TourLeader +" "))
{
 window.location.href = '?module=mstourleader&act=deletetourleader&id=' + ID +'&tl='+ TourLeader ;
 
} 
}
function isNumber(field) {
var re = /^[0-9'.']*$/;
if (!re.test(field.value)) {
alert('VALUE MUST BE NUMBER !');
field.value = field.value.replace(/[^0-9'.']/g,"");
}                                 
}
function validateFormOnSubmit(theForm) {
var reason = "";
  if (document.example.TourleaderType.value == "IN HOUSE"){
  reason += validateSelect(theForm.TourleaderNameS);
  }else if (document.example.TourleaderType.value == "FREELANCE"){
  reason += validateEmptys(theForm.TourleaderName);
  }  
  reason += validateTelp(theForm.TourleaderMobile);      
  if (reason != "") {
    alert("Some fields need correction:\n" + reason);
    return false;
  }

  return true;
}
function validateTelp(fld) {
    var error = "";
    var stripped = fld.value.replace(/[\(\)\.\-\ ]/g, '');    

   if (fld.value == "") {
        error = "You didn't enter a number.\n";
        fld.style.background = 'Yellow';
    } else if (isNaN(stripped)) {
        error = "The number contains illegal characters.\n";
        fld.style.background = 'Yellow';
    } else if (!(stripped.length > 0)) {
        error = "The number is the wrong length.\n";
        fld.style.background = 'Yellow';
    } else {
        fld.style.background = 'White';
    }
    return error;
}
function validateEmptys(fld) {
    var error = "";
 
    if (fld.value.length == 0) {
        fld.style.background = 'Yellow'; 
        error = "The required field has not been filled in.\n"
    } else {
        fld.style.background = 'White';
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
function lockTl() {
 if (document.example.TourleaderType.value == "IN HOUSE") { 
    document.getElementById('TourleaderName').type='hidden';
    document.getElementById('TourleaderNameS').style.visibility='visible';  
    document.example.elements['Divisi'].disabled=false ; 
    document.example.TourleaderName.value = ""                               
 }else if (document.example.TourleaderType.value == "FREELANCE"){ 
    document.getElementById('TourleaderName').type='text';
    document.getElementById('TourleaderNameS').style.visibility='hidden';  
    document.example.elements['Divisi'].disabled=true ;
    document.getElementById('Divisi').selectedIndex=0; 
    document.getElementById('TourleaderNameS').innerHTML = "<option value='0'></option>";    
 }  
 }
function showTl() {
 <?php                                                   
 // membaca semua data currency
 $query = "SELECT * FROM tbl_msoffice ";
 $hasil = mysql_query($query);
 
 // membuat if untuk masing-masing pilihan currency 
 while ($data = mysql_fetch_array($hasil))
 {
   $idDest = $data['office_id'];                                                  
   // membuat IF untuk masing-masing currency
   echo "if (document.example.Divisi.value == \"".$idDest."\")"; 
   echo "{";       
    
   // membuat hasil kurs untuk masing-masing currency
   $query2 = "SELECT * FROM tbl_msemployee 
                LEFT JOIN tbl_msoffice ON tbl_msoffice.office_id = tbl_msemployee.office_id
                WHERE tbl_msemployee.office_id = '$idDest' AND tbl_msemployee.active='1' order by employee_name ";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('TourleaderNameS').innerHTML = \"";
   $content .= "<option value='0'>- Select -</option>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['employee_code']."'>".$data2['employee_name']."</option>";
   }
   $content .= "\"";
   echo $content;
   echo "}\n";
   echo "else if (document.example.Divisi.value == '0'){";
   
   // membuat hasil kurs untuk masing-masing currency
   $content = "document.getElementById('TourleaderNameS').innerHTML = \"";
   $content .= "<option value=''></option>";
   
   $content .= "\"";
   echo $content;
   echo "}\n";          
 }
  ?>           
 }
function ganti() {
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

    // -- Clone table rows
    $(".cloneTableRows").live('click', function(){

        // this tables id
        var thisTableId = $(this).parents("table").attr("id");

        // lastRow
        var lastRow = $('#'+thisTableId + " tr:last");

        var rowCount = $('#'+thisTableId).attr('rows').length;
        //alert(rowCount);

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
include "../config/koneksimaster.php";
switch($_GET[act]) {
    // Tampil Country
    default:
        $nama = $_GET['nama'];
        $stts = $_GET['status'];
        if ($stts == '') {
            $stts = 'REQUEST';
        } else {
            $stts = $stts;
        }
        echo "<h2>Master Tour Leader</h2>
		  <form method=get id='myform' action='media.php?'>
		  	  <input type=hidden name=module value='mstourleader'>
			  <select name='status' onChange=ganti()>
              <option value='REQUEST' ";
        if ($stts == 'REQUEST') {
            echo "selected";
        }
        echo ">REQUEST</option>
              <option value='APPROVED' ";
        if ($stts == 'APPROVED') {
            echo "selected";
        }
        echo ">APPROVED</option>
              <option value='REJECT' ";
        if ($stts == 'REJECT') {
            echo "selected";
        }
        echo ">REJECT</option>
              <option value='BLACKLIST' ";
        if ($stts == 'BLACKLIST') {
            echo "selected";
        }
        echo ">BLACKLIST</option>
              </select>
			  <input type=text name=nama value='$nama' size=40>
			  <input type=submit name=oke value=Search>
		  </form>";
        $oke = $_GET['oke'];

        // Langkah 1
        $batas = 15;
        $halaman = $_GET['halaman'];
        if (empty($halaman)) {
            $posisi = 0;
            $halaman = 1;
            $dari = 1;
            $sampai = $batas;
        } else {
            $posisi = ($halaman - 1) * $batas;
        }
        $sampai = $halaman * $batas;
        $awal = ($sampai + 1) - $batas;
        // Langkah 2

        $tampil = mssql_query("WITH LIMIT AS(SELECT *,
                                ROW_NUMBER() OVER (ORDER BY IndexEmployee) AS 'RowNumber'
                                FROM [HRM].[dbo].[Employee]
                                WHERE (NameAsPassport LIKE '%$nama%'
								OR NickName LIKE '%$nama%'
								OR EmployeeName LIKE '%$nama%')
								AND StatusTL = '$stts')
								select * from LIMIT WHERE RowNumber BETWEEN $awal AND $sampai
								ORDER BY EmployeeName ASC");
        $jumlah = mssql_num_rows($tampil);

        if ($jumlah > 0) {
            echo "<table>
          		  <tr><th>no</th><th>Name</th><th>Nick Name</th><th>Employee ID</th><th>BSO</th><th>Mobile</th><th>Type</th><th>status</th><th>action</th></tr>";
            $no = $posisi + 1;
            while ($data = mssql_fetch_array($tampil)) {
                echo "<tr><td>$no</td>
                     <td>$data[Title] $data[EmployeeName]</td>
                     <td>$data[NickName]</td>
                     <td>$data[EmployeeID]</td>
                     <td>$data[DivisiID]</td>
                     <td>$data[Mobile]</td>
                     <td>$data[EmployeeType]</td>
                     <td>$data[StatusTL]</td>
					 <td><center><a href=?module=profile&act=showprofile&id=$data[EmployeeID]>View Profile</a>
					 </td></tr>";
                $no++;
            }
            echo "</table>";

            // Langkah 3
            $tampil2 = "SELECT * FROM [HRM].[dbo].[Employee]
                                WHERE (NameAsPassport LIKE '%$nama%'
								OR NickName LIKE '%$nama%'
								OR EmployeeName LIKE '%$nama%')
								AND StatusTL = '$stts'";
            $hasil2 = mssql_query($tampil2);
            $jmldata = mssql_num_rows($hasil2);
            $jmlhalaman = ceil($jmldata / $batas);
            $file = "media.php?module=mstourleader";
            // Link ke halaman sebelumnya (previous)
            echo "<center><div id='paging'>";
            if ($halaman > 1) {
                $previous = $halaman - 1;
                echo "<a href=$file&halaman=1&status=$stts&nama=$nama&oke=$oke> << First</a> |
	    					  <a href=$file&halaman=$previous&status=$stts&nama=$nama&oke=$oke> < Previous</a> | ";
            } else {
                echo "<< First | < Previous | ";
            }
            // Tampilkan link halaman 1,2,3 ... modifikasi ala google
            // Angka awal
            $angka = ($halaman > 3 ? " ... " : " "); //Ternary Operator
            for ($i = $halaman - 2; $i < $halaman; $i++) {
                if ($i < 1)
                    continue;
                $angka .= "<a href=$file&halaman=$i&status=$stts&nama=$nama&oke=$oke>$i</a> ";
            }
            // Angka tengah
            $angka .= " <b>$halaman</b> ";
            for ($i = $halaman + 1; $i < ($halaman + 3); $i++) {
                if ($i > $jmlhalaman)
                    break;
                $angka .= "<a href=$file&halaman=$i&status=$stts&nama=$nama&oke=$oke>$i</a> ";
            }
            // Angka akhir
            $angka .= ($halaman + 2 < $jmlhalaman ? " ...
						<a href=$file&halaman=$jmlhalaman&status=$stts&nama=$nama&oke=$oke>$jmlhalaman</a> |" : " ");
            // Cetak angka seluruhnya (awal, tengah, akhir)
            echo "$angka";
            // Link ke halaman berikutnya (Next)
            if ($halaman < $jmlhalaman) {
                $next = $halaman + 1;
                echo "<a href=$file&halaman=$next&status=$stts&nama=$nama&oke=$oke> Next ></a> |
	    					  <a href=$file&halaman=$jmlhalaman&status=$stts&nama=$nama&oke=$oke> Last >></a> ";
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
}
?>
