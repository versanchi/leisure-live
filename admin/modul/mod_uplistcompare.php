<link type="text/css" href="../head/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../head/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../head/ui.core.js"></script>
<script language="JavaScript"  type="text/javascript">
function delattach(ID, ATTACHFILE)
{
    if (confirm("Are you sure you want to delete " + ATTACHFILE +" "));
    {
        window.location.href = '?module=uplist&act=delattach&id=' + ID;

    }
}
</script>

<?php
$employee_code=$_SESSION['employee_code'];
$sqluser=mssql_query("SELECT DivisiNO,Employee.DivisiID,EmployeeID,Category,EmployeeName,CompanyGroup,LTMAuthority,ClientNo FROM [HRM].[dbo].[Employee]
                  inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                  WHERE EmployeeID =  '$employee_code'");
$hasiluser=mssql_fetch_array($sqluser);
$ltm_authority=$hasiluser['LTMAuthority'];
$EmpName="$tampiluser[EmployeeName] ($tampiluser[EmployeeID])";
$today = date("Y-m-d G:i:s");
switch($_GET[act]){
  // Tampil season
  default:
  	$nama=$_GET['nama'];
    $qdest=$_GET['dest'];
    $dest=str_replace("n", "&",str_replace("_", " ", $qdest));
    //$dest=$qdest;

    echo "<h2>Comparison Product $dest</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='uplist'>
			  <input type=text name=nama value='$nama' size='40' placeholder='Country or Title'>
			  <input type=submit name=oke value=Search>
		  </form>";
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
		    $tampil=mysql_query("SELECT * FROM tour_upload
		                        WHERE (FileDesc LIKE '%$nama%'
								OR FileCountry LIKE '%$nama%')
								AND FileCategory = 'COMPARE'
								AND FileDestination = '$dest'
								ORDER BY FileCountry ASC,FileName ASC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table class='bordered'>
          		  <tr><th>no</th><th>Country</th><th>Title</th><th>Update By</th>";
                  if($ltm_authority=='DEVELOPER' OR $ltm_authority=='PO'
                  OR $ltm_authority=='PO MANAGER' OR $ltm_authority=='ADMINISTRATOR'){echo"<th>action</th>";}
            echo "</tr>";
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
                    $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($data[FileName]) ) ) );
                    $update = date("d M Y, G:i:s", strtotime($data[UploadDate]));
                    $kata = explode("(",$data[UploadUser]);
                    $upby=$kata[0];
            echo "<tr><td>$no</td>
					 <td>$data[FileCountry]</td>

                     <td><a href='$data[FileAttach]$file' target='_blank' style=text-decoration:none >$data[FileDesc]</a></td>";
                 if($ltm_authority=='DEVELOPER' OR $ltm_authority=='PO'
                    OR $ltm_authority=='PO MANAGER' OR $ltm_authority=='ADMINISTRATOR'){
                 echo"
                 <td>$upby ($update)</td>
                 <td><a href=\"javascript:delattach('$data[UploadID]','$data[FileName]')\"><font color=red>remove</font></a></td>";}
            echo "</td></tr>";
					  $no++;
					}     //&nbsp;|&nbsp; 
                     //<a href=\"javascript:delfile('$data[IDSeason]','$data[SeasonName]')\">Delete</a>        
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tour_upload
		                        WHERE (FileDesc LIKE '%$nama%'
								OR FileCountry LIKE '%$nama%')
								AND FileCategory = 'COMPARE'
								AND FileDestination = '$dest'";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=listcompare";
					// Link ke halaman sebelumnya (previous)
					echo "<center><div id='paging'>";
					if ($halaman >1) {
						$previous = $halaman-1;
						echo "<a href=$file&dest=$dest&halaman=1&nama=$nama&oke=$oke> << First</a> |
	    					  <a href=$file&dest=$dest&halaman=$previous&nama=$nama&oke=$oke> < Previous</a> | ";
					} else {
						echo "<< First | < Previous | ";
					}
					// Tampilkan link halaman 1,2,3 ... modifikasi ala google
					// Angka awal
					$angka=($halaman > 3 ? " ... " : " "); //Ternary Operator
					for ($i=$halaman-2; $i<$halaman; $i++) {
						if ($i < 1 )
							continue;
						$angka .= "<a href=$file&dest=$dest&halaman=$i&nama=$nama&oke=$oke>$i</a> ";
					}
					// Angka tengah
					$angka .= " <b>$halaman</b> ";
					for ($i=$halaman+1; $i<($halaman+3); $i++) {
						if ($i > $jmlhalaman)
							break;
						$angka .= "<a href=$file&dest=$dest&halaman=$i&nama=$nama&oke=$oke>$i</a> ";
					}
					// Angka akhir
					$angka .= ($halaman+2<$jmlhalaman ? " ...
						<a href=$file&dest=$dest&halaman=$jmlhalaman&nama=$nama&oke=$oke>$jmlhalaman</a> |" : " ");
					// Cetak angka seluruhnya (awal, tengah, akhir)
					echo "$angka";
					// Link ke halaman berikutnya (Next)
					if ($halaman < $jmlhalaman) {
						$next = $halaman+1;
						echo "<a href=$file&dest=$dest&halaman=$next&nama=$nama&oke=$oke> Next ></a> |
	    					  <a href=$file&dest=$dest&halaman=$jmlhalaman&nama=$nama&oke=$oke> Last >></a> ";
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

    case "delattach":
        $edit1=mysql_query("SELECT * FROM tour_upload WHERE UploadID ='$_GET[id]'");
        $r2=mysql_fetch_array($edit1);
        $dest=$r2[FileDestination];
        $file= preg_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($r2[FileName]) ) ) );
        $path = $r2[FileAttach];
        $files = ("$path$file");
        unlink($files);
        $Description="DELETE File from : $r2[UploadID].$r2[FileCountry] - $r2[FileDesc]($r2[FileName])";
        mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('$EmpName',
                                   '$Description',
                                   '$today')");
        $edit=mysql_query("DELETE From tour_upload WHERE UploadID = '$_GET[id]'");
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=listcompare&dest=$dest'>";
        break;
} 
?>
