setTitlePos(getPosX(),getPosY());

function getPosX(){
    return window.innerWidth/2;
}
function getPosY(){
    return window.innerHeight/2;
}
function setTitlePos(x, y){
    document.getElementById('title_splash').setAttribute(
        'style', 'position: absolute ;' + 'top:'+(y - 200)+'px; right:'+(x - 245)+'px;'
    );
    console.log("PosX: " + x);
    console.log("PosY: " + y);
}


