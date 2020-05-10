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

<?php if ($_SESSION["type"] === "Administrateur") { ?>
    <a href="ajouter_un_jardinier_a_la_residence.php?id=<?= $_GET['id'] ?>" class="ajouter espace">
        <img src="img/ajouter.png" width="75">
        <h2 class="espace">Ajouter un jardinier à la résidence</h2>
    </a>
<?php } ?>

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

            <?php if ($_SESSION["type"] === "Administrateur") { ?>
                <div class="icon espace">
                    <a href="supprimer_le_jardinier_de_la_residence.php?residence=<?= $_GET["id"] ?>&id=<?= $elem['Numéro'] ?>" onclick="return confirm('Voulez vous supprimez ce jardinier de la residence ?');"><img src="img/supprimer.png" width="50"></a>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>