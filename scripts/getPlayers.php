<?php
	$GameID = $_GET['GameID'];
    
	//connection
	include("dbconnect.php");

	$sql = "SELECT `nickname` FROM `$GameID`";

        $db_erg = mysqli_query($db, $sql) 
            or die("Anfrage fehlgeschlagen: " . mysqli_error($db));

        $daten = "nothing";
        if ($db_erg = $db->query($sql)) {
            $daten = mysqli_fetch_all($db_erg);
        }
        // print_r($daten);
        echo json_encode($daten);
?>



