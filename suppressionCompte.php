<?php
session_start();
include("fonctionVva.php");
include("menu.php");

if(!$ctx=connectBdd())
{
	echo mysqli_error($ctx);
}

if (isset($_GET['supprimer']))
	{
		$req="DELETE FROM COMPTE WHERE USER =".$_GET['supprimer']; 
		$res=mysqli_query($ctx,$req);
		header('Location:listeCompte.php');
	}






?>