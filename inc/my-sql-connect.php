<?php
$login = "root";
$password = "";

try{
    $base = "mysql:host=localhost; dbname=mydb";
    $dbh = new PDO($base, $login , $password,array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8'));

} catch(PDOExecption $e){
    echo "Erreur :".$e->getMessage()."<br>";
    die();
  }



