let darkTheme = false;

console.log(document.cookie);

if(document.cookie === "dark_mode=true"){
    console.log("GCI: Success");
    document.body.setAttribute("class","dark-mode");
    darkTheme = true;
    document.getElementById('dark_mode').setAttribute('class',"dark-mode");
    document.getElementById('dark_mode').innerText = "Dark";
    createCookie("dark_mode","true");
}else{
    console.log("GCI: Failure");
}
//Switches between a light mode and dark mode specified in zeitgeist-main.css
function viewMode(){
    let dm = document.getElementById('dark_mode');
    switch(darkTheme){
        case false:
            document.body.setAttribute("class","dark-mode");
            darkTheme = true;
            dm.setAttribute('class',"dark-mode");
            dm.innerText = "Dark";
            removeCookie("dark_mode");
            createCookie("dark_mode","true");
            break;
        case true:
            document.body.setAttribute("class","light-mode");
            darkTheme = false;
            dm.setAttribute('class',"light-mode");
            dm.innerText = "Light";
            removeCookie("dark_mode");
            createCookie("dark_mode","false");
            break;
    }
}
function createCookie(name, value){
    document.cookie = name+'='+value;
}
function removeCookie(c_name){
    document.cookie = c_name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
}

//TODO: Look into using cookies to store theme data --> Custom themes?