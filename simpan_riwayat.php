<?php
require 'koneksi.php';

if (isset($_POST['nama']) && isset($_POST['gejala']) && isset($_POST['kondisi']) && isset($_POST['deskripsi']) && isset($_POST['rekomendasi'])) {
    $nama = $_POST['nama'];
    $gejala = $_POST['gejala'];
    $kondisi = $_POST['kondisi'];
    $deskripsi = $_POST['deskripsi'];
    $rekomendasi = $_POST['rekomendasi'];

    // Mendapatkan tanggal dan jam saat ini
    $tanggalJam = date("Y-m-d H:i:s");

    // Query SQL untuk menyimpan data ke dalam tabel riwayat
    $query = "INSERT INTO riwayat (nama, gejala, kondisi, deskripsi, rekomendasi, tanggal_jam) VALUES ('$nama', '$gejala', '$kondisi', '$deskripsi', '$rekomendasi', '$tanggalJam')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Data berhasil disimpan.";
    } else {
        echo "Terjadi kesalahan saat menyimpan data: " . mysqli_error($conn);
    }
} else {
    echo "Data tidak lengkap.";
}
?>
