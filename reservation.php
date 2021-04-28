<?php  
session_start();
include("fonctionVva.php");

if(!$ctx=connectBdd())
{
	echo mysqli_error($ctx);
}	

	if (isset($_SESSION['idUtilisateur']))
			{
				include("menu.php");
				echo'<p class= lead >Bienvenue sur votre session '.$_SESSION['idUtilisateur'].'</p>';

			}

	else 	{
				header("location:connexion.php?page=reservation");
			}		
?>

	<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<title>Reservation</title>
		<link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>	

	<center><h1> Liste des réservations</h1></center>
	<form class="form-group" method="POST" action="">
			<select class="" name="semaineResa">
				<option value="" disabled="disabled" selected="">Réservation pour une semaine donnée</option>
				<?php
				$reqSemaineResa= 'SELECT DATEDEBSEM FROM RESA';
				$resSemaineResa=mysqli_query($ctx,$reqSemaineResa);
				while ($ligne=mysqli_fetch_array($resSemaineResa)) 
				{
				
					echo  utf8_encode("<option value=".$ligne['DATEDEBSEM'].">".$ligne['DATEDEBSEM']."</option>");
				}

				?>



			</select>
		 	<input class="btn btn-secondary" type="submit" name="btnValiderSemResa"><br/>
		 </form>

		 	<form class="" method="POST" action="">
		 	<select name="noHeb">
				<option value="" disabled="disabled" selected="">Numéro d'hébérgement</option>
				<?php
				$reqNoHeb= 'SELECT NOHEB FROM RESA GROUP BY NOHEB';
				$resNoHeb=mysqli_query($ctx,$reqNoHeb);
				while ($ligne=mysqli_fetch_array($resNoHeb)) 
				{
				
					echo  utf8_encode("<option value=".$ligne['NOHEB'].">".$ligne['NOHEB']."</option>");
				}

				?>

				</select>
				<input class="btn btn-secondary" type="submit" name="btnValiderNoHeb">
			</form>

			 <form action="" method="POST"> <!-- Liste des reservations à l'aide des deux informations -->
				 <select class="" name="semaineResa2">
					<option value="" disabled="disabled" selected="">Réservation pour une semaine donnée</option>
					<?php
					$reqSemaineResa= 'SELECT DATEDEBSEM FROM RESA';
					$reSemaineResa=mysqli_query($ctx,$reqSemaineResa);
					while ($ligne=mysqli_fetch_array($reSemaineResa)) 
					{
					
						echo  utf8_encode("<option value=".$ligne['DATEDEBSEM'].">".$ligne['DATEDEBSEM']."</option>");
					}

					?>
				</select>

				<select name="noHeb2">
				<option value="" disabled="disabled" selected="">Numéro d'hébérgement</option>
				<?php
				$reqNoHeb= 'SELECT NOHEB FROM RESA GROUP BY NOHEB';
				$resNoHeb=mysqli_query($ctx,$reqNoHeb);
				while ($ligne=mysqli_fetch_array($resNoHeb)) 
				{
				
					echo  utf8_encode("<option value=".$ligne['NOHEB'].">".$ligne['NOHEB']."</option>");
				}

				?>

				</select>
				<input class="btn btn-secondary" type="submit" name="btnValiderDoubleInfo">

			</form>

			<form action="" method="POST" class="">
				<input class="btn btn-secondary" type="submit" name="btnValiderResaFini" value="Réservations terminées">
			</form>

			<a class href="reservation.php"><button class="btn btn-secondary">Tout afficher</button></a>


		 	<table class="table table-striped table-default">
		 		<th scope="col">Numéro de réservation</th>
		 		<th scope="col">Compte de reservation</th>
				<th scope="col">Date de la reservation</th>
				<th scope="col">Numéro de l'hébergement reservé</th>
				<th scope="col">Date arrhes (?)</th>
				<th scope="col">Montant arrhes(?)</th>
				<th scope="col">Etat de la reservation</th>
				<th scope="col">Nombre d'occupants</th>
				<th scope="col">Tarif pour la semaine de reservation</th>
		 		<th scope="col">Date de début de la semaine</th>
		 		<th scope="col">Date de fin de la semaine</th>
 <?php
 
 if (isset($_POST['btnValiderSemResa']))

 {

  	if (!empty($_POST['semaineResa'])) 
 	{
 		
		$semaineResa=$_POST['semaineResa'];
 		$reqListe= "SELECT NORESA,USER, DATERESA,NOHEB,DATEARRHES,MONTANTARRHES,CODEETATRESA,NBOCCUPANT,TARIFSEMRESA,RESA.DATEDEBSEM, semaine.DATEFINSEM FROM RESA, semaine WHERE semaine.DATEDEBSEM = resa.DATEDEBSEM AND RESA.DATEDEBSEM='$semaineResa' AND CODEETATRESA NOT IN(SELECT CODEETATRESA FROM RESA WHERE CODEETATRESA='TR') ";
	 	//Cette requête permet de voir les reservations entrée pour la semaine renseignée.
	 	$resListe= mysqli_query($ctx,$reqListe);
	 	while ($ligne=mysqli_fetch_array($resListe))
 		{
 		
					
 		//while ($ligne=mysqli_fetch_array($resListe))
 		//{
 		
 		echo"<tr>";
						echo"<td>";
						echo utf8_encode($ligne['NORESA']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['USER']); 
						echo"</td>";
						echo"<td>";
						echo utf8_encode($ligne['DATERESA']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['NOHEB']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['DATEARRHES']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['MONTANTARRHES']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['CODEETATRESA']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['NBOCCUPANT']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['TARIFSEMRESA']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['DATEDEBSEM']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['DATEFINSEM']);
						echo "</td>";
						echo"<td>";
						echo "<a href=modifResa.php?noResa=".$ligne['NORESA']."&noHeb=".$ligne['NOHEB']."><button class='btn btn-outline-success' >Modifier</button></a>";
						echo"</td>";


			echo "</tr>";
 	
 		}	

	}
	 elseif (empty($_POST['semaineResa'])) 
		 {
		 	?>
					<div class="alert alert-secondary" role="alert">
						<h4 class="alert-heading">Oups</h4>
						<hr/>
		  				Vous n'avez saisi <b>aucune semaine.</b> Veuillez en saisir une pour afficher la ou les réservations. <br/>
					</div>
					<?php
		 }
	


}

 	 
 elseif(isset($_POST['btnValiderNoHeb']))

