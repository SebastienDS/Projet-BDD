<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION["type"] !== "Administrateur") {
    header("location: accueil.php");
}
require("verification.php");
require_once("connexion.php");

if (isset($_GET["id"])) {
    $id = (int)$_GET["id"];

    $dbh->exec("set foreign_key_checks = 0");

    $stmt_jardinier = $dbh->prepare("DELETE from Jardinier where num_individu = ?");
    $stmt_individu = $dbh->prepare("DELETE from Individu where num_individu = ?");
    $stmt_authentification = $dbh->prepare("DELETE from authentification where id = ?");
    $stmt_residence = $dbh->prepare("DELETE from Residence where num_individu = ?");

    $stmt_jardinier->execute([$id]);
    $stmt_individu->execute([$id]);
    $stmt_authentification->execute([$id]);
    $stmt_residence->execute([$id]);

    $dbh->exec("set foreign_key_checks = 1");

}

header("location: gestion_des_comptes.php");
?>
