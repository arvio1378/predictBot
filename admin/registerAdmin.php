<?php
session_start();
if(isset($_SESSION["loginAdmin"]))
{
    header("location: dashboard.php");
    exit;
}
require '../koneksi.php';
if (isset($_POST["register"])) {
    if (registrasiAdmin($_POST) > 0) {
        echo "<script>
				alert('user baru berhasil ditambahkan!');
		    </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan user !');
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
    <title>Register Admin</title>
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

    <form action="" method="post" class="masuk registerAdmin">
        <h1 id="judul">Register Admin</h1>
        <div class="username">
            <label for="username">Username : </label>
            <input type="username" name="username" id="username" required>
        </div>
        <div class="password">
            <label for="password">Password : </label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="konfirmasi">
            <label for="password2">Konfirmasi Password : </label>
            <input type="password" name="password2" id="password2" required>
        </div>
        <a href="admin">Sudah Punya Akun ?</a><br>
        <button type="submit" name="register" id="register">Register</button>
        <button type="reset" name="reset" id="reset">Reset</button>
    </form>
    
</body>
</html>