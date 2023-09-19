<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
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
                <a href="contact" class="active">Contact</a>
            </nav>
        </div>
    </header>

    <section class="contact">
        <div class="container">
            <h1><i><u>CONTACT INFO</u></i></h1>
            <div class="kontak">
                <br><h2>My Name</h2>
                <p>Arvio Abe Suhendar</p><br>
                <h2>Email</h2>
                <p>4rv10suhendar@gmail.com</p><br>
                <h2>Instagram</h2>
                <a href="https://www.instagram.com/arvio1378/"><p>arvio1378</p></a><br>
            </div>
        </div>
    </section>
</body>
</html>