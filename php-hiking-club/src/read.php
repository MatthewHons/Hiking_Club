<?php

session_start();

require_once("connexion.php");

try {

    //prepare() is a PDO method to make sure that our query is not subject to a SQL inject.
    //this returns a PDOStatement object
    $q = $db->prepare("SELECT * FROM hikes");

    //To execute the query set into $q (PDOStatement) object
    $q->execute();
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

// PDO::FETCH_ASSOC to display only the columns as keys in the array returned
$hikes = $q->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/read.css">
    <title>Hiking club</title>
</head>

<body>
    <header>
        <?PHP
            include("./header.php");
        ?>
    </header>
    <section>
        <?php
        //display the datas
        foreach ($hikes as $hike) : ?>
            <div class="card" style="background-image: -webkit-linear-gradient(
            top,
            rgba(0, 0, 0, 0.2),
            rgba(255, 255, 255, 0.15)
            ),
            url(<?php echo $hike["Img_link"] ?>);">
                <h2> <?php echo $hike["name"]; ?></h2>
                <p><?php echo $hike["difficulty"], $hike["distance"] ?> km <?php $duration = (int)$hike["duration"];
                                                                            echo intdiv($duration, 60) . ':' . ($duration % 60); ?> heure, <?php echo $hike["elevation_gain"]; ?> m</p>
            </div>
        <?php
        endforeach;
        ?>
    </section>
</body>

</html>