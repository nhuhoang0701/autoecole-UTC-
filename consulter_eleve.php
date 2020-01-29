<?php
// Connecter à la base de donnée
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');
date_default_timezone_set('Europe/Paris');

// Tableau d'information de l'élève choisie
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
  </tr><tr>";
$ideleve = mysqli_real_escape_string($connect,$_POST['ideleve']);
$result = mysqli_query($connect,"SELECT * FROM eleves WHERE ideleve=$ideleve");
while($row=mysqli_fetch_array($result,MYSQL_NUM)) {
    echo "<td></td><td>".$row[1]."</td>"."<td>".$row[2]."</td>"."<td>".$row[3]."</td>"."<td>".$row[4]."</td></tr>";
}
echo "</table>";
mysqli_close($connect);
?>