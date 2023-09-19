<?php
session_start();
if(!isset($_SESSION["loginAdmin"]))
{
    header("location: admin.php");
    exit;
}
require '../koneksi.php';
$kondisi = query("SELECT * FROM kondisi");
$gejala = query("SELECT * FROM gejala");
if(isset($_POST["submit"])){
//cek data berhasil ditambah atau tidak
if (tambahhubungan($_POST) > 0)
{
    echo "<script>
    alert('Data Berhasil Ditambah !');
    document.location.href = 'hubungan.php';
        </script>";
} else {
    echo "<script>
    alert('Data Gagal Ditambah !');
    document.location.href = 'hubungan.php';
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
    <title>Tambah Hubungan</title>
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
        <form action="" method="post" class="masuk">
            <h1 id="judul">Tambah Hubungan</h1>
            <div class="hubungan kondisi">
                <label for="hubungan">Nama kondisi : </label>
                <select name="kondisi" onchange="document.getElementById('kodep').value = this.value;">
                    <option value="">Pilih kondisi</option>
                    <?php foreach ($kondisi as $items) : ?>
                        <option value="<?= $items['kodep']; ?>"><?= $items['kondisi']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="kodep">Kode kondisi : </label>
                <input type="text" id="kodep" name="kodep" readonly>
            </div>
            <div class="hubungan gejala">
                <label for="hubungan">Nama gejala : </label>
                <select name="gejala" onchange="document.getElementById('kodeg').value = this.value;">
                    <option value="">Pilih gejala</option>
                    <?php foreach ($gejala as $row) : ?>
                        <option value="<?= $row['kodeg']; ?>"><?= $row['gejala']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="kodeg">Kode gejala : </label>
                <input type="text" id="kodeg" name="kodeg" readonly>
            </div>
            <button type="submit" name="submit" id="submit">Tambah Data</button><br>
            <a href="hubungan" id="kembali">Kembali</a>
        </form>
</body>
</html>