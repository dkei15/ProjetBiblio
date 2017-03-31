<?php
	session_start();
	//connect to database
	$db=mysqli_connect("localhost","root","","biblio");
	if(isset($_POST['inscription_btn']))
	{
		$username=mysqli_real_escape_string($db,$_POST['username']);
		$sql="SELECT username FROM adherent WHERE username = '$username'";
		$result = mysqli_query($db,$sql);
		if(mysqli_num_rows($result) == 1)
		{
			$_SESSION['message'] ="Cet Identifiant est déjà utilisé";
		}
		else if(empty($_POST['username']))
		{
		
		$_SESSION['message']= "Le champ est vide !";
			}	
	 else{
				   
				$email=mysqli_real_escape_string($db,$_POST['email']);
				$password=mysqli_real_escape_string($db,$_POST['password']);
				$password2=mysqli_real_escape_string($db,$_POST['password2']);  
				$nom=mysqli_real_escape_string($db,$_POST['nom']);
				$prenom=mysqli_real_escape_string($db,$_POST['prenom']);

				 if($password==$password2)
				 {           //Create User
						$password=md5($password); //hash password before storing for security purposes
						$sql="INSERT INTO adherent(MotDePass, username, AdPrenom,AdNom,AdMail) VALUES('$password','$username','$prenom', '$nom','$email')";
						mysqli_query($db,$sql);  
						$_SESSION['message']="You are now logged in"; 
						$_SESSION['username']=$username;
						header("location:home.php");  //redirect home page
				}
				else
				{
				  $_SESSION['message']="The two password do not match";   
				 }
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
					<div id="centre">
						<header>
						<h1 class ="h1">S'inscrire</h1>
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
							
						</header>
						<div id="connexion" align="center">
								<form method="post" action="inscription.php" >
								<fieldset >
									<table>
										<legend> CONTACT : </legend>
										 <tr>
											   <td>Indetifiant : </td>
											   <td><input type="text" name="username" class="textInput"></td>
										 </tr>
										 <tr>
										   <td>Mot de passe: </td>
										   <td><input type="password" name="password" class="textInput"></td>
										</tr>
										 <tr>
										   <td>Confirmation de mot de passe: </td>
										   <td><input type="password" name="password2" class="textInput"></td>
										</tr>
								
								 
								 </table>
								 </fieldset>
								 <fieldset>
									<table align ="center">
										<legend> INFORMATIONS PERSONNELS : </legend>
								 
								  <tr>
									   <td width = "150px" >Nom</td>
									   <td><input type="text" name="nom" class="textInput"></td>
								 </tr>
								  <tr>
									   <td width = "150px" >Prenom</td>
									   <td><input type="text" name="prenom" class="textInput"></td>
								 </tr>
								 <tr>
											   <td width = "150px" >Email : </td>
											   <td><input type="email" name="email" class="textInput" ></td>
								</tr>
								 <tr>
									   <td width = "150px" >ortable</td>
									   <td><input type="text" name="portable" class="textInput"></td>
								 </tr>
								 <tr>
									   <td width = "150px" >Age</td>
									   <td><input type="text" name="portable" class="textInput"></td>
								 </tr>
								 <tr>
									   <td width = "150px" ><B>Adresse</b></td>
									   <td><input type="text" name="Adresse" class="textInput"></td>
								 </tr>
							
							</table>
							</fieldset>
							
								  
									
									   </br><input type="submit" name="inscription_btn" class="login" align="center">
									   <input type="reset" value="Annuler" class="login" />
								
								 
								   
							 
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>