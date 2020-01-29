<?php
// Connecter à la base de donnée
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');

// Ajouter ideleve et idseance au tableau inscription
echo "<head><meta charset='utf-8'></head>";
$ideleve = mysqli_real_escape_string($connect,$_POST['ideleve']);
$idseance = mysqli_real_escape_string($connect,$_POST['idseance']);
$query_c = "SELECT * FROM inscription WHERE ideleve = $ideleve AND idseance=$idseance";
$result_c = mysqli_query($connect,$query_c);
if ($result_c->num_rows) { echo "Cet élève a inscrit dans cette séance";}
else {
    $result = mysqli_query($connect,"INSERT INTO inscription VALUES('$idseance','$ideleve',NULL)");
    echo "Cet élève est inscrit dans cette séance";
}
mysqli_close($connect);
?>