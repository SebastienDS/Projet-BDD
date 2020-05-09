<?php 
require_once("header.php");
require_once("connexion.php");

$diplome = $dbh->query("SELECT distinct diplome from Jardinier")->fetchAll(PDO::FETCH_ASSOC);
$anciennete = $dbh->query("SELECT distinct anciennete from Jardinier")->fetchAll(PDO::FETCH_ASSOC);
$num = $dbh->query("SELECT num_individu from Jardinier order by num_individu")->fetchAll(PDO::FETCH_ASSOC);
$_GET = array_filter($_GET);
list($query, $var) = get_recherche_query($_GET);
$stmt = $dbh->prepare($query);
$stmt->execute($var);
$jardinier = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="espace">
    <h1 class="center">Rechercher</h1>
    <form method="get">
        <div>
            <label for="numero" class="label">Numéro :</label>
            <select name="num_individu" id="numero">
                <option value="">Ne sait pas</option>
                <?php foreach ($num as $row) { ?>
                    <option value="<?= $row['num_individu']?>" <?= (($_GET['num_individu'] ?? '') == $row['num_individu']) ? 'selected' : '' ?>><?= $row['num_individu'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="nom" class="label">Nom :</label>
            <input type="text" id="nom" name="nom_individu" class="input" value="<?= $_GET['nom_individu'] ?? '' ?>">
        </div>
        <div>
            <label for="prenom" class="label">Prenom :</label>
            <input type="text" id="prenom" name="prenom_individu" class="input" value="<?= $_GET['prenom_individu'] ?? '' ?>">
        </div>
        <div>
            <label for="adresse" class="label">Adresse :</label>
            <input type="text" id="adresse" name="adresse_individu" class="input" value="<?= $_GET['adresse_individu'] ?? '' ?>">
        </div>
        <div>
            <label for="telephone" class="label">Telephone :</label>
            <input type="tel" name="telephone_individu" id="telephone" placeholder="0123456789" pattern="[0-9]{10}" class="input" value="<?= $_GET['telephone_individu'] ?? '' ?>">
        </div>
        <div>
            <label for="naissance" class="label">Date de Naissance :</label>
            <input type="date" name="date_de_naissance_jardinier" id="naissance" class="input" value="<?= $_GET['date_de_naissance_jardinier'] ?? '' ?>">
        </div>
        <div>
            <label for="sexe" class="label">Sexe :</label>
            <select name="sexe" id="sexe">
                <option value="">Ne sait pas</option>
                <option value="M" <?= (($_GET['sexe'] ?? '') === 'M') ? 'selected' : '' ?>>Homme</option>
                <option value="F" <?= (($_GET['sexe'] ?? '') === 'F') ? 'selected' : '' ?>>Femme</option>
                <option value="Non-binary" <?= (($_GET['sexe'] ?? '') === 'Non-binary') ? 'selected' : '' ?>>Autre</option>
            </select>
        </div>
        <div>
            <label for="diplome" class="label">Diplome :</label>
            <select name="diplome" id="diplome">
                <option value="">Ne sait pas</option>
                <?php foreach ($diplome as $row) { ?>
                    <option value="<?= $row['diplome'] ?>" <?= (($_GET['diplome'] ?? '') === $row['diplome']) ? 'selected' : '' ?>><?= $row['diplome'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="anciennete" class="label">Anciennete :</label>
            <select name="anciennete" id="anciennete">
                <option value="">Ne sait pas</option>
                <?php foreach ($anciennete as $row) { ?>
                    <option value="<?= $row['anciennete'] ?>" <?= (($_GET['anciennete'] ?? '') === $row['anciennete']) ? 'selected' : '' ?>><?= $row['anciennete'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="chef" class="label">Possible responsable :</label>
            <select name="possibilite_responsable" id="chef">
                <option value="">Ne sait pas</option>
                <option value="Oui" <?= (($_GET['possibilite_responsable'] ?? '') === 'Oui') ? 'selected' : '' ?>>Oui</option>
                <option value="Non" <?= (($_GET['possibilite_responsable'] ?? '') === 'Non') ? 'selected' : '' ?>>Non</option>
            </select>
        </div>

        <div class="button_form">
            <button type="submit">Rechercher</button>
            <button type="reset">Effacer</button>
        </div>
    </form>
</div>


<a href="ajouter_un_compte.php" class="ajouter espace">
    <img src="img/ajouter.png" width="75">
    <h2 class="espace">Ajouter un compte</h2>
</a>

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
        <div class="icon espace">
            <a href="modifier_un_compte.php?id=<?= $elem['Numéro'] ?>" onclick="return confirm('Voulez vous modifier ce compte ?');"><img src="img/modifier.png" width="50"></a>
            <a href="supprimer_un_compte.php?id=<?= $elem['Numéro'] ?>" onclick="return confirm('Voulez vous supprimez ce compte ?');"><img src="img/supprimer.png" width="50"></a>
        </div>
    </div>
<?php } ?>

<?php
require_once("footer.php");
?>
