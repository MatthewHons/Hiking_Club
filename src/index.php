<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="./style/login.css">
    <link rel="icon" type="image/png" href="./ressources/favicon_io/favicon-32x32.png">
    <script src="https://kit.fontawesome.com/01b8f0a316.js" crossorigin="anonymous"></script>
    <title>Home page</title>
</head>

<body>
    <header>
        <img src="https://images.unsplash.com/photo-1631897523496-7d4d4bc35057?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2487&q=80" alt="Hiking club">
    </header>

    <section class="div_button">
        <img src="./ressources/images/logo-HC.svg">
        <div class="buttons is-centered">
            <button class="button is-primary">
                <span class="icon">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                </span>
                <a class="navbar-item" href="login.php">Login</a>
            </button>
            <button class="button is-primary">
                <span class="icon">
                    <i class="fa-solid fa-address-card"></i>
                </span>
                <a class="navbar-item" href="register.php">Register</a>
            </button>
            <button class="button is-primary">
                <span class="icon">
                    <i class="fa-solid fa-map"></i>
                </span>
                <a class="navbar-item" href="read.php">Visit</a>
            </button>
        </div>
    </section>

</body>

</html>