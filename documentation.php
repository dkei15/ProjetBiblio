<?php
session_start();
include 'cookie.php';
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>connexion</title>
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
			<a href="inscription.php" class="contact" >S'inscrire</a>
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
			<div id="news" position:absolute>
					<?php

					// Connexion à la base donnée et affiche si elle a réussi ou pas
					// IL FAUDRA PAR LA SUITE POUR CHAQUE REQUETE , UTILISER MYSQLI
					$mysqli = new mysqli("localhost","root","","Biblio");
					if ($mysqli->connect_errno) {
							echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
					}


						if(isset($_SESSION['message']))
						{
							 echo "<div username='error_msg'>".$_SESSION['message']."</div>";
							 unset($_SESSION['message']);
						}
					?>

					<?php
					$_SESSION['deja']=0;
						if(!isset($_SESSION['username'])) { echo "<a class='connexion' href='connexion.php'>Connexion</a>" ;  }
						else { echo "<a class='connexion' href='deconnexion.php'>Deconnexion</a>"; }
					?>
					<div position: fixed>
					  <form class="form-search" name="search_form" method="post" id="searchform" action="documentationSearch.php">
  	         <input type="text" value="" placeholder="Nom d'une oeuvre..." name="s"  />
  	          <input class="btn" type="submit" name="submit" id="searchsubmit" value="Trouver"/>
            </form>
					</div>



	</div>
</body>
</html>
