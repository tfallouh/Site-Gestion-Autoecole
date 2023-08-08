<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
</head>
<body>
    <?php
        //Récupération informations sur la séance
        $idtheme = $_POST['menuthemes'];
        $DateSeance = $_POST['DateSeance'];
        date_default_timezone_set('Europe/Paris');
        $date = date("Y\-m\-d");

        //Vérification séance 
        if (($DateSeance)<($date))
            die('Impossible de créer une séance dans le passé'); 
        if (empty($idtheme) || empty($DateSeance))
          die('Le formulaire est incomplet');
    ?>
    
    Informations de la nouvelle séance : 
    <ul>
      <li>
        <?php
        echo "L'ID du thème est : $idtheme";?>
     </li>
     <li>
        <?php
        echo "La date de la séance est : $DateSeance";?>
     </li> 
    </ul>

    <?php

      date_default_timezone_set('Europe/Paris');
      $date = date("Y-m-d");


      $dbhost = 'tuxa.sme.utc';               //ID UTC
      $dbuser = 'nf92p043';
      $dbpass = 'INe0Tr7gniKi';
      $dbname = 'nf92p043';

      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
      mysqli_set_charset($connect, 'utf8');

      //Insertion des informations dans la BDD
      $query = "insert into seances values (null, '$DateSeance', '10', '$idtheme')";

      $result = mysqli_query($connect, $query);

      if (!$result)
      {
        echo "<br>Erreur de connexion  ".mysqli_error($connect);
      }
      mysqli_close($connect);

    ?>
</body>
</html>

