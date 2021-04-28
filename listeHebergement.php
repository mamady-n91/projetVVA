<div class="container">
		<div class="tri col-sm-12 col-lg-12 ">
			<form class="form-group" method='post' action=''>
							<input class="form-control-sm" type="number" name ="Prixmin" min=0 id="Prixmin" placeholder="Prix min">

							 <input class="form-control-sm"  type="number" name ="Prixmax" min=0 id="Prixmax" placeholder="Prix max">
							
							
						
				<?php
				/*/if(!isset($_POST['NOMTYPEHEB']) OR !isset ($_POST['Prixmin']) OR !isset ($_POST['Prixmax']) OR !isset ($_POST['etatx'])OR !isset ($_POST['internet']) )
				{
					*/$req='SELECT NOHEB,NOMHEB,PHOTOHEB,DESCRIHEB,NBPLACEHEB,TARIFSEMHEB,SECTEURHEB,ETATHEB FROM hebergement';
				
					//$reqEtat="SELECT NOHEB,NOMHEB,PHOTOHEB,DESCRIHEB,NBPLACEHEB,TARIFSEMHEB,SECTEURHEB,ETATHEB FROM HEBERGEMENT";

					?>
				<select  class="form-control form-control-sm" name="etat">
				<option value="">Etat de l'hébergement</option>
					<?php
				$reqEtatHeb='SELECT ETATHEB FROM HEBERGEMENT group by etatheb ';
				$resEtatHeb=mysqli_query($ctx,$reqEtatHeb);
				while ($ligne=mysqli_fetch_array($resEtatHeb))
				{
				
					echo utf8_encode("<option value='".$ligne['ETATHEB']."'>".$ligne['ETATHEB']."</option>");
					
				}


			?>
				</select>

				<label> Internet : </label> 
                <select name='internet'>
                    <option value=""> </option> <option value='0'>Non</option> <option value='1'>Oui</option>
                </select>
	

				<select  class="form-control form-control-sm" name="NOMTYPEHEB">
				<option value='' readonly='readonly'  selected="selected">Type d'hébèrgement</option>
				<?php
				$reqType= 'SELECT NOMTYPEHEB FROM TYPE_HEB';
				$resType=mysqli_query($ctx,$reqType);
				while ($ligne=mysqli_fetch_array($resType)) 
				{
				
					echo utf8_encode("<option value=".$ligne["NOMTYPEHEB"].">".$ligne['NOMTYPEHEB']."</option>");
				}

				?>

				</select>
				<input type="submit" class="btn btn-primary" name="btnValiderFiltre" value="Valider" /><br/>
			<a href="index.php"><button class="btn btn-light" >Tout afficher</button></a>
		</div>
			</form>
			

		<div class="listeHeberg">
		<table class="table table-striped table-default">
			<th scope="col">Nom de l'hébérgement</th>
			<th scope="col">Photo</th>
			<th scope="col">Description</th>
			<th scope="col">Nombre de places de l'hebergement</th>
			<th scope="col">Tarif pour une semaine d'hebergement
			<th scope="col">Localisation</th>
			<th scope="col">Etat de l'hébèrgement</th>	
			<?php
			
			if (isset($_POST['btnValiderFiltre'])) 
			{	
				
				
				$nomTypeHeb=$_POST['NOMTYPEHEB'];
				$etat=$_POST['etat'];
				$prixMin=$_POST['Prixmin'];
				$prixMax=$_POST['Prixmax'];
				$internet=$_POST['internet'];

					$lesHebsFiltrs =  FiltrerHebs($nomTypeHeb,$etat,$prixMin,$prixMax,$internet);
				
			}	

			/*if (isset($_POST['NOMTYPEHEB']) && !empty($_POST['NOMTYPEHEB']) AND isset($_POST['Prixmin'])  AND isset($_POST['Prixmax']) 
				AND  !empty($_POST['Prixmin']) AND !empty($_POST['Prixmax']) AND isset($_POST['etat']) AND !empty($_POST['etat']) 
				AND isset($_POST['internet']) AND !empty($_POST['internet'])  ) 
			{
				$nomTypeHeb = $_POST['NOMTYPEHEB'];
				$prixMin = $_POST['Prixmin'];
				$prixMax = $_POST['Prixmax'];
				$etat = $_POST['etat'];
				$internet = $_POST['internet'];

								

				if (count($etat) ==1 AND $internet=='oui') 
				{
									
				$req.= " WHERE CODETYPEHEB=(SELECT CODETYPEHEB FROM TYPE_HEB WHERE NOMTYPEHEB='$nomTypeHeb') AND ETATHEB ='".$etat[0]."' AND INTERNET = 1 AND TARIFSEMHEB >=$prixMin AND TARIFSEMHEB <=$prixMax";
				echo $req;

				}

		}

			elseif(isset($_POST['etat']))
			{
				$etat=$_POST['etat'];

					if(count($_POST['etat'])==1) {
						$req.=" WHERE ETATHEB='".$_POST['etat'][0]."'";
						echo $req;
						
					}
					elseif(count($_POST['etat'])==2) {
						$req.=" WHERE ETATHEB='".$_POST['etat'][0]."' OR ETATHEB='".$_POST['etat'][1]."'";					
					}
					elseif(count($_POST['etat'])==3) {
						$req.="  WHERE ETATHEB='".$_POST['etat'][0]."' OR ETATHEB='".$_POST['etat'][1]."' OR  ETATHEB='".$_POST['etat'][2]."'";						
					}
					elseif(count($_POST['etat'])==4) {
						$req.=" WHERE ETATHEB='".$_POST['etat'][0]."' OR ETATHEB='".$_POST['etat'][1]."' OR ETATHEB='".$_POST['etat'][2]."' OR ETATHEB='".$_POST['etat'][3]."'";						
					}
				}
	

				elseif(isset($_POST['internet']))
				{
					if($_POST['internet']=="oui")
					{

	 					$req.= " WHERE INTERNET = 1 ORDER BY NOMHEB ASC ";
	 					
					}
					elseif($_POST['internet']=="non")
						{
						$req.= " WHERE INTERNET= 0 ORDER BY
	 					NOMHEB ASC ";
	 					echo $req;
						}
					
					}
			
				/*$resInternet=mysqli_query($ctx,$reqInternet);
				while ($ligne=mysqli_fetch_array($resInternet)) 
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

//}		
			
			elseif(isset($_POST['NOMTYPEHEB']) && !empty($_POST['NOMTYPEHEB'])  )
			{
				$req.=" where CODETYPEHEB=(SELECT CODETYPEHEB FROM TYPE_HEB WHERE NOMTYPEHEB='".$_POST['NOMTYPEHEB']."')";
				//$res=mysqli_query($ctx,$req);
				echo $req;
			}


			elseif (isset($_POST['Prixmin'])  AND isset($_POST['Prixmax']) AND  !empty($_POST['Prixmin']) AND !empty($_POST['Prixmax']) )
			{


					$req.=" WHERE TARIFSEMHEB >=".$_POST['Prixmin']." AND TARIFSEMHEB <=".$_POST['Prixmax'];
					echo $req;

			}
				

			elseif (isset($_POST['Prixmin'])&& !empty($_POST['Prixmin']) AND empty($_POST['Prixmax']))
			{
		

					$req.= " WHERE TARIFSEMHEB >=".$_POST['Prixmin']; 
					echo $req;	

			}
					
			
		
			elseif (isset($_POST['Prixmax']) && !empty($_POST['Prixmax']) AND empty($_POST['Prixmin']) )
			{

					$req.= " WHERE TARIFSEMHEB <=".$_POST['Prixmax']." ORDER BY TARIFSEMHEB DESC"; 
					echo $req;
			}

			


			/*else
			{

				$req="SELECT NOHEB,NOMHEB,PHOTOHEB,DESCRIHEB,NBPLACEHEB,TARIFSEMHEB,SECTEURHEB,ETATHEB FROM hebergement";
			}*/
			/*$res=mysqli_query($ctx,$req);
			while ($ligne=mysqli_fetch_array($res)) 
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
			}*/



elseif (!isset($_POST['btnValiderFiltre'])) {
	# code...

{
	$req='SELECT NOHEB,NOMHEB,PHOTOHEB,DESCRIHEB,NBPLACEHEB,TARIFSEMHEB,SECTEURHEB,ETATHEB FROM hebergement';

	$res=mysqli_query($ctx,$req);
		while ($ligne=mysqli_fetch_array($res)) 
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
			}
		}
			?>


		</table>

	</div>