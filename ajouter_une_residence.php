<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION["type"] !== "Administrateur") {
    header("location: accueil.php");
}
require_once("header.php");
require_once("connexion.php");

$syndic = $dbh->query("SELECT num_syndic from Syndic")->fetchAll(PDO::FETCH_ASSOC);
$contact = $dbh->query("SELECT num_individu from Contact")->fetchAll(PDO::FETCH_ASSOC);

$_POST = array_filter($_POST);

if (!empty($_POST)) {
    $insert = true;
    try {
        $dbh->beginTransaction();
        list($residence, $var) = get_insert_residence_query($_POST);
        $stmt_residence = $dbh->prepare($residence);
        $stmt_residence->execute($var);
        $id = $dbh->lastInsertId();

        list($descriptif, $var) = get_insert_descriptif_query($_POST, $id);
        $stmt_descriptif = $dbh->prepare($descriptif);
        $stmt_descriptif->execute($var);
        
        $dbh->commit();
    } catch (Exception $e) {
        $insert = false;
        $dbh->rollback();
        echo $e->getMessage();
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
    <h1 class="center">Ajouter une résidence</h1>
    <form method="post" class="form">
        <div>
            <label for="numero" class="label">Numéro :</label>
            <input type="number" name="num_residence" id="numero" class="input" min="0">
        </div>
        <div>
            <label for="nom" class="label">Nom :</label>
            <input type="text" id="nom" name="nom_residence" class="input">
        </div>
        <div>
            <label for="num_syndic" class="label">Numéro du Syndic :</label>
            <select name="num_syndic" id="num_syndic">
                <option value=""> --- </option>
                <?php foreach ($syndic as $row) { ?>
                    <option value="<?= $row['num_syndic'] ?>"><?= $row['num_syndic'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="num_contact" class="label">Numéro du contact :</label>
            <select name="num_individu" id="num_contact">
                <option value=""> --- </option>
                <?php foreach ($contact as $row) { ?>
                    <option value="<?= $row['num_individu'] ?>"><?= $row['num_individu'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="surface_de_pelouse" class="label">Surface de pelouse</label>
            <input type="number" name="surface_de_pelouse" id="surface_de_pelouse" class="input" min="0">
        </div>
        <div>
            <label for="surface_de_baie" class="label">Surface de haie</label>
            <input type="number" name="surface_de_baie" id="surface_de_baie" class="input" min="0">
        </div>
        <div>
            <label for="surface_espace_vert" class="label">Surface d'espace vert</label>
            <input type="number" name="surface_espace_vert" id="surface_espace_vert" class="input" min="0">
        </div>
       
        <div class="button_form">
            <button type="submit">Ajouter</button>
            <button type="reset">Effacer</button>
        </div>
    </form>
</div>

<?php
require_once("footer.php");
?>
