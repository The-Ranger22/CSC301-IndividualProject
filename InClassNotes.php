<?php
echo '<pre>';

//deleteCSVEntry('beatles.csv', 1);
//modifyCSVEntry('beatles.csv', [0 => "Baker", 1 => "Church" ], 0);
print_r(readAtCSV('beatles.csv', 1));
print_r(readCSV('beatles.csv'));

function writeCSV($file,$data){
    $h=fopen($file,file_exists($file) ? 'a' : 'w+');
    fwrite($h,$data. "\n" /* PHP_EOL */);
    fclose($h);
}
function readCSV($file){
    $h=fopen($file,'r');
    $output='';
    while(!feof($h)) $output.=fgets($h);
    fclose($h);
    $output=explode("\n",$output);
    unset($output[count($output)-1]);
    for($i=0;$i<count($output);$i++) $output[$i]=explode(';',$output[$i]);
    return $output;
}
//Expects index to be withing the range of 0 to the length of the CSV file - 1
function readAtCSV($file, $index){
    $fileArr = file($file);
    $output = explode(';', $fileArr[$index]);
    return $output;
}//Works

function deleteCSVEntry($file, $index){
    $oFile = file($file);
    unset($oFile[$index]);
    $nFile = fopen($file, 'w+');
    foreach ($oFile as $line){
        fwrite($nFile, $line);
    }
    fclose($nFile);
} //Works
//Expects data to be an array
//TODO: Bulletproof modifyCSVEntry by adding a check to see if the input is a string or array
function modifyCSVEntry($file, $data, $index){
    $dataString = implode(';', $data);
    $currentData = '';
    $handler = fopen($file, 'r');
    for($i = 0; !feof($handler); $i++){
        $nLine = fgets($handler);
        if($i == $index){
            $currentData .= $dataString."\n";
        }
        else{
            $currentData .= $nLine;
        }
    }
    fclose($handler);
    $handler = fopen($file, 'w');
    fwrite($handler, $currentData);
    fclose($handler);
} //Works


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