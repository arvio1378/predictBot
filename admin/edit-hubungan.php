<?php
session_start();
if(!isset($_SESSION["loginAdmin"]))
{
    header("location: admin.php");
    exit;
}
require '../koneksi.php';
$id = $_GET["id"];
$hubungan = query("SELECT * FROM hubungan WHERE id = $id")[0];
$kondisi = query("SELECT * FROM kondisi");
$gejala = query("SELECT * FROM gejala");
if(isset($_POST["edit"])){
//cek data berhasil diubah atau tidak
    if (edithubungan($_POST) > 0)
    {
        echo "<script>
        alert('Data Berhasil Diubah !');
        document.location.href = 'hubungan.php';
            </script>";
    } else {
        echo "<script>
        alert('Data Gagal Diubah !');
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
    <title>Edit Hubungan</title>
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
            <h1 id="judul">Edit Data Hubungan</h1>
            <input type="hidden" name="id" value ="<?= $hubungan["id"];?>">
            <div class="kondisi">
                <div>
                <label for="hubungan">Nama kondisi : </label>
                    <select name="kondisi" onchange="document.getElementById('kodep').value = this.value;">
                    <option value="">Pilih kondisi</option>
                        <?php foreach ($kondisi as $row) : ?>
                            <option value="<?= $row['kodep']; ?>"><?= $row['kondisi']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="kodep">Kode kondisi : </label>
                    <input type="text" id="kodep" name="kodep" value="" readonly>
                </div>
            </div>
            <div class="gejala">
                <div>
                <label for="hubungan">Nama Gejala : </label>
                    <select name="gejala" onchange="document.getElementById('kodeg').value = this.value;">
                    <option value="">Pilih Gejala</option>
                        <?php foreach ($gejala as $items) : ?>
                            <option value="<?= $items['kodeg']; ?>"><?= $items['gejala']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="kodeg">Kode Gejala : </label>
                    <input type="text" id="kodeg" name="kodeg" value="" readonly>
                </div>
            </div>
            <button type="submit" name="edit" id="edit">Edit Hubungan</button><br>
            <a href="hubungan" id="kembali">Kembali</a>
        </form>
</body>
</html>