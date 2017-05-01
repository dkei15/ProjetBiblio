<?php
session_start();

//connect to database

	$db=mysqli_connect("localhost","root","","biblio");


	if(isset($_GET['suppr_btn'])){
		$isbn =  mysqli_real_escape_string($db,$_GET['supprOeuvre']);
		$sql = "DELETE FROM oeuvre WHERE cote = '$isbn'";
		mysqli_query($db,$sql);
		$resultat2 = 'DELETE FROM exemplaire WHERE cote = '.$isbn.' ' ; // Suppression des exemplaire
		mysqli_query($db,$resultat2);
		$_SESSION['message']='Oeuvre supprimée';

	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ajout ou Supprimer</title>
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
				<a href="index.php" id="logo"><img src="images/logo.jpg" width= "250" height = "150"  alt="LOGO"></a>

				<ul id="navigation">
				<li class="selected">
					<a href="index.php" title="Home"></a>
				</li>
				<li>
					<a href="desinscrire.php">Desinscription</a>
				</li>
				<li>
					<a href="ajoutSuppr.php">Oeuvres</a>
				</li>
				<li>
					<a href="commande-admin.php">Commande</a>
				</li>
				<li>
					<a href="ajoutEvenement.php">Evenement</a>
				</li>
				<li>
					<a href="emprunt.php">Emprunt</a>
				</li>
			</ul>
			</div>
			<div id="contents">
				<div class="background">
					<div id="centre">
					<?php
				if(!isset($_SESSION['adminame'])) { echo "" ;  }// A MODIFEIR PAR ADMINAME
				else { echo "<a class='connexion' href='deconnexion.php'>Deconnexion</a>"; }
				?>
						<header>
							<h1 class ="h1">Gestion des oeuvres</h1>

							<?php
									if(isset($_SESSION['message']))
									{
										 echo "<div adminame='error_msg'>".$_SESSION['message']."</div>";
										 unset($_SESSION['message']);
									}
								?>


						</header>
						<?php
						if(isset ($_SESSION['adminame'])){


				echo'	<div  align="center">
							<form method="get" action="SupprSeul.php" >
								<fieldset >
									<table>
										<legend> Supprimer une oeuvre</legend>

										 <tr>
												 <td width = "150px" class="text"><b>ISBN :</b> </td>
												 <td><input type="text" name="supprOeuvre" class="textInput"></td>
										 </tr>

									</table>
								</fieldset>
								<input  type="submit" name="suppr_btn"  class="login" align="right" value="Supprimer"/>
								</br>
								</br></br>
							</form>
							</div>';}
				?>
				</div>

				<?php if(!isset($_SESSION['adminame'])){ 
					echo "<div id='connexion' align='center'>
								<form method='post' action='connexion-admin.php'>
									<fieldset>
										<table>
											<legend>Informations Personnelles</legend>
											<tr>
												<td width = '150px' class='text' ><b>Indentifiant :</b></td>
												<td><input type='text' name='username' class='textInput' width = '150px'></td>
											</tr>
											<tr>
												<td width = '150px' class='text' ><b>Mot de passe :</b></td>
												<td><input type='password' name='password' class='textInput' width = '150px'></td>
											</tr>
										</table>
									</fieldset>
									</br>
									<input  type='submit' name='admin_btn'  class='login' align='center' value='Se connecter'/>
									<input type='reset' value='Annuler' class='login' />
									</br></br>
								</form>
				</div>";}
				?>
			</div>
		</div>
	</body>
</html>
