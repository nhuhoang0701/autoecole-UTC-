<?php
// Connecter à la base de donnée
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');

// Déinscrire les élèves de certaine séance
$ideleve = mysqli_real_escape_string($connect,$_POST['ideleve']);
$idseance = mysqli_real_escape_string($connect,$_POST['idseance']);
$result = mysqli_query($connect,"DELETE FROM inscription WHERE (ideleve='$ideleve' AND idseance='$idseance')");
echo "Cet eleve est desincrit";
mysqli_close($connect);
?>
