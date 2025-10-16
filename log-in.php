<?php
include "db.php";
include "fn.php";
session_start();
$error = "";
$success = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //$uname = text_input($_POST['username']);
    $uemail = text_input($_POST['useremail']);
    $upass = text_input($_POST['userpass']);
    $stmt = $conn->prepare("SELECT * FROM users WHERE userEmail = :userEmail");
    $stmt->bindParam(":userEmail", $uemail);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        if ($user && password_verify($upass, $user['password'])) {
            $_SESSION['userid'] = $user['id'];
            $_SESSION['username'] = $user['userName'];
            $_SESSION['useremail'] = $user['userEmail'];
            $_SESSION['created_at'] = $user['created_at'];
            header("Location:deluxeupload.php");
            exit();
        } else {
            $error = "Wrong Password";
        }
    } else {
        $error = "User not found";
    }
}
?>