<?php
session_start();

session_destroy();

  // Suppression de la valeur du tableau $_COOKIE
  if(isset($_COOKIE['prenom'])){
  setcookie('prenom', '' , time()-3600);
}
  if(isset($_COOKIE['email'])){
  setcookie('email', '' , time()-3600);
}
header('location:index.php');
exit();