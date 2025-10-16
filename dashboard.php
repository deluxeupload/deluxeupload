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
    <title>Deluxe Upload : Dashboard</title>
    <link rel="icon" type="image/png" href="outils/favicons/1748349885280.PNG">
    <link rel="stylesheet" href="bootstrap-5.3.7-dist/bootstrap-5.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="fontawesome-free-7.0.0-web/fontawesome-free-7.0.0-web/css/all.min.css">
    <link rel="stylesheet" href="NProgress/nprogress.css">
    <link rel="stylesheet" href="sweetalert/sweetalert2.min.css">
</head>

<body lang="en">
    <div id="loader">
        Wait a seconds for load
        <div class="spinner-border text-center">
        </div>
    </div>
    <header>
        <nav class="navbar navbar-expand p-1 nv1">
            <div class="container-fluid dv1 p-1 d-flex">
                <ul class="navbar-nav me-auto" id="ul2">
                    <li class="nav-item" title="Welcome to DeluxeUpload">
                        <a href="deluxeupload.php" class="nav-link nav-brand p-0 m-0">
                            <img src="outils/icons/LOGO.png" style="padding: 0%;width: 200px;;height: auto;margin: 0;" id="logo" class="img-fluid">
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav dv1 ms-auto d-md-flex" id="ul1">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;" id="dropdownIcon">
                            Lang <i class="fas fa-chevron-down" id="drpIcon"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" id="ul4">
                            <li class="nav-item">
                                <a href="dashboard.php" class="dropdown-item">En</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-ar.php" class="dropdown-item">Ar</a>
                            </li>
                        </ul>
                    </div>
                    <!-- <li class="nav-item">
                        <a href="myfiles.php" class="nav-link">
                            EN
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="myfilesAr.php" class="nav-link">
                            AR
                        </a>
                    </li> -->
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
                        <h1>Dasheboard</h1>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <?php if (isset($_SESSION['username'], $_SESSION['useremail'])): ?>
                                <p>Welcome <?php echo htmlspecialchars($_SESSION['username']) . "✨" ?></p>
                                <tr>
                                    <td>Name</td>
                                    <td><?php echo htmlspecialchars($_SESSION['username']);  ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo htmlspecialchars($_SESSION['useremail']);  ?></td>
                                </tr>
                                <tr>
                                    <td>Edit</td>
                                    <td><a href="edit.php?id=<?php echo htmlspecialchars($_SESSION['userid']); ?>" id="edit">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>Forgot</td>
                                    <td><a href="logout.php" id="logout">Forgot</a></td>
                                </tr>
                            <?php elseif (isset($_COOKIE['dx_username'], $_COOKIE['dx_useremail'])): ?>
                                <p>Welcome <?php echo htmlspecialchars($_COOKIE['dx_username']) . "✨" ?></p>
                                <tr>
                                    <td>Name</td>
                                    <td><?php echo htmlspecialchars($_COOKIE['dx_username']);  ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo htmlspecialchars($_COOKIE['dx_useremail']);  ?></td>
                                </tr>
                                <tr>
                                    <td>Edit</td>
                                    <td><a href="edit.php?id=<?php echo htmlspecialchars($_COOKIE['dx_userid']); ?>" id="edit">Edit</a></td>
                                </tr>
                                <tr>
                                    <td>Forgot</td>
                                    <td><a href="logout.php" id="logout">Forgot</a></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">You are not logged in. <a href="sign-up.php">Sign up here</a></td>
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
        <!-- <div class="modal fade" id="editFile">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1>
                            Edit file
                        </h1>
                    </div>
                    <div class="modal-body">
                        <label for="visibility" class="form-label">Visibility</label>
                        <select id="visibility" class="form-select">
                            <option value="public">Public</option>
                            <option value="private"></option>
                        </select>
                        <label for="expires_at" class="form-label">Expires at</label>
                        <input type="datetime-local" name="" class="form-control" id="expires_at">
                    </div>
                    <div class="modal-footer">
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                </div>
            </div>
        </div> -->
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
        <div class="modal fade" id="profileP">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1>
                            Profile Picture
                        </h1>
                    </div>
                    <div class="modal-body">
                        <form action="profil_picture.php?id=<?= $id; ?>&lang=en" method="post" enctype="multipart/form-data">
                            <input type="file" name="profile_picture" id="profilePicture" style="display: none;" accept=".jpg, .jpeg, .png">
                            <div class="container-fluid add_picture" id="pPicture">
                                <img src="outils/icons/up_profile_picture1.png" width="150px" height="auto" id="profileIcon" alt="" class="img-fluid">
                                <p id="para" class="text-center">Click here for add a picture</p>
                                <img src="" id="image" alt="" class="img-fluid">
                            </div>
                            <?php if (!empty($_SESSION['profileErr'])): ?>
                                <div class="container w-100 p-3 text-light bg-dark">
                                    <?= $_SESSION['profileErr']; ?>
                                </div>
                                <?php unset($_SESSION['profileErr']); ?>
                            <?php endif; ?>
                            <div id="filename" class="container w-100 p-1">
                                <p id="para1" style="font-weight: 700;"></p>
                            </div>
                            <div class="mt-1 mb-1">
                                <i style="opacity: calc(0.8);">* Please upload an image in PNG ,JPG or JPEG format only.</i>
                            </div>
                            <div class="mt-2 mb-2">
                                <button class="btn" id="profilePictureButton">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php showAlert('errmess'); ?>
    <?php showAlert('profileMess'); ?>
    <?php showAlert('profileErr'); ?>
    <button type="button" class="btn" data-bs-toggle="collapse" data-bs-target="#demo" id="collapseButton"><i class="fas fa-bars"></i></button>
    <nav class="navbar navbar-expand nv2 d-md-block collapse" id="demo">
        <div class="container-fluid dv2 p-0">
            <ul class="nav mx-auto">
                <li class="nav-item"><a href="#info" role="tab" aria-controls="info" data-bs-target="#info" data-bs-toggle="tab" class="nav-link active"><i class="fas fa-id-card"></i> Personal informations</a></li>
                <li class="nav-item"><a href="#files" role="tab" data-bs-target="#files" data-bs-toggle="tab" class="nav-link"><i class="fas fa-id-card"></i> My files</a></li>
                <li class="nav-item"><a href="#reports" role="tab" data-bs-target="#reports" data-bs-toggle="tab" class="nav-link"><i class="fas fa-images"></i> My reports</a></li>
                <li class="nav-item"><a href="#setting" role="tab" aria-controls="setting" data-bs-target="#setting" data-bs-toggle="tab" class="nav-link"><i class="fas fa-sliders-h"></i> Extra setting</a></li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid p-0 tab-content">
        <div class="p-2 tab-pane fade show active" id="info">
            <h2>Personal informations</h2>
            <div class="d-flex justify-content-start align-items-center mt-2 mb-2" style="flex-direction: column;gap:5px;">
                <div>
                    <img src="<?= !empty($img) ? 'profile_picture/' . htmlspecialchars($img) : 'outils/icons/useracc2.png' ?>"
                        width="100px" height="100px" id="imgAcc" alt="Profile Picture">
                </div>
                <div class="text-center">
                    <a href="#" id="changePhoto" data-bs-target="#profileP" data-bs-toggle="modal">Change photo</a>
                    <br>
                    <form action="delete_profile_picture.php?id=<?= $id; ?>&lang=en" id="alertFormProfile" method="post">
                        <a type="button" id="removePhoto" onclick="delete_profile_picture('en')"><i class="fas fa-trash text-center"></i> Remove</a>
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
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" value="<?= $_SESSION['username'] ?? $_COOKIE['dx_username']; ?>" id="name" readonly>
                    </li>
                    <li class="list-group-item">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" value="<?= $_SESSION['useremail'] ?? $_COOKIE['dx_useremail']; ?>" id="email" readonly>
                    </li>

                    <li class="list-group-item">
                        <label for="date" class="form-label">Created at</label>
                        <input type="text" class="form-control" value="<?= $_SESSION['created_at'] ?? $_COOKIE['dx_created_at']; ?>" id="date" readonly>
                    </li>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="setting">
            <div class="p-2 mt-2 mb-2">
                <h2>Extra setting</h2>
                <div class="list-group" id="listGroup2">
                    <li class="list-group-item">
                        <a href="edit.php?id=<?= $_SESSION['userid'] ?? $_COOKIE['dx_userid'] ?>"><i class="fas fa-user-cog"></i> Change email , password</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#cookies"><i class="fas fa-cookie"></i> Cookies</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" data-bs-target="#support" data-bs-toggle="modal"><i class="fas fa-headset"></i> Support / Contact Us</a>
                    </li>
                    <li class="list-group-item">
                        <a href="logout.php" style="color: #e63946;"><i class="fas fa-sign-out-alt"></i> Log out</a>
                    </li>
                    <li class="list-group-item">
                        <form action="delete_account_page.php" id="alertFormDelAcc" method="post">
                            <a href="#" id="delAcc" onclick="delete_account('en');"><i class="fas fa-user-slash"></i> Delete account</a>
                        </form>
                    </li>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="files">
            <div class="table-responsive p-2 mt-2 mb-2">
                <h2>My Files</h2>
                <table class="table table-hover table-striped table-center" id="tab2" style="width: 100%;margin:auto;">
                    <tr>
                        <th>File</th>
                        <th>Size</th>
                        <th>Upload at</th>
                        <th>Downloads</th>
                        <th></th>
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
                                <a href="file.php?id=<?= $file['id']; ?>&fileid=<?= $file['id']; ?>" class="btn download-btn" id="download"><i class="fas fa-download text-center"></i></a>
                            </td>
                            <td>
                                <form action="delete_file.php?id=<?= $file['id']; ?>&lang=en" id="fileForm<?= $file['id']; ?>" method="post">
                                    <button type="button" class="btn" id="delete" onclick="delete_file('en',<?= $file['id']; ?>)"><i class="fas fa-trash text-center"></i></button>
                                </form>
                            </td>
                            <td>
                                <a href="#" id="editButton" data-bs-target="#editFile" data-bs-toggle="modal" class="btn"><i class="fas fa-pencil"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="container carditems">
                <?php foreach ($currentFiles as &$file): ?>
                    <div class="card filesItems">
                        <div class="card-body">
                            <div>
                                <h1><?= htmlspecialchars($file['file_name']); ?></h1>
                            </div>
                            <hr>
                            <p>Size : <?= number_format($file['file_size'] / (1024 * 1024), 2) . "MB"; ?></p>
                            <p>Upload at : <?= htmlspecialchars($file['upload_date']); ?></p>
                            <p>Downloads : <?= htmlspecialchars($file['download_count']); ?></p>
                            <hr>
                            <div class="d-flex justify-content-start" style="gap: 5px;">
                                <a href="file.php?id=<?= $file['id']; ?>&fileid=<?= $file['id']; ?>" class="btn download-btn" id="download" title="Click here for download the file"><i class="fas fa-download text-center"></i></a>
                                <form action="delete_file.php?id=<?= $file['id']; ?>&lang=en" id="fileForm<?= $file['id']; ?>" method="post">
                                    <button type="button" class="btn" id="delete" onclick="delete_file('en',<?= $file['id']; ?>)"><i class="fas fa-trash text-center"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="d-flex justify-content-center mt-2 mb-2">
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
                <a type="button" id="button1" class="btn mx-auto" href="upload.php"><i class="fas fa-upload"></i> Upload</a>
            </div>
        </div>
        <div class="tab-pane fade show" id="reports">
            <div class="p-2 mt-2 mb-2">
                <h2>My Reports</h2>
                <div class="reportitems">
                    <?php foreach ($currentReps as $rep): ?>
                        <div class="card mt-2 mb-2">
                            <div class="card-body">
                                <div class="mt-2 mb-2">
                                    <h1>Report id <?= htmlspecialchars($rep['id']); ?></h1>
                                </div>
                                <div class="mt-2 mb-2">
                                    <label class="form-label" for="resonReport">Reason of report :</label>
                                    <textarea class="form-control" readonly><?= htmlspecialchars($rep['report_reason']); ?></textarea>
                                </div>
                                <div class="mt-2 mb-2">
                                    <label class="form-label" for="useremail">From email :</label>
                                    <input type="text" id="useremail" value="<?= htmlspecialchars($_SESSION['useremail'] ?? $_COOKIE['dx_useremail']); ?>" class="form-control" readonly>
                                </div>
                                <div class="mt-2 mb-2">
                                    <p>Send at : <?= htmlspecialchars($rep['report_date']); ?></p>
                                </div>
                                <div class="mt-2 mb-2">
                                    <div class="statu d-flex justify-content-center align-items-center"><i id="statuImg" class="fas fa-clock"></i><?= htmlspecialchars($rep['status']); ?></div>
                                </div>
                                <div class="mt-2 mb-2">
                                    <i style="color:rgb(160,160,160);">Thanks for reaching out! We’re working on your report with care.</i>
                                </div>
                                <div class="mt-2 mb-2" id="delRep">
                                    <form action="delete_report.php?id=<?= htmlspecialchars($rep['id']); ?>&lang=en" id="formRep<?= $rep['id']; ?>" method="post">
                                        <button class="btn btn-link fw-bold p-0 text-primary" type="button" onclick="delete_report('en',<?= $rep['id']; ?>)">Delete report</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="d-flex justify-content-center mt-2 mb-2">
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
                <div class="container">
                    <a type="button" id="button3" class="btn btn-secondary" href="reports.php"><i class="fas fa-flag"></i> Add Report</a>
                </div>
            </div>
        </div>
    </div>

    <script src="profile_picture.js"></script>
    <script src="statu.js"></script>
    <script src="rotate-icon.js" defer></script>
    <script src="theme-myfiles.js"></script>
    <script src="loading.js"></script>
    <script src="confirm-alert.js"></script>
    <!-- <script src="fontawesome-free-6.7.2-web/fontawesome-free-6.7.2-web/js/all.min.js"></script> -->
    <script src="nprogress/nprogress.js"></script>
    <script src="nprogress.js"></script>
    <script src="sweetalert/sweetalert2.min.js"></script>
    <script src="bootstrap-5.3.7-dist/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>