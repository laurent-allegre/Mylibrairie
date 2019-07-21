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
$titrePage = "Ajouter un auteur";
$valueSubmit = "Ajouter";
$succes = "Auteur bien ajouté !";
/**
 * On récupère les données
 */
$nom            = $_POST["nom"] ?? "";
$prenom         = $_POST["prenom"] ?? "";
$bio            = $_POST["bio"] ?? "";
$dateNaissance  = $_POST["date_de_naissance"] ??  "";
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
    $sql = 'INSERT INTO auteur (
      nom,
      prenom,
      bio,
      date_de_naissance,
      photo
    )
    VALUES(
      :nom,
      :prenom,
      :bio,
      :date_de_naissance,
      :photo
    )';
    /**
     * Je prépare ma requête
     */
    $req = $dbh->prepare($sql);
    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':bio', $bio);
    $req->bindParam(':date_de_naissance', $dateNaissance);
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
            <label for="nom" class="col-sm-2 col-form-label">Nom</label>
            <div class="col-sm-10">
                <input name="nom" class="form-control" placeholder="" type="text" value="<?= $nom ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="prenom" class="col-sm-2 col-form-label">Prenom</label>
            <div class="col-sm-10">
                <input name="prenom" class="form-control" placeholder="" type="text" value="<?= $prenom ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="titre" class="col-sm-2 col-form-label">Date naissance</label>
            <div class="col-sm-10 input-group date">
                <input class="form-control" name="date_de_naissance" placeholder="" type="date" value="<?= $dateNaissance ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="resume" class="col-sm-2 col-form-label">Biographie</label>
            <div class="col-sm-10">
                <textarea name="bio" class="form-control"><?= $bio ?></textarea>
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