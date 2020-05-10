<?php
require_once("header.php");
require_once('connexion.php');
$stmt = $dbh->prepare("SELECT num_syndic, nom_syndic, adresse_syndic from Residence natural join Syndic where num_residence = ?");
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

<?php 
require_once("footer.php");
?> 