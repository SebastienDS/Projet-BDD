<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION["type"] !== "Administrateur") {
    header("location: accueil.php");
}
require_once("header.php");
?>

<h1 class="center espace">
    En cours de développement
</h1>

<?php
require_once("footer.php");
?>
