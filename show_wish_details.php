<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist Item Details - Hobby Harmony</title>
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
            <h2>Item details for: <span class="display-item-header"></span></h2>
            <?php include("modify_wish.php"); ?>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p>ID: <span id="display-item-id"></span></p>
                <p>Name: <span id="display-item-name"></span></p>
                <p>Price: <span id="display-item-price"></span></p>
            </div>
            <div class="col-md-9">
                <p>Description:</p>
                <div id="display-item-description">
                    <p>Loading...</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-form">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h4>Editing: <span class="display-item-header"></span></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <form method="post"> <!-- Not setting an action means the form will submit to itself -->
            <div class="modal-body">
              <div class="pt-2 pb-2 row">
                <div class="col">
                  <input type="hidden" name="current-id" id="current-id" value="">
                  <label for="category-title">Item Name</label>
                  <input type="text" class="form-control" name="item-name" id="item-name" placeholder="PowerMac G5" spellcheck="true" required>
                </div>
              </div>
              <div class="pt-2 pb-2 row">
                <div class="col">
                  <label for="item-description">Item Description</label>
                  <textarea class="form-control" name="item-description" id="item-description" rows="3" placeholder="Markdown is supported" maxlength="65535"></textarea>
                </div>
              </div>
              <div class="pt-2 pb-2 row">
                <div class="col">
                  <label for="item-price">Item Price</label>
                  <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control" name="item-price" id="item-price" placeholder="200.00" min="0" step="0.01" required>
                  </div>
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
        // Script for filling item data

        const urlParams = new URLSearchParams(window.location.search)
        const id = urlParams.get("id")

        // Static elements
        const $itemHeader = $(".display-item-header")
        const $itemID = $("#display-item-id")
        const $itemName = $("#display-item-name")
        const $itemDesc = $("#display-item-description")
        const $itemPrice = $("#display-item-price")

        // Form elements
        const $formID = $("#current-id")
        const $formName = $("#item-name")
        const $formDesc = $("#item-description")
        const $formPrice = $("#item-price")

        const xhrPage = new XMLHttpRequest()
        xhrPage.responseType = "json"

        xhrPage.onload = function() {
            const item = xhrPage.response[0]
            if (!item) {
                $itemHeader.html("Invalid item ID")
                $itemPhoto.html("")
                return // Quit processing when invalid item
            }

            $itemHeader.html(item.WishName)
            $itemID.html(item.WishID)
            $itemName.html(item.WishName)
            // Don't print description, because it needs to be parsed first
            $itemPrice.html(item.WishPrice)

            $formID.val(item.WishID)
            $formName.val(item.WishName)
            $formDesc.val(item.WishDesc)
            $formPrice.val(item.WishPrice)
        }

        xhrPage.open("GET", "retr_wishlist.php?id=" + id)
        xhrPage.send()

        const xhrDesc = new XMLHttpRequest()
        xhrDesc.responseType ="json"

        xhrDesc.onload = function() {
            const item = xhrDesc.response[0]
            if (!item) {
                return // Quit processing when invalid item
            }

            $itemDesc.html(item.WishDesc)
        }

        xhrDesc.open("GET", "retr_wishlist.php?parse=true&id=" + id) // Request item again with parse flag set to true
        xhrDesc.send()
    </script>
</body>
</html>
