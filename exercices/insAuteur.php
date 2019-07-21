<?php
/**
 * Je démarre ma session
 * Car je vais avoir besoin des sessions
 */
session_start();
/**
 * On inclut la connexion SQL
 */
require_once('my-sql-connect.php');
$errors = [];
$id_client = null;

if(isset($_SESSION['id_client'])){
    $id_client = $_SESSION['id_client'];
}
if(isset($_COOKIE['id_client'])){
    $id_client = $_COOKIE['id_client'];
}

if($id_client == null){
    die();
}



$nom=$_POST["nom"] ?? $nom = '';
$prenom=$_POST["prenom"] ?? $prenom ='';
$bio=$_POST["bio"] ?? $bio = '';
$date_de_naissance=$_POST["date_de_naissance"] ?? $date_de_naissance = '';
$photo=$_POST["photo"] ?? $photo = '';

if( isset($_POST["envoyer"])){


        $sql = 'INSERT INTO `auteur` (
    
        `nom`,
        `prenom`,
        `bio`,
        `date_de_naissance`,
        `photo`
        
    ) VALUES (
        :nom,
        :prenom,
        :bio,
        :date_de_naissance,
        :photo
        
    )';
    $req = $dbh->prepare($sql);
    
    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':bio', $bio);
    $req->bindParam(':date_de_naissance', $date_de_naissance);

    $unevariable = "image/test.jpg";
    $req->bindValue(':photo',$unevariable);
    
    $result = $req->execute();
    $errors = $req->errorInfo();
    
    var_dump($errors);
    if(!$result){
       
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

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ma super boutique</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/shop-homepage.css" rel="stylesheet">

</head>

<body>

<?php
require_once("menu-top.php");
?>

<!-- Page Content -->
<div class="container" style="margin-top:20px">
    
    <form method="POST" enctype="multipart/form-data">
  
    
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="nom">nom</label>
      <input type="text" class="form-control" name="nom">
    </div>
    <div class="form-group col-md-4">
      <label for="prenom">prenom</label>
      <input type="text" class="form-control" name="prenom">
    </div>
    <div class="form-group col-md-4">
      <label for="bio">bio</label>
      <input type="text" class="form-control" name="bio">
    </div>
    <div class="form-group col-md-4">
      <label for="date_de_naissance">date de naissance</label>
      <input type="date" class="form-control" name="date_de_naissance">
    </div>
    
    <div class="form-group col-md-4">
      <label for="photo">photo</label>
      <input type="file" class="form-control" name="photo">
    </div>
         
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <button type="submit" name="envoyer" class="btn btn-primary">Sign in</button>
</form>

</div>
<!-- /.container -->

<?php
require('footer.php');
?>

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>