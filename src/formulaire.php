<?php
if (isset($_POST["password"]) && isset($_POST["username"])) {
	
}
?>



<!DOCTYPE html>
<html>
	<head>
		<title>Connectez-vous !</title>
		<link rel="stylesheet" type="text/css" href="accueil.css">
	</head>
	<body>
		<form class="enPleinMilieu" method="POST">
			<div class="centrer">
				<div class="space">
					<label for="Username" >Username:</label>
					<input type="text" name="username" id="Username" size="25" required>
				</div>
			</div>
			<div class="centrer">
				<div class="space">
					<label for="Password">Password:</label>
					<input type="password" name="password" id="Password" size="25" required>
				</div>
			</div>
			<button type="submit" class="buttonTaille">Se Connecter</button>
		</form>
	</body>
</html>

