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
//$row = mysqli_fetch_all($conference, MYSQLI_ASSOC);
// foreach ($row as $value) {
// 	$all_eve[$value['NumEv']]['nom'] = $value['nom'];
// 	$all_eve[$value['NumEv']]['description'] = $value['description'];
// 	$all_eve[$value['NumEv']]['conferencier'] = $value['conferencier'];
// 	$all_eve[$value['NumEv']]['type'] = 'Conférence';
// }
// $row = mysqli_fetch_all($exposition, MYSQLI_ASSOC);
// foreach ($row as $value) {
// 	$all_eve[$value['NumEv']]['nom'] = $value['nom'];
// 	$all_eve[$value['NumEv']]['description'] = $value['description'];
// 	$all_eve[$value['NumEv']]['type'] = 'Exposition';
// }
// $row = mysqli_fetch_all($projection, MYSQLI_ASSOC);
// foreach ($row as $value) {
// 	$all_eve[$value['NumEv']]['nom'] = $value['nom'];
// 	$all_eve[$value['NumEv']]['description'] = $value['description'];
// 	$all_eve[$value['NumEv']]['cote'] = $value['cote'];
// 	$all_eve[$value['NumEv']]['type'] = 'Projection';
// }
// $row = mysqli_fetch_all($spectacle, MYSQLI_ASSOC);
// foreach ($row as $value) {
// 	$all_eve[$value['NumEv']]['nom'] = $value['nom'];
// 	$all_eve[$value['NumEv']]['description'] = $value['description'];
// 	$all_eve[$value['NumEv']]['type'] = 'Spectacle';
// }
//var_dump($all_eve);

if(!empty($_SESSION)) {
	$user_id = $_SESSION['IdAdherent'];
}

