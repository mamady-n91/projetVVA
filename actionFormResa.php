<?php
session_start();
include('fonctionVva.php');
include('menu.php');
if(!$ctx=connectBdd())
		{
			echo mysqli_error();
			echo " La connexion n'a pas bien fonctionnée, réesayez.";
		}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta charset="utf-8">
		<title>Formulaire de réservation</title>
	</head>
	<body>
			<center><h1>Formulaire de reservation</h1></center>
			<table class="table table-striped table-default">
				<th scope="col">Utilisateur</th>
				<th scope="col">Nombre d'occupants</th>
				<th scope="col">Nombre de places de l'hebergement</th>
				<th scope="col">Tarif de la semaine de reservation</th>
				<th scope="col">Verser des arrhes ?</th>
				<th scope="col">Date de début de la reservation</th>

		<center><form action="" method="POST">

<?php
			
				$noHeb=$_GET['noHeb'];
				$dateSemResa=$_GET['dtDebutResa'];
				$reqInfoResa="SELECT NOHEB,NBPLACEHEB,TARIFSEMHEB FROM HEBERGEMENT WHERE NOHEB=$noHeb";
				$resInfoResa=mysqli_query($ctx,$reqInfoResa);
				while ($ligne=mysqli_fetch_array($resInfoResa)) 
				{
					echo "<tr>";

					echo "<td>";
					echo "<input type='text' name='user' readonly='readonly'  value=".$_SESSION['idUtilisateur']."><br/>";
					echo "</td>";

					echo "<td>";
					echo "<input type='number' name=nbOccupant min='1' max=".$ligne['NBPLACEHEB']." required='required' >";
					echo "</td>";


					echo "<td>";
					echo "<input type='number' name='nbPlaceHeb'  disabled='disabled' value=".$ligne['NBPLACEHEB']."> <br/>";
					echo"</td>";

					echo "<td>";
					echo "<input type='number' name='tarifSemResa' readonly='readonly' value=".$ligne['TARIFSEMHEB']."><br/>";
					echo "</td>";

					echo "<td>";
					echo "<input type='number' name='montantArrh' required='required' required title='Entrez 0 si vous ne voulez pas' min=0 max=".conversion($ligne['TARIFSEMHEB'])." ><br/>";
					echo"</td>";

					echo "<td>";
					echo "<input type='text' name='dtDebutResa' size='7' readonly='readonly'value=$dateSemResa><br/> ";
					echo"</td>";

					echo "</tr>";

					
				}
				$reqNouvNumResa= "SELECT NORESA FROM RESA WHERE NORESA IN(SELECT MAX(NORESA) FROM RESA)";
				$resNouvNumResa=mysqli_query($ctx,$reqNouvNumResa);
				while ($ligneResa=mysqli_fetch_array($resNouvNumResa)) 
				{
					echo "<tr>";
					echo "<td>";
					echo "<b><label for='noResa'>Nouveau numéro de la reservation</label></b>";
					echo "<input type='number' name='noResa' id ='noResa' readonly='readonly' value=".incrementer($ligneResa['NORESA']).">";
					echo "</td>";

					echo "<td>";
					echo "<input class='btn btn-primary btn-lg' type='submit' name='btnValiderResa'>";
					echo "</td>";

					echo "</tr>";
				}



//.conversion($ligne['TARIFSEMHEB']).





?>

</center>
</table>
</form>
<?php 
if (isset($_POST['btnValiderResa'])) 
{
	$nbOccupant = $_POST['nbOccupant'];
	$noResa = $_POST['noResa'];
	$tarifSemResa=$_POST['tarifSemResa'];
	$user=$_SESSION['idUtilisateur'];
	$montantArrh = $_POST['montantArrh'];
	$reqVerifDateDebSem="SELECT NOHEB FROM RESA WHERE DATEDEBSEM =$dateSemResa AND NOHEB =$noHeb";
	$resVerifDateDebSem=mysqli_query($ctx,$reqVerifDateDebSem);
	//echo $reqVerifDateDebSem;

	if (mysqli_num_rows($resVerifDateDebSem)==0 OR !empty($montantArrh) OR empty($montantArrh)) 
	{
			$reqInsertResa="INSERT INTO RESA (NORESA, USER, DATEDEBSEM, MONTANTARRHES,CODEETATRESA,NOHEB,NBOCCUPANT,TARIFSEMRESA) VALUES ($noResa,'$user',$dateSemResa,$montantArrh,'BQ',$noHeb,$nbOccupant,$tarifSemResa)";

		$resInsertResa=mysqli_query($ctx,$reqInsertResa);
	if(mysqli_affected_rows($ctx)==1)
	{
		?>
		<div class="alert alert-success" role="alert">
                               <h4 class="alert-heading">Très bien!</h4>
                               <hr>
                               <p>Votre réservation a bien été prise en compte. Le gestionnaire va vérifier des derniers détails.<br>Regardez régulièrement votre historique de réservation pour voir si elle a été prise en compte.
                               </p>
                               <a href="reservation.php" class="alert-link"><button class="btn btn-outline-success">Revenir à la page d'accueil</button></a>
                            </div>
                            <?php
	}

		elseif(mysqli_affected_rows($ctx)==0)
		{
			?>
				<div class="alert alert-warning" role="alert">
					<h4 class="alert-heading">Oups</h4>
	  				Une erreur est survenue, l'insertion n'a pas fonctionnée. Vérifiez que vous avez saisi(e) les bonnes informations. Sinon recommencez depuis le début. <br/>
	  				<a href="index.php" class="alert-link"><button class="btn btn-outline-danger">Revenir à l'accueil</button></a>
				</div>
				<?php
                               
		}

		



	}
	if (mysqli_num_rows($resVerifDateDebSem)==1) 
	{
			?>
				<div class="alert alert-warning" role="alert">
					<h4 class="alert-heading">Désolé</h4>
	  				Vous n'avez peut être pas quitté la page après votre demande. Cette date à déjà été reservée avec cette hébergement. <br/>
	  				<a href="index.php" class="alert-link"><button class="btn btn-outline-warning">Revenir à l'accueil</button></a>
				</div>
				<?php
	}

}
if (empty($_POST['montantArrh'])) 
{
	$_POST['montantArrh']=NULL;
	var_dump($_POST['montantArrh']);
}
?>		
</body>
</html>