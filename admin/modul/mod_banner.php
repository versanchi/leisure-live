
<?php
switch($_GET[act]){
  // Tampil Member

  default:
    echo "<h2>UPDATE NEWS</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='banner'>
		  </form>";
		// Langkah 2
			$nama=$_GET['nama'];
			$tampil=mysql_query("SELECT * FROM banner
                                 ORDER BY bid ASC");
			$jumlah=mysql_num_rows($tampil);
			$hariini = date("Y-m-d ");
			echo "<table>
          		  <tr><th>Status</th>
                      <th>Subject</th>				  
					  <th>Valid</th>
					  <th>manage</th></tr>"; 
				   $no=$posisi+1;
    					while ($data=mysql_fetch_array($tampil)){
					   	$valid=$data[bvalid];
                        Switch ($data[bvalue]) {
					   		Case 'on': $check = "<font color='red'><b>SHOW</b></font>"; break;
							Case '': $check = "HIDE"; break;
					   }
                       if ($data[bvalid] < date("Y-m-d")){
					   	   $check1="<font color='grey'><b>(EXPIRED)</b></font>";
					   	}else {$check1="";}						   
					   echo "<tr><td><center>$check $check1</td>
                             <td>$data[bsubject]</td>
                             <td>$data[bvalid]</td>								 
					   		 <td><center><a href=?module=banner&act=editbanner&id=$data[bid]>Edit</a></td></tr>";
					   $no++;
                       }
                       echo"</table>
                       <br><br>";
			
    break;
	
  case "editbanner":
    $edit=mysql_query("SELECT * FROM banner WHERE bid ='$_GET[id]'");  
    $r2=mysql_fetch_array($edit); 
    $sValue = $r2[bcontent]; 
	Switch ($r2[bvalue]) {
					   		Case 'on': $check = "checked"; break;
							Case '': $check = "unchecked"; break;
					   }
    echo "<h2>Edit Banner</h2>
          <form NAME='example' method=POST action='./aksi.php?module=banner&act=update'>
          <input type=hidden name=id value='$r2[bid]'>
		  <table>
  		  <tr><td>Subject</td> <td>  <input type=text name='subject' value='$r2[bsubject]' size=30 maxlength='15'></td></tr>
		  
          <tr><td>Content </td>
		  <td><input type='text' size='40' value='$r2[bcontent1]' name='baris1' maxlength='30'>&nbsp -1<br><input type='text' size='40' value='$r2[bcontent2]' name='baris2' maxlength='30'>&nbsp -2<br><input type='text' size='40' value='$r2[bcontent3]' name='baris3' maxlength='30'>&nbsp -3</td></tr>	
          <tr><td>Color</td><td>Background &nbsp <input type='Text' name='input1' size='6' value='$r2[bcolor]' READONLY> <a href=\"javascript:TCP.popup(document.forms['example'].elements['input1'], 1)\"><img width=\"15\" height=\"13\" border=\"0\" src=\"images/sel.gif\"></a>&nbsp -
          &nbsp Font &nbsp<input type='Text' name='input2' size='6' value='$r2[fcolor]' READONLY> <a href=\"javascript:TCP.popup(document.forms['example'].elements['input2'], 1)\"><img width=\"15\" height=\"13\" border=\"0\" src=\"images/sel.gif\"></a></td></tr>
          <tr><td>Validity </td> <td> <input type=text name='valid' value='$r2[bvalid]' size=20>
		  <A HREF='#' onClick="."cal.select(document.forms['example'].valid,'anchor1','yyyy/MM/dd'); return false;"." NAME='anchor1' ID='anchor1'>select</A>		  		  
		  
          <tr><td>Status</td><td><input type='checkbox' $check name='value'>&nbsp SHOW</td></tr>
          <tr><td colspan=2><center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
          
     break;
}
?>