<?php

if (!isset($_GET["id"])) {
    header("location: accueil.php");
}
$id = (int)$_GET["id"];

require_once("header.php");
require_once("connexion.php");

$stmt = $dbh->prepare("SELECT num_residence as 'Numéro', nom_residence as 'Nom', num_syndic as 'Numéro Syndic', num_individu as 'Numéro du jardinier Responsable' from Residence where num_residence = ?");
$stmt->execute([$id]);
$info_residence = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="residence_list">
    <div class="residence_item">
        <img src="img/residence.png" width="400">
        <div class="contenu_residence">
            <?php foreach ($info_residence[0] as $key => $value) { ?>
                <p><?= $key ?> : <?= $value ?></p>
            <?php } ?>
        </div>
        <img src="img/residence.png" width="300">
    </div>
</div>


<div class="fullWidth detail_residence">
    <a href="" class="detail_residence_item">Jardinier</a>
    <a href="" class="detail_residence_item">Gardien</a>
    <a href="" class="detail_residence_item">Syndic</a>
    <a href="" class="detail_residence_item">Calendrier</a>
</div>

<?php 
require_once("footer.php");
?> 