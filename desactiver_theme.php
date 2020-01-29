<?php
// Connecter à la base de donnée
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');

// Changer supprime des thèmes actives de 1 à 0
$idthemes = $_POST['idthemes'];
for ($i=0;$i<count($idthemes);$i++) {
    $idtheme = mysqli_real_escape_string($connect,$idthemes[$i]);
    $query = "UPDATE themes SET supprime=0 WHERE idtheme=$idtheme";
    mysqli_query($connect,$query);
    echo "Le theme est desactivé";
}
?>