<?php
// Connecter à la base de donnée
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');

// Prendre la date de séance, l'effectif maximum et le thème
$DateSeance = mysqli_real_escape_string($connect,$_POST['DateSeance']);
$EffMax = mysqli_real_escape_string($connect,$_POST['EffMax']);
$idtheme = mysqli_real_escape_string($connect,$_POST['menuChoixTheme']);

// Ajouter l'information de la séance
if (isset($DateSeance) && isset($EffMax) && isset($idtheme)) {
    // Vérifier le double de la séance 
    $query_c = "SELECT * FROM seances WHERE  DateSeance = '$DateSeance' AND idtheme = $idtheme"; 
    $result_c = mysqli_query($connect,$query_c);
    $row = mysqli_fetch_assoc($result_c);
    if ($row) {
        echo "Il ne faut pas avoir plusieurs seances avec le meme theme dans un meme jour"; 
    } else {
        // Insérer la séance
        $query = "INSERT INTO seances VALUES(NULL,'$DateSeance','$EffMax','$idtheme')";
        $result = mysqli_query($connect,$query);
        echo "La seance est ajoute";
        if (!$result) die('cannot ...');
    }
} else die('cannot ...');
mysqli_close($connect);
?>