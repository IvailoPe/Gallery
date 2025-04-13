<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="http://localhost/project-gallery/assets/css/homeView.css" />
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
      <aside id="searchBar">
        <form method="post" action="http://localhost/project-gallery/home">
          <h2 id="searchFormTitle">Search Filter</h4>
            <h4 id="searchFormArtistH4">Artist</h4>
            <input type="radio" id="A" name="artist" value="a">
            <label for="A">A</label>
            <input type="radio" id="B" name="artist" value="b">
            <label for="B">B</label>
            <input type="radio" id="C" name="artist" value="c">
            <label for="C">C</label>
            <input type="radio" id="D" name="artist" value="d">
            <label for="D">D</label>
            <input type="radio" id="E" name="artist" value="e">
            <label for="E">E</label>
            <input type="radio" id="F" name="artist" value="f">
            <label for="F">F</label>
            <input type="radio" id="G" name="artist" value="g">
            <label for="G">G</label>
            <input type="radio" id="H" name="artist" value="h">
            <label for="H">H</label>
            <input type="radio" id="I" name="artist" value="i">
            <label for="I">I</label>
            <input type="radio" id="J" name="artist" value="j">
            <label for="J">J</label>
            <input type="radio" id="K" name="artist" value="k">
            <label for="K">K</label>
            <input type="radio" id="L" name="artist" value="l">
            <label for="L">L</label>
            <input type="radio" id="M" name="artist" value="m">
            <label for="M">M</label>
            <input type="radio" id="N" name="artist" value="n">
            <label for="N">N</label>
            <input type="radio" id="O" name="artist" value="o">
            <label for="O">O</label>
            <input type="radio" id="P" name="artist" value="p">
            <label for="P">P</label>
            <input type="radio" id="Q" name="artist" value="q">
            <label for="Q">Q</label>
            <input type="radio" id="R" name="artist" value="r">
            <label for="R">R</label>
            <input type="radio" id="S" name="artist" value="s">
            <label for="S">S</label>
            <input type="radio" id="T" name="artist" value="t">
            <label for="T">T</label>
            <input type="radio" id="U" name="artist" value="u">
            <label for="U">U</label>
            <input type="radio" id="V" name="artist" value="v">
            <label for="V">V</label>
            <input type="radio" id="W" name="artist" value="w">
            <label for="W">W</label>
            <input type="radio" id="X" name="artist" value="x">
            <label for="X">X</label>
            <input type="radio" id="Y" name="artist" value="y">
            <label for="Y">Y</label>
            <input type="radio" id="Z" name="artist" value="z">
            <label for="Z">Z</label>

            <h4 id="searchFormMaterialH4">Material</h4>
            <div id="searchFormMaterialFlex">
              <input type="checkbox" id="Oil paints" name="material[]" value="Oil paints">
              <label for="Oil paints">Oil paints</label><br>
              <input type="checkbox" id="Acrylic paints" name="material[]" value="Acrylic paints">
              <label for="Acrylic paints">Acrylic paints</label><br>
              <input type="checkbox" id="Watercolors" name="material[]" value="Watercolors">
              <label for="Watercolors">Watercolors</label><br>
              <input type="checkbox" id="Gouache" name="material[]" value="Gouache">
              <label for="Gouache">Gouache</label><br>
            </div>

            <h4 id="searchFormStyleH4">Styles</h4>
            <div id="searchFormStyleFlex">
              <input type="checkbox" id="Realism" name="style[]" value="Realism">
              <label for="Realism">Realism</label>
              <input type="checkbox" id="Impressionism" name="style[]" value="Impressionism">
              <label for="Impressionism">Impressionism</label>
              <input type="checkbox" id="Abstract" name="style[]" value="Abstract">
              <label for="Abstract">Abstract</label>
              <input type="checkbox" id="Surrealism" name="style[]" value="Surrealism">
              <label for="Surrealism">Surrealism</label>
              <input type="checkbox" id="Pop Art" name="style[]" value="Pop Art">
              <label for="Pop Art">Pop Art</label>
              <input type="checkbox" id="Expressionism" name="style[]" value="Expressionism">
              <label for="Expressionism">Expressionism</label>
              <input type="checkbox" id="Landscape" name="style[]" value="Landscape">
              <label for="Landscape">Landscape</label>
              <input type="checkbox" id="Portrait" name="style[]" value="Portrait">
              <label for="Portrait">Portrait</label>
            </div>
            <button>Search</button>
        </form>
      </aside>
      <div id="searchFilter">
        <h3>Show by:</h3>
        <a href="http://localhost/project-gallery/home">Most Popular</a>
        <a href="http://localhost/project-gallery/home/time">Most Recent</a>
      </div>
      <div id="galleries">
        <div id="galleriesCatalog">
          <?php
          require_once __DIR__ . '/../controller/itemController.php';
          if (isset($_POST["artist"]) || isset($_POST["material"]) || isset($_POST["style"]) || $HTTPRequest === "/project-gallery/home/time") {
            if ($HTTPRequest === "/project-gallery/home/time") {
              uasort($items, function ($item1, $item2) {
                return strtotime($item1["creationDate"]) - strtotime($item2["creationDate"]);
              });
              $items = array_reverse($items);
            }

            if (isset($_POST["artist"])) {
              $items = array_filter($items, function ($element) {
                if ($element["userName"][0] === $_POST["artist"]) {
                  return true;
                }
              });
            }
            if (isset($_POST["material"])) {
              $items = array_filter($items, function ($element) {
                $shouldPass = true;
                foreach ($_POST["material"] as $material) {
                  if (!in_array($material, json_decode($element["materials"]))) {
                    $shouldPass = false;
                  }
                }
                if ($shouldPass === false) {
                  return false;
                }
                return true;
              });
            }
            if (isset($_POST["style"])) {
              $items = array_filter($items, function ($element) {
                $shouldPass = true;
                foreach ($_POST["style"] as $style) {
                  if (!in_array($style, json_decode($element["styles"]))) {
                    $shouldPass = false;
                  }
                }
                if ($shouldPass === false) {
                  return false;
                }
                return true;
              });
            }
          }
          if (count($items) === 0) {
            echo "<h1 style='text-align:center;''>No items to show</h1>";
          }

          foreach ($items as $item) {

            $itemName = $item["title"];
            $itemSrc = $item["fylePath"];
            $itemUserName = $item["userName"];
            $itemId = json_encode($item["itemId"]);

            $itemSrc = str_replace("C:/xampp/htdocs", "", $itemSrc);

            echo "
                     <div class='item' onclick='redirect($itemId)'>
                   <img src='$itemSrc' >
                  <h3>$itemName</h3>
                   <h3>$itemUserName</h3>
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