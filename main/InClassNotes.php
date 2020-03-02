<?php


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