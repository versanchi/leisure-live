<script language="JavaScript"  type="text/javascript">
     
function delfile(ID, Country, City)
{
if (confirm("Are you sure you want to delete "+Country +" - "+ City + " "))
{
 window.location.href = '?module=mscountry&act=deletecountry&id=' + ID;
 
} 
}
</script>
<script type="text/javascript">
    function lookup(inputString) {
        if(inputString.length == 0) {
            // Hide the suggestion box.
            $('#suggestions').hide();
        } else { 
            $.post("../admin/modul/region.php", {queryString: ""+inputString+""}, function(data){
                if(data.length >0) {
                    $('#suggestions').show();
                    $('#autoSuggestionsList').html(data);
                }
            });
        }
    } // lookup
    
    function fill(thisValue) {
        $('#inputString').val(thisValue);  
        setTimeout("$('#suggestions').hide();", 200);
    }
    
    function hapus()
        {
            document.getElementById("inputString").value = "";
        }
    function lookup1(inputString1) {
        In = example.Region.value;
        if(inputString1.length == 0) {
            // Hide the suggestion box.
            $('#suggestions1').hide();
        } else { 
            $.post("../admin/modul/country.php", {queryString1: ""+inputString1+"",queryString: ""+In+""}, function(data){
                if(data.length >0) {
                    $('#suggestions1').show();
                    $('#autoSuggestionsList1').html(data);
                }
            });
        }
    } // lookup
    
    function fill1(thisValue) {
        $('#inputString1').val(thisValue);  
        setTimeout("$('#suggestions1').hide();", 200);
    }
    
    function hapus1()
        {
            document.getElementById("inputString1").value = "";
        }
</script>
<script type="text/javascript"> 
function validateFormOnSubmit(theForm) {
var reason = "";                    
  reason += validateEmpty(theForm.Region); 
  reason += validateEmpty(theForm.Country);
  reason += validateEmpty(theForm.City);
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


</script>
<style type="text/css">
    .suggestionsBox { background:url(../config/shadow.png) no-repeat bottom right;  position:absolute; top:0px; left:0px; margin: 215px 0 0 80px; /* IE6 fix: */ _background:none; _margin:1px 0 0 0;  }
    .suggestionsBox1 { background:url(../config/shadow.png) no-repeat bottom right;  position:absolute; top:0px; left:0px; margin: 245px 0 0 80px; /* IE6 fix: */ _background:none; _margin:1px 0 0 0;  } 
    .suggestionList { border:1px solid #999; background:#FFF;  cursor:default;padding-left:5px;padding-right: 5px; text-align:left ;font-size:12;  max-height:350px; overflow:auto; margin: 0px 6px 6px 0px; /* IE6 specific: */ _height:350px;  _margin:0; _overflow-x:hidden; }
    .sugestionList div { padding:2px 5px; white-space:nowrap; } 
    .suggestionList li {   
        margin: 0px 0px 3px 0px;
        padding: 0px;
        cursor: pointer;
    }  
    .suggestionList li:hover {
        background-color: #fd6205;
    }
</style>
<?php 
switch($_GET[act]){
  // Tampil Country
  default:
  	$nama=$_GET['nama'];
    echo "<h2>Master Destination</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='mscountry'>
			  <input type=text name=nama value='$nama' size=40>	
			  <input type=submit name=oke value=Search>
		  </form><input type=button value='Add New Destination' onclick=location.href='?module=mscountry&act=tambahcountry'>";
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
		    $tampil=mysql_query("SELECT * FROM cim_mscountry 
								WHERE Country LIKE '%$nama%'
                                OR Region LIKE '%$nama%'
                                OR City LIKE '%$nama%'
								ORDER BY Region ASC,Country ASC,City ASC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>Destination</th><th>Country</th><th>City</th><th>action</th></tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
			   echo "<tr><td>$no</td>
                     <td>$data[Region]</td>
					 <td>$data[Country]</td>
                     <td>$data[City]</td>
					 <td><center><a href=?module=mscountry&act=editcountry&id=$data[CountryID]>Edit</a>
					 
					 </td></tr>";
					  $no++;
					}   //| 
                    // <a href=\"javascript:delfile('$data[CountryID]','$data[Country]','$data[City]')\">Delete</a>
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM cim_mscountry 
								WHERE Country LIKE '%$nama%'
                                OR Region LIKE '%$nama%'
                                OR City LIKE '%$nama%'
								ORDER BY Country";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=mscountry";
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
  
  case "tambahcountry":
    echo "<h2>Add New Destination</h2>
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action='./aksi.php?module=mscountry&act=input'>
          <table>
		  <tr><td>Destination</td> <td>  <input type=text name='Region' size=40 id='inputString' onClick='hapus();' onkeyup='lookup(this.value)' onblur='fill();' />
           <div class='suggestionsBox' id='suggestions' style='display: none;'>
                <div class='suggestionList' id='autoSuggestionsList'>
                    &nbsp;
                </div>
            </div> </td></tr> 
          <tr><td>Country</td> <td>  <input type=text name='Country' size=40 id='inputString1' onClick='hapus1();' onkeyup='lookup1(this.value)' onblur='fill1();' />
           <div class='suggestionsBox1' id='suggestions1' style='display: none;'>
                <div class='suggestionList' id='autoSuggestionsList1'>
                    &nbsp;
                </div>
            </div></td></tr>
          <tr><td>City</td> <td>  <input type=text name='City' size=40></td></tr>		  
          <tr><td>Status</td><td><input type=radio name='Status' value='ACTIVE' checked>&nbsp;Active
            <input type=radio name='Status' value='INACTIVE'>&nbspInactive</td></tr>
          <tr><td colspan=2><center><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;
    
  case "editcountry":
    $edit=mysql_query("SELECT * FROM cim_mscountry WHERE CountryID='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Destination</h2>
          <form name='example' method='POST' onsubmit='return validateFormOnSubmit(this)' action=./aksi.php?module=mscountry&act=update>
          <input type=hidden name=id value='$r[CountryID]'>
          <table>
          <tr><td>Destination</td> <td>  <input type=text name='Region' size=40  value='$r[Region]' ></td></tr>
          <tr><td>Country</td> <td>  <input type=text name='Country' size=40  value='$r[Country]' ></td></tr>
          <tr><td>City</td> <td>  <input type=text name='City' size=40  value='$r[City]'></td></tr>		  
          <tr><td>Status</td><td><input type=radio name='Status' value='ACTIVE' ";if($r[Status]=='ACTIVE'){echo"checked";}echo">&nbsp;Active
          <input type=radio name='Status' value='INACTIVE' ";if($r[Status]=='INACTIVE'){echo"checked";}echo">&nbspInactive</td></tr>
          <tr><td colspan=2><center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
	
  case "deletecountry":
    $edit=mysql_query("DELETE FROM cim_mscountry WHERE CountryID = '$_GET[id]'");              
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mscountry'>";   
     break;
}
?>
