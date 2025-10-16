<?php
    include "db.php";
    session_start();
    if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
        header("Location:error.php?err=The File id is not available");
        exit();
    }

    $fileId = (int) $_GET['id'];

    $stmt = $conn -> prepare("SELECT * FROM files WHERE id = :id LIMIT 1");
    $stmt -> bindValue(":id",$fileId,PDO::PARAM_INT);
    $stmt -> execute();
    $file = $stmt -> fetch(PDO::FETCH_ASSOC);

    if(!$file){
        header("Location:error.php?err=File Not Found");
        exit();
    }

    $filePath = $file['file_path'];
    $conn -> prepare("UPDATE files SET download_count = download_count + 1 WHERE id = :id") -> execute([':id' => $fileId]);

    header("Content-Description: File Transfer");
    header("Content-Type: application/octet-stream");
    header('Content-Disposition: attachment;filename="'.basename($file['file_path']).'"');
    header('Content-Length:'.filesize($filePath));
    readfile($filePath);
    exit;
?>