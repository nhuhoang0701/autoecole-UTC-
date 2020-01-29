<?php
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a100';
$dbpass = '6eTmrRXg';
$dbname = 'nf92a100';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error connecting to mysql');

//Fonction affiche par theme
function statistique_par_theme($connect, $ideleve) {
    $query = "SELECT themes.nom, themes.descriptif, COUNT(*), ROUND(AVG((40 - note)/40.0*100), 2)
                FROM themes, inscription, eleves, seances
                WHERE inscription.ideleve=eleves.ideleve
                AND   inscription.idseance=seances.idseance
                AND   seances.idtheme=themes.idtheme
                AND   eleves.ideleve=$ideleve
                AND   seances.DateSeance < CURDATE()
                AND   inscription.note>=0
                GROUP BY inscription.idseance";
    $result = mysqli_query($connect, $query);
    $eleve_info = mysqli_fetch_array(mysqli_query($connect, "SELECT nom, prenom FROM eleves WHERE ideleve=$ideleve"));
    $nom = $eleve_info['nom'];
    $prenom = $eleve_info['prenom'];
    $count = mysqli_num_rows($result);
    echo "<div>";
    echo "<h1>Élèves $nom $prenom</h1>";
    echo "<div>";
    echo "<table id='table'>";
    echo "<thead>
            <tr>
            <th>Index</th>
            <th>Thème</th>
            <th>Description</th>
            <th>Nombre des séances notées</th>
            <th>Réussite (%)</th>
            </tr>
            </thead>";
    echo "<tbody>";
    $count = 0;
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $count ++;
        echo "<tr><td></td>";
        for ($i = 0; $i < count($row); $i ++) {
            echo "<td>".$row[$i]."</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
}
// Fonction affiche par seance
function statistique_par_seance($connect, $ideleve) {
    $query = "SELECT themes.nom, themes.descriptif, seances.DateSeance, ROUND((40 - inscription.note) / 40 * 100, 2)
                FROM themes, seances, inscription
                WHERE themes.idtheme = seances.idtheme
                AND seances.idseance = inscription.idseance
                AND inscription.ideleve=$ideleve
                AND seances.DateSeance < CURDATE()";
    $result = mysqli_query($connect, $query);
    $eleve_info = mysqli_fetch_array(mysqli_query($connect, "SELECT nom, prenom FROM eleves WHERE ideleve=$ideleve"));
    $nom = $eleve_info['nom'];
    $prenom = $eleve_info['prenom'];
    $count = mysqli_num_rows($result);
    echo "<div>";
    echo "<h1>Élève $nom $prenom</h1>";
    echo "<div>";
    echo "<table id='table'>";
    echo "<thead>
            <tr>
            <th>Index</th>
            <th>Thème</th>
            <th>Description</th>
            <th>Date de séance</th>
            <th>Réussite (%)</th>
            </tr>
            </thead>";
    echo "<tbody>";
    $count = 0;
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $count ++;
        echo "<tr><td></td>";
        for ($i = 0; $i < count($row) - 1; $i ++) {
            echo "<td>".$row[$i]."</td>";
        }
        echo "<td>".($row[count($row) - 1]<=100?$row[count($row) - 1]:"Indisponible")."</td>";
        echo "</tr>";
    }
    echo "</tbody>";

    echo "</table>";
    echo "</div>";
    echo "</div>";
}

//Tableau
echo "<head>
        <meta charset='utf-8'/>
        <link rel='stylesheet' type='text/css' href='test____.css'>
    </head>";
date_default_timezone_set('Europe/Paris');
if ((empty($_POST['ideleve'])) && (empty($_POST['mode']))) {
    // Teableau de l'eleve
    $query = "SELECT ideleve, nom, prenom, dateNaiss FROM eleves";
    $result = mysqli_query($connect, $query);
    echo "<div>";
    echo "<h1>Choisir un élève pour le statistique</h1>";
    echo "<form action='statistique_eleve.php' method='POST'>";
    echo "<div>";
    echo "<table id='table'>";
    echo "<thead'>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Choix</th>
            </tr>
        </thead>";
    echo "<tbody>";
    $count = 0;
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $count ++;
        echo "<tr>";
        echo "<td>$row[0]</td>";
        for ($i = 1; $i < count($row); $i ++) {
            echo "<td>".$row[$i]."</td>";
        }
        echo "<td><input type='radio' name='ideleve' value='$row[0]' required></td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "<div>
            <div>
                <input style='float:right;background-color: #4CAF50; border:none; margin-right: 5px;
                color: white; padding: 15px 32px;' type='submit' name = 'mode' value='seance'>
                <input style='float:right;background-color: #4CAF50; border:none; margin-right: 5px;
                color: white; padding: 15px 32px;' type='submit' name = 'mode' value='theme'>
            </div>
        </div>";
    echo "</form>";
    echo "</div>";
} else {
    // Afficher statistique
    $ideleve = $_POST['ideleve'];
    $mode = $_POST['mode'];
    if ($mode == "theme") {
        statistique_par_theme($connect, $ideleve);
    } else {
        statistique_par_seance($connect, $ideleve);
    }
}
?>
