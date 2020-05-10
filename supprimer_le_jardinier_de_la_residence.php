<?php 
session_start();
if ($_SESSION["type"] !== "Administrateur") {
    header("location: accueil.php");
}
require("verification.php");
require_once("connexion.php");

if (isset($_GET["id"]) && isset($_GET["residence"])) {
    $num_residence = (int)$_GET["residence"];
    $num_individu = $_GET["id"];

    $dbh->exec("set foreign_key_checks = 0");

    $stmt = $dbh->prepare("DELETE from travaille where num_individu = ? and num_residence = ?");
    $stmt->execute([$num_individu, $num_residence]);

    $dbh->exec("set foreign_key_checks = 1");

}

header("location: detail_residence.php?id=$num_residence");
?>
