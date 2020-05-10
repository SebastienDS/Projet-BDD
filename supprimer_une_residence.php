<?php 
session_start();
if ($_SESSION["type"] !== "Administrateur") {
    header("location: accueil.php");
}
require("verification.php");
require_once("connexion.php");

if (isset($_GET["id"])) {
    $id = (int)$_GET["id"];

    $dbh->exec("set foreign_key_checks = 0");

    $stmt_residence = $dbh->prepare("DELETE from Residence where num_residence = ?");
    $stmt_descriptif = $dbh->prepare("DELETE from Descriptif where num_residence = ?");
    $stmt_residence->execute([$id]);
    $stmt_descriptif->execute([$id]);

    $dbh->exec("set foreign_key_checks = 1");
}

header("location: gerer_les_residences.php");
?>
