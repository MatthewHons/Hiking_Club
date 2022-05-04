<?php

// open the $_SESSION
session_start();

// Check if $_POST is not empty
if (!empty($_POST)) {
    // 1. Check all the inputs exist
    // 2. Check also if the $_POST are not empty because we load the page, the form is empty
    if (
        isset($_POST["pseudo"], $_POST["email"], $_POST["pwd"]) &&
        !empty($_POST["pseudo"]) && !empty($_POST["email"]) && !empty($_POST["pwd"])
    ) {

        // strip_tags for the login
        $pseudo = strip_tags($_POST["pseudo"]);

        // check valid email
        if (!filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
            die("email invalid");
        }

        // hash the password
        $pwd = password_hash($_POST["pwd"], PASSWORD_BCRYPT);

        //SQL part
        require_once "connexion.php";


        $q = $db->prepare('SELECT pseudo FROM users WHERE pseudo = :login');
        $q->bindParam(":login", $pseudo, PDO::PARAM_STR);
        $q->execute();
        $dataLogin = $q->fetch();
        if ($dataLogin) // Si une valeur est retournée c'est qu'un utilisateur possède déjà l'Username.
        {
            header("location: ./read.php?message=userNameUsed");
            exit;
        }


        $q = $db->prepare('SELECT email FROM users WHERE email = :email');
        $q->bindParam(":email", $_POST["email"], PDO::PARAM_STR);
        $q->execute();
        $dataEmail = $q->fetch();
        if ($dataEmail) // Si une valeur est retournée c'est qu'un utilisateur possède déjà l'email.
        {
            header("location: ./read.php?message=emailUsed");
            exit;
        }

        $q = $db->prepare("INSERT INTO users(pseudo, email, pwd) VALUES (:pseudo, :email, :pwd)");

        // bindParam() accepte uniquement une variable qui est interprétée au moment de l'execute()
        $q->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
        $q->bindParam(":email", $_POST["email"], PDO::PARAM_STR);
        $q->bindParam(":pwd", $pwd, PDO::PARAM_STR);

        // check the execute() -> return a boolean
        if (!$q->execute()) {
            die("form not sent to the db");
        }

        // retreive the last ID
        $id = $db->lastInsertId();

        // store data of user in $_SESSION
        $_SESSION["user"] = [
            "ID" => $id,
            "pseudo" => $pseudo,
            "email" => $_POST["email"]
        ];

        // redirect to index when done
        header("location: ../read.php?message=subscriptionSuccess");
    } else {
        header("location: ../index.php?message=subscriptionFailed");
        exit;
    }
}

include "header.php";

?>

<h1>User subscription</h1>

<form method="post" action="">
    <div>
        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo">
    </div>
    <div>
        <label for="email">Email :</label>
        <input type="email" name="email">
    </div>
    <div>
        <label for="pwd">Password :</label>
        <input type="password" name="pwd">
    </div>
    <button type="submit">Subscribe</button>
</form>