if( isset($_POST) && !empty($_POST) ) {
	//var_dump($_POST);
	if($_POST['inscrit']) {
		mysqli_query($db, 'DELETE FROM `participe` WHERE `IdAdherent` = '. $user_id .' AND `NumEv` = '. $_POST['id'] );
		mysqli_query($db, 'UPDATE evenement SET CapaciteEv = CapaciteEv + 1 WHERE NumEV = ' . $_POST['id'] );
	}
	else {
		mysqli_query($db, 'INSERT INTO `participe` (`IdAdherent`, `NumEv`) VALUES ('. $user_id .', '. $_POST['id'] .')');
		mysqli_query($db, 'UPDATE evenement SET CapaciteEv = CapaciteEv - 1 WHERE NumEV = ' . $_POST['id'] );
	}
	header("Location: ".$_SERVER["PHP_SELF"]);
}
//var_dump($tab_eve);
if(!empty($_SESSION)) {
	$reponse = mysqli_query($db, 'SELECT * FROM participe WHERE idAdherent = ' . $user_id);
	// $row = mysqli_fetch_all($reponse, MYSQLI_ASSOC);
	// foreach ($row as $value) {
	// 	array_push($tab_eve, $value['NumEv']);
	// }
  while ($value = mysqli_fetch_assoc($reponse)) {
    array_push($tab_eve, $value['NumEv']);
  }
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
	<script>
	$( function() {
		$( "#btn-liste" ).click(function() {
			$( "#liste-ev" ).show();
			$( "#prochain-ev" ).hide();
			$( "#passe-ev" ).hide();
			$( "#btn-liste" ).addClass( "active" );
			$( "#btn-prochain" ).removeClass( "active" );
			$( "#btn-passe" ).removeClass( "active" );
		});
		$( "#btn-prochain" ).click(function() {
			$( "#liste-ev" ).hide();
			$( "#prochain-ev" ).show();
			$( "#passe-ev" ).hide();
			$( "#btn-liste" ).removeClass( "active" );
			$( "#btn-prochain" ).addClass( "active" );
			$( "#btn-passe" ).removeClass( "active" );
		});
		$( "#btn-passe" ).click(function() {
			$( "#liste-ev" ).hide();
			$( "#prochain-ev" ).hide();
			$( "#passe-ev" ).show();
			$( "#btn-liste" ).removeClass( "active" );
			$( "#btn-prochain" ).removeClass( "active" );
			$( "#btn-passe" ).addClass( "active" );
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
				<div id="centre" align="center">
					<header>
						<h1 class ="h1">Evènements</h1>
					</header>
					<?php if(isset($_SESSION['username'])) { ?>
						<input id="btn-liste" style="width: 200px; margin-bottom: 30px;" class="login active" type="submit" value="Evènements à venir">
						<input id="btn-prochain" style="width: 200px; margin-bottom: 30px;" class="login" type="submit" value="Mes évènements">
						<input id="btn-passe" style="width: 200px; margin-bottom: 30px;" class="login" type="submit" value="Evènements passés">
					<?php } ?>
					<div id="liste-ev">
						<?php
						$reponse = mysqli_query($db, 'SELECT * FROM evenement WHERE DateEv > CURRENT_DATE ORDER BY DateEv');
						//$row = mysqli_fetch_all($reponse, MYSQLI_ASSOC);
						// if(empty($row)) {
						// 	echo '<p style="text-align: center;">Il n\'y a aucun évènement prévu.</p>';
						// }
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
								<?php if(isset($_SESSION['username'])) {
									if($donnees['CapaciteEv'] < 1 && !in_array($donnees['NumEv'],$tab_eve)) {
										echo '<p style="text-align: center; color: white;">Il n\'y a plus de place disponible.</p>';
									}
									else {
										if(!in_array($donnees['NumEv'],$tab_eve)) {
											echo '<input style="width: 150px;" class="login" type="submit" value="S\'inscrire">';
											echo '<input type="hidden" name="inscrit" id="inscrit" value="0" />';
										}
										else {
											echo '<input style="width: 150px;" class="login" type="submit" value="Se désinscrire">';
											echo '<input type="hidden" name="inscrit" id="inscrit" value="1" />';
										}
									}
								}?>
								</fieldset>
							</form>
						<?php
						}
						?>
					</div>
					<div id="prochain-ev" hidden>
						<?php
						$reponse = mysqli_query($db, 'SELECT * FROM evenement INNER JOIN participe ON evenement.NumEv = participe.NumEv WHERE participe.IdAdherent = ' . $user_id . ' AND evenement.DateEv > CURRENT_DATE ORDER BY evenement.DateEv');
						// $row = mysqli_fetch_all($reponse, MYSQLI_ASSOC);
						// if(empty($row)) {
						// 	echo '<p style="text-align: center;">Vous n\'avez aucun évènement prévu.</p>';
						// }
						// else {
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
								<?php if(isset($_SESSION['username'])) {
									if($donnees['CapaciteEv'] < 1 && !in_array($donnees['NumEv'],$tab_eve)) {
										echo '<p style="text-align: center; color: white;">Il n\'y a plus de place disponible.</p>';
									}
									else {
										if(!in_array($donnees['NumEv'],$tab_eve)) {
											echo '<input style="width: 150px;" class="login" type="submit" value="S\'inscrire">';
											echo '<input type="hidden" name="inscrit" id="inscrit" value="0" />';
										}
										else {
											echo '<input style="width: 150px;" class="login" type="submit" value="Se désinscrire">';
											echo '<input type="hidden" name="inscrit" id="inscrit" value="1" />';
										}
									}
								}?>
								</fieldset>
							</form>
						<?php
						}
						?>
					</div>
					<div id="passe-ev" hidden>
						<?php
						$reponse = mysqli_query($db, 'SELECT * FROM evenement WHERE DateEv < CURRENT_DATE ORDER BY DateEv');
						// $row = mysqli_fetch_all($reponse, MYSQLI_ASSOC);
						// if(empty($row)) {
						// 	echo '<p style="text-align: center;">Il n\'y a aucun évènement.</p>';
						// }
						// else {
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
