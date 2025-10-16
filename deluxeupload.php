<?php
include "db.php";
session_start();

$id = $_SESSION['userid'] ?? $_COOKIE['dx_userid'] ?? null;
$stm = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stm->bindValue(":id", $id, PDO::PARAM_INT);
$stm->execute();
$user = $stm->fetch();

$img = basename($user['profile_picture'] ?? null);
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1,user-scalable=no">
    <title>Deluxe Upload Official Website</title>
    <link rel="icon" type="image/png" href="outils/favicons/1748349885280.PNG">
    <link rel="stylesheet" href="bootstrap-5.3.7-dist/bootstrap-5.3.7-dist/css/bootstrap.min.css">
    <script src="Jquery File/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="deluxeupload.css">
    <link rel="stylesheet" href="fontawesome-free-7.0.0-web/fontawesome-free-7.0.0-web/css/all.min.css">
    <link rel="stylesheet" href="NProgress/nprogress.css">
</head>

<body lang="en">
    <div id="loader">
        Wait a seconds for load
        <div class="spinner-border text-center">
        </div>
    </div>
    <div>
        <?php if (isset($_SESSION['editmess'])): ?>
            <div class="container-fluid w-100 p-0 alert alert-primary text-light">
                <?php
                echo $_SESSION['editmess'];
                session_unset($_SESSION['editmess']);
                ?>
                <span class="btn btn-close"></span>
            </div>
        <?php endif; ?>
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
            <div class="container-fluid dv1">
                <ul class="navbar-nav d-flex me-auto" id="ul2">
                    <li class="nav-item" title="Welcome to DeluxeUpload">
                        <a style="cursor: pointer;" onclick="return location.reload();" class="nav-link nav-brand p-0 m-0">
                            <img src="outils/icons/LOGO.png" style="padding: 0%;width: 200px;;height: auto;margin: 0;" id="logo">
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav d-none d-md-flex" id="ul1">
                    <li class="nav-item" title="Theme"><a href="#" class="nav-link" id="theme" onclick="document.getElementById('changeTheme').click();"><i id="themeIcon" class="fas fa-moon"></i></a></li>
                    <input type="checkbox" style="display: none;" class="form-check-input" id="changeTheme">
                    <?php if ((isset($_SESSION['useremail'])) || (isset($_COOKIE['dx_useremail']))): ?>
                        <li class="nav-item" title="Upload here"><a href="#" id="upload_button" onclick="upload(true);" class="nav-link"><i class="fas fa-file-upload"></i> Upload</a></li>
                    <?php else: ?>
                        <li class="nav-item" title="Upload here"><a href="#" id="upload_button" onclick="upload(false);" class="nav-link"><i class="fas fa-file-upload"></i> Upload</a></li>
                    <?php endif; ?>
                    <div class="dropdown">
                        <li class="nav-item" title="Menu">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;" id="dropdownIcon">
                                Menu <i class="fas fa-chevron-down" id="drpIcon"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" id="ul4">
                                <li><a href="dashboard.php" class="dropdown-item" title="Dashboard">dashboard</a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#support" title="Support / Contact us">support /contact
                                        us</a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#linkExpiry" title="Link Expiry">link expiry</a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#language" title="Site Language">Site Language</a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#maxFile" title="Max File Size Allowed">max file size
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cookies" title="Cookies">Cookies</a></li>
                                <li><a href="#" class="dropdown-item" title="QR Code" data-bs-toggle="modal" data-bs-target="#qrcode">qr code</a></li>
                                <li><a href="#" data-bs-toggle="modal" data-bs-target="#account" class="dropdown-item" title="My Account">account</a></li>
                            </ul>
                        </li>
                    </div>
                    <?php if (isset($_SESSION['useremail'])): ?>
                        <li class="nav-item">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#account">
                                <img src="<?= !empty($img) ? 'profile_picture/' . htmlspecialchars($img) : 'outils/icons/useracc2.png' ?>" id="imgAcc" alt="Profile Picture">
                            </a>
                        </li>
                    <?php elseif (isset($_COOKIE['dx_username'], $_COOKIE['dx_useremail'])): ?>
                        <li class="nav-item">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#account">
                                <img src="<?= !empty($img) ? 'profile_picture/' . htmlspecialchars($img) : 'outils/icons/useracc2.png' ?>" id="imgAcc" alt="Profile Picture">
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item" title="Login"><a href="login.php" class="nav-link" id="login">Login</a></li>
                        <li class="nav-item" title="Sign Up" id="signup"><a href="sign-up.php" class="nav-link">SignUp</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="modal fade" id="support">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1>Contact Us</h1>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <a href="#">
                                        <img src="outils/icons/github.png" width="100px" height="auto"
                                            alt="github">
                                    </a>
                                    <p>@github</p>
                                </div>
                                <div>
                                    <a href="#">
                                        <img src="outils/icons/fb.png" width="100px" height="auto"
                                            alt="facebook">
                                    </a>
                                    <p>@facebook</p>
                                </div>
                                <div>
                                    <a href="#">
                                        <img src="outils/icons/telegram.png" width="100px" height="auto"
                                            alt="telegram">
                                    </a>
                                    <p>@telegram</p>
                                </div>
                                <div>
                                    <a href="https://x.com/DeluxeUpload">
                                        <img src="outils/icons/x.png" width="100px" height="auto" alt="x">
                                    </a>
                                    <p>@x</p>
                                </div>
                                <div>
                                    <a href="https://www.youtube.com/channel/UC8ZYkfXuTlHV69Ljn84VwGg">
                                        <img src="outils/icons/icons sc/youtube.png" width="100px"
                                            height="auto" alt="youtube">
                                    </a>
                                    <p>@youtube</p>
                                </div>
                                <div>
                                    <a href="#">
                                        <img src="outils/icons/icons sc/whatsapp.png" width="100px"
                                            height="auto" alt="whatsapp">
                                    </a>
                                    <p>@whatsapp</p>
                                </div>
                                <div>
                                    <a href="mailto:deluxeupload@gmail.com">
                                        <img src="outils/icons/icons sc/gmail.png" width="100px"
                                            height="auto" alt="gmail">
                                    </a>
                                    <p>@gmail</p>
                                </div>
                                <div>
                                    <a href="#">
                                        <img src="outils/icons/icons sc/instagram.png" width="100px"
                                            height="auto" alt="instagram">
                                    </a>
                                    <p>@instagram</p>
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
                <div class="modal fade" id="maxFile">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1>Maximum File Size Allowed</h1>
                            </div>
                            <div class="modal-body">
                                <p>To ensure fast and secure uploads for all users, each file you upload
                                    must not exceed the maximum allowed size:

                                    Maximum file size: 100 MB (adjust this value to your actual limit)

                                    If your file is larger than the allowed size, please consider
                                    compressing it or splitting it into smaller parts before uploading.</p>
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
                                <h1>Qr Code</h1>
                            </div>
                            <div class="modal-body">
                                <p>This feature allows users to generate a unique QR code for every uploaded file. By scanning the code with a smartphone or tablet, users can instantly access or download the file without manually typing the link. It simplifies file sharing, enhances accessibility, and is especially useful for printing, presentations, or quick digital distribution.</p>
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
                                <h1>About Link Expiry</h1>
                            </div>
                            <div class="modal-body">
                                <p>Expiring links add an extra layer of privacy and control to your file
                                    sharing. When you enable this feature, a unique download link will be
                                    generated that automatically becomes inactive after a set period of time
                                    (e.g., 1 hour, 24 hours, etc.).

                                    This helps you:

                                    Limit unauthorized access to your files

                                    Prevent long-term exposure of sensitive content

                                    Control when and how your files can be downloaded


                                    Once the link expires, the file will no longer be accessible
                                    through that URL.</p>
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
                                <h1>Site Language</h1>
                            </div>
                            <div class="modal-body">
                                <label for="selectLan">Language</label>
                                <select class="form-select" id="selectLan" onchange="changeLanguage(this.value);">
                                    <option id="opt" value="English" selected>English</option>
                                    <option id="opt" value="Arabic">Arabic</option>
                                    <option id="opt" value="French">French</option>
                                </select>
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
                                    Cookies Notice
                                </h1>
                            </div>
                            <div class="modal-body">
                                <p>We use cookies to enhance your experience on Deluxe Upload. By continuing to browse, you agree to our use of cookies.</p>
                                <a href="cookies.php?lang=en" type="button" class="btn" id="accept">Accept</a>
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
                                <h1>Dasheboard</h1>
                            </div>
                            <?php if (isset($_SESSION['username'], $_SESSION['useremail'])): ?>
                                <div class="container d-flex justify-content-center mt-2 mb-2">
                                    <img src="<?= !empty($img) ? 'profile_picture/' . htmlspecialchars($img) : 'outils/icons/useracc2.png' ?>"
                                        width="80px" height="80px" id="imgAcc" alt="Profile Picture">
                                </div>
                            <?php elseif (isset($_COOKIE['dx_username'], $_COOKIE['dx_useremail'])): ?>
                                <div class="container d-flex justify-content-center mt-2 mb-2">
                                    <img src="<?= !empty($img) ? 'profile_picture/' . htmlspecialchars($img) : 'outils/icons/useracc2.png' ?>"
                                        width="80px" height="80px" id="imgAcc" alt="<?= $_COOKIE['dx_userid']; ?>">
                                </div>
                            <?php else: ?>
                                <div></div>
                            <?php endif; ?>
                            <div class="modal-body">
                                <table class="table p-0">
                                    <?php if (isset($_SESSION['username'], $_SESSION['useremail'])): ?>
                                        <p>Welcome <?= htmlspecialchars($_SESSION['username']) . "✨"; ?></p>
                                        <tr>
                                            <td>Name</td>
                                            <td><?= htmlspecialchars($_SESSION['username']);  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?= htmlspecialchars($_SESSION['useremail']);  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Edit</td>
                                            <td><a href="edit.php?id=<?php echo htmlspecialchars($_SESSION['userid']); ?>" id="edit"><i class="fas fa-pencil"></i> Edit</a></td>
                                        </tr>
                                        <tr>
                                            <td>Logout</td>
                                            <td><a href="logout.php?id=<?php echo htmlspecialchars($_SESSION['userid']); ?>" id="delete"><i class="fas fa-sign-out-alt"></i> Logout</a></td>
                                        </tr>
                                    <?php elseif (isset($_COOKIE['dx_username'], $_COOKIE['dx_useremail'])): ?>
                                        <p>Welcome <?= htmlspecialchars($_COOKIE['dx_username']) . "✨"; ?></p>
                                        <tr>
                                            <td>Name</td>
                                            <td><?= htmlspecialchars($_COOKIE['dx_username']);  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?= htmlspecialchars($_COOKIE['dx_useremail']);  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Edit</td>
                                            <td><a href="edit.php?id=<?= htmlspecialchars($_COOKIE['dx_userid']); ?>" id="edit"><i class="fas fa-pencil"></i> Edit</a></td>
                                        </tr>
                                        <tr>
                                            <td>Logout</td>
                                            <td><a href="logout.php?id=<?= htmlspecialchars($_COOKIE['dx_userid']); ?>" id="delete"><i class="fas fa-sign-out-alt"></i> Logout</a></td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="2">You are not logged in. <a href="sign-up.php">Sign up here</a> or <a href="login.php">Login</a></td>
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
        <button type="button" class="btn d-md-none ms-auto" data-bs-toggle="offcanvas" data-bs-target="#sldDu"
            id="btnOffcnv" aria-controls="sldDu">
            <img src="outils/icons/offcanvas-icon.png" width="40px" height="auto" id="imgOffcnv">
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="sldDu">
            <div class="offcanvas-header">
                <img src="outils/icons/LOGO.png" alt="logo" width="250px" height="auto"
                    title="Welcome to DeluxeUpload" id="logo">
                <img src="<?= !empty($img) ? 'profile_picture/' . htmlspecialchars($img) : 'outils/icons/useracc2.png' ?>" alt="logo" width="40px" height="auto" id="imgAcc"
                    title="My Account" onclick="setTimeout(() => { bootstrap.Modal.getOrCreateInstance(document.getElementById('account')).show(); }, 300);" data-bs-dismiss="offcanvas">
            </div>
            <div class="container-fluid d-flex align-items-center gap-2">
                <button type="button" class="btn w-50" title="Click for swith the theme" id="themeBtn" onclick="document.getElementById('changeTheme').click();"><i id="themeIcon" class="fas fa-moon"></i></button>
                <button id="btnClose" type="button" class="btn mt-2 mb-2 w-50 text-reset" data-bs-dismiss="offcanvas" aria-label="Close">Hide Bar</button>
            </div>
            <div class="offcanvas-body p-0">
                <div class="list-group dvLST">
                    <a href="dashboard.php" class="list-group-item list-group-item-action" title="Dashboard">
                        <i class="fas fa-solid fa-gauge"></i> dashboard
                    </a>
                    <a href="#" class="list-group-item list-group-item-action" title="Support"
                        onclick="setTimeout(() => { bootstrap.Modal.getOrCreateInstance(document.getElementById('support')).show(); }, 300);" data-bs-dismiss="offcanvas">
                        <i class="fas fa-headset"></i> support / contact us
                    </a>
                    <a href="#" class="list-group-item list-group-item-action" title="Max File Size Allowed" onclick="setTimeout(() => { bootstrap.Modal.getOrCreateInstance(document.getElementById('maxFile')).show(); }, 300);" data-bs-dismiss="offcanvas">
                        <i class="fas fa-weight-scale"></i> max file size allowed
                    </a>
                    <a href="#" class="list-group-item list-group-item-action" title="Link Expiry"
                        onclick="setTimeout(() => { bootstrap.Modal.getOrCreateInstance(document.getElementById('linkExpiry')).show(); }, 300);" data-bs-dismiss="offcanvas">
                        <i class="fas fa-clock"></i> link expiry
                    </a>
                    <a href="#" class="list-group-item list-group-item-action" title="Site Language" onclick="setTimeout(() => { bootstrap.Modal.getOrCreateInstance(document.getElementById('language')).show(); }, 300);" data-bs-dismiss="offcanvas">
                        <i class="fas fa-language"></i> site language
                    </a>
                    <a href="#" class="list-group-item list-group-item-action" title="Cookies" onclick="setTimeout(() => { bootstrap.Modal.getOrCreateInstance(document.getElementById('cookies')).show(); }, 300);" data-bs-dismiss="offcanvas">
                        <i class="fas fa-cookie-bite"></i> cookies
                    </a>
                    <a href="#" class="list-group-item list-group-item-action" title="QR Code" onclick="setTimeout(() => { bootstrap.Modal.getOrCreateInstance(document.getElementById('qrcode')).show(); }, 300);" data-bs-dismiss="offcanvas">
                        <i class="fas fa-qrcode"></i> QR Code
                    </a>
                    <?php if (isset($_SESSION['useremail']) || isset($_COOKIE['dx_useremail'])): ?>
                        <a href="#" class="list-group-item list-group-item-action" onclick="setTimeout(() => { bootstrap.Modal.getOrCreateInstance(document.getElementById('account')).show(); }, 300);" data-bs-dismiss="offcanvas"><i class="fas fa-user"></i> Account</a>
                        <a href="logout.php" class="list-group-item list-group-item-action" style="color: red;"
                            title="Logout" id="logout">
                            <i class="fas fa-sign-out-alt"></i>
                            logout
                        </a>
                        <a href="sign-up.php" class="list-group-item list-group-item-action"><i class="fas fa-user-plus"></i> Create new account
                        </a>
                    <?php else: ?>
                        <button onclick="login();" type="button" class="btn" id="cnvBtn1"
                            title="Login">Login</button>
                        <button onclick="signUp();" type="button" class="btn" id="cnvBtn2"
                            title="Sign Up">SignUp</button>
                    <?php endif; ?>
                </div>
            </div>
            <div class="offcanvas-footer">
                <div class="pCop text-center mb-2">
                    <p id="copyrightText">&copy;</p>
                </div>
            </div>
        </div>
    </header>

    <div class="dv8 p-2" style="display: none;">
        <div class="dv8-1 mb-2">
            <button class="btn p-0" style="outline: none !important;box-shadow:none !important;" onclick="scrollToTop()">
                <img src="outils/svg/arrow_upward.svg" id="arrow">
            </button>
        </div>
        <!-- <div class="dv8-2">
            <a href="#" data-bs-toggle="modal" data-bs-target="#cookies">
                <img src="outils/icons/material-symbols--cookie-outline.svg">
            </a>
        </div> -->
    </div>
    <div class="container-fluid dv2" id="background">
        <div>
            <h1 style="font-weight: bold;">welcome to <strong style="font-weight: bold;"><mark style="color: white;">DeluxeUpload</mark></strong>
            </h1>
            <p class="mt-2" style="font-weight: bold;text-align:center;" id="quote">upload any file, anytime, anywhere :)</p>
            <?php if (isset($_SESSION['useremail']) || isset($_COOKIE['dx_useremail'])): ?>
                <button type="button" onclick="upload(true);" class="btn" title="Click for upload your file">Upload <i id="element" class=""></i></button>
            <?php else: ?>
                <button type="button" onclick="upload(false);" class="btn" title="Click for upload your file">Upload <i id="element" class=""></i></button>
            <?php endif; ?>
        </div>
    </div>
    <div data-bs-spy="scroll" data-bs-target=".nav2" data-bs-offset="50">
        <nav class="navbar navbar-expand mt-0 nav2 sticky-top" id="nav2" role="tablist">
            <div class="container-fluid">
                <ul class="navbar-nav mx-auto" id="ul3">
                    <li class="nav-item" title="Why DeluxeUpload ?"><a onmouseover="navbarHover()" onmouseout="navbarOut()" href="#du" class="nav-link" id="link">DeluxeUpload</a>
                    </li>
                    <li class="nav-item" title="About Us"><a id="link" onmouseover="navbarHover()" onmouseout="navbarOut()" href="#about" class="nav-link">About</a></li>
                    <li class="nav-item" title="Features of DU Website"><a href="#features" onmouseover="navbarHover()" onmouseout="navbarOut()" class="nav-link" id="link">Features</a>
                    </li>
                    <li class="nav-item" title="Security"><a href="#security" onmouseover="navbarHover()" onmouseout="navbarOut()" class="nav-link" id="link">Security</a></li>
                    <li class="nav-item" title="FAQ"><a href="#faq" onmouseover="navbarHover()" onmouseout="navbarOut()" class="nav-link" id="link">FAQ</a></li>
                    <li class="nav-item" title="Contact Us"><a href="#contactus" onmouseover="navbarHover()" onmouseout="navbarOut()" class="nav-link" id="link">Contact</a></li>
                </ul>
            </div>
        </nav>

        <div class="container mt-5 mb-5 dv3">
            <h1 style="text-align: center;" class="mb-2" id="du">Welcome to DeluxeUpload</h1>
            <p class="mt-3">
                DeluxeUpload is a simple, fast, and user-friendly platform designed for uploading and sharing files. Our
                goal
                is to provide a seamless experience with no ads, no unnecessary steps, and no hassle. Whether you're sharing
                important documents, large files, or media, DeluxeUpload makes it easy for you to upload and share your
                files
                quickly and securely.

                With our user-centric design, you can upload files without worrying about complicated processes or
                frustrating interruptions. We offer fast upload speeds, reliable hosting, and an intuitive interface that
                ensures you can manage your files with ease. Whether you're a business, a student, or someone who just needs
                to share a file
                , DeluxeUpload is here to provide you with the best service.
            </p>
        </div>


        <div class="container mt-5 mb-5 dv3">
            <h1 style="text-align: center;" class="mb-2" id="about">About Us</h1>
            <p class="mt-3">DeluxeUpload is a streamlined file sharing solution crafted for performance and reliability. We
                empower users to upload, manage, and distribute files with confidence through a secure and user-centric
                platform. Our focus is on delivering a seamless experience that meets both personal and professional needs.
            </p>
            <p>With no registration required, users can start sharing files instantly. DeluxeUpload supports both temporary
                and long-term storage options, adapting to your unique needs. Our infrastructure is built with privacy and
                speed in mind—so you can focus on what matters, while we handle the rest.</p>
        </div>

        <div class="container mt-3 mb-3">
            <h1 style="text-align: center;" class="mb-2" id="features">Features</h1>
        </div>
        <div class="container-fluid mt-2 dv4">
            <div id="dv4-1" class="mt-3 mb-3">
                <img src="outils/backgrounds/9731567.jpg" width="320px" height="auto" alt="img1" class="mb-3">
                <div class="p-3">
                    <h3>fast & secure uploads</h3>
                    <p>enjoy high-speed uploads with advanced security that keeps your files safe at all times.</p>
                </div>
            </div>
            <div id="dv4-1" class="mt-3 mb-3">
                <img src="outils/backgrounds/4650.jpg" width="320px" height="auto" alt="img2" class="mb-3">
                <div class="p-3">
                    <h3>simple & clean interface</h3>
                    <p>at intuitive, user-friendly design that makes uploading files as easy as a single click.</p>
                </div>
            </div>
            <div id="dv4-1" class="mt-3 mb-3">
                <img src="outils/backgrounds/6306476.jpg" width="320px" height="auto" alt="img1" class="mb-3">
                <div class="p-3">
                    <h3>direct download links-no ads</h3>
                    <p>get straigth to your files with clean, add-free download links. no popups, no delays.</p>
                </div>
            </div>
            <div id="dv4-1" class="mt-3 mb-3">
                <img src="outils/backgrounds/social-clouds.jpg" width="320px" height="320px" alt="img1" class="mb-3">
                <div class="p-3">
                    <h3>unlimited storage time</h3>
                    <p>your files stay online as long as you want - no automatic deletion r time limits.</p>
                </div>
            </div>
        </div>

        <div class="container mt-3 mb-3">
            <h1 style="text-align: center;" class="mb-2" id="security">Security</h1>
        </div>
        <div class="container mt-3 mb-3 dv3">
            <p>At DeluxeUpload, we take the security of your files seriously. We implement multiple layers of protection to
                ensure your privacy, including:
                File encryption during upload and storage to prevent unauthorized access.
            </p>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between">Temporary download links that automatically
                    expire after a set period.
                    <span class="badge"><img src="outils/svg/icons8-success.svg" alt="success" width="20px"
                            height="auto"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between">Complete privacy: Your files are not indexed by
                    search engines or publicly visible.
                    <span class="badge"><img src="outils/svg/icons8-success.svg" alt="success" width="20px"
                            height="auto"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between">File scanning to ensure uploads are safe and free
                    from harmful content.
                    <span class="badge"><img src="outils/svg/icons8-success.svg" alt="success" width="20px"
                            height="auto"></span>
                </li>
            </ul>
        </div>

        <div class="container mt-3 mb-3">
            <h1 style="text-align: center;" class="mb-2" id="faq">FAQ</h1>
        </div>
        <div class="container mt-3 mb-3">
            <div class="accordion" id="fqAcc">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="hd1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#clpOne"
                            aria-expanded="true" aria-controls="clpOne">What is the maximum file size allowed?</button>
                    </h2>
                    <div id="clpOne" class="accordion-collapse collapse" aria-labelledby="hd1" data-bs-parent="#fqAcc">
                        <div class="accordion-body">
                            You can upload files up to 2GB with the free version. For larger files, you may upgrade to a
                            premium plan in the future.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="hd2">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#clpTwo"
                            aria-expanded="true" aria-controls="clpTwo">Can I upload private files that no one else can
                            see?</button>
                    </h2>
                    <div id="clpTwo" class="accordion-collapse collapse" aria-labelledby="hd2" data-bs-parent="#fqAcc">
                        <div class="accordion-body">
                            Yes, you can select the "Private" option during upload to ensure the file is only accessible to
                            those with the direct link.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="hd3">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#clpTree"
                            aria-expanded="true" aria-controls="clpTree">How long are files stored on the server?</button>
                    </h2>
                    <div id="clpTree" class="accordion-collapse collapse" aria-labelledby="hd3" data-bs-parent="#fqAcc">
                        <div class="accordion-body">
                            Files are stored for 7 days from the date of upload. After that, they are automatically deleted
                            to maintain security and storage efficiency.
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container mt-3 mb-3">
            <h1 style="text-align: center;" class="mb-2" id="contactus">Contact Us</h1>
        </div>
        <div class="container mt-3 mb-3 dv5">
            <div>
                <a href="https://github.com/abderrahim1210">
                    <img src="outils/icons/github.png" width="100px" height="auto" alt="github">
                </a>
                <p>@github</p>
            </div>
            <div>
                <a href="#">
                    <img src="outils/icons/fb.png" width="100px" height="auto" alt="facebook">
                </a>
                <p>@facebook</p>
            </div>
            <div>
                <a href="#">
                    <img src="outils/icons/telegram.png" width="100px" height="auto" alt="telegram">
                </a>
                <p>@telegram</p>
            </div>
            <div>
                <a href="https://x.com/DeluxeUpload">
                    <img src="outils/icons/x.png" width="100px" height="auto" alt="x">
                </a>
                <p>@x</p>
            </div>
            <div>
                <a href="https://www.youtube.com/channel/UC8ZYkfXuTlHV69Ljn84VwGg">
                    <img src="outils/icons/icons sc/youtube.png" width="100px" height="auto" alt="youtube">
                </a>
                <p>@youtube</p>
            </div>
            <div>
                <a href="#">
                    <img src="outils/icons/icons sc/whatsapp.png" width="100px" height="auto" alt="whatsapp">
                </a>
                <p>@whatsapp</p>
            </div>
            <div>
                <a href="mailto:deluxeupload@gmail.com">
                    <img src="outils/icons/icons sc/gmail.png" width="100px" height="auto" alt="gmail">
                </a>
                <p>@gmail</p>
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
                        <h1 class="fw-bold">File Management</h1>
                        <p>Stay organized and in control — rename, share, or delete your uploaded files anytime from your personal dashboard.
                            DeluxeUpload gives you powerful tools to manage your data securely and efficiently.</p>
                        <button type="button" onclick="window.open('dashboard.php','_self')" class="btn">Try it</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark mt-5 p-2">
        <div class="container-fluid mt-2 mb-2  dvFot">
            <ul class="nav d-flex justify-content-center nvFot">
                <li class="nav-item">
                    <a href="deluxeupload.php" class="nav-link active">EN</a>
                </li>
                <li class="nav-item">
                    <a href="deluxeuploadAr.php" class="nav-link">AR</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">FR</a>
                </li>
            </ul>
        </div>
        <p><mark id="pFot"><!-- every file is a new beginning.<i class="fas fa-heart"></i> --></mark></p>
        <div class="container-fluid mt-3 dvFin">
            <ul class="nav d-flex navFin justify-content-center">
                <li class="nav-item">
                    <a href="privacy.html" class="nav-link active">Privacy & Policy</a>
                </li>
                <li class="nav-item">
                    <a href="terms.html" class="nav-link">Terme Of Use</a>
                </li>
            </ul>
            <div class="pCop mb-2">
                <p id="copyrightText">&copy;</p>
            </div>
        </div>
    </footer>
    <div class="container-fluid">
        <nav class="navbar navbar-expand fixed-bottom nav6" role="tablist">
            <ul class="navbar-nav" id="ul6">
                <li class="nav-item"><a href="#" data-bs-target="#account" data-bs-toggle="modal" class="nav-link"><i class="fas fa-user"></i> Profil</a></li>
                <li class="nav-item"><a href="upload.php" class="nav-link"><i class="fas fa-file-upload"></i> Upload</a></li>
                <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="fas fa-folder"></i> My files</a></li>
            </ul>
        </nav>
    </div>


    <script src="change-background.js"></script>
    <script src="links.js" defer></script>
    <script src="theme-en.js"></script>
    <script src="transfer.js" defer></script>
    <script src="rotate-icon.js" defer></script>
    <script src="lang.js"></script>
    <script src="loading.js"></script>
    <script src="quotes-en.js"></script>
    <script src="NProgress/nprogress.js"></script>
    <script src="copyright.js"></script>
    <script src="nprogress.js"></script>
    <script src="bootstrap-5.3.7-dist/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>