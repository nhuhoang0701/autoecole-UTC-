<?php
// Connecter à la base de donnée
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');

// Prendre nom, description de la formule
$nom = mysqli_real_escape_string($connect,$_POST['nom']);
$desc = mysqli_real_escape_string($connect,$_POST['description']);
echo "<head><meta charset='utf-8'></head>";
if (isset($nom) && isset($desc)) {
    $query = "SELECT * FROM themes WHERE nom='$nom' AND descriptif='$desc' AND supprime=0";
    $result = mysqli_query($connect,$query);
    $row = mysqli_fetch_array($result,MYSQL_NUM); // Prendre le résultat qui a les même nom et description et supprimé
    if ($row) { // Vérifier l'existence de cette thème dans le tableau themes
        $query = "UPDATE themes SET supprime=1 WHERE nom='$nom' AND descriptif='$desc' AND supprime=0"; // Réactiver le thème - changer supprime à 1
        mysqli_query($connect,$query);
    } else {
        $query = "INSERT INTO themes VALUES (NULL,'$nom',1,'$desc')"; // Sinon, insérer le nouveau theme  avec supprime égal 1
        $result = mysqli_query($connect,$query);
        if (!$result) die('pas bon!'); else echo "Le thème $nom vient d'être ajouté";
    }
}
mysqli_close($connect);
?>