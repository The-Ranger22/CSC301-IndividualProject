<?php

/*
 * The FileLoader class is designed to take any type of file using general functions (readFile, writeFile) which will
 * utilize private, file type specific, functions to read and write whatever file is given. As for the implementation
 * of the reading and writing of JSON and CSV, I have simply transplanted the methods from my csv and json libraries.
 */
class FileLoader
{
    //General Functions to read, write, modify and delete
    static function readFile($filePath, $index = null){
        if(!isset($filePath)) {
            //throw new Exception("File path not set!");
            return "File path not set!";
        }
        switch(strtolower(substr($filePath, strpos($filePath, ".")))){
            case ".json": return self::readJSONFile($filePath, $index); break;
            case ".csv": return self::readCSVFile($filePath); break;
            default: throw new Exception("Unsupported File Type!");
        }
    }
    static function writeFile($file, $data, $fileExtension){
        if(!isset($file)){
            //throw new Exception("File path not set!");
            Echo("File not set!");
            return;
        }
        if(!(strpos($fileExtension, "."))) $fileExtension = "." . $fileExtension;
        switch(strtolower($fileExtension)){
            case ".json": self::writeJSONFile($file, $data); break;
            case ".csv": self::writeCSVFile($file, $data); break;
            default: throw new Exception("Unsupported File Type!");
        }
    }
    //Private functions for handling JSON files
    private static function readJSONFile($file, $index){
        $h=fopen($file,'r');
        if(!file_exists($file)){
            echo 'file not found';
            die();
        }
        $output='';
        while(!feof($h)) $output.=fgets($h);
        fclose($h);
        $output=json_decode($output,true);
        return !isset($index) ? $output : (isset($output[$index]) ? $output[$index] : null);
    }
    private static function writeJSONFile($file, $data){
        $h=fopen($file,'w+');
        fwrite($h,is_array($data) ? json_encode($data) : $data);
        fclose($h);
    }
    //Private functions for handling CSV files
    private static function readCSVFile($file){
        $h=fopen($file,'r');
        $output='';
        while(!feof($h)) $output.=fgets($h);
        fclose($h);
        $output=explode("\n",$output);
        unset($output[count($output)-1]);
        for($i=0;$i<count($output);$i++) $output[$i]=explode(';',$output[$i]);
        return $output;
    }
    private static function writeCSVFile($file, $data){
        $h=fopen($file,file_exists($file) ? 'a' : 'w+');
        fwrite($h,$data. "\n" /* PHP_EOL */);
        fclose($h);
    }
    //Private utility files

}