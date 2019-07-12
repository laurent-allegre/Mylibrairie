

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
      <?php
        require_once('inc/menu-top.php')
      ?>
      <h1>contact</h1>
      
      <div class="container">
<form action="traitementMail.php" method="post">
  
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputNom4">Nom:</label>
      <input type="nom" class="form-control" id="nom" name="nom" placeholder="nom">
    </div>
  
    <div class="form-group col-md-6">
      <label for="prenom">prénom:</label>
      <input type="text" class="form-control" name="prenom" id="prenom" placeholder="prénom">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">mail:</label>
      <input type="mail" class="form-control" id="inputEmail4" name="mail" placeholder="mail">
    </div>
    
    <div class="form-group col-md-8">
      <label for="titre">Titre:</label>
      <input type="text" class="form-control" name="titre" id="titre" placeholder="veuillez entrer votre  titre de message">
    </div>
  </div>

  <div class="form-group">
  <label for="Textarea1">Veuillez ecrire votre message. !</label>
  <textarea class="form-control rounded-0" id="Textarea1" name="message" rows="10"></textarea>
</div>


  <input type="submit" class="btn btn-primary" name="bouton" value="Envoyer"></input>
  
</form>
</div>
<br>
  <?php require_once('inc/footer.php') ?>
  </body>