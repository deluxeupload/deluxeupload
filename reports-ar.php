<?php
include "db.php";
ob_start();
include "send_report.php";
ob_end_flush();

if (isset($_GET['fileid']) && is_numeric($_GET['fileid'])) {
    $fileid = intval($_GET['fileid']);
    $stmt = $conn->prepare("SELECT * FROM files WHERE id = :id");
    $stmt->bindValue(":id", $fileid, PDO::PARAM_INT);
    $stmt->execute();
    $file = $stmt->fetch();
    $filename = $file['file_name'];
}

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ديلوكس أبلود : صفحة اضافة بلاغ</title>
    <link rel="shortcut icon" href="outils/favicons/1748349885280.PNG" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap-5.3.7-dist/bootstrap-5.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="reports.css">
    <link rel="stylesheet" href="fontawesome-free-7.0.0-web/fontawesome-free-7.0.0-web/css/all.min.css">
</head>

<body style="direction: rtl;" lang="ar">
    <div id="loader">
        انتظر لحظة من فضلك يتم تحميل الصفحة 
        <div class="spinner-border text-center">
        </div>
    </div>
    <header>
        <nav class="navbar navbar-expand">
            <div class="container-fluid dv1 p-0 d-flex">
                <ul class="navbar-nav p-1 ms-auto" id="ul2">
                    <li class="nav-item" title="Welcome to DeluxeUpload">
                        <a href="deluxeupload.php" class="nav-link nav-brand p-0 m-0">
                            <img src="outils/icons/LOGO.png" style="padding: 0%;width: 200px;;height: auto;margin: 0;" id="logo">
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container mt-3 mb-3">
        <div class="alert-card mt-5 mb-5 mx-auto">
            <h1><i class="fas fa-flag"></i> ارسال بلاغ</h1>
            <p>يرجى وصف المشكلة بوضوح حتى نتمكن من اتخاذ الإجراء اللازم.</p>
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($_SESSION['userid'] ?? $_COOKIE['dx_userid']); ?>">
                    <input type="hidden" name="lang" value="ar">
                </div>
                <div class="mt-3 mb-3">
                    <label for="fromemail" class="form-label">من الايميل</label>
                    <input type="text" readonly class="form-control" id="fromemail" value="<?php echo htmlspecialchars($_SESSION['useremail'] ?? $_COOKIE['dx_useremail']); ?>">
                </div>
                <?php if (isset($_GET['fileid'])): ?>
                    <div class="mt-3 mb-3">
                        <label for="forfile" class="form-label">للملف</label>
                        <input type="text" readonly name="forfile" class="form-control" id="forfile" value="<?= $filename; ?>">
                    </div>
                <?php endif; ?>
                <div>
                    <label for="reasonReport" class="form-label">سبب البلاغ</label>
                    <textarea name="reasonreport" class="form-control" id="reasonReport" placeholder="اضافة بلاغ ..."><?php if ($valid) {
                                                                                                                                echo "";
                                                                                                                            } ?></textarea>
                </div>
                <div class="mt-2 mb-2">
                    <button type="submit" id="send" class="btn">ارسال</button>
                </div>
            </form>
            <?php if (!empty($message)): ?>
                <div class="container alert alert-close w-100 p-3 m-0 mx-auto bg-secondary text-light" data-bs-dismiss="alert">
                    <?= $message; ?>
                </div>
                <?php $message = ""; ?>
            <?php endif; ?>
        </div>
    </div>
    <!-- <script src="reports.js"></script> -->
    <script src="theme.js"></script>
    <script src="loading.js"></script>
    <script src="bootstrap-5.3.7-dist/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>