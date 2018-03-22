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
	
	if ($fdreq==0) {
		$fdreq = $firstday;
		$tdreq = $today;
	} 
    echo "<h2>Incentive Report (Detail)</h2>
		  <form name='cari' method=POST action=incentivexl.php target=_blank><div id='subttlrpt'>
		  	  <input type=hidden name=olokasi value=$_SESSION[lokasi]>
			  PIC &nbsp&nbsp: <select name='nama' >
            <option value='0' selected>- ALL PIC -</option>";
            $tampil=mysql_query("SELECT tbl_msemployee.employee_id,tbl_msemployee.employee_name  FROM tbl_msemployee
                        left join tbl_msoffice on tbl_msoffice.office_id = tbl_msemployee.office_id
                                        where tbl_msoffice.office_code = 'DOC'  
                                        order by employee_name ASC");
            while($r=mysql_fetch_array($tampil)){
                if ($mem == $r[office_id]){
                        echo "<option value='$r[employee_id]' selected>$r[employee_name]</option>";
                        } else {
                           echo "<option value='$r[employee_id]'>$r[employee_name]</option>";  
                        }  
            }
    echo "</select></br><br>
              From : <input type=text name='date1' value='$fdreq' size=15 onClick="."cal.select(document.forms['cari'].date1,'anchor1','yyyy/MM/dd'); return false;"." NAME='anchor1' ID='anchor1'> 
			  &nbsp;To : <input type=text name='date2' value='$tdreq' size=15 onClick="."cal.select(document.forms['cari'].date2,'anchor2','yyyy/MM/dd'); return false;"." NAME='anchor2' ID='anchor2'> 
              &nbsp&nbsp&nbsp<input type=submit name=oke value=Show></div>
		  </form><h2>&nbsp;</h2>";
		  $oke=$_GET['oke'];
  	 		
}
?>
