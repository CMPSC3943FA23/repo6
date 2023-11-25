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
            <h2>Asset Details: <span id="asset-header"></span></h2>
        </div>
        <div class="row">
            <div id="asset-photo" class="col-md-6">
            </div>
            <div class="col-md-6">
                <p>This is a very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very very long paragraph</p>
            </div>
        </div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search)
        const id = urlParams.get("id")

        const $assetHeader = $("#asset-header")
        const $assetPhoto = $("#asset-photo")

        const xhr = new XMLHttpRequest()
        xhr.responseType = "json"

        xhr.onload = function() {
            const asset = xhr.response[0]
            $assetHeader.html(asset.AssetName)
            if (asset.AssetPhoto) {
                $assetPhoto.html(asset.AssetPhoto)
                $("img").css("width", "100%")
            }
            else {
                $assetPhoto.html("<h5>There is no image for this asset.</h5>")
            }
        }

        xhr.open("GET", "retr_assets.php?id=" + id)
        xhr.send()
    </script>
</body>
</html>
