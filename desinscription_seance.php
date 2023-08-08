<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Désinscription séance</title>
    <link rel="stylesheet" href="style.css">
  </head>
<body>
  <h1> Désinscrire un élève d'une séance </h1>
      <?php

        $dbhost = 'tuxa.sme.utc';         //ID UTC
        $dbuser = 'nf92p043';
        $dbpass = 'INe0Tr7gniKi';
        $dbname = 'nf92p043';
        
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
        mysqli_set_charset($connect, 'utf8');

          // Récupérer les élèves inscrits à une séance au mininmum.
          $resultat_eleves_inscrits = mysqli_query($connect, 'SELECT eleves.ideleve,nom,prenom FROM eleves ORDER by nom ');

          // Menu déroulant d'élèves inscrits à une séance au mininmum.
          echo <<< html
          <head>
            <link href="style.css" rel="stylesheet">
            <meta charset="utf-8">
          </head>
          <form method='POST' action='desinscription_seance.php '>
          <table>
          <thead>
            <tr>
              <th colspan="2">
                <h2><i class="bi bi-journal-minus"></i> Désinscription aux séances  </h2>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr><td><label for='eleve'>Élève  </label></td></tr>
            <tr><td><select class='champ' name='eleve' id='eleve'>
                    <option>Choisir un élève</option>\n
          html;
          while ($row = mysqli_fetch_array($resultat_eleves_inscrits)) {
              echo '          <option  value="'.$row['ideleve'].'">'.$row['nom'].'  '.$row['prenom'].'</option>';
              echo "\n";
          }
          echo <<< html
                    </select>
                </td>
                <td><input type='submit' class='button valider' value='Valider'></td></tr>
            </tr>
          </form>\n
          html;

          // Si un élève est choisi dans la liste --> affichage menu déroulant des séances à lesquelles il est inscrit
          if (isset($_POST['eleve'])) {
          // Requête pour récupérer le nom et prénom de l'élève 
          $resultat_eleve = mysqli_query($connect, 'select nom,prenom from eleves where ideleve = "' . $_POST['eleve'] . '"');
          // Requête pour récupérer les séances futurs où l'élève est inscrit.
          $resultat_seance = mysqli_query($connect, 'SELECT seances.idSeance,DateSeance,themes.nom FROM inscription,seances,themes WHERE inscription.ideleve = "' . $_POST['eleve'] . '" and inscription.idseance = seances.idSeance and themes.idTheme = seances.IdTheme and DateSeance >= CURDATE()');
          if (!$resultat_seance) echo "<br>c'est pas bon ! " . mysqli_error($connect);
          $ligne_eleve = $resultat_eleve->fetch_assoc();
          echo <<< html
        <form method='POST' action='desinscrire_seance.php '>
          <input type='number' name="eleve" value={$_POST['eleve']} hidden>
          <tr>
            <td><c> {$ligne_eleve['nom']} {$ligne_eleve['prenom']}</c></td>
          </tr>
          <tr>
            <td>
        html;
      
          if (!mysqli_num_rows($resultat_seance) == 0) { // Si l'élève est inscrit à une séance future
              echo "<select class='champ' name='seance'>\n";
              while ($row = $resultat_seance->fetch_assoc()) {
                  echo <<< html
                      <option value={$row['idSeance']}>{$row['DateSeance']} {$row['nom']}</option>\n
                      html;
              }
              echo "</select><td><input type='submit' class='button effacer' value='Désinscrire'></td>";
          } else {
              echo " Non inscrit.e ";
          }
      
          echo <<< html
              </td>
            </tr>
          </tbody>
        </table>
      html;
      }
      mysqli_close($connect);