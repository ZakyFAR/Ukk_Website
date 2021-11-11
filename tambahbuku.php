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
    <title>Tambah Buku</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
</head>
<body>
<header>
    <div class="container">
        <h1>Toko Buku Cemerlang</h1>
        <ul>

            <li><a href="halaman_admin.php">Daftar Buku</a></li>
            <li><a href="logout.php">Keluar</a></li>
        </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>Tambah Data Produk</h3>
            <!-- form untuk menginput -->
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">


                    <b><label for="judul">Judul Buku</label></b>
                    <input type="text" name="judul" class="input-control" placeholder="Judul Buku" required>

                    <b><label for="pengarang">Pengarang</label></b>
                    <input type="text" name="pengarang" class="input-control" placeholder="Pengarang Buku" required>

                    <b><label for="penerbit">Penerbit</label></b>
                    <input type="text" name="penerbit" class="input-control" placeholder="Penerbit Buku" required>

                        <b><label for="gambar">Gambar</label><br></b>
                    <input type="file" name="gambar" class="input-control" required>

                    <input type="submit" name="simpan" value="Simpan" class="btn">
                    <a href="halaman_admin.php" class="btn">Cancel</a>
                </form><br><br>

                <small>Copyright &copy; 2021 - Unity Bookshelf</small>
            </div>
        </div>
    </div>   



</body>
</html>

<!-- php untuk memasukkan data ke tb_buku -->
<?php

    include "koneksi.php";
    if(isset($_POST['simpan']))
    {
        $judul       = $_POST['judul'];
        $pengarang   = $_POST['pengarang'];
        $penerbit    = $_POST['penerbit'];

        
    //memasukkan gambar
    print_r($_POST);
    $rand = rand();
    $ekstensi =  array('png','jpg','jpeg','gif');
    $filename = $_FILES['gambar']['name'];
    $ukuran = $_FILES['gambar']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if(!in_array($ext,$ekstensi) ) { //jika ekstensi gambar berbeda
        header("location:halaman_admin.php?alert=gagal_ekstensi");
    }else{
        if($ukuran < 1044070){ //jika size foto sesuai
            $xx = $rand.'_'.$filename;
            move_uploaded_file($_FILES['gambar']['tmp_name'], 'img/'.$rand.'_'.$filename);
            mysqli_query($koneksi, "INSERT INTO buku VALUES(
                '0', '$judul', '$pengarang', '$penerbit', '$xx'
            )") or die(mysqli_error($koneksi));
            
            header("location:halaman_admin.php?alert=berhasil");

        }else{
            header("location:halaman_admin.php?alert=gagal_ukuran");
        }
    }
    }
?>