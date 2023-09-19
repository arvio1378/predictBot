<?php
session_start();
if(!isset($_SESSION["loginAdmin"]))
{
    header("location: admin.php");
    exit;
}
require '../koneksi.php';
if(isset($_POST["submit"])){
//cek data berhasil ditambah atau tidak
{
    tambahkondisi($_POST);
    echo "<script>
    alert('Data Berhasil Ditambah !');
    document.location.href = 'kondisi.php';
        </script>";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah kondisi</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../css/responsive.css?<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/cb30ddf7c8.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.fa-bars').click(function(){
                $('.menu').toggleClass('active')
            })
        })
    </script>
</head>

<body>
    <div class="container">
    <form action="" method="post" class="masuk">
        <h1 id="judul">Tambah Kondisi</h1>
        <div class="kondisi">
            <label for="kondisi">Nama kondisi : </label>
            <input type="text" name="kondisi" id="kondisi" required>
        </div>
        <div class="deskripsi">
            <label for="deskripsi">Deskripsi : </label>
            <textarea name="deskripsi" id="deskripsi" cols="40" rows="5" required></textarea>
        </div>
        <div class="rekomendasi">
            <label for="rekomendasi">Rekomendasi : </label>
            <textarea name="rekomendasi" id="rekomendasi" cols="40" rows="5" required></textarea>
        </div>
        <button type="submit" name="submit" id="submit">Tambah Data</button><br>
        <a href="kondisi" id="kembali">Kembali</a>
    </form>
    </div>
</body>
</html>