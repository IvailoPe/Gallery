<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="http://localhost/project-gallery/assets/css/profileView.css" />
    <title>Document</title>
    <script defer>
        function redirect(itemId) {
            window.location.href = "/project-gallery/home/" + itemId;
        }

        function redirectToHome() {
            window.location.href = "/project-gallery/home";
        }
    </script>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="http://localhost/project-gallery/home">Home</a>
                </li>
                <li>
                    <a href="http://localhost/project-gallery/src/controller/logOutController.php">Log out</a>
                </li>
                <li>
                    <img onclick='redirectToHome()' style="width: 120px; height: 120px; cursor:pointer;" src="http://localhost/project-gallery/assets/officialSitePic/logo_ivo.png" alt="">
                </li>
                <li>
                    <a href="http://localhost/project-gallery/upload">Post art</a>
                </li>
                <li>
                    <a href="http://localhost/project-gallery/profile">Profile</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="mainSection">
            <?php
            require_once __DIR__ . "/../models/userModel.php";
            $userData = getInfoAboutUser();
            ?>

            <div id="welcomeDiv">
                <h1>Welcome <?php echo $userData["username"] ?></h1>
            </div>
            <div id="profileMainContent">
                <div id="boughtItems">
                    <h3 id="boughtItemsH3">Bought Items</h3>
                    <?php
                    require_once __DIR__ . "/../models/itemModel.php";
                    $boughtItems = retreiveBoughtItems();

                    if (count($boughtItems) === 0) {
                        echo "<h1 style='text-align:center;''>No items to show</h1>";
                    }

                    foreach ($boughtItems as $item) {
                        $itemSrc = $item["fylePath"];
                        $itemTitle = $item["title"];
                        $itemAuthor = $item["userName"];

                        $itemSrc = str_replace("C:/xampp/htdocs", "", $itemSrc);
                        $itemId = json_encode($item["itemId"]);

                        echo "
                      <div onclick='redirect($itemId)' class='item'>
                  <img src='$itemSrc' >
                  <h3>$itemTitle</h3>
                  <h3>$itemAuthor</h3>
                   </div>
                    ";
                    }
                    ?>
                </div>
                <div id="profileStats">
                    <h3 style="text-align: center;">Profile Stats</h3>
                    <h4 style="text-align: center;">Total Credits: <?php echo $userData["credits"] ?>$</h4>
                    <h4 style="text-align: center;">Bought Items: <?php echo $userData["boughtItems"] ?></h4>
                    <h4 style="text-align: center;">Sold items: <?php echo $userData["soldItems"] ?></h4>
                </div>
                <div id="profileItems">
                    <h3 id="profileItemsH3">Your items</h3>
                    <?php
                    require_once __DIR__ . "/../models/itemModel.php";
                    $userItems = retreiveUserItems();

                    $noItems = "";

                    if (count($userItems) === 0) {
                        echo "<h1 style='text-align:center;''>No items to show</h1>";
                    }


                    foreach ($userItems as $item) {
                        $itemSrc = $item["fylePath"];
                        $itemTitle = $item["title"];
                        $itemAuthor = $item["userName"];

                        $itemSrc = str_replace("C:/xampp/htdocs", "", $itemSrc);
                        $itemId = json_encode($item["itemId"]);

                        echo "
                        <div onclick='redirect($itemId)' class='item'>
                        <img src='$itemSrc'>
                        <h3>$itemTitle</h3>
                        <h3>$itemAuthor</h3>
                        </div>
                        ";
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <p>© 2024 Ivailo Petkov. All rights reserved.</p>
    </footer>
</body>

</html>