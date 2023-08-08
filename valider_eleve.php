<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
            
        $dbhost = 'tuxa.sme.utc';         //ID UTC
        $dbuser = 'nf92p043';
        $dbpass = 'INe0Tr7gniKi';
        $dbname = 'nf92p043';

        date_default_timezone_set('Europe/Paris');
        $date = date("Y\-m\-d");

        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("erreur de connexion au serveur");

        //permet l'utilisation des caractères spéciaux            
        mysqli_set_charset($connect, 'utf8');

        // récupération des informations du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateNaiss = $_POST['dateNaiss'];

        // pas de vérifiaction pour savoir si les données ont été rentrées, elles le sont obligatoirement grâce à ajouter_eleve.php

        // insère l'élève dans la table
        $query = "INSERT INTO eleves VALUES (NULL,'$nom', '$prenom', '$dateNaiss', '$date')";
        $result = mysqli_query($connect, $query);

        if (!$result){
            echo "<p>La requête n'a pas pu aboutir :</p>".mysqli_error($connect);
        }

        else{ 
            echo "<p>L'élève $nom $prenom né(e) le $dateNaiss a bien été ajouté(e).</p>";
        }

        // boutons pour naviguer entre les pages
        echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
        echo "<input type='button' onclick=\"window.location='ajout_eleve.html'\" value='Ajouter un autre élève' />";

        mysqli_close($connect);
    ?>
</body>
</html>