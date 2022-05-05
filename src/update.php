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
<div class=" card_hike" style="background-image: -webkit-linear-gradient(
            top,
            rgba(0, 0, 0, 0.2),
            rgba(255, 255, 255, 0.15)
            ),
            url(<?= $modify["Img_link"] ?>);">
    <p> <?= $modify["name"]; ?>
    <p><?= $modify["difficulty"], $modify["distance"] ?> km <?php $duration = (int)$modify["duration"];
                                                            echo intdiv($duration, 60) . 'h' . ($duration % 60); ?> min, <?= $modify["elevation_gain"]; ?> m</p>
</div>
<?php if (isset($_SESSION["user"])) : ?>
    <?php if (($_SESSION["user"]["ID"] == $modify["id_user"]) || $_SESSION["user"]["is_admin"]) : ?>
        <h1>Update your hike</h1>
        <form method="post" action="updateData.php?id=<?= $modify["ID"] ?>">
            <label for="name">Name </label>
            <input class="input is-medium" name="name" type="text" placeholder="<?= $modify["name"]; ?>">
            <label for="distance">Distance </label>
            <input class="input is-medium" name="distance" type="number" placeholder="<?= $modify["distance"]; ?>">
            <label for="duration">Duration </label>
            <input class="input is-medium" name="duration" type="number" placeholder="<?= $modify["duration"]; ?>">
            <label for="elevation">Elevation (+) </label>
            <input class="input is-medium" name="elevation" type="number" placeholder="<?= $modify["elevation_gain"]; ?>">
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
                <input type="submit" class="button is-link" value="Modify">
            </div>
        </form>
        <button class="button is-danger is-outlined is-pulled-right">
            <a href="delete.php?id=<?php echo $modify["ID"] ?>">
                <span>Delete</span>
                <span class="icon is-small ">
                    <i class="fas fa-times"></i>
                </span>
        </button>
        </body>

        </html>
    <?php endif; ?>
<?php endif; ?>