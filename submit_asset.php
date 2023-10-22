<!DOCTYPE html>
<html>
<head>
    <title>Submitting - Hobby Harmony</title>
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

        // Grabbing variables from form submission
        if (!ctype_space($_POST["friendly-name"] . " ")) { // Check that the friendly name is non-null and not purely whitespace
            $friendly_name = $_POST["friendly-name"];
        }
        else {
            echo
            "<div class='alert alert-danger'>
            <strong>Error:</strong> Friendly Name cannot be empty.
            </div>
            <button type='button' class='btn btn-danger' onclick='window.history.back()'>Return</button>";
            die();
        }
        $manufacturer = $_POST["manufacturer"];
        $model = $_POST["model"];
        $asset_type = $_POST["asset-type"];
        $location = $_POST["location"];
        $category = $_POST["category"];

        if ($_FILES["photo"]["size"] > 0) { // We don't want to try to handle a photo upload if there is none
            $photo = basename($_FILES["photo"]["name"]);
            $photo_tmp = $_FILES["photo"]["tmp_name"];
            $upload_dir = "uploads/";
            $upload_file = $upload_dir . $photo;
    
            // For testing purposes
            echo $photo_tmp;

            if (strlen($photo) > 255) {
                echo
                "<div class='alert alert-danger'>
                <strong>Error:</strong> Photo filename is too long.
                </div>";
                die();
            }

            if (move_uploaded_file($photo_tmp, $upload_file)) { // Do not continue if upload fails
                echo
                "<div class='alert alert-success'>
                Photo <strong>" . $photo . "</strong> uploaded successfully.
                </div>";
            }
            else {
                echo
                "<div class='alert alert-danger'>
                <strong>Error:</strong> Couldn't upload photo.
                </div>";
                die();
            }
        }

        try {
            $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("INSERT INTO `assets` (
                `FriendlyName`,
                `Manufacturer`,
                `Model`,
                `AssetType`,
                `Location`,
                `Photo`,
                `Category`)
                VALUES (
                :friendly_name,
                :manufacturer,
                :model,
                :asset_type,
                :location,
                :photo,
                :category);");
                
            $stmt->execute([
                'friendly_name' => $friendly_name,
                'manufacturer' => $manufacturer,
                'model' => $model,
                'asset_type' => $asset_type,
                'location' => $location,
                'category' => $category,
                'photo' => $photo]);
                
            $last_id = $conn->lastInsertId();
            echo
            "<div class='alert alert-success'>
            Asset <strong>" . $friendly_name . "</strong> with ID <strong>" . $last_id . "</strong> added successfully.<br>
            You may now close this window.
            </div>";
        }
        catch(PDOException $e) {
            echo
            "<div class='alert alert-danger'>
            <strong>Error:</strong> " . $e->getMessage() .
            "</div>";
        }
        
        $conn = null;
        ?>
    </div>
</body>
</html>