<?php
session_start();

session_destroy();

  // Suppression de la valeur du tableau $_COOKIE
  if(isset($_COOKIE['id_client'])){
  setcookie('id_client', '' , time()-7200);
}

header('location:index.php');
exit();