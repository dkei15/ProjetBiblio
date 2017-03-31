<?php
session_start();
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
			<div id="news">
					<?php
						if(isset($_SESSION['message']))
						{
							 echo "<div username='error_msg'>".$_SESSION['message']."</div>";
							 unset($_SESSION['message']);
						}
					?>
				
					<?php 
					
						if(!isset($_SESSION['username'])) { echo "<a class='connexion' href='connexion.php'>Connexion</a>" ;  } 
						else { echo "<a class='connexion' href='deconnexion.php'>Deconnexion</a>"; }
					?>
				<div id="news">
					<h4>Vous n'êtes pas encore abonné(e) aux bibliothèques de Marseille?</h4>
					<ul>
						<li>
							<img src="images/foto1.jpg" alt="Img" height="223" width="400">
							<p>
								<em>Vous pouvez tout de même profiter  de nos services:</em>
									-Travailler sur place</br>
									-Lire la presse</br>
									-Consulter sur place toutes nos collections</br>
									-Participer à un atelier ou une formation</br>
									-Assister à une conférence</br>
									-Voir une expo</br>
									-Rencontrer un auteur ou un artiste</p>
						</li>
						<li>
							<img src="images/foto2.jpg" alt="Img" height="223" width="400">
							<p>
								<em>Vous désirez vous abonner pour bénéficier de plus d'options?</em> 
							La carte de prêt, en plus des services sur place, vous permet d'emprunter des documents.</br>
							
								Elle vous permet donc : </br>
									-d'emprunter et de réserver des oeuvrs</br>
									-de profiter de nos services en ligne, dans nos bibliothèques ou depuis chez vous : 
									consulter la presse, lire un ebook, se former à une langue ou à un logiciel</br>
									-de visionner un film
									</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</body>
</html>