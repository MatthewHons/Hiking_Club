<?php
if (isset($_POST['name']) and isset($_POST['distance']) and isset($_POST['duration']) and isset($_POST['elevation']) and isset($_POST['difficulty'])) {
    $name = $_POST['name'];
    $distance = $_POST['distance'];
    $duration = $_POST['duration'];
    $elevation = $_POST['elevation'];
    $difficulty = $_POST['difficulty'];
    $link = "https://images.unsplash.com/photo-1586508896897-a1863f3e515e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80";
}

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
    header("location: ../read.php?message=createdSuccess");
    exit;
} catch (Exception $e) {
    header("location: ../read.php?message=createdFailed");
    exit;
}
