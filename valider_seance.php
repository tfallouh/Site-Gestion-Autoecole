<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Noter élèves</title>
</head>
<body>
 <h1>Entrez les notes des élèves</h1>

      <?php

      $seance_selected = $_POST['seance'];

      date_default_timezone_set('Europe/Paris');
      $date = date("Ymd");

      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92p043';
      $dbpass = 'INe0Tr7gniKi';
      $dbname = 'nf92p043';
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
      mysqli_set_charset($connect, 'utf8'); 

      $result = mysqli_query($connect,"SELECT * FROM inscription WHERE idseance = $seance_selected"); 

      echo "<FORM METHOD='POST' ACTION='noter_eleves.php' >";
      echo "Notez le nombre d'erreurs faites par chaque élève (champ vide = 0 fautes) : <br>";
      echo "<table>";

      /*if (mysqli_fetch_row($result)==0){
        die("<br>Erreur : Aucun élève n'est inscrit à cette séance");
      } else{  */  
      while ($seances_notables = mysqli_fetch_array($result, MYSQLI_NUM))
      {
      $id_dun_eleve = $seances_notables[1];
      $leleves = mysqli_query($connect,"SELECT * FROM eleves WHERE ideleve = $id_dun_eleve"); 

      $nom_eleve = mysqli_fetch_array($leleves, MYSQLI_NUM);

      echo "<br><tr><td>".$nom_eleve[1]."</td><td>".$nom_eleve[2]." : </td><td><input type='number' name=$nom_eleve[0]></td></tr>"; 
      }
      echo "<input type='hidden' name='hidn' value=".$seance_selected.">";
      echo "</FORM>";
      echo "</table><br>";
      echo "<INPUT type='submit' value='Valider'>";
      // oublie pas } 
      mysqli_close($connect);

      ?>



  </body>
</html>

