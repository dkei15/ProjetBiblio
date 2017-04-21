<?php
session_start();
//var_dump($_SESSION);
$db=mysqli_connect("localhost","root","","biblio");

$user_id = 1;

if( isset($_POST) && !empty($_POST) ) {
	//var_dump($_POST);
	mysqli_query($db, 'INSERT INTO `evenement` (`NumEv`, `DateEv`, `LieuEv`, `CapaciteEv`) VALUES (NULL, "'. $_POST['date'] .'", "'. $_POST['lieu'] .'", '. $_POST['capacite'] .')');
	header("location:evenement.php");
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Evenement</title>
		<META NAME="Author" LANG="fr" CONTENT="Khadija MOUSTAINE"> 
		<META NAME="Publisher" CONTENT="Khadija MOUSTAINE"> 
		<META NAME="Reply-to" CONTENT="moustaine-khadija@hotmail.fr (Khadija MOUSTAINE)">
		<META NAME="Language" CONTENT="fr">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<link rel="stylesheet" href="css/connexion.css" type="text/css">
	</head>
<body>
	<div id="page">	
		<div id="header">
			<?php if(!isset($_SESSION['username'])) { echo "<a class='connexion' href='connexion.php'>Connexion</a>" ;  } 
			else { echo "<a class='connexion' href='deconnexion.php'>Deconnexion</a>"; } ?>  
			<a href="register.php" class="contact" >S'inscrire</a>
			
			<a href="index.php" id="logo"><img src="images/logo.jpg" widtht= "250" height = "150"  alt="LOGO"> </a>
			<ul id="navigation">
				<li class="selected">
					<a href="index.php" title="Home"></a>
				</li>
				<li>
					<a href="espace.php">Espace personnel</a>
				</li>
				<li>
					<a href="documentation.php">Documentation</a>
				</li>
				<li>
					<a href="service.php">Service</a>
				</li>
				<li>
					<a href="evenement.php">Evenement</a>
				</li>
				<li class="last-child">
					<a href="contact.php">Contact nous</a>
				</li>                         
			</ul>
		</div>
		<div id="contents">
			<div class="background">
				<div id="centre">
					<header>
						<h1 class ="h1">Evenement</h1>
					</header>
					<form method="post">
					   <h4><label for="nom">Nom :</label></h4>
					   <input type="text" name="nom" id="nom" />
					   </br>
					   <h4><label for="description">Description :</label></h4>
					   <input type="text" name="description" id="description" />
					   </br>
					   <h4><label for="lieu">Lieu :</label></h4>
					   <input type="text" name="lieu" id="lieu" />
					   </br>
					   <h4><label for="date">Date :</label></h4>
					   <input type="date" name="date" id="date" />
					   </br>
					   <h4><label for="capacite">Capacité :</label></h4>
					   <input type="number" name="capacite" id="capacite" />
					   </br>
					   <input class="login" type="submit" value="Ajouter">
					</form>
				</div>
			</div>
		</div>
</body>
</html>
