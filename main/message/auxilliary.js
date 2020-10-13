class MailboxController{
    constructor(){
        this.mBox = document.getElementById("messenger");
        this.mSelect = document.getElementById("user-select");
        this.mShell = document.getElementById("shell");
        this.mSend = document.getElementById("send");
        this.mInput = document.getElementById("message-input");
        this.id = sessionID;
    }
    loadView(){
        if(this.mSelect.options[select.selectedIndex].value !== "null"){
            this.mBox.innerHTML = '';
            this.mShell.style.display = "block";
            return true;
        } else {
            this.unloadView();
            return false;
        }
    }
    unloadView(){
        this.mBox.innerHTML = '';
        this.mShell.style.display = "none";
    }




}
class Message{
    constructor(senderID, receiverID, messageContent, messageTimestamp) {
        this.sender = senderID;
        this.receiver = receiverID;
        this.mContent = messageContent;
        this.mTimestamp = messageTimestamp;
    }
    get senderID(){
        return this.sender;
    }
    get receiverID(){
        return this.receiver;
    }
    get messageContent(){
        return this.mContent;
    }
    get messageTimestamp(){
        return this.mTimestamp;
    }

    set senderID(senderID){
        this.sender = senderID;
    }
    set receiverID(receiverID){
        this.receiver = receiverID;
    }
    set messageContent(messageContent){
        this.mContent = messageContent;
    }
    set messageTimestamp(messageTimestamp){
        this.mTimestamp = messageTimestamp;
    }

    static loadMessages(request, queue){
        if(!(request instanceof XMLHttpRequest)){
            throw new Error("request is expected to be of type XMLHttpRequest");
        }
        if(!(queue instanceof TimestampPriorityQueue)){
            throw new Error("queue is expected to eb of type TimestampPriorityQueue");
        }
        if(request.readyState == 4 && request.status == 200){
            if(request.responseText != -1) {
                let arr = JSON.parse(request.responseText);
                for(let i = 0; i < arr.length; i++){
                    queue.enQ(new Message(arr[i]["sender_id"], arr[i]["recipient_id"], arr[i]["content"], arr[i]["timestamp"]), arr[i]["timestamp"]);
                }
            }
        }
    }
}
