<!-- <nav class="navbar navbar-dark bg-dark">
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li class="nav-item"><a href="accueil.php">Accueil</a></li>
			<li class="nav-item"><a href="hebergement.php">Consulter les hébergements</a></li>
			<li class="nav-item"><a href="reservation.php">Réserver</a></li>
			<li class="nav-item"><a href="deconnexion.php">Déconnexion</a></li>
			<li class="nav-item"><a href="#">Essai</a></li>	
		</ul>

	</nav> -->
<?php
if (isset($_SESSION['typeCompte'])) 
{

	if ($_SESSION['typeCompte']=='ADM')
	{
?>		<nav class="navbar navbar-expand-lg navbar-light bg-dark">
	  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
	    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
	      <li class="nav-item active">
	        <a class="nav-link alert alert-dark" href="index.php">Accueil<span class="sr-only">(current)</span></a>
	      </li>
	    </ul>
	    <ul>
	       <a class="alert alert-dark" href="listeCompte.php">Afficher tous les identifiants</a>
	       <a class="alert alert-dark" href="modifHebergement.php">Modifier les hébérgements</a>
	       <a class="alert alert-dark" href="ajoutHebergement.php">Ajouter un nouvel hebergement</a>
	       <a class="alert alert-dark" href="reservation.php">Reservations</a>
	       <a class="alert alert-dark" href="deconnexion.php">Se deconnecter</a>
	    </ul>

	  </div>
	</nav>

		<?php
	}
	else if($_SESSION['typeCompte']=='VAC')
	{
		?>	

			<nav class="navbar navbar-expand-lg navbar-light bg-dark">
	  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
	    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
	      <li class="nav-item active">
	        <a class="nav-link alert alert-dark" href="index.php">Accueil<span class="sr-only">(current)</span></a>
	      </li>
	    </ul>
	    <ul>
	    	<a class="alert alert-dark" href="recapResa.php">Mon historique de réservation</a>
	       <a class="alert alert-dark" href="deconnexion.php">Se deconnecter</a>
	    </ul>	
	  </div>
	</nav>
		<?php
	}
	else if($_SESSION['typeCompte']=='LOC')
	{
		?>	
			<nav class="navbar navbar-expand-lg navbar-light bg-dark">
	  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
	    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
	      <li class="nav-item active">
	        <a class="nav-link alert alert-dark" href="index.php">Accueil<span class="sr-only">(current)</span></a>
	      </li>
	    </ul>
	    <ul>
	    	<a class="alert alert-dark" href="modifHebergement.php">Modifier les hébérgements</a>
	    	<a class="alert alert-dark" href="ajoutHebergement.php">Ajouter un nouvel hebergement</a>
	       <a class="alert alert-dark" href="reservation.php">Reservations</a>
	       <a class="alert alert-dark" href="deconnexion.php">Se deconnecter</a>
	    </ul>
	  </div>
	</nav>
		<?php
	}
}
else
{
	?>	
	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
	  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
	    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
	      <li class="nav-item active">
	        <a class="nav-link alert alert-dark" href="index.php">Accueil<span class="sr-only">(current)</span></a>
	      </li>
	    </ul>
	       <ul class="nav-item active">
	       <a class="alert alert-dark" href="connexion.php">Se connecter</a>
	    </ul>
	  </div>
	</nav>
  	<?php
}

?>