<?php
    //connection
    include("scripts/dbconnect.php");

    $server_IP = "192.168.2.136";

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

    <script src="script_game.js"></script>
    
    <title>BibleGuess</title>
  </head>
  </body>
    <div id="main">
      <h1>BibleGuess</h1>
      <h2>Game ID: <?php echo $GameID; ?></h2>
      <img id="qrcode" src="http://chart.googleapis.com/chart?chs=256x256&cht=qr&chl=http://<?php echo $server_IP ?>/BibleGuess/joinViaQR.php?GID=<?php echo $GameID;?>"></br>

      <!-- spinner -->
      <div  id="waitingspinner"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>
      <div id="participants">
      
      </div>

      <div id="playField">
        <div id="questionContainer">
        </div>
      <div>
    </div>


    <script>
        
        setInterval(function() {
          timer();
          showPlayers();
        }, 2000);

        function timer() {
            console.log(getControlInput(<?php echo $GameID?>));
        }

        function showPlayers(){
          //clear board
          var participants = document.getElementById("participants");
          participants.textContent = '';

          // console.log(getPlayer(<?php echo $GameID;?>));          
          var player = JSON.parse(getPlayer(<?php echo $GameID;?>));
          var max = Object.keys(player).length-1;
          
          //shows only the last player
          for(var n = 0; n <= max; n++)
          {
            drawPlayer(player[n]);
          }
        }






        setInterval(function() {
            doGame();
        }, 2000);

        
        function doGame() {
          var arr = getControlInput(<?php echo $GameID;?>);     //script_game.js
          rule_joinLater    = parseInt(arr[0].split("#")[0]); //remove comment
          game_State        = parseInt(arr[2].split("#")[0]);
          game_currQuestion = parseInt(arr[3].split("#")[0]);
          game_timeForNextQuestion = arr[4].split("#")[0];


          switch(game_State){
            //waiting until start
            case 0:
              document.getElementById("participants").style.removeProperty('display');
              document.getElementById("waitingspinner").style.removeProperty('display');
              document.getElementById("qrcode").style.removeProperty('display');
              document.getElementById("questionContainer").style.display = "none";
              showPlayers();
              break;

            //show question
            case 1:
              document.getElementById("participants").style.display = "none";
              document.getElementById("waitingspinner").style.display = "none";
              document.getElementById("qrcode").style.display = "none";
              document.getElementById("questionContainer").style.removeProperty('display');
              document.getElementById("questionContainer").innerHTML = getQuestion(game_currQuestion);//works
              break;
          }
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