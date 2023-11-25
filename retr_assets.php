<?php
header('Content-Type: application/json');
try {
    @require 'config/db_cfg.php';
}
catch(Error $e) {
    echo '[{"AssetID": "Error", "AssetName": "Database configuration file cannot be loaded: ' . str_replace("\\", "\\\\", $e->getMessage()) . '"}]';
    die();
}

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if (isset($_GET["id"])) {
        // Retrieve single asset
        $id = $_GET["id"];
        $stmt = $conn->prepare("SELECT * FROM `assets` LEFT JOIN `categories` ON `assets`.`AssetCategory`=`categories`.`CatID` WHERE `AssetID` = :asset_id;");
        $stmt->execute(['asset_id' => $id]);
    }
    else {
        // Left join returns all assets plus the names of the categories used
        $stmt = $conn->prepare("SELECT * FROM `assets` LEFT JOIN `categories` ON `assets`.`AssetCategory`=`categories`.`CatID`;");
    }
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $response = $stmt->fetchAll();

    if (isset($_GET["links"]) && $_GET["links"] == "true") {
        for ($i = 0; $i < sizeof($response); $i++) {
            $assetID = $response[$i]["AssetID"];
            $assetName = $response[$i]["AssetName"];
            $photoFilename = $response[$i]["AssetPhoto"];

            // Convert asset names to links to their details
            $response[$i]["AssetName"] = "<a href='show_asset_details.php?id=" . $assetID ."'>" . $assetName . "</a>";

            if ($photoFilename != "") {
                // Convert image filenames to usable <img> tags
                $response[$i]["AssetPhoto"] = "<a href='uploads/" . $photoFilename . "'><img src='uploads/" . $photoFilename . "' alt='" . $photoFilename . "'></a>";
            }
        }
    }

    echo json_encode($response); // Encode the complete SQL response in JSON
}
catch(PDOException $e) {
    echo '[{"AssetID": "Error", "AssetName": "' . $e->getMessage() . '"}]';
}

$conn = null;
?>