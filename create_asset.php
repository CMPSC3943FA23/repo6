<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <title>Create New Asset - Hobby Harmony</title>
    <style>
        #page-header {
            display: none;
        }
    </style>
    <?php // dummy block ?>
</head>

<body>
    <div class="container">
        <div class="col">
            <div id="page-header" class="pt-4 pb-4 row">
                <h1>Create new asset</h1>
            </div>
            <!-- Modified by Sidney -->
            <!-- For some reason, things weren't lining up right until I added a col inside each row. -->
            <form action="submit_asset.php" method="post" enctype="multipart/form-data">
                <div class="pt-2 pb-2 row">
                    <div class="col">
                        <label for="friendly-name">Name Of Asset</label>
                        <input type="text" class="form-control" name="friendly-name" id="friendly-name" placeholder="Name Your Asset" required>
                    </div>
                </div>
                <div class="pt-2 pb-2 row">
                    <div class="col">
                        <label for="manufacturer">Manufacturer</label>
                        <input type="text" class="form-control" name="manufacturer" id="manufacturer" placeholder="Name Of Manufacturer">
                    </div>
                </div>
                <div class="pt-2 pb-2 row">
                    <div class="col">
                        <label for="model">Model</label>
                        <input type="text" class="form-control" name="model" id="model" placeholder="Name Of Model">
                    </div>
                </div>
                <div class="pt-2 pb-2 row">
                    <div class="col">
                        <label for="asset-type">Type Of Asset</label>
                        <input type="text" class="form-control" name="asset-type" id="asset-type" placeholder="Name Of Asset Type">
                    </div>
                </div>
                <div class="pt-2 pb-2 row">
                    <div class="col">
                        <label for="location">Location Of Asset</label>
                        <input type="text" class="form-control" name="location" id="location" placeholder="Location Of Asset">
                    </div>
                </div>
                <div class="pt-2 pb-2 row">
                    <div class="col">
                        <!-- Simple check for filesize -->
                        <input type="hidden" name="MAX_FILE_SIZE" value="16777215">
                        <label for="photo">Custom Photo</label>
                        <input type="file" class="form-control" name="photo" id="photo" placeholder="Custom Photo" accept="image/png, image/gif, image/jpeg">
                    </div>
                </div>
                <!-- Added by Sidney for category support -->
                <div class="pt-2 pb-2 row">
                    <label for="category">Category</label>
                    <div class="d-flex">
                        <select id="category" name="category" class="form-select" style="display: inline;">
                            <option id="cat-blank" value="">Populating list...</option>
                        </select>
                        <span id="refresh-button" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></span> <!-- We don't want to use a button because we don't want to submit -->
                        <span id="edit-button" class="btn btn-secondary"><i class="bi bi-pencil-square"></i></span>
                    </div>
                </div>
                <div class="pt-2 pb-2 row">
                    <div class="col">
                        <button type="submit" class="btn btn-success mb-2">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        //let hasLoaded = false // no longer necessary
        const catBox = document.getElementById("category")
        const refreshButton = document.getElementById("refresh-button")
        const editButton = document.getElementById("edit-button")

        // Populate when the list box is clicked, but only if it hasn't been populated yet
        // This is disabled because, while it technically works most of the time, it's glitchy and doesn't work at all in Safari
        //catBox.addEventListener("click", function() {if (hasLoaded == false) {populateList()}})

        addEventListener("load", function() {
            // Remove the header if this is a pop-up window
            const urlParams = new URLSearchParams(window.location.search)
            const title = urlParams.get("title")
            if (title != "false") {
                document.getElementById("page-header").style.display = "block"
            }
            populateList() // Populate when the page is loaded
        })
        // Populate when the refresh button is clicked
        refreshButton.addEventListener("click", populateList)
        // Open categories page when the edit button is clicked
        editButton.addEventListener("click", function() {open("show_categories.php")})

        function populateList() {
            catBox.innerHTML = "<option id=\"cat-blank\" value=\"\">Populating list...</option>" // Reset innerHTML of cat-box to its original value

            const xhr = new XMLHttpRequest()
            xhr.responseType = "json"

            xhr.onload = function() {
                const catList = xhr.response

                // Draw each option
                for (let cat of catList) {
                    const newOption = document.createElement("option")
                    newOption.value = cat["ID"]
                    newOption.innerHTML = cat["Title"]
                    catBox.appendChild(newOption)
                }

                const catBlank = document.getElementById("cat-blank")
                catBlank.innerHTML = ""
            }

            xhr.open("GET", "retr_categories.php")
            xhr.send()
            
            //hasLoaded = true // no longer necessary
        }
    </script>
</body>

</html>