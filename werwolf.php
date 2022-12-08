<?php
  //connection
  include("dbconnect.php");

  $GameID = "$$$$$$";
  $GameID = $_POST['gameid'];
  $mode = $_POST['mode'];
  $nickname = $_POST['nickname'];
  
  //echo "mode: " . $mode . " ";
  //if there is no valid token
  if($nickname === "" or  $GameID === ""){
  	//if ($mode != "create" || $mode != 'join'){
  	echo "An error has been dedected... Try again.";
  } else {
    //if a new game is created
    if ($mode === "create" && $nickname !== ""){
      //create session
	    session_start();
	    if (!isset($_SESSION['game'])) {		//if game does not exist -> add a new player
        $_SESSION['game'] = $GameID;
    

        $villager = $_POST['villager'];
        $werwolfs = $_POST['werwolfs'];
        $seher = $_POST['seher'];
        $witch = $_POST['witch'];
        $hunter = $_POST['hunter'];
        $girl = $_POST['girl'];

        //create GameID
        $GameID = mt_rand(100000,999999);
        $val = mysqli_query($db, 'SHOW TABLES LIKE `$GameID`');

        while($val !== FALSE){//exists
            $GameID = mt_rand(100000,999999);
            $val = mysqli_query($db, 'SHOW TABLES LIKE `$GameID`');
        }
        echo $GameID;

        //create Table
        $sql = "
          CREATE TABLE `$GameID` (
          `id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
          `nickname` VARCHAR( 150 ) NOT NULL ,
          `roll` VARCHAR( 150 ) NULL ,
          `died` BOOLEAN
          ) ENGINE = MYISAM ;
          ";
        $db_erg = mysqli_query($db, $sql) 
          or die("Anfrage fehlgeschlagen: " . mysqli_error($db));

        //create Log Entry
          $sql = "INSERT INTO `$GameID`
                    (`nickname`, `roll`)
            VALUES ('PROTOKOLL', '-')";
          $db_erg = mysqli_query($db, $sql) 
            or die("Anfrage fehlgeschlagen: " . mysqli_error($db));
            
        //create game leader
          $sql = "INSERT INTO `$GameID`
                  (`nickname`, `roll`, `died`)
          VALUES ('$nickname', '-', 'FALSE')";
          $db_erg = mysqli_query($db, $sql) 
          or die("Anfrage fehlgeschlagen: " . mysqli_error($db));

      } else if ($mode == "join" && $GameID != ""){
        //set cookie
        //wenn cookie gesetzt wurde, keinen neuen spieler erzeugen

        //create player
        $sql = "INSERT INTO `$GameID`
                (`nickname`, `roll`, `died`)
        VALUES ('$nickname', '-', 'FALSE')";
        $db_erg = mysqli_query($db, $sql) 
            or die("Anfrage fehlgeschlagen: " . mysqli_error($db));
      } else {
        echo "Es wurde entweder keine ID oder kein Nickname eingegeben.";
      }
      
      } else {
  		  $GameID =  $_SESSION['game'];
  		  echo "GameID from Session: " . $GameID;
	}

?>
<!DOCTYPE html>
<html>
  <head>
      <title>Werwolf - Spiel <?php echo $GameID; ?></title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="images.css">
  </head>

  <nav>
    <ul class="ULnav">
      <li class="LInav"><a href="index.html"><img class="logo" src="logo.png"\></a></li>
      <li class="LInav"><a class="navLink" class="active" href="#Spielregeln.html">Spielregeln</a></li>
    </ul>
  </nav>  
  <body>
    <div id="backgroundDay">
      <div id="backgroundNight">
        <img id="moon" scr="Background-Moon-Night.png">

        <article id="Article">
          <div id="StartGame" >
            <h1><?php echo $GameID; ?></h1>
    
            <br>
            <hr>
            <span id="GameSection">
              <?php 
              if ($mode == "create"){?>
                <form action="settings.php" method="POST">
                  <input type="submit" value="Settings"/><br>
                </form>
              		<select id="playerSelect" size="10"></select><br>
              		<input type="submit" value="Start"/><br>
              <?php } else {?>
              		<select id="playerSelect" size="10"></select><br>
              		<h2>Bitte warten, bis der Spielleiter das Spiel startet</h2>
              <?php }?>
            </span>    
          </div>
        </article>
      </div>
    </div>    
  </body>





  <script>
  window.onload = getPlayer();
  
    setInterval(function() {
      getPlayer();
    }, 2000);
     
    function getPlayer() {
    	var selection = document.getElementById("playerSelect");

      //clear List
      var length = selection.options.length;
      for (i = length-1; i >= 0; i--) {
        selection.options[i] = null;
      }

      //get current player
    	var xhttp = new XMLHttpRequest();    	
      xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var playerArray = this.responseText.split(",");
        for(var i = 0; i<playerArray.length; i++){
          var option = document.createElement("option");
          option.text = playerArray[i];
          selection.add(option);
        }
      }
      };
      var jsGID = <?php echo json_encode($GameID); ?>;
      xhttp.open('GET', 'getPlayer.php?gameid=' + jsGID, true);
      xhttp.send();
    }    


    //window.onload = createList();

    // function createList(){
    //    var selection = document.getElementById("playerSelect");

    //    for (var i = 0; i<6; i++){
    //      var option = document.createElement("option");
    //      option.text = "Player" + i;
    //      selection.add(option);
    //    }
    // }


    function SetDayNight() {
      var dayNight = document.getElementById("dayNight");

      var backgroundNight = document.getElementById("backgroundNight");
      var moon = document.getElementById("moon");
      
      //turns to day
      if (dayNight.checked == true){
        backgroundNight.style.backgroundImage = "none";
        //moon.style.display = "none";
        for(var i = 1; i>0; i-= 0.01){
          moon.style.opacity = i;
          //sleep(500)
        }
      } else {
        backgroundNight.style.backgroundImage = "url('Background-Landscape-Night.png'), url('Background-Sky-Night.png')";
        moon.style.display = "block";
        for(var i = 0; i<1; i+= 0.01){
          moon.style.opacity = i;
        }        
      }
    }

    function sleep(milliseconds) {
      const date = Date.now();
      let currentDate = null;
      do {
        currentDate = Date.now();
      } while (currentDate - date < milliseconds);
    }

  </script>
</html>
<?php 
  }
      

?>