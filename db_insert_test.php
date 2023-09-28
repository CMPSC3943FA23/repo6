<?php
require 'config/db_cfg.php';

// This somehow lets us render a table, but I don't really understand it
class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
      parent::__construct($it, self::LEAVES_ONLY);
    }
  
    function current() {
      return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }
  
    function beginChildren() {
      echo "<tr>";
    }
  
    function endChildren() {
      echo "</tr>" . "\n";
    }
  }

// We're gonna add a MacBook, then try to pull the list

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO `assets` (
        `FriendlyName`,
        `Manufacturer`,
        `Model`,
        `AssetType`)
        VALUES (
        `My MacBook`,
        `Apple, Inc.`,
        `Late 2009 MacBook`,
        `Laptop`);";
    $conn->exec($sql);
    $last_id = $conn->lastInsertId();
    echo "Asset with ID " . $last_id . " added successfully.<br>";

    try {
        $stmt = $conn->prepare("SELECT * FROM assets");
        $stmt->execute();

        echo "<table style='border: solid 1px black;'>";
        echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    }
    catch(PDOException $e) {
        echo "Retrieval error: " . $e->getMessage();
    }    
}
catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
echo "</table>";
?>