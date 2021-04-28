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
				header("location:connexion.php?page=listeCompte");
			}
?>

	<link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">

	<body>
			<center><h2>Récapitulatif des comptes</h2></center>
		<table class="table table-striped table-default">
			<th scope="col">Identifiant</th>
			<th scope="col">Mot de passe</th>
			<th scope="col">Nom</th>
			<th scope="col">Prénom</th>
			<th scope="col">Date d'inscription</th>
			<th scope="col">Date de fermeture</th>
			<th scope="col">Type de compte</th>
			<th scope="col">Adresse mail</th>
			<th scope="col">Numéro de téléphone fixe</th>
			<th scope="col">Numéro de téléphone portable</th>

<?php
$req= 'SELECT USER, MDP, NOMCPTE, PRENOMCPTE, DATEINSCRIP, DATEFERME, TYPECOMPTE,ADRMAILCPTE,NOTELCPTE,NOPORTCPTE FROM COMPTE';
$resCompte=mysqli_query($ctx,$req);
while ($ligne=mysqli_fetch_array($resCompte)) 
				{

					echo"<tr>";
						echo"<td>";
						echo utf8_encode($ligne['USER']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['MDP']);
						echo"</td>";
						echo"<td>";
						echo utf8_encode($ligne['NOMCPTE']);
						echo "</td>";
						echo"<td>";
						echo utf8_encode($ligne['PRENOMCPTE']);
						echo "</td>";
						echo"<td>";
						echo ($ligne['DATEINSCRIP']);
						echo "</td>";
						echo "<td>";
						echo ($ligne['DATEFERME']);
						echo "</td>";
						echo"<td>";
						echo ($ligne['TYPECOMPTE']);
						echo "</td>";
						echo "<td>";
						echo ($ligne['ADRMAILCPTE']);
						echo "</td>";
						echo"<td>";
						echo ($ligne['NOTELCPTE']);
						echo "</td>";
						echo"<td>";
						echo ($ligne['NOPORTCPTE']);
						echo "</td>";
						echo"<td>";
						echo "<a href='suppressionCompte.php?supprimer=\"".$ligne['USER']."\"'><button class='btn btn-outline-danger' name='btnSupprimer' >Supprimer </button></a>";
						echo "</td>";

					echo "</tr>";			
				}
				if (mysqli_num_rows($resCompte)==1) 


				{
					?>
					<div class="alert alert-success" role="alert">
	 						 <h4 class="alert-heading">Très bien!</h4>
	 						 <hr>
	 						 <p>L'insertion a été effectuée avec succés.</p>
						</div>
				<?php		
				}
				?>
		</table>