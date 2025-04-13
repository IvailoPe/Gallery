<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../models/itemModel.php";

$allowedTypesOfFiles = ['image/jpeg', 'image/png', 'image/jpg'];

$name = $_POST["name"];
$description = $_POST["description"];
$price = $_POST["price"];
$material = $_POST["material"];
$style = $_POST["style"];
$file = $_FILES["galleryPhoto"];
$item = retreiveSingleItem($_SESSION["itemId"]);

$itemId = $item["itemId"];

$folderPath = "C:\\xampp\htdocs\project-gallery\assets\pictures\\";

unset($_SESSION["itemId"]);


if (!($_FILES['galleryPhoto']['error'] === UPLOAD_ERR_NO_FILE)) {
    if(in_array($_FILES['galleryPhoto']['type'], $allowedTypesOfFiles)){
        $filePath = $folderPath . basename($_FILES['galleryPhoto']['name']);
        move_uploaded_file($_FILES['galleryPhoto']['tmp_name'], $filePath);

        $filePathForDb = 'C:/xampp/htdocs/project-gallery/assets/pictures/'.basename($_FILES['galleryPhoto']['name']);
        editItem($itemId,$name,$description,$price,$material,$style,$filePathForDb);
    }
    else{
        editItem($itemId,$name,$description,$price,$material,$style,false);
    }
} else {
    editItem($itemId,$name,$description,$price,$material,$style,false);
}

?>