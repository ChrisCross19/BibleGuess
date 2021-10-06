
window.onload = function() {
  addPlayer("player 1");
  addPlayer("player 2");
};

function addPlayer(nickName){
    var playerID;
    //var nickName;
    
    var participants = document.getElementById("participants");
    
    var pl = document.createElement('div');
    pl.class = "player";
    participants.appendChild(pl);
    
    var name = document.createElement('h3');
    name.innerHTML = nickName;
    pl.appendChild(name);
}