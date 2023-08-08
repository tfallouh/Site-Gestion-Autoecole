<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css" type="text/css"/>
    </head>
    <body> <h1> Consultation élève </h1>
        
        <?php
        
            $dbhost = 'tuxa.sme.utc';         //ID UTC
            $dbuser = 'nf92p043';
            $dbpass = 'INe0Tr7gniKi';
            $dbname = 'nf92p043';
            

            date_default_timezone_set('Europe/Paris');
            $date = date("Y\-m\-d");
            
            $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
            mysqli_set_charset($connect, 'utf8');

            //Récupération des infos de la table eleves
            $result=mysqli_query ($connect, 'select * from eleves ORDER by nom');
            echo <<< html
                <form method='POST' action='consulter_eleve.php'>
                    <table>
                        <tr><td><label for='eleve'>Élève</label></td></tr>
                        <tr>
                            <td>
                                <select class='champ' name='ideleve' id='ideleve' >\n
            html;
            
            //Menu déroulant pour sélectionner l'élève
            while ($row = mysqli_fetch_array($result))
                {echo'<option value="'.$row['ideleve'].'">'.$row['nom'].'  '.$row['prenom'].' </option>  '; echo "\n";}
            echo <<< html
                                </select>
                            </td>
                            <td><input type='submit' class='button valider' value='Valider'></td>
                         </tr>
                        </tbody>
                    </table>
                </form>
                </body>
            html ;
            mysqli_close($connect);
        ?>
</body>
</head>