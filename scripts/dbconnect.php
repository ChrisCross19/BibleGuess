<?php
//to to connect to mysql
$db = mysqli_connect("localhost", "root", "", "bibleGuess");

if(!$db){
  echo ("Verbindungsfehler: ".mysqli_connect_error());

  //cant connect to DB bibleguess
  $db = mysqli_connect("localhost", "root", "");  //connect to mysql normaly

  //create DB
  $sql = 'CREATE DATABASE bibleGuess';
  $result = mysqli_query($db, $sql)
    or die("Anfrage fehlgeschlagen: " . mysqli_error($db));
  
  //try to reconnect again
  $db = mysqli_connect("localhost", "root", "", "bibleGuess");
  if(!$db){
    exit("Verbindungsfehler: ".mysqli_connect_error());
  }
}
?>