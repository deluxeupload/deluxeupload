<?php
ob_start();
include "signup.php";
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1,user-scalable=no">
    <title>Deluxe Upload : Sign Up</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="sign-up.css">
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
                <h1>sign up page</h1>
            </div>
        </div>
        <div class="dv1-1 p-0 text-center row">
            <div>
                <img src="outils/icons/LOGO.png" style="width: 300px;" alt="logo" class="img-fluid" id="logo" title="Welcome for you to DeluxeUpload">
            </div>
            <div class="text-start col">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="d-flex justify-content-center align-items-center row" id="signupForm" method="post">
                    <div style="min-width: 350px;">
                        <div class="form-floating mt-3 mb-3">
                            <input type="text" id="username_signup" name="username" class="form-control" placeholder="Tape your name ..." title="Tape your full name" required>
                            <label for="username_signup" class="form-label">Full Name</label>
                            <span id="errNameSign"></span>
                        </div>
                        <div class="form-floating mt-3 mb-3">
                            <input type="email" id="useremail_signup" name="useremail" class="form-control" placeholder="Tape your name ..." title="Tape your email ..." required>
                            <label for="useremail_signup" class="form-label">Email</label>
                            <span id="errEmailSign"></span>
                        </div>
                        <div class="form-floating mt-3 mb-3">
                            <input type="password" name="userpass" id="pwdSign" class="form-control" placeholder="Tape your password ..." title="Tape your password" oninput="this.style.borderColor = this.value.length > 8 ? 'green' : 'red'" onblur="this.style.borderColor = this.value.length <= 0 ? 'black' : ''" required>
                            <label for="pwdSign" class="form-label">Password</label>
                            <span id="errPassSign"></span>
                        </div>
                        <!-- <div class="form-check mt-3 mb-3">
                            <label for="vd" class="form-check-label">Remeber me</label>
                            <input type="checkbox" name="validate" id="vd" class="form-check-input" title="Click here for save your informations">
                        </div> -->

                        <div class="p-0">
                            <p><input type="checkbox" class="form-check-input" role="checkbox" required> I agree to the <a href="terms.html">Terms ans Conditions</a> and <a href="privacy.html">Privacy Policy</a>.</p>

                            <p>You have a account ? <a href="login.php" title="Click here if you have a account">Login</a></p>
                            <div class="dvBtn text-center">
                                <button type="submit" class="btn mt-2 mb-2" title="Click for Sign Up">Sign Up</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div><?php echo $succMessage; ?></div>
                <?php if (!empty($errMesage)): ?>
                    <div class="container bg-danger p-3 text-light">
                        <?= $errMesage; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="signup.js"></script>
    <script src="theme.js"></script>
    <script src="transfer.js"></script>
    <script src="loading.js"></script>
    <script src="toastr/toastr.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>