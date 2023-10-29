<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Hobby Harmony</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!--<style>
    .landing-text{
        margin-top: -100px;
        position: absolute;
        text-align: center;
        top: 50%;
        width: 100%;
    }

    h1{
        font-size: 450%;
        font-weight: 700;
    }

    h2{
        font-size: 175%;
    }

    p{
        position: fixed;
        bottom: 0; 
        width:100%; 
        font-weight: 500;
    }
    </style>-->
    
    <?php // dummy block ?>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="position: fixed; width: 100%;">
        <div class="container">
          <a class="navbar-brand" href="#">Hobby Harmony</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="prototype/HobbyHarmony.html">Prototype</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="create_asset.php">Create Asset</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="show_assets.php">My Assets</a>
              </li>    
            </ul>
          </div>
        </div>
    </nav>
      <div class="container vh-100">
        <div class="d-flex flex-column align-items-center justify-content-center h-100">
          <div class="mb-auto"></div>
          <div class="p-2 text-center">
            <h1 class="display-1"><strong>Hobby Harmony</strong></h1>
            <h2>Create and save your assets.</h2>
            <a href="create_asset.php"class="btn btn-dark btn-lg">Get Started</a>
          </div>
          <div class="mt-auto p-2 text-center"></div>
            <p>Hobby Harmony is a generalized asset tracker for personal use within the context
                of any hobby that involves a large collection.</p>
          </div>
        </div>
      </div>
</body>
</html>