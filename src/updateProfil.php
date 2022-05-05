<?php

if (!empty($_POST)) {
    ob_start();
    if (
        isset($_POST["pseudo"]) && isset($_POST["pwd"]) && !empty($_POST["pseudo"]) && !empty($_POST["pwd"])
    ) {
        $id = $_GET["id"];
        $pseudo = strip_tags($_POST["pseudo"]);
        $pwd = password_hash($_POST["pwd"], PASSWORD_BCRYPT);

        require_once("connexion.php");

        try {
            //$q = $db->prepare("UPDATE hikes (name, difficulty, distance, duration, elevation_gain, Img_link) VALUES (:name, :difficulty, :distance, :duration, :elevation, :link) WHERE ID=$id;");
            $q = $db->prepare("UPDATE users SET pseudo = :pseudo, pwd= :pwd WHERE ID = $id;");

            $q->bindParam(":pseudo", $pseudo, PDO::PARAM_STR, 40);
            $q->bindParam(":pwd", $pwd, PDO::PARAM_STR, 500);
            $q->execute();

            header("location: ../read.php?message=profilUpdate");
            exit;
        } catch (Exception $e) {
            header("location: ../read.php?message=profilFailed");
        }
    } else {
        header("location: ../read.php?message=fillAll");
    }
}
