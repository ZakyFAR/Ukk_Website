<?php 
	error_reporting(0);
	include 'koneksi.php';

	$buku = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = '".$_GET['id']."' ");
	$b = mysqli_fetch_object($buku);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Toko Buku || Detail Buku</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
	<!-- header -->

	<header>
	<div class="container">
			
			<ul>
				<li><a href="halaman_user.php">Daftar Buku</a></li>
				<li><a href="logout.php">Keluar</a></li>
			</ul>
		</div>
	</header>

	<!-- search -->
	<div class="search">
		<div class="container">
			<form action="halaman_user.php" method="GET">
				<input type="text" name="cari" placeholder="Masukkan Nama Buku">
				<input type="submit" class="btn btn-success" value="Cari">
			</form>
		</div>
	</div>

	<!-- product detail -->
	<div class="section">
		<div class="container">
			<h3>Deskripsi Produk</h3>
			<div class="box">
				<div class="col-2">
					<img src="img/<?php echo $b->gambar ?>" width="80%">
				</div>
				<div class="col-2">
					<h3><?php echo $b->judul ?></h3>
					<p>Pengarang :<br>
						<?php echo $b->pengarang ?>
					</p>
					<p>Penerbit :<br>
						<?php echo $b->penerbit ?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<!-- footer -->
	<div class="footer">
		<div class="container">
			<small>Copyright &copy; 2021 - Unity Bookshelf.</small>
		</div>
	</div>
</body>
</html>