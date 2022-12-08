<?php
    //connection
    include("scripts/dbconnect.php");

    // if ((isset($_GET['book'])) && (!empty($_GET['book']))) {
      // $book = $_POST['book'];
      // echo $book;
    // }
    

    if(isset($_COOKIE["gameID"])) { //if game cookie exists
      $GameID = $_COOKIE["gameID"];

      //set cookie, if it does not exist
      if(!isset($_COOKIE["nickname"])) {
          $nickname = $_POST['nickname'];
          setcookie("nickname", $nickname, time() + (86400 * 1), "/"); // 86400 = 1 day
          
          //create player
          $sql = "INSERT INTO `$GameID`
                  (`nickname`, `score`)
                  VALUES 
                  ('$nickname', '0')";
          $db_erg = mysqli_query($db, $sql) 
              or die("Anfrage fehlgeschlagen: " . mysqli_error($db));
      }
      else
      {
          $nickname = $_COOKIE['nickname']; //if nickname cookie exists, get it!
      }

      // $GameID = $_POST['di1'] . $_POST['di2'] . $_POST['di3'] . $_POST['di4'];

      //check if game controll file exists
      $path = "games/$GameID/control.txt";
      if (!file_exists($path)) {
          echo "An error Occured. You will be redirectet to the mainpage.";
          echo "  <script>  setInterval(redirect, 2000);
                          function redirect() {
                              window.location.replace='index.html';
                          }
                  ;</script>";
      }
      // //create Table
      // $sql = "
      //         CREATE TABLE `$GameID` (
      //         `id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
      //         `nickname` VARCHAR( 150 ) NOT NULL ,
      //         `score` VARCHAR( 150 ) NULL
      //         ) ENGINE = MYISAM ;
      //     ";
      // $db_erg = mysqli_query($db, $sql) 
      //     or die("Anfrage fehlgeschlagen: " . mysqli_error($db));
    }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_game.css">
    
    <title>BibleGuess</title>
  </head>
  </body>
    <div id="main">
      <h1>BibleGuess</h1>
      <h2><?php echo "Hey " . $nickname . ", you joined game " . $GameID?></h2>
      <p id="waitMessage">Wait until the game starts...</p>
      <!-- spinner -->
      <div  id="waitingspinner"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>
      <div id="playField">
        <div id="questionContainer">
        </div>
        <div>
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div id="bookGuess">
              <input type="text" class="gameInput" placeholder="Guess the book..."   name="book" />
            </div>
            <input type="submit" class="gameInput" value="Try it!"/>
          </form>
        </div>
      </div>
    </div>

    <script>
      var FORM_Submitted = false;
    </script>
    <?php
      /* checks wether the form was submitted */
      if(empty($_POST["book"]))
      {
        echo "empty";
      }
      else
      {
        echo $_POST["book"];
        ?>
        <script>
          var FORM_Submitted = true;
        </script>
        <?php
      }

      function getControlInput($GID){
        $filename = "./games/" . $GID . "/control.txt";
        // $handle = fopen($filename, "rb");
        // $contents = fread($handle, filesize($filename));
        $contents = file_get_contents($filename);
        // fclose($handle);

        //Clear cache and check filesize again
        clearstatcache();
        
        //ugly but works
        $ret = json_encode(explode("\n", $contents));
        return substr($ret, 2, -2);
      }

      // echo "\n" . (getControlInput($GameID));
    ?>
    <script src="script_game.js"></script>
    <script>
      var rule_joinLater;
      var game_State;
      var game_currQuestion;
      var game_timeForNextQuestion;
        window.onload = function() {
            doGame();
        };

        setInterval(function() {
            doGame();
            window.location.reload();
        }, 2000);

        
        function doGame() {
          var arr = '<?php echo (getControlInput($GameID)); ?>';
          arr = arr.split("\",\"");
          rule_joinLater    = parseInt(arr[0].split("#")[0]); //remove comment
          game_State        = parseInt(arr[2].split("#")[0]);
          game_currQuestion = parseInt(arr[3].split("#")[0]);
          game_timeForNextQuestion = arr[4].split("#")[0];
          console.log("curr S:" + game_State);
          console.log("curr Q:" + game_currQuestion);


          switch(game_State){
            //waiting until start
            case 0:
              document.getElementById("waitingspinner").style = "display: block;";
              document.getElementById("waitMessage").style = "display: block;";
              document.getElementById("questionContainer").style = "display: none;";
              document.getElementsByClassName("gameInput")[0].disabled = true;
              document.getElementsByClassName("gameInput")[1].disabled = true;
              break;

            //show question
            case 1:
              document.getElementById("waitingspinner").style = "display: none;";
              document.getElementById("waitMessage").style = "display: none;";
              document.getElementById("questionContainer").style = "display: block;";
              document.getElementsByClassName("gameInput")[0].disabled = false;
              document.getElementsByClassName("gameInput")[1].disabled = false;
              document.getElementById("questionContainer").innerHTML = getQuestion(game_currQuestion);//works

              ///////////////////////
              //do validation check//
              ///////////////////////
              if(FORM_Submitted == true){
                var guess = "<?php if(!empty($_POST["book"])) echo $_POST["book"];?>";
                
                var answere = getBook(game_currQuestion);
                
                console.log(answere);
                //sleep(100);
                if(guess == answere)
                {
                    console.log("treffer");
                    document.getElementById("questionContainer").style = "background-color: #4d4;";

                }
                else
                {
                    console.log("Falsch");
                    document.getElementById("questionContainer").style = "background-color: #d44;";
                }
              }
              break;
            
            //wait for next question
            case 2:
              document.getElementById("waitMessage").style = "display: none;";
              document.getElementsByClassName("gameInput")[0].disabled = true;
              document.getElementsByClassName("gameInput")[1].disabled = true;

          }
        }

        
        </script>
  </body>
</html>



<!--  control.txt
0#is 1, when started
1#decides, if a player can join later
1#question ID 

-->