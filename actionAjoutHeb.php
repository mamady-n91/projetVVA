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
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ajout d'un nouvel hébérgement</title>
    <link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="style.css">
  </head> 
<link rel="stylesheet" href="bootstrap-4.4.0-dist/css/bootstrap.min.css">
 <link rel="stylesheet" type="text/css" href="style.css">


<?php

if (isset($_POST['validerAjoutHeb']) AND !empty($_POST['validerAjoutHeb'])) 
          {

          $req="SELECT NOHEB FROM hebergement WHERE NOHEB=".$_POST['noHebergement'];
          $res=mysqli_query($ctx,$req);
           if (mysqli_num_rows($res)==1) 
           {
           
          
            ?>
            <script type="text/javascript">
              alert('Le numero d\'hébérgement existe déjà, veuillez entrez un autre numéro.');
              window.location.href='ajoutHebergement.php';
            </script>
            <?php

            }
          


           if (mysqli_num_rows($res)==0)
          {
            echo'fgfbf';
            if ($_FILES['photoHeb']['error']==0) 
              {

                if ($_FILES['photoHeb']['size']<=5000000) 
                {
                  // Testons si l'extension est autorisée
                              $infosfichier = pathinfo($_FILES['photoHeb']['name']);
                              $extension_upload = $infosfichier['extension'];
                              $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                              if (in_array($extension_upload, $extensions_autorisees))
                              {

                        // On peut valider le fichier et le stocker définitivement
                                     if(move_uploaded_file($_FILES['photoHeb']['tmp_name'],'images\\'  .basename($_FILES['photoHeb']['name'])))
                                     {
                                        $image=mysqli_escape_string($ctx,'images\\'.basename($_FILES['photoHeb']['name']));

                            $reqInsert = "INSERT INTO hebergement (NOHEB, CODETYPEHEB, NOMHEB, NBPLACEHEB, SURFACEHEB, INTERNET, ANNEEHEB,SECTEURHEB,ORIENTATIONHEB,ETATHEB,DESCRIHEB,PHOTOHEB,TARIFSEMHEB) VALUES(".$_POST['noHebergement'].",'".$_POST['codeTypeHeb']."','".$_POST['nomHebergement']."',".$_POST['nbPlaceHeb'].",".$_POST['surfaceHeb'].",".$_POST['internet'].",".$_POST['anneeHeb'].",'".$_POST['secteurHeb']."','".$_POST['orientationHeb']."','".$_POST['etatHeb']."','".$_POST['descriHeb']."','$image',".$_POST['tarifSemHeb'].")";

                            mysqli_query($ctx,$reqInsert);
                            echo mysqli_affected_rows($ctx);
                            ?>
                            <div class="alert alert-success" role="alert">
                               <h4 class="alert-heading">Très bien!</h4>
                               <hr>
                               <p>L'insertion a été effectuée avec succés.</p>
                            </div>
                            <?php
                                    }
                                }
                }

            }
          }
      }


            //Les messages d'erreurs
            if (isset($_FILES['photoHeb']) AND $_FILES['photoHeb'] ['size']>5000000)
            {
                ?>
              <script type="text/javascript">
              alert('La taille de l\'image est trop élevé');
              </script>
                <?php


            }


?>
</html>
