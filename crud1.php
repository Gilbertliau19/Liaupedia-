<?php

session_start();
include "koneksi.php";

$cmd = $_POST["cmd"];

if($cmd == "login") {
	$nama = $_POST["nama"];
	$pass = md5($_POST["pass"]);

	$sql = "SELECT * FROM tbuser WHERE nama='$nama' AND pass='$pass'";
	$query = mysqli_query($conn, $sql) or die("error: $sql");
	$num = mysqli_num_rows($query);

	if($num == 1){
		$result = mysqli_fetch_array($query);
		$_SESSION["nama"] = $result["nama"];
		$_SESSION["kodeuser"] = $result["kodeuser"];

		?>
			<script>
				location.href = "index.php";
			</script>
		<?php
	}else{
		?>
			<script type="text/javascript">
				alert("Akun anda belum terdaftar.");
				location.href = "login.php";
			</script>
		<?php
	}
}else if($cmd == "register"){
	$kodeuser = $_POST["kodeuser"];
	$nama = $_POST["nama"];
	$pass = md5($_POST["pass"]);
	$status = $_POST["stringStatus"];
	$alamat = $_POST["alamat"];
	$telp = $_POST["telp"];

	$sql = "INSERT INTO tbuser(kodeuser, nama, pass, status, alamat, telp) VALUES('$kodeuser', '$nama', '$pass', '$status', '$alamat', '$telp')";
	$query = mysqli_query($conn, $sql) or die("error: $sql");

	$_SESSION["nama"] = $nama;
	$_SESSION["kodeuser"] = $kodeuser;

	if($query){
		?>
			<script>
				alert("Terima kasih");
				location.href = "index.php";
			</script>
		<?php		
	}
}
?>