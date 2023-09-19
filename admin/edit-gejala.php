<?php
session_start();
if(!isset($_SESSION["loginAdmin"]))
{
    header("location: admin.php");
    exit;
}
require '../koneksi.php';
$id = $_GET["id"];
$gejala = query("SELECT * FROM gejala WHERE id = $id")[0];
if(isset($_POST["edit"])){
//cek data berhasil diubah atau tidak
{
    editgejala($_POST);
    echo "<script>
    alert('Data Berhasil Diubah !');
    document.location.href = 'gejala.php';
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
    <title>Edit Gejala</title>
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
            <h1 id="judul">Edit Data gejala</h1>
            <input type="hidden" name="id" value ="<?= $gejala["id"];?>">
            <div class="gejala">
                <label for="gejala">Nama gejala : </label>
                <input type="text" name="gejala" id="gejala" required value ="<?= $gejala["gejala"];?>">
            </div>
            <button type="submit" name="edit" id="edit">Edit Data</button><br>
            <a href="gejala" id="kembali">Kembali</a><br>
        </form>
</body>
</html>