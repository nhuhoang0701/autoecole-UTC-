<?php
// Connecter à la base de donnée
date_default_timezone_set('Europe/Paris');
$date = date("Y-m-d");
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');

// Valider l'existence de l'élève
echo "<head><meta charset='utf-8'></head>";
$valide = $_POST['valide'];
$nom = mysqli_real_escape_string($connect,$_POST['nom']);
$prenom = mysqli_real_escape_string($connect,$_POST['prenom']);
$dateNaiss = mysqli_real_escape_string($connect,$_POST['dateNaiss']);
if (!$valide) {
    echo "Vous venez de refuser ajouter cet eleve";
} else {
    $query = "INSERT INTO eleves VALUES (NULL, '$nom', '$prenom', '$dateNaiss',"."'$date'".")";
    $result = mysqli_query($connect,$query);
    echo "L'élève $nom $prenom né à $dateNaiss est ajouté";
}
mysqli_close($connect);
?>