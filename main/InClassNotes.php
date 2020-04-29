<?php
include 'classes/Item.php';
include 'classes/User.php';


echo('<pre>');
$a = new User('alpha', 'email.email', 'asdf');

$a = serialize($a);

echo $a."\n";

$a = crypt($a);

echo $a."\n";
class STATUS{
    #--BANNED
    const BANNED=-50;
    #--REMOVED
    const REMOVED=-40;
    #--DELETED
    const DELETED=-30;
    #--SUSPENDED
    const SUSPENDED=-20;
    #--PAUSED
    const PAUSED=-10;
    #--CREATED
    const CREATED=0;
    #--CREATED
    const INSERTED=10;
    #--INSERTED
    const INVITED=20;
    #--INVITED
    const REGISTERED=30;
    #--REGISTERED
    const REVIEW=40;
    #--REVIEW
    const ACTIVATED=50;
    #--ACTIVATED
    const VALIDATED=60;
    #--VALIDATED
    const PUBLISHED=70;
    #--PUBLISHED
    const TRUSTED=80;
    #--TRUSTED
    const PROMOTED=90;
    #--PROMOTED
}





/*
fopen(file_path, mode) -> gets file contents line by line | Modes: a -> append, w+ -> write, r -> read
fwrite(handle, fileName)
fclose(handle)
Explode() -> Converts string to array
implode() --> Converts array to string
is_array(data) --> Checks to see if the given variable is an array. Returns boolean.
array_merge(arr1, arr2) -->
_GET=[] --> Array
_POST --> Packages in a piece of the request (called the header), not visible in the URL

[Client] -----------> [Server]
          <Payload>

unset(array[index])
Chapter 4:
-The purpose of forms is collecting information from users
-While dealing with the forms, information

Using forms -> <intput action : method>

http://.....?key1=value2&key2=value2 <-- Get/_GET request
*/

/*
 * Mutual Exclusion: Wont allow a file to be written
 */