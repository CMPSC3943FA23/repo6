<!DOCTYPE html>
<html>

<head>
    <title>Database Deletion - Hobby Harmony</title>
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
            <h1>Database Deletion</h1>
        </div>
        <?php
        try {
            require 'config/db_cfg.php';
        } 
        catch (Error $e) {
            echo
                "<div class='alert alert-danger'>
                <strong>Error:</strong> Database configuration file cannot be loaded: " . $e->getMessage() .
                "</div>";
            die();
        }

        if (isset($_POST["confirm"]) && $_POST["confirm"] == True) {
            try {
                // Delete database
                $conn = new PDO("mysql:host=$dbhost", $dbuser, $dbpass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $sql = "DROP DATABASE `$dbname`";
                $conn->exec($sql);
                echo
                "<div class='alert alert-success'>
                Database <strong>" . $dbname . "</strong> dropped successfully.
                </div>";
            }
            catch(PDOException $e) {
                echo
                "<div class='alert alert-danger'>
                <strong>Error:</strong> " . $sql . "<br>" . $e->getMessage() .
                "</div>";
            }

            echo
                "<a class='btn btn-success' href='db_init.php'>Reinitialize</a>";
    
            $conn = null;
        } 
        else { ?>
            <div class="col">
                <form method="post">
                    <p>
                        <span class="text-danger">This will delete <strong>everything in the database.</strong></span><br>
                        If you're sure you want to do that, check this box and click submit.
                    </p>
                    <label class="form-check-label" for="confirm">Confirm database deletion</label>
                    <input class="form-check-input" type="checkbox" name="confirm" id="confirm" value="true"><br>
                    <button class="btn btn-danger" type="button" id="submit-button" data-bs-toggle="modal" data-bs-target="#confirm-modal" disabled>Submit</button>
                    <div class="modal fade" id="confirm-modal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4>Confirm database deletion</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="pt-2 pb-2 row">
                                        <p class="text-danger">This action is irreversible and will result in the loss of all data currently stored!</p>
                                        <p>Are you really, really sure?</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Yes, I'm sure.</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, don't do it!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <script>
                const confirmBox = document.getElementById("confirm")
                const submitButton = document.getElementById("submit-button")
                confirmBox.addEventListener("click", function() {
                    if (confirmBox.checked) {
                        submitButton.disabled = false
                    }
                    else {
                        submitButton.disabled = true
                    }
                })
            </script>
        <?php } ?>
    </div>
</body>

</html>
