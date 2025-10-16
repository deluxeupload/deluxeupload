<?php
include "db.php";
session_start();
if (isset($_GET['id']) || is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $userID = $_SESSION['userid'] ?? $_COOKIE['dx_userid'] ?? null;

    $lang = $_GET['lang'];

    if (!$userID) {
        if (isset($lang)) {
            if ($lang == "en") {
                $_SESSION['errmess'] = "User Not Found";
                header("Location:dashboard.php");
            } else {
                $_SESSION['errmess'] = "لم يتم ايجاد المستخدم";
                header("Location:dashboard-ar.php");
            }
            exit();
        }
    }


    $stmt = $conn->prepare("SELECT * FROM files WHERE id = :id AND user_id = :uid LIMIT 1");
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->bindValue(":uid", $userID);
    $stmt->execute();
    $file = $stmt->fetch(PDO::FETCH_ASSOC);

    $filePath = "uploads/" . $file['file_path'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    $del = $conn->prepare("DELETE FROM files WHERE id = :id");
    $del->bindValue(":id", $id, PDO::PARAM_INT);
    $del->execute();
    if (isset($lang)) {
        if ($lang == "en") {
            $_SESSION['errmess'] = "Deleted file Successfully";
            header("Location:dashboard.php");
        } else {
            $_SESSION['errmess'] = "تم حذف الملف بنجاح";
            header("Location:dashboard-ar.php");
        }
        exit();
    }
}
?>