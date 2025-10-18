<?php
include "db.php";
session_start();

$id = $_SESSION['userid'] ?? $_COOKIE['dx_userid'] ?? null;
if ($id) {
    $stm = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stm->bindValue(":id", $id, PDO::PARAM_INT);
    $stm->execute();
    $user = $stm->fetch();
    $img = basename($user['profile_picture']);
}

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1,user-scalable=no">
    <title>ديلوكس أبلود : الموقع الرسمي</title>
    <link rel="icon" type="image/png" href="outils/favicons/1748349885280.PNG">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="deluxeupload.css">
    <link rel="stylesheet" href="fontawesome-free-7.0.0-web/fontawesome-free-7.0.0-web/css/all.min.css">
    <link rel="stylesheet" href="NProgress/nprogress.css">
</head>

<body dir="rtl" lang="ar">
    <div id="loader">
        انتظر لحظة من فضلك يتم تحميل الصفحة
        <div class="spinner-border text-center">
        </div>
    </div>
    <?php if (!empty($_SESSION['cookiemess'])): ?>
        <div class="container mt-2 mb-2 dvAlert">
            <button type="button" id="alertmess" class="alert text-light w-30" data-bs-dismiss="alert">
                <span><?= htmlspecialchars($_SESSION['cookiemess']); ?></span>
                <span class="btn btn-close btnClose"></span>
            </button>
            <?php unset($_SESSION['cookiemess']); ?>
        </div>
    <?php endif; ?>
    <header class="d-flex d-sm-flex d-md-block">
        <nav class="navbar navbar-expand nav1">
            <div class="container-fluid dv1 d-flex">
                <ul class="navbar-nav ms-auto p-0" id="ul2">
                    <li class="nav-item" title="مرحبا بك في ديلوكس أبلود">
                        <a href="#" class="nav-link nav-brand p-0 m-0">
                            <img src="outils/icons/LOGO.png" style="padding: 0%;width: 200px;;height: auto;margin: 0;" id="logo">
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav d-none d-md-flex" id="ul1">
                    <li class="nav-item" title="الثيم"><a href="#" class="nav-link" id="theme" onclick="document.getElementById('changeTheme').click();"><i id="themeIcon" class="fas fa-moon"></i></a></li>
                    <?php if ((isset($_SESSION['useremail'])) || (isset($_COOKIE['dx_useremail']))): ?>
                        <li class="nav-item" title="ارفع من هنا"><a href="#" onclick="upload_ar(true);" id="upload_button" class="nav-link"
                                style="color: rgb(19, 94, 196);"><i class="fas fa-file-upload"></i> رفع</a></li>
                    <?php else: ?>
                        <li class="nav-item" title="ارفع من هنا"><a href="#" onclick="upload_ar(false);" id="upload_button" class="nav-link"
                                style="color: rgb(19, 94, 196);"><i class="fas fa-file-upload"></i> رفع</a></li>
                    <?php endif; ?>
                    <div class="dropdown">
                        <li class="nav-item" title="القائمة">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;" id="dropdownIcon">
                                القائمة <i class="fas fa-chevron-down" id="drpIcon"></i>
                            </a>
                            <ul class="dropdown-menu" id="ul4">
                                <li><a href="dashboard-ar.php" class="dropdown-item" title="لوحة التحكم">لوحة التحكم</a></li>

                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#support"
                                        title="تواصل معنا">تواصل معنا</a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#linkExpiry" title="صلاحية الرابط">اِنتهاء صلاحية الرابط</a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#language"
                                        title="اللغة">لغة الموقع</a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#maxFile"
                                        title="الحجم الأقصى المسموح به">الحجم الأقصى المسموح
                                        بها للملف</a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cookies"
                                        title="كوكيز">الكوكيز</a></li>
                                <li><a href="#" class="dropdown-item" title="QR Code" data-bs-target="#qrcode" data-bs-toggle="modal">كود qr</a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#account"
                                        title="حسابي">حسابي</a></li>
                            </ul>
                        </li>
                    </div>
                    <?php if (isset($_SESSION['useremail'])): ?>
                        <li class="nav-item">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#account">
                                <img src="<?= !empty($img) ? 'profile_picture/' . htmlspecialchars($img) : 'outils/icons/useracc2.png' ?>" id="imgAcc" width="40px" height="auto">
                            </a>
                        </li>
                    <?php elseif (isset($_COOKIE['dx_useremail'])): ?>
                        <li class="nav-item">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#account">
                                <img src="<?= !empty($img) ? 'profile_picture/' . htmlspecialchars($img) : 'outils/icons/useracc2.png' ?>" id="imgAcc" width="40px" height="auto">
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item" title="تسجيل الدخول"><a href="login.php" class="nav-link" id="login">تسجيل الدخول</a></li>
                        <li class="nav-item" title="انشاء حساب" id="signup"><a href="sign-up.php" class="nav-link">اِنشاء
                                الحساب</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <div class="modal fade" id="theme" aria-hidden="true" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1>الثيم</h1>
                            </div>
                            <div class="modal-body">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="changeTheme"> Click
                                    لتغيير الثيم
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <!-- <div>
                                    <a href="#">
                                        <img src="outils/icons/icons sc/whatsapp.png" width="100px" height="auto"
                                            alt="whatsapp">
                                    </a>
                                    <p>@واتساب</p>
                                </div> -->
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
                <div class="modal fade" id="qrcode">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1>Qr كود</h1>
                            </div>
                            <div class="modal-body">
                                <p>تمكن هذه الخاصية المستخدم من إنشاء رمز QR فريد لكل ملف يتم رفعه على المنصة، بحيث يمكن مسح هذا الرمز بواسطة الهواتف الذكية أو الأجهزة اللوحية للوصول مباشرة إلى الملف أو تحميله دون الحاجة إلى إدخال الرابط يدويًا. هذا يسهل مشاركة الملفات بين المستخدمين بسرعة وأمان، ويدعم الاستخدام العملي سواء في الطباعة، العروض، أو التوزيع الرقمي.</p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="maxFile">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1>الحجم الأقصى المسموح بها للملف</h1>
                            </div>
                            <div class="modal-body">
                                <p>لضمان تحميل سريع وآمن لجميع المستخدمين، يجب ألا يتجاوز كل ملف تُحمّله
                                    الحد الأقصى المسموح به:

                                    الحد الأقصى لحجم الملف: 100 ميجابايت (عدّل هذه القيمة بما يتناسب مع حدك
                                    الفعلي).

                                    إذا كان حجم ملفك أكبر من الحجم المسموح به، يُرجى ضغطه أو تقسيمه إلى
                                    أجزاء أصغر قبل تحميله.</p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="linkExpiry">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1>
                                    عن اِنتهاء صلاحية الرابط
                                </h1>
                            </div>
                            <div class="modal-body">
                                <p>تضيف الروابط منتهية الصلاحية طبقة إضافية من الخصوصية والتحكم إلى مشاركة
                                    ملفاتك. عند تفعيل هذه الميزة، سيتم إنشاء رابط تنزيل فريد، ويصبح غير نشط
                                    تلقائيًا بعد فترة زمنية محددة (مثل ساعة واحدة، 24 ساعة، إلخ).

                                    يساعدك هذا على:

                                    تقييد الوصول غير المصرح به إلى ملفاتك

                                    منع التعرض طويل الأمد للمحتوى الحساس

                                    التحكم في وقت وكيفية تنزيل ملفاتك

                                    بمجرد انتهاء صلاحية الرابط، لن تتمكن من الوصول إلى الملف من خلال عنوان
                                    URL هذا.</p>
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
                                <a href="cookies.php?lang=ar" type="button" class="btn" id="accept">قبول</a>
                            </div>
                            <div class="modal-footer">
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="language">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1>لغة الموقع</h1>
                            </div>
                            <div class="modal-body" style="direction: ltr;">
                                <label for="languages">اللغة</label>
                                <select class="form-select" id="languages" onchange="changeLanguage(this.value);">
                                    <option value="English">الاِنجليزية</option>
                                    <option value="Arabic" selected>العربية</option>
                                    <option value="French">الفرنسية</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="account">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1>لوحة التحكم</h1>
                            </div>
                            <?php if (isset($_SESSION['username'], $_SESSION['useremail'])): ?>
                                <div class="container d-flex justify-content-center mt-2 mb-2">
                                    <img src="<?= !empty($img) ? 'profile_picture/' . htmlspecialchars($img) : 'outils/icons/useracc2.png' ?>" width="80px" height="auto" id="imgAcc" alt="<?= $_SESSION['username']; ?>">
                                </div>
                            <?php elseif (isset($_COOKIE['dx_username'], $_COOKIE['dx_useremail'])): ?>
                                <div class="container d-flex justify-content-center mt-2 mb-2">
                                    <img src="<?= !empty($img) ? 'profile_picture/' . htmlspecialchars($img) : 'outils/icons/useracc2.png' ?>" width="80px" height="auto" id="imgAcc" alt="<?= $_COOKIE['dx_username']; ?>">
                                </div>
                            <?php else: ?>
                                <div></div>
                            <?php endif; ?>
                            <div class="modal-body">
                                <table class="table p-0">
                                    <?php if (isset($_SESSION['username'], $_SESSION['useremail'])): ?>
                                        <p>مرحبا <?php echo htmlspecialchars($_SESSION['username']) . "✨"; ?></p>
                                        <tr>
                                            <td>الاسم</td>
                                            <td><?php echo htmlspecialchars($_SESSION['username']);  ?></td>
                                        </tr>
                                        <tr>
                                            <td>البريد الالكتروني</td>
                                            <td><?php echo htmlspecialchars($_SESSION['useremail']);  ?></td>
                                        </tr>
                                        <tr>
                                            <td>تعديل معلوماتي</td>
                                            <td><a href="edit-ar.php?id=<?= htmlspecialchars($_SESSION['userid']); ?>" id="edit">تعديل <i class="fas fa-pencil"></i> </a></td>
                                        </tr>
                                        <tr>
                                            <td>تسجبل الخروج</td>
                                            <td><a href="logout.php?id=<?= htmlspecialchars($_SESSION['userid']); ?>" id="delete"><i class="fas fa-sign-out-alt"></i>تسجيل الخروج</a></td>
                                        </tr>
                                    <?php elseif (isset($_COOKIE['dx_username'], $_COOKIE['dx_useremail'])): ?>
                                        <p>مرحبا <?php echo htmlspecialchars($_COOKIE['dx_username']) . "✨"; ?></p>
                                        <tr>
                                            <td>الاسم</td>
                                            <td><?php echo htmlspecialchars($_COOKIE['dx_username']);  ?></td>
                                        </tr>
                                        <tr>
                                            <td>البريد الالكتروني</td>
                                            <td><?php echo htmlspecialchars($_COOKIE['dx_useremail']);  ?></td>
                                        </tr>
                                        <tr>
                                            <td>تعديل معلوماتي</td>
                                            <td><a href="edit-ar.php?id=<?= htmlspecialchars($_COOKIE['dx_userid']); ?>" id="edit"><i class="fas fa-pencil"></i> تعديل</a></td>
                                        </tr>
                                        <tr>
                                            <td>تسجبل الخروج</td>
                                            <td><a href="logout.php?id=<?= htmlspecialchars($_COOKIE['dx_userid']); ?>" id="delete"><i class="fas fa-sign-out-alt"></i>الخروج</a></td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td>أنت غير مسجل سجل من هنا.<a style="color: white;" href="sign-up.php">تسجبل الدخول</a></td>
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
            </div>
        </nav>
        <button type="button" class="btn d-md-none me-auto" data-bs-toggle="offcanvas" data-bs-target="#sldDu"
            aria-controls="sldDu" id="btnOffcnv">
            <img src="outils/icons/offcanvas-icon.png" width="40px" height="auto" id="imgOffcnv">
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="sldDu"
            aria-labelledby="sldDu">
            <div class="offcanvas-header">
                <img src="outils/icons/LOGO.png" alt="logo" width="250px" height="auto"
                    title="مرحبا بك في ديلوكس أبلود" id="logo">
                <img src="<?= !empty($img) ? 'profile_picture/' . htmlspecialchars($img) : 'outils/icons/useracc2.png' ?>" alt="logo" width="40px" height="auto" id="imgAcc"
                    title="حسابي" data-bs-toggle="modal" data-bs-target="#account">
            </div>
            <div class="container-fluid d-flex align-items-center gap-2">
                <button type="button" class="btn w-50" title="اضغط لتغيير الثيم" id="themeBtn" onclick="document.getElementById('changeTheme').click();"><i id="themeIcon" class="fas fa-moon"></i></button>
                <button id="btnClose" type="button" class="btn mt-2 mb-2 w-50 text-reset" data-bs-dismiss="offcanvas" aria-label="Close">اخفاء القائمة</button>
            </div>
            <div class="offcanvas-body p-0">
                <div class="list-group dvLST">
                    <a href="dashboard-ar.php" class="list-group-item list-group-item-action" title="لوحة التحكم">
                        <i class="fas fa-solid fa-gauge"></i> لوحة التحكم
                    </a>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action" title="الدعم"
                        onclick="setTimeout(() => { bootstrap.Modal.getOrCreateInstance(document.getElementById('support')).show(); }, 300);" data-bs-dismiss="offcanvas">
                        <i class="fas fa-headset"></i> تواصل معنا
                    </a>
                    <a href="#" class="list-group-item list-group-item-action"
                        title="الحجم الأقصى المسموح به" onclick="setTimeout(() => { bootstrap.Modal.getOrCreateInstance(document.getElementById('maxFile')).show(); }, 300);" data-bs-dismiss="offcanvas">
                        <i class="fas fa-weight-scale"></i> الحجم الأقصى المسموح بها للملف
                    </a>

                    <a href="#" class="list-group-item list-group-item-action" title="صلاحية الرابط"
                        onclick="setTimeout(() => { bootstrap.Modal.getOrCreateInstance(document.getElementById('linkExpiry')).show(); }, 300);" data-bs-dismiss="offcanvas">
                        <i class="fas fa-clock"></i> اِنتهاء صلاحية الرابط
                    </a>
                    <a href="#" class="list-group-item list-group-item-action" title="اللغة"
                        onclick="setTimeout(() => { bootstrap.Modal.getOrCreateInstance(document.getElementById('language')).show(); }, 300);" data-bs-dismiss="offcanvas">
                        <i class="fas fa-language"></i> لغة الموقع
                    </a>
                    <a href="#" class="list-group-item list-group-item-action" title="كوكيز" onclick="setTimeout(() => { bootstrap.Modal.getOrCreateInstance(document.getElementById('cookies')).show(); }, 300);" data-bs-dismiss="offcanvas"><i class="fas fa-cookie-bite"></i> كوكيز</a>
                    <a href="#" class="list-group-item list-group-item-action" title="QR كود" onclick="setTimeout(() => { bootstrap.Modal.getOrCreateInstance(document.getElementById('qrcode')).show(); }, 300);" data-bs-dismiss="offcanvas">
                        <i class="fas fa-qrcode"></i> كود QR
                    </a>
                    <?php if (isset($_SESSION['useremail']) || isset($_COOKIE['dx_useremail'])): ?>
                        <a href="#" onclick="setTimeout(() => { bootstrap.Modal.getOrCreateInstance(document.getElementById('account')).show(); }, 300);" data-bs-dismiss="offcanvas" class="list-group-item list-group-item-action"> <i class="fas fa-user"></i> الحساب</a>
                        <a href="logout.php" class="list-group-item list-group-item-action" style="color: red;"
                            title="تسجبل الخروج" id="logout">
                            <i class="fas fa-sign-out-alt"></i>
                            تسجيل الخروج
                        </a>
                        <a href="sign-up" class="list-group-item list-group-item-action">اِ<i class="fas fa-user-plus"></i> نشاء حساب جديد
                        </a>
                    <?php else: ?>
                        <button onclick="login();" type="button" class="btn" id="cnvBtn1"
                            title="تسجيل الدخول">تسجيل الدخول</button>
                        <button onclick="signUp();" type="button" class="btn" id="cnvBtn2"
                            title="انشاء حساب">اِنشاء حساب</button>
                    <?php endif; ?>
                </div>
            </div>
            <div class="offcanvas-footer">
                <div class="pCop text-center mb-2" style="direction: ltr;">
                    <p id="copyrightTextAr">&copy;</p>
                </div>
            </div>
        </div>
    </header>
    <div class="dv8 p-2">
        <div class="dv8-1 mb-2">
            <button class="btn p-0" style="outline: none !important;box-shadow:none !important;" onclick="scrollToTop()">
                <img src="outils/svg/arrow_upward.svg" id="arrow">
            </button>
        </div>
        <!-- <div class="dv8-2">
            <button class="btn p-0" style="outline: none !important;box-shadow:none !important;" data-bs-toggle="modal" data-bs-target="#cockies">
                <img src="outils/icons/material-symbols--cookie-outline.svg">
            </button>
        </div> -->
    </div>
    <div class="container-fluid dv2" id="background">
        <div>
            <h1 style="font-weight: bold;">مرحبا بك <strong style="font-weight: bold;"><mark style="color: white;">ديلوكس أبلود</mark></strong>
            </h1>
            <p class="mt-2" style="font-weight: bold;text-align:center;" id="quote">اِرفع أي ملف , في أي وقت , في أي مكان :)</p>
            <?php if (isset($_SESSION['useremail']) || isset($_COOKIE['dx_useremail'])): ?>
                <button type="button" id="uploadButton" onclick="upload_ar(true);" class="btn" title="إضغط لرفع الملفات">رفع <i id="element" class=""></i></button>
            <?php else: ?>
                <button type="button" id="uploadButton" onclick="upload_ar(false);" class="btn" title="إضغط لرفع الملفات">رفع <i id="element" class=""></i></button>
            <?php endif; ?>
        </div>
    </div>
    <div data-bs-spy="scroll" data-bs-target=".nav2" data-bs-offset="50">
        <nav class="navbar navbar-expand mt-0 nav2 sticky-top" id="nav2">
            <div class="container-fluid">
                <ul class="navbar-nav mx-auto" id="ul3">
                    <li class="nav-item"><a id="#du" onmouseover="navbarHover()" onmouseout="navbarOut()" href="#du" class="nav-link">ديلوكس أبلود</a>
                    </li>
                    <li class="nav-item"><a id="#about" onmouseover="navbarHover()" onmouseout="navbarOut()" href="#about" class="nav-link">عنا</a></li>
                    <li class="nav-item"><a href="#features" onmouseover="navbarHover()" onmouseout="navbarOut()" class="nav-link">المميزات</a>
                    </li>
                    <li class="nav-item"><a href="#security" onmouseover="navbarHover()" onmouseout="navbarOut()" class="nav-link">الآمان</a></li>
                    <li class="nav-item"><a href="#faq" onmouseover="navbarHover()" onmouseout="navbarOut()" class="nav-link">الأسئلة الشائعة</a></li>
                    <li class="nav-item"><a href="#contactus" onmouseover="navbarHover()" onmouseout="navbarOut()" class="nav-link">تواصل معنا</a></li>
                </ul>
            </div>
        </nav>


        <div class="container mt-5 mb-5 dv3">
            <h1 style="text-align: center;" class="mb-2" id="du">مرحبا بك في ديلوكس أبلود</h1>
            <p class="mt-3">
                ديلوكس أبلود منصة بسيطة وسريعة وسهلة الاستخدام، مصممة لتحميل الملفات ومشاركتها. هدفنا هو توفير تجربة سلسة
                بدون إعلانات، وبدون خطوات غير ضرورية، وبدون أي متاعب. سواء كنت تشارك مستندات مهمة، أو ملفات كبيرة، أو وسائط،
                فإن ديلوكس أبلود يُسهّل عليك تحميل ملفاتك ومشاركتها بسرعة وأمان.

                بفضل تصميمنا المُركّز على المستخدم، يمكنك تحميل الملفات دون القلق بشأن العمليات المعقدة أو الانقطاعات
                المُزعجة. نوفر سرعات تحميل عالية، واستضافة موثوقة، وواجهة استخدام سهلة الاستخدام تضمن لك إدارة ملفاتك
                بسهولة. سواء كنت شركة، أو طالبًا، أو شخصًا يحتاج فقط إلى مشاركة ملف، فإن ديلوكس أبلود هنا لتقديم أفضل خدمة
                لك.
            </p>
        </div>


        <div class="container mt-5 mb-5 dv3">
            <h1 style="text-align: center;" class="mb-2" id="about">عنا</h1>
            <p class="mt-3">ديلوكس أبلود هو حل مُبسّط لمشاركة الملفات، مُصمّم لضمان الأداء والموثوقية. نُمكّن المستخدمين من
                تحميل الملفات وإدارتها وتوزيعها بثقة عبر منصة آمنة تُركّز على المستخدم. ينصب تركيزنا على تقديم تجربة سلسة
                تُلبّي الاحتياجات الشخصية والمهنية على حدّ سواء.
            </p>
            <p>بدون الحاجة إلى التسجيل، يمكن للمستخدمين بدء مشاركة الملفات فورًا. يدعم ديلوكس أبلود خيارات التخزين المؤقت
                والطويل الأجل، متكيفًا مع احتياجاتك الفريدة. بنيتنا التحتية مصممة مع مراعاة الخصوصية والسرعة، لتتمكن من
                التركيز على ما يهمك، بينما نتولى الباقي.</p>
        </div>

        <div class="container mt-3 mb-3">
            <h1 style="text-align: center;" class="mb-2" id="features">المميزات</h1>
        </div>
        <div class="container-fluid mt-2 dv4">
            <div id="dv4-1" class="mt-3 mb-3">
                <img src="outils/backgrounds/9731567.jpg" width="320px" height="auto" alt="img1" class="mb-3">
                <div class="p-3">
                    <h3>السرعة و تحميل آمن</h3>
                    <p>استمتع بعمليات تحميل عالية السرعة مع الأمان المتقدم الذي يحافظ على أمان ملفاتك في جميع الأوقات.</p>
                </div>
            </div>
            <div id="dv4-1" class="mt-3 mb-3">
                <img src="outils/backgrounds/4650.jpg" width="320px" height="auto" alt="img2" class="mb-3">
                <div class="p-3">
                    <h3>واجهة بسيطة ونظيفة</h3>
                    <p>تصميم بديهي وسهل الاستخدام يجعل تحميل الملفات سهلاً بنقرة واحدة.</p>
                </div>
            </div>
            <div id="dv4-1" class="mt-3 mb-3">
                <img src="outils/backgrounds/6306476.jpg" width="320px" height="auto" alt="img1" class="mb-3">
                <div class="p-3">
                    <h3>روابط مباشرة - بدون إعلانات</h3>
                    <p>انتقل مباشرة إلى ملفاتك باستخدام روابط تنزيل نظيفة وخالية من الإعلانات. لا نوافذ منبثقة، ولا تأخير.</p>
                </div>
            </div>
            <div id="dv4-1" class="mt-3 mb-3">
                <img src="outils/backgrounds/social-clouds.jpg" width="320px" height="320px" alt="img1" class="mb-3">
                <div class="p-3">
                    <h3>وقت تخزين غير محدود</h3>
                    <p>تظل ملفاتك متاحة عبر الإنترنت طالما أردت ذلك - لا يوجد حذف تلقائي أو حدود زمنية.</p>
                </div>
            </div>
        </div>

        <div class="container mt-3 mb-3">
            <h1 style="text-align: center;" class="mb-2" id="security">الآمان</h1>
        </div>
        <div class="container mt-3 mb-3 dv3" dir="ltr">
            <p>في ديلوكس أبلود نولي أهمية بالغة لأمن ملفاتك. نطبق طبقات حماية متعددة لضمان خصوصيتك، بما في ذلك:

                تشفير الملفات أثناء التحميل والتخزين لمنع الوصول غير المصرح به.
            </p>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between">روابط تنزيل مؤقتة تنتهي صلاحيتها تلقائيًا بعد
                    فترة زمنية محددة.
                    <span class="badge"><img src="outils/svg/icons8-success.svg" alt="success" width="20px"
                            height="auto"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between">خصوصية كاملة: لا تتم فهرسة ملفاتك بواسطة محركات
                    البحث ولا تكون مرئية للعامة.
                    <span class="badge"><img src="outils/svg/icons8-success.svg" alt="success" width="20px"
                            height="auto"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between">فحص الملفات للتأكد من أن التحميلات آمنة وخالية من
                    المحتوى الضار.
                    <span class="badge"><img src="outils/svg/icons8-success.svg" alt="success" width="20px"
                            height="auto"></span>
                </li>
            </ul>
        </div>

        <div class="container mt-3 mb-3">
            <h1 style="text-align: center;" class="mb-2" id="faq">الأسئلة الشائعة</h1>
        </div>
        <div class="container mt-3 mb-3">
            <div class="accordion" id="fqAcc">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="hd1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#clpOne"
                            aria-expanded="true" aria-controls="clpOne">ما هو الحد الأقصى لحجم الملف المسموح به؟</button>
                    </h2>
                    <div id="clpOne" class="accordion-collapse collapse" aria-labelledby="hd1" data-bs-parent="#fqAcc">
                        <div class="accordion-body">
                            يمكنك تحميل ملفات يصل حجمها إلى ٢ جيجابايت باستخدام الإصدار المجاني. أما بالنسبة للملفات الأكبر
                            حجمًا، فيمكنك الترقية إلى باقة مميزة لاحقًا.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="hd2">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#clpTwo"
                            aria-expanded="true" aria-controls="clpTwo">هل يمكنني تحميل ملفات خاصة لا يمكن لأي شخص آخر
                            رؤيتها؟</button>
                    </h2>
                    <div id="clpTwo" class="accordion-collapse collapse" aria-labelledby="hd2" data-bs-parent="#fqAcc">
                        <div class="accordion-body">
                            نعم، يمكنك تحديد خيار "خاص" أثناء التحميل لضمان وصول الملف فقط إلى الأشخاص الذين لديهم الرابط
                            المباشر.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="hd3">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#clpTree"
                            aria-expanded="true" aria-controls="clpTree">ما هي المدة التي يتم تخزين الملفات فيها على
                            الخادم؟</button>
                    </h2>
                    <div id="clpTree" class="accordion-collapse collapse" aria-labelledby="hd3" data-bs-parent="#fqAcc">
                        <div class="accordion-body">
                            تُخزَّن الملفات لمدة ٧ أيام من تاريخ التحميل. بعد ذلك، تُحذف تلقائيًا للحفاظ على الأمان وكفاءة
                            التخزين.
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container mt-3 mb-3">
            <h1 style="text-align: center;" class="mb-2" id="contactus">تواصل معنا</h1>
        </div>
        <div class="container mt-3 mb-3 dv5">
            <div>
                <a href="https://github.com/abderrahim1210">
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
                <a href="https://x.com/DeluxeUpload">
                    <img src="outils/icons/x.png" width="100px" height="auto" alt="x">
                </a>
                <p>@اكس</p>
            </div>
            <div>
                <a href="https://www.youtube.com/channel/UC8ZYkfXuTlHV69Ljn84VwGg">
                    <img src="outils/icons/icons sc/youtube.png" width="100px" height="auto" alt="youtube">
                </a>
                <p>@يوتيوب</p>
            </div>
            <!-- <div>
                <a href="#">
                    <img src="outils/icons/icons sc/whatsapp.png" width="100px" height="auto" alt="whatsapp">
                </a>
                <p>@واتساب</p>
            </div> -->
            <div>
                <a href="#">
                    <img src="outils/icons/icons sc/gmail.png" width="100px" height="auto" alt="gmail">
                </a>
                <p>@جيمايل</p>
            </div>
            <div>
                <a href="#">
                    <img src="outils/icons/icons sc/instagram.png" width="100px" height="auto" alt="instagram">
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
        <div class="container mt-3 mb-3">
            <div class="fileManagement">
                <img src="outils/backgrounds/Organisation des fichiers numériques.png" class="img-fluid float-start m-0" alt="">
                <div id="fileManagement-1">
                    <div>
                        <h1 class="fw-bold">إدارة الملفات</h1>
                        <p>حافظ على تنظيمك وتحكمك - أعد تسمية ملفاتك المحمّلة، أو شاركها، أو احذفها في أي وقت من لوحة التحكم الشخصية.

                            يوفر لك ديلوكس أبلود أدوات فعّالة لإدارة بياناتك بأمان وكفاءة.</p>
                        <button type="button" onclick="window.open('dashboard.php','_self')" class="btn">تجربة</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark mt-5 p-2">
        <div class="container-fluid mt-2 mb-2 mx-auto dvFot" style="direction: ltr;">
            <ul class="nav d-flex justify-content-center nvFot">
                <li class="nav-item">
                    <a href="deluxeupload.php" class="nav-link active">الاِنجليزية</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">العربية</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">الفرنسية</a>
                </li>
            </ul>
        </div>
        <p class="text-center"><mark id="p-arFot"><!-- أي ملف هو بداية لك.<i class="fas fa-heart"></i> --></mark></p>
        <div class="container-fluid mt-3 dvFin" style="direction: ltr;">
            <ul class="nav d-flex navFin justify-content-center">
                <li class="nav-item">
                    <a href="privacy.html" class="nav-link active">سياسة الخصوصية</a>
                </li>
                <li class="nav-item">
                    <a href="terms.html" class="nav-link">شروط الاستخدام</a>
                </li>
            </ul>
            <div class="pCop mb-2">
                <p id="copyrightTextAr" style="direction: ltr;">&copy;</p>
            </div>
        </div>
    </footer>
    <div class="container-fluid" dir="ltr">
        <nav class="navbar navbar-expand fixed-bottom nav6" role="tablist">
            <ul class="navbar-nav" id="ul6">
                <li class="nav-item"><a href="#" data-bs-target="#account" data-bs-toggle="modal" class="nav-link"><i class="fas fa-user"></i> حسابي</a></li>
                <li class="nav-item"><a href="uploadAr.php" class="nav-link"><i class="fas fa-file-upload"></i> رفع</a></li>
                <li class="nav-item"><a href="dashboard-ar.php" class="nav-link"><i class="fas fa-folder"></i> لوحة التحكم</a></li>
            </ul>
        </nav>
    </div>

    <script src="change-background.js"></script>
    <script src="theme-ar.js"></script>
    <script src="transfer.js" defer></script>
    <script src="quotes-ar.js"></script>
    <script src="rotate-icon.js" defer></script>
    <script src="lang.js"></script>
    <script src="loading.js" defer></script>
    <script src="copyright.js"></script>
    <script src="NProgress/nprogress.js"></script>
    <script src="nprogress.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>