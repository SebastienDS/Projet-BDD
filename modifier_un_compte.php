<?php 
session_start();
if ($_SESSION["type"] !== "Administrateur") {
    header("location: accueil.php");
}
$_GET = array_filter($_GET);
$_POST = array_filter($_POST);
if (!isset($_GET["id"])) {
    header("location: gestion_des_comptes.php");
}

require_once("header.php");
require_once("connexion.php");
$id = (int)$_GET["id"];

if (!empty($_POST)) {
    $update = true;
    try {
        $dbh->beginTransaction();
        list($individu, $var) = get_modification_individu_query($_POST, $id);
        $stmt_individu = $dbh->prepare($individu);
        $stmt_individu->execute($var);

        list($jardinier, $var) = get_modification_jardinier_query($_POST, $id);
        $stmt_jardinier = $dbh->prepare($jardinier);
        $stmt_jardinier->execute($var); 

        list($authentification, $var) = get_modification_authentification_query($_POST, $id);
        $stmt_authentification = $dbh->prepare($authentification);
        $stmt_authentification->execute($var);  

        $dbh->commit();
    } catch (Exception $e) {
        $update = false;
        $dbh->rollback();
        echo $e->getMessage();
    }
}


list($query, $var) = get_recherche_query(["num_individu" => $id]);
$stmt = $dbh->prepare($query);
$stmt->execute($var);
$infos = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

$stmt = $dbh->prepare("select login, type from authentification where id = ?");
$stmt->execute([$id]);
$infos = array_merge($infos, $stmt->fetchAll(PDO::FETCH_ASSOC)[0] ?? []);



?>

<?php if (isset($update)) { ?>
    <?php if ($update) { ?>
        <div class="espace center">
            <h2 class="bleu">Modification effectué</h2>
        </div>
    <?php } else { ?>
        <div class="espace center">
            <h2 class="rouge">Modification non effectué</h2>
        </div>
    <?php } ?>
<?php } ?>


<div class="espace">
    <h1 class="center">Modification d'un compte</h1>
    <form method="post" class="form">
        <div>
            <label for="nom" class="label">Nom :</label>
            <input type="text" id="nom" name="nom_individu" class="input" value="<?= $infos['Nom'] ?? '' ?>">
        </div>
        <div>
            <label for="prenom" class="label">Prenom :</label>
            <input type="text" id="prenom" name="prenom_individu" class="input" value="<?= $infos['Prénom'] ?? '' ?>">
        </div>
        <div>
            <label for="adresse" class="label">Adresse :</label>
            <input type="text" id="adresse" name="adresse_individu" class="input" value="<?= $infos['Adresse'] ?? '' ?>">
        </div>
        <div>
            <label for="telephone" class="label">Telephone :</label>
            <input type="tel" name="telephone_individu" id="telephone" placeholder="0123456789" pattern="[0-9]{10}" class="input" value="<?= $infos['Numéro de téléphone'] ?? '' ?>">
        </div>
        <div>
            <label for="naissance" class="label">Date de Naissance :</label>
            <input type="date" name="date_de_naissance_jardinier" id="naissance" class="input" value="<?= $infos['Date de naissance'] ?? '' ?>">
        </div>
        <div>
            <label for="sexe" class="label">Sexe :</label>
            <select name="sexe" id="sexe">
                <option value="">Ne sait pas</option>
                <option value="M" <?= (($infos['Sexe'] ?? '') === 'M') ? 'selected' : '' ?>>Homme</option>
                <option value="F" <?= (($infos['Sexe'] ?? '') === 'F') ? 'selected' : '' ?>>Femme</option>
                <option value="Non-binary" <?= (($infos['Sexe'] ?? '') === 'Non-binary') ? 'selected' : '' ?>>Autre</option>
            </select>
        </div>
        <div>
            <label for="diplome" class="label">Diplome :</label>
            <select name="diplome" id="diplome">
                <option value="">Ne sait pas</option>
                <option value="CAP" <?= (($infos['Diplome'] ?? '') === 'CAP') ? 'selected' : '' ?>>CAP</option>
                <option value="BEP" <?= (($infos['Diplome'] ?? '') === 'BEP') ? 'selected' : '' ?>>BEP</option>
                <option value="BAC PRO" <?= (($infos['Diplome'] ?? '') === 'BAC PRO') ? 'selected' : '' ?>>BAC PRO</option>
                <option value="BTS" <?= (($infos['Diplome'] ?? '') === 'BTS') ? 'selected' : '' ?>>BTS</option>
            </select>
        </div>
        <div>
            <label for="anciennete" class="label">Anciennete :</label>
            <select name="anciennete" id="anciennete">
                <option value="">Ne sait pas</option>
                    <option value="débutant" <?= (($infos['Ancienneté'] ?? '') === 'débutant') ? 'selected' : '' ?>>débutant</option>
                    <option value="confirmé" <?= (($infos['Ancienneté'] ?? '') === 'confirmé') ? 'selected' : '' ?>>confirmé</option>
            </select>   
        </div>
        <div>
            <label for="chef" class="label">Possible responsable :</label>
            <select name="possibilite_responsable" id="chef">
                <option value="">Ne sait pas</option>
                <option value="Oui" <?= (($infos['Possibilite responsable'] ?? '') === 'Oui') ? 'selected' : '' ?>>Oui</option>
                <option value="Non" <?= (($infos['Possibilite responsable'] ?? '') === 'Non') ? 'selected' : '' ?>>Non</option>
            </select>
        </div>
        <div>
            <label for="login" class="label">Identifiant du compte :</label>
            <input type="text" id="login" name="login" class="input" value="<?= $infos['login'] ?? '' ?>" required>
        </div>
        <div>
            <label for="password" class="label">Mot de passe :</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="confirm" class="label">Confirmation :</label>
            <input type="password" id="confirm">
        </div>
        <div>
            <label for="type" class="label">Type :</label>
            <select name="type" id="type" required>
                <option value="">None</option>
                <option value="Administrateur" <?= (($infos['type'] ?? '') === 'Administrateur') ? 'selected' : '' ?>>Administrateur</option>
                <option value="Chef Jardinier" <?= (($infos['type'] ?? '') === 'Chef Jardinier') ? 'selected' : '' ?>>Chef Jardinier</option>
                <option value="Jardinier" <?= (($infos['type'] ?? '') === 'Jardinier') ? 'selected' : '' ?>>Jardinier</option>
                <option value="Syndic" <?= (($infos['type'] ?? '') === 'Syndic') ? 'selected' : '' ?>>Syndic</option>
            </select>
        </div>

        <div class="button_form">
            <button type="submit" class="button_gestion">Modifier</button>
            <button type="reset" class="button_gestion">Effacer</button>
        </div>

        <script src="check_password.js"></script>
    </form>
    <a href="gestion_des_comptes.php#<?= $id ?>" class="center espace"><h3>Revenir à la gestion des comptes</h3></a>
</div>

<?php
require_once("footer.php");
?>
