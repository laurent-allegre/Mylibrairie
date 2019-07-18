<?php
session_start();
require_once('inc/menu-top.php');
require_once('inc/my-sql-connect.php');
$errors = [];
$identified = !(!isset($_SESSION["id_client"]) && !isset($_COOKIE["id_client"]));

// client non enregistré dans la base

if(!isset($_SESSION["id_client"]) && !isset($_COOKIE["id_client"])){
    $nom=$_POST["nom"] ??  '';
    $prenom=$_POST["prenom"] ?? '';
    $adresse=$_POST["adresse"] ??'';
    $code_postal=$_POST["code_postal"] ?? '';
    $ville=$_POST["ville"] ?? '';
    $email=$_POST["email"] ?? '';
    $password=$_POST["password"]??'';
    $password1=$_POST["password1"]??'';
} else {
    $sql = "SELECT * 
    FROM client 
    WHERE id_client = :id_client
    
    ";
    $req = $dbh->prepare($sql);

    if(isset($_SESSION["id_client"])){
        $param = $_SESSION['id_client'];
    } else {
        $param = $_COOKIE['id_client'];
        
    }
    $req->bindParam(':id_client', $param);
    $req->execute();
    $user = $req->fetch(); // Je vérifie les correspondances du mail : utilisateur trouvé
    if($user != false) { 
        
//  client déja enregistré dans la base 
        $id_client=$user["id_client"] ??  '';

        $nom=$user["nom"] ?? '';
        $prenom=$user["prenom"] ?? '';
        $adresse=$user["adresse"] ??'';
        $code_postal=$user["code postal"] ?? '';
        $ville=$user["villes"] ?? '';
        $email=$user["email"] ?? '';
        $password=$user["password"]??'';
        $password1=$user["password"]??'';    
        
        
    }
}




if(  isset($_POST["envoyer"])){

    if($identified){
       // ( `id_client`,`nom`, `prenom`, `adresse`, `code postal`, `villes`, `email`, `password`)
        // on met a jour
        $nom=$_POST["nom"] ??  '';
    $prenom=$_POST["prenom"] ?? '';
    $adresse=$_POST["adresse"] ??'';
    $code_postal=$_POST["code_postal"] ?? '';
    $ville=$_POST["ville"] ?? '';
    $email=$_POST["email"] ?? '';
    $password=$_POST["password"]??'';
    $password1=$_POST["password1"]??'';


$sql = 'UPDATE `client` 
SET
   `nom` = :nom
 , `prenom` = :prenom
 , `adresse` = :adresse
 , `code postal` = :code_postal
 ,`villes` = :ville
 ,`email` = :email
 ,`password` = :password
 WHERE 
 `client`.`id_client` = :id_client;'; 


 $req = $dbh->prepare($sql);
 $req->bindParam(':nom', $nom, 45);
 $req->bindParam(':prenom', $prenom,45);
 $req->bindParam(':adresse', $adresse);
 $req->bindParam(':code_postal', intval(trim($code_postal)));
 $req->bindParam(':ville', $ville, 45);
 $req->bindParam(':email', $email, 45);
 $req->bindParam(':password', $password, 45);
 $req->bindParam(':id_client', intval(trim($id_client)));
$result = $req->execute();
header('Location:index.php');



    
} else {
  // on ajoute   
        
    $sql = '
    INSERT INTO `client` 
    ( `id_client`,`nom`, `prenom`, `adresse`, `code postal`, `villes`, `email`, `password`)
    
    VALUES (
        NULL
        , :nom
        , :prenom
             , :adresse
             , :code_postal
             , :ville
             , :email
             , :password
        );';

        $req = $dbh->prepare($sql);
            $req->bindParam(':nom', $nom, 45);
            $req->bindParam(':prenom', $prenom,45);
            $req->bindParam(':adresse', $adresse);
            $req->bindParam(':code_postal', intval(trim($code_postal)));
            $req->bindParam(':ville', $ville, 45);
            $req->bindParam(':email', $email, 45);
            $req->bindParam(':password', $password, 45);
          $result = $req->execute();
          
          if(!$result){
            $errors = $req->errorInfo();
              //  var_dump($error);
              switch($errors[0]){
                  case "22001":
                        $errors []= "attention, vos champs sont trops long";
                    break;
                  case"23000":
                        $errors [] = "cette adresse e-mail existe deja";
                    break;
              }
          }
        }  
        
        
    }
    
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">
  </head>
  <body>
     
      <h1>Inscription</h1>
      
      <div class="container">
<form action="#" method="post">
  
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputNom4">Nom:</label>
      <input type="nom" class="form-control" id="nom" name="nom" placeholder="nom" value="<?= $nom ?>">
    </div>
  
    <div class="form-group col-md-6">
      <label for="prenom">prénom:</label>
      <input type="text" class="form-control" name="prenom" id="prenom" placeholder="prénom" value="<?= $prenom?>">
    </div>
    <div class="form-group col-md-6">
      <label for="email">email:</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="email"value="<?= $email?>">
    </div> 
    <div class="form-group col-md-6">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="password"value="<?= $password?>">
    </div> 
    
    <div class="form-group col-md-">
      <label for="code_postal">Code Postal:</label>
      <input type="text" class="form-control" name="code_postal" id="code_postal" placeholder="veuillez entrer votre code postal"value="<?= $code_postal?>">
    </div>
    <div class="form-group col-md-">
      <label for="ville">Ville:</label>
      <input type="text" class="form-control" name="ville" id="ville" placeholder="veuillez entrer votre ville"value="<?= $ville?>">
    </div>
    <div class="form-group col-md-6">
      <label for="password1">Password 1:</label>
      <input type="password" class="form-control" id="password1" name="password1" placeholder="password 1" value="<?= $password1 ?>">
    </div> 
    <div class="form-group col-md-6">
      <label for="adresse">Adresse:</label>
      <input type="adresse" class="form-control" id="adresse" name="adresse" placeholder="adresse"value="<?= $adresse?>">
    </div>
  </div>

  


  <input type="submit" class="btn btn-primary" name="envoyer" value="envoyer"></input>
  
</form>
</div>

  <?php require_once('inc/footer.php') ?>

</body>