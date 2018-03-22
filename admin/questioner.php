<?php
//include "config/koneksi_dbvisa.php";
session_start();
include "../config/koneksi.php";
include "../config/koneksimaster.php";
?>
  
  <script type="text/javascript" src="js/formcalculations.js"></script>
  <SCRIPT language='Javascript'>
      <!-- input just numeric, if input with character is not allowed
     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
	  function PopupCenter(pageURL, ID,w,h) {
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
		var targetWin = window.open (pageURL , ID, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		} 
   </SCRIPT>
   <script type="text/javascript"> 
	function generateexcel(tableid) {
	  var table= document.getElementById(tableid);
	  var html = table.outerHTML;  
	  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
	}  
	</script>
   <!--Start Javacript untuk fix Header -->
	<style>
        .black_overlay{
            display: none;
            position: absolute;
            top: 0%;
            left: 0%;
            width: 100%;
            height: 100%;
            background-color: black;
            z-index:1001;
            -moz-opacity: 0.8;
            opacity:.80;
            filter: alpha(opacity80);
        }
        .white_content {
            display: none;
            position: absolute;
            top: 0%;
            left: 25%;
            width: 50%;
            height: 50%;
            padding: 16px;
            border: 4px solid orange;
            background-color: white;
            z-index:1002;
            overflow: auto;
        }
		#wrap div#totalPrice
		{
			padding:10px;
			font-weight:bold;
			text-align:center;
			font-size:18px;
		}
		
		#wrap div#totalTConsult
		{
			padding:10px;
			font-weight:bold;
			/*background-color:#E5E5E5;*/
			text-align:center;
			font-size:18px;
		}
		#wrap div#totalTL
		{
			padding:10px;
			font-weight:bold;
			/*background-color:#E5E5E5;*/
			text-align:center;
			font-size:18px;
		}
		#wrap div#totalAvg
		{
			padding:10px;
			font-weight:bold;
			/*background-color:#E5E5E5;*/
			text-align:center;
			font-size:18px;
		}
		/*Start Fix Header*/
		
		#unstickyheader {
		  margin-bottom: 15px;
		}
		#othercontent {
		  margin-top: 20px;
		}
		/*End Fix Header*/
    </style>
<!-- <link href="style.css" rel="stylesheet" type="text/css" />-->
<link href="css/button.css" rel="stylesheet" type="text/css" />
</head>
<body onload='hideTotal()'>
 
	<?php 	
