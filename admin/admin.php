<?php
session_start();
if(isset($_SESSION["loginAdmin"]))
{
    header("location: dashboard.php");
    exit;
}
require '../koneksi.php';
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
    if(mysqli_num_rows($result) === 1)
    {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"]))
        {
            //buat session
            $_SESSION["loginAdmin"] = true;

            header("Location: dashboard.php");
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
    <title>Login Admin</title>
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

    <form action="" method="post" class="masuk admin">
    <h1 id="judul">Login Admin</h1>
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
            <a href="registerAdmin">Belum Punya Akun ?</a><br>

            <button type="submit" name="login" id="login">Login</button>
            <button type="reset" name="reset" id="reset">Reset</button>
    </form>

</body>
</html>