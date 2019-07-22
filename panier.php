<?php
session_start();
require_once('inc/my-sql-connect.php');
if(isset($_SESSION["id_client"])) {
    $id_client = $_SESSION["id_client"];
}
else if(isset($_COOKIE["id_client"])) {
    $id_client = $_COOKIE["id_client"];
}
else {
    die("Pas de bras, pas de chocolat !");
}
/**
 * CREATION DU PANIER
 */
$date_creation = date("Y-m-d h:i:s");
$date_modification = date("Y-m-d h:i:s");
if(!$_SESSION["id_panier"]) {
    $sql = 'INSERT INTO panier (
          id_client, 
          date_creation, 
          date_modification
      ) VALUES (
          :id_client,
          :date_creation,
          :date_modification
      )';
    $req = $dbh->prepare($sql);
    $req->bindParam(':id_client', $id_client);
    $req->bindParam(':date_creation', $date_creation);
    $req->bindParam(':date_modification', $date_modification);
    $req->execute();
    $_SESSION["id_panier"] = $dbh->lastInsertId();
} else {
    $sql = 'UPDATE panier SET date_modification = :date_modification';
    $req = $dbh->prepare($sql);
    $req->bindParam(':date_modification', $date_modification);
    $req->execute();
}
/**
 * ALIMENTER LE PANIER
 */
$id_panier = $_SESSION["id_panier"];
if(isset($_GET["livre"])) {
    $id_livre = $_GET["livre"];
    $quantite = 1;
    $sqlLivreExistant = 'SELECT id_livre FROM ligne_panier 
WHERE id_livre = :id_livre';
    $reqLivreExistant = $dbh->prepare($sqlLivreExistant);
    $reqLivreExistant->bindParam(':id_livre', $id_livre);
    $reqLivreExistant->execute();
    if($reqLivreExistant->rowCount() == 0) {
        $sqlLigne = 'INSERT INTO ligne_panier (
      id_livre,
      quantite,
      id_panier
    ) VALUES (
      :id_livre,
      :quantite,
      :id_panier
    )';
        $reqLigne = $dbh->prepare($sqlLigne);
        $reqLigne->bindParam(':id_livre', $id_livre);
        $reqLigne->bindParam(':quantite', $quantite);
        $reqLigne->bindParam(':id_panier', $id_panier);
        $reqLigne->execute();
    } else {
        $sqlLigne = 'UPDATE ligne_panier 
    SET quantite = quantite+1
    WHERE id_livre = :id_livre 
    AND id_panier = :id_panier';
        $reqLigne = $dbh->prepare($sqlLigne);
        $reqLigne->bindParam(':id_livre', $id_livre);
        $reqLigne->bindParam(':id_panier', $id_panier);
        $reqLigne->execute();
    }
}
/**
 * Supprimer des élements
 */
if(isset($_GET["delete"])) {
    $sqlDelete = 'DELETE FROM ligne_panier 
WHERE id_lignepanier = :id_lignepanier';
    $reqDelete = $dbh->prepare($sqlDelete);
    $reqDelete->bindParam(':id_lignepanier', $_GET["delete"]);
    $reqDelete->execute();
}
/**
 * Lister les éléments
 */
$sqlPanier = 'SELECT 
  ligne_panier.id_lignepanier,
  livre.titre, 
  ligne_panier.quantite,
  livre.prix, 
  (ligne_panier.quantite * livre.prix) AS prixtotal
  FROM livre
  INNER JOIN ligne_panier ON livre.id_livre = ligne_panier.id_livre
  INNER JOIN panier ON panier.id_panier = ligne_panier.id_panier
  WHERE panier.id_panier = :id_panier
  ';
$reqPanier = $dbh->prepare($sqlPanier);
$reqPanier->bindParam(':id_panier', $id_panier);
$reqPanier->execute();
$results = $reqPanier->fetchAll();
$prixTotalDuPanier = 0;
foreach($results as $line) {
    $prixTotalDuPanier += $line["prixtotal"];
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
    <style>
        table {
            border-width:1px;
            border-style:solid;
            border-color:black;
            width:100%;
        }
        td {
            border-width:1px;
            border-style:solid;
            border-color:black;
            text-align: right;
        }
        th {
            border-width:1px;
            border-style:solid;
            border-color:black;
        }
    </style>
</head>

<body>

    <?php
    require_once("inc/menu-top.php");
    ?>

  <!-- Page Content -->
  <div class="container" style="margin-top:20px">

    <div class="row">

      <div class="col-lg-3">
          <?php
          /**
           * Récupération du prénom
           */
          if(isset($_SESSION["id_client"]) || isset($_COOKIE["id_client"])) {
              if (isset($_SESSION["id_client"])) {
                  $id = $_SESSION["id_client"];
              } else if (isset($_COOKIE["id_client"])) {
                  $id = $_COOKIE["id_client"];
              }
              $sql = 'SELECT prenom
                FROM client 
                WHERE id_client = :id';
              $req = $dbh->prepare($sql);
              $req->bindParam(':id', $id);
              $req->execute();
              $personne = $req->fetch()["prenom"];
          }
          else {
              $personne = "toi";
          }
          ?>
          <h1 class="my-4">Bonjour, <?php echo $personne ?></h1>

          <p>
              Aujourd'hui nous sommes le :
              <?php
                echo(date("l jS  F Y"));
              ?>
          </p>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
          <h5>Votre Panier</h5>

          <table>
              <tr>
                  <th>Titre</th>
                  <th>Quantite</th>
                  <th>Prix Unitaire</th>
                  <th>Prix Total</th>
                  <th></th>
              </tr>
          <?php
          foreach($results as $line) { ?>
              <tr>
                  <td><?= $line["titre"] ?></td>
                  <td><?= $line["quantite"] ?></td>
                  <td><?= $line["prix"] ?> &euro;</td>
                  <td><?= $line["prixtotal"] ?> &euro;</td>
                  <td><a href="panier.php?delete=<?= $line["id_lignepanier"] ?>">Supprimer</a></td>
              </tr>
          <?php }
          ?>
              <tr>
                  <td colspan="3">TOTAL</td>
                  <td><?= number_format($prixTotalDuPanier, 2) ?> &euro;</td>
              </tr>
          </table>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

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