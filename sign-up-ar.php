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
    <link rel="stylesheet" href="bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="sign-up.css">
    <link rel="icon" href="outils/favicons/1748349885280.PNG">
</head>
<body>
    <div class="container mt-0 mb-0 dv1">
        <div class="dv1-1 text-center row">
            <img src="outils/icons/LOGO.png" style="max-width: 250px;" alt="logo" class="img-fluid mt-3 mb-3" title="Welcome for you to DeluxeUpload">
            <div class="text-start col">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="d-flex justify-content-center align-items-center row" id="signupForm" method="post">
                    <div style="min-width: 350px;">
                        <div class="form-floating mt-3 mb-3">
                            <input type="text" id="username_signup" name="username" class="form-control" placeholder="Tape your name ..." title="أكتب اسمك">
                            <label for="username_signup" class="form-label">الاسم الكامل</label>
                            <span id="errNameSign"></span>
                        </div>
                        <div class="form-floating mt-3 mb-3">
                            <input type="email" id="useremail_signup" name="useremail" class="form-control" placeholder="Tape your name ..." title="أكتب بريدك الالكتروني">
                        <label for="useremail_signup" class="form-label">البريد الالكتروني</label>
                            <span id="errEmailSign"></span>
                        </div>
                        <div class="form-floating mt-3 mb-3">
                            <input type="password" name="userpass" id="pwdSign" class="form-control" placeholder="Tape your password ..." title="أكتب كلمة السر">
                            <label for="pwdSign" class="form-label">كلمة السر</label>
                            <span id="errPassSign"></span>
                        </div>
                        <!-- <div class="form-check mt-3 mb-3">
                            <label for="vd" class="form-check-label">Remeber me</label>
                            <input type="checkbox" name="validate" id="vd" class="form-check-input" title="Click here for save your informations">
                        </div> -->
                        <a href="login.php" title="Click here if you have a account">Login</a>
                        <div class="mt-3 mb-3 dvBtn text-center">
                            <button type="submit" class="btn mt-2 mb-2" title="Click for Sign Up">Sign Up</button>
                        </div>
                    </div>
                </form>
                <div><?php echo $succMessage; ?></div>
                <div><?php echo $errMesage; ?></div>
            </div>
        </div>
    </div>
    
    <script src="signup.js"></script>
    
    <script src="bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>