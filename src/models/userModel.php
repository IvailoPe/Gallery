<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function registerUser($username, $password)
{
    require_once "database.php";

    $pdo = new dataBase();

    $id = uniqid();
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    if (checkIfUserExists($username, $pdo)) {
        return false;
    }

    $startCredits = 1000;

    $username = strtolower($username);

    $pdo->returnConnection()->query("INSERT INTO users (Id, username, password, credits) VALUES ('$id', '$username', '$hashedPassword','$startCredits')");

    return [
        "id" => $id,
        "username" => $username
    ];
}

function checkIfUserExists($username, $pdo)
{
    $stmt = $pdo->returnConnection()->query("SELECT username FROM users WHERE username='$username'");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        return true;
    }
    return false;
}

function logUser($username, $password)
{

    require_once "database.php";

    $pdo = new dataBase();

    if (checkIfUserExists($username, $pdo) === false) {
        echo json_encode([
            'error' => "User doesnt exists"
        ]);
        exit;
    }

    $stmt = $pdo->returnConnection()->query("SELECT * FROM users WHERE username='$username'");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($password, $row["password"])) {
        return [
            "id" => $row["Id"],
            "username" => $row["username"]
        ];
    } else {
        return false;
    }
}

function getInfoAboutUser()
{
    require_once "database.php";

    $userId = $_SESSION["userId"];

    $pdo = new dataBase();

    $stmt = $pdo->returnConnection()->query("SELECT * FROM users WHERE Id='$userId'");

    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    return $userData;
}

function getInfoAboutUserForBuying($userId)
{
    require_once "database.php";

    $pdo = new dataBase();

    $stmt = $pdo->returnConnection()->query("SELECT * FROM users WHERE Id='$userId'");

    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    return $userData;
}
