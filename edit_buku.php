<!-- mengambil data untuk diedit -->
<?php
    include "koneksi.php";
    $id = $_GET['id_buku'];
    $ambildata = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = '$id'");
    $data= mysqli_fetch_array($ambildata);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Buku</title>
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
            <h3>Edit Data Produk</h3>
            <!-- form untuk menginput -->
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">


                    <b><label for="judul">Judul Buku</label></b>
                    <input type="text" name="judul" class="input-control" placeholder="Judul Buku" value="<?php echo $data['judul'] ?>" required>

                    <b><label for="pengarang">Pengarang</label></b>
                    <input type="text" name="pengarang" class="input-control" placeholder="Pengarang Buku" value="<?php echo $data['pengarang'] ?>" required>

                    <b><label for="penerbit">Penerbit</label></b>
                    <input type="text" name="penerbit" class="input-control" placeholder="Penerbit Buku" value="<?php echo $data['penerbit'] ?>" required>

                    <b><label for="gambar">Gambar</label><br></b>
                    <img src="img/<?php echo $data['gambar']; ?>" height="200"><br>
                    <input type="file" name="gambar" class="form-control " value="<?php echo $data['gambar'] ?>"><br><br>

                    <input type="submit" name="simpan" value="Simpan" class="btn">
                    <a href="halaman_admin.php" class="btn">Cancel</a>
                </form><br>    
    
        <small>Copyright &copy; 2021 - Unity Bookshelf</small>
        
            </div>
        </div>
    </div>   

</body>
</html>

<?php

    include "koneksi.php";
    if(isset($_POST['simpan']))
    {
        $judul       = $_POST['judul'];
        $pengarang   = $_POST['pengarang'];
        $penerbit    = $_POST['penerbit'];

    //memasukkan gambar
    print_r($_POST);
    $rand     = rand();
    $ekstensi =  array('png','jpg','jpeg','gif');
    $filename = $_FILES['gambar']['name'];
    $ukuran   = $_FILES['gambar']['size'];
    $ext      = pathinfo($filename, PATHINFO_EXTENSION);
    $lama     = $_POST['foto_lama'];
    
    if($filename == ""){ //jika gambar tidak diubah
        mysqli_query($koneksi, "UPDATE buku SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit'
        WHERE id_buku= '$id'") or die(mysqli_error($koneksi));

            echo "<div align='center'><h5>Silahkan Tunggu, Data Sedang Disimpan...</h5></div>";
            echo "<meta http-equiv='refresh' content='1; url=http://localhost/ukk_web/halaman_admin.php'>";
        
    }else{
    if(!in_array($ext,$ekstensi) ) {
        header("location:halaman_admin.php?alert=gagal_ekstensi");
    }else{
        if($ukuran < 1044070){		
            unlink('img/'.$lama);
            $xx = $rand.'_'.$filename;
            move_uploaded_file($_FILES['gambar']['tmp_name'], 'img/'.$rand.'_'.$filename);
            
            mysqli_query($koneksi, "UPDATE buku SET
                judul='$judul', pengarang='$pengarang', penerbit='$penerbit', gambar='$xx'
                WHERE id_buku= '$id'") or die(mysqli_error($koneksi));

            echo "<div align='center'><h5>Silahkan Tunggu, Data Sedang Disimpan...</h5></div>";
            header("location:halaman_admin.php?alert=berhasil");

        }else{
            header("location:halaman_admin.php?alert=gagal_ukuran");
            echo "<div align='center'><h5>Silahkan Tunggu, Data Sedang Disimpan...</h5></div>";
        }
    }
    }
}
?>