<?php
require("verification.php");
require_once("fonction.php");

$lien_profil = "profil";
if ($_SESSION["type"] === "Administrateur") {
	$lien_profil .= "_admin";
}

$onglets = get_onglets($_SESSION["type"]);
$links = get_links($_SESSION["type"]);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>PROJET BDD DU TURFU</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="BarreDuHaut">
			<table class="button">	
				<tr>
					<?php foreach ($onglets as $key => $onglet ) { ?>
						<td>
							<a href="<?= isset($links[$key]) ? $links[$key] : '#' ?>"><?= $onglet ?></a>
						</td>
					<?php } ?>
				</tr>
			</table>
			<div>
				<ul id="menu-deroulant">
					<li><a href="#"><img class="profile" src="img/le_sedum_reportage.jpg" width="125px" height="125px"></a>
						<ul>
							<li><a href="<?= $lien_profil ?>.php">Mon Profil</a></li>
							<li><a href="#">Mes Paramètres</a></li>
							<li><a href="deconnexion.php">Se déconnecter</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	