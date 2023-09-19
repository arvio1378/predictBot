<?php
session_start();
if(!isset($_SESSION["loginUser"]))
{
    header("location: loginUser.php");
    exit;
}
require 'koneksi.php';
$nama = $_SESSION['username'];
$riwayat = query("SELECT * FROM riwayat WHERE nama = '$nama'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Riwayat</title>
    <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/responsive.css?<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/cb30ddf7c8.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
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
                <a href="index">Home</a>
                <a href="loginUser">PredictBot</a>
                <a href="about">About</a>
                <a href="contact">Contact</a>
            </nav>
        </div>
    </header>

    <h1 id="judul">Data Riwayat User</h1>
<table>
    <tr class="field">
        <th>No</th>
        <th>Nama</th>
        <th>Gejala</th>
        <th>Kondisi</th>
        <th>Deskripsi</th>
        <th>Rekomendasi</th>
        <th>Tanggal dan Jam</th>
        <th>Lihat</th>
    </tr>
    
    <?php $i = 1; ?>
    <?php foreach ($riwayat as $row) : ?>
    <tr class="isi">
        <td id="riwayat"><?= $i; ?></td>
        <td id="riwayat"><?= $row["nama"]; ?></td>
        <td id="riwayat"><?= substr($row["gejala"], 0, 50) . "..."; ?></td>
        <td id="riwayat"><?= substr($row["kondisi"], 0, 50) . "..."; ?></td>
        <td id="riwayat"><?= substr($row["deskripsi"], 0, 50) . "..."; ?></td>
        <td id="riwayat"><?= substr($row["rekomendasi"], 0, 50) . "..."; ?></td>
        <td id="riwayat"><?= substr($row["tanggal_jam"], 0, 50) . "..."; ?></td>
        <td id="riwayat"><a href="lihatRiwayatUser?id=<?= $row["id"]; ?>" id="lihat">Lihat</a></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
</table>
</body>
</html>