<meta charset="utf-8">
<?php
	$verseID = $_GET['verseID'];
    
	//connection
	include("dbconnect.php");

	// $sql = "SELECT `ID`, `BibleVerse` FROM `bible_Guess` WHERE `ID`=0";
	$sql = "SELECT `BibleVerse` FROM `bible_verses` WHERE `ID`=$verseID";
        // $sql = "SELECT * FROM `$GameID`";

        $db_erg = mysqli_query($db, $sql) 
            or die("Anfrage fehlgeschlagen: " . mysqli_error($db));

        $daten = "nothing";
        if ($db_erg = $db->query($sql)) {
            $daten = mysqli_fetch_row($db_erg)[0];
        }
        print_r($daten);
?>



