let select = document.getElementById("user-select");
let docShell = document.getElementById("shell");
let messenger = document.getElementById("messenger");
let send = document.getElementById("send");
let messageInput = document.getElementById("message-input");

select.addEventListener('change', function(){
    let id = select.options[select.selectedIndex].value;
    loadMessenger(id);
}, false);
send.addEventListener('click', function(){

    sendMessage(messageInput.value);
}, false);

function loadMessenger(id){
    if(id !== "null"){
        docShell.style.display = "block";
    }
    else docShell.style.display = "none";
}
function sendMessage(message){
    message = formMessage(message);
    messenger.innerHTML += message;
}


function formMessage(messageContent, sender){
    let messageHeader = "<div class='row'>";
    let messageFooter = "</div><hr style='border-color: white'>";

    return messageHeader + messageContent + messageFooter;
}