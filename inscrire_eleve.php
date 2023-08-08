<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscrire eleve</title>
</head>
<body>
      <?php
        $dbhost = 'tuxa.sme.utc';        //ID UTC
        $dbuser = 'nf92p043';
        $dbpass = 'INe0Tr7gniKi';
        $dbname = 'nf92p043';
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

      // Vérifier si l'élève n'est pas déjà inscrit à la séance !
      $note = isset($_POST['note']) ? $_POST['note'] : -1;
      $query = 'SELECT * FROM inscription WHERE idseance = "'.$_POST['idseance'].'" and ideleve = "'.$_POST['eleve'].'"';
      $verif = mysqli_query($connect, $query);
      if (!empty(mysqli_fetch_array($verif))) {
        echo <<< html
        <link href="style.css" rel="stylesheet">
        <br>
        <i class="bi bi-exclamation-triangle-fill"></i>
        <p> L'élève est déjà inscrit.e à  cette séance ! </p>
        <table>
          <tr>
            <td>
              <a href="accueil.html" >
              <button type="button" class='button effacer' ><span>Accueil</span></button>
              </a>
            </td>
            <td>
              <a href="inscription_eleve.php" >
              <button type="button" class='button valider' ><span>Recommancer</span></button>
              </a>
            </td>
          </tr>
        <table>
        html;
      }

      // Si non :  inscrire l'élève à la séance
      else { 
        $query = 'insert into inscription values ( "'.$_POST['idseance'].'","'.$_POST['eleve'].'", -1)';
        $result = mysqli_query($connect, $query);
        if (!$result) echo "<br>Erreur: ".mysqli_error($connect);
        else {
          echo <<< html
          <link href="style.css" rel="stylesheet">
          <br>
          <i class="bi bi-check-lg"></i>
          <p> L'élève a été inscrit.e ! </p>
          <table>
            <tr>
              <td>
                <a href="accueil.html" >
                <button type="button" class='button effacer' ><span>Accueil</span></button>
                </a>
              </td>
              <td>
                <a href="inscription_eleve.php" >
                <button type="button" class='button valider' ><span>Recommencer</span></button>
                </a>
              </td>
              </tr>
          <table>
          html;
            }
      }
      mysqli_close($connect);

    ?>
    </body>
    </html>