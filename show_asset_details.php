<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Details - Hobby Harmony</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include("include/incl_navbar.php"); ?>
    <div class="container mt-5">
        <div class="row">
            <p><button id="edit-button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-form"><i class="bi bi-pencil-square"></i></button></p>
            <h2>Asset details for: <span class="asset-header"></span></h2>
            <?php include("modify_asset.php"); ?>
        </div>
        <div class="row">
            <div id="asset-photo" class="col-md-6">
                <p>Loading...</p>
            </div>
            <div class="col-md-6">
                <p>ID: <span id="asset-id"></span></p>
                <p>Name: <span id="asset-name"></span></p>
                <p>Manufacturer: <span id="asset-manufacturer"></span></p>
                <p>Model: <span id="asset-model"></span></p>
                <p>Type: <span id="asset-type"></span></p>
                <p>Location: <span id="asset-location"></span></p>
                <p>Category: <span id="asset-category"></span></p>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-form">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h4>Editing: <span class="asset-header"></span></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <form method="post" enctype="multipart/form-data"> <!-- Not setting an action means the form will submit to itself -->
            <div class="modal-body">
              <div class="pt-2 pb-2 row">
                  <div class="col">
                      <!-- So the form handler knows what asset is being modified -->
                      <input type="hidden" name="current-id" id="current-id" value="">
                      <label for="friendly-name">Name of asset</label>
                      <input type="text" class="form-control" name="friendly-name" id="friendly-name" placeholder="My Laptop" spellcheck="true" required>
                  </div>
              </div>
              <div class="pt-2 pb-2 row">
                  <div class="col">
                      <label for="manufacturer">Manufacturer</label>
                      <input type="text" class="form-control" name="manufacturer" id="manufacturer" placeholder="Dell" spellcheck="true">
                  </div>
              </div>
              <div class="pt-2 pb-2 row">
                  <div class="col">
                      <label for="model">Model</label>
                      <input type="text" class="form-control" name="model" id="model" placeholder="XPS 15-9500" spellcheck="true">
                  </div>
              </div>
              <div class="pt-2 pb-2 row">
                  <div class="col">
                      <label for="asset-type">Type of asset</label>
                      <input type="text" class="form-control" name="type" id="type" placeholder="Computer" spellcheck="true">
                  </div>
              </div>
              <div class="pt-2 pb-2 row">
                  <div class="col">
                      <label for="location">Location of asset</label>
                      <input type="text" class="form-control" name="location" id="location" placeholder="Home" spellcheck="true">
                  </div>
              </div>
              <div class="pt-2 pb-2 row">
                  <div class="col">
                      <!-- Simple check for filesize -->
                      <input type="hidden" name="MAX_FILE_SIZE" value="16777215">
                      <label for="photo">Custom photo</label>
                      <input type="file" class="form-control" name="photo" id="photo" placeholder="Custom Photo" accept="image/png, image/gif, image/jpeg">
                      <!-- Stores the current photo to keep it from getting cleared on an empty submit -->
                      <input type="hidden" name="current-photo" id="current-photo" value="">
                  </div>
              </div>
              <!-- Added by Sidney for category support -->
              <div class="pt-2 pb-2 row">
                  <label for="category">Category</label>
                  <div class="d-flex">
                      <select id="category" name="category" class="form-select" style="display: inline;">
                          <option id="cat-blank" value="">Populating list...</option>
                      </select>
                      <button type="button" id="cat-refresh-button" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></span>
                      <button type="button" id="cat-edit-button" class="btn btn-secondary"><i class="bi bi-pencil-square"></i></span>
                  </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
        // Script for filling asset data

        const urlParams = new URLSearchParams(window.location.search)
        const id = urlParams.get("id")

        // Static elements
        const $assetHeader = $(".asset-header")
        const $assetID = $("#asset-id")
        const $assetName = $("#asset-name")
        const $assetPhoto = $("#asset-photo")
        const $assetManufacturer = $("#asset-manufacturer")
        const $assetModel = $("#asset-model")
        const $assetType = $("#asset-type")
        const $assetLocation = $("#asset-location")
        const $assetCategory = $("#asset-category")

        // Form elements
        const $formID = $("#current-id")
        const $formName = $("#friendly-name")
        const $formManufacturer = $("#manufacturer")
        const $formModel = $("#model")
        const $formType = $("#type")
        const $formLocation = $("#location")
        const $formCurrentPhoto = $("#current-photo")
        const $formCategory = $("#category")

        let assetCatID  // so we can use the ID in another scope

        const xhrAsset = new XMLHttpRequest()
        xhrAsset.responseType = "json"

        xhrAsset.onload = function() {
            const asset = xhrAsset.response[0]
            if (!asset) {
                $assetHeader.html("Invalid asset ID")
                $assetPhoto.html("")
                return // Quit processing when invalid asset
            }

            $assetHeader.html(asset.AssetName)

            if (asset.AssetPhoto) {
                $assetPhoto.html("<img src='uploads/" + asset.AssetPhoto + "' alt='" + asset.AssetPhoto + "' style='width: 100%'>")
            }
            else {
                $assetPhoto.html("<h5>There is no image for this asset.</h5>")
            }

            $assetID.html(asset.AssetID)
            $assetName.html(asset.AssetName)
            $assetManufacturer.html(asset.AssetManufacturer)
            $assetModel.html(asset.AssetModel)
            $assetType.html(asset.AssetType)
            $assetLocation.html(asset.AssetLocation)
            $assetCategory.html(asset.CatTitle)

            $formID.val(asset.AssetID)
            $formName.val(asset.AssetName)
            $formManufacturer.val(asset.AssetManufacturer)
            $formModel.val(asset.AssetModel)
            $formType.val(asset.AssetType)
            $formLocation.val(asset.AssetLocation)
            $formCurrentPhoto.val(asset.AssetPhoto)
            assetCatID = asset.CatID
        }

        xhrAsset.open("GET", "retr_assets.php?id=" + id)
        xhrAsset.send()
    </script>

    <script>
      // Script for category selection on add form
      
      const catBox = document.getElementById("category")
      const refreshButton = document.getElementById("cat-refresh-button")
      const editButton = document.getElementById("cat-edit-button")

      // Populate when the page is loaded
      window.addEventListener("load", populateList)
      // Populate when the refresh button is clicked
      refreshButton.addEventListener("click", populateList)
      // Open categories page when the edit button is clicked
      editButton.addEventListener("click", function() {open("show_categories.php")})

      function populateList() {
          catBox.innerHTML = "<option id='cat-blank' value=''>Populating list...</option>" // Reset innerHTML of cat-box to its original value

          const xhrCat = new XMLHttpRequest()
          xhrCat.responseType = "json"

          xhrCat.onload = function() {
              const catList = xhrCat.response

              // Draw each option
              for (let cat of catList) {
                  const newOption = document.createElement("option")
                  newOption.value = cat["CatID"]
                  newOption.innerHTML = cat["CatTitle"]
                  catBox.appendChild(newOption)
              }

              const catBlank = document.getElementById("cat-blank")
              catBlank.innerHTML = ""

              // Select the currently used category by default
              $formCategory.children("[value='" + assetCatID + "']").attr("selected", "true")
          }

          xhrCat.open("GET", "retr_categories.php")
          xhrCat.send()
      }
    </script>
</body>
</html>
