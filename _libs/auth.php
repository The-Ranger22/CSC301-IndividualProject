<?php
function sign_in(){}
function sign_up(){}
function sign_out(){}
function session_logged($id_field){
    return isset($_SESSION[$id_field]{0});
}