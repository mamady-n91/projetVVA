<?php
include("fonctionVva.php");
session_start();
if(!$ctx=connectBdd())
		{
			echo mysqli_error();
			echo " La connexion n'a pas bien fonctionnée, réesayez.";
		}

	if (isset($_SESSION['idUtilisateur']))
			{
				include("menu.php");
				echo'<p class= lead >Bienvenue sur votre session '.$_SESSION['idUtilisateur'].'</p>';
				$noHeb=$_GET['noHeb'];

			}

	else 	{
				header("location:connexion.php?page=reserver");
			}

	
	
	//if(isset($_GET['page']))
	//{
	//	header('location;reservation.php');
	//}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<table align="right">
		<th scope="col">Liste des semaines non-réservées pour l'hébergement</th>
		<?php
		$reqListeSemaineDispo= "SELECT DATEDEBSEM FROM SEMAINE WHERE DATEDEBSEM NOT IN(SELECT DATEDEBSEM FROM hebergement,resa WHERE hebergement.NOHEB = resa.NOHEB AND hebergement.NOHEB=$noHeb) AND DATEDEBSEM >=CURDATE()";
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



	</table>

	<center><h1 class="display1"> Choisissez la date de votre réservation</h1></center>
	<?php 

	$reqImageHeb="SELECT PHOTOHEB,DESCRIHEB,NOMHEB FROM HEBERGEMENT WHERE NOHEB=".$_GET['noHeb'];
	$resImageHeb=mysqli_query($ctx,$reqImageHeb);
	while ($ligne=mysqli_fetch_array($resImageHeb) )
	{
			//echo"<center><img class 'card-img-top' src=".$ligne['PHOTOHEB']." width='30%'></center><br/>";
			//echo"<p class='card-text'>fdddfdffddfdf</p>";
		echo "<center><div class='card' style='width: 20rem;'>";
		  		echo "<img class='card-img-top' src=".$ligne['PHOTOHEB']." alt='Card image cap'>";

		  	echo"<div class='card-body'>";
		    echo "<h5 class='card-title'>".$ligne['NOMHEB']."</h5>";
		    echo utf8_encode( "<p class='card-text'>".$ligne['DESCRIHEB']."</p>");
		    echo "<a href='index.php' class='btn btn-primary'>Voir d'autres hébérgements</a>";
		 echo " </div>";
		echo "</div>";
		echo "</center>";

	}

	?>
	
	<form class="form-group" action="" method="POST">


		<center>
			<label for="noHeb">Numéro de l'hébérgement séléctioné</label>
			<input  class="form-control-sm" type="text" name="noHeb" id="noHeb" readonly="readonly"  value= <?php echo $_GET['noHeb'];?> >
			<br/>

			<label class="label label-info" for="dtDebutResa">Début de la réservation</label>
			<?php
				echo "<input class='form-control-sm'   type='date' min=".date('Y-m-d')." name='dtDebutResa' id='dtDebutResa' required='required'><br>";
			?>	
			<input class="btn btn-primary" type="submit" name="btnValiderResa">

		</center>

	</form>

	<?php
		if (isset($_POST['btnValiderResa'])) 
		{
				$dateSemResa= $_POST['dtDebutResa'];/*
			$reqVerif = "SELECT NORESA, NOHEB,RESA.DATEDEBSEM,DATERESA, semaine.DATEFINSEM FROM RESA, semaine WHERE RESA.DATEDEBSEM = semaine.DATEDEBSEM AND  DATEDIFF('$dateSemResa',RESA.DATEDEBSEM) >=0 AND DATEDIFF ('$dateSemResa',RESA.DATEDEBSEM)<=7 AND NOHEB =$noHeb";

			//Cette requête Vérifie si l'hébérgement est déjà reservée pour cette la date saisie par l'utilisateur
			$resVerif= mysqli_query($ctx, $reqVerif);

			if($ligne=mysqli_num_rows($resVerif)==1) //Si oui... 
			{
				$reqVerifSamedi="SELECT NORESA, NOHEB,RESA.DATEDEBSEM,DATERESA, semaine.DATEFINSEM FROM RESA, semaine WHERE RESA.DATEDEBSEM = semaine.DATEDEBSEM AND  DATEDIFF('$dateSemResa',RESA.DATEDEBSEM)>=1 AND DATEDIFF ('$dateSemResa',RESA.DATEDEBSEM)<=7  AND NOHEB =$noHeb";
				$resVerifSamedi=mysqli_query($ctx,$reqVerifSamedi);
				//On vérifie que l'utilisateur n'a pas choisi une date dans la semaine au lieu d'un samedi


				if ($ligne=mysqli_num_rows($resVerifSamedi)==1) //Si oui...
				{
					?>
					<script type="text/javascript">
						alert('L\'hébérgement est déjà réservé pour cette semaine, N\'oubliez pas les réservations se font du samedi au samedi !');
						//Avertissement
					</script>	
					<?php				
				}

				elseif($ligne=mysqli_num_rows($resVerifSamedi)==0) //Sinon si c'est le samedi
				{
				?>
				<script type="text/javascript">
					alert('L\'hébérgement est déjà réservé pour cette date, choisissez une autre semaine');
				</script>	
				<?php
				}
			}	

			if ($ligne=mysqli_num_rows($resVerif)==0) 
			{
				*/$reqIfSemaineDispo="SELECT DATEDEBSEM FROM SEMAINE WHERE DATEDEBSEM='$dateSemResa'";
				$resIfSemaineDispo=mysqli_query($ctx,$reqIfSemaineDispo);
				if($ligne=mysqli_num_rows($resIfSemaineDispo)==0)
				{
					?>
					<script type="text/javascript">
						alert('Aucune reservation n\'est disponible en séléctionnant cette date. N\'oubliez pas les réservations se font du samedi au samedi !');
					</script>	
					<?php			
				}

				elseif ($ligne=mysqli_num_rows($resIfSemaineDispo)==1) //Si la semaine est disponible
				{
					$reqVerifIfResa="SELECT DATEDEBSEM FROM RESA WHERE DATEDEBSEM='$dateSemResa' AND NOHEB=$noHeb ";
					$resVerifResa=mysqli_query($ctx,$reqVerifIfResa);
					if (mysqli_num_rows($resVerifResa)==1)
					{
						?>
					<script type="text/javascript">
						alert('L\'hébergement est dejà reservé pour cette semaine');
					</script>	
					<?php	
					
					}
					
				
				elseif (mysqli_num_rows($resVerifResa)==0) 
				{
					$user=$_SESSION['idUtilisateur'];
					//La variable de session est stocké dans une variable locale pour éviter les problèmes de concaténation,guillemets et espacements.

					$reqVerifNbResa="SELECT COUNT(NORESA) AS NBRESA FROM RESA WHERE USER='$user' AND DATEDEBSEM='$dateSemResa' HAVING(NBRESA)>=1";
					//On vérifie si l'utilisateur ne dépasse le nombre max de résa par semaine
					$resVerifNbResa=mysqli_query($ctx,$reqVerifNbResa);
					if ($ligne=mysqli_num_rows($resVerifNbResa)==1) 
					{
						?>
						<script type="text/javascript">
						alert('Vous ne pouvez dépasser plus d\'une réservation pour une semaine donnée');
						</script>
						<?php					
					}
					elseif ($ligne=mysqli_num_rows($resVerifNbResa)==0) 
					{
						header("location:actionFormResa.php?noHeb=$noHeb&dtDebutResa='$dateSemResa'");
					}

										
				}
			}
				
		}
			

	?>
	

</body>
</html>