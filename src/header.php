<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiking Club</title>
    <script src="./nav.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="./style/text.css">
    <link rel="stylesheet" href="./style/read.css">
    <link rel="stylesheet" href="./style/form.css">
    <link rel="icon" type="image/png" href="./ressources/favicon_io/favicon-32x32.png">
    <script src="https://kit.fontawesome.com/01b8f0a316.js" crossorigin="anonymous"></script>
</head>

<body>
<div class="container"> 
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.php">
                <img src="./ressources/images/logo-HC.svg" width="112" height="28">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">


                <?php if (!isset($_SESSION["user"])) : ?>
                    <a class="navbar-item" href="login.php">Login</a>
                    <a class="navbar-item" href="register.php">Subscription</a>
                <?php else : ?>
                    <a class="navbar-item" href="./create_hike.php">
                        Add
                    </a>

                    <a class="navbar-item" href="profil.php?id=<?php echo $_SESSION["user"]["ID"]; ?>">
                        Profile
                    </a>
                    <a class=" navbar-item" href="logout.php">Logout</a>

                <?php endif; ?>

                <!-- <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                More
                </a>

                <div class="navbar-dropdown">
                <a class="navbar-item">
                    About
                </a>
                <a class="navbar-item">
                    Jobs
                </a>
                <a class="navbar-item">
                    Contact
                </a>
                <hr class="navbar-divider">
                <a class="navbar-item">
                    Report an issue
                </a>
                </div>
            </div> -->
            </div>

            <div class="navbar-end">
                <!-- <div class="navbar-item">
                <div class="buttons">
                <a class="button is-primary">
                    <strong>Sign up</strong>
                </a>
                <a class="button is-light">
                    Log in
                </a>
                </div>
            </div> -->
            </div>
        </div>
    </nav>
</div>
</body>

</html>