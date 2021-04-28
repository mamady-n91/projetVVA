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
		
			

			}

	else 	{
				header("location:connexion.php?page=reservation.php");
			}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mise à jour de la reservation</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Mise à jour de la reservation</h1>
	<table class="table-sm" >
		<th scope="col">Liste des semaines non-réservées pour l'hébergement</th>
		<?php
		$noHeb=$_GET['noHeb'];
		$reqListeSemaineDispo= "SELECT DATEDEBSEM FROM SEMAINE WHERE DATEDEBSEM NOT IN(SELECT DATEDEBSEM FROM hebergement,resa WHERE hebergement.NOHEB = resa.NOHEB AND hebergement.NOHEB=$noHeb)";
		$resListeSemaineDispo=mysqli_query($ctx,$reqListeSemaineDispo);
		while ($ligne=mysqli_fetch_array($resListeSemaineDispo)) 
		{
			echo "<tr class='table-active'>";
			echo "<td>";
			echo $ligne['DATEDEBSEM'];
			echo"</td>";
			echo "</tr>";	
		}
		?>



	</table><br/>

	<table class="table table-striped table-default">
		<th scope="col">Numéro de réservation</th>
		<th scope="col">Compte de reservation</th>
		<th scope="col">Date de la reservation</th>
		<th scope="col">Numéro de l'hébergement reservé</th>
		<th scope="col">Date arrhes (?)</th>
		<th scope="col">Montant arrhes(? 20%)</th>
		<th scope="col">Nombre d'occupants</th>
		<th scope="col">Tarif pour la semaine de reservation</th>
	 	<th scope="col">Date de début de la semaine</th>
	 	
	 	<form class="form-group" action="" method="POST">

	<?php
	$noResa=$_GET['noResa'];
	$reqInfosResa="SELECT NORESA,USER,DATEDEBSEM,resa.NOHEB,CODEETATRESA,DATERESA,DATEARRHES,MONTANTARRHES,NBOCCUPANT,HEBERGEMENT.TARIFSEMHEB,NBPLACEHEB FROM RESA,hebergement WHERE HEBERGEMENT.NOHEB = RESA.NOHEB AND NORESA =$noResa";

	$resInfosResa=mysqli_query($ctx,$reqInfosResa);
	while ($ligne=mysqli_fetch_array($resInfosResa)) 
	{
		
		echo"<tr>";
						echo"<td>";
						echo "<input class='form-control' type='number' readonly='readonly' name='nouvNoResa' value=".$ligne['NORESA']."></br>";
						echo "</td>";

						echo"<td>";
						echo "<input class='form-control' type='text' readonly='readonly' name='nouvUser' value=".$ligne['USER']."></br> "; 
						echo"</td>";

						echo"<td>";
						echo "<input class='form-control' type='date' readonly='readonly' name='nouvDateResa' value=".$ligne['DATERESA']. "></br>";
						echo "</td>";

						echo"<td>";
						echo "<input class='form-control' type ='number' readonly='readonly' name='nouvNoHeb' min='1' value=".$ligne['NOHEB']."></br>";
						echo "</td>";

						echo"<td>";
						echo "<input class='form-control' readonly='readonly' type='date' name='nouvDateArrhes' value=".$ligne['DATEARRHES']."></br> ";
						echo "</td>";

						echo"<td>";
						echo "<input class='form-control' type='number'  name='nouvMtntArrhes' min='0' max=".conversion($ligne['TARIFSEMHEB'])." 
						value=".$ligne['MONTANTARRHES']."></br> ";
						echo "<input class ='btn btn-secondary' type='submit' name='btnValiderMntnArrhes'>";
						echo "</td>";


						echo"<td>";
						echo "<input class='form-control' type ='number' name='nouvNbreOccup' value=".$ligne['NBOCCUPANT']." min='1' 
						max=".$ligne['NBPLACEHEB']."></br> ";
						echo "<input class ='btn btn-secondary' type='submit' name='btnValidNbOccupant' ";
						echo "</td>";

						echo"<td>";
						echo "<input class='form-control' name='nouvTarifSemResa' readonly='readonly' type='number' 
						value=".$ligne['TARIFSEMHEB']."><br>";
						echo "</td>";

						echo"<td>";
						echo "<input class='form-control' type='date' readonly='readonly' name='nouvDateDebSem' readonly='readonly' value=".$ligne['DATEDEBSEM'].">";
						echo "</td>";



				echo "</tr>";

						

		
	}

	?>
