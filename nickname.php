<?php
$GameID = $_POST['di1'] . $_POST['di2'] . $_POST['di3'] . $_POST['di4'];

$cookie_gameID = "gameID";
// setcookie($cookie_gameID, $GameID, time() + (86400 * 1), "/"); // 86400 = 1 day

if(!isset($_COOKIE[$cookie_gameID])) {
    echo "Cookie named '" . $cookie_gameID . "' is not set!";
    setcookie($cookie_gameID, $GameID, time() + (86400 * 1), "/"); // 86400 = 1 day
} else {
    echo "Cookie '" . $cookie_gameID . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_gameID];
}
?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="loading.css">
    
    <title>BibleGuess</title>
  </head>
  </body>
    <div id="main">
      <h1>BibleGuess</h1>
      <p>Type in nickname</p>
      <div id="digits">
        <form action="game.php" method="POST" id="formular">
          <input type="text" class="gameInput" id=""   name="nickname" />
          <input type="submit" class="gameInput" value="Go!"/>
        </form>
      </div>
      <!-- spinner -->
      <div class="lds-facebook" id="joinSpinner" style="display: none;"><div></div><div></div><div></div></div>
    </div>


    <script src="script.js"></script>
  </body>
</html>
