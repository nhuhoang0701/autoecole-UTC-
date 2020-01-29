<?php
// Connecter à la base de donnée
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');

// L'affiche la liste du thème
$result = mysqli_query($connect,"SELECT * FROM themes");
echo "<head><meta charset='utf-8'><link rel='stylesheet' type='text/css' href='theme.css'></head>";
echo "<div class='container'>";
echo "<h1>Ajouter une séance</h1>";
echo "<form method='POST' action='ajouter_seance.php'>";
echo "<div class='row'><label class='col-25'>Choisir le thème</label>";
echo "<select class='col-75' name='menuChoixTheme' size='4' required>";
$rows = mysqli_num_rows($result);
for ($i=0;$i<$rows;$i++) {
    $row = mysqli_fetch_array($result,MYSQL_NUM);
    if ($row[2]!=0) {
        echo "<option value='$row[0]'>$row[1]</option>";
    }
}
echo "</select></div><br>";

// L'affiche l'entrée de donnée de l'effectif maximum et la date de séance
echo "<div class='row'><label class='col-25'>L'effectif maximum de cette séance:</label> " . "<div class='col-75'><input type='number' name='EffMax' style='width:145px' required></div>"."</div>";
echo "<div class='row'><label class='col-25'>La date de la séance:</label> " . "<div class='col-75'><input type='date' name='DateSeance' required></div>"."</div"; 
echo "<div class='row'><input type='submit' value ='Enregistrer séance'></div>";
echo "</form>";
echo "</div>";
mysqli_close($connect);
?>