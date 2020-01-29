<?php
// Connecter à la base de donnée
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');
date_default_timezone_set('Europe/Paris');
$date = date("Y-m-d");

// L'affiche html du tableau
echo "<head>
<link rel='stylesheet' type='text/css' href='test____.css'>
<meta charset='utf-8'>
</head>
<table id='table'>
  <tr>
    <th>Index</th>
    <th>Thème</th>
    <th>Description</th>
    <th>Date</th>
  </tr>";
$ideleve = mysqli_real_escape_string($connect,$_POST['ideleve']);
$result = mysqli_query($connect,"SELECT idseance FROM inscription WHERE ideleve=$ideleve");
while($row=mysqli_fetch_array($result,MYSQL_NUM)) { //Obtenir idseance de l'eleve
    $idseance=$row[0];
    $dateSeances = mysqli_query($connect,"SELECT DateSeance FROM seances WHERE idseance=$idseance");
    while($dateSeance=mysqli_fetch_array($dateSeances,MYSQL_NUM)) { //Obtenir de la dateSeance de cette seance 
        if ($dateSeance[0]<$date) {continue;} // Si dateSeance < ajourd'hui, on continue
        else { // Sinon, on prend le résultat
            $idthemes = mysqli_query($connect,"SELECT idtheme FROM seances WHERE idseance=$idseance");
            while($idtheme=mysqli_fetch_array($idthemes,MYSQL_NUM)) {
                $theme = mysqli_query($connect,"SELECT nom,descriptif FROM themes WHERE idtheme=$idtheme[0]");
                while($info = mysqli_fetch_array($theme,MYSQL_NUM)) {
                    echo "<tr><td></td><td>".$info[0]."</td><td>".$info[1]."</td><td>".$dateSeance[0]."</tr>";
                }
            }
        }
    }
}
echo "</table>";
mysqli_close($connect);
?>