<?php  
session_start();
include("fonctionVva.php");
include("menu.php");

if(!$ctx=connectBdd())
{
	echo mysqli_error($ctx);
}

$idUtilisateur= $_SESSION['idUtilisateur'];//Je stocke la variabe de session dans une variable locale pour éviter les problème de concatenation

?>
<!DOCTYPE html>
<html>
<head>
	<title>Historique de réservation</title>
	<link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">

</head>

<center><h1 class="">Mon historique de réservations</h1></center>
<table class="table table-striped table-default">
	<th scope="col">Numéro de reservation</th>
	<th scope="col">Date de début de la semaine de reservation</th>
	<th scope="col">Etat de la reservation</th>
	<th scope="col">Date de la reservation</th>
	<th scope="col">Montant des arrhes</th>
	<th scope="col">Nombre d'occupants</th>
	<th scope="col">Tarif de la semaine de reservation</th>
<?php
	$req="SELECT NORESA,DATEDEBSEM,NOMETATRESA,DATERESA, MONTANTARRHES,NBOCCUPANT,TARIFSEMRESA FROM RESA,HEBERGEMENT,etat_resa WHERE RESA.NOHEB=HEBERGEMENT.NOHEB AND ETAT_RESA.CODEETATRESA=RESA.CODEETATRESA AND USER='$idUtilisateur'";
	$res=mysqli_query($ctx,$req);
	while ($ligne=mysqli_fetch_array($res))
	{
		echo"<tr>";
						echo"<td>";
						echo utf8_encode($ligne['NORESA']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['DATEDEBSEM']);
						echo"</td>";
						echo"<td>";
						echo utf8_encode($ligne['NOMETATRESA']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['DATERESA']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['MONTANTARRHES']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['NBOCCUPANT']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['TARIFSEMRESA']);
						echo "</td>";

					echo "</tr>";			

	}

?>
</table>
