<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		Posts
	</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.4/chartist.min.css" integrity="sha512-V0+DPzYyLzIiMiWCg3nNdY+NyIiK9bED/T1xNBj08CaIUyK3sXRpB26OUCIzujMevxY9TRJFHQIxTwgzb0jVLg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins&display=swap');
		.h2{
		    font-family: 'Kaushan Script';
		    font-size: 1.7rem;
		    font-weight: bold;
		    color: #fff;
		    font-style: italic
		}
		.nav-link{
			color: black;    
		}
        .nav-link:hover{
        background-color:#525252 !important;
        }
        .white{
            color: white;
        }
        .active{
			color: grey;
		}
        .link-website {
			text-decoration: none;
			color: black;
		}
        .link-website2 {
			text-decoration: none;
			color: grey;
		}
		.nav-link .fa{
		    transition:all 1s;
		}

		.nav-link:hover .fa{
		    transform:rotate(360deg);
		}
	</style>

</head>
<body>
	<?php
		session_start();
		if(isset($_SESSION['status']) != "login"){
			header("location:/web_berita/");
		}
		if(isset($_POST['submit'])){
			session_destroy();
			header("location:/web_berita/admin/");
		}
		include '../../connect.php';

		$sql = "SELECT * FROM posts 
				JOIN authors ON posts.author_id = authors.id 
				JOIN categories ON posts.category_id = categories.id
				JOIN positions ON posts.position_id = positions.id";
		$datas = $conn->query($sql);
	?>
	<!-- Navbar -->
	<nav class="navbar navbar-inverse navbar-fixed-top navbar-dark bg-dark p-3 ">
		<div class="d-flex col-12 col-md-3 col-lg-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
			<a class="navbar-brand" href="#">	
				<img src="https://cdn-icons-png.flaticon.com/512/8364/8364546.png" width="50" height="40">
				<span class="h2">
					FA News
				</span>
			</a>
			<button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
		<div class="col-12 col-md-4 col-lg-2">
			<input class="form-control form-control-dark" type="text" placeholder="Search" aria-label="Search">			
		</div>
		<div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
			<div class="dropdown">
				 <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Welcome back, <?php echo($_SESSION['username']) ?>
				</a>
				<ul class="dropdown-menu">
						<form id="logout_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<button class="dropdown-item" type="submit" name="submit"> Logout </button>
						</form>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="row">
            <!-- Sidebar -->
			<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
            	<hr class="white">		
				<div class="position-sticky"> 
                	<ul class="nav nav-pills flex-column mb-auto"> 
                		<li> 
                			<a href="/web_berita/admin/" class="nav-link text-white"> 
                				<i class="fa fa-dashboard"></i><span class="ms-2">Dashboard</span> 
                			</a> 
                		</li> 
                		<li> 
                			<a href="/web_berita/admin/authors" class="nav-link text-white"> 
                				<i class="fa-solid fa-user"></i></i><span class="ms-2"> Authors </span> 
                			</a> 
                		</li> 
                		<li> 
                			<a href="/web_berita/admin/categories" class="nav-link text-white"> 
                				<i class="fa-solid fa-list"></i></i><span class="ms-2"> Categories </span> 
                			</a> 
                		</li>
                		<li> 
                			<a href="/web_berita/admin/positions" class="nav-link text-white"> 
								<i class="fa-sharp fa-solid fa-grip"></i><span class="ms-2"> Positions </span> 
                			</a> 
                		</li> 
                		<li> 
                			<a href="/web_berita/admin/posts" class="nav-link active"> 
                				<i class="fa-solid fa-newspaper"></i><span class="ms-2"> Posts </span> 
                			</a> 
                		</li> 
                	</ul>
				</div>
			</nav>
			<!-- link -->
			<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 " >
				<nav aria-label="breadcrumb">
					<ul class="breadcrumb">
						<li class="breadcrumb-item active">
							<a class="link-website" href="#">Posts</a>
						</li>
						<li class="breadcrumb-item ">
							<a class="link-website2"  href="#">Daftar Posts</a>
						</li>
					</ul>
				</nav>
				<h1>Daftar Posts</h1>
				<!-- Card-->
				<div class="card">
					<div class="card-body">
						<a href="create.php" class="btn btn-block btn-dark mb-4 ">Tambah Posts</a>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th class="table-dark" scope="col">#</th>
										<th class="table-dark" scope="col">Authors</th>
										<th class="table-dark" scope="col">Category</th>
										<th class="table-dark" scope="col">Title</th>
										<th class="table-dark" scope="col">Content</th>
										<th class="table-dark" scope="col">Date</th>
										<th class="table-dark" scope="col">Picture</th>
										<th class="table-dark" scope="col">Position</th>
										<th class="table-dark" scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach ($datas as $key => $data){
											echo '
												<tr>
													<td>'.($key+1).'</td>
													<td width="100px">'.$data['name'].'</td>
													<td>'.$data['category'].'</td>
													<td width="150px">'.$data['title'].'</td>
													<td width="200px">'.substr($data['content'],0,100).'</td>
													<td>'.$data['date'].'</td>
													<td width="200px" ><img src="img/'.$data['picture'].'" width="150" height="100"></td>
													<td>'.$data['position'].'</td>
													<td>
														<a href="show.php?id='.$data['id_posts'].'" class="btn btn-block btn-dark  ">Lihat</a>
														<a href="edit.php?id='.$data['id_posts'].'" class="btn btn-block btn-dark  ">Edit</a>
														<a onclick="return confirm(`Apakah Anda Yakin?`)" href="delete.php?id='.$data['id_posts'].'" class="btn btn-block btn-dark  ">Hapus</a>
														<br><br>
														<a href="../../print.php?id='.$data['id_posts'].'" class="btn btn-block btn-dark  ">Cetak</a>
													</td>
												</tr>
											';
										}
									?>
									
								</tbody>
								
							</table>
							
						</div>
					</div>
					
				</div>
			</main>	
			</main>	
		</div>
	</div>
	<!-- Footer-->
	<nav class="navbar navbar-dark bg-dark p-3 white">
		<div class="d-flex col-12 col-md-3 col-lg-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
		</div>
		<div class="col-12 col-md-4 col-lg-2">
			Copyright&copy;2022 FA News
		</div>
		<div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">	
				 <a class="link-website2" href="#">
					Contact us
				</a>	
			</div>
	</nav>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.4/chartist.min.js" integrity="sha512-9rxMbTkN9JcgG5euudGbdIbhFZ7KGyAuVomdQDI9qXfPply9BJh0iqA7E/moLCatH2JD4xBGHwV6ezBkCpnjRQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>