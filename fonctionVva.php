<?php  
function connectBdd()
{
	  $link = mysqli_connect("localhost","root","","resa");
      if ($link) 
      {
        return $link;
      }
      else
      {
        mysqli_error($link);
      }
  }
  
  function IdentificationUtilisateur($login,$mdp)
  {
    global $ctx;
    mysqli_set_charset("ctx","utf-8");
  }

//La fonction qui me permet de filtrer les hébergements


function FiltrerHebs($nomTypeHeb,$etat,$prixMin,$prixMax,$internet){
    $ctx = ConnectBdd();
    $req = "SELECT NOHEB, NOMHEB,PHOTOHEB,DESCRIHEB,NBPLACEHEB,TARIFSEMHEB,SECTEURHEB,ETATHEB
            FROM HEBERGEMENT";

     if(isset($nomTypeHeb) && $nomTypeHeb != ""){
        $criteres[] = "CODETYPEHEB =(SELECT CODETYPEHEB FROM TYPE_HEB WHERE NOMTYPEHEB='$nomTypeHeb')";
     }

      if(isset($etat) && $etat != ""){
        $criteres[] = "ETATHEB= '$etat'";
    }
      if(isset($prixMin) && $prixMin != ""){
        $criteres[] = "TARIFSEMHEB >= $prixMin";
    }
      if(isset($prixMax) && $prixMax != ""){
        $criteres[] = "TARIFSEMHEB <= $prixMax";
    }
      if(isset($internet) && $internet != ""){
        $criteres[] = "INTERNET = $internet";
    }


    if(isset($criteres)){
        foreach ($criteres as $key => $value) 
        {
            if($key == 0){
                $req.=" WHERE ".$value;
            }
            else{
                $req.=" AND ".$value;
        }

        }
    }
    $res = mysqli_query($ctx, $req);
    $lesHebs = [];
    echo $req;
   while ($ligne = mysqli_fetch_array($res))
   {
    echo"<tr>";
          echo"<td>";
          echo utf8_encode($ligne['NOMHEB']);
          echo "</td>";
          echo"<td>";
          echo"<img src=".$ligne['PHOTOHEB']." width='150px'>"; 
          echo"</td>";
          echo"<td>";
          echo utf8_encode($ligne['DESCRIHEB']);
          echo "</td>";
          echo"<td>";
          echo ($ligne['NBPLACEHEB']);
          echo "</td>";
          echo "<td>";
          echo ($ligne['TARIFSEMHEB']);
          echo "</td>";
          echo"<td>";
          echo ($ligne['SECTEURHEB']);
          echo "</td>";
          echo "<td>";
          echo ($ligne['ETATHEB']);
          echo "</td>";
          echo "<td>";
          echo "<a href=reserver.php?noHeb=".$ligne['NOHEB']."><button class='btn btn-outline-success' >Réserver </button></a>";
          echo "</td>";

        echo "</tr>";   

   } 
   

      while(empty($ligne) == false){
        array_push($lesHebs, $ligne['NOHEB']);
        array_push($lesHebs, $ligne['NOMHEB']);
        array_push($lesHebs, $ligne['PHOTOHEB']);
        array_push($lesHebs, $ligne['DESCRIHEB']);
        array_push($lesHebs, $ligne['NBPLACEHEB']);
        array_push($lesHebs, $ligne['TARIFSEMHEB']);
        array_push($lesHebs, $ligne['SECTEURHEB']);
        array_push($lesHebs, $ligne['ETATHEB']);
        
    }
  

    mysqli_close($ctx);
    return $lesHebs;
}

function conversion($nombreAConvertir)
{
  $ctx=connectBdd();
  $resultat= $nombreAConvertir*0.2;
  return $resultat;
}

function incrementer($nombreAIncrementer)
{
  $ctx=connectBdd();
  $resultat= $nombreAIncrementer+1;
  return $resultat;
}
?>