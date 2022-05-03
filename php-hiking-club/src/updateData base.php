<?php

echo $_GET["id"];

// Check if $_POST is not empty
if (!empty($_POST)) {
    // 1. Check all the inputs exist
    // 2. Check also if the $_POST are not empty because we load the page, the form is empty
    if (
        isset($_POST["name"], $_POST["distance"], $_POST["duration"], $_POST["elevation"], $_POST["difficulty"]) &&
        !empty($_POST["name"]) && !empty($_POST["distance"]) && !empty($_POST["duration"]) && !empty($_POST["elevation"]) && !empty($_POST["difficulty"])
    ) {
        $id=$_GET["id"];
        // strip_tags for the name
        $name = strip_tags($_POST["name"]);
        $distance = strip_tags($_POST["distance"]);
        $duration = strip_tags($_POST["duration"]);
        $elevation = strip_tags($_POST["elevation"]);
        $difficulty = strip_tags($_POST["difficulty"]);
        $link = "https://images.unsplash.com/photo-1586508896897-a1863f3e515e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80";



        require_once("connexion.php");

        try {
            //$q = $db->prepare("UPDATE hikes (name, difficulty, distance, duration, elevation_gain, Img_link) VALUES (:name, :difficulty, :distance, :duration, :elevation, :link) WHERE ID=$id;");
            $q = $db->prepare("UPDATE hikes SET name = :name, difficulty = :difficulty, distance = :distance, duration = :duration, elevation_gain = :elevation_gain, Img_link = :link WHERE ID = $id;");
            //$q->bindParam(":id", $id, PDO::PARAM_INT, 40);
            $q->bindParam(":name", $name, PDO::PARAM_STR, 40);
            $q->bindParam(":difficulty", $difficulty, PDO::PARAM_STR, 20);
            $q->bindParam(":distance", $distance, PDO::PARAM_STR, 6);
            $q->bindParam(":duration", $duration, PDO::PARAM_STR, 5);
            $q->bindParam(":elevation", $elevation, PDO::PARAM_INT, 5);
            $q->bindParam(":link", $link, PDO::PARAM_STR, 200);
            $q->execute();
            header("location: ../read.php?message=createdSuccess");
            exit;
        } catch (Exception $e) {
            //header("location: ../read.php?message=createdFailed");
            exit;
        }
    } else {
        header("location: ../read.php?message=createdFailed");
    }
}
?>