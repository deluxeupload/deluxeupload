<?php
ob_start();
include "delete_account.php";
ob_flush();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1,user-scalable=no">
    <title>Deluxe Upload : Delete account</title>
    <link rel="icon" type="image/png" href="outils/favicons/1748349885280.PNG">
    <link rel="stylesheet" href="bootstrap-5.3.7-dist/bootstrap-5.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="NProgress/nprogress.css">
    <link rel="stylesheet" href="sweetalert/sweetalert2.min.css">
    <link rel="stylesheet" href="toastr/toastr.min.css">
    <script src="Jquery File/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div id="loader">
        Wait a seconds for load
        <div class="spinner-border text-center">
        </div>
    </div>
    <div class="dv1">
        <div class="dv1-0 p-0">
            <div>
                <h1>delete account page</h1>
            </div>
        </div>
        <div class="dv1-1 text-center p-0 row">
            <div>
                <img src="outils/icons/LOGO.png" style="max-width: 250px;" alt="logo" class="img-fluid mt-3 mb-3" title="Welcome for you to DeluxeUpload">
            </div>
            <div class="text-start col">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="d-flex justify-content-center align-items-center row" id="delAccForm" method="post">
                    <div style="min-width: 350px;">
                        <div class="form-floating mt-3 mb-3">
                            <input type="email" id="useremail_signup" name="nuseremail" class="form-control" placeholder="Tape your name ..." readonly title="Tape your email ..." value="<?php echo htmlspecialchars($_SESSION['useremail'] ?? $_COOKIE['dx_useremail']); ?>">
                            <label for="useremail_signup" class="form-label">Email</label>
                        </div>
                        <div class="form-floating mt-3 mb-3">
                            <input type="password" name="password" id="pwdSign" class="form-control" placeholder="Tape your password ..." title="Tape your password">
                            <label for="pwdSign" class="form-label">Password</label>
                        </div>
                        <div class="mt-3 mb-3 dvBtn text-center">
                            <button type="submit" class="btn mt-2 mb-2" title="Click for Sign Up">Delete</button>
                        </div>
                    </div>
                </form>
                <?php if (!empty($_SESSION['delErr'])): ?>
                    <div class="container bg-danger p-3 text-light">
                        <?= $_SESSION['delErr']; ?>
                    </div>
                    <?php unset($_SESSION['delErr']); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="toastr/toastr.min.js"></script>
    <script src="loading.js"></script>
    <script src="bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        toastr.options = {
            "closeButton" : true,
            "progressBar" : true,
            "positionClass" : "toast-top-right",
            "timeOut" : "3000"
        };

        toastr.info("Enter your password for delete your account");
    </script>
</body>

</html>