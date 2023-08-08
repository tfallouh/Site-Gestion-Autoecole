<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ajouter une séance</title>
</head>
<body>
    <?php
        $dbhost = 'tuxa.sme.utc';           //ID UTC
        $dbuser = 'nf92p043';
        $dbpass = 'INe0Tr7gniKi';
        $dbname = 'nf92p043';
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
        mysqli_set_charset($connect, 'utf8'); 
        
        date_default_timezone_set('Europe/Paris');
        $date = date("Y\-m\-d");        
        
        //Choix ddes thèmes actifs dans la BDD
        $result = mysqli_query($connect,"SELECT * FROM themes where supprime = 0 ");
        if (!$result)
        {
        echo "<br>Erreur de connexion  ".mysqli_error($connect);
        }

        //Formulaire pour création de séances
        echo <<<_END
            <h1>Ajouter une séance</h1>
            <FORM METHOD='POST' ACTION='ajouter_seance.php'>
            <table>
                <tr><td><label for='Idtheme'>Thème de la séance :</label></td>
                    <td>
                    <select name='menuthemes' id='Idtheme'>
        _END;
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
        echo "<option value='$row[0]'>$row[1]</option>";
        }
        echo <<<_END
                    </select></td></tr>
                    <tr><td><label for='DateSeance'>Date de la séance :</label></td>
                <td><input type='date' min='$date' name='DateSeance' id='DateSeance' required></td>
            <tr><td><INPUT type='submit' value='Enregistrer séance'></td></tr></table>
            </FORM>
        _END;
        mysqli_close($connect);
    ?>
</body>
</html>