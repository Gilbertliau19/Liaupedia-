<?php

session_start();
require "koneksi.php";

$cmd = $_GET["cmd"];

if(!empty($_SESSION["kodeuser"])) {
	$kodeuser = $_SESSION["kodeuser"];
}

if($cmd == "ProdukDetail") {
	$kodebarang = $_GET["kodebarang"];

	if(!empty($_SESSION["kodeuser"])) {
		date_default_timezone_set("Asia/Jakarta");
		$created_at = date("Y-m-d H:i:s");
		$updated_at = date("Y-m-d H:i:s");

		$sqlCekHistory = "SELECT * FROM tbhistory WHERE kodebarang='$kodebarang' AND kodeuser='$kodeuser';";
		$queryCekHistory = mysqli_query($conn, $sqlCekHistory) or die("error: $sqlCekHistory");
		$numCekHistory = mysqli_num_rows($queryCekHistory);

		if($numCekHistory == 0) {
			
			$sqlMasukHistory = "INSERT INTO tbhistory(kodeuser, kodebarang, created_at, updated_at) VALUES('$kodeuser', '$kodebarang', '$created_at', '$updated_at');";
			$queryMasukHistory = mysqli_query($conn, $sqlMasukHistory) or die("error: $sqlMasukHistory");
		}else {
			
			$sqlUpdateHistory = "UPDATE tbhistory SET updated_at='$updated_at' WHERE tbhistory.kodebarang='$kodebarang' AND tbhistory.kodeuser='$kodeuser';";
			$queryUpdateHistory = mysqli_query($conn, $sqlUpdateHistory) or die("error: $sqlUpdateHistory");
		}	
	}

	$sql = "SELECT tbbarang.nama, tbjualdetil.jlh, tbbarang.jlh_stok, tbbarang.hargajual, tbbarang.disc, tbbarang.image, tbbarang.deskripsi FROM tbbarang LEFT JOIN tbjualdetil ON tbbarang.kodebarang = tbjualdetil.kodebarang WHERE tbbarang.kodebarang='$kodebarang';";
	$query = mysqli_query($conn, $sql) or die("error: $sql");
	$num = mysqli_num_rows($query);
	$result = mysqli_fetch_array($query);
	$nama = $result["nama"];
	if(isset($result["jlh"])) {
		$jlh = $result["jlh"];
	} else {
		$jlh = 0;
	}
	$jlh_stok = $result["jlh_stok"];
	$hargajual = $result["hargajual"];
	$disc = $result["disc"];
	$image = $result["image"];
	$deskripsi = $result["deskripsi"];
	?>
	<div class="container" style="padding: 40px 0 40px 0;">
		<div class="row">
			<div class="col-md-12">
				<u><i><a href="index.php"  style="color: #fc035a; text-decoration : none;">Home</a></i></u>
			</div>
		</div>
		<div class="row" id="alertBerhasilMasukanBarangDalamKeranjang" style="display: none;">
			<div class="col-md-12">
				<center><div style="margin-top: 16px;" class="alert alert-success" role="alert">
				  Barang sudah masuk dalam keranjang
				</div></center>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<img class="d-block w-100" src="<?php echo $image; ?>">
			</div>
			<div class="col-md-8">
				<h3><?php echo $nama; ?></h3>
				<h1 class="text-primary">Rp<?php echo number_format($hargajual-$disc, 0, ',', '.'); ?>
					<span class="text-secondary h6"><s>Rp<?php echo number_format($hargajual, 0, ',', '.'); ?></s></span>
				</h1>
				<i><p>Deskripsi Barang: <br><?php echo $deskripsi; ?></p></i>
				<div class="d-grid gap-2 d-md-block">
				  	<button style="border-radius :20px; width :5%;"class="btn btn-primary" onclick="kurangJumlahBarang('<?php echo $hargajual-$disc; ?>')" type="button">-</button>
				  	<input id="jlh" style="width: 60px; text-align: center;" type="number" value="1" placeholder="Jumlah Beli Barang">
				  	<button style="border-radius :20px; width :5%;" class="btn btn-primary" onclick="tambahJumlahBarang('<?php echo $hargajual-$disc; ?>')" type="button">+</button>
				</div>
				<p>Barang tersisa: <?php echo $jlh_stok; ?> buah.</p>
				<h4 id="totalDetailBarang" class="fw-bold">Total: Rp<?php echo number_format($hargajual-$disc, 0, ',', '.'); ?></h4>
				<input type="hidden" id="inputTotalDetailBarang" value="<?php echo $hargajual-$disc; ?>">
				<?php
				if(isset($_SESSION["kodeuser"])) { 
					?>
					<button onclick="ProdukDalamKeranjang('<?php echo $kodebarang; ?>', '<?php echo $hargajual-$disc; ?>')" type="button" class="btn btn-primary">Masukkan Barang Dalam Keranjang</button>
					<?php
				} else { 
					?>
					<button onclick="location.href = 'login.php';" type="button" class="btn btn-primary">Masukkan Barang Dalam Keranjang</button>
					<?php
				}
				?>

			</div>
		</div>
	</div>
	<?php
}else if($cmd == "ProdukDalamKeranjang") {
	$kodebarang = $_GET["kodebarang"];
	$jlh = $_GET["jlh"];
	$harga = $_GET["harga"];
	$total = $_GET["total"];

	$sql = "SELECT * FROM tempjualdetil WHERE kodeuser='$kodeuser' AND kodebarang='$kodebarang';";
	$query = mysqli_query($conn, $sql) or die("error: $sql");
	$num = mysqli_num_rows($query);

	if($num == 1) {
		$result = mysqli_fetch_array($query);
		$jlhBaru = $jlh + $result["jlh"];
		$totalBaru = $jlhBaru * $harga;

		$sql = "UPDATE tempjualdetil SET jlh='$jlhBaru', total='$totalBaru' WHERE kodeuser='$kodeuser' AND kodebarang='$kodebarang';";
		$query = mysqli_query($conn, $sql) or die("error: $sql");
	} else {
		$sql = "SELECT MAX(no) as maxno FROM tbjualdetil;";
		$query = mysqli_query($conn, $sql) or die("error: $sql");
		$result = mysqli_fetch_array($query);

		if(!empty($result["maxno"])) {
			$maxno = $result["maxno"];
			$maxno_angka = $maxno[2] + 1;
			$maxnoBaru = "J-".$maxno_angka;
		} else {
			$maxnoBaru = "J-1";
		}

		$sql = "INSERT INTO tempjualdetil(no, kodeuser, kodebarang, jlh, harga, total) VALUES('$maxnoBaru', '$kodeuser', '$kodebarang', '$jlh', '$harga', '$total');";
		$query = mysqli_query($conn, $sql) or die("error: $sql");
		return;
	}
}else if($cmd == "hapusBarangKeranjang") {
	$notemp = $_GET["notemp"];

	$sql = "DELETE FROM tempjualdetil WHERE notemp='$notemp';";
	$query = mysqli_query($conn, $sql) or die("error: $sql");
}else if($cmd == "searchBarang") {
	$kuncipencarian = $_GET["kuncipencarian"];
	?>
	<div class="barangLaris" style="padding: 24px; margin-top: 60px; margin-bottom: 60px;">
		<div class="d-flex justify-content-between">
			<h4>Hasil Pencarian</h4>
			<a href="" class="h6 text-primary text-decoration-none">Lihat Lebih</a>
		</div>
		<div class="barangLarisList" style="display: flex; justify-content: space-between; flex-wrap: wrap;">
			<?php
				$sqlProduk = "SELECT * FROM tbbarang LEFT JOIN tbjualdetil on tbbarang.kodebarang = tbjualdetil.kodebarang WHERE tbbarang.nama LIKE '%$kuncipencarian%' GROUP BY tbbarang.kodebarang;";
				$queryProduk = mysqli_query($conn, $sqlProduk) or die("error: $sqlProduk");
				$numProduk = mysqli_num_rows($queryProduk);

				for($jumlahProduk = 1; $jumlahProduk <= $numProduk; $jumlahProduk++) {
					$resultProduk = mysqli_fetch_array($queryProduk);
					$kodebarangProduk = $resultProduk["kodebarang"];
					$namaBarangProduk = $resultProduk["nama"];
					$imageBarangProduk = $resultProduk["image"];
					$hargajualBarangProduk = $resultProduk["hargajual"];
					$jlh_stokBarangProduk = $resultProduk["jlh_stok"];
					?>
					<a class="barangLarisItem" style="text-decoration: none;" role="button" onclick="ProdukDetail('<?php echo $kodebarangProduk; ?>')">
						<img src="<?php echo $imageBarangProduk; ?>">		
						<div style="padding: 12px;">
							<h6><?php echo $namaBarangProduk; ?></h6>
							<div class="hargaBlock">
								<h6 class="text-primary">Rp<?php echo number_format($hargajualBarangProduk, 0, ',', '.'); ?></h6>
								<span style="font-size: 12px;"><?php echo $jlh_stokBarangProduk; ?> Produk</span>
							</div>
						</div>
					</a>					
					<?php
				}
			?>
		</div>
	</div>
	<?php
} else if($cmd == "checkout") {
	$kodeuser = $_SESSION["kodeuser"];
	?>
	<div class="container" style="margin-top: 16px;">
		<div class="row">
			<div class="col-md-12">
				<?php
				$sql = "SELECT * FROM tbuser WHERE kodeuser='$kodeuser';";
				$query = mysqli_query($conn, $sql) or die("error: $sql");
				$result = mysqli_fetch_array($query);
				?>
				<h4 style="font-weight: bold;">checkout</h4>
				<h6 style="font-weight: bold;">Alamat Pengiriman</h6>
				<div class="row">
					<div class="col-lg-8">
						<hr>
						<p style="margin: 0;" id="teksNama"><b><?php echo $result["nama"]; ?></b></p>
						<p style="margin: 0;" id="teksTelp"><?php echo $result["telp"]; ?></p>
						<p id="teksAlamat">Alamat: <?php echo $result["alamat"]; ?></p>
						<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ganti Alamat</button>
						<h6 style="font-weight: bold; margin-top: 10px;">Daftar Pesanan</h6>
						<table>
							<?php
								$kodeuser = $_SESSION["kodeuser"];
								$sqlKeranjang = "SELECT *, (tempjualdetil.jlh * tbbarang.disc) AS totaldisc FROM tempjualdetil INNER JOIN tbbarang on tempjualdetil.kodebarang = tbbarang.kodebarang WHERE kodeuser='$kodeuser'";
								$queryKeranjang = mysqli_query($conn, $sqlKeranjang) or die("error: $sqlKeranjang");
								$numKeranjang = mysqli_num_rows($queryKeranjang);
								$subtotalBarangKeranjang = 0;
								$grandtotalBarangKeranjang = 0;

								for($jumlahKeranjang = 1; $jumlahKeranjang <= $numKeranjang; $jumlahKeranjang++) {
									$resultKeranjang = mysqli_fetch_array($queryKeranjang);
									$notempBarangKeranjang = $resultKeranjang["notemp"];
									$namaBarangKeranjang = $resultKeranjang["nama"];
									$deskripsiBarangKeranjang = $resultKeranjang["deskripsi"];
									$jlhBarangKeranjang = $resultKeranjang["jlh"];
									$hargaBarangKeranjang = $resultKeranjang["harga"];
									$totalBarangKeranjang = $resultKeranjang["total"];
									$imageBarangKeranjang = $resultKeranjang["image"];
									$hargajualBarangKeranjang = $resultKeranjang["hargajual"];
									$totaldiscBarangKeranjang = $resultKeranjang["totaldisc"];
									$subtotalBarangKeranjang += $hargajualBarangKeranjang * $jlhBarangKeranjang;
									$grandtotalBarangKeranjang += $totalBarangKeranjang;
									?>
									<tr>
										<td><?php echo $jumlahKeranjang; ?></td>
										<td>
											<img style="width: 5rem;" src="<?php echo $imageBarangKeranjang; ?>">
											
										</td>
										<td>
											<h5 style="margin-top: 6px;"><?php echo $namaBarangKeranjang; ?></h5>
											<i><?php echo $deskripsiBarangKeranjang; ?></i>
											<p>Qty: <br><?php echo $jlhBarangKeranjang; ?> buah</p>
										</td>
										<td>
											<div style="border-left: 4px solid #29f276; height: 155px; position: relative;
															margin-left: 14px; margin-right: 14px; top: 0;">
											<br>
											<div style="padding-right : 20px;">
												<p style="text-indent: 10px;"> Harga : Rp<?php echo number_format($hargaBarangKeranjang, 0, ',', '.'); ?></p>
												<p style="text-indent: 10px;">Total : Rp<?php echo number_format($totalBarangKeranjang, 0, ',', '.'); ?></p>
												</div>
											</div>
										</td>
									</tr>
									<?php
								}
							?>
						</table>
					</div>
					<div class="col-md-4">
						<center><h4>Total</h4></center>
						<hr>
						<p>Subtotal (Belum diskon): <b>Rp<?php echo number_format($subtotalBarangKeranjang, 0, ',', '.'); ?></b></p>
						<hr>
						<center><p>Grand Total  <br><b>Rp <?php echo number_format($grandtotalBarangKeranjang, 0, ',', '.'); ?></b></br></p></center>
						<input type="hidden" id="subtotalTotal" value="<?php echo $subtotalBarangKeranjang; ?>">
						<input type="hidden" id="grandtotalTotal" value="<?php echo $grandtotalBarangKeranjang; ?>">
						<input type="hidden" id="discTotal" value="<?php echo $subtotalBarangKeranjang - $grandtotalBarangKeranjang; ?>">
						<div class="d-flex" style="margin-bottom: 14px; ">
							<div>
								<input type="radio" class="metode" id="cod" name="metode" value="COD" onclick="chooseMethodPayment()">
								<label for="cod">COD</label>
							</div>
							<div style="margin-left: 16px; ">
								<input type="radio" class="metode" id="transfer" name="metode" value="Transfer" onclick="chooseMethodPayment()">
								<label for="transfer">Transfer</label>
							</div>
						</div>
						<form id="formTransfer" style="display: none; ">
							<div class="form-group">
								<input type="text" class="form-control" id="norekening" placeholder="Nomor Rekening">
							</div>
							<div class="form-group" style="margin: 10px 0;">
								<input type="text" class="form-control" id="namapemilikrekening" placeholder="Nama Pemilik Rekening">
							</div>
						</form>
					<?php
						$sqlNomor = "SELECT MAX(no) as tinggiNomor FROM tbjualdetil;";
						$queryNomor = mysqli_query($conn, $sqlNomor) or die("error: $sqlNomor");
						$resultNomor = mysqli_fetch_array($queryNomor);

						$tinggiNomor = "";
						if(isset($resultNomor["tinggiNomor"])) {
							$tinggiNomor = $resultNomor["tinggiNomor"][2] + 1;
							$tinggiNomor = "J-".$tinggiNomor;
						} else {
							$tinggiNomor = "J-1";
						}
						?>
						<input type="hidden" id="noBarangKeranjang" value="<?php echo $tinggiNomor; ?>">
						<button type="button" id="btnBayar" class="btn btn-primary" onclick="BayarPesanan('<?php echo $tinggiNomor; ?>')">Pilih Metode Pembayaran</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="exampleModal" aria-hidden="true" tabindex="-1">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Alamat Baru</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	      	<?php
	      		$sqlUser = "SELECT * FROM tbuser WHERE kodeuser='$kodeuser'";
	      		$queryUser = mysqli_query($conn, $sqlUser) or die("error: $sqlUser");
	      		$resultUser = mysqli_fetch_array($queryUser);
	      	?>
	      	<div class="form-group">
	      		<input type="text" value="<?php echo $resultUser['nama']; ?>" class="form-control" id="nama" placeholder="Nama Lengkap">
	      	</div>
	      	<div class="form-group" style="margin-top: 10px;">
	      		<input type="text" value="<?php echo $resultUser['telp']; ?>" class="form-control" id="telp" placeholder="Nomor Telepon">
	      	</div>
	      	<div class="form-group" style="margin-top: 10px;">
	      		<input type="text" value="<?php echo $resultUser['alamat']; ?>" class="form-control" id="alamat" placeholder="Alamat Pengiriman">
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" onclick="gantiAlamatBaru()">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>

	<?php
} else if($cmd == "BayarPesanan") {
	$metode = $_GET["metode"];
	$kodeuser = $_SESSION["kodeuser"];

	$sql = "INSERT INTO tbjualdetil(no, kodebarang, jlh, harga, total) SELECT no, kodebarang, jlh, harga,total FROM tempjualdetil";
	$query = mysqli_query($conn, $sql) or die("error: $sql");

	$tgl = date("Y-m-d");
	$no = $_GET["no"];
	$subtotal = $_GET["subtotal"];
	$disc = $_GET["disc"];
	$grandtotal = $_GET["grandtotal"];

	if($metode == "transfer") {
		$sql = "INSERT INTO tbpembayaran(notransaksi, kodeuser, metode, status, total) VALUES('$no', '$kodeuser', '$metode', 'Belum Lunas', '$grandtotal');";
		$query = mysqli_query($conn, $sql) or die("error: $sql");
	} else if($metode == "cod") {
		$sql = "INSERT INTO tbpembayaran(notransaksi, kodeuser, metode, status, total) VALUES('$no', '$kodeuser', '$metode', 'Lunas', '$grandtotal');";
		$query = mysqli_query($conn, $sql) or die("error: $sql");
	}
	$sql = "INSERT INTO tbjual(no, tgl, kodeuser, subtotal, disc, pajak, grandtotal) VALUES('$no', '$tgl', '$kodeuser', '$subtotal', '$disc', '0', '$grandtotal')";
	$query = mysqli_query($conn, $sql) or die("error: $sql");

	$sql = "DELETE FROM tempjualdetil WHERE kodeuser='$kodeuser';";
	$query = mysqli_query($conn, $sql) or die("error: $sql");
} else if($cmd == "selesaikanPembayaran") {
	$no = $_GET["no"];
	$sql = "SELECT total, notransaksi FROM tbpembayaran WHERE kodeuser='$kodeuser' AND notransaksi='$no';";
	$query = mysqli_query($conn, $sql) or die("error: $sql");
	$result = mysqli_fetch_array($query);
	$total = $result["total"];
	$no = $result["notransaksi"];
	?>
	<div class="container" style="margin-top: 40px;">
		<div class="row justify-content-center">
			<div class="col-lg-4">
				<h4 style="text-align: center;">Selesaikan Pembayaran</h4>
				<h6 style="color: orange; text-align: center;">24:00:00</h6>
				<span style="color: grey; text-align: center; display: block;">Batas  Pembayaran</span>
				<h6 style="text-align: center; font-weight: bold;">Selasa, 26 Januari 2021 18:22</h6>
				<hr>
				<h6>Transfer</h6>
				<div style="display: flex; justify-content: space-between; align-items: center;">
					<div>
						<span style="color: grey; text-align: center; display: block;">Nomor Rekening PT. Liaupedia</span>
						<p><b>089132412</b></p>
					</div>
					<div>
						<p style="color: blue;"><b>Copy</b></p>
					</div>
				</div>
				<div style="display: flex; justify-content: space-between; align-items: center;">
					<div>
						<span style="color: grey; text-align: center; display: block;">Total Pembayaran</span>
						<p><b>Rp<?php echo $total; ?></b></p>
					</div>
					<div>
						<p style="color: blue;"><b>Lihat Detail</b></p>
					</div>
				</div>
				<button class="btn btn-primary" onclick="uploadBuktiPembayaran('<?php echo $no; ?>')">Upload Bukti Pembayaran</button>
				<input style="opacity: 0;" type="file" id="buktiPembayaran">
			</div>
		</div>
	</div>
	<?php
} else if($cmd == "uploadBuktiPembayaran") {
	$no = $_GET["no"];

	$sql = "UPDATE tbpembayaran SET status='Lunas' WHERE notransaksi='$no' AND kodeuser='$kodeuser';";
	$query = mysqli_query($conn, $sql) or die("error: $sql");
	echo $sql;
	return;
} else if($cmd == "gantiAlamatBaru") {
	$nama = $_GET["nama"];
	$telp = $_GET["telp"];
	$alamat = $_GET["alamat"];

	$sql = "UPDATE tbuser SET nama='$nama', telp='$telp', alamat='$alamat' WHERE tbuser.kodeuser='$kodeuser';";
	$query = mysqli_query($conn, $sql) or die("error: $sql");
} else if($cmd == "ubahjumlahbarang") {
	$notemp = $_GET["notemp"];
	$jlh = $_GET["jlh"];
	$total = $_GET["total"];
	$sql = "UPDATE tempjualdetil SET tempjualdetil.jlh='$jlh', tempjualdetil.total='$total' WHERE tempjualdetil.notemp='$notemp';";
	$query = mysqli_query($conn, $sql) or die("error: $sql");
}
?>