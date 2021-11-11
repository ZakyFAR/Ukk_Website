
<?php
    session_start();

    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION['level']==""){
    header("location:index.php?pesan=gagal");
    }

    ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Databuku || Admin</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <script src="js/jquery-3.2.1.slim.min.js"></script>
</head>
<body>
    <header>
        <div class="container">
        <ul>
        <li><a href="halaman_admin.php">Daftar Buku</a></li>
        <li><a href="logout.php">Keluar</a></li>
        </ul>
        </div>
    </header>
        
        <!-- search -->
    <div class="search">
        <div class="container">
            <form action="halaman_admin.php" method="GET">
                <input type="text" name="cari" placeholder="Masukkan Nama Buku">
                <input type="submit" class="btn btn-success" value="Cari">
            </form>
        </div>
    </div>

        <!-- php alert untuk upload gambar -->

        <?php 
		if(isset($_GET['alert'])){
			if($_GET['alert']=='gagal_ekstensi'){
				?>
				<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-warning"></i> Peringatan !</h4>
					Ekstensi Tidak Diperbolehkan
				</div>								
				<?php
			}elseif($_GET['alert']=="gagal_ukuran"){
				?>
				<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-check"></i> Peringatan !</h4>
					Ukuran File terlalu Besar
				</div> 								
				<?php
			}elseif($_GET['alert']=="berhasil"){
				?>
								
				<?php
			}
		}
		?>

        <!-- tampilan tabel database -->
        <div class="section">
        <div class="container">
            <h3>Daftar Buku</h3>
        <div class="box">
            <a href="tambahbuku.php" class="btnn btn-primary">Tambah Buku</a><br>
            <table border="1" cellspacing="0" class="table">
                <br>
                <thead>
            <tr>
                    <th>Id Buku</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Gambar</th>
                    <th>Action</th>
            </tr>
        </thead>


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
    $id_buku=1;
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
    
    <tr>
        <td><?php echo $id_buku++; ?></td>
        <td><?php echo $data['judul']; ?></td>
        <td><?php echo $data['pengarang']; ?></td>
        <td><?php echo $data['penerbit']; ?></td>
        <td><img src="img/<?php echo $data['gambar']; ?>" height="200"></td>
        <td>
            <a href="edit_buku.php?id_buku=<?php echo $data['id_buku']?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="delete.php?id_buku=<?php echo $data['id_buku']?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus buku?')">Delete</a>
        </td>
    </tr>

    <?php } ?>
    </table>
    </div>
        </div>
    </div>
    </div>

    <footer>
        <div class="container">
        <small>Copyright &copy; 2021 - Unity Bookshelf</small>
        </div>
    </footer>        
</body>
</html>



    
