<?php
require_once("header.php");
require_once("connexion.php");

$stmt = $dbh->prepare("SELECT r.num_residence as 'Numéro', nom_residence as 'Nom', 
    num_syndic as 'Numéro Syndic', r.num_individu as 'Numéro du Contact', 
    surface_de_pelouse as 'Surface de la pelouse', surface_de_baie as 'Surface de haie', 
    surface_espace_vert as 'Surface de l\'espace vert' from Residence as r natural join Descriptif
    join travaille as t on r.num_residence = t.num_residence where t.num_individu = ?");
$stmt->execute([$_SESSION["id"]]);
$info_residence = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="residence_list">
    <?php foreach ($info_residence as $row) { ?>
        <div class="residence_item">
            <a href="detail_residence.php?id=<?= $row['Numéro'] ?>"><img src="img/residence.png" width="400"></a>
            <div class="contenu_residence">
                <?php foreach ($row as $key => $value) { ?>
                    <p><?= $key ?> : <?= $value ?></p>
                <?php } ?>
            </div>
            <img src="https://i.pinimg.com/originals/29/00/d0/2900d0f3eaa923f2893921b652dda131.jpg" width="300">
        </div>
    <?php } ?>
</div>

<?php 
require_once("footer.php");
?> 