<?php
include "db.php";
session_start();
if ((!isset($_SESSION['userid']) || !is_numeric($_SESSION['userid'])) && (!isset($_COOKIE['dx_userid']) || !is_numeric($_COOKIE['dx_userid']))) {
    $_SESSION['mess'] = "You have to logged first for show dashboard.";
    header("Location:login.php");
    exit();
} else {
    $userid = $_SESSION['userid'] ?? $_COOKIE['dx_userid'];

    $stmt = $conn->prepare("SELECT * FROM files WHERE user_id = :user_id ORDER BY upload_date DESC");
    $stmt->bindValue(":user_id", $userid, PDO::PARAM_INT);
    $stmt->execute();
    $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stm = $conn->prepare("SELECT * FROM reports WHERE user_id = :id");
    $stm->bindValue(":id", $userid, PDO::PARAM_INT);
    $stm->execute();
    $reps = $stm->fetchAll(PDO::FETCH_ASSOC);



    $filesicons = [
        'pdf' => 'outils/types_icon/pdf.svg',
        'png' => 'outils/types_icon/png.svg',
        'jpg' => 'outils/types_icon/jpg.svg',
        'jpeg' => 'outils/types_icon/jpeg.svg',
        'gif' => 'outils/types_icon/gif.svg',
        'docs' => 'outils/types_icon/docs.svg',
        'pptx' => 'outils/types_icon/pptx.svg',
        'zip' => 'outils/types_icon/zip.svg',
        'rar' => 'outils/types_icon/rar.svg',
        'svg' => 'outils/types_icon/svg.svg',
        'csv' => 'outils/types_icon/csv.svg',
        'mp4' => 'outils/types_icon/mp4.svg',
        'mp3' => 'outils/types_icon/mp3.svg'
    ];
}
