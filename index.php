<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FA News</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
	@import url('https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins&display=swap');
	.h2{
	    font-family: 'Kaushan Script';
	    font-size: 3.5rem;
	    font-weight: bold;
	    color: #fff;
	    font-style: italic
	}
	.h2a{
	    font-family: 'Kaushan Script';
	    font-size: 2rem;
	    font-weight: bold;
	    color: black;
	    font-style: italic
	}
	.carousel-wrapper{
		height: 300px;
		background-color: #afe8ed;

	}
	body  {
		background: #dae5e6;
		font-family: 'Glory-Bold';
	}
	.navbar{
		background: #110482;
		font-style: normal;
		color: white;
	}
	.link-website {
        text-decoration: none;
        color: black;
    }
	.carousel-item {
    position: relative;
    display: none;
    transition: 0.6s ;
}
</style>
<body>
	<?php
		include 'connect.php';

		$sql = "SELECT * FROM posts 
				JOIN authors ON posts.author_id = authors.id 
				JOIN categories ON posts.category_id = categories.id
				JOIN positions ON posts.position_id = positions.id
				WHERE position='Sorotan'";
		$datas = $conn->query($sql);
		$sql1 = "SELECT * FROM posts 
				JOIN authors ON posts.author_id = authors.id 
				JOIN categories ON posts.category_id = categories.id
				JOIN positions ON posts.position_id = positions.id
				WHERE position='Headline'";
		$datas1 = $conn->query($sql1);
	?>
	<!-- Header -->
	<nav class="navbar navbar-dark bg-dark">
		<div class="container">
			<div class="col-3">
				<img src="https://img.icons8.com/office/512/partly-cloudy-rain.png" width="14" height="15">
				<?php 
					echo date('l, d / m / Y');
				?>
			</div>
		</div>
	</nav>

	<!-- Header Sticky -->
	<div class="sticky-top">
		<nav class="navbar navbar-expand-lg  navbar-dark  ">
		  <div class="container mb-2">
		  	<img src="https://cdn-icons-png.flaticon.com/512/8364/8364546.png" width="50" height="50" class="d-inline-block align-top" alt="">
		    <a class="navbar-brand" href="#">FA News&trade; </a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    	<span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    	<div class="col-2"></div>
				<div class="col-2">
					<ul class="navbar-nav ">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="/web_berita/">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " aria-current="page" href="/web_berita/categories.php">Categories</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="/web_berita/admin">Login</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Contact</a>
						</li>
					</ul>
				</div>
				<div class="col-6"></div>
				<div class="col-2">
					<ul class="navbar-nav ">
				      <form class="d-flex" role="search">
				        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
				      </form>
				    </ul>
				</div>
		    </div>
		  </div>
		</nav>
	</div>
	<!-- Headline -->
	<div class="container ">
		<div class="row">
			<div class="col-12">
				<div class="container ">
					<div class="h2a">
						Headline 
					</div>
					<div id="carouselExampleControls" class="carousel-slide" data-bs-ride="carousel">
						<div class="carousel-inner" >
							<?php
							foreach ($datas1 as $key => $data1) {
								$active = ($key == 0) ? 'active' : '';
								echo '<div class="carousel-item ' . $active . '">
														<img src="admin/posts/img/' .$data1['picture'] . '" width="1300px" height="500px" alt="…">
														<div class="carousel-caption">
														<a href="detail.php?id='.$data1['id_posts'].'" class="btn btn-block btn-dark  "><h3>' . $data1['title'] . '</h3></a>				
														</div>
													</div>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Sorotan -->
	<div class="container mt-4">
		<div class="h2a">
			Sorotan 
		</div>
		<hr class="border border-dark border-2 opacity-75">
	</div>
	<div class="container mt-4 mb-4">
		<div class="row row-cols-3 row-cols-md-4 g-4">
			<?php foreach ($datas as $data): ?>
				<div class="col">
					<div class="card">
					<img src="admin/posts/img/<?php echo $data['picture'] ?>" class="card-img-top" alt="...">
						<div class="card-body">
						<a class="link-website" href="detail.php?id=<?php echo$data['id_posts']?>"><h5> <?php echo $data['title']; ?></h5></a>
						<p class="card-text"><small class="text-muted"><?php echo $data['category']; ?>|   <?php echo $data['name']; ?> - <?php echo $data['date']; ?></small></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
	  	</div>
	</div>

	<!-- Footer-->
	<nav class="navbar navbar-expand-lg  navbar-dark bg-dark ">
		<div class="container ">
			<div class="text">
				<img src="https://cdn-icons-png.flaticon.com/512/8364/8364546.png" 
				 width="100px" alt="profile">
				 <div class="h2">
				 	FA News&trade;
				 </div>
				FA News&trade; selalu menyajikan semua kebutuhan informasi 
				<br>
				masa kini baik dari dalam maupun luar negeri
			</div>
		</div>
	</nav>
	<nav class="navbar navbar-expand-lg  navbar-dark bg-dark ">
		<div class="container ">
			<div class="text-center">
				<hr>
				&copy;2022 FA News. All Right Reserved
			</div>
			<div class="m-auto"></div>
			<div class="col-4">
				<ul class="navbar-nav ">
					<li class="nav-item">
						<a class="nav-link " href="#">TERMS OF USE</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">PRIVACY POLICE</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">CONTACT</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/fontawesome.min.js" integrity="sha512-nKvEIGRKw2OQCR34yLfnWnvrOBxidLG9aK+vzsBxCZ/9ZxgcS4FrYcN+auWUTkCitTVZAt82InDKJ7x+QtKu6g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>