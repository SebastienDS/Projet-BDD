<?php
require_once('connexion.php');
$stmt = $dbh->prepare("SELECT num_individu as 'Numéro', nom_individu as 'Nom', prenom_individu as 'Prénom', 
    adresse_individu as 'Adresse', telephone_individu as 'Numéro de téléphone', 
    date_de_naissance_jardinier as 'Date de naissance', sexe as 'Sexe', diplome as 'Diplome', 
    anciennete as 'Ancienneté', possibilite_responsable as 'Possibilite responsable', 
    num_individu_membre as 'Numéro du chef' 
    from Individu natural join Jardinier natural join travaille where num_residence = ?");
$stmt->execute([$_GET['id']]);
$jardinier = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<?php foreach ($jardinier as $elem) { 
    if ($elem['Numéro du chef'] === NULL) {
        $elem['Numéro du chef'] = $elem['Numéro'];
    } 
    $link = $elem['Numéro du chef'] === $elem['Numéro'] ? "ChefJardinier" : "jardinier";
    ?>
    <div class="fullWidth presentationJardinier" id="<?= $elem['Numéro'] ?>">
        <img src="img/<?= $link ?>.jpg" width="200" class="espace">
        <div class="contenuJardinier espace">
            <?php foreach ($elem as $key => $value) { ?>
                <p class="itemDescription"><?= $key ?> : <?= $value ?></p>
            <?php } ?>
        </div>
    </div>
<?php } ?>