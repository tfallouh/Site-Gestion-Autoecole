<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>calendrier élève</title>
</head>
<body>
	<h1>Visualiser le calendrier d'un élève</h1></br>

	<?php

        $dbhost = 'tuxa.sme.utc';         //ID UTC
        $dbuser = 'nf92p043';
        $dbpass = 'INe0Tr7gniKi';
        $dbname = 'nf92p043';

        date_default_timezone_set('Europe/Paris');
        $date = date("Y\-m\-d");
        echo "<br> la date est : "."'$date'"." <br>";

        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("erreur de connexion au serveur");

        //permet l'utilisation des caractères spéciaux            
        mysqli_set_charset($connect, 'utf8');


        //transmission des données du formulaire
        $ideleve = $_POST["ideleve"];

        //vérification des données
        if (empty($ideleve)){
            echo "<p>Il faut sélectionner un élève !</p>";
            echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
            echo "<input type='button' onclick=\"window.location='visualisation_calendrier_eleve.php'\" value='Visualiser un calendrier' />";
            exit;
        }

        //sélection des inscriptions de l'élève dans le futur
        $query = "SELECT * FROM inscription INNER JOIN seances ON seances.idseance=inscription.idseance INNER JOIN themes ON seances.Idtheme=themes.idtheme WHERE DATEDIFF( `DateSeance` , '$date' )>=0 AND ideleve=$ideleve";
        $result = mysqli_query($connect, $query);

        if (!$result){
            echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
            echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
            echo "<input type='button' onclick=\"window.location='visualisation_calendrier_eleve.php'\" value='Visualiser un calendrier' />";
        exit;
        }

        if (mysqli_num_rows($result)==0){ // il n'y a pas d'inscription dans le futur
            echo"<p>L'élève n'est inscrit à aucune séance dans le futur</p>";
        }
        else{ // il y a des séances dans le futur
            //renvoie une table qui rassemble les informations des séances
            echo "<table class='table'>";
            echo "<tr><th>Thème de la séance</th> <th>Date de la séance</th></tr>";
            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
            echo "<tr>";
            echo "<td>$row[8]</td>";
            echo "<td>$row[4]</td>";
            echo "</tr>";
            }
        echo "</table>";
        }

        // boutons pour naviguer entre les tables
        echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
        echo "<input type='button' onclick=\"window.location='visualisation_calendrier_eleve.php'\" value='Visualiser un calendrier' />";

        mysqli_close($connect);
        ?>
</body>
</html>