<?php
ob_start();
include "edit_user.php";
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1,user-scalable=no">
    <title>Deluxe Upload : Edit My Informations</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="edit.css">
    <link rel="icon" href="outils/favicons/1748349885280.PNG">
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
                <h1>edit page</h1>
            </div>
        </div>
        <div class="dv1-1 text-center p-0 row">
            <div>
                <img src="outils/icons/LOGO.png" style="max-width: 250px;" alt="logo" class="img-fluid mt-3 mb-3" title="Welcome for you to DeluxeUpload" id="logo">
            </div>
            <div class="text-start col">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="d-flex justify-content-center align-items-center row" id="editForm" method="post">
                    <div style="min-width: 350px;">

                        <div>
                            <input type="hidden" name="nuserid" value="<?php echo htmlspecialchars($rows['id']); ?>">
                        </div>
                        <div class="form-floating mt-3 mb-3">
                            <input type="text" id="username_signup" name="nusername" class="form-control" placeholder="Tape your name ..." title="Tape your full name" value="<?php echo htmlspecialchars($rows['userName']); ?>">
                            <label for="username_signup" class="form-label">Full Name</label>
                            <span id="errNameSign"><?php if(!empty($errName)){echo $errName;}; ?></span>
                        </div>
                        <div class="form-floating mt-3 mb-3">
                            <input type="email" id="useremail_signup" name="nuseremail" class="form-control" placeholder="Tape your name ..." title="Tape your email ..." value="<?php echo htmlspecialchars($rows['userEmail']); ?>">
                            <label for="useremail_signup" class="form-label">Email</label>
                            <span id="errNameSign"><?php if(!empty($errEmail)){echo $errEmail;}; ?></span>
                        </div>
                        <div class="form-floating mt-3 mb-3">
                            <input type="password" name="nuserpass" id="pwdSign" class="form-control" placeholder="Tape your password ..." title="Tape your password">
                            <label for="pwdSign" class="form-label">Password</label>
                            <span id="errPassSign"><?php if(!empty($errPass)){echo $errPass;}; ?></span>
                        </div>
                        <div class="mt-3 mb-3 dvBtn text-center">
                            <button type="submit" class="btn mt-2 mb-2" title="Click for Sign Up">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- <script src="edit.js"></script> -->

    <script src="theme.js"></script>
    <script src="loading.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>