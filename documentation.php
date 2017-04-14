<?php
session_start();
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

					<div position: fixed>
					  <form class="form-search" name="search_form" method="post" id="searchform" action="documentation.php">
  	         <input type="search" pattern="[a-z]*"" value="" placeholder="Nom d'une oeuvre..." name="s" id="seaRch" />
  	          <input class="btn" type="submit" name="submit" id="searchsubmit" value="Trouver"/>
            </form>
					</div>


					<div class=centre >
					<?php

					/*if($_POST['s']==""){
						$afficheAucun=1;
						unset($_POST['s']);
					}*/
			/*		$resultat="SELECT COUNT(*) as nbreOeuvre FROM Oeuvre" ;
					$res = $mysqli->query($resultat) or die();
					$data=mysqli_fetch_assoc($res);
					$nbOeuvre=$data['nbreOeuvre'];*/

				//		echo "<p>".$nbOeuvre." </p>"; // FONCTIONNE

					$perPage=2; // nombre d'article par page
					//$cPage=1; // numero de la page courante




					if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<$nbPage){
						$cPage=$_GET['p'];
					}else {
						$cPage=1;
					}
					// Ajouter IdAuteur pour montrer les auteurs

					$resultat2="SELECT  titreOeuvre, Cote , TypeOeuvre FROM Oeuvre as OeuvreIdMot WHERE OeuvreIdMot.cote IN( SELECT cote FROM appartient as TablAp WHERE TablAp.id_Mot IN ( SELECT IdMOTclefs.id_Mot FROM mot_clefs as IdMOTclefs WHERE nom like '%".$_POST['s']."%')) LIMIT ".(($cPage-1)*$perPage).",".$perPage.";";
					$res2 = $mysqli->query($resultat2) or die();
					$ret=mysqli_fetch_assoc($res2);
					if(isset($ret)){

						/*Rajouter le fait de mettre une phrase*/
						echo "<p> Oeuvre trouvée </p>";

						echo"<table>";
						echo"<tr>";
						echo " <th> Titre </th>";
						echo " <th> ISBN </th>";
						echo " <th> Genre </th>";
						echo"</tr>";
						$nbreOeuvre2=0;
						while($ret=mysqli_fetch_assoc($res2)){
							echo"<tr>";
							echo "<td>".$ret['titreOeuvre']."</td>";
							echo "<td>".$ret['Cote']."</td>";
							echo "<td>".$ret['TypeOeuvre']."</td>";
							echo"</tr>";
							$nbreOeuvre2++;
						}
						echo"</table>";

						echo "</div>";
					}else {
						echo "<p> Aucun résultats ne correspond à votre recherche </p>";
					}
						?>
			</div>
			<?php

			echo "<div id=toutEnBas >";
			for($i=1;$i<$nbreOeuvre2;$i++){ // Pour faire les pages
			 if	($i==1){
						echo "";
				}else if($i==$cPage){
							echo " $i /" ;
				}else {
						echo " <a href=\"documentation.php?p=$i\">$i</a> /";
					}
				}
				echo "</div>";
		 ?>

		</div>
	</div>
</body>
</html>
