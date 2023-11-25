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
            <h2>Asset details for <span id="asset-header"></span></h2>
        </div>
        <div class="row">
            <div id="asset-photo" class="col-md-6">
                <p>Loading...</p>
            </div>
            <div class="col-md-6">
                <p>Name: <span id="asset-name"></span></p>
                <p>Manufacturer: <span id="asset-manufacturer"></span></p>
                <p>Model: <span id="asset-model"></span></p>
                <p>Type: <span id="asset-type"></span></p>
                <p>Location: <span id="asset-location"></span></p>
                <p>Category: <span id="asset-category"></span></p>
            </div>
        </div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search)
        const id = urlParams.get("id")

        const $assetHeader = $("#asset-header")
        const $assetName = $("#asset-name")
        const $assetPhoto = $("#asset-photo")
        const $assetManufacturer = $("#asset-manufacturer")
        const $assetModel = $("#asset-model")
        const $assetType = $("#asset-type")
        const $assetLocation = $("#asset-location")
        const $assetCategory = $("#asset-category")

        const xhr = new XMLHttpRequest()
        xhr.responseType = "json"

        xhr.onload = function() {
            const asset = xhr.response[0]
            if (!asset) {
                $assetHeader.html("Invalid asset ID")
                $assetPhoto.html("")
                return // Quit processing
            }

            $assetHeader.html(asset.AssetName)

            if (asset.AssetPhoto) {
                $assetPhoto.html("<img src='uploads/" + asset.AssetPhoto + "' alt='" + asset.AssetPhoto + "' style='width: 100%'>")
            }
            else {
                $assetPhoto.html("<h5>There is no image for this asset.</h5>")
            }

            $assetName.html(asset.AssetName)
            $assetManufacturer.html(asset.AssetManufacturer)
            $assetModel.html(asset.AssetModel)
            $assetType.html(asset.AssetType)
            $assetLocation.html(asset.AssetLocation)
            $assetCategory.html(asset.CatTitle)
        }

        xhr.open("GET", "retr_assets.php?id=" + id)
        xhr.send()
    </script>
</body>
</html>
