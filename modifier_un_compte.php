<?php 
if (!isset($_GET["id"])) {
    header("location: gestion_des_comptes.php");
}
require_once("header.php");
require_once("connexion.php");

$id = (int)$_GET["id"];

list($query, $var) = get_recherche_query(["num_individu" => $id]);
$stmt = $dbh->prepare($query);
$stmt->execute($var);
$infos = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
?>

<div class="espace">
    <h1 class="center">Modification d'un compte</h1>
    <form method="get">
        <div>
            <label for="nom" class="label">Nom :</label>
            <input type="text" id="nom" name="nom_individu" class="input" value="<?= $infos['Nom'] ?>">
        </div>
        <div>
            <label for="prenom" class="label">Prenom :</label>
            <input type="text" id="prenom" name="prenom_individu" class="input" value="<?= $infos['Prénom'] ?>">
        </div>
        <div>
            <label for="adresse" class="label">Adresse :</label>
            <input type="text" id="adresse" name="adresse_individu" class="input" value="<?= $infos['Adresse'] ?>">
        </div>
        <div>
            <label for="telephone" class="label">Telephone :</label>
            <input type="tel" name="telephone_individu" id="telephone" placeholder="0123456789" pattern="[0-9]{10}" class="input" value="<?= $infos['Numéro de téléphone'] ?>">
        </div>
        <div>
            <label for="naissance" class="label">Date de Naissance :</label>
            <input type="date" name="date_de_naissance_jardinier" id="naissance" class="input" value="<?= $infos['Date de naissance'] ?>">
        </div>
        <div>
            <label for="sexe" class="label">Sexe :</label>
            <select name="sexe" id="sexe">
                <option value="">Ne sait pas</option>
                <option value="M" <?= ($infos['Sexe'] === 'M') ? 'selected' : '' ?>>Homme</option>
                <option value="F" <?= ($infos['Sexe'] === 'F') ? 'selected' : '' ?>>Femme</option>
                <option value="Non-binary" <?= ($infos['Sexe'] === 'Non-binary') ? 'selected' : '' ?>>Autre</option>
            </select>
        </div>
        <div>
            <label for="diplome" class="label">Diplome :</label>
            <select name="diplome" id="diplome">
                <option value="">Ne sait pas</option>
                <option value="CAP" <?= ($infos['Diplome'] === 'CAP') ? 'selected' : '' ?>>CAP</option>
                <option value="BEP" <?= ($infos['Diplome'] === 'BEP') ? 'selected' : '' ?>>BEP</option>
                <option value="BAC PRO" <?= ($infos['Diplome'] === 'BAC PRO') ? 'selected' : '' ?>>BAC PRO</option>
                <option value="BTS" <?= ($infos['Diplome'] === 'BTS') ? 'selected' : '' ?>>BTS</option>
            </select>
        </div>
        <div>
            <label for="anciennete" class="label">Anciennete :</label>
            <select name="anciennete" id="anciennete">
                <option value="">Ne sait pas</option>
                    <option value="débutant" <?= ($infos['Ancienneté'] === 'débutant') ? 'selected' : '' ?>>débutant</option>
                    <option value="confirmé" <?= ($infos['Ancienneté'] === 'confirmé') ? 'selected' : '' ?>>confirmé</option>
            </select>   
        </div>
        <div>
            <label for="chef" class="label">Possible responsable :</label>
            <select name="possibilite_responsable" id="chef">
                <option value="">Ne sait pas</option>
                <option value="Oui" <?= ($infos['Possibilite responsable'] === 'Oui') ? 'selected' : '' ?>>Oui</option>
                <option value="Non" <?= ($infos['Possibilite responsable'] === 'Non') ? 'selected' : '' ?>>Non</option>
            </select>
        </div>

        <!-- TODO -->
        <!-- <div>
            <label for="chef" class="label">Possible responsable :</label>
            <select name="possibilite_responsable" id="chef">
                <option value="">Ne sait pas</option>
                <option value="Oui">Oui</option>
                <option value="Non">Non</option>
            </select>
        </div>
        <div>
            <label for="login" class="label">Identifiant du compte :</label>
            <input type="text" id="login" name="login" class="input" required>
        </div>
        <div>
            <label for="password" class="label">Mot de passe :</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="confirm" class="label">Confirmation :</label>
            <input type="password" id="confirm" required>
        </div>
        <div>
            <label for="type" class="label">Type :</label>
            <select name="type" id="type" required>
                <option value="">None</option>
                <option value="Administrateur">Administrateur</option>
                <option value="Chef Jardinier">Chef Jardinier</option>
                <option value="Jardinier">Jardinier</option>
                <option value="Syndic">Syndic</option>
            </select>
        </div> -->

        <div class="button_form">
            <button type="submit">Modifier</button>
            <button type="reset">Effacer</button>
        </div>
    </form>
</div>

<?php
require_once("footer.php");
?>
