<?php
	session_start();
	require "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Homepage</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		body {
			font-family: 'Roboto', sans-serif;
			padding : 40px;
		}
		.navbar{
			background-color: #6787c7;
			height : 80px;
		}
		.nav-link{
			font-size : 16px;
		}
		.btn{
			background-color : #06d6a0;
		}
		.banner img {
			width: 100%;
			background-position: center;
			background-size: contain;
			height: 388px;
		}
		.LarisBarangItem {
			width: 15.5%;
			text-decoration: none;
			color: black;
			border: 1px solid black;
			border-radius: 10px;
		}
		.LarisBarangItem img {
			width: 100%;
			border-radius: 10px;
		}
		.dropbtn {
		  color: white;
		  padding: 10px;
		  border: none;
		  cursor: pointer;
		}
		.dropdown {
		  position: relative;
		  display: inline-block;
		}
		.dropdown-content {
		  display: none;
		  position: absolute;
		  background-color: #f9f9f9;
		  min-width: 160px;
		  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		  z-index: 1;
		}
		.dropdown-content a {
		  color: black;
		  padding: 12px 16px;
		  text-decoration: none;
		  display: block;
		}
		.dropdown-content a:hover 
		{background-color: #B7C3F3
		}

		.dropdown:hover .dropdown-content {
		  display: block;
		}


		.dropdown:hover .dropbtn {
		  background-color: #B7C3F3 ;
		  border-radius  : 8px;
		}
		.fa{
			width : 40px;
			color : white;
			padding-top :10px;
		}
		footer{
			text-align: center; 
			color: white; 
			padding: 24px;
			height :100%;
			z-index: 0;
			margin-bottom: -50px;
			margin-left: -40px;
			margin-right: -40px;
			background-color: #6787c7; 
		}
		.carousel{
			padding : 40px;
		}
	</style>
<body>
	<nav class="navbar navbar-expand-lg  fixed-top">
		<div class="container">
			<a class="navbar-brand" href="index.php">
				<img src="img/Liaupedia.png">
			</a>
			<ul class="navbar-nav" style="margin-left: 24px; width: 600px;	">
				<div class="input-group">
					<input id="inputSearchBarang" type="search" class="form-control" placeholder="Search...">
					<button class="btn btn-primary" onclick="searchBarang()">
						<i class="fa fa-search"></i>	
					</button>
				</div>
			</ul>

			<ul class="navbar-nav ms-auto">
				<?php
					if(isset($_SESSION["nama"])){
						?>
							
						<?php
					}
					if(isset($_SESSION["nama"])){
						?>
						<a class="nav-link" href="keranjang.php"><i class="fa fa-cart-plus"></i></a>
						<div class="dropdown">
							<div class="dropbtn">
							<a class="nav-link" style="color : white;" href=""><?php echo $_SESSION["nama"]; ?></a></div>
								<div class="dropdown-content">
								<a style="color : red" href="logout.php">Logout</a>
								<a href="#">Setting </a>
								</div>
							</div>

						<?php
					}else{
						?>
						<a href="login.php" class="btn btn-primary">Login</a>
						<a href="register.php" style="margin-left: 20px;" class="btn btn-primary">Register</a>
						<?php
					}
				?>
				
			</ul>
		</div>
	</nav>
