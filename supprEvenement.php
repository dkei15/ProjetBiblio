<?php
session_start();
//var_dump($_SESSION);
$db=mysqli_connect("localhost","root","","biblio");
$tab_eve = [];
$all_eve = [];

$conference = mysqli_query($db, 'SELECT * FROM evenement INNER JOIN conference ON evenement.NumEv = conference.NumEv');
$exposition = mysqli_query($db, 'SELECT * FROM evenement INNER JOIN exposition ON evenement.NumEv = exposition.NumEv');
$projection = mysqli_query($db, 'SELECT * FROM evenement INNER JOIN projection ON evenement.NumEv = projection.NumEv');
$spectacle = mysqli_query($db, 'SELECT * FROM evenement INNER JOIN spectacle ON evenement.NumEv = spectacle.NumEv');

while ($value = mysqli_fetch_assoc($conference)) {
  $all_eve[$value['NumEv']]['nom'] = $value['nom'];
  $all_eve[$value['NumEv']]['description'] = $value['description'];
  $all_eve[$value['NumEv']]['conferencier'] = $value['conferencier'];
  $all_eve[$value['NumEv']]['type'] = 'Conférence';
}
while ($value = mysqli_fetch_assoc($exposition)) {
  $all_eve[$value['NumEv']]['nom'] = $value['nom'];
	$all_eve[$value['NumEv']]['description'] = $value['description'];
	$all_eve[$value['NumEv']]['type'] = 'Exposition';
}
while ($value = mysqli_fetch_assoc($projection)) {
  $all_eve[$value['NumEv']]['nom'] = $value['nom'];
  $all_eve[$value['NumEv']]['description'] = $value['description'];
  $all_eve[$value['NumEv']]['cote'] = $value['cote'];
  $all_eve[$value['NumEv']]['type'] = 'Projection';
}
while ($value = mysqli_fetch_assoc($spectacle)) {
  $all_eve[$value['NumEv']]['nom'] = $value['nom'];
  $all_eve[$value['NumEv']]['description'] = $value['description'];
  $all_eve[$value['NumEv']]['type'] = 'Spectacle';
}

if(!empty($_SESSION)) {
	$user_id = $_SESSION['IdAdherent'];
}

if( isset($_POST) && !empty($_POST) ) {
	//var_dump($_POST);
	mysqli_query($db, 'DELETE FROM `evenement` WHERE `NumEv` = '. $_POST['id'] );
  if($all_eve[$_POST['id']]['type'] == 'Conférence')
  	mysqli_query($db, 'DELETE FROM `conference` WHERE `NumEv` = '. $_POST['id'] );
  else if($all_eve[$_POST['id']]['type'] == 'Exposition')
    mysqli_query($db, 'DELETE FROM `exposition` WHERE `NumEv` = '. $_POST['id'] );
  else if($all_eve[$_POST['id']]['type'] == 'Projection')
    mysqli_query($db, 'DELETE FROM `projection` WHERE `NumEv` = '. $_POST['id'] );
  else if($all_eve[$_POST['id']]['type'] == 'Spectacle')
    mysqli_query($db, 'DELETE FROM `spectacle` WHERE `NumEv` = '. $_POST['id'] );
	header("Location: ".$_SERVER["PHP_SELF"]);
}
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Evènements</title>
	<META NAME="Author" LANG="fr" CONTENT="Khadija MOUSTAINE">
	<META NAME="Publisher" CONTENT="Khadija MOUSTAINE">
	<META NAME="Reply-to" CONTENT="moustaine-khadija@hotmail.fr (Khadija MOUSTAINE)">
	<META NAME="Language" CONTENT="fr">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="css/connexion.css" type="text/css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css" type="text/css">
	<style type="text/css">
	.active{
		background-color: #f6dc8a !important;
	}
	</style>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
				<div id="centre" align="center">
					<header>
						<h1 class ="h1">Evènements</h1>
					</header>
					<div id="liste-ev">
						<?php
						$reponse = mysqli_query($db, 'SELECT * FROM evenement');
            while ($donnees = mysqli_fetch_assoc($reponse)) {
						?>
							<form method="post" >
								<fieldset>
								<legend><strong>Evènement</strong> <?php echo $donnees['NumEv']; ?></legend>
								<input type="hidden" name="id" id="id" value="<?php echo $donnees['NumEv']; ?>" />
								<p>
									<?php echo $all_eve[$donnees['NumEv']]['nom']; ?><br />
									<?php echo $all_eve[$donnees['NumEv']]['description']; ?><br />
									<?php echo $all_eve[$donnees['NumEv']]['type']; ?><br />
									<?php echo $donnees['DateEv']; ?><br />
									<?php echo 'Lieu : ' . $donnees['LieuEv']; ?><br />
									<?php echo 'Nombre de place restante : ' . $donnees['CapaciteEv']; ?>
								</p>
								<input style="width: 150px;" class="login" type="submit" value="Supprimer" />
								</fieldset>
							</form>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
</body>
</html>
