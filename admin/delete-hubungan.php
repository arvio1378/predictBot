<?php

session_start();

if(!isset($_SESSION["loginAdmin"]))
{
    header("location: admin.php");
    exit;
}

require '../koneksi.php';

$id = $_GET["id"];

if(deletehubungan($id) > 0)
{
    echo "<script>
    alert('Data Berhasil Dihapus !');
    document.location.href = 'hubungan.php';
        </script>";
} else {
    echo "<script>
    alert('Data Gagal Dihapus !');
    document.location.href = 'hubungan.php';
        </script>";
}

?>