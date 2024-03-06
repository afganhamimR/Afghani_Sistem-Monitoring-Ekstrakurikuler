<?php
session_start();
$kn = new mysqli("localhost","root","","db_sistem_informasi"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Login Page</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Open+Sans:wght@500&family=Quicksand:wght@500;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/indexlogin.css">
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="assets/img/logo.png" alt="logo.png">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							<form method="POST">
								<div class="form-group">
									<label>Username</label>
									<input type="username" class="form-control" placeholder="Username" name="username"required>
								</div>

								<div class="form-group mb-4">
									<label>Password</label>
									<input type="password" placeholder="Password" class="form-control" name="password" required>
								</div>

								<div class="form-group m-0 mb-2">
									<button name="login" class="btn btn-block">
										Login
									</button>
								</div>
							</form>
      	<?php
	     if (isset($_POST["login"]))
        {
            $username = $_POST['username'];
			$password = md5($_POST['password']); 

            $ambl = $kn->query("SELECT * FROM tb_user WHERE username='$username' AND password='$password'");

            $cek = mysqli_num_rows($ambl);

            if($cek > 0){
 
	$data = mysqli_fetch_assoc($ambl);
 
	if($data['role']=="siswa"){
 
		$_SESSION['username'] = $username;
		$_SESSION['role'] = "siswa";
		$_SESSION["user"] = $data;
		header("location:siswa/home.php");
 
	}else if($data['role']=="pelatih"){

		$_SESSION['username'] = $username;
		$_SESSION['role'] = "pelatih";
		$_SESSION["user"] = $data;
		header("location:pelatih/index.php");
 
	}else if($data['role']=="kesiswaan"){
	
		$_SESSION['username'] = $username;
		$_SESSION['role'] = "kesiswaan";
		$_SESSION["user"] = $data;
		header("location:kesiswaan/index.php");
 
	}else{
		 echo "<script>alert('Login Gagal, Username atau Password Salah');</script>";
         echo "<script>location='index.php';</script>";	
     }

    }else{
    	echo "<script>alert('Login Gagal, Username atau Password Salah');</script>";
        echo "<script>location='index.php';</script>";	
}
    }
        
        ?>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2024 &mdash; AFGHANI HAMIM ROFIQI 
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
</body>
</html>
