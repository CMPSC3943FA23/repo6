<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <title>Create New Category - Hobby Harmony</title>
</head>

<body>
    <div class="container">
        <div class="col">
            <form action="submit_category.php" method="post">
                <div class="pt-2 pb-2 row">
                    <div class="col">
                        <label for="category-title">Category Title</label>
                        <input type="text" class="form-control" name="category-title" id="category-title" placeholder="Laptop" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success mb-2">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>