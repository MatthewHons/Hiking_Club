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
<section>
    <?php
    //display the datas

    foreach ($hikes as $hike) : ?>
        <?php $date_create = $hike["create_at"];
        $date_update = $hike["update_at"];
        ?>

        <div class=" card_hike" style="background-image: -webkit-linear-gradient(
            top,
            rgba(0, 0, 0, 0.2),
            rgba(255, 255, 255, 0.15)
            ),
            url(<?= $hike["Img_link"] ?>);">

            <?php if ($date_create != $date_update) {
            ?><p> Updated at : <?= date("d-m-Y H:i", strtotime("$date_update")) . "\n"; ?></p>
            <?php } else {
            ?><p> Created at :<?= date("d-m-Y H:i", strtotime("$date_create")) . "\n"; ?></p>
            <?php }

            ?><p><?= $hike["name"]; ?></p>
            <p>Creator : <?= $hike["pseudo"]?></p>
            <p><?= $hike["difficulty"], $hike["distance"] ?> km <?php $duration = (int)$hike["duration"];
                                                                echo intdiv($duration, 60) . 'h' . ($duration % 60); ?> min, <?= $hike["elevation_gain"]; ?> m
                <?php if (isset($_SESSION["user"])) : ?>
                    <?php if (($_SESSION["user"]["ID"] == $hike["id_user"]) || $_SESSION["user"]["is_admin"]) : ?>
                        <a href="update.php?id=<?php echo $hike["ID"]; ?>"><i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </p>

        </div>

    <?php
    endforeach;

    if (isset($_GET['message']) && !empty($_GET['message'])) {
        include './includes/text.php';
    }

    ?>