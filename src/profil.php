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
    $q = $db->prepare("SELECT * FROM users WHERE ID=:id");

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
<div>
    <p> <?= $modify["pseudo"]; ?></p>
    <p><?= $modify["email"]; ?></p>
</div>
<h2>Modify your profil</h2>
<form method="post" action="updateProfil.php?id=<?= $id ?>">
    <label for="pseudo">Pseudo</label>
    <input class="input is-medium" name="pseudo" type="text" value="<?= $modify["pseudo"]; ?>">
    <label for="pwd">Password</label>
    <input class="input is-medium" name="pwd" type="password">
    <div class="control">
        <input type="submit" class="button is-link" value="Modify">
    </div>
</form>
<button class=" button is-danger is-outlined is-pulled-right">
    <a href="delete.php?id=<?= $modify["ID"] ?>">
        <span>Delete</span>
        <span class="icon is-small ">
            <i class="fas fa-times"></i>
        </span>
</button>
</body>

</html>