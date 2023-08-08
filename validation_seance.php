<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inscription d'un élève</title>
</head>
<body>
  <h1>Sélectionner une séance à noter</h1>

    <?php

    date_default_timezone_set('Europe/Paris');
    $date = date("Ymd");


    $dbhost = 'tuxa.sme.utc';         //ID UTC
    $dbuser = 'nf92p043';
    $dbpass = 'INe0Tr7gniKi';
    $dbname = 'nf92p043';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, 'utf8');


    $lseances = mysqli_query($connect,"SELECT * FROM seances WHERE DateSeance<$date"); 

    if(!$lseances)

    {
    echo "<br> Erreur :".mysqli_error($connect);
    }
    else
    {
  
      echo "<table>";
      echo "<FORM METHOD='POST' ACTION='valider_seance.php' >";
      echo "<tr><td>Choisissez la séance :</td><td><select name='seance' BORDER='1'>";

      while ($seance = mysqli_fetch_array($lseances, MYSQLI_NUM))

        {
        echo "<option value='$seance[0]'>Séance du $seance[1]</option>";
        }

        echo "</select></td></tr>";
        echo "<tr><td><br><INPUT type='submit' value='Valider'></td></tr>";
        echo "</FORM>";
        echo "</table>";
        }
        ?>
</body>
</html>






