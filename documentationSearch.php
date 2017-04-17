<?php
session_start();
include 'cookie.php';
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
			<div id="news" position:absolute>
					<?php

					// Connexion à la base donnée et affiche si elle a réussi ou pas
					// IL FAUDRA PAR LA SUITE POUR CHAQUE REQUETE , UTILISER MYSQLI
					$mysqli = new mysqli("localhost","root","","Biblio");
					if ($mysqli->connect_errno) {
							echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
					}


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
					<div position: fixed>
					  <form class="form-search" name="search_form" method="post" id="searchform" action="documentationSearch.php">
  	         <input type="text" value="" placeholder="Nom d'une oeuvre..." name="s" required=on />
  	          <input class="btn" type="submit" name="submit" id="searchsubmit" value="Trouver"/>
            </form>
					</div>


					<div class=centre >
					<?php
					//----------------------------------Condition pour changer de page ou faire une nouvelle recherche -----------------------------------
					$_SESSION['deja']++;
					if($_SESSION['deja']!=1){
						if(isset($_GET['p']) && ($_GET['p']>1 || $_GET['p']==1)){
						}else{
							$_SESSION['recherche']=$_POST['s'];
						}
					}else {
					$_SESSION['recherche']=$_POST['s'];
					}
					$perPage=1; // nombre d'article par page





					//--------------------------DEBUT DE L'ALGORITHME ---------------------------------------------
					$resultat2="SELECT  titreOeuvre, Cote , TypeOeuvre FROM Oeuvre as OeuvreIdMot WHERE OeuvreIdMot.cote IN( SELECT cote FROM appartient as TablAp WHERE TablAp.id_Mot IN ( SELECT IdMOTclefs.id_Mot FROM mot_clefs as IdMOTclefs WHERE nom like '%".$_SESSION['recherche']."%'))";
					$res2 = $mysqli->query($resultat2) or die();		//Envoie de la requête
					$nbreCase= mysqli_num_rows($res2);													//Compte le nombre de lignes lors du retour de la requête

					$nbrePage=ceil($nbreCase/$perPage);

					if(isset($_GET['p'])/* && $_GET['p']>0 /*&& $_GET['p']<$nbPage*/){//On regarde la page courante dans laquelle on se trouve
								$cPage=$_GET['p'];
							}else {
								$cPage=1;
							}
						// Ajouter IdAuteur pour montrer les auteurs
						$debut = (($cPage-1)*$perPage);					// ON calcule à partir de quand on va afficher les résultats
					  $resultat2="SELECT  titreOeuvre, Cote , TypeOeuvre FROM Oeuvre as OeuvreIdMot WHERE OeuvreIdMot.cote IN( SELECT cote FROM appartient as TablAp WHERE TablAp.id_Mot IN ( SELECT IdMOTclefs.id_Mot FROM mot_clefs as IdMOTclefs WHERE nom like '%".$_SESSION['recherche']."%')) LIMIT ".$debut.",".$perPage."";
						$res2 = $mysqli->query($resultat2) or die();		//Envoie de la requête





						$ret=mysqli_fetch_assoc($res2);
						if($nbreCase>0 && isset($ret)){
							//unset($ret);
							/*Rajouter le fait de mettre une phrase*/
							echo "<p> Oeuvre trouvée </p>";	// Affiche le début du tableau
							echo"<table>";
							echo"<tr>";
							echo " <th> Titre </th>";
							echo " <th> ISBN </th>";
							echo " <th> Genre </th>";
							echo " <th>  </th>";
							echo"</tr>";
							$nbreOeuvre2=0;
							echo"<tr>";
						//	echo $ret['titreOeuvre'];
							echo "<td>".$ret['titreOeuvre']."</td>";		// Affiche la première ligne car on a déjà fait un appel à la fonction mysqli_fetch_assoc
							echo "<td>".$ret['Cote']."</td>";
							echo "<td>".$ret['TypeOeuvre']."</td>";
							//echo '<td> <a href="https://github.com/dkei15/ProjetBiblio" target="_blank"><button type="button" autofocus> Reservez </button></a> </td>';
							echo"</tr>";
							//------------------------AFFICHE LA LISTE DE TOUS LES LIVRES ------------------------------------------
							while($ret=mysqli_fetch_assoc($res2)){
								echo"<tr>";
								echo "<td>".$ret['titreOeuvre']."</td>";
								echo "<td>".$ret['Cote']."</td>";
								echo "<td>".$ret['TypeOeuvre']."</td>";
								echo '<td>  <button type="button" autofocus> Reservez </button> </td>';// ICI LE BOUTON POUR RESERVER LE LIVRE (faudra mettre une condition pour savoir si il est dispo ou non à la reservation)
								echo"</tr>";
							}
							echo"</table>";

							echo "</div>";


                //-------------------------------------------Indexe de page ----------------------------------------------------------------------------------
              echo "<div id=toutEnBas >";
              for($i=1;$i<=$nbrePage;$i++){ // Pour faire les pages
              if($i==$cPage){
                      echo  "$i"  ;
                }else {
                    echo " <a href=\"documentationSearch.php?p=$i\"> $i </a>/";
                  }
									echo "</div>";
                }
              }else{
								echo "<p>Aucun résultats n'a été trouvé pour votre recherche.</p>" ;
							}




							?>
		</div>
	</div>
	</div>
</body>
</html>
