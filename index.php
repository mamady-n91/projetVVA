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
	<title>Hebergement de VVA</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	<?php
	include('listeHebergement.php');
	
	?>

</body>
</html>