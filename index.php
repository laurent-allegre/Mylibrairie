<?php
session_start();

  //require_once('inc/livres.php');
  require_once('fonctions.php');
  require_once('inc/my-sql-connect.php');
  /**
   * "titre" =>"", 
   * "auteur" =>"", 
   * "prix"=> 12.90, 
   * "genre"=> "", 
   * "photo"=> "", 
   * "annee" => "", 
   * "collection"=> "",
   * "note" => "4", 
   * "langue"=> "", 
   * "nb_pages"=> "288 ", 
   * "resume"=> "" 
   */
  $sql = "SELECT 
  livre.id_livre as id_livre,
livre.photo as photo,
livre.prix as prix,
livre.titre as titre,
livre.resume as resume,
livre.note as note,
livre.nb_pages as nb_pages, 

CONCAT(auteur.prenom , ' ' ,auteur.nom) as auteur,
collection.nom as collection,
langue.nom as langue,
format.nom as nom,
genre.nom as genre
FROM livre 
INNER JOIN auteur ON livre.id_auteur = auteur.id_auteur 
INNER JOIN collection ON livre.id_collection = collection.id_collection 
INNER JOIN langue ON livre.id_langue = langue.id_langue 
INNER JOIN genre ON livre.id_genre = genre.id_genre
INNER JOIN format ON livre.id_format = format.id_format ";
$req = $dbh->prepare($sql);
$req->execute();
$livres = $req->fetchAll();
//var_dump ($livres);
if(count($livres) == 0 ) {
  echo 'pas de livres !';
 // die();
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
  foreach ($livres as $data) {  ?>
      <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
      <img src="<?php echo $data["photo"] ?>" class="card-img-top" alt="..." />
        <div class="card-body">
          <h4 class="card-title text-center">
          <a href="item.php?livre=<?php echo $data["id_livre"] ?>"><?php echo $data["titre"] ?></a>
          </h4>
          <h5><?php echo $data["auteur"] ?></h5>
          <p class=""><?=$data["resume"]?></p>
          <h6><?php echo $data["genre"]?></h6>
          <h5 class="text-right"><?= number_format($data["prix"],2 ) ?>&euro;</h5>
          <p><?= $data["nb_pages"]."pages" ?></p>

        </div>
        <div class="card-footer">
          <small class="text-muted">
          <?php
          for($x = 0; $x<=5; $x++){
          
            if($x <= $data["note"]) {
            echo "&#9733";
            } else {
            echo "&#9734";
            }
          } ?>
          
          </small>
        </div>
      </div>
    </div>
<?php
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
