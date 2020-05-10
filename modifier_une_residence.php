<?php 
session_start();
if ($_SESSION["type"] !== "Administrateur") {
    header("location: accueil.php");
}
if (!isset($_GET["id"])) {
    header("location: gestion_des_comptes.php");
}
require_once("header.php");
require_once("connexion.php");

$id = (int)$_GET["id"];

$syndic = $dbh->query("SELECT num_syndic from Syndic")->fetchAll(PDO::FETCH_ASSOC);
$contact = $dbh->query("SELECT num_individu from Contact")->fetchAll(PDO::FETCH_ASSOC);

$_POST = array_filter($_POST);


$stmt = $dbh->prepare("SELECT * from Residence as r natural join Descriptif where num_residence = ?");
$stmt->execute([$id]);
$infos = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
$infos = array_filter($infos);


if (!empty($_POST)) {
    $update = true;
    try {
        $dbh->beginTransaction();
        list($residence, $var) = get_modification_residence_query($_POST, $id);
        $stmt_residence = $dbh->prepare($residence);
        $stmt_residence->execute($var);

        list($descriptif, $var) = get_modification_descriptif_query($_POST, $id);
        $stmt_descriptif = $dbh->prepare($descriptif);
        $stmt_descriptif->execute($var);
        
        $dbh->commit();
    } catch (Exception $e) {
        $update = false;
        $dbh->rollback();
        echo $e->getMessage();
    }
}
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
    <h1 class="center">Modifier une résidence</h1>
    <form method="post" class="form">
        <div>
            <label for="nom" class="label">Nom :</label>
            <input type="text" id="nom" name="nom_residence" class="input" value="<?= $infos['nom_residence'] ?? '' ?>">
        </div>
        <div>
            <label for="num_syndic" class="label">Numéro du Syndic :</label>
            <select name="num_syndic" id="num_syndic">
                <option value=""> --- </option>
                <?php foreach ($syndic as $row) { ?>
                    <option value="<?= $row['num_syndic'] ?>" <?= ($infos['num_syndic'] ?? '') === $row['num_syndic'] ? 'selected' : '' ?>><?= $row['num_syndic'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="num_contact" class="label">Numéro du contact :</label>
            <select name="num_individu" id="num_contact">
                <option value=""> --- </option>
                <?php foreach ($contact as $row) { ?>
                    <option value="<?= $row['num_individu'] ?>" <?= ($infos['num_individu'] ?? '') === $row['num_individu'] ? 'selected' : '' ?>><?= $row['num_individu'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="surface_de_pelouse" class="label">Surface de pelouse</label>
            <input type="number" name="surface_de_pelouse" id="surface_de_pelouse" class="input" min="0" value="<?= $infos['surface_de_pelouse'] ?? '' ?>">
        </div>
        <div>
            <label for="surface_de_baie" class="label">Surface de haie</label>
            <input type="number" name="surface_de_baie" id="surface_de_baie" class="input" min="0" value="<?= $infos['surface_de_baie'] ?? '' ?>">
        </div>
        <div>
            <label for="surface_espace_vert" class="label">Surface d'espace vert</label>
            <input type="number" name="surface_espace_vert" id="surface_espace_vert" class="input" min="0" value="<?= $infos['surface_espace_vert'] ?? '' ?>">
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
