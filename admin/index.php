<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		Login Page
	</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css" integrity="sha512-XWTTruHZEYJsxV3W/lSXG1n3Q39YIWOstqvmFsdNEEQfHoZ6vm6E9GK2OrF6DSJSpIbRbi+Nn0WDPID9O7xB2Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style >
		@import url('https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins&display=swap');
		.wrapper {
		background-color: #eee;
		font-family: 'Poppins', sans-serif;
		background: linear-gradient(to top, #0d0c0d 5%, rgba(8, 181, 212, 0.4) 90%) no-repeat
		}
		.card{
			background-color: #cff8fc;
		}
		.h2{
			font-family: 'Kaushan Script';
			font-size: 3.5rem;
			font-weight: bold;
			color: #400485;
			font-style: italic
		}
		.link-website {
			text-decoration: none;
			color: black;
		}
	</style>
</head>
<?php
		session_start();
		if (isset($_SESSION['status']) && $_SESSION['status'] === "login"){
			header("location:/web_berita/admin/dashboard.php");
			die();
		}
		include '../connect.php';
		if(isset($_POST['username']) && $_POST['password']){
			$username = $_POST['username'];
			$password = $_POST['password'];

			$sql = "SELECT * FROM admins WHERE username='$username' and password='$password'";
			$data = $conn->query($sql);

			$check = mysqli_num_rows($data);

			if(isset($_POST['submit'])){
			 	if($check != 0){
			 		$_SESSION['username'] = $username;
			 		$_SESSION['status'] = "login";
			 		header("location:/web_berita/admin/dashboard.php");
			 		die();
			 	}else{
			 		$_SESSION['error'] = "Gagal login, Silahkan cek kembali username dan password Anda!";
			 	}
			}

		}
	?>
<body>
	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<div class="card my-5">
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="card-body cardbody-color p-lg-5">
							<div class="text-center">
								<img src="https://cdn-icons-png.flaticon.com/512/8364/8364546.png" 
								 width="200px" alt="profile">
								 <div class="h2">
								 	FA News&trade;
								 </div>
							</div>
							<div class="text-center mb-5 text dark">Enter Your Login Details</div>
							<div class="mb-3">
								<input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp"
								required placeholder="Username">
							</div>
							<div class="mb-3">
								<input type="password" class="form-control" name="password" id="password" required placeholder="Password">
							</div>
							<p style="color:red ; font-size: 12px;"><?php if(isset($_SESSION['error'])){ echo($_SESSION['error']);} ?></p>
							<div class="text-center">
								<button type="submit" name="submit" class="btn btn-dark px-5 mb-5 w-100">Login </button>
							</div>
							<div id="emailHelp"class="form-text text-center mb-4 text-dark">
								Not Registered? 
								<a class="link-website" href="#" class="text-dark fw-bold"> Craete an Account </a>
								<br>
								<a class="link-website" href="/web_berita/" class="text-dark fw-bold"> Back to Home </a>
							</div>
						</form>
					</div>
				</div>
			</div>	
		</div>	
	</div>
	<?php
        unset($_SESSION['error']);
    ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.min.js" integrity="sha512-8Y8eGK92dzouwpROIppwr+0kPauu0qqtnzZZNEF8Pat5tuRNJxJXCkbQfJ0HlUG3y1HB3z18CSKmUo7i2zcPpg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>