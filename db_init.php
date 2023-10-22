<!DOCTYPE html>
<html>
<head>
    <title>Database Initialization - Hobby Harmony</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-4">
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
                `ID` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `Title` varchar(255) NOT NULL
                )";
                $conn->exec($sql);
                echo
                "<div class='alert alert-success'>
                Table <strong>categories</strong> created successfully.
                </div>";

            // Create table assets
            $sql = "CREATE TABLE IF NOT EXISTS `assets` (
            `ID` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `FriendlyName` varchar(255) NOT NULL,
            `Manufacturer` varchar(255),
            `Model` varchar(255),
            `AssetType` varchar(255),
            `Location` varchar(255),
            `Category` int,
            `Photo` varchar(255),
            FOREIGN KEY (`Category`) REFERENCES `categories`(`ID`)
            )";
            $conn->exec($sql);
            echo
            "<div class='alert alert-success'>
            Table <strong>assets</strong> created successfully.
            </div>";

            echo
            "<button type='button' class='btn btn-success'>Continue</button>";
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