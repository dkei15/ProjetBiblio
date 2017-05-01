<?php
	session_start();
	//connect to database
	include("connectToBase.php");
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Gestion du bibliothéque</title>
	<META NAME="Author" LANG="fr" CONTENT="Khadija MOUSTAINE">
	<META NAME="Publisher" CONTENT="Khadija MOUSTAINE">
	<META NAME="Reply-to" CONTENT="moustaine-khadija@hotmail.fr (Khadija MOUSTAINE)">
	<META NAME="Language" CONTENT="fr">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script>
	function ajoutPro(){
		<?php
		$resultat="UPDATE exemplaire SET Prolongement=1, DateRetour=DATE_ADD(DateRetour, INTERVAL 7 DAY) WHERE NumExmp=".$_SESSION['numexmp']." AND IdAdherent=".$_SESSION['Iden']."" ;
		$rows=mysqli_query($db,$resultat);

		?>

	}
	</script>
</head>
<body>
	<div id="page">
		<div id="header">
			<?php
				if(!isset($_SESSION['username']))
				{
					echo "<a class='contact' href='inscription.php'>S'inscrire</a>" ;
				}
				else
				{
					echo "";
				}
			?>
			<?php
				if(!isset($_SESSION['username']))
				{
					echo "<a class='connexion-index' href='connexion.php'>Connexion</a>" ;
				}
				else
				{
					echo "<a class='Deconnexion-index' href='deconnexion.php'>Deconnexion</a>";
				}
			?>
			<a href="index.php" id="logo"><img src="images/logo.jpg" width= "200" height = "150" alt="LOGO"></a>

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
						<h1>Espace Personnel</h1>
						<?php
							if(isset($_SESSION['message']))
							{
								echo "<div username='error_msg'>".$_SESSION['message']."</div>";
								unset($_SESSION['message']);
							}
						?>
					</header>
					<?php
						if(isset ($_SESSION['username']))
						{
							$date=date_create($_SESSION['dateNaissance']);
							echo '<div id="connexion" align="center">
							<form method="post" action="modifInfos.php" >
								<h4>Bonjour ! '.$_SESSION['nom'].'</h4>
									<fieldset>
										<table>
											<legend> Contact</legend>
											<tr>
												<td width = "150px" height="40px" class="text"><b>Indetifiant :</b></td>
												<td><b><input type="text" name="nom" disabled class="textInput" value='.$_SESSION['username'].'></b></td>
										 	</tr>
											<tr>
												<td width = "150px" height="40px" class="text"><b>Nom :</b> </td>
												<td><input type="text" name="nom" disabled class="textInput" value='.$_SESSION['nom'].'></td>
											</tr>
											<tr>
												<td width = "150px" height="40px" class="text"><b>Prenom :</b> </td>
												<td><input type="text" name="prenom" disabled class="textInput" value='.$_SESSION['prenom'].'></td>
											</tr>
											<tr>
												<td width = "150px" class="text"><b>Email :</b> </td>
												<td><input type="text" name="email" disabled class="textInput" value='.$_SESSION['mail'].'></td>
											</tr>
											<tr>
												<td width = "150px" height="40px" class="text"><b>Adresse :</b> </td>
												<td><input type="text" name="adresse" disabled class="textInput1" value='.$_SESSION['adresse'].'></td>
											</tr>
											<tr>
												<td width = "150px" class="text"><b>Portable :</b> </td>
												<td><input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="portable" disabled class="textInput" value='.$_SESSION['tel'].'></td>
											</tr>
											<tr>
												<td width = "150px"class="text" ><b>Née le  :</b></td>
												<td><input type="text" name="age" disabled class="textInput" value='.date_format($date,"d/m/Y").'></td>
											</tr>

										</table>
							 		 </div>
									 <div align = "center">
										<input type="submit"  class="login" align="center" value ="mettre à jour">

									</div>
							  </form>';
								// OBTENIR l'ID de l'adhérent
							$resultat="SELECT IdAdherent FROM adherent WHERE username ='".$_SESSION['username']."'" ;
							$rows=mysqli_query($db,$resultat);
							$rowsId=mysqli_fetch_assoc($rows);
							$_SESSION['IdAdherent']=$rowsId['IdAdherent'];


							// SI AUCUNE RESERVATION ALORS NE RIEN AFFICHER ///.
							$resultat="SELECT cote  FROM reserve WHERE IdAdherent = '".$_SESSION['IdAdherent']."'" ;
							$rows=$mysqli->query($resultat) or die();
							$nbreLignes=mysqli_num_rows($rows);
							if($nbreLignes>0){
							echo '<div  align="center">
									<fieldset >
										<table width=100%>
											<legend> Réservations en cours</legend>
											 <tr>
												<td width = 30% class="text"><b>Titre  </td>
												<td width = 10% class="text"><b>Etat  </td>
												</tr>
											<tr>';

								while($reservation=mysqli_fetch_assoc($rows)){
								$sql="SELECT titre FROM oeuvre WHERE cote= ".$reservation['cote'].""; // A MODIFIER APRES l'etat prêt
								$request=$mysqli->query($sql) or die();
								$titre=mysqli_fetch_assoc($request);
								echo '<td width = "30%" class="text"><b>'.$titre['titre'].' </td>';


								$sql="SELECT IdAdherent FROM exemplaire WHERE cote= ".$reservation['cote']." AND IdAdherent=".$_SESSION['IdAdherent'].""; // A MODIFIER APRES l'etat prêt
								$request2=$mysqli->query($sql) or die();
								$lignes=mysqli_num_rows($request2);
								if($lignes>0){
									echo 	'<td width = "10%" class="text"><b> Disponible </td>
										</tr>';
										}
									else{
								echo 	'<td width = "10%" class="text"><b> Prêté </td>
									</tr>';
								}

							}
							echo "</table>
							</div>";

						}
							$resultat=" SELECT * FROM exemplaire WHERE IdAdherent IS NOT NULL AND IdAdherent = '".$_SESSION['IdAdherent']."'" ;
							$rows=$mysqli->query($resultat) or die();
							$nbreLignes=mysqli_num_rows($rows);
							if($nbreLignes>0){
									//EMPRUNT SI AUCUN EMPRUNT ALORS NE RIEN AFFICHER
									echo'<div id="connexion" align="center">
									<form method=\'post\' action=\'espace.php\'>
										<fieldset  >
										<legend> Emprunts en cours</legend>
											<table width=50%>
												 <tr>
													<td width = 30% class="text"><b>Titre  </td>
													<td width = 40% class="text"><b>Prolongement  </td>
													<td width = 10% class="text"><b>  Retour </td>
												</tr>';
										while($tab=mysqli_fetch_assoc($rows)){
											$resultatOeuvre=" SELECT * FROM oeuvre WHERE cote =".$tab['cote']."" ;
											$titreOeuvre=$mysqli->query($resultatOeuvre) or die();
											$titre=mysqli_fetch_assoc($titreOeuvre);
										echo	"<tr>
										<td width = \"50px\" class=\"text\"><b>".$titre['titre']."</td>";


										if($tab['Prolongement']==0){
											$_SESSION['numexmp']=$tab['NumExmp'];
											$_SESSION['Iden']=$tab['IdAdherent'];
											echo"<td> <input  type='submit' onclick=\"ajoutPro()\"  value='Prolonger'/></td>";
										}else{
											echo"<td> Pas possible </td>";
										}
										echo "<td width = \"10px\" class=\"text\"><b>".$tab['DateRetour']."</td>
										</tr>";
									}
									echo'
									</table>
									</form>
									</div>

								';
							}
					}

							?>
						</div>
						<?php
						include("identification.php");
							?>
							<div id="footer">
							<div class="connect">
							  <?php
							    if(isset($_SESSION['username']))
							    {
							      $username =  $_SESSION['username'] ;
							      echo " Connecté en tant que <a href=\"espace.php\" target\"contenu\">$username</a> " ;
							    }
							  ?>
						</div>
						<p>Site crée par Khadija MOUSTAINE, Alex TAYLOR, Anaud BROSSE </p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
