<?php
// Connecter à la base de donnée
date_default_timezone_set('Europe/Paris');
$date = date("Y-m-d");
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');

// Prendre nom, prenom, date de naissance de la formule
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$dateNaiss = $_POST['dateNaiss'];
$nom = mysqli_real_escape_string($connect,$nom);
$prenom = mysqli_real_escape_string($connect,$prenom);
$dateNaiss = mysqli_real_escape_string($connect,$dateNaiss);

// L'affichage html du résult
echo "<head><meta charset='utf-8'></head>";
if (isset($nom) && isset($prenom) && isset($dateNaiss)) {
    $query = "INSERT INTO eleves VALUES (NULL, '$nom', '$prenom', '$dateNaiss',"."'$date'".")";
    $sub_query = "SELECT * FROM eleves WHERE nom = '$nom' AND prenom = '$prenom'";
    $check = mysqli_query($connect,$sub_query);
    // Vérifier l'ajoute de l'eleve s'il déjà existe
    if ($check->num_rows) { 
        echo "<form action='valider_eleve.php' method='POST'>
        Ces nom et prénom déjà existent. Voulez-vous encore l'ajouter?
        <input type='radio' name='valide' value=1>oui
        <input type='radio' name='valide' value=0>non
        <input type='hidden' name='nom' value='$nom'>
        <input type='hidden' name='prenom' value='$prenom'>
        <input type='hidden' name='dateNaiss' value='$dateNaiss'>
        <br> <input type='submit' value='Valide'>";
    } else {
        $result = mysqli_query($connect,$query);
        echo "L'élève $nom $prenom né à $dateNaiss est ajouté";
        if (!$result) echo "<br>pas bon".mysqli_error($connect);
    }
} else die('You didn\'t fill all the blanks');
mysqli_close($connect);
?>