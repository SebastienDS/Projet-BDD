<?php
require_once("header.php");
require_once("connexion.php");

$info_residence = $dbh->query("SELECT num_residence as 'Numéro', nom_residence as 'Nom', num_syndic as 'Numéro Syndic', num_individu as 'Numéro du jardinier Responsable' from Residence")->fetchAll(PDO::FETCH_ASSOC);
// select * from Residence where num_individu in (select num_individu from Individu natural left join Jardinier where (num_individu_membre is not null and num_individu_membre = 18)  or num_individu = 18);
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
            <img src="img/residence.png" width="300">
        </div>
    <?php } ?>
</div>

<?php 
require_once("footer.php");
?> 