$aksi="aksi_regis.php?module=questioner";
$CompanyID=$_SESSION[company_id];
switch($_GET[act]){
default:
	$nama = $_GET['nama'];
	echo "<h2>Questioner</h2>
		  <form method=get action='media.php?'>
		  	  <input type=hidden name=module value='questioner'>
			  <input type=text name=nama value='$nama' size=40>	
			  <input type=submit name=oke value=Search>
		  </form>
		  <!--<input type=button value='Add Questioner' onclick=location.href='?module=questioner&act=tambahquestioner'>-->
		  <input type=button value='Add Questioner' onclick=location.href=\"javascript:PopupCenter('TCpopup.php','variable',400,150)\">
		  
		  <input type='button' name='submit' value='Export Email' onclick=generateexcel('GetDataEmail')>";
		  // Langkah 1
		  $batas = 10;
		  $halaman= $_GET['halaman'];
		  if(empty($halaman)){
		  	$posisi  = 0;
			$halaman = 1;
		  } else {
		  	$posisi = ($halaman-1) * $batas; }
			// Langkah 2
	
		    $tampil=mysql_query("SELECT * FROM tbl_trquestion inner join tour_msproduct  on tour_msproduct.idproduct = tbl_trquestion.idtourcode
								WHERE tour_msproduct.CompanyID=$CompanyID and (tbl_trquestion.QuestionID LIKE '%$nama%'
										OR tbl_trquestion.TourCode LIKE '%$nama%'
										OR tbl_trquestion.TourLeader LIKE '%$nama%' 
										OR tbl_trquestion.Nama LIKE '%$nama%')
                                ORDER BY QuestionID DESC LIMIT $posisi,$batas");
			$jumlah=mysql_num_rows($tampil);
			
			if ($jumlah > 0) {
			echo "<table>
          		  <tr><th>no</th><th>Question ID</th><th>Tour Code</th><th>Tour Leader</th><th>Nama</th><th>Status</th><th>action</th></tr>"; 
				  $no=$posisi+1;
					while ($data=mysql_fetch_array($tampil)){
			   echo "<tr><td>$no</td>
                     <td>$data[QuestionID]</td>
					 <td>$data[TourCode]</td>
                     <td>$data[TourLeader]</td>  
					 <td><left>$data[Nama]</td>  
					 <td><center>$data[Status]</td>  
					 <td><center>";
					 if($data[Status]=='VOID'){ echo "";}
					 else{ echo "<a href=$aksi&act=void&id=$data[QuestionID]>Void</a> | "; }
			  echo "<a href=\"javascript:PopupCenter('viewquestioner.php?id=$data[QuestionID]','variable',895,550)\">View</a>
				
					 </td></tr>";
					  $no++;
					} 
					echo "</table>";
					
					// Langkah 3			
					$tampil2    = "SELECT * FROM tbl_trquestion inner join tour_msproduct  on tour_msproduct.idproduct = tbl_trquestion.idtourcode
								WHERE tour_msproduct.CompanyID=$CompanyID and (tbl_trquestion.QuestionID LIKE '%$nama%'
										OR tbl_trquestion.TourCode LIKE '%$nama%'
										OR tbl_trquestion.TourLeader LIKE '%$nama%' 
										OR tbl_trquestion.Nama LIKE '%$nama%')
                                ORDER BY QuestionID DESC";
					$hasil2     = mysql_query($tampil2);
					$jmldata    = mysql_num_rows($hasil2);
					$jmlhalaman = ceil($jmldata/$batas);
					$file = "media.php?module=questioner";
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
			
			$getEmail = mysql_query("SELECT Nama, emailPribadi FROM tbl_trquestion WHERE emailPribadi !=''");
			echo "<table id='GetDataEmail' style='display:none;'>
					<tr><th>no</th>
						<th>Name</th>
						<th>Email</th></tr>";
					$no2=1;
					while($ge=mysql_fetch_array($getEmail)){
					echo "<tr>
							<td>$no2</td>
							<td>$ge[Nama]</td>
							<td>$ge[emailPribadi]</td>
						  </tr>";
						  $no2++;
					}
			echo " </table>";
break; 

case "tambahquestioner":
	echo "<link href='style.css' rel='stylesheet' type='text/css' />";
	//Generate ID untuk Auto Increment
    $edit = mysql_query("SELECT max(QuestionID) as maxID FROM tbl_trquestion");
    $r    = mysql_fetch_array($edit);
	$idMax = $r['maxID'];
	$noUrut = (int) substr($idMax, 4, 5);
	$noUrut++;
	$jenis = "QST";
	$newID = $jenis . sprintf("%05s", $noUrut);
	
	//Year and Tourleader
	//$showTCData = mysql_query("SELECT TourLeader, Year, TourCode FROM tour_msproduct WHERE IDProduct = '$_GET[id]'");
	$showTCData = mysql_query("SELECT PRD.Year, PRD.TourCode, TL.IDTourleader, TL.EmployeeID FROM tour_msproduct PRD
								INNER JOIN tour_msproducttl TL ON TL.IDProduct = PRD.IDProduct
							   WHERE PRD.IDProduct = '$_GET[id]'");
    $rows    = mysql_fetch_array($showTCData);

echo "<h2><b>Terima Kasih</b></h2>
	  <form method=POST action='$aksi&act=input' name='example' id='cakeform'>
	  <input type=hidden name='IDTourcode' value='$_GET[id]'>
		<div id='stickyheader'>
		<table class='list'> 
		    <tr>
				<td class='left'>Kode Tour</td>
				<td class='left'>
					<!--<select name='TourLeaderCode' id='TourLeaderCode' onChange='showPaxName(),showYearTLname(this)' required>
							<option value='' selected>- SELECT TOUR CODE -</option>";
					$result = mysql_query("SELECT TourCode, Year, TourLeader FROM tour_msproduct
								   WHERE SeatDeposit > 0 AND DateTravelFrom BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE()
								   ORDER BY TourCode DESC");
					while ($row = mysql_fetch_array($result)) {  
						echo "<option value='$row[TourCode]'>$row[TourCode]</option>";
					}
					echo "</select>
					-->
				<input type='text' name='TourLeaderCode' id='TourLeaderCode' value='$rows[TourCode]' size='40' placeholder='Tour Code' readonly />
				</td>
				<td class='left'>
					<input type='text' name='Year' id='Year' value='$rows[Year]' size='3' placeholder='Year' readonly />
					<select name='IDTourLeader' id='IDTourLeader' required>
						<option value=''>Select Tour Leader</option>";
					mysql_data_seek($showTCData,0);
					while($tl = mysql_fetch_array($showTCData)){
					    $sqluser=mssql_query("SELECT EmployeeName as TourLeader FROM [HRM].[dbo].[Employee]
                        WHERE EmployeeID = '$tl[EmployeeID]'");
                        $tampiluser=mssql_fetch_array($sqluser);
						echo"<option value='$tl[EmployeeID]' selected>$tampiluser[TourLeader]</option>";
					}
		echo "		</select>
					<!--<input type='text' name='TourLeaderName' id='TourLeaderName' value='$rows[TourLeader]' size='40' placeholder='Tour Leader' readonly />-->
				</td>
			</tr>
		</table>
		</div>
		 
		<div id='stickyalias'></div>
		
		<div id='othercontent'>
		<table class='list'> 
		  <tbody>
		    <tr>
				<td class='left' colspan='12'>
					<div align='justify'>
						Atas kepercayaan Anda untuk menggunakan produk <b>Panorama Tours.</b>
						untuk meningkatkan pelayanan kami di waktu mendatang,
						kami sangat mengharapkan Anda dapat meluangkan waktu untuk memberi komentar atas pelayanan yang kami berikan. Setiap komentar Anda sangat berharga bagi kami untuk bertumbuh dan bekerja lebih baik
					</div></td>
			</tr>
			<tr>
				<td class='left' colspan='8'>Apakah Anda pernah menggunakan produk <b>Panorama Tours</b> sebelumnya?</td>
				<td class='right' style='border-right:none;'><input type=radio name='isProduct' value='Ya'/></td>
					<td class='left'>Ya</td>
				<td class='right' style='border-right:none;'><input type=radio name='isProduct' value='Tidak'/></td>
					<td class='left'> Tidak</td>
			</tr>
			<tr>
				<td class='left' colspan='8'>Jika YA, apakah Anda mempunyai lebih dari satu favorit biro perjalanan wisata?</td>
				<td class='right' style='border-right:none;'><input type=radio name='isFavorite' value='Ya' /></td>
				<td class='left'>Ya</td>
				<td class='right' style='border-right:none;'><input type=radio name='isFavorite' value='Tidak'/></td>
				<td class='left'> Tidak</td>
			</tr>
			<tr>
				<td class='left' colspan='12'>Jika TIDAK, dari mana Anda mengetahui <b>Panorama Tours</b>?</td>
			</tr>
			<tr>
				<td class='right' style='border-right:none;'><input type=checkbox name='isKnowing[]' value='Iklan dan Promosi' /></td>
					<td class='left'>Iklan dan Promosi</td>
				<td class='right' style='border-right:none;' colspan='3'><input type=checkbox name='isKnowing[]' value='Pameran' /></td>
					<td class='left'>Pameran</td>
				<td class='right' style='border-right:none;'><input type=checkbox name='isKnowing[]' value='Kantor Penjualan' /></td>
					<td class='left'>Kantor Penjualan</td>
				<td class='right' style='border-right:none;'><input type=checkbox name='isKnowing[]' value='Teman' /></td>
					<td class='left'>Teman</td>
				<td class='right' style='border-right:none;'><input type=checkbox name='isKnowing[]' value='Perusahaan'/></td>
					<td class='left'>Perusahaan</td>
			</tr>
			<tr>
				<td class='left' colspan='12'>Menurut Anda, apakah sarana informasi yang paling efektif?</td>
			</tr>
			<tr>
				<td class='right' style='border-right:none;'><input type=checkbox name='isEffective[]' value='Iklan'/></td>
					<td class='left'>Iklan</td>
				<td class='right' style='border-right:none;'><input type=checkbox name='isEffective[]' value='Pameran'/></td>
					<td class='left'>Pameran</td>
				<td class='right' style='border-right:none;'><input type=checkbox name='isEffective[]' value='Kunjungan langsung'/></td>
					<td class='left'>Kunjungan langsung</td>
				<td class='right' style='border-right:none;'><input type=checkbox name='isEffective[]' value='Direct Mail'/></td>
					<td class='left'><i>Direct Mail</i></td>
				<td class='right' style='border-right:none;'><input type=checkbox name='isEffective[]' value='Brosur dan Tour Catalog'/></td>
					<td class='left'>Brosur dan <i>Tour Catalog</i></td>
				<td class='right' style='border-right:none;'><input type=checkbox name='isEffective[]' value='Internet'/></td>
					<td class='left'>Internet</td>
		    </tr>
			<tr>
				<td class='left' colspan='12'>Menurut Anda, apakah keunggulan produk <b>Panorama Tours</b> (boleh memilih dari satu)?</td>
			</tr>
			<tr>
				<td class='left' style='border-right:none;'><input type=checkbox name='isSuperior[]' value='Harga memuaskan' /></td>
				<td class='left' colspan='5'>Harga memuaskan</td>
				<td class='left' style='border-right:none;'><input type=checkbox name='isSuperior[]' value='Maskapai penerbangan yang digunakan'/></td>
				<td class='left' colspan='5'>Maskapai penerbangan yang digunakan</td>
			</tr>
			<tr>
				<td class='left' style='border-right:none;'><input type=checkbox name='isSuperior[]' value='Acara perjalanan yang unik'/></td>
				<td class='left' colspan='5'>Acara perjalanan yang unik</td>
				<td class='left' style='border-right:none;'><input type=checkbox name='isSuperior[]' value='Waktu dan lama perjalanan yang sesuai'/></td>
				<td class='left' colspan='5'>Waktu dan lama perjalanan yang sesuai</td>
			</tr>
			<tr>
				<td class='left' style='border-right:none;'><input type=checkbox name='isSuperior[]' value='Tour Consultant yang dinamis'/></td>
				<td class='left' colspan='5'>Tour Consultant yang dinamis</td>
				<td class='left' style='border-right:none;'><input type=checkbox name='isSuperior[]' value='Lokasi kantor yang mudah dijangkau'/></td>
				<td class='left' colspan='5'>Lokasi kantor yang mudah dijangkau</td>
			</tr>
			<tr>
				<td class='left' style='border-right:none;'><input type=checkbox name='isSuperior[]' value='Informasi yang lengkap dan jelas'/></td>
				<td class='left' colspan='5'>Informasi yang lengkap dan jelas</td>
				<td class='left' style='border-right:none;'><input type=checkbox name='isSuperior[]' value='Lainnya'/></td>
				<td class='left' colspan='5'>Lainnya &nbsp;&nbsp;&nbsp;<input type='text' name='lain' size='30'/></td>
			</tr>
		  </tbody>
		</table>
		
		<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
		 	Perjalanan Anda
		</div>
		  <table class='list' id='perjalanan' border='1'>   
              <thead>
			  	<tr>
				    <td class='center'></td>
					<td class='center' width='15%'>Sangat Memuaskan</td>
					<td class='center' width='15%'>Memuaskan</td>
					<td class='center' width='15%'>Tidak Memuaskan</td>
				</tr>
			  </thead>
			  <tbody>
				  <tr>
					<td class='left'>Susunan Acara Perjalanan</td>
					<td class='center' bgcolor='#e04021'><input type=radio name='acara' value='3' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='acara' value='2' onclick='calculateTotal()' /></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='acara' value='1' onclick='calculateTotal()' /></td>
				  </tr>
				  <tr>
					<td class='left'>Perusahaan Penerbangan &nbsp;&nbsp;&nbsp;&nbsp; <input type='text' name='AirlineName' size='30' placeholder='Airlines Name'/></td>
					<td class='center' bgcolor='#e04021'><input type=radio name='terbang' value='3' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='terbang' value='2' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='terbang' value='1' onclick='calculateTotal()'/></td>
				  </tr>
				  <tr>
					<td class='left'>Transfortasi Darat (Bus, kereta, dan lain-lain)</td>
					<td class='center' bgcolor='#e04021'><input type=radio name='trans' value='3' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='trans' value='2' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='trans' value='1' onclick='calculateTotal()'/></td>
				  </tr>
				  <tr>
					<td class='left'>Obyek Wisata</td>
					<td class='center' bgcolor='#e04021'><input type=radio name='wisata' value='3' onclick='calculateTotal()'  /></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='wisata' value='2' onclick='calculateTotal()' /></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='wisata' value='1' onclick='calculateTotal()' /></td>
				  </tr>
				  <tr>
					<td class='left'>Hotel Akomodasi</td>
					<td class='center' bgcolor='#e04021'><input type=radio name='hotel' value='3' onclick='calculateTotal()' /></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='hotel' value='2' onclick='calculateTotal()' /></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='hotel' value='1' onclick='calculateTotal()' /></td>
				  </tr>
				  <tr>
					<td class='left'>Sajian Makanan</td>
					<td class='center' bgcolor='#e04021'><input type=radio name='makan' value='3' onclick='calculateTotal()' /></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='makan' value='2' onclick='calculateTotal()' /></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='makan' value='1' onclick='calculateTotal()' /></td>
				  </tr>
				  <tr>
					<td class='left'>Waktu Belanja</td>
					<td class='center' bgcolor='#e04021'><input type=radio name='belanja' value='3' onclick='calculateTotal()' /></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='belanja' value='2' onclick='calculateTotal()' /></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='belanja' value='1' onclick='calculateTotal()' /></td>
				  </tr>
				  <tr>
					<td class='left'>Pemandu Wisata Setempat</td>
					<td class='center' bgcolor='#e04021'><input type=radio name='pemandu' value='3' onclick='calculateTotal()' /></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='pemandu' value='2' onclick='calculateTotal()' /></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='pemandu' value='1' onclick='calculateTotal()' /></td>
				  </tr>
				  <tr>
					<td class='left'>Tour Leader Panorama Tour</td>
					<td class='center' bgcolor='#e04021'><input type=radio name='tl' value='3' onclick='calculateTotal()' /></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='tl' value='2' onclick='calculateTotal()' /></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='tl' value='1' onclick='calculateTotal()' /></td>
				  </tr>
				  <tr>
					<td class='left' colspan='4'>Kesan dan Saran Anda terhadap keseluruhan perjalanan?</td>
				  </tr>
				  <tr>
					<td class='left' colspan='4'><textarea name='extKesan' style='width: 870px; height: 70px; resize: none;'></textarea></td>
				  </tr>
              </tbody>
		  </table>
		
		<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
		 	Pelayanan Kami
		</div>
		  <table class='list' id='pelayanan' border='1'>   
              <thead>
			  	<tr>
				    <td class='center'></td>
					<td class='center' width='15%'>Sangat Memuaskan</td>
					<td class='center' width='15%'>Memuaskan</td>
					<td class='center' width='15%'>Tidak Memuaskan</td>
				</tr>
			  </thead>
			  <tbody>
				  <tr>
					<td class='left'>Petugas Operator</td>
					<td class='center' bgcolor='#e04021'><input type=radio name='petugas' value='3' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='petugas' value='2' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='petugas' value='1' onclick='calculateTotal()'/></td>
				  </tr>
				  <tr>
				   <td class='left'>Tour Consultant</td>
				   <td class='center' bgcolor='#e04021'><input type=radio name='consultant' value='3' onclick='calculateTotal()'/></td>
				   <td class='center' bgcolor='#f5cbc3'><input type=radio name='consultant' value='2' onclick='calculateTotal()'/></td>
				   <td class='center' bgcolor='#756f6e'><input type=radio name='consultant' value='1' onclick='calculateTotal()'/></td>
				  </tr>
				  <tr>
					<td class='left'>Petugas Kasir</td>
					<td class='center' bgcolor='#e04021'><input type=radio name='kasir' value='3' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='kasir' value='2' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='kasir' value='1' onclick='calculateTotal()'/></td>
				  </tr>
				  <tr>
					<td class='left'>Petugas Dokumen Perjalanan</td>
					<td class='center' bgcolor='#e04021'><input type=radio name='doc' value='3' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='doc' value='2' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='doc' value='1' onclick='calculateTotal()'/></td>
				  </tr>
				  <tr>
					<td class='left'>Petugas Airport</td>
					<td class='center' bgcolor='#e04021'><input type=radio name='airport' value='3' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='airport' value='2' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='airport' value='1' onclick='calculateTotal()'/></td>
				  </tr>
				  <tr>
					<td class='left' style='border-right:none;'>
						<font color='#FF6600'><i>Tour Leader</i></font></td>
					<td class='center' style='border-right:none;'></td>
					<td class='center' style='border-right:none;'></td>
					<td class='center'></td>
				  </tr>
				  <tr>
				   <td class='left'>Pelayanan yang diberikan selama perjalanan</td>
				   <td class='center' bgcolor='#e04021'><input type=radio name='perjalanan' value='3' onclick='calculateTotal()'/></td>
				   <td class='center' bgcolor='#f5cbc3'><input type=radio name='perjalanan' value='2' onclick='calculateTotal()'/></td>
				   <td class='center' bgcolor='#756f6e'><input type=radio name='perjalanan' value='1' onclick='calculateTotal()'/></td>
				  </tr>
				  <tr>
					<td class='left'>Informasi mengenai obyek wisata yang dikunjungi</td>
					<td class='center' bgcolor='#e04021'><input type=radio name='info' value='3' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='info' value='2' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='info' value='1' onclick='calculateTotal()'/></td>
				  </tr>
				  <tr>
					<td class='left'>Menghidupkan suasana selama perjalanan</td>
					<td class='center' bgcolor='#e04021'><input type=radio name='hidup' value='3' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='hidup' value='2' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='hidup' value='1' onclick='calculateTotal()'/></td>
				  </tr>
				  <tr>
					<td class='left'>Pengaturan acara perjalanan</td>
					<td class='center' bgcolor='#e04021'><input type=radio name='aturacara' value='3' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='aturacara' value='2' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='aturacara' value='1' onclick='calculateTotal()'/></td>
				  </tr>
				  <tr>
					<td class='left'>Penyelesaian masalah yang terjadi selama perjalanan</td>
					<td class='center' bgcolor='#e04021'><input type=radio name='masalah' value='3' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#f5cbc3'><input type=radio name='masalah' value='2' onclick='calculateTotal()'/></td>
					<td class='center' bgcolor='#756f6e'><input type=radio name='masalah' value='1' onclick='calculateTotal()'/></td>
				  </tr>
				  <tr>
					<td class='left' colspan='4'>Kesan dan Saran Anda terhadap keseluruhan pelayanan kami?</td>
				  </tr>
				  <tr>
					<td class='left' colspan='4'><textarea name='inKesan' style='width:870px; height:70px; resize:none;'></textarea></td>
				  </tr>
              </tbody>
			</table>
			  
			<table class='list'> 
			  <tbody>
				  <tr>
				  	<td class='left' colspan='2'>Apakah Anda menikmati perjalanan Anda sesuai dengan yang Anda harapkan?</td>
					<td class='right' style='border-right:none;'><input type=radio name='isNikmat' value='Ya'/></td>
						<td class='left'>Ya</td>
					<td class='right' style='border-right:none;'><input type=radio name='isNikmat' value='Tidak'/></td>
						<td class='left'> Tidak</td>
				  </tr>
				  <tr>
				  	<td class='left' colspan='2'>Apakah Anda berminat untuk mengikuti acara <b>Panorama Tours</b> berikutnya?</td>
					<td class='right' style='border-right:none;'><input type=radio name='isMinat' value='Ya'/></td>
						<td class='left'>Ya</td>
					<td class='right' style='border-right:none;'><input type=radio name='isMinat' value='Tidak'/></td>
						<td class='left'> Tidak</td>
				  </tr>
				  <tr>
				  	<td class='left' colspan='7'>Jika YA, sebutkan waktu dan tujuan wisata anda berikutnya?</td>
				  </tr>
				  <tr>
					<td class='left' style='border-right:none;'><input type=checkbox name='isLiburSekolah' value='Yes' /></td>
						<td class='left'><input type='text' name='libursekolah' size='30' placeholder='Liburan Sekolah Juni / Juli' /></td>
					<td class='right' style='border-right:none;'><input type=checkbox name='isLiburLebaran' value='Yes' /></td>
						<td class='left'><input type='text' name='liburlebaran' placeholder='Liburan Lebaran' /></td>
					<td class='right' style='border-right:none;'><input type=checkbox name='isLiburNatal' value='Yes' /></td>
						<td class='left'><input type='text' name='liburannatal' size='40' placeholder='Liburan Natal & Tahun Baru' /></td>
				</tr>
			  </tbody>
		    </table>
		
		<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
		 	Data Anda
		</div>
		<table class='list'> 
			<tbody>
			  <tr>
			  	<td class='left'>Nama Lengkap</td>
				<td class='left' colspan='5'>
					<!--<select name='NamaLengkap' id='NamaLengkap' required></select>-->
					<select name='NamaLengkap' id='NamaLengkap' required>
							<option value='' selected>- SELECT PAX NAME -</option>";
					$result = mysql_query("SELECT IDDetail, TourCode, PaxName
										   FROM tour_msbookingdetail WHERE PaxName != '' and IDTourcode = '$_GET[id]' ORDER BY PaxName ASC");
					while ($row = mysql_fetch_array($result)) {  
						echo "<option value='$row[IDDetail]'>$row[PaxName]</option>";
					}
					echo "</select>
				</td>
			  </tr>
			  <tr>
			  	<td class='left'>No. Telp.</td>
				<td class='left'><input type='text' name='tlpPribadi' placeholder='No Telepon' onkeypress='return isNumberKey(event)' /></td>
				<td class='left'><input type='text' name='faxPribadi' placeholder='FAX' /></td>
				<td class='left' colspan='3'><input type='text' name='emailPribadi' size='30' placeholder='Email' /></td>
			  </tr>
			  <tr>
				<td class='left' colspan='2'>Apakah Perusahaan Anda menginginkan berkerja sama dengan kami?</td>
				<td class='right' style='border-right:none;'><input type=radio name='isPerusahaan' value='Ya'/></td>
					<td class='left'>Ya</td>
				<td class='right' style='border-right:none;'><input type=radio name='isPerusahaan' value='Tidak'/></td>
					<td class='left'> Tidak</td>
			  </tr>
			  <tr>
			<td class='left' colspan='6'>Jika YA, mohon Anda mengisi data dibawah ini agar dapat dihubungi oleh Account Executive kami.</td>
			  </tr>
			  <tr>
			  	<td class='left'>Nama Perusahaan</td>
				<td class='left' colspan='5'><input type='text' name='NamaPerusahaan' /></td>
			  </tr>
			  <tr>
			  	<td class='left'>Alamat Lengkap</td>
				<td class='left' colspan='5'><textarea name='alamatPerusahaan' style='width: 600px; height: 70px; resize: none;'></textarea></td>
			  </tr>
			  <tr>
			  	<td class='left'>No. Telp.</td>
				<td class='left'><input type='text' name='tlpPerusahaan' placeholder='No Telepon' onkeypress='return isNumberKey(event)' /></td>
				<td class='left'><input type='text' name='faxPerusahaan' placeholder='FAX' /></td>
				<td class='left' colspan='3'><input type='text' name='emailPerusahaan' size='30' placeholder='Email' /></td>
			  </tr>
			  <tr>
			  	<td class='left'>Petugas yang dihubungi</td>
				<td class='left' colspan='3'><input type='text' name='petugasDihubungi' /></td>
				<td class='left' style='border-right:none;'>Jabatan</td>
				<td class='left' colspan='2'>: <input type='text' name='jabatan' /></td>
			  </tr>
			</tbody>
		</table>
		
		<table class='list'> 
		  <thead>
			  <tr>
				<td class='center'>Perjalanan</td>
				<td class='center'>Staff</td>
				<td class='center'>Tour Leader</td>
				<td class='center'>Average</td>
			  </tr>
		  </thead>
		  <tbody>	  
			  <tr>
				<td class='center'><div id='totalPrice' style='font-size:20px;'></div></td>
				<td class='center'><div id='totalTConsult' style='font-size:20px;'></div></td>
				<td class='center'><div id='totalTL' style='font-size:20px;'></div></td>
				<td class='center'><div id='totalAvg' style='font-size:20px;'></div>
					<input type='hidden' name='totalAvg2' id='totalAvg2' />
				</td>
			  </tr>
		  </tbody> 
		</table>
		
		<table class='list'> 
			<tbody>
			  <tr>
			  	<td align='center'>
					<input type=submit value='SAVE DATA' class='button'>
					<input type=button value='CLOSE' class='button' onclick=self.history.back()>
				</td>
			  </tr>
			</tbody>
		</table>
		</div>
	</form>";
break;

case "view":
	echo "<link href='style.css' rel='stylesheet' type='text/css' />";
	$sql = mysql_query("SELECT * FROM tbl_trquestion WHERE QuestionID = '$_GET[id]'");
  	$row = mysql_fetch_array($sql);
	$Perjalanan = $row[extAcara] + $row[extPenerbangan] + $row[extTransformasi] + $row[extWisata] + $row[extAkomodasi] +
				  $row[extSajian] + $row[extBelanja] + $row[extPemandu] + $row[extTLpanorama];
	$Staff = $row[inOperator] + $row[inTourConsultant] + $row[inKasir] + $row[inDocument] + $row[inAirport];
	$TL = $row[inPerjalanan] + $row[inInformasi] + $row[inSuasana] + $row[inAcara] + $row[inMasalah];
	
	$TotalTL = $TL / 5;
	$TotalStaff = $Staff / 5;
	$TotalPerjalanan = $Perjalanan / 9;
	$TotalAverage = ($TL + $Staff + $Perjalanan) / 19;
	
	echo"
		<div id='stickyalias'></div>
		
		<div id='othercontent'>
		<h2>View Questioner</h2>
		<table class='list'> 
		  <tbody>
		    <tr>
				<td class='left' colspan='2'><div align='justify'>Atas kepercayaan Anda untuk menggunakan produk <b>Panorama Tours.</b> untuk meningkatkan pelayanan kami di waktu mendatang, kami sangat mengharapkan Anda dapat meluangkan waktu untuk memberi komentar atas pelayanan yang kami berikan. Setiap komentar Anda sangat berharga bagi kami untuk bertumbuh dan bekerja lebih baik</div></td>
			</tr>
			<tr>
				<td class='left'>Apakah Anda pernah menggunakan produk <b>Panorama Tours</b> sebelumnya?</td>
				<td class='left'> $row[isProduct]</td>
			</tr>
			<tr>
				<td class='left'>Jika YA, apakah Anda mempunyai lebih dari satu favorit biro perjalanan wisata?</td>
				<td class='left'> $row[isFavorite]</td>
			</tr>
			<tr>
				<td class='left'>Jika TIDAK, dari mana Anda mengetahui <b>Panorama Tours</b>?</td>
				<td class='left'><b>&raquo;</b> $row[isKnowing]</td>
			</tr>
			<tr>
				<td class='left'>Menurut Anda, apakah sarana informasi yang paling efektif?</td>
				<td class='left'><b>&raquo;</b> $row[isEffective]</td>
			</tr>
			
			<tr>
				<td class='left'>Menurut Anda, apakah keunggulan produk <b>Panorama Tours</b> (boleh memilih dari satu)?</td>
				<td class='left'><b>&raquo;</b> $row[isSuperior]</td>
			</tr>
		  </tbody>
		</table>
		
		<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
		 	Perjalanan Anda
		</div>
		  <table class='list' id='perjalanan' border='1'>   
              <thead>
			  	<tr>
				    <td class='center'></td>
					<td class='center' width='20%'>PENILAIAN</td>
				</tr>
			  </thead>
			  <tbody>
				  <tr>
					<td class='left'>Susunan Acara Perjalanan</td>
					<td class='center'>$row[extAcara]</td>
				  </tr>
				  <tr>
					<td class='left'>Perusahaan Penerbangan <b>$row[AirlineName]</b></td>
					<td class='center'>$row[extPenerbangan]</td>
				  </tr>
				  <tr>
					<td class='left'>Transfortasi Darat (Bus, kereta, dan lain-lain)</td>
					<td class='center'>$row[extTransformasi]</td>
				  </tr>
				  <tr>
					<td class='left'>Obyek Wisata</td>
					<td class='center'>$row[extWisata]</td>
				  </tr>
				  <tr>
					<td class='left'>Hotel Akomodasi</td>
					<td class='center'>$row[extAkomodasi]</td>
				  </tr>
				  <tr>
					<td class='left'>Sajian Makanan</td>
					<td class='center'>$row[extSajian]</td>
				  </tr>
				  <tr>
					<td class='left'>Waktu Belanja</td>
					<td class='center'>$row[extBelanja]</td>
				  </tr>
				  <tr>
					<td class='left'>Pemandu Wisata Setempat</td>
					<td class='center'>$row[extPemandu]</td>
				  </tr>
				  <tr>
					<td class='left'>Tour Leader Panorama Tour</td>
					<td class='center'>$row[extTLpanorama]</td>
				  </tr>
				  <tr>
					<td class='left'>Kesan dan Saran Anda terhadap keseluruhan perjalanan?</td>
					<td class='left'><b>&raquo;</b> $row[extKesan]</td>
				  </tr>
				  <tr>
				  	<td colspan='2'><br>*) Makna Penialaian<br>
						&rArr; 3 Sangat Memuaskan<br>
						&rArr; 2 Memuaskan<br>
						&rArr; 1 Tidak Memuaskan</td>
				  </tr>
              </tbody>
		  </table>
		
		<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
		 	Pelayanan Kami
		</div>
		  <table class='list' id='pelayanan' border='1'>   
              <thead>
			  	<tr>
				    <td class='center'></td>
					<td class='center' width='20%'>PENILAIAN</td>
				</tr>
			  </thead>
			  <tbody>
				  <tr>
					<td class='left'>Petugas Operator</td>
					<td class='center'>$row[inOperator]</td>
				  </tr>
				  <tr>
				   <td class='left'>Tour Consultant</td>
				   <td class='center'>$row[inTourConsultant]</td>
				  </tr>
				  <tr>
					<td class='left'>Petugas Kasir</td>
					<td class='center'>$row[inKasir]</td>
				  </tr>
				  <tr>
					<td class='left'>Petugas Dokumen Perjalanan</td>
					<td class='center'>$row[inDocument]</td>
				  </tr>
				  <tr>
					<td class='left'>Petugas Airport</td>
					<td class='center'>$row[inAirport]</td>
				  </tr>
				  <tr>
					<td class='left' style='border-right:none;'><font color='#FF6600'><i>Tour Leader</i></font></td>
					<td class='center'></td>
				  </tr>
				  <tr>
				   <td class='left'>Pelayanan yang diberikan selama perjalanan</td>
				   <td class='center'>$row[inPerjalanan]</td>
				  </tr>
				  <tr>
					<td class='left'>Informasi mengenai obyek wisata yang dikunjungi</td>
					<td class='center'>$row[inInformasi]</td>
				  </tr>
				  <tr>
					<td class='left'>Menghidupkan suasana selama perjalanan</td>
					<td class='center'>$row[inSuasana]</td>
				  </tr>
				  <tr>
					<td class='left'>Pengaturan acara perjalanan</td>
					<td class='center'>$row[inAcara]</td>
				  </tr>
				  <tr>
					<td class='left'>Penyelesaian masalah yang terjadi selama perjalanan</td>
					<td class='center'>$row[inMasalah]</td>
				  </tr>
				  <tr>
					<td class='left'>Kesan dan Saran Anda terhadap keseluruhan pelayanan kami?</td>
					<td class='left'><b>&raquo;</b> $row[inKesan]</td>
				  </tr>
				  <tr>
				  	<td colspan='2'><br>*) Makna Penialaian<br>
						&rArr; 3 Sangat Memuaskan<br>
						&rArr; 2 Memuaskan<br>
						&rArr; 1 Tidak Memuaskan</td>
				  </tr>
              </tbody>
			</table>
			  
			<table class='list'> 
			  <tbody>
				  <tr>
				  	<td class='left'>Apakah Anda menikmati perjalanan Anda sesuai dengan yang Anda harapkan?</td>
					<td class='left' width='20%'>$row[isNikmat]</td>
				  </tr>
				  <tr>
				  	<td class='left'>Apakah Anda berminat untuk mengikuti acara <b>Panorama Tours</b> berikutnya?</td>
					<td class='left'>$row[isMinat]</td>
				  </tr>
				  <tr>
				  	<td class='left'>Jika YA, sebutkan waktu dan tujuan wisata anda berikutnya?</td>
					<td class='left'>$row[isLiburSekolah] <b>&raquo;</b> $row[liburSekolah]<br />
									 $row[isLiburLebaran] <b>&raquo;</b> $row[liburLebaran]<br />
									 $row[isLiburNatal] <b>&raquo;</b> $row[liburNatal]
					</td>
				  </tr>
			  </tbody>
		    </table>
		
		<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
		 	Data Anda
		</div>
		<table class='list'> 
			<tbody>
			  <tr>
			  	<td class='left'>Nama Lengkap</td>
				<td class='left'>$row[Nama]</td>
			  </tr>
			  <tr>
			  	<td class='left'>No. Telp.</td>
				<td class='left'>$row[teleponPribadi]</td>
			  </tr>
			  <tr>
			  	<td class='left'>Fax</td>
			  	<td class='left'>$row[faxPribadi]</td>
			  </tr>
			  <tr>
			  	<td class='left'>Email</td>
			  	<td class='left'>$row[emailPribadi]</td>
			  </tr>
			  <tr>
				<td class='left'>Apakah Perusahaan Anda menginginkan berkerja sama dengan kami?</td>
				<td class='left'>$row[isPerusahaan]</td>
			  </tr>
			  <tr>
				<td class='left' colspan='2'>Jika YA, mohon Anda mengisi data dibawah ini agar dapat dihubungi oleh Account Executive kami.</td>
			  </tr>
			  <tr>
			  	<td class='left'>Nama Perusahaan</td>
				<td class='left' colspan='5'>$row[perusahaan]</td>
			  </tr>
			  <tr>
			  	<td class='left'>Alamat Lengkap</td>
				<td class='left' colspan='5'>$row[alamatPerusahaan]</td>
			  </tr>
			  <tr>
			  	<td class='left'>No. Telp.</td>
				<td class='left'>$row[tlpPerusahaan]</td>
			  </tr>
			  <tr>
			  	<td class='left'>Fax</td>
			  	<td class='left'>$row[faxPerusahaan]</td>
			  </tr>
			  <tr>
			  	<td class='left'>Email</td>
			  	<td class='left'>$row[emailPerusahaan]</td>
			  </tr>
			  <tr>
			  	<td class='left'>Petugas yang dihubungi</td>
				<td class='left' colspan='3'>$row[dihubungi] ($row[dihubungi])</td>
			  </tr>
			</tbody>
		</table>
		
		<table class='list'> 
			  <thead>
				  <tr>
				  	<td class='center'>Perjalanan</td>
					<td class='center'>Staff</td>
					<td class='center'>Tour Leader</td>
					<td class='center'>Average</td>
				  </tr>
			  </thead>
			  <tbody>	  
				  <tr>
				  	<td class='center'>$TotalPerjalanan</td>
					<td class='center'>$TotalStaff</td>
					<td class='center'>$TotalTL</div></td>
					<td class='center'>$TotalAverage</td>
				  </tr>
			  </tbody> 
			</table>
		
		<table class='list'> 
			<tbody>
			  <tr>
			  	<td align='center'>
					<input type=button value='CLOSE' class='button' onclick=self.history.back()>
				</td>
			  </tr>
			</tbody>
		</table>
		</div>";
break;

case "tersimpan":
 	echo"<h2 align='center'>Thank You</h2><p align='center'>Your Data Has Been Saved</p>";
break;
}
	?>