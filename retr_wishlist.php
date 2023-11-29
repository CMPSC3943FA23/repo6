<?php
header('Content-Type: application/json');
try {
    @require 'config/db_cfg.php';
}
catch(Error $e) {
    echo '[{"WishID": "Error", "WishName": "Database configuration file cannot be loaded: ' . str_replace("\\", "\\\\", $e->getMessage()) . '"}]';
    die();
}
require 'include/Parsedown.php';

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if (isset($_GET["id"])) {
        // Retrieve single wishlist item
        $id = $_GET["id"];
        $stmt = $conn->prepare("SELECT * FROM `wishlist` WHERE `WishID` = :wish_id;");
        $stmt->execute(['wish_id' => $id]);
    }
    else {
        $stmt = $conn->prepare("SELECT * FROM `wishlist`;");
    }
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $response = $stmt->fetchAll();

    if (isset($_GET["links"]) && $_GET["links"] == "true") {
        for ($i = 0; $i < sizeof($response); $i++) {
            $wishID = $response[$i]["WishID"];
            $wishName = $response[$i]["WishName"];

            // Convert wish names to links to their details
            $response[$i]["WishName"] = "<a href='show_wish_details.php?id=" . $wishID ."'>" . $wishName . "</a>";
        }
    }

    if (isset($_GET["parse"]) && $_GET["parse"] == "true") {
        $pd = new Parsedown();
        $pd->setSafeMode(true);
        for ($i = 0; $i < sizeof($response); $i++) {
            $response[$i]["WishDesc"] = $pd->text($response[$i]["WishDesc"]);
        }
    }

    echo json_encode($response); // Encode the complete SQL response in JSON
}
catch(PDOException $e) {
    echo '[{"WishID": "Error", "WishName": "' . $e->getMessage() . '"}]';
}

$conn = null;
?>