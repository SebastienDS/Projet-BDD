<?php 
require_once("header.php");
require_once("connexion.php");

$diplome = $dbh->query("SELECT distinct diplome from Jardinier")->fetchAll(PDO::FETCH_ASSOC);
$anciennete = $dbh->query("SELECT distinct anciennete from Jardinier")->fetchAll(PDO::FETCH_ASSOC);
$_POST = array_filter($_POST);
list($query, $var) = get_recherche_query($_POST);
$stmt = $dbh->prepare($query);
$stmt->execute($var);
$jardinier = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="espace">
    <form method="post">
        <div>
            <label for="nom" class="label">Nom :</label>
            <input type="text" id="nom" name="nom_individu" class="input">
        </div>
        <div>
            <label for="prenom" class="label">Prenom :</label>
            <input type="text" id="prenom" name="prenom_individu" class="input">
        </div>
        <div>
            <label for="adresse" class="label">Adresse :</label>
            <input type="text" id="adresse" name="adresse_individu" class="input">
        </div>
        <div>
            <label for="telephone" class="label">Telephone :</label>
            <input type="tel" name="telephone_individu" id="telephone" placeholder="0123456789" pattern="[0-9]{10}" class="input">
        </div>
        <div>
            <label for="naissance" class="label">Date de Naissance :</label>
            <input type="date" name="date_de_naissance_jardinier" id="naissance" class="input">
        </div>
        <div>
            <label for="sexe" class="label">Sexe :</label>
            <select name="sexe" id="sexe">
                <option value="">Ne sait pas</option>
                <option value="M">Homme</option>
                <option value="F">Femme</option>
                <option value="Non-binary">Autre</option>
            </select>
        </div>
        <div>
            <label for="diplome" class="label">Diplome :</label>
            <select name="diplome" id="diplome">
                <option value="">Ne sait pas</option>
                <?php foreach ($diplome as $row) { ?>
                    <option value="<?= $row['diplome'] ?>"><?= $row['diplome'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="anciennete" class="label">Anciennete :</label>
            <select name="anciennete" id="anciennete">
                <option value="">Ne sait pas</option>
                <?php foreach ($anciennete as $row) { ?>
                    <option value="<?= $row['anciennete'] ?>"><?= $row['anciennete'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="chef" class="label">Possible responsable :</label>
            <select name="possibilite_responsable" id="chef">
                <option value="">Ne sait pas</option>
                <option value="Oui">Oui</option>
                <option value="Non">Non</option>
            </select>
        </div>

        <div class="button_form">
            <button type="submit">Rechercher</button>
            <button type="reset">Effacer</button>
        </div>
    </form>
</div>

<?php foreach ($jardinier as $elem) { 
    if ($elem['Numéro du chef'] === NULL) {
        $elem['Numéro du chef'] = $elem['Numéro'];
    } 
    $link = $elem['Numéro du chef'] === $elem['Numéro'] ? "ChefJardinier" : "jardinier";
    ?>
    <div class="fullWidth presentationJardinier">
        <img src="img/<?= $link ?>.jpg" width="200" class="espace">
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
