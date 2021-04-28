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
	<title>Ajout d'hébergement</title>
	<link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<div class="tri col-sm-12 col-lg-12 ">

			<form class="form-group" method='POST' action='actionAjoutHeb.php' enctype='multipart/form-data'>
					<center> <h4>Ajouter un nouveau hebergement</h4>
								<label for id='noHebergement'>N° hébergement</label>
							<input class="form-control-sm" type="number" name='noHebergement' id="noHebergement" inputmode="numeric" required="required" max="99"><br/>
					<select class="form-control-sm"  name="codeTypeHeb">
						<option value="" disabled="disabled" selected="">Type d'hébèrgement</option>
						<?php
						$reqType= 'SELECT CODETYPEHEB FROM TYPE_HEB';
						$resType=mysqli_query($ctx,$reqType);
						while ($ligne=mysqli_fetch_array($resType)) 
						{
						
							echo utf8_encode("<option value=".$ligne["CODETYPEHEB"].">".$ligne['CODETYPEHEB']."</option>");
						}

						?>

					</select><br/>
								<label for id='nomHebergement'>Nom de l'hébérgement</label>
							<input type="text" name='nomHebergement' id="nomHebergement" inputmode="text" required="required" minlength="5" maxlength="40"><br/>

								<label for id='nbPlaceHeb'>Nombre de places disponibles</label>
							<input type="number" name='nbPlaceHeb' id="nbPlaceHeb" inputmode="numeric" required="required" max="2"><br/>
							
													<label for id='surfaceHeb'>Surface (en m²)</label>
						<input type="number" name='surfaceHeb' id="surfaceHeb" inputmode="numeric" required="required" max="2"><br/>

						<label for id='internet'>Internet ? </label>

						<input type="text" name='internet' id="internet" inputmode="numeric" required="required" maxlength="1"><br/>
							
							<label for id='anneeHeb'>Année de sa dernière remise en état </label>
						<input type="text" name='anneeHeb' id="anneeHeb" inputmode="numeric" required="required" minlength="4" maxlength="4"><br/>
							
							<label for id='secteurHeb'>Secteur de l'hébergement</label>
						<input type="text" name='secteurHeb' id="secteurHeb" inputmode="text" required="required" maxlength="15"><br/>
							
								<label for id='orientationHeb'>Orientation de l'hébergement</label>
						<input type="text" name='orientationHeb' id="orientationHeb" inputmode="text" required="required"  maxlength="5"><br/>
							
								<label for id='etatHeb'>Etat de l'hébergement</label>
						<input type="text" name='etatHeb' id="etatHeb" inputmode="text" required="required" maxlength="32"><br/>
							

							<label for id='descriHeb'>Description (200 caractères max)</label>
						<textarea name='descriHeb' id="descriHeb" inputmode="text" required="required" maxlength="200">
						</textarea><br/>

							<label for id='photoHeb'>Photo (Mo max)</label>
						<input class="form-control-file" type="file" name='photoHeb' id='photoHeb' maxlength="50" required="required"><br/>
							
							<label for id='tarifSemHeb'>Tarif pour une semaine de location </label>
						<input type="text" name='tarifSemHeb' id="tarifSemHeb" inputmode="numeric" required="required" maxlength="4"><br/>
								
						<input class ="btn btn-secondary"type="reset" name="btnReset" value="Tout effacer">
						<input class="btn btn-primary" type="submit" name="validerAjoutHeb" value="Valider">

				</center>
			</form>
					
					

				
			<form class="" method='post' action=''>
				<center><h4>Ajouter un nouveau type d'hébergement</h4>
						<label for id ="codeTypeHeb2">Code du type d'hébérgement</label>
					<input type="text" name="codeTypeHeb2" id="codeTypeHeb2" inputmode="text" minlength="5" maxlength="5" required="required"><br/>

						<label for id ="nomTypeHeb2">Nom du type d'hébergement</label>
					<input type="text" name="nomTypeHeb2" id="nomTypeHeb2" inputmode="text" maxlength="30" required="required"><br/>
					<input  class="btn btn-primary" type="submit" name="btNveauType" value="Valider">

				</center>
			</form>
			<?php
		
				if (isset($_POST['btNveauType'])) 
				{

					$codeTypeHeb2=$_POST['codeTypeHeb2'];
					$nomTypeHeb2=$_POST['nomTypeHeb2'];
					$reqCodeType="SELECT CODETYPEHEB FROM TYPE_HEB WHERE CODETYPEHEB="."'$codeTypeHeb2'";
					$resCodeType=mysqli_query($ctx,$reqCodeType);
						if (mysqli_num_rows($resCodeType)==0) 
						{

						$reqInsertType="INSERT INTO TYPE_HEB(CODETYPEHEB,NOMTYPEHEB)VALUES('$codeTypeHeb2','$nomTypeHeb2')";
						mysqli_query($ctx,$reqInsertType);
						?>
							<div class="alert alert-success" role="alert">
				 			<h4 class="alert-heading">Très bien!</h4>
				 			 <hr>
							 <p>L'insertion a été effectuée avec succés.</p>
							</div>
						<?php
						
						}

						if (mysqli_num_rows($resCodeType)==1) 

						{
								?>
							<script type="text/javascript">
							alert('Le code type d\'hebergement existe déjà, veuillez entrez un autre code.');
							</script>
								<?php
						}


				}
			?>
	</div>
	</div>
</body>
</html>