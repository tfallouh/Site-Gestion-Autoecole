<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">       
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <title>Consulter eleve</title>
</head>
<body>
    <h1>Consultation élève</h1>
        
          <?php
          
              $dbhost = 'tuxa.sme.utc';         //ID UTC
              $dbuser = 'nf92p043';
              $dbpass = 'INe0Tr7gniKi';
              $dbname = 'nf92p043';
              
              $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
              mysqli_set_charset($connect, 'utf8');
              

              date_default_timezone_set('Europe/Paris');
              $date = date("Y\-m\-d");

              //transmission des données du formulaire
              $ideleve = $_POST["ideleve"];
              
              //Récupération des informations de l'élève de la requête SQL
              $result=mysqli_query ($connect, 'SELECT * from eleves where ideleve ="'.$_POST['ideleve'].'"');
              if (!$result) {
                  printf("Error: %s\n", mysqli_error($connect));
                  exit();
              }
              //Affichage caractéristiques de l'élève
              echo <<< html
              <h2>Elève </h2>
               <table class="consult">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>Date inscription</th>
                  </tr>
                </thead>
              <tr>
              html;
              
              //Rangement en un tableau de données
              while ($row = $result -> fetch_assoc()) {
                foreach ($row as $key => $col) {
                  echo "<td>".$col."</td>";
                }
                echo"</tr>";
              }
              echo"</table>";
              echo <<< html
              <br>
              <table>
              <tr>
                <td><a href="consultation_eleve.php">
                  <button type="button" class='button effacer'><span>Retour</span></button>
                    </a>
                </td>
              </tr>
              </table>
              html;
              
              mysqli_close($connect);
              ?>
 
</body>
</html>