<?php
header('Content-Type: application/json');
try {
    @require 'config/db_cfg.php';
}
catch(Error $e) {
    echo '[{"CatID": "Error", "CatTitle": "Database configuration file cannot be loaded: ' . str_replace("\\", "\\\\", $e->getMessage()) . '"}]';
    die();
}

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM `categories`");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    echo json_encode($stmt->fetchAll()); // Encode the complete SQL response in JSON
}
catch(PDOException $e) {
    echo '[{"CatID": "Error", "CatTitle": "' . $e->getMessage() . '"}]';
}

$conn = null;
?>