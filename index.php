<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$HTTPRequest = $_SERVER["REQUEST_URI"];
$IsLogged = isset($_SESSION["userId"]);


if(!$IsLogged){
    require __DIR__."/src/views/log-regView.php";   
    exit;
}


if($HTTPRequest === "/project-gallery/home" || $HTTPRequest === "/project-gallery/home/time"){
    require __DIR__."/src/views/homeView.php";
    exit;
}
else if($HTTPRequest === "/project-gallery/upload"){
    require __DIR__."/src/views/uploadView.php";
    exit;
}
else if(str_contains($HTTPRequest, "home") && str_contains(explode("/",$HTTPRequest)[3],"item") && !str_contains($HTTPRequest, "buy")){
    $itemId = explode("/",$HTTPRequest)[3];
    require __DIR__."/src/views/itemView.php";
    exit;
}
else if(str_contains($HTTPRequest, "home") && str_contains($HTTPRequest, "buy")){
    $itemId = explode("/",$HTTPRequest)[4];
    require __DIR__."/src/models/itemModel.php";
    buyItem($itemId);
    exit;
}
else if($HTTPRequest === "/project-gallery/profile"){
    require __DIR__."/src/views/profileView.php";
    exit;
}
else if(str_contains($HTTPRequest, "delete")){
    $itemId = explode("/",$HTTPRequest)[3];
    require __DIR__."/src/models/itemModel.php";
    deleteItem($itemId);
    exit;
}
else if(str_contains($HTTPRequest, "edit")){
    $itemId = explode("/",$HTTPRequest)[3];
    require __DIR__."/src/views/editView.php";
    exit;
}
else{
    require __DIR__."/src/views/homeView.php";
    exit;
}

