<?php
$conn = mysqli_connect("localhost", "root", "", "predictbot") or die("database error");

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}

function registrasiAdmin($data)
{
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM admin WHERE username = '$username'");
    if(mysqli_fetch_assoc($result))
    {
        echo "<script>
            alert ('username sudah terdaftar !');
        </script>";
        return false;
    }
    //cek password dengan konfirmasi password
    if ($password !== $password2)
    {
        echo "<script>
        alert('Konfirmasi password tidak sesuai');
        </script>";
        return false;
    }
    //membuat password menjadi acak
    $password = password_hash($password, PASSWORD_DEFAULT);
    //memberikan kepada database
    mysqli_query($conn, "INSERT INTO admin VALUES('', '$username', '$password')");
    return mysqli_affected_rows($conn);
}

function registrasiUser($data)
{
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($result))
    {
        echo "<script>
            alert ('username sudah terdaftar !');
        </script>";
        return false;
    }
    //cek password dengan konfirmasi password
    if ($password !== $password2)
    {
        echo "<script>
        alert('Konfirmasi password tidak sesuai');
        </script>";
        return false;
    }
    //membuat password menjadi acak
    $password = password_hash($password, PASSWORD_DEFAULT);
    //memberikan kepada database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");
    return mysqli_affected_rows($conn);
}