<section id="dataBarang" style="padding-top: 80px;">
	<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
		  <ol class="carousel-indicators">
		    	<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
		    	<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
		    	<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
		  </ol>
		  <div class="carousel-inner">
		  	<?php
		  		$sqlCarousel = "SELECT * FROM tbbaner WHERE aktif='Y';";
		  		$queryCarousel = mysqli_query($conn, $sqlCarousel) or die("error: $sqlCarousel");
		  		$numCarousel = mysqli_num_rows($queryCarousel);

		  		for($jumlahCarousel = 1; $jumlahCarousel <= $numCarousel; $jumlahCarousel++) {
		  			$resultCarousel = mysqli_fetch_array($queryCarousel);
		  			$src = $resultCarousel["src"];
		  			
		  			if($jumlahCarousel == 1) {
		  				?>
					    <div class="carousel-item active">
					      	<img src="<?php echo $src; ?>" class="d-block w-100">
					    </div>
		  				<?php
		  			}else {
		  				?>
					    <div class="carousel-item">
					      	<img src="<?php echo $src; ?>" class="d-block w-100">
					    </div>
		  				<?php
		  			}
		  		}
		  	?>
		  </div>
		  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
		    	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    	<span class="visually-hidden">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="visually-hidden">Next</span>
		  </a>
	</div>

	<div class="LarisBarang" style="padding: 24px; margin-top: 60px; margin-bottom: 60px;">
		<div class="d-flex justify-content-between">
			<h4>Terlaris</h4>
			<a href="" class="h6 text-primary text-decoration-none"> Lihat semua</a>
		</div>
		<div class="LarisBarangData" style="display: flex; justify-content: space-between; flex-wrap: wrap;">
			<?php
				$sqlTerlaris = "SELECT * FROM tbjualdetil INNER JOIN tbbarang on tbjualdetil.kodebarang = tbbarang.kodebarang GROUP BY tbjualdetil.kodebarang ORDER BY tbjualdetil.jlh";
				$queryTerlaris = mysqli_query($conn, $sqlTerlaris) or die("error: $sqlTerlaris");
				$numTerlaris = mysqli_num_rows($queryTerlaris);

				for($jumlahTerlaris = 1; $jumlahTerlaris <= $numTerlaris; $jumlahTerlaris++) {
					$resultTerlaris = mysqli_fetch_array($queryTerlaris);
					$kodebarangTerlaris = $resultTerlaris["kodebarang"];
					$namaBarangTerlaris = $resultTerlaris["nama"];
					$imageBarangTerlaris = $resultTerlaris["image"];
					$hargajualBarangTerlaris = $resultTerlaris["hargajual"];
					$jlh_stokBarangTerlaris = $resultTerlaris["jlh_stok"];
					?>
					<a class="LarisBarangItem" role="button" onclick="ProdukDetail('<?php echo $kodebarangTerlaris; ?>')">
						<img src="<?php echo $imageBarangTerlaris; ?>">		
						<div style="padding: 12px;">
							<h6><?php echo $namaBarangTerlaris; ?></h6>
							<div class="hargaBlock">
								<h6 class="text-primary">Rp<?php echo number_format($hargajualBarangTerlaris, 0, ',', '.'); ?></h6>
								<span style="font-size: 12px;"><?php echo $jlh_stokBarangTerlaris; ?> Produk</span>
							</div>
						</div>
					</a>					
					<?php
				}
			?>
		</div>
	</div>

	<div class="LarisBarang" style="padding: 24px; margin-top: 60px; margin-bottom: 60px;">
		<div class="d-flex justify-content-between">
			<h4>Trending</h4>
			<a href="" class="h6 text-primary text-decoration-none">Lainnya</a>
		</div>
		<div class="barangTrendingData" style="display: flex; justify-content: space-between; flex-wrap: wrap;">
			<?php
				$sqlTrending = "SELECT * FROM tbbarang WHERE trending='Y';";
				$queryTrending = mysqli_query($conn, $sqlTrending) or die("error: $sqlTrending");
				$numTrending = mysqli_num_rows($queryTrending);

				for($jlhTrending = 1; $jlhTrending <= $numTrending; $jlhTrending++) {
					$resultTrending = mysqli_fetch_array($queryTrending);
					$kodebarangTrending = $resultTrending["kodebarang"];
					$namaBarangTrending = $resultTrending["nama"];
					$jlh_stokBarangTrending = $resultTrending["jlh_stok"];
					$imageBarangTrending = $resultTrending["image"];
					?>
					<a href="" class="barangTrendingItem" style="display: flex; justify-content: space-between; width: 24%;border-style: groove; margin: 12px 0; border-radius: 14px; padding: 12px; text-decoration: none;">
						<img style="width: 40%;" src="<?php echo $imageBarangTrending; ?>">
						<div style="width: 60%;">
							<h5 style="color : black; padding-right : 10px; margin-left: 10px"><?php echo $namaBarangTrending; ?></h5>
							<p style="margin-left: 10px;"><?php echo $jlh_stokBarangTrending; ?> Produk</p>
						</div>
					</a>
					<?php
				}
			?>
		</div>
	</div>

	<div class="LarisBarang" style="padding: 24px; margin-top: 60px; margin-bottom: 60px;">
		<div class="d-flex justify-content-between">
			<h4>Terakhir Dilihat</h4>

			<?php
				if(empty($_SESSION["kodeuser"])) {
					?>
			</div>
			<div class="LarisBarangData" style="display: flex; justify-content: space-between; flex-wrap: wrap;">
					<p>Perlu Login terlebih</p>
					<?php
				}else {
					?>
				<a href="" class="h6 text-primary text-decoration-none">Lihat semua</a>
			</div>
			<div class="LarisBarangData" style="display: flex; justify-content: space-between; flex-wrap: wrap;">
					<?php
					$kodeuser = $_SESSION["kodeuser"];
					$sqlHistory = "SELECT tbbarang.kodebarang, tbbarang.nama, tbbarang.hargajual, tbbarang.jenis, tbbarang.image FROM tbhistory INNER JOIN tbbarang ON tbhistory.kodebarang = tbbarang.kodebarang WHERE tbhistory.kodeuser='$kodeuser' GROUP BY tbhistory.kodebarang ORDER BY tbhistory.updated_at DESC;";
					$queryHistory = mysqli_query($conn, $sqlHistory) or die("error: $sqlHistory");
					$numHistory = mysqli_num_rows($queryHistory);

					for($jumlahHistory = 1; $jumlahHistory <= $numHistory; $jumlahHistory++) {
						$resultHistory = mysqli_fetch_array($queryHistory);
						$kodebarangHistory = $resultHistory["kodebarang"];
						$namaBarangHistory = $resultHistory["nama"];
						$hargajualBarangHistory = $resultHistory["hargajual"];
						$jenisBarangHistory = $resultHistory["jenis"];
						$imageBarangHistory = $resultHistory["image"];
						?>
						<a class="LarisBarangItem" role="button" onclick="ProdukDetail('<?php echo $kodebarangHistory; ?>')">
							<img src="<?php echo $imageBarangHistory; ?>">		
							<div style="padding: 12px;">
								<h6><?php echo $namaBarangHistory; ?></h6>
								<div class="hargaBlock">
									<h6 class="text-primary">Rp<?php echo number_format($hargajualBarangHistory, 0, ',', '.'); ?></h6>
									<span style="font-size: 12px;">Jenis: <?php echo $jenisBarangHistory; ?></span>
								</div>
							</div>
						</a>			
					<?php
					}
					?>

					<?php
				}
			?>
		</div>
	</div>

		<div class="LarisBarang" style="padding: 24px; margin-top: 60px; margin-bottom: 60px;">
		<div class="d-flex justify-content-between">
			<h4>Produk</h4>
			<a href="" class="h6 text-primary text-decoration-none"> Lihat semua</a>
		</div>
		<div class="LarisBarangData" style="display: flex; justify-content: space-between; flex-wrap: wrap;">
			<?php
				$sqlProduk = "SELECT *, tbbarang.kodebarang AS kodebarang FROM tbbarang LEFT JOIN tbjualdetil ON tbbarang.kodebarang = tbjualdetil.kodebarang;";
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
					<a class="LarisBarangItem" role="button" onclick="ProdukDetail('<?php echo $kodebarangProduk; ?>')" style="margin-bottom: 16px;">
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
</section>

	<footer >
		<h5> 2022@PT.Liaupedia</h5>
	</footer>

	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript">
		var dataBarang = document.getElementById("dataBarang");

		function searchBarang() {
			var kuncipencarian = document.getElementById("inputSearchBarang").value;
			var url = "crud2.php?cmd=searchBarang&kuncipencarian="+kuncipencarian;
			var xhttp;
			if(window.XMLHttpRequest) {
				xhttp = new XMLHttpRequest();
			}else {
				xhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xhttp.onreadystatechange = function() {
				if(this.readyState === 4 && this.status === 200) {
					dataBarang.innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", url, true);
			xhttp.send();
		}

		function ProdukDetail(kodebarang) {
			var url = "crud2.php?cmd=ProdukDetail&kodebarang="+kodebarang;
			var xhttp;
			if(window.XMLHttpRequest) {
				xhttp = new XMLHttpRequest();
			}else {
				xhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xhttp.onreadystatechange = function() {
				if(this.readyState === 4 && this.status === 200) {
					var data = this.responseText;
					dataBarang.innerHTML = data;
				}
			};
			xhttp.open("GET", url, true);
			xhttp.send();
		}

		function ProdukDalamKeranjang(kodebarang, hargafinal) {
			var jlh = document.getElementById("jlh");
			var total = document.getElementById("inputTotalDetailBarang").value;
			var url = "crud2.php?cmd=ProdukDalamKeranjang&kodebarang="+kodebarang+"&jlh="+jlh.value+"&harga="+hargafinal+"&total="+total;
			var xhttp;
			if(window.XMLHttpRequest) {
				xhttp = new XMLHttpRequest();
			}else {
				xhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xhttp.onreadystatechange = function() {
				if(this.readyState === 4 && this.status === 200) {
					document.getElementById("alertBerhasilMasukanBarangDalamKeranjang").style.display = "block";
					console.log(this.responseText);
				}
			};
			xhttp.open("GET", url, true);
			xhttp.send();
		}

		function kurangJumlahBarang(harga)
		{
			var jlh = document.getElementById("jlh");
			if(jlh.value == 1) {

			}else {
				jlh.value--;
				var total = parseInt(jlh.value) * parseInt(harga);
				document.getElementById("totalDetailBarang").innerHTML = "Total: Rp"+new Intl.NumberFormat().format(total);
				document.getElementById("inputTotalDetailBarang").value = total;
			}
		}

		function tambahJumlahBarang(harga) {
			var jlh = document.getElementById("jlh");
			jlh.value++;
			var total =parseInt(jlh.value) * parseInt(harga);
			document.getElementById("totalDetailBarang").innerHTML = "Total: Rp"+ new Intl.NumberFormat().format(total);
			document.getElementById("inputTotalDetailBarang").value = total;
		}
	</script>
</body>
</html>