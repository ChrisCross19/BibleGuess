<?php
    //connection
    include("scripts/dbconnect.php");

    $Lang = $_POST['langSel'];
    $testament = $_POST['testamentSel'];
    echo $Lang;

    $GameID = rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);

    //create folder    
    $structure = "games/$GameID/";

    if (!mkdir($structure, 0777, true)) {
        die('An Error occured');
    }

    $controlfile = "games/$GameID/control.txt";
    $content = 
    "1#decides, if a player can join later

0#is 1, when has started
0#current question ID
00:00#time for next question";
    
    if (!$fp = fopen($controlfile, "c")) {
      echo "Couldn't create $controlfile";
      exit;
    }
    if (fwrite($fp, $content) === FALSE) {
      echo "Couldn't write to $controlfile";
      exit;
    }
    fclose($fp);

    //create table
    $table = "
    CREATE TABLE `$GameID` (
    `ID` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `nickname` VARCHAR(150) NOT NULL ,
    `score` INT( 11 ) NOT NULL
    ) ENGINE = MYISAM ;
    ";

    $db_erg = mysqli_query($db, $table) 
        or die("Anfrage fehlgeschlagen: " . mysqli_error($db));    
?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_create_game.css">
    
    <title>BibleGuess</title>
  </head>
  </body>
    <div id="main">
        <h1>BibleGuess</h1>
        <h2>Game ID: <?php echo $GameID?></h2>
        <p>A new Game with ID <?php echo $GameID?> was sucessfully created! You can now open the monitor and/or the controlcenter.</p>
        <div id="buttons_area">
            <form action="monitor.php">
                <input type="Submit" id="monitor" value="Monitor">
            </form>
            <form action="controlcenter.php">
                <input type="Submit" id="controlcenter" value="Controlcenter">
            </form>
        </div>
    </div>
    <script src="script_createProceed.js"></script>
    <script>
      setCookie("gameID", <?php echo $GameID; ?>, 1)
    </script>
  </body>
</html>