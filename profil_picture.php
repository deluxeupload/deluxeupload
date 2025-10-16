<?php
    include "db.php";
    session_start();
    if(!isset($_GET['id']) && !isset($_SESSION['userid']) && !isset($_COOKIE['dx_userid'])){
        header("Location:error.php?err=User not found.");
        exit();
    }

    $id = intval($_GET['id'] ?? $_SESSION['userid'] ?? $_COOKIE['dx_userid']);
    $lang = $_GET['lang'];

    $_SESSION['profileMess'] = "";
    $_SESSION['profileErr'] = "";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $target_dir = "profile_picture/";
        $org_name = basename($_FILES['profile_picture']['name']);
        $file_ext = strtolower(pathinfo($org_name,PATHINFO_EXTENSION));
        $unique_name = $org_name;
        $target_file = $target_dir . $unique_name;
        $uploadOk = true;
        $file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $allowed = ["jpg","jpeg"];
        if(!in_array($file_type,$allowed)){
            $_SESSION['profileErr'] = "We are not allowed this type.";
            $uploadOk = false;
        }

        $userid = $_SESSION['userid'] ?? $_COOKIE['dx_userid'];
        if($uploadOk){
            if(!$userid){
                $_SESSION['profileErr'] = "You have to logged first for add a profile picture.";
                $uploadOk = false;
            }else{
                if(move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)){
                    $up = $conn -> prepare("UPDATE users SET profile_picture = :profilePicture WHERE id = :id");
                    $up -> bindValue(":id",$id,PDO::PARAM_INT);
                    $up -> bindValue(":profilePicture",$unique_name,PDO::PARAM_STR);
                    $up -> execute();
                    if(isset($lang)){
                        if($lang == "en"){
                            $_SESSION['profileMess'] = "Profile picture added successfully";
                            header("Location:dashboard.php");
                        }else{
                            $_SESSION['profileMess'] = "تم حفظ الصورة بنجاح";
                            header("Location:dashboard-ar.php");

                        }
                        exit();
                    }
                }
                else{
                    if(isset($lang)){
                        if($lang == "en"){
                            $_SESSION['profileErr'] = "Has a problem at add profile picture";
                            header("Location:dahsboard.php");
                        }else{
                            $_SESSION['profileErr'] = "حدث مشكل أثناء رفع الصورة";
                            header("Location:dahsboard.php");
                        }
                    }
                }
            }
        }else{
            $_SESSION['profileErr'] = "Failed to upload profile picture";
            header("Location:dashboard.php");
            exit();
        }
    }
?>