<?php
include "db.php";
session_start();
$message = "";
if ((!isset($_SESSION['userid']) || !is_numeric($_SESSION['userid'])) && (!isset($_COOKIE['dx_userid']) || !is_numeric($_COOKIE['dx_userid']))) {
    $_SESSION['errmessAr'] = "تحتاج لتسجيل الدخول أولا";
    header("Location:login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['userfile'])) {
    $target_dir = "uploads/";
    $file_name = basename($_FILES['userfile']['name']);
    $target_file = $target_dir . $file_name;
    $file_size = basename($_FILES['userfile']['size']);
    $uploadOk = true;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    /* if (file_exists($target_file)) {
        $message = "الملف موجود من قبل";
        $uploadOk = false;
    } */

    $maxSize = 100 * 1024 * 1024;
    if ($_FILES['userfile']['size'] > $maxSize) {
        $message = "The file is large";
        $uploadOk = false;
    }

    $allowed = ['zip', 'rar', 'pdf', 'jpg', 'jpeg', 'png', 'svg', 'gif', 'docx', 'pptx','txt','csv','mp4','mp3','xlsx'];
    if (!in_array($fileType, $allowed)) {
        $message = "لانقبل هذا النوع من الملفات";
        $uploadOk = false;
    }

    $_SESSION['file_name'] = $file_name;
    $_SESSION['file_type'] = $fileType;
    $_SESSION['file_size'] = $file_size;
    $userId = $_SESSION['userid'] ?? $_COOKIE['dx_userid'];
    if ($uploadOk == true) {
        if (!isset($userId)) {
            $message = "تحتاج للتسجيل أولا";
        } else {
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $target_file)) {
                $message = "Uploaded Successfully <a href='myfiles.php'>My files</a>" . htmlspecialchars(basename($_FILES['userfile']['name']));
                $up = $conn->prepare('INSERT INTO files (user_id,file_name,file_path,file_size) VALUES (:user_id,:file_name,:file_path,:file_size)');
                $up->bindValue(":user_id", $userId, PDO::PARAM_INT);
                $up->bindValue(":file_name", $file_name);
                $up->bindValue(":file_path", $file_name);
                $up->bindValue(":file_size", $_FILES['userfile']['size']);
                $up->execute();
                $file_id = $conn -> lastInsertId();
                $token = bin2hex(random_bytes(16));
                $expires_at = date('Y-m-d H:i:s',strtotime('+30 days'));
                $stm = $conn -> prepare("INSERT INTO temp_link (file_id,token,expires_at) VALUES (:fileid,:token,:expires_at)");
                $stm -> bindParam(":fileid",$file_id,PDO::PARAM_INT);
                $stm -> bindParam(":token",$token,PDO::PARAM_STR);
                $stm -> bindParam(":expires_at",$expires_at,PDO::PARAM_STR);
                $stm -> execute();
                $_SESSION['errmessAr'] = "تم الحفظ بنجاح";
                header("Location:dashboard-ar.php");
                exit();
            } else {
                $message = "حصل مشكل أثناء رفع الملف";
            }
        }
    }
}
