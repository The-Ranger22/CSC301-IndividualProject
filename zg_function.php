<?php
function addUser($u_name, $u_title, $u_quote, $img){//TODO: Update to store items in DB
    $users = json_decode(file_get_contents('users.json'));
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
    file_put_contents('users.json', json_encode($users));
}
function addPost($u_name, $p_title, $content){
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