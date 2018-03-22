<?php
	include "../config/koneksi.php";
	echo "<link href='style.css' rel='stylesheet' type='text/css' />
		  <link href='css/button.css' rel='stylesheet' type='text/css' />";
	$sql = mysql_query("SELECT * FROM tbl_trquestion WHERE QuestionID = '$_GET[id]'");
  	$row = mysql_fetch_array($sql);
	$Perjalanan = $row[extAcara] + $row[extPenerbangan] + $row[extTransportasi] + $row[extWisata] + $row[extAkomodasi] +
				  $row[extSajian] + $row[extBelanja] + $row[extPemandu] + $row[extTLpanorama];
	$Staff = $row[inOperator] + $row[inTourConsultant] + $row[inKasir] + $row[inDocument] + $row[inAirport];
	$TL = $row[inPerjalanan] + $row[inInformasi] + $row[inSuasana] + $row[inAcara] + $row[inMasalah];
	
	$TotalTL = number_format(($TL / 5), 2);
	$TotalStaff = number_format(($Staff / 5), 2);
	$TotalPerjalanan = number_format(($Perjalanan / 9), 2);
	$TotalAverage = number_format((($TL + $Staff + $Perjalanan) / 19), 2);
	
	echo"<div id='stickyalias'></div>
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
		</table>";
	
	if($row[extAcara]=='3'){ $Acara = "Sangat Memuaskan";}
		elseif($row[extAcara]=='2'){ $Acara = "Memuaskan";}
		elseif($row[extAcara]=='1'){ $Acara = "Tidak Memuaskan";}
	if($row[extPenerbangan]=='3'){ $Terbang = "Sangat Memuaskan";}
		elseif($row[extPenerbangan]=='2'){ $Terbang = "Memuaskan";}
		elseif($row[extPenerbangan]=='1'){ $Terbang = "Tidak Memuaskan";}
	if($row[extTransportasi]=='3'){ $Transportasi = "Sangat Memuaskan";}
		elseif($row[extTransportasi]=='2'){ $Transportasi = "Memuaskan";}
		elseif($row[extTransportasi]=='1'){ $Transportasi = "Tidak Memuaskan";}
	if($row[extWisata]=='3'){ $Wisata = "Sangat Memuaskan";}
		elseif($row[extWisata]=='2'){ $Wisata = "Memuaskan";}
		elseif($row[extWisata]=='1'){ $Wisata = "Tidak Memuaskan";}
	if($row[extAkomodasi]=='3'){ $Akomodasi = "Sangat Memuaskan";}
		elseif($row[extAkomodasi]=='2'){ $Akomodasi = "Memuaskan";}
		elseif($row[extAkomodasi]=='1'){ $Akomodasi = "Tidak Memuaskan";}
	if($row[extSajian]=='3'){ $Sajian = "Sangat Memuaskan";}
		elseif($row[extSajian]=='2'){ $Sajian = "Memuaskan";}
		elseif($row[extSajian]=='1'){ $Sajian = "Tidak Memuaskan";}
	if($row[extBelanja]=='3'){ $Belanja = "Sangat Memuaskan";}
		elseif($row[extBelanja]=='2'){ $Belanja = "Memuaskan";}
		elseif($row[extBelanja]=='1'){ $Belanja = "Tidak Memuaskan";}
	if($row[extPemandu]=='3'){ $Pemandu = "Sangat Memuaskan";}
		elseif($row[extPemandu]=='2'){ $Pemandu = "Memuaskan";}
		elseif($row[extPemandu]=='1'){ $Pemandu = "Tidak Memuaskan";}
	if($row[extTLpanorama]=='3'){ $TLpanorama = "Sangat Memuaskan";}
		elseif($row[extTLpanorama]=='2'){ $TLpanorama = "Memuaskan";}
		elseif($row[extTLpanorama]=='1'){ $TLpanorama = "Tidak Memuaskan";}
   echo"<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
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
					<td class='left'>$Acara</td>
				  </tr>
				  <tr>
					<td class='left'>Perusahaan Penerbangan <b>$row[AirlineName]</b></td>
					<td class='left'>$Terbang</td>
				  </tr>
				  <tr>
					<td class='left'>Transportasi Darat (Bus, kereta, dan lain-lain)</td>
					<td class='left'>$Transportasi</td>
				  </tr>
				  <tr>
					<td class='left'>Obyek Wisata</td>
					<td class='left'>$Wisata</td>
				  </tr>
				  <tr>
					<td class='left'>Hotel Akomodasi</td>
					<td class='left'>$Akomodasi</td>
				  </tr>
				  <tr>
					<td class='left'>Sajian Makanan</td>
					<td class='left'>$Sajian</td>
				  </tr>
				  <tr>
					<td class='left'>Waktu Belanja</td>
					<td class='left'>$Belanja</td>
				  </tr>
				  <tr>
					<td class='left'>Pemandu Wisata Setempat</td>
					<td class='left'>$Pemandu</td>
				  </tr>
				  <tr>
					<td class='left'>Tour Leader Panorama Tour</td>
					<td class='left'>$TLpanorama</td>
				  </tr>
				  <tr>
					<td class='left'>Kesan dan Saran Anda terhadap keseluruhan perjalanan?</td>
					<td class='left'><b>&raquo;</b> $row[extKesan]</td>
				  </tr>
              </tbody>
		  </table>";
	if($row[inOperator]=='3'){ $Operator = "Sangat Memuaskan";}
		elseif($row[inOperator]=='2'){ $Operator = "Memuaskan";}
		elseif($row[inOperator]=='1'){ $Operator = "Tidak Memuaskan";}
	if($row[inTourConsultant]=='3'){ $TourConsultant = "Sangat Memuaskan";}
		elseif($row[inTourConsultant]=='2'){ $TourConsultant = "Memuaskan";}
		elseif($row[inTourConsultant]=='1'){ $TourConsultant = "Tidak Memuaskan";}	
	if($row[inKasir]=='3'){ $Kasir = "Sangat Memuaskan";}
		elseif($row[inKasir]=='2'){ $Kasir = "Memuaskan";}
		elseif($row[inKasir]=='1'){ $Kasir = "Tidak Memuaskan";}	
	if($row[inDocument]=='3'){ $Document = "Sangat Memuaskan";}
		elseif($row[inDocument]=='2'){ $Document = "Memuaskan";}
		elseif($row[inDocument]=='1'){ $Document = "Tidak Memuaskan";}
	if($row[inAirport]=='3'){ $Airport = "Sangat Memuaskan";}
		elseif($row[inAirport]=='2'){ $Airport = "Memuaskan";}
		elseif($row[inAirport]=='1'){ $Airport = "Tidak Memuaskan";}
	if($row[inPerjalanan]=='3'){ $inPerjalanan = "Sangat Memuaskan";}
		elseif($row[inPerjalanan]=='2'){ $inPerjalanan = "Memuaskan";}
		elseif($row[inPerjalanan]=='1'){ $inPerjalanan = "Tidak Memuaskan";}	
	if($row[inInformasi]=='3'){ $Informasi = "Sangat Memuaskan";}
		elseif($row[inInformasi]=='2'){ $Informasi = "Memuaskan";}
		elseif($row[inInformasi]=='1'){ $Informasi = "Tidak Memuaskan";}	
	if($row[inSuasana]=='3'){ $Suasana = "Sangat Memuaskan";}
		elseif($row[inSuasana]=='2'){ $Suasana = "Memuaskan";}
		elseif($row[inSuasana]=='1'){ $Suasana = "Tidak Memuaskan";}	
	if($row[inAcara]=='3'){ $inAcara = "Sangat Memuaskan";}
		elseif($row[inAcara]=='2'){ $inAcara = "Memuaskan";}
		elseif($row[inAcara]=='1'){ $inAcara = "Tidak Memuaskan";}
	if($row[inMasalah]=='3'){ $Masalah = "Sangat Memuaskan";}
		elseif($row[inMasalah]=='2'){ $Masalah = "Memuaskan";}
		elseif($row[inMasalah]=='1'){ $Masalah = "Tidak Memuaskan";}
   echo"<div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">
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
					<td class='left'>$Operator</td>
				  </tr>
				  <tr>
				   <td class='left'>Tour Consultant</td>
				   <td class='left'>$TourConsultant</td>
				  </tr>
				  <tr>
					<td class='left'>Petugas Kasir</td>
					<td class='left'>$Kasir</td>
				  </tr>
				  <tr>
					<td class='left'>Petugas Dokumen Perjalanan</td>
					<td class='left'>$Document</td>
				  </tr>
				  <tr>
					<td class='left'>Petugas Airport</td>
					<td class='left'>$Airport</td>
				  </tr>
				  <tr>
					<td class='left' style='border-right:none;'><font color='#FF6600'><i>Tour Leader</i></font></td>
					<td class='center'></td>
				  </tr>
				  <tr>
				   <td class='left'>Pelayanan yang diberikan selama perjalanan</td>
				   <td class='left'>$inPerjalanan</td>
				  </tr>
				  <tr>
					<td class='left'>Informasi mengenai obyek wisata yang dikunjungi</td>
					<td class='left'>$Informasi</td>
				  </tr>
				  <tr>
					<td class='left'>Menghidupkan suasana selama perjalanan</td>
					<td class='left'>$Suasana</td>
				  </tr>
				  <tr>
					<td class='left'>Pengaturan acara perjalanan</td>
					<td class='left'>$inAcara</td>
				  </tr>
				  <tr>
					<td class='left'>Penyelesaian masalah yang terjadi selama perjalanan</td>
					<td class='left'>$Masalah</td>
				  </tr>
				  <tr>
					<td class='left'>Kesan dan Saran Anda terhadap keseluruhan pelayanan kami?</td>
					<td class='left'><b>&raquo;</b> $row[inKesan]</td>
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
					<td class='left'>";
						if($row[isLiburSekolah] != "" or $row[liburSekolah] != "") {
							echo "$row[isLiburSekolah] <b>&raquo;</b> $row[liburSekolah]<br />";
						}
						if($row[isLiburLebaran] != "" or $row[liburLebaran] !=""){
							echo "$row[isLiburLebaran] <b>&raquo;</b> $row[liburLebaran]<br />";
						}
						if($row[isLiburNatal] != "" or $row[liburNatal] != "") {
							echo "$row[isLiburNatal] <b>&raquo;</b> $row[liburNatal]";
						}
	echo "			</td>
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
			  	<td class='left'>Alamat Tempat Tinggal</td>
				<td class='left' colspan='5'>$row[alamatTempatTinggal]</td>
			  </tr>
			  <tr>
				<td class='left'>Apakah Perusahaan Anda menginginkan berkerja sama dengan kami?</td>
				<td class='left'>$row[isPerusahaan]</td>
			  </tr>
			  <tr>
				<td class='left' colspan='2'>
				Jika YA, mohon Anda mengisi data dibawah ini agar dapat dihubungi oleh Account Executive kami.</td>
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
				<td class='left' colspan='3'>$row[dihubungi] ($row[jabatan])</td>
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
					<input type=button value='CLOSE' class='button' onclick='self.close()'>
				</td>
			  </tr>
			</tbody>
		</table>
		</div>";
?>