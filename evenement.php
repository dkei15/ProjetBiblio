<?php
session_start();
//var_dump($_SESSION);
$bdd = new PDO('mysql:host=localhost;dbname=biblio;charset=utf8', 'root', '');

$user_id = 1;
$tab_eve = [];

if( isset($_POST) && !empty($_POST) ) {
	//var_dump($_POST);
	if($_POST['inscrit']) {
		$bdd->exec('DELETE FROM `participe` WHERE `IdAdherent` = '. $user_id .' AND `NumEv` = '. $_POST['id'] );
		$bdd->exec('UPDATE evenement SET CapaciteEv = CapaciteEv + 1 WHERE NumEV = ' . $_POST['id'] );
	}
	else {
		$bdd->exec('INSERT INTO `participe` (`IdAdherent`, `NumEv`) VALUES ('. $user_id .', '. $_POST['id'] .')');
		$bdd->exec('UPDATE evenement SET CapaciteEv = CapaciteEv - 1 WHERE NumEV = ' . $_POST['id'] );
	}
}

$reponse = $bdd->query('SELECT NumEv FROM participe WHERE idAdherent = ' . $user_id);
while ($donnees = $reponse->fetch()) {
	array_push($tab_eve, $donnees['NumEv']);
}

//var_dump($tab_eve);

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
					  <?php
					  $reponse = $bdd->query('SELECT * FROM evenement');
					  while ($donnees = $reponse->fetch()) {
					  ?>
						<form method="post">
						  <h4><strong>Evenement</strong> : <?php echo $donnees['NumEv']; ?></h4>
						  <input type="hidden" name="id" id="id" value="<?php echo $donnees['NumEv']; ?>" />
						  <p>
							  <?php echo $donnees['DateEv']; ?><br />
							  <?php echo $donnees['LieuEv']; ?><br />
							  <?php echo $donnees['CapaciteEv']; ?>
						  </p>
						  <?php if(isset($_SESSION['username']) && $donnees['CapaciteEv'] > 0) {
							  if(!in_array($donnees['NumEv'],$tab_eve)) {
								echo '<input class="login" type="submit" value="S\'inscrire">';
								echo '<input type="hidden" name="inscrit" id="inscrit" value="0" />';
							  }
							  else {
								echo '<input class="login" type="submit" value="Se désinscrire">';
								echo '<input type="hidden" name="inscrit" id="inscrit" value="1" />';
							  }
							}?>
						</form>
						<hr>
					  <?php
					  }
					  $reponse->closeCursor(); // Termine le traitement de la requête
					  ?>
				</div>
			</div>
		</div>
</body>
</html>
