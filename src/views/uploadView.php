<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="http://localhost/project-gallery/assets/css/uploadView.css" />
    <script defer>
        function redirectToHome() {
                window.location.href = "/project-gallery/home";
        }

        document.addEventListener("DOMContentLoaded", () => {
            document
                .getElementById("galleryPhoto")
                .addEventListener("change", (e) => {
                    const file = e.target.files[0];
                    const preview = document.getElementById("labelPhoto");
                    const p = document.querySelector(`label[for="galleryPhoto"] p`);

                    if (file) {
                        preview.style.background = `center / contain no-repeat url(${URL.createObjectURL(
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
            <form id="uploadForm" action="http://localhost/project-gallery/src/controller/uploadController.php" method="POST" enctype="multipart/form-data">
                <input required type="file" id="galleryPhoto" name="galleryPhoto" />
                <label id="labelPhoto" for="galleryPhoto">
                    <p>Upload here</p>
                </label>
                <div id="materialSbmt">
                    <h3>Material</h3>
                    <label for="Oil paints">Oil paints</label>
                    <input type="checkbox" id="Oil paints" name="material[]" value="Oil paints">
                    <label for="Acrylic paints">Acrylic paints</label>
                    <input type="checkbox" id="Acrylic paints" name="material[]" value="Acrylic paints">
                    <label for="Watercolors">Watercolors</label>
                    <input type="checkbox" id="Watercolors" name="material[]" value="Watercolors">
                    <label for="Gouache">Gouache</label>
                    <input type="checkbox" id="Gouache" name="material[]" value="Gouache">
                </div>
                <div id="mainDescription">
                    <label for="name">Name</label>
                    <input maxlength="23" placeholder="Enter a name" required type="text" id="name" name="name">
                    <label for="description">Description</label>
                    <textarea maxlength="590" placeholder="Enter a description" required id="description" name="description"></textarea>
                    <label for="price">Sell price</label>
                    <input placeholder="Enter a price" required id="price" type="number" name="price">
                    <button id="uploadBtn">Submit</button>
                </div>
                <div id="styleSbmt">
                    <h3>Style</h3>
                    <label for="Realism">Realism</label>
                    <input type="checkbox" id="Realism" name="style[]" value="Realism">
                    <label for="Impressionism">Impressionism</label>
                    <input type="checkbox" id="Impressionism" name="style[]" value="Impressionism">
                    <label for="Abstract">Abstract</label>
                    <input type="checkbox" id="Abstract" name="style[]" value="Abstract">
                    <label for="Surrealism">Surrealism</label>
                    <input type="checkbox" id="Surrealism" name="style[]" value="Surrealism">
                    <label for="Pop Art">Pop Art</label>
                    <input type="checkbox" id="Pop Art" name="style[]" value="Pop Art">
                    <label for="Expressionism">Expressionism</label>
                    <input type="checkbox" id="Expressionism" name="style[]" value="Expressionism">
                    <label for="Landscape">Landscape</label>
                    <input type="checkbox" id="Landscape" name="style[]" value="Landscape">
                    <label for="Portrait">Portrait</label>
                    <input type="checkbox" id="Portrait" name="style[]" value="Portrait">
                </div>
            </form>
        </section>
    </main>
    <footer>
        <p>© 2024 Ivailo Petkov. All rights reserved.</p>
    </footer>
</body>

</html>