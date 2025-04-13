<?php 
require_once "../models/userModel.php";
require_once "../models/database.php";

$username = $_POST["username"];
$password = $_POST["password"];

$error = [];

if (strlen($username) === 0 || strlen($username) > 10) {
    array_push($error, strlen($username) === 0 ? "Username is empty" : "Username is above 10 chars");
}

if (strlen($password)  === 0 || strlen($password) > 10) {
    array_push($error, strlen($password) === 0 ? "Password is empty" : "Password is above 10 chars");
}

if (count($error) !== 0) {
    echo json_encode([
        'redirect' => '/project-gallery/',
        'errors' => $error
    ]);
    exit;
}


$userData = logUser($username, $password);

if($userData === false){
    echo json_encode([
        'error' => "Wrong password"
    ]);
    exit;
}
else{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION["userId"] = $userData["id"];
    $_SESSION["username"] = $userData["username"];
    echo json_encode("success");
    exit;
}