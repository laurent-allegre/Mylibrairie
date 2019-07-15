<?php
session_start();
require_once('inc/livres.php'); 
if(isset($_GET["idlivre"])){
$id_du_livre = $_GET["idlivre"];
}else{
  die("le livre n'existe pas");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>LIVRE UNIQUE</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
_  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">
<link rel="stylesheet" href="./css/shop-homepage.css">
</head>

<body>

  <!-- Navigation -->
  <?php
    require_once ('inc/menu-top.php');
  ?>

  <!-- Page Content -->
  <div class="container">
     <div class="row d-flex flex-row">
     <?php require_once('inc/menu-left.php') ?>

    

<?php
echo '<div class="card d-flex flex-row col-9 "style="width:18rem;" >
            <img class="card-img-top w-50" src="'.$livres[$id_du_livre]["photo"].'" alt="Card image cap">
          <div class="card-body col-6 text-center">
            <h3 class="card-title">'.$livres[$id_du_livre]["titre"].'</h3>
            <h5>'.$livres[$id_du_livre]["auteur"].'</h5>
            <p class="card-text">'.$livres[$id_du_livre]["resume"].'</p>
            <p class="text-left">'.$livres[$id_du_livre]["nb_pages"]."pages".'</p>
            <p class="text-left">'.$livres[$id_du_livre]["genre"].'</p>
            <h6 class="text-right">'.number_format($livres[$id_du_livre]["prix"],2).'€</h6>
            <button class="btn btn-dark btn-lg"><span class="fa fa-comment"></span><br>Commentaires</button>
               <button class="btn btn-danger btn-lg"><span class="fa fa-shopping-cart"></span><br>Commander</
        </div>
      </div> ';
?> 
  </div>
  </div>      
    <?php require_once('inc/footer.php') ?>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
