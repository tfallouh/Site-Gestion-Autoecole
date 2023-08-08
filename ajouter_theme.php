<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <h1> Ajouter un thème : </h1>
    <h2> Ajout du thème </h2>
        
     <?php
      $dbhost = 'tuxa.sme.utc';         //ID UTC
      $dbuser = 'nf92p043';
      $dbpass = 'INe0Tr7gniKi';
      $dbname = 'nf92p043';
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Erreur de connexion au serveur");

      date_default_timezone_set('Europe/Paris');
      $date = date("Y\-m\-d");

      //transmission des données du formulaire
      $nom = $_POST['nom'];
      $description = $_POST['descriptif'];
    
      //vérification de la saisie des données
      if(empty($nom) || empty($description)){
        echo "<p>Un champ est vide</p>";
        echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
        echo "<input type='button' onclick=\"window.location='ajout_theme.html'\" value='Enregistrer un autre thème' />";
        exit;
      }
    
      $verif1 = "SELECT * FROM themes WHERE nom = '$nom' and supprime = '0'";
      $result1 = mysqli_query($connect, $verif1);
    
      $verif2 = "SELECT * FROM themes WHERE nom = '$nom' and supprime = '1'";
      $result2 = mysqli_query($connect, $verif2);
    
      if (!$result1){
        echo "<p>La requête 1 n'a pas pu aboutir</p>".mysqli_error($connect);
        exit;
      }
    
      if (!$result2){
        echo "<p>La requête 2 n'a pas pu aboutir</p>".mysqli_error($connect);
        exit;
      }
    
      // Le thème existe déjà dans les thèmes actifs
      if (mysqli_num_rows($result1) > 0)  {
        echo "<p>Le thème $nom existe déjà, vous ne pouvez pas le rajouter.</p>";
        }
    
      else{ //le thème n'est pas dans les thèmes actifs
        if (mysqli_num_rows($result2) > 0)  { //le thème est dans les thèmes désactivés
          echo "<p>Le thème $nom existait et a été supprimé, il va être réactualisé.</p>";
          $query3 = "UPDATE themes SET supprime = '0' where nom = '$nom'";
          $result3 = mysqli_query($connect, $query3);
    
          if (!$result3){
            echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
          }
        }
        else{ //le thème n'est ni dans les thèmes actifs ni dans les thèmes désactivés
          $query = "INSERT INTO themes VALUES (NULL,'$nom', '0', '$description')";
          $result = mysqli_query($connect, $query);
          if (!$result){
            echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
          }
          else{
            echo "<p>Le thème '$nom' a bien été rajouté.</p>";
          }
        }
      }
    
      //boutons pour naviguer entre les pages
      echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
      echo "<input type='button' onclick=\"window.location='ajout_theme.html'\" value='Enregistrer un autre thème' />";
    
      mysqli_close($connect);
      ?>
</body>
</html>