<?php
include "db.php";
include "fn.php";
session_start();
if ((!isset($_SESSION['userid']) || !is_numeric($_SESSION['userid'])) && (!isset($_COOKIE['dx_userid']) || !is_numeric($_COOKIE['dx_userid']))) {
    header("Location:error.php?err=User not found");
    exit();
}

$id = intval($_SESSION['userid'] ?? $_COOKIE['dx_userid']);
$stm = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stm->bindValue(":id", $id, PDO::PARAM_INT);
$stm->execute();
$user = $stm->fetch();
$isValid = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $pass = text_input($_POST['password']);
    if (empty($pass)) {
        $_SESSION['delErr'] = "The password is obligatory";
        $isValid = false;
    } else {
        if ($user && password_verify($pass, $user['password'])) {
            $isValid = true;
        } else {
            $isValid = false;
        }
    }

    if ($isValid) {
        $conn->beginTransaction();
        try {
            session_unset();
            session_destroy();
            setcookie('dx_username', '', time() - 3600, '/');
            setcookie('dx_useremail', '', time() - 3600, '/');
            setcookie('dx_userid', '', time() - 3600, '/');
            $del = $conn->prepare("DELETE FROM users WHERE id = :id");
            $del->bindValue(":id", $id, PDO::PARAM_INT);
            $del->execute();

            $delFiles = $conn->prepare("DELETE FROM files WHERE user_id = :userid");
            $delFiles->bindValue(":userid", $id, PDO::PARAM_INT);
            $delFiles->execute();
            $getFiles = $conn -> prepare("SELECT file_path FROM files WHERE user_id = :id");
            $getFiles -> bindValue(":id",$id,PDO::PARAM_INT);
            $getFiles -> execute();
            $files = $getFiles -> fetchAll();

            $filePath = $file['file_path'];
            foreach($files as $file){
                if(file_exists($file['file_path'])){
                    unlink($filePath);
                }
            }

            $getProfilePicture = $conn -> prepare("SELECT profile_picture FROM users WHERE id = :id");
            $getProfilePicture -> bindValue(":id",$id,PDO::PARAM_INT);
            $getProfilePicture -> execute();
            $profilePictures = $getProfilePicture -> fetchAll();

            $pPicturePath = $profile['profile_picture'];
            foreach($profilePictures as $profile){
                if(file_exists($profile['profile_picture'])){
                    unlink($pPicturePath);
                }
            }
            $delReps = $conn->prepare("DELETE FROM reports WHERE user_id = :id");
            $delReps->bindValue(":id", $id, PDO::PARAM_INT);
            $delReps->execute();
            $conn->commit();
            session_start();
            $_SESSION['delSucc'] = "Deleted user successfully";
            header("Location:login.php");
            exit();
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['delErr'] = "Failed delete user : " . $e->getMessage();
        }
    } else {
        $_SESSION['delErr'] = "Failed delete user";
    }
}
?>