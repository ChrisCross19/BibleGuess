<?php    
    //connection
    include("scripts/dbconnect.php");

    $GameID = "$$$$$$";
    if(!isset($_COOKIE["gameID"])) {
      echo "An error occured. You will be redirectet to the mainpage. Error: ID";
      echo "<meta http-equiv=\"refresh\" content=\"3; URL=/BibleGuess\">";
    }else{
      $GameID = $_COOKIE["gameID"];

      //check if game control file exists
      $path = "./games/$GameID/control.txt";

      if (!file_exists($path)) {
        echo "An error occured. You will be redirectet to the mainpage. Error: file";
        echo "<meta http-equiv=\"refresh\" content=\"3; URL=/BibleGuess\">";
      } else{
        
?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_game.css">

    <script src="script_cc.js"></script>
    <script src="script_game.js"></script>
    
    <title>BibleGuess</title>
  </head>
  </body>
    <div id="main">
      <h1>BibleGuess - controlcenter</h1>
      <h2>Game ID: <?php echo $GameID?></h2>
      <label id="QuestionNr"></label>

      <div id="area">
        <button onClick="next();"> -> </button>
        <button> Exit </button>
      </div>
    </div>


    <script>
        
        setInterval(timer, 2000);
        function timer() {
            // console.log(getControlInput(<?php echo $GameID?>));
            document.getElementById("QuestionNr"). innerText = "curr question: " && (getControlInput(<?php echo $GameID?>));
            
        }

        function next(){
          // nextQuestion(<?php echo $GameID?>, 0, "test")
          nextQuestion(<?php echo $GameID?>, 0, "test")
        }
        
    </script>
  </body>
</html>
<?php

      }
    }
?>


<!--  control.txt
0#is 1, when started
1#decides, if a player can join later
1#question ID 

-->