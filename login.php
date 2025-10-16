<?php
include "log-in.php";
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1,user-scalable=no">
    <title>Deluxe Upload : Login</title>
    <link rel="stylesheet" href="bootstrap-5.3.7-dist/bootstrap-5.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
    <link rel="icon" href="outils/favicons/1748349885280.PNG">
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
        <div class="dv1-0">
            <div>
                <h1>Log in page</h1>
            </div>
        </div>
        <div class="dv1-1 p-0 text-center row">
            <div>
                <img src="outils/icons/LOGO.png" style="width: 300px;" alt="logo" class="img-fluid" id="logo" title="Welcome for you to DeluxeUpload">
            </div>
            <div class="text-start col">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="d-flex justify-content-center align-items-center row" id="loginForm">
                    <div>
                        <!-- <div class="form-floating mt-3 mb-3">
                            <input type="text" id="nameLogin" name="username" class="form-control" placeholder="Type your name ..." title="Type your full name">
                            <div class="badge">
                                 <img src="outils/icons/name.png" width="50px" height="auto" alt="username"> -->
                                <!-- <i class="fas fa-user fa-2x text-dark"></i>
                            </div>
                            <label for="nameLogin" class="form-label">Full Name</label>
                            <span id="errNameLogin"></span>
                        </div> -->
                        <div class="form-floating mt-3 mb-3">
                            <input type="email" id="emailLogin" name="useremail" class="form-control" placeholder="Type your email ..." title="Type your email" required>
                            <div class="badge">
                                <!-- <img src="outils/icons/email.png" width="50px" height="auto" alt="username"> -->
                                <!-- <i class="fas fa-envelope fa-2x text-dark"></i> -->
                            </div>
                            <label for="emailLogin" class="form-label">Email</label>
                            <span id="errEmailLogin"></span>
                        </div>
                        <div class="form-floating mt-3 mb-3">
                            <input type="password" id="pwdLogin" name="userpass" class="form-control" placeholder="Type your password ..." title="Type your password" oninput="this.style.borderColor = this.value.length > 8 ? 'green' : 'red'" onblur="this.style.borderColor = this.value.length <= 0 ? 'black' : ''"  required>
                            <div class="badge">
                                <!-- <img src="outils/icons/password.png" width="50px" height="auto" class="input-group-icon" alt="username"> -->
                                <!-- <i class="fas fa-lock fa-2x text-dark"></i> -->
                            </div>
                            <label for="pwdLogin" class="form-label">Password</label>
                            <span id="errPassLogin"></span>
                        </div>
                        <!-- <div class="form-check mt-3 mb-3">
                            <label for="vd" class="form-check-label">Remeber me</label>
                            <input type="checkbox" name="validate" id="vd" class="form-check-input">
                        </div> -->
                        <p>You don't have a account ? <a href="sign-up.php" title="Click here to sign up if you have not a account">Sign Up</a></p>
                        <div class="mt-3 mb-3 dvBtn text-center">
                            <button type="submit" class="btn mt-2 mb-2" title="Click for login">Login</button>
                        </div>
                    </div>
                </form>
                <?php if (!empty($error)): ?>
                    <div class="container bg-danger p-3 text-light">
                        <?php echo $error; ?>
                    </div>
                    <?php $error = "" ?>
                <?php endif; ?>
                <?php if (!empty($_SESSION['mess'])): ?>
                    <div class="container bg-danger p-3 text-light">
                        <?= $_SESSION['mess']; ?>
                    </div>
                    <?php unset($_SESSION['mess']); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="login.js"></script>
    <script src="theme.js"></script>
    <script src="transfer.js"></script>
    <script src="loading.js"></script>
    <script src="toastr/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton" : true,
            "progressBar" : true,
            "positionClass" : "toast-top-right",
            "timeOut" : "3000"
        };

        <?php if(!empty($_SESSION['logout'])): ?>
            toastr.success("<?= $_SESSION['logout']; ?>");
            <?php unset($_SESSION['logout']); ?>
        <?php endif; ?>

        <?php if(!empty($_SESSION['signup'])): ?>
            toastr.success('<?= $_SESSION['signup']; ?>')
            <?php unset($_SESSION['signup']); ?>
        <?php endif; ?>

        <?php if(!empty($_SESSION['editmess'])): ?>
            toastr.success('<?= $_SESSION['editmess']; ?>')
            <?php unset($_SESSION['editmess']); ?>
        <?php endif; ?>

        <?php if(!empty($_SESSION['delSucc'])): ?>
            toastr.success('<?= $_SESSION['delSucc']; ?>')
            <?php unset($_SESSION['delSucc']); ?>
        <?php endif; ?>
        </script>
    <script src="bootstrap-5.3.7-dist/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>