<?php
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
function lengthOfCSV($file){
    $arr = readCSV($file);
    return count($arr);
}
function indexOfCSV($file, $entry){
    $h = readCSV($file);
    for($i = 0; $i < lengthOfCSV($file); $i++){
        if($entry == $h[$i][0] || $entry == $h[$i][1]) return $i;
    }
    echo 'index of entry not found';
    die();
}
function containedInCSV($file, $element){
    $isPresent = false;
    $h=fopen($file,'r');
    while(!(feof($h))){
        $line = fgets($h);
        if(strstr($line, $element)) {
            $isPresent = true;
            break;
        }
    }
    fclose($h);
    return $isPresent;
}


