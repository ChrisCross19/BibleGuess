<?php
$GameID = $_GET['GID'];

$cookie_gameID = "gameID";

if(!isset($_COOKIE[$cookie_gameID])) {
    echo "Cookie named '" . $cookie_gameID . "' is not set!";
    setcookie($cookie_gameID, $GameID, time() + (86400 * 1), "/"); // 86400 = 1 day
} else {
    echo "Cookie '" . $cookie_gameID . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_gameID];
}
?>
<script language="javascript" type="text/javascript"> document.location="nickname.php"; </script>