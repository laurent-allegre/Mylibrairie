<?php
var_dump ($_SERVER);


echo php_uname();
echo PHP_OS;


if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    echo 'Le serveur tourne sous Windows !';
    
} else {
    echo 'Le serveur ne tourne pas sous Windows !';
   
}
?>