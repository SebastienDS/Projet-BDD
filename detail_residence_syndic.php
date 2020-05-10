<?php
require_once('connexion.php');
$stmt = $dbh->prepare("SELECT num_syndic, nom_syndic, adresse_syndic from Syndic natural join Jardinier where num_individu = ?");
$stmt->execute([$_SESSION['id']]);
$syndic = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach ($syndic as $elem) { ?>
    <div class="fullWidth presentationJardinier">
        <img src="img/syndic.png" width="200" class="espace">
        <div class="contenuJardinier espace">
            <?php foreach ($elem as $key => $value) { ?>
                <p class="itemDescription"><?= $key ?> : <?= $value ?></p>
            <?php } ?>
        </div>
    </div>
<?php } ?>