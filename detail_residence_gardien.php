<?php
require_once('connexion.php');
$stmt = $dbh->prepare("SELECT num_individu as 'Numéro', nom_individu as 'Nom', prenom_individu as 'Prénom', 
    adresse_individu as 'Adresse', telephone_individu as 'Numéro de téléphone', 
    e_mail_gardien as 'Adresse email' 
    from Individu natural join Gardien where num_residence = ?");
$stmt->execute([$_GET['id']]);
$gardien = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if ($_SESSION["type"] === "Administrateur" && count($gardien) === 0) { ?>
    <a href="ajouter_un_gardien_a_la_residence.php" class="ajouter espace">
        <img src="img/ajouter.png" width="75">
        <h2 class="espace">Ajouter un gardien à la résidence</h2>
    </a>
<?php } ?>

<?php foreach ($gardien as $elem) { ?>
    <div class="fullWidth presentationJardinier">
        <img src="img/concierge.png" width="200" class="espace">
        <div class="contenuJardinier espace">
            <?php foreach ($elem as $key => $value) { ?>
                <p class="itemDescription"><?= $key ?> : <?= $value ?></p>
            <?php } ?>
            <?php if ($_SESSION["type"] === "Administrateur") { ?>
                <div class="icon espace">
                    <a href="supprimer_le_gardien_de_la_residence.php?residence=<?= $_GET["id"] ?>&id=<?= $elem['Numéro'] ?>" onclick="return confirm('Voulez vous supprimez ce gardien de la residence ?');"><img src="img/supprimer.png" width="50"></a>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>