<?php
    include "db.php";
    session_start();
    if(!isset($_SESSION['userid']) || !is_numeric($_SESSION['userid'])){
        $_SESSION['cookiemess'] = "User not found.";
        header("Location:deluxeupload.php");
        exit();
    }else{
        $cookie_name = "dx_username";
        $cookie_value = $_SESSION['username'];
        $cookie_email = "dx_useremail";
        $cookie_email_value = $_SESSION['useremail'];
        $cookie_id = "dx_userid";
        $cookie_id_value = $_SESSION['userid'];
        $cookie_date = "dx_created_at";
        $cookie_date_value = $_SESSION['created_at'];
        setcookie($cookie_name,$cookie_value,time() + (86400 * 30),'/');
        setcookie($cookie_email,$cookie_email_value,time() + (86400 * 30),'/');
        setcookie($cookie_id,$cookie_id_value,time() + (86400 * 30),'/');
        setcookie($cookie_date,$cookie_date_value,time() + (86400 * 30),'/');
        if(isset($_GET['lang'])){
            if($_GET['lang'] === "en"){
                $_SESSION['cookiemess'] = "You are accept the cookies of Deluxe Upload website.";
                header("Location:deluxeupload.php");
            }else{
                $_SESSION['cookiemess'] = "لقد وافقت على الكوكيز الخاصة ب موفع ديلوكس أبلود.";
                header("Location:deluxeuploadAr.php");
            }
            exit();
        }
    }
?>