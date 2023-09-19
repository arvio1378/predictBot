<?php
session_start();
if(!isset($_SESSION["loginAdmin"]))
{
    header("location: admin.php");
    exit;
}
require '../koneksi.php';
$id = $_GET["id"];
$riwayat = query("SELECT * FROM riwayat WHERE id = $id")[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../css/responsive.css?<?php echo time(); ?>">
    <title>Lihat Riwayat</title>
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

    <header>
        <div class="container">
            <i class="fa-solid fa-bars"></i>
            <h1><i>PredictBot</i></h1>
            <nav class="menu">
                <a href="dashboard">Dashboard</a>
                <a href="kondisi">Kondisi</a>
                <a href="gejala">Gejala</a>
                <a href="hubungan">Hubungan</a>
                <a href="riwayat" class="active">Riwayat</a>
                <a href="logoutAdmin" onclick="return confirm('Ingin keluar ?');">Logout</a>
            </nav>
        </div>
    </header>
    
    <div class="container">
        <h1 id="judul">Detail Riwayat</h1>
        <a href="riwayat" id="kembali">Kembali</a><br><br>
        <input type="hidden" name="id" value ="<?= $riwayat["id"]?>">
        <h2>Nama : <?= $riwayat["nama"]?></h2><br>
        <h2>Tanggal dan Jam :</h2>
        <h4 id="info"><?= $riwayat["tanggal_jam"]?></h4><br>
        <h2>Gejala :</h2>
        <h4 id="info"><?= $riwayat["gejala"]?></h4><br>
        <h2>Kondisi :</h2>
        <h4 id="info"><?=$riwayat["kondisi"]?></h4><br>
        <h3>Deskripsi :</h3>
        <h4 id="info"><?=$riwayat["deskripsi"]?></h4><br>
        <h3>Rekomendasi :</h3>
        <h4 id="info"><?=$riwayat["rekomendasi"]?></h4><br>
    </div>

</body>
</html>