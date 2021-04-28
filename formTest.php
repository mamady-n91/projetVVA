<?php 
include("fonctionVva.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form action="cible.php" method="post" enctype="multipart/form-data">
	
	<label for="imageTest">Nouvelle image</label>
	<input type="file" name="imageTest" id="imageTest">
	<input type="submit" name="btnValiderImg">


</form>
</body>
</html>