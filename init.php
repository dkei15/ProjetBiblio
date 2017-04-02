<!DOCTYPE html>
<html lang="fr">

<HEAD>
  <meta charset="UTF-8">
<TITLE>Connexion avec la BDD</TITLE>
</HEAD>
<BODY>
<CENTER><H1>Page perso  </H1></CENTER>
<BR>
<p>On commence la connexion avec la base de donnée</p>
<p>
<?php
// Connexion à la base donnée et affiche si elle a réussi ou pas
// IL FAUDRA PAR LA SUITE POUR CHAQUE REQUETE , UTILISER MYSQLI
$mysqli = new mysqli($_SERVER['dbHost'],$_SERVER['dbLogin'],$_SERVER['dbPass'], $_SERVER['dbBd']);
if ($mysqli->connect_errno) {
    echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";

?>
</p>

<?php

// on crée la requête SQL
$req = 'SELECT count(*) as NbreOeuvre FROM oeuvre ';

// on envoie la requête
$res = $mysqli->query($req) or die();
$ret=mysqli_fetch_assoc($res);
/*
if(isset($_GET['p']) && ($_GET['p'] > 0) && ($_GET['p']<=5)){
    $cPage= $_GET['p'];
}
else {
  $cPage=1;
}A METTRE POUR L'ORDI DE KHADIJA */



$nbreOeuvres = $ret['NbreOeuvre']; // 4
echo  $nbreOeuvres;
$perPage=1; // Nombre de lien par page //1
echo  $perPage ;
echo  $nbreOeuvres;
echo  $perPage ;
$nbPage = $nbOeuvres;

echo $nbPage+4; //GROS PROBLEME je comprends pas

$cPage=1; //page courante

/*
$sql="SELECT cote titre TypeOeuvre FROM oeuvre ORDER BY date DESC LIMIT ".(($cpage-1)*$perPage).",$perPage ";
$res = $mysqli->query($req) or die();
*/




echo "<p>On a des résultats</p>";
$var=($_GET['p']-1)*2;
$sql = "SELECT titre, cote, TypeOeuvre  FROM oeuvre  LIMIT ".$var.",2";
$res = $mysqli->query($sql) or die();
while($ret=mysqli_fetch_assoc($res)){
  echo " <h1>{$ret['titre']}</h1>";
  echo $ret['cote'];
  echo $ret['TypeOeuvre'];
  echo "</br>";
}




for($i=1;$i<=5;$i++){ // Pour faire les pages
  if($i==$_GET['p']){
    echo " $i /" ;
  }else {
    echo " <a href=\"init.php?p=$i\">$i</a> /";
  }
}

?>
</BODY>

</HTML>
