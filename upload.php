<?php
session_start();
include("fonctionVva.php");
include("menu.php");
$ctx=connectBdd();
$idHebergSelect=$_POST['idHebergSelect'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title></title>
</head>
<body>

</body>
</html>
<?php

if (isset($_FILES['newImageHeb'])AND $_FILES['newImageHeb']['error']==0) 
{
	if ($_FILES['newImageHeb']['size']<=5000000) 
	{
		// Testons si l'extension est autorisée
                $infosfichier = pathinfo($_FILES['newImageHeb']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees))
                {

					// On peut valider le fichier et le stocker définitivement
                       if(move_uploaded_file($_FILES['newImageHeb']['tmp_name'],'images\\'  .basename($_FILES['newImageHeb']['name'])))
                       {
                       		$image=mysqli_escape_string($ctx,'images\\'.basename($_FILES['newImageHeb']['name']));
       						$req="UPDATE HEBERGEMENT SET PHOTOHEB='$image'WHERE NOHEB=".$idHebergSelect;
                        if($res=mysqli_query($ctx,$req)==1)
                        {
                             ?>
							<div class="alert alert-success" role="alert">
		 						 <h4 class="alert-heading">Très bien!</h4>
		 						 <hr>
		 						 <p>La modification a été effectuée avec succés.</p>
		 						 <a href="modifHebergement.php"><button class="btn btn-primary">Retourner vers la page de modification des hébergements</button></a>
							</div>
							<?php
                        }
                        
                  }
                }
  }




}
?>