<?php
session_start();
include("fonctionVva.php");
include("menu.php");
$ctx=connectBdd();
?>
<!DOCTYPE html>
<html>
<head>
		<link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title></title>
</head>
<body>
	<div class="bodyCon">
	<div class="col col-lg-4" style="text-align: center;">
		<form action="" method="POST" class="formIdentification">
			<p class="imageAccueil">
			</p>
			<h4>Veuillez vous connecter</h4>
			<label for ="idUtilisateur"> Identifiant</label>
				<input type="text" class="form-control form-control-sm" name="idUtilisateur" id="idUtilisateur" required=""><br/>

			<label for="mdpUtilisateur" > Mot de passe</label>
				<input type="password" class="form-control form-control-sm" name="mdpUtilisateur" id="mdpUtilisateur" required=""><br/>
				<input type="submit" class="form-control form-control-sm" name="validerIdentification" value="Valider"/>
		</form>
	</div>
	<?php
		if (isset($_POST['idUtilisateur'])&& isset($_POST['mdpUtilisateur'])) 
		{
			$req="SELECT USER,MDP,TYPECOMPTE FROM COMPTE WHERE USER='".$_POST['idUtilisateur']."' AND MDP='".$_POST['mdpUtilisateur']."'";
			$res=mysqli_query($ctx,$req);
		
			if ($ligne=mysqli_fetch_array($res)) 
			{
				$_SESSION['idUtilisateur'] = $ligne['USER']; //variable superglobale qui récupère la variable $utilisateur(id de l'utilisateur)
				$_SESSION['typeCompte'] = $ligne['TYPECOMPTE']; 
				header('Location:index.php');

				if (isset ($_GET['page'])) {

					switch($_GET['page']){
					case 'reservation':
						header('Location:reservation.php');
						break;

					case '':
							
					header('Location:reservation.php');
										 }
						

										 }
			}
			else
			{
				echo "Pseudo ou mot de passe incorrect";
			}
		}

		?>
	</div
>	</body>
</html>