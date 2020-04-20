<?php
$not_set = true;
if (isset($_POST["password"]) && isset($_POST["username"])) {
	require_once("connexion.php");
	$username = $_POST["username"];
	$password = $_POST["password"];
	$valide = $dbh->query("SELECT type FROM authentification where login = '$username' and password = SHA1('$password')")->fetchAll();
	if ($valide) {
		session_start();
		$_SESSION["username"] = $username;
		$_SESSION["type"] = $valide[0]["type"];
		
		header("location: accueil.php");
	}
	$not_set = false;
}
?>



<!DOCTYPE html>
<html>
	<head>
		<title>Connectez-vous !</title>
		<link rel="stylesheet" type="text/css" href="accueil.css">
	</head>
	<body>
		<div class="enPleinMilieu">
			<?php if (!$not_set) { ?>
				<div class="centrer rouge">
					<h2>Identifiant ou Mot de passe incorrect</h1>
				</div>
			<?php } ?>

			<form method="POST">
				<div class="centrer">
					<div class="space">
						<label for="Username" >Identifiant:</label>
						<input type="text" name="username" id="Username" size="25" required>
					</div>
				</div>
				<div class="centrer">
					<div class="space">
						<label for="Password">Mot de passe:</label>
						<input type="password" name="password" id="Password" size="25" required>
					</div>
				</div>
				<button type="submit" class="buttonTaille">Se Connecter</button>
			</form>
		</div>
	</body>
</html>

