<?php
// Do not run this script if there was no form submission
if (isset($_POST["friendly-name"])) {
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

    $current_id = $_POST["current-id"];
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
    $asset_type = $_POST["type"];
    $location = $_POST["location"];
    $current_photo = $_POST["current-photo"];
    if ($_POST["category"] == "") {
        $category = null;
    }
    else {
        $category = $_POST["category"];
    }

    if ($_FILES["photo"]["size"] > 0) { // We don't want to try to handle a photo upload if there is none
        $photo = basename($_FILES["photo"]["name"]);
        $photo_tmp = $_FILES["photo"]["tmp_name"];
        $upload_dir = "uploads/";
        $hashed_name = uniqid("img") . "." . pathinfo($photo, PATHINFO_EXTENSION);
        $upload_file = $upload_dir . $hashed_name;

        // For testing purposes
        echo "<script>console.log('Temporary file path: " . $photo_tmp . "')</script>";

        if (move_uploaded_file($photo_tmp, $upload_file)) { // Do not continue if upload fails
            echo
            "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            Photo <strong>" . $photo . "</strong> uploaded successfully as <strong>" . $hashed_name . "</strong>.
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
    else {
        $hashed_name = $current_photo;
    }

    try {
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("UPDATE `assets`
                                SET `AssetName` = :friendly_name, 
                                `AssetManufacturer` = :manufacturer,
                                `AssetModel` = :model,
                                `AssetType` = :asset_type,
                                `AssetLocation` = :location,
                                `AssetCategory` = :category,
                                `AssetPhoto` = :photo
                                WHERE `AssetID` = :current_id;");
            
        $stmt->execute([
            'current_id' => $current_id,
            'friendly_name' => $friendly_name,
            'manufacturer' => $manufacturer,
            'model' => $model,
            'asset_type' => $asset_type,
            'location' => $location,
            'category' => $category,
            'photo' => $hashed_name]);
            
        $last_id = $current_id;
        echo
        "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        Asset <strong>" . $friendly_name . "</strong> with ID <strong>" . $last_id . "</strong> modified successfully.
        </div>";
        $conn = null;
    }
    catch(PDOException $e) {
        echo
        "<div class='alert alert-danger'>
        <strong>Error:</strong> " . $e->getMessage() .
        "</div>";
        $conn = null;
        die();
    }
}
?>