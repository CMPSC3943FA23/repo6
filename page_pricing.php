<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Plans - Hobby Harmony</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include("include/incl_navbar.php"); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <!-- Image -->
                <img src="img/ai-logo.png" class="img-fluid" alt="Product Image">
            </div>
            <div class="col-md-6">
                <h2>Subscription Plans</h2>
                <p class="lead">Want a bigger database with more customization?<br>
                Choose the plan that's right for you.</p>

                <!-- Regular Plan -->
                <div class="mb-4">
                    <h4>Regular Plan</h4>
                    <p class="text-muted">Enjoy basic features for just a small price.</p>
                    <h3 class="text-success">$4.99/month</h3>
                    <button class="btn btn-outline-primary btn-lg">Choose Regular</button>
                </div>

                <!-- Premium Plan -->
                <div>
                    <h4>Premium Plan</h4>
                    <p class="text-muted">Get all premium features and more.</p>
                    <h3 class="text-success">$9.99/month</h3>
                    <button class="btn btn-outline-primary btn-lg">Choose Premium</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
