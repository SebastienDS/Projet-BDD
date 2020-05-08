<?php 
require_once("header.php");
require_once("connexion.php");

$diplome = $dbh->query("SELECT distinct diplome from Jardinier")->fetchAll(PDO::FETCH_ASSOC);
$anciennete = $dbh->query("SELECT distinct anciennete from Jardinier")->fetchAll(PDO::FETCH_ASSOC);
$_POST = array_filter($_POST);

if (!empty($_POST)) {
    $stmt = $dbh->prepare("SELECT id from authentification where login = ? and password = sha1(?)");
    $stmt->execute([$_POST["login"], $_POST["password"]]);
    $password_used = $stmt->fetchAll();

    if (!$password_used) {
        $insert = true;
        try {
            $dbh->beginTransaction();
            list($individu, $var) = get_insert_individu_query($_POST);
            $stmt_individu = $dbh->prepare($individu);
            $stmt_individu->execute($var);  // individu
            $id = $dbh->lastInsertId();

            list($jardinier, $var) = get_insert_jardinier_query($_POST, $id);
            $stmt_jardinier = $dbh->prepare($jardinier);
            $stmt_jardinier->execute($var);  // jardinier

            list($authentification, $var) = get_insert_authentification_query($_POST, $id);
            $stmt_authentification = $dbh->prepare($authentification);
            $stmt_authentification->execute($var);  // authentification

            $dbh->commit();
        } catch (Exception $e) {
            $insert = false;
            $dbh->rollback();
            echo $e->getMessage();
        }
    } else {
        $insert = false;
    }
}
?>

<?php if (isset($insert)) { ?>
    <?php if ($insert) { ?>
        <div class="espace center">
            <h2 class="bleu">Ajout effectué</h2>
        </div>
    <?php } else { ?>
        <div class="espace center">
            <h2 class="rouge">Ajout non effectué</h2>
        </div>
    <?php } ?>
<?php } ?>



<div class="espace">
    <h1 class="center">Ajouter un compte</h1>
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
        </div>

        <div class="button_form">
            <button type="submit">Ajouter</button>
            <button type="reset">Effacer</button>
        </div>

        <script>
            const password = document.getElementById("password")
            const confirm_password = document.getElementById("confirm");

            function validatePassword(){
                if (password.value != confirm_password.value) {
                    confirm_password.setCustomValidity("Mot de passe incorrect");
                } else {
                    confirm_password.setCustomValidity('');
                }
            }

            password.onchange = validatePassword;
            confirm_password.onkeyup = validatePassword;
        </script>

    </form>
</div>

<?php
require_once("footer.php");
?>
