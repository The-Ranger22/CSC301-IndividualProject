displayTabContent("analytics");




document.getElementById("analyticsTab").addEventListener("click", function(){displayTabContent("analytics")});
document.getElementById("manageUsersTab").addEventListener("click", function(){displayTabContent("manageUsers")});
document.getElementById("managePostsTab").addEventListener("click", function(){displayTabContent("managePosts")});

function displayTabContent(tabID){
    let tabCount = document.getElementsByClassName("tabcontent");
    for(let i = 0; i < tabCount.length; i++){
        tabCount[i].style.display = "none";
    }
    document.getElementById(tabID).style.display = "block";
}

function deleteUser(userID){

}
function editUser(userID){}
function confirmDelete(url, message){
    if(confirm(message)){
        window.location.replace(url);
    }
}
