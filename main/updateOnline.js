document.addEventListener('DOMContentLoaded', function(){updateUsers()}, false);
let refresh = setInterval(updateUsers, 1000);
function updateUsers(){
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        let json_arr = JSON.parse(this.responseText);
        //console.log(json_arr.length);

        for(let i = 0; i < json_arr.length; i++){
            //console.log(json_arr[i]);
            let user = document.getElementById("status" + json_arr[i]["user_id"]);
            if(json_arr[i]["online"] === 1){
                user.innerText = "Online";
                user.className = "c-green";
            } else {
                user.innerText = "Offline";
                user.className = "c-red";
            }
        }
    };
    request.open("GET", "handler.php", true);
    request.send();
}