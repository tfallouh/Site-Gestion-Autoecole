<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <link href="style.css" rel="stylesheet">
  <meta charset="utf-8">
  <title>Nouvel élève</title>
</head>
<body>
    <h1>Nouvel élève</h1>
        
        <?php
            
            $dbhost = 'tuxa.sme.utc';         //ID UTC
            $dbuser = 'nf92p043';
            $dbpass = 'INe0Tr7gniKi';
            $dbname = 'nf92p043';


            date_default_timezone_set('Europe/Paris');
            $date = date("Y\-m\-d");
            
            $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("erreur de connexion au serveur");
                    
            // récupère les informations du formulaire
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $dateNaiss = $_POST['dateNaiss'];

            //vérification de la saisie des données
            if(empty($nom) || empty($prenom) || empty($dateNaiss)){
                echo "<p>Un champ est vide</p>";
                echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
                echo "<input type='button' onclick=\"window.location='ajout_eleve.html'\" value='AJouter un élève' />";
                exit;
            }

            //vérifie si un élève avec le même nom et prénom est enregistré
            $verif = "SELECT nom, prenom FROM eleves WHERE nom = '$nom' AND prenom = '$prenom'";
            $result1 = mysqli_query($connect, $verif);
            if (!$result1){
                echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
                exit;
            }

            if (mysqli_num_rows($result1) > 0)  {
                // si l'élève existe déjà, génèration d'une table qui récapitule les informations et demande si il veut toujours rajouter cet élève
                echo "<p>L'élève existe déjà, le rajouter quand même ?</p>";
                echo  "<table class='table'>
                    <tr>
                        <th> Nom </th> <th> Prénom </th> <th> Date de Naissance </th>
                    </tr>
                    <tr>
                        <td> <a>$nom</a> </td>
                        <td> <a>$prenom </a></td>
                        <td> <a>$dateNaiss</a> </td>
                    </tr>
                    </table> <br>
                    
                    <form action = 'valider_eleve.php' method = 'post'>
                        <input name='nom' type='hidden' value='$nom'>
                        <input name='prenom' type='hidden' value='$prenom'>
                        <input name='dateNaiss' type='hidden' value='$dateNaiss'>
                        <input type='submit' value='Valider'>
                        <input type='button' onclick=\"window.location='accueil.html'\" value='Ne pas rajouter' />
                    </form>";
            }
            else{  //l'élève n'est pas dans la BDD
                if ($dateNaiss > $date){ // la date de naissance est deans le futur
                    echo "<p>Vous avez saisi une date de naissance dans le futur.</p>";
                    echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
                    echo "<input type='button' onclick=\"window.location='ajout_eleve.html'\" value='AJouter un élève' />";
                exit;
                }
                // insère l'élève dans la BDD
                $query2 = "INSERT INTO eleves VALUES (NULL,"."'$nom'".", "."'$prenom'".", "."'$dateNaiss'".", "."'$date'".")";
                $result2 = mysqli_query($connect, $query2);
                if (!$result2){
                    echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
                exit;
                }
                //indique à l'utilisateur que l'élève a été ajouté
                echo "<p>L'élève $nom $prenom né(e) le $dateNaiss a bien été ajouté.</p>";
                echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
                echo "<input type='button' onclick=\"window.location='ajout_eleve.html'\" value='AJouter un élève' />";
                }

            mysqli_close($connect);
        ?>
</body>
</html>
