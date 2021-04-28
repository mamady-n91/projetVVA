<?php  
include("fonctionVva.php");
include("menu.php");
session_start();
$ctx=connectBdd();
?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<title> Accueil Village Vacances</title>
</head>
<body>
	<?php

	?>
	<center>
	<h1>Bienvenue sur le site de l'association VVA</h1>
	</center>
	<!--</header>-->
	<!-- <form action="accueil.php" method="POST" class="formIdentification">
		<p class="imageAccueil">
		</p>
		<label for ="idUtilisateur"> Identifiant</label>
			<input type="text" name="idUtilisateur" id="idUtilisateur" required=""><br/>

		<label for="mdpUtilisateur"> Mot de passe</label>
			<input type="password" name="mdpUtilisateur" id="mdpUtilisateur" required=""><br/>
			<input type="submit" name="validerIdentification" value="Valider"/>
	</form>-->
	<?php
	//var_dump($_POST); //var_dump permet d'afficher une variable,sa valeur peut importe son type
	/*if (isset($_POST['validerIdentification'])) 
		{
			$utilisateur=$_POST['idUtilisateur'];
			$motDePasse=$_POST['mdpUtilisateur'];
			$req="SELECT USER,MDP FROM COMPTE WHERE USER='$utilisateur' AND MDP='$motDePasse'";
			$res=mysqli_query($ctx,$req);
		}
		if ($ligne=mysqli_num_rows($res)==1) 
		{
			$_SESSION['idUtilisateur'] = $utilisateur; //variable superglobale qui récupère la variable $utilisateur(id de l'utilisateur)
			header('Location:compte.php');
		}
		else
		 {
			echo "Pseudo ou mot de passe incorrect";
		 }*/

	?>
</body>
</html>
