<?php
include "db.php";
session_start();
/* $id = intval($_GET['id']); */
if ((!isset($_SESSION['userid']) || !is_numeric($_SESSION['userid'])) && (!isset($_COOKIE['dx_userid']))) {
    $_SESSION['mess'] = "You need to logged first for send reports.";
    header("Location:login.php");
    exit();
}
$valid = true;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $uid = intval($_POST['id']);
    $report = trim($_POST['reasonreport']);
    $forfile = trim($_POST['forfile']);
    $lang = $_POST['lang'];
    if (empty($report)) {
        $message = "Type your report first.";
        $valid = false;
    } else {
        $message = "";
        $valid = true;
    }
    if ($valid) {
        $message = "";
        $add = $conn->prepare("INSERT INTO reports (user_id,report_reason) VALUES (:user_id,:report_reason)");
        $add->bindValue(":user_id", $uid, PDO::PARAM_INT);
        if(!empty($forfile)){
            $add->bindValue(":report_reason", $report.' \ '.$forfile);
        }else{
            $add->bindValue(":report_reason", $report);
        }
        $add->execute();
        if($lang == "en"){
            $_SESSION['errmess'] = "Added Report Successfully";
            header("Location:dashboard.php");
        }else{
            $_SESSION['errmess'] = "تمت اضافة البلاغ بنجاح";
            header("Location:dashboard-ar.php");
        }
        exit;
    } else {
        $valid = false;
        $message = "Have a problem in sending the report try again please.";
    }
}