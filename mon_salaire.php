<?php
require_once("header.php");
require_once("connexion.php");

$stmt = $dbh->prepare("select salaire from Salaire natural join Jardinier where num_individu = ?");
$stmt->execute([$_SESSION["id"]]);
$salaire = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
?>

<h1 class="center espace">Votre salaire est de <?= $salaire["salaire"] ?> euros</h1>

<?php 
require_once("footer.php");
?> 