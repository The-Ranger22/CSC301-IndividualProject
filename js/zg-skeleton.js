let darkTheme = false;
console.log("Beep-1");
function viewMode(){
    switch(darkTheme){
        case false: document.body.setAttribute("class","dark-mode"); darkTheme = true; break;
        case true: document.body.setAttribute("class","light-mode"); darkTheme = false; break;
    }
}

//TODO: Look into using cookies to store theme data --> Custom themes?