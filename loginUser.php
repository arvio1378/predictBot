<?php
session_start();
if(isset($_SESSION["loginUser"]))
{
    header("location: bot.php");
    exit;
}
require 'koneksi.php';
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    if(mysqli_num_rows($result) === 1)
    {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"]))
        {
            //buat session
            $_SESSION["loginUser"] = true;
            $_SESSION['username'] = $username;

            header("Location: bot.php");
            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
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
                <a href="loginUser">PredictBot</a>
                <a href="about">About</a>
                <a href="contact">Contact</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <form action="" method="post" class="masuk">
        <h1 id="judul">Login User</h1>
            <?php if(isset($error)) : ?>
                <p style="color: red; font-style: italic; font-weight : bold;">Username atau Password salah !</p>
            <?php endif; ?>
            <div class="username">
                <label for="username">Username : </label>
                <input type="username" name="username" id="username" required>
            </div>
            <div class="password">
                <label for="password">Password : </label>
                <input type="password" name="password" id="password" required>
            </div>
                <a href="registerUser">Belum Punya Akun ?</a><br>
                <button type="submit" name="login" id="login">Login</button>
                <button type="reset" name="reset" id="reset">Reset</button>
        </form>
    </div>

</body>
</html>