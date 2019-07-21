<?php
session_start();
require_once('inc/my-sql-connect.php');
require_once('fonctions.php');

if(isset($_GET["livre"])){
  $monLivre = $_GET["livre"];
  
  }else{
    die("le livre n'existe pas");
  }
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
$sql =  "SELECT
livre.titre AS titre,
livre.prix AS prix,
livre.note AS note,
livre.resume AS resume,
livre.photo AS photo,
livre.nb_pages AS  nb_pages,
concat (COALESCE(auteur.prenom, ''),'  ', auteur.nom) AS auteur,
collection.nom AS collection,
langue.nom AS langue,
genre.nom AS genre
FROM livre
LEFT JOIN auteur ON auteur.id_auteur = livre.id_auteur
LEFT JOIN collection ON collection.id_collection = livre. id_collection
LEFT JOIN langue ON langue.id_langue = livre.id_langue
LEFT JOIN genre ON genre.id_genre = livre.id_genre
WHERE id_livre = :id_livre";

$req = $dbh->prepare($sql);
$req->bindParam(':id_livre', $monLivre);
$req->execute();
$livres = $req->fetch();




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
            <img class="card-img-top w-50" src="'.$livres["photo"].'" alt="Card image cap">
          <div class="card-body col-6 text-center">
            <h3 class="card-title">'.$livres["titre"].'</h3>
            <h5>'.$livres["auteur"].'</h5>
            <p class="card-text">'.$livres["resume"].'</p>
            <p class="text-left">'.$livres["nb_pages"]."pages".'</p>
            <p class="text-left">'.$livres["genre"].'</p>
            <h6 class="text-right">'.number_format($livres["prix"],2).'€</h6>
            
            
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
