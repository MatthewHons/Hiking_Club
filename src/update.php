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
<div class="cont_card">
    <div class="card_hike">
        <div class="card_hike_pict" style="background-image: -webkit-linear-gradient(
                top,
                rgba(0, 0, 0, 0.2),
                rgba(255, 255, 255, 0.15)
                ),
                url(./ressources/image/<?= $modify["Img_link"] ?>.jpeg);background-size: cover;">
        </div>
        <div class="card_hike_txt">
            <p class="card_tittle"><?= $modify["name"]; ?></p>
            <p><img src="https://www.visorando.be/img/fiches/difficulte-moyenne.min.png" title="Moyenne" alt="Moyenne" height="28" width="28"><?= $modify["difficulty"] ?></p>
            <p><img src="https://www.visorando.be/img/fiches/distance.min.png" title="Distance" alt="Distance" height="28" width="28"><?= $modify["distance"] ?> km</p>
            <p><img src="https://www.visorando.be/img/fiches/duree.min.png" title="Durée" alt="Durée" height="28" width="28"><?php $duration = (int)$modify["duration"];
                                                                                                                                echo intdiv($duration, 60) . 'h' . ($duration % 60); ?> min</p>
            <p>
                <img src="https://www.visorando.be/img/fiches/denivele-plus.min.png" title="Dénivelé positif" alt="Dénivelé positif" height="28" width="28"><?= $modify["elevation_gain"]; ?> m
            </p>
        </div>
    </div>
</div>
<?php if (isset($_SESSION["user"])) : ?>
    <?php if (($_SESSION["user"]["ID"] == $modify["id_user"]) || $_SESSION["user"]["is_admin"]) : ?>
        <div class="container section">
            <h1 class="block title is-3">Update your hike</h1>
            <form method="post" action="updateData.php?id=<?= $modify["ID"] ?>">
                <label for="name">Name </label>
                <input class="input is-medium" name="name" type="text" value="<?= $modify["name"]; ?>">
                <label for="distance">Distance </label>
                <input class="input is-medium" name="distance" type="number" value="<?= $modify["distance"]; ?>">
                <label for="duration">Duration </label>
                <input class="input is-medium" name="duration" type="number" value="<?= $modify["duration"]; ?>">
                <label for="elevation">Elevation (+) </label>
                <input class="input is-medium" name="elevation" type="number" value="<?= $modify["elevation_gain"]; ?>">
                <div>
                    <label class="radio">
                        <input type="radio" name="difficulty" value="Easy" <?php echo ($modify['difficulty'] == "Easy" ? 'checked="checked"' : ''); ?>>
                        <span style="color:black">Easy</span>
                    </label>
                </div>
                <div>
                    <label class="radio">
                        <input type="radio" name="difficulty" value="Moderate" <?php echo ($modify['difficulty'] == "Moderate" ? 'checked="checked"' : ''); ?>>
                        <span style="color:black">Moderate</span>
                    </label>
                </div>
                <div>
                    <label class="radio">
                        <input type="radio" name="difficulty" value="Hard" <?php echo ($modify['difficulty'] == "Hard" ? 'checked="checked"' : ''); ?>>
                        <span style="color:black">Hard</span>
                    </label>
                </div>

                <div class="control">
                    <input type="submit" class="button is-link" value="Modify">
                </div>
            </form>
            <button class="button is-danger is-outlined is-pulled-right">
                <a href="delete.php?id=<?= $modify["ID"] ?>">
                    <span>Delete</span>
                    <span class="icon is-small ">
                        <i class="fas fa-times"></i>
                    </span>
            </button>
        </div>
        </body>

        </html>
    <?php endif; ?>
<?php endif; ?>