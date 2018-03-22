<script type="text/javascript">
    function lookup(inputString) {
        if(inputString.length == 0) {
            // Hide the suggestion box.
            $('#suggestions').hide();
        } else { 
            $.post("../admin/modul/rpc.php", {queryString: ""+inputString+""}, function(data){
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
</script>
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
    echo "<h2>Export Sales Data by Tour Code to Excel</h2>
		  <form name='cari' method=POST action=exptourcodelbd.php><div id='subttlrpt'>
		  	  <input type=hidden name='olokasi' value='$_SESSION[lokasi]'>
			  Tour Code &nbsp:  <input type='text' name='nama' size='20' value='$nama' id='inputString' onClick='hapus();' onkeyup='lookup(this.value)' onblur='fill();' />
               <div class='suggestionsBox' id='suggestions' style='display: none;'>
                <div class='suggestionList' id='autoSuggestionsList'>
                    &nbsp;
                </div>
            </div> 
               &nbsp<input type=radio name='sel' value='0' checked >&nbsp;Active
                    <input type=radio name='sel' value='1'>&nbsp;Void </br><br>
              Period &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <select name='tahun' >
            <option value=0 selected>- select year -</option>";
            $tampil=mysql_query("SELECT year(Date)as tahun FROM msvisa
                                where Date <> '0000-00-00' 
                                group by tahun ASC ");
            while($r=mysql_fetch_array($tampil)){   
                   echo "<option value=$r[tahun]>$r[tahun]</option>";

            }
    echo "</select>
         
              &nbsp&nbsp&nbsp<input type=submit name=oke value=Export></div>
		  </form><h2>&nbsp;</h2>";
		  $oke=$_GET['oke'];
  	 		
}
?>
