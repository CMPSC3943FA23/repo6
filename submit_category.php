<?php
// This file used to be a full page, but now it's included from show_categories.php

// Do not run this script if there was no form submission
if (isset($_POST["category-title"])) {
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
    if (!ctype_space($_POST["category-title"] . " ")) { // Check that the title is non-null and not purely whitespace
        $category_title = $_POST["category-title"];
    }
    else {
        echo
        "<div class='alert alert-danger'>
        <strong>Error:</strong> Category Title cannot be empty.
        </div>
        <button type='button' class='btn btn-danger' onclick='window.history.back()'>Return</button>";
        die();
    }

    try {
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO `categories` (
            `CatTitle`)
            VALUES (
            :category_title);");
            
        $stmt->execute(['category_title' => $category_title]);
            
        $last_id = $conn->lastInsertId();
        echo
        "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        Category <strong>" . $category_title . "</strong> with ID <strong>" . $last_id . "</strong> added successfully.
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