<?php
// Connecter à la base de donnée
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');
$idseance = mysqli_real_escape_string($connect,$_POST['idseance']);

// Supprimer la séance dans les tableau inscription et seances
$suppression_ins = mysqli_query($connect,"DELETE FROM inscription WHERE idseance=$idseance");
$suppression_sea = mysqli_query($connect,"DELETE FROM seances WHERE idseance=$idseance");
echo "La seance est supprime et les eleves sont desinscrit";
mysqli_close($connect);
?>
