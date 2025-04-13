<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . "../../models/itemModel.php";

$itemData = retreiveSingleItem($itemId);

$itemMaterials = json_decode($itemData["materials"]);
$itemStyles = json_decode($itemData["styles"]);

$itemSrc = $itemData["fylePath"];

$_SESSION["itemId"] = $itemId;

$itemSrc = str_replace("C:/xampp/htdocs", "", $itemSrc);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="http://localhost/project-gallery/assets/css/uploadView.css" />
    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            function redirectToHome() {
                window.location.href = "/project-gallery/home" ;
            }
            document
                .getElementById("galleryPhoto")
                .addEventListener("change", (e) => {
                    const file = e.target.files[0];
                    const preview = document.getElementById("labelPhoto");
                    const p = document.querySelector(`label[for="galleryPhoto"] p`);

                    if (file) {
                        preview.style.background = `center url(${URL.createObjectURL(
                file
              )})`;
                        p.textContent = "";
                    }
                });
            document.getElementById("uploadForm").addEventListener("submit", function(e) {
                const checkboxesMaterial = document.querySelectorAll("input[name='material[]']");
                const checkboxesStyles = document.querySelectorAll("input[name='style[]']");
                let atLeastOneCheckedMaterial = false;
                let atLeastOneCheckedStyles = false;

                checkboxesMaterial.forEach(checkbox => {
                    if (checkbox.checked) {
                        atLeastOneCheckedMaterial = true;
                    }
                });

                checkboxesStyles.forEach(checkbox => {
                    if (checkbox.checked) {
                        atLeastOneCheckedStyles = true;
                    }
                });

                if (!atLeastOneCheckedMaterial || !atLeastOneCheckedStyles) {
                    e.preventDefault();
                    alert("Please select at least one material or style");
                }
            });
        });
    </script>
    <title>Document</title>
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
            <form id="uploadForm" action="http://localhost/project-gallery/src/controller/editController.php" method="POST" enctype="multipart/form-data">
                <input type="file" id="galleryPhoto" name="galleryPhoto" />
                <label style="background: center / contain no-repeat url( <?php echo $itemSrc ?>);" id="labelPhoto" for="galleryPhoto">
                    <p>Upload here</p>
                </label>
                <div id="materialSbmt">
                    <h3>Material</h3>
                    <label for="Oil paints">Oil paints</label>
                    <input <?php echo in_array('Oil paints', $itemMaterials) === true ? 'checked' : '' ?> type="checkbox" id="Oil paints" name="material[]" value="Oil paints">
                    <label for="Acrylic paints">Acrylic paints</label>
                    <input <?php echo in_array('Acrylic paints', $itemMaterials) === true ? 'checked' : '' ?> type="checkbox" id="Acrylic paints" name="material[]" value="Acrylic paints">
                    <label for="Watercolors">Watercolors</label>
                    <input <?php echo in_array('Watercolors', $itemMaterials) === true ? 'checked' : '' ?> type="checkbox" id="Watercolors" name="material[]" value="Watercolors">
                    <label for="Gouache">Gouache</label>
                    <input <?php echo in_array('Gouache', $itemMaterials) === true ? 'checked' : '' ?> type="checkbox" id="Gouache" name="material[]" value="Gouache">
                </div>
                <div id="mainDescription">
                    <label for="name">Name</label>
                    <input maxlength="23" required type="text" id="name" name="name" value="<?php echo $itemData["title"]; ?>">
                    <label for="description">Description</label>
                    <textarea maxlength="590" required id="description" name="description"><?php echo $itemData["description"]; ?></textarea>
                    <label for="price">Sell price</label>
                    <input required id="price" type="number" name="price" value="<?php echo $itemData["price"]; ?>">
                    <button id="uploadBtn">Edit</button>
                </div>
                <div id="styleSbmt">
                    <h3>Style</h3>
                    <label for="Realism">Realism</label>
                    <input <?php echo in_array('Realism', $itemStyles) === true ? 'checked' : '' ?> type="checkbox" id="Realism" name="style[]" value="Realism">
                    <label for="Impressionism">Impressionism</label>
                    <input <?php echo in_array('Impressionism', $itemStyles) === true ? 'checked' : '' ?> type="checkbox" id="Impressionism" name="style[]" value="Impressionism">
                    <label for="Abstract">Abstract</label>
                    <input <?php echo in_array('Abstract', $itemStyles) === true ? 'checked' : '' ?> type="checkbox" id="Abstract" name="style[]" value="Abstract">
                    <label for="Surrealism">Surrealism</label>
                    <input <?php echo in_array('Surrealism', $itemStyles) === true ? 'checked' : '' ?> type="checkbox" id="Surrealism" name="style[]" value="Surrealism">
                    <label for="Pop Art">Pop Art</label>
                    <input <?php echo in_array('Pop Art', $itemStyles) === true ? 'checked' : '' ?> type="checkbox" id="Pop Art" name="style[]" value="Pop Art">
                    <label for="Expressionism">Expressionism</label>
                    <input <?php echo in_array('Expressionism', $itemStyles) === true ? 'checked' : '' ?> type="checkbox" id="Expressionism" name="style[]" value="Expressionism">
                    <label for="Landscape">Landscape</label>
                    <input <?php echo in_array('Landscape', $itemStyles) === true ? 'checked' : '' ?> type="checkbox" id="Landscape" name="style[]" value="Landscape">
                    <label for="Portrait">Portrait</label>
                    <input <?php echo in_array('Portrait', $itemStyles) === true ? 'checked' : '' ?> type="checkbox" id="Portrait" name="style[]" value="Portrait">
                </div>
            </form>
        </section>
    </main>
    <footer>
        <p>© 2024 Ivailo Petkov. All rights reserved.</p>
    </footer>
</body>

</html>