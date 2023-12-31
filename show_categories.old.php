<!-- This version of this page is deprecated in favor of the rewrite using Bootstrap Table. -->

<!DOCTYPE html>
<html>
  <head>
    <title>Viewing Asset Categories - Hobby Harmony</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
    <?php include("include/incl_navbar.php"); ?>
    <div class="container">
      <div id="page-header" class="pt-4 pb-4 row">
          <h1>Viewing asset categories</h1>
      </div>
      <button id="add-button" class="btn btn-primary"><i class="bi bi-plus-lg"></i></button>
      <button id="refresh-button" class="btn btn-secondary"><i class="bi bi-arrow-clockwise"></i></button>
      <!-- Loading bar is enabled by default since the script uses a load event -->
      <div id="loading-bar" class="progress mt-2"><div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%;"></div></div>
      <table class="table table-striped table-responsive-md">
        <tbody id="the-table">
          <!-- Empty table will be filled by the script below -->
        </tbody>
      </table>
    </div>

    <script>
      const addButton = document.getElementById("add-button")
      const refreshButton = document.getElementById("refresh-button")

      // Draw table when the page is loaded
      addEventListener("load", drawTable)
      // Draw table when refresh button is clicked
      refreshButton.addEventListener("click", drawTable)
      // Open create form when add button is clicked
      addButton.addEventListener("click", function() {open("create_category.php", "_blank", "width=400, height=200")})
      
      function drawTable() {

        // Create an object using the XMLHttpRequest class and set it to JSON
        // Its methods will let us request data from another page
        const xhr = new XMLHttpRequest()
        xhr.responseType = "json"

        // Create constants that point to our table and loading bar
        const theTable = document.getElementById("the-table")
        const loadingBar = document.getElementById("loading-bar")

        // This function runs when the server response is ready
        xhr.onload = function() {
          const catList = xhr.response
          
          // Draw header
          theTable.innerHTML = "<tr><th>ID</th><th>Category Title</th></tr>"

          // Draw rows
          for (let cat of catList) {
            const newRow = document.createElement("tr")

            // Draw cells
            for (let i in cat) {
              const newCell = document.createElement("td")
              const newData = document.createTextNode(cat[i])
              newCell.appendChild(newData)
              newRow.appendChild(newCell)
            }

            theTable.appendChild(newRow)
          }

          // Disable loading bar
          loadingBar.style.display = "none"
        }

        // Open the connection and send the request
        xhr.open("GET", "retr_categories.php")
        xhr.send()
      }
    </script>
  </body>
</html>