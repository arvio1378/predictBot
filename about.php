<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/responsive.css?<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/cb30ddf7c8.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>About</title>
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
                <a href="about" class="active">About</a>
                <a href="contact">Contact</a>
            </nav>
        </div>
    </header>

    <section class="about">
        <div class="container">
            <h1><i>About</i></h1>
            <h3>PredictBot adalah chatbot yang digunakan untuk menentukan kemungkinan penyakit dari gejala yang ada. PredictBot ini bisa digunakan kapanpun dan dimanapun. Biasanya dengan dibantu oleh manusia tidak bisa selama 24 jam, tapi bila dengan bot bisa dilakukan dalam 24 jam.</h3>
            <h2><i>Terima kasih sudah mengunjungi website ini !!</i></h2>
        </div>
    </section>
</body>
</html>