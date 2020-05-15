let select = document.getElementById("user-select");
let docShell = document.getElementById("shell");
let messenger = document.getElementById("messenger");
let send = document.getElementById("send");
let messageInput = document.getElementById("message-input");
let sID = document.getElementById("sID").value;

let lastTimestamp = '';
let timeout = 1000;
let refresh;


select.addEventListener('change', function () {
    let id = select.options[select.selectedIndex].value;
    //clears the interval during any changes
    if (typeof refresh !== 'undefined') clearInterval(refresh);
    clearMessenger();
    loadMessenger(id);
}, false);
send.addEventListener('click', function () {
    let id = select.options[select.selectedIndex].value;
    if (id !== "null") {
        sendMessage(messageInput.value, id);
        messageInput.value = '';
    } else {
        docShell.style.display = "none";
    }
}, false);

function loadMessenger(id) {
    if (id !== "null") {
        docShell.style.display = "block";
        let request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                let json_arr = JSON.parse(this.responseText);
                for (let i = 0; i < json_arr.length; i++) {
                    let message = json_arr[i];
                    console.log(message);
                    //console.log(message["sender_id"] + " | " + sID + " | " + (message["sender_id"] == sID));
                    messenger.innerHTML += formMessage(message["sender_id"], message["content"], message["timestamp"]);
                }
                lastTimestamp = json_arr[json_arr.length - 1]["timestamp"];
                messenger.scrollTop = messenger.scrollHeight;
            }
        };
        request.open("GET", "messageHandler.php?token=load&sID=" + sID + "&rID=" + id, true);
        request.send();
        refresh = setInterval(checkForMessages, timeout);
    }
}

function clearMessenger() {
    messenger.innerHTML = '';
    docShell.style.display = "none";
}

function sendMessage(message, id) {
    if (message != '') {
        let request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                console.log("Message sent");
                if (request.responseText != -1) {
                    let message = JSON.parse(request.responseText);
                    console.log(message["sender_id"] + " | " + message["content"] + " | " + message["timestamp"]);
                    messenger.innerHTML += formMessage(message["sender_id"], message["content"], message["timestamp"]);
                    lastTimestamp = message["timestamp"];
                    messenger.scrollTop = messenger.scrollHeight;
                }
            }
        };
        request.open("GET", "messageHandler.php?token=send&sID=" + sID + "&rID=" + id + "&content=" + message, true);
        request.send();
    }
}

function checkForMessages() {
    clearInterval(refresh);
    let id = select.options[select.selectedIndex].value;
    console.log("Last Timestamp:" + lastTimestamp);
    if (id != "null") {
        let request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                if (request.responseText != -1) {
                    console.log(request.responseText);
                    let message = JSON.parse(request.responseText);
                    console.log(message);
                    console.log(message["sender_id"] + " | " + message["content"] + " | " + message["timestamp"]);
                    messenger.innerHTML += formMessage(message["sender_id"], message["content"], message["timestamp"]);
                    lastTimestamp = message["timestamp"];
                    messenger.scrollTop = messenger.scrollHeight;
                }
            }
        };
        //request is sent to messageHandler.php
        request.open("GET", "messageHandler.php?token=check&sID=" + sID + "&rID=" + id + "&lastTimestamp=" + lastTimestamp, true);
        request.send();
    }
    refresh = setInterval(checkForMessages, timeout);
}

function formMessage(sender, content, timestamp) {
    let messageHeader = "<div class='message row'>";
    let messageFooter = "</div>";
    return messageHeader + ((sender == sID) ? outFrame(sender, content, timestamp) : inFrame(sender, content, timestamp)) + messageFooter;
}

function outFrame(sender, content, timestamp = "placeholder") {
    let leftCol = "<div class='col-1 m-sender-1'><h6 class='header-text'>You</h6></div>\n";
    let midCol = "<div class='col'><p class='row'>" + content + "</p><p class='timestamp row'>" + timestamp + "</p></div>\n";
    let rightCol = "<div class='col-1'></div>\n";
    return leftCol + midCol + rightCol;
}

function inFrame(sender, content, timestamp = "placeholder") {
    let leftCol = "<div class='col-1'></div>\n";
    let midCol = "<div class='col'><p>" + content + "</p><p class='timestamp row'>" + timestamp + "</p></div>\n";
    let rightCol = "<div class='col-2 m-sender-2'><h6 class='header-text'>Other</h6></div>\n";
    return leftCol + midCol + rightCol;
}
