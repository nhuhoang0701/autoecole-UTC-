<?php
// Connecter à la base de donnée
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');
date_default_timezone_set('Europe/Paris');

// Tableau des élève
echo "<head>
<link rel='stylesheet' type='text/css' href='test____.css'>
<meta charset='utf-8'>
</head>
<table id='table'>
  <tr>
    <th>Index</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Date de naissance</th>
    <th>Date d'inscription</th>
    <th>Voir</th>
  </tr><tr>";
$result = mysqli_query($connect,"SELECT * FROM eleves");
while($row=mysqli_fetch_array($result,MYSQL_NUM)) {
    echo "<td></td>";
    echo "<td>".$row[1]."</td>"."<td>".$row[2]."</td>"."<td>".$row[3]."</td>"."<td>".$row[4]."</td>";
    echo "<form method='POST' action='visualiser_calendrier_eleve.php'>";
    echo "<td><input type='hidden' name ='ideleve' value='$row[0]'><input id='submit' type='submit' value='voir'></td></form>";
    echo"</tr>";
}
echo "</table>";
mysqli_close($connect);
?>