<?php
if (isset($_GET["num_trimestre"]) && isset($_GET["annee"])) {
    $num = $_GET["num_trimestre"];
    $annee = $_GET["annee"];

    require_once("connexion.php");  
    $stmt = $dbh->prepare("SELECT date_debut as 'Début', date_fin as 'Fin', libelle_tache as 'Tache', 
        concat(nom_individu, ' ', prenom_individu) as 'Jardinier', jour as 'Jour', 
        heure_de_travail as 'Nombre d\'heure' from Calendrier natural join Intervention 
        natural join effectue natural join Tache natural join Individu
        where num_residence = ? and num_trimestre = ? and annee = ? order by date_debut, jour");
    $stmt->execute([$_GET["id"], $num, $annee]);
    $calendrier = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>


<form method="get" class="fullWidth center">
    <?php if (isset($calendrier) && !$calendrier) { ?>
        <h2 class="espace">Calendrier non trouvé !</h2>
    <?php } ?> 

    <p class="espace">Choisissez le calendrier</p>
    <div class="flex_center">
        <div class="form_calendrier">
            <select name="num_trimestre" id="trimestre" class="select_calendrier" required>
                <option value="">Trimestre</option>
                <option value="1" <?= ($num ?? "") === "1" ? "selected" : "" ?>>1</option>
                <option value="2" <?= ($num ?? "") === "2" ? "selected" : "" ?>>2</option>
                <option value="3" <?= ($num ?? "") === "3" ? "selected" : "" ?>>3</option>
            </select>
            <select name="annee" id="annee" class="select_calendrier" required>
                <option value="">annee</option>
                <?php for ($i=date("Y"); $i >= 1900; $i--) { ?>
                    <option value="<?= $i ?>" <?= ($annee ?? "") === $i ? "selected" : "" ?>><?= $i ?></option>
                <?php } ?>
            </select>
            <button type="submit">OK</button>
        </div>
    </div>

    <input type="hidden" name="id" value="<?= htmlentities($_GET["id"]) ?>">
    <input type="hidden" name="page" value="<?= htmlentities($_GET["page"]) ?>">
</form>

<?php if (isset($calendrier) && $calendrier) { ?>
    <div class="espace">
        <table class="fullWidth table_calendrier">
            <tr>
                <?php foreach ($calendrier[0] as $key => $_) { ?>
                    <th><?= $key ?></th>
                <?php } ?>
            </tr>
            <?php foreach ($calendrier as $row) { ?>
                <tr>
                    <?php foreach ($row as $value) { ?>
                        <td class="center"><?= $value ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php } ?> 