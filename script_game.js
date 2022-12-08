// var rule_joinLater;
// var game_State;
// var game_currQuestion;
// var game_timeForNextQuestion;

// window.onload = function() {
//   addPlayer("player 1");
//   addPlayer("player 2");
// };

function drawPlayer(nickName){
    var playerID;
    
    var pl = document.createElement('div');
    pl.className = "player";
    participants.appendChild(pl);
    
    var name = document.createElement('h3');
    name.innerHTML = nickName;
    pl.appendChild(name);
}

function getControlInput(gameid){
  //read text from URL location
  var xhttp = new XMLHttpRequest();
  var resArr = "ERROR";
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var result = this.responseText;
        resArr = result.split(/\r?\n/);
        
        // rule_joinLater = resArr[0].split("#")[0]; //remove comment

        // game_State = resArr[2].split("#")[0];
        // game_currQuestion = resArr[3].split("#")[0];
        // game_timeForNextQuestion = resArr[4].split("#")[0];
        // console.log(resArr);
      }
  };
  xhttp.open('GET', 'http://localhost/BibleGuess/games/' + gameid + '/control.txt', false);
  xhttp.send();
  return resArr;
}

function getQuestion(QuestionID){
    //read text from URL location
    var xhttp = new XMLHttpRequest();
    var result = "ERROR";
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          result = this.responseText;
        }
    };
    xhttp.open('GET', 'http://localhost/BibleGuess/scripts/getQuestion.php?verseID=' + QuestionID, false);
    xhttp.send();
    //console.log(result);
    return result;
}
function getBook(BookID){
  //sleep(1000);
  //read text from URL location
  var xhttp = new XMLHttpRequest();
  var result = "ERROR";
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        result = this.responseText;
      }
  };
  xhttp.open('GET', 'http://localhost/BibleGuess/scripts/getBook.php?verseID=' + BookID, false);//gets the correct book of the current question
  xhttp.send();
  // console.log(result);
  return result.substring(0, result.length - 6);
}
//http://localhost/BibleGuess/scripts/getPlayers.php?GameID=3913
function getPlayer(GameID){
  //read text from URL location
  var xhttp = new XMLHttpRequest();
  var result = "ERROR";
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        result = this.responseText;
      }
  };
  xhttp.open('GET', 'http://localhost/BibleGuess/scripts/getPlayers.php?GameID=' + GameID, false);//gets the player on index x
  xhttp.send();
  
  // console.log(result);
  return result;
}






function sleep(milliseconds) {
  const date = Date.now();
  let currentDate = null;
  do {
    currentDate = Date.now();
  } while (currentDate - date < milliseconds);
}