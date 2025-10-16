<?php
include "db.php";
include "dash-board.php";
include "pagination-files.php";
include "pagination-reports.php";
include "fn_alert.php";

$id = $_SESSION['userid'] ?? $_COOKIE['dx_userid'];
$stm = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stm->bindValue(":id", $id, PDO::PARAM_INT);
$stm->execute();
$user = $stm->fetch();

$img = basename($user['profile_picture']);
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1,user-scalable=no">
    <title>ديلوكس أبلود : لوحة التحكم</title>
    <link rel="icon" type="image/png" href="outils/favicons/1748349885280.PNG">
    <link rel="stylesheet" href="bootstrap-5.3.7-dist/bootstrap-5.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="fontawesome-free-7.0.0-web/fontawesome-free-7.0.0-web/css/all.min.css">
    <link rel="stylesheet" href="NProgress/nprogress.css">
    <link rel="stylesheet" href="sweetalert/sweetalert2.min.css">
</head>

<body lang="ar">
    <div id="loader">
        انتظر لحظة من فضلك يتم تحميل الصفحة
        <div class="spinner-border text-center">
        </div>
    </div>
    <header>
        <nav class="navbar navbar-expand p-1 nv1">
            <div class="container-fluid dv1 p-1 d-flex">
                <ul class="navbar-nav ms-auto p-0" id="ul2">
                    <li class="nav-item" title="Welcome to DeluxeUpload">
                        <a href="deluxeuploadAr.php" class="nav-link nav-brand p-0 m-0">
                            <img src="outils/icons/LOGO.png" style="padding: 0%;width: 200px;;height: auto;margin: 0;" id="logo" class="img-fluid">
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav dv1 me-auto d-md-flex" id="ul1">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;" id="dropdownIcon">
                            اللغة <i class="fas fa-chevron-down" id="drpIcon"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-start" id="ul4">
                            <li class="nav-item">
                                <a href="dashboard.php" class="dropdown-item">الانجليزية</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-ar.php" class="dropdown-item">العربية</a>
                            </li>
                        </ul>
                    </div>
                    <li class="nav-item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#account">
                            <img src="<?= !empty($img) ? 'profile_picture/' . htmlspecialchars($img) : 'outils/icons/useracc2.png' ?>" id="imgAcc" width="40px" height="40px" alt="account">
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="modal fade" id="account">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1>لوحة التحكم</h1>
                    </div>
                    <div class="modal-body">
                        <table class="table p-0">
                            <?php if (isset($_SESSION['username'], $_SESSION['useremail'])): ?>
                                <p>مرحبا <?php echo htmlspecialchars($_SESSION['username']) . "✨" ?></p>
                                <tr>
                                    <td>الاسم</td>
                                    <td><?php echo htmlspecialchars($_SESSION['username']);  ?></td>
                                </tr>
                                <tr>
                                    <td>البريد الالكتروني</td>
                                    <td><?php echo htmlspecialchars($_SESSION['useremail']);  ?></td>
                                </tr>
                                <tr>
                                    <td>تعديل</td>
                                    <td><a href="edit-ar.php?id=<?php echo htmlspecialchars($_SESSION['userid']); ?>" id="edit">تعديل <i class="fas fa-pencil"></i></a></td>
                                </tr>
                                <tr>
                                    <td>تسجيل الخروج</td>
                                    <td><a href="logout.php?id=<?php echo htmlspecialchars($_SESSION['userid']); ?>" id="logout">تسجيل الخروج <i class="fas fa-sign-out-alt"></i></a></td>
                                </tr>
                            <?php elseif (isset($_COOKIE['dx_username'], $_COOKIE['dx_useremail'])): ?>
                                <p>مرحبا <?php echo htmlspecialchars($_COOKIE['dx_username']) . "✨" ?></p>
                                <tr>
                                    <td>الاسم</td>
                                    <td><?php echo htmlspecialchars($_COOKIE['dx_username']);  ?></td>
                                </tr>
                                <tr>
                                    <td>الايميل</td>
                                    <td><?php echo htmlspecialchars($_COOKIE['dx_useremail']);  ?></td>
                                </tr>
                                <tr>
                                    <td>تعديل</td>
                                    <td><a href="edit.php?id=<?php echo htmlspecialchars($_COOKIE['dx_userid']); ?>" id="edit">تعديل</a></td>
                                </tr>
                                <tr>
                                    <td>تسجيل الخروج</td>
                                    <td><a href="logout.php" id="logout">تسجيل الخروج</a></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">أنت غير مسجل <a href="sign-up.php">انشاء حساب</a></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="modal fade" id="support">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>تواصل معنا</h1>
                </div>
                <div class="modal-body">
                    <div>
                        <a href="#">
                            <img src="outils/icons/github.png" width="100px" height="auto" alt="github">
                        </a>
                        <p>@كيتهاب</p>
                    </div>
                    <div>
                        <a href="#">
                            <img src="outils/icons/fb.png" width="100px" height="auto" alt="facebook">
                        </a>
                        <p>@فايسبوك</p>
                    </div>
                    <div>
                        <a href="#">
                            <img src="outils/icons/telegram.png" width="100px" height="auto" alt="telegram">
                        </a>
                        <p>@تلغرام</p>
                    </div>
                    <div>
                        <a href="#">
                            <img src="outils/icons/x.png" width="100px" height="auto" alt="x">
                        </a>
                        <p>@اكس</p>
                    </div>
                    <div>
                        <a href="#">
                            <img src="outils/icons/icons sc/youtube.png" width="100px" height="auto"
                                alt="youtube">
                        </a>
                        <p>@يوتيوب</p>
                    </div>
                    <div>
                        <a href="#">
                            <img src="outils/icons/icons sc/gmail.png" width="100px" height="auto"
                                alt="gmail">
                        </a>
                        <p>@جيمايل</p>
                    </div>
                    <div>
                        <a href="#">
                            <img src="outils/icons/icons sc/instagram.png" width="100px" height="auto"
                                alt="instagram">
                        </a>
                        <p>@أنستغرام</p>
                    </div>
                    <div>
                        <a href="https://500px.com/p/abderrahimabdouabdou">
                            <img src="outils/icons/icons sc/500px.png" width="100px" height="auto" alt="instagram">
                        </a>
                        <p>@500px</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cookies">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>
                        سياسة الكوكيز
                    </h1>
                </div>
                <div class="modal-body">
                    <p>نحن نستخدم الكوكيز لتحسين تجربتك في موقع Deluxe Upload. باستخدامك الموقع، فإنك توافق على استخدامنا لها.</p>
                    <a href="cookies-ar.php?lang=ar" type="button" class="btn" id="accept">قبول</a>
                </div>
                <div class="modal-footer">
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="profileP">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>
                        الصورة الشخصية
                    </h1>
                </div>
                <div class="modal-body">
                    <form action="profil_picture.php?id=<?= $id; ?>&lang=ar" method="post" enctype="multipart/form-data">
                        <input type="file" name="profile_picture" id="profilePicture" style="display: none;" accept=".jpg, .jpeg, .png">
                        <div class="container-fluid add_picture" id="pPicture">
                            <img src="outils/icons/up_profile_picture1.png" width="150px" height="auto" id="profileIcon" alt="" class="img-fluid">
                            <p id="para" class="text-center">اضغط هنا لرفع الصورة الشخصية</p>
                            <img src="" id="image" alt="" class="img-fluid">
                        </div>
                        <?php if (!empty($_SESSION['profileErr'])): ?>
                            <div class="container w-100 bg-secondary">
                                <?= $_SESSION['profileErr']; ?>
                            </div>
                        <?php endif; ?>
                        <div id="filename" class="container w-100 p-1">
                            <p id="para1" style="font-weight: 700;"></p>
                        </div>
                        <div class="mt-1 mb-1">
                            <i style="opacity: calc(0.8);">المرجو رفع ملفات بصيغ PNG , JPG و JPEG .</i>
                        </div>
                        <div class="mt-2 mb-2">
                            <button class="btn" id="profilePictureButton">اضافة</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
            </div>
        </div>
    </div>

    <div>
        <?php showAlert('errmess'); ?>
        <?php showAlert('profileMess'); ?>
        <?php showAlert('profileErr'); ?>

        <button type="button" class="btn" data-bs-toggle="collapse" data-bs-target="#demo" id="collapseButton"><i class="fas fa-bars"></i></button>
        <nav class="navbar navbar-expand nv2 d-md-block collapse" id="demo">
            <div class="container-fluid dv2 p-0">
                <ul class="nav mx-auto">
                    <li class="nav-item"><a href="#info" role="tab" aria-controls="info" data-bs-target="#info" data-bs-toggle="tab" class="nav-link active"><i class="fas fa-id-card"></i> المعلومات الشخصية</a></li>
                    <li class="nav-item"><a href="#" role="tab" data-bs-target="#files" data-bs-toggle="tab" class="nav-link"><i class="fas fa-id-card"></i> ملفاتي</a></li>
                    <li class="nav-item"><a href="#" role="tab" data-bs-target="#reports" data-bs-toggle="tab" class="nav-link"><i class="fas fa-images"></i> بلاغاتي</a></li>
                    <li class="nav-item"><a href="#setting" role="tab" aria-controls="setting" data-bs-target="#setting" data-bs-toggle="tab" class="nav-link"><i class="fas fa-sliders-h"></i> اعدادات متقدمة</a></li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid p-0 tab-content">
            <div class="p-2 tab-pane fade show active" id="info">
                <h2 class="mt-2 mb-2">المعلومات الشخصية</h2>
                <div class="d-flex justify-content-start align-items-center mt-2 mb-2" style="flex-direction: column;gap:5px;">
                    <div>
                        <img src="<?= !empty($img) ? 'profile_picture/' . htmlspecialchars($img) : 'outils/icons/useracc2.png' ?>" width="100px" height="100px" id="imgAcc" alt="">
                    </div>
                    <div class="text-center">
                        <a href="#" id="changePhoto" data-bs-target="#profileP" data-bs-toggle="modal">تغيير الصورة</a>
                        <br>
                        <form action="delete_profile_picture.php?id=<?= $id; ?>&lang=ar" id="alertFormProfile" method="post">
                            <a type="button" id="removePhoto" onclick="delete_profile_picture('ar')"><i class="fas fa-trash text-center"></i> حذف</a>
                        </form>
                    </div>
                </div>
                <div class="list-group" id="listGroup1">
                    <div class="list">
                        <li class="list-group-item">
                            <label for="ip" class="form-label">IP</label>
                            <input type="text" class="form-control" value="<?= $_SERVER['REMOTE_ADDR']; ?>" id="ip" readonly>
                        </li>
                        <li class="list-group-item">
                            <label for="name" class="form-label">الاسم</label>
                            <input type="text" class="form-control" value="<?= $_SESSION['username'] ?? $_COOKIE['dx_username']; ?>" id="name" readonly>
                        </li>
                        <li class="list-group-item">
                            <label for="email" class="form-label">الايميل</label>
                            <input type="text" class="form-control" value="<?= $_SESSION['useremail'] ?? $_COOKIE['dx_useremail']; ?>" id="email" readonly>
                        </li>

                        <li class="list-group-item">
                            <label for="date" class="form-label">التاريخ</label>
                            <input type="text" class="form-control" value="<?= $_SESSION['created_at'] ?? $_COOKIE['dx_created_at']; ?>" id="date" readonly>
                        </li>
                    </div>
                </div>
            </div>
            <div class="p-2 tab-pane fade show" id="setting">
                <h2 class="mt-2 mb-2">اعدادات متقدمة</h2>
                <div>
                    <div class="list-group" id="listGroup2">
                        <li class="list-group-item">
                            <a href="edit.php?id=<?= $_SESSION['userid'] ?? $_COOKIE['dx_userid'] ?>"><i class="fas fa-user-cog"></i> تعديل معلوماتي</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#cookies"><i class="fas fa-cookie"></i> كوكيز</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#support"><i class="fas fa-headset"></i> تواصل معنا</a>
                        </li>
                        <li class="list-group-item">
                            <a href="logout.php" style="color: #e63946;"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" id="delAcc"><i class="fas fa-user-slash"></i> حذف الحساب</a>
                        </li>
                    </div>
                </div>
            </div>
            <div class="p-2 tab-pane fade show" id="files">
                <h2 class="mt-2 mb-2">ملفاتي</h2>
                <div class="table-responsive mt-2 mb-2">
                    <table class="table table-hover table-center" style="width: 100%;margin:auto;" id="tab2">
                        <tr>
                            <th>الملف</th>
                            <th>الحجم</th>
                            <th>تاريخ الرفع</th>
                            <th>التحميلات</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php foreach ($currentFiles as $file): ?>
                            <?php $file_name = $file['file_name'];
                            $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                            $iconPath = isset($filesicons[$extension]) ? $filesicons[$extension] : 'outils/favicons/1748349885280.png'; ?>
                            <tr>
                                <td>
                                    <?php echo "<img src='{$iconPath}' alt='{$extension} icon' width='20'>" . ' ' . htmlspecialchars($file['file_name']); ?>
                                </td>
                                <td>
                                    <?= number_format($file['file_size'] / (1024 * 1024), 2) . "MB"; ?>
                                </td>
                                <td><?= htmlspecialchars($file['upload_date']); ?></td>
                                <td><?= htmlspecialchars($file['download_count']); ?></td>
                                <td>
                                    <a href="fileAr.php?id=<?= $file['id']; ?>&fileid=<?= $file['id']; ?>" class="btn download-btn" id="download"><i class="fas fa-download text-center"></i></a>
                                </td>
                                <td>
                                    <form action="delete_file.php?id=<?= $file['id']; ?>&lang=ar" id="fileForm<?= $file['id']; ?>" method="post">
                                        <button type="button" class="btn" id="delete" onclick="delete_file('ar',<?= $file['id']; ?>)"><i class="fas fa-trash text-center"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="container carditems">
                    <?php foreach ($currentFiles as $file): ?>
                        <div class="card filesItems">
                            <div class="card-body">
                                <div>
                                    <h1><?= htmlspecialchars($file['file_name']); ?></h1>
                                </div>
                                <hr>
                                <p>الحجم : <?= number_format($file['file_size'] / (1024 * 1024), 2) . "MB"; ?></p>
                                <p> <?= htmlspecialchars($file['upload_date']); ?></p>
                                <p>التحميلات : <?= htmlspecialchars($file['download_count']); ?></p>
                                <hr>
                                <div class="d-flex justify-content-start" style="gap: 5px;">
                                    <a href="fileAr.php?id=<?= $file['id']; ?>&fileid=<?= $file['id']; ?>" class="btn download-btn" id="download"><i class="fas fa-download text-center"></i></a>
                                    <form action="delete_file.php?id=<?= $file['id']; ?>&lang=ar" id="fileForm<?= $file['id']; ?>" method="post">
                                        <button type="button" class="btn" id="delete" onclick="delete_file('ar',<?= $file['id']; ?>)"><i class="fas fa-trash text-center"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="d-flex justify-content-center mt-2 mb-2" dir="ltr">
                    <ul class="pagination">
                        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                            <a href="?page_files=<?= $page - 1 ?>" aria-label="Previous" class="page-link">&laquo;
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                <a href="?page_files=<?= $i ?>" class="page-link"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                            <a href="?page_files=<?= $page + 1 ?>" aria-label="Next" class="page-link">&raquo;</a>
                        </li>
                    </ul>
                </div>
                <div class="container-fluid mb-3">
                    <a type="button" id="button1" class="btn mx-auto" href="uploadAr.php"><i class="fas fa-upload"></i> رفع </a>
                </div>
            </div>
            <div class="p-2 tab-pane fade show" id="reports">
                <h2 class="mt-2 mb-2">بلاغاتي</h2>
                <div>
                    <div class="reportitems">
                        <?php foreach ($currentReps as $rep): ?>
                            <div class="card mt-2 mb-2">
                                <div class="card-body">
                                    <div class="mt-2 mb-2">
                                        <h1>البلاغ المعرف <?= htmlspecialchars($rep['id']); ?></h1>
                                    </div>
                                    <div class="mt-2 mb-2">
                                        <label class="form-label" for="resonReport">سبب البلاغ :</label>
                                        <textarea class="form-control" disabled><?= htmlspecialchars($rep['report_reason']); ?></textarea>
                                    </div>
                                    <div class="mt-2 mb-2">
                                        <label class="form-label" for="useremail">من الايميل :</label>
                                        <input type="text" id="useremail" value="<?= htmlspecialchars($_SESSION['useremail'] ?? $_COOKIE['dx_useremail']); ?>" class="form-control" disabled>
                                    </div>
                                    <div class="mt-2 mb-2">
                                        <p>بتاريخ :<?= htmlspecialchars($rep['report_date']); ?></p>
                                    </div>
                                    <div class="mt-2 mb-2">
                                        <div class="statu d-flex justify-content-center align-items-center"><i id="statuImg" class="fas fa-clock"></i><?= htmlspecialchars($rep['status']); ?></div>
                                    </div>
                                    <div class="mt-2 mb-2">
                                        <i style="color:rgb(160,160,160);">شكرًا لتواصلك! نعمل على تقريرك بعناية.</i>
                                    </div>
                                    <div class="mt-2 mb-2" id="delRep">
                                        <form action="delete_report.php?id=<?= htmlspecialchars($rep['id']); ?>&lang=ar" id="formRep<?= $rep['id']; ?>" method="post">
                                            <a class="text-primary" type="button" onclick="delete_report('ar',<?= $rep['id']; ?>)">حذف البلاغ</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="d-flex justify-content-center mt-2 mb-2" dir="ltr">
                        <ul class="pagination">
                            <li class="page-item <?= $pageRep <= 1 ? 'disabled' : '' ?>">
                                <a href="?page_reps=<?= $pageRep - 1 ?>" aria-label="Previous" class="page-link">&laquo;
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPagesRep; $i++): ?>
                                <li class="page-item <?= $i === $pageRep ? 'active' : '' ?>">
                                    <a href="?page_reps=<?= $i ?>" class="page-link"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?= $pageRep >= $totalPagesRep ? 'disabled' : '' ?>">
                                <a href="?page_reps=<?= $pageRep + 1 ?>" aria-label="Next" class="page-link">&raquo;</a>
                            </li>
                        </ul>
                    </div>
                    <div class="container-fluid mb-3">
                        <a type="button" id="button3" class="btn btn-secondary" href="reports-ar.php"><i class="fas fa-flag"></i> اضافة بلاغ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="statu.js"></script>
    <script src="theme.js"></script>
    <script src="loading.js"></script>
    <script src="rotate-icon.js" defer></script>
    <script src="profile_picture.js"></script>
    <script src="NProgress/nprogress.js"></script>
    <script src="nprogress.js"></script>
    <script src="confirm-alert.js"></script>
    <script src="sweetalert/sweetalert2.min.js"></script>
    <script src="bootstrap-5.3.7-dist/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>