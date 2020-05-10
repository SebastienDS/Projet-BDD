<?php
require_once("header.php");
require_once("connexion.php");

$stmt = $dbh->prepare("SELECT num_residence as 'Numéro', nom_residence as 'Nom', 
    num_syndic as 'Numéro Syndic', num_individu as 'Numéro du Contact', 
    surface_de_pelouse as 'Surface de la pelouse', surface_de_baie as 'Surface de haie', 
    surface_espace_vert as 'Surface de l\'espace vert' from Residence natural join Descriptif");
$stmt->execute([$_SESSION["id"]]);
$info_residence = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<a href="ajouter_une_residence.php" class="ajouter espace">
    <img src="img/ajouter.png" width="75">
    <h2 class="espace">Ajouter une résidence</h2>
</a>

<div class="residence_list">
    <?php foreach ($info_residence as $row) { ?>
        <div class="residence_item">
            <a href="detail_residence.php?id=<?= $row['Numéro'] ?>"><img src="img/residence.png" width="400"></a>
            <div class="contenu_residence">
                <?php foreach ($row as $key => $value) { ?>
                    <p><?= $key ?> : <?= $value ?></p>
                <?php } ?>
                <?php if ($_SESSION["type"] === "Administrateur") { ?>
                    <div>
                        <a href="modifier_une_residence.php?id=<?= $row['Numéro'] ?>" onclick="return confirm('Voulez vous modifier cette résidence ?');"><img src="img/modifier.png" width="40"></a>
                        <a href="supprimer_une_residence.php?id=<?= $row['Numéro'] ?>" onclick="return confirm('Voulez vous supprimez cette résidence ?');"><img src="img/supprimer.png" width="40"></a>
                    </div>
                <?php } ?>
            </div>
            <img src="https://i.pinimg.com/originals/29/00/d0/2900d0f3eaa923f2893921b652dda131.jpg" width="300">
        </div>
    <?php } ?>
</div>

<?php 
require_once("footer.php");
?> 