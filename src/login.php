<?php

session_start();

if (!empty($_POST)) {
    // 1. Check all the inputs exist
    // 2. We check also if the $_POST are not empty because we load the page, the form is empty
    if (
        isset($_POST["pseudo"], $_POST["pwd"])
        && !empty($_POST["pseudo"]) && !empty($_POST["pwd"])
    ) {

        $pseudo = strip_tags($_POST["pseudo"]);

        //SQL part
        require_once "connexion.php";
        $q = $db->prepare("SELECT * FROM users WHERE pseudo=:pseudo");

        $q->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);

        if (!$q->execute()) {
            die("form not sent to the db");
        }

        $user = $q->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            header('Location: ./read.php?message=noPseudo');
            exit;
        }

        // check the password input with the password in db
        if (!password_verify($_POST["pwd"], $user["pwd"])) {
            header('Location: ./read.php?message=wrongPwd');
            exit;
        }


        // store data of user in $_SESSION
        $_SESSION["user"] = [
            "ID" => $user["ID"],
            "pseudo" => $user["pseudo"],
            "email" => $user["email"],
            "is_admin" => $user["is_admin"]
        ];

        header("location: read.php");
    }
}

include "header.php";

?>
<div class="container section">
    <h1 class="block title is-3">User Login</h1>

    <form method="post" action="">
        <div>
            <label for="pseudo">Pseudo :</label>
            <input class="input is-medium" type="text" name="pseudo">
        </div>
        <div>
            <label for="pwd">Password</label>
            <input class="input is-medium" type="password" name="pwd">
        </div>
        <button class="button is-link" type="submit">Login</button>
    </form>
</div>