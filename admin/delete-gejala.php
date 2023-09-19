<?php

session_start();

if(!isset($_SESSION["loginAdmin"]))
{
    header("location: admin.php");
    exit;
}

require '../koneksi.php';

$id = $_GET["id"];

    deletegejala($id);
    echo "<script>
    alert('Data Berhasil Dihapus !');
    document.location.href = 'gejala.php';
        </script>";

?>