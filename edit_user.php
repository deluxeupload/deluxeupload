<?php
include "db.php";
include "fn.php";
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['editmess'] = "You don't logged at site";
    header("Location:login.php");
    exit();
}
$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$rows) {
    $_SESSION['editmess'] = "User not found.";
    header("Location:login.php");
    exit();
}

$isValid = true;
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nid = intval($_POST['nuserid']);
    $nname = text_input($_POST['nusername']);
    $nemail = text_input($_POST['nuseremail']);
    $npass = text_input($_POST['nuserpass']);
    $errName = "";
    $errEmail = "";
    $errPass = "";
    $passPattern = "/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[&$]).{6,}$/";
    if ($nname == "") {
        $errName = "* Type your full name";
        $isValid = false;
    }
    if ($nemail == "") {
        $errEmail = "* Type your email";
        $isValid = false;
    } else {
        if (!filter_var($nemail, FILTER_VALIDATE_EMAIL)) {
            $errEmail = "* Type a correct email";
            $isValid = false;
        }
    }
    if ($npass == "") {
        $errPass = "* Type your password";
        $isValid = false;
    } else {
        if (!preg_match($passPattern, $npass)) {
            $errPass = "* Type a correct password";
            $isValid = false;
        }
    }
    if ($isValid) {
        $sql = "UPDATE users SET userName = :username, userEmail = :useremail";
        if (!empty($npass)) {
            $hashedpass = password_hash($npass, PASSWORD_DEFAULT);
            $sql .= ",password = :upassword";
        }

        $sql .= " WHERE id = :id";

        $up = $conn->prepare($sql);
        $up->bindValue(":username", $nname);
        $up->bindValue(":useremail", $nemail);
        $up->bindValue(":id", $nid, PDO::PARAM_INT);

        if (!empty($npass)) {
            $up->bindValue(":upassword", $hashedpass);
        }

        $up->execute();

        $_SESSION['editmess'] = "Sauvegard Successfully";
        echo json_encode(['success' => true, 'message' => 'Saved Successfully']);
        /* session_unset($_SESSION['username']);
    session_unset($_SESSION['useremail']);
    session_unset($_SESSION['userpass']);
    session_unset($_SESSION['userid']); */
        session_unset();
        session_destroy();
        header("Location:login.php");
        exit();
    }else{
        $_SESSION['editmess'] = "Sauvegarde declined";
        exit();
    }
}
