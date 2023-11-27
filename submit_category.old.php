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
                `Title`)
                VALUES (
                :category_title);");
                
            $stmt->execute(['category_title' => $category_title]);
                
            $last_id = $conn->lastInsertId();
            echo
            "<div class='alert alert-success'>
            Category <strong>" . $category_title . "</strong> with ID <strong>" . $last_id . "</strong> added successfully.<br>
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