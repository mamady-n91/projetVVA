<?php
include("fonctionVva.php");
$ctx=connectBdd();
if (isset($_FILES['imageTest'])AND $_FILES['imageTest']['error']==0) 

{
	if ($_FILES['imageTest']['size']<=1000000) 
	{
		// Testons si l'extension est autorisée
                $infosfichier = pathinfo($_FILES['imageTest']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees))
                {
					             // On peut valider le fichier et le stocker définitivement
                       if(move_uploaded_file($_FILES['imageTest']['tmp_name'],"images\\"  .basename($_FILES['imageTest']['name'])))
                       {
                       		$image=mysqli_escape_string($ctx,'images\\'.basename($_FILES['imageTest']['name']));
       						$req="UPDATE HEBERGEMENT SET PHOTOHEB='$image'WHERE NOHEB=1";
                        if($res=mysqli_query($ctx,$req)==1)
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
                }
  }
}