<?php
require 'config/db_cfg.php';

try {
    // Create database
    $conn = new PDO("mysql:host=$dbhost", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "CREATE DATABASE IF NOT EXISTS `$dbname`";
    $conn->exec($sql);
    echo "Database &quot;" . $dbname . "&quot; created successfully.<br>";

    // Create tables
    $conn = new PDO("mysql:host=$dbhost;dbname-$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "USE `$dbname`;
    CREATE TABLE IF NOT EXISTS `assets` (
    `ID` int(11) NOT NULL AUTO_INCREMENT,
    `FriendlyName` varchar(255) NOT NULL,
    `Manufacturer` varchar(255) DEFAULT NULL,
    `Model` varchar(255) DEFAULT NULL,
    `AssetType` varchar(255) DEFAULT NULL,
    `Location` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`ID`)
    )";
    $conn->exec($sql);
    echo "Table &quot;assets&quot; created successfully.<br>";

} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>