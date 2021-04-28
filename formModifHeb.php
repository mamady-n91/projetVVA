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
<html>
<head>
	<meta charset="utf-8">
	<title>Hebergement de VVA</title>
	<link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<body>			
		<h1> Formulaire de modification des hébérgements</h1></br>
		<div class="listeHeberg">
		<table class="table table-striped table-default">
			<th scope="col">Nom de l'hébérgement</th>
			<th scope="col">Description</th>
			<th scope="col">Nombre de places de l'hebergement</th>
			<th scope="col">Tarif pour une semaine d'hebergement
			<th scope="col">Localisation</th>
			<th scope="col">Etat de l'hébèrgement</th>
			<th scope="col">Photo</th>

		
			<form class="" action="" method="post">



	</body>
<?php	
$hebergSelect= $_GET['noheb'];
$reqModifHeb= "SELECT NOHEB,NOMHEB, PHOTOHEB,DESCRIHEB,NBPLACEHEB,TARIFSEMHEB,SECTEURHEB,ETATHEB FROM Hebergement WHERE NOHEB=".$hebergSelect;
$resModifHeb=mysqli_query($ctx,$reqModifHeb);
while ($ligne=mysqli_fetch_array($resModifHeb))

{
	echo "<tr>";

	echo "<td>";
	echo "<input type='text' name='nomHeb' id='nomHeb' value='".$ligne['NOMHEB']."'></br>";
	echo $ligne['NOMHEB'];
	echo "<input class='btn btn-outline-secondary' type='submit' name='validerNomHeb' id='' value='Valider'>";
	echo "</td>";

	echo "<td>";
	echo utf8_encode("<textarea name='descriHeb' rows='5' cols='33' id='descriHeb' inputmode='text' required='required' maxlength='200'>".$ligne['DESCRIHEB']."</textarea></br>");
	echo "<input class='btn btn-outline-secondary' type='submit' name='validerDescriHeb' id='' value='Valider'>";
	echo "</td>";

	echo "<td>";
	echo "<input type='text' name='nbPlaceHeb' id='nbPlaceHeb' size=2  maxlength='2' value='".$ligne['NBPLACEHEB']."'></br>";
	echo "<input class='btn btn-outline-secondary' type='submit' name='validerNbPlaceHeb' id='' value='Valider'>";
	echo "</td>";

	echo "<td>";
	echo "<input type='text' name='tarifSemHeb' id='tarifSemHeb' size=2  maxlength='2' value='".$ligne['TARIFSEMHEB']."'></br>";
	echo "<input class='btn btn-outline-secondary' type='submit' name='validerTarifSemHeb' id='' value='Valider'>";
	echo "</td>";

	echo "<td>";
	echo "<input type='text' name='localHeb' id='localHeb' value='".$ligne['SECTEURHEB']."'></br>";
	echo "<input class='btn btn-outline-secondary' type='submit' name='validerLocalHeb' id='' value='Valider'>";
	echo "</td>";

	echo "<td>";
	echo "<input type='text' name='etatHeb' id='etatHeb' value='".$ligne['ETATHEB']."'></br>";
	echo "<input class='btn btn-outline-secondary' type='submit' name='validerEtatHeb' id='' value='Valider'>";
	echo "</td>";

	echo "</form>";
	echo "<td>";
	echo "<form action='upload.php' method='POST' enctype='multipart/form-data'>";
	echo"<img src=".$ligne['PHOTOHEB']." width='150px'></br>";
	echo "<input type='file' name='newImageHeb' id='newImageHeb'></br>";
	echo "<label for'idHebergSelect'>Id de l'hébèrgement</label>";
	echo "<input type='text' name='idHebergSelect' id='idHebergSelect' readonly='readonly' value='".$hebergSelect."'></br>";
	echo "<input class='btn btn-outline-secondary' type='submit' name='validerImg'>";
	echo "</td>";

	echo "</tr>";
}
	if (isset($_POST['validerNomHeb']))
	{
		$nouveauNomHeb=$_POST['nomHeb'];
		//$req="UPDATE Hebergement SET NOMHEB=.WHERE NOHEB =".$hebergSelect"";
		$req1="UPDATE hebergement SET NOMHEB='$nouveauNomHeb'
         WHERE NOHEB=$hebergSelect";
		mysqli_query($ctx,$req1);
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

		//mysqli_num_rows();
	}


	if (isset($_POST['validerDescriHeb'])) 
	{
		$newDescriHeb=$_POST['descriHeb'];
		$req2="UPDATE hebergement SET DESCRIHEB='$newDescriHeb'
         WHERE NOHEB=$hebergSelect";
		mysqli_query($ctx,$req2);
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

	}

	if (isset($_POST['validerNbPlaceHeb']))
	{
		$newNbPlaceHeb=$_POST['nbPlaceHeb'];
		$req3="UPDATE hebergement SET NBPLACEHEB=$newNbPlaceHeb
         WHERE NOHEB=$hebergSelect";
         mysqli_query($ctx, $req3);
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


	}

	if (isset($_POST['validerTarifSemHeb']))
	{
		$newTarifSemHeb=$_POST['tarifSemHeb'];
		$req4="UPDATE hebergement SET TARIFSEMHEB=$newTarifSemHeb
         WHERE NOHEB=$hebergSelect";
         mysqli_query($ctx, $req4);
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
		else
		{
			echo"ibii";
		}


	}

	if (isset($_POST['validerLocalHeb']))
	{
		$newLocalHeb=$_POST['localHeb'];
		$req5="UPDATE hebergement SET SECTEURHEB='$newLocalHeb'
         WHERE NOHEB=$hebergSelect";
         mysqli_query($ctx, $req5);
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


	}
	if (isset($_POST['validerEtatHeb']))
	{
		$newEtatHeb=$_POST['etatHeb'];
		$req6="UPDATE hebergement SET ETATHEB='$newEtatHeb'
         WHERE NOHEB=$hebergSelect";
         mysqli_query($ctx, $req6);
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


	}

	if (isset($_POST['validerImg']))
	{
		$nouvelleImageHeb=$_POST['newImageHeb'];
		$req7="UPDATE hebergement SET PHOTOHEB='$nouvelleImageHeb'
         WHERE NOHEB=$hebergSelect";
         mysqli_query($ctx, $req7);


	}
?>


</form>
</table>
</div>
</div>
