<?php
session_start();

require_once("connexion.php");

try {

    //prepare() is a PDO method to make sure that our query is not subject to a SQL inject.
    //this returns a PDOStatement object
    //$q = $db->prepare("SELECT * FROM hikes");
    $q = $db->prepare("SELECT * FROM users RIGHT JOIN hikes ON users.ID = hikes.id_user");

    //$creator='SELECT DISTINCT $users["pseudo"] FROM $users INNER JOIN $hike ON $users["ID"] = $hike["id_user"] WHERE $user["ID"]';

    //To execute the query set into $q (PDOStatement) object
    $q->execute();
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

// PDO::FETCH_ASSOC to display only the columns as keys in the array returned
$hikes = $q->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include 'header.php'; ?>
<div class="cont_card">
    <?php
    //display the datas

    foreach ($hikes as $hike) : ?>
        <?php $date_create = $hike["create_at"];
        $date_update = $hike["update_at"];
        ?>
        <div class="card_hike">
            <div class="card_hike_pict" style="background-image: -webkit-linear-gradient(
                top,
                rgba(0, 0, 0, 0.2),
                rgba(255, 255, 255, 0.15)
                ),
                url(./ressources/image/<?= $hike["Img_link"] ?>.jpeg);background-size: cover;">
            </div>
            <div class="card_hike_txt">






                <p class="card_tittle"><?= $hike["name"]; ?></p>
                <?php if ($date_create != $date_update) {
                ?><p> Updated at : <?= date("d-m-Y H:i", strtotime("$date_update")) . "\n"; ?></p>
                <?php } else {
                ?><p> Created at :<?= date("d-m-Y H:i", strtotime("$date_create")) . "\n"; ?></p>
                <?php }

                ?>
                <p>Creator : <?= $hike["pseudo"] ?></p>
                <p><img src="https://www.visorando.be/img/fiches/difficulte-moyenne.min.png" title="Moyenne" alt="Moyenne" height="28" width="28"><?= $hike["difficulty"] ?></p>
                <p><img src="https://www.visorando.be/img/fiches/distance.min.png" title="Distance" alt="Distance" height="28" width="28"><?= $hike["distance"] ?> km</p>
                <p><img src="https://www.visorando.be/img/fiches/duree.min.png" title="Durée" alt="Durée" height="28" width="28"><?php $duration = (int)$hike["duration"];
                                                                                                                                    echo intdiv($duration, 60) . 'h' . ($duration % 60); ?> min</p>
                <p><img src="https://www.visorando.be/img/fiches/denivele-plus.min.png" title="Dénivelé positif" alt="Dénivelé positif" height="28" width="28"><?= $hike["elevation_gain"]; ?> m</p>
                <?php if (isset($_SESSION["user"])) : ?>
                    <?php if (($_SESSION["user"]["ID"] == $hike["id_user"]) || $_SESSION["user"]["is_admin"]) : ?>
                        <a href="update.php?id=<?php echo $hike["ID"]; ?>"><i class="fa-xl fa-solid fa-pen-to-square is-pulled-right"></i>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
                </p>
            </div>
        </div>

    <?php
    endforeach; ?>
</div>
<?php
if (isset($_GET['message']) && !empty($_GET['message'])) {
    include './includes/text.php';
}

?>