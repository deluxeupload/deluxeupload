<?php
include "db.php";
session_start();
if ((!isset($_GET['id']) || !is_numeric($_GET['id'])) && (!isset($_SESSION['dx_userid'])) && (isset($_COOKIE['dx_userid']))) {
    die("User not found");
} else {
    $lang = $_GET['lang'];
    $rid = intval($_GET['id']);
    $id = intval($_SESSION['userid'] ?? $_COOKIE['dx_userid']);
    $sql = $conn->prepare("DELETE FROM reports WHERE id = :repid AND user_id = :userid");
    $sql->bindParam(":repid", $rid, PDO::PARAM_INT);
    $sql->bindParam(":userid", $id, PDO::PARAM_INT);
    $sql->execute();
    if (isset($lang)) {
        if ($lang == "en") {
            $_SESSION['errmess'] = "Deleted report successfully";
            header("Location:dashboard.php");
        } else {
            $_SESSION['errmess'] = "تم حذف البلاغ بنجاح";
            header("Location:dashboard-ar.php");
        }
    }
    exit();
}
