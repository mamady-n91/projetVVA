<?php
session_start();
include("fonctionVva.php");
include("menu.html");
if ($ctx=connectBdd())
	{
		echo "La connexion a réussi<br/>";
		$date=date("d-m-y");
		print("Date du jour: $date<br/>");
		echo "Bienvenu sur votre page";
		echo ' '.$_SESSION['idUtilisateur'];//affiche la variable de session qui correspond à l'identifiant de l'utilisateur

	}
else
		mysqli_error ($ctx);


?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="accueil.css">
	<meta charset="utf-8">
	<title>Page de session</title>
</head>
<div>
<body>
	<div>
	<header class="enTeteAccueil">
	<h1> Bienvenue sur le site de l'association VVA </h1>
	</header>
	</div>
	<table>
			<th>Numéro</th>
			<th>Nom</th>
	<?php  ;
	$req='SELECT * FROM hebergement';
	$res=mysqli_query($ctx,$req);
	
	while ($ligne=mysqli_fetch_array($res)) 
	{
		echo"<tr>";
		echo"<td>";
		echo utf8_encode($ligne['NOHEB']); echo"</td>";
		echo"<td>";
		echo utf8_encode($ligne['NOMHEB']);
		echo "</td>";
		echo "</tr>";
	}
	

	?>
</table>

</body>
</div>
</html>