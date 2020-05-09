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
        <img src="https://i.pinimg.com/originals/29/00/d0/2900d0f3eaa923f2893921b652dda131.jpg" width="300">
    </div>
</div>


<div class="fullWidth detail_residence">
    <a href="detail_residence.php?id=<?= htmlentities($id) ?>&page=jardinier" class="detail_residence_item">Jardinier</a>
    <a href="detail_residence.php?id=<?= htmlentities($id) ?>&page=gardien" class="detail_residence_item">Gardien</a>
    <a href="detail_residence.php?id=<?= htmlentities($id) ?>&page=syndic" class="detail_residence_item">Syndic</a>
    <a href="detail_residence.php?id=<?= htmlentities($id) ?>&page=calendrier" class="detail_residence_item">Calendrier</a>
</div>


<div class="fullWidth contenu_detail_residence">
    <?php
    $page = htmlentities($_GET["page"]) ?? 'jardinier';
    if (!in_array($page, ['jardinier', 'gardien', 'syndic', 'calendrier'])) {
        $page = 'jardinier';
    }
    require_once("detail_residence_$page.php");

    ?>
</div>

<?php 
require_once("footer.php");
?> 