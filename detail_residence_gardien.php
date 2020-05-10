<?php
require_once('connexion.php');
$stmt = $dbh->prepare("SELECT num_individu as 'Numéro', nom_individu as 'Nom', prenom_individu as 'Prénom', 
    adresse_individu as 'Adresse', telephone_individu as 'Numéro de téléphone', 
    e_mail_gardien as 'Adresse email' 
    from Individu natural join Gardien where num_residence = ?");
$stmt->execute([$_GET['id']]);
$jardinier = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<?php foreach ($jardinier as $elem) { ?>
    <div class="fullWidth presentationJardinier" id="<?= $elem['Numéro'] ?>">
        <img src="img/concierge.png" width="200" class="espace">
        <div class="contenuJardinier espace">
            <?php foreach ($elem as $key => $value) { ?>
                <p class="itemDescription"><?= $key ?> : <?= $value ?></p>
            <?php } ?>
        </div>
    </div>
<?php } ?>