<?php 
session_start();
if ($_SESSION["type"] !== "Administrateur") {
    header("location: accueil.php");
}
require("verification.php");
require_once("connexion.php");

if (isset($_GET["id"]) && isset($_GET["residence"])) {
    $num_residence = (int)$_GET["residence"];
    $num_syndic = $_GET["id"];

    $stmt = $dbh->prepare("UPDATE Residence set num_syndic = null where num_residence = ? && num_syndic = ?");
    $stmt->execute([$num_residence, $num_syndic]);
}

header("location: detail_residence.php?id=$num_residence");
?>
