<?php 
try {
    require 'config/db_cfg.php';
}
catch(Error $e) {
    echo "Error: Database configuration file cannot be loaded: " . $e->getMessage();
    die();
}

header('Content-Type: application/json');

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM `assets`");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $response = $stmt->fetchAll();

	// Convert image filenames to usable <img> tags
    // This should really be done client-side, but I couldn't find an easy way to do that
	for ($i = 0; $i < sizeof($response); $i++) {
		$photoFilename = $response[$i]["Photo"];
		$response[$i]["Photo"] = "<a href='uploads/" . $photoFilename . "'><img src='uploads/" . $photoFilename . "' alt='" . $photoFilename . "'></a>";
	}

    echo json_encode($response); // Encode the complete SQL response in JSON
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>