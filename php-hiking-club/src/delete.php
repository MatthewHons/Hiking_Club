<?php
ob_start();
$id = $_GET["id"];

// connect to the database and select the publisher
require_once("connexion.php");

// construct the delete statement
$sql = 'DELETE FROM hikes
        WHERE ID = :id';
echo $id;
// prepare the statement for execution
$statement = $db->prepare($sql);
$statement->bindParam(':id', $id, PDO::PARAM_INT);

// execute the statement
if ($statement->execute()) {
    header("location: ../read.php?message=deleteSuccess");
}
