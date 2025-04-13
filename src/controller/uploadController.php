<?php
session_start();

require_once "../models/itemModel.php";

$allowedTypesOfFiles = ['image/jpeg', 'image/png', 'image/jpg'];

$name = $_POST["name"];
$description = $_POST["description"];
$price = $_POST["price"];
$material = $_POST["material"];
$style = $_POST["style"];
$file = $_FILES["galleryPhoto"];

$folderPath = "C:\\xampp\htdocs\project-gallery\assets\pictures\\";

if(in_array($_FILES['galleryPhoto']['type'], $allowedTypesOfFiles)){
    $filePath = $folderPath . basename($_FILES['galleryPhoto']['name']);
    move_uploaded_file($_FILES['galleryPhoto']['tmp_name'], $filePath);
    
    $ownerId = $_SESSION["userId"];
    $userName = $_SESSION["username"];

    $filePathForDb = 'C:/xampp/htdocs/project-gallery/assets/pictures/'.basename($_FILES['galleryPhoto']['name']);

    uploadItemToDB($ownerId,$name,$description,$price,$material,$style,$filePathForDb,$userName);

    header('Location: /project-gallery/home');

}
else{
    header('Location: /project-gallery/upload');
}