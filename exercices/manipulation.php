<?php
$fp = fopen('../README.md', 'r');

$content = fread($fp, filesize('../README.md'));
    echo "<pre>";
    echo $content;
    echo "</pre>";
    
    $lines = file('../README.md');
        foreach ($lines as $line_num => $line) {
            echo "Line <b>{$line_num}</b> : " . ($line) . "<br />\n";
    }

    
    $fp = fopen('../README.md', 'r');
    while(!feof($fp)){
        echo fgets($fp);
    }
/** 
   * require_once("./function.php");
    *    $filename = "../README.md";
     *   $ajout = 'bon appetit';
*/
   //writeLog($filename, $ajout);
    /**
     * ecriture sans vérification
    *$fd = fopen("../README.md", "a");
    *fwrite($fd, "BON APPETIT");
    *echo fgets($fp);
    *fclose($fd);
    */









?>