
let PosX = getPosX();
let PosY = getPosY();
document.getElementById('login').setAttribute('style', 'position: absolute ;top:'+PosY+'px; right:'+(PosX - 25)+'px;')
function getPosX(){
    return screen.width/2;
}
function getPosY(){
    return screen.height/2;
}

