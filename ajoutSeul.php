<?php
session_start();
//connect to database
include("connectToBase.php");
	if(isset($_GET['contat_btn'])){
		if (empty($_GET['ISBN']) || empty($_GET['TitreOeuvre']) || empty($_GET['typeOeuvre']|| empty($_GET['nomAuteur']) || empty($_GET['dateParu']) || empty($_GET['prixAchat']) || empty($_GET['domaine']))){
			$_SESSION['message']= '<script>alert(\'remplissez tous les champs\')</script> ';
		}
		else{
			$isbn =  mysqli_real_escape_string($db,$_GET['ISBN']);
			$titreoeuvre =  mysqli_real_escape_string($db,$_GET['TitreOeuvre']);
			$typeoeuvre =  mysqli_real_escape_string($db,$_GET['typeOeuvre']);
			$nomauteur = mysqli_real_escape_string($db,$_GET['nomAuteur']);
			$numExmp = mysqli_real_escape_string($db,$_GET['NumExmp']);
			$dateParution = mysqli_real_escape_string($db,$_GET['dateParu']);
			$prixAchat = mysqli_real_escape_string($db,$_GET['prixAchat']);
			$domaineOeuvre = mysqli_real_escape_string($db,$_GET['domaine']);
			$NomEdit = mysqli_real_escape_string($db,$_GET['nomEdit']);
			$listeMotClefs = explode(",",mysqli_real_escape_string($db,$_GET['motClefs']));
			$resultat1 = "SELECT IdAuteur FROM auteur WHERE nomAuteur='".$nomauteur."'";
			$result = mysqli_query($db,$resultat1);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$idauteur = $row['IdAuteur'];
			if(mysqli_num_rows($result)==0){
				$resultat = "INSERT INTO auteur(nomAuteur) VALUES('".$nomauteur."')";
				mysqli_query($db,$resultat);
				$resultat1 = "SELECT IdAuteur FROM auteur WHERE nomAuteur='".$nomauteur."'";
				$result = mysqli_query($db,$resultat1);
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$idauteur = $row['IdAuteur'];
			}else{
			}
			$resultatEdit = "SELECT IdEdit FROM editeur WHERE NomEdit='".$NomEdit."'";
			$resultEdit = mysqli_query($db,$resultatEdit);
			$row = mysqli_fetch_array($resultEdit, MYSQLI_ASSOC);
			$idEdit = $row['IdEdit'];
			if(mysqli_num_rows($resultEdit)==0){
				$resultat = "INSERT INTO editeur(NomEdit) VALUES('".$NomEdit."')";
				mysqli_query($db,$resultat);
				$resultat1 = "SELECT IdEdit FROM editeur WHERE NomEdit='".$NomEdit."'";
				$result = mysqli_query($db,$resultat1);
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$idEdit = $row['IdEdit'];
			}else{
			}
				$dateParution = date_create($_GET['dateParu']);
				$dateParution = date_format($dateParution, 'Y-m-d');
				$resultat = "INSERT INTO oeuvre(cote,titre,TypeOeuvre,IdAuteur,DomOeuvre,PrixAchat,date_parution) VALUES (".$isbn.",'".$titreoeuvre."','".$typeoeuvre."',".$idauteur.",'".$domaineOeuvre."',".$prixAchat.",'".$dateParution."')" ;
				$resultat1=mysqli_query($db,$resultat);
				$_SESSION['message']= '.$resultat.';
				$_SESSION['message']= '<p>Oeuvre et Auteur ajouté avec succès</p>';
				for($j=0;$j<count($listeMotClefs);$j++){
					$resultat2 = "SELECT Id_Mot FROM mot_clefs WHERE  nom='".$listeMotClefs[$j]."'" ;
					$result=mysqli_query($db,$resultat2);
          $length=mysqli_num_rows($result);
					if($length==0){
					$resultat = "INSERT INTO mot_clefs(nom) VALUES ('".$listeMotClefs[$j]."')" ;// AJOUT DU MOT CLEFS
					mysqli_query($db,$resultat);
					$resultat1 = "SELECT Id_Mot FROM mot_clefs WHERE  nom='".$listeMotClefs[$j]."'" ;//RECUPERATION DE L'ID DU MOT_CLEFS
					$result=mysqli_query($db,$resultat1);
					}else{
						$resultat1 = "SELECT Id_Mot FROM mot_clefs WHERE  nom='".$listeMotClefs[$j]."'" ;//RECUPERATION DE L'ID DU MOT_CLEFS
						$result=mysqli_query($db,$resultat1);
					}
					$identifiantMot=mysqli_fetch_array($result, MYSQLI_ASSOC);
					$request = "INSERT INTO appartient(cote,Id_Mot) VALUES (".$isbn.",".$identifiantMot['Id_Mot'].")"; //AJOUT DU MOT CLEFS DANS LA TABLE APPARTIENT
					mysqli_query($db,$request);
					$_SESSION['message']= '<p>Oeuvre et Auteur ajoute avec succes</p>';
				}
				for($i=0;$i<$numExmp;$i++){
					$resultat2 = 'INSERT INTO exemplaire(cote,Prolongement,EtatExmp,IdEdit) VALUES ('.$isbn.',0,0,'.$idEdit.')' ;
					mysqli_query($db,$resultat2);
				}
        $_SESSION['message']= 'Oeuvre ajoutée avec succès';
	}
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
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css" type="text/css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script>
		$( function() {
			$('#datepicker').datepicker();});
			</script>
	</head>

	<body>
		<div id="page">
			<div id="header">
				<a href="index.php" id="logo"><img src="images/logo.jpg" width= "200" height = "150"  alt="LOGO"></a>

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
						if(isset ($_SESSION['adminame'])){ // A MODIFEIR PAR ADMINAME
						echo'	<div id="ajouteOeuvre" align="center">
								<form method="get" action="ajoutSeul.php" >
									<fieldset >
										<table>
											<legend> Ajouter une oeuvre</legend>
											<tr>
													<td width = "150px" class="text"><b>ISBN :</b> </td>
													<td><input type="text" name="ISBN" autocomplete="off"  class="textInput"></td>
											</tr>
											 <tr>
												<td width = "150px" class="text" ><b>Titre de loeuvre :</b> </td>
												<td><input type="text" name="TitreOeuvre" autocomplete="off" class="textInput" ></td>
											</tr>
											<tr>
												<td width = "150px" class="text"><b>Type de loeuvre:</b> </td>
												<td>
													<select name="typeOeuvre" class="textInput">
														<option value="Vide"></<option>
														<option value="Magazine">Magazine</<option>
														<option value="DVD">DVD</<option>
														<option value="Livre">Livre</<option>
														<option value="Periode">Periodique</<option>
														<option value="Partitions">Partitions</<option>
													</select>
											</tr>
												<tr>
												   <td width = "150px" class="text" ><b>Nom Auteur</b></td>
												   <td><input type="text" name="nomAuteur" class="textInput"></td>
												   <!--<td><input type="text" id="auteur" name="auteur" value=""></td>-->
												   <!--<td><a href="#"  id="filldetails" onclick="addFields()">Ajouter un auteur</a></td>-->
												</tr>
											    <!--<tr>
													<td width = "150px" class="text"><b>Noms Auteur </b></td>
													<td id="container"></td>
												</tr>-->
											<tr>
												<td width = "150px" class="text"><b>Date de parution:</b></b></td>
												<td><input class="textInput" type="date" name="dateParu" id="datepicker" /></td>
											</tr>
											<tr>
												<td width = "150px" class="text"><b>Prix dachat:</b></b></td>
												<td><input type="number" name="prixAchat"  class="textInput"></td>
											</tr>
											<tr>
												<td width = "150px" class="text"><b>Domaine:</b></b></td>
												<td>
													<select name="domaine" class="textInput">
														<option value="Vide"></<option>
														<option value="Rom">Roman</<option>
														<option value="Socio">Sociologie</<option>
														<option value="Art">Art</<option>
														<option value="Sciences">Sciences</<option>
														<option value="Culture">Culture</<option>
													</select>
												</td>
											</tr>
											<tr>
											 <td width = "150px" class="text"><b>Nombre d\'exemplaire:</b></b></td>
											 <td>
											 <select name="NumExmp" class="textInput">
												 <option value="1">1</<option>
												 <option value="2">2</<option>
												 <option value="3">3</<option>
												 <option value="4">4</<option>
												 <option value="5">5</<option>
												 <option value="6">6</<option>
												 <option value="7">7</<option>
											 </select>
										 </td>
										 </tr>
										 <tr>
											 <td width = "150px" class="text"><b>Nom de l\'editeur :</b></b></td>
											 <td><input type="text" name="nomEdit"  class="textInput"></td>
										 </tr>
										 <tr>
											 <td width = "150px" class="text"><b>Mot clefs:</b></b></td>
											 <td><input type="text" name="motClefs"  class="textInput"></td>
										 </tr>
										</table>
									</fieldset>
									</br>
									<input  type="submit" name="contat_btn"  class="login" align="center" value="Ajouter"/>
									<input type="reset" value="Annuler" class="login" />
									</br></br>
								</form>
					</div>';}
				?>
				</div>

				<?php if(!isset($_SESSION['adminame'])){ // A MODIFEIR PAR ADMINAME
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
				</div>";} ?>
			</div>
		</div>
		<div id="footer">
				<div class="connect">
					<?php
						if(isset($_SESSION['adminame'])) 
						{
							$adminame =  $_SESSION['adminame'] ;    
							echo " Connecté en tant que <a >$adminame</a> " ;  
						}  
					?>	
				</div>
				<p>Site crée par Khadija MOUSTAINE, Alex TAYLOR, Anaud BROSSE </p>			
			</div>
	</body>
</html>