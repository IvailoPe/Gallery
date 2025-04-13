<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "C:\\xampp\htdocs\project-gallery\src\models\itemModel.php";

$ownerId = $_SESSION["userId"];

$items = retrieveAllItems($ownerId);