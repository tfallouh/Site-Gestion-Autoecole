<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Désinscription séance</title>
    <link rel="stylesheet" href="projet.css">
  </head>
<body>
  <h1> Désinscrire un élève d'une séance </h1>
    <h2> Sélectionnez la séance à laquelle vous désinscrivez l'élève</h2>
      <?php
      //connexion à la base de données
      $dbhost = 'tuxa.sme.utc';         //ID UTC
      $dbuser = 'nf92p043';
      $dbpass = 'INe0Tr7gniKi';
      $dbname = 'nf92p043';
      
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
      mysqli_set_charset($connect, 'utf8');

      if (isset($_POST['eleve']) and isset($_POST['seance'])) {
        $query = 'delete from inscription where idseance="' . $_POST['seance'] . '" and ideleve = "' . $_POST['eleve'] . '"'; // Requête pour ajouter un élève
        // echo "<br>$query<br>";
        $result = mysqli_query($connect, $query);
        if (!$result) echo "<br>c'est pas bon ! " . mysqli_error($connect);
        else {
            echo <<< html
            <link href="style.css" rel="stylesheet" />
            <br />
            <i class="bi bi-check-lg"></i>
            <p>L'élève a été désinscrit.e !</p>
            <table>
              <tr>
                <td>
                  <a href="accueil.html">
                    <button type="button" class="button effacer">
                      <span>Accueil</span>
                    </button>
                  </a>
                </td>
                <td>
                  <a href="desinscription_seance.php">
                    <button type="button" class="button valider">
                      <span>Recommancer</span>
                    </button>
                  </a>
                </td>
              </tr>
              <table></table>
            </table>
      html;
        }
      }
      mysqli_close($connect);
      ?> 

</body>

</html>