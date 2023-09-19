<?php
session_start();
if(!isset($_SESSION["loginAdmin"]))
{
    header("location: admin.php");
    exit;
}
require '../koneksi.php';
$riwayat = query("SELECT * FROM riwayat");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Riwayat</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../css/responsive.css?<?php echo time(); ?>">
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
                <a href="dashboard">Dashboard</a>
                <a href="kondisi">Kondisi</a>
                <a href="gejala">Gejala</a>
                <a href="hubungan">Hubungan</a>
                <a href="riwayat" class="active">Riwayat</a>
                <a href="logoutAdmin" onclick="return confirm('Ingin keluar ?');">Logout</a>
            </nav>
        </div>
    </header>

    <h1 id="judul">Data Riwayat</h1>
    <table border="2" cellpadding="0" cellspacing="0" width="100%">
        <tr class="field" align="center" bgcolor="#85CDFD" height="30px"><br>
            <th width="5%">No.</th>
            <th width="10%">Nama</th>
            <th width="25%">Gejala</th>
            <th width="25%">Kondisi</th>
            <th width="25%">Deskripsi</th>
            <th width="25%">Rekomendasi</th>
            <th width="25%">Tanggal dan Jam</th>
            <th width="10%">Lihat</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($riwayat as $row) : ?>
        <tr class="isi" height="40px">
            <td id="riwayat"><?= $i; ?></td>
            <td id="riwayat"><?= $row["nama"]; ?></td>
            <td id="riwayat"><?= substr($row["gejala"], 0, 50) . "..."; ?></td> 
            <td id="riwayat"><?= substr($row["kondisi"], 0, 50) . "..."; ?></td> 
            <td id="riwayat"><?= substr($row["deskripsi"], 0, 50) . "..."; ?></td>
            <td id="riwayat"><?= substr($row["rekomendasi"], 0, 50) . "..."; ?></td>
            <td id="riwayat"><?= substr($row["tanggal_jam"], 0, 50) . "..."; ?></td>
            <td id="riwayat"><a href="lihatRiwayat?id=<?= $row["id"]; ?>" id="lihat">Lihat</a></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>