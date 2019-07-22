<?php
session_start();
require_once('inc/my-sql-connect.php');
require_once('fonctions.php');
if(isset($_GET["livre"])) {
    $monLivre = $_GET["livre"];
} else {
    die("Le livre n'existe pas !");
}
$sql = "SELECT 
livre.titre AS titre,
livre.prix AS prix,
livre.note AS note,
livre.resume AS resume,
livre.photo AS image,
livre.nb_pages AS nb_pages,
CONCAT(COALESCE(auteur.prenom, ''),' ', auteur.nom) AS auteur,
collection.nom AS collection,
langue.nom AS langue,
genre.nom AS genre
FROM livre 
LEFT JOIN auteur ON auteur.id_auteur = livre.id_auteur
LEFT JOIN collection ON collection.id_collection = livre.id_collection
LEFT JOIN langue ON langue.id_langue = livre.id_langue
LEFT JOIN genre ON genre.id_genre = livre.id_genre
WHERE id_livre = :id_livre";
$req = $dbh->prepare($sql);
$req->bindParam(':id_livre', $monLivre);
$req->execute();
$livre = $req->fetch();
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
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">

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
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="<?= $livre["image"] ?>">
                        </div>
                        <div class="col-md-6 text-center">
                            <h3 class="card-title"><?= $livre["titre"] ?></h3>
                            <h4 class="card-title"><?= $livre["auteur"] ?></h4>
                            <h4><?= $livre["prix"] ?> &euro;</h4>
                            <p class="card-text"><?= $livre["resume"] ?></p>
                            <b>Genre :</b> <?= $livre["genre"] ?><br>
                            <b>Langue :</b> <?= $livre["langue"] ?><br>
                            <b>Collection :</b> <?= $livre["collection"] ?><br>
                            <b>Nombre de pages :</b> <?= $livre["nb_pages"] ?><br>
                            <span class="text-warning"><?php
                                $cp = 0;
                                while($cp < 5) {
                                    if($cp < $livre["note"]) {
                                        echo '&#9733;';
                                    } else {
                                        echo '&#9734; ';
                                    }
                                    $cp++;
                                }
                             ?></span>
                            <?= $livre["note"] ?> étoiles <br /><br />
                            <?php
                            if(isset($_SESSION["id_client"]) || isset($_COOKIE["id_client"])) {
                                ?>
                                <a href="panier.php?livre=<?= $monLivre ?>" class="btn btn-success">Acheter</a>
                                <?php
                            }
                            ?>
                        
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col-lg-9 -->

    </div>

</div>
<!-- /.container -->

<?php
require('inc/footer.php');
?>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>