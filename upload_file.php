<?php
include "db.php";
session_start();
$message = "";
if ((!isset($_SESSION['userid']) || !is_numeric($_SESSION['userid'])) && (!isset($_COOKIE['dx_userid']) || !is_numeric($_COOKIE['dx_userid']))) {
    $_SESSION['mess'] = "You need to logged first for upload file.";
    header("Location:login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['userfile'])) {
    $target_dir = "uploads/";
    $org_name = basename($_FILES['userfile']['name']);
    $file_ext = strtolower(pathinfo($org_name,PATHINFO_EXTENSION));
    $unique_name = uniqid()."_deluxeupload_".$org_name;
    $target_file = $target_dir . $unique_name;
    $file_size = $_FILES['userfile']['size'];
    $uploadOk = true;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    /* if (file_exists($target_file)) {
        $message = "The file is exist";
        $uploadOk = false;
    } */
    $maxSize = 100 * 1024 * 1024;
    if ($_FILES['userfile']['size'] > $maxSize) {
        $message = "The file is large";
        $uploadOk = false;
    }

    $allowed = ['zip', 'rar', 'pdf', 'jpg', 'jpeg', 'png', 'svg', 'gif', 'docx', 'pptx','txt','csv','mp4','mp3','xlsx'];
    if (!in_array($fileType, $allowed)) {
        $message = "We are not allow this file";
        $uploadOk = false;
    }

    $_SESSION['file_name'] = $org_name;
    $_SESSION['file_type'] = $file_ext;
    $_SESSION['file_size'] = $file_size;
    $userId = intval($_SESSION['userid'] ?? $_COOKIE['dx_userid']);
    if ($uploadOk == true) {
        if (!isset($userId)) {
            $message = "You need to logged for upload your file";
        } else {
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $target_file)) {
                $message = "Uploaded Successfully <a href='myfiles.php'>My files</a>" . htmlspecialchars(basename($_FILES['userfile']['name']));
                $up = $conn->prepare('INSERT INTO files (user_id,file_name,file_path,file_size) VALUES (:user_id,:file_name,:file_path,:file_size)');
                $up->bindValue(":user_id", $userId, PDO::PARAM_INT);
                $up->bindValue(":file_name", $org_name);
                $up->bindValue(":file_path", $target_file);
                $up->bindValue(":file_size", $file_size);
                $up->execute();
                $file_id = $conn -> lastInsertId();
                $token = bin2hex(random_bytes(16));
                $expires_at = date('Y-m-d H:i:s',strtotime('+30 days'));
                $stm = $conn -> prepare("INSERT INTO temp_link (file_id,token,expires_at) VALUES (:fileid,:token,:expires_at)");
                $stm -> bindParam(":fileid",$file_id,PDO::PARAM_INT);
                $stm -> bindParam(":token",$token,PDO::PARAM_STR);
                $stm -> bindParam(":expires_at",$expires_at,PDO::PARAM_STR);
                $stm -> execute();
                $_SESSION['errmess'] = "Sauvegarde Successfully";
                header("Location:dashboard.php");
                exit();
            } else {
                $message = "Has a problem at upload your file";
            }
        }
    }
}
?>