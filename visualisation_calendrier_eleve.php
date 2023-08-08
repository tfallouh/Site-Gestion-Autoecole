<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h1>Visualiser le calendrier d'un élève</h1>
	<?php
        $dbhost = 'tuxa.sme.utc';
        $dbuser = 'nf92p043';
        $dbpass = 'INe0Tr7gniKi';
        $dbname = 'nf92p043';
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
        mysqli_set_charset($connect, 'utf8'); 
		$result = mysqli_query($connect,"SELECT * FROM eleves");	//requête pour selectionner tous les élèves

		//Formulaire pour sélectionner l'élève dont on veut afficher le calendrier
		echo "<table>";
		echo "<FORM METHOD='POST' ACTION='visualiser_calendrier_eleve.php'>";
		echo "<tr><td><subtitles>Choix de l'élève :</subtitles></td><td><select name='ideleve' BORDER='1'>";

		while ($lister_eleves = mysqli_fetch_array($result, MYSQLI_NUM)){
			echo "<option value=".$lister_eleves[0].">".$lister_eleves[1]." ".$lister_eleves[2]." né le ".$lister_eleves[3]."</option>";
		}
		echo "<tr><td><br><INPUT type='submit' value='Valider'></td></tr>";
		echo "</FORM>";
		echo "</table>";
		mysqli_close($connect);
	?>
</body>
</html>