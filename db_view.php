<!DOCTYPE html>
<html>
  <head>
    <title>Viewing Raw Database - Hobby Harmony</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container mt-4">
      <p>This page is not to be used in the final product. It is only for testing database functionality.</p>
      <?php
      try {
          require 'config/db_cfg.php';
      }
      catch(Error $e) {
        echo
        "<div class='alert alert-danger'>
        <strong>Error:</strong> Database configuration file cannot be loaded: " . $e->getMessage() .
        "</div>";
        die();
      }

      // This somehow lets us render a table, but I don't really understand it
      class TableRows extends RecursiveIteratorIterator {
        function __construct($it) {
          parent::__construct($it, self::LEAVES_ONLY);
        }
        
        function current() {
          return "<td>" . parent::current(). "</td>";
        }
        
        function beginChildren() {
          echo "<tr>";
        }
        
        function endChildren() {
          echo "</tr>" . "\n";
        }
      }

      // Try to pull the list
      try {
          $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          try {
              $stmt = $conn->prepare("SELECT * FROM assets");
              $stmt->execute();

              echo "<table class='table table-striped table-responsive-md'>";
              echo "<tr><th>ID</th><th>Friendly Name</th><th>Manufacturer</th><th>Model</th><th>Asset Type</th><th>Location</th></tr>";

              $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
              foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                  echo $v;
              }
          }
          catch(PDOException $e) {
              echo 
              "<div class='alert alert-danger'>
              <strong>Retrieval error:</strong> " . $e->getMessage() .
              "</div>";
          }    
      }
      catch(PDOException $e) {
        echo
        "<div class='alert alert-danger'>
        <strong>Error:</strong> " . $sql . "<br>" . $e->getMessage() .
        "</div>";
      }

      $conn = null;
      echo "</table>";
      ?>
    </div>
  </body>
</html>