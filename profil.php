<?php
require_once("header.php");
require_once("connexion.php");

list($query, $var) = get_profil_query($_SESSION["type"], $_SESSION["id"]);
$stmt = $dbh->prepare($query);
$stmt->execute($var);
$profil = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="profil">
    <div class="espace">
        <img src="img/logo.png">
    </div>
    <div class="contenu_profil espace">
        <?php foreach ($profil[0] ?? [] as $key => $value) { ?>
            <p class="itemDescription"><?= $key ?> : <?= $value ?></p>
        <?php } ?>
    </div>
</div>

<table class="tableau_profile fullWidth">
    <tr>
        <td>Paramètres</td>
    </tr>
</table>

<div class="blanc">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat alias, excepturi distinctio rem, corrupti possimus at repellendus cumque autem quas sunt ipsum ut harum, iusto recusandae impedit aspernatur aliquam tenetur?
    Unde perspiciatis consectetur voluptatibus at harum! Corporis aliquam in totam, numquam repudiandae officiis porro facilis eaque saepe harum blanditiis at hic delectus rerum recusandae similique quam nesciunt quaerat soluta iste?
    Id a tempore corrupti similique quas ut beatae enim fugiat, ratione architecto consectetur numquam corporis maxime reiciendis et harum vero. Veniam, nisi tenetur? Fuga sit sunt sint similique praesentium voluptate.
    Consequatur molestias, veritatis, harum perferendis laudantium laboriosam illum voluptatum eum vitae rerum provident ab unde delectus quidem vel incidunt aliquam maxime iure debitis quos assumenda! Quaerat quas impedit eum delectus!
    Voluptate, obcaecati. Laudantium voluptatibus illum fugit facilis voluptatum, cupiditate aperiam voluptate dolores? Sed saepe consequuntur non! Ullam debitis nihil rerum, corporis placeat laborum possimus accusantium numquam. Natus, pariatur iure. Amet!
    Cum voluptate officia, aliquid ipsum sunt magnam numquam quibusdam, ipsam voluptas excepturi sint cupiditate quaerat, obcaecati nobis mollitia. Doloribus commodi sequi aliquid perferendis quae labore ratione minima nulla dolorem deserunt.
    Fuga, dolore. Numquam autem nesciunt inventore doloremque qui dignissimos harum illo, exercitationem culpa quam earum laboriosam sunt, quidem deserunt nostrum amet id esse, provident enim! Earum soluta provident ipsa. Nostrum!
    Ut, asperiores beatae, modi error maxime commodi voluptate iusto iste, iure ullam laborum aliquid distinctio laboriosam mollitia quis in! Architecto placeat ab labore in non asperiores nam officiis exercitationem laboriosam.
    Voluptas in iste dolor fuga omnis vitae voluptatum at? Architecto vel, hic rerum aspernatur itaque reprehenderit, quasi dolorum placeat quos doloribus ratione quo molestias quidem nisi eveniet consequuntur corporis facere?
    Nam dolorem ad obcaecati rerum tempore iusto harum dolor ipsam eveniet nesciunt, tempora itaque earum eos debitis quaerat quasi excepturi maiores optio vero id doloremque. Maxime pariatur animi fugiat dolor.
</div>

<?php
require_once("footer.php");
?>
