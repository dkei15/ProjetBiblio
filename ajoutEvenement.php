<?php
session_start();
//var_dump($_SESSION);
$db=mysqli_connect("localhost","root","","biblio");
$user_id = 1;
if( isset($_POST) && !empty($_POST) ) {
	//var_dump($_POST);
	$date = date_create($_POST['date']);
	$date = date_format($date, 'Y-m-d');
	mysqli_query($db, 'INSERT INTO `evenement` (`NumEv`, `DateEv`, `LieuEv`, `CapaciteEv`) VALUES (NULL, "'. $date .'", "'. $_POST['lieu'] .'", '. $_POST['capacite'] .')');

	$numEv = mysqli_insert_id($db);
	//var_dump($numEv);
	if( $_POST['type'] == 'conference') {
		mysqli_query($db, 'INSERT INTO `conference` (`nom`, `conferencier`, `description`, `NumEv`) VALUES ("'. $_POST['nom'] .'", "'. $_POST['conferencier'] .'", "'. $_POST['description'] .'", '. $numEv .')');
	}

	else if( $_POST['type'] == 'exposition') {
		mysqli_query($db, 'INSERT INTO `exposition` (`nom`, `description`, `NumEv`) VALUES ("'. $_POST['nom'] .'", "'. $_POST['description'] .'", '. $numEv .')');
	}

	else if( $_POST['type'] == 'projection') {
		mysqli_query($db, 'INSERT INTO `projection` (`nom`, `cote`, `description`, `NumEv`) VALUES ("'. $_POST['nom'] .'", "'. $_POST['cote'] .'", "'. $_POST['description'] .'", '. $numEv .')');
	}

	else if( $_POST['type'] == 'spectacle') {
		mysqli_query($db, 'INSERT INTO `spectacle` (`nom`, `description`, `NumEv`) VALUES ("'. $_POST['nom'] .'", "'. $_POST['description'] .'", '. $numEv .')');
	}

	header("location:evenement.php");
}
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Ajout Evènements</title>
	<META NAME="Author" LANG="fr" CONTENT="Khadija MOUSTAINE">
	<META NAME="Publisher" CONTENT="Khadija MOUSTAINE">
	<META NAME="Reply-to" CONTENT="moustaine-khadija@hotmail.fr (Khadija MOUSTAINE)">
	<META NAME="Language" CONTENT="fr">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="css/connexion.css" type="text/css">
	<style type="text/css">
	label{
		display: block;
		margin: 0px 0px 0px 0px;
	}
	label > span{
		color: #0d1639;
		width: 150px;
		font-weight: bold;
		float: left;
		padding-top: 8px;
		padding-left: 10px;
	}
	</style>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css" type="text/css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
	$( function() {
		$('#datepicker').datepicker();
		$( "#type" ).change(function() {
			if( $('#type').val() == 'conference' ) {
				$('#option-conference').show();
				$('#option-projection').hide();
			}
			if( $('#type').val() == 'projection' ) {
				$('#option-conference').hide();
				$('#option-projection').show();
			}
			if( $('#type').val() == 'spectacle' || $('#type').val() == 'exposition' ) {
				$('#option-conference').hide();
				$('#option-projection').hide();
			}
		});
	} );
	</script>
</head>
<body>
	<div id="page">
		<div id="header">
			<?php
			if(!isset($_SESSION['username'])) {
				echo "<a class='contact' href='inscription.php'>S'inscrire</a>" ;
			}
			else{
				echo "";
			}
			?>
			<?php
				if(!isset($_SESSION['username'])) {
					echo "<a class='connexion-index' href='connexion.php'>Connexion</a>" ;
				}
				else {
					echo "<a class='Deconnexion-index' href='deconnexion.php'>Deconnexion</a>";
				}
			?>
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
						<h1 class ="h1">Ajout d'évènement</h1>
					</header>
					<form method="post" style="margin: 0 auto;" align="center">
						<div style="margin: 0 auto; width: 360px"">
							<label for="nom"><span>Nom :</span>
								<input class="textInput" type="text" name="nom" id="nom" />
							</label>
							</br>

							<label for="description"><span>Description :</span>
								<input class="textInput" type="text" name="description" id="description" />
							</label>
							</br>

							<label for="lieu"><span>Lieu :</span>
								<input class="textInput" type="text" name="lieu" id="lieu" />
							</label>
							</br>

							<label for="date"><span>Date :</span>
								<input class="textInput" type="date" name="date" id="datepicker" />
							</label>
							</br>

							<label for="capacite"><span>Capacité :</span>
								<input class="textInput" type="number" name="capacite" id="capacite" />
							</label>
							</br>

							<label for="type"><span>Type :</span>
								<select class="textInput" name="type" id="type">
									<option value="conference">Conférence</option>
									<option value="exposition">Exposition</option>
									<option value="projection">Projection</option>
									<option value="spectacle">Spectacle</option>
								</select>
							</label>
							</br>

							<div id="option-conference">
								<label for="capacite"><span>Conférencier :</span>
									<input class="textInput" type="text" name="conferencier" id="conferencier" />
								</label>
								</br>
							</div>

							<div id="option-projection" hidden>
								<label for="capacite"><span>Cote :</span>
									<input class="textInput" type="number" name="cote" id="cote" />
								</label>
								</br>
							</div>

							</br>
							<div align="center">
								<input class="login" type="submit" value="Ajouter">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
</body>
</html>
