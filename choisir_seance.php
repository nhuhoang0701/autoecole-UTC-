<?php
// Connecter à la base de donnée
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');
date_default_timezone_set("Europe/Paris");

// La tableau de séance de cet élève
echo "<head><link rel='stylesheet' type='text/css' href='theme.css'><meta charset='utf-8'></head>";
$ideleve = mysqli_real_escape_string($connect,$_POST['ideleve']);
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
    <th>Choix</th>
  </tr>";
$idseances = mysqli_query($connect,"SELECT idseance FROM inscription WHERE ideleve='$ideleve'");
while($idseance = mysqli_fetch_array($idseances,MYSQL_NUM)) {
  $seance =mysqli_query($connect,"SELECT DateSeance,idtheme FROM seances WHERE idseance='$idseance[0]'");
  $seance =mysqli_fetch_array($seance,MYSQL_NUM);
  if($seance[0]<date("Y-m-d")) continue;
  else {
    $idtheme = $seance[1];
    echo "<tr><td></td>";
    echo "<td>".$seance[0]."</td>";
    $theme = mysqli_query($connect,"SELECT nom,descriptif FROM themes WHERE idtheme='$idtheme'");
    $theme = mysqli_fetch_array($theme,MYSQL_NUM);
    echo "<td>".$theme[0]."</td>"."<td>".$theme[1]."</td>
    <td>
    <form action='desinscrire_eleve.php' method='POST'>
    <input type='hidden' name='ideleve' value='$ideleve'>
    <input type='hidden' name='idseance' value='$idseance[0]'>
    <input type='submit' value='Desinscrire'>
    </form>
    </td></tr>";
  }
}
echo "</table></div>";
mysqli_close($connect);
?>