function tambahkondisi($data)
{
    global $conn;
    // Mendapatkan kodep terakhir dari tabel kondisi
    $result = mysqli_query($conn, "SELECT kodep FROM kondisi ORDER BY kodep DESC LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    $last_kodep = $row['kodep'];

    // Mengambil nomor urut dari kodep terakhir
    $last_number = intval(substr($last_kodep, 1));

    // Menambahkan nomor urut dengan 1
    $new_number = $last_number + 1;

    // Membuat kodep baru dengan format PXXX (misal: P001, P002, dst.)
    $new_kodep = 'P'.str_pad($new_number, 3, '0', STR_PAD_LEFT);

    $kondisi = htmlspecialchars($data["kondisi"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $rekomendasi = htmlspecialchars($data["rekomendasi"]);
    $query = "INSERT INTO kondisi (kodep, kondisi, deskripsi, rekomendasi) VALUES ('$new_kodep', '$kondisi', '$deskripsi', '$rekomendasi')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function tambahgejala($data)
{
    global $conn;
    // Mendapatkan kodeg terakhir dari tabel gejala
    $result = mysqli_query($conn, "SELECT kodeg FROM gejala ORDER BY kodeg DESC LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    $last_kodeg = $row['kodeg'];

    // Mengambil nomor urut dari kodeg terakhir
    $last_number = intval(substr($last_kodeg, 1));

    // Menambahkan nomor urut dengan 1
    $new_number = $last_number + 1;

    // Membuat kodeg baru dengan format PXXX (misal: P001, P002, dst.)
    $new_kodeg = 'G'.str_pad($new_number, 3, '0', STR_PAD_LEFT);

    $gejala = htmlspecialchars($data["gejala"]);
    $query = "INSERT INTO gejala (kodeg, gejala) VALUES ('$new_kodeg', '$gejala')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function tambahhubungan($data)
{
    global $conn;
    $kodep = htmlspecialchars($data["kodep"]);
    $kondisi = htmlspecialchars($data["kondisi"]);
    $gejala = htmlspecialchars($data["gejala"]);
    $kodeg = htmlspecialchars($data["kodeg"]);
    
    // Ambil nama kondisi dari tabel kondisi
    $query_kondisi = "SELECT kondisi FROM kondisi WHERE kodep='$kodep'";
    $result_kondisi = mysqli_query($conn, $query_kondisi);
    $kondisi = mysqli_fetch_assoc($result_kondisi)['kondisi'];
    
    // Ambil nama gejala dari tabel gejala
    $query_gejala = "SELECT gejala FROM gejala WHERE kodeg='$kodeg'";
    $result_gejala = mysqli_query($conn, $query_gejala);
    $gejala = mysqli_fetch_assoc($result_gejala)['gejala'];
    
    $query = "INSERT INTO hubungan VALUES ('', '$kodep', '$kondisi', '$gejala', '$kodeg')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function editkondisi($data)
{
    global $conn;
    $id = $data["id"];
    $kondisi = htmlspecialchars($data["kondisi"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $rekomendasi = htmlspecialchars($data["rekomendasi"]);
    // Update nama kondisi dan deskripsi pada tabel kondisi
    $query_kondisi = "UPDATE kondisi SET kondisi = '$kondisi', deskripsi = '$deskripsi', rekomendasi = '$rekomendasi' WHERE id = $id"; 
    mysqli_query($conn, $query_kondisi);
    // Update nama kondisi pada tabel hubungan
    $query_hubungan = "UPDATE hubungan SET kondisi = '$kondisi' WHERE kodep = (SELECT kodep FROM kondisi WHERE id = $id)";
    mysqli_query($conn, $query_hubungan);
    return mysqli_affected_rows($conn);
}

function editgejala($data)
{
    global $conn;
    $id = $data["id"];
    $gejala = htmlspecialchars($data["gejala"]);
    // Update nama gejala pada tabel gejala
    $query_gejala = "UPDATE gejala SET gejala = '$gejala' WHERE id = $id"; 
    mysqli_query($conn, $query_gejala);
    // Update nama gejala pada tabel hubungan
    $query_hubungan = "UPDATE hubungan SET gejala = '$gejala' WHERE kodeg = (SELECT kodeg FROM gejala WHERE id = $id)";
    mysqli_query($conn, $query_hubungan);
    return mysqli_affected_rows($conn);
}

function edithubungan($data)
{
    global $conn;
    $id = $data["id"];
    $kodep = htmlspecialchars($data["kodep"]);
    $kondisi = htmlspecialchars($data["kondisi"]);
    $gejala = htmlspecialchars($data["gejala"]);
    $kodeg = htmlspecialchars($data["kodeg"]);
    // Ambil nama kondisi dari tabel kondisi
    $query_kondisi = "SELECT kondisi FROM kondisi WHERE kodep='$kodep'";
    $result_kondisi = mysqli_query($conn, $query_kondisi);
    $kondisi = mysqli_fetch_assoc($result_kondisi)['kondisi'];
    // Ambil nama gejala dari tabel gejala
    $query_gejala = "SELECT gejala FROM gejala WHERE kodeg='$kodeg'";
    $result_gejala = mysqli_query($conn, $query_gejala);
    $gejala = mysqli_fetch_assoc($result_gejala)['gejala'];
    $query = "UPDATE hubungan SET kodep = '$kodep', kondisi = '$kondisi', gejala = '$gejala', kodeg = '$kodeg' WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function deletekondisi($id)
{
    global $conn;
    // Dapatkan kodep dari tabel kondisi
    $result = mysqli_query($conn, "SELECT kodep FROM kondisi WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    $kodep = $row['kodep'];
    // Hapus semua baris pada tabel hubungan yang mempunyai kodep yang sama
    mysqli_query($conn, "DELETE FROM hubungan WHERE kodep = '$kodep'");
    // Hapus baris pada tabel kondisi yang mempunyai id yang sama dengan parameter yang diberikan
    mysqli_query($conn, "DELETE FROM kondisi WHERE id = $id");

    // Dapatkan semua kondisi yang tersisa
    $kondisi = query("SELECT * FROM kondisi ORDER BY id ASC");
    $count = 0;
    foreach ($kondisi as $p) {
        // Ubah nilai kodep dari kondisi
        $new_kodep = 'P'.str_pad(++$count, 3, '0', STR_PAD_LEFT);
        mysqli_query($conn, "UPDATE kondisi SET kodep = '$new_kodep' WHERE id = {$p['id']}");
        // Ubah nilai kodep dari baris di tabel hubungan yang memiliki kodep yang sama
        mysqli_query($conn, "UPDATE hubungan SET kodep = '$new_kodep' WHERE kodep = '{$p['kodep']}'");
    }

    return mysqli_affected_rows($conn);
}

function deletegejala($id)
{
    global $conn;
    // Dapatkan kodeg dari tabel gejala
    $result = mysqli_query($conn, "SELECT kodeg FROM gejala WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    $kodeg = $row['kodeg'];
    // Hapus semua baris pada tabel hubungan yang mempunyai kodeg yang sama
    mysqli_query($conn, "DELETE FROM hubungan WHERE kodeg = '$kodeg'");
    // Hapus baris pada tabel gejala yang mempunyai id yang sama dengan parameter yang diberikan
    mysqli_query($conn, "DELETE FROM gejala WHERE id = $id");

    // Dapatkan semua gejala yang tersisa
    $gejala = query("SELECT * FROM gejala ORDER BY id ASC");
    $count = 0;
    foreach ($gejala as $g) {
        // Ubah nilai kodeg dari gejala
        $new_kodeg = 'G'.str_pad(++$count, 3, '0', STR_PAD_LEFT);
        mysqli_query($conn, "UPDATE gejala SET kodeg = '$new_kodeg' WHERE id = {$g['id']}");
        // Ubah nilai kodeg dari baris di tabel hubungan yang memiliki kodeg yang sama
        mysqli_query($conn, "UPDATE hubungan SET kodeg = '$new_kodeg' WHERE kodeg = '{$g['kodeg']}'");
    }

    return mysqli_affected_rows($conn);
}

function deletehubungan($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM hubungan WHERE id = $id");
    return mysqli_affected_rows($conn);
}