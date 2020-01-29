<?php
// Connecter à la base de donnée
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');
date_default_timezone_set("Europe/Paris");

// Tableau de séance qu'on veut supprimer
echo "<head><link rel='stylesheet' type='text/css' href='theme.css'><meta charset='utf-8'></head>";
echo "<div class='container'>";
echo "<head>
<link rel='stylesheet' type='text/css' href='test____.css'>
<meta charset='utf-8'>
</head>
<table id='table'>
  <tr>
    <th>Index</th>
    <th>Date de seance</th>
    <th>Theme</th>
    <th>Description</th>
    <th>Supprimer</th>
  </tr>";
$idseances = mysqli_query($connect,"SELECT idseance FROM seances WHERE DateSeance>DATE(NOW())");
while($idseance = mysqli_fetch_array($idseances,MYSQL_NUM)) {
  $seance =mysqli_query($connect,"SELECT DateSeance,idtheme FROM seances WHERE idseance='$idseance[0]'");
  $seance =mysqli_fetch_array($seance,MYSQL_NUM);
  $idtheme = $seance[1];
  echo "<tr><td></td>";
  echo "<td>".$seance[0]."</td>";
  $theme = mysqli_query($connect,"SELECT nom,descriptif FROM themes WHERE idtheme='$idtheme'");
  $theme = mysqli_fetch_array($theme,MYSQL_NUM);
  echo "<td>".$theme[0]."</td>"."<td>".$theme[1]."</td>
  <td>
  <form action='supprimer_seance.php' method='POST'>
  <input type='hidden' name='idseance' value='$idseance[0]'>
  <input type='submit' value='supprimer'>
  </form>
  </td></tr>";
}
echo "</table></div>";
mysqli_close($connect);
?>
