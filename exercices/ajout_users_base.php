<?php
$login = "root";
$password = "";

try{
    $base = "mysql:host=localhost; dbname=mytest";
    $dbh = new PDO($base, $login , $password,array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8'));

} catch(PDOExecption $e){
    echo "Erreur :".$e->getMessage()."<br>";
    die();
  }

  $titrePage = "Ajouter un auteur";
  $valueSubmit = "Ajouter";
  $succes = "Auteur bien ajouté !";
  /**
   * On récupère les données
   */
  $login            = $_POST["login"] ?? "";
  $password         = $_POST["password"] ?? "";
  $photo            = $_POST["photo"] ?? "";
  
  /**
   * Envoi du formulaire
   */
  if(isset($_POST["envoyer"])) {
      /*
       * Transfert de la photo
       */
      if (isset($_FILES["photo"]) && ($_FILES["photo"]["name"] != "")) {
          if ($_FILES["photo"]["type"] == "image/jpeg") {
              $uploaddir = dirname(__FILE__) . "\image\\";
              $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
              $photo = 'image/' . $_FILES['photo']['name'];
              /**
               * Upload du fichier
               * Si il a été uploadé, on affiche un message de succès
               * Sinon, on affiche un debug
               */
              if (!move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
                  $errors[] = "Problème lors du téléchargement de l'image.";
                  print_r($_FILES['photo']['error']);
              }
          } else {
              $errors[] = "Format de l'image non valide.";
          }
      } else {
          $photo = null;
      }
      /**
       * Enregistrement en base de données
       */
      $sql = 'INSERT INTO user (
        login,
        password,
        photo
      )
      VALUES(
        :login,
        :password,
        :photo
      )';
      /**
       * Je prépare ma requête
       */
      $req = $dbh->prepare($sql);
      $req->bindParam(':login', $login);
      $req->bindParam(':password', $password);
      $req->bindParam(':photo', $photo);
      $result = $req->execute();
      if (!$result) {
          var_dump($req->errorInfo());
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
         <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    
    </head>
    
    <body>
    <h2>Ajout user dans la base Sql</h2>
    <form method="POST" action="" enctype="multipart/form-data">
    
            <div class="form-group row">
                <label for="nom" class="col-sm-2 col-form-label">login</label>
                <div class="col-sm-10">
                    <input name="login" class="form-control" placeholder="" type="text" value="<?= $login ?>" required>
                </div>
            </div>
    
            <div class="form-group row">
                <label for="prenom" class="col-sm-2 col-form-label">password</label>
                <div class="col-sm-10">
                    <input name="password" class="form-control" placeholder="" type="text" value="<?= $password ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="photo" class="col-sm-2 col-form-label">Photo</label>
                <div class="col-sm-10">
                    <input name="photo" class="form-control-file" placeholder="" type="file">
                </div>
            </div>
    
            
    
            
    
            <div class="form-group">
                <button type="submit" name="envoyer" class="btn btn-primary btn-block">envoyer</button>
            </div>
    
        </form>