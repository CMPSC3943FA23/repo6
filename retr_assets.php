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

	// Convert image filenames to usable <img> tags
    // This should really be done client-side, but I couldn't find an easy way to do that
	for ($i = 0; $i < sizeof($response); $i++) {
		$photoFilename = $response[$i]["AssetPhoto"];
        if ($photoFilename != "") {
		    $response[$i]["AssetPhoto"] = "<a href='uploads/" . $photoFilename . "'><img src='uploads/" . $photoFilename . "' alt='" . $photoFilename . "'></a>";
        }
	}

    echo json_encode($response); // Encode the complete SQL response in JSON
}
catch(PDOException $e) {
    echo '[{"AssetID": "Error", "AssetName": "' . $e->getMessage() . '"}]';
}

$conn = null;
?>