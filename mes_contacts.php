<?php
require_once("header.php");
require_once("connexion.php");  

$stmt = $dbh->prepare("SELECT num_individu as 'Numéro', libelle_fonction as 'Fonction', 
    concat(nom_individu, ' ', prenom_individu) as 'Contact', adresse_individu as 'Adresse',
    e_mail_contact as 'Adresse Email', telephone_individu as 'Numéro de téléphone' 
    from Contact natural join Individu natural join Fonction where num_syndic = ?");
$stmt->execute([$_SESSION["id"]]);
$contact = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="espace">
    <?php if ($contact) { ?>

        <table class="fullWidth table_calendrier">
            <tr>
                <?php foreach ($contact[0] as $key => $_) { ?>
                    <th><?= $key ?></th>
                <?php } ?>
            </tr>
            <?php foreach ($contact as $row) { ?>
                <tr>
                    <?php foreach ($row as $value) { ?>
                        <td class="center"><?= $value ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <h2 class="center">Vous n'avez pas de contacts</h2>
    <?php } ?>
</div>

<?php
require_once("footer.php");
?>
