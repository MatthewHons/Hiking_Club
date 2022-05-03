<?php
require_once("connexion.php");

session_start();

// check if $_GET is empty
if (empty($_GET["id"])) {
    echo "url incorrect";
    exit;
}
$id = $_GET["id"];

try {
    $q = $db->prepare("SELECT * FROM hikes WHERE ID=:id");

    //To bind the $code variable to the :codeproduct declaration and give a type.
    $q->bindParam(":id", $id, PDO::PARAM_STR);

    //To execute the query set into results object
    // execute() return true or false
    $q->execute();
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

$modify = $q->fetch(PDO::FETCH_ASSOC);

if ($modify == FALSE) {
    echo "This code reference $id doesn't exist in the Database. </br> <a href='/''>Go back</a>";
    die();
}

include "header.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>

<body>
    <div class=" card_hike" style="background-image: -webkit-linear-gradient(
            top,
            rgba(0, 0, 0, 0.2),
            rgba(255, 255, 255, 0.15)
            ),
            url(<?php echo $modify["Img_link"] ?>);">
        <p> <?php echo $modify["name"]; ?>
        <p><?php echo $modify["difficulty"], $modify["distance"] ?> km <?php $duration = (int)$modify["duration"];
                                                                        echo intdiv($duration, 60) . 'h' . ($duration % 60); ?> min, <?php echo $modify["elevation_gain"]; ?> m</p>
    </div>

    <h1>Create a new hike</h1>
    <form method="post" action="updateData.php">
        <label for="name">Name </label>
        <input class="input is-medium" name="name" type="text" placeholder="<?php echo $modify["name"]; ?>">
        <label for="distance">Distance </label>
        <input class="input is-medium" name="distance" type="number" placeholder="<?php echo $modify["distance"]; ?>">
        <label for="duration">Duration </label>
        <input class="input is-medium" name="duration" type="number" placeholder="<?php echo $modify["duration"]; ?>">
        <label for="elevation">Elevation (+) </label>
        <input class="input is-medium" name="elevation" type="number" placeholder="<?php echo $modify["elevation_gain"]; ?>">
        <div>
            <label class="radio">
                <input type="radio" name="difficulty" value="Easy">
                <span style="color:black">Easy</span>
            </label>
        </div>
        <div>
            <label class="radio">
                <input type="radio" name="difficulty" value="Moderate">
                <span style="color:black">Moderate</span>
            </label>
        </div>
        <div>
            <label class="radio">
                <input type="radio" name="difficulty" value="Hard">
                <span style="color:black">Hard</span>
            </label>
        </div>
        <div class="control">
            <input type="submit" class="button is-link" value="submit">
        </div>
    </form>
</body>

</html>