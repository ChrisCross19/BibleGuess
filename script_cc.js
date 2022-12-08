function nextQuestion(gameid, QuestionNr, timepromise){
// function nextQuestion(gameid, pos, content){

    //read text from URL location
    var xhttp = new XMLHttpRequest();
    var resArr = "ERROR";
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var result = this.responseText;
            resArr = result.split(/\r?\n/);
            

            game_currQuestion = resArr[3].split("#")[0]; //current question ID
            game_currQuestion = parseInt(game_currQuestion, 10);
            console.log(game_currQuestion + " -> " + (game_currQuestion++));
        }
    };
    xhttp.open('GET', 'http://localhost/BibleGuess/games/' + gameid + '/control.txt', false);//get current game rules and current game question
    xhttp.send();

    //write new Q-ID to control file
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var result = this.responseText;

            console.log(result);
        }
    };
    // xhttp.open('GET', 'http://localhost/BibleGuess/scripts/writeToControl.php?gameid='+gameid + '&pos='+pos + '&content='+content, false);
    xhttp.open('GET', 'http://localhost/BibleGuess/scripts/writeToControl.php?gameid='+gameid + '&Qnr='+QuestionNr + '&timepromise='+timepromise, false);
    xhttp.send();
    

}


