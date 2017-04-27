<?php
	session_start();
	//connect to database
	$db=mysqli_connect("localhost","root","","biblio");
	if(isset($_POST['connexion_btn']))
	{
	    $username=mysqli_real_escape_string($db,$_POST['username']);
	    $password=mysqli_real_escape_string($db,$_POST['password']);
	    $passwordCrypt = md5($password);
	    $sql="SELECT username, MotDePass, AdPrenom, AdNom, AdMail, AdAdresse, AdTel, AdAdhesion, AdNaissance, IdAdherent FROM adherent WHERE username = '$username' AND MotDePass = '$passwordCrypt'";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if($username != "" && $password != "")
		{
			if(mysqli_num_rows($result)> 0)
			{
				$_SESSION['message']="Vous êtes maintenant connecté";
				$_SESSION['username']= $row['username'];
				$_SESSION['nom'] = $row['AdNom'];
				$_SESSION['prenom'] = $row['AdPrenom'];
				$_SESSION['mail'] = $row['AdMail'];
				$_SESSION['adresse'] = $row['AdAdresse'];
				$_SESSION['tel'] = $row['AdTel'];
				$_SESSION['adhesion'] = $row['AdAdhesion'];
				$_SESSION['dateNaissance'] = $row['AdNaissance'];
				$_SESSION['IdAdherent'] = $row['IdAdherent'];
				
				header("location:index.php");
			}
		    else
		    {
				$_SESSION['message']="Nom d'utilisateur ou mot de passe est incorrect ";
			}
		}
		else
		{
			$_SESSION['message']="Veuillez remplir les 2 champs! ";
		}
	}
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
				<?php 
					if(!isset($_SESSION['username'])) 
					{
						echo "<a class='connexion-index' href='connexion.php'>Connexion</a>" ;  
					} 
					else 
					{
						echo "<a class='deconnexion' href='deconnexion.php'>Deconnexion</a>"; 
					}
				?> 
				<a href="inscription.php" class="contact" >S'inscrire</a>
				<a href="index.php" id="logo"><img src="images/logo.jpg" width= "200" height = "150"  alt="LOGO"> </a>
				
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
							<h1>Service d'authentification</h1>		
							<?php
								if(isset($_SESSION['message']))
								{
									echo "<div username='error_msg'>".$_SESSION['message']."</div>";
									unset($_SESSION['message']);
								}
							?>
						</header>
						<div id="connexion" align="center">
							<form method="post" action="connexion.php">
								<fieldset>
									<table>
										<legend>Identifiez-vous pour poursuivre</legend>
										<tr>
											<td width = "150px" height="40px" class="text" ><b>Indentifiant :</b></td>
											<td width = "150px" height="40px"><input type="text" name="username" class="textInput" ></td>
										</tr>
										<tr>
											<td width = "150px" height="40px" class="text" ><b>Mot de passe :</b></td>
											<td width = "150px" height="40px"><input type="password" name="password" class="textInput"></td>
										</tr>
									</table>
								</fieldset>
								</br>
								<input  type="submit" name="connexion_btn"  class="login" align="center" value="Se connecter"/>
								<input type="reset" value="Annuler" class="login" />
								</br></br>
							</form>
						</div>
					</div>
					<div id="inscription" align="center">
						<p>
					
							<a href ="inscription.php" ><i class="i">vous êtes pas inscrit?<i></a>
						</p>
					</div>
				</div>
			</div>
			<div id="footer">
			
			<p>Site crée par Khadija MOUSTAINE, Alex TAYLOR, Anaud BROSSE </p>			
		</div>
		</div>
	</body>
</html>