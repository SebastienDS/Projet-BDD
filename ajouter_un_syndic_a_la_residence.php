<?php 
session_start();
if ($_SESSION["type"] !== "Administrateur") {
    header("location: accueil.php");
}
require_once("header.php");
require_once("connexion.php");

$_POST = array_filter($_POST);
$num = $dbh->query("SELECT num_syndic from Syndic")->fetchAll(PDO::FETCH_ASSOC);


if (!empty($_POST)) {
    $insert = true;
    try {
        $stmt = $dbh->prepare("UPDATE Residence set num_syndic = ? where num_residence = ?");
        $stmt->execute([$_POST["num_syndic"], $_GET["id"]]);
    } catch (Exception $e) {
        $insert = false;
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
    <h1 class="center">Ajouter un jardinier à la résidence</h1>
    <form method="post" class="form">
        <div>
            <label for="num" class="label">Numéro du jardinier :</label>
            <select name="num_syndic" id="num" required>
                <option value="">- - -</option>
                <?php foreach ($num as $row) { ?>
                    <option value="<?= $row["num_syndic"] ?>"><?= $row["num_syndic"] ?></option>
                <?php } ?>
                
            </select>
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