</table>

	<table class="table table-striped table-default">
		<th scope="col">Etat de la reservation</th>

	<?php	
	$reqCodeEtatResa="SELECT ETAT_RESA.CODEETATRESA, ETAT_resa.NOMETATRESA, resa.NORESA from ETAT_RESA,RESA where ETAT_RESA.CODEETATRESA = RESA.CODEETATRESA and NORESA=$noResa";
	$resCodeEtatResa=mysqli_query($ctx,$reqCodeEtatResa);
	//echo $reqCodeEtatResa;
	while ($ligne=mysqli_fetch_array($resCodeEtatResa)) 
	{
		echo "<tr>";

		echo "<td>";
		echo "<select disabled ='disabled'name='codeEtatResaActuel' id='codeEtatResaActuel' > ";
		echo "<option value=".$ligne['NOMETATRESA'].">".$ligne['NOMETATRESA']."</option>";

		echo "</select></br>";
		echo "</td>";
	}
	?>
</table>
	<?php
	$reqNouvCodeEtatResa="SELECT CODEETATRESA,NOMETATRESA FROM ETAT_RESA";	
	$resNouvCodeEtatResa=mysqli_query($ctx,$reqNouvCodeEtatResa);
	?>
	<center><b><label for='nouvCodeEtatResa'>Nouvel état de la reservation</label></b>
		<br/>

	<select class="" name='nouvCodeEtatResa' id='nouvCodeEtatResa'>
		<?php
	while($ligne=mysqli_fetch_array($resNouvCodeEtatResa))
	{		
			echo "<option value=".$ligne['CODEETATRESA'].">".$ligne['NOMETATRESA']."</option>";
		}	
	?>	
</select><br/>
<input class="btn btn-secondary" type="submit" name="btnValidEtatResa">	
</center>




<?php
//Partie mise à jour de la resa dans la BDD
if (isset($_POST['btnValiderMntnArrhes'])) 
{
	$montantArrhes=$_POST['nouvMtntArrhes'];
	$reqMontantArrhes="UPDATE RESA SET MONTANTARRHES=$montantArrhes WHERE NORESA=$noResa";
	$resMontantArrhes=mysqli_query($ctx,$reqMontantArrhes);
	if (mysqli_affected_rows($ctx)==1) 
	{
		?>
				
				div class="alert alert-success" role="alert">
		 		<h4 class="alert-heading">Très bien!</h4>
				<hr>
				 <p>La modification a été effectuée avec succés.</p>
				</div>
			<?php
	}
	elseif (mysqli_affected_rows($ctx)==1) 
	{
		?>
		<div class="alert alert-secondary" role="alert">
					<h4 class="alert-heading">Oups</h4>
	  				Une erreur est survenue, la mise à jour n'a pas fonctionnée. Vérifiez que vous avez saisi(e) les bonnes informations. Sinon recommencez depuis le début. <br/>
	  				<a href="reservation.php" class="alert-link"><button class="btn btn-outline-secondary">Revenir à la page réservation</button></a>
				</div>
				<?php
		
	}
	
}

if (isset($_POST['btnValidNbOccupant'])) 
{
$nbOccupant=$_POST['nouvNbreOccup'];
$reqNbOccupant="UPDATE RESA SET NBOCCUPANT =$nbOccupant WHERE NORESA=$noResa";
$resNbOccupant=mysqli_query($ctx,$reqNbOccupant);
	if (mysqli_affected_rows($ctx)==1) 
	{
		?>
		<div class="alert alert-success" role="alert">
		 		<h4 class="alert-heading">Très bien!</h4>
				<hr>
				 <p>La modification a été effectuée avec succés.</p>
				</div>
			<?php

	}
	elseif (mysqli_affected_rows($ctx)==0) 
	{
		?>
		<div class="alert alert-secondary" role="alert">
					<h4 class="alert-heading">Oups</h4>
	  				Une erreur est survenue, la mise à jour n'a pas fonctionnée. Vérifiez que vous avez saisi(e) les bonnes informations. Sinon recommencez depuis le début. <br/>
	  				<a href="reservation.php" class="alert-link"><button class="btn btn-outline-secondary">Revenir à la page réservation</button></a>
				</div>
				<?php
			
	}
}

if(isset($_POST['nouvCodeEtatResa']))
{
	$codeEtatResa=$_POST['nouvCodeEtatResa'];
	$reqEtatResa="UPDATE RESA SET CODEETATRESA='$codeEtatResa' WHERE NORESA =$noResa";
	$resEtatResa=mysqli_query($ctx,$reqEtatResa);
	 if (mysqli_affected_rows($ctx)==1) 
	{
		?>
		<div class="alert alert-success" role="alert">
		 		<h4 class="alert-heading">Très bien!</h4>
				<hr>
				 <p>La modification a été effectuée avec succés.</p>
				</div>
				<script type="text/javascript"> setTimeout(function () 
				{				 // wait 3 seconds and reload
    window.location.reload(true);
  }, 9500);
				</script>
			<?php	
		}

}
?>



</form>
</body>
</html>
