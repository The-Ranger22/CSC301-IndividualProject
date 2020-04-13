<?php
//Class that acts as the SQL DB interface. (THIS CLASS DOES NOT HANDLE AUTH, ONLY HANDLING DATA FROM THE DB)


class DBInterface
{
    //MySQL
    public static function connectToDB($settings, $options){
        return new PDO('mysql:host='.$settings['host'].';dbname='.$settings['dbname'].';charset='.$settings['charset'],$settings['username'],$settings['password'], $options);
    }
    public static function insert($table, $fields, $values, $settings, $options){
        $db = self::connectToDB($settings, $options);
        $values_placeholder = '';
        for($i = 0; $i < count($values); $i++){
            if($i == count($values) - 1){
                $values_placeholder .= '?';
            }
            else {
                $values_placeholder .= '?,';
            }
        }
        $query = $db->prepare("INSERT INTO ".$table."(".$fields.") VALUES (".$values_placeholder.")");
        $query->execute($values);
    }


    public static function addUser($user_data, $settings, $options){
        $db = self::connectToDB($settings, $options);
        $query = $db->prepare("INSERT INTO user(username, email, password, DoB) VALUES (?, ?, ?, ?)");
        $query->execute([$user_data['username'],$user_data['email'],$user_data['password'], $user_data['DoB']]);
    }
    public static function removeUser($user_id, $file){/*Removes a user : boolean*/}
    public static function updateUser($user_id, $user_details, $file){/*Updates a user : boolean*/}
    //Handling Post
    public static function getPost($post_id, $file){
        $post_arr = self::getAllPosts($file);
        foreach($post_arr as &$post){
            if ($post_id == $post->get_post_id()) return $post;
        }
        return false;
    }
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
    public static function addPost($post, $post_id){/*Adds a post : boolean*/
        $csv = readCSV(POST_DIRECTORY);
        $csv[0][1]++;
        modifyCSVEntry(POST_DIRECTORY, $csv[0], 0);
        writeCSV(POST_DIRECTORY,  $post_id.";".base64_encode($post));
    }
    //TODO:


    //Utility functions
    public static function getPostTotal($file){
        $csv = readAtCSV($file, 0);
        return $csv[1];
    }
}