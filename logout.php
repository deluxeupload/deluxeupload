<?php
    session_start();
    if(isset($_SESSION['userid']) || isset($_COOKIE['dx_userid'])){
        session_unset();
        session_destroy();
        setcookie('dx_username','',time() - 3600,'/');
        setcookie('dx_useremail','',time() - 3600,'/');
        setcookie('dx_userid','',time() - 3600,'/');
        session_start();
        $_SESSION['logout'] = "You are logged out from DeluxeUpload";
        header("Location:login.php");
        exit();
    }
?>