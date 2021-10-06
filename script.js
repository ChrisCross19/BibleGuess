function nextDigit (nr){
    // this.value=this.value.replace(/[^0-9]/g,'');
    // console.log("max");
    switch (nr) {
        // case 1:
        //     document.getElementById("digitTwo").focus();
        //     break;
        case 2:
            document.getElementById("digitTwo").focus();
            break;
        case 3:
            document.getElementById("digitThree").focus();
            break;
        case 4:
            document.getElementById("digitFour").focus();
            break;
    
        case 5:
            console.log("join")
            fadeOutEffect()
            document.getElementById("joinSpinner").style = "";
            setTimeout(function(){ 
                window.location.href='game.html';
            }, 4000);
            break;
    }
}

function fadeOutEffect() {
    var fadeTarget = document.getElementById("digits");
    var fadeEffect = setInterval(function () {
        if (!fadeTarget.style.opacity) {
            fadeTarget.style.opacity = 1;
        }
        if (fadeTarget.style.opacity > 0) {
            fadeTarget.style.opacity -= 0.1;
        } else {
            clearInterval(fadeEffect);
        }
    }, 100);
}