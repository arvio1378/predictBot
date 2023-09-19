<?php
session_start();
if(!isset($_SESSION["loginAdmin"]))
{
    header("location: admin.php");
    exit;
}
require '../koneksi.php';
$gejala = query("SELECT * FROM gejala");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Gejala</title>
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
                <a href="gejala" class="active">Gejala</a>
                <a href="hubungan">Hubungan</a>
                <a href="riwayat">Riwayat</a>
                <a href="logoutAdmin" onclick="return confirm('Ingin keluar ?');">Logout</a>
            </nav>
        </div>
    </header>

    <h1 id="judul">Data Gejala</h1>
    <p id="teks">Jangan lupa untuk memasukkan data kondisi dan gejala ke halaman hubungan !</p><br>
    <div>
        <a href="tambah-gejala" id="add">Tambah Data</a>
    </div>

    <table border="2" cellpadding="0" cellspacing="0" width="100%">
        <tr class="field" align="center" bgcolor="#00E7FF" height="30px"><br>
            <th width="10%">No</th>
            <th width="20%">Kode</th>
            <th>Gejala</th>
            <th width="20%">Aksi</th>
        </tr>
        <?php
        usort($gejala, function($a, $b) {
            return $a['kodeg'] <=> $b['kodeg'];
        });
        ?>
        
        <?php $i = 1; ?>
        <?php foreach ($gejala as $row) : ?>
        <tr class="isi" height="40px">
            <td id="gejala"><?= $i; ?></td>
            <td id="gejala"><?= $row ["kodeg"]; ?></td>
            <td id="gejala"><?= $row ["gejala"]; ?></td>
            <td id="gejala"><a href="edit-gejala?id=<?= $row["id"]; ?>" id="edit">Edit</a> |
                <a href="delete-gejala?id=<?= $row["id"]; ?>" id="delete" onclick="return confirm('Ingin Dihapus ?');">Delete</a></td>
        </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    </table>
</body>
</html>