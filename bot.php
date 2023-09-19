<?php

session_start();
if(!isset($_SESSION["loginUser"]))
{
    header("location: loginUser.php");
    exit;
}
require 'koneksi.php';

// ambil data gejala dari tabel hubungan
$query = "SELECT DISTINCT gejala, kodeg FROM hubungan";
$result = mysqli_query($conn, $query);
// simpan data gejala dan kodeg dalam array
$gejala = array();
$kodeg = array();
while ($row = mysqli_fetch_assoc($result)) {
    $gejala[] = $row['gejala'];
    $kodeg[] = $row['kodeg'];
}

// ambil data kondisi dari tabel hubungan yang memiliki gejala yang dipilih
$query2 = "SELECT kodep, kondisi FROM hubungan WHERE kodeg IN ('" . implode("','", $kodeg) . "') GROUP BY kodep";
$result2 = mysqli_query($conn, $query2);
// simpan data kondisi dan kodep dalam array
$kondisi = array();
$kodep = array();
while ($row2 = mysqli_fetch_assoc($result2)) {
    $kondisi[] = $row2['kondisi'];
    $kodep[] = $row2['kodep'];
}

// ambil data gejala-kondisi dari tabel hubungan untuk forward chaining
$query3 = "SELECT * FROM hubungan WHERE kodep IN ('" . implode("','", $kodep) . "')";
$result3 = mysqli_query($conn, $query3);
// simpan data gejala, kodeg, dan kodep dalam array
$rules = array();
while ($row3 = mysqli_fetch_assoc($result3)) {
    $rules[] = array(
        'gejala' => $row3['gejala'],
        'kodeg' => $row3['kodeg'],
        'kodep' => $row3['kodep']
    );
}

