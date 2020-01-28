<?php
$users = json_to_arr('users.json');
function add_user($u_name, $u_title, $u_quote, $img, $json){//TODO: Update to store items in DB
    $users = json_decode(file_get_contents($json));
    array_push($users, [
        'username'=>$u_name,
        'title'=>$u_title,
        'quote'=>$u_quote,
        'img'=>$img,
        'date_joined'=>[
            'day'=>date('d'),
            'month'=>date('m'),
            'year'=>date('Y'),
            'time'=>date('e h:i:s A') //TODO: Fix timezone. Currently ahead by 6 hours
        ]
    ]);
    file_put_contents($json, json_encode($users));
}
function add_post($u_name, $p_title, $content){
    $posts = json_decode(file_get_contents('posts.json'));
    array_push($posts,
    [
        'author'=>$u_name,
        'title'=>$p_title,
        'content'=>$content,
        'date_posted'=>[
            'day'=>date('d'),
            'month'=>date('m'),
            'year'=>date('Y'),
        ]
    ]
    );
}
function remove_user(){};
function remove_post(){};
function sort_by_alphabetical(){}
function sort_by_newest(){}
function sort_by_oldest(){}

function show_profile($username, $picture, $body=null, $id){
    echo '
        <span>
            <div class="card_container" style="width: 10rem">
                <img class="card_img" src="'.$picture.'" alt="Profile pic of '.$username.'">
                <div class="card_body">
                    <h5 class="card_title">'.$username.'</h5>
                    <h6>'.$body.'</h6>
                    <a href="detail.php?id='.$id.'">Visit profile</a>
                </div>
            </div>
        </span>
        ';
}

function json_to_arr($file){
    return json_decode(file_get_contents($file), true);
}
