<?php
	$verseID = $_GET['verseID'];
    
	//connection
	include("dbconnect.php");

	$sql = "SELECT `Book` FROM `bible_verses` WHERE `ID`=$verseID";

        $db_erg = mysqli_query($db, $sql) 
            or die("Anfrage fehlgeschlagen: " . mysqli_error($db));

        $daten = "nothing";
        if ($db_erg = $db->query($sql)) {
            $daten = mysqli_fetch_row($db_erg)[0];
        }
        print_r($daten);
?>



