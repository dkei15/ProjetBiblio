<html>
	<head>
		<meta charset="UTF-8">
		<title>Contactez-Nous</title>
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
				<a href="index.php" id="logo"><img src="images/logo.jpg" width= "250" height = "150"  alt="LOGO"></a>

				<ul id="navigation">
					<li class="selected">
						<a href="index.php" title="Home"></a>
					</li>
					<li>
						<a href="espace.php">Espace personnel</a>
					</li>
					<li>
						<a href="documentation.php">Gestion des oeuvres</a>
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
							<h1 class ="h1">Gestion des oeuvres</h1>


						</header>

			

						<div id="ajouteOeuvre" align="center">
								<form method="get" action="ajoutSuppr.php" >
									<fieldset >
										<table>
											<legend> Ajouter une oeuvre</legend>

											<tr>
													<td width = "150px" class="text"><b>ISBN :</b> </td>
													<td><input type="text" name="ISBN" autocomplete="off"  class="textInput"></td>
											</tr>
											 <tr>
												<td width = "150px" class="text" ><b>Titre de l'oeuvre :</b> </td>
												<td><input type="text" name="TitreOeuvre" autocomplete="off" class="textInput" ></td>
											</tr>
											<tr>
												<td width = "150px" class="text"><b>Type de l'oeuvre :</b> </td>
												<td>
													<select name="typeOeuvre" class="textInput">
														<option value="Vide"></<option>
														<option value="Rom">Magazine</<option>
														<option value="Socio">DVD</<option>
														<option value="Art">Livre</<option>
														<option value="Art">Périodique</<option>
														<option value="Art">Partitions</<option>
													</select>
											</tr>
											<tr>
											   <td width = "150px" class="text" ><b>Auteur </b></td>
											   <td><input type="text" name="nomAuteur" class="textInput"></td>
												 <td><button id="add">Ajouter un auteur</button></td>
											</tr>
											<tr>
												<td width = "150px" class="text"><b>Date de parution:</b></b></td>
												<td><input type="date" name="dateParu"  class="textInput" value="1989-12-22"></td>
											</tr>
											<tr>
												<td width = "150px" class="text"><b>Prix d'achat:</b></b></td>
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

										</table>
									</fieldset>
									</br>
									<input  type="submit" name="contat_btn"  class="login" align="center" value="Ajouter"/>
									<input type="reset" value="Annuler" class="login" />
									</br></br>
								</form>
					</div>




					<div  align="center">
							<form method="post" action="ajoutSuppr.php" >
								<fieldset >
									<table>
										<legend> Supprimer une oeuvre</legend>

										 <tr>
												 <td width = "150px" class="text"><b>ISBN :</b> </td>
												 <td><input type="text" name="supprOeuvre" class="textInput"></td>
										 </tr>

									</table>
								</fieldset>
								<input  type="submit" name="contat_btn"  class="login" align="right" value="Supprimer"/>
								</br>
								</br></br>
							</form>
				</div>
				</div>


			</div>
		</div>
	</body>
</html>
