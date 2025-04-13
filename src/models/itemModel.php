<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function uploadItemToDB($ownerId, $name, $description,$price, $material, $style, $filePath, $userName){
    require_once "database.php";

    $jsonMaterial = json_encode($material);
    $jsonStyle = json_encode($style);
    date_default_timezone_set('Europe/Sofia');
    $currentDate = date('Y-m-d H:i:s');
    $id = uniqid("item");

    $pdo = new dataBase();
    $isSold = false;

    $pdo->returnConnection()->query("INSERT INTO items (ownerId, price, creationDate, title, description, materials, styles, fylePath, userName, itemId, isSold) VALUES ('$ownerId', '$price', '$currentDate', '$name','$description', '$jsonMaterial', '$jsonStyle', '$filePath', '$userName', '$id', '$isSold ')");
}

function retrieveAllItems($ownerId){
    require_once "database.php";

    $pdo = new dataBase();

    $stmt = $pdo->returnConnection()->query("SELECT * FROM items WHERE ownerId != '$ownerId' AND isSold = FALSE");

    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $items;
}

function retreiveSingleItem($itemId){
    require_once "database.php";

    $pdo = new dataBase();

    $stmt = $pdo->returnConnection()->query("SELECT * FROM items WHERE itemId = '$itemId'");

    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    return $item;
}

function buyItem($itemId){
    require_once "database.php";
    require_once "userModel.php";
     
    $itemData = retreiveSingleItem($itemId);
    $itemId = $itemData["itemId"];
    
    $itemCost = (int)$itemData["price"];
    $itemOwnerId = $itemData["ownerId"];
    $itemBuyerId = $_SESSION["userId"];

    $itemBuyer = getInfoAboutUserForBuying($itemBuyerId);
    $itemSeller = getInfoAboutUserForBuying($itemOwnerId);

    $newSellerBalance = $itemCost + (int)$itemSeller["credits"];
    $newBuyerBalance = (int)$itemBuyer["credits"] - $itemCost;

    $newSellAmountForSeller = (int)$itemSeller["soldItems"] + 1;
    $newBoughtAmountForBuyer = (int)$itemBuyer["boughtItems"] + 1;


    $pdo = new dataBase();

    $isSold = true;
    $price = 0;
    $userName = $itemBuyer["username"];

    $pdo->returnConnection()->query("UPDATE `users` SET `credits`='$newSellerBalance', `soldItems`='$newSellAmountForSeller' WHERE Id = '$itemOwnerId'");
    $pdo->returnConnection()->query("UPDATE `users` SET `credits`='$newBuyerBalance', `boughtItems`='$newBoughtAmountForBuyer' WHERE Id = '$itemBuyerId'");
    $pdo->returnConnection()->query("UPDATE `items` SET `ownerId`='$itemBuyerId',`price`='$price',`userName`='$userName',`isSold`='$isSold' WHERE `itemId` = '$itemId'");

    header('Location: /project-gallery/home');
}

function retreiveBoughtItems(){
    require_once "database.php";
    $pdo = new dataBase();

    $userId = $_SESSION["userId"];

    $stmt = $pdo->returnConnection()->query("SELECT * FROM items WHERE isSold = 1 AND ownerId = '$userId'");

    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $items;
}

function retreiveUserItems(){
    require_once "database.php";
    $pdo = new dataBase();

    $userId = $_SESSION["userId"];

    $stmt = $pdo->returnConnection()->query("SELECT * FROM items WHERE isSold = 0 AND ownerId = '$userId'");

    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $items;
}

function deleteItem($itemId){
    require_once "database.php";
    $pdo = new dataBase();

    $pdo->returnConnection()->query("DELETE FROM items WHERE itemId = '$itemId'");

    header('Location: /project-gallery/home');
}

function editItem($itemId, $name, $description,$price, $material, $style, $filePath){
    require_once "database.php";

    $pdo = new dataBase();

    $jsonMaterial = json_encode($material);
    $jsonStyle = json_encode($style);

    if($filePath){
        $pdo->returnConnection()->query("UPDATE `items` SET `price`='$price',`title`='$name',`description`='$description',`materials`='$jsonMaterial',`styles`='$jsonStyle',`fylePath`='$filePath' WHERE `itemId` = '$itemId'");

    }
    else{
        $pdo->returnConnection()->query("UPDATE `items` SET `price`='$price',`title`='$name',`description`='$description',`materials`='$jsonMaterial',`styles`='$jsonStyle' WHERE `itemId` = '$itemId'");
    }

    header('Location: /project-gallery/home/'.$itemId);
}