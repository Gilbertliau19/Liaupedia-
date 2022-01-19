<?php
	session_start();
	require "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Keranjang</title>
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
		}
		.navbar{
			background-color: #6787c7;
			height : 80px;
		}
		.banner img {
			width: 100%;
			background-position: center;
			background-size: contain;
			height: 388px;
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
			margin : 0;
			margin-top : 220px;
			background-color: #6787c7; 
		}
		.table{
			
		}
	</style>
<body>
	<nav class="navbar navbar-expand-lg ">
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
								<a href="#"> Setting </a>
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

	<div id="dataBarang">
		<div class="container" style="padding: 40px 0 40px 0;">
			<div class="row">
				<div class="col-md-8">
					<table class="table table-hover" id="tableKeranjang">
					<?php
						$kodeuser = $_SESSION["kodeuser"];
						$sqlKeranjang = "SELECT *, (tempjualdetil.jlh * tbbarang.disc) AS totaldisc FROM tempjualdetil INNER JOIN tbbarang on tempjualdetil.kodebarang = tbbarang.kodebarang WHERE kodeuser='$kodeuser'";
						$queryKeranjang = mysqli_query($conn, $sqlKeranjang) or die("error: $sqlKeranjang");
						$numKeranjang = mysqli_num_rows($queryKeranjang);
						$subtotalBarangKeranjang = 0;
						$grandtotalBarangKeranjang = 0;
						$subtotalsementara = 0;
						$grandtotalsementara = 0;
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
							$subtotalsementara += $jlhBarangKeranjang * $hargajualBarangKeranjang;
							$grandtotalsementara += $totalBarangKeranjang;
							?>
							<tr>
								<td><input type="checkbox" checked></td>
								<td><?php echo $jumlahKeranjang; ?></td>
								<td>
									<img style="width: 5rem;" src="<?php echo $imageBarangKeranjang; ?>">
									
								</td>
								<td>
									<h5 style="margin-top: 6px;"><?php echo $namaBarangKeranjang; ?></h5>
									<i><?php echo $deskripsiBarangKeranjang; ?></i>
		                        	<form class="coba" style="margin-top: 10px;">
										<button type="button" style="cursor: pointer;text-align: center; border-radius: 20px;" class="btn btn-primary kurang" name="kurang"><i class="fa fa-minus-circle" style="width: 100%;"></i></button>
										<input type="text" class="inputjumlah" name="jumlah" data-id="<?php echo $notempBarangKeranjang; ?>" value="<?php echo $jlhBarangKeranjang; ?>" style="width: 10%; text-align: center;">
										<button type="button" style="cursor: pointer; text-align: center; border-radius :20px;" class="btn btn-primary tambah" name="tambah"><i class="fa fa-plus-circle" style="width: 100%;"></i></button>
										<input type="hidden" class="hargasebelumdisc" value="<?php echo $hargajualBarangKeranjang; ?>">
										<input type="hidden" class="hargasetelahdisc" value="<?php echo $hargaBarangKeranjang; ?>">
										
									</form>	
								</td>
								<td>
									<div style="border-left: 4px solid #29f276; height: 155px; position: relative;
  												margin-left: -20px;top: 0;">
									<br>
									<div style="padding-right : 20px;">
										<p style="text-indent: 10px;"> Harga : Rp<?php echo number_format($hargaBarangKeranjang, 0, ',', '.'); ?></p>
										<p style="text-indent: 10px;">Total : Rp<?php echo number_format($totalBarangKeranjang, 0, ',', '.'); ?></p>
										</div>
									</div>
								</td>
								<td><button type="button"
								onclick="hapusBarangKeranjang('<?php echo $notempBarangKeranjang; ?>')" class="btn btn-danger">Hapus</button></td>
							</tr>
							<?php
						}
					?>
					</table>
				</div>
				<div class="col-md-4" style="background-color : #1d518a; color :white;padding: 25px 20px;">
					<center><h4>Total</h4></center>
					<hr>
					<p id="finalsubtotal">Subtotal (Belum diskon): <b>Rp<?php echo number_format($subtotalBarangKeranjang, 0, ',', '.'); ?></b></p>
					<hr>
					<center><p id="finalgrandtotal">Grand Total  <br><b>Rp <?php echo number_format($grandtotalBarangKeranjang, 0, ',', '.'); ?></b></br></p></center>
					<button type="button" class="btn btn-primary" onclick="checkout()">Bayar Sekarang</button>
					<input type="hidden" id="subtotalsementara" value="<?php echo $subtotalsementara; ?>">
					<input type="hidden" id="grandtotalsementara" value="<?php echo $grandtotalsementara; ?>">
				</div>
			</div>
		</div>
	</div> 

	<footer  >
		<h5>2021@PT. Liaupedia</h5>
	</footer>

	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript">
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
		function uploadBuktiPembayaran(no) {
			document.getElementById("buktiPembayaran").click();
			aturUpload(no);
		}

	    document.getElementById("tableKeranjang").addEventListener("click", function(e) {
	    	if(e.target.getAttribute("type") == "checkbox") {
	    		var formcoba = e.target.parentElement.parentElement.querySelector(".coba");
	    		var forminputjumlah = formcoba.querySelector(".inputjumlah");
	    		var formhargasebelumdisc = formcoba.querySelector(".hargasebelumdisc");
	    		var formhargasetelahdisc = formcoba.querySelector(".hargasetelahdisc");
	    		var subtotalsementara = document.getElementById("subtotalsementara");
	    		var grandtotalsementara = document.getElementById("grandtotalsementara");
	    		var finalsubtotal = document.getElementById("finalsubtotal");
	    		var finalgrandtotal = document.getElementById("finalgrandtotal");
	    		var hargatotalsubtotalbarang = parseInt(forminputjumlah.value) * parseInt(formhargasebelumdisc.value);
	    		var hargatotalgrandtotalbarang = parseInt(forminputjumlah.value) * parseInt(formhargasetelahdisc.value);

	    		if(e.target.checked === true) {
	    			var nilaisubtotalsementara = parseInt(subtotalsementara.value) + parseInt(hargatotalsubtotalbarang);
		    		subtotalsementara.value = nilaisubtotalsementara;
		    		var nilaigrandtotalsementara = parseInt(grandtotalsementara.value) + parseInt(hargatotalgrandtotalbarang);
		    		grandtotalsementara.value = nilaigrandtotalsementara;   			
	    		}else {
		    		subtotalsementara.value -= parseInt(hargatotalsubtotalbarang);
		    		grandtotalsementara.value -= parseInt(hargatotalgrandtotalbarang);
	    		}
		    	finalsubtotal.innerHTML = "Subtotal (Belum diskon): <b>Rp "+new Intl.NumberFormat().format(subtotalsementara.value)+"</b>";
		    	finalgrandtotal.innerHTML = "Grand Total:<br><b>Rp "+new Intl.NumberFormat().format(grandtotalsementara.value)+"</b>";  	
	    	}
	    });


	    var coba = document.querySelectorAll(".coba");
	    for(var jumlahcoba = 0; jumlahcoba < coba.length; jumlahcoba++) {
	    	coba[jumlahcoba].addEventListener("click", function(e) {
	    		if(e.target.className == "inputjumlah") {
	    			var inputjumlah = e.target;
	    			var hargasetelahdisc = e.target.parentElement.parentElement.querySelector(".hargasetelahdisc");
	    			inputjumlah.addEventListener("input", function() {
	    				var total = parseInt(hargasetelahdisc.value) * parseInt(inputjumlah.value);
		    			var notemp_inputjumlah = inputjumlah.getAttribute("data-id");
		    			var jlh_inputjumlah = inputjumlah.value;
		    			var url = "crud2.php?cmd=ubahjumlahbarang&notemp="+notemp_inputjumlah+"&jlh="+jlh_inputjumlah+"&total="+total;
		    			var xhttp;
		    			if(window.XMLHttpRequest) {
		    				xhttp = new XMLHttpRequest();
		    			}else {
		    				xhttp = new ActiveXObject("Microsoft.XMLHTTP");
		    			}
		    			xhttp.onreadystatechange = function() {
		    				if(this.readyState === 4 && this.status === 200) {

		    				}
		    			};
		    			xhttp.open("GET", url, true);
		    			xhttp.send();
	    			});
	    		}else {		
		    		var inputjumlah = e.target.parentElement.parentElement.querySelector(".inputjumlah");
		    		var hargasebelumdisc = e.target.parentElement.parentElement.querySelector(".hargasebelumdisc");
		    		var hargasetelahdisc = e.target.parentElement.parentElement.querySelector(".hargasetelahdisc");
		    		var subtotalsementara = document.getElementById("subtotalsementara");
		    		var grandtotalsementara = document.getElementById("grandtotalsementara");
		    		
		    		if(e.target.parentElement.classList.contains("tambah") || e.target.classList.contains("tambah")) {
		    			var nilaitambahsubtotalsementara = parseInt(subtotalsementara.value) + parseInt(hargasebelumdisc.value);

		    			subtotalsementara.value = nilaitambahsubtotalsementara;
		    			var nilaitambahgrandtotalsementara = parseInt(grandtotalsementara.value) + parseInt(hargasetelahdisc.value);
		    			grandtotalsementara.value = nilaitambahgrandtotalsementara;
		    			inputjumlah.value++;

	    				var total = parseInt(hargasetelahdisc.value) * parseInt(inputjumlah.value);
		    			var notemp_inputjumlah = inputjumlah.getAttribute("data-id");
		    			var jlh_inputjumlah = inputjumlah.value;
		    			var url = "crud2.php?cmd=ubahjumlahbarang&notemp="+notemp_inputjumlah+"&jlh="+jlh_inputjumlah+"&total="+total;
		    			var xhttp;
		    			if(window.XMLHttpRequest) {
		    				xhttp = new XMLHttpRequest();
		    			}else {
		    				xhttp = new ActiveXObject("Microsoft.XMLHTTP");
		    			}
		    			xhttp.onreadystatechange = function() {
		    				if(this.readyState === 4 && this.status === 200) {

		    				}
		    			};
		    			xhttp.open("GET", url, true);
		    			xhttp.send();
		    		}else if(e.target.parentElement.classList.contains("kurang") || e.target.classList.contains("kurang")) {
		    			if(inputjumlah.value > 1) {
		    				subtotalsementara.value -= parseInt(hargasebelumdisc.value) * parseInt(inputjumlah.value);
		    				grandtotalsementara.value -= parseInt(hargasetelahdisc.value) * parseInt(inputjumlah.value);
		    				inputjumlah.value--;
		    				var nilaigrandtotalsementara = parseInt(grandtotalsementara.value) + (parseInt(inputjumlah.value) * parseInt(hargasetelahdisc.	value));
		    				grandtotalsementara.value = nilaigrandtotalsementara;
		    				var nilaisubtotalsementara = parseInt(subtotalsementara.value) + (parseInt(inputjumlah.value) * parseInt(hargasebelumdisc.value));
		    				subtotalsementara.value = nilaisubtotalsementara;

		    				var total = parseInt(hargasetelahdisc.value) * parseInt(inputjumlah.value);
			    			var notemp_inputjumlah = inputjumlah.getAttribute("data-id");
			    			var jlh_inputjumlah = inputjumlah.value;
			    			var url = "crud2.php?cmd=ubahjumlahbarang&notemp="+notemp_inputjumlah+"&jlh="+jlh_inputjumlah+"&total="+total;
			    			var xhttp;
			    			if(window.XMLHttpRequest) {
			    				xhttp = new XMLHttpRequest();
			    			}else {
			    				xhttp = new ActiveXObject("Microsoft.XMLHTTP");
			    			}
			    			xhttp.onreadystatechange = function() {
			    				if(this.readyState === 4 && this.status === 200) {

			    				}
			    			};
			    			xhttp.open("GET", url, true);
			    			xhttp.send();
		    			}
		    		}

		    		document.getElementById("finalgrandtotal").innerHTML = "Grand Total:<br><b>Rp "+new Intl.NumberFormat().format(grandtotalsementara.value)+"</b>";
		    		document.getElementById("finalsubtotal").innerHTML = "Subtotal (Belum diskon): <b>Rp "+new Intl.NumberFormat().format(subtotalsementara.value)+"</b>";
	    		}
	    	});
	    }

		function gantiAlamatBaru() {
			var nama = document.getElementById("nama").value;
			var telp = document.getElementById("telp").value;
			var alamat = document.getElementById("alamat").value;
			var url = "crud2.php?cmd=gantiAlamatBaru&nama="+nama+"&telp="+telp+"&alamat="+alamat;
			var xhttp;
			if(window.XMLHttpRequest) {
				xhttp = new XMLHttpRequest();
			} else {
				xhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xhttp.onreadystatechange = function() {
				if(this.readyState === 4 && this.status === 200) {
					alert("Alamat baru berhasil diterapkan.");
					document.getElementById("teksNama").innerHTML = "<b>"+nama+"</b>";
					document.getElementById("teksTelp").innerHTML = telp;
					document.getElementById("teksAlamat").innerHTML = "Alamat: "+alamat;
				}
			};
			xhttp.open("GET", url, true);
			xhttp.send();
		}

		function aturUpload(no) {
			document.getElementById("buktiPembayaran").onchange = function() {
				var url = "crud2.php?cmd=uploadBuktiPembayaran&no="+no;
				var xhttp;
				if(window.XMLHttpRequest) {
					xhttp = new XMLHttpRequest();
				} else {
					xhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xhttp.onreadystatechange = function() {
					if(this.readyState === 4 && this.status === 200) {
						console.log(this.responseText);
						alert("Terima kasih sudah berbelanja bersama kami.");
						location.reload();
					}
				};
				xhttp.open("GET", url, true);
				xhttp.send();		
			}
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

		function kurangJumlahBarang(harga) {
			var jlh = document.getElementById("jlh");
			if(jlh.value == 1) {

			}else {
				jlh.value--;
				var total = parseInt(jlh.value) * parseInt(harga);
				document.getElementById("totalDetailBarang").innerHTML = "Total: Rp"+total;
				document.getElementById("inputTotalDetailBarang").value = total;
			}
		}

		function tambahJumlahBarang(harga) {
			var jlh = document.getElementById("jlh");
			jlh.value++;
			var total = parseInt(jlh.value) * parseInt(harga);
			document.getElementById("totalDetailBarang").innerHTML = "Total: Rp"+total;
			document.getElementById("inputTotalDetailBarang").value = total;
		}

		function hapusBarangKeranjang(notemp) {
			var url = "crud2.php?cmd=hapusBarangKeranjang&notemp="+notemp;
			var xhttp;
			if(window.XMLHttpRequest) {
				xhttp = new XMLHttpRequest();
			}else {
				xhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xhttp.onreadystatechange = function() {
				if(this.readyState === 4 && this.status === 200) {
					
					location.reload();
				}
			};
			xhttp.open("GET", url, true);
			xhttp.send();
		}

		function checkout() {
			var url = "crud2.php?cmd=checkout";
			var xhttp;
			if(window.XMLHttpRequest) {
				xhttp = new XMLHttpRequest();
			} else {
				xhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xhttp.onreadystatechange = function() {
				if(this.readyState === 4 && this.status === 200) {
					var data = this.responseText;
					dataBarang.innerHTML = data;				}
			};
			xhttp.open("GET", url, true);
			xhttp.send();
		}

		function chooseMethodPayment() {
			var cod = document.getElementById("cod");
			var transfer = document.getElementById("transfer");
			var btnBayar = document.getElementById("btnBayar");

			btnBayar.innerHTML = "Lanjutkan";
			if(cod.checked == true) {
				document.getElementById("formTransfer").style.display = "none";
			} else if(transfer.checked == true) {
				document.getElementById("formTransfer").style.display = "block";
			} else if(cod.checked == false && transfer.checked == false) {
				btnBayar.innerHTML = "Pilih Metode Pembayaran";
			}
		}

		function BayarPesanan(no) {
			var cod = document.getElementById("cod");
			var transfer = document.getElementById("transfer");
			if(cod.checked == true || transfer.checked == true) {
				var disc = document.getElementById("discTotal").value;
				var subtotal = document.getElementById("subtotalTotal").value;
				var grandtotal = document.getElementById("grandtotalTotal").value;
				var no = document.getElementById("noBarangKeranjang").value;
				var metode = "";
				if(cod.checked == true) {
					metode = "cod";
				} else {
					metode = "transfer";
				}
				var url = "crud2.php?cmd=BayarPesanan&no="+no+"&metode="+metode+"&disc="+disc+"&subtotal="+subtotal+"&grandtotal="+grandtotal;
				var xhttp;
				if(window.XMLHttpRequest) {
					xhttp = new XMLHttpRequest();
				} else {
					xhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xhttp.onreadystatechange = function() {
					if(this.readyState === 4 && this.status === 200) {
						if(cod.checked == true) {
	
									alert("Pesanan COD berhasil dibayar.");
									location.reload();

						} else if(transfer.checked == true) {
							alert("Harap untuk membayar pesanan.");
							selesaikanPembayaran(no);
						}
					}
				};
				xhttp.open("GET", url, true);
				xhttp.send();				
			} else {
				alert("Tolong pilih metode pembayaran.");
			}
		}

		function selesaikanPembayaran(no) {
			var url = "crud2.php?cmd=selesaikanPembayaran&no="+no;
			var xhttp;
			if(window.XMLHttpRequest) {
				xhttp = new XMLHttpRequest();
			} else {
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
	</script>
</body>
</html>