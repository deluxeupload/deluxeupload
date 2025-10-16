<?php
    include "db.php";
    session_start();

    $id = intval($_GET['id'] ?? $_SESSION['userid'] ?? $_COOKIE['userid']);
    if(!$id){
        $_SESSION['proileErr'] = "You hav to logged first for delete profile picture";
        header("Location:dashborad.php");
        exit();
    }

    $lang = $_GET['lang'];

    $stm = $conn -> prepare("SELECT profile_picture FROM users WHERE id = :id");
    $stm -> bindValue(":id",$id,PDO::PARAM_INT);
    $stm -> execute();
    $user = $stm -> fetch(PDO::FETCH_ASSOC);

    if($user && !empty($user['profile_picture'])){
        $file_path = "profile_picture/".$user['profile_picture'];

        if(file_exists($file_path)){
            unlink($file_path);
        }

        $up = $conn -> prepare("UPDATE users SET profile_picture = NULL WHERE id = :id");
        $up -> bindValue(":id",$id,PDO::PARAM_INT);
        $up -> execute();
        if(isset($lang)){
            if($lang == "en"){
                $_SESSION['profileMess'] = "Profile picture deleted successfully";
                header("Location:dashboard.php");
            }else{
                $_SESSION['profileMess'] = "تم حذف الصورة بنجاح";
                header("Location:dashboard-ar.php");
            }
            exit();
        }
    }else{
        if(isset($lang)){
            if($lang == "en"){
                $_SESSION['profileErr'] = "No profile picture found";
                header("Location:dashboard.php");
            }else{
                $_SESSION['profileErr'] = "لا توجد صورة للحذف";
                header("Location:dashboard-ar.php");
            }
            exit();
        }
    }
    exit();
?>