// ambil deskripsi dan rekomendasi kondisi dari tabel kondisi yang sesuai dengan kodep dari tabel hubungan
$query4 = "SELECT deskripsi, rekomendasi FROM kondisi WHERE kodep IN ('" . implode("','", $kodep) . "')";
$result4 = mysqli_query($conn, $query4);
// simpan data deskripsi dalam array
$deskripsi = array();
$rekomendasi = array();
while ($row4 = mysqli_fetch_assoc($result4)) {
    $deskripsi[] = $row4['deskripsi'];
    $rekomendasi[] = $row4['rekomendasi'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PredictBot</title>
    <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/responsive.css?<?php echo time(); ?>">
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
    <header>
        <div class="container">
            <i class="fa-solid fa-bars"></i>
            <h1><i>PredictBot</i></h1>
            <nav class="menu">
                <a href="index">Home</a>
                <a href="loginUser" class="active">PredictBot</a>
                <a href="about">About</a>
                <a href="contact">Contact</a>
            </nav>
        </div>
    </header>

    <div class="chatbox">
		<h1><i>PredictBot | Hello,<?php echo $_SESSION['username']; ?></i></h1>
		<div class="kolomchat"></div>
		<div class="pesan">
			<button id="ulang" onclick="document.location.reload(true)">Reset</button>
            <button><a href="riwayatUser" style="text-decoration: none;">Riwayat</a></button>
            <button id="logout"><a href="logoutUser" onclick="return confirm('Ingin keluar ?');" >Logout</a></button>
		</div> 
	</div>
</body>
</html>

<script>
let kondisi = <?php echo json_encode($kondisi); ?>; //mengambil data kondisi dari PHP
let deskripsi = <?php echo json_encode($deskripsi); ?>; //mengambil data deskripsi dari PHP
let rekomendasi = <?php echo json_encode($rekomendasi); ?>; //mengambil data rekomendasi dari PHP
let kodep = <?php echo json_encode($kodep); ?>; //mengambil data kodep dari PHP
let gejala = <?php echo json_encode($gejala); ?>; //mengambil data gejala dari PHP
let kodeg = <?php echo json_encode($kodeg); ?>; //mengambil data kode gejala dari PHP
let rules = <?php echo json_encode($rules); ?>; //mengambil data aturan dari PHP
let jawaban = []; //array untuk menyimpan jawaban user
let jawaban_kodeg = []; //array untuk menyimpan kode gejala dari jawaban user
let index = 0; //index gejala yang sedang ditampilkan

//fungsi untuk menampilkan gejala pada index tertentu
function tampilkangejala(index) {
    if (gejala.length == 0 || kondisi.length == 0) {
    $(".kolomchat").append('<div class="chat message">Tidak ada data</div>');
} else {
    $(".kolomchat").append('<div class="chat message"><p>Apakah ' + gejala[index] + ' ? </p></div><div class="tombol"><button class="yes" id="yes' + index + '">YES</button><button class="no" id="no' + index + '">NO</button></div>');
    $(".kolomchat").scrollTop($(".kolomchat")[0].scrollHeight);
    }
}

//menampilkan gejala pertama pada saat halaman dimuat
tampilkangejala(index);

//fungsi untuk menangani klik tombol YES
$(document).on('click', '.yes', function() {
    $(".kolomchat").append('<div class="chat user"><p>YES</p></div>');
    $(".tombol").hide();
    jawaban.push("YES"); //menambahkan jawaban ke dalam array
    jawaban_kodeg.push(kodeg[index]);
    index++; //mengubah index ke gejala selanjutnya
    //tampilkan gejala selanjutnya jika masih ada
    if (index < gejala.length) {
        tampilkangejala(index);
    }
    //tampilkan hasil jika gejala terakhir sudah dijawab
    else {
        tampilkanhasil();
    }
    $(".kolomchat").scrollTop($(".kolomchat")[0].scrollHeight);
});

//fungsi untuk menangani klik tombol NO
$(document).on('click', '.no', function() {
    $(".kolomchat").append('<div class="chat user"><p>NO</p></div>');
    $(".tombol").hide();
    jawaban.push("NO"); //menambahkan jawaban ke dalam array
    jawaban_kodeg.push(kodeg[index]);
    index++; //mengubah index ke gejala selanjutnya
    //tampilkan gejala selanjutnya jika masih ada
    if (index < gejala.length) {
        tampilkangejala(index);
    }
    //tampilkan hasil jika gejala terakhir sudah dijawab
    else {
            tampilkanhasil();
        }
        $(".kolomchat").scrollTop($(".kolomchat")[0].scrollHeight);
    });

// Fungsi untuk menampilkan hasil
function tampilkanhasil() {
    // Menggabungkan jawaban dan kode gejala menjadi satu array hasil
    let hasil = [];
    for (let i = 0; i < jawaban.length; i++) {
        hasil.push({
            jawaban: jawaban[i],
            kodeg: jawaban_kodeg[i]
        });
    }

    // Membuat array baru yang berisi gejala yang dijawab dengan YES
    let gejalaYes = [];
    for (let i = 0; i < hasil.length; i++) {
        if (hasil[i].jawaban == "YES") {
            gejalaYes.push(hasil[i].kodeg);
        }
    }

    // Mencari kondisi yang sesuai dengan aturan forward chaining
    let kondisiSesuai = [];
    let deskripsiSesuai = [];
    let rekomendasiSesuai = [];
    for (let i = 0; i < kodep.length; i++) {
        let kodekondisi = kodep[i];
        let aturan = rules.filter(function(rule) {
            return rule.kodep == kodekondisi;
        });
        let gejalaAturan = aturan.map(function(rule) {
            return rule.kodeg;
        });
        if (gejalaAturan.every(function(kodeg) {
            return gejalaYes.indexOf(kodeg) > -1;
        })) {
            kondisiSesuai.push(kondisi[i]);
            deskripsiSesuai.push(deskripsi[i]);
            rekomendasiSesuai.push(rekomendasi[i]);
        }
    }

    // Menggabungkan gejala terpilih dengan gejala yang ada
    let semuaJawaban = [];
    for (let i = 0; i < jawaban.length; i++) {
        let jawabanGejala = gejala[i] + ': ' + jawaban[i];
        semuaJawaban.push(jawabanGejala);
    }
    let semuaGejalaString = semuaJawaban.join('<br>');

    // Mendapatkan tanggal dan jam saat ini
    let currentDateTime = new Date();
    let formattedDateTime = currentDateTime.toLocaleString();

    // Menyimpan data ke dalam tabel riwayat
    $.ajax({
        url: 'simpan_riwayat.php',
        type: 'POST',
        data: {
            nama: '<?php echo $_SESSION["username"]; ?>',
            gejala: semuaGejalaString,
            kondisi: kondisiSesuai.length > 0 ? kondisiSesuai.join(', ') : 'Tidak ditemukan kondisi yang sesuai',
            deskripsi: deskripsiSesuai.length > 0 ? deskripsiSesuai.join(', ') : '-',
            rekomendasi: rekomendasiSesuai.length > 0 ? rekomendasiSesuai.join(', ') : '-',
            dateTime: formattedDateTime
        },
        success: function(response) {
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });

    if (kondisiSesuai.length > 0) {
        let hasilDiagnosa = '<div class="chat message">';
        for (let i = 0; i < kondisiSesuai.length; i++) {
            hasilDiagnosa += 'Anda mungkin menderita ' + kondisiSesuai[i] + '.<br>' + deskripsiSesuai[i] + '<br>';
            hasilDiagnosa += 'Rekomendasi: ' + rekomendasiSesuai[i] + '<br><br>';
        }
        hasilDiagnosa += '</div>';
        $(".kolomchat").append(hasilDiagnosa);
    } else {
        $(".kolomchat").append('<div class="chat message">Tidak ditemukan kondisi defisiensi yang sesuai.</div>');
    }
    $(".kolomchat").append('<div class="chat message">Keterangan gejala:<br>' + semuaGejalaString + '</div>');
    $(".kolomchat").scrollTop($(".kolomchat")[0].scrollHeight);
}

</script>