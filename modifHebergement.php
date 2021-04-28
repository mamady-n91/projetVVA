<?php
session_start();
include("fonctionVva.php");
include("menu.php");

if(!$ctx=connectBdd())
{
	echo mysqli_error($ctx);
}	
?>
	<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<title>Modification des hébérgements</title>
		<link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">

		<link rel="stylesheet" type="text/css" href="style.css">
	</head>	


	<div class="listeHeberg">
		<table class="table table-striped table-default">
			<th scope="col">Nom de l'hébérgement</th>
			<th scope="col">Photo</th>
			<th scope="col">Description</th>
			<th scope="col">Nombre de places de l'hebergement</th>
			<th scope="col">Tarif pour une semaine d'hebergement
			<th scope="col">Localisation</th>
			<th scope="col">Etat de l'hébèrgement</th>
<?php
$req='SELECT NOHEB,NOMHEB,PHOTOHEB,DESCRIHEB,NBPLACEHEB,TARIFSEMHEB,SECTEURHEB,ETATHEB FROM hebergement';
$res=mysqli_query($ctx,$req);
while ($ligne=mysqli_fetch_array($res)) 
				{

					echo"<tr>";
						echo"<td>";
						echo utf8_encode($ligne['NOMHEB']);
						echo "</td>";
						echo"<td>";
						echo"<img src=".$ligne['PHOTOHEB']." width='150px'>"; 
						echo"</td>";
						echo"<td>";
						echo utf8_encode($ligne['DESCRIHEB']);
						echo "</td>";
						echo"<td>";
						echo ($ligne['NBPLACEHEB']);
						echo "</td>";
						echo "<td>";
						echo ($ligne['TARIFSEMHEB']);
						echo "</td>";
						echo"<td>";
						echo ($ligne['SECTEURHEB']);
						echo "</td>";
						echo "<td>";
						echo ($ligne['ETATHEB']);
						echo "</td>";
						echo "<td>";
						echo "<a href=formModifHeb.php?noheb=".$ligne['NOHEB']."><button class='btn btn-outline-success' >Modifier </button></a>";
						echo "</td>";

					echo "</tr>";			
				}
				?>