<?php
// formlivre.php
session_start();
require_once('./inc/my-sql-connect.php');
$errors = []; // Initialisation des éventuelles erreurs
/**
 * Je récupère l'id de mon client
 */
$idClient = null;
/**
 * Si je suis connecté.e en session ...
 */
if(isset($_SESSION["id_client"])) {
    $idClient = $_SESSION["id_client"];
}
/**
 * Si je suis connecté.e en cookie
 */
else if(isset($_COOKIE["id_client"])) {
    $idClient = $_COOKIE["id_client"];
}
/**
 * Si je n'ai pas ce droit
 */
if($idClient == null) {
    die("Vous n'avez pas les droits requis pour faire cette intervention !");
}
/**
 * On va chercher tous les auteurs
 */
$sqlAuteurs = 'SELECT * FROM auteur ORDER BY nom ASC';
$reqAuteurs = $dbh->prepare($sqlAuteurs);
$reqAuteurs->execute();
$auteurs = $reqAuteurs->fetchAll();
/**
 * On va chercher tous les genres
 */
$sqlGenres = 'SELECT * FROM genre';
$reqGenres = $dbh->prepare($sqlGenres);
$reqGenres->execute();
$genres = $reqGenres->fetchAll();
/**
 * On va chercher toutes les collections
 */
$sqlCollec = 'SELECT * FROM collection';
$reqCollec = $dbh->prepare($sqlCollec);
$reqCollec->execute();
$collections = $reqCollec->fetchAll();
/**
 * On va chercher toutes les langues
 */
$sqlLangues = 'SELECT * FROM langue';
$reqLangues = $dbh->prepare($sqlLangues);
$reqLangues->execute();
$langues = $reqLangues->fetchAll();
/**
 * On va chercher toutes les formats
 */
$sqlFormats = 'SELECT * FROM format';
$reqFormats = $dbh->prepare($sqlFormats);
$reqFormats->execute();
$formats = $reqFormats->fetchAll();
$titrePage = "Ajouter un livre";
$valueSubmit = "Enregistrer un livre";
$succes = "Livre ajouté avec succès !";
/**
 * On récupère les données
 */
$titre          = $_POST["titre"] ?? "";
$prix           = $_POST["prix"] ?? "";
$auteur         = $_POST["auteur"] ?? "";
$genre          = $_POST["genre"] ?? "";
$collection     = $_POST["collection"] ?? "";
$langue         = $_POST["langue"] ?? "";
$format         = $_POST["format"] ?? "";
$note           = $_POST["note"] ?? "";
$annee          = $_POST["annee"] ?? "";
$resume         = $_POST["resume"] ?? "";
$pages          = $_POST["pages"] ?? "";
/**
 * Envoi du formulaire
 */

