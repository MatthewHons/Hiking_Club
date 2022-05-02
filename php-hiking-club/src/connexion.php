<?php
define("HOST", "188.166.24.55");
define("DB", "hamilton-6-hiking-club");
define("PORT", "3306");
define("LOGIN", "hamilton-6-hiking-club");
define("PASSWORD", "zOCfr8l1ssV7zGYN");

try {

    // We create a new instance of the class PDO
    $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB . ";port=" . PORT, LOGIN, PASSWORD);

    //We want any issues to throw an exception with details, instead of a silence or a simple warning
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    // We intantiate an Exception object in $e so we can use methods within this object to display errors nicely
    echo $e->getMessage();
    exit;
}
