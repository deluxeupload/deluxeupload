<?php
include "upload_file.php";
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1,user-scalable=no">
    <title>Deluxe Upload : Upload File</title>
    <link rel="icon" type="image/png" href="outils/favicons/1748349885280.PNG">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="upload.css">
    <link rel="stylesheet" href="fontawesome-free-7.0.0-web/fontawesome-free-7.0.0-web/css/all.min.css">
    <link rel="stylesheet" href="sweetalert/sweetalert2.min.css">
</head>

<body lang="en">
    <div id="loader">
        Wait a seconds for load
        <div class="spinner-border text-center">
        </div>
    </div>
    <header>
        <nav class="navbar navbar-expand nv1">
            <div class="container-fluid dv1 p-1 d-flex">
                <ul class="navbar-nav me-auto" id="ul2">
                    <li class="nav-item" title="Welcome to DeluxeUpload">
                        <a href="deluxeupload.php" class="nav-link nav-brand p-0 m-0">
                            <img src="outils/icons/LOGO.png" style="padding: 0%;width: 200px;;height: auto;margin: 0;" id="logo">
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <video class="bg-video" autoplay muted loop>
        <source src="outils/videos/856171-hd_1920_1080_30fps.mp4">
    </video>
    <div class="container content p-0 mt-5 mb-5">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <div class="card p-0">
                <div class="mt-2 mb-2">
                    <h1>Deluxe Upload</h1>
                </div>
                <div class="card-body">
                    <div>
                        <img src="outils/icons/upload.png" width="150px" height="auto" alt="upload">
                        <p>click here for upload a file</p>
                        <input type="file" class="form-control d-none" name="userfile" id="file">
                        <p id="show-file" class="mt-2 mb-2"></p>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" id="uploadButton" class="btn w-100" onclick="uploadFileBtn()">Upload</button>
                </div>
            </div>
        </form>
        <?php if (!empty($message)): ?>
            <div class="container p-3 text-light bg-secondary">
                <?= $message; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="upload.js"></script>
    <script src="theme.js"></script>
    <script src="loading.js"></script>
    <script src="sweetalert/sweetalert2.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>