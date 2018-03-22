
<style type="text/css">
    .suggestionsBox { background:url(../config/shadow.png) no-repeat bottom right;  position:absolute; top:0px; left:0px; margin: 210px 0 0 120px; /* IE6 fix: */ _background:none; _margin:1px 0 0 0;  }
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
<script type='text/javascript'> 
function pilih()
{   if( document.cari.elements['status'].value=="C"){
    document.cari.elements['tahun'].disabled=false; 
    }
    else {
    document.cari.elements['tahun'].disabled=true; 
    }                                                    
}
</script>
<?php 
switch($_GET[act]){
  // Tampil Cash Receipt by Date
  default:
	/*function render($record,$nourut) {
	  $output = "<tr>\n";
	  //$output .= "<td><a href='viewthing.php?tid={$record->tid}'>{$record->name}</a></td>\n";
	  $output .= "<td>{$record->ReceiptNo}</td>\n";
	  $output .= "<td>{$record->Location}</td>\n";
	  $output .= "<td>{$record->Customer}</td>\n";
	  $output .= "<td>{$record->ReceiptDetail}</td>\n";
	  $output .= "<td>{$record->Currency}</td>\n";
	  $output .= "<td align=right>".number_format($record->ReceiptAmount, 2,',','.')."</td>\n";	  	  
	  $output .= "</tr>\n";
	  return $output;
	}  */
	$datenow = date("d", time());
    $monthnow = date("m", time());
	$yearnow = date("Y", time());
	$today = $yearnow."/".$monthnow."/".$datenow;
	$firstday = $yearnow."/".$monthnow."/01";
	$fdreq = $_POST['date1'];
	$tdreq = $_POST['date2'];
	$nama=$_GET['nama']; 
	/*if ($fdreq==0) {
		$fdreq = $firstday;
		$tdreq = $today;
	} */
    echo "<h2>Export Sales Data by Embassy to Excel</h2>
		  <form name='cari' method=POST action=expembassy.php><div id='subttlrpt'>
		  	  <input type=hidden name='olokasi' value='$_SESSION[lokasi]'>
			  Embassy &nbsp:  <select name='nama'>
            <option value='0' selected>- Select Embassy -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_mscountry                               
                group by Country");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[CountryID]>$r[Country]</option>";
            }
    echo "</select>      </br><br>
            Status &nbsp&nbsp&nbsp&nbsp : <select name='status' onChange='pilih()'>
            <option value='C'>COMPLETE</option>
            <option value='P'>PROCESS</option>
            <option value='U' selected>UNPROCESS</option>
            </select>
            </br></br>
              Period &nbsp&nbsp&nbsp&nbsp : <select name='tahun' id='tahun' >";
            $tampil=mysql_query("SELECT year(Date)as tahun FROM msvisa
                                where Date <> '0000-00-00' 
                                group by tahun DESC ");
            while($r=mysql_fetch_array($tampil)){   
                   echo "<option value=$r[tahun]>$r[tahun]</option>";

            }
    echo "</select>
         
              &nbsp&nbsp&nbsp<input type=submit name=oke value=Export></div>
		  </form><h2>&nbsp;</h2>";
		  $oke=$_GET['oke'];
  	 		
}
?>
