<?php
session_start();
if(!isset($_SESSION["loginAdmin"]))
{
    header("location: admin.php");
    exit;
}
require '../koneksi.php';
$kondisi = query("SELECT * FROM kondisi");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data kondisi</title>
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
                <a href="kondisi" class="active">Kondisi</a>
                <a href="gejala">Gejala</a>
                <a href="hubungan">Hubungan</a>
                <a href="riwayat">Riwayat</a>
                <a href="logoutAdmin" onclick="return confirm('Ingin keluar ?');">Logout</a>
            </nav>
        </div>
    </header>

    <h1 id="judul">Data Kondisi</h1>
    <p id="teks">Jangan lupa untuk memasukkan data kondisi dan gejala ke halaman hubungan !</p><br>
    <div>
        <a href="tambah-kondisi" id="add">Tambah Data</a>
    </div>

    <table border="2" cellpadding="0" cellspacing="0" width="100%">
        <tr class="field" align="center" bgcolor="#85CDFD" height="30px"><br>
            <th width="5%">No</th>
            <th width="10%">Kode</th>
            <th width="20%">Kondisi</th>
            <th>Deskripsi</th>
            <th>Rekomendasi</th>
            <th width="20%">Aksi</th>
        </tr>

        <?php
            usort($kondisi, function($a, $b) {
                return $a['kodep'] <=> $b['kodep'];
            });
        ?>
        
    <?php $i = 1; ?>
    <?php foreach ($kondisi as $row) : ?>
        <tr class="isi" height="40px">
            <td id="kondisi"><?= $i; ?></td>
            <td id="kondisi"><?= $row ["kodep"]; ?></td>
            <td id="kondisi"><?= $row ["kondisi"]; ?></td>
            <td id="kondisi"><?= $row ["deskripsi"]; ?></td>
            <td id="kondisi"><?= $row ["rekomendasi"]; ?></td>
            <td id="kondisi">
                <a href="edit-kondisi?id=<?= $row["id"]; ?>" id="edit">Edit</a> |
                <a href="delete-kondisi?id=<?= $row["id"]; ?>" id="delete" onclick="return confirm('Ingin Dihapus ?');">Delete</a>
            </td>
        </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    </table>
</body>
</html>