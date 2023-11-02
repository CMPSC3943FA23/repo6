<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Hobby Harmony</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include("include/incl_navbar.php"); ?>
  <script>
    // Fix navbar to top of screen, so the page layout works
    const navbar = document.querySelector("nav")
    navbar.style.position = "fixed"
    navbar.style.width = "100%"
  </script>
  <div class="container vh-100">
    <div class="d-flex flex-column align-items-center justify-content-center h-100">
      <div class="mb-auto"></div>
      <div class="p-2 text-center">
        <h1 class="display-1"><strong>Hobby Harmony</strong></h1>
        <h2>Create and save your assets.</h2>
        <a href="show_assets.php"class="btn btn-dark btn-lg">Get Started</a>
      </div>
      <div class="mt-auto p-2 text-center"></div>
        <p>Hobby Harmony is a generalized asset tracker for personal use within the context
            of any hobby that involves a large collection.</p>
      </div>
    </div>
  </div>
</body>
</html>