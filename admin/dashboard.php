<?php
session_start();
if(!isset($_SESSION["loginAdmin"]))
{
    header("location: admin.php");
    exit;
}
require '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
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
                <a href="dashboard" class="active">Dashboard</a>
                <a href="kondisi">Kondisi</a>
                <a href="gejala">Gejala</a>
                <a href="hubungan">Hubungan</a>
                <a href="riwayat">Riwayat</a>
                <a href="logoutAdmin" onclick="return confirm('Ingin keluar ?');">Logout</a>
            </nav>
        </div>
    </header>

    <section class="body">
        <h1>Selamat Datang Admin</h1>
        <p>Tempat untuk mengatur data kondisi defisiensi vitamin dan gejala</p>
    </section>
</body>
</html>