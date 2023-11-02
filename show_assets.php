<!DOCTYPE html>
<html>
  <head>
    <title>Viewing All Assets - Hobby Harmony</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/html2pdf.bundle.min.js"></script>
    <script src="js/script_save_pdf.js"></script>
  </head>
  <body>
    <?php include("include/incl_navbar.php"); ?>
    <div class="container">
      <div id="page-header" class="pt-4 pb-4 row">
          <h1>Viewing all assets</h1>
      </div>
      <button id="add-button" class="btn btn-primary"><i class="bi bi-plus-lg"></i></button>
      <button id="refresh-button" class="btn btn-secondary"><i class="bi bi-arrow-clockwise"></i></button>
      <button id="pdf-button" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i></button>
      <!-- Loading bar is enabled by default since the script uses a load event -->
      <div id="loading-bar" class="progress mt-2"><div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%;"></div></div>
      <table class="table table-striped table-responsive-md pdf-target">
        <tbody id="the-table">
          <!-- Empty table will be filled by the script below -->
        </tbody>
      </table>
    </div>

    <script>
      const addButton = document.getElementById("add-button")
      const refreshButton = document.getElementById("refresh-button")
      const pdfButton = document.getElementById("pdf-button")

      const addAsset = document.getElementById("add-asset-body")

      // Draw table when the page is loaded
      addEventListener("load", drawTable)
      // Open create form when add button is clicked
      addButton.addEventListener("click", function() {open("create_asset.php?title=false", "_blank", "width=400, height=640")})
      // Draw table when refresh button is clicked
      refreshButton.addEventListener("click", drawTable)
      // Create PDF when PDF button is clicked
      pdfButton.addEventListener("click", function() {
        const actCells = document.getElementsByClassName("action-cell")
        for (let cell of actCells) {
          cell.style.display = "none"
        }
        savePDF("All Assets.pdf")
        setTimeout(function() {
          for (let cell of actCells) {
            cell.style.display = null
          }
        }, 3000)
      })
      
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
          theTable.innerHTML = "<tr><th class='action-cell'></th><th>ID</th><th>Friendly Name</th><th>Manufacturer</th><th>Model</th><th>Asset Type</th><th>Location</th><th>Category</th><th>Photo</th></tr>"

          // Draw rows
          for (let cat of catList) {
            const actions = '<a href="#"><i class="bi-pencil-square"></i></a><a href="#"><i class="bi-trash"></i></a>'
            const newRow = document.createElement("tr")

            // Draw actions cell
            const actCell = document.createElement("td")
            actCell.classList.add("action-cell")
            actCell.innerHTML = actions
            newRow.appendChild(actCell)

            // Draw other cells
            for (let i in cat) {
              const newCell = document.createElement("td")
              if (cat[i] == null) {
                newRow.appendChild(newCell)
              }
              else if (i == "Photo") {
                const newImgPath = "uploads/" + cat[i]
                const newLink = document.createElement("a") // Click on the image to see it full-size
                newLink.href = newImgPath
                const newData = document.createElement("img")
                newData.src = newImgPath
                newData.alt = cat[i]
                newData.style.width = "200px"
                newLink.appendChild(newData)
                newCell.appendChild(newLink)
                newRow.appendChild(newCell)
              }
              else {
                const newData = document.createTextNode(cat[i])
                newCell.appendChild(newData)
                newRow.appendChild(newCell)
              }
            }

            theTable.appendChild(newRow)
          }

          // Disable loading bar
          loadingBar.style.display = "none"
        }

        // Open the connection and send the request
        xhr.open("GET", "retr_assets.php")
        xhr.send()
      }
    </script>
  </body>
</html>