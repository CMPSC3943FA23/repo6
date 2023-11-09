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
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>

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
      <button id="add-button" class="btn btn-primary"><i class="bi bi-plus-lg"></i></button>
      <table id="table" class="table table-striped table-responsive-md" 
      data-toggle="table" data-url="retr_assets.php" data-pagination="true" data-search="true"
      data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-show-columns-toggle-all="true"
      data-show-export="true" data-id-field="ID" data-page-list="[10, 25, 50, 100, all]">
        <thead>
          <tr>
            <th data-field="ID" data-sortable="true">ID</th>
            <th data-field="FriendlyName" data-sortable="true">Name</th>
            <th data-field="Manufacturer" data-sortable="true">Manufacturer</th>
            <th data-field="Model" data-sortable="true">Model</th>
            <th data-field="AssetType" data-sortable="true">Asset Type</th>
            <th data-field="Location" data-sortable="true">Location</th>
            <th data-field="Category" data-sortable="true">Category</th>
            <th data-field="Photo" data-sortable="false">Photo</th>
          </tr>
        </thead>
      </table>
    </div>

    <script>
      // Temporary script to continue implementing the old create form
      const addButton = document.getElementById("add-button")

      // Open create form when add button is clicked
      addButton.addEventListener("click", function() {open("create_asset.php?title=false", "_blank", "width=400, height=640")})
    </script>
  </body>
</html>
