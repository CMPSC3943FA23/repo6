<!DOCTYPE html>
<html>
  <head>
    <title>Viewing All Assets - Hobby Harmony</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Table Export includes -->
    <script type="text/javascript" src="js/libs/FileSaver/FileSaver.min.js"></script>
    <script type="text/javascript" src="js/libs/js-xlsx/xlsx.core.min.js"></script>
    <script type="text/javascript" src="js/libs/jsPDF/jspdf.umd.min.js"></script>
    <script type="text/javascript" src="js/libs/html2canvas/html2canvas.min.js"></script>
    <script type="text/javascript" src="js/tableExport.min.js"></script>

    <!-- Bootstrap Table includes -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/export/bootstrap-table-export.min.js"></script>

    <style>
      /* Keep images from being giant */
      td img {
        width: 200px;
      }
    </style>
  </head>
  <body>
    <?php include("include/incl_navbar.php"); ?>
    <div class="container">
      <div id="page-header" class="pt-4 pb-4 row">
          <h1>Viewing all assets</h1>
      </div>
      <?php include("submit_asset.php"); ?>
      <div id="toolbar">
        <button id="add-button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-form"><i class="bi bi-plus-lg"></i></button>
      </div>
      <table id="table" class="table table-striped table-responsive-md" 
      data-toggle="table" data-url="retr_assets.php?links=true" data-pagination="true" data-search="true"
      data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-show-columns-toggle-all="true"
      data-show-export="true" data-id-field="AssetID" data-page-list="[10, 25, 50, 100, all]" data-toolbar="#toolbar"
      data-export-types="['json', 'xml', 'csv', 'sql', 'excel', 'pdf']">
        <thead>
          <tr>
            <th data-field="AssetID" data-sortable="true">ID</th>
            <th data-field="AssetName" data-sortable="true">Name</th>
            <th data-field="AssetManufacturer" data-sortable="true">Manufacturer</th>
            <th data-field="AssetModel" data-sortable="true">Model</th>
            <th data-field="AssetType" data-sortable="true">Type</th>
            <th data-field="AssetLocation" data-sortable="true">Location</th>
            <th data-field="CatTitle" data-sortable="true">Category</th>
            <th data-field="AssetPhoto" data-sortable="false">Photo</th>
          </tr>
        </thead>
      </table>
    </div>

    <div class="modal fade" id="add-form">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h4>Create new asset</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <form method="post" enctype="multipart/form-data"> <!-- Not setting an action means the form will submit to itself -->
            <div class="modal-body">
              <div class="pt-2 pb-2 row">
                  <div class="col">
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
                      <input type="text" class="form-control" name="asset-type" id="asset-type" placeholder="Computer" spellcheck="true">
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

          const xhr = new XMLHttpRequest()
          xhr.responseType = "json"

          xhr.onload = function() {
              const catList = xhr.response

              // Draw each option
              for (let cat of catList) {
                  const newOption = document.createElement("option")
                  newOption.value = cat["CatID"]
                  newOption.innerHTML = cat["CatTitle"]
                  catBox.appendChild(newOption)
              }

              const catBlank = document.getElementById("cat-blank")
              catBlank.innerHTML = ""
          }

          xhr.open("GET", "retr_categories.php")
          xhr.send()
      }
    </script>

    <script>
      /*
      // Temporary script to continue implementing the old create form
      const addButton = document.getElementById("add-button")

      // Open create form when add button is clicked
      addButton.addEventListener("click", function() {open("create_asset.php?title=false", "_blank", "width=400, height=640")})
      */
    </script>
  </body>
</html>
