
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create hike</title>
</head>

<body>
    <h1>Create a new hike</h1>
    <form method="post" action="create_hike.php">
        <label for="name">Name </label>
        <input class="input is-medium" name="name" type="text" placeholder="Name">
        <label for="distance">Distance </label>
        <input class="input is-medium" name="distance" type="number" placeholder="Distance">
        <label for="duration">Duration </label>
        <input class="input is-medium" name="duration" type="number" placeholder="Duration in minutes">
        <label for="elevation">Elevation (+) </label>
        <input class="input is-medium" name="elevation" type="number" placeholder="Positive elevation">
        <div>
            <label class="radio">
                <input type="radio" name="difficulty" value="Easy">
                Easy
            </label>
        </div>
        <div>
            <label class="radio">
                <input type="radio" name="difficulty" value="Moderate">
                Moderate
            </label>
        </div>
        <div>
            <label class="radio">
                <input type="radio" name="difficulty" value="Hard">
                Hard
            </label>
        </div>
        <div class="control">
            <input type="submit" class="button is-link" value="submit">
        </div>


    </form>
</body>

</html>
<?php

// open the $_SESSION

if (isset($_POST['name'], $_POST['distance'], $_POST['duration'], $_POST['elevation'], $_POST['difficulty'])) {
    $name = $_POST['name'];
    $distance = $_POST['distance'];
    $duration = $_POST['duration'];
    $elevation = $_POST['elevation'];
    $difficulty = $_POST['difficulty'];
    $link = "https://images.unsplash.com/photo-1586508896897-a1863f3e515e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80";
 echo $difficulty;
}
 
//hello


require_once("connexion.php");

try {
    $q = $db->prepare("INSERT INTO hikes (name, difficulty, distance, duration, elevation_gain, Img_link) VALUES (:name, :difficulty, :distance, :duration, :elevation, :link)");
    $q->bindParam(":name", $name, PDO::PARAM_STR, 40);
    $q->bindParam(":difficulty", $difficulty, PDO::PARAM_STR, 20);
    $q->bindParam(":distance", $distance, PDO::PARAM_STR, 6);
    $q->bindParam(":duration", $duration, PDO::PARAM_STR, 5);
    $q->bindParam(":elevation", $elevation, PDO::PARAM_INT, 5);
    $q->bindParam(":link", $link, PDO::PARAM_STR, 200);
    $q->execute();
    exit;
} catch (Exception $e) {
    echo $e;
    exit;
}