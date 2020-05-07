<?php 
require_once("header.php");
require_once("connexion.php");

$diplome = $dbh->query("SELECT distinct diplome from Jardinier")->fetchAll(PDO::FETCH_ASSOC);
$anciennete = $dbh->query("SELECT distinct anciennete from Jardinier")->fetchAll(PDO::FETCH_ASSOC);
$_GET = array_filter($_GET);
echo "<pre>";
var_dump($_GET);
echo "</pre>";
?>

<div class="espace">
    <form method="get">
        <div>
            <label for="nom" class="label">Nom :</label>
            <input type="text" id="nom" name="nom" class="input">
        </div>
        <div>
            <label for="prenom" class="label">Prenom :</label>
            <input type="text" id="prenom" name="prenom" class="input">
        </div>
        <div>
            <label for="adresse" class="label">Adresse :</label>
            <input type="text" id="adresse" name="adresse" class="input">
        </div>
        <div>
            <label for="telephone" class="label">Telephone :</label>
            <input type="tel" name="telephone" id="telephone" placeholder="01 23 45 67 89" pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" class="input">
        </div>
        <div>
            <label for="naissance" class="label">Date de Naissance :</label>
            <input type="date" name="naissance" id="naissance" class="input">
        </div>
        <div>
            <label for="sexe" class="label">Sexe :</label>
            <select name="sexe" id="sexe">
                <option value="">Ne sait pas</option>
                <option value="H">Homme</option>
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
            <label for="chef" class="label">Est Chef :</label>
            <select name="chef" id="chef">
                <option value="">Ne sait pas</option>
                <option value="1">Oui</option>
                <option value="0">Non</option>
            </select>
        </div>

        <div class="button_form">
            <button type="submit">Rechercher</button>
        </div>
    </form>
</div>

<?php
require_once("footer.php");
?>