{
 	 	
 	 	if (!empty($_POST['noHeb'])) 
 	 	{

 	  	$noHeb=$_POST['noHeb'];
	 	$req= "SELECT NORESA,USER, DATERESA,NOHEB,DATEARRHES,MONTANTARRHES,CODEETATRESA,NBOCCUPANT,TARIFSEMRESA,semaine.DATEDEBSEM, semaine.DATEFINSEM FROM RESA, semaine WHERE semaine.DATEDEBSEM = resa.DATEDEBSEM AND NOHEB=$noHeb AND CODEETATRESA NOT IN(SELECT CODEETATRESA FROM RESA WHERE CODEETATRESA='TR')";
	 	//Récupère les réservations pour le numéro d'hébérgement selectionné


	 	$res= mysqli_query($ctx,$req);
 		while ($ligne=mysqli_fetch_array($res))
 		{
 		
 		echo"<tr>";
						echo"<td>";
						echo utf8_encode($ligne['NORESA']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['USER']); 
						echo"</td>";
						echo"<td>";
						echo utf8_encode($ligne['DATERESA']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['NOHEB']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['DATEARRHES']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['MONTANTARRHES']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['CODEETATRESA']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['NBOCCUPANT']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['TARIFSEMRESA']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['DATEDEBSEM']);
						
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['DATEFINSEM']);
						echo "</td>";
						echo"<td>";
						echo "<a href=modifResa.php?noResa=".$ligne['NORESA']."&noHeb=".$ligne['NOHEB']."><button class='btn btn-outline-success' >Modifier</button></a>";
						echo"</td>";


			echo "</tr>";

 		 }
 		}
	 	elseif (empty($_POST['noHeb'])) 
		 {
		 	?>
					<div class="alert alert-secondary" role="alert">
						<h4 class="alert-heading">Oups</h4>
						<hr/>
		  				Vous n'avez saisi aucun <b>numéro d'hébergement.</b> Veuillez en saisir une pour afficher la ou les réservations. <br/>
					</div>
					<?php
		 }
 	}

 elseif(isset($_POST['btnValiderDoubleInfo'])) 
 {
 		if (!empty($_POST['semaineResa2']) AND !empty($_POST['noHeb2'])) 
 		{
			$semaineResa2=$_POST['semaineResa2'];
			$noHeb2=$_POST['noHeb2'];
			$reqDoubleInfo="SELECT NORESA,USER, DATERESA,NOHEB,DATEARRHES,MONTANTARRHES,CODEETATRESA,NBOCCUPANT,TARIFSEMRESA,semaine.DATEDEBSEM, semaine.DATEFINSEM FROM RESA, semaine WHERE semaine.DATEDEBSEM = resa.DATEDEBSEM AND RESA.DATEDEBSEM='$semaineResa2' AND NOHEB=$noHeb2 AND CODEETATRESA NOT IN(SELECT CODEETATRESA FROM RESA WHERE CODEETATRESA='TR') ";

			$resDoubleInfo=mysqli_query($ctx,$reqDoubleInfo);
			echo $reqDoubleInfo;
				while ($ligne=mysqli_fetch_array($resDoubleInfo))
 				{
 		
 					echo"<tr>";

							echo"<td>";
							echo utf8_encode($ligne['NORESA']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['USER']); 
							echo"</td>";
							echo"<td>";
							echo utf8_encode($ligne['DATERESA']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['NOHEB']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['DATEARRHES']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['MONTANTARRHES']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['CODEETATRESA']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['NBOCCUPANT']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['TARIFSEMRESA']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['DATEDEBSEM']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['DATEFINSEM']);
							echo "</td>";
							echo"<td>";
							echo "<a href=modifResa.php?noResa=".$ligne['NORESA']."&noHeb=".$ligne['NOHEB']."><button class='btn btn-outline-success' >Modifier</button></a>";
							echo"<td>";


				echo "</tr>";

 			 }


 		}

 		elseif (empty($_POST['semaineResa2']) || empty($_POST['noHeb2'])) 
	 	{
		 	?>
					<div class="alert alert-secondary" role="alert">
						<h4 class="alert-heading">Oups</h4>
						<hr/>
		  				Une ou les deux informations n'ont pas été saisies. Veuillez saisir toutes les infos pour afficher la ou les réservations. <br/>
					</div>
					<?php
		}	

 	}

 	elseif(isset($_POST['btnValiderResaFini']))

	{
 	 	

		 	$reqResaFini= "SELECT NORESA,USER, DATERESA,NOHEB,DATEARRHES,MONTANTARRHES,CODEETATRESA,NBOCCUPANT,TARIFSEMRESA,semaine.DATEDEBSEM, semaine.DATEFINSEM FROM RESA, semaine WHERE semaine.DATEDEBSEM = resa.DATEDEBSEM AND CODEETATRESA ='TR'";
		 	//Récupère les réservations pour le numéro d'hébérgement selectionné

		 	$resResaFini= mysqli_query($ctx,$reqResaFini);
	 		while ($ligne=mysqli_fetch_array($resResaFini))
	 		{
	 		
	 		echo"<tr>";
							echo"<td>";
							echo utf8_encode($ligne['NORESA']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['USER']); 
							echo"</td>";
							echo"<td>";
							echo utf8_encode($ligne['DATERESA']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['NOHEB']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['DATEARRHES']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['MONTANTARRHES']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['CODEETATRESA']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['NBOCCUPANT']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['TARIFSEMRESA']);
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['DATEDEBSEM']);
							
							echo "</td>";
							echo"<td>";
							echo utf8_encode($ligne['DATEFINSEM']);
							echo "</td>";


				echo "</tr>";

 		 }
 		}  

	else
	{
		$reqDefaut="SELECT NORESA,USER, DATERESA,NOHEB,DATEARRHES,MONTANTARRHES,CODEETATRESA,NBOCCUPANT,TARIFSEMRESA,semaine.DATEDEBSEM, semaine.DATEFINSEM FROM RESA, semaine WHERE semaine.DATEDEBSEM = resa.DATEDEBSEM AND CODEETATRESA NOT IN(SELECT CODEETATRESA FROM RESA WHERE CODEETATRESA='TR') ";
		$resDefaut=mysqli_query($ctx,$reqDefaut);
		while ($ligne=mysqli_fetch_array($resDefaut))
 		{
 		
 		
 		echo"<tr>";
						echo"<td>";
						echo utf8_encode($ligne['NORESA']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['USER']); 
						echo"</td>";
						echo"<td>";
						echo utf8_encode($ligne['DATERESA']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['NOHEB']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['DATEARRHES']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['MONTANTARRHES']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['CODEETATRESA']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['NBOCCUPANT']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['TARIFSEMRESA']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['DATEDEBSEM']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['DATEFINSEM']);
						echo "</td>";
						echo"<td>";
						echo "<a href=modifResa.php?noResa=".$ligne['NORESA']."&noHeb=".$ligne['NOHEB']."><button class='btn btn-outline-success' >Modifier</button></a>";
						echo"<td>";


			echo "</tr>";

 		 }
 		}
 		 ?>
 </table>
</body>
</html>
 