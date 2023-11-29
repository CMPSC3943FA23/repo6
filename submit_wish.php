<?php
// This file used to be a full page, but now it's included from show_categories.php

// Do not run this script if there was no form submission
if (isset($_POST["item-name"])) {
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
    if (!ctype_space($_POST["item-name"] . " ")) { // Check that the title is non-null and not purely whitespace
        $item_name = $_POST["item-name"];
    }
    else {
        echo
        "<div class='alert alert-danger'>
        <strong>Error:</strong> Item Name cannot be empty.
        </div>
        <button type='button' class='btn btn-danger' onclick='window.history.back()'>Return</button>";
        die();
    }
    $item_desc = $_POST["item-description"];
    $item_price =$_POST["item-price"];

    try {
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO `wishlist` (
            `WishName`,
            `WishDesc`,
            `WishPrice`)
            VALUES (
            :item_name,
            :item_desc,
            :item_price);");
            
        $stmt->execute([
            'item_name' => $item_name,
            'item_desc' => $item_desc,
            'item_price' => $item_price]);
            
        $last_id = $conn->lastInsertId();
        echo
        "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        Wishlist item <strong>" . $item_name . "</strong> with ID <strong>" . $last_id . "</strong> added successfully.
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