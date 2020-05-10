<?php
require_once('connexion.php');
$stmt = $dbh->prepare("SELECT num_syndic, nom_syndic, adresse_syndic from Syndic natural join Jardinier where num_individu = ?");
$stmt->execute([$_SESSION['id']]);
$syndic = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if ($_SESSION["type"] === "Administrateur" && count($syndic) === 0) { ?>
    <a href="ajouter_un_syndic_a_la_residence.php" class="ajouter espace">
        <img src="img/ajouter.png" width="75">
        <h2 class="espace">Ajouter un syndic à la résidence</h2>
    </a>
<?php } ?>

<?php foreach ($syndic as $elem) { ?>
    <div class="fullWidth presentationJardinier">
        <img src="img/syndic.png" width="200" class="espace">
        <div class="contenuJardinier espace">
            <?php foreach ($elem as $key => $value) { ?>
                <p class="itemDescription"><?= $key ?> : <?= $value ?></p>
            <?php } ?>
            <?php if ($_SESSION["type"] === "Administrateur") { ?>
                <div class="icon espace">
                    <a href="supprimer_un_syndic_de_la_residence.php?id=<?= $elem['Numéro'] ?>" onclick="return confirm('Voulez vous supprimez ce syndic de la residence ?');"><img src="img/supprimer.png" width="50"></a>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>