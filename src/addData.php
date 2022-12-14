<?php
session_start();
// Prend un nombre random entre 1 et 20
$num_rand = rand(1, 43);


// Check if $_POST is not empty
if (!empty($_POST)) {
    // 1. Check all the inputs exist
    // 2. Check also if the $_POST are not empty because we load the page, the form is empty
    if (
        isset($_POST["name"], $_POST["distance"], $_POST["duration"], $_POST["elevation"], $_POST["difficulty"]) &&
        !empty($_POST["name"]) && !empty($_POST["distance"]) && !empty($_POST["duration"]) && !empty($_POST["elevation"]) && !empty($_POST["difficulty"])
    ) {

        // strip_tags for the name
        $name = strip_tags($_POST["name"]);
        $distance = strip_tags($_POST["distance"]);
        $duration = strip_tags($_POST["duration"]);
        $elevation = strip_tags($_POST["elevation"]);
        $difficulty = strip_tags($_POST["difficulty"]);
        $link = $num_rand;
        $id_user = $_SESSION["user"]["ID"];

        require_once("connexion.php");

        try {
            $q = $db->prepare("INSERT INTO hikes (name, difficulty, distance, duration, elevation_gain, Img_link,id_user) VALUES (:name, :difficulty, :distance, :duration, :elevation, :link, :id_user)");
            $q->bindParam(":name", $name, PDO::PARAM_STR, 40);
            $q->bindParam(":difficulty", $difficulty, PDO::PARAM_STR, 20);
            $q->bindParam(":distance", $distance, PDO::PARAM_STR, 6);
            $q->bindParam(":duration", $duration, PDO::PARAM_STR, 5);
            $q->bindParam(":elevation", $elevation, PDO::PARAM_INT, 5);
            $q->bindParam(":link", $link, PDO::PARAM_STR, 20);
            $q->bindParam(":id_user", $id_user, PDO::PARAM_INT, 10);
            $q->execute();
            header("location: ../read.php?message=createdSuccess");
            exit;
        } catch (Exception $e) {
            header("location: ../read.php?message=createdFailed");
            exit;
        }
    } else {
        header("location: ../read.php?message=createdFailedd");
    }
}
