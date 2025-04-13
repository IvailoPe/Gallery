<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="http://localhost/project-gallery/assets/css/itemView.css" />
  <title>Document</title>
  <script defer>
    function buyItem(itemId) {
      window.location.href = "/project-gallery/home/buy/" + itemId;
    }

    function deleteItem(itemId) {
      window.location.href = "/project-gallery/delete/" + itemId;
    }

    function redirectToEdit(itemId) {
      window.location.href = "/project-gallery/edit/" + itemId;
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
      require_once "C:\\xampp\htdocs\project-gallery\src\models\itemModel.php";
      require_once "C:\\xampp\htdocs\project-gallery\src\models\userModel.php";
      $item = retreiveSingleItem($itemId);
      $userData = getInfoAboutUser();
      $userCredits = $userData["credits"];

      $itemSrc = $item["fylePath"];
      $itemTitle = $item["title"];
      $itemDescription = $item["description"];
      $itemMaterials = json_decode($item["materials"]);
      $itemStyles = json_decode($item["styles"]);
      $itemPrice = $item["price"];
      $itemId = json_encode($item["itemId"]);

      $itemSrc = str_replace("C:/xampp/htdocs", "", $itemSrc);

      $materialString = "";
      $stylesString = "";

      $isPriceTooHigh = false;
      $notAllowedToBuy = "";
      $dissableBtn = "";
      $removeBtn = "";
      $addP = "";
      $deleteBtn = "";
      $editBtn = "";


      if ((int)$userCredits < (int)$itemPrice) {
        $isPriceTooHigh = true;
      }

      if ($isPriceTooHigh) {
        $notAllowedToBuy = 'style= "cursor: not-allowed;"';
        $dissableBtn = "disabled";
      }

      if ($item["isSold"]) {
        $removeBtn = 'style= "display: none;"';
        $addP = "<p id='boughtItemText'>You bought this item</p>";
      }

      if ($item["ownerId"] === $_SESSION["userId"] && !$item["isSold"]) {
        $deleteBtn = "<button onclick='deleteItem($itemId)' id='deleteBtn'>Delete</button>";
        $editBtn = "<button onclick='redirectToEdit($itemId)' id='editBtn'>Edit</button>";
        $removeBtn = 'style= "display: none;"';
      }


      foreach ($itemMaterials as $material) {
        $materialString = $materialString . "<p>$material<p>";
      }

      foreach ($itemStyles as $style) {
        $stylesString = $stylesString . "<p>$style<p>";
      }

      echo "
            <img id='itemImg' src='$itemSrc'>
        <div id='itemContent'>
            <h3 id='titleTitle'>Title</h3>
            <p>$itemTitle</p>
            <h3 id='descriptionTitle'>Description</h3>
            <textarea readonly id='description'>$itemDescription</textarea>
            <div id='btnDiv' >
            <button $removeBtn $notAllowedToBuy $dissableBtn id='buyBtn' onclick='buyItem($itemId)'>Buy!</button>
            $deleteBtn
            $editBtn
            </div>
            $addP
            <p $removeBtn id='itemPrice'>Price: $itemPrice$</p>
            <p $removeBtn id='profileCredits'>Profile credits: $userCredits$</p>
        </div>
        <div id='itemCategories'>
            <div id='Materials'>
              <h3>Materials</h3>
              $materialString
            </div>
            <br>
            <div id='Styles'>
              <h3>Styles</h3>
              $stylesString
            </div>
        </div>
            "
      ?>
    </section>
  </main>
  <footer>
    <p>© 2024 Ivailo Petkov. All rights reserved.</p>
  </footer>
</body>

</html>