if(isset($_POST["envoyer"])) {
  /*
   * Transfert de la photo
   */
  if(isset($_FILES["photo"]) && ($_FILES["photo"]["name"] != "")) {
      if($_FILES["photo"]["type"] == "image/jpeg") {
          $uploaddir = dirname(__FILE__) . "\image\\";
          $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
          $photo = 'image/'.$_FILES['photo']['name'];
          /**
           * Upload du fichier
           * Si il a été uploadé, on affiche un message de succès
           * Sinon, on affiche un debug
           */
          if(!move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
              $errors[] =  "Problème lors du téléchargement de l'image.";
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
  $sql = 'INSERT INTO livre (
    titre,
    prix,
    id_auteur,
    id_genre,
    id_collection,
    id_langue,
    id_format,
    note,
    annee,
    resume,
    nb_pages,
    photo
  )
  VALUES(
    :titre,
    :prix,
    :id_auteur,
    :id_genre,
    :id_collection,
    :id_langue,
    :id_format,
    :note,
    :annee,
    :resume,
    :nb_pages,
    :photo
  )';
  /**
   * Je prépare ma requête
   */
  $req = $dbh->prepare($sql);
  $req->bindParam(':titre', $titre);
  $req->bindParam(':prix', $prix);
  $req->bindParam(':id_auteur', $auteur);
  $req->bindParam(':id_genre', $genre);
  $req->bindParam(':id_collection', $collection);
  $req->bindParam(':id_langue', $langue);
  $req->bindParam(':id_format', $format);
  $req->bindParam(':note', $note);
  $req->bindParam(':annee', $annee);
  $req->bindParam(':resume', $resume);
  $req->bindParam(':resume', $resume);
  $req->bindParam(':nb_pages', $pages);
  $req->bindParam(':photo', $photo);
  $result = $req->execute();
  if(!$result) {
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

<?php
require_once("./inc/menu-top.php");
?>

<!-- Page Content -->
<div class="container" style="margin-top:20px">

    <h5><?= $titrePage ?></h5>

    <?php
    if(isset($result)) {
        if(empty($errors)) {
            echo '<div class="alert alert-success fade show">';
            echo "<p>".$succes."</p>";
            echo '</div>';
        } else {
            echo '<div class="alert alert-danger fade show">';
            echo "<p>Echec de l'ajout !</p>";
            foreach($errors as $data) {
                echo $data."<br>";
            }
            echo '</div>';
        }
    }
    ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="titre" class="col-sm-2 col-form-label">Titre</label>
            <div class="col-sm-10">
                <input name="titre" class="form-control" placeholder="" type="text" value="<?= $titre ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="prix" class="col-sm-2 col-form-label">Prix</label>
            <div class="col-sm-10">
                <input name="prix" class="form-control" placeholder="" type="text" value="<?= $prix ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="auteur" class="col-sm-2 col-form-label">Auteur</label>
            <div class="col-sm-10">
                <select name="auteur" class="form-control">
                    <?php
                    foreach ($auteurs as $data) {
                        $selected = $data["id_auteur"] == $auteur ? "selected" : "";
                        echo '<option value="'.$data["id_auteur"].'" '.$selected.'>'.$data["prenom"].' '.$data["nom"].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="genre" class="col-sm-2 col-form-label">Genre</label>
            <div class="col-sm-10">
                <select name="genre" class="form-control">
                    <?php
                    foreach ($genres as $data) {
                        $selected = $data["id_genre"] == $genre ? "selected" : "";
                        echo '<option value="'.$data["id_genre"].'" '.$selected.'>'.$data["nom"].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="collection" class="col-sm-2 col-form-label">Collection</label>
            <div class="col-sm-10">
                <select name="collection" class="form-control">
                    <?php
                    foreach ($collections as $data) {
                        $selected = $data["id_collection"] == $collection ? "selected" : "";
                        echo '<option value="'.$data["id_collection"].'">'.$data["nom"].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="langue" class="col-sm-2 col-form-label">Langue</label>
            <div class="col-sm-10">
                <select name="langue" class="form-control">
                    <?php
                    foreach ($langues as $data) {
                        $selected = $data["id_langue"] == $langue ? "selected" : "";
                        echo '<option value="'.$data["id_langue"].'" '.$selected.'>'.$data["nom"].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="formats" class="col-sm-2 col-form-label">Formats</label>
            <div class="col-sm-10">
                <select name="format" class="form-control">
                    <?php
                    foreach ($formats as $data) {
                        $selected = $data["id_format"] == $format ? "selected" : "";
                        echo '<option value="'.$data["id_format"].'" '.$selected.'>'.$data["nom"].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Note</label>
            <div class="col-sm-10">
                <select name="note" class="form-control">
                    <option value="0" <?php if($note == 0){ echo "selected"; } ?>>0</option>
                    <option value="1" <?php if($note == 1){ echo "selected"; } ?>>1</option>
                    <option value="3" <?php if($note == 2){ echo "selected"; } ?>>2</option>
                    <option value="3" <?php if($note == 3){ echo "selected"; } ?>>3</option>
                    <option value="4" <?php if($note == 4){ echo "selected"; } ?>>4</option>
                    <option value="5" <?php if($note == 5){ echo "selected"; } ?>>5</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="annee" class="col-sm-2 col-form-label">Année</label>
            <div class="col-sm-10">
                <input name="annee" class="form-control" placeholder="" value="<?= $annee ?>" type="text">
            </div>
        </div>

        <div class="form-group row">
            <label for="pages" class="col-sm-2 col-form-label">Nombre de pages</label>
            <div class="col-sm-10">
                <input name="pages" class="form-control" placeholder="" type="text"  value="<?= $pages ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="resume" class="col-sm-2 col-form-label">Résumé</label>
            <div class="col-sm-10">
                <textarea name="resume" class="form-control"><?= $resume ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="photo" class="col-sm-2 col-form-label">Photo</label>
            <div class="col-sm-10">
                <input name="photo" class="form-control-file" placeholder="" type="file">
            </div>
        </div>

        <div class="form-group">
            <button type="submit" name="envoyer" class="btn btn-primary btn-block"><?= $valueSubmit ?></button>
        </div>

    </form>

</div>
<!-- /.container -->

<?php
require('./inc/footer.php');
?>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>