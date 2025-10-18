<?php
include "db.php";
session_start();
if ((!isset($_GET['id']) || !is_numeric($_GET['id']) || !isset($_SESSION['userid'])) && (!isset($_COOKIE['dx_userid']))) {
    header("Location:error.php?err=id غير موجود");
    exit();
}

if(!isset($_GET['fileid'])){
    header("Location:error.php?err=id غير موجود");
    exit();
}

$fileId = intval($_GET['fileid']);
$check = $conn -> prepare("SELECT * FROM temp_link WHERE file_id = :fId LIMIT 1");
$check -> bindParam(":fId",$fileId,PDO::PARAM_STR);
$check -> execute();
$link = $check -> fetch();

if(!$link){
    header("Location:error.php?err=رابط غير صالح أو إنتهت صلاحيته");
    exit();
}

if(strtotime($link['expires_at']) < time()){
    header("Location:error.php?err=إنتهت صلاحية الرابط");
    exit();
}

$fileId = (int) $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM files WHERE id = :id");
$stmt->bindValue(":id", $fileId, PDO::PARAM_INT);
$stmt->execute();
$file = $stmt->fetch(PDO::FETCH_ASSOC);
$userid = $file['user_id'];
$stm = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stm->bindValue(":id", $userid, PDO::PARAM_INT);
$stm->execute();
$user = $stm->fetch();
$urlname = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1,user-scalable=no">
    <title>ديلوكس أبلود : صفحة التحميل</title>
    <link rel="icon" type="image/png" href="outils/favicons/1748349885280.PNG">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="file.css">
    <link rel="stylesheet" href="fontawesome-free-7.0.0-web/fontawesome-free-7.0.0-web/css/all.min.css">
    <link rel="stylesheet" href="sweetalert/sweetalert2.min.css">
</head>

<body style="direction: rtl;" lang="ar">
    <div id="loader">
        إنتظر قليلا لتحميل الصفحة 
        <div class="spinner-border text-center">
        </div>
    </div>
    <header>
        <nav class="navbar navbar-expand nv1">
            <div class="container-fluid dv1 p-1 d-flex">
                <ul class="navbar-nav me-auto" id="ul2">
                    <li class="nav-item" title="Welcome to DeluxeUpload">
                        <a href="deluxeuploadAr.php" class="nav-link nav-brand p-0 m-0">
                            <img src="outils/icons/LOGO.png" style="padding: 0%;width: 200px;;height: auto;margin: 0;" id="logo">
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="modal fade" id="qrcode">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Qr Code</h1>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn qrcodeButton" onclick="create_qr_code('<?= $_SERVER['SERVER_NAME'].$urlname ?>')" title="إضغط لإنشاء الكود للملف ."> إنشاء <i class="fas fa-qrcode"></i></button>
                    <div class="prepareQr">
                        <div id="timer_qr" class="container bg-secondary p-3 text-light mt-2 mb-2"></div>
                        <div id="qrcodeLink" class="mt-2 mb-2"></div>
                    </div>
                    <p id="para_qr" class="text-dark text-center"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3 mb-3">
        <div class="card p-0 mx-auto">
            <div class="card-body">
                <h2 class="card-title"><?= htmlspecialchars($file['file_name']); ?></h2>
                <a href="reports-ar.php?id=<?= htmlspecialchars($file['user_id']); ?>&fileid=<?= $file['id']; ?>" style="color: red;text-decoration:none;"><i class="fas fa-flag"></i> الابلاغ عن مشكل</a>
                <hr>
                <p class="card-text"><?= number_format($file['file_size'] / (1024 * 1024), 2) . "ميغابايت "; ?></p>
                <hr>
                <p class="card-text"> عدد التحميلات <?= htmlspecialchars($file['download_count']); ?></p>
                <hr>
                <p class="card-text">تم الرفع في <?= htmlspecialchars($file['upload_date']); ?> من طرف <?= htmlspecialchars($_SESSION['username'] ?? $_COOKIE['dx_username']); ?></p>
                <hr>
                <a href="#"><img src="outils/icons/sc-download/sc-download/facebook.jpg" width="30px" height="auto"></a>
                <a href="#"><img src="outils/icons/sc-download/sc-download/github.jpg" width="30px" height="auto"></a>
                <a href="#"><img src="outils/icons/sc-download/sc-download/gmail.jpg" width="30px" height="auto"></a>
                <a href="#"><img src="outils/icons/sc-download/sc-download/youtube.jpg" width="30px" height="auto"></a>
                <a href="#"><img src="outils/icons/sc-download/sc-download/instagram.jpg" width="30px" height="auto"></a>
                <a href="#"><img src="outils/icons/sc-download/sc-download/linkedin.jpg" width="30px" height="auto"></a>
                <a href="#"><img src="outils/icons/sc-download/sc-download/telgram.jpg" width="30px" height="auto"></a>
                <a href="#"><img src="outils/icons/sc-download/sc-download/x.jpg" width="30px" height="auto"></a>
                <hr>
                <a type="button" href="download.php?id=<?= $file['id']; ?>" class="btn p-3 w-100" id="download">نحميل</a>
                <div id="prepare_link" class="container bg-secondary p-3 text-light mt-2 mb-2"><span id="timer_download">انتظر بضع ثواني</span></div>
                <div class="mt-2 mb-2 d-flex flex-direction-row justify-content-center align-items-center dv3">
                    <input type="text" class="form-control" value="<?= 'http://localhost' . $_SERVER['REQUEST_URI']; ?>" readonly>
                    <a href="" title="نسخ الرابط" onclick="copyToClipboard(event,'<?= $_SERVER['SERVER_NAME'].$urlname ?>')" class="link">
                        <i class="fas fa-copy"></i>
                    </a>
                    <a href="" title="Copy link" data-bs-target="#qrcode" data-bs-toggle="modal" class="link">
                        <i class="fas fa-qrcode"></i>
                    </a>
                </div>
                <div id="alertmess"></div>
            </div>
        </div>
    </div>
    <script src="prepare_link.js"></script>
    <script src="theme.js"></script>
    <script src="clipboard.js"></script>
    <script src="loading.js"></script>
    <script src="qrcode.js"></script>
    <script src="qrCodeJs/qrcode.min.js"></script>
    <script src="sweetalert/sweetalert2.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>