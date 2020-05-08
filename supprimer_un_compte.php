<?php 
require("verification.php");
require_once("connexion.php");

if (isset($_GET["id"])) {
    $id = (int)$_GET["id"];
    $stmt_jardinier = $dbh->prepare("DELETE from Jardinier where num_individu = ?");  //jardinier first (clé etrangere)
    $stmt_individu = $dbh->prepare("DELETE from Individu where num_individu = ?");
    $stmt_authentification = $dbh->prepare("DELETE from authentification where id = ?");

    $stmt_jardinier->execute([$id]);
    $stmt_individu->execute([$id]);
    $stmt_authentification->execute([$id]);
}

header("location: gestion_des_comptes.php");
?>
