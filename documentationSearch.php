<?php
session_start();
include("connectToBase.php");
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
			<div class="background" align="center">
				<div id="centre" align="center">
					<header>
						<h1 class =h1>Rechercher</h1>
					</header>
					<form class="form-search" name="search_form" method="post"  action="documentationSearch.php">

					<div align="center">
  	         <input type="text" value="" class ="login1" placeholder="Nom d'une oeuvre..." name="s"  />
  	         <input  type="submit" name="submit" class="login" value="Trouver"/>
            </form>
					</div>




					<div class=centre >
					<?php
					//----------------------------------Condition pour changer de page ou faire une nouvelle recherche -----------------------------------
					if(isset($_SESSION['deja'])){
						$_SESSION['deja']++;
					}else{
						$_SESSION['deja']=0;
					}
					//$_SESSION['reservation'];
					if($_SESSION['deja']!=1){
						if(isset($_GET['p']) && ($_GET['p']>0 || $_GET['p']==1)){
						}else{
							$_SESSION['recherche']=$_POST['s'];
							$_SESSION['deja']++;
						}
					}else {
					$_SESSION['recherche']=$_POST['s'];
					$_SESSION['deja']++;
					}
					$perPage=4; // nombre d'article par page
					//--------------------------DEBUT DE L'ALGORITHME ---------------------------------------------
					$listeDeMot=explode(' ',$_SESSION['recherche']);
					$primaryString=$resultat2="SELECT  titre, cote , TypeOeuvre FROM oeuvre as OeuvreIdMot WHERE OeuvreIdMot.cote IN( SELECT cote FROM appartient as TablAp WHERE TablAp.id_Mot IN ( SELECT IdMOTclefs.id_Mot FROM mot_clefs as IdMOTclefs WHERE nom like '%".$listeDeMot[0]."%'";
					$OR=' OR ';
					$Constructed="nom like '%";
					for($j=1;$j<sizeof($listeDeMot); $j++){

						$primaryString=$primaryString.$OR;
						$primaryString.=$Constructed.$listeDeMot[$j]."%'";

					}
					$primaryString=$primaryString." ))";


					$res2 = $mysqli->query($primaryString) or die();		//Envoie de la requête
					$nbreCase= mysqli_num_rows($res2);													//Compte le nombre de lignes lors du retour de la requête
					$nbrePage=ceil($nbreCase/$perPage);
					if(isset($_GET['p'])/* && $_GET['p']>0 /*&& $_GET['p']<$nbPage*/){//On regarde la page courante dans laquelle on se trouve
								$cPage=$_GET['p'];
							}else {
								$cPage=1;
							}



							// Ajouter IdAuteur pour montrer les auteurs
							$debut = (($cPage-1)*$perPage);					// ON calcule à partir de quand on va afficher les résultats
							$resultat2=$primaryString." LIMIT ".$debut." , ".$perPage." ";

							//$resultat2="SELECT  titre, cote , TypeOeuvre FROM oeuvre as OeuvreIdMot WHERE OeuvreIdMot.cote IN( SELECT cote FROM appartient as TablAp WHERE TablAp.id_Mot IN ( SELECT IdMOTclefs.id_Mot FROM mot_clefs as IdMOTclefs WHERE nom like '%".$_SESSION['recherche']."%')) LIMIT ".$debut.",".$perPage."";
							$res2 = $mysqli->query($resultat2) or die();		//Envoie de la requête
							$ret=mysqli_fetch_assoc($res2);// <---- REsultat de la recherche !!!!!!!!


							if($nbreCase==0){
								echo "<p>Aucun résultats n'a été trouvé pour votre recherche,vous avez la possibilité de la commande <a href=\"commande.php\">cliquez-ici</a></p>";
							}else if ($nbreCase>0){
								$indice=0;
								$listeAReserver=array();
								//unset($ret);

							echo"<p></p><table>";
							echo"<tr>";
							echo " <th> Titre </th>";
							echo " <th> ISBN </th>";
							echo " <th> Genre </th>";
							echo " <th> Disponibilité </th>";
							echo"</tr>";

							$indice=0;
							$nbreOeuvre2=0;

							echo"<tr>";
							echo "<td>".$ret['titre']."</td>";		// Affiche la première ligne car on a déjà fait un appel à la fonction mysqli_fetch_assoc
							echo "<td>".$ret['cote']."</td>";
							echo "<td>".$ret['TypeOeuvre']."</td>";

							$resul="SELECT NumExmp FROM exemplaire WHERE cote=".$ret['cote']." AND EtatExmp=0";
							$result=$mysqli->query($resul) or die();
							$rows= mysqli_num_rows($result);
											if($rows>0){
											echo "<td>Disponible à la bibliothèque </td>";
										}else if($rows==0 && isset($_SESSION['username'])){

													$resul="SELECT * FROM adherent WHERE username='".$_SESSION['username']."' ";// SAvoir l'idde l'adheretn'
													$result=$mysqli->query($resul) or die();
													$tab=mysqli_fetch_array($result);
													$_SESSION['IdAdherentTmp']=$tab['IdAdherent'];


													$resul="SELECT IdAdherent FROM reserve WHERE cote=".$ret['cote']." ";// SAvoir le nombre de reservation
													$result=$mysqli->query($resul) or die();
													$rows= mysqli_num_rows($result);

													$resul="SELECT * FROM exemplaire WHERE cote=".$ret['cote']." ";// SAvoir le nombre d'exemplaire
													$result=$mysqli->query($resul) or die();
													$rows2= mysqli_num_rows($result);

													$resul="SELECT *  FROM reserve  WHERE cote=".$ret['cote']." AND IdAdherent=".$_SESSION['IdAdherentTmp']." ";
													$result=$mysqli->query($resul) or die();
													$retReservation=mysqli_num_rows($result);		//Verfier que l'adherent n'a pas deja reservé le livre

													$resul="SELECT *  FROM exemplaire  WHERE IdAdherent=".$_SESSION['IdAdherentTmp']." ";
													$result=$mysqli->query($resul) or die();
													$retemprunt=mysqli_num_rows($result);	 // VERfFIER QUE L'ADHERENT A DEJE EMPRUNTE LE LIVRE

												if(($rows == $rows2  && $retReservation==0) || $retemprunt>0){
														$resul="SELECT MIN(DateRetour) as DateRetour1 FROM exemplaire WHERE DateRetour IS NOT NULL AND cote=".$ret['cote']." ";// SAvoir le nombre d'exemplaire
														$result=$mysqli->query($resul) or die();
														$ret2=mysqli_fetch_assoc($result);																// Obtenir la date de prolongement
														echo "<td> Retour prévu le : ".$ret2['DateRetour1']." </td>";

													}else if($retReservation>0 ){
														echo"<td> Le livre est reservé </td>";
													}else{
														if(isset($_SESSION['username'])){
															$listeAReserver[$indice]=$ret['cote'];
															echo '<form method="POST" action="AjoutReservation.php">';
															echo '<input type="hidden" name="namReserved" value='.$listeAReserver[$indice].'>';
															echo '<td> <input type="submit" name="ginger" value="Reservez" autofocus> </input> </td>';
															echo '</form>';
															$_SESSION['IdAdherent']=$_SESSION['IdAdherentTmp'];
															$indice++;
														}

													}

												}
												else {
														echo"<td> Connectez-vous pour réserver le livre </td>";
													}
											}


							//------------------------AFFICHE LA LISTE DE TOUS LES LIVRES ------------------------------------------
							while($ret=mysqli_fetch_assoc($res2)){
								echo"<tr>";
								echo "<td>".$ret['titre']."</td>";
								echo "<td>".$ret['cote']."</td>";
								echo "<td>".$ret['TypeOeuvre']."</td>";

								$resul="SELECT NumExmp FROM exemplaire WHERE cote=".$ret['cote']." AND EtatExmp=0 ";
								$result=$mysqli->query($resul) or die();
								$rows= mysqli_num_rows($result);
								if($rows > 0){
									echo "<td>Disponible à la bibliothèque </td>";
								}else if($rows==0){

											$resul="SELECT IdAdherent FROM reserve WHERE cote=".$ret['cote']." ";// SAvoir le nombre de reservation
											$result=$mysqli->query($resul) or die();
											$rows= mysqli_num_rows($result);

											$resul="SELECT NumExmp FROM exemplaire WHERE cote=".$ret['cote']." ";// SAvoir le nombre d'exemplaire
											$result=$mysqli->query($resul) or die();
											$rows2= mysqli_num_rows($result);


											$resul="SELECT *  FROM reserve  WHERE cote=".$ret['cote']." AND IdAdherent=".$_SESSION['IdAdherent']." ";
											$result=$mysqli->query($resul) or die();
											$ret4=mysqli_num_rows($result);		//Verfier que l'adherent n'a pas deja reservé le livre

											if($rows == $rows2  && $ret4==0){
												$resul="SELECT MIN(DateRetour) as DateRetour1 FROM exemplaire WHERE DateRetour IS NOT NULL AND cote=".$ret['cote']." ";// SAvoir le nombre d'exemplaire
												$result=$mysqli->query($resul) or die();
												$ret2=mysqli_fetch_assoc($result);																// Obtenir la date de prolongement
												echo "<td> Retour prévu le : ".$ret2['DateRetour1']." </td>";

											}
											if($ret4>0){
												echo"<td> Le livre est reservé </td>";
											}else{
												if(isset($_SESSION['username'])){
													$listeAReserver[$indice]=$ret['cote'];
													echo '<form method=get action="AjoutReservation.php">';
													echo '<input type="hidden" name="namReserved" value='.$listeAReserver[$indice].'>';
													echo '<td> <input type="submit" name="ginger" value="Reservez" autofocus>  </input> </td>';
													echo '</form>';
													$indice++;

												}
											else {
													echo"<td> Connectez-vous pour réserver le livre </td>";
											}

										}
							}
						}

							echo"</table>";
							echo "</div>";

							echo "<div id=toutEnBas >";
							for($i=1;$i<=$nbrePage;$i++){ // Pour faire les pages
							if($i==$cPage){
											echo  "$i"  ;
								}else {
										echo " <a href=\"documentationSearch.php?p=$i\"> $i </a>/";
									}
							echo "</div>";
							}


							?>
		</div>
	</div>
	</div>
</body>
</html>
