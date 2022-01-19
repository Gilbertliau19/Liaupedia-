<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
			background-image: url("img/bg4.jpg");
        	background-repeat: no-repeat;
        	height : 100%;
        	width : 100%;
		}
		.Login {
			width : 300px;

		}
		
      	.btn {
      		 background-color : #36d141;
      		 color : white;
      	}

	</style>
<body style="padding-left: 80px;">
	<a href="index.php" class="btn btn-outline-primary" style="margin: 24px 0;">Home</a>
<div class="text-center">
	<center>
	<img class="mb-3" src="img/Liaupedia.png" alt="" width="200" height="100">
	<div class="Login" >
			<div class="border">
			<div class="card-body">
				<h5 class="card-title" style="color : white;">Login</h5>
				<form action="crud1.php" method="POST">
					<input id="nama" name="nama" style="margin-top: 12px;" class="form-control" type="text" placeholder="Nama ">
					<input id="pass" name="pass" style="margin: 12px 0;" class="form-control" type="password" placeholder="Password">
					<button class="btn btn-primary" id="cmd" name="cmd" value="login">Login</button>
				</form>
			</div>
		</div>
	</div>
</center>
</div>
	<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>