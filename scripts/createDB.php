<?php
    include("dbconnect.php");

    // $sql = 'CREATE DATABASE bibleGuess';

    // $result = mysqli_query($db, $sql)
    //   or die("Anfrage fehlgeschlagen: " . mysqli_error($db));

    
    $table = "
    CREATE TABLE `bible_Verses` (
    `ID` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `BibleVerse` LONGTEXT NOT NULL ,
    `Book` text NULL ,
    `Chapter` INT( 10 ) NOT NULL ,
    `Verse_1` INT( 10 ) NOT NULL ,
    `Verse_2` INT( 10 ) NOT NULL ,
    `Verse_3` INT( 10 ) NOT NULL ,
    `isOldTestament` SMALLINT( 1 ) NOT NULL
    ) ENGINE = MYISAM ;
    ";

    // MySQL-Anweisung ausführen lassen
    $db_erg = mysqli_query($db, $table) 
        or die("Anfrage fehlgeschlagen: " . mysqli_error($db));    
?>