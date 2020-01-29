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
<form method='POST' action='noter_eleves.php'>
<table id='table'>
  <tr>
    <th>Index</th>
    <th>Nom</th>
    <th>Prenom</th>
    <th>Date de naissance</th>
    <th>Note</th>
  </tr>";
$idseance = mysqli_real_escape_string($connect,$_POST['idseance']);
$result = mysqli_query($connect,"SELECT ideleve FROM inscription WHERE idseance=$idseance");
while($row=mysqli_fetch_array($result,MYSQL_NUM)) {
    echo "<tr><td></td>";
    $ideleve = $row[0];  // Prendre ideleve
    $eleve = mysqli_query($connect,"SELECT nom,prenom,dateNaiss FROM eleves WHERE ideleve=$ideleve");
    $temp = mysqli_fetch_array($eleve,MYSQL_NUM);
    echo "<td>".$temp[0]."</td>"."<td>".$temp[1]."</td><td>".$temp[2]."</td>"; //Afficher nom, prenom et date de naissance
    $note1 = mysqli_query($connect,"SELECT note FROM inscription WHERE ideleve=$ideleve AND idseance=$idseance");
    $note2 = mysqli_fetch_array($note1,MYSQL_NUM);
    echo "<td><input type='number' value='$note2[0]' name='note[]'></td>"; // Afficher note s'il est déja noté
    echo "<input type='hidden' name='ideleve[]' value='$ideleve'>";
    echo"</tr>";
}
echo "<input type='hidden' name='idseance' value='$idseance'>";
echo "</table><input id='submit' type='submit' value='Mettre à jour les notes'></form>"; // Mettre à jour les notes
mysqli_close($connect);
?>
