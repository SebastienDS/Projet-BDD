<?php
require_once("header.php");
require_once("connexion.php");  

$stmt = $dbh->prepare("SELECT num_outil as 'Numéro', nombre_en_stock as 'Quantité en stock', 
    libelle_outil as 'libellé de l\'outil', num_garantie as 'Numéro de la garantie', 
    date_expiration as 'Date d\'expiration' from Inventaire natural join Outil 
    natural join Garantie where num_syndic = ?");
$stmt->execute([$_SESSION["id"]]);
$outils = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<div class="espace">
    <?php if ($outils) { ?>

        <table class="fullWidth table_calendrier">
            <tr>
                <?php foreach ($outils[0] as $key => $_) { ?>
                    <th><?= $key ?></th>
                <?php } ?>
            </tr>
            <?php foreach ($outils as $row) { ?>
                <tr>
                    <?php foreach ($row as $value) { ?>
                        <td class="center"><?= $value ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <h2 class="center">Vous n'avez pas d'outils</h2>
    <?php } ?>
</div>

<?php
require_once("footer.php");
?>
