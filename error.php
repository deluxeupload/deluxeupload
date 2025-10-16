<?php
    include "db.php";
    session_start();
    if(!isset($_GET['err'])){
        header("Location:dashboard.php");
        exit();
    }else{
        $mess = $_GET['err'];
    }
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1,user-scalable=no">
    <title>Deluxe Upload : Error</title>
    <link rel="icon" type="image/png" href="outils/favicons/1748349885280.PNG">
    <link rel="stylesheet" href="bootstrap-5.3.7-dist/bootstrap-5.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-7.0.0-web/fontawesome-free-7.0.0-web/css/all.min.css">
    <link rel="stylesheet" href="NProgress/nprogress.css">
    <link rel="stylesheet" href="sweetalert/sweetalert2.min.css">
    <style>
        body{
            margin: 0;
        }

        *{
            font-weight: 700;
            font-size: 20px;
        }

        .error-box{
            display: flex;
            justify-content: center;
            align-items: center;
            align-content: center;
            flex-direction: column;
            text-align: center;
        }
        
        #message{
            background-color: rgb(16,94,196);
            padding: 10px;
            color: white;
        }

        i{
            font-size: 20px;
        }

        #video{
            width: 60px;
        }

        body.dark{
            background-color: black;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5 error-box">
        <div>
            <h1 class="text-center fw-bold">Error <i class="fas fa-times-circle text-danger"></i></h1>
            <p id="message"><?= $mess; ?></p>
            <p>Oops! Something went wrong :(</p>
        </div>
        <video loop autoplay>
            <source src="outils/videos/error_video.mp4">
        </video>
        <!-- <img src="outils/icons/LOGO.png" class="img-fluid" style="max-width: 500px;" alt=""> -->
    </div>

    <script src="theme.js"></script>
    <script src="nprogress/nprogress.js"></script>
    <script src="nprogress.js"></script>
    <script src="sweetalert/sweetalert2.min.js"></script>
    <script src="bootstrap-5.3.7-dist/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome-free-7.0.0-web/fontawesome-free-7.0.0-web/js/all.min.js"></script>
</body>
</html>