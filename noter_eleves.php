<?php
// Connecter à la base de donnée
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');

// Noter les élèves
$notes = $_POST['note'];
$ideleves = $_POST['ideleve'];
$idseance = $_POST['idseance'];
for ($i=0;$i<count($notes);$i++) {
    $query = "UPDATE inscription SET note=$notes[$i] WHERE (ideleve=$ideleves[$i] AND idseance=$idseance)";
    mysqli_query($connect,$query);
    echo "Les eleves sont notes";
}
mysqli_close($connect);
?>