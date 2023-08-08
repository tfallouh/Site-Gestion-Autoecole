<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Supprimer un thème</title>
    <link rel="stylesheet" href="projet.css">
  </head>
<body>
  <h1> Supprimer un thème : </h1>
    <h2> Suppression du thème </h2>

      <?php
      
      //connexion à la bas de données
      $dbhost = 'tuxa.sme.utc';         //ID UTC
      $dbuser = 'nf92p043';
      $dbpass = 'INe0Tr7gniKi';
      $dbname = 'nf92p043';
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
      mysqli_set_charset($connect, 'utf8');

      //transmission des données du formulaire
      $idtheme = $_POST["idtheme"];

      //vérification de la saisie des données
      if (empty($idtheme)){
        echo "<p>Il faut séléctionner un thème !</p>";
        echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
        echo "<input type='button' onclick=\"window.location='suppression_theme.php'\" value='Recommencer' />";
        exit;
      }

      //suppression du thème dans la base de données
      $query = "UPDATE themes SET supprime = 1 WHERE idtheme = '$idtheme'";
      $result = mysqli_query($connect, $query);

      if (!$result){
        echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
        exit;
      }
      echo "<p>Le thème a bien été supprimé</p>";

      //boutons pour naviguer entre les pages
      echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
      echo "<input type='button' onclick=\"window.location='suppression_theme.php'\" value='Supprimer un autre thème' />";

      ?>
</body>
</html>