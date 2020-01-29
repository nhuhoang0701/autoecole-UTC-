<?php
// Connecter à la base de donnée
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');

// L'affiche html de l'inscription
echo "<head><link rel='stylesheet' type='text/css' href='theme.css'><meta charset='utf-8'></head>";
echo "<div class='container'><form action='inscrire_eleve.php' method='POST'>
<div class='row'><label class='col-25'>Choissisez un élève:</label><select class='col-75' name='ideleve' size='8' required>";
$result = mysqli_query($connect,"SELECT * FROM eleves");
while($row = mysqli_fetch_array($result,MYSQL_NUM)) {
    echo "<option value='$row[0]'>" . $row[1] . ' ' . $row[2] . "</option>";
}
echo "</select></div>";
echo "<div class='row'><label class='col-25'>Choissisez une séance:</label><select class='col-75' name='idseance' size='8' required>";
$result = mysqli_query($connect,"SELECT * FROM seances");
while($row = mysqli_fetch_array($result,MYSQL_NUM)) {
    echo "<option value='$row[0]'>$row[1]</option>";
}
echo "</select></div><br><input type='submit' value='enregistrer l'inscription'></form></div>";
mysqli_close($connect);
?>