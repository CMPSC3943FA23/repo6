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
      <div id="toolbar">
        <button id="add-button" class="btn btn-primary"><i class="bi bi-plus-lg"></i></button>
      </div>
      <table id="table" class="table table-striped table-responsive-md" 
      data-toggle="table" data-url="retr_assets.php" data-pagination="true" data-search="true"
      data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-show-columns-toggle-all="true"
      data-show-export="true" data-id-field="ID" data-page-list="[10, 25, 50, 100, all]" data-toolbar="#toolbar"
      data-export-types="['json', 'xml', 'csv', 'sql', 'excel', 'pdf']">
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
