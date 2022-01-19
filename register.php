<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
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
			background-image: url("img/bg1.jpg");
        	background-repeat: no-repeat;
		}

	</style>
<body style="padding-left: 80px;">
	<a href="index.php" class="btn btn-outline-primary" style="margin: 24px 0;">Home</a>
<center>
	<div class="Login" style="width: 412px;">
		
			<div class="card-body">
				<h5 class="card-title" style="color : aqua ;background-color: white; border-radius : 15px ; width : 50%;">Register </h5>
				<form action="crud1.php" method="POST">
					<input id="kodeuser" name="kodeuser" style="margin-top: 12px;" class="form-control" type="text" placeholder="Username">
					<input id="nama" name="nama" style="margin-top: 12px;" class="form-control" type="text" placeholder="Nama ">
					<input id="pass" name="pass" style="margin: 12px 0;" class="form-control" type="password" placeholder="Password">
					<input id="stringStatus" name="stringStatus" style="margin: 12px 0;" class="form-control" type="text" placeholder="Status">
					<input id="alamat" name="alamat" style="margin: 12px 0;" class="form-control" type="text" placeholder="Alamat">
					<input id="telp" name="telp" style="margin-bottom: 12px" class="form-control" type="text" placeholder="Telepon">
					<button class="btn btn-primary" id="cmd" name="cmd" value="register">Register</button>
				</form>
			</div>
		
	</div>
</center>
	<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>