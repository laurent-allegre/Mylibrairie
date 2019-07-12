<?php
  require_once('inc/livres.php');
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
<?php
  require_once ('inc/menu-top.php');
?>
  <!-- Navigation -->
  

  <!-- Page Content -->
  <div class="container">
      <div class="row">
<?php require_once('inc/menu-left.php') ?>
      <div class="col-lg-9">
        <div class="row">

<?php
if(count($livres) == 0) {
die("c'est la merde");

} else {
  foreach ($livres as $key => $value) {
    echo '<div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="'.$value["photo"].'" alt=""></a>
        <div class="card-body">
          <h4 class="card-title text-center">
            <a href="item.php?idlivre='.$key.'">'.$value["titre"].'</a>
          </h4>
          <h5>'.$value["auteur"].'</h5>
          <p class="">'.$value["resume"].'</p>
          <h6>'.$value["genre"].'</h6>
          <h5 class="text-right">'.number_format($value["prix"],2).' €</h5>
          <p>'.$value["nb_pages"]."pages".'</p>

        </div>
        <div class="card-footer">
          <small class="text-muted">';

          for($x = 0; $x<=5; $x++){
          
            if($x <= $value["note"]) {
            echo "&#9733";
            } else {
            echo "&#9734";
            }
          }
          
          echo '</small>
        </div>
      </div>
    </div>';

}


}
          ?>
        </div>
        
      </div>
     
    </div>
   

  </div>


  <!-- Footer -->
  <?php require_once('inc/footer.php') ?>
  

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
