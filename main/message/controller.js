let mb = new MailboxController();
let message = new Message();
let queue = new TimestampPriorityQueue();
let lastTimestamp = "1970-01-01 00:00:01";
let refresh;

mb.mSelect.addEventListener('change', onSelect, false);
mb.mSend.addEventListener('click', onSend, false);

function refreshCycle(){
    stopRC();
    {
        let request = new XMLHttpRequest();
        request.onreadystatechange = function(){Message.loadMessages(request, queue)};
        request.open("GET", "messageHandler.php?token=check&sID=" + sID + "&rID=" + id + "&lastTimestamp=" + lastTimestamp, true);
        request.send();
        
    }
    startRC();
}

function startRC(){
    if(refresh === undefined) {
        refresh = setInterval(refreshCycle, 1000);
    }
}
function stopRC(){
    if(refresh !== undefined){
        clearInterval(refresh);
        refresh = undefined;
    }
}

function onSelect(){
    queue.clear();
    if(mb.loadView()){
        startRC();
    }
    else stopRC();
}
function onSend(){
    if(mb.mInput.value != ''){
        let request = new XMLHttpRequest();
        // request.onreadystatechange = function(){Message.loadMessages(request, queue)};
        request.open("GET", "messageHandler.php?token=send&sID=" + mb.id + "&rID=" + mb.mSelect.options[select.selectedIndex].value + "&content=" + mb.mInput.value, true);
        request.send();
        mb.mInput.value = '';
    }
}
function formMessage(sender, content, timestamp) {
    let messageHeader = "<div class='message row'>";
    let messageFooter = "</div>";
    return messageHeader + ((sender == mb.id) ? outFrame(sender, content, timestamp) : inFrame(sender, content, timestamp)) + messageFooter;
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