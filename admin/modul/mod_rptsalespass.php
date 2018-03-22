<?php 
switch($_GET[act]){
  // Tampil Cash Receipt by Date
  default:

	$datenow = date("d", time());
    $monthnow = date("m", time());
	$yearnow = date("Y", time());
	$today = $yearnow."/".$monthnow."/".$datenow;
	$firstday = $yearnow."/".$monthnow."/01";
	$fdreq = $_POST['date1'];
	$tdreq = $_POST['date2'];
	
	if ($fdreq==0) {
		$fdreq = $firstday;
		$tdreq = $today;
	} 
    echo "<h2>Export Sales Data (PASSPORT) to Excel</h2>
		  <form name='cari' method=POST action=expsalespass.php><div id='subttlrpt'>
		  	  <input type=hidden name=olokasi value=$_SESSION[lokasi]>
			  BSO &nbsp: <select name='nama' >
            <option value=0 selected>- All BSO -</option>";
            $tampil=mysql_query("SELECT * FROM tbl_msemployee 
                                left join tbl_msoffice on tbl_msoffice.office_id = tbl_msemployee.office_id
                                group by tbl_msemployee.office_id
                                order by office_code ASC");
            while($r=mysql_fetch_array($tampil)){
                if ($mem == $r[office_id]){
                   echo "<option value=$r[office_id] selected>$r[office_code]</option>";
                } else {
                   echo "<option value=$r[office_id]>$r[office_code]</option>";
                }                                          
                
            }
    echo "</select> &nbsp<input type=radio name='sel' value='0' checked >&nbsp;Active
                    <input type=radio name='sel' value='1'>&nbsp;Void </br><br>
              From : <input type=text name='date1' value='$fdreq' size=15 onClick="."cal.select(document.forms['cari'].date1,'anchor1','yyyy/MM/dd'); return false;"." NAME='anchor1' ID='anchor1'> 
			  &nbsp;To : <input type=text name='date2' value='$tdreq' size=15 onClick="."cal.select(document.forms['cari'].date2,'anchor2','yyyy/MM/dd'); return false;"." NAME='anchor2' ID='anchor2'> 
              &nbsp&nbsp&nbsp<input type=submit name=oke value=Export></div>
		  </form><h2>&nbsp;</h2>";
		  $oke=$_GET['oke'];
  	 		
}
?>
