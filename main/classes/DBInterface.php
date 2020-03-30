<?php
//Class that will act as the SQL DB interface in the future. (THIS CLASS DOES NOT HANDLE AUTH, ONLY HANDLING DATA FROM THE DB)
//currently, it is being implemented by use of two libraries (csv.php and json.php) but will not require any dependencies
//once implemented for SQL

define("POST_DIRECTORY", "../../_assets/data/posts/post_directory.csv");
define("USER_DIRECTORY", "../../_assets/data/users/user_directory.csv");

class DBInterface
{

    //Handling User
    public static function getUser($id){/*Returns a user object : User*/}
    public static function getAllUsers(){/*Returns all users : User[]*/}
    public static function searchUsers(){/*Searches through the DB for the specified post : Post*/}
    public static function addUser($user){/*Adds a user : boolean*/}
    public static function removeUser($user){/*Removes a user : boolean*/}
    public static function updateUser($user){/*Updates a user : boolean*/}
    //Handling Post
    public static function getPost($post_id, $file){
        $post_arr = self::getAllPosts($file);
        foreach($post_arr as &$post){
            if ($post_id == $post->get_post_id()) return $post;
        }
        return 'post not found';
    }
    public static function getUserPosts($user_id = null){/*Returns posts of a specific user : Post*/}
    public static function getAllPosts($file){/*Returns all posts : Post[]*/
        $h=fopen($file,'r');
        $csv='';
        while(!feof($h)) $csv.=fgets($h);
        fclose($h);
        $csv=explode("\n",$csv);
        //$csv = readCSV(POST_DIRECTORY);
        $post_arr = [];
        $index = 0;
        for($i = 2; $i < count($csv) - 1; $i++){
            $post_arr[$index] = new Post();
            $post_arr[$index]->unserialize(base64_decode(str_replace(substr($csv[$i], 0, strpos($csv[$i], ";") + 1), "", $csv[$i])));
            $index++;
        }
        return $post_arr;
    }
    public static function searchPosts(){/*Searches through the DB for the specified post : Post*/}
    public static function addPost($post, $post_id){/*Adds a post : boolean*/
        $csv = readCSV(POST_DIRECTORY);
        $csv[0][1]++;
        modifyCSVEntry(POST_DIRECTORY, $csv[0], 0);
        writeCSV(POST_DIRECTORY,  $post_id.";".base64_encode($post));
    }
    public static function removePost($post_id, $author_id){/*Removes a post : boolean*/}
    public static function updatePost($post_id, $author_id, $updated_post){/*Updates a post : boolean*/}

    //Utility functions
    public static function getPostTotal($file){
        $csv = readAtCSV($file, 0);
        return $csv[1];
    }
}