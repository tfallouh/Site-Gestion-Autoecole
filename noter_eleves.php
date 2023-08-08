<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noter élèves</title>
</head>
<body>
    <h1>Noter les élèves</h1></br></br>
        <subtitle>Confirmation de votre ajout :</subtitle></br></br>

            <?php

            date_default_timezone_set('Europe/Paris');
            $date = date("Ymd");

            $dbhost = 'tuxa.sme.utc';
            $dbuser = 'nf92p043';
            $dbpass = 'INe0Tr7gniKi';
            $dbname = 'nf92p043';
            $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
            mysqli_set_charset($connect, 'utf8'); 
            
            $seance = $_POST['hidn'];

            $id_eleve_search = mysqli_query($connect,"SELECT * FROM inscription WHERE idseance = $seance");
            while ($id_eleve = mysqli_fetch_array($id_eleve_search, MYSQLI_NUM))
            {
            $etu = $id_eleve[1];      
            $erreur = $_POST[$etu];

            $note = 40 - $erreur;
            if ($erreur <= 40 && $erreur >= 0) 
            {
            $changer_note = mysqli_query($connect,"UPDATE `inscription` SET note = $note WHERE ideleve = $id_eleve[1] and idseance = $seance;"); 
            if(!$changer_note)
            {
                echo "<br> Erreur :".mysqli_error($connect);
            }
            }

            else
                echo "Vous avez spécifié un nombre d'erreurs supérieur à 40 ou inférieur à 0. Les notes de ces élèves ne seront pas changées."; 
            }

                echo "<table>";

            $confirmation = mysqli_query($connect,"SELECT * FROM inscription WHERE idseance = $seance");
            while ($confirmer = mysqli_fetch_array($confirmation, MYSQLI_NUM))
            {
            $id_own_etu = $confirmer[1];
            $nom_etudiant_query = mysqli_query($connect,"SELECT * FROM eleves WHERE ideleve = $id_own_etu"); 
            $nom_etudiant = mysqli_fetch_array($nom_etudiant_query, MYSQLI_NUM);
            if ($confirmer[2] == -1) 
            {
                echo "<br><tr><td>".$nom_etudiant[1]." ".$nom_etudiant[2]." : </td><td>Non noté</td></tr>";
            }
            else 
            {
                echo "<br><tr><td>".$nom_etudiant[1]." ".$nom_etudiant[2]." : </td><td>".$confirmer[2]." points sur 40</td></tr>";
            }
            }
                echo "</table>";
            mysqli_close($connect);

            ?>
</body>
</html>