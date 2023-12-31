<!DOCTYPE html>
<html>
<head>
    <title>Database Initialization - Hobby Harmony</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include("include/incl_navbar.php"); ?>
    <div class="container">
        <div class="pt-4 pb-4 row">
            <h1>Database Initialization</h1>
        </div>
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

        try {
            // Create database
            $conn = new PDO("mysql:host=$dbhost", $dbuser, $dbpass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "CREATE DATABASE IF NOT EXISTS `$dbname`";
            $conn->exec($sql);
            echo
            "<div class='alert alert-success'>
            Database <strong>" . $dbname . "</strong> created successfully.
            </div>";

            // Switch to the newly created database
            $sql = "USE `$dbname`;";
            $conn->exec($sql);

            // Create table categories
            $sql = "CREATE TABLE IF NOT EXISTS `categories` (
                `CatID` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `CatTitle` varchar(255) NOT NULL
                )";
                $conn->exec($sql);
                echo
                "<div class='alert alert-success'>
                Table <strong>categories</strong> created successfully.
                </div>";

            // Create table assets
            $sql = "CREATE TABLE IF NOT EXISTS `assets` (
            `AssetID` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `AssetName` varchar(255) NOT NULL,
            `AssetManufacturer` varchar(255),
            `AssetModel` varchar(255),
            `AssetType` varchar(255),
            `AssetLocation` varchar(255),
            `AssetCategory` int,
            `AssetPhoto` varchar(255),
            FOREIGN KEY (`AssetCategory`) REFERENCES `categories`(`CatID`)
            )";
            $conn->exec($sql);
            echo
            "<div class='alert alert-success'>
            Table <strong>assets</strong> created successfully.
            </div>";

            // Create table wishlist
            $sql = "CREATE TABLE IF NOT EXISTS `wishlist` (
                `WishID` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `WishName` varchar(255) NOT NULL,
                `WishDesc` text,
                `WishPrice` decimal(10,2)
                )";
            $conn->exec($sql);
            echo
            "<div class='alert alert-success'>
            Table <strong>wishlist</strong> created successfully.
            </div>";

            echo
            "<a class='btn btn-success' href='show_assets.php'>Continue</a>";
        }
        catch(PDOException $e) {
            echo
            "<div class='alert alert-danger'>
            <strong>Error:</strong> " . $sql . "<br>" . $e->getMessage() .
            "</div>";
        }

        $conn = null;
        ?>
    </div>
</body>
</html>