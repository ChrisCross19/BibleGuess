<?php
    //writes into game file
    $GameID = $_GET["gameid"];
    $questionNr = $_GET["Qnr"];
    $timePromise = $_GET["timepromise"];

    $courserPos = $_GET["pos"];
    $content = $_GET["content"];

    echo $GameID . "<br>";
    echo $courserPos . "<br>";
    echo $content . "<br>";

    //write to game-file
    $filename = '../games/' . $GameID . '/control.txt';
    $somecontent = "1#decides, if a player can join later\n
1#is 1, when has started
1#current question ID
00:00#time for next question";

    // can you write?
    if (is_writable($filename)) {
        if (!$fp = fopen($filename, "w")) {
            print "Error: cannot open file";
            exit;
        }

        // Schreibe $somecontent in die geöffnete Datei.
        if (fwrite($fp, $somecontent) === FALSE) {
            print "ERROR: cannot write";
            exit;
        }

        print "Done";

        fclose($fp);

    } else {
        print "ERROR: cannot write";
}

?>