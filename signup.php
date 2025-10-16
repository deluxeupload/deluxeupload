<?php
include 'db.php';
include 'fn.php';
session_start();
$isValid = false;
$errMesage = $succMessage = "";
$randomNumber = rand(100,9999);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = text_input($_POST['username']);
    $email = text_input($_POST['useremail']);
    $password = text_input($_POST['userpass']);
    if (empty($name) || empty($email) || empty($password)) {
        $errMesage = "Name, email and password is empty";
        $isValid = false;
    } else {
        $search = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $uniqueName = $name ."_". $randomNumber;
        $search->bindParam(":username", $uniqueName);
        $search->execute();
        $userCheck = $search->fetchColumn();

        if ($userCheck) {
            $errMesage = "User is already exist";
            $isValid = false;
        }else{
            $isValid = true;
        }
    }
}
if ($isValid) {
    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
    $_SESSION['newsign'] = "Savegarde Successfully";
    $stmt = $conn->prepare("INSERT INTO users (userName,userEmail,password) VALUES (:userName,:useremail,:password)");
    $stmt->bindParam(":userName", $uniqueName);
    $stmt->bindParam(":useremail", $email);
    $stmt->bindParam(":password", $hashedPass);
    $stmt->execute();
    $_SESSION['signup'] = "Your signed successfully";
    header("Location:login.php");
    exit();
}
?>