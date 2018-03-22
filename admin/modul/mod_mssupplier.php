<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>
<script language="JavaScript"  type="text/javascript">     
function delfile(ID, Supplier)         
{
if (confirm("Are you sure you want to delete "+ Supplier +" "))
{
 window.location.href = '?module=mssupplier&act=deletesupplier&id=' + ID +'&sup='+ Supplier ;
 
} 
}
</script>    
<script type="text/javascript">  
function UpdateDiv(JUM, No) {                               
    var sum = 0;
    var coba;
    var nod, elems;
    var el;                                      
  nod = 'nodo'+No;  
  coba = 'nomor'+No;
  tes = 'div'+No;  
  el = document.getElementById(coba);
  elems = document.getElementById(tes);
  if (elems.checked == true) {
  document.getElementById(nod).value = el.value; }
  if (elems.checked == false) {
  document.getElementById(nod).value = ''; } 
}
  
</script>
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
                    $('#'+thisTableId + " tr:last td :input").val('');
                    
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
<?php 
switch($_GET[act]){
  // Tampil Supplier
  default:
  	$nama=$_GET['nama'];
    echo "<h2>Master Supplier</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='mssupplier'>
			  <input type=text name=nama value='$nama' size=40>	
			  <input type=submit name=oke value=Search>
		  </form><input type=button value='Add Supplier' onclick=location.href='?module=mssupplier&act=tambahsupplier'>";
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
		    $tampil=mysql_query("SELECT * FROM tour_mssupplier 
								WHERE SupplierName LIKE '%$nama%'
								OR SupplierPIC LIKE '%$nama%'
                                OR SupplierAddress LIKE '%$nama%'
								ORDER BY SupplierName ASC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>Supplier</th><th>PIC</th><th>Phone</th><th>action</th></tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
			   echo "<tr><td>$no</td>
					 <td>$data[SupplierName]</td>	   
					 <td>$data[SupplierPIC]</td>
					 <td>$data[SupplierPhone]</td> 		 
					 <td><center><a href=?module=mssupplier&act=editsupplier&id=$data[IDSupplier]>Edit</a>
					         ";
					  $no++;
					}   //|
                     //<a href=\"javascript:delfile('$data[IDSupplier]','$data[SupplierName]')\">Delete</a></td></tr>
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tour_mssupplier 
                                WHERE SupplierName LIKE '%$nama%'
                                OR SupplierPIC LIKE '%$nama%'
                                OR SupplierAddress LIKE '%$nama%'
                                ORDER BY SupplierName ASC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=mssupplier";
					// Link ke halaman sebelumnya (previous)
					echo "<center><div id='paging'>";
					if ($halaman >1) {
						$previous = $halaman-1;
						echo "<a href=$file&halaman=1&nama=$nama&oke=$oke> << First</a> |
	    					  <a href=$file&halaman=$previous&nama=$nama&oke=$oke> < Previous</a> | ";
					} else {
						echo "<< First | < Previous | ";
					}
					// Tampilkan link halaman 1,2,3 ... modifikasi ala google
					// Angka awal
					$angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
					for ($i=$halaman-2; $i<$halaman; $i++) {
						if ($i < 1 )
							continue;
						$angka .= "<a href=$file&halaman=$i&nama=$nama&oke=$oke>$i</a> ";
					}
					// Angka tengah
					$angka .= " <b>$halaman</b> ";
					for ($i=$halaman+1; $i<($halaman+3); $i++) {
						if ($i > $jmlhalaman)
							break;
						$angka .= "<a href=$file&halaman=$i&nama=$nama&oke=$oke>$i</a> ";	
					}
					// Angka akhir
					$angka .= ($halaman+2<$jmlhalaman ? " ...
						<a href=$file&halaman=$jmlhalaman&nama=$nama&oke=$oke>$jmlhalaman</a> |" : " ");
					// Cetak angka seluruhnya (awal, tengah, akhir)
					echo "$angka";
					// Link ke halaman berikutnya (Next)
					if ($halaman < $jmlhalaman) {
						$next = $halaman+1;
						echo "<a href=$file&halaman=$next&nama=$nama&oke=$oke> Next ></a> |
	    					  <a href=$file&halaman=$jmlhalaman&nama=$nama&oke=$oke> Last >></a> ";
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
  
  case "tambahsupplier":
    echo "<h2>Add New Supplier</h2>
          <form method='POST' name='example' action='./aksi.php?module=mssupplier&act=input'>
          <table>
		  <tr><td>Name</td> <td>  <input type=text name='SupplierName' size=30></td></tr>
          <tr><td>PIC</td> <td>  <input type=text name='SupplierPIC' size=30></td></tr>
		  <tr><td>Address</td> <td>  <textarea rows='3' cols='27' name='SupplierAddress'></textarea></td></tr>
          <tr><td>Phone Number &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td> <td>  <input type=text name='SupplierPhone' size=15></td></tr>
          <tr><td>Fax Number</td> <td>  <input type=text name='SupplierFax' size=15></td></tr> 
          
          <tr><td>Status</td> <td><select name='SupplierStatus'>    
            <option value='ACTIVE' selected>Active</option>
            <option value='INACTIVE' >Inactive</option>   
            </select></td></tr>
          </table>
          <table  id='supplier' border='1'>   
          <tr>
          <td>Country Handler <img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' />&nbsp</td>
          <td><img src='../images/add.png' class='cloneTableRows' /> &nbsp <select name='supplier[]' >
              <option value='0' selected>- Select Country -</option>";
            $tampil=mysql_query("SELECT * FROM cim_mscountry group by Country ASC");
            while($w=mysql_fetch_array($tampil)){    
                 echo "<option value='$w[Country]'>$w[Country]</option>";
                
            }
    echo "</select></td>
          </tr>
          </table>          
          <center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()>
          </form><br><br>";
     break;
    
  case "editsupplier":
    $edit=mysql_query("SELECT * FROM tour_mssupplier WHERE IDSupplier='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Supplier</h2>
          <form method='POST' name='example' action=./aksi.php?module=mssupplier&act=update>
          <input type=hidden name=id value='$r[IDSupplier]'>
          <table>
          <tr><td>Name</td> <td>  <input type=text name='SupplierName' value='$r[SupplierName]' size=30></td></tr>
          <tr><td>PIC</td> <td>  <input type=text name='SupplierPIC' value='$r[SupplierPIC]' size=30></td></tr>
          <tr><td>Address</td> <td>  <textarea rows='3' cols='27' name='SupplierAddress'>$r[SupplierAddress]</textarea></td></tr>
          <tr><td>Phone Number &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td> <td>  <input type=text name='SupplierPhone' value='$r[SupplierPhone]' size=15></td></tr>
          <tr><td>Fax Number</td> <td>  <input type=text name='SupplierFax' value='$r[SupplierFax]' size=15></td></tr> 
          
          <tr><td>Status</td> <td><select name='SupplierStatus'>    
            <option value='ACTIVE' ";if($r[SupplierStatus]=='ACTIVE'){echo"selected";}echo">Active</option>
            <option value='INACTIVE' ";if($r[SupllierStatus]=='INACTIVE'){echo"selected";}echo">Inactive</option>   
            </select></td></tr>
            </table>
            <table id='supplier' border='1'>";   
           $i=0;
           $coba=mysql_query("SELECT * FROM tour_destsupplier where IDSupplier ='$_GET[id]' ");
            $baris=mysql_num_rows($coba);
            if ($baris==0){
                echo"<tr>
                     <td>Country Handler <img src='../images/delete.png' alt='' class='delRow' style='visibility: hidden;' />&nbsp</td>
                     <td><img src='../images/add.png' class='cloneTableRows' /> &nbsp <select name='supplier[]' >
                      <option value='0' selected>- Select Country -</option>";
                    $tampil=mysql_query("SELECT * FROM cim_mscountry group by Country ASC");
                    while($w=mysql_fetch_array($tampil)){    
                         echo "<option value='$w[CountryID]'>$w[Country]</option>";
                
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
          <td>Country Handler <img src='../images/delete.png' alt='' class='delRow' $vis />&nbsp</td>
          <td><img src='../images/add.png' class='cloneTableRows' /> &nbsp <select name='supplier[]' >
          <option value='0' selected>- Select Country -</option>";
                $tampil=mysql_query("SELECT * FROM cim_mscountry group by Country ASC");
                while($w=mysql_fetch_array($tampil)){        
             if ($tes[IDCountry]==$w[CountryID]){
                     echo "<option value='$w[CountryID]' selected>$w[Country]</option>";
                } else {
                    echo "<option value='$w[CountryID]'>$w[Country]</option>";
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
	
  case "deletesupplier":
  $EmployeeID=$_SESSION[Employeeid];
$sqluser=mysql_query("SELECT EmployeeName FROM tbl_msemployee WHERE EmployeeID='$EmployeeID'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName = $tampiluser[EmployeeName];     
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
     $edit=mysql_query("DELETE FROM tour_mssupplier WHERE IDSupplier ='$_GET[id]'"); 
     $Description="Delete Supplier (".$_GET[sup].") "; 
     mysql_query("INSERT INTO tour_log(EmployeeName, 
                                   Description,
                                   LogTime) 
                            VALUES ('$EmpName', 
                                   '$Description', 
                                   '$today')");             
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mssupplier'>";   
     break;
} 
?>
