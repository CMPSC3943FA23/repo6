<!DOCTYPE html>
<html>
  <head>
    <title>Viewing Wishlist - Hobby Harmony</title>
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

    </head>
  <body>
    <?php include("include/incl_navbar.php"); ?>
    <div class="container">
      <div id="page-header" class="pt-4 pb-4 row">
        <h1>Viewing asset categories</h1>
      </div>
      <?php include("submit_wish.php"); ?>
      <div id="toolbar">
        <button id="add-button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-form"><i class="bi bi-plus-lg"></i></button>
      </div>
      <table id="table" class="table table-striped table-responsive-md" 
      data-toggle="table" data-url="retr_wishlist.php?links=true" data-pagination="true" data-search="true"
      data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-show-columns-toggle-all="true"
      data-show-export="true" data-id-field="WishID" data-page-list="[10, 25, 50, 100, all]" data-toolbar="#toolbar"
      data-export-types="['json', 'xml', 'csv', 'sql', 'excel', 'pdf']">
        <thead>
          <tr>
            <th data-field="WishID" data-sortable="true">ID</th>
            <th data-field="WishName" data-sortable="true">Name</th>
            <th data-field="WishPrice" data-sortable="true">Price</th>
          </tr>
        </thead>
      </table>
    </div>
    
    <div class="modal fade" id="add-form">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h4>Add wishlist item</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <form method="post"> <!-- Not setting an action means the form will submit to itself -->
            <div class="modal-body">
              <div class="pt-2 pb-2 row">
                <div class="col">
                  <label for="item-name">Item Name</label>
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
  </body>
</html>