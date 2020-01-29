<?php
// Connecter à la base de donnée
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');
date_default_timezone_set('Europe/Paris');

// L'affiche html de la formule
echo "<head>
<link rel='stylesheet' type='text/css' href='test____.css'>
<meta charset='utf-8'>
</head>
<table id='table'>
  <tr>
    <th>Index</th>
    <th>Date de séance</th>
    <th>Thème</th>
    <th>Description</th>
    <th>Noter</th>
  </tr>";
$result = mysqli_query($connect,"SELECT * FROM seances WHERE DateSeance<DATE(NOW())");
while($row=mysqli_fetch_array($result,MYSQL_NUM)) {
    $idseance = $row[0]; $ideleve= $row[1];
    echo "<tr><td></td>";
    $seance = mysqli_query($connect,"SELECT DateSeance,idtheme,idseance FROM seances WHERE idseance=$idseance");
    $temp = mysqli_fetch_array($seance,MYSQL_NUM);
    echo "<td>".$temp[0]."</td>";
    $theme = mysqli_query($connect,"SELECT nom,descriptif FROM themes WHERE idtheme=$temp[1]");
    $temp2 = mysqli_fetch_array($theme,MYSQL_NUM);
    echo "<td>".$temp2[0]."</td><td>".$temp2[1]."</td>";
    echo "<form method='POST' action='valider_seance.php'>";
    echo "<td><input type='hidden' name ='idseance' value='$temp[2]'><input id='submit' type='submit' value='noter' style='background-color:green;'></td></form>";
    echo"</tr>";
}
echo "</table>";
mysqli_close($connect);
?>