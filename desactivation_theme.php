<?php
// Connecter à la base de donnée
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');

// L'affiche html de la formule pour noter l'eleve
echo "<head>
<link rel='stylesheet' type='text/css' href='test____.css'>
<meta charset='utf-8'>
</head>
<form method='POST' action='desactiver_theme.php'>
<table id='table'>
  <tr>
    <th>Index</th>
    <th>Nom</th>
    <th>Description</th>
    <th>#</th>
  </tr>";
$result = mysqli_query($connect,"SELECT nom, descriptif, idtheme FROM themes WHERE supprime=1"); // Les themes disponibles
while($row=mysqli_fetch_array($result,MYSQL_NUM)) {
    echo "<tr><td></td>";
    echo "<td>".$row[0]."</td>"."<td>".$row[1]."</td>"; //Afficher nom et description des thèmes
    echo "<td><input type='checkbox' value='$row[2]' name='idthemes[]'></td>"; // Afficher note s'il est déja noté
    echo"</tr>";
}
echo "</table><input id='submit' style='float:right' type='submit' value='Desactiver'></form>"; // Mettre à jour les notes
mysqli_close($connect);
?>