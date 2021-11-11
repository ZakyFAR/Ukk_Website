<?php
    session_start();

    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION['level']==""){
    header("location:index.php?pesan=gagal");
    }

    ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Toko Buku || Daftar Buku</title>
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

	<!-- new product -->
	<div class="section">
		<div class="container">
			<h3>Daftar Buku</h3>
			<div class="box">
			<?php echo "<h3>Selamat Datang " . $_SESSION['username'] . "</h3>"; ?>
            
		</div>
			<div class="box">
				<!-- php untuk pencarian -->
        <?php
            include "koneksi.php";
            if(isset($_GET['cari']))
            {
                $cari = $_GET['cari'];
                echo "<b> Hasil Pencarian : " .$cari."</b>";

            }
        ?>

        <?php
            $nama_buku = "";

            if(isset($_GET['cari']))
            {
                $nama = $_GET['cari'];
                $hasil = mysqli_query($koneksi, "SELECT * FROM buku WHERE judul LIKE '%".$nama."%'");
            }

            else{
                $hasil = mysqli_query($koneksi, "SELECT * FROM buku");
            }

            // mengambil data untuk ditampilkan
            WHILE($data = mysqli_fetch_array($hasil)){
            ?>
            
            <a href="detailbuku.php?id=<?php echo $data['id_buku'] ?>">
            <div class="col-4">
            <tr>
                <td><img src="img/<?php echo $data['gambar']; ?>" height="200"></td>
                <td><?php echo $data['judul']; ?></td>
            </tr>
            </div>

            <?php } ?>
            
            </div>
        </div>
    </div><br><br>        

	<!-- footer -->
	<div class="footer">
		<div class="container">
        <small>Copyright &copy; 2021 - Unity Bookshelf</small>
		</div>
	</div>
</body>
</html>