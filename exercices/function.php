<?php

/**
 * writeLog
 *
 * @param  string $filename = le fichier à ecrire
 * @param  string $ajout = la phrase à ajouter
 *
 * @return bool la valeur renvoyée
 */
function writeLog($filename, $ajout ): bool {

   

    if(is_writable($filename)){
        if(!$fp=fopen($filename, 'a')){
            echo "impossible d'ouvrir le fichier".$filename;
            return false;
        } 
    
        if(!fwrite($fp, $ajout)){
            echo "impossible d'ecrire dans le fichier".$filename;
           return false;
        }
            echo "l'ecriture de ".$ajout." dans le fichier ".$filename." a reussi";
            fclose($fp);
            return true;
        }else{
        echo"le fichier".$filename."n'est pas accessible en ecriture";
        return false;
        }
}


?>    
