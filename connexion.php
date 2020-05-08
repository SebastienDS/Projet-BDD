<?php

require_once("parametre.inc.php");

try {
    $con = "mysql:host=$host;dbname=$db;charset=utf8";
    $dbh = new PDO($con, $user, $pwd, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
} catch (Exception $e) {
    die("Connexion impossible à la base de donnée: " . $e->getMessage());
}

?>